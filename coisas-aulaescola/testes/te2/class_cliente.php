<?php
    include "banco.php";
    class cliente{
        private $id;
        private $nome;
        private $email;
        private $senha;
        private $data;
        private $salario;
        private $banco;

        function __construct() {
            $this->banco = new Banco();
        }
        
        public function cadastrar(){
            $stmt = $this->banco->getconn()->prepare("insert into Cliente (nome,email,senha,nascimento,salario) values(?,?,?,?,?)");
            $stmt->bind_param("sssss",$this->nome,$this->email,$this->senha,$this->data,$this->salario);
            $stmt->execute();
        }

        public function excluir(){
            $stmt = $this->banco->getconn()->prepare("delete from Cliente where idCliente = ?");
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
        }

        public function atualizar(){
            $stmt = $this->banco->getconn()->prepare("update Cliente set nome=?,email=?,senha=?,salario=?,nascimento=? where idCliente=?");
            $stmt->bind_param("sssssi",$this->nome,$this->email,$this->senha,$this->salario,$this->data,$this->id);
            $stmt->execute();
        }

        public function olhaum($id){
            $stmt = $this->banco->getconn()->prepare("select * from Cliente where idCliente=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $resultado = $stmt->get_result();
            while($linha = $resultado->fetch_object()){
                $this->setid($linha->idCliente);
                $this->setnome($linha->nome);
                $this->setemail($linha->email);
                $this->setsenha($linha->senha);
                $this->setdata($linha->nascimento);
                $this->setsalario($linha->salario);
            }
            return $this;
        }

        public function olhatudo(){
            $stmt = $this->banco->getconn()->prepare("select * from Cliente");
            $stmt->execute();
            $resultado = $stmt->get_result();

            $vetor = array();
            $i = 0;
            while($linha = mysqli_fetch_object($resultado)){
                $vetor[$i] = new cliente();
                $vetor[$i]->setid($linha->idCliente);
                $vetor[$i]->setnome($linha->nome);
                $vetor[$i]->setemail($linha->email);
                $vetor[$i]->setsenha($linha->senha);
                $vetor[$i]->setdata($linha->nascimento);
                $vetor[$i]->setsalario($linha->salario);
                $i++;
            }
            return $vetor;
        }


        public function setid($value){
            $this->id = $value;
        }
        public function getid(){return $this->id;}
        public function setnome($value){
            $this->nome = $value;
        }
        public function getnome(){return $this->nome;}
        public function setemail($value){
            $this->email = $value;
        }
        public function getemail(){return $this->email;}
        public function setsenha($value){
            $this->senha = $value;
        }
        public function getsenha(){return $this->senha;}
        public function setdata($value){
            $this->data = $value;
        }
        public function getdata(){return $this->data;}
        public function setsalario($value){
            $this->salario = $value;
        }
        public function getsalario(){return $this->salario;}

    }


?>