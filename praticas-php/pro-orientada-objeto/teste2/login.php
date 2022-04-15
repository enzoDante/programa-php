<?php
    include "usuario.php";
    session_start();

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
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usu = new usuario();
            $usu->atribuirnome($nome);
            $usu->atribuiremail($email);
            $usu->atribuirsenha($senha);

            $usu->login();


        } 
    
    ?>


    <?php
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: login.php");
                exit;
            }
        }
    ?>

    <?php if(!isset($_SESSION['id_usuario'])): ?>
        <form action="login.php" id="formu" method="post">
            <input type="text" name="nome" placeholder="nome" id="nome"><br>
            <input type="text" name="email" placeholder="email" id="email"><br>
            <input type="password" name="senha" placeholder="senha" id="senha"><br>
            <input type="password" name="" placeholder="confirmar senha" id="confsenha"><br>
            <button type="submit" onclick="impede()">logar</button>
        </form><br><br>

        <br><br><a href="cadastro.php">cadastro</a><br>
    <?php else: ?>
        <p>logado = <?php echo $_SESSION['nome']; ?></p>
        <a href="index.php">index</a><br>
        <a href="login.php?a=logout">logout sair</a>

    <?php endif; ?>

    <script src="codigo.js"></script>
</body>
</html>