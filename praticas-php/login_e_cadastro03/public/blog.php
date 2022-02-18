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
                    header("Location: blog.php");
                    exit();
                }
            }
        ?>

        <a href="index.php">Home</a>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>

            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="blog.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
        <div>
            <?php if(isset($_SESSION['id_usuario'])): ?>
                <a id="pub" href="criar.php">Publicar</a>
            <?php endif; ?>
        </div><hr>
        <article>
            <?php
                $resultado = $ligacao->query("SELECT id_post FROM postes");
                $dados_post = $resultado->fetch_assoc();
                #$_SESSION['id_post'] = $dados_post['id_post'];
                #echo $dados_post['id_post'];
                for($i = $resultado->num_rows; $i <= $resultado->num_rows; $i--){
                    #echo $i;
                    $resultadop = $ligacao->query("SELECT criador, titulo, video, comentarios FROM postes WHERE id_post='$i'");
                    $p = $resultadop->fetch_assoc();
                    $criador = $p['criador'];
                    $titulo1 = $p['titulo'];
                    $comentt = $p['comentarios'];

                    if($p['video'] == 0){
                        
                        echo "<article class='posta'><h2>$criador</h2><h3>$titulo1</h3><textarea id='coment' cols='70' rows='10' disabled>$comentt</textarea></article>";
                    }else{
                        $video1 = $p['video'];
                        echo "<article class='posta'><h2>$criador</h2><h3>$titulo1</h3>$video1<textarea id='coment' cols='70' rows='10' disabled>$comentt</textarea></article>";
                    }
                    



                    if($i == 1){
                        break;
                    }
                }
                exit();
                
                

            ?>
        </article>

    </main>
    
</body>
</html>