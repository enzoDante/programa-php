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
            $sql = $this->bd->comandosql("SELECT * FROM usuario WHERE nome='$nome' OR email='$email'");

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

        //==================atualizar perfil===================
        public function atualizarnome($id){
            //precisa do id para fazer select do update
            $nome = $this->returnnome(); //atribui o nome inserido pelo usuario

            //verifica se o nome digitado existe na tabela
            $sql = "SELECT * FROM usuario WHERE nome='$nome'";
            $sql = $this->bd->comandosql($sql);

            if($sql->num_rows == 0){
                //caso não exista, fará o update abaixo usando o id
                $sql = "UPDATE usuario set nome='$nome' where id_usuario=$id";
                $this->bd->comandosql($sql);

                //seleciona tudo novamente para atribuir o novo valor para a session
                $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
                $sql = $this->bd->comandosql($sql);
                $dados = $sql->fetch_assoc();
                $_SESSION['nome'] = $dados['nome'];
                return "nome atualizado com sucesso ".$_SESSION['nome'];
            }else{
                return "nome existente!!! digite outro nome";
            }

        }

        public function atualizaremail($id){
            $email = $this->returnemail();
            $sql = "SELECT * FROM usuario WHERE email='$email'";
            $sql = $this->bd->comandosql($sql);
            if($sql->num_rows == 0){
                $sql = "UPDATE usuario set email='$email' where id_usuario=$id";
                $this->bd->comandosql($sql);

                $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
                $sql = $this->bd->comandosql($sql);
                $dados = $sql->fetch_assoc();

                $_SESSION['email'] = $dados['email'];
                return "email atualizado com sucesso ".$_SESSION['email'];
            }else{
                return "Email existente!!! digite outro";
            }
        }
        //===============atualizar senha========================
        public function atualizarsenha($id){
            $senha = $this->returnsenha();
            //hora de zuar um pouco xD, posso fazer com q mostre de quem é a conta caso o usuario digite ela!
            //ficará p próxima kkkkkk

            //no caso da senha é mais simples, usuarios podem ter a mesma senha :)
            $sql = "UPDATE usuario set senha='$senha' where id_usuario=$id";
            $sql = $this->bd->comandosql($sql);
            return "senha atualizada!!!";

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