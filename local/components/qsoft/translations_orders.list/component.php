<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Main,
	Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 36000000;
}

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);

if (!is_array($arParams["IBLOCKS"])) {
    $arParams["IBLOCKS"] = array($arParams["IBLOCKS"]);
}

$arParams["SORT_BY"] = trim($arParams["SORT_BY"]);
if ($arParams["SORT_BY"] === '') {
    $arParams["SORT_BY"] = "ACTIVE_FROM";
}

if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER"])) {
    $arParams["SORT_ORDER"]="DESC";
}

$arParams["JOBS_COUNT"] = intval($arParams["JOBS_COUNT"]);

if ($arParams["JOBS_COUNT"] <= 0) {
    $arParams["JOBS_COUNT"] = 5;
}

$arParams["IBLOCK_URL"] = trim($arParams["IBLOCK_URL"]);
$arParams["DETAIL_URL"] = trim($arParams["DETAIL_URL"]);
$arParams["ACTIVE_DATE_FORMAT"] = trim($arParams["ACTIVE_DATE_FORMAT"]);

if ($arParams["ACTIVE_DATE_FORMAT"] === '') {
    $arParams["ACTIVE_DATE_FORMAT"] = $DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"));
}

if ($this->startResultCache()) {
    if (!Loader::includeModule("iblock")) {
        $this->abortResultCache(); //если нет модуля скинули кеш
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }
    //выборка по параметрам
    if ($arParams["PROPERTY_CODE"]) {
        $params = [];
        foreach ($arParams["PROPERTY_CODE"] as $param) {
            $params[] = 'PROPERTY_' . $param;
        }
    }
    //$arParams["FIELD_CODE"] приходит из index как поля компонента "ID","NAME","DETAIL_TEXT","DATE_CREATE"
    //SELECT
    $arSelect = array_merge($arParams["FIELD_CODE"], array(
        "IBLOCK_ID",
        "ACTIVE_FROM",
        "DETAIL_PAGE_URL",
    ),
        $params
    );
    //WHERE
    $arrFilter["ACTIVE"] = "Y";
    $arrFilter["ACTIVE_DATE"] = "Y";
    $arrFilter["CHECK_PERMISSIONS"] = "Y";
    //ORDER BY
    $arOrder = array($arParams["SORT_BY"] => $arParams["SORT_ORDER"]);

    $rsIBlocks = CIBlock::GetByID($arParams['IBLOCK_ID']);
    $arIBlock = $rsIBlocks->GetNext();

    $arIBlock["ITEMS"] = array();
    $arrFilter["IBLOCK_ID"] = $arIBlock["ID"];

    $rsItem = CIBlockElement::GetList(
        $arOrder, //сортировка элемента поле и направление
        $arrFilter, //параметры where
        false, //группировка
        array("nTopCount" => $arParams["JOBS_COUNT"]),//постраничная навигация
        $arSelect //возвращаемый массив полей
    );

    $rsItem->SetUrlTemplates($arParams["DETAIL_URL"]);

    $userFilter = [];

    while ($arItem = $rsItem->GetNext()) {
        if ($arItem["ACTIVE_FROM"] <> '') {
            $arItem["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat( //конверт даты
                $arParams["ACTIVE_DATE_FORMAT"],
                MakeTimeStamp($arItem["ACTIVE_FROM"], //
                    CSite::GetDateFormat() //Дата, время сайта
                )
            );
        } else {
            $arItem["DISPLAY_ACTIVE_FROM"] = "";
        }

        $arIBlock["ITEMS"][] = $arItem;

        if (isset($userFilter['ID'])) {
            $userFilter['ID'] = $userFilter['ID'] . '|' . $arItem['PROPERTY_RESPONSIBLE_VALUE'];
        } else {
            $userFilter['ID'] = $arItem['PROPERTY_RESPONSIBLE_VALUE'];
        }
    }

    $users = CUser::GetList(($by = 'id'), ($order = 'asc'), $userFilter);
    $usersNames = [];

    while($user = $users->GetNext()) {
        $usersNames[$user['ID']] = $user['NAME'] . ' ' . $user['SECOND_NAME'] . ' ' . $user['LAST_NAME'];
    };
    foreach ($arIBlock['ITEMS'] as $key => $item) {
                if (isset($usersNames[$item['PROPERTY_RESPONSIBLE_VALUE']])
                    && !isset($usersNames[$item['PROPERTY_RESPONSIBLE_FULL_NAME']]))
                {
                    $arIBlock['ITEMS'][$key]['PROPERTY_RESPONSIBLE_FULL_NAME'] = $usersNames[$item['PROPERTY_RESPONSIBLE_VALUE']];
            };
    }
    $arResult = $arIBlock;

    $this->includeComponentTemplate();
}

unset($arIBlock);

$this->setResultCacheKeys([]);

