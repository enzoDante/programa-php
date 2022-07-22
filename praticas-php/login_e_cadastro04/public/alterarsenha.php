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
                if(!isset($_POST['senha'])){
                    die("<h2>preencha o campo senha!</h2>");
                }
                if(!isset($_POST['senha2'])){
                    die("<h2>preencha o campo email!</h2>");
                }
            
                $senha = strip_tags(str_replace(",","-", $_POST['senha']));
                $senha2 = strip_tags(str_replace(",","-", $_POST['senha2']));
                if(($senha != "") && ($senha == $senha2)){
                    $usuario = new usuario();
                    $usuario->sets($senha);
    
                    $usuario->alterarsenha();

                }

                header("Location: perfil.php");


            }


        ?>
    </main>

</body>
</html>