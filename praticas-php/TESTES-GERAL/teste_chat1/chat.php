<?php
include "banco.php";

$sql = $conn->query("SELECT * FROM chat1");
$dados = $sql->fetch_assoc();
while($dados){
    echo $x['nome'];
    echo "<p>".$x['msg']."</p>";
}
#n funciona

?>