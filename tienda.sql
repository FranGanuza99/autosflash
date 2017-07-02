-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2017 a las 00:12:22
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--
CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos_usuarios`
--

CREATE TABLE `cargos_usuarios` (
  `codigo_cargo` int(11) UNSIGNED NOT NULL,
  `cargo_usuario` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permiso_agregar_vehiculos` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_agregar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_datos_estadisticos` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_agregar_promociones` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_facturar` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_modificar_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `permiso_modificar_usuario` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codigo_cliente` int(11) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_cliente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dui_cliente` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit_cliente` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_cliente` int(8) UNSIGNED NOT NULL,
  `correo_cliente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasenia` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro_cliente` date NOT NULL,
  `direccion_cliente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_cliente` tinyint(1) NOT NULL DEFAULT '1',
  `foto` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `codigo_comentario` int(10) UNSIGNED NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `codigo_cliente` int(10) UNSIGNED NOT NULL,
  `codigo_vehiculo` int(10) UNSIGNED NOT NULL,
  `estado_comentario` tinyint(1) NOT NULL DEFAULT '1',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `codigo_contacto` int(10) UNSIGNED NOT NULL,
  `nombre_contacto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_contacto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `correo_contacto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mensaje` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `codigo_factura` int(11) UNSIGNED NOT NULL,
  `codigo_cliente` int(10) UNSIGNED NOT NULL,
  `codigo_vehiculo` int(10) UNSIGNED NOT NULL,
  `fecha_factura` date NOT NULL,
  `codigo_usuario` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_vehiculos`
--

CREATE TABLE `fotos_vehiculos` (
  `codigo_foto` int(11) UNSIGNED NOT NULL,
  `codigo_vehiculo` int(11) UNSIGNED NOT NULL,
  `codigo_tipo_foto` int(11) UNSIGNED NOT NULL,
  `url_foto` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `codigo_marca` int(11) UNSIGNED NOT NULL,
  `marca` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `codigo_modelo` int(11) UNSIGNED NOT NULL,
  `nombre_modelo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_serie` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `codigo_proveedor` int(11) UNSIGNED NOT NULL,
  `nombre_proveedor` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto_proveedor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_proveedor` int(15) UNSIGNED NOT NULL,
  `direccion_provedor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `codigo_reserva` int(11) UNSIGNED NOT NULL,
  `codigo_cliente` int(11) UNSIGNED NOT NULL,
  `codigo_vehiculo` int(11) UNSIGNED NOT NULL,
  `fecha_reserva` date NOT NULL,
  `estado_reserva` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `codigo_serie` int(11) UNSIGNED NOT NULL,
  `nombre_serie` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_marca` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_fotos`
--

CREATE TABLE `tipos_fotos` (
  `codigo_tipo_foto` int(11) UNSIGNED NOT NULL,
  `tipo_foto` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_vehiculos`
--

CREATE TABLE `tipos_vehiculos` (
  `codigo_tipo_vehiculo` int(11) UNSIGNED NOT NULL,
  `tipo_vehiculo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo_usuario` int(11) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasenia_usuario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `codigo_cargo` int(11) UNSIGNED NOT NULL,
  `url_foto` mediumblob,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `codigo_valoracion` int(10) UNSIGNED NOT NULL,
  `codigo_vehiculo` int(10) UNSIGNED NOT NULL,
  `codigo_cliente` int(10) UNSIGNED NOT NULL,
  `valoracion` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `codigo_vehiculo` int(11) UNSIGNED NOT NULL,
  `nombre_vehiculo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_vehiculo` decimal(8,2) UNSIGNED NOT NULL,
  `descripcion_vehiculo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro_vehiculo` date NOT NULL,
  `codigo_tipo_vehiculo` int(11) UNSIGNED NOT NULL,
  `codigo_proveedor` int(11) UNSIGNED NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `codigo_modelo` int(11) UNSIGNED NOT NULL,
  `anio_vehiculo` int(4) NOT NULL,
  `potencia_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manejo_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rueda_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comodida_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apariencia_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ventana_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `general1_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `general2_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `general3_vehiculo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descuento_vehiculo` int(2) UNSIGNED NOT NULL DEFAULT '0',
  `estado_vehiculo` tinyint(1) NOT NULL DEFAULT '1',
  `foto_general1` mediumblob,
  `foto_general2` mediumblob,
  `foto_general3` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  ADD PRIMARY KEY (`codigo_cargo`),
  ADD UNIQUE KEY `cargo_usuario` (`cargo_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigo_cliente`),
  ADD UNIQUE KEY `dui_cliente` (`dui_cliente`),
  ADD UNIQUE KEY `nit_cliente` (`nit_cliente`),
  ADD UNIQUE KEY `telefono_cliente` (`telefono_cliente`),
  ADD UNIQUE KEY `correo_cliente` (`correo_cliente`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`codigo_comentario`),
  ADD KEY `id_cliente` (`codigo_cliente`),
  ADD KEY `id_vehiculo` (`codigo_vehiculo`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`codigo_contacto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`codigo_factura`),
  ADD KEY `codigo_usuario` (`codigo_usuario`),
  ADD KEY `codigo_cliente` (`codigo_cliente`),
  ADD KEY `codigo_vehiculio` (`codigo_vehiculo`);

--
-- Indices de la tabla `fotos_vehiculos`
--
ALTER TABLE `fotos_vehiculos`
  ADD PRIMARY KEY (`codigo_foto`),
  ADD KEY `codigo_vehiculo` (`codigo_vehiculo`),
  ADD KEY `codigo_tipo_foto` (`codigo_tipo_foto`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`codigo_marca`),
  ADD UNIQUE KEY `marca` (`marca`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`codigo_modelo`),
  ADD UNIQUE KEY `nombre_modelo` (`nombre_modelo`),
  ADD KEY `codigo_serie` (`codigo_serie`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codigo_proveedor`),
  ADD UNIQUE KEY `nombre_proveedor` (`nombre_proveedor`),
  ADD UNIQUE KEY `contacto_proveedor` (`contacto_proveedor`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`codigo_reserva`),
  ADD KEY `codigo_cliente` (`codigo_cliente`),
  ADD KEY `codigo_vehiculo` (`codigo_vehiculo`),
  ADD KEY `codigo_cliente_2` (`codigo_cliente`),
  ADD KEY `codigo_vehiculo_2` (`codigo_vehiculo`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`codigo_serie`),
  ADD UNIQUE KEY `nombre_serie` (`nombre_serie`),
  ADD KEY `codigo_marca` (`codigo_marca`);

--
-- Indices de la tabla `tipos_fotos`
--
ALTER TABLE `tipos_fotos`
  ADD PRIMARY KEY (`codigo_tipo_foto`),
  ADD UNIQUE KEY `tipo_foto` (`tipo_foto`);

--
-- Indices de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  ADD PRIMARY KEY (`codigo_tipo_vehiculo`),
  ADD UNIQUE KEY `tipo_vehiculo` (`tipo_vehiculo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `codigo_cargo` (`codigo_cargo`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`codigo_valoracion`),
  ADD KEY `codigo_vehiculo` (`codigo_vehiculo`),
  ADD KEY `codigo_cliente` (`codigo_cliente`),
  ADD KEY `valoracion` (`valoracion`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`codigo_vehiculo`),
  ADD UNIQUE KEY `nombre__vehiculo` (`nombre_vehiculo`),
  ADD KEY `codigo_tipo_vehiculo` (`codigo_tipo_vehiculo`),
  ADD KEY `codigo_proveedor` (`codigo_proveedor`),
  ADD KEY `codigo_modelo` (`codigo_modelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  MODIFY `codigo_cargo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codigo_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `codigo_comentario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `codigo_contacto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `codigo_factura` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `fotos_vehiculos`
--
ALTER TABLE `fotos_vehiculos`
  MODIFY `codigo_foto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `codigo_marca` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `codigo_modelo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `codigo_proveedor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `codigo_reserva` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `codigo_serie` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipos_fotos`
--
ALTER TABLE `tipos_fotos`
  MODIFY `codigo_tipo_foto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  MODIFY `codigo_tipo_vehiculo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `codigo_valoracion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `codigo_vehiculo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`codigo_vehiculo`) REFERENCES `vehiculos` (`codigo_vehiculo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`codigo_cliente`) REFERENCES `clientes` (`codigo_cliente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`codigo_usuario`) REFERENCES `usuarios` (`codigo_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`codigo_cliente`) REFERENCES `clientes` (`codigo_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_4` FOREIGN KEY (`codigo_vehiculo`) REFERENCES `vehiculos` (`codigo_vehiculo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos_vehiculos`
--
ALTER TABLE `fotos_vehiculos`
  ADD CONSTRAINT `fotos_vehiculos_ibfk_1` FOREIGN KEY (`codigo_vehiculo`) REFERENCES `vehiculos` (`codigo_vehiculo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fotos_vehiculos_ibfk_2` FOREIGN KEY (`codigo_tipo_foto`) REFERENCES `tipos_fotos` (`codigo_tipo_foto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`codigo_serie`) REFERENCES `series` (`codigo_serie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`codigo_vehiculo`) REFERENCES `vehiculos` (`codigo_vehiculo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservaciones_ibfk_3` FOREIGN KEY (`codigo_cliente`) REFERENCES `clientes` (`codigo_cliente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`codigo_marca`) REFERENCES `marcas` (`codigo_marca`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`codigo_cargo`) REFERENCES `cargos_usuarios` (`codigo_cargo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`codigo_cliente`) REFERENCES `clientes` (`codigo_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`codigo_vehiculo`) REFERENCES `vehiculos` (`codigo_vehiculo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`codigo_tipo_vehiculo`) REFERENCES `tipos_vehiculos` (`codigo_tipo_vehiculo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`codigo_proveedor`) REFERENCES `proveedores` (`codigo_proveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`codigo_modelo`) REFERENCES `modelos` (`codigo_modelo`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
