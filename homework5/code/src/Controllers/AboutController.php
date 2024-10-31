<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Models\Phone;
use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\Date;

class AboutController
{
    public function actionIndex()
    {
        $phone = (new Phone())->getPhone();
        $render = new Render();
        $date = (new Date())->getDate();
        return $render->renderPage('about.twig', [
            'phone' => $phone,
            'date' => $date
        ]);
    }
}
