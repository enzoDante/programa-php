<?php
    include "banco.php";
    class usuario{
        private $nome;
        private $email;
        private $senha;
        private $desc;
        private $imgf;
        private $imgp;
        private $banc;

        function __construct(){
            $this->banc = new banco();
        }
        #==============================cadastro=======================================
        public function cadastrar(){
            #=============verificar se ja existe essa conta===============
            $stmt = $this->banc->getcon()->prepare("select * from usuario where email=? or nome=?");
            $stmt->bind_param("ss", $this->email,$this->nome);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $verificar = "";
            while($linha = $resultado->fetch_object()){
                $verificar = $linha->nome;
            }

            #==================cadastrando e logando==============================
            if($verificar == ""){
                $stmt = $this->banc->getcon()->prepare("insert into usuario (nome,email,senha,imgperfil) values(?,?,?,?)");
                $stmt->bind_param("ssss",$this->nome,$this->email,$this->senha,$this->imgp);
                $stmt->execute();

                $stmt = $this->banc->getcon()->prepare("select * from usuario where email=? and senha=?");
                $stmt->bind_param("ss", $this->email,$this->senha);
                $stmt->execute();

                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $_SESSION['idUsu'] = $linha->idUsu;
                    $_SESSION['nome'] = $linha->nome;
                    $_SESSION['email'] = $linha->email;
                    $_SESSION['imgperfil'] = $linha->imgperfil;
                    $_SESSION['imgfundo'] = $linha->imgfundo;
                    $_SESSION['descricao'] = $linha->descricao;
                }
            }else{
                echo "<h2>Conta existente!</h2>";
            }
            return $verificar;

            
        }

        #===========================login==============================================
        public function logar(){
            $stmt = $this->banc->getcon()->prepare("select * from usuario where email=? and senha=?");
            $stmt->bind_param("ss", $this->email,$this->senha);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $verificar = "";
            while($linha = $resultado->fetch_object()){
                $_SESSION['idUsu'] = $linha->idUsu;
                $verificar = $linha->nome;
                $_SESSION['nome'] = $linha->nome;
                $_SESSION['email'] = $linha->email;
                $_SESSION['imgperfil'] = $linha->imgperfil;
                $_SESSION['imgfundo'] = $linha->imgfundo;
                $_SESSION['descricao'] = $linha->descricao;
            }
            return $verificar;
        }

        #======================alterar nome email e descricao==========================
        public function alterarned(){
            #verificando se nome ou email ja existe!
            $stmt = $this->banc->getcon()->prepare("select * from usuario where email=? or nome=?");
            $stmt->bind_param("ss", $this->email,$this->nome);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $verificar = "";
            $verificar2 = "";
            while($linha = $resultado->fetch_object()){
                if($linha->nome != $_SESSION['nome'])
                    $verificar = $linha->nome;
                if($linha->email != $_SESSION['email'])
                    $verificar2 = $linha->email;
            }

            #============
            if(($verificar == "") && ($verificar2 == "")){
                $stmt = $this->banc->getcon()->prepare("update usuario set nome=?,email=?,descricao=? where idUsu=?");
                $stmt->bind_param("sssi",$this->nome,$this->email,$this->desc,$_SESSION['idUsu']);
                $stmt->execute();
                $_SESSION['nome'] = $this->nome;
                $_SESSION['email'] = $this->email;
                $_SESSION['descricao'] = $this->desc;
            }else{
                echo "<script>alert('nome ou email existentes!')</script>";
            }
        }
        #==============================alterar senha===================================
        public function alterarsenha(){
            $stmt = $this->banc->getcon()->prepare("update usuario set senha=? where idUsu=?");
            $stmt->bind_param("si",$this->senha,$_SESSION['idUsu']);
            $stmt->execute();
        }
        #==============================alterar img perfil===================================
        public function alterarimgp(){
            $_SESSION['imgperfil'] = $this->imgp;
            $stmt = $this->banc->getcon()->prepare("update usuario set imgperfil=? where idUsu=?");
            $stmt->bind_param("si",$this->imgp,$_SESSION['idUsu']);
            $stmt->execute();

        }

        public function setn($val){
            $this->nome = $val;
        }
        public function sete($val){
            $this->email = $val;
        }
        public function sets($val){
            $this->senha = $val;
        }
        public function setd($val){
            $this->desc = $val;
        }
        public function setimgf($val){
            $this->imgf = $val;
        }
        public function setimgp($val){
            $this->imgp = $val;
        }

    }

?>