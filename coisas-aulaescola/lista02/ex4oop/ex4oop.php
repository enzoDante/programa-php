<?php
    class pessoa{
        private $idade;
        private $dias;
        private $horas;
        private $minutos;
        private $segundos;

        public function setid($val){
            $this->idade = $val;
        }
        public function getid(){
            return $this->idade;
        }
        public function calcular(){
            $this->dias = $this->idade * 365;
            $this->horas = $this->dias * 24;
            $this->minutos = $this->horas * 60;
            $this->segundos = $this->minutos * 60;
        }
        public function getd(){
            return $this->dias;
        }
        public function geth(){
            return $this->horas;
        }
        public function getm(){
            return $this->minutos;
        }
        public function gets(){
            return $this->segundos;
        }


    }



?>