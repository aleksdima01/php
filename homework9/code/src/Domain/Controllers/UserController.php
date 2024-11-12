<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Domain\Models\User;

class UserController extends AbstractController
{

    protected array $actionsPermissions = [
        'actionHash' => ['admin'],
        'actionSave' => ['admin'],
        'actionEdit' => ['admin'],
        'actionIndex' => ['admin'],
        'actionAdd' => ['admin'],
        'actionDelete' => ['admin'],
        'actionUpdateForm' => ['admin'],
        'actionUpdate' => ['admin'],
        'actionLogout' => ['admin'],
        'actionAuth' => ['guest'],
        'actionLogin' => ['guest'],
    ];

    public function actionIndex(): string
    {
        $users = User::getAllUsersFromStorage();
        $render = new Render();
        if (!$users) {
            return $render->renderPage(
                'user-empty.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]
            );
        } else {
            return $render->renderPage(
                'user-index.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users,
                    'isAdmin' => User::isAdmin($_SESSION['id_user'] ?? null)
                ]
            );
        }
    }

    public function actionSave(): string
    {
        if (User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                'user-created.tpl',
                [
                    'title' => 'Пользователь создан',
                    'message' => "Создан пользователь " . $user->getUserName() . " " . $user->getUserLastName()
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionAdd(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'user-form.tpl',
            [
                'title' => 'Форма создания пользователя'
            ]
        );
    }

    public function actionUpdateForm(): string
    {
        $id = $_GET['id'];
        if (User::exists($_GET['id'])) {
            $render = new Render();

            $user = USER::getUserById($id);
            return $render->renderPageWithForm(
                'user-update.tpl',
                [
                    'title' => 'Форма изменения пользователя',
                    'id' => $id,
                    'user_lastname' => $user->getUserLastName(),
                    'users_name' => $user->getUserName(),
                    'user_birthday' => $user->getUserBirthday()
                ]
            );
        } else {
            throw new \Exception("Пользователь не существует!");
        }
    }
    public function actionUpdate(): string
    {
        if (User::exists($_GET['id'])) {

            if (User::validateRequestData()) {
                $user = new User();
                $arrayData = [];

                if (isset($_POST['name']) && !empty($_POST['name']))
                    $arrayData['user_name'] = htmlspecialchars($_POST['name']);

                if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
                    $arrayData['user_lastname'] = htmlspecialchars($_POST['lastname']);
                }
                if (isset($_POST['birthday']) && !empty($_POST['birthday'])) {
                    $arrayData['user_birthday_timestamp'] = strtotime($_POST['birthday']);
                }
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $arrayData['id_user'] = $_GET['id'];
                }
                $user->updateUser($arrayData);
                $render = new Render();
            } else {
                throw new \Exception("Переданные данные некорректны!");
            }
        } else {
            throw new \Exception("Пользователь не существует!");
        }
        return $render->renderPage(
            'user-created.tpl',
            [
                'title' => 'Пользователь обновлен',
                'message' => "Обновлен пользователь " . $arrayData['id_user']
            ]
        );
    }

    public function actionDelete()
    {
        if (User::exists($_POST['id'])) {
            // User::deleteFromStorage($_POST['id']);

            header("Content-type: application/json");
            $result =
                ['users' => User::getAllUsersFromStorage()];
            return json_encode($result);
            //  json_encode(array('PC' => $array))
        } else {
            throw new \Exception("Пользователь не существует!");
        }
    }

    public function actionAuth(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'user-auth.tpl',
            [
                'title' => 'Форма логина'
            ]
        );
    }

    public function actionHash(): string
    {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionLogin(): string
    {
        $result = false;

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }

        if (!$result) {
            $render = new Render();
            return $render->renderPageWithForm(
                'user-auth.tpl',
                [
                    'title' => 'Форма логина',
                    'auth_success' => false,
                    'auth_error' => 'Неверные логин или пароль'
                ]
            );
        } else {
            header('Location: /');
            return "";
        }
    }
    public function actionLogout(): void
    {
        session_destroy();
        unset($_SESSION['user_name']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['id_user']);
        header("Location: /");
        die();
    }
}
