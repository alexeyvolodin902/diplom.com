<?php


// 1. Общие настройки
setlocale(LC_ALL, 'ru_RU.UTF-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));

require_once(ROOT . '/components/Autoload.php');
require_once(ROOT . '/components/Router.php');
//require_once(ROOT . '/components/Db.php');
//date("Y-m-d",strtotime("3.3.2017"));



// 3. Вызов Router

$router = new Router();
$router->run();

