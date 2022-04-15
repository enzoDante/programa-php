<?php
    class banco{
        private $local = "localhost";
        private $user = "root";
        private $pass = "";
        private $bdnome = "bancoteste2poo";
        public $conn;

        //acontece imediatamente ao criar esse objeto
        function __construct(){ 
            $this->conn = mysqli_connect($this->local, $this->user, $this->pass, $this->bdnome);

        }

        //uma função para executar o comando sql com o banco de dados
        public function comandosql($sql){
            $valorsql = mysqli_query($this->conn, $sql);
            return $valorsql;
        }


    }


?>