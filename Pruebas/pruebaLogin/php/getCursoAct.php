<?php

/* Obtiene los datos del curso para rellenar el formulario de actualizacion de datos del curso */

// Conexión
include_once 'conexion.php';
// ¿Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// Asignación de variables
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
// Validación de Ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Asociación de resultados en una variable
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Imprimir resultados
echo json_encode($curso[0],true);
