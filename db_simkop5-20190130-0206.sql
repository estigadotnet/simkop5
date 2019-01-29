-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 29, 2019 at 08:06 PM
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
(1, 'Andoko', '-', '-', '-', '-', '-', 0, NULL, 1),
(2, 'Dodo', '-', '-', '-', '-', '-', 0, NULL, 2),
(3, 'Hendra', '-', '-', '-', '-', '-', 2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `t02_jaminan`
--

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Merk_Type` varchar(25) NOT NULL,
  `No_Rangka` varchar(50) DEFAULT NULL,
  `No_Mesin` varchar(50) DEFAULT NULL,
  `Warna` varchar(15) DEFAULT NULL,
  `No_Pol` varchar(15) DEFAULT NULL,
  `Keterangan` text,
  `Atas_Nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_jaminan`
--

INSERT INTO `t02_jaminan` (`id`, `nasabah_id`, `Merk_Type`, `No_Rangka`, `No_Mesin`, `Warna`, `No_Pol`, `Keterangan`, `Atas_Nama`) VALUES
(1, 1, 'ATM', '1111', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'ATM', '1234', NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Ijasah', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'ATM', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 3, 'I', NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, '1', '2018-12-21', 2, '2', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 0.00, 0.00, 1, '201812'),
(2, '2', '2019-01-28', 1, '1', 11400000.00, 12, '2.25', '0.40', 3, 950000.00, 256500.00, 1206500.00, NULL, 0.00, 0.00, 1, '201812'),
(3, '3', '2019-01-28', 2, '2,3', 12500000.00, 12, '2.26', '0.40', 3, 1042000.00, 282000.00, 1324000.00, NULL, 0.00, 0.00, 1, '201812'),
(4, '3a', '2019-01-29', 2, '2,3', 13000000.00, 12, '2.26', '0.40', 3, 1083333.38, 293800.00, 1377133.38, NULL, 0.00, 0.00, 1, '201812'),
(5, '3b', '2019-01-29', 2, '2,3', 13500000.00, 12, '2.26', '0.40', 3, 1125000.00, 305100.00, 1430100.00, NULL, 0.00, 0.00, 1, '201812');

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
(1, 1, 1, '2019-01-21', 867000.00, 233000.00, 1100000.00, 9533000.00, '2019-01-21', 0, 0.00, 0.00, 1100000.00, 1100000.00, NULL, '201812'),
(2, 1, 2, '2019-02-21', 867000.00, 233000.00, 1100000.00, 8666000.00, '2019-01-28', -24, 0.00, 250000.00, 850000.00, 1100000.00, NULL, '201812'),
(3, 1, 3, '2019-03-21', 867000.00, 233000.00, 1100000.00, 7799000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, '2019-04-21', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, '2019-05-21', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, '2019-06-21', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, '2019-07-21', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, '2019-08-21', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, '2019-09-21', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, '2019-10-21', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, '2019-11-21', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2019-12-21', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 1, '2019-02-28', 950000.00, 256500.00, 1206500.00, 10450000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 2, '2019-03-28', 950000.00, 256500.00, 1206500.00, 9500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 2, 3, '2019-04-28', 950000.00, 256500.00, 1206500.00, 8550000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 4, '2019-05-28', 950000.00, 256500.00, 1206500.00, 7600000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 2, 5, '2019-06-28', 950000.00, 256500.00, 1206500.00, 6650000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 2, 6, '2019-07-28', 950000.00, 256500.00, 1206500.00, 5700000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 7, '2019-08-28', 950000.00, 256500.00, 1206500.00, 4750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 2, 8, '2019-09-28', 950000.00, 256500.00, 1206500.00, 3800000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 2, 9, '2019-10-28', 950000.00, 256500.00, 1206500.00, 2850000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 10, '2019-11-28', 950000.00, 256500.00, 1206500.00, 1900000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 11, '2019-12-28', 950000.00, 256500.00, 1206500.00, 950000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 12, '2020-01-28', 950000.00, 256500.00, 1206500.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 3, 1, '2019-02-28', 1042000.00, 282000.00, 1324000.00, 11458000.00, '2019-01-29', -30, 0.00, 0.00, 1324000.00, 1324000.00, NULL, '201812'),
(50, 3, 2, '2019-03-28', 1042000.00, 282000.00, 1324000.00, 10416000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 3, 3, '2019-04-28', 1042000.00, 282000.00, 1324000.00, 9374000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 3, 4, '2019-05-28', 1042000.00, 282000.00, 1324000.00, 8332000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 3, 5, '2019-06-28', 1042000.00, 282000.00, 1324000.00, 7290000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 3, 6, '2019-07-28', 1042000.00, 282000.00, 1324000.00, 6248000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 3, 7, '2019-08-28', 1042000.00, 282000.00, 1324000.00, 5206000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 3, 8, '2019-09-28', 1042000.00, 282000.00, 1324000.00, 4164000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 3, 9, '2019-10-28', 1042000.00, 282000.00, 1324000.00, 3122000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 3, 10, '2019-11-28', 1042000.00, 282000.00, 1324000.00, 2080000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 3, 11, '2019-12-28', 1042000.00, 282000.00, 1324000.00, 1038000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 3, 12, '2020-01-28', 1038000.00, 286000.00, 1324000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 5, 1, '2019-02-28', 1125000.00, 305100.00, 1430100.00, 12375000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 5, 2, '2019-03-29', 1125000.00, 305100.00, 1430100.00, 11250000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 5, 3, '2019-04-29', 1125000.00, 305100.00, 1430100.00, 10125000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 5, 4, '2019-05-29', 1125000.00, 305100.00, 1430100.00, 9000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 5, 5, '2019-06-29', 1125000.00, 305100.00, 1430100.00, 7875000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 5, 6, '2019-07-29', 1125000.00, 305100.00, 1430100.00, 6750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 5, 7, '2019-08-29', 1125000.00, 305100.00, 1430100.00, 5625000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 5, 8, '2019-09-29', 1125000.00, 305100.00, 1430100.00, 4500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 5, 9, '2019-10-29', 1125000.00, 305100.00, 1430100.00, 3375000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 5, 10, '2019-11-29', 1125000.00, 305100.00, 1430100.00, 2250000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 5, 11, '2019-12-29', 1125000.00, 305100.00, 1430100.00, 1125000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 5, 12, '2020-01-29', 1125000.00, 305100.00, 1430100.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 4, 1, '2019-02-28', 1083333.38, 293800.00, 1377133.38, 11916667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 4, 2, '2019-03-29', 1083333.38, 293800.00, 1377133.38, 10833333.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 4, 3, '2019-04-29', 1083333.38, 293800.00, 1377133.38, 9750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 4, 4, '2019-05-29', 1083333.38, 293800.00, 1377133.38, 8666667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 4, 5, '2019-06-29', 1083333.38, 293800.00, 1377133.38, 7583333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 4, 6, '2019-07-29', 1083333.38, 293800.00, 1377133.38, 6500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 4, 7, '2019-08-29', 1083333.38, 293800.00, 1377133.38, 5416666.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 4, 8, '2019-09-29', 1083333.38, 293800.00, 1377133.38, 4333333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 4, 9, '2019-10-29', 1083333.38, 293800.00, 1377133.38, 3250000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 4, 10, '2019-11-29', 1083333.38, 293800.00, 1377133.38, 2166666.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 4, 11, '2019-12-29', 1083333.38, 293800.00, 1377133.38, 1083333.38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 4, 12, '2020-01-29', 1083333.38, 293800.00, 1377133.38, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `t06_pinjamantitipan`
--

INSERT INTO `t06_pinjamantitipan` (`id`, `pinjaman_id`, `Tanggal`, `Keterangan`, `Masuk`, `Keluar`, `Sisa`, `Angsuran_Ke`) VALUES
(1, 1, '2018-12-21', NULL, 250000.00, 0.00, 250000.00, 0),
(2, 1, '2019-01-28', 'Pembayaran Angsuran Ke-2', 0.00, 250000.00, 0.00, 2);

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
(1, 'Adi', '', ''),
(2, 'Ali', '', '');

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

--
-- Dumping data for table `t08_pinjamanpotongan`
--

INSERT INTO `t08_pinjamanpotongan` (`id`, `pinjaman_id`, `Tanggal`, `Keterangan`, `Jumlah`) VALUES
(1, 5, '2019-01-29', NULL, 17500.00);

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
(1, '2018-12-21', '201812', '1.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 1'),
(2, '2018-12-21', '201812', '1.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 1'),
(3, '2018-12-21', '201812', '1.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 1'),
(4, '2018-12-21', '201812', '1.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 1'),
(5, '2018-12-21', '201812', '1.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 1'),
(6, '2018-12-21', '201812', '1.MAT', '5.1000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 1'),
(7, '2018-12-21', '201812', '1.TM', '1.1003', 250000.00, 0.00, 'Titipan Masuk Angsuran ke  No. Kontrak 1'),
(8, '2018-12-21', '201812', '1.TM', '2.3000', 0.00, 250000.00, 'Titipan Masuk Angsuran ke  No. Kontrak 1'),
(57, '2018-12-21', '201812', '.TS', '1.1003', 50000.00, 0.00, 'Titipan Sisa Angsuran ke 1 No. Kontrak '),
(58, '2018-12-21', '201812', '.TS', '2.3000', 0.00, 50000.00, 'Titipan Sisa Angsuran ke 1 No. Kontrak '),
(67, '2018-12-21', '201812', '.TS', '1.1003', 150000.00, 0.00, 'Titipan Sisa Angsuran ke 1 No. Kontrak '),
(68, '2018-12-21', '201812', '.TS', '2.3000', 0.00, 150000.00, 'Titipan Sisa Angsuran ke 1 No. Kontrak '),
(75, '2018-12-21', '201812', '.TS', '1.1003', 250000.00, 0.00, 'Titipan Sisa Angsuran ke 0 No. Kontrak '),
(76, '2018-12-21', '201812', '.TS', '2.3000', 0.00, 250000.00, 'Titipan Sisa Angsuran ke 0 No. Kontrak '),
(77, '2018-12-21', '201812', '1.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 1'),
(78, '2018-12-21', '201812', '1.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 1'),
(79, '2018-12-21', '201812', '1.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 1'),
(80, '2018-12-21', '201812', '1.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 1 No. Kontrak 1'),
(81, '2018-12-21', '201812', '1.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 1'),
(82, '2018-12-21', '201812', '1.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 1'),
(83, '2019-01-28', '201812', '2.PINJ', '1.2003', 11400000.00, 0.00, 'Pinjaman No. Kontrak 2'),
(84, '2019-01-28', '201812', '2.PINJ', '1.1003', 0.00, 11400000.00, 'Pinjaman No. Kontrak 2'),
(85, '2019-01-28', '201812', '2.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 2'),
(86, '2019-01-28', '201812', '2.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 2'),
(87, '2019-01-28', '201812', '2.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 2'),
(88, '2019-01-28', '201812', '2.MAT', '5.1000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 2'),
(101, '2019-01-28', '201812', '3.PINJ', '1.2003', 12500000.00, 0.00, 'Pinjaman No. Kontrak 3'),
(102, '2019-01-28', '201812', '3.PINJ', '1.1003', 0.00, 12500000.00, 'Pinjaman No. Kontrak 3'),
(103, '2019-01-28', '201812', '3.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3'),
(104, '2019-01-28', '201812', '3.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3'),
(105, '2019-01-28', '201812', '3.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3'),
(106, '2019-01-28', '201812', '3.MAT', '5.1000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3'),
(107, '2019-01-28', '201812', '1.TK', '2.3000', 250000.00, 0.00, 'Titipan Keluar Angsuran ke 2 No. Kontrak 1'),
(108, '2019-01-28', '201812', '1.TK', '1.1003', 0.00, 250000.00, 'Titipan Keluar Angsuran ke 2 No. Kontrak 1'),
(109, '2019-01-28', '201812', '2.ANG', '1.1003', 867000.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 1'),
(110, '2019-01-28', '201812', '2.ANG', '1.2003', 0.00, 867000.00, 'Pembayaran Angsuran ke 2 No. Kontrak 1'),
(111, '2019-01-28', '201812', '2.BGA', '1.1003', 233000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 1'),
(112, '2019-01-28', '201812', '2.BGA', '3.1000', 0.00, 233000.00, 'Pendapatan Bunga ke 2 No. Kontrak 1'),
(113, '2019-01-28', '201812', '2.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 1'),
(114, '2019-01-28', '201812', '2.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 1'),
(121, '2019-01-29', '201812', '49.ANG', '1.1003', 1042000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 3'),
(122, '2019-01-29', '201812', '49.ANG', '1.2003', 0.00, 1042000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 3'),
(123, '2019-01-29', '201812', '49.BGA', '1.1003', 282000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 3'),
(124, '2019-01-29', '201812', '49.BGA', '3.1000', 0.00, 282000.00, 'Pendapatan Bunga ke 1 No. Kontrak 3'),
(125, '2019-01-29', '201812', '49.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 3'),
(126, '2019-01-29', '201812', '49.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 3'),
(127, '2019-01-29', '201812', '5.PINJ', '1.2003', 13500000.00, 0.00, 'Pinjaman No. Kontrak 3b'),
(128, '2019-01-29', '201812', '5.PINJ', '1.1003', 0.00, 13500000.00, 'Pinjaman No. Kontrak 3b'),
(129, '2019-01-29', '201812', '5.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3b'),
(130, '2019-01-29', '201812', '5.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3b'),
(131, '2019-01-29', '201812', '5.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3b'),
(132, '2019-01-29', '201812', '5.MAT', '5.1000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3b'),
(133, '2019-01-29', '201812', '4.PINJ', '1.2003', 13000000.00, 0.00, 'Pinjaman No. Kontrak 3a'),
(134, '2019-01-29', '201812', '4.PINJ', '1.1003', 0.00, 13000000.00, 'Pinjaman No. Kontrak 3a'),
(135, '2019-01-29', '201812', '4.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3a'),
(136, '2019-01-29', '201812', '4.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 3a'),
(137, '2019-01-29', '201812', '4.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3a'),
(138, '2019-01-29', '201812', '4.MAT', '5.1000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 3a'),
(139, '2019-01-29', '201812', '3b.PT', '4.7000', 17500.00, 0.00, 'Potongan No. Kontrak 3b'),
(140, '2019-01-29', '201812', '3b.PT', '1.1003', 0.00, 17500.00, 'Potongan No. Kontrak 3b'),
(141, '2019-01-30', '201812', 'JM001', '1.1001', 1000000.00, 0.00, '-'),
(142, '2019-01-30', '201812', 'JM001', '2.2000', 0.00, 1000000.00, '-');

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
('<strong>AKTIVA</strong>', '', ''),
('1.1001', 'KAS BANK - BCA', '0.00'),
('1.1002', 'KAS BANK - MANDIRI', '0.00'),
('1.1003', 'KAS BANK - BCA SURABAYA', '-56,826,000.00'),
('1.1004', 'KAS BESAR', '0.00'),
('1.1005', 'KAS KECIL HARIAN', '0.00'),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00'),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00'),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '58,024,000.00'),
('1.2004', 'PIUTANG SIDOARJO', '0.00'),
('1.2005', 'PIUTANG KPL 5', '0.00'),
('1.2006', 'PIUTANG TROSOBO', '0.00'),
('1.2007', 'PIUTANG DANIEL', '0.00'),
('1.2008', 'PIUTANG ANDIK', '0.00'),
('1.3000', 'PERSEDIAAN KANTOR', '0.00'),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00'),
('', '', '<strong>1,198,000.00</st'),
('', '', ''),
('<strong>PASSIVA</strong>', '', ''),
('2.1000', 'HUTANG PAJAJARAN', '0.00'),
('2.2000', 'HUTANG DANIEL', '0.00'),
('2.3000', 'TITIPAN NASABAH', '450,000.00'),
('2.4000', 'MODAL DISETOR', '0.00'),
('2.5000', 'SHU TAHUN LALU', '0.00'),
('2.6000', 'SHU TAHUN', '0.00'),
('2.7000', 'PEMBAGIAN SHU TAHUN', '0.00'),
('2.8000', 'SHU TAHUN BERJALAN', '0.00'),
('2.9000', 'SHU BULAN BERJALAN', '0.00'),
('', '', '<strong>450,000.00</stro'),
('', '', ''),
('', '', '<strong>748,000.00</stro');

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
('<strong>PENDAPATAN</strong>', '', ''),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '748,000.00'),
('<strong>PENDAPATAN LAIN</strong>', '', ''),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '0.00'),
('5.2000', 'PENDAPATAN BUNGA BANK', '0.00'),
('5.3000', 'PENDAPATAN DENDA', '0.00'),
('', '', '<strong>748,000.00</stro'),
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
('', '', '<strong>748,000.00</stro');

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
(3, '03', 'Pinjaman Disetujui, Nilai Materai', '1.1003', '5.1000'),
(4, '04', 'Pembayaran Angsuran, Angsuran Pokok', '1.1003', '1.2003'),
(5, '05', 'Pembayaran Angsuran, Angsuran Bunga', '1.1003', '3.1000'),
(6, '06', 'Pembayaran Angsuran, Angsuran Denda', '1.1003', '5.3000'),
(7, '07', 'Pembayaran Angsuran, Titipan Masuk', '1.1003', '2.3000'),
(8, '08', 'Pembayaran Angsuran, Titipan Keluar', '2.3000', '1.1003'),
(9, '09', 'Biaya-Biaya, Biaya Karyawan', '4.1000', '1.1003'),
(10, '10', 'Potongan', '4.7000', '1.1003');

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
(2, 1, 2019, '201901'),
(3, 11, 2018, '201811'),
(4, 12, 2018, '201812'),
(5, 12, 2018, '201812'),
(6, 1, 2019, '201901');

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
(1, 12, 2018, '201812');

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
(1, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(2, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-20'),
(3, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(4, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '3'),
(5, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(6, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(7, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(8, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(9, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(10, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(11, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(12, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(13, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(14, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '0'),
(15, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '0'),
(16, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(17, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(18, '2018-12-20 09:28:23', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(19, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-20'),
(20, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(21, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '200000'),
(22, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '1', '', '0'),
(23, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '1', '', '0'),
(24, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Angsuran_Ke', '1', '', '1'),
(25, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(26, '2018-12-20 09:52:13', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(27, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '2', '', '2018-12-20'),
(28, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '2', '', NULL),
(29, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '2', '', '250000'),
(30, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '2', '', '0'),
(31, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '2', '', '0'),
(32, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Angsuran_Ke', '2', '', '1'),
(33, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '2', '', '1'),
(34, '2018-12-20 09:56:31', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '2', '', '2'),
(35, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-20'),
(36, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(37, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(38, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '250000'),
(39, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '850000'),
(40, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(41, '2018-12-20 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(42, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '4', '', '2018-12-20'),
(43, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '4', '', NULL),
(44, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '4', '', '300000'),
(45, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Angsuran_Ke', '4', '', '0'),
(46, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '4', '', '1'),
(47, '2018-12-20 11:22:37', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '4', '', '4'),
(48, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', NULL, '2019-02-20'),
(49, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '2', NULL, '0'),
(50, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '2', NULL, '0'),
(51, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '2', NULL, '50000'),
(52, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '2', NULL, '1050000'),
(53, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '2', NULL, '1100000'),
(54, '2018-12-20 11:25:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '2', NULL, '201901'),
(55, '2018-12-20 11:33:02', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Bulan', '1', '1', '12'),
(56, '2018-12-20 11:33:02', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun', '1', '2019', '2018'),
(57, '2018-12-20 11:33:02', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun_Bulan', '1', '201901', '201812'),
(58, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(59, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-20'),
(60, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(61, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '2'),
(62, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(63, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(64, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(65, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(66, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(67, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(68, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(69, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(70, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(71, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '10000'),
(72, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '6000'),
(73, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(74, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(75, '2018-12-20 11:33:50', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(76, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(77, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-20'),
(78, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(79, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '2'),
(80, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(81, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(82, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(83, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(84, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(85, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(86, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(87, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(88, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(89, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '15000'),
(90, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '7000'),
(91, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(92, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(93, '2018-12-20 14:08:15', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(94, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-20'),
(95, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(96, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '300000'),
(97, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Angsuran_Ke', '1', '', '1'),
(98, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(99, '2018-12-20 14:31:32', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(100, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-20'),
(101, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(102, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(103, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '200000'),
(104, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '900000'),
(105, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(106, '2018-12-20 14:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(107, '2018-12-20 14:33:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '0'),
(108, '2018-12-20 14:33:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '1100000'),
(109, '2018-12-20 14:35:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '0.00', '200000'),
(110, '2018-12-20 14:35:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '1100000.00', '900000'),
(111, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(112, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-20'),
(113, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(114, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '3'),
(115, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(116, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(117, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(118, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(119, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(120, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(121, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(122, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(123, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(124, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '0'),
(125, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '0'),
(126, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(127, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(128, '2018-12-20 15:11:24', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(129, '2018-12-20 15:12:07', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-20'),
(130, '2018-12-20 15:12:07', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(131, '2018-12-20 15:12:07', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '275000'),
(132, '2018-12-20 15:12:07', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(133, '2018-12-20 15:12:07', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(134, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-24'),
(135, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '4'),
(136, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '17600'),
(137, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '275000'),
(138, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '825000'),
(139, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1117600'),
(140, '2018-12-20 15:13:03', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(141, '2018-12-20 15:14:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '275000.00', '175000'),
(142, '2018-12-20 15:14:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '825000.00', '925000'),
(143, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(144, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-20'),
(145, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(146, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '2'),
(147, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(148, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(149, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(150, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(151, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(152, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(153, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(154, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(155, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(156, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '0'),
(157, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '0'),
(158, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(159, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(160, '2018-12-20 15:20:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(161, '2018-12-20 15:21:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-20'),
(162, '2018-12-20 15:21:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(163, '2018-12-20 15:21:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '200000'),
(164, '2018-12-20 15:21:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(165, '2018-12-20 15:21:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(166, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-20'),
(167, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(168, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(169, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '200000'),
(170, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '900000'),
(171, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(172, '2018-12-20 15:21:43', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(173, '2018-12-20 15:22:20', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '150000'),
(174, '2018-12-20 15:22:20', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '950000'),
(175, '2018-12-20 15:24:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '150000.00', '100000'),
(176, '2018-12-20 15:24:13', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '950000.00', '1000000'),
(177, '2018-12-20 22:32:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(178, '2018-12-20 23:19:06', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '5', '', '2018-12-20'),
(179, '2018-12-20 23:19:06', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '5', '', NULL),
(180, '2018-12-20 23:19:06', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '5', '', '250000'),
(181, '2018-12-20 23:19:06', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '5', '', '1'),
(182, '2018-12-20 23:19:06', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '5', '', '5'),
(183, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '2'),
(184, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2018-12-21'),
(185, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '2'),
(186, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '2'),
(187, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '11400000'),
(188, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '12'),
(189, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.25'),
(190, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(191, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '3'),
(192, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '950000'),
(193, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '256000'),
(194, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '1206000'),
(195, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', NULL),
(196, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '0'),
(197, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '0'),
(198, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '1'),
(199, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201812'),
(200, '2018-12-21 18:54:16', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(201, '2018-12-21 18:55:56', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Pinjaman', '2', '11400000.00', '11500000.00'),
(202, '2018-12-21 18:55:56', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '2', '950000.00', '958333.3333333334'),
(203, '2018-12-21 18:55:56', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga', '2', '256000.00', '258750'),
(204, '2018-12-21 18:55:56', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '2', '1206000.00', '1217083.3333333335'),
(205, '2018-12-21 18:56:47', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '2', '958333.31', '959000'),
(206, '2018-12-21 18:56:47', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga', '2', '258750.00', '259000'),
(207, '2018-12-21 18:56:47', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '2', '1217083.38', '1218000'),
(208, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete begin ***', 't03_pinjaman', '', '', '', ''),
(209, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '37', '37', ''),
(210, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '37', '2', ''),
(211, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '37', '1', ''),
(212, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '37', '2019-01-21', ''),
(213, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '37', '959000.00', ''),
(214, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '37', '259000.00', ''),
(215, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '37', '1218000.00', ''),
(216, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '37', '10541000.00', ''),
(217, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '37', NULL, ''),
(218, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '37', NULL, ''),
(219, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '37', NULL, ''),
(220, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '37', NULL, ''),
(221, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '37', NULL, ''),
(222, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '37', NULL, ''),
(223, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '37', NULL, ''),
(224, '2018-12-21 19:08:34', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '37', NULL, ''),
(225, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '38', '38', ''),
(226, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '38', '2', ''),
(227, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '38', '2', ''),
(228, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '38', '2019-02-21', ''),
(229, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '38', '959000.00', ''),
(230, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '38', '259000.00', ''),
(231, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '38', '1218000.00', ''),
(232, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '38', '9582000.00', ''),
(233, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '38', NULL, ''),
(234, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '38', NULL, ''),
(235, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '38', NULL, ''),
(236, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '38', NULL, ''),
(237, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '38', NULL, ''),
(238, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '38', NULL, ''),
(239, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '38', NULL, ''),
(240, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '38', NULL, ''),
(241, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '39', '39', ''),
(242, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '39', '2', ''),
(243, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '39', '3', ''),
(244, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '39', '2019-03-21', ''),
(245, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '39', '959000.00', ''),
(246, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '39', '259000.00', ''),
(247, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '39', '1218000.00', ''),
(248, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '39', '8623000.00', ''),
(249, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '39', NULL, ''),
(250, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '39', NULL, ''),
(251, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '39', NULL, ''),
(252, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '39', NULL, ''),
(253, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '39', NULL, ''),
(254, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '39', NULL, ''),
(255, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '39', NULL, ''),
(256, '2018-12-21 19:08:35', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '39', NULL, ''),
(257, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '40', '40', ''),
(258, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '40', '2', ''),
(259, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '40', '4', ''),
(260, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '40', '2019-04-21', ''),
(261, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '40', '959000.00', ''),
(262, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '40', '259000.00', ''),
(263, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '40', '1218000.00', ''),
(264, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '40', '7664000.00', ''),
(265, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '40', NULL, ''),
(266, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '40', NULL, ''),
(267, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '40', NULL, ''),
(268, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '40', NULL, ''),
(269, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '40', NULL, ''),
(270, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '40', NULL, ''),
(271, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '40', NULL, ''),
(272, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '40', NULL, ''),
(273, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '41', '41', ''),
(274, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '41', '2', ''),
(275, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '41', '5', ''),
(276, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '41', '2019-05-21', ''),
(277, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '41', '959000.00', ''),
(278, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '41', '259000.00', ''),
(279, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '41', '1218000.00', ''),
(280, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '41', '6705000.00', ''),
(281, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '41', NULL, ''),
(282, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '41', NULL, ''),
(283, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '41', NULL, ''),
(284, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '41', NULL, ''),
(285, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '41', NULL, ''),
(286, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '41', NULL, ''),
(287, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '41', NULL, ''),
(288, '2018-12-21 19:08:36', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '41', NULL, ''),
(289, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '42', '42', ''),
(290, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '42', '2', ''),
(291, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '42', '6', ''),
(292, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '42', '2019-06-21', ''),
(293, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '42', '959000.00', ''),
(294, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '42', '259000.00', ''),
(295, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '42', '1218000.00', ''),
(296, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '42', '5746000.00', ''),
(297, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '42', NULL, ''),
(298, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '42', NULL, ''),
(299, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '42', NULL, ''),
(300, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '42', NULL, ''),
(301, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '42', NULL, ''),
(302, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '42', NULL, ''),
(303, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '42', NULL, ''),
(304, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '42', NULL, ''),
(305, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '43', '43', ''),
(306, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '43', '2', ''),
(307, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '43', '7', ''),
(308, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '43', '2019-07-21', ''),
(309, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '43', '959000.00', ''),
(310, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '43', '259000.00', ''),
(311, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '43', '1218000.00', ''),
(312, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '43', '4787000.00', ''),
(313, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '43', NULL, ''),
(314, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '43', NULL, ''),
(315, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '43', NULL, ''),
(316, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '43', NULL, ''),
(317, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '43', NULL, ''),
(318, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '43', NULL, ''),
(319, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '43', NULL, ''),
(320, '2018-12-21 19:08:37', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '43', NULL, ''),
(321, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '44', '44', ''),
(322, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '44', '2', ''),
(323, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '44', '8', ''),
(324, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '44', '2019-08-21', ''),
(325, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '44', '959000.00', ''),
(326, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '44', '259000.00', ''),
(327, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '44', '1218000.00', ''),
(328, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '44', '3828000.00', ''),
(329, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '44', NULL, ''),
(330, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '44', NULL, ''),
(331, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '44', NULL, ''),
(332, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '44', NULL, ''),
(333, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '44', NULL, ''),
(334, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '44', NULL, ''),
(335, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '44', NULL, ''),
(336, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '44', NULL, ''),
(337, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '45', '45', ''),
(338, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '45', '2', ''),
(339, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '45', '9', ''),
(340, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '45', '2019-09-21', ''),
(341, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '45', '959000.00', ''),
(342, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '45', '259000.00', ''),
(343, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '45', '1218000.00', ''),
(344, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '45', '2869000.00', ''),
(345, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '45', NULL, ''),
(346, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '45', NULL, ''),
(347, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '45', NULL, ''),
(348, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '45', NULL, ''),
(349, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '45', NULL, ''),
(350, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '45', NULL, ''),
(351, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '45', NULL, ''),
(352, '2018-12-21 19:08:38', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '45', NULL, ''),
(353, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '46', '46', ''),
(354, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '46', '2', ''),
(355, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '46', '10', ''),
(356, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '46', '2019-10-21', ''),
(357, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '46', '959000.00', ''),
(358, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '46', '259000.00', ''),
(359, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '46', '1218000.00', ''),
(360, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '46', '1910000.00', ''),
(361, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '46', NULL, ''),
(362, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '46', NULL, ''),
(363, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '46', NULL, ''),
(364, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '46', NULL, ''),
(365, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '46', NULL, ''),
(366, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '46', NULL, ''),
(367, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '46', NULL, ''),
(368, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '46', NULL, ''),
(369, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '47', '47', ''),
(370, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '47', '2', ''),
(371, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '47', '11', ''),
(372, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '47', '2019-11-21', ''),
(373, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '47', '959000.00', ''),
(374, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '47', '259000.00', ''),
(375, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '47', '1218000.00', ''),
(376, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '47', '951000.00', ''),
(377, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '47', NULL, ''),
(378, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '47', NULL, ''),
(379, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '47', NULL, ''),
(380, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '47', NULL, ''),
(381, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '47', NULL, '');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(382, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '47', NULL, ''),
(383, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '47', NULL, ''),
(384, '2018-12-21 19:08:39', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '47', NULL, ''),
(385, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'id', '48', '48', ''),
(386, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'pinjaman_id', '48', '2', ''),
(387, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Ke', '48', '12', ''),
(388, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Tanggal', '48', '2019-12-21', ''),
(389, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Pokok', '48', '951000.00', ''),
(390, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Bunga', '48', '267000.00', ''),
(391, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Angsuran_Total', '48', '1218000.00', ''),
(392, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Sisa_Hutang', '48', '0.00', ''),
(393, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '48', NULL, ''),
(394, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Terlambat', '48', NULL, ''),
(395, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Total_Denda', '48', NULL, ''),
(396, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '48', NULL, ''),
(397, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '48', NULL, ''),
(398, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Bayar_Total', '48', NULL, ''),
(399, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Keterangan', '48', NULL, ''),
(400, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't04_pinjamanangsurantemp', 'Periode', '48', NULL, ''),
(401, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'id', '2', '2', ''),
(402, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_No', '2', '2', ''),
(403, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Kontrak_Tgl', '2', '2018-12-21', ''),
(404, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'nasabah_id', '2', '2', ''),
(405, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'jaminan_id', '2', '2', ''),
(406, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Pinjaman', '2', '11500000.00', ''),
(407, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Lama', '2', '12', ''),
(408, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '2.25', ''),
(409, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Denda', '2', '0.40', ''),
(410, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Dispensasi_Denda', '2', '3', ''),
(411, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Pokok', '2', '959000.00', ''),
(412, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Bunga', '2', '259000.00', ''),
(413, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Angsuran_Total', '2', '1218000.00', ''),
(414, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'No_Ref', '2', NULL, ''),
(415, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Administrasi', '2', '0.00', ''),
(416, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Biaya_Materai', '2', '0.00', ''),
(417, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'marketing_id', '2', '1', ''),
(418, '2018-12-21 19:08:40', '/simkop5/t03_pinjamandelete.php', '1', 'D', 't03_pinjaman', 'Periode', '2', '201812', ''),
(419, '2018-12-21 19:08:41', '/simkop5/t03_pinjamandelete.php', '1', '*** Batch delete successful ***', 't03_pinjaman', '', '', '', ''),
(420, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '3', '', '2'),
(421, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '3', '', '2018-12-21'),
(422, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '3', '', '2'),
(423, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '3', '', '2'),
(424, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '3', '', '11400000'),
(425, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '3', '', '12'),
(426, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '', '2.25'),
(427, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '3', '', '0.4'),
(428, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '3', '', '3'),
(429, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '3', '', '950000'),
(430, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '3', '', '257000'),
(431, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '3', '', '1207000'),
(432, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '3', '', NULL),
(433, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '3', '', '0'),
(434, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '3', '', '0'),
(435, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '3', '', '1'),
(436, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '3', '', '201812'),
(437, '2018-12-21 19:10:55', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '3', '', '3'),
(438, '2018-12-21 19:11:44', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Pinjaman', '3', '11400000.00', '11500000'),
(439, '2018-12-21 19:11:44', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '3', '950000.00', '959000'),
(440, '2018-12-21 19:11:44', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga', '3', '257000.00', '259000'),
(441, '2018-12-21 19:11:44', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '3', '1207000.00', '1218000'),
(442, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '61', NULL, '2019-01-25'),
(443, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '61', NULL, '4'),
(444, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '61', NULL, '19488'),
(445, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '61', NULL, '0'),
(446, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '61', NULL, '1218000'),
(447, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '61', NULL, '1237488'),
(448, '2018-12-21 19:29:52', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '61', NULL, '201812'),
(449, '2018-12-21 19:31:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '6', '', '2018-12-21'),
(450, '2018-12-21 19:31:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '6', '', '-'),
(451, '2018-12-21 19:31:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '6', '', '200000'),
(452, '2018-12-21 19:31:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '6', '', '3'),
(453, '2018-12-21 19:31:02', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '6', '', '6'),
(454, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '62', NULL, '2019-02-21'),
(455, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '62', NULL, '0'),
(456, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '62', NULL, '0'),
(457, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '62', NULL, '200000'),
(458, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '62', NULL, '1018000'),
(459, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '62', NULL, '1218000'),
(460, '2018-12-21 19:32:47', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '62', NULL, '201901'),
(461, '2018-12-21 19:33:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '62', '200000.00', '175000'),
(462, '2018-12-21 19:33:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '62', '1018000.00', '1043000'),
(463, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '63', NULL, '2019-03-21'),
(464, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '63', NULL, '0'),
(465, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '63', NULL, '0'),
(466, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '63', NULL, '25000'),
(467, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '63', NULL, '1193000'),
(468, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '63', NULL, '1218000'),
(469, '2018-12-21 19:52:27', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '63', NULL, '201902'),
(470, '2018-12-21 21:27:44', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Bulan', '1', '2', '12'),
(471, '2018-12-21 21:27:44', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun', '1', '2019', '2018'),
(472, '2018-12-21 21:27:44', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun_Bulan', '1', '201902', '201812'),
(473, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(474, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-21'),
(475, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(476, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '2'),
(477, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(478, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(479, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(480, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(481, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(482, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(483, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(484, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(485, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(486, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '0'),
(487, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '0'),
(488, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(489, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(490, '2018-12-21 21:28:43', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(491, '2018-12-21 21:30:24', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-21'),
(492, '2018-12-21 21:30:24', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(493, '2018-12-21 21:30:24', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '200000'),
(494, '2018-12-21 21:30:24', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(495, '2018-12-21 21:30:24', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(496, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-21'),
(497, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(498, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(499, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '200000'),
(500, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '900000'),
(501, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(502, '2018-12-21 21:30:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(503, '2018-12-21 21:31:20', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '160000'),
(504, '2018-12-21 21:31:20', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '940000'),
(505, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '1'),
(506, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2018-12-21'),
(507, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '2'),
(508, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '2'),
(509, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(510, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(511, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(512, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(513, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(514, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(515, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(516, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(517, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(518, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '0'),
(519, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '0'),
(520, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(521, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201812'),
(522, '2018-12-21 21:50:46', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(523, '2018-12-21 21:51:40', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-12-21'),
(524, '2018-12-21 21:51:40', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', NULL),
(525, '2018-12-21 21:51:40', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '250000'),
(526, '2018-12-21 21:51:40', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(527, '2018-12-21 21:51:40', '/simkop5/t06_pinjamantitipanadd.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(528, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', NULL, '2019-01-21'),
(529, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', NULL, '0'),
(530, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', NULL, '0'),
(531, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', NULL, '250000'),
(532, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', NULL, '850000'),
(533, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', NULL, '1100000'),
(534, '2018-12-21 21:52:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', NULL, '201812'),
(535, '2018-12-21 21:54:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '250000.00', '200000'),
(536, '2018-12-21 21:54:25', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '850000.00', '900000'),
(537, '2018-12-21 22:21:15', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '0'),
(538, '2018-12-21 22:21:15', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '1100000'),
(539, '2018-12-21 22:24:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '0.00', '200000'),
(540, '2018-12-21 22:24:00', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '1100000.00', '900000'),
(541, '2018-12-21 22:24:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '250000'),
(542, '2018-12-21 22:24:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '850000'),
(543, '2018-12-21 22:28:22', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '250000.00', '200000'),
(544, '2018-12-21 22:28:22', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '850000.00', '900000'),
(545, '2018-12-21 22:29:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '200000.00', '100000'),
(546, '2018-12-21 22:29:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '900000.00', '1000000'),
(547, '2018-12-21 22:29:45', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '100000.00', '0'),
(548, '2018-12-21 22:29:45', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '1000000.00', '1100000'),
(549, '2019-01-17 11:58:02', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(550, '2019-01-17 15:32:17', '/simkop5/t01_nasabahedit.php', '1', 'U', 't01_nasabah', 'marketing_id', '1', '0', '1'),
(551, '2019-01-17 15:32:17', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update begin ***', 't02_jaminan', '', '', '', ''),
(552, '2019-01-17 15:32:17', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update successful ***', 't02_jaminan', '', '', '', ''),
(553, '2019-01-17 15:32:28', '/simkop5/t01_nasabahedit.php', '1', 'U', 't01_nasabah', 'marketing_id', '2', '0', '2'),
(554, '2019-01-17 15:32:28', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update begin ***', 't02_jaminan', '', '', '', ''),
(555, '2019-01-17 15:32:28', '/simkop5/t01_nasabahedit.php', '1', '*** Batch update successful ***', 't02_jaminan', '', '', '', ''),
(556, '2019-01-21 09:27:05', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(557, '2019-01-21 13:31:50', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(558, '2019-01-21 13:47:03', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(559, '2019-01-24 10:12:24', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(560, '2019-01-25 14:12:04', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(561, '2019-01-28 10:19:14', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(562, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '2'),
(563, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2019-01-28'),
(564, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '1'),
(565, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '1'),
(566, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '11400000'),
(567, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '12'),
(568, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.25'),
(569, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(570, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '3'),
(571, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '950000'),
(572, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '256500'),
(573, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '1206500'),
(574, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', NULL),
(575, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '0'),
(576, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '0'),
(577, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '1'),
(578, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201812'),
(579, '2019-01-28 11:02:35', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(580, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '3', '', '3'),
(581, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '3', '', '2019-01-28'),
(582, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '3', '', '2'),
(583, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '3', '', '2,3'),
(584, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '3', '', '12400000'),
(585, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '3', '', '12'),
(586, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '', '2.25'),
(587, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '3', '', '0.4'),
(588, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '3', '', '3'),
(589, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '3', '', '1033333.3333333334'),
(590, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '3', '', '279000'),
(591, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '3', '', '1312333.3333333335'),
(592, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '3', '', NULL),
(593, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '3', '', '0'),
(594, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '3', '', '0'),
(595, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '3', '', '1'),
(596, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '3', '', '201812'),
(597, '2019-01-28 11:20:07', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '3', '', '3'),
(598, '2019-01-28 12:05:43', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '3', '1033333.31', '1034000'),
(599, '2019-01-28 12:05:43', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '3', '1312333.38', '1313000'),
(600, '2019-01-28 12:07:48', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Pinjaman', '3', '12400000.00', '12500000'),
(601, '2019-01-28 12:07:48', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '2.25', '2.26'),
(602, '2019-01-28 12:07:48', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '3', '1034000.00', '1042000'),
(603, '2019-01-28 12:07:48', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga', '3', '279000.00', '282000'),
(604, '2019-01-28 12:07:48', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '3', '1313000.00', '1324000'),
(605, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', NULL, '2019-01-28'),
(606, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '2', NULL, '-24'),
(607, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '2', NULL, '0'),
(608, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '2', NULL, '250000'),
(609, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '2', NULL, '850000'),
(610, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '2', NULL, '1100000'),
(611, '2019-01-28 15:15:40', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '2', NULL, '201812'),
(612, '2019-01-29 10:26:28', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(613, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '4', '', '3a'),
(614, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '4', '', '2019-01-29'),
(615, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '4', '', '2'),
(616, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '4', '', '2,3'),
(617, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '4', '', '12500000.00'),
(618, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '4', '', '12'),
(619, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '4', '', '2.26'),
(620, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '4', '', '0.40'),
(621, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '4', '', '3'),
(622, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '4', '', '1042000.00'),
(623, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '4', '', '282000.00'),
(624, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '4', '', '1324000.00'),
(625, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '4', '', NULL),
(626, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '4', '', '0.00'),
(627, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '4', '', '0.00'),
(628, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '4', '', '1'),
(629, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '4', '', '201812'),
(630, '2019-01-29 11:24:09', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '4', '', '4'),
(631, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '49', NULL, '2019-01-29'),
(632, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '49', NULL, '-30'),
(633, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '49', NULL, '0'),
(634, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '49', NULL, '0'),
(635, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '49', NULL, '1324000'),
(636, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '49', NULL, '1324000'),
(637, '2019-01-29 11:24:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '49', NULL, '201812'),
(638, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '3', '', 'Hendra'),
(639, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '3', '', '-'),
(640, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '3', '', '-'),
(641, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '3', '', '-'),
(642, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '3', '', '-'),
(643, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '3', '', '-'),
(644, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '3', '', '2'),
(645, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '3', '', NULL),
(646, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '3', '', '2'),
(647, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '3', '', '3'),
(648, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(649, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '4', '', '3'),
(650, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '4', '', 'ATM'),
(651, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '4', '', NULL),
(652, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '4', '', NULL),
(653, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '4', '', NULL),
(654, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '4', '', NULL),
(655, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '4', '', NULL),
(656, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '4', '', NULL),
(657, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '4', '', '4'),
(658, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '5', '', '3'),
(659, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '5', '', 'I'),
(660, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '5', '', NULL),
(661, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '5', '', NULL),
(662, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '5', '', NULL),
(663, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '5', '', NULL),
(664, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '5', '', NULL),
(665, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '5', '', NULL),
(666, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '5', '', '5'),
(667, '2019-01-29 12:44:42', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(668, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '5', '', '3b'),
(669, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '5', '', '2019-01-29'),
(670, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '5', '', '2'),
(671, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '5', '', '2,3'),
(672, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '5', '', '13500000'),
(673, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '5', '', '12'),
(674, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '5', '', '2.26'),
(675, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '5', '', '0.40'),
(676, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '5', '', '3'),
(677, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '5', '', '1125000'),
(678, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '5', '', '305100'),
(679, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '5', '', '1430100'),
(680, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '5', '', NULL),
(681, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '5', '', '0.00'),
(682, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '5', '', '0.00'),
(683, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '5', '', '1'),
(684, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '5', '', '201812'),
(685, '2019-01-29 14:03:19', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '5', '', '5'),
(686, '2019-01-29 14:04:11', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Pinjaman', '4', '12500000.00', '13000000'),
(687, '2019-01-29 14:04:11', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Pokok', '4', '1042000.00', '1083333.3333333333'),
(688, '2019-01-29 14:04:11', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Bunga', '4', '282000.00', '293800'),
(689, '2019-01-29 14:04:11', '/simkop5/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Angsuran_Total', '4', '1324000.00', '1377133.3333333333'),
(690, '2019-01-29 15:05:28', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '10', '', '10'),
(691, '2019-01-29 15:05:28', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '10', '', 'Potongan'),
(692, '2019-01-29 15:05:28', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '10', '', '4.7000'),
(693, '2019-01-29 15:05:28', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '10', '', '1.1003'),
(694, '2019-01-29 15:05:28', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '10', '', '10'),
(695, '2019-01-29 15:43:03', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Tanggal', '1', '', '2019-01-29'),
(696, '2019-01-29 15:43:03', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Keterangan', '1', '', NULL),
(697, '2019-01-29 15:43:03', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Jumlah', '1', '', '17500'),
(698, '2019-01-29 15:43:03', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'pinjaman_id', '1', '', '5'),
(699, '2019-01-29 15:43:03', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'id', '1', '', '1'),
(700, '2019-01-30 00:48:48', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t07_marketing`
--
ALTER TABLE `t07_marketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t08_pinjamanpotongan`
--
ALTER TABLE `t08_pinjamanpotongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t09_jurnaltransaksi`
--
ALTER TABLE `t09_jurnaltransaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t10_jurnal`
--
ALTER TABLE `t10_jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `t11_jurnalmaster`
--
ALTER TABLE `t11_jurnalmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t12_jurnaldetail`
--
ALTER TABLE `t12_jurnaldetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t89_rektran`
--
ALTER TABLE `t89_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t90_rektran`
--
ALTER TABLE `t90_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
