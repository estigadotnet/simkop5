-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 18, 2019 at 09:37 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
