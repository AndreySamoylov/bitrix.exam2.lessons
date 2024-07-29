<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("VACANCIES_LIST_COMPONENT_NAME"),
    "DESCRIPTION" => GetMessage("VACANCIES_LIST_COMPONENT_DESCRIPTION"),
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "catalog",
            "NAME" => GetMessage("VACANCIES_LIST_COMPONENT")
        )
    ),
    "CACHE_PATH" => "Y",
);
?>