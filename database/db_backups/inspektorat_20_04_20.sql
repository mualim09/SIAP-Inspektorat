-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 02 Apr 2020 pada 05.22
-- Versi server: 5.7.24
-- Versi PHP: 7.1.26

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
-- Struktur dari tabel `detail_spt`
--

DROP TABLE IF EXISTS `detail_spt`;
CREATE TABLE IF NOT EXISTS `detail_spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `peran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` int(11) DEFAULT NULL,
  `dupak` double(8,2) DEFAULT NULL,
  `file_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif ketika disetujui, stored jika update nomor spt dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_spt`
--

INSERT INTO `detail_spt` (`id`, `spt_id`, `user_id`, `peran`, `lama`, `dupak`, `file_laporan`, `kode`, `jenis_laporan`, `status`, `status_dupak`, `unsur_dupak`) VALUES
(12, 4, 54, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 4, 67, 'Supervisor', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 3, 81, 'Supervisor', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 27, 'Pengendali Teknis', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 3, 34, 'Pengendali Teknis', NULL, 1.46, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 4, 49, 'Ketua Tim', NULL, 0.26, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 5, 54, 'Supervisor', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 5, 67, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 6, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 6, 38, 'Pembantu Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 6, 59, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 6, 62, 'Ketua Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 6, 58, 'Anggota Tim', NULL, 0.26, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 6, 49, 'Pengendali Teknis', NULL, 0.62, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 8, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 8, 54, 'Pembantu Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 8, 34, 'Pengendali Mutu', NULL, 0.62, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 8, 49, 'Pengendali Teknis', NULL, 0.47, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 8, 85, 'Ketua Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 8, 56, 'Anggota Tim', NULL, 0.20, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 9, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 10, 54, 'Supervisor', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 11, 67, 'Supervisor', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 11, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 11, 49, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 12, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 12, 81, 'Pembantu Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 12, 49, 'Pengendali Teknis', NULL, 0.94, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 14, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 14, 28, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 14, 41, 'Pengendali Teknis', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 14, 61, 'Ketua Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 14, 67, 'Anggota Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 15, 27, 'Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 15, 28, 'Pembantu Penanggungjawab', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 15, 33, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 15, 31, 'Pengendali Teknis', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 15, 42, 'Ketua Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 15, 59, 'Anggota Tim', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 16, 81, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 16, 67, 'Pengendali Mutu', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dupak`
--

DROP TABLE IF EXISTS `dupak`;
CREATE TABLE IF NOT EXISTS `dupak` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `dupak` float(10,2) NOT NULL,
  `unsur_dupak` varchar(191) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dupak`
--

INSERT INTO `dupak` (`id`, `user_id`, `dupak`, `unsur_dupak`, `status`, `created_at`, `updated_at`) VALUES
(62, 57, 100.00, 'pendidikan', 'lama', '2019-09-18 23:50:01', '2019-09-18 23:50:01'),
(61, 58, 100.00, 'pendidikan', 'lama', '2019-09-18 23:49:50', '2019-09-18 23:49:50'),
(60, 63, 100.00, 'pendidikan', 'lama', '2019-09-18 23:49:33', '2019-09-18 23:49:33'),
(59, 61, 100.00, 'pendidikan', 'lama', '2019-09-18 23:49:11', '2019-09-18 23:49:11'),
(58, 60, 100.00, 'pendidikan', 'lama', '2019-09-18 23:48:55', '2019-09-18 23:48:55'),
(57, 59, 100.00, 'pendidikan', 'lama', '2019-09-18 23:48:39', '2019-09-18 23:48:39'),
(56, 54, 100.00, 'pendidikan', 'lama', '2019-09-18 23:48:16', '2019-09-18 23:48:16'),
(55, 34, 100.00, 'pendidikan', 'lama', '2019-09-18 23:47:31', '2019-09-18 23:47:31'),
(54, 37, 100.00, 'pendidikan', 'lama', '2019-09-18 23:46:48', '2019-09-18 23:46:48'),
(53, 38, 100.00, 'pendidikan', 'lama', '2019-09-18 23:46:30', '2019-09-18 23:46:30'),
(52, 39, 150.00, 'pendidikan', 'lama', '2019-09-18 23:45:54', '2019-09-18 23:45:54'),
(51, 40, 150.00, 'pendidikan', 'lama', '2019-09-18 23:45:40', '2019-09-18 23:45:40'),
(50, 41, 100.00, 'pendidikan', 'lama', '2019-09-18 23:45:27', '2019-09-18 23:45:27'),
(49, 42, 150.00, 'pendidikan', 'lama', '2019-09-18 23:45:11', '2019-09-18 23:45:11'),
(48, 43, 150.00, 'pendidikan', 'lama', '2019-09-18 23:44:55', '2019-09-18 23:44:55'),
(47, 35, 100.00, 'pendidikan', 'lama', '2019-09-18 23:43:51', '2019-09-18 23:44:34'),
(46, 36, 100.00, 'pendidikan', 'lama', '2019-09-18 23:39:40', '2019-09-18 23:44:15'),
(41, 28, 150.00, 'pendidikan', 'lama', '2019-09-18 23:30:34', '2019-09-18 23:30:34'),
(40, 33, 150.00, 'pendidikan', 'lama', '2019-09-18 23:29:50', '2019-09-18 23:29:50'),
(63, 56, 100.00, 'pendidikan', 'lama', '2019-09-18 23:50:16', '2019-09-18 23:58:00'),
(64, 55, 150.00, 'pendidikan', 'lama', '2019-09-18 23:51:09', '2019-09-18 23:51:09'),
(65, 49, 100.00, 'pendidikan', 'lama', '2019-09-18 23:51:33', '2019-09-18 23:51:33'),
(66, 50, 100.00, 'pendidikan', 'lama', '2019-09-18 23:52:08', '2019-09-18 23:52:08'),
(67, 48, 100.00, 'pendidikan', 'lama', '2019-09-18 23:52:31', '2019-09-18 23:52:31'),
(68, 64, 100.00, 'pendidikan', 'lama', '2019-09-18 23:52:55', '2019-09-18 23:52:55'),
(69, 69, 100.00, 'pendidikan', 'lama', '2019-09-18 23:53:22', '2019-09-18 23:53:22'),
(71, 70, 100.00, 'pendidikan', 'lama', '2019-09-23 23:33:52', '2019-09-23 23:33:52'),
(72, 70, 150.00, 'pendidikan', 'baru', '2019-09-23 23:39:48', '2019-09-23 23:39:48'),
(73, 71, 100.00, 'pendidikan', 'lama', '2019-09-24 00:06:04', '2019-09-24 00:06:04'),
(74, 71, 150.00, 'pendidikan', 'baru', '2019-09-24 00:09:20', '2019-09-24 00:09:20'),
(75, 73, 200.00, 'pendidikan', 'lama', '2019-10-09 20:25:21', '2019-10-09 20:25:21'),
(76, 74, 200.00, 'pendidikan', 'lama', '2019-10-09 20:26:41', '2019-10-09 20:26:41'),
(77, 73, 200.00, 'pendidikan', 'baru', '2019-10-09 21:07:36', '2019-10-09 21:07:36'),
(78, 75, 0.00, 'pendidikan', 'lama', '2019-10-14 21:04:31', '2019-10-14 21:04:31'),
(92, 54, 10.00, 'penunjang', 'baru', '2019-11-10 19:12:26', '2019-11-10 19:12:26'),
(83, 54, 51.00, 'penunjang', 'lama', '2019-10-23 00:29:15', '2019-11-10 19:12:26'),
(84, 76, 100.00, 'pendidikan', 'lama', '2019-10-28 18:56:12', '2019-10-28 18:56:12'),
(85, 77, 150.00, 'pendidikan', 'lama', '2019-10-28 19:30:22', '2019-10-28 19:30:22'),
(86, 78, 200.00, 'pendidikan', 'lama', '2019-10-29 19:58:36', '2019-10-29 19:58:36'),
(87, 79, 200.00, 'pendidikan', 'lama', '2019-10-29 20:04:02', '2019-10-29 20:04:02'),
(88, 80, 200.00, 'pendidikan', 'lama', '2019-10-29 20:09:00', '2019-10-29 20:09:00'),
(89, 81, 150.00, 'pendidikan', 'lama', '2019-10-30 00:17:09', '2019-10-30 00:17:09'),
(90, 82, 60.00, 'pendidikan', 'baru', '2019-11-07 00:54:13', '2019-11-07 00:54:13'),
(91, 83, 200.00, 'pendidikan', 'lama', '2019-11-07 00:58:27', '2019-11-07 00:58:27'),
(93, 84, 0.00, 'pendidikan', 'lama', '2019-11-10 19:47:44', '2019-11-10 19:47:44'),
(94, 85, 150.00, 'pendidikan', 'lama', '2019-11-10 19:50:50', '2019-11-10 19:50:50'),
(95, 81, 100.00, 'pendidikan', 'baru', '2019-12-15 20:05:07', '2019-12-15 20:05:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
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
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `events`
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
(100, 'Riktu', '2020-03-27 00:00:00', '2020-04-04 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": \"15\", \"user_id\": 6}', '2020-03-25 20:18:47', '2020-03-25 20:31:09'),
(88, 'Evaluasi SAKIP', '2020-03-20 00:00:00', '2020-03-27 00:00:00', '{\"type\": \"spt\", \"jenis\": \"pengawasan\", \"spt_id\": 14, \"user_id\": 6}', '2020-03-17 20:13:47', '2020-03-17 20:13:47'),
(95, 'Cuti Bersama', '2020-04-28 00:00:00', '2020-04-29 00:00:00', NULL, '2020-03-18 22:32:27', '2020-03-18 22:32:27'),
(96, 'Cuti lagi', '2020-04-22 00:00:00', '2020-04-23 00:00:00', NULL, '2020-03-18 22:33:44', '2020-03-18 22:33:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_spt`
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_spt`
--

INSERT INTO `jenis_spt` (`id`, `sebutan`, `name`, `dasar`, `kode_kelompok`, `input`, `radio`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Perceraian', 'Gugatan  Perceraian Pegawai Negeri Sipil', 'izin:Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 4 November 2019 Nomor : 800/2875/438.6.4/2019, perihal Permohonan Izin Melakukan Perceraian Pegawai Negeri Sipil.\r\nketerangan:Surat  Kepala  Badan  Kepegawaian Daerah Kabupaten Sidoarjo tanggal 14  Agustus  2019 Nomor : x.800/69/438.6.4/2019, perihal Permohonan Surat Keterangan Adanya Gugatan Perceraian Pegawai Negeri Sipil.', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": \"Izin melakukan perceraian\", \"2\": \"Surat keterangan cerai\"}', 'pengawasan', '2020-02-23 23:21:28', '2020-03-10 21:22:42'),
(8, 'Audit Operasional', 'Audit Operasional', 'Undang - Undang Republik Indonesia Nomor 9 Tahun 2015 tentang perubahan kedua atas Undang-undang Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 61 Tahun 2019 tentang Perencanaan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2020;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2020;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 20:55:36', '2020-03-08 19:49:31'),
(7, 'Evaluasi SAKIP', 'Evaluasi  Implementasi  Sistem Akuntabilitas  Kinerja  Instansi  Pemerintah (SAKIP)', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik  Indonesia Nomor 12 Tahun 2017     tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Presiden Nomor 29 Tahun 2014 tentang Sistem Akuntabilitas Kinerja Instansi Pemerintah;\r\nPeraturan Menteri  Pendayagunaan Aparatur Negara Nomor 12 Tahun 2015 tentang Pedoman Evaluasi Atas Implementasi SAKIP;\r\nPeraturan Menteri Dalam  Negeri Nomor  35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan Bupati Nomor 19 Tahun 2016 tentang Petunjuk Pelaksanaan Evaluasi atas Implementasi  Sistem  Akuntabilitas  Kinerja Instansi Pemerintah (SAKIP) di Lingkungan Pemerintah Kabupaten Sidoarjo;\r\nPeraturan Bupati Nomor 45 Tahun 2017 tentang Perubahan atas Peraturan Bupati Nomor 19 Tahun 2016;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 20:39:09', '2020-02-26 20:39:09'),
(2, 'Riktu', 'Pemeriksaan dengan tujuan tertentu', 'Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;\r\nPeraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-23 23:33:29', '2020-02-26 23:28:58'),
(3, 'TGR', 'pemeriksaan dalam rangka Proses Tuntutan Ganti Rugi atas kehilangan barang milik daerah', 'Surat Sekretariat Daerah Kabupaten Sidoarjo tanggal 19  Juni  2019 Nomor : 950/5374/438.6.2/2019, perihal Penyelesaian Tuntutan Ganti Rugi (TGR) atas Kehilangan Barang Milik Daerah.', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-23 23:37:33', '2020-02-26 21:02:56'),
(4, 'PKKN', 'Audit Penghitungan Kerugian Keuangan Negara terhadap dugaan tindak pidana korupsi', 'Surat Kepala Kepolisian Resort Kota Sidoarjo tanggal 10  April 2019 Nomor : B/1110/IV. Res.3.3/2019/Satreskrim, perihal Permintaan Bantuan Audit Penghitungan Kerugian Keuangan Negara.', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-24 00:29:24', '2020-02-26 21:02:23'),
(6, 'Audit Kinerja', 'Audit Kinerja', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan Menteri Pendayagunaan Aparatur Negara Nomor : PER/05/M.PAN/03/2008 tanggal 31 Maret 2008 tentang Standar Audit Aparat Pengawasan Intern Pemerintah;\r\nPeraturan Pemerintah Nomor 60 Tahun 2008 tentang Sistem Pengendalian Intern Pemerintah;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-24 18:38:27', '2020-02-26 20:32:00'),
(9, 'Evaluasi PMPRB', 'Evaluasi dan Verifikasi Penilaian Mandiri Pelaksanaan Reformasi Birokrasi (PMPRB)', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Republik Indonesia Nomor 30 Tahun 2018 tentang Perubahan Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 14 Tahun 2014 tentang Pedoman Evaluasi Reformasi Birokrasi Instansi Pemerintah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:17:19', '2020-02-26 23:17:19'),
(10, 'Konsulting', 'Konsulting', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:20:12', '2020-02-26 23:20:12'),
(11, 'Monev', 'Monitoring dan Evaluasi', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:23:31', '2020-02-26 23:23:31'),
(12, 'Monev Fisik', 'Monitoring dan Evaluasi fisik', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:24:29', '2020-02-26 23:24:29'),
(13, 'Monitoring dan Verifikasi', 'Monitoring dan Verifikasi', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:25:22', '2020-02-26 23:25:22'),
(14, 'Monitoring LHKASN', 'monitoring Laporan Harta Kekayaan Aparatur Sipil Negara LHKASN', 'Surat Edaran Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 54 Tahun 2019 tanggal 22 Pebruari 2019 tentang Penyampaian Laporan Instansi Pemerintah dan Laporan Harta Kekayaan Aparatur Sipil Negara;\r\nSurat Sekretaris Daerah tanggal 11 April 2019 Nomor : 700/3253/438.4/2019 perihal Penyampaian Laporan Harta Kekayaan Aparatur Sipil Negara (LHKASN);', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:27:07', '2020-02-26 23:27:07'),
(15, 'Monitoring SPIP', 'Monitoring Peningkatan Maturitas Sistem Pengendalian Intern Pemerintah (SPIP)', 'Peraturan Pemerintah Nomor 60 Tahun 2008 tentang Sistem Pengendalian Intern Pemerintah (SPIP);\r\nPeraturan Kepala BPKP Nomor 4 Tahun 2016 tentang Pedoman Penilaian dan Strategi Peningkatan Maturitas SPIP;\r\nPeraturan Bupati Sidoarjo Nomor 48 Tahun 2016 tentang Penyelenggaraan Sistem Pengendalian Intern Pemerintah di Lingkungan Pemerintah Kabupaten Sidoarjo;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:28:14', '2020-02-26 23:28:14'),
(16, 'Probity Audit', 'Probity Audit', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:30:14', '2020-02-26 23:30:14'),
(17, 'Reviu (DAK) Fisik', 'Reviu Dana Alokasi Khusus (DAK) Fisik', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-02-26 23:31:29', '2020-02-26 23:31:29'),
(18, 'Reviu LKPD', 'Reviu Laporan Keuangan Pemerintah Daerah (LKPD)', 'Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;\r\nPeraturan Negeri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nPeraturan Pemerintah Nomor 8 Tahun 2006 tentang Laporan Keuangan dan Kinerja Instansi Pemerintah;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-10 23:48:24', '2020-03-10 23:48:24'),
(19, 'Evaluasi Hibah', 'Evaluasi Hibah', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:48:39', '2020-03-12 19:48:39'),
(20, 'Monitoring PKD', 'Monitoring Pengelolaan Keuangan Desa', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:50:02', '2020-03-12 19:50:02'),
(21, 'Reviu RKPD', 'Reviu Rencana Kerja Pemerintah  Daerah (RKPD)', 'Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 86 Tahun 2017 tentang Tata Cara Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah, Tata Cara Evaluasi Rancangan Peraturan Daerah tentang Rencana Pembangunan Jangka Panjang Daerah dan Rencana Pembangunan Jangka Menengah Daerah, serta Tata Cara Perubahan Rencana Pembangunan Jangka Panjang Daerah, Rencana Pembangunan Jangka Menengah Daerah, dan Rencana Kerja Pemerintah Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 10 Tahun 2018 tentang Reviu atas Dokumen Perencanaan Pembangunan dan Anggaran Tahunan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:52:25', '2020-03-12 19:52:25'),
(22, 'Reviu RKAP', 'Reviu Rencana Kerja dan Anggaran Perubahan (RKAP)  SKPD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 79 Tahun 2005     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor  110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;\r\nPeraturan Menteri Dalam Negeri Nomor 33 Tahun 2017 tentang Pedoman Penyusunan APBD Tahun Anggaran 2018;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:55:34', '2020-03-12 19:55:34'),
(23, 'Reviu RKA', 'Reviu Rencana Kerja dan Anggaran (RKA) PAPBD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri  Nomor 35  Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan Menteri Dalam Negeri Nomor  38 Tahun  2018 tentang Pedoman Penyusunan APBD Tahun Anggaran 2019;\r\nPeraturan Menteri Dalam Negeri Nomor  10 Tahun 2018 tentang Reviu Atas Dokumen Perencanaan Pembangunan dan Anggaran Daerah Tahunan;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:56:48', '2020-03-12 19:56:48'),
(24, 'Reviu LKIP', 'Reviu Laporan Kinerja Instansi Pemerintah', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nPeraturan Menteri Pendayagunaan Aparatur Negara Nomor 53 Tahun 2014 tentang Petunjuk Teknis Perjanjian Kinerja, Pelaporan Kinerja dan Tata Cara Reviu Atas Laporan Kinerja Instansi Pemerintah;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;\r\nUndangan Sekretaris Daerah Kabupaten Sidoarjo tanggal 20 Maret 2019 Nomor : 130/2452/438.1.2.2/2019 perihal Review atas Laporan Kinerja Instansi Pemerintah (LkjIP) Kabupaten Sidoarjo Tahun 2018;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:57:58', '2020-03-12 19:57:58'),
(25, 'RKA APBD', 'Reviu RKA – APBD TA. 2020/ RKA - PPKD 2020', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri  Nomor  35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan  Menteri Dalam  Negeri Nomor 38 Tahun 2018 tentang Pedoman Penyusunan APBD Tahun Anggaran 2019;\r\nPeraturan Menteri Dalam Negeri  Nomor 10 Tahun 2018 tentang Reviu Atas Dokumen Perencanaan Pembangunan dan Anggaran Daerah Tahunan;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 19:59:03', '2020-03-12 19:59:03'),
(26, 'Reviu RKPD Tahun 2020', 'Reviu Rencana Kerja Perangkat Daerah Tahun 2020', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 20:03:17', '2020-03-12 20:03:17'),
(27, 'Reviu SOP', 'Reviu Standart Operasional Prosedure (SOP)', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nStandar Audit Aparat Pengawasan Intern Pemerintah (Asosiasi Auditor Intern Pemerintah Indonesia/AAIPI);\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2020;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 20:04:29', '2020-03-12 20:04:29'),
(28, 'Penyusunan SOP SAKIP', 'Penyusunan  Standard  Operating  Procedure (SOP) Evaluasi Implementasi Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) OPD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nKeputusan Asosiasi Auditor Intern Pemerintah Indonesia (AAIPI) Nomor : KEP-005/AAIPI/DPN/2014 tentang Pemberlakuan Kode Etik Auditor Intern Pemerintah Indonesia, Standart Audit Intern Pemerintah Indonesia, Dan Pedoman Telaah Sejawat Auditor Intern Pemerintah Indonesia;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 20:05:46', '2020-03-12 20:05:46'),
(29, 'Telaah Sejawat', 'Telaah Sejawat', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;\r\nStandar Audit Aparat Pengawasan Intern Pemerintah (Asosiasi Auditor Intern Pemerintah Indonesia/AAIPI);\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 20:06:55', '2020-03-12 20:06:55'),
(30, 'Verifikasi dan Validasi (VERVAL)', 'Verifikasi dan Validasi', 'Peraturan Pemerintah Republik Indonesia Nomor 6 Tahun 2008     tentang Pedoman Evaluasi Penyelenggaraan Pemerintahan Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 13 Tahun 2019     tentang Laporan dan Evaluasi Penyelenggaraan Pemerintah Daerah;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', NULL, '2020-03-12 20:08:10', '2020-03-12 20:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_temuan`
--

DROP TABLE IF EXISTS `kode_temuan`;
CREATE TABLE IF NOT EXISTS `kode_temuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `deskripsi` varchar(499) NOT NULL,
  `atribut` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_temuan`
--

INSERT INTO `kode_temuan` (`id`, `parent_id`, `kode`, `deskripsi`, `atribut`) VALUES
(1, 0, '1', 'Temuan Ketidakpatuhan Terhadap Peraturan', '{\"kelompok\": null, \"subkelompok\": null}'),
(2, 0, '2', 'Temuan kelemahan sistem pengendalian intern', '{\"kelompok\": null, \"subkelompok\": null}'),
(3, 0, '3', 'Temuan 3E', '{\"kelompok\": null, \"subkelompok\": null}'),
(4, 1, '01', 'Kerugian negara/daerah atau kerugian negara/daerah\r\nyang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(5, 4, '02', 'Rekanan pengadaan barang/jasa tidak menyelesaikan pekerjaan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(6, 4, '03', 'Kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(7, 4, '04', 'Kelebihan pembayaran selain kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(8, 4, '05', 'Pemahalan harga (Mark up)', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(9, 4, '06', 'Penggunaan uang/barang untuk kepentingan pribadi', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(10, 4, '07', 'Pembayaran honorarium dan/atau biaya perjalanan dinas ganda dan/atau melebihi standar yang ditetapkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(11, 4, '08', 'Spesifikasi barang/jasa yang diterima tidak sesuai dengan kontrak', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(12, 4, '09', 'Belanja tidak sesuai atau melebihi ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(13, 4, '10', 'Pengembalian pinjaman/piutang atau dana bergulir macet', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(14, 4, '11', 'Kelebihan penetapan dan pembayaran restitusi pajak atau penetapan kompensasi kerugian', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(15, 4, '12', 'Penjualan/pertukaran/penghapusan aset negara/daerah tidak sesuai ketentuan dan merugikan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(16, 4, '13', 'Pengenaan ganti kerugian negara belum/tidak dilaksanakan sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(17, 4, '14', 'Entitas belum/tidak melaksanakan tuntutan perbendaharaan (TP) sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(18, 4, '15', 'Penghapusan hak tagih tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(19, 4, '16', 'Pelanggaran ketentuan pemberian diskon penjualan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(20, 4, '17', 'Penentuan HPP (harga pokok pembelian) terlalu rendah sehingga penentuan harga jual lebih rendah dari yang seharusnya', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(21, 4, '18', 'Jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak dapat dicairkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(22, 4, '19', 'Penyetoran penerimaan negara/daerah dengan bukti fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(25, 1, '02', 'Potensi kerugian negara/daerah atau kerugian negara/daerah yang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(26, 25, '01', 'Kelebihan pembayaran dalam pengadaan barang/jasa tetapi pembayaran pekerjaan belum dilakukan sebagian atau seluruhnya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(27, 25, '02', 'Rekanan belum melaksanakan kewajiban pemeliharaan barang hasil pengadaan yang telah rusak selama masa pemeliharaan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(28, 25, '03', 'Aset dikuasai pihak lain', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(29, 25, '04', 'Pembelian aset yang berstatus sengketa', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(30, 25, '05', 'Aset tidak diketahui keberadaannya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(31, 25, '06', 'Pemberian jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(32, 25, '07', 'Pihak ketiga belum melaksanakan kewajiban untuk menyerahkan aset kepada negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(33, 25, '08', 'Piutang/pinjaman atau dana bergulir yang berpotensi tidak tertagih', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(34, 25, '09', 'Penghapusan piutang tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(35, 25, '10', 'Pencairan anggaran pada akhir tahun anggaran untuk pekerjaan yang belum selesai', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(36, 1, '03', 'Kekurangan penerimaan negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(37, 36, '01', 'Penerimaan negara/daerah atau denda keterlambatan pekerjaan belum/tidak ditetapkan dipungut/diterima/disetor ke kas negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(38, 36, '02', 'Penggunaan langsung penerimaan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(39, 36, '03', 'Dana Perimbangan yang telah ditetapkan belum masuk ke kas daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(40, 36, '04', 'Penerimaan negara/daerah diterima atau digunakan oleh instansi yang tidak berhak', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(41, 36, '05', 'Pengenaan tarif pajak/PNBP lebih rendah dari ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(42, 36, '06', 'Koreksi perhitungan bagi hasil dengan KKKS', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(43, 36, '07', 'Kelebihan pembayaran subsidi oleh pemerintah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(44, 1, '04', 'Administrasi', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(45, 44, '01', 'Pertanggungjawaban tidak akuntabel (bukti tidak lengkap/tidak valid)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(46, 44, '02', 'Pekerjaan dilaksanakan mendahului kontrak atau penetapan anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(47, 44, '03', 'Proses pengadaan barang/jasa tidak sesuai ketentuan (tidak menimbulkan kerugian negara)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(48, 44, '04', 'Pemecahan kontrak untuk menghindari pelelangan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(49, 44, '05', 'Pelaksanaan lelang secara performa', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(50, 44, '06', 'Penyimpangan terhadap peraturan perundang-undangan bidang pengelolaan perlengkapan atau barang milik negara/daerah/perusahaan\r\n', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(51, 44, '07', 'Penyimpangan terhadap peraturan perundang-undangan bidang tertentu lainnya seperti kehutanan, pertambangan, perpajakan, dll', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(52, 44, '08', 'Koreksi perhitungan subsidi/kewajiban pelayanan umum', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(53, 44, '09', 'Pembentukan cadangan piutang, perhitungan penyusutan atau amortisasi tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(54, 44, '10', 'Penyetoran penerimaan negara/daerah atau kas di bendaharawan ke kas negara/daerah melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(55, 44, '11', 'Pertanggungjawaban/penyetoran uang persediaan melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(56, 44, '12', 'Sisa kas di bendahara pengeluaran akhir tahun anggaran belum/tidak disetor ke kas negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(57, 44, '13', 'Pengeluaran investasi pemerintah tidak didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(58, 44, '14', 'Kepemilikan aset tidak/belum didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(59, 44, '15', 'Pengalihan anggaran antar MAK tidak sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(60, 44, '16', 'Pelampauan pagu anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(61, 1, '05', 'Indikasi tindak pidana', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(62, 61, '01', 'Indikasi tindak pidana korupsi', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(63, 61, '02', 'Indikasi tindak pidana perbankan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(64, 61, '03', 'Indikasi tindak pidana perpajakan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(65, 61, '04', 'Indikasi tindak pidana kepabeanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(66, 61, '05', 'Indikasi tindak pidana kehutanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(67, 61, '06', 'Indikasi tindak pidana pasar modal', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(68, 61, '07', 'Indikasi tindak pidana khusus lainnya', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(69, 2, '01', 'Kelemahan sistem pengendalian akuntansi dan pelaporan', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(70, 69, '01', 'Pencatatan tidak/belum dilakukan atau tidak akurat', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(71, 69, '02', 'Proses penyusunan laporan tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(72, 69, '03', 'Entitas terlambat menyampaikan laporan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(73, 69, '04', 'Sistem informasi akuntansi dan pelaporan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(74, 69, '05', 'Sistem informasi akuntansi dan pelaporan belum didukung SDM yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(75, 2, '02', 'Kelemahan sistem pengendalian pelaksanaan anggaran pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(76, 75, '01', 'Perencanaan kegiatan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(77, 75, '02', 'Mekanisme pemungutan, penyetoran dan pelaporan serta penggunaan Penerimaan negara/daerah/perusahaan dan hibah tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(78, 75, '03', 'Penyimpangan terhadap peraturan perundang-undangan bidang teknis tertentu atau ketentuan intern organisasi yang diperiksa tentang pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(79, 75, '04', 'Pelaksanaan belanja di luar mekanisme APBN/APBD', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(80, 75, '05', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat hilangnya potensi penerimaan/pendapatan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(81, 75, '06', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat peningkatan biaya /belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(82, 75, '07', 'Kelemahan pengelolaan fisik aset', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(83, 2, '03', 'Kelemahan struktur pengendalian intern', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(84, 83, '01', 'Entitas tidak memiliki SOP yang formal untuk suatu prosedur atau keseluruhan prosedur', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(85, 83, '02', 'SOP yang ada pada entitas tidak berjalan secara optimal atau tidak ditaati', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(86, 83, '03', 'Entitas tidak memiliki satuan pengawas intern', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(87, 83, '04', 'Satuan pengawas intern yang ada tidak memadai atau tidak berjalan optimal', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(88, 83, '05', 'Tidak ada pemisahan tugas dan fungsi yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(89, 3, '01', 'Ketidakhematan/pemborosan/ketidakekonomisan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(90, 89, '01', 'Pengadaan barang/jasa melebihi kebutuhan', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(91, 89, '02', 'Penetapan kualitas dan kuantitas barang/jasa yang digunakan tidak sesuai standar', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(92, 89, '03', 'Pemborosan keuangan negara/daerah/perusahaan atau kemahalan harga', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(93, 3, '02', 'Ketidakefisienan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(94, 93, '01', 'Penggunaan kuantitas input untuk satu satuan output lebih besar/tinggi dari yang seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(95, 93, '02', 'Penggunaan kualitas input untuk satu satuan output lebih tinggi dari seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(96, 3, '03', 'Ketidakefektifan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(97, 96, '01', 'Penggunaan anggaran tidak tepat sasaran/tidak sesuai peruntukan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(98, 96, '02', 'Pemanfaatan barang/jasa dilakukan tidak sesuai dengan rencana yang ditetapkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(99, 96, '03', 'Barang yang dibeli belum/tidak dapat dimanfaatkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(100, 96, '04', 'Pemanfaatan barang/jasa tidak berdampak terhadap pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(101, 96, '05', 'Pelaksanaan kegiatan terlambat/terhambat sehingga mempengaruhi pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(102, 96, '06', 'Pelayanan kepada masyarakat tidak optimal', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(103, 96, '07', 'Fungsi atau tugas instansi yang diperiksa tidak diselenggarakan dengan baik termasuk target penerimaan tidak tercapai', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(104, 96, '08', 'Penggunaan biaya promosi/pemasaran tidak efektif', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(105, 4, '01', 'Belanja dan/atau pengadaan barang/jasa fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_spt`
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
-- Struktur dari tabel `laravel_logger_activity`
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
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laravel_logger_activity`
--

INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(132, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 54, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/', 'POST', '2019-09-11 09:24:04', '2019-09-11 09:24:04', NULL),
(131, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 54, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-09-11 09:23:34', '2019-09-11 09:23:34', NULL),
(130, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-09-11 08:46:39', '2019-09-11 08:46:39', NULL),
(133, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 59, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/myprofile', 'POST', '2019-09-12 20:58:03', '2019-09-12 20:58:03', NULL),
(134, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 58, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-12 20:58:16', '2019-09-12 20:58:16', NULL),
(135, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 58, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'POST', '2019-09-12 20:59:15', '2019-09-12 20:59:15', NULL),
(136, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-12 21:00:03', '2019-09-12 21:00:03', NULL),
(137, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'POST', '2019-09-12 21:10:25', '2019-09-12 21:10:25', NULL),
(138, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-12 21:10:43', '2019-09-12 21:10:43', NULL),
(139, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-13 00:45:42', '2019-09-13 00:45:42', NULL),
(140, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-15 18:27:50', '2019-09-15 18:27:50', NULL),
(141, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-17 19:55:20', '2019-09-17 19:55:20', NULL),
(142, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-18 00:37:56', '2019-09-18 00:37:56', NULL),
(143, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-18 17:18:37', '2019-09-18 17:18:37', NULL),
(144, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-18 19:36:40', '2019-09-18 19:36:40', NULL),
(145, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-18 23:19:36', '2019-09-18 23:19:36', NULL),
(146, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1568940092069&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-19 17:41:48', '2019-09-19 17:41:48', NULL),
(147, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1568940088005&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-19 17:41:48', '2019-09-19 17:41:48', NULL),
(148, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1569198269037&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-22 17:24:38', '2019-09-22 17:24:38', NULL),
(149, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1569198256476&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-22 17:24:38', '2019-09-22 17:24:38', NULL),
(150, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-23 01:52:33', '2019-09-23 01:52:33', NULL),
(151, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1569284526546&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-23 17:22:25', '2019-09-23 17:22:25', NULL),
(152, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-23 20:27:55', '2019-09-23 20:27:55', NULL),
(153, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-23 23:15:36', '2019-09-23 23:15:36', NULL),
(154, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1569371237833&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-24 17:27:54', '2019-09-24 17:27:54', NULL),
(155, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1569385996767&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_x&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_x&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-24 21:33:26', '2019-09-24 21:33:26', NULL),
(156, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-24 21:33:26', '2019-09-24 21:33:26', NULL),
(157, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/roles', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-24 23:49:04', '2019-09-24 23:49:04', NULL),
(158, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-26 17:41:47', '2019-09-26 17:41:47', NULL),
(159, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-26 23:19:25', '2019-09-26 23:19:25', NULL),
(160, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-29 18:48:51', '2019-09-29 18:48:51', NULL),
(161, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1569827375169&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-30 00:09:38', '2019-09-30 00:09:38', NULL),
(162, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-30 00:16:10', '2019-09-30 00:16:10', NULL),
(163, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1569828153492&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=5&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=ahmad&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-30 00:22:41', '2019-09-30 00:22:41', NULL),
(164, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1569889687122&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-30 17:28:23', '2019-09-30 17:28:23', NULL),
(165, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1569889687123&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=2&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-30 20:12:52', '2019-09-30 20:12:52', NULL),
(166, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/user/54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-09-30 23:35:40', '2019-09-30 23:35:40', NULL),
(167, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1569976029068&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-10-01 17:27:41', '2019-10-01 17:27:41', NULL),
(168, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1570006601201&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-10-02 01:57:13', '2019-10-02 01:57:13', NULL),
(169, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1570069145672&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-10-02 19:19:14', '2019-10-02 19:19:14', NULL),
(170, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-02 23:08:32', '2019-10-02 23:08:32', NULL),
(171, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-06 19:22:28', '2019-10-06 19:22:28', NULL),
(172, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/user/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-10-07 02:07:40', '2019-10-07 02:07:40', NULL),
(173, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/user/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-10-07 02:07:40', '2019-10-07 02:07:40', NULL),
(174, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-07 19:11:53', '2019-10-07 19:11:53', NULL),
(175, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'GET', '2019-10-08 01:29:24', '2019-10-08 01:29:24', NULL),
(176, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-08 18:50:36', '2019-10-08 18:50:36', NULL),
(177, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-08 18:50:36', '2019-10-08 18:50:36', NULL),
(178, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-08 23:47:23', '2019-10-08 23:47:23', NULL),
(179, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-08 23:47:23', '2019-10-08 23:47:23', NULL),
(180, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-08 23:48:05', '2019-10-08 23:48:05', NULL),
(181, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-09 19:15:54', '2019-10-09 19:15:54', NULL),
(182, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-09 19:15:54', '2019-10-09 19:15:54', NULL),
(183, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-09 20:11:21', '2019-10-09 20:11:21', NULL),
(184, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-09 20:55:26', '2019-10-09 20:55:26', NULL),
(185, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-09 20:55:32', '2019-10-09 20:55:32', NULL),
(186, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-10 00:25:40', '2019-10-10 00:25:40', NULL),
(187, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-14 18:40:48', '2019-10-14 18:40:48', NULL),
(188, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-14 20:59:06', '2019-10-14 20:59:06', NULL),
(189, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 73, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-14 21:05:20', '2019-10-14 21:05:20', NULL),
(190, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 73, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-15 00:58:27', '2019-10-15 00:58:27', NULL),
(191, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-15 01:00:01', '2019-10-15 01:00:01', NULL),
(192, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-15 19:03:08', '2019-10-15 19:03:08', NULL),
(193, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 73, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-15 19:03:38', '2019-10-15 19:03:38', NULL),
(194, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-17 00:45:45', '2019-10-17 00:45:45', NULL),
(195, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-20 18:38:21', '2019-10-20 18:38:21', NULL);
INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(196, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-10-21 00:56:26', '2019-10-21 00:56:26', NULL),
(197, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-21 00:57:36', '2019-10-21 00:57:36', NULL),
(198, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-21 18:00:05', '2019-10-21 18:00:05', NULL),
(199, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-21 23:24:30', '2019-10-21 23:24:30', NULL),
(200, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-22 23:46:09', '2019-10-22 23:46:09', NULL),
(201, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-23 00:12:12', '2019-10-23 00:12:12', NULL),
(202, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-23 19:36:24', '2019-10-23 19:36:24', NULL),
(203, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-10-27 19:30:22', '2019-10-27 19:30:22', NULL),
(204, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/getdata?_=1572251547563&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=nip&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=dupak_pendidikan_lama&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=dupak_pendidikan_baru&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=dupak_utama_lama&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=dupak_utama_baru&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=dupak_penunjang_lama&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=dupak_penunjang_baru&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=true&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B9%5D%5Bdata%5D=action&columns%5B9%5D%5Bname%5D=&columns%5B9%5D%5Bsearchable%5D=true&columns%5B9%5D%5Borderable%5D=true&columns%5B9%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B9%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-10-28 01:32:37', '2019-10-28 01:32:37', NULL),
(205, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-28 18:40:18', '2019-10-28 18:40:18', NULL),
(206, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-29 00:17:12', '2019-10-29 00:17:12', NULL),
(207, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-29 19:06:00', '2019-10-29 19:06:00', NULL),
(208, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-10-30 00:13:54', '2019-10-30 00:13:54', NULL),
(209, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-03 19:04:02', '2019-11-03 19:04:02', NULL),
(210, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-04 19:24:38', '2019-11-04 19:24:38', NULL),
(211, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-05 00:12:56', '2019-11-05 00:12:56', NULL),
(212, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-06 21:06:59', '2019-11-06 21:06:59', NULL),
(213, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/resiko', 'GET', '2019-11-06 23:44:28', '2019-11-06 23:44:28', NULL),
(214, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-11-07 20:18:46', '2019-11-07 20:18:46', NULL),
(215, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'GET', '2019-11-08 01:02:30', '2019-11-08 01:02:30', NULL),
(216, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-11-10 18:47:28', '2019-11-10 18:47:28', NULL),
(217, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'POST', '2019-11-10 23:51:52', '2019-11-10 23:51:52', NULL),
(218, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-11-10 23:52:00', '2019-11-10 23:52:00', NULL),
(219, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'POST', '2019-11-10 23:52:12', '2019-11-10 23:52:12', NULL),
(220, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-10 23:53:46', '2019-11-10 23:53:46', NULL),
(221, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-10 23:58:25', '2019-11-10 23:58:25', NULL),
(222, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'POST', '2019-11-11 00:00:43', '2019-11-11 00:00:43', NULL),
(223, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 86, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 00:01:18', '2019-11-11 00:01:18', NULL),
(224, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 86, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'POST', '2019-11-11 00:05:31', '2019-11-11 00:05:31', NULL),
(225, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 00:05:45', '2019-11-11 00:05:45', NULL),
(226, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'POST', '2019-11-11 00:11:43', '2019-11-11 00:11:43', NULL),
(227, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 00:13:12', '2019-11-11 00:13:12', NULL),
(228, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/permissions', 'POST', '2019-11-11 00:18:42', '2019-11-11 00:18:42', NULL),
(229, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 00:19:11', '2019-11-11 00:19:11', NULL),
(230, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 00:26:06', '2019-11-11 00:26:06', NULL),
(231, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-11 19:51:19', '2019-11-11 19:51:19', NULL),
(232, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-12 00:00:00', '2019-11-12 00:00:00', NULL),
(233, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-12 20:09:10', '2019-11-12 20:09:10', NULL),
(234, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 00:42:11', '2019-11-13 00:42:11', NULL),
(235, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 18:15:47', '2019-11-13 18:15:47', NULL),
(236, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/dupak/list', 'POST', '2019-11-13 19:25:16', '2019-11-13 19:25:16', NULL),
(237, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:28:20', '2019-11-13 19:28:20', NULL),
(238, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:28:30', '2019-11-13 19:28:30', NULL),
(239, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:29:40', '2019-11-13 19:29:40', NULL),
(240, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'POST', '2019-11-13 19:30:13', '2019-11-13 19:30:13', NULL),
(241, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:31:38', '2019-11-13 19:31:38', NULL),
(242, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin', 'POST', '2019-11-13 19:43:13', '2019-11-13 19:43:13', NULL),
(243, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:44:05', '2019-11-13 19:44:05', NULL),
(244, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/jenis-spt', 'POST', '2019-11-13 19:47:34', '2019-11-13 19:47:34', NULL),
(245, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 51, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 19:48:27', '2019-11-13 19:48:27', NULL),
(246, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-13 23:20:11', '2019-11-13 23:20:11', NULL),
(247, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 00:32:04', '2019-11-18 00:32:04', NULL),
(248, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:17:38', '2019-11-18 19:17:38', NULL),
(249, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/permissions', 'POST', '2019-11-18 19:30:06', '2019-11-18 19:30:06', NULL),
(250, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:30:12', '2019-11-18 19:30:12', NULL),
(251, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:34:25', '2019-11-18 19:34:25', NULL),
(252, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:35:58', '2019-11-18 19:35:58', NULL),
(253, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:36:54', '2019-11-18 19:36:54', NULL),
(254, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:36:59', '2019-11-18 19:36:59', NULL),
(255, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:39:31', '2019-11-18 19:39:31', NULL),
(256, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:39:36', '2019-11-18 19:39:36', NULL),
(257, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:40:30', '2019-11-18 19:40:30', NULL),
(258, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:40:34', '2019-11-18 19:40:34', NULL),
(259, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:42:44', '2019-11-18 19:42:44', NULL),
(260, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:42:49', '2019-11-18 19:42:49', NULL),
(261, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:44:23', '2019-11-18 19:44:23', NULL),
(262, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:44:29', '2019-11-18 19:44:29', NULL),
(263, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'POST', '2019-11-18 19:47:16', '2019-11-18 19:47:16', NULL),
(264, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-18 19:47:20', '2019-11-18 19:47:20', NULL),
(265, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-19 18:48:55', '2019-11-19 18:48:55', NULL),
(266, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-11-20 00:29:59', '2019-11-20 00:29:59', NULL),
(267, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-24 19:10:34', '2019-11-24 19:10:34', NULL),
(268, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-24 23:56:04', '2019-11-24 23:56:04', NULL),
(269, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-25 19:01:48', '2019-11-25 19:01:48', NULL),
(270, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-11-26 00:56:37', '2019-11-26 00:56:37', NULL),
(271, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-11-26 19:09:07', '2019-11-26 19:09:07', NULL),
(272, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-11-27 17:27:54', '2019-11-27 17:27:54', NULL),
(273, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-03 19:16:40', '2019-12-03 19:16:40', NULL),
(274, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/dupak/list?tgl_mulai=03-12-2019&tgl_akhir=07-11-2018', 'GET', '2019-12-04 00:16:31', '2019-12-04 00:16:31', NULL),
(275, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list?tgl_akhir=07-11-2018&tgl_mulai=03-12-2019', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-12-04 00:16:31', '2019-12-04 00:16:31', NULL),
(276, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-04 18:27:31', '2019-12-04 18:27:31', NULL),
(277, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-05 19:43:16', '2019-12-05 19:43:16', NULL),
(278, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'GET', '2019-12-06 00:01:14', '2019-12-06 00:01:14', NULL),
(279, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/permissions', 'POST', '2019-12-06 00:09:55', '2019-12-06 00:09:55', NULL),
(280, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-06 00:10:02', '2019-12-06 00:10:02', NULL),
(281, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'POST', '2019-12-06 00:11:17', '2019-12-06 00:11:17', NULL),
(282, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-06 00:11:22', '2019-12-06 00:11:22', NULL),
(283, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-08 21:24:54', '2019-12-08 21:24:54', NULL),
(284, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-08 23:55:26', '2019-12-08 23:55:26', NULL),
(285, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-09 00:03:15', '2019-12-09 00:03:15', NULL),
(286, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-09 00:03:36', '2019-12-09 00:03:36', NULL),
(287, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-09 00:04:23', '2019-12-09 00:04:23', NULL),
(288, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 46, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-09 00:05:18', '2019-12-09 00:05:18', NULL),
(289, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-09 19:42:32', '2019-12-09 19:42:32', NULL),
(290, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-12-10 19:40:37', '2019-12-10 19:40:37', NULL),
(291, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-12-10 23:27:19', '2019-12-10 23:27:19', NULL),
(292, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-12 20:38:31', '2019-12-12 20:38:31', NULL),
(293, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/', 'GET', '2019-12-13 00:05:06', '2019-12-13 00:05:06', NULL),
(294, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-15 18:50:13', '2019-12-15 18:50:13', NULL),
(295, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/user/49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/dupak/list', 'GET', '2019-12-15 23:19:46', '2019-12-15 23:19:46', NULL),
(296, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-16 19:38:30', '2019-12-16 19:38:30', NULL),
(297, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-18 18:40:43', '2019-12-18 18:40:43', NULL),
(298, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-18 21:03:35', '2019-12-18 21:03:35', NULL),
(299, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2019-12-23 01:24:52', '2019-12-23 01:24:52', NULL),
(300, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'POST', '2019-12-23 01:41:20', '2019-12-23 01:41:20', NULL),
(301, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-23 01:41:28', '2019-12-23 01:41:28', NULL),
(302, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2019-12-25 21:07:49', '2019-12-25 21:07:49', NULL),
(303, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-01-01 19:47:13', '2020-01-01 19:47:13', NULL),
(304, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-01-01 23:53:17', '2020-01-01 23:53:17', NULL),
(305, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-05 19:29:40', '2020-01-05 19:29:40', NULL),
(306, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-07 18:34:28', '2020-01-07 18:34:28', NULL),
(307, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-07 23:35:20', '2020-01-07 23:35:20', NULL),
(308, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-08 18:58:23', '2020-01-08 18:58:23', NULL),
(309, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-09 01:00:41', '2020-01-09 01:00:41', NULL),
(310, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode/get-sub-kelompok/1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/kode', 'GET', '2020-01-09 01:00:41', '2020-01-09 01:00:41', NULL),
(311, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-12 21:05:34', '2020-01-12 21:05:34', NULL),
(312, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-13 17:28:12', '2020-01-13 17:28:12', NULL),
(313, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-13 17:28:12', '2020-01-13 17:28:12', NULL),
(314, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-13 20:08:58', '2020-01-13 20:08:58', NULL),
(315, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-14 01:43:24', '2020-01-14 01:43:24', NULL),
(316, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-14 18:42:23', '2020-01-14 18:42:23', NULL),
(317, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-14 23:18:34', '2020-01-14 23:18:34', NULL),
(318, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-15 19:41:04', '2020-01-15 19:41:04', NULL),
(319, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-16 18:53:28', '2020-01-16 18:53:28', NULL),
(320, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-17 00:19:24', '2020-01-17 00:19:24', NULL),
(321, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-19 17:31:21', '2020-01-19 17:31:21', NULL),
(322, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-19 19:49:04', '2020-01-19 19:49:04', NULL),
(323, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-19 23:19:05', '2020-01-19 23:19:05', NULL),
(324, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-20 19:02:48', '2020-01-20 19:02:48', NULL),
(325, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-21 19:10:52', '2020-01-21 19:10:52', NULL),
(326, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-22 18:25:31', '2020-01-22 18:25:31', NULL),
(327, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/kode', 'GET', '2020-01-22 23:52:34', '2020-01-22 23:52:34', NULL),
(328, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-26 18:24:07', '2020-01-26 18:24:07', NULL),
(329, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-28 18:48:52', '2020-01-28 18:48:52', NULL),
(330, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar?_=1580270721907&end=2015-02-09&start=2014-12-29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/calendar', 'GET', '2020-01-28 21:06:47', '2020-01-28 21:06:47', NULL),
(331, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar?_=1580270721911&end=2011-02-07&start=2010-12-27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/calendar', 'GET', '2020-01-28 21:06:47', '2020-01-28 21:06:47', NULL),
(332, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-29 18:34:47', '2020-01-29 18:34:47', NULL),
(333, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-01-30 19:07:46', '2020-01-30 19:07:46', NULL),
(334, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-02 19:12:19', '2020-02-02 19:12:19', NULL),
(335, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar?_=1580696473480&end=2020-06-08&start=2020-04-27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/calendar', 'GET', '2020-02-02 19:31:16', '2020-02-02 19:31:16', NULL),
(336, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar?_=1580696473492&end=2020-02-10&start=2019-12-30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/calendar', 'GET', '2020-02-02 19:35:44', '2020-02-02 19:35:44', NULL);
INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(337, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/get-anggota/1?_=1580699413770&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=full_name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=peran&columns%5B2%5D%5Bname%5D=peran&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=lama&columns%5B3%5D%5Bname%5D=lama&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-02-02 23:33:03', '2020-02-02 23:33:03', NULL),
(338, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/get-anggota/1?_=1580699413771&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=full_name&columns%5B1%5D%5Bname%5D=full_name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=peran&columns%5B2%5D%5Bname%5D=peran&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=lama&columns%5B3%5D%5Bname%5D=lama&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-02-02 23:33:43', '2020-02-02 23:33:43', NULL),
(339, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-03 18:58:24', '2020-02-03 18:58:24', NULL),
(340, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 49, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-03 21:35:44', '2020-02-03 21:35:44', NULL),
(341, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/dupak/list', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/users', 'GET', '2020-02-04 00:00:51', '2020-02-04 00:00:51', NULL),
(342, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-04 20:29:09', '2020-02-04 20:29:09', NULL),
(343, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-05 18:31:54', '2020-02-05 18:31:54', NULL),
(344, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-06 19:45:58', '2020-02-06 19:45:58', NULL),
(345, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/kode', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-07 00:11:07', '2020-02-07 00:11:07', NULL),
(346, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-09 20:31:38', '2020-02-09 20:31:38', NULL),
(347, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/cetak-pdf/2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-10 19:21:37', '2020-02-10 19:21:37', NULL),
(348, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-10 19:21:39', '2020-02-10 19:21:39', NULL),
(349, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-11 18:38:48', '2020-02-11 18:38:48', NULL),
(350, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-12 20:18:32', '2020-02-12 20:18:32', NULL),
(351, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-13 19:05:33', '2020-02-13 19:05:33', NULL),
(352, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/cetak-pdf/1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-02-13 23:26:51', '2020-02-13 23:26:51', NULL),
(353, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-16 19:08:15', '2020-02-16 19:08:15', NULL),
(354, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-17 18:50:48', '2020-02-17 18:50:48', NULL),
(355, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-18 20:47:50', '2020-02-18 20:47:50', NULL),
(356, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'GET', '2020-02-18 23:09:11', '2020-02-18 23:09:11', NULL),
(357, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-19 19:08:28', '2020-02-19 19:08:28', NULL),
(358, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-20 18:42:53', '2020-02-20 18:42:53', NULL),
(359, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-20 23:28:27', '2020-02-20 23:28:27', NULL),
(360, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-23 18:32:44', '2020-02-23 18:32:44', NULL),
(361, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-24 18:07:57', '2020-02-24 18:07:57', NULL),
(362, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-24 19:50:02', '2020-02-24 19:50:02', NULL),
(363, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-24 19:55:13', '2020-02-24 19:55:13', NULL),
(364, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-24 19:55:49', '2020-02-24 19:55:49', NULL),
(365, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2020-02-24 20:00:32', '2020-02-24 20:00:32', NULL),
(366, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-24 20:13:57', '2020-02-24 20:13:57', NULL),
(367, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/login', 'POST', '2020-02-25 19:08:36', '2020-02-25 19:08:36', NULL),
(368, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'GET', '2020-02-25 23:14:52', '2020-02-25 23:14:52', NULL),
(369, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/get-anggota/9?_=1582698263310&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nama_anggota&columns%5B1%5D%5Bname%5D=nama_anggota&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=peran&columns%5B2%5D%5Bname%5D=peran&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=action&columns%5B3%5D%5Bname%5D=action&columns%5B3%5D%5Bsearchable%5D=false&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&draw=3&length=10&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-02-25 23:24:43', '2020-02-25 23:24:43', NULL),
(370, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-26 18:50:13', '2020-02-26 18:50:13', NULL),
(371, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt/1/edit', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/jenis-spt', 'GET', '2020-02-26 23:14:17', '2020-02-26 23:14:17', NULL),
(372, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt/1/edit', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/jenis-spt', 'GET', '2020-02-26 23:14:17', '2020-02-26 23:14:17', NULL),
(373, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-02-27 18:50:17', '2020-02-27 18:50:17', NULL),
(374, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-01 17:29:12', '2020-03-01 17:29:12', NULL),
(375, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-02 18:29:33', '2020-03-02 18:29:33', NULL),
(376, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-03-02 23:31:38', '2020-03-02 23:31:38', NULL),
(377, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-03 18:33:55', '2020-03-03 18:33:55', NULL),
(378, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-04 18:38:42', '2020-03-04 18:38:42', NULL),
(379, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-05 18:54:56', '2020-03-05 18:54:56', NULL),
(380, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-05 18:56:48', '2020-03-05 18:56:48', NULL),
(381, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-08 18:44:48', '2020-03-08 18:44:48', NULL),
(382, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/cetak-pdf/6', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-03-08 23:24:30', '2020-03-08 23:24:30', NULL),
(383, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-09 18:47:50', '2020-03-09 18:47:50', NULL),
(384, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt/cetak-pdf/6', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-10 00:03:44', '2020-03-10 00:03:44', NULL),
(385, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-10 18:34:43', '2020-03-10 18:34:43', NULL),
(386, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt/getdata?_=1583890522346&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=name&columns%5B1%5D%5Bname%5D=name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=dasar&columns%5B2%5D%5Bname%5D=dasar&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=kode_kelompok&columns%5B3%5D%5Bname%5D=kode_kelompok&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=3&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=cera&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/jenis-spt', 'GET', '2020-03-10 18:35:28', '2020-03-10 18:35:28', NULL),
(387, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt/getdata?_=1583892707882&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=name&columns%5B1%5D%5Bname%5D=name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=dasar&columns%5B2%5D%5Bname%5D=dasar&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=kode_kelompok&columns%5B3%5D%5Bname%5D=kode_kelompok&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=9&length=100&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/jenis-spt', 'GET', '2020-03-10 23:35:45', '2020-03-10 23:35:45', NULL),
(388, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/jenis-spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-03-10 23:35:45', '2020-03-10 23:35:45', NULL),
(389, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-12 19:42:07', '2020-03-12 19:42:07', NULL),
(390, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/jenis-spt', 'GET', '2020-03-12 23:44:20', '2020-03-12 23:44:20', NULL),
(391, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-15 19:20:29', '2020-03-15 19:20:29', NULL),
(392, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'GET', '2020-03-15 23:56:35', '2020-03-15 23:56:35', NULL),
(393, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-16 19:04:35', '2020-03-16 19:04:35', NULL),
(394, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/spt/penomoran?_=1584420850011&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=jenis_spt&columns%5B1%5D%5Bname%5D=jenis_spt&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=tanggal_mulai&columns%5B2%5D%5Bname%5D=tanggal_mulai&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=tanggal_akhir&columns%5B3%5D%5Bname%5D=tanggal_akhir&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=lama&columns%5B4%5D%5Bname%5D=lama&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=action&columns%5B5%5D%5Bname%5D=action&columns%5B5%5D%5Bsearchable%5D=false&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&draw=2&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin', 'GET', '2020-03-16 21:54:27', '2020-03-16 21:54:27', NULL),
(395, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-17 18:51:36', '2020-03-17 18:51:36', NULL),
(396, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-18 18:43:44', '2020-03-18 18:43:44', NULL),
(397, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-03-18 22:55:57', '2020-03-18 22:55:57', NULL),
(398, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-19 18:54:19', '2020-03-19 18:54:19', NULL),
(399, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-22 18:57:31', '2020-03-22 18:57:31', NULL),
(400, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-23 18:34:44', '2020-03-23 18:34:44', NULL),
(401, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-25 18:57:26', '2020-03-25 18:57:26', NULL),
(402, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/calendar', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', 'http://inspektorat.go.id/admin/spt', 'GET', '2020-03-25 20:53:19', '2020-03-25 20:53:19', NULL),
(403, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0', 'id,en-US;q=0.7,en;q=0.3', NULL, 'GET', '2020-03-26 19:03:08', '2020-03-26 19:03:08', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `jenis_lokasi` varchar(255) DEFAULT NULL,
  `sebutan_pimpinan` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `jenis_lokasi`, `sebutan_pimpinan`, `created_at`, `updated_at`) VALUES
(1, 'Sekretariat DPRD', 'OPD', 'Sekretaris DPRD', '2020-02-05 04:15:47', '2020-02-05 04:15:47'),
(2, 'Sekretariat Daerah (Bagian Administrasi Pemerintahan)', 'OPD', 'Kepala Bagian', '2020-02-05 07:25:08', '2020-02-05 07:25:08'),
(3, 'Sekretariat Daerah (Bagian Kerjasama)', 'OPD', 'Kepala Bagian', '2020-02-05 07:26:32', '2020-02-05 07:26:32'),
(4, 'Sekretariat Daerah (Bagian Administrasi KESRA dan Kemasyarakatan)', 'OPD', 'Kepala Bagian', '2020-02-05 07:26:52', '2020-02-05 07:26:52'),
(5, 'Sekretariat Daerah (Bagian Administrasi Perekonomian dan SDA)', 'OPD', 'Kepala Bagian', '2020-02-05 07:27:04', '2020-02-05 07:27:04'),
(6, 'Sekretariat Daerah (Bagian Administrasi Pembangunan)', 'OPD', 'Kepala Bagian', '2020-02-05 07:27:19', '2020-02-05 07:27:19'),
(7, 'Sekretariat Daerah (Bagian Telekomunikasi dan Informatika)', 'OPD', 'Kepala Bagian', '2020-02-05 07:27:52', '2020-02-05 07:27:52'),
(8, 'Sekretariat Daerah (Bagian Organisasi)', 'OPD', 'Kepala Bagian', '2020-02-05 07:28:02', '2020-02-05 07:28:02'),
(9, 'Sekretariat Daerah (Bagian Hukum)', 'OPD', 'Kepala Bagian', '2020-02-05 07:28:10', '2020-02-05 07:28:10'),
(10, 'Sekretariat Daerah (Bagian Humas dan Protokol)', 'OPD', 'Kepala Bagian', '2020-02-05 07:28:17', '2020-02-05 07:28:17'),
(11, 'Sekretariat Daerah (Bagian Umum)', 'OPD', 'Kepala Bagian', '2020-02-05 07:28:23', '2020-02-05 07:28:23'),
(12, 'Badan Perencanaan Pembangunan Daerah (BAPPEDA)', 'OPD', 'Kepala', '2020-02-05 07:37:04', '2020-02-05 07:37:04'),
(13, 'Badan Kepegawaian Daerah (BKD)', 'OPD', 'Kepala', '2020-02-05 07:51:48', '2020-02-05 07:51:48'),
(14, 'Badan Pelayanan Perijinan Terpadu', 'OPD', 'Kepala', '2020-02-05 07:52:07', '2020-02-05 07:52:07'),
(15, 'Badan Lingkungan Hidup', 'OPD', 'Kepala', '2020-02-05 07:52:16', '2020-02-05 07:52:16'),
(16, 'Badan Kesatuan Bangsa dan Politik (Bakesbangpol)', 'OPD', 'Kepala', '2020-02-05 07:52:32', '2020-02-05 07:52:32'),
(17, 'Badan Pemberdayaan Masyarakat, perempuan, dan keluarga berencana (BPMPKB)', 'OPD', 'Kepala', '2020-02-05 07:52:39', '2020-02-05 07:52:39'),
(18, 'Badan Ketahanan Pangan (BKP)', 'OPD', 'Kepala', '2020-02-05 07:52:45', '2020-02-05 07:52:45'),
(19, 'Badan Penanggulangan Bencana Daerah (BPBD)', 'OPD', 'Kepala', '2020-02-05 07:52:50', '2020-02-05 07:52:50'),
(20, 'Dinas Pendidikan', 'OPD', 'Kepala', '2020-02-05 07:52:55', '2020-02-05 07:52:55'),
(21, 'Dinas Kesehatan', 'OPD', 'Kepala', '2020-02-05 07:53:16', '2020-02-05 07:53:16'),
(22, 'Dinas Sosial dan Tenaga Kerja', 'OPD', 'Kepala', '2020-02-05 07:53:22', '2020-02-05 07:53:22'),
(23, 'Dinas Kependudukan dan Pencatatan Sipil', 'OPD', 'Kepala', '2020-02-05 07:53:28', '2020-02-05 07:53:28'),
(24, 'Dinas Pemuda, Olahraga, Kebudayaan, dan Pariwisata (DISPORABUDPAR)', 'OPD', 'Kepala', '2020-02-05 07:53:33', '2020-02-05 07:53:33'),
(25, 'Dinas Perhubungan', 'OPD', 'Kepala', '2020-02-05 07:53:37', '2020-02-05 07:53:37'),
(26, 'Dinas Koperasi, UKM, Perindustrian, Perdagangan, dan ESDM', 'OPD', 'Kepala', '2020-02-05 07:53:42', '2020-02-05 07:53:42'),
(27, 'Dinas Pertanian, Perkebunan, dan Peternakan', 'OPD', 'Kepala', '2020-02-05 07:53:47', '2020-02-05 07:53:47'),
(28, 'Dinas Kelautan dan Perikanan', 'OPD', 'Kepala', '2020-02-05 07:53:52', '2020-02-05 07:53:52'),
(29, 'Dinas Pasar', 'OPD', 'Kepala', '2020-02-05 07:53:56', '2020-02-05 07:53:56'),
(30, 'Dinas Pekerjaan Umum Cipta Karya dan Tata Ruang', 'OPD', 'Kepala', '2020-02-05 07:54:01', '2020-02-05 07:54:01'),
(31, 'Dinas Pekerjaan Umum Bina Marga', 'OPD', 'Kepala', '2020-02-05 07:54:05', '2020-02-05 07:54:05'),
(32, 'Dinas Pekerjaan Umum Pengairan', 'OPD', 'Kepala', '2020-02-05 07:54:10', '2020-02-05 07:54:10'),
(33, 'Dinas Kebersihan dan Pertamanan', 'OPD', 'Kepala', '2020-02-05 07:54:15', '2020-02-05 07:54:15'),
(34, 'Dinas Pendapatan, Pengelolaan Keuangan dan Aset (DPPKA)', 'OPD', 'Kepala', '2020-02-05 07:54:20', '2020-02-05 07:54:20'),
(35, 'Kantor Perpustakaan dan Arsip', 'OPD', 'Kepala', '2020-02-05 07:54:24', '2020-02-05 07:54:24'),
(36, 'Satuan Polisi Pamong Praja', 'OPD', 'Kepala', '2020-02-05 07:54:29', '2020-02-05 07:54:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
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

--
-- Dumping data untuk tabel `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(6, 'App\\models\\Profile', 1, 'pic', 'rock-n-roll', 'rock-n-roll.jpg', 'image/jpeg', 'public', 87645, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 1, '2019-05-21 10:07:30', '2019-05-21 10:07:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_28_081130_create_permission_tables', 1),
(4, '2019_05_07_135656_create_profiles_table', 1),
(5, '2019_05_10_080615_create_media_table', 1),
(8, '2019_05_16_151751_create_jenis_spts_table', 2),
(14, '2019_05_16_152107_create_spts_table', 3),
(15, '2019_05_28_061257_detail_spt', 3),
(16, '2020_01_27_032203_create_events_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
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
-- Struktur dari tabel `model_has_roles`
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
-- Dumping data untuk tabel `model_has_roles`
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
(5, 'App\\User', 9),
(5, 'App\\User', 11),
(5, 'App\\User', 13),
(5, 'App\\User', 28),
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
(6, 'App\\User', 7),
(6, 'App\\User', 27),
(6, 'App\\User', 29),
(6, 'App\\User', 30),
(6, 'App\\User', 31),
(6, 'App\\User', 32),
(6, 'App\\User', 86);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
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
-- Struktur dari tabel `permissions`
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
-- Dumping data untuk tabel `permissions`
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
-- Struktur dari tabel `profiles`
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

--
-- Dumping data untuk tabel `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `address`, `city`, `country`, `zipcode`, `cover`, `pic`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jalan jalan saja yuk', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 21:28:14', '2019-05-20 21:28:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resiko`
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

--
-- Dumping data untuk tabel `resiko`
--

INSERT INTO `resiko` (`id`, `opd`, `nama_kegiatan`, `tujuan_kegiatan`, `tujuan_pd`, `sasaran_pd`, `capaian`, `tujuan`, `created_at`, `updated_at`) VALUES
(1, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', NULL, NULL),
(2, 'Dinas Kominfo', 'asddasf', 'safsafas', 'safasd', 'safas', 'saasfas', NULL, '2019-09-10 00:44:02', '2019-09-10 00:44:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
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
-- Struktur dari tabel `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
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
-- Struktur dari tabel `sertifikat`
--

DROP TABLE IF EXISTS `sertifikat`;
CREATE TABLE IF NOT EXISTS `sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama_sertifikat` varchar(255) NOT NULL,
  `file_sertifikat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `user_id`, `nama_sertifikat`, `file_sertifikat`, `created_at`, `updated_at`) VALUES
(37, 49, 'sp.jpg', 'sertifikat_auditor/wbmkDfMAZUYM9uMaeFOmP8DC0zV2RqytI2PJtSbL.jpeg', '2020-02-04 00:16:25', '2020-02-04 00:16:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spt`
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spt`
--

INSERT INTO `spt` (`id`, `jenis_spt_id`, `lokasi_id`, `name`, `nomor`, `tambahan`, `tgl_mulai`, `tgl_akhir`, `lama`, `tgl_register`, `info`, `file`, `created_at`, `updated_at`) VALUES
(3, 7, NULL, NULL, NULL, 'informasi tambahan', '2020-03-03 17:00:00', '2020-03-11 17:00:00', 2, NULL, '{\"lanjutan\": \"1\"}', NULL, '2020-03-02 19:58:51', '2020-03-17 00:11:59'),
(4, 6, '[\"6\"]', NULL, NULL, 'tambahan mengenai SPT', '2020-03-04 17:00:00', '2020-03-05 17:00:00', 2, NULL, '{\"lanjutan\": \"1\"}', NULL, '2020-03-02 19:59:42', '2020-03-17 01:22:06'),
(5, 7, NULL, NULL, NULL, 'informasi tambahan', '2020-03-05 17:00:00', '2020-03-10 17:00:00', 2, NULL, '{\"lanjutan\": \"1\"}', NULL, '2020-03-02 21:00:05', '2020-03-16 23:33:21'),
(6, 8, '[\"1\"]', NULL, NULL, NULL, '2020-03-09 17:00:00', '2020-03-12 17:00:00', 2, NULL, NULL, NULL, '2020-03-08 20:07:31', '2020-03-16 23:40:21'),
(12, 1, NULL, NULL, NULL, 'Pegawai Negeri Sipil Sdr. ABD.GHOFUR NIP.19651106 200701 1 021, Pangkat/Gol. Ruang Pengatur (II/c), Pengadministrasi Sarana dan Prasarana UPT SMPN 6 Sidoarjo Dinas Pendidikan dan Kebudayaan Kabupaten Sidoarjo.', '2020-03-11 17:00:00', '2020-03-18 17:00:00', 2, NULL, '{\"radio\": \"1\", \"lanjutan\": null}', NULL, '2020-03-10 00:42:39', '2020-03-10 01:39:35'),
(11, 1, NULL, NULL, NULL, 'Gugatan  Perceraian Pegawai Negeri Sipil Sdr. MUJI SRI UTAMI, S.Pd.SD NIP.19671231 200701 2 113, Pangkat/Gol. Ruang Penata Muda (III/a), Guru Kelas UPT SD Negeri  Pucang 5 Kecamatan Sidoarjo  Dinas Pendidikan dan Kebudayaan Kabupaten Sidoarjo.', '2020-03-10 17:00:00', '2020-03-12 17:00:00', 2, NULL, '{\"radio\": \"2\", \"lanjutan\": null}', NULL, '2020-03-10 00:10:50', '2020-03-10 21:34:14'),
(14, 7, NULL, NULL, NULL, 'Evaluasi SAKIP dilaksanakan atas respon terhadap temuan SAKIP tahun 2019.', '2020-03-19 17:00:00', '2020-04-02 17:00:00', 10, NULL, '{\"radio\": null, \"lanjutan\": null}', NULL, '2020-03-17 20:13:47', '2020-03-25 19:11:35'),
(15, 2, '[\"1\", \"3\"]', NULL, NULL, NULL, '2020-03-26 17:00:00', '2020-04-03 17:00:00', 7, NULL, '{\"radio\": null, \"lanjutan\": null}', NULL, '2020-03-19 18:56:13', '2020-03-25 20:31:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pendidikan`, `sex`, `tempat_lahir`, `tanggal_lahir`, `gelar`, `jenis_auditor`, `email`, `phone`, `nip`, `jabatan`, `pangkat`, `ruang`, `sertifikat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(35, 'DWI', 'FADJARWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'fadjarwati.dwi@gmail.com', '08xxxxxxx', '19660114 199103 2 007', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$53xZN8gKUCI0l.mYt9BkSuWVrtF/yZOpSI8nmDjcuVHJU5SNr4IJW', NULL, '2019-09-11 01:39:02', '2019-09-18 23:44:34'),
(86, 'User', 'Inspektur', '{\"tahun\": \"1998\", \"jurusan\": \"Sistem Informasi\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', 'Surabaya', '1973-05-11 17:00:00', 'S.Si', NULL, 'Inspektur@local.host', '+625858587', '787878545454', 'Inspektur Kabupaten', 'I/A', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$EghgityiktegIrQSxyEgKut0YObjUQ0atXA08mUJ37q6G520BhTEm', NULL, '2019-11-10 23:59:59', '2019-11-10 23:59:59'),
(27, 'ANDJAR', 'SURJADIANTO', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos.', NULL, 'bagusragilpahing@yahoo.co.id', '08xxxxxxx', '19700926 199003 1 005', 'Inspektur Kabupaten', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$pCR0a5etBJnpNt2w6QioKu8Yax7A4GoxBXzab3UTypMTA.oE8NTvq', NULL, '2019-09-11 00:58:04', '2019-09-11 00:58:04'),
(28, 'Dra. LAELY', 'WIDJAJATI', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', M.Si.', 'ahli', 'laelywidjajati@gmai.com', '08xxxxxxx', '19620202 198903 2 008', 'Auditor Madya', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Pz3NYERR31zRU2JRPf076eqtqMeU/YNTBHsk8QwR67dwbPexQcPIG', NULL, '2019-09-11 01:02:15', '2019-09-18 23:47:57'),
(29, 'Drs. PUJOSENO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"kosong\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SIP.', NULL, 'pujoseno_66@yahoo.com', '08xxxxxxx', '19661027 198602 1 002', 'Inspektur Pembantu Wilayah I', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$n1rn1XaZK8q93jctWAOYCuSnwtyJ1xan2XvIvoI8XZ9I4YiOtlzYi', NULL, '2019-09-11 01:19:09', '2019-09-18 23:38:54'),
(30, 'Drs. MADE', 'SUYARTA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'madesuyarta@gmail.com', '08xxxxxxx', '19670326 199401 1 003', 'Inspektur Pembantu Wilayah II', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tCc9wwA7QN094FakijktdelH.whvilTSQVOxGChNDTkA44LMe5T.2', NULL, '2019-09-11 01:21:15', '2019-09-11 01:21:15'),
(31, 'Drs. MUKHAMAD', 'KHUSAINI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', MM.', NULL, 'khus.dipendik@gmail.com', '08xxxxxxx', '19651213 198606 1 001', 'Inspektur Pembantu Wilayah III', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$QGGOtGtGxYCQFynT0vJDaeCPJLa1dduICEqB6dTmh8es32X.TbvQi', NULL, '2019-09-11 01:22:38', '2019-09-18 23:33:35'),
(32, 'Drs. MOCH.', 'SOLICHIN', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'solichin.mochama@gmail.com', '08xxxxxxx', '19681102 199003 1 003', 'Inspektur Pembantu Wilayah IV', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$r.mtMM52f1UoNlZpl2fyXOiMDczIIbmzVXzQjrh9I.zDaF.iJ.yr.', NULL, '2019-09-11 01:25:03', '2019-09-11 01:25:03'),
(33, 'Drs. DANIEL', 'S TODING', '{\"tahun\": \"2000\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', M.AP', 'ahli', 'daniels.toding.dt@gmail.com', '08xxxxxxx', '19610505 199503 1 001', 'Auditor Madya', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$J3Cmq/gz.1l6SLeaDDXNBe7HwKjOxSGPpjzoyCTG.xNJPu8RNgKVW', NULL, '2019-09-11 01:28:20', '2019-09-18 23:47:45'),
(34, 'DAISY', 'ANDARWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'daisyandarwati@yahoo.com', '08xxxxxxx', '19631206 199403 2 003', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$jveyMkwfoz/s.fd53NBObOCSsypVIpQwP/NQLsxeG7VI/rq8xvku.', NULL, '2019-09-11 01:31:17', '2019-09-18 23:47:31'),
(36, 'SITI', 'LATIFAH', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SH.', 'terampil', 'sitilatifah541@yahoo.co.id', '08xxxxxxx', '19620825 198303 2 007', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$3ZIr.VMDoIAOMGuQEvSjd..On6aCBC6oyyR0aEX1s1tPukqo1XIre', NULL, '2019-09-11 01:39:53', '2019-09-18 23:44:15'),
(37, 'SRI', 'WAHJUNINGTIYAS', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, Ak.', 'terampil', 'tyas.fnd@gmail.com', '08xxxxxxx', '19740628  199903 2 006', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$nRjKU2bq9Uq925fW1AxBA.qfaSdBUKGTzcw8FKS7U0fEmtNaSoBrC', NULL, '2019-09-11 01:41:03', '2019-09-18 23:46:48'),
(38, 'SUGIHARTI', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos.', 'terampil', 'lidiasugiharti@yahoo.co.id', '08xxxxxxx', '19630614 198508 2 009', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$bTVLpFJ9HXkbFxR8uevnc.qsBUsqI1ca1NQSJlQHrgOnQYP.xkWXG', NULL, '2019-09-11 01:44:21', '2019-09-18 23:46:30'),
(39, 'WALUYANI', 'RETNA D', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST, MT.', 'ahli', 'luluyani@yahoo.com', '08xxxxxxx', '19731013 199803 2 006', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$oonDr6KE.x1xKF5jMTMzje7lldaiwZ/xOK3gs.tRZ3x8Kxc40RXuG', NULL, '2019-09-11 01:49:42', '2019-09-18 23:45:54'),
(40, 'SUSI', 'ROHMAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, MM.', 'ahli', 'aisfari@gmail.com', '08xxxxxxx', '19741017 199803 2 002', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Y2ajEHRpGcq0ChNu.4EDj.LeKT2Q6x5R6bI8qUOVgYIBXrW5P19E2', NULL, '2019-09-11 01:50:42', '2019-09-18 23:45:40'),
(41, 'HARI', 'SUNDJAJA', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos.', 'terampil', 'sudjajahari@yahoo.co.id', '08xxxxxxx', '19671205 199302 1 001', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5LKKIvra64Evjiixj1zw4O6awuJGCX/Mrx4LJFV4K01mJKwW/naY2', NULL, '2019-09-11 01:53:30', '2019-09-18 23:45:27'),
(42, 'I VERA', 'SIADINA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.STP, M.Si.', 'ahli', 'ivrasiadina@gmail.com', '08xxxxxxx', '19790127 199803 2 002', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$KvayPqqCut4S/uZWqFRqreXfkD7h1cT0Avxexz08QMkAD3ulNen1y', NULL, '2019-09-11 01:54:25', '2019-09-18 23:45:11'),
(43, 'HARI', 'SUSANTO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos, MM.', 'ahli', 'hari.faras@gmail.com', '08xxxxxxx', '19700726 199302 1 001', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$IKVd3Ksm3YRRh.LMCId40ONF4IMgbWWSL8VeVF0rCqe6KchIORHd.', NULL, '2019-09-11 02:02:11', '2019-09-18 23:44:55'),
(45, 'SU\'UDAH', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', NULL, 'suudah652@gmail.com', '082139734347', '19690423 199003 2 005', 'Kasubag Perencanaan', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$VyvgybFQx05R8K3Sm.AvAOj8OYezG7c8RhedENdXr6Xp0NaT7pyPK', NULL, '2019-09-11 08:56:20', '2019-09-11 08:56:20'),
(46, 'SRI WAHYUNI', 'INDRAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": null}', 'Perempuan', NULL, '2019-09-29 17:00:00', ',S.Sos', NULL, 'indrawatijasmin@gmail.com', '08123037679', '19710521 199402 2 002', 'Kasubag Administrasi dan Umum', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$lGRFaBiioP3g.YOUtrOLcuzYEge6GVnpy6.Ysj4eUf9l2mVnw4C3a', NULL, '2019-09-11 08:59:06', '2019-12-09 00:05:05'),
(47, 'PARTIWANGGARA', 'A', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SH.', NULL, 'itaagustinanamira@gmail.com', '081217907870', '19780801 200501 2 011', 'Kasubag Administrasi dan Umum', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$hMxGqZGPtwER/VMomUaLre.rJYuMR0NVmVDiUA8F68sC0oBi9dM9e', NULL, '2019-09-11 09:03:41', '2019-09-11 09:03:41'),
(48, 'SINGGIH', 'LAKSONO', '{\"tahun\": \"20xx\", \"jurusan\": \"Ekonomi\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'singgih_lackz82@yahoo.com', '08563577339', '19820626 200604 1 014', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$wbBwCBiDIZYpC2uipZmo2Oq/pGy0q1cVIWcVfiV4phl1Doh9feUiC', NULL, '2019-09-11 09:05:37', '2019-09-18 23:52:31'),
(49, 'AULIA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'terampil', 'auliasari_55@yahoo.com', '087728839138', '19790901 200604 2 023', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$g/CwYk4GIIj9QzsNIp8ogOw09MMDEc7fgogqlj4PGEBQIeijoosE6', NULL, '2019-09-11 09:09:05', '2019-09-18 23:51:52'),
(50, 'TIMUR', 'KARTIKA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', 'S, S.Kom.', 'terampil', 'kartika.timur@yahoo.co.id', '083831690903', '19751003 200604 2 016', 'Auditor Muda', 'III/D', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$HhUcs.Mq9LrE0tzs0gTJheYBqCr2StfnxjNheb2BCH710vaivVS6O', NULL, '2019-09-11 09:10:34', '2019-09-18 23:52:08'),
(51, 'ISNI', 'HIDAYATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.AB.', NULL, 'isni.hidayati@yahoo.com', '08123148165', '19730309 199803 2 008', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', NULL, '2019-09-11 09:13:26', '2019-09-11 09:13:26'),
(52, 'HENI', 'PURWITASARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE, MM.', NULL, 'henipurwitasari1978@gmail.com', '085234324803', '19780508 199809 2 002', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$5ylh6UyP5MK7ZPOcqvPD1ueOI/whyPRfimAUqDZd5rnRFtlGI3Dly', NULL, '2019-09-11 09:18:23', '2019-09-11 09:18:23'),
(53, 'DENNY WIDJAJA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', S.Sos.', NULL, 'dennywidjaja75@yahoo.com', '081330714130', '19750513 200902 2 001', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$rX9qDBeN5FfbyLuJ6OLEN.TTf1JF188OenQwK0gUIB2QGi54.WIQ6', NULL, '2019-09-11 09:19:25', '2019-09-11 09:19:25'),
(54, 'AMIK', 'MARIANA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'amik.mariana@yahoo.com', '087851008893', '19750304 201001 2 005', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$c6NFVrC3VOv5UUBhidA88.ctd2U/POkO/VJuufCsXYqbBr9YYA7QK', NULL, '2019-09-11 09:20:53', '2019-09-18 23:48:16'),
(55, 'RACHMA', 'HASNITA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'ahli', 'pradanarachma@yahoo.co.id', '081331414499', '19771117 201001 2 005', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$WB2ER1a7BIg3fvI/JlD1jOEH4M66BiV7cDcR3QIZ7exCb3ZXjsKNm', NULL, '2019-09-11 09:27:57', '2019-09-18 23:51:09'),
(56, 'DEVI', 'RESTINA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', ST.', 'terampil', 'dvrestina@gmail.com', '081232567706', '19810329 201001 2 015', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$WfRSdu3Sp45f4Z8NSpUBwO5P/7eV.ovB/6pPT0Nt8mAH/84220zKO', NULL, '2019-09-11 09:29:03', '2019-09-18 23:58:00'),
(57, 'NORMA', 'INDRAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'normadaren@gmail.com', '081231032009', '19840822 201001 2 025', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$zffIm4fTRebTm59EyqAEDeAXE/L3NmIbNqi63XgdXrb0auy072V2G', NULL, '2019-09-11 09:30:07', '2019-09-18 23:50:01'),
(58, 'YOGI', 'MAHARDHIKA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', ST.', 'terampil', 'yogi.mahardhika@gmail.com', '082143339774', '19850705 201001 1 017', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$vaKBMrrnNzioNio5xgrreuD5IOL0TOsWe94x.xwLxnGrfNFSLgG82', NULL, '2019-09-11 09:30:54', '2019-09-18 23:49:50'),
(59, 'VIRANI RAKHMA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'emailnyarani.via@gmail.com', '081235465558', '19850830 201001 2 025', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$OQsjWkA2X8JgU9wz.PDBs.jvWwDT9.hoa7yqez7y.Vm3WOZXYlKde', NULL, '2019-09-11 09:34:53', '2019-09-18 23:48:39'),
(60, 'MARIANINGSIH', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'mariaimam76@gmail.com', '081330631871', '19760707 199602 2 002', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tw7fqph2uh.xW44R/RWrrOCiU82QUgoCwk7o73baK8NihJsOxQFpi', NULL, '2019-09-11 09:35:44', '2019-09-18 23:48:55'),
(61, 'HARIYANTO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SH.', 'terampil', 'hary.zildan1020@gmail.com', '081311108484', '19840620 201101 1 012', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Fv3MCZ5WNv1ycwaY4NV0aOCCr50FZeOFioBsiGmLdRB0crVOzy3fi', NULL, '2019-09-11 09:36:55', '2019-09-18 23:49:11'),
(62, 'YAYUK', 'INDAYATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE', NULL, 'yayukasri065@gmail.com', '081332215030', 'YAYUK INDAYATI, SE', 'Kasubag Evaluasi dan Pelaporan', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$S2cH.Zis1O5K8oKTz6WGM.kFC5an66Y4xTw.V/8YLryRborXJXlzK', NULL, '2019-09-11 09:39:02', '2019-09-11 09:39:02'),
(63, 'SULUH JATMIKA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'suluh_ika@yahoo.co.id', '081330594915', '19830511 201001 2 022', 'Auditor Muda', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$e3SjCDB6R5Ydhuo4MtPmw.YcaI0tJwaHBNmSJF3LBXjUQ8kze/HOK', NULL, '2019-09-11 09:40:11', '2019-09-18 23:49:33'),
(64, 'MOCHAMAD', 'ARTFIANDO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SH.', 'terampil', 'ando.munir@yahoo.co.id', '081330032590', '19800604 201001 1 009', 'Auditor Pertama', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$UWRfxWG8IFCsHtK6vwqw4.I4VdLPuplhvWRSyRfUKO.52pcEg4nj2', NULL, '2019-09-11 09:41:40', '2019-09-18 23:52:55'),
(65, 'SUCI', 'NINGHERI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', NULL, NULL, 'uciksutanto@gmail.com', '085258238127', '19640115 198811 2 001', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$hKFvu0n.8FMm7pEgbBUYYebiFIXikY7LYPWXcRdfLMRuj.58EjoXS', NULL, '2019-09-11 09:42:58', '2019-09-18 23:32:51'),
(66, 'UDIN', 'KARYONO', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana 1 (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', S.Sos', NULL, 'udinksidoarjo@gmail.com', '085236544088', '19661025 199101 1 001', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$V2eDJ7w1Al6gFsv2rIIBU.fbJRjmb1Yw8akC6Ht0y8prgLrhesjBO', NULL, '2019-09-11 09:47:55', '2019-09-18 23:38:18'),
(67, 'AGUS', 'GUFRONI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'agusgufroni@gmail.com', '081330448864', '19650830 199303 1 009', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$FJ8HyXuX7/eBnj1JHcA2U.KP9r/iv8wNEtUH9BKtTt/xClV5rRAwC', NULL, '2019-09-11 09:49:03', '2019-09-18 23:33:05'),
(68, 'HENI', 'RESNAWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', 'kosong', NULL, 'heni.resnawati14@gmail.com', '08123095018', '19721214 199503 2 001', 'Pengadministrasi Umum', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$s/nI9G4NeTjGvaYUcQinR.ST/EaiveqSGI1.Xmqg.AyzyHgFt.7Ba', NULL, '2019-09-11 09:51:19', '2019-09-11 09:51:19'),
(69, 'IKA SAFITRI', 'NINGSIH', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', '. S.Si', 'terampil', 'ikasafi3@yahoo.co.id', '08563224858', '19870520 201502 2 001', 'Auditor Pertama', 'III/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$St0fvi9casnxSw28TOKuc.99UdX3GY1EsPWrdKDduICWtLFuVOkDO', NULL, '2019-09-11 10:02:34', '2019-09-18 23:53:22'),
(85, 'Deni', 'Iswantoro', '{\"tahun\": \"2005\", \"jurusan\": \"Manajemen\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', 'Ponorogo', '1985-07-12 17:00:00', 'MM', 'ahli', 'iswanto-ro@gmail.com', '351351351', '92876546852864289', 'Auditor Utama', 'I/D', '{\"nama\": \"IRBAN III\", \"jabatan\": \"anggota\"}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$eRTYQvAFw5tvrmuXuoxf8.2dAm5m9kQ6K/weZ8V1JmzP9dEtAvWIu', NULL, '2019-11-10 19:50:50', '2019-11-10 19:50:50'),
(84, 'Muhammad', 'Ismail', '{\"tahun\": \"2005\", \"jurusan\": \"Pendayagunaan Energi Rohani\", \"tingkat\": \"Doktor (S3)\"}', 'Laki-laki', 'Sidoarjo', '1985-10-11 17:00:00', 'PHd', 'terampil', 'ismail@gmail.com', '+623876543', '6545454548', 'Auditor Utama', 'I/D', '{\"nama\": \"IRBAN III\", \"jabatan\": \"kepala\"}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$ciKMbKXJ0Xnlw3Sq5/4I6O3HdbwXIF0xhpLI5dZmrAQvzZTXPi7Oy', NULL, '2019-11-10 19:47:44', '2019-11-10 19:47:44'),
(81, 'Ahmad', 'Ardiansyah', '{\"tahun\": \"2010\", \"jurusan\": \"Sarjana Manajemen Airlangga\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', 'Surabaya', '1980-11-25 17:00:00', 'MM', 'terampil', 'ardi@gmail.com', '+628997766554', '567.890.21.345', 'Auditor Muda', 'II/A', '{\"nama\": \"IRBAN II\", \"jabatan\": \"anggota\"}', '{\"1\": {\"name\": \"Pemberdayaan Manusia\", \"tahun\": \"2012\", \"instansi\": \"Diknas\"}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$UnKFGwdJnqZylyXqQ2sZcOCoIlynlqG.UUBQwHxVfaobowapz79xC', NULL, '2019-10-30 00:17:09', '2019-12-15 20:18:58'),
(6, 'Super', 'Admin', NULL, NULL, NULL, '2019-06-18 05:32:57', NULL, NULL, 'admin@local.host', 'admin@local.host', '90909090', 'Inspektur Kabupaten', 'I/A', NULL, NULL, NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', 'jO4izk7aJha20HUY1fYNtVnQTzqvvEwsJHRMXrLegQY2LSq7YdqLPEVBrFh3', '2019-06-18 05:32:57', '2019-06-18 05:32:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
