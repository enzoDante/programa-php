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
                $id = $_SESSION['id_unico'];
                header("Location: perfil.php?id=$id");
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
                    <a href="chat.php?id=">Chat</a>
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
        <div><br>
            <?php
                date_default_timezone_set('America/Sao_Paulo');
                if(isset($_POST['nome'])){
                    $nome = strip_tags(str_replace(";","_", $_POST['nome']));
                    $bio = strip_tags(str_replace(";","_", $_POST['bio']));

                    if($_SESSION['nome'] != $nome){
                        $stmt = $conn->prepare("SELECT * FROM usuario WHERE nome=?");
                        $stmt->bind_param("s", $nome);
                        $stmt->execute();
    
                        $resultado = $stmt->get_result();
                        while($linha = $resultado->fetch_object()){
                            $verificar = $linha->nome;
                        }
                        if($verificar == $nome){
                            die("<p>Nome existente, digite outro nome!</p>");
                        }
                    }
                    #===========
                    $idd = $_SESSION['id_unico'];
                    $stmt = $conn->prepare("UPDATE usuario SET nome=?, bio=? WHERE id_unico=?");
                    $stmt->bind_param("sss", $nome, $bio, $idd);
                    $stmt->execute();
                    $_SESSION['nome'] = $nome;
                    $_SESSION['bio'] = $bio;

                    #=========================
                    $pasta = "imagens/";
                    $imagem_nome = "";
                    if($_FILES["imgf"]['error'] != 4){
                        $extensao = pathinfo($_FILES['imgf']['name']);
                        $extensao = ".".$extensao['extension'];

                        if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                            $imagem_nome = $pasta.date("Y-m-d-H-i-s")."_fundo".$extensao;

                            if(move_uploaded_file($_FILES['imgf']['tmp_name'], $imagem_nome)){
                                echo "deu certo";
                                if(file_exists($_SESSION['imgfundo'])){
                                    unlink($_SESSION['imgfundo']);
                                }
                            }else{
                                echo "<p>não foi possível alterar a imagem de fundo!</p>";
                            }

                        }else{
                            die("<h3>A imagem de fundo deve ser dos formatos png, jpg ou jpeg</h3>");
                        }
                    }else{
                        $imagem_nome = $_SESSION['imgfundo'];
                    }
                    #================
                    $imagem_nome2 = "";
                    if($_FILES["imgp"]['error'] != 4){
                        $extensao = pathinfo($_FILES['imgp']['name']);
                        $extensao = ".".$extensao['extension'];

                        if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                            $imagem_nome2 = $pasta.date("Y-m-d-H-i-s")."_perfil".$extensao;

                            if(move_uploaded_file($_FILES['imgp']['tmp_name'], $imagem_nome2)){
                                echo "deu certo";
                                if(file_exists($_SESSION['imgperfil'])){
                                    unlink($_SESSION['imgperfil']);
                                }
                            }else{
                                echo "<p>não foi possível alterar a imagem de perfil!</p>";
                            }

                        }else{
                            die("<h3>A imagem de perfil deve ser dos formatos png, jpg ou jpeg</h3>");
                        }
                    }else{
                        $imagem_nome2 = $_SESSION['imgperfil'];
                    }
                    #=====
                    $stmt = $conn->prepare("UPDATE usuario SET imgfundo=?, imgperfil=? WHERE id_unico=?");
                    $stmt->bind_param("sss", $imagem_nome, $imagem_nome2, $idd);
                    $stmt->execute();
                    $_SESSION['imgperfil'] = $imagem_nome2;
                    $_SESSION['imgfundo'] = $imagem_nome;
                    header("Location: perfil.php?id=$idd");
                }
            
            ?>
        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>