<?php 

/* Obtiene el listado de los documentos que deben subirse al curso */

// Conexión
include_once 'conexion.php';

// Query 
$sql = "SELECT * FROM documento ";

// Ejecución
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Asociación de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr);
