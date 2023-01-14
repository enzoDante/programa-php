<?php
    $host = "localhost";
    $user = "root";
    $ps = '';
    $db = "bancoteste1";

    $con = new mysqli($host, $user, $ps, $db);
    if($con->connect_error){
        die("Falha ao conectar com o banco");
    }
?>