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
        <h1>Baskara</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="a" id="" placeholder="Digite o valor de a:"><br>
            <input type="number" name="b" placeholder="Digite o valor de b:"><br>
            <input type="number" name="c" placeholder="Digite o valor de c:"><br>
            <button type="submit">Calcular</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calc = new bask();
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                if(empty($a) || $a == 0 || empty($b) || $b == 0 || empty($c) || $c == 0){
                    echo "<p>Digite valores nos campos acima!!!</p>";
                }else{
                    $calc->setvalues($a, $b, $c);

                    $x = $calc->calcular();
                    echo "<p>$x</p>";
                }
            }
        
        ?>
    </main>
    
</body>
</html>