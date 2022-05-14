<?php
    class val{
        private $custo;

        public function calcular(){
            $c = $this->getval();
            $m1 = $c * 0.28;
            $m2 = $c * 0.45;
            $soma = $m1 + $m2 + $c;
            return $soma;

        }

        public function setval($v){
            $this->custo = $v;
        }
        public function getval(){
            return $this->custo;
        }
    }

?>