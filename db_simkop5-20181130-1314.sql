-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2018 at 07:14 AM
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
  `Pekerjaan_No_Telp_Hp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Nama`, `Alamat`, `No_Telp_Hp`, `Pekerjaan`, `Pekerjaan_Alamat`, `Pekerjaan_No_Telp_Hp`) VALUES
(1, 'Andoko', '-', '-', '-', '-', '-'),
(2, 'Dodo', '-', '-', '-', '-', '-');

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
(3, 2, 'Ijasah', NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, '1', '2018-11-08', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 0.00, 0.00, 2, '201812'),
(2, '2', '2018-11-08', 1, '1', 10500000.00, 12, '2.25', '0.40', 3, 875000.00, 236250.00, 1111250.00, NULL, 0.00, 0.00, 2, '201811'),
(3, '3', '2018-11-08', 1, '1', 10600000.00, 12, '2.25', '0.40', 3, 883333.31, 238500.00, 1121833.38, NULL, 0.00, 0.00, 1, '201811');

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
(1, 1, 1, '2018-12-08', 867000.00, 233000.00, 1100000.00, 9533000.00, '2018-12-08', 0, 0.00, 300000.00, 800000.00, 1100000.00, NULL, '201812'),
(2, 1, 2, '2019-01-08', 867000.00, 233000.00, 1100000.00, 8666000.00, '2019-01-08', 0, 0.00, 175000.00, 925000.00, 1100000.00, NULL, '201901'),
(3, 1, 3, '2019-02-08', 867000.00, 233000.00, 1100000.00, 7799000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, '2019-03-08', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, '2019-04-08', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, '2019-05-08', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, '2019-06-08', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, '2019-07-08', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, '2019-08-08', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, '2019-09-08', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, '2019-10-08', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2019-11-08', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 1, '2018-12-08', 875000.00, 236250.00, 1111250.00, 9625000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 2, '2019-01-08', 875000.00, 236250.00, 1111250.00, 8750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 2, 3, '2019-02-08', 875000.00, 236250.00, 1111250.00, 7875000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 4, '2019-03-08', 875000.00, 236250.00, 1111250.00, 7000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 2, 5, '2019-04-08', 875000.00, 236250.00, 1111250.00, 6125000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 2, 6, '2019-05-08', 875000.00, 236250.00, 1111250.00, 5250000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 7, '2019-06-08', 875000.00, 236250.00, 1111250.00, 4375000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 2, 8, '2019-07-08', 875000.00, 236250.00, 1111250.00, 3500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 2, 9, '2019-08-08', 875000.00, 236250.00, 1111250.00, 2625000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 10, '2019-09-08', 875000.00, 236250.00, 1111250.00, 1750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 11, '2019-10-08', 875000.00, 236250.00, 1111250.00, 875000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 12, '2019-11-08', 875000.00, 236250.00, 1111250.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 3, 1, '2018-12-08', 883333.31, 238500.00, 1121833.38, 9716667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 3, 2, '2019-01-08', 883333.31, 238500.00, 1121833.38, 8833333.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 3, 3, '2019-02-08', 883333.31, 238500.00, 1121833.38, 7950000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 3, 4, '2019-03-08', 883333.31, 238500.00, 1121833.38, 7066666.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 3, 5, '2019-04-08', 883333.31, 238500.00, 1121833.38, 6183333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 3, 6, '2019-05-08', 883333.31, 238500.00, 1121833.38, 5300000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 3, 7, '2019-06-08', 883333.31, 238500.00, 1121833.38, 4416666.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 3, 8, '2019-07-08', 883333.31, 238500.00, 1121833.38, 3533333.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 3, 9, '2019-08-08', 883333.31, 238500.00, 1121833.38, 2650000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 3, 10, '2019-09-08', 883333.31, 238500.00, 1121833.38, 1766666.62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 3, 11, '2019-10-08', 883333.31, 238500.00, 1121833.38, 883333.31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 3, 12, '2019-11-08', 883333.31, 238500.00, 1121833.38, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 1, '2018-11-12', NULL, 300000.00, 0.00, 300000.00, 0),
(7, 1, '2018-12-08', 'Pembayaran Angsuran Ke-1', 0.00, 300000.00, 0.00, 1),
(8, 1, '2019-01-08', NULL, 175000.00, 0.00, 175000.00, 0),
(9, 1, '2019-01-08', 'Pembayaran Angsuran Ke-2', 0.00, 175000.00, 0.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `t07_marketing`
--

CREATE TABLE `t07_marketing` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t07_marketing`
--

INSERT INTO `t07_marketing` (`id`, `Nama`) VALUES
(1, 'Adi'),
(2, 'Ali');

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
(1, 1, '2018-11-08', NULL, 250000.00);

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
(1, '1.1001', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', NULL, 'yes'),
(1, '1.1002', 'KAS BANK - BCA MOJOKERTO', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes'),
(1, '1.1003', 'KAS BESAR - BANK', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes'),
(1, '1.1004', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2004', 'PIUTANG KEDIRI', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2005', 'PIUTANG KPL 5', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2006', 'PIUTANG TROSOBO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2007', 'PIUTANG DANIEL', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.2008', 'PIUTANG ANDIK', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes'),
(1, '1.3000', 'PERSEDIAAN KANTOR', 'DETAIL', 'DEBET', 'NERACA', NULL, '1', NULL, 'yes'),
(1, '1.4000', 'AKUMULASI PENYUSUTAN', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes'),
(2, '2', 'PASSIVA', 'GROUP', 'CREDIT', 'NERACA', '', '', '', 'yes'),
(2, '2.1000', 'HUTANG PUCANG', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes'),
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
(3, 11, 2018, '201811');

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
(1, '2018-11-08 16:08:53', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-11-08 16:09:00', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2018-11-08 16:17:26', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2018-11-08 16:28:37', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(5, '2018-11-08 18:48:44', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(6, '2018-11-08 18:49:29', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Bulan', '1', '2', '11'),
(7, '2018-11-08 18:49:29', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun', '1', '2019', '2018'),
(8, '2018-11-08 18:49:29', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun_Bulan', '1', '201902', '201811'),
(9, '2018-11-08 19:07:55', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(10, '2018-11-08 20:22:37', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(11, '2018-11-08 20:27:38', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(12, '2018-11-08 20:29:08', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(13, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '2'),
(14, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2018-11-08'),
(15, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '1'),
(16, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '1'),
(17, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '10500000'),
(18, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '12'),
(19, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.25'),
(20, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(21, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '3'),
(22, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '875000'),
(23, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '236250'),
(24, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '1111250'),
(25, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', NULL),
(26, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '0'),
(27, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '0'),
(28, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '2'),
(29, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201811'),
(30, '2018-11-08 20:47:39', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(31, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '3', '', '3'),
(32, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '3', '', '2018-11-08'),
(33, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '3', '', '1'),
(34, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '3', '', '1'),
(35, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '3', '', '10600000'),
(36, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '3', '', '12'),
(37, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '', '2.25'),
(38, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '3', '', '0.4'),
(39, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '3', '', '3'),
(40, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '3', '', '883333.3333333334'),
(41, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '3', '', '238500'),
(42, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '3', '', '1121833.3333333335'),
(43, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '3', '', NULL),
(44, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '3', '', '0'),
(45, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '3', '', '0'),
(46, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '3', '', '1'),
(47, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '3', '', '201811'),
(48, '2018-11-08 21:21:52', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '3', '', '3'),
(49, '2018-11-09 00:56:10', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(50, '2018-11-09 00:56:27', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(51, '2018-11-09 01:59:23', '/simkop5/t94_logdelete.php', '1', '*** Batch delete begin ***', 't94_log', '', '', '', ''),
(52, '2018-11-09 01:59:23', '/simkop5/t94_logdelete.php', '1', 'D', 't94_log', 'id', '7', '7', ''),
(53, '2018-11-09 01:59:23', '/simkop5/t94_logdelete.php', '1', 'D', 't94_log', 'index_', '7', '4', ''),
(54, '2018-11-09 01:59:23', '/simkop5/t94_logdelete.php', '1', 'D', 't94_log', 'subj_', '7', 'pinjaman - jaminan', ''),
(55, '2018-11-09 01:59:23', '/simkop5/t94_logdelete.php', '1', '*** Batch delete successful ***', 't94_log', '', '', '', ''),
(56, '2018-11-09 02:00:10', '/simkop5/t94_loglist.php', '1', 'U', 't94_log', 'subj_', '2', 'pinjaman - master', 'pinjaman'),
(57, '2018-11-09 02:00:31', '/simkop5/t94_loglist.php', '1', 'U', 't94_log', 'index_', '6', '5', '4'),
(58, '2018-11-09 02:01:45', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '9', '', '5'),
(59, '2018-11-09 02:01:45', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '9', '', 'tutup buku'),
(60, '2018-11-09 02:01:45', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '9', '', '9'),
(61, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', '*** Batch update begin ***', 't94_log', '', '', '', ''),
(62, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '10', '', '6'),
(63, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '10', '', 'list - pinjaman'),
(64, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '10', '', '10'),
(65, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '11', '', '7'),
(66, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '11', '', 'list - activity log'),
(67, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '11', '', '11'),
(68, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '12', '', '8'),
(69, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '12', '', 'setup - nasabah'),
(70, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '12', '', '12'),
(71, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '13', '', '9'),
(72, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '13', '', 'setup - marketing'),
(73, '2018-11-09 02:06:12', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '13', '', '13'),
(74, '2018-11-09 02:06:13', '/simkop5/t94_loglist.php', '1', '*** Batch update successful ***', 't94_log', '', '', '', ''),
(75, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', '*** Batch update begin ***', 't94_log', '', '', '', ''),
(76, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '14', '', '10'),
(77, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '14', '', 'setup - periode'),
(78, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '14', '', '14'),
(79, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '15', '', '11'),
(80, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '15', '', 'setup - users'),
(81, '2018-11-09 02:07:52', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '15', '', '15'),
(82, '2018-11-09 02:07:53', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'index_', '16', '', '12'),
(83, '2018-11-09 02:07:53', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'subj_', '16', '', 'setup - hak akses'),
(84, '2018-11-09 02:07:53', '/simkop5/t94_loglist.php', '1', 'A', 't94_log', 'id', '16', '', '16'),
(85, '2018-11-09 02:07:53', '/simkop5/t94_loglist.php', '1', '*** Batch update successful ***', 't94_log', '', '', '', ''),
(86, '2018-11-09 02:09:06', '/simkop5/t95_logdesclist.php', '1', 'A', 't95_logdesc', 'log_id', '18', '', '15'),
(87, '2018-11-09 02:09:06', '/simkop5/t95_logdesclist.php', '1', 'A', 't95_logdesc', 'date_issued', '18', '', '2018-11-09'),
(88, '2018-11-09 02:09:06', '/simkop5/t95_logdesclist.php', '1', 'A', 't95_logdesc', 'desc_', '18', '', 'definisikan perbedaan hak akses'),
(89, '2018-11-09 02:09:06', '/simkop5/t95_logdesclist.php', '1', 'A', 't95_logdesc', 'date_solved', '18', '', NULL),
(90, '2018-11-09 02:09:06', '/simkop5/t95_logdesclist.php', '1', 'A', 't95_logdesc', 'id', '18', '', '18'),
(91, '2018-11-09 10:46:04', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(92, '2018-11-09 13:39:01', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(93, '2018-11-09 13:39:12', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(94, '2018-11-23 11:38:58', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(95, '2018-11-23 12:59:50', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(96, '2018-11-23 12:59:57', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(97, '2018-11-26 12:19:45', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(98, '2018-11-26 14:51:52', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(99, '2018-11-27 10:22:17', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(100, '2018-11-30 10:57:51', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(101, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'group', '1.5000', '', '1'),
(102, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'parent', '1.5000', '', '1'),
(103, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id3', '1.5000', '', '1.5000'),
(104, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'rekening', '1.5000', '', 'KAS COBA'),
(105, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'keterangan', '1.5000', '', NULL),
(106, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'tipe', '1.5000', '', 'DETAIL'),
(107, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'status', '1.5000', '', NULL),
(108, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id', '1.5000', '', '1.5000'),
(109, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'posisi', '1.5000', '', 'DEBET'),
(110, '2018-11-30 11:39:30', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'laporan', '1.5000', '', 'NERACA'),
(111, '2018-11-30 11:40:01', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'parent', '1.5000', '1', '1.1000'),
(112, '2018-11-30 11:40:01', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'id3', '1.5000', '1.5000', '1.1005'),
(113, '2018-11-30 11:40:01', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'status', '1.5000', NULL, 'KAS/BANK'),
(114, '2018-11-30 11:40:01', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'id', '1.5000', '1.5000', '1.1005'),
(115, '2018-11-30 11:40:36', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'id3', '1.1005', '1.1005', '1.5000'),
(116, '2018-11-30 11:40:36', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'tipe', '1.1005', 'DETAIL', 'HEADER'),
(117, '2018-11-30 11:40:36', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'status', '1.1005', 'KAS/BANK', NULL),
(118, '2018-11-30 11:40:36', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'id', '1.1005', '1.1005', '1.5000'),
(119, '2018-11-30 11:40:44', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'parent', '1.5000', '1.1000', '1'),
(120, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'group', '1.5001', '', '1'),
(121, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'parent', '1.5001', '', '1.5000'),
(122, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id3', '1.5001', '', '1.5001'),
(123, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'rekening', '1.5001', '', 'KAS COBA DETAIL'),
(124, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'keterangan', '1.5001', '', NULL),
(125, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'tipe', '1.5001', '', 'DETAIL'),
(126, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'status', '1.5001', '', 'KAS/BANK'),
(127, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id', '1.5001', '', '1.5001'),
(128, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'posisi', '1.5001', '', 'DEBET'),
(129, '2018-11-30 11:41:09', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'laporan', '1.5001', '', 'NERACA'),
(130, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', '*** Batch delete begin ***', 't91_rekening', '', '', '', ''),
(131, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'group', '1.5001', '1', ''),
(132, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id', '1.5001', '1.5001', ''),
(133, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'rekening', '1.5001', 'KAS COBA DETAIL', ''),
(134, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'tipe', '1.5001', 'DETAIL', ''),
(135, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'posisi', '1.5001', 'DEBET', ''),
(136, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'laporan', '1.5001', 'NERACA', ''),
(137, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'status', '1.5001', 'KAS/BANK', ''),
(138, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'parent', '1.5001', '1.5000', ''),
(139, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'keterangan', '1.5001', NULL, ''),
(140, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'active', '1.5001', 'yes', ''),
(141, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id1', '1.5001', '', ''),
(142, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id2', '1.5001', '1.5001', ''),
(143, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id3', '1.5001', '1.5001', ''),
(144, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'group2', '1.5001', '1', ''),
(145, '2018-11-30 11:41:20', '/simkop5/t91_rekeningdelete.php', '1', '*** Batch delete successful ***', 't91_rekening', '', '', '', ''),
(146, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', '*** Batch delete begin ***', 't91_rekening', '', '', '', ''),
(147, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'group', '1.5000', '1', ''),
(148, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id', '1.5000', '1.5000', ''),
(149, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'rekening', '1.5000', 'KAS COBA', ''),
(150, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'tipe', '1.5000', 'HEADER', ''),
(151, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'posisi', '1.5000', 'DEBET', ''),
(152, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'laporan', '1.5000', 'NERACA', ''),
(153, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'status', '1.5000', NULL, ''),
(154, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'parent', '1.5000', '1', ''),
(155, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'keterangan', '1.5000', NULL, ''),
(156, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'active', '1.5000', 'yes', ''),
(157, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id1', '1.5000', '1.5000', ''),
(158, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id2', '1.5000', '', ''),
(159, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'id3', '1.5000', '1.5000', ''),
(160, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', 'D', 't91_rekening', 'group2', '1.5000', '1', ''),
(161, '2018-11-30 11:41:24', '/simkop5/t91_rekeningdelete.php', '1', '*** Batch delete successful ***', 't91_rekening', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
