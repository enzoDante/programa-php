<?php
    class conceito{
        private $nota;

        public function calcular(){
            $num = $this->getnota();
            $resp = " ";
            if($num == 10 || $num == 9){
                $resp = 'A';
            }else{
                if($num == 8 || $num == 7){
                    $resp = 'B';
                }else{
                    if($num == 6 || $num == 5){
                        $resp = 'C';
                    }else{
                        $resp = 'D';
                    }
                }
            }
            return $resp;
        }

        public function setnota($n){
            $this->nota = $n;
        }
        public function getnota(){
            return $this->nota;
        }
    }

?>