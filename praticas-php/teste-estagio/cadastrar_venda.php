<?php
    include "banco.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de venda</title>
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <header>
        <h1>Cadastrar venda</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="busca.html">Buscar vendas</a>
    </nav>
    <main>        
        <form action="cadastrar.php" id="formulario" method="post" autocomplete="off">
            <fieldset>
                <div>
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value);" required>
                    <label for="iuf">UF</label>
                    <input type="text" name="uf" id="iuf" required>
                    <label for="icidade">Cidade:</label>
                    <input type="text" name="cidade" id="icidade" required>
                </div>
                
                <div>                                       
                    <label for="ibairro">Bairro:</label>
                    <input type="text" name="bairro" id="ibairro" required>
                    <label for="irua">Rua:</label>
                    <input type="text" name="rua" id="irua" required>
                </div>
            </fieldset>
            <button type="submit" id="finalizarcompra">Finalizar compra</button>
            <!--carrinho-->
            <?php 
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
                            <a href='' class='elementos_buscas'>
                            <p><strong>{$linha2->nome_p}</strong></p>                            
                            <form id='form' class='elementos_buscas' action='remover.php' method='get'>
                            
                            <p>R$ $linha2->preco_p</p>
                            <p>Código do produto:</p><p>{$linha2->id_produto}</p>
                            <p style='text-align: right;'>Fornecedores: $linha2->fornecedor</p>
                            <input type='hidden' value='$linha2->id_produto' name='id'>
                            <button type='submit'>Remover</button>
                            </form></a>
                        ";
                        echo $div;
                    }
                }
                echo "<h3>Valor total: R$ $valor</h3>";
            ?>
        </form>
    </main>
    <script src="scripts/cep.js"></script>
</body>
</html>