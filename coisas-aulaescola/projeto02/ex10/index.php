<?php
    include "classe.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Arquivos</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <input type="text" name="nome" id="" placeholder="Digite seu nome:"><br>
            <input type="email" name="email" id="" placeholder="Digite seu e-mail:"><br>
            <input type="tel" name="telefone" id="" placeholder="Digite seu telefone:"><br>
            <input type="text" name="empresa" id="" placeholder="Digite o nome da empresa:"><br>
            <input type="text" name="assunto" id="" placeholder="assunto:"><br>
            <textarea name="msg" id="" cols="30" rows="10" placeholder="Mensagem:"></textarea><br>
            <button type="submit">Criar arquivo</button>
        </form>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calc = new arq();
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $tel = $_POST['telefone'];
                $empre = $_POST['empresa'];
                $assunto = $_POST['assunto'];
                $msg = $_POST['msg'];
                if(empty($nome) || empty($email) || empty($tel) || empty($empre) || empty($assunto) || empty($msg)){
                    echo "<p>Digite valores acima!!!</p>";
                }else{
                    $calc->setvalues($nome, $email, $tel, $empre, $assunto, $msg);
                    #arquivo nome deve ser = dia-mes-ano_email@dele.com.br.txt
                    $x = $calc->criararquivo();
                    echo "<p>$x</p>";
                }

            }
        ?>

    </main>
    
</body>
</html>