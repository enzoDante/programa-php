<?php
    class temperatura{
        private $ce;

        public function calcular($i){
            $this->ce = 5/9 * ($i - 32);
            $this->ce = number_format($this->ce, 2, ',');
            return $this->ce;
        }
    }

?>