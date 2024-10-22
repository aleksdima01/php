<?php

function sum($a,$b):int|float{
return $a+$b;
}
function division($a,$b):int|float|string{
return (!($b===0))?$a/$b:"Деление на ноль";
}
function multiply($a,$b):int|float{
return $a*$b;
}
function subtraction($a,$b):int|float{
return $a-$b;
}

function mathOperation($arg1, $arg2, string $operation){
    switch ($operation) {
        case '-':
           return subtraction($arg1,$arg2);
            break;
        case '+':
           return sum($arg1,$arg2);
            break;
        case '/':
            return division($arg1,$arg2);
            break;
        case '*':
            return multiply($arg1,$arg2);
            break;
        
        default:
            echo "Неправильная операция";
            break;
    }
}

echo nl2br(mathOperation(6,2.5,"/"). PHP_EOL);

$array=['Московская область'=> ['Москва', 'Зеленоград', 'Клин'], 'Ленинградская область'=>['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'], 'Рязанская область'=>['Рязань', 'Касимов', 'Ряжск', 'Ухолово']];
foreach ($array as $key => $value) {
    print_r($key.": ");
    foreach($value as $va){
        if(next($value)==null){
        print_r($va.' ');
        echo nl2br(" " . PHP_EOL);
        }
    else{
        print_r($va.', ');
    }
    }
}
    


?>