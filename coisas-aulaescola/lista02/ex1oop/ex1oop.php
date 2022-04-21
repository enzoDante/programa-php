<?php
    class pessoa{
        private $salario_bruto;
        private $horas;
        private $sahoras;
        private $salario_liquido;
        
        public function setval($sb, $h, $sh){
            $this->salario_bruto = $sb;
            $this->horas = $h;
            $this->sahoras = $sh;
        }
        public function calcular(){
            $valortotal = $this->horas * $this->sahoras;
            $this->salario_liquido = ($this->salario_bruto + $valortotal) - 0.08;

            return $this->salario_liquido;
        }



    }

?>