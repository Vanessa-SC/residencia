<?php

$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

$datos['curso'] = "Diplomado para la Formación de Tutores - Módulo II: Programa de Tutorías Semipresencial";
$datos['instructor'] = "Cristabel Armstrong Aramburo";

require('fpdf.php');

/* Creación del documento PDF */

// documento en 'landscape' (orientacion horizontal)
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\RECONOCIMIENTO.jpg', 3, 0, 210);
$pdf->Ln(43);

$pdf->AddFont('Montserrat','','montserrat.php');
$pdf->AddFont('Montserrati','I','montserrati.php');
$pdf->AddFont('Montserratb','B','montserratb.php');
$pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');
$pdf->SetFont('Montserrat-black','B',18);
/* Nombre del instructor */
$participante =  mb_convert_case($datos['instructor'], MB_CASE_UPPER, "UTF-8");
$pdf->Cell(200, 160, $participante, 0, 0, 'C');
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Ln(90);
$pdf->MultiCell(0, 5, utf8_decode(mb_strtoupper('por haber impartido el curso '.$datos['curso'],'utf-8')) , 0, 'C', false);
$pdf->SetFont('Montserrat-medium', '', 11);
$pdf->Ln(15);
$pdf->MultiCell(0, 0, utf8_decode(mb_strtoupper('Victoria de Durango, Dgo. a ' . $actual,'utf-8')), 0, 'C', false);

$pdf->Output('I');