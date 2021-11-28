<?php 
    include "banco_de_dados.php";
    session_start();



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
        <h1>Sistema de cadastro e login</h1>
    </header>
    <nav><a href="pagina1.php">pagina1</a>
        <a href="alterardados.php">Perfil</a>
    </nav>
    <?php if(!isset($_SESSION['id_usuario'])) : ?>

        <main>
            <form action="control_cadastro.php" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome:" required autocomplete="off">
                <input type="email" name="email" id="email" placeholder="E-mail:" required>
                <input type="password" name="senha" id="senha" placeholder="Senha:" required>
                <input type="password" id="rsenha" placeholder="Repita a senha:" required>
                <button type="submit" onclick="validarc()">Cadastrar</button>
            </form>
            
            <form action="control_login.php" method="post">
                <input type="text" name="nome" id="nome" autocomplete="off" placeholder="Nome:" required>
                <input type="password" name="senha" id="senha" placeholder="Senha:" required>
                <button type="submit" onclick="validarl()">Entrar</button>
            </form>
        </main>
    <?php else: ?>
        <p>logado!</p><br>
        <a href="pagina1.php">Entrar</a>
    <?php endif; ?>
</body>
</html>