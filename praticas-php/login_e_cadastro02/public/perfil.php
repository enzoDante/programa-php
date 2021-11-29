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

        $senhao = md5($_POST['senhao']);
        if($senhao != '4123d113b76978844361045548f5ac91'){
            $resultados = $ligacao->query("SELECT * FROM usuarios WHERE senha = '$senhao'");
            if($resultados->num_rows == 0){
                echo "<script>alert('senha inválida!!!')</script>";
            }else{
                $senhan = md5($_POST['senhan']);
                $sql = "update usuarios set senha = '$senhan' where id_usuario='$id'";
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
                    echo "Sessão finalizada!";
                    header("Location: perfil.php");
                    exit();
                }
            }
        ?>


        <a href="index.php">Página inicial</a>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>Usuário | <?php echo $_SESSION['nome']; ?></p>
            <a href="perfil.php?a=logout">Sair</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <h2>Perfil</h2>
            <form action="perfil.php" id="form" method="post">
                <h3 style="text-align: center;">Usuário</h3>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>"><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"><br>
                <label for="senhao">Digite a senha origional:</label>
                <input type="password" name="senhao" id="senhao" value="senhaaqui"><br>
                <label for="senhan">Nova senha:</label>
                <input type="password" name="senhan" id="senhan"><br>
                <button type="submit" onclick="validarm()">Salvar</button>
            </form>
            <script src="script.js"></script>
        <?php else: ?>
            <p>Você precisa estar logado para acessar esta página!</p>
        <?php endif; ?>
    </main>
    
</body>
</html>