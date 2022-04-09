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
        <p>exercício 07</p>
    </header>
    <main>
        <form action="ex7.php" method="get"><br>
            <input type="number" name="nota1" id="" placeholder="Digite a 1º nota"> <br>
            <input type="number" name="nota2" id="" placeholder="Digite a 2º nota"> <br>
            <input type="number" name="nota3" id="" placeholder="Digite a 3º nota"><br>

            <button type="submit" name="teste" value="ee">Calcular</button>
        </form>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(isset($_GET['teste'])){
                    $x = $_GET['teste'];
                    
                    if($x == "ee"){
                        $n1 = $_GET["nota1"];
                        $n2 = $_GET["nota2"];
                        $n3 = $_GET["nota3"];
                        
                        $media = number_format(($n1 + $n2 + $n3)/3, 1, ',');

                        echo "<p>Média = $media </p>";
                        if($media >= 7){
                            echo "<p>Aprovado!!!!!!!!!</p>";
                        }else{
                            echo "<p>Infelizmente reprovado</p>";
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

