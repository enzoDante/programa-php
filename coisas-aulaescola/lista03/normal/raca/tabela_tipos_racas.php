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
        <a href="racas_animais.php">Cadastrar raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
    </nav>
    <main>
        <?php
            $sql = "SELECT * FROM TipoAnimal, RacaAnimal ORDER BY tipo, raca;";
            $tabela = "<table id='tabela'>";
            if($resultado = $conn->query($sql)){
                while($linha = $resultado->fetch_object()){
                    if($linha->idTipoAnimal == $linha->TipoAnimal_idTipoAnimal){

                        $tabela .= "<tr>";
                        //$id = $linha->idTipoAnimal;
                        $tabela .= "<td>". $linha->idTipoAnimal."</td>";
                        $tabela .= "<td>". $linha->tipo."</td>";                   
                        $tabela .= "<td>". $linha->raca."</td>";
                        //$tabela .= "<td> <a href='excluirTipo.php?id=$id'>Excluir registro</a> </td>";
                        //$tabela .= "<td> <a href='formAlterarTipo.php?id=$id'>alterar</a> </td>";
                        $tabela .= "</tr>";
                    }
                }
            }
            $tabela .= "</table>";
            echo $tabela;
            $conn->close();
        ?>
    </main>
    
</body>
</html>