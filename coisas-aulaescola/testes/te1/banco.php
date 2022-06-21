<?php
    $host = "localhost";
    $user = "root";
    $ps = "";
    $banco = "aulaPHPmysql";
    #$porta = "3306"; nn parece necessário
    $conn = new mysqli($host, $user, $ps, $banco);
    if($conn->connect_error){
        die("Falha ao tentar conectar: ".$conn->connect_error);
    }


?>