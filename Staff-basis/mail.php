<?php

$recepient = "info@staffbasis.ru";
$sitename = "Staff.Basis";

$name = trim($_GET["name"]);
$phone = trim($_GET["phone"]);


$pagetitle = "Новая заявка с сайта \"$sitename\"";
$message = "Имя: $name \nТелефон: $phone ";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");

?>
