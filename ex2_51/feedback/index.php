<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Feedback ex2_51");
$APPLICATION->IncludeComponent("bitrix:main.feedback", "",
[
	"EMAIL_TO" => "admin@example.com",
	"EVENT_MESSAGE_ID" => ["FEEDBACK_FORM"],
	"OK_TEXT" => "Thank you, message send",
	"REQUIRED_FIELDS" => ["NAME", "EMAIL"],
	"USE_CAPTCHA" => "Y",
]
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
