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
        <?php
            $animalid = $_POST['idanimal'];
            $vetid = $_POST['idveterinario'];
            $data = $_POST['dia'];
            $hora = $_POST['horas'];
            if($data == "" || $hora == ""){
                echo "<p class='msg'>Não deixe os campos vazios!</p>";
                echo "<a class='linkmsg' href='consultas.php'>Voltar</a>";
            }else{
                date_default_timezone_set('America/Sao_Paulo');
                $hoje = date("Y-m-d");
                $h = date("H-i");
                if($data < $hoje){
                    echo "<p class='msg'>Escolha uma data válida!</p>";
                    echo "<a class='linkmsg' href='consultas.php'>Voltar</a>";
                }else{
                    if($hora < $h){
                        echo "<p class='msg'>Escolha um horário válido!</p>";
                        echo "<a class='linkmsg' href='consultas.php'>Voltar</a>";
                    }else{
                        $stmt = $conn->prepare("SELECT * FROM Consulta WHERE data=? OR hora=? OR Veterinario_idVeterinario=?");
                        $stmt->bind_param("sss",$data,$hora,$vetid);
                        $stmt->execute();
                        $verificar = "";
                        $verificar1 = "";
                        $verificar2 = "";

                        $hora = $hora.":00";
                        $resultado = $stmt->get_result();
                        while($linha = $resultado->fetch_object()){
                            $verificar = $linha->data;
                            $verificar1 = $linha->hora;
                            $verificar2 = $linha->Veterinario_idVeterinario;
                        }
                        if($data == $verificar || $hora == $verificar1 || $vetid == $verificar2){
                            echo "<p class='msg'>Horário ou médico indisponível</p>";
                            echo "<a class='linkmsg' href='consultas.php'>Voltar</a>";
                        }else{
                            $stmt = $conn->prepare("INSERT INTO Consulta (data,hora,Animal_idAnimal1,Veterinario_idVeterinario) VALUES(?,?,?,?)");
                            $stmt->bind_param("ssss",$data,$hora,$animalid,$vetid);
                            $stmt->execute();
    
                            echo "<p class='msg'>Consulta marcada!</p>";
                        }

                    }
                }
            }
        ?>
    </main>
    
</body>
</html>