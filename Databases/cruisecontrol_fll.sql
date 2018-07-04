/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cruisecontrol_fll
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cruisecontrol_fll` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cruisecontrol_fll`;

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `help` text,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `email_templates` */

insert  into `email_templates`(`id`,`name`,`subject`,`help`,`body`) values 
(1,'Registration Email','Please verify your email','This template is used to send Registration Verification Email, when Configuration->Registration Verification is set to YES','&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;         &lt;hr /&gt;\n            The administrator of this site has requested all new accounts&lt;br /&gt;\n            to be activated by the users who created them thus your account&lt;br /&gt;\n            is currently inactive. To activate your account,&lt;br /&gt;\n            please visit the link below and enter the following:&lt;hr /&gt;\n            Token: &lt;strong&gt;[TOKEN]&lt;/strong&gt;&lt;br /&gt;\n            Email: &lt;strong&gt;[EMAIL]&lt;/strong&gt;         &lt;hr /&gt;\n            &lt;a href=&quot;[LINK]&quot;&gt;Click here to activate tour account&lt;/a&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(2,'Forgot Password Email','Password Reset','This template is used for retrieving lost user password','&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;New password reset from [SITE_NAME]!&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello, &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            It seems that you or someone requested a new password for you.&lt;br /&gt;\n            We have generated a new password, as requested:&lt;br /&gt;\n            &lt;br /&gt;\n            Your new password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            To use the new password you need to activate it. To do this click the link provided below and login with your new password.&lt;br /&gt;\n            &lt;a href=&quot;[LINK]&quot;&gt;[LINK]&lt;/a&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            You can change your password after you sign in.&lt;hr /&gt;\n            Password requested from IP: [IP]&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(3,'Welcome Mail From Admin','You have been registered','This template is used to send welcome email, when user is added by administrator','&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! You have been Registered.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(4,'Default Newsletter','Newsletter','This is a default newsletter template','&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello [NAME]!&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You are receiving this email as a part of your newsletter subscription.         &lt;hr /&gt;\n            Here goes your newsletter content         &lt;hr /&gt;\n            &lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;         &lt;hr /&gt;\n            &lt;span style=&quot;font-size: 11px;&quot;&gt;&lt;em&gt;To stop receiving future newsletters please login into your account         and uncheck newsletter subscription box.&lt;/em&gt;&lt;/span&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(7,'Welcome Email','Welcome','This template is used to welcome newly registered user when Configuration-&gt;Registration Verification and Configuration-&gt;Auto Registration are both set to YES','&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(10,'Contact Request','Contact Inquiry','This template is used to send default Contact Request Form','&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new contact request:         &lt;hr /&gt;\n            [MESSAGE]         &lt;hr /&gt;\n            From: &lt;strong&gt;[SENDER] - [NAME]&lt;/strong&gt;&lt;br /&gt;\n            Subject: &lt;strong&gt;[MAILSUBJECT]&lt;/strong&gt;&lt;br /&gt;\n            Senders IP: &lt;strong&gt;[IP]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(12,'Single Email','Single User Email','This template is used to email single user','&lt;div align=&quot;center&quot;&gt;\n  &lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n      &lt;tr&gt;\n        &lt;th style=&quot;background-color:#ccc&quot;&gt;Hello [NAME]&lt;/th&gt;\n      &lt;/tr&gt;\n      &lt;tr&gt;\n        &lt;td valign=&quot;top&quot; style=&quot;text-align:left&quot;&gt;Your message goes here...&lt;/td&gt;\n      &lt;/tr&gt;\n      &lt;tr&gt;\n        &lt;td style=&quot;text-align:left&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n          [SITE_NAME] Team&lt;br /&gt;\n          &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n      &lt;/tr&gt;\n    &lt;/tbody&gt;\n  &lt;/table&gt;\n&lt;/div&gt;'),
(13,'Notify Admin','New User Registration','This template is used to notify admin of new registration when Configuration->Registration Notification is set to YES','&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new user registration. You can login into your admin panel to view details:&lt;hr /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Name: &lt;strong&gt;[NAME]&lt;/strong&gt;&lt;br /&gt;\n            IP: &lt;strong&gt;[IP]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(14,'Registration Pending','Registration Verification Pending','This template is used to send Registration Verification Email, when Configuration->Auto Registration is set to NO','&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;         &lt;hr /&gt;\n            The administrator of this site has requested all new accounts&lt;br /&gt;\n            to be activated by the users who created them thus your account&lt;br /&gt;\n            is currently pending verification process.&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;'),
(16,'Account Activation','Your account have been activated','This template is used to notify user when manual account activation is completed','&lt;div align=&quot;center&quot;&gt;\n&lt;table style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot; border=&quot;0&quot; cellpadding=&quot;5&quot; cellspacing=&quot;5&quot; width=&quot;600&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello, [NAME]! &lt;br&gt;&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n          &lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;Hello,&lt;br&gt;\n            &lt;br&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br&gt;\n            &lt;br&gt;\n            Your account is now fully activated\n            , and you may login at \n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;\n            &lt;hr&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br&gt;\n            [SITE_NAME] Team&lt;br&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(55) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`id`,`title`,`body`,`author`,`created`,`active`) values 
(1,'Notice!','&lt;p&gt;Please report any system bugs immediately using the bug report section &amp;gt; &lt;b&gt;&lt;a href=&quot;bug-report.php&quot;&gt;Report a bug&lt;/a&gt;&lt;/b&gt;.&lt;/p&gt;&lt;p&gt;Your valued assistance with ensuring this platform is bug free is greatly appreciated.&lt;/p&gt;&lt;p align=&quot;right&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p align=&quot;left&quot;&gt;&lt;sub&gt;&amp;nbsp;Administrator:&lt;/sub&gt;&lt;i&gt;&lt;sub&gt; Nicole Moody&lt;/sub&gt;&lt;/i&gt;&lt;br&gt;&lt;/p&gt;','Nicole Moody','2015-07-01',1);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) DEFAULT NULL,
  `site_email` varchar(40) DEFAULT NULL,
  `site_url` varchar(200) DEFAULT NULL,
  `reg_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `user_limit` tinyint(1) NOT NULL DEFAULT '0',
  `reg_verify` tinyint(1) NOT NULL DEFAULT '0',
  `notify_admin` tinyint(1) NOT NULL DEFAULT '0',
  `auto_verify` tinyint(1) NOT NULL DEFAULT '0',
  `user_perpage` varchar(4) NOT NULL DEFAULT '10',
  `thumb_w` varchar(4) NOT NULL,
  `thumb_h` varchar(4) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `backup` varchar(60) DEFAULT NULL,
  `mailer` enum('PHP','SMTP') NOT NULL DEFAULT 'PHP',
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(6) DEFAULT NULL,
  `is_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

insert  into `settings`(`id`,`site_name`,`site_email`,`site_url`,`reg_allowed`,`user_limit`,`reg_verify`,`notify_admin`,`auto_verify`,`user_perpage`,`thumb_w`,`thumb_h`,`logo`,`backup`,`mailer`,`smtp_host`,`smtp_user`,`smtp_pass`,`smtp_port`,`is_ssl`,`version`) values 
(1,'Flagship','nicole.moody@sunlinc.net','http://25.114.31.88/admin-panel-fll',0,0,0,0,0,'10','72','72','logo.png','27-Sep-2013_17-35-49.sql','PHP','mail.stjamesgroup.com','alvin.herbert@stjamesgroup.com','@lv1Nh3?b','465',1,'2.50');

/*Table structure for table `user_levels` */

DROP TABLE IF EXISTS `user_levels`;

CREATE TABLE `user_levels` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user_levels` */

insert  into `user_levels`(`level_id`,`role_name`) values 
(1,'Registered User'),
(2,'Reservations'),
(3,'Fast Track'),
(4,'Accounts'),
(5,'Supervisor'),
(6,'Manager'),
(7,'Administrator'),
(9,'Super Admin');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `cookie_id` varchar(64) NOT NULL DEFAULT '0',
  `token` varchar(128) NOT NULL DEFAULT '0',
  `userlevel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `avatar` varchar(60) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastip` varchar(16) DEFAULT NULL,
  `notes` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `active` enum('y','n','b','t') NOT NULL DEFAULT 'n',
  `last_edit` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`cookie_id`,`token`,`userlevel`,`email`,`fname`,`lname`,`country`,`avatar`,`ip`,`created`,`lastlogin`,`lastip`,`notes`,`newsletter`,`active`,`last_edit`,`edit_by`) values 
(26,'gabriell.williams@stjamesgroup.com','b4bc4d2ebe5d1a9e542983d83bc81a6a','0','0',9,'gabriell.williams@stjamesgroup.com','Gabriell','Williams',NULL,'','','2017-06-28 16:56:57','2017-06-29 11:51:52','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(3,'rhonda.niles@stjamesgroup.com','732df225015cceb459c514fe07f8b1be','0','0',9,'rhonda.niles@stjamesgroup.com','Rhonda','Niles',NULL,'','','2015-04-27 10:39:11','2017-06-29 11:51:30','10.114.35.100','',1,'y','2017-06-28 04:06:02',9),
(27,'sherene.maughan@stjamesgroup.com','f4eb0a03eb19755a51709679f6b02387','0','0',9,'sherene.maughan@stjamesgroup.com','Sherene','Maughan',NULL,'','','2017-06-28 16:58:08','2017-06-29 13:21:58','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(5,'lisa.thompson@stjamesgroup.com','700a6badc1ff68f4c956b2631835eff3','0','0',9,'lisa.thompson@stjamesgroup.com','Lisa','Thompson',NULL,'','','2015-05-06 11:11:24','2017-06-29 11:51:51','10.114.35.100','',1,'y','2017-06-28 04:06:16',9),
(6,'gentoo','365d0fc7d6206ff26e2f2c2a78c91a94','0','0',6,'flagship.gentoo@sunlinc.net','Gentoo','System',NULL,'AVT_7E53CA-B47FAF-BE43B0-9C8525-544E2B-62741F.jpg','','2015-05-29 10:34:18','2015-10-22 12:23:03','10.114.35.100','Flagship system user - Gentoo System',1,'y','0000-00-00 00:00:00',0),
(7,'korey.boyce@stjamesgroup.com','f456fa844e380171762e65f9f408c619','0','0',6,'korey.boyce@stjamesgroup.com','Korey','Boyce',NULL,'','','2015-06-02 14:29:58','2015-06-02 14:43:59','209.59.101.92','',1,'y','0000-00-00 00:00:00',0),
(8,'marielle.alexander@stjamesgroup.com','94d2a4c84145218188e4db77360a5405','0','0',6,'marielle.alexander@stjamesgroup.com','Marielle','Alexander',NULL,'','','2015-06-02 14:31:13','2016-01-19 20:42:15','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(9,'nicole.moody@sunlinc.net','1527202bb121bd5c9efee5a27ffefc99','0','0',9,'nicole.moody@sunlinc.net','Nicole','Moody',NULL,'','','2015-06-02 14:32:42','2017-06-29 16:57:17','10.114.33.100','',1,'y','0000-00-00 00:00:00',0),
(10,'cinthya.cabrera@sunlinc.net','8444dadf469214227ea3a69b0e5d3c2a','0','0',6,'cinthya.cabrera@sunlinc.net','Cinthya','Cabrera',NULL,'','','2015-06-02 14:33:29','0000-00-00 00:00:00',NULL,'',1,'y','0000-00-00 00:00:00',0),
(11,'hsp@sunlinc.net','73a1018984082fb59f534b4bf8bc1c6c','0','0',9,'hsp@sunlinc.net','Helen Schur','Parris',NULL,'','','2015-06-03 14:22:30','2016-02-17 16:08:11','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(28,'alicia.odell@stjamesgroup.com','9e4d555c2471e76495546579741d3fd3','0','0',9,'alicia.odell@stjamesgroup.com','Alicia','O&#039;Dell',NULL,'','','2017-06-28 17:01:40','2017-06-29 13:25:47','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(13,'chris@stjamesgroup.com','a4956738c01218cc46440c0ba33650a2','0','0',9,'chris@stjamesgroup.com','Chris','Gloumeau',NULL,'','','2015-06-22 10:58:59','2017-03-31 11:07:57','10.114.35.100','',1,'y','0000-00-00 00:00:00',0),
(14,'shavanare.oliver@stjamesgroup.com','5921e156e91ab9a8b72d63c156f53658','0','0',9,'shavanare.oliver@stjamesgroup.com','Shavanaré','Oliver',NULL,'AVT_EAA4D3-B59FB3-551E06-E71AB9-354F10-5A4194.jpg','','2015-10-20 11:42:40','2017-06-29 11:52:10','10.114.35.100','',0,'y','2017-06-28 04:06:44',9),
(15,'kavita.sandiford@stjamesgroup.com','d904c5b78c8809a1c96171c710067e53','0','0',9,'kavita.sandiford@stjamesgroup.com','Kavita','Sandiford',NULL,'','','2015-12-11 15:53:07','2017-06-29 11:51:47','10.114.35.135','',1,'y','2017-06-28 04:06:24',9),
(16,'dale.brewster@stjamesgroup.com','f1b749acdcf13ecf7aa33a8433949109','0','0',9,'dale.brewster@stjamesgroup.com','Dale','Brewster',NULL,'','','2015-12-11 15:53:54','2017-06-29 11:51:57','10.114.35.31','',1,'y','2017-06-28 04:06:14',9),
(17,'nicki.king@stjamesgroup.com','25e116492052f1c320e0ae573bec6867','0','0',9,'nicki.king@stjamesgroup.com','Nicki','King',NULL,'','','2015-12-11 16:09:47','2017-06-29 11:51:13','10.114.35.41','',1,'y','2017-06-28 04:06:58',9),
(19,'CreativeTech','bf89c890399194b76ad83102f0c1b2af','0','0',9,'creative.joomdev@gmail.com','Creative','Tech',NULL,'sss.jpg','','2016-06-23 01:06:07','2017-07-13 16:42:53','::1','',1,'y','0000-00-00 00:00:00',0),
(20,'katrina.jacobs','7212e0f46286adc1c9f5774cae8e84a7','0','0',7,'katrina.jacobs@sunlinc.net','Katrina','Jacobs',NULL,'','','2016-11-09 11:54:38','2017-06-30 12:23:10','10.114.35.64','',1,'y','2017-06-28 05:06:21',9),
(21,'lekeisha.straker@stjamesgroup.com','57e360ac5847d0e8ed3f6073014b816b','0','0',9,'lekeisha.straker@stjamesgroup.com','Lekeisha','Straker',NULL,'','','2017-05-25 12:08:20','2017-06-29 11:51:58','10.114.35.100','',0,'y','2017-06-28 04:06:44',9),
(22,'javier.camacho','ba52580ada4193d264a7599988b24911','0','0',9,'javier.camacho@sunlinc.net','Javier','Camacho',NULL,'','','2017-06-05 12:21:18','2017-06-05 12:23:13','10.114.33.3','',1,'y','0000-00-00 00:00:00',0),
(23,'haideritx','21232f297a57a5a743894a0e4a801fc3','0','0',9,'haideritx@gmail.com','Haider','Hassan','pakistan','sss1.jpg','','2017-06-06 01:06:07','0001-11-30 12:11:00',NULL,'Temporary User. \r\nWill remove this user when this application work has been finished.\r\n\r\nCreated this user for testing purposes',1,'y','2017-06-12 07:06:29',19),
(29,'heather.holmes@stjamesgroup.com','384fbe2d03c6ca33b117f4508405997a','0','0',9,'heather.holmes@stjamesgroup.com','Heather','Holmes',NULL,'','','2017-06-28 17:02:21','2017-06-29 09:35:25','10.114.35.34','',1,'y','0000-00-00 00:00:00',0),
(30,'earl.forde@stjamesgroup.com','8d4f9c0baa6f752608fc95c8baaa3f91','0','0',9,'earl.forde@stjamesgroup.com','Earl','Forde',NULL,'','','2017-06-28 17:02:49','0000-00-00 00:00:00',NULL,'',1,'y','0000-00-00 00:00:00',0),
(31,'user@yopmail.com','e10adc3949ba59abbe56e057f20f883e','0','0',1,'user@yopmail.com','Test','User','Pk','','','2017-07-11 01:30:14','2017-07-11 17:34:34','::1','Just testing user roles',0,'y','0000-00-00 00:00:00',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
