<?php
    include "class_cliente.php";
    if(!isset($_POST['nome'])){
        die("preencha o campo nome!");
    }
    if(!isset($_POST['email'])){
        die("preencha o campo email!");
    }
    if(!isset($_POST['senha'])){
        die("preencha o campo senha!");
    }
    if(!isset($_POST['data'])){
        die("preencha o campo nascimento!");
    }
    if(!isset($_POST['salario'])){
        die("preencha o campo salario!");
    }

    $id = $_POST['id'];
    $nome = strip_tags(str_replace(",","-", $_POST['nome']));
    $email = strip_tags(str_replace(",","-", $_POST['email']));
    $senha = strip_tags(str_replace(",","-", $_POST['senha']));
    $data = strip_tags(str_replace(",","-", $_POST['data']));
    $salario = strip_tags(str_replace(",",".", $_POST['salario']));

    $cliente = new cliente();
    $cliente->setid($id);
    $cliente->setnome($nome);
    $cliente->setemail($email);
    $cliente->setsenha($senha);
    $cliente->setdata($data);
    $cliente->setsalario($salario);

    $cliente->atualizar();
    header("Location: alterar.php?id=$id");


?>