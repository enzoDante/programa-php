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
        $codigo = substr(md5(date("YmdHis")), 1, 7);
        #gera um código alfa numerico de 7 caracteres
        echo $codigo;
    
    ?>
    <form action="teste.php" method="post">
        <input type="text" name="nome" id="" placeholder="Nome">
        <input type="email" name="email" id="" placeholder="Email">
        <button type="submit">Testar</button>
    </form>
</body>
</html>