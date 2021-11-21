<?php
	include_once "../libs/crud.php";// Librería de acceso a datos

	// Consultar
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		
		if (isset($_GET['usuario']) & isset($_GET['contrasena'])) {
			$usuario = $_GET['usuario'];
            $contrasena = hash("sha512", $_GET['contrasena']);
		}
        $datos = login($usuario, $contrasena);
		//$datos = Consultar($id);
		header("HTTP/1.1 200 OK");
		echo json_encode($datos);
		exit();	
	}

	// Crear
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		header("HTTP/1.1 200 OK");
		echo json_encode($datos);
		exit();	
	}

	// Borrar
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		header("HTTP/1.1 200 OK");
		exit();
	}

	// Actualizar
	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
		
		header("HTTP/1.1 200 OK");
		exit();
	}

	//En caso de que ninguna de las opciones anteriores se haya ejecutado
	header("HTTP/1.1 400 Bad Request");

?>