/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.20 : Database - db_potensidesa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_potensidesa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_potensidesa`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(190) DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `nama` varchar(255) DEFAULT NULL,
  `profile_pic` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id`,`username`,`password`,`nama`,`profile_pic`,`created_at`,`updated_at`) values 
(1,'admin','$2y$10$JFCVgdoUZGvYB.wHuuvSH.hAgChNNvL4BhbvsH9op98DZEoDrMk1u','Wayan Wahyu','1618519185_4x6.jpg',NULL,NULL);

/*Table structure for table `tb_desa` */

DROP TABLE IF EXISTS `tb_desa`;

CREATE TABLE `tb_desa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int DEFAULT NULL,
  `nama_desa` varchar(190) DEFAULT NULL,
  `keterangan` text,
  `batas_desa` text,
  `warna_batas` varchar(190) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kecamatan` (`id_kecamatan`),
  CONSTRAINT `tb_desa_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_kecamatan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_desa` */

insert  into `tb_desa`(`id`,`id_kecamatan`,`nama_desa`,`keterangan`,`batas_desa`,`warna_batas`,`created_at`,`updated_at`) values 
(18,1,'Desa Bunga Indah','cc','[{\"lat\":-8.665542184575388,\"lng\":115.25477886199953},{\"lat\":-8.663675460066036,\"lng\":115.24306297302248},{\"lat\":-8.665542184575388,\"lng\":115.23181915283205},{\"lat\":-8.671312001720812,\"lng\":115.22546768188478},{\"lat\":-8.683954379404875,\"lng\":115.22538185119629},{\"lat\":-8.700329443241856,\"lng\":115.22787094116212},{\"lat\":-8.703638307031172,\"lng\":115.23387908935548},{\"lat\":-8.70389283380344,\"lng\":115.25413513183595},{\"lat\":-8.703638307031172,\"lng\":115.25774002075197},{\"lat\":-8.701856614778896,\"lng\":115.25851249694824},{\"lat\":-8.69617211139091,\"lng\":115.25825500488283},{\"lat\":-8.686669465365787,\"lng\":115.25816917419434},{\"lat\":-8.681621086706773,\"lng\":115.25902748107912},{\"lat\":-8.678269604536,\"lng\":115.25829792022706},{\"lat\":-8.67428172600723,\"lng\":115.25932788848878}]','#0080ff','2021-05-18 10:32:25','2021-05-21 08:35:45'),
(19,1,'Desa Bunga Mawar','asdas','[{\"lat\":-8.633037229811814,\"lng\":115.1924634019148},{\"lat\":-8.653402654137507,\"lng\":115.18697293703111},{\"lat\":-8.654081482656935,\"lng\":115.20378748573731}]','#00ffff','2021-05-18 10:33:57','2021-05-21 08:31:12'),
(22,3,'Desa Mawar Melati','wow','[{\"lat\":-8.598438946157545,\"lng\":115.23375034332275},{\"lat\":-8.59852381213862,\"lng\":115.23186206817628},{\"lat\":-8.598438946157545,\"lng\":115.23057460784914},{\"lat\":-8.59852381213862,\"lng\":115.2299737930298},{\"lat\":-8.60115464812334,\"lng\":115.23023128509523},{\"lat\":-8.600475724456906,\"lng\":115.22628307342531},{\"lat\":-8.602257896485957,\"lng\":115.22551059722902},{\"lat\":-8.603785465836499,\"lng\":115.22542476654054},{\"lat\":-8.604803841980223,\"lng\":115.22542476654054},{\"lat\":-8.606840586050339,\"lng\":115.2255964279175},{\"lat\":-8.607943817846223,\"lng\":115.22602558135988},{\"lat\":-8.610914041312402,\"lng\":115.22628307342531},{\"lat\":-8.613884241461923,\"lng\":115.22645473480226},{\"lat\":-8.61770303595187,\"lng\":115.2270555496216},{\"lat\":-8.621691513458156,\"lng\":115.22894382476808},{\"lat\":-8.622540120262896,\"lng\":115.2296304702759},{\"lat\":-8.62296442295057,\"lng\":115.23048877716066},{\"lat\":-8.623643306259734,\"lng\":115.23160457611085},{\"lat\":-8.623558445912808,\"lng\":115.23392200469972},{\"lat\":-8.623643306259734,\"lng\":115.23769855499269},{\"lat\":-8.623728166587613,\"lng\":115.24018764495851},{\"lat\":-8.623728166587613,\"lng\":115.24121761322023},{\"lat\":-8.617872759256256,\"lng\":115.24070262908936},{\"lat\":-8.610914041312402,\"lng\":115.24001598358154},{\"lat\":-8.606670857796347,\"lng\":115.23632526397706},{\"lat\":-8.603785465836499,\"lng\":115.23452281951906},{\"lat\":-8.60115464812334,\"lng\":115.23392200469972}]','#9292ed','2021-05-18 18:46:10','2021-05-21 08:32:11'),
(23,3,'Desa Melati Putih','dvsdvs','[{\"lat\":-8.544365559108776,\"lng\":115.21424531936647},{\"lat\":-8.546317749571685,\"lng\":115.21544694900514},{\"lat\":-8.547208963633814,\"lng\":115.21647691726686},{\"lat\":-8.548142614226185,\"lng\":115.21806478500368},{\"lat\":-8.54848212296553,\"lng\":115.21909475326538},{\"lat\":-8.548651877221815,\"lng\":115.22003889083864},{\"lat\":-8.548821631402479,\"lng\":115.2203392982483},{\"lat\":-8.550604045734696,\"lng\":115.2199959754944},{\"lat\":-8.553277651600704,\"lng\":115.21943807601929},{\"lat\":-8.554805417957066,\"lng\":115.21905183792116},{\"lat\":-8.556672679626036,\"lng\":115.21862268447877},{\"lat\":-8.558242869851615,\"lng\":115.21849393844606},{\"lat\":-8.55989792821425,\"lng\":115.21892309188844},{\"lat\":-8.561224798694155,\"lng\":115.21971702575685},{\"lat\":-8.561818918382558,\"lng\":115.22027492523195},{\"lat\":-8.563240558157489,\"lng\":115.22087574005128},{\"lat\":-8.56461975584813,\"lng\":115.22072553634645},{\"lat\":-8.566423314514562,\"lng\":115.22036075592042},{\"lat\":-8.565829202015982,\"lng\":115.21789312362672},{\"lat\":-8.565298743643845,\"lng\":115.21639108657838},{\"lat\":-8.562137196405528,\"lng\":115.21761417388917},{\"lat\":-8.562222070500018,\"lng\":115.21714210510255},{\"lat\":-8.562264507540178,\"lng\":115.21682024002077},{\"lat\":-8.562031103760779,\"lng\":115.21634817123415},{\"lat\":-8.561818918382558,\"lng\":115.21596193313599},{\"lat\":-8.561086170806087,\"lng\":115.21557569503786},{\"lat\":-8.561213482292342,\"lng\":115.21471738815309},{\"lat\":-8.56091642209151,\"lng\":115.21381616592409},{\"lat\":-8.561001296458258,\"lng\":115.21342992782594},{\"lat\":-8.561255919444966,\"lng\":115.21325826644899},{\"lat\":-8.561637853605598,\"lng\":115.21330118179323},{\"lat\":-8.562019787382933,\"lng\":115.21364450454713},{\"lat\":-8.56214709855687,\"lng\":115.21364450454713},{\"lat\":-8.562274409688214,\"lng\":115.2135157585144},{\"lat\":-8.562396769704625,\"lng\":115.21352648735048},{\"lat\":-8.562964718019423,\"lng\":115.21396636962892},{\"lat\":-8.564667143663716,\"lng\":115.21352648735048},{\"lat\":-8.564200338909354,\"lng\":115.21204590797426},{\"lat\":-8.562995838627947,\"lng\":115.20772218704225},{\"lat\":-8.561934913243316,\"lng\":115.20686388015747},{\"lat\":-8.560067677383048,\"lng\":115.20729303359987},{\"lat\":-8.557903369810973,\"lng\":115.20840883255006},{\"lat\":-8.556163427351548,\"lng\":115.20931005477905},{\"lat\":-8.555611736619047,\"lng\":115.20999670028687},{\"lat\":-8.554381039028279,\"lng\":115.21025419235231},{\"lat\":-8.554381039028279,\"lng\":115.21085500717165},{\"lat\":-8.549161139537008,\"lng\":115.21227121353151}]','#0080c0','2021-05-21 08:16:54','2021-05-21 08:33:09');

/*Table structure for table `tb_jenis_potensi` */

DROP TABLE IF EXISTS `tb_jenis_potensi`;

CREATE TABLE `tb_jenis_potensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_potensi` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `tablelink` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_jenis_potensi` */

insert  into `tb_jenis_potensi`(`id`,`nama_potensi`,`icon`,`tablelink`,`created_at`,`updated_at`) values 
(1,'Sekolah','schools.png','tb_sekolah','2021-05-20 12:05:40',NULL),
(2,'Tempat Wisata','vacant-land.png','tb_tempat_wisata','2021-05-20 12:05:43',NULL),
(3,'Tempat Ibadah','religious-organizations.png','tb_tempat_ibadah','2021-05-20 12:05:46',NULL),
(4,'Pasar','p','tb_pasar','2021-05-20 12:07:36',NULL);

/*Table structure for table `tb_kabupaten` */

DROP TABLE IF EXISTS `tb_kabupaten`;

CREATE TABLE `tb_kabupaten` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_kabupaten` */

insert  into `tb_kabupaten`(`id`,`nama_kabupaten`,`created_at`,`updated_at`) values 
(1,'Denpasar','2021-05-18 19:56:30','2021-05-18 19:56:40'),
(2,'Bangli','2021-05-18 19:56:32','2021-05-18 19:56:42'),
(3,'Gianyar','2021-05-18 19:56:34','2021-05-18 19:56:44'),
(4,'Singaraja','2021-05-18 19:56:36','2021-05-18 19:56:45'),
(5,'Karangasem','2021-05-18 19:56:38','2021-05-18 19:56:46');

/*Table structure for table `tb_kecamatan` */

DROP TABLE IF EXISTS `tb_kecamatan`;

CREATE TABLE `tb_kecamatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int DEFAULT NULL,
  `nama_kecamatan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kabupaten` (`id_kabupaten`),
  CONSTRAINT `tb_kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_kabupaten` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_kecamatan` */

insert  into `tb_kecamatan`(`id`,`id_kabupaten`,`nama_kecamatan`,`created_at`,`updated_at`) values 
(1,1,'Denpasar Timur','2021-05-18 20:06:27','2021-05-18 20:06:42'),
(2,1,'Denpasar Barat','2021-05-18 20:06:28','2021-05-18 20:06:40'),
(3,1,'Denpasar Utara','2021-05-18 20:06:30','2021-05-18 20:06:36'),
(4,1,'Denpasar Selatan','2021-05-18 20:06:31','2021-05-18 20:06:35');

/*Table structure for table `tb_pasar` */

DROP TABLE IF EXISTS `tb_pasar`;

CREATE TABLE `tb_pasar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_potensi` int DEFAULT NULL,
  `id_desa` int DEFAULT NULL,
  `nama_pasar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` text,
  `telepon` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_tempat_wisata_ibfk_1` (`id_potensi`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_pasar_ibfk_1` FOREIGN KEY (`id_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_pasar_ibfk_2` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_pasar` */

insert  into `tb_pasar`(`id`,`id_potensi`,`id_desa`,`nama_pasar`,`lat`,`lng`,`alamat`,`foto`,`telepon`,`keterangan`,`created_at`,`updated_at`) values 
(2,4,18,'saAS','-8.652385850209173','115.19319534301759','ASDASD','1621537379_unnamed.png','ASDSAD','ASDASD','2021-05-20 19:02:59','2021-05-20 19:02:59');

/*Table structure for table `tb_sekolah` */

DROP TABLE IF EXISTS `tb_sekolah`;

CREATE TABLE `tb_sekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_potensi` int DEFAULT NULL,
  `id_desa` int DEFAULT NULL,
  `jenis` enum('PAUD','TK','SD','SMP','SMA','Universitas') DEFAULT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  `foto` text,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_sekolah_ibfk_1` (`id_potensi`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_sekolah_ibfk_1` FOREIGN KEY (`id_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_sekolah_ibfk_3` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_sekolah` */

insert  into `tb_sekolah`(`id`,`id_potensi`,`id_desa`,`jenis`,`nama_sekolah`,`alamat`,`telepon`,`foto`,`lat`,`lng`,`keterangan`,`created_at`,`updated_at`) values 
(10,1,22,'Universitas','SDN','s','s','1621459726_pngegg(1).png','-8.619145841058987','115.23229508569607','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2021-05-19 21:28:46','2021-05-20 21:22:03'),
(11,1,22,'Universitas','ngik ngok','fhdfghrfh','088236109829','1621482673_pngegg(1).png','-8.615527242404916','115.23790771189347','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2021-05-20 03:51:13','2021-05-20 03:55:21');

/*Table structure for table `tb_tempat_ibadah` */

DROP TABLE IF EXISTS `tb_tempat_ibadah`;

CREATE TABLE `tb_tempat_ibadah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_potensi` int DEFAULT NULL,
  `id_desa` int DEFAULT NULL,
  `agama` enum('Islam','Hindu','Katolik','Kristen','Buddha','Konghuchu') DEFAULT NULL,
  `nama_tempat_ibadah` varchar(255) DEFAULT NULL,
  `alamat` text,
  `foto` text,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_tempat_ibadah_ibfk_1` (`id_potensi`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_tempat_ibadah_ibfk_1` FOREIGN KEY (`id_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_tempat_ibadah_ibfk_3` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_tempat_ibadah` */

insert  into `tb_tempat_ibadah`(`id`,`id_potensi`,`id_desa`,`agama`,`nama_tempat_ibadah`,`alamat`,`foto`,`lat`,`lng`,`keterangan`,`created_at`,`updated_at`) values 
(7,3,22,'Hindu','gdfgasdas','pasdas','1621505902_pngegg(1).png','-8.613407391508849','115.23296074041399','pasda','2021-05-20 10:18:22','2021-05-20 10:27:50'),
(8,3,22,'Hindu','ascc','asdas','1621556796_40.png','-8.64477840831303','115.19878134770096','asdsd','2021-05-21 00:26:36','2021-05-21 00:26:54');

/*Table structure for table `tb_tempat_wisata` */

DROP TABLE IF EXISTS `tb_tempat_wisata`;

CREATE TABLE `tb_tempat_wisata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_potensi` int DEFAULT NULL,
  `id_desa` int DEFAULT NULL,
  `nama_tempat_wisata` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` text,
  `telepon` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_tempat_wisata_ibfk_1` (`id_potensi`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_tempat_wisata_ibfk_1` FOREIGN KEY (`id_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_tempat_wisata_ibfk_3` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_tempat_wisata` */

insert  into `tb_tempat_wisata`(`id`,`id_potensi`,`id_desa`,`nama_tempat_wisata`,`lat`,`lng`,`alamat`,`foto`,`telepon`,`keterangan`,`created_at`,`updated_at`) values 
(5,2,22,'sAS','-8.610914041312402','115.24001598358154','AS','1621536423_unnamed.png','2354546','464DSDVCF','2021-05-20 18:47:03','2021-05-20 18:47:03'),
(6,2,22,'test','-8.610914041312402','115.24001598358154','test','1621841410_64.png','test','test','2021-05-24 07:30:10','2021-05-24 07:30:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
