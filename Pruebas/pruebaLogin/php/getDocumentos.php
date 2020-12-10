<?php 

/* Obtiene el listado de los documentos que deben subirse al curso */

// conexion
include_once 'conexion.php';

// query 
$sql = "SELECT * FROM documento ";

// ejecucion
$result = $conn->query($sql) or die($conn->error . __LINE__);

// asociacion de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// impresion de resultados
echo json_encode($arr);
