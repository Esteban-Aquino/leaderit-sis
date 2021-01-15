<?php

/**
 * Validar Usuario
 * Esteban Aquino 30/09/2019
 */
/*require_once '../DAO/auth.php';
require_once '../shared/sharedFunctions.php';
require_once '../shared/http_response_code.php';*/
require_once './back/DAO/auth.php';

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
    if (nvl($token,'NN') != 'NN') {
        $decoded = validarToken($token); 
        //print_r($decoded);
        $ok = $decoded['valid'];
        
        if ($ok) {
            
            $datos['usuario'] = $decoded['decoded']->USUARIO;
            $datos['nombre'] = $decoded['decoded']->NOMBRE;
            $token = $decoded['TOKEN'];
            //print_r($datos);
        }
    }
} else {
    $ok = true;
}

if (!$ok) {
    
    # Capturar post JSON
    $json_str = file_get_contents('php://input');
    # Obtener como Array
    $json_obj = json_decode(utf8_converter_sting($json_str), true);
    $usuario = $json_obj['usuario'];
    $clave = $json_obj['clave'];
    
    if (nvl($usuario,'NN') != 'NN') {
        $auth = auth::ValidarUsuario($usuario, $clave);
        //print $conn;
        if ($auth != null) {
            $ok = true;
            $token = generaToken($auth);
            $nombre = $auth[0]['NOMBRE'];
            $datos['usuario'] = $usuario;
            $datos['nombre'] = $nombre;
            $acceso = true;

        }
    }
}
if (!$ok) {
    //$respuesta["datos_usuario"] = null;
    $token = '';
    $acceso = false;
    $res_code = StatusCodes::HTTP_UNAUTHORIZED;
} else {
    $acceso = true;
}


print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
?>
