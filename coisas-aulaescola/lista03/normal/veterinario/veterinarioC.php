<?php
    include "../banco.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav>

    </nav>
    <main>
        <?php
            $nome = strip_tags(strtolower(str_replace(",","-", $_POST['nome'])));
            $email = strip_tags(strtolower($_POST['email']));
            $senha = strip_tags($_POST['senha']);
            $csenha = strip_tags($_POST['csenha']);
            $crmv = strip_tags(str_replace(",","-", $_POST['crmv']));
            $cpf = strip_tags(strtolower(str_replace(",","-", $_POST['cpf'])));

            if($nome == "" || $email == "" || $senha == "" || $csenha == "" || $crmv == "" || $cpf == "" || $senha != $csenha){
                echo "<p class='msg'>Preenche todos os campos corretamente!!!</p>";
                echo "<a class='linkmsg' href='veterinario.html'>Voltar</a>";
            }else{

                $stmt = $conn->prepare("SELECT * FROM Veterinario WHERE email=? OR cpf=?");
                $stmt->bind_param("ss",$email,$cpf);
                $stmt->execute();
                $verificar = "";
                $verificar2 = "";

                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->cpf;
                    $verificar2 = $linha->email;
                }
                if($verificar == $cpf || $verificar2 == $email){
                    echo "<p class='msg'>CPF ou Email já existente</p>";
                    echo "<a class='linkmsg' href='veterinario.html'>Voltar</a>";
                }else{
                    $stmt = $conn->prepare("INSERT INTO Veterinario (nome,email,senha,CRMV,cpf) VALUES(?,?,?,?,?)");
                    $stmt->bind_param("sssss",$nome,$email,$senha,$crmv,$cpf);
                    $stmt->execute();
                    echo "<p class='msg'>Cadastrado com sucesso!</p>";
                    echo "<a class='linkmsg' href='tabelaveterinario.php'>Lista de veterinários</a>";
                }


            }

        ?>
    </main>
    
</body>
</html>