<?php
    class nadador{
        private $idade;

        public function setid($val){
            $this->idade = $val;
        }
        public function calcular(){
            if($this->idade >= 5 && $this->idade <= 7){
                $msg = "<p>Infantil A = 5 a 7 anos</p>";
            }
            else if($this->idade >= 8 && $this->idade <= 11){
                $msg = "<p>Infantil B = 8 a 11 anos</p>";
            }                        
            else if($this->idade >= 12 && $this->idade <= 13){
                $msg = "<p>Juvenil A = 12 a 13 anos</p>";

            } else if($this->idade >= 14 && $this->idade <= 17){
                $msg = "<p>Juvenil B = 14 a 17 anos</p>";

            } else if($this->idade >= 18){
                $msg = "<p>Adultos = Maiores de 18 anos</p>";
                
            }else{
                $msg = "<p>Idade menor que permitidos!!</p>";
            }
            return $msg;
        }
    }

?>