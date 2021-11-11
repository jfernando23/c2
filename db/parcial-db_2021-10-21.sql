-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-10-2021 a las 15:58:47
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `ID_MENSAJE` int(11) NOT NULL,
  `MENSAJE` varchar(250) NOT NULL,
  `ID_USUARIOD` int(11) NOT NULL,
  `ID_USUARIOO` int(11) NOT NULL,
  `ARCHIVO` varchar(250) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tuits`
--

CREATE TABLE `tuits` (
  `ID_TUIT` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `TUIT` varchar(250) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PUBLICO` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `APELLIDO` varchar(250) NOT NULL,
  `CORREO` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DIRECCION` varchar(250) NOT NULL,
  `HIJOS` int(11) NOT NULL,
  `ESTADO` varchar(250) NOT NULL,
  `FOTO` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `USUARIO` varchar(250) NOT NULL,
  `CLAVE` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`ID_MENSAJE`),
  ADD KEY `ID_USUARIOD` (`ID_USUARIOD`),
  ADD KEY `ID_USUARIOO` (`ID_USUARIOO`);

--
-- Indices de la tabla `tuits`
--
ALTER TABLE `tuits`
  ADD PRIMARY KEY (`ID_TUIT`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `ID_MENSAJE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `tuits`
--
ALTER TABLE `tuits`
  MODIFY `ID_TUIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`ID_USUARIOD`) REFERENCES `usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`ID_USUARIOO`) REFERENCES `usuarios` (`ID_USUARIO`);

--
-- Filtros para la tabla `tuits`
--
ALTER TABLE `tuits`
  ADD CONSTRAINT `tuits_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
