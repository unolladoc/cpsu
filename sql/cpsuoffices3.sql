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
  `o_group` int(2) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.offices: ~102 rows (approximately)
DELETE FROM `offices`;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `campus`, `office`, `o_group`) VALUES
	(1000, 01, 'President\'s Office', NULL),
	(1001, 01, 'College of Agriculture', NULL),
	(1002, 01, 'College of Animal Science', NULL),
	(1003, 01, 'College of Arts and Sciences', NULL),
	(1004, 01, 'College of Business Education', NULL),
	(1005, 01, 'College of Computer Studies', NULL),
	(1006, 01, 'College of Criminal Justice Education', NULL),
	(1007, 01, 'College of Engineering', NULL),
	(1008, 01, 'College of Forestry', NULL),
	(1009, 01, 'College of Teacher Education', NULL),
	(1011, 01, 'Dean College of Agriculture', 04),
	(1012, 01, 'Dean College of Animal Science', 04),
	(1013, 01, 'Dean College of Arts and Sciences', 04),
	(1014, 01, 'Dean College of Business Education', 04),
	(1015, 01, 'Dean College of Computer Studies', 04),
	(1016, 01, 'Dean College of Criminal Justice Education', 04),
	(1017, 01, 'Dean College of Engineering', 04),
	(1018, 01, 'Dean College of Forestry', 04),
	(1019, 01, 'Dean College of Teacher Education', 04),
	(1100, 01, 'Record\'s Office', 10),
	(1101, 01, 'Council Secretary Office', NULL),
	(1102, 01, 'VP for Academic Affairs Office', 02),
	(1103, 01, 'VP for Administration and Finance / CAO Office', 02),
	(1104, 01, 'Planning Office', 05),
	(1105, 01, 'Building Construction Office', NULL),
	(1106, 01, 'Physical Plant and Facilities Office', 05),
	(1107, 01, 'Campus Site Development and Beautification Office', 00),
	(1108, 01, 'General Services Office', NULL),
	(1109, 01, 'Supply Office', NULL),
	(1110, 01, 'Registrar\'s Office', 06),
	(1111, 01, 'Environmental Services Office', 05),
	(1112, 01, 'Budget Office', NULL),
	(1113, 01, 'Accounting Office', 07),
	(1114, 01, 'Cashier\'s Office', 08),
	(1115, 01, 'Extension and Community Services Office', NULL),
	(1116, 01, 'Production Services', NULL),
	(1117, 01, 'National Service Training Program Office', 05),
	(1118, 01, 'Graduate School Office', NULL),
	(1119, 01, 'IMPDC Office', 05),
	(1120, 01, 'Review for Licensure Examination Office', 05),
	(1121, 01, 'Research and Development Services Office', 05),
	(1122, 01, 'Office of the Student Services and Affairs', NULL),
	(1123, 01, 'MIS Office', NULL),
	(1124, 01, 'Library', 09),
	(1125, 01, 'VP for Research and Extension', 02),
	(1126, 01, 'Quality Assurance', 05),
	(1127, 01, 'Gender and Development', 05),
	(1128, 01, 'Financial Management Services', 05),
	(2000, 02, 'Campus Director\'s Office', 03),
	(2100, 02, 'Record\'s Office', 10),
	(2110, 02, 'Registrar\'s Office', 06),
	(2113, 02, 'Accounting Office', 07),
	(2114, 02, 'Cashier\'s Office', 08),
	(2124, 02, 'Library', 09),
	(3000, 03, 'Campus Director\'s Office', 03),
	(3100, 03, 'Record\'s Office', 10),
	(3110, 03, 'Registrar\'s Office', 06),
	(3113, 03, 'Accounting Office', 07),
	(3114, 03, 'Cashier\'s Office', 08),
	(3124, 03, 'Library', 09),
	(4000, 04, 'Campus Director\'s Office', 03),
	(4100, 04, 'Record\'s Office', 10),
	(4110, 04, 'Registrar\'s Office', 06),
	(4113, 04, 'Accounting Office', 07),
	(4114, 04, 'Cashier\'s Office', 08),
	(4124, 04, 'Library', 09),
	(5000, 05, 'Campus Director\'s Office', 03),
	(5100, 05, 'Record\'s Office', 10),
	(5110, 05, 'Registrar\'s Office', 06),
	(5113, 05, 'Accounting Office', 07),
	(5114, 05, 'Cashier\'s Office', 08),
	(5124, 05, 'Library', 09),
	(6000, 06, 'Campus Director\'s Office', 03),
	(6100, 06, 'Record\'s Office', 10),
	(6110, 06, 'Registrar\'s Office', 06),
	(6113, 06, 'Accounting Office', 07),
	(6114, 06, 'Cashier\'s Office', 08),
	(6124, 06, 'Library', 09),
	(7000, 07, 'Campus Director\'s Office', 03),
	(7100, 07, 'Record\'s Office', 10),
	(7110, 07, 'Registrar\'s Office', 06),
	(7113, 07, 'Accounting Office', 07),
	(7114, 07, 'Cashier\'s Office', 08),
	(7124, 07, 'Library', 09),
	(8000, 08, 'Campus Director\'s Office', 03),
	(8100, 08, 'Record\'s Office', 10),
	(8110, 08, 'Registrar\'s Office', 06),
	(8113, 08, 'Accounting Office', 07),
	(8114, 08, 'Cashier\'s Office', 08),
	(8124, 08, 'Library', 09),
	(9000, 09, 'Campus Director\'s Office', 03),
	(9100, 09, 'Record\'s Office', 10),
	(9110, 09, 'Registrar\'s Office', 06),
	(9113, 09, 'Accounting Office', 07),
	(9114, 09, 'Cashier\'s Office', 08),
	(9124, 09, 'Library', 09),
	(10000, 10, 'Campus Director\'s Office', 03),
	(10100, 10, 'Record\'s Office', 10),
	(10110, 10, 'Registrar\'s Office', 06),
	(10113, 10, 'Accounting Office', 07),
	(10114, 10, 'Cashier\'s Office', 08),
	(10124, 10, 'Library', 09);
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;

-- Dumping structure for table cpsu.offices_group
CREATE TABLE IF NOT EXISTS `offices_group` (
  `id` int(2) unsigned zerofill NOT NULL,
  `g_name` varchar(50) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cpsu.offices_group: ~10 rows (approximately)
DELETE FROM `offices_group`;
/*!40000 ALTER TABLE `offices_group` DISABLE KEYS */;
INSERT INTO `offices_group` (`id`, `g_name`) VALUES
	(01, 'campus'),
	(02, 'vice president'),
	(03, 'campus director'),
	(04, 'dean'),
	(05, 'directors'),
	(06, 'registrar'),
	(07, 'accounting'),
	(08, 'cashier'),
	(09, 'library'),
	(10, 'record');
/*!40000 ALTER TABLE `offices_group` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
