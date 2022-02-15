<?php
#comentários para me ajudar msm :)
$bd_host = 'localhost'; 
$bd_user = 'root';
$bd_passw = '';
$bd_nome = 'bd_cadastrologin2'; #nome do banco de dados

#enviando esses dados para o banco de dados, uma ligação literalmente
$ligacao = new mysqli($bd_host, $bd_user, $bd_passw, $bd_nome);

#para manter o banco de dados mais seguro, é bom usar programação orientada a objetos!