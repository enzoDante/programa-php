<?php
    include "banco.php";
    session_start();
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_SPECIAL_CHARS);

    $salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_SPECIAL_CHARS);
    $serasa = filter_input(INPUT_POST, 'serasa', FILTER_SANITIZE_SPECIAL_CHARS);

    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    $msg = '';

    $stmt = $con->prepare("SELECT email, cpf FROM usuario WHERE email=? OR cpf=?");
    $stmt->bind_param("ss", $email, $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){
        if($linha->email == $email){
            $msg = 'email';
            break;
        }
        if($linha->cpf == $cpf){
            $msg = 'cpf';
            break;
        }
    }
    if($msg == ''){
        $stmt = $con->prepare("INSERT INTO usuario (nome,email,cpf,nascimento,salario,serasa,senha) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $nome, $email, $cpf, $idade, $salario, $serasa, $senha);
        $stmt->execute();
        $_SESSION['nome'] = str_replace(" ", "-", $nome);
        $_SESSION['email'] = $email;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['idade'] = $idade;
        $_SESSION['salario'] = $salario;
        $_SESSION['serasa'] = $serasa;
    }
    #inserir no banco o cadastro
    // echo "$nome<br>$email<br>$cpf<br>$idade<br>$salario<br>$serasa<br>$senha<br>";
    echo $msg;
?>