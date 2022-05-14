<?php
    include "classe.php";
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
    <header><h1>Conceitos de notas</h1></header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="nota" id="" placeholder="Digite sua nota:"><br>
            <button type="submit">Calcular</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $conc = new conceito();
                $nota = $_POST['nota'];
                if($nota < 0 || $nota > 10){
                    echo "<p>Digite uma nota válida!</p>";
                }else{
                    $conc->setnota($nota);
                    $x = $conc->calcular();
                    echo "<p>Conceito é: $x</p>";
                }

            }
        ?>

    </main>
</body>
</html>