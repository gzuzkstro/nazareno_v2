-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2014 at 03:49 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jnazareno`
--

-- --------------------------------------------------------

--
-- Table structure for table `bautizos`
--

CREATE TABLE IF NOT EXISTS `bautizos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` varchar(10) NOT NULL,
  `ciudad_nacimiento` varchar(30) NOT NULL,
  `ciudad_nacimiento_otra` varchar(30) DEFAULT NULL,
  `estado_nacimiento` varchar(30) NOT NULL,
  `pais_nacimiento` varchar(30) NOT NULL,
  `padre` varchar(100) NOT NULL,
  `madre` varchar(100) NOT NULL,
  `libro` varchar(20) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `padrino` char(100) DEFAULT NULL,
  `madrina` char(100) DEFAULT NULL,
  `ministro` char(50) NOT NULL,
  `prefectura_fecha` varchar(10) DEFAULT NULL,
  `prefectura_numero` varchar(20) DEFAULT NULL,
  `prefectura_folio` varchar(20) DEFAULT NULL,
  `prefectura_libro` char(20) DEFAULT NULL,
  `nota_marginal` text,
  `observaciones` text,
  `nota` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comuniones`
--

CREATE TABLE IF NOT EXISTS `comuniones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin NOT NULL,
  `padre` varchar(100) COLLATE utf8_bin NOT NULL,
  `madre` varchar(100) COLLATE utf8_bin NOT NULL,
  `fecha` varchar(10) COLLATE utf8_bin NOT NULL,
  `ministro` varchar(100) COLLATE utf8_bin NOT NULL,
  `libro` varchar(20) COLLATE utf8_bin NOT NULL,
  `folio` varchar(20) COLLATE utf8_bin NOT NULL,
  `numero` varchar(20) COLLATE utf8_bin NOT NULL,
  `nota_marginal` text COLLATE utf8_bin NOT NULL,
  `observaciones` text COLLATE utf8_bin NOT NULL,
  `nota` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` char(20) NOT NULL,
  `valor` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `confirmaciones`
--

CREATE TABLE IF NOT EXISTS `confirmaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin NOT NULL,
  `padre` varchar(100) COLLATE utf8_bin NOT NULL,
  `madre` varchar(100) COLLATE utf8_bin NOT NULL,
  `fecha` varchar(10) COLLATE utf8_bin NOT NULL,
  `padrino` varchar(100) COLLATE utf8_bin NOT NULL,
  `ministro` varchar(100) COLLATE utf8_bin NOT NULL,
  `lote` varchar(20) COLLATE utf8_bin NOT NULL,
  `numero` varchar(20) COLLATE utf8_bin NOT NULL,
  `nota_marginal` text COLLATE utf8_bin NOT NULL,
  `observaciones` text COLLATE utf8_bin NOT NULL,
  `nota` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matrimonios`
--

CREATE TABLE IF NOT EXISTS `matrimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(10) NOT NULL,
  `fecha_fijacion` varchar(10) NOT NULL,
  `padrino_nombre` varchar(100) NOT NULL,
  `padrino_cedula` varchar(15) NOT NULL,
  `madrina_nombre` varchar(100) NOT NULL,
  `madrina_cedula` varchar(15) NOT NULL,
  `ministro` varchar(100) NOT NULL,
  `fecha_proclamas` varchar(100) NOT NULL,
  `parroquia_proclamas` varchar(30) DEFAULT NULL,
  `observaciones` text,
  `nombres_novio` varchar(50) NOT NULL,
  `apellidos_novio` varchar(50) NOT NULL,
  `cedula_novio` varchar(11) NOT NULL,
  `bautizo_libro_novio` varchar(20) NOT NULL,
  `bautizo_folio_novio` varchar(20) NOT NULL,
  `bautizo_numero_novio` varchar(20) NOT NULL,
  `bautizo_parroquia_novio` varchar(100) NOT NULL,
  `fecha_nacimiento_novio` varchar(10) NOT NULL,
  `estado_civil_novio` varchar(10) NOT NULL,
  `ciudad_nacimiento_novio` varchar(30) NOT NULL,
  `estado_nacimiento_novio` varchar(30) NOT NULL,
  `pais_nacimiento_novio` varchar(30) NOT NULL,
  `ciudad_actual_novio` varchar(30) NOT NULL,
  `estado_actual_novio` varchar(30) NOT NULL,
  `pais_actual_novio` varchar(30) NOT NULL,
  `padre_novio` varchar(100) NOT NULL,
  `madre_novio` varchar(100) NOT NULL,
  `telefono_novio` varchar(14) NOT NULL,
  `nombre_testigo_novio` varchar(100) NOT NULL,
  `cedula_testigo_novio` varchar(11) NOT NULL,
  `direccion_testigo_novio` text NOT NULL,
  `estado_testigo_novio` varchar(30) NOT NULL,
  `tnovio_testigo_novio` int(11) NOT NULL,
  `tnovia_testigo_novio` int(11) NOT NULL,
  `nombres_novia` varchar(50) NOT NULL,
  `apellidos_novia` varchar(50) NOT NULL,
  `cedula_novia` varchar(11) NOT NULL,
  `bautizo_libro_novia` varchar(20) NOT NULL,
  `bautizo_folio_novia` varchar(20) NOT NULL,
  `bautizo_numero_novia` varchar(20) NOT NULL,
  `bautizo_parroquia_novia` varchar(100) NOT NULL,
  `fecha_nacimiento_novia` varchar(10) NOT NULL,
  `estado_civil_novia` varchar(10) NOT NULL,
  `ciudad_nacimiento_novia` varchar(30) NOT NULL,
  `estado_nacimiento_novia` varchar(30) NOT NULL,
  `pais_nacimiento_novia` varchar(30) NOT NULL,
  `ciudad_actual_novia` varchar(30) NOT NULL,
  `estado_actual_novia` varchar(30) NOT NULL,
  `pais_actual_novia` varchar(30) NOT NULL,
  `padre_novia` varchar(100) NOT NULL,
  `madre_novia` varchar(100) NOT NULL,
  `telefono_novia` varchar(14) NOT NULL,
  `nombre_testigo_novia` varchar(100) NOT NULL,
  `cedula_testigo_novia` varchar(11) NOT NULL,
  `direccion_testigo_novia` text NOT NULL,
  `estado_testigo_novia` varchar(30) NOT NULL,
  `tnovio_testigo_novia` int(11) NOT NULL,
  `tnovia_testigo_novia` int(11) NOT NULL,
  `fecha_constancia_curso_prematrimonial` varchar(30) DEFAULT NULL,
  `certificado_matrimonio_civil` varchar(30) DEFAULT NULL,
  `documentos_curia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` char(20) NOT NULL,
  `password` char(40) NOT NULL,
  `rol` char(1) NOT NULL DEFAULT 'N' COMMENT 'N = Normal A = Admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* Datos iniciales */
INSERT INTO `usuarios`(`usuario`, `password`, `rol`) VALUES('admin', '128abc50bdc2f73b2c0d75fc476debfbb799cce3', 'A');
INSERT INTO `configuracion`(`parametro`, `valor`) VALUES('presbitero', '');