-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for chat
CREATE DATABASE IF NOT EXISTS `chat` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chat`;

-- Dumping structure for table chat.detalii
CREATE TABLE IF NOT EXISTS `detalii` (
  `id_detalii` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilizator` int(11) NOT NULL,
  `activitate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scrie` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id_detalii`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table chat.detalii: ~0 rows (approximately)
/*!40000 ALTER TABLE `detalii` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalii` ENABLE KEYS */;

-- Dumping structure for table chat.login
CREATE TABLE IF NOT EXISTS `login` (
  `id_utilizator` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) NOT NULL,
  `parola` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilizator`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table chat.login: ~5 rows (approximately)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`id_utilizator`, `nume`, `parola`) VALUES
	(2, 'buteanucosmin', 'cosmin'),
	(3, 'btn', '$2y$10$nwOb2SELqGSKtoUQNGu2lOOaMi9zUsCqMPyzQ7LHIFb'),
	(4, 'buteanucosmin1', '$2y$10$vRd0G/5Ot67FwGFVH4GOEOR5LQPFVujz.9/91nG6FPr'),
	(5, 'abc1', '$2y$10$oQEpDjSVfPhN0Vs0QYIBpeNBXY7QGYji1hAFVaXr22c'),
	(6, 'buteanu', 'cosmin'),
	(8, 'cosminescu', 'cosmin');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Dumping structure for table chat.mesaje
CREATE TABLE IF NOT EXISTS `mesaje` (
  `id_mesaje` int(11) NOT NULL AUTO_INCREMENT,
  `initiator` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `mesaje` text NOT NULL,
  `timp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_mesaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table chat.mesaje: ~0 rows (approximately)
/*!40000 ALTER TABLE `mesaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesaje` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
