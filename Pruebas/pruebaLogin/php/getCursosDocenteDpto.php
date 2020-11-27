<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idDepartamento']);

/* Obtener nombre del departamento */
$sqlGetDpto= "SELECT idDepartamento
                FROM departamento
                WHERE nombreDepartamento='Todos los Departamentos'";

$res = mysqli_query($conn, $sqlGetDpto);
$dpto= mysqli_fetch_row ($res);

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado
    FROM instructor 
    Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor     
    AND curso.Departamento_idDepartamento = '$id' 
    UNION 
    SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado
    FROM instructor 
    Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor     
    AND curso.Departamento_idDepartamento = '$dpto[0]' 
    ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);
