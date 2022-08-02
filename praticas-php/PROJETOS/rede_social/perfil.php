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
                    <a href="chat.php">Chat</a>
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
                <a href="seguindo.html" class="seguiros"><strong>12</strong> Seguindo</a>
                <a href="seguidores.html" class="seguiros"><strong>0</strong> Seguidores</a>
            </div>
            <?php if((isset($_SESSION['id_unico'])) && ($_SESSION['id_unico'] == $id)): ?>
                <button id="imgformbutton" onclick="document.getElementById('alterar').style.display='block'">Editar perfil</button>
            <?php endif; if((isset($_SESSION['id_unico'])) && ($_SESSION['id_unico'] != $id)): ?>
            <!--ficaria no lugar do botão acima! "Editar perfil"-->
                <form method='post' action=''>
                    <button id="imgformbutton" >Seguir</button>
                </form>
                <form action="">
                    <button type="submit" id="imgformbutton2">Bloquear</button>
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
            <div id="publicar">
                <button onclick="document.getElementById('publicacon').style.display='block'">Publicar</button>
            </div>
            <!--==================================modal publicar===================================-->
            <div id="publicacon" class="modal" onclick="telamodal(event)">
                <form class="modal-content animate" enctype="multipart/form-data" action="" method="post" autocomplete="off">
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
                                <textarea name="bio" id="ibio" cols="30" rows="10"></textarea>
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
                <div class="item">
                    <div class="contpubli">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ex nihil repellat exercitationem praesentium quae. Possimus laudantium voluptas harum mollitia esse, nobis dolorum obcaecati ducimus reiciendis voluptates aliquid? Nemo, quod impedit. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima accusantium officia porro est rerum similique? Molestias, aliquam. At, itaque expedita nihil facere iste voluptatum voluptates, deserunt vero, repellat odit nostrum!</p>
                    </div>
                    <div class="imgpubli">
                        <img src="imagens/2048x1152_fantasy-giant-wolf-monster-artwork.jpg" alt="">
                    </div>
                    <a href="postver.html?id=teste" class="comment">Comentários</a>
                </div>
                <!--==============================================================================================-->
                <div class="item">
                    <div class="contpubli">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus voluptatibus sunt ex, delectus facere praesentium? Sit consequatur tempore ipsum consequuntur optio id, qui a natus maiores repellat ipsa esse sunt.</p>
                    </div>
                    <div class="imgpubli">
                        <img src="imagens/fantasia-bruxo_planoFundo-1920x1080.jpg" alt="">
                    </div>
                    <a href="postver.html?id=teste" class="comment">Comentários</a>
                </div>
                <!--==============================================================================================-->
                <div class="item">
                    <div class="contpubli">
                        <p>frase pequena curta para observar</p>
                    </div>
                    <div class="imgpubli">
                        <img src="imagens/galaxy_wolf-t2.jpg" alt="">
                    </div>
                    <a href="postver.html?id=teste" class="comment">Comentários</a>
                </div>
                <!--==============================================================================================-->
                <div class="item">
                    <div class="contpubli">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea tempora quasi ratione enim sequi beatae earum dolo</p>
                    </div>
                    <div class="imgpubli">                    
                        <img src="imagens/IMG_20190120_210500_409.jpg" alt="">
                    </div>
                    <a href="postver.html?id=teste" class="comment">Comentários</a>
                </div>
                <!--==============================================================================================-->
                <div class="item">
                    <div class="contpubli">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto dicta reprehenderit beatae itaque necessitatibus ultate ratione tempore labore?</p>
                    </div>
                    <div class="imgpubli">                        
                        <img src="imagens/the real rainbow wolf.png" alt="">
                    </div>
                    <a href="postver.html?id=teste" class="comment">Comentários</a>
                </div>
                <!--==============================================================================================-->
            </div>
        </div><br>

    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <footer>

    </footer>
    
</body>
</html>