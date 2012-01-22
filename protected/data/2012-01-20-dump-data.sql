/*
SQLyog Ultimate v8.6 Beta2
MySQL - 5.1.40-community : Database - ziedi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `categories` */

insert  into `categories`(`id`,`parent_id`,`active`,`gift`,`postcard`,`sort`,`slug`,`image`,`created`) values (1,0,1,0,0,1,'categories',NULL,'2012-01-12 22:30:21'),(2,1,1,0,0,1,'special-offer',NULL,'2012-01-12 22:30:22'),(3,1,1,0,0,2,'bouquets',NULL,'2012-01-12 22:30:22'),(4,1,1,0,0,3,'roses',NULL,'2012-01-12 22:30:23'),(5,1,1,0,0,4,'surprises',NULL,'2012-01-12 22:30:23'),(6,1,1,0,0,5,'for-men',NULL,'2012-01-12 22:30:24'),(7,1,1,0,0,6,'for-women',NULL,'2012-01-12 22:30:25'),(8,3,1,0,0,1,'bouquets/milakai','','2012-01-14 11:46:53'),(9,1,1,1,0,8,'gifts',NULL,'2012-01-14 14:05:27'),(10,1,1,0,1,7,'postcards',NULL,'2012-01-14 14:08:34'),(11,9,1,0,0,2,'gifts/toys',NULL,'2012-01-14 14:09:03'),(12,9,1,0,0,3,'gifts/scarves',NULL,'2012-01-14 14:09:30'),(13,9,1,0,0,4,'gifts/jewelry',NULL,'2012-01-14 14:09:57'),(14,9,1,0,0,5,'gifts/candy',NULL,'2012-01-14 14:10:50'),(15,10,1,0,0,1,'postcards/milakai',NULL,'2012-01-17 23:05:30'),(16,10,1,0,0,2,'postcards/mamai',NULL,'2012-01-17 23:07:00');

/*Data for the table `contents` */

insert  into `contents`(`id`,`module`,`module_id`,`language`,`title`,`body`,`additional`,`meta_title`,`meta_description`,`meta_keywords`,`background`,`created`) values (1,'category',2,'lv','Īpašie piedāvajumi',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:44:45'),(2,'category',3,'lv','Pušķi',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:44:57'),(3,'category',4,'lv','Rozes',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:45:08'),(4,'category',5,'lv','Pārsteigums','<p>Initial content</p>',NULL,'','','',NULL,'2012-01-10 21:45:22'),(5,'category',6,'lv','Puikam',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:45:31'),(6,'category',7,'lv','Mīļotai',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:45:40'),(7,'page',2,'lv','Par mums',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:46:33'),(8,'page',3,'lv','Saites',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:46:43'),(9,'page',4,'lv','Piegādes noteikumi',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:46:53'),(10,'page',5,'lv','Apmaksa',NULL,NULL,NULL,NULL,NULL,NULL,'2012-01-10 21:47:02'),(13,'block',1,'lv','Augšējais baneris ','<p><img src=\"/images/blocks/block31326229898-3-2.jpg\" width=\"900\" height=\"151\"></p>',NULL,NULL,NULL,NULL,NULL,'2012-01-10 23:11:38'),(14,'block',2,'lv','Labais baneris','<div class=\"r-banner\"><img src=\"/images/ban1.jpg\" /></div>\r\n<div class=\"r-banner\"><img src=\"/images/ban2.jpg\" /></div>',NULL,NULL,NULL,NULL,NULL,'2012-01-11 22:18:07'),(15,'product',1,'lv','Pušķis mīļakai, P042','<p>Sastāvs: puķes, rozes, lapas</p>',NULL,'Pušķis mīļakai, P042','','',NULL,'2012-01-12 22:37:44'),(16,'category',8,'lv','Mīļakai','<p>Initial content</p>',NULL,'','','',NULL,'2012-01-12 22:47:02'),(17,'category',9,'lv','Dāvanas','<p>Dāvanas</p>',NULL,'','','',NULL,'2012-01-14 14:05:27'),(18,'category',10,'lv','Pastkartes','<p>Pastkartes</p>',NULL,'','','',NULL,'2012-01-14 14:08:34'),(19,'category',11,'lv','Rotaļlietas','<p>Rotaļlietas</p>',NULL,'','','',NULL,'2012-01-14 14:09:03'),(20,'category',12,'lv','Šalles','<p>Šalles</p>',NULL,'','','',NULL,'2012-01-14 14:09:30'),(21,'category',13,'lv','Rotaslietas','<p>Rotaslietas</p>',NULL,'','','',NULL,'2012-01-14 14:09:57'),(22,'category',14,'lv','Konfektes','<p>Konfektes</p>',NULL,'','','',NULL,'2012-01-14 14:10:50'),(23,'product',2,'lv','Pastkarte, P241','<p>Pastakrte</p>',NULL,'','','',NULL,'2012-01-14 16:15:15'),(24,'product',3,'lv','\"Sarkanas rozes ar noformējumu\" P043','<p>Sarkanas rozes Grand Pri (9 gb.), zaļumi, organza, lente </p>',NULL,'','','pušķis sarkanas rozes',NULL,'2012-01-17 09:18:48'),(25,'product',4,'lv','Winter Bliss Lilies','With show-stopping beauty, our finest \r\npink, white and red Asiatic lilies, with multiple star-shaped blooms on \r\neach stem, make a perfectly passionate gift for the special people in \r\nyour life.',NULL,'','','',NULL,'2012-01-17 15:18:03'),(26,'category',10,'ru','Открытки','<p>Pastkartes</p>',NULL,'','','',NULL,'2012-01-14 12:08:34'),(27,'category',8,'ru','Для любимой','<p>Initial content</p>',NULL,'','','',NULL,'2012-01-12 20:47:02'),(28,'category',15,'lv','Mīļakai','<p>Mīļakai</p>',NULL,'','','',NULL,'2012-01-17 23:05:30'),(29,'category',16,'lv','Mamai','<p>Mamai</p>',NULL,'','','',NULL,'2012-01-17 23:07:00'),(30,'product',5,'lv','Rotaļlieta, R532','<p>Initial content</p>',NULL,'Rotaļlieta, R532','','',NULL,'2012-01-19 22:42:52');

/*Data for the table `pages` */

insert  into `pages`(`id`,`parent_id`,`active`,`sort`,`slug`,`plugin`,`deleted`,`created`) values (1,0,1,1,'pages','page',0,'2012-01-10 21:40:06'),(2,1,1,1,'about-us','page',0,'2012-01-10 21:40:36'),(3,1,1,2,'sites','page',0,'2012-01-10 21:40:44'),(4,1,1,3,'delivery','page',0,'2012-01-10 21:40:55'),(5,1,1,4,'payment','page',0,'2012-01-10 21:41:04');

/*Data for the table `product_category` */

insert  into `product_category`(`product_id`,`category_id`) values (2,15),(1,8),(3,8),(3,8),(3,8),(1,8),(4,8),(5,11);

/*Data for the table `product_nodes` */

insert  into `product_nodes`(`id`,`product_id`,`active`,`main`,`new`,`sale`,`preorder`,`notify`,`price`,`old_price`,`quantity`,`sort`,`color`,`size`,`weight`,`never_runs_out`,`deleted`,`created`) values (1,1,1,1,0,0,0,0,'30.00','0.00',3,1,NULL,'Liels (50x50x50 cm)','0.30',0,0,'2012-01-12 22:42:26'),(2,2,1,1,0,0,0,0,'2.00','0.00',3,1,NULL,'Liela (30x20 cm)','0.30',0,0,'2012-01-14 16:18:34'),(3,1,1,0,0,0,0,0,'60.00','0.00',0,2,NULL,'Loti liels (50x50x50 cm)','0.30',0,0,'2012-01-16 23:10:57'),(4,3,1,1,0,0,0,0,'55.30','0.00',0,1,NULL,'liels (50x50x50 cm.)','0.30',0,0,'2012-01-17 09:19:57'),(5,4,1,1,0,0,0,0,'20.00','0.00',0,3,NULL,'','0.30',0,0,'2012-01-17 15:18:26'),(6,5,1,1,0,0,0,0,'5.00','0.00',1,1,NULL,'','0.30',0,0,'2012-01-19 22:43:10');

/*Data for the table `products` */

insert  into `products`(`id`,`active`,`sort`,`slug`,`deleted`,`created`) values (1,1,1,'puskis-milakais-p042',0,'2012-01-12 22:37:44'),(2,1,1,'pastkarte-p241',0,'2012-01-14 16:15:15'),(3,1,2,'puskis-sarkanas-rozes',0,'2012-01-17 09:18:48'),(4,1,3,'lilies',0,'2012-01-17 15:18:03'),(5,1,1,'rotallieta-r532',0,'2012-01-19 22:42:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
