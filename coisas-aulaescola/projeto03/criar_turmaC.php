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
    <title>Cadastro</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/modalss.css">
    <link rel="stylesheet" href="estilos/criar_logar.css">
</head>
<body>
    <?php 
        if(isset($_GET['a'])){
            if($_GET['a'] == 'logout'){
                session_destroy();
                header("Location: criar_conta.php");
                exit();
            }
        }
    
    ?>
    <header>
        <h1>Cadastrar</h1>
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
                <a href="criar_conta.php?a=logout">Sair</a>
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
        <?php
            $turma = $_POST['turma'];
            $ano = $_POST['ano'];
            $stmt = $conn->prepare("INSERT INTO turma (turma, ano) VALUES (?,?)");
            $stmt->bind_param("si", $turma, $ano);
            $stmt->execute();
            echo "<p>Criado com sucesso!</p>";
            #header("Location: criar_conta.php");
        ?>
        </div>
    </main>
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>