-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cpsu
CREATE DATABASE IF NOT EXISTS `cpsu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cpsu`;

-- Dumping structure for table cpsu.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` varchar(11) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `file_extension` varchar(5) DEFAULT NULL,
  `file_purpose` varchar(11) NOT NULL,
  `file_rev` varchar(10) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.files: ~1 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table cpsu.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `type`) VALUES
	(0000000001, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1),
	(0000000002, 'xiari', '21232f297a57a5a743894a0e4a801fc3', 'Xiari Ann Iligan', 2),
	(0000000004, 'uno', 'f13d6cafac96af5134839c0385d051bc', 'Ruben Lladoc', 0),
	(0000000006, 'jam', '21232f297a57a5a743894a0e4a801fc3', 'Jose Maningo', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
