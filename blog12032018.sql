-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 05:16 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
('66A145AD-098D-41AE-A346-0F660589919C', 'Generales');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_publicacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `id_parent_comment` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_usuario`, `id_publicacion`, `comentario`, `fecha_creacion`, `id_parent_comment`) VALUES
('47E0504C-F18C-40EB-BB64-ABDD13AA138D', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'fdfasdfadsfasdf', '2018-03-11', '0'),
('50c0112c-7cd1-4793-8c99-09201ea89177\r\n', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'Me parece que esto y lo otro', '2018-03-07', '0'),
('5d7df321-9cb3-431c-9203-f3b95916ea56', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'Bueno si', '2018-03-08', '50c0112c-7cd1-4793-8c99-09201ea89177'),
('73d29043-6e67-40da-bdd0-f3366b0d744d', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'Estaba equivocada la opinion entonces me rectifico', '2018-03-08', '50c0112c-7cd1-4793-8c99-09201ea89177'),
('A262A0A5-8D65-410F-9911-ED11437DD05F', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'comentario tales', '2018-03-11', '0'),
('AC9BD30A-9633-41AE-A7D6-529E9F21325C', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'fadsfadsfadsfsdaf', '2018-03-11', '0'),
('ccd9809d-eda3-4ebf-ab58-83ef1729b8cf', '78940958-09F5-4DE6-8339-874F3CCF6F1F', 'F384F9EB-684E-4FBB-9D10-B5F0182B5BA5', 'este es el comentario de tales', '2018-03-06', '0'),
('FBACD722-49F9-4FAD-940E-336E6BF8C4A9', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '980bd970-588c-4deb-b3f2-c447674cb5c1', 'fasfadsfadsfasdfadsf', '2018-03-11', '0');

-- --------------------------------------------------------

--
-- Table structure for table `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_publicacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `visto` int(11) NOT NULL DEFAULT '0',
  `comentarios` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `publicaciones`
--

INSERT INTO `publicaciones` (`id_publicacion`, `id_usuario`, `id_categoria`, `titulo`, `contenido`, `fecha_creacion`, `imagen`, `visto`, `comentarios`) VALUES
('980bd970-588c-4deb-b3f2-c447674cb5c1', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '66A145AD-098D-41AE-A346-0F660589919C', 'Nueva', 'Este es el contenido de la entrada', '2018-03-07', '', 2, 3),
('F384F9EB-684E-4FBB-9D10-B5F0182B5BA5', '78940958-09F5-4DE6-8339-874F3CCF6F1F', '66A145AD-098D-41AE-A346-0F660589919C', 'Porque no se lee criticamente', 'Las bases de la tales por tales por cuales entre tanto y por otro lado de la misma forma sugieren ', '2018-03-05', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_user` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `alias_user` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pwd_user` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `curso` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo` varchar(3) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombre`, `alias_user`, `fecha_ingreso`, `estado`, `correo`, `pwd_user`, `curso`, `codigo`, `foto`) VALUES
('78940958-09F5-4DE6-8339-874F3CCF6F1F', 'Magola Perez', 'Juanita', '2018-03-14', 'Active', 'juana@test.com', '123', '1102', '1', 'juanita.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`,`id_usuario`,`id_publicacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indexes for table `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_publicacion`,`id_usuario`,`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
