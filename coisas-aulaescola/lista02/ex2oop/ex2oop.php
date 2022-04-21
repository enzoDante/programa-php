<?php
    class energia{
        private $kw;


        public function setkw($x){
            $this->kw = $x;
        }
        public function getkw(){
            return $this->kw;
        }
        public function calcular(){
            $valorkw = $this->kw * 0.12;
            $valorkw = $valorkw + 0.18;

            return $valorkw;
        }

    }


?>