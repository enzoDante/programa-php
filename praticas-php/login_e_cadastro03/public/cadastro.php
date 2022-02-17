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
                    header("Location: cadastro.php");
                    exit();
                }
            }
        ?>


        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Login</a>
        <?php else: ?>
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="cadastro.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = md5($_POST['senha']);

                $resultado = $ligacao->query("SELECT nome, email FROM usuarios WHERE nome='$nome' AND email='$email'");

                if($resultado->num_rows != 0){
                    echo "<div><p>Conta existente!!!</p></div>";
                }else{
                    $sql = "insert into usuarios (nome, email, senha) values('$nome', '$email','$senha')";
                    mysqli_query($ligacao, $sql);
                    echo "<div><p>Conta criada com sucesso!!!</p></div>";
                    echo "<a href='index.php'>Página inicial</a>";
                    exit();
                }
            }
        ?>


        <?php if(!isset($_SESSION['id_usuario'])): ?>

            <form id="formulario" action="cadastro.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="exemplo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="exemplo123">
                <label for="rsenha">Digite novamente sua senha:</label>
                <input type="password" name="rsenha" id="rsenha" placeholder="exemplo123">
                <input type="checkbox" name="aceita" id="aceita">
                <label for="aceita">Aceita os termos!</label><br>
                <a href="login.php">Ja tenho uma conta</a><br>
                <button type="submit" onclick="valcadastro()">Criar conta</button>
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