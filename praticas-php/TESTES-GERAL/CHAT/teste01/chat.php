
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
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            /*
            
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
            =================================================================================
            *//*
            var auto_refresh = setInterval(
                function ()
                {
                $('#adiv').load('chat.php').fadeIn("slow");
                }, 10000
            ); // refresh every 10000 milliseconds
            =============================================================================== */            
            //setTimeout(function() {window.location.reload(1);}, 3000); // 3 segundos
            /*===============================================================================
            $(function() {
            setTime();
            function setTime() {
                //var date = new Date().getTime();
                //var string = "Timestamp: "+date;
                setTimeout(setTime, 3000);
                $('#adiv').html(string);
            }
            });
            ==============================================================================*/
        </script>
            <div id="adiv">
                <?php                    
                    $stmt = $conn->prepare("SELECT * FROM chat WHERE (enviar=? AND recebido=?) OR (enviar=? AND recebido=?)");
                    $stmt->bind_param('ssss', $_SESSION['id_unico'], $_GET['id'], $_GET['id'], $_SESSION['id_unico']);
                    $stmt->execute();

                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){                        
                        #===========nome do cara q enviou remetente==================
                        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                        $stmt->bind_param('s', $linha->enviar);
                        $stmt->execute();
                        $resultado2 = $stmt->get_result();
                        while($linha2 = $resultado2->fetch_object()){
                            echo "<strong>{$linha2->nome}</strong>";
                        }
                        #==========mensagem==============
                        echo "<p>{$linha->msg}</p><br>";
                    }
                
                ?>
            </div>
            <div>
                <form action="enviar.php" method="post">
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