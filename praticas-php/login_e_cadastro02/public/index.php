<?php
include "../banco.php"; #página principal, não importa muito aqui
    session_start(); #importante para caso o usuário esteja logado

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
        <?php #verifica se o usuário apertou p sair da conta logada
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy(); #isso q faz o "logout" do usuário
                    echo "Sessão finalizada!"; #nn é necessário
                    header("Location: index.php"); #manda o usuário p esse arquivo
                    exit();
                }
            }
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?> <!--verifica se está logado-->
            <a href="login.php">Login</a> <!--se n estiver logado, te esse link de login-->
        <?php else: ?>
            <p style="color: white;">voce esta logado!</p>
            <!--com o echo abaixo é possível mostrar informações do usuário-->
            <p>Usuário | <a href="perfil.php"><?php echo $_SESSION['nome']; ?></a></p>
            <a href="index.php?a=logout">Sair</a><!--variável "a" terá valor de "logout" uma função acima-->
        <?php endif; ?>
    </nav>
    <main>
        <p>página inicial</p><br>
        <h2>Qualquer coisa aqui...</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, vitae blanditiis laborum nemo magni sint nostrum molestias. Sequi repudiandae facilis nulla veritatis? Aspernatur vitae commodi sequi non ducimus debitis quisquam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste accusamus aperiam molestias, blanditiis dignissimos odit tenetur porro animi natus vero eius, ea eaque cumque nostrum eum vel consectetur asperiores id?</p>


    </main>
    
</body>
</html>