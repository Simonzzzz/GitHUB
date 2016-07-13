<?php

$recepient = "tolstina@mail.ru";
$sitename = "Адвокат | Толстихина И.Б.";

$name = trim($_GET["name"]);
$email = trim($_GET["mail_to"]);
$phone = trim($_GET["phone"]);



$pagetitle = "Новая заявка с сайта \"$sitename\"";
$message = "Имя: $name \nПочта: $email \nТелефон: $phone";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");

?>
