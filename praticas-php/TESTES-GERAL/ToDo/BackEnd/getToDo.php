<?php
    include "banco.php";

    // $valores = array();
    $msg = array();
    $objeto = new stdClass();

    $sql = "SELECT * FROM todo";
    if($resultado = $con->query($sql)){
        // $msg = "[";
        while($linha = $resultado->fetch_object()){
            
            // $val = [$linha->texto, $linha->feito];
            $objeto->texto = $linha->texto;
            $objeto->feito = $linha->feito;

            array_push($msg, json_encode($objeto));
            
            // array_push($msg, "{'texto':$linha->texto, 'feito':$linha->feito}");
            // $msg .= "{'texto':$linha->texto, 'feito':$linha->feito}";

            // array_push($valores, $val);
        }
        // $msg .= "]";
        // echo $msg;
        echo json_encode($msg);
    }
    $con->close();
?>