<?php
include_once "../libs/crud.php"; // Librería de acceso a datos
include_once  "../imagenp.php";
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
	if (isset($_POST['nombres']) & isset($_POST['apellidos']) & isset($_POST['correo']) & isset($_POST['direccion']) & isset($_POST['hijos']) & isset($_POST['estado']) & isset($_FILES['archivo2']) &  isset($_POST['usuario']) & isset($_POST['contrasena'])) {
		
					$Nombre1 = $_POST['nombres'];
					$Apellido1 = $_POST['apellidos'];
					$Correo1 = $_POST['correo'];
					$Direccion1 = $_POST['direccion'];
					$Hijos1 = $_POST['hijos'];
					$Ecivil1 = $_POST['estado'];
					$Foto1 = otro($_FILES['archivo']);
					$Usuario1 = $_POST['usuario'];
					$Contrasena1 = hash("sha512", $_POST['contrasena']);
					$datos = crearusu($Nombre1, $Apellido1, $Correo1, $Direccion1, $Hijos1, $Ecivil1, $Foto1, $Usuario1, $Contrasena1);
					header("HTTP/1.1 200 OK");
					echo json_encode($datos);
					exit();
				
	} else {
		echo 'Ingresar cada uno de los datos';
		http_response_code(401);
		exit();
	}
}

// Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
	header("HTTP/1.1 200 OK");
	exit();
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
	require "ini.php";
	if (isset($_GET['contrseñaactual']) & isset($_GET['ncontrseña']) & isset($_GET['repetircontraseña'])) {
		if ($_GET['ncontrseña'] == $_GET['repetircontraseña']) {
			$contrseñaactual = hash("sha512", $_GET['contrseñaactual']);
			$ncontrseña = hash("sha512", $_GET['ncontrseña']); # code...
			cambiarc($contrseñaactual, $ncontrseña, $id);
		} else {
			echo 'Los campos de contraseña deben coincidir';
			http_response_code(401);
			exit();
		}
	} else {
		echo 'Ingresar cada uno de los datos';
		http_response_code(401);
		exit();
	}
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>