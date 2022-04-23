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
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <a href="#">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <p>logado <?php echo $_SESSION['nome']; ?></p>
            <a href="login.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
    <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nome = $_POST['nome'];
                $senha = $_POST['senha'];
                $usu = new usuario();

                $usu->setnome($nome);
                $usu->setsenha($senha);

                $val = $usu->login();
                #echo "<script>alert('$val')</script>";
                header("Location: login.php");
                #echo $val;
                exit();
            }
        ?>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="login.php" id="f" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome"><br>
                <input type="password" name="senha" id="senha" placeholder="Senha"><br>
                <button type="submit" onclick="impede2()">Logar</button>
            </form>
        <?php endif; ?>
        

    </main>
    <script src="../codigo.js"></script>
    
</body>
</html>