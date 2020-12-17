<?php

$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

$datos['curso'] = "Diplomado para la Formación de Tutores - Módulo II: Programa de Tutorías Semipresencial";
$datos['participante'] = "Perla Sifuentes Cisneros";

require('fpdf.php');

/* Creación del documento PDF */

// documento en 'landscape' (orientacion horizontal)
$pdf = new FPDF('P', 'mm', 'letter');
// Deshabilitar el salto de página automático
$pdf->SetAutoPageBreak(false);
// Agregar página
$pdf->AddPage();
// Background
$pdf->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\CONSTANCIA.jpg', 0, 0, 220);
$pdf->Ln(50);
// Tipografía
// $pdf->SetFont('Times', 'I', 26);

$pdf->AddFont('Montserrat','','montserrat.php');
$pdf->AddFont('Montserrati','I','montserrati.php');
$pdf->AddFont('Montserratb','B','montserratb.php');
$pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');
$pdf->SetFont('Montserrat-black','B',18);
/* Nombre del participante */
$participante =  mb_convert_case($datos['participante'], MB_CASE_UPPER, "UTF-8");
$pdf->Cell(200, 160, $participante, 0, 0, 'C');
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Ln(90);

$pdf->SetFont('Montserrati', 'I', 14);
$pdf->MultiCell(0, 5, utf8_decode(mb_strtoupper('por su valiosa participación "'.$datos['curso'],'utf-8')) , 0, 'C', false);
$pdf->SetFont('Montserrati', 'I', 11);
$pdf->Ln(10);
$pdf->MultiCell(0, 0, 'Victoria de Durango, Dgo. a ' . $actual, 0, 'C', false);



// // Nombre del PDF C_+ marca de tiempo + extension
// $archivo = 'C_' . time() . '.pdf';
// // Salida del archivo -> mostrar en el navegador para su visualizar o descargar
// $pdf->Output("C:/xampp/htdocs/Residencia/Proyecto/files/" . $archivo, 'F');

// /* Inserción del nombre del documento a la base de datos */
// $sql = "INSERT INTO constancia
//         VALUES('','$datos->folio','$archivo',$datos->idCurso,$datos->idUsuario)";

// /* Ejecucuón del Query */
// if (mysqli_query($conn, $sql)) {
//     $response['status'] = 'ok';
// } else {
//     $response['status'] = 'error';
// }

// /* Respuesta */
// echo json_encode($response, JSON_FORCE_OBJECT);


$pdf->Output('I');