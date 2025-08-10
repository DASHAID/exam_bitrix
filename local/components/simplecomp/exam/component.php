<?php
if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !==true) die();

use Bitrix\Main\Loader;
Loader::includeModule("iblock");

global $USER, $APPLICATION;

$arParams["CATALOG_IBLOCK_ID"]=intval($arParams["CATALOG_IBLOCK_ID"]);
$arParams["CLASSIFIER_IBLOCK_ID"]= intval($arParams["CLASSIFIER_IBLOCK_ID"]);
$linkPropCode= trim($arParams["LINK_PROPERTY_CODE"]);
$detailUrlTemplate=trim($arParams["DETAIL_URL"]);

$cache= new CPHPCache;
$cacheTime=intval($arParams["CACHE_TIME"]);
$cacheId='simplecomp_exam_'
	. $arParams["CATALOG_IBLOCK_ID"].'_'
	. $arParams["CLASSIFIER_IBLOCK_ID"]. '_'
	. $linkPropCode . '_'
	. $USER->GetUserGroupArray()[0];
	$cachePath='/simplecomp.exam/';
if($cache->StartDataCache($cacheTime, $cacheId, $cachePath)){
	$arClassifiers=[];
	$classFilter=[
	"IBLOCK_ID" => $arParams["CLASSIFIER_IBLOCK_ID"],
	"ACTIVE" => "Y",
	"CHECK_PERMISSIONS" =>"Y",
	];
	$classRes=CIBlockElement::GetList([], $classFilter, false, false, ["ID", "NAME"]);
	while($classEl = $classRes->GetNext()){
	$arClassifiers[$classEl["ID"]]=[
		"ID" => $classEl["ID"],
		"NAME" => $classEl["NAME"],
		"ITEMS" =>[],
		];
	}
	
	$catalogFilter=[
		"IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"],
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"!PROPERTY_" . $linkPropCode =>false,
	];

	$catlogRes =CIBlockElement::GetList([], $catalogFilter, false, false,
	["ID", "NAME", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTIKUL", "PROPERTY_" .$linkPropCode]);
	
	while($item=$catalogRes->GetNext()){
	$linkedIds=$item["PROPERTY_".$linkPropCode . "_VALUE"];
	if(!is_array($linkedIds)){
		$linkedIds = [$linkedIds];
		}
	foreach ($linkedIds as $classId) {
		if(isset($arClassifiers[$classId])){
		$arClassifiers[$classId]["ITEMS"][]=[
		"ID" => $item["ID"],
		"NAME" => $item["NAME"],
		"PRICE" => $item["PROPERTY_PRICE_VALUE"],
		"MATERIAL" => $item["PROPERTY_MATERIAL_VALUE"],
		"ARTIKUL" => $item["PROPERTY_ARTILUL_VALUE"],
		"DETAIL_PAGE_URL"=>str_replace("#ELEMENT_ID", $item["ID"], $detailUrlTemplate),
		];
		}
		}
	}
	$arResult["CLASSIFIERS"] = $arClassifiers;
	$arResult["CLASSIFIERS_COUNT"] = count($arClassifiers);
	$cache->EndDataCache($arResult);
	} else {
		$arResult = $cache->GetVars();
	}

$APPLICATION ->SetTitle("Разделов: " . $arResult["CLASSIFIERS_COUNT"]);
$this -> IncludeComponentTemplate();
