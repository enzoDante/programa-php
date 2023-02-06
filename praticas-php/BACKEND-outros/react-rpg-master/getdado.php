<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    // header("Acces-Control-Allow-Headers: *");
    header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    //header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

    include "banco.php";

    $msg = array();
    $objeto = new stdClass();

    $sql = "SELECT * FROM personagem";
    if($result = $con->query($sql)){
        while($linha = $result->fetch_object()){
            $objeto->id = $linha->id;
            $objeto->nome = $linha->nome;
            $objeto->armadura = $linha->armadura;
            $objeto->vida = $linha->vida;
            $objeto->deslocamento = $linha->deslocamento;
            $objeto->adicionais = $linha->adicionais;

            array_push($msg, json_encode($objeto));
        }
    }
    // $resJson = file_get_contents("php://input"); //recebe os dados do ajax
    // $dado = json_decode($resJson, true); 
    

    http_response_code(200);
    echo json_encode($msg); //return p o frontend

?>