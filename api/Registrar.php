<?php
include_once "../libs/crud.php"; // Librería de acceso a datos

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
		if (isset($_FILES['archivo2']['tmp_name'])) {
			$fileTmpPath = $_FILES['archivo2']['tmp_name'];
			$fileName = $_FILES['archivo2']['name'];
			$fileSize = $_FILES['archivo2']['size'];
			$fileType = $_FILES['archivo2']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));

			$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

			$allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'docx', 'xlsx', 'pptx');
			if (in_array($fileExtension, $allowedfileExtensions)) {

				// directory in which the uploaded file will be moved
				$directorio = '../archivos/';
				if (!file_exists($directorio)) {
					mkdir($directorio, 0777);
				}

				$dir = opendir($directorio);
				$ruta = $directorio . '/' . $newFileName;

				if (move_uploaded_file($fileTmpPath, $ruta)) {
					$Nombre1 = $_POST['nombres'];
					$Apellido1 = $_POST['apellidos'];
					$Correo1 = $_POST['correo'];
					$Direccion1 = $_POST['direccion'];
					$Hijos1 = $_POST['hijos'];
					$Ecivil1 = $_POST['estado'];
					$Foto1 = $newFileName;
					$Usuario1 = $_POST['usuario'];
					$Contrasena1 = hash("sha512", $_POST['contrasena']);
					$datos = crearusu($Nombre1, $Apellido1, $Correo1, $Direccion1, $Hijos1, $Ecivil1, $Foto1, $Usuario1, $Contrasena1);
					header("HTTP/1.1 200 OK");
					echo json_encode($datos);
					exit();
				} else {
					//echo "Ha ocurrido un error";
				}
				closedir($dir);
			} else {
				echo "<script>alert('El archivo no corresponde a el formato permitido');
				window.location='registro.php';
				</script>";
			}
		} else {
			echo "<script>alert('No se pudo cargar archivo');
				  window.location='registro.php';
				  </script>";
		}
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