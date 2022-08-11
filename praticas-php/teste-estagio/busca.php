<?php 
    include "banco.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscas</title>
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <header>
        <h1>Buscar vendas</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="cadastrar_venda.html">Cadastrar venda</a>
    </nav>
    <main>
        <div id="divbusca">
            <label for="ibusca">Buscar</label>
            <input type="search" name="buscar" id="ibuscar" onkeyup="procurar()">
        </div><hr><br>
        <!--ajax-->
        <div id="vendas">
            <?php
                $stmt = $conn->prepare("SELECT * FROM produtos");
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
            ?>


        </div>
        
    </main>
    <script src="scripts/buscar.js"></script>
</body>
</html>