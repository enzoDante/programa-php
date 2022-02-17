<?php 
    include "../banco.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="cadastro.php">cadastroooo</a>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                echo "cabooo";
                header("Location: login.php");
                exit();
            }
        }
    ?>
    <?php if(isset($_SESSION['id_usuario'])): ?>
        <a href="login.php?a=logout">logout</a>
    <?php endif; ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);
            $resultado = $ligacao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'");

            if($resultado->num_rows == 0){
                echo "login inválido!!!";
            }else{
                $dados_usuario = $resultado->fetch_assoc();

                $_SESSION['id_usuaio'] = $dados_usuario['id_usuario'];
                $_SESSION['nome'] = $dados_usuario['nome'];
                $_SESSION['email'] = $dados_usuario['email'];
                echo "logadoa goraaarara <a href='index.php'>principalllll</a>";
                exit();
            }
        }
    ?>
    <a href="index.php">principalllll</a>
    <main>


        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="login.php" method="post">
                <p>email:</p>
                <input type="text" name="email" id="">
                <p>senha</p>
                <input type="password" name="senha" id="">
                <button type="submit">logar</button>
            </form>
        <?php else: ?>
            <p>logado!!!</p>
        <?php endif; ?>
    </main>
    
</body>
</html>