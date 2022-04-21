<?php
    class pessoa{
        private $massa;
        private $altura;
        private $imc;

        public function setval($m, $a){
            $this->massa = $m;
            $this->altura = $a;
        }
        public function calcular(){
            $this->imc = number_format($this->massa / ($this->altura * $this->altura),2,',');
            echo "<p>IMC = $this->imc</p>";

            if($this->imc < 20){
                $msg = "<p>IMC abaixo de 20 --- abaixo do peso</p>";
            }
            else if($this->imc >= 20 && $this->imc < 25){
                $msg = "<p>IMC de 20 até 25 --- peso normal</p>";
            }
            else if($this->imc >= 25 && $this->imc < 30){
                $msg = "<p>IMC de 25 até 30 --- sobre peso</p>";
            }
            else if($this->imc >= 30 && $this->imc < 40){
                $msg = "<p>IMC de 30 até 40 --- obeso</p>";
            }
            else if($this->imc >= 40){
                $msg = "<p>IMC de 40 e acima --- obeso mórbido</p>";
            }
            return $msg;
        }
    }


?>