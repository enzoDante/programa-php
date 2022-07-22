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
        include "class_cliente.php";
        $cliente = new cliente();
        $vetor = $cliente->olhatudo();
        $total = count($vetor);
        $tbl = "<table border='1'>";
        for($i = 0; $i < $total; $i++){
            $id = $vetor[$i]->getid();
            $tbl .= "<tr>";
            $tbl .= "<td>".$vetor[$i]->getnome()."</td>";
            $tbl .= "<td>".$vetor[$i]->getemail()."</td>";
            $tbl .= "<td>".$vetor[$i]->getsenha()."</td>";
            $tbl .= "<td>".$vetor[$i]->getdata()."</td>";
            $tbl .= "<td>".$vetor[$i]->getsalario()."</td>";
            $tbl .= "<td><a href='alterar.php?id=$id'>Alterar</a></td>";
            $tbl .= "<td><a href='excluir.php?id=$id'>Excluir</a></td>";
            $tbl .= "</tr>";
        }
        $tbl .= "</table>";
        echo $tbl;
        echo '<a href="index.html">cadastrar</a><br>';
        echo '<a href="olha_um.html">Olhar um</a>';

    ?>
</body>
</html>