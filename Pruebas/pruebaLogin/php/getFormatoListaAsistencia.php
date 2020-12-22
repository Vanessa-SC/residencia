<?php

// Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

// Variable que se obtiene al momento de llamar al método
$idCurso = $_GET['idc'];

// Instancias de creación
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Nombre del nuevo archivo que se genera
$filename = "ITD-AD-FO-8 Formato de Lista de Asistencia.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

// Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantillaListaAsistencia.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Lista de Asistencia");


// Consultas de asistencia para lunes
$lunes = $conn->query("SELECT      
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
        IF(asistencia.asistencia = '1', DATE_FORMAT(asistencia.fecha,'%d/%m'), 'X') AS fecha 
        FROM asistencia 
        INNER JOIN usuario
        ON usuario.idUsuario = asistencia.Usuario_idUsuario
        WHERE asistencia.Curso_idCurso = $idCurso
        AND DAYOFWEEK(fecha) = 2
        AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY nombre
        ");

// Consultas de asistencia para martes
$martes = $conn->query("SELECT      
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
        IF(asistencia.asistencia = '1', DATE_FORMAT(asistencia.fecha,'%d/%m'), 'X') AS fecha 
        FROM asistencia 
        INNER JOIN usuario
        ON usuario.idUsuario = asistencia.Usuario_idUsuario
        WHERE asistencia.Curso_idCurso = $idCurso
        AND DAYOFWEEK(fecha) = 3
        AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY nombre
        ");

// Consultas de asistencia para miercoles
$miercoles = $conn->query("SELECT      
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
        IF(asistencia.asistencia = '1', DATE_FORMAT(asistencia.fecha,'%d/%m'), 'X') AS fecha 
        FROM asistencia 
        INNER JOIN usuario
        ON usuario.idUsuario = asistencia.Usuario_idUsuario
        WHERE asistencia.Curso_idCurso = $idCurso
        AND DAYOFWEEK(fecha) = 4
        AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY nombre
        ");

// Consultas de asistencia para jueves
$jueves = $conn->query("SELECT      
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
        IF(asistencia.asistencia = '1', DATE_FORMAT(asistencia.fecha,'%d/%m'), 'X') AS fecha 
        FROM asistencia 
        INNER JOIN usuario
        ON usuario.idUsuario = asistencia.Usuario_idUsuario
        WHERE asistencia.Curso_idCurso = $idCurso
        AND DAYOFWEEK(fecha) = 5
        AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY nombre
        ");

// Consultas de asistencia para viernes
$viernes = $conn->query("SELECT      
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
        IF(asistencia.asistencia = '1', DATE_FORMAT(asistencia.fecha,'%d/%m'), 'X') AS fecha 
        FROM asistencia 
        INNER JOIN usuario
        ON usuario.idUsuario = asistencia.Usuario_idUsuario
        WHERE asistencia.Curso_idCurso = $idCurso
        AND DAYOFWEEK(fecha) = 6
        AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY nombre
        ");

/* Obtener nombre del coordinador(a) de Actualizacion Docente */
$sqlGetCoord = $conn->query("SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Actualización Docente'");

/*
Consulta a la base de datos para buscar a los usuarios que tienen Función Administrativa e impesión de carácter X
si Función Administrativa es igual a SI
*/
$sql = $conn->query("SELECT
        IF(usuario.funcionAdministrativa = 'SI', 'X', usuario.funcionAdministrativa) AS FD
            FROM usuario_has_curso 
            INNER JOIN usuario        
            ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
            INNER JOIN departamento
            ON usuario.Departamento_idDepartamento = departamento.idDepartamento
            AND usuario_has_curso.Curso_idCurso = $idCurso
            INNER JOIN curso 
            ON curso.idCurso = usuario_has_curso.Curso_idCurso            
            INNER JOIN instructor 
            ON curso.Instructor_idInstructor=instructor.idInstructor
            WHERE usuario.rol = 3 
            AND activo = 'SI'
            AND funcionAdministrativa = 'SI'
        ");
/*
Consulta a la base de datos, la consulta maneja 5 tablas, usuario_has_curso, usuario, curso, departamento, instructor
dentro de la consulta se concatenan parámetros y se asignan formatos de fecha.
La consulta maneja distintas condiciones: condiciones entre IDs para relaciones entre tablas, 
además el usuario debe tener rol 3 es decir debe ser docente y debe estar activo
*/
$query = $conn->query("SELECT 
            usuario.idUsuario, departamento.nombreDepartamento AS nombreD, usuario.rol, usuario.RFC, 
            usuario.CURP, usuario.horas, usuario.nivel, usuario.perfilDeseable, 
            concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
            concat_ws(' ',instructor.nombre,instructor.apellidoPaterno,instructor.apellidomaterno) AS maestro, 
            instructor.RFC AS insRFC,
            instructor.CURP AS insCURP,
            curso.idCurso, 
            curso.Folio,
            curso.ClaveRegistro,
            curso.nombreCurso AS curso, 
            curso.objetivo, curso.Instructor_idInstructor,            
            curso.modalidad,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) AS fecha,
            concat_ws(' - ',curso.horaInicio,curso.horaFin) AS horario, 
            curso.lugar,
            curso.duracion,
            curso.periodo,
            curso.destinatarios, 
            curso.validado,
            curso.Departamento_idDepartamento AS departamento
            FROM usuario_has_curso 
            INNER JOIN usuario        
            ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
            INNER JOIN departamento
            ON usuario.Departamento_idDepartamento = departamento.idDepartamento
            AND usuario_has_curso.Curso_idCurso = $idCurso
            INNER JOIN curso 
            ON curso.idCurso = usuario_has_curso.Curso_idCurso            
            INNER JOIN instructor 
            ON curso.Instructor_idInstructor=instructor.idInstructor
            WHERE usuario.rol = 3 
            AND activo = 'SI'      
            ORDER BY nombre
        ");

/* Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir Coordinador */
if($sqlGetCoord->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sqlGetCoord->fetch_assoc()) {
        $activeSheet->setCellValue('D'.'42' , $row['Jefe']);
        $i++;
    }
}

// Asistencias e inasistencias
if($lunes->num_rows > 0) {
    $i = 22;
    while($row = $lunes->fetch_assoc()) {
        $activeSheet->setCellValue('G'.$i , $row['fecha']);
        $i++;
    }
}

if($martes->num_rows > 0) {
    $i = 22;
    while($row = $martes->fetch_assoc()) {
        $activeSheet->setCellValue('H'.$i , $row['fecha']);
        $i++;
    }
}

if($miercoles->num_rows > 0) {
    $i = 22;
    while($row = $miercoles->fetch_assoc()) {
        $activeSheet->setCellValue('I'.$i , $row['fecha']);
        $i++;
    }
}

if($jueves->num_rows > 0) {
    $i = 22;
    while($row = $jueves->fetch_assoc()) {
        $activeSheet->setCellValue('J'.$i , $row['fecha']);
        $i++;
    }
}

if($viernes->num_rows > 0) {
    $i = 22;
    while($row = $viernes->fetch_assoc()) {
        $activeSheet->setCellValue('K'.$i , $row['fecha']);
        $i++;
    }
}

/* Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir la Función Administrativa */
if($sql->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sql->fetch_assoc()) {
        $activeSheet->setCellValue('E'.$i , $row['FD']);
        $i++;
    }
}


/* Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir los participantes del curso */
if($query->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('B'.'13' , $row['curso']);
        $activeSheet->setCellValue('B'.'14' , $row['maestro']);
        $activeSheet->setCellValue('B'.'16' , $row['periodo']);
        $activeSheet->setCellValue('C'.'16' , 'Duración: '.$row['duracion']);
        $activeSheet->setCellValue('D'.'16' , 'Horario: '.$row['horario']);
        $activeSheet->setCellValue('E'.'8' , 'CLAVE: '.$row['Folio']);
        $activeSheet->setCellValue('E'.'13' , 'Folio: '.$row['ClaveRegistro']);
        $activeSheet->setCellValue('A'.'42' , $row['maestro']);
        $activeSheet->setCellValue('B'.'44' , $row['insRFC']);
        $activeSheet->setCellValue('B'.'45' , $row['insCURP']);
        $activeSheet->setCellValue('B'.$i , $row['nombre']);
        $activeSheet->setCellValue('C'.$i , $row['RFC']);
        $activeSheet->setCellValue('D'.$i , $row['nombreD']);
        $activeSheet->setCellValue('F'.$i , 'X');
        $i++;
    }
}

// Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");