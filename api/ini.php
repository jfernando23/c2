<?php
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
?>