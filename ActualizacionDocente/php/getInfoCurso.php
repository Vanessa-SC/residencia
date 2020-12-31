<?php

/* Obtiene la información de un curso */

// Conexión
include_once 'conexion.php';

// Validar que se estén recibiendo datos
if (!isset($_POST)) {
    die();
}

// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Recepcion del ID
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

// SQL de consulta de datos del curso
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
            curso.contenido,
            curso.criterios,
            curso.fuentes,
            departamento.nombreDepartamento,
            curso.Departamento_idDepartamento as departamento
        FROM instructor 
        INNER JOIN curso
        ON curso.Instructor_idInstructor=instructor.idInstructor
        INNER JOIN departamento
        ON curso.Departamento_idDepartamento = departamento.idDepartamento
        AND curso.idCurso = $id ";

// Ejecución de la consulta y asociación de resultados en una variable
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Impresión de resultados
echo json_encode($curso[0],true);
