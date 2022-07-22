<?php
    date_default_timezone_set('America/Sao_Paulo');
    include "../usuario.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header></header>
    <nav></nav>
    <main>
        <?php
            if(isset($_SESSION['idUsu'])){
                
                $imagem_nome = "";
                $pasta = "../imagens/";
                $extensao = pathinfo($_FILES['imgp']['name']);
                $extensao = ".".$extensao['extension'];

                if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                    $img = str_replace(" ", "_", $_SESSION['nome']);
                    $imagem_nome = $pasta.date("Y-m-d-H-i-s").$img.$extensao;

                    if(move_uploaded_file($_FILES['imgp']['tmp_name'], $imagem_nome)){
                        echo "deu certo";
                        if(file_exists($_SESSION['imgperfil'])){
                            unlink($_SESSION['imgperfil']);
                        }
                    }else{
                        echo "n foi";
                    }

                }else{
                    die("<h2>A imagem de perfil deve ser dos formatos png, jpg ou jpeg</h2>");
                }
                    
                

                $usuario = new usuario();
                $usuario->setimgp($imagem_nome);
                $usuario->alterarimgp();

                header("Location: perfil.php");


            }
        
        ?>
    </main>


</body>
</html>