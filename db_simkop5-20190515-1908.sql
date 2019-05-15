-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 15, 2019 at 01:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

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
(1, 'Dodo', '-', '-', '-', '-', '-', 0, '-', 1);

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
(1, 1, 'ATM', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'SIM A', NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, '60001', '2019-04-16', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 10000.00, 6000.00, 1, '201904', 'N');

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
(1, 1, 1, '2019-05-16', 867000.00, 233000.00, 1100000.00, 9533000.00, '2019-04-24', -22, 0.00, 0.00, 1100000.00, 1100000.00, 'Denda Rp. 96,800.00', '201904'),
(2, 1, 2, '2019-06-16', 867000.00, 233000.00, 1100000.00, 8666000.00, '2019-04-22', -55, 0.00, 0.00, 1100000.00, 1100000.00, 'Denda Rp. 242,000.00', '201904'),
(3, 1, 3, '2019-07-16', 867000.00, 233000.00, 1100000.00, 7799000.00, '2019-04-24', -83, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201904'),
(4, 1, 4, '2019-08-16', 867000.00, 233000.00, 1100000.00, 6932000.00, '2019-04-24', -114, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201904'),
(5, 1, 5, '2019-09-16', 867000.00, 233000.00, 1100000.00, 6065000.00, '2019-09-24', 8, 35200.00, 0.00, 1100000.00, 1135200.00, NULL, '201904'),
(6, 1, 6, '2019-10-16', 867000.00, 233000.00, 1100000.00, 5198000.00, '2019-10-22', 6, 26400.00, 0.00, 1100000.00, 1126400.00, 'Denda Rp. 26,400.00', '201904'),
(7, 1, 7, '2019-11-16', 867000.00, 233000.00, 1100000.00, 4331000.00, '2019-11-24', 8, 0.00, 0.00, 1100000.00, 1100000.00, 'Denda Rp. 35,200.00', '201904'),
(8, 1, 8, '2019-12-16', 867000.00, 233000.00, 1100000.00, 3464000.00, '2019-04-24', -236, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201904'),
(9, 1, 9, '2020-01-16', 867000.00, 233000.00, 1100000.00, 2597000.00, '2019-04-16', -275, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201904'),
(10, 1, 10, '2020-02-16', 867000.00, 233000.00, 1100000.00, 1730000.00, '2019-04-29', -293, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201904'),
(11, 1, 11, '2020-03-16', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2020-04-16', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'Adi', '-', '-');

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
(1, '2019-04-16', '201904', '1.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 60001'),
(2, '2019-04-16', '201904', '1.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 60001'),
(3, '2019-04-16', '201904', '1.ADM', '1.1003', 10000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(4, '2019-04-16', '201904', '1.ADM', '5.1000', 0.00, 10000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(5, '2019-04-16', '201904', '1.MAT', '1.1003', 6000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(6, '2019-04-16', '201904', '1.MAT', '5.4000', 0.00, 6000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(7, '2019-04-24', '201904', '1.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(8, '2019-04-24', '201904', '1.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(9, '2019-04-24', '201904', '1.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(10, '2019-04-24', '201904', '1.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(11, '2019-04-24', '201904', '1.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(12, '2019-04-24', '201904', '1.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(13, '2019-04-22', '201904', '2.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(14, '2019-04-22', '201904', '2.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(15, '2019-04-22', '201904', '2.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(16, '2019-04-22', '201904', '2.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(17, '2019-04-22', '201904', '2.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(18, '2019-04-22', '201904', '2.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(19, '2019-04-24', '201904', '3.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60001'),
(20, '2019-04-24', '201904', '3.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60001'),
(21, '2019-04-24', '201904', '3.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 3 No. Kontrak 60001'),
(22, '2019-04-24', '201904', '3.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 3 No. Kontrak 60001'),
(23, '2019-04-24', '201904', '3.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60001'),
(24, '2019-04-24', '201904', '3.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60001'),
(25, '2019-04-24', '201904', '4.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 4 No. Kontrak 60001'),
(26, '2019-04-24', '201904', '4.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 4 No. Kontrak 60001'),
(27, '2019-04-24', '201904', '4.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 4 No. Kontrak 60001'),
(28, '2019-04-24', '201904', '4.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 4 No. Kontrak 60001'),
(29, '2019-04-24', '201904', '4.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 4 No. Kontrak 60001'),
(30, '2019-04-24', '201904', '4.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 4 No. Kontrak 60001'),
(31, '2019-09-24', '201904', '5.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 5 No. Kontrak 60001'),
(32, '2019-09-24', '201904', '5.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 5 No. Kontrak 60001'),
(33, '2019-09-24', '201904', '5.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 5 No. Kontrak 60001'),
(34, '2019-09-24', '201904', '5.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 5 No. Kontrak 60001'),
(35, '2019-09-24', '201904', '5.DND', '1.1003', 35200.00, 0.00, 'Pendapatan Denda ke 5 No. Kontrak 60001'),
(36, '2019-09-24', '201904', '5.DND', '5.3000', 0.00, 35200.00, 'Pendapatan Denda ke 5 No. Kontrak 60001'),
(37, '2019-10-22', '201904', '6.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60001'),
(38, '2019-10-22', '201904', '6.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60001'),
(39, '2019-10-22', '201904', '6.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 6 No. Kontrak 60001'),
(40, '2019-10-22', '201904', '6.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 6 No. Kontrak 60001'),
(41, '2019-10-22', '201904', '6.DND', '1.1003', 26400.00, 0.00, 'Pendapatan Denda ke 6 No. Kontrak 60001'),
(42, '2019-10-22', '201904', '6.DND', '5.3000', 0.00, 26400.00, 'Pendapatan Denda ke 6 No. Kontrak 60001'),
(43, '2019-11-24', '201904', '7.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 7 No. Kontrak 60001'),
(44, '2019-11-24', '201904', '7.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 7 No. Kontrak 60001'),
(45, '2019-11-24', '201904', '7.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 7 No. Kontrak 60001'),
(46, '2019-11-24', '201904', '7.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 7 No. Kontrak 60001'),
(47, '2019-11-24', '201904', '7.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 7 No. Kontrak 60001'),
(48, '2019-11-24', '201904', '7.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 7 No. Kontrak 60001'),
(49, '2019-04-24', '201904', '8.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 8 No. Kontrak 60001'),
(50, '2019-04-24', '201904', '8.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 8 No. Kontrak 60001'),
(51, '2019-04-24', '201904', '8.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 8 No. Kontrak 60001'),
(52, '2019-04-24', '201904', '8.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 8 No. Kontrak 60001'),
(53, '2019-04-24', '201904', '8.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 8 No. Kontrak 60001'),
(54, '2019-04-24', '201904', '8.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 8 No. Kontrak 60001'),
(61, '2019-04-16', '201904', '9.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 9 No. Kontrak 60001'),
(62, '2019-04-16', '201904', '9.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 9 No. Kontrak 60001'),
(63, '2019-04-16', '201904', '9.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 9 No. Kontrak 60001'),
(64, '2019-04-16', '201904', '9.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 9 No. Kontrak 60001'),
(65, '2019-04-16', '201904', '9.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 9 No. Kontrak 60001'),
(66, '2019-04-16', '201904', '9.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 9 No. Kontrak 60001'),
(67, '2019-04-29', '201904', '10.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 10 No. Kontrak 60001'),
(68, '2019-04-29', '201904', '10.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 10 No. Kontrak 60001'),
(69, '2019-04-29', '201904', '10.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 10 No. Kontrak 60001'),
(70, '2019-04-29', '201904', '10.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 10 No. Kontrak 60001'),
(71, '2019-04-29', '201904', '10.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 10 No. Kontrak 60001'),
(72, '2019-04-29', '201904', '10.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 10 No. Kontrak 60001');

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
-- Table structure for table `t73_pinjamanlap`
--

CREATE TABLE `t73_pinjamanlap` (
  `id` int(11) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT '0',
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t73_pinjamanlap`
--

INSERT INTO `t73_pinjamanlap` (`id`, `field_name`, `field_status`, `field_caption`, `field_align`, `field_index`, `field_format`) VALUES
(1, 'pinjaman_id', 'N', 'id', 'left', 99, 'none'),
(2, 'Kontrak_No', 'Y', 'Kontrak', 'left', 1, 'none'),
(3, 'Kontrak_Tgl', 'Y', 'Awal Kontrak', 'left', 4, 'tanggal'),
(4, 'nasabah_id', 'N', 'nasabah_id', 'left', 99, 'none'),
(5, 'jaminan_id', 'N', 'jaminan_id', 'left', 99, 'none'),
(6, 'Pinjaman', 'Y', 'Nominal', 'right', 6, 'numerik'),
(7, 'Angsuran_Lama', 'Y', 'Lama Angsur', 'right', 7, 'none'),
(8, 'Angsuran_Bunga_Prosen', 'N', 'Bunga (%)', 'left', 99, 'none'),
(9, 'Angsuran_Denda', 'N', 'Denda (%)', 'left', 99, 'none'),
(10, 'Dispensasi_Denda', 'N', 'Dispensasi (Hari)', 'left', 99, 'none'),
(11, 'Angsuran_Pokok', 'N', 'Pokok', 'left', 99, 'none'),
(12, 'Angsuran_Bunga', 'N', 'Bunga', 'right', 99, 'numerik'),
(13, 'Angsuran_Total', 'N', 'Total', 'left', 99, 'none'),
(14, 'No_Ref', 'N', 'No. Referensi', 'left', 99, 'none'),
(15, 'Biaya_Administrasi', 'N', 'Administrasi', 'left', 99, 'none'),
(16, 'Biaya_Materai', 'N', 'Materai', 'left', 99, 'none'),
(17, 'marketing_id', 'N', 'marketing_id', 'left', 99, 'none'),
(18, 'Periode', 'N', 'Periode', 'left', 99, 'none'),
(19, 'Macet', 'N', 'Macet', 'left', 99, 'none'),
(20, 'NasabahNama', 'Y', 'Nama Anggota', 'left', 2, 'none'),
(21, 'NasabahAlamat', 'Y', 'Alamat', 'left', 3, 'none'),
(22, 'No_Telp_Hp', 'N', 'No. Telp. / HP', 'left', 99, 'none'),
(23, 'Pekerjaan', 'N', 'Pekerjaan', 'left', 99, 'none'),
(24, 'Pekerjaan_Alamat', 'N', 'Alamat Pekerjaan', 'left', 99, 'none'),
(25, 'Pekerjaan_No_Telp_Hp', 'N', 'No. Telp. / HP Pekerjaan', 'left', 99, 'none'),
(26, 'Status', 'N', 'Status', 'left', 99, 'none'),
(27, 'NasabahKeterangan', 'N', 'Keterangan Nasabah', 'left', 99, 'none'),
(28, 'Merk_Type', 'N', 'Merk / Tipe', 'left', 99, 'none'),
(29, 'No_Rangka', 'N', 'No. Rangka', 'left', 99, 'none'),
(30, 'No_Mesin', 'N', 'No. Mesin', 'left', 99, 'none'),
(31, 'Warna', 'N', 'Warna', 'left', 99, 'none'),
(32, 'No_Pol', 'N', 'No. Pol.', 'left', 99, 'none'),
(33, 'JaminanKeterangan', 'N', 'Keterangan Jaminan', 'left', 99, 'none'),
(34, 'Atas_Nama', 'N', 'Atas Nama', 'left', 99, 'none'),
(35, 'MarketingNama', 'N', 'Marketing', 'left', 99, 'none'),
(36, 'MarketingAlamat', 'N', 'Alamat', 'left', 99, 'none'),
(37, 'NoHP', 'N', 'No. HP', 'left', 99, 'none'),
(64, 'AkhirKontrak', 'Y', 'Akhir Kontrak', 'left', 5, 'tanggal'),
(65, 'sudah_bayar', 'Y', 'Sudah Bayar', 'right', 8, 'none'),
(66, 'pd_Angsuran_Pokok', 'Y', 'Piutang Pokok', 'right', 9, 'numerik'),
(67, 'pd_Angsuran_Bunga', 'Y', 'Piutang Bunga', 'right', 10, 'numerik'),
(68, 'pd_Angsuran_Total', 'Y', 'Total', 'right', 99, 'numerik');

-- --------------------------------------------------------

--
-- Table structure for table `t74_jurnallapclosed`
--

CREATE TABLE `t74_jurnallapclosed` (
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `AkunKode` varchar(35) NOT NULL,
  `AkunNama` varchar(90) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t75_company`
--

CREATE TABLE `t75_company` (
  `id` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `NoTelp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t75_company`
--

INSERT INTO `t75_company` (`id`, `Nama`, `Alamat`, `NoTelp`) VALUES
(1, 'Koperasi Sumber Makmur', 'Sidoarjo', '0318889999');

-- --------------------------------------------------------

--
-- Table structure for table `t76_neracaold`
--

CREATE TABLE `t76_neracaold` (
  `periode` varchar(6) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `group` bigint(20) DEFAULT NULL,
  `group_rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `id` varchar(35) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `saldoawal` float(14,2) NOT NULL DEFAULT '0.00',
  `debet` double(19,2) DEFAULT NULL,
  `kredit` double(19,2) DEFAULT NULL,
  `saldoakhir` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t77_labarugiold`
--

CREATE TABLE `t77_labarugiold` (
  `periode` varchar(6) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `group` bigint(20) DEFAULT NULL,
  `group_rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `id` varchar(35) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `saldoawal` float(14,2) NOT NULL DEFAULT '0.00',
  `debet` double(19,2) DEFAULT NULL,
  `kredit` double(19,2) DEFAULT NULL,
  `saldoakhir` double(19,2) DEFAULT NULL,
  `jumlah` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t78_bukubesarlap`
--

CREATE TABLE `t78_bukubesarlap` (
  `AkunKode` varchar(35) NOT NULL,
  `AkunNama` varchar(90) NOT NULL,
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  `Saldo` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t78_bukubesarlap`
--

INSERT INTO `t78_bukubesarlap` (`AkunKode`, `AkunNama`, `Tanggal`, `NomorTransaksi`, `Keterangan`, `Debet`, `Kredit`, `Saldo`) VALUES
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-16', '1.PINJ', 'Pinjaman No. Kontrak 60001', 0.00, 10400000.00, -10400000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-16', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', 10000.00, 0.00, -10390000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-16', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', 6000.00, 0.00, -10384000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t79_jurnallap`
--

CREATE TABLE `t79_jurnallap` (
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `AkunKode` varchar(35) NOT NULL,
  `AkunNama` varchar(90) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t79_jurnallap`
--

INSERT INTO `t79_jurnallap` (`Tanggal`, `NomorTransaksi`, `Keterangan`, `AkunKode`, `AkunNama`, `Debet`, `Kredit`) VALUES
('2019-04-16', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 10400000.00, 0.00),
('2019-04-16', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 10400000.00),
('2019-04-16', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 10000.00, 0.00),
('2019-04-16', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 10000.00),
('2019-04-16', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 6000.00, 0.00),
('2019-04-16', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 6000.00),
('2019-04-22', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-04-22', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-04-22', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-04-22', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-04-22', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-22', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-24', '1.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-04-24', '1.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-04-24', '1.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-04-24', '1.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-04-24', '1.DND', 'Pendapatan Denda ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-24', '1.DND', 'Pendapatan Denda ke 1 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-24', '3.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-04-24', '3.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-04-24', '3.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-04-24', '3.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-04-24', '3.DND', 'Pendapatan Denda ke 3 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-24', '3.DND', 'Pendapatan Denda ke 3 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-24', '4.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-04-24', '4.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-04-24', '4.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-04-24', '4.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-04-24', '4.DND', 'Pendapatan Denda ke 4 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-24', '4.DND', 'Pendapatan Denda ke 4 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-24', '8.ANG', 'Pembayaran Angsuran ke 8 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-04-24', '8.ANG', 'Pembayaran Angsuran ke 8 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-04-24', '8.BGA', 'Pendapatan Bunga ke 8 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-04-24', '8.BGA', 'Pendapatan Bunga ke 8 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-04-24', '8.DND', 'Pendapatan Denda ke 8 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-24', '8.DND', 'Pendapatan Denda ke 8 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-09-24', '5.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-09-24', '5.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-09-24', '5.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-09-24', '5.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-09-24', '5.DND', 'Pendapatan Denda ke 5 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 35200.00, 0.00),
('2019-09-24', '5.DND', 'Pendapatan Denda ke 5 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 35200.00),
('2019-10-22', '6.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-10-22', '6.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-10-22', '6.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-10-22', '6.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-10-22', '6.DND', 'Pendapatan Denda ke 6 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 26400.00, 0.00),
('2019-10-22', '6.DND', 'Pendapatan Denda ke 6 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 26400.00),
('2019-11-24', '7.ANG', 'Pembayaran Angsuran ke 7 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 867000.00, 0.00),
('2019-11-24', '7.ANG', 'Pembayaran Angsuran ke 7 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 867000.00),
('2019-11-24', '7.BGA', 'Pendapatan Bunga ke 7 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 233000.00, 0.00),
('2019-11-24', '7.BGA', 'Pendapatan Bunga ke 7 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 233000.00),
('2019-11-24', '7.DND', 'Pendapatan Denda ke 7 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-11-24', '7.DND', 'Pendapatan Denda ke 7 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t80_rekeningold`
--

CREATE TABLE `t80_rekeningold` (
  `group` bigint(20) DEFAULT '0',
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext,
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT '0.00',
  `Periode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t82_jurnalold`
--

CREATE TABLE `t82_jurnalold` (
  `id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  `Keterangan` tinytext NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `t87_neraca`
--

CREATE TABLE `t87_neraca` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(64) DEFAULT NULL,
  `field04` varchar(64) DEFAULT NULL,
  `field05` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t87_neraca`
--

INSERT INTO `t87_neraca` (`field01`, `field02`, `field03`, `field04`, `field05`) VALUES
('', '', 'April 2019', NULL, NULL),
('<strong>AKTIVA</strong>', '', '', NULL, NULL),
('1.1001', 'KAS BANK - BCA', '0.00', NULL, NULL),
('1.1002', 'KAS BANK - MANDIRI', '0.00', NULL, NULL),
('1.1003', 'KAS BANK - BCA SURABAYA', '-10,384,000.00', NULL, NULL),
('1.1004', 'KAS BESAR', '0.00', NULL, NULL),
('1.1005', 'KAS KECIL HARIAN', '0.00', NULL, NULL),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00', NULL, NULL),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00', NULL, NULL),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '10,400,000.00', NULL, NULL),
('1.2004', 'PIUTANG SIDOARJO', '0.00', NULL, NULL),
('1.2005', 'PIUTANG KPL 5', '0.00', NULL, NULL),
('1.2006', 'PIUTANG TROSOBO', '0.00', NULL, NULL),
('1.2007', 'PIUTANG DANIEL', '0.00', NULL, NULL),
('1.2008', 'PIUTANG ANDIK', '0.00', NULL, NULL),
('1.3000', 'PERSEDIAAN KANTOR', '0.00', NULL, NULL),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00', NULL, NULL),
('', '', '<strong>16,000.00</strong>', NULL, NULL),
('', '', '', NULL, NULL),
('<strong>PASSIVA</strong>', '', '', NULL, NULL),
('2.1000', 'HUTANG PAJAJARAN', '0.00', NULL, NULL),
('2.2000', 'HUTANG DANIEL', '0.00', NULL, NULL),
('2.3000', 'TITIPAN NASABAH', '0.00', NULL, NULL),
('2.4000', 'MODAL DISETOR', '0.00', NULL, NULL),
('2.5000', 'SHU TAHUN LALU', '0.00', NULL, NULL),
('2.6000', 'SHU TAHUN', '0.00', NULL, NULL),
('2.7000', 'PEMBAGIAN SHU TAHUN', '0.00', NULL, NULL),
('2.8000', 'SHU TAHUN BERJALAN', '0.00', NULL, NULL),
('2.9000', 'SHU BULAN BERJALAN', '16,000.00', NULL, NULL),
('', '', '<strong>16,000.00</strong>', NULL, NULL),
('', '', '', NULL, NULL),
('', '', '<strong>0.00</strong>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t88_labarugi`
--

CREATE TABLE `t88_labarugi` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(64) DEFAULT NULL,
  `field04` varchar(64) DEFAULT NULL,
  `field05` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t88_labarugi`
--

INSERT INTO `t88_labarugi` (`field01`, `field02`, `field03`, `field04`, `field05`) VALUES
('', '', 'April 2019', NULL, NULL),
('<strong>PENDAPATAN</strong>', '', '', NULL, NULL),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '0.00', NULL, NULL),
('<strong>PENDAPATAN LAIN</strong>', '', '', NULL, NULL),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '10,000.00', NULL, NULL),
('5.2000', 'PENDAPATAN BUNGA BANK', '0.00', NULL, NULL),
('5.3000', 'PENDAPATAN DENDA', '0.00', NULL, NULL),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '6,000.00', NULL, NULL),
('', '', '<strong>16,000.00</strong>', NULL, NULL),
('', '', '', NULL, NULL),
('<strong>BIAYA</strong>', '', '', NULL, NULL),
('4.1000', 'BIAYA KARYAWAN', '0.00', NULL, NULL),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '0.00', NULL, NULL),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '0.00', NULL, NULL),
('4.4000', 'BIAYA ADMINISTRASI BANK', '0.00', NULL, NULL),
('4.5000', 'BIAYA PENYUSUTAN', '0.00', NULL, NULL),
('4.6000', 'BIAYA IKLAN', '0.00', NULL, NULL),
('4.7000', 'POTONGAN', '0.00', NULL, NULL),
('<strong>BIAYA LAIN</strong>', '', '', NULL, NULL),
('6.1000', 'BIAYA LAIN-LAIN', '0.00', NULL, NULL),
('', '', '<strong>0.00</strong>', NULL, NULL),
('', '', '', NULL, NULL),
('', '', '<strong>16,000.00</strong>', NULL, NULL);

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
(12, '12', 'Nasabah Macet', '1.2003', '1.2002'),
(13, '13', 'SHU Tahun Berjalan', '2.8000', '2.8000');

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
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT '0.00',
  `Periode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t91_rekening`
--

INSERT INTO `t91_rekening` (`group`, `id`, `rekening`, `tipe`, `posisi`, `laporan`, `status`, `parent`, `keterangan`, `active`, `Saldo`, `Periode`) VALUES
(1, '1', 'AKTIVA', 'GROUP', 'DEBET', 'NERACA', '', '', '', 'yes', 0.00, '201904'),
(1, '1.1000', 'KAS', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201904'),
(1, '1.1001', 'KAS BANK - BCA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.1002', 'KAS BANK - MANDIRI', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.1003', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.1004', 'KAS BESAR', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.1005', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201904'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2004', 'PIUTANG SIDOARJO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2005', 'PIUTANG KPL 5', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2006', 'PIUTANG TROSOBO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2007', 'PIUTANG DANIEL', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2008', 'PIUTANG ANDIK', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.3000', 'PERSEDIAAN KANTOR', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201904'),
(1, '1.4000', 'AKUMULASI PENYUSUTAN', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201904'),
(2, '2', 'PASSIVA', 'GROUP', 'CREDIT', 'NERACA', '', '', '', 'yes', 0.00, '201904'),
(2, '2.1000', 'HUTANG PAJAJARAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.2000', 'HUTANG DANIEL', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.3000', 'TITIPAN NASABAH', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.4000', 'MODAL DISETOR', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.5000', 'SHU TAHUN LALU', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.6000', 'SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.7000', 'PEMBAGIAN SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.8000', 'SHU TAHUN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(3, '3', 'PENDAPATAN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(3, '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '3', '', 'yes', 0.00, '201904'),
(4, '4', 'BIAYA', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(4, '4.1000', 'BIAYA KARYAWAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.2000', 'BIAYA PERKANTORAN & UMUM', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.3000', 'BIAYA KOMISI MAKELAR / FEE', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.4000', 'BIAYA ADMINISTRASI BANK', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.5000', 'BIAYA PENYUSUTAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.6000', 'BIAYA IKLAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.7000', 'POTONGAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(6, '6', 'BIAYA LAIN', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(6, '6.1000', 'BIAYA LAIN-LAIN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '6', '', 'yes', 0.00, '201904');

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
(1, 4, 2019, '201904');

-- --------------------------------------------------------

--
-- Table structure for table `t94_log`
--

CREATE TABLE `t94_log` (
  `id` int(11) NOT NULL,
  `index_` tinyint(4) NOT NULL,
  `subj_` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'N', '');

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
(1, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '60001'),
(2, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2019-04-16'),
(3, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(4, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '1'),
(5, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(6, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(7, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(8, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(9, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(10, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(11, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(12, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(13, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(14, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '10000'),
(15, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '6000'),
(16, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(17, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201904'),
(18, '2019-04-16 15:41:44', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(19, '2019-04-22 14:00:30', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(20, '2019-04-23 11:51:25', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(21, '2019-04-24 09:24:25', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(22, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-04-24'),
(23, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '-22'),
(24, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(25, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '0'),
(26, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '1100000'),
(27, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(28, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '1', NULL, 'Denda Rp. 96,800.00'),
(29, '2019-04-24 09:26:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201904'),
(30, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', NULL, '2019-04-22'),
(31, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '2', NULL, '-55'),
(32, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '2', NULL, '0'),
(33, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '2', NULL, '0'),
(34, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '2', NULL, '1100000'),
(35, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '2', NULL, '1100000'),
(36, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '2', NULL, 'Denda Rp. 242,000.00'),
(37, '2019-04-24 09:26:16', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '2', NULL, '201904'),
(38, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '3', NULL, '2019-04-24'),
(39, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '3', NULL, '-83'),
(40, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '3', NULL, '0'),
(41, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '3', NULL, '0'),
(42, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '3', NULL, '1100000'),
(43, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '3', NULL, '1100000'),
(44, '2019-04-24 10:44:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '3', NULL, '201904'),
(45, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '4', NULL, '2019-04-24'),
(46, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '4', NULL, '-114'),
(47, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '4', NULL, '0'),
(48, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '4', NULL, '0'),
(49, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '4', NULL, '1100000'),
(50, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '4', NULL, '1100000'),
(51, '2019-04-24 11:11:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '4', NULL, '201904'),
(52, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '5', NULL, '2019-09-24'),
(53, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '5', NULL, '8'),
(54, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '5', NULL, '35200'),
(55, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '5', NULL, '0'),
(56, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '5', NULL, '1100000'),
(57, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '5', NULL, '1135200'),
(58, '2019-04-24 11:12:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '5', NULL, '201904'),
(59, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '6', NULL, '2019-10-22'),
(60, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '6', NULL, '6'),
(61, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '6', NULL, '26400'),
(62, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '6', NULL, '0'),
(63, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '6', NULL, '1100000'),
(64, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '6', NULL, '1126400'),
(65, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '6', NULL, 'Denda Rp. 26,400.00'),
(66, '2019-04-24 11:17:08', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '6', NULL, '201904'),
(67, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '7', NULL, '2019-11-24'),
(68, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '7', NULL, '8'),
(69, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '7', NULL, '0'),
(70, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '7', NULL, '0'),
(71, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '7', NULL, '1100000'),
(72, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '7', NULL, '1100000'),
(73, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '7', NULL, 'Denda Rp. 35,200.00'),
(74, '2019-04-24 11:22:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '7', NULL, '201904'),
(75, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '8', NULL, '2019-04-24'),
(76, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '8', NULL, '-236'),
(77, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '8', NULL, '0'),
(78, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '8', NULL, '0'),
(79, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '8', NULL, '1100000'),
(80, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '8', NULL, '1100000'),
(81, '2019-04-24 11:22:49', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '8', NULL, '201904'),
(82, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '9', NULL, '2019-04-17'),
(83, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '9', NULL, '-274'),
(84, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '9', NULL, '0'),
(85, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '9', NULL, '0'),
(86, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '9', NULL, '1100000'),
(87, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '9', NULL, '1100000'),
(88, '2019-04-24 12:50:10', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '9', NULL, '201904'),
(89, '2019-04-24 12:50:53', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '9', '2019-04-17', '2019-04-16'),
(90, '2019-04-24 12:50:53', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '9', '-274', '-275'),
(91, '2019-04-25 12:05:52', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(92, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(93, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '1', '', 'id'),
(94, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '1', 'Y', 'N'),
(95, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '2', '', 'No. Kontrak'),
(96, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '3', '', 'Tgl. Kontrak'),
(97, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '4', '', 'Nasabah'),
(98, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '5', '', 'Jaminan'),
(99, '2019-04-25 17:12:43', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '6', '', 'Pinjaman'),
(100, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '7', '', 'Lama Angsuran'),
(101, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '8', '', 'Bunga (%)'),
(102, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '9', '', 'Denda (%)'),
(103, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '10', '', 'Dispensasi (Hari)'),
(104, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '11', '', 'Pokok'),
(105, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '12', '', 'Bunga'),
(106, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '13', '', 'Total'),
(107, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '14', '', 'No. Referensi'),
(108, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '15', '', 'Administrasi'),
(109, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '16', '', 'Materai'),
(110, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '17', '', 'Marketing'),
(111, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '18', '', 'Periode'),
(112, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '19', '', 'Macet'),
(113, '2019-04-25 17:12:44', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(114, '2019-04-25 17:16:42', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(115, '2019-04-25 17:16:42', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(116, '2019-04-25 17:39:07', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(117, '2019-04-25 17:39:08', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(118, '2019-04-25 17:46:33', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(119, '2019-04-25 17:46:33', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(120, '2019-04-25 17:47:44', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(121, '2019-04-25 17:47:44', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(122, '2019-04-25 17:48:03', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(123, '2019-04-25 17:48:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'Y', 'N'),
(124, '2019-04-25 17:48:04', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(125, '2019-04-25 17:53:57', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(126, '2019-04-25 17:53:57', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(127, '2019-04-25 17:57:32', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(128, '2019-04-25 17:57:32', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(129, '2019-04-25 18:02:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(130, '2019-04-25 18:02:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(131, '2019-04-25 18:02:59', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(132, '2019-04-25 18:02:59', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '1', 'N', 'Y'),
(133, '2019-04-25 18:02:59', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'N', 'Y'),
(134, '2019-04-25 18:02:59', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(135, '2019-04-25 18:03:20', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(136, '2019-04-25 18:03:20', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(137, '2019-04-25 18:04:15', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(138, '2019-04-25 18:04:15', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(139, '2019-04-25 18:05:28', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(140, '2019-04-25 18:05:28', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(141, '2019-04-25 18:07:18', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(142, '2019-04-25 18:07:18', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '1', 'Y', 'N'),
(143, '2019-04-25 18:07:18', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(144, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(145, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '3', 'Y', 'N'),
(146, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '6', 'Y', 'N'),
(147, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'Y', 'N'),
(148, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '8', 'Y', 'N'),
(149, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '9', 'Y', 'N'),
(150, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '10', 'Y', 'N'),
(151, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '11', 'Y', 'N'),
(152, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '12', 'Y', 'N'),
(153, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '13', 'Y', 'N'),
(154, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '14', 'Y', 'N'),
(155, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '15', 'Y', 'N'),
(156, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '16', 'Y', 'N'),
(157, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '17', 'Y', 'N'),
(158, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '18', 'Y', 'N'),
(159, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '19', 'Y', 'N'),
(160, '2019-04-25 18:08:03', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(161, '2019-04-25 18:08:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(162, '2019-04-25 18:08:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '3', 'N', 'Y'),
(163, '2019-04-25 18:08:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(164, '2019-04-25 18:09:33', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(165, '2019-04-25 18:09:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(166, '2019-04-25 18:19:45', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(167, '2019-04-25 18:19:46', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(168, '2019-04-25 18:20:11', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(169, '2019-04-25 18:20:11', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '4', 'Y', 'N'),
(170, '2019-04-25 18:20:11', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '5', 'Y', 'N'),
(171, '2019-04-25 18:20:11', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '6', 'N', 'Y'),
(172, '2019-04-25 18:20:11', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(173, '2019-04-26 10:01:45', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(174, '2019-04-26 10:04:13', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(175, '2019-04-26 10:04:13', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '4', 'N', 'Y'),
(176, '2019-04-26 10:04:13', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(177, '2019-04-26 10:11:09', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(178, '2019-04-26 10:11:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'L', 'R'),
(179, '2019-04-26 10:11:09', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(180, '2019-04-26 10:12:15', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(181, '2019-04-26 10:12:15', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(182, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(183, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '1', '', 'left'),
(184, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '2', '', 'left'),
(185, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '3', '', 'left'),
(186, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '4', '', 'left'),
(187, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '5', '', 'left'),
(188, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', '', 'right'),
(189, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '7', '', 'left'),
(190, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '8', '', 'left'),
(191, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '9', '', 'left'),
(192, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '10', '', 'left'),
(193, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '11', '', 'left'),
(194, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '12', '', 'left'),
(195, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '13', '', 'left'),
(196, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '14', '', 'left'),
(197, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '15', '', 'left'),
(198, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '16', '', 'left'),
(199, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '17', '', 'left'),
(200, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '18', '', 'left'),
(201, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '19', '', 'left'),
(202, '2019-04-26 10:18:25', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(203, '2019-04-26 10:20:53', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(204, '2019-04-26 10:20:53', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(205, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(206, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '1', '', 'id'),
(207, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '2', '', 'No. Kontrak'),
(208, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '3', '', 'Tgl. Kontrak'),
(209, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '4', '', 'Nasabah'),
(210, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '5', '', 'Jaminan'),
(211, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '6', '', 'Pinjaman'),
(212, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'left', 'right'),
(213, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '7', '', 'Lama Angsuran'),
(214, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '8', '', 'Bunga (%)'),
(215, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '9', '', 'Denda (%)'),
(216, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '10', '', 'Dispensasi (Hari)'),
(217, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '11', '', 'Pokok'),
(218, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '12', '', 'Bunga'),
(219, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '13', '', 'Total'),
(220, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '14', '', 'No. Referensi'),
(221, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '15', '', 'Administrasi'),
(222, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '16', '', 'Materai'),
(223, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '17', '', 'Marketing'),
(224, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '18', '', 'Periode'),
(225, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '19', '', 'Macet'),
(226, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '20', '', 'Nasabah'),
(227, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '21', '', 'Alamat'),
(228, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '22', '', 'No. Telp. / HP'),
(229, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '23', '', 'Pekerjaan'),
(230, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '24', '', 'Alamat Pekerjaan'),
(231, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '25', '', 'No. Telp. / HP Pekerjaan'),
(232, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '26', '', 'Status'),
(233, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '27', '', 'Keterangan Nasabah'),
(234, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '28', '', 'Merk / Tipe'),
(235, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '29', '', 'No. Rangka'),
(236, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '30', '', 'No. Mesin'),
(237, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '31', '', 'Warna'),
(238, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '32', '', 'No. Pol.'),
(239, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '33', '', 'Keterangan Jaminan'),
(240, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '34', '', 'Atas Nama'),
(241, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '35', '', 'Marketing'),
(242, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '36', '', 'Alamat'),
(243, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '37', '', 'No. HP'),
(244, '2019-04-26 12:46:58', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(245, '2019-04-26 12:49:56', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(246, '2019-04-26 12:49:56', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'N', 'Y'),
(247, '2019-04-26 12:49:56', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '3', 'N', 'Y'),
(248, '2019-04-26 12:49:56', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '6', 'N', 'Y'),
(249, '2019-04-26 12:49:56', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(250, '2019-04-26 12:51:20', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(251, '2019-04-26 12:51:20', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'N', 'Y'),
(252, '2019-04-26 12:51:20', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '8', 'N', 'Y'),
(253, '2019-04-26 12:51:21', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '20', 'N', 'Y'),
(254, '2019-04-26 12:51:21', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(255, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(256, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '2', 'No. Kontrak', 'Kontrak'),
(257, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '3', 'Tgl. Kontrak', 'Awal Kontrak'),
(258, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '6', 'Pinjaman', 'Nominal'),
(259, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '7', 'Lama Angsuran', 'Lama Angsur'),
(260, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'Y', 'N'),
(261, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '8', 'Y', 'N'),
(262, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '20', 'Nasabah', 'Nama Anggota'),
(263, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '21', 'N', 'Y'),
(264, '2019-04-26 12:55:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(265, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(266, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '2', '0', '1'),
(267, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '4', 'Nasabah', 'nasabah_id'),
(268, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '5', 'Jaminan', 'jaminan_id'),
(269, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '17', 'Marketing', 'marketing_id'),
(270, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '20', '0', '2'),
(271, '2019-04-26 13:00:52', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(272, '2019-04-26 13:06:56', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(273, '2019-04-26 13:06:57', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(274, '2019-04-26 13:07:27', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(275, '2019-04-26 13:07:27', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '21', '0', '3'),
(276, '2019-04-26 13:07:27', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(277, '2019-04-26 13:08:04', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(278, '2019-04-26 13:08:05', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '3', '0', '4'),
(279, '2019-04-26 13:08:05', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(280, '2019-04-26 13:24:39', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(281, '2019-04-26 13:24:39', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '0', '5'),
(282, '2019-04-26 13:24:39', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(283, '2019-04-26 13:35:20', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(284, '2019-04-26 13:35:21', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '1', 'left', 'right'),
(285, '2019-04-26 13:35:21', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'Y', 'N'),
(286, '2019-04-26 13:35:21', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '6', 'none', 'numerik'),
(287, '2019-04-26 13:35:21', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(288, '2019-04-26 13:35:55', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(289, '2019-04-26 13:35:55', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '3', 'none', 'tanggal'),
(290, '2019-04-26 13:35:55', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(291, '2019-04-26 13:38:00', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(292, '2019-04-26 13:38:00', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '1', 'right', 'left'),
(293, '2019-04-26 13:38:01', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(294, '2019-04-26 13:39:00', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(295, '2019-04-26 13:39:00', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'N', 'Y'),
(296, '2019-04-26 13:39:00', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(297, '2019-04-26 13:44:39', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(298, '2019-04-26 13:44:39', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(299, '2019-04-26 14:22:33', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(300, '2019-04-26 14:32:03', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(301, '2019-04-26 14:32:03', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(302, '2019-04-26 15:06:23', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(303, '2019-04-26 15:06:23', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '0', '99'),
(304, '2019-04-26 15:06:23', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(305, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(306, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '5', '6'),
(307, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '64', 'Judul Kolom', 'Akhir Kontrak'),
(308, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '99', '5'),
(309, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '64', 'none', 'tanggal'),
(310, '2019-04-26 15:07:06', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(311, '2019-04-26 15:08:08', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(312, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '5', '6'),
(313, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '64', 'left', 'right'),
(314, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '64', 'tanggal', 'numerik'),
(315, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '6', 'Nominal', 'Akhir Kontrak'),
(316, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '6', '5'),
(317, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'right', 'left'),
(318, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '6', 'numerik', 'tanggal'),
(319, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '7', '99', '7'),
(320, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'N', 'Y'),
(321, '2019-04-26 15:08:09', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(322, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(323, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '6', 'Akhir Kontrak', 'Nominal'),
(324, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '5', '6'),
(325, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'left', 'right'),
(326, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '6', 'tanggal', 'numerik'),
(327, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '6', '5'),
(328, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '64', 'right', 'left'),
(329, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '64', 'numerik', 'tanggal'),
(330, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '9', '99', '7'),
(331, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '9', 'N', 'Y'),
(332, '2019-04-26 15:09:19', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(333, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(334, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '64', 'Akhir Kontrak', 'Nominal'),
(335, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '5', '6'),
(336, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '64', 'left', 'right'),
(337, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '64', 'tanggal', 'numerik'),
(338, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '6', '5'),
(339, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'right', 'left'),
(340, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '6', 'numerik', 'tanggal'),
(341, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '7', '7', '99'),
(342, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'Y', 'N'),
(343, '2019-04-26 15:10:08', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(344, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(345, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '5', '6'),
(346, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'left', 'right'),
(347, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '6', 'tanggal', 'numerik'),
(348, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '6', '5'),
(349, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '64', 'right', 'left'),
(350, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '64', 'numerik', 'tanggal'),
(351, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '9', '7', '99'),
(352, '2019-04-26 15:10:34', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '9', 'Y', 'N'),
(353, '2019-04-26 15:10:35', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(354, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(355, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_caption', '64', 'Nominal', 'Akhir Kontrak'),
(356, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '5', '6'),
(357, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '6', '5'),
(358, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'right', 'left'),
(359, '2019-04-26 15:11:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(360, '2019-04-26 15:15:48', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(361, '2019-04-26 15:15:48', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(362, '2019-04-26 15:16:55', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(363, '2019-04-26 15:16:55', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '6', '5', '6'),
(364, '2019-04-26 15:16:55', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '6', 'left', 'right'),
(365, '2019-04-26 15:16:55', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '64', '6', '5'),
(366, '2019-04-26 15:16:55', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(367, '2019-04-26 15:17:19', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(368, '2019-04-26 15:17:19', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(369, '2019-04-26 15:22:13', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(370, '2019-04-26 15:22:13', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(371, '2019-04-26 15:22:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(372, '2019-04-26 15:22:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '7', '99', '7'),
(373, '2019-04-26 15:22:51', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'N', 'Y');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(374, '2019-04-26 15:22:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(375, '2019-04-26 15:23:12', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(376, '2019-04-26 15:23:12', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '7', 'left', 'right'),
(377, '2019-04-26 15:23:12', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(378, '2019-04-26 15:24:53', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(379, '2019-04-26 15:24:53', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '12', '99', '8'),
(380, '2019-04-26 15:24:53', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '12', 'N', 'Y'),
(381, '2019-04-26 15:24:53', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '12', 'left', 'right'),
(382, '2019-04-26 15:24:54', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(383, '2019-04-26 15:25:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(384, '2019-04-26 15:25:51', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(385, '2019-04-26 15:26:58', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(386, '2019-04-26 15:26:59', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(387, '2019-04-26 15:27:30', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(388, '2019-04-26 15:27:31', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_format', '12', 'none', 'numerik'),
(389, '2019-04-26 15:27:31', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(390, '2019-04-27 13:43:17', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(391, '2019-04-27 13:43:36', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(392, '2019-04-27 13:43:37', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(393, '2019-04-27 13:46:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(394, '2019-04-27 13:46:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(395, '2019-04-27 14:41:59', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(396, '2019-04-27 14:41:59', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '12', 'Y', 'N'),
(397, '2019-04-27 14:41:59', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(398, '2019-04-29 09:20:20', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(399, '2019-04-29 09:20:48', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(400, '2019-04-29 09:20:48', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(401, '2019-04-29 10:23:23', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(402, '2019-04-29 10:23:23', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '12', '8', '99'),
(403, '2019-04-29 10:23:23', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '65', '99', '8'),
(404, '2019-04-29 10:23:23', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_align', '65', 'left', 'right'),
(405, '2019-04-29 10:23:23', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(406, '2019-04-29 10:58:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(407, '2019-04-29 10:58:24', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(408, '2019-04-29 11:26:09', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(409, '2019-04-29 11:26:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '67', '99', '10'),
(410, '2019-04-29 11:26:09', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '66', '99', '9'),
(411, '2019-04-29 11:26:09', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(412, '2019-04-29 13:42:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(413, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '10', NULL, '2019-04-29'),
(414, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '10', NULL, '-293'),
(415, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '10', NULL, '0'),
(416, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '10', NULL, '0'),
(417, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '10', NULL, '1100000'),
(418, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '10', NULL, '1100000'),
(419, '2019-04-29 15:30:46', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '10', NULL, '201904'),
(420, '2019-04-29 18:38:58', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(421, '2019-04-30 10:38:44', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(422, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update begin ***', 't02_jaminan', '', '', '', ''),
(423, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'No_Rangka', '1', '', NULL),
(424, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'No_Mesin', '1', '', NULL),
(425, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'Warna', '1', '', NULL),
(426, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'No_Pol', '1', '', NULL),
(427, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'Keterangan', '1', '', NULL),
(428, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'U', 't02_jaminan', 'Atas_Nama', '1', '', NULL),
(429, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'nasabah_id', '2', '', '1'),
(430, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'Merk_Type', '2', '', 'SIM A'),
(431, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'No_Rangka', '2', '', NULL),
(432, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'No_Mesin', '2', '', NULL),
(433, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'Warna', '2', '', NULL),
(434, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'No_Pol', '2', '', NULL),
(435, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'Keterangan', '2', '', NULL),
(436, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '2', '', NULL),
(437, '2019-04-30 10:39:12', '/simkop5/t01_nasabahedit.php', '1', 'A', 't02_jaminan', 'id', '2', '', '2'),
(438, '2019-04-30 10:39:13', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update successful ***', 't02_jaminan', '', '', '', ''),
(439, '2019-04-30 18:55:48', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');

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
-- Indexes for table `t73_pinjamanlap`
--
ALTER TABLE `t73_pinjamanlap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t75_company`
--
ALTER TABLE `t75_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t82_jurnalold`
--
ALTER TABLE `t82_jurnalold`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `t73_pinjamanlap`
--
ALTER TABLE `t73_pinjamanlap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `t75_company`
--
ALTER TABLE `t75_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t82_jurnalold`
--
ALTER TABLE `t82_jurnalold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t89_rektran`
--
ALTER TABLE `t89_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t90_rektran`
--
ALTER TABLE `t90_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t93_periode`
--
ALTER TABLE `t93_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t94_log`
--
ALTER TABLE `t94_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
