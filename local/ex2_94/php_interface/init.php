<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Iblock\ElementTable;

AddEventHandler("main", "OnEpilog", "set_meta_tags");

function set_meta_tags()
{
	CEventLog::Add([
"SEVERITY" => "INFO",
"AUDIT_TYPE_ID" =>"debug_before",
"MODULE_ID" => "main",
"ITEM_ID" => $eventName,
"DESCRIPTION" => "before_send" . $eventName,
]);
}

function debug_after($eventName, $lid, $arFields){
 if(!Loader::includeModule("iblock")){
	return;
  }
global $APPLICATION;

$request = Context::getCurrent() ->getRequest();
$currentPage = $request ->getRequestedPage();
$currentUri=$request ->getRequestUri();

$url=strtok($currentUri, '?');

$res =\CIBlockElement::GetList(
[],
["IBLOCK_TYPE" => "products",
"IBLOCK_CODE" => "meta_tags",
"ACTIVE" => "Y",
"NAME" => $url,
],
false,
false,
["ID", "IBLOCK_ID", "PROPERTY_title", "PROPERTY_description"]
);
if ($item = $res->GetNext()){
 if(!empty($item["PROPERTY_title_VALUE"])){
$APPLICATION ->SetPageProperty("title", $item["PROPERTY_description_VALUE"]);

}
}
}
