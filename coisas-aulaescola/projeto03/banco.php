<?php
    $host = 'localhost';
    $user = 'root';
    $ps = '';
    $db = 'uniPosts';
    $conn = new mysqli($host, $user, $ps, $db);
    if($conn->connect_error){
        die("Falha ao tentar conectar: ".$conn->connect_error);
    }


?>