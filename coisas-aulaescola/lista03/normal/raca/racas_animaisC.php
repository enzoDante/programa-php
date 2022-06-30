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
        <a href="racas_animais.php">Voltar</a>

    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
    </nav>
    <main class="main">
        <?php
            $raca = strip_tags($_POST['raca']);
            $raca = strtolower($raca);
            $raca = str_replace(",", "-", $raca);

            $tipo = $_POST['idtipo'];
            
            $stmt = $conn->prepare("SELECT * FROM RacaAnimal, TipoAnimal WHERE raca=? AND idTipoAnimal=? AND TipoAnimal_idTipoAnimal=?");
            $stmt->bind_param('sss', $raca, $tipo, $tipo);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $verificar = "";
            $verificar2 = "";
            while($linha = $resultado->fetch_object()){
                $verificar = $linha->raca;
                $verificar2 = $linha->idTipoAnimal;
            }

            if(strlen($raca) < 3)
                echo "<p class='msg'>Digite uma raça com mais de 3 caractere!</p>";
            else{
                if(($verificar == $raca) && ($verificar2 == $tipo))
                    echo "<p class='msg'>Raça já cadastrado!</p>";
                else{
                    $stmt = $conn->prepare("INSERT INTO RacaAnimal (raca, TipoAnimal_idTipoAnimal) VALUES(?,?)");
                    $stmt->bind_param('ss', $raca, $tipo);
                    $stmt->execute();
                    echo "<p class='msg'>Cadastro concluído</p><br>";
                    echo '<a class="linkmsg" href="tabela_tipos_racas.php">Tipos e raças de animais</a>';

                }

            }
        ?>
    </main>
    
</body>
</html>