<?php
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_SPECIAL_CHARS);

    $salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_SPECIAL_CHARS);
    $serasa = filter_input(INPUT_POST, 'serasa', FILTER_SANITIZE_SPECIAL_CHARS);

    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    #inserir no banco o cadastro
    // echo "$nome<br>$email<br>$cpf<br>$idade<br>$salario<br>$serasa<br>$senha<br>";
    // echo "email";
    echo "cpf";
?>