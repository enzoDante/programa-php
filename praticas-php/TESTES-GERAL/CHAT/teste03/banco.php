<?php
    $host = 'localhost';
    $user = 'root';
    $ps = '';
    $db = 'chat001';
    $conn = new mysqli($host, $user, $ps, $db);
    if($conn->connect_error){
        die("Falha ao tentar conectar: ".$conn->connect_error);
    }


?>