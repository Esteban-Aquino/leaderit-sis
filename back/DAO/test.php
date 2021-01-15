<?php

/**
 * Provee consultas a MYSQL
 * Autor: Esteban Aquino
 * Empresa: LEADERIT
 * Fecha: 07/09/2020
 */
require '../config/myconnect.php';
require '../shared/util.php';

class testdataDB {

    function __construct() {
        
    }

    public static function test() {
        try {

            $consulta = "SELECT * FROM TEST";

            $comando = myconnect::getInstance()->getDb()->prepare($consulta);

            // Ejecutar sentencia preparada
            $comando->execute();

            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //PRINT_R($result);
            return utf8_converter($result);
        } catch (PDOException $e) {
            //print_r($e->getMessage());
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    

}
