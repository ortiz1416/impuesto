-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 04:41:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `impuestos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avaluos`
--

CREATE TABLE `avaluos` (
  `id` int(11) NOT NULL,
  `avaluo` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avaluos`
--

INSERT INTO `avaluos` (`id`, `avaluo`) VALUES
(1, 0.2),
(2, 0.3),
(3, 0.4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cilindrada`
--

CREATE TABLE `cilindrada` (
  `id` int(11) NOT NULL,
  `cilindrada` varchar(30) NOT NULL,
  `id_tp_vehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cilindrada`
--

INSERT INTO `cilindrada` (`id`, `cilindrada`, `id_tp_vehiculo`) VALUES
(1, '125', 2),
(2, '150', 2),
(4, '180', 2),
(6, '2100', 1),
(11, '2500', 1),
(12, '3000', 1),
(14, '4000', 3),
(15, '6000', 3),
(16, '9000', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(11) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `color`) VALUES
(1, 'Rojo'),
(2, 'Verde'),
(3, 'Azul'),
(4, 'Amarillo'),
(5, 'Púrpura'),
(6, 'Naranja'),
(7, 'Rosa'),
(8, 'Marrón'),
(9, 'Negro'),
(10, 'Blanco'),
(11, 'Gris'),
(12, 'Violeta'),
(13, 'Índigo'),
(14, 'Turquesa'),
(15, 'Plata'),
(16, 'Oro'),
(17, 'Beige'),
(18, 'Granate'),
(19, 'Cian'),
(20, 'Magenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `id` int(11) NOT NULL,
  `combustibles` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`id`, `combustibles`) VALUES
(1, 'gasolina'),
(2, 'ACPM'),
(3, 'Gas'),
(4, 'Electrico'),
(5, 'Biodiésel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'por pagar'),
(2, 'pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `id_valor` int(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impuesto`
--

INSERT INTO `impuesto` (`id`, `placa`, `id_valor`, `fecha_ini`, `fecha_fin`, `id_estado`) VALUES
(77, 'MJU900', 487430, '2015-03-03', '2018-03-02', 2),
(78, 'MJU900', 487430, '2018-03-03', '2021-03-02', 2),
(79, 'MJU900', 487430, '2021-03-03', '2024-03-02', 2),
(80, 'MJU900', 487430, '2024-03-03', '2027-03-02', 2),
(81, 'HMM12T', 316200, '2011-02-05', '2016-02-04', 2),
(82, 'HMM12T', 316200, '2016-02-05', '2021-02-04', 2),
(83, 'HMM12T', 316200, '2021-02-05', '2026-02-04', 2),
(84, 'KLI45J', 316200, '2006-06-07', '2011-06-06', 2),
(85, 'KLI45J', 316200, '2011-06-07', '2016-06-06', 2),
(86, 'KLI45J', 316200, '2016-06-07', '2021-06-06', 2),
(87, 'KLI45J', 316200, '2021-06-07', '2026-06-06', 1),
(88, 'JJJ234', 415700, '2003-02-20', '2006-02-19', 2),
(89, 'JJJ234', 415700, '2006-02-20', '2009-02-19', 2),
(90, 'JJJ234', 415700, '2009-02-20', '2012-02-19', 2),
(91, 'JJJ234', 415700, '2012-02-20', '2015-02-19', 1),
(92, 'JJJ234', 415700, '2015-02-20', '2018-02-19', 1),
(93, 'JJJ234', 415700, '2018-02-20', '2021-02-19', 1),
(94, 'JJJ234', 415700, '2021-02-20', '2024-02-19', 1),
(95, 'JJJ234', 415700, '2024-02-20', '2027-02-19', 1),
(96, 'FGJ552', 593100, '2004-06-23', '2007-06-22', 2),
(97, 'FGJ552', 593100, '2007-06-23', '2010-06-22', 2),
(98, 'FGJ552', 593100, '2010-06-23', '2013-06-22', 1),
(99, 'FGJ552', 593100, '2013-06-23', '2016-06-22', 1),
(100, 'FGJ552', 593100, '2016-06-23', '2019-06-22', 1),
(101, 'FGJ552', 593100, '2019-06-23', '2022-06-22', 1),
(102, 'FGJ552', 593100, '2022-06-23', '2025-06-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `id_tp_vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`, `id_tp_vehiculo`) VALUES
(1, 'Honda', 2),
(3, 'Suzuki', NULL),
(7, 'Yamaha', NULL),
(9, 'Toyota', NULL),
(10, 'Ford', NULL),
(11, 'Nissan', NULL),
(12, 'Iveco', NULL),
(13, 'Kenworth', NULL),
(14, 'Peterbilt', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `modelo`) VALUES
(2, '2000'),
(3, '2001'),
(5, '2002'),
(6, '2003'),
(7, '2004'),
(8, '2005'),
(9, '2006'),
(10, '2007'),
(11, '2008'),
(12, '2009'),
(13, '2010'),
(14, '2011'),
(15, '2012'),
(16, '2013'),
(17, '2014'),
(18, '2015'),
(19, '2016'),
(20, '2017'),
(21, '2018'),
(22, '2019'),
(23, '2020'),
(24, '2021'),
(25, '2022'),
(26, '2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` int(11) NOT NULL,
  `valor` int(20) NOT NULL,
  `id_tip_vehiculo` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `valor`, `id_tip_vehiculo`, `id_modelo`) VALUES
(1, 316200, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tp_usuario`
--

CREATE TABLE `tp_usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tp_usuario`
--

INSERT INTO `tp_usuario` (`id`, `user`) VALUES
(1, 'propietario'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tp_vehiculos`
--

CREATE TABLE `tp_vehiculos` (
  `id` int(11) NOT NULL,
  `vehiculos` varchar(20) NOT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `tp_combustible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tp_vehiculos`
--

INSERT INTO `tp_vehiculos` (`id`, `vehiculos`, `peso`, `tp_combustible`) VALUES
(1, 'Automovil', '', 0),
(2, 'Moto', '', 1),
(3, 'camion', '', 2),
(4, 'Camion ', '2 toneladas', 2),
(5, 'Camion ', '2.1 tonelada a 5 ', 2),
(6, 'Camion ', '5.1 toneladas o mas', 2),
(7, 'carros', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tp_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `nombres`, `apellidos`, `correo`, `Telefono`, `password`, `tp_user`) VALUES
(1005911563, 'Jennifer', 'Ortiz', 'ortiztatiana1416@gmail.com', '3114409126', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 2),
(1109000445, 'carlos fernando', 'vargas ', 'juan@gmail.com', '3126654315', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `id` int(11) NOT NULL,
  `valor` int(50) NOT NULL,
  `id_tp_vehiculos` int(11) NOT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `id_modelo_hasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`id`, `valor`, `id_tp_vehiculos`, `id_modelo`, `id_modelo_hasta`) VALUES
(2, 328900, 1, 2, 2),
(3, 415700, 1, 3, 13),
(4, 487430, 1, 14, 26),
(13, 410500, 3, 2, 2),
(14, 500800, 5, 3, 13),
(15, 593100, 6, 3, 14),
(17, 205650, 2, 2, 2),
(19, 316200, 2, 3, 13),
(20, 578200, 2, 14, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `placa` varchar(10) NOT NULL,
  `marca` int(11) NOT NULL,
  `modelo` int(20) NOT NULL,
  `propietario` int(11) NOT NULL,
  `cilindrada` int(11) NOT NULL,
  `n_motor` varchar(50) NOT NULL,
  `n_chasis` varchar(50) NOT NULL,
  `tp_vehiculo` int(11) NOT NULL,
  `capacidad` varchar(30) NOT NULL,
  `combustible` int(11) NOT NULL,
  `id_color` int(20) NOT NULL,
  `id_avaluo` int(11) NOT NULL,
  `linea` varchar(50) NOT NULL,
  `f_matricula` date NOT NULL,
  `estado` int(11) NOT NULL,
  `valor` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`placa`, `marca`, `modelo`, `propietario`, `cilindrada`, `n_motor`, `n_chasis`, `tp_vehiculo`, `capacidad`, `combustible`, `id_color`, `id_avaluo`, `linea`, `f_matricula`, `estado`, `valor`) VALUES
('FGJ552', 14, 6, 1109000445, 16, 'mcejrnfdmgj5515', 'cmkjgnj165651', 6, '3', 2, 2, 2, 'lok', '2004-06-23', 1, 120000000),
('JJJ234', 11, 5, 1109000445, 14, 'kmdfknvkdf1564', 'bsdfjbdjf1346323', 1, '4', 2, 6, 3, 'fer', '2003-02-20', 1, 50000000),
('MJU900', 4, 18, 1109000445, 6, '56hdydh5451', '56hdgdtbd51', 1, '5 pasajeros', 4, 15, 2, 'Bio saludable', '2015-03-03', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avaluos`
--
ALTER TABLE `avaluos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cilindrada`
--
ALTER TABLE `cilindrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `placa` (`placa`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `placa` (`id_tip_vehiculo`),
  ADD KEY `id_modelo` (`id_modelo`);

--
-- Indices de la tabla `tp_usuario`
--
ALTER TABLE `tp_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tp_vehiculos`
--
ALTER TABLE `tp_vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `tp_user` (`tp_user`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tp_vehiculos` (`id_tp_vehiculos`),
  ADD KEY `id_modelo_hasta` (`id_modelo_hasta`),
  ADD KEY `id_modelo` (`id_modelo`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `propietario` (`propietario`),
  ADD KEY `marca` (`marca`),
  ADD KEY `cilindrada` (`cilindrada`),
  ADD KEY `tp_vehiculo` (`tp_vehiculo`),
  ADD KEY `combustible` (`combustible`),
  ADD KEY `estado` (`estado`),
  ADD KEY `id_color` (`id_color`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avaluos`
--
ALTER TABLE `avaluos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cilindrada`
--
ALTER TABLE `cilindrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `combustible`
--
ALTER TABLE `combustible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tp_usuario`
--
ALTER TABLE `tp_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tp_vehiculos`
--
ALTER TABLE `tp_vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
