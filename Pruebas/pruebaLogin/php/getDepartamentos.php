<?php 

/* Obtiene el listado de departamentos ordenados alfabéticamente */

// Conexión
include_once 'conexion.php';

// Query de consulta
$sql = "SELECT * FROM departamento ORDER BY nombreDepartamento ASC ";

// Validación de ejecución de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Almacenamiento de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr,true);