<?php

if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !==true) die();

$arComponentParameters =[
	"GROUPS" =>[],
	"PARAMETERS" => [
		"CATALOG_IBLOCK_ID" =>[
			"PARENT" =>"BASE",
			"NAME" =>"ID инфоблока каталога товаров",
			"TYPE" => "STRING",
			"DEFAULT" =>"",
			],
		"CLASSIFIER_IBLOCK_ID" => [
			"PARENT" => "BASE",
			"NAME" => "ID инфоблока классификатора",
			"TYPE" => "STRING",
			"DEFAULT" =>"",
			],
		"LINK_PROPERTY_CODE"=>[
			"PARENT" => "BASE",
			"NAME" => "Код свойства с привязкой к классификатору",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			],
		"DETAIL_URL" =>[
			"PARENT" => "BASE",
			"NAME" => "Шаблон ссылки на детальный просмотр товара",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			],
		"CACHE_TIME" => ["DEFAULT" => 3600],
		"CACHE_TYPE"=> [
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => "Тип кеширования",
			"TYPE" => "LIST",
			"VALUES" => ["A"=> "Авто", "Y" =>"Кешировать", "N"=> "Не кешировать"],
			"DEFAULT" => "A",
		],
	],
];
