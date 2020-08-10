-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2019 at 01:28 AM
-- Server version: 5.7.24
-- PHP Version: 7.1.26

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
  `peran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` int(11) DEFAULT NULL,
  `dupak` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_spt`
--

INSERT INTO `detail_spt` (`id`, `spt_id`, `user_id`, `peran`, `lama`, `dupak`) VALUES
(15, 5, 4, 'Pembantu Penanggung jawab', 2, NULL),
(14, 5, 2, 'Pembantu Penanggung jawab', 1, NULL),
(5, 2, 4, 'Supervisor', 6, NULL),
(6, 2, 2, 'Penanggung Jawab', 6, NULL),
(7, 2, 3, 'Pengendali Mutu', 6, NULL),
(8, 2, 1, 'Ketua Tim', 6, NULL),
(16, 5, 5, 'Supervisor', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_spt`
--

DROP TABLE IF EXISTS `jenis_spt`;
CREATE TABLE IF NOT EXISTS `jenis_spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dasar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_spt`
--

INSERT INTO `jenis_spt` (`id`, `name`, `dasar`, `isi`, `view_mode`, `created_at`, `updated_at`) VALUES
(1, 'Audit Kinerja Desa', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;tentang Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Menteri Pendayagunaan Aparatur Negara Nomor PER/05/M.PAN/03/2008 tanggal 31 Maret 2008 tentang Standar Audit Aparat Pengawasan Intern Pemerintah;</li><li>Peraturan Pemerintah Nomor 60 Tahun 2008 tentang Sistem Pengendalian Intern Pemerintah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p>Untuk Melaksanakan Audit Kinerja di %lokasi% atas Kegiatan&nbsp; Pelaksanaan Pengawasan Internal secara berkala Tahun %tahun%.</p><p>Jangka waktu pemeriksaan&nbsp; efektif selama&nbsp; &nbsp;%terbilang%&nbsp; hari&nbsp; kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', NULL, '2019-05-26 23:10:08', '2019-05-26 23:23:01'),
(2, 'Evaluasi SKPD', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 2014 tentang Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk melaksanakan %nama% %lokasi%.</span><br></p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode %tgl_mulai%&nbsp; &nbsp; s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', NULL, '2019-05-28 18:53:36', '2019-06-11 23:05:50'),
(3, 'Evaluasi AKIP', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<p>Untuk melakukan pemeriksaan guna menyelesaikan %nama%, di %lokasi%.</p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai%&nbsp; &nbsp;s.d&nbsp; &nbsp; %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', NULL, '2019-05-28 20:19:50', '2019-06-11 21:02:48'),
(4, 'PKKN', '<p><span style=\"font-size:12.0pt;font-family:&quot;Maiandra GD&quot;,&quot;sans-serif&quot;;\r\nmso-fareast-font-family:&quot;Arial Unicode MS&quot;;mso-bidi-font-family:Tahoma;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Surat\r\ndari Kejaksaan Negeri Kabupaten Sidoarjo &nbsp;tanggal 9 Agustus 2018 Nomor : B-329/O.5.30/Fd.1/08/2018\r\nperihal Bantuan Penghitungan Kerugian &nbsp;Keuangan Negara</span><br></p>', '<p>Untuk melaksanakan Audit Lanjutan terhadap Penghitungan Kerugian Keuangan Negara terhadap %nama% %lokasi% yang berasal dari APBD Pemerintah Propinsi Jawa Timur Tahun Anggaran 2016.</p><p>Jangka waktu pemeriksaan tersebut efektif&nbsp; selama&nbsp; %lama% kerja pada periode tanggal&nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', NULL, '2019-06-11 21:25:10', '2019-06-11 21:25:10'),
(5, 'Konsulting', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 2014 tentang Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk melaksanakan Program Konsulting %nama% di %lokasi%.</span><br></p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', NULL, '2019-06-11 23:53:16', '2019-06-11 23:53:16'),
(6, 'LKPD', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;</li><li><span style=\"font-size: 1rem;\">Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</span><br></li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Pemerintah Nomor 8 Tahun 2006 tentang Laporan Keuangan dan Kinerja Instansi Pemerintah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk melaksanakan %nama% Laporan Keuangan Pemerintah Daerah (LKPD) Tahun 2017 pada tanggal&nbsp; &nbsp; %tgl_mulai%&nbsp; &nbsp; s.d&nbsp; &nbsp; %tgl_akhir%, didahului&nbsp; dengan Pra Reviu.</span><br></p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', NULL, '2019-06-11 23:56:51', '2019-06-11 23:56:51'),
(7, 'Monev', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<p>Untuk melakukan pemeriksaan guna menyelesaikan %nama%,&nbsp; %lokasi%.</p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', NULL, '2019-06-12 00:04:43', '2019-06-12 00:04:43'),
(8, 'Reguler', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<div>Melaksanakan %nama%. Di %lokasi%.</div><div>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal %tgl_mulai% s.d %tgl_akhir%.</div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div>', NULL, '2019-06-12 00:28:12', '2019-06-12 00:32:19'),
(9, 'Renja', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Pemerintah Nomor 58 Tahun 2005 tentang Pengelolaan Keuangan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah sebagaimana telah diubah beberapa kali terakhir dengan Peraturan Pemerintah Dalam Negeri Nomor 21 Tahun 2011 tentang Perubahan kedua Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p style=\"text-align: justify; \">Untuk Melaksanakan Reviu Renja %nama%, sebagaimana daftar terlampir.</p><p style=\"text-align: justify; \">Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%</p><p style=\"text-align: justify; \">Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div style=\"text-align: justify; \"><br></div>', 'split', '2019-06-12 19:39:26', '2019-06-12 19:39:26');

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

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(6, 'App\\models\\Profile', 1, 'pic', 'rock-n-roll', 'rock-n-roll.jpg', 'image/jpeg', 'public', 87645, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 1, '2019-05-21 10:07:30', '2019-05-21 10:07:31');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_28_081130_create_permission_tables', 1),
(4, '2019_05_07_135656_create_profiles_table', 1),
(5, '2019_05_10_080615_create_media_table', 1),
(8, '2019_05_16_151751_create_jenis_spts_table', 2),
(14, '2019_05_16_152107_create_spts_table', 3),
(15, '2019_05_28_061257_detail_spt', 3);

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
(3, 'App\\User', 3),
(4, 'App\\User', 2),
(5, 'App\\User', 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 'Edit Signed SPT', 'web', '2019-05-19 19:58:47', '2019-05-19 19:58:47');

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

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `address`, `city`, `country`, `zipcode`, `cover`, `pic`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jalan jalan saja yuk', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 21:28:14', '2019-05-20 21:28:14');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2019-05-16 08:51:30', '2019-05-19 20:01:02'),
(2, 'guest', 'web', '2019-05-16 08:51:31', '2019-05-16 08:51:31'),
(3, 'TU Umum', 'web', '2019-05-19 19:57:43', '2019-05-19 19:57:43'),
(4, 'TU Perencanaan', 'web', '2019-05-19 19:58:21', '2019-05-19 19:58:21'),
(5, 'Auditor', 'web', '2019-05-31 00:08:50', '2019-05-31 00:08:50');

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
(3, 1),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(6, 1),
(6, 3),
(6, 4),
(7, 1),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `spt`
--

DROP TABLE IF EXISTS `spt`;
CREATE TABLE IF NOT EXISTS `spt` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_spt_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `tgl_mulai` timestamp NOT NULL,
  `tgl_akhir` timestamp NOT NULL,
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_status` enum('approved','rejected','processing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `approval_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Approval User ID',
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'give note if approval status rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spt_jenis_spt_id_foreign` (`jenis_spt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spt`
--

INSERT INTO `spt` (`id`, `jenis_spt_id`, `name`, `nomor`, `tgl_mulai`, `tgl_akhir`, `lokasi`, `approval_status`, `approval_by`, `notes`, `created_at`, `updated_at`) VALUES
(5, 5, 'Penjemuran Ikan Asin di Sepanjang', NULL, '2019-06-03 17:00:00', '2019-06-25 17:00:00', 'Sepanjang Taman Sidoarjo', 'processing', NULL, NULL, '2019-06-24 01:26:49', '2019-06-24 01:26:49'),
(2, 7, 'baru', NULL, '2019-05-31 17:00:00', '2019-06-14 17:00:00', 'Tanah Abang', 'approved', NULL, NULL, '2019-06-13 00:01:20', '2019-06-13 00:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `nip`, `jabatan`, `pangkat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Super', 'Admin', 'admin@local.host', 'admin@local.host', '90909090', 'Inspektur Kabupaten', 'I/A', NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', 'b2hQ8AJgp5okkaWoTbX8hQhrexKhAGDeCIB0MJT9dh4wUM3G3tTRZ60tojda', '2019-06-18 19:32:57', '2019-06-18 19:32:57'),
(2, 'Bag', 'Perencanaan', 'rencana@local.host', '08885656', '', NULL, NULL, NULL, '$2y$10$ie3FCXY1.lE4IcRFFR9pc.JjqyW.JbW5pg9furifvhyKXIdZvpn16', NULL, '2019-06-03 10:11:39', '2019-06-03 10:11:39'),
(3, 'Bag', 'Umum', 'umum@local.host', '856789', '', NULL, NULL, NULL, '$2y$10$RmvHlAsX5zsWQzc/2T80S.f4N.gkrjf58v/xuzoY5ZGJ3Lp9TPi2i', NULL, '2019-06-03 10:12:15', '2019-06-03 10:12:15'),
(4, 'Auditor', 'Auditor', 'audit@local.host', '88877888', '', NULL, NULL, NULL, '$2y$10$TgpT8ooFc8SkZ/TMnMinru2mXP1aSzvXs6v4RsYTbywxxDIomaQGO', NULL, '2019-06-03 10:13:02', '2019-06-03 10:13:02'),
(5, 'Tegar', 'WPIP', 'tegar@local.host', '+628567892', NULL, NULL, NULL, NULL, '$2y$10$GI0kjoxWCtpDOGFFX5oy3uVlB.itkdo8tCUP3ordw6D/6uT7mgDnS', NULL, '2019-06-18 01:09:02', '2019-06-18 01:09:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
