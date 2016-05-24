-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-09-2015 a las 19:29:01
-- Versión del servidor: 5.5.43-0ubuntu0.14.10.1
-- Versión de PHP: 5.5.12-2ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yii_evaluaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_archivos`
--

CREATE TABLE IF NOT EXISTS `biblioteca_archivos` (
`id` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `archivo` text NOT NULL,
  `extension` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_comentarios`
--

CREATE TABLE IF NOT EXISTS `biblioteca_comentarios` (
`id` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `biblioteca_comentarios`
--

INSERT INTO `biblioteca_comentarios` (`id`, `id_entrada`, `fecha`, `id_user`, `comentario`) VALUES
(5, 40, '2015-07-08 17:44:14', 1, 'comment');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_entradas`
--

CREATE TABLE IF NOT EXISTS `biblioteca_entradas` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `visitas` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` longtext NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '0 archivos,1 link, 2 video, 3 escrito'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `biblioteca_entradas`
--

INSERT INTO `biblioteca_entradas` (`id`, `id_user`, `visitas`, `titulo`, `descripcion`, `tipo`) VALUES
(40, 1, 0, 'Testssss', '<p>testttttttttt</p>', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_entradas_tags`
--

CREATE TABLE IF NOT EXISTS `biblioteca_entradas_tags` (
`id` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `biblioteca_entradas_tags`
--

INSERT INTO `biblioteca_entradas_tags` (`id`, `id_tag`, `id_entrada`) VALUES
(88, 10, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_tags`
--

CREATE TABLE IF NOT EXISTS `biblioteca_tags` (
`id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `biblioteca_tags`
--

INSERT INTO `biblioteca_tags` (`id`, `tag`, `total`) VALUES
(10, 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `preguntas_aprobadas` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `preguntas_aprobadas`) VALUES
(2, 'Memex', 0),
(3, 'Tiga AC', 0),
(4, 'Trolex', 0),
(5, 'Pamex', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_comentarios`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_comentarios` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL,
  `id_evaluador` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `evaluaciones_comentarios`
--

INSERT INTO `evaluaciones_comentarios` (`id`, `id_evento`, `id_evaluado`, `id_evaluador`, `comentario`) VALUES
(6, 33, 16, 17, 'luego vemos'),
(7, 33, 16, 18, 'comments del 3'),
(8, 33, 16, 19, 'comments 4'),
(9, 34, 0, 17, 'Generalss'),
(10, 34, 0, 18, 'comentarios del 3'),
(11, 34, 0, 19, 'comments 4'),
(12, 35, 0, 17, 'simon'),
(13, 35, 0, 17, 'asdfasdf'),
(14, 35, 0, 17, 'tesst'),
(15, 35, 18, 17, 'safdasdfdsf'),
(16, 35, 19, 17, 'asdfsadf'),
(17, 35, 17, 19, 'ok'),
(18, 35, 18, 19, 'asdf'),
(19, 35, 17, 18, 'okay3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_config`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_config` (
`id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `tipo_estadistica` int(11) NOT NULL COMMENT '0=Número, 1=Porcentaje'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `evaluaciones_config`
--

INSERT INTO `evaluaciones_config` (`id`, `id_empresa`, `tipo_estadistica`) VALUES
(2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_ejecutadas`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_ejecutadas` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL,
  `id_evaluador` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `evaluaciones_ejecutadas`
--

INSERT INTO `evaluaciones_ejecutadas` (`id`, `id_evento`, `id_evaluado`, `id_evaluador`) VALUES
(3, 33, 16, 17),
(4, 33, 16, 18),
(5, 33, 16, 19),
(6, 34, 0, 17),
(7, 34, 0, 18),
(8, 34, 0, 19),
(9, 35, 0, 17),
(10, 35, 0, 17),
(11, 35, 0, 17),
(12, 35, 18, 17),
(13, 35, 19, 17),
(14, 35, 17, 19),
(15, 35, 18, 19),
(16, 35, 17, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_evaluadores`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_evaluadores` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Volcado de datos para la tabla `evaluaciones_evaluadores`
--

INSERT INTO `evaluaciones_evaluadores` (`id`, `id_evento`, `id_usuario`) VALUES
(74, 32, 17),
(75, 32, 18),
(76, 33, 17),
(77, 33, 18),
(78, 33, 19),
(79, 34, 17),
(80, 34, 18),
(81, 34, 19),
(82, 35, 17),
(83, 35, 18),
(84, 35, 19),
(85, 36, 16),
(86, 36, 17),
(87, 36, 18),
(88, 36, 19),
(89, 36, 20),
(90, 36, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_evaluados`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_evaluados` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `evaluaciones_evaluados`
--

INSERT INTO `evaluaciones_evaluados` (`id`, `id_evento`, `id_usuario`) VALUES
(20, 33, 16),
(21, 35, 17),
(22, 35, 18),
(23, 35, 19),
(24, 36, 16),
(25, 36, 17),
(26, 36, 18),
(27, 36, 19),
(28, 36, 20),
(29, 36, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_eventos`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_eventos` (
`id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_estructura` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `evaluado` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `evaluaciones_eventos`
--

INSERT INTO `evaluaciones_eventos` (`id`, `id_empresa`, `id_paquete`, `id_estructura`, `titulo`, `fecha_inicio`, `fecha_final`, `evaluado`) VALUES
(33, 3, 12, 1, 'Ev al lider', '2015-06-24', '2015-06-30', ''),
(34, 3, 13, 3, 'Climon', '2015-06-24', '2015-06-30', 'Clima organizacional empresarial'),
(35, 3, 14, 2, 'Colaborator', '2015-06-26', '2015-06-30', ''),
(36, 3, 14, 2, 'Test', '2015-08-20', '2015-08-31', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_grupos`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_grupos` (
`id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `titulo` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `evaluaciones_grupos`
--

INSERT INTO `evaluaciones_grupos` (`id`, `id_empresa`, `titulo`) VALUES
(7, 3, 'Almacén');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_grupos_usuarios`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_grupos_usuarios` (
`id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `evaluaciones_grupos_usuarios`
--

INSERT INTO `evaluaciones_grupos_usuarios` (`id`, `id_grupo`, `id_usuario`) VALUES
(44, 7, 14),
(45, 7, 16),
(46, 7, 17),
(47, 7, 18),
(48, 7, 19),
(49, 7, 20),
(50, 7, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_paquetes`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_paquetes` (
`id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `titulo` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `evaluaciones_paquetes`
--

INSERT INTO `evaluaciones_paquetes` (`id`, `id_empresa`, `titulo`) VALUES
(12, 3, 'Colaborador a Líder'),
(13, 3, 'Clima organizacional'),
(14, 3, 'Colaborador a colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_preguntas`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_preguntas` (
`id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `evaluaciones_preguntas`
--

INSERT INTO `evaluaciones_preguntas` (`id`, `id_paquete`, `pregunta`, `tipo`, `orden`) VALUES
(2, 12, '¿El líder respondió a sus preguntas?', 2, 1),
(3, 12, 'El apoyo que recibo de mi líder ', 1, 2),
(4, 13, 'En mi trabajo me siento:', 1, 1),
(5, 13, 'Con el suedo me siento', 1, 3),
(6, 13, 'Estoy satisfecho por el comportamiento de mis compañeros', 2, 4),
(10, 13, 'Prestaciones', 1, 2),
(11, 14, 'La actitud de mi compañero en general es', 1, 2),
(13, 14, 'Busca la manera de solucionar problemas al instante', 2, 1),
(14, 14, 'El desempeño en la operación es', 1, 3),
(15, 12, 'Pregunta tres', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_respuestas`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_respuestas` (
`id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL,
  `id_evaluador` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `evaluaciones_respuestas`
--

INSERT INTO `evaluaciones_respuestas` (`id`, `id_evento`, `id_evaluado`, `id_evaluador`, `id_pregunta`, `respuesta`, `comentario`) VALUES
(19, 32, 19, 18, 2, 1, 'Muy bien por el '),
(20, 32, 19, 18, 3, 2, 'Ahi se va'),
(21, 32, 19, 18, 15, 1, 'ok todo fine'),
(22, 33, 16, 17, 2, 1, 'eat like you'),
(23, 33, 16, 17, 3, 2, 'apoyo'),
(24, 33, 16, 17, 15, 7, 'sepa'),
(25, 33, 16, 18, 2, 1, 'no se 3'),
(26, 33, 16, 18, 3, 3, 'sepa 3'),
(27, 33, 16, 18, 15, 1, 'simon 3'),
(28, 33, 16, 19, 2, 1, 'smon 4'),
(29, 33, 16, 19, 3, 1, 'ex 4'),
(30, 33, 16, 19, 15, 7, 'no 4'),
(31, 34, 0, 17, 4, 1, 'Muy bueno'),
(32, 34, 0, 17, 5, 1, 'Muy bueno'),
(33, 34, 0, 17, 6, 1, 'OK seguimos'),
(34, 34, 0, 17, 10, 1, 'ok'),
(35, 34, 0, 18, 4, 1, 'ok3'),
(36, 34, 0, 18, 5, 1, 'ok3'),
(37, 34, 0, 18, 6, 1, 'ok3'),
(38, 34, 0, 18, 10, 1, 'ok3'),
(39, 34, 0, 19, 4, 1, 'OK'),
(40, 34, 0, 19, 5, 1, 'OK'),
(41, 34, 0, 19, 6, 1, 'OK'),
(42, 34, 0, 19, 10, 1, 'OK'),
(43, 35, 0, 17, 11, 2, 'ok'),
(44, 35, 0, 17, 13, 7, 'ok'),
(45, 35, 0, 17, 14, 2, 'ok'),
(46, 35, 0, 17, 11, 2, 'asdf'),
(47, 35, 0, 17, 13, 1, 'asdfsad'),
(48, 35, 0, 17, 14, 2, 'asdfasdf'),
(49, 35, 0, 17, 11, 1, 'fasdfasdf'),
(50, 35, 0, 17, 13, 1, 'asdfsadf'),
(51, 35, 0, 17, 14, 1, 'asdfasdf'),
(52, 35, 18, 17, 11, 2, 'test'),
(53, 35, 18, 17, 13, 1, 'asdfasdf'),
(54, 35, 18, 17, 14, 1, 'asdfsadf'),
(55, 35, 19, 17, 11, 2, 'test'),
(56, 35, 19, 17, 13, 1, 'test'),
(57, 35, 19, 17, 14, 2, 'asdfsadf'),
(58, 35, 17, 19, 11, 1, 'Simon '),
(59, 35, 17, 19, 13, 1, 'Si se hace'),
(60, 35, 17, 19, 14, 1, 'EXC'),
(61, 35, 18, 19, 11, 1, 'asdf'),
(62, 35, 18, 19, 13, 1, 'asdf'),
(63, 35, 18, 19, 14, 1, 'adf'),
(64, 35, 17, 18, 11, 1, 'okay'),
(65, 35, 17, 18, 13, 1, 'simon del 3'),
(66, 35, 17, 18, 14, 2, 'good');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
`id` int(11) NOT NULL,
  `cuerpo` text NOT NULL,
  `fecha` datetime NOT NULL,
  `asunto` text NOT NULL,
  `correo` text NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `cuerpo`, `fecha`, `asunto`, `correo`, `estado`) VALUES
(1, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable test. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: test\n					<br /> PASSWORD: agocvql\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 11:48:00', 'Bienvenido a la herramienta de Clima Organizacional', 'tes@test.com', 0),
(2, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable memex. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: memex\n					<br /> PASSWORD: agocvrl\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 11:48:00', 'Bienvenido a la herramienta de Clima Organizacional', 'memex@memex.com', 0),
(3, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable memex. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: memex\n					<br /> PASSWORD: agocvsj\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 11:49:00', 'Bienvenido a la herramienta de Clima Organizacional', 'memex@memex.com', 0),
(4, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable other. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: other\n					<br /> PASSWORD: agocvvl\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 11:50:00', 'Bienvenido a la herramienta de Clima Organizacional', 'other@other.com', 0),
(5, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable lider. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: lider\n					<br /> PASSWORD: agocvwu\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 11:51:00', 'Bienvenido a la herramienta de Clima Organizacional', 'lider@lider.com', 0),
(6, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable lider2. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: lider2\n					<br /> PASSWORD: agocwrm\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 12:00:00', 'Bienvenido a la herramienta de Clima Organizacional', 'lider@2.com', 0),
(7, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable memexleader. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: memexleader\n					<br /> PASSWORD: agocwsx\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 12:00:00', 'Bienvenido a la herramienta de Clima Organizacional', 'memex@memex.com', 0),
(8, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable webcom. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: webcom\n					<br /> PASSWORD: agocxed\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 12:05:00', 'Bienvenido a la herramienta de Clima Organizacional', 'webcom@nice.com', 0),
(9, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable consultor. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: cons\n					<br /> PASSWORD: agocxew\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-05-30 12:05:00', 'Bienvenido a la herramienta de Clima Organizacional', 'con@sultor.com', 0),
(10, '<h1> Bienvenido a la herramienta de Clima Organizacional </h1>\n				<p> Apreciable texas. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://climaorganizacional.empresainteligente.com''>http://climaorganizacional.empresainteligente.com</a>\n					<br /> USERNAME: texas\n					<br /> PASSWORD: agomqae\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-01 11:34:00', 'Bienvenido a la herramienta de Clima Organizacional', 'texas@texascorp.com', 0),
(11, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable Usuario Texas. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: utexas\n					<br /> PASSWORD: agosaiq\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 13:55:00', 'Bienvenido a la herramienta de Evaluaciones', 'texas@usuario.com', 0),
(12, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable Texas user. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser\n					<br /> PASSWORD: agosasa\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 13:59:00', 'Bienvenido a la herramienta de Evaluaciones', 'texasuser@texas.co', 0),
(13, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable texas user 2. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser2\n					<br /> PASSWORD: agosasx\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 13:59:00', 'Bienvenido a la herramienta de Evaluaciones', 'tuser2@texas.co', 0),
(14, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable texas user 3. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser3\n					<br /> PASSWORD: agosaty\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 14:00:00', 'Bienvenido a la herramienta de Evaluaciones', 'tuser3@texas.co', 0),
(15, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable Texas User 4. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser4\n					<br /> PASSWORD: agosavu\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 14:01:00', 'Bienvenido a la herramienta de Evaluaciones', 'tuser4@texas.co', 0),
(16, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable Texas User 5. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser5\n					<br /> PASSWORD: agosawq\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 14:01:00', 'Bienvenido a la herramienta de Evaluaciones', 'tuser5@texasco.com', 0),
(17, '<h1> Bienvenido a la herramienta de Evaluaciones </h1>\n				<p> Apreciable Texas User 6. </p>\n				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser6\n					<br /> PASSWORD: agosbci\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-06-02 14:03:00', 'Bienvenido a la herramienta de Evaluaciones', 'tuser6@gmail.com', 0),
(18, '<h1> Has cambiado tu contraseña </h1>\n				<p> Apreciable texas user 2. </p>\n				<p> Le enviamos la información solicitada.</p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser2\n					<br /> PASSWORD: password\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-08-05 17:43:00', 'Solicitud de cambio de contraseña', 'tuser2@texas.co', 0),
(19, '<h1> Has cambiado tu contraseña </h1>\n				<p> Apreciable texas user 2. </p>\n				<p> Le enviamos la información solicitada.</p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser2\n					<br /> PASSWORD: password\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-08-05 17:43:00', 'Solicitud de cambio de contraseña', 'tuser2@texas.co', 0),
(20, '<h1> Solicitud de cambio de contraseña </h1>\n				<p> Apreciable texas user 2. </p>\n				<p> Le enviamos la información solicitada.</p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: tuser2\n					<br /> PASSWORD: AHAVKQI\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-08-05 17:45:00', 'Solicitud de cambio de contraseña', 'tuser2@texas.co', 0),
(21, '<h1> Solicitud de cambio de contraseña </h1>\n				<p> Apreciable texas. </p>\n				<p> Le enviamos la información solicitada.</p>\n				<h2> Datos de acceso: </h2>\n				<p> \n					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación \n					<br /> URL: <a href=''http://evaluaciones.empresainteligente.com''>http://evaluaciones.empresainteligente.com</a>\n					<br /> USERNAME: texas\n					<br /> PASSWORD: AHBXSNC\n				</p>\n				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>', '2015-08-11 11:56:00', 'Solicitud de cambio de contraseña', 'texas@texascorp.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `rol` tinyint(4) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_empresa`, `username`, `password`, `nombre`, `email`, `rol`, `image`) VALUES
(1, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'oborquez@empresainteligente.com', 3, '/resources/users/1.jpg'),
(8, 1, 'other', 'aa0047712a3dd38c4cab259881ae3d38', 'other', 'other@other.com', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(14, 3, 'texas', '3e194b5730ed8b868224b80ac8d7eed9', 'texas', 'texas@texascorp.com', 2, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(16, 3, 'tuser', '3e194b5730ed8b868224b80ac8d7eed9', 'Texas user', 'texasuser@texas.co', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(17, 3, 'tuser2', 'f1547e4599bf9afaa93ce84988d0bbfc', 'texas user 2', 'tuser2@texas.co', 1, '/resources/users/17.jpg'),
(18, 3, 'tuser3', '3e194b5730ed8b868224b80ac8d7eed9', 'texas user 3', 'tuser3@texas.co', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(19, 3, 'tuser4', '3e194b5730ed8b868224b80ac8d7eed9', 'Texas User 4', 'tuser4@texas.co', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(20, 3, 'tuser5', 'd1512452381bffbc48c7376541a970bf', 'Texas User 5', 'tuser5@texasco.com', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png'),
(21, 3, 'tuser6', '4623bdea61865a3c6ed36b502b8bfa0a', 'Texas User 6', 'tuser6@gmail.com', 1, '/assets/PixelAdmin/images/pixel-admin/avatar.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biblioteca_archivos`
--
ALTER TABLE `biblioteca_archivos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `biblioteca_comentarios`
--
ALTER TABLE `biblioteca_comentarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `biblioteca_entradas`
--
ALTER TABLE `biblioteca_entradas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `biblioteca_entradas_tags`
--
ALTER TABLE `biblioteca_entradas_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `biblioteca_tags`
--
ALTER TABLE `biblioteca_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_comentarios`
--
ALTER TABLE `evaluaciones_comentarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_config`
--
ALTER TABLE `evaluaciones_config`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_ejecutadas`
--
ALTER TABLE `evaluaciones_ejecutadas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_evaluadores`
--
ALTER TABLE `evaluaciones_evaluadores`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_evaluados`
--
ALTER TABLE `evaluaciones_evaluados`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_eventos`
--
ALTER TABLE `evaluaciones_eventos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_grupos`
--
ALTER TABLE `evaluaciones_grupos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_grupos_usuarios`
--
ALTER TABLE `evaluaciones_grupos_usuarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_paquetes`
--
ALTER TABLE `evaluaciones_paquetes`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indices de la tabla `evaluaciones_preguntas`
--
ALTER TABLE `evaluaciones_preguntas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones_respuestas`
--
ALTER TABLE `evaluaciones_respuestas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biblioteca_archivos`
--
ALTER TABLE `biblioteca_archivos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `biblioteca_comentarios`
--
ALTER TABLE `biblioteca_comentarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `biblioteca_entradas`
--
ALTER TABLE `biblioteca_entradas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `biblioteca_entradas_tags`
--
ALTER TABLE `biblioteca_entradas_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `biblioteca_tags`
--
ALTER TABLE `biblioteca_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_comentarios`
--
ALTER TABLE `evaluaciones_comentarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_config`
--
ALTER TABLE `evaluaciones_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_ejecutadas`
--
ALTER TABLE `evaluaciones_ejecutadas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_evaluadores`
--
ALTER TABLE `evaluaciones_evaluadores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_evaluados`
--
ALTER TABLE `evaluaciones_evaluados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_eventos`
--
ALTER TABLE `evaluaciones_eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_grupos`
--
ALTER TABLE `evaluaciones_grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_grupos_usuarios`
--
ALTER TABLE `evaluaciones_grupos_usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_paquetes`
--
ALTER TABLE `evaluaciones_paquetes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_preguntas`
--
ALTER TABLE `evaluaciones_preguntas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `evaluaciones_respuestas`
--
ALTER TABLE `evaluaciones_respuestas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
