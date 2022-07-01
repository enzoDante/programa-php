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
        <a href="consultas.php">Marcar consulta</a>
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
    </nav>
    <main class="main">
        <form action="tabelaconsultas.php" method="get">
            <input type="date" name="dia" id=""><br>
            <select name="idveterinario" id="">
                <?php
                echo "<option value='0'>Todos os médicos</option>";
                    $sql = "SELECT * FROM Veterinario ORDER BY nome";
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            echo "<option value='".$linha->idVeterinario."'>".$linha->nome."</option>";
                        }
                    }
                ?>
            </select>
            <button type="submit">Procurar consulta</button>
        </form>
        <?php
            if(!isset($_GET['dia']) || !isset($_GET['idveterinario'])){
                $dia = "";
                $vet = 0;
            }else{
                $dia = $_GET['dia'];
                $vet = $_GET['idveterinario'];
            }
            
            $sql = "SELECT * FROM Consulta ORDER BY idConsulta DESC";
            if($dia != "" && $vet != 0){
                $sql = "SELECT * FROM Consulta WHERE data='$dia' AND Veterinario_idVeterinario=$vet ORDER BY idConsulta DESC";
            }else{
                if($dia != "")
                    $sql = "SELECT * FROM Consulta WHERE data='$dia' ORDER BY idConsulta DESC";                    
                else{
                    if($vet != 0)
                    $sql = "SELECT * FROM Consulta WHERE Veterinario_idVeterinario=$vet ORDER BY idConsulta DESC";
                }
            }

            #$sql = "SELECT * FROM Consulta ORDER BY idConsulta DESC";
            $tabela = "<table id='tabela'>";
            $tabela .= "<tr><th>Data</th> <th>Hora</th> <th>Nome</th> <th>Veterinário</th><th></th></tr>";
            if($resultado = $conn->query($sql)){
                while($linha = $resultado->fetch_object()){
                    $id = $linha->Veterinario_idVeterinario;
                    $id2 = $linha->Animal_idAnimal1;
                    $id3 = $linha->idConsulta;
                    $tabela .= "<tr>";
                    $tabela .= "<td>".$linha->data."</td>";
                    $tabela .= "<td>".$linha->hora."</td>";

                    $sql = "SELECT * FROM Animal WHERE idAnimal=$id2";
                    if($resultado2 = $conn->query($sql)){
                        while($linha2 = $resultado2->fetch_object()){
                            $tabela .= "<td>".$linha2->nome."</td>";
                            break;
                        }
                    }
                    $sql = "SELECT * FROM Veterinario WHERE idVeterinario=$id";
                    if($resultado2 = $conn->query($sql)){
                        while($linha2 = $resultado2->fetch_object()){
                            $tabela .= "<td>".$linha2->nome."</td>";
                            break;
                        }
                    }
                    $tabela .= "<td><a href='../anamnese/anamnese.php?id=$id3'>Anamnese</a></td>";
                    $tabela .= "</tr>";
                }
            }
            $tabela .= "</table>";
            echo $tabela;
        ?>
    </main>
    
</body>
</html>