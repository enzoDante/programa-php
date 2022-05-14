<?php
    class pim{
        private $num;

        public function calcular(){
            $nm = $this->getnum();

            if($nm < 0){
                $resp = "Este número não é positivo!";
            }else{
                if($nm % 2 == 0){
                    $resp = "Este número é par";
                }else{
                    $resp = "Este número é impar";
                }
            }
            return $resp;
        }

        public function setnum($n){
            $this->num = $n;
        }
        public function getnum(){
            return $this->num;
        }
    }

?>