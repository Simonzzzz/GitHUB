<?php

$recepient = "bestfix@roste.ru";
$sitename = "Bestfix";

$name = trim($_GET["name"]);
$email = trim($_GET["mail_to"]);
$phone = trim($_GET["phone"]);
$text = trim($_GET["text"]);


$pagetitle = "Новая заявка с сайта \"$sitename\"";
$message = "Имя: $name \nПочта: $email \nТелефон: $phone \nСообщение: $text";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");

?>
