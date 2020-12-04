<?php 

if(!isset($_POST)) die();

include_once 'conexion.php';

$id = mysqli_real_escape_string($conn,$_POST['departamento']);


$sql = "SELECT * FROM departamento WHERE idDepartamento = $id ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$departamento = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($departamento[0]);