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

-- Dumping structure for table cpsu.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(5) NOT NULL,
  `campus` int(2) unsigned zerofill NOT NULL,
  `office` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.offices: ~9 rows (approximately)
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
	(1100, 01, 'Record\'s Office'),
	(1101, 01, 'Council Secretary Office'),
	(1102, 01, 'VP for Academic Affairs Office'),
	(1103, 01, 'VP for Administration and Finance / CAO Office'),
	(1104, 01, 'Planning Office'),
	(1105, 01, 'Building Construction Office'),
	(1106, 01, 'Physical Plant and Facilities Office'),
	(1107, 01, 'Campus Site Development and Beautification Office'),
	(1108, 01, 'General Services Office'),
	(1109, 01, 'Supply Office'),
	(1110, 01, 'Registrar\'s Office'),
	(1111, 01, 'Environmental Services Office'),
	(1112, 01, 'Budget Office'),
	(1113, 01, 'Accounting Office'),
	(1114, 01, 'Cashier\'s Office'),
	(1115, 01, 'Extension and Community Services Office'),
	(1116, 01, 'Production Services'),
	(1117, 01, 'National Service Training Program Office'),
	(1118, 01, 'Graduate School Office'),
	(1119, 01, 'IMPDC Office'),
	(1120, 01, 'Review for Licensure Examination Office'),
	(1121, 01, 'Research and Development Services Office'),
	(1122, 01, 'Office of the Student Services and Affairs'),
	(1123, 01, 'MIS Office'),
	(1124, 01, 'Library'),
	(2000, 02, 'OIC'),
	(3000, 03, 'OIC'),
	(4000, 04, 'OIC'),
	(5000, 05, 'OIC'),
	(6000, 06, 'OIC'),
	(7000, 07, 'OIC'),
	(8000, 08, 'OIC'),
	(9000, 09, 'OIC'),
	(10000, 10, 'OIC');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
