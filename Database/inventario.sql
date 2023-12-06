-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2023 a las 05:37:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `year` float NOT NULL,
  `entrada` float NOT NULL,
  `salida` float NOT NULL,
  `stock` float NOT NULL,
  `costo` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_repuesto`, `id_marca`, `id_modelo`, `year`, `entrada`, `salida`, `stock`, `costo`, `fecha`) VALUES
(23, 6, 16, 14, 2000, 200, 150, 50, 200, '2023-12-09'),
(24, 6, 17, 15, 2012, 100, 0, 100, 200, '2023-12-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_vehiculo`
--

CREATE TABLE `marca_vehiculo` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca_vehiculo`
--

INSERT INTO `marca_vehiculo` (`id_marca`, `marca`) VALUES
(2, '  Nissan'),
(4, 'Honda'),
(5, 'Ford'),
(10, 'Subaru'),
(16, 'Mitsubishi'),
(17, 'Chevrolet'),
(18, 'Mazda'),
(19, 'BMW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_vehiculo`
--

CREATE TABLE `modelo_vehiculo` (
  `id_modelo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo_vehiculo`
--

INSERT INTO `modelo_vehiculo` (`id_modelo`, `id_marca`, `modelo`) VALUES
(14, 16, '   Lancer'),
(15, 17, 'Camaro'),
(18, 19, 'M3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_repuesto`
--

CREATE TABLE `tipo_repuesto` (
  `id_repuesto` int(11) NOT NULL,
  `tipo_repuesto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_repuesto`
--

INSERT INTO `tipo_repuesto` (`id_repuesto`, `tipo_repuesto`) VALUES
(6, '  Radiador1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `Nombre`, `Apellido`, `usuario`, `password`) VALUES
(1, 'Admin', 'Admin', 'admin', '202cb962ac59075b964b07152d234b70'),
(2, 'Alessandro', 'Mata', 'Alessandro', '202cb962ac59075b964b07152d234b70'),


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_vehiculo` (`id_marca`),
  ADD KEY `id_modelo` (`id_modelo`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `tipo_repuesto`
--
ALTER TABLE `tipo_repuesto`
  ADD PRIMARY KEY (`id_repuesto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_repuesto`
--
ALTER TABLE `tipo_repuesto`
  MODIFY `id_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_repuesto`) REFERENCES `tipo_repuesto` (`id_repuesto`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_modelo`) REFERENCES `modelo_vehiculo` (`id_modelo`),
  ADD CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `marca_vehiculo` (`id_marca`);

--
-- Filtros para la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  ADD CONSTRAINT `modelo_vehiculo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca_vehiculo` (`id_marca`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
