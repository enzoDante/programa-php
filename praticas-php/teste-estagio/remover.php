<?php
    include "banco.php";
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <header>
        <h1>Remover</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="busca.php">Buscar vendas</a>
        <a href="">Histórico de compras</a>
    </nav>
    <main>
        <?php
        #com o id do carrinho, ao clicar em remover, o produto será removido do carrinho 
            $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_carrinho=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            header("Location: cadastrar_venda.html");
        
        ?>
    </main>
    
</body>
</html>