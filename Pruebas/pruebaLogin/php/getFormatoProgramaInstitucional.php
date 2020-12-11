<?php

// Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

// Nombre del nuevo archivo que se genera
$template_word = '../XLSX/plantillaProgramaInstitucional.docx';
// Instancias de creación
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_word);

// Obtiene el periodo actual
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

// Se imprime el periodo
$templateProcessor->setValue('periodo', $periodo);

// Obtiene el periodo actual para la consulta
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response = 'Enero / Junio ';
} else {
    $response = 'Agosto / Diciembre ';
}

// Consulta a la base de datos, para obtener el número de cursos del periodo actual
$query = "SELECT count(*) idCurso 
            FROM curso  
            WHERE periodo 
            LIKE '$response%'
            AND YEAR(curso.fechaInicio) = $año
        ";
$resql = mysqli_query($conn,$query);
$data = mysqli_fetch_array($resql);
$NumeroLineas = $data['idCurso']; // Número de cursos
$templateProcessor->cloneRow('curso', $NumeroLineas);

// Consulta a la base de datos, para obtener datos de todos los cursos del periodo actual
$query = "SELECT  
            curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d/%m/%Y'), DATE_FORMAT(curso.fechaFin, '%d/%m/%Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.lugar,
            curso.duracion,
            curso.destinatarios,
            curso.observaciones,
            curso.validado
            FROM instructor Inner join curso
            ON curso.Instructor_idInstructor=instructor.idInstructor      
            WHERE periodo LIKE '$response%'
            AND YEAR(curso.fechaInicio) = $año
        ";

$res = mysqli_query($conn,$query);

// El recorrido comienza en cero
$countLines=0;

//Ciclo while que recorremo los resultados de la consulta y los imprime
while ($row = mysqli_fetch_array($res)){
		$countLines=$countLines+1;
        $templateProcessor->setValue('no#'.$countLines, $countLines);
        $templateProcessor->setValue('curso#'.$countLines, $row['curso']);
        $templateProcessor->setValue('objetivo#'.$countLines, $row['objetivo']);
        $templateProcessor->setValue('fecha#'.$countLines, $row['fecha']);
        $templateProcessor->setValue('lugar#'.$countLines, $row['lugar']);
        $templateProcessor->setValue('duracion#'.$countLines, $row['duracion']);
        $templateProcessor->setValue('maestro#'.$countLines, $row['maestro']);
        $templateProcessor->setValue('destinatarios#'.$countLines, $row['destinatarios']);
        $templateProcessor->setValue('observaciones#'.$countLines, $row['observaciones']);
    }

// Guarda el nuevo documento Word
$temp_file = tempnam(sys_get_temp_dir(), 'Word');
$templateProcessor->saveAS($temp_file);
// Operaciones con el archivo resultante
$documento = file_get_contents($temp_file);
unlink($temp_file);  // Borra archivo temporal
// Renombra nuevo documento
header("Content-Disposition: attachment; filename= ITD-AD-PO-4-2 Programa Institucional de Formación y Actualización Docente.docx");
header('Content-Type: application/word');
// Crea documento
echo $documento;