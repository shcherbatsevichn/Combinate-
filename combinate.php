<?php

class Combinate{

    public $data;
    public $length;

    public function __construct($inputdata, $linelength) 
    {
        $this->data = $inputdata;
        $this->length = $linelength;
    }

    public function get_factorial($n){  // n!
        if($n <= 1){
            return 1;
        }
        return $n*$this->get_factorial($n-1);
    }

    public function number_of_stirring(){ //метод который считает размещения, в обход основного алгоритма.
        $nm = (strlen($this->data) - $this->length);
        if($nm > strlen($this->data)){
            throw new Exception('Неверно указанно множество или подмножество. Невалидные данные были заменены на 1.<br>');
        }
        if($nm < 0){
            throw new Exception('Указанное подмножество больше основного множества! Данные заменены на длинну множества<br>');
        }
        $nfact = $this->get_factorial(strlen($this->data));
        $nnmfact = $this->get_factorial($nm);
        $res = $nfact / $nnmfact;
        return $res;
    }
    
    public function delete_element($index, $array){ //удаление элемента из массива, возвращает массив без элемента
        $arr = $array;
        $res = [];
        $n = 0;
        for($i = 0; $i < count($arr); $i++){
            if($i == $index){
                continue;
            }
            $res[$n] = $arr[$i];
            $n++;
        }
        return $res;
    }

    public function get_element($index, $array){ // возвращяет указанный элемент из массива 
        $arr = $array;
        for($i = 0; $i < count($arr); $i++){
            if($i == $index){
                return $arr[$i];
            }
        }
    }
    public function get_combination($array = '', $counter = '', $res = ''){ // создаёт комбинации
        if(!is_array($array)){   // если значение не переданно, устанавливаем указанное значение 
            $array = str_split($this->data);
        }
        if($counter === ''){    // если не указан, устанавливаем стартовое значение
            $counter = $this->length - 2;
        }
        if($this->length - 2 < 0){  // если необходимо выводить подмножество, с длинной 1
            for($j = 0; $j < count($array); $j++){
                echo($res.$array[$j]."<br>"); 
            }
            exit;
        }
        for($i = 0; $i < count($array); $i++){
            $mainnumb = $this->get_element($i, $array); // получаем одну цифру "Главную" в этойитерации. 
            $arr = $this->delete_element($i, $array); //получаем массив без "главной" цифры 
            $res1 = $res.$mainnumb; // получаем "замароженный результат для вывода его на нужной глубине рекурсии
            if($counter > 0){  // входим в рекурсию, если необходимо 
                $counter--;  // регулируем глубину рекурсии
                $this->get_combination($arr, $counter, $res1); 
            }else{              // если мы на нужной глубине
                for($e = 0; $e < count($arr); $e++){        //перебираем 
                    $res2 = $res.$mainnumb.$arr[$e];
                    if(strlen($res2) == $this->length){  //если значение равно длине подмножества, просто его выводим
                        echo($res2."<br>");
                        $counter--;
                    }else{                               // если не подходит, добавляем еще один элемент из остаточного массива
                        $arres = $this->delete_element($e, $arr);
                        $res2 = $res2.$arres[$e];  
                        if(strlen($res2) == $this->length){
                            echo($res2."<br>");
                            $counter--;
                        } 
                    }
                } 
            }
            $counter++;
        } 
    }
}
