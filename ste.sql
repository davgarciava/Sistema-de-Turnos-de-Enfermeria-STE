-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2018 a las 00:15:39
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ste`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `tipo`, `nombre`, `apellido`, `mensaje`, `fecha`) VALUES
(4, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-19 21:47:21'),
(5, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:14:57'),
(6, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:14:59'),
(7, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:15:00'),
(8, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:15:02'),
(9, 'Administrador', 'David', 'Garcí­a', '', '2018-09-26 22:15:04'),
(10, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:15:06'),
(11, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:15:08'),
(12, 'Administrador', 'David', 'Garcí­a', 'Este es el chat de STE. Sirve para que los diferentes trabajadores del hospital puedan estar en contacto e incluso solicitar ayuda. También sirve para dejar anuncios por parte de los administradores.', '2018-09-26 22:15:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(9) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `nombre`, `apellido`, `comentario`) VALUES
(9, 'David', 'Garcí­a', 'Muy buena la página: El responsive está correcto y bien aplicado; el script del calendario es actual y funciona perfectamente; el diseño es estable y está de acuerdo para ser una web para la salud; el chat es de gran utilidad para las comunicaciones. \r\n\r\n'),
(12, 'David', 'Garcí­a', 'Muy buena la página: El responsive está correcto y bien aplicado; el script del calendario es actual y funciona perfectamente; el diseño es estable y está de acuerdo para ser una web para la salud; el chat es de gran utilidad para las comunicaciones. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(24, 'David Garcí­a', '#008000', '2018-07-09 13:45:00', '2018-07-09 18:00:00'),
(28, 'Laura Castaño', '#FFD700', '2018-07-13 13:45:00', '2018-07-13 18:00:00'),
(29, 'David Garcí­a', '#0071c5', '2018-07-05 06:00:00', '2018-07-06 06:00:00'),
(30, 'David Garcí­a', '#FFD700', '2018-10-05 00:00:00', '2018-10-06 00:00:00'),
(31, 'David Garcí­a', '#FFD700', '2018-10-06 00:00:00', '2018-10-07 00:00:00'),
(32, 'Manuel Gallego', '#008000', '2018-10-05 00:00:00', '2018-10-06 00:00:00'),
(33, 'Manuel Gallego', '#008000', '2018-10-06 00:00:00', '2018-10-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `idHospital` int(4) NOT NULL,
  `Torre` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Piso` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(255) NOT NULL,
  `Tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Cedula` int(255) NOT NULL,
  `Correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Telefono` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Tipo`, `Nombres`, `Apellidos`, `Cedula`, `Correo`, `Telefono`, `Contrasena`) VALUES
(1, 'Administrador', 'David', 'Garcí­a', 123, 'davidmgarciav@gmail.com', '3046287235', '$2y$10$cqXJsVWmlAP0dfphKTl3D.yTvhes2ty9RSbVUD98s0p1.ZDkH2wue'),
(50, 'Administrador', 'Isaac', 'García', 321, 'isaac.danilo7890@gmail.com', '3212854609', '$2y$10$ASq6pZnmuBrn1/5GRNiRx.k2DvrMvwv0rkt9Ge.kIYlxHSxUKVlGC'),
(51, 'Administrador', 'Laura', 'Castaño', 987654321, 'iaucasta@gmail.com', '3026348445', '$2y$10$3Tq6yiBfKTDda29hj63T8uCUtq.zPrjh3fcyA4JnUEztINthgllAq'),
(52, 'Administrador', 'Juan Pablo', 'Giraldo', 123456789, 'polloelrepollo@gmail.com', '2936480373', '$2y$10$WxnAdgYPWXnDmsPlnQ0Je.g03Pt7BUBgWTGYRr8dTI0H2G.D2Q2mq'),
(54, 'Usuario', 'Juan Pablo', 'Urrego', 918273645, 'narizgrandejiji@yahoo.com', '5712585', '$2y$10$FGHOao8q0lktKJ16X7/Al..CNF0DyWQiNoMD2ZJ96xbUxkKM6w0Ai'),
(55, 'Usuario', 'Pablo', 'Moreno', 192837465, 'chicoicfeselmejor@outlook.com', '3053837835', '$2y$10$WcAvs7xUr8tqrLPsLXtY.uQLMPTlb.8que3mon4I6J5KT0ahCXCUG'),
(56, 'Usuario', 'Anny', 'Gómez', 283746519, 'carolinadeonce@gmail.com', '6468237', '$2y$10$eXyriFgY.bisfR6JzDtRA.PWjkrRCIXmlXj7TmdrUlCmjXu2Y3G92'),
(57, 'Usuario', 'Tomás', 'Vallejo', 827364519, 'tomaskrasnova@facebook.com', '1112223330', '$2y$10$JNuqEzlzpurjeVuh1Qf.ZeAoBHQKnkvmkB7uDYPxOd1iM7o6yfKLS'),
(58, 'Usuario', 'Estefanía', 'Arango', 736453819, 'estornudosjaja@yahoo.com', '4928350486', '$2y$10$lbhmWnfTovn97MP1W7Xx/O/Hp1GJINB66lvlzcO.NWbFeGa4ZtUWu'),
(59, 'Usuario', 'Valentina', 'Cañas', 374652819, 'cacanasnas@hotmail.com', '7028254', '$2y$10$1IxK3CxMHvP1yRXdmswlDOtfqP5gHgvHuHIR15XLoOjz3YHjcdEVy'),
(60, 'Usuario', 'Angie', 'Nossa', 465372819, 'nosabeahorrar@gmail.com', '1011000101', '$2y$10$PzxKIuT1GIxOJ2reZWb0V./CQjrJ4JtkdrCqp3u78kY2cD06z84Ua'),
(61, 'Usuario', 'Julieta', 'Garzón', 645372819, 'laamericana@hotmail.com', '102385287', '$2y$10$q5dmYyDwV3mN9fyj1FIGxO7hcKCgUBMhMuG24eB0syrLWgln0IISq'),
(62, 'Usuario', 'Valentina', 'González', 546372819, 'coreanitoslike@yahoo.com', '605938271', '$2y$10$aZRJfXfYZciMDozngwfGP.3fU5qUZeuHB5Vj9cOZ6Ct5g4vBDg2jK'),
(63, 'Usuario', 'Anderson', 'Martínez', 467382915, 'mecreoelfuertexd@ethernet.com', '2058376', '$2y$10$17TjCv38qMynmJGog/uQvONKigsvJxC2hivOL/fVMeBJZkq7/Z1I.'),
(64, 'Usuario', 'Manuel', 'Gallego', 46378291, 'bootstrapelmejor@gmail.com', '574839201', '$2y$10$Ll.jzjseQVFmyZt3wK3EOOW5.ZZIt67yu.aU9gfENpffLZPOzgnkW'),
(65, 'Usuario', 'Santiago', 'Castañeda', 38279102, 'solouribe@outlook.com', '48292637', '$2y$10$aRFO.Ua/G4i6WtdfLanEB.gjXxIxPMSQOrEX8ULM582YKGbJ3Kqn2'),
(66, 'Usuario', 'Joseph', 'Cardona', 19582562, 'mello1@gmail.com', '28726837', '$2y$10$L9TCx1Dc67T4P/unCDhmTuCdDca9Z66O8n5OJbeN3q9CCxfS/B7Ti'),
(67, 'Usuario', 'Miguel', 'Cardona', 239972626, 'mello2@gmail.com', '239678718', '$2y$10$Cezq0/jLxWDLGyxySHpcVe9IkE/0wqhDRiEh0gdXhrpOFlmUOdn6m'),
(68, 'Usuario', 'Carlos', 'Castro', 1234567890, 'cacastro@misena.edu.co', '0987654321', '$2y$10$KXjI08e8ymlbl14niffeEuVzZNnaSKL.eu4np35Gv0cAadMlmBXnq'),
(69, 'Usuario', 'Alvaro', 'Sánchez', 2147483647, 'alvaritoalgoritmia@hotmail.com', '1234567890', '$2y$10$/kkb9HORcJYxwKrGSAH4dOv6/BWZHuch/MI.7cmn5AXTIwVFag6Pa'),
(70, 'Usuario', 'John William', 'Marín Pineda', 100100100, 'wordpress@miweb.com', '110011001100', '$2y$10$zwE0xf5Waj7k/3t69j24nufORUG2JD0GtVlJimE2V/Ds1ubHKXjN6'),
(71, 'Usuario', 'Juan Felipe', 'Cárdenas', 9286723, 'skeleto@yahoo.com', '28753823', '$2y$10$VoUdYJBdMXLcy8ItudXXCOMjxJuB9c7L4CjFObtAPCxUwOsB0oAJa'),
(72, 'Usuario', 'Sebastían', 'Hernández', 89236525, 'meestresatodo@gmail.com', '92376262', '$2y$10$oGZ2PLX3W/2A36mYlGHfVedfBUwT9IEFQVIYVCKKv8rYYbhPPAieS'),
(73, 'Usuario', 'Santiago', 'García', 927387237, 'verdolagas@chibchombia.com', '51874175', '$2y$10$R7vXTP2c9vmWHxUO7o506e6GqBJB8R7/8ZfMum1VVqqjCeZhHo/w6'),
(74, 'Usuario', 'Kevin', 'Piedrahita', 18285626, 'segoviateamo@outlook.com', '6982672', '$2y$10$TiyY4sTEes0TWKjfc9elUuxWY89.jLGA/zG1IWRaOa9S/zlOwS6lu'),
(75, 'Usuario', 'Ana', 'Castaño', 8923626, 'pocahontasmellamo@gmail.com', '90723671', '$2y$10$u88gwKAMvwtBTLWcY0zt2eaYKlcNORmHKMRD2aG.K28KNcE7EO/xC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`idHospital`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `Cedula_UNIQUE` (`Cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
