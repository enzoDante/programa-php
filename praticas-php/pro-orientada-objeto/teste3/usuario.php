<?php
    include "banco.php";
    class usuario{
        private $nome;
        private $email;
        private $senha;
        private $bd;

        function __construct(){
            $this->bd = new banco();
        }
        //=========cadastro===============
        public function cadastro(){
            $nome = $this->getnome();
            $email = $this->getemail();
            $senha = $this->getsenha();
            $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome = '$nome' OR email='$email'");

            if($sql->num_rows != 0){
                return "<p>Conta existente</p>";
            }else{
                $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
                $this->bd->comandosql($sql);
                //===========sistema de login logo após criar conta=====================
                $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' AND senha='$senha'");
                $dados = $sql->fetch_assoc();

                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];
                return "<p>Seja bem vindo(a) $nome</p>";


            }
        }
        //=================Login=========================
        public function login(){
            $nome = $this->getnome();
            $senha = $this->getsenha();

            $sql = $this->bd->conn->query("SELECT * FROM usuario WHERE senha='$senha' AND nome='$nome'");
            if($sql->num_rows == 0){
                return "<p>Conta inexistente</p>";
            }else{
                $dados = $sql->fetch_assoc();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];
                return "<p>Seja bem vindo(a) $nome</p>";
            }
        }

        //=============nome===============
        public function setnome($n){
            $this->nome = $n;
        }
        public function getnome(){
            return $this->nome;
        }
        //============email===============
        public function setemail($e){
            $this->email = $e;
        }
        public function getemail(){
            return $this->email;
        }
        //============senha============
        public function setsenha($s){
            $this->senha = md5($s);
        }
        public function getsenha(){
            return $this->senha;
        }
    }


?>