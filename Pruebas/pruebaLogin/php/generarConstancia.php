<?php

/* genera una constancia para un usuario */

/* Import de la conexión y la librería para la creación 
   del documento PDF */
require '../FPDF/fpdf.php';
include_once 'conexion.php';

/* Recepción de datos */
$datos = json_decode(file_get_contents("php://input"));

/* Creación del documento PDF */
class PDF extends FPDF
{
    // Pie de página
    public function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Montserrat', '', 11);
        // Número de página
        $this->Cell(0, 10, $datos['folio'].'          '.$datos['ClaveRegistro'], 0, 0, 'C');
    }
}
// documento en 'landscape' (orientacion horizontal)
$pdf = new FPDF('P', 'mm', 'letter');
// Deshabilitar el salto de página automático
$pdf->SetAutoPageBreak(false);
// Agregar página
$pdf->AddPage();
// Background
$pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\CONSTANCIA.jpg', 0, 0, 220);
$pdf->Ln(50);
// Tipografía
$pdf->AddFont('Montserrat','','montserrat.php');
$pdf->AddFont('Montserrati','I','montserrati.php');
$pdf->AddFont('Montserratb','B','montserratb.php');
$pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');

$pdf->SetFont('Montserrat-black','B',18);

/* Nombre del participante */
$pdf->Cell(200, 160, strtoupper(utf8_decode($datos['participante'])), 0, 0, 'C');
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Ln(10);

$pdf->SetFont('Montserrati', 'I', 14);
$pdf->Cell(200, 160, utf8_decode(mb_strtoupper('por su valiosa participación en el curso:', 'utf-8')), 0, 0, 'C');
$pdf->Ln(90);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper($datos['curso'], 'utf-8')), 0, 'C', false);
$pdf->Ln(5);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('REALIZADO DEL ' . $datos['fechaInicio'].' al '.$datos['fechaFin'], 'UTF-8')), 0, 'C', false);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('CON UNA DURACIÓN DE ' . $datos['duracion'] . ' HORAS', 'UTF-8')), 0, 'C', false);
$pdf->SetFont('Montserrati', 'I', 11);
$pdf->Ln(10);
$pdf->MultiCell(0, 0, 'Victoria de Durango, Dgo. a ' . $datos['fechaFin'], 0, 'C', false);

// Nombre del PDF C_+ marca de tiempo + extension
$archivo = 'C_' . time() . '.pdf';

// Salida del archivo -> mostrar en el navegador para su visualizar o descargar
$pdf->Output("C:/xampp/htdocs/Residencia/Proyecto/files/" . $archivo, 'F');

/* Inserción del nombre del documento a la base de datos */
$sql = "INSERT INTO constancia
        VALUES('','$datos->folio-$datos->idUsuario','$archivo',$datos->idCurso,$datos->idUsuario)";

/* Ejecucuón del Query */
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error';
}

/* Respuesta */
echo json_encode($response, JSON_FORCE_OBJECT);
