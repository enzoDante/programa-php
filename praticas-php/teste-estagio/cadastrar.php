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
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <header>
        <h1>Cadastrar venda</h1>
    </header>
    <nav>
        <a href="index.html">Início</a>
        <a href="cadastrar_venda.html">Finalizar compra</a>
        <a href="busca.html">Buscar produtos</a>
        <a href="historico.html">Histórico de compras</a>
    </nav>
    <main>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("Y-m-d");
            $preco = $_POST['preco'];
            $cep = strip_tags(str_replace(";", "-", $_POST['cep']));
            $uf = strip_tags(str_replace(";", "-", $_POST['uf']));
            $cidade = strip_tags(str_replace(";", "-", $_POST['cidade']));
            $bairro = strip_tags(str_replace(";", "-", $_POST['bairro']));
            $rua = strip_tags(str_replace(";", "-", $_POST['rua']));
            $numero = strip_tags(str_replace(";", "-", $_POST['numero']));
            
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
                    $stmt = $conn->prepare("SELECT * FROM carrinho");
                    $stmt->execute();
                    $produto = ['', '', '', '', ''];
                    $i = 0;
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){  
                        
                        $stmt2 = $conn->prepare("SELECT nome_p FROM produtos WHERE id_produto=?");
                        $stmt2->bind_param("s", $linha->id_produto);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();
                        while($linha2 = $resultado2->fetch_object()){
                            $produto[$i] = $linha2->nome_p;
                        }                        
                        #$produto[$i] = $linha->id_produto;
                        $i++;
                    }

                    $stmt = $conn->prepare("INSERT INTO vendas (preco_total, data_venda, produto1, produto2, produto3, produto4, produto5, cep, uf, cidade, bairro, rua, numero) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("sssssssssssss", $preco,$data,$produto[0],$produto[1],$produto[2],$produto[3],$produto[4],$cep,$uf,$cidade,$bairro,$rua, $numero);
                    $stmt->execute();
                    echo "<h2>Venda cadastrado com sucesso!</h2>";
                    echo "<a href=''>Histórico de compra</a>";
                    $stmt = $conn->prepare("DELETE FROM carrinho");
                    $stmt->execute();
    
                    
                        
                        
                }else{                        
                    echo "<h2>Não existe produto no carrinho!</h2>";
                    echo "<a href='busca.html'>Procurar por produtos</a>";
                }
            }
        
        ?>
    </main>
    
</body>
</html>