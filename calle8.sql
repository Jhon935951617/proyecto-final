-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2024 a las 04:12:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calle8`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id`, `nombre`, `apellidos`, `usuario`, `password`) VALUES
(1, 'Janne', 'Mateo', 'janne', 'mateo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `urlImagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `precio`, `urlImagen`) VALUES
(2, 'Lomo Saltado', '20.00', 'https://i.ytimg.com/vi/sWXRJbGi6yQ/maxresdefault.jpg'),
(3, 'Bisteck de Res', '23.00', 'https://i.ytimg.com/vi/FcM0U_dm44A/maxresdefault.jpg'),
(7, 'Pure con Asado', '15.00', 'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/HICZSOBHXVB6BJH3TVDDST6MNM.jpg'),
(8, 'Ensalada Rusa', '15.00', 'https://i0.wp.com/cocinenconmigo.com/wp-content/uploads/2021/07/Ensalada-Remolacha-1.jpg?fit=1200%2C800&ssl=1'),
(9, 'Arroz con pollo', '7.00', 'https://imgmedia.buenazo.pe/1200x660/buenazo/original/2022/10/24/60d89da6913c240e6725db08.jpg'),
(10, 'Arroz chaufa', '7.00', 'https://imgmedia.buenazo.pe/650x358/buenazo/original/2020/11/17/5fb44c9e5ee11209bc2b1b5e.jpg'),
(11, 'Ceviche', '15.00', 'https://imag.bonviveur.com/ceviche-peruano-de-pescado.jpg'),
(12, 'Picante de Cuy', '25.00', 'https://www.unarecetaperuana.com/wp-content/uploads/2022/07/picante-de-cuy-peruano.jpg'),
(13, 'Pachamanca al Horno', '17.00', 'https://i.ytimg.com/vi/u9AMJGOF26g/maxresdefault.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(80) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cliente`, `id_menu`, `cantidad`, `subtotal`, `fecha`) VALUES
(2, 'Jhon', 3, 2, '46.00', '2024-07-24'),
(4, 'Jhon', 7, 1, '15.00', '2024-07-24'),
(5, 'Janne', 2, 1, '20.00', '2024-07-24'),
(9, 'Janne', 2, 1, '20.00', '2024-07-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
