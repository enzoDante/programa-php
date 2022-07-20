<?php
    $pasta = 'pasta_arquivos/';
    #$extensao = pathinfo($_FILES['imag1']['name']);
    #$extensao = ".".$extensao['extension'];
    #echo $extensao."<br><br>";

    /*if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
        #gerando o nome da imagem com a extensão e o caminho
        #$imagem = $pasta.date("Y-m-d-H-i-s").$extensao;
        
        if(move_uploaded_file($_FILES['imag1']['tmp_name'], $imagem)){
            echo "arquivo válido e enviado com sucesso<br>";
            echo "nome da imagem com o caminho: ".$imagem."<br>";
        }else{
            echo "arquivo inválido<br>";
        }
    }*/

/**
 * if ($_FILES['Arquivo']['error'] == 4) - caso o input file esteja vazio!
 * 
 */
?>