<?php
    include "../banco.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Veterinario WHERE idVeterinario=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){
        $nome = $linha->nome;
        $email = $linha->email;
        $crmv = $linha->CRMV;
        $cpf = $linha->cpf;
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
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <nav class="main">
        <a href="tabelaveterinario.php">Voltar</a>
        <a href="veterinario.html">Cadastrar veterinário</a>
    </nav>
    <nav class="sidenav">
        <a href="../tipo/tipos_animais.php">Cadastrar tipos</a>
        <a href="../tipo/tabela_tipos.php">Lista de tipos</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Lista de raças</a>
        <a href="../dono/donos_animais.php">Cadastrar dono</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
    </nav>
    <main class="main">
        <form action="alterarVet.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>"><br>
            <h3>Nome:</h3>
            <input type="text" name="nome" id="" value="<?php echo $nome; ?>"><br>
            <h3>Email:</h3>
            <input type="email" name="email" id="" value="<?php echo $email; ?>"><br>
            <h3>Senha:</h3>
            <input type="password" name="senha" id=""><br>
            <h3>Confirmar senha:</h3>
            <input type="password" name="csenha" id=""><br>
            <h3>CRMV:</h3>
            <input type="text" name="crmv" id="" value="<?php echo $crmv; ?>"><br>
            <h3>Cpf:</h3>
            <input type="number" name="cpf" id="" value="<?php echo $cpf; ?>"><br>
            <button type="submit">Alterar</button>
        </form>
    </main>
    
</body>
</html>