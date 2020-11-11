<?php

include_once 'conexion.php';

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql            = "SELECT curso.nombreCurso, 
                    concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
                    concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario,
                    DATE_FORMAT(curso.fechaInicio, '%d de %M %Y') as fechaExpedicion,
                    curso.duracion,
                    constancia.folio, 
                    usuario.nombreUsuario
                    FROM usuario, curso, constancia
                    WHERE constancia.Curso_idCurso = curso.idCurso
                    AND constancia.Usuario_idUsuario = usuario.idUsuario";

$result         = $conn->query($sql) or die($conn->error . __LINE__);

$arr            = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[]  = $row;
    }
}

echo json_encode($arr);