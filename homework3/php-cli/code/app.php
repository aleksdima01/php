<?php

//docker build -t homework3 ./
//docker run --rm -it --mount type=bind,src="$(PWD)/code",target=/code  homework3 php app.php

// подключение файлов логики
// require_once('src/main.function.php');
// require_once('src/template.function.php');
// require_once('src/file.function.php');

require_once('vendor/autoload.php');

// вызов корневой функции
$result = main("/code/config.ini");
// вывод результата
echo $result;
