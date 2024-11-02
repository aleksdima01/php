<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Domain\Models\Phone;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\Date;

class AboutController
{
    public function actionIndex()
    {
        $phone = (new Phone())->getPhone();
        $render = new Render();
        $date = (new Date())->getDate();
        return $render->renderPage('about.tpl', [
            'phone' => $phone,
            'date' => $date
        ]);
    }
}
