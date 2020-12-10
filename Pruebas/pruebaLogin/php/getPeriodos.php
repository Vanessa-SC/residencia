<?php 

/* Obtiene el listado de los periodos registrados en los cursos */

include_once 'conexion.php';

$sql = "SELECT DISTINCT(periodo) 
        FROM curso 
        ORDER BY periodo ASC;";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);