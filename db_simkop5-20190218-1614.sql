-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 18, 2019 at 10:13 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simkop5`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_nasabah`
--

CREATE TABLE `t01_nasabah` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telp_Hp` varchar(100) NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Pekerjaan_Alamat` text NOT NULL,
  `Pekerjaan_No_Telp_Hp` varchar(100) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '0',
  `Keterangan` varchar(100) DEFAULT NULL,
  `marketing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Nama`, `Alamat`, `No_Telp_Hp`, `Pekerjaan`, `Pekerjaan_Alamat`, `Pekerjaan_No_Telp_Hp`, `Status`, `Keterangan`, `marketing_id`) VALUES
(1, 'Dodo Ananto', 'Krian', '08113422516', 'Swasta', 'Perak', '0313503589', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t02_jaminan`
--

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Merk_Type` text NOT NULL,
  `No_Rangka` text,
  `No_Mesin` text,
  `Warna` text,
  `No_Pol` text,
  `Keterangan` text,
  `Atas_Nama` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_jaminan`
--

INSERT INTO `t02_jaminan` (`id`, `nasabah_id`, `Merk_Type`, `No_Rangka`, `No_Mesin`, `Warna`, `No_Pol`, `Keterangan`, `Atas_Nama`) VALUES
(1, 1, 'ATM', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t03_pinjaman`
--

CREATE TABLE `t03_pinjaman` (
  `id` int(11) NOT NULL,
  `Kontrak_No` varchar(25) NOT NULL,
  `Kontrak_Tgl` date NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `jaminan_id` varchar(100) NOT NULL,
  `Pinjaman` float(14,2) NOT NULL,
  `Angsuran_Lama` tinyint(4) NOT NULL,
  `Angsuran_Bunga_Prosen` decimal(5,2) NOT NULL DEFAULT '2.25',
  `Angsuran_Denda` decimal(5,2) NOT NULL DEFAULT '0.40',
  `Dispensasi_Denda` tinyint(4) NOT NULL DEFAULT '3',
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `No_Ref` varchar(25) DEFAULT NULL,
  `Biaya_Administrasi` float(14,2) NOT NULL DEFAULT '0.00',
  `Biaya_Materai` float(14,2) NOT NULL DEFAULT '0.00',
  `marketing_id` int(11) NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `Macet` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_pinjaman`
--

INSERT INTO `t03_pinjaman` (`id`, `Kontrak_No`, `Kontrak_Tgl`, `nasabah_id`, `jaminan_id`, `Pinjaman`, `Angsuran_Lama`, `Angsuran_Bunga_Prosen`, `Angsuran_Denda`, `Dispensasi_Denda`, `Angsuran_Pokok`, `Angsuran_Bunga`, `Angsuran_Total`, `No_Ref`, `Biaya_Administrasi`, `Biaya_Materai`, `marketing_id`, `Periode`, `Macet`) VALUES
(1, '60001', '2018-12-04', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 25000.00, 18000.00, 1, '201812', 'N'),
(2, '60002', '2019-02-10', 1, '1', 16000000.00, 12, '2.25', '0.40', 3, 1333333.38, 360000.00, 1693333.38, NULL, 0.00, 0.00, 1, '201902', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t04_pinjamanangsuran`
--

CREATE TABLE `t04_pinjamanangsuran` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Angsuran_Ke` tinyint(4) NOT NULL,
  `Angsuran_Tanggal` date NOT NULL,
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `Sisa_Hutang` float(14,2) NOT NULL,
  `Tanggal_Bayar` date DEFAULT NULL,
  `Terlambat` smallint(6) DEFAULT NULL,
  `Total_Denda` float(14,2) DEFAULT NULL,
  `Bayar_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Non_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Total` float(14,2) DEFAULT NULL,
  `Keterangan` text,
  `Periode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t04_pinjamanangsurantemp`
--

CREATE TABLE `t04_pinjamanangsurantemp` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Angsuran_Ke` tinyint(4) NOT NULL,
  `Angsuran_Tanggal` date NOT NULL,
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `Sisa_Hutang` float(14,2) NOT NULL,
  `Tanggal_Bayar` date DEFAULT NULL,
  `Terlambat` smallint(6) DEFAULT NULL,
  `Total_Denda` float(14,2) DEFAULT NULL,
  `Bayar_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Non_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Total` float(14,2) DEFAULT NULL,
  `Keterangan` text,
  `Periode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_pinjamanangsurantemp`
--

INSERT INTO `t04_pinjamanangsurantemp` (`id`, `pinjaman_id`, `Angsuran_Ke`, `Angsuran_Tanggal`, `Angsuran_Pokok`, `Angsuran_Bunga`, `Angsuran_Total`, `Sisa_Hutang`, `Tanggal_Bayar`, `Terlambat`, `Total_Denda`, `Bayar_Titipan`, `Bayar_Non_Titipan`, `Bayar_Total`, `Keterangan`, `Periode`) VALUES
(1, 1, 1, '2019-01-04', 867000.00, 233000.00, 1100000.00, 9533000.00, '2019-01-04', 0, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201901'),
(2, 1, 2, '2019-02-04', 867000.00, 233000.00, 1100000.00, 8666000.00, '2019-02-04', 0, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(3, 1, 3, '2019-03-04', 867000.00, 233000.00, 1100000.00, 7799000.00, '2019-02-04', -28, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(4, 1, 4, '2019-04-04', 867000.00, 233000.00, 1100000.00, 6932000.00, '2019-04-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(5, 1, 5, '2019-05-04', 867000.00, 233000.00, 1100000.00, 6065000.00, '2019-05-10', 6, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(6, 1, 6, '2019-06-04', 867000.00, 233000.00, 1100000.00, 5198000.00, '2019-06-09', 5, 22000.00, 0.00, 1100000.00, 1122000.00, NULL, '201902'),
(7, 1, 7, '2019-07-04', 867000.00, 233000.00, 1100000.00, 4331000.00, '2019-07-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(8, 1, 8, '2019-08-04', 867000.00, 233000.00, 1100000.00, 3464000.00, '2019-08-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(9, 1, 9, '2019-09-04', 867000.00, 233000.00, 1100000.00, 2597000.00, '2019-09-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201902'),
(10, 1, 10, '2019-10-04', 867000.00, 233000.00, 1100000.00, 1730000.00, '2019-10-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, '22000', '201902'),
(11, 1, 11, '2019-11-04', 867000.00, 233000.00, 1100000.00, 863000.00, '2019-11-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, 'Denda Rp. 22,000.00', '201902'),
(12, 1, 12, '2019-12-04', 863000.00, 237000.00, 1100000.00, 0.00, '2019-12-09', 5, 0.00, 0.00, 1100000.00, 1100000.00, 'Denda Rp. 22,000.00', '201912'),
(13, 2, 1, '2019-03-10', 1333333.38, 360000.00, 1693333.38, 14666667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 2, '2019-04-10', 1333333.38, 360000.00, 1693333.38, 13333333.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 2, 3, '2019-05-10', 1333333.38, 360000.00, 1693333.38, 12000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 4, '2019-06-10', 1333333.38, 360000.00, 1693333.38, 10666667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 2, 5, '2019-07-10', 1333333.38, 360000.00, 1693333.38, 9333333.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 2, 6, '2019-08-10', 1333333.38, 360000.00, 1693333.38, 8000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 7, '2019-09-10', 1333333.38, 360000.00, 1693333.38, 6666666.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 2, 8, '2019-10-10', 1333333.38, 360000.00, 1693333.38, 5333333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 2, 9, '2019-11-10', 1333333.38, 360000.00, 1693333.38, 4000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 10, '2019-12-10', 1333333.38, 360000.00, 1693333.38, 2666666.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 11, '2020-01-10', 1333333.38, 360000.00, 1693333.38, 1333333.38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 12, '2020-02-10', 1333333.38, 360000.00, 1693333.38, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t05_pinjamanjaminan`
--

CREATE TABLE `t05_pinjamanjaminan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jaminan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t06_pinjamantitipan`
--

CREATE TABLE `t06_pinjamantitipan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Masuk` float(14,2) NOT NULL DEFAULT '0.00',
  `Keluar` float(14,2) NOT NULL DEFAULT '0.00',
  `Sisa` float(14,2) NOT NULL DEFAULT '0.00',
  `Angsuran_Ke` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t07_marketing`
--

CREATE TABLE `t07_marketing` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `NoHP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t07_marketing`
--

INSERT INTO `t07_marketing` (`id`, `Nama`, `Alamat`, `NoHP`) VALUES
(1, 'Adi', 'Surabaya', '081232047762');

-- --------------------------------------------------------

--
-- Table structure for table `t08_pinjamanpotongan`
--

CREATE TABLE `t08_pinjamanpotongan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t09_jurnaltransaksi`
--

CREATE TABLE `t09_jurnaltransaksi` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `periode` varchar(35) NOT NULL DEFAULT '',
  `model` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(35) NOT NULL DEFAULT '',
  `debet` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `pembayaran_` double NOT NULL DEFAULT '0',
  `bunga_` double NOT NULL DEFAULT '0',
  `denda_` double NOT NULL DEFAULT '0',
  `titipan_` double NOT NULL DEFAULT '0',
  `administrasi_` double NOT NULL DEFAULT '0',
  `modal_` double NOT NULL DEFAULT '0',
  `pinjaman_` double NOT NULL DEFAULT '0',
  `biaya_` double NOT NULL DEFAULT '0',
  `keterangan` tinytext NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t10_jurnal`
--

CREATE TABLE `t10_jurnal` (
  `id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  `Keterangan` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t10_jurnal`
--

INSERT INTO `t10_jurnal` (`id`, `Tanggal`, `Periode`, `NomorTransaksi`, `Rekening`, `Debet`, `Kredit`, `Keterangan`) VALUES
(1, '2019-02-04', '201812', '1.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 60001'),
(2, '2019-02-04', '201812', '1.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 60001'),
(3, '2019-02-04', '201812', '1.ADM', '1.1003', 25000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(4, '2019-02-04', '201812', '1.ADM', '5.1000', 0.00, 25000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(5, '2019-02-04', '201812', '1.MAT', '1.1003', 18000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(6, '2019-02-04', '201812', '1.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(7, '2019-02-04', '201901', '1.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(8, '2019-02-04', '201901', '1.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(9, '2019-02-04', '201901', '1.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(10, '2019-02-04', '201901', '1.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(11, '2019-02-04', '201901', '1.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(12, '2019-02-04', '201901', '1.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(13, '2019-02-04', '201902', '2.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(14, '2019-02-04', '201902', '2.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(15, '2019-02-04', '201902', '2.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(16, '2019-02-04', '201902', '2.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(17, '2019-02-04', '201902', '2.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(18, '2019-02-04', '201902', '2.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(19, '2019-02-04', '201902', '3.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60001'),
(20, '2019-02-04', '201902', '3.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60001'),
(21, '2019-02-04', '201902', '3.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 3 No. Kontrak 60001'),
(22, '2019-02-04', '201902', '3.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 3 No. Kontrak 60001'),
(23, '2019-02-04', '201902', '3.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60001'),
(24, '2019-02-04', '201902', '3.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60001'),
(25, '2019-02-08', '201902', '2.PINJ', '1.2003', 16000000.00, 0.00, 'Pinjaman No. Kontrak 60002'),
(26, '2019-02-08', '201902', '2.PINJ', '1.1003', 0.00, 16000000.00, 'Pinjaman No. Kontrak 60002'),
(27, '2019-02-08', '201902', '2.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(28, '2019-02-08', '201902', '2.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(29, '2019-02-08', '201902', '2.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(30, '2019-02-08', '201902', '2.MAT', '5.4000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(31, '2019-02-09', '201902', '6.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60001'),
(32, '2019-02-09', '201902', '6.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60001'),
(33, '2019-02-09', '201902', '6.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 6 No. Kontrak 60001'),
(34, '2019-02-09', '201902', '6.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 6 No. Kontrak 60001'),
(35, '2019-02-09', '201902', '6.DND', '1.1003', 22000.00, 0.00, 'Pendapatan Denda ke 6 No. Kontrak 60001'),
(36, '2019-02-09', '201902', '6.DND', '5.3000', 0.00, 22000.00, 'Pendapatan Denda ke 6 No. Kontrak 60001'),
(37, '2019-02-09', '201902', '9.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 9 No. Kontrak 60001'),
(38, '2019-02-09', '201902', '9.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 9 No. Kontrak 60001'),
(39, '2019-02-09', '201902', '9.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 9 No. Kontrak 60001'),
(40, '2019-02-09', '201902', '9.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 9 No. Kontrak 60001'),
(41, '2019-02-09', '201902', '9.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 9 No. Kontrak 60001'),
(42, '2019-02-09', '201902', '9.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 9 No. Kontrak 60001'),
(43, '2019-02-09', '201902', '10.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 10 No. Kontrak 60001'),
(44, '2019-02-09', '201902', '10.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 10 No. Kontrak 60001'),
(45, '2019-02-09', '201902', '10.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 10 No. Kontrak 60001'),
(46, '2019-02-09', '201902', '10.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 10 No. Kontrak 60001'),
(47, '2019-02-09', '201902', '10.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 10 No. Kontrak 60001'),
(48, '2019-02-09', '201902', '10.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 10 No. Kontrak 60001'),
(49, '2019-02-09', '201902', '11.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 11 No. Kontrak 60001'),
(50, '2019-02-09', '201902', '11.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 11 No. Kontrak 60001'),
(51, '2019-02-09', '201902', '11.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 11 No. Kontrak 60001'),
(52, '2019-02-09', '201902', '11.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 11 No. Kontrak 60001'),
(53, '2019-02-09', '201902', '11.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 11 No. Kontrak 60001'),
(54, '2019-02-09', '201902', '11.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 11 No. Kontrak 60001'),
(55, '2019-02-09', '201902', '12.ANG', '1.1003', 863000.00, 0.00, 'Pembayaran Angsuran ke 12 No. Kontrak 60001'),
(56, '2019-02-09', '201902', '12.ANG', '1.2003', 0.00, 863000.00, 'Pembayaran Angsuran ke 12 No. Kontrak 60001'),
(57, '2019-02-09', '201902', '12.BGA', '1.1003', 237000.00, 0.00, 'Pendapatan Bunga ke 12 No. Kontrak 60001'),
(58, '2019-02-09', '201902', '12.BGA', '3.1000', 0.00, 237000.00, 'Pendapatan Bunga ke 12 No. Kontrak 60001'),
(59, '2019-02-09', '201902', '12.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 12 No. Kontrak 60001'),
(60, '2019-02-09', '201902', '12.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 12 No. Kontrak 60001'),
(61, '2019-02-09', '201902', '1.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(62, '2019-02-09', '201902', '1.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(63, '2019-02-09', '201902', '1.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(64, '2019-02-09', '201902', '1.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(65, '2019-02-09', '201902', '1.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(66, '2019-02-09', '201902', '1.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(67, '2019-02-10', '201902', '2.PINJ', '1.2003', 16000000.00, 0.00, 'Pinjaman No. Kontrak 60002'),
(68, '2019-02-10', '201902', '2.PINJ', '1.1003', 0.00, 16000000.00, 'Pinjaman No. Kontrak 60002'),
(69, '2019-02-10', '201902', '2.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(70, '2019-02-10', '201902', '2.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(71, '2019-02-10', '201902', '2.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(72, '2019-02-10', '201902', '2.MAT', '5.4000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(73, '2019-02-18', '201902', '2.NSBMCT', '1.2003', 16000000.00, 0.00, 'Nasabah Macet Pinjaman No. Kontrak 60002'),
(74, '2019-02-18', '201902', '2.NSBMCT', '1.2002', 0.00, 16000000.00, 'Nasabah Macet Pinjaman No. Kontrak 60002');

-- --------------------------------------------------------

--
-- Table structure for table `t11_jurnalmaster`
--

CREATE TABLE `t11_jurnalmaster` (
  `id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `Periode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t12_jurnaldetail`
--

CREATE TABLE `t12_jurnaldetail` (
  `id` int(11) NOT NULL,
  `jurnalmaster_id` int(11) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t85_neraca2`
--

CREATE TABLE `t85_neraca2` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL,
  `field04` varchar(24) DEFAULT NULL,
  `field05` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t85_neraca2`
--

INSERT INTO `t85_neraca2` (`field01`, `field02`, `field03`, `field04`, `field05`) VALUES
('', '', 'Desember 2018', 'Januari 2019', ''),
('<strong>AKTIVA</strong>', '', '', '', ''),
('1.1001', 'KAS BANK - BCA', '0.00', '0.00', '0.00'),
('1.1002', 'KAS BANK - MANDIRI', '0.00', '0.00', '0.00'),
('1.1003', 'KAS BANK - BCA SURABAYA', '-10,357,000.00', '1,100,000.00', '-9,257,000.00'),
('1.1004', 'KAS BESAR', '0.00', '0.00', '0.00'),
('1.1005', 'KAS KECIL HARIAN', '0.00', '0.00', '0.00'),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00', '0.00', '0.00'),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00', '0.00', '0.00'),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '10,400,000.00', '-867,000.00', '9,533,000.00'),
('1.2004', 'PIUTANG SIDOARJO', '0.00', '0.00', '0.00'),
('1.2005', 'PIUTANG KPL 5', '0.00', '0.00', '0.00'),
('1.2006', 'PIUTANG TROSOBO', '0.00', '0.00', '0.00'),
('1.2007', 'PIUTANG DANIEL', '0.00', '0.00', '0.00'),
('1.2008', 'PIUTANG ANDIK', '0.00', '0.00', '0.00'),
('1.3000', 'PERSEDIAAN KANTOR', '0.00', '0.00', '0.00'),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00', '0.00', '0.00'),
('', '', '<strong>43,000.00</stron', '<strong>233,000.00</stro', '<strong>276,000.00</stro'),
('', '', '', '', ''),
('<strong>PASSIVA</strong>', '', '', '', ''),
('2.1000', 'HUTANG PAJAJARAN', '0.00', '0.00', '0.00'),
('2.2000', 'HUTANG DANIEL', '0.00', '0.00', '0.00'),
('2.3000', 'TITIPAN NASABAH', '0.00', '0.00', '0.00'),
('2.4000', 'MODAL DISETOR', '0.00', '0.00', '0.00'),
('2.5000', 'SHU TAHUN LALU', '0.00', '0.00', '0.00'),
('2.6000', 'SHU TAHUN', '0.00', '0.00', '0.00'),
('2.7000', 'PEMBAGIAN SHU TAHUN', '0.00', '0.00', '0.00'),
('2.8000', 'SHU TAHUN BERJALAN', '0.00', '0.00', '0.00'),
('2.9000', 'SHU BULAN BERJALAN', '43,000.00', '233,000.00', '276,000.00'),
('', '', '<strong>43,000.00</stron', '<strong>233,000.00</stro', '<strong>276,000.00</stro'),
('', '', '', '', ''),
('', '', '<strong>0.00</strong>', '<strong>0.00</strong>', '<strong>0.00</strong>');

-- --------------------------------------------------------

--
-- Table structure for table `t86_labarugi2`
--

CREATE TABLE `t86_labarugi2` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL,
  `field04` varchar(24) DEFAULT NULL,
  `field05` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t86_labarugi2`
--

INSERT INTO `t86_labarugi2` (`field01`, `field02`, `field03`, `field04`, `field05`) VALUES
('', '', 'Januari 2019', 'Februari 2019', ''),
('<strong>PENDAPATAN</strong>', '', '', '', ''),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '233,000.00', '466,000.00', '699,000.00'),
('<strong>PENDAPATAN LAIN</strong>', '', '', '', ''),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '0.00', '0.00', '0.00'),
('5.2000', 'PENDAPATAN BUNGA BANK', '0.00', '0.00', '0.00'),
('5.3000', 'PENDAPATAN DENDA', '0.00', '0.00', '0.00'),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '0.00', '0.00', '0.00'),
('', '', '<strong>233,000.00</stro', '<strong>466,000.00</stro', '<strong>699,000.00</stro'),
('', '', '', '', ''),
('<strong>BIAYA</strong>', '', '', '', ''),
('4.1000', 'BIAYA KARYAWAN', '0.00', '0.00', '0.00'),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '0.00', '0.00', '0.00'),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '0.00', '0.00', '0.00'),
('4.4000', 'BIAYA ADMINISTRASI BANK', '0.00', '0.00', '0.00'),
('4.5000', 'BIAYA PENYUSUTAN', '0.00', '0.00', '0.00'),
('4.6000', 'BIAYA IKLAN', '0.00', '0.00', '0.00'),
('4.7000', 'POTONGAN', '0.00', '0.00', '0.00'),
('<strong>BIAYA LAIN</strong>', '', '', '', ''),
('6.1000', 'BIAYA LAIN-LAIN', '0.00', '0.00', '0.00'),
('', '', '<strong>0.00</strong>', '<strong>0.00</strong>', '<strong>0.00</strong>'),
('', '', '', '', ''),
('', '', '<strong>233,000.00</stro', '<strong>466,000.00</stro', '<strong>699,000.00</stro');

-- --------------------------------------------------------

--
-- Table structure for table `t87_neraca`
--

CREATE TABLE `t87_neraca` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t87_neraca`
--

INSERT INTO `t87_neraca` (`field01`, `field02`, `field03`) VALUES
('', '', 'Desember 2018'),
('<strong>AKTIVA</strong>', '', ''),
('1.1001', 'KAS BANK - BCA', '0.00'),
('1.1002', 'KAS BANK - MANDIRI', '0.00'),
('1.1003', 'KAS BANK - BCA SURABAYA', '-10,357,000.00'),
('1.1004', 'KAS BESAR', '0.00'),
('1.1005', 'KAS KECIL HARIAN', '0.00'),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00'),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00'),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '10,400,000.00'),
('1.2004', 'PIUTANG SIDOARJO', '0.00'),
('1.2005', 'PIUTANG KPL 5', '0.00'),
('1.2006', 'PIUTANG TROSOBO', '0.00'),
('1.2007', 'PIUTANG DANIEL', '0.00'),
('1.2008', 'PIUTANG ANDIK', '0.00'),
('1.3000', 'PERSEDIAAN KANTOR', '0.00'),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00'),
('', '', '<strong>43,000.00</stron'),
('', '', ''),
('<strong>PASSIVA</strong>', '', ''),
('2.1000', 'HUTANG PAJAJARAN', '0.00'),
('2.2000', 'HUTANG DANIEL', '0.00'),
('2.3000', 'TITIPAN NASABAH', '0.00'),
('2.4000', 'MODAL DISETOR', '0.00'),
('2.5000', 'SHU TAHUN LALU', '0.00'),
('2.6000', 'SHU TAHUN', '0.00'),
('2.7000', 'PEMBAGIAN SHU TAHUN', '0.00'),
('2.8000', 'SHU TAHUN BERJALAN', '0.00'),
('2.9000', 'SHU BULAN BERJALAN', '43,000.00'),
('', '', '<strong>43,000.00</stron'),
('', '', ''),
('', '', '<strong>0.00</strong>');

-- --------------------------------------------------------

--
-- Table structure for table `t88_labarugi`
--

CREATE TABLE `t88_labarugi` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t88_labarugi`
--

INSERT INTO `t88_labarugi` (`field01`, `field02`, `field03`) VALUES
('', '', 'Desember 2018'),
('<strong>PENDAPATAN</strong>', '', ''),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '0.00'),
('<strong>PENDAPATAN LAIN</strong>', '', ''),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '25,000.00'),
('5.2000', 'PENDAPATAN BUNGA BANK', '0.00'),
('5.3000', 'PENDAPATAN DENDA', '0.00'),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '18,000.00'),
('', '', '<strong>43,000.00</stron'),
('', '', ''),
('<strong>BIAYA</strong>', '', ''),
('4.1000', 'BIAYA KARYAWAN', '0.00'),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '0.00'),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '0.00'),
('4.4000', 'BIAYA ADMINISTRASI BANK', '0.00'),
('4.5000', 'BIAYA PENYUSUTAN', '0.00'),
('4.6000', 'BIAYA IKLAN', '0.00'),
('4.7000', 'POTONGAN', '0.00'),
('<strong>BIAYA LAIN</strong>', '', ''),
('6.1000', 'BIAYA LAIN-LAIN', '0.00'),
('', '', '<strong>0.00</strong>'),
('', '', ''),
('', '', '<strong>43,000.00</stron');

-- --------------------------------------------------------

--
-- Table structure for table `t89_rektran`
--

CREATE TABLE `t89_rektran` (
  `id` int(11) NOT NULL,
  `KodeTransaksi` varchar(2) NOT NULL,
  `JenisTransaksi` varchar(255) NOT NULL,
  `DebetRekening` varchar(35) NOT NULL,
  `KreditRekening` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t89_rektran`
--

INSERT INTO `t89_rektran` (`id`, `KodeTransaksi`, `JenisTransaksi`, `DebetRekening`, `KreditRekening`) VALUES
(1, '01', 'Pinjaman Disetujui, Nilai Pinjaman', '1.2003', '1.1003'),
(2, '02', 'Pinjaman Disetujui, Nilai Administrasi', '1.1003', '5.1000'),
(3, '03', 'Pinjaman Disetujui, Nilai Materai', '1.1003', '5.4000'),
(4, '04', 'Pembayaran Angsuran, Angsuran Pokok', '1.1003', '1.2003'),
(5, '05', 'Pembayaran Angsuran, Angsuran Bunga', '1.1003', '3.1000'),
(6, '06', 'Pembayaran Angsuran, Angsuran Denda', '1.1003', '5.3000'),
(7, '07', 'Pembayaran Angsuran, Titipan Masuk', '1.1003', '2.3000'),
(8, '08', 'Pembayaran Angsuran, Titipan Keluar', '2.3000', '1.1003'),
(9, '09', 'Biaya-Biaya, Biaya Karyawan', '4.1000', '1.1003'),
(10, '10', 'Potongan', '4.7000', '1.1003'),
(11, '11', 'SHU Bulan Berjalan', '2.9000', '2.9000'),
(12, '12', 'Nasabah Macet', '1.2003', '1.2002');

-- --------------------------------------------------------

--
-- Table structure for table `t90_rektran`
--

CREATE TABLE `t90_rektran` (
  `id` int(11) NOT NULL,
  `KodeTransaksi` varchar(35) NOT NULL,
  `NamaTransaksi` varchar(100) NOT NULL,
  `KodeRekening` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t90_rektran`
--

INSERT INTO `t90_rektran` (`id`, `KodeTransaksi`, `NamaTransaksi`, `KodeRekening`) VALUES
(1, '01', 'Pembayaran Angsuran', '1.2003'),
(2, '02', 'Pendapatan Bunga', '3.1000'),
(3, '03', 'Pendapatan Denda', '5.3000'),
(4, '04', 'Titipan Keluar', '2.3000'),
(5, '05', 'Titipan Masuk', '2.3000'),
(6, '06', 'Pendapatan Administrasi', '5.1000'),
(7, '07', 'Pendapatan Asuransi', '5.1000'),
(8, '08', 'Pendapatan Notaris', '5.1000'),
(9, '09', 'Pendapatan Materai', '5.1000'),
(10, '10', 'Pinjaman Angsuran & Berjangka', '1.2003'),
(11, '11', 'SHU Bulan Berjalan', '2.9000'),
(12, '12', 'SHU Tahun Berjalan', '2.8000'),
(13, '00', 'Kas', '1.1001');

-- --------------------------------------------------------

--
-- Table structure for table `t91_rekening`
--

CREATE TABLE `t91_rekening` (
  `group` bigint(20) DEFAULT '0',
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext,
  `active` enum('yes','no') DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t91_rekening`
--

INSERT INTO `t91_rekening` (`group`, `id`, `rekening`, `tipe`, `posisi`, `laporan`, `status`, `parent`, `keterangan`, `active`) VALUES
(1, '1', 'AKTIVA', 'GROUP', 'DEBET', 'NERACA', '', '', '', 'yes'),
(1, '1.1000', 'KAS', 'HEADER', 'DEBET', 'NERACA', NULL, '1', NULL, 'yes'),
(1, '1.1001', 'KAS BANK - BCA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.1002', 'KAS BANK - MANDIRI', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.1003', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.1004', 'KAS BESAR', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.1005', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2004', 'PIUTANG SIDOARJO', 'DETAIL', 'DEBET', 'NERACA', NULL, '1.2000', NULL, 'yes'),
(1, '1.2005', 'PIUTANG KPL 5', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2006', 'PIUTANG TROSOBO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2007', 'PIUTANG DANIEL', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2008', 'PIUTANG ANDIK', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.3000', 'PERSEDIAAN KANTOR', 'DETAIL', 'DEBET', 'NERACA', NULL, '1', NULL, 'yes'),
(1, '1.4000', 'AKUMULASI PENYUSUTAN', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes'),
(2, '2', 'PASSIVA', 'GROUP', 'CREDIT', 'NERACA', '', '', '', 'yes'),
(2, '2.1000', 'HUTANG PAJAJARAN', 'DETAIL', 'CREDIT', 'NERACA', NULL, '2', NULL, 'yes'),
(2, '2.2000', 'HUTANG DANIEL', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.3000', 'TITIPAN NASABAH', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.4000', 'MODAL DISETOR', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.5000', 'SHU TAHUN LALU', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.6000', 'SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.7000', 'PEMBAGIAN SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.8000', 'SHU TAHUN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
(3, '3', 'PENDAPATAN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes'),
(3, '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '3', '', 'yes'),
(4, '4', 'BIAYA', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes'),
(4, '4.1000', 'BIAYA KARYAWAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.2000', 'BIAYA PERKANTORAN & UMUM', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.3000', 'BIAYA KOMISI MAKELAR / FEE', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.4000', 'BIAYA ADMINISTRASI BANK', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.5000', 'BIAYA PENYUSUTAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.6000', 'BIAYA IKLAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(4, '4.7000', 'POTONGAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes'),
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', NULL, '5', NULL, 'yes'),
(6, '6', 'BIAYA LAIN', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes'),
(6, '6.1000', 'BIAYA LAIN-LAIN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '6', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `t92_periodeold`
--

CREATE TABLE `t92_periodeold` (
  `id` int(11) NOT NULL,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t92_periodeold`
--

INSERT INTO `t92_periodeold` (`id`, `Bulan`, `Tahun`, `Tahun_Bulan`) VALUES
(1, 12, 2018, '201812'),
(2, 1, 2019, '201901');

-- --------------------------------------------------------

--
-- Table structure for table `t93_periode`
--

CREATE TABLE `t93_periode` (
  `id` int(11) NOT NULL,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t93_periode`
--

INSERT INTO `t93_periode` (`id`, `Bulan`, `Tahun`, `Tahun_Bulan`) VALUES
(1, 2, 2019, '201902');

-- --------------------------------------------------------

--
-- Table structure for table `t94_log`
--

CREATE TABLE `t94_log` (
  `id` int(11) NOT NULL,
  `index_` tinyint(4) NOT NULL,
  `subj_` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t94_log`
--

INSERT INTO `t94_log` (`id`, `index_`, `subj_`) VALUES
(1, 1, 'application'),
(2, 2, 'pinjaman'),
(4, 3, 'pinjaman - angsuran'),
(6, 4, 'pinjaman - titipan'),
(8, 0, 'last update'),
(9, 5, 'tutup buku'),
(10, 6, 'list - pinjaman'),
(11, 7, 'list - activity log'),
(12, 8, 'setup - nasabah'),
(13, 9, 'setup - marketing'),
(14, 10, 'setup - periode'),
(15, 11, 'setup - users'),
(16, 12, 'setup - hak akses');

-- --------------------------------------------------------

--
-- Table structure for table `t95_logdesc`
--

CREATE TABLE `t95_logdesc` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `desc_` text NOT NULL,
  `date_solved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t95_logdesc`
--

INSERT INTO `t95_logdesc` (`id`, `log_id`, `date_issued`, `desc_`, `date_solved`) VALUES
(1, 1, '2018-10-04', 'hilangkan menu SETUP - NASABAH', '2018-10-04'),
(2, 1, '2018-10-04', 'buat modul CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm', '2018-10-04'),
(3, 2, '2018-10-04', 'tipe data NOMOR REFERENSI diubah dari integer menjadi varchar', '2018-10-17'),
(5, 4, '2018-10-04', 'check :: jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN', '2018-10-04'),
(7, 6, '2018-10-04', 'setelah input setoran TITIPAN :: harus save dulu agar jumlah saldo TITIPAN terupdate', '2018-11-08'),
(8, 4, '2018-10-18', 'otomatis tampil JUMLAH di semua kolom, JUMLAH : TERLAMBAT, DENDA, BAYAR TITIPAN, dan seterusnya', '2018-11-08'),
(9, 4, '2018-10-18', 'jumlah TITIPAN langsung tampil bila nasabah memiliki SALDO TITIPAN', '2018-11-08'),
(10, 4, '2018-10-18', 'nilai TERLAMBAT dan DENDA otomatis rumus, TANGGAL BAYAR dikurangi TANGGAL JATUH TEMPO', '2018-11-08'),
(11, 4, '2018-10-18', 'read only baris record ANGSURAN, hanya dibuka 1 record saja, yg mana yg akan diproses datanya', '2018-10-29'),
(12, 1, '2018-10-29', 'buat modul SETUP - PERIODE', '2018-10-29'),
(13, 1, '2018-10-29', 'buat modul TUTUP BUKU (BULANAN)', NULL),
(16, 8, '2018-11-08', 'sampai dengan update ke tabel titipan jika sudah ada pemakaian saldo titipan', '2018-11-08'),
(17, 2, '2018-11-08', 'potongan', '2018-11-08'),
(18, 15, '2018-11-09', 'definisikan perbedaan hak akses', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}cf01_home.php', 8),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t01_nasabah', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t02_jaminan', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t03_pinjaman', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t04_pinjamanangsuran', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t05_pinjamanjaminan', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t06_pinjamantitipan', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t94_log', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t95_logdesc', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t96_employees', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t97_userlevels', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t98_userlevelpermissions', 0),
(-2, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t99_audittrail', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php', 8),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t02_jaminan', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsuran', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsurantemp', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t05_pinjamanjaminan', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t06_pinjamantitipan', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t08_pinjamanpotongan', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t92_periodeold', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t94_log', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t95_logdesc', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t97_userlevels', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t98_userlevelpermissions', 0),
(-2, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}cf01_home.php', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t01_nasabah', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t02_jaminan', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t03_pinjaman', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t04_pinjamanangsuran', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t05_pinjamanjaminan', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t06_pinjamantitipan', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t94_log', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t95_logdesc', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t96_employees', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t97_userlevels', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t98_userlevelpermissions', 0),
(0, '{1F4EE816-E057-4A7E-9024-5EA4446B7598}t99_audittrail', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t02_jaminan', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsuran', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsurantemp', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t05_pinjamanjaminan', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t06_pinjamantitipan', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t08_pinjamanpotongan', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t92_periodeold', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t94_log', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t95_logdesc', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t97_userlevels', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t98_userlevelpermissions', 0),
(0, '{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2019-02-04 10:33:09', '/simkop5/t93_periodeadd.php', '1', 'A', 't93_periode', 'Bulan', '1', '', '12'),
(2, '2019-02-04 10:33:09', '/simkop5/t93_periodeadd.php', '1', 'A', 't93_periode', 'Tahun', '1', '', '2018'),
(3, '2019-02-04 10:33:09', '/simkop5/t93_periodeadd.php', '1', 'A', 't93_periode', 'Tahun_Bulan', '1', '', '201812'),
(4, '2019-02-04 10:33:09', '/simkop5/t93_periodeadd.php', '1', 'A', 't93_periode', 'id', '1', '', '1'),
(5, '2019-02-04 10:34:47', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Nama', '1', '', 'Adi'),
(6, '2019-02-04 10:34:47', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Alamat', '1', '', 'Surabaya'),
(7, '2019-02-04 10:34:47', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'NoHP', '1', '', '081232047762'),
(8, '2019-02-04 10:34:47', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'id', '1', '', '1'),
(9, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '1', '', 'Dodo Ananto'),
(10, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '1', '', 'Krian'),
(11, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '1', '', '08113422516'),
(12, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '1', '', 'Swasta'),
(13, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '1', '', 'Perak'),
(14, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '1', '', '0313503589'),
(15, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '1', '', '0'),
(16, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '1', '', NULL),
(17, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '1', '', '1'),
(18, '2019-02-04 10:35:37', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '1', '', '1'),
(19, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(20, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '1', '', '1'),
(21, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '1', '', 'ATM'),
(22, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '1', '', NULL),
(23, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '1', '', NULL),
(24, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '1', '', NULL),
(25, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '1', '', NULL),
(26, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '1', '', NULL),
(27, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '1', '', NULL),
(28, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '1', '', '1'),
(29, '2019-02-04 10:35:38', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(30, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '60001'),
(31, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-04'),
(32, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(33, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '1'),
(34, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(35, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(36, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(37, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(38, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(39, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(40, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(41, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(42, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(43, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '25000'),
(44, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '18000'),
(45, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(46, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(47, '2019-02-04 12:11:06', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(48, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-04'),
(49, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(50, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(51, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '0'),
(52, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '1100000'),
(53, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(54, '2019-02-04 12:51:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201901'),
(55, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', NULL, '2019-02-04'),
(56, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '2', NULL, '0'),
(57, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '2', NULL, '0'),
(58, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '2', NULL, '0'),
(59, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '2', NULL, '1100000'),
(60, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '2', NULL, '1100000'),
(61, '2019-02-04 14:51:33', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '2', NULL, '201902'),
(62, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '3', NULL, '2019-02-04'),
(63, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '3', NULL, '-28'),
(64, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '3', NULL, '0'),
(65, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '3', NULL, '0'),
(66, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '3', NULL, '1100000'),
(67, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '3', NULL, '1100000'),
(68, '2019-02-04 14:51:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '3', NULL, '201902'),
(69, '2019-02-05 09:27:47', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(70, '2019-02-06 10:54:42', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(71, '2019-02-07 10:27:06', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(72, '2019-02-07 12:57:31', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(73, '2019-02-08 13:26:36', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(74, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '60002'),
(75, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2019-02-08'),
(76, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '1'),
(77, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '1'),
(78, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '16000000'),
(79, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '12'),
(80, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.25'),
(81, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(82, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '3'),
(83, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '1333333.3333333333'),
(84, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '360000'),
(85, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '1693333.3333333333'),
(86, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', NULL),
(87, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '0'),
(88, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '0'),
(89, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '1'),
(90, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201902'),
(91, '2019-02-08 13:27:03', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(92, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete begin ***', 't03_pinjaman', '', '', '', ''),
(93, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '13', '13', ''),
(94, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '13', '2', ''),
(95, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '13', '1', ''),
(96, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '13', '2019-03-08', ''),
(97, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '13', '1333333.38', ''),
(98, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '13', '360000.00', ''),
(99, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '13', '1693333.38', ''),
(100, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '13', '14666667.00', ''),
(101, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '13', NULL, ''),
(102, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '13', NULL, ''),
(103, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '13', NULL, ''),
(104, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '13', NULL, ''),
(105, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '13', NULL, ''),
(106, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '13', NULL, ''),
(107, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '13', NULL, ''),
(108, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '13', NULL, ''),
(109, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '14', '14', ''),
(110, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '14', '2', ''),
(111, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '14', '2', ''),
(112, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '14', '2019-04-08', ''),
(113, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '14', '1333333.38', ''),
(114, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '14', '360000.00', ''),
(115, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '14', '1693333.38', ''),
(116, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '14', '13333333.00', ''),
(117, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '14', NULL, ''),
(118, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '14', NULL, ''),
(119, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '14', NULL, ''),
(120, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '14', NULL, ''),
(121, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '14', NULL, ''),
(122, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '14', NULL, ''),
(123, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '14', NULL, ''),
(124, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '14', NULL, ''),
(125, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '15', '15', ''),
(126, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '15', '2', ''),
(127, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '15', '3', ''),
(128, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '15', '2019-05-08', ''),
(129, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '15', '1333333.38', ''),
(130, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '15', '360000.00', ''),
(131, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '15', '1693333.38', ''),
(132, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '15', '12000000.00', ''),
(133, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '15', NULL, ''),
(134, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '15', NULL, ''),
(135, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '15', NULL, ''),
(136, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '15', NULL, ''),
(137, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '15', NULL, ''),
(138, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '15', NULL, ''),
(139, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '15', NULL, ''),
(140, '2019-02-08 13:27:19', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '15', NULL, ''),
(141, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '16', '16', ''),
(142, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '16', '2', ''),
(143, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '16', '4', ''),
(144, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '16', '2019-06-08', ''),
(145, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '16', '1333333.38', ''),
(146, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '16', '360000.00', ''),
(147, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '16', '1693333.38', ''),
(148, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '16', '10666667.00', ''),
(149, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '16', NULL, ''),
(150, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '16', NULL, ''),
(151, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '16', NULL, ''),
(152, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '16', NULL, ''),
(153, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '16', NULL, ''),
(154, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '16', NULL, ''),
(155, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '16', NULL, ''),
(156, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '16', NULL, ''),
(157, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '17', '17', ''),
(158, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '17', '2', ''),
(159, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '17', '5', ''),
(160, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '17', '2019-07-08', ''),
(161, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '17', '1333333.38', ''),
(162, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '17', '360000.00', ''),
(163, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '17', '1693333.38', ''),
(164, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '17', '9333333.00', ''),
(165, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '17', NULL, ''),
(166, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '17', NULL, ''),
(167, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '17', NULL, ''),
(168, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '17', NULL, ''),
(169, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '17', NULL, ''),
(170, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '17', NULL, ''),
(171, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '17', NULL, ''),
(172, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '17', NULL, ''),
(173, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '18', '18', ''),
(174, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '18', '2', ''),
(175, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '18', '6', ''),
(176, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '18', '2019-08-08', ''),
(177, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '18', '1333333.38', ''),
(178, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '18', '360000.00', ''),
(179, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '18', '1693333.38', ''),
(180, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '18', '8000000.00', ''),
(181, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '18', NULL, ''),
(182, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '18', NULL, ''),
(183, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '18', NULL, ''),
(184, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '18', NULL, ''),
(185, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '18', NULL, ''),
(186, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '18', NULL, ''),
(187, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '18', NULL, ''),
(188, '2019-02-08 13:27:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '18', NULL, ''),
(189, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '19', '19', ''),
(190, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '19', '2', ''),
(191, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '19', '7', ''),
(192, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '19', '2019-09-08', ''),
(193, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '19', '1333333.38', ''),
(194, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '19', '360000.00', ''),
(195, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '19', '1693333.38', ''),
(196, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '19', '6666666.50', ''),
(197, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '19', NULL, ''),
(198, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '19', NULL, ''),
(199, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '19', NULL, ''),
(200, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '19', NULL, ''),
(201, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '19', NULL, ''),
(202, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '19', NULL, ''),
(203, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '19', NULL, ''),
(204, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '19', NULL, ''),
(205, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '20', '20', ''),
(206, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '20', '2', ''),
(207, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '20', '8', ''),
(208, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '20', '2019-10-08', ''),
(209, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '20', '1333333.38', ''),
(210, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '20', '360000.00', ''),
(211, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '20', '1693333.38', ''),
(212, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '20', '5333333.50', ''),
(213, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '20', NULL, ''),
(214, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '20', NULL, ''),
(215, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '20', NULL, ''),
(216, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '20', NULL, ''),
(217, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '20', NULL, ''),
(218, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '20', NULL, ''),
(219, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '20', NULL, ''),
(220, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '20', NULL, ''),
(221, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '21', '21', ''),
(222, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '21', '2', ''),
(223, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '21', '9', ''),
(224, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '21', '2019-11-08', ''),
(225, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '21', '1333333.38', ''),
(226, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '21', '360000.00', ''),
(227, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '21', '1693333.38', ''),
(228, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '21', '4000000.00', ''),
(229, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '21', NULL, ''),
(230, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '21', NULL, ''),
(231, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '21', NULL, ''),
(232, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '21', NULL, ''),
(233, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '21', NULL, ''),
(234, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '21', NULL, ''),
(235, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '21', NULL, ''),
(236, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '21', NULL, ''),
(237, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '22', '22', ''),
(238, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '22', '2', ''),
(239, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '22', '10', ''),
(240, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '22', '2019-12-08', ''),
(241, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '22', '1333333.38', ''),
(242, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '22', '360000.00', ''),
(243, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '22', '1693333.38', ''),
(244, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '22', '2666666.75', ''),
(245, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '22', NULL, ''),
(246, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '22', NULL, ''),
(247, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '22', NULL, ''),
(248, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '22', NULL, ''),
(249, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '22', NULL, ''),
(250, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '22', NULL, ''),
(251, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '22', NULL, ''),
(252, '2019-02-08 13:27:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '22', NULL, ''),
(253, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '23', '23', ''),
(254, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '23', '2', ''),
(255, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '23', '11', ''),
(256, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '23', '2020-01-08', ''),
(257, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '23', '1333333.38', ''),
(258, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '23', '360000.00', ''),
(259, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '23', '1693333.38', ''),
(260, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '23', '1333333.38', ''),
(261, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '23', NULL, ''),
(262, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '23', NULL, ''),
(263, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '23', NULL, ''),
(264, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '23', NULL, ''),
(265, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '23', NULL, ''),
(266, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '23', NULL, ''),
(267, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '23', NULL, ''),
(268, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '23', NULL, ''),
(269, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '24', '24', ''),
(270, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '24', '2', ''),
(271, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '24', '12', ''),
(272, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '24', '2020-02-08', ''),
(273, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '24', '1333333.38', ''),
(274, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '24', '360000.00', ''),
(275, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '24', '1693333.38', ''),
(276, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '24', '0.00', ''),
(277, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '24', NULL, ''),
(278, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '24', NULL, ''),
(279, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '24', NULL, ''),
(280, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '24', NULL, ''),
(281, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '24', NULL, ''),
(282, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '24', NULL, ''),
(283, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '24', NULL, ''),
(284, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '24', NULL, ''),
(285, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'id', '2', '2', ''),
(286, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_No', '2', '60002', ''),
(287, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_Tgl', '2', '2019-02-08', ''),
(288, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'nasabah_id', '2', '1', ''),
(289, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'jaminan_id', '2', '1', ''),
(290, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Pinjaman', '2', '16000000.00', ''),
(291, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Lama', '2', '12', ''),
(292, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '2.25', ''),
(293, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Denda', '2', '0.40', ''),
(294, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Dispensasi_Denda', '2', '3', ''),
(295, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Pokok', '2', '1333333.38', ''),
(296, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga', '2', '360000.00', ''),
(297, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Total', '2', '1693333.38', ''),
(298, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'No_Ref', '2', NULL, ''),
(299, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Administrasi', '2', '0.00', ''),
(300, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Materai', '2', '0.00', ''),
(301, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'marketing_id', '2', '1', ''),
(302, '2019-02-08 13:27:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Periode', '2', '201902', ''),
(303, '2019-02-08 13:27:23', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete successful ***', 't03_pinjaman', '', '', '', ''),
(304, '2019-02-09 11:58:58', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(305, '2019-02-09 14:26:29', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(306, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '4', NULL, '2019-04-09'),
(307, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '4', NULL, '5'),
(308, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '4', NULL, '0'),
(309, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '4', NULL, '0'),
(310, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '4', NULL, '1100000'),
(311, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '4', NULL, '1100000'),
(312, '2019-02-09 14:26:48', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '4', NULL, '201902'),
(313, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '5', NULL, '2019-05-10'),
(314, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '5', NULL, '6'),
(315, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '5', NULL, '0'),
(316, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '5', NULL, '0'),
(317, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '5', NULL, '1100000'),
(318, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '5', NULL, '1100000'),
(319, '2019-02-09 14:32:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '5', NULL, '201902'),
(320, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '6', NULL, '2019-06-09'),
(321, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '6', NULL, '5'),
(322, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '6', NULL, '22000'),
(323, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '6', NULL, '0'),
(324, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '6', NULL, '1100000'),
(325, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '6', NULL, '1122000'),
(326, '2019-02-09 14:39:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '6', NULL, '201902'),
(327, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '7', NULL, '2019-07-09'),
(328, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '7', NULL, '5'),
(329, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '7', NULL, '0'),
(330, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '7', NULL, '0'),
(331, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '7', NULL, '1100000'),
(332, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '7', NULL, '1100000'),
(333, '2019-02-09 14:39:18', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '7', NULL, '201902'),
(334, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '8', NULL, '2019-08-09'),
(335, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '8', NULL, '5'),
(336, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '8', NULL, '0'),
(337, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '8', NULL, '0'),
(338, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '8', NULL, '1100000'),
(339, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '8', NULL, '1100000'),
(340, '2019-02-09 14:44:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '8', NULL, '201902'),
(341, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '9', NULL, '2019-09-09'),
(342, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '9', NULL, '5'),
(343, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '9', NULL, '0'),
(344, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '9', NULL, '0'),
(345, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '9', NULL, '1100000'),
(346, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '9', NULL, '1100000'),
(347, '2019-02-09 17:38:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '9', NULL, '201902'),
(348, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '10', NULL, '2019-10-09'),
(349, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '10', NULL, '5'),
(350, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '10', NULL, '0'),
(351, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '10', NULL, '0'),
(352, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '10', NULL, '1100000'),
(353, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '10', NULL, '1100000'),
(354, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '10', NULL, '22000'),
(355, '2019-02-09 18:13:29', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '10', NULL, '201902'),
(356, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '11', NULL, '2019-11-09'),
(357, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '11', NULL, '5'),
(358, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '11', NULL, '0'),
(359, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '11', NULL, '0'),
(360, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '11', NULL, '1100000'),
(361, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '11', NULL, '1100000'),
(362, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '11', NULL, 'Denda Rp. 22,000.00'),
(363, '2019-02-09 18:15:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '11', NULL, '201902'),
(364, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '12', NULL, '2019-12-09'),
(365, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '12', NULL, '5'),
(366, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '12', NULL, '0'),
(367, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '12', NULL, '0'),
(368, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '12', NULL, '1100000'),
(369, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '12', NULL, '1100000'),
(370, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '12', NULL, 'Denda Rp. 22,000.00'),
(371, '2019-02-09 20:05:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '12', NULL, '201912'),
(372, '2019-02-09 21:00:09', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(373, '2019-02-09 21:39:00', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(374, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '60002'),
(375, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2019-02-10'),
(376, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '1');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(377, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '1'),
(378, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '16000000'),
(379, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '12'),
(380, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.25'),
(381, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(382, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '3'),
(383, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '1333333.3333333333'),
(384, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '360000'),
(385, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '1693333.3333333333'),
(386, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', NULL),
(387, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '0'),
(388, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '0'),
(389, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '1'),
(390, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201902'),
(391, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(392, '2019-02-15 10:51:59', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(393, '2019-02-15 11:31:34', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(394, '2019-02-15 11:31:41', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(395, '2019-02-18 08:00:57', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(396, '2019-02-18 08:53:39', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '12', '', '12'),
(397, '2019-02-18 08:53:39', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '12', '', 'Nasabah Macet'),
(398, '2019-02-18 08:53:39', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '12', '', '1.2003'),
(399, '2019-02-18 08:53:39', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '12', '', '1.2002'),
(400, '2019-02-18 08:53:39', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '12', '', '12'),
(401, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '3', '', '60003'),
(402, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '3', '', '2019-02-18'),
(403, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '3', '', '1'),
(404, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '3', '', '1'),
(405, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '3', '', '17000000'),
(406, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '3', '', '12'),
(407, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '', '2.25'),
(408, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '3', '', '0.40'),
(409, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '3', '', '3'),
(410, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '3', '', '1416666.6666666667'),
(411, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '3', '', '382500'),
(412, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '3', '', '1799166.6666666667'),
(413, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '3', '', NULL),
(414, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '3', '', '0.00'),
(415, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '3', '', '0.00'),
(416, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '3', '', '1'),
(417, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Macet', '3', '', 'N'),
(418, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '3', '', '201902'),
(419, '2019-02-18 12:01:13', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '3', '', '3'),
(420, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete begin ***', 't03_pinjaman', '', '', '', ''),
(421, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '25', '25', ''),
(422, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '25', '3', ''),
(423, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '25', '1', ''),
(424, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '25', '2019-03-18', ''),
(425, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '25', '1416666.62', ''),
(426, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '25', '382500.00', ''),
(427, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '25', '1799166.62', ''),
(428, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '25', '15583333.00', ''),
(429, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '25', NULL, ''),
(430, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '25', NULL, ''),
(431, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '25', NULL, ''),
(432, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '25', NULL, ''),
(433, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '25', NULL, ''),
(434, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '25', NULL, ''),
(435, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '25', NULL, ''),
(436, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '25', NULL, ''),
(437, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '26', '26', ''),
(438, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '26', '3', ''),
(439, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '26', '2', ''),
(440, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '26', '2019-04-18', ''),
(441, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '26', '1416666.62', ''),
(442, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '26', '382500.00', ''),
(443, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '26', '1799166.62', ''),
(444, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '26', '14166667.00', ''),
(445, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '26', NULL, ''),
(446, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '26', NULL, ''),
(447, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '26', NULL, ''),
(448, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '26', NULL, ''),
(449, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '26', NULL, ''),
(450, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '26', NULL, ''),
(451, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '26', NULL, ''),
(452, '2019-02-18 12:13:20', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '26', NULL, ''),
(453, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '27', '27', ''),
(454, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '27', '3', ''),
(455, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '27', '3', ''),
(456, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '27', '2019-05-18', ''),
(457, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '27', '1416666.62', ''),
(458, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '27', '382500.00', ''),
(459, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '27', '1799166.62', ''),
(460, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '27', '12750000.00', ''),
(461, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '27', NULL, ''),
(462, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '27', NULL, ''),
(463, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '27', NULL, ''),
(464, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '27', NULL, ''),
(465, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '27', NULL, ''),
(466, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '27', NULL, ''),
(467, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '27', NULL, ''),
(468, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '27', NULL, ''),
(469, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '28', '28', ''),
(470, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '28', '3', ''),
(471, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '28', '4', ''),
(472, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '28', '2019-06-18', ''),
(473, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '28', '1416666.62', ''),
(474, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '28', '382500.00', ''),
(475, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '28', '1799166.62', ''),
(476, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '28', '11333333.00', ''),
(477, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '28', NULL, ''),
(478, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '28', NULL, ''),
(479, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '28', NULL, ''),
(480, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '28', NULL, ''),
(481, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '28', NULL, ''),
(482, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '28', NULL, ''),
(483, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '28', NULL, ''),
(484, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '28', NULL, ''),
(485, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '29', '29', ''),
(486, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '29', '3', ''),
(487, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '29', '5', ''),
(488, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '29', '2019-07-18', ''),
(489, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '29', '1416666.62', ''),
(490, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '29', '382500.00', ''),
(491, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '29', '1799166.62', ''),
(492, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '29', '9916667.00', ''),
(493, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '29', NULL, ''),
(494, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '29', NULL, ''),
(495, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '29', NULL, ''),
(496, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '29', NULL, ''),
(497, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '29', NULL, ''),
(498, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '29', NULL, ''),
(499, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '29', NULL, ''),
(500, '2019-02-18 12:13:21', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '29', NULL, ''),
(501, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '30', '30', ''),
(502, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '30', '3', ''),
(503, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '30', '6', ''),
(504, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '30', '2019-08-18', ''),
(505, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '30', '1416666.62', ''),
(506, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '30', '382500.00', ''),
(507, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '30', '1799166.62', ''),
(508, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '30', '8500000.00', ''),
(509, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '30', NULL, ''),
(510, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '30', NULL, ''),
(511, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '30', NULL, ''),
(512, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '30', NULL, ''),
(513, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '30', NULL, ''),
(514, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '30', NULL, ''),
(515, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '30', NULL, ''),
(516, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '30', NULL, ''),
(517, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '31', '31', ''),
(518, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '31', '3', ''),
(519, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '31', '7', ''),
(520, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '31', '2019-09-18', ''),
(521, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '31', '1416666.62', ''),
(522, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '31', '382500.00', ''),
(523, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '31', '1799166.62', ''),
(524, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '31', '7083333.50', ''),
(525, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '31', NULL, ''),
(526, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '31', NULL, ''),
(527, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '31', NULL, ''),
(528, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '31', NULL, ''),
(529, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '31', NULL, ''),
(530, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '31', NULL, ''),
(531, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '31', NULL, ''),
(532, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '31', NULL, ''),
(533, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '32', '32', ''),
(534, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '32', '3', ''),
(535, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '32', '8', ''),
(536, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '32', '2019-10-18', ''),
(537, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '32', '1416666.62', ''),
(538, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '32', '382500.00', ''),
(539, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '32', '1799166.62', ''),
(540, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '32', '5666666.50', ''),
(541, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '32', NULL, ''),
(542, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '32', NULL, ''),
(543, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '32', NULL, ''),
(544, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '32', NULL, ''),
(545, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '32', NULL, ''),
(546, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '32', NULL, ''),
(547, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '32', NULL, ''),
(548, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '32', NULL, ''),
(549, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '33', '33', ''),
(550, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '33', '3', ''),
(551, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '33', '9', ''),
(552, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '33', '2019-11-18', ''),
(553, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '33', '1416666.62', ''),
(554, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '33', '382500.00', ''),
(555, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '33', '1799166.62', ''),
(556, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '33', '4250000.00', ''),
(557, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '33', NULL, ''),
(558, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '33', NULL, ''),
(559, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '33', NULL, ''),
(560, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '33', NULL, ''),
(561, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '33', NULL, ''),
(562, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '33', NULL, ''),
(563, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '33', NULL, ''),
(564, '2019-02-18 12:13:22', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '33', NULL, ''),
(565, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '34', '34', ''),
(566, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '34', '3', ''),
(567, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '34', '10', ''),
(568, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '34', '2019-12-18', ''),
(569, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '34', '1416666.62', ''),
(570, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '34', '382500.00', ''),
(571, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '34', '1799166.62', ''),
(572, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '34', '2833333.25', ''),
(573, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '34', NULL, ''),
(574, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '34', NULL, ''),
(575, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '34', NULL, ''),
(576, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '34', NULL, ''),
(577, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '34', NULL, ''),
(578, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '34', NULL, ''),
(579, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '34', NULL, ''),
(580, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '34', NULL, ''),
(581, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '35', '35', ''),
(582, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '35', '3', ''),
(583, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '35', '11', ''),
(584, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '35', '2020-01-18', ''),
(585, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '35', '1416666.62', ''),
(586, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '35', '382500.00', ''),
(587, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '35', '1799166.62', ''),
(588, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '35', '1416666.62', ''),
(589, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '35', NULL, ''),
(590, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '35', NULL, ''),
(591, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '35', NULL, ''),
(592, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '35', NULL, ''),
(593, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '35', NULL, ''),
(594, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '35', NULL, ''),
(595, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '35', NULL, ''),
(596, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '35', NULL, ''),
(597, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '36', '36', ''),
(598, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '36', '3', ''),
(599, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '36', '12', ''),
(600, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '36', '2020-02-18', ''),
(601, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '36', '1416666.62', ''),
(602, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '36', '382500.00', ''),
(603, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '36', '1799166.62', ''),
(604, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '36', '0.00', ''),
(605, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '36', NULL, ''),
(606, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '36', NULL, ''),
(607, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '36', NULL, ''),
(608, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '36', NULL, ''),
(609, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '36', NULL, ''),
(610, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '36', NULL, ''),
(611, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '36', NULL, ''),
(612, '2019-02-18 12:13:23', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '36', NULL, ''),
(613, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'id', '3', '3', ''),
(614, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_No', '3', '60003', ''),
(615, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_Tgl', '3', '2019-02-18', ''),
(616, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'nasabah_id', '3', '1', ''),
(617, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'jaminan_id', '3', '1', ''),
(618, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Pinjaman', '3', '17000000.00', ''),
(619, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Lama', '3', '12', ''),
(620, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '2.25', ''),
(621, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Denda', '3', '0.40', ''),
(622, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Dispensasi_Denda', '3', '3', ''),
(623, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Pokok', '3', '1416666.62', ''),
(624, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga', '3', '382500.00', ''),
(625, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Total', '3', '1799166.62', ''),
(626, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'No_Ref', '3', NULL, ''),
(627, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Administrasi', '3', '0.00', ''),
(628, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Materai', '3', '0.00', ''),
(629, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'marketing_id', '3', '1', ''),
(630, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Periode', '3', '201902', ''),
(631, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Macet', '3', 'N', ''),
(632, '2019-02-18 12:13:24', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete successful ***', 't03_pinjaman', '', '', '', ''),
(633, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '4', '', '60002B'),
(634, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '4', '', '2019-02-18'),
(635, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '4', '', '1'),
(636, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '4', '', '1'),
(637, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '4', '', '16000000.00'),
(638, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '4', '', '12'),
(639, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '4', '', '2.25'),
(640, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '4', '', '0.40'),
(641, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '4', '', '3'),
(642, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '4', '', '1333333.38'),
(643, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '4', '', '360000.00'),
(644, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '4', '', '1693333.38'),
(645, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '4', '', NULL),
(646, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '4', '', '0.00'),
(647, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '4', '', '0.00'),
(648, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '4', '', '1'),
(649, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Macet', '4', '', 'N'),
(650, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '4', '', '201902'),
(651, '2019-02-18 12:19:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '4', '', '4'),
(652, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '5', '', '60002C'),
(653, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '5', '', '2019-02-18'),
(654, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '5', '', '1'),
(655, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '5', '', '1'),
(656, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '5', '', '16000000.00'),
(657, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '5', '', '12'),
(658, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '5', '', '2.25'),
(659, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '5', '', '0.40'),
(660, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '5', '', '3'),
(661, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '5', '', '1333333.38'),
(662, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '5', '', '360000.00'),
(663, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '5', '', '1693333.38'),
(664, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '5', '', NULL),
(665, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '5', '', '0.00'),
(666, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '5', '', '0.00'),
(667, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '5', '', '1'),
(668, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '5', '', '201902'),
(669, '2019-02-18 12:23:05', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '5', '', '5'),
(670, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete begin ***', 't03_pinjaman', '', '', '', ''),
(671, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '49', '49', ''),
(672, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '49', '5', ''),
(673, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '49', '1', ''),
(674, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '49', '2019-03-18', ''),
(675, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '49', '1333333.38', ''),
(676, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '49', '360000.00', ''),
(677, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '49', '1693333.38', ''),
(678, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '49', '14666667.00', ''),
(679, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '49', NULL, ''),
(680, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '49', NULL, ''),
(681, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '49', NULL, ''),
(682, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '49', NULL, ''),
(683, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '49', NULL, ''),
(684, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '49', NULL, ''),
(685, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '49', NULL, ''),
(686, '2019-02-18 12:25:43', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '49', NULL, ''),
(687, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '50', '50', ''),
(688, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '50', '5', ''),
(689, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '50', '2', ''),
(690, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '50', '2019-04-18', ''),
(691, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '50', '1333333.38', ''),
(692, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '50', '360000.00', ''),
(693, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '50', '1693333.38', ''),
(694, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '50', '13333333.00', ''),
(695, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '50', NULL, ''),
(696, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '50', NULL, ''),
(697, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '50', NULL, ''),
(698, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '50', NULL, ''),
(699, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '50', NULL, ''),
(700, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '50', NULL, ''),
(701, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '50', NULL, ''),
(702, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '50', NULL, ''),
(703, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '51', '51', ''),
(704, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '51', '5', ''),
(705, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '51', '3', ''),
(706, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '51', '2019-05-18', ''),
(707, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '51', '1333333.38', ''),
(708, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '51', '360000.00', ''),
(709, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '51', '1693333.38', ''),
(710, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '51', '12000000.00', ''),
(711, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '51', NULL, ''),
(712, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '51', NULL, ''),
(713, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '51', NULL, ''),
(714, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '51', NULL, ''),
(715, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '51', NULL, ''),
(716, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '51', NULL, ''),
(717, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '51', NULL, ''),
(718, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '51', NULL, ''),
(719, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '52', '52', ''),
(720, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '52', '5', ''),
(721, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '52', '4', ''),
(722, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '52', '2019-06-18', ''),
(723, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '52', '1333333.38', ''),
(724, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '52', '360000.00', ''),
(725, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '52', '1693333.38', ''),
(726, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '52', '10666666.00', ''),
(727, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '52', NULL, ''),
(728, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '52', NULL, ''),
(729, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '52', NULL, ''),
(730, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '52', NULL, ''),
(731, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '52', NULL, ''),
(732, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '52', NULL, ''),
(733, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '52', NULL, ''),
(734, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '52', NULL, ''),
(735, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '53', '53', ''),
(736, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '53', '5', ''),
(737, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '53', '5', ''),
(738, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '53', '2019-07-18', ''),
(739, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '53', '1333333.38', ''),
(740, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '53', '360000.00', ''),
(741, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '53', '1693333.38', ''),
(742, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '53', '9333333.00', ''),
(743, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '53', NULL, ''),
(744, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '53', NULL, ''),
(745, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '53', NULL, ''),
(746, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '53', NULL, ''),
(747, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '53', NULL, ''),
(748, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '53', NULL, ''),
(749, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '53', NULL, ''),
(750, '2019-02-18 12:25:44', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '53', NULL, ''),
(751, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '54', '54', ''),
(752, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '54', '5', ''),
(753, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '54', '6', ''),
(754, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '54', '2019-08-18', ''),
(755, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '54', '1333333.38', ''),
(756, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '54', '360000.00', ''),
(757, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '54', '1693333.38', '');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(758, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '54', '7999999.50', ''),
(759, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '54', NULL, ''),
(760, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '54', NULL, ''),
(761, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '54', NULL, ''),
(762, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '54', NULL, ''),
(763, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '54', NULL, ''),
(764, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '54', NULL, ''),
(765, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '54', NULL, ''),
(766, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '54', NULL, ''),
(767, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '55', '55', ''),
(768, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '55', '5', ''),
(769, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '55', '7', ''),
(770, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '55', '2019-09-18', ''),
(771, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '55', '1333333.38', ''),
(772, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '55', '360000.00', ''),
(773, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '55', '1693333.38', ''),
(774, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '55', '6666666.50', ''),
(775, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '55', NULL, ''),
(776, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '55', NULL, ''),
(777, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '55', NULL, ''),
(778, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '55', NULL, ''),
(779, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '55', NULL, ''),
(780, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '55', NULL, ''),
(781, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '55', NULL, ''),
(782, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '55', NULL, ''),
(783, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '56', '56', ''),
(784, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '56', '5', ''),
(785, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '56', '8', ''),
(786, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '56', '2019-10-18', ''),
(787, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '56', '1333333.38', ''),
(788, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '56', '360000.00', ''),
(789, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '56', '1693333.38', ''),
(790, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '56', '5333333.00', ''),
(791, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '56', NULL, ''),
(792, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '56', NULL, ''),
(793, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '56', NULL, ''),
(794, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '56', NULL, ''),
(795, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '56', NULL, ''),
(796, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '56', NULL, ''),
(797, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '56', NULL, ''),
(798, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '56', NULL, ''),
(799, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '57', '57', ''),
(800, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '57', '5', ''),
(801, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '57', '9', ''),
(802, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '57', '2019-11-18', ''),
(803, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '57', '1333333.38', ''),
(804, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '57', '360000.00', ''),
(805, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '57', '1693333.38', ''),
(806, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '57', '3999999.50', ''),
(807, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '57', NULL, ''),
(808, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '57', NULL, ''),
(809, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '57', NULL, ''),
(810, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '57', NULL, ''),
(811, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '57', NULL, ''),
(812, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '57', NULL, ''),
(813, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '57', NULL, ''),
(814, '2019-02-18 12:25:45', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '57', NULL, ''),
(815, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '58', '58', ''),
(816, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '58', '5', ''),
(817, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '58', '10', ''),
(818, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '58', '2019-12-18', ''),
(819, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '58', '1333333.38', ''),
(820, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '58', '360000.00', ''),
(821, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '58', '1693333.38', ''),
(822, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '58', '2666666.25', ''),
(823, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '58', NULL, ''),
(824, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '58', NULL, ''),
(825, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '58', NULL, ''),
(826, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '58', NULL, ''),
(827, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '58', NULL, ''),
(828, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '58', NULL, ''),
(829, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '58', NULL, ''),
(830, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '58', NULL, ''),
(831, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '59', '59', ''),
(832, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '59', '5', ''),
(833, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '59', '11', ''),
(834, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '59', '2020-01-18', ''),
(835, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '59', '1333333.38', ''),
(836, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '59', '360000.00', ''),
(837, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '59', '1693333.38', ''),
(838, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '59', '1333332.88', ''),
(839, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '59', NULL, ''),
(840, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '59', NULL, ''),
(841, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '59', NULL, ''),
(842, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '59', NULL, ''),
(843, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '59', NULL, ''),
(844, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '59', NULL, ''),
(845, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '59', NULL, ''),
(846, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '59', NULL, ''),
(847, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '60', '60', ''),
(848, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '60', '5', ''),
(849, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '60', '12', ''),
(850, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '60', '2020-02-18', ''),
(851, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '60', '1333332.88', ''),
(852, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '60', '360000.56', ''),
(853, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '60', '1693333.38', ''),
(854, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '60', '0.00', ''),
(855, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '60', NULL, ''),
(856, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '60', NULL, ''),
(857, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '60', NULL, ''),
(858, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '60', NULL, ''),
(859, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '60', NULL, ''),
(860, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '60', NULL, ''),
(861, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '60', NULL, ''),
(862, '2019-02-18 12:25:46', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '60', NULL, ''),
(863, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'id', '5', '5', ''),
(864, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_No', '5', '60002C', ''),
(865, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_Tgl', '5', '2019-02-18', ''),
(866, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'nasabah_id', '5', '1', ''),
(867, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'jaminan_id', '5', '1', ''),
(868, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Pinjaman', '5', '16000000.00', ''),
(869, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Lama', '5', '12', ''),
(870, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '5', '2.25', ''),
(871, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Denda', '5', '0.40', ''),
(872, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Dispensasi_Denda', '5', '3', ''),
(873, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Pokok', '5', '1333333.38', ''),
(874, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga', '5', '360000.00', ''),
(875, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Total', '5', '1693333.38', ''),
(876, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'No_Ref', '5', NULL, ''),
(877, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Administrasi', '5', '0.00', ''),
(878, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Materai', '5', '0.00', ''),
(879, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'marketing_id', '5', '1', ''),
(880, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Periode', '5', '201902', ''),
(881, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Macet', '5', 'N', ''),
(882, '2019-02-18 12:25:47', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete successful ***', 't03_pinjaman', '', '', '', ''),
(883, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete begin ***', 't03_pinjaman', '', '', '', ''),
(884, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '37', '37', ''),
(885, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '37', '4', ''),
(886, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '37', '1', ''),
(887, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '37', '2019-03-18', ''),
(888, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '37', '1333333.38', ''),
(889, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '37', '360000.00', ''),
(890, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '37', '1693333.38', ''),
(891, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '37', '14666667.00', ''),
(892, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '37', NULL, ''),
(893, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '37', NULL, ''),
(894, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '37', NULL, ''),
(895, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '37', NULL, ''),
(896, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '37', NULL, ''),
(897, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '37', NULL, ''),
(898, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '37', NULL, ''),
(899, '2019-02-18 12:26:07', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '37', NULL, ''),
(900, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '38', '38', ''),
(901, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '38', '4', ''),
(902, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '38', '2', ''),
(903, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '38', '2019-04-18', ''),
(904, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '38', '1333333.38', ''),
(905, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '38', '360000.00', ''),
(906, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '38', '1693333.38', ''),
(907, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '38', '13333333.00', ''),
(908, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '38', NULL, ''),
(909, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '38', NULL, ''),
(910, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '38', NULL, ''),
(911, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '38', NULL, ''),
(912, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '38', NULL, ''),
(913, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '38', NULL, ''),
(914, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '38', NULL, ''),
(915, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '38', NULL, ''),
(916, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '39', '39', ''),
(917, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '39', '4', ''),
(918, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '39', '3', ''),
(919, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '39', '2019-05-18', ''),
(920, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '39', '1333333.38', ''),
(921, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '39', '360000.00', ''),
(922, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '39', '1693333.38', ''),
(923, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '39', '12000000.00', ''),
(924, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '39', NULL, ''),
(925, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '39', NULL, ''),
(926, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '39', NULL, ''),
(927, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '39', NULL, ''),
(928, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '39', NULL, ''),
(929, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '39', NULL, ''),
(930, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '39', NULL, ''),
(931, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '39', NULL, ''),
(932, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '40', '40', ''),
(933, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '40', '4', ''),
(934, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '40', '4', ''),
(935, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '40', '2019-06-18', ''),
(936, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '40', '1333333.38', ''),
(937, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '40', '360000.00', ''),
(938, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '40', '1693333.38', ''),
(939, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '40', '10666666.00', ''),
(940, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '40', NULL, ''),
(941, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '40', NULL, ''),
(942, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '40', NULL, ''),
(943, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '40', NULL, ''),
(944, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '40', NULL, ''),
(945, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '40', NULL, ''),
(946, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '40', NULL, ''),
(947, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '40', NULL, ''),
(948, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '41', '41', ''),
(949, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '41', '4', ''),
(950, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '41', '5', ''),
(951, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '41', '2019-07-18', ''),
(952, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '41', '1333333.38', ''),
(953, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '41', '360000.00', ''),
(954, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '41', '1693333.38', ''),
(955, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '41', '9333333.00', ''),
(956, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '41', NULL, ''),
(957, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '41', NULL, ''),
(958, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '41', NULL, ''),
(959, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '41', NULL, ''),
(960, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '41', NULL, ''),
(961, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '41', NULL, ''),
(962, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '41', NULL, ''),
(963, '2019-02-18 12:26:08', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '41', NULL, ''),
(964, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '42', '42', ''),
(965, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '42', '4', ''),
(966, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '42', '6', ''),
(967, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '42', '2019-08-18', ''),
(968, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '42', '1333333.38', ''),
(969, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '42', '360000.00', ''),
(970, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '42', '1693333.38', ''),
(971, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '42', '7999999.50', ''),
(972, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '42', NULL, ''),
(973, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '42', NULL, ''),
(974, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '42', NULL, ''),
(975, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '42', NULL, ''),
(976, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '42', NULL, ''),
(977, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '42', NULL, ''),
(978, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '42', NULL, ''),
(979, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '42', NULL, ''),
(980, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '43', '43', ''),
(981, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '43', '4', ''),
(982, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '43', '7', ''),
(983, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '43', '2019-09-18', ''),
(984, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '43', '1333333.38', ''),
(985, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '43', '360000.00', ''),
(986, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '43', '1693333.38', ''),
(987, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '43', '6666666.50', ''),
(988, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '43', NULL, ''),
(989, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '43', NULL, ''),
(990, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '43', NULL, ''),
(991, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '43', NULL, ''),
(992, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '43', NULL, ''),
(993, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '43', NULL, ''),
(994, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '43', NULL, ''),
(995, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '43', NULL, ''),
(996, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '44', '44', ''),
(997, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '44', '4', ''),
(998, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '44', '8', ''),
(999, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '44', '2019-10-18', ''),
(1000, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '44', '1333333.38', ''),
(1001, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '44', '360000.00', ''),
(1002, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '44', '1693333.38', ''),
(1003, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '44', '5333333.00', ''),
(1004, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '44', NULL, ''),
(1005, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '44', NULL, ''),
(1006, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '44', NULL, ''),
(1007, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '44', NULL, ''),
(1008, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '44', NULL, ''),
(1009, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '44', NULL, ''),
(1010, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '44', NULL, ''),
(1011, '2019-02-18 12:26:09', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '44', NULL, ''),
(1012, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '45', '45', ''),
(1013, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '45', '4', ''),
(1014, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '45', '9', ''),
(1015, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '45', '2019-11-18', ''),
(1016, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '45', '1333333.38', ''),
(1017, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '45', '360000.00', ''),
(1018, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '45', '1693333.38', ''),
(1019, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '45', '3999999.50', ''),
(1020, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '45', NULL, ''),
(1021, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '45', NULL, ''),
(1022, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '45', NULL, ''),
(1023, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '45', NULL, ''),
(1024, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '45', NULL, ''),
(1025, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '45', NULL, ''),
(1026, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '45', NULL, ''),
(1027, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '45', NULL, ''),
(1028, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '46', '46', ''),
(1029, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '46', '4', ''),
(1030, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '46', '10', ''),
(1031, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '46', '2019-12-18', ''),
(1032, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '46', '1333333.38', ''),
(1033, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '46', '360000.00', ''),
(1034, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '46', '1693333.38', ''),
(1035, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '46', '2666666.25', ''),
(1036, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '46', NULL, ''),
(1037, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '46', NULL, ''),
(1038, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '46', NULL, ''),
(1039, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '46', NULL, ''),
(1040, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '46', NULL, ''),
(1041, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '46', NULL, ''),
(1042, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '46', NULL, ''),
(1043, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '46', NULL, ''),
(1044, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '47', '47', ''),
(1045, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '47', '4', ''),
(1046, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '47', '11', ''),
(1047, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '47', '2020-01-18', ''),
(1048, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '47', '1333333.38', ''),
(1049, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '47', '360000.00', ''),
(1050, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '47', '1693333.38', ''),
(1051, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '47', '1333332.88', ''),
(1052, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '47', NULL, ''),
(1053, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '47', NULL, ''),
(1054, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '47', NULL, ''),
(1055, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '47', NULL, ''),
(1056, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '47', NULL, ''),
(1057, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '47', NULL, ''),
(1058, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '47', NULL, ''),
(1059, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '47', NULL, ''),
(1060, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '48', '48', ''),
(1061, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '48', '4', ''),
(1062, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '48', '12', ''),
(1063, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '48', '2020-02-18', ''),
(1064, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '48', '1333332.88', ''),
(1065, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '48', '360000.56', ''),
(1066, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '48', '1693333.38', ''),
(1067, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '48', '0.00', ''),
(1068, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '48', NULL, ''),
(1069, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '48', NULL, ''),
(1070, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '48', NULL, ''),
(1071, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '48', NULL, ''),
(1072, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '48', NULL, ''),
(1073, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '48', NULL, ''),
(1074, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '48', NULL, ''),
(1075, '2019-02-18 12:26:10', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '48', NULL, ''),
(1076, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'id', '4', '4', ''),
(1077, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_No', '4', '60002B', ''),
(1078, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_Tgl', '4', '2019-02-18', ''),
(1079, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'nasabah_id', '4', '1', ''),
(1080, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'jaminan_id', '4', '1', ''),
(1081, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Pinjaman', '4', '16000000.00', ''),
(1082, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Lama', '4', '12', ''),
(1083, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '4', '2.25', ''),
(1084, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Denda', '4', '0.40', ''),
(1085, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Dispensasi_Denda', '4', '3', ''),
(1086, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Pokok', '4', '1333333.38', ''),
(1087, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga', '4', '360000.00', ''),
(1088, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Total', '4', '1693333.38', ''),
(1089, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'No_Ref', '4', NULL, ''),
(1090, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Administrasi', '4', '0.00', ''),
(1091, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Materai', '4', '0.00', ''),
(1092, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'marketing_id', '4', '1', ''),
(1093, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Periode', '4', '201902', ''),
(1094, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Macet', '4', 'N', ''),
(1095, '2019-02-18 12:26:11', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete successful ***', 't03_pinjaman', '', '', '', ''),
(1096, '2019-02-18 13:54:31', '/simkop5/t10_jurnallist.php', '1', '*** Batch update begin ***', 't10_jurnal', '', '', '', ''),
(1097, '2019-02-18 13:54:31', '/simkop5/t10_jurnallist.php', '1', 'U', 't10_jurnal', 'Tanggal', '13', '2019-02-04', '2019-03-04'),
(1098, '2019-02-18 13:54:31', '/simkop5/t10_jurnallist.php', '1', '*** Batch update successful ***', 't10_jurnal', '', '', '', ''),
(1100, '2019-02-18 15:40:33', '/simkop5/t10_jurnallist.php', '1', '*** Batch update rollback ***', 't10_jurnal', '', '', '', ''),
(1102, '2019-02-18 15:41:39', '/simkop5/t10_jurnallist.php', '1', '*** Batch update rollback ***', 't10_jurnal', '', '', '', ''),
(1103, '2019-02-18 15:43:38', '/simkop5/t10_jurnallist.php', '1', '*** Batch update begin ***', 't10_jurnal', '', '', '', ''),
(1104, '2019-02-18 15:43:38', '/simkop5/t10_jurnallist.php', '1', 'U', 't10_jurnal', 'Tanggal', '13', '2019-03-04', '2019-02-04'),
(1105, '2019-02-18 15:43:38', '/simkop5/t10_jurnallist.php', '1', '*** Batch update successful ***', 't10_jurnal', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_labarugi`
-- (See below for the actual view)
--
CREATE TABLE `v01_labarugi` (
`idhead` varchar(35)
,`rekeninghead` varchar(90)
,`iddetail` varchar(35)
,`rekeningdetail` varchar(90)
,`debet` float(14,2)
,`kredit` float(14,2)
,`periode` varchar(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v02_nasabahjaminan`
-- (See below for the actual view)
--
CREATE TABLE `v02_nasabahjaminan` (
`id` int(11)
,`Nama` varchar(50)
,`Alamat` text
,`No_Telp_Hp` varchar(100)
,`Pekerjaan` varchar(50)
,`Pekerjaan_Alamat` text
,`Pekerjaan_No_Telp_Hp` varchar(100)
,`Status` tinyint(4)
,`Keterangan` varchar(100)
,`marketing_id` int(11)
,`jaminan_id` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v03_jurnalmemorial`
-- (See below for the actual view)
--
CREATE TABLE `v03_jurnalmemorial` (
`id` int(11)
,`Tanggal` date
,`NomorTransaksi` varchar(25)
,`Keterangan` tinytext
,`Periode` varchar(6)
,`Rekening` varchar(35)
,`Debet` float(14,2)
,`Kredit` float(14,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v04_lrper`
-- (See below for the actual view)
--
CREATE TABLE `v04_lrper` (
`Tahun_Bulan` varchar(6)
,`id` varchar(35)
,`NoUrut` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v05_labarugi`
-- (See below for the actual view)
--
CREATE TABLE `v05_labarugi` (
`Tahun_Bulan` varchar(6)
,`id` varchar(35)
,`Rekening` varchar(90)
,`NoUrut` varchar(1)
,`Debet` double(19,2)
,`Kredit` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v06_nrcper`
-- (See below for the actual view)
--
CREATE TABLE `v06_nrcper` (
`Tahun_Bulan` varchar(6)
,`id` varchar(35)
,`NoUrut` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v07_neraca`
-- (See below for the actual view)
--
CREATE TABLE `v07_neraca` (
`Tahun_Bulan` varchar(6)
,`id` varchar(35)
,`Rekening` varchar(90)
,`NoUrut` varchar(1)
,`Debet` double(19,2)
,`Kredit` double(19,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v01_labarugi`
--
DROP TABLE IF EXISTS `v01_labarugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_labarugi`  AS  select `a`.`id` AS `idhead`,`a`.`rekening` AS `rekeninghead`,`b`.`id` AS `iddetail`,`b`.`rekening` AS `rekeningdetail`,`c`.`Debet` AS `debet`,`c`.`Kredit` AS `kredit`,`c`.`Periode` AS `periode` from ((`t91_rekening` `a` left join `t91_rekening` `b` on((`a`.`id` = `b`.`parent`))) left join `t10_jurnal` `c` on((`b`.`id` = convert(`c`.`Rekening` using utf8)))) where (`a`.`id` = 3) union select `a`.`id` AS `id`,`a`.`rekening` AS `rekening`,`b`.`id` AS `id`,`b`.`rekening` AS `rekening`,`c`.`Debet` AS `debet`,`c`.`Kredit` AS `kredit`,`c`.`Periode` AS `periode` from ((`t91_rekening` `a` left join `t91_rekening` `b` on((`a`.`id` = `b`.`parent`))) left join `t10_jurnal` `c` on((`b`.`id` = convert(`c`.`Rekening` using utf8)))) where (`a`.`id` = 5) union select `a`.`id` AS `id`,`a`.`rekening` AS `rekening`,`b`.`id` AS `id`,`b`.`rekening` AS `rekening`,`c`.`Debet` AS `debet`,`c`.`Kredit` AS `kredit`,`c`.`Periode` AS `periode` from ((`t91_rekening` `a` left join `t91_rekening` `b` on((`a`.`id` = `b`.`parent`))) left join `t10_jurnal` `c` on((`b`.`id` = convert(`c`.`Rekening` using utf8)))) where (`a`.`id` = 4) union select `a`.`id` AS `id`,`a`.`rekening` AS `rekening`,`b`.`id` AS `id`,`b`.`rekening` AS `rekening`,`c`.`Debet` AS `debet`,`c`.`Kredit` AS `kredit`,`c`.`Periode` AS `periode` from ((`t91_rekening` `a` left join `t91_rekening` `b` on((`a`.`id` = `b`.`parent`))) left join `t10_jurnal` `c` on((`b`.`id` = convert(`c`.`Rekening` using utf8)))) where (`a`.`id` = 6) ;

-- --------------------------------------------------------

--
-- Structure for view `v02_nasabahjaminan`
--
DROP TABLE IF EXISTS `v02_nasabahjaminan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v02_nasabahjaminan`  AS  select `a`.`id` AS `id`,`a`.`Nama` AS `Nama`,`a`.`Alamat` AS `Alamat`,`a`.`No_Telp_Hp` AS `No_Telp_Hp`,`a`.`Pekerjaan` AS `Pekerjaan`,`a`.`Pekerjaan_Alamat` AS `Pekerjaan_Alamat`,`a`.`Pekerjaan_No_Telp_Hp` AS `Pekerjaan_No_Telp_Hp`,`a`.`Status` AS `Status`,`a`.`Keterangan` AS `Keterangan`,`a`.`marketing_id` AS `marketing_id`,group_concat(`b`.`id` separator ',') AS `jaminan_id` from (`t01_nasabah` `a` left join `t02_jaminan` `b` on((`a`.`id` = `b`.`nasabah_id`))) group by `a`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v03_jurnalmemorial`
--
DROP TABLE IF EXISTS `v03_jurnalmemorial`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v03_jurnalmemorial`  AS  select `a`.`id` AS `id`,`a`.`Tanggal` AS `Tanggal`,`a`.`NomorTransaksi` AS `NomorTransaksi`,`a`.`Keterangan` AS `Keterangan`,`a`.`Periode` AS `Periode`,`b`.`Rekening` AS `Rekening`,`b`.`Debet` AS `Debet`,`b`.`Kredit` AS `Kredit` from (`t11_jurnalmaster` `a` left join `t12_jurnaldetail` `b` on((`a`.`id` = `b`.`jurnalmaster_id`))) order by `b`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v04_lrper`
--
DROP TABLE IF EXISTS `v04_lrper`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v04_lrper`  AS  select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'1' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '3')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'2' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '5')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'3' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '4')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'4' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '6')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'1' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '3')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'2' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '5')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'3' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '4')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'4' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '6')) ;

-- --------------------------------------------------------

--
-- Structure for view `v05_labarugi`
--
DROP TABLE IF EXISTS `v05_labarugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v05_labarugi`  AS  select `a`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,`c`.`rekening` AS `Rekening`,`a`.`NoUrut` AS `NoUrut`,(case when isnull(sum(`b`.`Debet`)) then 0 else sum(`b`.`Debet`) end) AS `Debet`,(case when isnull(sum(`b`.`Kredit`)) then 0 else sum(`b`.`Kredit`) end) AS `Kredit` from ((`v04_lrper` `a` left join `t10_jurnal` `b` on(((`a`.`Tahun_Bulan` = `b`.`Periode`) and (`a`.`id` = convert(`b`.`Rekening` using utf8))))) left join `t91_rekening` `c` on((`a`.`id` = `c`.`id`))) group by `a`.`Tahun_Bulan`,`a`.`NoUrut`,`a`.`id` order by `a`.`Tahun_Bulan`,`a`.`NoUrut`,`a`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v06_nrcper`
--
DROP TABLE IF EXISTS `v06_nrcper`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v06_nrcper`  AS  select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'1' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '1')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'2' AS `NoUrut` from (`t91_rekening` `a` join `t92_periodeold` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '2')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'1' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '1')) union select `b`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,'2' AS `NoUrut` from (`t91_rekening` `a` join `t93_periode` `b`) where ((`a`.`tipe` = 'DETAIL') and (left(`a`.`id`,1) = '2')) ;

-- --------------------------------------------------------

--
-- Structure for view `v07_neraca`
--
DROP TABLE IF EXISTS `v07_neraca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v07_neraca`  AS  select `a`.`Tahun_Bulan` AS `Tahun_Bulan`,`a`.`id` AS `id`,`c`.`rekening` AS `Rekening`,`a`.`NoUrut` AS `NoUrut`,(case when isnull(sum(`b`.`Debet`)) then 0 else sum(`b`.`Debet`) end) AS `Debet`,(case when isnull(sum(`b`.`Kredit`)) then 0 else sum(`b`.`Kredit`) end) AS `Kredit` from ((`v06_nrcper` `a` left join `t10_jurnal` `b` on(((`a`.`Tahun_Bulan` = `b`.`Periode`) and (`a`.`id` = convert(`b`.`Rekening` using utf8))))) left join `t91_rekening` `c` on((`a`.`id` = `c`.`id`))) group by `a`.`Tahun_Bulan`,`a`.`NoUrut`,`a`.`id` order by `a`.`Tahun_Bulan`,`a`.`NoUrut`,`a`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t07_marketing`
--
ALTER TABLE `t07_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t08_pinjamanpotongan`
--
ALTER TABLE `t08_pinjamanpotongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t09_jurnaltransaksi`
--
ALTER TABLE `t09_jurnaltransaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t10_jurnal`
--
ALTER TABLE `t10_jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t11_jurnalmaster`
--
ALTER TABLE `t11_jurnalmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t12_jurnaldetail`
--
ALTER TABLE `t12_jurnaldetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t89_rektran`
--
ALTER TABLE `t89_rektran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t90_rektran`
--
ALTER TABLE `t90_rektran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t91_rekening`
--
ALTER TABLE `t91_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t93_periode`
--
ALTER TABLE `t93_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t94_log`
--
ALTER TABLE `t94_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t07_marketing`
--
ALTER TABLE `t07_marketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t08_pinjamanpotongan`
--
ALTER TABLE `t08_pinjamanpotongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t09_jurnaltransaksi`
--
ALTER TABLE `t09_jurnaltransaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t10_jurnal`
--
ALTER TABLE `t10_jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `t11_jurnalmaster`
--
ALTER TABLE `t11_jurnalmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t12_jurnaldetail`
--
ALTER TABLE `t12_jurnaldetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t89_rektran`
--
ALTER TABLE `t89_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t90_rektran`
--
ALTER TABLE `t90_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t93_periode`
--
ALTER TABLE `t93_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t94_log`
--
ALTER TABLE `t94_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
