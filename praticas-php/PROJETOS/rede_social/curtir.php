<?php 
    include "banco.php";
    session_start();
    $id = $_GET['id'];

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            $id = $_GET['id'];
            session_destroy();
            header("Location: postver.php?id=$id");
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
    <link rel="stylesheet" href="estilos/modal.css">
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
                    <a href="chat.php">Chat</a>
                    <a href="#">Chat em Grupo</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="curtir.php?a=logout&id=<?php echo $id; ?>">Sair</a>
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
                $stmt = $conn->prepare("SELECT * FROM curtidas WHERE id_curtiu=? AND id_post_curtido=?");
                $stmt->bind_param("ss", $_SESSION['id_unico'], $id);
                $stmt->execute();

                $verificar = '';
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->id_post_curtido;
                }
                if($verificar == ''){
                    $stmt = $conn->prepare("INSERT INTO curtidas (id_curtiu,id_post_curtido) VALUES(?,?)");
                    $stmt->bind_param("ss", $_SESSION['id_unico'], $id);
                    $stmt->execute();
                    #-=-=-=-=--=--=--=-=-=-=-=-=-=-=-=-=-=                    
                    header("Location: postver.php?id=$id");
                }else{
                    #==========remover curtida=============
                    $stmt = $conn->prepare("DELETE FROM curtidas WHERE id_curtiu=? AND id_post_curtido=?");
                    $stmt->bind_param("ss", $_SESSION['id_unico'], $id);
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