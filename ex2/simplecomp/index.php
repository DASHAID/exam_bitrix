<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Prostpy component");

$APPLICATION->IncludeComponent(
	"simplecomp.exam",
	"",
	[
		"CATALOG_IBLOCK_ID" =>"2",
		"CLASSIFIER_IBLOCK_ID" =>"3",
		"LINK_PROPERTY_CODE"=>"FIRMA",
		"DETAIL_URL" => "/catalog/detail.php?ELEMENT_ID=#ELEMENT_ID#",
		"CACHE_TYPE" =>"A",
		"CACHE_TIME" =>3600,
	]
);

require($_SERVER["DOCUMENT_ROOT"]."bitrix/footer.php");
