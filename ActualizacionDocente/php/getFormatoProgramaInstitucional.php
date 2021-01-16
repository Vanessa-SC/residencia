<?php

// Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

// LLamado a la plantilla
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

// Obtiene la fecha del día
setlocale(LC_TIME, 'es_MX');
// Establece la zona horaria
date_default_timezone_set("America/Mexico_City");
/* Fecha actual en español */
$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

// Imprime la fecha
$templateProcessor->setValue('fecha', $actual); 

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

/* Obtener nombre del jefe(a) de Desarrollo Académico */
$sqlGetDes = "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Desarrollo Académico'";
$res = mysqli_query($conn,$sqlGetDes);
$des = mysqli_fetch_array ($res);

/* Imprime el nombre del jefe(a) de Desarrollo Académico */
$templateProcessor->setValue('nombreDes', $des['Jefe']); 

/* Obtener nombre del jefe(a) de Subdirección Académica */
$sqlGetSub = "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Subdirección Académica'";
$resS = mysqli_query($conn,$sqlGetSub);
$sub = mysqli_fetch_array ($resS);

/* Imprime el nombre del jefe(a) de Desarrollo Académico */
$templateProcessor->setValue('nombreSub', $sub['Jefe']); 

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
            WHERE curso.periodo LIKE '$response%'
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
        $templateProcessor->setValue('fechaP#'.$countLines, $row['fecha']);
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