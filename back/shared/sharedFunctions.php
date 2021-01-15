<?php

/**
 * Funciones compartidas
 * Autor: Esteban Aquino
 * Empresa: LeaderIT
 * Fecha: 27/07/2020
 */
use Firebase\JWT\JWT;




/**
 * Formatea error de base de datos Oracle
 * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
 * @param string $error Error rertornado por la BD
 * @return string Error formateado
 */
function formatea_error($error) {
    return str_replace(')', '', str_replace('(', '', str_replace(']', '', str_replace('[', '', str_replace('"', '', $error)
                            )
                    )
            )
    );
}
/**
 * Devuelve respuesta formateada JSON incluidas las cabeceras con acces control
 * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
 * @param boolean $acceso Tipo de acceso otorgado
 * @param Object $datos Datos retornados
 * @param string $mensaje Algun retorno de mensaje o error
 * @param number $res_code Codigo de respuesta http- https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
 * @param string $newToken Nuevo token generado
 * @return JSON
 */
function formatea_respuesta($acceso, $datos, $mensaje, $res_code, $newToken) {
    $respuesta["acceso"] = $acceso;
    $respuesta["datos"] = $datos;
    $respuesta["token"] = $newToken;
    $respuesta["mensaje"] = $mensaje;
    IF (!HTTP_ERRORS) {
        $res_code = StatusCodes::HTTP_OK;
    }
    http_response_code($res_code);
    agrega_cabecera_json();
    return json_encode($respuesta);
}

function agrega_cabecera_json() {
    header("Content-type: application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
}


function validarToken($token) {
    $valid = true;
    $decoded = '';
    $message = '';
    $respuesta["valid"] = $valid;
    $respuesta["decoded"] = $decoded;
    $respuesta["message"] = $message;
    
    try {
        $decoded = JWT::decode($token, LLAVE_SUPER_SECRETA, array('HS256'));
    } catch (Exception $e) {
        $valid = false;
        $message = $e->getMessage();
    }
    // validar vencimiento
    if ($valid) {
        /*
            $input = '06/10/2011 19:00:02'; 
            $date = strtotime($input); 
            echo date('d/M/Y h:i:s', $date); 
         */
        $EMI = $decoded->EMI;
        //$VENC = strtotime($decoded->VENC);
        $VENC = date_create_from_format('d/m/Y H:i:s', $decoded->VENC);
        $HOY = date_create_from_format('d/m/Y H:i:s', date("d/m/Y H:i:s",time()));
        // Para sumar 1 dia
        //$HOY = date_modify($HOY, '+1 day');
        /*print('||');
        print_r ($HOY   );
        print('||');
        print_r ($VENC);*/
        IF ($HOY < $VENC) {
           $USUARIO = $decoded->USUARIO;
           $NOMBRE = $decoded->NOMBRE;
           $datos[0]['USUARIO'] = $USUARIO;
           $datos[0]['NOMBRE'] = $NOMBRE;
           $newToken = generaToken($datos);
           $respuesta["TOKEN"] = $newToken;
        } ELSE {
            //print 'vencido';
           $valid = FALSE;
        }
        
    }
    $respuesta["valid"] = $valid;
    $respuesta["decoded"] = $decoded;
    $respuesta["message"] = $message;
    //print_r ($respuesta);
    //print_r($valido[0]['VALID']);
    //print_r ($decoded['decoded'][0]->USR_CALL);

    return $respuesta;
}

function generaToken($datos) {
    $time = time(); //Fecha y hora actual en segundos
    $usuario = $datos[0]['USUARIO'];
    $nombre = $datos[0]['NOMBRE'];
    $payload['USUARIO'] = $usuario;
    $payload['NOMBRE'] = $nombre;
    $payload['EMI'] = date('d/m/Y H:i:s', $time);
    $payload['VENC'] =  date('d/m/Y H:i:s', $time + ( HORAS_VALIDEZ_TOKEN * 60 * 60));
    $token = JWT::encode($payload, LLAVE_SUPER_SECRETA); //CodificaR el Token
    return $token;
}