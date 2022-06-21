<?php
    include "banco.php";

    $id = $_GET['id'];
    $preparar = $conn->prepare("SELECT * FROM Cliente WHERE idCliente = ?;");
    $preparar->bind_param("i", $id);
    $preparar->execute();

    $resultado = $preparar->get_result();
    while($linha = $resultado->fetch_object()){
        #$idCliente = $linha->idCliente;
        $nome = $linha->nome;
        $email = $linha->email;
        $senha = $linha->senha;
        $nascimento = $linha->nascimento;
        $salario = $linha->salario;
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
</head>
<body>
    <form action="alterar_confirmado.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>"><br>
        <input type="text" name ="nome" value="<?php echo $nome;?>"><br>
        <input type="text" name ="email" value="<?php echo $email;?>"><br>
        <input type="password" name ="senha" value="<?php echo $senha;?>"><br>
        <input type="date" name ="nascimento" value="<?php echo $nascimento;?>"><br>
        <input type="text" name ="salario" value="<?php echo $salario;?>"><br>
        <button type="submit">alterar</button><br>
    </form>
    <a href="index.php">index aq</a><br>
    <a href="olha_usus.php">todos aq</a><br>
    <a href="um_usu.php">somente um</a>
</body>
</html>