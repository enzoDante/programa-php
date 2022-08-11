<?php
    include "banco.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <header>
        <h1>Adicionar no carrinho</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="cadastrar_venda.html">Finalizar compra</a>
        <a href="busca.html">Buscar produtos</a>
        <a href="">Histórico de compras</a>
    </nav>
    <main>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            //$codigo = substr(md5(date("YmdHis")), 1, 7);
            $id = $_GET['id'];

            //verifica o limite de 5 produtos no carrinho!!!
            $stmt = $conn->prepare("SELECT * FROM carrinho");
            $stmt->execute();
            $totalcarrinho = 0;
            $resultado = $stmt->get_result();
            while($linha = $resultado->fetch_object()){
                $totalcarrinho += 1;
            }

            if($totalcarrinho < 5){
                $stmt = $conn->prepare("SELECT * FROM carrinho WHERE id_produto=?");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $verificar = '';
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->id_produto;
                }
                if($verificar == ''){
                    $stmt2 = $conn->prepare("INSERT INTO carrinho (id_produto) VALUES(?)");
                    $stmt2->bind_param("s", $id);
                    $stmt2->execute();
                    echo "<h2>Produto adicionado no carrinho com sucesso</h2>";
                    echo "<a href='busca.html'>Voltar</a><br>";
                    echo "<a href='cadastrar_venda.html'>Acessar carrinho</a>";
                }else{
                    echo "<h2>Produto ja está no carrinho!!</h2>";
                    echo "<a href='busca.html'>Voltar</a><br>";
                    echo "<a href='cadastrar_venda.html'>Acessar carrinho</a>";
                }
            }else{
                echo "<h2>O carrinho chegou no limite de 5 produtos!!</h2>";
                echo "<a href='busca.html'>Voltar</a><br>";
                echo "<a href='cadastrar_venda.html'>Acessar carrinho</a>";
            }
            
        
        ?>        
    </main>
    
</body>
</html>