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
    <link rel="stylesheet" href="formu2.css">
    <link rel="stylesheet" href="botao.css">
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
                    header("Location: index.php"); #envia o usuário p página 'cadastro.php' eu uso como se fosse o f5
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
        <a href="criar.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>

        <?php
            #verifica se ao enviar o form, verifica se é post ou get
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                $nome = $_SESSION['nome'];
                $titulo = $_POST['titulo'];
                $video = $_POST['video'];
                $coment = $_POST['comentarios'];
                $verificar = $ligacao->query("SELECT titulo FROM postes WHERE titulo='$titulo'");
                #dos elementos selecionados verifica se existe
                #num_rows verifica linha por linha e procura oq foi selecionado, no caso 'titulo' e compara com o valor digitado pelo usuário
                if($verificar->num_rows != 0){ 
                    echo "<script>alert('Esse título já existe!!!')</script>";
                }else{                

                    if($video == null){ #se nn tem nada no campo do vídeo
                        #irá adicionar uma nova lniha na tabela com os valores abaixo
                        $sql = "insert into postes (criador, titulo, comentarios) values('$nome','$titulo','$coment')";
                        mysqli_query($ligacao, $sql);

                        #irá receber o id da linha com titulo = ao q usuário digitou
                        $id_do_post = $ligacao->query("SELECT id_post FROM postes WHERE titulo='$titulo'");
                        #irá receber o valor do id
                        $idpostes = $id_do_post->fetch_assoc();

                        #de outra tabela irá receber o valor do cont, para entender melhor essa tabela está sendo usada somente neste arquivo e no arquivo blog.php
                        /*serve p caso o usuário delete um post no blog.php
                        ao deletar, tem um comando q organiza os valores dos id de cadas post
                        exemplo: cada post tem um id q começa no 1
                        1 2 3 4 5 - se eu deletar o post 2 eu preciso organizar os valores maiores q ele
                        fazendo com q fique desta nova forma:
                        1 2 3 4, o 3 virou 2, o 4 virou 3 e o 5 virou 4

                        mas ao criar um novo post, o id é gerado automático ent o novo id será 6 pois antes existia o id 5, para isso eu utilizei uma tabela separada q a cada vez q um post for deletado, esse 'cont' irá receber + 1, ent ao publicar um post o id dos post será subtraido com o 'cont' 
                        dessa forma se tiver 20 post o próximo terá o id = 21 mas se eu deletar algum post ent o próximo post deverá ter o valor = 20
                        */
                        $dele = $ligacao->query("SELECT cont FROM contadordel");
                        $mostrarcont = $dele->fetch_assoc(); #irá receber o valor do cont

                        #com o valor do id de cada post e o valor do cont, será feito uma subtração, o motivo e a lógica foi explicada logo acima :) é praticamente lógica matemática
                        $val = $idpostes['id_post'] - $mostrarcont['cont'];

                        #na linha 65 o post ja foi publicado, então eu só preciso atualizar o id dele para ficar organizado
                        /* o comando num_rows consegue mostrar quantas linhas existe dessa forma
                        eu consigo mostrar p o usuário todos os post mas é preciso q o id de cada post vá de 1 até o valor total identificado pelo comando num_rows
                        */
                        $sql = "update postes set id_post=$val where titulo='$titulo'";
                        mysqli_query($ligacao, $sql);
                        echo "<script>alert('Publicado!')</script>";
                        header("Location: criar.php");
                        exit();

                    }else{
                        #é a mesma coisa acima, a única diferença é q esse tem vídeo do usuário
                        #irá adicionar uma nova lniha na tabela com os valores abaixo
                        /*p facilitar e deixar o site mais leve, eu pensei em usar o iframe dos vídeos, então se o usuário quiser um vídeo, ele só precisa do iframe q é um código usado p colocar vídeos em sites, é praticamente essa a minha ideia
                        eu nn consigo fazer usando o input:file(por enquanto), e ele deixa o site mais pesado */
                        $sql = "insert into postes (criador, titulo, video, comentarios) values('$nome','$titulo','$video','$coment')";
                        mysqli_query($ligacao, $sql);

                        $id_do_post = $ligacao->query("SELECT id_post FROM postes WHERE titulo='$titulo'");
                        $idpostes = $id_do_post->fetch_assoc();
                        $dele = $ligacao->query("SELECT cont FROM contadordel");
                        $mostrarcont = $dele->fetch_assoc();

                        $val = $idpostes['id_post'] - $mostrarcont['cont'];

                        $sql = "update postes set id_post=$val where titulo='$titulo'";
                        mysqli_query($ligacao, $sql);
                        echo "<script>alert('Publicado!')</script>";
                        header("Location: criar.php");
                        exit();
                    }
            }
            }
        ?>





        <?php if(!isset($_SESSION['id_usuario'])): ?>
            <div>
                <p>Você precisa estar logado para acessar esta página!!!</p>
            </div>
        <?php else: ?>
            <form id="postar" action="criar.php" method="post">
                <input type="text" name="titulo" id="titu" placeholder="Digite o titulo">
                <input type="text" name="video" id="ifra" onchange="videom()" placeholder="Insira o incorporar do vídeo" autocomplete="off">
                <div id="video-aq">

                </div>
                <textarea name="comentarios" id="coment" cols="70" rows="10"></textarea>
                <button type="submit" onclick="publicar()">Publicar</button>
            </form>
            <script src="video.js"></script>
        <?php endif; ?>

    </main>
    
</body>
</html>