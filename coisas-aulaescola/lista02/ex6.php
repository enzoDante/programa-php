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
            max-width: 1000px;
            min-height: 100px;
            margin: auto;
            border-style: solid;
            border-radius: 20px;
            padding: 50px;
        }
        form > button{
            text-align: center;
            display: block;
            margin: auto;
            font-size: 1.5em;
        }
        input{
            width: 100px;
            margin: 30px;
            display: inline-block;
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
        <p>exercício 06</p>
    </header>
    <main>
        <form action="ex6.php" method="get"><br>
            <input type="number" name="l350ml" id=""> <label for="l350ml">Lata de 350 ml</label>
            <input type="number" name="g600ml" id=""> <label for="g600ml">Garrafa de 600 ml</label>
            <input type="number" name="g2l" id=""> <label for="g2l">Garrafa de 2 litros</label><br>

            <button type="submit" name="teste" value="ee">Calcular</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(isset($_GET['teste'])){
                    $x = $_GET['teste'];
                    
                    if($x == "ee"){
                        $l350ml = $_GET["l350ml"];
                        $g600ml = $_GET["g600ml"];
                        $g2l = $_GET["g2l"];
                        $total_litros = 0;

                        if($l350ml > 0){
                            $total_litros += $l350ml * 350;
                        }
                        if($g600ml > 0){
                            $total_litros += $g600ml * 600;
                        }
                        $total_litros = $total_litros / 1000;
                        if($g2l > 0){
                            $total_litros += $g2l * 2;
                        }
                        echo "<p>Total de litros = $total_litros L</p>";

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

