<?php
    include "banco.php";

    $texto = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
    $marc = false;

    $stmt = $con->prepare("INSERT INTO todo (texto, feito) VALUES(?,?)");
    $stmt->bind_param("ss", $texto, $marc);
    $stmt->execute();

    
    echo $texto;

    // $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // echo $dados;


?>