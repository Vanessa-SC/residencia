<?php

// conexion y verificacion de recepcion de datos
include_once 'conexion.php';
if (!isset($_POST)) die();

// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Recepción del ID
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

// Query de consulta
$sql = "SELECT curso.idCurso, 
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, 
            curso.nombreCurso as curso, 
            curso.objetivo, 
            curso.modalidad,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
            curso.lugar,
            curso.duracion,
            curso.destinatarios, 
            curso.validado,
            departamento.nombreDepartamento,
            curso.Departamento_idDepartamento as departamento
        FROM instructor Inner join curso
        ON curso.Instructor_idInstructor=instructor.idInstructor
        AND curso.idCurso = $id ";

// Ejecución de consulta y asociacion de resultados
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

// impresion de resultados
echo json_encode($curso[0],true);
