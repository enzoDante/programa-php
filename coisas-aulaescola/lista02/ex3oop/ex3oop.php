<?php
    class carro{
        private $combustivel;
        private $km_rodados;

        public function setval($c, $kr){
            $this->combustivel = $c;
            $this->km_rodados = $kr;
        }
        public function getc(){
            return $this->combustivel;
        }
        public function getk(){
            return $this->km_rodados;
        }
        public function calcular(){
            $gasto = $this->km_rodados/$this->combustivel;
            return $gasto;
        }



    }

?>