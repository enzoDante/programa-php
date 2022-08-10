<?php
    $host = 'localhost';
    $user = 'root';
    $ps = '';
    $db = 'registros_vendas';
    $conn = new mysqli($host, $user, $ps, $db);
    if($conn->connect_error){
        die("Falha ao tentar conectar: ".$conn->connect_error);
    }

?>