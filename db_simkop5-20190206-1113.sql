-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 06, 2019 at 05:13 AM
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
(1, '60001', '2018-12-04', 1, '1', 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL, 25000.00, 18000.00, 1, '201812');

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
(4, 1, 4, '2019-04-04', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, '2019-05-04', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, '2019-06-04', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, '2019-07-04', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, '2019-08-04', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, '2019-09-04', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, '2019-10-04', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, '2019-11-04', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2019-12-04', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(24, '2019-02-04', '201902', '3.DND', '5.3000', 0.00, 0.00, 'Pendapatan Denda ke 3 No. Kontrak 60001');

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
(70, '2019-02-06 10:54:42', '/simkop5/login.php', 'admin', 'login', '::1', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
