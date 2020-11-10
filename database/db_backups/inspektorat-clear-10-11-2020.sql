-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2020 at 02:54 AM
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
-- Table structure for table `detail_ppm`
--

DROP TABLE IF EXISTS `detail_ppm`;
CREATE TABLE IF NOT EXISTS `detail_ppm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `kode_kelompok` int(11) DEFAULT NULL,
  `peran` varchar(50) DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `unsur_dupak` varchar(50) DEFAULT NULL,
  `info_dupak` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_spt`
--

DROP TABLE IF EXISTS `detail_spt`;
CREATE TABLE IF NOT EXISTS `detail_spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `peran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` int(11) DEFAULT NULL,
  `lama_jam` decimal(5,2) DEFAULT NULL,
  `dupak` double(8,5) DEFAULT NULL,
  `jenis_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif jika nomor spt terupdate dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_dupak` json DEFAULT NULL,
  `info_laporan_pemeriksaan` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dupak`
--

DROP TABLE IF EXISTS `dupak`;
CREATE TABLE IF NOT EXISTS `dupak` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `dupak` decimal(5,2) NOT NULL,
  `unsur_dupak` varchar(191) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `info_spt` json DEFAULT NULL COMMENT 'info_spt terkait dupak dengan format : {jenis_dupak:[''pengawasan'', ''penunjang'', dll], nomor_spt: int nomor, tgl_mulai: date tgl_mulai_spt, tgl_akhir: date tgl_akhir_spt}',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Imlek', '2020-01-25 00:00:00', '2020-01-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(2, 'Isra Miraj', '2020-03-22 00:00:00', '2020-03-23 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(3, 'Hari Raya Nyepi', '2020-03-25 00:00:00', '2020-03-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(4, 'Cuti Bersama', '2020-05-22 00:00:00', '2020-05-23 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(5, 'Cuti Bersama', '2020-05-26 00:00:00', '2020-05-27 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(6, 'Cuti Bersama', '2020-05-27 00:00:00', '2020-05-28 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(7, 'Idul Adha', '2020-07-31 00:00:00', '2020-08-01 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(8, 'Muharram', '2020-08-20 00:00:00', '2020-08-21 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(9, 'Cuti Bersama', '2020-12-24 00:00:00', '2020-12-25 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(10, 'Imlek', '2021-02-12 00:00:00', '2021-02-13 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(11, 'Isra Miraj', '2021-03-11 00:00:00', '2021-03-12 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(12, 'Hari Raya Nyepi', '2021-03-14 00:00:00', '2021-03-15 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(13, 'Wafat Isa Al-Masih', '2021-04-02 00:00:00', '2021-04-03 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(14, 'Hari Buruh', '2021-05-01 00:00:00', '2021-05-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(15, 'Hari Raya Puasa', '2021-05-13 00:00:00', '2021-05-14 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(16, 'Ascension Day', '2021-05-13 00:00:00', '2021-05-14 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(17, 'Hari Raya Puasa Holiday', '2021-05-14 00:00:00', '2021-05-15 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(18, 'Waisak Day', '2021-05-26 00:00:00', '2021-05-27 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(19, 'Pancasila Day', '2021-06-01 00:00:00', '2021-06-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(20, 'Idul Adha', '2021-07-20 00:00:00', '2021-07-21 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(21, 'Muharram', '2021-08-10 00:00:00', '2021-08-11 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(22, 'Independence Day', '2021-08-17 00:00:00', '2021-08-18 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(23, 'Maulidur Rasul', '2021-10-19 00:00:00', '2021-10-20 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(24, 'New Year\'s Day', '2022-01-01 00:00:00', '2022-01-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(25, 'Imlek', '2022-02-01 00:00:00', '2022-02-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(26, 'Isra Miraj', '2022-03-01 00:00:00', '2022-03-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(27, 'Hari Raya Nyepi', '2022-03-03 00:00:00', '2022-03-04 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(28, 'Wafat Isa Al-Masih', '2022-04-15 00:00:00', '2022-04-16 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(29, 'Hari Buruh', '2022-05-01 00:00:00', '2022-05-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(30, 'Cuti Bersama', '2022-05-02 00:00:00', '2022-05-03 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(31, 'Hari Raya Puasa', '2022-05-03 00:00:00', '2022-05-04 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(32, 'Hari Raya Puasa Holiday', '2022-05-04 00:00:00', '2022-05-05 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(33, 'Cuti Bersama', '2022-05-05 00:00:00', '2022-05-06 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(34, 'Cuti Bersama', '2022-05-06 00:00:00', '2022-05-07 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(35, 'Waisak Day', '2022-05-16 00:00:00', '2022-05-17 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(36, 'Ascension Day', '2022-05-26 00:00:00', '2022-05-27 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(37, 'Pancasila Day', '2022-06-01 00:00:00', '2022-06-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(38, 'Idul Adha', '2022-07-10 00:00:00', '2022-07-11 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(39, 'Muharram', '2022-07-31 00:00:00', '2022-08-01 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(40, 'Independence Day', '2022-08-17 00:00:00', '2022-08-18 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(41, 'Maulud Nabi', '2022-10-09 00:00:00', '2022-10-10 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(42, 'Christmas Day', '2022-12-25 00:00:00', '2022-12-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(43, 'Cuti Bersama', '2022-12-26 00:00:00', '2022-12-27 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(44, 'Wafat Isa Al-Masih', '2020-04-10 00:00:00', '2020-04-11 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(45, 'Hari Paskah', '2020-04-12 00:00:00', '2020-04-13 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(46, 'Hari buruh', '2020-05-01 00:00:00', '2020-05-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(47, 'Waisak', '2020-05-07 00:00:00', '2020-05-08 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(48, 'Kenaikan Yesus Kristus', '2020-05-21 00:00:00', '2020-05-22 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(49, 'Idul Fitri', '2020-05-24 00:00:00', '2020-05-25 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(50, 'Idul Fitri', '2020-05-25 00:00:00', '2020-05-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(51, 'Hari Lahir Pancasila', '2020-06-01 00:00:00', '2020-06-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(52, 'Hari Proklamasi Kemerdekaan R.I.', '2020-08-17 00:00:00', '2020-08-18 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(53, 'Maulud Nabi Muhammad', '2020-10-29 00:00:00', '2020-10-30 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(54, 'Hari Natal', '2020-12-25 00:00:00', '2020-12-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(55, 'Hari Tahun Baru', '2021-01-01 00:00:00', '2021-01-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(56, 'Christmas Day', '2021-12-25 00:00:00', '2021-12-26 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(57, 'Malam Natal', '2021-12-24 00:00:00', '2021-12-25 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(58, 'Tahun Baru', '2020-01-01 00:00:00', '2020-01-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19'),
(104, 'TGR', '2020-06-10 00:00:00', '2020-06-20 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 21, \"user_id\": 6}', '2020-06-07 20:24:45', '2020-06-07 20:24:45'),
(103, 'Evaluasi SAKIP', '2020-06-09 00:00:00', '2020-06-18 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 20, \"user_id\": 6}', '2020-06-07 20:19:38', '2020-06-07 20:19:38'),
(101, 'Evaluasi SAKIP', '2020-04-16 00:00:00', '2020-04-23 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": 18, \"user_id\": 6}', '2020-04-14 19:23:33', '2020-04-14 19:23:33'),
(100, 'Riktu', '2020-03-27 00:00:00', '2020-04-04 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": \"15\", \"user_id\": 6}', '2020-03-25 20:18:47', '2020-03-25 20:31:09'),
(88, 'Evaluasi SAKIP', '2020-03-20 00:00:00', '2020-03-27 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 14, \"user_id\": 6}', '2020-03-17 20:13:47', '2020-03-17 20:13:47'),
(95, 'Cuti Bersama', '2020-04-28 00:00:00', '2020-04-29 00:00:00', NULL, '2020-03-18 22:32:27', '2020-03-18 22:32:27'),
(96, 'Cuti lagi', '2020-04-22 00:00:00', '2020-04-23 00:00:00', NULL, '2020-03-18 22:33:44', '2020-03-18 22:33:44'),
(102, 'Audit Operasional', '2020-04-27 00:00:00', '2020-05-01 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 19, \"user_id\": 6}', '2020-04-26 19:39:05', '2020-04-26 19:39:05'),
(105, 'Evaluasi SAKIP', '2020-06-20 00:00:00', '2020-06-25 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 22, \"user_id\": 6}', '2020-06-07 20:28:55', '2020-06-07 20:28:55'),
(106, 'Riktu', '2020-06-25 00:00:00', '2020-06-26 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"23\", \"user_id\": 6}', '2020-06-07 20:35:39', '2020-06-07 22:34:19'),
(107, 'Evaluasi SAKIP', '2020-06-10 00:00:00', '2020-06-18 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 24, \"user_id\": 6}', '2020-06-08 19:17:46', '2020-06-08 19:17:46'),
(108, 'Audit Operasional', '2020-06-10 00:00:00', '2020-06-15 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 25, \"user_id\": 6}', '2020-06-08 21:10:28', '2020-06-08 21:10:28'),
(109, 'Audit Operasional', '2020-06-15 00:00:00', '2020-06-19 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 26, \"user_id\": 6}', '2020-06-08 21:14:38', '2020-06-08 21:14:38'),
(110, 'Riktu', '2020-06-11 00:00:00', '2020-06-18 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 27, \"user_id\": 6}', '2020-06-09 20:27:43', '2020-06-09 20:27:43'),
(111, 'Audit Operasional', '2020-06-30 00:00:00', '2020-07-03 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 28, \"user_id\": 6}', '2020-06-14 20:21:23', '2020-06-14 20:21:23'),
(112, 'Evaluasi SAKIP', '2020-06-23 00:00:00', '2020-06-26 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 30, \"user_id\": 6}', '2020-06-21 19:18:50', '2020-06-21 19:18:50'),
(113, 'Evaluasi SAKIP', '2020-06-23 00:00:00', '2020-06-30 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 32, \"user_id\": 6}', '2020-06-21 19:58:01', '2020-06-21 19:58:01'),
(114, 'Riktu', '2020-06-23 00:00:00', '2020-06-25 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 33, \"user_id\": 6}', '2020-06-21 19:59:49', '2020-06-21 19:59:49'),
(115, 'Evaluasi SAKIP', '2020-06-19 00:00:00', '2020-06-25 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 34, \"user_id\": 6}', '2020-06-21 20:13:23', '2020-06-21 20:13:23'),
(116, 'TGR', '2020-07-03 00:00:00', '2020-07-07 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 35, \"user_id\": 6}', '2020-06-21 21:14:04', '2020-06-21 21:14:04'),
(117, 'Evaluasi SAKIP', '2020-07-07 00:00:00', '2020-07-07 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 163, \"user_id\": 6}', '2020-07-05 23:21:34', '2020-07-05 23:21:34'),
(118, 'Riktu', '2020-07-13 00:00:00', '2020-07-17 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"164\", \"user_id\": 6}', '2020-07-09 19:04:22', '2020-07-13 18:32:57'),
(119, 'Perceraian', '2020-07-14 00:00:00', '2020-07-14 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"165\", \"user_id\": 6}', '2020-07-12 18:39:25', '2020-07-13 21:42:41'),
(120, 'Audit Operasional', '2020-07-16 00:00:00', '2020-07-23 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 166, \"user_id\": 6}', '2020-07-15 18:37:30', '2020-07-15 18:37:30'),
(121, 'Evaluasi SAKIP', '2020-07-17 00:00:00', '2020-07-23 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"167\", \"user_id\": 6}', '2020-07-16 00:21:37', '2020-07-16 00:56:44'),
(122, 'Perceraian', '2020-07-18 00:00:00', '2020-07-18 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"168\", \"user_id\": 6}', '2020-07-16 19:11:31', '2020-07-16 19:12:50'),
(123, 'Evaluasi SAKIP', '2020-07-22 00:00:00', '2020-07-25 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"169\", \"user_id\": 6}', '2020-07-19 17:56:23', '2020-07-19 18:15:40'),
(124, 'Perceraian', '2020-07-23 00:00:00', '2020-07-24 00:00:00', '{\"type\": \"spt\", \"jenis\": \"umum\", \"spt_id\": \"170\", \"user_id\": 6}', '2020-07-19 18:08:46', '2020-07-21 02:14:29'),
(125, 'asdgf', '2020-01-10 00:00:00', '2020-01-11 00:00:00', NULL, '2020-07-20 18:55:28', '2020-07-20 18:55:28'),
(126, 'Audit Operasional', '2020-07-28 00:00:00', '2020-07-29 00:00:00', '{\"type\": \"spt\", \"jenis\": null, \"spt_id\": 171, \"user_id\": 6}', '2020-07-26 18:46:57', '2020-07-26 18:46:57'),
(127, 'Audit Operasional', '2020-07-28 00:00:00', '2020-07-29 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 171, \"user_id\": 6}', '2020-08-10 23:01:48', '2020-08-10 23:01:48'),
(128, 'Perceraian', '2020-07-23 00:00:00', '2020-07-24 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 170, \"user_id\": 6}', '2020-08-10 23:14:59', '2020-08-10 23:14:59'),
(129, 'Audit Operasional', '2020-08-12 00:00:00', '2020-08-13 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 173, \"user_id\": 6}', '2020-08-10 23:15:40', '2020-08-10 23:15:40'),
(130, 'Evaluasi SAKIP', '2020-10-08 00:00:00', '2020-10-10 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 182, \"user_id\": 6}', '2020-10-23 00:18:52', '2020-10-23 00:18:52'),
(131, 'Riktu', '2020-10-27 00:00:00', '2020-10-28 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 183, \"user_id\": 6}', '2020-10-25 22:30:21', '2020-10-25 22:30:21'),
(132, 'Riktu', '2020-10-28 00:00:00', '2020-10-28 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 184, \"user_id\": 6}', '2020-11-02 01:15:40', '2020-11-02 01:15:40'),
(133, 'Audit Kinerja', '2020-11-04 00:00:00', '2020-11-04 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 185, \"user_id\": 6}', '2020-11-02 19:20:57', '2020-11-02 19:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `info_rev_kka`
--

DROP TABLE IF EXISTS `info_rev_kka`;
CREATE TABLE IF NOT EXISTS `info_rev_kka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_spt` int(11) DEFAULT NULL,
  `nama_file` varchar(191) DEFAULT NULL,
  `kka` varchar(191) DEFAULT NULL,
  `revisi` json DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_spt`
--

DROP TABLE IF EXISTS `jenis_spt`;
CREATE TABLE IF NOT EXISTS `jenis_spt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sebutan` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `dasar` text NOT NULL,
  `kode_kelompok` varchar(20) NOT NULL,
  `input` json NOT NULL,
  `radio` json DEFAULT NULL,
  `kategori` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kode_temuan`
--

DROP TABLE IF EXISTS `kode_temuan`;
CREATE TABLE IF NOT EXISTS `kode_temuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `deskripsi` varchar(499) NOT NULL,
  `atribut` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kuota_kalender`
--

DROP TABLE IF EXISTS `kuota_kalender`;
CREATE TABLE IF NOT EXISTS `kuota_kalender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `detail_kuota` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pemeriksaan`
--

DROP TABLE IF EXISTS `laporan_pemeriksaan`;
CREATE TABLE IF NOT EXISTS `laporan_pemeriksaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_spt_id` int(11) NOT NULL,
  `sasaran_audit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_temuan_id` int(11) NOT NULL,
  `judultemuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` text COLLATE utf8mb4_unicode_ci,
  `kriteria` json DEFAULT NULL,
  `url_img_laporan` text COLLATE utf8mb4_unicode_ci,
  `sebab` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akibat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `komentar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekomendasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_spt`
--

DROP TABLE IF EXISTS `laporan_spt`;
CREATE TABLE IF NOT EXISTS `laporan_spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `spt_id` bigint(20) UNSIGNED NOT NULL,
  `file` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_spt_user_id_foreign` (`user_id`),
  KEY `laporan_spt_spt_id_foreign` (`spt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel_logger_activity`
--

DROP TABLE IF EXISTS `laravel_logger_activity`;
CREATE TABLE IF NOT EXISTS `laravel_logger_activity` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `route` longtext COLLATE utf8mb4_unicode_ci,
  `ipAddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userAgent` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` longtext COLLATE utf8mb4_unicode_ci,
  `methodType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `jenis_lokasi` varchar(255) DEFAULT NULL,
  `sebutan_pimpinan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'jika status 0/null maka tidak ada peleburan OPD. jika status 1 maka ada peleburan.',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 5),
(1, 'App\\User', 6),
(3, 'App\\User', 46),
(3, 'App\\User', 47),
(3, 'App\\User', 51),
(3, 'App\\User', 52),
(3, 'App\\User', 53),
(3, 'App\\User', 62),
(3, 'App\\User', 65),
(3, 'App\\User', 66),
(3, 'App\\User', 67),
(3, 'App\\User', 68),
(3, 'App\\User', 72),
(4, 'App\\User', 44),
(4, 'App\\User', 45),
(4, 'App\\User', 51),
(4, 'App\\User', 52),
(4, 'App\\User', 53),
(4, 'App\\User', 62),
(4, 'App\\User', 66),
(4, 'App\\User', 67),
(4, 'App\\User', 68),
(4, 'App\\User', 87),
(5, 'App\\User', 9),
(5, 'App\\User', 11),
(5, 'App\\User', 13),
(5, 'App\\User', 28),
(5, 'App\\User', 32),
(5, 'App\\User', 33),
(5, 'App\\User', 34),
(5, 'App\\User', 35),
(5, 'App\\User', 36),
(5, 'App\\User', 37),
(5, 'App\\User', 38),
(5, 'App\\User', 39),
(5, 'App\\User', 40),
(5, 'App\\User', 41),
(5, 'App\\User', 42),
(5, 'App\\User', 43),
(5, 'App\\User', 48),
(5, 'App\\User', 49),
(5, 'App\\User', 50),
(5, 'App\\User', 54),
(5, 'App\\User', 55),
(5, 'App\\User', 56),
(5, 'App\\User', 57),
(5, 'App\\User', 58),
(5, 'App\\User', 59),
(5, 'App\\User', 60),
(5, 'App\\User', 61),
(5, 'App\\User', 63),
(5, 'App\\User', 64),
(5, 'App\\User', 69),
(5, 'App\\User', 70),
(5, 'App\\User', 71),
(5, 'App\\User', 74),
(5, 'App\\User', 81),
(5, 'App\\User', 84),
(5, 'App\\User', 85),
(5, 'App\\User', 88),
(6, 'App\\User', 7),
(6, 'App\\User', 27),
(6, 'App\\User', 29),
(6, 'App\\User', 30),
(6, 'App\\User', 31),
(6, 'App\\User', 32),
(6, 'App\\User', 88);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pejabat`
--

DROP TABLE IF EXISTS `pejabat`;
CREATE TABLE IF NOT EXISTS `pejabat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administer roles & permissions', 'web', '2019-05-16 08:51:30', '2019-05-16 08:51:30'),
(2, 'Access admin page', 'web', '2019-05-16 08:51:30', '2019-05-16 08:51:30'),
(3, 'Create SPT', 'web', '2019-05-19 19:55:33', '2019-05-19 19:55:33'),
(4, 'Edit SPT', 'web', '2019-05-19 19:55:43', '2019-05-19 19:55:43'),
(5, 'Delete SPT', 'web', '2019-05-19 19:55:50', '2019-05-19 19:55:50'),
(6, 'View SPT', 'web', '2019-05-19 19:55:59', '2019-05-19 19:55:59'),
(7, 'Edit Signed SPT', 'web', '2019-05-19 19:58:47', '2019-05-19 19:58:47'),
(8, 'Sign SPT', 'web', '2019-06-26 13:23:50', '2019-06-26 13:23:50'),
(9, 'Penilai dupak', 'web', '2019-11-26 19:15:38', '2019-11-26 19:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` blob,
  `pic` blob,
  `about` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refrensi_kka`
--

DROP TABLE IF EXISTS `refrensi_kka`;
CREATE TABLE IF NOT EXISTS `refrensi_kka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refrensi_lokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refrens_kka` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resiko`
--

DROP TABLE IF EXISTS `resiko`;
CREATE TABLE IF NOT EXISTS `resiko` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `opd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan_kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan_pd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sasaran_pd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capaian` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2019-05-16 08:51:30', '2019-05-19 20:01:02'),
(2, 'guest', 'web', '2019-05-16 08:51:31', '2019-05-16 08:51:31'),
(3, 'TU Umum', 'web', '2019-05-19 19:57:43', '2019-05-19 19:57:43'),
(4, 'TU Perencanaan', 'web', '2019-05-19 19:58:21', '2019-05-19 19:58:21'),
(5, 'Auditor', 'web', '2019-05-31 00:08:50', '2019-05-31 00:08:50'),
(6, 'Inspektur', 'web', '2019-06-26 13:24:15', '2019-06-26 13:24:15'),
(7, 'Tim Dupak', 'web', '2019-11-26 19:16:09', '2019-11-26 19:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(6, 1),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(7, 1),
(7, 3),
(8, 1),
(8, 6),
(9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

DROP TABLE IF EXISTS `sertifikat`;
CREATE TABLE IF NOT EXISTS `sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'fk user menginsyaratkan kepunyaan',
  `nama_sertifikat` varchar(255) NOT NULL,
  `file_sertifikat` varchar(255) NOT NULL,
  `status_akses` int(11) DEFAULT NULL COMMENT 'untuk memberikan hak akan data sertifikat dari tiap2 user',
  `uploaded_by` int(11) DEFAULT NULL COMMENT 'fk user menginsyaratkan yg mengupload',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spt`
--

DROP TABLE IF EXISTS `spt`;
CREATE TABLE IF NOT EXISTS `spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_spt_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` json DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `tambahan` text COLLATE utf8mb4_unicode_ci,
  `tgl_mulai` timestamp NOT NULL,
  `tgl_akhir` timestamp NOT NULL,
  `lama` int(3) DEFAULT NULL,
  `tgl_register` timestamp NULL DEFAULT NULL,
  `info` json DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spt_jenis_spt_id_foreign` (`jenis_spt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` json DEFAULT NULL,
  `sex` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` timestamp NOT NULL,
  `gelar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_auditor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruang` json DEFAULT NULL,
  `sertifikat` json DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pendidikan`, `sex`, `tempat_lahir`, `tanggal_lahir`, `gelar`, `jenis_auditor`, `email`, `phone`, `nip`, `jabatan`, `pangkat`, `ruang`, `sertifikat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(35, 'DWI', 'FADJARWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'fadjarwati.dwi@gmail.com', '08xxxxxxx', '196601141991032007', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$53xZN8gKUCI0l.mYt9BkSuWVrtF/yZOpSI8nmDjcuVHJU5SNr4IJW', NULL, '2019-09-11 01:39:02', '2019-09-18 23:44:34'),
(27, 'ANDJAR', 'SURJADIANTO', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": null}', 'Laki-laki', '-', '2019-09-29 17:00:00', ', S.Sos.', NULL, 'bagusragilpahing@yahoo.co.id', '08xxxxxxx', '197009261990031005', 'Inspektur Kabupaten', 'IV/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$nZvR8A8sg6I8xhQGcPN4IOv3wYiXHN/4EyE14OFIDSK0fcrEJJ58i', NULL, '2019-09-11 00:58:04', '2020-07-27 20:17:47'),
(28, 'Dra. LAELY', 'WIDJAJATI', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-29 17:00:00', ', M.Si.', 'ahli', 'laelywidjajati@gmai.com', '08xxxxxxx', '196202021989032008', 'Auditor Madya', 'III/C', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$mOkShtf.pC.WhoOGo0hTU.b0sDaNrVhh0JFs/nWiqeqYEIbEtmucS', NULL, '2019-09-11 01:02:15', '2020-07-27 19:44:23'),
(29, 'Drs. PUJOSENO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"kosong\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SIP.', NULL, 'pujoseno_66@yahoo.com', '08xxxxxxx', '196610271986021002', 'Inspektur Pembantu Wilayah I', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$n1rn1XaZK8q93jctWAOYCuSnwtyJ1xan2XvIvoI8XZ9I4YiOtlzYi', NULL, '2019-09-11 01:19:09', '2019-09-18 23:38:54'),
(30, 'Drs. MADE', 'SUYARTA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'madesuyarta@gmail.com', '08xxxxxxx', '196703261994011003', 'Inspektur Pembantu Wilayah II', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tCc9wwA7QN094FakijktdelH.whvilTSQVOxGChNDTkA44LMe5T.2', NULL, '2019-09-11 01:21:15', '2019-09-11 01:21:15'),
(31, 'Drs. MUKHAMAD', 'KHUSAINI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', MM.', NULL, 'khus.dipendik@gmail.com', '08xxxxxxx', '196512131986061001', 'Inspektur Pembantu Wilayah III', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$QGGOtGtGxYCQFynT0vJDaeCPJLa1dduICEqB6dTmh8es32X.TbvQi', NULL, '2019-09-11 01:22:38', '2019-09-18 23:33:35'),
(32, 'Drs. MOCH.', 'SOLICHIN', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', NULL, NULL, 'solichin.mochama@gmail.com', '08xxxxxxx', '196811021990031003', 'Inspektur Pembantu Wilayah IV', 'IV/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$XMU2fhCxDtF2eo8KJdcKJu2lSG0imMrE9ABS9D0jU77pU0mp//5YC', NULL, '2019-09-11 01:25:03', '2020-09-21 02:18:52'),
(33, 'Drs. DANIEL', 'S TODING', '{\"tahun\": \"2000\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', ', M.AP', 'ahli', 'daniels.toding.dt@gmail.com', '08xxxxxxx', '196105051995031001', 'Auditor Madya', 'IV/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$aDu8sUiHhdoKcN1CCli8p.WOK3pCyX/z5f4ePus77oupUkCy8Aunm', NULL, '2019-09-11 01:28:20', '2020-07-27 20:08:27'),
(34, 'DAISY', 'ANDARWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-29 17:00:00', ', SE.', 'terampil', 'daisyandarwati@yahoo.com', '08xxxxxxx', '196312061994032003', 'Auditor Madya', 'IV/A', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$iOQ3hByIz/pK3zSZSwm4ge32Sj2CSgXGSTidrM1ydCtA3fT.87nZa', NULL, '2019-09-11 01:31:17', '2020-06-08 21:07:48'),
(36, 'SITI', 'LATIFAH', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-29 17:00:00', ', SH.', 'terampil', 'sitilatifah541@yahoo.co.id', '08xxxxxxx', '196208251983032007', 'Auditor Madya', 'IV/A', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$ee2I.Sq6YcuMOQ66.baMEeEAVk1h2RjUrlc6QjEVta/rMXzOo1Zf.', NULL, '2019-09-11 01:39:53', '2020-06-08 21:07:17'),
(37, 'SRI', 'WAHJUNINGTIYAS', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, Ak.', 'terampil', 'tyas.fnd@gmail.com', '08xxxxxxx', '197406281999032006', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$nRjKU2bq9Uq925fW1AxBA.qfaSdBUKGTzcw8FKS7U0fEmtNaSoBrC', NULL, '2019-09-11 01:41:03', '2019-09-18 23:46:48'),
(38, 'SUGIHARTI', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', ', S.Sos.', 'terampil', 'lidiasugiharti@yahoo.co.id', '08xxxxxxx', '196306141985082009', 'Auditor Madya', 'IV/A', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$GH/pnT4EbzQMiXbMFOWi1u.obMNzupfTicQlY1gllfbD/Cpa4ar3K', NULL, '2019-09-11 01:44:21', '2020-06-08 21:07:31'),
(39, 'WALUYANI', 'RETNA D', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST, MT.', 'ahli', 'luluyani@yahoo.com', '08xxxxxxx', '197310131998032006', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$oonDr6KE.x1xKF5jMTMzje7lldaiwZ/xOK3gs.tRZ3x8Kxc40RXuG', NULL, '2019-09-11 01:49:42', '2019-09-18 23:45:54'),
(40, 'SUSI', 'ROHMAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, MM.', 'ahli', 'aisfari@gmail.com', '08xxxxxxx', '197410171998032002', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Y2ajEHRpGcq0ChNu.4EDj.LeKT2Q6x5R6bI8qUOVgYIBXrW5P19E2', NULL, '2019-09-11 01:50:42', '2019-09-18 23:45:40'),
(41, 'HARI', 'SUNDJAJA', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos.', 'terampil', 'sudjajahari@yahoo.co.id', '08xxxxxxx', '196712051993021001', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5LKKIvra64Evjiixj1zw4O6awuJGCX/Mrx4LJFV4K01mJKwW/naY2', NULL, '2019-09-11 01:53:30', '2019-09-18 23:45:27'),
(42, 'I VERA', 'SIADINA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.STP, M.Si.', 'ahli', 'ivrasiadina@gmail.com', '08xxxxxxx', '197901271998032002', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$KvayPqqCut4S/uZWqFRqreXfkD7h1cT0Avxexz08QMkAD3ulNen1y', NULL, '2019-09-11 01:54:25', '2019-09-18 23:45:11'),
(43, 'HARI', 'SUSANTO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos, MM.', 'ahli', 'hari.faras@gmail.com', '08xxxxxxx', '197007261993021001', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$IKVd3Ksm3YRRh.LMCId40ONF4IMgbWWSL8VeVF0rCqe6KchIORHd.', NULL, '2019-09-11 02:02:11', '2019-09-18 23:44:55'),
(45, 'SU\'UDAH', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', NULL, 'suudah652@gmail.com', '082139734347', '196904231990032005', 'Kasubag Perencanaan', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$VyvgybFQx05R8K3Sm.AvAOj8OYezG7c8RhedENdXr6Xp0NaT7pyPK', NULL, '2019-09-11 08:56:20', '2019-09-11 08:56:20'),
(46, 'SRI WAHYUNI', 'INDRAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": null}', 'Perempuan', NULL, '2019-09-29 17:00:00', ',S.Sos', NULL, 'indrawatijasmin@gmail.com', '08123037679', '197105211994022002', 'Kasubag Administrasi dan Umum', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$lGRFaBiioP3g.YOUtrOLcuzYEge6GVnpy6.Ysj4eUf9l2mVnw4C3a', NULL, '2019-09-11 08:59:06', '2019-12-09 00:05:05'),
(47, 'PARTIWANGGARA', 'A', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SH.', NULL, 'itaagustinanamira@gmail.com', '081217907870', '197808012005012011', 'Kasubag Administrasi dan Umum', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$hMxGqZGPtwER/VMomUaLre.rJYuMR0NVmVDiUA8F68sC0oBi9dM9e', NULL, '2019-09-11 09:03:41', '2019-09-11 09:03:41'),
(48, 'SINGGIH', 'LAKSONO', '{\"tahun\": \"20xx\", \"jurusan\": \"Ekonomi\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'singgih_lackz82@yahoo.com', '08563577339', '198206262006041014', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$wbBwCBiDIZYpC2uipZmo2Oq/pGy0q1cVIWcVfiV4phl1Doh9feUiC', NULL, '2019-09-11 09:05:37', '2019-09-18 23:52:31'),
(49, 'AULIA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'terampil', 'auliasari_55@yahoo.com', '087728839138', '197909012006042023', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$g/CwYk4GIIj9QzsNIp8ogOw09MMDEc7fgogqlj4PGEBQIeijoosE6', NULL, '2019-09-11 09:09:05', '2019-09-18 23:51:52'),
(50, 'TIMUR', 'KARTIKA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', 'S, S.Kom.', 'terampil', 'kartika.timur@yahoo.co.id', '083831690903', '197510032006042016', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$HhUcs.Mq9LrE0tzs0gTJheYBqCr2StfnxjNheb2BCH710vaivVS6O', NULL, '2019-09-11 09:10:34', '2019-09-18 23:52:08'),
(51, 'ISNI', 'HIDAYATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.AB.', NULL, 'isni.hidayati@yahoo.com', '08123148165', '197303091998032008', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', NULL, '2019-09-11 09:13:26', '2019-09-11 09:13:26'),
(52, 'HENI', 'PURWITASARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, MM.', NULL, 'henipurwitasari1978@gmail.com', '085234324803', '197805081998092002', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5ylh6UyP5MK7ZPOcqvPD1ueOI/whyPRfimAUqDZd5rnRFtlGI3Dly', NULL, '2019-09-11 09:18:23', '2019-09-11 09:18:23'),
(53, 'DENNY WIDJAJA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.Sos.', NULL, 'dennywidjaja75@yahoo.com', '081330714130', '197505132009022001', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$rX9qDBeN5FfbyLuJ6OLEN.TTf1JF188OenQwK0gUIB2QGi54.WIQ6', NULL, '2019-09-11 09:19:25', '2019-09-11 09:19:25'),
(54, 'AMIK', 'MARIANA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'amik.mariana@yahoo.com', '087851008893', '197503042010012005', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$c6NFVrC3VOv5UUBhidA88.ctd2U/POkO/VJuufCsXYqbBr9YYA7QK', NULL, '2019-09-11 09:20:53', '2019-09-18 23:48:16'),
(55, 'RACHMA', 'HASNITA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'ahli', 'pradanarachma@yahoo.co.id', '081331414499', '197711172010012005', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$WB2ER1a7BIg3fvI/JlD1jOEH4M66BiV7cDcR3QIZ7exCb3ZXjsKNm', NULL, '2019-09-11 09:27:57', '2019-09-18 23:51:09'),
(56, 'DEVI', 'RESTINA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'terampil', 'dvrestina@gmail.com', '081232567706', '198103292010012015', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$WfRSdu3Sp45f4Z8NSpUBwO5P/7eV.ovB/6pPT0Nt8mAH/84220zKO', NULL, '2019-09-11 09:29:03', '2019-09-18 23:58:00'),
(57, 'NORMA', 'INDRAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'normadaren@gmail.com', '081231032009', '198408222010012025', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$zffIm4fTRebTm59EyqAEDeAXE/L3NmIbNqi63XgdXrb0auy072V2G', NULL, '2019-09-11 09:30:07', '2019-09-18 23:50:01'),
(58, 'YOGI', 'MAHARDHIKA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', ', ST.', 'terampil', 'yogi.mahardhika@gmail.com', '082143339774', '198507052010011017', 'Auditor Muda', 'III/C', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$TQIbyfz4iban.CcVuZv/E.XXHRj6XtbK0v6uVFpq24i.y8jIsTL1O', 'jVj6VMMcjQqtuAuGYNExyaVnVrUC0amVxuLPQUPzrmGysCpZQw1TUiH9SNGb', '2019-09-11 09:30:54', '2020-06-14 22:59:36'),
(59, 'VIRANI RAKHMA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'emailnyarani.via@gmail.com', '081235465558', '198508302010012025', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$OQsjWkA2X8JgU9wz.PDBs.jvWwDT9.hoa7yqez7y.Vm3WOZXYlKde', NULL, '2019-09-11 09:34:53', '2019-09-18 23:48:39'),
(60, 'MARIANINGSIH', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'mariaimam76@gmail.com', '081330631871', '197607071996022002', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tw7fqph2uh.xW44R/RWrrOCiU82QUgoCwk7o73baK8NihJsOxQFpi', NULL, '2019-09-11 09:35:44', '2019-09-18 23:48:55'),
(61, 'HARIYANTO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', ', SH.', 'terampil', 'hary.zildan1020@gmail.com', '081311108484', '198406202011011012', 'Auditor Muda', 'III/C', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$kMTlx1ZYagQMJvtjedgvg.EN1arEPCSRYX1Tf3EZ.IDOy2a3xrsMa', NULL, '2019-09-11 09:36:55', '2020-11-01 23:48:34'),
(62, 'YAYUK', 'INDAYATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE', NULL, 'yayukasri065@gmail.com', '081332215030', 'YAYUKINDAYATI,SE', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$S2cH.Zis1O5K8oKTz6WGM.kFC5an66Y4xTw.V/8YLryRborXJXlzK', NULL, '2019-09-11 09:39:02', '2019-09-11 09:39:02'),
(63, 'SULUH JATMIKA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'suluh_ika@yahoo.co.id', '081330594915', '198305112010012022', 'Auditor Muda', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$e3SjCDB6R5Ydhuo4MtPmw.YcaI0tJwaHBNmSJF3LBXjUQ8kze/HOK', NULL, '2019-09-11 09:40:11', '2019-09-18 23:49:33'),
(64, 'MOCHAMAD', 'ARTFIANDO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SH.', 'terampil', 'ando.munir@yahoo.co.id', '081330032590', '198006042010011009', 'Auditor Pertama', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$UWRfxWG8IFCsHtK6vwqw4.I4VdLPuplhvWRSyRfUKO.52pcEg4nj2', NULL, '2019-09-11 09:41:40', '2019-09-18 23:52:55'),
(65, 'SUCI', 'NINGHERI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": null}', 'Perempuan', NULL, '2019-09-29 17:00:00', NULL, NULL, 'uciksutanto@gmail.com', '085258238127', '196401151988112001', 'Pengadministrasi Umum', 'III/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Ts2fHuYK7JGfRCiIXapWT.SIY5cJm0fCE7jQDDmVHpYO78CV0OVSi', NULL, '2019-09-11 09:42:58', '2020-06-08 21:08:02'),
(66, 'UDIN', 'KARYONO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos', NULL, 'udinksidoarjo@gmail.com', '085236544088', '196610251991011001', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$V2eDJ7w1Al6gFsv2rIIBU.fbJRjmb1Yw8akC6Ht0y8prgLrhesjBO', NULL, '2019-09-11 09:47:55', '2019-09-18 23:38:18'),
(67, 'AGUS', 'GUFRONI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', NULL, NULL, 'agusgufroni@gmail.com', '081330448864', '196508301993031009', 'Pengadministrasi Umum', 'III/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$CSPKPCjijf7Lm77b0XNrceAcn2Jsvf3HUEzyOY6sCRGea/N/E4j4a', NULL, '2019-09-11 09:49:03', '2020-06-08 21:08:17'),
(68, 'HENI', 'RESNAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', 'kosong', NULL, 'heni.resnawati14@gmail.com', '08123095018', '197212141995032001', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$s/nI9G4NeTjGvaYUcQinR.ST/EaiveqSGI1.Xmqg.AyzyHgFt.7Ba', NULL, '2019-09-11 09:51:19', '2019-09-11 09:51:19'),
(69, 'IKA SAFITRI', 'NINGSIH', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', '. S.Si', 'terampil', 'ikasafi3@yahoo.co.id', '08563224858', '198705202015022001', 'Auditor Pertama', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$St0fvi9casnxSw28TOKuc.99UdX3GY1EsPWrdKDduICWtLFuVOkDO', NULL, '2019-09-11 10:02:34', '2019-09-18 23:53:22'),
(85, 'Deni', 'Iswantoro', '{\"tahun\": \"2005\", \"jurusan\": \"Manajemen\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', 'Ponorogo', '1985-07-12 17:00:00', 'MM', 'ahli', 'iswanto-ro@gmail.com', '351351351', '92876546852864289', 'Auditor Utama', 'I/D', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$0GM/1l7n3XHzcfK7maBE2e2BGTHtpOXym5Scn5yptYx53RpVoTon6', NULL, '2019-11-10 19:50:50', '2020-06-08 21:04:42'),
(84, 'Muhammad', 'Ismail', '{\"tahun\": \"2005\", \"jurusan\": \"Pendayagunaan Energi Rohani\", \"tingkat\": \"Doktor (S3)\"}', 'Laki-laki', 'Sidoarjo', '1985-10-11 17:00:00', 'PHd', 'terampil', 'ismail@gmail.com', '+623876543', '6545454548', 'Auditor Utama', 'I/D', '{\"nama\": \"IRBAN III\", \"jabatan\": \"kepala\"}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$ciKMbKXJ0Xnlw3Sq5/4I6O3HdbwXIF0xhpLI5dZmrAQvzZTXPi7Oy', NULL, '2019-11-10 19:47:44', '2019-11-10 19:47:44'),
(81, 'Ahmad', 'Ardiansyah', '{\"tahun\": \"2010\", \"jurusan\": \"Sarjana Manajemen Airlangga\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', 'Surabaya', '1980-11-25 17:00:00', 'MM', 'terampil', 'ardi@gmail.com', '+628997766554', '567.890.21.345', 'Auditor Muda', 'II/A', '{\"nama\": \"IRBAN II\", \"jabatan\": \"anggota\"}', '{\"1\": {\"name\": \"Pemberdayaan Manusia\", \"tahun\": \"2012\", \"instansi\": \"Diknas\"}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$UnKFGwdJnqZylyXqQ2sZcOCoIlynlqG.UUBQwHxVfaobowapz79xC', NULL, '2019-10-30 00:17:09', '2019-12-15 20:18:58'),
(6, 'Super', 'Admin', NULL, NULL, NULL, '2019-06-18 05:32:57', NULL, NULL, 'admin@local.host', 'admin@local.host', '999999999', 'Inspektur Kabupaten', 'I/A', NULL, NULL, NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', 'UGr4Gmv4N0BYfnzqeN6GOeucICLdULrqWfCSLh3ZU6l1yqmZzmR0BjyskBsG', '2019-06-18 05:32:57', '2019-06-18 05:32:57'),
(87, 'Administrasi', 'Perencanaan', '{\"tahun\": \"20xx\", \"jurusan\": null, \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Laki-laki', 'Sidoarjo', '1995-07-17 17:00:00', ', ST.', NULL, 'perencanaan@gmail.com', '08214333978888', '19850705201088888999', 'Kasubag Perencanaan', 'II/A', '{\"nama\": null, \"jabatan\": null}', NULL, NULL, '$2y$10$.Yd35LaLJ4WGEoop1iAhOeBa4.uwSCPEPQQI6PL6YDnliAlUyuCA.', NULL, '2020-07-06 23:57:48', '2020-07-06 23:57:48'),
(88, 'YUSTINA TRI', 'PRASTIWI', '{\"tahun\": null, \"jurusan\": null, \"tingkat\": null}', 'Perempuan', '-', '2020-10-31 17:00:00', ', S.AP', NULL, 'inspektorat@gmail.com', '081331484181', '19700509 199003 2 004', 'Sekretaris', 'IV/A', '{\"nama\": null, \"jabatan\": null}', NULL, NULL, '$2y$10$ZobB.SPpedcE5MUnH3TloeVqW2jINavTpCWat8Zn.yr.GNSW9nF8O', NULL, '2020-11-02 21:32:43', '2020-11-05 00:06:18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
