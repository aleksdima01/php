<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\Date;

class PageController
{

    public function actionIndex()
    {

        $render = new Render();
        $date = (new Date())->getDate();
        return $render->renderPage('page-index.tpl', ['title' => 'Главная страница', 'date' => $date]);
    }
}
