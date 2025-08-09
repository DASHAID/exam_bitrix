<?php
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

EventManager::getInstance()->addEventHandler(
	"main",
	"OnBeforeEventSend",
	"ModifyForm"
);
function ModifyForm(&$arFields, &$arTemplate)
{
	if($arTemplate["EVENT_NAME"]!=="FEEDBACK_FORM"){
	return;
	}
global $USER;
if (!is_object($USER)){
$USER=new CUser;
}
$formName=$arFields["AUTHOR"];

if($USER->IsAuthorized()){
	$userId=$USER->GetID();
	$login=$USER->GetLogin();
	$fullName=$USER->GetFullName();
	$authorInfo="«Пользователь авторизован: {$userId} ({$login}) {$fullName}, из формы: {$formName}";
} else {
	$authorInfo="«Пользователь не авторизован, данные из
формы: {$formName}";
	}
$arFields["AUTHOR"]=$authorInfo;
\CEventLog::Add([
	"SEVERITY"=>"INFO",
	"AUDIT_TYPE_ID"=>"FEEDBACK_FORM_AUTHOR_REPLACED",
	"MODULE_ID"=>"main",
	"ITEM_ID"=> "feedback_form",
	"DESCRIPTION" => "«Замена данных в отсылаемом письме - [{$authorInfo}]"
]);
	
//письмо
	$logDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/mail/";
	if (!file_exists($logDir)) {
		mkdir($logDir, 0775, true);
	}

	$filename = $logDir . "feedback_" . date("Ymd_His") . "_" . rand(1000,9999) . ".txt";
	$content = "To: " . $arFields["EMAIL_TO"] . "\n";
	$content .= "Subject: " . $arTemplate["SUBJECT"] . "\n";
	$content .= "Message:\n" . $arTemplate["MESSAGE"] . "\n";

	file_put_contents($filename, $content);
}
