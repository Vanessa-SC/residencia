<?php

/* Obtiene los datos de todos los usuarios que están inscritos a un curso */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if (!isset($_POST)) die();
/* Recepción de variables POST */
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

/* Consulta SQL */
$sql = "SELECT a.Usuario_idUsuario as idUsuario, 
        (concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.nombre)) as nombre
        FROM asistencia a, usuario u
        WHERE a.Curso_idCurso = $id 
        AND a.Usuario_idUsuario = u.idUsuario
        group by a.Usuario_idUsuario
        HAVING ROUND((SUM(CASE WHEN a.asistencia = '1' THEN 1 ELSE 0 END)/COUNT(*)*100),2) >= 80";

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

/* Imprimir respuesta */
echo json_encode($curso);