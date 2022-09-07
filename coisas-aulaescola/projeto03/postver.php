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
                                <label for="titulo"><strong>Titulo:</strong></label>
                                <input type="text" name="titulo" id="titulo" placeholder="TITULO">

                                <label for="subtitulo"><strong>Sub-titulo:</strong></label>
                                <input type="text" name="subtitulo" id="subtitulo" placeholder="sub-titulo">

                                <label for="ibio"><strong>Comentário</strong></label>
                                <textarea name="msg" id="ibio" cols="30" rows="10"></textarea>

                                <label for="itp">tipo post:</label>
                                <select name="itp" id="itp">
                                    <?php
                                        $stmt = $conn->prepare("SELECT * FROM tipoPost");
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        while($linha = $resultado->fetch_object()){
                                            $tp = $linha->tipo;
                                            $idd = $linha->idtipoPost;
                                            echo "<option value='$idd'>$tp</option>";
                                        }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div><input type="file" name="imgp1" id="blockp"></div>
                        <div><input type="file" name="imgp2" id="blockp"></div>
                        <div><input type="file" name="imgp3" id="blockp"></div>
                        <br>
                    </div>
                </form>
            </div>
            <!--=================================fom do modal publicar=============================-->
        </div>
        <!--======================================================-->
        <div id="postagem">
            <?php
                $stmt = $conn->prepare("SELECT * FROM autorespost,post WHERE idpost=? AND post_idpost=idpost");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                #==============
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $stmt2 = $conn->prepare("SELECT * FROM usuario WHERE idusuario=?");
                    $stmt2->bind_param("i", $linha->usuario_idusuario);
                    $stmt2->execute();
                    $resultado2 = $stmt2->get_result();
                    while($linha2 = $resultado2->fetch_object()){
                        $nome = $linha2->nome;
                        $imgp = $linha2->foto;
                        $id_c = $linha2->idusuario;
                    }
                    $titulo = $linha->titulo;
                    $stitulo = $linha->subtitulo;
                    $msg = $linha->post;

                    $img1 = '';
                    $img2 = '';
                    $img3 = '';
                    $stmt = $conn->prepare("SELECT * FROM post_fotos WHERE post_idpost=? ORDER BY foto ASC");
                    $stmt->bind_param("i", $linha->post_idpost);
                    $stmt->execute();
                    $resultado3 = $stmt->get_result();
                    while($linha3 = $resultado3->fetch_object()){
                        if($img1 == '')
                            $img1 = $linha3->foto;
                        else if($img2 == '')
                            $img2 = $linha3->foto;
                        else if($img3 == '')
                            $img3 = $linha3->foto;
                    }
                    
                }
                #===========================
            ?>
            <div id="navegador">
                <span id="perfila">
                    <a href="perfil.php?id=<?php echo $id_c; ?>"><img src="<?php echo $imgp; ?>" alt=""></a>
                </span>
                <a href="perfil.php?id=<?php echo $id_c; ?>"><h2><?php echo $nome; ?></h2></a>
            </div>
            <h3>Título:  -<?php echo $titulo; ?></h3>
            <h4>Sub-título:  -<?php echo $stitulo; ?></h4><br>
            <p>
                <?php echo $msg; ?>
            </p>
            <?php if($img1 != ''): ?>
            <div id="imagempublicada">
                <img src="<?php echo $img1; ?>" alt="">
            </div>
            <?php endif; if($img2 != ''): ?>
            <div id="imagempublicada">
                <img src="<?php echo $img2; ?>" alt="">
            </div>
            <?php endif; if($img3 != ''): ?>
            <div id="imagempublicada">
                <img src="<?php echo $img3; ?>" alt="">
            </div>
            <?php endif; ?>

        </div><br>
        <hr>
        <!-- comentarios do post -->
        <div id="comentarios">
        <?php if(isset($_SESSION['id_unico'])): ?>
            <div id="publicar" class="borda">
                <div id="navegador">
                    <span id="perfila">
                        <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                    </span>
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>"><?php echo $_SESSION['nome']; ?></a>
                </div>
                    <form action="comentar.php" method="post">
                        <input type="hidden" name="valorid" value="<?php echo $id; ?>">
                        <textarea name="coment" id="icomento" cols="30" rows="10" placeholder="Comentário"></textarea>
                        <input type="number" name="nota" id="" min="0" max="10" placeholder="Nota do post">
                        <button type="submit">Comentar</button>
                    </form>
            </div>
        <?php endif; ?>
            <!--===============================================-->
            <?php
                $stmt = $conn->prepare("SELECT * FROM comentario,usuario WHERE post_idpost=? AND idusuario=usuario_idusuario ORDER BY idcomentario DESC");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){

                    $div = "";
                    $div= "
                        <div class='borda'>
                        <div id='navegador'>
                            <span id='perfila'>
                                <a href='perfil.php?id=$linha->idusuario'><img src='$linha->foto'></a>
                            </span>
                            <a href='perfil.php?id=$linha->idusuario'>$linha->nome</a>
                        </div>
                        <p>$linha->comentario</p>
                        <p>Nota: $linha->nota</p>
                    ";
                    echo $div;
                    if(isset($_SESSION['id_unico'])){
                        if($linha->idusuario == $_SESSION['id_unico']){
                            $div = "
                                <form method='post' action='deletarcomentario.php?id=$id'>
                                    <input type='hidden' name='idmsg' value='$linha->idcomentario'>
                                    <button type='submit' style='background-color: white; border: none; cursor: pointer;'><img src='imagens/lixo.png'></button>
                                </form>
                                                            
                                </div>
                            ";
                        }else
                            $div = "</div>";

                    }else{
                        $div = "</div>";
                    }

                    echo $div;                    
                }            
            ?>            
        </div><br>
    </main>    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>