<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Форма обратной связи ex2_51");
?>

<?$APPLICATION->IncludeComponent("bitrix:main.feedback",
				"",
[
	"EMAIL_TO" => "admin@example.com",
	"EVENT_MESSAGE_ID" => ["FEEDBACK_FORM"],
	"OK_TEXT" => "Сообщение отправлено",
	"REQUIRED_FIELDS" => ["NAME", "EMAIL", "MESSAGE"],
	"USE_CAPTCHA" => "Y",
]
);?>

<?PHP require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>
