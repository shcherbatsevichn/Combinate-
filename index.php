<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "combinate.php";

$number = 1234;   //Множество
$len = 3;       //длина подмножества

$r = new Combinate($number, $len);

try{
    $n = $r->number_of_stirring();  // вызывем функцию, которая считает количество вариантов вне функции для вывода комбинаций и "ловим в ней исключения(длина подмножества больше множества или меньше 0) 
    echo("Количество возможных комбинаций: ");
    echo($n."<br>");
}catch (Exception $e) {
    if($e->getMessage() == 'Неверно указанно множество или подмножество. Невалидные данные были заменены на 1.<br>'){  // меньше нуля
        echo 'Возникла Ошибка: ',  $e->getMessage(), "\n";
        $r->length = 1;
        $n = $r->number_of_stirring();
        echo("Количество возможных комбинаций: ");
        echo($n."<br>");
    }
    if($e->getMessage() == 'Указанное подмножество больше основного множества! Данные заменены на длинну множества<br>'){ // больше множества
        echo 'Возникла Ошибка: ',  $e->getMessage(), "\n";
        $len = strlen($r->data);
        $r->length = $len;
        $n = $r->number_of_stirring();
        echo("Количество возможных комбинаций: ");
        echo($n."<br>");
    }
}
$r->get_combination();
