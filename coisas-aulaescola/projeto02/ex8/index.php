<?php
    include "classe.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../t.css">
</head>
<body>
    <header>
        <h1></h1>
    </header>
    <main>
        <form id="tamanho" action="index.php" method="post">
            <table id="tabela">
                <tr>
                    <td><strong>Nome do aluno</strong></td>
                    <td><strong>Nota do aluno</strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome0" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota0" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome1" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota1" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome2" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota2" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome3" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota3" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome4" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota4" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome5" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota5" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome6" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota6" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome7" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota7" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome8" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota8" id="" placeholder="Digite a nota:"></td>
                </tr>
                <tr>
                    <td><input type="text" name="nome9" id="" placeholder="Digite o nome do aluno:"></td>
                    <td><input type="number" name="nota9" id="" placeholder="Digite a nota:"></td>
                </tr>
            </table><br>
            <button type="submit">Adicionar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $calc = new tabela();
                $verificar = true;
                for($i = 0; $i <= 9; $i++){
                    $nome = $_POST["nome$i"];
                    $nota = $_POST["nota$i"];
                    if(empty($nome) || $nota < 0 || $nota > 10){
                        echo "<p>Digite os valores corretamente!</p>";
                        $verificar = false;
                        break;
                    }                
                    $calc->setvalores($nome, $nota);
                }
                if($verificar){
                    $melhor = $calc->calcular();
                    echo "<p>$melhor</p>"; 
                    $tab = $calc->gerartabela();
                    echo "$tab";                   
                }
            }
        ?>
    </main>

    
</body>
</html>