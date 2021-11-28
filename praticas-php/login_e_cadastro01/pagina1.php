<?php 

    session_start();

    /*if(!isset($_SESSION['id_usuario'])){
        echo "você deve logar para acessar esta página!!!";
        echo '<br><a href="view_cadastro_login.php">voltar</a>';

    }
*/

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            echo 'sessão terminada <a href="view_cadastro_login.php">Voltar</a>';
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
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <h1>pagina privada!</h1>
        <p>apenas usuarios logados podem entrar aqui!!!!</p>
    </header>

<?php if(!isset($_SESSION['id_usuario'])): ?>
    <h2>Você não tem acesso a esta página!!!</h2>
    <p><a href="view_cadastro_login.php">Voltar</a></p>

<?php else: ?>

    <main>
        <h1>Deu certo???</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa sequi soluta ad id doloremque amet voluptatem, aliquid reiciendis voluptates non tempore, libero vel aut enim, laudantium officiis tempora nobis ratione!</p>
        <a href="view_cadastro_login.php">Voltar</a><br>
        <a href="pagina1.php?a=logout">Sair da conta</a>
    </main>
    
</body>
</html>

<?php endif; ?>