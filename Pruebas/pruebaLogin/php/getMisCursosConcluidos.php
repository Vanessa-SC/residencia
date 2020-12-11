<?php

/* Obtiene el historial de los cursos a los que ha pertenecido el docente */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if (!isset($_POST)) die();

/* Recepción de variables POST */
$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

/* Formato de idioma para las fechas */
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

/* Consulta SQL */
$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, 
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM usuario_has_curso Inner join curso 
        ON curso.idCurso = usuario_has_curso.Curso_idCurso 
        AND usuario_has_curso.estado = 0
        AND usuario_has_curso.Usuario_idUsuario = $id";

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

/* Imprimir respuesta en formato JSON */
echo json_encode($curso, true);