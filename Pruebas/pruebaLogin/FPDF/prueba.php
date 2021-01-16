<?php

require 'fpdf.php';

$datos = ["folio" => "TecNM-2020", "ClaveRegistro" => "00001-20-Sistemas y computación", "fechaFin" => "20 de noviembre del 2020", "fechaInicio" => "02 de noviembre", "participante" => "Sifuentes Cisneros Perla", "idUsuario" => "6", "curso" => "Diplomado para la Formación y Desarrollo de Competencias Docentes - Módulo II: Planeación del Proceso de aprendizaje", "idCurso" => "1", "duracion" => "30"];


class PDF extends FPDF
{
    
    // Pie de página
    public function Footer()
    {
       global $datos;
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Montserrat', '', 11);
        // Número de página
        $this->Cell(0, 10, $datos['folio'] . '          ' . utf8_decode(mb_strtoupper($datos['ClaveRegistro'],'utf-8')), 0, 0, 'C');
    }
}
// documento en 'landscape' (orientacion horizontal)
$pdf = new PDF('P', 'mm', 'letter');
// Deshabilitar el salto de página automático
$pdf->SetAutoPageBreak(false);
// Agregar página
$pdf->AddPage();
// Background
$pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\RECONOCIMIENTO.jpg', 0, 0, 220);
$pdf->Ln(50);
// Tipografía
$pdf->AddFont('Montserrat', '', 'montserrat.php');
$pdf->AddFont('Montserrati', 'I', 'montserrati.php');
$pdf->AddFont('Montserratb', 'B', 'montserratb.php');
$pdf->AddFont('Montserrat-black', 'B', 'Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium', '', 'Montserrat-Medium.php');

$pdf->SetFont('Montserrat-black', 'B', 18);

/* Nombre del participante */
$pdf->Cell(200, 160, strtoupper(utf8_decode($datos['participante'])), 0, 0, 'C');
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Ln(10);

$pdf->Cell(200, 160, utf8_decode(mb_strtoupper('por haber impartido el curso:', 'utf-8')), 0, 0, 'C');
$pdf->Ln(90);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper($datos['curso'], 'utf-8')), 0, 'C', false);
$pdf->Ln(5);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('REALIZADO DEL ' . $datos['fechaInicio'].' al '.$datos['fechaFin'], 'UTF-8')), 0, 'C', false);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('CON UNA DURACIÓN DE ' . $datos['duracion'] . ' HORAS', 'UTF-8')), 0, 'C', false);
$pdf->SetFont('Montserrat-medium', '', 11);
$pdf->Ln(10);
$pdf->MultiCell(0, 0, strtoupper('Victoria de Durango, Dgo. a ' . $datos['fechaFin']), 0, 'C', false);

// Nombre del PDF C_+ marca de tiempo + extension
$archivo = 'C_' . time() . '.pdf';
// Salida del archivo -> mostrar en el navegador para su visualizar o descargar
$pdf->Output("C:/xampp/htdocs/Residencia/Proyecto/files/" . $archivo, 'I');
