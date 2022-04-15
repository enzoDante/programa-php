<?php 
    include "../usuario.php";
    session_start();
?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];

        $id = $_SESSION['id_usuario'];

        $usu = new usuario(); //cria um novo objeto 
        $usu->atribuirnome($nome); //dentro do objeto irá receber o valor nome
        $msg = $usu->atualizarnome($id); //vai atualizar esse nome no banco de dados
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

    <?php if(isset($_SESSION['id_usuario'])): ?>
        <form action="nome.php" method="post" id="formu">
            <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>"><br>
            <button type="submit" onclick="impedenome()">Salvar</button>
        </form><br>
        <a href="../index.php">index</a><br><br>
        <a href="nome.php?a=logout">logout sair</a><br><br>
        <a href="../conta.php">voltar</a><br>
    <?php else: ?>
        <p>você n pode acessar aq >:(</p>
    <?php endif; ?>

    <script src="../codigo.js"></script>
</body>
</html>