<?php

include_once 'conexion.php';

$sql            = "SELECT curso.nombreCurso, 
                    concat_ws(' al ',curso.fechaInicio,curso.fechaFin) as fecha,
                    curso.fechaFin,
                    curso.horario,
                    curso.duracion,constancia.folio, 
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