# tpeweb2
Integrantes:
Nombre y apellido: Juan Cruz Geiersberg

Email: juancruzgeiersberg@gmail.com

Nombre y apellido: Maykel Stiven Tvihaug Alvarez

Email: maytvi33@gmail.com

Grupo: N°: 108

Tutor:
Nombre y apellido: Nico l

Temática: Aplicación de Gestión de proyectos.

Descripción Temática: Crear una aplicación que gestiona los proyectos permitiendo crear, editar, eliminar un proyecto y agregar otros participantes al mismo, poder ver los proyectos que uno haya creado y en los que está participando.

DER: puesto en repositorio como DER.png.:![image](https://github.com/juancruzgeiersberg/tpeweb2/assets/103091587/98e53406-b5d4-42b7-8fc9-8fd9875c9804)


SQL de la BDD en PhpMyAdmin: (el archivo se encuentra "gestiondedatos.sql" dentro del repositorio)

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2023 a las 03:14:22
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `id_usuario`) VALUES
(2, 'TPE Web 2', 'Terminar la parte final del tpe', 366),
(3, 'TPE Prog 2', 'Terminar la parte final del tpe', 366),
(4, 'TPE TIO', 'Terminar la parte final del tpe', 366),
(5, 'TPE Ingles', 'Terminar la parte final del tpe', 366),
(6, 'Página Web', 'Crear una página web de deportes', 367),
(7, 'eSports', 'Crear una página web de eSports', 367),
(8, 'Cocina', 'Preparar la comida', 367),
(9, 'Clima', 'Página web del clima', 367),
(12, 'hfthfh', '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `contraseña`, `id_rol`) VALUES
(6, 'Miki', '$2y$10$HHYoZ/FyRmaVAk9bUpQwu.lJkSN7d4LPYXsAnSO9SFNVxfyDDwp3K', 1),
(7, 'mike', '$2y$10$aAFfSiv971VAU5Hnm2IQg.Y2oL3qgz1recQ4rDRTcWxMAAFgcOy7e', 2),
(366, 'juan', '$2y$10$JQ5xvbbP2XH375xY9e.rl.5VUbC.XZidZVR2wyXoPoH5HnwEMua4O', 2),
(367, 'juanc', '$2y$10$tND9QWdaeOoRTlVYoiHgb.RLb4H.wGMkG9frWXghS57wphPLgX8yu', 2),
(368, 'carl12', '$2y$10$HVt9329saj00lmWex9mUJuDBm19qBxTwJ7uVduhIPDqBzqS8l9Q7O', 2);

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
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

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
