<?php
include('');
$stmt = $con->prepare("INSERT INTO tablea (col1, col2, col3) VALUES (?,)");
$stmt->bind_param("s", );
$stmt->execute();

$stmt = $con->prepare("SELECT * FROM tableA, tableB WHERE id_a = id_b OR nome = sobrenome");
$stmt->bind_param("s", );
$stmt->execute();
$resultado = $stmt->get_result();
while($linha = $resultado->fetch_object()){
	
}

$stmt = $con->prepare("DELETE FROM tableb WHERE id_b=?");
$stmt->bind_param("s", );
$stmt->execute();

$stmt = $con->prepare("UPDATE tablea SET col1=?, col2=? WHERE id_a=?");
$stmt->bind_param("s", );
$stmt->execute();

$stmt = $con->prepare("SELECT col1, col2 FROM tableA RIGHT JOIN tableB ON id_a=?");
$stmt->bind_param("s", );
$stmt->execute();
$resultado = $stmt->get_result();
while($linha = $resultado->fetch_object()){
	
}

