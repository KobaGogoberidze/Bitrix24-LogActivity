<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arActivityDescription = array(
    "NAME" => GetMessage("JC_WL2F_NAME"),
    "DESCRIPTION" => GetMessage("JC_WL2F_DESCRIPTION"),
    "TYPE" => "activity",
    "CLASS" => "JCWriteInFileActivity",
    "JSCLASS" => "BizProcActivity",
    "CATEGORY" => array(
        "ID" => "other",
    ),
);
