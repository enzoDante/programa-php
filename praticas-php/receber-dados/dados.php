<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$rsenha = $_POST['rsenha'];

#se mudar para $_POST[''] deverá mudar no method do html!!!
#ao usar o $_POST, não é possível ver oq foi digitado na URL!!!

echo "O nome digitado foi: $nome";
echo "email digitado: $email";
echo "senha digitada: $senha";
echo "rsenha digitada: $rsenha";