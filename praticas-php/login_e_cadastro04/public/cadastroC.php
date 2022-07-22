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
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: cadastro.php");
                exit();
            }
        }
    ?>
    <header>

    </header>
    <nav>

    </nav>
    <main>
        <?php
            if(!isset($_SESSION['idUsu'])){
                if(!isset($_POST['nome'])){
                    die("<h2>preencha o campo nome!</h2>");
                }
                if(!isset($_POST['email'])){
                    die("<h2>preencha o campo email!</h2>");
                }
                if(!isset($_POST['senha'])){
                    die("<h2>preencha o campo senha!</h2>");
                }
            
                $nome = strip_tags(str_replace(",","-", $_POST['nome']));
                $email = strip_tags(str_replace(",","-", $_POST['email']));
                $senha = strip_tags(str_replace(",","-", $_POST['senha']));
                $imagem_nome = "";

                if ($_FILES['imgp']['error'] != 4){
                    $pasta = "../imagens/";
                    $extensao = pathinfo($_FILES['imgp']['name']);
                    $extensao = ".".$extensao['extension'];

                    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                        $img = str_replace(" ", "_", $nome);
                        $imagem_nome = $pasta.date("Y-m-d-H-i-s").$img.$extensao;

                        if(move_uploaded_file($_FILES['imgp']['tmp_name'], $imagem_nome)){
                            echo "deu certo";
                        }else{
                            echo "n foi";
                        }

                    }else{
                        die("<h2>A imagem de perfil deve ser dos formatos png, jpg ou jpeg</h2>");
                    }
                    
                }else{
                    $imagem_nome = "../imagens/blank-profile-picture.png";
                }

                $usuario = new usuario();
                $usuario->setn($nome);
                $usuario->sete($email);
                $usuario->sets($senha);
                $usuario->setimgp($imagem_nome);            

                $valor = $usuario->cadastrar();
                if($valor == "")
                    header("Location: index.php");
            }else{
                echo '<a href="cadastro.php?a=logout">Sair</a>';
            }
        ?>
    </main>
    
</body>
</html>