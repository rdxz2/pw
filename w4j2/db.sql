/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 5.0.17-nt : Database - pw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pw` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pw`;

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) NOT NULL auto_increment,
  `nim` varchar(255) NOT NULL,
  `pwd` char(32) NOT NULL default '8542516f8870173d7d1daba1daaaf0a1',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `desc` varchar(255) default NULL,
  `addr` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`id`,`nim`,`pwd`,`fname`,`lname`,`desc`,`addr`) values 
(1,'00000010765','8542516f8870173d7d1daba1daaaf0a1','Richard','Dharmawan','desc1',NULL),
(2,'00000012234','8542516f8870173d7d1daba1daaaf0a1','aaa','bbb','descc',NULL),
(3,'124121234','8542516f8870173d7d1daba1daaaf0a1','zzzzzzzzzeeeeeeeeeeeeeeff2','bbbbbbbbbbbe21','ddddddddr1r122r12r1r21',NULL),
(5,'0000023323','8542516f8870173d7d1daba1daaaf0a1','ff1','ff2','ff3',NULL),
(6,'dd1','8542516f8870173d7d1daba1daaaf0a1','dd2','dd2vvw','dd3',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
