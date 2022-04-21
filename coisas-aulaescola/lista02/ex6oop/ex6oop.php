<?php
    class refri{
        private $ml350;
        private $ml600;
        private $l2;
        private $total;

        public function setval($m3, $m6, $l2){
            $this->ml350 = $m3;
            $this->ml600 = $m6;
            $this->l2 = $l2;
            $this->total = 0;

        }
        public function calcular(){
            if($this->ml350 > 0)
                $this->total += $this->ml350 * 350;
            if($this->ml600 > 0)
                $this->total += $this->ml600 * 600;
            
            $this->total = $this->total / 1000;

            if($this->l2 > 0)
                $this->total += $this->l2 * 2;
            
            return $this->total;
        }

    }

?>