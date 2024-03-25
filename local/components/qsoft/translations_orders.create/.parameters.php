<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock")) {
    return;
}

$arTypes = CIBlockParameters::GetIBlockTypes($arCurrentValues["IBLOCK_ID"]);

$arIBlocks=Array();

$db_iblock = CIBlock::GetList(
    Array("SORT"=>"ASC"), //фильтр и направление
    Array("SITE_ID"=>$_REQUEST["site"],
        "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:""
        )
    )
);

while($arRes = $db_iblock->Fetch()) {
    $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];
}

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => Array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_IBTYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arTypes,
            "DEFAULT" => "job_list",
            "REFRESH" => "Y",
        ),
        "IBLOCK" => Array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "REFRESH" => "Y",
        ),
                "ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),
        "CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
    ),
);
