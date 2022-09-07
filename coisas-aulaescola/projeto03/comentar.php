<?php 
    include "banco.php";
    session_start();

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            header("Location: pag_principal.php");
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
    <title>Post</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/post.css">
</head>
<body>
    <header>
        <h1>Post</h1>
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
                <a href="postver.php?a=logout&id=<?php echo $id; ?>">Sair</a>
            <div id="divimg">
                <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
            </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>
    </div>   
    </nav>

    <main>
        <div>
            <?php
                if((isset($_SESSION['id_unico'])) && (isset($_POST['coment']))){
                    $id = $_POST['valorid'];
                    #echo $id;
                    $msg = strip_tags(str_replace(";", " ", $_POST['coment']));
                    $nota = $_POST['nota'];

                    $stmt = $conn->prepare("INSERT INTO comentario (comentario,nota,post_idpost,usuario_idusuario) VALUES(?,?,?,?)");
                    $stmt->bind_param("siii", $msg, $nota, $id, $_SESSION['id_unico']);
                    $stmt->execute();
                    header("Location: postver.php?id=$id");
                }
            
            ?>
        </div><br>
    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>