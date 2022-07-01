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
    <link rel="stylesheet" href="../styles/radios.css">
    <link rel="stylesheet" href="../styles/texto.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">

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
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM Consulta WHERE idConsulta=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $resultado = $stmt->get_result();
            while($linha = $resultado->fetch_object()){
                $dia = $linha->data; #dia
                $horas = $linha->hora; #hora

                $ida = $linha->Animal_idAnimal1;
                $sql = "SELECT * FROM Animal WHERE idAnimal=$ida";
                if($resultado1 = $conn->query($sql)){
                    while($linha1 = $resultado1->fetch_object()){
                        $nomea = $linha1->nome; #nome animal
                        $idraca = $linha1->RacaAnimal_idRacaAnimal;
                        $iddono = $linha1->DonoAnimal_idDonoAnimal;
                    }
                }
                $sql = "SELECT * FROM DonoAnimal WHERE idDonoAnimal=$iddono";
                if($resultado1 = $conn->query($sql)){
                    while($linha1 = $resultado1->fetch_object()){
                        $dono = $linha1->nome; #nome Dono
                    }
                }

                $sql = "SELECT * FROM RacaAnimal WHERE idRacaAnimal=$idraca";
                if($resultado1 = $conn->query($sql)){
                    while($linha1 = $resultado1->fetch_object()){
                        $raca = $linha1->raca; #nome raça
                        $idtipo = $linha1->TipoAnimal_idTipoAnimal;
                    }
                }
                $sql = "SELECT * FROM TipoAnimal WHERE idTipoAnimal=$idtipo";
                if($resultado1 = $conn->query($sql)){
                    while($linha1 = $resultado1->fetch_object()){
                        $tipo = $linha1->tipo; #nome tipo
                    }
                }

                $idvet = $linha->Veterinario_idVeterinario;
                $sql = "SELECT * FROM Veterinario WHERE idVeterinario=$idvet";
                if($resultado1 = $conn->query($sql)){
                    while($linha1 = $resultado1->fetch_object()){
                        $nomev = $linha1->nome; #nome veterinario
                    }
                }

            }

        ?>
        <div>
            <h3>Consulta do dia: <?php echo $dia." as ".$horas; ?></h3><br>
            <h3>Cliente: <?php echo $dono; ?></h3><br>
            <h3>Paciente: <?php echo $nomea; ?></h3><br>
            <h3>Raça do animal: <?php echo $raca;?> | Tipo do animal: <?php echo $tipo; ?></h3><br>
            <h3>Médico: <?php echo $nomev; ?></h3><br>
        </div>
        <form action="anamneseC.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"><br>
            <h3>Informe o peso de seu animal:</h3>
            <input type="number" name="peso" id=""><br>
            <div id="radios">
                <h3>Pulgas:</h3>
                <input type="radio" name="pulga" value="S" id="radio1" checked>
                <label for="radio1">SIM</label>
                <input type="radio" name="pulga" value="N" id="radio2">
                <label for="radio2">NÃO</label>
            </div>
            <div id="radios">
                <h3>Carrapatos</h3>
                <input type="radio" name="carrapato" value="S" id="radio1" checked>
                <label for="radio1">SIM</label>
                <input type="radio" name="carrapato" value="N" id="radio2">
                <label for="radio2">NÃO</label>
            </div>
            <h3>Motivo da visita</h3>
            <textarea name="motivo" id="" cols="45" rows="10"></textarea><br>
            <h3>Observações</h3>
            <textarea name="obs" id="" cols="45" rows="10"></textarea><br>
            <h3>Diagnóstico</h3>
            <textarea name="diag" id="" cols="45" rows="10"></textarea><br>
            <button type="submit">Anamnese</button>
        </form>
    </main>
    
</body>
</html>