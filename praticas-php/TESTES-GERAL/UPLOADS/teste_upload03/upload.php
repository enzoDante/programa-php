<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <main>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            $pasta = 'imagens/';
            if ($_FILES['arquivo1']['error'] == 4){

                echo "<p>O primeiro input não teve um arquivo selecionado</p>";
            }else{
                $extensao = pathinfo($_FILES['arquivo1']['name']);
                $extensao = ".".$extensao['extension'];
                if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                    
                    $imagem = $pasta.date("Y-m-d-H-i-s")."_arquivo1".$extensao;
                    if(move_uploaded_file($_FILES['arquivo1']['tmp_name'], $imagem)){
                        echo "<p>primeiro arquivo válido e enviado com sucesso</p>";
                        echo "</p>nome da imagem com o caminho: ".$imagem."</p>";
                        echo "<img src='$imagem' alt='' >";
                    }else{
                        echo "<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>";
                    }

                }
                
            }
            if ($_FILES['arquivo2']['error'] == 4){
                echo "<p>O segundo input não teve um arquivo selecionado</p>";
            }else{
                $extensao = pathinfo($_FILES['arquivo2']['name']);
                $extensao = ".".$extensao['extension'];

                if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                    $imagem = $pasta.date("Y-m-d-H-i-s")."_arquivo2".$extensao;
                    if(move_uploaded_file($_FILES['arquivo2']['tmp_name'], $imagem)){
                        echo "<p>segundo arquivo válido e enviado com sucesso</p>";
                        echo "</p>nome da imagem com o caminho: ".$imagem."</p>";
                        echo "<img src='$imagem' alt='' >";
                    }else{
                        echo "<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>";
                    }
                }
            }

        ?>
        <a href="index.html">Voltar</a>
    </main>
</body>
</html>