<?php 
    //inclui usuario.php, não é necessário incluir o banco.php, pois dentro de usuário.php esse arquivo já está incluido
    include "usuario.php";
    session_start(); //começa a sessão para logar e etc

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php 
            //verifica se o botão submit foi apertado
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $usu = new usuario(); //cria um novo objeto usuario, q irá criar objeto do banco.php etc

                //atribui o nome e etc para as variáveis do objeto
                $usu->atribuirnome($nome);
                $usu->atribuiremail($email);
                $usu->atribuirsenha($senha);
                echo $usu->atribuirnome($nome);

                $x = $usu->cadastrar(); //irá cadastrar o usuário e loga-lo
                //x irá receber o valor que está no return
                echo $x;
            }
        
        ?>
        <?php 
            //sistema de logout usando um link <a href="cadastro.php?a=logout">sair</a>
            //verifica se existe a variável
            if(isset($_GET['a'])){
                //verifica se o valor da variável é "logout"
                if($_GET['a'] == 'logout'){
                    //destroi a sessão = sair da conta
                    session_destroy();
                    //leva o usuário para a página cadastro.php
                    header("Location: cadastro.php");
                    //finaliza para não repetir e travar o pc
                    exit();
                }
            }
        ?>



        <!--verifica se não existe a variável session['id_usuario']-->
        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form action="cadastro.php" id="formu" method="post">
                <input type="text" name="nome" placeholder="nome" id="nome"><br>
                <input type="text" name="email" placeholder="email" id="email"><br>
                <input type="password" name="senha" placeholder="senha" id="senha"><br>
                <input type="password" name="" placeholder="confirmar senha" id="confsenha"><br>
                <!--impede() é para verificar o formulário com javascript-->
                <button type="submit" onclick="impede()">cadastrar</button>
            </form><br><br><br>

            <a href="index.php">index</a><br>
            <a href="login.php">logar</a><br>
        <?php else: ?>
            <p>logado = <?php echo $_SESSION['nome']; ?></p>
            <a href="index.php">index</a><br>
            <a href="conta.php">Configurações de conta</a><br>
            <a href="cadastro.php?a=logout">Deslogar sair da conta</a>

        <?php endif; ?>
        <script src="codigo.js"></script>
    </main>
    
</body>
</html>