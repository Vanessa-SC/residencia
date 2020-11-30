<?php

$datos = json_decode(file_get_contents('php://input'), true);

/* Separar el arreglo */
$participantes = $datos['participantes'];
$lista = $datos['lista'];

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
        $asist = $lista[$id];

        /* Validando si la asistencia no existe (inasistencia) */
        if (empty($asist)) {
            $asist = 0;
        }

        /* Imprime los valores */
        print('id: ' . $id . ', asistencia: ' . $asist . ' | ');

        /*  Aquí se agregará la inserción de cada asistencia 
            de forma individual */

            $sql = "INSERT INTO asistencia 
                    VALUES... ";

    }

}
