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
    <link rel="stylesheet" href="../estilos/radios.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.php">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
    </nav>
    <main class="main">
        <form action="animaisC.php" method="post">
            <h3>Digite o nome do animal:</h3>
            <input type="text" name="nome" id=""><br>
            <h3>Digite o ChipID:</h3>
            <input type="text" name="chip" id=""><br>
            <h3>Data de nascimento:</h3>
            <input type="date" name="data" id=""><br>
            <h3>Sexo:</h3>
            <div id="radios">
                <input type="radio" name="mf" value="M" id="radio1" checked>
                <label for="radio1">Masculino</label>
                <input type="radio" name="mf" value="F" id="radio2">
                <label for="radio2">Feminino</label>
            </div>
            <h3>Selecione a raça:</h3>
            <select name="idraca" id="">
                <?php
                    $sql = "SELECT * FROM RacaAnimal ORDER BY raca";
                    $valor = "";
                    $i = 0;
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            if($i == 0){
                                echo "<option value='".$linha->idRacaAnimal."'>".$linha->raca."</option>";
                                $i++;
                                $valor = $linha->raca;
                            }else{
                                if($valor != $linha->raca){
                                    echo "<option value='".$linha->idRacaAnimal."'>".$linha->raca."</option>";
                                    $valor = $linha->raca;
                                }
                            }
                        }
                    }
                
                ?>
            </select>
            <!--
                    <select name="iddono" id="">
                </*?php
                    $sql = "SELECT * FROM DonoAnimal";
                    if($resultado = $conn->query($sql)){
                        while($linha = $resultado->fetch_object()){
                            echo "<option value='".$linha->idDonoAnimal."'>".$linha->nome." | ".$linha->cpf."</option>";
                        }
                    }

                ?>*/
            </select>

            -->
            <h3>Digite o cpf do dono:</h3>
            <input type="number" name="cpf" id=""><br>
            <button type="submit">Cadastrar animal</button>
        </form>
    </main>
    
</body>
</html>