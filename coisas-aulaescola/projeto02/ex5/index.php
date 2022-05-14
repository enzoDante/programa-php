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
    <header>
        <h1>Pares e impares</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="num" id="" placeholder="Digite um valor inteiro:"><br>
            <button type="submit">Calcular</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $parimpar = new pim();
                $num = $_POST['num'];
                
                $parimpar->setnum($num);
                $x = $parimpar->calcular();
                echo "<p>$x</p>";
            }
        
        ?>
    </main>
    
</body>
</html>