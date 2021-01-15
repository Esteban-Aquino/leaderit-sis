<?php

/**
 * ABM clientes
 * Autor: Esteban Aquino
 * Empresa: LeaderIT
 * Fecha: 02/10/2020
 */



class clientesDB {

    function __construct() {
        
    }
    
    public static function insertaClientes($cliente) {
        try {
            $id = 0;
            
            $sql = "INSERT INTO CLIENTES (nombre, telefono1, telefono2, direccion1, direccion2, ci, ruc,porc_descuento)
                    VALUES  (:nombre, :telefono1, :telefono2, :direccion1, :direccion2, :ci, :ruc, :porc_descuento);";
            // Preparar sentencia
            //print_r($cliente);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':nombre', $cliente['NOMBRE'], PDO::PARAM_STR);
            $comando->bindParam(':telefono1', $cliente['TELEFONO1'], PDO::PARAM_STR);
            $comando->bindParam(':telefono2', $cliente['TELEFONO2'], PDO::PARAM_STR);
            $comando->bindParam(':direccion1', $cliente['DIRECCION1'], PDO::PARAM_STR);
            $comando->bindParam(':direccion2', $cliente['DIRECCION2'], PDO::PARAM_STR);
            $comando->bindParam(':ci', $cliente['CI'], PDO::PARAM_STR);
            $comando->bindParam(':ruc', $cliente['RUC'], PDO::PARAM_STR);
            $comando->bindParam(':porc_descuento', intval($cliente['PORC_DESCUENTO']), PDO::PARAM_INT);
            $dbh->beginTransaction();
            $comando->execute();
            $id = $dbh->lastInsertId();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    
    public static function borraClientes($id) {
        try {
            
            $sql = "DELETE FROM CLIENTES WHERE ID = :ID;";
            // Preparar sentencia
            //print_r($cliente);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':ID', $id, PDO::PARAM_STR);
            $dbh->beginTransaction();
            $comando->execute();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    }

    
   public static function actualizaClientes($id, $cliente) {
        try {
            
            $sql = "UPDATE CLIENTES 
                    SET nombre = :nombre, 
                        telefono1 = :telefono1, 
                        telefono2 = :telefono2, 
                        direccion1 = :direccion1, 
                        direccion2 = :direccion2,
                        ci = :ci, 
                        ruc = :ruc,
                        porc_descuento = :porc_descuento
                    WHERE ID = :ID;";
            // Preparar sentencia
            // print ($sql);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':nombre', $cliente['NOMBRE'], PDO::PARAM_STR);
            $comando->bindParam(':telefono1', $cliente['TELEFONO1'], PDO::PARAM_STR);
            $comando->bindParam(':telefono2', $cliente['TELEFONO2'], PDO::PARAM_STR);
            $comando->bindParam(':direccion1', $cliente['DIRECCION1'], PDO::PARAM_STR);
            $comando->bindParam(':direccion2', $cliente['DIRECCION1'], PDO::PARAM_STR);
            $comando->bindParam(':ci', $cliente['CI'], PDO::PARAM_STR);
            $comando->bindParam(':ruc', $cliente['RUC'], PDO::PARAM_STR);
            $comando->bindParam(':porc_descuento', intval($cliente['PORC_DESCUENTO']), PDO::PARAM_INT);
            $comando->bindParam(':ID', intval($id), PDO::PARAM_INT);
            $dbh->beginTransaction();
            $comando->execute();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    } 
    
    
    public static function getClientes($id, $BUSCAR) {
        try {
            $cant = 10;
            //print($id);
            //print_r($BUSCAR);
            $sql = "SELECT  C.ID,
                            C.NOMBRE,
                            C.TELEFONO1,
                            C.TELEFONO2,
                            C.DIRECCION1,
                            C.DIRECCION2,
                            C.CI,
                            C.RUC,
                            C.PORC_DESCUENTO
                        FROM clientes c
                        WHERE (c.id = :ID OR :ID1 = '')
                    AND (c.ci LIKE CONCAT('%',:DOCUMENTO,'%') 
                         OR c.ruc LIKE CONCAT('%',:DOCUMENTO1,'%') 
                         OR UPPER(C.NOMBRE) LIKE CONCAT('%',UPPER(:DOCUMENTO2),'%')  )";

            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            //print($sql);
            // Ejecutar sentencia preparada
             $comando->bindParam(':ID', $id, PDO::PARAM_STR);
             $comando->bindParam(':ID1', $id, PDO::PARAM_STR);
             $comando->bindParam(':DOCUMENTO', $BUSCAR, PDO::PARAM_STR);
             $comando->bindParam(':DOCUMENTO1', $BUSCAR, PDO::PARAM_STR);
             $comando->bindParam(':DOCUMENTO2', $BUSCAR, PDO::PARAM_STR);
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



