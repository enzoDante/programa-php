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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Cadastro de animais</h1>
    </header>
    <nav>
        <a href="tipos_animais.html">Voltar</a>
        <a href="tabela_tipos.php">Tipos de animais</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
    </nav>
    <main>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $tipo = strip_tags($_POST['tipo']);
                $tipo = strtolower($tipo);
                $tipo = str_replace(",", "-", $tipo);

                $stm = $conn->prepare("SELECT * FROM TipoAnimal WHERE tipo=?;");
                $stm->bind_param('s', $tipo);
                $stm->execute();
                $resultado = $stm->get_result();
                $verificar = "";
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->tipo;
                }
                if(strlen($tipo) < 3)
                    echo "<p class='msg'>Digite um tipo com mais de 3 letras!</p><br>";
                else{
                    if($verificar == $tipo)
                        echo "<p class='msg'>Tipo já cadastrado!</p>";
                    else{
                        
                        
                        $stm = $conn->prepare("INSERT INTO TipoAnimal (tipo) values(?)");
                        $stm->bind_param('s', $tipo);
                        $stm->execute();
                        echo "<p class='msg'>Cadastro concluído</p><br>";
                        echo '<a class="linkmsg" href="tabela_tipos.php">Tipos de animais</a>';
                        
                    }
                }
                
            }
            $conn->close();
        ?>
    </main>
</body>
</html>
