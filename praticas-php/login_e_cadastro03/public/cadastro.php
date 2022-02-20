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
                    header("Location: cadastro.php"); #envia o usuário p página 'cadastro.php' eu uso como se fosse o f5
                    exit(); #finaliza o programa, ent nn vai ficar repetindo toda hora e travando o pc
                }
            }
        ?>


        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>

        <!--verifica se o usuário nn esta logado, se ele nn estiver isso aparece abaixo-->
        <?php if(!isset($_SESSION['id_usuario'])): #se nn existe a sessão com id ent isso aparece ?> 
            <a href="login.php">Login</a>
        <?php else: ?>
            <!--se existe ent aparece isso abaixo, e com o comando abaixo posso pegar o valor de uma coluna de acordo com o id do usuário-->
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>

            <!--se o usuário apertar o link abaixo, é como se atualizase a página e 'a' terá o valor de logout-->
            <a href="cadastro.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php
            #verifica se ao enviar o form, verifica se é post ou get
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['nome']; #pega os valores q eu quero
                $email = $_POST['email'];
                $senha = md5($_POST['senha']); #md5 é um tipo de criptografia

                #resultado terá os valores nome e email da tabela onde irá receber os valores nome e email igual ao q o usuário digitou antes de enviar o form
                $resultado = $ligacao->query("SELECT nome, email FROM usuarios WHERE nome='$nome' AND email='$email'");

                #procura na tabela se existe esse nome e email digitado
                if($resultado->num_rows != 0){
                    echo "<div><p>Conta existente!!!</p></div>";
                }else{
                    #irá criar uma nova linha com valores do usuário
                    $sql = "insert into usuarios (nome, email, senha) values('$nome', '$email','$senha')";
                    mysqli_query($ligacao, $sql);
                    #com um comando na tabela, o id é gerado automaticamente
                    echo "<div><p>Conta criada com sucesso!!!</p></div>";
                    echo "<a href='index.php'>Página inicial</a>";
                    exit();
                }
            }
        ?>

        <?php if(!isset($_SESSION['id_usuario'])): ?>

            <form id="formulario" action="cadastro.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="exemplo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="exemplo123">
                <label for="rsenha">Digite novamente sua senha:</label>
                <input type="password" name="rsenha" id="rsenha" placeholder="exemplo123">
                <input type="checkbox" name="aceita" id="aceita">
                <label for="aceita">Aceita os termos!</label><br>
                <a href="login.php">Ja tenho uma conta</a><br>
                <button type="submit" onclick="valcadastro()">Criar conta</button>
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