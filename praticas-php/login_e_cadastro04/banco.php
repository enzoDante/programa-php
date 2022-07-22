<?php
    class banco{
        private $host = 'localhost';
        private $user = 'root';
        private $ps = '';
        private $db = 'cadastro004';
        private $conn = null;

        private function con(){
            $this->conn = new mysqli($this->host, $this->user, $this->ps, $this->db);
            if($this->conn->connect_error){
                die("Falha ao conectar: ".$this->conn->connect_error);
            }
        }
        function getcon(){
            if($this->conn == null){
                $this->con();
            }
            return $this->conn;
        }

    }