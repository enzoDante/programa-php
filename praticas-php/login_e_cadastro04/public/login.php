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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: login.php");
                exit();
            }
        }
    ?>
    <header>

    </header>
    <nav>

    </nav>
    <main>
        <?php if(!isset($_SESSION['idUsu'])): ?>
            <form action="loginC.php" method="post">
                <fieldset>
                    <legend><label for="inome">Nome:</label></legend>
                    <input type="text" name="nome" id="inome" required autocomplete="username">
                </fieldset>
                <fieldset>
                    <legend><label for="iemail">E-mail:</label></legend>
                    <input type="email" name="email" id="iemail" required autocomplete="email">
                </fieldset>
                <fieldset>
                    <legend><label for="isenha">Senha:</label></legend>
                    <input type="password" name="senha" id="isenha" required autocomplete="current-password">
                </fieldset>
                    
                <button type="submit">Logar</button>
            </form>
        <?php else: ?>
            <a href="login.php?a=logout">Sair</a>
        <?php endif; ?>
    </main>    
    
</body>
</html>