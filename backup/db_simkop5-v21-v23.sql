-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 09, 2019 at 07:58 AM
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
-- Stand-in structure for view `v21_mutasi`
-- (See below for the actual view)
--
CREATE TABLE `v21_mutasi` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v22_labarugi`
-- (See below for the actual view)
--
CREATE TABLE `v22_labarugi` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v23_neraca`
-- (See below for the actual view)
--
CREATE TABLE `v23_neraca` (
);

-- --------------------------------------------------------

--
-- Structure for view `v21_mutasi`
--
DROP TABLE IF EXISTS `v21_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v21_mutasi`  AS  select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '1')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '2')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '3')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '4')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '5')) union select `r`.`Periode` AS `periode`,`r`.`group` AS `group`,`r2`.`rekening` AS `group_rekening`,`r`.`id` AS `id`,`r`.`rekening` AS `rekening`,`r`.`Saldo` AS `saldoawal`,(case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) AS `debet`,(case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) AS `kredit`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldoakhir` from ((`t91_rekening` `r` left join `t91_rekening` `r2` on((`r`.`group` = `r2`.`id`))) left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (`r`.`group` = '6')) order by `group`,`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v22_labarugi`
--
DROP TABLE IF EXISTS `v22_labarugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v22_labarugi`  AS  select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v21_mutasi` `m` where (`m`.`group` = '3') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`kredit` - `m`.`debet`) AS `jumlah` from `v21_mutasi` `m` where (`m`.`group` = '5') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v21_mutasi` `m` where (`m`.`group` = '4') union select `m`.`periode` AS `periode`,`m`.`group` AS `group`,`m`.`group_rekening` AS `group_rekening`,`m`.`id` AS `id`,`m`.`rekening` AS `rekening`,`m`.`saldoawal` AS `saldoawal`,`m`.`debet` AS `debet`,`m`.`kredit` AS `kredit`,`m`.`saldoakhir` AS `saldoakhir`,(`m`.`debet` - `m`.`kredit`) AS `jumlah` from `v21_mutasi` `m` where (`m`.`group` = '6') ;

-- --------------------------------------------------------

--
-- Structure for view `v23_neraca`
--
DROP TABLE IF EXISTS `v23_neraca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v23_neraca`  AS  select `v21_mutasi`.`periode` AS `periode`,`v21_mutasi`.`group` AS `group`,`v21_mutasi`.`group_rekening` AS `group_rekening`,`v21_mutasi`.`id` AS `id`,`v21_mutasi`.`rekening` AS `rekening`,`v21_mutasi`.`saldoawal` AS `saldoawal`,`v21_mutasi`.`debet` AS `debet`,`v21_mutasi`.`kredit` AS `kredit`,`v21_mutasi`.`saldoakhir` AS `saldoakhir` from `v21_mutasi` where ((`v21_mutasi`.`group` = '1') or (`v21_mutasi`.`group` = '2')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
