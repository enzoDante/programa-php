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
    <title>Início</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modal.css">
    <link rel="stylesheet" href="estilos/post.css">
</head>
<body>
    <header>
        <h1>Início</h1>
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
                <a href="pag_principal.php?a=logout">Sair</a>
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
            <?php if(isset($_SESSION['id_unico'])): ?>
                <div id="publicar">
                    <button onclick="document.getElementById('publicacon').style.display='block'">Publicar</button>
                </div>
            <?php endif; ?>
            <!--==================================modal publicar===================================-->
            <div id="publicacon" class="modal" onclick="telamodal(event)">
                <form class="modal-content animate" enctype="multipart/form-data" action="postar.php" method="post" autocomplete="off">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('publicacon').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <h3 id="textoeditar">Postagem</h3>
                        <button type="submit" id="btnsalvar">Publicar</button>
                    </div>
                  <!--================================corpo==============================-->
                    <div>                        
                        <div id="campos">
                            <div class="fieldset">
                                <label for="ibio"><strong>Comentário</strong></label>
                                <textarea name="msg" id="ibio" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div>
                            <label for="iimgpost" id="postarimg"><img id="imgpostar" src="imagens/pngwing.com.png" alt=""></label>
                            <input type="file" onchange="carregar3(event)" name="imgpost" id="iimgpost">
                        </div><br>
                    </div>
                </form>
            </div>
            <!--=================================fim do modal publicar=============================-->
        </div>
        <!--======================================================-->
        <?php
            if(isset($_SESSION['id_unico'])){
                $div = "";
                $b = 'n';
                $stmt = $conn->prepare("SELECT * FROM post ORDER BY id DESC");                
                $stmt->execute();                

                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $stmt2 = $conn->prepare("SELECT * FROM seguidores WHERE id_seguir=? AND id_seguindo=? AND bloquear=?");
                    $stmt2->bind_param("sss", $_SESSION['id_unico'], $linha->id_criador, $b);
                    $stmt2->execute();

                    $resultado2 = $stmt2->get_result();
                    while($linha2 = $resultado2->fetch_object()){
                        $stmt3 = $conn->prepare("SELECT id_unico,nome,imgperfil FROM usuario WHERE id_unico=?");
                        $stmt3->bind_param("s", $linha->id_criador);
                        $stmt3->execute();

                        $resultado3 = $stmt3->get_result();
                        $nome = '';
                        while($linha3 = $resultado3->fetch_object()){
                            $nome = $linha3->nome;
                            $idc = $linha3->id_unico;
                            $imgp = $linha3->imgperfil;
                        }
                        $stmt4 = $conn->prepare("SELECT * FROM curtidas WHERE id_post_curtido=?");
                        $stmt4->bind_param("s", $linha->id_post);
                        $stmt4->execute();
                        $curtidas = 0;
                        $resultado4 = $stmt4->get_result();
                        while($linha4 = $resultado4->fetch_object()){
                            $curtidas++;
                        }
                        #===========================
                        $stmt4 = $conn->prepare("SELECT * FROM curtidas WHERE id_curtiu=? AND id_post_curtido=?");
                        $stmt4->bind_param("ss", $_SESSION['id_unico'], $linha->id_post);
                        $stmt4->execute();
                        $like = 'imagens/coracao.png';
                        $resultado4 = $stmt4->get_result();
                        while($linha4 = $resultado4->fetch_object()){
                            $like = 'imagens/coracao_vermelho.png';
                        }
                        if($nome != ''){
                            $div = "
                                <div id='postagem' class='pagiprincipal'>
                                    <div class='imgusuario'>
                                        <span id='perfila'>
                                            <a href='perfil.php?id=$idc'><img src='$imgp'></a>
                                        </span>
                                        <a href='perfil.php?id=$idc'>$nome</a>
                                    </div>
                                    <p>
                                        $linha->msg_post
                                    </p>
                                    <div class='imagempublicada'>
                                        <img src='$linha->img_post'>
                                    </div>
                                    <a href='curtir.php?id=$linha->id_post'><img style='width: 30px;' src='$like'></a>
                                    <span>$curtidas</span>
                                    <button style='background-color: white; border: none; cursor: pointer;'><img style='width: 30px;' src='imagens/link.png'></button>
                                    <a href='postver.php?id=$linha->id_post' class='comment'>Comentários</a>
                                    <input type='text' disabled id='copiar' value='postver.php?id=$linha->id_post'>
                                </div>                        
                            ";
                        }
                        echo $div;
                    }
                }
            }
        ?>
        <br>
    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <script src="scripts/copiarLink.js"></script>
</body>
</html>