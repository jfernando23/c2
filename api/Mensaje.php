<?php
include_once "../libs/crud.php";
include_once  "imagenp.php";
//require __DIR__ . '../vendor/autoload.php';
include_once "../vendor/autoload.php";// Librería de acceso a datos
use \Firebase\JWT\JWT;
$key = 'my_secret_key';
$time = time();
$jwt = $_SERVER['HTTP_AUTHORIZATION'];

if (substr($jwt, 0, 6) === "Bearer") {
    $jwt = str_replace("Bearer ", "", $jwt);
    try {
        $data = JWT::decode($jwt, $key, array('HS256'));
        $id = $data->data->usuario->ID_USUARIO;
        //echo "hola" .$id;
        http_response_code(200);
        //exit();
    } catch (\Throwable $th) {
        echo 'Credenciales erroneas';
        //echo $th;
        http_response_code(401);
        exit();
    }
}
else {
        echo 'Acceso no autorizado';
        http_response_code (401);
        exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['todos']) ) {
        $datos = mostrarmensajes($id);
        while($fila = $datos->fetch_assoc()){
            echo "---------------------- \n";
            echo "Origen: ".$fila['ORIGEN']."\n";
            echo "Foto: ".  $fila['FOTO']."\n";
            echo "Mensaje: ".$fila['MENSAJE']."\n";
            echo "Fecha: ".$fila['FECHA']."\n";
            echo "Archivo: ".$fila['ARCHIVO']."\n";
        }
        //header("HTTP/1.1 200 OK");
        //echo json_encode($fila);
        exit();
    }else if(isset($_GET['propio'])){
        $datos =  mostrarmensajesen($id);
        while($fila = $datos->fetch_assoc()){
            echo "---------------------- \n";
            echo "Destinatario: ".$fila['DESTINO']."\n";
            echo "Foto: ".  $fila['FOTO']."\n";
            echo "Mensaje: ".$fila['MENSAJE']."\n";
            echo "Fecha: ".$fila['FECHA']."\n";
            echo "Archivo: ".$fila['ARCHIVO']."\n";
        }
        exit();
    }
    else{
        echo 'Indicar una acción';
        http_response_code (401);
        exit();
    }
   
}

// Crear
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['destinatario']) & isset($_POST['mensaje']) & isset($_FILES['archivo']) ) {
        $desti = $_POST['destinatario'];
        $mensaje = $_POST['mensaje'];
        $archivo = otro($_FILES['archivo']);
        $datos = enviarmensaje($id, $desti, $mensaje, $archivo);
        header("HTTP/1.1 200 OK");
        echo json_encode($datos);
        exit();
    }else{
        echo 'Ingresar cada uno de los datos';
        http_response_code (401);
        exit();
    }
}

// Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
   
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>