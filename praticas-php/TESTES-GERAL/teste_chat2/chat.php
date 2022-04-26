<?php
include "banco.php";

if (isset($_POST['nome']) && isset($_POST['mensagem'])) // verifica se as variáveis existem
{
    if ($_POST['nome'] != '' && $_POST['mensagem'] != '') 
    {
        echo "teste3 <br><br>";
 
        $message = $_POST['mensagem'];

        $pseudo = $_POST['nome'];
 
        $conn->query("INSERT INTO chat1 (nome, msg) VALUES('$pseudo', '$mensagem')");
        $_POST['nome'] = '';
 
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php 
        
            $sql = $conn->query("SELECT * FROM chat1");
            while($x = mysqli_fetch_array($sql)){
                echo $x['nome']."<br>";
                echo $x['msg']."<br>";
            }
        
        ?>
    </div>


    <form action="chat.php" method="post">
        <input type="text" name="nome" id="" placeholder="nome"><br>
        <textarea name="mensagem" id="" cols="30" rows="10"></textarea><br>
        <button type="submit">enviar</button>
    </form><br>

</body>
</html>