<?php 
    include "banco.php";
    session_start();

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            $id = $_GET['id'];
            session_destroy();
            header("Location: perfil.php?id=$id");
            exit();
        }
    }    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/perfil.css">
    <link rel="stylesheet" href="estilos/modal.css">
</head>
<body>
    <header>
        <h1>Perfil</h1>
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
                    <a href="chat.php?id=">Chat</a>
                    <a href="#">Chat em Grupo</a>
                    <!--<a href="#">outros</a>-->
                </div>
            </div>
            <!--se nn estiver logado-->
            <!--<a href="">Logar</a>-->
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="perfil.php?a=logout&id=<?php echo $id; ?>">Sair</a>
                <div id="divimg">
                    <!--link p perfil(se estiver logado) link p criar/logar (se nn estiver logado)-->
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>        
    </nav>

    <main>        
        <div>
            <?php
                $id_pessoa = $_POST['id'];
                $b = 'bloqueado';
                $stmt = $conn->prepare("SELECT * FROM seguidores WHERE id_seguir=? AND id_seguindo=? AND bloquear=?");
                $stmt->bind_param("sss", $_SESSION['id_unico'], $id_pessoa, $b);
                $stmt->execute();

                $verificar = '';
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->id_seguindo;
                }
                if($verificar == ''){
                    $b = 'bloqueado';
                    $stmt = $conn->prepare("INSERT INTO seguidores (id_seguir,id_seguindo,bloquear) VALUES(?,?,?)");
                    $stmt->bind_param("sss", $_SESSION['id_unico'], $id_pessoa, $b);
                    $stmt->execute();
                    #-=-=-=-=--=--=--=-=-=-=-=-=-=-=-=-=-=
                    $b = 'n';
                    $stmt = $conn->prepare("DELETE FROM seguidores WHERE id_seguir=? AND id_seguindo=? AND bloquear=?");
                    $stmt->bind_param("sss", $_SESSION['id_unico'], $id_pessoa, $b);
                    $stmt->execute();
                    
                    header("Location: perfil.php?id=$id_pessoa");
                }else{
                    #==========remover bloqueado=============
                    $b = 'bloqueado';
                    $stmt = $conn->prepare("DELETE FROM seguidores WHERE id_seguir=? AND id_seguindo=? AND bloquear=?");
                    $stmt->bind_param("sss", $_SESSION['id_unico'], $id_pessoa, $b);
                    $stmt->execute();
                    header("Location: perfil.php?id=$id_pessoa");
                }
                #===================================================================================
            ?>
        </div><br>

    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
    <footer>

    </footer>
    
</body>
</html>