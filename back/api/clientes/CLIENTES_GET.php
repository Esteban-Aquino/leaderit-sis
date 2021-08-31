<?php

/**
 * Get de clientes
 * Autor: Esteban Aquino
 * Empresa: Optima SA
 * Fecha: 02/09/2020
 */
require_once './back/DAO/clientesDB.php';

$datos = [];
$mensaje = "";
$res_code = StatusCodes::HTTP_OK;
$decoded = "";

$BUSCAR = NVL(filter_input(INPUT_GET, 'BUSCAR', FILTER_SANITIZE_STRING), '');
$id = NVL(filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING), '');

//print($BUSCAR);

$data = clientesDB::getClientes($id, $BUSCAR);

if (is_array($data)) {
    $longitud = count($data);
    if ($longitud > 0) {
        $res_code = StatusCodes::HTTP_OK;
        $datos = $data;
    } else {
        $res_code = StatusCodes::HTTP_NOT_FOUND;
        $mensaje = "Sin datos";
    }
} else {
    // error
    $res_code = StatusCodes::HTTP_INTERNAL_SERVER_ERROR;
    $mensaje = formatea_error($data);
}

print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
