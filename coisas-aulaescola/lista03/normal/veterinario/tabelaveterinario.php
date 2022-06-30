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
    <nav class="main">
        <a href="veterinario.html">Cadastrar veterinário</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipo/tipos_animais.php">Cadastrar tipos</a>
        <a href="../tipo/tabela_tipos.php">Lista de tipos</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
    </nav>
    <main class="main">
        <?php
            $sql = "SELECT * FROM Veterinario";
            $tabela = "<table id='tabela'>";
            $tabela .= "<tr><th>Nome</th> <th>Email</th> <th>CRMV</th> <th>CPF</th> <th></th> <th></th></tr>";
            if($resultado = $conn->query($sql)){
                while($linha = $resultado->fetch_object()){
                    $id = $linha->idVeterinario;
                    $tabela .= "<tr>";
                    $tabela .= "<td>".$linha->nome."</td>";
                    $tabela .= "<td>".$linha->email."</td>";
                    $tabela .= "<td>".$linha->CRMV."</td>";
                    $tabela .= "<td>".$linha->cpf."</td>";
                    $tabela .= "<td> <a href='verificarExcluir.php?id=$id'>Excluir registro</a> </td>";
                    $tabela .= "<td> <a href='formAlterarVet.php?id=$id'>alterar</a> </td>";
                    $tabela .= "</tr>";
                }
            }
            $tabela .= "</table>";
            echo $tabela;
            echo "<a class='linkmsg' href='veterinario.html'>Cadastrar Veterinário</a>";
            $conn->close();
        ?>
    </main>
    
</body>
</html>