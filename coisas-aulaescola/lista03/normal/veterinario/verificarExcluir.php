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
        <a href="tabelaveterinario.php">Voltar</a>
        <a href="veterinario.html">Cadastrar veterinário</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <hr>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <hr>
        <a href="../animal/animais.php">Cadastrar animais</a>
        <hr>
        <a href="../consulta/consultas.php">Marcar consulta</a>
        <a href="../consulta/tabelaconsultas.php">Lista de consultas</a>
    </nav>
    <main class="main">
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $msg = "<div id='t'><h3 id='t'>Deseja Remover cadastro?</h3>";
                $msg .= "<a class='linkmsg inlineblock' href='tabelaveterinario.php'>Voltar</a>";
                $msg .= "<a class='linkmsg inlineblock' href='excluirVet.php?id=$id'>Excluir</a></div>";
                echo $msg;
            }
        ?>
    </main>
    
</body>
</html>
<!--
    
-->