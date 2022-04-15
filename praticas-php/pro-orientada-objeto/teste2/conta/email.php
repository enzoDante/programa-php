<?php 
    include "../usuario.php";
    session_start();
?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $id = $_SESSION['id_usuario'];

        $usu = new usuario();        
        $usu->atribuiremail($email);

        $msg = $usu->atualizaremail($id);
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
                header("Location ../index.php");
                exit();
            }
        }
    ?>

    <?php if(isset($_SESSION['id_usuario'])): ?>
        <form action="email.php" method="post" id="formu">
            <input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"><br>
            <button type="submit" onclick="impedeemail()">Salvar email</button>
        </form><br>
        <a href="email.php?a=logout">Sair</a><br><br>
        <a href="../conta.php">voltar</a><br>
    <?php endif; ?>
    

    <script src="../codigo.js"></script>
</body>
</html>