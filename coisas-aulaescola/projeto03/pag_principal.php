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
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/perfill1.css">
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
                    <a href="criar_turma.php">Criar turma</a>
                    <a href="criar_tipoPost.php">Criar tipo post</a>
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
        </div>
        <!--======================================================-->
        <div id="conteudo2">
        <?php
            if(isset($_SESSION['id_unico'])){
                $div = "";
                $stmt = $conn->prepare("SELECT * FROM seguidor,autorespost,usuario,post WHERE usuario_idusuario_Seguidor=? AND idusuario=usuario_idusuario_Seguido AND usuario_idusuario=usuario_idusuario_Seguido AND idpost=post_idpost ORDER BY post_idpost DESC");
                $stmt->bind_param("i", $_SESSION['id_unico']);
                $stmt->execute();
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    
                    $stmt2 = $conn->prepare("SELECT * FROM post WHERE idpost=?");
                    $stmt2->bind_param("i", $linha->post_idpost);
                    $stmt2->execute();
                    $resultado2 = $stmt2->get_result();
                    while($linha2 = $resultado2->fetch_object()){
                        $img1 = '';
                        $stmt = $conn->prepare("SELECT * FROM post_fotos WHERE post_idpost=? ORDER BY foto ASC");
                        $stmt->bind_param("i", $linha->post_idpost);
                        $stmt->execute();
                        $resultado3 = $stmt->get_result();
                        while($linha3 = $resultado3->fetch_object()){
                            if($img1 == '')
                                $img1 = $linha3->foto;                               
                        }
                        $dia = new DateTime($linha->momento);
                        $dia = $dia->format('Y/m/d');
                        $div = "
                            <div class='item2'>
                                <div id='divimg'>
                                    <a href='perfil.php?id=$linha->idusuario' id='perfila'><img src='$linha->foto'></a>
                                </div>
                                <a href='perfil.php?id=$linha->idusuario'><h1><strong>$linha->nome</strong></h1></a>
                                <a href='postver.php?id=$linha2->idpost'><h2>$linha2->titulo</h2></a>
                                <div class='contpubli'><p>$linha2->post</p>
                                </div>
                                <div class='imgpubli'>
                                    <img src='$img1'>
                                </div>
                                <a>$dia</a>
                                <a href='postver.php?id=$linha2->idpost' class='comment'>Comentários</a>
                            </div>
                            
                        ";
                        echo $div;
                    }
                    
                }                
            }
        ?>
        </div>
        <br>
    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <script src="scripts/copiarLink.js"></script>
</body>
</html>