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
                            <label for="iimgpost" id="postarimg"><img id="imgpostar" src="../imagens/pngwing.com.png" alt=""></label>
                            <input type="file" onchange="carregar3(event)" name="imgpost" id="iimgpost">
                        </div><br>
                    </div>
                </form>
            </div>
            <!--=================================fom do modal publicar=============================-->
        </div>
        <!--======================================================-->
        <div id="postagem">
            <?php
                $stmt = $conn->prepare("SELECT * FROM post WHERE id_post=?");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                #==============
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $stmt2 = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                    $stmt2->bind_param("s", $linha->id_criador);
                    $stmt2->execute();
                    $resultado2 = $stmt2->get_result();
                    while($linha2 = $resultado2->fetch_object()){
                        $nome = $linha2->nome;
                        $imgp = $linha2->imgperfil;
                        $id_c = $linha2->id_unico;
                    }
                    $msg = $linha->msg_post;
                    $img = $linha->img_post;
                }
                #===========================================
                $stmt3 = $conn->prepare("SELECT * FROM curtidas WHERE id_post_curtido=?");
                $stmt3->bind_param("s", $id);
                $stmt3->execute();
                $curtidas = 0;
                $resultado4 = $stmt3->get_result();
                while($linha4 = $resultado4->fetch_object()){
                    $curtidas++;
                }
                #===========================
                $stmt3 = $conn->prepare("SELECT * FROM curtidas WHERE id_curtiu=? AND id_post_curtido=?");
                $stmt3->bind_param("ss", $_SESSION['id_unico'], $id);
                $stmt3->execute();
                $like = 'imagens/coracao.png';
                $resultado4 = $stmt3->get_result();
                while($linha4 = $resultado4->fetch_object()){
                    $like = 'imagens/coracao_vermelho.png';
                }
            ?>
            <div id="navegador">
                <span id="perfila">
                    <a href="perfil.php?id=<?php echo $id_c; ?>"><img src="<?php echo $imgp; ?>" alt=""></a>
                </span>
                <a href="perfil.php?id=<?php echo $id_c; ?>"><?php echo $nome; ?></a>
            </div>
            <p>
                <?php echo $msg; ?>
            </p>
            <div id="imagempublicada">
                <img src="<?php echo $img; ?>" alt="">
            </div>
            <a href="curtir.php?id=<?php echo $id; ?>"><img style="width: 35px;" src="<?php echo $like; ?>" alt=""></a>
            <span style="font-size: 1.3em; font-weight: bold;"><?php echo $curtidas; ?></span>
            <a href=""><img style="width: 35px;" src="imagens/link.png" alt=""></a>
            <input type='text' disabled id='copiar' value='postver.php?id=<?php echo $id; ?>'>

        </div><br>
        <hr>
        <div id="comentarios">
            <div id="publicar" class="borda">
                <div id="navegador">
                    <span id="perfila">
                        <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                    </span>
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>"><?php echo $_SESSION['nome']; ?></a>
                </div>
                <form action="" method="post">
                    <textarea name="coment" id="icomento" cols="30" rows="10" placeholder="Comentário"></textarea>
                    <button type="submit">Comentar</button>
                </form>
            </div>
            <div class="borda">
                <div id="navegador">
                    <span id="perfila">
                        <a href="#"><img src="../imagens/blank-profile-picture.png" alt=""></a>
                    </span>
                    <a href="#">Nome usuário</a>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam totam repellat sunt quisquam tempora veniam architecto velit consequatur fugiat rerum, tempore nam iste sequi perferendis nesciunt magnam molestiae vel sit.
                </p>
            </div>
            <div class="borda">
                <div id="navegador">
                    <span id="perfila">
                        <a href="#"><img src="../imagens/blank-profile-picture.png" alt=""></a>
                    </span>
                    <a href="#">Nome usuário</a>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam totam repellat sunt quisquam tempora veniam architecto velit consequatur fugiat rerum, tempore nam iste sequi perferendis nesciunt magnam molestiae vel sit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quas natus consequatur, numquam soluta possimus. Eum, perferendis. Animi veniam iure quasi? Asperiores dignissimos est id nostrum fugit neque ex animi?
                </p>
            </div>
            <div class="borda">
                <div id="navegador">
                    <span id="perfila">
                        <a href="#"><img src="../imagens/blank-profile-picture.png" alt=""></a>
                    </span>
                    <a href="#">Nome usuário</a>
                </div>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam totam repellat sunt quisquam tempora veniam architecto v
                </p>
            </div>
        </div><br>
    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>