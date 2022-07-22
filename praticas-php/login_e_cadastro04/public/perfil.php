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
        <?php if(isset($_SESSION['idUsu'])): ?>
            <!--=========================nome email descricao========================-->
            <form action="alterarned.php" method="post">
                <fieldset>
                    <legend><label for="inome">Nome:</label></legend>
                    <input type="text" name="nome" id="inome" required value="<?php echo $_SESSION['nome']; ?>">
                </fieldset>
                <fieldset>
                    <legend><label for="iemail">E-mail:</label></legend>
                    <input type="email" name="email" id="iemail" required value="<?php echo $_SESSION['email']; ?>">
                </fieldset>
                <fieldset>
                    <legend><label for="idesc">Descrição:</label></legend>
                    <textarea name="desc" id="idesc" cols="30" rows="10"><?php echo $_SESSION['descricao']; ?></textarea>
                </fieldset>
                <button type="submit">Salvar</button>
            </form><br><br><br><br>
            <!--==========================senha==============================-->
            <form action="alterarsenha.php" method="post">
                <fieldset>
                    <legend><label for="isenha">Senha:</label></legend>
                    <input type="password" name="senha" id="isenha" required autocomplete="current-password">
                </fieldset>
                <fieldset>
                    <legend><label for="isenha2">Confirmar senha:</label></legend>
                    <input type="password" name="senha2" id="isenha2" required autocomplete="current-password">
                </fieldset>
                <button type="submit">Salvar</button>
            </form><br><br><br><br>
            <!--==========================imagem de perfil==============================-->
            <form action="alterarimgp.php" enctype="multipart/form-data" method="post">
                <label for="iimgp"><img id="perfil" src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></label>
                <input type="file" onchange="carregar(event)" accept="image/*" name="imgp" id="iimgp" value="<?php echo $_SESSION['imgperfil']; ?>">
                <p>OBS: a imagem fica salva em seu tamanho original!</p>
                <p>Caso selecionou uma imagem e você não deseja trocar, basta apertar f5!</p>
                <button type="submit">Salvar</button>
            </form><br><br><br><br>
            <a href="perfil.php?a=logout">Sair</a>
        <?php endif; ?>
        <script src="imgperfil.js"></script>
    </main>
    
</body>
</html>