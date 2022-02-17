<?php

#nn sei como conectar ao arquivo sql :(

$bd_host = 'localhost';
$bd_user = 'root';
$bd_passw = '';
$bd_nome = 'vamosver';

$ligacao = new mysqli($bd_host, $bd_user, $bd_passw, $bd_nome);

?>