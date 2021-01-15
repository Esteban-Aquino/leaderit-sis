<?php

/**
 * Provee las operaciones de bd para consultas
 * Autor: Esteban Aquino
 * Empresa: Optima SA
 * Fecha: 27/07/2020
 */
require '../config/oraconnect.php';
require '../shared/util.php';

class getdataDB {

    function __construct() {
        
    }

    public static function getExistencia($fecha, $sku) {
        try {
            $cant = 10;
            //print($fecha);
            //print_r($busqueda);
            $consulta = "SELECT COD_MYSHUZZ,
                                COD_COLOR_MYSHUZZ,
                                TAMANIO,
                                CANTIDAD,
                                PRECIO_NORMAL,
                                PRECIO_CON_DESCUENTO,
                                DESCUENTO_FECHA_INICIO,
                                DESCUENTO_FECHA_FIN,
                                NOMBRE,
                                EC_DESCRIPCION_CORTA,
                                DESCRIPCION,
                                DEPARTAMENTO,
                                CATEGORIA,
                                SUBCATEGORIA,
                                ESTILO,
                                MARCA,
                                GENERO,
                                TO_CHAR(FEC_ULT_MOVIMIENTO,'dd-mm-yyyy hh:mi:ss') FEC_ULT_MOVIMIENTO
                           FROM ECV_ARTICULOS_EXIS_PRE E
                           WHERE (E.COD_MYSHUZZ = :P_COD_MYSHUZZ OR :P_COD_MYSHUZZ1 IS NULL)
                           AND (E.FEC_ULT_MOVIMIENTO >= TO_DATE(:PFECHA,'dd-mm-yyyy hh:mi:ss')
                                OR :PFECHA1 IS NULL)";

            //print_r($fec_des);
            // Preparar sentencia
            //print_r($consulta);
            $comando = oraconnect::getInstance()->getDb()->prepare($consulta);

            // Ejecutar sentencia preparada
            $comando->execute([':P_COD_MYSHUZZ' => $sku,
                               ':P_COD_MYSHUZZ1' => $sku,
                               ':PFECHA' => $fecha,
                               ':PFECHA1' => $fecha]);

            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //PRINT_R($result);
            return utf8_converter($result);
        } catch (PDOException $e) {
            //print_r($e->getMessage());
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    
    public static function getClientes($id, $documento) {
        try {
            $cant = 10;
            //print($fecha);
            //print_r($busqueda);
            $consulta = "SELECT C.ID,
                                C.NOMBRE,
                                C.TELEFONO1,
                                C.TELEFONO2,
                                C.DIRECCION1,
                                C.DIRECCION2,
                                C.CI,
                                C.RUC,
                                C.PORC_DESCUENTO
                        FROM clientes c
                        WHERE (c.id = :ID OR :ID1 IS NULL)
                        AND (c.ci LIKE '%:DOCUMENTO%' 
                             OR c.ruc LIKE '%:DOCUMENTO1%' 
                             OR NOMBRE LIKE '%:DOCUMENTO2%' )";

            //print_r($fec_des);
            // Preparar sentencia
            //print_r($consulta);
            $comando = oraconnect::getInstance()->getDb()->prepare($consulta);

            // Ejecutar sentencia preparada
            $comando->execute([':ID' => $id,
                               ':ID1' => $id,
                               ':DOCUMENTO' => $documento,
                               ':DOCUMENTO1' => $documento,
                               ':DOCUMENTO2' => $documento]);

            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //PRINT_R($result);
            return utf8_converter($result);
        } catch (PDOException $e) {
            //print_r($e->getMessage());
            return utf8_converter_sting($e->getMessage());
        }
    }

}
