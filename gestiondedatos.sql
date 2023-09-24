-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2023 a las 18:26:52
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestiondedatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `id_usuario`) VALUES
(11, 'Proyecto TIO EDITADO', 'TPE de TIO EDITADO', 367),
(14, 'Proyecto Prog 2', 'TPE Prog 2', 367),
(15, 'Proyecto Web 2 EDITADOooo', 'TPE Web 2 EDITADO', 367),
(23, 'Proyecto Inglés', 'TPE Inglés', 367),
(28, 'Titulo...', 'Probando...', 366),
(30, 'JuanCr First Proyect', 'Tra la la la la', 368);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `contraseña`, `id_rol`) VALUES
(6, 'Miki', '$2y$10$HHYoZ/FyRmaVAk9bUpQwu.lJkSN7d4LPYXsAnSO9SFNVxfyDDwp3K', NULL),
(7, 'mike', '$2y$10$aAFfSiv971VAU5Hnm2IQg.Y2oL3qgz1recQ4rDRTcWxMAAFgcOy7e', NULL),
(366, 'juan', '$2y$10$JQ5xvbbP2XH375xY9e.rl.5VUbC.XZidZVR2wyXoPoH5HnwEMua4O', 2),
(367, 'juanc', '$2y$10$tND9QWdaeOoRTlVYoiHgb.RLb4H.wGMkG9frWXghS57wphPLgX8yu', 2),
(368, 'juancr', '$2y$10$JDjMqyFomUOUWlidY07Q/O5LD12o2vhDjMN06AtuVHgPE6MDf1B.e', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_proyecto`
--

CREATE TABLE `usuario_proyecto` (
  `id_usuario` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
