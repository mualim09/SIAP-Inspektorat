-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2020 at 05:55 AM
-- Server version: 5.7.28
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
-- Table structure for table `spt_umum`
--

DROP TABLE IF EXISTS `spt_umum`;
CREATE TABLE IF NOT EXISTS `spt_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_spt_umum` text COLLATE utf8mb4_unicode_ci,
  `lokasi_id` json DEFAULT NULL,
  `info_untuk_umum` text COLLATE utf8mb4_unicode_ci,
  `nomor` int(11) DEFAULT NULL,
  `info_dasar_umum` text COLLATE utf8mb4_unicode_ci,
  `tgl_mulai` timestamp NOT NULL,
  `tgl_akhir` timestamp NOT NULL,
  `lama` text COLLATE utf8mb4_unicode_ci,
  `tgl_register` timestamp NULL DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
