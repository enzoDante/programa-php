<?php
$host = 'localhost';
$user = 'root';
$ps = '';
$bd = 'bancoteste1';

$con = new mysqli($host, $user, $ps, $bd);
if($con->connect_error){
    die("Falha ao conectar com o banco");
}

?>