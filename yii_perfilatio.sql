-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-10-2015 a las 13:40:26
-- Versión del servidor: 5.5.43-0ubuntu0.14.10.1
-- Versión de PHP: 5.5.12-2ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yii_perfilatio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE IF NOT EXISTS `acciones` (
  `ID_ACCION` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_perfil`
--

CREATE TABLE IF NOT EXISTS `acciones_perfil` (
  `ID_ACCION` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacidades`
--

CREATE TABLE IF NOT EXISTS `capacidades` (
  `ID_CAPACIDADES` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacidades_perfil`
--

CREATE TABLE IF NOT EXISTS `capacidades_perfil` (
  `ID_CAPACIDADES` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `CUMPLE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE IF NOT EXISTS `competencias` (
  `ID_COMPETENCIAS` int(11) NOT NULL DEFAULT '0',
  `ID_COMPETENCIAS_CATEGORIA` int(11) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias_categorias`
--

CREATE TABLE IF NOT EXISTS `competencias_categorias` (
  `ID_COMPETENCIAS_CATEGORIAS` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias_perfil`
--

CREATE TABLE IF NOT EXISTS `competencias_perfil` (
  `ID_COMPETENCIAS_CATEGORIAS` int(11) NOT NULL DEFAULT '0',
  `ID_COMPETENCIAS` int(11) DEFAULT NULL,
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `NIVEL` int(11) DEFAULT NULL COMMENT '1: INICIAL 2 MEDIO, 3: EXPERTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios_competencias`
--

CREATE TABLE IF NOT EXISTS `criterios_competencias` (
  `ID_MATRIZ_COMPETENCIA` int(11) DEFAULT NULL,
  `ID_CRITERIO_COMPETENCIA` int(11) NOT NULL DEFAULT '0',
  `CRITERIO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacion`
--

CREATE TABLE IF NOT EXISTS `educacion` (
  `ID_EDUCACION` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `GRADO_ESTUDIO` int(11) DEFAULT NULL,
  `NOMBRE_CARRERA` varchar(255) DEFAULT NULL,
  `NOMBRE_AREA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `ID_EVALUACION` int(11) NOT NULL DEFAULT '0',
  `ID_MATRIZ_TODO` int(11) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `CALIFICACION` int(11) DEFAULT NULL,
  `COMENTARIOS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades`
--

CREATE TABLE IF NOT EXISTS `habilidades` (
  `ID_HABILIDAD` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `ANOS` int(11) DEFAULT NULL,
  `CONOCE` varchar(255) DEFAULT NULL,
  `DESARROLLA` varchar(255) DEFAULT NULL,
  `SUPERVISA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades_perfil_trato`
--

CREATE TABLE IF NOT EXISTS `habilidades_perfil_trato` (
  `ID_HABILIDAD` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `CUMPLE` int(11) DEFAULT NULL,
  `OTRAS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades_trato`
--

CREATE TABLE IF NOT EXISTS `habilidades_trato` (
  `ID_HABILIDAD` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
  `ID_IDIOMA` int(11) NOT NULL DEFAULT '0',
  `NOMBRE_IDIOMA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriz`
--

CREATE TABLE IF NOT EXISTS `matriz` (
  `ID_MATRIZ` int(11) NOT NULL DEFAULT '0',
  `CODIGO` int(11) DEFAULT NULL,
  `NOMBRE_MATRIZ` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriz_ambitos`
--

CREATE TABLE IF NOT EXISTS `matriz_ambitos` (
  `ID_MATRIZ_AMBITOS` int(11) NOT NULL DEFAULT '0',
  `ID_MATRIZ` int(11) DEFAULT NULL,
  `AMBITO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriz_competencias`
--

CREATE TABLE IF NOT EXISTS `matriz_competencias` (
  `ID_MATRIZ_AMBITOS` int(11) NOT NULL DEFAULT '0',
  `ID_MATRIZ_COMPETENCIA` int(11) DEFAULT NULL,
  `NOMBRE_COMPETENCIA` varchar(255) DEFAULT NULL,
  `DEFINICION_COMPETENCIA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriz_todo`
--

CREATE TABLE IF NOT EXISTS `matriz_todo` (
  `ID_MATRIZ_TODO` int(11) NOT NULL DEFAULT '0',
  `ID_MATRIZ_AMBITO` int(11) DEFAULT NULL,
  `ID_MATRIZ_COMPETENCIA` int(11) DEFAULT NULL,
  `ID_CRITERIOS_COMPETENCIA` int(11) DEFAULT NULL,
  `NIVEL` int(11) DEFAULT NULL,
  `REQUERIDO` int(11) DEFAULT NULL,
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `paquetes_perfil`
--

CREATE TABLE IF NOT EXISTS `paquetes_perfil` (
  `ID_PAQUETE_INFO` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `NA` int(11) DEFAULT NULL,
  `DESEABLE` varchar(255) DEFAULT NULL,
  `DESEMPENO_BASICO` varchar(255) DEFAULT NULL,
  `DOMINIO_TOTAL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_informatico`
--

CREATE TABLE IF NOT EXISTS `paquete_informatico` (
  `ID_PAQUETE` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `ID_PERFIL_PUESTO` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL,
  `RAZON` varchar(255) DEFAULT NULL,
  `OBJETIVO` text,
  `JUSTIFICACION` text,
  `SEXO` varchar(255) DEFAULT NULL,
  `EDAD` int(11) DEFAULT NULL,
  `ESTADO_CIVIL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_idiomas`
--

CREATE TABLE IF NOT EXISTS `perfil_idiomas` (
  `ID_IDIOMA` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `COMPRENSION` varchar(255) DEFAULT NULL,
  `HABLADO` varchar(255) DEFAULT NULL,
  `DESEMPENO` varchar(255) DEFAULT NULL,
  `NO_NECESARIO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos_reporte`
--

CREATE TABLE IF NOT EXISTS `puestos_reporte` (
  `ID_PUESTO_REPORTE` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `ID_RECURSO` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso_perfil`
--

CREATE TABLE IF NOT EXISTS `recurso_perfil` (
  `ID_RECURSO` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `CUMPLE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsabilidades`
--

CREATE TABLE IF NOT EXISTS `responsabilidades` (
  `ID_RESPONSABILIDAD` int(11) NOT NULL,
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL,
  `RESPONSABILIDAD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `ID_ROL` int(11) NOT NULL DEFAULT '0',
  `NOMBR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanos`
--

CREATE TABLE IF NOT EXISTS `tamanos` (
  `ID_TAMANOS` int(11) NOT NULL DEFAULT '0',
  `RANGO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanos_perfil`
--

CREATE TABLE IF NOT EXISTS `tamanos_perfil` (
  `ID_TAMANOS` int(11) DEFAULT NULL,
  `ID_PERFIL_PUESTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
 ADD PRIMARY KEY (`ID_ACCION`);

--
-- Indices de la tabla `acciones_perfil`
--
ALTER TABLE `acciones_perfil`
 ADD PRIMARY KEY (`ID_ACCION`);

--
-- Indices de la tabla `capacidades`
--
ALTER TABLE `capacidades`
 ADD PRIMARY KEY (`ID_CAPACIDADES`);

--
-- Indices de la tabla `capacidades_perfil`
--
ALTER TABLE `capacidades_perfil`
 ADD PRIMARY KEY (`ID_CAPACIDADES`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
 ADD PRIMARY KEY (`ID_COMPETENCIAS`);

--
-- Indices de la tabla `competencias_categorias`
--
ALTER TABLE `competencias_categorias`
 ADD PRIMARY KEY (`ID_COMPETENCIAS_CATEGORIAS`);

--
-- Indices de la tabla `competencias_perfil`
--
ALTER TABLE `competencias_perfil`
 ADD PRIMARY KEY (`ID_COMPETENCIAS_CATEGORIAS`);

--
-- Indices de la tabla `criterios_competencias`
--
ALTER TABLE `criterios_competencias`
 ADD PRIMARY KEY (`ID_CRITERIO_COMPETENCIA`);

--
-- Indices de la tabla `educacion`
--
ALTER TABLE `educacion`
 ADD PRIMARY KEY (`ID_EDUCACION`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
 ADD PRIMARY KEY (`ID_EVALUACION`);

--
-- Indices de la tabla `habilidades`
--
ALTER TABLE `habilidades`
 ADD PRIMARY KEY (`ID_HABILIDAD`);

--
-- Indices de la tabla `habilidades_perfil_trato`
--
ALTER TABLE `habilidades_perfil_trato`
 ADD PRIMARY KEY (`ID_HABILIDAD`);

--
-- Indices de la tabla `habilidades_trato`
--
ALTER TABLE `habilidades_trato`
 ADD PRIMARY KEY (`ID_HABILIDAD`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
 ADD PRIMARY KEY (`ID_IDIOMA`);

--
-- Indices de la tabla `matriz`
--
ALTER TABLE `matriz`
 ADD PRIMARY KEY (`ID_MATRIZ`);

--
-- Indices de la tabla `matriz_ambitos`
--
ALTER TABLE `matriz_ambitos`
 ADD PRIMARY KEY (`ID_MATRIZ_AMBITOS`);

--
-- Indices de la tabla `matriz_competencias`
--
ALTER TABLE `matriz_competencias`
 ADD PRIMARY KEY (`ID_MATRIZ_AMBITOS`);

--
-- Indices de la tabla `matriz_todo`
--
ALTER TABLE `matriz_todo`
 ADD PRIMARY KEY (`ID_MATRIZ_TODO`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes_perfil`
--
ALTER TABLE `paquetes_perfil`
 ADD PRIMARY KEY (`ID_PAQUETE_INFO`);

--
-- Indices de la tabla `paquete_informatico`
--
ALTER TABLE `paquete_informatico`
 ADD PRIMARY KEY (`ID_PAQUETE`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`ID_PERFIL_PUESTO`);

--
-- Indices de la tabla `perfil_idiomas`
--
ALTER TABLE `perfil_idiomas`
 ADD PRIMARY KEY (`ID_IDIOMA`);

--
-- Indices de la tabla `puestos_reporte`
--
ALTER TABLE `puestos_reporte`
 ADD PRIMARY KEY (`ID_PUESTO_REPORTE`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
 ADD PRIMARY KEY (`ID_RECURSO`);

--
-- Indices de la tabla `recurso_perfil`
--
ALTER TABLE `recurso_perfil`
 ADD PRIMARY KEY (`ID_RECURSO`);

--
-- Indices de la tabla `responsabilidades`
--
ALTER TABLE `responsabilidades`
 ADD PRIMARY KEY (`ID_RESPONSABILIDAD`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `tamanos`
--
ALTER TABLE `tamanos`
 ADD PRIMARY KEY (`ID_TAMANOS`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
