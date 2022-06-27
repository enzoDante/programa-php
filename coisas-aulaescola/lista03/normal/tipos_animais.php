<?php
    include "banco.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $tipo = strip_tags($_POST['tipo']);

        if(strlen($tipo) < 3)
            echo "<p>Digite um tipo com mais de 3 letras!</p>";
        else{
            $stm = $conn->prepare("INSERT INTO TipoAnimal (tipo) values(?)");
            $stm->bind_param('s', $tipo);
            $stm->execute();
            echo "Cadastro concluído";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav>

    </nav>
    <main>
        <form action="tipos_animais.php" method="post">
            <h3>Digite o tipo de animal:</h3><br>
            <input type="text" name="tipo" id=""><br>
            <button type="submit">Cadastrar animal</button>
        </form>
    </main>
    
</body>
</html>