-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 09, 2019 at 07:15 AM
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
-- Stand-in structure for view `v11_mutasi`
-- (See below for the actual view)
--
CREATE TABLE `v11_mutasi` (
`rekening` varchar(35)
,`debet` double(19,2)
,`kredit` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v12_saldoakhir`
-- (See below for the actual view)
--
CREATE TABLE `v12_saldoakhir` (
`id` varchar(35)
,`rekening` varchar(90)
,`saldo` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v13_labarugi`
-- (See below for the actual view)
--
CREATE TABLE `v13_labarugi` (
`NomorUrut` varchar(1)
,`id` varchar(35)
,`mutasi` double(19,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v11_mutasi`
--
DROP TABLE IF EXISTS `v11_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v11_mutasi`  AS  select `t10_jurnal`.`Rekening` AS `rekening`,sum(`t10_jurnal`.`Debet`) AS `debet`,sum(`t10_jurnal`.`Kredit`) AS `kredit` from `t10_jurnal` group by `t10_jurnal`.`Rekening` ;

-- --------------------------------------------------------

--
-- Structure for view `v12_saldoakhir`
--
DROP TABLE IF EXISTS `v12_saldoakhir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v12_saldoakhir`  AS  select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '1')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '2')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '3')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '4')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '5')) union select `r`.`id` AS `id`,`r`.`rekening` AS `rekening`,(`r`.`Saldo` + ((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end))) AS `saldo` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((length(`r`.`id`) > 1) and (left(`r`.`id`,1) = '6')) ;

-- --------------------------------------------------------

--
-- Structure for view `v13_labarugi`
--
DROP TABLE IF EXISTS `v13_labarugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v13_labarugi`  AS  select '1' AS `NomorUrut`,`r`.`id` AS `id`,((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `mutasi` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (left(`r`.`id`,1) = '3')) union select '2' AS `NomorUrut`,`r`.`id` AS `id`,((case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end) - (case when isnull(`m`.`debet`) then 0 else `m`.`debet` end)) AS `mutasi` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (left(`r`.`id`,1) = '5')) union select '3' AS `NomorUrut`,`r`.`id` AS `id`,((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `mutasi` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (left(`r`.`id`,1) = '4')) union select '4' AS `NomorUrut`,`r`.`id` AS `id`,((case when isnull(`m`.`debet`) then 0 else `m`.`debet` end) - (case when isnull(`m`.`kredit`) then 0 else `m`.`kredit` end)) AS `mutasi` from (`t91_rekening` `r` left join `v11_mutasi` `m` on((`r`.`id` = convert(`m`.`rekening` using utf8)))) where ((`r`.`tipe` = 'DETAIL') and (left(`r`.`id`,1) = '6')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
