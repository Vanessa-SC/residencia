<?php

/* Obtiene un listado de todas las constancias del periodo actual */

// Conexión
include_once 'conexion.php';

// Obtención de datos
$periodo = json_decode(file_get_contents("php://input"));

// Formato español para fechas
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Query de consulta
$sql = "SELECT constancia.folio,
            constancia.rutaConstancia,
            concat_ws(' ',apellidoPaterno,apellidomaterno,nombre) as nombre,
            usuario.nombreUsuario as docente,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha
        FROM usuario, curso, constancia
        WHERE constancia.Usuario_idUsuario=usuario.idUsuario
        AND constancia.Curso_idCurso=Curso.idCurso
        AND curso.periodo = '$periodo'";

// Validación de resultado de ejecución
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Array de resultados
$arr = array();

// Si hay resultados se guardan
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión del array de resultados
echo json_encode($arr,true);
