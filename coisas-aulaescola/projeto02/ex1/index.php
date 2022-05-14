<?php
    include "ex1oop.php";
    
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
    <header></header>
    <main>
        <form action="index.php" method="post">
            <p>Salário Bruto</p>
            <input type="number" name="salario-bruto" step="any" placeholder="Digite seu salário bruto..."><br>
            <p>Horas de trabalho</p>
            <input type="number" name="horas" id="" placeholder="Digite as horas de trabalho"><br>
            <p>Valor recebido por hora</p>
            <input type="number" name="valorHoras" step="any" placeholder="Digite o valor recebido por hora"><br>
            <button type="submit">Calcular salário líquido</button>
        </form>
    
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $ob = new pessoa();
    
            $salario = $_POST['salario-bruto'];
            $h = $_POST['horas'];
            $sh = $_POST['valorHoras'];
            if($salario <= 0 || $h <= 0 || $sh <= 0){
                echo "<p>Digite valores válidos!!!</p><br>";
            }else{
                $ob->setval($salario, $h, $sh);
            
                $salariol = $ob->calcular();
                echo "<p>Salário líquido: $salariol</p>";

            }
        
        }
    ?>
    </main>
    
</body>
</html>