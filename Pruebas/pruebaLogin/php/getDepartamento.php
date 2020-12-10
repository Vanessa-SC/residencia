<?php 

/* Obtiene el departamento del usuario */

// Recibe datos POST?
if(!isset($_POST)) die();

// conexion
include_once 'conexion.php';

// asignacion de variable
$id = mysqli_real_escape_string($conn,$_POST['departamento']);

// query de consulta
$sql = "SELECT * FROM departamento WHERE idDepartamento = $id ";

// validacion de ejecucion de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// asociacion de resultados en una variable
$departamento = mysqli_fetch_all($result, MYSQLI_ASSOC);

// impresion de resultados
echo json_encode($departamento[0],true);