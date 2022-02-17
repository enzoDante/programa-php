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
    <header>

    </header>
    <main>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <p>teste---- <?php echo $_SESSION['nome']; ?></p>
        <?php endif; ?>
        <a href="cadastro.php">Pagina de login e cadastro</a>
    </main>
    
</body>
</html>