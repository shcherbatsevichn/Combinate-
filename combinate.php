<?php

class Combinate{

    public $data;
    public $length;
    public $counter;
    public $counterm;
    public $resarray;
    public $resultnumber;
    public $resultnumberprint;
    public $mainnumber;

    public function __construct($inputdata, $linelength) 
    {
        $this->data = $inputdata;
        $this->length = $linelength;
        $this->counter = 0;
        $this->counterm = 0;
        $this->resarray = [str_split($this->data)];
        $this->resultnumber = "";
        $this->resultnumberback = [];
        $this->mainnumber = 0;
    }

    public function getFactorial($n){  // n!
        if($n <= 1){
            return 1;
        }
        return $n*$this->getFactorial($n-1);
    }

    public function numberOfStirring(){ //метод который считает размещения, в обход основного алгоритма.
        $nm = (strlen($this->data) - $this->length);
        if($nm > strlen($this->data)){
            throw new Exception('Неверно указанно множество или подмножество. Невалидные данные были заменены на 1.<br>');
        }
        if($nm < 0){
            throw new Exception('Указанное подмножество больше основного множества! Данные заменены на длинну множества<br>');
        }
        $nfact = $this->getFactorial(strlen($this->data));
        $nnmfact = $this->getFactorial($nm);
        $res = $nfact / $nnmfact;
        return $res;
    }
    
    public function deleteElement($index, $array){ //удаление элемента из массива, возвращает массив без элемента
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

    public function getElement($index, $array){ // возвращяет указанный элемент из массива 
        $arr = $array;
        for($i = 0; $i < count($arr); $i++){
            if($i == $index){
                return $arr[$i];
            }
        }
    }
    public function getCombination(){ // создаёт комбинации 
        for($i = 0; $i < count($this->resarray[$this->counterm]); $i++){
            $this->mainnumber = $this->getElement($i, $this->resarray[$this->counterm]);
            $this->resarray[$this->counterm + 1] = $this->deleteElement($i, $this->resarray[$this->counterm]);
            $this->resultnumber = $this->resultnumber.$this->mainnumber;
            if (strlen($this->resultnumber) == $this->length){
                echo($this->resultnumber."<br>");
            }
            $this->counter++;
            $this->counterm++;
            if($this->counter < $this->length){ 
                $this->getCombination();
            }
            $this->resultnumberback = str_split($this->resultnumber);
            $this->resultnumber = implode($this->deleteElement(count($this->resultnumberback) - 1, $this->resultnumberback));
            $this->counterm--;
            $this->counter--;
        }
        $this->counter--;
    }
}
      