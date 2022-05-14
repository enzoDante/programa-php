<?php
    class bask{
        private $a;
        private $b;
        private $c;

        public function delta($a, $b, $c){
            $de = ($b * $b) -(4 * $a * $c);
            $de = sqrt($de);
            return $de;
        }
        public function x1($b, $a, $d){
            $v = (-$b + $d)/(2*$a);
            return $v;
        }
        public function x2($b, $a, $d){
            $v = (-$b - $d)/(2*$a);
            return $v;
        }

        public function calcular(){
            $a = $this->geta();
            $b = $this->getb();
            $c = $this->getc();

            $d = $this->delta($a, $b, $c);
            $v1 = $this->x1($b, $a, $d);
            $v2 = $this->x2($b, $a, $d);
            $raizes = "x1 = $v1 e x2 = $v2";
            return $raizes;

        }

        public function setvalues($n1, $n2, $n3){
            $this->a = $n1;
            $this->b = $n2;
            $this->c = $n3;
        }
        public function geta(){
            return $this->a;
        }
        public function getb(){
            return $this->b;
        }
        public function getc(){
            return $this->c;
        }
    }

?>