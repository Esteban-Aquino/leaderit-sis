<?php

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
        $acceso = $decoded['valid'];
        
        if ($acceso) {
            $token = $decoded['TOKEN'];
        }
    }
} else {
    $acceso = true;
}

if ($acceso) {
    $mensaje = 'Metodo no encontrado';    
    $res_code = StatusCodes::HTTP_NOT_FOUND;
} 
print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);