<?php

include_once 'conexion.php';

$periodo = json_decode(file_get_contents("php://input"));

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT constancia.folio,
           usuario.nombreUsuario as docente,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha
    FROM usuario, curso, constancia
    WHERE constancia.Usuario_idUsuario=usuario.idUsuario
    AND constancia.Curso_idCurso=Curso.idCurso
    
    AND curso.periodo = '$periodo'";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);
