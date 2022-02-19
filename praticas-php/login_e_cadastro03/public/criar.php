<?php
    include "../banco.php";
    session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formu2.css">
    <link rel="stylesheet" href="botao.css">
</head>
<body>
    <header>
        <h1>Titulo</h1>
    </header>
    <nav>
        <?php 
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy();
                    header("Location: index.php");
                    exit();
                }
            }
        ?>

        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <?php if(!isset($_SESSION['id_usuario'])): ?>
        <a href="login.php">Login</a>
        <a href="cadastro.php">Cadastro</a>
        <?php else: ?>

        <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
        <a href="criar.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_SESSION['nome'];
                $titulo = $_POST['titulo'];
                $video = $_POST['video'];
                $coment = $_POST['comentarios'];
                $verificar = $ligacao->query("SELECT titulo FROM postes WHERE titulo='$titulo'");
                if($verificar->num_rows != 0){
                    echo "<script>alert('Esse título já existe!!!')</script>";
                }else{                

                    if($video == null){
                        $sql = "insert into postes (criador, titulo, comentarios) values('$nome','$titulo','$coment')";
                        mysqli_query($ligacao, $sql);

                        $id_do_post = $ligacao->query("SELECT id_post FROM postes WHERE titulo='$titulo'");
                        $idpostes = $id_do_post->fetch_assoc();
                        $dele = $ligacao->query("SELECT cont FROM contadordel");
                        $mostrarcont = $dele->fetch_assoc();

                        $val = $idpostes['id_post'] - $mostrarcont['cont'];

                        $sql = "update postes set id_post=$val where titulo='$titulo'";
                        mysqli_query($ligacao, $sql);
                        echo "<script>alert('Publicado!')</script>";
                        header("Location: criar.php");
                        exit();

                    }else{
                        $sql = "insert into postes (criador, titulo, video, comentarios) values('$nome','$titulo','$video','$coment')";
                        mysqli_query($ligacao, $sql);

                        $id_do_post = $ligacao->query("SELECT id_post FROM postes WHERE titulo='$titulo'");
                        $idpostes = $id_do_post->fetch_assoc();
                        $dele = $ligacao->query("SELECT cont FROM contadordel");
                        $mostrarcont = $dele->fetch_assoc();

                        $val = $idpostes['id_post'] - $mostrarcont['cont'];

                        $sql = "update postes set id_post=$val where titulo='$titulo'";
                        mysqli_query($ligacao, $sql);
                        echo "<script>alert('Publicado!')</script>";
                        header("Location: criar.php");
                        exit();
                    }
            }
            }
        ?>





        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <div>
                <p>Você precisa estar logado para acessar esta página!!!</p>
            </div>
        <?php else: ?>
            <form id="postar" action="criar.php" method="post">
                <input type="text" name="titulo" id="titu" placeholder="Digite o titulo">
                <input type="text" name="video" id="ifra" onchange="videom()" placeholder="Insira o incorporar do vídeo" autocomplete="off">
                <div id="video-aq">

                </div>
                <textarea name="comentarios" id="coment" cols="70" rows="10"></textarea>
                <button type="submit" onclick="publicar()">Publicar</button>
            </form>
            <script src="video.js"></script>
        <?php endif; ?>

    </main>
    
</body>
</html>