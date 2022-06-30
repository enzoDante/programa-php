<?php
    date_default_timezone_set('America/Sao_Paulo');
    $x = $_POST['data'];
    $x1 = $_POST['hora'];

    $hoje = date("Y-m-d");
    $horas = date("H:i");

    echo $x . "<br><br>";
    echo $x1 . "<br><br>";
    echo $hoje. "<br><br>";
    echo $horas . "<br>";

    if($x < $hoje)
        echo "<br><br>escolha uma data válida!!!";
    else{
        if($x == $hoje){
            echo "<br><br>mesmo dia -- pode fazer consulta";
        }else{
            echo "<br><br>maior -- pode fazer consulta";
        }
            
    }
    if($x1 < $horas){
        echo '<br><br>Menor horas';
    }else{
        if($x1 == $horas)
            echo "<br><br>igual horas";
        else
            echo "<br><br>Maior horas -- pode fazer consulta";
    }




?>