<?php

$var1 = 10; //int

$var2 = 10.5; //float

$var3 = "texto"; //caractere

$var4 = true; //boolean

$var5 = [1, 2, 3, 4]; //vetor

$var6 = null; //variável com valor nulo

//$pessoa = new Pessoa(); //objeto

$x = 10;
$y = 12;
$s = $x + $y;

$s = $s ** 2;

echo "$s"; #diferenças entre '' e "" no echo
echo '$s'.$s;
//------------------------------

$variavel = 10;
$variavel = 'virou string!!!';
//------------------------------

$x = (2 == 3); //false = null
$x = (20 == 20); //true = 1
$x = (5 == '5'); //true
$x = (5 === '5');//false
//-------------------------------------

$vetor[0] = 'teste';
$vetor[1] = 20;

$outrovetor = array('teste', 12, 30, 'mais');
//ou
$teste = [12, 'novo', 'a partir do php 5.4'];

echo $vetor[0];
echo $teste[2];
#não precisa seguir a sequência dos indices!!!
/*no caso de $teste
indice 0 = 12
indice 1 = 'novo' etc

é possível definir o índice de cada elemento
*/
$dados = [
    10 => 1000,
    20 => 1500,
    25 => 'teste',
    30 => 2000
];#para adicionar mais um valor
$dados[] = 4000; #$dados[31]

#alterar valor pode ser de duas formas!
$teste[0] = 20;
$teste[] = 4500;#no final do array vai ter 4500
array_push($teste, 5000);#no final do array vai ter 5000

$nome = 'Enzo Dante teste com nomes'
//as linhas abaixo é de string com php8
//por ser recente, pode aparecer como erro no vscode

//$verdade = str_contains($nome, 'Enzo'); #true
//$x = str_starts_with($nome, 'Enzo'); #true
//$x = str_starts_with($nome, 'enzo'); #false

//$x = str_ends_with($nome, 'nomes'); #true
//----------------------------------------

?>