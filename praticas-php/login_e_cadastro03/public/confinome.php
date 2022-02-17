<?php 
    include "../banco.php";
    session_start();


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $id = $_SESSION['id_usuario'];
        $sql = "update usuarios set nome='$nome', email='$email' where id_usuario='$id'";
        mysqli_query($ligacao, $sql);

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        #---------------------------------método da senha abaixo---------
        $senha = $_POST['senha'];
        $senhaoriginal = md5($_POST['senhaoriginal']);

        if($senha != null){
            $senha = md5($_POST['senha']);
            $resultado = $ligacao->query("SELECT * FROM usuarios WHERE senha='$senhaoriginal'");
            if($resultado->num_rows == 0){
                echo "<script>alert('Senha inválida')</script>";
            }else{
                $sql = "update usuarios set senha='$senha' where id_usuario='$id'";
                mysqli_query($ligacao, $sql);
            }

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
                    header("Location: confinome.php");
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
            <a href="confinome.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>


        <?php if(isset($_SESSION['id_usuario'])): ?>
            <form id="formulario" action="confinome.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
                <label for="senhaoriginal">Digite a senha atual:</label>
                <input type="password" name="senhaoriginal" id="senoriginal" placeholder="sua senha atual">
                <label for="senha">Senha nova:</label>
                <input type="password" name="senha" id="sennova" placeholder="digite a nova senha">
                <label for="rsenha">Digite novamente a senha:</label>
                <input type="password" name="rsenha" id="sennova2" placeholder="repita a senha novamente">
                <button type="submit" onclick="valperfil()">Salvar</button>
            </form>
            <script src="script.js"></script>
        <?php else: ?>

            <div>
                <h2>Você precisa estar logado para acessar esta página!</h2>
                <p>Ir para página principal <a href="index.php">clicando aqui!</a></p>
                <p>Criar uma conta <a href="cadastro.php">clicando aqui!</a></p>
            </div>
        <?php endif; ?>
    </main>
    
</body>
</html>