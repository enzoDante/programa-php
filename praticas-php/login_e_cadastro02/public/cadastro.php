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
    <link rel="stylesheet" href="styleform.css">
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
                    echo "<p>Sessão finalizada</p>";
                    header("Location: cadastro.php");
                    exit();
                }
            }
        ?>

        <a href="index.php">página inicial</a>

        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>Usuário | <a href="perfil.php"><?php echo $_SESSION['nome']; ?></a></p>
            <a href="cadastro.php?a=logout">Sair</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = md5($_POST['senha']);
        
                $resultados1 = $ligacao->query("SELECT nome FROM usuarios WHERE nome = '$nome'");
                $resultados2 = $ligacao->query("SELECT email FROM usuarios WHERE email = '$email'");
        
                if(($resultados1->num_rows != 0) || ($resultados2->num_rows != 0)){
                    echo "<p>conta existente!!!</p>";
                }else{
                    $sql = "insert into usuarios (nome,email,senha) values('$nome','$email','$senha')";
                    mysqli_query($ligacao,$sql);
                    echo "<p>cadastrado com sucesso!</p>";
                    echo "<a href='index.php'>Página inicial</a>";
                    exit();
                }
            }
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="cadastro.php" id="formc" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Usuário01" required><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="exemplo@exemp.com" required><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="senha123" required><br>
                <label for="rsenha">Insira a senha novamente:</label>
                <input type="password" id="rsenha" required placeholder="senha123"><br>
                <input type="checkbox" name="aceita" id="aceita">
                <label for="aceita">Aceita os termos!</label><br>
                <a href="login.php">Ja tenho uma conta</a>
                <button type="submit" onclick="validarc()" value="teste">Criar conta</button>
            </form>
            <script src="script.js"></script>
        <?php else: ?>
            <h2 style="text-align: center;">Você ja está cadastrado!</h2>
            <a href="index.php">Ir para página inicial</a>
        <?php endif; ?>
    </main>
    
</body>
</html>