/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - zz_wescan_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zz_wescan_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `zz_wescan_db`;

/*Table structure for table `archived_encounter_logs` */

DROP TABLE IF EXISTS `archived_encounter_logs`;

CREATE TABLE `archived_encounter_logs` (
  `log_id` int(11) NOT NULL,
  `population_id` varchar(30) DEFAULT NULL,
  `contact_id` varchar(30) DEFAULT NULL,
  `date_contact` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `archived_encounter_logs` */

/*Table structure for table `archived_establishment_logs` */

DROP TABLE IF EXISTS `archived_establishment_logs`;

CREATE TABLE `archived_establishment_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `establishment_id` varchar(25) DEFAULT NULL,
  `population_id` varchar(25) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `archived_establishment_logs` */

insert  into `archived_establishment_logs`(`log_id`,`establishment_id`,`population_id`,`date_in`,`date_out`) values 
(4,'ESTBMNT20211031073328','INDVDL20211031163331','2021-02-12 12:00:01','2021-02-12 03:00:01'),
(5,'ESTBMNT20211031073329','INDVDL20211031163332','2021-02-12 12:00:01','2021-02-12 03:00:01'),
(6,'ESTBMNT20211031073326','INDVDLS20211216025014','2021-12-16 02:21:55','2021-12-16 02:22:13'),
(7,'ESTBMNT20211031073326','INDVDLS20211216025014','2021-12-16 02:26:22','2021-12-16 02:26:40'),
(8,'ESTBMNT20211031073326','INDVDLS20220119111406','2022-01-19 06:22:51','2022-01-19 06:23:32');

/*Table structure for table `archived_transportation_logs` */

DROP TABLE IF EXISTS `archived_transportation_logs`;

CREATE TABLE `archived_transportation_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `transportation_id` varchar(25) DEFAULT NULL,
  `population_id` varchar(25) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `archived_transportation_logs` */

/*Table structure for table `encounter_logs` */

DROP TABLE IF EXISTS `encounter_logs`;

CREATE TABLE `encounter_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `population_id` varchar(30) DEFAULT NULL,
  `contact_id` varchar(30) DEFAULT NULL,
  `date_contact` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `encounter_logs` */

insert  into `encounter_logs`(`log_id`,`population_id`,`contact_id`,`date_contact`) values 
(13,'INDVDLS20211031113259','INDVDLS20211031113259','2022-01-20 08:54:19'),
(14,'INDVDLS20211031113259','INDVDLS20211031113259','2022-01-20 08:56:21'),
(15,'INDVDLS20211031113259','INDVDLS20211031113259','2022-01-20 08:58:29'),
(16,'INDVDLS20211031113259','INDVDLS20211031113259','2022-01-20 08:59:06'),
(17,'INDVDLS20211031113259','INDVDLS20220119111349','2022-01-25 10:40:02'),
(18,'INDVDLS20211031113259','INDVDLS20220119111349','2022-01-25 10:40:08');

/*Table structure for table `establishment_logs` */

DROP TABLE IF EXISTS `establishment_logs`;

CREATE TABLE `establishment_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `establishment_id` varchar(25) DEFAULT NULL,
  `population_id` varchar(25) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

/*Data for the table `establishment_logs` */

insert  into `establishment_logs`(`log_id`,`establishment_id`,`population_id`,`date_in`,`date_out`) values 
(9,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:05:11','2022-01-25 10:05:46'),
(10,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:06:50','2022-01-25 10:07:13'),
(11,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:09:27','2022-01-25 10:09:28'),
(12,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:09:28','2022-01-25 10:09:40'),
(13,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:09:40','2022-01-25 10:15:45'),
(14,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:15:45','2022-01-25 10:15:46'),
(15,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:15:46','2022-01-25 10:15:50'),
(16,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:15:51','2022-01-25 10:15:51'),
(17,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:16','2022-01-25 10:16:17'),
(18,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:17','2022-01-25 10:16:17'),
(19,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:18','2022-01-25 10:16:18'),
(20,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:18','2022-01-25 10:16:18'),
(21,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:18','2022-01-25 10:16:19'),
(22,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:19','2022-01-25 10:16:19'),
(23,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:19','2022-01-25 10:16:19'),
(24,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:20','2022-01-25 10:16:20'),
(25,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:20','2022-01-25 10:16:20'),
(26,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:20','2022-01-25 10:16:20'),
(27,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:21','2022-01-25 10:16:21'),
(28,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:21','2022-01-25 10:16:21'),
(29,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:16:22','2022-01-25 10:16:22'),
(30,'ESTBMNT20211031073326','INDVDLS20211031113259','2022-01-25 10:19:17','2022-01-25 10:19:22');

/*Table structure for table `establishments` */

DROP TABLE IF EXISTS `establishments`;

CREATE TABLE `establishments` (
  `establishment_id` varchar(25) NOT NULL,
  `name` varbinary(50) NOT NULL,
  `business_permit_no` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`establishment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `establishments` */

insert  into `establishments`(`establishment_id`,`name`,`business_permit_no`,`address`) values 
('ESTBMNT20211031073326','Prince Hypermart','10283-203-293','Tangub City');

/*Table structure for table `population` */

DROP TABLE IF EXISTS `population`;

CREATE TABLE `population` (
  `population_id` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(15) DEFAULT NULL,
  `gender` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `primary_mobile_no` varchar(13) NOT NULL,
  `secondary_mobile_no` varchar(13) DEFAULT NULL,
  `email_address` varchar(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(70) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `remarks` varchar(50) DEFAULT 'Verified',
  PRIMARY KEY (`population_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `population` */

insert  into `population`(`population_id`,`firstname`,`middlename`,`lastname`,`suffix`,`gender`,`date_of_birth`,`primary_mobile_no`,`secondary_mobile_no`,`email_address`,`purok`,`barangay`,`username`,`password`,`latitude`,`longitude`,`remarks`) values 
('INDVDLS20211031113259','Richie','Soria','Mers','','Male','1988-06-11','09075555755','09972348524','richiemers@gmail.com','Tugas','Maquilao','user','user',8.096879,123.703058,'Verified'),
('INDVDLS20211031163329','John','sdfsd','Doe','sdfd','Male','2021-10-03','09081100110','456745674','','Purok 3','Santa Maria (Baga)','tourism','tourism',8.028879,123.786058,'Verified'),
('INDVDLS20211031163330','Mark','tyu','tyu',NULL,'','0000-00-00','5745674567','345634563','','2','Banglay','','',8.086879,123.756058,'Verified'),
('INDVDLS20211031163331','Karen','tyu','tyu',NULL,'','0000-00-00','45674567','734563456','','NEW BASAK','Barangay II - Marilou Annex (Poblacion)','','',8.034879,123.716058,'Verified'),
('INDVDLS20211031163332','Tommy','ghj','tyu',NULL,'','0000-00-00','456745674567','345634563456','','','','','',8.076879,123.736058,'Verified'),
('INDVDLS20211216025014','Elbert','Dompales','Estrosas','','Male','2009-03-07','09075555758','','','Purok 4','Labuyo','elel','123456',0,0,'Verified'),
('INDVDLS20220117024302','James','Carlotoy','Uncle','','Male','2004-12-04','09084444777','','','Purok 2','Silanga','aa','123456',0,0,'Verified'),
('INDVDLS20220119111349','Jacqueline','Tulo','Alcala',' ','Female','2000-01-02','09505663902','','Jacquelinealcala07@gmail.com','Purok2','Silanga','Jjjkie','qwerty12',0,0,'Verified'),
('INDVDLS20220119111406','Vivien','Asidre','Mondong','','Female','2022-01-19','09679313855','','vvmondong@yahoo.com','1','Silanga','Vivi','12345678',8.065988,123.773258,'Verified'),
('INDVDLS20220119113203','Wowie','','Tabalba','','Male','2022-01-19','09639352197','','','1','Silanga','Wowie','tabalba',0,0,'Verified');

/*Table structure for table `positive_incidences` */

DROP TABLE IF EXISTS `positive_incidences`;

CREATE TABLE `positive_incidences` (
  `positive_id` int(11) NOT NULL AUTO_INCREMENT,
  `population_id` varchar(45) DEFAULT NULL,
  `date_tested_positive` date DEFAULT NULL,
  `date_begin_tracing` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `trace_result` longtext DEFAULT NULL,
  `trace_compute_date` datetime DEFAULT NULL,
  PRIMARY KEY (`positive_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `positive_incidences` */

insert  into `positive_incidences`(`positive_id`,`population_id`,`date_tested_positive`,`date_begin_tracing`,`status`,`details`,`trace_result`,`trace_compute_date`) values 
(1,'INDVDL20211031113259','2021-01-12','2020-12-28',NULL,NULL,NULL,NULL),
(2,'','0000-00-00',NULL,NULL,NULL,NULL,NULL),
(3,'','0000-00-00',NULL,NULL,NULL,NULL,NULL),
(4,'','2021-11-12',NULL,NULL,NULL,NULL,NULL),
(5,'','2021-11-12',NULL,NULL,NULL,NULL,NULL),
(6,'','2021-11-06',NULL,NULL,NULL,NULL,NULL),
(7,'INDVDL20211031163331','2021-11-15',NULL,'deceased','d',NULL,NULL),
(8,'INDVDL20211031163332','2021-11-15',NULL,'recovered','hghjghjghj',NULL,NULL),
(9,'INDVDL20211031163330','2021-11-21',NULL,'recovered','oooooo',NULL,NULL),
(10,'INDVDL20211031163329','2021-11-27',NULL,NULL,NULL,NULL,NULL),
(11,'INDVDLS20220119111406','2022-01-19',NULL,'recovered','Uli na',NULL,NULL);

/*Table structure for table `transportation` */

DROP TABLE IF EXISTS `transportation`;

CREATE TABLE `transportation` (
  `transportation_id` varchar(25) NOT NULL,
  `plate_no` varchar(15) NOT NULL,
  `name_of_driver` varchar(50) NOT NULL,
  `address_of_driver` varchar(100) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  PRIMARY KEY (`transportation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transportation` */

insert  into `transportation`(`transportation_id`,`plate_no`,`name_of_driver`,`address_of_driver`,`vehicle`) values 
('TRANSPO20211031093028','12345','Bane','Maquilao, Tangub City','Single Seater Tricycle');

/*Table structure for table `transportation_logs` */

DROP TABLE IF EXISTS `transportation_logs`;

CREATE TABLE `transportation_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `transportation_id` varchar(25) DEFAULT NULL,
  `population_id` varchar(25) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transportation_logs` */

insert  into `transportation_logs`(`log_id`,`transportation_id`,`population_id`,`date_in`,`date_out`) values 
(1,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-20 08:46:49','2022-01-20 08:47:06'),
(2,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-20 08:48:19','2022-01-20 08:48:42'),
(3,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-20 08:49:04','2022-01-20 08:49:58'),
(4,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-20 08:52:50','2022-01-20 08:53:26'),
(5,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-20 08:53:58','2022-01-25 10:19:49'),
(6,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-25 10:19:53','2022-01-25 10:20:00'),
(7,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-25 10:38:25','2022-01-25 10:38:31'),
(8,'TRANSPO20211031093028','INDVDLS20211031113259','2022-01-25 10:39:26','2022-01-25 10:39:34');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(70) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `token` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6757535 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`,`account_name`,`user_type`,`token`) values 
(3453234,'cmo','cmo','CM Office','CMO','yTT35aANA0YuBmcnwTy6uZkqU'),
(6757533,'tourism','tourism','Tourism Office','Tourism','zWM35aANA0YuBmcnwTy6uZkqU');

/*Table structure for table `vw_positive_incidences` */

DROP TABLE IF EXISTS `vw_positive_incidences`;

/*!50001 DROP VIEW IF EXISTS `vw_positive_incidences` */;
/*!50001 DROP TABLE IF EXISTS `vw_positive_incidences` */;

/*!50001 CREATE TABLE  `vw_positive_incidences`(
 `population_id` varchar(25) ,
 `positive_id` int(11) ,
 `date_tested_positive` date ,
 `date_begin_tracing` date ,
 `status` varchar(45) ,
 `details` varchar(100) ,
 `trace_result` longtext ,
 `trace_compute_date` datetime ,
 `firstname` varchar(50) ,
 `middlename` varchar(50) ,
 `lastname` varchar(50) ,
 `suffix` varchar(15) ,
 `gender` varchar(15) ,
 `date_of_birth` date ,
 `primary_mobile_no` varchar(13) ,
 `secondary_mobile_no` varchar(13) ,
 `email_address` varchar(50) ,
 `purok` varchar(50) ,
 `barangay` varchar(50) ,
 `username` varchar(25) ,
 `password` varchar(70) ,
 `latitude` double ,
 `longitude` double 
)*/;

/*View structure for view vw_positive_incidences */

/*!50001 DROP TABLE IF EXISTS `vw_positive_incidences` */;
/*!50001 DROP VIEW IF EXISTS `vw_positive_incidences` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_positive_incidences` AS select `population`.`population_id` AS `population_id`,`positive_incidences`.`positive_id` AS `positive_id`,`positive_incidences`.`date_tested_positive` AS `date_tested_positive`,`positive_incidences`.`date_begin_tracing` AS `date_begin_tracing`,`positive_incidences`.`status` AS `status`,`positive_incidences`.`details` AS `details`,`positive_incidences`.`trace_result` AS `trace_result`,`positive_incidences`.`trace_compute_date` AS `trace_compute_date`,`population`.`firstname` AS `firstname`,`population`.`middlename` AS `middlename`,`population`.`lastname` AS `lastname`,`population`.`suffix` AS `suffix`,`population`.`gender` AS `gender`,`population`.`date_of_birth` AS `date_of_birth`,`population`.`primary_mobile_no` AS `primary_mobile_no`,`population`.`secondary_mobile_no` AS `secondary_mobile_no`,`population`.`email_address` AS `email_address`,`population`.`purok` AS `purok`,`population`.`barangay` AS `barangay`,`population`.`username` AS `username`,`population`.`password` AS `password`,`population`.`latitude` AS `latitude`,`population`.`longitude` AS `longitude` from (`positive_incidences` join `population`) where `positive_incidences`.`population_id` = `population`.`population_id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
