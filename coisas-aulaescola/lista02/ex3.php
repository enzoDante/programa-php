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
    <header>
        <h1>lista 02</h1>
        <p>exercício 03</p>
    </header>
    <main>
        <form action="ex3.php" method="get">
            <input type="number" name="km-r" id="" placeholder="Digite KM rodados..."><br>
            <input type="number" name="combustivel" id="" placeholder="Digite a quantidade de combustível"><br>
            <button type="submit">Calcular combustível gasto</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
               
                if(isset($_GET['km-r'])){
                    $km = $_GET["km-r"];
                    $comb = $_GET['combustivel'];
                    $gasto = $km/$comb;
                    echo "<br>";
                    echo "<p>Consumo médio de $gasto Km/L</p>";
                }

            }
        ?>
    </main>
    <footer>
        <p>Criado por <a href="https://github.com/enzoDante" target="_blank">Enzo Dante</a> &copy;</p>
    </footer>
    
</body>
</html>

