<?php
//Подгружаем класс для автозагрузки неопределеннных классов
require_once __DIR__ . '/core/autoloader.php';
Autoloader::register();

$route = new Route();
$route->start(); // запускаем маршрутизатор