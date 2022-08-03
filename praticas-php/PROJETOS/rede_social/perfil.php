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
    <link rel="stylesheet" href="estilos/perfil.css">
    <link rel="stylesheet" href="estilos/modal.css">
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
                    <a href="chat.php?id=">Chat</a>
                    <a href="#">Chat em Grupo</a>
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
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();

                    $nome = '';
                    $bio = '';
                    $imgp = '';
                    $imgf = '';
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $nome = $linha->nome;
                        $bio = $linha->bio;
                        $imgp = $linha->imgperfil;
                        $imgf = $linha->imgfundo;
                    }
                ?>
                <div id="imgfundo"><img src="<?php echo $imgf; ?>" alt=""></div>
            </div>
            <div id="lugarperfil">
                <div id="perfilimg"><img src="<?php echo $imgp; ?>" alt=""></div>
            </div>
            <h2 id="nome"><?php echo $nome; ?></h2>
            <div id="seguires">
                <textarea disabled id="" cols="30" rows="10"><?php echo $bio; ?></textarea>
                <?php
                    $seguindo = 0;
                    $seguidores = 0;
                    #=================seguindo==================
                    $b = 'n';
                    $stmt = $conn->prepare("SELECT * FROM seguidores WHERE id_seguir=? AND bloquear=?");
                    $stmt->bind_param("ss", $id, $b);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $seguindo++;
                    }
                    #===========seguidores===========
                    $b = 'n';
                    $stmt = $conn->prepare("SELECT * FROM seguidores WHERE id_seguindo=? AND bloquear=?");
                    $stmt->bind_param("ss", $id, $b);
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
                    $stmt = $conn->prepare("SELECT * FROM seguidores WHERE id_seguir=? AND id_seguindo=?");
                    $stmt->bind_param("ss", $_SESSION['id_unico'], $id);
                    $stmt->execute();
                    $seg = 'Seguir';
                    #===================bloquear======================
                    $resultado = $stmt->get_result();
                    $verificar = "";
                    $bloq = "bloquear";
                    while($linha = $resultado->fetch_object()){
                        $verificar = $linha->bloquear;
                        if(($verificar == 'n') || ($verificar == '')){
                            $bloq = "Bloquear";
                        }else{
                            $bloq = "Desbloquear";
                        }
                        if($linha->id_seguindo == $id){
                            $seg = "Unfollow";
                        }else{
                            $seg = "Seguir";
                        }
                    }                    
                ?>
                <?php if($bloq != 'Desbloquear'): ?>
                <form method='post' action='seguir.php'>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button id="imgformbutton" ><?php echo $seg; ?></button>
                </form>
                <?php endif; ?>
                <form action="bloquear.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" id="imgformbutton2"><?php echo $bloq; ?></button>
                </form>
            
            <?php endif; ?>
        </div>
        <!--=========================Modal de alterar imgperfil, imgfundo, nome, etc======================-->
        <div id="alterar" class="modal">
            <form class="modal-content animate" enctype="multipart/form-data" action="editar_perfilC.php" method="post" autocomplete="off">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('alterar').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h3 id="textoeditar">Editar perfil</h3>
                    <button type="submit" id="btnsalvar">Salvar</button>
                </div>
              
                <div>
                    <div>
                        <label for="iimgfundo" id="imgfundo" class="emcimaimg fundoaltura"><img src="<?php echo $imgf; ?>" alt="" id="perfil1"></label>
                        <input type="file" name="imgf" onchange="carregar1(event)" id="iimgfundo">
                    </div>
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
                            <label for="ibio"><strong>Bio</strong></label>
                            <textarea name="bio" id="ibio" cols="30" rows="10"><?php echo $bio; ?></textarea>
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
            <div id="conteudo">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM post WHERE id_criador=? ORDER BY id DESC");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();

                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $div = "
                            <div class='item'>
                                <div class='contpubli'><p>$linha->msg_post</p>
                                </div>
                                <div class='imgpubli'>
                                    <img src='$linha->img_post'>
                                </div>
                                <a href='postver.php?id=$linha->id_post' class='comment'>Comentários</a>
                            </div>
                        ";
                        echo $div;
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