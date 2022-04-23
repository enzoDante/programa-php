<?php
    include "../usuario.php";
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Titulo</h1>
    </header>
    <nav>
        <?php
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy();
                    header("Location: index.php");
                    exit();
                }
            }
        ?>

        <a href="#">Home</a>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <p>logado <?php echo $_SESSION['nome']; ?></p>
            <a href="index.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>

    </main>
    
</body>
</html>