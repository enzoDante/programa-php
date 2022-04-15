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
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Logar</a><br>
            <a href="cadastro.php">cadastrar</a>
        <?php else: ?>
            <p>logado = <?php echo $_SESSION['nome']; ?></p><br>
            <a href="index.php?a=logout">logout sair</a>
        <?php endif; ?>

    </main>
    
</body>
</html>