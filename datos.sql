-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2017 a las 05:18:23
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

--
-- Volcado de datos para la tabla `cargos_usuarios`
--

INSERT INTO `cargos_usuarios` (`codigo_cargo`, `cargo_usuario`, `permiso_agregar_vehiculos`, `permiso_agregar_usuario`, `permiso_datos_estadisticos`, `permiso_agregar_promociones`, `permiso_facturar`, `permiso_modificar_cliente`, `permiso_modificar_usuario`) VALUES
(1, 'Administrador', 1, 1, 1, 1, 1, 1, 1);

--
-- Volcado de datos para la tabla `tipos_fotos`
--

INSERT INTO `tipos_fotos` (`codigo_tipo_foto`, `tipo_foto`) VALUES
(2, 'Galeria'),
(1, 'Perfil'),
(3, 'Slider');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
