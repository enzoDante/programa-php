<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "class_cliente.php";
        $cliente = new cliente();
        $id = $_GET['id'];
        $cliente->olhaum($id);
        
        $nome = $cliente->getnome();
        $email = $cliente->getemail();
        $senha = $cliente->getsenha();
        $data = $cliente->getdata();
        $salario = $cliente->getsalario();
    ?>
    <form action="alterarC.php" method="post">
        <fieldset>
            <legend>Dados pessoais</legend>
            <p>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </p>
            <p>
                <label for="inome">Nome:</label>
                <input type="text" name="nome" id="inome" value="<?php echo $nome; ?>">
            </p>
            <p>
                <label for="iemail">E-mail:</label>
                <input type="email" name="email" id="iemail" value="<?php echo $email; ?>">
            </p>
            <p>
                <label for="isenha">Senha:</label>
                <input type="password" name="senha" id="isenha" value="<?php echo $senha; ?>">
            </p>
            <p>
                <label for="idata">Nascimento:</label>
                <input type="date" name="data" id="idata" value="<?php echo $data; ?>">
            </p>
            <p>
                <label for="isalario">Salario:</label>
                <input type="number" name="salario" id="isalario" step="0.1" value="<?php echo $salario; ?>">
            </p>
        </fieldset>
        <p>
            <button type="submit">Alterar</button>
        </p>
    </form>
    <a href="index.html">cadastrar</a><br>
    <a href="olha_um.html">olhar um</a><br>
    <a href="olha_todos.php">olhar todos</a>
</body>
</html>