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

        $resultados = $ligacao->query(" SELECT nome FROM usuarios WHERE nome='$usuario'");
        $resultados2 = $ligacao->query("SELECT email FROM usuarios WHERE email = '$email'");

        if(($resultados->num_rows != 0) || ($resultados2->num_rows != 0)){
            echo "conta com esse nome ou email ja existe!!!";
            echo "<br><a href='public/view_cadastro_login.php'>Voltar</a>";
        }else{
            $sql = "insert into usuarios (nome,email,senha) values('$usuario','$email','$senha')";
    
            mysqli_query($ligacao, $sql);
            echo "cadastrado com sucesso!!!";
            echo "<a href='public/view_cadastro_login.php'>Fazer login</a>";

        }

        //exit();

    }
?>