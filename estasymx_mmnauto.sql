-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2020 at 12:49 PM
-- Server version: 10.3.22-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estasymx_mmnauto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_login` int(11) NOT NULL,
  `last_activity` int(11) NOT NULL,
  `token_forgot` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `token_forgot_timestamp` int(11) NOT NULL,
  `status` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `last_edit` datetime NOT NULL,
  `last_editor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `firstname`, `lastname`, `create_date`, `last_login`, `last_activity`, `token_forgot`, `token_forgot_timestamp`, `status`, `last_edit`, `last_editor`) VALUES
(1, 'admin@estarcash.tech', 'e+6gDp2za6TKVAHLdTVXgaKrMYLhLIZDiGhChcYeps7bW+tZjEnMfDJslKuJfndjdzCPKZAVQ+9lOmkC4x0i6Q==', 'Elite', 'Scripts', '2020-02-19 16:36:16', 1484716150, 1484716150, '6fdb35b869e5b662b140d0d1319c3524', 1580339054, 'Y', '2020-03-04 10:25:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT 1,
  `last_edit` datetime NOT NULL,
  `last_editor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `avataravaibles`
--

CREATE TABLE `avataravaibles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temporary` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `geral` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `starts` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `temporary` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `code`) VALUES
(1, 'Banco ABC Brasil S.A.', '246'),
(2, 'Banco ABN AMRO Real S.A.', '356'),
(3, 'Banco Alfa S.A.', '025'),
(4, 'Banco Alvorada S.A.', '641'),
(5, 'Banco Banerj S.A.', '029'),
(6, 'Banco Banestado S.A.', '038'),
(7, 'Banco Barclays S.A.', '740'),
(8, 'Banco BBM S.A.', '107'),
(9, 'Banco Beg S.A.', '031'),
(10, 'Banco Bem S.A.', '036'),
(11, 'Banco BM&F de Serviços de Liquidação e Custódia S.A', '096'),
(12, 'Banco BMC S.A.', '394'),
(13, 'Banco BMG S.A.', '318'),
(14, 'Banco BNP Paribas Brasil S.A.', '752'),
(15, 'Banco Boavista Interatlântico S.A.', '248'),
(16, 'Banco Bradesco S.A.', '237'),
(17, 'Banco Brascan S.A.', '225'),
(18, 'Banco Cacique S.A.', '263'),
(19, 'Banco Calyon Brasil S.A.', '222'),
(20, 'Banco Cargill S.A.', '040'),
(21, 'Banco Citibank S.A.', '745'),
(22, 'Banco Comercial e de Investimento Sudameris S.A.', '215'),
(23, 'Banco Cooperativo do Brasil S.A. – BANCOOB', '756'),
(24, 'Banco Cooperativo Sicredi S.A. – BANSICREDI', '748'),
(25, 'Banco Credit Suisse (Brasil) S.A.', '505'),
(26, 'Banco Cruzeiro do Sul S.A.', '229'),
(27, 'Banco da Amazônia S.A.', '003'),
(28, 'Banco Daycoval S.A.', '707'),
(29, 'Banco de Pernambuco S.A. – BANDEPE', '024'),
(30, 'Banco de Tokyo-Mitsubishi UFJ Brasil S.A.', '456'),
(31, 'Banco Dibens S.A.', '214'),
(32, 'Banco do Brasil S.A.', '001'),
(33, 'Banco do Estado de Santa Catarina S.A.', '027'),
(34, 'Banco do Estado de Sergipe S.A.', '047'),
(35, 'Banco do Estado do Pará S.A.', '037'),
(36, 'Banco do Estado do Rio Grande do Sul S.A.', '041'),
(37, 'Banco do Nordeste do Brasil S.A.', '004'),
(38, 'Banco Fator S.A.', '265'),
(39, 'Banco Fibra S.A.', '224'),
(40, 'Banco Finasa S.A.', '175'),
(41, 'Banco Fininvest S.A.', '252'),
(42, 'Banco GE Capital S.A.', '233'),
(43, 'Banco Gerdau S.A.', '734'),
(44, 'Banco Guanabara S.A.', '612'),
(45, 'Banco Ibi S.A. Banco Múltiplo', '063'),
(46, 'Banco Industrial do Brasil S.A.', '604'),
(47, 'Banco Industrial e Comercial S.A.', '320'),
(48, 'Banco Indusval S.A.', '653'),
(49, 'Banco Intercap S.A.', '630'),
(50, 'Banco Investcred Unibanco S.A.', '249'),
(51, 'Banco Itaú BBA S.A.', '184-8'),
(52, 'Banco Itaú Holding Financeira S.A.', '652'),
(53, 'Banco Itaú S.A.', '341'),
(54, 'Banco ItaúBank S.A', '479'),
(55, 'Banco J. P. Morgan S.A.', '376'),
(56, 'Banco J. Safra S.A.', '074'),
(57, 'Banco Luso Brasileiro S.A.', '600'),
(58, 'Banco Mercantil de São Paulo S.A.', '392'),
(59, 'Banco Mercantil do Brasil S.A.', '389'),
(60, 'Banco Merrill Lynch de Investimentos S.A.', '755'),
(61, 'Banco Nossa Caixa S.A.', '151'),
(62, 'Banco Opportunity S.A.', '045'),
(63, 'Banco Panamericano S.A.', '623'),
(64, 'Banco Paulista S.A.', '611'),
(65, 'Banco Pine S.A.', '643'),
(66, 'Banco Prosper S.A.', '638'),
(67, 'Banco Rabobank International Brasil S.A.', '747'),
(68, 'Banco Rendimento S.A.', '633'),
(69, 'Banco Rural Mais S.A.', '072'),
(70, 'Banco Rural S.A.', '453'),
(71, 'Banco Safra S.A.', '422'),
(73, 'Banco Schahin S.A.', '250'),
(74, 'Banco Simples S.A.', '749'),
(75, 'Banco Société Générale Brasil S.A.', '366'),
(76, 'Banco Sofisa S.A.', '637'),
(77, 'Banco Sudameris Brasil S.A.', '347'),
(78, 'Banco Sumitomo Mitsui Brasileiro S.A.', '464'),
(79, 'Banco Triângulo S.A.', '634'),
(80, 'Banco UBS Pactual S.A.', '208'),
(81, 'Banco UBS S.A.', '247'),
(82, 'Banco Único S.A.', '116'),
(83, 'Banco Votorantim S.A.', '655'),
(84, 'Banco VR S.A.', '610'),
(85, 'Banco WestLB do Brasil S.A.', '370'),
(86, 'BANESTES S.A. Banco do Estado do Espírito Santo', '021'),
(87, 'Banif-Banco Internacional do Funchal (Brasil)S.A.', '719'),
(88, 'Bankpar Banco Multiplo S.A.', '204'),
(89, 'BB Banco Popular do Brasil S.A.', '073-6'),
(90, 'BPN Brasil Banco Mútiplo S.A.', '069-8'),
(91, 'BRB – Banco de Brasília S.A.', '070'),
(92, 'Caixa Econômica Federal', '104'),
(93, 'Citibank N.A.', '477'),
(94, 'Deutsche Bank S.A. – Banco Alemão', '487'),
(95, 'Dresdner Bank Brasil S.A. – Banco Múltiplo', '751'),
(96, 'Dresdner Bank Lateinamerika Aktiengesellschaft', '210'),
(97, 'Hipercard Banco Múltiplo S.A.', '062'),
(98, 'HSBC Bank Brasil S.A. – Banco Múltiplo', '399'),
(99, 'ING Bank N.V.', '492'),
(100, 'JPMorgan Chase Bank', '488'),
(101, 'Lemon Bank Banco Múltiplo S.A.', '065'),
(102, 'UNIBANCO – União de Bancos Brasileiros S.A.', '409'),
(103, 'Unicard Banco Múltiplo S.A.', '230'),
(104, 'Banco Santander (Brasil) S.A.', '033'),
(105, 'Cooperativa Central de Crédito Urbano-CECRED', '085');

-- --------------------------------------------------------

--
-- Table structure for table `binarytrees`
--

CREATE TABLE `binarytrees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uleft` int(11) NOT NULL,
  `uright` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binarytrees`
--

INSERT INTO `binarytrees` (`id`, `user_id`, `uleft`, `uright`) VALUES
(1, 1, 2, 4),
(2, 2, 0, 0),
(3, 4, 0, 0),
(4, 5, 6, 7),
(5, 6, 8, 13),
(6, 7, 10, 12),
(7, 8, 9, 11),
(8, 9, 0, 0),
(9, 10, 0, 0),
(10, 11, 0, 0),
(11, 12, 0, 0),
(12, 13, 14, 0),
(13, 14, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comprovants`
--

CREATE TABLE `comprovants` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename_original` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `comprovants`
--

INSERT INTO `comprovants` (`id`, `invoice_id`, `filename`, `filename_original`, `date`) VALUES
(1, 1, '3e7b070f65a904a81ec6ab04242c4b1d.JPG', 'conversor.JPG', '2020-03-06 10:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `code` char(2) CHARACTER SET latin1 NOT NULL COMMENT 'Two-letter country code (ISO 3166-1 alpha-2)',
  `name` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'English country name',
  `full_name` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'Full English country name',
  `iso3` char(3) CHARACTER SET latin1 NOT NULL COMMENT 'Three-letter country code (ISO 3166-1 alpha-3)',
  `number` smallint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Three-digit country number (ISO 3166-1 numeric)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`code`, `name`, `full_name`, `iso3`, `number`) VALUES
('ad', 'Andorra', 'Principality of Andorra', 'AND', 020),
('ae', 'United Arab Emirates', 'United Arab Emirates', 'ARE', 784),
('af', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', 004),
('ag', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', 028),
('ai', 'Anguilla', 'Anguilla', 'AIA', 660),
('al', 'Albania', 'Republic of Albania', 'ALB', 008),
('am', 'Armenia', 'Republic of Armenia', 'ARM', 051),
('ao', 'Angola', 'Republic of Angola', 'AGO', 024),
('aq', 'Antarctica', 'Antarctica (the territory South of 60 deg S)', 'ATA', 010),
('ar', 'Argentina', 'Argentine Republic', 'ARG', 032),
('as', 'American Samoa', 'American Samoa', 'ASM', 016),
('at', 'Austria', 'Republic of Austria', 'AUT', 040),
('au', 'Australia', 'Commonwealth of Australia', 'AUS', 036),
('aw', 'Aruba', 'Aruba', 'ABW', 533),
('ax', 'Åland Islands', 'Åland Islands', 'ALA', 248),
('az', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', 031),
('ba', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', 070),
('bb', 'Barbados', 'Barbados', 'BRB', 052),
('bd', 'Bangladesh', 'People\'s Republic of Bangladesh', 'BGD', 050),
('be', 'Belgium', 'Kingdom of Belgium', 'BEL', 056),
('bf', 'Burkina Faso', 'Burkina Faso', 'BFA', 854),
('bg', 'Bulgaria', 'Republic of Bulgaria', 'BGR', 100),
('bh', 'Bahrain', 'Kingdom of Bahrain', 'BHR', 048),
('bi', 'Burundi', 'Republic of Burundi', 'BDI', 108),
('bj', 'Benin', 'Republic of Benin', 'BEN', 204),
('bl', 'Saint Barthélemy', 'Saint Barthélemy', 'BLM', 652),
('bm', 'Bermuda', 'Bermuda', 'BMU', 060),
('bn', 'Brunei Darussalam', 'Brunei Darussalam', 'BRN', 096),
('bo', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', 068),
('bq', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', 535),
('br', 'Brazil', 'Federative Republic of Brazil', 'BRA', 076),
('bs', 'Bahamas', 'Commonwealth of the Bahamas', 'BHS', 044),
('bt', 'Bhutan', 'Kingdom of Bhutan', 'BTN', 064),
('bv', 'Bouvet Island (Bouvetoya)', 'Bouvet Island (Bouvetoya)', 'BVT', 074),
('bw', 'Botswana', 'Republic of Botswana', 'BWA', 072),
('by', 'Belarus', 'Republic of Belarus', 'BLR', 112),
('bz', 'Belize', 'Belize', 'BLZ', 084),
('ca', 'Canada', 'Canada', 'CAN', 124),
('cc', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', 166),
('cd', 'Congo', 'Democratic Republic of the Congo', 'COD', 180),
('cf', 'Central African Republic', 'Central African Republic', 'CAF', 140),
('cg', 'Congo', 'Republic of the Congo', 'COG', 178),
('ch', 'Switzerland', 'Swiss Confederation', 'CHE', 756),
('ci', 'Cote d\'Ivoire', 'Republic of Cote d\'Ivoire', 'CIV', 384),
('ck', 'Cook Islands', 'Cook Islands', 'COK', 184),
('cl', 'Chile', 'Republic of Chile', 'CHL', 152),
('cm', 'Cameroon', 'Republic of Cameroon', 'CMR', 120),
('cn', 'China', 'People\'s Republic of China', 'CHN', 156),
('co', 'Colombia', 'Republic of Colombia', 'COL', 170),
('cr', 'Costa Rica', 'Republic of Costa Rica', 'CRI', 188),
('cu', 'Cuba', 'Republic of Cuba', 'CUB', 192),
('cv', 'Cape Verde', 'Republic of Cape Verde', 'CPV', 132),
('cw', 'Curaçao', 'Curaçao', 'CUW', 531),
('cx', 'Christmas Island', 'Christmas Island', 'CXR', 162),
('cy', 'Cyprus', 'Republic of Cyprus', 'CYP', 196),
('cz', 'Czech Republic', 'Czech Republic', 'CZE', 203),
('de', 'Germany', 'Federal Republic of Germany', 'DEU', 276),
('dj', 'Djibouti', 'Republic of Djibouti', 'DJI', 262),
('dk', 'Denmark', 'Kingdom of Denmark', 'DNK', 208),
('dm', 'Dominica', 'Commonwealth of Dominica', 'DMA', 212),
('do', 'Dominican Republic', 'Dominican Republic', 'DOM', 214),
('dz', 'Algeria', 'People\'s Democratic Republic of Algeria', 'DZA', 012),
('ec', 'Ecuador', 'Republic of Ecuador', 'ECU', 218),
('ee', 'Estonia', 'Republic of Estonia', 'EST', 233),
('eg', 'Egypt', 'Arab Republic of Egypt', 'EGY', 818),
('eh', 'Western Sahara', 'Western Sahara', 'ESH', 732),
('er', 'Eritrea', 'State of Eritrea', 'ERI', 232),
('es', 'Spain', 'Kingdom of Spain', 'ESP', 724),
('et', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', 231),
('fi', 'Finland', 'Republic of Finland', 'FIN', 246),
('fj', 'Fiji', 'Republic of Fiji', 'FJI', 242),
('fk', 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('fm', 'Micronesia', 'Federated States of Micronesia', 'FSM', 583),
('fo', 'Faroe Islands', 'Faroe Islands', 'FRO', 234),
('fr', 'France', 'French Republic', 'FRA', 250),
('ga', 'Gabon', 'Gabonese Republic', 'GAB', 266),
('gb', 'United Kingdom of Great Britain & Northern Ireland', 'United Kingdom of Great Britain & Northern Ireland', 'GBR', 826),
('gd', 'Grenada', 'Grenada', 'GRD', 308),
('ge', 'Georgia', 'Georgia', 'GEO', 268),
('gf', 'French Guiana', 'French Guiana', 'GUF', 254),
('gg', 'Guernsey', 'Bailiwick of Guernsey', 'GGY', 831),
('gh', 'Ghana', 'Republic of Ghana', 'GHA', 288),
('gi', 'Gibraltar', 'Gibraltar', 'GIB', 292),
('gl', 'Greenland', 'Greenland', 'GRL', 304),
('gm', 'Gambia', 'Republic of the Gambia', 'GMB', 270),
('gn', 'Guinea', 'Republic of Guinea', 'GIN', 324),
('gp', 'Guadeloupe', 'Guadeloupe', 'GLP', 312),
('gq', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', 226),
('gr', 'Greece', 'Hellenic Republic Greece', 'GRC', 300),
('gs', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', 239),
('gt', 'Guatemala', 'Republic of Guatemala', 'GTM', 320),
('gu', 'Guam', 'Guam', 'GUM', 316),
('gw', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', 624),
('gy', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', 328),
('hk', 'Hong Kong', 'Hong Kong Special Administrative Region of China', 'HKG', 344),
('hm', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', 334),
('hn', 'Honduras', 'Republic of Honduras', 'HND', 340),
('hr', 'Croatia', 'Republic of Croatia', 'HRV', 191),
('ht', 'Haiti', 'Republic of Haiti', 'HTI', 332),
('hu', 'Hungary', 'Hungary', 'HUN', 348),
('id', 'Indonesia', 'Republic of Indonesia', 'IDN', 360),
('ie', 'Ireland', 'Ireland', 'IRL', 372),
('il', 'Israel', 'State of Israel', 'ISR', 376),
('im', 'Isle of Man', 'Isle of Man', 'IMN', 833),
('in', 'India', 'Republic of India', 'IND', 356),
('io', 'British Indian Ocean Territory (Chagos Archipelago)', 'British Indian Ocean Territory (Chagos Archipelago)', 'IOT', 086),
('iq', 'Iraq', 'Republic of Iraq', 'IRQ', 368),
('ir', 'Iran', 'Islamic Republic of Iran', 'IRN', 364),
('is', 'Iceland', 'Republic of Iceland', 'ISL', 352),
('it', 'Italy', 'Italian Republic', 'ITA', 380),
('je', 'Jersey', 'Bailiwick of Jersey', 'JEY', 832),
('jm', 'Jamaica', 'Jamaica', 'JAM', 388),
('jo', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', 400),
('jp', 'Japan', 'Japan', 'JPN', 392),
('ke', 'Kenya', 'Republic of Kenya', 'KEN', 404),
('kg', 'Kyrgyz Republic', 'Kyrgyz Republic', 'KGZ', 417),
('kh', 'Cambodia', 'Kingdom of Cambodia', 'KHM', 116),
('ki', 'Kiribati', 'Republic of Kiribati', 'KIR', 296),
('km', 'Comoros', 'Union of the Comoros', 'COM', 174),
('kn', 'Saint Kitts and Nevis', 'Federation of Saint Kitts and Nevis', 'KNA', 659),
('kp', 'Korea', 'Democratic People\'s Republic of Korea', 'PRK', 408),
('kr', 'Korea', 'Republic of Korea', 'KOR', 410),
('kw', 'Kuwait', 'State of Kuwait', 'KWT', 414),
('ky', 'Cayman Islands', 'Cayman Islands', 'CYM', 136),
('kz', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', 398),
('la', 'Lao People\'s Democratic Republic', 'Lao People\'s Democratic Republic', 'LAO', 418),
('lb', 'Lebanon', 'Lebanese Republic', 'LBN', 422),
('lc', 'Saint Lucia', 'Saint Lucia', 'LCA', 662),
('li', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', 438),
('lk', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', 144),
('lr', 'Liberia', 'Republic of Liberia', 'LBR', 430),
('ls', 'Lesotho', 'Kingdom of Lesotho', 'LSO', 426),
('lt', 'Lithuania', 'Republic of Lithuania', 'LTU', 440),
('lu', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', 442),
('lv', 'Latvia', 'Republic of Latvia', 'LVA', 428),
('ly', 'Libya', 'Libya', 'LBY', 434),
('ma', 'Morocco', 'Kingdom of Morocco', 'MAR', 504),
('mc', 'Monaco', 'Principality of Monaco', 'MCO', 492),
('md', 'Moldova', 'Republic of Moldova', 'MDA', 498),
('me', 'Montenegro', 'Montenegro', 'MNE', 499),
('mf', 'Saint Martin', 'Saint Martin (French part)', 'MAF', 663),
('mg', 'Madagascar', 'Republic of Madagascar', 'MDG', 450),
('mh', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', 584),
('mk', 'Macedonia', 'Republic of Macedonia', 'MKD', 807),
('ml', 'Mali', 'Republic of Mali', 'MLI', 466),
('mm', 'Myanmar', 'Republic of the Union of Myanmar', 'MMR', 104),
('mn', 'Mongolia', 'Mongolia', 'MNG', 496),
('mo', 'Macao', 'Macao Special Administrative Region of China', 'MAC', 446),
('mp', 'Northern Mariana Islands', 'Commonwealth of the Northern Mariana Islands', 'MNP', 580),
('mq', 'Martinique', 'Martinique', 'MTQ', 474),
('mr', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', 478),
('ms', 'Montserrat', 'Montserrat', 'MSR', 500),
('mt', 'Malta', 'Republic of Malta', 'MLT', 470),
('mu', 'Mauritius', 'Republic of Mauritius', 'MUS', 480),
('mv', 'Maldives', 'Republic of Maldives', 'MDV', 462),
('mw', 'Malawi', 'Republic of Malawi', 'MWI', 454),
('mx', 'Mexico', 'United Mexican States', 'MEX', 484),
('my', 'Malaysia', 'Malaysia', 'MYS', 458),
('mz', 'Mozambique', 'Republic of Mozambique', 'MOZ', 508),
('na', 'Namibia', 'Republic of Namibia', 'NAM', 516),
('nc', 'New Caledonia', 'New Caledonia', 'NCL', 540),
('ne', 'Niger', 'Republic of Niger', 'NER', 562),
('nf', 'Norfolk Island', 'Norfolk Island', 'NFK', 574),
('ng', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', 566),
('ni', 'Nicaragua', 'Republic of Nicaragua', 'NIC', 558),
('nl', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', 528),
('no', 'Norway', 'Kingdom of Norway', 'NOR', 578),
('np', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', 524),
('nr', 'Nauru', 'Republic of Nauru', 'NRU', 520),
('nu', 'Niue', 'Niue', 'NIU', 570),
('nz', 'New Zealand', 'New Zealand', 'NZL', 554),
('om', 'Oman', 'Sultanate of Oman', 'OMN', 512),
('pa', 'Panama', 'Republic of Panama', 'PAN', 591),
('pe', 'Peru', 'Republic of Peru', 'PER', 604),
('pf', 'French Polynesia', 'French Polynesia', 'PYF', 258),
('pg', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', 598),
('ph', 'Philippines', 'Republic of the Philippines', 'PHL', 608),
('pk', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', 586),
('pl', 'Poland', 'Republic of Poland', 'POL', 616),
('pm', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', 666),
('pn', 'Pitcairn Islands', 'Pitcairn Islands', 'PCN', 612),
('pr', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', 630),
('ps', 'Palestinian Territory', 'Occupied Palestinian Territory', 'PSE', 275),
('pt', 'Portugal', 'Portuguese Republic', 'PRT', 620),
('pw', 'Palau', 'Republic of Palau', 'PLW', 585),
('py', 'Paraguay', 'Republic of Paraguay', 'PRY', 600),
('qa', 'Qatar', 'State of Qatar', 'QAT', 634),
('re', 'Réunion', 'Réunion', 'REU', 638),
('ro', 'Romania', 'Romania', 'ROU', 642),
('rs', 'Serbia', 'Republic of Serbia', 'SRB', 688),
('ru', 'Russian Federation', 'Russian Federation', 'RUS', 643),
('rw', 'Rwanda', 'Republic of Rwanda', 'RWA', 646),
('sa', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', 682),
('sb', 'Solomon Islands', 'Solomon Islands', 'SLB', 090),
('sc', 'Seychelles', 'Republic of Seychelles', 'SYC', 690),
('sd', 'Sudan', 'Republic of Sudan', 'SDN', 729),
('se', 'Sweden', 'Kingdom of Sweden', 'SWE', 752),
('sg', 'Singapore', 'Republic of Singapore', 'SGP', 702),
('sh', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', 654),
('si', 'Slovenia', 'Republic of Slovenia', 'SVN', 705),
('sj', 'Svalbard & Jan Mayen Islands', 'Svalbard & Jan Mayen Islands', 'SJM', 744),
('sk', 'Slovakia (Slovak Republic)', 'Slovakia (Slovak Republic)', 'SVK', 703),
('sl', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', 694),
('sm', 'San Marino', 'Republic of San Marino', 'SMR', 674),
('sn', 'Senegal', 'Republic of Senegal', 'SEN', 686),
('so', 'Somalia', 'Somali Republic', 'SOM', 706),
('sr', 'Suriname', 'Republic of Suriname', 'SUR', 740),
('ss', 'South Sudan', 'Republic of South Sudan', 'SSD', 728),
('st', 'Sao Tome and Principe', 'Democratic Republic of Sao Tome and Principe', 'STP', 678),
('sv', 'El Salvador', 'Republic of El Salvador', 'SLV', 222),
('sx', 'Sint Maarten (Dutch part)', 'Sint Maarten (Dutch part)', 'SXM', 534),
('sy', 'Syrian Arab Republic', 'Syrian Arab Republic', 'SYR', 760),
('sz', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', 748),
('tc', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', 796),
('td', 'Chad', 'Republic of Chad', 'TCD', 148),
('tf', 'French Southern Territories', 'French Southern Territories', 'ATF', 260),
('tg', 'Togo', 'Togolese Republic', 'TGO', 768),
('th', 'Thailand', 'Kingdom of Thailand', 'THA', 764),
('tj', 'Tajikistan', 'Republic of Tajikistan', 'TJK', 762),
('tk', 'Tokelau', 'Tokelau', 'TKL', 772),
('tl', 'Timor-Leste', 'Democratic Republic of Timor-Leste', 'TLS', 626),
('tm', 'Turkmenistan', 'Turkmenistan', 'TKM', 795),
('tn', 'Tunisia', 'Tunisian Republic', 'TUN', 788),
('to', 'Tonga', 'Kingdom of Tonga', 'TON', 776),
('tr', 'Turkey', 'Republic of Turkey', 'TUR', 792),
('tt', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', 780),
('tv', 'Tuvalu', 'Tuvalu', 'TUV', 798),
('tw', 'Taiwan', 'Taiwan, Province of China', 'TWN', 158),
('tz', 'Tanzania', 'United Republic of Tanzania', 'TZA', 834),
('ua', 'Ukraine', 'Ukraine', 'UKR', 804),
('ug', 'Uganda', 'Republic of Uganda', 'UGA', 800),
('um', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', 581),
('us', 'United States of America', 'United States of America', 'USA', 840),
('uy', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', 858),
('uz', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', 860),
('va', 'Holy See (Vatican City State)', 'Holy See (Vatican City State)', 'VAT', 336),
('vc', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', 670),
('ve', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', 862),
('vg', 'British Virgin Islands', 'British Virgin Islands', 'VGB', 092),
('vi', 'United States Virgin Islands', 'United States Virgin Islands', 'VIR', 850),
('vn', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', 704),
('vu', 'Vanuatu', 'Republic of Vanuatu', 'VUT', 548),
('wf', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', 876),
('ws', 'Samoa', 'Independent State of Samoa', 'WSM', 882),
('ye', 'Yemen', 'Yemen', 'YEM', 887),
('yt', 'Mayotte', 'Mayotte', 'MYT', 175),
('za', 'South Africa', 'Republic of South Africa', 'ZAF', 710),
('zm', 'Zambia', 'Republic of Zambia', 'ZMB', 894),
('zw', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `extracts`
--

CREATE TABLE `extracts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `type` enum('credit','debit','lost') COLLATE utf8_unicode_ci NOT NULL,
  `subtype` enum('withdrawal','payment','bonus','transfer','recharge','other') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
  `bonus_cod` tinyint(4) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `extracts`
--

INSERT INTO `extracts` (`id`, `user_id`, `date`, `description`, `value`, `type`, `subtype`, `bonus_cod`, `transfer_id`, `invoice_id`, `lottery_id`) VALUES
(1, 1, '2020-03-07 09:56:24', 'Bonus de indicação direta.', 25, 'credit', 'bonus', 1, 0, 2, 0),
(2, 1, '2020-03-31 00:54:19', 'Solicitação de saque.', 24.5, 'debit', 'withdrawal', 0, 0, 0, 0),
(3, 1, '2020-03-31 00:54:19', 'Taxa solicitação de saque.', 0.5, 'debit', 'withdrawal', 0, 0, 0, 0),
(4, 1, '2020-04-03 14:44:13', 'Bonus de indicação direta.', 25000, 'credit', 'bonus', 1, 0, 6, 0),
(5, 5, '2020-04-03 14:58:28', 'Bonus de indicação direta.', 1.5, 'credit', 'bonus', 1, 0, 7, 0),
(6, 1, '2020-04-03 14:58:28', 'Bonus de indicação indireta.', 0.6, 'lost', 'bonus', 2, 0, 7, 0),
(7, 5, '2020-04-03 15:05:22', 'Bonus de indicação direta.', 5, 'credit', 'bonus', 1, 0, 8, 0),
(8, 1, '2020-04-03 15:05:22', 'Bonus de indicação indireta.', 2, 'lost', 'bonus', 2, 0, 8, 0),
(9, 6, '2020-04-03 15:19:19', 'Bonus de indicação direta.', 1000, 'credit', 'bonus', 1, 0, 9, 0),
(10, 5, '2020-04-03 15:19:19', 'Bonus de indicação indireta.', 400, 'credit', 'bonus', 2, 0, 9, 0),
(11, 1, '2020-04-03 15:19:19', 'Bonus de indicação indireta.', 400, 'lost', 'bonus', 2, 0, 9, 0),
(12, 8, '2020-04-03 15:46:39', 'Bonus de indicação direta.', 200, 'credit', 'bonus', 1, 0, 10, 0),
(13, 6, '2020-04-03 15:46:39', 'Bonus de indicação indireta.', 80, 'lost', 'bonus', 2, 0, 10, 0),
(14, 5, '2020-04-03 15:46:39', 'Bonus de indicação indireta.', 80, 'credit', 'bonus', 2, 0, 10, 0),
(15, 1, '2020-04-03 15:46:39', 'Bonus de indicação indireta.', 80, 'lost', 'bonus', 2, 0, 10, 0),
(16, 7, '2020-04-03 15:51:46', 'Bonus de indicação direta.', 500, 'credit', 'bonus', 1, 0, 11, 0),
(17, 5, '2020-04-03 15:51:46', 'Bonus de indicação indireta.', 200, 'credit', 'bonus', 2, 0, 11, 0),
(18, 1, '2020-04-03 15:51:46', 'Bonus de indicação indireta.', 200, 'lost', 'bonus', 2, 0, 11, 0),
(19, 8, '2020-04-03 15:52:15', 'Bonus de indicação direta.', 50, 'credit', 'bonus', 1, 0, 12, 0),
(20, 6, '2020-04-03 15:52:15', 'Bonus de indicação indireta.', 20, 'lost', 'bonus', 2, 0, 12, 0),
(21, 5, '2020-04-03 15:52:15', 'Bonus de indicação indireta.', 20, 'credit', 'bonus', 2, 0, 12, 0),
(22, 1, '2020-04-03 15:52:15', 'Bonus de indicação indireta.', 20, 'lost', 'bonus', 2, 0, 12, 0),
(23, 7, '2020-04-03 15:56:16', 'Bonus de indicação direta.', 50, 'lost', 'bonus', 1, 0, 13, 0),
(24, 5, '2020-04-03 15:56:16', 'Bonus de indicação indireta.', 20, 'credit', 'bonus', 2, 0, 13, 0),
(25, 1, '2020-04-03 15:56:16', 'Bonus de indicação indireta.', 20, 'lost', 'bonus', 2, 0, 13, 0),
(26, 5, '2020-04-03 16:01:15', 'Transferência.', 22, 'debit', 'transfer', 0, 1, 0, 0),
(27, 6, '2020-04-03 16:01:15', 'Transferência.', 20, 'credit', 'transfer', 0, 1, 0, 0),
(28, 5, '2020-04-03 16:05:43', 'Transferência.', 55, 'debit', 'transfer', 0, 2, 0, 0),
(29, 11, '2020-04-03 16:05:43', 'Transferência.', 50, 'credit', 'transfer', 0, 2, 0, 0),
(30, 5, '2020-04-03 16:08:30', 'Transferência.', 44, 'debit', 'transfer', 0, 3, 0, 0),
(31, 13, '2020-04-03 16:08:30', 'Transferência.', 40, 'credit', 'transfer', 0, 3, 0, 0),
(32, 11, '2020-04-03 16:11:02', 'Pagar faturas.', 50, 'debit', 'payment', 0, 1, 0, 0),
(33, 8, '2020-04-03 16:11:02', 'Bonus de indicação direta.', 2.5, 'credit', 'bonus', 1, 0, 14, 0),
(34, 6, '2020-04-03 16:11:02', 'Bonus de indicação indireta.', 1, 'lost', 'bonus', 2, 0, 14, 0),
(35, 5, '2020-04-03 16:11:02', 'Bonus de indicação indireta.', 1, 'credit', 'bonus', 2, 0, 14, 0),
(36, 1, '2020-04-03 16:11:02', 'Bonus de indicação indireta.', 1, 'lost', 'bonus', 2, 0, 14, 0),
(37, 13, '2020-04-03 16:25:50', 'Pagar faturas.', 40, 'debit', 'payment', 0, 2, 0, 0),
(38, 6, '2020-04-03 16:25:50', 'Bonus de indicação direta.', 2, 'lost', 'bonus', 1, 0, 15, 0),
(39, 5, '2020-04-03 16:25:50', 'Bonus de indicação indireta.', 0.8, 'credit', 'bonus', 2, 0, 15, 0),
(40, 1, '2020-04-03 16:25:50', 'Bonus de indicação indireta.', 0.8, 'lost', 'bonus', 2, 0, 15, 0),
(41, 13, '2020-04-03 16:32:33', 'Bonus de indicação direta.', 50, 'credit', 'bonus', 1, 0, 16, 0),
(42, 6, '2020-04-03 16:32:33', 'Bonus de indicação indireta.', 20, 'lost', 'bonus', 2, 0, 16, 0),
(43, 5, '2020-04-03 16:32:33', 'Bonus de indicação indireta.', 20, 'credit', 'bonus', 2, 0, 16, 0),
(44, 1, '2020-04-03 16:32:33', 'Bonus de indicação indireta.', 20, 'lost', 'bonus', 2, 0, 16, 0),
(45, 13, '2020-04-03 16:35:36', 'Bonus de indicação direta.', 200, 'credit', 'bonus', 1, 0, 18, 0),
(46, 6, '2020-04-03 16:35:36', 'Bonus de indicação indireta.', 80, 'lost', 'bonus', 2, 0, 18, 0),
(47, 5, '2020-04-03 16:35:36', 'Bonus de indicação indireta.', 80, 'credit', 'bonus', 2, 0, 18, 0),
(48, 1, '2020-04-03 16:35:36', 'Bonus de indicação indireta.', 80, 'lost', 'bonus', 2, 0, 18, 0),
(49, 13, '2020-04-03 16:39:36', 'Transferência.', 220, 'debit', 'transfer', 0, 4, 0, 0),
(50, 11, '2020-04-03 16:39:36', 'Transferência.', 200, 'credit', 'transfer', 0, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `last_edit` date NOT NULL,
  `last_editor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('buy','upgrade','monthly','recharge') COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `due_date` date NOT NULL,
  `sum` float NOT NULL,
  `status` enum('open','paid','canceled','overdue') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `discount` float NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `btc_required` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btc_paid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `btc_payment_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_btc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_att` datetime NOT NULL,
  `last_editor` int(11) DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `type`, `date`, `due_date`, `sum`, `status`, `payment_date`, `payment_method`, `notes`, `discount`, `avatar_id`, `btc_required`, `btc_paid`, `btc_payment_id`, `status_btc`, `last_att`, `last_editor`, `days`) VALUES
(1, 1, 'buy', '2020-03-06 10:56:46', '0000-00-00', 300, 'paid', '2020-03-06 10:57:29', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-03-06 10:57:29', 1, 0),
(2, 4, 'buy', '2020-03-07 09:55:28', '0000-00-00', 500, 'paid', '2020-03-07 09:56:24', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-03-07 09:56:24', 1, 0),
(3, 1, 'buy', '2020-03-19 05:15:59', '0000-00-00', 10, 'open', '0000-00-00 00:00:00', '', '', 0, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0),
(4, 1, 'buy', '2020-03-31 16:39:05', '0000-00-00', 2000, 'open', '0000-00-00 00:00:00', '', '', 0, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0),
(5, 1, 'buy', '2020-04-01 20:38:28', '0000-00-00', 11.11, 'open', '0000-00-00 00:00:00', '', '', 0, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0),
(6, 5, 'buy', '2020-04-03 14:28:57', '0000-00-00', 500000, 'paid', '2020-04-03 14:44:13', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 14:44:13', NULL, 0),
(7, 6, 'buy', '2020-04-03 14:57:33', '0000-00-00', 30, 'paid', '2020-04-03 14:58:28', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 14:58:28', 1, 0),
(8, 7, 'buy', '2020-04-03 15:03:55', '0000-00-00', 100, 'paid', '2020-04-03 15:05:22', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:05:22', 1, 0),
(9, 8, 'buy', '2020-04-03 15:16:06', '0000-00-00', 20000, 'paid', '2020-04-03 15:19:19', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:19:19', 1, 0),
(10, 9, 'buy', '2020-04-03 15:46:17', '0000-00-00', 4000, 'paid', '2020-04-03 15:46:39', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:46:39', 1, 0),
(11, 10, 'buy', '2020-04-03 15:51:15', '0000-00-00', 10000, 'paid', '2020-04-03 15:51:46', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:51:46', 1, 0),
(12, 11, 'buy', '2020-04-03 15:51:22', '0000-00-00', 1000, 'paid', '2020-04-03 15:52:15', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:52:15', 1, 0),
(13, 12, 'buy', '2020-04-03 15:55:26', '0000-00-00', 1000, 'paid', '2020-04-03 15:56:16', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 15:56:16', 1, 0),
(14, 11, 'buy', '2020-04-03 16:08:26', '0000-00-00', 50, 'paid', '2020-04-03 16:11:02', 'payout', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 16:11:02', NULL, 0),
(15, 13, 'buy', '2020-04-03 16:10:18', '0000-00-00', 40, 'paid', '2020-04-03 16:25:50', 'payout', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 16:25:50', NULL, 0),
(16, 14, 'buy', '2020-04-03 16:32:10', '0000-00-00', 1000, 'paid', '2020-04-03 16:32:33', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 16:32:33', 1, 0),
(17, 14, 'buy', '2020-04-03 16:32:20', '0000-00-00', 1000, 'open', '0000-00-00 00:00:00', '', '', 0, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0),
(18, 14, 'buy', '2020-04-03 16:34:37', '0000-00-00', 4000, 'paid', '2020-04-03 16:35:36', '', '', 0, 0, NULL, NULL, NULL, NULL, '2020-04-03 16:35:36', 1, 0),
(19, 1, 'buy', '2020-04-04 16:09:29', '0000-00-00', 100, 'open', '0000-00-00 00:00:00', '', '', 0, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_items`
--

CREATE TABLE `invoices_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `amount` tinyint(4) NOT NULL DEFAULT 1,
  `plan_id` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices_items`
--

INSERT INTO `invoices_items` (`id`, `invoice_id`, `name`, `description`, `value`, `amount`, `plan_id`) VALUES
(1, 1, 'Investimento', '-', 300, 1, 0),
(2, 2, 'Investimento', '-', 500, 1, 0),
(3, 3, 'Investimento', '-', 10, 1, 0),
(4, 4, 'Investimento', '-', 2000, 1, 0),
(5, 5, 'Investimento', '-', 11.11, 1, 0),
(6, 6, 'Investimento', '-', 500000, 1, 0),
(7, 7, 'Investimento', '-', 30, 1, 0),
(8, 8, 'Investimento', '-', 100, 1, 0),
(9, 9, 'Investimento', '-', 20000, 1, 0),
(10, 10, 'Investimento', '-', 4000, 1, 0),
(11, 11, 'Investimento', '-', 10000, 1, 0),
(12, 12, 'Investimento', '-', 1000, 1, 0),
(13, 13, 'Investimento', '-', 1000, 1, 0),
(14, 14, 'Investimento', '-', 50, 1, 0),
(15, 15, 'Investimento', '-', 40, 1, 0),
(16, 16, 'Investimento', '-', 1000, 1, 0),
(17, 17, 'Investimento', '-', 1000, 1, 0),
(18, 18, 'Investimento', '-', 4000, 1, 0),
(19, 19, 'Investimento', '-', 100, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lotters`
--

CREATE TABLE `lotters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('open','paid','cancel') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `starts` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `max_tickets` int(11) NOT NULL,
  `max_tickets_person` int(11) NOT NULL,
  `buyed_tickets` int(11) NOT NULL,
  `ticket_price` float NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `value_initial` float NOT NULL,
  `type` enum('acum','fix') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'acum',
  `value_win` float DEFAULT NULL,
  `value_total` float NOT NULL,
  `create_by` int(11) NOT NULL,
  `last_edit` datetime DEFAULT NULL,
  `last_editor` int(11) DEFAULT NULL,
  `percent_emp` int(11) NOT NULL,
  `winners` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `lotters`
--

INSERT INTO `lotters` (`id`, `name`, `status`, `starts`, `ends`, `max_tickets`, `max_tickets_person`, `buyed_tickets`, `ticket_price`, `description`, `value_initial`, `type`, `value_win`, `value_total`, `create_by`, `last_edit`, `last_editor`, `percent_emp`, `winners`, `winner_id`) VALUES
(1, 'boneca', 'cancel', '2020-03-06 17:29:08', '2020-03-27 17:25:00', 100, 10, 0, 100, 'loteria', 100, 'fix', 0, 0, 1, '2020-03-06 17:30:39', 1, 30, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lotters_tickets`
--

CREATE TABLE `lotters_tickets` (
  `id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lotters_winners`
--

CREATE TABLE `lotters_winners` (
  `id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `value_win` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `value` float NOT NULL,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`id`, `user_id`, `owner_id`, `invoice_id`, `date`, `value`, `msg`) VALUES
(1, 11, 11, 14, '2020-04-03 16:11:02', 50, 'Hggh'),
(2, 13, 13, 15, '2020-04-03 16:25:50', 40, 'Tome');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `old_value` float NOT NULL,
  `status` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `create_date` datetime NOT NULL,
  `last_edit` datetime NOT NULL,
  `last_editor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `description`, `value`, `old_value`, `status`, `create_date`, `last_edit`, `last_editor`) VALUES
(1, 'PLANO 1', 'PLANO 1 - MÍNIMO DE R$20.00', 100, 0, 'Y', '2018-09-23 01:35:10', '2018-11-30 21:25:00', 1),
(3, 'Master', 'master', 300, 0, 'Y', '2020-02-26 09:51:04', '0000-00-00 00:00:00', 1),
(4, 'Premium', 'Premium ', 500, 0, 'Y', '2020-02-26 09:51:32', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_email` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'contato@felipesites.com',
  `maintenance` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `lock_login` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `lock_register` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `lock_withdrawal` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `lock_payout` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'R$',
  `date_format` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'd/m/Y',
  `date_time_format` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'H:i',
  `money_format` tinyint(4) NOT NULL DEFAULT 1,
  `money_currency_position` tinyint(4) NOT NULL DEFAULT 1,
  `cron_key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `visits` int(11) NOT NULL DEFAULT 0,
  `real_visits` int(11) NOT NULL DEFAULT 0,
  `registers` int(11) NOT NULL DEFAULT 0,
  `real_registers` int(11) NOT NULL DEFAULT 0,
  `bet` int(11) NOT NULL DEFAULT 0,
  `real_bet` int(11) NOT NULL DEFAULT 0,
  `min_withdrawal` int(11) NOT NULL DEFAULT 100,
  `min_recharge` int(11) NOT NULL DEFAULT 0,
  `bitcoin` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `boleto` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `bcash` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `paypal` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `mistermoney` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `transferencia` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `bcash_email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `bcash_token` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '$',
  `transferencia_instrucoes` text COLLATE utf8_unicode_ci NOT NULL,
  `mistermoney_instrucoes` text COLLATE utf8_unicode_ci NOT NULL,
  `bitcoin_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lock_transfer` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `transfer_percent` int(3) NOT NULL,
  `withdrawal_percent` int(3) NOT NULL DEFAULT 0,
  `transfer_min` int(11) NOT NULL DEFAULT 100,
  `dolar` float NOT NULL,
  `bitcoin_notifyemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bitcoin_callbackpass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_daybonus` date NOT NULL,
  `bitcoin_appid` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_email`, `maintenance`, `lock_login`, `lock_register`, `lock_withdrawal`, `lock_payout`, `currency`, `date_format`, `date_time_format`, `money_format`, `money_currency_position`, `cron_key`, `visits`, `real_visits`, `registers`, `real_registers`, `bet`, `real_bet`, `min_withdrawal`, `min_recharge`, `bitcoin`, `boleto`, `bcash`, `paypal`, `mistermoney`, `transferencia`, `bcash_email`, `bcash_token`, `paypal_email`, `paypal_currency`, `transferencia_instrucoes`, `mistermoney_instrucoes`, `bitcoin_token`, `lock_transfer`, `transfer_percent`, `withdrawal_percent`, `transfer_min`, `dolar`, `bitcoin_notifyemail`, `bitcoin_callbackpass`, `last_daybonus`, `bitcoin_appid`) VALUES
(1, 'DEMO SITES', 'admin@estarcash.tech', 'N', 'N', 'N', 'N', 'N', 'R$', 'd/m/y', 'H:i', 3, 1, 'lGomEsrJnICi3rIm08Abl5d3ICVIs5g8', 567, 441, 13, 13, 0, 0, 5, 10, 'Y', 'N', 'N', 'N', 'N', 'N', 'admin@estarcash.tech', '', 'admin@estarcash.tech', 'R$', 'Dados para transferência bancária:\r\n', 'Dados para recebimento via Mister Money:\r\n<br><br>\r\nE-mail: admin@estarcash.tech\r\n<br><br>\r\nApós o envio da transferência anexe o comprovante e aguarde até 48hs para liberação do mesmo.', 'g2rhE4lVbU6OMKAj7PBaSJ', 'N', 10, 2, 10, 4.4, 'admin@estarcash.tech', '48jCHG9PbBIuqUYzDlm6V0iTxL2tO5AS', '2018-12-19', '13598');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `req_points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `name`, `req_points`) VALUES
(1, 'Associado', 0),
(2, 'Bronze', 2000),
(3, 'Prata', 6000),
(4, 'Ouro', 15000),
(5, 'Rubi', 30000),
(6, 'Diamante', 100000),
(7, 'Duplo Diamante', 200000),
(8, 'Triplo Diamante', 400000),
(9, 'Imperador', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `valuefull` float NOT NULL,
  `valuewithdisc` float NOT NULL,
  `valuedisc` float NOT NULL,
  `percentdisc` int(11) NOT NULL,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `id_from`, `id_to`, `date`, `valuefull`, `valuewithdisc`, `valuedisc`, `percentdisc`, `msg`) VALUES
(1, 5, 6, '2020-04-03 16:01:15', 22, 20, 2, 10, 'tome'),
(2, 5, 11, '2020-04-03 16:05:43', 55, 50, 5, 10, 'tome'),
(3, 5, 13, '2020-04-03 16:08:30', 44, 40, 4, 10, 'tome'),
(4, 13, 11, '2020-04-03 16:39:36', 220, 200, 20, 10, 'TESTE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'inactive',
  `banned` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `firstname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('female','male') COLLATE utf8_unicode_ci NOT NULL,
  `address_zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address_street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address_number` int(11) NOT NULL,
  `address_complement` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address_district` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address_city` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address_state` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobilephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  `balance_reserved` float NOT NULL DEFAULT 0,
  `balance_special` float NOT NULL DEFAULT 0,
  `pacpoints` int(11) NOT NULL DEFAULT 500,
  `enroller` int(11) NOT NULL,
  `link` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bank_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_digit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_agency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_agency_digit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_type` enum('corrente','poupanca') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'poupanca',
  `bitcoin_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `token_forgot` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `token_forgot_timestamp` int(11) NOT NULL,
  `avatar` tinyint(3) NOT NULL DEFAULT 1,
  `first_recharge` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `ban_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_buy` datetime DEFAULT NULL,
  `month_validate` datetime DEFAULT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'br',
  `ganhos` float NOT NULL,
  `teto` float NOT NULL,
  `position` set('auto','left','right') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'auto',
  `pleft` int(11) NOT NULL DEFAULT 0,
  `pright` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `banned`, `firstname`, `lastname`, `birthday`, `cpf`, `gender`, `address_zip`, `address_street`, `address_number`, `address_complement`, `address_district`, `address_city`, `address_state`, `phone`, `mobilephone`, `create_date`, `last_activity`, `last_login`, `balance`, `balance_reserved`, `balance_special`, `pacpoints`, `enroller`, `link`, `bank_code`, `bank_account`, `bank_account_digit`, `bank_agency`, `bank_agency_digit`, `bank_account_type`, `bitcoin_address`, `token_forgot`, `token_forgot_timestamp`, `avatar`, `first_recharge`, `ban_description`, `last_buy`, `month_validate`, `country`, `ganhos`, `teto`, `position`, `pleft`, `pright`) VALUES
(1, 'admin@estarcash.tech', 'EH3UKbfFLAwXBs62e+TU1bc+CchRXYEs9TS1R5KOp0ijmq7n3LPlHekEv59oziXqEsIp0hoer5crGiSkWXChpg==', 'active', 'N', 'Elite', 'Scripts', '1990-01-01', '000.000.000-00', 'female', '', '', 0, '', '', '', '', '(81) 9725-7683', '(81) 99725-7683', '2017-01-20 00:00:00', '2020-04-06 12:53:56', '2020-04-06 11:58:19', 25000, 25, 0, 0, 0, '', '0', '0', '0', '0', '0', 'corrente', '@alves', '4603b0412521830a6ea6072e0a9c9db9', 1580342673, 87, 'Y', '', '2020-03-06 10:57:29', '2020-04-06 10:57:29', 'br', 25025, 540, 'auto', 10, 500),
(5, 'wilsonsantosmmn@gmail.com', 'IHfpk34kLfqtL8yXr1IRp+fmxbJMBbpURF+v1QGbA+6R7QtCQLORYhfdgjRXn95dTtbRHqqJfq4ubiH/NPlR9g==', 'active', 'N', 'teste01', 'testando', '1975-01-01', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 14:21:49', '2020-04-03 17:23:01', '2020-04-03 15:25:24', 707.3, 0, 0, 500, 1, 'wilsonsantos', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 14:44:13', '2020-05-03 14:44:13', 'br', 828.3, 1125000, 'auto', 30120, 11100),
(4, 'dolar.agora@gmail.com', 'utXKn+bG44xYaFbivsF+tZjsp7R5I5udmYxzM679WX067agJzbqr+nlP9ZWltTfzJXNrios3JCJKKWeIQTvpDA==', 'active', 'N', 'alves', 'santos', '1985-02-28', '', 'female', '', '', 0, '', '', '', '', '', '', '2020-03-07 09:45:06', '2020-03-07 09:56:45', '2020-03-07 09:45:15', 0, 0, 0, 500, 1, '', '', '', '', '', '', 'poupanca', '', '7bb862a686b99089b23516db3edbee68', 1583589448, 1, 'Y', '', '2020-03-07 09:56:24', '2020-04-07 09:56:24', 'br', 0, 1125, 'auto', 0, 0),
(6, 'paivamelooficial@gmail.com', 'jsNrhXW8WkKXl2a8TGexsngTyhXt9Tj2ZQdeaf7ebGuU4S3k1cOgmA1oqdfJmherOR2tLbabyJwbip2z8L+vgg==', 'active', 'N', 'Teste02', 'Testando', '87126-11-07', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 14:45:42', '2020-04-03 16:04:24', '2020-04-03 16:04:05', 1020, 0, 0, 500, 5, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 14:58:28', '2020-05-03 14:58:28', 'ar', 1000, 67.5, 'right', 25050, 5040),
(7, 'edsonmouramkt@gmail.com', 'zvGylnkZyYDaP7wf8eZXUZM9QKk6Qyiukqu9Rz6GeZpgRvYYjCIV/EDUIRDE0IX6OtFqNu0OrCHLw55RKjhE0w==', 'active', 'N', 'Teste03', 'testando', '1980-10-01', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:02:39', '2020-04-03 15:48:55', '2020-04-03 15:25:50', 500, 0, 0, 500, 5, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 15:05:22', '2020-05-03 15:05:22', 'br', 500, 225, 'auto', 10000, 1000),
(8, 'gilbertogomes_adv@hotmail.com', '0gpDwRkc7mVDX48ueek2736O+nvF01aYTZ2RVHvX3HNQDjZliYncC4uMZsYJoB8UJDEv2CzJLfn9gsHFiIhGoQ==', 'active', 'N', 'Gilberto', 'Gomes', '62348-10-23', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:15:14', '2020-04-03 15:48:42', '2020-04-03 15:48:10', 252.5, 0, 0, 500, 6, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 15:19:19', '2020-05-03 15:19:19', 'br', 252.5, 45000, 'right', 4000, 1050),
(9, 'ggomes57@hotmail.com', 'Rc436df27pFxsUcsvR3NLoeLdRfDmd3vcEorzWHtJb47YiVZ1LmsBQWMNNh4Ev20qoNks4T88m13IuhgKkvbPA==', 'active', 'N', 'Gilbertinho ', 'O cara', '7590-09-10', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:44:30', '2020-04-03 15:46:20', '2020-04-03 15:46:00', 0, 0, 0, 500, 8, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 15:46:39', '2020-05-03 15:46:39', 'br', 0, 9000, 'auto', 0, 0),
(10, 'edsonherbalifenascimento@gmail.com', 'dWmbwO8X5porPYzorPqezwQ/Vd5GZd+P+Ziyg8GmlRWzgNobZ5SzlWI/RXFDCI6IcBBczTFmXC5HfqeDHFBMYQ==', 'active', 'N', 'Teste04', 'Testando', '87126-11-07', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:50:21', '2020-04-03 15:52:17', '2020-04-03 15:50:37', 0, 0, 0, 500, 7, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 15:51:46', '2020-05-03 15:51:46', 'au', 0, 22500, 'right', 0, 0),
(11, 'ggomes5757@hotmail.com', 'qdAwNaL9anTfqE47E95Az0AqcspywmCSFcWSuEPr+dWRJemuBPnewWQ2QtaDADiwQjM5fxIYtxIdIjcq937pmw==', 'active', 'N', 'Gilbertinho ', 'O gostoso', '29658-03-28', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:50:26', '2020-04-03 16:40:28', '2020-04-03 15:50:43', 200, 0, 0, 500, 8, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 16:11:02', '2020-05-03 16:11:02', 'br', 0, 2362.5, 'auto', 0, 0),
(12, 'luizamkt@gmail.com', 'tgtPSOF0/lnlCgKp0FiDpifs8oK56g1KNyoPafWx7c4kX0moU9NNFXdtEmeAQ7v6UVaJJc6qmWm0bUUihoQPhg==', 'active', 'N', 'Teste', 'Testando', '87126-11-07', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 15:54:48', '2020-04-03 15:59:47', '2020-04-03 15:55:06', 0, 0, 0, 500, 7, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 15:56:16', '2020-05-03 15:56:16', 'ar', 0, 2250, 'auto', 0, 0),
(13, 'lopesrodrigo053@gmail.com', 'zNC2VefnixeWxAyGcWO4rZBGqAFk1Zs8fhnYhlagv9gfHASG+kfKdT+qLi8euOBIDAxSzQJ37HBO+BsA4WOhbw==', 'active', 'N', 'Teste05', 'Testando', '87126-11-07', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 16:06:39', '2020-04-03 16:39:36', '2020-04-03 16:33:43', 30, 0, 0, 500, 6, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 16:25:50', '2020-05-03 16:25:50', 'ar', 250, 90, 'auto', 5000, 0),
(14, 'tcm.marcos@gmail.com', '6L7L+JMbThDWn/fFwpk8VdlUFRgRB6NqPV/muTsQoFFLWwX7K3lRO0V20jzm7YRolP0teLjc7/kR+ZE86rb7WA==', 'active', 'N', 'fulano de tal', 'da silva', '1998-10-01', '', 'male', '', '', 0, '', '', '', '', '', '', '2020-04-03 16:31:30', '2020-04-03 17:06:04', '2020-04-03 16:31:43', 0, 0, 0, 500, 13, '', '', '', '', '', '', 'poupanca', '', '', 0, 1, 'Y', '', '2020-04-03 16:35:36', '2020-05-03 16:35:36', 'br', 0, 11250, 'auto', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `value` float NOT NULL,
  `tax` float NOT NULL,
  `status` enum('open','paid','chargeback','cancel') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `last_update` datetime NOT NULL,
  `payment_date` datetime NOT NULL,
  `bank_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `bank_agency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_type` enum('corrente','poupanca') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'poupanca',
  `bitcoin_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gateway` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `withdrawal_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` datetime NOT NULL,
  `last_editor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `date`, `value`, `tax`, `status`, `last_update`, `payment_date`, `bank_code`, `bank_agency`, `bank_account`, `bank_account_type`, `bitcoin_address`, `email`, `gateway`, `withdrawal_description`, `last_edit`, `last_editor`) VALUES
(1, 1, '2020-03-31 00:54:19', 24.5, 0.5, 'open', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0 - 0', '0 - 0', 'corrente', '@alves', '', 'bitcoin', '', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avataravaibles`
--
ALTER TABLE `avataravaibles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binarytrees`
--
ALTER TABLE `binarytrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comprovants`
--
ALTER TABLE `comprovants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `extracts`
--
ALTER TABLE `extracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lotters`
--
ALTER TABLE `lotters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lotters_tickets`
--
ALTER TABLE `lotters_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lottery_id` (`lottery_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lotters_winners`
--
ALTER TABLE `lotters_winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avataravaibles`
--
ALTER TABLE `avataravaibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `binarytrees`
--
ALTER TABLE `binarytrees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comprovants`
--
ALTER TABLE `comprovants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extracts`
--
ALTER TABLE `extracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invoices_items`
--
ALTER TABLE `invoices_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lotters`
--
ALTER TABLE `lotters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lotters_tickets`
--
ALTER TABLE `lotters_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lotters_winners`
--
ALTER TABLE `lotters_winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
