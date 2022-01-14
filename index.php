<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "combinate.php";

$number = 1234;
$len = 3;

$r = new Combinate($number, $len);

try{
    $n = $r->number_of_stirring();
    echo("Количество возможных комбинаций: ");
    echo($n."<br>");
}catch (Exception $e) {
    if($e->getMessage() == 'Неверно указанно множество или подмножество. Невалидные данные были заменены на 1.<br>'){
        echo 'Возникла Ошибка: ',  $e->getMessage(), "\n";
        $r->length = 1;
        $n = $r->number_of_stirring();
        echo("Количество возможных комбинаций: ");
        echo($n."<br>");
    }
    if($e->getMessage() == 'Указанное подмножество больше основного множества! Данные заменены на длинну множества<br>'){
        echo 'Возникла Ошибка: ',  $e->getMessage(), "\n";
        $len = strlen($r->data);
        $r->length = $len;
        $n = $r->number_of_stirring();
        echo("Количество возможных комбинаций: ");
        echo($n."<br>");
    }
}
$r->get_combination();
