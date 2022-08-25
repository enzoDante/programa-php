<?php

    $host = "localhost";
    $user = 'root';
    $ps = '';
    $banco = "banco_projeto03";

    $con = new mysqli($host, $user, $ps, $banco);
    if($con->connect_error){
        die("Falha ao tentar conectar: ".$con->connect_error);
    }


?>