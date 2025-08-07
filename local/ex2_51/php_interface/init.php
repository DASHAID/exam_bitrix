<?php
 CEventLog::Add([
"SEVERITY" => "INFO",
"AUDIT_TYPE_ID" => "INIT_CHECK",
"MODULE_ID" => "main",
"ITEM_ID" => "INIT",
"DESCRIPTION" => "alright ehh",
]);

AddEventHandler("main", "OnBeforeEventSend", "before_send_mail");

function before_send_mail(&$event, &$site_id, &$array_fields){

	if ($event !== "FEEDBACK_FORM")
		return;

	global $USER;
	$name_from_form = trim ($array_fields["NAME"]);

	if ($USER ->IsAuthorized()) {

		$id = $USER ->GetID();
		$login = $USER ->GetLogin();
		$name = $USER ->GetFullName() ?: login;
		$author = "(RUSSIA!!!)user is authorized: {$id} ({$login}) {$name}, data from form: {$name_from_form}";
	}else { 
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
