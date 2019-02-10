-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 10, 2019 at 07:55 AM
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
  `Periode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_pinjaman`
--

INSERT INTO `t03_pinjaman` (`id`, `Kontrak_No`, `Kontrak_Tgl`, `nasabah_id`, `jaminan_id`, `Pinjaman`, `Angsuran_Lama`, `Angsuran_Bunga_Prosen`, `Angsuran_Denda`, `Dispensasi_Denda`, `Angsuran_Pokok`, `Angsuran_Bunga`, `Angsuran_Total`, `No_Ref`, `Biaya_Administrasi`, `Biaya_Materai`, `marketing_id`, `Periode`) VALUES
(1, '60001', '2018-12-04', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 25000.00, 18000.00, 1, '201812'),
(2, '60002', '2019-02-10', 1, '1', 16000000.00, 12, '2.25', '0.40', 3, 1333333.38, 360000.00, 1693333.38, NULL, 0.00, 0.00, 1, '201902');

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
(72, '2019-02-10', '201902', '2.MAT', '5.4000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002');

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
(11, '11', 'SHU Bulan Berjalan', '2.9000', '2.9000');

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
(391, '2019-02-10 11:53:08', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
