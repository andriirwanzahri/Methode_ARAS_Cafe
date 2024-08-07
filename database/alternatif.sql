-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk sr_cafe
CREATE DATABASE IF NOT EXISTS `sr_cafe` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sr_cafe`;

-- membuang struktur untuk table sr_cafe.alternatif
CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int NOT NULL AUTO_INCREMENT,
  `cafe_id` int NOT NULL,
  `fasilitas` float NOT NULL,
  `menu_minuman` float NOT NULL,
  `menu_makanan` float NOT NULL,
  `suasana` float NOT NULL,
  `lokasi` float NOT NULL,
  `harga_minuman` float NOT NULL,
  `harga_makanan` float NOT NULL,
  PRIMARY KEY (`id_alternatif`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.alternatif: ~5 rows (lebih kurang)
INSERT INTO `alternatif` (`id_alternatif`, `cafe_id`, `fasilitas`, `menu_minuman`, `menu_makanan`, `suasana`, `lokasi`, `harga_minuman`, `harga_makanan`) VALUES
	(1, 1, 50, 100, 70, 70, 70, 70, 70),
	(2, 2, 20, 70, 50, 70, 50, 20, 70),
	(3, 3, 70, 50, 50, 50, 50, 20, 50),
	(4, 4, 50, 20, 100, 50, 70, 50, 50),
	(5, 5, 100, 100, 20, 70, 70, 50, 20);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
