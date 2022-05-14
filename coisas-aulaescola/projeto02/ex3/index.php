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
        <h1>Calculadora</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="number" name="num1" autocomplete="off" placeholder="Digite um número:"><br>
            <input type="number" name="num2" autocomplete="off" placeholder="Digite outro número:"><br>
            <select name="op_aritmeticos" id="">
                <option value="1">Somar +</option>
                <option value="2">Subtração -</option>
                <option value="3">Multiplicação *</option>
                <option value="4">Divisão /</option>
            </select><br>
            <button type="submit">Calcular</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calculadora = new cal();
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $op = $_POST['op_aritmeticos'];

                if(empty($num1) || empty($num2)){
                    echo "<p>Digite algum valor nos campos!</p>";
                }else{
                    $calculadora->setnum1($num1);
                    $calculadora->setnum2($num2);
                    $calculadora->setop($op);

                    $valor = $calculadora->calcular();
                    echo "<p>O valor calculado é: $valor</p>";

                }

            }

        ?>
    </main>
    
</body>
</html>