<?php

/* genera una constancia para un usuario */

/* Import de la conexión y la librería para la creación 
   del documento PDF */
require '../FPDF/fpdf.php';
include_once 'conexion.php';

/* Recepción de datos */
$datos = json_decode(file_get_contents("php://input"));

/* Obtener fecha actual en español */
$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

/* Asignar rol */
if ($datos->rol == 3) {
    $rol = 'alumno';
}
if ($datos->rol == 4) {
    $rol = 'instructor';
}

/* Creación del documento PDF */
class PDF extends FPDF
{
    // Encabezado del documento
    public function Header()
    {
        $this->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\logosConstancia.png', 75, 10, 130);
    }

    // Pie de página del documento
    public function Footer()
    {
        /* Firma */
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'B', 12);
        $this->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\firma.png', 88, 185, 100);
        $this->Cell(260, 0, "M.C. Isela Flores Montenegro", 0, 0, 'C');
    }
}

// Creación del documento en 'landscape' (orientacion horizontal)
$pdf = new PDF('L', 'mm', 'letter');
// Deshabilitar el salto de página automático
$pdf->SetAutoPageBreak(false);
// Agregar página
$pdf->AddPage();
// Background
$pdf->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\bg-constancia.jpg', 5, 5, 270);
$pdf->Ln(50);
// Tipografía
$pdf->SetFont('Times', 'I', 26);
/* Nombre del participante */
$pdf->Cell(260, 75, utf8_decode( $datos->participante), 0, 0, 'C');
$pdf->Ln(20);
$pdf->SetFont('Helvetica', '', 12);
/* Rol del participante (alumno o instructor) */
$pdf->Cell(260, 75, utf8_decode('Por su valiosa participación como ' . $rol . ' en el curso'), 0, 0, 'C');
$pdf->Ln(50);
/* Nombre del curso */
$pdf->SetFont('Times', 'I', 20);
$pdf->MultiCell(0, 8, '"' . utf8_decode($datos->curso) . '"', 0, 'C', false);
/* Fecha del curso */
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(260, 25, 'Realizado del ' . $datos->fecha, 0, 0, 'C');
$pdf->Ln(10);
/* Duración */
$pdf->Cell(260, 25, utf8_decode('Con una duración de ' . $datos->duracion . ' horas'), 0, 0, 'C');
$pdf->Ln(10);
/* Fecha de emisión */
$pdf->Cell(260, 25, 'Victoria de Durango, Dgo. a ' . $actual, 0, 0, 'C');

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

// Nombre del PDF C_+ marca de tiempo + extension
$archivo = 'C_' . time() . '.pdf';
// Salida del archivo -> mostrar en el navegador para su visualizar o descargar
$pdf->Output("C:/xampp/htdocs/Residencia/Proyecto/files/" . $archivo, 'F');

/* Inserción del nombre del documento a la base de datos */
$sql = "INSERT INTO constancia
        VALUES('','$datos->folio','$archivo',$datos->idCurso,$datos->idUsuario)";

/* Ejecucuón del Query */
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error';
}

/* Respuesta */
echo json_encode($response, JSON_FORCE_OBJECT);
