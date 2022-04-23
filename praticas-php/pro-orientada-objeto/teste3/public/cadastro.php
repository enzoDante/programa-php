<?php 
    include "../usuario.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: cadastro.php");
                exit();
            }
        }
    ?>
    <header><h1>titulo</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="login.php">Login</a>
            <a href="#">Cadastro</a>
        <?php else: ?>
            <p>logado <?php echo $_SESSION['nome']; ?></p>
            <a href="cadastro.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
    <?php 
            if($_SERVER['REQUEST_METHOD']== 'POST'){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $usu = new usuario();

                $usu->setnome($nome);
                $usu->setemail($email);
                $usu->setsenha($senha);

                $val = $usu->cadastro();
                #echo $val;
                header("Location: index.php");
                exit();
            }
        ?>
    
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="cadastro.php" id="f" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome"><br>
                <input type="text" name="email" id="email" placeholder="Email"><br>
                <input type="password" name="senha" id="senha" placeholder="Senha"><br>
                <input type="password" name="senha2" id="senha2" placeholder="Confirmar senha"><br>
                <button type="submit" onclick="impede()">Criar conta</button>
            </form><br>
        <?php endif; ?>
        


    </main>
    <script src="../codigo.js"></script>
    
</body>
</html>