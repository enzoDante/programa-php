<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    // header("Acces-Control-Allow-Headers: *");
    header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    //header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

    include "banco.php";

    $resJson = file_get_contents("php://input"); //recebe os dados do ajax
    $dado = json_decode($resJson, true); 

    $stmt = $con->prepare("INSERT INTO personagem (nome, armadura, vida, deslocamento, adicionais) VALUES(?,?,?,?,?)");
    $stmt->bind_param("siiis", $dado['nome'], $dado['armadura'], $dado['vida'], $dado['deslocamento'],$dado['adicionais']);
    $stmt->execute();

    http_response_code(200);
    echo json_encode($dado['nome']); //return p o frontend
    // echo $dado; - da erro no frontend

?>