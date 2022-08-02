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
    <link rel="stylesheet" href="estilos/modal.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: criar_conta.php");
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
                    <a href="chat.php">Chat</a>
                    <a href="#">Chat em Grupo</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="criar_conta.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <?php if(!isset($_SESSION['id_unico'])): ?>
            <div><br>
                <form action="criar_logarC.php" method="post" enctype="multipart/form-data" autocomplete="on">
                    <div>
                        <label for="inome">Nome</label>
                        <input type="text" name="nome" id="inome" autocomplete="name">
                    </div>
                    <div>
                        <label for="iemail">E-mail:</label>
                        <input type="email" name="email" id="iemail" autocomplete="email">
                    </div>
                    <div>
                        <label for="isenha">Senha:</label>
                        <input type="password" name="senha" id="isenha">
                    </div>
                    <div>
                        <label for="is2">Confirmar senha:</label>
                        <input type="password" name="s2" id="is2">
                    </div>
                    <div>
                        <label for="img" id="foto"><img src="imagens/blank-profile-picture.png" alt="" id="perfil1"></label>
                        <input type="file" name="foto" id="img" onchange="carregar1(event)">
                    </div>
                    <div>
                        <input type="checkbox" name="contrato" id="icontrato">
                        <label for="icontrato">Concordo com os <a href="#">termos</a> de contrato</label>
                    </div>
                    <button id="btncriar" type="submit">Criar conta</button>
                    <a href="login.php" id="contaexistente">Entrar</a>
                </form><br>

            </div>
        <?php endif; ?>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>