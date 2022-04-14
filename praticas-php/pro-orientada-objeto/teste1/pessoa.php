<?php 
    class usuario{
        private $nome;
        private $idade;
        private $profisao;
        private $nota1;
        private $nota2;
        private $media;

        //=============valores iniciais(ao criar um novo objeto)=============
        public function usuario(){
            $this->nota1 = 0;
            $this->nota2 = 0;
            $this->lista = 0;
        }

        //===========calcula a média======================================
        public function calcular(){
            $this->media = ($this->nota1 + $this->nota2)/2.0;

            $this->media += $this->lista;
        }

        //====================retorna media================
        /*public function atribuirmedia($value){
            $this->media = $value;
        }*/
        public function retornarmedia(){
            return $this->media;
        }

        //=================nota1===========================
        public function atribuirnota($n){
            $this->nota1 = $n;
        }
        public function retornarnota(){
            return $this->nota1;
        }

        //=================nota2=======================
        public function atribuirnota2($n){
            $this->nota2 = $n;
        }
        public function retornarnota2(){
            return $this->nota2;
        }

        //==================lista====================
        public function atribuirlista($l){
            $this->lista = $l;
        }
        public function retornarlista(){
            return $this->lista;
        }

        //=================nome===================================================
        public function atribuirnome($nomenovo){
            $this->nome = $nomenovo; #atribui a variável nome
        }

        public function retornarnome(){
            return $this->nome; #se for mostrar a variável, esse parametro retorna o valor do nome
        }

        //===================idade===================
        public function atribuiridade($ida){
            $this->idade = $ida;
        }
        public function retornaridade(){
            return $this->idade;
        }

        //===================profisao========================
        public function atribuirprofisao($profis){
            $this->profisao = $profis;
        }
        public function retornarprofisao(){
            return $this->profisao;
        }
    }

?>