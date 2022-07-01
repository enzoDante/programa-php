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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        <a href="tabela_tipos.php">Voltar</a>
        <a href="tipos_animais.html">Cadastrar tipo</a>
    </nav>
    <nav class="sidenav">
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <hr>
        <a href="../animal/animais.php">Cadastrar animais</a>
        <hr>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
        <hr>
        <a href="../consulta/consultas.php">Marcar consulta</a>
        <a href="../consulta/tabelaconsultas.php">Lista de consultas</a>
    </nav>
    <main class="main">
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