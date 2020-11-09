<?php

// include_once 'conexion.php';

// $response = [];

// if(!empty($_FILES)){
//     $path = '/Residencia/Proyecto/files'. $_FILES['file']['name'];
//     if(move_uploaded_file($_FILES['file']['tmp_name'], $path )){
//         $insertQuery = "INSERT INTO curso_has_document(rutaArchivo)
//                         VALUES ('".$_FILES['file']['name']."')";
//         if(mysqli_query($conn, $insertQuery)){
//             $response['status'] = 'ok';
//         }
//     }
// } else {
// $response['status'] = 'Error';
// }

// echo json_encode($response);

print_r($_FILES);

if (!empty($_FILES)) {
    $path = 'upload/' . $_FILES['file']['name'];
    if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        $insertQuery = "INSERT INTO curso_has_document(rutaArchivo) VALUES ('" . $_FILES['file']['name'] . "')";
        if (mysqli_query($connect, $insertQuery)) {
            echo 'File Uploaded';
        } else {
            echo 'File Uploaded But not Saved';
        }
    }
} else {
    echo 'Some Error';
}
