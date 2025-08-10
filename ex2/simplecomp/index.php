<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");

$APPLICATION->IncludeComponent(
	"simplecomp:exam",
	".default",
	array(
		"CATALOG_IBLOCK_ID" =>"2",
		"CLASSIFIER_IBLOCK_ID" =>"3",
		"LINK_PROPERTY_CODE"=>"FIRMA",
		"DETAIL_URL" => "/catalog/#ELEMENT_CODE#",
		"CACHE_TYPE" =>"A",
		"CACHE_TIME" =>3600,
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
