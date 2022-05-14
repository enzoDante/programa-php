<?php
    class tabela{
        private $nome = array();
        private $nota = array();
        private $alunonota;
        private $maiornota;
        private $i = 0;

        public function melhoraluno($n, $no){
            for($x = 0; $x <= 9; $x++){
                if($no > $this->maiornota){
                    $this->maiornota = $no;
                    $this->alunonota = $n;
                }
            }
            return $this->alunonota;
        }

        public function setvalores($n1, $n2){
            if($this->i <= 9){
                array_push($this->nome, $n1);
                array_push($this->nota, $n2);
                $this->i += 1;
            }else{
                $this->i = 0;
                $nome = $this->getn();
                $nota = $this->getnota();
                $a = $this->melhoraluno($nome, $nota);
                return $a;
            }
            return $this->i;

        }
        public function getn(){
            return $this->nome;
        }
        public function getnota(){
            return $this->nota;
        }

    }


?>