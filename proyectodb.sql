-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 07:21:59
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
-- Base de datos: `proyectodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capa_android`
--

CREATE TABLE `capa_android` (
  `idcapa_android` int(11) NOT NULL,
  `nombre_capa` varchar(45) NOT NULL,
  `marca_idmarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `capa_android`
--

INSERT INTO `capa_android` (`idcapa_android`, `nombre_capa`, `marca_idmarca`) VALUES
(1, 'one ui', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_foro`
--

CREATE TABLE `comentario_foro` (
  `idcomentario_foro` int(11) NOT NULL,
  `contenido_coment` tinytext NOT NULL,
  `fecha_creacion` datetime(6) NOT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  `tema_foro_idtema_foro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `nombre_marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `nombre_marca`) VALUES
(1, 'samsumg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_procesador`
--

CREATE TABLE `marca_procesador` (
  `idmarca_procesador` int(11) NOT NULL,
  `nombre_marca_procesador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `marca_procesador`
--

INSERT INTO `marca_procesador` (`idmarca_procesador`, `nombre_marca_procesador`) VALUES
(1, 'exynos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movil`
--

CREATE TABLE `movil` (
  `idmovil` int(11) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `tamaño_pantalla` varchar(45) NOT NULL,
  `almacenamiento` int(11) NOT NULL,
  `tipo_almacenamiento` varchar(45) NOT NULL,
  `ram` int(11) NOT NULL,
  `tipo_ram` varchar(45) NOT NULL,
  `can_principal` varchar(45) NOT NULL,
  `resolucion_principal` int(11) NOT NULL,
  `can_gran` varchar(45) NOT NULL,
  `resolucion_gran` int(11) NOT NULL,
  `can_tele` varchar(45) NOT NULL,
  `resolucion_tele` int(11) NOT NULL,
  `can_macro` varchar(45) NOT NULL,
  `resolucion_macro` int(11) NOT NULL,
  `bateria` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` tinytext NOT NULL,
  `procesador_idprocesador` int(11) NOT NULL,
  `pantalla_idpantalla` int(11) NOT NULL,
  `sistema_operativo_idsistema_operativo` int(11) NOT NULL,
  `capa_android_idcapa_android` int(11) NOT NULL,
  `marca_idmarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `movil`
--

INSERT INTO `movil` (`idmovil`, `modelo`, `tamaño_pantalla`, `almacenamiento`, `tipo_almacenamiento`, `ram`, `tipo_ram`, `can_principal`, `resolucion_principal`, `can_gran`, `resolucion_gran`, `can_tele`, `resolucion_tele`, `can_macro`, `resolucion_macro`, `bateria`, `precio`, `descripcion`, `procesador_idprocesador`, `pantalla_idpantalla`, `sistema_operativo_idsistema_operativo`, `capa_android_idcapa_android`, `marca_idmarca`) VALUES
(1, 's23 fe', '6', 512, 'ssd', 8, 'ddrx3', 'samjb', 50, 'bhh', 50, 'jbyu', 50, '', 0, 4500, 333000, '5wefewfwef', 1, 1, 1, 1, 1),
(4, 'a55', '6.1', 512, 'ssd', 8, 'ddrx3', 'samjb', 50, 'bhh', 50, 'jbyuwef', 3443, 'sdfe', 10, 4500, 333000, '4r', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantalla`
--

CREATE TABLE `pantalla` (
  `idpantalla` int(11) NOT NULL,
  `resolucion` varchar(45) NOT NULL,
  `tec_pantalla_idtec_pantalla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pantalla`
--

INSERT INTO `pantalla` (`idpantalla`, `resolucion`, `tec_pantalla_idtec_pantalla`) VALUES
(1, '2.340 x 1.080 ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

CREATE TABLE `procesador` (
  `idprocesador` int(11) NOT NULL,
  `modelo_procesador` varchar(45) NOT NULL,
  `marca_procesador_idmarca_procesador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `procesador`
--

INSERT INTO `procesador` (`idprocesador`, `modelo_procesador`, `marca_procesador_idmarca_procesador`) VALUES
(1, '2200', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL,
  `nombre_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idroles`, `nombre_id`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema_operativo`
--

CREATE TABLE `sistema_operativo` (
  `idsistema_operativo` int(11) NOT NULL,
  `nombre_os` varchar(45) NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sistema_operativo`
--

INSERT INTO `sistema_operativo` (`idsistema_operativo`, `nombre_os`, `version`) VALUES
(1, 'android', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tec_pantalla`
--

CREATE TABLE `tec_pantalla` (
  `idtec_pantalla` int(11) NOT NULL,
  `tecnologia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tec_pantalla`
--

INSERT INTO `tec_pantalla` (`idtec_pantalla`, `tecnologia`) VALUES
(1, 'oled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema_foro`
--

CREATE TABLE `tema_foro` (
  `idtema_foro` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `tema` tinytext NOT NULL,
  `fecha_creacion` datetime(6) NOT NULL,
  `usuarios_idusuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` char(32) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `roles_idroles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `correo`, `contraseña`, `user_name`, `nombre`, `apellido`, `roles_idroles`) VALUES
(1, 'nicolmaicol9@gmail.com', 'Maicol101', 'Maicol101', 'maicol', 'loaiza', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capa_android`
--
ALTER TABLE `capa_android`
  ADD PRIMARY KEY (`idcapa_android`),
  ADD UNIQUE KEY `idcapa_android_UNIQUE` (`idcapa_android`),
  ADD KEY `fk_capa_android_marca1_idx` (`marca_idmarca`);

--
-- Indices de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  ADD PRIMARY KEY (`idcomentario_foro`),
  ADD UNIQUE KEY `idcomentario_foro_UNIQUE` (`idcomentario_foro`),
  ADD KEY `fk_comentario_foro_usuarios1_idx` (`usuarios_idusuarios`),
  ADD KEY `fk_comentario_foro_tema_foro1_idx` (`tema_foro_idtema_foro`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`),
  ADD UNIQUE KEY `idmarca_UNIQUE` (`idmarca`);

--
-- Indices de la tabla `marca_procesador`
--
ALTER TABLE `marca_procesador`
  ADD PRIMARY KEY (`idmarca_procesador`),
  ADD UNIQUE KEY `idmarca_procesador_UNIQUE` (`idmarca_procesador`);

--
-- Indices de la tabla `movil`
--
ALTER TABLE `movil`
  ADD PRIMARY KEY (`idmovil`),
  ADD UNIQUE KEY `idmovil_UNIQUE` (`idmovil`),
  ADD KEY `fk_movil_procesador1_idx` (`procesador_idprocesador`),
  ADD KEY `fk_movil_pantalla1_idx` (`pantalla_idpantalla`),
  ADD KEY `fk_movil_sistema_operativo1_idx` (`sistema_operativo_idsistema_operativo`),
  ADD KEY `fk_movil_capa_android1_idx` (`capa_android_idcapa_android`),
  ADD KEY `fk_movil_marca1_idx` (`marca_idmarca`);

--
-- Indices de la tabla `pantalla`
--
ALTER TABLE `pantalla`
  ADD PRIMARY KEY (`idpantalla`),
  ADD UNIQUE KEY `idpantalla_UNIQUE` (`idpantalla`),
  ADD KEY `fk_pantalla_tec_pantalla1_idx` (`tec_pantalla_idtec_pantalla`);

--
-- Indices de la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD PRIMARY KEY (`idprocesador`),
  ADD UNIQUE KEY `idprocesador_UNIQUE` (`idprocesador`),
  ADD KEY `fk_procesador_marca_procesador1_idx` (`marca_procesador_idmarca_procesador`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`),
  ADD UNIQUE KEY `idroles_UNIQUE` (`idroles`);

--
-- Indices de la tabla `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  ADD PRIMARY KEY (`idsistema_operativo`),
  ADD UNIQUE KEY `idsistema_operativo_UNIQUE` (`idsistema_operativo`);

--
-- Indices de la tabla `tec_pantalla`
--
ALTER TABLE `tec_pantalla`
  ADD PRIMARY KEY (`idtec_pantalla`),
  ADD UNIQUE KEY `idtec_pantalla_UNIQUE` (`idtec_pantalla`);

--
-- Indices de la tabla `tema_foro`
--
ALTER TABLE `tema_foro`
  ADD PRIMARY KEY (`idtema_foro`),
  ADD UNIQUE KEY `idtema_foro_UNIQUE` (`idtema_foro`),
  ADD KEY `fk_tema_foro_usuarios_idx` (`usuarios_idusuarios`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD UNIQUE KEY `idusuarios_UNIQUE` (`idusuarios`),
  ADD KEY `fk_usuarios_roles1_idx` (`roles_idroles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capa_android`
--
ALTER TABLE `capa_android`
  MODIFY `idcapa_android` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  MODIFY `idcomentario_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marca_procesador`
--
ALTER TABLE `marca_procesador`
  MODIFY `idmarca_procesador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movil`
--
ALTER TABLE `movil`
  MODIFY `idmovil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pantalla`
--
ALTER TABLE `pantalla`
  MODIFY `idpantalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `procesador`
--
ALTER TABLE `procesador`
  MODIFY `idprocesador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  MODIFY `idsistema_operativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tec_pantalla`
--
ALTER TABLE `tec_pantalla`
  MODIFY `idtec_pantalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tema_foro`
--
ALTER TABLE `tema_foro`
  MODIFY `idtema_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capa_android`
--
ALTER TABLE `capa_android`
  ADD CONSTRAINT `fk_capa_android_marca1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  ADD CONSTRAINT `fk_comentario_foro_tema_foro1` FOREIGN KEY (`tema_foro_idtema_foro`) REFERENCES `tema_foro` (`idtema_foro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_foro_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movil`
--
ALTER TABLE `movil`
  ADD CONSTRAINT `fk_movil_capa_android1` FOREIGN KEY (`capa_android_idcapa_android`) REFERENCES `capa_android` (`idcapa_android`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movil_marca1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movil_pantalla1` FOREIGN KEY (`pantalla_idpantalla`) REFERENCES `pantalla` (`idpantalla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movil_procesador1` FOREIGN KEY (`procesador_idprocesador`) REFERENCES `procesador` (`idprocesador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movil_sistema_operativo1` FOREIGN KEY (`sistema_operativo_idsistema_operativo`) REFERENCES `sistema_operativo` (`idsistema_operativo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pantalla`
--
ALTER TABLE `pantalla`
  ADD CONSTRAINT `fk_pantalla_tec_pantalla1` FOREIGN KEY (`tec_pantalla_idtec_pantalla`) REFERENCES `tec_pantalla` (`idtec_pantalla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD CONSTRAINT `fk_procesador_marca_procesador1` FOREIGN KEY (`marca_procesador_idmarca_procesador`) REFERENCES `marca_procesador` (`idmarca_procesador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tema_foro`
--
ALTER TABLE `tema_foro`
  ADD CONSTRAINT `fk_tema_foro_usuarios` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_idroles`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
