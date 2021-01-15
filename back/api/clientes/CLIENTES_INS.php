<?php

/**
 * Inserta cliente
 * Esteban Aquino 02/11/2020
 */
require_once './back/DAO/clientesDB.php';

$datos = "";
$mensaje = "";
$res_code = StatusCodes::HTTP_OK;
$decoded = "";

# Capturar post JSON
$json_str = file_get_contents('php://input');
# Obtener como Array
$json_obj = json_decode(utf8_converter_sting($json_str), true);
$cliente = $json_obj;
//print_r ($cliente);

// Validaciones ???


if (nvl($cliente, 'NN') != 'NN') {
    $resp = clientesDB::insertaClientes($cliente);
    if (is_numeric($resp)) {
        $datos['id'] = $resp;
        $mensaje = 'Insertado';
    } else {
        $res_code = StatusCodes::HTTP_BAD_REQUEST;
        $mensaje = $resp;
    }
}

print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
