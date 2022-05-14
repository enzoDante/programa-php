<?php
    class cal{
        private $num1;
        private $num2;
        private $op;

        public function calcular(){
            $x = $this->getop();
            $n1 = $this->getnum1();
            $n2 = $this->getnum2();
            $resp = 0;
            switch($x){
                case 1:
                    $resp = $n1 + $n2;
                    break;
                case 2:
                    $resp = $n1 - $n2;
                    break;
                case 3:
                    $resp = $n1 * $n2;
                    break;
                case 4:
                    $resp = $n1 / $n2;
                    break;
            }
            return $resp;

        }

        public function setnum1($n){
            $this->num1 = $n;
        }
        public function setnum2($n){
            $this->num2 = $n;
        }
        public function setop($o){
            $this->op = $o;
        }
        public function getnum1(){
            return $this->num1;
        }
        public function getnum2(){
            return $this->num2;
        }
        public function getop(){
            return $this->op;
        }
    }
?>