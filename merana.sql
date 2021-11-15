-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-07-2020 a las 03:52:09
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `merana`
--
CREATE DATABASE IF NOT EXISTS `merana` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `merana`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_metro`
--

CREATE TABLE `encuesta_metro` (
  `id` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `edad` int(3) NOT NULL,
  `genero` char(1) NOT NULL,
  `frecuencia` varchar(10) NOT NULL,
  `horario` varchar(10) NOT NULL,
  `linea_metro` varchar(20) NOT NULL,
  `calidad_servicio` varchar(10) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `encuesta_metro`
--

INSERT INTO `encuesta_metro` (`id`, `rut`, `edad`, `genero`, `frecuencia`, `horario`, `linea_metro`, `calidad_servicio`, `observaciones`, `fecha_hora`) VALUES
(1, '11.111.111-1', 33, 'm', 'regular', 'medio', '1', 'bueno', 'Creo que me gusta el servicio de metro', '2020-07-14 04:04:31'),
(2, '22.222.222-1', 22, 'f', 'poca', 'medio', '6', 'regular', 'No uso mucho el metro', '2020-07-14 04:00:46'),
(3, '5.333.333-k', 50, 'f', 'poca', 'punta', '3', 'bueno', 'Lo poco que viajo lo hago en el horario punta', '2020-07-14 04:02:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta_metro`
--
ALTER TABLE `encuesta_metro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta_metro`
--
ALTER TABLE `encuesta_metro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
