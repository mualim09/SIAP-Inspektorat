-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2020 at 02:55 AM
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
-- Database: `inspektorat`
--

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
  `parent_id` int(11) DEFAULT NULL,
  `kode` varchar(5) NOT NULL,
  `deskripsi` varchar(499) NOT NULL,
  `atribut` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kode_temuan`
--

INSERT INTO `kode_temuan` (`id`, `parent_id`, `kode`, `deskripsi`, `atribut`) VALUES
(1, 0, '1', 'Temuan Ketidakpatuhan Terhadap Peraturan', '{\"kelompok\": null, \"subkelompok\": null}'),
(2, 0, '2', 'Temuan kelemahan sistem pengendalian intern', '{\"kelompok\": null, \"subkelompok\": null}'),
(3, 0, '3', 'Temuan 3E', '{\"kelompok\": null, \"subkelompok\": null}'),
(4, 1, '01', 'Kerugian negara/daerah atau kerugian negara/daerah\r\nyang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(6, 4, '02', 'Rekanan pengadaan barang/jasa tidak menyelesaikan pekerjaan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(7, 4, '03', 'Kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(8, 4, '04', 'Kelebihan pembayaran selain kekurangan volume pekerjaan dan/atau barang', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(9, 4, '05', 'Pemahalan harga (Mark up)', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(10, 4, '06', 'Penggunaan uang/barang untuk kepentingan pribadi', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(11, 4, '07', 'Pembayaran honorarium dan/atau biaya perjalanan dinas ganda dan/atau melebihi standar yang ditetapkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(12, 4, '08', 'Spesifikasi barang/jasa yang diterima tidak sesuai dengan kontrak', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(13, 4, '09', 'Belanja tidak sesuai atau melebihi ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(14, 4, '10', 'Pengembalian pinjaman/piutang atau dana bergulir macet', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(15, 4, '11', 'Kelebihan penetapan dan pembayaran restitusi pajak atau penetapan kompensasi kerugian', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(16, 4, '12', 'Penjualan/pertukaran/penghapusan aset negara/daerah tidak sesuai ketentuan dan merugikan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(17, 4, '13', 'Pengenaan ganti kerugian negara belum/tidak dilaksanakan sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(18, 4, '14', 'Entitas belum/tidak melaksanakan tuntutan perbendaharaan (TP) sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(19, 4, '15', 'Penghapusan hak tagih tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(20, 4, '16', 'Pelanggaran ketentuan pemberian diskon penjualan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(21, 4, '17', 'Penentuan HPP (harga pokok pembelian) terlalu rendah sehingga penentuan harga jual lebih rendah dari yang seharusnya', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(22, 4, '18', 'Jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak dapat dicairkan', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(23, 4, '19', 'Penyetoran penerimaan negara/daerah dengan bukti fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}'),
(26, 1, '02', 'Potensi kerugian negara/daerah atau kerugian negara/daerah yang terjadi pada perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(27, 25, '01', 'Kelebihan pembayaran dalam pengadaan barang/jasa tetapi pembayaran pekerjaan belum dilakukan sebagian atau seluruhnya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(28, 25, '02', 'Rekanan belum melaksanakan kewajiban pemeliharaan barang hasil pengadaan yang telah rusak selama masa pemeliharaan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(29, 25, '03', 'Aset dikuasai pihak lain', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(30, 25, '04', 'Pembelian aset yang berstatus sengketa', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(31, 25, '05', 'Aset tidak diketahui keberadaannya', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(32, 25, '06', 'Pemberian jaminan pelaksanaan dalam pelaksanaan pekerjaan, pemanfaatan barang dan pemberian fasilitas tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(33, 25, '07', 'Pihak ketiga belum melaksanakan kewajiban untuk menyerahkan aset kepada negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(34, 25, '08', 'Piutang/pinjaman atau dana bergulir yang berpotensi tidak tertagih', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(35, 25, '09', 'Penghapusan piutang tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(36, 25, '10', 'Pencairan anggaran pada akhir tahun anggaran untuk pekerjaan yang belum selesai', '{\"kelompok\": \"1\", \"subkelompok\": \"02\"}'),
(37, 1, '03', 'Kekurangan penerimaan negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(38, 36, '01', 'Penerimaan negara/daerah atau denda keterlambatan pekerjaan belum/tidak ditetapkan dipungut/diterima/disetor ke kas negara/daerah atau perusahaan milik negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(39, 36, '02', 'Penggunaan langsung penerimaan negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(40, 36, '03', 'Dana Perimbangan yang telah ditetapkan belum masuk ke kas daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(41, 36, '04', 'Penerimaan negara/daerah diterima atau digunakan oleh instansi yang tidak berhak', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(42, 36, '05', 'Pengenaan tarif pajak/PNBP lebih rendah dari ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(43, 36, '06', 'Koreksi perhitungan bagi hasil dengan KKKS', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(44, 36, '07', 'Kelebihan pembayaran subsidi oleh pemerintah', '{\"kelompok\": \"1\", \"subkelompok\": \"03\"}'),
(45, 1, '04', 'Administrasi', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(46, 44, '01', 'Pertanggungjawaban tidak akuntabel (bukti tidak lengkap/tidak valid)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(47, 44, '02', 'Pekerjaan dilaksanakan mendahului kontrak atau penetapan anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(48, 44, '03', 'Proses pengadaan barang/jasa tidak sesuai ketentuan (tidak menimbulkan kerugian negara)', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(49, 44, '04', 'Pemecahan kontrak untuk menghindari pelelangan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(50, 44, '05', 'Pelaksanaan lelang secara performa', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(51, 44, '06', 'Penyimpangan terhadap peraturan perundang-undangan bidang pengelolaan perlengkapan atau barang milik negara/daerah/perusahaan\r\n', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(52, 44, '07', 'Penyimpangan terhadap peraturan perundang-undangan bidang tertentu lainnya seperti kehutanan, pertambangan, perpajakan, dll', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(53, 44, '08', 'Koreksi perhitungan subsidi/kewajiban pelayanan umum', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(54, 44, '09', 'Pembentukan cadangan piutang, perhitungan penyusutan atau amortisasi tidak sesuai ketentuan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(55, 44, '10', 'Penyetoran penerimaan negara/daerah atau kas di bendaharawan ke kas negara/daerah melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(56, 44, '11', 'Pertanggungjawaban/penyetoran uang persediaan melebihi batas waktu yang ditentukan', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(57, 44, '12', 'Sisa kas di bendahara pengeluaran akhir tahun anggaran belum/tidak disetor ke kas negara/daerah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(58, 44, '13', 'Pengeluaran investasi pemerintah tidak didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(59, 44, '14', 'Kepemilikan aset tidak/belum didukung bukti yang sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(60, 44, '15', 'Pengalihan anggaran antar MAK tidak sah', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(61, 44, '16', 'Pelampauan pagu anggaran', '{\"kelompok\": \"1\", \"subkelompok\": \"04\"}'),
(62, 1, '05', 'Indikasi tindak pidana', '{\"kelompok\": \"1\", \"subkelompok\": null}'),
(63, 61, '01', 'Indikasi tindak pidana korupsi', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(64, 61, '02', 'Indikasi tindak pidana perbankan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(65, 61, '03', 'Indikasi tindak pidana perpajakan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(66, 61, '04', 'Indikasi tindak pidana kepabeanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(67, 61, '05', 'Indikasi tindak pidana kehutanan', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(68, 61, '06', 'Indikasi tindak pidana pasar modal', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(69, 61, '07', 'Indikasi tindak pidana khusus lainnya', '{\"kelompok\": \"1\", \"subkelompok\": \"05\"}'),
(70, 2, '01', 'Kelemahan sistem pengendalian akuntansi dan pelaporan', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(71, 69, '01', 'Pencatatan tidak/belum dilakukan atau tidak akurat', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(72, 69, '02', 'Proses penyusunan laporan tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(73, 69, '03', 'Entitas terlambat menyampaikan laporan', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(74, 69, '04', 'Sistem informasi akuntansi dan pelaporan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(75, 69, '05', 'Sistem informasi akuntansi dan pelaporan belum didukung SDM yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"01\"}'),
(76, 2, '02', 'Kelemahan sistem pengendalian pelaksanaan anggaran pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(77, 75, '01', 'Perencanaan kegiatan tidak memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(78, 75, '02', 'Mekanisme pemungutan, penyetoran dan pelaporan serta penggunaan Penerimaan negara/daerah/perusahaan dan hibah tidak sesuai ketentuan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(79, 75, '03', 'Penyimpangan terhadap peraturan perundang-undangan bidang teknis tertentu atau ketentuan intern organisasi yang diperiksa tentang pendapatan dan belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(80, 75, '04', 'Pelaksanaan belanja di luar mekanisme APBN/APBD', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(81, 75, '05', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat hilangnya potensi penerimaan/pendapatan', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(82, 75, '06', 'Penetapan/pelaksanaan kebijakan tidak tepat atau belum dilakukan berakibat peningkatan biaya /belanja', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(83, 75, '07', 'Kelemahan pengelolaan fisik aset', '{\"kelompok\": \"2\", \"subkelompok\": \"02\"}'),
(84, 2, '03', 'Kelemahan struktur pengendalian intern', '{\"kelompok\": \"2\", \"subkelompok\": null}'),
(85, 83, '01', 'Entitas tidak memiliki SOP yang formal untuk suatu prosedur atau keseluruhan prosedur', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(86, 83, '02', 'SOP yang ada pada entitas tidak berjalan secara optimal atau tidak ditaati', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(87, 83, '03', 'Entitas tidak memiliki satuan pengawas intern', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(88, 83, '04', 'Satuan pengawas intern yang ada tidak memadai atau tidak berjalan optimal', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(89, 83, '05', 'Tidak ada pemisahan tugas dan fungsi yang memadai', '{\"kelompok\": \"2\", \"subkelompok\": \"03\"}'),
(90, 3, '01', 'Ketidakhematan/pemborosan/ketidakekonomisan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(91, 89, '01', 'Pengadaan barang/jasa melebihi kebutuhan', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(92, 89, '02', 'Penetapan kualitas dan kuantitas barang/jasa yang digunakan tidak sesuai standar', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(93, 89, '03', 'Pemborosan keuangan negara/daerah/perusahaan atau kemahalan harga', '{\"kelompok\": \"3\", \"subkelompok\": \"01\"}'),
(94, 3, '02', 'Ketidakefisienan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(95, 93, '01', 'Penggunaan kuantitas input untuk satu satuan output lebih besar/tinggi dari yang seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(96, 93, '02', 'Penggunaan kualitas input untuk satu satuan output lebih tinggi dari seharusnya', '{\"kelompok\": \"3\", \"subkelompok\": \"02\"}'),
(97, 3, '03', 'Ketidakefektifan', '{\"kelompok\": \"3\", \"subkelompok\": null}'),
(98, 96, '01', 'Penggunaan anggaran tidak tepat sasaran/tidak sesuai peruntukan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(99, 96, '02', 'Pemanfaatan barang/jasa dilakukan tidak sesuai dengan rencana yang ditetapkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(100, 96, '03', 'Barang yang dibeli belum/tidak dapat dimanfaatkan', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(101, 96, '04', 'Pemanfaatan barang/jasa tidak berdampak terhadap pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(102, 96, '05', 'Pelaksanaan kegiatan terlambat/terhambat sehingga mempengaruhi pencapaian tujuan organisasi', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(103, 96, '06', 'Pelayanan kepada masyarakat tidak optimal', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(104, 96, '07', 'Fungsi atau tugas instansi yang diperiksa tidak diselenggarakan dengan baik termasuk target penerimaan tidak tercapai', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(105, 96, '08', 'Penggunaan biaya promosi/pemasaran tidak efektif', '{\"kelompok\": \"3\", \"subkelompok\": \"03\"}'),
(5, 4, '01', 'Belanja dan/atau pengadaan barang/jasa fiktif', '{\"kelompok\": \"1\", \"subkelompok\": \"01\"}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
