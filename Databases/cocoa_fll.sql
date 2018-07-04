/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cocoa_fll
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoa_fll` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cocoa_fll`;

/*Table structure for table `fll_activity` */

DROP TABLE IF EXISTS `fll_activity`;

CREATE TABLE `fll_activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(255) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;

/*Data for the table `fll_activity` */

insert  into `fll_activity`(`id_activity`,`log_user`,`user_action`,`log_time`) values 
(1,'ShavanarÃ© Oliver','add tour operator: Cruiseline - Star Clippers','2015-10-21 15:12:24'),
(2,'ShavanarÃ© Oliver','add flight time: 8:00 for flight AA1669','2015-10-21 15:31:05'),
(3,'ShavanarÃ© Oliver','add new reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2015-10-21 15:31:15'),
(4,'ShavanarÃ© Oliver','update reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2015-10-21 15:33:09'),
(5,'ShavanarÃ© Oliver','add new flight number: Vessel - Star Flyer','2015-10-21 15:34:12'),
(6,'ShavanarÃ© Oliver','add flight time: 6:00 for flight Vessel - Star Flyer','2015-10-21 15:35:15'),
(7,'ShavanarÃ© Oliver','update reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2015-10-21 15:35:30'),
(8,'ShavanarÃ© Oliver','update reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2015-10-21 15:38:37'),
(9,'ShavanarÃ© Oliver','update reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2015-10-21 15:39:36'),
(10,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-V3HNRKJM','2016-08-31 16:22:41'),
(11,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-WVP98BVX','2016-08-31 16:24:04'),
(12,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-FK9VMC8Q','2016-08-31 16:24:55'),
(13,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-TBD65BDZ','2016-08-31 16:30:12'),
(14,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-HFKGTDR9','2016-08-31 16:43:02'),
(15,'Creative Tech','add new reservation: Mr. Syed Haider #ref:FLL-KHHSJPTR','2016-08-31 16:54:46'),
(16,'Creative Tech','add new reservation: Mr. Syed Haider #ref:FLL-GBQC7KFW','2016-08-31 16:59:14'),
(17,'Creative Tech','add new reservation: Mr. Syed Haider #ref:FLL-27WHD5H9','2016-08-31 17:19:57'),
(18,'Creative Tech','add new reservation: Mr. Syed Haider #ref:FLL-M5V78MN6','2016-08-31 17:24:03'),
(19,'Creative Tech','add new reservation: Mr. Syed Haider #ref:FLL-9HB8D539','2016-08-31 17:25:01'),
(20,'Creative Tech','add new reservation: . FIrst Haider #ref:FLL-24TVWFFQ','2016-08-31 17:29:09'),
(21,'Creative Tech','add new reservation: . FIrst Haider #ref:FLL-79SWJNDJ','2016-08-31 17:41:42'),
(22,'Creative Tech','update reservation: . FIrst Haider #ref:FLL-79SWJNDJ','2016-09-01 09:51:39'),
(23,'Creative Tech','add new reservation: . Akram Durrani #ref:FLL-39XP48T2','2016-09-01 09:54:16'),
(24,'Creative Tech','add new reservation: . First Last #ref:FLL-9ZJKM76R','2016-09-01 09:58:56'),
(25,'Creative Tech','add new reservation: . FIrst lAST #ref:FLL-JSSVCFRB','2016-09-01 09:59:48'),
(26,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-V73NM3N3','2016-09-01 10:02:01'),
(27,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-DCTDWGS8','2016-09-01 10:05:25'),
(28,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-RCK992S8','2016-09-01 10:08:00'),
(29,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-HVGQK2G4','2016-09-01 10:10:57'),
(30,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-8HKF2DKT','2016-09-01 10:31:42'),
(31,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-MBZ632NW','2016-09-01 10:33:49'),
(32,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-VD3HVJVJ','2016-09-01 10:34:10'),
(33,'Creative Tech','add new reservation: . ahsan Abbasi #ref:FLL-Y4KB7CSY','2016-09-01 10:34:31'),
(34,'Creative Tech','add new reservation: Mr. ahsan  DUrrani #ref:FLL-JZW46N3G','2016-09-01 10:48:59'),
(35,'Creative Tech','update reservation: . First Last #ref:FLL-9ZJKM76R','2016-09-01 12:38:31'),
(36,'Creative Tech','bug reported: Email Not working on Bug','2016-09-02 13:02:21'),
(37,'Creative Tech','update reservation: Ms. Beth Schultz #ref:BGI-X7ZDPW79','2016-09-02 14:43:06'),
(38,'Creative Tech','bug reported: but','2016-09-02 15:10:07'),
(39,'Creative Tech','bug reported: tet','2016-09-02 15:10:36'),
(40,'Creative Tech','bug reported: tet','2016-09-02 15:33:51'),
(41,'Creative Tech','bug reported: tet','2016-09-02 15:35:13'),
(42,'Creative Tech','bug reported: tet','2016-09-02 15:35:37'),
(43,'Creative Tech','bug reported: tet','2016-09-02 15:37:41'),
(44,'Creative Tech','bug reported: tet','2016-09-02 15:37:55'),
(45,'Creative Tech','bug reported: tet','2016-09-02 15:38:24'),
(46,'Creative Tech','bug reported: tet','2016-09-02 15:39:15'),
(47,'Creative Tech','bug reported: tet','2016-09-02 15:39:57'),
(48,'Creative Tech','bug reported: tet','2016-09-02 15:41:25'),
(49,'Creative Tech','bug reported: tet','2016-09-02 15:56:07'),
(50,'Creative Tech','bug reported: tet','2016-09-02 16:00:37'),
(51,'Creative Tech','bug reported: tet','2016-09-02 16:02:04'),
(52,'Creative Tech','bug reported: tet','2016-09-02 16:02:51'),
(53,'Creative Tech','bug reported: tet','2016-09-02 16:12:19'),
(54,'Creative Tech','bug reported: tet','2016-09-02 16:38:59'),
(55,'Creative Tech','bug reported: Bug Title','2016-09-02 16:39:33'),
(56,'Creative Tech','update reservation: . FIrst Haider #ref:FLL-79SWJNDJ','2016-09-05 15:51:13'),
(57,'Creative Tech','add new Inter-Hotel transfer: FLL-9ZJKM76R','2016-09-05 16:06:51'),
(58,'Creative Tech','update reservation: . First Last #ref:FLL-9ZJKM76R','2016-09-05 16:09:43'),
(59,'Creative Tech','update reservation: . FIrst lAST #ref:FLL-JSSVCFRB','2016-09-05 16:56:57'),
(60,'Creative Tech','update reservation: . FIrst lAST #ref:FLL-JSSVCFRB','2016-09-05 17:10:02'),
(61,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:11:34'),
(62,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:14:13'),
(63,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:17:18'),
(64,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:17:33'),
(65,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:19:00'),
(66,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:19:09'),
(67,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:21:21'),
(68,'Creative Tech','add new arrival: #ref:FLL-JSSVCFRB','2016-09-05 17:28:42'),
(69,'Creative Tech','add new fast track reservation:  Ms. Haider Hassan #ref:FLL-WNDV4T2N','2016-09-06 10:41:14'),
(70,'Creative Tech','update reservation: Dr. FIrst Haider #ref:FLL-79SWJNDJ','2016-09-06 11:00:01'),
(71,'Creative Tech','add new arrival: #ref:FLL-79SWJNDJ','2016-09-06 11:08:25'),
(72,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-BMG9HD3G','2016-09-19 09:46:55'),
(73,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-NG9DFG22','2016-09-20 14:20:11'),
(74,'Creative Tech','add new departure: #ref:FLL-79SWJNDJ','2016-09-20 16:00:31'),
(75,'Creative Tech','add new departure: #ref:FLL-79SWJNDJ','2016-09-20 16:02:54'),
(76,'Creative Tech','add new departure: #ref:FLL-79SWJNDJ','2016-09-20 16:06:31'),
(77,'Creative Tech','add new departure: #ref:FLL-79SWJNDJ','2016-09-20 16:11:42'),
(78,'Creative Tech','add guest: Mrs. Beenish Iqbal Afridi for Ref# FLL-79SWJNDJ','2016-09-20 16:12:43'),
(79,'Creative Tech','add new Inter-Hotel transfer: FLL-79SWJNDJ','2016-09-20 16:13:24'),
(80,'Creative Tech','add new Inter-Hotel transfer: FLL-79SWJNDJ','2016-09-20 16:23:27'),
(81,'Creative Tech','update reservation: Dr. FIrst Haider #ref:FLL-79SWJNDJ','2016-09-20 16:24:08'),
(82,'Creative Tech','add new arrival: #ref:FLL-39XP48T2','2016-09-20 16:42:49'),
(83,'Creative Tech','add new arrival: #ref:FLL-VD3HVJVJ','2016-09-20 17:10:52'),
(84,'Creative Tech','add guest: Ms. Maham Aftab for Ref# FLL-NG9DFG22','2016-09-21 12:21:57'),
(85,'Creative Tech','add new reservation: Ms. First Last #ref:FLL-KC8FTDZ4','2016-10-04 18:41:21'),
(86,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-H4V375X3','2016-10-04 19:09:13'),
(87,'Creative Tech','add new reservation: Mr. Sajid Afridi #ref:FLL-6PD9PHPQ','2016-10-04 19:15:09'),
(88,'Creative Tech','add new reservation: Mr. 123 123 #ref:FLL-H3WPVNKS','2016-10-05 13:00:27'),
(89,'Creative Tech','Assign team Cheryl Sillivan / update reservation: .   #ref:FLL-H3WPVNKS','2016-10-05 13:02:29'),
(90,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-W9Z8BT9V','2016-10-06 12:38:40'),
(91,'Creative Tech','add new reservation: Mr. Own Malik #ref:FLL-8B3MPJWW','2016-11-01 13:41:52'),
(92,'Creative Tech','add new fast track reservation:  Mr. Raza Malik #ref:FLL-BKHXR7XV','2016-11-01 16:16:52'),
(93,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-QZBBKJQC','2016-11-01 16:25:45'),
(94,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-DY8JZZZ9','2016-11-01 16:29:13'),
(95,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-FBZDTH5F','2016-11-01 16:30:58'),
(96,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-NZZ69N4D','2016-11-01 16:35:08'),
(97,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-WDCFMYZF','2016-11-01 16:36:36'),
(98,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-PKZWFTJQ','2016-11-01 16:38:14'),
(99,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-FJDY5DQX','2016-11-01 16:40:45'),
(100,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-K4YQ9RBQ','2016-11-01 16:43:02'),
(101,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-RFPDV89T','2016-11-01 16:44:47'),
(102,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-HG5Y39G5','2016-11-01 16:44:56'),
(103,'Creative Tech','add new fast track reservation:  Select title. Haider Hassan #ref:FLL-RZ2T4X3R','2016-11-01 16:45:38'),
(104,'Creative Tech','add new fast track reservation:  Select title. Guest Test #ref:FLL-W93H2HMF','2016-11-01 16:55:32'),
(105,'Creative Tech','add new fast track reservation:  Select title. Guest Test #ref:FLL-WXNRKNXY','2016-11-01 17:10:22'),
(106,'Creative Tech','add new fast track reservation:  Mr. Amjad Durrani #ref:FLL-NBKP33RJ','2016-11-17 11:13:32'),
(107,'Creative Tech','add new fast track reservation:  Ms. Anaar Kali #ref:FLL-SNZ7DSW3','2016-11-17 13:39:09'),
(108,'Creative Tech','add new reservation: Ms. Neela Begam #ref:FLL-R5JM29BV','2016-11-17 17:44:07'),
(109,'Creative Tech','add new reservation: Ms. Gul Khan #ref:FLL-KDKBWS7M','2016-11-17 17:45:02'),
(110,'Creative Tech','add new reservation: . ANeel Abid #ref:FLL-BMVFWZ49','2016-11-17 18:17:22'),
(111,'Creative Tech','add new reservation: Mr. Anil Kapoor #ref:FLL-F42GDJWZ','2016-11-18 10:14:01'),
(112,'Creative Tech','add new arrival: #ref:FLL-F42GDJWZ','2016-11-18 10:26:42'),
(113,'Creative Tech','add new reservation: Mr. Afreen Afreen #ref:FLL-4KNDQ9VY','2016-11-22 11:22:57'),
(114,'Creative Tech','add new arrival: #ref:FLL-4KNDQ9VY','2016-11-22 12:10:23'),
(115,'Creative Tech','add new arrival: #ref:FLL-4KNDQ9VY','2016-11-22 12:11:32'),
(116,'Creative Tech','add new arrival: #ref:FLL-4KNDQ9VY','2016-11-22 12:15:04'),
(117,'Creative Tech','add new arrival: #ref:FLL-4KNDQ9VY','2016-11-22 12:21:34'),
(118,'Creative Tech','add new arrival: #ref:FLL-4KNDQ9VY','2016-11-22 12:22:41'),
(119,'Creative Tech','add new reservation: Mr. Momina Afreen #ref:FLL-MVK5QV82','2016-11-23 10:26:14'),
(120,'Creative Tech','add new reservation: Mr. First Last #ref:FLL-TWDSX5SV','2016-11-23 10:39:16'),
(121,'Creative Tech','add new reservation: Mr. Momina MusteAhsan #ref:FLL-BMF9HD5T','2016-11-23 10:43:44'),
(122,'Creative Tech','add new reservation: Ms. Momina Ali #ref:FLL-RYJF7DJW','2016-11-23 10:49:06'),
(123,'Creative Tech','add new reservation: Ms. Momina Musteahsan #ref:FLL-FXX7GW4Q','2016-11-23 10:52:51'),
(124,'Creative Tech','add new reservation: Ms. First Name #ref:FLL-YM3G4CHG','2016-11-23 11:13:16'),
(125,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-BGR5BF4V','2016-11-29 15:23:14'),
(126,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-JY2T3DRD','2016-11-29 16:22:52'),
(127,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-WBTZDGZ3','2016-11-29 16:26:40'),
(128,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-5P3MY3YQ','2016-11-29 16:33:36'),
(129,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-JTQJSWG8','2016-11-29 17:00:01'),
(130,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-QD9GBCZM','2016-11-29 17:02:28'),
(131,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-27N25QGY','2016-11-30 10:22:07'),
(132,'Creative Tech','add new reservation: Mr. haider hassan #ref:FLL-9XD2ZCG5','2016-11-30 10:28:20'),
(133,'Creative Tech','add new fast track reservation:  Mr. First Last #ref:FLL-D22V2B6V','2016-11-30 15:47:34'),
(134,'Creative Tech','add new fast track reservation:  Ms. Momina  Haider #ref:FLL-CBX3JB72','2016-11-30 16:00:30'),
(135,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-P4BQDSGM','2016-12-01 09:56:09'),
(136,'Creative Tech','add new reservation: Mrs. akram Durrani #ref:FLL-9MRD2B8R','2016-12-01 10:02:05'),
(137,'Creative Tech','add new reservation: Mrs. Adnan Sami #ref:FLL-MQVX5CQC','2016-12-01 10:05:34'),
(138,'Creative Tech','add new reservation: Mrs. another test #ref:FLL-N3SHD2Y4','2016-12-01 10:07:24'),
(139,'Creative Tech','add new reservation: Mrs. dd d #ref:FLL-WMN4P79X','2016-12-01 10:08:12'),
(140,'Creative Tech','Assign team Jenny Banfield / update reservation: .   #ref:FLL-W9Z8BT9V','2016-12-01 12:18:04'),
(141,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-56WBGXWZ','2016-12-06 13:37:04'),
(142,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-88GCSZPD','2016-12-06 14:15:07'),
(143,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-3MHSFTRK','2016-12-06 14:19:19'),
(144,'Creative Tech','add new reservation: Mr. Haider Hassan #ref:FLL-CWX36F54','2016-12-06 16:34:16'),
(145,'Creative Tech','add new reservation: Mr. Haider HassAN #ref:FLL-VDQYNHZW','2016-12-06 17:23:16'),
(146,'Creative Tech','add new fast track reservation:  Ms. Haider Hassan #ref:FLL-G23HY4RZ','2016-12-07 18:06:58'),
(147,'Kavita Sandiford','add new reservation: Mrs. Nikita Sandiford #ref:FLL-TJ4V5Q2W','2017-03-22 15:05:44'),
(148,'Kavita Sandiford','update reservation: Mrs. Nikita Sandiford #ref:FLL-TJ4V5Q2W','2017-03-22 15:07:56'),
(149,'Nicole Moody','delete location item: Fairmont Royal Pavilion','2017-05-25 12:57:33'),
(150,'Lekeisha Straker','add new reservation: Mr. Steve Frank #ref:FLL-5QFWC54G','2017-05-25 13:12:46'),
(151,'Lekeisha Straker','add guest: Miss. Jane Franks for Ref# FLL-5QFWC54G','2017-05-25 13:15:52'),
(152,'Lekeisha Straker','add new reservation: Mr. Ian Small #ref:FLL-34WZ5R55','2017-05-25 14:17:46'),
(153,'Creative Tech','add new fast track reservation:  Mr. ahsan khan #ref:FLL-DFH6YKWZ','2017-06-02 18:44:17'),
(154,'Nicole Moody','add new fast track reservation:  Mr. Testing Testing Last #ref:FLL-4STB59Y9','2017-06-06 17:53:52'),
(155,'Creative Tech','add new fast track reservation:  Mr. Amount Test Amount Test #ref:FLL-TDTHYH97','2017-06-06 19:20:52'),
(156,'Nicole Moody','add new fast track reservation:  Select title. FSFT Price Test FSFT Price TEst Last #ref:FLL-DXNH952S','2017-06-08 12:35:10'),
(157,'Nicole Moody','add new fast track reservation:  Select title. FSFT ntm price test FSFT ntm price test Last #ref:FLL-P74XYNRY','2017-06-08 12:40:48'),
(158,'Creative Tech','add new fast track reservation:  Mr. Test User #ref:FLL-ZG7BN6H4','2017-06-08 13:15:15'),
(159,'Creative Tech','add new fast track reservation:  Mr. Abc xyz #ref:FLL-YF39VR47','2017-06-08 13:22:59'),
(160,'Nicole Moody','add new fast track reservation:  Select title. FSFT Fist Name FSFT Last Name #ref:FLL-44C2Z7RX','2017-06-09 14:41:04'),
(161,'Nicole Moody','add new fast track reservation:  Sir. Another Test First Another Test Last #ref:FLL-Q3D6XWV4','2017-06-09 14:52:48'),
(162,'Creative Tech','add new fast track reservation:  Select title. Arslan Testing2 #ref:FLL-RDDV2KB6','2017-06-14 16:02:36'),
(163,'Nicole Moody','add new fast track reservation:  Mr. Testing Testing #ref:FLL-WGT8CZ9N','2017-06-19 11:36:54'),
(164,'Nicole Moody','update arrival details: #ref:FLL-WGT8CZ9N','2017-06-19 11:38:13'),
(165,'Nicole Moody','add new reservation: Mr. Nicole Testing Last #ref:FLL-38BTM48H','2017-06-19 12:09:04'),
(166,'Nicole Moody','Assign team Allan Grannum / update reservation: .   #ref:FLL-38BTM48H','2017-06-19 12:22:12'),
(167,'Creative Tech','add new reservation: Mr. Abc15 xyz15 #ref:FLL-C8RK49PG','2017-06-19 20:15:18'),
(168,'Creative Tech','update arrival details: #ref:FLL-RDDV2KB6','2017-06-19 20:45:55'),
(169,'Nicole Moody','update reservation: Mr. Nicole Testing Last #ref:FLL-38BTM48H','2017-06-20 12:32:52'),
(170,'Creative Tech','add new reservation: Mr. abc17 xyz17 #ref:FLL-5VDZX22R','2017-06-20 14:19:28'),
(171,'Creative Tech','add new fast track reservation:  Select title. abc20 xyz20 #ref:FLL-2BNYPZ8R','2017-06-20 15:00:45'),
(172,'Creative Tech','add new reservation: Mr. first Last #ref:FLL-H4M882X2','2017-06-20 15:41:29'),
(173,'Nicole Moody','add new reservation: Mr. Tess 1 Tess 1 #ref:FLL-TFB26QDX','2017-06-20 21:11:03'),
(174,'Nicole Moody','update arrival details: #ref:FLL-TFB26QDX','2017-06-20 21:20:24'),
(175,'Nicole Moody','add new fast track reservation:  Sir. FSFT First FSFT Last #ref:FLL-GX9TTB9Y','2017-06-20 21:25:37'),
(176,'Nicole Moody','add guest: Dr. add guest testing First add guest testing Last for Ref# FLL-GX9TTB9Y','2017-06-20 21:35:23'),
(177,'Creative Tech','add new reservation: Mr. abc xyz #ref:FLL-8C94DBDD','2017-06-21 15:22:55'),
(178,'Creative Tech','add new fast track reservation:  Select title. abc2 xyz2 #ref:FLL-P7SHFQFG','2017-06-21 15:24:23'),
(179,'Creative Tech','update arrival details: #ref:FLL-H4M882X2','2017-06-21 16:01:02'),
(180,'Creative Tech','update arrival details: #ref:FLL-P7SHFQFG','2017-06-21 18:13:00'),
(181,'Creative Tech','add new reservation: . Abc19 xyz19 #ref:FLL-B9JPRFTS','2017-06-21 18:27:34'),
(182,'Creative Tech','update arrival details: #ref:FLL-B9JPRFTS','2017-06-21 18:31:02'),
(183,'Creative Tech','update arrival details: #ref:FLL-B9JPRFTS','2017-06-21 18:31:31'),
(184,'Creative Tech','update arrival details: #ref:FLL-8C94DBDD','2017-06-21 18:34:47'),
(185,'Creative Tech','add new fast track reservation:  Select title. fSFT Test #ref:FLL-2YJJ5GQD','2017-06-21 18:48:45'),
(186,'Creative Tech','add new reservation: . Abc22 xyz22 #ref:FLL-F7Z73C9K','2017-06-21 18:49:45'),
(187,'Creative Tech','update arrival details: #ref:FLL-F7Z73C9K','2017-06-21 18:50:16'),
(188,'Creative Tech','update arrival details: #ref:FLL-F7Z73C9K','2017-06-21 18:50:59'),
(189,'Nicole Moody','update reservation: . fSFT Test #ref:FLL-2YJJ5GQD','2017-06-22 18:44:58'),
(190,'Nicole Moody','update reservation: . Abc19 xyz19 #ref:FLL-B9JPRFTS','2017-06-22 18:45:09'),
(191,'Nicole Moody','update reservation: Sir. FSFT First 2 FSFT Last #ref:FLL-GX9TTB9Y','2017-06-22 18:45:52'),
(192,'Nicole Moody','add new reservation: Mr. John Taylor #ref:FLL-JQ296ZRB','2017-06-22 18:47:45'),
(193,'Nicole Moody','update arrival details: #ref:FLL-JQ296ZRB','2017-06-22 18:54:13'),
(194,'Nicole Moody','add new reservation: Mr. George Smith #ref:FLL-DPHXV7G5','2017-06-29 09:06:06'),
(195,'Nicole Moody','add new reservation: Mrs. Another Test First Another Test First #ref:FLL-P8P7HW4V','2017-06-29 12:09:09'),
(196,'Nicole Moody','Assign team Shanad Snagg / update reservation: .   #ref:FLL-P7SHFQFG','2017-06-29 12:38:01'),
(197,'Nicole Moody','update reservation: . Abc22 xyz22 #ref:FLL-F7Z73C9K','2017-06-29 15:56:08'),
(198,'Nicole Moody','add new reservation: Sir. James Carlton #ref:FLL-QNM5HCPC','2017-06-29 16:16:04'),
(199,'Creative Tech','add new fast track reservation:  Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:19:16'),
(200,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:20:54'),
(201,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:21:01'),
(202,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:21:05'),
(203,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:47:36'),
(204,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:47:42'),
(205,'Creative Tech','update reservation: Mr. abc111 xyz111 #ref:FLL-GS4S3JBV','2017-07-04 13:48:18'),
(206,'Creative Tech','update arrival details: #ref:FLL-8C94DBDD','2017-07-04 13:58:46'),
(207,'Creative Tech','add new reservation: Mr. abc3 xyz3 #ref:FLL-2Q9SXPNS','2017-07-05 14:29:28'),
(208,'Creative Tech','add new reservation: Mr. abc4 xyz4 #ref:FLL-TP7NV3K9','2017-07-05 15:07:50'),
(209,'Creative Tech','update reservation: Mr. abc3 xyz3 #ref:FLL-2Q9SXPNS','2017-07-05 16:17:26'),
(210,'Creative Tech','update reservation: Mr. John Taylor #ref:FLL-JQ296ZRB','2017-07-05 16:22:20'),
(211,'Creative Tech','update reservation: Mr. abc3 xyz3 #ref:FLL-2Q9SXPNS','2017-07-05 16:23:41'),
(212,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:18:49'),
(213,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:19:21'),
(214,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:24:02'),
(215,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:27:02'),
(216,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:27:11'),
(217,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:28:26'),
(218,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:29:35'),
(219,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:29:43'),
(220,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:29:54'),
(221,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:30:05'),
(222,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:31:55'),
(223,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:32:07'),
(224,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:32:14'),
(225,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:32:21'),
(226,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:53:35'),
(227,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:53:42'),
(228,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:53:57'),
(229,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 17:55:38'),
(230,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 18:05:04'),
(231,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 18:08:00'),
(232,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 18:08:13'),
(233,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 18:08:25'),
(234,'Creative Tech','update arrival details: #ref:FLL-TP7NV3K9','2017-07-05 18:08:36'),
(235,'Creative Tech','add new fast track reservation:  Professor. Acb xzy #ref:FLL-5G7CVGKB','2017-07-06 12:26:17'),
(236,'Creative Tech','update arrival details: #ref:FLL-H4M882X2','2017-07-06 13:21:51'),
(237,'Creative Tech','update arrival details: #ref:FLL-H4M882X2','2017-07-06 13:24:31'),
(238,'Creative Tech','update arrival details: #ref:FLL-H4M882X2','2017-07-06 13:24:45'),
(239,'Creative Tech','update arrival details: #ref:FLL-H4M882X2','2017-07-06 13:24:56'),
(240,'Creative Tech','add new reservation: Mr. abc333 xyz111 #ref:FLL-H8CF2HBP','2017-07-07 16:16:12'),
(241,'Creative Tech','update reservation: Mr. abc333 xyz111 #ref:FLL-H8CF2HBP','2017-07-07 16:16:35'),
(242,'Creative Tech','add new reservation: Mr. abc444 xyz444 #ref:FLL-3J2R3HT4','2017-07-07 16:31:31'),
(243,'Creative Tech','update reservation: Mr. abc444 xyz444 #ref:FLL-3J2R3HT4','2017-07-07 16:32:39'),
(244,'Creative Tech','update reservation: Mr. abc444 xyz444 #ref:FLL-3J2R3HT4','2017-07-07 16:32:58'),
(245,'Creative Tech','update arrival details: #ref:FLL-3J2R3HT4','2017-07-07 16:33:34'),
(246,'Creative Tech','update arrival details: #ref:FLL-3J2R3HT4','2017-07-07 16:34:38'),
(247,'Creative Tech','add new reservation: Mr. abc55 xyz55 #ref:FLL-WB3S7XNQ','2017-07-07 16:40:46'),
(248,'Creative Tech','add new reservation: Mr. abc66 xyz66 #ref:FLL-TTKT2KJS','2017-07-10 10:56:22');

/*Table structure for table `fll_additional_transfer` */

DROP TABLE IF EXISTS `fll_additional_transfer`;

CREATE TABLE `fll_additional_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(255) NOT NULL,
  `pickup` varchar(80) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` varchar(255) DEFAULT NULL,
  `dropoff` varchar(255) DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `transfer_notes` varchar(255) DEFAULT NULL,
  `total_guests` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fll_additional_transfer` */

insert  into `fll_additional_transfer`(`id`,`ref_no_sys`,`pickup`,`pickup_date`,`pickup_time`,`dropoff`,`transport`,`vehicle`,`driver`,`transfer_notes`,`total_guests`) values 
(1,'FLL-5QFWC54G','the club','2017-07-31','19:00','daphne&#039;s Restaurant','Private Van',0,0,'19:30 dinner reservation',NULL),
(2,'FLL-38BTM48H','sandals','2017-06-15','16:55','The Cliff','Mercedes/BMW',0,17,'concierge transfer notes',NULL),
(3,'FLL-TFB26QDX','hotel','2017-06-22','15:25','Anything at all','Coach (BT)',109,69,'concierge transfer notes here',NULL),
(4,'FLL-P8P7HW4V','','0000-00-00','','','',0,0,'',NULL);

/*Table structure for table `fll_arrivals` */

DROP TABLE IF EXISTS `fll_arrivals`;

CREATE TABLE `fll_arrivals` (
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
  `infant_seats` int(11) DEFAULT NULL,
  `child_seats` int(11) DEFAULT NULL,
  `booster_seats` int(11) DEFAULT NULL,
  `vouchers` int(11) DEFAULT NULL,
  `cold_towel` int(11) DEFAULT NULL,
  `bottled_water` int(11) DEFAULT NULL,
  `rooms` int(6) DEFAULT NULL,
  `room_no` varchar(30) DEFAULT NULL,
  `arr_main` int(11) DEFAULT NULL,
  `luggage_vehicle` varchar(9) NOT NULL DEFAULT 'No',
  `fast_track` tinyint(1) NOT NULL DEFAULT '0',
  `excursion_name` varchar(100) DEFAULT NULL,
  `excursion_date` datetime DEFAULT NULL,
  `excursion_pickup` varchar(5) DEFAULT NULL,
  `excursion_confirm_by` varchar(200) DEFAULT NULL,
  `excursion_confirm_date` date DEFAULT NULL,
  `excursion_guests` decimal(3,0) DEFAULT NULL,
  `arr_rooms` varchar(10) DEFAULT NULL,
  `room_last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `fll_arrivals` */

insert  into `fll_arrivals`(`id`,`ref_no_sys`,`arr_date`,`arr_time`,`arr_flight_no`,`flight_class`,`arr_transport`,`arr_driver`,`arr_vehicle`,`arr_pickup`,`arr_dropoff`,`room_type`,`rep_type`,`client_reqs`,`arr_transport_notes`,`arr_hotel_notes`,`infant_seats`,`child_seats`,`booster_seats`,`vouchers`,`cold_towel`,`bottled_water`,`rooms`,`room_no`,`arr_main`,`luggage_vehicle`,`fast_track`,`excursion_name`,`excursion_date`,`excursion_pickup`,`excursion_confirm_by`,`excursion_confirm_date`,`excursion_guests`,`arr_rooms`,`room_last_name`) values 
(1,'FLL-H4M882X2','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,'GLN'),
(2,'FLL-TFB26QDX','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'Yes',0,'Catamaran','2017-06-26 00:00:00','','Conf Name Test','2017-06-20','3',NULL,'test1'),
(3,'FLL-TFB26QDX','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',NULL,'Yes',0,'safari3','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(4,'FLL-GX9TTB9Y','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),
(5,'FLL-8C94DBDD','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(6,'FLL-P7SHFQFG','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),
(7,'FLL-B9JPRFTS','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(8,'FLL-2YJJ5GQD','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),
(9,'FLL-F7Z73C9K','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(10,'FLL-JQ296ZRB','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(11,'FLL-DPHXV7G5','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'Yes',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,'Smith'),
(12,'FLL-P8P7HW4V','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'Yes',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(13,'FLL-P8P7HW4V','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',NULL,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(14,'FLL-QNM5HCPC','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(15,'FLL-GS4S3JBV','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),
(16,'FLL-2Q9SXPNS','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(17,'FLL-2Q9SXPNS','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',NULL,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(18,'FLL-2Q9SXPNS','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',NULL,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(19,'FLL-TP7NV3K9','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(20,'FLL-TP7NV3K9','2017-07-14','00:00:00','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','arrival and transport notes','',0,0,0,0,0,0,1,'',NULL,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(21,'FLL-5G7CVGKB','2017-07-14','00:00:00','43','4','','0','','','21','','','Additional Requirements','','',0,0,0,0,0,0,0,'',1,'No',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),
(22,'FLL-H8CF2HBP','2017-08-15','00:00:08','2','Select flight class','','Array','','0','0','','','Additional Requirements','','',0,0,0,0,0,0,0,'',1,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(23,'FLL-H8CF2HBP','2017-06-22','00:00:17','12','Select flight class','','0','','0','0','','','','','',0,0,0,0,0,0,0,'',NULL,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(24,'FLL-3J2R3HT4','2017-09-13','00:00:00','2','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','','',0,0,0,0,0,0,0,'',1,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(25,'FLL-3J2R3HT4','0000-00-00','00:00:06','6','Select flight class','','0','','0','0','','','','','',0,0,0,0,0,0,0,'',NULL,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(26,'FLL-WB3S7XNQ','2017-07-21','00:00:08','2','Select flight class','','Array','','0','0','','','Additional Requirements','','',0,0,0,0,0,0,0,'',1,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(27,'FLL-WB3S7XNQ','2017-07-13','00:00:03','4','Select flight class','','0','','0','0','','','','','',0,0,0,0,0,0,0,'',NULL,'No',0,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,''),
(28,'FLL-TTKT2KJS','2017-07-22','00:00:17','12','2','','Array','Array','56','69','0','','Additional Requirements','arr trans','',0,0,0,0,0,0,0,'',1,'No',1,'','0000-00-00 00:00:00','','','0000-00-00','0',NULL,'');

/*Table structure for table `fll_arrivals_drivers` */

DROP TABLE IF EXISTS `fll_arrivals_drivers`;

CREATE TABLE `fll_arrivals_drivers` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `arr_transport` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fll_arrivals_drivers` */

/*Table structure for table `fll_arrivals_rooms` */

DROP TABLE IF EXISTS `fll_arrivals_rooms`;

CREATE TABLE `fll_arrivals_rooms` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `arrival_id` int(8) NOT NULL,
  `room_type` int(3) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `fll_arrivals_rooms` */

insert  into `fll_arrivals_rooms`(`id`,`arrival_id`,`room_type`,`room_number`,`last_name`) values 
(1,1,54,'#113','GLN'),
(2,2,116,'1234','test1'),
(3,3,0,'Arr2 RoomNumb','Arr2 Guest Last'),
(4,4,0,'',''),
(5,5,0,'',''),
(6,6,0,'',''),
(7,7,0,'',''),
(8,8,0,'',''),
(9,9,0,'',''),
(10,10,0,'',''),
(11,11,175,'584','Smith'),
(12,12,172,'584',''),
(13,13,0,'',''),
(14,14,0,'',''),
(15,15,0,'',''),
(16,16,44,'',''),
(17,17,0,'',''),
(18,18,0,'',''),
(19,19,0,'',''),
(20,20,0,'',''),
(21,21,0,'',''),
(22,22,0,'',''),
(23,23,0,'',''),
(24,24,0,'',''),
(25,25,0,'',''),
(26,26,0,'',''),
(27,27,0,'',''),
(28,28,0,'',''),
(29,2,115,'123','test2');

/*Table structure for table `fll_arrivals_transports` */

DROP TABLE IF EXISTS `fll_arrivals_transports`;

CREATE TABLE `fll_arrivals_transports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `arrival_id` int(10) unsigned NOT NULL,
  `transport_mode` varchar(100) NOT NULL,
  `vehicle` int(8) unsigned DEFAULT NULL,
  `driver` int(8) unsigned DEFAULT NULL,
  `luggage_vehicle` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fll_arrivals_transports` */

insert  into `fll_arrivals_transports`(`id`,`arrival_id`,`transport_mode`,`vehicle`,`driver`,`luggage_vehicle`) values 
(1,3,'SUV\r\n',44,4,0),
(2,11,'Group Transfers',60,31,2),
(3,3,'SUV\r\n',33,6,0),
(4,3,'SUV\r\n',55,8,0);

/*Table structure for table `fll_bugs` */

DROP TABLE IF EXISTS `fll_bugs`;

CREATE TABLE `fll_bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `fll_bugs` */

insert  into `fll_bugs`(`id`,`bug_title`,`page`,`details`,`reporter`,`active`) values 
(1,'Email Not working on Bug','http://localhost/flights_project/bumblebee-fll/bug-report.php','When we report a bug, it should be emailed.','Creative Tech',1),
(2,'but','url','detail','Creative Tech',1),
(3,'tet','url','details','Creative Tech',1),
(4,'tet','url','details','Creative Tech',1),
(5,'tet','url','details','Creative Tech',1),
(6,'tet','url','details','Creative Tech',1),
(7,'tet','url','details','Creative Tech',1),
(8,'tet','url','details','Creative Tech',1),
(9,'tet','url','details','Creative Tech',1),
(10,'tet','url','details','Creative Tech',1),
(11,'tet','url','details','Creative Tech',1),
(12,'tet','url','details','Creative Tech',1),
(13,'tet','url','details','Creative Tech',1),
(14,'tet','url','details','Creative Tech',1),
(15,'tet','url','details','Creative Tech',1),
(16,'tet','url','details','Creative Tech',1),
(17,'tet','url','details','Creative Tech',1),
(18,'tet','url','details','Creative Tech',1),
(19,'Bug Title','URL','bug details','Creative Tech',1);

/*Table structure for table `fll_clientreqs` */

DROP TABLE IF EXISTS `fll_clientreqs`;

CREATE TABLE `fll_clientreqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reqs` varchar(255) NOT NULL,
  `section` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `fll_clientreqs` */

insert  into `fll_clientreqs`(`id`,`reqs`,`section`) values 
(1,'Lounge voucher',1),
(2,'Car hire',2),
(3,'Pre booked excursion',1),
(4,'Flowers/Chocolate',2),
(5,'Rum punch kit/Spice Kit',2),
(6,'Wine/Champange',2);

/*Table structure for table `fll_departures` */

DROP TABLE IF EXISTS `fll_departures`;

CREATE TABLE `fll_departures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(12) NOT NULL,
  `dpt_date` date NOT NULL,
  `dpt_time` int(11) NOT NULL,
  `dpt_flight_no` varchar(255) NOT NULL,
  `flight_class` varchar(255) NOT NULL,
  `dpt_transport` varchar(255) NOT NULL,
  `dpt_driver` varchar(255) NOT NULL,
  `dpt_vehicle` varchar(255) NOT NULL,
  `dpt_pickup` varchar(255) NOT NULL,
  `dpt_dropoff` varchar(255) NOT NULL,
  `dpt_pickup_time` varchar(5) NOT NULL,
  `dpt_notes` varchar(255) NOT NULL,
  `dpt_transport_notes` varchar(255) NOT NULL,
  `dpt_main` int(11) NOT NULL,
  `dpt_jet_center` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 = on, 0 = off',
  `fast_track` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `fll_departures` */

insert  into `fll_departures`(`id`,`ref_no_sys`,`dpt_date`,`dpt_time`,`dpt_flight_no`,`flight_class`,`dpt_transport`,`dpt_driver`,`dpt_vehicle`,`dpt_pickup`,`dpt_dropoff`,`dpt_pickup_time`,`dpt_notes`,`dpt_transport_notes`,`dpt_main`,`dpt_jet_center`,`fast_track`) values 
(1,'FLL-H4M882X2','2017-07-26',0,'','flight class not specified','','','','4','17','00:40','','',1,0,0),
(2,'FLL-TFB26QDX','2017-07-19',8,'2','5','','47','81','20','56','21:00','','departure and transport notes here',1,1,0),
(3,'FLL-TFB26QDX','2017-07-29',76,'48','6','','12','27','17','57','21:00','','departure 2 &amp; tport notes here',0,1,0),
(4,'FLL-GX9TTB9Y','2017-07-19',21,'14','6','','26','53','3','','21:25','','fsft dept and transport notes',1,1,0),
(5,'FLL-8C94DBDD','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','00:25','','',1,0,0),
(6,'FLL-P7SHFQFG','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','','00:25','','',1,0,0),
(7,'FLL-B9JPRFTS','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','03:30','','',1,0,0),
(8,'FLL-2YJJ5GQD','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','','03:50','','',1,0,0),
(9,'FLL-F7Z73C9K','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','03:50','','',1,0,0),
(10,'FLL-JQ296ZRB','2017-07-07',72,'44','7','','65','105','Pickup Location','Dropoff Location','18:50','','',1,0,0),
(11,'FLL-DPHXV7G5','2017-07-06',34,'21','5','','22','47','34','56','09:00','','',1,1,0),
(12,'FLL-P8P7HW4V','2017-07-18',73,'45','6','','76','117','Pickup Location','Dropoff Location','12:05','','',1,0,0),
(13,'FLL-QNM5HCPC','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','16:15','','',1,0,0),
(14,'FLL-GS4S3JBV','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','','13:20','','',1,0,0),
(15,'FLL-2Q9SXPNS','2017-08-17',0,'28','7','','41','73','14','9','14:25','','departure and transport notes',1,0,1),
(16,'FLL-2Q9SXPNS','0000-00-00',3,'4','2','','29','0','Pickup Location','Dropoff Location','14:25','','departure and transport notes2',0,0,0),
(17,'FLL-TP7NV3K9','2017-08-23',8,'2','flight class not specified','','','','4','4','14:50','','',1,0,1),
(18,'FLL-TP7NV3K9','0000-00-00',3,'4','flight class not specified','','','','4','4','14:50','','',0,0,0),
(19,'FLL-5G7CVGKB','2015-08-06',0,'0','Select flight class','','0','','Pickup Location','','12:25','','',1,0,1),
(20,'FLL-H8CF2HBP','2017-08-17',103,'6','Select flight class','','0','','Pickup Location','Dropoff Location','16:15','','',1,0,1),
(21,'FLL-H8CF2HBP','2017-07-05',13,'9','Select flight class','','0','','Pickup Location','Dropoff Location','16:15','','',0,0,1),
(22,'FLL-3J2R3HT4','2017-08-03',0,'','flight class not specified','','','','4','4','16:30','','',1,0,0),
(23,'FLL-3J2R3HT4','2017-07-04',17,'12','Select flight class','','0','','Pickup Location','Dropoff Location','16:30','','',0,0,0),
(24,'FLL-WB3S7XNQ','2017-08-11',100,'42','Select flight class','','0','','Pickup Location','Dropoff Location','16:40','','',1,0,1),
(25,'FLL-WB3S7XNQ','0000-00-00',6,'6','Select flight class','','0','','Pickup Location','Dropoff Location','16:40','','',0,0,0),
(26,'FLL-TTKT2KJS','2017-08-24',0,'8','5','','0','','Pickup Location','Dropoff Location','10:55','','',1,0,1);

/*Table structure for table `fll_departures_old` */

DROP TABLE IF EXISTS `fll_departures_old`;

CREATE TABLE `fll_departures_old` (
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

/*Data for the table `fll_departures_old` */

/*Table structure for table `fll_flightclass` */

DROP TABLE IF EXISTS `fll_flightclass`;

CREATE TABLE `fll_flightclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `fll_flightclass` */

insert  into `fll_flightclass`(`id`,`class`) values 
(1,'First Class'),
(2,'Club Class'),
(3,'Business Class'),
(4,'Upper Class'),
(5,'Premium Economy'),
(6,'Economy'),
(7,'World Traveler'),
(8,'World Traveller Plus');

/*Table structure for table `fll_flights` */

DROP TABLE IF EXISTS `fll_flights`;

CREATE TABLE `fll_flights` (
  `id_flight` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `fll_flights` */

insert  into `fll_flights`(`id_flight`,`flight_number`) values 
(1,'VS29'),
(2,'BA2155'),
(3,'AA1089'),
(4,'AA2393'),
(6,'AA1669'),
(7,'B6 1561'),
(8,'BW412'),
(9,'B6 661'),
(10,'LI772'),
(11,'LI390'),
(12,'AC966'),
(13,'WS2512'),
(14,'LI756'),
(15,'BW415'),
(16,'LI512'),
(17,'LI726'),
(18,'VS77'),
(19,'DE1258'),
(20,'LI523'),
(21,'LI769'),
(22,'BW466'),
(23,'LI738'),
(24,'LI560'),
(25,'LI362'),
(26,'LI771'),
(27,'LI391'),
(28,'BW414'),
(29,'LI371'),
(30,'LI760'),
(31,'LI521'),
(32,'BW457'),
(33,'DL483'),
(34,'DL697'),
(35,'BW458'),
(36,'BW459'),
(37,'BW456'),
(38,'TCX146P'),
(39,'US817'),
(40,'G3 7640'),
(41,'G3 7641'),
(42,'B6 1562'),
(43,'BW413'),
(44,'LI361'),
(45,'LI727'),
(46,'LI364'),
(47,'B6 662'),
(48,'LI755'),
(49,'AC967'),
(50,'VS30'),
(51,'WS2513'),
(52,'BA2154'),
(53,'LI768'),
(54,'LI513'),
(55,'VS78'),
(56,'DE1259'),
(57,'BW447'),
(58,'LI370'),
(59,'DL688'),
(60,'DL742'),
(61,'TCX147P'),
(62,'Vessel - Star Flyer');

/*Table structure for table `fll_flighttime` */

DROP TABLE IF EXISTS `fll_flighttime`;

CREATE TABLE `fll_flighttime` (
  `id_fltime` int(11) NOT NULL AUTO_INCREMENT,
  `id_flight` int(11) NOT NULL,
  `flight_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fltime`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

/*Data for the table `fll_flighttime` */

insert  into `fll_flighttime`(`id_fltime`,`id_flight`,`flight_time`) values 
(1,3,'13:31'),
(2,3,'14:40'),
(3,4,'20:46'),
(6,6,'19:10'),
(7,1,'14:30'),
(8,2,'14:55'),
(9,7,'1:28'),
(10,7,'2:38'),
(12,8,'6:45'),
(13,9,'13:05'),
(14,10,'13:15'),
(15,11,'13:20'),
(16,11,'13:50'),
(17,12,'13:45'),
(18,13,'14:47'),
(19,13,'14:52'),
(20,13,'14:55'),
(21,14,'15:40'),
(22,15,'16:50'),
(23,15,'17:25'),
(24,16,'16:50'),
(25,16,'17:30'),
(26,17,'17:00'),
(27,18,'17:30'),
(28,19,'19:15'),
(29,20,'19:15'),
(30,20,'20:05'),
(31,20,'20:00'),
(32,20,'20:50'),
(33,21,'19:40'),
(34,21,'20:30'),
(35,22,'20:35'),
(36,22,'20:55'),
(37,23,'23:15'),
(38,24,'7:00'),
(39,24,'8:00'),
(40,25,'7:30'),
(41,26,'19:45'),
(42,26,'20:35'),
(43,27,'20:00'),
(44,27,'20:50'),
(45,28,'8:50'),
(46,28,'9:30'),
(47,29,'11:05'),
(48,30,'11:20'),
(49,31,'11:35'),
(50,31,'12:20'),
(51,32,'20:15'),
(52,32,'20:50'),
(53,33,'13:44'),
(54,34,'14:17'),
(55,35,'8:55'),
(56,35,'8:30'),
(57,36,'19:35'),
(58,36,'20:10'),
(59,37,'8:55'),
(60,37,'9:30'),
(61,38,'18:25'),
(62,39,'14:40'),
(63,39,'15:30'),
(64,40,'16:35'),
(65,40,'17:35'),
(66,41,'9:25'),
(67,41,'10:25'),
(68,42,'2:24'),
(69,42,'3:34'),
(70,42,'3:40'),
(71,43,'7:15'),
(72,44,'8:30'),
(73,45,'12:10'),
(74,46,'14:05'),
(75,47,'14:10'),
(76,48,'13:55'),
(77,49,'14:45'),
(78,50,'17:00'),
(79,51,'15:34'),
(80,51,'15:45'),
(81,52,'17:15'),
(82,53,'17:50'),
(83,54,'17:40'),
(84,55,'19:55'),
(85,56,'21:15'),
(86,57,'21:05'),
(87,57,'21:30'),
(88,58,'8:15'),
(89,59,'14:34'),
(90,60,'15:12'),
(91,61,'20:10'),
(92,7,'15:20'),
(93,9,'3:20'),
(94,42,'3:20'),
(96,7,'20:40'),
(97,7,'20:35'),
(98,7,'1:34'),
(99,42,'2:30'),
(100,42,'2:25'),
(101,42,'7:45'),
(102,42,'7:40'),
(103,6,'8:00'),
(104,62,'6:00'),
(105,63,'01:30'),
(106,63,'04:30'),
(107,62,'09:00');

/*Table structure for table `fll_fsft_touroperator` */

DROP TABLE IF EXISTS `fll_fsft_touroperator`;

CREATE TABLE `fll_fsft_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `fll_fsft_touroperator` */

insert  into `fll_fsft_touroperator`(`id`,`tour_operator`,`amount`) values 
(1,'A & Kent','0.00'),
(2,'Abreu','0.00'),
(3,'Agaxtur BR','0.00'),
(4,'Alidays','0.00'),
(5,'Aspire','0.00'),
(6,'Aviva Group','0.00'),
(7,'Azure','0.00'),
(8,'British Airways','0.00'),
(9,'BAHolidays','0.00'),
(10,'Bailey Robinson','0.00'),
(11,'BeCuriou','0.00'),
(12,'Berge & Meer','0.00'),
(13,'Best Tours Italia','0.00'),
(14,'Blue Sky Luxury','0.00'),
(15,'Bookit','0.00'),
(16,'Caribbean Dest','0.00'),
(17,'Caribbean Island','0.00'),
(18,'CTS Horizons','0.00'),
(19,'CV Travel','0.00'),
(20,'Caribtours','0.00'),
(21,'City Discovery','0.00'),
(22,'Classic Collection','40.00'),
(23,'Classic Resorts','0.00'),
(24,'Colletts Resorts','0.00'),
(25,'Cox & Kings','0.00'),
(26,'Culsen Travel','0.00'),
(27,'Curitiba Tours','0.00'),
(28,'Designer Tours BR','0.00'),
(29,'Destinology','0.00'),
(30,'Diamond Air','0.00'),
(31,'Direct Booking','0.00'),
(32,'EFR Travel','0.00'),
(33,'Eden Collection','0.00'),
(34,'Escapade Caribbean','0.00'),
(35,'Eso Travel','0.00'),
(36,'Eurasia HWT','0.00'),
(37,'Expressions','0.00'),
(38,'Exsus Travel','0.00'),
(39,'Fischer','0.00'),
(40,'Friendship Travel','0.00'),
(41,'Global Travel/Dest 2','0.00'),
(42,'Gold Medal','0.00'),
(43,'Golden Caribbean','0.00'),
(44,'Harlequin','0.00'),
(45,'Hays Travel','0.00'),
(46,'Holiday Place','0.00'),
(47,'Holiday Services','0.00'),
(48,'HolidayBeds (Ireland)','0.00'),
(49,'Individual Holidays','0.00'),
(50,'Intimate Caribbean Holidays','0.00'),
(51,'Key2Holidays','0.00'),
(52,'Kuoni Zurich','0.00'),
(53,'Kuoni France','0.00'),
(54,'Kuoni Netherlands','0.00'),
(55,'Kuoni Spain (Madrid)','0.00'),
(56,'Kuoni UK','0.00'),
(57,'Kuoni UK (WCC)','0.00'),
(58,'La Fabbrica','0.00'),
(59,'Latino Travel','0.00'),
(60,'Latitude','0.00'),
(61,'Lusso Travel','0.00'),
(62,'Luxury Holiday Tours','0.00'),
(63,'Luxurytrips','0.00'),
(64,'MLT Vacations','0.00'),
(65,'MotMot Travel','0.00'),
(66,'Mundy Cruising','0.00'),
(67,'Naar Tours','0.00'),
(68,'Noks Film','0.00'),
(69,'North American Travel','0.00'),
(70,'Online Travel','0.00'),
(71,'Only Exclusive','0.00'),
(72,'Owners Syndicate','0.00'),
(73,'Pelikan Rejser','0.00'),
(74,'Pink Pearl','0.00'),
(75,'Pleasant Holidays','0.00'),
(76,'Presona Travel','0.00'),
(77,'Prestbury WW','0.00'),
(78,'Pure Luxury','0.00'),
(79,'Quadrante','0.00'),
(80,'Real Holidays','0.00'),
(81,'Rockwell','0.00'),
(82,'St James Travel & Tours','0.00'),
(83,'Scott Dunn','0.00'),
(84,'Seasons in Style','0.00'),
(85,'Simpson Exclusive','0.00'),
(86,'Slattery Travel','0.00'),
(87,'Sunburst Vacations','0.00'),
(88,'Sunlinc','0.00'),
(89,'Sunmaster','0.00'),
(90,'Sunny Holidays','0.00'),
(91,'Sunset Travel Ltd','0.00'),
(92,'Sunway Holidays','0.00'),
(93,'Sunwing','0.00'),
(94,'TC Germany','0.00'),
(95,'TC Group','0.00'),
(96,'TC Signature','0.00'),
(97,'TC Sport','0.00'),
(98,'Team America','0.00'),
(99,'Thomas WW','0.00'),
(100,'Titan Travel Ltd','0.00'),
(101,'Tourist Club','0.00'),
(102,'Trailfinders','0.00'),
(103,'Travco LLP','0.00'),
(104,'Travel 2/4','0.00'),
(105,'Travel City','0.00'),
(106,'Travel Factory','0.00'),
(107,'Travel Trend','0.00'),
(108,'Travel Value','0.00'),
(109,'Travel2','0.00'),
(110,'Tropic Breeze','0.00'),
(111,'Tropic Sky','0.00'),
(112,'Tropical Dest','0.00'),
(113,'Tropical Locations','0.00'),
(114,'Tropical Tours','0.00'),
(115,'Tropicalement','0.00'),
(116,'Turquoise Holidays','0.00'),
(117,'Travel Counsellors','0.00'),
(118,'Ultimate Travel','0.00'),
(119,'Value Added Travel','0.00'),
(120,'Viator','0.00'),
(121,'Vicino E Lontano','0.00'),
(122,'Voyageurs Du Monde','0.00'),
(123,'W & O','0.00'),
(124,'WT Vacations','0.00'),
(125,'WeTravel2','0.00'),
(126,'Wedd in Paradise','0.00'),
(127,'West Jet','0.00'),
(128,'White sand weddings','0.00'),
(129,'Wilderness Explorers','0.00'),
(130,'Virtuoso','0.00'),
(131,'ITC','0.00'),
(132,'Carrier','0.00'),
(133,'World Travel Holdings','0.00'),
(134,'Island Villas','0.00'),
(135,'Blue Anglia','0.00'),
(136,'Altman','30.00'),
(137,'London Life & Casualty','0.00'),
(138,'London Life IRC','0.00'),
(139,'Soutterham Bank','0.00'),
(140,'Accra Beach Hotel','40.00'),
(141,'B Away','0.00'),
(142,'Cruiseline - Star Clippers','0.00'),
(144,'Web Booking','0.00'),
(145,'Sandy Bay Hotel','30.00'),
(146,'Audley Travel','35.00');

/*Table structure for table `fll_guest` */

DROP TABLE IF EXISTS `fll_guest`;

CREATE TABLE `fll_guest` (
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
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1 COMMENT='Guest table';

/*Data for the table `fll_guest` */

insert  into `fll_guest`(`id`,`title_name`,`ref_no_sys`,`first_name`,`last_name`,`adult`,`child_age`,`infant_age`,`pnr`) values 
(1,'','FLL-V3HNRKJM','','',0,0,0,''),
(2,'','FLL-WVP98BVX','','',0,0,0,''),
(3,'','FLL-FK9VMC8Q','','',0,0,0,''),
(4,'','FLL-TBD65BDZ','','',0,0,0,''),
(5,'','FLL-HFKGTDR9','','',0,0,0,''),
(6,'','FLL-KHHSJPTR','First','Last',0,2,12,'PNR'),
(7,'','FLL-GBQC7KFW','First','Last',0,2,12,'PNR'),
(8,'','FLL-27WHD5H9','First','Last',0,2,12,'PNR'),
(9,'','FLL-M5V78MN6','First','Last',0,2,12,'PNR'),
(10,'','FLL-9HB8D539','First','Last',0,2,12,'PNR'),
(11,'Ms','FLL-WNDV4T2N','Beenish','Iqbal',1,1,1,'3432234'),
(12,'Mrs','FLL-WNDV4T2N','First','Last',0,1,1,'332234'),
(13,'Mrs','FLL-WNDV4T2N','Maham','Aftab',0,1,1,''),
(14,'','FLL-WNDV4T2N','Akeeba','Khan',0,0,0,''),
(15,'Mr','FLL-BMG9HD3G','Beenish','Iqbal Afridi',0,0,0,'323'),
(16,'Ms','FLL-NG9DFG22','Beenish','Iqbal Afridi',0,1,1,'#2342'),
(17,'Mrs','FLL-79SWJNDJ','Beenish','Iqbal Afridi',1,1,1,'#2342'),
(18,'Ms','FLL-NG9DFG22','Maham','Aftab',1,0,0,'#3332'),
(19,'Nauman','FLL-6PD9PHPQ','Nauman','Khan',1,1,0,'#f342'),
(20,'Afaq','FLL-6PD9PHPQ','Afaq','Asim',0,2,1,'#PNR243'),
(21,'Iqbal','FLL-6PD9PHPQ','Iqbal','Shahid',0,0,0,'#PNR456'),
(22,'Mrs','FLL-H3WPVNKS','First','Last',0,0,0,'PNR'),
(23,'Miss','FLL-H3WPVNKS','','',0,0,0,''),
(24,'','FLL-W9Z8BT9V','','',0,0,0,''),
(25,'Ms','FLL-8B3MPJWW','Shumaila','Malik',1,0,0,'PNR#001'),
(26,'Mr','FLL-8B3MPJWW','Abul','Malik',1,0,0,'PNR#002'),
(27,'Mr','FLL-8B3MPJWW','Zain','ul Abidin',0,0,0,'PNR#101'),
(28,'Ms','FLL-8B3MPJWW','Zaina','Malik',0,0,0,'PNR#102'),
(29,'Mr','FLL-BKHXR7XV','Zaina','Malik',1,0,0,'#102'),
(30,'','FLL-QZBBKJQC','First2','Last2',0,0,0,'PNR2'),
(31,'','FLL-QZBBKJQC','Zaina','Malik',0,0,0,'#102'),
(32,'','FLL-DY8JZZZ9','First2','Last2',0,0,0,'PNR2'),
(33,'','FLL-DY8JZZZ9','Zaina','Malik',0,0,0,'#102'),
(34,'','FLL-FBZDTH5F','First2','Last2',0,0,0,'PNR2'),
(35,'','FLL-FBZDTH5F','Zaina','Malik',0,0,0,'#102'),
(36,'','FLL-NZZ69N4D','First2','Last2',0,0,0,'PNR2'),
(37,'','FLL-NZZ69N4D','Zaina','Malik',0,0,0,'#102'),
(38,'','FLL-WDCFMYZF','First2','Last2',0,0,0,'PNR2'),
(39,'','FLL-WDCFMYZF','Zaina','Malik',0,0,0,'#102'),
(40,'','FLL-PKZWFTJQ','First2','Last2',0,0,0,'PNR2'),
(41,'','FLL-PKZWFTJQ','Zaina','Malik',0,0,0,'#102'),
(42,'','FLL-FJDY5DQX','First2','Last2',0,0,0,'PNR2'),
(43,'','FLL-FJDY5DQX','Zaina','Malik',0,0,0,'#102'),
(44,'','FLL-K4YQ9RBQ','First2','Last2',0,0,0,'PNR2'),
(45,'','FLL-K4YQ9RBQ','Zaina','Malik',0,0,0,'#102'),
(46,'','FLL-RFPDV89T','First2','Last2',0,0,0,'PNR2'),
(47,'','FLL-RFPDV89T','Zaina','Malik',0,0,0,'#102'),
(48,'','FLL-HG5Y39G5','First2','Last2',0,0,0,'PNR2'),
(49,'','FLL-HG5Y39G5','Zaina','Malik',0,0,0,'#102'),
(50,'','FLL-RZ2T4X3R','First2','Last2',0,0,0,'PNR2'),
(51,'','FLL-RZ2T4X3R','Zaina','Malik',0,0,0,'#102'),
(52,'Mr','FLL-W93H2HMF','Zaina1','Malik',0,0,0,'#102'),
(53,'Ms','FLL-W93H2HMF','Zaina2','Malik',0,0,0,'#102'),
(54,'Ms','FLL-W93H2HMF','Zaina3','Malik',0,0,0,'#102'),
(55,'Mr','FLL-WXNRKNXY','Zaina1','Malik',0,0,0,'#102'),
(56,'Ms','FLL-WXNRKNXY','Zaina2','Malik',0,0,0,'#102'),
(57,'Ms','FLL-WXNRKNXY','Zaina3','Malik',0,0,0,'#102'),
(58,'Mr','FLL-NBKP33RJ','First','Last',0,0,0,'Guest PNR'),
(59,'Mr','FLL-NBKP33RJ','Second','Last',0,0,0,'Guest PNR'),
(60,'Mr','FLL-NBKP33RJ','Third','Last',0,0,0,'Guest PNR'),
(61,'','FLL-SNZ7DSW3','','',0,0,0,''),
(62,'','FLL-R5JM29BV','','',0,0,0,''),
(63,'','FLL-KDKBWS7M','','',0,0,0,''),
(64,'','FLL-BMVFWZ49','','',0,0,0,''),
(65,'Mr','FLL-F42GDJWZ','','',0,0,0,''),
(66,'Mr','FLL-4KNDQ9VY','','',0,0,0,''),
(67,'','FLL-MVK5QV82','','',0,0,0,''),
(68,'','FLL-TWDSX5SV','','',0,0,0,''),
(69,'Mr','FLL-SJ7WKRDQ','','',0,0,0,''),
(70,'Mr','FLL-BMF9HD5T','','',0,0,0,''),
(71,'','FLL-X7KPGJTY','','',0,0,0,''),
(72,'','FLL-RYJF7DJW','','',0,0,0,''),
(73,'Mr','FLL-FXX7GW4Q','','',0,3,0,''),
(74,'','FLL-YM3G4CHG','','',0,0,0,''),
(75,'','FLL-BGR5BF4V','','',0,0,0,''),
(76,'','FLL-JY2T3DRD','','',0,0,0,''),
(77,'','FLL-WBTZDGZ3','','',0,0,0,''),
(78,'','FLL-5P3MY3YQ','','',0,0,0,''),
(79,'','FLL-JTQJSWG8','','',0,0,0,''),
(80,'','FLL-QD9GBCZM','','',0,0,0,''),
(81,'','FLL-27N25QGY','','',0,0,0,''),
(82,'','FLL-9XD2ZCG5','','',0,0,0,''),
(83,'','FLL-D22V2B6V','','',0,0,0,''),
(84,'Ms','FLL-CBX3JB72','Beenish','Haider',0,0,0,''),
(85,'','FLL-P4BQDSGM','','',0,0,0,''),
(86,'','FLL-9MRD2B8R','','',0,0,0,''),
(87,'','FLL-MQVX5CQC','','',0,0,0,''),
(88,'','FLL-N3SHD2Y4','','',0,0,0,''),
(89,'','FLL-WMN4P79X','','',0,0,0,''),
(90,'','FLL-56WBGXWZ','','',0,0,0,''),
(91,'','FLL-88GCSZPD','','',0,0,0,''),
(92,'','FLL-3MHSFTRK','','',0,0,0,''),
(93,'','FLL-CWX36F54','','',0,0,0,''),
(94,'','FLL-VDQYNHZW','','',0,0,0,''),
(95,'','FLL-G23HY4RZ','','',0,0,0,''),
(96,'Mr','FLL-TJ4V5Q2W','James','Sandiford',1,0,0,''),
(97,'Miss','FLL-TJ4V5Q2W','Danya','Sandiford',0,10,0,''),
(98,'Master','FLL-TJ4V5Q2W','John','Sandiford',0,0,9,''),
(99,'Mrs','FLL-5QFWC54G','Olivia','Frank',1,0,0,''),
(100,'Miss','FLL-5QFWC54G','Jane','Franks',0,4,0,''),
(101,'Mrs','FLL-34WZ5R55','Jan','Small',1,0,0,''),
(102,'Ms','FLL-34WZ5R55','Anna','Small',0,10,0,''),
(103,'Master','FLL-34WZ5R55','John','Small',0,0,6,''),
(104,'','FLL-34WZ5R55','','',0,0,0,''),
(105,'','FLL-DFH6YKWZ','','',0,0,0,''),
(106,'','FLL-4STB59Y9','','',0,0,0,''),
(107,'Mr','FLL-TDTHYH97','Amount Test','Amount Test',1,1,1,'111'),
(108,'','FLL-DXNH952S','','',0,0,0,''),
(109,'','FLL-P74XYNRY','','',0,0,0,''),
(110,'','FLL-ZG7BN6H4','','',0,0,0,''),
(111,'Mr','FLL-YF39VR47','abx','xyz',1,1,0,'111'),
(112,'','FLL-44C2Z7RX','','',0,0,0,''),
(113,'','FLL-Q3D6XWV4','','',0,0,0,''),
(114,'','FLL-RDDV2KB6','','',0,0,0,''),
(115,'Mr','FLL-WGT8CZ9N','Testing Sir','Testing Sir Last',1,0,0,'Test Guest PNR 123'),
(116,'Ms','FLL-WGT8CZ9N','Child Test First','Child Test Last',0,5,0,'Child Test PNR456'),
(117,'Mr','FLL-WGT8CZ9N','Child 2 Test First','Child 2 Test Last',0,0,11,'Child 2 Test PNR 789'),
(118,'Mr','FLL-38BTM48H','Rolando','Last Name',1,0,0,'Ro PNR 123'),
(119,'Ms','FLL-38BTM48H','Naomi','Last Name',0,11,0,'Naomi PNE 456'),
(120,'Mr','FLL-38BTM48H','Nate','Last Name',0,0,12,'Nate PNR 789'),
(121,'','FLL-C8RK49PG','abc','xyz',0,1,1,'PNR'),
(122,'Mr','FLL-5VDZX22R','abc17','xyz17',0,0,0,'PNR'),
(123,'','FLL-2BNYPZ8R','','',0,0,0,''),
(124,'Mr','FLL-H4M882X2','first','Last',0,0,0,'GLN'),
(125,'Mr','FLL-TFB26QDX','1 Guest','1 Guest Last',1,0,0,'1 Gst PNR 123'),
(126,'Ms','FLL-TFB26QDX','1guest2','1 guest2 last',0,11,0,'1 guest2 pnr 4567'),
(127,'Master','FLL-TFB26QDX','1 guest 3','1 guest3 last',0,0,6,'1 guest3 pnr 4567'),
(128,'Dr','FLL-GX9TTB9Y','FSFT Guest 1','FSFT Guest 1 Last',1,0,0,'FSFT Guest 1 PNR'),
(129,'Dr','FLL-GX9TTB9Y','add guest testing First','add guest testing Last',1,0,0,'add guest testing PNR'),
(130,'','FLL-8C94DBDD','','',0,0,0,''),
(131,'','FLL-P7SHFQFG','','',0,0,0,''),
(132,'','FLL-B9JPRFTS','','',0,0,0,''),
(133,'','FLL-2YJJ5GQD','','',0,0,0,''),
(134,'','FLL-F7Z73C9K','','',0,0,0,''),
(135,'','FLL-JQ296ZRB','','',0,0,0,''),
(136,'Mrs','FLL-DPHXV7G5','Jane','Smith',1,0,0,'584PWQ43'),
(137,'Miss','FLL-DPHXV7G5','Nancy','Smith',0,5,0,'584PWQ43'),
(138,'Miss','FLL-DPHXV7G5','Lily','Smith',0,0,12,'584PWQ43'),
(139,'','FLL-P8P7HW4V','','',0,0,0,''),
(140,'Lady','FLL-QNM5HCPC','Lola','Carlton',1,0,0,'584984'),
(141,'Miss','FLL-QNM5HCPC','Baby','Carlton',0,1,0,'584984'),
(142,'Mr','FLL-QNM5HCPC','Rodney','Carlton',0,0,9,'584984'),
(143,'Mr','FLL-GS4S3JBV','fname','lname',0,0,0,''),
(144,'Mr','FLL-2Q9SXPNS','fname22','lna2',0,0,0,'gpnr231'),
(145,'Mr','FLL-TP7NV3K9','fname33','lname3',0,0,0,'gpnr2233'),
(146,'Mr','FLL-5G7CVGKB','fname','lname',0,0,0,'gpnr'),
(147,'','FLL-H8CF2HBP','','',0,0,0,''),
(148,'','FLL-3J2R3HT4','','',0,0,0,''),
(149,'','FLL-WB3S7XNQ','','',0,0,0,''),
(150,'Mr','FLL-TTKT2KJS','fname','lname',0,1,1,'gpnr');

/*Table structure for table `fll_loc_coast` */

DROP TABLE IF EXISTS `fll_loc_coast`;

CREATE TABLE `fll_loc_coast` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `coast` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fll_loc_coast` */

insert  into `fll_loc_coast`(`id`,`coast`) values 
(1,'East Coast'),
(2,'West Coast'),
(3,'North Coast'),
(4,'South Coast');

/*Table structure for table `fll_location` */

DROP TABLE IF EXISTS `fll_location`;

CREATE TABLE `fll_location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone` int(4) NOT NULL DEFAULT '0',
  `sorting_order` varchar(255) NOT NULL,
  `loc_code` varchar(6) NOT NULL DEFAULT '000',
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

/*Data for the table `fll_location` */

insert  into `fll_location`(`id_location`,`name`,`zone`,`sorting_order`,`loc_code`) values 
(2,'Sandals Barbados',4,'','0'),
(3,'Tamarind - Elegant',2,'','0'),
(4,'Accra Beach Hotel',4,'','0'),
(5,'All Seasons Resorts',2,'','0'),
(7,'Amaryllis Beach Resorts',4,'','0'),
(8,'Aquatica',4,'','0'),
(9,'Atlanits Hotel',1,'','0'),
(10,'Barbados Beach Club',4,'','0'),
(11,'Beach View',2,'','0'),
(12,'Blue Orchid Beach Hotel',4,'','0'),
(13,'Bougainvillea Beach Resorts',4,'','0'),
(14,'Butterfly Beach Hotel',4,'','0'),
(15,'Cobblers Cove',3,'','0'),
(16,'Coconut Court',4,'','0'),
(17,'Colony Club Hotel - Elegant',2,'','0'),
(18,'Coral Mist Beach Hotel',4,'','0'),
(19,'Coral Reef Club',2,'','0'),
(20,'Coral Sands Beach Resort',4,'','0'),
(21,'Crystal Cove Hotel - Elegant',2,'','0'),
(22,'Discovery Bay Hotel',2,'','0'),
(23,'Divi Southwinds Beach Resorts',4,'','0'),
(24,'Hilton Barbados',4,'','0'),
(25,'Little Arches Hotel',4,'','0'),
(26,'Little Good Harbour',2,'','0'),
(27,'Mango Bay Hotel &amp; Beach Club',2,'','0'),
(28,'Marriott Courtyard',4,'','0'),
(29,'Ocean Two Resort &amp; Residences',4,'','0'),
(30,'Pirates Inn',4,'','0'),
(31,'Port St. Charles',3,'','0'),
(32,'Rostrevor Apartments Hotel',4,'','0'),
(33,'Royal Westmoreland',2,'','0'),
(34,'Sandy Lane Hotel',2,'','0'),
(35,'Savannah Hotel',4,'','0'),
(36,'Sea Breeze Beach Hotel',4,'','0'),
(37,'Settlers Beach',2,'','0'),
(38,'Silver Point Hotel',4,'','0'),
(39,'South Beach Resort &amp; Vacation Club',4,'','0'),
(40,'South Gap Hotel',4,'','0'),
(41,'Southern Palms Beach Club',4,'','0'),
(42,'Sugar Cane Club Hotel &amp; Spa',3,'','0'),
(43,'The Club Barbados ',2,'','0'),
(44,'The Crane Beach',1,'','0'),
(45,'The House - Elegant',2,'','0'),
(46,'The Sandpiper Hotel',2,'','0'),
(47,'Time Out At The Gap',4,'','0'),
(48,'Treasure Beach Hotel',2,'','0'),
(49,'Turtle Beach hotel - Elegant',4,'','0'),
(50,'Waves Hotel &amp; Spa',2,'','0'),
(51,'Worthing Court Apartment Hotel',4,'','0'),
(52,'Yellow Bird Hotel',4,'','0'),
(55,'Dover Beach Hotel',4,'','0'),
(56,'Airport',4,'','0'),
(57,'Seaport',0,'','0'),
(59,'Z - Cove Spring',2,'','0'),
(60,'Z - Dene Court Villa',2,'','0'),
(61,'Z - Villa Elsewhere',2,'','0'),
(62,'Z - Land Fall Villa',2,'','0'),
(63,'Z - Mon Caprice',2,'','0'),
(64,'Z - Porters Great House',3,'','0'),
(65,'Z - Saramanda',3,'','0'),
(66,'Z - Jane&#039;s Harbour',2,'','0'),
(67,'Z - Trade Winds',2,'','0'),
(69,'Port Ferdinand',3,'','0'),
(70,'St. Peters Bay',3,'','0'),
(71,'Z - Alan Bay Cottage',0,'','0'),
(72,'Z - Bluff House',0,'','0'),
(73,'Z - Alleyne Aguilar &amp; Altman Ltd',0,'','0'),
(75,'Z - Land Mark Cottage',0,'','0'),
(76,'Z - Lascelles House',0,'','0'),
(77,'Z - Leamington Cottage',0,'','0'),
(78,'Z - Leamington House',0,'','0'),
(79,'Z - Mahogany House',0,'','0'),
(80,'Z - Merlin Bay #1',0,'','0'),
(81,'Z - Milord',0,'','0'),
(82,'Z - Moon Reach Villa',0,'','0'),
(83,'Z - Mullins Hill',0,'','0'),
(84,'Z - Mullins View',0,'','0'),
(85,'Z - Nelson Gay',0,'','0'),
(86,'Z - Nirvana',0,'','0'),
(87,'Z - Nutmeg',0,'','0'),
(88,'Z - Oceans Edge',0,'','0'),
(89,'Z - Overlook',3,'','0'),
(90,'Z - Osyter Bay ',2,'','0'),
(91,'Z - Pink Cottage',0,'','0'),
(92,'Z - Port St.Charles Villas',3,'','0'),
(93,'Z - Reed House',0,'','0'),
(94,'Z - Penthouse',0,'','0'),
(95,'Z - Ground Floor Unit',0,'','0'),
(96,'Z - Sandbox Villa',0,'','0'),
(98,'Z - Sara Moon',0,'','0'),
(99,'Z - Sea Horse Villa',0,'','0'),
(100,'Z - Sea Isle Villa',0,'','0'),
(101,'Z - Sea Scape House',0,'','0'),
(102,'Z - Secret Garden',0,'','0'),
(103,'Z - Senderlea',0,'','0'),
(104,'Z - Spring Head',0,'','0'),
(105,'Z - Sundown',0,'','0'),
(106,'Z - Tara',0,'','0'),
(107,'Z- Tamarind Cottage',0,'','0'),
(108,'Z - Turtle Nest',0,'','0'),
(109,'Z - Turtle Reach',0,'','0'),
(110,'Z - Valial',0,'','0'),
(112,'Z - Villa Lagoon',0,'','0'),
(113,'Z - Villa Melissa',0,'','0'),
(114,'Z - Villas on the Beach',0,'','0'),
(115,'Z - Villa St. Lucy',0,'','0'),
(116,'Z - Vistamar',0,'','0'),
(117,'Z - Wales End',0,'','0'),
(118,'Z - Waverly Villa #1',0,'','0'),
(119,'Z - Westshore',0,'','0'),
(120,'Z - Westhaven',0,'','0'),
(121,'Z - White Caps',0,'','0'),
(122,'Z - White gates',0,'','0'),
(123,'Z - Windward',0,'','0'),
(124,'Z - Y Not',0,'','0'),
(125,'Z - Jacaranda',0,'','0'),
(126,'Z - The Dream',0,'','0'),
(127,'Z - Summerland Villas',0,'','0'),
(128,'Z - Villa Bonavista',0,'','0'),
(129,'Z - High Trees',0,'','0'),
(130,'Testing Hotel',3,'','0');

/*Table structure for table `fll_luggage_vehicle` */

DROP TABLE IF EXISTS `fll_luggage_vehicle`;

CREATE TABLE `fll_luggage_vehicle` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fll_luggage_vehicle` */

insert  into `fll_luggage_vehicle`(`id`,`vehicle`) values 
(1,'Luggage Car'),
(2,'Luggage Van'),
(3,'Luggage Truck');

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

/*Table structure for table `fll_rep_services` */

DROP TABLE IF EXISTS `fll_rep_services`;

CREATE TABLE `fll_rep_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(80) NOT NULL,
  `section` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `fll_rep_services` */

insert  into `fll_rep_services`(`id`,`service`,`section`) values 
(1,'Meet & Greet Service',0),
(2,'Full Rep Service',0),
(3,'No Rep Service',0),
(4,'Telephone Service',0),
(5,'Intrasit Service',2),
(6,'Arrival FSFT Service',1),
(7,'Departure FSFT Service',1);

/*Table structure for table `fll_reports` */

DROP TABLE IF EXISTS `fll_reports`;

CREATE TABLE `fll_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `setting` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fsft` int(2) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `fll_reports` */

insert  into `fll_reports`(`id`,`name`,`setting`,`user_id`,`fsft`,`created_date`) values 
(6,'Test report','[{\"name\":\"reportName\",\"value\":\"Test report\"},{\"name\":\"reportId\",\"value\":\"6\"},{\"name\":\"R.id::Id\",\"value\":\"1\"},{\"name\":\"R.title_name::Title_Name\",\"value\":\"1\"},{\"name\":\"R.first_name::First_Name\",\"value\":\"1\"},{\"name\":\"R.last_name::Last_Name\",\"value\":\"1\"},{\"name\":\"R.pnr::PNR\",\"value\":\"1\"},{\"name\":\"R.G.title_name::Guest_Title_Name\",\"value\":\"1\"}]',19,0,'0000-00-00 00:00:00'),
(17,'Testing','[{\"name\":\"reportName\",\"value\":\"Testing\"},{\"name\":\"reportId\",\"value\":\"17\"},{\"name\":\"R.id::Id\",\"value\":\"1\"},{\"name\":\"R.title_name::Title_Name\",\"value\":\"1\"},{\"name\":\"R.first_name::First_Name\",\"value\":\"1\"},{\"name\":\"R.last_name::Last_Name\",\"value\":\"1\"},{\"name\":\"R.pnr::PNR\",\"value\":\"1\"}]',19,1,'2017-06-05 15:26:58'),
(20,'FSFT Full Test','[{\"name\":\"reportName\",\"value\":\"FSFT Full Test\"},{\"name\":\"reportId\",\"value\":\"\"},{\"name\":\"R.id::Id\",\"value\":\"1\"},{\"name\":\"R.title_name::Title_Name\",\"value\":\"1\"},{\"name\":\"R.first_name::First_Name\",\"value\":\"1\"},{\"name\":\"R.last_name::Last_Name\",\"value\":\"1\"},{\"name\":\"R.pnr::PNR\",\"value\":\"1\"},{\"name\":\"R.sup_total_amount::Total_Supplier_Amount\",\"value\":\"1\"},{\"name\":\"R.G.title_name::Guest_Title_Name\",\"value\":\"1\"},{\"name\":\"R.G.first_name::Guest_First_Name\",\"value\":\"1\"},{\"name\":\"R.G.last_name::Guest_Last_Name\",\"value\":\"1\"},{\"name\":\"R.G.adult::Guest_Adult\",\"value\":\"1\"},{\"name\":\"R.G.child_age::Guest_Child_Age\",\"value\":\"1\"},{\"name\":\"R.G.infant_age::Guest_Infant_Age\",\"value\":\"1\"},{\"name\":\"R.G.pnr::Guest_PNR\",\"value\":\"1\"},{\"name\":\"R.A.arr_date::Arr_Date\",\"value\":\"1\"},{\"name\":\"R.A.arr_time::Arr_Time\",\"value\":\"1\"},{\"name\":\"R.A.arr_flight_no::Arr_Flight\",\"value\":\"1\"},{\"name\":\"R.A.flight_class::Arr_Flight_Class\",\"value\":\"1\"},{\"name\":\"R.A.arr_transport::Arr_Transport\",\"value\":\"1\"},{\"name\":\"R.A.arr_driver::Arr_Driver\",\"value\":\"1\"},{\"name\":\"R.A.arr_vehicle::Arr_Vehicle\",\"value\":\"1\"},{\"name\":\"R.A.arr_pickup::Arr_Pickup\",\"value\":\"1\"},{\"name\":\"R.A.arr_dropoff::Arr_Dropoff\",\"value\":\"1\"},{\"name\":\"R.A.room_type::Arr_Room_Type\",\"value\":\"1\"},{\"name\":\"R.A.rep_type::Arr_Rep_Type\",\"value\":\"1\"},{\"name\":\"R.A.client_reqs::Arr_Client_Reqs\",\"value\":\"1\"},{\"name\":\"R.A.arr_transport_notes::Arr_Transport_Notes\",\"value\":\"1\"},{\"name\":\"R.A.arr_hotel_notes::Arr_Hotel_Notes\",\"value\":\"1\"},{\"name\":\"R.A.infant_seats::Arr_Infant_Seats\",\"value\":\"1\"},{\"name\":\"R.A.child_seats::Arr_Child_Seats\",\"value\":\"1\"},{\"name\":\"R.A.booster_seats::Arr_Booster_Seats\",\"value\":\"1\"},{\"name\":\"R.A.vouchers::Arr_Vouchers\",\"value\":\"1\"},{\"name\":\"R.A.cold_towel::Arr_Cold_Towel\",\"value\":\"1\"},{\"name\":\"R.A.bottled_water::Arr_Bottled_Water\",\"value\":\"1\"},{\"name\":\"R.A.rooms::Arr_Rooms\",\"value\":\"1\"},{\"name\":\"R.A.room_no::Arr_Room\",\"value\":\"1\"},{\"name\":\"R.A.arr_main::Arr_Main\",\"value\":\"1\"},{\"name\":\"R.A.luggage_vehicle::Arr_Lagguage_Vehicle\",\"value\":\"1\"},{\"name\":\"R.A.excursion_name::Arr_Excursion_Name\",\"value\":\"1\"},{\"name\":\"R.A.excursion_date::Arr_Excursion_Date\",\"value\":\"1\"},{\"name\":\"R.A.excursion_pickup::Arr_Excursion_Pickup\",\"value\":\"1\"},{\"name\":\"R.A.excursion_confirm_by::Arr_Excursion_Confirm_By\",\"value\":\"1\"},{\"name\":\"R.A.excursion_confirm_date::Arr_Confirm_Date\",\"value\":\"1\"},{\"name\":\"R.A.excursion_guests::Arr_Excursion_Guests\",\"value\":\"1\"},{\"name\":\"R.A.arr_rooms::Arr_Rooms\",\"value\":\"1\"},{\"name\":\"R.A.room_last_name::Arr_Room_Last_Name\",\"value\":\"1\"},{\"name\":\"R.D.dpt_date::Dept_Date\",\"value\":\"1\"},{\"name\":\"R.D.dpt_time::Dept_Time\",\"value\":\"1\"},{\"name\":\"R.D.dpt_flight_no::Dept_Flight\",\"value\":\"1\"},{\"name\":\"R.D.flight_class::Dept_Flight_Class\",\"value\":\"1\"},{\"name\":\"R.D.dpt_transport::Dept_Transport\",\"value\":\"1\"},{\"name\":\"R.D.dpt_driver::Dept_Driver\",\"value\":\"1\"},{\"name\":\"R.D.dpt_vehicle::Dept_Vehicle\",\"value\":\"1\"},{\"name\":\"R.D.dpt_pickup::Dept_Pickup\",\"value\":\"1\"},{\"name\":\"R.D.dpt_dropoff::Dept_Dropoff\",\"value\":\"1\"},{\"name\":\"R.D.dpt_pickup_time::Dept_Pickup_Time\",\"value\":\"1\"},{\"name\":\"R.D.dpt_notes::Dept_Notes\",\"value\":\"1\"},{\"name\":\"R.D.dpt_transport_notes::Dept_Transport_Notes\",\"value\":\"1\"},{\"name\":\"R.D.dpt_main::Dept_Main\",\"value\":\"1\"},{\"name\":\"R.D.dpt_jet_center::Dept_Jet_Center\",\"value\":\"1\"}]',9,1,'2017-06-09 15:12:55'),
(23,'Arrival Test Report','[{\"name\":\"reportName\",\"value\":\"Arrival Test Report\"},{\"name\":\"reportId\",\"value\":\"\"},{\"name\":\"R.id::Id\",\"value\":\"1\"},{\"name\":\"R.title_name::Title_Name\",\"value\":\"1\"},{\"name\":\"R.first_name::First_Name\",\"value\":\"1\"},{\"name\":\"R.last_name::Last_Name\",\"value\":\"1\"},{\"name\":\"R.pnr::PNR\",\"value\":\"1\"},{\"name\":\"R.T.tour_operator::Tour_Operator\",\"value\":\"1\"},{\"name\":\"R.operator_code::Operator_Code\",\"value\":\"1\"},{\"name\":\"R.tour_ref_no::Reference_No\",\"value\":\"1\"},{\"name\":\"R.adult::Adult\",\"value\":\"1\"},{\"name\":\"R.child::Child\",\"value\":\"1\"},{\"name\":\"R.infant::Infant\",\"value\":\"1\"},{\"name\":\"R.id::A_C_I\",\"value\":\"1\"},{\"name\":\"R.tour_notes::Tour_Notes\",\"value\":\"1\"},{\"name\":\"R.G.title_name::Guest_Title_Name\",\"value\":\"1\"},{\"name\":\"R.G.first_name::Guest_First_Name\",\"value\":\"1\"},{\"name\":\"R.G.last_name::Guest_Last_Name\",\"value\":\"1\"},{\"name\":\"R.G.pnr::Guest_PNR\",\"value\":\"1\"},{\"name\":\"R.G.adult::Guest_Adult\",\"value\":\"1\"},{\"name\":\"R.G.child_age::Guest_Child_Age\",\"value\":\"1\"},{\"name\":\"R.G.infant_age::Guest_Infant_Age\",\"value\":\"1\"},{\"name\":\"R.A.arr_date::Arr_Date\",\"value\":\"1\"},{\"name\":\"R.A.fast_track::Fast_Track\",\"value\":\"1\"},{\"name\":\"R.FAR.flight_number::Arr_Flight\",\"value\":\"1\"},{\"name\":\"R.A.arr_time::Arr_Time\",\"value\":\"1\"},{\"name\":\"R.FCA.class::Arr_Flight_Class\",\"value\":\"1\"},{\"name\":\"R.A.arr_transport::Arr_Transport\",\"value\":\"1\"},{\"name\":\"R.DDA.name::Arr_Driver\",\"value\":\"1\"},{\"name\":\"R.AV.name::Arr_Vehicle\",\"value\":\"1\"},{\"name\":\"R.A.arr_transport_notes::Arr_and_Transport_Notes\",\"value\":\"1\"},{\"name\":\"R.AL.name::Arr_Pickup\",\"value\":\"1\"},{\"name\":\"R.ADL.name::Arr_Dropoff\",\"value\":\"1\"},{\"name\":\"R.RP.rep_type::Arr_Rep_Type\",\"value\":\"1\"},{\"name\":\"R.A.client_reqs::Arr_Client_Reqs\",\"value\":\"1\"},{\"name\":\"R.A.infant_seats::Arr_Infant_Seats\",\"value\":\"1\"},{\"name\":\"R.A.child_seats::Arr_Child_Seats\",\"value\":\"1\"},{\"name\":\"R.A.booster_seats::Arr_Booster_Seats\",\"value\":\"1\"},{\"name\":\"R.A.vouchers::Arr_Vouchers\",\"value\":\"1\"},{\"name\":\"R.A.cold_towel::Arr_Cold_Towel\",\"value\":\"1\"},{\"name\":\"R.A.bottled_water::Arr_Bottled_Water\",\"value\":\"1\"},{\"name\":\"R.A.luggage_vehicle::Arr_Lagguage_Vehicle\",\"value\":\"1\"},{\"name\":\"R.A.excursion_name::Arr_Excursion_Name\",\"value\":\"1\"},{\"name\":\"R.A.excursion_date::Arr_Excursion_Date\",\"value\":\"1\"},{\"name\":\"R.A.excursion_pickup::Arr_Excursion_Pickup\",\"value\":\"1\"},{\"name\":\"R.A.excursion_confirm_by::Arr_Excursion_Confirm_By\",\"value\":\"1\"},{\"name\":\"R.A.excursion_confirm_date::Arr_Confirm_Date\",\"value\":\"1\"},{\"name\":\"R.A.excursion_guests::Arr_Excursion_Guests\",\"value\":\"1\"},{\"name\":\"R.ADL.name::Hotel_Arr_Dropoff\",\"value\":\"1\"},{\"name\":\"R.RA.room_type::Arr_Room_Type\",\"value\":\"1\"},{\"name\":\"R.A.rooms::Arr_No_of_Rooms\",\"value\":\"1\"},{\"name\":\"R.A.room_no::Arr_Room\",\"value\":\"1\"},{\"name\":\"R.A.room_last_name::Arr_Room_Last_Name\",\"value\":\"1\"},{\"name\":\"R.LC.coast::Zone\",\"value\":\"1\"},{\"name\":\"R.ADL.loc_code::Code\",\"value\":\"1\"},{\"name\":\"R.A.arr_hotel_notes::Arr_Hotel_Notes\",\"value\":\"1\"},{\"name\":\"R.RAR.room_type::Additional_Room_Type\",\"value\":\"1\"},{\"name\":\"R.AR.room_number::Additional_Room_Number\",\"value\":\"1\"},{\"name\":\"R.AR.last_name::Additional_Last_Name\",\"value\":\"1\"},{\"name\":\"R.AT.transport_mode::Additional_Transport_Mode\",\"value\":\"1\"},{\"name\":\"R.ATD.name::Additional_Transport_Supplier\",\"value\":\"1\"},{\"name\":\"R.ATV.name::Additional_Vehicle\",\"value\":\"1\"}]',9,0,'2017-06-28 16:34:53');

/*Table structure for table `fll_reps` */

DROP TABLE IF EXISTS `fll_reps`;

CREATE TABLE `fll_reps` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `fll_reps` */

insert  into `fll_reps`(`id_rep`,`name`) values 
(1,'Allan Grannum'),
(2,'Nikki Grannum'),
(3,'Rhema Daisley'),
(4,'Shavanare Oliver'),
(5,'Autumn Crichlow'),
(6,'Sandra Cheeseman'),
(7,'Gloria Garnes'),
(8,'Janet Armstrong'),
(9,'Carroll Hooper'),
(10,'Rosaline Francis'),
(11,'Susan Parris'),
(12,'Natalia Nunes'),
(13,'Qwayne Ifill'),
(14,'Sylvia Boxhill'),
(15,'Francisca Deane'),
(16,'Carolyn Blackman'),
(17,'Cheryl Sillivan'),
(18,'Rose Millington'),
(19,'Marion Clarke'),
(20,'Berit Jordan'),
(21,'Jenny Banfield'),
(22,'Roslyn Sardine'),
(23,'Shanad Snagg'),
(24,'Antoinette John');

/*Table structure for table `fll_reptype` */

DROP TABLE IF EXISTS `fll_reptype`;

CREATE TABLE `fll_reptype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `fll_reptype` */

insert  into `fll_reptype`(`id`,`rep_type`) values 
(1,'Meet & Greet'),
(2,'Full Rep'),
(3,'No Rep'),
(4,'Italian Rep'),
(5,'German Rep'),
(6,'Spanish Rep'),
(7,'French Rep'),
(8,'Russian Rep'),
(9,'Intransit'),
(10,'Telephone Service');

/*Table structure for table `fll_resdrivers` */

DROP TABLE IF EXISTS `fll_resdrivers`;

CREATE TABLE `fll_resdrivers` (
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `fll_resdrivers` */

insert  into `fll_resdrivers`(`id_driver`,`transport`,`vehicle`,`ref_no_sys`,`adult`,`child`,`infant`,`tour_operator`,`location`,`pickup_time`,`comments`,`rate`,`flight_time`,`flight_no`,`infant_seats`,`child_seats`,`booster_seats`,`title_name`,`first_name`,`last_name`,`transport_date`,`res_type`) values 
(1,0,0,'FLL-H4M882X2',1,1,0,1,0,'','','25%','','0',0,0,0,'Mr','first','Last','2017-07-20',1),
(2,0,0,'FLL-TFB26QDX',6,2,8,53,56,'3','arr &amp; tport note test 1','25%','3','4',2,3,1,'Mr','Tess 1','Tess 1','2017-06-23',1),
(3,47,81,'FLL-TFB26QDX',6,2,8,53,20,'21:00','departure and transport notes here','25%','8','2',2,3,1,'Mr','Tess 1','Tess 1','2017-07-19',2),
(4,53,92,'FLL-GX9TTB9Y',6,12,8,140,0,'26','FSFT Arrival and transport notes test','25%','26','17',6,6,6,'Sir','FSFT First','FSFT Last','2017-06-30',1),
(5,26,53,'FLL-GX9TTB9Y',6,12,8,140,3,'21:25','fsft dept and transport notes','25%','21','14',6,6,6,'Sir','FSFT First','FSFT Last','2017-07-19',2),
(6,0,0,'FLL-8C94DBDD',0,0,0,1,0,'','','25%','','0',0,0,0,'Mr','abc','xyz','2017-07-12',1),
(7,0,0,'FLL-B9JPRFTS',0,0,0,1,0,'','','25%','','0',0,0,0,'','Abc19','xyz19','2017-07-19',1),
(8,0,0,'FLL-F7Z73C9K',0,0,0,142,0,'','','25%','','0',0,0,0,'','Abc22','xyz22','2017-07-19',1),
(9,0,0,'FLL-JQ296ZRB',0,0,0,56,56,'83','','25%','83','54',0,0,0,'Mr','John','Taylor','2017-06-30',1),
(10,65,105,'FLL-JQ296ZRB',0,0,0,56,0,'18:50','','25%','72','44',0,0,0,'Mr','John','Taylor','2017-07-07',2),
(11,0,0,'FLL-DPHXV7G5',2,1,1,9,56,'36','please ensure driver wears a hat','25%','36','22',0,1,1,'Mr','George','Smith','2017-06-30',1),
(12,22,47,'FLL-DPHXV7G5',2,1,1,9,34,'09:00','','25%','34','21',0,1,1,'Mr','George','Smith','2017-07-06',2),
(13,0,0,'FLL-P8P7HW4V',0,0,0,0,56,'','','25%','','0',0,0,0,'Mrs','Another Test First','Another Test First','',1),
(14,76,117,'FLL-P8P7HW4V',0,0,0,0,0,'12:05','','25%','73','45',0,0,0,'Mrs','Another Test First','Another Test First','2017-07-18',2),
(15,0,0,'FLL-QNM5HCPC',2,1,1,54,57,'58','','25%','58','36',0,0,0,'Sir','James','Carlton','2017-07-01',1),
(16,0,0,'FLL-2Q9SXPNS',2,0,0,27,0,'0','','25%','0','9',0,0,0,'Mr','abc3','xyz3','2017-08-17',1),
(17,41,73,'FLL-2Q9SXPNS',2,0,0,27,14,'14:25','departure and transport notes','25%','0','28',0,0,0,'Mr','abc3','xyz3','2017-08-17',2),
(18,0,0,'FLL-TP7NV3K9',0,0,0,11,56,'0','arrival and transport notes','25%','0','49',0,0,0,'Mr','abc4','xyz4','2017-07-14',1),
(19,0,0,'FLL-H8CF2HBP',0,0,0,47,0,'8','','25%','8','2',0,0,0,'Mr','abc333','xyz111','2017-08-15',1),
(20,0,0,'FLL-3J2R3HT4',2,0,0,11,0,'8','','25%','8','2',0,0,0,'Mr','abc444','xyz444','2017-09-13',1),
(21,0,0,'FLL-WB3S7XNQ',1,0,0,11,0,'8','','25%','8','2',0,0,0,'Mr','abc55','xyz55','2017-07-21',1),
(22,0,0,'FLL-TTKT2KJS',1,1,1,136,56,'17','arr trans','25%','17','12',0,0,0,'Mr','abc66','xyz66','2017-07-22',1);

/*Table structure for table `fll_reservations` */

DROP TABLE IF EXISTS `fll_reservations`;

CREATE TABLE `fll_reservations` (
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
  `dpt_date` date DEFAULT NULL,
  `dpt_time` varchar(255) DEFAULT NULL,
  `dpt_flight_no` varchar(255) DEFAULT NULL,
  `dpt_transport` varchar(255) DEFAULT NULL,
  `dpt_driver` varchar(255) DEFAULT NULL,
  `dpt_vehicle` varchar(255) DEFAULT NULL,
  `dpt_pickup` varchar(255) DEFAULT NULL,
  `dpt_dropoff` varchar(255) DEFAULT NULL,
  `dpt_pickup_time` varchar(255) DEFAULT NULL,
  `dpt_notes` varchar(255) DEFAULT NULL,
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
  `infant_seats` int(11) NOT NULL DEFAULT '0',
  `child_seats` int(11) NOT NULL DEFAULT '0',
  `booster_seats` int(11) NOT NULL DEFAULT '0',
  `vouchers` int(11) NOT NULL DEFAULT '0',
  `assignment` int(1) NOT NULL,
  `cold_towel` int(11) DEFAULT NULL,
  `bottled_water` int(11) DEFAULT NULL,
  `dpt_flight_class` int(11) DEFAULT NULL,
  `rooms` varchar(255) DEFAULT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `date_reconfirmed` datetime DEFAULT NULL,
  `reconf_with` varchar(200) DEFAULT NULL,
  `total_guests` int(3) NOT NULL DEFAULT '0',
  `luggage_vehicle` varchar(9) NOT NULL DEFAULT 'No',
  `fast_ref_no_sys` varchar(12) DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT '0',
  `payment_amount` decimal(10,2) DEFAULT '0.00',
  `sup_total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `fll_reservations` */

insert  into `fll_reservations`(`id`,`title_name`,`first_name`,`last_name`,`pnr`,`tour_operator`,`operator_code`,`tour_ref_no`,`adult`,`child`,`infant`,`tour_notes`,`fast_track`,`affiliates`,`arr_date`,`arr_time`,`arr_flight_no`,`flight_class`,`arr_transport`,`arr_driver`,`arr_vehicle`,`arr_pickup`,`arr_dropoff`,`room_type`,`rep_type`,`client_reqs`,`dpt_date`,`dpt_time`,`dpt_flight_no`,`dpt_transport`,`dpt_driver`,`dpt_vehicle`,`dpt_pickup`,`dpt_dropoff`,`dpt_pickup_time`,`dpt_notes`,`creation_date`,`created_by`,`modified_date`,`modified_by`,`ref_no_sys`,`assigned`,`rep`,`status`,`arr_transport_notes`,`dpt_transport_notes`,`arr_hotel_notes`,`ftnotify`,`infant_seats`,`child_seats`,`booster_seats`,`vouchers`,`assignment`,`cold_towel`,`bottled_water`,`dpt_flight_class`,`rooms`,`room_no`,`date_reconfirmed`,`reconf_with`,`total_guests`,`luggage_vehicle`,`fast_ref_no_sys`,`payment_type`,`payment_amount`,`sup_total_amount`) values 
(1,'Mr','first','Last','PNR','1','Op code','111',1,1,0,'rep notes',0,'','2017-07-20','','','flight class not specified','','','','Pickup Location','14','54','','Additional Requirements','2017-07-26','','','1','28','18','4','17','11:20','accounting notes','2017-06-20 15:41:29','Creative Tech','2017-07-06 13:24:56','Creative Tech','FLL-H4M882X2',0,'1',1,'','','',1,0,0,0,0,0,0,0,0,'3','#113',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(2,'Mr','Tess 1','Tess 1','PNR 1 abc123','53','FR854','187495',6,2,8,'Tess 1 rep notes',0,'','2017-06-23','3','4','4','','Array','Array','56','24','116','8','Additional Requirements','2017-07-19','8','2','','49','45','20','56','7:40','accounting notes here','2017-06-20 21:11:03','Nicole Moody','2017-07-07 12:04:09','Creative Tech','FLL-TFB26QDX',0,'1',1,'arr &amp; tport note test 1','departure and transport notes here','hotel notes test 1',0,2,3,1,6,0,6,6,5,'2','1234','2017-06-29 00:00:00',NULL,3,'Yes',NULL,0,'0.00','0.00'),
(3,'Sir','FSFT First 2','FSFT Last','FSFT PNR78524','140','','FSFT Ref# 84612',7,11,8,'FSFT Rep Notes here testing',1,'','2017-06-30','26','17','5','','53','92','','34','','','Additional Requirements','2017-07-19','21','14','','26','53','3','','21:25','FSFT Accounting Notes Here','2017-06-20 21:25:37','Nicole Moody','2017-07-11 11:22:01','Creative Tech','FLL-GX9TTB9Y',1,'[\"14\"]',1,'FSFT Arrival and transport notes test','fsft dept and transport notes','',0,6,6,6,6,0,6,6,6,'','',NULL,NULL,1,'No','FLL-2DHC9J5S',1,'0.00','240.00'),
(4,'Mr','abc','xyz','PNR','1','Op code','111',0,0,0,'rep notes',0,'','2017-07-12','','','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','01:30','','2017-06-21 15:22:55','Creative Tech','2017-07-06 12:45:52','Creative Tech','FLL-8C94DBDD',0,'1',1,'','','',1,0,0,0,0,0,0,0,0,'0','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(5,'Select title','abc2','xyz2','PNR','1','','',0,0,0,'rep notes',1,'','2017-08-23','','','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','','00:25','','2017-06-21 15:24:23','Creative Tech','2017-06-29 12:38:01','Nicole Moody','FLL-P7SHFQFG',0,'23',1,'','','',0,0,0,0,0,6,0,0,0,'0','',NULL,NULL,1,'No','FLL-YXPGPX5V',0,'0.00','0.00'),
(6,'','Abc19','xyz19','PNR','1','op code','ref',0,0,0,'',1,'','2017-07-19','','','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','03:30','','2017-06-21 18:27:34','Creative Tech','2017-07-06 12:45:52','Creative Tech','FLL-B9JPRFTS',0,'1',2,'','','',0,0,0,0,0,0,0,0,0,'0','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(7,'','fSFT','Test','PNR','142','','',0,0,0,'rep notes',1,'','2017-07-06','','0','Select flight class','','0','','','0','','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','','03:50','','2017-06-21 18:48:45','Creative Tech','2017-07-11 11:16:56','Creative Tech','FLL-2YJJ5GQD',1,'[\"11\"]',2,'','','',0,0,0,0,0,0,0,0,0,'','',NULL,NULL,1,'No','FLL-262QZ4XM',0,'0.00','0.00'),
(8,'','Abc22','xyz22','','142','','',0,0,0,'',0,'','2017-07-19','','','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','03:50','','2017-06-21 18:49:45','Creative Tech','2017-07-11 11:16:56','Creative Tech','FLL-F7Z73C9K',1,'[\"11\"]',2,'','','',0,0,0,0,0,0,0,0,0,'0','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(9,'Mr','John','Taylor','JT PNR','56','','',0,0,0,'',0,'','2017-06-30','','54','5','','','','Airport','46','234','','Additional Requirements','2017-07-07','72','44','','65','105','Pickup Location','Dropoff Location','18:50','','2017-06-22 18:47:45','Nicole Moody','2017-07-07 13:18:09','Creative Tech','FLL-JQ296ZRB',0,'[\"1\",\"24\",\"16\",\"6\"]',1,'','','',0,0,0,0,0,0,0,0,7,'0','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(10,'Mr','George','Smith','584PWQ43','9','','65841',2,1,1,'please note this is the 72 trip for the smith family',1,'','2017-06-30','36','22','5','Group Transfers','Array','Array','56','34','175','2','Additional Requirements','2017-07-06','34','21','','22','47','34','56','09:00','refund 10%','2017-06-29 09:06:06','Nicole Moody','2017-07-07 12:27:53','Creative Tech','FLL-DPHXV7G5',1,'20',1,'please ensure driver wears a hat','','hotel to have fruit ready on arrival',0,0,1,1,4,0,4,4,5,'1','584','2017-10-19 00:00:00','Mary',3,'Yes',NULL,0,'0.00','0.00'),
(11,'Mrs','Another Test First','Another Test First','','0','','',0,0,0,'knfadlkfjdslkjf ',0,'','0000-00-00','','0','Select flight class','','Array','Array','56','34','172','1, 6','Additional Requirements','2017-07-18','73','45','','76','117','Pickup Location','Dropoff Location','12:05','','2017-06-29 12:09:09','Nicole Moody','2017-07-07 12:04:09','Creative Tech','FLL-P8P7HW4V',0,'1',1,'','','knfadlkfjdslkjf ',0,0,0,0,0,0,0,0,6,'6','584',NULL,NULL,1,'Yes',NULL,0,'0.00','0.00'),
(12,'Sir','James','Carlton','584984','54','','',2,1,1,'',0,'','2017-07-01','58','36','7','','Array','Array','57','0','','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','16:15','','2017-06-29 16:16:04','Nicole Moody','2017-07-07 12:04:09','Creative Tech','FLL-QNM5HCPC',0,'1',1,'','','',0,0,0,0,0,0,0,0,0,'','',NULL,NULL,3,'No',NULL,0,'0.00','0.00'),
(13,'Mr','abc111','xyz111','PNR','1','','ref',2,1,0,'rep notes',1,'','2017-07-20','','0','Select flight class','','0','','','0','','','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','','13:20','','2017-07-04 13:19:16','Creative Tech','2017-07-06 12:45:52','Creative Tech','FLL-GS4S3JBV',0,'1',1,'','','',0,0,0,0,0,0,0,0,0,'','',NULL,NULL,1,'No','FLL-PZ6QWV78',1,'0.00','90.00'),
(14,'Mr','abc3','xyz3','PNR','27','opcode','ref',2,0,0,'repnotes',0,'','2017-08-17','0','9','Select flight class','','Array','','0','12','44','','Additional Requirements','2017-08-17','0','28','','41','73','14','9','14:25','accounting notes','2017-07-05 14:29:28','Creative Tech','2017-07-07 14:50:05','Creative Tech','FLL-2Q9SXPNS',0,'[\"24\",\"20\",\"16\"]',1,'','departure and transport notes','arrival and transport notes',1,0,0,0,0,0,0,0,7,'1','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(15,'Mr','abc4','xyz4','pnr','11','','ref',0,0,0,'repnotes',0,'','2017-07-14','','49','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','2017-08-23','8','2','','','','4','4','14:50','','2017-07-05 15:07:50','Creative Tech','2017-07-07 12:04:09','Creative Tech','FLL-TP7NV3K9',0,'1',1,'arrival and transport notes','','',0,0,0,0,0,0,0,0,0,'1','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(16,'Professor','Acb','xzy','pnr','146','','',2,0,0,'rep notes',1,'','2017-07-14','71','43','4','','0','','','21','','','Additional Requirements','2015-08-06','','0','','0','','Pickup Location','','12:25','accounting notes','2017-07-06 12:26:17','Creative Tech','2017-07-07 12:04:09','Creative Tech','FLL-5G7CVGKB',0,'1',1,'','','',0,0,0,0,0,0,0,0,0,'','',NULL,NULL,1,'No','FLL-24JPC67Y',1,'0.00','70.00'),
(17,'Mr','abc333','xyz111','pnr','47','opcode','',0,0,0,'',1,'','2017-08-15','8','2','Select flight class','','Array','','0','0','','','Additional Requirements','2017-08-17','103','6','','0','','Pickup Location','Dropoff Location','16:15','','2017-07-07 16:16:12','Creative Tech','2017-07-07 16:16:35','Creative Tech','FLL-H8CF2HBP',0,'',1,'','','',1,0,0,0,0,0,0,0,0,'','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(18,'Mr','abc444','xyz444','pnr','11','opcode','ref',2,0,0,'repnotes',1,'','2017-09-13','','2','flight class not specified','','','','Pickup Location','','270','','Additional Requirements','2017-08-03','','','','','','4','4','16:30','','2017-07-07 16:31:31','Creative Tech','2017-07-07 16:34:38','Creative Tech','FLL-3J2R3HT4',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'0','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(19,'Mr','abc55','xyz55','pnr','11','opcode','re',1,0,0,'rep notes',0,'','2017-07-21','8','2','Select flight class','','Array','','0','0','','','Additional Requirements','2017-08-11','100','42','','0','','Pickup Location','Dropoff Location','16:40','','2017-07-07 16:40:46','Creative Tech','','','FLL-WB3S7XNQ',0,'',1,'','','',1,0,0,0,0,0,0,0,0,'','',NULL,NULL,1,'No',NULL,0,'0.00','0.00'),
(20,'Mr','abc66','xyz66','PNR','136','opcode','ref',1,1,1,'repnotes',1,'','2017-07-22','17','12','2','','Array','Array','56','69','0','','Additional Requirements','2017-08-24','0','8','','0','','Pickup Location','Dropoff Location','10:55','accounting notes','2017-07-10 10:56:22','Creative Tech','','','FLL-TTKT2KJS',0,'',1,'arr trans','','',1,0,0,0,0,0,0,0,5,'','',NULL,NULL,1,'No',NULL,0,'0.00','0.00');

/*Table structure for table `fll_room_loc` */

DROP TABLE IF EXISTS `fll_room_loc`;

CREATE TABLE `fll_room_loc` (
  `id_room_loc` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `id_roomtype` int(11) NOT NULL,
  PRIMARY KEY (`id_room_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

/*Data for the table `fll_room_loc` */

insert  into `fll_room_loc`(`id_room_loc`,`id_location`,`id_roomtype`) values 
(1,1,1),
(2,2,2),
(3,3,3),
(4,5,20),
(5,5,21),
(6,8,22),
(7,8,23),
(8,8,24),
(9,8,25),
(10,8,26),
(11,8,27),
(12,8,28),
(13,8,29),
(14,8,30),
(15,10,31),
(16,10,32),
(17,10,33),
(18,10,34),
(19,10,35),
(20,11,36),
(21,11,37),
(22,11,38),
(23,12,39),
(24,12,40),
(25,12,41),
(26,12,42),
(27,12,43),
(28,12,44),
(29,13,45),
(30,13,46),
(31,13,47),
(32,13,48),
(33,13,49),
(34,13,50),
(35,13,51),
(36,13,52),
(37,13,53),
(38,14,54),
(39,14,55),
(40,14,56),
(41,14,57),
(42,15,58),
(43,15,59),
(44,15,60),
(45,15,61),
(46,15,62),
(47,15,63),
(48,16,64),
(49,16,65),
(50,16,66),
(51,16,67),
(52,16,68),
(53,17,69),
(54,17,70),
(55,17,71),
(56,17,72),
(57,17,73),
(58,17,74),
(59,18,75),
(60,18,76),
(61,18,77),
(62,18,78),
(63,18,79),
(64,19,80),
(65,19,81),
(66,19,82),
(67,19,83),
(68,19,84),
(69,19,85),
(70,19,86),
(71,20,87),
(72,20,88),
(73,21,89),
(74,21,90),
(75,21,91),
(76,21,92),
(77,21,93),
(78,21,94),
(79,23,95),
(80,23,96),
(81,23,97),
(82,55,98),
(83,55,99),
(84,55,100),
(85,55,101),
(86,55,102),
(87,55,103),
(88,1,104),
(90,24,106),
(91,24,107),
(92,24,108),
(93,24,109),
(94,24,110),
(95,24,111),
(96,24,112),
(97,24,113),
(98,24,114),
(99,24,115),
(100,24,116),
(101,25,117),
(102,25,118),
(103,25,119),
(104,25,120),
(105,25,121),
(106,26,122),
(107,26,123),
(108,26,124),
(109,26,125),
(110,26,126),
(111,26,127),
(112,27,128),
(113,27,129),
(114,27,130),
(115,27,131),
(116,27,132),
(117,27,133),
(118,28,134),
(119,28,135),
(120,28,136),
(121,29,137),
(122,29,138),
(123,29,139),
(124,30,141),
(125,30,142),
(126,4,145),
(127,4,148),
(128,4,149),
(129,4,150),
(130,4,151),
(131,4,152),
(132,4,154),
(133,4,155),
(134,4,156),
(135,4,159),
(136,4,160),
(137,32,161),
(138,32,162),
(139,32,163),
(140,32,164),
(141,32,165),
(142,32,166),
(143,32,167),
(144,32,168),
(145,34,169),
(146,34,170),
(147,34,171),
(148,34,172),
(149,34,173),
(150,34,174),
(151,34,175),
(152,34,176),
(153,34,177),
(154,35,178),
(155,35,179),
(156,35,180),
(157,36,181),
(158,36,182),
(159,36,183),
(160,36,184),
(161,36,185),
(162,37,186),
(163,37,187),
(164,37,188),
(165,38,189),
(166,38,190),
(167,38,191),
(168,38,192),
(169,38,193),
(170,38,194),
(171,39,196),
(172,39,197),
(173,39,198),
(174,39,199),
(175,40,200),
(176,40,201),
(177,40,202),
(178,41,203),
(179,41,204),
(180,41,205),
(181,41,206),
(182,42,207),
(183,42,208),
(184,42,209),
(185,3,210),
(186,3,211),
(187,3,212),
(188,3,213),
(189,3,214),
(190,3,215),
(191,3,216),
(192,3,217),
(193,43,218),
(194,43,219),
(195,43,220),
(196,43,221),
(197,43,222),
(198,43,223),
(199,44,224),
(200,44,225),
(201,44,226),
(202,44,227),
(203,44,228),
(204,44,229),
(205,45,230),
(206,45,231),
(207,45,232),
(208,45,233),
(209,46,234),
(210,46,235),
(211,46,236),
(212,46,237),
(213,46,238),
(214,47,239),
(215,47,240),
(216,47,241),
(217,47,242),
(218,48,243),
(219,48,244),
(220,48,245),
(221,48,246),
(222,48,247),
(223,49,248),
(224,49,249),
(225,49,250),
(226,49,251),
(227,49,252),
(228,49,253),
(229,50,254),
(230,50,255),
(231,50,256),
(232,50,257),
(233,50,258),
(234,50,259),
(235,51,260),
(236,51,261),
(237,51,262),
(238,51,263),
(239,52,264),
(240,52,265),
(241,52,266),
(242,52,267),
(243,52,268),
(251,1,105);

/*Table structure for table `fll_roomtypes` */

DROP TABLE IF EXISTS `fll_roomtypes`;

CREATE TABLE `fll_roomtypes` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;

/*Data for the table `fll_roomtypes` */

insert  into `fll_roomtypes`(`id_room`,`id_location`,`room_type`) values 
(2,2,'Crystal Lagoon Luxury'),
(3,3,'Ocean Front Deluxe '),
(20,5,'Superior Garden Suite'),
(21,5,'Superior Poolside Suite'),
(22,8,'Beach View Room'),
(23,8,'Beachfront Deluxe Room'),
(24,8,'The Business Class Room'),
(25,8,'Family Room'),
(26,8,'Ocean View Room'),
(27,8,'Superior Room'),
(28,8,'Carlisle Suite'),
(29,8,'Grand Pier One-bedroom Suite'),
(30,8,'Pier Junior Suite'),
(31,10,'Super Deluxe'),
(32,10,'Deluxe'),
(33,10,'Superior'),
(34,10,'Honeymoon'),
(35,10,'Penthouse'),
(36,11,'One Bedroom Suite'),
(37,11,'Two Bedroom Suite'),
(38,11,'Three Bedroom Suite'),
(39,12,'Deluxe Studio Apartments'),
(40,12,'Deluxe 1 Bedroom'),
(41,12,'Deluxe 2 Bedroom'),
(42,12,'1 Bedroom Ocean View'),
(43,12,'3 Bedroom Pool Garden'),
(44,12,'2 Bedroom Standard Apartment'),
(45,13,'Deluxe Studio'),
(46,13,'Superior Studio'),
(47,13,'Junior Suite'),
(48,13,'Honeymoon Suite'),
(49,13,'1 Bedroom Suite'),
(50,13,'Deluxe 1 Bedroom Suite'),
(51,13,'1 Bedroom Penthouse'),
(52,13,'Deluxe 2 Bedroom Suite'),
(53,13,'2 Bedroom Beachfront'),
(54,14,'1 Bedroom Island View Apartment'),
(55,14,'2 Bedroom Island View Apartment'),
(56,14,'2 Bedroom Ocean View Apartment'),
(57,14,'Penthouse Apartment'),
(58,15,'Cobblers Garden Suite'),
(59,15,'Ocean View Suite'),
(60,15,'Ocean Front Suite'),
(61,15,'2 Bedroom Suite'),
(62,15,'Camelot at the Great House'),
(63,15,'Colleton at the Great House'),
(64,16,'Superior Ocean Front Room'),
(65,16,'Ocean View Studio'),
(66,16,'Ocean Front Room'),
(67,16,'Standard Room'),
(68,16,'Island View Apartment'),
(69,17,'Pool/Garden View'),
(70,17,'Ocean View'),
(71,17,'Luxury Poolside'),
(72,17,'Junior Suite Pool/Garden View'),
(73,17,'Luxury Ocean View'),
(74,17,'1 bedroom Suite - Ocean View'),
(75,18,'Deluxe Studio '),
(76,18,'Deluxe 1 Bedroom'),
(77,18,'Deluxe 2 Bedroom'),
(78,18,'1 Bedroom Penthouse'),
(79,18,'1 Bedroom Suite'),
(80,19,'Garden Room/Cottage'),
(81,19,'Superior or Luxury Junior Suite'),
(82,19,'Luxury Cottage/Suite'),
(83,19,'2 Bedroom Combination'),
(84,19,'Luxury Plantation Suite'),
(85,19,'Tamarind Villa'),
(86,19,'Ixora Villa'),
(87,20,'Studio Suites'),
(88,20,'3 Bedroom Penthouse'),
(89,21,'Pool/Garden View'),
(90,21,'Ocean View'),
(91,21,'Junior Suite Pool/Garden View'),
(92,21,'Junior Suite Ocean View'),
(93,21,'1 bedroom Suite Pool/Garden View'),
(94,21,'1 bedroom Suite Ocean View'),
(95,23,'1 Bedroom Pool &amp; Garden View Suite'),
(96,23,'1 Bedroom Beach Villa Suite'),
(97,23,'2 Bedroom Suite'),
(98,55,'Garden View - Studio'),
(99,55,'Family - Studio'),
(100,55,'Pool View - Studio'),
(101,55,'Ocean View - Studio'),
(102,55,'Island View - Studio'),
(103,55,'Garden View - 1 Bedroom'),
(106,24,'Bay view room - King bed'),
(107,24,'Ocean view room - King bed'),
(108,24,'Bay view room - 2 double beds'),
(109,24,'Ocean view room - 2 double beds'),
(110,24,'Ocean View Suite'),
(111,24,'Prime Minister Suite with Ocean View'),
(112,24,'Bay View Suite'),
(113,24,'Panoramic View Executive Room - King bed'),
(114,24,'Panoramic View Executive Room - 2 double beds'),
(115,24,'Accessible Panoramic View Executive Room'),
(116,24,'Accessible Ocean View Room'),
(117,25,'Luxury Ocean Suite with private plunge pool'),
(118,25,'Garden Jr. Suite with Whirpool'),
(119,25,'Ocean deluxe'),
(120,25,'Poolside deluxe with partial ocean view'),
(121,25,'Garden standard'),
(122,26,'1 Bedroom - Garden Suite'),
(123,26,'2 Bedroom - Split Level Garden Suite'),
(124,26,'2 Bedroom - Garden Suite'),
(125,26,'2 Bedroom - Ocean Front fort suite'),
(126,26,'3 Bedroom - Ocean Front fort suite'),
(127,26,'3 Bedroom - Vineyard suite'),
(128,27,'Standard room'),
(129,27,'Standard 1 Bedroom'),
(130,27,'Superior Room'),
(131,27,'Deluxe Room'),
(132,27,'Ocean Front Room'),
(133,27,'Penthouse Suite'),
(134,28,'Spacious Guest Room'),
(135,28,'Superior with Balcony'),
(136,28,'Suite with Balcony'),
(137,29,'1 Bedroom Ocean Front Suite'),
(138,29,'2 Bedroom Ocean Front Suite'),
(139,29,'2 Bedroom Bay View Suite'),
(141,30,'Studio'),
(142,30,' 1 Bedroom Apartment'),
(145,4,'Island View Room'),
(148,4,'Ocean View Room'),
(149,4,'Ocean Front Room'),
(150,4,'Deluxe Ocean View Suite'),
(151,4,'Ocean View Penthouse Suite'),
(152,4,'Deluxe Ocean View Junior Suite'),
(154,4,'Island View Junior Suite'),
(155,4,'Pool View Room'),
(156,4,'Pool View Suites (2 Bedroom)'),
(159,4,'State Room'),
(160,4,'2 Bedroom Ocean Front Luxury Suite'),
(161,32,'Pool Deck Studio'),
(162,32,'Ocean Front Studio'),
(163,32,'1 Bedroom Ocean Front'),
(164,32,'2 Bedroom Ocean Front'),
(165,32,'Superior Ocean Front Studio'),
(166,32,'Deluxe Ocean Front Studio'),
(167,32,'1 Bedroom Island View'),
(168,32,'Ocean Front Penthouse Suite'),
(169,34,'Orchid Room'),
(170,34,'Ocean Room'),
(171,34,'Luxury Ocean Room'),
(172,34,'Luxury Orchid Suite'),
(173,34,'Dolphin Suite'),
(174,34,'Luxury Dolphin Suite'),
(175,34,'Penthouse'),
(176,34,'Sandy Lane Suite'),
(177,34,'The Villa at Sandy Lane'),
(178,35,'Plantation Room'),
(179,35,'Deluxe Courtyard Room'),
(180,35,'Deluxe Pool Access Room'),
(181,36,'Standard Room'),
(182,36,'Pool / Garden View'),
(183,36,'Ocean View'),
(184,36,'Oceanfront Superior Room'),
(185,36,'Two Bedroom Apartment'),
(186,37,'Bungalow'),
(187,37,'Townhouse'),
(188,37,'Villa'),
(189,38,'Two Bedroom Ocean front Suite'),
(190,38,'One Bedroom Ocean Front Suite'),
(191,38,'Ocean Studio'),
(192,38,'Partial Ocean View Room'),
(193,38,'Partial Ocean Veiw Loft'),
(194,38,'Ocean View Suite'),
(196,39,'Studio'),
(197,39,'One Bedroom Suite'),
(198,39,'Two Bedroom Suite'),
(199,39,'Penthouse Suite'),
(200,40,'Superior Studio'),
(201,40,'Junior Suite'),
(202,40,'One Bedroom Suite'),
(203,41,'OceanView'),
(204,41,'Garden &amp; Pool View Rooms'),
(205,41,'Luxury Suites'),
(206,41,'Duplex Suites'),
(207,42,'One Bedroom Suite'),
(208,42,'Two Bedroom Suite'),
(209,42,'The Penthouse'),
(210,3,'Pool/ Garden View'),
(211,3,'Ocean Front'),
(212,3,'Ocean Front with Sleeper Chair'),
(213,3,'Junior Suite - Pool / Garden View'),
(214,3,'Junior Suite - Ocean View'),
(215,3,'One Bedroom Suite - Pool/ Garden View'),
(216,3,'One Bedroom Suite - Ocean View'),
(217,3,'One Bedroom Suite - Ocean View'),
(218,43,'Garden View'),
(219,43,'Ocean Loft'),
(220,43,'Superior Ocean Loft'),
(221,43,'Superior Garden View'),
(222,43,'1 Bedroom Garden View Suite'),
(223,43,'1 Bedroom Oceanfront Suite'),
(224,44,'Junior Garden View'),
(225,44,'One Bedroom Ocean View'),
(226,44,'One Bedroom Ocean View with Plunge Pool'),
(227,44,'One Bedroom Ocean View with 28&#039; Pool'),
(228,44,'Two Bedroom Ocean View Penthouse'),
(229,44,'Three Bedroom OceanView Penthouse'),
(230,45,'Pool / Garden View One Bedroom Suite'),
(231,45,'Ocean View'),
(232,45,'Junior Suite Pool / Garden View'),
(233,45,'Ocean View One Bedroom Suite'),
(234,46,'Garden Room'),
(235,46,'One Bedroom Suite'),
(236,46,'Two Bedroom Suite'),
(237,46,'Tree Top Suite'),
(238,46,'The Beach House'),
(239,47,'Standard Rooms'),
(240,47,'Superior Rooms'),
(241,47,'Pool View Rooms'),
(242,47,'Deluxe Rooms'),
(243,48,'The Hemingway'),
(244,48,'The Hibiscus'),
(245,48,'The Hummingbird'),
(246,48,'Ocean View Suite'),
(247,48,'Pool and Garden View Suites'),
(248,49,'Junior Suite Pool / Garden View'),
(249,49,'Junior Suite Ocean View'),
(250,49,'Junior Suite Deluxe OceanView '),
(251,49,'Junior Suite Ocean Front'),
(252,49,'One Bedroom Suite Pool / Garden View'),
(253,49,'One Bedroom Suite Ocean View'),
(254,50,'Deluxe Oceanfront'),
(255,50,'Ocean Front Duplex'),
(256,50,'Oceanfront Room'),
(257,50,'Duplex Island View'),
(258,50,'Island View'),
(259,50,'Spa Rooms'),
(260,51,'Standard Hotel Room'),
(261,51,'Superior Hotel Room'),
(262,51,'Junior One Bedroom'),
(263,51,'Deluxe One Bedroom '),
(264,52,'Superior Studio'),
(265,52,'Deluxe Studio'),
(266,52,'Two Bedroom Penthouse Suite'),
(267,52,'Deluxe Ground Floor Two Bedroom Suite'),
(268,52,'Deluxe Top floor Two Bedroom Suite'),
(270,0,'Testing Room Type');

/*Table structure for table `fll_touroperator` */

DROP TABLE IF EXISTS `fll_touroperator`;

CREATE TABLE `fll_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `fll_touroperator` */

insert  into `fll_touroperator`(`id`,`tour_operator`) values 
(1,'A & Kent'),
(2,'Abreu'),
(3,'Agaxtur BR'),
(4,'Alidays'),
(5,'Aspire'),
(6,'Aviva Group'),
(7,'Azure'),
(8,'British Airways'),
(9,'BAHolidays'),
(10,'Bailey Robinson'),
(11,'BeCuriou'),
(12,'Berge & Meer'),
(13,'Best Tours Italia'),
(14,'Blue Sky Luxury'),
(15,'Bookit'),
(16,'Caribbean Dest'),
(17,'Caribbean Island'),
(18,'CTS Horizons'),
(19,'CV Travel'),
(20,'Caribtours'),
(21,'City Discovery'),
(22,'Classic Collection'),
(23,'Classic Resorts'),
(24,'Colletts Resorts'),
(25,'Cox & Kings'),
(26,'Culsen Travel'),
(27,'Curitiba Tours'),
(28,'Designer Tours BR'),
(29,'Destinology'),
(30,'Diamond Air'),
(31,'Direct Bookings'),
(32,'EFR Travel'),
(33,'Eden Collection'),
(34,'Escapade Caribbean'),
(35,'Eso Travel'),
(36,'Eurasia HWT'),
(37,'Expressions'),
(38,'Exsus Travel'),
(39,'Fischer'),
(40,'Friendship Travel'),
(41,'Global Travel/Dest 2'),
(42,'Gold Medal'),
(43,'Golden Caribbean'),
(44,'Harlequin'),
(45,'Hays Travel'),
(46,'Holiday Place'),
(47,'Holiday Services'),
(48,'HolidayBeds (Ireland)'),
(49,'Individual Holidays'),
(50,'Intimate Caribbean Holidays'),
(51,'Key2Holidays'),
(52,'Kuoni Zurich'),
(53,'Kuoni France'),
(54,'Kuoni Netherlands'),
(55,'Kuoni Spain (Madrid)'),
(56,'Kuoni UK'),
(57,'Kuoni UK (WCC)'),
(58,'La Fabbrica'),
(59,'Latino Travel'),
(60,'Latitude'),
(61,'Lusso Travel'),
(62,'Luxury Holiday Tours'),
(63,'Luxurytrips'),
(64,'MLT Vacations'),
(65,'MotMot Travel'),
(66,'Mundy Cruising'),
(67,'Naar Tours'),
(68,'Noks Film'),
(69,'North American Travel'),
(70,'Online Travel'),
(71,'Only Exclusive'),
(72,'Owners Syndicate'),
(73,'Pelikan Rejser'),
(74,'Pink Pearl'),
(75,'Pleasant Holidays'),
(76,'Presona Travel'),
(77,'Prestbury WW'),
(78,'Pure Luxury'),
(79,'Quadrante'),
(80,'Real Holidays'),
(81,'Rockwell'),
(82,'St James Travel & Tours'),
(83,'Scott Dunn'),
(84,'Seasons in Style'),
(85,'Simpson Exclusive'),
(86,'Slattery Travel'),
(87,'Sunburst Vacations'),
(88,'Sunlinc'),
(89,'Sunmaster'),
(90,'Sunny Holidays'),
(91,'Sunset Travel Ltd'),
(92,'Sunway Holidays'),
(93,'Sunwing'),
(94,'TC Germany'),
(95,'TC Group'),
(96,'TC Signature'),
(97,'TC Sport'),
(98,'Team America'),
(99,'Thomas WW'),
(100,'Titan Travel Ltd'),
(101,'Tourist Club'),
(102,'Trailfinders'),
(103,'Travco LLP'),
(104,'Travel 2/4'),
(105,'Travel City'),
(106,'Travel Factory'),
(107,'Travel Trend'),
(108,'Travel Value'),
(109,'Travel2'),
(110,'Tropic Breeze'),
(111,'Tropic Sky'),
(112,'Tropical Dest'),
(113,'Tropical Locations'),
(114,'Tropical Tours'),
(115,'Tropicalement'),
(116,'Turquoise Holidays'),
(117,'Travel Counsellors'),
(118,'Ultimate Travel'),
(119,'Value Added Travel'),
(120,'Viator'),
(121,'Vicino E Lontano'),
(122,'Voyageurs Du Monde'),
(123,'W & O'),
(124,'WT Vacations'),
(125,'WeTravel2'),
(126,'Wedd in Paradise'),
(127,'West Jet'),
(128,'White sand weddings'),
(129,'Wilderness Explorers'),
(130,'Virtuoso'),
(131,'ITC'),
(132,'Carrier'),
(133,'World Travel Holdings'),
(134,'Island Villas'),
(135,'Blue Anglia'),
(136,'Altman'),
(137,'London Life & Casualty'),
(138,'London Life IRC'),
(139,'Soutterham Bank'),
(140,'Accra Beach Hotel'),
(141,'B Away'),
(142,'Cruiseline - Star Clippers');

/*Table structure for table `fll_transfer` */

DROP TABLE IF EXISTS `fll_transfer`;

CREATE TABLE `fll_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(255) NOT NULL,
  `pickup` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` varchar(255) NOT NULL,
  `dropoff` int(11) NOT NULL,
  `transport` varchar(255) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `transfer_notes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `fll_transfer` */

insert  into `fll_transfer`(`id`,`ref_no_sys`,`pickup`,`pickup_date`,`pickup_time`,`dropoff`,`transport`,`vehicle`,`driver`,`transfer_notes`) values 
(9,'FLL-79SWJNDJ',0,'2016-09-09','16:15',56,'',25,10,'Transfer &amp; Transport notes'),
(10,'FLL-W9Z8BT9V',0,'0000-00-00','12:35',0,'',0,0,''),
(11,'FLL-8B3MPJWW',0,'0000-00-00','13:20',0,'',101,61,'Transfer &amp; Transport notes'),
(12,'FLL-TJ4V5Q2W',21,'2017-04-10','12:00',49,'Private Car',0,0,''),
(13,'FLL-38BTM48H',10,'2017-06-29','11:55',2,'Mercedes/BMW',56,29,'Inter Hotel transfer notes'),
(14,'FLL-TFB26QDX',20,'2017-06-13','21:00',34,'Coach (BT)',61,32,'inter hotel transfer notes test'),
(15,'FLL-DPHXV7G5',0,'0000-00-00','09:00',0,'',0,0,''),
(16,'FLL-P8P7HW4V',2,'2017-06-17','00:00',4,'Mercedes',73,41,'knfadlkfjdslkjf ');

/*Table structure for table `fll_transport` */

DROP TABLE IF EXISTS `fll_transport`;

CREATE TABLE `fll_transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transport`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

/*Data for the table `fll_transport` */

insert  into `fll_transport`(`id_transport`,`name`) values 
(4,'David Abraham'),
(6,'Ronald Adams'),
(8,'Ash Investment Inc'),
(10,'Anthony Adams'),
(11,'Barbados Ruje Wonder Tours'),
(12,'Carson Bailey'),
(13,'Grantley Beckles'),
(14,'Ian Tyrone Belgrave'),
(15,'Tyrone Best'),
(16,'Hugh Blackman'),
(17,'Anderson Brandford'),
(18,'Adrian Brathwaite'),
(19,'Derek Brathwaite'),
(20,'Fabian Brathwaite'),
(21,'Keisha Broomes'),
(22,'Ronald Browne'),
(23,'Cain &amp; Son Tours'),
(24,'Kenneth Callender'),
(25,'Winfield Catwell'),
(26,'Keith Chase'),
(27,'Anthony Clarke'),
(28,'Jamar Clarke'),
(29,'Courtney Corbin'),
(30,'Cummins Freight Service'),
(31,'D &amp; N Rentals and Taxi Service Inc'),
(32,'Victor Drakes'),
(33,'William Drayton'),
(34,'Robert Duke'),
(35,'Winston Edgehill'),
(36,'Yvette Edgehill'),
(37,'Grantley Forde'),
(38,'Joan Gibson'),
(39,'Stafford Gooding'),
(40,'Goodwill Transport Inc'),
(41,'Colin Harvey'),
(42,'Emmerson Herbert'),
(43,'Junior Harewood'),
(44,'Ron Hinds'),
(45,'Charles Holders'),
(46,'Michael Holder'),
(47,'Michael Hunte'),
(48,'Esline Johnson'),
(49,'Elvis King'),
(50,'Eric Lashley'),
(51,'Elvene Morris'),
(52,'Victor Murray'),
(53,'Paradise Limousine Service Inc'),
(54,'Andre Phillips'),
(55,'John Prescott'),
(56,'Quintours Taxi Inc / Johnson'),
(57,'Rehoboth Transport Service /  Caleb Drayton'),
(58,'Trevor Rochester'),
(59,'Lionel Russell'),
(60,'Hamilton Scantlebury'),
(61,'Adrian Snagg'),
(62,'Jason Springer'),
(63,'St. James Taxi and Services'),
(64,'Trevor Stuart'),
(65,'Edwin Tappin'),
(66,'Trevor Toppin'),
(67,'Sheryl-Ann Tudor'),
(68,'Vere King Transport Services Ltd'),
(69,'Curtis Walker'),
(70,'West Coast Taxi Service'),
(71,'Sherwin Williams'),
(72,'Neville Wiltshire'),
(73,'Dionna Wong'),
(74,'Barry Durrant'),
(76,'Mickey Mouse');

/*Table structure for table `fll_transporttype` */

DROP TABLE IF EXISTS `fll_transporttype`;

CREATE TABLE `fll_transporttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_type` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `fll_transporttype` */

insert  into `fll_transporttype`(`id`,`transport_type`,`order`) values 
(1,'Group Transfers',1),
(2,'Limousine',2),
(3,'Private Car',3),
(4,'Coach (BT)',4),
(5,'Mercedes/BMW',5),
(6,'Mercedes',6),
(7,'Private Van',7),
(8,'Hotel transfer',8),
(9,'Hydrolic Vehicle',9),
(10,'No Transfer',11),
(11,'Own transport',12),
(12,'SUV\n',10),
(18,'Testing Transport Mode',999),
(19,'Test Mode Tport',999);

/*Table structure for table `fll_vehicles` */

DROP TABLE IF EXISTS `fll_vehicles`;

CREATE TABLE `fll_vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `id_transport` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

/*Data for the table `fll_vehicles` */

insert  into `fll_vehicles`(`id_vehicle`,`id_transport`,`name`) values 
(16,4,'Z1911'),
(18,6,'ZM316'),
(20,8,'Z1149'),
(21,8,'Z1229'),
(23,8,'ZM755'),
(25,10,'Z1081'),
(26,11,'ZM321'),
(27,12,'Z1988'),
(28,13,'HL19'),
(31,14,'ZM524'),
(32,15,'ZM140'),
(33,15,'ZM326'),
(34,16,'Z229'),
(35,17,'ZM744'),
(36,18,'ZM389'),
(37,19,'Z17'),
(38,19,'Z1890'),
(39,19,'Z543'),
(40,19,'Z569'),
(41,19,'ZM311'),
(42,19,'ZM796'),
(43,19,'ZM797'),
(44,19,'BT95'),
(45,20,'Z1356'),
(46,21,'Z1702'),
(47,22,'ZM280'),
(48,23,'BT33'),
(49,23,'BT96'),
(50,24,'Z1003'),
(51,25,'HL28'),
(52,25,'HL29'),
(53,26,'ZM440'),
(54,27,'ZM802'),
(55,28,'Z923'),
(56,29,'ZM683'),
(57,29,'Z624'),
(58,30,'XA460'),
(59,31,'ZM255'),
(60,31,'ZM256'),
(61,32,'Z286'),
(62,33,'BT105'),
(63,33,'BT78'),
(64,34,'ZM15'),
(65,35,'Z1200'),
(66,36,'ZM426'),
(67,37,'Z564'),
(68,37,'Z964'),
(69,38,'Z346'),
(70,39,'ZM90'),
(71,40,'Z59'),
(72,40,'Z772'),
(73,41,'ZM125'),
(74,42,'Z1098'),
(75,42,'Z576'),
(76,43,'Z582'),
(77,43,'Z1252'),
(78,44,'Z177'),
(79,45,'Z1091'),
(80,46,'ZM595'),
(81,47,'ZM687'),
(82,48,'BT41'),
(83,49,'ZM390'),
(84,49,'ZM290'),
(85,49,'Z916'),
(86,49,'Z871'),
(87,50,'ZM575'),
(88,51,'ZM512'),
(89,52,'Z868'),
(90,53,'ZM41'),
(91,53,'HL23'),
(92,53,'HL62'),
(93,54,'Z1986'),
(94,55,'Z1585'),
(95,56,'ZM609'),
(96,57,'ZM351'),
(97,57,'ZM57'),
(98,58,'HL58'),
(99,59,'Z926'),
(100,60,'Z1420'),
(101,61,'Z43'),
(103,63,'ZM403'),
(104,64,'Z412'),
(105,65,'ZM338'),
(106,66,'Z997'),
(107,67,'Z45'),
(108,68,'BT56'),
(109,69,'BT17'),
(110,70,'Z982'),
(111,70,'Z1554'),
(112,71,'Z1210'),
(113,72,'BT9'),
(114,72,'BT26'),
(115,73,'Z441'),
(116,74,'ZM684'),
(117,76,'TEST123');

/*Table structure for table `history_extended` */

DROP TABLE IF EXISTS `history_extended`;

/*!50001 DROP VIEW IF EXISTS `history_extended` */;
/*!50001 DROP TABLE IF EXISTS `history_extended` */;

/*!50001 CREATE TABLE  `history_extended`(
 `id_rep` int(11) ,
 `name` varchar(255) ,
 `A` varchar(255) ,
 `B` varchar(255) ,
 `C` varchar(255) 
)*/;

/*View structure for view history_extended */

/*!50001 DROP TABLE IF EXISTS `history_extended` */;
/*!50001 DROP VIEW IF EXISTS `history_extended` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history_extended` AS (select `fll_reps`.`id_rep` AS `id_rep`,`fll_reps`.`name` AS `name`,(case when (`fll_reps`.`id_rep` = '1') then `fll_reps`.`name` end) AS `A`,(case when (`fll_reps`.`id_rep` = '2') then `fll_reps`.`name` end) AS `B`,(case when (`fll_reps`.`id_rep` = '3') then `fll_reps`.`name` end) AS `C` from `fll_reps`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
