<?php
include_once "../limpiar.php";
include_once "../libs/crud.php";
//require __DIR__ . '../vendor/autoload.php';
include_once "../vendor/autoload.php";// Librería de acceso a datos
use \Firebase\JWT\JWT;
$key = 'my_secret_key';
$time = time();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['usuario']) & isset($_POST['contrasena'])) {
        $usuario = LimpiarCadena($_POST['usuario']);
        $contrasena = hash("sha512", LimpiarCadena($_POST['contrasena']));
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
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //Recordar poner en httpd.conf: SetEnvIf Authorization "(.*)"
    $jwt = $_SERVER['HTTP_AUTHORIZATION'];

    if (substr($jwt, 0, 6) === "Bearer") {
        $jwt = str_replace("Bearer ", "", $jwt);
        try {
            $data = JWT::decode($jwt, $key, array('HS256'));
            echo json_encode($data);
            http_response_code(200);
            exit();
        } catch (\Throwable $th) {
            echo 'Credenciales erroneas';
            http_response_code(401);
            exit();
        }
    }
    else {
            echo 'Acceso no autorizado';
            http_response_code (401);
            exit();
    }
}
?>