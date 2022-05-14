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
        <h1></h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="text" name="nome" id="" placeholder="Digite o nome do aluno:"><br>
            <input type="number" name="nota" id="" placeholder="Digite a nota:"><br>
            <button type="submit">Adicionar</button>
        </form>
        <?php
        #=====================================não funciona============================
            $calc = new tabela();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $nome = $_POST['nome'];
                $nota = $_POST['nota'];
                if(empty($nome) || $nota < 0 || $nota > 10){
                    echo "<p>Digite os valores corretamente!</p>";
                }else{
                    $x = $calc->setvalores($nome, $nota);
                    echo "$x<br>";
                }
            }
        ?>
    </main>

    
</body>
</html>