<?php

/* Retorna la fecha actual */

// Establecimiento de zona horaria
date_default_timezone_set('America/Mexico_City');

// Array de respuesta
$res = [];
// Formato y obtención de la fecha
$fecha = date('Y-m-d');
    // Guardado de la fecha
    $res['fecha'] = $fecha;
    // Impresión
echo json_encode($res);
