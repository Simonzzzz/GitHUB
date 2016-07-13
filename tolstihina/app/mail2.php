<?php

$recepient = "tolstina@mail.ru";
$sitename = "Адвокат | Толстихина И.Б.";


$phone = trim($_GET["phone"]);



$pagetitle = "Новая заявка с сайта \"$sitename\"";
$message = "Телефон: $phone";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");

?>
