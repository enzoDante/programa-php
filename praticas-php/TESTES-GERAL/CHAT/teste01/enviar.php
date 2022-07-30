<?php
    include "banco.php";
    $eu = $_POST['id_unico'];
    $amigo = $_POST['amigo'];
    $msg = $_POST['msg'];


    $stmt = $conn->prepare("INSERT INTO chat (enviar, recebido, msg) VALUES(?,?,?)");
    #$stmt->bind_param('sss', $_SESSION['id_unico'], $_GET['id'], $_POST['msg']);
    $stmt->bind_param('sss', $eu, $amigo, $msg);
    $stmt->execute();
    header("Location: chat.php?id=$amigo");


?>