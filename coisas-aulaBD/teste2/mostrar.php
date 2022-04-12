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
        <br><br>
        <a href="index.php">index aqui</a>
    </main>
</body>
</html>


<?php 
    

    $linhas = $con->query("SELECT * FROM usuario"); #linhas recebe tudo de todas as linhas da tabela
    if($linhas->num_rows != 0){ #num_rows total de linhas da tabela
        echo "<p>existe elementos</p>";
        #$element = $x->fetch_assoc();
        echo $linhas->num_rows;
        $total = $linhas->num_rows; #total recebe total de linhas da tabela

        #loop p mostrar todas as linhas, select do mysql
        for($i = 1; $i <= $total; $i++){
            #$x1 recebe nome e idade da linha q o id_usuário é igual a $i
            $nome_idade = $con->query("SELECT nome, idade FROM usuario WHERE id_usuario = $i");
            
            #recebe os elementos específicos da tabela de determinada linha, como se fosse um array
            $nome_idade = $nome_idade->fetch_assoc();

            $nome = $nome_idade['nome']; #'nome' é um índice do array $nome_idade
            $idade = $nome_idade['idade'];
            echo "<br><p>Nome = $nome <br>Idade = $idade <br></p>"; 
        }
        exit();
    }

?>
