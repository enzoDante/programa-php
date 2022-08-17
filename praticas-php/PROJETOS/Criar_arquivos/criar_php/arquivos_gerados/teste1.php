<?php
include('');
$stmt = $con->prepare("SELECT col1, col2 FROM tablea, tableB WHERE id_a = id_b OR nome = sobrenome;
$stmt->bind_param("s", );
$stmt->execute();
$resultado = $stmt->get_result();
while($linha = $resultado->fetch_object()){
	
}

$stmt = $con->prepare("DELETE FROM tableb WHERE id_b=?;
$stmt->bind_param("s", );
$stmt->execute();

