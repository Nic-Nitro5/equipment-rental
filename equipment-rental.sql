/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.20-MariaDB : Database - equipment-rental
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`equipment-rental` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `equipment-rental`;

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(256) DEFAULT NULL,
  `category` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(256) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `bin_number` varchar(256) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `items` */

insert  into `items`(`id`,`item_code`,`category`,`description`,`size`,`color`,`bin_number`,`created`) values (2,'A1','Tents','Nylon tent','12x12','Red','AB123','2021-11-02 14:38:02'),(3,'AS1234','Boards','Wooden Board','56x78','Blue','ASD987','2021-11-02 14:38:38'),(8,'AS1234','Boards','Granular','0987m','Green','op98698zzz','2021-11-02 16:13:42'),(9,'LK976','Sand','Granular','0987mzzz','Green','sdfbsdfb','2021-11-02 16:13:55'),(10,'LK976zzz','Boards','sfbsdfb','0987m','Blue','ASD987','2021-11-02 16:14:08');

/*Table structure for table `ordered_items` */

DROP TABLE IF EXISTS `ordered_items`;

CREATE TABLE `ordered_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ordered` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ordered_items` */

insert  into `ordered_items`(`id`,`item_id`,`user_id`,`ordered`) values (1,2,21,'2021-11-02 16:05:37'),(2,3,21,'2021-11-02 16:11:39'),(3,2,20,'2021-11-02 16:14:18');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text DEFAULT NULL,
  `id_number` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`id_number`,`email`,`password`,`admin`,`created`) values (20,'Myuser','123456','jarednaidoo6@gmail.com','$2y$10$J7HDhvQVb4PNBnVsr0JfruVTHGQKpiamvSRa4a.VhXeLeoRtoI42y',1,'2021-11-02 15:49:51'),(21,'Nic','165529','user@gmail.com','$2y$10$xkH9U3IE12BD/vTrkHKkkeRZ6iMjCr51PRIOVpUGbiK.xdwua2NeK',0,'2021-11-02 16:33:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
