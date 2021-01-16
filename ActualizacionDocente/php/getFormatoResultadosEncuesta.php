<?php

// Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

// Variable que se obtiene al momento de llamar al método
$idc = $_GET['idc'];
$ide = $_GET['ide'];

// Instancias de creación
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Nombre del nuevo archivo que se genera
$filename = "Resultados de encuesta del Curso.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

// Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantillaIndicadoresEncuesta.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Resultados");

// Consulta para extraer nombre del curso y de la encuesta
$sqlC = $conn->query("SELECT c.nombreCurso, e.nombreEncuesta
        FROM curso c, encuesta e
        WHERE c.idCurso = $idc
        AND e.idEncuesta = $ide
        ");

// Imprime resultados
if($sqlC->num_rows > 0) {
    while($row = $sqlC->fetch_assoc()) {
        $activeSheet->setCellValue('C'.'8', $row['nombreCurso']);
        $activeSheet->setCellValue('C'.'10', $row['nombreEncuesta']);
    }
}

// Consulta para extraer nombre del departemento
$sqlD = $conn->query("SELECT d.nombreDepartamento
        FROM departamento d
        INNER JOIN curso c
        ON c.Departamento_idDepartamento = d.idDepartamento
        WHERE c.idCurso = $idc
        ");

// Imprime resultados
if($sqlD->num_rows > 0) {
    while($row = $sqlD->fetch_assoc()) {
        $activeSheet->setCellValue('C'.'9', $row['nombreDepartamento']);
    }
}

// Consulta para extraer preguntas de la encuesta
$sqlP = $conn->query("SELECT ur.pregunta_idPregunta as idPregunta, p.descripcion
        FROM usuario_responde_encuesta ur 
        INNER JOIN pregunta p
        ON p.idPregunta = ur.pregunta_idPregunta
        Where ur.Encuesta_idEncuesta = $ide
        group by ur.pregunta_idPregunta
        ");

// Imprime resultados
if($sqlP->num_rows > 0) {
    $i = 13;
        while($row = $sqlP->fetch_assoc()) {
            $activeSheet->setCellValue('B'.$i , $row['descripcion']);
            $i++;
        }
}

// Consulta para sumar resultados y sacar promedio
$sql = $conn->query("SELECT ur.pregunta_idPregunta as idPregunta, 
        COUNT(CASE WHEN ur.respuesta = '5' THEN 1 END) AS totalR5,
        COUNT(CASE WHEN ur.respuesta = '4' THEN 1 END) AS totalR4,
        COUNT(CASE WHEN ur.respuesta = '3' THEN 1 END) AS totalR3,
        COUNT(CASE WHEN ur.respuesta = '2' THEN 1 END) AS totalR2,
        COUNT(CASE WHEN ur.respuesta = '1' THEN 1 END) AS totalR1,
        SUM(ur.respuesta) AS total,
        round(avg(ur.respuesta),1) AS resultado
        FROM usuario_responde_encuesta ur 
        Where ur.Curso_idCurso = $idc
        AND ur.Encuesta_idEncuesta = $ide
        group by ur.pregunta_idPregunta");

/*
Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir 
*/
if($sql->num_rows > 0) {
        // Comienza en la fila 22
        $i = 13;
        // Ciclo while que recorremo los resultados de la consulta y los imprime
        while($row = $sql->fetch_assoc()) {
            $activeSheet->setCellValue('C'.$i , $row['totalR5']);
            $activeSheet->setCellValue('D'.$i , $row['totalR4']);
            $activeSheet->setCellValue('E'.$i , $row['totalR3']);
            $activeSheet->setCellValue('F'.$i , $row['totalR2']);
            $activeSheet->setCellValue('G'.$i , $row['totalR1']);
            $activeSheet->setCellValue('I'.$i , $row['total']);
            $activeSheet->setCellValue('J'.$i , $row['resultado']);
            $i++;

            // Totales
            $activeSheet->setCellValue('C33','=SUM(C13:C32)');
            $activeSheet->setCellValue('D33','=SUM(D13:D32)');
            $activeSheet->setCellValue('E33','=SUM(E13:E32)');
            $activeSheet->setCellValue('F33','=SUM(F13:F32)');
            $activeSheet->setCellValue('G33','=SUM(G13:G32)');
        }
    }
    
// Creación de nueva hoja
$hoja = $documento->createSheet();
$hoja->setTitle("Participantes");

// Valores por defecto
$hoja->setCellValue('A1', 'Nombre del participante')->getColumnDimension('A')->setWidth(30);
$hoja->setCellValue('B1', 'Pregunta')->getColumnDimension('B')->setWidth(60);
$hoja->setCellValue('C1', 'Respuesta');

$query = $conn->query("SELECT p.descripcion,
concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.nombre) AS nombre,
ur.pregunta_idPregunta as idPregunta, ur.respuesta
FROM usuario_responde_encuesta ur 
INNER JOIN usuario u
ON u.idUsuario = ur.Usuario_idUsuario
INNER JOIN pregunta p
ON p.idPregunta = ur.pregunta_idPregunta
Where ur.Curso_idCurso = $idc
AND ur.Encuesta_idEncuesta = $ide
group by nombre, ur.pregunta_idPregunta");

/*
Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir 
*/
if($query->num_rows > 0) {
        // Comienza en la fila 22
        $i = '2'; 
        // Ciclo while que recorremo los resultados de la consulta y los imprime
        while($row = $query->fetch_assoc()) {
            $hoja->setCellValue('A'.$i , $row['nombre']);
            $hoja->setCellValue('B'.$i , $row['descripcion']);
            $hoja->setCellValue('C'.$i , $row['respuesta']);
            $i++;

        }
}

// Creación de nueva hoja
$hoja1 = $documento->createSheet();
$hoja1->setTitle("Comentarios");

// Valores por defecto
$hoja1->setCellValue('A1', 'Nombre del participante')->getColumnDimension('A')->setWidth(30);
$hoja1->setCellValue('B1', 'Comentario')->getColumnDimension('B')->setWidth(60);

$query = $conn->query("SELECT s.comentario,
concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.nombre) AS nombre
FROM usuario_responde_encuesta ur 
INNER JOIN usuario u
ON u.idUsuario = ur.Usuario_idUsuario
INNER JOIN sugerencia s
ON s.Encuesta_idEncuesta = ur.Encuesta_idEncuesta
Where ur.Curso_idCurso = $idc
AND ur.Encuesta_idEncuesta = $ide
group by nombre, s.comentario");

/*
Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir los Cursos y los Departamentos de los Comentarios
*/
if($query->num_rows > 0) {
        // Comienza en la fila 22
        $i = '2'; 
        // Ciclo while que recorremo los resultados de la consulta y los imprime
        while($row = $query->fetch_assoc()) {
            $hoja1->setCellValue('A'.$i , $row['nombre']);
            $hoja1->setCellValue('B'.$i , $row['comentario']);
            $i++;

        }
}

// Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");
