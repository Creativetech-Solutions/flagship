/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cocoa_anu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoa_anu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cocoa_anu`;

/*Table structure for table `anu_activity` */

DROP TABLE IF EXISTS `anu_activity`;

CREATE TABLE `anu_activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(255) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `anu_activity` */

/*Table structure for table `anu_arrivals` */

DROP TABLE IF EXISTS `anu_arrivals`;

CREATE TABLE `anu_arrivals` (
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

/*Data for the table `anu_arrivals` */

/*Table structure for table `anu_bugs` */

DROP TABLE IF EXISTS `anu_bugs`;

CREATE TABLE `anu_bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `anu_bugs` */

/*Table structure for table `anu_departures` */

DROP TABLE IF EXISTS `anu_departures`;

CREATE TABLE `anu_departures` (
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

/*Data for the table `anu_departures` */

/*Table structure for table `anu_flightclass` */

DROP TABLE IF EXISTS `anu_flightclass`;

CREATE TABLE `anu_flightclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `anu_flightclass` */

insert  into `anu_flightclass`(`id`,`class`) values 
(9,'World Traveller Plus	'),
(10,'World Traveler	'),
(11,'Economy	'),
(12,'Premium Economy	'),
(13,'Upper Class	'),
(14,'Business Class	'),
(15,'Club Class	'),
(16,'First Class');

/*Table structure for table `anu_flights` */

DROP TABLE IF EXISTS `anu_flights`;

CREATE TABLE `anu_flights` (
  `id_flight` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `anu_flights` */

insert  into `anu_flights`(`id_flight`,`flight_number`) values 
(1,'AA2405'),
(2,'AA978'),
(3,'AC960'),
(4,'AC961'),
(5,'BA2156'),
(6,'BA2157'),
(7,'BA2256'),
(8,'BW458'),
(9,'BW459'),
(10,'DL652'),
(11,'DL653'),
(12,'LI309'),
(13,'LI310'),
(14,'LI312'),
(15,'LI331'),
(16,'LI362'),
(17,'LI508'),
(18,'LI512'),
(19,'LI550'),
(20,'LI771'),
(21,'UA1409'),
(22,'UA1414'),
(23,'US863'),
(25,'VS33'),
(26,'VS34'),
(27,'VS87'),
(28,'VS88'),
(29,'WJ2738'),
(30,'WJ2739'),
(31,'MT 2854'),
(32,'US864');

/*Table structure for table `anu_flighttime` */

DROP TABLE IF EXISTS `anu_flighttime`;

CREATE TABLE `anu_flighttime` (
  `id_fltime` int(11) NOT NULL AUTO_INCREMENT,
  `id_flight` int(11) NOT NULL,
  `flight_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fltime`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

/*Data for the table `anu_flighttime` */

insert  into `anu_flighttime`(`id_fltime`,`id_flight`,`flight_time`) values 
(45,24,'15:05'),
(71,1,'13:12'),
(72,1,'14:06'),
(73,1,'14:15'),
(74,1,'15:01'),
(75,2,'11:14'),
(76,2,'16:13'),
(77,2,'12:10'),
(78,2,'17:10'),
(79,3,'13:00'),
(80,3,'15:10'),
(81,4,'14:00'),
(82,4,'16:05'),
(83,5,'19:00'),
(84,5,'20:40'),
(85,5,'19:35'),
(86,5,'21:15'),
(87,5,'20:30'),
(88,5,'20:25'),
(89,5,'20:10'),
(90,5,'21:35'),
(91,5,'21:10'),
(92,6,'14:10'),
(93,6,'15:05'),
(94,6,'15:10'),
(95,6,'16:05'),
(96,7,'19:35'),
(97,7,'18:55'),
(98,7,'19:40'),
(99,7,'20:05'),
(100,7,'17:40'),
(101,7,'17:35'),
(102,7,'20:45'),
(103,7,'17:45'),
(104,7,'20:50'),
(105,7,'18:45'),
(106,7,'20:45'),
(107,7,'19:55'),
(108,7,'18:50'),
(109,7,'18:35'),
(110,7,'21:40'),
(111,7,'19:45'),
(112,8,'10:35'),
(113,8,'21:10'),
(114,8,'11:20'),
(115,8,'21:55'),
(116,9,'17:45'),
(117,9,'17:35'),
(118,9,'18:30'),
(119,9,'18:25'),
(120,10,'15:07'),
(121,10,'14:56'),
(122,11,'14:07'),
(123,11,'15:57'),
(124,12,'17:20'),
(125,12,'18:25'),
(126,13,'10:25'),
(127,13,'08:30'),
(128,13,'10:15'),
(129,14,'10:35'),
(130,15,'10:00'),
(131,15,'12:05'),
(132,16,'10:15'),
(133,16,'13:25'),
(134,17,'17:45'),
(135,18,'19:30'),
(136,19,'10:35'),
(137,20,'05:30'),
(138,21,'13:36'),
(139,21,'14:22'),
(140,21,'13:55'),
(141,21,'15:13'),
(142,22,'12:46'),
(143,22,'14:22'),
(144,22,'13:00'),
(145,22,'15:22'),
(146,23,'15:31'),
(147,32,'16:30'),
(148,25,'13:45'),
(149,25,'16:00'),
(150,26,'16:45'),
(151,26,'18:15'),
(152,27,'14:55'),
(153,28,'16:55'),
(154,29,'14:08'),
(155,30,'15:05'),
(157,31,'16:25'),
(158,31,'17:25');

/*Table structure for table `anu_fsft_touroperator` */

DROP TABLE IF EXISTS `anu_fsft_touroperator`;

CREATE TABLE `anu_fsft_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `anu_fsft_touroperator` */

/*Table structure for table `anu_guest` */

DROP TABLE IF EXISTS `anu_guest`;

CREATE TABLE `anu_guest` (
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

/*Data for the table `anu_guest` */

/*Table structure for table `anu_loc_coast` */

DROP TABLE IF EXISTS `anu_loc_coast`;

CREATE TABLE `anu_loc_coast` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `coast` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `anu_loc_coast` */

insert  into `anu_loc_coast`(`id`,`coast`) values 
(1,'East Coast'),
(2,'West Coast'),
(3,'North Coast'),
(4,'South Coast');

/*Table structure for table `anu_location` */

DROP TABLE IF EXISTS `anu_location`;

CREATE TABLE `anu_location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone` int(4) NOT NULL DEFAULT '0',
  `loc_code` varchar(6) NOT NULL DEFAULT '000',
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `anu_location` */

insert  into `anu_location`(`id_location`,`name`,`zone`,`loc_code`) values 
(1,'Blue Waters',3,'027'),
(2,'Rex Halcyon Cove',2,'025'),
(3,'Hawksbill',3,'018'),
(4,'Galley Bay',2,'017'),
(5,'Royal Antiguan',2,'019'),
(6,'Coconut Beach',3,'022'),
(7,'Verandah',1,'002'),
(8,'Grand Pineapple Beach',1,'001'),
(9,'The Inn',4,'004'),
(10,'St. James Club',1,'005'),
(11,'Galleon Beach',4,'016'),
(12,'Cocos',4,'011'),
(13,'Sugar Ridge',4,'012'),
(14,'Hermitage Bay',4,'015'),
(15,'South Point',4,'005'),
(16,'Admirals Inn',4,'006'),
(17,'Anchorage INN',3,'020'),
(18,'Dickinson Bay Cottage',3,'021'),
(19,'Sandals',3,'024'),
(20,'TradeWinds',3,'026'),
(21,'Siboney',3,'023'),
(22,'OceanPoint',3,'028'),
(23,'Hodges Bay',3,'029'),
(24,'Jolly Beach',2,'013'),
(25,'Coco Bay',2,'010'),
(26,'Carlisle Bay',2,'007'),
(27,'Curtain Bluff',2,'008'),
(28,'Keyonna Beach',2,'009'),
(29,'Tranquility Beach',2,'014');

/*Table structure for table `anu_payment_type` */

DROP TABLE IF EXISTS `anu_payment_type`;

CREATE TABLE `anu_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `anu_payment_type` */

insert  into `anu_payment_type`(`id`,`payment_type`) values 
(1,'Payment Received – Credit Card'),
(2,'Payment Received – Cash'),
(3,'To Be Invoiced');

/*Table structure for table `anu_reps` */

DROP TABLE IF EXISTS `anu_reps`;

CREATE TABLE `anu_reps` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `anu_reps` */

insert  into `anu_reps`(`id_rep`,`name`) values 
(1,'Carol Silverster'),
(2,'Jason Mannix'),
(3,'Laurie Laville'),
(4,'Lornette Lawrence'),
(5,'Ulrike  Markgraf'),
(6,'Olivette Francis'),
(7,'Samantha Hazlewood');

/*Table structure for table `anu_resdrivers` */

DROP TABLE IF EXISTS `anu_resdrivers`;

CREATE TABLE `anu_resdrivers` (
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

/*Data for the table `anu_resdrivers` */

/*Table structure for table `anu_reservations` */

DROP TABLE IF EXISTS `anu_reservations`;

CREATE TABLE `anu_reservations` (
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

/*Data for the table `anu_reservations` */

/*Table structure for table `anu_room_loc` */

DROP TABLE IF EXISTS `anu_room_loc`;

CREATE TABLE `anu_room_loc` (
  `id_room_loc` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `id_roomtype` int(11) NOT NULL,
  PRIMARY KEY (`id_room_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `anu_room_loc` */

insert  into `anu_room_loc`(`id_room_loc`,`id_location`,`id_roomtype`) values 
(1,1,1),
(2,1,2),
(3,1,3),
(4,1,4),
(5,1,5),
(6,1,6),
(7,1,7),
(8,1,8),
(9,2,9),
(10,2,10),
(11,2,11),
(12,2,12),
(13,3,13),
(14,3,14),
(15,3,15),
(16,3,16),
(17,3,17),
(18,4,18),
(19,4,19),
(20,4,20),
(21,4,21),
(22,5,22),
(23,5,23),
(24,5,24),
(25,5,25),
(26,6,26),
(27,6,27),
(28,6,28),
(29,6,29),
(30,7,30),
(31,7,31),
(32,7,32),
(33,7,33),
(34,7,34),
(35,7,35),
(36,8,36),
(37,8,37),
(38,8,38),
(39,8,39),
(40,9,40),
(41,9,41),
(42,9,42),
(43,9,43),
(44,9,44),
(45,10,45),
(46,10,46),
(47,10,47),
(48,10,48),
(49,10,49),
(50,10,50),
(51,11,51),
(52,11,52),
(53,11,53),
(54,12,54),
(55,12,55),
(56,12,56),
(57,12,57),
(58,12,58),
(59,12,59),
(60,12,60),
(61,13,61),
(62,13,62),
(63,13,63),
(64,13,64),
(65,13,65),
(66,13,66),
(67,14,67),
(68,14,68),
(69,14,69),
(70,14,70),
(71,14,71),
(72,14,72),
(73,14,73),
(74,15,74),
(75,15,75),
(76,15,76),
(77,15,77),
(78,15,78),
(79,15,79),
(80,15,80),
(81,15,81),
(82,15,82),
(83,15,83),
(84,15,84),
(85,17,85),
(86,18,86),
(87,18,87),
(88,18,88);

/*Table structure for table `anu_roomtypes` */

DROP TABLE IF EXISTS `anu_roomtypes`;

CREATE TABLE `anu_roomtypes` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `anu_roomtypes` */

insert  into `anu_roomtypes`(`id_room`,`id_location`,`room_type`) values 
(1,1,'Superior Hillside Room'),
(2,1,'Deluxe Ocean View Rooms'),
(3,1,'Luxury Suite'),
(4,1,'Cove Suite'),
(5,1,'The Cove Penthouse'),
(6,1,'Rock Cottage'),
(7,1,'Turtle Cottage'),
(8,1,'Pelican House'),
(9,2,'Garden Room'),
(10,2,'Sea Veiw Room'),
(11,2,'Beachfront'),
(12,2,'Family Room'),
(13,3,'Garden Bungalow'),
(14,3,'Superior Seaveiw Room'),
(15,3,'Superior Seaveiw Bungalow'),
(16,3,'Beachfront Club Cottage'),
(17,3,'The Great House'),
(18,4,'Premium Beachfront Suite'),
(19,4,'Superior Beachfront Room'),
(20,4,'Deluxe Beachfront Room'),
(21,4,'Gaugin Cottages'),
(22,5,'Mountain Veiw Room'),
(23,5,'Lagoon Veiw Room'),
(24,5,'Ocean Veiw'),
(25,5,'Cottage'),
(26,6,'Deluxe Room'),
(27,6,'Junior Suite'),
(28,6,'Deluxe Suite (Top Floor)'),
(29,6,'Deluxe Suite ( Ground Floor)'),
(30,7,'Supersaver Room'),
(31,7,'Standard Room'),
(32,7,'Queen Superior Room'),
(33,7,'King Superior Room'),
(34,7,'Junior Suite'),
(35,7,'Antigua Cottage'),
(36,8,'Waterfront Suite'),
(37,8,'Waterview Suite'),
(38,8,'Hillside Suite'),
(39,8,'Two Bedroom Villa'),
(40,9,'Tropical Waterfront Room'),
(41,9,'Beachfront Room'),
(42,9,'Ocean Veiw Room'),
(43,9,'Gardenview Room'),
(44,9,'Standard Room'),
(45,10,'Standard Cottage'),
(46,10,'Deluxe Cottage'),
(47,10,'Deluxe Pool Cottage'),
(48,10,'Plantation House'),
(49,10,'Premium Waterfront Suite'),
(50,10,'Chattel House Suite'),
(51,11,'Junior Suite'),
(52,11,'Deluxe Suite'),
(53,11,'The Beach Cabana'),
(54,12,'Club Room'),
(55,12,'Premium Room'),
(56,12,'Beachfront'),
(57,12,'Royal Suites'),
(58,12,'2 Bedroom Villa'),
(59,12,'3 Bedroom Villa'),
(60,12,'Villa Pax'),
(61,13,'Garden Suite'),
(62,13,'Ocean Suite'),
(63,13,'Bay Suite'),
(64,13,'Beach Balcony Suite'),
(65,13,'Beach Terrace Suite'),
(66,13,'Carlisle Suite'),
(67,14,'Deluxe Room'),
(68,14,'Junior Suite'),
(69,14,'Bluff Room'),
(70,14,'One Bedroom Bluff Suite'),
(71,14,'Terrace Room'),
(72,14,'Cliff Suite'),
(73,14,'Grace &amp; Morris Bay Suite'),
(74,15,'1 Bedroom Cottage '),
(75,15,'2 Bedroom Cottage'),
(76,15,'1 Bedroom Garden Duplex'),
(77,15,'2 Bedroom Garden Duplex'),
(78,15,'Countess 3 Bedroom Villa'),
(79,15,'Sirius 3 Bed Villa'),
(80,15,'Lime Hill 4 Bed Villa'),
(81,15,'Babylon 4 Bed Villa'),
(82,15,'Standard Cottage'),
(83,15,'Premium Cottage'),
(84,15,'Sunset Cottage'),
(85,17,'Standard'),
(86,18,'Hillside Pool'),
(87,18,'Beachfront'),
(88,18,'Garden');

/*Table structure for table `anu_touroperator` */

DROP TABLE IF EXISTS `anu_touroperator`;

CREATE TABLE `anu_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `anu_touroperator` */

insert  into `anu_touroperator`(`id`,`tour_operator`) values 
(4,'Azure'),
(5,'BA Holidays'),
(10,'Caribtours'),
(12,'Classic Resorts'),
(15,'Destinology'),
(17,'EFR Travel (SJB Travel)'),
(20,'Golden Holidays'),
(21,'Hays'),
(23,'Holiday Services'),
(24,'Individual Holidays'),
(25,'Intimate Caribbean Holidays'),
(27,'Kuoni France'),
(33,'Kuoni UK'),
(34,'Kuoni USA'),
(35,'La Fabbrica'),
(36,'Luxury Holidays To &amp; Value Added Travel'),
(41,'Pink Pearl'),
(44,'Q Holidays'),
(45,'Scott Dunn'),
(51,'Team America'),
(53,'Thomas Cook AG'),
(54,'Thomas Cook Signature'),
(56,'Transfers 4 Travel'),
(57,'Travel Counsellors'),
(58,'Tropic Breeze'),
(59,'Turquoise Holidays'),
(66,'Wilderness Explorers'),
(67,'Agaxtur'),
(68,'Audley Travel'),
(71,'Bailey Robinson'),
(72,'Best Tours Italia'),
(73,'Bookit.com (Destination Experience)'),
(74,'Caribbean World (Berg & Meer, Tropical Tours)'),
(76,'Classic Collection Holidays'),
(78,'Collett\'s Travel'),
(79,'Cox & Kings'),
(80,'CV Travel'),
(82,'Dnata - Gold Medal & Stella Travel Services'),
(84,'Expressions Holidays'),
(90,'ITC Luxury Travel'),
(92,'Kuoni Netherlands (now Tenzing Travel)'),
(93,'Kuoni Switzerland (SunTours)'),
(98,'MLT Vacations'),
(99,'MotMot Travel'),
(101,'Pleasant Holidays'),
(102,'Prestbury WorldWide'),
(105,'Simpson Travel'),
(106,'Six Star Holidays'),
(107,'Southall Travel Ltd  - The Holiday Team - Away Holidays - Apple House Travel'),
(108,'Sublime Travel'),
(109,'Suntransfers'),
(113,'Tots Too'),
(115,'Travel 24/7'),
(119,'Voyage Prive'),
(120,'Vtours GMBH'),
(121,'W&O (Western & Oriental: Key 2 Holidays & Tropical Locations, Wando Travel)'),
(122,'We Travel2/Topflight'),
(123,'Weddings in Paradise'),
(124,'WestJet Vacations');

/*Table structure for table `anu_transport` */

DROP TABLE IF EXISTS `anu_transport`;

CREATE TABLE `anu_transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transport`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `anu_transport` */

insert  into `anu_transport`(`id_transport`,`name`) values 
(1,'Marvin Francis'),
(2,'Franklyn Joseph'),
(3,'Louvinca Kerwan'),
(4,'Bernard Simon'),
(5,'Cedric Simon'),
(6,'Wesley Joseph'),
(7,'Georges Thomas'),
(8,'Kareem James'),
(9,'Jules Bowen'),
(10,'AVIS'),
(11,'Gregson Gloade'),
(12,'Chemouy York');

/*Table structure for table `anu_vehicles` */

DROP TABLE IF EXISTS `anu_vehicles`;

CREATE TABLE `anu_vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `id_transport` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

/*Data for the table `anu_vehicles` */

insert  into `anu_vehicles`(`id_vehicle`,`id_transport`,`name`) values 
(1,1,'A 40124'),
(2,2,'A 2318'),
(3,3,'A 6271'),
(4,21,'TX1243'),
(5,22,'TX979'),
(6,23,'TX44'),
(7,24,'TX386'),
(8,25,'TX470'),
(9,113,'TX726'),
(10,114,'TX99'),
(11,27,'TX478'),
(12,28,'TX248'),
(13,115,'TX922'),
(14,30,'TX893'),
(15,31,'TX21'),
(16,32,'TX500'),
(17,33,'TX1149'),
(18,34,'TX1119'),
(19,35,'TX535'),
(20,36,'TX400'),
(21,37,'TX982'),
(22,38,'TX247'),
(23,39,'TX912'),
(24,40,'TX1090'),
(25,41,'TX227'),
(26,42,'TX1329'),
(27,43,'TX84'),
(28,44,'TX605'),
(29,45,'TX1121'),
(30,46,'TX315'),
(31,47,'TX144'),
(32,48,'TX345'),
(33,49,'TX230'),
(34,50,'TX878'),
(35,51,'TX96'),
(36,52,'TX1064'),
(37,53,'TX71'),
(38,54,'TX808'),
(39,55,'TX51'),
(40,56,'TX250'),
(41,57,'TX396'),
(42,58,'TX398'),
(43,59,'TX540'),
(44,60,'TX175'),
(45,61,'TX24'),
(46,62,'TX23'),
(47,63,'TX1167'),
(48,64,'TX1289'),
(49,65,'TX218'),
(50,66,'TX635'),
(51,67,'TX1106'),
(52,68,'TX1101'),
(53,69,'TX999'),
(54,70,'TX1027'),
(55,71,'TX58'),
(56,72,'TX130'),
(57,73,'TX1104'),
(58,74,'TX166'),
(59,75,'TX1152'),
(60,76,'TX1139'),
(61,77,'TX1048'),
(62,78,'TX444'),
(63,79,'TX618'),
(64,80,'TX966'),
(65,81,'TX511'),
(66,82,'TX1094'),
(67,83,'TX187'),
(68,84,'TX121'),
(69,85,'TX451'),
(70,86,'TX615'),
(71,87,'TX1076'),
(72,88,'TX52'),
(73,89,'TX214'),
(74,90,'TX366'),
(75,91,'TX1078'),
(76,92,'TX437'),
(77,93,'TX976'),
(78,94,'TX688'),
(79,95,'TX1248'),
(80,4,'A 4762'),
(81,5,'A 44999'),
(82,5,'A 8010'),
(83,5,'A 1297'),
(84,6,'A 42379'),
(85,7,'A 17661'),
(86,8,'A 46975'),
(87,9,'A 46484'),
(88,9,'A 46485'),
(89,10,'A 10000'),
(90,10,'A 35'),
(91,10,'A 8429'),
(92,10,'A 260'),
(93,10,'A 765'),
(94,10,'A 700'),
(95,10,'A 100'),
(96,10,'A 41'),
(97,11,'A 41016'),
(98,11,'A 33681'),
(99,11,'A 30077'),
(100,11,'A 42020'),
(101,11,'A 975 ( LIMO )'),
(102,12,'A 45'),
(103,12,'A 44016');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
