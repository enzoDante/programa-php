<?php
    include "../banco.php";

    $id = $_GET['id'];
    $preparar = $conn->prepare("SELECT * FROM tipoAnimal WHERE idTipoAnimal = ?;");
    $preparar->bind_param("i", $id);
    $preparar->execute();

    $resultado = $preparar->get_result();
    while($linha = $resultado->fetch_object()){
        $tipo = $linha->tipo;
    }
    $conn->close();
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
        <h1>Alterar o tipo de animal</h1>
    </header>
    <nav>
        <a href="tabela_tipos.php">Voltar</a>
        <a href="tipos_animais.html">Cadastrar tipos</a>
    </nav>
    <main>
        <form action="alterarTipo.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"><br>
            <input type="text" name ="tipo" value="<?php echo $tipo;?>"><br>
            <button type="submit">alterar</button><br>
        </form>
    </main>
</body>
</html>