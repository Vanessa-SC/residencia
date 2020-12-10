<?php

/* Retorna la fecha actual */

// Establecimiento de zona horaria
date_default_timezone_set('America/Mexico_City');

// array de respuesta
$res = [];
// formato y obtencion de la fecha
$fecha = date('d/m/Y');
    //guardado de la fecha
    $res['fecha'] = $fecha;
    //impresion
echo json_encode($res);
