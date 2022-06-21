<?php
    include "banco.php";

    #por meio do arquivo "olha_usus.php" tem o link 'excluir', q irá direcionar a este arquivo 
    $id = $_GET['id']; #recebe o valor q está no link excluir
    $preparar = $conn->prepare("DELETE FROM Cliente WHERE idCliente = ?;");
    $preparar->bind_param("i", $id);
    $preparar->execute();
    echo "será?";
    header("Location: olha_usus.php");



?>