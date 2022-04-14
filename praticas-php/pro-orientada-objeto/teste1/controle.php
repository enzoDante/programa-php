<?php 
    include "pessoa.php";

    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $n1 = $_POST['nota1'];
    $n2 = $_POST['nota2'];
    $li = $_POST['lista'];
    $prof = $_POST['profisao'];


    $valores = new usuario();

    $valores->atribuirnome($nome);
    $valores->atribuiridade($idade);
    $valores->atribuirnota($n1);
    $valores->atribuirnota2($n2);
    $valores->atribuirprofisao($prof);
    $valores->atribuirlista($li);

    $valores->calcular();
    //=================atribuição p mostrar ao usuario
    $n = $valores->retornarnome();
    $i = $valores->retornaridade();
    $prof = $valores->retornarprofisao();
    $n1 = $valores->retornarnota();
    $n2 = $valores->retornarnota2();
    $lista = $valores->retornarlista();
    $media = $valores->retornarmedia();

    echo "$n<br>";
    echo "$i<br>";
    echo "$prof<br>";
    echo "<br>$n1";
    echo "<br>$n2<br>";
    echo "$lista<br>";
    echo "<br>$media<br>";

?>