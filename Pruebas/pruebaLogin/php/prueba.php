<?php

include_once 'conexion.php';

//Toma último ID
$consu = $conn->query("SELECT * FROM curso ORDER BY idCurso DESC");
$total = mysqli_num_rows($consu);
$rowid = $consu->fetch_assoc();
$dpto = "Sistemas"; 
 
$año = date('y');
$codigo = sprintf("%04d", $rowid['idCurso']);//asignación de ceros al id

$codigo = $codigo + 1;
$cod_final = $codigo."-".$año."-".$dpto;//Formato último ID + Año + Depto

echo $cod_final;

?>