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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.campuses: ~3 rows (approximately)
DELETE FROM `campuses`;
/*!40000 ALTER TABLE `campuses` DISABLE KEYS */;
INSERT INTO `campuses` (`id`, `campus`) VALUES
	(01, 'Main'),
	(02, 'Cauayan'),
	(03, 'Candoni');
/*!40000 ALTER TABLE `campuses` ENABLE KEYS */;

-- Dumping structure for table cpsu.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` varchar(20) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_desc` text,
  `file_extension` varchar(5) DEFAULT NULL,
  `file_purpose` varchar(13) DEFAULT NULL,
  `file_rev` varchar(10) DEFAULT NULL,
  `uploader` int(10) unsigned zerofill NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` longtext,
  `inout` int(1) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `downloads` int(4) NOT NULL,
  `archive` int(1) DEFAULT NULL,
  `archived_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.files: ~3 rows (approximately)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`id`, `file_path`, `file_name`, `file_desc`, `file_extension`, `file_purpose`, `file_rev`, `uploader`, `origin`, `destination`, `inout`, `datetime`, `downloads`, `archive`, `archived_by`) VALUES
	('CPSU158101F3', 'files/1453807276978_INCOMING_1.jpg', '1453807276978_INCOMING_1.jpg', ' asdsada', 'JPG', 'Letter', '1', 0000000002, '1001', '["1000","1100"]', 1, '2019-05-28 14:09:36', 1, 0, ''),
	('CPSU43791451', 'files/1453807276978_REVISION_1.jpg', '1453807276978_REVISION_1.jpg', 'asdasdasd', 'JPG', 'Letter', '1', 0000000001, '1100', '["0"]', 0, '2019-05-28 13:16:29', 0, 1, ''),
	('CPSU5870CDCA', 'files/1453807276978_REVISION_2.jpg', '1453807276978_REVISION_2.jpg', 'asdasdasd', 'JPG', 'Letter', '2', 0000000001, '1100', '["0"]', 0, '2019-05-28 13:23:11', 0, 0, 'CPSU43791451');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table cpsu.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.logs: ~0 rows (approximately)
DELETE FROM `logs`;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Dumping structure for table cpsu.m_typeofdoc
CREATE TABLE IF NOT EXISTS `m_typeofdoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.m_typeofdoc: ~8 rows (approximately)
DELETE FROM `m_typeofdoc`;
/*!40000 ALTER TABLE `m_typeofdoc` DISABLE KEYS */;
INSERT INTO `m_typeofdoc` (`id`, `type`) VALUES
	(1, 'Letter'),
	(2, 'Report'),
	(3, 'Memo'),
	(4, 'Proposal'),
	(5, 'Policies'),
	(6, 'Contracts'),
	(7, 'Forms'),
	(8, 'License'),
	(9, 'Certificate');
/*!40000 ALTER TABLE `m_typeofdoc` ENABLE KEYS */;

-- Dumping structure for table cpsu.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(4) NOT NULL,
  `campus` int(2) unsigned zerofill NOT NULL,
  `office` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.offices: ~11 rows (approximately)
DELETE FROM `offices`;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `campus`, `office`) VALUES
	(1000, 01, 'President\'s Office'),
	(1001, 01, 'College of Agriculture'),
	(1002, 01, 'College of Animal Science'),
	(1003, 01, 'College of Arts and Sciences'),
	(1004, 01, 'College of Business Education'),
	(1005, 01, 'College of Computer Studies'),
	(1006, 01, 'College of Criminal Justice Education'),
	(1007, 01, 'College of Engineering'),
	(1008, 01, 'College of Forestry'),
	(1009, 01, 'College of Teacher Education'),
	(1100, 01, 'Record\'s Office');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.user: ~3 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `campus`, `office`, `type`) VALUES
	(0000000001, 'admin@cpsu.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1, 1100, 1),
	(0000000002, 'xiari@cpsu.com', '21232f297a57a5a743894a0e4a801fc3', 'xiari', 1, 1001, 2),
	(0000000003, 'uno@cpsu.com', '21232f297a57a5a743894a0e4a801fc3', 'ben', 1, 1002, 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
