-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2021 a las 04:01:53
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trans2071`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `chofer_id` int(11) NOT NULL,
  `chofer_ci` int(11) NOT NULL,
  `chofer_nombre` varchar(200) NOT NULL,
  `chofer_apellidos` varchar(200) NOT NULL,
  `chofer_usuario` varchar(200) NOT NULL,
  `chofer_telefono` int(11) NOT NULL,
  `chofer_nacimiento` date NOT NULL,
  `chofer_categoria` char(2) NOT NULL,
  `chofer_admincion` date NOT NULL,
  `chofer_monto` int(11) NOT NULL,
  `chofer_email` varchar(200) NOT NULL,
  `chofer_rol` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `cliente_cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`chofer_id`, `chofer_ci`, `chofer_nombre`, `chofer_apellidos`, `chofer_usuario`, `chofer_telefono`, `chofer_nacimiento`, `chofer_categoria`, `chofer_admincion`, `chofer_monto`, `chofer_email`, `chofer_rol`, `created_at`, `updated_at`, `cliente_cliente_id`) VALUES
(1, 222222222, 'Damaris', 'Pablos Romaria', 'Damaris', 894984897, '1989-08-10', 'B', '2019-01-01', 200, 'damaris@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 1),
(2, 3333333, 'Homer', 'Simpsons Domson', 'Homer', 8949897, '1979-08-10', 'B', '2019-01-01', 200, 'homer@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 1),
(3, 44444444, 'Abraham', 'Ramos Romaria', 'Ramoario', 89784897, '1989-08-10', 'B', '2019-01-01', 200, 'rams@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 2),
(4, 11111115, 'Miguel', 'colque Chambie', 'miki', 89584897, '1989-08-10', 'B', '2019-01-01', 200, 'mik@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 3),
(5, 1154784, 'Michael', 'Marques Dannam', 'dannam', 6869897, '1989-08-10', 'B', '2019-01-01', 200, 'dannam@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 3),
(6, 88888888, 'Rosses', 'Dilams Chambie', 'dilams', 69684897, '1989-08-10', 'B', '2019-01-01', 200, 'dilam@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 4),
(7, 63668595, 'Monica', 'Quiroga Chambie', 'moni', 69584897, '1989-08-10', 'B', '2019-01-01', 200, 'monai@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 6),
(8, 6666666, 'Fernando', 'Mamani Chambie', 'fercho', 89587897, '1989-08-10', 'B', '2019-01-01', 200, 'fercho@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 3),
(9, 7888888, 'Mario', 'Rivas Chambie', 'Mario', 694897, '1989-08-10', 'B', '2019-01-01', 200, 'mars@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 3),
(10, 245556, 'Rioja', 'Marciano Chambie', 'Mario', 694897, '1985-08-10', 'B', '2019-01-01', 200, 'rioja@gmail.com', 'Chofer', '2021-11-15 02:36:07', '2021-11-15 02:36:07', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer_vehiculo`
--

CREATE TABLE `chofer_vehiculo` (
  `chofer_chofer_id` int(11) NOT NULL,
  `vehiculo_vehiculo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chofer_vehiculo`
--

INSERT INTO `chofer_vehiculo` (`chofer_chofer_id`, `vehiculo_vehiculo_id`) VALUES
(10, 10),
(9, 9),
(8, 8),
(7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_ci` int(11) NOT NULL,
  `cliente_nombre` varchar(100) NOT NULL,
  `cliente_apellidos` varchar(200) NOT NULL,
  `cliente_usuario` varchar(200) NOT NULL,
  `cliente_telefono` int(11) NOT NULL,
  `cliente_nacimiento` date NOT NULL,
  `cliente_categoria` char(2) NOT NULL,
  `cliente_admicion` date NOT NULL,
  `cliente_monto` int(11) NOT NULL,
  `cliente_email` varchar(100) NOT NULL,
  `cliente_rol` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_ci`, `cliente_nombre`, `cliente_apellidos`, `cliente_usuario`, `cliente_telefono`, `cliente_nacimiento`, `cliente_categoria`, `cliente_admicion`, `cliente_monto`, `cliente_email`, `cliente_rol`, `create_at`, `updated_at`) VALUES
(1, 78784878, 'Juan Pablo', 'Marca Salinas', 'Juancho', 77545454, '1992-11-11', 'A', '2020-07-15', 400, 'juan@gmail.com', 'Socio', '2021-11-15 02:16:56', '2021-11-15 02:16:56'),
(2, 78784875, 'Cristian', 'Romero Campos', 'Cris', 7878487, '1992-11-28', 'B', '2019-10-21', 4000, 'crias@gmail.com', 'Socio', '2021-11-15 02:19:14', '2021-11-15 02:19:14'),
(3, 78784879, 'Marco', 'Salinas ', 'Marco', 49498959, '1995-05-25', 'C', '2016-05-25', 2000, 'marco@gmail.com', 'Socio', '2021-11-15 02:21:26', '2021-11-15 02:21:26'),
(4, 84848484, 'Cintia', 'Rosales', 'Rosalia', 98978784, '1993-08-22', 'B', '2019-12-31', 4000, 'rosal@gmail.com', 'Socio', '2021-11-15 02:22:47', '2021-11-15 02:22:47'),
(5, 84848786, 'Alvaro', 'Masial Carbajal', 'alf', 8789848, '1994-02-08', 'B', '2018-02-20', 3000, 'rosal@gmail.com', 'Socio', '2021-11-15 02:24:15', '2021-11-15 02:24:15'),
(6, 87978484, 'Carlos', 'Riveras', 'Cars', 9985978, '1995-12-31', 'B', '2018-04-20', 4000, 'carsl@gmail.com', 'Socio', '2021-11-15 02:27:19', '2021-11-15 02:27:19'),
(7, 84978484, 'Ronal', 'Santos Ramires', 'santos', 99847978, '1998-12-31', 'B', '2017-04-20', 4000, 'santosl@gmail.com', 'Socio', '2021-11-15 02:27:19', '2021-11-15 02:27:19'),
(8, 84912255, 'Richard', 'Ramos Ramires', 'Ramos', 9978788, '1978-12-31', 'B', '2017-04-20', 4000, 'ramos@gmail.com', 'Socio', '2021-11-15 02:27:19', '2021-11-15 02:27:19'),
(9, 666484, 'Joel', 'Carlos Maica', 'Jelo', 9745978, '1985-12-31', 'C', '2017-04-20', 3500, 'joel@gmail.com', 'Socio', '2021-11-15 02:27:19', '2021-11-15 02:27:19'),
(10, 66648458, 'Romaria', 'Cristerl Maica', 'Roam', 97745978, '1984-12-31', 'C', '2017-06-20', 3500, 'romario@gmail.com', 'Socio', '2021-11-15 02:27:19', '2021-11-15 02:27:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_vehiculo`
--

CREATE TABLE `cliente_vehiculo` (
  `cliente_cliente_id` int(11) NOT NULL,
  `vehiculo_vehiculo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente_vehiculo`
--

INSERT INTO `cliente_vehiculo` (`cliente_cliente_id`, `vehiculo_vehiculo_id`) VALUES
(5, 4),
(1, 1),
(2, 2),
(3, 3),
(4, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_dni` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(535) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_estado` varchar(17) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_privilegio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `usuario_privilegio`) VALUES
(1, '1232134356745', 'Richar', 'lapa chavez', '921223114', 'Lima-Peru', 'lasdfla@gmail.com', 'Admin', 'MGkwOGVOYnRrbW1OaHZKUGl4bXpLUT09', 'Activa', 1),
(2, '2342342334', 'Maria', 'castaneda ld', '23452354245', 'sdfsdf', 'edicion@gmail.com', 'Edicion', 'TkNMWjJzL1BibWZQcmFON003Uit5dz09', 'Activa', 2),
(3, '34634563456', 'Registrador', 'register', '098765432', 'dfgsd', 'Registrar@gmail.com', 'Registrar', 'ZzgwUlNPaUFrTFNtNXZrSC9RdEVVUT09', 'Activa', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `vehiculo_id` int(11) NOT NULL,
  `vehiculo_placa` varchar(200) NOT NULL,
  `vehiculo_chasis` varchar(200) NOT NULL,
  `vehiculo_color` varchar(200) NOT NULL,
  `vehiculo_modelo` int(11) NOT NULL,
  `vehiculo_marca` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`vehiculo_id`, `vehiculo_placa`, `vehiculo_chasis`, `vehiculo_color`, `vehiculo_modelo`, `vehiculo_marca`, `create_at`, `updated_at`) VALUES
(1, '1255ALF', '62626590E48484', 'Rojo', 2018, 'Toyota', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(2, '1055CNA', '7846590E48484', 'Blanco', 2018, 'Toyota', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(3, '4115FGA', '77776590E8484', 'Rojo', 2018, 'Nisan', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(4, '865FGA', '22280E8484', 'Amarillo', 2018, 'Nisan', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(5, '5555FGA', '14226590E8484', 'Rojo', 2018, 'Kinj Loung', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(6, '4554FGA', '787487E8484', 'Azul', 2018, 'Kinj Loung', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(7, '24545FGA', '7978784E8484', 'Azul', 2018, 'Kinj Loung', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(8, '45455FGA', '131545548E8484', 'Rosado', 2018, 'Nisan', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(9, '4555FGA', '55255499E8484', 'Rojo', 2018, 'Nisan', '2021-11-15 02:57:49', '2021-11-15 02:57:49'),
(10, '1115FGA', '54544846E8484', 'Rojo', 2018, 'Nisan', '2021-11-15 02:57:49', '2021-11-15 02:57:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_tipo` varchar(100) NOT NULL,
  `venta_monto` double NOT NULL,
  `venta_cantidad` int(11) NOT NULL,
  `venta_descuento` double NOT NULL,
  `venta_total` datetime NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_chofer`
--

CREATE TABLE `venta_chofer` (
  `chofer_chofer_id` int(11) NOT NULL,
  `venta_venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cliente`
--

CREATE TABLE `venta_cliente` (
  `venta_venta_id` int(11) NOT NULL,
  `cliente_cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`chofer_id`),
  ADD KEY `cliente_cliente_id` (`cliente_cliente_id`);

--
-- Indices de la tabla `chofer_vehiculo`
--
ALTER TABLE `chofer_vehiculo`
  ADD KEY `chofer_chofer_id` (`chofer_chofer_id`),
  ADD KEY `vehiculo_vehiculo_id` (`vehiculo_vehiculo_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `cliente_vehiculo`
--
ALTER TABLE `cliente_vehiculo`
  ADD KEY `cliente_cliente_id` (`cliente_cliente_id`),
  ADD KEY `vehiculo_vehiculo_id` (`vehiculo_vehiculo_id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`vehiculo_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`);

--
-- Indices de la tabla `venta_chofer`
--
ALTER TABLE `venta_chofer`
  ADD KEY `chofer_chofer_id` (`chofer_chofer_id`),
  ADD KEY `venta_venta_id` (`venta_venta_id`);

--
-- Indices de la tabla `venta_cliente`
--
ALTER TABLE `venta_cliente`
  ADD KEY `venta_venta_id` (`venta_venta_id`),
  ADD KEY `cliente_cliente_id` (`cliente_cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `chofer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `vehiculo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD CONSTRAINT `chofer_cliente_cliente_cliente_id` FOREIGN KEY (`cliente_cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `chofer_vehiculo`
--
ALTER TABLE `chofer_vehiculo`
  ADD CONSTRAINT `chofer_vehiculo_chofer_chofer_chofer_id` FOREIGN KEY (`chofer_chofer_id`) REFERENCES `chofer` (`chofer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chofer_vehiculo_vehiculo_vehiculo_vehiculo_id` FOREIGN KEY (`vehiculo_vehiculo_id`) REFERENCES `vehiculo` (`vehiculo_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente_vehiculo`
--
ALTER TABLE `cliente_vehiculo`
  ADD CONSTRAINT `cliente_vehiculo_cliente_cliente_cliente_id` FOREIGN KEY (`cliente_cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_vehiculo_vehiculo_vehiculo_vehiculo_id` FOREIGN KEY (`vehiculo_vehiculo_id`) REFERENCES `vehiculo` (`vehiculo_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_chofer`
--
ALTER TABLE `venta_chofer`
  ADD CONSTRAINT `venta_chofer_chofer_chofer_chofer_id` FOREIGN KEY (`chofer_chofer_id`) REFERENCES `chofer` (`chofer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_chofer_venta_venta_venta_id` FOREIGN KEY (`venta_venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_cliente`
--
ALTER TABLE `venta_cliente`
  ADD CONSTRAINT `venta_cliente_cliente_cliente_cliente_id` FOREIGN KEY (`cliente_cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_cliente_venta_venta_venta_id` FOREIGN KEY (`venta_venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;