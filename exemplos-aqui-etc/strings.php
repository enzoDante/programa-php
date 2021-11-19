<?php

$a = 'João' . ' ' . 'Ribeiro';
//o ponto liga as strings!!!

$b = 'João';
$b .= ' ' . 'Ribeiro'; 
#faz concatenação com o valor já existente

echo $b;
//------------------------------------------------

$nome = 'Enzo Dante';
$sobrenome = 'Mícoli';
#$nome_completo = $nome.' '.$sobrenome;
//ou
$nome_completo = "$nome $sobrenome";
echo $nome_completo;

//die();
//ao encontrar este comando
//automaticamente o programa para!!
//e não será executado os codigos abaixo!!!!
//-----------------------------------------------
echo '<br><br>';
echo '<p>Parágrafo HTML</p>';
echo '<br>';
#quero usar '' ou "" para mostrar ao usuario

echo 'normal \'texto entre aspas simplse\' normal';
echo "<br>normal \"texto entre aspas duplas\" normal";

echo '<br>não pula linha \n\r teste';
echo "pula linha \n\r teste"; #não funciona em browser!!!
//-----------------------------------------------------------
#Funções para operar com strings:

