DROP TABLE t01_nasabah;

CREATE TABLE `t01_nasabah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telp_Hp` varchar(100) NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Pekerjaan_Alamat` text NOT NULL,
  `Pekerjaan_No_Telp_Hp` varchar(100) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '0',
  `Keterangan` varchar(100) DEFAULT NULL,
  `marketing_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO t01_nasabah VALUES("1","HARI","GUBENG KERTAJAYA SE / 21 B KAV TEKOM BLOK Q NO 9","087.7019.40292","PT. IRAWAN DJAJA AGUNG","RAYA SUKODONO KM 3-8 SIDOARJO","031-7882381","1","RUMAH SESUAI","1");
INSERT INTO t01_nasabah VALUES("2","BIMA SAPUTRA","PERUM PONDOK MUTIARA HARUM AO 12 A JATI SIDOARJO","088.2261.24735","PT. WAHANA TUNAS UTAMA","WONOSARI, DS WATESNEGORO, NGORO GUNUNGSARI MOJOKERTO","0321-6819010","2","ALAMAT TIDAK SESUAI","2");
INSERT INTO t01_nasabah VALUES("3","ANDRIAN YONAS ISNANDAR","RUSUN PENJARINGANSARI BLOK A 31 A SURABAYA","089.9355.5870","PT. SHELTER NUSANTARA","MEDOKAN SEMAMPIR SELATAN VA NO. 8","031-5925075","1","ALAMAT SESUAI","1");
INSERT INTO t01_nasabah VALUES("4","DHART0 DJUNAIDI","TROSOBO UTAMA VII H/20 (21/5) SIDODADI TAMAN","082.1433.14889","PT. CITRA GARDA INTERNUSA","TAMAN NAGOYA F1 NO. 55 GEDANGAN SIDOARJO","082.1430.59766","1","HUTANG PINJAMAN","1");



DROP TABLE t02_jaminan;

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nasabah_id` int(11) NOT NULL,
  `Merk_Type` text NOT NULL,
  `No_Rangka` text,
  `No_Mesin` text,
  `Warna` text,
  `No_Pol` text,
  `Keterangan` text,
  `Atas_Nama` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO t02_jaminan VALUES("1","1","BUKU TABUNGAN + ATM MANDIRI","088.999.88888 AN HARI","","","","","");
INSERT INTO t02_jaminan VALUES("2","1","AKTA KELAHIRAN","289000000","","","","","");
INSERT INTO t02_jaminan VALUES("3","1","IJAZAH SD","","","","","","");
INSERT INTO t02_jaminan VALUES("4","1","JAMSOSTEK","","","","","","");
INSERT INTO t02_jaminan VALUES("5","1","KARTU KELUARGA","","","","","","");
INSERT INTO t02_jaminan VALUES("6","1","BUKU NIKAH SUAMI N ISTRI","","","","","","");
INSERT INTO t02_jaminan VALUES("7","2","JAMSOSTEK","","","","","","");
INSERT INTO t02_jaminan VALUES("8","2","BUKU TABUNGAN + ATM BRI","","","","","","");
INSERT INTO t02_jaminan VALUES("9","2","KARTU KELUARGA","","","","","","");
INSERT INTO t02_jaminan VALUES("10","2","IJAZAH SMA","","","","","","");
INSERT INTO t02_jaminan VALUES("11","3","BUKU TABUNGAN + ATM BCA","","","","","","");
INSERT INTO t02_jaminan VALUES("12","3","JAMSOSTEK","","","","","","");
INSERT INTO t02_jaminan VALUES("13","3","KARTU KELUARGA","","","","","","");
INSERT INTO t02_jaminan VALUES("14","3","IJAZAH SMK","","","","","","");
INSERT INTO t02_jaminan VALUES("15","4","BUKU TABUNGAN + ATM MANDIRI","","","","","","");
INSERT INTO t02_jaminan VALUES("16","4","JAMSOSTEK","","","","","","");
INSERT INTO t02_jaminan VALUES("17","4","AKTA LAHIR","","","","","","");
INSERT INTO t02_jaminan VALUES("18","4","IJAZAH SMP","","","","","","");
INSERT INTO t02_jaminan VALUES("19","4","2 BUKU NIKAH","","","","","","");



DROP TABLE t03_pinjaman;

CREATE TABLE `t03_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Macet` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO t03_pinjaman VALUES("1","60001","2019-03-04","1","1,2,3,4,5,6","10400000.00","10","2.40","0.40","5","1040000.00","250000.00","1290000.00","","500000.00","18000.00","1","201903","N");
INSERT INTO t03_pinjaman VALUES("2","60002","2019-03-01","3","11,12,13,14","4160000.00","6","2.24","0.40","5","694000.00","93000.00","787000.00","","200000.00","18000.00","1","201903","N");
INSERT INTO t03_pinjaman VALUES("3","60003","2019-04-22","4","15,16,17,18,19","4160000.00","7","2.40","0.40","5","595000.00","100000.00","695000.00","","200000.00","18000.00","1","201904","N");
INSERT INTO t03_pinjaman VALUES("4","60002B","2019-04-30","3","11,12,13,14","7280000.00","8","2.25","0.40","5","910000.00","164000.00","1074000.00","","350000.00","18000.00","1","201904","N");



DROP TABLE t04_pinjamanangsuran;

CREATE TABLE `t04_pinjamanangsuran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Periode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t04_pinjamanangsurantemp;

CREATE TABLE `t04_pinjamanangsurantemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Periode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

INSERT INTO t04_pinjamanangsurantemp VALUES("1","1","1","2019-04-04","1040000.00","250000.00","1290000.00","9360000.00","2019-03-30","-5","0.00","0.00","1290000.00","1290000.00","CB 2500000","201903");
INSERT INTO t04_pinjamanangsurantemp VALUES("2","1","2","2019-05-04","1040000.00","250000.00","1290000.00","8320000.00","2019-04-24","-10","0.00","0.00","1290000.00","1290000.00","cb 2150000","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("3","1","3","2019-06-04","1040000.00","250000.00","1290000.00","7280000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("4","1","4","2019-07-04","1040000.00","250000.00","1290000.00","6240000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("5","1","5","2019-08-04","1040000.00","250000.00","1290000.00","5200000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("6","1","6","2019-09-04","1040000.00","250000.00","1290000.00","4160000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("7","1","7","2019-10-04","1040000.00","250000.00","1290000.00","3120000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("8","1","8","2019-11-04","1040000.00","250000.00","1290000.00","2080000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("9","1","9","2019-12-04","1040000.00","250000.00","1290000.00","1040000.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("10","1","10","2020-01-04","1040000.00","250000.00","1290000.00","0.00","","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("11","2","1","2019-04-01","694000.00","93000.00","787000.00","3466000.00","2019-04-26","25","58700.00","0.00","787000.00","845700.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("12","2","2","2019-05-01","694000.00","93000.00","787000.00","2772000.00","2019-04-26","-5","20000.00","0.00","787000.00","807000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("13","2","3","2019-06-01","694000.00","93000.00","787000.00","2078000.00","2019-04-29","-33","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("14","2","4","2019-07-01","694000.00","93000.00","787000.00","1384000.00","2019-04-29","-63","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("15","2","5","2019-08-01","694000.00","93000.00","787000.00","690000.00","2019-04-29","-94","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("16","2","6","2019-09-01","690000.00","97000.00","787000.00","0.00","2019-04-29","-125","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("17","3","1","2019-05-22","595000.00","100000.00","695000.00","3565000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("18","3","2","2019-06-22","595000.00","100000.00","695000.00","2970000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("19","3","3","2019-07-22","595000.00","100000.00","695000.00","2375000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("20","3","4","2019-08-22","595000.00","100000.00","695000.00","1780000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("21","3","5","2019-09-22","595000.00","100000.00","695000.00","1185000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("22","3","6","2019-10-22","595000.00","100000.00","695000.00","590000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("23","3","7","2019-11-22","590000.00","105000.00","695000.00","0.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("24","4","1","2019-05-30","910000.00","164000.00","1074000.00","6370000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("25","4","2","2019-06-30","910000.00","164000.00","1074000.00","5460000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("26","4","3","2019-07-30","910000.00","164000.00","1074000.00","4550000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("27","4","4","2019-08-30","910000.00","164000.00","1074000.00","3640000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("28","4","5","2019-09-30","910000.00","164000.00","1074000.00","2730000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("29","4","6","2019-10-30","910000.00","164000.00","1074000.00","1820000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("30","4","7","2019-11-30","910000.00","164000.00","1074000.00","910000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("31","4","8","2019-12-30","910000.00","164000.00","1074000.00","0.00","","","","","","","","");



DROP TABLE t05_pinjamanjaminan;

CREATE TABLE `t05_pinjamanjaminan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `jaminan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t06_pinjamantitipan;

CREATE TABLE `t06_pinjamantitipan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Masuk` float(14,2) NOT NULL DEFAULT '0.00',
  `Keluar` float(14,2) NOT NULL DEFAULT '0.00',
  `Sisa` float(14,2) NOT NULL DEFAULT '0.00',
  `Angsuran_Ke` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t07_marketing;

CREATE TABLE `t07_marketing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `NoHP` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO t07_marketing VALUES("1","ANDOKO","PURI INDAH AA 57","081.1111111");
INSERT INTO t07_marketing VALUES("2","EKO","PURI NDAH AA 56","081.22222222");



DROP TABLE t08_pinjamanpotongan;

CREATE TABLE `t08_pinjamanpotongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t08_pinjamanpotongan VALUES("1","2","2019-04-29","POTONGAN PELUNASAN 60001","100000.00");



DROP TABLE t09_jurnaltransaksi;

CREATE TABLE `t09_jurnaltransaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE t10_jurnal;

CREATE TABLE `t10_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tanggal` date NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

INSERT INTO t10_jurnal VALUES("1","2019-04-22","201904","3.PINJ","1.2003","4160000.00","0.00","Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("2","2019-04-22","201904","3.PINJ","1.1003","0.00","4160000.00","Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("3","2019-04-22","201904","3.ADM","1.1003","200000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("4","2019-04-22","201904","3.ADM","5.1000","0.00","200000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("5","2019-04-22","201904","3.MAT","1.1003","18000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("6","2019-04-22","201904","3.MAT","5.4000","0.00","18000.00","Pendapatan Materai Pinjaman No. Kontrak 60003");
INSERT INTO t10_jurnal VALUES("13","2019-04-24","201904","2.ANG","1.1003","1040000.00","0.00","Pembayaran Angsuran ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("14","2019-04-24","201904","2.ANG","1.2003","0.00","1040000.00","Pembayaran Angsuran ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("15","2019-04-24","201904","2.BGA","1.1003","250000.00","0.00","Pendapatan Bunga ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("16","2019-04-24","201904","2.BGA","3.1000","0.00","250000.00","Pendapatan Bunga ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("17","2019-04-24","201904","2.DND","1.1003","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("18","2019-04-24","201904","2.DND","5.3000","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("19","2019-04-26","201904","11.ANG","1.1003","694000.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("20","2019-04-26","201904","11.ANG","1.2003","0.00","694000.00","Pembayaran Angsuran ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("21","2019-04-26","201904","11.BGA","1.1003","93000.00","0.00","Pendapatan Bunga ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("22","2019-04-26","201904","11.BGA","3.1000","0.00","93000.00","Pendapatan Bunga ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("23","2019-04-26","201904","11.DND","1.1003","58700.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("24","2019-04-26","201904","11.DND","5.3000","0.00","58700.00","Pendapatan Denda ke 1 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("25","2019-04-26","201904","12.ANG","1.1003","694000.00","0.00","Pembayaran Angsuran ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("26","2019-04-26","201904","12.ANG","1.2003","0.00","694000.00","Pembayaran Angsuran ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("27","2019-04-26","201904","12.BGA","1.1003","93000.00","0.00","Pendapatan Bunga ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("28","2019-04-26","201904","12.BGA","3.1000","0.00","93000.00","Pendapatan Bunga ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("29","2019-04-26","201904","12.DND","1.1003","20000.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("30","2019-04-26","201904","12.DND","5.3000","0.00","20000.00","Pendapatan Denda ke 2 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("31","2019-04-29","201904","13.ANG","1.1003","694000.00","0.00","Pembayaran Angsuran ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("32","2019-04-29","201904","13.ANG","1.2003","0.00","694000.00","Pembayaran Angsuran ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("33","2019-04-29","201904","13.BGA","1.1003","93000.00","0.00","Pendapatan Bunga ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("34","2019-04-29","201904","13.BGA","3.1000","0.00","93000.00","Pendapatan Bunga ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("35","2019-04-29","201904","13.DND","1.1003","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("36","2019-04-29","201904","13.DND","5.3000","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("55","2019-04-29","201904","60002.PT","4.7000","100000.00","0.00","Potongan Pinjaman No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("56","2019-04-29","201904","60002.PT","1.1003","0.00","100000.00","Potongan Pinjaman No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("57","2019-04-29","201904","16.ANG","1.1003","690000.00","0.00","Pembayaran Angsuran ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("58","2019-04-29","201904","16.ANG","1.2003","0.00","690000.00","Pembayaran Angsuran ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("59","2019-04-29","201904","16.BGA","1.1003","97000.00","0.00","Pendapatan Bunga ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("60","2019-04-29","201904","16.BGA","3.1000","0.00","97000.00","Pendapatan Bunga ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("61","2019-04-29","201904","16.DND","1.1003","0.00","0.00","Pendapatan Denda ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("62","2019-04-29","201904","16.DND","5.3000","0.00","0.00","Pendapatan Denda ke 6 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("63","2019-04-29","201904","15.ANG","1.1003","694000.00","0.00","Pembayaran Angsuran ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("64","2019-04-29","201904","15.ANG","1.2003","0.00","694000.00","Pembayaran Angsuran ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("65","2019-04-29","201904","15.BGA","1.1003","93000.00","0.00","Pendapatan Bunga ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("66","2019-04-29","201904","15.BGA","3.1000","0.00","93000.00","Pendapatan Bunga ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("67","2019-04-29","201904","15.DND","1.1003","0.00","0.00","Pendapatan Denda ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("68","2019-04-29","201904","15.DND","5.3000","0.00","0.00","Pendapatan Denda ke 5 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("81","2019-04-29","201904","14.ANG","1.1003","694000.00","0.00","Pembayaran Angsuran ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("82","2019-04-29","201904","14.ANG","1.2003","0.00","694000.00","Pembayaran Angsuran ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("83","2019-04-29","201904","14.BGA","1.1003","93000.00","0.00","Pendapatan Bunga ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("84","2019-04-29","201904","14.BGA","3.1000","0.00","93000.00","Pendapatan Bunga ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("85","2019-04-29","201904","14.DND","1.1003","0.00","0.00","Pendapatan Denda ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("86","2019-04-29","201904","14.DND","5.3000","0.00","0.00","Pendapatan Denda ke 4 No. Kontrak 60002");
INSERT INTO t10_jurnal VALUES("87","2019-04-30","201904","4.PINJ","1.2003","7280000.00","0.00","Pinjaman No. Kontrak 60002B");
INSERT INTO t10_jurnal VALUES("88","2019-04-30","201904","4.PINJ","1.1003","0.00","7280000.00","Pinjaman No. Kontrak 60002B");
INSERT INTO t10_jurnal VALUES("89","2019-04-30","201904","4.ADM","1.1003","350000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60002B");
INSERT INTO t10_jurnal VALUES("90","2019-04-30","201904","4.ADM","5.1000","0.00","350000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60002B");
INSERT INTO t10_jurnal VALUES("91","2019-04-30","201904","4.MAT","1.1003","18000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60002B");
INSERT INTO t10_jurnal VALUES("92","2019-04-30","201904","4.MAT","5.4000","0.00","18000.00","Pendapatan Materai Pinjaman No. Kontrak 60002B");



DROP TABLE t11_jurnalmaster;

CREATE TABLE `t11_jurnalmaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `Periode` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t12_jurnaldetail;

CREATE TABLE `t12_jurnaldetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jurnalmaster_id` int(11) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t73_pinjamanlap;

CREATE TABLE `t73_pinjamanlap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT '0',
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

INSERT INTO t73_pinjamanlap VALUES("1","pinjaman_id","N","id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("2","Kontrak_No","Y","Kontrak","left","1","none");
INSERT INTO t73_pinjamanlap VALUES("3","Kontrak_Tgl","Y","Awal Kontrak","left","4","tanggal");
INSERT INTO t73_pinjamanlap VALUES("4","nasabah_id","N","nasabah_id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("5","jaminan_id","N","jaminan_id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("6","Pinjaman","Y","Nominal","right","6","numerik");
INSERT INTO t73_pinjamanlap VALUES("7","Angsuran_Lama","Y","Lama Angsur","right","7","none");
INSERT INTO t73_pinjamanlap VALUES("8","Angsuran_Bunga_Prosen","N","Bunga (%)","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("9","Angsuran_Denda","N","Denda (%)","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("10","Dispensasi_Denda","N","Dispensasi (Hari)","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("11","Angsuran_Pokok","N","Pokok","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("12","Angsuran_Bunga","N","Bunga","right","99","numerik");
INSERT INTO t73_pinjamanlap VALUES("13","Angsuran_Total","N","Total","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("14","No_Ref","N","No. Referensi","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("15","Biaya_Administrasi","N","Administrasi","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("16","Biaya_Materai","N","Materai","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("17","marketing_id","N","marketing_id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("18","Periode","N","Periode","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("19","Macet","N","Macet","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("20","NasabahNama","Y","Nama Anggota","left","2","none");
INSERT INTO t73_pinjamanlap VALUES("21","NasabahAlamat","Y","Alamat","left","3","none");
INSERT INTO t73_pinjamanlap VALUES("22","No_Telp_Hp","N","No. Telp. / HP","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("23","Pekerjaan","N","Pekerjaan","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("24","Pekerjaan_Alamat","N","Alamat Pekerjaan","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("25","Pekerjaan_No_Telp_Hp","N","No. Telp. / HP Pekerjaan","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("26","Status","N","Status","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("27","NasabahKeterangan","N","Keterangan Nasabah","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("28","Merk_Type","N","Merk / Tipe","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("29","No_Rangka","N","No. Rangka","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("30","No_Mesin","N","No. Mesin","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("31","Warna","N","Warna","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("32","No_Pol","N","No. Pol.","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("33","JaminanKeterangan","N","Keterangan Jaminan","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("34","Atas_Nama","N","Atas Nama","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("35","MarketingNama","N","Marketing","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("36","MarketingAlamat","N","Alamat","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("37","NoHP","N","No. HP","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("64","AkhirKontrak","Y","Akhir Kontrak","left","5","tanggal");
INSERT INTO t73_pinjamanlap VALUES("65","sudah_bayar","Y","Sudah Bayar","right","8","none");
INSERT INTO t73_pinjamanlap VALUES("66","pd_Angsuran_Pokok","Y","Piutang Pokok","right","9","numerik");
INSERT INTO t73_pinjamanlap VALUES("67","pd_Angsuran_Bunga","Y","Piutang Bunga","right","10","numerik");
INSERT INTO t73_pinjamanlap VALUES("68","pd_Angsuran_Total","Y","Total","right","11","numerik");



DROP TABLE t74_jurnallapclosed;

CREATE TABLE `t74_jurnallapclosed` (
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `AkunKode` varchar(35) NOT NULL,
  `AkunNama` varchar(90) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.PINJ","Pinjaman No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","4160000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.PINJ","Pinjaman No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","4160000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","200000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60002","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","200000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.MAT","Pendapatan Materai Pinjaman No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","18000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-01","2.MAT","Pendapatan Materai Pinjaman No. Kontrak 60002","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","18000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.PINJ","Pinjaman No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","10400000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.PINJ","Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","10400000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","500000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60001","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","500000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.MAT","Pendapatan Materai Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","18000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-04","1.MAT","Pendapatan Materai Pinjaman No. Kontrak 60001","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","18000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","1040000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","1040000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.BGA","Pendapatan Bunga ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","250000.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.BGA","Pendapatan Bunga ke 1 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","250000.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.DND","Pendapatan Denda ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t74_jurnallapclosed VALUES("2019-03-30","1.DND","Pendapatan Denda ke 1 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");



DROP TABLE t75_company;

CREATE TABLE `t75_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `NoTelp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t75_company VALUES("1","Koperasi Bersama","Sidoarjo","-");



DROP TABLE t76_neracaold;

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




DROP TABLE t77_labarugiold;

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




DROP TABLE t78_bukubesarlap;

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

INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-01","","Saldo Awal","0.00","0.00","13520000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-22","3.PINJ","Pinjaman No. Kontrak 60003","4160000.00","0.00","17680000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-24","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","0.00","1040000.00","16640000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-26","11.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60002","0.00","694000.00","15946000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-26","12.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60002","0.00","694000.00","15252000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-29","13.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60002","0.00","694000.00","14558000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-29","16.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60002","0.00","690000.00","13868000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-29","15.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60002","0.00","694000.00","13174000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-29","14.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60002","0.00","694000.00","12480000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-30","4.PINJ","Pinjaman No. Kontrak 60002B","7280000.00","0.00","19760000.00");



DROP TABLE t79_jurnallap;

CREATE TABLE `t79_jurnallap` (
  `Tanggal` date NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  `AkunKode` varchar(35) NOT NULL,
  `AkunNama` varchar(90) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t79_jurnallap VALUES("2019-04-22","3.PINJ","Pinjaman No. Kontrak 60003","1.2003","PINJAMAN BERJANGKA & ANGSURAN","4160000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","3.PINJ","Pinjaman No. Kontrak 60003","1.1003","KAS BANK - BCA SURABAYA","0.00","4160000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","3.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60003","1.1003","KAS BANK - BCA SURABAYA","200000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","3.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60003","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","200000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","3.MAT","Pendapatan Materai Pinjaman No. Kontrak 60003","1.1003","KAS BANK - BCA SURABAYA","18000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","3.MAT","Pendapatan Materai Pinjaman No. Kontrak 60003","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","18000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","1040000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","1040000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.BGA","Pendapatan Bunga ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","250000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.BGA","Pendapatan Bunga ke 2 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","250000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.DND","Pendapatan Denda ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","2.DND","Pendapatan Denda ke 2 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","694000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","694000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.BGA","Pendapatan Bunga ke 1 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","93000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.BGA","Pendapatan Bunga ke 1 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","93000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.DND","Pendapatan Denda ke 1 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","58700.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","11.DND","Pendapatan Denda ke 1 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","58700.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","694000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","694000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.BGA","Pendapatan Bunga ke 2 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","93000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.BGA","Pendapatan Bunga ke 2 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","93000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.DND","Pendapatan Denda ke 2 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","20000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-26","12.DND","Pendapatan Denda ke 2 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","20000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","694000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","694000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.BGA","Pendapatan Bunga ke 3 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","93000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.BGA","Pendapatan Bunga ke 3 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","93000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.DND","Pendapatan Denda ke 3 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","13.DND","Pendapatan Denda ke 3 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","60002.PT","Potongan Pinjaman No. Kontrak 60002","4.7000","POTONGAN","100000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","60002.PT","Potongan Pinjaman No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","100000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","690000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","690000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.BGA","Pendapatan Bunga ke 6 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","97000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.BGA","Pendapatan Bunga ke 6 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","97000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.DND","Pendapatan Denda ke 6 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","16.DND","Pendapatan Denda ke 6 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","694000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","694000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.BGA","Pendapatan Bunga ke 5 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","93000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.BGA","Pendapatan Bunga ke 5 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","93000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.DND","Pendapatan Denda ke 5 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","15.DND","Pendapatan Denda ke 5 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","694000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60002","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","694000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.BGA","Pendapatan Bunga ke 4 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","93000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.BGA","Pendapatan Bunga ke 4 No. Kontrak 60002","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","93000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.DND","Pendapatan Denda ke 4 No. Kontrak 60002","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-29","14.DND","Pendapatan Denda ke 4 No. Kontrak 60002","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.PINJ","Pinjaman No. Kontrak 60002B","1.2003","PINJAMAN BERJANGKA & ANGSURAN","7280000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.PINJ","Pinjaman No. Kontrak 60002B","1.1003","KAS BANK - BCA SURABAYA","0.00","7280000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60002B","1.1003","KAS BANK - BCA SURABAYA","350000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60002B","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","350000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.MAT","Pendapatan Materai Pinjaman No. Kontrak 60002B","1.1003","KAS BANK - BCA SURABAYA","18000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","4.MAT","Pendapatan Materai Pinjaman No. Kontrak 60002B","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","18000.00");



DROP TABLE t80_rekeningold;

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

INSERT INTO t80_rekeningold VALUES("1","1","AKTIVA","GROUP","DEBET","NERACA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1000","KAS","HEADER","DEBET","NERACA","","1","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1001","KAS BANK - BCA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1002","KAS BANK - MANDIRI","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2004","PIUTANG SIDOARJO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2005","PIUTANG KPL 5","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2006","PIUTANG TROSOBO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2007","PIUTANG DANIEL","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.2008","PIUTANG ANDIK","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.3000","PERSEDIAAN KANTOR","DETAIL","DEBET","NERACA","","1","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("1","1.4000","AKUMULASI PENYUSUTAN","DETAIL","DEBET","NERACA","","1","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2","PASSIVA","GROUP","CREDIT","NERACA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.1000","HUTANG PAJAJARAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.2000","HUTANG DANIEL","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.3000","TITIPAN NASABAH","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.4000","MODAL DISETOR","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.5000","SHU TAHUN LALU","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.6000","SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.7000","PEMBAGIAN SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","986000.00","201903");
INSERT INTO t80_rekeningold VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201903");
INSERT INTO t80_rekeningold VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","201903");



DROP TABLE t82_jurnalold;

CREATE TABLE `t82_jurnalold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tanggal` date NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `NomorTransaksi` varchar(25) NOT NULL,
  `Rekening` varchar(35) NOT NULL,
  `Debet` float(14,2) NOT NULL,
  `Kredit` float(14,2) NOT NULL,
  `Keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO t82_jurnalold VALUES("1","2019-03-04","201903","1.PINJ","1.2003","10400000.00","0.00","Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("2","2019-03-04","201903","1.PINJ","1.1003","0.00","10400000.00","Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("3","2019-03-04","201903","1.ADM","1.1003","500000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("4","2019-03-04","201903","1.ADM","5.1000","0.00","500000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("5","2019-03-04","201903","1.MAT","1.1003","18000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("6","2019-03-04","201903","1.MAT","5.4000","0.00","18000.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("7","2019-03-01","201903","2.PINJ","1.2003","4160000.00","0.00","Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("8","2019-03-01","201903","2.PINJ","1.1003","0.00","4160000.00","Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("9","2019-03-01","201903","2.ADM","1.1003","200000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("10","2019-03-01","201903","2.ADM","5.1000","0.00","200000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("11","2019-03-01","201903","2.MAT","1.1003","18000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("12","2019-03-01","201903","2.MAT","5.4000","0.00","18000.00","Pendapatan Materai Pinjaman No. Kontrak 60002");
INSERT INTO t82_jurnalold VALUES("13","2019-03-30","201903","1.ANG","1.1003","1040000.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("14","2019-03-30","201903","1.ANG","1.2003","0.00","1040000.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("15","2019-03-30","201903","1.BGA","1.1003","250000.00","0.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("16","2019-03-30","201903","1.BGA","3.1000","0.00","250000.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("17","2019-03-30","201903","1.DND","1.1003","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("18","2019-03-30","201903","1.DND","5.3000","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");



DROP TABLE t85_neraca2;

CREATE TABLE `t85_neraca2` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL,
  `field04` varchar(24) DEFAULT NULL,
  `field05` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t85_neraca2 VALUES("","","Maret 2019","April 2019","");
INSERT INTO t85_neraca2 VALUES("<strong>AKTIVA</strong>","","","","");
INSERT INTO t85_neraca2 VALUES("1.1001","KAS BANK - BCA","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.1002","KAS BANK - MANDIRI","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.1003","KAS BANK - BCA SURABAYA","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.1004","KAS BESAR","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.1005","KAS KECIL HARIAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2002","NASABAH MACET > 12 BULAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2004","PIUTANG SIDOARJO","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2005","PIUTANG KPL 5","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2006","PIUTANG TROSOBO","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2007","PIUTANG DANIEL","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.2008","PIUTANG ANDIK","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.3000","PERSEDIAAN KANTOR","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("1.4000","AKUMULASI PENYUSUTAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("","","<strong>0.00</strong>","<strong>0.00</strong>","<strong>0.00</strong>");
INSERT INTO t85_neraca2 VALUES("","","","","");
INSERT INTO t85_neraca2 VALUES("<strong>PASSIVA</strong>","","","","");
INSERT INTO t85_neraca2 VALUES("2.1000","HUTANG PAJAJARAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.2000","HUTANG DANIEL","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.3000","TITIPAN NASABAH","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.4000","MODAL DISETOR","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.5000","SHU TAHUN LALU","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.6000","SHU TAHUN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.7000","PEMBAGIAN SHU TAHUN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.8000","SHU TAHUN BERJALAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("2.9000","SHU BULAN BERJALAN","0.00","0.00","0.00");
INSERT INTO t85_neraca2 VALUES("","","<strong>0.00</strong>","<strong>0.00</strong>","<strong>0.00</strong>");
INSERT INTO t85_neraca2 VALUES("","","","","");
INSERT INTO t85_neraca2 VALUES("","","<strong>0.00</strong>","<strong>0.00</strong>","<strong>0.00</strong>");



DROP TABLE t86_labarugi2;

CREATE TABLE `t86_labarugi2` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL,
  `field04` varchar(24) DEFAULT NULL,
  `field05` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t87_neraca;

CREATE TABLE `t87_neraca` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(64) DEFAULT NULL,
  `field04` varchar(64) DEFAULT NULL,
  `field05` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t87_neraca VALUES("","","Maret 2019","April 2019","");
INSERT INTO t87_neraca VALUES("<strong>AKTIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("1.1001","KAS BANK - BCA","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.1002","KAS BANK - MANDIRI","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.1003","KAS BANK - BCA SURABAYA","-12,534,000.00","-17,397,300.00","");
INSERT INTO t87_neraca VALUES("1.1004","KAS BESAR","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.1005","KAS KECIL HARIAN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2002","NASABAH MACET > 12 BULAN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","13,520,000.00","19,760,000.00","");
INSERT INTO t87_neraca VALUES("1.2004","PIUTANG SIDOARJO","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2005","PIUTANG KPL 5","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2006","PIUTANG TROSOBO","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2007","PIUTANG DANIEL","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.2008","PIUTANG ANDIK","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.3000","PERSEDIAAN KANTOR","0.00","0.00","");
INSERT INTO t87_neraca VALUES("1.4000","AKUMULASI PENYUSUTAN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("","","<strong>986,000.00</strong>","<strong>2,362,700.00</strong>","");
INSERT INTO t87_neraca VALUES("","","","","");
INSERT INTO t87_neraca VALUES("<strong>PASSIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("2.1000","HUTANG PAJAJARAN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.2000","HUTANG DANIEL","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.3000","TITIPAN NASABAH","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.4000","MODAL DISETOR","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.5000","SHU TAHUN LALU","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.6000","SHU TAHUN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.7000","PEMBAGIAN SHU TAHUN","0.00","0.00","");
INSERT INTO t87_neraca VALUES("2.8000","SHU TAHUN BERJALAN","0.00","986,000.00","");
INSERT INTO t87_neraca VALUES("2.9000","SHU BULAN BERJALAN","986,000.00","1,376,700.00","");
INSERT INTO t87_neraca VALUES("","","<strong>986,000.00</strong>","<strong>2,362,700.00</strong>","");
INSERT INTO t87_neraca VALUES("","","","","");
INSERT INTO t87_neraca VALUES("","","<strong>0.00</strong>","<strong>0.00</strong>","");



DROP TABLE t88_labarugi;

CREATE TABLE `t88_labarugi` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(64) DEFAULT NULL,
  `field04` varchar(64) DEFAULT NULL,
  `field05` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t88_labarugi VALUES("","","Maret 2019","April 2019","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","250,000.00","812,000.00","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("5.3000","PENDAPATAN DENDA","0.00","78,700.00","");
INSERT INTO t88_labarugi VALUES("5.2000","PENDAPATAN BUNGA BANK","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","700,000.00","550,000.00","");
INSERT INTO t88_labarugi VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","36,000.00","36,000.00","");
INSERT INTO t88_labarugi VALUES("","","<strong>986,000.00</strong>","<strong>1,476,700.00</strong>","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA</strong>","","","","");
INSERT INTO t88_labarugi VALUES("4.5000","BIAYA PENYUSUTAN","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("4.4000","BIAYA ADMINISTRASI BANK","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("4.7000","POTONGAN","0.00","100,000.00","");
INSERT INTO t88_labarugi VALUES("4.2000","BIAYA PERKANTORAN & UMUM","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("4.6000","BIAYA IKLAN","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("4.1000","BIAYA KARYAWAN","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("6.1000","BIAYA LAIN-LAIN","0.00","0.00","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>","<strong>100,000.00</strong>","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("","","<strong>986,000.00</strong>","<strong>1,376,700.00</strong>","");



DROP TABLE t89_rektran;

CREATE TABLE `t89_rektran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `KodeTransaksi` varchar(2) NOT NULL,
  `JenisTransaksi` varchar(255) NOT NULL,
  `DebetRekening` varchar(35) NOT NULL,
  `KreditRekening` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO t89_rektran VALUES("1","01","Pinjaman Disetujui, Nilai Pinjaman","1.2003","1.1003");
INSERT INTO t89_rektran VALUES("2","02","Pinjaman Disetujui, Nilai Administrasi","1.1003","5.1000");
INSERT INTO t89_rektran VALUES("3","03","Pinjaman Disetujui, Nilai Materai","1.1003","5.4000");
INSERT INTO t89_rektran VALUES("4","04","Pembayaran Angsuran, Angsuran Pokok","1.1003","1.2003");
INSERT INTO t89_rektran VALUES("5","05","Pembayaran Angsuran, Angsuran Bunga","1.1003","3.1000");
INSERT INTO t89_rektran VALUES("6","06","Pembayaran Angsuran, Angsuran Denda","1.1003","5.3000");
INSERT INTO t89_rektran VALUES("7","07","Pembayaran Angsuran, Titipan Masuk","1.1003","2.3000");
INSERT INTO t89_rektran VALUES("8","08","Pembayaran Angsuran, Titipan Keluar","2.3000","1.1003");
INSERT INTO t89_rektran VALUES("9","09","Biaya-Biaya, Biaya Karyawan","4.1000","1.1003");
INSERT INTO t89_rektran VALUES("10","10","Potongan","4.7000","1.1003");
INSERT INTO t89_rektran VALUES("11","11","SHU Bulan Berjalan","2.9000","2.9000");
INSERT INTO t89_rektran VALUES("12","12","Nasabah Macet","1.2003","1.2002");
INSERT INTO t89_rektran VALUES("13","13","SHU Tahun Berjalan","2.8000","2.8000");



DROP TABLE t90_rektran;

CREATE TABLE `t90_rektran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `KodeTransaksi` varchar(35) NOT NULL,
  `NamaTransaksi` varchar(100) NOT NULL,
  `KodeRekening` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO t90_rektran VALUES("1","01","Pembayaran Angsuran","1.2003");
INSERT INTO t90_rektran VALUES("2","02","Pendapatan Bunga","3.1000");
INSERT INTO t90_rektran VALUES("3","03","Pendapatan Denda","5.3000");
INSERT INTO t90_rektran VALUES("4","04","Titipan Keluar","2.3000");
INSERT INTO t90_rektran VALUES("5","05","Titipan Masuk","2.3000");
INSERT INTO t90_rektran VALUES("6","06","Pendapatan Administrasi","5.1000");
INSERT INTO t90_rektran VALUES("7","07","Pendapatan Asuransi","5.1000");
INSERT INTO t90_rektran VALUES("8","08","Pendapatan Notaris","5.1000");
INSERT INTO t90_rektran VALUES("9","09","Pendapatan Materai","5.1000");
INSERT INTO t90_rektran VALUES("10","10","Pinjaman Angsuran & Berjangka","1.2003");
INSERT INTO t90_rektran VALUES("11","11","SHU Bulan Berjalan","2.9000");



DROP TABLE t91_rekening;

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
  `Periode` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO t91_rekening VALUES("1","1","AKTIVA","GROUP","DEBET","NERACA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1000","KAS","HEADER","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1001","KAS BANK - BCA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1002","KAS BANK - MANDIRI","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","-12534000.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","13520000.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2004","PIUTANG SIDOARJO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2005","PIUTANG KPL 5","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2006","PIUTANG TROSOBO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2007","PIUTANG DANIEL","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2008","PIUTANG ANDIK","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.3000","PERSEDIAAN KANTOR","DETAIL","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.4000","AKUMULASI PENYUSUTAN","DETAIL","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2","PASSIVA","GROUP","CREDIT","NERACA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.1000","HUTANG PAJAJARAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.2000","HUTANG DANIEL","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.3000","TITIPAN NASABAH","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.4000","MODAL DISETOR","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.5000","SHU TAHUN LALU","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.6000","SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.7000","PEMBAGIAN SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","986000.00","201904");
INSERT INTO t91_rekening VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","250000.00","201904");
INSERT INTO t91_rekening VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","700000.00","201904");
INSERT INTO t91_rekening VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","36000.00","201904");
INSERT INTO t91_rekening VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","201904");



DROP TABLE t92_periodeold;

CREATE TABLE `t92_periodeold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t92_periodeold VALUES("1","3","2019","201903");



DROP TABLE t93_periode;

CREATE TABLE `t93_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t93_periode VALUES("1","4","2019","201904");



DROP TABLE t94_log;

CREATE TABLE `t94_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index_` tinyint(4) NOT NULL,
  `subj_` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t95_logdesc;

CREATE TABLE `t95_logdesc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `desc_` text NOT NULL,
  `date_solved` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t96_employees;

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
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
  `Profile` longtext,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO t96_employees VALUES("1","","","","","","","","","","","","","","","","","","21232f297a57a5a743894a0e4a801fc3","-1","admin","N","");



DROP TABLE t97_userlevels;

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO t97_userlevels VALUES("-2","Anonymous");
INSERT INTO t97_userlevels VALUES("-1","Administrator");
INSERT INTO t97_userlevels VALUES("0","Default");



DROP TABLE t98_userlevelpermissions;

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}cf01_home.php","8");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t01_nasabah","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t02_jaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t03_pinjaman","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t04_pinjamanangsuran","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t05_pinjamanjaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t06_pinjamantitipan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t94_log","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t95_logdesc","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t96_employees","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t97_userlevels","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t98_userlevelpermissions","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t99_audittrail","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php","8");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t02_jaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsuran","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsurantemp","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t05_pinjamanjaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t06_pinjamantitipan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t08_pinjamanpotongan","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t92_periodeold","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t94_log","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t95_logdesc","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t97_userlevels","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t98_userlevelpermissions","0");
INSERT INTO t98_userlevelpermissions VALUES("-2","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}cf01_home.php","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t01_nasabah","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t02_jaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t03_pinjaman","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t04_pinjamanangsuran","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t05_pinjamanjaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t06_pinjamantitipan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t94_log","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t95_logdesc","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t96_employees","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t97_userlevels","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t98_userlevelpermissions","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{1F4EE816-E057-4A7E-9024-5EA4446B7598}t99_audittrail","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t02_jaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsuran","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t04_pinjamanangsurantemp","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t05_pinjamanjaminan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t06_pinjamantitipan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t08_pinjamanpotongan","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t92_periodeold","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t94_log","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t95_logdesc","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t97_userlevels","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t98_userlevelpermissions","0");
INSERT INTO t98_userlevelpermissions VALUES("0","{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail","0");



DROP TABLE t99_audittrail;

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=latin1;

INSERT INTO t99_audittrail VALUES("1","2019-02-28 19:02:54","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("2","2019-02-28 19:04:59","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("3","2019-02-28 19:08:50","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("4","2019-03-04 19:10:48","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("5","2019-03-04 19:11:20","/simkop5/t07_marketingadd.php","1","A","t07_marketing","Nama","1","","ANDOKO");
INSERT INTO t99_audittrail VALUES("6","2019-03-04 19:11:20","/simkop5/t07_marketingadd.php","1","A","t07_marketing","Alamat","1","","PURI INDAH AA 57");
INSERT INTO t99_audittrail VALUES("7","2019-03-04 19:11:20","/simkop5/t07_marketingadd.php","1","A","t07_marketing","NoHP","1","","081.1111111");
INSERT INTO t99_audittrail VALUES("8","2019-03-04 19:11:20","/simkop5/t07_marketingadd.php","1","A","t07_marketing","id","1","","1");
INSERT INTO t99_audittrail VALUES("9","2019-03-04 19:11:33","/simkop5/t07_marketingadd.php","1","A","t07_marketing","Nama","2","","EKO");
INSERT INTO t99_audittrail VALUES("10","2019-03-04 19:11:33","/simkop5/t07_marketingadd.php","1","A","t07_marketing","Alamat","2","","PURI NDAH AA 56");
INSERT INTO t99_audittrail VALUES("11","2019-03-04 19:11:33","/simkop5/t07_marketingadd.php","1","A","t07_marketing","NoHP","2","","081.22222222");
INSERT INTO t99_audittrail VALUES("12","2019-03-04 19:11:33","/simkop5/t07_marketingadd.php","1","A","t07_marketing","id","2","","2");
INSERT INTO t99_audittrail VALUES("13","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Nama","1","","HARI");
INSERT INTO t99_audittrail VALUES("14","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Alamat","1","","GUBENG KERTAJAYA SE / 21 B KAV TEKOM BLOK Q NO 9");
INSERT INTO t99_audittrail VALUES("15","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","No_Telp_Hp","1","","087.7019.40292");
INSERT INTO t99_audittrail VALUES("16","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan","1","","PT. IRAWAN DJAJA AGUNG");
INSERT INTO t99_audittrail VALUES("17","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_Alamat","1","","RAYA SUKODONO KM 3-8 SIDOARJO");
INSERT INTO t99_audittrail VALUES("18","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_No_Telp_Hp","1","","031-7882381");
INSERT INTO t99_audittrail VALUES("19","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Status","1","","1");
INSERT INTO t99_audittrail VALUES("20","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Keterangan","1","","RUMAH SESUAI");
INSERT INTO t99_audittrail VALUES("21","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","marketing_id","1","","1");
INSERT INTO t99_audittrail VALUES("22","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","id","1","","1");
INSERT INTO t99_audittrail VALUES("23","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","*** Batch insert begin ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("24","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("25","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","1","","BUKU TABUNGAN + ATM MANDIRI");
INSERT INTO t99_audittrail VALUES("26","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","1","","088.999.88888 AN HARI");
INSERT INTO t99_audittrail VALUES("27","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","1","","");
INSERT INTO t99_audittrail VALUES("28","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","1","","");
INSERT INTO t99_audittrail VALUES("29","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","1","","");
INSERT INTO t99_audittrail VALUES("30","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","1","","");
INSERT INTO t99_audittrail VALUES("31","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","1","","");
INSERT INTO t99_audittrail VALUES("32","2019-03-04 19:16:58","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","1","","1");
INSERT INTO t99_audittrail VALUES("33","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","2","","1");
INSERT INTO t99_audittrail VALUES("34","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","2","","AKTA KELAHIRAN");
INSERT INTO t99_audittrail VALUES("35","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","2","","289000000");
INSERT INTO t99_audittrail VALUES("36","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","2","","");
INSERT INTO t99_audittrail VALUES("37","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","2","","");
INSERT INTO t99_audittrail VALUES("38","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","2","","");
INSERT INTO t99_audittrail VALUES("39","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","2","","");
INSERT INTO t99_audittrail VALUES("40","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","2","","");
INSERT INTO t99_audittrail VALUES("41","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","2","","2");
INSERT INTO t99_audittrail VALUES("42","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","3","","1");
INSERT INTO t99_audittrail VALUES("43","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","3","","IJAZAH SD");
INSERT INTO t99_audittrail VALUES("44","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","3","","");
INSERT INTO t99_audittrail VALUES("45","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","3","","");
INSERT INTO t99_audittrail VALUES("46","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","3","","");
INSERT INTO t99_audittrail VALUES("47","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","3","","");
INSERT INTO t99_audittrail VALUES("48","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","3","","");
INSERT INTO t99_audittrail VALUES("49","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","3","","");
INSERT INTO t99_audittrail VALUES("50","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","3","","3");
INSERT INTO t99_audittrail VALUES("51","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","4","","1");
INSERT INTO t99_audittrail VALUES("52","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","4","","JAMSOSTEK");
INSERT INTO t99_audittrail VALUES("53","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","4","","");
INSERT INTO t99_audittrail VALUES("54","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","4","","");
INSERT INTO t99_audittrail VALUES("55","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","4","","");
INSERT INTO t99_audittrail VALUES("56","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","4","","");
INSERT INTO t99_audittrail VALUES("57","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","4","","");
INSERT INTO t99_audittrail VALUES("58","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","4","","");
INSERT INTO t99_audittrail VALUES("59","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","4","","4");
INSERT INTO t99_audittrail VALUES("60","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","5","","1");
INSERT INTO t99_audittrail VALUES("61","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","5","","KARTU KELUARGA");
INSERT INTO t99_audittrail VALUES("62","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","5","","");
INSERT INTO t99_audittrail VALUES("63","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","5","","");
INSERT INTO t99_audittrail VALUES("64","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","5","","");
INSERT INTO t99_audittrail VALUES("65","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","5","","");
INSERT INTO t99_audittrail VALUES("66","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","5","","");
INSERT INTO t99_audittrail VALUES("67","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","5","","");
INSERT INTO t99_audittrail VALUES("68","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","5","","5");
INSERT INTO t99_audittrail VALUES("69","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","6","","1");
INSERT INTO t99_audittrail VALUES("70","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","6","","BUKU NIKAH SUAMI N ISTRI");
INSERT INTO t99_audittrail VALUES("71","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","6","","");
INSERT INTO t99_audittrail VALUES("72","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","6","","");
INSERT INTO t99_audittrail VALUES("73","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","6","","");
INSERT INTO t99_audittrail VALUES("74","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","6","","");
INSERT INTO t99_audittrail VALUES("75","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","6","","");
INSERT INTO t99_audittrail VALUES("76","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","6","","");
INSERT INTO t99_audittrail VALUES("77","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","6","","6");
INSERT INTO t99_audittrail VALUES("78","2019-03-04 19:16:59","/simkop5/t01_nasabahadd.php","1","*** Batch insert successful ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("79","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Nama","2","","BIMA SAPUTRA");
INSERT INTO t99_audittrail VALUES("80","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Alamat","2","","PERUM PONDOK MUTIARA HARUM AO 12 A JATI SIDOARJO");
INSERT INTO t99_audittrail VALUES("81","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","No_Telp_Hp","2","","088.2261.24735");
INSERT INTO t99_audittrail VALUES("82","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan","2","","PT. WAHANA TUNAS UTAMA");
INSERT INTO t99_audittrail VALUES("83","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_Alamat","2","","WONOSARI, DS WATESNEGORO, NGORO GUNUNGSARI MOJOKERTO");
INSERT INTO t99_audittrail VALUES("84","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_No_Telp_Hp","2","","0321-6819010");
INSERT INTO t99_audittrail VALUES("85","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Status","2","","2");
INSERT INTO t99_audittrail VALUES("86","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Keterangan","2","","ALAMAT TIDAK SESUAI");
INSERT INTO t99_audittrail VALUES("87","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","marketing_id","2","","2");
INSERT INTO t99_audittrail VALUES("88","2019-03-04 19:20:31","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","id","2","","2");
INSERT INTO t99_audittrail VALUES("89","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","*** Batch insert begin ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("90","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","7","","2");
INSERT INTO t99_audittrail VALUES("91","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","7","","JAMSOSTEK");
INSERT INTO t99_audittrail VALUES("92","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","7","","");
INSERT INTO t99_audittrail VALUES("93","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","7","","");
INSERT INTO t99_audittrail VALUES("94","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","7","","");
INSERT INTO t99_audittrail VALUES("95","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","7","","");
INSERT INTO t99_audittrail VALUES("96","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","7","","");
INSERT INTO t99_audittrail VALUES("97","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","7","","");
INSERT INTO t99_audittrail VALUES("98","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","7","","7");
INSERT INTO t99_audittrail VALUES("99","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","8","","2");
INSERT INTO t99_audittrail VALUES("100","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","8","","BUKU TABUNGAN + ATM BRI");
INSERT INTO t99_audittrail VALUES("101","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","8","","");
INSERT INTO t99_audittrail VALUES("102","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","8","","");
INSERT INTO t99_audittrail VALUES("103","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","8","","");
INSERT INTO t99_audittrail VALUES("104","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","8","","");
INSERT INTO t99_audittrail VALUES("105","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","8","","");
INSERT INTO t99_audittrail VALUES("106","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","8","","");
INSERT INTO t99_audittrail VALUES("107","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","8","","8");
INSERT INTO t99_audittrail VALUES("108","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","9","","2");
INSERT INTO t99_audittrail VALUES("109","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","9","","KARTU KELUARGA");
INSERT INTO t99_audittrail VALUES("110","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","9","","");
INSERT INTO t99_audittrail VALUES("111","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","9","","");
INSERT INTO t99_audittrail VALUES("112","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","9","","");
INSERT INTO t99_audittrail VALUES("113","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","9","","");
INSERT INTO t99_audittrail VALUES("114","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","9","","");
INSERT INTO t99_audittrail VALUES("115","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","9","","");
INSERT INTO t99_audittrail VALUES("116","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","9","","9");
INSERT INTO t99_audittrail VALUES("117","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","10","","2");
INSERT INTO t99_audittrail VALUES("118","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","10","","IJAZAH SMA");
INSERT INTO t99_audittrail VALUES("119","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","10","","");
INSERT INTO t99_audittrail VALUES("120","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","10","","");
INSERT INTO t99_audittrail VALUES("121","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","10","","");
INSERT INTO t99_audittrail VALUES("122","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","10","","");
INSERT INTO t99_audittrail VALUES("123","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","10","","");
INSERT INTO t99_audittrail VALUES("124","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","10","","");
INSERT INTO t99_audittrail VALUES("125","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","10","","10");
INSERT INTO t99_audittrail VALUES("126","2019-03-04 19:20:32","/simkop5/t01_nasabahadd.php","1","*** Batch insert successful ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("127","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Nama","3","","ANDRIAN YONAS ISNANDAR");
INSERT INTO t99_audittrail VALUES("128","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Alamat","3","","RUSUN PENJARINGANSARI BLOK A 31 A SURABAYA");
INSERT INTO t99_audittrail VALUES("129","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","No_Telp_Hp","3","","089.9355.5870");
INSERT INTO t99_audittrail VALUES("130","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan","3","","PT. SHELTER NUSANTARA");
INSERT INTO t99_audittrail VALUES("131","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_Alamat","3","","MEDOKAN SEMAMPIR SELATAN VA NO. 8");
INSERT INTO t99_audittrail VALUES("132","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_No_Telp_Hp","3","","031-5925075");
INSERT INTO t99_audittrail VALUES("133","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Status","3","","1");
INSERT INTO t99_audittrail VALUES("134","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Keterangan","3","","ALAMAT SESUAI");
INSERT INTO t99_audittrail VALUES("135","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","marketing_id","3","","1");
INSERT INTO t99_audittrail VALUES("136","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","id","3","","3");
INSERT INTO t99_audittrail VALUES("137","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","*** Batch insert begin ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("138","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","11","","3");
INSERT INTO t99_audittrail VALUES("139","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","11","","BUKU TABUNGAN + ATM BCA");
INSERT INTO t99_audittrail VALUES("140","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","11","","");
INSERT INTO t99_audittrail VALUES("141","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","11","","");
INSERT INTO t99_audittrail VALUES("142","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","11","","");
INSERT INTO t99_audittrail VALUES("143","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","11","","");
INSERT INTO t99_audittrail VALUES("144","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","11","","");
INSERT INTO t99_audittrail VALUES("145","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","11","","");
INSERT INTO t99_audittrail VALUES("146","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","11","","11");
INSERT INTO t99_audittrail VALUES("147","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","12","","3");
INSERT INTO t99_audittrail VALUES("148","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","12","","JAMSOSTEK");
INSERT INTO t99_audittrail VALUES("149","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","12","","");
INSERT INTO t99_audittrail VALUES("150","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","12","","");
INSERT INTO t99_audittrail VALUES("151","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","12","","");
INSERT INTO t99_audittrail VALUES("152","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","12","","");
INSERT INTO t99_audittrail VALUES("153","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","12","","");
INSERT INTO t99_audittrail VALUES("154","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","12","","");
INSERT INTO t99_audittrail VALUES("155","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","12","","12");
INSERT INTO t99_audittrail VALUES("156","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","13","","3");
INSERT INTO t99_audittrail VALUES("157","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","13","","KARTU KELUARGA");
INSERT INTO t99_audittrail VALUES("158","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","13","","");
INSERT INTO t99_audittrail VALUES("159","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","13","","");
INSERT INTO t99_audittrail VALUES("160","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","13","","");
INSERT INTO t99_audittrail VALUES("161","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","13","","");
INSERT INTO t99_audittrail VALUES("162","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","13","","");
INSERT INTO t99_audittrail VALUES("163","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","13","","");
INSERT INTO t99_audittrail VALUES("164","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","13","","13");
INSERT INTO t99_audittrail VALUES("165","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","14","","3");
INSERT INTO t99_audittrail VALUES("166","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","14","","IJAZAH SMK");
INSERT INTO t99_audittrail VALUES("167","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","14","","");
INSERT INTO t99_audittrail VALUES("168","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","14","","");
INSERT INTO t99_audittrail VALUES("169","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","14","","");
INSERT INTO t99_audittrail VALUES("170","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","14","","");
INSERT INTO t99_audittrail VALUES("171","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","14","","");
INSERT INTO t99_audittrail VALUES("172","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","14","","");
INSERT INTO t99_audittrail VALUES("173","2019-03-04 19:23:44","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","14","","14");
INSERT INTO t99_audittrail VALUES("174","2019-03-04 19:23:45","/simkop5/t01_nasabahadd.php","1","*** Batch insert successful ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("175","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","1","","60001");
INSERT INTO t99_audittrail VALUES("176","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","1","","2019-03-04");
INSERT INTO t99_audittrail VALUES("177","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("178","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","1","","1,2,3,4,5,6");
INSERT INTO t99_audittrail VALUES("179","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","1","","10400000");
INSERT INTO t99_audittrail VALUES("180","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","1","","10");
INSERT INTO t99_audittrail VALUES("181","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","1","","2.40");
INSERT INTO t99_audittrail VALUES("182","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","1","","0.4");
INSERT INTO t99_audittrail VALUES("183","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","1","","5");
INSERT INTO t99_audittrail VALUES("184","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","1","","1040000");
INSERT INTO t99_audittrail VALUES("185","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","1","","250000");
INSERT INTO t99_audittrail VALUES("186","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","1","","1290000");
INSERT INTO t99_audittrail VALUES("187","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","1","","");
INSERT INTO t99_audittrail VALUES("188","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","1","","500000");
INSERT INTO t99_audittrail VALUES("189","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","1","","18000");
INSERT INTO t99_audittrail VALUES("190","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","1","","1");
INSERT INTO t99_audittrail VALUES("191","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","1","","201903");
INSERT INTO t99_audittrail VALUES("192","2019-03-04 19:27:53","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","1","","1");
INSERT INTO t99_audittrail VALUES("193","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","2","","60002");
INSERT INTO t99_audittrail VALUES("194","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","2","","2019-03-01");
INSERT INTO t99_audittrail VALUES("195","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","2","","3");
INSERT INTO t99_audittrail VALUES("196","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","2","","11,12,13,14");
INSERT INTO t99_audittrail VALUES("197","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","2","","4160000");
INSERT INTO t99_audittrail VALUES("198","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","2","","6");
INSERT INTO t99_audittrail VALUES("199","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","2","","2.24");
INSERT INTO t99_audittrail VALUES("200","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","2","","0.4");
INSERT INTO t99_audittrail VALUES("201","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","2","","5");
INSERT INTO t99_audittrail VALUES("202","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","2","","694000");
INSERT INTO t99_audittrail VALUES("203","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","2","","93000");
INSERT INTO t99_audittrail VALUES("204","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","2","","787000");
INSERT INTO t99_audittrail VALUES("205","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","2","","");
INSERT INTO t99_audittrail VALUES("206","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","2","","200000");
INSERT INTO t99_audittrail VALUES("207","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","2","","18000");
INSERT INTO t99_audittrail VALUES("208","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","2","","1");
INSERT INTO t99_audittrail VALUES("209","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","2","","201903");
INSERT INTO t99_audittrail VALUES("210","2019-03-04 19:30:37","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","2","","2");
INSERT INTO t99_audittrail VALUES("211","2019-03-04 19:34:41","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("212","2019-03-14 15:22:50","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("213","2019-03-14 15:35:17","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("214","2019-04-01 11:17:35","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("215","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","1","","2019-03-30");
INSERT INTO t99_audittrail VALUES("216","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","1","","-5");
INSERT INTO t99_audittrail VALUES("217","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","1","","0");
INSERT INTO t99_audittrail VALUES("218","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","1","","0");
INSERT INTO t99_audittrail VALUES("219","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","1","","1290000");
INSERT INTO t99_audittrail VALUES("220","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","1","","1290000");
INSERT INTO t99_audittrail VALUES("221","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","1","","CB 2500000");
INSERT INTO t99_audittrail VALUES("222","2019-04-01 13:41:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","1","","201903");
INSERT INTO t99_audittrail VALUES("223","2019-04-01 13:46:51","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("224","2019-04-05 14:06:18","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("225","2019-04-09 13:43:05","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("226","2019-04-16 10:28:33","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("227","2019-04-16 11:20:14","/simkop5/t75_companyedit.php","1","U","t75_company","NoTelp","1","","-");
INSERT INTO t99_audittrail VALUES("228","2019-04-16 11:25:43","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KodeTransaksi","13","","13");
INSERT INTO t99_audittrail VALUES("229","2019-04-16 11:25:43","/simkop5/t89_rektranlist.php","1","A","t89_rektran","JenisTransaksi","13","","SHU Tahun Berjalan");
INSERT INTO t99_audittrail VALUES("230","2019-04-16 11:25:43","/simkop5/t89_rektranlist.php","1","A","t89_rektran","DebetRekening","13","","2.8000");
INSERT INTO t99_audittrail VALUES("231","2019-04-16 11:25:43","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KreditRekening","13","","2.8000");
INSERT INTO t99_audittrail VALUES("232","2019-04-16 11:25:43","/simkop5/t89_rektranlist.php","1","A","t89_rektran","id","13","","13");
INSERT INTO t99_audittrail VALUES("233","2019-04-16 14:26:55","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("234","2019-04-22 10:59:39","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("235","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Nama","4","","DHART0 DJUNAIDI");
INSERT INTO t99_audittrail VALUES("236","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Alamat","4","","TROSOBO UTAMA VII H/20 (21/5) SIDODADI TAMAN");
INSERT INTO t99_audittrail VALUES("237","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","No_Telp_Hp","4","","082.1433.14889");
INSERT INTO t99_audittrail VALUES("238","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan","4","","PT. CITRA GARDA INTERNUSA");
INSERT INTO t99_audittrail VALUES("239","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_Alamat","4","","TAMAN NAGOYA F1 NO. 55 GEDANGAN SIDOARJO");
INSERT INTO t99_audittrail VALUES("240","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Pekerjaan_No_Telp_Hp","4","","082.1430.59766");
INSERT INTO t99_audittrail VALUES("241","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Status","4","","1");
INSERT INTO t99_audittrail VALUES("242","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","Keterangan","4","","HUTANG PINJAMAN");
INSERT INTO t99_audittrail VALUES("243","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","marketing_id","4","","1");
INSERT INTO t99_audittrail VALUES("244","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t01_nasabah","id","4","","4");
INSERT INTO t99_audittrail VALUES("245","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","*** Batch insert begin ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("246","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","15","","4");
INSERT INTO t99_audittrail VALUES("247","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","15","","BUKU TABUNGAN + ATM MANDIRI");
INSERT INTO t99_audittrail VALUES("248","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","15","","");
INSERT INTO t99_audittrail VALUES("249","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","15","","");
INSERT INTO t99_audittrail VALUES("250","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","15","","");
INSERT INTO t99_audittrail VALUES("251","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","15","","");
INSERT INTO t99_audittrail VALUES("252","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","15","","");
INSERT INTO t99_audittrail VALUES("253","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","15","","");
INSERT INTO t99_audittrail VALUES("254","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","15","","15");
INSERT INTO t99_audittrail VALUES("255","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","16","","4");
INSERT INTO t99_audittrail VALUES("256","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","16","","JAMSOSTEK");
INSERT INTO t99_audittrail VALUES("257","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","16","","");
INSERT INTO t99_audittrail VALUES("258","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","16","","");
INSERT INTO t99_audittrail VALUES("259","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","16","","");
INSERT INTO t99_audittrail VALUES("260","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","16","","");
INSERT INTO t99_audittrail VALUES("261","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","16","","");
INSERT INTO t99_audittrail VALUES("262","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","16","","");
INSERT INTO t99_audittrail VALUES("263","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","16","","16");
INSERT INTO t99_audittrail VALUES("264","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","17","","4");
INSERT INTO t99_audittrail VALUES("265","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","17","","AKTA LAHIR");
INSERT INTO t99_audittrail VALUES("266","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","17","","");
INSERT INTO t99_audittrail VALUES("267","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","17","","");
INSERT INTO t99_audittrail VALUES("268","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","17","","");
INSERT INTO t99_audittrail VALUES("269","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","17","","");
INSERT INTO t99_audittrail VALUES("270","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","17","","");
INSERT INTO t99_audittrail VALUES("271","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","17","","");
INSERT INTO t99_audittrail VALUES("272","2019-04-22 13:24:05","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","17","","17");
INSERT INTO t99_audittrail VALUES("273","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","18","","4");
INSERT INTO t99_audittrail VALUES("274","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","18","","IJAZAH SMP");
INSERT INTO t99_audittrail VALUES("275","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","18","","");
INSERT INTO t99_audittrail VALUES("276","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","18","","");
INSERT INTO t99_audittrail VALUES("277","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","18","","");
INSERT INTO t99_audittrail VALUES("278","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","18","","");
INSERT INTO t99_audittrail VALUES("279","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","18","","");
INSERT INTO t99_audittrail VALUES("280","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","18","","");
INSERT INTO t99_audittrail VALUES("281","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","18","","18");
INSERT INTO t99_audittrail VALUES("282","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","nasabah_id","19","","4");
INSERT INTO t99_audittrail VALUES("283","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Merk_Type","19","","2 BUKU NIKAH");
INSERT INTO t99_audittrail VALUES("284","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Rangka","19","","");
INSERT INTO t99_audittrail VALUES("285","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Mesin","19","","");
INSERT INTO t99_audittrail VALUES("286","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Warna","19","","");
INSERT INTO t99_audittrail VALUES("287","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","No_Pol","19","","");
INSERT INTO t99_audittrail VALUES("288","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Keterangan","19","","");
INSERT INTO t99_audittrail VALUES("289","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","Atas_Nama","19","","");
INSERT INTO t99_audittrail VALUES("290","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","A","t02_jaminan","id","19","","19");
INSERT INTO t99_audittrail VALUES("291","2019-04-22 13:24:06","/simkop5/t01_nasabahadd.php","1","*** Batch insert successful ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("292","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","3","","60003");
INSERT INTO t99_audittrail VALUES("293","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","3","","2019-04-22");
INSERT INTO t99_audittrail VALUES("294","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","3","","4");
INSERT INTO t99_audittrail VALUES("295","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","3","","15,16,17,18,19");
INSERT INTO t99_audittrail VALUES("296","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","3","","4160000");
INSERT INTO t99_audittrail VALUES("297","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","3","","7");
INSERT INTO t99_audittrail VALUES("298","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","3","","2.40");
INSERT INTO t99_audittrail VALUES("299","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","3","","0.4");
INSERT INTO t99_audittrail VALUES("300","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","3","","5");
INSERT INTO t99_audittrail VALUES("301","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","3","","595000");
INSERT INTO t99_audittrail VALUES("302","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","3","","100000");
INSERT INTO t99_audittrail VALUES("303","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","3","","695000");
INSERT INTO t99_audittrail VALUES("304","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","3","","");
INSERT INTO t99_audittrail VALUES("305","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","3","","200000");
INSERT INTO t99_audittrail VALUES("306","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","3","","18000");
INSERT INTO t99_audittrail VALUES("307","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","3","","1");
INSERT INTO t99_audittrail VALUES("308","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","3","","201904");
INSERT INTO t99_audittrail VALUES("309","2019-04-22 13:27:45","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","3","","3");
INSERT INTO t99_audittrail VALUES("310","2019-04-22 13:55:40","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("311","2019-04-22 14:06:28","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("312","2019-04-22 15:29:59","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("313","2019-04-22 15:36:11","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("314","2019-04-22 15:36:49","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("315","2019-04-22 15:40:26","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("316","2019-04-22 16:12:02","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("317","2019-04-23 11:31:06","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("318","2019-04-23 14:04:37","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","2","","2019-04-23");
INSERT INTO t99_audittrail VALUES("319","2019-04-23 14:04:37","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","2","0.00","1290000");
INSERT INTO t99_audittrail VALUES("320","2019-04-23 14:04:37","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","2","0.00","1290000");
INSERT INTO t99_audittrail VALUES("321","2019-04-23 14:04:37","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","2","","Denda Rp. 56,760.00");
INSERT INTO t99_audittrail VALUES("322","2019-04-23 14:04:37","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","2","","201904");
INSERT INTO t99_audittrail VALUES("323","2019-04-23 14:22:56","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("324","2019-04-24 10:17:18","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("325","2019-04-24 13:22:29","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("326","2019-04-25 13:22:38","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("327","2019-04-25 13:29:49","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("328","2019-04-25 13:34:04","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("329","2019-04-25 13:35:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","2","2019-04-23","2019-04-24");
INSERT INTO t99_audittrail VALUES("330","2019-04-25 13:35:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","2","0","-10");
INSERT INTO t99_audittrail VALUES("331","2019-04-25 13:35:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","2","Denda Rp. 56,760.00","cb 2150000");
INSERT INTO t99_audittrail VALUES("332","2019-04-25 13:48:13","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("333","2019-04-29 13:19:26","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("334","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","11","","2019-04-26");
INSERT INTO t99_audittrail VALUES("335","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","11","0","25");
INSERT INTO t99_audittrail VALUES("336","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","11","0.00","58700");
INSERT INTO t99_audittrail VALUES("337","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","11","0.00","787000");
INSERT INTO t99_audittrail VALUES("338","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","11","0.00","845700");
INSERT INTO t99_audittrail VALUES("339","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","11","","");
INSERT INTO t99_audittrail VALUES("340","2019-04-29 13:26:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","11","","201904");
INSERT INTO t99_audittrail VALUES("341","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","12","","2019-04-26");
INSERT INTO t99_audittrail VALUES("342","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","12","0","-5");
INSERT INTO t99_audittrail VALUES("343","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","12","0.00","20000");
INSERT INTO t99_audittrail VALUES("344","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","12","0.00","787000");
INSERT INTO t99_audittrail VALUES("345","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","12","0.00","807000");
INSERT INTO t99_audittrail VALUES("346","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","12","","");
INSERT INTO t99_audittrail VALUES("347","2019-04-29 13:28:55","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","12","","201904");
INSERT INTO t99_audittrail VALUES("348","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","13","","2019-04-29");
INSERT INTO t99_audittrail VALUES("349","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","13","0","-33");
INSERT INTO t99_audittrail VALUES("350","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","13","0.00","787000");
INSERT INTO t99_audittrail VALUES("351","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","13","0.00","787000");
INSERT INTO t99_audittrail VALUES("352","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","13","","");
INSERT INTO t99_audittrail VALUES("353","2019-04-29 13:36:36","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","13","","201904");
INSERT INTO t99_audittrail VALUES("354","2019-04-29 13:36:56","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","14","","2019-04-29");
INSERT INTO t99_audittrail VALUES("355","2019-04-29 13:36:56","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","14","0.00","787000");
INSERT INTO t99_audittrail VALUES("356","2019-04-29 13:36:56","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","14","0.00","787000");
INSERT INTO t99_audittrail VALUES("357","2019-04-29 13:36:56","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","14","","");
INSERT INTO t99_audittrail VALUES("358","2019-04-29 13:36:56","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","14","","201904");
INSERT INTO t99_audittrail VALUES("359","2019-04-29 13:37:21","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","15","","2019-04-29");
INSERT INTO t99_audittrail VALUES("360","2019-04-29 13:37:21","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","15","0.00","787000");
INSERT INTO t99_audittrail VALUES("361","2019-04-29 13:37:21","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","15","0.00","787000");
INSERT INTO t99_audittrail VALUES("362","2019-04-29 13:37:21","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","15","","");
INSERT INTO t99_audittrail VALUES("363","2019-04-29 13:37:21","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","15","","201904");
INSERT INTO t99_audittrail VALUES("364","2019-04-29 13:37:41","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","16","","2019-04-29");
INSERT INTO t99_audittrail VALUES("365","2019-04-29 13:37:41","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","16","0.00","787000");
INSERT INTO t99_audittrail VALUES("366","2019-04-29 13:37:41","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","16","0.00","787000");
INSERT INTO t99_audittrail VALUES("367","2019-04-29 13:37:41","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","16","","");
INSERT INTO t99_audittrail VALUES("368","2019-04-29 13:37:41","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","16","","201904");
INSERT INTO t99_audittrail VALUES("369","2019-04-29 13:38:11","/simkop5/t08_pinjamanpotonganadd.php","1","A","t08_pinjamanpotongan","Tanggal","1","","2019-04-29");
INSERT INTO t99_audittrail VALUES("370","2019-04-29 13:38:11","/simkop5/t08_pinjamanpotonganadd.php","1","A","t08_pinjamanpotongan","Keterangan","1","","POTONGAN PELUNASAN 60001");
INSERT INTO t99_audittrail VALUES("371","2019-04-29 13:38:11","/simkop5/t08_pinjamanpotonganadd.php","1","A","t08_pinjamanpotongan","Jumlah","1","","100000");
INSERT INTO t99_audittrail VALUES("372","2019-04-29 13:38:11","/simkop5/t08_pinjamanpotonganadd.php","1","A","t08_pinjamanpotongan","pinjaman_id","1","","2");
INSERT INTO t99_audittrail VALUES("373","2019-04-29 13:38:11","/simkop5/t08_pinjamanpotonganadd.php","1","A","t08_pinjamanpotongan","id","1","","1");
INSERT INTO t99_audittrail VALUES("374","2019-04-29 13:46:49","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("375","2019-04-30 10:09:43","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("376","2019-04-30 10:12:01","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","16","0","-125");
INSERT INTO t99_audittrail VALUES("377","2019-04-30 10:12:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","15","0","-94");
INSERT INTO t99_audittrail VALUES("378","2019-04-30 10:13:05","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","14","2019-04-29","2019-04-30");
INSERT INTO t99_audittrail VALUES("379","2019-04-30 10:13:05","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","14","0","-62");
INSERT INTO t99_audittrail VALUES("380","2019-04-30 10:13:34","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","14","2019-04-30","2019-04-29");
INSERT INTO t99_audittrail VALUES("381","2019-04-30 10:13:34","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","14","-62","-63");
INSERT INTO t99_audittrail VALUES("382","2019-04-30 10:30:55","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("383","2019-04-30 10:30:55","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","68","Y","N");
INSERT INTO t99_audittrail VALUES("384","2019-04-30 10:30:56","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("385","2019-04-30 10:32:01","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("386","2019-04-30 10:32:02","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","68","99","11");
INSERT INTO t99_audittrail VALUES("387","2019-04-30 10:32:02","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","68","N","Y");
INSERT INTO t99_audittrail VALUES("388","2019-04-30 10:32:02","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("389","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("390","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","Y","N");
INSERT INTO t99_audittrail VALUES("391","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","Y","N");
INSERT INTO t99_audittrail VALUES("392","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","Y","N");
INSERT INTO t99_audittrail VALUES("393","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("394","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","65","Y","N");
INSERT INTO t99_audittrail VALUES("395","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","66","Y","N");
INSERT INTO t99_audittrail VALUES("396","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","67","Y","N");
INSERT INTO t99_audittrail VALUES("397","2019-04-30 10:56:06","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("398","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("399","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","N","Y");
INSERT INTO t99_audittrail VALUES("400","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","N","Y");
INSERT INTO t99_audittrail VALUES("401","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","N","Y");
INSERT INTO t99_audittrail VALUES("402","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","N","Y");
INSERT INTO t99_audittrail VALUES("403","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","65","N","Y");
INSERT INTO t99_audittrail VALUES("404","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","66","N","Y");
INSERT INTO t99_audittrail VALUES("405","2019-04-30 10:56:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","67","N","Y");
INSERT INTO t99_audittrail VALUES("406","2019-04-30 10:56:47","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("407","2019-04-30 13:53:43","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("408","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","4","","60002B");
INSERT INTO t99_audittrail VALUES("409","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","4","","2019-04-30");
INSERT INTO t99_audittrail VALUES("410","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","4","","3");
INSERT INTO t99_audittrail VALUES("411","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","4","","11,12,13,14");
INSERT INTO t99_audittrail VALUES("412","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","4","","7280000");
INSERT INTO t99_audittrail VALUES("413","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","4","","8");
INSERT INTO t99_audittrail VALUES("414","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","4","","2.25");
INSERT INTO t99_audittrail VALUES("415","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","4","","0.40");
INSERT INTO t99_audittrail VALUES("416","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","4","","5");
INSERT INTO t99_audittrail VALUES("417","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","4","","910000");
INSERT INTO t99_audittrail VALUES("418","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","4","","164000");
INSERT INTO t99_audittrail VALUES("419","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","4","","1074000");
INSERT INTO t99_audittrail VALUES("420","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","4","","");
INSERT INTO t99_audittrail VALUES("421","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","4","","350000");
INSERT INTO t99_audittrail VALUES("422","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","4","","18000.00");
INSERT INTO t99_audittrail VALUES("423","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","4","","1");
INSERT INTO t99_audittrail VALUES("424","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","4","","201904");
INSERT INTO t99_audittrail VALUES("425","2019-04-30 14:00:42","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","4","","4");
INSERT INTO t99_audittrail VALUES("426","2019-04-30 14:26:31","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("427","2019-06-08 09:58:05","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("428","2019-06-10 20:17:44","/simkop5/login.php","admin","login","::1","","","","");



