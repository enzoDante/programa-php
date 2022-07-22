<?php
    include "../usuario.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/styles.css">
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
    <header>
        
    </header>
    <nav>

    </nav>
    <main>
        <h1>Nada aq por enquanto</h1>
        <?php if(isset($_SESSION['idUsu'])): ?>
            <h2>Olá <?php echo $_SESSION['nome']; ?></h2>
            <h2>email <?php echo $_SESSION['email']; ?></h2>
            <img src="<?php echo $_SESSION['imgperfil']; ?>" alt="">
            <a href="cadastro.php?a=logout">Sair</a>

        <?php endif; ?>
    </main>
</body>
</html>