<?php
//condições
$x = 10;
if($x <= 10){}#true
else{}

if($x > 11){

}elseif($x == 10){}#true
else{}

$nome = 'carlos';
//ou uma variável numérica

switch ($nome){
    case 'ana':
        //codigo
        break;
    case 'carlos':
        //codigo
        break;
    default:
        //codigo
        break;
}

//usar condição com html a melhor forma é
$valor = 5;
if($valor == 10):
    //codigo html
else:
    //codigo html 2
endif;

?>
<!--exemplo-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($valor == 5): ?>
        <form action="">
            <!--cadastro-->
        </form>
    <?php else: ?>
        <form action="">
            <!--login-->
        </form>
    <?php endif; ?>
</body>
</html>

<?php
$x = 0;
while($x < 10){
    echo "$x";
    $x++;
}
$x = 0;
do{
    //codigo
    $x++;
}while ($x < 10);

for($x = 0; $x < 10; $x++){
    //codigo
}


?>
