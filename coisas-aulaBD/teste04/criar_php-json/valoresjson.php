<?php
    include "banco.php";
    $stmt = $con->prepare("SELECT * FROM usuario");
    $stmt->execute();
    $resultado = $stmt->get_result();

    $valores = array();
    while($linha = $resultado->fetch_object()){
        $dado = array(
            "id" => $linha->id_usuario,
            "nome" => $linha->nome,
            "email" => $linha->email,
            "cpf" => $linha->cpf,
            "nascimento" => $linha->nascimento,
            "salario" => $linha->salario,
            "serasa" => $linha->serasa
        );
        // array_push($dado, $linha->id_usuario, $linha->nome);
        // array_push($dado, $linha->email, $linha->cpf);
        // array_push($dado, $linha->nascimento, $linha->salario, $linha->serasa);

        // array_change_key_case($dados[0], "id");
        // array_change_key_case($dados[1], "nome");
        // array_change_key_case($dados[2], "email");
        // array_change_key_case($dados[3], "cpf");
        // array_change_key_case($dados[4], "nascimento");
        // array_change_key_case($dados[5], "salario");
        // array_change_key_case($dados[6], "serasa");

        array_push($valores, $dado);
    }
    echo json_encode($valores);

?>