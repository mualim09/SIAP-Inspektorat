-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2020 at 07:35 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

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
