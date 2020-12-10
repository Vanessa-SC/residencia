<?php

/* Obtiene los datos del curso para rellenar el formulario de actualizacion de datos del curso */

// conexion
include_once 'conexion.php';
// Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// asignacion de variables
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);
// Query de consulta
$sql = "SELECT curso.idCurso, 
            curso.Folio, 
            curso.ClaveRegistro, 
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, 
            curso.nombreCurso as curso, 
            curso.periodo, 
            curso.duracion, 
            curso.horaInicio, 
            curso.horaFin, 
            curso.fechaInicio, 
            curso.fechaFin, 
            curso.modalidad, 
            curso.lugar, 
            curso.destinatarios,
            curso.objetivo, 
            curso.observaciones,
            curso.Instructor_idInstructor as instructor,
            curso.Departamento_idDepartamento as departamento
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor
    AND curso.idCurso = $id ";
// validacion de ejecucion de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// asociacion de resultados en una variable
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
// imprimir resultados
echo json_encode($curso[0],true);
