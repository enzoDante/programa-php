<?php
    class fat{
        private $num;

        public function fatorial(){
            $n = $this->getnum();
            $f = 1;
            $msg = "";
            $msg1 = "$f";
            for($x = 1; $x <= $n; $x++){
                $f = $x * $f;
                $msg .= "$x";
                if($x < $n){
                    $msg .= " x ";
                }
                $msg1 = "$f = $msg";
            }
            return $msg1;

        }

        public function setnum($n){
            $this->num = $n;
        }
        public function getnum(){
            return $this->num;
        }
    }

?>