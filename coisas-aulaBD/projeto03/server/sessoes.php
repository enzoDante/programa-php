<?php
    session_start();
    $msg = '';
    @$sair = filter_input(INPUT_POST, 'sair', FILTER_SANITIZE_SPECIAL_CHARS);
    if($sair == 's'){
        session_destroy();
    }
    if(isset($_SESSION['nome'])){
        $nome = str_replace(" ","-", $_SESSION['nome']);
        $msg = "{$nome} {$_SESSION['email']} {$_SESSION['cpf']} {$_SESSION['idade']} {$_SESSION['salario']} {$_SESSION['serasa']}";
    }
    echo "$msg";
?>