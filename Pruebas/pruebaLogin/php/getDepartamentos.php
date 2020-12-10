<?php 

/* Obtiene el listado de departamentos ordenados alfabéticamente */

//conexion
include_once 'conexion.php';

//query de consulta
$sql = "SELECT * FROM departamento ORDER BY nombreDepartamento ASC ";

// validacion de ejecucion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// almacenamiento de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// impresion de resultados
echo json_encode($arr,true);