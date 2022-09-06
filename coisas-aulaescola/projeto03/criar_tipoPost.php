<?php
    include "banco.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: criar_tipoPost.php");
                exit();
            }
        }
    
    ?>
    <header>
        <h1>Cadastrar</h1>
    </header>
    <nav>
        <div id="navegador">
            <div id="nav">
                <div id="left">
                    <h3>Nome Site</h3>
                </div>
                <div>
                    <a href="pag_principal.php">Home</a>
                    <a href="pag_busca.php">Buscar</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="criar_turma.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <div><br>
            <form action="criar_tipoPostC.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div>
                    <label for="itpsot">Criar tipo post</label>
                    <input type="text" name="tpost" id="itpost" placeholder="">
                </div>
                <button id="btncriar" type="submit">Criar tipo post</button>
            </form><br>

        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
</body>
</html>