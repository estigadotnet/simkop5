-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 21, 2019 at 11:50 AM
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
(1, '60001', '2019-03-04', 1, '1,2,3,4,5,6', 10400000.00, 10, '2.40', '0.40', 5, 1040000.00, 250000.00, 1290000.00, '', 500000.00, 18000.00, 1, '201903', 'N'),
(2, '60002', '2019-03-01', 3, '11,12,13,14', 4160000.00, 6, '2.24', '0.40', 5, 694000.00, 93000.00, 787000.00, '', 200000.00, 18000.00, 1, '201903', 'N'),
(3, '60003', '2019-04-22', 4, '15,16,17,18,19', 4160000.00, 7, '2.40', '0.40', 5, 595000.00, 100000.00, 695000.00, '', 200000.00, 18000.00, 1, '201904', 'N'),
(4, '60002B', '2019-04-30', 3, '11,12,13,14', 7280000.00, 8, '2.25', '0.40', 5, 910000.00, 164000.00, 1074000.00, '', 350000.00, 18000.00, 1, '201904', 'N');

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
(31, 4, 8, '2019-12-30', 910000.00, 164000.00, 1074000.00, 0.00, '0000-00-00', 0, 0.00, 0.00, 0.00, 0.00, '', '');

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
  `Keterangan` text,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00'
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
(92, '2019-04-30', '201904', '4.MAT', '5.4000', 0.00, 18000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60002B');

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

--
-- Dumping data for table `t74_jurnallapclosed`
--

INSERT INTO `t74_jurnallapclosed` (`Tanggal`, `NomorTransaksi`, `Keterangan`, `AkunKode`, `AkunNama`, `Debet`, `Kredit`) VALUES
('2019-03-01', '2.PINJ', 'Pinjaman No. Kontrak 60002', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 4160000.00, 0.00),
('2019-03-01', '2.PINJ', 'Pinjaman No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 4160000.00),
('2019-03-01', '2.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 200000.00, 0.00),
('2019-03-01', '2.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 200000.00),
('2019-03-01', '2.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002', '1.1003', 'KAS BANK - BCA SURABAYA', 18000.00, 0.00),
('2019-03-01', '2.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 18000.00),
('2019-03-04', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 10400000.00, 0.00),
('2019-03-04', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 10400000.00),
('2019-03-04', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 500000.00, 0.00),
('2019-03-04', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 500000.00),
('2019-03-04', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 18000.00, 0.00),
('2019-03-04', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 18000.00),
('2019-03-30', '1.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 1040000.00, 0.00),
('2019-03-30', '1.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 0.00, 1040000.00),
('2019-03-30', '1.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 250000.00, 0.00),
('2019-03-30', '1.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60001', '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 0.00, 250000.00),
('2019-03-30', '1.DND', 'Pendapatan Denda ke 1 No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 0.00),
('2019-03-30', '1.DND', 'Pendapatan Denda ke 1 No. Kontrak 60001', '5.3000', 'PENDAPATAN DENDA', 0.00, 0.00);

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
('1', 'AKTIVA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1', 'AKTIVA', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.1000', 'KAS', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1000', 'KAS', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.1001', 'KAS BANK - BCA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1001', 'KAS BANK - BCA', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.1002', 'KAS BANK - MANDIRI', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1002', 'KAS BANK - MANDIRI', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, -12534000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-22', '3.PINJ', 'Pinjaman No. Kontrak 60003', 0.00, 4160000.00, -16694000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-22', '3.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60003', 200000.00, 0.00, -16494000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-22', '3.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60003', 18000.00, 0.00, -16476000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-24', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', 1040000.00, 0.00, -15436000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-24', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', 250000.00, 0.00, -15186000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-24', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', 0.00, 0.00, -15186000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '11.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60002', 694000.00, 0.00, -14492000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '11.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60002', 93000.00, 0.00, -14399000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '11.DND', 'Pendapatan Denda ke 1 No. Kontrak 60002', 58700.00, 0.00, -14340300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '12.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60002', 694000.00, 0.00, -13646300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '12.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60002', 93000.00, 0.00, -13553300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-26', '12.DND', 'Pendapatan Denda ke 2 No. Kontrak 60002', 20000.00, 0.00, -13533300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '13.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60002', 694000.00, 0.00, -12839300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '13.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60002', 93000.00, 0.00, -12746300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '13.DND', 'Pendapatan Denda ke 3 No. Kontrak 60002', 0.00, 0.00, -12746300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '60002.PT', 'Potongan Pinjaman No. Kontrak 60002', 0.00, 100000.00, -12846300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '16.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60002', 690000.00, 0.00, -12156300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '16.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60002', 97000.00, 0.00, -12059300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '16.DND', 'Pendapatan Denda ke 6 No. Kontrak 60002', 0.00, 0.00, -12059300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '15.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60002', 694000.00, 0.00, -11365300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '15.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60002', 93000.00, 0.00, -11272300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '15.DND', 'Pendapatan Denda ke 5 No. Kontrak 60002', 0.00, 0.00, -11272300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '14.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60002', 694000.00, 0.00, -10578300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '14.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60002', 93000.00, 0.00, -10485300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-29', '14.DND', 'Pendapatan Denda ke 4 No. Kontrak 60002', 0.00, 0.00, -10485300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-30', '4.PINJ', 'Pinjaman No. Kontrak 60002B', 0.00, 7280000.00, -17765300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-30', '4.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B', 350000.00, 0.00, -17415300.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-30', '4.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002B', 18000.00, 0.00, -17397300.00),
('1.1004', 'KAS BESAR', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1004', 'KAS BESAR', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.1005', 'KAS KECIL HARIAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.1005', 'KAS KECIL HARIAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2000', 'PIUTANG', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2000', 'PIUTANG', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2001', 'PIUTANG KURANG BAYAR NASABAH', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2002', 'NASABAH MACET > 12 BULAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2002', 'NASABAH MACET > 12 BULAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 13520000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-22', '3.PINJ', 'Pinjaman No. Kontrak 60003', 4160000.00, 0.00, 17680000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-24', '2.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60001', 0.00, 1040000.00, 16640000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-26', '11.ANG', 'Pembayaran Angsuran ke 1 No. Kontrak 60002', 0.00, 694000.00, 15946000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-26', '12.ANG', 'Pembayaran Angsuran ke 2 No. Kontrak 60002', 0.00, 694000.00, 15252000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '13.ANG', 'Pembayaran Angsuran ke 3 No. Kontrak 60002', 0.00, 694000.00, 14558000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '16.ANG', 'Pembayaran Angsuran ke 6 No. Kontrak 60002', 0.00, 690000.00, 13868000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '15.ANG', 'Pembayaran Angsuran ke 5 No. Kontrak 60002', 0.00, 694000.00, 13174000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-29', '14.ANG', 'Pembayaran Angsuran ke 4 No. Kontrak 60002', 0.00, 694000.00, 12480000.00),
('1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', '2019-04-30', '4.PINJ', 'Pinjaman No. Kontrak 60002B', 7280000.00, 0.00, 19760000.00),
('1.2004', 'PIUTANG SIDOARJO', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2004', 'PIUTANG SIDOARJO', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2005', 'PIUTANG KPL 5', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2005', 'PIUTANG KPL 5', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2006', 'PIUTANG TROSOBO', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2006', 'PIUTANG TROSOBO', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2007', 'PIUTANG DANIEL', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2007', 'PIUTANG DANIEL', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.2008', 'PIUTANG ANDIK', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.2008', 'PIUTANG ANDIK', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.3000', 'PERSEDIAAN KANTOR', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.3000', 'PERSEDIAAN KANTOR', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('1.4000', 'AKUMULASI PENYUSUTAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('1.4000', 'AKUMULASI PENYUSUTAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2', 'PASSIVA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2', 'PASSIVA', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.1000', 'HUTANG PAJAJARAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.1000', 'HUTANG PAJAJARAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.2000', 'HUTANG DANIEL', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.2000', 'HUTANG DANIEL', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.3000', 'TITIPAN NASABAH', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.3000', 'TITIPAN NASABAH', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.4000', 'MODAL DISETOR', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.4000', 'MODAL DISETOR', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.5000', 'SHU TAHUN LALU', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.5000', 'SHU TAHUN LALU', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.6000', 'SHU TAHUN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.6000', 'SHU TAHUN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.7000', 'PEMBAGIAN SHU TAHUN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.7000', 'PEMBAGIAN SHU TAHUN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('2.8000', 'SHU TAHUN BERJALAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 986000.00),
('2.8000', 'SHU TAHUN BERJALAN', '2019-04-01', '', '', 0.00, 0.00, 986000.00),
('2.9000', 'SHU BULAN BERJALAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('2.9000', 'SHU BULAN BERJALAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('3', 'PENDAPATAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('3', 'PENDAPATAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 250000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-24', '2.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60001', 0.00, 250000.00, 500000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-26', '11.BGA', 'Pendapatan Bunga ke 1 No. Kontrak 60002', 0.00, 93000.00, 593000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-26', '12.BGA', 'Pendapatan Bunga ke 2 No. Kontrak 60002', 0.00, 93000.00, 686000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-29', '13.BGA', 'Pendapatan Bunga ke 3 No. Kontrak 60002', 0.00, 93000.00, 779000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-29', '16.BGA', 'Pendapatan Bunga ke 6 No. Kontrak 60002', 0.00, 97000.00, 876000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-29', '15.BGA', 'Pendapatan Bunga ke 5 No. Kontrak 60002', 0.00, 93000.00, 969000.00),
('3.1000', 'PENDAPATAN BUNGA PINJAMAN', '2019-04-29', '14.BGA', 'Pendapatan Bunga ke 4 No. Kontrak 60002', 0.00, 93000.00, 1062000.00),
('4', 'BIAYA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4', 'BIAYA', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.1000', 'BIAYA KARYAWAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.1000', 'BIAYA KARYAWAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.2000', 'BIAYA PERKANTORAN & UMUM', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.3000', 'BIAYA KOMISI MAKELAR / FEE', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.4000', 'BIAYA ADMINISTRASI BANK', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.4000', 'BIAYA ADMINISTRASI BANK', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.5000', 'BIAYA PENYUSUTAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.5000', 'BIAYA PENYUSUTAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.6000', 'BIAYA IKLAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.6000', 'BIAYA IKLAN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('4.7000', 'POTONGAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('4.7000', 'POTONGAN', '2019-04-29', '60002.PT', 'Potongan Pinjaman No. Kontrak 60002', 100000.00, 0.00, 100000.00),
('5', 'PENDAPATAN LAIN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('5', 'PENDAPATAN LAIN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 700000.00),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '2019-04-22', '3.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60003', 0.00, 200000.00, 900000.00),
('5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', '2019-04-30', '4.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60002B', 0.00, 350000.00, 1250000.00),
('5.2000', 'PENDAPATAN BUNGA BANK', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('5.2000', 'PENDAPATAN BUNGA BANK', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-24', '2.DND', 'Pendapatan Denda ke 2 No. Kontrak 60001', 0.00, 0.00, 0.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-26', '11.DND', 'Pendapatan Denda ke 1 No. Kontrak 60002', 0.00, 58700.00, 58700.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-26', '12.DND', 'Pendapatan Denda ke 2 No. Kontrak 60002', 0.00, 20000.00, 78700.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-29', '13.DND', 'Pendapatan Denda ke 3 No. Kontrak 60002', 0.00, 0.00, 78700.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-29', '16.DND', 'Pendapatan Denda ke 6 No. Kontrak 60002', 0.00, 0.00, 78700.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-29', '15.DND', 'Pendapatan Denda ke 5 No. Kontrak 60002', 0.00, 0.00, 78700.00),
('5.3000', 'PENDAPATAN DENDA', '2019-04-29', '14.DND', 'Pendapatan Denda ke 4 No. Kontrak 60002', 0.00, 0.00, 78700.00),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 36000.00),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '2019-04-22', '3.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60003', 0.00, 18000.00, 54000.00),
('5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', '2019-04-30', '4.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002B', 0.00, 18000.00, 72000.00),
('6', 'BIAYA LAIN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('6', 'BIAYA LAIN', '2019-04-01', '', '', 0.00, 0.00, 0.00),
('6.1000', 'BIAYA LAIN-LAIN', '2019-04-01', '', 'Saldo Awal', 0.00, 0.00, 0.00),
('6.1000', 'BIAYA LAIN-LAIN', '2019-04-01', '', '', 0.00, 0.00, 0.00);

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
('2019-04-30', '4.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60002B', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 18000.00);

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
(11, '11', 'SHU Bulan Berjalan', '2.9000');

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
(2, '2.5000', 'SHU TAHUN LALU', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201904'),
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
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201904'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 700000.00, '201904'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201904'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 36000.00, '201904'),
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
(462, '2019-06-21 11:06:49', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');

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
-- Stand-in structure for view `v0301_pinjamannasabah`
-- (See below for the actual view)
--
CREATE TABLE `v0301_pinjamannasabah` (
`pinjaman_id` int(11)
,`Kontrak_No` varchar(25)
,`Kontrak_Tgl` date
,`nasabah_id` int(11)
,`jaminan_id` varchar(100)
,`Pinjaman` float(14,2)
,`Angsuran_Lama` tinyint(4)
,`Angsuran_Bunga_Prosen` decimal(5,2)
,`Angsuran_Denda` decimal(5,2)
,`Dispensasi_Denda` tinyint(4)
,`Angsuran_Pokok` float(14,2)
,`Angsuran_Bunga` float(14,2)
,`Angsuran_Total` float(14,2)
,`No_Ref` varchar(25)
,`Biaya_Administrasi` float(14,2)
,`Biaya_Materai` float(14,2)
,`marketing_id` int(11)
,`Periode` varchar(6)
,`Macet` enum('Y','N')
,`Nama` varchar(50)
,`Alamat` text
,`No_Telp_Hp` varchar(100)
,`Pekerjaan` varchar(50)
,`Pekerjaan_Alamat` text
,`Pekerjaan_No_Telp_Hp` varchar(100)
,`Status` tinyint(4)
,`Keterangan` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0302_pinjamanlap`
-- (See below for the actual view)
--
CREATE TABLE `v0302_pinjamanlap` (
`pinjaman_id` int(11)
,`Kontrak_No` varchar(25)
,`Kontrak_Tgl` date
,`nasabah_id` int(11)
,`jaminan_id` varchar(100)
,`Pinjaman` float(14,2)
,`Angsuran_Lama` tinyint(4)
,`Angsuran_Bunga_Prosen` decimal(5,2)
,`Angsuran_Denda` decimal(5,2)
,`Dispensasi_Denda` tinyint(4)
,`Angsuran_Pokok` float(14,2)
,`Angsuran_Bunga` float(14,2)
,`Angsuran_Total` float(14,2)
,`No_Ref` varchar(25)
,`Biaya_Administrasi` float(14,2)
,`Biaya_Materai` float(14,2)
,`marketing_id` int(11)
,`Periode` varchar(6)
,`Macet` enum('Y','N')
,`NasabahNama` varchar(50)
,`NasabahAlamat` text
,`No_Telp_Hp` varchar(100)
,`Pekerjaan` varchar(50)
,`Pekerjaan_Alamat` text
,`Pekerjaan_No_Telp_Hp` varchar(100)
,`Status` tinyint(4)
,`NasabahKeterangan` varchar(100)
,`MarketingNama` varchar(50)
,`MarketingAlamat` varchar(100)
,`NoHP` varchar(50)
,`AkhirKontrak` date
,`sudah_bayar` bigint(21)
,`pd_Angsuran_Pokok` double(19,2)
,`pd_Angsuran_Bunga` double(19,2)
,`pd_Angsuran_Total` double(19,2)
,`Tanggal_Bayar` date
,`umur_tunggakan` bigint(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0303_pinjamanlap2`
-- (See below for the actual view)
--
CREATE TABLE `v0303_pinjamanlap2` (
`id` int(11)
,`angsuran_tanggal` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0304_pinjamanlap3`
-- (See below for the actual view)
--
CREATE TABLE `v0304_pinjamanlap3` (
`id` int(11)
,`sudah_bayar` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0305_pinjamanlap4`
-- (See below for the actual view)
--
CREATE TABLE `v0305_pinjamanlap4` (
`id` int(11)
,`pd_Angsuran_Pokok` double(19,2)
,`pd_Angsuran_Bunga` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0306_pinjamanlap5`
-- (See below for the actual view)
--
CREATE TABLE `v0306_pinjamanlap5` (
`id` int(11)
,`tanggal_bayar` date
,`umur_tunggakan` int(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v30_mutasi`
-- (See below for the actual view)
--
CREATE TABLE `v30_mutasi` (
`id` varchar(35)
,`debet` double(19,2)
,`kredit` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v31_mutasi`
-- (See below for the actual view)
--
CREATE TABLE `v31_mutasi` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v32_labarugi`
-- (See below for the actual view)
--
CREATE TABLE `v32_labarugi` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
,`jumlah` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v33_neraca`
-- (See below for the actual view)
--
CREATE TABLE `v33_neraca` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v34_saldoakhir`
-- (See below for the actual view)
--
CREATE TABLE `v34_saldoakhir` (
`id` varchar(35)
,`rekening` varchar(90)
,`saldo` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v40_mutasiold`
-- (See below for the actual view)
--
CREATE TABLE `v40_mutasiold` (
`periode` varchar(6)
,`id` varchar(35)
,`debet` double(19,2)
,`kredit` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v41_mutasiold`
-- (See below for the actual view)
--
CREATE TABLE `v41_mutasiold` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v42_labarugiold`
-- (See below for the actual view)
--
CREATE TABLE `v42_labarugiold` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
,`jumlah` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v43_neracaold`
-- (See below for the actual view)
--
CREATE TABLE `v43_neracaold` (
`periode` varchar(6)
,`group` bigint(20)
,`group_rekening` varchar(90)
,`id` varchar(35)
,`rekening` varchar(90)
,`saldoawal` float(14,2)
,`debet` double(19,2)
,`kredit` double(19,2)
,`saldoakhir` double(19,2)
);

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
-- Structure for view `v0301_pinjamannasabah`
--
DROP TABLE IF EXISTS `v0301_pinjamannasabah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0301_pinjamannasabah`  AS  select `p`.`id` AS `pinjaman_id`,`p`.`Kontrak_No` AS `Kontrak_No`,`p`.`Kontrak_Tgl` AS `Kontrak_Tgl`,`p`.`nasabah_id` AS `nasabah_id`,`p`.`jaminan_id` AS `jaminan_id`,`p`.`Pinjaman` AS `Pinjaman`,`p`.`Angsuran_Lama` AS `Angsuran_Lama`,`p`.`Angsuran_Bunga_Prosen` AS `Angsuran_Bunga_Prosen`,`p`.`Angsuran_Denda` AS `Angsuran_Denda`,`p`.`Dispensasi_Denda` AS `Dispensasi_Denda`,`p`.`Angsuran_Pokok` AS `Angsuran_Pokok`,`p`.`Angsuran_Bunga` AS `Angsuran_Bunga`,`p`.`Angsuran_Total` AS `Angsuran_Total`,`p`.`No_Ref` AS `No_Ref`,`p`.`Biaya_Administrasi` AS `Biaya_Administrasi`,`p`.`Biaya_Materai` AS `Biaya_Materai`,`p`.`marketing_id` AS `marketing_id`,`p`.`Periode` AS `Periode`,`p`.`Macet` AS `Macet`,`n`.`Nama` AS `Nama`,`n`.`Alamat` AS `Alamat`,`n`.`No_Telp_Hp` AS `No_Telp_Hp`,`n`.`Pekerjaan` AS `Pekerjaan`,`n`.`Pekerjaan_Alamat` AS `Pekerjaan_Alamat`,`n`.`Pekerjaan_No_Telp_Hp` AS `Pekerjaan_No_Telp_Hp`,`n`.`Status` AS `Status`,`n`.`Keterangan` AS `Keterangan` from (`t03_pinjaman` `p` left join `t01_nasabah` `n` on((`p`.`nasabah_id` = `n`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v0302_pinjamanlap`
--
DROP TABLE IF EXISTS `v0302_pinjamanlap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0302_pinjamanlap`  AS  select `p`.`id` AS `pinjaman_id`,`p`.`Kontrak_No` AS `Kontrak_No`,`p`.`Kontrak_Tgl` AS `Kontrak_Tgl`,`p`.`nasabah_id` AS `nasabah_id`,`p`.`jaminan_id` AS `jaminan_id`,`p`.`Pinjaman` AS `Pinjaman`,`p`.`Angsuran_Lama` AS `Angsuran_Lama`,`p`.`Angsuran_Bunga_Prosen` AS `Angsuran_Bunga_Prosen`,`p`.`Angsuran_Denda` AS `Angsuran_Denda`,`p`.`Dispensasi_Denda` AS `Dispensasi_Denda`,`p`.`Angsuran_Pokok` AS `Angsuran_Pokok`,`p`.`Angsuran_Bunga` AS `Angsuran_Bunga`,`p`.`Angsuran_Total` AS `Angsuran_Total`,`p`.`No_Ref` AS `No_Ref`,`p`.`Biaya_Administrasi` AS `Biaya_Administrasi`,`p`.`Biaya_Materai` AS `Biaya_Materai`,`p`.`marketing_id` AS `marketing_id`,`p`.`Periode` AS `Periode`,`p`.`Macet` AS `Macet`,`n`.`Nama` AS `NasabahNama`,`n`.`Alamat` AS `NasabahAlamat`,`n`.`No_Telp_Hp` AS `No_Telp_Hp`,`n`.`Pekerjaan` AS `Pekerjaan`,`n`.`Pekerjaan_Alamat` AS `Pekerjaan_Alamat`,`n`.`Pekerjaan_No_Telp_Hp` AS `Pekerjaan_No_Telp_Hp`,`n`.`Status` AS `Status`,`n`.`Keterangan` AS `NasabahKeterangan`,`m`.`Nama` AS `MarketingNama`,`m`.`Alamat` AS `MarketingAlamat`,`m`.`NoHP` AS `NoHP`,`pd`.`angsuran_tanggal` AS `AkhirKontrak`,`pd3`.`sudah_bayar` AS `sudah_bayar`,`pd4`.`pd_Angsuran_Pokok` AS `pd_Angsuran_Pokok`,`pd4`.`pd_Angsuran_Bunga` AS `pd_Angsuran_Bunga`,(`pd4`.`pd_Angsuran_Pokok` + `pd4`.`pd_Angsuran_Bunga`) AS `pd_Angsuran_Total`,`pd5`.`tanggal_bayar` AS `Tanggal_Bayar`,(case when isnull(`pd4`.`pd_Angsuran_Pokok`) then 0 else `pd5`.`umur_tunggakan` end) AS `umur_tunggakan` from ((((((`t03_pinjaman` `p` left join `t01_nasabah` `n` on((`p`.`nasabah_id` = `n`.`id`))) left join `t07_marketing` `m` on((`p`.`marketing_id` = `m`.`id`))) left join `v0303_pinjamanlap2` `pd` on((`p`.`id` = `pd`.`id`))) left join `v0304_pinjamanlap3` `pd3` on((`p`.`id` = `pd3`.`id`))) left join `v0305_pinjamanlap4` `pd4` on((`p`.`id` = `pd4`.`id`))) left join `v0306_pinjamanlap5` `pd5` on((`p`.`id` = `pd5`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v0303_pinjamanlap2`
--
DROP TABLE IF EXISTS `v0303_pinjamanlap2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0303_pinjamanlap2`  AS  select `p`.`id` AS `id`,max(`pd`.`Angsuran_Tanggal`) AS `angsuran_tanggal` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) group by `p`.`id` order by `pd`.`Angsuran_Tanggal` desc ;

-- --------------------------------------------------------

--
-- Structure for view `v0304_pinjamanlap3`
--
DROP TABLE IF EXISTS `v0304_pinjamanlap3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0304_pinjamanlap3`  AS  select `p`.`id` AS `id`,count(`pd`.`id`) AS `sudah_bayar` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) where ((`pd`.`Tanggal_Bayar` is not null) and (`pd`.`Tanggal_Bayar` <> '') and (`pd`.`Tanggal_Bayar` <> '0000-00-00')) group by `pd`.`pinjaman_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v0305_pinjamanlap4`
--
DROP TABLE IF EXISTS `v0305_pinjamanlap4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0305_pinjamanlap4`  AS  select `p`.`id` AS `id`,sum(`pd`.`Angsuran_Pokok`) AS `pd_Angsuran_Pokok`,sum(`pd`.`Angsuran_Bunga`) AS `pd_Angsuran_Bunga` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) where (isnull(`pd`.`Tanggal_Bayar`) or (`pd`.`Tanggal_Bayar` = '')) group by `p`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v0306_pinjamanlap5`
--
DROP TABLE IF EXISTS `v0306_pinjamanlap5`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0306_pinjamanlap5`  AS  select `p`.`id` AS `id`,max(`pd`.`Tanggal_Bayar`) AS `tanggal_bayar`,(to_days(curdate()) - to_days(max(`pd`.`Tanggal_Bayar`))) AS `umur_tunggakan` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) where ((`pd`.`Tanggal_Bayar` is not null) and (`pd`.`Tanggal_Bayar` <> '') and (`pd`.`Tanggal_Bayar` <> '0000-00-00')) group by `p`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v30_mutasi`
--
DROP TABLE IF EXISTS `v30_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v30_mutasi`  AS  select `j`.`Rekening` AS `id`,sum(`j`.`Debet`) AS `debet`,sum(`j`.`Kredit`) AS `kredit` from `t10_jurnal` `j` group by `j`.`Rekening` ;

-- --------------------------------------------------------

--
-- Structure for view `v31_mutasi`
--
DROP TABLE IF EXISTS `v31_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v31_mutasi`  AS  select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '1')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '2')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '3')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '4')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '5')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '6')) order by `id` ;

-- --------------------------------------------------------

--
-- Structure for view `v32_labarugi`
--
DROP TABLE IF EXISTS `v32_labarugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v32_labarugi`  AS  select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v31_mutasi` `m` where (`m`.`group` = '3') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v31_mutasi` `m` where (`m`.`group` = '5') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v31_mutasi` `m` where (`m`.`group` = '4') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v31_mutasi` `m` where (`m`.`group` = '6') order by `id` ;

-- --------------------------------------------------------

--
-- Structure for view `v33_neraca`
--
DROP TABLE IF EXISTS `v33_neraca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v33_neraca`  AS  select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir` from `v31_mutasi` `m` where ((`m`.`group` = '1') or (`m`.`group` = '2')) ;

-- --------------------------------------------------------

--
-- Structure for view `v34_saldoakhir`
--
DROP TABLE IF EXISTS `v34_saldoakhir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v34_saldoakhir`  AS  select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '1')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '2')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '3')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '4')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '5')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v30_mutasi` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '6')) ;

-- --------------------------------------------------------

--
-- Structure for view `v40_mutasiold`
--
DROP TABLE IF EXISTS `v40_mutasiold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v40_mutasiold`  AS  select `j`.`Periode` AS `periode`,`j`.`Rekening` AS `id`,sum(`j`.`Debet`) AS `debet`,sum(`j`.`Kredit`) AS `kredit` from (`t92_periodeold` `p` left join `t82_jurnalold` `j` on((`p`.`Tahun_Bulan` = `j`.`Periode`))) group by `j`.`Periode`,`j`.`Rekening` order by `j`.`Rekening` ;

-- --------------------------------------------------------

--
-- Structure for view `v41_mutasiold`
--
DROP TABLE IF EXISTS `v41_mutasiold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v41_mutasiold`  AS  select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '1')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '2')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '3')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '4')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '5')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on(((`r`.`id` = convert(`m`.`id` using utf8)) and (`m`.`periode` = `r`.`Periode`)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '6')) order by `id` ;

-- --------------------------------------------------------

--
-- Structure for view `v42_labarugiold`
--
DROP TABLE IF EXISTS `v42_labarugiold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v42_labarugiold`  AS  select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v41_mutasiold` `m` where (`m`.`group` = '3') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v41_mutasiold` `m` where (`m`.`group` = '5') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v41_mutasiold` `m` where (`m`.`group` = '4') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v41_mutasiold` `m` where (`m`.`group` = '6') order by `id` ;

-- --------------------------------------------------------

--
-- Structure for view `v43_neracaold`
--
DROP TABLE IF EXISTS `v43_neracaold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v43_neracaold`  AS  select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir` from `v41_mutasiold` `m` where ((`m`.`group` = '1') or (`m`.`group` = '2')) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsuran`
--
ALTER TABLE `t04_pinjamanangsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_pinjamanangsurantemp`
--
ALTER TABLE `t04_pinjamanangsurantemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
