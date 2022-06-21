<?php
    include "banco.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = strip_tags($_POST['nome']);
        $email = strip_tags($_POST['email']);
        $sen = strip_tags($_POST['senha']);
        $dataa = strip_tags($_POST['data']);
        $salario = strip_tags($_POST['grana']);

        #segurança, preparando quando usuário interagem com o banco de dados
        $prepara_executar = $conn->prepare("INSERT INTO Cliente (nome,email,senha,nascimento,salario) values(?,?,?,?,?)");
        $prepara_executar->bind_param("sssss", $nome,$email,$sen,$dataa,$salario);
        $prepara_executar->execute();

        echo "nn sei se foi, vê lá";
        header("Location: olha_usus.php");
    }


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
    <form action="index.php" method="post">
        <input type="text" name="nome" id="" placeholder="nome"><br>
        <input type="email" name="email" id="" placeholder="email"><br>
        <input type="password" name="senha" id="" placeholder="senha"><br>
        <input type="date" name="data" id=""><br>
        <input type="number" name="grana" id="" placeholder="Salário"><br>
        <button type="submit">cadastrar</button><br>
    </form>

    <a href="olha_usus.php">Todos os usuários aq</a><br>
    <a href="um_usu.php">escolha alguém p ver aq</a>
</body>
</html>