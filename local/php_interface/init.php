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
	$authorInfo="Pol'zovatel authorized {$userId} ({$login}) {$fullName}, data from form {$formName}";
} else {
	$authorInfo="NOT AUTHORIZED {$formName}";
	}
$arFields["AUTHOR"]=$authorInfo;
\CEventLog::Add([
	"SEVERITY"=>"INFO",
	"AUDIT_TYPE_ID"=>"FEEDBACK_FORM_AUTHOR_REPLACED",
	"MODULE_ID"=>"main",
	"ITEM_ID"=> "feedback_form",
	"DESCRIPTION" => "zamena data - [{$authorInfo}]"
]);
}
