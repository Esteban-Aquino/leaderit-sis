<?php

/**
 * Get de clientes
 * Autor: Esteban Aquino
 * Empresa: Optima SA
 * Fecha: 03/09/2020
 */
require_once '../DAO/pedidoDB.php';
require_once '../shared/sharedFunctions.php';
require_once '../shared/http_response_code.php';

# Objener metodo HTTP
$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
// SI LA PETICION ES GET
IF ($metodo == 'POST') {
    # Obtener headers
    $head = getallheaders();
    $ok = false;

    $res_code = StatusCodes::HTTP_OK;
    $acceso = true;
    $mensaje = '';

    // Verificar autenticidad del token
    if (VERIFICA_TOKEN) {
        $token = $head['token'];
        if ($token !== 'null' && $token !== null) {
            $ok = validarToken($token)['valid'];
        }
    } else {
        $ok = true;
    }

    if ($ok) {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode(utf8_converter_sting($json_str), true);
        $cabecera = $json_obj["CABECERA"];
        // Validar fecha
        
        $detalle = $json_obj["DETALLE"];


        // GUARDAR CABECERA
        $respCab = pedidoDB::insertaCabeceraPedido($cabecera);
        $dsc = formatea_error($respCab);

        if (is_numeric($respCab)) {
            // Si la cabecera inserto bien $respCab va a tener el nro de pedido insertado 
            $longitud = count($detalle);
            //Recorro todos los elementos
            for ($i = 0; $i < $longitud; $i++) {
                //saco el valor de cada elemento
                $detalle[$i]['NRO_PEDIDO'] = $respCab;
                $datosDet = pedidoDB::insertaDetallePedido($detalle[$i]);
                if ($datosDet !== 'OK') {
                    break;
                }
                //print_r($detalle[$i]);
            }
            if ($datosDet !== 'OK') {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $acceso = true;
                $mensaje = formatea_error($datosDet);
            }
        } ELSE {
            $res_code = StatusCodes::HTTP_BAD_REQUEST;
            $acceso = true;
            $datos = '';
            $mensaje = $dsc;
        }

        // completar carga
        IF ($res_code === StatusCodes::HTTP_OK) {
            $confirmado = pedidoDB::completaCarga($respCab);
            if ($confirmado !== 'OK') {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $acceso = true;
                $mensaje = formatea_error($confirmado);
            }
        }

        // confirmar
        IF ($res_code === StatusCodes::HTTP_OK) {
            $confirmado = pedidoDB::confirmaPedido($respCab);
            if ($confirmado !== 'OK') {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $acceso = true;
                $mensaje = formatea_error($confirmado);
            }
        }

        // Todo OK
        IF ($res_code === StatusCodes::HTTP_OK) {
            $res_code = StatusCodes::HTTP_OK;
            $acceso = true;
            $datos = utf8_converter_sting($respCab);
            $mensaje = '';
        }
        
    } else {

        $acceso = false;
        $mensaje = 'Token no valido';
    }
} ELSEIF ($metodo == 'GET') {
    // CONSULTA PEDIDO
} ELSE {
    $res_code = StatusCodes::HTTP_NOT_FOUND; // NOT FOUND
    $acceso = false;
    $mensaje = 'Metodo http no encontrado';
}

print formatea_respuesta($acceso, $datos, $mensaje, $res_code);
