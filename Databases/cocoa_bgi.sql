/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cocoa_bgi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoa_bgi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cocoa_bgi`;

/*Table structure for table `bgi_activity` */

DROP TABLE IF EXISTS `bgi_activity`;

CREATE TABLE `bgi_activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(255) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_activity` */

insert  into `bgi_activity`(`id_activity`,`log_user`,`user_action`,`log_time`) values 
(1,'Nicole Moody','add new reservation: Mr. mickey mouse #ref:BGI-MP2XV3HR','2016-01-14 15:36:48'),
(2,'Rhonda Niles','update flight number: BA2155','2016-01-15 16:07:37'),
(3,'Rhonda Niles','add new reservation: Mr. GAVIN CLIFFORD #ref:BGI-K63BFNQX','2016-01-15 16:13:22'),
(4,'Rhonda Niles','add new reservation: Mr. ANTHONY MCCALL #ref:BGI-KN2BYNFT','2016-01-15 16:16:29'),
(5,'Rhonda Niles','add new reservation: Mr. LAURENCE ASH #ref:BGI-DJX52PYW','2016-01-15 16:18:50'),
(6,'Rhonda Niles','add flight time: 16:15 for flight BA2155','2016-01-15 16:19:43'),
(7,'Rhonda Niles','add new reservation: Mr. GARY WARNER #ref:BGI-PC5NNVN4','2016-01-15 16:24:39'),
(8,'Rhonda Niles','add new flight number: BA2152','2016-01-15 16:40:27'),
(9,'Rhonda Niles','add flight time: 21:05 for flight BA2152','2016-01-15 16:41:03'),
(10,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:42:53'),
(11,'Rhonda Niles','add new location: Almond Resorts','2016-01-15 16:43:43'),
(12,'Rhonda Niles','update location: Almond Resorts','2016-01-15 16:44:02'),
(13,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:44:48'),
(14,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:46:58'),
(15,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:49:16'),
(16,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:50:43'),
(17,'Rhonda Niles','add flight time: 15:30 for flight BA2155','2016-01-15 16:52:28'),
(18,'Rhonda Niles','update flight number: BA2155','2016-01-15 16:52:35'),
(19,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 16:59:10'),
(20,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 17:00:55'),
(21,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-15 17:01:53'),
(22,'Rhonda Niles','update arrival details: #ref:BGI-K63BFNQX','2016-01-15 17:05:46'),
(23,'Rhonda Niles','update arrival details: #ref:BGI-K63BFNQX','2016-01-15 17:07:07'),
(24,'Alvin Herbert','update reservation: Mr. GARY WARNER #ref:BGI-PC5NNVN4','2016-01-18 09:16:46'),
(25,'Alvin Herbert','update reservation: Mr. GARY WARNER #ref:BGI-PC5NNVN4','2016-01-18 09:16:51'),
(26,'Rhonda Niles','update arrival details: #ref:BGI-DJX52PYW','2016-01-18 16:07:42'),
(27,'Rhonda Niles','update reservation: Mr. ANTHONY MCCALL #ref:BGI-KN2BYNFT','2016-01-18 16:08:19'),
(28,'Rhonda Niles','add new reservation: Mr. JAMES BIRRELL #ref:BGI-MRKRF9C8','2016-01-18 16:13:00'),
(29,'Lisa Thompson','add tour operator: Audley Travel','2016-01-18 16:14:47'),
(30,'Rhonda Niles','add new reservation: Mr. ALBERT GRIFFITHS #ref:BGI-D6FDQPYQ','2016-01-18 16:20:26'),
(31,'Rhonda Niles','update reservation: Mr. GAVIN CLIFFORD #ref:BGI-K63BFNQX','2016-01-18 16:21:41'),
(32,'Rhonda Niles','update reservation: Mr. LAURENCE ASH #ref:BGI-DJX52PYW','2016-01-18 16:22:01'),
(33,'Rhonda Niles','update reservation: Mr. ANTHONY MCCALL #ref:BGI-KN2BYNFT','2016-01-18 16:22:37'),
(34,'Rhonda Niles','add new reservation: Mr. LAURENCE ASH #ref:BGI-NJGBWXBT','2016-01-18 16:25:44'),
(35,'Rhonda Niles','add new reservation: Mr. TIMOTHY WHEELER #ref:BGI-H2BC46G8','2016-01-18 16:29:02'),
(36,'Rhonda Niles','add new flight number: TCX816','2016-01-18 16:29:28'),
(37,'Rhonda Niles','add new flight number: TCX817','2016-01-18 16:29:34'),
(38,'Rhonda Niles','add flight time: 18:05 for flight TCX816','2016-01-18 16:31:00'),
(39,'Rhonda Niles','update flight number: TCX816','2016-01-18 16:31:08'),
(40,'Rhonda Niles','add flight time: 19:55 for flight TCX817','2016-01-18 16:31:42'),
(41,'Rhonda Niles','add new location: Infinity On The Beach','2016-01-18 16:32:41'),
(42,'Lisa Thompson','add new reservation: Mr. Richard Tickner #ref:BGI-34T9953C','2016-01-18 16:33:47'),
(43,'Rhonda Niles','update arrival details: #ref:BGI-H2BC46G8','2016-01-18 16:33:49'),
(44,'Rhonda Niles','update arrival details: #ref:BGI-H2BC46G8','2016-01-18 16:34:16'),
(45,'Rhonda Niles','update reservation: Mr. TIMOTHY WHEELER #ref:BGI-H2BC46G8','2016-01-18 16:34:22'),
(46,'Lisa Thompson','delete guest:   from ref#:BGI-34T9953C','2016-01-18 16:34:47'),
(47,'Lisa Thompson','update reservation: Mr. Richard Tickner #ref:BGI-34T9953C','2016-01-18 16:36:02'),
(48,'Rhonda Niles','update arrival details: #ref:BGI-MRKRF9C8','2016-01-18 16:36:07'),
(49,'Rhonda Niles','update arrival details: #ref:BGI-MRKRF9C8','2016-01-18 16:36:23'),
(50,'Rhonda Niles','update arrival details: #ref:BGI-D6FDQPYQ','2016-01-18 16:36:49'),
(51,'Rhonda Niles','update arrival details: #ref:BGI-D6FDQPYQ','2016-01-18 16:37:09'),
(52,'Lisa Thompson','update reservation: Mr. Richard Tickner #ref:BGI-34T9953C','2016-01-18 16:37:22'),
(53,'Rhonda Niles','update arrival details: #ref:BGI-D6FDQPYQ','2016-01-18 16:37:33'),
(54,'Rhonda Niles','update arrival details: #ref:BGI-D6FDQPYQ','2016-01-18 16:37:47'),
(55,'Rhonda Niles','update arrival details: #ref:BGI-D6FDQPYQ','2016-01-18 16:38:08'),
(56,'Rhonda Niles','update arrival details: #ref:BGI-NJGBWXBT','2016-01-18 16:38:45'),
(57,'Rhonda Niles','update arrival details: #ref:BGI-NJGBWXBT','2016-01-18 16:38:58'),
(58,'Rhonda Niles','update arrival details: #ref:BGI-H2BC46G8','2016-01-18 16:39:41'),
(59,'Rhonda Niles','update arrival details: #ref:BGI-H2BC46G8','2016-01-18 16:39:59'),
(60,'Lisa Thompson','add flight time: 15:30 for flight VS29','2016-01-18 16:40:05'),
(61,'Lisa Thompson','add flight time: 18:20 for flight VS30','2016-01-18 16:40:42'),
(62,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-18 16:42:09'),
(63,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-18 16:44:12'),
(64,'Rhonda Niles','update arrival details: #ref:BGI-H2BC46G8','2016-01-18 16:45:46'),
(65,'Lisa Thompson','update reservation: Mr. Richard Tickner #ref:BGI-34T9953C','2016-01-18 16:46:50'),
(66,'Rhonda Niles','add new reservation: Mr. NORTON RODNEY #ref:BGI-JBP6XZHM','2016-01-18 16:49:32'),
(67,'Rhonda Niles','add new reservation: Mr. BRYAM BEATHAM #ref:BGI-JRRZ35J9','2016-01-18 16:52:44'),
(68,'Lisa Thompson','add new reservation: Mr. Peter Johnson #ref:BGI-M4PVFZZF','2016-01-18 16:53:40'),
(69,'Rhonda Niles','add new reservation: Mr. KEVIN NESS #ref:BGI-8Q9F9C4W','2016-01-18 16:55:17'),
(70,'Rhonda Niles','add new flight number: TCX726','2016-01-18 16:55:35'),
(71,'Rhonda Niles','add new flight number: TCX727','2016-01-18 16:55:48'),
(72,'Lisa Thompson','add new flight number: Li 521','2016-01-18 16:56:12'),
(73,'Rhonda Niles','add new flight number: TCX855','2016-01-18 16:56:14'),
(74,'Lisa Thompson','add flight time: 11:30 for flight LI521','2016-01-18 16:56:37'),
(75,'Rhonda Niles','add flight time: 19:55 for flight TCX817','2016-01-18 16:57:46'),
(76,'Rhonda Niles','add flight time: 20:20 for flight TCX855','2016-01-18 16:58:12'),
(77,'Rhonda Niles','update reservation: Mr. NORTON RODNEY #ref:BGI-JBP6XZHM','2016-01-18 16:59:01'),
(78,'Lisa Thompson','update flight number: LI521','2016-01-18 16:59:04'),
(79,'Lisa Thompson','add flight time: 11:30 for flight LI521','2016-01-18 16:59:24'),
(80,'Rhonda Niles','update arrival details: #ref:BGI-JRRZ35J9','2016-01-18 16:59:52'),
(81,'Rhonda Niles','add flight time: 14:15 for flight TCX726','2016-01-18 17:00:15'),
(82,'Lisa Thompson','update arrival details: #ref:BGI-M4PVFZZF','2016-01-18 17:00:31'),
(83,'Rhonda Niles','update arrival details: #ref:BGI-JRRZ35J9','2016-01-18 17:00:44'),
(84,'Rhonda Niles','update reservation: Mr. BRYAN BEATHAM #ref:BGI-JRRZ35J9','2016-01-18 17:00:54'),
(85,'Rhonda Niles','update reservation: Mr. BRYAN BEATHAM #ref:BGI-JRRZ35J9','2016-01-18 17:01:05'),
(86,'Rhonda Niles','add new reservation: Mr. PHILIP NIELD #ref:BGI-ZKJ7RFPY','2016-01-18 17:03:44'),
(87,'Rhonda Niles','add flight time: 16:15 for flight TCX727','2016-01-18 17:04:15'),
(88,'Rhonda Niles','update arrival details: #ref:BGI-8Q9F9C4W','2016-01-18 17:05:29'),
(89,'Rhonda Niles','update arrival details: #ref:BGI-8Q9F9C4W','2016-01-18 17:05:59'),
(90,'Rhonda Niles','update arrival details: #ref:BGI-ZKJ7RFPY','2016-01-18 17:07:03'),
(91,'Rhonda Niles','add new reservation: Mr. MALCOLM UNWIN #ref:BGI-HRVM6Z4Y','2016-01-18 17:10:01'),
(92,'Lisa Thompson','add new reservation: Mr. Lewis Garfield #ref:BGI-DSHZP36B','2016-01-18 17:10:35'),
(93,'Rhonda Niles','add new location: Travellers Palm','2016-01-18 17:10:39'),
(94,'Lisa Thompson','add flight time: 17:55 for flight BA2154','2016-01-18 17:11:29'),
(95,'Rhonda Niles','update arrival details: #ref:BGI-HRVM6Z4Y','2016-01-18 17:11:58'),
(96,'Rhonda Niles','update arrival details: #ref:BGI-HRVM6Z4Y','2016-01-18 17:12:19'),
(97,'Rhonda Niles','update reservation: Mr. MALCOLM UNWIN #ref:BGI-HRVM6Z4Y','2016-01-18 17:14:34'),
(98,'Lisa Thompson','update reservation: Mr. PETER JOHNSON #ref:BGI-M4PVFZZF','2016-01-18 17:16:24'),
(99,'Rhonda Niles','add new reservation: Mr. STEPHEN KIM #ref:BGI-K24JYJNK','2016-01-18 17:19:39'),
(100,'Rhonda Niles','add flight time: 14:50 for flight VS29','2016-01-18 17:20:07'),
(101,'Rhonda Niles','add flight time: 17:50 for flight VS30','2016-01-18 17:21:02'),
(102,'Rhonda Niles','update reservation: Mr. STEPHEN BURGESS #ref:BGI-K24JYJNK','2016-01-18 17:21:27'),
(103,'Rhonda Niles','update arrival details: #ref:BGI-K24JYJNK','2016-01-18 17:21:52'),
(104,'Rhonda Niles','update arrival details: #ref:BGI-K24JYJNK','2016-01-18 17:22:12'),
(105,'Rhonda Niles','add new reservation: Mrs. MOLLIE BUCKLEY #ref:BGI-ZJQDK6C8','2016-01-18 17:26:28'),
(106,'Rhonda Niles','add flight time: 18:15 for flight VS77','2016-01-18 17:26:48'),
(107,'Rhonda Niles','add flight time: 20:45 for flight VS78','2016-01-18 17:27:10'),
(108,'Rhonda Niles','update arrival details: #ref:BGI-ZJQDK6C8','2016-01-18 17:27:38'),
(109,'Rhonda Niles','update arrival details: #ref:BGI-ZJQDK6C8','2016-01-18 17:27:53'),
(110,'Lisa Thompson','add new reservation: Mr. MARTIN RILEY #ref:BGI-ST9JH9QY','2016-01-18 17:29:16'),
(111,'Rhonda Niles','update arrival details: #ref:BGI-ZJQDK6C8','2016-01-18 17:29:52'),
(112,'Rhonda Niles','update reservation: Mrs. MOLLIE BUCKLEY #ref:BGI-ZJQDK6C8','2016-01-18 17:30:16'),
(113,'Lisa Thompson','add new reservation: Mr. LAURENCE UPTON #ref:BGI-KV4BX4W6','2016-01-18 17:37:22'),
(114,'Rhonda Niles','add new reservation: Mr. RICHARD OWEN #ref:BGI-GQT8TMXD','2016-01-18 17:39:20'),
(115,'Rhonda Niles','add new reservation: Mr. RICHARD ALLISON #ref:BGI-VSSC83H5','2016-01-18 17:44:43'),
(116,'Dale Brewster','add flight time: 13:35 for flight LI772','2016-01-19 10:04:07'),
(117,'Dale Brewster','add new reservation: Mr. A HARTWIG #ref:BGI-NNP2SMFG','2016-01-19 10:08:43'),
(118,'Dale Brewster','add new reservation: Mr. CLIVE BINGHAM #ref:BGI-K5MMRMQD','2016-01-19 10:13:57'),
(119,'Dale Brewster','add new reservation: Mr. JOZSEF ILLES #ref:BGI-J8PNMQ7K','2016-01-19 10:19:11'),
(120,'Lisa Thompson','add new flight number: GAA606','2016-01-19 10:47:48'),
(121,'Lisa Thompson','add flight time: 13:00 for flight GAA606','2016-01-19 10:48:27'),
(122,'Dale Brewster','add new reservation: Mr. NORMAN STORY #ref:BGI-KWB4QJQ4','2016-01-19 10:48:27'),
(123,'Dale Brewster','add new flight number: BA2153','2016-01-19 10:48:46'),
(124,'Dale Brewster','add flight time: 18:35 for flight BA2153','2016-01-19 10:49:38'),
(125,'Dale Brewster','add flight time: 18:10 for flight BA2153','2016-01-19 10:50:16'),
(126,'Lisa Thompson','add new flight number: GAA605','2016-01-19 10:50:37'),
(127,'Lisa Thompson','add flight time: 11:45 for flight GAA605','2016-01-19 10:51:13'),
(128,'Dale Brewster','update arrival details: #ref:BGI-KWB4QJQ4','2016-01-19 10:54:34'),
(129,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-19 10:55:09'),
(130,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-19 10:55:46'),
(131,'Dale Brewster','update arrival details: #ref:BGI-KWB4QJQ4','2016-01-19 10:56:39'),
(132,'Lisa Thompson','update reservation: Mr. Richard Tickner #ref:BGI-34T9953C','2016-01-19 10:57:00'),
(133,'Lisa Thompson','update arrival details: #ref:BGI-M4PVFZZF','2016-01-19 10:59:49'),
(134,'Dale Brewster','update arrival details: #ref:BGI-J8PNMQ7K','2016-01-19 10:59:56'),
(135,'Lisa Thompson','update arrival details: #ref:BGI-M4PVFZZF','2016-01-19 11:02:44'),
(136,'Lisa Thompson','update arrival details: #ref:BGI-M4PVFZZF','2016-01-19 11:05:03'),
(137,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-19 11:05:52'),
(138,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-19 11:06:41'),
(139,'Lisa Thompson','update arrival details: #ref:BGI-34T9953C','2016-01-19 11:06:54'),
(140,'Lisa Thompson','add new reservation: Mr. D CLARKE #ref:BGI-DG8QSQNG','2016-01-19 11:45:25'),
(141,'Lisa Thompson','add new flight number: GAA616','2016-01-19 11:45:52'),
(142,'Lisa Thompson','add new flight number: GAA609','2016-01-19 11:46:06'),
(143,'Lisa Thompson','add new flight number: GAA607','2016-01-19 11:46:16'),
(144,'Lisa Thompson','add flight time: 1630 for flight GAA616','2016-01-19 11:46:45'),
(145,'Lisa Thompson','add flight time: 1515 for flight GAA609','2016-01-19 11:47:18'),
(146,'Lisa Thompson','add flight time: 1515 for flight GAA607','2016-01-19 11:47:45'),
(147,'Lisa Thompson','update arrival details: #ref:BGI-DG8QSQNG','2016-01-19 11:49:07'),
(148,'Lisa Thompson','update arrival details: #ref:BGI-DG8QSQNG','2016-01-19 11:49:46'),
(149,'Lisa Thompson','update arrival details: #ref:BGI-DG8QSQNG','2016-01-19 11:51:10'),
(150,'Lisa Thompson','Update transfer details for reservation: BGI-DG8QSQNG','2016-01-19 11:51:46'),
(151,'Lisa Thompson','update reservation: Mr. D CLARKE #ref:BGI-DG8QSQNG','2016-01-19 11:52:34'),
(152,'Lisa Thompson','add new reservation: Mr. A DENNIS #ref:BGI-T3BQFVG2','2016-01-19 11:57:52'),
(153,'Lisa Thompson','add flight time: 1730 for flight VS30','2016-01-19 11:58:24'),
(154,'Lisa Thompson','update arrival details: #ref:BGI-T3BQFVG2','2016-01-19 11:59:57'),
(155,'Lisa Thompson','add new reservation: Mr. D HUCKSON #ref:BGI-4H382DQT','2016-01-19 12:05:51'),
(156,'Rhonda Niles','add new reservation: Mr. FREDERICK JONES #ref:BGI-TT6WG7HJ','2016-01-19 12:09:42'),
(157,'Lisa Thompson','add new reservation: Mrs. S KELLY #ref:BGI-CGZY3SRZ','2016-01-19 12:09:52'),
(158,'Rhonda Niles','add new reservation: Mr. ROBERT DEANE #ref:BGI-DS4ZPSDT','2016-01-19 12:12:26'),
(159,'Lisa Thompson','add new reservation: Mr. J WILDE #ref:BGI-RW7ZCMHQ','2016-01-19 12:13:10'),
(160,'Rhonda Niles','add new reservation: Mr. BARTHOLOMEW ALDWINKLE #ref:BGI-F289P3T3','2016-01-19 12:15:38'),
(161,'Rhonda Niles','add new reservation: Mr. HEDLEY ASHMAN #ref:BGI-JPBSQD2Y','2016-01-19 12:20:33'),
(162,'Rhonda Niles','add new reservation: Mr. BRUCE GORDON #ref:BGI-X4GSD6NN','2016-01-19 12:29:52'),
(163,'Rhonda Niles','add new reservation: Mr. TREVOPR RAYNOR #ref:BGI-74Y38HWT','2016-01-19 12:35:25'),
(164,'Rhonda Niles','add flight time: 08:30 for flight LI560','2016-01-19 12:35:53'),
(165,'Rhonda Niles','update flight number: LI560','2016-01-19 12:36:05'),
(166,'Rhonda Niles','update arrival details: #ref:BGI-74Y38HWT','2016-01-19 12:36:46'),
(167,'Rhonda Niles','update reservation: Mr. TREVOPR RAYNOR #ref:BGI-74Y38HWT','2016-01-19 12:38:21'),
(168,'Rhonda Niles','add new reservation: Mr. ALAN KER #ref:BGI-BMXFGZHP','2016-01-19 12:46:29'),
(169,'Rhonda Niles','add new reservation: Mrs. ANGELA QUINN #ref:BGI-VT39T2HR','2016-01-19 12:52:27'),
(170,'Rhonda Niles','add new reservation: Mr. ROBERT ROBERT #ref:BGI-WBGG9J3H','2016-01-19 12:57:09'),
(171,'Rhonda Niles','update reservation: Mr. ROBERT DEANE #ref:BGI-DS4ZPSDT','2016-01-19 13:16:31'),
(172,'Rhonda Niles','update reservation: Mr. BARTHOLOMEW ALDWINKLE #ref:BGI-F289P3T3','2016-01-19 13:16:50'),
(173,'Rhonda Niles','update reservation: Mr. BRUCE GORDON #ref:BGI-X4GSD6NN','2016-01-19 13:17:07'),
(174,'Rhonda Niles','update reservation: Mrs. ANGELA QUINN #ref:BGI-VT39T2HR','2016-01-19 13:17:20'),
(175,'Rhonda Niles','update reservation: Mrs. ANGELA QUINN #ref:BGI-VT39T2HR','2016-01-19 13:22:34'),
(176,'Dale Brewster','add new reservation: Mr. R ROBSON #ref:BGI-RVJJTMCB','2016-01-19 13:24:48'),
(177,'Dale Brewster','add new reservation: Mr. N BILHAM #ref:BGI-6ZC78QYD','2016-01-19 13:28:51'),
(178,'Rhonda Niles','add new reservation: Mr. LEE COVENEY #ref:BGI-2F8DGPFZ','2016-01-19 13:29:04'),
(179,'Dale Brewster','add flight time: 2015 for flight BA2152','2016-01-19 13:29:22'),
(180,'Rhonda Niles','add new location: Intransit','2016-01-19 13:29:30'),
(181,'Dale Brewster','update flight number: BA2152','2016-01-19 13:29:38'),
(182,'Rhonda Niles','add new flight number: LI306','2016-01-19 13:30:29'),
(183,'Rhonda Niles','add flight time: 1020 for flight LI306','2016-01-19 13:30:44'),
(184,'Rhonda Niles','add flight time: 1030 for flight LI306','2016-01-19 13:30:53'),
(185,'Rhonda Niles','add flight time: 1025 for flight LI306','2016-01-19 13:31:03'),
(186,'Rhonda Niles','update flight time: 10:20 for flight LI306','2016-01-19 13:31:13'),
(187,'Rhonda Niles','update flight time: 10:30 for flight LI306','2016-01-19 13:31:20'),
(188,'Rhonda Niles','update flight time: 10:25 for flight LI306','2016-01-19 13:31:26'),
(189,'Rhonda Niles','update flight number: LI306','2016-01-19 13:31:40'),
(190,'Rhonda Niles','update arrival details: #ref:BGI-2F8DGPFZ','2016-01-19 13:33:34'),
(191,'Dale Brewster','add new location: Sugar Bay','2016-01-19 13:34:13'),
(192,'Rhonda Niles','update reservation: Mr. LEE COVENEY #ref:BGI-2F8DGPFZ','2016-01-19 13:34:24'),
(193,'Rhonda Niles','update reservation: Mr. LEE COVENEY #ref:BGI-2F8DGPFZ','2016-01-19 13:34:29'),
(194,'Dale Brewster','update arrival details: #ref:BGI-6ZC78QYD','2016-01-19 13:35:03'),
(195,'Dale Brewster','update arrival details: #ref:BGI-6ZC78QYD','2016-01-19 13:35:30'),
(196,'Dale Brewster','add new reservation: Mr. T BIRD #ref:BGI-34SGGHK6','2016-01-19 13:38:52'),
(197,'Dale Brewster','add flight time: 1710 for flight BA2154','2016-01-19 13:39:24'),
(198,'Dale Brewster','add flight time: 1720 for flight BA2154','2016-01-19 13:39:34'),
(199,'Dale Brewster','update flight number: BA2154','2016-01-19 13:39:45'),
(200,'Rhonda Niles','add new reservation: Mr. ROSS PRENTICE #ref:BGI-K3F25P36','2016-01-19 13:40:01'),
(201,'Dale Brewster','update arrival details: #ref:BGI-34SGGHK6','2016-01-19 13:40:42'),
(202,'Dale Brewster','update flight time: 17:10 for flight BA2154','2016-01-19 13:41:42'),
(203,'Dale Brewster','update flight time: 17:20 for flight BA2154','2016-01-19 13:41:55'),
(204,'Rhonda Niles','update arrival details: #ref:BGI-K3F25P36','2016-01-19 13:42:24'),
(205,'Dale Brewster','update arrival details: #ref:BGI-34SGGHK6','2016-01-19 13:42:33'),
(206,'Rhonda Niles','update reservation: Mr. ROSS PRENTICE #ref:BGI-K3F25P36','2016-01-19 13:42:52'),
(207,'Rhonda Niles','add new reservation: Mr. JOHN GOODGAME #ref:BGI-X8RG3HDT','2016-01-19 13:46:50'),
(208,'Rhonda Niles','update arrival details: #ref:BGI-X8RG3HDT','2016-01-19 13:47:41'),
(209,'Rhonda Niles','add new reservation: Mr. PETER O&#039;BRIEN #ref:BGI-94852ZHD','2016-01-19 13:51:59'),
(210,'Rhonda Niles','update arrival details: #ref:BGI-94852ZHD','2016-01-19 13:52:48'),
(211,'Rhonda Niles','update reservation: Mr. PETER O&#039;BRIEN #ref:BGI-94852ZHD','2016-01-19 13:52:57'),
(212,'Rhonda Niles','update flight time: 20:15 for flight BA2152','2016-01-19 13:53:33'),
(213,'Rhonda Niles','update arrival details: #ref:BGI-94852ZHD','2016-01-19 13:54:17'),
(214,'Rhonda Niles','update arrival details: #ref:BGI-94852ZHD','2016-01-19 13:54:33'),
(215,'Rhonda Niles','update arrival details: #ref:BGI-MRKRF9C8','2016-01-19 13:56:16'),
(216,'Rhonda Niles','add new reservation: Mr. JOHN MOGAN #ref:BGI-NRBQ3NSJ','2016-01-19 13:59:02'),
(217,'Rhonda Niles','update flight time: 17:30 for flight VS30','2016-01-19 13:59:29'),
(218,'Rhonda Niles','update arrival details: #ref:BGI-NRBQ3NSJ','2016-01-19 14:01:36'),
(219,'Lisa Thompson','add new reservation: Mr. ERIC ACLAND #ref:BGI-RQCCY4S3','2016-01-19 14:06:29'),
(220,'Lisa Thompson','add new reservation: Mrs. SHELLEY PATON-EADES #ref:BGI-6XM73S4B','2016-01-19 14:22:22'),
(221,'Lisa Thompson','add new location: Sunbay Hotel','2016-01-19 14:23:19'),
(222,'Lisa Thompson','update arrival details: #ref:BGI-6XM73S4B','2016-01-19 14:25:09'),
(223,'Lisa Thompson','update arrival details: #ref:BGI-6XM73S4B','2016-01-19 14:25:43'),
(224,'Lisa Thompson','update reservation: Mr. PETER JOHNSON #ref:BGI-M4PVFZZF','2016-01-19 14:26:47'),
(225,'Lisa Thompson','update reservation: Mr. Lewis Garfield #ref:BGI-DSHZP36B','2016-01-19 14:30:31'),
(226,'Lisa Thompson','update reservation: Mr. MARTIN RILEY #ref:BGI-ST9JH9QY','2016-01-19 14:33:21'),
(227,'Lisa Thompson','update arrival details: #ref:BGI-DSHZP36B','2016-01-19 14:38:00'),
(228,'Lisa Thompson','update reservation: Mr. Lewis Garfield #ref:BGI-DSHZP36B','2016-01-19 14:39:53'),
(229,'Lisa Thompson','update reservation: Mr. LAURENCE UPTON #ref:BGI-KV4BX4W6','2016-01-19 14:40:49'),
(230,'Lisa Thompson','update reservation: Mr. D CLARKE #ref:BGI-DG8QSQNG','2016-01-19 14:41:22'),
(231,'Lisa Thompson','update reservation: Mr. A DENNIS #ref:BGI-T3BQFVG2','2016-01-19 14:41:41'),
(232,'Lisa Thompson','update reservation: Mr. D HUCKSON #ref:BGI-4H382DQT','2016-01-19 14:42:03'),
(233,'Lisa Thompson','update reservation: Mrs. S KELLY #ref:BGI-CGZY3SRZ','2016-01-19 14:42:27'),
(234,'Lisa Thompson','update reservation: Mrs. S KELLY #ref:BGI-CGZY3SRZ','2016-01-19 14:42:59'),
(235,'Lisa Thompson','update reservation: Mr. J WILDE #ref:BGI-RW7ZCMHQ','2016-01-19 14:43:19'),
(236,'Rhema Reid','update reservation: Mr. mickey mouse #ref:BGI-MP2XV3HR','2016-01-19 14:43:54'),
(237,'Rhema Reid','update reservation: Mr. mickey mouse #ref:BGI-MP2XV3HR','2016-01-19 14:44:01'),
(238,'Alvin Herbert','update reservation: Mr. mickey mouse #ref:BGI-MP2XV3HR','2016-01-19 14:44:18'),
(239,'Lisa Thompson','update reservation: Mr. ERIC ACLAND #ref:BGI-RQCCY4S3','2016-01-19 14:44:24'),
(240,'Lisa Thompson','update reservation: Mrs. SHELLEY PATON-EADES #ref:BGI-6XM73S4B','2016-01-19 14:45:22'),
(241,'Rhema Reid','update reservation: Mr. mickey mouse #ref:BGI-MP2XV3HR','2016-01-19 14:50:59'),
(242,'Lisa Thompson','add new reservation: Mr. MARK TRACEY #ref:BGI-KXK7PTFQ','2016-01-19 14:51:04'),
(243,'Lisa Thompson','add new reservation: Mrs. PATRICIA WORLD #ref:BGI-5HWY4S6W','2016-01-19 15:03:14'),
(244,'Dale Brewster','add new reservation: Mr. S CORNEY #ref:BGI-27Q2PNGZ','2016-01-19 15:04:04'),
(245,'Dale Brewster','update arrival details: #ref:BGI-J8PNMQ7K','2016-01-19 15:05:40'),
(246,'Lisa Thompson','add new reservation: Mrs. CHARLOTTE EXLEY #ref:BGI-SVSJYZGG','2016-01-19 15:05:46'),
(247,'Dale Brewster','update reservation: Mr. JOZSEF ILLES #ref:BGI-J8PNMQ7K','2016-01-19 15:08:54'),
(248,'Rhema Reid','add new fast track reservation:  Mr. DENIS LANGTON #ref:BGI-PZNT8BGZ','2016-01-19 15:09:30'),
(249,'Rhema Reid','update reservation: Mr. DENIS LANGTON #ref:BGI-PZNT8BGZ','2016-01-19 15:10:21'),
(250,'Rhema Reid','add new fast track reservation:  Mr. MICHAEL GOLDBERG  #ref:BGI-PTWKXF56','2016-01-19 15:13:42'),
(251,'Rhema Reid','add new fast track reservation:  Mrs. GAYNOR SELLORS  #ref:BGI-ZMFYPXYW','2016-01-19 15:17:49'),
(252,'Dale Brewster','add new reservation: Mr. KARL DANIELS #ref:BGI-73QFQBKM','2016-01-19 15:18:36'),
(253,'Rhema Reid','add new arrival: #ref:BGI-ZMFYPXYW','2016-01-19 15:24:09'),
(254,'Lisa Thompson','add new reservation: Mr. ANDREW HOLLAND #ref:BGI-8VTQXV52','2016-01-19 15:24:12'),
(255,'Dale Brewster','add new reservation: Mr. W RENNIE #ref:BGI-JF529WK2','2016-01-19 15:32:38'),
(256,'Dale Brewster','add new reservation: Mr. charles collett #ref:BGI-XK535637','2016-01-19 15:41:03'),
(257,'Dale Brewster','add new reservation: Mr. MARTIN HUGHES #ref:BGI-MKPJWV94','2016-01-19 15:59:27'),
(258,'Dale Brewster','update flight number: AA2572','2016-01-19 15:59:54'),
(259,'Dale Brewster','update flight time: 08:00 for flight AA2572','2016-01-19 16:00:25'),
(260,'Dale Brewster','update flight number: AA2572','2016-01-19 16:00:39'),
(261,'Dale Brewster','add flight time: 19:10 for flight AA2572','2016-01-19 16:01:12'),
(262,'Dale Brewster','update arrival details: #ref:BGI-MKPJWV94','2016-01-19 16:02:07'),
(263,'Dale Brewster','add new reservation: Mr. william mcIntosh #ref:BGI-7PPQ7NN7','2016-01-19 16:10:29'),
(264,'Dale Brewster','add new flight number: GAA614','2016-02-04 16:08:10'),
(265,'Dale Brewster','add new flight number: sVG616','2016-02-04 16:08:28'),
(266,'Dale Brewster','add new flight number: LI524','2016-02-04 16:08:42'),
(267,'Dale Brewster','add flight time: 16:30 for flight GAA614','2016-02-04 16:09:18'),
(268,'Dale Brewster','update flight number: GAA614','2016-02-04 16:09:28'),
(269,'Dale Brewster','update flight number: GAA614','2016-02-04 16:10:01'),
(270,'Dale Brewster','add flight time: 18:05 for flight LI524','2016-02-04 16:11:00'),
(271,'Dale Brewster','update flight number: LI524','2016-02-04 16:11:03'),
(272,'Dale Brewster','update flight number: sVG616','2016-02-04 16:11:57'),
(273,'Dale Brewster','add flight time: 16:30 for flight sVG616','2016-02-05 16:17:34'),
(274,'Dale Brewster','add new reservation: Sir. r hurn #ref:BGI-4KKDH5TR','2016-02-05 16:26:06'),
(275,'Helen Schur Parris','update arrival details: #ref:BGI-PC5NNVN4','2016-02-17 16:40:00'),
(276,'Helen Schur Parris','update arrival details: #ref:BGI-PC5NNVN4','2016-02-17 16:42:46'),
(277,'Helen Schur Parris','add new Inter-Hotel transfer: BGI-PC5NNVN4','2016-02-17 16:59:54'),
(278,'Alvin Herbert','update arrival details: #ref:BGI-MRKRF9C8','2016-02-22 14:33:17'),
(279,'Alvin Herbert','update arrival details: #ref:BGI-MRKRF9C8','2016-02-22 14:34:05'),
(280,'Alvin Herbert','update reservation: Mr. charles collett #ref:BGI-XK535637','2016-03-22 11:58:44'),
(281,'Alvin Herbert','delete transfer from reservation: BGI-XK535637','2016-03-22 12:04:35'),
(282,'Alvin Herbert','update reservation: Mr. charles collett #ref:BGI-XK535637','2016-03-22 12:05:33'),
(283,'Alvin Herbert','update arrival details: #ref:BGI-MKPJWV94','2016-03-22 12:08:39'),
(284,'Alvin Herbert','bug reported: Main arrival update','2016-03-22 12:17:04'),
(285,'Alvin Herbert','bug reported: Main departure update','2016-03-22 12:17:43'),
(286,'Alvin Herbert','bug reported: transfers wont delete from reservation','2016-03-22 12:27:40'),
(287,'Alvin Herbert','add guest: Master. tiler bundy for Ref# BGI-MKPJWV94','2016-03-22 16:49:49'),
(288,'Alvin Herbert','delete guest: tiler bundy from ref#:BGI-MKPJWV94','2016-03-22 16:50:07'),
(289,'Alvin Herbert','update arrival details: #ref:BGI-D6FDQPYQ','2016-03-22 16:52:06'),
(290,'Alvin Herbert','update arrival details: #ref:BGI-D6FDQPYQ','2016-03-22 16:52:55'),
(291,'Alvin Herbert','update arrival details: #ref:BGI-D6FDQPYQ','2016-03-22 16:59:27'),
(292,'Creative Tech','add new reservation: Mr. FIrst Last #ref:BGI-XVBYTWQ2','2016-08-31 08:27:52'),
(293,'Creative Tech','add new reservation: . Haider Hassan #ref:BGI-DHDBSTCW','2016-08-31 08:28:24'),
(294,'Creative Tech','add new reservation: . FIrst Haider #ref:BGI-KX2VXH9Z','2016-08-31 08:28:48'),
(295,'Creative Tech','update reservation: Mr. A HARTWIG #ref:BGI-NNP2SMFG','2016-09-02 03:27:34');

/*Table structure for table `bgi_arrivals` */

DROP TABLE IF EXISTS `bgi_arrivals`;

CREATE TABLE `bgi_arrivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no_sys` varchar(12) NOT NULL,
  `arr_date` date NOT NULL,
  `arr_time` int(11) NOT NULL,
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
  `infant_seats` int(11) NOT NULL,
  `child_seats` int(11) NOT NULL,
  `booster_seats` int(11) NOT NULL,
  `vouchers` int(11) NOT NULL,
  `cold_towel` int(11) NOT NULL,
  `bottled_water` int(11) NOT NULL,
  `rooms` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `arr_main` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_arrivals` */

insert  into `bgi_arrivals`(`id`,`ref_no_sys`,`arr_date`,`arr_time`,`arr_flight_no`,`flight_class`,`arr_transport`,`arr_driver`,`arr_vehicle`,`arr_pickup`,`arr_dropoff`,`room_type`,`rep_type`,`client_reqs`,`arr_transport_notes`,`arr_hotel_notes`,`infant_seats`,`child_seats`,`booster_seats`,`vouchers`,`cold_towel`,`bottled_water`,`rooms`,`room_no`,`arr_main`) values 
(1,'BGI-MP2XV3HR','2016-01-29',87,'57','7','Private Van','23','48','56','16','67','4','Additional Requirements','arrival &amp; transport notes here','hotel notes here',1,1,0,2,3,2,1,'125',0),
(2,'BGI-K63BFNQX','2016-02-03',103,'2','3','Group Transfers (shared)','','','56','14','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(3,'BGI-KN2BYNFT','2016-02-04',0,'0','Select flight class','Private Car','0','','56','29','137','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(4,'BGI-DJX52PYW','2016-02-04',105,'2','6','3','','','56','130','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(5,'BGI-PC5NNVN4','2016-02-04',7,'1','3','Private Car','10','25','56','47','241','2','Pre booked excursion','','',0,1,0,0,1,1,0,'',1),
(6,'BGI-MRKRF9C8','2016-02-05',27,'18','flight class not specified','Private Car','','','56','27','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(7,'BGI-D6FDQPYQ','2016-02-05',27,'18','3','Private Car','','','Airport','14','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(8,'BGI-NJGBWXBT','2016-02-04',105,'2','3',', 3','','','56','130','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(9,'BGI-H2BC46G8','2016-02-04',106,'63','3',', 3','','','56','131','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(10,'BGI-34T9953C','2016-02-01',108,'1','flight class not specified','Private Car','','','56','9','','2','Additional Requirements','','Continental Breakfast ',0,0,0,0,0,0,0,'0',1),
(11,'BGI-34T9953C','2016-02-14',125,'71','not specified','Private Car','','','56','3','211','2','','','Full breakfast',0,0,0,0,0,0,0,'',0),
(12,'BGI-JBP6XZHM','2016-01-04',106,'63','Select flight class','Private Car','0','','56','32','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(13,'BGI-JRRZ35J9','2016-02-07',114,'65','3','Private Car','','','56','130','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(14,'BGI-M4PVFZZF','2016-02-09',113,'67','flight class not specified','Private Car','','','56','25','119','2','Additional Requirements','','Breakfast included',0,0,0,0,0,0,0,'0',1),
(15,'BGI-8Q9F9C4W','2016-02-07',114,'65','3','Private Car','','','56','43','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(16,'BGI-ZKJ7RFPY','2016-02-07',114,'65','Select flight class','Private Car','0','','56','27','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(17,'BGI-HRVM6Z4Y','2016-02-07',114,'65','3','Private Car','','','56','132','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(18,'BGI-DSHZP36B','2016-02-10',103,'2','Select flight class','','0','','56','46','234','2','Additional Requirements','','Breakfast included - moving to one Bedroom Suite on the 22nd February',0,0,0,0,0,0,1,'',1),
(19,'BGI-K24JYJNK','2016-02-06',117,'1','3','Private Car','','','56','1','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(20,'BGI-ZJQDK6C8','2016-02-08',119,'18','3','Private Car','','','56','17','','2','Additional Requirements','','',0,0,0,0,0,0,0,'0',1),
(21,'BGI-ST9JH9QY','2016-02-10',103,'2','Select flight class','Private Car','0','','56','9','0','2','Additional Requirements','','Breakfast &amp; dinner',0,0,0,0,0,0,1,'',1),
(22,'BGI-KV4BX4W6','2016-02-22',119,'18','Select flight class','Private Car','0','','56','3','211','2','Additional Requirements','','Full breakfast',0,0,0,0,0,0,1,'',1),
(23,'BGI-GQT8TMXD','2016-02-08',119,'18','Select flight class','Private Car','0','','56','21','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(24,'BGI-VSSC83H5','2016-02-04',0,'63','Select flight class','Private Car','0','','56','13','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(25,'BGI-NNP2SMFG','2016-02-04',121,'10','Select flight class','No Transfer','0','','56','0','','9','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(26,'BGI-K5MMRMQD','2016-02-04',0,'0','Select flight class','Private Car','0','','57','8','0','2','Additional Requirements','14.00 - Arrive Fred Olsen Cruise','',0,0,0,0,0,0,0,'',1),
(27,'BGI-J8PNMQ7K','2016-02-04',117,'1','flight class not specified','Private Car','','','56','3','','2','Additional Requirements','','',0,0,0,0,2,2,0,'',1),
(28,'BGI-KWB4QJQ4','2016-02-04',123,'70','not specified','Private Car','','','56','1','','2','Additional Requirements','FT c/o Hotel','',0,0,0,0,2,2,0,'',1),
(29,'BGI-DG8QSQNG','2016-02-01',108,'1','6','No Transfer','0','','0','0','','3','Additional Requirements','UNION','',0,0,0,0,0,0,0,'',1),
(30,'BGI-DG8QSQNG','2016-02-11',127,'73','flight class not specified','No Transfer','','','','','','3','','','',0,0,0,0,0,0,0,'',0),
(31,'BGI-T3BQFVG2','2016-02-01',108,'1','6','Private Car','0','','56','36','181','2','Additional Requirements','','',0,0,0,0,0,0,1,'',1),
(32,'BGI-4H382DQT','2016-02-01',108,'1','5','No Transfer','0','','0','0','','9','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(33,'BGI-4H382DQT','2016-02-09',128,'74','Select flight class','No Transfer','0','','0','0','','9','','','',0,0,0,0,0,0,0,'',0),
(34,'BGI-TT6WG7HJ','2016-02-05',119,'18','Select flight class','Private Car','0','','56','21','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(35,'BGI-CGZY3SRZ','2016-02-01',119,'18','6','Group Transfers (shared)','0','','56','4','145','2','Additional Requirements','','',0,0,0,0,0,0,1,'',1),
(36,'BGI-DS4ZPSDT','2016-02-05',119,'18','Select flight class','Private Car','0','','56','1','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(37,'BGI-RW7ZCMHQ','2016-01-01',119,'18','6','Private Car','0','','56','49','249','2','Additional Requirements','','',0,0,0,0,0,0,1,'',1),
(38,'BGI-F289P3T3','2016-02-06',117,'1','Select flight class','Private Car','0','','56','57','0','2','Additional Requirements','Arrival Transfer only','',0,0,0,0,0,0,0,'',1),
(39,'BGI-JPBSQD2Y','2016-02-08',119,'18','Select flight class','Group Transfers (shared)','0','','56','14','0','2','Additional Requirements','','',0,0,0,0,0,0,1,'',1),
(40,'BGI-X4GSD6NN','2016-02-05',108,'1','Select flight class','Private Car','0','','56','29','0','2','Additional Requirements','Arrival transfer only','',0,0,0,0,0,0,1,'',1),
(41,'BGI-74Y38HWT','2016-02-05',105,'2','Select flight class','Group Transfers (shared)','0','','56','10','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(42,'BGI-BMXFGZHP','2016-02-08',119,'18','Select flight class','Group Transfers (shared)','0','','56','49','248','2','Additional Requirements','','',0,0,0,0,0,0,2,'',1),
(43,'BGI-VT39T2HR','2016-02-05',105,'2','Select flight class','Merc/BMW','0','','56','21','0','2','Additional Requirements','2 Merc/BMW','',0,0,0,0,0,0,0,'',1),
(44,'BGI-WBGG9J3H','2016-02-08',119,'18','Select flight class','Private Car','0','','56','130','0','2','Additional Requirements','','',0,0,0,0,0,0,1,'',1),
(45,'BGI-RVJJTMCB','2016-02-04',105,'2','Select flight class','Private Car','0','','56','43','0','1','Additional Requirements','Mrs requires wheelchair assistance','',0,0,0,0,0,0,0,'',1),
(46,'BGI-6ZC78QYD','2016-02-04',123,'70','flight class not specified','Private Car','','','56','134','0','1','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(47,'BGI-2F8DGPFZ','2016-02-04',132,'75','flight class not specified','No Transfer','','','56','133','0','1','Additional Requirements','Lounge Tickets','',0,0,0,2,0,0,0,'',1),
(48,'BGI-34SGGHK6','2016-02-04',123,'70','Select flight class','Group Transfers (shared)','0','','56','13','0','1','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(49,'BGI-K3F25P36','2016-02-05',132,'75','flight class not specified','No Transfer','','','56','133','','1','Additional Requirements','Lounge Tickets','',0,0,0,2,0,0,0,'',1),
(50,'BGI-X8RG3HDT','2016-02-06',132,'75','flight class not specified','No Transfer','','','56','133','','1','Additional Requirements','Lounge Tickets','',0,0,0,2,0,0,0,'',1),
(51,'BGI-94852ZHD','2016-02-06',26,'17','flight class not specified','No Transfer','','','56','133','','1','Additional Requirements','Lounge Tickets','',0,0,0,0,0,0,0,'',1),
(52,'BGI-NRBQ3NSJ','2016-02-08',132,'75','flight class not specified','No Transfer','','','56','133','','1','Additional Requirements','Lounge Tickets','',0,0,0,2,0,0,0,'',1),
(53,'BGI-RQCCY4S3','2016-02-08',119,'18','Select flight class','','0','','56','27','0','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(54,'BGI-6XM73S4B','2016-02-06',117,'1','flight class not specified','Group Transfers (shared)','','','56','135','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(55,'BGI-KXK7PTFQ','2016-02-06',117,'1','Select flight class','Private Car','0','','56','41','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(56,'BGI-5HWY4S6W','2016-02-05',119,'18','Select flight class','Group Transfers (shared)','0','','56','19','0','2','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(57,'BGI-27Q2PNGZ','2016-02-04',123,'70','Select flight class','Group Transfers (shared)','0','','56','55','0','1','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(58,'BGI-SVSJYZGG','2016-02-05',119,'18','Select flight class','Group Transfers (shared)','0','','56','49','0','1','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(59,'BGI-PZNT8BGZ','2016-02-19',119,'18','6','','0','','0','24','0','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(60,'BGI-PTWKXF56','2016-02-16',117,'1','Select flight class','','0','','0','17','0','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(61,'BGI-ZMFYPXYW','0000-00-00',0,'0','Select flight class','','0','','0','2','0','Representation','Additional Requirements','TAKE TO SANDALS REP ','',0,0,0,0,0,0,0,'',1),
(62,'BGI-73QFQBKM','2016-02-06',123,'70','Select flight class','Private Car','0','','56','15','0','2','Car hire','','',0,0,0,0,2,2,0,'',1),
(63,'BGI-ZMFYPXYW','2016-02-23',103,'2','Select flight class','','0','','Pickup Location','0','','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',0),
(64,'BGI-8VTQXV52','2016-02-05',119,'18','Select flight class','Group Transfers (shared)','0','','56','27','0','1','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(65,'BGI-JF529WK2','2016-02-04',123,'70','Select flight class','Group Transfers (shared)','0','','56','23','0','1','Additional Requirements','Miss R Rennie is 14 years','',0,0,0,0,0,0,0,'',1),
(66,'BGI-XK535637','2016-02-03',103,'2','8','Merc/BMW','0','','56','17','70','2','Additional Requirements','','Bed &amp; B&#039;fast; Request King bed',0,0,0,0,2,2,0,'',1),
(67,'BGI-MKPJWV94','2016-02-05',105,'2','8','Merc/BMW','0','','56','46','234','2','Additional Requirements','Repeat guests','Half-Board; Rsvn #149012',0,0,0,0,2,2,0,'',1),
(68,'BGI-7PPQ7NN7','2016-02-05',119,'18','5','Hotel transfer','0','','56','34','169','2','Additional Requirements','','Bed &amp; Breakfast',0,0,0,0,0,0,0,'',1),
(69,'BGI-4KKDH5TR','2016-02-05',108,'1','Select flight class','No Transfer','0','','0','0','','9','Additional Requirements','VS29 @ 1510 TO gaa614 @ 1630','',0,0,0,0,0,0,0,'',1),
(70,'BGI-4KKDH5TR','2016-02-16',128,'74','Select flight class','No Transfer','0','','0','0','','1','','GAA607 @ 1515 TO LI524 @ 1805','',0,0,0,0,0,0,0,'',0),
(71,'BGI-XVBYTWQ2','2016-08-23',45,'28','7','Hotel transfer','31','60','56','12','43','3','Additional Requirements','Arrival &amp; Transport notes','Hotel notes',0,0,0,0,0,0,5,'23',1),
(72,'BGI-DHDBSTCW','0000-00-00',0,'0','Select flight class','','0','','0','0','','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',1),
(73,'BGI-KX2VXH9Z','0000-00-00',0,'0','Select flight class','','0','','0','0','','Representation','Additional Requirements','','',0,0,0,0,0,0,0,'',1);

/*Table structure for table `bgi_bugs` */

DROP TABLE IF EXISTS `bgi_bugs`;

CREATE TABLE `bgi_bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_bugs` */

insert  into `bgi_bugs`(`id`,`bug_title`,`page`,`details`,`reporter`,`active`) values 
(1,'Main arrival update','arrival-details.php','When main arrival is updated, the change is not reflected on the reservations listing','Alvin Herbert',0),
(2,'Main departure update','departure-details.php','When main departure is updated, the change is not reflected on the reservations listing','Alvin Herbert',0),
(3,'transfers wont delete from reservation','reservation-details.php','when attempting to delete a transfer it goes to a blank page.','Alvin Herbert',0);

/*Table structure for table `bgi_clientreqs` */

DROP TABLE IF EXISTS `bgi_clientreqs`;

CREATE TABLE `bgi_clientreqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reqs` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_clientreqs` */

insert  into `bgi_clientreqs`(`id`,`reqs`) values 
(2,'Car hire'),
(3,'Pre booked excursion'),
(4,'Flowers/Chocolate'),
(5,'Rum punch kit/Spice Kit'),
(6,'Wine/Champange');

/*Table structure for table `bgi_departures` */

DROP TABLE IF EXISTS `bgi_departures`;

CREATE TABLE `bgi_departures` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_departures` */

insert  into `bgi_departures`(`id`,`ref_no_sys`,`dpt_date`,`dpt_time`,`dpt_flight_no`,`flight_class`,`dpt_transport`,`dpt_driver`,`dpt_vehicle`,`dpt_pickup`,`dpt_dropoff`,`dpt_pickup_time`,`dpt_notes`,`dpt_transport_notes`,`dpt_main`) values 
(1,'BGI-MP2XV3HR','2016-01-27',8,'2','7','Hydrolic Vehicle','29','56','5','11','16:30','','depature notes here',0),
(2,'BGI-K63BFNQX','2016-02-10',25,'16','6','Group Transfers (shared)','','','14','56','14:45','','',1),
(3,'BGI-KN2BYNFT','2016-02-13',0,'52','Select flight class','Private Car','0','','29','56','14:45','','',1),
(4,'BGI-DJX52PYW','2016-02-15',104,'62','3',', 3','','','130','130','17:45','','',1),
(5,'BGI-PC5NNVN4','2016-02-14',78,'50','Select flight class','Group Transfers (shared)','0','','47','56','14:40','','',1),
(6,'BGI-MRKRF9C8','2016-02-12',84,'55','3',', 3','','','27','56','17:30','','',1),
(7,'BGI-D6FDQPYQ','2016-02-15',84,'55','3','4','','','14','56','18:30','','',1),
(8,'BGI-NJGBWXBT','2016-02-15',104,'62','3',', 3','','','130','56','18:00','','',1),
(9,'BGI-H2BC46G8','2016-02-18',107,'64','3','3','','','131','56','16:30','','',1),
(10,'BGI-34T9953C','2016-02-05',122,'69','flight class not specified','Private Car','','','9','56','10:30','','From Atlantis to Tamarind to drop off bag then to airport',1),
(11,'BGI-34T9953C','2016-02-17',109,'50','flight class not specified','Private Car','','','3','56','16:45','','',0),
(12,'BGI-JBP6XZHM','2016-02-14',107,'64','Select flight class','Private Car','0','','32','56','17:30','','',1),
(13,'BGI-JRRZ35J9','2016-02-21',107,'64','Select flight class','Private Car','0','','130','Dropoff Location','16:45','','',1),
(14,'BGI-M4PVFZZF','2016-02-14',122,'69','flight class not specified','Private Car','','','25','56','11:00','','Depart to Bequia',1),
(15,'BGI-8Q9F9C4W','2016-02-14',115,'66','3','Private Car','','','43','56','13:30','','',1),
(16,'BGI-ZKJ7RFPY','2016-02-14',115,'66','3','Private Car','','','27','4','13:30','','',1),
(17,'BGI-HRVM6Z4Y','2016-02-21',115,'66','3','Private Car','','','132','56','13:30','','',1),
(18,'BGI-DSHZP36B','2016-02-23',81,'52','flight class not specified','','','','46','56','','','Departure transfer with Mr/Mrs Riley',1),
(19,'BGI-K24JYJNK','2016-02-16',118,'50','3','Private Car','','','1','4','15:00','','',1),
(20,'BGI-ZJQDK6C8','2016-02-19',120,'55','3','Private Car','','','17','4','17:30','','',1),
(21,'BGI-ST9JH9QY','2016-02-23',116,'52','Select flight class','Private Van','0','','46','56','','','Departure transfer with Mr/Mrs Garfield',1),
(22,'BGI-KV4BX4W6','2016-02-29',120,'55','Select flight class','Private Car','0','','3','56','','','',1),
(23,'BGI-GQT8TMXD','2016-02-12',120,'55','Select flight class','Private Car','0','','21','Dropoff Location','17:30','','',1),
(24,'BGI-VSSC83H5','2016-02-18',112,'68','Select flight class','Private Car','0','','Pickup Location','Dropoff Location','17:40','','',1),
(25,'BGI-NNP2SMFG','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','10:05','','',1),
(26,'BGI-K5MMRMQD','2016-02-06',118,'50','Select flight class','Private Car','0','','8','56','15:15','','',1),
(27,'BGI-J8PNMQ7K','2016-02-13',118,'50','Select flight class','Private Car','0','','3','56','15:00','','',1),
(28,'BGI-KWB4QJQ4','2016-02-11',81,'52','Select flight class','Private Car','0','','1','56','14:15','','',1),
(29,'BGI-DG8QSQNG','2016-02-01',126,'72','flight class not specified','10','','','4','4','','','',1),
(30,'BGI-DG8QSQNG','2016-02-11',118,'50','6','','0','','Pickup Location','Dropoff Location','','','',0),
(31,'BGI-T3BQFVG2','2016-02-14',129,'50','6','Private Car','','','21','56','','','',1),
(32,'BGI-4H382DQT','2016-02-01',126,'72','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','','','',1),
(33,'BGI-4H382DQT','2016-02-09',118,'50','6','No Transfer','0','','Pickup Location','Dropoff Location','','','',0),
(34,'BGI-TT6WG7HJ','2016-02-15',120,'55','Select flight class','Private Car','0','','21','56','17:30','','',1),
(35,'BGI-CGZY3SRZ','2016-02-12',120,'55','6','Group Transfers (shared)','0','','4','56','','','',1),
(36,'BGI-DS4ZPSDT','2016-02-15',120,'55','Select flight class','Private Car','0','','1','56','17:30','','',1),
(37,'BGI-RW7ZCMHQ','2016-02-15',120,'55','6','Private Car','0','','49','56','','','',1),
(38,'BGI-F289P3T3','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','12:15','','',1),
(39,'BGI-JPBSQD2Y','2016-02-22',120,'55','Select flight class','Group Transfers (shared)','0','','14','56','18:30','','',1),
(40,'BGI-X4GSD6NN','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','12:30','','',1),
(41,'BGI-74Y38HWT','2016-02-12',130,'24','flight class not specified','Group Transfers (shared)','','','10','56','06:45','','',1),
(42,'BGI-BMXFGZHP','2016-02-15',120,'55','Select flight class','Group Transfers (shared)','0','','49','56','18:30','','',1),
(43,'BGI-VT39T2HR','2016-02-14',81,'52','Select flight class','Merc/BMW','0','','21','56','14:45','','2 Merc/BMW',1),
(44,'BGI-WBGG9J3H','2016-02-19',120,'55','Select flight class','Private Car','0','','130','56','17:15','','',1),
(45,'BGI-RVJJTMCB','2016-02-16',116,'52','Select flight class','Private Car','0','','43','56','15:15','','Mrs requires wheelchair assistance',1),
(46,'BGI-6ZC78QYD','2016-02-11',104,'62','flight class not specified','Private Car','','','134','56','17:45','','',1),
(47,'BGI-2F8DGPFZ','2016-02-04',118,'50','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','','','',1),
(48,'BGI-34SGGHK6','2016-02-14',81,'52','flight class not specified','Group Transfers (shared)','','','13','56','14:35','','',1),
(49,'BGI-K3F25P36','2016-02-05',129,'50','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','','','',1),
(50,'BGI-X8RG3HDT','2016-02-06',118,'50','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','','','',1),
(51,'BGI-94852ZHD','2016-02-06',131,'62','flight class not specified','No Transfer','','','4','4','','','',1),
(52,'BGI-NRBQ3NSJ','2016-02-08',0,'50','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','','','',1),
(53,'BGI-RQCCY4S3','2016-02-15',120,'55','Select flight class','','0','','27','56','','','',1),
(54,'BGI-6XM73S4B','2016-02-16',118,'50','flight class not specified','Group Transfers (shared)','','','135','56','','','',1),
(55,'BGI-KXK7PTFQ','2016-02-18',118,'50','Select flight class','Private Car','0','','41','56','','','',1),
(56,'BGI-5HWY4S6W','2016-02-12',120,'55','Select flight class','Group Transfers (shared)','0','','19','56','14:55','','',1),
(57,'BGI-27Q2PNGZ','2016-02-14',136,'52','Select flight class','Group Transfers (shared)','0','','55','56','15:05','','',1),
(58,'BGI-SVSJYZGG','2016-02-12',120,'55','Select flight class','Group Transfers (shared)','0','','49','56','','','',1),
(59,'BGI-PZNT8BGZ','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','','','',1),
(60,'BGI-PTWKXF56','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','','','',1),
(61,'BGI-ZMFYPXYW','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','15:15','','',1),
(62,'BGI-73QFQBKM','2016-02-16',116,'52','Select flight class','Private Car','0','','Pickup Location','Dropoff Location','15:10','','',1),
(63,'BGI-8VTQXV52','2016-02-15',120,'55','Select flight class','Group Transfers (shared)','0','','27','56','','','',1),
(64,'BGI-JF529WK2','2016-02-15',116,'52','Select flight class','Group Transfers (shared)','0','','23','56','15:05','','Miss R Rennie is 14 years',1),
(65,'BGI-XK535637','2016-02-16',116,'52','8','Merc/BMW','0','','17','56','15:00','','PNR: 3Y633U',1),
(66,'BGI-MKPJWV94','2016-02-12',6,'6','6','Merc/BMW','','','46','56','05:30','','Seats: 20 E,F; PNR: JDCYNP',1),
(67,'BGI-7PPQ7NN7','2016-02-12',120,'55','5','Hotel transfer','0','','34','56','00:00','','PE - 17 D,E; PNR: FE5J5Y',1),
(68,'BGI-4KKDH5TR','2016-02-05',138,'76','Select flight class','No Transfer','0','','Pickup Location','Dropoff Location','00:00','','',1),
(69,'BGI-4KKDH5TR','2016-02-16',139,'78','Select flight class','','0','','Pickup Location','Dropoff Location','00:00','','LIAT PNR: O9W6WD',0),
(70,'BGI-XVBYTWQ2','0000-00-00',6,'6','3','Private Car, Coach (BT), Merc/BMW','10','25','130','Dropoff Location','17:25','','Departure &amp; Transport notes',1),
(71,'BGI-DHDBSTCW','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','17:30','','',1),
(72,'BGI-KX2VXH9Z','0000-00-00',0,'0','Select flight class','','0','','Pickup Location','Dropoff Location','17:30','','',1);

/*Table structure for table `bgi_flightclass` */

DROP TABLE IF EXISTS `bgi_flightclass`;

CREATE TABLE `bgi_flightclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_flightclass` */

insert  into `bgi_flightclass`(`id`,`class`) values 
(1,'First Class'),
(2,'Club Class'),
(3,'Business Class'),
(4,'Upper Class'),
(5,'Premium Economy'),
(6,'Economy'),
(7,'World Traveler'),
(8,'World Traveller Plus');

/*Table structure for table `bgi_flights` */

DROP TABLE IF EXISTS `bgi_flights`;

CREATE TABLE `bgi_flights` (
  `id_flight` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_flights` */

insert  into `bgi_flights`(`id_flight`,`flight_number`) values 
(1,'VS29'),
(2,'BA2155'),
(3,'AA1089'),
(4,'AA2393'),
(6,'AA2572'),
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
(62,'BA2152'),
(63,'TCX816'),
(64,'TCX817'),
(65,'TCX726'),
(66,'TCX727'),
(67,'LI521'),
(68,'TCX855'),
(69,'GAA606'),
(70,'BA2153'),
(71,'GAA605'),
(72,'GAA616'),
(73,'GAA609'),
(74,'GAA607'),
(75,'LI306'),
(76,'GAA614'),
(77,'sVG616'),
(78,'LI524'),
(79,'AA2725'),
(80,'AA1958'),
(81,'AA1955 '),
(82,'AA1771'),
(83,'AC974'),
(84,'AC975'),
(85,'AC1714'),
(86,'AC1715'),
(87,'AC1716'),
(88,'AC1717'),
(89,'DE2254'),
(90,'DE2258'),
(91,'B6 385'),
(92,'B6 386'),
(93,'B6 1261'),
(94,'B6 25'),
(95,'B6 44'),
(96,'B6 2662'),
(97,'VS57'),
(98,'VS58'),
(99,'AV124'),
(100,'AV125'),
(101,'3S 251'),
(102,'3S 270'),
(103,'TOM108'),
(104,'TOM109'),
(105,'TOM060'),
(106,'TOM061'),
(107,'TOM834'),
(108,'TOM835'),
(109,'TOM770'),
(110,'TOM771'),
(111,'MT2636'),
(112,'MT2636'),
(113,'MT2854'),
(114,'MT2854'),
(115,'MT2714'),
(116,'MT2714'),
(117,'GAA603'),
(118,'GAA605'),
(119,'GAA607'),
(120,'GAA609'),
(121,'GAA606'),
(122,'GAA608'),
(123,'GAA614'),
(124,'GAA616'),
(126,'LI300'),
(127,'LI301'),
(128,'LI306'),
(129,'LI335'),
(130,'LI336'),
(131,'LI362'),
(132,'LI364'),
(133,'LI370'),
(134,'LI371'),
(135,'LI392'),
(136,'LI393'),
(137,'LI512'),
(138,'LI521'),
(139,'LI523'),
(140,'LI524'),
(141,'LI560'),
(142,'LI565'),
(143,'LI567'),
(144,'LI581'),
(145,'LI726'),
(146,'LI727'),
(147,'LI737'),
(148,'LI755'),
(149,'LI756'),
(150,'LI768'),
(151,'LI769'),
(152,'LI770'),
(153,'LI771'),
(154,'LI772');

/*Table structure for table `bgi_flighttime` */

DROP TABLE IF EXISTS `bgi_flighttime`;

CREATE TABLE `bgi_flighttime` (
  `id_fltime` int(11) NOT NULL AUTO_INCREMENT,
  `id_flight` int(11) NOT NULL,
  `flight_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fltime`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_flighttime` */

insert  into `bgi_flighttime`(`id_fltime`,`id_flight`,`flight_time`) values 
(1,3,'13:20'),
(2,3,'14:30'),
(3,4,'21:15'),
(6,6,'08:00'),
(7,1,'14:05'),
(8,2,'15:00'),
(12,8,'06:45'),
(13,9,'13:05'),
(14,10,'13:15'),
(15,11,'13:20'),
(16,11,'13:50'),
(17,12,'13:45'),
(18,13,'14:25'),
(20,13,'15:25'),
(21,14,'15:40'),
(22,15,'16:50'),
(23,15,'17:25'),
(24,16,'16:50'),
(25,16,'17:30'),
(26,17,'17:00'),
(27,18,'17:50'),
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
(38,24,'07:00'),
(39,24,'08:00'),
(40,25,'07:30'),
(41,26,'19:45'),
(42,26,'20:35'),
(43,27,'20:00'),
(44,27,'20:50'),
(45,28,'08:50'),
(46,28,'09:30'),
(47,29,'11:05'),
(48,30,'11:20'),
(49,31,'11:35'),
(50,31,'12:20'),
(51,32,'20:15'),
(52,32,'20:50'),
(53,33,'13:44'),
(54,34,'14:15'),
(55,35,'08:55'),
(56,35,'08:30'),
(57,36,'19:35'),
(58,36,'20:10'),
(59,37,'08:55'),
(60,37,'09:30'),
(61,38,'18:25'),
(62,39,'14:40'),
(63,39,'15:30'),
(64,40,'16:35'),
(65,40,'17:35'),
(66,41,'09:25'),
(67,41,'10:25'),
(71,43,'07:15'),
(72,44,'08:30'),
(73,45,'12:10'),
(74,46,'14:05'),
(75,47,'14:05'),
(76,48,'13:55'),
(77,49,'14:45'),
(78,50,'17:05'),
(79,51,'15:20'),
(80,51,'16:30'),
(81,52,'17:15'),
(82,53,'17:50'),
(83,54,'17:40'),
(84,55,'20:05'),
(85,56,'21:15'),
(86,57,'21:05'),
(87,57,'21:30'),
(88,58,'08:15'),
(90,60,'15:12'),
(91,61,'20:10'),
(93,9,'03:20'),
(103,2,'16:10'),
(104,62,'20:15'),
(105,2,'15:30'),
(106,63,'18:05'),
(107,64,'19:55'),
(108,1,'14:10'),
(110,31,'11:30'),
(111,64,'19:55'),
(112,68,'20:20'),
(113,67,'11:30'),
(114,65,'14:15'),
(115,66,'16:15'),
(116,52,'17:55'),
(117,1,'15:05'),
(118,50,'17:15'),
(119,18,'18:10'),
(120,55,'20:40'),
(121,10,'13:35'),
(122,69,'13:00'),
(123,70,'18:35'),
(124,70,'18:20'),
(125,71,'11:45'),
(126,72,'1630'),
(127,73,'1515'),
(128,74,'1515'),
(129,50,'17:30'),
(130,24,'08:30'),
(131,62,'20:05'),
(132,75,'10:20'),
(133,75,'10:30'),
(134,75,'10:25'),
(135,52,'17:10'),
(136,52,'17:20'),
(137,6,'19:10'),
(138,76,'16:30'),
(139,78,'18:05'),
(140,77,'16:30'),
(142,3,'15:30'),
(143,79,'06:30'),
(144,79,'07:35'),
(145,79,'07:45'),
(147,4,'21:40'),
(148,4,'22:50'),
(149,3,'14:20'),
(150,3,'15:20'),
(151,3,'15:30'),
(152,80,'14:40'),
(153,80,'15:35'),
(154,81,'15:40'),
(155,82,'14:35'),
(156,82,'14:40'),
(157,82,'15:35'),
(158,83,'12:35'),
(159,83,'13:35'),
(160,84,'13:35'),
(161,84,'14:35'),
(162,85,'13:55'),
(163,85,'14:10'),
(164,85,'15:10'),
(165,86,'14:35'),
(166,86,'15:10'),
(167,86,'15:25'),
(168,86,'16:25'),
(169,87,'16:05'),
(170,87,'17:05'),
(171,88,'17:30'),
(172,2,'15:05'),
(173,2,'15:40'),
(174,89,'17:30'),
(175,89,'18:50'),
(176,89,'19:20'),
(177,89,'19:45'),
(178,90,'20:55'),
(179,90,'17:30'),
(180,90,'19:30'),
(181,90,'22:15'),
(182,34,'14:00'),
(183,34,'15:35'),
(184,59,'15:20'),
(185,59,'16:15'),
(186,59,'16:25'),
(187,7,'02:10'),
(188,7,'03:40'),
(189,7,'04:45'),
(190,7,'05:05'),
(191,42,'05:05'),
(192,42,'05:30'),
(193,91,'11:25'),
(194,91,'11:30'),
(195,91,'12:20'),
(196,91,'12:40'),
(197,92,'12:25'),
(198,92,'13:10'),
(199,92,'13:15'),
(200,93,'12:50'),
(201,93,'13:25'),
(202,93,'13:50'),
(203,47,'14:40'),
(204,47,'14:55'),
(205,94,'12:30'),
(206,94,'13:00'),
(207,94,'13:30'),
(208,95,'13:25'),
(209,95,'14:20'),
(210,96,'16:10'),
(211,96,'17:10'),
(212,1,'15:10'),
(213,1,'16:05'),
(214,50,'17:50'),
(215,50,'18:20'),
(216,97,'14:40'),
(217,98,'17:50'),
(218,99,'18:10'),
(219,100,'18:55'),
(220,101,'18:30'),
(221,101,'18:45'),
(222,102,'19:00'),
(223,102,'19:15'),
(224,103,'15:00'),
(225,104,'17:45'),
(226,105,'14:30'),
(227,106,'17:00'),
(228,107,'16:20'),
(229,108,'18:20'),
(230,109,'14:40'),
(231,110,'17:30'),
(232,111,'18:05'),
(233,112,'19:55'),
(234,113,'13:15'),
(235,113,'18:30'),
(236,114,'20:20'),
(237,115,'19:00'),
(238,116,'20:50'),
(239,117,'10:50'),
(240,117,'11:15'),
(241,118,'11:15'),
(242,118,'10:50'),
(244,117,'11:20'),
(246,117,'11:50'),
(247,118,'11:20'),
(248,118,'11:40'),
(249,118,'11:50'),
(250,119,'11:15'),
(251,119,'14:10'),
(252,119,'14:20'),
(253,119,'14:50'),
(254,120,'11:15'),
(255,120,'14:10'),
(256,120,'14:20'),
(257,120,'14:40'),
(258,120,'14:50'),
(259,120,'14:55'),
(260,121,'12:30'),
(261,121,'13:00'),
(262,122,'12:30'),
(263,122,'13:00'),
(264,123,'16:00'),
(265,123,'16:30'),
(266,124,'16:00'),
(267,124,'16:30'),
(268,125,'08:00'),
(269,126,'12:25'),
(270,127,'17:05'),
(271,127,'17:20'),
(272,128,'11:10'),
(273,129,'13:00'),
(274,130,'15:30'),
(275,131,'08:40'),
(276,131,'08:45'),
(277,132,'13:30'),
(278,132,'14:15'),
(279,133,'09:20'),
(280,134,'12:05'),
(281,135,'08:10'),
(282,136,'18:30'),
(283,136,'18:50'),
(284,137,'17:50'),
(285,137,'18:15'),
(286,138,'11:30'),
(287,138,'12:15'),
(288,138,'16:55'),
(289,139,'19:15'),
(290,139,'20:00'),
(291,139,'20:15'),
(292,139,'21:00'),
(293,140,'18:10'),
(294,140,'19:00'),
(295,141,'07:30'),
(296,141,'08:00'),
(297,141,'09:00'),
(298,142,'17:35'),
(299,142,'18:20'),
(300,143,'17:15'),
(301,144,'08:00'),
(302,145,'17:10'),
(303,145,'17:15'),
(304,146,'12:35'),
(305,147,'18:40'),
(306,148,'14:35'),
(307,149,'17:20'),
(308,149,'17:35'),
(309,150,'18:20'),
(310,150,'18:35'),
(311,151,'20:15'),
(312,151,'20:30'),
(313,151,'21:15'),
(314,152,'23:00'),
(315,153,'08:15'),
(316,153,'09:05'),
(317,154,'13:55');

/*Table structure for table `bgi_fsft_touroperator` */

DROP TABLE IF EXISTS `bgi_fsft_touroperator`;

CREATE TABLE `bgi_fsft_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `bgi_fsft_touroperator` */

insert  into `bgi_fsft_touroperator`(`id`,`tour_operator`,`amount`) values 
(1,'Accra Beach','40.00'),
(4,'Altman','30.00'),
(5,'Audley Travel','35.00'),
(6,'Azure','40.00'),
(7,'Barbados Barbados','55.00'),
(8,'Barbados Olympic Association','35.00'),
(9,'Blue Anglia Property Management','35.00'),
(10,'Caribtours','40.00'),
(11,'Carrier','35.00'),
(12,'ChloBo','0.00'),
(13,'Chris McFadden Travel','0.00'),
(14,'Classic Collection ','40.00'),
(15,'Colletts Travel','40.00'),
(16,'Destinology','40.00'),
(17,'Diamond Air','40.00'),
(18,'Direct Bookings','60.00'),
(19,'DL Smith Productions','0.00'),
(20,'DNATA / Gold Medal','40.00'),
(21,'EFR Travel','40.00'),
(22,'Expedia','40.00'),
(23,'Fidelity Investments','0.00'),
(24,'Foster & Ince','35.00'),
(25,'Gibbs Glade Villa','40.00'),
(26,'Glitter Bay House','0.00'),
(27,'Hammerton Barbados','35.00'),
(28,'Hilton Barbados Resort','40.00'),
(29,'ICBL','30.00'),
(30,'Individual Holidays','40.00'),
(31,'Island Villas','30.00'),
(32,'ITC Luxury Travel','35.00'),
(33,'Kuoni UK','40.00'),
(34,'Landfall','40.00'),
(35,'LGH','40.00'),
(36,'Lusso','40.00'),
(37,'Luxelife','40.00'),
(38,'Prestbury Worldwide','35.00'),
(39,'Prestige World','40.00'),
(40,'Sagicor Life Insurance','40.00'),
(41,'Sarah Young Concierge','40.00'),
(42,'Scott Dunn','40.00'),
(43,'Select Travel','40.00'),
(44,'Sunset','40.00'),
(45,'Suntours','40.00'),
(46,'Sunways Leisure Travel','35.00'),
(47,'The Crane Resort','30.00'),
(48,'The Great House','40.00'),
(49,'Trailfinders','40.00'),
(50,'Travel 2','35.00'),
(51,'Travel Counsellors','40.00'),
(52,'Travel Keys','40.00'),
(53,'Tropic Breeze','40.00'),
(54,'Viator','38.99'),
(55,'Virgin Holidays','40.00'),
(56,'World Tvl Holdings','35.00'),
(57,'Young Estates','40.00');

/*Table structure for table `bgi_guest` */

DROP TABLE IF EXISTS `bgi_guest`;

CREATE TABLE `bgi_guest` (
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COMMENT='Guest table';

/*Data for the table `bgi_guest` */

insert  into `bgi_guest`(`id`,`title_name`,`ref_no_sys`,`first_name`,`last_name`,`adult`,`child_age`,`infant_age`,`pnr`) values 
(1,'Mrs','BGI-MP2XV3HR','Mini','Mouse',1,0,0,''),
(2,'Miss','BGI-K63BFNQX','HARRIET','BRIDGEWATER',1,0,0,''),
(3,'Miss','BGI-KN2BYNFT','LOUISE-MARIE','BROADHURST',1,0,0,''),
(4,'Mrs','BGI-DJX52PYW','CHRISTINE','ASH',1,0,0,''),
(5,'Mrs','BGI-PC5NNVN4','JANET','WARNER',1,0,0,''),
(6,'Mrs','BGI-MRKRF9C8','JULL','BIRRELL',1,0,0,''),
(7,'Mrs','BGI-D6FDQPYQ','DEBRA','GRIFFITHS',1,0,0,''),
(8,'Mrs','BGI-NJGBWXBT','CHRISTINE','ASH',1,0,0,''),
(9,'Mrs','BGI-H2BC46G8','TRACY','WHEELER',1,0,0,''),
(10,'Mrs','BGI-34T9953C','Caryn','Disney',1,0,0,''),
(12,'Mrs','BGI-JBP6XZHM','CHRISTINE','NORTON',1,0,0,''),
(13,'Mrs','BGI-JRRZ35J9','JEAN','BEATHAM',1,0,0,''),
(14,'Mrs','BGI-M4PVFZZF','Ann','Johnson',1,0,0,''),
(15,'Mrs','BGI-8Q9F9C4W','ANNETTE','NESS',1,0,0,''),
(16,'Mrs','BGI-ZKJ7RFPY','DIANE','NIELD',1,0,0,''),
(17,'Mrs','BGI-HRVM6Z4Y','BETTY','UNWIN',1,0,0,''),
(18,'Mrs','BGI-DSHZP36B','Annis','Garfield',1,0,0,''),
(19,'Mrs','BGI-K24JYJNK','KIM','BURGESS',1,0,0,''),
(20,'Miss','BGI-ZJQDK6C8','JOANNA','WISH',1,0,0,''),
(21,'Mrs','BGI-ST9JH9QY','MARGARET','RILEY',1,0,0,''),
(22,'Mrs','BGI-KV4BX4W6','JUDITH','UPTON',1,0,0,''),
(23,'Mrs','BGI-GQT8TMXD','CAROLINE','OWEN',1,0,0,''),
(24,'Mrs','BGI-VSSC83H5','CAROLE','ALLISON',1,0,0,''),
(25,'Mrs','BGI-NNP2SMFG','S','HARTWIG',1,0,0,''),
(26,'Mrs','BGI-K5MMRMQD','R','BINGHAM',1,0,0,''),
(27,'Mrs','BGI-J8PNMQ7K','D','ILLES',1,0,0,''),
(28,'Mrs','BGI-KWB4QJQ4','V','STORY',1,0,0,''),
(29,'Mrs','BGI-DG8QSQNG','V','NEWMAN',1,0,0,''),
(30,'Mrs','BGI-T3BQFVG2','M','DENNIS',1,0,0,''),
(31,'','BGI-T3BQFVG2','','',0,0,0,''),
(32,'Mrs','BGI-TT6WG7HJ','SANDRA','WILSON',1,0,0,''),
(33,'','BGI-CGZY3SRZ','','',0,0,0,''),
(34,'Mrs','BGI-RW7ZCMHQ','C','WILDE',1,0,0,''),
(35,'Mrs','BGI-JPBSQD2Y','JUNE','ASHMAN',1,0,0,''),
(36,'Mrs','BGI-BMXFGZHP','MARY','KER',1,0,0,''),
(37,'Mr','BGI-BMXFGZHP','GRAEME','KER',1,0,0,''),
(38,'Miss','BGI-BMXFGZHP','FIONA','KER',1,0,0,''),
(39,'Miss','BGI-BMXFGZHP','JOANNE','KER',1,0,0,''),
(40,'Mrs','BGI-WBGG9J3H','BERYL','GOODWIN',1,0,0,''),
(41,'Mrs','BGI-RVJJTMCB','L','ROBSON',1,0,0,''),
(42,'Mrs','BGI-6ZC78QYD','L','BILHAM',1,0,0,''),
(43,'Mrs','BGI-2F8DGPFZ','KATHY','COVENEY',1,0,0,''),
(44,'Mrs','BGI-34SGGHK6','E','BIRD',1,0,0,''),
(45,'Mrs','BGI-K3F25P36','CLARE','PRENTICE',1,0,0,''),
(46,'Mrs','BGI-X8RG3HDT','YVONNE','GOODGAME',1,0,0,''),
(47,'Mrs','BGI-94852ZHD','CAROL','O&#039;BRIEN',1,0,0,''),
(48,'Mr','BGI-94852ZHD','STEVEN','PRICE',1,0,0,''),
(49,'Mrs','BGI-94852ZHD','JANET','PRICE',1,0,0,''),
(50,'Mrs','BGI-NRBQ3NSJ','ANNE','MOGAN',1,0,0,''),
(51,'','BGI-6XM73S4B','','',0,0,0,''),
(52,'Mrs','BGI-27Q2PNGZ','C','CORNEY',1,0,0,''),
(53,'Mrs','BGI-PZNT8BGZ','VERONICA','LANGTON',1,0,0,''),
(54,'Ms','BGI-PTWKXF56','SARA','GRANTHAM',1,0,0,''),
(55,'Mr','BGI-ZMFYPXYW','MAXWELL','SELLORS',1,0,0,''),
(56,'Mrs','BGI-73QFQBKM','J','DANIELS',1,0,0,''),
(57,'Ms','BGI-JF529WK2','R','RENNIE',1,0,0,''),
(58,'Miss','BGI-JF529WK2','R','RENNIE',1,0,0,''),
(59,'Mrs','BGI-XK535637','linda','collett',1,0,0,''),
(60,'Mrs','BGI-MKPJWV94','eda','hughes',1,0,0,''),
(61,'Mrs','BGI-7PPQ7NN7','elizabeth','luper',1,0,0,''),
(62,'Lady','BGI-4KKDH5TR','r','hurn',1,0,0,''),
(63,'','BGI-XVBYTWQ2','Haider','Hassan',1,2,3,'PNR');

/*Table structure for table `bgi_loc_coast` */

DROP TABLE IF EXISTS `bgi_loc_coast`;

CREATE TABLE `bgi_loc_coast` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `coast` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_loc_coast` */

insert  into `bgi_loc_coast`(`id`,`coast`) values 
(1,'East Coast'),
(2,'West Coast'),
(3,'North Coast'),
(4,'South Coast');

/*Table structure for table `bgi_location` */

DROP TABLE IF EXISTS `bgi_location`;

CREATE TABLE `bgi_location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone` int(4) NOT NULL DEFAULT '0',
  `sorting_order` varchar(255) NOT NULL,
  `loc_code` varchar(6) NOT NULL DEFAULT '000',
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_location` */

insert  into `bgi_location`(`id_location`,`name`,`zone`,`sorting_order`,`loc_code`) values 
(1,'Fairmont Royal Pavilion',3,'','101'),
(2,'Sandals Barbados',4,'65','015'),
(3,'Tamarind - Elegant',2,'125','068'),
(4,'Accra Beach Hotel',4,'80','040'),
(5,'All Seasons Resorts',2,'','084'),
(10,'Barbados Beach Club',4,'30','013'),
(11,'Beach View',2,'120','064'),
(12,'Blue Orchid Beach Hotel',4,'','034'),
(13,'Bougainvillea Beach Resorts',4,'20','014'),
(14,'Butterfly Beach Hotel',4,'15','009'),
(15,'Cobblers Cove',3,'155','129'),
(16,'Coconut Court',4,'90','045'),
(17,'Colony Club Hotel - Elegant',2,'150','095'),
(18,'Coral Mist Beach Hotel',4,'','035'),
(19,'Coral Reef Club',2,'','094'),
(20,'Coral Sands Beach Resort',4,'70','032'),
(21,'Crystal Cove Hotel - Elegant',2,'115','059'),
(22,'Discovery Bay Hotel',2,'145','091'),
(23,'Divi Southwinds Beach Resorts',4,'50','027'),
(24,'Hilton Barbados',4,'100','051'),
(25,'Little Arches Hotel',4,'10','007'),
(26,'Little Good Harbour',3,'','136'),
(27,'Mango Bay Hotel &amp; Beach Club',2,'140','090'),
(29,'Ocean Two Resort &amp; Residences',4,'45','019'),
(30,'Pirates Inn',4,'','042'),
(31,'Port St. Charles',3,'160','133'),
(32,'Rostrevor Apartments Hotel',4,'55','029'),
(34,'Sandy Lane Hotel',2,'130','079'),
(35,'Savannah Hotel',4,'','048'),
(36,'Sea Breeze Beach Hotel',4,'25','010'),
(37,'Settlers Beach',2,'','093'),
(38,'Silver Point Hotel',4,'','005'),
(39,'South Beach Resort &amp; Vacation Club',4,'','039'),
(40,'South Gap Hotel',4,'60','030'),
(42,'Sugar Cane Club Hotel &amp; Spa',3,'','134'),
(43,'The Club Barbados ',2,'135','083'),
(44,'The Crane Beach',1,'5','001'),
(45,'The House - Elegant',2,'','067'),
(46,'The Sandpiper Hotel',2,'','092'),
(47,'Time Out At The Gap',4,'','024'),
(48,'Treasure Beach Hotel',2,'','069'),
(49,'Turtle Beach Hotel - Elegant',4,'35','016'),
(50,'Waves Hotel &amp; Spa',2,'110','056'),
(51,'Worthing Court Apartment Hotel',4,'75','028'),
(52,'Yellow Bird Hotel',4,'','031'),
(55,'Dover Beach Hotel',4,'40','017'),
(57,'Seaport',0,'','0'),
(63,'Z - Mon Caprice',3,'','114'),
(66,'Z - Jane&#039;s Harbour',2,'','080'),
(69,'Port Ferdinand',3,'165','135'),
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
(91,'Z - Pink Cottage',0,'','0'),
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
(130,'Almond Resorts',3,'','132'),
(131,'Infinity On The Beach',4,'','025'),
(132,'Travellers Palm',2,'','087'),
(133,'Intransit',0,'','0'),
(134,'Sugar Bay',4,'','047'),
(135,'Sunbay Hotel',4,'','011'),
(137,'Casa Grande',1,'','002'),
(138,'Ocean Spray Beach Apartments',4,'','003'),
(139,'Peach and Quiet',4,'','004'),
(140,'Cotton House 2',4,'','006'),
(141,'Golden Sands Hotel',4,'','008'),
(142,'Green Gates',4,'','012'),
(143,'Meridian Inn',4,'','018'),
(144,'Ocean 15',4,'','020'),
(145,'White Sands ',4,'','021'),
(146,'Sapphire Beach ',4,'','022'),
(147,'Salt Ash Hotel',4,'','023'),
(148,'Southern Plams Beach Club',4,'','026'),
(149,'Palm Garden Hotel',4,'','033'),
(150,'Plum Tree Club',4,'','036'),
(151,'Rockley Golf Club',4,'','037'),
(152,'Blue Horizon',4,'','038'),
(153,'Magic Isle',4,'','041'),
(154,'The Soco Hotel',4,'','043'),
(155,'Courtyard by Marriott',4,'','044'),
(156,'Mackston Apartments',4,'','046'),
(157,'Island Inn',4,'','049'),
(158,'Radisson Aquatica',4,'','050'),
(159,'Nautilus Beach Apartments',4,'','052'),
(160,'Z - Best E Villas',2,'','053'),
(161,'Z - Summerland',2,'','054'),
(162,'Z - Nirvana',2,'','055'),
(163,'Z - Senderlea',2,'','057'),
(164,'Z - Sandy Cove',2,'','058'),
(165,'Z - Angler Apartments',2,'','060'),
(166,'Z - Blue Lagoon',2,'','061'),
(167,'Z - Mantaray Bay',2,'','062'),
(168,'Z - One Sandy Lane',2,'','063'),
(169,'Z - Mahogany Bay',2,'','065'),
(170,'Z - Waterside Apartments',2,'','066'),
(171,'Smugglers Cove',1,'','070'),
(172,'Z - New Mansion',2,'','071'),
(173,'Z - Old Trees',2,'','072'),
(174,'Z - St James Apartments',2,'','073'),
(175,'Z - Bora Bora',2,'','074'),
(176,'Z - Stanford House',2,'','075'),
(177,'Z - Buttsbury House',2,'','076'),
(178,'Z - Heronetta',2,'','077'),
(179,'Z - Sandy Lane Estate',2,'','078'),
(180,'Z - Landfall House',2,'','081'),
(181,'Z - Landmark',2,'','082'),
(182,'Z - Jamoon',2,'','085'),
(183,'Divi Heritage',2,'','086'),
(184,'Halcyon Palm',2,'','088'),
(185,'Tropical Sunset Apartments',2,'','089'),
(186,'Z - Queen\'s Fort',3,'','096'),
(187,'Z - Villa Melissa',3,'','097'),
(188,'Z - Royal Westmoreland',3,'','098'),
(189,'Z - Sugar Hill',3,'','099'),
(190,'Z - Hi-Five Sugar Hill',3,'','100'),
(191,'Z - Glitter Bay',3,'','102'),
(192,'Z - Glitter Bay House',3,'','103'),
(193,'Z - Lone Star',3,'','104'),
(194,'Z - Crystal Springs House',3,'','105'),
(195,'Z - Cove Spring House',3,'','106'),
(196,'Z - Whitegates',3,'','107'),
(197,'Z - Tamarind Cottage',3,'','108'),
(198,'Z - Merlin Bay',3,'','109'),
(199,'Z - Lantana',3,'','110'),
(200,'Z - Moon Reach',3,'','111'),
(201,'Z - Reeds House',3,'','112'),
(202,'Z - Fosters House',3,'','113'),
(203,'Z - Oyster Bay',3,'','115'),
(204,'Z - Emerald Beach',3,'','116'),
(205,'Z - Westhaven',3,'','117'),
(206,'Z - Gibbs Glade Villas',3,'','118'),
(207,'Z - Jessamine House',3,'','119'),
(208,'Z - High Trees',3,'','120'),
(209,'Z - High Tide',3,'','121'),
(210,'Z - Bayfield House',3,'','122'),
(211,'Z - Legend Garden Condos',3,'','123'),
(212,'Z - Battaley\'s Mews',3,'','124'),
(213,'Z - The Great House',3,'','125'),
(214,'Z - King\'s Beach Villas',3,'','126'),
(215,'Saint Peter\'s Bay',3,'','127'),
(216,'Z - Leamington House',3,'','128'),
(217,'Z - Nelson Gay',3,'','130'),
(218,'Schooner Bay',3,'','131'),
(219,'Z - Colleton Gardens',3,'','137'),
(220,'Z - Fustic House',3,'','138'),
(221,'Round House',3,'','139'),
(222,'Sea-U Guest House',3,'','140'),
(223,'Atlantis Hotel',3,'','141'),
(224,'TESTING 123',1,'','200');

/*Table structure for table `bgi_payment_type` */

DROP TABLE IF EXISTS `bgi_payment_type`;

CREATE TABLE `bgi_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_payment_type` */

insert  into `bgi_payment_type`(`id`,`payment_type`) values 
(1,'Payment Received – Credit Card'),
(2,'Payment Received – Cash'),
(3,'To Be Invoiced');

/*Table structure for table `bgi_reps` */

DROP TABLE IF EXISTS `bgi_reps`;

CREATE TABLE `bgi_reps` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_reps` */

insert  into `bgi_reps`(`id_rep`,`name`) values 
(1,'Allan Grannum'),
(2,'Dana Straker'),
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

/*Table structure for table `bgi_reptype` */

DROP TABLE IF EXISTS `bgi_reptype`;

CREATE TABLE `bgi_reptype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_reptype` */

insert  into `bgi_reptype`(`id`,`rep_type`) values 
(1,'Meet & Greet'),
(2,'Full Rep'),
(3,'no Rep'),
(4,'Italian Rep'),
(5,'German Rep'),
(6,'Spanish Rep'),
(7,'French Rep'),
(8,'Russian Rep'),
(9,'Intransit');

/*Table structure for table `bgi_resdrivers` */

DROP TABLE IF EXISTS `bgi_resdrivers`;

CREATE TABLE `bgi_resdrivers` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_resdrivers` */

insert  into `bgi_resdrivers`(`id_driver`,`transport`,`vehicle`,`ref_no_sys`,`adult`,`child`,`infant`,`tour_operator`,`location`,`pickup_time`,`comments`,`rate`,`flight_time`,`flight_no`,`infant_seats`,`child_seats`,`booster_seats`,`title_name`,`first_name`,`last_name`,`transport_date`,`res_type`) values 
(1,31,60,'BGI-XVBYTWQ2',2,2,3,1,56,'45','Arrival &amp; Transport notes','25%','45','28',0,0,0,'Mr','FIrst','Last','2016-08-23',1),
(2,10,25,'BGI-XVBYTWQ2',2,2,3,1,130,'17:25','Departure &amp; Transport notes','25%','6','6',0,0,0,'Mr','FIrst','Last','',2);

/*Table structure for table `bgi_reservations` */

DROP TABLE IF EXISTS `bgi_reservations`;

CREATE TABLE `bgi_reservations` (
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
  `infant_seats` int(11) NOT NULL DEFAULT '0',
  `child_seats` int(11) NOT NULL DEFAULT '0',
  `booster_seats` int(11) NOT NULL DEFAULT '0',
  `vouchers` int(11) NOT NULL DEFAULT '0',
  `assignment` int(1) NOT NULL,
  `cold_towel` int(11) NOT NULL,
  `bottled_water` int(11) NOT NULL,
  `dpt_flight_class` int(11) NOT NULL,
  `rooms` varchar(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_reservations` */

insert  into `bgi_reservations`(`id`,`title_name`,`first_name`,`last_name`,`pnr`,`tour_operator`,`operator_code`,`tour_ref_no`,`adult`,`child`,`infant`,`tour_notes`,`fast_track`,`affiliates`,`arr_date`,`arr_time`,`arr_flight_no`,`flight_class`,`arr_transport`,`arr_driver`,`arr_vehicle`,`arr_pickup`,`arr_dropoff`,`room_type`,`rep_type`,`client_reqs`,`dpt_date`,`dpt_time`,`dpt_flight_no`,`dpt_transport`,`dpt_driver`,`dpt_vehicle`,`dpt_pickup`,`dpt_dropoff`,`dpt_pickup_time`,`dpt_notes`,`creation_date`,`created_by`,`modified_date`,`modified_by`,`ref_no_sys`,`assigned`,`rep`,`status`,`arr_transport_notes`,`dpt_transport_notes`,`arr_hotel_notes`,`ftnotify`,`infant_seats`,`child_seats`,`booster_seats`,`vouchers`,`assignment`,`cold_towel`,`bottled_water`,`dpt_flight_class`,`rooms`,`room_no`) values 
(1,'Mr','mickey','mouse','BLDI86','64','','',3,1,1,'Rep notes go here',1,'','2016-01-29','87','57','7','Private Van','23','48','56','16','67','4','Additional Requirements','2016-01-27','8','2','Hydrolic Vehicle','29','56','5','11','16:30','accounting notes here','2016-01-14 15:36:48','Nicole Moody','2016-01-19 14:50:59','Rhema Reid','BGI-MP2XV3HR',0,'',2,'arrival &amp; transport notes here','depature notes here','hotel notes here',1,1,1,0,2,0,3,2,7,'1','125'),
(2,'Mr','GAVIN','CLIFFORD','','102','','BAD3HQ',2,0,0,'',0,'','2016-02-03','0','2','Select flight class','Group Transfers (shared)','0','','56','14','0','2','Additional Requirements','2016-02-10','0','52','Group Transfers (shared)','0','','14','56','14:45','','2016-01-15 16:13:22','Rhonda Niles','2016-01-18 16:21:41','Rhonda Niles','BGI-K63BFNQX',0,'',2,'','','',0,0,0,0,0,0,0,0,0,'',''),
(3,'Mr','ANTHONY','MCCALL','','42','','GW49J4Z',2,0,0,'',0,'','2016-02-04','','0','Select flight class','Private Car','0','','56','29','137','2','Additional Requirements','2016-02-13','0','52','Private Car','0','','29','56','14:45','','2016-01-15 16:16:29','Rhonda Niles','2016-01-18 16:22:37','Rhonda Niles','BGI-KN2BYNFT',0,'',2,'','','',0,0,0,0,0,0,0,0,0,'',''),
(4,'Mr','LAURENCE','ASH','','102','','JA0LK1',2,0,0,'',0,'','2016-02-04','0','2','Select flight class','','0','','0','0','','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','16:20','','2016-01-15 16:18:50','Rhonda Niles','2016-01-18 16:22:01','Rhonda Niles','BGI-DJX52PYW',0,'',2,'','','',0,0,0,0,0,0,0,0,0,'',''),
(5,'Mr','GARY','WARNER','','42','','GW496KD',2,0,0,'',0,'','2016-02-04','7','1','Select flight class','Group Transfers (shared)','0','','56','47','0','2','Additional Requirements','2016-02-14','78','50','Group Transfers (shared)','0','','47','56','14:40','','2016-01-15 16:24:39','Rhonda Niles','2016-01-18 09:16:51','Alvin Herbert','BGI-PC5NNVN4',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(6,'Mr','JAMES','BIRRELL','','102','','3A0G37',2,0,0,'',0,'','2016-02-05','27','18','Select flight class','','0','','56','27','0','2','Additional Requirements','2016-02-12','84','55','','0','','27','56','17:30','','2016-01-18 16:13:00','Rhonda Niles','','','BGI-MRKRF9C8',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(7,'Mr','ALBERT','GRIFFITHS','','42','','GP4ABOO',2,0,0,'',0,'','2016-02-05','27','18','3','Private Car','','','Airport','14','0','2','Additional Requirements','2016-02-15','84','55','4','','','14','56','18:30','','2016-01-18 16:20:26','Rhonda Niles','2016-03-22 16:59:27','Alvin Herbert','BGI-D6FDQPYQ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(8,'Mr','LAURENCE','ASH','','102','','JA0LK1',2,0,0,'',0,'','2016-02-04','105','2','Select flight class','','0','','56','130','0','2','Additional Requirements','2016-02-15','104','62','','0','','130','56','18:00','','2016-01-18 16:25:44','Rhonda Niles','','','BGI-NJGBWXBT',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(9,'Mr','TIMOTHY','WHEELER','','95','','11290939',2,0,0,'',0,'','2016-02-04','61','38','Select flight class','','0','','56','20','0','2','Additional Requirements','2016-02-18','91','61','','0','','20','56','16:30','','2016-01-18 16:29:02','Rhonda Niles','2016-01-18 16:34:22','Rhonda Niles','BGI-H2BC46G8',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(10,'Mr','Richard','Tickner','','142','','011215143531',2,0,0,'',0,'','2016-02-01','7','1','Select flight class','Private Car','0','','56','9','0','2','Additional Requirements','2016-02-05','','0','Private Car','0','','9','56','10:30','','2016-01-18 16:33:47','Lisa Thompson','2016-01-19 10:57:00','Lisa Thompson','BGI-34T9953C',0,'',1,'','From Atlantis to Tamarind to drop off bag then to airport','Continental Breakfast ',0,0,0,0,0,0,0,0,0,'1',''),
(11,'Mr','NORTON','RODNEY','','95','','11578942',2,0,0,'',0,'','2016-01-04','106','63','Select flight class','Private Car','0','','56','32','0','2','Additional Requirements','2016-02-14','107','64','Private Car','0','','32','56','17:30','','2016-01-18 16:49:32','Rhonda Niles','2016-01-18 16:59:01','Rhonda Niles','BGI-JBP6XZHM',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(12,'Mr','BRYAN','BEATHAM','','95','','12224932',2,0,0,'',0,'','2016-02-07','106','63','Select flight class','Private Car','0','','56','130','0','2','Additional Requirements','2016-02-21','107','64','Private Car','0','','130','Dropoff Location','16:45','','2016-01-18 16:52:44','Rhonda Niles','2016-01-18 17:01:05','Rhonda Niles','BGI-JRRZ35J9',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(13,'Mr','PETER','JOHNSON','','142','','280715111531',2,0,0,'',0,'','2016-02-09','0','44','Select flight class','Private Car','0','','56','25','119','2','Additional Requirements','2016-02-14','','0','Private Car','0','','25','56','','','2016-01-18 16:53:40','Lisa Thompson','2016-01-19 14:26:47','Lisa Thompson','BGI-M4PVFZZF',0,'',1,'','Depart to Bequia','Breakfast included',0,0,0,0,0,0,0,0,0,'1',''),
(14,'Mr','KEVIN','NESS','','95','','11990169',2,0,0,'',0,'','2016-02-07','0','0','Select flight class','Private Car','0','','56','43','0','2','Additional Requirements','2016-02-14','','0','Private Car','0','','43','56','16:55','','2016-01-18 16:55:17','Rhonda Niles','','','BGI-8Q9F9C4W',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(15,'Mr','PHILIP','NIELD','','95','','11573826',2,0,0,'',0,'','2016-02-07','114','65','Select flight class','Private Car','0','','56','27','0','2','Additional Requirements','2016-02-14','0','66','Private Car','0','','27','Dropoff Location','17:00','','2016-01-18 17:03:44','Rhonda Niles','','','BGI-ZKJ7RFPY',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(16,'Mr','MALCOLM','UNWIN','','95','','12095812',2,0,0,'',0,'','2016-02-07','114','65','Select flight class','Private Car','0','','56','0','0','2','Additional Requirements','2016-02-21','115','66','Private Car','0','','Pickup Location','56','13:30','','2016-01-18 17:10:01','Rhonda Niles','2016-01-18 17:14:34','Rhonda Niles','BGI-HRVM6Z4Y',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(17,'Mr','Lewis','Garfield','','142','','011215154818',2,0,0,'Traveling with Riley party at Atlantis. Departing together on the 23rd February.',1,'','2016-02-10','103','2','Select flight class','','0','','56','46','234','2','Additional Requirements','2016-02-23','81','52','Private Car','0','','46','56','','','2016-01-18 17:10:35','Lisa Thompson','2016-01-19 14:39:53','Lisa Thompson','BGI-DSHZP36B',0,'',1,'','Departure transfer with Mr/Mrs Riley','Breakfast included - moving to one Bedroom Suite on the 22nd February',0,0,0,0,0,0,0,0,0,'1',''),
(18,'Mr','STEPHEN','BURGESS','','102','','CABM7YM',2,0,0,'',0,'','2016-02-06','7','1','Select flight class','Private Car','0','','56','1','0','2','Additional Requirements','2016-02-16','78','50','Private Car','0','','1','Dropoff Location','15:00','','2016-01-18 17:19:39','Rhonda Niles','2016-01-18 17:21:27','Rhonda Niles','BGI-K24JYJNK',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(19,'Mrs','MOLLIE','BUCKLEY','','42','','PR4AG9I',2,0,0,'',1,'','2016-02-08','0','18','Select flight class','Private Car','0','','56','17','0','2','Additional Requirements','2016-02-19','0','55','Private Car','0','','17','Dropoff Location','17:30','','2016-01-18 17:26:28','Rhonda Niles','2016-01-18 17:30:16','Rhonda Niles','BGI-ZJQDK6C8',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(20,'Mr','MARTIN','RILEY','','142','','050815161104',2,0,0,'Departure transfer with Garfield',1,'','2016-02-10','103','2','Select flight class','Private Car','0','','56','9','0','2','Additional Requirements','2016-02-23','116','52','Private Van','0','','46','56','','','2016-01-18 17:29:16','Lisa Thompson','2016-01-19 14:33:21','Lisa Thompson','BGI-ST9JH9QY',0,'',1,'','Departure transfer with Mr/Mrs Garfield','Breakfast &amp; dinner',0,0,0,0,0,0,0,0,0,'1',''),
(21,'Mr','LAURENCE','UPTON','','142','','061115152220',2,0,0,'',0,'','2016-02-22','119','18','Select flight class','Private Car','0','','56','3','211','2','Additional Requirements','2016-02-29','120','55','Private Car','0','','3','56','','','2016-01-18 17:37:22','Lisa Thompson','2016-01-19 14:40:49','Lisa Thompson','BGI-KV4BX4W6',0,'',1,'','','Full breakfast',0,0,0,0,0,0,0,0,0,'1',''),
(22,'Mr','RICHARD','OWEN','','102','','3A0JKK',2,0,0,'',0,'','2016-02-08','119','18','Select flight class','Private Car','0','','56','21','0','2','Additional Requirements','2016-02-12','120','55','Private Car','0','','21','Dropoff Location','17:30','','2016-01-18 17:39:20','Rhonda Niles','','','BGI-GQT8TMXD',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(23,'Mr','RICHARD','ALLISON','','96','','TS3VO3L',2,0,0,'',0,'','2016-02-04','0','63','Select flight class','Private Car','0','','56','13','0','2','Additional Requirements','2016-02-18','112','68','Private Car','0','','Pickup Location','Dropoff Location','17:40','','2016-01-18 17:44:43','Rhonda Niles','','','BGI-VSSC83H5',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(24,'Mr','A','HARTWIG','','20','','126452',2,0,0,'Guests have a home in BGI dfd dfd dfs sdfsd lsdf sdfsdfs Guests have a home in BGI dfd dfd dfs sdfsd lsdf sdfsdfs Guests have a home in BGI dfd dfd dfs sdfsd lsdf sdfsdfs Guests have a home in BGI dfd dfd dfs sdfsd lsdf sdfsdfs Guests have a home in BGI d',0,'','2016-02-04','121','10','Select flight class','No Transfer','0','','56','0','','9','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','10:05','','2016-01-19 10:08:43','Dale Brewster','2016-09-02 03:27:34','Creative Tech','BGI-NNP2SMFG',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(25,'Mr','CLIVE','BINGHAM','','20','','140710',2,0,0,'',0,'','2016-02-04','','0','Select flight class','Private Car','0','','57','8','0','2','Additional Requirements','2016-02-06','118','50','Private Car','0','','8','56','15:15','','2016-01-19 10:13:57','Dale Brewster','','','BGI-K5MMRMQD',0,'',1,'14.00 - Arrive Fred Olsen Cruise','','',0,0,0,0,0,0,0,0,0,'',''),
(26,'Mr','JOZSEF','ILLES','','20','','147567',2,0,0,'',0,'','2016-02-04','117','1','Select flight class','Private Car','0','','56','3','0','2','Additional Requirements','2016-02-13','118','50','Private Car','0','','3','56','15:00','','2016-01-19 10:19:11','Dale Brewster','2016-01-19 15:08:54','Dale Brewster','BGI-J8PNMQ7K',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(27,'Mr','NORMAN','STORY','','20','','142018',2,0,0,'Repeat guests',0,'','2016-02-04','0','2','Select flight class','Private Car','0','','56','1','0','2','Additional Requirements','2016-02-11','81','52','Private Car','0','','1','56','14:15','','2016-01-19 10:48:27','Dale Brewster','','','BGI-KWB4QJQ4',0,'',1,'FT c/o Hotel','','',0,0,0,0,0,0,0,0,0,'',''),
(28,'Mr','D','CLARKE','','56','','1365900',2,0,0,'',0,'','2016-02-01','108','1','6','No Transfer','0','','0','0','','3','Additional Requirements','2016-02-01','122','69','','0','','Pickup Location','Dropoff Location','11:40','','2016-01-19 11:45:25','Lisa Thompson','2016-01-19 14:41:22','Lisa Thompson','BGI-DG8QSQNG',0,'',1,'UNION','','',0,0,0,0,0,0,0,0,0,'',''),
(29,'Mr','A','DENNIS','','56','','1340435',2,0,0,'Pax moving to Crystal on the 8th February - no transfer',0,'','2016-02-01','108','1','6','Private Car','0','','56','36','181','2','Additional Requirements','2016-02-14','78','50','Private Car','0','','21','56','','','2016-01-19 11:57:52','Lisa Thompson','2016-01-19 14:41:41','Lisa Thompson','BGI-T3BQFVG2',0,'',1,'','','',0,0,0,0,0,0,0,0,6,'1',''),
(30,'Mr','D','HUCKSON','','56','','1429370',2,0,0,'',0,'','2016-02-01','108','1','5','No Transfer','0','','0','0','','9','Additional Requirements','2016-02-01','126','72','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 12:05:51','Lisa Thompson','2016-01-19 14:42:03','Lisa Thompson','BGI-4H382DQT',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(31,'Mr','FREDERICK','JONES','','96','','TS3W6XJ',2,0,0,'',0,'','2016-02-05','119','18','Select flight class','Private Car','0','','56','21','0','2','Additional Requirements','2016-02-15','120','55','Private Car','0','','21','56','17:30','','2016-01-19 12:09:42','Rhonda Niles','','','BGI-TT6WG7HJ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(32,'Mrs','S','KELLY','','56','','1425516',1,0,0,'',0,'','2016-02-01','119','18','6','Group Transfers (shared)','0','','56','4','145','2','Additional Requirements','2016-02-12','120','55','Group Transfers (shared)','0','','4','56','','','2016-01-19 12:09:52','Lisa Thompson','2016-01-19 14:42:59','Lisa Thompson','BGI-CGZY3SRZ',0,'',1,'','','',0,0,0,0,0,0,0,0,6,'1',''),
(33,'Mr','ROBERT','DEANE','','29','','9003421',2,0,0,'',0,'','2016-02-05','119','18','Select flight class','Private Car','0','','56','1','0','2','Additional Requirements','2016-02-15','120','55','Private Car','0','','1','56','17:30','','2016-01-19 12:12:26','Rhonda Niles','2016-01-19 13:16:31','Rhonda Niles','BGI-DS4ZPSDT',0,'',2,'','','',0,0,0,0,0,0,0,0,0,'',''),
(34,'Mr','J','WILDE','','56','','1436735',2,0,0,'',0,'','2016-01-01','119','18','6','Private Car','0','','56','49','249','2','Additional Requirements','2016-02-15','120','55','Private Car','0','','49','56','','','2016-01-19 12:13:10','Lisa Thompson','2016-01-19 14:43:19','Lisa Thompson','BGI-RW7ZCMHQ',0,'',1,'','','',0,0,0,0,0,0,0,0,6,'1',''),
(35,'Mr','BARTHOLOMEW','ALDWINKLE','','29','','9003493',2,0,0,'',0,'','2016-02-06','117','1','Select flight class','Private Car','0','','56','57','0','2','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','12:15','','2016-01-19 12:15:38','Rhonda Niles','2016-01-19 13:16:50','Rhonda Niles','BGI-F289P3T3',0,'',2,'Arrival Transfer only','','',0,0,0,0,0,0,0,0,0,'',''),
(36,'Mr','HEDLEY','ASHMAN','','96','','TS3VVEJ',2,0,0,'',0,'','2016-02-08','119','18','Select flight class','Group Transfers (shared)','0','','56','14','0','2','Additional Requirements','2016-02-22','120','55','Group Transfers (shared)','0','','14','56','18:30','','2016-01-19 12:20:33','Rhonda Niles','','','BGI-JPBSQD2Y',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'1',''),
(37,'Mr','BRUCE','GORDON','','29','','9003564',2,0,0,'',0,'','2016-02-05','108','1','Select flight class','Private Car','0','','56','29','0','2','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','12:30','','2016-01-19 12:29:52','Rhonda Niles','2016-01-19 13:17:07','Rhonda Niles','BGI-X4GSD6NN',0,'',2,'Arrival transfer only','','',0,0,0,0,0,0,0,0,0,'1',''),
(38,'Mr','TREVOPR','RAYNOR','','42','','GP4BEST ',1,0,0,'',0,'','2016-02-05','105','2','Select flight class','Group Transfers (shared)','0','','56','10','0','2','Additional Requirements','2016-02-12','0','24','Group Transfers (shared)','0','','10','56','06:45','','2016-01-19 12:35:25','Rhonda Niles','2016-01-19 12:38:21','Rhonda Niles','BGI-74Y38HWT',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(39,'Mr','ALAN','KER','','42','','GT4C32P',5,0,0,'',0,'','2016-02-08','119','18','Select flight class','Group Transfers (shared)','0','','56','49','248','2','Additional Requirements','2016-02-15','120','55','Group Transfers (shared)','0','','49','56','18:30','','2016-01-19 12:46:29','Rhonda Niles','','','BGI-BMXFGZHP',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'2',''),
(40,'Mrs','ANGELA','QUINN','','117','','1272098',4,0,0,'',0,'','2016-02-05','105','2','Select flight class','Merc/BMW','0','','56','21','0','2','Additional Requirements','2016-02-14','81','52','Merc/BMW','0','','21','56','14:45','','2016-01-19 12:52:27','Rhonda Niles','2016-01-19 13:22:34','Rhonda Niles','BGI-VT39T2HR',0,'',2,'2 Merc/BMW','2 Merc/BMW','',0,0,0,0,0,0,0,0,0,'',''),
(41,'Mr','ROBERT','ROBERT','','96','','TS3W9CH ',2,0,0,'',0,'','2016-02-08','119','18','Select flight class','Private Car','0','','56','130','0','2','Additional Requirements','2016-02-19','120','55','Private Car','0','','130','56','17:15','','2016-01-19 12:57:09','Rhonda Niles','','','BGI-WBGG9J3H',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'1',''),
(42,'Mr','R','ROBSON','','9','','4FG9G2',2,0,0,'',0,'','2016-02-04','105','2','Select flight class','Private Car','0','','56','43','0','1','Additional Requirements','2016-02-16','116','52','Private Car','0','','43','56','15:15','','2016-01-19 13:24:48','Dale Brewster','','','BGI-RVJJTMCB',0,'',1,'Mrs requires wheelchair assistance','Mrs requires wheelchair assistance','',0,0,0,0,0,0,0,0,0,'',''),
(43,'Mr','N','BILHAM','','9','','7WQ3VZ',2,0,0,'',0,'','2016-02-04','123','70','Select flight class','Private Car','0','','56','0','','1','Additional Requirements','2016-02-11','104','62','Private Car','0','','Pickup Location','56','17:45','','2016-01-19 13:28:51','Dale Brewster','','','BGI-6ZC78QYD',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(44,'Mr','LEE','COVENEY','','91','','383845',2,0,0,'',0,'','2016-02-04','','0','Select flight class','No Transfer','0','','56','131','0','1','Additional Requirements','2016-02-04','118','50','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 13:29:04','Rhonda Niles','2016-01-19 13:34:29','Rhonda Niles','BGI-2F8DGPFZ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(45,'Mr','T','BIRD','','9','','52T8DK',2,0,0,'',0,'','2016-02-04','123','70','Select flight class','Group Transfers (shared)','0','','56','13','0','1','Additional Requirements','2016-02-14','81','52','Group Transfers (shared)','0','','13','56','14:35','','2016-01-19 13:38:52','Dale Brewster','','','BGI-34SGGHK6',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(46,'Mr','ROSS','PRENTICE','','91','','383844',4,0,0,'',0,'','2016-02-05','132','75','Select flight class','No Transfer','0','','56','133','0','1','Additional Requirements','2016-02-05','129','50','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 13:40:01','Rhonda Niles','2016-01-19 13:42:52','Rhonda Niles','BGI-K3F25P36',0,'',1,'Lounge Tickets','','',0,0,0,0,0,0,0,0,0,'',''),
(47,'Mr','JOHN','GOODGAME','','91','','384508',2,0,0,'',0,'','2016-02-06','132','75','Select flight class','No Transfer','0','','56','133','0','1','Additional Requirements','2016-02-06','118','50','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 13:46:50','Rhonda Niles','','','BGI-X8RG3HDT',0,'',1,'Lounge Tickets','','',0,0,0,0,0,0,0,0,0,'',''),
(48,'Mr','PETER','O&#039;BRIEN','','91','','384370',4,0,0,'',0,'','2016-02-06','26','17','Select flight class','No Transfer','0','','56','133','0','1','Additional Requirements','2016-02-06','0','62','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 13:51:59','Rhonda Niles','2016-01-19 13:52:57','Rhonda Niles','BGI-94852ZHD',0,'',1,'Lounge Tickets','','',0,0,0,0,0,0,0,0,0,'',''),
(49,'Mr','JOHN','MOGAN','','91','','383885',2,0,0,'',0,'','2016-02-08','132','75','Select flight class','No Transfer','0','','56','133','0','1','Additional Requirements','2016-02-08','0','50','No Transfer','0','','Pickup Location','Dropoff Location','','','2016-01-19 13:59:02','Rhonda Niles','','','BGI-NRBQ3NSJ',0,'',1,'Lounge Tickets','','',0,0,0,0,0,0,0,0,0,'',''),
(50,'Mr','ERIC','ACLAND','','41','','TRB_1015008333T1',2,0,0,'',0,'','2016-02-08','119','18','Select flight class','','0','','56','27','0','Representation','Additional Requirements','2016-02-15','120','55','','0','','27','56','','','2016-01-19 14:06:29','Lisa Thompson','2016-01-19 14:44:24','Lisa Thompson','BGI-RQCCY4S3',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(51,'Mrs','SHELLEY','PATON-EADES','','1','','TRB_1015010209T1',2,1,0,'',0,'','2016-02-06','117','1','Select flight class','Group Transfers (shared)','0','','56','134','0','2','Additional Requirements','2016-02-16','118','50','Group Transfers (shared)','0','','Pickup Location','56','','','2016-01-19 14:22:22','Lisa Thompson','2016-01-19 14:45:22','Lisa Thompson','BGI-6XM73S4B',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(52,'Mr','MARK','TRACEY','','41','','TRB_0715022467T1',2,0,0,'',0,'','2016-02-06','117','1','Select flight class','Private Car','0','','56','41','0','2','Additional Requirements','2016-02-18','118','50','Private Car','0','','41','56','','','2016-01-19 14:51:04','Lisa Thompson','','','BGI-KXK7PTFQ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(53,'Mrs','PATRICIA','WORLD','','41','','TRB_0915001138T1',1,0,0,'',0,'','2016-02-05','119','18','Select flight class','Group Transfers (shared)','0','','56','19','0','2','Additional Requirements','2016-02-12','120','55','Group Transfers (shared)','0','','19','56','14:55','','2016-01-19 15:03:14','Lisa Thompson','','','BGI-5HWY4S6W',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(54,'Mr','S','CORNEY','','9','','5KPQZH',2,0,0,'',0,'','2016-02-04','123','70','Select flight class','Group Transfers (shared)','0','','56','55','0','1','Additional Requirements','2016-02-14','136','52','Group Transfers (shared)','0','','55','56','15:05','','2016-01-19 15:04:04','Dale Brewster','','','BGI-27Q2PNGZ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(55,'Mrs','CHARLOTTE','EXLEY','','41','','TRB_0815026476T1',2,0,0,'',0,'','2016-02-05','119','18','Select flight class','Group Transfers (shared)','0','','56','49','0','1','Additional Requirements','2016-02-12','120','55','Group Transfers (shared)','0','','49','56','','','2016-01-19 15:05:46','Lisa Thompson','','','BGI-SVSJYZGG',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(56,'Mr','DENIS','LANGTON','N/A','132','','',2,0,0,'',1,'','2016-02-19','119','18','6','','0','','0','24','0','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','','RATE USD$30 ','2016-01-19 15:09:30','Rhema Reid','2016-01-19 15:10:21','Rhema Reid','BGI-PZNT8BGZ',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(57,'Mr','MICHAEL','GOLDBERG ','','132','','',2,0,0,'',1,'','2016-02-16','117','1','Select flight class','','0','','0','17','0','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','','RATE USD$30','2016-01-19 15:13:42','Rhema Reid','','','BGI-PTWKXF56',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(58,'Mrs','GAYNOR','SELLORS ','','120','','BR-565981109',2,0,0,' ',1,'','0000-00-00','','0','Select flight class','','0','','0','2','0','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','15:15','RATE USD$35','2016-01-19 15:17:49','Rhema Reid','','','BGI-ZMFYPXYW',0,'',1,'TAKE TO SANDALS REP ','','',0,0,0,0,0,0,0,0,0,'',''),
(59,'Mr','KARL','DANIELS','','20','','140309',2,0,0,'Repeat guests; Drive-a-Matic Chevy Spark @ U$497; 10 am - Feb 7-15. Mr. Daniels is 80 yrs &amp; requires Dr&#039;s certificate. Dana: Pls ck that DAM have very nice car',1,'','2016-02-06','123','70','Select flight class','Private Car','0','','56','15','0','2','Car hire','2016-02-16','116','52','Private Car','0','','Pickup Location','Dropoff Location','15:10','','2016-01-19 15:18:36','Dale Brewster','','','BGI-73QFQBKM',0,'',1,'','','',1,0,0,0,0,0,2,2,0,'',''),
(60,'Mr','ANDREW','HOLLAND','','41','','TRB_0715000754T1',2,0,0,'',0,'','2016-02-05','119','18','Select flight class','Group Transfers (shared)','0','','56','27','0','1','Additional Requirements','2016-02-15','120','55','Group Transfers (shared)','0','','27','56','','','2016-01-19 15:24:12','Lisa Thompson','','','BGI-8VTQXV52',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(61,'Mr','W','RENNIE','','9','','8DEV3R',3,0,0,'Miss R Rennie is 14 years',0,'','2016-02-04','123','70','Select flight class','Group Transfers (shared)','0','','56','23','0','1','Additional Requirements','2016-02-15','116','52','Group Transfers (shared)','0','','23','56','15:05','','2016-01-19 15:32:38','Dale Brewster','','','BGI-JF529WK2',0,'',1,'Miss R Rennie is 14 years','Miss R Rennie is 14 years','',0,0,0,0,0,0,0,0,0,'',''),
(62,'Mr','charles','collett','','61','','40315',2,0,0,'PNR: 3Y633U',0,'','2016-02-03','103','2','8','Merc/BMW','0','','56','17','70','2','Additional Requirements','2016-02-16','116','52','Merc/BMW','0','','17','56','15:00','','2016-01-19 15:41:03','Dale Brewster','2016-03-22 12:05:33','Alvin Herbert','BGI-XK535637',0,'',1,'','PNR: 3Y633U','Bed &amp; B&#039;fast; Request King bed',0,0,0,0,0,0,2,2,8,'',''),
(63,'Mr','MARTIN','HUGHES','','61','','33714',2,0,0,'Repeat; Half-Board; Seats: 20 E,F; PNR: JDCYNP',0,'','2016-02-05','105','2','6','Merc/BMW','0','','56','46','234','2','Additional Requirements','2016-02-12','6','6','Merc/BMW','','','46','56','05:30','','2016-01-19 15:59:27','Dale Brewster','2016-03-22 16:50:07','Alvin Herbert','BGI-MKPJWV94',0,'',1,'Repeat guests','Seats: 20 E,F; PNR: JDCYNP','Half-Board; Rsvn #149012',0,0,0,0,0,0,2,2,6,'',''),
(64,'Mr','william','mcIntosh','','61','','39707',2,0,0,'Room move on 11 Feb\r\nBed &amp; Breakfast\r\nPE - 17 D,E; PNR: FE5J5Y',0,'','2016-02-05','119','18','5','Hotel transfer','0','','56','34','169','2','Additional Requirements','2016-02-12','120','55','Hotel transfer','0','','34','56','00:00','','2016-01-19 16:10:29','Dale Brewster','','','BGI-7PPQ7NN7',0,'',1,'','PE - 17 D,E; PNR: FE5J5Y','Bed &amp; Breakfast',0,0,0,0,0,0,0,0,5,'',''),
(65,'Sir','r','hurn','','61','','37792',2,0,0,'',0,'','2016-02-05','108','1','Select flight class','No Transfer','0','','0','0','','9','Additional Requirements','2016-02-05','138','76','No Transfer','0','','Pickup Location','Dropoff Location','00:00','Full in transit service','2016-02-05 16:26:06','Dale Brewster','','','BGI-4KKDH5TR',0,'',1,'VS29 @ 1510 TO gaa614 @ 1630','','',0,0,0,0,0,0,0,0,0,'',''),
(66,'Mr','FIrst','Last','Passenger','1','Code/Brand','#RefNumberHere',2,2,3,'Notes',0,'','2016-08-23','45','28','7','Hotel transfer','31','60','56','12','43','3','Additional Requirements','0000-00-00','6','6','Private Car, Coach (BT), Merc/BMW','10','25','130','Dropoff Location','17:25','','2016-08-31 08:27:52','Creative Tech','','','BGI-XVBYTWQ2',0,'',1,'Arrival &amp; Transport notes','Departure &amp; Transport notes','Hotel notes',0,0,0,0,0,0,0,0,3,'5','23'),
(67,'','Haider','Hassan','Passenger','1','','',0,0,0,'',0,'','0000-00-00','','0','Select flight class','','0','','0','0','','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','17:30','','2016-08-31 08:28:24','Creative Tech','','','BGI-DHDBSTCW',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'',''),
(68,'','FIrst','Haider','Syed Haider','Select tour operator','','',0,0,0,'',0,'','0000-00-00','','0','Select flight class','','0','','0','0','','Representation','Additional Requirements','0000-00-00','','0','','0','','Pickup Location','Dropoff Location','17:30','','2016-08-31 08:28:48','Creative Tech','','','BGI-KX2VXH9Z',0,'',1,'','','',0,0,0,0,0,0,0,0,0,'','');

/*Table structure for table `bgi_room_loc` */

DROP TABLE IF EXISTS `bgi_room_loc`;

CREATE TABLE `bgi_room_loc` (
  `id_room_loc` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `id_roomtype` int(11) NOT NULL,
  PRIMARY KEY (`id_room_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_room_loc` */

insert  into `bgi_room_loc`(`id_room_loc`,`id_location`,`id_roomtype`) values 
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
(89,1,105),
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
(248,148,26),
(249,148,69),
(250,148,205),
(251,148,206),
(252,155,134),
(253,155,135),
(254,155,136),
(255,158,22),
(256,158,23),
(257,158,24),
(258,158,25),
(259,158,26),
(260,158,27),
(261,158,28),
(262,158,29),
(263,158,30);

/*Table structure for table `bgi_roomtypes` */

DROP TABLE IF EXISTS `bgi_roomtypes`;

CREATE TABLE `bgi_roomtypes` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `id_location` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_roomtypes` */

insert  into `bgi_roomtypes`(`id_room`,`id_location`,`room_type`) values 
(1,1,'Ocean Front Deluxe Room'),
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
(104,1,'Beach Front Junior Suite '),
(105,1,'Villa'),
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
(268,52,'Deluxe Top floor Two Bedroom Suite');

/*Table structure for table `bgi_touroperator` */

DROP TABLE IF EXISTS `bgi_touroperator`;

CREATE TABLE `bgi_touroperator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_operator` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=latin1 COMMENT='Tour Operators table';

/*Data for the table `bgi_touroperator` */

insert  into `bgi_touroperator`(`id`,`tour_operator`) values 
(3,'Agaxtur BR'),
(7,'Azure'),
(9,'BA Holidays'),
(10,'Bailey Robinson'),
(13,'Best Tours Italia'),
(19,'CV Travel'),
(20,'Caribtours'),
(22,'Classic Collection Holidays'),
(23,'Classic Resorts'),
(28,'Designer Tours BR'),
(29,'Destinology'),
(31,'Direct Bookings'),
(32,'EFR Travel (SJB Travel)'),
(35,'Eso Travel'),
(40,'Friendship Travel'),
(45,'Hays Travel'),
(46,'Holiday Place'),
(49,'Individual Holidays'),
(53,'Kuoni France'),
(54,'Kuoni Netherlands (now Tenzing Travel)'),
(56,'Kuoni UK'),
(58,'La Fabbrica'),
(61,'Lusso Travel'),
(62,'Luxury Holidays To & Value Added Travel'),
(64,'MLT Vacations'),
(65,'MotMot Travel'),
(71,'Only Exclusive'),
(74,'Pink Pearl'),
(75,'Pleasant Holidays'),
(77,'Prestbury WorldWide'),
(82,'St James Travel & Tours'),
(83,'Scott Dunn'),
(88,'Sunlinc'),
(91,'Sunset Travel (Sunset Faraway Holidays)'),
(92,'Sunway Holidays'),
(98,'Team America'),
(102,'Trailfinders'),
(107,'Travel Trend'),
(110,'Tropic Breeze'),
(116,'Turquoise Holidays'),
(117,'Travel Counsellors'),
(120,'Viator'),
(125,'We Travel2/Topflight'),
(129,'Wilderness Explorers'),
(130,'Virtuoso'),
(133,'World Travel Holdings'),
(134,'Island Villas'),
(136,'Altman'),
(140,'Accra Beach Hotel'),
(142,'Audley Travel'),
(143,'Caribbean World (Berg & Meer, Tropical Tours)'),
(144,'Collett\'s Travel'),
(145,'Kuoni Switzerland (SunTours)'),
(146,'Kuoni USA'),
(147,'Southall Travel - The Holiday Team - Away Holidays - Apple House Travel'),
(148,'Sublime Travel'),
(149,'Suntransfers'),
(150,'Thomas Cook AG'),
(151,'Thomas Cook Signature '),
(152,'Transfers 4 Travel'),
(153,'Vtours GMBH'),
(154,'W&O (Western & Oriental: Key 2 Holidays & Tropical Locations, Wando Travel)'),
(155,'Simpson Travel'),
(156,'Six Star Holidays'),
(157,'Dnata'),
(158,'Bookit.com (Destination Experience)'),
(159,'Expressions Holidays'),
(160,'Golden Holidays'),
(162,'WestJet Vacations'),
(163,'Caribbean Destinations'),
(164,'JetBlue'),
(165,'Abercrombie & Kent'),
(166,'Prestige World'),
(167,'Tropicalement Votre'),
(168,'Holiday Services'),
(169,'Dnata (Gold Medal & Stella Travel)'),
(170,'Voyage Prive'),
(171,'Hapag Lloyd Kreuzfahrten GmbH'),
(172,'Hurtigruten'),
(173,'Ponant'),
(174,'The World - Residences at Sea'),
(175,'Saga Cruises'),
(176,'Titan Travel'),
(177,'Sea Cloud Cruises'),
(178,'SeaDream Yacht Club'),
(179,'Star Clippes');

/*Table structure for table `bgi_transfer` */

DROP TABLE IF EXISTS `bgi_transfer`;

CREATE TABLE `bgi_transfer` (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_transfer` */

insert  into `bgi_transfer`(`id`,`ref_no_sys`,`pickup`,`pickup_date`,`pickup_time`,`dropoff`,`transport`,`vehicle`,`driver`,`transfer_notes`) values 
(1,'BGI-MP2XV3HR',5,'2016-01-05','',0,'Coach (BT)',0,23,'transfers and tranport notes here'),
(2,'BGI-ST9JH9QY',9,'2016-02-13','12:30',46,'Private Car',0,0,''),
(3,'BGI-VSSC83H5',0,'0000-00-00','17:40',0,'Transfer Transport mode',0,0,''),
(4,'BGI-J8PNMQ7K',0,'0000-00-00','10:15',0,'',0,0,''),
(5,'BGI-DG8QSQNG',4,'0000-00-00','',4,'',0,0,''),
(6,'BGI-2F8DGPFZ',0,'0000-00-00','13:25',0,'',0,0,''),
(8,'BGI-PC5NNVN4',47,'2016-02-26','17:00',70,'Private Car',0,0,'');

/*Table structure for table `bgi_transport` */

DROP TABLE IF EXISTS `bgi_transport`;

CREATE TABLE `bgi_transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transport`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_transport` */

insert  into `bgi_transport`(`id_transport`,`name`) values 
(4,'David Abraham'),
(6,'Ronald Adams'),
(8,'Ash Investment Inc'),
(10,'Anthony Adams'),
(11,'Barbados Ruje Wonder Tours'),
(12,'Carson Bailey'),
(13,'Grantley Beckles'),
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
(75,'A & R Antoine'),
(76,'Adrian Durham'),
(77,'Alexander & Tracey Bailey'),
(78,'Alexander Bailey'),
(79,'Alwyn Thompson'),
(80,'Anderson Funeral Home - G Beckles'),
(81,'Anderson Lawrence'),
(82,'Anderson Richards'),
(87,'Andrew Maynard'),
(88,'ANJ Services c/o Cain & Son Tours'),
(91,'Annette Bascombe'),
(93,'Anthony Eastmond & Karon Phillips'),
(95,'Antoinette Taitt'),
(96,'Ash Investments Inc.'),
(97,'Ashley Scott-Williams'),
(98,'Aubryn Bridgeman'),
(99,'Barbados Prestige Tours'),
(100,'Best Tours'),
(102,'Blessed Rentals Inc.'),
(103,'Brian Stuart'),
(104,'Caleb Knight'),
(105,'Carmeta Phillips'),
(106,'Charles Barnett'),
(107,'Christopher Hallett'),
(108,'Colvin Critchlow'),
(109,'D. A. S. Taxi Service'),
(110,'Dale Maynard'),
(111,'Damian Browne'),
(112,'David Bishop D&N TRANSPORT'),
(113,'David Gittens'),
(114,'David Sobers'),
(115,'Deanna Grant'),
(117,'E Z Auto Rentals'),
(119,'Eleven Morris'),
(120,'Estate of Clyde Stuart & Trevor Stuart'),
(121,'EZ Edge (Barbados) Inc'),
(122,'GB Luxury Services'),
(123,'Glen Harewood'),
(125,'Graham Clarke'),
(126,'Harvey Goulbourne, c/o Esther'),
(127,'James Fields'),
(128,'Jean Gooding'),
(129,'Julia Clarke'),
(130,'Junior Kellman'),
(131,'JW Transport Services Inc'),
(132,'Karen Brewster & Ralph Sealy'),
(134,'Kenmore Lynch'),
(135,'Kevin Gumbs'),
(136,'Kimicia Hunte'),
(137,'Kris Brathwaite'),
(138,'Krysnatash Investments Ltd/Gary Skeete'),
(139,'Kyle Springer'),
(140,'Lemar Anthony Jordan & Hamilton Scantlebury'),
(141,'Lionel Cain'),
(142,'Livingston Davis'),
(143,'Lyndon Carter'),
(144,'Marcus Wickham'),
(145,'Marlene Wharton'),
(146,'Matthew & Shirley Clarke'),
(147,'Michael Sealy'),
(148,'Myles Gill'),
(149,'Ordan Jacobs'),
(150,'Orville Eversley'),
(151,'Rainbow Tours'),
(152,'Raymond Layne'),
(153,'Raymond Mayers'),
(154,'Ricky Alkins'),
(155,'Roger Maughn'),
(156,'Ryan Mason'),
(157,'Ryan Tours'),
(158,'Samuel Knight'),
(159,'Selvin Bryan'),
(160,'Shane Bernard Grant'),
(161,'Sharon Mascoll'),
(162,'Sheridan Broomes'),
(163,'Terry Haynes'),
(164,'Terry Jordan'),
(165,'Thomas Tours'),
(167,'Tudor Funeral Home Sheryl-Ann Tudor'),
(168,'Waldo Waterman'),
(169,'Wendy Harrison'),
(170,'Wensville Lascelle'),
(172,'Winfield Best'),
(173,'Christopher Hunte'),
(174,'Tyrone Belgrave');

/*Table structure for table `bgi_transporttype` */

DROP TABLE IF EXISTS `bgi_transporttype`;

CREATE TABLE `bgi_transporttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_transporttype` */

insert  into `bgi_transporttype`(`id`,`transport_type`) values 
(1,'Group Transfers (shared)'),
(2,'Limousine'),
(3,'Private Car'),
(4,'Coach (BT)'),
(5,'Merc/BMW'),
(6,'Mercedes'),
(7,'Private Van'),
(8,'Hotel transfer'),
(9,'Hydrolic Vehicle'),
(10,'No Transfer'),
(11,'Own transport');

/*Table structure for table `bgi_vehicles` */

DROP TABLE IF EXISTS `bgi_vehicles`;

CREATE TABLE `bgi_vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `id_transport` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=latin1;

/*Data for the table `bgi_vehicles` */

insert  into `bgi_vehicles`(`id_vehicle`,`id_transport`,`name`) values 
(18,6,'ZM316'),
(20,8,'Z1149'),
(21,8,'Z1229'),
(23,8,'ZM755'),
(36,18,'ZM389'),
(37,19,'Z17'),
(40,19,'Z569'),
(41,19,'ZM311'),
(42,19,'ZM796'),
(44,19,'BT95'),
(46,21,'Z1702'),
(49,23,'BT96'),
(50,24,'Z1003'),
(53,26,'ZM440'),
(54,27,'ZM802'),
(56,29,'ZM683'),
(58,30,'XA460'),
(64,34,'ZM15'),
(66,36,'ZM92'),
(71,40,'Z59'),
(72,40,'Z772'),
(73,41,'ZM125'),
(74,42,'Z1098'),
(77,43,'Z1252'),
(79,45,'Z1091'),
(83,49,'ZM390'),
(84,49,'ZM290'),
(85,49,'Z916'),
(86,49,'Z871'),
(87,50,'ZM575'),
(88,51,'ZM512'),
(89,52,'Z868'),
(93,4,'Z1053'),
(98,58,'HL58'),
(99,59,'Z926'),
(100,60,'Z1420'),
(103,63,'ZM403'),
(106,66,'Z997'),
(109,69,'BT17'),
(110,70,'Z982'),
(111,70,'Z1554'),
(112,71,'Z1210'),
(117,27,'Z1285'),
(118,30,'X6588'),
(119,19,'ZM314'),
(120,19,'ZM473'),
(121,19,'BT29'),
(122,119,'ZM48'),
(123,48,'ZM74'),
(124,48,'ZM75'),
(125,48,'ZM665'),
(126,60,'ZM855'),
(127,71,'ZM393'),
(128,75,'Z1520'),
(129,76,'Z1360'),
(130,77,'Z849'),
(131,78,'Z1949 '),
(132,79,'ZM760'),
(133,80,'HL19 '),
(134,81,'Z596'),
(135,82,'ZM699'),
(136,87,'ZM354'),
(137,88,'BT33'),
(138,91,'Z1320'),
(139,93,'Z217'),
(140,95,'Z1687'),
(141,97,'Z416'),
(142,98,'ZM257'),
(143,99,'BT80'),
(144,99,'BT87'),
(146,100,'Z1797'),
(147,100,'ZM326'),
(148,100,'ZM140'),
(149,16,'Z229'),
(150,102,'Z2007'),
(151,103,'Z1168'),
(152,104,'ZM703'),
(153,105,'Z970'),
(154,106,'Z155'),
(155,107,'BT108'),
(156,173,'BT25'),
(157,108,'Z1610'),
(158,109,'Z650'),
(159,110,'Z1453'),
(160,111,'Z2071'),
(161,112,'ZM255'),
(162,112,'ZM256'),
(163,113,'Z1739'),
(164,114,'Z25'),
(165,115,'Z1594'),
(166,32,'Z286'),
(167,117,'Z1859'),
(168,35,'Z1200'),
(169,120,'Z412'),
(170,121,'BT110'),
(171,122,'Z75'),
(172,123,'Z989'),
(173,125,'ZM857'),
(174,126,'Z1443'),
(175,127,'ZM31'),
(176,127,'ZM243'),
(177,128,'ZM90'),
(178,129,'ZM759'),
(179,130,'ZM859'),
(180,131,'BT94'),
(181,132,'Z438'),
(182,134,'Z1606'),
(183,135,'Z24'),
(184,136,'ZM687'),
(185,137,'Z2026'),
(186,138,'ZM701'),
(187,139,'Z802'),
(188,140,'Z1047'),
(189,141,'ZM85'),
(190,142,'Z1355'),
(191,143,'Z1235'),
(192,144,'Z907'),
(193,145,'ZM694'),
(194,146,'ZM849'),
(195,147,'Z228'),
(196,148,'Z1141'),
(197,149,'Z1468'),
(198,148,'Z1141'),
(199,149,'Z1468'),
(200,150,'Z835'),
(201,151,'BT1'),
(202,151,'BT26'),
(203,152,'ZM856'),
(204,153,'Z863'),
(205,154,'BT65'),
(206,155,'Z443'),
(207,156,'Z1297'),
(208,157,'BT9'),
(209,158,'ZM396'),
(210,159,'Z1487'),
(211,160,'ZM343'),
(212,161,'ZM433'),
(213,162,'Z755'),
(214,163,'ZM798'),
(215,164,'ZM426'),
(216,165,'BT42'),
(217,167,'Z45 '),
(218,168,'ZM861'),
(219,169,'Z1988 '),
(220,170,'Z1170'),
(221,172,'Z1150'),
(222,174,'ZM524');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
