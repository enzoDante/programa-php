<?php
    include "banco.php";

    $sql = "SELECT * FROM Cliente;";
    #executa o sql no query, e armazena os valores em resultado
    if($resultado = $conn->query($sql)){
        #passa por todos os registros do resultado 
        while($linha = $resultado->fetch_object()){
            $id = $linha->idCliente;
            echo $linha->idCliente.", ";
            echo $linha->nome.", ";
            echo $linha->email.", ";
            echo $linha->senha.", ";
            echo $linha->nascimento.", ";
            echo $linha->salario."  ";
            echo "<a href='excluir.php?id=$id'>Excluir registro</a>   ";
            echo "<a href='alterar.php?id=$id'>alterar</a><br><br>";
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
    <a href="index.php">index php aq</a>
    <a href="um_usu.php">escolha alguém p ver aq</a>
    
</body>
</html>