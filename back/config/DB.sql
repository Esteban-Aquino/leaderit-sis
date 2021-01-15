/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  esteban.aquino
 * Created: 06-oct-2020
 */

CREATE TABLE `leaderit`.`USUARIOS` (
	`usuario` VARCHAR(25) NOT NULL, 
	`clave` VARCHAR(60) NOT NULL, 
	`nombre` VARCHAR(2000) NOT NULL, 
	`activo` VARCHAR(1) NOT NULL, 
	PRIMARY KEY (
		`usuario`(25)
	)
) ENGINE = InnoDB;


/* INSERCIONES */
INSERT INTO USUARIOS VALUES('ADMIN','ADMIN','ADMINISTRADOR DEL SISTEMA','S');


CREATE TABLE IF NOT EXISTS `CLIENTES` (
  `id` int(11) NOT NULL,
  `nombre` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `telefono1` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono2` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion1` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion2` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ruc` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porc_descuento` float DEFAULT NULL
) ENGINE=InnoDB;


