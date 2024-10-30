<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Models\Phone;
use Geekbrains\Application1\Render;

class HeaderController
{
    public function actionIndex()
    {
        $render = new Render();

        return $render->renderPage('header.twig', []);
    }
}
