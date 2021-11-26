<?php

    session_start();

    //verifica se existe sessão
    if(!isset($_SESSION['id_usuario'])){
        echo 'Não tem acesso a esta página. <a href="index.php">Voltar</a>';
        exit();
    }
    //verifica se foi escolhido logout
    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            echo 'Sessão terminada. <a href="index.php">Voltar</a>';
            exit();
        }
    }

?>

<h3>Seja bem-vindo!</h3>

<!--Logout-->
<a href="pagina1.php?a=logout">Logout</a>