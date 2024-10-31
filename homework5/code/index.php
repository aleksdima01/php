<?php


require_once(__DIR__ . '/vendor/autoload.php');

use Geekbrains\Application1\Application;

date_default_timezone_set('Europe/Moscow');

$app = new Application();
echo $app->run();
