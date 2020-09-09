-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2020 at 08:48 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspektorat`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pemeriksaan`
--

DROP TABLE IF EXISTS `laporan_pemeriksaan`;
CREATE TABLE IF NOT EXISTS `laporan_pemeriksaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_spt_id` int(11) NOT NULL,
  `sasaran_audit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_temuan_id` int(11) NOT NULL,
  `judultemuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kriteria` json DEFAULT NULL,
  `url_img_laporan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sebab` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akibat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `komentar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekomendasi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_pemeriksaan`
--

INSERT INTO `laporan_pemeriksaan` (`id`, `detail_spt_id`, `sasaran_audit`, `kode_temuan_id`, `judultemuan`, `kondisi`, `kriteria`, `url_img_laporan`, `sebab`, `akibat`, `komentar`, `rekomendasi`, `created_at`, `updated_at`) VALUES
(114, 171, 'Pembayaran honorarium', 10, 'Pembayaran honorarium dan/atau biaya perjalanan dinas ganda dan/atau melebihi standar yang ditetapkan', '<p>test kondisi kka</p><p><img style=\"width: 25%;\" src=www/kosong><br></p>', '\"<p>test kriteria1</p>\"', 'http://www.inspektogar.local/storage/laporan-img/5f45cd52e8883.png', NULL, NULL, '', NULL, '2020-08-25 19:47:47', '2020-09-08 21:09:07'),
(115, 170, 'test sasaran audit', 10, 'Pembayaran honorarium dan/atau biaya perjalanan dinas ganda dan/atau melebihi standar yang ditetapkan', '<p>test kondisi kka</p><p> <img style=\"width: 25%;\" src=www/kosong></p>', '\"<p>test kriteria kka</p>\"', 'http://www.inspektogar.local/storage/laporan-img/5f45ce04e2173.jpeg', NULL, NULL, '', NULL, '2020-08-25 19:50:44', '2020-09-08 21:09:07'),
(129, 176, 'testing', 101, 'Pelaksanaan kegiatan terlambat/terhambat sehingga mempengaruhi pencapaian tujuan organisasi', '<p>test kondisi</p>', '\"<p><span style=\\\"font-size: 16px;\\\">test krteria</span><br></p>\"', NULL, 'aaaa', 'tesztvvvv', 'tesztvvvv', 'tesztdsdddd', '2020-09-06 21:54:35', '2020-09-09 01:33:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
