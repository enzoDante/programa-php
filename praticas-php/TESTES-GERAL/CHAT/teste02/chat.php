<?php
    include "banco.php";
    $sql = "SELECT * FROM testechat;";
    #executa o sql no query, e armazena os valores em resultado
    if($resultado = $conn->query($sql)){
        #passa por todos os registros do resultado 
        while($linha = $resultado->fetch_object()){
            echo "<h3>{$linha->nome}</h3>";
            echo "<p>{$linha->msg}</p>";
        }
    }
?>