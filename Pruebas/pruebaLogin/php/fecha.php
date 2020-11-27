<?php

include_once 'conexion.php';

setlocale(LC_TIME, 'es_MX');
$res = [];

$fecha = date('d/m/Y');

    $res['fecha'] = $fecha;
    
echo json_encode($res);

?>