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
    <nav>
        <a href="../tipos/tipos_animais.html">Cadastrar tipos</a>
        <a href="../tipos/tabela_tipos.php">Tipos de animais</a>
        <a href="../raca/racas_animais.php">Cadastrar raças</a>
        <a href="../raca/tabela_tipos_racas.php">Tipos e Raças</a>
        <a href="../animal/animais.php">Cadastrar animais</a>
    </nav>
    <main>
        <form action="donos_animaisC.php" method="post">
            <h3 >Digite o nome:</h3>
            <input type="text" name="nome" id="" placeholder="Gustavo"><br>
            <h3 >Digite sua senha:</h3>
            <input type="password" name="senha" id="" placeholder="exemplo123"><br>
            <h3 >Confirmar senha:</h3>
            <input type="password" name="" id=""><br>
            <h3 >Digite seu email:</h3>
            <input type="email" name="email" id="" placeholder="exemplo@gmail.com"><br>
            <h3 >Digite seu cpf:</h3>
            <input type="number" name="cpf" id="" placeholder="12345678910"><br>
            <h3 >Digite seu telefone:</h3>
            <input type="tel" name="telefone" id="" placeholder="6133034671"><br>
            <h3 >Digite seu celular:</h3>
            <input type="tel" name="celular" id=""><br>
            <h3 >Digite seu logradouro(endereço):</h3>
            <input type="text" name="logradouro" id="" placeholder="Rua exemplo"><br>
            <h3 >Digite o número da casa:</h3>
            <input type="number" name="num" id="" placeholder="13"><br>
            <h3>Complemento:</h3>
            <input type="text" name="comp" id="" placeholder="Perto de um portão amarelo"><br>
            <h3 >Bairro:</h3>
            <input type="text" name="bairro" id="" placeholder="Urbanova"><br>
            <h3 >Selecione seu estado:</h3>
            <select id="estado" name="estado">
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
                <option value="EX">Estrangeiro</option>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
    </main>
    
</body>
</html>