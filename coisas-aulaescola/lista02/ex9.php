<!DOCTYPE html>
<html lang="pt-br">
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
            max-width: 700px;
            min-height: 100px;
            margin: auto;
            border-style: solid;
            border-radius: 20px;
            padding: 50px;
        }
        form > input, form > button{
            text-align: center;
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
    <header>
        <h1>lista 02</h1>
        <p>exercício 09</p>
    </header>
    <main>
        <form action="ex9.php" method="get"><br>
            <input type="number" name="peso" step="any" placeholder="Digite seu peso:"><br>
            <input type="number" name="altura" step="any" placeholder="Digite a sua altura:"> <br>

            <button type="submit" name="teste" value="ee">Calcular</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(isset($_GET['teste'])){
                    $x = $_GET['teste'];
                    
                    if($x == "ee"){
                        $massa = $_GET["peso"];
                        $altura = $_GET['altura'];
                        if($massa <= 0 || $altura <= 0){
                            echo "<p>Digite uma massa ou altura válida!!!</p>";
                        }else{
                            $imc = number_format($massa / ($altura * $altura),2,',');
                            echo "<p>IMC = $imc</p>";

                            if($imc < 20){
                                echo "<p>IMC abaixo de 20 --- abaixo do peso</p>";
                            }
                            else if($imc >= 20 && $imc < 25){
                                echo "<p>IMC de 20 até 25 --- peso normal</p>";
                            }
                            else if($imc >= 25 && $imc < 30){
                                echo "<p>IMC de 25 até 30 --- sobre peso</p>";
                            }
                            else if($imc >= 30 && $imc < 40){
                                echo "<p>IMC de 30 até 40 --- obeso</p>";
                            }
                            else if($imc >= 40){
                                echo "<p>IMC de 40 e acima --- obeso mórbido</p>";
                            }

                        }     

                    }

                }
                

            }
        ?>
    </main>
    <footer>
        <p>Criado por <a href="https://github.com/enzoDante" target="_blank">Enzo Dante</a> &copy;</p>
    </footer>
    
</body>
</html>

