<?php

//Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

//Nombre del nuevo archivo que se genera
// Template processor instance creation
$template_word = '../XLSX/plantillaProgramaInstitucional.docx';
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_word);

//Obtiene el periodo actual
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

//Se imprime el periodo
$templateProcessor->setValue('periodo', $periodo);

/*
Consulta a la base de datos, para obtener la información del curso
*/
$query = "SELECT count(*) idCurso FROM curso   
        ";
$resql = mysqli_query($conn,$query);
$data = mysqli_fetch_array($resql);
$NumeroLineas = $data['idCurso']; // número de líneaas de factura
$templateProcessor->cloneRow('curso', $NumeroLineas);

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
        ";

$res = mysqli_query($conn,$query);

$countLines=0;
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

// -------------------- v pie para salvar el nuevo documento Word ------------------
$temp_file = tempnam(sys_get_temp_dir(), 'Word');
$templateProcessor->saveAS($temp_file);
// ------------------ Operation with file result -------------------------------------------
$documento = file_get_contents($temp_file);
unlink($temp_file);  // delete file tmp
header("Content-Disposition: attachment; filename= ITD-AD-PO-4-2 Programa Institucional de Formación y Actualización Docente.docx");
header('Content-Type: application/word');
echo $documento;