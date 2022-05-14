<?php
include "valor.php";

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
        <h1>Carros para consumidores</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="num" id="" placeholder="valor do carro"><br>
            <button type="submit">custo final do carro</button>
        </form>
    </main>
    <?php 
        $dinheiro = new val();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $v = $_POST['num'];
        if($v <= 0){
            echo "<p>Digite um valor válido</p><br>";
        }else{
            $dinheiro->setval($v);
            $resp = $dinheiro->calcular();
            echo "<p>$resp</p>";
        }
    }
    ?>
</body>
</html>