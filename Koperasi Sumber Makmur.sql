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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t01_nasabah VALUES("1","Dodo","-","-","-","-","-","0","-","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO t02_jaminan VALUES("1","1","ATM","","","","","","");
INSERT INTO t02_jaminan VALUES("2","1","SIM A","","","","","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t03_pinjaman VALUES("1","60001","2019-04-16","1","1","10400000.00","12","2.24","0.40","3","867000.00","233000.00","1100000.00","","10000.00","6000.00","1","201904","N");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO t04_pinjamanangsurantemp VALUES("1","1","1","2019-05-16","867000.00","233000.00","1100000.00","9533000.00","2019-04-24","-22","0.00","0.00","1100000.00","1100000.00","Denda Rp. 96,800.00","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("2","1","2","2019-06-16","867000.00","233000.00","1100000.00","8666000.00","2019-04-22","-55","0.00","0.00","1100000.00","1100000.00","Denda Rp. 242,000.00","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("3","1","3","2019-07-16","867000.00","233000.00","1100000.00","7799000.00","2019-04-24","-83","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("4","1","4","2019-08-16","867000.00","233000.00","1100000.00","6932000.00","2019-04-24","-114","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("5","1","5","2019-09-16","867000.00","233000.00","1100000.00","6065000.00","2019-09-24","8","35200.00","0.00","1100000.00","1135200.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("6","1","6","2019-10-16","867000.00","233000.00","1100000.00","5198000.00","2019-10-22","6","26400.00","0.00","1100000.00","1126400.00","Denda Rp. 26,400.00","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("7","1","7","2019-11-16","867000.00","233000.00","1100000.00","4331000.00","2019-11-24","8","0.00","0.00","1100000.00","1100000.00","Denda Rp. 35,200.00","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("8","1","8","2019-12-16","867000.00","233000.00","1100000.00","3464000.00","2019-04-24","-236","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("9","1","9","2020-01-16","867000.00","233000.00","1100000.00","2597000.00","2019-04-16","-275","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("10","1","10","2020-02-16","867000.00","233000.00","1100000.00","1730000.00","2019-04-29","-293","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("11","1","11","2020-03-16","867000.00","233000.00","1100000.00","863000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("12","1","12","2020-04-16","863000.00","237000.00","1100000.00","0.00","","","","","","","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t07_marketing VALUES("1","Adi","-","-");



DROP TABLE t08_pinjamanpotongan;

CREATE TABLE `t08_pinjamanpotongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

INSERT INTO t10_jurnal VALUES("1","2019-04-16","201904","1.PINJ","1.2003","10400000.00","0.00","Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("2","2019-04-16","201904","1.PINJ","1.1003","0.00","10400000.00","Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("3","2019-04-16","201904","1.ADM","1.1003","10000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("4","2019-04-16","201904","1.ADM","5.1000","0.00","10000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("5","2019-04-16","201904","1.MAT","1.1003","6000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("6","2019-04-16","201904","1.MAT","5.4000","0.00","6000.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("7","2019-04-24","201904","1.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("8","2019-04-24","201904","1.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("9","2019-04-24","201904","1.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("10","2019-04-24","201904","1.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("11","2019-04-24","201904","1.DND","1.1003","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("12","2019-04-24","201904","1.DND","5.3000","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("13","2019-04-22","201904","2.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("14","2019-04-22","201904","2.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("15","2019-04-22","201904","2.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("16","2019-04-22","201904","2.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("17","2019-04-22","201904","2.DND","1.1003","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("18","2019-04-22","201904","2.DND","5.3000","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("19","2019-04-24","201904","3.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("20","2019-04-24","201904","3.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("21","2019-04-24","201904","3.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("22","2019-04-24","201904","3.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("23","2019-04-24","201904","3.DND","1.1003","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("24","2019-04-24","201904","3.DND","5.3000","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("25","2019-04-24","201904","4.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("26","2019-04-24","201904","4.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("27","2019-04-24","201904","4.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("28","2019-04-24","201904","4.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("29","2019-04-24","201904","4.DND","1.1003","0.00","0.00","Pendapatan Denda ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("30","2019-04-24","201904","4.DND","5.3000","0.00","0.00","Pendapatan Denda ke 4 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("31","2019-09-24","201904","5.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("32","2019-09-24","201904","5.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("33","2019-09-24","201904","5.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("34","2019-09-24","201904","5.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("35","2019-09-24","201904","5.DND","1.1003","35200.00","0.00","Pendapatan Denda ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("36","2019-09-24","201904","5.DND","5.3000","0.00","35200.00","Pendapatan Denda ke 5 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("37","2019-10-22","201904","6.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("38","2019-10-22","201904","6.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("39","2019-10-22","201904","6.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("40","2019-10-22","201904","6.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("41","2019-10-22","201904","6.DND","1.1003","26400.00","0.00","Pendapatan Denda ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("42","2019-10-22","201904","6.DND","5.3000","0.00","26400.00","Pendapatan Denda ke 6 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("43","2019-11-24","201904","7.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("44","2019-11-24","201904","7.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("45","2019-11-24","201904","7.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("46","2019-11-24","201904","7.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("47","2019-11-24","201904","7.DND","1.1003","0.00","0.00","Pendapatan Denda ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("48","2019-11-24","201904","7.DND","5.3000","0.00","0.00","Pendapatan Denda ke 7 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("49","2019-04-24","201904","8.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("50","2019-04-24","201904","8.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("51","2019-04-24","201904","8.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("52","2019-04-24","201904","8.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("53","2019-04-24","201904","8.DND","1.1003","0.00","0.00","Pendapatan Denda ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("54","2019-04-24","201904","8.DND","5.3000","0.00","0.00","Pendapatan Denda ke 8 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("61","2019-04-16","201904","9.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("62","2019-04-16","201904","9.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("63","2019-04-16","201904","9.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("64","2019-04-16","201904","9.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("65","2019-04-16","201904","9.DND","1.1003","0.00","0.00","Pendapatan Denda ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("66","2019-04-16","201904","9.DND","5.3000","0.00","0.00","Pendapatan Denda ke 9 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("67","2019-04-29","201904","10.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 10 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("68","2019-04-29","201904","10.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 10 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("69","2019-04-29","201904","10.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 10 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("70","2019-04-29","201904","10.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 10 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("71","2019-04-29","201904","10.DND","1.1003","0.00","0.00","Pendapatan Denda ke 10 No. Kontrak 60001");
INSERT INTO t10_jurnal VALUES("72","2019-04-29","201904","10.DND","5.3000","0.00","0.00","Pendapatan Denda ke 10 No. Kontrak 60001");



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
INSERT INTO t73_pinjamanlap VALUES("3","Kontrak_Tgl","N","Awal Kontrak","left","4","tanggal");
INSERT INTO t73_pinjamanlap VALUES("4","nasabah_id","N","nasabah_id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("5","jaminan_id","N","jaminan_id","left","99","none");
INSERT INTO t73_pinjamanlap VALUES("6","Pinjaman","N","Nominal","right","6","numerik");
INSERT INTO t73_pinjamanlap VALUES("7","Angsuran_Lama","N","Lama Angsur","right","7","none");
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
INSERT INTO t73_pinjamanlap VALUES("21","NasabahAlamat","N","Alamat","left","3","none");
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
INSERT INTO t73_pinjamanlap VALUES("64","AkhirKontrak","N","Akhir Kontrak","left","5","tanggal");
INSERT INTO t73_pinjamanlap VALUES("65","sudah_bayar","N","Sudah Bayar","right","8","none");
INSERT INTO t73_pinjamanlap VALUES("66","pd_Angsuran_Pokok","N","Piutang Pokok","right","9","numerik");
INSERT INTO t73_pinjamanlap VALUES("67","pd_Angsuran_Bunga","N","Piutang Bunga","right","10","numerik");
INSERT INTO t73_pinjamanlap VALUES("68","pd_Angsuran_Total","N","Total","right","99","numerik");



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




DROP TABLE t75_company;

CREATE TABLE `t75_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `NoTelp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t75_company VALUES("1","Koperasi Sumber Makmur","Sidoarjo","0318889999");



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

INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-16","1.PINJ","Pinjaman No. Kontrak 60001","10400000.00","0.00","10400000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-16","9.ANG","Pembayaran Angsuran ke 9 No. Kontrak 60001","0.00","867000.00","9533000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-22","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","0.00","867000.00","8666000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-24","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","0.00","867000.00","7799000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-24","3.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60001","0.00","867000.00","6932000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-24","4.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60001","0.00","867000.00","6065000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-24","8.ANG","Pembayaran Angsuran ke 8 No. Kontrak 60001","0.00","867000.00","5198000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-04-29","10.ANG","Pembayaran Angsuran ke 10 No. Kontrak 60001","0.00","867000.00","4331000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-09-24","5.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60001","0.00","867000.00","3464000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-10-22","6.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60001","0.00","867000.00","2597000.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2019-11-24","7.ANG","Pembayaran Angsuran ke 7 No. Kontrak 60001","0.00","867000.00","1730000.00");



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

INSERT INTO t79_jurnallap VALUES("2019-04-16","1.PINJ","Pinjaman No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","10400000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-16","1.PINJ","Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","10400000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-16","1.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","10000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-16","1.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60001","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","10000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-16","1.MAT","Pendapatan Materai Pinjaman No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","6000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-16","1.MAT","Pendapatan Materai Pinjaman No. Kontrak 60001","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","6000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.BGA","Pendapatan Bunga ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.BGA","Pendapatan Bunga ke 2 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.DND","Pendapatan Denda ke 2 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-22","2.DND","Pendapatan Denda ke 2 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.BGA","Pendapatan Bunga ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.BGA","Pendapatan Bunga ke 1 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.DND","Pendapatan Denda ke 1 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","1.DND","Pendapatan Denda ke 1 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.BGA","Pendapatan Bunga ke 3 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.BGA","Pendapatan Bunga ke 3 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.DND","Pendapatan Denda ke 3 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","3.DND","Pendapatan Denda ke 3 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.ANG","Pembayaran Angsuran ke 4 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.BGA","Pendapatan Bunga ke 4 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.BGA","Pendapatan Bunga ke 4 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.DND","Pendapatan Denda ke 4 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","4.DND","Pendapatan Denda ke 4 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.ANG","Pembayaran Angsuran ke 8 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.ANG","Pembayaran Angsuran ke 8 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.BGA","Pendapatan Bunga ke 8 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.BGA","Pendapatan Bunga ke 8 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.DND","Pendapatan Denda ke 8 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-24","8.DND","Pendapatan Denda ke 8 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.ANG","Pembayaran Angsuran ke 5 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.BGA","Pendapatan Bunga ke 5 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.BGA","Pendapatan Bunga ke 5 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.DND","Pendapatan Denda ke 5 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","35200.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-09-24","5.DND","Pendapatan Denda ke 5 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","35200.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.ANG","Pembayaran Angsuran ke 6 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.BGA","Pendapatan Bunga ke 6 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.BGA","Pendapatan Bunga ke 6 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.DND","Pendapatan Denda ke 6 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","26400.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-10-22","6.DND","Pendapatan Denda ke 6 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","26400.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.ANG","Pembayaran Angsuran ke 7 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","867000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.ANG","Pembayaran Angsuran ke 7 No. Kontrak 60001","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","867000.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.BGA","Pendapatan Bunga ke 7 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","233000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.BGA","Pendapatan Bunga ke 7 No. Kontrak 60001","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","233000.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.DND","Pendapatan Denda ke 7 No. Kontrak 60001","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-11-24","7.DND","Pendapatan Denda ke 7 No. Kontrak 60001","5.3000","PENDAPATAN DENDA","0.00","0.00");



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t85_neraca2;

CREATE TABLE `t85_neraca2` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL,
  `field04` varchar(24) DEFAULT NULL,
  `field05` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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

INSERT INTO t87_neraca VALUES("","","April 2019","","");
INSERT INTO t87_neraca VALUES("<strong>AKTIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("1.1001","KAS BANK - BCA","0.00","","");
INSERT INTO t87_neraca VALUES("1.1002","KAS BANK - MANDIRI","0.00","","");
INSERT INTO t87_neraca VALUES("1.1003","KAS BANK - BCA SURABAYA","-10,384,000.00","","");
INSERT INTO t87_neraca VALUES("1.1004","KAS BESAR","0.00","","");
INSERT INTO t87_neraca VALUES("1.1005","KAS KECIL HARIAN","0.00","","");
INSERT INTO t87_neraca VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","0.00","","");
INSERT INTO t87_neraca VALUES("1.2002","NASABAH MACET > 12 BULAN","0.00","","");
INSERT INTO t87_neraca VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","10,400,000.00","","");
INSERT INTO t87_neraca VALUES("1.2004","PIUTANG SIDOARJO","0.00","","");
INSERT INTO t87_neraca VALUES("1.2005","PIUTANG KPL 5","0.00","","");
INSERT INTO t87_neraca VALUES("1.2006","PIUTANG TROSOBO","0.00","","");
INSERT INTO t87_neraca VALUES("1.2007","PIUTANG DANIEL","0.00","","");
INSERT INTO t87_neraca VALUES("1.2008","PIUTANG ANDIK","0.00","","");
INSERT INTO t87_neraca VALUES("1.3000","PERSEDIAAN KANTOR","0.00","","");
INSERT INTO t87_neraca VALUES("1.4000","AKUMULASI PENYUSUTAN","0.00","","");
INSERT INTO t87_neraca VALUES("","","<strong>16,000.00</strong>","","");
INSERT INTO t87_neraca VALUES("","","","","");
INSERT INTO t87_neraca VALUES("<strong>PASSIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("2.1000","HUTANG PAJAJARAN","0.00","","");
INSERT INTO t87_neraca VALUES("2.2000","HUTANG DANIEL","0.00","","");
INSERT INTO t87_neraca VALUES("2.3000","TITIPAN NASABAH","0.00","","");
INSERT INTO t87_neraca VALUES("2.4000","MODAL DISETOR","0.00","","");
INSERT INTO t87_neraca VALUES("2.5000","SHU TAHUN LALU","0.00","","");
INSERT INTO t87_neraca VALUES("2.6000","SHU TAHUN","0.00","","");
INSERT INTO t87_neraca VALUES("2.7000","PEMBAGIAN SHU TAHUN","0.00","","");
INSERT INTO t87_neraca VALUES("2.8000","SHU TAHUN BERJALAN","0.00","","");
INSERT INTO t87_neraca VALUES("2.9000","SHU BULAN BERJALAN","16,000.00","","");
INSERT INTO t87_neraca VALUES("","","<strong>16,000.00</strong>","","");
INSERT INTO t87_neraca VALUES("","","","","");
INSERT INTO t87_neraca VALUES("","","<strong>0.00</strong>","","");



DROP TABLE t88_labarugi;

CREATE TABLE `t88_labarugi` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(64) DEFAULT NULL,
  `field04` varchar(64) DEFAULT NULL,
  `field05` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t88_labarugi VALUES("","","April 2019","","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","10,000.00","","");
INSERT INTO t88_labarugi VALUES("5.2000","PENDAPATAN BUNGA BANK","0.00","","");
INSERT INTO t88_labarugi VALUES("5.3000","PENDAPATAN DENDA","0.00","","");
INSERT INTO t88_labarugi VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","6,000.00","","");
INSERT INTO t88_labarugi VALUES("","","<strong>16,000.00</strong>","","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA</strong>","","","","");
INSERT INTO t88_labarugi VALUES("4.1000","BIAYA KARYAWAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.2000","BIAYA PERKANTORAN & UMUM","0.00","","");
INSERT INTO t88_labarugi VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","0.00","","");
INSERT INTO t88_labarugi VALUES("4.4000","BIAYA ADMINISTRASI BANK","0.00","","");
INSERT INTO t88_labarugi VALUES("4.5000","BIAYA PENYUSUTAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.6000","BIAYA IKLAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.7000","POTONGAN","0.00","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("6.1000","BIAYA LAIN-LAIN","0.00","","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>","","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("","","<strong>16,000.00</strong>","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
INSERT INTO t90_rektran VALUES("12","12","SHU Tahun Berjalan","2.8000");
INSERT INTO t90_rektran VALUES("13","00","Kas","1.1001");



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
INSERT INTO t91_rekening VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
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
INSERT INTO t91_rekening VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","201904");



DROP TABLE t92_periodeold;

CREATE TABLE `t92_periodeold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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

INSERT INTO t96_employees VALUES("1","","","","","0000-00-00 00:00:00","0000-00-00 00:00:00","","","","","","","","","","","0","21232f297a57a5a743894a0e4a801fc3","-1","admin","N","");



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
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=latin1;

INSERT INTO t99_audittrail VALUES("1","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","1","","60001");
INSERT INTO t99_audittrail VALUES("2","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","1","","2019-04-16");
INSERT INTO t99_audittrail VALUES("3","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("4","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","1","","1");
INSERT INTO t99_audittrail VALUES("5","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","1","","10400000");
INSERT INTO t99_audittrail VALUES("6","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","1","","12");
INSERT INTO t99_audittrail VALUES("7","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","1","","2.24");
INSERT INTO t99_audittrail VALUES("8","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","1","","0.4");
INSERT INTO t99_audittrail VALUES("9","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","1","","3");
INSERT INTO t99_audittrail VALUES("10","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","1","","867000");
INSERT INTO t99_audittrail VALUES("11","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","1","","233000");
INSERT INTO t99_audittrail VALUES("12","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","1","","1100000");
INSERT INTO t99_audittrail VALUES("13","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","1","","");
INSERT INTO t99_audittrail VALUES("14","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","1","","10000");
INSERT INTO t99_audittrail VALUES("15","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","1","","6000");
INSERT INTO t99_audittrail VALUES("16","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","1","","1");
INSERT INTO t99_audittrail VALUES("17","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","1","","201904");
INSERT INTO t99_audittrail VALUES("18","2019-04-16 15:41:44","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","1","","1");
INSERT INTO t99_audittrail VALUES("19","2019-04-22 14:00:30","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("20","2019-04-23 11:51:25","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("21","2019-04-24 09:24:25","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("22","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","1","","2019-04-24");
INSERT INTO t99_audittrail VALUES("23","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","1","","-22");
INSERT INTO t99_audittrail VALUES("24","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","1","","0");
INSERT INTO t99_audittrail VALUES("25","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","1","","0");
INSERT INTO t99_audittrail VALUES("26","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","1","","1100000");
INSERT INTO t99_audittrail VALUES("27","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","1","","1100000");
INSERT INTO t99_audittrail VALUES("28","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","1","","Denda Rp. 96,800.00");
INSERT INTO t99_audittrail VALUES("29","2019-04-24 09:26:00","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","1","","201904");
INSERT INTO t99_audittrail VALUES("30","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","2","","2019-04-22");
INSERT INTO t99_audittrail VALUES("31","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","2","","-55");
INSERT INTO t99_audittrail VALUES("32","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","2","","0");
INSERT INTO t99_audittrail VALUES("33","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","2","","0");
INSERT INTO t99_audittrail VALUES("34","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","2","","1100000");
INSERT INTO t99_audittrail VALUES("35","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","2","","1100000");
INSERT INTO t99_audittrail VALUES("36","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","2","","Denda Rp. 242,000.00");
INSERT INTO t99_audittrail VALUES("37","2019-04-24 09:26:16","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","2","","201904");
INSERT INTO t99_audittrail VALUES("38","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","3","","2019-04-24");
INSERT INTO t99_audittrail VALUES("39","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","3","","-83");
INSERT INTO t99_audittrail VALUES("40","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","3","","0");
INSERT INTO t99_audittrail VALUES("41","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","3","","0");
INSERT INTO t99_audittrail VALUES("42","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","3","","1100000");
INSERT INTO t99_audittrail VALUES("43","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","3","","1100000");
INSERT INTO t99_audittrail VALUES("44","2019-04-24 10:44:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","3","","201904");
INSERT INTO t99_audittrail VALUES("45","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","4","","2019-04-24");
INSERT INTO t99_audittrail VALUES("46","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","4","","-114");
INSERT INTO t99_audittrail VALUES("47","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","4","","0");
INSERT INTO t99_audittrail VALUES("48","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","4","","0");
INSERT INTO t99_audittrail VALUES("49","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","4","","1100000");
INSERT INTO t99_audittrail VALUES("50","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","4","","1100000");
INSERT INTO t99_audittrail VALUES("51","2019-04-24 11:11:26","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","4","","201904");
INSERT INTO t99_audittrail VALUES("52","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","5","","2019-09-24");
INSERT INTO t99_audittrail VALUES("53","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","5","","8");
INSERT INTO t99_audittrail VALUES("54","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","5","","35200");
INSERT INTO t99_audittrail VALUES("55","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","5","","0");
INSERT INTO t99_audittrail VALUES("56","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","5","","1100000");
INSERT INTO t99_audittrail VALUES("57","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","5","","1135200");
INSERT INTO t99_audittrail VALUES("58","2019-04-24 11:12:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","5","","201904");
INSERT INTO t99_audittrail VALUES("59","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","6","","2019-10-22");
INSERT INTO t99_audittrail VALUES("60","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","6","","6");
INSERT INTO t99_audittrail VALUES("61","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","6","","26400");
INSERT INTO t99_audittrail VALUES("62","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","6","","0");
INSERT INTO t99_audittrail VALUES("63","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","6","","1100000");
INSERT INTO t99_audittrail VALUES("64","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","6","","1126400");
INSERT INTO t99_audittrail VALUES("65","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","6","","Denda Rp. 26,400.00");
INSERT INTO t99_audittrail VALUES("66","2019-04-24 11:17:08","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","6","","201904");
INSERT INTO t99_audittrail VALUES("67","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","7","","2019-11-24");
INSERT INTO t99_audittrail VALUES("68","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","7","","8");
INSERT INTO t99_audittrail VALUES("69","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","7","","0");
INSERT INTO t99_audittrail VALUES("70","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","7","","0");
INSERT INTO t99_audittrail VALUES("71","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","7","","1100000");
INSERT INTO t99_audittrail VALUES("72","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","7","","1100000");
INSERT INTO t99_audittrail VALUES("73","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Keterangan","7","","Denda Rp. 35,200.00");
INSERT INTO t99_audittrail VALUES("74","2019-04-24 11:22:13","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","7","","201904");
INSERT INTO t99_audittrail VALUES("75","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","8","","2019-04-24");
INSERT INTO t99_audittrail VALUES("76","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","8","","-236");
INSERT INTO t99_audittrail VALUES("77","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","8","","0");
INSERT INTO t99_audittrail VALUES("78","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","8","","0");
INSERT INTO t99_audittrail VALUES("79","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","8","","1100000");
INSERT INTO t99_audittrail VALUES("80","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","8","","1100000");
INSERT INTO t99_audittrail VALUES("81","2019-04-24 11:22:49","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","8","","201904");
INSERT INTO t99_audittrail VALUES("82","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","9","","2019-04-17");
INSERT INTO t99_audittrail VALUES("83","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","9","","-274");
INSERT INTO t99_audittrail VALUES("84","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","9","","0");
INSERT INTO t99_audittrail VALUES("85","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","9","","0");
INSERT INTO t99_audittrail VALUES("86","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","9","","1100000");
INSERT INTO t99_audittrail VALUES("87","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","9","","1100000");
INSERT INTO t99_audittrail VALUES("88","2019-04-24 12:50:10","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","9","","201904");
INSERT INTO t99_audittrail VALUES("89","2019-04-24 12:50:53","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","9","2019-04-17","2019-04-16");
INSERT INTO t99_audittrail VALUES("90","2019-04-24 12:50:53","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","9","-274","-275");
INSERT INTO t99_audittrail VALUES("91","2019-04-25 12:05:52","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("92","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("93","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","1","","id");
INSERT INTO t99_audittrail VALUES("94","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","1","Y","N");
INSERT INTO t99_audittrail VALUES("95","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","2","","No. Kontrak");
INSERT INTO t99_audittrail VALUES("96","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","3","","Tgl. Kontrak");
INSERT INTO t99_audittrail VALUES("97","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","4","","Nasabah");
INSERT INTO t99_audittrail VALUES("98","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","5","","Jaminan");
INSERT INTO t99_audittrail VALUES("99","2019-04-25 17:12:43","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","6","","Pinjaman");
INSERT INTO t99_audittrail VALUES("100","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","7","","Lama Angsuran");
INSERT INTO t99_audittrail VALUES("101","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","8","","Bunga (%)");
INSERT INTO t99_audittrail VALUES("102","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","9","","Denda (%)");
INSERT INTO t99_audittrail VALUES("103","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","10","","Dispensasi (Hari)");
INSERT INTO t99_audittrail VALUES("104","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","11","","Pokok");
INSERT INTO t99_audittrail VALUES("105","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","12","","Bunga");
INSERT INTO t99_audittrail VALUES("106","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","13","","Total");
INSERT INTO t99_audittrail VALUES("107","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","14","","No. Referensi");
INSERT INTO t99_audittrail VALUES("108","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","15","","Administrasi");
INSERT INTO t99_audittrail VALUES("109","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","16","","Materai");
INSERT INTO t99_audittrail VALUES("110","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","17","","Marketing");
INSERT INTO t99_audittrail VALUES("111","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","18","","Periode");
INSERT INTO t99_audittrail VALUES("112","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","19","","Macet");
INSERT INTO t99_audittrail VALUES("113","2019-04-25 17:12:44","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("114","2019-04-25 17:16:42","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("115","2019-04-25 17:16:42","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("116","2019-04-25 17:39:07","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("117","2019-04-25 17:39:08","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("118","2019-04-25 17:46:33","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("119","2019-04-25 17:46:33","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("120","2019-04-25 17:47:44","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("121","2019-04-25 17:47:44","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("122","2019-04-25 17:48:03","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("123","2019-04-25 17:48:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","Y","N");
INSERT INTO t99_audittrail VALUES("124","2019-04-25 17:48:04","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("125","2019-04-25 17:53:57","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("126","2019-04-25 17:53:57","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("127","2019-04-25 17:57:32","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("128","2019-04-25 17:57:32","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("129","2019-04-25 18:02:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("130","2019-04-25 18:02:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("131","2019-04-25 18:02:59","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("132","2019-04-25 18:02:59","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","1","N","Y");
INSERT INTO t99_audittrail VALUES("133","2019-04-25 18:02:59","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","N","Y");
INSERT INTO t99_audittrail VALUES("134","2019-04-25 18:02:59","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("135","2019-04-25 18:03:20","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("136","2019-04-25 18:03:20","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("137","2019-04-25 18:04:15","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("138","2019-04-25 18:04:15","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("139","2019-04-25 18:05:28","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("140","2019-04-25 18:05:28","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("141","2019-04-25 18:07:18","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("142","2019-04-25 18:07:18","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","1","Y","N");
INSERT INTO t99_audittrail VALUES("143","2019-04-25 18:07:18","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("144","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("145","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","Y","N");
INSERT INTO t99_audittrail VALUES("146","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","Y","N");
INSERT INTO t99_audittrail VALUES("147","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("148","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","8","Y","N");
INSERT INTO t99_audittrail VALUES("149","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","9","Y","N");
INSERT INTO t99_audittrail VALUES("150","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","10","Y","N");
INSERT INTO t99_audittrail VALUES("151","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","11","Y","N");
INSERT INTO t99_audittrail VALUES("152","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","12","Y","N");
INSERT INTO t99_audittrail VALUES("153","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","13","Y","N");
INSERT INTO t99_audittrail VALUES("154","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","14","Y","N");
INSERT INTO t99_audittrail VALUES("155","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","15","Y","N");
INSERT INTO t99_audittrail VALUES("156","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","16","Y","N");
INSERT INTO t99_audittrail VALUES("157","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","17","Y","N");
INSERT INTO t99_audittrail VALUES("158","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","18","Y","N");
INSERT INTO t99_audittrail VALUES("159","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","19","Y","N");
INSERT INTO t99_audittrail VALUES("160","2019-04-25 18:08:03","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("161","2019-04-25 18:08:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("162","2019-04-25 18:08:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","N","Y");
INSERT INTO t99_audittrail VALUES("163","2019-04-25 18:08:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("164","2019-04-25 18:09:33","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("165","2019-04-25 18:09:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("166","2019-04-25 18:19:45","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("167","2019-04-25 18:19:46","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("168","2019-04-25 18:20:11","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("169","2019-04-25 18:20:11","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","4","Y","N");
INSERT INTO t99_audittrail VALUES("170","2019-04-25 18:20:11","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","5","Y","N");
INSERT INTO t99_audittrail VALUES("171","2019-04-25 18:20:11","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","N","Y");
INSERT INTO t99_audittrail VALUES("172","2019-04-25 18:20:11","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("173","2019-04-26 10:01:45","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("174","2019-04-26 10:04:13","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("175","2019-04-26 10:04:13","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","4","N","Y");
INSERT INTO t99_audittrail VALUES("176","2019-04-26 10:04:13","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("177","2019-04-26 10:11:09","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("178","2019-04-26 10:11:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","L","R");
INSERT INTO t99_audittrail VALUES("179","2019-04-26 10:11:09","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("180","2019-04-26 10:12:15","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("181","2019-04-26 10:12:15","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("182","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("183","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","1","","left");
INSERT INTO t99_audittrail VALUES("184","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","2","","left");
INSERT INTO t99_audittrail VALUES("185","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","3","","left");
INSERT INTO t99_audittrail VALUES("186","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","4","","left");
INSERT INTO t99_audittrail VALUES("187","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","5","","left");
INSERT INTO t99_audittrail VALUES("188","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","","right");
INSERT INTO t99_audittrail VALUES("189","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","7","","left");
INSERT INTO t99_audittrail VALUES("190","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","8","","left");
INSERT INTO t99_audittrail VALUES("191","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","9","","left");
INSERT INTO t99_audittrail VALUES("192","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","10","","left");
INSERT INTO t99_audittrail VALUES("193","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","11","","left");
INSERT INTO t99_audittrail VALUES("194","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","12","","left");
INSERT INTO t99_audittrail VALUES("195","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","13","","left");
INSERT INTO t99_audittrail VALUES("196","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","14","","left");
INSERT INTO t99_audittrail VALUES("197","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","15","","left");
INSERT INTO t99_audittrail VALUES("198","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","16","","left");
INSERT INTO t99_audittrail VALUES("199","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","17","","left");
INSERT INTO t99_audittrail VALUES("200","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","18","","left");
INSERT INTO t99_audittrail VALUES("201","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","19","","left");
INSERT INTO t99_audittrail VALUES("202","2019-04-26 10:18:25","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("203","2019-04-26 10:20:53","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("204","2019-04-26 10:20:53","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("205","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("206","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","1","","id");
INSERT INTO t99_audittrail VALUES("207","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","2","","No. Kontrak");
INSERT INTO t99_audittrail VALUES("208","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","3","","Tgl. Kontrak");
INSERT INTO t99_audittrail VALUES("209","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","4","","Nasabah");
INSERT INTO t99_audittrail VALUES("210","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","5","","Jaminan");
INSERT INTO t99_audittrail VALUES("211","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","6","","Pinjaman");
INSERT INTO t99_audittrail VALUES("212","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","left","right");
INSERT INTO t99_audittrail VALUES("213","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","7","","Lama Angsuran");
INSERT INTO t99_audittrail VALUES("214","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","8","","Bunga (%)");
INSERT INTO t99_audittrail VALUES("215","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","9","","Denda (%)");
INSERT INTO t99_audittrail VALUES("216","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","10","","Dispensasi (Hari)");
INSERT INTO t99_audittrail VALUES("217","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","11","","Pokok");
INSERT INTO t99_audittrail VALUES("218","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","12","","Bunga");
INSERT INTO t99_audittrail VALUES("219","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","13","","Total");
INSERT INTO t99_audittrail VALUES("220","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","14","","No. Referensi");
INSERT INTO t99_audittrail VALUES("221","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","15","","Administrasi");
INSERT INTO t99_audittrail VALUES("222","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","16","","Materai");
INSERT INTO t99_audittrail VALUES("223","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","17","","Marketing");
INSERT INTO t99_audittrail VALUES("224","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","18","","Periode");
INSERT INTO t99_audittrail VALUES("225","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","19","","Macet");
INSERT INTO t99_audittrail VALUES("226","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","20","","Nasabah");
INSERT INTO t99_audittrail VALUES("227","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","21","","Alamat");
INSERT INTO t99_audittrail VALUES("228","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","22","","No. Telp. / HP");
INSERT INTO t99_audittrail VALUES("229","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","23","","Pekerjaan");
INSERT INTO t99_audittrail VALUES("230","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","24","","Alamat Pekerjaan");
INSERT INTO t99_audittrail VALUES("231","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","25","","No. Telp. / HP Pekerjaan");
INSERT INTO t99_audittrail VALUES("232","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","26","","Status");
INSERT INTO t99_audittrail VALUES("233","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","27","","Keterangan Nasabah");
INSERT INTO t99_audittrail VALUES("234","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","28","","Merk / Tipe");
INSERT INTO t99_audittrail VALUES("235","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","29","","No. Rangka");
INSERT INTO t99_audittrail VALUES("236","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","30","","No. Mesin");
INSERT INTO t99_audittrail VALUES("237","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","31","","Warna");
INSERT INTO t99_audittrail VALUES("238","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","32","","No. Pol.");
INSERT INTO t99_audittrail VALUES("239","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","33","","Keterangan Jaminan");
INSERT INTO t99_audittrail VALUES("240","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","34","","Atas Nama");
INSERT INTO t99_audittrail VALUES("241","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","35","","Marketing");
INSERT INTO t99_audittrail VALUES("242","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","36","","Alamat");
INSERT INTO t99_audittrail VALUES("243","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","37","","No. HP");
INSERT INTO t99_audittrail VALUES("244","2019-04-26 12:46:58","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("245","2019-04-26 12:49:56","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("246","2019-04-26 12:49:56","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","N","Y");
INSERT INTO t99_audittrail VALUES("247","2019-04-26 12:49:56","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","N","Y");
INSERT INTO t99_audittrail VALUES("248","2019-04-26 12:49:56","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","N","Y");
INSERT INTO t99_audittrail VALUES("249","2019-04-26 12:49:56","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("250","2019-04-26 12:51:20","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("251","2019-04-26 12:51:20","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","N","Y");
INSERT INTO t99_audittrail VALUES("252","2019-04-26 12:51:20","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","8","N","Y");
INSERT INTO t99_audittrail VALUES("253","2019-04-26 12:51:21","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","20","N","Y");
INSERT INTO t99_audittrail VALUES("254","2019-04-26 12:51:21","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("255","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("256","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","2","No. Kontrak","Kontrak");
INSERT INTO t99_audittrail VALUES("257","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","3","Tgl. Kontrak","Awal Kontrak");
INSERT INTO t99_audittrail VALUES("258","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","6","Pinjaman","Nominal");
INSERT INTO t99_audittrail VALUES("259","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","7","Lama Angsuran","Lama Angsur");
INSERT INTO t99_audittrail VALUES("260","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("261","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","8","Y","N");
INSERT INTO t99_audittrail VALUES("262","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","20","Nasabah","Nama Anggota");
INSERT INTO t99_audittrail VALUES("263","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","21","N","Y");
INSERT INTO t99_audittrail VALUES("264","2019-04-26 12:55:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("265","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("266","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","2","0","1");
INSERT INTO t99_audittrail VALUES("267","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","4","Nasabah","nasabah_id");
INSERT INTO t99_audittrail VALUES("268","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","5","Jaminan","jaminan_id");
INSERT INTO t99_audittrail VALUES("269","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","17","Marketing","marketing_id");
INSERT INTO t99_audittrail VALUES("270","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","20","0","2");
INSERT INTO t99_audittrail VALUES("271","2019-04-26 13:00:52","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("272","2019-04-26 13:06:56","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("273","2019-04-26 13:06:57","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("274","2019-04-26 13:07:27","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("275","2019-04-26 13:07:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","21","0","3");
INSERT INTO t99_audittrail VALUES("276","2019-04-26 13:07:27","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("277","2019-04-26 13:08:04","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("278","2019-04-26 13:08:05","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","3","0","4");
INSERT INTO t99_audittrail VALUES("279","2019-04-26 13:08:05","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("280","2019-04-26 13:24:39","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("281","2019-04-26 13:24:39","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","0","5");
INSERT INTO t99_audittrail VALUES("282","2019-04-26 13:24:39","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("283","2019-04-26 13:35:20","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("284","2019-04-26 13:35:21","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","1","left","right");
INSERT INTO t99_audittrail VALUES("285","2019-04-26 13:35:21","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","Y","N");
INSERT INTO t99_audittrail VALUES("286","2019-04-26 13:35:21","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","6","none","numerik");
INSERT INTO t99_audittrail VALUES("287","2019-04-26 13:35:21","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("288","2019-04-26 13:35:55","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("289","2019-04-26 13:35:55","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","3","none","tanggal");
INSERT INTO t99_audittrail VALUES("290","2019-04-26 13:35:55","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("291","2019-04-26 13:38:00","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("292","2019-04-26 13:38:00","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","1","right","left");
INSERT INTO t99_audittrail VALUES("293","2019-04-26 13:38:01","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("294","2019-04-26 13:39:00","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("295","2019-04-26 13:39:00","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","2","N","Y");
INSERT INTO t99_audittrail VALUES("296","2019-04-26 13:39:00","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("297","2019-04-26 13:44:39","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("298","2019-04-26 13:44:39","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("299","2019-04-26 14:22:33","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("300","2019-04-26 14:32:03","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("301","2019-04-26 14:32:03","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("302","2019-04-26 15:06:23","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("303","2019-04-26 15:06:23","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","0","99");
INSERT INTO t99_audittrail VALUES("304","2019-04-26 15:06:23","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("305","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("306","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","5","6");
INSERT INTO t99_audittrail VALUES("307","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","64","Judul Kolom","Akhir Kontrak");
INSERT INTO t99_audittrail VALUES("308","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","99","5");
INSERT INTO t99_audittrail VALUES("309","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","64","none","tanggal");
INSERT INTO t99_audittrail VALUES("310","2019-04-26 15:07:06","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("311","2019-04-26 15:08:08","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("312","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","5","6");
INSERT INTO t99_audittrail VALUES("313","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","64","left","right");
INSERT INTO t99_audittrail VALUES("314","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","64","tanggal","numerik");
INSERT INTO t99_audittrail VALUES("315","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","6","Nominal","Akhir Kontrak");
INSERT INTO t99_audittrail VALUES("316","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","6","5");
INSERT INTO t99_audittrail VALUES("317","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","right","left");
INSERT INTO t99_audittrail VALUES("318","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","6","numerik","tanggal");
INSERT INTO t99_audittrail VALUES("319","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","7","99","7");
INSERT INTO t99_audittrail VALUES("320","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","N","Y");
INSERT INTO t99_audittrail VALUES("321","2019-04-26 15:08:09","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("322","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("323","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","6","Akhir Kontrak","Nominal");
INSERT INTO t99_audittrail VALUES("324","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","5","6");
INSERT INTO t99_audittrail VALUES("325","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","left","right");
INSERT INTO t99_audittrail VALUES("326","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","6","tanggal","numerik");
INSERT INTO t99_audittrail VALUES("327","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","6","5");
INSERT INTO t99_audittrail VALUES("328","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","64","right","left");
INSERT INTO t99_audittrail VALUES("329","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","64","numerik","tanggal");
INSERT INTO t99_audittrail VALUES("330","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","9","99","7");
INSERT INTO t99_audittrail VALUES("331","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","9","N","Y");
INSERT INTO t99_audittrail VALUES("332","2019-04-26 15:09:19","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("333","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("334","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","64","Akhir Kontrak","Nominal");
INSERT INTO t99_audittrail VALUES("335","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","5","6");
INSERT INTO t99_audittrail VALUES("336","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","64","left","right");
INSERT INTO t99_audittrail VALUES("337","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","64","tanggal","numerik");
INSERT INTO t99_audittrail VALUES("338","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","6","5");
INSERT INTO t99_audittrail VALUES("339","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","right","left");
INSERT INTO t99_audittrail VALUES("340","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","6","numerik","tanggal");
INSERT INTO t99_audittrail VALUES("341","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","7","7","99");
INSERT INTO t99_audittrail VALUES("342","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("343","2019-04-26 15:10:08","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("344","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("345","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","5","6");
INSERT INTO t99_audittrail VALUES("346","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","left","right");
INSERT INTO t99_audittrail VALUES("347","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","6","tanggal","numerik");
INSERT INTO t99_audittrail VALUES("348","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","6","5");
INSERT INTO t99_audittrail VALUES("349","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","64","right","left");
INSERT INTO t99_audittrail VALUES("350","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","64","numerik","tanggal");
INSERT INTO t99_audittrail VALUES("351","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","9","7","99");
INSERT INTO t99_audittrail VALUES("352","2019-04-26 15:10:34","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","9","Y","N");
INSERT INTO t99_audittrail VALUES("353","2019-04-26 15:10:35","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("354","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("355","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_caption","64","Nominal","Akhir Kontrak");
INSERT INTO t99_audittrail VALUES("356","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","5","6");
INSERT INTO t99_audittrail VALUES("357","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","6","5");
INSERT INTO t99_audittrail VALUES("358","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","right","left");
INSERT INTO t99_audittrail VALUES("359","2019-04-26 15:11:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("360","2019-04-26 15:15:48","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("361","2019-04-26 15:15:48","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("362","2019-04-26 15:16:55","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("363","2019-04-26 15:16:55","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","6","5","6");
INSERT INTO t99_audittrail VALUES("364","2019-04-26 15:16:55","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","6","left","right");
INSERT INTO t99_audittrail VALUES("365","2019-04-26 15:16:55","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","64","6","5");
INSERT INTO t99_audittrail VALUES("366","2019-04-26 15:16:55","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("367","2019-04-26 15:17:19","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("368","2019-04-26 15:17:19","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("369","2019-04-26 15:22:13","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("370","2019-04-26 15:22:13","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("371","2019-04-26 15:22:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("372","2019-04-26 15:22:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","7","99","7");
INSERT INTO t99_audittrail VALUES("373","2019-04-26 15:22:51","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","N","Y");
INSERT INTO t99_audittrail VALUES("374","2019-04-26 15:22:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("375","2019-04-26 15:23:12","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("376","2019-04-26 15:23:12","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","7","left","right");
INSERT INTO t99_audittrail VALUES("377","2019-04-26 15:23:12","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("378","2019-04-26 15:24:53","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("379","2019-04-26 15:24:53","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","12","99","8");
INSERT INTO t99_audittrail VALUES("380","2019-04-26 15:24:53","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","12","N","Y");
INSERT INTO t99_audittrail VALUES("381","2019-04-26 15:24:53","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","12","left","right");
INSERT INTO t99_audittrail VALUES("382","2019-04-26 15:24:54","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("383","2019-04-26 15:25:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("384","2019-04-26 15:25:51","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("385","2019-04-26 15:26:58","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("386","2019-04-26 15:26:59","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("387","2019-04-26 15:27:30","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("388","2019-04-26 15:27:31","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_format","12","none","numerik");
INSERT INTO t99_audittrail VALUES("389","2019-04-26 15:27:31","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("390","2019-04-27 13:43:17","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("391","2019-04-27 13:43:36","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("392","2019-04-27 13:43:37","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("393","2019-04-27 13:46:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("394","2019-04-27 13:46:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("395","2019-04-27 14:41:59","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("396","2019-04-27 14:41:59","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","12","Y","N");
INSERT INTO t99_audittrail VALUES("397","2019-04-27 14:41:59","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("398","2019-04-29 09:20:20","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("399","2019-04-29 09:20:48","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("400","2019-04-29 09:20:48","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("401","2019-04-29 10:23:23","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("402","2019-04-29 10:23:23","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","12","8","99");
INSERT INTO t99_audittrail VALUES("403","2019-04-29 10:23:23","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","65","99","8");
INSERT INTO t99_audittrail VALUES("404","2019-04-29 10:23:23","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_align","65","left","right");
INSERT INTO t99_audittrail VALUES("405","2019-04-29 10:23:23","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("406","2019-04-29 10:58:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("407","2019-04-29 10:58:24","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("408","2019-04-29 11:26:09","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("409","2019-04-29 11:26:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","67","99","10");
INSERT INTO t99_audittrail VALUES("410","2019-04-29 11:26:09","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","66","99","9");
INSERT INTO t99_audittrail VALUES("411","2019-04-29 11:26:09","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("412","2019-04-29 13:42:49","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("413","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","10","","2019-04-29");
INSERT INTO t99_audittrail VALUES("414","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","10","","-293");
INSERT INTO t99_audittrail VALUES("415","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","10","","0");
INSERT INTO t99_audittrail VALUES("416","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","10","","0");
INSERT INTO t99_audittrail VALUES("417","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","10","","1100000");
INSERT INTO t99_audittrail VALUES("418","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","10","","1100000");
INSERT INTO t99_audittrail VALUES("419","2019-04-29 15:30:46","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","10","","201904");
INSERT INTO t99_audittrail VALUES("420","2019-04-29 18:38:58","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("421","2019-04-30 10:38:44","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("422","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","*** Batch update begin ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("423","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","No_Rangka","1","","");
INSERT INTO t99_audittrail VALUES("424","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","No_Mesin","1","","");
INSERT INTO t99_audittrail VALUES("425","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","Warna","1","","");
INSERT INTO t99_audittrail VALUES("426","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","No_Pol","1","","");
INSERT INTO t99_audittrail VALUES("427","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","Keterangan","1","","");
INSERT INTO t99_audittrail VALUES("428","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","U","t02_jaminan","Atas_Nama","1","","");
INSERT INTO t99_audittrail VALUES("429","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","nasabah_id","2","","1");
INSERT INTO t99_audittrail VALUES("430","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","Merk_Type","2","","SIM A");
INSERT INTO t99_audittrail VALUES("431","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","No_Rangka","2","","");
INSERT INTO t99_audittrail VALUES("432","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","No_Mesin","2","","");
INSERT INTO t99_audittrail VALUES("433","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","Warna","2","","");
INSERT INTO t99_audittrail VALUES("434","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","No_Pol","2","","");
INSERT INTO t99_audittrail VALUES("435","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","Keterangan","2","","");
INSERT INTO t99_audittrail VALUES("436","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","Atas_Nama","2","","");
INSERT INTO t99_audittrail VALUES("437","2019-04-30 10:39:12","/simkop5/t01_nasabahedit.php","1","A","t02_jaminan","id","2","","2");
INSERT INTO t99_audittrail VALUES("438","2019-04-30 10:39:13","/simkop5/t01_nasabahedit.php","1","*** Batch update successful ***","t02_jaminan","","","","");
INSERT INTO t99_audittrail VALUES("439","2019-04-30 18:55:48","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("440","2019-05-16 00:04:04","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("441","2019-05-28 02:43:07","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("442","2019-05-28 02:43:39","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("443","2019-06-10 10:34:58","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("444","2019-06-10 10:35:33","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("445","2019-06-10 12:17:03","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("446","2019-06-10 12:25:26","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("447","2019-06-10 12:25:26","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","21","Y","N");
INSERT INTO t99_audittrail VALUES("448","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","3","Y","N");
INSERT INTO t99_audittrail VALUES("449","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","64","Y","N");
INSERT INTO t99_audittrail VALUES("450","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","6","Y","N");
INSERT INTO t99_audittrail VALUES("451","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("452","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","65","Y","N");
INSERT INTO t99_audittrail VALUES("453","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","66","Y","N");
INSERT INTO t99_audittrail VALUES("454","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","67","Y","N");
INSERT INTO t99_audittrail VALUES("455","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","68","Y","N");
INSERT INTO t99_audittrail VALUES("456","2019-06-10 12:25:27","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");



