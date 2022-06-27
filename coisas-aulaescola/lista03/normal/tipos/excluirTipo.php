<?php
    include "../banco.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav>
        <a href="tabela_tipos.php">Voltar</a>
        <a href="tipos_animais.html">Cadastrar tipo</a>
    </nav>
    <main>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $stm = $conn->prepare("DELETE FROM TipoAnimal WHERE idTipoAnimal = ?");
                $stm->bind_param('i', $id);
                $stm->execute();
                echo "<p class='msg'>Excluído com sucesso!</p>";
                echo "<a class='linkmsg' href='tabela_tipos.php'>Voltar</a>";
            }
        ?>
    </main>
    
</body>
</html>