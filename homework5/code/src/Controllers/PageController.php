<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\Date;

class PageController
{

    public function actionIndex()
    {
        $render = new Render();
        $date = (new Date())->getDate();
        return $render->renderPage('page-index.twig', ['title' => 'Главная страница', 'date' => $date]);
    }
}
