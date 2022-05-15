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
        <h1>Fatorial</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="num" id="" placeholder="Digite um número:"><br>
            <button type="submit">Calcular</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calc = new fat();
                $num = $_POST['num'];
                if($num < 0){
                    echo "<p>Digite um valor positivo!</p>";
                }else{
                    $calc->setnum($num);
                    $fa = $calc->fatorial();
                    echo "<p>Fatorial de $num! é $fa</p>";
                }
            }
        ?>
    </main>
    
</body>
</html>