<?php
    session_start();

    //verificar o formulário
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $db_host = 'localhost';
        $db_username = 'root';
        $db_passwrd = '';
        $db_name = 'bd_login_teste';

        @$ligacao = new mysqli($db_host, $db_username, $db_passwrd, $db_name);
        if($ligacao->connect_errno){
            echo 'Aconteceu um erro na ligação para o banco de dados!!!';
        }else{
            //verificar o login!!!
            $usuario = $_POST['text_usuario'];
            $senha = md5($_POST['text_senha']);

            $resultados = $ligacao->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'");

            if($resultados->num_rows == 0){
                echo 'Login inválido';
            }else{
                $dados_usuario = $resultados->fetch_assoc();

                //criar variáveis de sessão
                $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
                $_SESSION['usuario'] = $dados_usuario['usuario'];

                //link para entrar
                echo '<a href="pagina1.php">Entrar</a>';
                exit();
            }
        }

    }

?>

<!--formulário de html-->
<?php if(!isset($_SESSION['id_usuario'])) : ?>

<form action="index.php" method="post">
    <p><input type="text" name="text_usuario" placeholder="Usuário" required></p>
    <p><input type="password" name="text_senha" placeholder="Senha" required></p>
    <button type="submit">Entrar</button>
</form>

<?php else : ?>
    
    <a href="pagina1.php">Entrar</a>

<?php endif; ?>