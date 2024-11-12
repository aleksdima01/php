<?php

namespace Geekbrains\Application1\Domain\Models;

use Geekbrains\Application1\Application\Application;

use function PHPSTORM_META\elementType;

class User
{

    private ?string $userName;

    private ?string $userLastName;
    private ?int $userBirthday;
    private ?int $userId;

    public function __construct(int $id = null, string $name = null, string $lastName = null, int $birthday = null)
    {
        $this->userId = $id;
        $this->userName = $name;
        $this->userLastName = $lastName;
        $this->userBirthday = $birthday;
    }

    public function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function getUserBirthday(): ?int
    {
        return $this->userBirthday;
    }
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array
    {
        $sql = "SELECT * FROM users";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetchAll();

        $users = [];

        foreach ($result as $item) {
            $user = new User($item['id_user'], $item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp']);
            $users[] = $user;
        }

        return $users;
    }
    public static function getUserById(int $id): User
    {
        $sql = "SELECT * FROM users WHERE id_user=$id";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetch();
        $user = new User($result['id_user'], $result['user_name'], $result['user_lastname'], $result['user_birthday_timestamp']);
        return $user;
    }

    public static function validateRequestData(): bool
    {
        $result = true;
        $today = time();
        if (isset($_POST['birthday']) || !empty($_POST['birthday'])) {
            $dateBlocks = explode("-", $_POST['birthday']);
        }

        if (!(
            isset($_POST['name']) || !empty($_POST['name']) ||
            isset($_POST['lastname']) || !empty($_POST['lastname']) ||
            isset($_POST['birthday']) || !empty($_POST['birthday'])
        )) {
            $result = false;
        }

        if (!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])) {
            $result =  false;
        }
        if (preg_match('/^(<.*\S>)$/', $_POST['name'])) {
            $result =  false;
        }
        if (preg_match('/^(<.*\S>)$/', $_POST['lastname'])) {
            $result =  false;
        }
        if (preg_match('/^(<.*\S>)$/', $_POST['birthday'])) {
            $result =  false;
        }
        if ($today < strtotime($_POST['birthday'])) {
            $result =  false;
        }
        if (!isset($dateBlocks[0]) || $dateBlocks[0] > 31 || $dateBlocks[0] < 1) {
            $result =  false;
        }

        if (!isset($dateBlocks[1]) || $dateBlocks[1] > 12 || $dateBlocks[1] < 1) {
            $result =  false;
        }

        if (!isset($dateBlocks[2]) || $dateBlocks[2] > date('Y') || $dateBlocks[2] < date('Y') - 110) {
            $result =  false;
        }

        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $result = false;
        }

        return $result;
    }

    public function setParamsFromRequestData(): void
    {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']);
    }

    public function saveToStorage()
    {
        $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp) VALUES (:user_name, :user_lastname, :user_birthday)";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday
        ]);
    }
    public static function exists(int $id): bool
    {
        $sql = "SELECT count(id_user) as user_count FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id_user' => $id
        ]);

        $result = $handler->fetchAll();
        if (count($result) > 0 && $result[0]['user_count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser(array $userDataArray): void
    {
        $sql = "UPDATE users SET ";

        $counter = 0;
        foreach ($userDataArray as $key => $value) {
            $sql .= $key . " = :" . $key;
            if ($counter != count($userDataArray) - 1) {
                if ($counter != count($userDataArray) - 2) {
                    $sql .= " , ";
                }
            }
            if ($counter == count($userDataArray) - 2) {
                $sql .= " WHERE ";
            }
            $counter++;
        }
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute($userDataArray);
    }

    public static function deleteFromStorage(int $user_id): void
    {
        $sql = "DELETE FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $user_id]);
    }
    public static function getUserRolesById(): array
    {
        $rolesSql = "SELECT * FROM user_roles WHERE id_user = :id";

        $handler = Application::$storage->get()->prepare($rolesSql);
        $handler->execute(['id' => $_SESSION['id_user']]);
        $result = $handler->fetchAll();
        return $result;
    }
    public static function isAdmin(?int $idUser): bool
    {
        if ($idUser > 0) {

            $sql = "SELECT role FROM user_roles WHERE role='admin' AND id_user = :id_user";
            $handler = Application::$storage->get()->prepare($sql);
            $handler->execute(['id_user' => $idUser]);
            $result = $handler->fetchAll();
            if (count($result) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
