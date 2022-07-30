<?php
    include "banco.php";
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modal.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <header></header>
    <nav>

    </nav>
    
    <main>
        <?php
            $sql = "SELECT * FROM usuario;";
            #executa o sql no query, e armazena os valores em resultado
            if($resultado = $conn->query($sql)){
                #passa por todos os registros do resultado 
                while($linha = $resultado->fetch_object()){
                    if($_SESSION['id_unico'] != $linha->id_unico){
                        $id_unico = $linha->id_unico;
                        echo "<a href='chat.php?id=$id_unico'>{$linha->nome}</a><br><br>";

                    }
                }
            }

        ?>
    </main>

</body>
</html>