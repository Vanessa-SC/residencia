<?php

/* Registrará la asistencia de los participantes de un curso en el día actual */

// Conexión
include_once 'conexion.php';

// Recepción de datos
$datos = json_decode(file_get_contents('php://input'), true);

/* Separar el arreglo */
$participantes = $datos['participantes'];
$lista = $datos['lista'];
$idCurso = $datos['idCurso'];

$response = [];
$contador = 0;


/*  Obtener las llaves de cada objeto para determinar la 
    que tiene el valor máximo y usarse en el ciclo for */
$keyParticipantes = (array_keys($participantes));
$keyLista = (array_keys($lista));

/* Recorrer el arreglo */
for ($i = 0; $i < max($keyLista); $i++) {

    /*  Determinar si existe el participante con la llave(id)
        recibida en la lista */
    if (array_key_exists($i, $participantes)) {

        /* Extracción del id y asistencia */
        $id = $participantes[$i]['idUsuario'];
        if (!empty($lista[$id])) {
            $asist = $lista[$id];
        }

        /* Validando si la asistencia no existe (inasistencia) */
        if (empty($asist)) {
            $asist = 0;
        }

        /*  Aquí se agregará la inserción de cada asistencia 
            de forma individual */

            $sql = "INSERT INTO asistencia 
                    VALUES('', null,$asist,$id,$idCurso) ";

            $contador = $contador + 1;
            mysqli_query($conn,$sql);
    }
}
/* Validación para saber si todas las consultas se realizaron */
if( $contador == count($keyParticipantes)){
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error';
}
/* Impresión de la respuesta */
echo json_encode($response,true);
