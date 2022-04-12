<?php 
    include "bd.php";

    

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
    <main>
        <form id="ff" action="index.php?a=xxa" method="post">
            <input type="text" name="nome" id="nome"><br>
            <input type="number" name="idade" id="idade"><br>
            <button type="submit" onclick="impede()">testeeee</button>
        </form><br>
        <a href="mostrar.php">ver os elementos da tabelaaaaaa</a>
    </main>
    
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_GET['a'])){
                if($_GET['a'] == "xxa"){

                    $nome = $_POST['nome'];
                    $idade = $_POST['idade'];
                    
                    $msg = "INSERT INTO usuario (nome, idade) values('$nome', $idade)";
                    mysqli_query($con, $msg);
                    $_GET['a'] = "x";
                    header("Location: index.php");
                }
            }
        }
        
    ?>
    <script src="bloqueio.js"></script>
</body>
</html>