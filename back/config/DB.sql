/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  esteban.aquino
 * Created: 06-oct-2020
 */

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaciÃ³n: 31-08-2021 a las 17:04:06
-- VersiÃ³n del servidor: 10.1.38-MariaDB
-- VersiÃ³n de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `leaderit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `telefono1` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono2` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion1` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion2` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ruc` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porc_descuento` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono1`, `telefono2`, `direccion1`, `direccion2`, `ci`, `ruc`, `porc_descuento`) VALUES
(1, 'Samara Aquino', '+595981261400', '', 'Agripina Burgos 1283', '', '6511651', '', 0),
(2, 'Esteban Aquino', '+595981261400', '', 'Agripina Burgos 1283', '', '4329201', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(25) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `nombre` varchar(2000) NOT NULL,
  `activo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `clave`, `nombre`, `activo`) VALUES
('ADMIN', 'ADMIN', 'ADMINISTRADOR DEL SISTEMA', 'S');

--
-- Ãndices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

