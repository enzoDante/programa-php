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
                    header("Location: blog.php"); #envia o usuário p página 'cadastro.php' eu uso como se fosse o f5
                    exit(); #finaliza o programa, ent nn vai ficar repetindo toda hora e travando o pc
                }
            }
        ?>

        <a href="index.php">Home</a>
        <!--verifica se o usuário nn esta logado, se ele nn estiver isso aparece abaixo-->
        <?php if(!isset($_SESSION['id_usuario'])): #se nn existe a sessão com id ent isso aparece ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
            <!--se existe ent aparece isso abaixo, e com o comando abaixo posso pegar o valor de uma coluna de acordo com o id do usuário-->
            <a href="confinome.php"><?php echo $_SESSION['nome']; ?></a>
            <a href="blog.php?a=logout">Sair</a>
        <?php endif; ?>
    </nav>
    <main>
        <div>
            <?php if(isset($_SESSION['id_usuario'])): ?>
                <a id="pub" href="criar.php">Publicar</a>
            <?php endif; ?>
        </div><hr>
        <article>
            <?php 

                #verifica se ao enviar o form, verifica se é post ou get
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    #no arquivo criar.php foi explicado a lógica do deletar um post, mas irei explicar aq tbm e principalmente por causa de uns comandos diferentes

                    #resultado terá todos os ids de cada post
                    $resultado = $ligacao->query("SELECT id_post FROM postes");
                    $deletar = $_POST['del']; #ao apertar o botão 'deletar' irá enviar um valor q é o id do post q será deletado
                    #ent com o id do post q será deletado, eu posso deletar sem problema algum
                    /* mas terá um problema q foi falado no criar.php, ao deletar um post, os ids precisam ser reorganizado ent neste arquivo eles serão reorganizados
                     */
                    $sql = "delete QUICK from postes where postes.id_post=$deletar";
                    mysqli_query($ligacao,$sql);


                    #irá receber um valor da tabela, q a cada post deletado, o cont receberá + 1
                    $dele = $ligacao->query("SELECT cont FROM contadordel");
                    $mostrarcont = $dele->fetch_assoc(); #irá receber o valor numérico do cont
                    #echo $mostrarcont['cont'];
                    $val = $mostrarcont['cont'] + 1; #como um post foi deletado ent cont deve receber + 1
                    $sql = "update contadordel set cont=$val";#atualizando a tabela p cont receber o novo valor
                    mysqli_query($ligacao, $sql);

                    #este comando verifica se existe algum post p atualizar seus ids depois q um post foi deletado
                    if($resultado->num_rows != 0){
                        /*'i' recebe o valor do id do post deletado, enquanto i for menor q o total de post, ele irá repetir p organizar tudo */
                        for($i = $deletar; $i <= $resultado->num_rows; $i++){
                            #echo $i;
                            $x = $i + 1; #abaixo irei explicar a lógica disso
                            /*como i é o post q foi deletado, ent o post com id maior devem ser organizados
                            exemplo: 1 2 3 4 5 - 2 foi deletado logo preciso organizar os valores acima dele
                            1 2 3 4 - desta forma está tudo organizado */
                            $sql = "update postes set id_post=$i where id_post=$x";
                            mysqli_query($ligacao,$sql);
                            
                        }

                    }
                    
                    #exit();
                }
                
            ?>
            <!--abaixo são os comandos p mostrar todos os post p os usuários-->
            <?php
                $resultado = $ligacao->query("SELECT id_post FROM postes");
                $dados_post = $resultado->fetch_assoc(); #recebe todos os valores de todos os ids dos posts
                #$_SESSION['id_post'] = $dados_post['id_post'];
                #echo $dados_post['id_post'];
                if($resultado->num_rows > 0){#se existir algum post, ent pode mostrar p os usuários

                    /*p mostrar os post mais recentes primeiro, o 'i' deve ter o valor total de todas as linhas da tabela, ent irá repetir até 'i' ter o valor de 1 */
                    for($i = $resultado->num_rows; $i <= $resultado->num_rows; $i--){
                        #echo $i;
                        #seleciona todas as colunas de uma linha q é a linha com id = 'i'
                        $resultadop = $ligacao->query("SELECT criador, titulo, video, comentarios FROM postes WHERE id_post='$i'");
                        $p = $resultadop->fetch_assoc(); #irá receber todos os valores de cada coluna
                        $criador = $p['criador'];#entregando os valores p cada variável
                        $titulo1 = $p['titulo'];
                        $comentt = $p['comentarios'];
    
                        if($p['video'] == 0){ #se nn tiver vídeo
                            #abaixo é os post q cada usuário poderá ver
                            echo "<article class='posta'><h2>$criador</h2>
                            <form action='blog.php' method='post'><select name='del'><option value='$i'></option></select><button type='submit'>Deletar</button></form> 
                            <h3>$titulo1</h3><textarea id='coment' cols='70' rows='10' disabled>$comentt</textarea></article>";
                        }else{
                            $video1 = $p['video'];
                            echo "<article class='posta'><h2>$criador</h2>
                            <form action='blog.php' method='post'><select name='del'><option value='$i'></option></select><button type='submit'>Deletar</button></form> 
                            <h3>$titulo1</h3>$video1<textarea id='coment' cols='70' rows='10' disabled>$comentt</textarea></article>";
                        }
                        
    
    
                        #quando 'i' ter o valor de 1, o loop é quebrado, se nn for quebrado o loop será infinito
                        if($i <= 1){
                            break;
                        }
                    }
                }
                
                exit(); #impede q os comandos acima se repita sem parar
                
                

            ?>
        </article>

    </main>
    
</body>
</html>