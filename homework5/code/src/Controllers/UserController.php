<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;
use Geekbrains\Application1\Models\Date;

class UserController
{

    private static function validateDate(string $date): bool
    {
        $dateBlocks = explode("-", $date);
        $today = date("Ymd");
        $arrayDate = date_parse_from_format("d-m-Y", $date);
        $formatDate = $arrayDate['year'] . $arrayDate['month'] . $arrayDate['day'];

        if (!(count($dateBlocks) === 3)) {
            return false;
        }

        if ($today < $formatDate) {
            return false;
        }

        if (isset($dateBlocks[0]) && $dateBlocks[0] > 31 || $dateBlocks[0] < 1) {
            return false;
        }

        if (isset($dateBlocks[1]) && $dateBlocks[1] > 12 || $dateBlocks[1] < 1) {
            return false;
        }

        if (isset($dateBlocks[2]) && $dateBlocks[2] > date('Y') || $dateBlocks[2] < date('Y') - 110) {
            return false;
        }

        return true;
    }
    private static function addFunction(string $name, string $birthday): string
    {
        $result = '';
        $nameToSave = $name;
        $dateToSave = $birthday;
        if (!(UserController::validateDate($dateToSave))) {
            echo "Неправильный формат даты. Данные не сохранены. \r\n";
            $result = "Ошибка записи.";
        } else {
            $data = $nameToSave . ", " . $dateToSave . "\r\n";
            $address =  $_SERVER['DOCUMENT_ROOT'] . '/storage/birthdays.txt';
            $fileHandler = fopen($address, 'a');

            if (fwrite($fileHandler, $data)) {
                fclose($fileHandler);

                $result = "Данные сохранены!";
            } else {
                fclose($fileHandler);
                $result = "Ошибка записи.";
            }
        }
        return $result;
    }

    public function actionSave()
    {
        $name = $_GET['name'];
        $birthday = $_GET['birthday'];
        echo UserController::addFunction($name, $birthday);
    }


    public function actionIndex()
    {
        $users = User::getAllUsersFromStorage();
        $date = (new Date())->getDate();
        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден",
                    'date' => $date
                ]
            );
        } else {
            return $render->renderPage(
                'user-index.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users,
                    'date' => $date

                ]
            );
        }
    }
}
