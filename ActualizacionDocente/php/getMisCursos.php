<?php

/* Obtiene los cursos a los que está actualmente inscrito el docente */

// Conexión
include_once 'conexion.php';

// Recoge el ID del usuario 
if (!isset($_POST)) die();
$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

// Formato de idioma para las fechas
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Obtiene el periodo actual
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

// Consulta SQL
$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, 
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado, curso.periodo
        FROM usuario_has_curso Inner join curso 
        ON curso.idCurso = usuario_has_curso.Curso_idCurso
        WHERE curso.periodo LIKE '$periodo%'
        AND YEAR(curso.fechaInicio) = $año 
        AND usuario_has_curso.estado = 1
        AND usuario_has_curso.Usuario_idUsuario = $id
        ORDER BY fechaInicio ASC
        ";

// Ejecución de la consulta y asociación de resultados en una variable
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión del array de resultados
echo json_encode($curso);