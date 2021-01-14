<?php

/* Registrará la asistencia de los participantes de un curso en el día actual */

// Conexión
include_once 'conexion.php';

// Recepción de datos
$datos = json_decode(file_get_contents('php://input'), true);

/* Separar el arreglo */
$lista = $datos['lista'];
$idCurso = $datos['idCurso'];

$response = [];
$contador = 0;

/** Obtener id de los participantes del curso */

$sqlPart = "SELECT usuario_idUsuario as idu
            FROM usuario_has_curso
            WHERE curso_idCurso = $idCurso";
if (mysqli_query($conn, $sqlPart)) {
    $participantes = mysqli_fetch_all(mysqli_query($conn, $sqlPart), MYSQLI_ASSOC);
}

if (!empty($participantes)) {

    if (empty($lista)) {
        foreach ($participantes as $key => $value) {
            $id = implode($value);
            $sql = "INSERT INTO asistencia VALUES('', null,0,$id,$idCurso) ";

            if (mysqli_query($conn, $sql)) {
                $contador = $contador + 1;
            }
        }
    } else {
        /*  Obtener las llaves de cada objeto para determinar la
        que tiene el valor máximo y usarse en el ciclo for */
        $keyLista = (array_keys($lista));
        $keyParticipantes = (array_keys($participantes));

        // Determinar el ID máximo
        foreach ($participantes as $key => $value) {
            $max = max($value);
        }

        /* Recorrer el arreglo */
        for ($i = 0; $i <= max($keyLista); $i++) {

            /*  Determinar si existe el participante con la llave(id)
            recibida en la lista */
            if (array_key_exists($i, $participantes)) {
                $asist = 0;
                /* Extracción del id y asistencia */
                $id = $participantes[$i]['idu'];
                if (!empty($lista[$id])) {
                    $asist = $lista[$id];
                }

                /*  Aquí se agregará la inserción de cada asistencia
                de forma individual */

                $sql = "INSERT INTO asistencia
                        VALUES('', null,$asist,$id,$idCurso) ";

                $contador = $contador + 1;
                mysqli_query($conn, $sql);
            }
        }

        /* Validación para saber si todas las consultas se realizaron */
        if ($contador == count($keyParticipantes)) {
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error '.mysqli_error($conn);
        }
        /* Impresión de la respuesta */
        echo json_encode($response, true);
    }
}
