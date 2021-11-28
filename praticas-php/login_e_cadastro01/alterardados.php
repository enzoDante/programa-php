<?php
    include "banco_de_dados.php";
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nnome = $_POST['nome'];
        $nemail = $_POST['email'];
        //$nsenha = md5($_POST['senha']);

        $id = $_SESSION['id_usuario'];

        $sql = "update usuarios set nome='$nnome', email='$nemail' where id_usuario=$id";

        mysqli_query($ligacao,$sql);

        $_SESSION['nome'] = $nnome;
        $_SESSION['email'] = $nemail;

        $senhao = md5($_POST['senhao']);

        $resultados = $ligacao->query("SELECT * FROM usuarios WHERE senha = '$senhao'");
        if($resultados->num_rows == 0){
            echo "senha inválida!!!";
        }else{
            $senhan = md5($_POST['senhan']);
            $sql = "update usuarios set senha='$senhan' where id_usuario=$id";
            mysqli_query($ligacao,$sql);
        }


    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>alterar dados do perfil!!!</h1>
    </header>
    <nav>

    </nav>
    <main>
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <h2>Você deve estar logado para alterar dados de seu perfil!!!</h2>
            <a href="view_cadastro_login.php">Voltar para a página inicial</a>

        <?php else: ?>
            <h2>Seu perfil:</h2>
            <a href="pagina1.php">Voltar</a><br>
            <form action="alterardados.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>"><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"><br>
                <label for="senhao">Digite a senha original:</label>
                <input type="password" name="senhao" id="" value="senhaaqui"><br>
                <label for="senhan">Digite a nova senha:</label>
                <input type="password" name="senhan" id="senhan"><br>
                <button type="submit">Atualizar</button>
            </form>

        <?php endif; ?>
    </main>
</body>
</html>