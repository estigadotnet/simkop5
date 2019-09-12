-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 12, 2019 at 06:09 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

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
  `Status` tinyint(4) NOT NULL DEFAULT 0,
  `Keterangan` varchar(100) DEFAULT NULL,
  `marketing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Nama`, `Alamat`, `No_Telp_Hp`, `Pekerjaan`, `Pekerjaan_Alamat`, `Pekerjaan_No_Telp_Hp`, `Status`, `Keterangan`, `marketing_id`) VALUES
(1, 'HARI', 'GUBENG KERTAJAYA SE / 21 B KAV TEKOM BLOK Q NO 9', '087.7019.40292', 'PT. IRAWAN DJAJA AGUNG', 'RAYA SUKODONO KM 3-8 SIDOARJO', '031-7882381', 1, 'RUMAH SESUAI', 1),
(2, 'BIMA SAPUTRA', 'PERUM PONDOK MUTIARA HARUM AO 12 A JATI SIDOARJO', '088.2261.24735', 'PT. WAHANA TUNAS UTAMA', 'WONOSARI, DS WATESNEGORO, NGORO GUNUNGSARI MOJOKERTO', '0321-6819010', 2, 'ALAMAT TIDAK SESUAI', 2),
(3, 'ANDRIAN YONAS ISNANDAR', 'RUSUN PENJARINGANSARI BLOK A 31 A SURABAYA', '089.9355.5870', 'PT. SHELTER NUSANTARA', 'MEDOKAN SEMAMPIR SELATAN VA NO. 8', '031-5925075', 1, 'ALAMAT SESUAI', 1),
(4, 'DHART0 DJUNAIDI', 'TROSOBO UTAMA VII H/20 (21/5) SIDODADI TAMAN', '082.1433.14889', 'PT. CITRA GARDA INTERNUSA', 'TAMAN NAGOYA F1 NO. 55 GEDANGAN SIDOARJO', '082.1430.59766', 1, 'HUTANG PINJAMAN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t02_jaminan`
--

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Merk_Type` text NOT NULL,
  `No_Rangka` text DEFAULT NULL,
  `No_Mesin` text DEFAULT NULL,
  `Warna` text DEFAULT NULL,
  `No_Pol` text DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `Atas_Nama` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_jaminan`
--

INSERT INTO `t02_jaminan` (`id`, `nasabah_id`, `Merk_Type`, `No_Rangka`, `No_Mesin`, `Warna`, `No_Pol`, `Keterangan`, `Atas_Nama`) VALUES
(1, 1, 'BUKU TABUNGAN + ATM MANDIRI', '088.999.88888 AN HARI', '', '', '', '', ''),
(2, 1, 'AKTA KELAHIRAN', '289000000', '', '', '', '', ''),
(3, 1, 'IJAZAH SD', '', '', '', '', '', ''),
(4, 1, 'JAMSOSTEK', '', '', '', '', '', ''),
(5, 1, 'KARTU KELUARGA', '', '', '', '', '', ''),
(6, 1, 'BUKU NIKAH SUAMI N ISTRI', '', '', '', '', '', ''),
(7, 2, 'JAMSOSTEK', '', '', '', '', '', ''),
(8, 2, 'BUKU TABUNGAN + ATM BRI', '', '', '', '', '', ''),
(9, 2, 'KARTU KELUARGA', '', '', '', '', '', ''),
(10, 2, 'IJAZAH SMA', '', '', '', '', '', ''),
(11, 3, 'BUKU TABUNGAN + ATM BCA', '', '', '', '', '', ''),
(12, 3, 'JAMSOSTEK', '', '', '', '', '', ''),
(13, 3, 'KARTU KELUARGA', '', '', '', '', '', ''),
(14, 3, 'IJAZAH SMK', '', '', '', '', '', ''),
(15, 4, 'BUKU TABUNGAN + ATM MANDIRI', '', '', '', '', '', ''),
(16, 4, 'JAMSOSTEK', '', '', '', '', '', ''),
(17, 4, 'AKTA LAHIR', '', '', '', '', '', ''),
(18, 4, 'IJAZAH SMP', '', '', '', '', '', ''),
(19, 4, '2 BUKU NIKAH', '', '', '', '', '', '');

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
  `Angsuran_Bunga_Prosen` decimal(5,2) NOT NULL DEFAULT 2.25,
  `Angsuran_Denda` decimal(5,2) NOT NULL DEFAULT 0.40,
  `Dispensasi_Denda` tinyint(4) NOT NULL DEFAULT 3,
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `No_Ref` varchar(25) DEFAULT NULL,
  `Biaya_Administrasi` float(14,2) NOT NULL DEFAULT 0.00,
  `Biaya_Materai` float(14,2) NOT NULL DEFAULT 0.00,
  `marketing_id` int(11) NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `Macet` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_pinjaman`
--

INSERT INTO `t03_pinjaman` (`id`, `Kontrak_No`, `Kontrak_Tgl`, `nasabah_id`, `jaminan_id`, `Pinjaman`, `Angsuran_Lama`, `Angsuran_Bunga_Prosen`, `Angsuran_Denda`, `Dispensasi_Denda`, `Angsuran_Pokok`, `Angsuran_Bunga`, `Angsuran_Total`, `No_Ref`, `Biaya_Administrasi`, `Biaya_Materai`, `marketing_id`, `Periode`, `Macet`) VALUES
(1, '60001', '2019-03-04', 1, '1,2,3,4,5,6', 10400000.00, 10, '2.40', '0.40', 5, 1040000.00, 250000.00, 1290000.00, '', 500000.00, 18000.00, 1, '201903', 'N'),
(2, '60002', '2019-03-01', 3, '11,12,13,14', 4160000.00, 6, '2.24', '0.40', 5, 694000.00, 93000.00, 787000.00, '', 200000.00, 18000.00, 1, '201903', 'N'),
(3, '60003', '2019-04-22', 4, '15,16,17,18,19', 4160000.00, 7, '2.40', '0.40', 5, 595000.00, 100000.00, 695000.00, '', 200000.00, 18000.00, 1, '201904', 'N'),
(4, '60002B', '2019-04-30', 3, '11,12,13,14', 7280000.00, 8, '2.25', '0.40', 5, 910000.00, 164000.00, 1074000.00, '', 350000.00, 18000.00, 1, '201904', 'N'),
(5, '60004', '2019-04-30', 1, '1,2,3,4,5,6', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 10000.00, 6000.00, 1, '201904', 'N'),
(6, '60005', '2019-04-05', 4, '15,16,17,18,19', 10000000.00, 3, '2.00', '0.40', 3, 10000000.00, 200000.00, 10600000.00, NULL, 0.00, 0.00, 1, '201904', 'N');

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
  `Keterangan` text DEFAULT NULL,
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
  `Keterangan` text DEFAULT NULL,
  `Periode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_pinjamanangsurantemp`
--

INSERT INTO `t04_pinjamanangsurantemp` (`id`, `pinjaman_id`, `Angsuran_Ke`, `Angsuran_Tanggal`, `Angsuran_Pokok`, `Angsuran_Bunga`, `Angsuran_Total`, `Sisa_Hutang`, `Tanggal_Bayar`, `Terlambat`, `Total_Denda`, `Bayar_Titipan`, `Bayar_Non_Titipan`, `Bayar_Total`, `Keterangan`, `Periode`) VALUES
(1, 1, 1, '2019-04-04', 1040000.00, 250000.00, 1290000.00, 9360000.00, '2019-03-30', -5, 0.00, 0.00, 1290000.00, 1290000.00, 'CB 2500000', '201903'),
(2, 1, 2, '2019-05-04', 1040000.00, 250000.00, 1290000.00, 8320000.00, '2019-04-24', -10, 0.00, 0.00, 1290000.00, 1290000.00, 'cb 2150000', '201904'),
(3, 1, 3, '2019-06-04', 1040000.00, 250000.00, 1290000.00, 7280000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(4, 1, 4, '2019-07-04', 1040000.00, 250000.00, 1290000.00, 6240000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(5, 1, 5, '2019-08-04', 1040000.00, 250000.00, 1290000.00, 5200000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(6, 1, 6, '2019-09-04', 1040000.00, 250000.00, 1290000.00, 4160000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(7, 1, 7, '2019-10-04', 1040000.00, 250000.00, 1290000.00, 3120000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(8, 1, 8, '2019-11-04', 1040000.00, 250000.00, 1290000.00, 2080000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(9, 1, 9, '2019-12-04', 1040000.00, 250000.00, 1290000.00, 1040000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(10, 1, 10, '2020-01-04', 1040000.00, 250000.00, 1290000.00, 0.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(11, 2, 1, '2019-04-01', 694000.00, 93000.00, 787000.00, 3466000.00, '2019-04-26', 25, 58700.00, 0.00, 787000.00, 845700.00, '', '201904'),
(12, 2, 2, '2019-05-01', 694000.00, 93000.00, 787000.00, 2772000.00, '2019-04-26', -5, 20000.00, 0.00, 787000.00, 807000.00, '', '201904'),
(13, 2, 3, '2019-06-01', 694000.00, 93000.00, 787000.00, 2078000.00, '2019-04-29', -33, 0.00, 0.00, 787000.00, 787000.00, '', '201904'),
(14, 2, 4, '2019-07-01', 694000.00, 93000.00, 787000.00, 1384000.00, '2019-04-29', -63, 0.00, 0.00, 787000.00, 787000.00, '', '201904'),
(15, 2, 5, '2019-08-01', 694000.00, 93000.00, 787000.00, 690000.00, '2019-04-29', -94, 0.00, 0.00, 787000.00, 787000.00, '', '201904'),
(16, 2, 6, '2019-09-01', 690000.00, 97000.00, 787000.00, 0.00, '2019-04-29', -125, 0.00, 0.00, 787000.00, 787000.00, '', '201904'),
(17, 3, 1, '2019-05-22', 595000.00, 100000.00, 695000.00, 3565000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(18, 3, 2, '2019-06-22', 595000.00, 100000.00, 695000.00, 2970000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(19, 3, 3, '2019-07-22', 595000.00, 100000.00, 695000.00, 2375000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(20, 3, 4, '2019-08-22', 595000.00, 100000.00, 695000.00, 1780000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(21, 3, 5, '2019-09-22', 595000.00, 100000.00, 695000.00, 1185000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(22, 3, 6, '2019-10-22', 595000.00, 100000.00, 695000.00, 590000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(23, 3, 7, '2019-11-22', 590000.00, 105000.00, 695000.00, 0.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(24, 4, 1, '2019-05-30', 910000.00, 164000.00, 1074000.00, 6370000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(25, 4, 2, '2019-06-30', 910000.00, 164000.00, 1074000.00, 5460000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(26, 4, 3, '2019-07-30', 910000.00, 164000.00, 1074000.00, 4550000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(27, 4, 4, '2019-08-30', 910000.00, 164000.00, 1074000.00, 3640000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(28, 4, 5, '2019-09-30', 910000.00, 164000.00, 1074000.00, 2730000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(29, 4, 6, '2019-10-30', 910000.00, 164000.00, 1074000.00, 1820000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(30, 4, 7, '2019-11-30', 910000.00, 164000.00, 1074000.00, 910000.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(31, 4, 8, '2019-12-30', 910000.00, 164000.00, 1074000.00, 0.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', ''),
(32, 5, 1, '2019-05-30', 867000.00, 233000.00, 1100000.00, 9533000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 5, 2, '2019-06-30', 867000.00, 233000.00, 1100000.00, 8666000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 5, 3, '2019-07-30', 867000.00, 233000.00, 1100000.00, 7799000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 5, 4, '2019-08-30', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 5, 5, '2019-09-30', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 5, 6, '2019-10-30', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 5, 7, '2019-11-30', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 5, 8, '2019-12-30', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 5, 9, '2020-01-30', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 5, 10, '2020-02-29', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 5, 11, '2020-03-30', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 5, 12, '2020-04-30', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 6, 1, '2019-05-05', 0.00, 200000.00, 200000.00, 0.00, '2019-04-06', -29, 0.00, 0.00, 200000.00, 200000.00, NULL, '201904'),
(45, 6, 2, '2019-06-05', 0.00, 200000.00, 200000.00, 0.00, '2019-04-06', -60, 0.00, 0.00, 200000.00, 200000.00, NULL, '201904'),
(46, 6, 3, '2019-07-05', 10000000.00, 200000.00, 10200000.00, 0.00, '2019-04-06', -90, 0.00, 0.00, 10200000.00, 10200000.00, NULL, '201904');

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
  `Keterangan` text DEFAULT NULL,
  `Masuk` float(14,2) NOT NULL DEFAULT 0.00,
  `Keluar` float(14,2) NOT NULL DEFAULT 0.00,
  `Sisa` float(14,2) NOT NULL DEFAULT 0.00,
  `Angsuran_Ke` tinyint(4) NOT NULL DEFAULT 0
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
(1, 'ANDOKO', 'PURI INDAH AA 57', '081.1111111'),
(2, 'EKO', 'PURI NDAH AA 56', '081.22222222');

-- --------------------------------------------------------

--
-- Table structure for table `t08_pinjamanpotongan`
--

CREATE TABLE `t08_pinjamanpotongan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t08_pinjamanpotongan`
--

INSERT INTO `t08_pinjamanpotongan` (`id`, `pinjaman_id`, `Tanggal`, `Keterangan`, `Jumlah`) VALUES
(1, 2, '2019-04-29', 'POTONGAN PELUNASAN 60001', 100000.00);

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
  `debet` double NOT NULL DEFAULT 0,
  `credit` double NOT NULL DEFAULT 0,
  `pembayaran_` double NOT NULL DEFAULT 0,
  `bunga_` double NOT NULL DEFAULT 0,
  `denda_` double NOT NULL DEFAULT 0,
  `titipan_` double NOT NULL DEFAULT 0,
  `administrasi_` double NOT NULL DEFAULT 0,
  `modal_` double NOT NULL DEFAULT 0,
  `pinjaman_` double NOT NULL DEFAULT 0,
  `biaya_` double NOT NULL DEFAULT 0,
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
(1, '2019-04-22', '201904', '3.PINJ', '1.2003', 4160000.00, 0.00, 'Pinjaman No. Kontrak 60003'),
(2, '2019-04-22', '201904', '3.PINJ', '1.1003', 0.00, 4160000.00, 'Pinjaman No. Kontrak 60003'),
(3, '2019-04-22', '201904', '3.ADM', '1.1003', 200000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60003'),
(4, '2019-04-22', '201904', '3.ADM', '5.1000', 0.00, 200000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60003'),
(5, '2019-04-22', '201904', '3.MAT', '1.1003', 18000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60003'),
(6, '2019-04-22', '201904', '3.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60003'),
(13, '2019-04-24', '201904', '2.ANG', '1.1003', 1040000.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(14, '2019-04-24', '201904', '2.ANG', '1.2003', 0.00, 1040000.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60001'),
(15, '2019-04-24', '201904', '2.BGA', '1.1003', 250000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(16, '2019-04-24', '201904', '2.BGA', '3.1000', 0.00, 250000.00, 'Pendapatan Bunga ke 2 No. Kontrak 60001'),
(17, '2019-04-24', '201904', '2.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(18, '2019-04-24', '201904', '2.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60001'),
(19, '2019-04-26', '201904', '11.ANG', '1.1003', 694000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60002'),
(20, '2019-04-26', '201904', '11.ANG', '1.2003', 0.00, 694000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60002'),
(21, '2019-04-26', '201904', '11.BGA', '1.1003', 93000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60002'),
(22, '2019-04-26', '201904', '11.BGA', '3.1000', 0.00, 93000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60002'),
(23, '2019-04-26', '201904', '11.DND', '1.1003', 58700.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60002'),
(24, '2019-04-26', '201904', '11.DND', '5.3000', 0.00, 58700.00, 'Pendapatan Denda ke 1 No. Kontrak 60002'),
(25, '2019-04-26', '201904', '12.ANG', '1.1003', 694000.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60002'),
(26, '2019-04-26', '201904', '12.ANG', '1.2003', 0.00, 694000.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60002'),
(27, '2019-04-26', '201904', '12.BGA', '1.1003', 93000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 60002'),
(28, '2019-04-26', '201904', '12.BGA', '3.1000', 0.00, 93000.00, 'Pendapatan Bunga ke 2 No. Kontrak 60002'),
(29, '2019-04-26', '201904', '12.DND', '1.1003', 20000.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60002'),
(30, '2019-04-26', '201904', '12.DND', '5.3000', 0.00, 20000.00, 'Pendapatan Denda ke 2 No. Kontrak 60002'),
(31, '2019-04-29', '201904', '13.ANG', '1.1003', 694000.00, 0.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60002'),
(32, '2019-04-29', '201904', '13.ANG', '1.2003', 0.00, 694000.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60002'),
(33, '2019-04-29', '201904', '13.BGA', '1.1003', 93000.00, 0.00, 'Pendapatan Bunga ke 3 No. Kontrak 60002'),
(34, '2019-04-29', '201904', '13.BGA', '3.1000', 0.00, 93000.00, 'Pendapatan Bunga ke 3 No. Kontrak 60002'),
(35, '2019-04-29', '201904', '13.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60002'),
(36, '2019-04-29', '201904', '13.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60002'),
(55, '2019-04-29', '201904', '60002.PT', '4.7000', 100000.00, 0.00, 'Potongan Pinjaman No. Kontrak 60002'),
(56, '2019-04-29', '201904', '60002.PT', '1.1003', 0.00, 100000.00, 'Potongan Pinjaman No. Kontrak 60002'),
(57, '2019-04-29', '201904', '16.ANG', '1.1003', 690000.00, 0.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60002'),
(58, '2019-04-29', '201904', '16.ANG', '1.2003', 0.00, 690000.00, 'Pembayaran Angsuran ke 6 No. Kontrak 60002'),
(59, '2019-04-29', '201904', '16.BGA', '1.1003', 97000.00, 0.00, 'Pendapatan Bunga ke 6 No. Kontrak 60002'),
(60, '2019-04-29', '201904', '16.BGA', '3.1000', 0.00, 97000.00, 'Pendapatan Bunga ke 6 No. Kontrak 60002'),
(61, '2019-04-29', '201904', '16.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 6 No. Kontrak 60002'),
(62, '2019-04-29', '201904', '16.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 6 No. Kontrak 60002'),
(63, '2019-04-29', '201904', '15.ANG', '1.1003', 694000.00, 0.00, 'Pembayaran Angsuran ke 5 No. Kontrak 60002'),
(64, '2019-04-29', '201904', '15.ANG', '1.2003', 0.00, 694000.00, 'Pembayaran Angsuran ke 5 No. Kontrak 60002'),
(65, '2019-04-29', '201904', '15.BGA', '1.1003', 93000.00, 0.00, 'Pendapatan Bunga ke 5 No. Kontrak 60002'),
(66, '2019-04-29', '201904', '15.BGA', '3.1000', 0.00, 93000.00, 'Pendapatan Bunga ke 5 No. Kontrak 60002'),
(67, '2019-04-29', '201904', '15.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 5 No. Kontrak 60002'),
(68, '2019-04-29', '201904', '15.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 5 No. Kontrak 60002'),
(81, '2019-04-29', '201904', '14.ANG', '1.1003', 694000.00, 0.00, 'Pembayaran Angsuran ke 4 No. Kontrak 60002'),
(82, '2019-04-29', '201904', '14.ANG', '1.2003', 0.00, 694000.00, 'Pembayaran Angsuran ke 4 No. Kontrak 60002'),
(83, '2019-04-29', '201904', '14.BGA', '1.1003', 93000.00, 0.00, 'Pendapatan Bunga ke 4 No. Kontrak 60002'),
(84, '2019-04-29', '201904', '14.BGA', '3.1000', 0.00, 93000.00, 'Pendapatan Bunga ke 4 No. Kontrak 60002'),
(85, '2019-04-29', '201904', '14.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 4 No. Kontrak 60002'),
(86, '2019-04-29', '201904', '14.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 4 No. Kontrak 60002'),
(87, '2019-04-30', '201904', '4.PINJ', '1.2003', 7280000.00, 0.00, 'Pinjaman No. Kontrak 60002B'),
(88, '2019-04-30', '201904', '4.PINJ', '1.1003', 0.00, 7280000.00, 'Pinjaman No. Kontrak 60002B'),
(89, '2019-04-30', '201904', '4.ADM', '1.1003', 350000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B'),
(90, '2019-04-30', '201904', '4.ADM', '5.1000', 0.00, 350000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B'),
(91, '2019-04-30', '201904', '4.MAT', '1.1003', 18000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002B'),
(92, '2019-04-30', '201904', '4.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002B'),
(93, '2019-04-25', '201904', '2.DEPM', '1.1000', 5000000.00, 0.00, 'Deposito Masuk No. Kontrak 00002'),
(94, '2019-04-25', '201904', '2.DEPM', '2.5000', 0.00, 5000000.00, 'Deposito Masuk No. Kontrak 00002'),
(95, '2019-04-30', '201904', '5.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 60004'),
(96, '2019-04-30', '201904', '5.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 60004'),
(97, '2019-04-30', '201904', '5.ADM', '1.1003', 10000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60004'),
(98, '2019-04-30', '201904', '5.ADM', '5.1000', 0.00, 10000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60004'),
(99, '2019-04-30', '201904', '5.MAT', '1.1003', 6000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60004'),
(100, '2019-04-30', '201904', '5.MAT', '5.4000', 0.00, 6000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60004'),
(101, '2019-04-30', '201904', '2.DEPM', '1.1003', 20000000.00, 0.00, 'Deposito No. Kontrak 00002'),
(102, '2019-04-30', '201904', '2.DEPM', '2.5000', 0.00, 20000000.00, 'Deposito No. Kontrak 00002'),
(103, '2019-04-30', '201904', '2.ADM', '1.1003', 10000.00, 0.00, 'Pendapatan Administrasi Deposito No. Kontrak 00002'),
(104, '2019-04-30', '201904', '2.ADM', '5.5000', 0.00, 10000.00, 'Pendapatan Administrasi Deposito No. Kontrak 00002'),
(105, '2019-04-30', '201904', '2.MAT', '1.1003', 6000.00, 0.00, 'Pendapatan Materai Deposito No. Kontrak 00002'),
(106, '2019-04-30', '201904', '2.MAT', '5.4000', 0.00, 6000.00, 'Pendapatan Materai Deposito No. Kontrak 00002'),
(107, '2019-04-30', '201904', '3.DEPM', '1.1003', 30000000.00, 0.00, 'Deposito No. Kontrak 00003'),
(108, '2019-04-30', '201904', '3.DEPM', '2.5000', 0.00, 30000000.00, 'Deposito No. Kontrak 00003'),
(109, '2019-04-30', '201904', '3.ADM', '1.1003', 10000.00, 0.00, 'Pendapatan Administrasi Deposito No. Kontrak 00003'),
(110, '2019-04-30', '201904', '3.ADM', '5.5000', 0.00, 10000.00, 'Pendapatan Administrasi Deposito No. Kontrak 00003'),
(111, '2019-04-30', '201904', '3.MAT', '1.1003', 6000.00, 0.00, 'Pendapatan Materai Deposito No. Kontrak 00003'),
(112, '2019-04-30', '201904', '3.MAT', '5.4000', 0.00, 6000.00, 'Pendapatan Materai Deposito No. Kontrak 00003'),
(113, '2019-04-30', '201904', '7.BYRBNGDEP', '4.8000', 300000.00, 0.00, 'Pembayaran Bunga ke 1 No. Kontrak 00003'),
(114, '2019-04-30', '201904', '7.BYRBNGDEP', '1.1003', 0.00, 300000.00, 'Pembayaran Bunga ke 1 No. Kontrak 00003'),
(115, '2019-04-05', '201904', '6.PINJ', '1.2003', 10000000.00, 0.00, 'Pinjaman No. Kontrak 60005'),
(116, '2019-04-05', '201904', '6.PINJ', '1.1003', 0.00, 10000000.00, 'Pinjaman No. Kontrak 60005'),
(117, '2019-04-05', '201904', '6.ADM', '1.1003', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60005'),
(118, '2019-04-05', '201904', '6.ADM', '5.1000', 0.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60005'),
(119, '2019-04-05', '201904', '6.MAT', '1.1003', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60005'),
(120, '2019-04-05', '201904', '6.MAT', '5.4000', 0.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60005'),
(121, '2019-04-06', '201904', '44.ANG', '1.1003', 0.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60005'),
(122, '2019-04-06', '201904', '44.ANG', '1.2003', 0.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60005'),
(123, '2019-04-06', '201904', '44.BGA', '1.1003', 200000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60005'),
(124, '2019-04-06', '201904', '44.BGA', '3.1000', 0.00, 200000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60005'),
(125, '2019-04-06', '201904', '44.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60005'),
(126, '2019-04-06', '201904', '44.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60005'),
(127, '2019-04-06', '201904', '45.ANG', '1.1003', 0.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60005'),
(128, '2019-04-06', '201904', '45.ANG', '1.2003', 0.00, 0.00, 'Pembayaran Angsuran ke 2 No. Kontrak 60005'),
(129, '2019-04-06', '201904', '45.BGA', '1.1003', 200000.00, 0.00, 'Pendapatan Bunga ke 2 No. Kontrak 60005'),
(130, '2019-04-06', '201904', '45.BGA', '3.1000', 0.00, 200000.00, 'Pendapatan Bunga ke 2 No. Kontrak 60005'),
(131, '2019-04-06', '201904', '45.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60005'),
(132, '2019-04-06', '201904', '45.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 2 No. Kontrak 60005'),
(133, '2019-04-06', '201904', '46.ANG', '1.1003', 10000000.00, 0.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60005'),
(134, '2019-04-06', '201904', '46.ANG', '1.2003', 0.00, 10000000.00, 'Pembayaran Angsuran ke 3 No. Kontrak 60005'),
(135, '2019-04-06', '201904', '46.BGA', '1.1003', 200000.00, 0.00, 'Pendapatan Bunga ke 3 No. Kontrak 60005'),
(136, '2019-04-06', '201904', '46.BGA', '3.1000', 0.00, 200000.00, 'Pendapatan Bunga ke 3 No. Kontrak 60005'),
(137, '2019-04-06', '201904', '46.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60005'),
(138, '2019-04-06', '201904', '46.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60005');

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
-- Table structure for table `t20_deposito`
--

CREATE TABLE `t20_deposito` (
  `id` int(11) NOT NULL,
  `No_Urut` varchar(10) NOT NULL,
  `Tanggal_Valuta` date NOT NULL,
  `Tanggal_Jatuh_Tempo` date NOT NULL,
  `Suku_Bunga` decimal(5,2) NOT NULL DEFAULT 0.00,
  `Jumlah_Bunga` float(14,2) NOT NULL,
  `Dikredit_Diperpanjang` enum('Dikredit','Diperpanjang') NOT NULL DEFAULT 'Dikredit',
  `Tunai_Transfer` enum('Tunai','Transfer') NOT NULL DEFAULT 'Tunai',
  `nasabah_id` int(11) NOT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `Jumlah_Deposito` float(14,2) NOT NULL DEFAULT 0.00,
  `Jumlah_Terbilang` text NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `Status` enum('Keluar','Lanjut') NOT NULL DEFAULT 'Lanjut'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t20_deposito`
--

INSERT INTO `t20_deposito` (`id`, `No_Urut`, `Tanggal_Valuta`, `Tanggal_Jatuh_Tempo`, `Suku_Bunga`, `Jumlah_Bunga`, `Dikredit_Diperpanjang`, `Tunai_Transfer`, `nasabah_id`, `bank_id`, `Jumlah_Deposito`, `Jumlah_Terbilang`, `Periode`, `Status`) VALUES
(1, '00001', '2019-04-18', '2019-07-18', '12.00', 150000.00, 'Diperpanjang', 'Transfer', 1, '1', 15000000.00, 'Lima Belas  Juta  Rupiah', '201904', 'Lanjut'),
(2, '00002', '2019-04-25', '2019-07-25', '6.00', 25000.00, 'Diperpanjang', 'Transfer', 1, '1', 5000000.00, 'Lima Juta  Rupiah', '201904', 'Lanjut');

-- --------------------------------------------------------

--
-- Table structure for table `t21_bank`
--

CREATE TABLE `t21_bank` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Nomor` varchar(50) NOT NULL,
  `Pemilik` varchar(50) NOT NULL,
  `Bank` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `Cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t21_bank`
--

INSERT INTO `t21_bank` (`id`, `nasabah_id`, `Nomor`, `Pemilik`, `Bank`, `Kota`, `Cabang`) VALUES
(1, 1, '3515112412740001', 'HARI HARIYANTO', 'BCA', 'SURABAYA', 'RUNGKUT');

-- --------------------------------------------------------

--
-- Table structure for table `t22_peserta`
--

CREATE TABLE `t22_peserta` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text DEFAULT NULL,
  `No_Telp_Hp` varchar(100) DEFAULT NULL,
  `Pekerjaan` varchar(50) DEFAULT NULL,
  `Keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t22_peserta`
--

INSERT INTO `t22_peserta` (`id`, `Nama`, `Alamat`, `No_Telp_Hp`, `Pekerjaan`, `Keterangan`) VALUES
(1, 'ADI HARIANTO', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t23_deposito`
--

CREATE TABLE `t23_deposito` (
  `id` int(11) NOT NULL,
  `Kontrak_No` varchar(25) NOT NULL,
  `Kontrak_Tgl` date NOT NULL,
  `Kontrak_Lama` tinyint(4) NOT NULL,
  `Jatuh_Tempo_Tgl` date NOT NULL,
  `Deposito` float(14,2) NOT NULL,
  `Bunga_Suku` decimal(5,2) NOT NULL DEFAULT 12.00,
  `Bunga` float(14,2) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `No_Ref` varchar(25) DEFAULT NULL,
  `Biaya_Administrasi` float(14,2) NOT NULL DEFAULT 0.00,
  `Biaya_Materai` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) NOT NULL,
  `Kontrak_Status` enum('Ya','Selesai') NOT NULL DEFAULT 'Ya',
  `Jatuh_Tempo_Status` enum('Dikredit','Diperpanjang') NOT NULL DEFAULT 'Diperpanjang',
  `Bunga_Status` enum('Tunai','Transfer') NOT NULL DEFAULT 'Transfer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t23_deposito`
--

INSERT INTO `t23_deposito` (`id`, `Kontrak_No`, `Kontrak_Tgl`, `Kontrak_Lama`, `Jatuh_Tempo_Tgl`, `Deposito`, `Bunga_Suku`, `Bunga`, `nasabah_id`, `bank_id`, `No_Ref`, `Biaya_Administrasi`, `Biaya_Materai`, `Periode`, `Kontrak_Status`, `Jatuh_Tempo_Status`, `Bunga_Status`) VALUES
(1, '00001', '2019-04-30', 3, '2019-07-30', 20000000.00, '12.00', 200000.00, 1, 1, NULL, 10000.00, 6000.00, '201904', 'Ya', 'Diperpanjang', 'Transfer'),
(2, '00002', '2019-04-30', 3, '2019-07-30', 20000000.00, '12.00', 200000.00, 1, 1, NULL, 10000.00, 6000.00, '201904', 'Ya', 'Diperpanjang', 'Transfer'),
(3, '00003', '2019-04-30', 5, '2019-09-30', 30000000.00, '12.00', 300000.00, 1, 1, NULL, 10000.00, 6000.00, '201904', 'Ya', 'Diperpanjang', 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `t24_deposito_detail`
--

CREATE TABLE `t24_deposito_detail` (
  `id` int(11) NOT NULL,
  `deposito_id` int(11) NOT NULL,
  `Pembayaran_Ke` tinyint(4) NOT NULL DEFAULT 0,
  `Bayar_Tgl` date NOT NULL,
  `Bayar_Jumlah` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t24_deposito_detail`
--

INSERT INTO `t24_deposito_detail` (`id`, `deposito_id`, `Pembayaran_Ke`, `Bayar_Tgl`, `Bayar_Jumlah`, `Periode`) VALUES
(1, 1, 1, '2019-05-30', 0.00, NULL),
(2, 1, 2, '2019-06-30', 0.00, NULL),
(3, 1, 3, '2019-07-30', 0.00, NULL),
(4, 2, 1, '2019-05-30', 200000.00, '201904'),
(5, 2, 2, '2019-06-30', 200000.00, '201904'),
(6, 2, 3, '2019-06-30', 200000.00, '201904'),
(7, 3, 1, '2019-04-30', 300000.00, '201904'),
(8, 3, 2, '2019-06-30', 0.00, NULL),
(9, 3, 3, '2019-07-30', 0.00, NULL),
(10, 3, 4, '2019-08-30', 0.00, NULL),
(11, 3, 5, '2019-09-30', 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t71_depositolap`
--

CREATE TABLE `t71_depositolap` (
  `id` int(11) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t71_depositolap`
--

INSERT INTO `t71_depositolap` (`id`, `field_name`, `field_status`, `field_caption`, `field_align`, `field_index`, `field_format`) VALUES
(1, 'Kontrak_No', 'Y', 'No. Kontrak', 'left', 1, 'none'),
(2, 'Kontrak_Tgl', 'Y', 'Tgl. Kontrak', 'left', 6, 'tanggal'),
(3, 'Kontrak_Lama', 'N', 'Lama Kontrak', 'right', 99, 'none'),
(4, 'Jatuh_Tempo_Tgl', 'Y', 'Tgl. Jatuh Tempo', 'left', 7, 'tanggal'),
(5, 'Deposito', 'Y', 'Jumlah Deposito', 'right', 4, 'numerik'),
(6, 'Bunga_Suku', 'Y', 'Suku Bunga', 'right', 5, 'numerik'),
(7, 'Bunga', 'Y', 'Jumlah Bunga', 'right', 8, 'numerik'),
(8, 'No_Ref', 'N', 'No. Ref.', 'left', 8, 'none'),
(9, 'Biaya_Administrasi', 'N', 'Bi. Adm.', 'right', 9, 'numerik'),
(10, 'Biaya_Materai', 'N', 'Bi. Mat.', 'right', 10, 'numerik'),
(11, 'Periode', 'N', 'Periode', 'left', 11, 'none'),
(12, 'Kontrak_Status', 'N', 'Status Kontrak', 'left', 12, 'none'),
(13, 'Jatuh_Tempo_Status', 'N', 'Status Jatuh Tempo', 'left', 13, 'none'),
(14, 'Bunga_Status', 'N', 'Status Bunga', 'left', 14, 'none'),
(15, 'nama', 'Y', 'Nasabah', 'left', 2, 'none'),
(16, 'alamat', 'Y', 'Alamat', 'left', 3, 'none'),
(17, 'no_telp_hp', 'N', 'No. Telp./HP', 'left', 17, 'none'),
(18, 'pekerjaan', 'N', 'Pekerjaan', 'left', 18, 'none'),
(19, 'keterangan', 'N', 'Keterangan', 'left', 19, 'none'),
(20, 'nomor', 'N', 'No. Rek.', 'left', 20, 'none'),
(21, 'pemilik', 'N', 'Pemilik Rekening', 'left', 21, 'none'),
(22, 'bank', 'N', 'Bank', 'left', 22, 'none'),
(23, 'kota', 'N', 'Kota', 'left', 23, 'none'),
(24, 'cabang', 'N', 'Cabang', 'left', 24, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `t72_depositolap`
--

CREATE TABLE `t72_depositolap` (
  `id` int(11) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t72_depositolap`
--

INSERT INTO `t72_depositolap` (`id`, `field_name`, `field_status`, `field_caption`, `field_align`, `field_index`, `field_format`) VALUES
(1, 'no_urut', 'Y', 'No. Kontrak', 'left', 1, 'none'),
(2, 'tanggal_valuta', 'Y', 'Tgl. Masuk', 'left', 6, 'tanggal'),
(3, 'tanggal_jatuh_tempo', 'Y', 'Tgl. Jatuh Tempo', 'left', 7, 'tanggal'),
(4, 'suku_bunga', 'Y', 'Bunga %', 'right', 5, 'numerik'),
(5, 'jumlah_bunga', 'Y', 'Bunga /bulan', 'right', 8, 'numerik'),
(6, 'dikredit_diperpanjang', 'N', 'Jumlah Pokok', 'left', 99, 'none'),
(7, 'tunai_transfer', 'N', 'Bunga', 'left', 99, 'none'),
(8, 'jumlah_deposito', 'Y', 'Deposito', 'right', 4, 'numerik'),
(9, 'jumlah_terbilang', 'N', 'Terbilang', 'left', 99, 'none'),
(10, 'nama', 'Y', 'Nama Nasabah', 'left', 2, 'none'),
(11, 'alamat', 'Y', 'Alamat', 'left', 3, 'none'),
(12, 'no_telp_hp', 'N', 'No. Telp./HP', 'left', 99, 'none'),
(13, 'pekerjaan', 'N', 'Pekerjaan', 'left', 99, 'none'),
(17, 'keterangan', 'N', 'Keterangan', 'left', 99, 'none'),
(18, 'nomor', 'N', 'Nomor Rekening', 'left', 99, 'none'),
(19, 'pemilik', 'N', 'Nama Pemilik Rekening', 'left', 99, 'none'),
(20, 'bank', 'N', 'Bank', 'left', 99, 'none'),
(21, 'kota', 'N', 'Kota', 'left', 99, 'none'),
(22, 'cabang', 'N', 'Cabang', 'left', 99, 'none'),
(26, 'status_deposito', 'N', 'Status Deposito', 'left', 9, 'none');

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
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
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
(26, 'Status', 'Y', 'Status', 'left', 99, 'none'),
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
(68, 'pd_Angsuran_Total', 'Y', 'Total', 'right', 11, 'numerik'),
(69, 'Tanggal_Bayar', 'Y', 'Tanggal Bayar', 'left', 99, 'tanggal'),
(70, 'umur_tunggakan', 'Y', 'Umur Tunggakan', 'right', 12, 'none');

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
(1, 'Koperasi Bersama', 'Sidoarjo', '-');

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
  `saldoawal` float(14,2) NOT NULL DEFAULT 0.00,
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
  `saldoawal` float(14,2) NOT NULL DEFAULT 0.00,
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
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 13520000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-22', '3.PINJ', 'Pinjaman No. Kontrak 60003', 4160000.00, 0.00, 17680000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-24', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', 0.00, 1040000.00, 16640000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-26', '11.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60002', 0.00, 694000.00, 15946000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-26', '12.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60002', 0.00, 694000.00, 15252000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '13.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60002', 0.00, 694000.00, 14558000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '16.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60002', 0.00, 690000.00, 13868000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '15.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60002', 0.00, 694000.00, 13174000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '14.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60002', 0.00, 694000.00, 12480000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-30', '4.PINJ', 'Pinjaman No. Kontrak 60002B', 7280000.00, 0.00, 19760000.00);

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
('2019-04-05', '6.PINJ', 'Pinjaman No. Kontrak 60005', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 10000000.00, 0.00),
('2019-04-05', '6.PINJ', 'Pinjaman No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 10000000.00),
('2019-04-05', '6.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-05', '6.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60005', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 0.00),
('2019-04-05', '6.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-05', '6.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60005', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 0.00),
('2019-04-06', '44.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-06', '44.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60005', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 0.00),
('2019-04-06', '44.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 200000.00, 0.00),
('2019-04-06', '44.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60005', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 200000.00),
('2019-04-06', '44.DND', 'Pendapatan Denda ke 1 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-06', '44.DND', 'Pendapatan Denda ke 1 No. Kontrak 60005', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-06', '45.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-06', '45.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60005', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 0.00),
('2019-04-06', '45.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 200000.00, 0.00),
('2019-04-06', '45.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60005', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 200000.00),
('2019-04-06', '45.DND', 'Pendapatan Denda ke 2 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-06', '45.DND', 'Pendapatan Denda ke 2 No. Kontrak 60005', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-06', '46.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 10000000.00, 0.00),
('2019-04-06', '46.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60005', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 10000000.00),
('2019-04-06', '46.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 200000.00, 0.00),
('2019-04-06', '46.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60005', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 200000.00),
('2019-04-06', '46.DND', 'Pendapatan Denda ke 3 No. Kontrak 60005', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-06', '46.DND', 'Pendapatan Denda ke 3 No. Kontrak 60005', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-22', '3.PINJ', 'Pinjaman No. Kontrak 60003', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 4160000.00, 0.00),
('2019-04-22', '3.PINJ', 'Pinjaman No. Kontrak 60003', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 4160000.00),
('2019-04-22', '3.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60003', '1.1003', 'KAS BANK - BCA SURABAYA', 200000.00, 0.00),
('2019-04-22', '3.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60003', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 200000.00),
('2019-04-22', '3.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60003', '1.1003', 'KAS BANK - BCA SURABAYA', 18000.00, 0.00),
('2019-04-22', '3.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60003', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 18000.00),
('2019-04-24', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 1040000.00, 0.00),
('2019-04-24', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 1040000.00),
('2019-04-24', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 250000.00, 0.00),
('2019-04-24', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 250000.00),
('2019-04-24', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-24', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-25', '2.DEPM', 'Deposito Masuk No. Kontrak 00002', '1.1000', 'KAS', 5000000.00, 0.00),
('2019-04-25', '2.DEPM', 'Deposito Masuk No. Kontrak 00002', '2.5000', 'DEPOSITO', 0.00, 5000000.00),
('2019-04-26', '11.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 694000.00, 0.00),
('2019-04-26', '11.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 694000.00),
('2019-04-26', '11.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 93000.00, 0.00),
('2019-04-26', '11.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 93000.00),
('2019-04-26', '11.DND', 'Pendapatan Denda ke 1 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 58700.00, 0.00),
('2019-04-26', '11.DND', 'Pendapatan Denda ke 1 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 58700.00),
('2019-04-26', '12.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 694000.00, 0.00),
('2019-04-26', '12.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 694000.00),
('2019-04-26', '12.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 93000.00, 0.00),
('2019-04-26', '12.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 93000.00),
('2019-04-26', '12.DND', 'Pendapatan Denda ke 2 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 20000.00, 0.00),
('2019-04-26', '12.DND', 'Pendapatan Denda ke 2 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 20000.00),
('2019-04-29', '13.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 694000.00, 0.00),
('2019-04-29', '13.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 694000.00),
('2019-04-29', '13.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 93000.00, 0.00),
('2019-04-29', '13.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 93000.00),
('2019-04-29', '13.DND', 'Pendapatan Denda ke 3 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-29', '13.DND', 'Pendapatan Denda ke 3 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-29', '60002.PT', 'Potongan Pinjaman No. Kontrak 60002', '4.7000', 'POTONGAN', 100000.00, 0.00),
('2019-04-29', '60002.PT', 'Potongan Pinjaman No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 100000.00),
('2019-04-29', '16.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 690000.00, 0.00),
('2019-04-29', '16.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 690000.00),
('2019-04-29', '16.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 97000.00, 0.00),
('2019-04-29', '16.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 97000.00),
('2019-04-29', '16.DND', 'Pendapatan Denda ke 6 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-29', '16.DND', 'Pendapatan Denda ke 6 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-29', '15.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 694000.00, 0.00),
('2019-04-29', '15.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 694000.00),
('2019-04-29', '15.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 93000.00, 0.00),
('2019-04-29', '15.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 93000.00),
('2019-04-29', '15.DND', 'Pendapatan Denda ke 5 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-29', '15.DND', 'Pendapatan Denda ke 5 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-29', '14.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 694000.00, 0.00),
('2019-04-29', '14.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 694000.00),
('2019-04-29', '14.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 93000.00, 0.00),
('2019-04-29', '14.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60002', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 93000.00),
('2019-04-29', '14.DND', 'Pendapatan Denda ke 4 No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-04-29', '14.DND', 'Pendapatan Denda ke 4 No. Kontrak 60002', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00),
('2019-04-30', '4.PINJ', 'Pinjaman No. Kontrak 60002B', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 7280000.00, 0.00),
('2019-04-30', '4.PINJ', 'Pinjaman No. Kontrak 60002B', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 7280000.00),
('2019-04-30', '4.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B', '1.1003', 'KAS BANK - BCA SURABAYA', 350000.00, 0.00),
('2019-04-30', '4.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 350000.00),
('2019-04-30', '4.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002B', '1.1003', 'KAS BANK - BCA SURABAYA', 18000.00, 0.00),
('2019-04-30', '4.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002B', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 18000.00),
('2019-04-30', '5.PINJ', 'Pinjaman No. Kontrak 60004', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 10400000.00, 0.00),
('2019-04-30', '5.PINJ', 'Pinjaman No. Kontrak 60004', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 10400000.00),
('2019-04-30', '5.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60004', '1.1003', 'KAS BANK - BCA SURABAYA', 10000.00, 0.00),
('2019-04-30', '5.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60004', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 10000.00),
('2019-04-30', '5.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60004', '1.1003', 'KAS BANK - BCA SURABAYA', 6000.00, 0.00),
('2019-04-30', '5.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60004', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 6000.00),
('2019-04-30', '2.DEPM', 'Deposito No. Kontrak 00002', '1.1003', 'KAS BANK - BCA SURABAYA', 20000000.00, 0.00),
('2019-04-30', '2.DEPM', 'Deposito No. Kontrak 00002', '2.5000', 'DEPOSITO', 0.00, 20000000.00),
('2019-04-30', '2.ADM', 'Pendapatan Administrasi Deposito No. Kontrak 00002', '1.1003', 'KAS BANK - BCA SURABAYA', 10000.00, 0.00),
('2019-04-30', '2.ADM', 'Pendapatan Administrasi Deposito No. Kontrak 00002', '5.5000', 'PENDAPATAN ADMINISTRASI DEPOSITO', 0.00, 10000.00),
('2019-04-30', '2.MAT', 'Pendapatan Materai Deposito No. Kontrak 00002', '1.1003', 'KAS BANK - BCA SURABAYA', 6000.00, 0.00),
('2019-04-30', '2.MAT', 'Pendapatan Materai Deposito No. Kontrak 00002', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 6000.00),
('2019-04-30', '3.DEPM', 'Deposito No. Kontrak 00003', '1.1003', 'KAS BANK - BCA SURABAYA', 30000000.00, 0.00),
('2019-04-30', '3.DEPM', 'Deposito No. Kontrak 00003', '2.5000', 'DEPOSITO', 0.00, 30000000.00),
('2019-04-30', '3.ADM', 'Pendapatan Administrasi Deposito No. Kontrak 00003', '1.1003', 'KAS BANK - BCA SURABAYA', 10000.00, 0.00),
('2019-04-30', '3.ADM', 'Pendapatan Administrasi Deposito No. Kontrak 00003', '5.5000', 'PENDAPATAN ADMINISTRASI DEPOSITO', 0.00, 10000.00),
('2019-04-30', '3.MAT', 'Pendapatan Materai Deposito No. Kontrak 00003', '1.1003', 'KAS BANK - BCA SURABAYA', 6000.00, 0.00),
('2019-04-30', '3.MAT', 'Pendapatan Materai Deposito No. Kontrak 00003', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 6000.00),
('2019-04-30', '7.BYRBNGDEP', 'Pembayaran Bunga ke 1 No. Kontrak 00003', '4.8000', 'BIAYA BUNGA DEPOSITO', 300000.00, 0.00),
('2019-04-30', '7.BYRBNGDEP', 'Pembayaran Bunga ke 1 No. Kontrak 00003', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 300000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t80_rekeningold`
--

CREATE TABLE `t80_rekeningold` (
  `group` bigint(20) DEFAULT 0,
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t80_rekeningold`
--

INSERT INTO `t80_rekeningold` (`group`, `id`, `rekening`, `tipe`, `posisi`, `laporan`, `status`, `parent`, `keterangan`, `active`, `Saldo`, `Periode`) VALUES
(1, '1', 'AKTIVA', 'GROUP', 'DEBET', 'NERACA', '', '', '', 'yes', 0.00, '201903'),
(1, '1.1000', 'KAS', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201903'),
(1, '1.1001', 'KAS BANK - BCA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201903'),
(1, '1.1002', 'KAS BANK - MANDIRI', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201903'),
(1, '1.1003', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201903'),
(1, '1.1004', 'KAS BESAR', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201903'),
(1, '1.1005', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201903'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201903'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2004', 'PIUTANG SIDOARJO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2005', 'PIUTANG KPL 5', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2006', 'PIUTANG TROSOBO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2007', 'PIUTANG DANIEL', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.2008', 'PIUTANG ANDIK', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201903'),
(1, '1.3000', 'PERSEDIAAN KANTOR', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201903'),
(1, '1.4000', 'AKUMULASI PENYUSUTAN', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201903'),
(2, '2', 'PASSIVA', 'GROUP', 'CREDIT', 'NERACA', '', '', '', 'yes', 0.00, '201903'),
(2, '2.1000', 'HUTANG PAJAJARAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.2000', 'HUTANG DANIEL', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.3000', 'TITIPAN NASABAH', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.4000', 'MODAL DISETOR', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.5000', 'SHU TAHUN LALU', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.6000', 'SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.7000', 'PEMBAGIAN SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.8000', 'SHU TAHUN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201903'),
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 986000.00, '201903'),
(3, '3', 'PENDAPATAN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201903'),
(3, '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '3', '', 'yes', 0.00, '201903'),
(4, '4', 'BIAYA', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201903'),
(4, '4.1000', 'BIAYA KARYAWAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.2000', 'BIAYA PERKANTORAN & UMUM', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.3000', 'BIAYA KOMISI MAKELAR / FEE', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.4000', 'BIAYA ADMINISTRASI BANK', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.5000', 'BIAYA PENYUSUTAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.6000', 'BIAYA IKLAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(4, '4.7000', 'POTONGAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201903'),
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201903'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201903'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201903'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201903'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201903'),
(6, '6', 'BIAYA LAIN', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201903'),
(6, '6.1000', 'BIAYA LAIN-LAIN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '6', '', 'yes', 0.00, '201903');

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

--
-- Dumping data for table `t82_jurnalold`
--

INSERT INTO `t82_jurnalold` (`id`, `Tanggal`, `Periode`, `NomorTransaksi`, `Rekening`, `Debet`, `Kredit`, `Keterangan`) VALUES
(1, '2019-03-04', '201903', '1.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 60001'),
(2, '2019-03-04', '201903', '1.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 60001'),
(3, '2019-03-04', '201903', '1.ADM', '1.1003', 500000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(4, '2019-03-04', '201903', '1.ADM', '5.1000', 0.00, 500000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(5, '2019-03-04', '201903', '1.MAT', '1.1003', 18000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(6, '2019-03-04', '201903', '1.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(7, '2019-03-01', '201903', '2.PINJ', '1.2003', 4160000.00, 0.00, 'Pinjaman No. Kontrak 60002'),
(8, '2019-03-01', '201903', '2.PINJ', '1.1003', 0.00, 4160000.00, 'Pinjaman No. Kontrak 60002'),
(9, '2019-03-01', '201903', '2.ADM', '1.1003', 200000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(10, '2019-03-01', '201903', '2.ADM', '5.1000', 0.00, 200000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60002'),
(11, '2019-03-01', '201903', '2.MAT', '1.1003', 18000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(12, '2019-03-01', '201903', '2.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002'),
(13, '2019-03-30', '201903', '1.ANG', '1.1003', 1040000.00, 0.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(14, '2019-03-30', '201903', '1.ANG', '1.2003', 0.00, 1040000.00, 'Pembayaran Angsuran ke 1 No. Kontrak 60001'),
(15, '2019-03-30', '201903', '1.BGA', '1.1003', 250000.00, 0.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(16, '2019-03-30', '201903', '1.BGA', '3.1000', 0.00, 250000.00, 'Pendapatan Bunga ke 1 No. Kontrak 60001'),
(17, '2019-03-30', '201903', '1.DND', '1.1003', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001'),
(18, '2019-03-30', '201903', '1.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 1 No. Kontrak 60001');

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
('', '', 'Maret 2019', 'April 2019', ''),
('<strong>AKTIVA</strong>', '', '', '', ''),
('1.1001', 'KAS BANK - BCA', '0.00', '0.00', '0.00'),
('1.1002', 'KAS BANK - MANDIRI', '0.00', '0.00', '0.00'),
('1.1003', 'KAS BANK - BCA SURABAYA', '0.00', '0.00', '0.00'),
('1.1004', 'KAS BESAR', '0.00', '0.00', '0.00'),
('1.1005', 'KAS KECIL HARIAN', '0.00', '0.00', '0.00'),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00', '0.00', '0.00'),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00', '0.00', '0.00'),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '0.00', '0.00', '0.00'),
('1.2004', 'PIUTANG SIDOARJO', '0.00', '0.00', '0.00'),
('1.2005', 'PIUTANG KPL 5', '0.00', '0.00', '0.00'),
('1.2006', 'PIUTANG TROSOBO', '0.00', '0.00', '0.00'),
('1.2007', 'PIUTANG DANIEL', '0.00', '0.00', '0.00'),
('1.2008', 'PIUTANG ANDIK', '0.00', '0.00', '0.00'),
('1.3000', 'PERSEDIAAN KANTOR', '0.00', '0.00', '0.00'),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00', '0.00', '0.00'),
('', '', '<strong>0.00</strong>', '<strong>0.00</strong>', '<strong>0.00</strong>'),
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
('2.9000', 'SHU BULAN BERJALAN', '0.00', '0.00', '0.00'),
('', '', '<strong>0.00</strong>', '<strong>0.00</strong>', '<strong>0.00</strong>'),
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
('', '', 'Maret 2019', 'April 2019', ''),
('<strong>AKTIVA</strong>', '', '', '', ''),
('1.1001', 'KAS BANK - BCA', '0.00', '0.00', ''),
('1.1002', 'KAS BANK - MANDIRI', '0.00', '0.00', ''),
('1.1003', 'KAS BANK - BCA SURABAYA', '-12,534,000.00', '-17,397,300.00', ''),
('1.1004', 'KAS BESAR', '0.00', '0.00', ''),
('1.1005', 'KAS KECIL HARIAN', '0.00', '0.00', ''),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '0.00', '0.00', ''),
('1.2002', 'NASABAH MACET > 12 BULAN', '0.00', '0.00', ''),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '13,520,000.00', '19,760,000.00', ''),
('1.2004', 'PIUTANG SIDOARJO', '0.00', '0.00', ''),
('1.2005', 'PIUTANG KPL 5', '0.00', '0.00', ''),
('1.2006', 'PIUTANG TROSOBO', '0.00', '0.00', ''),
('1.2007', 'PIUTANG DANIEL', '0.00', '0.00', ''),
('1.2008', 'PIUTANG ANDIK', '0.00', '0.00', ''),
('1.3000', 'PERSEDIAAN KANTOR', '0.00', '0.00', ''),
('1.4000', 'AKUMULASI PENYUSUTAN', '0.00', '0.00', ''),
('', '', '<strong>986,000.00</strong>', '<strong>2,362,700.00</strong>', ''),
('', '', '', '', ''),
('<strong>PASSIVA</strong>', '', '', '', ''),
('2.1000', 'HUTANG PAJAJARAN', '0.00', '0.00', ''),
('2.2000', 'HUTANG DANIEL', '0.00', '0.00', ''),
('2.3000', 'TITIPAN NASABAH', '0.00', '0.00', ''),
('2.4000', 'MODAL DISETOR', '0.00', '0.00', ''),
('2.5000', 'SHU TAHUN LALU', '0.00', '0.00', ''),
('2.6000', 'SHU TAHUN', '0.00', '0.00', ''),
('2.7000', 'PEMBAGIAN SHU TAHUN', '0.00', '0.00', ''),
('2.8000', 'SHU TAHUN BERJALAN', '0.00', '986,000.00', ''),
('2.9000', 'SHU BULAN BERJALAN', '986,000.00', '1,376,700.00', ''),
('', '', '<strong>986,000.00</strong>', '<strong>2,362,700.00</strong>', ''),
('', '', '', '', ''),
('', '', '<strong>0.00</strong>', '<strong>0.00</strong>', '');

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
('', '', 'Maret 2019', 'April 2019', ''),
('<strong>PENDAPATAN</strong>', '', '', '', ''),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '250,000.00', '812,000.00', ''),
('<strong>PENDAPATAN LAIN</strong>', '', '', '', ''),
('5.3000', 'PENDAPATAN DENDA', '0.00', '78,700.00', ''),
('5.2000', 'PENDAPATAN BUNGA BANK', '0.00', '0.00', ''),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '700,000.00', '550,000.00', ''),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '36,000.00', '36,000.00', ''),
('', '', '<strong>986,000.00</strong>', '<strong>1,476,700.00</strong>', ''),
('', '', '', '', ''),
('<strong>BIAYA</strong>', '', '', '', ''),
('4.5000', 'BIAYA PENYUSUTAN', '0.00', '0.00', ''),
('4.4000', 'BIAYA ADMINISTRASI BANK', '0.00', '0.00', ''),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '0.00', '0.00', ''),
('4.7000', 'POTONGAN', '0.00', '100,000.00', ''),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '0.00', '0.00', ''),
('4.6000', 'BIAYA IKLAN', '0.00', '0.00', ''),
('4.1000', 'BIAYA KARYAWAN', '0.00', '0.00', ''),
('<strong>BIAYA LAIN</strong>', '', '', '', ''),
('6.1000', 'BIAYA LAIN-LAIN', '0.00', '0.00', ''),
('', '', '<strong>0.00</strong>', '<strong>100,000.00</strong>', ''),
('', '', '', '', ''),
('', '', '<strong>986,000.00</strong>', '<strong>1,376,700.00</strong>', '');

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
(13, '13', 'SHU Tahun Berjalan', '2.8000', '2.8000'),
(14, '14', 'Deposito Masuk, Deposito', '1.1003', '2.5000'),
(15, '15', 'Deposito Masuk, Administrasi', '1.1003', '5.5000'),
(16, '16', 'Deposito Masuk, Materai', '1.1003', '5.4000'),
(17, '17', 'Bayar Bunga Deposito', '4.8000', '1.1003');

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
(11, '11', 'SHU Bulan Berjalan', '2.9000');

-- --------------------------------------------------------

--
-- Table structure for table `t91_rekening`
--

CREATE TABLE `t91_rekening` (
  `group` bigint(20) DEFAULT 0,
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT 0.00,
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
(1, '1.1003', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', -12534000.00, '201904'),
(1, '1.1004', 'KAS BESAR', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.1005', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201904'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201904'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201904'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 13520000.00, '201904'),
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
(2, '2.5000', 'DEPOSITO', 'DETAIL', 'CREDIT', 'NERACA', NULL, '2', NULL, 'yes', 0.00, '201904'),
(2, '2.6000', 'SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.7000', 'PEMBAGIAN SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(2, '2.8000', 'SHU TAHUN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 986000.00, '201904'),
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
(3, '3', 'PENDAPATAN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(3, '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '3', '', 'yes', 250000.00, '201904'),
(4, '4', 'BIAYA', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(4, '4.1000', 'BIAYA KARYAWAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.2000', 'BIAYA PERKANTORAN & UMUM', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.3000', 'BIAYA KOMISI MAKELAR / FEE', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.4000', 'BIAYA ADMINISTRASI BANK', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.5000', 'BIAYA PENYUSUTAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.6000', 'BIAYA IKLAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.7000', 'POTONGAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201904'),
(4, '4.8000', 'BIAYA BUNGA DEPOSITO', 'DETAIL', 'DEBET', 'RUGI LABA', NULL, '4', NULL, 'yes', 0.00, '201904'),
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 700000.00, '201904'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 36000.00, '201904'),
(4, '5.5000', 'PENDAPATAN ADMINISTRASI DEPOSITO', 'DETAIL', 'DEBET', 'RUGI LABA', NULL, '4', NULL, 'yes', 0.00, '201904'),
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

--
-- Dumping data for table `t92_periodeold`
--

INSERT INTO `t92_periodeold` (`id`, `Bulan`, `Tahun`, `Tahun_Bulan`) VALUES
(1, 3, 2019, '201903');

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
  `Notes` longtext DEFAULT NULL,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext DEFAULT NULL
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
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2019-02-28 19:02:54', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2019-02-28 19:04:59', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2019-02-28 19:08:50', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2019-03-04 19:10:48', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(5, '2019-03-04 19:11:20', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Nama', '1', '', 'ANDOKO'),
(6, '2019-03-04 19:11:20', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Alamat', '1', '', 'PURI INDAH AA 57'),
(7, '2019-03-04 19:11:20', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'NoHP', '1', '', '081.1111111'),
(8, '2019-03-04 19:11:20', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'id', '1', '', '1'),
(9, '2019-03-04 19:11:33', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Nama', '2', '', 'EKO'),
(10, '2019-03-04 19:11:33', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'Alamat', '2', '', 'PURI NDAH AA 56'),
(11, '2019-03-04 19:11:33', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'NoHP', '2', '', '081.22222222'),
(12, '2019-03-04 19:11:33', '/simkop5/t07_marketingadd.php', '1', 'A', 't07_marketing', 'id', '2', '', '2'),
(13, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '1', '', 'HARI'),
(14, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '1', '', 'GUBENG KERTAJAYA SE / 21 B KAV TEKOM BLOK Q NO 9'),
(15, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '1', '', '087.7019.40292'),
(16, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '1', '', 'PT. IRAWAN DJAJA AGUNG'),
(17, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '1', '', 'RAYA SUKODONO KM 3-8 SIDOARJO'),
(18, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '1', '', '031-7882381'),
(19, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '1', '', '1'),
(20, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '1', '', 'RUMAH SESUAI'),
(21, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '1', '', '1'),
(22, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '1', '', '1'),
(23, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(24, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '1', '', '1'),
(25, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '1', '', 'BUKU TABUNGAN + ATM MANDIRI'),
(26, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '1', '', '088.999.88888 AN HARI'),
(27, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '1', '', ''),
(28, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '1', '', ''),
(29, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '1', '', ''),
(30, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '1', '', ''),
(31, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '1', '', ''),
(32, '2019-03-04 19:16:58', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '1', '', '1'),
(33, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '2', '', '1'),
(34, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '2', '', 'AKTA KELAHIRAN'),
(35, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '2', '', '289000000'),
(36, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '2', '', ''),
(37, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '2', '', ''),
(38, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '2', '', ''),
(39, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '2', '', ''),
(40, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '2', '', ''),
(41, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '2', '', '2'),
(42, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '3', '', '1'),
(43, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '3', '', 'IJAZAH SD'),
(44, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '3', '', ''),
(45, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '3', '', ''),
(46, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '3', '', ''),
(47, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '3', '', ''),
(48, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '3', '', ''),
(49, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '3', '', ''),
(50, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '3', '', '3'),
(51, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '4', '', '1'),
(52, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '4', '', 'JAMSOSTEK'),
(53, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '4', '', ''),
(54, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '4', '', ''),
(55, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '4', '', ''),
(56, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '4', '', ''),
(57, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '4', '', ''),
(58, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '4', '', ''),
(59, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '4', '', '4'),
(60, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '5', '', '1'),
(61, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '5', '', 'KARTU KELUARGA'),
(62, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '5', '', ''),
(63, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '5', '', ''),
(64, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '5', '', ''),
(65, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '5', '', ''),
(66, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '5', '', ''),
(67, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '5', '', ''),
(68, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '5', '', '5'),
(69, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '6', '', '1'),
(70, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '6', '', 'BUKU NIKAH SUAMI N ISTRI'),
(71, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '6', '', ''),
(72, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '6', '', ''),
(73, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '6', '', ''),
(74, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '6', '', ''),
(75, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '6', '', ''),
(76, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '6', '', ''),
(77, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '6', '', '6'),
(78, '2019-03-04 19:16:59', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(79, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '2', '', 'BIMA SAPUTRA'),
(80, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '2', '', 'PERUM PONDOK MUTIARA HARUM AO 12 A JATI SIDOARJO'),
(81, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '2', '', '088.2261.24735'),
(82, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '2', '', 'PT. WAHANA TUNAS UTAMA'),
(83, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '2', '', 'WONOSARI, DS WATESNEGORO, NGORO GUNUNGSARI MOJOKERTO'),
(84, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '2', '', '0321-6819010'),
(85, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '2', '', '2'),
(86, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '2', '', 'ALAMAT TIDAK SESUAI'),
(87, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '2', '', '2'),
(88, '2019-03-04 19:20:31', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '2', '', '2'),
(89, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(90, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '7', '', '2'),
(91, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '7', '', 'JAMSOSTEK'),
(92, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '7', '', ''),
(93, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '7', '', ''),
(94, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '7', '', ''),
(95, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '7', '', ''),
(96, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '7', '', ''),
(97, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '7', '', ''),
(98, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '7', '', '7'),
(99, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '8', '', '2'),
(100, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '8', '', 'BUKU TABUNGAN + ATM BRI'),
(101, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '8', '', ''),
(102, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '8', '', ''),
(103, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '8', '', ''),
(104, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '8', '', ''),
(105, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '8', '', ''),
(106, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '8', '', ''),
(107, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '8', '', '8'),
(108, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '9', '', '2'),
(109, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '9', '', 'KARTU KELUARGA'),
(110, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '9', '', ''),
(111, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '9', '', ''),
(112, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '9', '', ''),
(113, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '9', '', ''),
(114, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '9', '', ''),
(115, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '9', '', ''),
(116, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '9', '', '9'),
(117, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '10', '', '2'),
(118, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '10', '', 'IJAZAH SMA'),
(119, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '10', '', ''),
(120, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '10', '', ''),
(121, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '10', '', ''),
(122, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '10', '', ''),
(123, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '10', '', ''),
(124, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '10', '', ''),
(125, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '10', '', '10'),
(126, '2019-03-04 19:20:32', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(127, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '3', '', 'ANDRIAN YONAS ISNANDAR'),
(128, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '3', '', 'RUSUN PENJARINGANSARI BLOK A 31 A SURABAYA'),
(129, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '3', '', '089.9355.5870'),
(130, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '3', '', 'PT. SHELTER NUSANTARA'),
(131, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '3', '', 'MEDOKAN SEMAMPIR SELATAN VA NO. 8'),
(132, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '3', '', '031-5925075'),
(133, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '3', '', '1'),
(134, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '3', '', 'ALAMAT SESUAI'),
(135, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '3', '', '1'),
(136, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '3', '', '3'),
(137, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(138, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '11', '', '3'),
(139, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '11', '', 'BUKU TABUNGAN + ATM BCA'),
(140, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '11', '', ''),
(141, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '11', '', ''),
(142, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '11', '', ''),
(143, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '11', '', ''),
(144, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '11', '', ''),
(145, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '11', '', ''),
(146, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '11', '', '11'),
(147, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '12', '', '3'),
(148, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '12', '', 'JAMSOSTEK'),
(149, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '12', '', ''),
(150, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '12', '', ''),
(151, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '12', '', ''),
(152, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '12', '', ''),
(153, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '12', '', ''),
(154, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '12', '', ''),
(155, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '12', '', '12'),
(156, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '13', '', '3'),
(157, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '13', '', 'KARTU KELUARGA'),
(158, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '13', '', ''),
(159, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '13', '', ''),
(160, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '13', '', ''),
(161, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '13', '', ''),
(162, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '13', '', ''),
(163, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '13', '', ''),
(164, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '13', '', '13'),
(165, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '14', '', '3'),
(166, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '14', '', 'IJAZAH SMK'),
(167, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '14', '', ''),
(168, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '14', '', ''),
(169, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '14', '', ''),
(170, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '14', '', ''),
(171, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '14', '', ''),
(172, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '14', '', ''),
(173, '2019-03-04 19:23:44', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '14', '', '14'),
(174, '2019-03-04 19:23:45', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(175, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '60001'),
(176, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2019-03-04'),
(177, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(178, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '1,2,3,4,5,6'),
(179, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(180, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '10'),
(181, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.40'),
(182, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(183, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '5'),
(184, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '1040000'),
(185, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '250000'),
(186, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1290000'),
(187, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', ''),
(188, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '500000'),
(189, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '18000'),
(190, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(191, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201903'),
(192, '2019-03-04 19:27:53', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(193, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '2', '', '60002'),
(194, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '2', '', '2019-03-01'),
(195, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '3'),
(196, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '2', '', '11,12,13,14'),
(197, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '4160000'),
(198, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '2', '', '6'),
(199, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '2', '', '2.24'),
(200, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '2', '', '0.4'),
(201, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '2', '', '5'),
(202, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '2', '', '694000'),
(203, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '2', '', '93000'),
(204, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '2', '', '787000'),
(205, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '2', '', ''),
(206, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '2', '', '200000'),
(207, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '2', '', '18000'),
(208, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '2', '', '1'),
(209, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '2', '', '201903'),
(210, '2019-03-04 19:30:37', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(211, '2019-03-04 19:34:41', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(212, '2019-03-14 15:22:50', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(213, '2019-03-14 15:35:17', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(214, '2019-04-01 11:17:35', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(215, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '1', '', '2019-03-30'),
(216, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '1', '', '-5'),
(217, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '1', '', '0'),
(218, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '1', '', '0'),
(219, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '1', '', '1290000'),
(220, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '1', '', '1290000'),
(221, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '1', '', 'CB 2500000'),
(222, '2019-04-01 13:41:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '1', '', '201903'),
(223, '2019-04-01 13:46:51', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(224, '2019-04-05 14:06:18', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(225, '2019-04-09 13:43:05', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(226, '2019-04-16 10:28:33', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(227, '2019-04-16 11:20:14', '/simkop5/t75_companyedit.php', '1', 'U', 't75_company', 'NoTelp', '1', '', '-'),
(228, '2019-04-16 11:25:43', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '13', '', '13'),
(229, '2019-04-16 11:25:43', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '13', '', 'SHU Tahun Berjalan'),
(230, '2019-04-16 11:25:43', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '13', '', '2.8000'),
(231, '2019-04-16 11:25:43', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '13', '', '2.8000'),
(232, '2019-04-16 11:25:43', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '13', '', '13'),
(233, '2019-04-16 14:26:55', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(234, '2019-04-22 10:59:39', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(235, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Nama', '4', '', 'DHART0 DJUNAIDI'),
(236, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Alamat', '4', '', 'TROSOBO UTAMA VII H/20 (21/5) SIDODADI TAMAN'),
(237, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'No_Telp_Hp', '4', '', '082.1433.14889'),
(238, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '4', '', 'PT. CITRA GARDA INTERNUSA'),
(239, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_Alamat', '4', '', 'TAMAN NAGOYA F1 NO. 55 GEDANGAN SIDOARJO'),
(240, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Pekerjaan_No_Telp_Hp', '4', '', '082.1430.59766'),
(241, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Status', '4', '', '1'),
(242, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'Keterangan', '4', '', 'HUTANG PINJAMAN'),
(243, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'marketing_id', '4', '', '1'),
(244, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't01_nasabah', 'id', '4', '', '4'),
(245, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert begin ***', 't02_jaminan', '', '', '', ''),
(246, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '15', '', '4'),
(247, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '15', '', 'BUKU TABUNGAN + ATM MANDIRI'),
(248, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '15', '', ''),
(249, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '15', '', ''),
(250, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '15', '', ''),
(251, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '15', '', ''),
(252, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '15', '', ''),
(253, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '15', '', ''),
(254, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '15', '', '15'),
(255, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '16', '', '4'),
(256, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '16', '', 'JAMSOSTEK'),
(257, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '16', '', ''),
(258, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '16', '', ''),
(259, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '16', '', ''),
(260, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '16', '', ''),
(261, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '16', '', ''),
(262, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '16', '', ''),
(263, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '16', '', '16'),
(264, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '17', '', '4'),
(265, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '17', '', 'AKTA LAHIR'),
(266, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '17', '', ''),
(267, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '17', '', ''),
(268, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '17', '', ''),
(269, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '17', '', ''),
(270, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '17', '', ''),
(271, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '17', '', ''),
(272, '2019-04-22 13:24:05', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '17', '', '17'),
(273, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '18', '', '4'),
(274, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '18', '', 'IJAZAH SMP'),
(275, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '18', '', ''),
(276, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '18', '', ''),
(277, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '18', '', ''),
(278, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '18', '', ''),
(279, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '18', '', ''),
(280, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '18', '', ''),
(281, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '18', '', '18'),
(282, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'nasabah_id', '19', '', '4'),
(283, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Merk_Type', '19', '', '2 BUKU NIKAH'),
(284, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Rangka', '19', '', ''),
(285, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Mesin', '19', '', ''),
(286, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Warna', '19', '', ''),
(287, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'No_Pol', '19', '', ''),
(288, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Keterangan', '19', '', ''),
(289, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'Atas_Nama', '19', '', ''),
(290, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', 'A', 't02_jaminan', 'id', '19', '', '19'),
(291, '2019-04-22 13:24:06', '/simkop5/t01_nasabahadd.php', '1', '*** Batch insert successful ***', 't02_jaminan', '', '', '', ''),
(292, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '3', '', '60003'),
(293, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '3', '', '2019-04-22'),
(294, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '3', '', '4'),
(295, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '3', '', '15,16,17,18,19'),
(296, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '3', '', '4160000'),
(297, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '3', '', '7'),
(298, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '3', '', '2.40'),
(299, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '3', '', '0.4'),
(300, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '3', '', '5'),
(301, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '3', '', '595000'),
(302, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '3', '', '100000'),
(303, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '3', '', '695000'),
(304, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '3', '', ''),
(305, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '3', '', '200000'),
(306, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '3', '', '18000'),
(307, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '3', '', '1'),
(308, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '3', '', '201904'),
(309, '2019-04-22 13:27:45', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '3', '', '3'),
(310, '2019-04-22 13:55:40', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(311, '2019-04-22 14:06:28', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(312, '2019-04-22 15:29:59', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(313, '2019-04-22 15:36:11', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(314, '2019-04-22 15:36:49', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(315, '2019-04-22 15:40:26', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(316, '2019-04-22 16:12:02', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(317, '2019-04-23 11:31:06', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(318, '2019-04-23 14:04:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', '', '2019-04-23'),
(319, '2019-04-23 14:04:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '2', '0.00', '1290000'),
(320, '2019-04-23 14:04:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '2', '0.00', '1290000'),
(321, '2019-04-23 14:04:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '2', '', 'Denda Rp. 56,760.00'),
(322, '2019-04-23 14:04:37', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '2', '', '201904'),
(323, '2019-04-23 14:22:56', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(324, '2019-04-24 10:17:18', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(325, '2019-04-24 13:22:29', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(326, '2019-04-25 13:22:38', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(327, '2019-04-25 13:29:49', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(328, '2019-04-25 13:34:04', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(329, '2019-04-25 13:35:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '2', '2019-04-23', '2019-04-24'),
(330, '2019-04-25 13:35:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '2', '0', '-10'),
(331, '2019-04-25 13:35:26', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '2', 'Denda Rp. 56,760.00', 'cb 2150000'),
(332, '2019-04-25 13:48:13', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(333, '2019-04-29 13:19:26', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(334, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '11', '', '2019-04-26'),
(335, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '11', '0', '25'),
(336, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '11', '0.00', '58700'),
(337, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '11', '0.00', '787000'),
(338, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '11', '0.00', '845700'),
(339, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '11', '', ''),
(340, '2019-04-29 13:26:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '11', '', '201904'),
(341, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '12', '', '2019-04-26'),
(342, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '12', '0', '-5'),
(343, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '12', '0.00', '20000'),
(344, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '12', '0.00', '787000'),
(345, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '12', '0.00', '807000'),
(346, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '12', '', ''),
(347, '2019-04-29 13:28:55', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '12', '', '201904'),
(348, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '13', '', '2019-04-29'),
(349, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '13', '0', '-33'),
(350, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '13', '0.00', '787000'),
(351, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '13', '0.00', '787000'),
(352, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '13', '', ''),
(353, '2019-04-29 13:36:36', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '13', '', '201904'),
(354, '2019-04-29 13:36:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '14', '', '2019-04-29'),
(355, '2019-04-29 13:36:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '14', '0.00', '787000'),
(356, '2019-04-29 13:36:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '14', '0.00', '787000'),
(357, '2019-04-29 13:36:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '14', '', ''),
(358, '2019-04-29 13:36:56', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '14', '', '201904'),
(359, '2019-04-29 13:37:21', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '15', '', '2019-04-29'),
(360, '2019-04-29 13:37:21', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '15', '0.00', '787000'),
(361, '2019-04-29 13:37:21', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '15', '0.00', '787000'),
(362, '2019-04-29 13:37:21', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '15', '', ''),
(363, '2019-04-29 13:37:21', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '15', '', '201904'),
(364, '2019-04-29 13:37:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '16', '', '2019-04-29'),
(365, '2019-04-29 13:37:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '16', '0.00', '787000'),
(366, '2019-04-29 13:37:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '16', '0.00', '787000'),
(367, '2019-04-29 13:37:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Keterangan', '16', '', ''),
(368, '2019-04-29 13:37:41', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '16', '', '201904'),
(369, '2019-04-29 13:38:11', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Tanggal', '1', '', '2019-04-29'),
(370, '2019-04-29 13:38:11', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Keterangan', '1', '', 'POTONGAN PELUNASAN 60001'),
(371, '2019-04-29 13:38:11', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'Jumlah', '1', '', '100000'),
(372, '2019-04-29 13:38:11', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'pinjaman_id', '1', '', '2'),
(373, '2019-04-29 13:38:11', '/simkop5/t08_pinjamanpotonganadd.php', '1', 'A', 't08_pinjamanpotongan', 'id', '1', '', '1'),
(374, '2019-04-29 13:46:49', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(375, '2019-04-30 10:09:43', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(376, '2019-04-30 10:12:01', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '16', '0', '-125'),
(377, '2019-04-30 10:12:15', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '15', '0', '-94'),
(378, '2019-04-30 10:13:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '14', '2019-04-29', '2019-04-30'),
(379, '2019-04-30 10:13:05', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '14', '0', '-62'),
(380, '2019-04-30 10:13:34', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '14', '2019-04-30', '2019-04-29'),
(381, '2019-04-30 10:13:34', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '14', '-62', '-63'),
(382, '2019-04-30 10:30:55', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(383, '2019-04-30 10:30:55', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '68', 'Y', 'N'),
(384, '2019-04-30 10:30:56', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(385, '2019-04-30 10:32:01', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(386, '2019-04-30 10:32:02', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '68', '99', '11'),
(387, '2019-04-30 10:32:02', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '68', 'N', 'Y'),
(388, '2019-04-30 10:32:02', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(389, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(390, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'Y', 'N'),
(391, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '3', 'Y', 'N'),
(392, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '6', 'Y', 'N'),
(393, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'Y', 'N'),
(394, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '65', 'Y', 'N'),
(395, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '66', 'Y', 'N'),
(396, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '67', 'Y', 'N'),
(397, '2019-04-30 10:56:06', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(398, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(399, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '2', 'N', 'Y'),
(400, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '3', 'N', 'Y'),
(401, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '6', 'N', 'Y'),
(402, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '7', 'N', 'Y'),
(403, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '65', 'N', 'Y'),
(404, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '66', 'N', 'Y'),
(405, '2019-04-30 10:56:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '67', 'N', 'Y'),
(406, '2019-04-30 10:56:47', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(407, '2019-04-30 13:53:43', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(408, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '4', '', '60002B'),
(409, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '4', '', '2019-04-30'),
(410, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '4', '', '3'),
(411, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '4', '', '11,12,13,14'),
(412, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '4', '', '7280000'),
(413, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '4', '', '8'),
(414, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '4', '', '2.25'),
(415, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '4', '', '0.40'),
(416, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '4', '', '5'),
(417, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '4', '', '910000'),
(418, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '4', '', '164000');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(419, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '4', '', '1074000'),
(420, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '4', '', ''),
(421, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '4', '', '350000'),
(422, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '4', '', '18000.00'),
(423, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '4', '', '1'),
(424, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '4', '', '201904'),
(425, '2019-04-30 14:00:42', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '4', '', '4'),
(426, '2019-04-30 14:26:31', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(427, '2019-06-08 09:58:05', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(428, '2019-06-10 20:17:44', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(429, '2019-06-18 17:32:32', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(430, '2019-06-20 10:37:47', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(431, '2019-06-20 11:02:14', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(432, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_name', '69', '', 'Tanggal_Bayar'),
(433, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_caption', '69', '', 'Tanggal Bayar'),
(434, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_index', '69', '', '99'),
(435, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_status', '69', '', 'Y'),
(436, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_align', '69', '', 'left'),
(437, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_format', '69', '', 'tanggal'),
(438, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'id', '69', '', '69'),
(439, '2019-06-20 11:02:15', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(440, '2019-06-20 11:30:50', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(441, '2019-06-20 11:30:50', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '69', '99', '12'),
(442, '2019-06-20 11:30:50', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(443, '2019-06-20 11:59:16', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(444, '2019-06-20 11:59:16', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(445, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(446, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_name', '70', '', 'umur_tunggakan'),
(447, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_caption', '70', '', 'Umur Tunggakan'),
(448, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_index', '70', '', '99'),
(449, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_status', '70', '', 'Y'),
(450, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_align', '70', '', 'right'),
(451, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'field_format', '70', '', 'none'),
(452, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', 'A', 't73_pinjamanlap', 'id', '70', '', '70'),
(453, '2019-06-20 11:59:52', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(454, '2019-06-20 12:00:34', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(455, '2019-06-20 12:00:35', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '69', '12', '99'),
(456, '2019-06-20 12:00:35', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '69', 'Y', 'N'),
(457, '2019-06-20 12:00:35', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_index', '70', '99', '12'),
(458, '2019-06-20 12:00:35', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(459, '2019-06-20 12:07:46', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(460, '2019-06-20 12:07:46', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '69', 'N', 'Y'),
(461, '2019-06-20 12:07:46', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(462, '2019-06-21 11:06:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(463, '2019-06-22 11:25:43', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(464, '2019-07-12 16:15:47', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(465, '2019-07-13 15:34:57', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(466, '2019-07-13 15:57:09', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(467, '2019-07-13 16:10:27', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(468, '2019-07-13 16:38:39', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(469, '2019-07-13 16:38:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(470, '2019-07-15 18:02:17', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(471, '2019-07-17 09:08:31', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(472, '2019-07-17 09:38:59', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(473, '2019-07-17 09:39:07', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(474, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'No_Urut', '1', '', '00001'),
(475, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Valuta', '1', '', '2019-07-17'),
(476, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Jatuh_Tempo', '1', '', '2019-07-17'),
(477, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'nasabah_id', '1', '', '0'),
(478, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Deposito', '1', '', '20000000'),
(479, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Terbilang', '1', '', 'Dua Puluh  Juta  Rupiah'),
(480, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Suku_Bunga', '1', '', '12'),
(481, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Bunga', '1', '', '200000'),
(482, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Dikredit_Diperpanjang', '1', '', 'Diperpanjang'),
(483, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tunai_Transfer', '1', '', 'Transfer'),
(484, '2019-07-17 15:31:57', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'id', '1', '', '1'),
(485, '2019-07-17 16:10:30', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'nasabah_id', '1', '0', '1'),
(486, '2019-07-17 16:20:33', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'nasabah_id', '1', '1', '2'),
(487, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'No_Urut', '2', '', '00002'),
(488, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Valuta', '2', '', '2019-07-17'),
(489, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Jatuh_Tempo', '2', '', '2019-07-17'),
(490, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'nasabah_id', '2', '', '4'),
(491, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Deposito', '2', '', '14000000'),
(492, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Terbilang', '2', '', 'Empat Belas  Juta  Rupiah'),
(493, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Suku_Bunga', '2', '', '12'),
(494, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Bunga', '2', '', '140000'),
(495, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Dikredit_Diperpanjang', '2', '', 'Dikredit'),
(496, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tunai_Transfer', '2', '', 'Tunai'),
(497, '2019-07-17 16:23:47', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'id', '2', '', '2'),
(498, '2019-07-17 16:37:23', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'nasabah_id', '2', '4', '3'),
(499, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'nasabah_id', '1', '', '1'),
(500, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'Nomor', '1', '', '3515112412740001'),
(501, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'Pemilik', '1', '', 'HARI HARIYANTO'),
(502, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'Bank', '1', '', 'BCA'),
(503, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'Kota', '1', '', 'SURABAYA'),
(504, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'Cabang', '1', '', 'RUNGKUT'),
(505, '2019-07-17 17:19:02', '/simkop5/t21_bankadd.php', '1', 'A', 't21_bank', 'id', '1', '', '1'),
(506, '2019-07-17 17:19:35', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'nasabah_id', '2', '3', '1'),
(507, '2019-07-17 17:19:35', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'bank_id', '2', NULL, '1'),
(508, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', '*** Batch insert begin ***', 't72_depositolap', '', '', '', ''),
(509, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '1', '', 'no_urut'),
(510, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '1', '', 'Y'),
(511, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '1', '', 'No. Urut'),
(512, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '1', '', 'left'),
(513, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '1', '', '1'),
(514, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '1', '', 'none'),
(515, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '1', '', '1'),
(516, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '2', '', 'tanggal_valuta'),
(517, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '2', '', 'Y'),
(518, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '2', '', 'Tgl. Valuta'),
(519, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '2', '', 'left'),
(520, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '2', '', '2'),
(521, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '2', '', 'tanggal'),
(522, '2019-07-18 12:26:29', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '2', '', '2'),
(523, '2019-07-18 12:26:30', '/simkop5/t72_depositolaplist.php', '1', '*** Batch insert successful ***', 't72_depositolap', '', '', '', ''),
(524, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(525, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '3', '', 'tanggal_jatuh_tempo'),
(526, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '3', '', 'Y'),
(527, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '3', '', 'Tgl. Jatuh Tempo'),
(528, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '3', '', 'left'),
(529, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '3', '', '0'),
(530, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '3', '', 'tanggal'),
(531, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '3', '', '3'),
(532, '2019-07-18 12:28:06', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(533, '2019-07-18 12:34:12', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(534, '2019-07-18 12:34:12', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '3', '0', '3'),
(535, '2019-07-18 12:34:12', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(536, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(537, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '4', '', 'suku_bunga'),
(538, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '4', '', 'Suku Bunga'),
(539, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '4', '', '4'),
(540, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '4', '', 'Y'),
(541, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '4', '', 'right'),
(542, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '4', '', 'numerik'),
(543, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '4', '', '4'),
(544, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '5', '', 'jumlah_bunga'),
(545, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '5', '', 'Jumlah Bunga'),
(546, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '5', '', '5'),
(547, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '5', '', 'Y'),
(548, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '5', '', 'right'),
(549, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '5', '', 'numerik'),
(550, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '5', '', '5'),
(551, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '6', '', 'dikredit_diperpanjang'),
(552, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '6', '', 'Jumlah Pokok'),
(553, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '6', '', '6'),
(554, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '6', '', 'Y'),
(555, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '6', '', 'left'),
(556, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '6', '', 'none'),
(557, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '6', '', '6'),
(558, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '7', '', 'tunai_transfer'),
(559, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '7', '', 'Bunga'),
(560, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '7', '', '7'),
(561, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '7', '', 'Y'),
(562, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '7', '', 'left'),
(563, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '7', '', 'none'),
(564, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '7', '', '7'),
(565, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '8', '', 'jumlah_deposito'),
(566, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '8', '', 'Jumlah Deposito'),
(567, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '8', '', '8'),
(568, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '8', '', 'Y'),
(569, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '8', '', 'right'),
(570, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '8', '', 'numerik'),
(571, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '8', '', '8'),
(572, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '9', '', 'jumlah_terbilang'),
(573, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '9', '', 'Terbilang'),
(574, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '9', '', '9'),
(575, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '9', '', 'Y'),
(576, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '9', '', 'left'),
(577, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '9', '', 'none'),
(578, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '9', '', '9'),
(579, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '10', '', 'nama'),
(580, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '10', '', 'Nasabah'),
(581, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '10', '', '10'),
(582, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '10', '', 'Y'),
(583, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '10', '', 'left'),
(584, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '10', '', 'none'),
(585, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '10', '', '10'),
(586, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '11', '', 'alamat'),
(587, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '11', '', 'Alamat'),
(588, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '11', '', '11'),
(589, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '11', '', 'Y'),
(590, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '11', '', 'left'),
(591, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '11', '', 'none'),
(592, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '11', '', '11'),
(593, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '12', '', 'no_telp_hp'),
(594, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '12', '', 'No. Telp./HP'),
(595, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '12', '', '12'),
(596, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '12', '', 'Y'),
(597, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '12', '', 'left'),
(598, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '12', '', 'none'),
(599, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '12', '', '12'),
(600, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '13', '', 'pekerjaan'),
(601, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '13', '', 'Pekerjaan'),
(602, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '13', '', '13'),
(603, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '13', '', 'Y'),
(604, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '13', '', 'left'),
(605, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '13', '', 'none'),
(606, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '13', '', '13'),
(607, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '14', '', 'pekerjaan_alamat'),
(608, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '14', '', 'Alamat Pekerjaan'),
(609, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '14', '', '14'),
(610, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '14', '', 'Y'),
(611, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '14', '', 'left'),
(612, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '14', '', 'none'),
(613, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '14', '', '14'),
(614, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '15', '', 'pekerjaan_no_telp_hp'),
(615, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '15', '', 'No. Telp./HP Pekerjaan'),
(616, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '15', '', '15'),
(617, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '15', '', 'Y'),
(618, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '15', '', 'left'),
(619, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '15', '', 'none'),
(620, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '15', '', '15'),
(621, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '16', '', 'status'),
(622, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '16', '', 'Status'),
(623, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '16', '', '16'),
(624, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '16', '', 'Y'),
(625, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '16', '', 'left'),
(626, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '16', '', 'none'),
(627, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '16', '', '16'),
(628, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '17', '', 'keterangan'),
(629, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '17', '', 'Keterangan'),
(630, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '17', '', '17'),
(631, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '17', '', 'Y'),
(632, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '17', '', 'left'),
(633, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '17', '', 'none'),
(634, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '17', '', '17'),
(635, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '18', '', 'nomor'),
(636, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '18', '', 'Nomor Rekening'),
(637, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '18', '', '18'),
(638, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '18', '', 'Y'),
(639, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '18', '', 'left'),
(640, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '18', '', 'none'),
(641, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '18', '', '18'),
(642, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '19', '', 'pemilik'),
(643, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '19', '', 'Nama Pemilik Rekening'),
(644, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '19', '', '19'),
(645, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '19', '', 'Y'),
(646, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '19', '', 'left'),
(647, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '19', '', 'none'),
(648, '2019-07-18 13:12:36', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '19', '', '19'),
(649, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '20', '', 'bank'),
(650, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '20', '', 'Bank'),
(651, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '20', '', '20'),
(652, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '20', '', 'Y'),
(653, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '20', '', 'left'),
(654, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '20', '', 'none'),
(655, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '20', '', '20'),
(656, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '21', '', 'kota'),
(657, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '21', '', 'Kota'),
(658, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '21', '', '21'),
(659, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '21', '', 'Y'),
(660, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '21', '', 'left'),
(661, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '21', '', 'none'),
(662, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '21', '', '21'),
(663, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '22', '', 'cabang'),
(664, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '22', '', 'Cabang'),
(665, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '22', '', '22'),
(666, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '22', '', 'Y'),
(667, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '22', '', 'left'),
(668, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '22', '', 'none'),
(669, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '22', '', '22'),
(670, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '23', '', 'Marketing_Nama'),
(671, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '23', '', 'Marketing'),
(672, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '23', '', '23'),
(673, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '23', '', 'Y'),
(674, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '23', '', 'left'),
(675, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '23', '', 'none'),
(676, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '23', '', '23'),
(677, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '24', '', 'Marketing_Alamat'),
(678, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '24', '', 'Alamat Marketing'),
(679, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '24', '', '24'),
(680, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '24', '', 'Y'),
(681, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '24', '', 'left'),
(682, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '24', '', 'none'),
(683, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '24', '', '24'),
(684, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '25', '', 'Marketing_NoHP'),
(685, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '25', '', 'No. HP Marketing'),
(686, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '25', '', '25'),
(687, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '25', '', 'Y'),
(688, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '25', '', 'left'),
(689, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '25', '', 'none'),
(690, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '25', '', '25'),
(691, '2019-07-18 13:12:37', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(692, '2019-07-18 13:12:53', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(693, '2019-07-18 13:12:53', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(694, '2019-07-18 13:15:41', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(695, '2019-07-18 13:15:42', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(696, '2019-07-18 13:16:57', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update begin ***', 't73_pinjamanlap', '', '', '', ''),
(697, '2019-07-18 13:16:57', '/simkop5/t73_pinjamanlaplist.php', '1', 'U', 't73_pinjamanlap', 'field_status', '26', 'N', 'Y'),
(698, '2019-07-18 13:16:57', '/simkop5/t73_pinjamanlaplist.php', '1', '*** Batch update successful ***', 't73_pinjamanlap', '', '', '', ''),
(699, '2019-07-18 15:02:48', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(700, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'No_Urut', '1', '', '00001'),
(701, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Valuta', '1', '', '2019-07-18'),
(702, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Jatuh_Tempo', '1', '', '2019-07-18'),
(703, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'nasabah_id', '1', '', '1'),
(704, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'bank_id', '1', '', '1'),
(705, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Deposito', '1', '', '30000000'),
(706, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Terbilang', '1', '', 'Tiga Puluh  Juta  Rupiah'),
(707, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Suku_Bunga', '1', '', '12'),
(708, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Bunga', '1', '', '300000'),
(709, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Dikredit_Diperpanjang', '1', '', 'Diperpanjang'),
(710, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tunai_Transfer', '1', '', 'Transfer'),
(711, '2019-07-18 17:11:43', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'id', '1', '', '1'),
(712, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'No_Urut', '1', '', '00001'),
(713, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Valuta', '1', '', '2019-04-18'),
(714, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Jatuh_Tempo', '1', '', '2019-07-18'),
(715, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'nasabah_id', '1', '', '1'),
(716, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'bank_id', '1', '', '1'),
(717, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Deposito', '1', '', '30000000'),
(718, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Terbilang', '1', '', 'Tiga Puluh  Juta  Rupiah'),
(719, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Suku_Bunga', '1', '', '12'),
(720, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Bunga', '1', '', '300000'),
(721, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Dikredit_Diperpanjang', '1', '', 'Diperpanjang'),
(722, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tunai_Transfer', '1', '', 'Transfer'),
(723, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Periode', '1', '', '201904'),
(724, '2019-07-18 17:17:41', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'id', '1', '', '1'),
(725, '2019-07-18 18:37:24', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(726, '2019-07-18 18:59:43', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(727, '2019-07-19 10:43:12', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(728, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(729, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '12', 'Y', 'N'),
(730, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '13', 'Y', 'N'),
(731, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '14', 'Y', 'N'),
(732, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '15', 'Y', 'N'),
(733, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '16', 'Y', 'N'),
(734, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '17', 'Y', 'N'),
(735, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '18', 'Y', 'N'),
(736, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '19', 'Y', 'N'),
(737, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '20', 'Y', 'N'),
(738, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '21', 'Y', 'N'),
(739, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '22', 'Y', 'N'),
(740, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '23', 'Y', 'N'),
(741, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '24', 'Y', 'N'),
(742, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '25', 'Y', 'N'),
(743, '2019-07-19 10:45:35', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(744, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(745, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '1', 'No. Urut', 'No. Kontrak'),
(746, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '2', 'Tgl. Valuta', 'Tgl. Masuk'),
(747, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '2', '2', '99'),
(748, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '10', 'Nasabah', 'Nama Nasabah'),
(749, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '10', '10', '2'),
(750, '2019-07-19 10:46:30', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(751, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(752, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '3', '3', '99'),
(753, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '8', 'Jumlah Deposito', 'Deposito'),
(754, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '8', '8', '4'),
(755, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '11', '11', '3'),
(756, '2019-07-19 10:48:19', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(757, '2019-07-19 10:49:05', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(758, '2019-07-19 10:49:05', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '4', '4', '5'),
(759, '2019-07-19 10:49:05', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '5', '5', '99'),
(760, '2019-07-19 10:49:05', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(761, '2019-07-19 10:49:41', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(762, '2019-07-19 10:49:41', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '7', 'Y', 'N'),
(763, '2019-07-19 10:49:41', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '9', 'Y', 'N'),
(764, '2019-07-19 10:49:41', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(765, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(766, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '6', '6', '99'),
(767, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '6', 'Y', 'N'),
(768, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '7', '7', '99'),
(769, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '9', '9', '99'),
(770, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '12', '12', '99'),
(771, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '13', '13', '99'),
(772, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '14', '14', '99'),
(773, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '15', '15', '99'),
(774, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '16', '16', '99'),
(775, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '17', '17', '99'),
(776, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '18', '18', '99'),
(777, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '19', '19', '99'),
(778, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '20', '20', '99'),
(779, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '21', '21', '99'),
(780, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '22', '22', '99'),
(781, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '23', '23', '99'),
(782, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '24', '24', '99'),
(783, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '25', '25', '99'),
(784, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '5', '99', '8'),
(785, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '3', '99', '7'),
(786, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_index', '2', '99', '6'),
(787, '2019-07-19 10:51:33', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(788, '2019-07-19 10:53:12', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(789, '2019-07-19 10:53:12', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '4', 'Suku Bunga', 'Bunga %'),
(790, '2019-07-19 10:53:12', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_caption', '5', 'Jumlah Bunga', 'Bunga /bulan'),
(791, '2019-07-19 10:53:12', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(792, '2019-07-19 11:01:58', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(793, '2019-07-19 11:02:03', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(794, '2019-07-19 13:22:54', '/simkop5/logout.php', '-1', 'logout', '::1', '', '', '', ''),
(795, '2019-07-19 13:23:00', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(796, '2019-07-19 13:32:11', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(797, '2019-07-19 13:32:44', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(798, '2019-07-19 15:22:11', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'Jumlah_Deposito', '1', '30000000.00', '15000000'),
(799, '2019-07-19 15:22:11', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'Jumlah_Terbilang', '1', 'Tiga Puluh  Juta  Rupiah', 'Lima Belas  Juta  Rupiah'),
(800, '2019-07-19 15:22:11', '/simkop5/t20_depositoedit.php', '1', 'U', 't20_deposito', 'Jumlah_Bunga', '1', '300000.00', '150000'),
(801, '2019-07-19 15:23:07', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(802, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_name', '26', '', 'status_deposito'),
(803, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_caption', '26', '', 'Status Deposito'),
(804, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_index', '26', '', '9'),
(805, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_status', '26', '', 'Y'),
(806, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_align', '26', '', 'left'),
(807, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'field_format', '26', '', 'none'),
(808, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', 'A', 't72_depositolap', 'id', '26', '', '26'),
(809, '2019-07-19 15:23:08', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(810, '2019-07-19 15:23:36', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update begin ***', 't72_depositolap', '', '', '', ''),
(811, '2019-07-19 15:23:36', '/simkop5/t72_depositolaplist.php', '1', 'U', 't72_depositolap', 'field_status', '26', 'Y', 'N'),
(812, '2019-07-19 15:23:36', '/simkop5/t72_depositolaplist.php', '1', '*** Batch update successful ***', 't72_depositolap', '', '', '', ''),
(813, '2019-07-22 17:21:42', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(814, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'Nama', '1', '', 'ADI HARIANTO'),
(815, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'Alamat', '1', '', NULL),
(816, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'No_Telp_Hp', '1', '', NULL),
(817, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'Pekerjaan', '1', '', NULL),
(818, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'Keterangan', '1', '', NULL),
(819, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', 'A', 't22_peserta', 'id', '1', '', '1'),
(820, '2019-07-22 19:08:38', '/simkop5/t22_pesertaadd.php', '1', '*** Batch insert begin ***', 't21_bank', '', '', '', ''),
(821, '2019-07-24 10:59:37', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(822, '2019-07-24 11:10:28', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'rekening', '2.5000', 'SHU TAHUN LALU', 'DEPOSITO'),
(823, '2019-07-24 11:10:28', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'keterangan', '2.5000', '', NULL),
(824, '2019-07-24 11:10:28', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'status', '2.5000', '', NULL),
(825, '2019-07-24 11:11:10', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '14', '', '14'),
(826, '2019-07-24 11:11:10', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '14', '', 'Deposito Masuk'),
(827, '2019-07-24 11:11:10', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '14', '', '1.1000'),
(828, '2019-07-24 11:11:10', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '14', '', '2.5000'),
(829, '2019-07-24 11:11:10', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '14', '', '14'),
(830, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'group', '4.800', '', '4'),
(831, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'parent', '4.800', '', '4'),
(832, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id3', '4.800', '', '4.800'),
(833, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'rekening', '4.800', '', 'BIAYA BUNGA DEPOSITO'),
(834, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'keterangan', '4.800', '', NULL),
(835, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'tipe', '4.800', '', 'DETAIL'),
(836, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'status', '4.800', '', NULL),
(837, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'Saldo', '4.800', '', '0'),
(838, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'Periode', '4.800', '', '201904'),
(839, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id', '4.800', '', '4.800'),
(840, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'posisi', '4.800', '', 'DEBET'),
(841, '2019-07-24 11:13:06', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'laporan', '4.800', '', 'RUGI LABA'),
(842, '2019-07-25 12:53:08', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(843, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'No_Urut', '2', '', '00002'),
(844, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Valuta', '2', '', '2019-04-25'),
(845, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tanggal_Jatuh_Tempo', '2', '', '2019-07-25'),
(846, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'nasabah_id', '2', '', '1'),
(847, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'bank_id', '2', '', '1'),
(848, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Deposito', '2', '', '5000000'),
(849, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Terbilang', '2', '', 'Lima Juta  Rupiah'),
(850, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Suku_Bunga', '2', '', '6'),
(851, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Jumlah_Bunga', '2', '', '25000'),
(852, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Dikredit_Diperpanjang', '2', '', 'Diperpanjang'),
(853, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Tunai_Transfer', '2', '', 'Transfer'),
(854, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Status', '2', '', 'Lanjut'),
(855, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'Periode', '2', '', '201904'),
(856, '2019-07-25 17:04:21', '/simkop5/t20_depositoadd.php', '1', 'A', 't20_deposito', 'id', '2', '', '2'),
(857, '2019-07-27 13:21:13', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(858, '2019-07-30 17:04:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(859, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_No', '1', '', '00001'),
(860, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Tgl', '1', '', '2019-07-31'),
(861, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Lama', '1', '', '3'),
(862, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Tgl', '1', '', '2019-10-31'),
(863, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Deposito', '1', '', '30000000'),
(864, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Suku', '1', '', '12'),
(865, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga', '1', '', '300000'),
(866, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'nasabah_id', '1', '', '1'),
(867, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'bank_id', '1', '', '1'),
(868, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'No_Ref', '1', '', NULL),
(869, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Administrasi', '1', '', '10000'),
(870, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Materai', '1', '', '6000'),
(871, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Status', '1', '', 'Ya'),
(872, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Status', '1', '', 'Diperpanjang'),
(873, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Status', '1', '', 'Transfer'),
(874, '2019-07-31 08:42:41', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'id', '1', '', '1'),
(875, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_No', '1', '', '00001'),
(876, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Tgl', '1', '', '2019-04-30'),
(877, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Lama', '1', '', '3'),
(878, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Tgl', '1', '', '2019-07-30'),
(879, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Deposito', '1', '', '20000000'),
(880, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Suku', '1', '', '12'),
(881, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga', '1', '', '200000'),
(882, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'nasabah_id', '1', '', '1'),
(883, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'bank_id', '1', '', '1'),
(884, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'No_Ref', '1', '', NULL),
(885, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Administrasi', '1', '', '10000'),
(886, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Materai', '1', '', '6000'),
(887, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Status', '1', '', 'Ya'),
(888, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Status', '1', '', 'Diperpanjang'),
(889, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Status', '1', '', 'Transfer'),
(890, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Periode', '1', '', '201904'),
(891, '2019-07-31 10:37:34', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'id', '1', '', '1'),
(892, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '5', '', '60004'),
(893, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '5', '', '2019-04-30'),
(894, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '5', '', '1'),
(895, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '5', '', '1,2,3,4,5,6'),
(896, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '5', '', '10400000'),
(897, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '5', '', '12'),
(898, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '5', '', '2.24'),
(899, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '5', '', '0.4'),
(900, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '5', '', '3'),
(901, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '5', '', '867000'),
(902, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '5', '', '233000'),
(903, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '5', '', '1100000'),
(904, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '5', '', NULL),
(905, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '5', '', '10000'),
(906, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '5', '', '6000'),
(907, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '5', '', '1'),
(908, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '5', '', '201904'),
(909, '2019-07-31 11:50:25', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '5', '', '5'),
(910, '2019-07-31 14:50:57', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(911, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(912, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '2', '', 'Kontrak_Tgl'),
(913, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '2', '', 'Tgl. Kontrak'),
(914, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '2', '', '2'),
(915, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '2', '', 'Y'),
(916, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '2', '', 'left'),
(917, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '2', '', 'none'),
(918, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '2', '', '2'),
(919, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '3', '', 'Kontrak_Lama'),
(920, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '3', '', 'Lama Kontrak'),
(921, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '3', '', '3'),
(922, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '3', '', 'Y'),
(923, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '3', '', 'right'),
(924, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '3', '', 'none'),
(925, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '3', '', '3'),
(926, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '4', '', 'Jatuh_Tempo_Tgl'),
(927, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '4', '', 'Tgl. Jatuh Tempo'),
(928, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '4', '', '4'),
(929, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '4', '', 'Y'),
(930, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '4', '', 'left'),
(931, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '4', '', 'none'),
(932, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '4', '', '4'),
(933, '2019-07-31 16:23:28', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(934, '2019-07-31 16:24:53', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(935, '2019-07-31 16:24:53', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_format', '2', 'none', 'tanggal'),
(936, '2019-07-31 16:24:53', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_format', '4', 'none', 'tanggal'),
(937, '2019-07-31 16:24:53', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(938, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(939, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '5', '', 'Deposito'),
(940, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '5', '', 'Jumlah Deposito'),
(941, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '5', '', '5'),
(942, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '5', '', 'Y'),
(943, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '5', '', 'right'),
(944, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '5', '', 'numerik'),
(945, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '5', '', '5'),
(946, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '6', '', 'Bunga_Suku'),
(947, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '6', '', 'Suku Bunga'),
(948, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '6', '', '6'),
(949, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '6', '', 'Y'),
(950, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '6', '', 'right'),
(951, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '6', '', 'numerik'),
(952, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '6', '', '6'),
(953, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '7', '', 'Bunga'),
(954, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '7', '', 'Jumlah Bunga'),
(955, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '7', '', '7'),
(956, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '7', '', 'Y'),
(957, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '7', '', 'right'),
(958, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '7', '', 'numerik'),
(959, '2019-07-31 16:26:52', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '7', '', '7'),
(960, '2019-07-31 16:26:53', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(961, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(962, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '8', '', 'No_Ref'),
(963, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '8', '', 'No. Ref.'),
(964, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '8', '', '8'),
(965, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '8', '', 'N'),
(966, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '8', '', 'left'),
(967, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '8', '', 'none'),
(968, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '8', '', '8'),
(969, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '9', '', 'Biaya_Administrasi'),
(970, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '9', '', 'Bi. Adm.'),
(971, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '9', '', '9'),
(972, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '9', '', 'N'),
(973, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '9', '', 'right'),
(974, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '9', '', 'numerik'),
(975, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '9', '', '9'),
(976, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '10', '', 'Biaya_Materai'),
(977, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '10', '', 'Bi. Mat.'),
(978, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '10', '', '10'),
(979, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '10', '', 'N'),
(980, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '10', '', 'right'),
(981, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '10', '', 'numerik'),
(982, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '10', '', '10'),
(983, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '11', '', 'Periode'),
(984, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '11', '', 'Periode'),
(985, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '11', '', '11'),
(986, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '11', '', 'N'),
(987, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '11', '', 'left'),
(988, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '11', '', 'none'),
(989, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '11', '', '11'),
(990, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '12', '', 'Kontrak_Status'),
(991, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '12', '', 'Status Kontrak'),
(992, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '12', '', '12'),
(993, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '12', '', 'Y'),
(994, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '12', '', 'left'),
(995, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '12', '', 'none'),
(996, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '12', '', '12'),
(997, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '13', '', 'Jatuh_Tempo_Status'),
(998, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '13', '', 'Status Jatuh Tempo'),
(999, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '13', '', '13'),
(1000, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '13', '', 'Y'),
(1001, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '13', '', 'left'),
(1002, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '13', '', 'none'),
(1003, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '13', '', '13'),
(1004, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '14', '', 'Bunga_Status'),
(1005, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '14', '', 'Status Bunga'),
(1006, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '14', '', '14'),
(1007, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '14', '', 'Y'),
(1008, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '14', '', 'left'),
(1009, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '14', '', 'none'),
(1010, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '14', '', '14'),
(1011, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '15', '', 'nama'),
(1012, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '15', '', 'Nasabah'),
(1013, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '15', '', '15'),
(1014, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '15', '', 'Y'),
(1015, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '15', '', 'left'),
(1016, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '15', '', 'none'),
(1017, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '15', '', '15'),
(1018, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '16', '', 'alamat'),
(1019, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '16', '', 'Alamat'),
(1020, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '16', '', '16'),
(1021, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '16', '', 'Y'),
(1022, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '16', '', 'left'),
(1023, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '16', '', 'none'),
(1024, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '16', '', '16'),
(1025, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '17', '', 'no_telp_hp'),
(1026, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '17', '', 'No. Telp./HP'),
(1027, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '17', '', '17'),
(1028, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '17', '', 'Y'),
(1029, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '17', '', 'left'),
(1030, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '17', '', 'none'),
(1031, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '17', '', '17'),
(1032, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '18', '', 'pekerjaan'),
(1033, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '18', '', 'Pekerjaan'),
(1034, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '18', '', '18'),
(1035, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '18', '', 'Y'),
(1036, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '18', '', 'left'),
(1037, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '18', '', 'none'),
(1038, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '18', '', '18'),
(1039, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '19', '', 'keterangan'),
(1040, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '19', '', 'Keterangan'),
(1041, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '19', '', '19'),
(1042, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '19', '', 'Y'),
(1043, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '19', '', 'left'),
(1044, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '19', '', 'none'),
(1045, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '19', '', '19'),
(1046, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '20', '', 'nomor'),
(1047, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '20', '', 'No. Rek.'),
(1048, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '20', '', '20'),
(1049, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '20', '', 'Y'),
(1050, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '20', '', 'left'),
(1051, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '20', '', 'none'),
(1052, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '20', '', '20'),
(1053, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '21', '', 'pemilik'),
(1054, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '21', '', 'Pemilik Rekening'),
(1055, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '21', '', '21'),
(1056, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '21', '', 'Y'),
(1057, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '21', '', 'left'),
(1058, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '21', '', 'none'),
(1059, '2019-07-31 16:43:27', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '21', '', '21'),
(1060, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '22', '', 'bank'),
(1061, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '22', '', 'Bank'),
(1062, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '22', '', '22'),
(1063, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '22', '', 'Y'),
(1064, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '22', '', 'left'),
(1065, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '22', '', 'none'),
(1066, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '22', '', '22'),
(1067, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '23', '', 'kota'),
(1068, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '23', '', 'Kota'),
(1069, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '23', '', '23'),
(1070, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '23', '', 'Y'),
(1071, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '23', '', 'left'),
(1072, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '23', '', 'none'),
(1073, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '23', '', '23'),
(1074, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_name', '24', '', 'cabang'),
(1075, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_caption', '24', '', 'Cabang'),
(1076, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_index', '24', '', '24'),
(1077, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_status', '24', '', 'Y'),
(1078, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_align', '24', '', 'left'),
(1079, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'field_format', '24', '', 'none'),
(1080, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', 'A', 't71_depositolap', 'id', '24', '', '24'),
(1081, '2019-07-31 16:43:28', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1082, '2019-07-31 16:45:40', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1083, '2019-07-31 16:45:40', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '16', 'Y', 'N'),
(1084, '2019-07-31 16:45:40', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '17', 'Y', 'N'),
(1085, '2019-07-31 16:45:40', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '18', 'Y', 'N'),
(1086, '2019-07-31 16:45:40', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '19', 'Y', 'N'),
(1087, '2019-07-31 16:45:41', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1088, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1089, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '21', 'Y', 'N'),
(1090, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '22', 'Y', 'N'),
(1091, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '23', 'Y', 'N'),
(1092, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '24', 'Y', 'N'),
(1093, '2019-07-31 16:46:03', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1094, '2019-07-31 16:47:37', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1095, '2019-07-31 16:47:38', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '2', '2', '99'),
(1096, '2019-07-31 16:47:38', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '15', '15', '2'),
(1097, '2019-07-31 16:47:38', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1098, '2019-07-31 16:48:27', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1099, '2019-07-31 16:48:27', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '3', '3', '99'),
(1100, '2019-07-31 16:48:27', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '16', '16', '3'),
(1101, '2019-07-31 16:48:27', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '16', 'N', 'Y'),
(1102, '2019-07-31 16:48:27', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1103, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1104, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '4', '4', '6'),
(1105, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '5', '5', '4'),
(1106, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '6', '6', '5'),
(1107, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '12', 'Y', 'N'),
(1108, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '13', 'Y', 'N'),
(1109, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '14', 'Y', 'N'),
(1110, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '20', 'Y', 'N'),
(1111, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_status', '3', 'Y', 'N'),
(1112, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '2', '99', '5'),
(1113, '2019-07-31 16:49:57', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1114, '2019-07-31 16:50:57', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update begin ***', 't71_depositolap', '', '', '', ''),
(1115, '2019-07-31 16:50:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '2', '5', '6'),
(1116, '2019-07-31 16:50:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '4', '6', '7'),
(1117, '2019-07-31 16:50:57', '/simkop5/t71_depositolaplist.php', '1', 'U', 't71_depositolap', 'field_index', '7', '7', '8'),
(1118, '2019-07-31 16:50:57', '/simkop5/t71_depositolaplist.php', '1', '*** Batch update successful ***', 't71_depositolap', '', '', '', ''),
(1119, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'group', '5.5000', '', '4'),
(1120, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'parent', '5.5000', '', '4'),
(1121, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id3', '5.5000', '', '5.5000'),
(1122, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'rekening', '5.5000', '', 'BIAYA ADMINISTRASI DEPOSITO'),
(1123, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'keterangan', '5.5000', '', NULL),
(1124, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'tipe', '5.5000', '', 'DETAIL'),
(1125, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'status', '5.5000', '', NULL),
(1126, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'Saldo', '5.5000', '', '0'),
(1127, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'Periode', '5.5000', '', '201904'),
(1128, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'id', '5.5000', '', '5.5000'),
(1129, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'posisi', '5.5000', '', 'DEBET'),
(1130, '2019-07-31 17:07:13', '/simkop5/t91_rekeningadd.php', '1', 'A', 't91_rekening', 'laporan', '5.5000', '', 'RUGI LABA'),
(1131, '2019-07-31 17:07:33', '/simkop5/t91_rekeningedit.php', '1', 'U', 't91_rekening', 'rekening', '5.5000', 'BIAYA ADMINISTRASI DEPOSITO', 'PENDAPATAN ADMINISTRASI DEPOSITO'),
(1132, '2019-07-31 17:08:05', '/simkop5/t89_rektranlist.php', '1', 'U', 't89_rektran', 'JenisTransaksi', '14', 'Deposito Masuk', 'Deposito Masuk, Jumlah Deposito'),
(1133, '2019-07-31 17:08:21', '/simkop5/t89_rektranedit.php', '1', 'U', 't89_rektran', 'DebetRekening', '14', '1.1000', '1.1003'),
(1134, '2019-07-31 17:10:13', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '15', '', '15'),
(1135, '2019-07-31 17:10:13', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '15', '', 'Deposito Masuk, Administrasi'),
(1136, '2019-07-31 17:10:13', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '15', '', '1.1003'),
(1137, '2019-07-31 17:10:13', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '15', '', '5.5000'),
(1138, '2019-07-31 17:10:13', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '15', '', '15'),
(1139, '2019-07-31 17:10:27', '/simkop5/t89_rektranlist.php', '1', 'U', 't89_rektran', 'JenisTransaksi', '14', 'Deposito Masuk, Jumlah Deposito', 'Deposito Masuk, Deposito'),
(1140, '2019-07-31 17:11:20', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '16', '', '16'),
(1141, '2019-07-31 17:11:20', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '16', '', 'Deposito Masuk, Materai'),
(1142, '2019-07-31 17:11:20', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '16', '', '1.1003'),
(1143, '2019-07-31 17:11:20', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '16', '', '5.4000'),
(1144, '2019-07-31 17:11:20', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '16', '', '16'),
(1145, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_No', '2', '', '00002'),
(1146, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Tgl', '2', '', '2019-04-30'),
(1147, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Lama', '2', '', '3'),
(1148, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Tgl', '2', '', '2019-07-30'),
(1149, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Deposito', '2', '', '20000000'),
(1150, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Suku', '2', '', '12'),
(1151, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga', '2', '', '200000'),
(1152, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'nasabah_id', '2', '', '1'),
(1153, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'bank_id', '2', '', '1'),
(1154, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'No_Ref', '2', '', NULL),
(1155, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Administrasi', '2', '', '10000'),
(1156, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Materai', '2', '', '6000'),
(1157, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Status', '2', '', 'Ya'),
(1158, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Status', '2', '', 'Diperpanjang'),
(1159, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Status', '2', '', 'Transfer'),
(1160, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Periode', '2', '', '201904'),
(1161, '2019-07-31 18:41:55', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'id', '2', '', '2'),
(1162, '2019-07-31 19:39:55', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '4', '0.00', '200000.00'),
(1163, '2019-07-31 19:49:00', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '4', NULL, '201904'),
(1164, '2019-07-31 20:27:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1165, '2019-07-31 20:51:32', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '5', '0.00', '200000.00'),
(1166, '2019-07-31 20:51:32', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '5', NULL, '201904'),
(1167, '2019-07-31 20:53:33', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Tgl', '6', '2019-07-30', '2019-06-29'),
(1168, '2019-07-31 20:53:33', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '6', '0.00', '200000.00'),
(1169, '2019-07-31 20:53:33', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '6', NULL, '201904'),
(1170, '2019-07-31 20:58:28', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '6', '0.00', '200000.00'),
(1171, '2019-07-31 20:58:28', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '6', NULL, '201904'),
(1172, '2019-07-31 21:19:34', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Tgl', '6', '2019-06-29', '2019-06-30'),
(1173, '2019-07-31 21:19:34', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '6', '0.00', '200000.00'),
(1174, '2019-07-31 21:19:34', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '6', NULL, '201904'),
(1175, '2019-07-31 21:29:02', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KodeTransaksi', '17', '', '17'),
(1176, '2019-07-31 21:29:02', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'JenisTransaksi', '17', '', 'Bayar Bunga Deposito'),
(1177, '2019-07-31 21:29:02', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'DebetRekening', '17', '', '4.8000'),
(1178, '2019-07-31 21:29:02', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'KreditRekening', '17', '', '1.1003'),
(1179, '2019-07-31 21:29:02', '/simkop5/t89_rektranlist.php', '1', 'A', 't89_rektran', 'id', '17', '', '17'),
(1180, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_No', '3', '', '00003'),
(1181, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Tgl', '3', '', '2019-04-30'),
(1182, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Lama', '3', '', '5'),
(1183, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Tgl', '3', '', '2019-09-30'),
(1184, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Deposito', '3', '', '30000000'),
(1185, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Suku', '3', '', '12'),
(1186, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga', '3', '', '300000'),
(1187, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'nasabah_id', '3', '', '1'),
(1188, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'bank_id', '3', '', '1'),
(1189, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'No_Ref', '3', '', NULL),
(1190, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Administrasi', '3', '', '10000'),
(1191, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Biaya_Materai', '3', '', '6000'),
(1192, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Kontrak_Status', '3', '', 'Ya'),
(1193, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Jatuh_Tempo_Status', '3', '', 'Diperpanjang'),
(1194, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Bunga_Status', '3', '', 'Transfer'),
(1195, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'Periode', '3', '', '201904'),
(1196, '2019-07-31 21:36:43', '/simkop5/t23_depositoadd.php', '1', 'A', 't23_deposito', 'id', '3', '', '3'),
(1197, '2019-07-31 21:38:05', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Tgl', '7', '2019-05-30', '2019-04-30'),
(1198, '2019-07-31 21:38:05', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Bayar_Jumlah', '7', '0.00', '300000.00'),
(1199, '2019-07-31 21:38:05', '/simkop5/t24_deposito_detailedit.php', '1', 'U', 't24_deposito_detail', 'Periode', '7', NULL, '201904'),
(1200, '2019-08-01 14:22:16', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1201, '2019-08-05 09:50:56', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1202, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '6', '', '60005'),
(1203, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '6', '', '2019-04-05'),
(1204, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '6', '', '4'),
(1205, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '6', '', '15,16,17,18,19'),
(1206, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '6', '', '10000000'),
(1207, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '6', '', '3'),
(1208, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '6', '', '2'),
(1209, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '6', '', '0.4'),
(1210, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '6', '', '3'),
(1211, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '6', '', '10000000'),
(1212, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '6', '', '200000'),
(1213, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '6', '', '10600000'),
(1214, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '6', '', NULL),
(1215, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '6', '', '0'),
(1216, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '6', '', '0'),
(1217, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '6', '', '1'),
(1218, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '6', '', '201904'),
(1219, '2019-08-05 17:03:12', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '6', '', '6'),
(1220, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '44', NULL, '2019-04-06'),
(1221, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '44', NULL, '-29');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1222, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '44', NULL, '0'),
(1223, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '44', NULL, '0'),
(1224, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '44', NULL, '200000'),
(1225, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '44', NULL, '200000'),
(1226, '2019-08-05 17:45:24', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '44', NULL, '201904'),
(1227, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '45', NULL, '2019-04-06'),
(1228, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '45', NULL, '-60'),
(1229, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '45', NULL, '0'),
(1230, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '45', NULL, '0'),
(1231, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '45', NULL, '200000'),
(1232, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '45', NULL, '200000'),
(1233, '2019-08-05 17:45:54', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '45', NULL, '201904'),
(1234, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Tanggal_Bayar', '46', NULL, '2019-04-06'),
(1235, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Terlambat', '46', NULL, '-90'),
(1236, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Total_Denda', '46', NULL, '0'),
(1237, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Titipan', '46', NULL, '0'),
(1238, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Non_Titipan', '46', NULL, '10200000'),
(1239, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Bayar_Total', '46', NULL, '10200000'),
(1240, '2019-08-05 17:46:19', '/simkop5/t04_pinjamanangsurantempedit.php', '1', 'U', 't04_pinjamanangsurantemp', 'Periode', '46', NULL, '201904'),
(1241, '2019-08-09 18:48:35', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1242, '2019-08-09 19:00:04', '/simkop5/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(1243, '2019-08-24 17:27:23', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1244, '2019-08-26 10:12:10', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1245, '2019-08-30 15:06:38', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');

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
-- Indexes for table `t20_deposito`
--
ALTER TABLE `t20_deposito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t21_bank`
--
ALTER TABLE `t21_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t22_peserta`
--
ALTER TABLE `t22_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t23_deposito`
--
ALTER TABLE `t23_deposito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t24_deposito_detail`
--
ALTER TABLE `t24_deposito_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t71_depositolap`
--
ALTER TABLE `t71_depositolap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t72_depositolap`
--
ALTER TABLE `t72_depositolap`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

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
-- AUTO_INCREMENT for table `t20_deposito`
--
ALTER TABLE `t20_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t21_bank`
--
ALTER TABLE `t21_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t22_peserta`
--
ALTER TABLE `t22_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t23_deposito`
--
ALTER TABLE `t23_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t24_deposito_detail`
--
ALTER TABLE `t24_deposito_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t71_depositolap`
--
ALTER TABLE `t71_depositolap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t72_depositolap`
--
ALTER TABLE `t72_depositolap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `t73_pinjamanlap`
--
ALTER TABLE `t73_pinjamanlap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `t75_company`
--
ALTER TABLE `t75_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t82_jurnalold`
--
ALTER TABLE `t82_jurnalold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `t89_rektran`
--
ALTER TABLE `t89_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t90_rektran`
--
ALTER TABLE `t90_rektran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t92_periodeold`
--
ALTER TABLE `t92_periodeold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1246;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
