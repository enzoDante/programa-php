<?php 
    include "banco.php";
    $stmt = $conn->prepare("SELECT * FROM carrinho");
    $stmt->execute();
    $resultado = $stmt->get_result();
    $valor = 0;
    while($linha = $resultado->fetch_object()){
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id_produto=?");
        $stmt->bind_param("s", $linha->id_produto);
        $stmt->execute();
        $resultado2 = $stmt->get_result();
        while($linha2 = $resultado2->fetch_object()){
            $valor += $linha2->preco_p;
            $div = "
                <div class='elementos_buscas'>
                <p><strong>{$linha2->nome_p}</strong></p>

                <p>R$ $linha2->preco_p</p>
                <p>Código do produto:</p><p>{$linha2->id_produto}</p>
                <p style='text-align: right;'>Fornecedores: $linha2->fornecedor</p>
                <input type='hidden' value='$linha2->id_produto' name='id'>
                <a href='remover.php?id=$linha->id_carrinho' class='linkbtn'>Remover</a>
                </div>
            ";
            echo $div;
        }
    }
    echo "<h3>Valor total: R$ $valor</h3>";
    echo "<input type='hidden' name='preco' value='$valor'>";
?>