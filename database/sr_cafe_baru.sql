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
	(1, 1, 50, 100, 70, 100, 70, 70, 70),
	(2, 2, 20, 70, 50, 70, 50, 100, 70),
	(3, 3, 70, 50, 50, 50, 50, 100, 50),
	(4, 4, 50, 20, 100, 50, 70, 50, 50),
	(5, 5, 100, 100, 20, 70, 70, 50, 100);

-- membuang struktur untuk table sr_cafe.cafes
CREATE TABLE IF NOT EXISTS `cafes` (
  `id_cafe` int NOT NULL AUTO_INCREMENT,
  `nm_cafe` varchar(100) DEFAULT NULL,
  `inisial_cafe` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id_cafe`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.cafes: ~5 rows (lebih kurang)
INSERT INTO `cafes` (`id_cafe`, `nm_cafe`, `inisial_cafe`, `alamat`, `deskripsi`) VALUES
	(1, 'Sovt Kopi', 'A1', 'Jln Panglateh', 'Wifi, Ac, CCTV'),
	(2, 'The Breeze Coffe', 'A2', 'Jln Merdeka', 'WIFI, AC, CCTV, CERMIN'),
	(3, 'Platinum Coffe', 'A3', 'Jln Merdeka', 'WIFI'),
	(4, 'Station Coffe Premium', 'A4', 'Jln Merdeka', 'Wifi,AC'),
	(5, 'Kolega Coffe', 'A5', 'Jln Merdeka', 'Wifi,AC');

-- membuang struktur untuk table sr_cafe.hasil_alternatif
CREATE TABLE IF NOT EXISTS `hasil_alternatif` (
  `id_hasil` int NOT NULL AUTO_INCREMENT,
  `id_cafe` int DEFAULT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.hasil_alternatif: ~0 rows (lebih kurang)

-- membuang struktur untuk table sr_cafe.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `kriteria_id` int NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `jenis_bobot` enum('Benefit','Cost') DEFAULT NULL,
  `smbl_kriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.kriteria: ~7 rows (lebih kurang)
INSERT INTO `kriteria` (`kriteria_id`, `nama_kriteria`, `bobot`, `jenis_bobot`, `smbl_kriteria`) VALUES
	(1, 'fasilitas', 0.2, 'Benefit', 'K1'),
	(2, 'menu_minuman', 0.2, 'Benefit', 'K2'),
	(3, 'menu_makanan', 0.1, 'Benefit', 'K3'),
	(4, 'suasana', 0.1, 'Benefit', 'K4'),
	(5, 'lokasi', 0.1, 'Benefit', 'K5'),
	(6, 'harga_minuman', 0.15, 'Cost', 'K6'),
	(8, 'harga_makanan', 0.15, 'Cost', 'K7');

-- membuang struktur untuk table sr_cafe.skor_alternatif
CREATE TABLE IF NOT EXISTS `skor_alternatif` (
  `id_skor` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int DEFAULT NULL,
  `id_alternatif` int DEFAULT NULL,
  `skor` float DEFAULT NULL,
  PRIMARY KEY (`id_skor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.skor_alternatif: ~0 rows (lebih kurang)

-- membuang struktur untuk table sr_cafe.sub_kriteria
CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id_sub_kriteria` int NOT NULL AUTO_INCREMENT,
  `kriteria_id` int DEFAULT NULL,
  `nm_sub` varchar(100) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `keterangan` longtext,
  PRIMARY KEY (`id_sub_kriteria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.sub_kriteria: ~27 rows (lebih kurang)
INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `kriteria_id`, `nm_sub`, `nilai`, `keterangan`) VALUES
	(1, 1, 'Sangat Lengkap', 100, 'Ac, Kipas Angin, Musholla, Wifi, Toilet, Stop Kontak, Ruang Meeting, Tempat Bermain Anak, Wastafel, Televisi, Live Musik, CCTV, Layar Proyektor, Lesehan, Cermin, Area Parkir, Smooking Room'),
	(2, 1, 'Lengkap', 70, NULL),
	(3, 1, 'Cukup Lengkap', 50, NULL),
	(5, 1, 'Tidak Lengkap', 20, NULL),
	(6, 5, 'Lokasi Cafe Dekat Pantai', 50, NULL),
	(7, 5, 'Lokasi Cafe Dekat Dengan Mesjid < 50 m', 70, NULL),
	(8, 5, 'Lokasi Cafe Berada DiDepan Jalan Utama', 100, NULL),
	(9, 5, 'Lokasi Pusat Kota', 20, NULL),
	(12, 2, 'Sangat Lengkap', 100, NULL),
	(13, 2, 'Lengkap', 70, NULL),
	(14, 2, 'Cukup Lengkap', 50, NULL),
	(15, 2, 'Tidak Lengkap', 20, NULL),
	(16, 3, 'Sangat Lengkap', 100, NULL),
	(17, 3, 'Lengkap', 70, NULL),
	(18, 3, 'Cukup Lengkap', 50, NULL),
	(19, 3, 'Tidak Lengkap', 20, NULL),
	(20, 4, 'Indoor', 70, NULL),
	(21, 4, 'Semi Indoor', 100, NULL),
	(22, 4, 'Outdoor', 20, NULL),
	(23, 6, 'Kurang Dari Rp.10.000', 100, NULL),
	(24, 6, 'Rp. 10.000 Sampai Rp. 20.000', 70, NULL),
	(25, 6, 'Rp. 20.000 Sampai Rp. 30.000', 50, NULL),
	(26, 6, 'Lebih dari Rp. 30.000', 20, NULL),
	(27, 8, 'Kurang dari Rp. 15.000', 100, NULL),
	(28, 8, 'Rp. 15.000 Sampai Rp. 30.000', 70, NULL),
	(29, 8, 'Rp. 30.000 Sampai Rp. 50.000', 50, NULL),
	(30, 8, 'Lebih Dari 50.000', 20, NULL);

-- membuang struktur untuk table sr_cafe.users
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','masyarakat') DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sr_cafe.users: ~7 rows (lebih kurang)
INSERT INTO `users` (`iduser`, `nama`, `username`, `email`, `password`, `role`) VALUES
	(2, 'Adillah', 'admin', 'adminn@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
	(3, 'Siti Akmalia', 'sitiakmalia', 'sitiakmalia@gmail.com', '16a1c15f62d4ba2b6abdaa50e97d592f', 'masyarakat'),
	(4, 'Putri Muliyani', 'putrimuliyani', 'putrimulyani@gmail.com', '2146e71acc82108f52be5b5dc0a984c5', 'masyarakat'),
	(5, 'Banta Kamarullah', 'bantakamarullah', 'bantakamarullah@gmail.com', '637b6b4601843fc1623ffc235fd5bb54', 'masyarakat'),
	(8, 'Rizki Meunazar', 'rizki', 'rizki@gmail.com', '9592638716b04b52fe6e041429822a79', 'masyarakat'),
	(9, 'Zahrul Aini', 'aini', 'zahrul@gmail.com', '8274b82aa057f3df1908084f14c55ec3', 'masyarakat'),
	(10, 'mencoba', 'coba', 'mencoba@gmail.com', 'c3ec0f7b054e729c5a716c8125839829', 'masyarakat');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
