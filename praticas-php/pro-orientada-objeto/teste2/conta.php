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
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: index.php");
                exit();
            }
        }
    ?>



    <main>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>configuração de conta</p>
            <a href="conta/nome.php">Nome--- <?php echo $_SESSION['nome']; ?></a><br>
            <a href="conta/email.php">Email--- <?php echo $_SESSION['email']; ?></a><br>
            <a href="conta/senha.php">Senha--- *********</a>
            <br><br>
            <a href="index.php">index</a><br>
            <br>
            <a href="conta.php?a=logout">sair da conta</a>
        <?php else: ?>
            <p>Você precisa estar logado para acessar esta página!!!</p>

        <?php endif; ?>

    </main>
    
</body>
</html>