<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arActivityDescription = [
    "NAME" => GetMessage("BPDDA_DESCR_NAME"),
    "DESCRIPTION" => GetMessage("BPDDA_DESCR_DESCR"),
    "TYPE" => "activity",
    "CLASS" => "OutSourcePrice",
    "JSCLASS" => "BizProcActivity",
    "CATEGORY" => [
        "ID" => "other",
    ],
    'RETURN' => [
        'Sum' => [
            'NAME' => GetMessage("SUM_NAME"),
            'TYPE' => 'int'
        ]
    ]
];
