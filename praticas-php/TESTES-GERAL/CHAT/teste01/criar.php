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
            <?php
                if(isset($_POST['nome'])){
                    $nome = $_POST['nome'];
                }
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $codigo = substr(md5(date("YmdHis")), 1, 7);
                #gera um código alfa numerico de 7 caracteres
                if(isset($_POST['nome'])){
                    $stmt = $conn->prepare("INSERT INTO usuario (id_unico, nome,email,senha) VALUES(?,?,?,?)");
                    $stmt->bind_param('ssss',$codigo, $nome, $email, $senha);
                    $stmt->execute();
                    $_SESSION['id_unico'] = $codigo;
                    $_SESSION['email'] = $email;
                    $_SESSION['nome'] = $nome;
                    echo "<h3>Criado e logado</h3>";
                }else{

                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email=? AND senha=?");
                    $stmt->bind_param('ss', $email, $senha);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $_SESSION['id_unico'] = $linha->id_unico;
                        $_SESSION['email'] = $linha->email;
                        $_SESSION['nome'] = $linha->nome;
                    }
                    echo "<h3>logado</h3>";
                }
            ?>

        </div>
    </main>
</body>
</html>