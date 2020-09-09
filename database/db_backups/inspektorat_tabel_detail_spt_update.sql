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
-- Table structure for table `detail_spt`
--

DROP TABLE IF EXISTS `detail_spt`;
CREATE TABLE IF NOT EXISTS `detail_spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `peran` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` int(11) DEFAULT NULL,
  `lama_jam` decimal(5,2) DEFAULT NULL,
  `dupak` double(8,5) DEFAULT NULL,
  `jenis_laporan` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif jika nomor spt terupdate dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_dupak` json NOT NULL,
  `info_laporan_pemeriksaan` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_spt`
--

INSERT INTO `detail_spt` (`id`, `spt_id`, `user_id`, `peran`, `lama`, `lama_jam`, `dupak`, `jenis_laporan`, `status`, `status_dupak`, `unsur_dupak`, `info_dupak`, `info_laporan_pemeriksaan`) VALUES
(166, 171, 27, 'Penanggungjawab', NULL, NULL, 0.00000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0}', NULL),
(167, 171, 33, 'Pengendali Mutu', NULL, NULL, 0.42000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0.416, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.032}', NULL),
(168, 171, 28, 'Pengendali Teknis', NULL, NULL, 0.42000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0.416, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.032}', NULL),
(169, 171, 61, 'Ketua Tim', NULL, NULL, 0.26000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0.26, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.02}', NULL),
(170, 171, 50, 'Anggota Tim', NULL, NULL, 0.13000, 'KKA', '{\"KetuaTim\":61,\"PengendaliTeknis\":null,\"PengendaliMutu\":null,\"PenanggungJawab\":null}', NULL, 'pengawasan', '{\"dupak\": 0.13, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.01}', NULL),
(171, 171, 81, 'Anggota Tim', NULL, NULL, 0.13000, 'KKA', NULL, NULL, 'pengawasan', '{\"dupak\": 0.13, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.01}', NULL),
(172, 177, 27, 'Penanggungjawab', NULL, NULL, 0.00000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0}', NULL),
(173, 177, 33, 'Pengendali Mutu', NULL, NULL, 0.42000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0.416, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.032}', NULL),
(174, 177, 28, 'Pengendali Teknis', NULL, NULL, 0.42000, NULL, NULL, NULL, 'pengawasan', '{\"dupak\": 0.416, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.032}', NULL),
(175, 177, 41, 'Ketua Tim', NULL, NULL, 0.26000, 'LHP', '{\"KetuaTim\":41}', NULL, 'pengawasan', '{\"dupak\": 0.26, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.02}', '{\"hasil-pemeriksaan\": \"<p><span style=\\\"font-size: 16px;\\\">teszt</span><br></p>\", \"tujuan-pemeriksaan\": \"<p>teszt</p>\", \"batasan-pemeriksaan\": \"<p><span style=\\\"font-size: 16px;\\\">teszt</span><br></p>\", \"pendekatan-pemeriksaan\": \"<p><span style=\\\"font-size: 16px;\\\">teszt</span><br></p>\", \"ruang-lingkup-pemeriksaan\": \"<p><span style=\\\"font-size: 16px;\\\">teszt</span><br></p>\"}'),
(176, 177, 43, 'Anggota Tim', NULL, NULL, 0.13000, 'KKA', '{\"KetuaTim\":41,\"PengendaliTeknis\":null,\"PengendaliMutu\":null,\"PenanggungJawab\":null}', NULL, 'pengawasan', '{\"dupak\": 0.13, \"lembur\": 0, \"efektif\": 2, \"lama_jam\": 13, \"koefisien\": 0.01}', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
