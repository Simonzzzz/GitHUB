<?php

$recepient = "sambukist@mail.ru";
$sitename = "Thaivillas";

$name = trim($_GET["name"]);
$phone = trim($_GET["phone"]);
$mail = trim($_GET["email"]);
$text = trim($_GET["text"]);

$pagetitle = "Новая заявка с сайта \"$sitename\"";
$message = "Имя: $name \nТелефон: $phone \nE-mail: $mail \nТекст: $text";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
