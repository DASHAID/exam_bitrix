<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Feedback ex2_51");
?>

<?php
$APPLICATION->IncludeComponent("bitrix:main.feedback",
				"",
[
	"EMAIL_TO" => "dd.chernova@yandex.ru",
	"EVENT_MESSAGE_ID" => ["FEEDBACK_FORM"],
	"OK_TEXT" => "Thank you, message send",
	"REQUIRED_FIELDS" => ["NAME", "EMAIL", "MESSAGE"],
	"EVENT_MESSAGE_ID" => [7],
	"USE_CAPTCHA" => "Y"
]
);
?>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
