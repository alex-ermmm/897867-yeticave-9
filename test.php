<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');
require_once ('../../vendor/autoload.php');

// Конфигурация траспорта
$transport = new Swift_SmtpTransport('phpdemo.ru', 25);
$transport->setUsername('keks@phpdemo.ru');
$transport->setPassword('htmlacademy');
// Формирование сообщения
$message = new Swift_Message("Просмотры вашей гифки");
$message->setTo(["kikher@gmail.com"]);
$message->setBody("Вашу гифку «Кот и пылесос» посмотрело больше 1 млн!");
$message->setFrom("keks@phpdemo.ru");
// Отправка сообщения
$mailer = new Swift_Mailer($transport);
$mailer->send($message);