<?php
    class imc{
        private $peso;
        private $altura;
        private $imcc;

        public function ideal(){
            $a = $this->geta();
            $pideal_homens = number_format((72.7 * $a) - 58, 2, ',');
            $pideal_mulheres = number_format((62.1 * $a) - 44.7, 2, ',');
            echo "<p>peso ideal para homens: $pideal_homens</p>";
            echo "<p>peso ideal para homens: $pideal_mulheres</p>";
            return;

        }

        public function calcular(){
            $p = $this->getp();
            $a = $this->geta();
            $x = $this->setimc($p, $a);
            echo "<p>IMC = $x</p>";
            if($x < 20){
                $msg = "<p>IMC abaixo de 20 --- abaixo do peso</p>";
            }
            else if($x >= 20 && $x < 25){
                $msg = "<p>IMC de 20 até 25 --- peso normal</p>";
            }
            else if($x >= 25 && $x < 30){
                $msg = "<p>IMC de 25 até 30 --- sobre peso</p>";
            }
            else if($x >= 30 && $x < 40){
                $msg = "<p>IMC de 30 até 40 --- obeso</p>";
            }
            else if($x >= 40){
                $msg = "<p>IMC de 40 e acima --- obeso mórbido</p>";
            }
            return $msg;
            
        }

        public function setimc($p, $a){
            $this->imcc = number_format($p / ($a * $a),2,',');
            return $this->imcc;
        }
        public function setp($n){
            $this->peso = $n;
        }
        public function seta($n){
            $this->altura = $n;
        }
        public function getp(){
            return $this->peso;
        }
        public function geta(){
            return $this->altura;
        }
    }

?>