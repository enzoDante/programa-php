<?php
    include "banco_de_dados.php";
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = $_POST['nome'];
        $senha = md5($_POST['senha']);

        $resultados = $ligacao->query("SELECT * FROM usuarios WHERE nome = '$usuario' AND senha = '$senha'");

        if($resultados->num_rows == 0){
            echo "login inválido!!!";
        }
        else{
            $dados_usuario = $resultados->fetch_assoc();

            $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
            $_SESSION['nome'] = $dados_usuario['nome'];

            $_SESSION['email'] = $dados_usuario['email'];

            echo '<a href="public/pagina1.php">Entrar</a>';
            exit();

        }


    }
?>