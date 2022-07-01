<?php
    include "../banco.php";
    $id = $_POST['id'];
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
        <?php echo "<a href='anamnese.php?id=$id'>Voltar</a>"; ?>        
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <hr>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
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
            $peso = $_POST['peso'];
            $pulga = $_POST['pulga'];
            $carr = $_POST['carrapato'];
            $mot = strip_tags(str_replace(",","-", $_POST['motivo']));
            $obs = strip_tags(str_replace(",","-", $_POST['obs']));
            $diag = strip_tags(str_replace(",","-", $_POST['diag']));

            if($peso == "" || $mot == "" || $diag == ""){
                echo "<p class='msg'>Preenche alguns campos!</p>";
                echo "<a class='linkmsg' href='anamnese.php?id=$id'>Voltar</a>";
            }else{
                $stmt = $conn->prepare("INSERT INTO ANAMNESE (peso,pulgas,carrapatos,motivoVisita,observacoes,diagnostico,Consulta_idConsulta) VALUES(?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssss",$peso,$pulga,$carr,$mot,$obs,$diag, $id);
                $stmt->execute();

                echo "<p class='msg'>ANAMNESE concluída</p>";
            }
        ?>
    </main>
</body>
</html>