<?php 
    include "banco.php";
    session_start();

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            header("Location: pag_busca.php");
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
    <title>Buscar</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/post.css">
    <link rel="stylesheet" href="estilos/seguinres.css">
    <link rel="stylesheet" href="estilos/busca.css">
</head>
<body>
    <header>
        <h1>Buscar</h1>
    </header>
    <nav>
        <div id="navegador">
            <div id="nav">
                <div id="left">
                    <h3>Nome Site</h3>
                </div>
                <div>
                    <a href="pag_principal.php">Home</a>
                    <a href="#">Buscar</a>
                    <a href="chat.php?id=">Chat</a>
                    <a href="#">Chat em Grupo</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="pag_busca.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>        
    </nav>

    <main>
        <div id="buscarall"><br>
            <div id="divbusca">
                <form action="" method="post">
                    <input type="text" name="busca" id="ibusca" onkeyup="buscar()">
                    <button type="reset" id="btn" onclick="buscar()">X</button>
                </form>
            </div>
            <div id="comentarios">
                <?php 
                    $stmt = $conn->prepare("SELECT id_unico,nome,imgperfil FROM usuario ORDER BY nome");
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $div = "
                            <div id='publicar' class='borda'>
                                <span id='perfila'>
                                    <a href='perfil.php?id=$linha->id_unico'><img src='$linha->imgperfil' alt=''></a>
                                </span>
                                <a href='perfil.php?id=$linha->id_unico' class='nomelink'>$linha->nome</a>
                            </div>
                        ";
                        echo $div;
                    }
                
                ?>
            </div>

        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <script src="scripts/busca.js"></script>
</body>
</html>