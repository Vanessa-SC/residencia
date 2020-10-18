<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bd_sistemaAD";
	
	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) 
	    die("Fallo al conectar: " . $conn->connect_error());
	else 
		echo 'Conectado...';
?> 