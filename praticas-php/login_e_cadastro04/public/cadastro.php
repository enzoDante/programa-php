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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: cadastro.php");
                exit();
            }
        }
    ?>
    <header>

    </header>
    <nav>

    </nav>
    <?php if(!isset($_SESSION['idUsu'])): ?>
        <form id="form" enctype="multipart/form-data" autocomplete="on" action="cadastroC.php" method="post">
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
            <fieldset>
                <legend><label for="isenha2">Confirmar senha:</label></legend>
                <input type="password" name="senha2" id="isenha2" required autocomplete="current-password">
            </fieldset>
                <label for="iimgp"><img id="perfil" src="../imagens/blank-profile-picture.png" alt=""></label>
                <input type="file" onchange="carregar(event)" name="imgp" accept="image/*" id="iimgp" value="../imagens/blank-profile-picture.png">
                <p>OBS: a imagem fica salva em seu tamanho original!</p>
                
            <button type="submit">Cadastrar</button>

        </form>
    <?php else: ?>
        <h1>Você já está logado(a)!!</h1>
        <a href="cadastro.php?a=logout">Sair</a>
    <?php endif; ?>
    <script src="imgperfil.js"></script>
</body>
</html>