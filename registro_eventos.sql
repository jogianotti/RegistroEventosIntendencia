-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-12-2014 a las 02:04:23
-- Versión del servidor: 5.5.40
-- Versión de PHP: 5.4.35-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telefonoFijo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefonoMovil` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cargo_empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaDetalle` datetime NOT NULL,
  `fechaSistema` datetime NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3D57C6DB61B1BEE8` (`id_evento`),
  KEY `IDX_3D57C6DBFCF8192D` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_evento` int(11) NOT NULL,
  `rectificacion_id` int(11) DEFAULT NULL,
  `fecha_sistema` datetime NOT NULL,
  `fecha_evento` datetime NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_evento`),
  UNIQUE KEY `UNIQ_6B23BD8FDACCD6DF` (`rectificacion_id`),
  KEY `IDX_6B23BD8FFCF8192D` (`id_usuario`),
  KEY `IDX_6B23BD8FCA2D30EA` (`id_tipo_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_eventos`
--

CREATE TABLE `tipos_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `baja` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prioridad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_eventos`
--

INSERT INTO `tipos_eventos` (`id`, `nombre`, `baja`, `email`, `prioridad`) VALUES
(1, 'TipoEvento_1', 0, NULL, 1),
(2, 'TipoEvento_2', 0, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `UNIQ_EF687F292FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_EF687F2A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nombre`, `baja`) VALUES
(1, 'administrador', 'administrador', 'administrador@registroeventos.com.ar', 'administrador@registroeventos.com.ar', 1, 'f8i6fn3e9h4wkgsw8soww8sscwwkc40', '+0NeK39QnJRsyYGPeSuAQY/cuyao8h2PfNlDMWc3aCPrutwFIEJLl8Bu8jSu3KfmBDhKK782f9W7aMILek1/FQ==', '2014-12-04 01:54:30', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:18:"ROLE_ADMINISTRADOR";}', 0, NULL, 'Nombre Administrador', 0),
(2, 'intendente', 'intendente', 'intendente@registroeventos.com.ar', 'intendente@registroeventos.com.ar', 0, 'ilxi1ynhjlwkwo4cggsg0ggwwgw48cg', 'hCpMKKG4YsdRDgpo9gHknSEBrKyQivwCrThqKrc1JiEC2sJTm0/OG/R57Ly9aT05KIih28w6P79tYEJcQGGNHQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_INTENDENTE";}', 0, NULL, 'Nombre Intendente', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `FK_3D57C6DBFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `FK_3D57C6DB61B1BEE8` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_6B23BD8FDACCD6DF` FOREIGN KEY (`rectificacion_id`) REFERENCES `eventos` (`id_evento`),
  ADD CONSTRAINT `FK_6B23BD8FCA2D30EA` FOREIGN KEY (`id_tipo_evento`) REFERENCES `tipos_eventos` (`id`),
  ADD CONSTRAINT `FK_6B23BD8FFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
