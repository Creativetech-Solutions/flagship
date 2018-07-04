/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cocoa_gnd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoa_gnd` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cocoa_gnd`;

/*Table structure for table `fll_payment_type` */

DROP TABLE IF EXISTS `fll_payment_type`;

CREATE TABLE `fll_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fll_payment_type` */

insert  into `fll_payment_type`(`id`,`payment_type`) values 
(1,'Payment Received – Credit Card'),
(2,'Payment Received – Cash'),
(3,'To Be Invoiced');

/*Table structure for table `gnd_activity` */

DROP TABLE IF EXISTS `gnd_activity`;

CREATE TABLE `gnd_activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(255) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_activity` */

/*Table structure for table `gnd_arrivals` */

DROP TABLE IF EXISTS `gnd_arrivals`;

CREATE TABLE `gnd_arrivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(12) NOT NULL,
  `arr_date` date NOT NULL,
  `arr_time` time NOT NULL,
  `arr_flight_no` varchar(255) NOT NULL,
  `flight_class` varchar(255) NOT NULL,
  `arr_transport` varchar(255) NOT NULL,
  `arr_driver` varchar(255) NOT NULL,
  `arr_vehicle` varchar(255) NOT NULL,
  `arr_pickup` varchar(255) NOT NULL,
  `arr_dropoff` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `rep_type` varchar(255) NOT NULL,
  `client_reqs` varchar(255) NOT NULL,
  `arr_transport_notes` varchar(255) NOT NULL,
  `arr_hotel_notes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_arrivals` */

/*Table structure for table `gnd_bugs` */

DROP TABLE IF EXISTS `gnd_bugs`;

CREATE TABLE `gnd_bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_bugs` */

/*Table structure for table `gnd_departures` */

DROP TABLE IF EXISTS `gnd_departures`;

CREATE TABLE `gnd_departures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(12) NOT NULL,
  `dpt_date` date NOT NULL,
  `dpt_time` time NOT NULL,
  `dpt_flight_no` varchar(255) NOT NULL,
  `dpt_transport` varchar(255) NOT NULL,
  `dpt_driver` varchar(255) NOT NULL,
  `dpt_vehicle` varchar(255) NOT NULL,
  `dpt_pickup` varchar(255) NOT NULL,
  `dpt_dropoff` varchar(255) NOT NULL,
  `dpt_pickup_time` time NOT NULL,
  `dpt_notes` varchar(255) NOT NULL,
  `dpt_transport_notes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_departures` */

/*Table structure for table `gnd_flightclass` */

DROP TABLE IF EXISTS `gnd_flightclass`;

CREATE TABLE `gnd_flightclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_flightclass` */

insert  into `gnd_flightclass`(`id`,`class`) values 
(9,'World Traveller Plus'),
(10,'World Traveler'),
(11,'Economy'),
(12,'Premium Economy'),
(13,'Upper Class'),
(14,'Business Class'),
(15,'Club Class'),
(16,'First Class');

/*Table structure for table `gnd_flights` */

DROP TABLE IF EXISTS `gnd_flights`;

CREATE TABLE `gnd_flights` (
  `id_flight` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_flights` */

insert  into `gnd_flights`(`id_flight`,`flight_number`) values 
(88,'AA1546'),
(89,'AA982'),
(90,'DL725'),
(91,'DL796'),
(92,'B6949'),
(93,'B6950'),
(94,'AC1786'),
(95,'AC1787'),
(96,'DE2254'),
(97,'BW438'),
(98,'BW439'),
(99,'BW441'),
(100,'BW440'),
(101,'BA2159'),
(102,'BA2158'),
(103,'VS89'),
(104,'VS90'),
(105,'LI727'),
(106,'LI772'),
(107,'LI523'),
(108,'LI523'),
(109,'SVG190'),
(110,'07:45');

/*Table structure for table `gnd_flighttime` */

DROP TABLE IF EXISTS `gnd_flighttime`;

CREATE TABLE `gnd_flighttime` (
  `id_fltime` int(11) NOT NULL AUTO_INCREMENT,
  `id_flight` int(11) NOT NULL,
  `flight_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fltime`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_flighttime` */

insert  into `gnd_flighttime`(`id_fltime`,`id_flight`,`flight_time`) values 
(92,62,'20:35'),
(93,63,'8:25'),
(94,64,'17:20'),
(95,65,'11:55'),
(96,65,'12:20'),
(97,66,'13:05'),
(98,66,'13:30'),
(99,67,'9:20'),
(100,67,'16:45'),
(101,68,'9:20'),
(102,68,'9:50'),
(103,69,'14:55'),
(104,70,'7:10'),
(105,71,'19:45'),
(106,72,'16:55'),
(107,73,'15:30'),
(108,73,'18:50'),
(109,75,'18:20'),
(111,77,'20:15'),
(112,78,'6:40'),
(113,78,'8:00'),
(114,79,'20:30'),
(115,79,'7:45'),
(116,80,'13:30'),
(117,80,'18:20'),
(118,81,'12:35'),
(119,81,'14:35'),
(120,82,'15:35'),
(121,83,'17:00'),
(122,84,'6:10'),
(123,84,'7:30'),
(124,85,'20:00'),
(125,85,'21:00'),
(126,86,'19:20'),
(127,86,'20:00'),
(128,74,'7:40'),
(129,88,'14:23'),
(130,89,'15:13'),
(131,90,'14:28'),
(132,91,'15:29'),
(133,92,'12:11'),
(134,93,'13:11'),
(135,93,'14:11'),
(136,94,'16:55'),
(137,95,'17:50'),
(138,94,'13:00'),
(139,95,'14:00'),
(140,96,'15:05'),
(141,96,'16:10'),
(142,97,'21:45'),
(143,98,'06:00'),
(144,99,'09:00'),
(145,100,'08:30'),
(146,101,'15:15'),
(147,102,'17:05'),
(148,103,'15:40'),
(149,104,'17:40'),
(150,105,'13:30'),
(151,105,'13:55'),
(152,106,'12:50'),
(153,106,'12:25'),
(154,107,'21:10'),
(155,107,'21:35'),
(156,108,'21:55'),
(157,108,'10:20'),
(158,109,'09:00');

/*Table structure for table `gnd_fsft_touroperator` */

DROP TABLE IF EXISTS `gnd_fsft_touroperator`;

CREATE TABLE `gnd_fsft_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `gnd_fsft_touroperator` */

/*Table structure for table `gnd_guest` */

DROP TABLE IF EXISTS `gnd_guest`;

CREATE TABLE `gnd_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(255) NOT NULL,
  `ref_no_sys` varchar(12) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `adult` int(11) NOT NULL,
  `child_age` int(11) NOT NULL,
  `infant_age` int(11) NOT NULL,
  `pnr` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Guest table';

/*Data for the table `gnd_guest` */

/*Table structure for table `gnd_loc_coast` */

DROP TABLE IF EXISTS `gnd_loc_coast`;

CREATE TABLE `gnd_loc_coast` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `coast` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_loc_coast` */

insert  into `gnd_loc_coast`(`id`,`coast`) values 
(1,'Pt Salines'),
(2,'True Blue'),
(3,'Grand Anse'),
(4,'Morne Rouge'),
(5,'St George’s'),
(6,'St. David’s'),
(7,'Sauteurs'),
(8,'Mt. Egmont');

/*Table structure for table `gnd_location` */

DROP TABLE IF EXISTS `gnd_location`;

CREATE TABLE `gnd_location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone` int(4) NOT NULL DEFAULT '0',
  `loc_code` varchar(6) NOT NULL DEFAULT '000',
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_location` */

insert  into `gnd_location`(`id_location`,`name`,`zone`,`loc_code`) values 
(1,'Petite Anse',7,'001'),
(2,'Radisson Grenada Beach Resort',3,'002'),
(3,'The Coyaba Beach Resort',3,'003'),
(4,'The Spice Island Beach Resort',3,'004'),
(5,'The Blue Horizons Garden Resort',3,'005'),
(6,'Mt. Cinnamon',3,'006'),
(7,'Kalinago Beach Resort',4,'007'),
(8,'La Luna',4,'008'),
(9,'True Blue Bay Resort',2,'009'),
(10,'The Grenadian by Rex Resorts',1,'010'),
(11,'Maca Bana Villas',1,'011'),
(12,'Sandals La Source',1,'012'),
(13,'The Calabash Hotel',3,'013'),
(14,'Le Phare Bleu',8,'014');

/*Table structure for table `gnd_reps` */

DROP TABLE IF EXISTS `gnd_reps`;

CREATE TABLE `gnd_reps` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_reps` */

insert  into `gnd_reps`(`id_rep`,`name`) values 
(1,'Winston Bowen'),
(2,'Janelle James'),
(3,'Andrea Felix'),
(4,'Chelsea Martin'),
(5,'Katisha Collins');

/*Table structure for table `gnd_resdrivers` */

DROP TABLE IF EXISTS `gnd_resdrivers`;

CREATE TABLE `gnd_resdrivers` (
  `id_driver` int(11) NOT NULL AUTO_INCREMENT,
  `transport` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `ref_no_sys` varchar(12) NOT NULL,
  `adult` int(11) NOT NULL DEFAULT '0',
  `child` int(11) NOT NULL DEFAULT '0',
  `infant` int(11) NOT NULL DEFAULT '0',
  `tour_operator` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `pickup_time` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `rate` varchar(3) NOT NULL DEFAULT '25%',
  `flight_time` varchar(255) NOT NULL,
  `flight_no` varchar(255) NOT NULL,
  `infant_seats` int(11) NOT NULL DEFAULT '0',
  `child_seats` int(11) NOT NULL DEFAULT '0',
  `booster_seats` int(11) NOT NULL DEFAULT '0',
  `title_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `transport_date` varchar(255) NOT NULL,
  `res_type` int(11) NOT NULL,
  PRIMARY KEY (`id_driver`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_resdrivers` */

/*Table structure for table `gnd_reservations` */

DROP TABLE IF EXISTS `gnd_reservations`;

CREATE TABLE `gnd_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pnr` varchar(255) NOT NULL,
  `tour_operator` varchar(255) NOT NULL,
  `operator_code` varchar(255) NOT NULL,
  `tour_ref_no` varchar(255) NOT NULL,
  `adult` int(1) NOT NULL DEFAULT '0',
  `child` int(11) DEFAULT NULL,
  `infant` int(11) DEFAULT NULL,
  `tour_notes` varchar(255) NOT NULL,
  `fast_track` int(1) NOT NULL DEFAULT '0',
  `affiliates` varchar(255) NOT NULL,
  `arr_date` date NOT NULL,
  `arr_time` varchar(255) NOT NULL,
  `arr_flight_no` varchar(255) NOT NULL,
  `flight_class` varchar(255) NOT NULL,
  `arr_transport` varchar(255) NOT NULL,
  `arr_driver` varchar(255) NOT NULL,
  `arr_vehicle` varchar(255) NOT NULL,
  `arr_pickup` varchar(255) NOT NULL,
  `arr_dropoff` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `rep_type` varchar(255) NOT NULL,
  `client_reqs` varchar(255) NOT NULL,
  `dpt_date` date NOT NULL,
  `dpt_time` varchar(255) NOT NULL,
  `dpt_flight_no` varchar(255) NOT NULL,
  `dpt_transport` varchar(255) NOT NULL,
  `dpt_driver` varchar(255) NOT NULL,
  `dpt_vehicle` varchar(255) NOT NULL,
  `dpt_pickup` varchar(255) NOT NULL,
  `dpt_dropoff` varchar(255) NOT NULL,
  `dpt_pickup_time` varchar(255) NOT NULL,
  `dpt_notes` varchar(255) NOT NULL,
  `creation_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `modified_date` varchar(255) NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `ref_no_sys` varchar(12) NOT NULL,
  `assigned` int(11) NOT NULL DEFAULT '0',
  `rep` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `arr_transport_notes` varchar(255) NOT NULL,
  `dpt_transport_notes` varchar(255) NOT NULL,
  `arr_hotel_notes` varchar(255) NOT NULL,
  `ftnotify` int(11) NOT NULL DEFAULT '0',
  `infant_seats` int(11) NOT NULL,
  `child_seats` int(11) NOT NULL,
  `booster_seats` int(11) NOT NULL,
  `vouchers` int(11) NOT NULL,
  `assignment` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gnd_reservations` */

/*Table structure for table `gnd_room_loc` */

DROP TABLE IF EXISTS `gnd_room_loc`;

CREATE TABLE `gnd_room_loc` (
  `id_room_loc` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `id_roomtype` int(11) NOT NULL,
  PRIMARY KEY (`id_room_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_room_loc` */

insert  into `gnd_room_loc`(`id_room_loc`,`id_location`,`id_roomtype`) values 
(1,71,181),
(2,71,182),
(3,71,183),
(4,71,184),
(5,71,185),
(6,71,186),
(7,71,187),
(8,71,188),
(9,71,189),
(10,71,190),
(11,71,191),
(12,71,192),
(13,71,193),
(14,71,194),
(15,71,195),
(16,71,196),
(17,71,197),
(18,71,198),
(19,71,199),
(20,72,200),
(21,72,201),
(22,72,202),
(23,72,203),
(24,72,204),
(25,72,205),
(26,72,206),
(27,73,207),
(28,73,208),
(29,73,209),
(30,73,210),
(31,73,211),
(32,73,212),
(33,74,213),
(34,74,214),
(35,74,215),
(36,74,216),
(37,74,217),
(38,74,218),
(39,74,219),
(40,74,220),
(41,75,221),
(42,75,222),
(43,75,223),
(44,75,224),
(45,75,225),
(46,75,226),
(47,75,227),
(48,75,228),
(49,75,229),
(50,75,230),
(51,76,231),
(52,76,232),
(53,76,233),
(54,76,234),
(55,78,235),
(56,78,236),
(57,78,237),
(58,78,238),
(59,78,239),
(60,78,240),
(61,78,241),
(62,78,242),
(63,79,243),
(64,79,244),
(65,79,245),
(66,79,246),
(67,79,247),
(68,79,248),
(69,80,249),
(70,80,250),
(71,80,251),
(72,80,252),
(73,80,253),
(74,80,254),
(75,81,255),
(76,81,256),
(77,81,257),
(78,81,258),
(79,81,259),
(80,1,260),
(81,1,261),
(82,1,262),
(83,2,263),
(84,2,232),
(85,2,265),
(86,2,266),
(87,3,267),
(88,3,268),
(89,4,269),
(90,4,270),
(91,4,271),
(92,4,272),
(93,4,273),
(94,4,274),
(95,5,275),
(96,5,276),
(97,5,277),
(98,5,278),
(99,5,279),
(100,5,280),
(101,6,281),
(102,6,282),
(103,6,283),
(104,6,284),
(105,6,285),
(106,6,286),
(107,7,287),
(108,7,288),
(109,7,289),
(110,7,290),
(111,8,291),
(112,8,292),
(113,8,293),
(114,8,294),
(115,8,295),
(116,9,296),
(117,9,297),
(118,9,298),
(119,9,299),
(120,9,300),
(121,9,301),
(122,9,302),
(123,10,303),
(124,10,304),
(125,10,232),
(126,10,306),
(127,10,307),
(128,10,308),
(129,11,309),
(130,11,310),
(131,11,311),
(132,11,312),
(133,11,313),
(134,11,314),
(135,11,315),
(136,12,316),
(137,12,317),
(138,12,318),
(139,12,319),
(140,12,320),
(141,12,321),
(142,12,322),
(143,12,323),
(144,12,324),
(145,12,325),
(146,12,326),
(147,12,327),
(148,12,328),
(149,12,329),
(150,12,330),
(151,12,331),
(152,12,332),
(153,12,333),
(154,12,334),
(155,12,335),
(156,13,221),
(157,13,337),
(158,13,338),
(159,13,339),
(160,13,340),
(161,13,341),
(162,13,342),
(163,13,343),
(164,13,344),
(165,13,345),
(166,14,346),
(167,14,347),
(168,14,348),
(169,14,349),
(170,14,350),
(171,14,351),
(172,14,352);

/*Table structure for table `gnd_roomtypes` */

DROP TABLE IF EXISTS `gnd_roomtypes`;

CREATE TABLE `gnd_roomtypes` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_roomtypes` */

insert  into `gnd_roomtypes`(`id_room`,`id_location`,`room_type`) values 
(221,75,'Junior Suite'),
(232,76,'Beachfront room'),
(260,0,'Beachfront Cottage'),
(261,0,'OceanView Cottage'),
(262,0,'Grenadine Room'),
(263,0,'Garden View Room'),
(264,0,'Beachfront Room'),
(265,0,'Executive Beachfront Room'),
(266,0,'Executive Beachfront Suite'),
(267,0,'Garden/Pool View Room'),
(268,0,'OceanView room'),
(269,0,'One bedroom Cinnamon/Saffron Suite'),
(270,0,'Royal Collection Pool Suite'),
(271,0,'Luxury Almond Pool Suite'),
(272,0,'Anthurium Pool Suite'),
(273,0,'Seagrape Beach Suite'),
(274,0,'Oleander Superior/ Garden Suite'),
(275,0,'Palm Deluxe Suite'),
(276,0,'Superior Studio'),
(277,0,'Oleander Deluxe Suire'),
(278,0,'Mango Deluxe Suite'),
(279,0,'Evergreen Cottage Deluxe Suite'),
(280,0,'Almond Deluxe Suite'),
(281,0,'Luxury One Bedroom Hacienda Suite'),
(282,0,'One bedroom Villa'),
(283,0,'Two bedroom Garden Suite'),
(284,0,'Two bedroom Villa'),
(285,0,'Three bedroom Villa'),
(286,0,'Cinnamon Heights'),
(287,0,'OceanView Double'),
(288,0,'OceanView Superior Queen'),
(289,0,'OceanView Superior Double'),
(290,0,'OceanView Deluxe'),
(291,0,'Beach Cottage Deluxe'),
(292,0,'Deluxe Cottage'),
(293,0,'Cottage Suite'),
(294,0,'Indigo Villa'),
(295,0,'Seascape Villa'),
(296,0,'Tree Top Room'),
(297,0,'Indigo Rooms'),
(298,0,'Bay View Room'),
(299,0,'Waterfront Suite'),
(300,0,'Tower Suite'),
(301,0,'Villas'),
(302,0,'Honeymoon Suite'),
(303,0,'Seaview Room'),
(304,0,'Hillside'),
(305,0,'Beachfront Room'),
(306,0,'Executive Suite - Premier Room'),
(307,0,'Executive Suite - Premier Suite'),
(308,0,'Deluxe Suite'),
(309,0,'Paw Paw'),
(310,0,'Rock Fig'),
(311,0,'Cherry'),
(312,0,'Avocado'),
(313,0,'Mango'),
(314,0,'Pineapple'),
(315,0,'Coconut'),
(316,0,'Italian Oceanview PH  (PSKY)'),
(317,0,'Italian Oceanview 1 Br (1SKY)'),
(318,0,'South Seas One Bedroom Butler Suite  (M1P)'),
(319,0,'South Seas Grande Rondoval Butler Suite   (RD)'),
(320,0,'South Seas Honeymoon One Bedroom Butler Suite  (1PB)'),
(321,0,'Italian Swim up Bi-level 1 Br. Butler Suite (S1B)'),
(322,0,'Italian Bi-Level 1 Br. Butler Suite   (OB1B)'),
(323,0,'Pink Gin Beachfront Honeymoon Club   (BS)'),
(324,0,'Pink Gin Beachfront Walkout Club Level  (WB)'),
(325,0,'Pink Gin Oceanfront Honeymoon Penthouse (HPO)'),
(326,0,'Pink Gin Oceanview Club Level Suite - (OS)'),
(327,0,'Pink Gin Beachfront Room - (BR) '),
(328,0,'Pink Gin Oceanview Room - (PO)'),
(329,0,'Pink Gin Hideaway Room  (OV)'),
(330,0,'South Seas Waterfall River Pool Walkout Junior Suite   (WWJS)'),
(331,0,'South Seas Hideaway Walkout Junior Suite  (WJS)'),
(332,0,'South Seas Waterfall River Pool Junior Suite  (WFJS)'),
(333,0,'South Seas Hideaway Junior Suite  (JS)'),
(334,0,'Pink Gin Grande Luxe - LO'),
(335,0,'South Seas Premium Room   (PR)'),
(336,0,'Junior Suite'),
(337,0,'One Bedroom Westside Suite'),
(338,0,'One Bedroom Superior Suite'),
(339,0,'One Bedroom Pool Suite'),
(340,0,'Thorneycroft Suite'),
(341,0,'CariBali Villa'),
(342,0,'Hummingbird Villa'),
(343,0,'The Pool House Villa'),
(344,0,'Treefrog Villa'),
(345,0,'Swallow Villa'),
(346,0,'Ground Floor Apartment'),
(347,0,'Upper Floor Apartment'),
(348,0,'One-bedroom Garden Villa'),
(349,0,'Two-bedroom Garden Villa'),
(350,0,'One-bedroom Seafront Villa'),
(351,0,'Two-bedroom Seafront Villa'),
(352,0,'Luxury Serenity Villa');

/*Table structure for table `gnd_touroperator` */

DROP TABLE IF EXISTS `gnd_touroperator`;

CREATE TABLE `gnd_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `gnd_touroperator` */

insert  into `gnd_touroperator`(`id`,`tour_operator`) values 
(1,'Air Canada Vacations'),
(2,'Audley Travel'),
(3,'Azure'),
(4,'BA Holidays'),
(5,'Caribtours'),
(6,'Carrier'),
(7,'City Discovery '),
(8,'Classic Vacations'),
(9,'Cox & Kings'),
(10,'Destinology'),
(13,'Europ Assistance'),
(14,'Expedia'),
(17,'Hays'),
(18,'Holiday Services'),
(19,'Holiday Taxis'),
(20,'Hotelbeds'),
(24,'JetBlue'),
(25,'Just Resorts'),
(27,'Kuoni Switzerland (SunTours)'),
(29,'Kuoni France'),
(31,'Kuoni Netherlands (now Tenzing Travel)'),
(32,'La Fabbrica'),
(34,'Lusso'),
(37,'MLT Vacations'),
(39,'Pleasant  Holidays'),
(40,'Press Tours Spa'),
(41,'Prestbury WorldWide'),
(42,'Q Holidays'),
(43,'Scott Dunn'),
(44,'Simply Caribbean Lux Holidays'),
(45,'Six Star Holidays'),
(47,'Suntransfers'),
(54,'Team America'),
(55,'Holiday Place'),
(58,'Trailfinders'),
(59,'Transfers 4 Travel'),
(60,'Travel Counsellors'),
(62,'Tropic Breeze'),
(63,'Turquoise Holidays'),
(64,'Viator'),
(71,'Wilderness Explorers'),
(72,'Agaxtur'),
(73,'Best Tours Italia'),
(74,'Caribbean Destinations'),
(75,'Caribbean Winds'),
(76,'Caribbean World (Berg & Meer, Tropical Tours)'),
(77,'Collett\'s Travel'),
(78,'Dnata - Gold Medal & Stella Travel Services'),
(79,'Eco Travel'),
(80,'Escapade Caribbean'),
(81,'Intimate Caribbean Holidays'),
(82,'ITC Luxury Travel'),
(83,'Kuoni UK'),
(84,'Kuoni USA'),
(85,'Luxury Holidays To & Value Added Travel'),
(86,'MotMot Travel'),
(87,'Pink Pearl'),
(88,'Simpson Travel'),
(89,'Southall Travel Ltd  - The Holiday Team - Away Holidays - Apple House Travel'),
(90,'Sublime Travel'),
(91,'Sunset Travel (Sunset Faraway Holidays)'),
(92,'The Mark Travel Corporation / Funway'),
(93,'Thomas Cook AG'),
(94,'Thomas Cook Signature '),
(95,'Tots Too'),
(96,'Vtours GMBH'),
(97,'W&O (Western & Oriental: Key 2 Holidays & Tropical Locations, Wando Travel)'),
(98,'We Travel2/Topflight'),
(99,'Weddings in Paradise');

/*Table structure for table `gnd_transport` */

DROP TABLE IF EXISTS `gnd_transport`;

CREATE TABLE `gnd_transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transport`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_transport` */

insert  into `gnd_transport`(`id_transport`,`name`) values 
(1,'Terrance Louison'),
(2,'Ralph Alexander'),
(3,'Celestine Morian'),
(4,'Augustine Morian'),
(5,'Patrick Thomas'),
(6,'Henrys Safari Tours '),
(8,'Michael Scott'),
(9,'Selwyn Coutain'),
(10,'Carl David'),
(11,'Chris Buckmire'),
(12,'Dave Thomas'),
(13,'Denis Neptune'),
(14,'Desmond Dumont'),
(15,'Elwin James'),
(16,'Kalvin Baker'),
(17,'Ruben Japal'),
(18,'Ryan Hopkin');

/*Table structure for table `gnd_vehicles` */

DROP TABLE IF EXISTS `gnd_vehicles`;

CREATE TABLE `gnd_vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `id_transport` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_vehicles` */

insert  into `gnd_vehicles`(`id_vehicle`,`id_transport`,`name`) values 
(14,4,'HAB790'),
(15,10,'HAE153'),
(16,3,'HAM111'),
(17,11,'HAL199'),
(18,12,'HAE311'),
(19,13,'HAK867'),
(20,14,'HU308'),
(21,15,'HAC686'),
(22,6,'HAF425'),
(23,6,'HB942'),
(24,6,'HAD940'),
(25,6,'HO625'),
(26,6,'HN365'),
(27,16,'HAE622'),
(28,8,'HAD133'),
(29,5,'HAJ359'),
(30,2,'HZ822'),
(31,17,'HN589'),
(32,18,'PB55'),
(33,9,'H5035'),
(34,1,'HAD573');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
