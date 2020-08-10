-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2019 at 05:04 AM
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
  `file_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_laporan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jenis pelaporan (KKP,NHP,LHP,LHE,BAP,DLL))',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'status berisikan persetujuan ketua, daltu, dalnis, supervisor, dll',
  `status_dupak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'null saat pertama buat spt, status aktif ketika disetujui, stored jika update nomor spt dan otomatis masuk ke tabel dupak.',
  `unsur_dupak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_spt_spt_id_foreign` (`spt_id`),
  KEY `detail_spt_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_spt`
--

INSERT INTO `detail_spt` (`id`, `spt_id`, `user_id`, `peran`, `lama`, `dupak`, `file_laporan`, `kode`, `jenis_laporan`, `status`, `status_dupak`, `unsur_dupak`) VALUES
(15, 5, 4, 'Pembantu Penanggung jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 6, 5, 'Pembantu Penanggung jawab', 4, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(19, 2, 2, 'Pembantu Penanggung jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 6, 6, 'Penanggung Jawab', 2, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(20, 2, 3, 'Penanggung Jawab', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 6, 2, 'Ketua Tim', 4, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(24, 6, 4, 'Anggota Tim', 4, NULL, NULL, NULL, NULL, NULL, 'aktif', NULL),
(25, 7, 7, 'Penanggung Jawab', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 7, 3, 'Supervisor', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 9, 8, 'Pengendali Mutu', 2, 0.52, NULL, NULL, NULL, NULL, 'aktif', NULL),
(40, 9, 9, 'Pengendali Teknis', 2, 0.42, NULL, NULL, NULL, NULL, 'aktif', NULL),
(38, 8, 8, 'Pengendali Mutu', 5, 1.30, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(39, 9, 10, 'Ketua Tim', 2, 0.26, NULL, NULL, NULL, NULL, 'aktif', NULL),
(36, 8, 9, 'Ketua Tim', 7, 0.00, NULL, NULL, NULL, NULL, 'aktif', 'pengawasan'),
(44, 10, 8, 'Pengendali Mutu', 1, 0.26, NULL, NULL, NULL, NULL, 'aktif', NULL),
(45, 11, 9, 'Supervisor', 7, 202.00, NULL, NULL, NULL, NULL, 'aktif', NULL),
(46, 11, 8, 'Pembantu Penanggung jawab', 7, 101.00, NULL, NULL, NULL, NULL, 'aktif', NULL),
(47, 11, 4, 'Supervisor', 7, 404.00, NULL, NULL, NULL, NULL, 'aktif', NULL),
(48, 11, 2, 'Ketua Tim', 7, 404.00, NULL, NULL, NULL, NULL, 'aktif', NULL),
(54, 12, 10, 'Anggota Tim', 13, 0.84, NULL, NULL, NULL, NULL, 'stored', 'pengawasan'),
(53, 12, 9, 'Anggota Tim', 13, 0.00, NULL, NULL, NULL, NULL, 'stored', 'pengawasan'),
(52, 12, 8, 'Ketua Tim', 13, 0.00, NULL, NULL, NULL, NULL, 'stored', 'pengawasan');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dupak`
--

INSERT INTO `dupak` (`id`, `user_id`, `dupak`, `unsur_dupak`, `status`, `created_at`, `updated_at`) VALUES
(2, 19, 200.00, 'pendidikan', NULL, '2019-09-02 23:48:42', '2019-09-02 23:51:13'),
(3, 19, 120.00, 'pendidikan', NULL, NULL, NULL),
(4, 18, 150.00, 'pengawasan', NULL, NULL, NULL),
(9, 9, 0.00, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06'),
(8, 10, 0.84, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06'),
(10, 8, 0.00, 'pengawasan', NULL, '2019-09-05 00:26:06', '2019-09-05 00:26:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laravel_logger_activity`
--

INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/login', 'POST', '2019-06-11 13:45:12', '2019-06-11 13:45:12', NULL),
(2, 'coba2', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/admin/user/LogUsers', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/', 'GET', '2019-06-11 13:45:23', '2019-06-11 13:45:23', NULL),
(3, 'coba 3', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/admin/user/LogUsers', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/', 'GET', '2019-06-11 14:18:50', '2019-06-11 14:18:50', NULL),
(4, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/login', 'POST', '2019-06-12 10:59:49', '2019-06-12 10:59:49', NULL),
(5, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/admin/user/view-activity', 'POST', '2019-06-12 11:29:43', '2019-06-12 11:29:43', NULL),
(6, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 1, 'http://www.inspektoratv2.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektoratv2.go.id/login', 'POST', '2019-06-12 11:29:50', '2019-06-12 11:29:50', NULL),
(7, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.guest', NULL, 'http://www.inspektorat.git/logout', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektorat.git/', 'POST', '2019-07-05 00:51:25', '2019-07-05 00:51:25', NULL),
(8, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://www.inspektorat.git/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektorat.git/login', 'POST', '2019-07-05 00:51:37', '2019-07-05 00:51:37', NULL),
(9, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://www.inspektorat.git/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektorat.git/login', 'POST', '2019-07-07 18:41:34', '2019-07-07 18:41:34', NULL),
(10, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://www.inspektorat.git/logout', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektorat.git/admin/activity/bindex', 'POST', '2019-07-07 19:22:31', '2019-07-07 19:22:31', NULL),
(11, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://www.inspektorat.git/login', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9,id;q=0.8', 'http://www.inspektorat.git/login', 'POST', '2019-07-08 18:30:36', '2019-07-08 18:30:36', NULL),
(12, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin', 'POST', '2019-07-08 20:08:59', '2019-07-08 20:08:59', NULL),
(13, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-07-09 00:35:39', '2019-07-09 00:35:39', NULL),
(14, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-09 00:43:16', '2019-07-09 00:43:16', NULL),
(15, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/jenis-spt', 'POST', '2019-07-09 00:43:32', '2019-07-09 00:43:32', NULL),
(16, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-09 00:43:40', '2019-07-09 00:43:40', NULL),
(17, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/myprofile', 'POST', '2019-07-09 00:44:49', '2019-07-09 00:44:49', NULL),
(18, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-09 00:44:57', '2019-07-09 00:44:57', NULL),
(19, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 3, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'POST', '2019-07-09 00:45:57', '2019-07-09 00:45:57', NULL),
(20, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 2, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-09 00:46:05', '2019-07-09 00:46:05', NULL),
(21, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-09 20:13:24', '2019-07-09 20:13:24', NULL),
(22, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 01:11:03', '2019-07-10 01:11:03', NULL),
(23, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/activity/bindex', 'POST', '2019-07-10 01:11:54', '2019-07-10 01:11:54', NULL),
(24, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 01:12:04', '2019-07-10 01:12:04', NULL),
(25, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 18:03:01', '2019-07-10 18:03:01', NULL),
(26, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 21:19:02', '2019-07-10 21:19:02', NULL),
(27, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 23:22:21', '2019-07-10 23:22:21', NULL),
(28, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-10 23:25:11', '2019-07-10 23:25:11', NULL),
(29, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-14 18:38:19', '2019-07-14 18:38:19', NULL),
(30, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-07-14 18:42:10', '2019-07-14 18:42:10', NULL),
(31, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-16 19:11:32', '2019-07-16 19:11:32', NULL),
(32, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-07-17 18:42:10', '2019-07-17 18:42:10', NULL),
(33, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-04 19:28:45', '2019-08-04 19:28:45', NULL),
(34, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'POST', '2019-08-04 19:29:20', '2019-08-04 19:29:20', NULL),
(35, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-04 19:29:32', '2019-08-04 19:29:32', NULL),
(36, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-04 19:57:04', '2019-08-04 19:57:04', NULL),
(37, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-07 00:19:56', '2019-08-07 00:19:56', NULL),
(38, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'POST', '2019-08-07 00:34:06', '2019-08-07 00:34:06', NULL),
(39, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-07 00:34:19', '2019-08-07 00:34:19', NULL),
(40, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 20:02:21', '2019-08-07 20:02:21', NULL),
(41, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 20:02:21', '2019-08-07 20:02:21', NULL),
(42, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:24:21', '2019-08-07 23:24:21', NULL),
(43, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:29:22', '2019-08-07 23:29:22', NULL),
(44, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:30:22', '2019-08-07 23:30:22', NULL),
(45, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:36:37', '2019-08-07 23:36:37', NULL),
(46, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:37:14', '2019-08-07 23:37:14', NULL),
(47, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:42:33', '2019-08-07 23:42:33', NULL),
(48, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:43:27', '2019-08-07 23:43:27', NULL),
(49, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:43:53', '2019-08-07 23:43:53', NULL),
(50, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:44:47', '2019-08-07 23:44:47', NULL),
(51, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:45:23', '2019-08-07 23:45:23', NULL),
(52, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:46:35', '2019-08-07 23:46:35', NULL),
(53, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:47:27', '2019-08-07 23:47:27', NULL),
(54, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:47:40', '2019-08-07 23:47:40', NULL),
(55, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:48:06', '2019-08-07 23:48:06', NULL),
(56, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:48:51', '2019-08-07 23:48:51', NULL),
(57, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:50:34', '2019-08-07 23:50:34', NULL),
(58, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:51:02', '2019-08-07 23:51:02', NULL),
(59, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:53:47', '2019-08-07 23:53:47', NULL),
(60, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:55:18', '2019-08-07 23:55:18', NULL),
(61, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:55:42', '2019-08-07 23:55:42', NULL),
(62, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:56:33', '2019-08-07 23:56:33', NULL),
(63, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:56:50', '2019-08-07 23:56:50', NULL),
(64, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-07 23:58:16', '2019-08-07 23:58:16', NULL),
(65, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:02:45', '2019-08-08 00:02:45', NULL),
(66, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:03:58', '2019-08-08 00:03:58', NULL),
(67, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:05:18', '2019-08-08 00:05:18', NULL),
(68, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:05:36', '2019-08-08 00:05:36', NULL),
(69, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:06:21', '2019-08-08 00:06:21', NULL),
(70, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:06:51', '2019-08-08 00:06:51', NULL),
(71, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:08:14', '2019-08-08 00:08:14', NULL),
(72, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:08:49', '2019-08-08 00:08:49', NULL),
(73, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:09:13', '2019-08-08 00:09:13', NULL),
(74, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:09:31', '2019-08-08 00:09:31', NULL),
(75, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:09:38', '2019-08-08 00:09:38', NULL),
(76, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:10:39', '2019-08-08 00:10:39', NULL),
(77, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:11:26', '2019-08-08 00:11:26', NULL),
(78, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:12:32', '2019-08-08 00:12:32', NULL),
(79, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:13:25', '2019-08-08 00:13:25', NULL),
(80, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:14:25', '2019-08-08 00:14:25', NULL),
(81, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:15:03', '2019-08-08 00:15:03', NULL),
(82, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:15:54', '2019-08-08 00:15:54', NULL),
(83, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:24:02', '2019-08-08 00:24:02', NULL),
(84, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:24:45', '2019-08-08 00:24:45', NULL),
(85, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:25:35', '2019-08-08 00:25:35', NULL),
(86, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 00:25:57', '2019-08-08 00:25:57', NULL),
(87, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 19:32:56', '2019-08-08 19:32:56', NULL),
(88, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 19:33:39', '2019-08-08 19:33:39', NULL),
(89, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/template/dupak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-08 19:34:15', '2019-08-08 19:34:15', NULL),
(90, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-11 18:35:49', '2019-08-11 18:35:49', NULL),
(91, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-12 23:23:03', '2019-08-12 23:23:03', NULL),
(92, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-13 23:14:44', '2019-08-13 23:14:44', NULL),
(93, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-19 00:45:10', '2019-08-19 00:45:10', NULL),
(94, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-19 00:45:10', '2019-08-19 00:45:10', NULL),
(95, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'POST', '2019-08-19 00:45:23', '2019-08-19 00:45:23', NULL),
(96, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-19 00:45:48', '2019-08-19 00:45:48', NULL),
(97, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 7, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-19 19:34:04', '2019-08-19 19:34:04', NULL),
(98, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-19 19:41:07', '2019-08-19 19:41:07', NULL),
(99, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-20 20:07:28', '2019-08-20 20:07:28', NULL),
(100, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-21 00:03:58', '2019-08-21 00:03:58', NULL),
(101, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-21 18:20:07', '2019-08-21 18:20:07', NULL),
(102, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-21 23:38:58', '2019-08-21 23:38:58', NULL),
(103, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-22 18:34:39', '2019-08-22 18:34:39', NULL),
(104, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-08-25 18:31:44', '2019-08-25 18:31:44', NULL),
(105, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'GET', '2019-08-25 23:49:54', '2019-08-25 23:49:54', NULL),
(106, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-27 19:41:04', '2019-08-27 19:41:04', NULL),
(107, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-28 00:31:50', '2019-08-28 00:31:50', NULL),
(108, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1566978535245&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-08-28 00:48:56', '2019-08-28 00:48:56', NULL),
(109, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-08-28 18:29:21', '2019-08-28 18:29:21', NULL),
(110, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1567043400826&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-08-28 18:50:02', '2019-08-28 18:50:02', NULL),
(111, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'PUT', '2019-08-29 02:23:06', '2019-08-29 02:23:06', NULL),
(112, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/18/edit', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-08-29 02:23:13', '2019-08-29 02:23:13', NULL),
(113, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-29 19:11:55', '2019-08-29 19:11:55', NULL),
(114, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-08-29 23:37:26', '2019-08-29 23:37:26', NULL),
(115, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1567147385110&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-08-29 23:43:07', '2019-08-29 23:43:07', NULL),
(116, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-01 17:59:22', '2019-09-01 17:59:22', NULL),
(117, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/spt', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/', 'GET', '2019-09-01 21:42:10', '2019-09-01 21:42:10', NULL),
(118, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-02 17:50:39', '2019-09-02 17:50:39', NULL),
(119, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-02 18:00:15', '2019-09-02 18:00:15', NULL),
(120, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/19/edit', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-02 23:35:21', '2019-09-02 23:35:21', NULL),
(121, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1567557903922&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-03 17:45:29', '2019-09-03 17:45:29', NULL),
(122, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users/getdata?_=1567646992967&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=nip&columns%5B1%5D%5Bname%5D=nip&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=full_name&columns%5B2%5D%5Bname%5D=full_name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=email&columns%5B3%5D%5Bname%5D=email&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=phone&columns%5B4%5D%5Bname%5D=phone&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=jabatan&columns%5B5%5D%5Bname%5D=jabatan&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=action&columns%5B6%5D%5Bname%5D=action&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=10&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'GET', '2019-09-04 18:31:04', '2019-09-04 18:31:04', NULL);
INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(123, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/spt', 'GET', '2019-09-04 23:55:43', '2019-09-04 23:55:43', NULL),
(124, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/spt/penomoran?_=1567731178031&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=name&columns%5B1%5D%5Bname%5D=name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=jenis_spt&columns%5B2%5D%5Bname%5D=jenis_spt&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=lokasi&columns%5B3%5D%5Bname%5D=lokasi&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin', 'GET', '2019-09-05 17:53:20', '2019-09-05 17:53:20', NULL),
(125, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/spt/get-processing-spt?_=1567731178032&columns%5B0%5D%5Bdata%5D=DT_RowIndex&columns%5B0%5D%5Bname%5D=DT_RowIndex&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=name&columns%5B1%5D%5Bname%5D=name&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=jenis_spt&columns%5B2%5D%5Bname%5D=jenis_spt&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=lokasi&columns%5B3%5D%5Bname%5D=lokasi&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=action&columns%5B4%5D%5Bname%5D=action&columns%5B4%5D%5Bsearchable%5D=false&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&draw=1&length=50&order%5B0%5D%5Bcolumn%5D=1&order%5B0%5D%5Bdir%5D=asc&search%5Bvalue%5D=&search%5Bregex%5D=false&start=0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin', 'GET', '2019-09-05 17:53:20', '2019-09-05 17:53:20', NULL),
(126, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/admin/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', NULL, 'GET', '2019-09-10 01:32:21', '2019-09-10 01:32:21', NULL),
(127, 'Logged Out', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/admin/users', 'POST', '2019-09-10 01:34:17', '2019-09-10 01:34:17', NULL),
(128, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 8, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-10 01:34:40', '2019-09-10 01:34:40', NULL),
(129, 'Logged In', 'LaravelLogger::laravel-logger.userTypes.registered', 6, 'http://inspektorat.go.id/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 'en-US,en;q=0.9', 'http://inspektorat.go.id/login', 'POST', '2019-09-10 17:50:37', '2019-09-10 17:50:37', NULL);

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
(5, 'App\\User', 4),
(5, 'App\\User', 8),
(5, 'App\\User', 9),
(5, 'App\\User', 10),
(5, 'App\\User', 11),
(5, 'App\\User', 13),
(5, 'App\\User', 18),
(5, 'App\\User', 19),
(5, 'App\\User', 26),
(6, 'App\\User', 7);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spt`
--

INSERT INTO `spt` (`id`, `jenis_spt_id`, `name`, `nomor`, `tgl_mulai`, `tgl_akhir`, `lokasi`, `approval_status`, `approval_by`, `notes`, `created_at`, `updated_at`) VALUES
(5, 5, 'Penjemuran Ikan Asin di Sepanjang', 303, '2019-06-03 17:00:00', '2019-06-25 17:00:00', 'Sepanjang Taman Sidoarjo', 'approved', 7, NULL, '2019-06-24 01:26:49', '2019-07-04 07:59:20'),
(2, 7, 'baru', 321, '2019-05-31 17:00:00', '2019-06-14 17:00:00', 'Tanah Abang', 'approved', NULL, NULL, '2019-06-13 00:01:20', '2019-06-27 14:20:05'),
(6, 6, 'Reviu Renstra Tahun 2016-2021', 777, '2019-07-01 07:00:00', '2019-07-05 07:00:00', 'Kecamatan Sidoarjo Kabupaten Sidoarjo', 'approved', 7, NULL, '2019-06-28 14:11:20', '2019-08-21 23:45:41'),
(7, 5, 'Perencanaan Angaran APBD', NULL, '2019-07-03 07:00:00', '2019-07-05 07:00:00', 'Desa Balongbendo Kecamatan Krian', 'rejected', 7, 'tolak aja', '2019-07-02 08:53:39', '2019-07-02 09:16:44'),
(8, 10, 'test', 7777, '2019-07-05 07:00:00', '2019-07-19 07:00:00', 'Pagerwojo', 'approved', 6, NULL, '2019-07-02 09:56:25', '2019-09-04 18:37:05'),
(9, 6, '03/07/2019', 201, '2019-07-03 07:00:00', '2019-07-05 07:00:00', 'Dimanapun kau berada', 'approved', 6, NULL, '2019-07-03 09:47:08', '2019-07-04 08:05:27'),
(10, 7, 'perancangan', 531, '2019-07-09 17:00:00', '2019-07-10 17:00:00', 'SDN wonoayu', 'approved', 6, NULL, '2019-07-08 20:31:50', '2019-07-10 18:36:33'),
(11, 7, 'Pembuatan beras kencur', 352, '2019-08-21 17:00:00', '2019-08-28 17:00:00', 'Jl. Surabaya No.5 Bandung', 'approved', 6, NULL, '2019-08-21 23:39:34', '2019-08-21 23:40:55'),
(12, 6, 'Pembuatan SPT', 3737, '2019-09-04 17:00:00', '2019-09-17 17:00:00', 'Balongbendo Krian', 'approved', 6, NULL, '2019-09-05 00:06:38', '2019-09-05 00:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` json DEFAULT NULL,
  `sex` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_auditor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sertifikat` json DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pendidikan`, `sex`, `gelar`, `jenis_auditor`, `email`, `phone`, `nip`, `jabatan`, `pangkat`, `sertifikat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Super', 'Admin', NULL, NULL, NULL, NULL, 'admin@local.host', 'admin@local.host', '90909090', 'Inspektur Kabupaten', 'I/A', NULL, NULL, '$2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO', '53bGSBJnR3qCl0q0d4Ymc9ttM2nM0hsM5uJJSYcJlKAxd1JfnHp8jBHf0oQF', '2019-06-18 19:32:57', '2019-06-18 19:32:57'),
(2, 'Bag', 'Perencanaan', NULL, NULL, NULL, NULL, 'rencana@local.host', '08885656', '', NULL, NULL, NULL, NULL, '$2y$10$ie3FCXY1.lE4IcRFFR9pc.JjqyW.JbW5pg9furifvhyKXIdZvpn16', 'T9XAzDyCsizSBwYn7qlpeGuy518Rx1Zj1KYsIF17XfgiwvqY87g75JSKMOei', '2019-06-03 10:11:39', '2019-06-03 10:11:39'),
(3, 'Bag', 'Umum', NULL, NULL, NULL, NULL, 'umum@local.host', '856789', '', NULL, NULL, NULL, NULL, '$2y$10$RmvHlAsX5zsWQzc/2T80S.f4N.gkrjf58v/xuzoY5ZGJ3Lp9TPi2i', '7M46ZzfUHJvJHXq087uc73z6YAD4nSFSTOFKzkfHdbfRiiT2tl47XijIVY4B', '2019-06-03 10:12:15', '2019-06-03 10:12:15'),
(4, 'Auditor', 'Auditor', NULL, NULL, NULL, NULL, 'audit@local.host', '88877888', '', NULL, NULL, NULL, NULL, '$2y$10$TgpT8ooFc8SkZ/TMnMinru2mXP1aSzvXs6v4RsYTbywxxDIomaQGO', NULL, '2019-06-03 10:13:02', '2019-06-03 10:13:02'),
(5, 'Tegar', 'WPIP', NULL, NULL, NULL, NULL, 'tegar@local.host', '+628567892', NULL, NULL, NULL, NULL, NULL, '$2y$10$GI0kjoxWCtpDOGFFX5oy3uVlB.itkdo8tCUP3ordw6D/6uT7mgDnS', NULL, '2019-06-18 01:09:02', '2019-06-18 01:09:02'),
(7, 'User', 'Inspektur', NULL, NULL, NULL, NULL, 'inspektur@local.host', '08226767890', '4567890', 'Inspektur Kabupaten', 'I/A', NULL, NULL, '$2y$10$6fQsHp1kb7AvrYX7P2HtVe4oe8/L9fBvLH2ghxJBXI0o6ryEUHrA2', 'MxI5wPQZyICn66syKSBunZzoraecg9nqMCIpP2xH4h16SRwflDAf6K0thYaW', '2019-07-01 13:48:31', '2019-07-01 13:48:31'),
(8, 'Auditor', 'Utama', NULL, NULL, NULL, NULL, 'utama@local.host', '123123123', '351351', 'Auditor Utama', 'IV/A', NULL, NULL, '$2y$10$QwVPABChpEeqLVEhqUu3Du1W7ITkJrx8gTA28XYJoyownUsIpVnD.', 'hx05JRh5O4Bp1GioHoW7HCGtDK8Ed352Bp7ATNwINmQgWenhjX5NVAIdOo67', '2019-07-03 09:03:37', '2019-07-03 09:03:37'),
(9, 'Auditor', 'Madya', NULL, NULL, NULL, NULL, 'madya@local.host', '3717171', '5455454545454', 'Auditor Madya', 'III/B', NULL, NULL, '$2y$10$gWzZRpx7FgCbVqs77ANui.UcEVgGKR2OiFNeXK4nZi6mmIeR5IAna', NULL, '2019-07-03 09:04:52', '2019-07-03 09:04:52'),
(10, 'Auditor', 'Muda', NULL, NULL, NULL, NULL, 'muda@local.host', '08226767890', '3414124124', 'Auditor Muda', 'III/B', NULL, NULL, '$2y$10$7bX/nGmRj01UclbcfuezV.J9yftnBvSztnG8R/AtM16ZaFN.pgXuq', NULL, '2019-07-03 09:05:34', '2019-07-03 09:05:34'),
(19, 'aan', 'prasetyo', '{\"tahun\": \"2015\", \"jurusan\": \"Teknologi Papan Bawah\", \"tingkat\": \"Doktor (S3)\"}', 'Laki-laki', 'amd', 'ahli', 'aan@local.host', '0315458754', '3545656', 'Sekertaris', 'I/C', '{\"1\": {\"name\": \"Pemberdayaan Alam\", \"tahun\": \"2012\", \"instansi\": \"Diknas\"}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$DGiwTjy7GAt4hSXsDkxUCulywXw3nanrRgrox5RIb9LJG48z8GEDu', NULL, '2019-08-29 23:45:02', '2019-09-02 23:51:13'),
(13, 'Tegar', 'Sulistyo', '{\"tahun\": \"2017\", \"jurusan\": \"Sistem ptk\", \"tingkat\": \"Strata 3 (S4)\"}', 'Laki-laki', 'Amd', NULL, 'teggar@local.host', '456465464', '456465464', 'Inspektur Kabupaten', 'II/B', '{\"1\": {\"name\": \"Pemberdayaan Alam\", \"tahun\": \"2012\", \"instansi\": \"Pengalengan\"}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$d/lI0JQaB.2fCljQS9/znOk5V37eqwk5XQuyRo8KwNBX6sZDFuUVa', NULL, '2019-08-26 00:48:25', '2019-08-26 00:48:25'),
(26, 'aaaa', 'asgasdg', '{\"tahun\": \"2015\", \"jurusan\": \"Sistem Informasi\", \"tingkat\": \"Diploma 2 (D2)\"}', 'Laki-laki', 'Amd', 'terampil', 'dhah@local.host', '6546545', '56375675464', 'Sekertaris', 'I/B', '{\"1\": {\"name\": \"Pemberdayaan Manusia\", \"tahun\": \"2012\", \"instansi\": \"Diknas\"}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$PUum3omuF.BNieDelAMVJ.sleLvnfhi8RnlYKMutkHMK/uNMEhdwC', NULL, '2019-09-02 20:16:23', '2019-09-02 20:49:20'),
(18, 'Aat', 'Sura\'at', '{\"tahun\": \"2017\", \"jurusan\": \"Sistem Informasi\", \"tingkat\": \"Diploma 3 (D3)\"}', 'Laki-laki', 'Amd', 'terampil', 'aat@local.host', 'admin@local.host', '978248', 'Sekertaris', 'I/B', '{\"1\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"2\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"3\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"4\": {\"name\": null, \"tahun\": null, \"instansi\": null}, \"5\": {\"name\": null, \"tahun\": null, \"instansi\": null}}', NULL, '$2y$10$bKHqJ4vLVAiqoQnXUBNxTOtYWu850TlCCIVM0AIkJtyDDrVaS93cW', NULL, '2019-08-28 18:57:44', '2019-08-28 18:57:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
