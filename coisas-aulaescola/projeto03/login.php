<?php 
    include "banco.php";
    session_start();

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <header>
        <h1>Logar</h1>
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
                    <a href="criar_turma.php">Criar turma</a>
                    <a href="criar_tipoPost.php">Criar tipo post</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="perfil.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <div><br>
            <?php if(!isset($_SESSION['id_unico'])): ?>
                <form action="criar_logarC.php" method="post" autocomplete="on">
                    <div>
                        <label for="iemail">E-mail:</label>
                        <input type="email" name="email" id="iemail" autocomplete="email">
                    </div>
                    <div>
                        <label for="isenha">Senha:</label>
                        <input type="password" name="senha" id="isenha">
                    </div>
                    <button id="btncriar" type="submit">Login</button>
                    <a href="criar_conta.php" id="contaexistente">Criar</a>
                </form><br>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>