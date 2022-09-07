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
    <link rel="stylesheet" href="estilos/modalss.css">
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
                    <a href="criar_turma.php">Criar turma</a>
                    <a href="criar_tipoPost.php">Criar tipo post</a>
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
                $permitir = false;
                $hoje = date("Y-m-d");
                $titulo = $_POST['titulo'];
                $subtitulo = $_POST['subtitulo'];
                $tipoPost = $_POST['itp'];                
                $msg = strip_tags(str_replace(";", "_", $_POST['msg']));

                $stmt = $conn->prepare("INSERT INTO post (momento,post,titulo,subtitulo,tipoPost_idtipoPost) VALUES(?,?,?,?,?)");
                $stmt->bind_param("sssss",$hoje, $msg, $titulo, $subtitulo, $tipoPost);
                $stmt->execute();
                //=======================================================================
                $stmt = $conn->prepare("SELECT idpost FROM post WHERE momento=?");
                $stmt->bind_param("s", $hoje);
                $stmt->execute();
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $cod = $linha->idpost;
                }

                
                $stmt = $conn->prepare("INSERT INTO autoresPost (usuario_idusuario, post_idpost) VALUES(?,?)");
                $stmt->bind_param("ii", $_SESSION['id_unico'], $cod);
                $stmt->execute();

                //=========================================================================
                $pasta = "imagens_post/";
                if($_FILES["imgp1"]['error'] != 4){
                    $extensao = pathinfo($_FILES['imgp1']['name']);
                    $extensao = ".".$extensao['extension'];
                    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                        
                        $imagem = $pasta.date("Y-m-d-H-i-s")."_post".$extensao;
                        if(move_uploaded_file($_FILES['imgp1']['tmp_name'], $imagem)){
                            echo "<p>arquivo válido e enviado com sucesso</p>";                            
                            $stmt = $conn->prepare("INSERT INTO post_fotos (post_idpost, foto) VALUES(?,?)");
                            $stmt->bind_param("ss", $cod, $imagem);
                            $stmt->execute();

                        }else{
                            die("<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>");
                        }
                    }
                }
                //=======================imagem 2=====================================
                if($_FILES["imgp2"]['error'] != 4){
                    $extensao = pathinfo($_FILES['imgp2']['name']);
                    $extensao = ".".$extensao['extension'];
                    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                        
                        $imagem = $pasta.date("Y-m-d-H-i-s")."_p2ost".$extensao;
                        if(move_uploaded_file($_FILES['imgp2']['tmp_name'], $imagem)){
                            echo "<p>arquivo válido e enviado com sucesso</p>";                            
                            $stmt = $conn->prepare("INSERT INTO post_fotos (post_idpost, foto) VALUES(?,?)");
                            $stmt->bind_param("ss", $cod, $imagem);
                            $stmt->execute();

                        }else{
                            die("<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>");
                        }
                    }
                }
                //================imagem 3-=================================
                if($_FILES["imgp3"]['error'] != 4){
                    $extensao = pathinfo($_FILES['imgp3']['name']);
                    $extensao = ".".$extensao['extension'];
                    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                        
                        $imagem = $pasta.date("Y-m-d-H-i-s")."_p3ost".$extensao;
                        if(move_uploaded_file($_FILES['imgp3']['tmp_name'], $imagem)){
                            echo "<p>arquivo válido e enviado com sucesso</p>";                            
                            $stmt = $conn->prepare("INSERT INTO post_fotos (post_idpost, foto) VALUES(?,?)");
                            $stmt->bind_param("ss", $cod, $imagem);
                            $stmt->execute();

                        }else{
                            die("<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>");
                        }
                    }
                }

                
                header("Location: perfil.php?id={$_SESSION['id_unico']}");
                

            ?>
        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>