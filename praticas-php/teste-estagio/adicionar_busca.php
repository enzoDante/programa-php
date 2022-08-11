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
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <header>
        <h1>Adicionar no carrinho</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="cadastrar_venda.html">Cadastrar venda</a>
        <a href="busca.php">Buscar produtos</a>
    </nav>
    <main>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            $codigo = substr(md5(date("YmdHis")), 1, 7);
            $id = $_GET['id'];

            $stmt = $conn->prepare("SELECT * FROM carrinho WHERE id_produto=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $verificar = 0;
            while($linha = $resultado->fetch_object()){
                $verificar = $linha->id_produto;
            }
            if($verificar == 0){
                $stmt2 = $conn->prepare("INSERT INTO carrinho (id_produto) VALUES(?)");
                $stmt2->bind_param("s", $id);
                $stmt2->execute();
                echo "<h2>Produto adicionado no carrinho com sucesso</h2>";
            }else{
                echo "<h2>Produto ja está no carrinho!!</h2>";
            }
            
        
        ?>
    </main>
    
</body>
</html>