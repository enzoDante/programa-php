<?php 
    include "banco.php";

    class usuario{
        //objeto usuario com seus atributos
        private $nome;
        private $email;
        private $senha;
        private $bd;


        //=====nova ligação com o banco==========
        function __construct(){
            //cria um objeto com bd
            $this->bd = new banco();
        }

        //========cadastro============
        public function cadastrar(){
            //funções para retornar valores
            $nome = $this->returnnome();
            $email = $this->returnemail();
            $senha = $this->returnsenha();
            
            //sql recebe tudo da tabela usuario em q procura nome e email igual ao q pessoa digitou
            $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' AND email='$email'");

            //verifica se existe alguma linha com esses valores
            if($sql->num_rows != 0){
                return "<p>conta existente</p>";
            }else{
                //sql recebe um comando sql, irá inserir valores no banco de dados
                $sql = "INSERT INTO usuario (nome, email, senha) values('$nome','$email','$senha')";
                //inserindo esses valores com bd (bd é o objeto ligado ao banco.php)
                $this->bd->comandosql($sql);
                
                //sql recebe tudo da tabela q nome e senha digitado pelo usuario
                $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' AND senha='$senha'");
                //dados recebe os valores parcelado do sql, como se fosse array          
                $dados = $sql->fetch_assoc();

                //session para logar esse novo usuario cadastrado
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

            //outra forma de executar o código sql, conn é uma variável do banco.php q faz a ligação com o banco de dados
            $sql = $this->bd->conn->query("SELECT * FROM usuario WHERE senha='$senha' AND nome='$nome'");

            //verifica se não existe os valores do sql
            if($sql->num_rows == 0){
                return "<p>Login inválido</p>";
            }else{

                //recebe tudo do sql como se fosse array
                $dados = $sql->fetch_assoc();

                //com session_start() sistema de login com sessão
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];
                return "<p>logado</p>";
            }
        }


        //=================nome=============================
        public function atribuirnome($nome){
            //nome digitado pelo usuário será atribuido para o objeto
            $this->nome = $nome;
        }
        public function returnnome(){
            //retorna esse valor nome para o usuário
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