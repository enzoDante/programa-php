<?php
    include "banco.php";

    #selecionando em ordem decrescente as linhas da tabela venda
    $stmt = $conn->prepare("SELECT * FROM vendas ORDER BY id_venda DESC");
    $stmt->execute();
    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){
        #criando elementos html com os valores retornados da tabela
        $div = "
            <fieldset class='comprash'>
            <div>
                <p>Número do pedido: $linha->id_venda</p>
                <p>Data da compra: <strong>$linha->data_venda</strong></p>
                <h4>R$ $linha->preco_total</h4><h4>UF: $linha->uf</h4>
                <p>CEP: $linha->cep</p>                
            </div>
            <div>
                <p>Cidade: $linha->cidade</p>
                <p>Bairro: $linha->bairro</p>
                <p>Rua: $linha->rua</p>
                <p>Número: $linha->numero</p>
            </div>
            <div>
            <hr>";
        #separando os produtos e precos em array
        $produtos = explode(" ", $linha->produtos);
        $precos = explode(" ", $linha->precos);
        #percorrendo o array e adicionando elementos html com os valores do array
        for($i = 0; $i < count($produtos); $i++){
            if($i < 3){
                if($produtos[$i] != '')
                    $div .= "<p>Produto: ".str_replace('_',' ',$produtos[$i])." <strong>R$ {$precos[$i]}</strong></p>";                
            }else{
                if($i == 3)
                    $div .= "</div><div><hr>";
                if($produtos[$i] != '')
                    $div .= "<p>Produto: ".str_replace('_',' ',$produtos[$i])." <strong>R$ {$precos[$i]}</strong></p>";
            }
        }
        $div .= "</div></fieldset>";        
        echo $div;
    }

?>