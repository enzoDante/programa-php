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
        <h1>titulo</h1>
    </header>
    <nav>
        <?php 
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy();
                    echo "<p>Sessão finalizada</p>";
                    header("Location: login.php");
                    exit();
                }
            }
        ?>

        <a href="index.php">Página inicial</a>
        
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>Usuário | <a href="perfil.php"><?php echo $_SESSION['nome']; ?></a></p>
            <a href="login.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>  
    <main>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ #post é mais seguro p informações de cadastro/login
                $nome = $_POST['nome'];
                $senha = md5($_POST['senha']); #md5 é um tipo de criptografia

                
                $resultados = $ligacao->query("SELECT * FROM usuarios WHERE nome='$nome' AND senha = '$senha'");

                if($resultados->num_rows == 0){
                    echo "<p>Login inválido!!!</p>";
                }else{
                    $dados_usuario = $resultados->fetch_assoc();

                    $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
                    $_SESSION['nome'] = $dados_usuario['nome'];

                    $_SESSION['email'] = $dados_usuario['email'];
                    echo "<a href='index.php'>Página inicial</a>";
                    exit();
                }
            }
        
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
        <form id="form" action="login.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Usuário01"><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="senha123"><br>
            <p><a href="cadastro.php">Criar uma conta</a></p><br>
            <button type="submit" onclick="validarl()">Logar</button>
        </form>
        <script src="script.js"></script>
        <?php else: ?>
            <h2 style="text-align: center;">Logado!</h2>
        <?php endif; ?>
    </main>
    
</body>
</html>