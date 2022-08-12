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
            #define horario padrão do servidor
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("Y-m-d");
            #atribuindo os valores de endereco nas variaveis
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
                #verificando se existe algum produto no carrinho
                $stmt = $conn->prepare("SELECT * FROM carrinho");
                $verificar = '';
                $stmt->execute();
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = '2';
                }
                #se o carrinho não estiver vazio, é possível finalizar a compra
                if($verificar != ''){
                    #atribuindo os valores da tabela produto para inserir na tabela vendas
                    $stmt = $conn->prepare("SELECT * FROM carrinho");
                    $stmt->execute();
                    $produtos = '';
                    $precos = '';
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){  

                        $stmt2 = $conn->prepare("SELECT nome_p, preco_p FROM produtos WHERE id_produto=?");
                        $stmt2->bind_param("s", $linha->id_produto);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();
                        while($linha2 = $resultado2->fetch_object()){
                            $produtos .= str_replace(" ","_",$linha2->nome_p)." ";
                            $precos .= "$linha2->preco_p ";
                        }
                    }

                    $stmt = $conn->prepare("INSERT INTO vendas (preco_total, data_venda, produtos, precos, cep, uf, cidade, bairro, rua, numero) VALUES(?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssssss", $preco,$data,$produtos,$precos,$cep,$uf,$cidade,$bairro,$rua, $numero);
                    $stmt->execute();
                    echo "<h2>Venda cadastrado com sucesso!</h2>";
                    echo "<a href='historico.html'>Histórico de compra</a>";
                    #ao efetuar a compra, o carrinho será limpo
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