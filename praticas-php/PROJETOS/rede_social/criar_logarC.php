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
    <link rel="stylesheet" href="estilos/modal.css">
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
                    <a href="chat.php?id=">Chat</a>
                    <a href="#">Chat em Grupo</a>
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
        <div><br>
            <?php
                date_default_timezone_set('America/Sao_Paulo');
                if(isset($_POST['s2'])){
                    $codigo = substr(md5(date("YmdHis")), 1, 7);
                    while(true){
                        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
                        $stmt->bind_param("s", $codigo);
                        $stmt->execute();

                        $verificar = '';
                        $resultado = $stmt->get_result();
                        while($linha = $resultado->fetch_object()){
                            $verificar = $linha->id_unico;
                            #echo $verificar;
                        }
                        if($verificar != $codigo){
                            break;
                        }
                        $codigo = substr(md5(date("YmdHis")), 1, 7);
                    }

                    #===============================
                    $nome = strip_tags(str_replace(";","_", $_POST['nome']));
                    $email = strip_tags(str_replace(";","_", $_POST['email']));
                    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                    #========================================================================
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nome=? OR email=?");
                    $stmt->bind_param("ss", $nome, $email);
                    $stmt->execute();
                    $verificar = '';
                    $verificar2 = '';
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $verificar = $linha->nome;
                        $verificar2 = $linha->email;
                        #echo $verificar;
                    }
                    if($verificar == $nome){
                        die("<p>Nome já existente! informe outro nome</p>");
                        
                    }
                    if($verificar2 == $email){
                        die("<p>Email existente, informe outro email!</p>");
                    }

                    #echo "$nome <br>$email<br>$senha<br>";
                    $pasta = "imagens/";

                    if($_FILES["foto"]['error'] == 4){
                        #echo "<p>testeee</p> <br><br>";
                        
                        $stmt = $conn->prepare("INSERT INTO usuario (id_unico,nome,email,senha) VALUES(?,?,?,?)");
                        $stmt->bind_param("ssss",$codigo, $nome, $email, $senha);
                        $stmt->execute();
                        $_SESSION['id_unico'] = $codigo;
                        $_SESSION['nome'] = $nome;
                        $_SESSION['email'] = $email;
                        $_SESSION['imgperfil'] = '';
                        $_SESSION['imgfundo'] = '';
                        $_SESSION['bio'] = '';
                        header("Location: perfil.php?id=$codigo");
                        #header("Location: pag_principal.php");

                    }else{
                        $extensao = pathinfo($_FILES['foto']['name']);
                        $extensao = ".".$extensao['extension'];
                        if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ){
                            
                            $imagem = $pasta.date("Y-m-d-H-i-s")."_perfil".$extensao;
                            if(move_uploaded_file($_FILES['foto']['tmp_name'], $imagem)){
                                echo "<p>arquivo válido e enviado com sucesso</p>";
                                $stmt = $conn->prepare("INSERT INTO usuario (id_unico,nome,email,senha,imgperfil) VALUES(?,?,?,?,?)");
                                $stmt->bind_param("sssss",$codigo, $nome, $email, $senha, $imagem);
                                $stmt->execute();
                                $_SESSION['id_unico'] = $codigo;
                                $_SESSION['nome'] = $nome;
                                $_SESSION['email'] = $email; 
                                $_SESSION['imgperfil'] = $imagem;
                                $_SESSION['imgfundo'] = '';
                                $_SESSION['bio'] = '';
                                header("Location: perfil.php?id=$codigo");

                            }else{
                                echo "<p>arquivo inválido<br>Ocorreu um erro ao enviar o arquivo!</p>";
                            }
                        }                        
                    }
                }
                #-===================login=====================
                else{
                    $email = strip_tags(str_replace(";","_", $_POST['email']));
                    $senha = $_POST['senha'];
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email=?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();

                    $verificar = '';
                    $resultado = $stmt->get_result();
                    while($linha = $resultado->fetch_object()){
                        $verificar = $linha->senha;
                        if(password_verify($senha, $verificar)){
                            $_SESSION['id_unico'] = $linha->id_unico;
                            $_SESSION['nome'] = $linha->nome;
                            $_SESSION['email'] = $linha->email;
                            $_SESSION['bio'] = $linha->bio;
                            $_SESSION['imgperfil'] = $linha->imgperfil;
                            $_SESSION['imgfundo'] = $linha->imgfundo;
                            header("Location: perfil.php?id={$linha->id_unico}");
                            break;
                        }
                    }
                    
                }
            
            ?>
        </div>
    </main>
    
    <script src="scripts/modal.js"></script>
    <script src="scripts/carregarimg.js"></script>
</body>
</html>