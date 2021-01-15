<?php

/**
 * Provee las constantes para conectarse a la base de datos ORACLE
 * Autor: Esteban Aquino
 * Empresa: LEADERIT
 * Fecha: 07/09/2020
 */

/*require 'parametros.php';*/
IF (DB === 'ORACLE') {
    IF (ENVIROMENT === 'PROD') {
        define("DATABASE", "OPTIMA"); // Nombre del db
        define("USERNAME", "MYSHUZZ"); // Nombre del usuario
        define("PASSWORD", "MYSHUZZ"); // Nombre de la constraseña
    } ELSE {
        define("DATABASE", "BCKOP"); // Nombre del db
        define("USERNAME", "MYSHUZZ"); // Nombre del usuario
        define("PASSWORD", "MYSHUZZ"); // Nombre de la constraseña
    }
} ELSE IF (DB === 'MYSQL') {
    IF (ENVIROMENT === 'PROD') {
        define("DATABASE", "leaderit"); // Nombre del db
        define("HOSTNAME", "localhost"); // Nombre del db
        define("USERNAME", "leaderit"); // Nombre del usuario
        define("PASSWORD", "leaderit"); // Nombre de la constraseña
    } ELSE {
        define("DATABASE", "leaderit"); // Nombre del db
        define("HOSTNAME", "localhost"); // Nombre del db
        define("USERNAME", "leaderit"); // Nombre del usuario
        define("PASSWORD", "leaderit"); // Nombre de la constraseña
    }
}
