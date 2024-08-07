-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sr_cafe
CREATE DATABASE IF NOT EXISTS `sr_cafe` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sr_cafe`;

-- Dumping structure for table sr_cafe.alternatif
CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_id` int(11) NOT NULL,
  `fasilitas` float NOT NULL,
  `menu_minuman` float NOT NULL,
  `menu_makanan` float NOT NULL,
  `suasana` float NOT NULL,
  `lokasi` float NOT NULL,
  `harga_minuman` float NOT NULL,
  `harga_makanan` float NOT NULL,
  PRIMARY KEY (`id_alternatif`) USING BTREE,
  KEY `cafe_id` (`cafe_id`),
  CONSTRAINT `cafe_id` FOREIGN KEY (`cafe_id`) REFERENCES `cafes` (`id_cafe`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.alternatif: ~22 rows (approximately)
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
REPLACE INTO `alternatif` (`id_alternatif`, `cafe_id`, `fasilitas`, `menu_minuman`, `menu_makanan`, `suasana`, `lokasi`, `harga_minuman`, `harga_makanan`) VALUES
	(1, 1, 0.5, 1, 0.9, 1, 1, 0.9, 0.9),
	(2, 2, 0.3, 0.9, 0.5, 0.9, 0.4, 1, 0.9),
	(3, 3, 0.8, 0.5, 0.5, 0.6, 0.5, 1, 0.5),
	(4, 4, 0.7, 0.3, 1, 0.5, 0.9, 0.6, 0.6),
	(5, 5, 1, 1, 0.3, 1, 1, 0.9, 1),
	(6, 6, 0.5, 0.8, 0.7, 1, 0.5, 0.9, 0.78),
	(7, 7, 1, 0.5, 0.7, 0.9, 0.6, 0.5, 0.56),
	(8, 8, 0.9, 0.5, 0.8, 1, 1, 1, 0.45),
	(9, 9, 0.4, 0.7, 0.6, 0.8, 1, 0.6, 0.87),
	(10, 10, 1, 0.8, 1, 0.7, 0.8, 0.9, 0.98),
	(11, 11, 0.7, 1, 0.7, 0.5, 0.9, 0.78, 0.5),
	(12, 12, 0.4, 0.9, 0.8, 0.7, 1, 0.6, 1),
	(13, 13, 0.25, 0.25, 0.5, 1, 0.8, 1, 0.76),
	(14, 14, 0.8, 0.1, 1, 0.7, 0.7, 1, 1),
	(15, 15, 1, 1, 0.7, 0.4, 0.9, 0.7, 0.9),
	(16, 16, 0.8, 0.6, 0.9, 1, 1, 0.56, 1),
	(17, 17, 0.4, 0.7, 1, 0.9, 0.8, 0.9, 0.6),
	(18, 18, 0.6, 0.4, 0.8, 0.7, 0.9, 0.7, 0.5),
	(19, 19, 0.7, 0.8, 0.6, 0.6, 1, 1, 0.6),
	(20, 20, 1, 0.5, 0.5, 0.7, 1, 1, 0.8),
	(21, 21, 1, 1, 0.9, 0.8, 0.5, 0.8, 1),
	(22, 22, 0.9, 1, 0.8, 0.8, 0.7, 0.88, 0.9);
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.cafes
CREATE TABLE IF NOT EXISTS `cafes` (
  `id_cafe` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cafe` varchar(100) DEFAULT NULL,
  `inisial_cafe` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id_cafe`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.cafes: ~22 rows (approximately)
/*!40000 ALTER TABLE `cafes` DISABLE KEYS */;
REPLACE INTO `cafes` (`id_cafe`, `nm_cafe`, `inisial_cafe`, `alamat`, `deskripsi`) VALUES
	(1, 'Sovt Kopi', 'A1', 'Jln Panglateh', 'Wifi, Ac, CCTV'),
	(2, 'The Breeze Coffe', 'A2', 'Jln Merdeka', 'WIFI, AC, CCTV, CERMIN'),
	(3, 'Platinum Coffe', 'A3', 'Jln Merdeka', 'WIFI'),
	(4, 'Station Coffe Premium', 'A4', 'Jln Merdeka', 'Wifi,AC'),
	(5, 'Kolega Coffe', 'A5', 'Jln Merdeka', 'Wifi,AC'),
	(6, 'Bara Coffe', 'A6', 'Jln Merdeka', 'Wifi,AC'),
	(7, 'Coffe Time', 'A7', 'Jln Merdeka', 'Wifi,AC'),
	(8, 'TR Coffe', 'A8', 'Jln Merdeka', 'Wifi,AC'),
	(9, 'Legend Coffe', 'A9', 'Jln Merdeka', 'Wifi,AC'),
	(10, 'Beeje Coffe', 'A10', 'Jln Merdeka', 'Wifi,AC'),
	(11, 'FN Coffe', 'A11', 'Jln Merdeka', 'Wifi,AC'),
	(12, 'Elzan Coffe', 'A12', 'Jln Merdeka', 'Wifi,AC'),
	(13, 'Tama Coffe', 'A13', 'Jln Merdeka', 'Wifi,AC'),
	(14, 'Mula Coffe', 'A14', 'Jln Merdeka', 'Wifi,AC'),
	(15, 'Bagi - Bagi Coffe & Pastry', 'A15', 'Jln Merdeka', 'Wifi,AC'),
	(16, 'DRoyal Coffe', 'A16', 'Jln Merdeka', 'Wifi,AC'),
	(17, 'Assembly Point', 'A17', 'Jln Merdeka', 'Wifi,AC'),
	(18, 'Central Coffe', 'A18', 'Jln Merdeka', 'Wifi,AC'),
	(19, 'DGround Coffe', 'A19', 'Jln Merdeka', 'Wifi,AC'),
	(20, 'Achek Coffe', 'A20', 'Jln Merdeka', 'Wifi,AC'),
	(21, 'Petro Dollar', 'A21', 'Jln Merdeka', 'Wifi,AC'),
	(22, 'CoffePedia', 'A22', 'Jln Merdeka', 'CCTV, WIFI, AC\r\n');
/*!40000 ALTER TABLE `cafes` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.hasil_alternatif
CREATE TABLE IF NOT EXISTS `hasil_alternatif` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_cafe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.hasil_alternatif: ~0 rows (approximately)
/*!40000 ALTER TABLE `hasil_alternatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `hasil_alternatif` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `jenis_bobot` enum('Benefit','Cost') DEFAULT NULL,
  `smbl_kriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.kriteria: ~7 rows (approximately)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
REPLACE INTO `kriteria` (`kriteria_id`, `nama_kriteria`, `bobot`, `jenis_bobot`, `smbl_kriteria`) VALUES
	(1, 'Fasilitas', 0.2, 'Benefit', 'K1'),
	(2, 'Menu Minuman', 0.2, 'Benefit', 'K2'),
	(3, 'Menu Makanan', 0.1, 'Benefit', 'K3'),
	(4, 'Suasana', 0.1, 'Benefit', 'K4'),
	(5, 'Lokasi', 0.1, 'Benefit', 'K5'),
	(6, 'Harga Minuman', 0.15, 'Cost', 'K6'),
	(8, 'Harga Makanan', 0.15, 'Cost', 'K7');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.skor_alternatif
CREATE TABLE IF NOT EXISTS `skor_alternatif` (
  `id_skor` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `skor` float DEFAULT NULL,
  PRIMARY KEY (`id_skor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.skor_alternatif: ~0 rows (approximately)
/*!40000 ALTER TABLE `skor_alternatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `skor_alternatif` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.sub_kriteria
CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(11) DEFAULT NULL,
  `nm_sub` varchar(100) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `keterangan` longtext,
  PRIMARY KEY (`id_sub_kriteria`) USING BTREE,
  KEY `kriteria_id` (`kriteria_id`) USING BTREE,
  CONSTRAINT `kriteria_id` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`kriteria_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.sub_kriteria: ~27 rows (approximately)
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
REPLACE INTO `sub_kriteria` (`id_sub_kriteria`, `kriteria_id`, `nm_sub`, `nilai`, `keterangan`) VALUES
	(1, 1, 'Sangat Lengkap', 1, 'Ac, Kipas Angin, Musholla, Wifi, Toilet, Stop Kontak, Ruang Meeting, Tempat Bermain Anak, Wastafel, Televisi, Live Musik, CCTV, Layar Proyektor, Lesehan, Cermin, Area Parkir, Smooking Room'),
	(2, 1, 'Lengkap', 0.8, NULL),
	(3, 1, 'Cukup Lengkap', 0.6, NULL),
	(5, 1, 'Tidak Lengkap', 0.3, NULL),
	(6, 5, 'Lokasi Cafe Dekat Pantai', 0.5, NULL),
	(7, 5, 'Lokasi Cafe Dekat Dengan Mesjid < 50 m', 0.9, NULL),
	(8, 5, 'Lokasi Cafe Berada DiDepan Jalan Utama', 1, NULL),
	(9, 5, 'Lokasi Pusat Kota', 0.7, NULL),
	(12, 2, 'Sangat Lengkap', 1, NULL),
	(13, 2, 'Lengkap', 0.8, NULL),
	(14, 2, 'Cukup Lengkap', 0.7, NULL),
	(15, 2, 'Tidak Lengkap', 0.4, NULL),
	(16, 3, 'Sangat Lengkap', 1, NULL),
	(17, 3, 'Lengkap', 0.9, NULL),
	(18, 3, 'Cukup Lengkap', 0.7, NULL),
	(19, 3, 'Tidak Lengkap', 0.5, NULL),
	(20, 4, 'Indoor', 0.6, NULL),
	(21, 4, 'Semi Indoor', 0.9, NULL),
	(22, 4, 'Outdoor', 0.7, NULL),
	(23, 6, 'Kurang Dari Rp.10.000', 0.9, NULL),
	(24, 6, 'Rp. 10.000 Sampai Rp. 20.000', 0.7, NULL),
	(25, 6, 'Rp. 20.000 Sampai Rp. 30.000', 0.5, NULL),
	(26, 6, 'Lebih dari Rp. 30.000', 0.2, NULL),
	(27, 8, 'Kurang dari Rp. 15.000', 0.9, NULL),
	(28, 8, 'Rp. 15.000 Sampai Rp. 30.000', 0.8, NULL),
	(29, 8, 'Rp. 30.000 Sampai Rp. 50.000', 0.7, NULL),
	(30, 8, 'Lebih Dari 50.000', 0.4, NULL);
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;

-- Dumping structure for table sr_cafe.users
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','masyarakat') DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table sr_cafe.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`iduser`, `nama`, `username`, `email`, `password`, `role`) VALUES
	(2, 'Adillah', 'admin', 'adminn@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
	(3, 'Siti Akmalia', 'sitiakmalia', 'sitiakmalia@gmail.com', '16a1c15f62d4ba2b6abdaa50e97d592f', 'masyarakat'),
	(4, 'Putri Muliyani', 'putrimuliyani', 'putrimulyani@gmail.com', '2146e71acc82108f52be5b5dc0a984c5', 'masyarakat'),
	(5, 'Banta Kamarullah', 'bantakamarullah', 'bantakamarullah@gmail.com', '637b6b4601843fc1623ffc235fd5bb54', 'masyarakat'),
	(8, 'Rizki Meunazar', 'rizki', 'rizki@gmail.com', '9592638716b04b52fe6e041429822a79', 'masyarakat'),
	(9, 'Zahrul Aini', 'aini', 'zahrul@gmail.com', '8274b82aa057f3df1908084f14c55ec3', 'masyarakat');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
