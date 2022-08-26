<?php
    include "banco.php";
    session_start();

    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmt = $con->prepare("SELECT * FROM usuario WHERE cpf=? AND senha=?");
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $msg = '';
    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){        
        if(($linha->cpf == $cpf) && ($linha->senha == $senha)){
            $_SESSION['nome'] = $linha->nome;
            $_SESSION['email'] = $linha->email;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['idade'] = $linha->nascimento;
            $_SESSION['salario'] = $linha->salario;
            $_SESSION['serasa'] = $linha->serasa;
            $msg = 'ex';
        }
    }
    echo "$msg";
?>