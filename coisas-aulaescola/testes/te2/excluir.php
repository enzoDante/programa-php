<?php
    include "class_cliente.php";
    if(!isset($_GET['id'])){
        die("id não encontrado");
    }
    $id = $_GET['id'];
    $cliente = new cliente();
    $cliente->setid($id);
    $cliente->excluir();
    header("Location: olha_todos.php");
?>