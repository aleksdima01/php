<?php
$a = 5;
$b = '05';
var_dump($a == $b); // используется нестрогое сравнение, поэтому получаем true
var_dump((int)'012345'); // используется строгое приведение типа к числовому, получаем 12345, 0 вначале числа отсеивается
var_dump((float)123.0 === (int)123.0); // используется строгое сравнение, у integer отсеивается дробная часть, поэтому получаем false
var_dump(0 == 'hello, world'); // видим false, так как содержимое не равно; 0 == '0' ,было бы true; на версии 7.4 получаем true...
$first=1;
$second=2;
$first=$first+$second;
$second=$first-$second;
$first=$first-$second;
var_dump($first);
var_dump($second);
?>