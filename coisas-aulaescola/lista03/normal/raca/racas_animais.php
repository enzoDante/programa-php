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
        <h1>Cadastrar raças de animais</h1>
    </header>
    <nav class="main">
        <a href="tabela_tipos_racas.php">Tabela de raças</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
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
        <form action="racas_animaisC.php" method="post">
            <h3 id="t">Digite uma raça:</h3><br>
            <input type="text" name="raca" id="" placeholder="Canis lupus arctos"><br>
            <select name="idtipo" id="">
                <?php
                    $sql = "SELECT * FROM TipoAnimal ORDER BY tipo;";
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            $op = "<option value='".$linha->idTipoAnimal."'>".$linha->tipo."</option>";
                            echo $op;
                        }
                    }
                
                ?>
            </select>
            <button type="submit">Cadastrar raça</button>

        </form>
    </main>
    
</body>
</html>