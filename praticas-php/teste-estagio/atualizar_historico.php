<?php
    include "banco.php";

    $stmt = $conn->prepare("SELECT * FROM vendas ORDER BY id_venda DESC");
    $stmt->execute();
    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){
        $div = "
            <fieldset class='comprash'>
            <div>
                <p>Número da venda: $linha->id_venda</p>
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
            
        $produto1 = '';
        $produto2 = '';
        $produto3 = '';
        $produto4 = '';
        $produto5 = '';
        if($linha->produto1 != ''){
            $produto1 = "<p>Produto: $linha->produto1</p>";
        }
        if($linha->produto2 != ''){
            $produto2 = "<p>Produto: $linha->produto2</p>";
        }
        if($linha->produto3 != ''){
            $produto3 = "<p>Produto: $linha->produto3</p>";
        }
        if($linha->produto4 != ''){
            $produto4 = "<p>Produto: $linha->produto4</p>";
        }
        if($linha->produto5 != ''){
            $produto5 = "<p>Produto: $linha->produto5</p>";
        }
        $div .= "
                    $produto1
                    $produto2
                    $produto3
                </div>
                <div>
                    <hr>
                    $produto4
                    $produto5
                </div>

            </fieldset>        
        ";
        echo $div;
    }

?>