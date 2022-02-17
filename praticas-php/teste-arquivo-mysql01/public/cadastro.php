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
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                echo "sessão finalizada!";
                header("Location: cadastro.php");
                exit();
            }
        }
    ?>
    <main>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <a href="login.php?a=logout">logout</a>
        <?php endif; ?>
        <a href="login.php">pagina de login</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = md5($_POST['senha']);

                $resultado = $ligacao->query("SELECT nome, email FROM usuarios WHERE nome='$nome' AND email='$email'");

                if($resultado->num_rows != 0){
                    echo "Conta existente";
                }else{
                    $sql = "insert into usuarios (nome, email, senha) values('$nome','$email','$senha')";
                    mysqli_query($ligacao, $sql);
                    echo "cadastrado com sucesso!!!";
                    exit();
                }

            }
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="cadastro.php" method="post">
                <p>Nome</p>
                <input type="text" name="nome" id="">
                <p>Email</p>
                <input type="text" name="email" id="">
                <p>Senha</p>
                <input type="password" name="senha" id="">
                <button type="submit">cadastrar</button>

            </form>
        <?php endif; ?>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>Você ja esta logado!!!! <?php echo $_SESSION['nome']; ?></p>

        <?php endif; ?>
    </main>
    
</body>
</html>