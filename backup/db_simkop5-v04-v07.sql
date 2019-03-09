-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 09, 2019 at 06:38 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
