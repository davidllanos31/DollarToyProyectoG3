-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 20:21:43
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
-- Base de datos: `db_dollartoy`
--
CREATE DATABASE IF NOT EXISTS `db_dollartoy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_dollartoy`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_cliente` (IN `p_id_cliente` INT, IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(50), IN `p_email` VARCHAR(50))   BEGIN
    IF p_id_cliente = 0 THEN
        INSERT INTO tb_cliente (nombre, apellido, email, fecha_registro)
        VALUES (p_nombre, p_apellido, p_email, NOW());

    ELSE
        UPDATE tb_cliente
        SET nombre = p_nombre,
            apellido = p_apellido,
            email = p_email
        WHERE id_cliente = p_id_cliente;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_detalle_venta` (IN `p_id_detalle_venta` INT, IN `p_id_venta` INT, IN `p_id_producto` INT, IN `p_cantidad` INT, IN `p_precio_unitario` FLOAT)   BEGIN
    IF p_id_detalle_venta = 0 THEN
        INSERT INTO tb_detalle_venta (id_venta, id_producto, cantidad, precio_unitario)
        VALUES (p_id_venta, p_id_producto, p_cantidad, p_precio_unitario);
    ELSE
        UPDATE tb_detalle_venta
        SET id_venta = p_id_venta,
            id_producto = p_id_producto,
            cantidad = p_cantidad,
            precio_unitario = p_precio_unitario
        WHERE id_detalle_venta = p_id_detalle_venta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_metodo_pago` (IN `p_id_metodopago` INT, IN `p_nombre` VARCHAR(50))   BEGIN
    IF p_id_metodopago = 0 THEN
        INSERT INTO tb_metodo_pago (nombre)
        VALUES (p_nombre);

    ELSE
        UPDATE tb_metodo_pago
        SET nombre = p_nombre
        WHERE id_metodopago = p_id_metodopago;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_producto` (IN `p_id_producto` INT, IN `p_nombre` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_precio` DECIMAL(10,2), IN `p_imagen` VARCHAR(255), IN `p_id_categoria_producto` INT, IN `p_id_sede` INT, IN `p_stock_disponible` INT)   BEGIN
    DECLARE v_id_producto INT;

    -- Si p_id_producto es 0, significa que es una creación
    IF p_id_producto = 0 THEN
        INSERT INTO tb_producto (nombre, descripcion, precio, imagen_url, id_categoria_producto)
        VALUES (p_nombre, p_descripcion, p_precio, p_imagen, p_id_categoria_producto);
        
        SET v_id_producto = LAST_INSERT_ID();

    ELSE
        UPDATE tb_producto
        SET nombre = p_nombre,
            descripcion = p_descripcion,
            precio = p_precio,
            imagen_url = p_imagen,  -- Actualiza la imagen si existe
            id_categoria_producto = p_id_categoria_producto
        WHERE id_producto = p_id_producto;
        
        SET v_id_producto = p_id_producto;
    END IF;

    -- Actualiza o inserta en la tabla intermedia tb_sede_producto
    INSERT INTO tb_sedeproducto (id_producto, id_sede, stock_disponible)
    VALUES (v_id_producto, p_id_sede, p_stock_disponible)
    ON DUPLICATE KEY UPDATE stock_disponible = p_stock_disponible;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_rol` (IN `p_id_rol` INT, IN `p_nombre` VARCHAR(50))   BEGIN
    IF p_id_rol = 0 THEN
        INSERT INTO tb_rol (nombre)
        VALUES (p_nombre);

    ELSE
        UPDATE tb_rol
        SET nombre = p_nombre
        WHERE id_rol = p_id_rol;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_sede` (IN `p_id_sede` INT, IN `p_nombre` VARCHAR(100), IN `p_direccion` VARCHAR(255), IN `p_ciudad` VARCHAR(100))   BEGIN
    IF p_id_sede = 0 THEN
        INSERT INTO tb_sedes (nombre, direccion, ciudad)
        VALUES (p_nombre, p_direccion, p_ciudad);

    ELSE
        UPDATE tb_sedes
        SET nombre = p_nombre,
            direccion = p_direccion,
            ciudad = p_ciudad
        WHERE id_sede = p_id_sede;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_usuario` (IN `p_id_usuario` INT, IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(50), IN `p_email` VARCHAR(50), IN `p_celular` INT, IN `p_contraseña` VARCHAR(100), IN `p_id_usuario_rol` INT)   BEGIN
    IF p_id_usuario = 0 THEN
        INSERT INTO tb_usuario (nombre, apellido, email, celular, contraseña, fecha_registro, id_usuario_rol)
        VALUES (p_nombre, p_apellido, p_email, p_celular, SHA2(p_contraseña, 256), NOW(), p_id_usuario_rol);

    ELSE
        UPDATE tb_usuario
        SET nombre = p_nombre,
            apellido = p_apellido,
            email = p_email,
            celular = p_celular,
            id_usuario_rol = p_id_usuario_rol
        WHERE id_usuario = p_id_usuario;

        IF p_contraseña IS NOT NULL AND p_contraseña != '' THEN
            UPDATE tb_usuario
            SET contraseña = SHA2(p_contraseña, 256)
            WHERE id_usuario = p_id_usuario;
        END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_venta` (IN `p_id_venta` INT, IN `p_id_usuario` INT, IN `p_cliente` VARCHAR(255), IN `p_fecha_venta` DATE, IN `p_id_metodopago` INT, IN `p_total` DECIMAL(10,2))   BEGIN
    IF p_id_venta = 0 THEN
        INSERT INTO tb_venta (id_venta_usuario, cliente, fecha_venta, id_metodopago_venta, total)
        VALUES (p_id_usuario, p_cliente, p_fecha_venta, p_id_metodopago, p_total);
        
        SELECT LAST_INSERT_ID() INTO p_id_venta; -- Obtener el ID generado
    ELSE
        UPDATE tb_venta
        SET id_venta_usuario = p_id_usuario,
            cliente = p_cliente,
            fecha_venta = p_fecha_venta,
            id_metodopago_venta = p_id_metodopago,
            total = p_total
        WHERE id_venta = p_id_venta;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_categoria` (IN `p_id_categoria` INT, IN `p_nombre` VARCHAR(255))   BEGIN
    SELECT 
        c.id_categoria,
        c.nombre,
        c.descripcion
    FROM 
        tb_categoria c
    WHERE
        (p_id_categoria IS NULL OR c.id_categoria = p_id_categoria) AND
        (p_nombre IS NULL OR c.nombre LIKE CONCAT('%', p_nombre, '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_cliente` (IN `p_id_cliente` INT, IN `p_nombre` VARCHAR(255), IN `p_apellido` VARCHAR(255), IN `p_email` VARCHAR(255))   BEGIN
    SELECT 
        c.id_cliente,
        c.nombre, 
        c.apellido, 
        c.email, 
        DATE(c.fecha_registro) AS fecha_registro
    FROM 
        tb_cliente c
    WHERE 
        (p_id_cliente IS NULL OR c.id_cliente = p_id_cliente) AND
        (p_nombre IS NULL OR c.nombre LIKE CONCAT('%', p_nombre, '%')) AND
        (p_apellido IS NULL OR c.apellido LIKE CONCAT('%', p_apellido, '%')) AND
        (p_email IS NULL OR c.email LIKE CONCAT('%', p_email, '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_detalle_venta` (IN `p_id_detalle_venta` INT, IN `p_id_venta` INT, IN `p_id_producto` INT, IN `p_cantidad_min` INT, IN `p_cantidad_max` INT, IN `p_precio_unitario_min` FLOAT, IN `p_precio_unitario_max` FLOAT)   BEGIN
    SELECT 
        dv.id_detalle_venta,
        dv.id_venta,
        dv.id_producto,
        dv.cantidad,
        dv.precio_unitario
    FROM 
        tb_detalle_venta dv
    WHERE
        (p_id_detalle_venta IS NULL OR dv.id_detalle_venta = p_id_detalle_venta) AND
        (p_id_venta IS NULL OR dv.id_venta = p_id_venta) AND
        (p_id_producto IS NULL OR dv.id_producto = p_id_producto) AND
        (p_cantidad_min IS NULL OR dv.cantidad >= p_cantidad_min) AND
        (p_cantidad_max IS NULL OR dv.cantidad <= p_cantidad_max) AND
        (p_precio_unitario_min IS NULL OR dv.precio_unitario >= p_precio_unitario_min) AND
        (p_precio_unitario_max IS NULL OR dv.precio_unitario <= p_precio_unitario_max);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_producto` (IN `p_id_producto` INT, IN `p_nombre` VARCHAR(255), IN `p_id_categoria_producto` INT, IN `p_id_sede` INT, IN `p_precio_min` DECIMAL(10,2), IN `p_precio_max` DECIMAL(10,2))   BEGIN
    SELECT 
        p.id_producto,
        p.nombre,
        p.descripcion,
        p.precio,
        p.imagen_url,
        p.id_categoria_producto,
        sp.id_sede,
        sp.stock_disponible
    FROM 
        tb_producto p
    LEFT JOIN 
        tb_sedeproducto sp ON p.id_producto = sp.id_producto
    WHERE
        (p_id_producto IS NULL OR p.id_producto = p_id_producto) AND
        (p_nombre IS NULL OR p.nombre LIKE CONCAT('%', p_nombre, '%')) AND
        (p_id_categoria_producto IS NULL OR p.id_categoria_producto = p_id_categoria_producto) AND
        (p_id_sede IS NULL OR sp.id_sede = p_id_sede) AND
        (p_precio_min IS NULL OR p.precio >= p_precio_min) AND
        (p_precio_max IS NULL OR p.precio <= p_precio_max);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_rol` (IN `p_id_rol` INT, IN `p_nombre` VARCHAR(50))   BEGIN
    SELECT 
        r.id_rol,
        r.nombre
    FROM 
        tb_rol r
    WHERE
        (p_id_rol IS NULL OR r.id_rol = p_id_rol) AND
        (p_nombre IS NULL OR r.nombre LIKE CONCAT('%', p_nombre, '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_sede` (IN `p_id_sede` INT, IN `p_nombre` VARCHAR(100))   BEGIN
    SELECT 
        s.id_sede,
        s.nombre,
        s.direccion,
        s.ciudad
    FROM 
        tb_sedes s
    WHERE
        (p_id_sede IS NULL OR s.id_sede = p_id_sede) AND
        (p_nombre IS NULL OR s.nombre LIKE CONCAT('%', p_nombre, '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_usuario` (IN `p_id_usuario` INT, IN `p_nombre` VARCHAR(255), IN `p_apellido` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_id_rol` INT)   BEGIN
    SELECT 
        u.id_usuario,
        u.nombre, 
        u.apellido, 
        u.email, 
        u.celular, 
        DATE(u.fecha_registro) AS fecha_registro, 
        r.nombre AS rol
    FROM 
        tb_usuario u
    JOIN 
        tb_rol r ON u.id_usuario_rol = r.id_rol
    WHERE 
        (p_id_usuario IS NULL OR u.id_usuario = p_id_usuario) AND
        (p_nombre IS NULL OR u.nombre LIKE CONCAT('%', p_nombre, '%')) AND
        (p_apellido IS NULL OR u.apellido LIKE CONCAT('%', p_apellido, '%')) AND
        (p_email IS NULL OR u.email LIKE CONCAT('%', p_email, '%')) AND
        (p_id_rol IS NULL OR u.id_usuario_rol = p_id_rol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_venta` (IN `p_id_venta` INT, IN `p_id_usuario` INT, IN `p_cliente` INT, IN `p_fecha_venta` DATETIME, IN `p_id_metodo_pago` INT, IN `p_total_min` FLOAT, IN `p_total_max` FLOAT)   BEGIN
    SELECT 
        v.id_venta,
        CONCAT(u.nombre, ' ', u.apellido) AS nombre_usuario,
        v.cliente,           
        v.fecha_venta,
        mp.nombre AS nombre_metodopago,
        v.total
    FROM 
        tb_venta v
    LEFT JOIN 
        tb_usuario u ON v.id_venta_usuario = u.id_usuario
    LEFT JOIN 
        tb_metodo_pago mp ON v.id_metodopago_venta = mp.id_metodopago
    WHERE
        (p_id_venta IS NULL OR v.id_venta = p_id_venta) AND
        (p_id_usuario IS NULL OR v.id_venta_usuario = p_id_usuario) AND
        (p_cliente IS NULL OR v.cliente = p_cliente) AND
        (p_fecha_venta IS NULL OR v.fecha_venta = p_fecha_venta) AND
        (p_id_metodo_pago IS NULL OR v.id_metodopago_venta = p_id_metodo_pago) AND
        (p_total_min IS NULL OR v.total >= p_total_min) AND
        (p_total_max IS NULL OR v.total <= p_total_max);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Eletronicos', 'Alimentos'),
(2, 'Tecnologias', 'Alimentos'),
(3, 'Comida', 'Alimentos'),
(4, 'Comida', 'Alimentos varios'),
(5, 'Comida', 'Alimentos varios'),
(6, 'Comida', 'Alimentos varios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_venta`
--

CREATE TABLE `tb_detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_detalle_venta`
--

INSERT INTO `tb_detalle_venta` (`id_detalle_venta`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(2, 6, 1, 1, 100),
(3, 7, 1, 2, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_metodo_pago`
--

CREATE TABLE `tb_metodo_pago` (
  `id_metodopago` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_metodo_pago`
--

INSERT INTO `tb_metodo_pago` (`id_metodopago`, `nombre`) VALUES
(1, 'tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_producto`
--

CREATE TABLE `tb_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_categoria_producto` int(11) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `stock_disponible` varchar(255) NOT NULL DEFAULT 'NULL' COMMENT 'EMPTY'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_producto`
--

INSERT INTO `tb_producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `id_categoria_producto`, `imagen_url`, `stock_disponible`) VALUES
(1, 'rompecabezas', 'piezas de rompecabezas', 100, 1, 'wwwww.png', 'NULL'),
(2, 'Producto Nuevo', 'Este es un producto editado 2', 49.99, 1, 'https://ejemplo.com/imagen.jpg', '100'),
(3, 'Producto Nuevo', 'Este es un producto editado 2', 49.99, 1, 'https://ejemplo.com/imagen.jpg', 'NULL'),
(4, 'Producto Nuevo', 'Este es un producto nuevo', 49.99, 1, 'https://ejemplo.com/imagen.jpg', 'NULL'),
(5, 'Producto Nuevo', 'Este es un producto nuevo', 49.99, 1, 'https://ejemplo.com/imagen.jpg', 'NULL'),
(6, 'Producto Nuevo', 'Este es un producto nuevo', 49.99, 1, 'https://ejemplo.com/imagen.jpg', 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_rol`
--

CREATE TABLE `tb_rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_rol`
--

INSERT INTO `tb_rol` (`id_rol`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Soporte'),
(3, 'Veedor'),
(4, 'Soporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_sedeproducto`
--

CREATE TABLE `tb_sedeproducto` (
  `id_sedeproducto` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock_disponible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_sedeproducto`
--

INSERT INTO `tb_sedeproducto` (`id_sedeproducto`, `id_sede`, `id_producto`, `stock_disponible`) VALUES
(1, 1, 5, 100),
(2, 1, 2, 100),
(3, 1, 6, 100),
(4, 2, 3, 100),
(6, 2, 2, 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_sedes`
--

CREATE TABLE `tb_sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_sedes`
--

INSERT INTO `tb_sedes` (`id_sede`, `nombre`, `direccion`, `ciudad`) VALUES
(1, 'lima', 'lima', 'independencia'),
(2, 'arequipa', 'arequipa', 'nose');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `id_usuario_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `nombre`, `apellido`, `email`, `celular`, `contraseña`, `fecha_registro`, `id_usuario_rol`) VALUES
(1, 'el10', 'el10', 'el10@gmail.com', 987654321, '12345678', '2024-10-19 20:20:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_venta`
--

CREATE TABLE `tb_venta` (
  `id_venta` int(11) NOT NULL,
  `id_venta_usuario` int(11) DEFAULT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `id_metodopago_venta` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_venta`
--

INSERT INTO `tb_venta` (`id_venta`, `id_venta_usuario`, `cliente`, `fecha_venta`, `id_metodopago_venta`, `total`) VALUES
(6, 1, 'pepe', '2024-10-19 00:00:00', 1, 100),
(7, 1, 'El10', '2024-10-19 00:00:00', 1, 200);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_detalle_venta`
--
ALTER TABLE `tb_detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tb_metodo_pago`
--
ALTER TABLE `tb_metodo_pago`
  ADD PRIMARY KEY (`id_metodopago`);

--
-- Indices de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria_producto` (`id_categoria_producto`);

--
-- Indices de la tabla `tb_rol`
--
ALTER TABLE `tb_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_sedeproducto`
--
ALTER TABLE `tb_sedeproducto`
  ADD PRIMARY KEY (`id_sedeproducto`),
  ADD UNIQUE KEY `unique_sede_producto` (`id_sede`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tb_sedes`
--
ALTER TABLE `tb_sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario_rol` (`id_usuario_rol`);

--
-- Indices de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_metodopago_venta` (`id_metodopago_venta`),
  ADD KEY `id_venta_usuario` (`id_venta_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_detalle_venta`
--
ALTER TABLE `tb_detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_metodo_pago`
--
ALTER TABLE `tb_metodo_pago`
  MODIFY `id_metodopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_rol`
--
ALTER TABLE `tb_rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_sedeproducto`
--
ALTER TABLE `tb_sedeproducto`
  MODIFY `id_sedeproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_sedes`
--
ALTER TABLE `tb_sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_detalle_venta`
--
ALTER TABLE `tb_detalle_venta`
  ADD CONSTRAINT `tb_detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `tb_venta` (`id_venta`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD CONSTRAINT `tb_producto_ibfk_1` FOREIGN KEY (`id_categoria_producto`) REFERENCES `tb_categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_sedeproducto`
--
ALTER TABLE `tb_sedeproducto`
  ADD CONSTRAINT `tb_sedeproducto_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `tb_sedes` (`id_sede`),
  ADD CONSTRAINT `tb_sedeproducto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_usuario_rol`) REFERENCES `tb_rol` (`id_rol`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  ADD CONSTRAINT `tb_venta_ibfk_2` FOREIGN KEY (`id_metodopago_venta`) REFERENCES `tb_metodo_pago` (`id_metodopago`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_venta_ibfk_3` FOREIGN KEY (`id_venta_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
