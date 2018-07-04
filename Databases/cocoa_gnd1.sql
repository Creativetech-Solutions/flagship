/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 5.6.17 : Database - cocoa_gnd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoa_gnd` /*!40100 DEFAULT CHARACTER SET latin1 */;

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

/*Table structure for table `gnd_flights` */

DROP TABLE IF EXISTS `gnd_flights`;

CREATE TABLE `gnd_flights` (
  `id_flight` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_flights` */

insert  into `gnd_flights`(`id_flight`,`flight_number`) values 
(62,'AA1546'),
(63,'AA982'),
(64,'AC1786'),
(65,'LI772'),
(66,'LI727'),
(67,'LI361'),
(68,'LI523'),
(69,'VS89'),
(70,'BW440'),
(71,'BW442'),
(72,'VS90'),
(73,'BA2157'),
(74,'BW441'),
(75,'AC1787'),
(77,'BW443'),
(78,'BW420'),
(79,'BW421'),
(80,'VO4012'),
(81,'DL525'),
(82,'BA2159'),
(83,'BA2158'),
(84,'BW608'),
(85,'BW609'),
(86,'VO4013'),
(87,'BW440');

/*Table structure for table `gnd_flighttime` */

DROP TABLE IF EXISTS `gnd_flighttime`;

CREATE TABLE `gnd_flighttime` (
  `id_fltime` int(11) NOT NULL AUTO_INCREMENT,
  `id_flight` int(11) NOT NULL,
  `flight_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fltime`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

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
(128,74,'7:40');

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

/*Table structure for table `gnd_location` */

DROP TABLE IF EXISTS `gnd_location`;

CREATE TABLE `gnd_location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_location` */

insert  into `gnd_location`(`id_location`,`name`,`zone`) values 
(71,'Sandals La Source',0),
(72,'Maca Bana Villas',0),
(73,'The Grenadian by Rex Resorts',0),
(74,'True Blue Bay Resort',0),
(75,'The Calabash Hotel',0),
(76,'Radisson Grenada Beach Resort',0),
(77,'The Blue Horizons Garden Resort',0),
(78,'The Flamboyant Hotel',0),
(79,'Mt. Cinnamon',0),
(80,'The Spice Island  Beach Resort',0),
(81,'La Luna',0);

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

/*Table structure for table `gnd_roomtypes` */

DROP TABLE IF EXISTS `gnd_roomtypes`;

CREATE TABLE `gnd_roomtypes` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_roomtypes` */

insert  into `gnd_roomtypes`(`id_room`,`id_location`,`room_type`) values 
(181,71,'Italian Oceanview Pent House'),
(182,71,'Italian Oceanview 1 Bedroom'),
(183,71,'South Seas One Bedroom Butler Suite'),
(184,71,'South Seas Grande Rondoval Butler Suite'),
(185,71,'South Seas Honeymoon One Bedroom Butler Suite'),
(186,71,'Italian Swimup Bi-level 1 Bedroom Butler Suite'),
(187,71,'Italian Bi-level Bedroom Suite'),
(188,71,'Pink Gin Beachfront Honeymoon Club'),
(189,71,'Pink Gin Oceanview Club Level Suite - OS'),
(190,71,'Pink Gin Beachfront Room - BR'),
(191,71,'Pink  Gin Oceanveiw Room- PO'),
(192,71,'Pink Gin Hideaway Room'),
(193,71,'South Seas Waterfall River Pool Walkout'),
(194,71,'Junior Suite'),
(195,71,'South Seas Waterfall River Pool Walkout  Junior Suite'),
(196,71,'South Seas Waterfall River Junior Suite'),
(197,71,'South Seas Hideaway Junior Suite'),
(198,71,'Pink Gin Grade Luxe - LO'),
(199,71,'South Seas Premium Room'),
(200,72,'Paw Paw'),
(201,72,'Rock Fig'),
(202,72,'Cherry'),
(203,72,'Avocado'),
(204,72,'Mango'),
(205,72,'Pineapple'),
(206,72,'Coconut'),
(207,73,'Seaview Room'),
(208,73,'Hillside'),
(209,73,'Beachfront Room'),
(210,73,'Executive Suite- Premier Room'),
(211,73,'Executive Suite - Premier Suites'),
(212,73,'Deluxe Suite'),
(213,74,'True Blue Rooms'),
(214,74,'Tree Top Rooms'),
(215,74,'Indigo Rooms'),
(216,74,'Bay View Rooms'),
(217,74,'Waterfront Suite'),
(218,74,'Tower Suites'),
(219,74,'Villas'),
(220,74,'Honeymoon Suite'),
(221,75,'Junior Suite'),
(222,75,'One Bedroom Westside Suites'),
(223,75,'One Bedroom Superior Suite'),
(224,75,'One Bedroom Pool Suite'),
(225,75,'Thorneycroft Suite'),
(226,75,'CariBali Villa'),
(227,75,'Hummingbird Villa'),
(228,75,'The Pool House Villa'),
(229,75,'Treefrog Villa'),
(230,75,'Swallow Villa'),
(231,76,'Garden Veiw Room'),
(232,76,'Beachfront room'),
(233,76,'Executive Beachfront Rooms'),
(234,76,'Executive Beachfront Suites'),
(235,78,'Deluxe Two Bedroom Suite'),
(236,78,'Deluxe One Bedroom Suite'),
(237,78,'Deluxe Hotel Room'),
(238,78,'Deluxe Studio'),
(239,78,'Standard Hotel Room'),
(240,78,'Superior Two Bedroom Suite'),
(241,78,'Superior One Bedroom Suite'),
(242,78,'Superior Suite'),
(243,79,'Luxury One Bedroom Hacienda Suite'),
(244,79,'One Bedroom Villa'),
(245,79,'Two Bedroom Garden Suite'),
(246,79,'Two Bedroom Villa'),
(247,79,'Three Bedroom Villa'),
(248,79,'Cinnamon Heights'),
(249,80,'One bedroom Cinnamon/ Saffron Suites'),
(250,80,'Royal Collection Pool Suites'),
(251,80,'Luxury Almond Pool Suites'),
(252,80,'Anthurium Pool Suites'),
(253,80,'Seagrape Beach Suites'),
(254,80,'Oleander Superior/ Garden Suites'),
(255,81,'Beach Cottage Deluxe'),
(256,81,'Deluxe Cottage'),
(257,81,'Cottage Suite'),
(258,81,'Indigo Villa'),
(259,81,'Seascape Villa');

/*Table structure for table `gnd_touroperator` */

DROP TABLE IF EXISTS `gnd_touroperator`;

CREATE TABLE `gnd_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `gnd_touroperator` */

insert  into `gnd_touroperator`(`id`,`tour_operator`) values 
(1,'Air Canada Vacations'),
(2,'Audley Travel'),
(3,'Azure Luxury Hotel Collection'),
(4,'British Airways Holidays'),
(5,'Caribtours'),
(6,'Carrier'),
(7,'City Discovery / World Airport Transfers'),
(8,'Classic Vacations'),
(9,'Cox &amp;Kings'),
(10,'Destinology'),
(11,'Delta Travel Ukraine'),
(12,'ES Travel'),
(13,'Europ Assistance'),
(14,'Expedia'),
(15,'Exsus Travel'),
(16,'Gold Medal Travel / Netflights / Pure Luxury'),
(17,'Hays Transfer'),
(18,'Holidays Services'),
(19,'Holiday Taxis'),
(20,'Hotelbeds'),
(21,'Indiviual Holidays'),
(22,'Intimate Holidays'),
(23,'ITC Classics / Complete Caribbean / Caribbean Connection'),
(24,'JetBlue'),
(25,'Just Resorts'),
(26,'Kuoni Travel Ltd'),
(27,'Kuoni Switzerland '),
(28,'Kuoni Italy'),
(29,'Kuoni France'),
(30,'Kuoni Spain'),
(31,'Kuoni Netherlands'),
(32,'La Fabbrica'),
(33,'Latino Travel'),
(34,'Lusso Travel'),
(35,'Luxury Travel To'),
(36,'Luxury Trips'),
(37,'MLT Vacations'),
(38,'Oxford Private Travel'),
(39,'Pleasant  Holidays'),
(40,'Press Tours Spa'),
(41,'Prestbury  Worldwide Resorts'),
(42,'Q Holidays / Sackville Travel'),
(43,'Scott Dunn'),
(44,'Simply Caribbean Luxury Holidays'),
(45,'Six Star Holidays'),
(46,'Sunset Faraway Holidays'),
(47,'Suntransfers.com'),
(48,'Stella Travel Services '),
(49,'The Global Travel Group'),
(50,'Triton Rooms'),
(51,'Travel2'),
(52,'TravelBag'),
(53,'Simply Luxury'),
(54,'Team America'),
(55,'The Holiday Place'),
(56,'Thomas Cook Uk'),
(57,'Thomas Cook Germany'),
(58,'Trailfinders'),
(59,'Transfers4travel'),
(60,'Travel Counsellors'),
(61,'Travel Suitcase'),
(62,'Tropic Breeze'),
(63,'Turquoise Holidays'),
(64,'Viator'),
(65,'Vicino e Lontano'),
(66,'Wedding in Paradise'),
(67,'Western &amp; Oriental'),
(70,'We Travel / Topflight'),
(71,'Wilderness Explorers');

/*Table structure for table `gnd_transport` */

DROP TABLE IF EXISTS `gnd_transport`;

CREATE TABLE `gnd_transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transport`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_transport` */

insert  into `gnd_transport`(`id_transport`,`name`) values 
(1,'Terrance Louison'),
(2,'Ralph Alexander'),
(3,'Celestine Morian'),
(4,'Augustine Morian'),
(5,'Patrick Thomas'),
(6,'Henrys Safari Tours '),
(7,'Ruben Vincent'),
(8,'Michael Scott'),
(9,'Selwyn Coutain'),
(10,'Carl David');

/*Table structure for table `gnd_vehicles` */

DROP TABLE IF EXISTS `gnd_vehicles`;

CREATE TABLE `gnd_vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `id_transport` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `gnd_vehicles` */

insert  into `gnd_vehicles`(`id_vehicle`,`id_transport`,`name`) values 
(1,1,'Coaster - HV673'),
(2,1,'Minibus - HAB573'),
(3,2,'Private Van - HX822'),
(4,3,'Minibus - HAE259'),
(5,4,'Private Car - HAB790'),
(6,5,'Minibus - HAJ359'),
(7,6,'Coaster - HAD940'),
(8,6,'Coaster - HO625'),
(9,6,'Coaster - HAF425'),
(10,7,'Private Car - HAF757'),
(11,8,'Private Car - HAD133'),
(12,9,'Private Car - H5035'),
(13,10,'Private Van - HAE153');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
