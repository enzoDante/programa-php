<?php 
    include "banco.php";
    session_start();

    $_SESSION['id_amigo'] = $_GET['id'];
    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            session_destroy();
            header("Location: pag_principal.php");
            exit();
        }
    }    
?>
<script>
    function ajax(){
        let req = new XMLHttpRequest()
        req.onreadystatechange = function(){
            if(req.readyState == 4 && req.status == 200){
                document.getElementById('msgs').innerHTML = req.responseText
            }
        }
        req.open('GET', 'chatenviar.php', true)
        req.send()
        var objDiv = document.getElementById("msgs");
        objDiv.scrollTop = objDiv.scrollHeight;
    }
    setInterval(function(){ajax()}, 1000) //1000
</script>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/chat.css">
    <link rel="stylesheet" href="estilos/modal.css">
</head>
<body>
    <header>
        <h1>Chat</h1>
    </header>
    <nav>
        <div id="navegador">
            <div id="nav">
                <div id="left">
                    <h3>Nome Site</h3>
                </div>
                <div>
                    <a href="pag_principal.php">Home</a>
                    <a href="pag_busca.php">Buscar</a>
                    <a href="#">Chat</a>
                    <a href="#">Chat em Grupo</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="chat.php?a=logout">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
                <?php else: ?>
                    <a href="login.php">Logar</a>
                <?php endif; ?>
        </div>        
    </nav>

    <main>
        <div id="barra">
            <div id="nome">
                <h3><?php echo $_SESSION['nome']; ?></h3>
            </div>
            <div id="destinatario">
                <?php if($_SESSION['id_amigo'] != ''): ?>
                <?php
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                    $stmt->bind_param("s", $_SESSION['id_amigo']);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $div = "
                            <div class='alinhar'>
                                <a href='perfil.php?id={$_SESSION['id_amigo']}' class='usuimg'><img src='$linha->imgperfil'></a>
                                <a href='perfil.php?id={$_SESSION['id_amigo']}'>$linha->nome</a>
                            </div>
                        ";
                        echo $div;
                    }    
                ?>
                <?php else: ?>
                    <div class='alinhar'>
                        <a href='#' class='usuimg'><img src='imagens/blank-profile-picture.png'></a>
                        <a href='#'></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="grid">
            <!--abaixo é a lista de amigos p conversar-->
            <div id="amigos">
                <?php
                $b = 'n';
                    $stmt = $conn->prepare("SELECT * FROM seguidores WHERE id_seguir=? AND bloquear=?");
                    $stmt->bind_param("ss", $_SESSION['id_unico'], $b);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $stmt2 = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                        $stmt2->bind_param("s", $linha->id_seguindo);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();
                        while($linha2 = $resultado2->fetch_object()){
                            $div = "
                            <div class='alinhar'>
                                <a href='chat.php?id=$linha2->id_unico' class='usuimg'><img src='$linha2->imgperfil'></a>
                                <a href='chat.php?id=$linha2->id_unico'>$linha2->nome</a>
                            </div>
                            ";
                            echo $div;
                        }
                    }

                    #============================
                ?>
                
                <!--===============================-->

            </div>
            <!--abaixo é o chat-->
            <div id="chat">
                <div id="msgs">

                    <!--<div class="emsg">
                        <p class="msge">afadf <a target="_blank" href="https://www.google.com.br">www.google.com</a></p>
                    </div>-->

                </div>
                <hr>
                <!--==========================================-->
                <div id="enviar">
                    <?php
                        $msg = '';
                        if(isset($_POST['msg'])){
                            $msg = $_POST['msg'];
                        }
                        if($msg != ''){
                            $eu = $_POST['meu_id'];
                            $amigo = $_POST['id_amigo'];
    
                            $stmt = $conn->prepare("INSERT INTO chat (id_remetente, id_destinatario, msg) VALUES(?,?,?)");
                            #$stmt->bind_param('sss', $_SESSION['id_unico'], $_GET['id'], $_POST['msg']);
                            $stmt->bind_param('sss', $eu, $amigo, $msg);
                            $stmt->execute();
                            header("Location: chat.php?id=$amigo");
                        }
                    
                    
                    ?>
                    <?php if(isset($_SESSION['id_unico'])): ?>
                        <form action="chat.php?id=<?php echo $_SESSION['id_amigo']; ?>" method="post" id="chatbate">
                            <button type="submit" id="btn" onclick="acharlink(event)">Enviar</button>
                            <input type="hidden" name="meu_id" value="<?php echo $_SESSION['id_unico']; ?>">
                            <input type="hidden" name="id_amigo" value="<?php echo $_SESSION['id_amigo']; ?>">
                            <textarea name="msgo" id="imsg" cols="30" rows="10" placeholder="Papear"></textarea>
                            <input type="hidden" name="msg" id="iimsg">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div><br>

    </main>
    <script src="scripts/chatScroll.js"></script>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <footer>
        <!--<p id="testando"></p>-->
    </footer>
    
</body>
</html>