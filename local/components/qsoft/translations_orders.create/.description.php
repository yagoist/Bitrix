<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_ALL_JOBS"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_ALLJOBS_DESC"),
	"ICON" => "/images/news_all.gif",
	"SORT" => 50,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "qsoft",
		"CHILD" => array(
			"ID" => "translations_orders",
			"NAME" => GetMessage("T_IBLOCK_DESC_JOBS"),
			"SORT" => 10,
		)
	),
);

?>