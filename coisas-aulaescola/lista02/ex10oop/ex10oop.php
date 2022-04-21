<?php
    class triangulo{
        private $l1;
        private $l2;
        private $l3;

        public function setval($l1, $l2, $l3){
            $this->l1 = $l1;
            $this->l2 = $l2;
            $this->l3 = $l3;
        }
        public function calcular(){
            if($this->l1 <= 0 || $this->l2 <= 0 || $this->l3 <= 0){
                $msg = "<p>Digite medidas válidas!!!</p>";
            }else{
                if($this->l1 + $this->l2 > $this->l3 && $this->l1 + $this->l3 > $this->l2 && $this->l3 + $this->l2 > $this->l1){
                    if($this->l1 == $this->l2 && $this->l2 == $this->l3){
                        $msg = "<p>Triângulo equilátero</p>";
                    }
                    else if($this->l1 == $this->l2 || $this->l2 == $this->l3 || $this->l1 == $this->l3){
                        $msg = "<p>Triângulo isóceles</p>";
                    }
                    else{
                        $msg = "<p>Triângulo escaleno</p>";
                    }
                }else{
                    $msg = "<p>Não é possível formar um triângulo com esses números!!!</p>";
                }

            }
            return $msg;
        }
    }


?>