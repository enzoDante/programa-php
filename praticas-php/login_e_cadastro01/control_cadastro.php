<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: #47df86;
        }
        header{
            min-width: 200px;
            height: 100px;
            padding: 20px;
            background-color: #00aeff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cadastro</h1>
    </header>
    
</body>
</html>

<?php
    include "banco_de_dados.php";
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);

        $sql = "insert into usuarios (nome,email,senha) values('$usuario','$email','$senha')";

        mysqli_query($ligacao, $sql);
        echo "cadastrado com sucesso!!!";
        echo "<a href='view_cadastro_login.php'>Fazer login</a>";
        //exit();

    }
?>