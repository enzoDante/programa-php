<?php
    include "banco.php";
    session_start();

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

    $salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_SPECIAL_CHARS);
    $serasa = filter_input(INPUT_POST, 'serasa', FILTER_SANITIZE_SPECIAL_CHARS);

    $msg = '';

    if($email != $_SESSION['email']){
        $stmt = $con->prepare("SELECT * FROM usuario WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while($linha = $resultado->fetch_object()){
            if($linha->email == $email){
                $msg = 'email';
            }
        }
    }
    if($msg == ''){
        $stmt = $con->prepare("UPDATE usuario set nome=?,email=?,salario=?,serasa=? WHERE id_usuario=?");
        $stmt->bind_param("ssssi", $nome, $email, $salario, $serasa, $_SESSION['id_usuario']);
        $stmt->execute();
        $_SESSION['nome'] = str_replace(" ", "-", $nome);
        $_SESSION['email'] = $email;
        $_SESSION['salario'] = $salario;
        $_SESSION['serasa'] = $serasa;
    }

    echo "$msg";
?>