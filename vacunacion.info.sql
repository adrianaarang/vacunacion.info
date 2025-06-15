-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2025 a las 16:35:56
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
-- Base de datos: `vacunacion.info`
--
CREATE DATABASE IF NOT EXISTS `vacunacion.info` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vacunacion.info`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_vacunas`
--

DROP TABLE IF EXISTS `calendario_vacunas`;
CREATE TABLE `calendario_vacunas` (
  `id` int(11) NOT NULL,
  `vacuna_id` int(11) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `edad_meses` int(11) NOT NULL,
  `es_financiada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendario_vacunas`
--

INSERT INTO `calendario_vacunas` (`id`, `vacuna_id`, `comunidad_id`, `edad_meses`, `es_financiada`) VALUES
(1, 1, 1, 2, 1),
(2, 1, 1, 4, 1),
(3, 1, 1, 11, 1),
(4, 1, 2, 2, 1),
(5, 1, 2, 4, 1),
(6, 1, 2, 11, 1),
(7, 1, 3, 2, 1),
(8, 1, 3, 4, 1),
(9, 1, 3, 11, 1),
(10, 1, 4, 2, 1),
(11, 1, 4, 4, 1),
(12, 1, 4, 11, 1),
(13, 1, 5, 2, 1),
(14, 1, 5, 4, 1),
(15, 1, 5, 11, 1),
(16, 1, 6, 2, 1),
(17, 1, 6, 4, 1),
(18, 1, 6, 11, 1),
(19, 1, 7, 2, 1),
(20, 1, 7, 4, 1),
(21, 1, 7, 11, 1),
(22, 1, 8, 2, 1),
(23, 1, 8, 4, 1),
(24, 1, 8, 11, 1),
(25, 1, 9, 2, 1),
(26, 1, 9, 4, 1),
(27, 1, 9, 11, 1),
(28, 1, 10, 2, 1),
(29, 1, 10, 4, 1),
(30, 1, 10, 11, 1),
(31, 1, 11, 2, 1),
(32, 1, 11, 4, 1),
(33, 1, 11, 11, 1),
(34, 1, 12, 2, 1),
(35, 1, 12, 4, 1),
(36, 1, 12, 11, 1),
(37, 1, 13, 2, 1),
(38, 1, 13, 4, 1),
(39, 1, 13, 11, 1),
(40, 1, 14, 2, 1),
(41, 1, 14, 4, 1),
(42, 1, 14, 11, 1),
(43, 1, 15, 2, 1),
(44, 1, 15, 4, 1),
(45, 1, 15, 11, 1),
(46, 1, 16, 2, 1),
(47, 1, 16, 4, 1),
(48, 1, 16, 11, 1),
(49, 1, 17, 2, 1),
(50, 1, 17, 4, 1),
(51, 1, 17, 11, 1),
(52, 1, 18, 2, 1),
(53, 1, 18, 4, 1),
(54, 1, 18, 11, 1),
(55, 1, 19, 2, 1),
(56, 1, 19, 4, 1),
(57, 1, 19, 11, 1),
(58, 2, 1, 2, 1),
(59, 2, 1, 4, 1),
(60, 2, 1, 11, 1),
(61, 2, 2, 2, 1),
(62, 2, 2, 4, 1),
(63, 2, 2, 11, 1),
(64, 2, 3, 2, 1),
(65, 2, 3, 4, 1),
(66, 2, 3, 11, 1),
(67, 2, 4, 2, 1),
(68, 2, 4, 4, 1),
(69, 2, 4, 11, 1),
(70, 2, 5, 2, 1),
(71, 2, 5, 4, 1),
(72, 2, 5, 11, 1),
(73, 2, 6, 2, 1),
(74, 2, 6, 4, 1),
(75, 2, 6, 11, 1),
(76, 2, 7, 2, 1),
(77, 2, 7, 4, 1),
(78, 2, 7, 11, 1),
(79, 2, 8, 2, 1),
(80, 2, 8, 4, 1),
(81, 2, 8, 11, 1),
(82, 2, 9, 2, 1),
(83, 2, 9, 4, 1),
(84, 2, 9, 11, 1),
(85, 2, 10, 2, 1),
(86, 2, 10, 4, 1),
(87, 2, 10, 11, 1),
(88, 2, 11, 2, 1),
(89, 2, 11, 4, 1),
(90, 2, 11, 11, 1),
(91, 2, 12, 2, 1),
(92, 2, 12, 4, 1),
(93, 2, 12, 11, 1),
(94, 2, 13, 2, 1),
(95, 2, 13, 4, 1),
(96, 2, 13, 11, 1),
(97, 2, 14, 2, 1),
(98, 2, 14, 4, 1),
(99, 2, 14, 11, 1),
(100, 2, 15, 2, 1),
(101, 2, 15, 4, 1),
(102, 2, 15, 11, 1),
(103, 2, 16, 2, 1),
(104, 2, 16, 4, 1),
(105, 2, 16, 11, 1),
(106, 2, 17, 2, 1),
(107, 2, 17, 4, 1),
(108, 2, 17, 11, 1),
(109, 2, 18, 2, 1),
(110, 2, 18, 4, 1),
(111, 2, 18, 11, 1),
(112, 2, 19, 2, 1),
(113, 2, 19, 4, 1),
(114, 2, 19, 11, 1),
(115, 3, 1, 2, 0),
(116, 3, 1, 4, 0),
(117, 3, 2, 2, 0),
(118, 3, 2, 4, 0),
(119, 3, 3, 2, 0),
(120, 3, 3, 4, 0),
(121, 3, 4, 2, 0),
(122, 3, 4, 4, 0),
(123, 3, 5, 2, 0),
(124, 3, 5, 4, 0),
(125, 3, 6, 2, 0),
(126, 3, 6, 4, 0),
(127, 3, 7, 2, 0),
(128, 3, 7, 4, 0),
(129, 3, 8, 2, 0),
(130, 3, 8, 4, 0),
(131, 3, 9, 2, 0),
(132, 3, 9, 4, 0),
(133, 3, 10, 2, 0),
(134, 3, 10, 4, 0),
(135, 3, 11, 2, 0),
(136, 3, 11, 4, 0),
(137, 3, 12, 2, 0),
(138, 3, 12, 4, 0),
(139, 3, 13, 2, 0),
(140, 3, 13, 4, 0),
(141, 3, 14, 2, 0),
(142, 3, 14, 4, 0),
(143, 3, 15, 2, 0),
(144, 3, 15, 4, 0),
(145, 3, 16, 2, 0),
(146, 3, 16, 4, 0),
(147, 3, 17, 2, 0),
(148, 3, 17, 4, 0),
(149, 3, 18, 2, 0),
(150, 3, 18, 4, 0),
(151, 3, 19, 2, 0),
(152, 3, 19, 4, 0),
(153, 4, 1, 2, 1),
(154, 4, 1, 4, 1),
(155, 4, 1, 12, 1),
(156, 4, 2, 2, 1),
(157, 4, 2, 4, 1),
(158, 4, 2, 12, 1),
(159, 4, 3, 2, 1),
(160, 4, 3, 4, 1),
(161, 4, 3, 12, 1),
(162, 4, 4, 2, 1),
(163, 4, 4, 4, 1),
(164, 4, 4, 12, 1),
(165, 4, 5, 2, 1),
(166, 4, 5, 4, 1),
(167, 4, 5, 12, 1),
(168, 4, 6, 2, 1),
(169, 4, 6, 4, 1),
(170, 4, 6, 12, 1),
(171, 4, 7, 2, 1),
(172, 4, 7, 4, 1),
(173, 4, 7, 12, 1),
(174, 4, 8, 2, 1),
(175, 4, 8, 4, 1),
(176, 4, 8, 12, 1),
(177, 4, 9, 2, 1),
(178, 4, 9, 4, 1),
(179, 4, 9, 12, 1),
(180, 4, 10, 2, 1),
(181, 4, 10, 4, 1),
(182, 4, 10, 12, 1),
(183, 4, 11, 2, 1),
(184, 4, 11, 4, 1),
(185, 4, 11, 12, 1),
(186, 4, 12, 2, 1),
(187, 4, 12, 4, 1),
(188, 4, 12, 12, 1),
(189, 4, 13, 2, 1),
(190, 4, 13, 4, 1),
(191, 4, 13, 12, 1),
(192, 4, 14, 2, 1),
(193, 4, 14, 4, 1),
(194, 4, 14, 12, 1),
(195, 4, 15, 2, 1),
(196, 4, 15, 4, 1),
(197, 4, 15, 12, 1),
(198, 4, 16, 2, 1),
(199, 4, 16, 4, 1),
(200, 4, 16, 12, 1),
(201, 4, 17, 2, 1),
(202, 4, 17, 4, 1),
(203, 4, 17, 12, 1),
(204, 4, 18, 2, 1),
(205, 4, 18, 4, 1),
(206, 4, 18, 12, 1),
(207, 4, 19, 2, 1),
(208, 4, 19, 4, 1),
(209, 4, 19, 12, 1),
(210, 5, 1, 4, 1),
(211, 5, 1, 12, 1),
(212, 5, 2, 4, 1),
(213, 5, 2, 12, 1),
(214, 5, 3, 4, 1),
(215, 5, 3, 12, 1),
(216, 5, 4, 4, 1),
(217, 5, 4, 12, 1),
(218, 5, 5, 4, 1),
(219, 5, 5, 12, 1),
(220, 5, 6, 4, 1),
(221, 5, 6, 12, 1),
(222, 5, 7, 4, 1),
(223, 5, 7, 12, 1),
(224, 5, 8, 4, 1),
(225, 5, 8, 12, 1),
(226, 5, 9, 4, 1),
(227, 5, 9, 12, 1),
(228, 5, 10, 4, 1),
(229, 5, 10, 12, 1),
(230, 5, 11, 4, 1),
(231, 5, 11, 12, 1),
(232, 5, 12, 4, 1),
(233, 5, 12, 12, 1),
(234, 5, 13, 4, 1),
(235, 5, 13, 12, 1),
(236, 5, 14, 4, 1),
(237, 5, 14, 12, 1),
(238, 5, 15, 4, 1),
(239, 5, 15, 12, 1),
(240, 5, 16, 4, 1),
(241, 5, 16, 12, 1),
(242, 5, 17, 4, 1),
(243, 5, 17, 12, 1),
(244, 5, 18, 4, 1),
(245, 5, 18, 12, 1),
(246, 5, 19, 4, 1),
(247, 5, 19, 12, 1),
(248, 6, 1, 12, 1),
(249, 6, 1, 144, 1),
(250, 6, 2, 12, 1),
(251, 6, 2, 144, 1),
(252, 6, 3, 12, 1),
(253, 6, 3, 144, 1),
(254, 6, 4, 12, 1),
(255, 6, 4, 144, 1),
(256, 6, 5, 12, 1),
(257, 6, 5, 144, 1),
(258, 6, 6, 12, 1),
(259, 6, 6, 144, 1),
(260, 6, 7, 12, 1),
(261, 6, 7, 144, 1),
(262, 6, 8, 12, 1),
(263, 6, 8, 144, 1),
(264, 6, 9, 12, 1),
(265, 6, 9, 144, 1),
(266, 6, 10, 12, 1),
(267, 6, 10, 144, 1),
(268, 6, 11, 12, 1),
(269, 6, 11, 144, 1),
(270, 6, 12, 12, 1),
(271, 6, 12, 144, 1),
(272, 6, 13, 12, 1),
(273, 6, 13, 144, 1),
(274, 6, 14, 12, 1),
(275, 6, 14, 144, 1),
(276, 6, 15, 12, 1),
(277, 6, 15, 144, 1),
(278, 6, 16, 12, 1),
(279, 6, 16, 144, 1),
(280, 6, 17, 12, 1),
(281, 6, 17, 144, 1),
(282, 6, 18, 12, 1),
(283, 6, 18, 144, 1),
(284, 6, 19, 12, 1),
(285, 6, 19, 144, 1),
(286, 7, 1, 12, 1),
(287, 7, 1, 48, 1),
(288, 7, 2, 12, 1),
(289, 7, 2, 48, 1),
(290, 7, 3, 12, 1),
(291, 7, 3, 48, 1),
(292, 7, 4, 12, 1),
(293, 7, 4, 48, 1),
(294, 7, 5, 12, 1),
(295, 7, 5, 48, 1),
(296, 7, 6, 12, 1),
(297, 7, 6, 48, 1),
(298, 7, 7, 12, 1),
(299, 7, 7, 48, 1),
(300, 7, 8, 12, 1),
(301, 7, 8, 48, 1),
(302, 7, 9, 12, 1),
(303, 7, 9, 48, 1),
(304, 7, 10, 12, 1),
(305, 7, 10, 48, 1),
(306, 7, 11, 12, 1),
(307, 7, 11, 48, 1),
(308, 7, 12, 12, 1),
(309, 7, 12, 48, 1),
(310, 7, 13, 12, 1),
(311, 7, 13, 48, 1),
(312, 7, 14, 12, 1),
(313, 7, 14, 48, 1),
(314, 7, 15, 12, 1),
(315, 7, 15, 48, 1),
(316, 7, 16, 12, 1),
(317, 7, 16, 48, 1),
(318, 7, 17, 12, 1),
(319, 7, 17, 48, 1),
(320, 7, 18, 12, 1),
(321, 7, 18, 48, 1),
(322, 7, 19, 12, 1),
(323, 7, 19, 48, 1),
(324, 8, 1, 15, 1),
(325, 8, 1, 48, 1),
(326, 8, 2, 15, 1),
(327, 8, 2, 48, 1),
(328, 8, 3, 15, 1),
(329, 8, 3, 48, 1),
(330, 8, 4, 15, 1),
(331, 8, 4, 48, 1),
(332, 8, 5, 15, 1),
(333, 8, 5, 48, 1),
(334, 8, 6, 15, 1),
(335, 8, 6, 48, 1),
(336, 8, 7, 15, 1),
(337, 8, 7, 48, 1),
(338, 8, 8, 15, 1),
(339, 8, 8, 48, 1),
(340, 8, 9, 15, 1),
(341, 8, 9, 48, 1),
(342, 8, 10, 15, 1),
(343, 8, 10, 48, 1),
(344, 8, 11, 15, 1),
(345, 8, 11, 48, 1),
(346, 8, 12, 15, 1),
(347, 8, 12, 48, 1),
(348, 8, 13, 15, 1),
(349, 8, 13, 48, 1),
(350, 8, 14, 15, 1),
(351, 8, 14, 48, 1),
(352, 8, 15, 15, 1),
(353, 8, 15, 48, 1),
(354, 8, 16, 15, 1),
(355, 8, 16, 48, 1),
(356, 8, 17, 15, 1),
(357, 8, 17, 48, 1),
(358, 8, 18, 15, 1),
(359, 8, 18, 48, 1),
(360, 8, 19, 15, 1),
(361, 8, 19, 48, 1),
(362, 9, 1, 144, 1),
(363, 9, 2, 144, 1),
(364, 9, 3, 144, 1),
(365, 9, 4, 144, 1),
(366, 9, 5, 144, 1),
(367, 9, 6, 144, 1),
(368, 9, 7, 144, 1),
(369, 9, 8, 144, 1),
(370, 9, 9, 144, 1),
(371, 9, 10, 144, 1),
(372, 9, 11, 144, 1),
(373, 9, 12, 144, 1),
(374, 9, 13, 144, 1),
(375, 9, 14, 144, 1),
(376, 9, 15, 144, 1),
(377, 9, 16, 144, 1),
(378, 9, 17, 144, 1),
(379, 9, 18, 144, 1),
(380, 9, 19, 144, 1),
(381, 10, 1, 6, 0),
(382, 10, 2, 6, 0),
(383, 10, 3, 6, 0),
(384, 10, 4, 6, 0),
(385, 10, 5, 6, 0),
(386, 10, 6, 6, 0),
(387, 10, 7, 6, 0),
(388, 10, 8, 6, 0),
(389, 10, 9, 6, 0),
(390, 10, 10, 6, 0),
(391, 10, 11, 6, 0),
(392, 10, 12, 6, 0),
(393, 10, 13, 6, 0),
(394, 10, 14, 6, 0),
(395, 10, 15, 6, 0),
(396, 10, 16, 6, 0),
(397, 10, 17, 6, 0),
(398, 10, 18, 6, 0),
(399, 10, 19, 6, 0),
(400, 11, 1, 60, 0),
(401, 11, 2, 60, 0),
(402, 11, 3, 60, 0),
(403, 11, 4, 60, 0),
(404, 11, 5, 60, 0),
(405, 11, 6, 60, 0),
(406, 11, 7, 60, 0),
(407, 11, 8, 60, 0),
(408, 11, 9, 60, 0),
(409, 11, 10, 60, 0),
(410, 11, 11, 60, 0),
(411, 11, 12, 60, 0),
(412, 11, 13, 60, 0),
(413, 11, 14, 60, 0),
(414, 11, 15, 60, 0),
(415, 11, 16, 60, 0),
(416, 11, 17, 60, 0),
(417, 11, 18, 60, 0),
(418, 11, 19, 60, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

DROP TABLE IF EXISTS `comunidades`;
CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `foto_calendario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id`, `nombre`, `foto_calendario`) VALUES
(1, 'Andalucía', 'bootstrap/img/calendario/andalucia.jpg'),
(2, 'Aragón', 'bootstrap/img/calendario/aragon.jpg'),
(3, 'Asturias', 'bootstrap/img/calendario/asturias.jpg'),
(4, 'Islas Baleares', 'bootstrap/img/calendario/islas_baleares.jpg'),
(5, 'Canarias', 'bootstrap/img/calendario/canarias.jpg'),
(6, 'Cantabria', 'bootstrap/img/calendario/cantabria.jpg'),
(7, 'Castilla-La Mancha', 'bootstrap/img/calendario/castilla_la_mancha.jpg'),
(8, 'Castilla y León', 'bootstrap/img/calendario/castilla_y_leon.jpg'),
(9, 'Cataluña', 'bootstrap/img/calendario/catalunya.jpg'),
(10, 'Extremadura', 'bootstrap/img/calendario/extremadura.jpg'),
(11, 'Galicia', 'bootstrap/img/calendario/galicia.jpg'),
(12, 'Madrid', 'bootstrap/img/calendario/madrid.jpg'),
(13, 'Murcia', 'bootstrap/img/calendario/murcia.jpg'),
(14, 'Navarra', 'bootstrap/img/calendario/navarra.jpg'),
(15, 'País Vasco', 'bootstrap/img/calendario/pais_vasco.jpg'),
(16, 'La Rioja', 'bootstrap/img/calendario/la_rioja.jpg'),
(17, 'Comunidad Valenciana', 'bootstrap/img/calendario/comunidad_valenciana.jpg'),
(18, 'Ceuta', 'bootstrap/img/calendario/ceuta.jpg'),
(19, 'Melilla', 'bootstrap/img/calendario/melilla.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijos`
--

DROP TABLE IF EXISTS `hijos`;
CREATE TABLE `hijos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hijos`
--

INSERT INTO `hijos` (`id`, `usuario_id`, `fecha_nacimiento`) VALUES
(12, 6, '2025-05-10'),
(13, 7, '2021-08-09'),
(14, 7, '2024-05-25'),
(15, 8, '2010-06-14'),
(16, 9, '2023-04-23'),
(17, 10, '2023-03-20'),
(18, 10, '2025-03-20'),
(19, 11, '2013-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios_enviados`
--

DROP TABLE IF EXISTS `recordatorios_enviados`;
CREATE TABLE `recordatorios_enviados` (
  `id` int(11) NOT NULL,
  `hijo_id` int(11) NOT NULL,
  `vacuna_nombre` varchar(255) NOT NULL,
  `edad_meses` int(11) NOT NULL,
  `dias_antes` int(11) NOT NULL,
  `fecha_envio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recordatorios_enviados`
--

INSERT INTO `recordatorios_enviados` (`id`, `hijo_id`, `vacuna_nombre`, `edad_meses`, `dias_antes`, `fecha_envio`) VALUES
(1, 12, 'Hexavalente', 2, 30, '2025-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `comunidad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `comunidad_id`) VALUES
(1, 'Administrador', 'administrador@vacunacion.info', 'Admin1234.', NULL),
(6, 'adriana', 'adriaranguez89@gmail.com', 'Gonzalito1.', 12),
(7, 'Sara', 'sara@gmail.com', 'Lara1234.', 12),
(8, 'Juan', 'juanperezregueira@hotmail.es', 'Juanito34.', 12),
(9, 'manolo', 'manolo@gmail.com', '$2y$10$FzZc5a889l/iRKkHTktJ1ekVIHEeNc/9eMYlCRsNCGQKbLphRr8Qy', 16),
(10, 'Andrea', 'andrea@gmail.com', '$2y$10$PZpDKhzd6AWklyiECbhJ7OLKLhm7pVZHADDwmCLjSGDvv8t78uUby', 8),
(11, 'Sol', 'sol@gmail.com', '$2y$10$ui286dgQvKpXe3fvPaCv4e2OxQwblT5zwM.W9aV.mzcxVQ8.7/bRi', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

DROP TABLE IF EXISTS `vacunas`;
CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `nombre`, `descripcion`, `codigo`) VALUES
(1, 'Hexavalente', 'Vacuna combinada que protege contra difteria, tétanos, tosferina, poliomielitis, Haemophilus influenzae tipo b y hepatitis B', 'HEX'),
(2, 'Neumococo conjugada 13 (VNC13)', 'Contra Streptococcus pneumoniae, responsable de neumonías, otitis y meningitis', 'PCV13'),
(3, 'Meningococo C conjugada (MenC)', 'Protección frente a Neisseria meningitidis serogrupo C', 'MENC'),
(4, 'Triple Vírica (SRP)', 'Sarampión, rubeola y parotiditis', 'SRP'),
(5, 'Varicela', 'Vacuna contra el virus de la varicela-zóster', 'VAR'),
(6, 'Virus del Papiloma Humano (VPH)', 'Prevención de cáncer de cuello uterino y otras lesiones producidas por VPH', 'VPH'),
(7, 'Rotavirus (RV)', 'Vacuna oral para prevenir gastroenteritis graves en bebés', 'RV'),
(8, 'Meningococo B (MenB)', 'Contra Neisseria meningitidis serogrupo B, causa de meningitis invasiva', 'MENB'),
(9, 'Meningococo ACWY (MenACWY)', 'Protege contra los serogrupos A, C, W e Y de Neisseria meningitidis', 'MENACWY'),
(10, 'Gripe', 'Vacuna estacional frente a virus influenza A y B', 'GRIPE'),
(11, 'COVID-19 pediátrica', 'Vacuna frente a SARS-CoV-2 en población infantil, en casos recomendados', 'COVID');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario_vacunas`
--
ALTER TABLE `calendario_vacunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacuna_id` (`vacuna_id`),
  ADD KEY `comunidad_id` (`comunidad_id`);

--
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `hijos`
--
ALTER TABLE `hijos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `recordatorios_enviados`
--
ALTER TABLE `recordatorios_enviados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hijo_id` (`hijo_id`,`vacuna_nombre`,`edad_meses`,`dias_antes`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_comunidad` (`comunidad_id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario_vacunas`
--
ALTER TABLE `calendario_vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `hijos`
--
ALTER TABLE `hijos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `recordatorios_enviados`
--
ALTER TABLE `recordatorios_enviados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario_vacunas`
--
ALTER TABLE `calendario_vacunas`
  ADD CONSTRAINT `calendario_vacunas_ibfk_1` FOREIGN KEY (`vacuna_id`) REFERENCES `vacunas` (`id`),
  ADD CONSTRAINT `calendario_vacunas_ibfk_2` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`);

--
-- Filtros para la tabla `hijos`
--
ALTER TABLE `hijos`
  ADD CONSTRAINT `hijos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recordatorios_enviados`
--
ALTER TABLE `recordatorios_enviados`
  ADD CONSTRAINT `recordatorios_enviados_ibfk_1` FOREIGN KEY (`hijo_id`) REFERENCES `hijos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_comunidad` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
