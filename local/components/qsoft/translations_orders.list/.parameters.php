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

//$arProperty = array();
//	$rsProp = CIBlockProperty::GetList(
//        Array(
//            "name"=>"asc"
//        ),
//        Array(
//            "IBLOCK_ID"=> $arCurrentValues["IBLOCK_ID"],
//            "ACTIVE"=>"Y"
//        )
//    );
//
//	while ($arr=$rsProp->Fetch()) {
//		$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
//	}

$arSorts = Array(
	"ASC" => GetMessage("T_IBLOCK_DESC_ASC"),
	"DESC" => GetMessage("T_IBLOCK_DESC_DESC"),
);
$arSortFields = Array(
		"ID" => GetMessage("T_IBLOCK_DESC_FID"),
		"NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
		"ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
		"SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
		"TIMESTAMP_X" => GetMessage("T_IBLOCK_DESC_FTSAMP")
);
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
		"JOBS_COUNT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBCNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "5",
		),
		"IBLOCK_SORT_BY" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBSORT"),
			"TYPE" => "LIST",
			"VALUES" => Array(
				"SORT" => GetMessage("T_IBLOCK_DESC_SORT"),
				"NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
				"ID" => GetMessage("T_IBLOCK_DESC_ID"),
			),
			"DEFAULT" => "SORT",
		),
		"IBLOCK_SORT_ORDER" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBSORTBY"),
			"TYPE" => "LIST",
			"DEFAULT" => "ASC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_BY" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBORD"),
			"TYPE" => "LIST",
			"DEFAULT" => "ACTIVE_FROM",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBBY"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"IBLOCK_URL" => CIBlockParameters::GetPathTemplateParam(
			"LIST",
			"IBLOCK_URL",
			GetMessage("IBLOCK_IBLOCK_URL"),
			"",
			"URL_TEMPLATES"
		),
		"DETAIL_URL" => CIBlockParameters::GetPathTemplateParam(
			"DETAIL",
			"DETAIL_URL",
			GetMessage("IBLOCK_DETAIL_URL"),
			"",
			"URL_TEMPLATES"
		),
		"ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
	),
);
