-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2022 a las 16:36:11
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sigcom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id_banco` int(3) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id_banco`, `nombre`) VALUES
(1, 'Nuevo Banco de La Rioja S.A.'),
(2, 'Banco de la Nacion Argentina'),
(3, 'Banco Hipotecario S. A.'),
(4, 'Banco de Galicia y Buenos Aires S. A.'),
(5, 'Banco BBVA Frances S. A.'),
(6, 'Banco Patagonia S. A.'),
(7, 'Banco Santander'),
(8, 'ABN AMRO Bank N. V.'),
(9, 'American Express Bank LTD. S. A.'),
(10, 'BACS Banco de Credito y Securitizacion S. A.'),
(11, 'Banco B.I. Creditanstalt S. A.'),
(12, 'Banco Bradesco Argentina S. A.'),
(13, 'Banco Cetelem Argentina S. A.'),
(14, 'Banco CMF S. A.'),
(15, 'Banco COFIDIS S. A.'),
(16, 'Banco Columbia S. A.'),
(17, 'Banco COMAFI S. A.'),
(18, 'Banco Credicoop C. L.'),
(19, 'Banco de Corrientes S. A.'),
(20, 'Banco de Formosa S. A.'),
(21, 'Banco de Inversion y Comercio Exterior S. A.'),
(22, 'Banco de la Ciudad de Buenos Aires'),
(23, 'Banco de La Pampa Sociedad de Economia Mixta'),
(24, 'Banco de la Provincia de Buenos Aires'),
(25, 'Banco  Cordoba '),
(26, 'Banco de la Republica Oriental del Uruguay'),
(27, 'Banco de San Juan S. A.'),
(28, 'Banco de Santa Cruz S. A.'),
(29, 'Banco de Santiago del Estero S. A.'),
(30, 'Banco de Servicios Financieros S. A.'),
(31, 'Banco de Servicios y Transacciones S. A.'),
(32, 'Banco de Valores S. A.'),
(33, 'Banco del Chubut S. A.'),
(34, 'Banco del Sol S. A.'),
(35, 'Banco del Tucuman S. A.'),
(36, 'Banco Do Brasil S. A.'),
(37, 'Banco Do Estado de Sao Paulo S. A.'),
(38, 'Banco Empresario de Tucuman C. L.'),
(39, 'Banco Europeo para America Latina (B.E.A.L.) S. A.'),
(40, 'Banco Exterior de America S. A.'),
(41, 'Banco Finansur S. A.'),
(42, 'Banco General de Negocios S. A.'),
(43, 'Banco Itau del Buen Ayre S. A.'),
(44, 'Banco Julio S. A.'),
(45, 'Banco Macro S. A.'),
(46, 'Banco Mariva S. A.'),
(47, 'Banco Mercurio S. A.'),
(48, 'Banco Municipal de La Plata'),
(49, 'Banco Municipal de Rosario'),
(50, 'Banco Piano S. A.'),
(51, 'Banco Privado de Inversiones S. A.'),
(52, 'Banco Provincia de Tierra del Fuego'),
(53, 'Banco Regional de Cuyo S. A.'),
(54, 'Banco Rio de la Plata S. A.'),
(55, 'Banco Roela S. A.'),
(56, 'Banco Saenz S. A.'),
(57, 'Banco San Luis S. A.'),
(58, 'Banco San Miguel de Tucuman S. A.'),
(59, 'Banco Societe Generale S. A.'),
(60, 'Banco Sudameris Argentina S. A.'),
(61, 'Banco Suquia S. A.'),
(62, 'Banco Urquijo S. A.'),
(63, 'Banco Velox S. A.'),
(64, 'Bank of America National Association'),
(65, 'BankBoston National Association'),
(66, 'BNP Paribas'),
(67, 'Caja de Credito \"Cuenca\" C. L.'),
(68, 'Caja de Credito \"Floresta Luro Velez\" C. L.'),
(69, 'Caja de Credito \"La Capital del Plata\" C. L.'),
(70, 'Citibank N. A.'),
(71, 'COFIBAL Compañia Financiera S. A.'),
(72, 'Columbia Compañia Financiera S. A.'),
(73, 'Compañia Financiera Argentina S. A.'),
(74, 'Credilogros Compañia Financiera S. A.'),
(75, 'DaimlerChrysler Compañia Financiera S. A.'),
(76, 'HSBC'),
(77, 'Bisel Grupo Macro'),
(78, 'Standard Bank Argentina S.A.'),
(80, 'Banco Supervielle S.A'),
(81, 'Nuevo Banco De Santa Fe'),
(82, 'Citibank NY'),
(83, 'JP MORGAN CHASE BANK NA'),
(84, 'CREDIT URUGUAY BANCO'),
(85, 'BANCO INDUSTRIAL SA'),
(86, 'BANCO PROVINCIA DE BUENOS AIRES'),
(87, 'BANK OF AMERICA'),
(88, 'WACHOVIA BANK'),
(89, 'Wells Fargo Bank N.A'),
(90, 'Nuevo Banco De Entre Rios'),
(91, 'Bank United'),
(92, 'Unicredit S.p.A'),
(93, 'Montemar Compañia Financiera S.A.'),
(96, 'ICBC'),
(97, 'Banco Bilbao Vizcaya Argentaria S.A'),
(98, 'Brubank');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id_banco`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id_banco` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
