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
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav>
        <a href="formAlterarTipo.php">Voltar</a>
        <a href="tipos_animais.html">Cadastrar tipos</a>
        <a href="tabela_tipos.php">Tabela de tipos</a>
    </nav>
    <main>
        <?php
            $id = $_POST['id'];
            $nome = strip_tags($_POST['tipo']);
            $nome = strtolower($nome);
            $nome = str_replace(",", "-", $nome);
        
            $preparar = $conn->prepare("UPDATE tipoAnimal SET tipo=? WHERE idTipoAnimal=?;");
            $preparar->bind_param("si", $nome, $id);
            $preparar->execute();
            echo "<p class='msg'>Alterado com sucesso</p>";
            echo "<a class='linkmsg' href='tabela_tipos.php'>Voltar para tabelas de tipos</a>";
        ?>
    </main>
    
</body>
</html>