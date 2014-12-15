-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2014 a las 01:42:00
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `registro_eventos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
`id_contacto` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telefonoFijo` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoMovil` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_empresa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `nombre`, `apellido`, `telefonoFijo`, `telefonoMovil`, `cargo_empresa`, `observaciones`, `createdAt`, `updatedAt`) VALUES
(2, 'ASas', 'asdsd', '2311231', '221-5053324', 'asdas', 'asdasd', '2014-12-10 22:02:04', '2014-12-10 22:02:04'),
(3, 'ale', '', '', '', '', '', '2014-12-10 22:21:07', '2014-12-10 22:21:07'),
(4, 'asdasd', '', 'asdasd', '', '', '', '2014-12-10 23:01:41', '2014-12-10 23:01:41'),
(5, 'asdasd', '', 'e', '', '', '', '2014-12-10 23:02:52', '2014-12-10 23:02:52'),
(6, 'asdasdasd', '', '2323', '', '', '', '2014-12-10 23:08:34', '2014-12-10 23:08:34'),
(7, 'asdasd', '', 'asdasd', '', '', '', '2014-12-10 23:08:50', '2014-12-10 23:08:50'),
(8, 'asdasd', '', '1123123', '', '', '', '2014-12-10 23:12:52', '2014-12-10 23:12:52'),
(9, 'asdasda', '', 'asdasd', '', '', '', '2014-12-10 23:13:20', '2014-12-10 23:13:20'),
(10, 'asdasd', '', '234324', '', '', '', '2014-12-10 23:13:59', '2014-12-10 23:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE IF NOT EXISTS `detalles` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaDetalle` datetime NOT NULL,
  `fechaSistema` datetime NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id`, `id_evento`, `id_usuario`, `fechaDetalle`, `fechaSistema`, `observaciones`, `createdAt`, `updatedAt`) VALUES
(1, 1, 6, '2014-12-05 17:44:00', '2014-12-05 17:44:41', 'aaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 6, '2014-12-05 17:44:00', '2014-12-05 17:44:54', 'bbbbb', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 6, '2014-12-05 18:26:00', '2014-12-05 18:26:45', 'adsfadfadf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 6, '2014-12-05 18:30:00', '2014-12-05 18:30:19', 'adsadfadf55555', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 6, '2014-12-05 18:33:00', '2014-12-05 18:33:47', 'suerte que ande', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 6, '2014-12-08 18:33:00', '2014-12-05 18:34:01', 'borrate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 6, '2014-12-05 18:34:00', '2014-12-05 18:34:17', 'adfadsfadf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 6, '2014-12-05 18:34:00', '2014-12-05 18:34:31', 'asddsD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 18, 7, '2014-12-15 20:17:00', '2014-12-10 20:17:41', 'adsfadf', '2014-12-10 20:17:41', '2014-12-10 20:17:41'),
(10, 18, 7, '2014-12-10 20:24:00', '2014-12-10 20:25:00', 'asdfadfadf', '2014-12-10 20:25:00', '2014-12-10 20:25:00'),
(11, 18, 7, '2014-12-10 20:25:00', '2014-12-10 20:25:10', 'ASDadsSAD', '2014-12-10 20:25:10', '2014-12-10 20:25:10'),
(12, 13, 7, '2014-12-10 20:28:00', '2014-12-10 20:28:24', 'ASDFADSF', '2014-12-10 20:28:24', '2014-12-10 20:28:24'),
(13, 15, 7, '2014-12-16 20:28:00', '2014-12-10 20:29:06', 'ADSFADSF', '2014-12-10 20:29:06', '2014-12-10 20:29:06'),
(14, 21, 6, '2014-12-12 00:11:00', '2014-12-12 00:12:02', 'asdasd', '2014-12-12 00:12:02', '2014-12-12 00:12:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
`id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_evento` int(11) NOT NULL,
  `rectificacion_id` int(11) DEFAULT NULL,
  `fecha_sistema` datetime NOT NULL,
  `fecha_evento` datetime NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `id_tipo_evento`, `rectificacion_id`, `fecha_sistema`, `fecha_evento`, `observaciones`, `estado`, `createdAt`, `updatedAt`) VALUES
(1, 6, 1, 2, '2014-12-04 21:30:11', '2014-12-04 21:29:00', 'adsffsdf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 6, 1, NULL, '2014-12-05 18:26:14', '2014-12-04 21:29:00', 'otra cosa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 6, 1, NULL, '2014-12-05 20:25:07', '2014-12-05 20:24:00', 'asdfadfsadsf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, 3, NULL, '2014-12-05 20:27:38', '2014-12-05 20:27:00', 'ADSFADSFADSF', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 7, 1, NULL, '2014-12-05 20:35:12', '2014-12-05 20:27:00', 'ADSFADSFADSF', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 7, 1, NULL, '2014-12-05 20:39:55', '2014-12-05 20:27:00', 'ADSFADSFADSF', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 1, NULL, '2014-12-05 20:40:17', '2014-12-05 20:27:00', 'ADSFADSFADSF', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 7, 1, NULL, '2014-12-05 20:41:41', '2014-12-05 20:41:00', 'Evento prueba envio mail', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 7, 1, NULL, '2014-12-05 20:43:45', '2014-12-05 20:41:00', 'adsfadsfadf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 7, 1, NULL, '2014-12-05 20:45:48', '2014-12-05 20:43:00', 'asdfadadf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 7, 1, NULL, '2014-12-05 20:49:11', '2014-12-05 20:49:00', 'otromas', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 7, 1, NULL, '2014-12-05 20:54:39', '2014-12-05 20:54:00', 'adsfadsfadf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 7, 1, NULL, '2014-12-05 20:59:36', '2014-12-05 20:59:00', 'adfadsfadsfadsfadsfadsfasdfadf', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 7, 1, 17, '2014-12-05 21:01:13', '2014-12-05 21:00:00', 'aaaaaaaaa lalala', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 7, 1, NULL, '2014-12-05 21:16:03', '2014-12-05 21:00:00', 'hghg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 7, 2, NULL, '2014-12-10 19:21:26', '2014-12-10 19:21:00', 'a ver si anda gato', 1, '2014-12-10 19:21:26', '2014-12-10 19:21:26'),
(20, 7, 3, NULL, '2014-12-10 20:43:09', '2014-12-10 20:41:00', 'adsfadfaf', 0, '2014-12-10 20:43:09', '2014-12-10 20:43:09'),
(21, 7, 3, NULL, '2014-12-10 20:43:50', '2014-12-10 20:43:00', 'adsadsf111133334444', 1, '2014-12-10 20:43:50', '2014-12-10 20:43:50'),
(22, 7, 3, NULL, '2014-12-10 20:46:01', '2014-12-10 20:45:00', 'asdfadfaooooooooooooooooooooooooooooo', 0, '2014-12-10 20:46:01', '2014-12-10 20:46:01'),
(23, 7, 3, NULL, '2014-12-10 20:46:20', '2014-12-10 20:46:00', 'adsfadsfadsf', 0, '2014-12-10 20:46:20', '2014-12-12 00:11:18'),
(24, 7, 3, NULL, '2014-12-10 20:46:31', '2014-12-10 20:46:00', 'oooooooooooooooooooo', 0, '2014-12-10 20:46:31', '2014-12-10 20:46:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_eventos`
--

CREATE TABLE IF NOT EXISTS `tipos_eventos` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `baja` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prioridad` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipos_eventos`
--

INSERT INTO `tipos_eventos` (`id`, `nombre`, `baja`, `email`, `prioridad`, `createdAt`, `updatedAt`) VALUES
(1, 'PROBANDO', 1, 'r11alex.nestor@gmail.com', 1, '0000-00-00 00:00:00', '2014-12-10 20:09:14'),
(2, 'alalala', 1, 'costanzo_pablo@hotmail.com', 0, '0000-00-00 00:00:00', '2014-12-10 20:09:34'),
(3, 'Electricidad', 1, NULL, -9, '0000-00-00 00:00:00', '2014-12-12 00:14:03'),
(4, 'ale', 0, 'asdasd', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ale', 0, NULL, 1, '2014-12-10 21:59:05', '2014-12-10 21:59:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `baja` tinyint(1) DEFAULT '0',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nombre`, `baja`, `createdAt`, `updatedAt`) VALUES
(1, 'alexis', 'alexis', NULL, NULL, 0, 'f8i6fn3e9h4wkgsw8soww8sscwwkc40', '+0NeK39QnJRsyYGPeSuAQY/cuyao8h2PfNlDMWc3aCPrutwFIEJLl8Bu8jSu3KfmBDhKK782f9W7aMILek1/FQ==', '2014-12-04 18:46:45', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'xsxsx', 1, '0000-00-00 00:00:00', '2014-12-12 00:13:29'),
(2, 'intendente', 'intendente', 'intendente@registroeventos.com.ar', 'intendente@registroeventos.com.ar', 0, 'ilxi1ynhjlwkwo4cggsg0ggwwgw48cg', 'hCpMKKG4YsdRDgpo9gHknSEBrKyQivwCrThqKrc1JiEC2sJTm0/OG/R57Ly9aT05KIih28w6P79tYEJcQGGNHQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'Nombre Intendente', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ale', 'ale', 'ale@ale.com', 'ale@ale.com', 0, 'mkfy0odirk008w000s8488so84ksw44', 'qIHvgoVMcZJdrlD1boceCUCOww2kLxOI2UGlK+z4FY14SE3r8G5yzUFXASiv+kFQH4uKgPsJUbn10FMGIy9muw==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'ale', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'alex', 'alex', 'r11_alex@hotmail.com', 'r11_alex@hotmail.com', 1, 're7lo7v4y00g844c0oooo0kscssk80o', 'hze2Na1kk81C/u8I8PaECInzVrkEKpkPykmf3zGN5+ucwKOsDgkcAxxO8zyjssU7wrDGx4cWC0xeH8z8BuI7Rg==', '2014-12-13 17:02:52', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'Alexander', 0, '0000-00-00 00:00:00', '2014-12-13 17:02:52'),
(7, 'oscar', 'oscar', 'ale@ale.com.ar', 'ale@ale.com.ar', 1, 'o266tygbzc0g4sswoswc4ksckg0wkg4', 'mGS30H95IZHUWtaWeft7jj3TeF5KIyH5rlV2h5tj5c5XlF5xjOJUd2Njll5OEvHvBL1jRzfyuowRYz6nYIoyFQ==', '2014-12-13 16:00:08', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:18:"ROLE_ADMINISTRADOR";}', 0, NULL, 'oscar', 0, '0000-00-00 00:00:00', '2014-12-13 16:00:08'),
(8, 'juan juan', 'juan juan', NULL, NULL, 1, '42h6s96bxp4wsc80w08sccow0g8wwk4', '7/Y5JDz3tVWCQmWgjLioC4ks0x7ILBKGVG4Ty20VgaGuX89Lr5s7P8ONxg0AtpD5bdHj3h4GhDoAj8k93WZBVA==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'juan juan', 0, '2014-12-09 20:57:22', '2014-12-09 20:57:22'),
(9, 'aeae', 'aeae', NULL, NULL, 1, '7xcas5yhc5c0gocswc4sg4wwkow80kk', 'hhF0jrgdYQpWpQoyBZKoDlmTeg0jp4PP1emB9kUUskNGjqRryiVIq8VBX1CqCyFOWd5JA+dtLeV0LjvYbAY48g==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, '345345345', 0, '2014-12-11 18:46:30', '2014-12-11 18:46:30'),
(11, 'su', 'su', 'ale@aallee.com', 'ale@aallee.com', 1, 'dfewwfetk6os8w4wc4w8sk0cw8080k8', '/0za7FS6JmwK2c1ZbzB83gvDnoJcxK2f2pI2OatpoKpejyzM56dWtDdlkDe7fvTpzXG7K9wM28+wbnnvc/vbwg==', '2014-12-13 16:55:17', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_SUPERVISOR";}', 0, NULL, 'Alexander', 0, '2014-12-12 19:34:31', '2014-12-13 16:55:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
 ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_3D57C6DB61B1BEE8` (`id_evento`), ADD KEY `IDX_3D57C6DBFCF8192D` (`id_usuario`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
 ADD PRIMARY KEY (`id_evento`), ADD UNIQUE KEY `UNIQ_6B23BD8FDACCD6DF` (`rectificacion_id`), ADD KEY `IDX_6B23BD8FFCF8192D` (`id_usuario`), ADD KEY `IDX_6B23BD8FCA2D30EA` (`id_tipo_evento`);

--
-- Indices de la tabla `tipos_eventos`
--
ALTER TABLE `tipos_eventos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `UNIQ_EF687F292FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_EF687F2A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `tipos_eventos`
--
ALTER TABLE `tipos_eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
ADD CONSTRAINT `FK_3D57C6DB61B1BEE8` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`),
ADD CONSTRAINT `FK_3D57C6DBFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
ADD CONSTRAINT `FK_6B23BD8FCA2D30EA` FOREIGN KEY (`id_tipo_evento`) REFERENCES `tipos_eventos` (`id`),
ADD CONSTRAINT `FK_6B23BD8FDACCD6DF` FOREIGN KEY (`rectificacion_id`) REFERENCES `eventos` (`id_evento`),
ADD CONSTRAINT `FK_6B23BD8FFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
