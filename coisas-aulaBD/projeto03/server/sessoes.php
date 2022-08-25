<?php
    session_start();
    $msg = '';
    if(isset($_SESSION['nome'])){
        $msg = "{$_SESSION['nome']} {$_SESSION['email']} {$_SESSION['cpf']} {$_SESSION['idade']} {$_SESSION['salario']} {$_SESSION['serasa']}";
    }
    echo "$msg";
?>