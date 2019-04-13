-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 13, 2019 at 12:48 PM
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
(1, 1, 'ATM', '', '', '', '', '', '');

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
(1, '60001', '2019-04-13', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 10000.00, 6000.00, 1, '201904', 'N');

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
(1, 1, 1, '2019-05-13', 867000.00, 233000.00, 1100000.00, 9533000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, '2019-06-13', 867000.00, 233000.00, 1100000.00, 8666000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, '2019-07-13', 867000.00, 233000.00, 1100000.00, 7799000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, '2019-08-13', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, '2019-09-13', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, '2019-10-13', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, '2019-11-13', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, '2019-12-13', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, '2020-01-13', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, '2020-02-13', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, '2020-03-13', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2020-04-13', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-13', '1.PINJ', 'Pinjaman No. Kontrak 60001', 0.00, 10400000.00, -10400000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-13', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', 10000.00, 0.00, -10390000.00),
('1.1003', 'KAS BANK - BCA SURABAYA', '2019-04-13', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', 6000.00, 0.00, -10384000.00);

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
('2019-04-13', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 10400000.00, 0.00),
('2019-04-13', '1.PINJ', 'Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 0.00, 10400000.00),
('2019-04-13', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 10000.00, 0.00),
('2019-04-13', '1.ADM', 'Pendapatan Administrasi Pinjaman No. Kontrak 60001', '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 0.00, 10000.00),
('2019-04-13', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '1.1003', 'KAS BANK - BCA SURABAYA', 6000.00, 0.00),
('2019-04-13', '1.MAT', 'Pendapatan Materai Pinjaman No. Kontrak 60001', '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 0.00, 6000.00);

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
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 16000.00, '201904'),
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
(1, '2019-04-13', '201904', '1.PINJ', '1.2003', 10400000.00, 0.00, 'Pinjaman No. Kontrak 60001'),
(2, '2019-04-13', '201904', '1.PINJ', '1.1003', 0.00, 10400000.00, 'Pinjaman No. Kontrak 60001'),
(3, '2019-04-13', '201904', '1.ADM', '1.1003', 10000.00, 0.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(4, '2019-04-13', '201904', '1.ADM', '5.1000', 0.00, 10000.00, 'Pendapatan Administrasi Pinjaman No. Kontrak 60001'),
(5, '2019-04-13', '201904', '1.MAT', '1.1003', 6000.00, 0.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001'),
(6, '2019-04-13', '201904', '1.MAT', '5.4000', 0.00, 6000.00, 'Pendapatan Materai Pinjaman No. Kontrak 60001');

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
  `field03` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '1', 'AKTIVA', 'GROUP', 'DEBET', 'NERACA', '', '', '', 'yes', 0.00, '201905'),
(1, '1.1000', 'KAS', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201905'),
(1, '1.1001', 'KAS BANK - BCA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201905'),
(1, '1.1002', 'KAS BANK - MANDIRI', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201905'),
(1, '1.1003', 'KAS BANK - BCA SURABAYA', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', -10384000.00, '201905'),
(1, '1.1004', 'KAS BESAR', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201905'),
(1, '1.1005', 'KAS KECIL HARIAN', 'DETAIL', 'DEBET', 'NERACA', 'KAS/BANK', '1.1000', '', 'yes', 0.00, '201905'),
(1, '1.2000', 'PIUTANG', 'HEADER', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201905'),
(1, '1.2001', 'PIUTANG KURANG BAYAR NASABAH', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2002', 'NASABAH MACET > 12 BULAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2003', 'PINJAMAN BERJANGKA & ANGSURAN', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 10400000.00, '201905'),
(1, '1.2004', 'PIUTANG SIDOARJO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2005', 'PIUTANG KPL 5', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2006', 'PIUTANG TROSOBO', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2007', 'PIUTANG DANIEL', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.2008', 'PIUTANG ANDIK', 'DETAIL', 'DEBET', 'NERACA', '', '1.2000', '', 'yes', 0.00, '201905'),
(1, '1.3000', 'PERSEDIAAN KANTOR', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201905'),
(1, '1.4000', 'AKUMULASI PENYUSUTAN', 'DETAIL', 'DEBET', 'NERACA', '', '1', '', 'yes', 0.00, '201905'),
(2, '2', 'PASSIVA', 'GROUP', 'CREDIT', 'NERACA', '', '', '', 'yes', 0.00, '201905'),
(2, '2.1000', 'HUTANG PAJAJARAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.2000', 'HUTANG DANIEL', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.3000', 'TITIPAN NASABAH', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.4000', 'MODAL DISETOR', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.5000', 'SHU TAHUN LALU', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.6000', 'SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.7000', 'PEMBAGIAN SHU TAHUN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(2, '2.8000', 'SHU TAHUN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 16000.00, '201905'),
(2, '2.9000', 'SHU BULAN BERJALAN', 'DETAIL', 'CREDIT', 'NERACA', '', '2', '', 'yes', 0.00, '201905'),
(3, '3', 'PENDAPATAN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201905'),
(3, '3.1000', 'PENDAPATAN BUNGA PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '3', '', 'yes', 0.00, '201905'),
(4, '4', 'BIAYA', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201905'),
(4, '4.1000', 'BIAYA KARYAWAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.2000', 'BIAYA PERKANTORAN & UMUM', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.3000', 'BIAYA KOMISI MAKELAR / FEE', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.4000', 'BIAYA ADMINISTRASI BANK', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.5000', 'BIAYA PENYUSUTAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.6000', 'BIAYA IKLAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(4, '4.7000', 'POTONGAN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '4', '', 'yes', 0.00, '201905'),
(5, '5', 'PENDAPATAN LAIN', 'GROUP', 'CREDIT', 'RUGI LABA', '', '', '', 'yes', 0.00, '201905'),
(5, '5.1000', 'PENDAPATAN ADMINISTRASI PINJAMAN', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 10000.00, '201905'),
(5, '5.2000', 'PENDAPATAN BUNGA BANK', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201905'),
(5, '5.3000', 'PENDAPATAN DENDA', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 0.00, '201905'),
(5, '5.4000', 'PENDAPATAN LAIN-LAIN / MATERAI', 'DETAIL', 'CREDIT', 'RUGI LABA', '', '5', '', 'yes', 6000.00, '201905'),
(6, '6', 'BIAYA LAIN', 'GROUP', 'DEBET', 'RUGI LABA', '', '', '', 'yes', 0.00, '201905'),
(6, '6.1000', 'BIAYA LAIN-LAIN', 'DETAIL', 'DEBET', 'RUGI LABA', '', '6', '', 'yes', 0.00, '201905');

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
(1, 4, 2019, '201904');

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
(1, 5, 2019, '201905');

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
(1, '2019-04-08 18:53:01', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Bulan', '1', '5', '4'),
(2, '2019-04-08 18:53:01', '/simkop5/t93_periodeedit.php', '1', 'U', 't93_periode', 'Tahun_Bulan', '1', '201905', '201904'),
(3, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_No', '1', '', '60001'),
(4, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Kontrak_Tgl', '1', '', '2019-04-13'),
(5, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(6, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'jaminan_id', '1', '', '1'),
(7, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(8, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Lama', '1', '', '12'),
(9, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga_Prosen', '1', '', '2.24'),
(10, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Denda', '1', '', '0.4'),
(11, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Dispensasi_Denda', '1', '', '3'),
(12, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Pokok', '1', '', '867000'),
(13, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Bunga', '1', '', '233000'),
(14, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Angsuran_Total', '1', '', '1100000'),
(15, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'No_Ref', '1', '', NULL),
(16, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Administrasi', '1', '', '10000'),
(17, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Biaya_Materai', '1', '', '6000'),
(18, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'marketing_id', '1', '', '1'),
(19, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Periode', '1', '', '201904'),
(20, '2019-04-13 17:41:28', '/simkop5/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1');

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
`id` varchar(35)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v40_mutasiold`  AS  select `j`.`Rekening` AS `id`,sum(`j`.`Debet`) AS `debet`,sum(`j`.`Kredit`) AS `kredit` from (`t92_periodeold` `p` left join `t82_jurnalold` `j` on((`p`.`Tahun_Bulan` = `j`.`Periode`))) group by `j`.`Rekening` order by `j`.`Rekening` ;

-- --------------------------------------------------------

--
-- Structure for view `v41_mutasiold`
--
DROP TABLE IF EXISTS `v41_mutasiold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v41_mutasiold`  AS  select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '1')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '2')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '3')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '4')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '5')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,((`r`.`Saldo` + (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `saldoakhir` from (((`t92_periodeold` `p` left join `t80_rekeningold` `r` on((convert(`p`.`Tahun_Bulan` using utf8) = `r`.`Periode`))) left join `t80_rekeningold` `r2` on(((`r`.`group` = `r2`.`id`) and (convert(`p`.`Tahun_Bulan` using utf8) = `r2`.`Periode`)))) left join `v40_mutasiold` `m` on((`r`.`id` = convert(`m`.`id` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '6')) order by `id` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `t75_company`
--
ALTER TABLE `t75_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t82_jurnalold`
--
ALTER TABLE `t82_jurnalold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
