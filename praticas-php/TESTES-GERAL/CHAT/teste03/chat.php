<?php
    include "banco.php";
    session_start();
    $_SESSION['id_amigo'] = $_GET['id'];
?>
<script>
    function ajax(){
        let req = new XMLHttpRequest()
        req.onreadystatechange = function(){
            if(req.readyState == 4 && req.status == 200){
                document.getElementById('adiv').innerHTML = req.responseText
            }
        }
        req.open('GET', 'enviar.php', true)
        req.send()
    }
    setInterval(function(){ajax()}, 1000) //1000
</script>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modal.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <header>
        <h1>Logar</h1>
    </header>
    <nav>
        <div id="navegador">
            <div id="nav">
                <div id="left">
                    <h3>Nome Site</h3>
                </div>
                <div>
                    <a href="#">Home</a>
                    <a href="#">Navegar</a>
                    <a href="#">n sei oq</a>
                    <a href="#">perfil</a>
                    <a href="#">outros</a>
                </div>
            </div>
            <div id="divimg">
                <a href="#" id="perfila"><img src="../imagens/6223_wolf-image_2500x1697_h.jpg" alt=""></a>
            </div>
        </div>
    </nav>
    
    <main>
        <div><br>
        
            <div id="adiv" style="overflow: auto; height: 400px;">
                
            </div>



            <div>
                <?php
                
                    $msg = '';
                    if(isset($_POST['msg'])){
                        $msg = $_POST['msg'];
                    }
                    if($msg != ''){
                        $eu = $_POST['id_unico'];
                        $amigo = $_POST['amigo'];

                        $stmt = $conn->prepare("INSERT INTO chat (enviar, recebido, msg) VALUES(?,?,?)");
                        #$stmt->bind_param('sss', $_SESSION['id_unico'], $_GET['id'], $_POST['msg']);
                        $stmt->bind_param('sss', $eu, $amigo, $msg);
                        $stmt->execute();
                        header("Location: chat.php?id=$amigo");            
                    }
                
                ?>
                <form action="chat.php" method="post">
                    <input type="hidden" name="id_unico" value="<?php echo $_SESSION['id_unico']; ?>">
                    <input type="hidden" name="amigo" value="<?php echo $_GET['id']; ?>">
                    <input type="text" name="msg" id="imsg" placeholder="textoaq">
                    <button type="submit">Enviar</button>
                </form>
            </div>

        </div>
    </main>
</body>
</html>