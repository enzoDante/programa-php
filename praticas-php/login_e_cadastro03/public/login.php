<?php 
    include "../banco.php";
    session_start(); #caso saia da aba, ao voltar estará logado!
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formu.css">
</head>
<body>
    <header>
        <h1>Titulo</h1>
    </header>
    <nav>
        <?php
            if(isset($_GET['a'])){ #verifica se existe essa variável, se foi prescionada no caso é o 'a'
                if($_GET['a'] == 'logout'){ #ent ele verifica se o valor é 'logout'
                    session_destroy(); #finaliza sessão, agr o usuario n esta logado
                    header("Location: login.php"); #envia o usuário p página 'cadastro.php' eu uso como se fosse o f5
                    exit(); #finaliza o programa, ent nn vai ficar repetindo toda hora e travando o pc
                }
            }
        ?>

        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <!--verifica se o usuário nn esta logado, se ele nn estiver isso aparece abaixo-->
        <?php if(!isset($_SESSION['id_usuario'])): #se nn existe a sessão com id ent isso aparece ?>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <!--se existe ent aparece isso abaixo, e com o comando abaixo posso pegar o valor de uma coluna de acordo com o id do usuário-->
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="login.php?a=logout">Sair</a>
        <?php endif;?>
    </nav>
    <main>
        <?php 
            #verifica se ao enviar o form, verifica se é post ou get
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nomee = $_POST['nome-email'];
                $senha = md5($_POST['senha']);

                #resultado terá todos os valores da tabela da linha em q tenha os dados q o usuário digitou 
                $resultado = $ligacao->query("SELECT * FROM usuarios WHERE senha='$senha' AND nome='$nomee' OR email='$nomee' AND senha='$senha'");

                #verifica se existe esses valores na tabela
                if($resultado->num_rows == 0){
                    echo "<p>Login inválido</p>";
                }else{
                    #o comando fetch_assoc() irá enviar todos os valores da linha do select
                    $dados_usu = $resultado->fetch_assoc();

                    #a sessão receberá alguns valores
                    $_SESSION['id_usuario'] = $dados_usu['id_usuario'];
                    $_SESSION['nome'] = $dados_usu['nome'];
                    $_SESSION['email'] = $dados_usu['email'];
                    header("Location: login.php"); #o usuário será direcionado para uma página, no caso é como se fosse um f5, para mostrar q ele foi logado!
                    exit();
                }
            }
        ?>



        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <form id="formulario" action="login.php" method="post">
                <label for="nome-email">Nome de usuário ou E-mail:</label>
                <input type="text" name="nome-email" id="nomee" placeholder="Usuário...">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Senha...">
                <button type="submit" onclick="vallogin()">Entrar</button>

            </form>
            <script src="script.js"></script>
        <?php else: ?>

                <div>
                    <h2>Você já esta logado!</h2>
                    <p>Ir para página principal <a href="index.php">clicando aqui!</a></p>
                </div>
        <?php endif; ?>
    </main>
    
</body>
</html>