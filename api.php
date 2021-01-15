<?php

$config_path = 'back/config/';
$shared_path = 'back/shared/';
$api_path = 'back/api/';
require $config_path . 'parametros.php';
require $config_path . 'myconnect.php';
require $shared_path . 'php-jwt-master/src/JWT.php';
require $shared_path . 'util.php';
require $shared_path . 'http_response_code.php';
require $shared_path . 'sharedFunctions.php';

$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$SERV = filter_input(INPUT_GET, 'SERV', FILTER_SANITIZE_STRING);

if ($SERV === 'validar') {
    require_once $api_path . 'validarUsuario.php';
} else {
    $acceso = false;
    $datos = "";
    $mensaje = "";
    $res_code = StatusCodes::HTTP_OK;
    $decoded = "";

    // Verificar autenticidad del token
    if (VERIFICA_TOKEN) {
        $head = getallheaders();
        $token = $head['token'];
        //print $token;
        if (nvl($token, 'NN') != 'NN') {
            $decoded = validarToken($token);
            //print_r($decoded);
            $ok = $decoded['valid'];

            if ($ok) {
                $token = $decoded['TOKEN'];
            }
        }
    } else {
        $ok = true;
    }
    if ($ok) {
        $acceso = true;
        require_once $api_path . 'rutas.php';
    } else {
        $token = '';
        $acceso = false;
        $mensaje = 'Acceso no autorizado';
        $res_code = StatusCodes::HTTP_UNAUTHORIZED;
        print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
    }
}
