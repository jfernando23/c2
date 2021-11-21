<?php
include_once "../libs/crud.php";
//require __DIR__ . '../vendor/autoload.php';
include_once "../vendor/autoload.php";// Librería de acceso a datos
use \Firebase\JWT\JWT;
$key = 'my_secret_key';
$time = time();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['usuario']) & isset($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = hash("sha512", $_POST['contrasena']);
    }else{
        echo "Ingrese cada uno de los datos ";
        http_response_code(401);
        exit();
    }

    $datos = login($usuario, $contrasena);
    if($datos != NULL){
        $data = array(
            'iat' => $time,
            'exp' => $time + (60*60),
            'data' => ['usuario' => $datos]
        );
        
        $jwt = JWT::encode($data,$key);
        echo $jwt;
        header("HTTP/1.1 200 OK");
        exit();	
    }else{
        echo "No se ha podido completar la acción";
        http_response_code(401);
        exit();	
    }
    //$datos = Consultar($id);
    
}
?>