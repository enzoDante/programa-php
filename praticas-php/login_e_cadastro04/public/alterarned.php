<?php
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
                if(!isset($_POST['nome'])){
                    die("<h2>preencha o campo nome!</h2>");
                }
                if(!isset($_POST['email'])){
                    die("<h2>preencha o campo email!</h2>");
                }
                if(!isset($_POST['desc'])){
                    die("<h2>preencha o campo senha!</h2>");
                }
            
                $nome = strip_tags(str_replace(",","-", $_POST['nome']));
                $email = strip_tags(str_replace(",","-", $_POST['email']));
                $desc = strip_tags(str_replace(",","_", $_POST['desc']));

                $usuario = new usuario();
                $usuario->setn($nome);
                $usuario->sete($email);
                $usuario->setd($desc);

                $usuario->alterarned();
                header("Location: perfil.php");


            }
        
        ?>
    </main>


</body>
</html>