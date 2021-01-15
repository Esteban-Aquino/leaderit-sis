<?php

/**
 * Provee consultas a Mysql para validacion de usuarios
 * Autor: Esteban Aquino
 * Empresa: LEADERIT
 * Fecha: 05/10/2020
 */
/*require '../config/myconnect.php';
require '../shared/util.php';*/

class auth {

    function __construct() {
        
    }

    public static function ValidarUsuario($usuario, $clave) {
        try {

            $consulta = "SELECT USUARIO, NOMBRE FROM `USUARIOS` WHERE ACTIVO = 'S' AND USUARIO = :USUARIO AND CLAVE = :CLAVE";
            
            $comando = myconnect::getInstance()->getDb()->prepare($consulta);
            $comando->execute([':USUARIO' => $usuario, ':CLAVE' => $clave]);

            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //PRINT_R($result);
            return utf8_converter($result);
        } catch (PDOException $e) {
            //print_r($e->getMessage());
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    

}