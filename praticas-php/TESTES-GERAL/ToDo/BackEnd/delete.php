<?php
    include "banco.php";

    $valor = $_REQUEST['id'];
    $stmt = $con->prepare("DELETE FROM todo WHERE id=?");
    $stmt->bind_param("i", $valor);
    if($stmt->execute()){
        echo true;
    }else
        echo false;

?>