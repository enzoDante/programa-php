<?php 
    include "banco.php";
    session_start();
    $id = $_GET['id'];

    if(isset($_GET['a'])){
        if($_GET['a'] == 'logout'){
            $id = $_GET['id'];
            session_destroy();
            header("Location: seguindo.php?id=$id");
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
    <title>Seguindo</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/post.css">
    <link rel="stylesheet" href="estilos/seguinres.css">
</head>
<body>
    <header>
        <h1>Seguindo</h1>
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
                    <a href="criar_turma.php">Criar turma</a>
                    <a href="criar_tipoPost.php">Criar tipo post</a>
                </div>
            </div>
            <?php if(isset($_SESSION['id_unico'])): ?>
                <a href="perfil.php?a=logout&id=<?php echo $id; ?>">Sair</a>
                <div id="divimg">
                    <a href="perfil.php?id=<?php echo $_SESSION['id_unico']; ?>" id="perfila"><img src="<?php echo $_SESSION['imgperfil']; ?>" alt=""></a>
                </div>
            <?php else: ?>
                <a href="login.php">Logar</a>
            <?php endif; ?>
        </div>        
    </nav>

    <main>
        <div>
            <div id="seguires">
                <a href="perfil.php?id=<?php echo $id; ?>" class="seguiros"><img style="width: 45px;" src="imagens/voltar.png" alt=""></a>
            </div>
            <div id="comentarios">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM seguidor WHERE usuario_idusuario_seguidor=?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $valorr = $linha->usuario_idusuario_Seguido;
                        $stmt2 = $conn->prepare("SELECT idusuario,nome,foto,turma_idturma,idturma,turma,ano FROM usuario, turma WHERE turma_idturma=idturma AND idusuario=$valorr ORDER BY nome");
                        #$stmt2 = $conn->prepare("SELECT id_unico,nome,imgperfil FROM usuario WHERE id_unico=?");
                        #$stmt2->bind_param("s", $linha->id_seguindo);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();
                        while($linha2 = $resultado2->fetch_object()){
                            $div = "
                                <div id='publicar' class='borda'>
                                    <div id='navegador'>
                                        <span id='perfila'>
                                            <a href='perfil.php?id=$linha2->idusuario'><img src='$linha2->foto'></a>
                                        </span>
                                        <a href='perfil.php?id=$linha2->idusuario'>$linha2->nome</a>
                                        <p>Turma: $linha2->ano $linha2->turma</p>
                                        <a href='perfil.php?id=$linha2->idusuario'>Seguir</a>
                                    </div>
                                </div>
                            ";
                        }
                        echo $div;
                    }
                
                
                ?>
            </div>

        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>