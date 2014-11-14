-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2014 a las 19:43:04
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
  `telefonoFijo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefonoMovil` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cargo_empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `nombre`, `apellido`, `telefonoFijo`, `telefonoMovil`, `cargo_empresa`, `observaciones`) VALUES
(2, 'Juan', 'Perez', '221-4211515', '221-462989', 'Electricista', 'Encargado de camaras'),
(3, 'Esteban', 'Echeverria', '221-4831233', '221-5053324', 'OMS', 'Secretario adjunto'),
(4, 'Ezequiel Bernardo', 'Torrez', '221-4211514', '221-5053456', 'Gasista', 'llamar despues de las 17hs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE IF NOT EXISTS `detalles` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaDetalle` int(11) NOT NULL,
  `fechaSistema` int(11) NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
`id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_evento` int(11) NOT NULL,
  `fecha_sistema` datetime NOT NULL,
  `fecha_evento` datetime NOT NULL,
  `observacones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `id_tipo_evento`, `fecha_sistema`, `fecha_evento`, `observacones`, `estado`) VALUES
(2, 1, 2, '2009-01-01 02:02:00', '2009-01-01 06:05:00', 'Ingreso de Dr. Pablo', 1),
(3, 2, 2, '2009-01-01 18:12:00', '2009-01-01 18:53:00', 'Salida Dr. Pablo', 1),
(4, 1, 3, '2009-02-04 04:05:00', '2009-02-04 05:05:00', 'Rotura de vidrio, oficina de alumos.', 1),
(5, 1, 1, '2009-04-01 14:03:00', '2009-04-01 15:04:00', 'Perdida de gas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_eventos`
--

CREATE TABLE IF NOT EXISTS `tipos_eventos` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prioridad` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipos_eventos`
--

INSERT INTO `tipos_eventos` (`id`, `nombre`, `email`, `prioridad`) VALUES
(1, 'Alarma', 'carlossabena@gmail.com', 1),
(2, 'Persona en transito', 'carlossabena@gmail.com', 2),
(3, 'Infraestructura', 'carlossabena@gmail.com', 3),
(5, 'Camaras', 'carlossabena@gmail.com', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
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
  `baja` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nombre`, `baja`) VALUES
(1, 'ale', 'ale', 'r11_alex@hotmail.com', 'r11_alex@hotmail.com', 1, 'iabgyejtiu8g48c4ws008s0sgs4ws88', '41g5Ohj9MVCU1G+g/KM1/MeOrsrnley00JqjlnJMf1AUgiSLiQP5RTi1y5VUZQnwqFYOtYSUaq5IwTP0cuEuGg==', '2014-11-13 18:19:31', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:18:"ROLE_ADMINISTRADOR";}', 0, NULL, 'Ale', 0),
(2, 'jogianotti', 'jogianotti', 'jorge.oscar.gianotti@gmail.com', 'jorge.oscar.gianotti@gmail.com', 1, 's22zsoenfwg44cwoo0ccko88cc08ooo', 'ud4KTOiRxrMHcbc7/Jdab2/6E6Ch0i+h5GFAkve52D1DDYqpXVW3ldtN0K9WxwO2JMGLjehmidSzsrl4yKCHug==', '2014-11-14 19:22:38', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:18:"ROLE_ADMINISTRADOR";}', 0, NULL, 'Oscar', 1),
(3, 'Admin', 'admin', 'admin@admin.com', 'admin@admin.com', 0, 'chrfj8c7czcwc0c8k0csg4ws88k4gko', '123456', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:18:"ROLE_ADMINISTRADOR";}', 0, NULL, 'Juanita', 0);

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
 ADD PRIMARY KEY (`id_evento`), ADD KEY `IDX_6B23BD8FFCF8192D` (`id_usuario`), ADD KEY `IDX_6B23BD8FCA2D30EA` (`id_tipo_evento`);

--
-- Indices de la tabla `tipos_eventos`
--
ALTER TABLE `tipos_eventos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_F780E5A492FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_F780E5A4A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipos_eventos`
--
ALTER TABLE `tipos_eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
ADD CONSTRAINT `FK_3D57C6DB61B1BEE8` FOREIGN KEY (`id_evento`) REFERENCES `detalles` (`id`),
ADD CONSTRAINT `FK_3D57C6DBFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `detalles` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
ADD CONSTRAINT `FK_6B23BD8FCA2D30EA` FOREIGN KEY (`id_tipo_evento`) REFERENCES `tipos_eventos` (`id`),
ADD CONSTRAINT `FK_6B23BD8FFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
