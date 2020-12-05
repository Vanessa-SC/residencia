<?php

//Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

//Variable que se obtiene al momento de llamar al método
$idCurso = $_GET['idc'];

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//Nombre del nuevo archivo que se genera
$filename = "ITD-AD-FO-8 Formato de Lista de Asistencia.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

//Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantilla.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Lista de Asistencia");

/*
Consulta a la base de datos, la consulta maneja 5 tablas, usuario_has_curso, usuario, curso, departamento, instructor
dentro de la consulta se concatenan parámetros y se asignan formatos de fecha.
La consulta maneja distintas condiciones: condiciones entre IDs para relaciones entre tablas, 
además el usuario debe tener rol 3 es decir debe ser docente y debe estar activo
*/

$query = $conn->query("SELECT 
            usuario.idUsuario, departamento.nombreDepartamento AS nombreD, usuario.rol, usuario.RFC, 
            usuario.CURP, usuario.horas, usuario.nivel, usuario.perfilDeseable, usuario.funcionAdministrativa AS FD, 
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
        ");

// Si se obtiene el número de filas del resultado, entonces comienza el recorrido
if($query->num_rows > 0) {
    //Comienza en la fila 22
    $i = 22;
    //Ciclo while que recorremo los resultados de la consulta y los imprime
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
        $activeSheet->setCellValue('E'.$i , $row['FD']);
        $activeSheet->setCellValue('F'.$i , 'X');
        $i++;
    }
}

//Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");