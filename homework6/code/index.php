<?php

require_once('./vendor/autoload.php');

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;

date_default_timezone_set('Europe/Moscow');
try {
    $app = new Application();
    echo $app->run();
} catch (Exception $e) {
    echo Render::renderExceptionPage($e);
}
