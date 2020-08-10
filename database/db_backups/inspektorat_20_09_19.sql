-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2019 at 03:13 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

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
  `file_laporan` json DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` json DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif ketika disetujui, stored jika update nomor spt dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_spt`
--

INSERT INTO `detail_spt` (`id`, `spt_id`, `user_id`, `peran`, `lama`, `dupak`, `file_laporan`, `file`, `filename`, `kode`, `jenis_laporan`, `status`, `status_dupak`, `unsur_dupak`) VALUES
(15, 5, 4, 'Penanggung jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 6, 5, 'Pembantu Penanggung jawab', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(21, 6, 6, 'Penanggung Jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(20, 2, 3, 'Penanggung Jawab', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(23, 6, 2, 'Ketua Tim', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(24, 6, 4, 'Penanggung jawab', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(25, 7, 7, 'Penanggung Jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(26, 7, 3, 'Supervisor', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(41, 9, 8, 'Pengendali Mutu', 2, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(40, 9, 9, 'Pengendali Teknis', 2, 0.42, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(38, 8, 8, 'Pengendali Mutu', 5, 1.30, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(39, 9, 10, 'Ketua Tim', 2, 0.26, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(36, 8, 9, 'Ketua Tim', 7, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(44, 10, 8, 'Pengendali Mutu', 1, 0.26, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(45, 11, 9, 'Supervisor', 7, 202.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(46, 11, 8, 'Pembantu Penanggung jawab', 7, 101.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(47, 11, 4, 'Penanggung Jawab', 7, 404.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(48, 11, 2, 'Ketua Tim', 7, 404.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(54, 12, 10, 'Anggota Tim', 13, 0.84, NULL, NULL, NULL, NULL, NULL, NULL, 'stored', 'pengawasan'),
(53, 12, 9, 'Anggota Tim', 13, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'stored', 'pengawasan'),
(52, 12, 8, 'Ketua Tim', 13, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'stored', 'pengawasan'),
(55, 13, 67, 'Penanggung Jawab', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(56, 13, 4, 'Penanggung jawab', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(57, 14, 41, 'Penanggung Jawab', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(58, 14, 64, 'Anggota Tim', 14, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(65, 15, 71, 'Penanggung Jawab', 2, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(66, 15, 70, 'Anggota Tim', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(67, 15, 72, 'Anggota Tim', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(73, 16, 4, 'Penanggung Jawab', 4, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(72, 16, 19, 'Supervisor', 2, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(19, 2, 4, 'Penanggung jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(74, 2, 3, 'Penanggung Jawab', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(75, 2, 72, 'Pengendali Mutu', 2, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(76, 2, 70, 'Anggota Tim', 1, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawasan'),
(77, 2, 71, 'Anggota Tim', 2, 0.00, '{\"kode\": \"1111\", \"komen\": null, \"sebab\": null, \"akibat\": null, \"kondisi\": null, \"kriteria\": null, \"judultemuan\": null, \"kriteriakkp\": \"sadasdsa\"}', NULL, NULL, NULL, NULL, '{\"note\": null, \"status\": \"disetujui\", \"disetujui\": 4}', NULL, 'pengawasan'),
(79, 17, 33, 'Penanggung Jawab', 3, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(80, 17, 49, 'Anggota Tim', 3, 0.20, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(81, 17, 69, 'Anggota Tim', 2, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan');

-- --------------------------------------------------------

--
-- Table structure for table `dupak`
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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dupak`
--

INSERT INTO `dupak` (`id`, `user_id`, `dupak`, `unsur_dupak`, `status`, `created_at`, `updated_at`) VALUES
(2, 19, 200.00, 'pendidikan', NULL, '2019-09-02 23:48:42', '2019-09-02 23:51:13'),
(3, 19, 120.00, 'pendidikan', NULL, NULL, NULL),
(4, 18, 150.00, 'pengawasan', NULL, NULL, NULL),
(9, 9, 0.00, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06'),
(8, 10, 0.84, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06'),
(10, 8, 0.00, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06'),
(14, 28, 150.00, 'pendidikan', NULL, '2019-09-11 01:02:15', '2019-09-11 01:02:15'),
(15, 33, 150.00, 'pendidikan', NULL, '2019-09-11 01:28:20', '2019-09-11 01:28:20'),
(16, 34, 0.00, 'pendidikan', NULL, '2019-09-11 01:31:17', '2019-09-11 01:31:17'),
(17, 35, 0.00, 'pendidikan', NULL, '2019-09-11 01:39:02', '2019-09-11 01:39:02'),
(18, 36, 0.00, 'pendidikan', NULL, '2019-09-11 01:39:53', '2019-09-11 01:39:53'),
(19, 37, 0.00, 'pendidikan', NULL, '2019-09-11 01:41:03', '2019-09-11 01:41:03'),
(20, 38, 0.00, 'pendidikan', NULL, '2019-09-11 01:44:21', '2019-09-11 01:44:21'),
(21, 39, 150.00, 'pendidikan', NULL, '2019-09-11 01:49:42', '2019-09-11 01:49:42'),
(22, 40, 150.00, 'pendidikan', NULL, '2019-09-11 01:50:42', '2019-09-11 01:50:42'),
(23, 41, 0.00, 'pendidikan', NULL, '2019-09-11 01:53:30', '2019-09-11 01:53:30'),
(24, 42, 150.00, 'pendidikan', NULL, '2019-09-11 01:54:25', '2019-09-11 01:54:25'),
(25, 43, 150.00, 'pendidikan', NULL, '2019-09-11 02:02:11', '2019-09-11 02:02:11'),
(26, 48, 0.00, 'pendidikan', NULL, '2019-09-11 09:05:38', '2019-09-11 09:05:38'),
(27, 49, 0.00, 'pendidikan', NULL, '2019-09-11 09:09:05', '2019-09-11 09:09:05'),
(28, 50, 0.00, 'pendidikan', NULL, '2019-09-11 09:10:34', '2019-09-11 09:10:34'),
(29, 54, 0.00, 'pendidikan', NULL, '2019-09-11 09:20:53', '2019-09-11 09:20:53'),
(30, 55, 150.00, 'pendidikan', NULL, '2019-09-11 09:27:57', '2019-09-11 09:27:57'),
(31, 56, 0.00, 'pendidikan', NULL, '2019-09-11 09:29:03', '2019-09-11 09:29:03'),
(32, 57, 0.00, 'pendidikan', NULL, '2019-09-11 09:30:07', '2019-09-11 09:30:07'),
(33, 58, 0.00, 'pendidikan', NULL, '2019-09-11 09:30:54', '2019-09-11 09:30:54'),
(34, 59, 0.00, 'pendidikan', NULL, '2019-09-11 09:34:54', '2019-09-11 09:34:54'),
(35, 60, 0.00, 'pendidikan', NULL, '2019-09-11 09:35:44', '2019-09-11 09:35:44'),
(36, 61, 0.00, 'pendidikan', NULL, '2019-09-11 09:36:55', '2019-09-11 09:36:55'),
(37, 63, 0.00, 'pendidikan', NULL, '2019-09-11 09:40:11', '2019-09-11 09:40:11'),
(38, 64, 0.00, 'pendidikan', NULL, '2019-09-11 09:41:40', '2019-09-11 09:41:40'),
(39, 69, 0.00, 'pendidikan', NULL, '2019-09-11 10:02:34', '2019-09-11 10:02:34'),
(40, 70, 0.00, 'pendidikan', NULL, '2019-11-04 00:29:30', '2019-11-04 00:29:30'),
(41, 71, 200.00, 'pendidikan', NULL, '2019-11-04 00:30:20', '2019-11-04 00:30:20'),
(42, 72, 200.00, 'pendidikan', NULL, '2019-11-04 00:31:07', '2019-11-04 00:31:07'),
(43, 71, 0.00, 'pengawasan', NULL, '2019-11-04 21:15:00', '2019-11-04 21:15:00'),
(44, 70, 0.00, 'pengawasan', NULL, '2019-11-04 21:15:00', '2019-11-04 21:15:00'),
(45, 72, 0.00, 'pengawasan', NULL, '2019-11-04 21:15:00', '2019-11-04 21:15:00');

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
  `view_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'standar',
  `kategori` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengawasan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_spt`
--

INSERT INTO `jenis_spt` (`id`, `name`, `dasar`, `isi`, `view_mode`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Audit Kinerja Desa', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;tentang Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Menteri Pendayagunaan Aparatur Negara Nomor PER/05/M.PAN/03/2008 tanggal 31 Maret 2008 tentang Standar Audit Aparat Pengawasan Intern Pemerintah;</li><li>Peraturan Pemerintah Nomor 60 Tahun 2008 tentang Sistem Pengendalian Intern Pemerintah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p>Untuk Melaksanakan Audit Kinerja di %lokasi% atas Kegiatan&nbsp; Pelaksanaan Pengawasan Internal secara berkala Tahun %tahun%.</p><p>Jangka waktu pemeriksaan&nbsp; efektif selama&nbsp; &nbsp;%terbilang%&nbsp; hari&nbsp; kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', 'standar', 'pengawasan', '2019-05-26 23:10:08', '2019-05-26 23:23:01'),
(2, 'Evaluasi SKPD', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 2014 tentang Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk melaksanakan %nama% %lokasi%.</span><br></p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode %tgl_mulai%&nbsp; &nbsp; s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', 'standar', 'pengawasan', '2019-05-28 18:53:36', '2019-06-11 23:05:50'),
(3, 'Evaluasi AKIP', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<p>Untuk melakukan pemeriksaan guna menyelesaikan %nama%, di %lokasi%.</p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai%&nbsp; &nbsp;s.d&nbsp; &nbsp; %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', 'standar', 'pengawasan', '2019-05-28 20:19:50', '2019-06-11 21:02:48'),
(4, 'PKKN', '<p><span style=\"font-size:12.0pt;font-family:&quot;Maiandra GD&quot;,&quot;sans-serif&quot;;\r\nmso-fareast-font-family:&quot;Arial Unicode MS&quot;;mso-bidi-font-family:Tahoma;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Surat\r\ndari Kejaksaan Negeri Kabupaten Sidoarjo &nbsp;tanggal 9 Agustus 2018 Nomor : B-329/O.5.30/Fd.1/08/2018\r\nperihal Bantuan Penghitungan Kerugian &nbsp;Keuangan Negara</span><br></p>', '<p>Untuk melaksanakan Audit Lanjutan terhadap Penghitungan Kerugian Keuangan Negara terhadap %nama% %lokasi% yang berasal dari APBD Pemerintah Propinsi Jawa Timur Tahun Anggaran 2016.</p><p>Jangka waktu pemeriksaan tersebut efektif&nbsp; selama&nbsp; %lama% kerja pada periode tanggal&nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', 'standar', 'pengawasan', '2019-06-11 21:25:10', '2019-06-11 21:25:10'),
(5, 'Konsulting', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 2014 tentang Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk melaksanakan Program Konsulting %nama% di %lokasi%.</span><br></p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', 'standar', 'pengawasan', '2019-06-11 23:53:16', '2019-06-11 23:53:16'),
(6, 'LKPD', '<ol><li>Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah;</li><li>Peraturan Negeri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Pemerintah Nomor 8 Tahun 2006 tentang Laporan Keuangan dan Kinerja Instansi Pemerintah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p>Untuk melaksanakan %nama% Laporan Keuangan Pemerintah Daerah (LKPD) Tahun 2017 pada tanggal&nbsp; &nbsp; %tgl_mulai%&nbsp; &nbsp; s.d&nbsp; &nbsp; %tgl_akhir%, didahului&nbsp; dengan Pra Reviu.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', 'standar', 'pengawasan', '2019-06-11 23:56:51', '2019-06-28 14:53:09'),
(7, 'Monev', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<p>Untuk melakukan pemeriksaan guna menyelesaikan %nama%,&nbsp; %lokasi%.</p><p>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', 'standar', 'pengawasan', '2019-06-12 00:04:43', '2019-06-12 00:04:43'),
(8, 'Reguler', '<p>Surat Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017 Nomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.<br></p>', '<div>Melaksanakan %nama%. Di %lokasi%.</div><div>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal %tgl_mulai% s.d %tgl_akhir%.</div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div>', 'standar', 'pengawasan', '2019-06-12 00:28:12', '2019-06-12 00:32:19'),
(9, 'Renja', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Pemerintah Nomor 58 Tahun 2005 tentang Pengelolaan Keuangan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah sebagaimana telah diubah beberapa kali terakhir dengan Peraturan Pemerintah Dalam Negeri Nomor 21 Tahun 2011 tentang Perubahan kedua Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<p style=\"text-align: justify; \">Untuk Melaksanakan Reviu Renja %nama%, sebagaimana daftar terlampir.</p><p style=\"text-align: justify; \">Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%</p><p style=\"text-align: justify; \">Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div style=\"text-align: justify; \"><br></div>', 'split', 'pengawasan', '2019-06-12 19:39:26', '2019-06-12 19:39:26'),
(10, 'Renstra', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 79 Tahun 2005&nbsp; &nbsp; &nbsp;Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Pemerintah Nomor 58 Tahun 2005 tentang Pengelolaan Keuangan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah sebagaimana telah diubah beberapa kali terakhir dengan Peraturan Pemerintah Dalam Negeri Nomor 21 Tahun 2011 tentang Perubahan kedua Peraturan Menteri Dalam Negeri Nomor 13 Tahun Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 76 Tahun 2016 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2017;</li><li>Surat Menteri Dalam Negeri Nomor : 50/781/B.1/1J/tanggal 24 Agustus 2016 tentang Pedoman Pelaksanaan Reviu Dokumen RPJMD dan Renstra SKPD;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2017;</li></ol>', '<p>Untuk Melaksanakan %nama% %lokasi%.</p><p>Jangka waktu pemeriksaan efektif selama&nbsp; %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%.</p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p>', 'split', 'pengawasan', '2019-06-28 14:07:07', '2019-06-28 14:38:30'),
(11, 'Reviu LKPD', '<span style=\"font-size:12.0pt;font-family:&quot;Maiandra GD&quot;,&quot;sans-serif&quot;;\r\nmso-fareast-font-family:&quot;Arial Unicode MS&quot;;mso-bidi-font-family:Tahoma;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Surat\r\nKepala Badan Kepegawaian Daerah Kabupaten Sidoarjo tanggal 8 Desember 2017\r\nNomor : x.800/2738/404.6.4/2017, perihal Permohonan Audit Kepegawaian.</span>', '<div>Untuk melaksanakan Audit %nama% di %lokasi%.</div><div><br></div><div>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode tanggal&nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%.</div><div><br></div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div><div><br></div>', 'standar', 'pengawasan', '2019-08-11 20:42:52', '2019-08-11 20:42:52'),
(12, 'Reviu LPPD', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;tentang Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Menteri Pendayagunaan Aparatur Negara Nomor 53 Tahun 2014 tentang Petunjuk Teknis Perjanjian Kinerja, Pelaporan Kinerja dan Tata Cara Reviu Atas Laporan Kinerja Instansi Pemerintah;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li><li>Undangan Sekretaris Daerah Kabupaten Sidoarjo tanggal 19 Maret 2018 Nomor : 130/1872/438.1.2.2/2018 perihal Review atas Laporan Kinerja Kabupaten Sidoarjo Tahun 2017;</li></ol>', '<p><span style=\"font-size: 1rem;\">Untuk Melaksanakan %nama%&nbsp; pada tanggal %tgl_mulai% s.d %tgl_akhir%</span><br></p><p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</p><div><br></div>', 'standar', 'pengawasan', '2019-09-10 17:56:45', '2019-09-10 17:56:45'),
(13, 'Reviu PPKD', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Menteri Dalam Negeri Nomor 38 Tahun 2018 tentang Pedoman Penyusunan APBD Tahun Anggaran 2019;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<div>Untuk Melaksanakan %nama%</div><div>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; %tgl_mulai% hingga %tgl_akhir%</div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div><div><br></div>', 'standar', 'pengawasan', '2019-09-10 17:58:59', '2019-09-10 17:58:59'),
(14, 'Reviu RKA', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 79 Tahun 2005&nbsp; &nbsp; &nbsp;Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor&nbsp; 110 Tahun 2017 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Peraturan Menteri Dalam Negeri Nomor 33 Tahun 2017 tentang Pedoman Penyusunan APBD Tahun Anggaran 2018;</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<div>Untuk Melaksanakan&nbsp; Reviu lanjutan atas Rencana %nama% pada %lokasi%</div><div>&nbsp;</div><div>Jangka waktu pemeriksaan&nbsp; efektif selama&nbsp; %lama% kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; %tgl_mulai% s.d %tgl_akhir%</div><div><br></div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div><div><br></div>', 'standar', 'pengawasan', '2019-09-10 18:01:30', '2019-09-10 18:01:30'),
(15, 'Reviu RKPD', '<ol><li>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 86 Tahun 2017 tentang Tata Cara Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah, Tata Cara Evaluasi Rancangan Peraturan Daerah tentang Rencana Pembangunan Jangka Panjang Daerah dan Rencana Pembangunan Jangka Menengah Daerah, serta Tata Cara Perubahan Rencana Pembangunan Jangka Panjang Daerah, Rencana Pembangunan Jangka Menengah Daerah, dan Rencana Kerja Pemerintah Daerah;</li><li>Kementrian Dalam Negeri Republik Indonesia Nomor : 700/025/A.4/IJ perihal Pedoman Pelaksanaan Reviu Dokumen Rencana Pembangunan dan Anggaran Tahunan Daerah;</li><li>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 110 Tahun 2017 tentang Kebijakan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2018;</li></ol><div><br></div>', '<div><br></div><div>Untuk melaksanakan %nama%</div><div>Jangka waktu pelaksanaan tersebut efektif selama&nbsp; %lama% kerja pada periode tanggal&nbsp; &nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%</div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div><div><br></div>', 'standar', 'pengawasan', '2019-09-10 18:05:37', '2019-09-10 18:05:37'),
(16, 'Riktu', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 79 Tahun 2005&nbsp; &nbsp; &nbsp;Tentang Pedoman Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 76 Tahun 2016 tentang Kebijakan Pembinaan dan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2017;</li></ol>', '<div>Untuk Melaksanakan Pemeriksaan dengan tujuan tertentu atas&nbsp; &nbsp;%nama%</div><div>Jangka waktu pemeriksaan tersebut efektif selama %lama% kerja pada periode&nbsp; &nbsp;tanggal&nbsp; &nbsp; &nbsp;%tgl_mulai% s.d %tgl_akhir%</div><div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas dimaksud.</div>', 'split', 'pengawasan', '2019-09-10 18:58:57', '2019-09-10 18:58:57'),
(17, 'SOP', '<ol><li>Undang - Undang Republik Indonesia Nomor 23 Tahun&nbsp; 2014&nbsp; Tentang&nbsp; Pemerintah Daerah;</li><li>Peraturan Pemerintah Republik Indonesia Nomor 12 Tahun 2017&nbsp; &nbsp; &nbsp;Tentang&nbsp; Pembinaan dan Pengawasan Penyelenggaraan&nbsp; &nbsp; Pemerintahan Daerah;</li><li>Peraturan Menteri Dalam Negeri Nomor 110 Tahun 2017&nbsp; tentang Kebijakan Pengawasan Penyelenggaraan Pemerintah Daerah Tahun 2018;</li><li>Standar Audit Aparat Pengawasan Intern Pemerintah ( Asosiasi Auditor Intern Pemerintah Indonesia/ AAIPI);</li><li>Program Kerja Pengawasan Tahunan (PKPT) Inspektorat Daerah Kabupaten Sidoarjo Tahun 2018;</li></ol>', '<div><span style=\"font-size: 1rem;\">Untuk Melaksanakan %nama%</span><br></div><div><span style=\"font-size: 1rem;\">Jangka waktu telaah efektif selama&nbsp; %lama% kerja pada periode&nbsp; &nbsp;tanggal %tgl_mulai% s.d %tgl_akhir%</span><br></div><div><br></div>', 'standar', 'pengawasan', '2019-09-10 19:01:26', '2019-09-10 19:01:26');

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
) ENGINE=MyISAM AUTO_INCREMENT=564 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laravel_logger_activity`
--

INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(562, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 49, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:04:40', '2019-12-19 20:04:40', NULL),
(563, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 69, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:07:54', '2019-12-19 20:07:54', NULL),
(561, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:04:29', '2019-12-19 20:04:29', NULL),
(560, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:03:03', '2019-12-19 20:03:03', NULL),
(558, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:01:34', '2019-12-19 20:01:34', NULL),
(559, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 33, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 20:01:39', '2019-12-19 20:01:39', NULL),
(557, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/users', 'POST', '2019-12-19 20:01:25', '2019-12-19 20:01:25', NULL),
(556, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 19:30:37', '2019-12-19 19:30:37', NULL),
(555, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-19 19:30:28', '2019-12-19 19:30:28', NULL),
(554, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 18:55:59', '2019-12-19 18:55:59', NULL),
(553, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-19 00:45:40', '2019-12-19 00:45:40', NULL),
(552, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-19 00:13:03', '2019-12-19 00:13:03', NULL),
(551, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-18 23:35:43', '2019-12-18 23:35:43', NULL),
(550, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-18 20:09:24', '2019-12-18 20:09:24', NULL),
(549, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-18 20:08:43', '2019-12-18 20:08:43', NULL),
(548, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-18 20:08:11', '2019-12-18 20:08:11', NULL),
(547, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-18 20:05:07', '2019-12-18 20:05:07', NULL),
(546, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-18 19:10:36', '2019-12-18 19:10:36', NULL),
(545, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-17 23:17:59', '2019-12-17 23:17:59', NULL),
(544, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-17 23:17:44', '2019-12-17 23:17:44', NULL),
(543, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-17 20:06:10', '2019-12-17 20:06:10', NULL),
(542, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-17 20:05:34', '2019-12-17 20:05:34', NULL),
(541, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-17 19:03:11', '2019-12-17 19:03:11', NULL),
(540, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-17 19:01:27', '2019-12-17 19:01:27', NULL),
(539, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 23:15:03', '2019-12-16 23:15:03', NULL),
(538, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 20:45:15', '2019-12-16 20:45:15', NULL),
(537, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 70, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-16 20:45:07', '2019-12-16 20:45:07', NULL),
(536, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 70, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 20:44:35', '2019-12-16 20:44:35', NULL),
(535, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 20:44:31', '2019-12-16 20:44:31', NULL),
(534, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 19:09:19', '2019-12-16 19:09:19', NULL),
(533, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 05:12:42', '2019-12-16 05:12:42', NULL),
(532, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 01:31:45', '2019-12-16 01:31:45', NULL),
(531, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 70, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-16 00:05:52', '2019-12-16 00:05:52', NULL),
(530, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 72, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-16 00:04:13', '2019-12-16 00:04:13', NULL),
(529, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-15 23:28:34', '2019-12-15 23:28:34', NULL),
(528, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 72, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 23:23:10', '2019-12-15 23:23:10', NULL),
(527, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 23:23:05', '2019-12-15 23:23:05', NULL),
(526, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 23:22:45', '2019-12-15 23:22:45', NULL),
(525, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-15 20:33:22', '2019-12-15 20:33:22', NULL),
(524, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 72, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 20:30:29', '2019-12-15 20:30:29', NULL),
(523, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-15 20:30:13', '2019-12-15 20:30:13', NULL),
(522, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 20:29:44', '2019-12-15 20:29:44', NULL),
(521, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-15 17:13:42', '2019-12-15 17:13:42', NULL),
(520, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-12 01:16:22', '2019-12-12 01:16:22', NULL),
(519, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-12 00:13:55', '2019-12-12 00:13:55', NULL),
(518, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-11 18:11:17', '2019-12-11 18:11:17', NULL),
(517, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 23:34:29', '2019-12-10 23:34:29', NULL),
(516, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:32:03', '2019-12-10 20:32:03', NULL),
(515, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:30:08', '2019-12-10 20:30:08', NULL),
(514, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-10 20:30:01', '2019-12-10 20:30:01', NULL),
(513, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:29:57', '2019-12-10 20:29:57', NULL),
(512, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 70, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-10 20:15:19', '2019-12-10 20:15:19', NULL),
(511, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 72, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/admin', 'POST', '2019-12-10 20:15:15', '2019-12-10 20:15:15', NULL),
(510, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:15:06', '2019-12-10 20:15:06', NULL),
(509, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-10 20:15:01', '2019-12-10 20:15:01', NULL),
(508, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 70, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:11:42', '2019-12-10 20:11:42', NULL),
(507, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-10 20:11:29', '2019-12-10 20:11:29', NULL),
(506, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 72, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:05:43', '2019-12-10 20:05:43', NULL),
(505, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/', 'POST', '2019-12-10 20:05:32', '2019-12-10 20:05:32', NULL),
(504, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:05:11', '2019-12-10 20:05:11', NULL),
(503, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-10 20:04:47', '2019-12-10 20:04:47', NULL),
(502, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 20:02:24', '2019-12-10 20:02:24', NULL),
(501, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/', 'POST', '2019-12-10 20:02:19', '2019-12-10 20:02:19', NULL),
(500, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-12-10 19:37:28', '2019-12-10 19:37:28', NULL),
(499, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 71, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 19:35:55', '2019-12-10 19:35:55', NULL),
(498, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-10 19:35:40', '2019-12-10 19:35:40', NULL),
(497, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 19:34:07', '2019-12-10 19:34:07', NULL),
(496, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 19:08:49', '2019-12-10 19:08:49', NULL),
(495, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 05:31:00', '2019-12-10 05:31:00', NULL),
(494, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-10 04:31:30', '2019-12-10 04:31:30', NULL),
(493, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-09 23:19:01', '2019-12-09 23:19:01', NULL),
(492, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-09 19:37:33', '2019-12-09 19:37:33', NULL),
(491, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-08 18:57:28', '2019-12-08 18:57:28', NULL),
(490, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-08 05:48:43', '2019-12-08 05:48:43', NULL),
(489, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-07 01:22:52', '2019-12-07 01:22:52', NULL),
(488, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-05 23:09:21', '2019-12-05 23:09:21', NULL),
(487, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-05 19:04:12', '2019-12-05 19:04:12', NULL),
(486, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 23:06:36', '2019-12-04 23:06:36', NULL),
(485, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 20:47:40', '2019-12-04 20:47:40', NULL),
(484, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-04 20:46:51', '2019-12-04 20:46:51', NULL),
(483, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 20:46:21', '2019-12-04 20:46:21', NULL),
(482, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin?spt_id=2&nomor=777', 'POST', '2019-12-04 20:46:14', '2019-12-04 20:46:14', NULL),
(481, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 19:44:11', '2019-12-04 19:44:11', NULL),
(480, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-04 19:44:06', '2019-12-04 19:44:06', NULL),
(479, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin?spt_id=2&nomor=232332', 'POST', '2019-12-04 19:44:01', '2019-12-04 19:44:01', NULL),
(478, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 19:29:28', '2019-12-04 19:29:28', NULL),
(477, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-04 19:29:22', '2019-12-04 19:29:22', NULL),
(476, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 19:29:14', '2019-12-04 19:29:14', NULL),
(475, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-04 19:29:08', '2019-12-04 19:29:08', NULL),
(474, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 19:27:10', '2019-12-04 19:27:10', NULL),
(473, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-04 19:25:13', '2019-12-04 19:25:13', NULL),
(472, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 19:21:30', '2019-12-04 19:21:30', NULL),
(471, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-04 18:36:26', '2019-12-04 18:36:26', NULL),
(470, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-03 18:42:27', '2019-12-03 18:42:27', NULL),
(469, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-02 23:20:49', '2019-12-02 23:20:49', NULL),
(468, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-02 20:03:56', '2019-12-02 20:03:56', NULL),
(467, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/spt/myspt/24', 'POST', '2019-12-02 20:03:49', '2019-12-02 20:03:49', NULL),
(466, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-02 18:19:52', '2019-12-02 18:19:52', NULL),
(465, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 23:27:57', '2019-12-01 23:27:57', NULL),
(464, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-01 23:27:45', '2019-12-01 23:27:45', NULL),
(463, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 23:25:25', '2019-12-01 23:25:25', NULL),
(462, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:59:43', '2019-12-01 19:59:43', NULL),
(461, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-01 19:59:37', '2019-12-01 19:59:37', NULL),
(460, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:55:53', '2019-12-01 19:55:53', NULL),
(459, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 65, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-01 19:55:42', '2019-12-01 19:55:42', NULL),
(458, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 65, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:51:00', '2019-12-01 19:51:00', NULL),
(457, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/users', 'POST', '2019-12-01 19:50:53', '2019-12-01 19:50:53', NULL),
(456, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:46:36', '2019-12-01 19:46:36', NULL),
(455, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-01 19:46:29', '2019-12-01 19:46:29', NULL),
(454, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:46:16', '2019-12-01 19:46:16', NULL),
(453, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-01 19:46:07', '2019-12-01 19:46:07', NULL),
(452, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:44:53', '2019-12-01 19:44:53', NULL),
(451, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-12-01 19:44:46', '2019-12-01 19:44:46', NULL),
(450, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:38:58', '2019-12-01 19:38:58', NULL),
(449, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-01 19:36:02', '2019-12-01 19:36:02', NULL),
(448, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:35:08', '2019-12-01 19:35:08', NULL),
(447, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-01 19:35:00', '2019-12-01 19:35:00', NULL),
(446, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:21:23', '2019-12-01 19:21:23', NULL),
(445, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-12-01 19:21:13', '2019-12-01 19:21:13', NULL),
(444, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-12-01 19:00:48', '2019-12-01 19:00:48', NULL),
(443, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-28 23:39:44', '2019-11-28 23:39:44', NULL),
(442, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-28 20:27:08', '2019-11-28 20:27:08', NULL),
(441, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-28 02:01:56', '2019-11-28 02:01:56', NULL),
(440, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-27 23:43:42', '2019-11-27 23:43:42', NULL),
(439, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-27 20:00:11', '2019-11-27 20:00:11', NULL),
(438, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/myprofile', 'POST', '2019-11-27 20:00:05', '2019-11-27 20:00:05', NULL),
(437, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-27 19:21:31', '2019-11-27 19:21:31', NULL),
(436, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-27 00:10:08', '2019-11-27 00:10:08', NULL),
(435, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-11-26 23:52:52', '2019-11-26 23:52:52', NULL),
(434, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-26 23:35:30', '2019-11-26 23:35:30', NULL),
(433, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-26 23:27:47', '2019-11-26 23:27:47', NULL),
(432, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/spt/myspt/19', 'POST', '2019-11-26 23:27:04', '2019-11-26 23:27:04', NULL),
(431, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 4, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-26 23:26:37', '2019-11-26 23:26:37', NULL),
(430, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin', 'POST', '2019-11-26 23:26:31', '2019-11-26 23:26:31', NULL),
(429, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-26 23:06:21', '2019-11-26 23:06:21', NULL),
(428, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-26 19:17:35', '2019-11-26 19:17:35', NULL),
(427, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-25 23:49:42', '2019-11-25 23:49:42', NULL),
(426, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/admin', 'POST', '2019-11-25 21:10:36', '2019-11-25 21:10:36', NULL),
(425, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-11-25 20:27:21', '2019-11-25 20:27:21', NULL);
INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(424, 'Failed Login Attempt', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.local/login', 'POST', '2019-11-25 20:27:11', '2019-11-25 20:27:11', NULL),
(423, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-25 20:25:49', '2019-11-25 20:25:49', NULL),
(422, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/admin/spt', 'POST', '2019-11-25 20:25:43', '2019-11-25 20:25:43', NULL),
(421, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.local/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://inspektorat.local/login', 'POST', '2019-11-25 20:24:48', '2019-11-25 20:24:48', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '2017_11_04_103444_create_laravel_logger_activity_table', 4),
(17, '2019_07_16_065959_skpd', 5),
(18, '2019_07_25_140742_kegiatan', 5),
(19, '2019_07_25_140820_detail_kegiatan', 5),
(20, '2019_12_10_060658_file_media', 6);

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
(4, 'App\\User', 2),
(4, 'App\\User', 44),
(4, 'App\\User', 45),
(4, 'App\\User', 51),
(4, 'App\\User', 52),
(4, 'App\\User', 53),
(4, 'App\\User', 56),
(4, 'App\\User', 62),
(4, 'App\\User', 66),
(4, 'App\\User', 67),
(4, 'App\\User', 68),
(5, 'App\\User', 4),
(5, 'App\\User', 8),
(5, 'App\\User', 9),
(5, 'App\\User', 10),
(5, 'App\\User', 11),
(5, 'App\\User', 13),
(5, 'App\\User', 18),
(5, 'App\\User', 19),
(5, 'App\\User', 26),
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
(5, 'App\\User', 72),
(6, 'App\\User', 7),
(6, 'App\\User', 27),
(6, 'App\\User', 29),
(6, 'App\\User', 30),
(6, 'App\\User', 31),
(6, 'App\\User', 32);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, 'Sign SPT', 'web', '2019-06-26 13:23:50', '2019-06-26 13:23:50');

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

--
-- Dumping data for table `resiko`
--

INSERT INTO `resiko` (`id`, `opd`, `nama_kegiatan`, `tujuan_kegiatan`, `tujuan_pd`, `sasaran_pd`, `capaian`, `tujuan`, `created_at`, `updated_at`) VALUES
(1, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2019-05-16 08:51:30', '2019-05-19 20:01:02'),
(2, 'guest', 'web', '2019-05-16 08:51:31', '2019-05-16 08:51:31'),
(3, 'TU Umum', 'web', '2019-05-19 19:57:43', '2019-05-19 19:57:43'),
(4, 'TU Perencanaan', 'web', '2019-05-19 19:58:21', '2019-05-19 19:58:21'),
(5, 'Auditor', 'web', '2019-05-31 00:08:50', '2019-05-31 00:08:50'),
(6, 'Inspektur', 'web', '2019-06-26 13:24:15', '2019-06-26 13:24:15');

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
(8, 6);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spt`
--

INSERT INTO `spt` (`id`, `jenis_spt_id`, `name`, `nomor`, `tgl_mulai`, `tgl_akhir`, `lokasi`, `approval_status`, `approval_by`, `notes`, `created_at`, `updated_at`) VALUES
(5, 5, 'Penjemuran Ikan Asin di Sepanjang', NULL, '2019-06-03 17:00:00', '2019-06-25 17:00:00', 'Sepanjang Taman Sidoarjo', 'processing', NULL, NULL, '2019-06-24 01:26:49', '2019-07-04 07:59:20'),
(2, 7, 'baru', 1113, '2019-05-31 17:00:00', '2019-06-14 17:00:00', 'Tanah Abang', 'approved', 6, NULL, '2019-06-13 00:01:20', '2019-12-04 20:47:52'),
(6, 6, 'Reviu Renstra Tahun 2016-2021', NULL, '2019-07-01 07:00:00', '2019-07-05 07:00:00', 'Kecamatan Sidoarjo Kabupaten Sidoarjo', 'processing', NULL, NULL, '2019-06-28 14:11:20', '2019-08-21 23:45:41'),
(7, 5, 'Perencanaan Angaran APBD', NULL, '2019-07-03 07:00:00', '2019-07-05 07:00:00', 'Desa Balongbendo Kecamatan Krian', 'processing', 6, NULL, '2019-07-02 08:53:39', '2019-11-04 19:33:02'),
(8, 10, 'test', 7777, '2019-07-05 07:00:00', '2019-07-19 07:00:00', 'Pagerwojo', 'approved', 6, NULL, '2019-07-02 09:56:25', '2019-09-04 18:37:05'),
(9, 6, '03/07/2019', 201, '2019-07-03 07:00:00', '2019-07-05 07:00:00', 'Dimanapun kau berada', 'approved', 6, NULL, '2019-07-03 09:47:08', '2019-07-04 08:05:27'),
(10, 7, 'perancangan', 531, '2019-07-09 17:00:00', '2019-07-10 17:00:00', 'SDN wonoayu', 'processing', 6, NULL, '2019-07-08 20:31:50', '2019-07-10 18:36:33'),
(11, 7, 'Pembuatan beras kencur', NULL, '2019-08-21 17:00:00', '2019-08-28 17:00:00', 'Jl. Surabaya No.5 Bandung', 'processing', 6, NULL, '2019-08-21 23:39:34', '2019-08-21 23:40:55'),
(12, 6, 'Pembuatan SPT', 3737, '2019-09-04 17:00:00', '2019-09-17 17:00:00', 'Balongbendo Krian', 'approved', 6, NULL, '2019-09-05 00:06:38', '2019-09-05 00:22:38'),
(13, 8, 'test spt', NULL, '2019-10-01 17:00:00', '2019-10-04 17:00:00', 'test spt', 'processing', 6, NULL, '2019-09-30 23:25:41', '2019-11-04 01:30:52'),
(14, 7, 'percobaan', NULL, '2019-10-08 17:00:00', '2019-10-22 17:00:00', 'planet namek', 'processing', NULL, NULL, '2019-10-23 00:28:44', '2019-10-23 00:28:44'),
(15, 8, 'simulasi percobaan spt', NULL, '2019-11-06 17:00:00', '2019-11-06 17:00:00', 'sidoarjo', 'processing', NULL, NULL, '2019-11-04 00:34:45', '2019-11-04 21:15:00'),
(17, 8, 'simulasi', 1219, '2019-12-20 17:00:00', '2019-12-22 17:00:00', 'kecamatan krian', 'approved', 6, NULL, '2019-12-19 19:58:51', '2019-12-19 20:01:05'),
(16, 8, 'cobaa penomoran', NULL, '2019-11-06 17:00:00', '2019-11-06 17:00:00', 'coba aja', 'approved', 6, NULL, '2019-11-25 20:26:17', '2019-11-25 20:27:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
