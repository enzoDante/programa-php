<?php
    include "banco.php";

    $id = $_POST['id'];
    #$idCliente = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $salario = $_POST['salario'];
    $nascimento = $_POST['nascimento'];

    $preparar = $conn->prepare("UPDATE Cliente SET nome=?, email=?, senha=?, salario=?, nascimento=? WHERE idCliente=?;");
    $preparar->bind_param("ssssss", $nome, $email, $senha, $salario, $nascimento, $id);
    $preparar->execute();
    header("Location: alterar.php?id=".$id);

?>