-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5145
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cpsu
CREATE DATABASE IF NOT EXISTS `cpsu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cpsu`;

-- Dumping structure for table cpsu.campuses
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `campus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.campuses: ~0 rows (approximately)
/*!40000 ALTER TABLE `campuses` DISABLE KEYS */;
INSERT INTO `campuses` (`id`, `campus`) VALUES
	(01, 'Main');
/*!40000 ALTER TABLE `campuses` ENABLE KEYS */;

-- Dumping structure for table cpsu.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` varchar(11) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_extension` varchar(5) DEFAULT NULL,
  `file_purpose` varchar(13) DEFAULT NULL,
  `file_rev` varchar(10) DEFAULT NULL,
  `uploader` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) DEFAULT 'ALL',
  `datetime` datetime NOT NULL,
  `downloads` int(4) NOT NULL,
  `archive` int(1) DEFAULT NULL,
  `archived_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table cpsu.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.logs: ~27 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Dumping structure for table cpsu.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `campus` int(2) unsigned zerofill NOT NULL,
  `office` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.offices: ~2 rows (approximately)
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `campus`, `office`) VALUES
	(1, 01, 'College  of Computer Studies'),
	(2, 01, 'College of Engineering');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;

-- Dumping structure for table cpsu.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `campus` int(2) DEFAULT NULL,
  `office` int(2) DEFAULT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `campus`, `office`, `type`) VALUES
	(0000000001, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 0, 0, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
