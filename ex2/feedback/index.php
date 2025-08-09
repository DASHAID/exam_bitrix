<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Feedback ex2_51");
?>

<?php
$APPLICATION->IncludeComponent("bitrix:main.feedback",
				"",
[
	"EMAIL_TO" => "admin@example.com",
	"EVENT_MESSAGE_ID" => [7],
	"OK_TEXT" => "Сообщение отправлено!",
	"REQUIRED_FIELDS" => ["NAME", "EMAIL", "MESSAGE"],
	"USE_CAPTCHA" => "Y"
]
);
?>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
