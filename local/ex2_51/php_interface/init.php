<?php
use Bitrix\Main\UserTable;
use CEventLog;

AddEventHandler("main", "OnBeforeEventAdd", "before_send_mail");

function before_send_mail(&$event, &$site_id, &$array_fields){

	if ($event !== "FEEDBACK_FORM"){
		return;
	}

	global $USER;
	$name_from_form = trim ($array_fields["AUTHOR_NAME"] ?? $array_fields["NAME"] ?? "");

	if ($USER ->IsAuthorized()) {

	$id = $USER ->GetID();
	$login = $USER ->GetLogin();
	$fio = trim($USER ->GetFormattedName(false));
	$author = "user is authorized: {$id} ({$login}) {$fio}, data from form: {$name_from_form}";

	}
	else { 
		$author = "user DONT authorize, data from form: {$name_from_form}";
	}

	$array_fields["AUTHOR"]=$author;

	CEventLog::Add([
	"SEVERITY" => "INFO",
	"AUDIT_TYPE_ID" => "FEEDBACK_AUTHOR_REPLACED",
	"MODULE_ID" => "main",
	"ITEM_ID" => $event,
	"DESCRIPTION" => "Replaced data in send email - {$author}",
	]);
	}
}
