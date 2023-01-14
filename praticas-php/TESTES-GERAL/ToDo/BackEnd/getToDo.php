<?php
    include "banco.php";

    $valores = array();

    $sql = "SELECT * FROM todo";
    if($resultado = $con->query($sql)){
        while($linha = $resultado->fetch_object()){
            
            array_push($valores, $linha->todo);
        }
    }
    $con->close();
?>