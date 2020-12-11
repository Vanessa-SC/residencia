<?php

/* Obtiene los datos de la constancia de un usuario en un curso */

// conexion
include_once 'conexion.php';
if (!isset($_POST)) die();
$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

// formato de idioma para las fechas
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// consulta SQL
$sql = "SELECT curso.idCurso,
        curso.nombreCurso, 
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario,
        DATE_FORMAT(curso.fechaInicio, '%d de %M %Y') as fechaExpedicion,
        curso.duracion,
        constancia.folio, 
        usuario.nombreUsuario,
        concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro
        FROM usuario, curso, constancia, instructor
        WHERE constancia.Curso_idCurso = curso.idCurso
        AND constancia.Usuario_idUsuario = usuario.idUsuario
        AND curso.Instructor_idInstructor=instructor.idInstructor
        AND constancia.Usuario_idUsuario = $id
        ORDER BY fechaInicio ASC
        ";

// Validacion de ejecusion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// declaracion del array que contendrá los resultados de la consulta
$arr = array();

// si hay resultados...
if ($result->num_rows > 0) {

    // guardamos los resultados en el array
    while ($row = $result->fetch_assoc()) {
        $arr[]  = $row;
    }

}

// impresion del array de resultados
echo json_encode($arr,true);