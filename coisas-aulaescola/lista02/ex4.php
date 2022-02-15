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
        <p>exercício 04</p>
    </header>
    <main>
        <form action="ex4.php" method="get">
            <input type="number" name="idade" id="" placeholder="Digite sua idade..."><br>
            <button type="submit">Calcular seu tempo de vida</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $idade = $_GET['idade'];
                if($idade <= 2 || $idade >= 250){
                    echo "<p><span>Digite uma idade válida!!!</span></p>";
                }
                else{                
                    $dias = $idade * 365;
                    $horas = $dias * 24;
                    $minutos = $horas * 60;
                    $segundos = $minutos * 60;
                    echo "<p>Você está vivo a mais de: <br>
                    $dias dias<br>$horas horas<br>$minutos minutos<br>$segundos segundos
                    </p>";
                }
            }
        ?>
    </main>
    <footer>
        <p>Criado por Enzo Dante &copy;</p>
    </footer>
    
</body>
</html>