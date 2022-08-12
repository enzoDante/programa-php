<?php
    include "banco.php";
    #atribuindo o valor da url para procurar na tabela produto algo semelhante ao que foi digitado pelo usuario
    $valor = $_GET['id'];
    if($valor != ''){
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE nome_p LIKE '%$valor%' OR id_produto LIKE '%$valor%'");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while($linha = $resultado->fetch_object()){
    
            $a = "
                    <a href='' class='elementos_buscas'>
                    <p><strong>{$linha->nome_p}</strong></p>                            
                    <form id='form' class='elementos_buscas' action='adicionar_busca.php' method='get'>
                    
                    <p>R$ $linha->preco_p</p>
                    <p>Código do produto:</p><p>{$linha->id_produto}</p>
                    <p style='text-align: right;'>Fornecedores: $linha->fornecedor</p>
                    <input type='hidden' value='$linha->id_produto' name='id'>
                    <button type='submit'>Adicionar ao carrinho</button>
                    </form></a>
                
            ";
            echo $a;
        }
    }
?>