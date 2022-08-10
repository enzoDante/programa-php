<?php
    include "banco.php";
    session_start();


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
        <a href="cadastrar_venda.html">Cadastrar venda</a>
        <a href="#">Buscar vendas</a>
    </nav>
    <main>
        <?php 
            $nome = strip_tags(str_replace(";", "-", $_POST['nomep']));
            $fornecedor = strip_tags(str_replace(";", "-", $_POST['fornecedor']));
            $preco = strip_tags(str_replace(";", "-", $_POST['preco']));
            $data = strip_tags(str_replace(";", "-", $_POST['data']));
            $cep = strip_tags(str_replace(";", "-", $_POST['cep']));
            $uf = strip_tags(str_replace(";", "-", $_POST['uf']));
            $referencia = strip_tags(str_replace(";", "-", $_POST['referencia']));
            $cidade = strip_tags(str_replace(";", "-", $_POST['cidade']));
            $bairro = strip_tags(str_replace(";", "-", $_POST['bairro']));
            $rua = strip_tags(str_replace(";", "-", $_POST['rua']));
            
            if(($nome == "") || ($cep == "") || ($cidade == "") || (empty($data)) || ($preco == "")){
                echo "<h2>Complete os campos corretamente!!!<h2>";
                echo "<a href='cadastrar_venda.html'>Voltar</a>";
            }else{
                $stmt = $conn->prepare("INSERT INTO vendas (nome_produto, fornecedores, preco, data_venda, cep, referencia, uf, cidade, bairro, rua) VALUES(?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("ssssssssss", $nome,$fornecedor,$preco,$data,$cep,$referencia,$uf,$cidade,$bairro,$rua);
                $stmt->execute();
                echo "<h2>Venda cadastrado com sucesso!</h2>";
            }
        
        ?>
    </main>
    
</body>
</html>