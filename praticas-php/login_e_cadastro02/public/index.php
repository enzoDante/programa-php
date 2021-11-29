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
    <title>Título</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Título</h1>
    </header>
    <nav>
        <?php 
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy();
                    echo "Sessão finalizada!";
                    header("Location: index.php");
                    exit();
                }
            }
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Login</a>
        <?php else: ?>
            <p style="color: white;">voce esta logado!</p>
            <p>Usuário | <a href="perfil.php"><?php echo $_SESSION['nome']; ?></a></p>
            <a href="index.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
        <p>página inicial</p><br>
        <h2>Qualquer coisa aqui...</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, vitae blanditiis laborum nemo magni sint nostrum molestias. Sequi repudiandae facilis nulla veritatis? Aspernatur vitae commodi sequi non ducimus debitis quisquam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste accusamus aperiam molestias, blanditiis dignissimos odit tenetur porro animi natus vero eius, ea eaque cumque nostrum eum vel consectetur asperiores id?</p>


    </main>
    
</body>
</html>