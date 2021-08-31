<?php

/**
 * Inserta cliente
 * Esteban Aquino 02/11/2020
 */
require_once './back/DAO/clientesDB.php';

$datos = [];
$mensaje = "";
$res_code = StatusCodes::HTTP_OK;
$decoded = "";

$idCliente = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
// Validaciones ???

if (nvl($idCliente, 'NN') != 'NN') {
    $resp = clientesDB::borraClientes($idCliente);
    if (is_numeric($resp)) {
        $datos['id'] = $resp;
        $mensaje = 'BORRADO';
    } else {
        $res_code = StatusCodes::HTTP_BAD_REQUEST;
        $mensaje = $resp;
    }
}

print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
