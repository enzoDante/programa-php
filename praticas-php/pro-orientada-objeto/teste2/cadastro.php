<?php 
    include "usuario.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $usu = new usuario();

                $usu->atribuirnome($nome);
                $usu->atribuiremail($email);
                $usu->atribuirsenha($senha);
                echo $usu->atribuirnome($nome);

                $x = $usu->cadastrar();
                echo $x;
            }
        
        ?>
        <?php 
            if(isset($_GET['a'])){
                if($_GET['a'] == 'logout'){
                    session_destroy();
                    header("Location: cadastro.php");
                    exit();
                }
            }
        ?>




        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="cadastro.php" id="formu" method="post">
                <input type="text" name="nome" placeholder="nome" id="nome"><br>
                <input type="text" name="email" placeholder="email" id="email"><br>
                <input type="password" name="senha" placeholder="senha" id="senha"><br>
                <input type="password" name="" placeholder="confirmar senha" id="confsenha"><br>
                <button type="submit" onclick="impede()">cadastrar</button>
            </form><br><br><br>

            <a href="index.php">index</a><br>
            <a href="login.php">logar</a><br>
        <?php else: ?>
            <p>logado = <?php echo $_SESSION['nome']; ?></p>
            <a href="index.php">index</a><br>
            <a href="cadastro.php?a=logout">Deslogar sair da conta</a>

        <?php endif; ?>
        <script src="codigo.js"></script>
    </main>
    
</body>
</html>