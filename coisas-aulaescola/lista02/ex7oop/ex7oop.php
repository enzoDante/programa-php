<?php
    class aluno{
        private $nota1;
        private $nota2;
        private $nota3;
        private $media;

        public function setval($n1, $n2, $n3){
            $this->nota1 = $n1;
            $this->nota2 = $n2;
            $this->nota3 = $n3;
        }

        public function calcular(){
            $this->media = number_format(($this->nota1 + $this->nota2 + $this->nota3)/3, 1, ',');
            return $this->media;
        }

    }

?>