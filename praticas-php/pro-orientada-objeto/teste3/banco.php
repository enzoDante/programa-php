<?php
    class banco{
        private $local = 'localhost';
        private $bdc = 'bancoteste3poo';
        private $user = 'root';
        private $pass = '';
        public $conn;

        function __construct(){
            $this->conn = mysqli_connect($this->local, $this->user, $this->pass, $this->bdc);
        }
        public function comandosql($sql){
            $valsql = mysqli_query($this->conn, $sql);
            return $valsql;
        }
    }


?>