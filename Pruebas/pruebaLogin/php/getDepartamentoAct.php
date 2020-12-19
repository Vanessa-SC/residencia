<?php 

/* Obtiene el departamento del usuario */

// Recibe datos POST?
if(!isset($_POST)) die();

// Conexión
include_once 'conexion.php';

// Asignación de variable
$id = mysqli_real_escape_string($conn,$_POST['idDepartamento']);

// SQL de consulta
$sql = "SELECT * FROM departamento WHERE idDepartamento = $id ";

// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Asociación de resultados en una variable
$departamento = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión de resultados
echo json_encode($departamento[0],true);