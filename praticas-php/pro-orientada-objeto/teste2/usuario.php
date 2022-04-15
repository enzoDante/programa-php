<?php 
    include "banco.php";

    class usuario{
        private $nome;
        private $email;
        private $senha;
        private $bd;


        //=====nova ligação com o banco==========
        function __construct(){
            $this->bd = new banco();
        }

        //========cadastro============
        public function cadastrar(){
            $nome = $this->returnnome();
            $email = $this->returnemail();
            $senha = $this->returnsenha();
            

            $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' AND email='$email'");

            if($sql->num_rows != 0){
                return "<p>conta existente</p>";
            }else{
                
                $sql = "INSERT INTO usuario (nome, email, senha) values('$nome','$email','$senha')";
                $this->bd->comandosql($sql);
                

                $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' AND senha='$senha'");             
                $dados = $sql->fetch_assoc();

                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];


                return "cadastrado";
            }
        }

        //===============login====================
        public function login(){
            $nome = $this->returnnome();
            #$email = $this->returnemail();
            $senha = $this->returnsenha();

            $sql = $this->bd->conn->query("SELECT * FROM usuario WHERE senha='$senha' AND nome='$nome'");

            if($sql->num_rows == 0){
                return "<p>Login inválido</p>";
            }else{

                $dados = $sql->fetch_assoc();

                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];
                return "<p>logado</p>";
            }
        }




        //=================nome=============================
        public function atribuirnome($nome){
            $this->nome = $nome;
        }
        public function returnnome(){
            return $this->nome;
        }

        //===================email=======================
        public function atribuiremail($email){
            $this->email = $email;
        }
        public function returnemail(){
            return $this->email;
        }

        //================senha=====================
        public function atribuirsenha($senha){
            $this->senha = md5($senha);
        }
        public function returnsenha(){
            return $this->senha;
        }


    }


?>