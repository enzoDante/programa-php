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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        <a href="donos_animais.php">Voltar</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <hr>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../animal/animais.php">Cadastrar animais</a>
        <hr>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
        <hr>
        <a href="../consulta/consultas.php">Marcar consulta</a>
        <a href="../consulta/tabelaconsultas.php">Lista de consultas</a>
    </nav>
    <main class="main">
        <?php
            $nome = strip_tags(strtolower(str_replace(",","-", $_POST['nome'])));
            $senha = strip_tags(str_replace(",","-", $_POST['senha']));
            $email = strip_tags(strtolower(str_replace(",","-", $_POST['email'])));
            $cpf = strip_tags(str_replace(",","-", $_POST['cpf']));
            $tel = strip_tags(strtolower(str_replace(",","-", $_POST['telefone'])));
            $cel = strip_tags(strtolower(str_replace(",","-", $_POST['celular'])));
            $log = strip_tags(strtolower(str_replace(",","-", $_POST['logradouro'])));
            $num = strip_tags(str_replace(",","-", $_POST['num']));
            $comp = strip_tags(str_replace(",","-", $_POST['comp']));
            $bairro = strip_tags(str_replace(",","-", $_POST['bairro']));
            $estado = strip_tags($_POST['estado']);

            if($nome == "" || $senha == "" || $email == "" || $cpf == "" || $tel == "" || $cel == "" || $log == "" || $num == "" || $comp == "" || $bairro == ""){
                echo "<p class='msg'>preencha todos os campos</p>";
                echo "<a class='linkmsg' href='donos_animais.php'>Voltar</a>";
            }else{

                $stmt = $conn->prepare("SELECT * FROM DonoAnimal WHERE email=? OR cpf=?;");
                $stmt->bind_param("ss", $email, $cpf);
                $stmt->execute();
                $resultado = $stmt->get_result();

                $verificar = "";
                $verificar2 = "";
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->email;
                    $verificar2 = $linha->cpf;
                }
                if($verificar == $email || $verificar2 == $cpf){
                    echo "<p class='msg'>Dono já cadastrado!</p>";
                    echo "<a class='linkmsg' href='donos_animais.php'>Voltar</a>";
                }else{

                    $stmt = $conn->prepare("INSERT INTO DonoAnimal (nome,email,cpf,telefone,celular,logradouro,numero,complemento,bairro,estado) VALUES(?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssssss",$nome,$email,$cpf,$tel,$cel,$log,$num,$comp,$bairro,$estado);
                    $stmt->execute();
                    echo "<p class='msg'>Cadastro concluído</p><br>";
                    echo '<a class="linkmsg" href="../raca/tabela_tipos_racas.php">Tipos e raças de animais</a>';
                }

            }

        
        ?>
    </main>
    
</body>
</html>