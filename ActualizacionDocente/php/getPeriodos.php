<?php 

/* Obtiene el listado de los periodos registrados en los cursos */

/* Conexión a la BD */
include_once 'conexion.php';

/* Consulta SQL */
$sql = "SELECT DISTINCT(periodo) 
        FROM curso 
        ORDER BY periodo ASC;";

// Ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

/* Imprimir respuesta */
echo json_encode($arr);