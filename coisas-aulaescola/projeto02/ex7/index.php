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
        <h1>IMC</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="peso" step="any" placeholder="Digite seu peso:"><br>
            <input type="number" name="altura" step="any" placeholder="Digite a sua altura:"> <br>
            <button type="submit">Calcular</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calc = new imc();
                $peso = $_POST['peso'];
                $altura = $_POST['altura'];
                if($peso <= 0 || $altura <= 0){
                    echo "<p>Digite valores válidos!!</p>";
                }else{
                    $calc->setp($peso);
                    $calc->seta($altura);

                    $msg = $calc->calcular();
                    echo "$msg";
                    $calc->ideal();
                }

            }
        ?>
    </main>
    
</body>
</html>