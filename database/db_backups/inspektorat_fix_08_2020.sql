-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2020 at 03:25 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspektogar`
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
  `file_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif jika nomor spt terupdate dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_dupak` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(58, 'Tahun Baru', '2020-01-01 00:00:00', '2020-01-02 00:00:00', NULL, '2020-01-30 04:14:19', '2020-01-30 04:14:19');

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

--
-- Dumping data for table `jenis_spt`
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
(18, 'Reviu LKPD', 'Reviu Laporan Keuangan Pemerintah Daerah (LKPD)', 'Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;\r\nPeraturan Negeri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nPeraturan Pemerintah Nomor 8 Tahun 2006 tentang Laporan Keuangan dan Kinerja Instansi Pemerintah;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-10 23:48:24', '2020-03-10 23:48:24'),
(19, 'Evaluasi Hibah', 'Evaluasi Hibah', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:48:39', '2020-03-12 19:48:39'),
(20, 'Monitoring PKD', 'Monitoring Pengelolaan Keuangan Desa', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:50:02', '2020-03-12 19:50:02'),
(21, 'Reviu RKPD', 'Reviu Rencana Kerja Pemerintah  Daerah (RKPD)', 'Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 86 Tahun 2017 tentang Tata Cara Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah, Tata Cara Evaluasi Rancangan Peraturan Daerah tentang Rencana Pembangunan Jangka Panjang Daerah dan Rencana Pembangunan Jangka Menengah Daerah, serta Tata Cara Perubahan Rencana Pembangunan Jangka Panjang Daerah, Rencana Pembangunan Jangka Menengah Daerah, dan Rencana Kerja Pemerintah Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 10 Tahun 2018 tentang Reviu atas Dokumen Perencanaan Pembangunan dan Anggaran Tahunan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:52:25', '2020-03-12 19:52:25'),
(22, 'Reviu RKAP', 'Reviu Rencana Kerja dan Anggaran Perubahan (RKAP)  SKPD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 79 Tahun 2005     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor  110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;\r\nPeraturan Menteri Dalam Negeri Nomor 33 Tahun 2017 tentang Pedoman Penyusunan APBD Tahun Anggaran 2018;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:55:34', '2020-03-12 19:55:34'),
(23, 'Reviu RKA', 'Reviu Rencana Kerja dan Anggaran (RKA) PAPBD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri  Nomor 35  Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan Menteri Dalam Negeri Nomor  38 Tahun  2018 tentang Pedoman Penyusunan APBD Tahun Anggaran 2019;\r\nPeraturan Menteri Dalam Negeri Nomor  10 Tahun 2018 tentang Reviu Atas Dokumen Perencanaan Pembangunan dan Anggaran Daerah Tahunan;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:56:48', '2020-03-12 19:56:48'),
(24, 'Reviu LKIP', 'Reviu Laporan Kinerja Instansi Pemerintah', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nPeraturan Menteri Pendayagunaan Aparatur Negara Nomor 53 Tahun 2014 tentang Petunjuk Teknis Perjanjian Kinerja, Pelaporan Kinerja dan Tata Cara Reviu Atas Laporan Kinerja Instansi Pemerintah;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;\r\nUndangan Sekretaris Daerah Kabupaten Sidoarjo tanggal 20 Maret 2019 Nomor : 130/2452/438.1.2.2/2019 perihal Review atas Laporan Kinerja Instansi Pemerintah (LkjIP) Kabupaten Sidoarjo Tahun 2018;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:57:58', '2020-03-12 19:57:58'),
(25, 'RKA APBD', 'Reviu RKA – APBD TA. 2020/ RKA - PPKD 2020', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri  Nomor  35 Tahun 2018 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nPeraturan  Menteri Dalam  Negeri Nomor 38 Tahun 2018 tentang Pedoman Penyusunan APBD Tahun Anggaran 2019;\r\nPeraturan Menteri Dalam Negeri  Nomor 10 Tahun 2018 tentang Reviu Atas Dokumen Perencanaan Pembangunan dan Anggaran Daerah Tahunan;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 19:59:03', '2020-03-12 19:59:03'),
(26, 'Reviu RKPD Tahun 2020', 'Reviu Rencana Kerja Perangkat Daerah Tahun 2020', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"1\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 20:03:17', '2020-03-12 20:03:17'),
(27, 'Reviu SOP', 'Reviu Standart Operasional Prosedure (SOP)', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nStandar Audit Aparat Pengawasan Intern Pemerintah (Asosiasi Auditor Intern Pemerintah Indonesia/AAIPI);\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2020;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 20:04:29', '2020-03-12 20:04:29'),
(28, 'Penyusunan SOP SAKIP', 'Penyusunan  Standard  Operating  Procedure (SOP) Evaluasi Implementasi Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) OPD', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nKeputusan Asosiasi Auditor Intern Pemerintah Indonesia (AAIPI) Nomor : KEP-005/AAIPI/DPN/2014 tentang Pemberlakuan Kode Etik Auditor Intern Pemerintah Indonesia, Standart Audit Intern Pemerintah Indonesia, Dan Pedoman Telaah Sejawat Auditor Intern Pemerintah Indonesia;\r\nPeraturan Menteri Dalam Negeri Nomor 35 Tahun 2018 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2019;\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"0\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 20:05:46', '2020-03-12 20:05:46'),
(29, 'Telaah Sejawat', 'Telaah Sejawat', 'Undang - Undang Republik Indonesia Nomor 23 Tahun  2014  Tentang  Pemerintah Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017     tentang Pembinaan dan Pengawasan Penyelenggaraan    Pemerintahan Daerah;\r\nPeraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan  Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;\r\nStandar Audit Aparat Pengawasan Intern Pemerintah (Asosiasi Auditor Intern Pemerintah Indonesia/AAIPI);\r\nProgram Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2019;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 20:06:55', '2020-03-12 20:06:55'),
(30, 'Verifikasi dan Validasi (VERVAL)', 'Verifikasi dan Validasi', 'Peraturan Pemerintah Republik Indonesia Nomor 6 Tahun 2008     tentang Pedoman Evaluasi Penyelenggaraan Pemerintahan Daerah;\r\nPeraturan Pemerintah Republik Indonesia Nomor 13 Tahun 2019     tentang Laporan dan Evaluasi Penyelenggaraan Pemerintah Daerah;', '700', '{\"lokasi\": \"0\", \"tambahan\": \"1\"}', '{\"1\": null, \"2\": null}', 'pengawasan', '2020-03-12 20:08:10', '2020-03-12 20:08:10');

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

--
-- Dumping data for table `kode_temuan`
--

INSERT INTO `kode_temuan` (`id`, `sort_id`, `parent_id`, `kode`, `deskripsi`, `atribut`) VALUES
(1, 1, 0, '1', 'Temuan Ketidakpatuhan Terhadap Peraturan', '{\"kelompok\": null, \"subkelompok\": null}'),
(2, 2, 0, '2', 'Temuan kelemahan sistem pengendalian intern', '{\"kelompok\": null, \"subkelompok\": null}'),
(3, 3, 0, '3', 'Temuan 3E', '{\"kelompok\": null, \"subkelompok\": null}'),
(4, 4, 1, '01', 'Kerugian negara/daerah atau kerugian negara/daerah\r\nyang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(5, 6, 4, '02', 'Rekanan pengadaan barang/jasa tidak menyelesaikan pekerjaan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(6, 7, 4, '03', 'Kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(7, 8, 4, '04', 'Kelebihan pembayaran selain kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(8, 9, 4, '05', 'Pemahalan harga (Mark up)', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(9, 10, 4, '06', 'Penggunaan uang/barang untuk kepentingan pribadi', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(10, 11, 4, '07', 'Pembayaran honorarium dan/atau biaya perjalanan dinas ganda dan/atau melebihi standar yang ditetapkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(11, 12, 4, '08', 'Spesifikasi barang/jasa yang diterima tidak sesuai dengan kontrak', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(12, 13, 4, '09', 'Belanja tidak sesuai atau melebihi ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(13, 14, 4, '10', 'Pengembalian pinjaman/piutang atau dana bergulir macet', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(14, 15, 4, '11', 'Kelebihan penetapan dan pembayaran restitusi pajak atau penetapan kompensasi kerugian', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(15, 16, 4, '12', 'Penjualan/pertukaran/penghapusan aset negara/daerah tidak sesuai ketentuan dan merugikan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(16, 17, 4, '13', 'Pengenaan ganti kerugian negara belum/tidak dilaksanakan sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(17, 18, 4, '14', 'Entitas belum/tidak melaksanakan tuntutan perbendaharaan (TP) sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(18, 19, 4, '15', 'Penghapusan hak tagih tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(19, 20, 4, '16', 'Pelanggaran ketentuan pemberian diskon penjualan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(20, 21, 4, '17', 'Penentuan HPP (harga pokok pembelian) terlalu rendah sehingga penentuan harga jual lebih rendah dari yang seharusnya', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(21, 22, 4, '18', 'Jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak dapat dicairkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(22, 23, 4, '19', 'Penyetoran penerimaan negara/daerah dengan bukti fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(25, 26, 1, '02', 'Potensi kerugian negara/daerah atau kerugian negara/daerah yang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(26, 27, 25, '01', 'Kelebihan pembayaran dalam pengadaan barang/jasa tetapi pembayaran pekerjaan belum dilakukan sebagian atau seluruhnya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(27, 28, 25, '02', 'Rekanan belum melaksanakan kewajiban pemeliharaan barang hasil pengadaan yang telah rusak selama masa pemeliharaan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(28, 29, 25, '03', 'Aset dikuasai pihak lain', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(29, 30, 25, '04', 'Pembelian aset yang berstatus sengketa', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(30, 31, 25, '05', 'Aset tidak diketahui keberadaannya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(31, 32, 25, '06', 'Pemberian jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(32, 33, 25, '07', 'Pihak ketiga belum melaksanakan kewajiban untuk menyerahkan aset kepada negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(33, 34, 25, '08', 'Piutang/pinjaman atau dana bergulir yang berpotensi tidak tertagih', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(34, 35, 25, '09', 'Penghapusan piutang tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(35, 36, 25, '10', 'Pencairan anggaran pada akhir tahun anggaran untuk pekerjaan yang belum selesai', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(36, 37, 1, '03', 'Kekurangan penerimaan negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(37, 38, 36, '01', 'Penerimaan negara/daerah atau denda keterlambatan pekerjaan belum/tidak ditetapkan dipungut/diterima/disetor ke kas negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(38, 39, 36, '02', 'Penggunaan langsung penerimaan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(39, 40, 36, '03', 'Dana Perimbangan yang telah ditetapkan belum masuk ke kas daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(40, 41, 36, '04', 'Penerimaan negara/daerah diterima atau digunakan oleh instansi yang tidak berhak', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(41, 42, 36, '05', 'Pengenaan tarif pajak/PNBP lebih rendah dari ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(42, 43, 36, '06', 'Koreksi perhitungan bagi hasil dengan KKKS', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(43, 44, 36, '07', 'Kelebihan pembayaran subsidi oleh pemerintah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(44, 45, 1, '04', 'Administrasi', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(45, 46, 44, '01', 'Pertanggungjawaban tidak akuntabel (bukti tidak lengkap/tidak valid)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(46, 47, 44, '02', 'Pekerjaan dilaksanakan mendahului kontrak atau penetapan anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(47, 48, 44, '03', 'Proses pengadaan barang/jasa tidak sesuai ketentuan (tidak menimbulkan kerugian negara)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(48, 49, 44, '04', 'Pemecahan kontrak untuk menghindari pelelangan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(49, 50, 44, '05', 'Pelaksanaan lelang secara performa', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(50, 51, 44, '06', 'Penyimpangan terhadap peraturan perundang-undangan bidang pengelolaan perlengkapan atau barang milik negara/daerah/perusahaan\r\n', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(51, 52, 44, '07', 'Penyimpangan terhadap peraturan perundang-undangan bidang tertentu lainnya seperti kehutanan, pertambangan, perpajakan, dll', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(52, 53, 44, '08', 'Koreksi perhitungan subsidi/kewajiban pelayanan umum', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(53, 54, 44, '09', 'Pembentukan cadangan piutang, perhitungan penyusutan atau amortisasi tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(54, 55, 44, '10', 'Penyetoran penerimaan negara/daerah atau kas di bendaharawan ke kas negara/daerah melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(55, 56, 44, '11', 'Pertanggungjawaban/penyetoran uang persediaan melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(56, 57, 44, '12', 'Sisa kas di bendahara pengeluaran akhir tahun anggaran belum/tidak disetor ke kas negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(57, 58, 44, '13', 'Pengeluaran investasi pemerintah tidak didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(58, 59, 44, '14', 'Kepemilikan aset tidak/belum didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(59, 60, 44, '15', 'Pengalihan anggaran antar MAK tidak sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(60, 61, 44, '16', 'Pelampauan pagu anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(61, 62, 1, '05', 'Indikasi tindak pidana', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(62, 63, 61, '01', 'Indikasi tindak pidana korupsi', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(63, 64, 61, '02', 'Indikasi tindak pidana perbankan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(64, 65, 61, '03', 'Indikasi tindak pidana perpajakan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(65, 66, 61, '04', 'Indikasi tindak pidana kepabeanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(66, 67, 61, '05', 'Indikasi tindak pidana kehutanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(67, 68, 61, '06', 'Indikasi tindak pidana pasar modal', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(68, 69, 61, '07', 'Indikasi tindak pidana khusus lainnya', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(69, 70, 2, '01', 'Kelemahan sistem pengendalian akuntansi dan pelaporan', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(70, 71, 69, '01', 'Pencatatan tidak/belum dilakukan atau tidak akurat', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(71, 72, 69, '02', 'Proses penyusunan laporan tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(72, 73, 69, '03', 'Entitas terlambat menyampaikan laporan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(73, 74, 69, '04', 'Sistem informasi akuntansi dan pelaporan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(74, 75, 69, '05', 'Sistem informasi akuntansi dan pelaporan belum didukung SDM yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(75, 76, 2, '02', 'Kelemahan sistem pengendalian pelaksanaan anggaran pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(76, 77, 75, '01', 'Perencanaan kegiatan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(77, 78, 75, '02', 'Mekanisme pemungutan, penyetoran dan pelaporan serta penggunaan Penerimaan negara/daerah/perusahaan dan hibah tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(78, 79, 75, '03', 'Penyimpangan terhadap peraturan perundang-undangan bidang teknis tertentu atau ketentuan intern organisasi yang diperiksa tentang pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(79, 80, 75, '04', 'Pelaksanaan belanja di luar mekanisme APBN/APBD', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(80, 81, 75, '05', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat hilangnya potensi penerimaan/pendapatan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(81, 82, 75, '06', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat peningkatan biaya /belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(82, 83, 75, '07', 'Kelemahan pengelolaan fisik aset', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(83, 84, 2, '03', 'Kelemahan struktur pengendalian intern', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(84, 85, 83, '01', 'Entitas tidak memiliki SOP yang formal untuk suatu prosedur atau keseluruhan prosedur', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(85, 86, 83, '02', 'SOP yang ada pada entitas tidak berjalan secara optimal atau tidak ditaati', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(86, 87, 83, '03', 'Entitas tidak memiliki satuan pengawas intern', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(87, 88, 83, '04', 'Satuan pengawas intern yang ada tidak memadai atau tidak berjalan optimal', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(88, 89, 83, '05', 'Tidak ada pemisahan tugas dan fungsi yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(89, 90, 3, '01', 'Ketidakhematan/pemborosan/ketidakekonomisan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(90, 91, 89, '01', 'Pengadaan barang/jasa melebihi kebutuhan', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(91, 92, 89, '02', 'Penetapan kualitas dan kuantitas barang/jasa yang digunakan tidak sesuai standar', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(92, 93, 89, '03', 'Pemborosan keuangan negara/daerah/perusahaan atau kemahalan harga', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(93, 94, 3, '02', 'Ketidakefisienan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(94, 95, 93, '01', 'Penggunaan kuantitas input untuk satu satuan output lebih besar/tinggi dari yang seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(95, 96, 93, '02', 'Penggunaan kualitas input untuk satu satuan output lebih tinggi dari seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(96, 97, 3, '03', 'Ketidakefektifan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(97, 98, 96, '01', 'Penggunaan anggaran tidak tepat sasaran/tidak sesuai peruntukan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(98, 99, 96, '02', 'Pemanfaatan barang/jasa dilakukan tidak sesuai dengan rencana yang ditetapkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(99, 100, 96, '03', 'Barang yang dibeli belum/tidak dapat dimanfaatkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(100, 101, 96, '04', 'Pemanfaatan barang/jasa tidak berdampak terhadap pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(101, 102, 96, '05', 'Pelaksanaan kegiatan terlambat/terhambat sehingga mempengaruhi pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(102, 103, 96, '06', 'Pelayanan kepada masyarakat tidak optimal', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(103, 104, 96, '07', 'Fungsi atau tugas instansi yang diperiksa tidak diselenggarakan dengan baik termasuk target penerimaan tidak tercapai', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(104, 105, 96, '08', 'Penggunaan biaya promosi/pemasaran tidak efektif', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(105, 5, 4, '01', 'Belanja dan/atau pengadaan barang/jasa fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_lhp`
--

DROP TABLE IF EXISTS `laporan_lhp`;
CREATE TABLE IF NOT EXISTS `laporan_lhp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_lhp` varchar(20) DEFAULT NULL,
  `custom_date` timestamp NOT NULL,
  `spt_id` int(11) NOT NULL,
  `tujuan_pemeriksaan` json NOT NULL,
  `ruang_lingkup_pemeriksaan` json NOT NULL,
  `batasan_pemeriksaan` json NOT NULL,
  `pendekatan_pemeriksaan` json NOT NULL,
  `hasil_pemeriksaan` json NOT NULL,
  `sebab_pemeriksaan` json NOT NULL,
  `akibat_pemeriksaan` json NOT NULL,
  `kometar_pemeriksaan` json NOT NULL,
  `rekomendasi_pemeriskaan` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `kondisi` json DEFAULT NULL,
  `kriteria` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `jenis_lokasi`, `sebutan_pimpinan`, `kecamatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sekretariat DPRD', 'OPD', 'Sekretaris DPRD', NULL, NULL, '2020-02-05 04:15:47', '2020-02-05 04:15:47'),
(2, 'Sekretariat Daerah (Bagian Administrasi Pemerintahan)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:25:08', '2020-02-05 07:25:08'),
(3, 'Sekretariat Daerah (Bagian Kerjasama)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:26:32', '2020-02-05 07:26:32'),
(4, 'Sekretariat Daerah (Bagian Administrasi KESRA dan Kemasyarakatan)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:26:52', '2020-02-05 07:26:52'),
(5, 'Sekretariat Daerah (Bagian Administrasi Perekonomian dan SDA)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:27:04', '2020-02-05 07:27:04'),
(6, 'Sekretariat Daerah (Bagian Administrasi Pembangunan)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:27:19', '2020-02-05 07:27:19'),
(7, 'Sekretariat Daerah (Bagian Telekomunikasi dan Informatika)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:27:52', '2020-02-05 07:27:52'),
(8, 'Sekretariat Daerah (Bagian Organisasi)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:28:02', '2020-02-05 07:28:02'),
(9, 'Sekretariat Daerah (Bagian Hukum)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:28:10', '2020-02-05 07:28:10'),
(10, 'Sekretariat Daerah (Bagian Humas dan Protokol)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:28:17', '2020-02-05 07:28:17'),
(11, 'Sekretariat Daerah (Bagian Umum)', 'OPD', 'Kepala Bagian', NULL, NULL, '2020-02-05 07:28:23', '2020-02-05 07:28:23'),
(12, 'Badan Perencanaan Pembangunan Daerah (BAPPEDA)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:37:04', '2020-02-05 07:37:04'),
(13, 'Badan Kepegawaian Daerah (BKD)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:51:48', '2020-02-05 07:51:48'),
(14, 'Badan Pelayanan Perijinan Terpadu', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:07', '2020-02-05 07:52:07'),
(15, 'Badan Lingkungan Hidup', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:16', '2020-02-05 07:52:16'),
(16, 'Badan Kesatuan Bangsa dan Politik (Bakesbangpol)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:32', '2020-02-05 07:52:32'),
(17, 'Badan Pemberdayaan Masyarakat, perempuan, dan keluarga berencana (BPMPKB)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:39', '2020-02-05 07:52:39'),
(18, 'Badan Ketahanan Pangan (BKP)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:45', '2020-02-05 07:52:45'),
(19, 'Badan Penanggulangan Bencana Daerah (BPBD)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:50', '2020-02-05 07:52:50'),
(20, 'Dinas Pendidikan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:52:55', '2020-02-05 07:52:55'),
(21, 'Dinas Kesehatan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:16', '2020-02-05 07:53:16'),
(22, 'Dinas Sosial dan Tenaga Kerja', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:22', '2020-02-05 07:53:22'),
(23, 'Dinas Kependudukan dan Pencatatan Sipil', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:28', '2020-02-05 07:53:28'),
(24, 'Dinas Pemuda, Olahraga, Kebudayaan, dan Pariwisata (DISPORABUDPAR)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:33', '2020-02-05 07:53:33'),
(25, 'Dinas Perhubungan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:37', '2020-02-05 07:53:37'),
(26, 'Dinas Koperasi, UKM, Perindustrian, Perdagangan, dan ESDM', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:42', '2020-02-05 07:53:42'),
(27, 'Dinas Pertanian, Perkebunan, dan Peternakan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:47', '2020-02-05 07:53:47'),
(28, 'Dinas Kelautan dan Perikanan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:52', '2020-02-05 07:53:52'),
(29, 'Dinas Pasar', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:53:56', '2020-02-05 07:53:56'),
(30, 'Dinas Pekerjaan Umum Cipta Karya dan Tata Ruang', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:01', '2020-02-05 07:54:01'),
(31, 'Dinas Pekerjaan Umum Bina Marga', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:05', '2020-02-05 07:54:05'),
(32, 'Dinas Pekerjaan Umum Pengairan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:10', '2020-02-05 07:54:10'),
(33, 'Dinas Kebersihan dan Pertamanan', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:15', '2020-02-05 07:54:15'),
(34, 'Dinas Pendapatan, Pengelolaan Keuangan dan Aset (DPPKA)', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:20', '2020-02-05 07:54:20'),
(35, 'Kantor Perpustakaan dan Arsip', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:24', '2020-02-05 07:54:24'),
(36, 'Satuan Polisi Pamong Praja', 'OPD', 'Kepala', NULL, NULL, '2020-02-05 07:54:29', '2020-02-05 07:54:29'),
(68, 'SMPN 1 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:45:00', '2020-03-10 07:45:00'),
(40, 'Rumah Sakit Umum Daerah', 'UPTD', 'Direktur', NULL, NULL, '2020-03-10 03:45:58', '2020-03-10 03:45:58'),
(42, 'Puskesmas Sidoarjo', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:41:55', '2020-03-10 06:41:55'),
(43, 'Puskesmas Urang Agung', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:44:36', '2020-03-10 06:44:36'),
(44, 'Puskesmas Sekardangan', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:45:01', '2020-03-10 06:45:01'),
(45, 'Puskesmas Buduran', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:45:11', '2020-03-10 06:45:11'),
(46, 'Puskesmas Candi', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:48:58', '2020-03-10 06:48:58'),
(47, 'Puskesmas Porong', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 06:49:11', '2020-03-10 06:49:11'),
(48, 'Puskesmas Kedung Solo', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:24:36', '2020-03-10 07:24:36'),
(49, 'Puskesmas Jabon', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:17', '2020-03-10 07:25:17'),
(50, 'Puskesmas Krembung', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:23', '2020-03-10 07:25:23'),
(51, 'Puskesmas Tanggulangin', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:37', '2020-03-10 07:25:37'),
(52, 'Puskesmas Tulangan', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:44', '2020-03-10 07:25:44'),
(53, 'Puskesmas Kepadangan', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:49', '2020-03-10 07:25:49'),
(54, 'Puskesmas Taman', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:25:58', '2020-03-10 07:25:58'),
(55, 'Puskesmas Trosobo', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:04', '2020-03-10 07:26:04'),
(56, 'Puskesmas Sukodono', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:21', '2020-03-10 07:26:21'),
(57, 'Puskesmas Sedati', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:31', '2020-03-10 07:26:31'),
(58, 'Puskesmas waru', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:37', '2020-03-10 07:26:37'),
(59, 'Puskesmas Medaeng', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:42', '2020-03-10 07:26:42'),
(60, 'Puskesmas Gedangan', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:48', '2020-03-10 07:26:48'),
(61, 'Puskesmas Ganting', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:55', '2020-03-10 07:26:55'),
(62, 'Puskesmas Krian', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:26:59', '2020-03-10 07:26:59'),
(63, 'Puskesmas Barengkrajan', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:27:04', '2020-03-10 07:27:04'),
(64, 'Puskesmas Tarik', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:27:10', '2020-03-10 07:27:10'),
(65, 'Puskesmas Balongbendo', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:27:15', '2020-03-10 07:27:15'),
(66, 'Puskesmas Prambon', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:27:22', '2020-03-10 07:27:22'),
(67, 'Puskesmas Wonoayu', 'UPTD', 'Kepala', NULL, NULL, '2020-03-10 07:27:28', '2020-03-10 07:27:28'),
(69, 'SMPN 2 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:45:13', '2020-03-10 07:45:13'),
(70, 'SMPN 3 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:45:21', '2020-03-10 07:45:21'),
(71, 'SMPN 4 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:45:56', '2020-03-10 07:45:56'),
(72, 'SMPN5 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:46:03', '2020-03-10 07:46:03'),
(73, 'SMPN 6 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 07:46:11', '2020-03-10 07:46:11'),
(74, 'SMPN 1 BALONGBENDO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:22', '2020-03-10 08:37:22'),
(75, 'SMPN 2 BALONGBENDO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:29', '2020-03-10 08:37:29'),
(76, 'SMPN 1 BUDURAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:35', '2020-03-10 08:37:35'),
(77, 'SMPN 2 BUDURAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:42', '2020-03-10 08:37:42'),
(78, 'SMPN 1 CANDI', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:48', '2020-03-10 08:37:48'),
(79, 'SMPN 2 CANDI', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:37:55', '2020-03-10 08:37:55'),
(80, 'SMPN 3 CANDI', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:06', '2020-03-10 08:38:06'),
(81, 'SMPN 1 GEDANGAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:14', '2020-03-10 08:38:14'),
(82, 'SMPN 2 GEDANGAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:20', '2020-03-10 08:38:20'),
(83, 'SMPN 1 JABON', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:26', '2020-03-10 08:38:26'),
(84, 'SMPN 2 JABON', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:32', '2020-03-10 08:38:32'),
(85, 'SMPN 1 KREMBUNG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:38', '2020-03-10 08:38:38'),
(86, 'SMPN 2 KREMBUNG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:52', '2020-03-10 08:38:52'),
(87, 'SMPN 1 KRIAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:38:59', '2020-03-10 08:38:59'),
(88, 'SMPN 2 KRIAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:04', '2020-03-10 08:39:04'),
(89, 'SMPN 3 KRIAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:10', '2020-03-10 08:39:10'),
(90, 'SMPN 1 PRAMBON', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:21', '2020-03-10 08:39:21'),
(91, 'SMPN 1 PORONG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:31', '2020-03-10 08:39:31'),
(92, 'SMPN 2 PORONG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:38', '2020-03-10 08:39:38'),
(93, 'SMPN 3 PORONG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:43', '2020-03-10 08:39:43'),
(94, 'SMPN 1 SEDATI', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:49', '2020-03-10 08:39:49'),
(95, 'SMPN 2 SEDATI', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:39:55', '2020-03-10 08:39:55'),
(96, 'SMPN 1 SUKODONO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:01', '2020-03-10 08:40:01'),
(97, 'SMPN 2 SUKODONO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:07', '2020-03-10 08:40:07'),
(98, 'SMPN 1 TARIK', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:15', '2020-03-10 08:40:15'),
(99, 'SMPN 2 TARIK', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:21', '2020-03-10 08:40:21'),
(100, 'SMPN 1 TAMAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:27', '2020-03-10 08:40:27'),
(101, 'SMPN 2 TAMAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:31', '2020-03-10 08:40:31'),
(102, 'SMPN 3 TAMAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:35', '2020-03-10 08:40:35'),
(103, 'SMPN 1 TULANGAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:40', '2020-03-10 08:40:40'),
(104, 'SMPN 1 TANGGULANGIN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:44', '2020-03-10 08:40:44'),
(105, 'SMPN 2 TANGGULANGIN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:49', '2020-03-10 08:40:49'),
(106, 'SMPN 1 WARU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:40:54', '2020-03-10 08:40:54'),
(107, 'SMPN 2 WARU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:41:36', '2020-03-10 08:41:36'),
(108, 'SMPN 3 WARU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:41:42', '2020-03-10 08:41:42'),
(109, 'SMPN 4 WARU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:41:46', '2020-03-10 08:41:46'),
(110, 'SMPN 1 WONOAYU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:41:53', '2020-03-10 08:41:53'),
(111, 'SMPN 2 WONOAYU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:41:59', '2020-03-10 08:41:59'),
(112, 'SMAN 1 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:11', '2020-03-10 08:42:11'),
(113, 'SMAN 2 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:16', '2020-03-10 08:42:16'),
(114, 'SMAN 3 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:24', '2020-03-10 08:42:24'),
(115, 'SMAN 4 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:29', '2020-03-10 08:42:29'),
(116, 'SMAN GEDANGAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:34', '2020-03-10 08:42:34'),
(117, 'SMAN KREMBUNG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:40', '2020-03-10 08:42:40'),
(118, 'SMAN PORONG', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:45', '2020-03-10 08:42:45'),
(119, 'SMAN TARIK', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:42:52', '2020-03-10 08:42:52'),
(120, 'SMAN TAMAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:00', '2020-03-10 08:43:00'),
(121, 'SMAN WONOAYU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:07', '2020-03-10 08:43:07'),
(122, 'SMAN WARU', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:14', '2020-03-10 08:43:14'),
(123, 'SMAN KRIAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:21', '2020-03-10 08:43:21'),
(124, 'SMKN 1 SIDOARJO', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:31', '2020-03-10 08:43:31'),
(125, 'SMKN 1 BUDURAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:35', '2020-03-10 08:43:35'),
(126, 'SMKN 2 BUDURAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:41', '2020-03-10 08:43:41'),
(127, 'SMKN 3 BUDURAN', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:46', '2020-03-10 08:43:46'),
(128, 'SMKN 1 JABON', 'Sekolah', 'Kepala', NULL, NULL, '2020-03-10 08:43:53', '2020-03-10 08:43:53'),
(133, 'test', 'Kecamatan', 'test', 'Kecamatan Gedangan', NULL, '2020-03-12 02:38:16', '2020-03-12 02:38:16'),
(134, 'tes', 'Kecamatan', 'tes', 'Kecamatan Krian', NULL, '2020-03-12 03:11:29', '2020-03-17 06:21:12');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(15, '2019_05_28_061257_detail_spt', 3),
(16, '2020_01_27_032203_create_events_table', 4);

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

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `address`, `city`, `country`, `zipcode`, `cover`, `pic`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jalan jalan saja yuk', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 21:28:14', '2019-05-20 21:28:14');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `user_id`, `nama_sertifikat`, `file_sertifikat`, `status_akses`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(77, 81, 'Lighthouse.jpg', 'sertifikat_auditor/JyYaRiIu5Xd9jW7kDzM5FIhQLLE6zzqSpGIvdnuu.jpeg', 1, 0, '2020-03-12 12:14:23', '2020-03-12 12:14:23'),
(72, 46, 'Chrysanthemum.jpg', 'sertifikat_auditor/xbOOu8flkPdpbTGGRSKu8VesvslybqwLfi84Akrm.jpeg', 1, 0, '2020-03-05 13:29:25', '2020-03-05 13:32:00'),
(73, 46, 'Lighthouse.jpg', 'sertifikat_auditor/LZVNYMo0jNRwxJRuNce66nTFxs5dOVXD4aeAvl7R.jpeg', 1, 0, '2020-03-05 13:29:25', '2020-03-05 13:29:25'),
(91, 81, 'images (1).jpg', 'sertifikat_auditor/2luLzeBLnr8z8096qsAz0m5DYytTNQCEoSTLtovY.jpeg', NULL, 6, '2020-07-12 11:42:55', '2020-07-12 11:43:05'),
(87, 6, 'sertifikatku.pdf', 'sertifikat_auditor/4cO5GMzC5skuBENWr4DNTAB7LRtsb54tGS8oSzGW.pdf', 0, 6, '2020-03-17 16:34:52', '2020-03-17 16:34:52'),
(86, 6, 'download.jpg', 'sertifikat_auditor/lIpRtkUREZiNy3eVkE6Gnu2pJrQlfXPdANaN22ms.jpeg', NULL, 6, '2020-03-17 14:23:40', '2020-03-17 14:23:40'),
(89, 28, 'sertifikatku.pdf', 'sertifikat_auditor/SsWgSt9vjgPqOITaLU3AzB0qb9MxSbMq3jBohnVh.pdf', NULL, 28, '2020-04-26 13:17:39', '2020-04-26 13:17:39'),
(92, 6, 'download.jpg', 'sertifikat_auditor/4omrqog6Yu5T7gm9T0TN0ftkDzCDuOSriSW9BIxw.jpeg', NULL, 6, '2020-07-12 11:44:05', '2020-07-12 11:44:05');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pendidikan`, `sex`, `tempat_lahir`, `tanggal_lahir`, `gelar`, `jenis_auditor`, `email`, `phone`, `nip`, `jabatan`, `pangkat`, `ruang`, `sertifikat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(35, 'DWI', 'FADJARWATI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'fadjarwati.dwi@gmail.com', '08xxxxxxx', '196601141991032007', 'Auditor Madya', 'IV/A', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$53xZN8gKUCI0l.mYt9BkSuWVrtF/yZOpSI8nmDjcuVHJU5SNr4IJW', NULL, '2019-09-11 01:39:02', '2019-09-18 23:44:34'),
(86, 'User', 'Inspektur', '{\"tahun\": \"1998\", \"jurusan\": \"Sistem Informasi\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', 'Surabaya', '1973-05-11 17:00:00', 'S.Si', NULL, 'Inspektur@local.host', '+625858587', '787878545454', 'Inspektur Kabupaten', 'I/A', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$EghgityiktegIrQSxyEgKut0YObjUQ0atXA08mUJ37q6G520BhTEm', NULL, '2019-11-10 23:59:59', '2019-11-10 23:59:59'),
(27, 'ANDJAR', 'SURJADIANTO', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": null}', 'Laki-laki', '-', '2019-09-29 17:00:00', ', S.Sos.', NULL, 'bagusragilpahing@yahoo.co.id', '08xxxxxxx', '197009261990031005', 'Inspektur Kabupaten', 'IV/B', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$nZvR8A8sg6I8xhQGcPN4IOv3wYiXHN/4EyE14OFIDSK0fcrEJJ58i', NULL, '2019-09-11 00:58:04', '2020-07-27 20:17:47'),
(28, 'Dra. LAELY', 'WIDJAJATI', '{\"tahun\": \"20xx\", \"jurusan\": \"Sosial\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Perempuan', NULL, '2019-09-29 17:00:00', ', M.Si.', 'ahli', 'laelywidjajati@gmai.com', '08xxxxxxx', '196202021989032008', 'Auditor Madya', 'III/C', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$mOkShtf.pC.WhoOGo0hTU.b0sDaNrVhh0JFs/nWiqeqYEIbEtmucS', NULL, '2019-09-11 01:02:15', '2020-07-27 19:44:23'),
(29, 'Drs. PUJOSENO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"kosong\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SIP.', NULL, 'pujoseno_66@yahoo.com', '08xxxxxxx', '196610271986021002', 'Inspektur Pembantu Wilayah I', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$n1rn1XaZK8q93jctWAOYCuSnwtyJ1xan2XvIvoI8XZ9I4YiOtlzYi', NULL, '2019-09-11 01:19:09', '2019-09-18 23:38:54'),
(30, 'Drs. MADE', 'SUYARTA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'madesuyarta@gmail.com', '08xxxxxxx', '196703261994011003', 'Inspektur Pembantu Wilayah II', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tCc9wwA7QN094FakijktdelH.whvilTSQVOxGChNDTkA44LMe5T.2', NULL, '2019-09-11 01:21:15', '2019-09-11 01:21:15'),
(31, 'Drs. MUKHAMAD', 'KHUSAINI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', MM.', NULL, 'khus.dipendik@gmail.com', '08xxxxxxx', '196512131986061001', 'Inspektur Pembantu Wilayah III', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$QGGOtGtGxYCQFynT0vJDaeCPJLa1dduICEqB6dTmh8es32X.TbvQi', NULL, '2019-09-11 01:22:38', '2019-09-18 23:33:35'),
(32, 'Drs. MOCH.', 'SOLICHIN', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Pasca Sarjana (S2)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', NULL, NULL, 'solichin.mochama@gmail.com', '08xxxxxxx', '196811021990031003', 'Inspektur Pembantu Wilayah IV', 'IV/B', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$r.mtMM52f1UoNlZpl2fyXOiMDczIIbmzVXzQjrh9I.zDaF.iJ.yr.', NULL, '2019-09-11 01:25:03', '2019-09-11 01:25:03'),
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
(58, 'YOGI', 'MAHARDHIKA', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-29 17:00:00', ', ST.', 'terampil', 'yogi.mahardhika@gmail.com', '082143339774', '198507052010011017', 'Auditor Muda', 'III/C', '{\"nama\": null, \"jabatan\": null}', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$TQIbyfz4iban.CcVuZv/E.XXHRj6XtbK0v6uVFpq24i.y8jIsTL1O', 'mOIzW231cC4VlpE1NnxV64YklPox4nzT5GzsXzsA6NwIlgfhwkyhElqY02jo', '2019-09-11 09:30:54', '2020-06-14 22:59:36'),
(59, 'VIRANI RAKHMA', 'SARI', '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'emailnyarani.via@gmail.com', '081235465558', '198508302010012025', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$OQsjWkA2X8JgU9wz.PDBs.jvWwDT9.hoa7yqez7y.Vm3WOZXYlKde', NULL, '2019-09-11 09:34:53', '2019-09-18 23:48:39'),
(60, 'MARIANINGSIH', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Perempuan', NULL, '2019-09-30 07:13:38', ', SE.', 'terampil', 'mariaimam76@gmail.com', '081330631871', '197607071996022002', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$tw7fqph2uh.xW44R/RWrrOCiU82QUgoCwk7o73baK8NihJsOxQFpi', NULL, '2019-09-11 09:35:44', '2019-09-18 23:48:55'),
(61, 'HARIYANTO', NULL, '{\"tahun\": \"20xx\", \"jurusan\": \"-\", \"tingkat\": \"Sarjana (S1)\"}', 'Laki-laki', NULL, '2019-09-30 07:13:38', ', SH.', 'terampil', 'hary.zildan1020@gmail.com', '081311108484', '198406202011011012', 'Auditor Muda', 'III/C', NULL, '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$Fv3MCZ5WNv1ycwaY4NV0aOCCr50FZeOFioBsiGmLdRB0crVOzy3fi', NULL, '2019-09-11 09:36:55', '2019-09-18 23:49:11'),
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
(6, 'Super', 'Admin', NULL, NULL, NULL, '2019-06-18 05:32:57', NULL, NULL, 'admin@local.host', 'admin@local.host', '999999999', 'Inspektur Kabupaten', 'I/A', NULL, NULL, NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', 'eyHA5V0Go6NOhZEEWBgkQQabhCvy0PbmhVuNui3hDLhaF341FVhVl8KxYJCP', '2019-06-18 05:32:57', '2019-06-18 05:32:57'),
(87, 'Administrasi', 'Perencanaan', '{\"tahun\": \"20xx\", \"jurusan\": null, \"tingkat\": \"Sekolah Menengah Atas (SMA)\"}', 'Laki-laki', 'Sidoarjo', '1995-07-17 17:00:00', ', ST.', NULL, 'perencanaan@gmail.com', '08214333978888', '19850705201088888999', 'Kasubag Perencanaan', 'II/A', '{\"nama\": null, \"jabatan\": null}', NULL, NULL, '$2y$10$.Yd35LaLJ4WGEoop1iAhOeBa4.uwSCPEPQQI6PL6YDnliAlUyuCA.', NULL, '2020-07-06 23:57:48', '2020-07-06 23:57:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
