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
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        <a href="formAlterarVet.php">Voltar</a>
        <a href="tabelaveterinario.php">Lista de veterinários</a>
        <a href="veterinario.html">Cadastrar veterinário</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.php">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
    </nav>
    <main class="main">
        <?php
            $id = $_POST['id'];
            $nome = strip_tags(strtolower(str_replace(",", "-", $_POST['nome'])));
            $email = strip_tags(strtolower(str_replace(",", "-", $_POST['email'])));
            $senha = strip_tags($_POST['senha']);
            $csenha = strip_tags($_POST['csenha']);
            $crmv = strip_tags(strtolower(str_replace(",", "-", $_POST['crmv'])));
            $cpf = strip_tags(strtolower(str_replace(",", "-", $_POST['cpf'])));

            if($nome == "" || $email == "" || $crmv == "" || $cpf == ""){
                echo "<p class='msg'>Preenche todos os campos corretamente!!!</p>";
                echo "<a class='linkmsg' href='formAlterarVet.php?id=$id'>Voltar</a>";
            }else{
                if($csenha != "" || $senha != ""){
                    if($csenha != $senha){
                        echo "<p class='msg'>As senhas deve ser iguais</p>";
                        echo "<a class='linkmsg' href='formAlterarVet.php?id=$id'>Voltar</a>";
                    }else{
                        $stmt = $conn->prepare("UPDATE Veterinario SET nome=?,email=?,senha=?,CRMV=?,cpf=? WHERE idVeterinario=?;");
                        $stmt->bind_param("ssssss",$nome,$email,$senha,$crmv,$cpf,$id);
                        $stmt->execute();
                        echo "<p class='msg'>Alterado com sucesso</p>";
                        echo "<a class='linkmsg' href='tabelaveterinario.php'>Voltar para lista de veterinários</a>";
                    }
                }else{
                    $stmt = $conn->prepare("UPDATE Veterinario SET nome=?,email=?,CRMV=?,cpf=? WHERE idVeterinario=?;");
                    $stmt->bind_param("sssss",$nome,$email,$crmv,$cpf,$id);
                    $stmt->execute();
                    echo "<p class='msg'>Alterado com sucesso</p>";
                    echo "<a class='linkmsg' href='tabelaveterinario.php'>Voltar para lista de veterinários</a>";
                }

                
                

            }

        ?>
    </main>
    
</body>
</html>