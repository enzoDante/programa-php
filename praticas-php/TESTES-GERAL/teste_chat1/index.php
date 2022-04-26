<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function ajax(){
            let req = new XMLHttpRequest()
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText
                }
            }
            req.open('GET', 'chat.php', true)
            req.send()
        }
        setInterval(function(){ajax()}, 1000) //irá atualizar a página
    </script>
</head>
<body>
    <div id="chat">

    </div>
    <form action="index.php" method="post">
        <input type="text" name="nome" id="" placeholder="nome"><br>
        <input type="text" name="msg" id="" placeholder="mensagem"><br>
        <button type="submit">enviar</button>
    </form>
    <?php 
        include "banco.php";
        $nome = $_POST['nome'];
        $msg = $_POST['msg'];
        $conn->query("INSERT INTO chat1 SET nome='$nome', msg='$msg'");

    
    ?>
    
</body>
</html>