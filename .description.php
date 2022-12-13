<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arActivityDescription = array(
    "NAME" => GetMessage("ACTIVITY_NAME"),
    "DESCRIPTION" => GetMessage("ACTIVITY_DESCR"),
    "TYPE" => "activity",
    "CLASS" => "LogActivity",
    "JSCLASS" => "BizProcActivity",
    "CATEGORY" => array(
        "ID" => "other",
    ),
);
