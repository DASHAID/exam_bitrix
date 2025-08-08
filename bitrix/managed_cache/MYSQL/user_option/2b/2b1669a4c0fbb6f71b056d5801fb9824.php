<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001754626969';
$dateexpire = '001754630569';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:6:"query1";s:245:"
CModule::IncludeModule("main");
$fields = array(
  "EMAIL_TO" => "admin@example.com",
  "AUTHOR"   => "Тест",
  "TEXT"     => "Проверка отправки"
);
$sent = CEvent::Send("FEEDBACK_FORM", SITE_ID, $fields);
var_dump($sent); 
";}}';
return true;
?>