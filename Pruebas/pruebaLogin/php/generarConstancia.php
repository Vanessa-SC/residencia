<?php

require '../FPDF/fpdf.php';


$participante = "Vanessa Sifuentes Cisneros";
$curso = "AngularJS";
$fecha = "01 de noviembre al 15 de noviembre del 2020";
$duracion = "30";
$expedicion = "23 de noviembre del 2020";
$directora = "M.C. Isela Flores Montenegro";

class PDF extends FPDF
{
    public function Header()
    {
        $this->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\logosConstancia.png', 75, 10, 130);
    }
}

$pdf = new PDF('L', 'mm', 'letter');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\bg-constancia.jpg', 5, 5, 270);
$pdf->Ln(55);
$pdf->SetFont('Times', 'I', 26);
/* Nombre del participante */
$pdf->Cell(260, 75, $participante, 0, 0, 'C');
$pdf->Ln(20);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(260, 75, 'Por su valiosa participación como alumno en el curso', 0, 0, 'C');
$pdf->Ln(10);
/* Nombre del curso */
$pdf->SetFont('Times', 'I', 20);
$pdf->Cell(260, 75, '"'.$curso.'"', 0, 0, 'C');
$pdf->Ln(10);
/* Fecha del curso */
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(260, 75, 'Realizado del '.$fecha, 0, 0, 'C');
$pdf->Ln(10);
/* Duración */
$pdf->Cell(260, 75, 'Con una duración de '.$duracion.' horas', 0, 0, 'C');
$pdf->Ln(10);
/* Fecha de emisión */
$pdf->Cell(260, 75, 'Victoria de Durango, Dgo. a '.$expedicion, 0, 0, 'C');
$pdf->Ln(35);
/* Firma */
$pdf->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\firma.png', 88, 180, 100);
$pdf->Cell(260, 75, $directora, 0, 0, 'C');


/*
Cell(width, height, texto, borde(0,1), linea(0derecha,1comienzo,2sigLinea,
align(L,C,R), fillColor?(true,false))

Output([string nombre, string destino])
Destino:
'I' fichero al navegador con la opción de guardar como...,
'D' envía el documento al navegador preparado para la descarga,
'F' guarda el fichero en un archivo local,
'S' devuelve el documento como una cadena.
 */
$pdf->Output('constancia.pdf', 'I');
