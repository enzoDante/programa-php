<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
        setInterval(function(){ajax()}, 100) //1000
    </script>
    <div id="chat">

    </div>

    <form action="index.php" method="post">
        <input type="text" name="nome" id="nome" placeholder="Nome">
        <input type="text" name="msg" id="msg" placeholder="msg">
        <button type="submit">Enviar</button>
    </form>
    <?php
        include "banco.php";
        $msg = '';
        if(isset($_POST['msg'])){
            $msg = $_POST['msg'];
        }
        if($msg != ''){
            $nome = $_POST['nome'];            
            $stmt = $conn->prepare("INSERT INTO testechat (nome, msg) VALUES(?,?)");
            $stmt->bind_param("ss", $nome, $msg);
            $stmt->execute();

        }


    ?>
</body>
</html>