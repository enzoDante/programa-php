<?php
    include "banco.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = strip_tags($_POST['id']);

        #mesma coisa q o arquivo "olha_usus.php" mas é um usuário em específico escolhido pelo nº de id
        $preparar = $conn->prepare("SELECT * FROM Cliente WHERE idCliente = ?;");
        $preparar->bind_param("i", $id);
        $preparar->execute();

        $resultado = $preparar->get_result();
        while($linha = $resultado->fetch_object()){
            echo $linha->idCliente.", ";
            echo $linha->nome.", ";
            echo $linha->email.", ";
            echo $linha->senha.", ";
            echo $linha->nascimento.", ";
            echo $linha->salario."<br>";
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
<body><br>
    <form action="um_usu.php" method="post">
        <input type="number" name="id" id="" placeholder="Número do usuario"><br>
        <button type="submit">procurar</button>
    </form>
<br>
    <a href="index.php">Index aq</a><br>
    <a href="olha_usus.php">Todos usuarios aq</a>
    
</body>
</html>