<?php
    include "../usuario.php";
    session_start();
?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $senha = $_POST['senha'];
        $id = $_SESSION['id_usuario'];
    
        $usu = new usuario();
        $usu->atribuirsenha($senha);

        $msg = $usu->atualizarsenha($id);
        echo $msg;
    }

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
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: ../index.php");
                exit();
            }
        }
    
    ?>
    <main>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <form action="senha.php" method="post" id="formu">
                <input type="password" name="senha" id="senha" placeholder="senha"><br>
                <input type="password" name="csenha" id="csenha" placeholder="confirmar senha"><br>
                <button type="submit" onclick="impedesenha()">Salvar senha</button>
            </form><br><br>
            <a href="../index.php">index</a><br>
            <a href="../conta.php">voltar</a><br><br>
            <a href="senha.php?a=logout">Sair</a>
        <?php endif; ?>
    </main>
    
    <script src="../codigo.js"></script>
</body>
</html>