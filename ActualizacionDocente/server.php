<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: text/html;charset=utf-8");

if(!isset($_POST)) die();


/* Inicialización de la sesión, declaración del array de respuesta y conexión */
session_start();
$response = [];
include_once 'php/conexion.php';


$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT idUsuario, 
				Departamento_idDepartamento, 
				rol, 
				RFC, 
				contrasena,  
				concat_ws(' ',nombre,apellidoPaterno,apellidomaterno) as nombre
			FROM usuario
			WHERE RFC='$username' AND contrasena='$password'";

$result = mysqli_query($conn, $query);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(mysqli_num_rows($result) > 0) {
	$response['status'] = 'loggedin';
	$response['user'] = $user[0]['nombre'];
	$response['useruniqueid'] = md5(uniqid());
	$_SESSION['useruniqueid'] = $response['useruniqueid'];

	echo json_encode($user[0]+$response,JSON_FORCE_OBJECT);

} else {
	$response['status'] = 'error';

	echo json_encode($response,JSON_FORCE_OBJECT);

}




// echo json_encode($response);

// echo json_encode($user[0]+$response,JSON_FORCE_OBJECT);
