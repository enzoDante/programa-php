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
        <h1>Tabela com tipos de animais</h1>
    </header>
    <nav class="main">
        <a href="tipos_animais.html">Cadastrar tipos</a>
        
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
            $sql = "SELECT * FROM TipoAnimal ORDER By tipo;";
            $tabela = "<table id='tabela'>";
            $tabela .= "<tr><th></th> <th>Tipo</th> <th></th><th></th></tr>";
            if($resultado = $conn->query($sql)){
                while($linha = $resultado->fetch_object()){
                    $tabela .= "<tr>";
                    $id = $linha->idTipoAnimal;
                    $tabela .= "<td>". $linha->idTipoAnimal."</td>";
                    $tabela .= "<td>". $linha->tipo."</td>";
                    $tabela .= "<td> <a href='excluirTipo.php?id=$id'>Excluir registro</a> </td>";
                    $tabela .= "<td> <a href='formAlterarTipo.php?id=$id'>alterar</a> </td>";
                    $tabela .= "</tr>";
                }
            }
            $tabela .= "</table>";
            echo $tabela;
            $conn->close();

        ?>
    </main>
    
</body>
</html>