<?php
AddEventHandler("main", "OnBeforeEventSend", "before_send_mail");
AddEventHandler("main", "OnbeforeEventSend", "debug_before");
AddEventHandler("main", "OnAfterEventSend", "debug_after");

function debug_before(&$eventName, &$lid, &$arFields)
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

	CEventLog::Add([
"SEVERITY" => "INFO",
"AUDIT_TYPE_ID" => "DEBUG_AFTER_SEND",
"MODULE_ID" => "main",
"ITEM_ID" => $eventName,
"DESCRIPTION" => "after_send" . $eventName,
]);
}
function before_send_mail(&$event, &$lid, &$arFields){

	if ($event !== "FEEDBACK_FORM")
		return;

	global $USER;
	$name_from_form = trim ($arFields["NAME"]);

	if ($USER ->IsAuthorized()) {

		$id = $USER ->GetID();
		$login = $USER ->GetLogin();
		$name = $USER ->GetFullName() ?: $login;
		$author = "(RUSSIA!!!)user is authorized: {$id} ({$login}) {$name}, data from form: {$name_from_form}";
	}else { 
		$author = "user DONT authorize, data from form: {$name_from_form}";
	}

	$arFields["AUTHOR"]=$author;

	CEventLog::Add([
	"SEVERITY" => "INFO",
	"AUDIT_TYPE_ID" => "FEEDBACK_AUTHOR_REPLACED",
	"MODULE_ID" => "main",
	"ITEM_ID" => $event,
	"DESCRIPTION" => "Replaced data in send email - {$author}",
	]);

}
