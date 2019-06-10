-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 10, 2019 at 12:34 PM
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0302_pinjamanlap`  AS  select `p`.`id` AS `pinjaman_id`,`p`.`Kontrak_No` AS `Kontrak_No`,`p`.`Kontrak_Tgl` AS `Kontrak_Tgl`,`p`.`nasabah_id` AS `nasabah_id`,`p`.`jaminan_id` AS `jaminan_id`,`p`.`Pinjaman` AS `Pinjaman`,`p`.`Angsuran_Lama` AS `Angsuran_Lama`,`p`.`Angsuran_Bunga_Prosen` AS `Angsuran_Bunga_Prosen`,`p`.`Angsuran_Denda` AS `Angsuran_Denda`,`p`.`Dispensasi_Denda` AS `Dispensasi_Denda`,`p`.`Angsuran_Pokok` AS `Angsuran_Pokok`,`p`.`Angsuran_Bunga` AS `Angsuran_Bunga`,`p`.`Angsuran_Total` AS `Angsuran_Total`,`p`.`No_Ref` AS `No_Ref`,`p`.`Biaya_Administrasi` AS `Biaya_Administrasi`,`p`.`Biaya_Materai` AS `Biaya_Materai`,`p`.`marketing_id` AS `marketing_id`,`p`.`Periode` AS `Periode`,`p`.`Macet` AS `Macet`,`n`.`Nama` AS `NasabahNama`,`n`.`Alamat` AS `NasabahAlamat`,`n`.`No_Telp_Hp` AS `No_Telp_Hp`,`n`.`Pekerjaan` AS `Pekerjaan`,`n`.`Pekerjaan_Alamat` AS `Pekerjaan_Alamat`,`n`.`Pekerjaan_No_Telp_Hp` AS `Pekerjaan_No_Telp_Hp`,`n`.`Status` AS `Status`,`n`.`Keterangan` AS `NasabahKeterangan`,`m`.`Nama` AS `MarketingNama`,`m`.`Alamat` AS `MarketingAlamat`,`m`.`NoHP` AS `NoHP`,`pd`.`angsuran_tanggal` AS `AkhirKontrak`,`pd3`.`sudah_bayar` AS `sudah_bayar`,`pd4`.`pd_Angsuran_Pokok` AS `pd_Angsuran_Pokok`,`pd4`.`pd_Angsuran_Bunga` AS `pd_Angsuran_Bunga`,(`pd4`.`pd_Angsuran_Pokok` + `pd4`.`pd_Angsuran_Bunga`) AS `pd_Angsuran_Total` from (((((`t03_pinjaman` `p` left join `t01_nasabah` `n` on((`p`.`nasabah_id` = `n`.`id`))) left join `t07_marketing` `m` on((`p`.`marketing_id` = `m`.`id`))) left join `v0303_pinjamanlap2` `pd` on((`p`.`id` = `pd`.`id`))) left join `v0304_pinjamanlap3` `pd3` on((`p`.`id` = `pd3`.`id`))) left join `v0305_pinjamanlap4` `pd4` on((`p`.`id` = `pd4`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v0303_pinjamanlap2`
--
DROP TABLE IF EXISTS `v0303_pinjamanlap2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0303_pinjamanlap2`  AS  select `p`.`id` AS `id`,`pd`.`Angsuran_Tanggal` AS `angsuran_tanggal` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) order by `pd`.`Angsuran_Tanggal` desc limit 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v0304_pinjamanlap3`
--
DROP TABLE IF EXISTS `v0304_pinjamanlap3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0304_pinjamanlap3`  AS  select `p`.`id` AS `id`,count(`pd`.`id`) AS `sudah_bayar` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) where ((`pd`.`Tanggal_Bayar` is not null) or (`pd`.`Tanggal_Bayar` <> '')) group by `pd`.`pinjaman_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v0305_pinjamanlap4`
--
DROP TABLE IF EXISTS `v0305_pinjamanlap4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0305_pinjamanlap4`  AS  select `p`.`id` AS `id`,sum(`pd`.`Angsuran_Pokok`) AS `pd_Angsuran_Pokok`,sum(`pd`.`Angsuran_Bunga`) AS `pd_Angsuran_Bunga` from (`t03_pinjaman` `p` left join `t04_pinjamanangsurantemp` `pd` on((`p`.`id` = `pd`.`pinjaman_id`))) where (isnull(`pd`.`Tanggal_Bayar`) or (`pd`.`Tanggal_Bayar` = '')) ;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
