<?php 
    include "banco.php";
    session_start();
    $id = $_GET['id'];

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            $id = $_GET['id'];
            session_destroy();
            header("Location: perfil.php?id=$id");
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
    <title>Perfil</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/perfill1.css">
    <link rel="stylesheet" href="estilos/modalss.css">
</head>
<body>
    <header>
        <h1>Perfil</h1>
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
                    <!--<a href="#">outros</a>-->
                </div>
            </div>
            <!--se nn estiver logado-->
            <!--<a href="">Logar</a>-->
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="perfil.php?a=logout&id=<?php echo $id; ?>">Sair</a>
                <div id="divimg">
                    <!--link p perfil(se estiver logado) link p criar/logar (se nn estiver logado)-->
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>        
    </nav>

    <main>        
        <div>
            <div>
                <?php
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE idusuario=?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();

                    $nome = '';
                    $imgp = '';
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $nome = $linha->nome;
                        $email = $linha->email;
                        $imgp = $linha->foto;
                    }
                ?>
                <div id="imgfundo"><img src="imagens/Universidade_do_Vale_do_Paraíba_logo.png" alt=""></div>
            </div>
            <div id="lugarperfil">
                <div id="perfilimg"><img src="<?php echo $imgp; ?>" alt=""></div>
            </div>
            <h2 id="nome"><?php echo $nome; ?></h2>
            <div id="seguires">
                <?php
                    $seguindo = 0;
                    $seguidores = 0;
                    #=================seguindo==================
                    $stmt = $conn->prepare("SELECT * FROM seguidor WHERE usuario_idusuario_Seguidor=?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $seguindo++;
                    }
                    #===========seguidores===========
                    $stmt = $conn->prepare("SELECT * FROM seguidor WHERE usuario_idusuario_Seguido=?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $seguidores++;
                    }
                ?>
                <a href="seguindo.php?id=<?php echo $id; ?>" class="seguiros"><strong><?php echo $seguindo; ?></strong> Seguindo</a>
                <a href="seguidores.php?id=<?php echo $id; ?>" class="seguiros"><strong><?php echo $seguidores; ?></strong> Seguidores</a>
            </div>
            <?php if((isset($_SESSION['id_unico'])) && ($_SESSION['id_unico'] == $id)): ?>
                <button id="imgformbutton" onclick="document.getElementById('alterar').style.display='block'">Editar perfil</button>
            <?php endif; if((isset($_SESSION['id_unico'])) && ($_SESSION['id_unico'] != $id)): ?>
            <!--=================seguir/parar de seguir/bloquear======================================"-->
                <?php
                    $bol = 0;
                    $stmt = $conn->prepare("SELECT * FROM seguidor WHERE usuario_idusuario_Seguidor=? AND usuario_idusuario_Seguido=?");
                    $stmt->bind_param("ss", $_SESSION['id_unico'], $id);
                    $stmt->execute();
                    $seg = 'Seguir';
                    #===================mostrar botão de seguir/deixar de seguir======================
                    $resultado = $stmt->get_result();
                    $verificar = "";
                    while($linha = $resultado->fetch_object()){
                        if($linha->usuario_idusuario_Seguido == $id){
                            $seg = "Unfollow";
                        }else{
                            $seg = "Seguir";
                        }
                    }                    
                ?>
                <form method='post' action='seguir.php'>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button id="imgformbutton" ><?php echo $seg; ?></button>
                </form>
            
            <?php endif; ?>
        </div>
        <!--=========================Modal de alterar imgperfil, nome, etc======================-->
        <div id="alterar" class="modal">
            <form class="modal-content animate" enctype="multipart/form-data" action="editar_perfilC.php" method="post" autocomplete="off">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('alterar').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h3 id="textoeditar">Editar perfil</h3>
                    <button type="submit" id="btnsalvar">Salvar</button>
                </div>
              
                <div><br><br>
                    <div>
                    </div><br><br><br>
                    <div id="lugarperfil">
                        <label for="iperfil" id="perfilimg" class="emcimaimg"><img id="perfil2" src="<?php echo $imgp; ?>" alt=""></label>
                        <input type="file" name="imgp" onchange="carregar2(event)" id="iperfil">
                    </div>
                    <div id="campos">
                        <div class="fieldset">
                            <label for="inome"><strong>Nome</strong></label>
                            <input type="text" name="nome" id="inome" value="<?php echo $nome; ?>">
                        </div>
                        <div class="fieldset">
                            <label for="iemail"><strong>Nome</strong></label>
                            <input type="text" name="email" id="iemail" value="<?php echo $email; ?>">
                        </div>
                        <div class="fieldset">
                            <label for="iturma"><strong>Turma</strong></label>
                            <select name="turma" id="iturma">
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM turma, usuario WHERE turma_idturma=idturma AND idusuario=$id");
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                    while($linha = $resultado->fetch_object()){
                                        $idd = $linha->idturma;
                                        echo "<option value='$idd'>$linha->ano  $linha->turma</option>";
                                    }

                                    $stmt = $conn->prepare("SELECT * FROM turma ORDER BY ano DESC, idturma ASC");
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                    while($linha = $resultado->fetch_object()){
                                        $turm = $linha->ano." ".$linha->turma;
                                        $idd = $linha->idturma;
                                        echo "<option value='$idd'>$turm</option>";
                                    }
                                ?>
                            </select>
                        </div><br>
                    </div>
                </div>
            </form>
        </div>
        <!--======================fim do modal===========================-->
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
            <!--=================================fim do modal publicar=============================-->
            <div id="conteudo">
                <?php
                    // 

                    $stmt = $conn->prepare("SELECT * FROM autorespost WHERE usuario_idusuario=? ORDER BY post_idpost DESC");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){

                        $stmt = $conn->prepare("SELECT * FROM post WHERE idpost=?");
                        $stmt->bind_param("i", $linha->post_idpost);
                        $stmt->execute();
                        $resultado2 = $stmt->get_result();
                        while($linha2 = $resultado2->fetch_object()){

                            $img1 = '';
                            $stmt = $conn->prepare("SELECT * FROM post_fotos WHERE post_idpost=? ORDER BY foto ASC");
                            $stmt->bind_param("i", $linha->post_idpost);
                            $stmt->execute();
                            $resultado3 = $stmt->get_result();
                            while($linha3 = $resultado3->fetch_object()){
                                $img1 = $linha3->foto;                               
                            }

                            //mostrando o post
                            $div = "
                            <div class='item'>
                                <a href='postver.php?id=$linha2->idpost'><h1>$linha2->titulo</h1></a>
                                <div class='contpubli'><p>$linha2->post</p>
                                </div>
                                <div class='imgpubli'>
                                    <img src='$img1'>
                                </div>
                                <a href='postver.php?id=$linha2->idpost' class='comment'>Comentários</a>
                            </div>
                            
                            ";
                            echo $div;
                        }
                    }
                ?>                
            </div>
        </div><br>

    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <footer>

    </footer>
    
</body>
</html>