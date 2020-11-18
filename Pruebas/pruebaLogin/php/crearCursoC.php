<?php

$curso = json_decode(file_get_contents("php://input"));

include_once 'conexion.php';

/* Conversión de los formatos de fecha y hora, año */
$horaInicio = date('h:i', strtotime($curso->horaInicio));
$horaFin = date('h:i', strtotime($curso->horaFin));
$año = date('Y', strtotime($curso->fechaInicio));

setlocale(LC_TIME, 'es_MX');

$fechaInicio = strftime('%Y-%m-%d', strtotime($curso->fechaInicio));
$fechaFin = strftime('%Y-%m-%d', strtotime($curso->fechaFin));

/* fecha del curso para el oficio de registro */
$inicio = strftime('%d de %B', strtotime($curso->fechaInicio));
$fin = strftime('%d de %B, %Y', strtotime($curso->fechaFin));
$fechaCurso = $inicio . ' al ' . $fin;

/* Fecha actual en español */
$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

/* Determinar periodo */
$mes = date('m', strtotime($curso->fechaInicio));

if ($mes <= 6) {
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

/* Modalidad */
if ($curso->modalidad == 1) {
    $modalidad = "Presencial";
} elseif ($curso->modalidad == 2) {
    $modalidad = "Virtual";
} else {
    $modalidad = "Semipresencial";
}

/* Obtener nombre del departamento */
$sqlGetDepto = "SELECT nombreDepartamento
                FROM departamento
                WHERE idDepartamento='$curso->departamento'";

$res = mysqli_query($conn,$sqlGetDepto);
$departamento= mysqli_fetch_array ($res);

/* Obtener nombre del coordinador(a) de Actualizacion Docente */
$sqlGetCoord= "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Actualización Docente'";

$res1 = mysqli_query($conn, $sqlGetCoord);
$coord= mysqli_fetch_array ($res1);

/* Obtener nombre del Jefe de Desarrollo Académico */
$sqlGetJefe= "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Desarrollo Académico'";

$res2 = mysqli_query($conn, $sqlGetJefe);
$jefe= mysqli_fetch_array ($res2);

/* Query de insercion */
$sql = "INSERT INTO curso
        VALUES ('',
            '$curso->folio',
            '$curso->clave',
            '$curso->nombre',
            '$periodo',
            '$curso->duracion',
            '$horaInicio',
            '$horaFin',
            '$fechaInicio',
            '$fechaFin',
            '$modalidad',
            '$curso->lugar',
           ' $curso->destinatarios',
            '$curso->Objetivo',
            '$curso->observaciones',
            'no',
            '$curso->instructor',
            '$curso->departamento')
        ";

if (mysqli_query($conn, $sql)) {
    
    /* CREACION DEL OFICIO DE REGISTRO DE CURSO */

    include 'C:/xampp/htdocs/Residencia/Pruebas/pruebaLogin/PDFTK/pdf_data_injection.class.php';
    $objPDF = new PDFDataInjection();

    /* rutas principales */
    $objPDF->setSourcePath('C:/xampp/htdocs/Residencia/Pruebas/pruebaLogin/PDFTK/origen/');
    $objPDF->setTempPath('C:/xampp/htdocs/Residencia/Pruebas/pruebaLogin/PDFTK/temp/');
    $objPDF->setDestinationPath('C:/xampp/htdocs/Residencia/Proyecto/files/');

    /* nombre del archivo con el formulario PDF original */
    $objPDF->setPDF('oficio.pdf');

    /* una matriz con los campos a llenar */
    $datos = [
        'numero' => rand(1, 100),
        'jefeDeptoAcademico' => $jefe[0],
        'objetivo' => $curso->Objetivo,
        'fecha' => $actual,
        'fechaCurso' => $fechaCurso,
        'nombreCurso' => $curso->nombre,
        'nombreUsuario' => strtoupper($curso->username),
        'departamentoUsuario' => 'DEPARTAMENTO DE '.strtoupper($departamento['nombreDepartamento']),
        'duracion' => $curso->duracion,
        'modalidad' => $modalidad,
        'coordAD' => $coord[0]
    ];

    /* pasar datos al formulario */
    $objPDF->setFormData($datos);

    /* Se crea el PDF en el directorio temporal */
    $objPDF->createFDF();

    /* Sustituir los datos del formulario */
    $objPDF->insertData();

    /* Convertir al archivo PDF final */
    $objPDF->injectDataInPDF();

    /* Recuperar nombre final del PDF */
    $FinalPDFName = $objPDF->getFinalPDFName();

    /* INSERTAR NOMBRE DEL DOCUMENTO EN TABLA curso_has_documento */
    $idCurso = mysqli_insert_id($conn);
    $sql = "INSERT INTO curso_has_documento
    VALUES($idCurso,7,'$FinalPDFName','no')";
    if(mysqli_query($conn, $sql)){
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'error al insertar oficio de registro';
    }

} else {
    $response['status'] = 'error' . mysqli_error($conn);
}

echo json_encode($response, JSON_FORCE_OBJECT);
