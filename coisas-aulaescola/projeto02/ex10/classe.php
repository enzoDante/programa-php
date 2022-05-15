<?php
    class arq{
        private $nome;
        private $email;
        private $tel;
        private $emp;
        private $as;
        private $msg;

        public function criararquivo(){
            #date('d/m/Y H:i');
            $nome = $this->getn();
            $email = $this->gete();
            $tel = $this->gettel();
            $emp = $this->getem();
            $as = $this->geta();
            $msg = $this->getmsg();
            $hoje = date('d-m-Y');
            $titulo = "arquivos/";
            $titulo .= "$hoje";
            $titulo .= "_$email.txt";

            $ponteiro = fopen($titulo, 'w');
            if($ponteiro == false){
                $m = "Não foi possível criar o arquivo!";
                return $m;
            }
            $dados = "Nome: $nome\nEmail: $email\nTel: $tel\nEmpresa> $emp\n\nAssunto: $as\n\n$msg";
            fprintf($ponteiro, $dados);
            fclose($ponteiro);
            $m = "Arquivo gravado com sucesso!!!";
            return $m;
            

        }

        public function setvalues($n, $e, $t, $empresa, $as, $ms){
            $this->nome = $n;
            $this->email = $e;
            $this->tel = $t;
            $this->emp = $empresa;
            $this->as = $as;
            $this->msg = $ms;
        }
        public function getn(){
            return $this->nome;
        }
        public function gete(){
            return $this->email;
        }
        public function gettel(){
            return $this->tel;
        }
        public function getem(){
            return $this->emp;
        }
        public function geta(){
            return $this->as;
        }
        public function getmsg(){
            return $this->msg;
        }

    }


?>