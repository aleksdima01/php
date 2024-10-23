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

function transliteration(string $string):string{
    $alfabet = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
    ];
    $result='';
    for ($i=0; $i<mb_strlen($string,'UTF-8') ; $i++) { 
        if (array_key_exists(mb_strtolower(mb_substr($string,$i,1)),$alfabet)) {
            $result=$result.$alfabet[mb_strtolower(mb_substr($string,$i,1))];
        }
      else {
        $result=$result.mb_substr($string,$i,1);
      }
    }
return $result;
}
echo nl2br(transliteration('мвПрОльпрарпsd.,*fsdf'). PHP_EOL);

function powUp($val, $pow){
    if ($val == 0 && $pow <= 0) {
        echo "Невозможно возвести 0 в степень меньше 1";
      }
      else{
      if ($val == 1 || $val == 0) return $val;
      if ($pow > 1) return $val * powUp($val, $pow-1);
      if ($pow < 1) return 1/$val * powUp($val, $pow+1);
      return $val;
    }
    
  }
 echo powUp(4,-3);

?>