<?php

/* Eliminación de un Departamento */

// Conexión
include_once 'conexion.php';
// Se recibe algo en POST?
if (!isset($_POST)) {
    die();
}
// Array de respuesta
$response = [];

// Asignación de dato a variable
$id = mysqli_real_escape_string($conn, $_POST['idDepartamento']);

// Query de eliminación
$query = "DELETE FROM departamento WHERE idDepartamento = '$id'";
// ¿Se ejecutó correctamente?
if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}

// Respuesta
echo json_encode($response);