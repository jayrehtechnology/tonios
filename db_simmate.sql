-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 06:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `my_key` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` int(1) NOT NULL,
  `is_private_key` int(1) NOT NULL,
  `ip_addresses` text NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `my_key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '@Programmer2013', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `simmate_customer`
--

CREATE TABLE `simmate_customer` (
  `id` int(12) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `province` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `username` varchar(36) NOT NULL,
  `password` varchar(100) NOT NULL,
  `emailCode` varchar(12) NOT NULL,
  `discount` double NOT NULL,
  `is_active` int(1) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simmate_customer`
--

INSERT INTO `simmate_customer` (`id`, `firstname`, `lastname`, `email`, `mobile`, `address`, `province`, `region`, `city`, `barangay`, `username`, `password`, `emailCode`, `discount`, `is_active`, `account_number`, `date_registered`) VALUES
(1, 'Kevin1', 'Roluna', 'kevinjayroluna@gmail.com', '9357396286', 'Blk 20 Lot 23, Pasong Kawayan , General Trias Cavite', '', '', '', '', 'demo123', '$2y$10$jd/E5HVRcbSBCaLrkNnaxexgr2FBvDH5q3ogsqXL.puzTtqh4Nm2u', '897952', 0, 1, 'demo123', '2024-11-04 04:39:40'),
(2, 'Sample', 'Sample', 'john_smith@sample.com', '0935739628', 'Blk 20 Lot 23, Pasong Kawayan , General Trias Cavite', '', '', '', '', 'demo12345', '$2y$10$BQ7tnIglTM7Rudh93AZZzu5xQlbn7K.uEBvZOWoqCSUCYlQrbPDkq', '452442', 0, 1, '', '2024-11-04 04:41:00'),
(3, 'multiStepsForm', 'multiStepsForm', 'school_admin@sample.com', 'multiSteps', 'multiStepsForm', '', '', '', '', 'multiStepsForm', '$2y$10$iCSqA.ZluBAQWseT60ksoO2q2Qpgu4X9zo1zPiL61Qj66AZI2JKPC', '794711', 0, 0, '', '2024-11-12 13:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `simmate_providers`
--

CREATE TABLE `simmate_providers` (
  `id` int(12) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `provider_details` text NOT NULL,
  `provider_count` int(12) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simmate_providers`
--

INSERT INTO `simmate_providers` (`id`, `provider_name`, `provider_details`, `provider_count`, `date_added`) VALUES
(1, 'Esim Go', 'Esim Go', 0, '2024-11-14 11:36:41'),
(2, 'Mobimatter', 'Mobimatter', 0, '2024-11-15 17:05:20'),
(3, 'Sparks', 'Sparks API', 0, '2024-11-20 00:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `simmate_purchased`
--

CREATE TABLE `simmate_purchased` (
  `id` int(12) NOT NULL,
  `customer_id` int(12) NOT NULL,
  `provider_id` int(12) NOT NULL,
  `details` text NOT NULL,
  `amount` varchar(32) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simmate_spark_country`
--

CREATE TABLE `simmate_spark_country` (
  `id` int(12) NOT NULL,
  `location_id` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `tadig` varchar(100) NOT NULL,
  `location_zone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simmate_spark_country`
--

INSERT INTO `simmate_spark_country` (`id`, `location_id`, `country`, `operator`, `tadig`, `location_zone`) VALUES
(1, '41993', 'Afghanistan', 'Roshan Afghanistan', 'AFGTD', 'AFGHANISTAN_LZ_SP05_20241028155215'),
(2, '40649', 'Albania', 'Vodafone Albania', 'ALBVF', 'EU_USA_LZ_SP05_20241019160745'),
(3, '41996', 'Albania', 'Vodafone Albania', 'ALBVF', 'ALBANIA_LZ_SP05_20241028155216'),
(4, '43943', 'Albania', 'Vodafone Albania', 'ALBVF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(5, '41999', 'Algeria', 'Orascom Algeria', 'DZAOT', 'ALGERIA_LZ_SP05_20241028155217'),
(6, '43943', 'Algeria', 'Orascom Algeria', 'DZAOT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(7, '42002', 'Andorra', 'Andorra Telecom', 'ANDMA', 'ANDORRA_LZ_SP05_20241028155218'),
(8, '43943', 'Andorra', 'Andorra Telecom', 'ANDMA', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(9, '42005', 'Argentina', 'Personal Argentina', 'ARGTP', 'ARGENTINA_LZ_SP05_20241028155218'),
(10, '42008', 'Armenia', 'Vivacell Armenia', 'ARM05', 'ARMENIA_LZ_SP05_20241028155219'),
(11, '43943', 'Armenia', 'Vivacell Armenia', 'ARM05', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(12, '42011', 'Australia', 'Vodafone Australia', 'AUSVF', 'AUSTRALIA_LZ_SP05_20241028155220'),
(13, '43943', 'Australia', 'Vodafone Australia', 'AUSVF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(14, '40649', 'Austria', 'A1 Austria ', 'AUTPT', 'EU_USA_LZ_SP05_20241019160745'),
(15, '40649', 'Austria', 'T-Mobile Austria', 'AUTMM', 'EU_USA_LZ_SP05_20241019160745'),
(16, '42014', 'Austria', 'A1 Austria ', 'AUTPT', 'AUSTRIA_LZ_SP05_20241028155221'),
(17, '42014', 'Austria', 'T-Mobile Austria', 'AUTMM', 'AUSTRIA_LZ_SP05_20241028155221'),
(18, '43943', 'Austria', 'A1 Austria ', 'AUTPT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(19, '43943', 'Austria', 'T-Mobile Austria', 'AUTMM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(20, '43943', 'Austria', 'H3G Austria', 'AUTHU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(21, '42017', 'Azerbaijan', 'Bakcell Azerbaijan', 'AZEBC', 'AZERBAIJAN_LZ_SP05_20241028155222'),
(22, '43943', 'Azerbaijan', 'Azercell Azerbaijan', 'AZEAC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(23, '43943', 'Azerbaijan', 'Bakcell Azerbaijan', 'AZEBC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(24, '42020', 'Bahrain', 'Zain Bahrain B S C', 'BHRMV', 'BAHRAIN_LZ_SP05_20241028155222'),
(25, '43943', 'Bahrain', 'Zain Bahrain B S C', 'BHRMV', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(26, '42023', 'Bangladesh', 'Grameenphone Bangladesh', 'BGDGP', 'BANGLADESH_LZ_SP05_20241028155223'),
(27, '43943', 'Bangladesh', 'Grameenphone Bangladesh', 'BGDGP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(28, '42026', 'Belarus', 'Unitary velcom Belarus', 'BLRMD', 'BELARUS_LZ_SP05_20241028155224'),
(29, '43943', 'Belarus', 'Unitary velcom Belarus', 'BLRMD', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(30, '40649', 'Belgium', 'Telenet Belgium', 'BELKO', 'EU_USA_LZ_SP05_20241019160745'),
(31, '40649', 'Belgium', 'ORANGE Belgium', 'BELMO', 'EU_USA_LZ_SP05_20241019160745'),
(32, '42029', 'Belgium', 'Telenet Belgium', 'BELKO', 'BELGIUM_LZ_SP05_20241028155225'),
(33, '42029', 'Belgium', 'ORANGE Belgium', 'BELMO', 'BELGIUM_LZ_SP05_20241028155225'),
(34, '43943', 'Belgium', 'Telenet Belgium', 'BELKO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(35, '43943', 'Belgium', 'Proximus Belgium', 'BELTB', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(36, '43943', 'Belgium', 'ORANGE Belgium', 'BELMO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(37, '43880', 'Benin', 'Celtiis', 'BEN07', 'BENIN_LZ_SP05_SP05_20241107101314'),
(38, '42032', 'Bosnia and Herzegovina', 'BH Telecom Bosnia & Herzegov', 'BIHPT', 'BOSNIAHERZEGOV_LZ_SP05_20241028155226'),
(39, '43943', 'Bosnia and Herzegovina', 'BH Telecom Bosnia & Herzegov', 'BIHPT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(40, '40646', 'Brazil', 'TIM Brazil', 'BRASP', 'BRAZIL_LZ_SP05_20241019160744'),
(41, '40646', 'Brazil', 'TIM-RN Brazil', 'BRARN', 'BRAZIL_LZ_SP05_20241019160744'),
(42, '40646', 'Brazil', 'TIM-CS Brazil', 'BRACS', 'BRAZIL_LZ_SP05_20241019160744'),
(43, '43943', 'Brazil', 'TIM Brazil', 'BRASP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(44, '43943', 'Brazil', 'TIM-RN Brazil', 'BRARN', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(45, '43943', 'Brazil', 'TIM-CS Brazil', 'BRACS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(46, '40649', 'Bulgaria', 'Vivacom Bulgarian', 'BGRVA', 'EU_USA_LZ_SP05_20241019160745'),
(47, '40649', 'Bulgaria', 'Telenor Bulgaria', 'BGRCM', 'EU_USA_LZ_SP05_20241019160745'),
(48, '42035', 'Bulgaria', 'Vivacom Bulgarian', 'BGRVA', 'BULGARIA_LZ_SP05_20241028155227'),
(49, '42035', 'Bulgaria', 'Telenor Bulgaria', 'BGRCM', 'BULGARIA_LZ_SP05_20241028155227'),
(50, '43943', 'Bulgaria', 'Vivacom Bulgarian', 'BGRVA', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(51, '43943', 'Bulgaria', 'Telenor Bulgaria', 'BGRCM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(52, '43883', 'Cambodia', 'Viettel/Metphone Cambodia', 'KHMVT', 'CAMBODIA_LZ_SP05_SP05_20241107101315'),
(53, '43943', 'Cambodia', 'Viettel/Metphone Cambodia', 'KHMVT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(54, '43886', 'Canada', 'WIND Mobile Corp ', 'CANGW', 'CANADA_LZ_SP05_SP05_20241107101315'),
(55, '43943', 'Canada', 'WIND Mobile Corp ', 'CANGW', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(56, '42038', 'Chad', 'Zain/Airtel/Celtel Chad', 'TCDCT', 'CHAD_LZ_SP05_20241028155227'),
(57, '43943', 'China', 'China Unicom', 'CHNCU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(58, '42041', 'Colombia', 'TIGO/Colombia Movil', 'COLCO', 'COLOMBIA_LZ_SP05_20241028155228'),
(59, '40649', 'Croatia', 'Tele2 Croatia', 'HRVT2', 'EU_USA_LZ_SP05_20241019160745'),
(60, '42044', 'Croatia', 'Hrvatski Croatia', 'HRVCN', 'CROATIA_LZ_SP05_20241028155229'),
(61, '42044', 'Croatia', 'Tele2 Croatia', 'HRVT2', 'CROATIA_LZ_SP05_20241028155229'),
(62, '43943', 'Croatia', 'Hrvatski Croatia', 'HRVCN', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(63, '43943', 'Croatia', 'Tele2 Croatia', 'HRVT2', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(64, '40649', 'Cyprus', 'Epic Cyprus', 'CYPSC', 'EU_USA_LZ_SP05_20241019160745'),
(65, '42047', 'Cyprus', 'Epic Cyprus', 'CYPSC', 'CYPRUS_LZ_SP05_20241028155230'),
(66, '43943', 'Cyprus', 'Epic Cyprus', 'CYPSC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(67, '43943', 'Cyprus', 'Primetel Cyprus ', 'CYPPT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(68, '40649', 'Czech Republic', 'T-Mobile Czech Republic', 'CZERM', 'EU_USA_LZ_SP05_20241019160745'),
(69, '42050', 'Czech Republic', 'T-Mobile Czech Republic', 'CZERM', 'CZECH_REPUBLIC_LZ_SP05_20241028155231'),
(70, '43943', 'Czech Republic', 'O2 Czech Republic', 'CZEET', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(71, '43943', 'Czech Republic', 'T-Mobile Czech Republic', 'CZERM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(72, '43943', 'Czech Republic', 'Vodafone Czech Republic', 'CZECM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(73, '40649', 'Denmark', 'TDC/nuuday Denmark', 'DNKTD', 'EU_USA_LZ_SP05_20241019160745'),
(74, '42053', 'Denmark', 'TDC/nuuday Denmark', 'DNKTD', 'DENMARK_LZ_SP05_20241028155231'),
(75, '43943', 'Denmark', 'TDC/nuuday Denmark', 'DNKTD', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(76, '43943', 'Denmark', 'Telenor Denmark', 'DNKDM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(77, '40652', 'Egypt', 'Orange Egypt (EMS)', 'EGYAR', 'MEA_LZ_SP05_20241019160753'),
(78, '40652', 'Egypt', 'Etisalat Egypt', 'EGYEM', 'MEA_LZ_SP05_20241019160753'),
(79, '42056', 'Egypt', 'Orange Egypt (EMS)', 'EGYAR', 'EGYPT_LZ_SP05_20241028155232'),
(80, '42056', 'Egypt', 'Etisalat Egypt', 'EGYEM', 'EGYPT_LZ_SP05_20241028155232'),
(81, '43943', 'Egypt', 'Orange Egypt (EMS)', 'EGYAR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(82, '43943', 'Egypt', 'Etisalat Egypt', 'EGYEM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(83, '40649', 'Estonia', 'Elisa Estonia', 'ESTRE', 'EU_USA_LZ_SP05_20241019160745'),
(84, '42059', 'Estonia', 'Elisa Estonia', 'ESTRE', 'ESTONIA_LZ_SP05_20241028155233'),
(85, '43943', 'Estonia', 'Telia Estonia', 'ESTEM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(86, '43943', 'Estonia', 'Elisa Estonia', 'ESTRE', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(87, '43943', 'Estonia', 'Tele2 Estonia', 'ESTRB', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(88, '42062', 'Faroe Islands', 'Vodafone Faroe Islands', 'FROKA', 'FAROE_ISLANDS_LZ_SP05_20241028155234'),
(89, '43943', 'Faroe Islands', 'Vodafone Faroe Islands', 'FROKA', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(90, '40649', 'Finland', ' lands Telekommunikation Ab', 'FINAM', 'EU_USA_LZ_SP05_20241019160745'),
(91, '40649', 'Finland', 'Elisa Finland', 'FINRL', 'EU_USA_LZ_SP05_20241019160745'),
(92, '42065', 'Finland', ' lands Telekommunikation Ab', 'FINAM', 'FINLAND_LZ_SP05_20241028155235'),
(93, '42065', 'Finland', 'Elisa Finland', 'FINRL', 'FINLAND_LZ_SP05_20241028155235'),
(94, '43943', 'Finland', ' lands Telekommunikation Ab', 'FINAM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(95, '43943', 'Finland', 'DNA Finland', 'FIN2G', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(96, '43943', 'Finland', 'Elisa Finland', 'FINRL', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(97, '40649', 'France', 'Bouygues France', 'FRAF3', 'EU_USA_LZ_SP05_20241019160745'),
(98, '40649', 'France', 'Orange France', 'FRAF1', 'EU_USA_LZ_SP05_20241019160745'),
(99, '42068', 'France', 'Bouygues France', 'FRAF3', 'FRANCE_LZ_SP05_20241028155236'),
(100, '42068', 'France', 'Orange France', 'FRAF1', 'FRANCE_LZ_SP05_20241028155236'),
(101, '43943', 'France', 'Bouygues France', 'FRAF3', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(102, '43943', 'France', 'Orange France', 'FRAF1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(103, '43943', 'French Guiana', 'Bouygues/DigiCel French Guiana', 'FRAF4', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(104, '42071', 'Gabon', 'ZAIN/Celtel Gabon', 'GABCT', 'GABON_LZ_SP05_20241028155237'),
(105, '42074', 'Georgia', 'Mobitel Georgia', 'GEOMT', 'GEORGIA_LZ_SP05_20241028155237'),
(106, '43943', 'Georgia', 'Geocell Georgia', 'GEOGC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(107, '43943', 'Georgia', 'Mobitel Georgia', 'GEOMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(108, '40649', 'Germany', 'O2 Germany', 'DEUE2', 'EU_USA_LZ_SP05_20241019160745'),
(109, '40649', 'Germany', 'T-Mobile Germany', 'DEUD1', 'EU_USA_LZ_SP05_20241019160745'),
(110, '42077', 'Germany', 'T-Mobile Germany', 'DEUD1', 'GERMANY_LZ_SP05_20241028155238'),
(111, '43943', 'Germany', 'O2 Germany', 'DEUE2', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(112, '43943', 'Germany', 'T-Mobile Germany', 'DEUD1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(113, '43943', 'Germany', 'Vodafone Germany', 'DEUD2', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(114, '42080', 'Gibraltar', 'Gibtelecom Gibraltar', 'GIBGT', 'GIBRALTAR_LZ_SP05_20241028155239'),
(115, '43943', 'Gibraltar', 'Gibtelecom Gibraltar', 'GIBGT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(116, '40649', 'Greece', 'Cosmote Greece', 'GRCCO', 'EU_USA_LZ_SP05_20241019160745'),
(117, '40649', 'Greece', 'Wind Greece (Nova)', 'GRCQT', 'EU_USA_LZ_SP05_20241019160745'),
(118, '42083', 'Greece', 'Cosmote Greece', 'GRCCO', 'GREECE_LZ_SP05_20241028155240'),
(119, '42083', 'Greece', 'Wind Greece (Nova)', 'GRCQT', 'GREECE_LZ_SP05_20241028155240'),
(120, '43943', 'Greece', 'Cosmote Greece', 'GRCCO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(121, '43943', 'Greece', 'Wind Greece (Nova)', 'GRCQT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(122, '43943', 'Greece', 'Vodafone Greece', 'GRCPF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(123, '40655', 'Hong Kong', 'H3G Hong Kong', 'HKGHT', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(124, '42086', 'Hong Kong', 'H3G Hong Kong', 'HKGHT', 'HONG_KONG_LZ_SP05_20241028155240'),
(125, '43889', 'Hong Kong', 'H3G Hong Kong', 'HKGHT', 'HONGKONG_LZ_SP05_SP05_20241107101316'),
(126, '43943', 'Hong Kong', 'H3G Hong Kong', 'HKGHT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(127, '43943', 'Hong Kong', 'SmarTone Hong Kong', 'HKGSM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(128, '40649', 'Hungary', 'Telenor Hungary', 'HUNH1', 'EU_USA_LZ_SP05_20241019160745'),
(129, '40649', 'Hungary', 'T-Mobile Hungary', 'HUNH2', 'EU_USA_LZ_SP05_20241019160745'),
(130, '42089', 'Hungary', 'T-Mobile Hungary', 'HUNH2', 'HUNGARY_LZ_SP05_20241028155241'),
(131, '43943', 'Hungary', 'Telenor Hungary', 'HUNH1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(132, '43943', 'Hungary', 'T-Mobile Hungary', 'HUNH2', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(133, '43943', 'Hungary', 'Vodafone Hungary', 'HUNVR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(134, '40649', 'Iceland', 'Fjarskipti (VF) Iceland', 'ISLTL', 'EU_USA_LZ_SP05_20241019160745'),
(135, '42092', 'Iceland', 'Fjarskipti (VF) Iceland', 'ISLTL', 'ICELAND_LZ_SP05_20241028155242'),
(136, '43943', 'Iceland', 'Landssiminn - ISLPS', 'ISLPS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(137, '43943', 'Iceland', 'Nova Iceland ', 'ISLNO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(138, '43943', 'Iceland', 'Fjarskipti (VF) Iceland', 'ISLTL', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(139, '42095', 'India', 'Idea Cellular-IU India', 'INDIU', 'INDIA_LZ_SP05_20241028155243'),
(140, '42095', 'India', 'Fascel India', 'INDF1', 'INDIA_LZ_SP05_20241028155243'),
(141, '42095', 'India', 'Idea Cellular-IB India', 'INDIB', 'INDIA_LZ_SP05_20241028155243'),
(142, '42095', 'India', 'Idea Cellular-MP India', 'INDMP', 'INDIA_LZ_SP05_20241028155243'),
(143, '42095', 'India', 'Idea Cellular-SP India', 'INDSP', 'INDIA_LZ_SP05_20241028155243'),
(144, '42095', 'India', 'Vodafone India', 'INDE1', 'INDIA_LZ_SP05_20241028155243'),
(145, '42095', 'India', 'Vodafone India', 'INDCC', 'INDIA_LZ_SP05_20241028155243'),
(146, '42095', 'India', 'Vodafone India Essar', 'INDBK', 'INDIA_LZ_SP05_20241028155243'),
(147, '42095', 'India', 'Vodafone India Limited', 'INDBM', 'INDIA_LZ_SP05_20241028155243'),
(148, '42095', 'India', 'Vodafone India Essar BT', 'INDBT', 'INDIA_LZ_SP05_20241028155243'),
(149, '42095', 'India', 'Vodafone India (Mumbai)', 'INDHM', 'INDIA_LZ_SP05_20241028155243'),
(150, '42095', 'India', 'Idea Cellular-07 India', 'IND07', 'INDIA_LZ_SP05_20241028155243'),
(151, '42095', 'India', 'Idea Cellular-ID India', 'INDID', 'INDIA_LZ_SP05_20241028155243'),
(152, '42095', 'India', 'Idea Cellular-EK India', 'INDEK', 'INDIA_LZ_SP05_20241028155243'),
(153, '42095', 'India', 'Idea Cellular-BI India', 'INDBI', 'INDIA_LZ_SP05_20241028155243'),
(154, '42095', 'India', 'Idea Cellular-EH India', 'INDEH', 'INDIA_LZ_SP05_20241028155243'),
(155, '42095', 'India', 'Idea Cellular-IH India', 'INDIH', 'INDIA_LZ_SP05_20241028155243'),
(156, '42095', 'India', 'Idea Cellular-IM India', 'INDIM', 'INDIA_LZ_SP05_20241028155243'),
(157, '42095', 'India', 'Idea Cellular-IR India', 'INDIR', 'INDIA_LZ_SP05_20241028155243'),
(158, '42095', 'India', 'Idea Cellular-BO India', 'INDBO', 'INDIA_LZ_SP05_20241028155243'),
(159, '42095', 'India', 'Idea Cellular-EU India', 'INDEU', 'INDIA_LZ_SP05_20241028155243'),
(160, '42095', 'India', 'Idea Cellular-IT India', 'INDIT', 'INDIA_LZ_SP05_20241028155243'),
(161, '42095', 'India', 'Idea Cellular-IO India', 'INDIO', 'INDIA_LZ_SP05_20241028155243'),
(162, '42095', 'India', 'Idea Cellular-SK India', 'INDSK', 'INDIA_LZ_SP05_20241028155243'),
(163, '42095', 'India', 'Idea Cellular-IK India', 'INDIK', 'INDIA_LZ_SP05_20241028155243'),
(164, '42095', 'India', 'Idea Cellular-IW India', 'INDIW', 'INDIA_LZ_SP05_20241028155243'),
(165, '42095', 'India', 'Idea Cellular-AM India', 'INDAM', 'INDIA_LZ_SP05_20241028155243'),
(166, '42095', 'India', 'Idea Cellular-IE India', 'INDIE', 'INDIA_LZ_SP05_20241028155243'),
(167, '42095', 'India', 'Idea Cellular-IJ India', 'INDIJ', 'INDIA_LZ_SP05_20241028155243'),
(168, '43943', 'India', 'Idea Cellular-IU India', 'INDIU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(169, '43943', 'India', 'Fascel India', 'INDF1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(170, '43943', 'India', 'Idea Cellular-IB India', 'INDIB', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(171, '43943', 'India', 'Idea Cellular-MP India', 'INDMP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(172, '43943', 'India', 'Idea Cellular-SP India', 'INDSP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(173, '43943', 'India', 'Vodafone India', 'INDE1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(174, '43943', 'India', 'Vodafone India', 'INDCC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(175, '43943', 'India', 'Vodafone India Essar', 'INDBK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(176, '43943', 'India', 'Vodafone India Limited', 'INDBM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(177, '43943', 'India', 'Vodafone India Essar BT', 'INDBT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(178, '43943', 'India', 'Vodafone India (Mumbai)', 'INDHM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(179, '43943', 'India', 'Idea Cellular-07 India', 'IND07', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(180, '43943', 'India', 'Idea Cellular-ID India', 'INDID', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(181, '43943', 'India', 'Idea Cellular-EK India', 'INDEK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(182, '43943', 'India', 'Idea Cellular-BI India', 'INDBI', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(183, '43943', 'India', 'Idea Cellular-EH India', 'INDEH', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(184, '43943', 'India', 'Idea Cellular-IH India', 'INDIH', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(185, '43943', 'India', 'Idea Cellular-IM India', 'INDIM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(186, '43943', 'India', 'Idea Cellular-IR India', 'INDIR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(187, '43943', 'India', 'Idea Cellular-BO India', 'INDBO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(188, '43943', 'India', 'Idea Cellular-EU India', 'INDEU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(189, '43943', 'India', 'Idea Cellular-IT India', 'INDIT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(190, '43943', 'India', 'Idea Cellular-IO India', 'INDIO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(191, '43943', 'India', 'Idea Cellular-SK India', 'INDSK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(192, '43943', 'India', 'Idea Cellular-IK India', 'INDIK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(193, '43943', 'India', 'Idea Cellular-IW India', 'INDIW', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(194, '43943', 'India', 'Idea Cellular-AM India', 'INDAM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(195, '43943', 'India', 'Idea Cellular-IE India', 'INDIE', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(196, '43943', 'India', 'Idea Cellular-IJ India', 'INDIJ', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(197, '40655', 'Indonesia', 'Telkomsel indonesia', 'IDNTS', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(198, '42098', 'Indonesia', 'Telkomsel indonesia', 'IDNTS', 'INDONESIA_LZ_SP05_20241028155247'),
(199, '43943', 'Indonesia', 'Telkomsel indonesia', 'IDNTS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(200, '40652', 'Iraq', 'Korek Telecom Company', 'IRQKK', 'MEA_LZ_SP05_20241019160753'),
(201, '42101', 'Iraq', 'Korek Telecom Company', 'IRQKK', 'IRAQ_LZ_SP05_20241028155248'),
(202, '40649', 'Ireland', 'Meteor Mobile Ireland', 'IRLME', 'EU_USA_LZ_SP05_20241019160745'),
(203, '40649', 'Ireland', 'H3G Ireland', 'IRLDF', 'EU_USA_LZ_SP05_20241019160745'),
(204, '42104', 'Ireland', 'Meteor Mobile Ireland', 'IRLME', 'IRELAND_LZ_SP05_20241028155249'),
(205, '42104', 'Ireland', 'H3G Ireland', 'IRLDF', 'IRELAND_LZ_SP05_20241028155249'),
(206, '43943', 'Ireland', 'Meteor Mobile Ireland', 'IRLME', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(207, '43943', 'Ireland', 'Vodafone Ireland', 'IRLEC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(208, '43943', 'Ireland', 'H3G Ireland', 'IRLDF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(209, '40652', 'Israel', 'Hot Mobile Israel', 'ISRMS', 'MEA_LZ_SP05_20241019160753'),
(210, '40652', 'Israel', 'Partner Israel', 'ISR01', 'MEA_LZ_SP05_20241019160753'),
(211, '40652', 'Israel', 'Pelephone Israel', 'ISRPL', 'MEA_LZ_SP05_20241019160753'),
(212, '42107', 'Israel', 'Hot Mobile Israel', 'ISRMS', 'ISRAEL_LZ_SP05_20241028155249'),
(213, '42107', 'Israel', 'Pelephone Israel', 'ISRPL', 'ISRAEL_LZ_SP05_20241028155249'),
(214, '43943', 'Israel', 'Hot Mobile Israel', 'ISRMS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(215, '43943', 'Israel', 'Partner Israel', 'ISR01', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(216, '43943', 'Israel', 'Pelephone Israel', 'ISRPL', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(217, '40649', 'Italy', 'Vodafone Italy', 'ITAOM', 'EU_USA_LZ_SP05_20241019160745'),
(218, '40649', 'Italy', 'Wind Italy', 'ITAWI', 'EU_USA_LZ_SP05_20241019160745'),
(219, '42110', 'Italy', 'Vodafone Italy', 'ITAOM', 'ITALY_LZ_SP05_20241028155250'),
(220, '42110', 'Italy', 'Wind Italy', 'ITAWI', 'ITALY_LZ_SP05_20241028155250'),
(221, '43943', 'Italy', 'Telecom Italia', 'ITASI', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(222, '43943', 'Italy', 'Vodafone Italy', 'ITAOM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(223, '43943', 'Italy', 'Wind Italy', 'ITAWI', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(224, '43943', 'Japan', 'NTT Docomo Japan', 'JPNDO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(225, '42113', 'Kazakhstan', 'Kar-Tel (Beeline) Kazakhstan', 'KAZKT', 'KAZAKHSTAN_LZ_SP05_20241028155251'),
(226, '43943', 'Kazakhstan', 'Kar-Tel (Beeline) Kazakhstan', 'KAZKT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(227, '42116', 'Kenya', 'Zain/Celtel Kenya', 'KENKC', 'KENYA_LZ_SP05_20241028155252'),
(228, '42119', 'Kosovo', 'IPKO Kosovo', 'K0001', 'KOSOVO_LZ_SP05_20241028155253'),
(229, '43943', 'Kosovo', 'IPKO Kosovo', 'K0001', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(230, '40652', 'Kuwait', 'Zain Kuwait', 'KWTMT', 'MEA_LZ_SP05_20241019160753'),
(231, '42122', 'Kuwait', 'Zain Kuwait', 'KWTMT', 'KUWAIT_LZ_SP05_20241028155254'),
(232, '43943', 'Kuwait', 'Kuwait Telecom Company K S C ', 'KWTKT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(233, '43943', 'Kuwait', 'Zain Kuwait', 'KWTMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(234, '42125', 'Kyrgyzstan', 'Sky Mobile Kyrgyzstan (Beeline)', 'KGZ01', 'KYRGYZSTAN_LZ_SP05_20241028155254'),
(235, '43943', 'Kyrgyzstan', 'Sky Mobile Kyrgyzstan (Beeline)', 'KGZ01', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(236, '43943', 'Laos', 'ETL Mobile', 'LAOET', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(237, '40649', 'Latvia', 'Bite Latvia', 'LVAK9', 'EU_USA_LZ_SP05_20241019160745'),
(238, '42128', 'Latvia', 'Bite Latvia', 'LVAK9', 'LATVIA_LZ_SP05_20241028155255'),
(239, '43943', 'Latvia', 'Bite Latvia', 'LVAK9', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(240, '43943', 'Latvia', 'Latvijas Mobilais Latvia', 'LVALM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(241, '43943', 'Latvia', 'Tele2 Latvia', 'LVABC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(242, '40649', 'Liechtenstein', 'Telecom Liechtenstein AG', 'LIEMK', 'EU_USA_LZ_SP05_20241019160745'),
(243, '42131', 'Liechtenstein', 'Telecom Liechtenstein AG', 'LIEMK', 'LIECHTENSTEIN_LZ_SP05_20241028155256'),
(244, '43943', 'Liechtenstein', 'Orange Lichtenstein', 'LIEK9', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(245, '43943', 'Liechtenstein', 'Telecom Liechtenstein AG', 'LIEMK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(246, '40649', 'Lithuania', 'Bite Lithuania', 'LTUMT', 'EU_USA_LZ_SP05_20241019160745'),
(247, '42134', 'Lithuania', 'Bite Lithuania', 'LTUMT', 'LITHUANIA_LZ_SP05_20241028155257'),
(248, '43943', 'Lithuania', 'Bite Lithuania', 'LTUMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(249, '43943', 'Lithuania', 'Omnitel Lithuania', 'LTUOM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(250, '43943', 'Lithuania', 'Tele2 Lithuania', 'LTU03', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(251, '40649', 'Luxembourg', 'Orange Luxembourg', 'LUXVM', 'EU_USA_LZ_SP05_20241019160745'),
(252, '42137', 'Luxembourg', 'Orange Luxembourg', 'LUXVM', 'LUXEMBOURG_LZ_SP05_20241028155258'),
(253, '43943', 'Luxembourg', 'Tango Luxembourg', 'LUXTG', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(254, '43943', 'Luxembourg', 'Orange Luxembourg', 'LUXVM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(255, '40655', 'Macao China', 'Hutchison Telephone Macau Company Limited', 'MACHT', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(256, '42140', 'Macao China', 'Hutchison Telephone Macau Company Limited', 'MACHT', 'MACAO_CHINA_LZ_SP05_20241028155258'),
(257, '43943', 'Macao China', 'Hutchison Telephone Macau Company Limited', 'MACHT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(258, '42143', 'Macedonia', 'VIP Mobile Macedonia', 'MKDNO', 'MACEDONIA_LZ_SP05_20241028155259'),
(259, '43943', 'Macedonia', 'VIP Mobile Macedonia', 'MKDNO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(260, '42146', 'Madagascar', 'Airtel Madagascar', 'MDGCO', 'MADAGASCAR_LZ_SP05_20241028155300'),
(261, '42149', 'Malawi', 'Airtel Malawi Limited', 'MWICT', 'MALAWI_SPO5_LZ_SP05_20241028155301'),
(262, '40655', 'Malaysia', 'Celcom Malaysia', 'MYSMR', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(263, '40655', 'Malaysia', 'Digi Malaysia', 'MYSMT', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(264, '43943', 'Malaysia', 'Celcom Malaysia', 'MYSMR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(265, '43943', 'Malaysia', 'Digi Malaysia', 'MYSMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(266, '40649', 'Malta', 'Melita Malta', 'MLTMM', 'EU_USA_LZ_SP05_20241019160745'),
(267, '40649', 'Malta', 'Vodafone Malta', 'MLTTL', 'EU_USA_LZ_SP05_20241019160745'),
(268, '42152', 'Malta', 'Melita Malta', 'MLTMM', 'MALTA_LZ_SP05_20241028155302'),
(269, '42152', 'Malta', 'Vodafone Malta', 'MLTTL', 'MALTA_LZ_SP05_20241028155302'),
(270, '43943', 'Malta', 'Melita Malta', 'MLTMM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(271, '43943', 'Malta', 'Vodafone Malta', 'MLTTL', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(272, '42155', 'Mexico', 'AT&T Mexico', 'MEXIU', 'MEXICO_LZ_SP05_20241028155303'),
(273, '43943', 'Mexico', 'AT&T Mexico', 'MEXIU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(274, '40649', 'Moldova', 'Moldcell Moldova', 'MDAMC', 'EU_USA_LZ_SP05_20241019160745'),
(275, '40649', 'Moldova', 'Orange Moldova', 'MDAVX', 'EU_USA_LZ_SP05_20241019160745'),
(276, '42158', 'Moldova', 'Orange Moldova', 'MDAVX', 'MOLDOVA_LZ_SP05_20241028155303'),
(277, '43943', 'Moldova', 'Moldcell Moldova', 'MDAMC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(278, '43943', 'Moldova', 'Orange Moldova', 'MDAVX', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(279, '42161', 'Montenegro', 'MTEL Montenegro', 'MNEMT', 'MONTENEGRO_LZ_SP05_20241028155304'),
(280, '43943', 'Montenegro', 'MTEL Montenegro', 'MNEMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(281, '42164', 'Morocco', 'Medi Morocco', 'MARMT', 'MOROCCO_LZ_SP05_20241028155305'),
(282, '40649', 'Netherlands', 'KPN Netherlands', 'NLDPT', 'EU_USA_LZ_SP05_20241019160745'),
(283, '40649', 'Netherlands', 'Odido Netherlands', 'NLDPN', 'EU_USA_LZ_SP05_20241019160745'),
(284, '42167', 'Netherlands', 'KPN Netherlands', 'NLDPT', 'NETHERLANDS_LZ_SP05_20241028155306'),
(285, '43943', 'Netherlands', 'KPN Netherlands', 'NLDPT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(286, '43943', 'Netherlands', 'Odido Netherlands', 'NLDPN', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(287, '43943', 'Netherlands', 'Vodafone Netherlands', 'NLDLT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(288, '42170', 'New Zealand', 'Vodafone New Zealand', 'NZLBS', 'NEWZEALAND_LZ_SP05_20241028155306'),
(289, '43943', 'New Zealand', 'Spark New Zealand', 'NZLTM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(290, '43943', 'New Zealand', 'Vodafone New Zealand', 'NZLBS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(291, '43943', 'Nigeria', 'Glo Nigeria', 'NGAGM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(292, '40649', 'Norway', 'Telenor Norway', 'NORTM', 'EU_USA_LZ_SP05_20241019160745'),
(293, '42173', 'Norway', 'Telenor Norway', 'NORTM', 'NORWAY_LZ_SP05_20241028155307'),
(294, '43943', 'Norway', 'Telia Norway', 'NORNC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(295, '43943', 'Norway', 'Telenor Norway', 'NORTM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(296, '40652', 'Pakistan', 'Jazz (Mobilink) Pakistan', 'PAKMK', 'MEA_LZ_SP05_20241019160753'),
(297, '42176', 'Pakistan', 'Jazz (Mobilink) Pakistan', 'PAKMK', 'PAKISTAN_LZ_SP05_20241028155308'),
(298, '43943', 'Pakistan', 'Jazz (Mobilink) Pakistan', 'PAKMK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(299, '42179', 'Paraguay', 'Tigo/Telecel Paraguay', 'PRYTC', 'PARAGUAY_LZ_SP05_20241028155309'),
(300, '40655', 'Philippines', 'Globe Philippines', 'PHLGT', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(301, '42182', 'Philippines', 'Globe Philippines', 'PHLGT', 'PHILIPPINES_LZ_SP05_20241028155310'),
(302, '43943', 'Philippines', 'Globe Philippines', 'PHLGT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(303, '40649', 'Poland', 'Polkomtel Poland', 'POLKM', 'EU_USA_LZ_SP05_20241019160745'),
(304, '42185', 'Poland', 'Polkomtel Poland', 'POLKM', 'POLAND_LZ_SP05_20241028155310'),
(305, '43943', 'Poland', 'Polkomtel Poland', 'POLKM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(306, '40649', 'Portugal', 'Optimus Portugal', 'PRTOP', 'EU_USA_LZ_SP05_20241019160745'),
(307, '40649', 'Portugal', 'TMN/MEO Portugal', 'PRTTM', 'EU_USA_LZ_SP05_20241019160745'),
(308, '40649', 'Portugal', 'Vodafone Portugal', 'PRTTL', 'EU_USA_LZ_SP05_20241019160745'),
(309, '42188', 'Portugal', 'Optimus Portugal', 'PRTOP', 'PORTUGAL_LZ_SP05_20241028155311'),
(310, '42188', 'Portugal', 'TMN/MEO Portugal', 'PRTTM', 'PORTUGAL_LZ_SP05_20241028155311'),
(311, '43943', 'Portugal', 'Optimus Portugal', 'PRTOP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(312, '43943', 'Portugal', 'TMN/MEO Portugal', 'PRTTM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(313, '43943', 'Portugal', 'Vodafone Portugal', 'PRTTL', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(314, '40652', 'Qatar', 'Vodafone Qatar', 'QATB1', 'MEA_LZ_SP05_20241019160753'),
(315, '42191', 'Qatar', 'Vodafone Qatar', 'QATB1', 'QATAR_LZ_SP05_20241028155312'),
(316, '43943', 'Qatar', 'Ooredoo Qatar', 'QATQT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(317, '43943', 'Qatar', 'Vodafone Qatar', 'QATB1', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(318, '43943', 'Reunion', 'TELCO', 'REUOT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(319, '40649', 'Romania', 'Orange Romania', 'ROMMR', 'EU_USA_LZ_SP05_20241019160745'),
(320, '40649', 'Romania', 'DIGI Romania', 'ROM05', 'EU_USA_LZ_SP05_20241019160745'),
(321, '42194', 'Romania', 'Orange Romania', 'ROMMR', 'ROMANIA_LZ_SP05_20241028155313'),
(322, '42194', 'Romania', 'DIGI Romania', 'ROM05', 'ROMANIA_LZ_SP05_20241028155313'),
(323, '43943', 'Romania', 'Telekom Romania', 'ROMCS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(324, '43943', 'Romania', 'Orange Romania', 'ROMMR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(325, '43943', 'Romania', 'DIGI Romania', 'ROM05', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(326, '43943', 'Romania', 'Vodafone Romania', 'ROMMF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(327, '40649', 'Russian Federation', 'VimpelCom Russia', 'RUSBD', 'EU_USA_LZ_SP05_20241019160745'),
(328, '42197', 'Russian Federation', 'VimpelCom Russia', 'RUSBD', 'RUSSIA_LZ_SP05_20241028155314'),
(329, '43943', 'Russian Federation', 'VimpelCom Russia', 'RUSBD', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(330, '40652', 'Saudi Arabia', 'Etisalat Saudi Arabia', 'SAUET', 'MEA_LZ_SP05_20241019160753'),
(331, '42200', 'Saudi Arabia', 'Etisalat Saudi Arabia', 'SAUET', 'SAUDI_ARABIA_LZ_SP05_20241028155315'),
(332, '43943', 'Saudi Arabia', 'Etisalat Saudi Arabia', 'SAUET', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(333, '42203', 'Serbia', 'Vip mobile Serbia', 'SRBNO', 'SERBIA_LZ_SP05_20241028155315'),
(334, '43943', 'Serbia', 'Vip mobile Serbia', 'SRBNO', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(335, '40655', 'Singapore', 'Singtel Singapore', 'SGPST', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(336, '42206', 'Singapore', 'Singtel Singapore', 'SGPST', 'SINGAPORE_LZ_SP05_20241028155316'),
(337, '43943', 'Singapore', 'Singtel Singapore', 'SGPST', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(338, '43943', 'Singapore', 'Starhub Singapore', 'SGPSH', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(339, '40649', 'Slovakia', 'O2 Slovakia', 'SVKO2', 'EU_USA_LZ_SP05_20241019160745'),
(340, '40649', 'Slovakia', 'Slovak Telekom (DT) Slovakia', 'SVKET', 'EU_USA_LZ_SP05_20241019160745'),
(341, '42209', 'Slovakia', 'Slovak Telekom (DT) Slovakia', 'SVKET', 'SLOVAKIA_LZ_SP05_20241028155317'),
(342, '43943', 'Slovakia', 'O2 Slovakia', 'SVKO2', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(343, '43943', 'Slovakia', 'Orange Slovakia', 'SVKGT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(344, '43943', 'Slovakia', 'Slovak Telekom (DT) Slovakia', 'SVKET', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(345, '40649', 'Slovenia', 'Telemach Slovenia', 'SVNVG', 'EU_USA_LZ_SP05_20241019160745'),
(346, '42212', 'Slovenia', 'Telemach Slovenia', 'SVNVG', 'SLOVENIA_LZ_SP05_20241028155318'),
(347, '43943', 'Slovenia', 'Telekom Slovenia', 'SVNMT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(348, '43943', 'Slovenia', 'A1 Slovenia', 'SVNSM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(349, '43943', 'Slovenia', 'Telemach Slovenia', 'SVNVG', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(350, '42215', 'South Africa', 'Vodacom South Africa ', 'ZAFVC', 'SOUTH_AFRICA_LZ_SP05_20241028155318'),
(351, '43943', 'South Korea', 'KT South Korea', 'KORKF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(352, '43943', 'South Korea', 'SK Telecom South Korea', 'KORSK', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(353, '40649', 'Spain', 'Telefonica/Movistar Spain', 'ESPTE', 'EU_USA_LZ_SP05_20241019160745'),
(354, '40649', 'Spain', 'Orange Spain', 'ESPRT', 'EU_USA_LZ_SP05_20241019160745'),
(355, '42218', 'Spain', 'Telefonica/Movistar Spain', 'ESPTE', 'SPAIN_LZ_SP05_20241028155319'),
(356, '43943', 'Spain', 'Telefonica/Movistar Spain', 'ESPTE', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(357, '43943', 'Spain', 'Orange Spain', 'ESPRT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(358, '43943', 'Spain', 'Vodafone Spain', 'ESPAT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(359, '40652', 'Sri Lanka', 'Mobitel Sri Lanka', 'LKA71', 'MEA_LZ_SP05_20241019160753'),
(360, '42221', 'Sri Lanka', 'Mobitel Sri Lanka', 'LKA71', 'SRI_LANKA_LZ_SP05_20241028155320'),
(361, '43943', 'Sri Lanka', 'Mobitel Sri Lanka', 'LKA71', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(362, '40649', 'Sweden', 'H3G Sweden', 'SWEHU', 'EU_USA_LZ_SP05_20241019160745'),
(363, '40649', 'Sweden', 'Telenor (Vodafone) Sweden', 'SWEEP', 'EU_USA_LZ_SP05_20241019160745'),
(364, '42224', 'Sweden', 'Telenor (Vodafone) Sweden', 'SWEEP', 'SWEDEN_LZ_SP05_20241028155321'),
(365, '43943', 'Sweden', 'H3G Sweden', 'SWEHU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(366, '43943', 'Sweden', 'Tele2 Sweden', 'SWEIQ', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(367, '43943', 'Sweden', 'Telenor (Vodafone) Sweden', 'SWEEP', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(368, '43943', 'Sweden', 'Telia Sweden', 'SWETR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(369, '40649', 'Switzerland', 'Sunrise Switzerland', 'CHEDX', 'EU_USA_LZ_SP05_20241019160745'),
(370, '40649', 'Switzerland', 'Salt Switzerland', 'CHEOR', 'EU_USA_LZ_SP05_20241019160745'),
(371, '42227', 'Switzerland', 'Sunrise Switzerland', 'CHEDX', 'SWITZERLAND_LZ_SP05_20241028155322'),
(372, '42227', 'Switzerland', 'Salt Switzerland', 'CHEOR', 'SWITZERLAND_LZ_SP05_20241028155322'),
(373, '43943', 'Switzerland', 'Sunrise Switzerland', 'CHEDX', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(374, '43943', 'Switzerland', 'Salt Switzerland', 'CHEOR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(375, '42230', 'Taiwan', 'Chunghwa Telecom Taiwan', 'TWNLD', 'TAIWAN_LZ_SP05_20241028155323'),
(376, '43943', 'Taiwan', 'Chunghwa Telecom Taiwan', 'TWNLD', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(377, '42233', 'Tanzania', 'ZAIN/Celtel Tanzania', 'TZACT', 'TANZANIA_LZ_SP05_20241028155323'),
(378, '40655', 'Thailand', 'AIS Thailand', 'THAWN', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(379, '40655', 'Thailand', 'DTAC Thailand ', 'THADT', 'SEA_HK_MACAU_LZ_SP05_20241019160756'),
(380, '42236', 'Thailand', 'AIS Thailand', 'THAWN', 'THAILAND_LZ_SP05_20241028155324'),
(381, '42236', 'Thailand', 'DTAC Thailand ', 'THADT', 'THAILAND_LZ_SP05_20241028155324'),
(382, '43943', 'Thailand', 'AIS Thailand', 'THAWN', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(383, '43943', 'Thailand', 'DTAC Thailand ', 'THADT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(384, '42239', 'Tunisia', 'Tunisie Telecom', 'TUNTT', 'TUNISIA_LZ_SP05_20241028155325'),
(385, '43943', 'Tunisia', 'Orange Tunisie', 'TUNOR', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(386, '43943', 'Tunisia', 'Tunisie Telecom', 'TUNTT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(387, '40649', 'Turkey', 'AVEA Turkey', 'TURIS', 'EU_USA_LZ_SP05_20241019160745'),
(388, '40649', 'Turkey', 'Turkcell Turkey', 'TURTC', 'EU_USA_LZ_SP05_20241019160745'),
(389, '40649', 'Turkey', 'Vodafone Turkey', 'TURTS', 'EU_USA_LZ_SP05_20241019160745'),
(390, '40652', 'Turkey', 'AVEA Turkey', 'TURIS', 'MEA_LZ_SP05_20241019160753'),
(391, '40652', 'Turkey', 'Turkcell Turkey', 'TURTC', 'MEA_LZ_SP05_20241019160753'),
(392, '40652', 'Turkey', 'Vodafone Turkey', 'TURTS', 'MEA_LZ_SP05_20241019160753'),
(393, '42242', 'Turkey', 'AVEA Turkey', 'TURIS', 'TURKEY_LZ_SP05_20241028155326'),
(394, '42242', 'Turkey', 'Vodafone Turkey', 'TURTS', 'TURKEY_LZ_SP05_20241028155326'),
(395, '43943', 'Turkey', 'AVEA Turkey', 'TURIS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(396, '43943', 'Turkey', 'Turkcell Turkey', 'TURTC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(397, '43943', 'Turkey', 'Vodafone Turkey', 'TURTS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(398, '42248', 'Uganda', 'Airtel/Warid Uganda', 'UGACE', 'UGANDA_LZ_SP05_20241028155328'),
(399, '40649', 'Ukraine', 'KyivStar Ukraine', 'UKRKS', 'EU_USA_LZ_SP05_20241019160745'),
(400, '40649', 'Ukraine', 'MTS Ukraine', 'UKRUM', 'EU_USA_LZ_SP05_20241019160745'),
(401, '42251', 'Ukraine', 'KyivStar Ukraine', 'UKRKS', 'UKRAINE_LZ_SP05_20241028155328'),
(402, '42251', 'Ukraine', 'MTS Ukraine', 'UKRUM', 'UKRAINE_LZ_SP05_20241028155328'),
(403, '43943', 'Ukraine', 'KyivStar Ukraine', 'UKRKS', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(404, '43943', 'Ukraine', 'MTS Ukraine', 'UKRUM', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(405, '40652', 'United Arab Emirates', 'Etisalat UAE', 'ARETC', 'MEA_LZ_SP05_20241019160753'),
(406, '42245', 'United Arab Emirates', 'Etisalat UAE', 'ARETC', 'UAE_LZ_SP05_20241028155327'),
(407, '43943', 'United Arab Emirates', 'Etisalat UAE', 'ARETC', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(408, '40649', 'United Kingdom', 'O2 UK', 'GBRCN', 'EU_USA_LZ_SP05_20241019160745'),
(409, '42254', 'United Kingdom', 'O2 UK', 'GBRCN', 'UNITED_KINGDOM_LZ_SP05_20241028155329'),
(410, '43943', 'United Kingdom', 'Sure Guernsey Limited ', 'GBRGT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(411, '43943', 'United Kingdom', 'H3G UK', 'GBRHU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(412, '43943', 'United Kingdom', 'O2 UK', 'GBRCN', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(413, '43943', 'United Kingdom', 'EE UK', 'GBRME', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(414, '43943', 'United Kingdom', 'Vodafone UK', 'GBRVF', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(415, '40649', 'United States', 'Verizon USA', 'USAK4', 'EU_USA_LZ_SP05_20241019160745'),
(416, '40649', 'United States', 'T-Mobile USA', 'USAW6', 'EU_USA_LZ_SP05_20241019160745'),
(417, '40658', 'United States', 'Verizon USA', 'USAK4', 'USA_LZ_SP05_20241019160759'),
(418, '40658', 'United States', 'T-Mobile USA', 'USAW6', 'USA_LZ_SP05_20241019160759'),
(419, '43943', 'United States', 'AT&T USA', 'USACG', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(420, '43943', 'United States', 'Verizon USA', 'USAK4', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(421, '43943', 'United States', 'T-Mobile USA', 'USAW6', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(422, '40652', 'Uzbekistan', 'Unitel Uzbekistan (Beeline)', 'UZBDU', 'MEA_LZ_SP05_20241019160753'),
(423, '40652', 'Uzbekistan', 'Ucell/Coscom Uzbekistan', 'UZB05', 'MEA_LZ_SP05_20241019160753'),
(424, '42257', 'Uzbekistan', 'Ucell/Coscom Uzbekistan', 'UZB05', 'UZBEKISTAN_LZ_SP05_20241028155330'),
(425, '43943', 'Uzbekistan', 'Unitel Uzbekistan (Beeline)', 'UZBDU', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(426, '43943', 'Uzbekistan', 'Ucell/Coscom Uzbekistan', 'UZB05', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458'),
(427, '43943', 'Vietnam', 'Viettel Vietnam', 'VNMVT', 'GLOBAL_87_COUNTRIES_LZ_SP05_SP05_20241108123458');

-- --------------------------------------------------------

--
-- Table structure for table `simmate_system_user`
--

CREATE TABLE `simmate_system_user` (
  `id` int(12) NOT NULL,
  `firstname` varchar(36) NOT NULL,
  `lastname` varchar(36) NOT NULL,
  `role` varchar(36) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(32) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simmate_system_user`
--

INSERT INTO `simmate_system_user` (`id`, `firstname`, `lastname`, `role`, `email`, `contact`, `username`, `password`, `date_added`) VALUES
(1, 'AAF', 'Admin', 'Administrator', '', '', 'demo123', '$2y$10$UQuBPHyB09Bcvqx.8lZZJuBg/Q.3uVSw70DdGedAxPv23WqpP191.', '2024-10-09 04:52:21'),
(8, 'Support', '1', 'Support', 'support1@simmate.com', '00000000', 'demo123', '$2y$10$UQuBPHyB09Bcvqx.8lZZJuBg/Q.3uVSw70DdGedAxPv23WqpP191.', '2024-10-09 04:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `simmate_tickets`
--

CREATE TABLE `simmate_tickets` (
  `id` int(1) NOT NULL,
  `ticket_number` varchar(36) NOT NULL,
  `ticket_title` text NOT NULL,
  `ticket_description` text NOT NULL,
  `customer_id` int(12) NOT NULL,
  `support_id` int(12) NOT NULL,
  `status` int(1) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simmate_tickets`
--

INSERT INTO `simmate_tickets` (`id`, `ticket_number`, `ticket_title`, `ticket_description`, `customer_id`, `support_id`, `status`, `date_added`) VALUES
(1, 'SM-20241113011', 'Sample', 'Sample', 1, 0, 0, '2024-11-13 01:23:18'),
(2, 'SM-20241113012', 'sdasd', 'asdasd', 1, 0, 0, '2024-11-13 01:24:48'),
(3, 'SM-20241113013', 'No load', 'Hello Hindi dumating load ko', 1, 0, 0, '2024-11-13 01:26:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_customer`
--
ALTER TABLE `simmate_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_providers`
--
ALTER TABLE `simmate_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_purchased`
--
ALTER TABLE `simmate_purchased`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_spark_country`
--
ALTER TABLE `simmate_spark_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_system_user`
--
ALTER TABLE `simmate_system_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simmate_tickets`
--
ALTER TABLE `simmate_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `simmate_customer`
--
ALTER TABLE `simmate_customer`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simmate_providers`
--
ALTER TABLE `simmate_providers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simmate_purchased`
--
ALTER TABLE `simmate_purchased`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simmate_spark_country`
--
ALTER TABLE `simmate_spark_country`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `simmate_system_user`
--
ALTER TABLE `simmate_system_user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `simmate_tickets`
--
ALTER TABLE `simmate_tickets`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
