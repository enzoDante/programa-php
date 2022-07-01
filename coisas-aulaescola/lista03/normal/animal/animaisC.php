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
        <a href="animais.php">Voltar</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Lista de tipos</a>
        <hr>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <hr>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <h1></h1>
        <a href="../veterinario/veterinario.html">Cadastrar veterinário</a>
        <a href="../veterinario/tabelaveterinario.php">Lista de veterinários</a>
        <hr>
        <a href="../consulta/consultas.php">Marcar consulta</a>
        <a href="../consulta/tabelaconsultas.php">Lista de consultas</a>
    </nav>
    <main class="main">
        <?php
            $nome = strip_tags(strtolower(str_replace(",","-", $_POST['nome'])));
            $chip = strip_tags(strtolower(str_replace(",","-", $_POST['chip'])));
            $data = $_POST['data'];
            #$data = date("Y-d-m",strtotime($data));
            $sexo = $_POST['mf'];
            $raca = $_POST['idraca'];
            $dono = $_POST['cpf'];

            if($nome == "" || $chip == "" || $data == "" || $dono == ""){
                echo "<p class='msg'>Preenche todos os campos</p>";
                echo "<a class='linkmsg' href='animais.php'>Voltar</a>";
            }else{

                $stmt = $conn->prepare("SELECT * FROM DonoAnimal WHERE cpf=?");
                $stmt->bind_param("s",$dono);
                $stmt->execute();

                $verificar = "";
                $id = "";
                $resultado = $stmt->get_result();
                while($linha = $resultado->fetch_object()){
                    $verificar = $linha->cpf;
                    $id = $linha->idDonoAnimal;                  
                }

                if($verificar == ""){
                    echo "<p class='msg'>Cpf não foi cadastrado!</p>";
                    echo "<a class='linkmsg' href='animais.php'>Voltar</a>";
                }else{
                    $stmt = $conn->prepare("INSERT INTO Animal (nome,chipID,nascimento,sexo,RacaAnimal_idRacaAnimal,DonoAnimal_idDonoAnimal) VALUES(?,?,?,?,?,?)");
                    $stmt->bind_param("ssssss",$nome,$chip,$data,$sexo,$raca,$id);
                    $stmt->execute();
                    echo "<p class='msg'>Cadastro concluído!</p>";
                }
            }
        
        ?>
    </main>
    
</body>
</html>