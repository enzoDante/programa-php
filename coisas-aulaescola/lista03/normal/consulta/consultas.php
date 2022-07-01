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
    <link rel="stylesheet" href="../estilo/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        <a href="tabelaconsultas.php">Lista de consultas</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <hr>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
    </nav>
    <main class="main">
        <form action="consultasC.php" method="post">
            <h3>Selecione o animal:</h3>
            <select name="idanimal" id="">
                <?php
                    $sql = "SELECT * FROM Animal ORDER BY nome";
                    
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            $op = "<option value='".$linha->idAnimal."'>";
                            $id2 = $linha->DonoAnimal_idDonoAnimal;

                            $sql2 = "SELECT * FROM DonoAnimal WHERE idDonoAnimal=$id2";
                            if($resultado2 = $conn->query($sql2)){
                                while($linha2 = $resultado2->fetch_object()){
                                    $op .= "(".$linha2->nome.") ";
                                    break;
                                }
                            }
                            $op .= $linha->nome."</option>";

                            echo $op;
                        }
                    }
                ?>
            </select>
            <h3>Selecione o veterinário:</h3>
            <select name="idveterinario" id="">
                <?php
                    $sql = "SELECT * FROM Veterinario ORDER BY nome";
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            echo "<option value='".$linha->idVeterinario."'>".$linha->nome."</option>";
                        }
                    }
                ?>
            </select>
            <h3>Escoha o dia e as horas:</h3>
            <input type="date" name="dia" id=""><br>
            <input type="time" name="horas" id=""><br>
            <button type="submit">Marcar consulta</button>
        </form>
    </main>
    
</body>
</html>