<?php 
    include "banco.php";
    session_start();

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            header("Location: perfil.php?id={$_SESSION['id_unico']}");
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
    <title>Seguindo</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modal.css">
    <link rel="stylesheet" href="estilos/post.css">
    <link rel="stylesheet" href="estilos/seguinres.css">
</head>
<body>
    <header>
        <h1>Seguindo</h1>
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
                <a href="perfil.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>        
    </nav>

    <main>
        <div>
            <?php
                date_default_timezone_set('America/Sao_Paulo');
                $codigo = substr(md5(date("YmdHis")), 1, 9);

                $msg = strip_tags(str_replace(";", "_", $_POST['msg']));

                $pasta = "imagens_post/";
                if($_FILES["imgpost"]['error'] != 4){
                    $extensao = pathinfo($_FILES['imgpost']['name']);
                    $extensao = ".".$extensao['extension'];
                    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                        
                        $imagem = $pasta.date("Y-m-d-H-i-s")."_post".$extensao;
                        if(move_uploaded_file($_FILES['imgpost']['tmp_name'], $imagem)){
                            echo "<p>arquivo válido e enviado com sucesso</p>";
                            $stmt = $conn->prepare("INSERT INTO post (id_post,id_criador,msg_post,img_post) VALUES(?,?,?,?)");
                            $stmt->bind_param("ssss",$codigo, $_SESSION['id_unico'], $msg, $imagem);
                            $stmt->execute();

                            header("Location: perfil.php?id={$_SESSION['id_unico']}");

                        }else{
                            echo "<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>";
                        }
                    }
                }else{
                    $stmt = $conn->prepare("INSERT INTO post (id_post,id_criador,msg_post) VALUES(?,?,?)");
                    $stmt->bind_param("sss",$codigo, $_SESSION['id_unico'], $msg);
                    $stmt->execute();
                    header("Location: perfil.php?id={$_SESSION['id_unico']}");
                }

            ?>
        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>