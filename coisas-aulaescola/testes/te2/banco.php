<?php
    class Banco{
        private $host = 'localhost';
        private $user = 'root';
        private $ps = '';
        private $db = 'aulaphpmysql';
        private $conn=null;

        private function conectar(){
            $this->conn = new mysqli($this->host, $this->user, $this->ps, $this->db);
            if($this->conn->connect_error){
                die("Falha ao conectar: ".$this->conn->connect_error);
            }
        }
        public function getconn(){
            if($this->conn == null){
                $this->conectar();
            }
            return $this->conn;
        }

    }


?>