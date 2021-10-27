-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2021 a las 00:00:29
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_rocio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cat_id` bigint(20) NOT NULL,
  `cat_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cl_id` bigint(20) NOT NULL,
  `cl_cliente` varchar(40) NOT NULL,
  `cl_documento` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `fact_id` bigint(20) NOT NULL,
  `id_pedido` varchar(20) NOT NULL,
  `id_cliente` varchar(30) NOT NULL,
  `id_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `ord_id` int(11) NOT NULL,
  `ord_mesa` int(11) NOT NULL,
  `ord_valor` int(11) NOT NULL,
  `ord_fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ped_id` bigint(20) UNSIGNED NOT NULL,
  `ped_orden` varchar(11) NOT NULL,
  `ped_producto` varchar(11) NOT NULL,
  `ped_cantidad` varchar(11) NOT NULL,
  `ped_valor` varchar(11) NOT NULL,
  `usuario_id` varchar(20) NOT NULL,
  `cliente_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `prod_nombre` varchar(255) NOT NULL,
  `prod_descripcion` varchar(255) NOT NULL,
  `prod_precio` varchar(20) NOT NULL,
  `prod_categoria` varchar(20) NOT NULL,
  `prod_existencia` varchar(20) NOT NULL,
  `prod_imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `prov_id` bigint(20) UNSIGNED NOT NULL,
  `prov_proveedor` varchar(40) NOT NULL,
  `prov_direccion` varchar(20) NOT NULL,
  `prov_correo` varchar(50) NOT NULL,
  `prov_contacto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` bigint(20) NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` bigint(20) UNSIGNED NOT NULL,
  `usu_nombre_completo` varchar(40) NOT NULL,
  `usu_direccion` varchar(20) NOT NULL,
  `usu_correo` varchar(50) NOT NULL,
  `usu_contacto` varchar(20) NOT NULL,
  `usu_usuario` varchar(20) NOT NULL,
  `usu_contraseña` varchar(20) NOT NULL,
  `usu_rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
