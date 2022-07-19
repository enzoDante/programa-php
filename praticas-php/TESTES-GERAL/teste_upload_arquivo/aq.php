<?php
    date_default_timezone_set('America/Sao_Paulo');
    #caminho da pasta das imagens
    $pasta = 'pasta_arquivos/';
    #$arquivou = $pasta . basename($_FILES['arquivo']['name']);
    #echo $arquivou . "<br><br>";
    #echo $_FILES['arquivo']['name'];

    #pega a extensão da imagem
    $extensao = pathinfo($_FILES['arquivo']['name']);
    $extensao = ".".$extensao['extension'];
    echo $extensao."<br><br>";

    #aceitando somente imagens
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
        #gerando o nome da imagem com a extensão e o caminho
        $imagem = $pasta.date("Y-m-d-H-i-s").$extensao;

        /*fazendo upload do arquivo e o novo nome dele
            apesar de ter o caminho no nome da imagem, por algum motivo esse caminho não aparece no nome da imagem ao fazer o upload abaixo, ficará salvo o nome alterado mas sem o caminho!*/
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $imagem)){
            echo "arquivo válido e enviado com sucesso<br>";
            echo "nome da imagem com o caminho: ".$imagem."<br>";
        }else{
            echo "arquivo inválido<br>";
        }
    }    

    echo "mais informações nn sei tbm<br><br>";
    print_r($_FILES);
?>