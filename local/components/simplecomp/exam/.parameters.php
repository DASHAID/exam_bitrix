<?php

if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !==true) die();

$arComponentParameters =[]
	"GROUPS" =>[],
	"PARAMETERS" => [
		"CATALOG_IBLOCK_ID" =>[
			"PARENT" =>"BASE",
			"NAME" =>"ID infoblocka kataloga tovarov",
			"TYPE" => "STRING",
			"DEFAULT" =>"",
			],
		"CLASSIFIER_IBLOCK_ID" => [
			"PARENT" => "BASE",
			"NAME" => "ID infoclocka classificatora",
			"TYPE" => "STRING",
			"DEFAULT" =>"",
			],
		"LINK_PROPERTY_CODE"=>[
			"PARENT" => "BASE",
			"NAME" => "cod svoistva",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			],
		"DETAIL_URL" =>[
			"PARENT" => "BASE",
			"NAME" => "Shablon ssilky",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			],
		"CACHE_TIME" => ["DEFAULT" => 3600],
		"CACHE_TYPE"=> [
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => "yip cashirovaniya",
			"TYPE" => "LIST",
			"VALUES" => ["A"=> avto, "Y" => cashirovat, "N"=> "ne cashirovat"],
			"DEFAULT" => "A",
		],
	],
];
