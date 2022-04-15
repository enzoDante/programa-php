<?php
    class banco{
        private $local = "localhost";
        private $user = "root";
        private $pass = "";
        private $bdnome = "bancoteste2poo";
        public $conn;

        function __construct(){
            $this->conn = mysqli_connect($this->local, $this->user, $this->pass, $this->bdnome);

        }

        public function comandosql($sql){
            $valorsql = mysqli_query($this->conn, $sql);
            return $valorsql;
        }


    }


?>