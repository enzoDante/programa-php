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
    <style>
        body{
            background-color: #8BADFC;
            margin: 0;
            padding: 0;
        }
        header{
            min-width: 200px;
            min-height: 50px;
            padding: 20px;
            background-color: #8BE9FC;
            box-shadow: 1px 1px 2px #8BBFE6;
            text-align: center;
        }
        main{
            min-width: 300px;
            max-width: 1000px;
            min-height: 600px;
            background-color: white;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 50px;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 1px 1px 2px black;
        }
        form{
            max-width: 500px;
            min-height: 100px;
            margin: auto;
            border-style: solid;
            border-radius: 20px;
            padding: 50px;
        }
        form > input, form > button{
            display: block;
            margin: auto;
            font-size: 1.5em;
        }
        p{
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }
        footer{
            min-width: 200px;
            min-height: 30px;
            background-color: #8BE9FC;
            text-align: center;
            padding: 20px;
        }
        footer > p{
            margin: 0;
        }
    </style>
</head>
<body>
    <header></header>
    <main>
        <form action="index.php" method="post">
        <input type="number" name="salario-bruto" step="any" placeholder="Digite seu salário bruto..."><br>
                <input type="number" name="horas" id="" placeholder="Digite as horas de trabalho"><br>
                <input type="number" name="valorHoras" step="any" placeholder="Digite o valor recebido por hora"><br>
                <button type="submit">Calcular salário líquido</button>
        </form>
    
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $ob = new pessoa();
    
            $salario = $_POST['salario-bruto'];
            $h = $_POST['horas'];
            $sh = $_POST['valorHoras'];
        
            $ob->setval($salario, $h, $sh);
        
            $salariol = $ob->calcular();
            echo "<p>Salário líquido: $salariol</p>";
        }
    ?>
    </main>
    
</body>
</html>