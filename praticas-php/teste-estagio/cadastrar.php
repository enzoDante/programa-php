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
        <a href="cadastrar_venda.html">Cadastrar venda</a>
        <a href="busca.html">Buscar vendas</a>
    </nav>
    <main>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("Y-m-d");
            $cep = strip_tags(str_replace(";", "-", $_POST['cep']));
            $uf = strip_tags(str_replace(";", "-", $_POST['uf']));
            $cidade = strip_tags(str_replace(";", "-", $_POST['cidade']));
            $bairro = strip_tags(str_replace(";", "-", $_POST['bairro']));
            $rua = strip_tags(str_replace(";", "-", $_POST['rua']));
            
            if(($cep == "") || ($cidade == "")){
                echo "<h2>Complete os campos corretamente!!!<h2>";
                echo "<a href='cadastrar_venda.html'>Voltar</a>";
            }else{
                $stmt = $conn->prepare("SELECT * FROM carrinho");
                $verificar = '';
                $stmt->execute();
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = '2';
                }
                if($verificar != ''){
                    /*$stmt = $conn->prepare("INSERT INTO vendas (nome_produto, fornecedores, preco, data_venda, cep, referencia, uf, cidade, bairro, rua) VALUES(?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssssss", $nome,$fornecedor,$preco,$data,$cep,$referencia,$uf,$cidade,$bairro,$rua);
                    $stmt->execute();*/
                    echo "<h2>Venda cadastrado com sucesso!</h2>";
                    echo "";
    
                    
                        
                        
                }else{                        
                    echo "<h2>Não existe produto no carrinho!</h2>";
                    echo "<a href='busca.php'>Procurar por produtos</a>";
                }
            }
        
        ?>
    </main>
    
</body>
</html>