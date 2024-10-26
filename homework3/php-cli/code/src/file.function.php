<?php

// function readAllFunction(string $address) : string {
function readAllFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");

        $contents = '';

        while (!feof($file)) {
            $contents .= fread($file, 100);
        }

        fclose($file);
        return $contents;
    } else {
        return handleError("Файл не существует");
    }
}

function searchBirthday(array $config): string
{
    $file = readAllFunction($config);
    $array = explode("\r\n", $file);
    $today = date("d-m-Y");
    $todayDateArray = explode("-", $today);
    $result = '';
    foreach ($array as $key) {
        $searchString = explode(", ", $key);
        if (count($searchString) === 2) {
            $searchStringDateArray = explode("-", $searchString[1]);
        }
        if ($searchStringDateArray[0]  ===  $todayDateArray[0] && $searchStringDateArray[1]  ===  $todayDateArray[1]) {
            $result .= $key . PHP_EOL;
        }
    }
    if (strlen($result) === 0) {
        $result = 'Сегодня не у кого нет дня рождения!';
    } else {
        $result = "Сегодня отмечают день рождения:\r\n" . $result;
    }
    return $result;
}

function deleteUser(array $config)
{
    $address = $config['storage']['address'];
    $file = readAllFunction($config);
    $array = explode("\r\n", $file);
    $result = '';
    $resultArray = [];
    $searchLine = readline("Введите имя или дату в формате ДД-ММ-ГГГГ : ");
    foreach ($array as $key) {
        $searchArray = explode(", ", $key);
        if (!($searchLine === '')) {
            if (in_array($searchLine, $searchArray)) {
                $resultArray = array_filter($array, fn($el) => $el !== $key);
                print_r($resultArray);
                $newfile = implode("\r\n", $resultArray);
                $result .= $key . PHP_EOL;
            }
        }
    }
    if (!(strlen($result) === 0)) {
        $fileHandler = fopen($address, 'w');
        if (fwrite($fileHandler, $newfile)) {
            $result = "Удалены из хранилища пользователи: \r\n" . $result;
        }
        fclose($fileHandler);
    } else {
        $result = "Таких пользователей не найдено!";
    }
    return $result;
}

// function addFunction(string $address) : string {
function addFunction(array $config): string
{
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    if (!(validateDate($date))) {
        return handleError("Неправильный формат даты");
    }
    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');

    if (fwrite($fileHandler, $data)) {
        return "Запись $data добавлена в файл $address";
    } else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// function clearFunction(string $address) : string {
function clearFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");

        fwrite($file, '');

        fclose($file);
        return "Файл очищен";
    } else {
        return handleError("Файл не существует");
    }
}

function helpFunction()
{
    return handleHelp();
}

function readConfig(string $configAddress): array|false
{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!is_dir($profilesDirectoryAddress)) {
        mkdir($profilesDirectoryAddress);
    }

    $files = scandir($profilesDirectoryAddress);

    $result = "";

    if (count($files) > 2) {
        foreach ($files as $file) {
            if (in_array($file, ['.', '..']))
                continue;

            $result .= $file . "\r\n";
        }
    } else {
        $result .= "Директория пуста \r\n";
    }

    return $result;
}

function readProfile(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!isset($_SERVER['argv'][2])) {
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

    if (!file_exists($profileFileName)) {
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

    return $info;
}
