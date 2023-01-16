<?php
    include "banco.php";

    $texto = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
    $marc = false;

    $stmt = $con->prepare("INSERT INTO todo (texto, feito) VALUES(?,?)");
    $stmt->bind_param("ss", $texto, $marc);
    $stmt->execute();

    $msg = "";
    $sql = "SELECT MAX(id) as id FROM todo";
    if($result = $con->query($sql)){
        while($linha = $result->fetch_object()){
            $msg = $linha->id;
        }
    }
    $array = [$msg, $texto];
    // echo $texto;
    echo json_encode($array);
    $con->close();

    // $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // echo $dados;


?>