<?php
    include "class_cliente.php";
    if(!isset($_POST['id'])){
        print("informe um id!!!");
        exit;
    }
    $id = strip_tags($_POST['id']);
    $cliente = new cliente();
    $cliente->olhaum($id);

    $tabela="<table border='1'>";
    $tabela.="<tr>";
    $tabela.="<td>".$cliente->getNome()."</td>";
    $tabela.="<td>".$cliente->getEmail()."</td>";
    $tabela.="<td>".$cliente->getSenha()."</td>";
    $tabela.="<td>".$cliente->getdata()."</td>";
    $tabela.="<td>".$cliente->getSalario()."</td>";
    $tabela.="</tr>";
    $tabela.="</table>";
    echo $tabela;
    echo '<a href="olha_um.html">voltar</a>';



?>