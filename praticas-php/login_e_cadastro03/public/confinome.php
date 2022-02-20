<?php 
    include "../banco.php";
    session_start(); #caso saia da aba, ao voltar estará logado!

    #verifica se ao enviar o form, verifica se é post ou get
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $id = $_SESSION['id_usuario']; #sempre irá fazer uma atualização na linha do id ao prescionar o botão 'salvar'
        $sql = "update usuarios set nome='$nome', email='$email' where id_usuario='$id'";
        mysqli_query($ligacao, $sql);

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        #---------------------------------método da senha abaixo---------
        #com a senha é um pouco diferente para ter uma segurança
        $senha = $_POST['senha'];
        $senhaoriginal = md5($_POST['senhaoriginal']);

        if($senha != null){ #se o usuário preencheu o campo da nova senha:
            $senha = md5($_POST['senha']);
            #irá procurar na tabela se existe essa senha original
            $resultado = $ligacao->query("SELECT * FROM usuarios WHERE senha='$senhaoriginal'");
            if($resultado->num_rows == 0){
                echo "<script>alert('Senha inválida')</script>";
            }else{
                #se tudo estiver certo, irá atualizar na tabela a nova senha
                $sql = "update usuarios set senha='$senha' where id_usuario='$id'";
                mysqli_query($ligacao, $sql);
            }

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
                    header("Location: confinome.php"); #envia o usuário p página 'cadastro.php' eu uso como se fosse o f5
                    exit(); #finaliza o programa, ent nn vai ficar repetindo toda hora e travando o pc
                }
            }
        ?>


        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <!--verifica se o usuário nn esta logado, se ele nn estiver isso aparece abaixo-->
        <?php if(!isset($_SESSION['id_usuario'])): #se nn existe a sessão com id ent isso aparece ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <!--se existe ent aparece isso abaixo, e com o comando abaixo posso pegar o valor de uma coluna de acordo com o id do usuário-->
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="confinome.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>


        <?php if(isset($_SESSION['id_usuario'])): ?>
            <form id="formulario" action="confinome.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
                <label for="senhaoriginal">Digite a senha atual:</label>
                <input type="password" name="senhaoriginal" id="senoriginal" placeholder="sua senha atual">
                <label for="senha">Senha nova:</label>
                <input type="password" name="senha" id="sennova" placeholder="digite a nova senha">
                <label for="rsenha">Digite novamente a senha:</label>
                <input type="password" name="rsenha" id="sennova2" placeholder="repita a senha novamente">
                <button type="submit" onclick="valperfil()">Salvar</button>
            </form>
            <script src="script.js"></script>
        <?php else: ?>

            <div>
                <h2>Você precisa estar logado para acessar esta página!</h2>
                <p>Ir para página principal <a href="index.php">clicando aqui!</a></p>
                <p>Criar uma conta <a href="cadastro.php">clicando aqui!</a></p>
            </div>
        <?php endif; ?>
    </main>
    
</body>
</html>