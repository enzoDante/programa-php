<?php 
    include "ligacao.php";
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $i = $_POST['id'];
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        
        $s = "insert into usuario (id_u, nome, idade) values($i, '$nome', $idade)";
        mysqli_query($conn, $s);
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tituloo</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="id" id=""><br>
            <input type="text" name="nome" id=""><br>
            <input type="number" name="idade" id=""><br>
            <button type="submit">enviar</button>

        </form>

    </main>
    
</body>
</html>