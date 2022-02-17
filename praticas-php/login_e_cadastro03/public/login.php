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
    <link rel="stylesheet" href="formu.css">
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
                    header("Location: login.php");
                    exit();
                }
            }
        ?>

        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="login.php?a=logout">Sair</a>
        <?php endif;?>
    </nav>
    <main>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nomee = $_POST['nome-email'];
                $senha = md5($_POST['senha']);

                $resultado = $ligacao->query("SELECT * FROM usuarios WHERE senha='$senha' AND nome='$nomee' OR email='$nomee' AND senha='$senha'");

                if($resultado->num_rows == 0){
                    echo "<p>Login inválido</p>";
                }else{
                    $dados_usu = $resultado->fetch_assoc();

                    $_SESSION['id_usuario'] = $dados_usu['id_usuario'];
                    $_SESSION['nome'] = $dados_usu['nome'];
                    $_SESSION['email'] = $dados_usu['email'];
                    header("Location: login.php");
                    exit();
                }
            }
        ?>



        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form id="formulario" action="login.php" method="post">
                <label for="nome-email">Nome de usuário ou E-mail:</label>
                <input type="text" name="nome-email" id="nomee" placeholder="Usuário...">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Senha...">
                <button type="submit" onclick="vallogin()">Entrar</button>

            </form>
            <script src="script.js"></script>
        <?php else: ?>

                <div>
                    <h2>Você já esta logado!</h2>
                    <p>Ir para página principal <a href="index.php">clicando aqui!</a></p>
                </div>
        <?php endif; ?>
    </main>
    
</body>
</html>