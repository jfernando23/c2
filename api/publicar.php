<?php
include_once "../libs/crud.php";
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
        $datos = mostrar();
        while($fila = $datos->fetch_assoc()){

            echo "---------------------- \n";
            echo "Nombre: ".$fila['NOMBRE'] . " " . $fila['APELLIDO']."\n";
            echo "Foto: ".$fila['FOTO']."\n";
            echo "Tuit: ". $fila['TUIT']."\n";
            echo "Fecha: ".$fila['FECHA']."\n";
        }
        //header("HTTP/1.1 200 OK");
        //echo json_encode($fila);
        exit();
    }else if(isset($_GET['propio'])){
        $datos =  mostrarid($id);
        while($fila = $datos->fetch_assoc()){

            echo "---------------------- \n";
            echo "Público: ".$fila['PUBLICO']."\n";
            echo "Tuit: ". $fila['TUIT']."\n";
            echo "Fecha: ".$fila['FECHA']."\n";
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
    
    if (isset($_POST['tuit']) & isset($_POST['publico']) ) {
        $tuit = $_POST['tuit'];
        $publico = $_POST['publico'];
        $datos = tuit($id,$tuit,$publico);
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
    if (isset($_GET['eliminar']) ) {
        $idt= $_GET['eliminar'];
        $datos =  eliminar($idt,$id);
        header("HTTP/1.1 200 OK");
        echo json_encode($datos);
        exit();
    }
    else{
        echo 'Indicar una acción';
        http_response_code (401);
        exit();
    }
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    if (isset($_GET['publicar']) ) {
        $idt= $_GET['publicar'];
        $datos =  publicar($idt,$id);
        header("HTTP/1.1 200 OK");
        echo json_encode($datos);
        exit();
    }else if(isset($_GET['despublicar'])){
        $idt= $_GET['despublicar'];
        $datos =  despublicar($idt,$id);
        header("HTTP/1.1 200 OK");
        echo json_encode($datos);
        exit();
    }
    else{
        echo 'Indicar una acción';
        http_response_code (401);
        exit();
    }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>