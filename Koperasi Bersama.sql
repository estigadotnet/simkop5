DROP TABLE t01_nasabah;

CREATE TABLE `t01_nasabah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telp_Hp` varchar(100) NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Pekerjaan_Alamat` text NOT NULL,
  `Pekerjaan_No_Telp_Hp` varchar(100) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 0,
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
  `No_Rangka` text DEFAULT NULL,
  `No_Mesin` text DEFAULT NULL,
  `Warna` text DEFAULT NULL,
  `No_Pol` text DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `Atas_Nama` text DEFAULT NULL,
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
  `Angsuran_Bunga_Prosen` decimal(5,2) NOT NULL DEFAULT 2.25,
  `Angsuran_Denda` decimal(5,2) NOT NULL DEFAULT 0.40,
  `Dispensasi_Denda` tinyint(4) NOT NULL DEFAULT 3,
  `Angsuran_Pokok` float(14,2) NOT NULL,
  `Angsuran_Bunga` float(14,2) NOT NULL,
  `Angsuran_Total` float(14,2) NOT NULL,
  `No_Ref` varchar(25) DEFAULT NULL,
  `Biaya_Administrasi` float(14,2) NOT NULL DEFAULT 0.00,
  `Biaya_Materai` float(14,2) NOT NULL DEFAULT 0.00,
  `marketing_id` int(11) NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `Macet` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO t03_pinjaman VALUES("1","60001","2019-03-04","1","1,2,3,4,5,6","10400000.00","10","2.40","0.40","5","1040000.00","250000.00","1290000.00","","500000.00","18000.00","1","201903","N");
INSERT INTO t03_pinjaman VALUES("2","60002","2019-03-01","3","11,12,13,14","4160000.00","6","2.24","0.40","5","694000.00","93000.00","787000.00","","200000.00","18000.00","1","201903","N");
INSERT INTO t03_pinjaman VALUES("3","60003","2019-04-22","4","15,16,17,18,19","4160000.00","7","2.40","0.40","5","595000.00","100000.00","695000.00","","200000.00","18000.00","1","201904","N");
INSERT INTO t03_pinjaman VALUES("4","60002B","2019-04-30","3","11,12,13,14","7280000.00","8","2.25","0.40","5","910000.00","164000.00","1074000.00","","350000.00","18000.00","1","201904","N");
INSERT INTO t03_pinjaman VALUES("5","60004","2019-04-30","1","1,2,3,4,5,6","10400000.00","12","2.24","0.40","3","867000.00","233000.00","1100000.00","","10000.00","6000.00","1","201904","N");
INSERT INTO t03_pinjaman VALUES("6","60005","2019-04-05","4","15,16,17,18,19","10000000.00","3","2.00","0.40","3","10000000.00","200000.00","10600000.00","","0.00","0.00","1","201904","N");



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
  `Keterangan` text DEFAULT NULL,
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
  `Keterangan` text DEFAULT NULL,
  `Periode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO t04_pinjamanangsurantemp VALUES("1","1","1","2019-04-04","1040000.00","250000.00","1290000.00","9360000.00","2019-03-30","-5","0.00","0.00","1290000.00","1290000.00","CB 2500000","201903");
INSERT INTO t04_pinjamanangsurantemp VALUES("2","1","2","2019-05-04","1040000.00","250000.00","1290000.00","8320000.00","2019-04-24","-10","0.00","0.00","1290000.00","1290000.00","cb 2150000","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("3","1","3","2019-06-04","1040000.00","250000.00","1290000.00","7280000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("4","1","4","2019-07-04","1040000.00","250000.00","1290000.00","6240000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("5","1","5","2019-08-04","1040000.00","250000.00","1290000.00","5200000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("6","1","6","2019-09-04","1040000.00","250000.00","1290000.00","4160000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("7","1","7","2019-10-04","1040000.00","250000.00","1290000.00","3120000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("8","1","8","2019-11-04","1040000.00","250000.00","1290000.00","2080000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("9","1","9","2019-12-04","1040000.00","250000.00","1290000.00","1040000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("10","1","10","2020-01-04","1040000.00","250000.00","1290000.00","0.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("11","2","1","2019-04-01","694000.00","93000.00","787000.00","3466000.00","2019-04-26","25","58700.00","0.00","787000.00","845700.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("12","2","2","2019-05-01","694000.00","93000.00","787000.00","2772000.00","2019-04-26","-5","20000.00","0.00","787000.00","807000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("13","2","3","2019-06-01","694000.00","93000.00","787000.00","2078000.00","2019-04-29","-33","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("14","2","4","2019-07-01","694000.00","93000.00","787000.00","1384000.00","2019-04-29","-63","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("15","2","5","2019-08-01","694000.00","93000.00","787000.00","690000.00","2019-04-29","-94","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("16","2","6","2019-09-01","690000.00","97000.00","787000.00","0.00","2019-04-29","-125","0.00","0.00","787000.00","787000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("17","3","1","2019-05-22","595000.00","100000.00","695000.00","3565000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("18","3","2","2019-06-22","595000.00","100000.00","695000.00","2970000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("19","3","3","2019-07-22","595000.00","100000.00","695000.00","2375000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("20","3","4","2019-08-22","595000.00","100000.00","695000.00","1780000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("21","3","5","2019-09-22","595000.00","100000.00","695000.00","1185000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("22","3","6","2019-10-22","595000.00","100000.00","695000.00","590000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("23","3","7","2019-11-22","590000.00","105000.00","695000.00","0.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("24","4","1","2019-05-30","910000.00","164000.00","1074000.00","6370000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("25","4","2","2019-06-30","910000.00","164000.00","1074000.00","5460000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("26","4","3","2019-07-30","910000.00","164000.00","1074000.00","4550000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("27","4","4","2019-08-30","910000.00","164000.00","1074000.00","3640000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("28","4","5","2019-09-30","910000.00","164000.00","1074000.00","2730000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("29","4","6","2019-10-30","910000.00","164000.00","1074000.00","1820000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("30","4","7","2019-11-30","910000.00","164000.00","1074000.00","910000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("31","4","8","2019-12-30","910000.00","164000.00","1074000.00","0.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("32","5","1","2019-05-30","867000.00","233000.00","1100000.00","9533000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("33","5","2","2019-06-30","867000.00","233000.00","1100000.00","8666000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("34","5","3","2019-07-30","867000.00","233000.00","1100000.00","7799000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("35","5","4","2019-08-30","867000.00","233000.00","1100000.00","6932000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("36","5","5","2019-09-30","867000.00","233000.00","1100000.00","6065000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("37","5","6","2019-10-30","867000.00","233000.00","1100000.00","5198000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("38","5","7","2019-11-30","867000.00","233000.00","1100000.00","4331000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("39","5","8","2019-12-30","867000.00","233000.00","1100000.00","3464000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("40","5","9","2020-01-30","867000.00","233000.00","1100000.00","2597000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("41","5","10","2020-02-29","867000.00","233000.00","1100000.00","1730000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("42","5","11","2020-03-30","867000.00","233000.00","1100000.00","863000.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("43","5","12","2020-04-30","863000.00","237000.00","1100000.00","0.00","","","","","","","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("44","6","1","2019-05-05","0.00","200000.00","200000.00","0.00","2019-04-06","-29","0.00","0.00","200000.00","200000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("45","6","2","2019-06-05","0.00","200000.00","200000.00","0.00","2019-04-06","-60","0.00","0.00","200000.00","200000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("46","6","3","2019-07-05","10000000.00","200000.00","10200000.00","0.00","2019-04-06","-90","0.00","0.00","10200000.00","10200000.00","","201904");



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
  `Keterangan` text DEFAULT NULL,
  `Masuk` float(14,2) NOT NULL DEFAULT 0.00,
  `Keluar` float(14,2) NOT NULL DEFAULT 0.00,
  `Sisa` float(14,2) NOT NULL DEFAULT 0.00,
  `Angsuran_Ke` tinyint(4) NOT NULL DEFAULT 0,
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
  `Keterangan` text DEFAULT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t08_pinjamanpotongan VALUES("1","2","2019-04-29","POTONGAN PELUNASAN 60001","100000.00");



DROP TABLE t09_jurnaltransaksi;

CREATE TABLE `t09_jurnaltransaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL ,
  `periode` varchar(35) NOT NULL DEFAULT '',
  `model` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(35) NOT NULL DEFAULT '',
  `debet` double NOT NULL DEFAULT 0,
  `credit` double NOT NULL DEFAULT 0,
  `pembayaran_` double NOT NULL DEFAULT 0,
  `bunga_` double NOT NULL DEFAULT 0,
  `denda_` double NOT NULL DEFAULT 0,
  `titipan_` double NOT NULL DEFAULT 0,
  `administrasi_` double NOT NULL DEFAULT 0,
  `modal_` double NOT NULL DEFAULT 0,
  `pinjaman_` double NOT NULL DEFAULT 0,
  `biaya_` double NOT NULL DEFAULT 0,
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
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

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
INSERT INTO t10_jurnal VALUES("93","2019-04-25","201904","2.DEPM","1.1000","5000000.00","0.00","Deposito Masuk No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("94","2019-04-25","201904","2.DEPM","2.5000","0.00","5000000.00","Deposito Masuk No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("95","2019-04-30","201904","5.PINJ","1.2003","10400000.00","0.00","Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("96","2019-04-30","201904","5.PINJ","1.1003","0.00","10400000.00","Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("97","2019-04-30","201904","5.ADM","1.1003","10000.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("98","2019-04-30","201904","5.ADM","5.1000","0.00","10000.00","Pendapatan Administrasi Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("99","2019-04-30","201904","5.MAT","1.1003","6000.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("100","2019-04-30","201904","5.MAT","5.4000","0.00","6000.00","Pendapatan Materai Pinjaman No. Kontrak 60004");
INSERT INTO t10_jurnal VALUES("101","2019-04-30","201904","2.DEPM","1.1003","20000000.00","0.00","Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("102","2019-04-30","201904","2.DEPM","2.5000","0.00","20000000.00","Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("103","2019-04-30","201904","2.ADM","1.1003","10000.00","0.00","Pendapatan Administrasi Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("104","2019-04-30","201904","2.ADM","5.5000","0.00","10000.00","Pendapatan Administrasi Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("105","2019-04-30","201904","2.MAT","1.1003","6000.00","0.00","Pendapatan Materai Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("106","2019-04-30","201904","2.MAT","5.4000","0.00","6000.00","Pendapatan Materai Deposito No. Kontrak 00002");
INSERT INTO t10_jurnal VALUES("107","2019-04-30","201904","3.DEPM","1.1003","30000000.00","0.00","Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("108","2019-04-30","201904","3.DEPM","2.5000","0.00","30000000.00","Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("109","2019-04-30","201904","3.ADM","1.1003","10000.00","0.00","Pendapatan Administrasi Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("110","2019-04-30","201904","3.ADM","5.5000","0.00","10000.00","Pendapatan Administrasi Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("111","2019-04-30","201904","3.MAT","1.1003","6000.00","0.00","Pendapatan Materai Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("112","2019-04-30","201904","3.MAT","5.4000","0.00","6000.00","Pendapatan Materai Deposito No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("113","2019-04-30","201904","7.BYRBNGDEP","4.8000","300000.00","0.00","Pembayaran Bunga ke 1 No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("114","2019-04-30","201904","7.BYRBNGDEP","1.1003","0.00","300000.00","Pembayaran Bunga ke 1 No. Kontrak 00003");
INSERT INTO t10_jurnal VALUES("115","2019-04-05","201904","6.PINJ","1.2003","10000000.00","0.00","Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("116","2019-04-05","201904","6.PINJ","1.1003","0.00","10000000.00","Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("117","2019-04-05","201904","6.ADM","1.1003","0.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("118","2019-04-05","201904","6.ADM","5.1000","0.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("119","2019-04-05","201904","6.MAT","1.1003","0.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("120","2019-04-05","201904","6.MAT","5.4000","0.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("121","2019-04-06","201904","44.ANG","1.1003","0.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("122","2019-04-06","201904","44.ANG","1.2003","0.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("123","2019-04-06","201904","44.BGA","1.1003","200000.00","0.00","Pendapatan Bunga ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("124","2019-04-06","201904","44.BGA","3.1000","0.00","200000.00","Pendapatan Bunga ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("125","2019-04-06","201904","44.DND","1.1003","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("126","2019-04-06","201904","44.DND","5.3000","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("127","2019-04-06","201904","45.ANG","1.1003","0.00","0.00","Pembayaran Angsuran ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("128","2019-04-06","201904","45.ANG","1.2003","0.00","0.00","Pembayaran Angsuran ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("129","2019-04-06","201904","45.BGA","1.1003","200000.00","0.00","Pendapatan Bunga ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("130","2019-04-06","201904","45.BGA","3.1000","0.00","200000.00","Pendapatan Bunga ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("131","2019-04-06","201904","45.DND","1.1003","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("132","2019-04-06","201904","45.DND","5.3000","0.00","0.00","Pendapatan Denda ke 2 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("133","2019-04-06","201904","46.ANG","1.1003","10000000.00","0.00","Pembayaran Angsuran ke 3 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("134","2019-04-06","201904","46.ANG","1.2003","0.00","10000000.00","Pembayaran Angsuran ke 3 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("135","2019-04-06","201904","46.BGA","1.1003","200000.00","0.00","Pendapatan Bunga ke 3 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("136","2019-04-06","201904","46.BGA","3.1000","0.00","200000.00","Pendapatan Bunga ke 3 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("137","2019-04-06","201904","46.DND","1.1003","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60005");
INSERT INTO t10_jurnal VALUES("138","2019-04-06","201904","46.DND","5.3000","0.00","0.00","Pendapatan Denda ke 3 No. Kontrak 60005");



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




DROP TABLE t20_deposito;

CREATE TABLE `t20_deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `No_Urut` varchar(10) NOT NULL,
  `Tanggal_Valuta` date NOT NULL,
  `Tanggal_Jatuh_Tempo` date NOT NULL,
  `Suku_Bunga` decimal(5,2) NOT NULL DEFAULT 0.00,
  `Jumlah_Bunga` float(14,2) NOT NULL,
  `Dikredit_Diperpanjang` enum('Dikredit','Diperpanjang') NOT NULL DEFAULT 'Dikredit',
  `Tunai_Transfer` enum('Tunai','Transfer') NOT NULL DEFAULT 'Tunai',
  `nasabah_id` int(11) NOT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `Jumlah_Deposito` float(14,2) NOT NULL DEFAULT 0.00,
  `Jumlah_Terbilang` text NOT NULL,
  `Periode` varchar(6) NOT NULL,
  `Status` enum('Keluar','Lanjut') NOT NULL DEFAULT 'Lanjut',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO t20_deposito VALUES("1","00001","2019-04-18","2019-07-18","12.00","150000.00","Diperpanjang","Transfer","1","1","15000000.00","Lima Belas  Juta  Rupiah","201904","Lanjut");
INSERT INTO t20_deposito VALUES("2","00002","2019-04-25","2019-07-25","6.00","25000.00","Diperpanjang","Transfer","1","1","5000000.00","Lima Juta  Rupiah","201904","Lanjut");



DROP TABLE t21_bank;

CREATE TABLE `t21_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nasabah_id` int(11) NOT NULL,
  `Nomor` varchar(50) NOT NULL,
  `Pemilik` varchar(50) NOT NULL,
  `Bank` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `Cabang` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t21_bank VALUES("1","1","3515112412740001","HARI HARIYANTO","BCA","SURABAYA","RUNGKUT");



DROP TABLE t22_peserta;

CREATE TABLE `t22_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text DEFAULT NULL,
  `No_Telp_Hp` varchar(100) DEFAULT NULL,
  `Pekerjaan` varchar(50) DEFAULT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t22_peserta VALUES("1","ADI HARIANTO","","","","");



DROP TABLE t23_deposito;

CREATE TABLE `t23_deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Kontrak_No` varchar(25) NOT NULL,
  `Kontrak_Tgl` date NOT NULL,
  `Kontrak_Lama` tinyint(4) NOT NULL,
  `Jatuh_Tempo_Tgl` date NOT NULL,
  `Deposito` float(14,2) NOT NULL,
  `Bunga_Suku` decimal(5,2) NOT NULL DEFAULT 12.00,
  `Bunga` float(14,2) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `No_Ref` varchar(25) DEFAULT NULL,
  `Biaya_Administrasi` float(14,2) NOT NULL DEFAULT 0.00,
  `Biaya_Materai` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) NOT NULL,
  `Kontrak_Status` enum('Ya','Selesai') NOT NULL DEFAULT 'Ya',
  `Jatuh_Tempo_Status` enum('Dikredit','Diperpanjang') NOT NULL DEFAULT 'Diperpanjang',
  `Bunga_Status` enum('Tunai','Transfer') NOT NULL DEFAULT 'Transfer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO t23_deposito VALUES("1","00001","2019-04-30","3","2019-07-30","20000000.00","12.00","200000.00","1","1","","10000.00","6000.00","201904","Ya","Diperpanjang","Transfer");
INSERT INTO t23_deposito VALUES("2","00002","2019-04-30","3","2019-07-30","20000000.00","12.00","200000.00","1","1","","10000.00","6000.00","201904","Ya","Diperpanjang","Transfer");
INSERT INTO t23_deposito VALUES("3","00003","2019-04-30","5","2019-09-30","30000000.00","12.00","300000.00","1","1","","10000.00","6000.00","201904","Ya","Diperpanjang","Transfer");



DROP TABLE t24_deposito_detail;

CREATE TABLE `t24_deposito_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deposito_id` int(11) NOT NULL,
  `Pembayaran_Ke` tinyint(4) NOT NULL DEFAULT 0,
  `Bayar_Tgl` date NOT NULL,
  `Bayar_Jumlah` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO t24_deposito_detail VALUES("1","1","1","2019-05-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("2","1","2","2019-06-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("3","1","3","2019-07-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("4","2","1","2019-05-30","200000.00","201904");
INSERT INTO t24_deposito_detail VALUES("5","2","2","2019-06-30","200000.00","201904");
INSERT INTO t24_deposito_detail VALUES("6","2","3","2019-06-30","200000.00","201904");
INSERT INTO t24_deposito_detail VALUES("7","3","1","2019-04-30","300000.00","201904");
INSERT INTO t24_deposito_detail VALUES("8","3","2","2019-06-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("9","3","3","2019-07-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("10","3","4","2019-08-30","0.00","");
INSERT INTO t24_deposito_detail VALUES("11","3","5","2019-09-30","0.00","");



DROP TABLE t71_depositolap;

CREATE TABLE `t71_depositolap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO t71_depositolap VALUES("1","Kontrak_No","Y","No. Kontrak","left","1","none");
INSERT INTO t71_depositolap VALUES("2","Kontrak_Tgl","Y","Tgl. Kontrak","left","6","tanggal");
INSERT INTO t71_depositolap VALUES("3","Kontrak_Lama","N","Lama Kontrak","right","99","none");
INSERT INTO t71_depositolap VALUES("4","Jatuh_Tempo_Tgl","Y","Tgl. Jatuh Tempo","left","7","tanggal");
INSERT INTO t71_depositolap VALUES("5","Deposito","Y","Jumlah Deposito","right","4","numerik");
INSERT INTO t71_depositolap VALUES("6","Bunga_Suku","Y","Suku Bunga","right","5","numerik");
INSERT INTO t71_depositolap VALUES("7","Bunga","Y","Jumlah Bunga","right","8","numerik");
INSERT INTO t71_depositolap VALUES("8","No_Ref","N","No. Ref.","left","8","none");
INSERT INTO t71_depositolap VALUES("9","Biaya_Administrasi","N","Bi. Adm.","right","9","numerik");
INSERT INTO t71_depositolap VALUES("10","Biaya_Materai","N","Bi. Mat.","right","10","numerik");
INSERT INTO t71_depositolap VALUES("11","Periode","N","Periode","left","11","none");
INSERT INTO t71_depositolap VALUES("12","Kontrak_Status","N","Status Kontrak","left","12","none");
INSERT INTO t71_depositolap VALUES("13","Jatuh_Tempo_Status","N","Status Jatuh Tempo","left","13","none");
INSERT INTO t71_depositolap VALUES("14","Bunga_Status","N","Status Bunga","left","14","none");
INSERT INTO t71_depositolap VALUES("15","nama","Y","Nasabah","left","2","none");
INSERT INTO t71_depositolap VALUES("16","alamat","Y","Alamat","left","3","none");
INSERT INTO t71_depositolap VALUES("17","no_telp_hp","N","No. Telp./HP","left","17","none");
INSERT INTO t71_depositolap VALUES("18","pekerjaan","N","Pekerjaan","left","18","none");
INSERT INTO t71_depositolap VALUES("19","keterangan","N","Keterangan","left","19","none");
INSERT INTO t71_depositolap VALUES("20","nomor","N","No. Rek.","left","20","none");
INSERT INTO t71_depositolap VALUES("21","pemilik","N","Pemilik Rekening","left","21","none");
INSERT INTO t71_depositolap VALUES("22","bank","N","Bank","left","22","none");
INSERT INTO t71_depositolap VALUES("23","kota","N","Kota","left","23","none");
INSERT INTO t71_depositolap VALUES("24","cabang","N","Cabang","left","24","none");



DROP TABLE t72_depositolap;

CREATE TABLE `t72_depositolap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO t72_depositolap VALUES("1","no_urut","Y","No. Kontrak","left","1","none");
INSERT INTO t72_depositolap VALUES("2","tanggal_valuta","Y","Tgl. Masuk","left","6","tanggal");
INSERT INTO t72_depositolap VALUES("3","tanggal_jatuh_tempo","Y","Tgl. Jatuh Tempo","left","7","tanggal");
INSERT INTO t72_depositolap VALUES("4","suku_bunga","Y","Bunga %","right","5","numerik");
INSERT INTO t72_depositolap VALUES("5","jumlah_bunga","Y","Bunga /bulan","right","8","numerik");
INSERT INTO t72_depositolap VALUES("6","dikredit_diperpanjang","N","Jumlah Pokok","left","99","none");
INSERT INTO t72_depositolap VALUES("7","tunai_transfer","N","Bunga","left","99","none");
INSERT INTO t72_depositolap VALUES("8","jumlah_deposito","Y","Deposito","right","4","numerik");
INSERT INTO t72_depositolap VALUES("9","jumlah_terbilang","N","Terbilang","left","99","none");
INSERT INTO t72_depositolap VALUES("10","nama","Y","Nama Nasabah","left","2","none");
INSERT INTO t72_depositolap VALUES("11","alamat","Y","Alamat","left","3","none");
INSERT INTO t72_depositolap VALUES("12","no_telp_hp","N","No. Telp./HP","left","99","none");
INSERT INTO t72_depositolap VALUES("13","pekerjaan","N","Pekerjaan","left","99","none");
INSERT INTO t72_depositolap VALUES("17","keterangan","N","Keterangan","left","99","none");
INSERT INTO t72_depositolap VALUES("18","nomor","N","Nomor Rekening","left","99","none");
INSERT INTO t72_depositolap VALUES("19","pemilik","N","Nama Pemilik Rekening","left","99","none");
INSERT INTO t72_depositolap VALUES("20","bank","N","Bank","left","99","none");
INSERT INTO t72_depositolap VALUES("21","kota","N","Kota","left","99","none");
INSERT INTO t72_depositolap VALUES("22","cabang","N","Cabang","left","99","none");
INSERT INTO t72_depositolap VALUES("26","status_deposito","N","Status Deposito","left","9","none");



DROP TABLE t73_pinjamanlap;

CREATE TABLE `t73_pinjamanlap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL,
  `field_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `field_caption` varchar(32) NOT NULL DEFAULT 'Judul Kolom',
  `field_align` enum('left','center','right') NOT NULL DEFAULT 'left',
  `field_index` tinyint(4) NOT NULL DEFAULT 0,
  `field_format` enum('none','tanggal','numerik') NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

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
INSERT INTO t73_pinjamanlap VALUES("26","Status","Y","Status","left","99","none");
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
INSERT INTO t73_pinjamanlap VALUES("69","Tanggal_Bayar","Y","Tanggal Bayar","left","99","tanggal");
INSERT INTO t73_pinjamanlap VALUES("70","umur_tunggakan","Y","Umur Tunggakan","right","12","none");



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

INSERT INTO t75_company VALUES("1","Koperasi Bersama","Sidoarjo","-");



DROP TABLE t76_neracaold;

CREATE TABLE `t76_neracaold` (
  `periode` varchar(6) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `group` bigint(20) DEFAULT NULL,
  `group_rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `id` varchar(35) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `rekening` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `saldoawal` float(14,2) NOT NULL DEFAULT 0.00,
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
  `saldoawal` float(14,2) NOT NULL DEFAULT 0.00,
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

INSERT INTO t79_jurnallap VALUES("2019-04-05","6.PINJ","Pinjaman No. Kontrak 60005","1.2003","PINJAMAN BERJANGKA & ANGSURAN","10000000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-05","6.PINJ","Pinjaman No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","10000000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-05","6.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-05","6.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60005","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-05","6.MAT","Pendapatan Materai Pinjaman No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-05","6.MAT","Pendapatan Materai Pinjaman No. Kontrak 60005","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60005","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.BGA","Pendapatan Bunga ke 1 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","200000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.BGA","Pendapatan Bunga ke 1 No. Kontrak 60005","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","200000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.DND","Pendapatan Denda ke 1 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","44.DND","Pendapatan Denda ke 1 No. Kontrak 60005","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.ANG","Pembayaran Angsuran ke 2 No. Kontrak 60005","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.BGA","Pendapatan Bunga ke 2 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","200000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.BGA","Pendapatan Bunga ke 2 No. Kontrak 60005","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","200000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.DND","Pendapatan Denda ke 2 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","45.DND","Pendapatan Denda ke 2 No. Kontrak 60005","5.3000","PENDAPATAN DENDA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","10000000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.ANG","Pembayaran Angsuran ke 3 No. Kontrak 60005","1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","10000000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.BGA","Pendapatan Bunga ke 3 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","200000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.BGA","Pendapatan Bunga ke 3 No. Kontrak 60005","3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","200000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.DND","Pendapatan Denda ke 3 No. Kontrak 60005","1.1003","KAS BANK - BCA SURABAYA","0.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-06","46.DND","Pendapatan Denda ke 3 No. Kontrak 60005","5.3000","PENDAPATAN DENDA","0.00","0.00");
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
INSERT INTO t79_jurnallap VALUES("2019-04-25","2.DEPM","Deposito Masuk No. Kontrak 00002","1.1000","KAS","5000000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-25","2.DEPM","Deposito Masuk No. Kontrak 00002","2.5000","DEPOSITO","0.00","5000000.00");
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
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.PINJ","Pinjaman No. Kontrak 60004","1.2003","PINJAMAN BERJANGKA & ANGSURAN","10400000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.PINJ","Pinjaman No. Kontrak 60004","1.1003","KAS BANK - BCA SURABAYA","0.00","10400000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60004","1.1003","KAS BANK - BCA SURABAYA","10000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.ADM","Pendapatan Administrasi Pinjaman No. Kontrak 60004","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","10000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.MAT","Pendapatan Materai Pinjaman No. Kontrak 60004","1.1003","KAS BANK - BCA SURABAYA","6000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","5.MAT","Pendapatan Materai Pinjaman No. Kontrak 60004","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","6000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.DEPM","Deposito No. Kontrak 00002","1.1003","KAS BANK - BCA SURABAYA","20000000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.DEPM","Deposito No. Kontrak 00002","2.5000","DEPOSITO","0.00","20000000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.ADM","Pendapatan Administrasi Deposito No. Kontrak 00002","1.1003","KAS BANK - BCA SURABAYA","10000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.ADM","Pendapatan Administrasi Deposito No. Kontrak 00002","5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","0.00","10000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.MAT","Pendapatan Materai Deposito No. Kontrak 00002","1.1003","KAS BANK - BCA SURABAYA","6000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","2.MAT","Pendapatan Materai Deposito No. Kontrak 00002","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","6000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.DEPM","Deposito No. Kontrak 00003","1.1003","KAS BANK - BCA SURABAYA","30000000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.DEPM","Deposito No. Kontrak 00003","2.5000","DEPOSITO","0.00","30000000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.ADM","Pendapatan Administrasi Deposito No. Kontrak 00003","1.1003","KAS BANK - BCA SURABAYA","10000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.ADM","Pendapatan Administrasi Deposito No. Kontrak 00003","5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","0.00","10000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.MAT","Pendapatan Materai Deposito No. Kontrak 00003","1.1003","KAS BANK - BCA SURABAYA","6000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","3.MAT","Pendapatan Materai Deposito No. Kontrak 00003","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","6000.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","7.BYRBNGDEP","Pembayaran Bunga ke 1 No. Kontrak 00003","4.8000","BIAYA BUNGA DEPOSITO","300000.00","0.00");
INSERT INTO t79_jurnallap VALUES("2019-04-30","7.BYRBNGDEP","Pembayaran Bunga ke 1 No. Kontrak 00003","1.1003","KAS BANK - BCA SURABAYA","0.00","300000.00");



DROP TABLE t80_rekeningold;

CREATE TABLE `t80_rekeningold` (
  `group` bigint(20) DEFAULT 0,
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT 0.00,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
INSERT INTO t89_rektran VALUES("14","14","Deposito Masuk, Deposito","1.1003","2.5000");
INSERT INTO t89_rektran VALUES("15","15","Deposito Masuk, Administrasi","1.1003","5.5000");
INSERT INTO t89_rektran VALUES("16","16","Deposito Masuk, Materai","1.1003","5.4000");
INSERT INTO t89_rektran VALUES("17","17","Bayar Bunga Deposito","4.8000","1.1003");



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
  `group` bigint(20) DEFAULT 0,
  `id` varchar(35) NOT NULL DEFAULT '',
  `rekening` varchar(90) DEFAULT '',
  `tipe` varchar(35) DEFAULT '',
  `posisi` varchar(35) DEFAULT '',
  `laporan` varchar(35) DEFAULT '',
  `status` varchar(35) DEFAULT '',
  `parent` varchar(35) DEFAULT '',
  `keterangan` tinytext DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `Saldo` float(14,2) NOT NULL DEFAULT 0.00,
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
INSERT INTO t91_rekening VALUES("2","2.5000","DEPOSITO","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
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
INSERT INTO t91_rekening VALUES("4","4.8000","BIAYA BUNGA DEPOSITO","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","700000.00","201904");
INSERT INTO t91_rekening VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t91_rekening VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","36000.00","201904");
INSERT INTO t91_rekening VALUES("4","5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
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
  `Notes` longtext DEFAULT NULL,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext DEFAULT NULL,
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
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1248 DEFAULT CHARSET=latin1;

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
INSERT INTO t99_audittrail VALUES("429","2019-06-18 17:32:32","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("430","2019-06-20 10:37:47","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("431","2019-06-20 11:02:14","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("432","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_name","69","","Tanggal_Bayar");
INSERT INTO t99_audittrail VALUES("433","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_caption","69","","Tanggal Bayar");
INSERT INTO t99_audittrail VALUES("434","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_index","69","","99");
INSERT INTO t99_audittrail VALUES("435","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_status","69","","Y");
INSERT INTO t99_audittrail VALUES("436","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_align","69","","left");
INSERT INTO t99_audittrail VALUES("437","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_format","69","","tanggal");
INSERT INTO t99_audittrail VALUES("438","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","id","69","","69");
INSERT INTO t99_audittrail VALUES("439","2019-06-20 11:02:15","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("440","2019-06-20 11:30:50","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("441","2019-06-20 11:30:50","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","69","99","12");
INSERT INTO t99_audittrail VALUES("442","2019-06-20 11:30:50","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("443","2019-06-20 11:59:16","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("444","2019-06-20 11:59:16","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("445","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("446","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_name","70","","umur_tunggakan");
INSERT INTO t99_audittrail VALUES("447","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_caption","70","","Umur Tunggakan");
INSERT INTO t99_audittrail VALUES("448","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_index","70","","99");
INSERT INTO t99_audittrail VALUES("449","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_status","70","","Y");
INSERT INTO t99_audittrail VALUES("450","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_align","70","","right");
INSERT INTO t99_audittrail VALUES("451","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","field_format","70","","none");
INSERT INTO t99_audittrail VALUES("452","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","A","t73_pinjamanlap","id","70","","70");
INSERT INTO t99_audittrail VALUES("453","2019-06-20 11:59:52","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("454","2019-06-20 12:00:34","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("455","2019-06-20 12:00:35","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","69","12","99");
INSERT INTO t99_audittrail VALUES("456","2019-06-20 12:00:35","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","69","Y","N");
INSERT INTO t99_audittrail VALUES("457","2019-06-20 12:00:35","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_index","70","99","12");
INSERT INTO t99_audittrail VALUES("458","2019-06-20 12:00:35","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("459","2019-06-20 12:07:46","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("460","2019-06-20 12:07:46","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","69","N","Y");
INSERT INTO t99_audittrail VALUES("461","2019-06-20 12:07:46","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("462","2019-06-21 11:06:49","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("463","2019-06-22 11:25:43","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("464","2019-07-12 16:15:47","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("465","2019-07-13 15:34:57","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("466","2019-07-13 15:57:09","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("467","2019-07-13 16:10:27","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("468","2019-07-13 16:38:39","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("469","2019-07-13 16:38:49","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("470","2019-07-15 18:02:17","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("471","2019-07-17 09:08:31","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("472","2019-07-17 09:38:59","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("473","2019-07-17 09:39:07","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("474","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","No_Urut","1","","00001");
INSERT INTO t99_audittrail VALUES("475","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Valuta","1","","2019-07-17");
INSERT INTO t99_audittrail VALUES("476","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Jatuh_Tempo","1","","2019-07-17");
INSERT INTO t99_audittrail VALUES("477","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","nasabah_id","1","","0");
INSERT INTO t99_audittrail VALUES("478","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Deposito","1","","20000000");
INSERT INTO t99_audittrail VALUES("479","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Terbilang","1","","Dua Puluh  Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("480","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Suku_Bunga","1","","12");
INSERT INTO t99_audittrail VALUES("481","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Bunga","1","","200000");
INSERT INTO t99_audittrail VALUES("482","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Dikredit_Diperpanjang","1","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("483","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tunai_Transfer","1","","Transfer");
INSERT INTO t99_audittrail VALUES("484","2019-07-17 15:31:57","/simkop5/t20_depositoadd.php","1","A","t20_deposito","id","1","","1");
INSERT INTO t99_audittrail VALUES("485","2019-07-17 16:10:30","/simkop5/t20_depositoedit.php","1","U","t20_deposito","nasabah_id","1","0","1");
INSERT INTO t99_audittrail VALUES("486","2019-07-17 16:20:33","/simkop5/t20_depositoedit.php","1","U","t20_deposito","nasabah_id","1","1","2");
INSERT INTO t99_audittrail VALUES("487","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","No_Urut","2","","00002");
INSERT INTO t99_audittrail VALUES("488","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Valuta","2","","2019-07-17");
INSERT INTO t99_audittrail VALUES("489","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Jatuh_Tempo","2","","2019-07-17");
INSERT INTO t99_audittrail VALUES("490","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","nasabah_id","2","","4");
INSERT INTO t99_audittrail VALUES("491","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Deposito","2","","14000000");
INSERT INTO t99_audittrail VALUES("492","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Terbilang","2","","Empat Belas  Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("493","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Suku_Bunga","2","","12");
INSERT INTO t99_audittrail VALUES("494","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Bunga","2","","140000");
INSERT INTO t99_audittrail VALUES("495","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Dikredit_Diperpanjang","2","","Dikredit");
INSERT INTO t99_audittrail VALUES("496","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tunai_Transfer","2","","Tunai");
INSERT INTO t99_audittrail VALUES("497","2019-07-17 16:23:47","/simkop5/t20_depositoadd.php","1","A","t20_deposito","id","2","","2");
INSERT INTO t99_audittrail VALUES("498","2019-07-17 16:37:23","/simkop5/t20_depositoedit.php","1","U","t20_deposito","nasabah_id","2","4","3");
INSERT INTO t99_audittrail VALUES("499","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("500","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","Nomor","1","","3515112412740001");
INSERT INTO t99_audittrail VALUES("501","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","Pemilik","1","","HARI HARIYANTO");
INSERT INTO t99_audittrail VALUES("502","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","Bank","1","","BCA");
INSERT INTO t99_audittrail VALUES("503","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","Kota","1","","SURABAYA");
INSERT INTO t99_audittrail VALUES("504","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","Cabang","1","","RUNGKUT");
INSERT INTO t99_audittrail VALUES("505","2019-07-17 17:19:02","/simkop5/t21_bankadd.php","1","A","t21_bank","id","1","","1");
INSERT INTO t99_audittrail VALUES("506","2019-07-17 17:19:35","/simkop5/t20_depositoedit.php","1","U","t20_deposito","nasabah_id","2","3","1");
INSERT INTO t99_audittrail VALUES("507","2019-07-17 17:19:35","/simkop5/t20_depositoedit.php","1","U","t20_deposito","bank_id","2","","1");
INSERT INTO t99_audittrail VALUES("508","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","*** Batch insert begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("509","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","1","","no_urut");
INSERT INTO t99_audittrail VALUES("510","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","1","","Y");
INSERT INTO t99_audittrail VALUES("511","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","1","","No. Urut");
INSERT INTO t99_audittrail VALUES("512","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","1","","left");
INSERT INTO t99_audittrail VALUES("513","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","1","","1");
INSERT INTO t99_audittrail VALUES("514","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","1","","none");
INSERT INTO t99_audittrail VALUES("515","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","1","","1");
INSERT INTO t99_audittrail VALUES("516","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","2","","tanggal_valuta");
INSERT INTO t99_audittrail VALUES("517","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","2","","Y");
INSERT INTO t99_audittrail VALUES("518","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","2","","Tgl. Valuta");
INSERT INTO t99_audittrail VALUES("519","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","2","","left");
INSERT INTO t99_audittrail VALUES("520","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","2","","2");
INSERT INTO t99_audittrail VALUES("521","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","2","","tanggal");
INSERT INTO t99_audittrail VALUES("522","2019-07-18 12:26:29","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","2","","2");
INSERT INTO t99_audittrail VALUES("523","2019-07-18 12:26:30","/simkop5/t72_depositolaplist.php","1","*** Batch insert successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("524","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("525","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","3","","tanggal_jatuh_tempo");
INSERT INTO t99_audittrail VALUES("526","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","3","","Y");
INSERT INTO t99_audittrail VALUES("527","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","3","","Tgl. Jatuh Tempo");
INSERT INTO t99_audittrail VALUES("528","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","3","","left");
INSERT INTO t99_audittrail VALUES("529","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","3","","0");
INSERT INTO t99_audittrail VALUES("530","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","3","","tanggal");
INSERT INTO t99_audittrail VALUES("531","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","3","","3");
INSERT INTO t99_audittrail VALUES("532","2019-07-18 12:28:06","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("533","2019-07-18 12:34:12","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("534","2019-07-18 12:34:12","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","3","0","3");
INSERT INTO t99_audittrail VALUES("535","2019-07-18 12:34:12","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("536","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("537","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","4","","suku_bunga");
INSERT INTO t99_audittrail VALUES("538","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","4","","Suku Bunga");
INSERT INTO t99_audittrail VALUES("539","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","4","","4");
INSERT INTO t99_audittrail VALUES("540","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","4","","Y");
INSERT INTO t99_audittrail VALUES("541","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","4","","right");
INSERT INTO t99_audittrail VALUES("542","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","4","","numerik");
INSERT INTO t99_audittrail VALUES("543","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","4","","4");
INSERT INTO t99_audittrail VALUES("544","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","5","","jumlah_bunga");
INSERT INTO t99_audittrail VALUES("545","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","5","","Jumlah Bunga");
INSERT INTO t99_audittrail VALUES("546","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","5","","5");
INSERT INTO t99_audittrail VALUES("547","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","5","","Y");
INSERT INTO t99_audittrail VALUES("548","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","5","","right");
INSERT INTO t99_audittrail VALUES("549","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","5","","numerik");
INSERT INTO t99_audittrail VALUES("550","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","5","","5");
INSERT INTO t99_audittrail VALUES("551","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","6","","dikredit_diperpanjang");
INSERT INTO t99_audittrail VALUES("552","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","6","","Jumlah Pokok");
INSERT INTO t99_audittrail VALUES("553","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","6","","6");
INSERT INTO t99_audittrail VALUES("554","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","6","","Y");
INSERT INTO t99_audittrail VALUES("555","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","6","","left");
INSERT INTO t99_audittrail VALUES("556","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","6","","none");
INSERT INTO t99_audittrail VALUES("557","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","6","","6");
INSERT INTO t99_audittrail VALUES("558","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","7","","tunai_transfer");
INSERT INTO t99_audittrail VALUES("559","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","7","","Bunga");
INSERT INTO t99_audittrail VALUES("560","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","7","","7");
INSERT INTO t99_audittrail VALUES("561","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","7","","Y");
INSERT INTO t99_audittrail VALUES("562","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","7","","left");
INSERT INTO t99_audittrail VALUES("563","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","7","","none");
INSERT INTO t99_audittrail VALUES("564","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","7","","7");
INSERT INTO t99_audittrail VALUES("565","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","8","","jumlah_deposito");
INSERT INTO t99_audittrail VALUES("566","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","8","","Jumlah Deposito");
INSERT INTO t99_audittrail VALUES("567","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","8","","8");
INSERT INTO t99_audittrail VALUES("568","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","8","","Y");
INSERT INTO t99_audittrail VALUES("569","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","8","","right");
INSERT INTO t99_audittrail VALUES("570","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","8","","numerik");
INSERT INTO t99_audittrail VALUES("571","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","8","","8");
INSERT INTO t99_audittrail VALUES("572","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","9","","jumlah_terbilang");
INSERT INTO t99_audittrail VALUES("573","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","9","","Terbilang");
INSERT INTO t99_audittrail VALUES("574","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","9","","9");
INSERT INTO t99_audittrail VALUES("575","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","9","","Y");
INSERT INTO t99_audittrail VALUES("576","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","9","","left");
INSERT INTO t99_audittrail VALUES("577","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","9","","none");
INSERT INTO t99_audittrail VALUES("578","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","9","","9");
INSERT INTO t99_audittrail VALUES("579","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","10","","nama");
INSERT INTO t99_audittrail VALUES("580","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","10","","Nasabah");
INSERT INTO t99_audittrail VALUES("581","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","10","","10");
INSERT INTO t99_audittrail VALUES("582","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","10","","Y");
INSERT INTO t99_audittrail VALUES("583","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","10","","left");
INSERT INTO t99_audittrail VALUES("584","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","10","","none");
INSERT INTO t99_audittrail VALUES("585","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","10","","10");
INSERT INTO t99_audittrail VALUES("586","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","11","","alamat");
INSERT INTO t99_audittrail VALUES("587","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","11","","Alamat");
INSERT INTO t99_audittrail VALUES("588","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","11","","11");
INSERT INTO t99_audittrail VALUES("589","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","11","","Y");
INSERT INTO t99_audittrail VALUES("590","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","11","","left");
INSERT INTO t99_audittrail VALUES("591","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","11","","none");
INSERT INTO t99_audittrail VALUES("592","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","11","","11");
INSERT INTO t99_audittrail VALUES("593","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","12","","no_telp_hp");
INSERT INTO t99_audittrail VALUES("594","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","12","","No. Telp./HP");
INSERT INTO t99_audittrail VALUES("595","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","12","","12");
INSERT INTO t99_audittrail VALUES("596","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","12","","Y");
INSERT INTO t99_audittrail VALUES("597","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","12","","left");
INSERT INTO t99_audittrail VALUES("598","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","12","","none");
INSERT INTO t99_audittrail VALUES("599","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","12","","12");
INSERT INTO t99_audittrail VALUES("600","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","13","","pekerjaan");
INSERT INTO t99_audittrail VALUES("601","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","13","","Pekerjaan");
INSERT INTO t99_audittrail VALUES("602","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","13","","13");
INSERT INTO t99_audittrail VALUES("603","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","13","","Y");
INSERT INTO t99_audittrail VALUES("604","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","13","","left");
INSERT INTO t99_audittrail VALUES("605","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","13","","none");
INSERT INTO t99_audittrail VALUES("606","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","13","","13");
INSERT INTO t99_audittrail VALUES("607","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","14","","pekerjaan_alamat");
INSERT INTO t99_audittrail VALUES("608","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","14","","Alamat Pekerjaan");
INSERT INTO t99_audittrail VALUES("609","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","14","","14");
INSERT INTO t99_audittrail VALUES("610","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","14","","Y");
INSERT INTO t99_audittrail VALUES("611","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","14","","left");
INSERT INTO t99_audittrail VALUES("612","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","14","","none");
INSERT INTO t99_audittrail VALUES("613","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","14","","14");
INSERT INTO t99_audittrail VALUES("614","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","15","","pekerjaan_no_telp_hp");
INSERT INTO t99_audittrail VALUES("615","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","15","","No. Telp./HP Pekerjaan");
INSERT INTO t99_audittrail VALUES("616","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","15","","15");
INSERT INTO t99_audittrail VALUES("617","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","15","","Y");
INSERT INTO t99_audittrail VALUES("618","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","15","","left");
INSERT INTO t99_audittrail VALUES("619","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","15","","none");
INSERT INTO t99_audittrail VALUES("620","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","15","","15");
INSERT INTO t99_audittrail VALUES("621","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","16","","status");
INSERT INTO t99_audittrail VALUES("622","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","16","","Status");
INSERT INTO t99_audittrail VALUES("623","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","16","","16");
INSERT INTO t99_audittrail VALUES("624","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","16","","Y");
INSERT INTO t99_audittrail VALUES("625","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","16","","left");
INSERT INTO t99_audittrail VALUES("626","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","16","","none");
INSERT INTO t99_audittrail VALUES("627","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","16","","16");
INSERT INTO t99_audittrail VALUES("628","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","17","","keterangan");
INSERT INTO t99_audittrail VALUES("629","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","17","","Keterangan");
INSERT INTO t99_audittrail VALUES("630","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","17","","17");
INSERT INTO t99_audittrail VALUES("631","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","17","","Y");
INSERT INTO t99_audittrail VALUES("632","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","17","","left");
INSERT INTO t99_audittrail VALUES("633","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","17","","none");
INSERT INTO t99_audittrail VALUES("634","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","17","","17");
INSERT INTO t99_audittrail VALUES("635","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","18","","nomor");
INSERT INTO t99_audittrail VALUES("636","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","18","","Nomor Rekening");
INSERT INTO t99_audittrail VALUES("637","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","18","","18");
INSERT INTO t99_audittrail VALUES("638","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","18","","Y");
INSERT INTO t99_audittrail VALUES("639","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","18","","left");
INSERT INTO t99_audittrail VALUES("640","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","18","","none");
INSERT INTO t99_audittrail VALUES("641","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","18","","18");
INSERT INTO t99_audittrail VALUES("642","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","19","","pemilik");
INSERT INTO t99_audittrail VALUES("643","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","19","","Nama Pemilik Rekening");
INSERT INTO t99_audittrail VALUES("644","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","19","","19");
INSERT INTO t99_audittrail VALUES("645","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","19","","Y");
INSERT INTO t99_audittrail VALUES("646","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","19","","left");
INSERT INTO t99_audittrail VALUES("647","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","19","","none");
INSERT INTO t99_audittrail VALUES("648","2019-07-18 13:12:36","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","19","","19");
INSERT INTO t99_audittrail VALUES("649","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","20","","bank");
INSERT INTO t99_audittrail VALUES("650","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","20","","Bank");
INSERT INTO t99_audittrail VALUES("651","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","20","","20");
INSERT INTO t99_audittrail VALUES("652","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","20","","Y");
INSERT INTO t99_audittrail VALUES("653","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","20","","left");
INSERT INTO t99_audittrail VALUES("654","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","20","","none");
INSERT INTO t99_audittrail VALUES("655","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","20","","20");
INSERT INTO t99_audittrail VALUES("656","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","21","","kota");
INSERT INTO t99_audittrail VALUES("657","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","21","","Kota");
INSERT INTO t99_audittrail VALUES("658","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","21","","21");
INSERT INTO t99_audittrail VALUES("659","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","21","","Y");
INSERT INTO t99_audittrail VALUES("660","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","21","","left");
INSERT INTO t99_audittrail VALUES("661","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","21","","none");
INSERT INTO t99_audittrail VALUES("662","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","21","","21");
INSERT INTO t99_audittrail VALUES("663","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","22","","cabang");
INSERT INTO t99_audittrail VALUES("664","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","22","","Cabang");
INSERT INTO t99_audittrail VALUES("665","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","22","","22");
INSERT INTO t99_audittrail VALUES("666","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","22","","Y");
INSERT INTO t99_audittrail VALUES("667","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","22","","left");
INSERT INTO t99_audittrail VALUES("668","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","22","","none");
INSERT INTO t99_audittrail VALUES("669","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","22","","22");
INSERT INTO t99_audittrail VALUES("670","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","23","","Marketing_Nama");
INSERT INTO t99_audittrail VALUES("671","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","23","","Marketing");
INSERT INTO t99_audittrail VALUES("672","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","23","","23");
INSERT INTO t99_audittrail VALUES("673","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","23","","Y");
INSERT INTO t99_audittrail VALUES("674","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","23","","left");
INSERT INTO t99_audittrail VALUES("675","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","23","","none");
INSERT INTO t99_audittrail VALUES("676","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","23","","23");
INSERT INTO t99_audittrail VALUES("677","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","24","","Marketing_Alamat");
INSERT INTO t99_audittrail VALUES("678","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","24","","Alamat Marketing");
INSERT INTO t99_audittrail VALUES("679","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","24","","24");
INSERT INTO t99_audittrail VALUES("680","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","24","","Y");
INSERT INTO t99_audittrail VALUES("681","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","24","","left");
INSERT INTO t99_audittrail VALUES("682","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","24","","none");
INSERT INTO t99_audittrail VALUES("683","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","24","","24");
INSERT INTO t99_audittrail VALUES("684","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","25","","Marketing_NoHP");
INSERT INTO t99_audittrail VALUES("685","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","25","","No. HP Marketing");
INSERT INTO t99_audittrail VALUES("686","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","25","","25");
INSERT INTO t99_audittrail VALUES("687","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","25","","Y");
INSERT INTO t99_audittrail VALUES("688","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","25","","left");
INSERT INTO t99_audittrail VALUES("689","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","25","","none");
INSERT INTO t99_audittrail VALUES("690","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","25","","25");
INSERT INTO t99_audittrail VALUES("691","2019-07-18 13:12:37","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("692","2019-07-18 13:12:53","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("693","2019-07-18 13:12:53","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("694","2019-07-18 13:15:41","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("695","2019-07-18 13:15:42","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("696","2019-07-18 13:16:57","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update begin ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("697","2019-07-18 13:16:57","/simkop5/t73_pinjamanlaplist.php","1","U","t73_pinjamanlap","field_status","26","N","Y");
INSERT INTO t99_audittrail VALUES("698","2019-07-18 13:16:57","/simkop5/t73_pinjamanlaplist.php","1","*** Batch update successful ***","t73_pinjamanlap","","","","");
INSERT INTO t99_audittrail VALUES("699","2019-07-18 15:02:48","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("700","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","No_Urut","1","","00001");
INSERT INTO t99_audittrail VALUES("701","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Valuta","1","","2019-07-18");
INSERT INTO t99_audittrail VALUES("702","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Jatuh_Tempo","1","","2019-07-18");
INSERT INTO t99_audittrail VALUES("703","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("704","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","bank_id","1","","1");
INSERT INTO t99_audittrail VALUES("705","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Deposito","1","","30000000");
INSERT INTO t99_audittrail VALUES("706","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Terbilang","1","","Tiga Puluh  Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("707","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Suku_Bunga","1","","12");
INSERT INTO t99_audittrail VALUES("708","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Bunga","1","","300000");
INSERT INTO t99_audittrail VALUES("709","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Dikredit_Diperpanjang","1","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("710","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tunai_Transfer","1","","Transfer");
INSERT INTO t99_audittrail VALUES("711","2019-07-18 17:11:43","/simkop5/t20_depositoadd.php","1","A","t20_deposito","id","1","","1");
INSERT INTO t99_audittrail VALUES("712","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","No_Urut","1","","00001");
INSERT INTO t99_audittrail VALUES("713","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Valuta","1","","2019-04-18");
INSERT INTO t99_audittrail VALUES("714","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Jatuh_Tempo","1","","2019-07-18");
INSERT INTO t99_audittrail VALUES("715","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("716","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","bank_id","1","","1");
INSERT INTO t99_audittrail VALUES("717","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Deposito","1","","30000000");
INSERT INTO t99_audittrail VALUES("718","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Terbilang","1","","Tiga Puluh  Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("719","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Suku_Bunga","1","","12");
INSERT INTO t99_audittrail VALUES("720","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Bunga","1","","300000");
INSERT INTO t99_audittrail VALUES("721","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Dikredit_Diperpanjang","1","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("722","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tunai_Transfer","1","","Transfer");
INSERT INTO t99_audittrail VALUES("723","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Periode","1","","201904");
INSERT INTO t99_audittrail VALUES("724","2019-07-18 17:17:41","/simkop5/t20_depositoadd.php","1","A","t20_deposito","id","1","","1");
INSERT INTO t99_audittrail VALUES("725","2019-07-18 18:37:24","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("726","2019-07-18 18:59:43","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("727","2019-07-19 10:43:12","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("728","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("729","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","12","Y","N");
INSERT INTO t99_audittrail VALUES("730","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","13","Y","N");
INSERT INTO t99_audittrail VALUES("731","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","14","Y","N");
INSERT INTO t99_audittrail VALUES("732","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","15","Y","N");
INSERT INTO t99_audittrail VALUES("733","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","16","Y","N");
INSERT INTO t99_audittrail VALUES("734","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","17","Y","N");
INSERT INTO t99_audittrail VALUES("735","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","18","Y","N");
INSERT INTO t99_audittrail VALUES("736","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","19","Y","N");
INSERT INTO t99_audittrail VALUES("737","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","20","Y","N");
INSERT INTO t99_audittrail VALUES("738","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","21","Y","N");
INSERT INTO t99_audittrail VALUES("739","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","22","Y","N");
INSERT INTO t99_audittrail VALUES("740","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","23","Y","N");
INSERT INTO t99_audittrail VALUES("741","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","24","Y","N");
INSERT INTO t99_audittrail VALUES("742","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","25","Y","N");
INSERT INTO t99_audittrail VALUES("743","2019-07-19 10:45:35","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("744","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("745","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","1","No. Urut","No. Kontrak");
INSERT INTO t99_audittrail VALUES("746","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","2","Tgl. Valuta","Tgl. Masuk");
INSERT INTO t99_audittrail VALUES("747","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","2","2","99");
INSERT INTO t99_audittrail VALUES("748","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","10","Nasabah","Nama Nasabah");
INSERT INTO t99_audittrail VALUES("749","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","10","10","2");
INSERT INTO t99_audittrail VALUES("750","2019-07-19 10:46:30","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("751","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("752","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","3","3","99");
INSERT INTO t99_audittrail VALUES("753","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","8","Jumlah Deposito","Deposito");
INSERT INTO t99_audittrail VALUES("754","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","8","8","4");
INSERT INTO t99_audittrail VALUES("755","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","11","11","3");
INSERT INTO t99_audittrail VALUES("756","2019-07-19 10:48:19","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("757","2019-07-19 10:49:05","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("758","2019-07-19 10:49:05","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","4","4","5");
INSERT INTO t99_audittrail VALUES("759","2019-07-19 10:49:05","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","5","5","99");
INSERT INTO t99_audittrail VALUES("760","2019-07-19 10:49:05","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("761","2019-07-19 10:49:41","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("762","2019-07-19 10:49:41","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","7","Y","N");
INSERT INTO t99_audittrail VALUES("763","2019-07-19 10:49:41","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","9","Y","N");
INSERT INTO t99_audittrail VALUES("764","2019-07-19 10:49:41","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("765","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("766","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","6","6","99");
INSERT INTO t99_audittrail VALUES("767","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","6","Y","N");
INSERT INTO t99_audittrail VALUES("768","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","7","7","99");
INSERT INTO t99_audittrail VALUES("769","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","9","9","99");
INSERT INTO t99_audittrail VALUES("770","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","12","12","99");
INSERT INTO t99_audittrail VALUES("771","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","13","13","99");
INSERT INTO t99_audittrail VALUES("772","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","14","14","99");
INSERT INTO t99_audittrail VALUES("773","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","15","15","99");
INSERT INTO t99_audittrail VALUES("774","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","16","16","99");
INSERT INTO t99_audittrail VALUES("775","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","17","17","99");
INSERT INTO t99_audittrail VALUES("776","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","18","18","99");
INSERT INTO t99_audittrail VALUES("777","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","19","19","99");
INSERT INTO t99_audittrail VALUES("778","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","20","20","99");
INSERT INTO t99_audittrail VALUES("779","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","21","21","99");
INSERT INTO t99_audittrail VALUES("780","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","22","22","99");
INSERT INTO t99_audittrail VALUES("781","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","23","23","99");
INSERT INTO t99_audittrail VALUES("782","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","24","24","99");
INSERT INTO t99_audittrail VALUES("783","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","25","25","99");
INSERT INTO t99_audittrail VALUES("784","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","5","99","8");
INSERT INTO t99_audittrail VALUES("785","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","3","99","7");
INSERT INTO t99_audittrail VALUES("786","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_index","2","99","6");
INSERT INTO t99_audittrail VALUES("787","2019-07-19 10:51:33","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("788","2019-07-19 10:53:12","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("789","2019-07-19 10:53:12","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","4","Suku Bunga","Bunga %");
INSERT INTO t99_audittrail VALUES("790","2019-07-19 10:53:12","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_caption","5","Jumlah Bunga","Bunga /bulan");
INSERT INTO t99_audittrail VALUES("791","2019-07-19 10:53:12","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("792","2019-07-19 11:01:58","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("793","2019-07-19 11:02:03","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("794","2019-07-19 13:22:54","/simkop5/logout.php","-1","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("795","2019-07-19 13:23:00","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("796","2019-07-19 13:32:11","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("797","2019-07-19 13:32:44","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("798","2019-07-19 15:22:11","/simkop5/t20_depositoedit.php","1","U","t20_deposito","Jumlah_Deposito","1","30000000.00","15000000");
INSERT INTO t99_audittrail VALUES("799","2019-07-19 15:22:11","/simkop5/t20_depositoedit.php","1","U","t20_deposito","Jumlah_Terbilang","1","Tiga Puluh  Juta  Rupiah","Lima Belas  Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("800","2019-07-19 15:22:11","/simkop5/t20_depositoedit.php","1","U","t20_deposito","Jumlah_Bunga","1","300000.00","150000");
INSERT INTO t99_audittrail VALUES("801","2019-07-19 15:23:07","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("802","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_name","26","","status_deposito");
INSERT INTO t99_audittrail VALUES("803","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_caption","26","","Status Deposito");
INSERT INTO t99_audittrail VALUES("804","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_index","26","","9");
INSERT INTO t99_audittrail VALUES("805","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_status","26","","Y");
INSERT INTO t99_audittrail VALUES("806","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_align","26","","left");
INSERT INTO t99_audittrail VALUES("807","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","field_format","26","","none");
INSERT INTO t99_audittrail VALUES("808","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","A","t72_depositolap","id","26","","26");
INSERT INTO t99_audittrail VALUES("809","2019-07-19 15:23:08","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("810","2019-07-19 15:23:36","/simkop5/t72_depositolaplist.php","1","*** Batch update begin ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("811","2019-07-19 15:23:36","/simkop5/t72_depositolaplist.php","1","U","t72_depositolap","field_status","26","Y","N");
INSERT INTO t99_audittrail VALUES("812","2019-07-19 15:23:36","/simkop5/t72_depositolaplist.php","1","*** Batch update successful ***","t72_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("813","2019-07-22 17:21:42","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("814","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","Nama","1","","ADI HARIANTO");
INSERT INTO t99_audittrail VALUES("815","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","Alamat","1","","");
INSERT INTO t99_audittrail VALUES("816","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","No_Telp_Hp","1","","");
INSERT INTO t99_audittrail VALUES("817","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","Pekerjaan","1","","");
INSERT INTO t99_audittrail VALUES("818","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","Keterangan","1","","");
INSERT INTO t99_audittrail VALUES("819","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","A","t22_peserta","id","1","","1");
INSERT INTO t99_audittrail VALUES("820","2019-07-22 19:08:38","/simkop5/t22_pesertaadd.php","1","*** Batch insert begin ***","t21_bank","","","","");
INSERT INTO t99_audittrail VALUES("821","2019-07-24 10:59:37","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("822","2019-07-24 11:10:28","/simkop5/t91_rekeningedit.php","1","U","t91_rekening","rekening","2.5000","SHU TAHUN LALU","DEPOSITO");
INSERT INTO t99_audittrail VALUES("823","2019-07-24 11:10:28","/simkop5/t91_rekeningedit.php","1","U","t91_rekening","keterangan","2.5000","","");
INSERT INTO t99_audittrail VALUES("824","2019-07-24 11:10:28","/simkop5/t91_rekeningedit.php","1","U","t91_rekening","status","2.5000","","");
INSERT INTO t99_audittrail VALUES("825","2019-07-24 11:11:10","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KodeTransaksi","14","","14");
INSERT INTO t99_audittrail VALUES("826","2019-07-24 11:11:10","/simkop5/t89_rektranlist.php","1","A","t89_rektran","JenisTransaksi","14","","Deposito Masuk");
INSERT INTO t99_audittrail VALUES("827","2019-07-24 11:11:10","/simkop5/t89_rektranlist.php","1","A","t89_rektran","DebetRekening","14","","1.1000");
INSERT INTO t99_audittrail VALUES("828","2019-07-24 11:11:10","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KreditRekening","14","","2.5000");
INSERT INTO t99_audittrail VALUES("829","2019-07-24 11:11:10","/simkop5/t89_rektranlist.php","1","A","t89_rektran","id","14","","14");
INSERT INTO t99_audittrail VALUES("830","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","group","4.800","","4");
INSERT INTO t99_audittrail VALUES("831","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","parent","4.800","","4");
INSERT INTO t99_audittrail VALUES("832","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","id3","4.800","","4.800");
INSERT INTO t99_audittrail VALUES("833","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","rekening","4.800","","BIAYA BUNGA DEPOSITO");
INSERT INTO t99_audittrail VALUES("834","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","keterangan","4.800","","");
INSERT INTO t99_audittrail VALUES("835","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","tipe","4.800","","DETAIL");
INSERT INTO t99_audittrail VALUES("836","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","status","4.800","","");
INSERT INTO t99_audittrail VALUES("837","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","Saldo","4.800","","0");
INSERT INTO t99_audittrail VALUES("838","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","Periode","4.800","","201904");
INSERT INTO t99_audittrail VALUES("839","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","id","4.800","","4.800");
INSERT INTO t99_audittrail VALUES("840","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","posisi","4.800","","DEBET");
INSERT INTO t99_audittrail VALUES("841","2019-07-24 11:13:06","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","laporan","4.800","","RUGI LABA");
INSERT INTO t99_audittrail VALUES("842","2019-07-25 12:53:08","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("843","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","No_Urut","2","","00002");
INSERT INTO t99_audittrail VALUES("844","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Valuta","2","","2019-04-25");
INSERT INTO t99_audittrail VALUES("845","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tanggal_Jatuh_Tempo","2","","2019-07-25");
INSERT INTO t99_audittrail VALUES("846","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","nasabah_id","2","","1");
INSERT INTO t99_audittrail VALUES("847","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","bank_id","2","","1");
INSERT INTO t99_audittrail VALUES("848","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Deposito","2","","5000000");
INSERT INTO t99_audittrail VALUES("849","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Terbilang","2","","Lima Juta  Rupiah");
INSERT INTO t99_audittrail VALUES("850","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Suku_Bunga","2","","6");
INSERT INTO t99_audittrail VALUES("851","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Jumlah_Bunga","2","","25000");
INSERT INTO t99_audittrail VALUES("852","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Dikredit_Diperpanjang","2","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("853","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Tunai_Transfer","2","","Transfer");
INSERT INTO t99_audittrail VALUES("854","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Status","2","","Lanjut");
INSERT INTO t99_audittrail VALUES("855","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","Periode","2","","201904");
INSERT INTO t99_audittrail VALUES("856","2019-07-25 17:04:21","/simkop5/t20_depositoadd.php","1","A","t20_deposito","id","2","","2");
INSERT INTO t99_audittrail VALUES("857","2019-07-27 13:21:13","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("858","2019-07-30 17:04:49","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("859","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_No","1","","00001");
INSERT INTO t99_audittrail VALUES("860","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Tgl","1","","2019-07-31");
INSERT INTO t99_audittrail VALUES("861","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Lama","1","","3");
INSERT INTO t99_audittrail VALUES("862","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Tgl","1","","2019-10-31");
INSERT INTO t99_audittrail VALUES("863","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Deposito","1","","30000000");
INSERT INTO t99_audittrail VALUES("864","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Suku","1","","12");
INSERT INTO t99_audittrail VALUES("865","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga","1","","300000");
INSERT INTO t99_audittrail VALUES("866","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("867","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","bank_id","1","","1");
INSERT INTO t99_audittrail VALUES("868","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","No_Ref","1","","");
INSERT INTO t99_audittrail VALUES("869","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Administrasi","1","","10000");
INSERT INTO t99_audittrail VALUES("870","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Materai","1","","6000");
INSERT INTO t99_audittrail VALUES("871","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Status","1","","Ya");
INSERT INTO t99_audittrail VALUES("872","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Status","1","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("873","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Status","1","","Transfer");
INSERT INTO t99_audittrail VALUES("874","2019-07-31 08:42:41","/simkop5/t23_depositoadd.php","1","A","t23_deposito","id","1","","1");
INSERT INTO t99_audittrail VALUES("875","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_No","1","","00001");
INSERT INTO t99_audittrail VALUES("876","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Tgl","1","","2019-04-30");
INSERT INTO t99_audittrail VALUES("877","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Lama","1","","3");
INSERT INTO t99_audittrail VALUES("878","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Tgl","1","","2019-07-30");
INSERT INTO t99_audittrail VALUES("879","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Deposito","1","","20000000");
INSERT INTO t99_audittrail VALUES("880","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Suku","1","","12");
INSERT INTO t99_audittrail VALUES("881","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga","1","","200000");
INSERT INTO t99_audittrail VALUES("882","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("883","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","bank_id","1","","1");
INSERT INTO t99_audittrail VALUES("884","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","No_Ref","1","","");
INSERT INTO t99_audittrail VALUES("885","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Administrasi","1","","10000");
INSERT INTO t99_audittrail VALUES("886","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Materai","1","","6000");
INSERT INTO t99_audittrail VALUES("887","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Status","1","","Ya");
INSERT INTO t99_audittrail VALUES("888","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Status","1","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("889","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Status","1","","Transfer");
INSERT INTO t99_audittrail VALUES("890","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Periode","1","","201904");
INSERT INTO t99_audittrail VALUES("891","2019-07-31 10:37:34","/simkop5/t23_depositoadd.php","1","A","t23_deposito","id","1","","1");
INSERT INTO t99_audittrail VALUES("892","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","5","","60004");
INSERT INTO t99_audittrail VALUES("893","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","5","","2019-04-30");
INSERT INTO t99_audittrail VALUES("894","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","5","","1");
INSERT INTO t99_audittrail VALUES("895","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","5","","1,2,3,4,5,6");
INSERT INTO t99_audittrail VALUES("896","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","5","","10400000");
INSERT INTO t99_audittrail VALUES("897","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","5","","12");
INSERT INTO t99_audittrail VALUES("898","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","5","","2.24");
INSERT INTO t99_audittrail VALUES("899","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","5","","0.4");
INSERT INTO t99_audittrail VALUES("900","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","5","","3");
INSERT INTO t99_audittrail VALUES("901","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","5","","867000");
INSERT INTO t99_audittrail VALUES("902","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","5","","233000");
INSERT INTO t99_audittrail VALUES("903","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","5","","1100000");
INSERT INTO t99_audittrail VALUES("904","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","5","","");
INSERT INTO t99_audittrail VALUES("905","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","5","","10000");
INSERT INTO t99_audittrail VALUES("906","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","5","","6000");
INSERT INTO t99_audittrail VALUES("907","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","5","","1");
INSERT INTO t99_audittrail VALUES("908","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","5","","201904");
INSERT INTO t99_audittrail VALUES("909","2019-07-31 11:50:25","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","5","","5");
INSERT INTO t99_audittrail VALUES("910","2019-07-31 14:50:57","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("911","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("912","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","2","","Kontrak_Tgl");
INSERT INTO t99_audittrail VALUES("913","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","2","","Tgl. Kontrak");
INSERT INTO t99_audittrail VALUES("914","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","2","","2");
INSERT INTO t99_audittrail VALUES("915","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","2","","Y");
INSERT INTO t99_audittrail VALUES("916","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","2","","left");
INSERT INTO t99_audittrail VALUES("917","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","2","","none");
INSERT INTO t99_audittrail VALUES("918","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","2","","2");
INSERT INTO t99_audittrail VALUES("919","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","3","","Kontrak_Lama");
INSERT INTO t99_audittrail VALUES("920","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","3","","Lama Kontrak");
INSERT INTO t99_audittrail VALUES("921","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","3","","3");
INSERT INTO t99_audittrail VALUES("922","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","3","","Y");
INSERT INTO t99_audittrail VALUES("923","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","3","","right");
INSERT INTO t99_audittrail VALUES("924","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","3","","none");
INSERT INTO t99_audittrail VALUES("925","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","3","","3");
INSERT INTO t99_audittrail VALUES("926","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","4","","Jatuh_Tempo_Tgl");
INSERT INTO t99_audittrail VALUES("927","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","4","","Tgl. Jatuh Tempo");
INSERT INTO t99_audittrail VALUES("928","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","4","","4");
INSERT INTO t99_audittrail VALUES("929","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","4","","Y");
INSERT INTO t99_audittrail VALUES("930","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","4","","left");
INSERT INTO t99_audittrail VALUES("931","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","4","","none");
INSERT INTO t99_audittrail VALUES("932","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","4","","4");
INSERT INTO t99_audittrail VALUES("933","2019-07-31 16:23:28","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("934","2019-07-31 16:24:53","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("935","2019-07-31 16:24:53","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_format","2","none","tanggal");
INSERT INTO t99_audittrail VALUES("936","2019-07-31 16:24:53","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_format","4","none","tanggal");
INSERT INTO t99_audittrail VALUES("937","2019-07-31 16:24:53","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("938","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("939","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","5","","Deposito");
INSERT INTO t99_audittrail VALUES("940","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","5","","Jumlah Deposito");
INSERT INTO t99_audittrail VALUES("941","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","5","","5");
INSERT INTO t99_audittrail VALUES("942","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","5","","Y");
INSERT INTO t99_audittrail VALUES("943","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","5","","right");
INSERT INTO t99_audittrail VALUES("944","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","5","","numerik");
INSERT INTO t99_audittrail VALUES("945","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","5","","5");
INSERT INTO t99_audittrail VALUES("946","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","6","","Bunga_Suku");
INSERT INTO t99_audittrail VALUES("947","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","6","","Suku Bunga");
INSERT INTO t99_audittrail VALUES("948","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","6","","6");
INSERT INTO t99_audittrail VALUES("949","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","6","","Y");
INSERT INTO t99_audittrail VALUES("950","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","6","","right");
INSERT INTO t99_audittrail VALUES("951","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","6","","numerik");
INSERT INTO t99_audittrail VALUES("952","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","6","","6");
INSERT INTO t99_audittrail VALUES("953","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","7","","Bunga");
INSERT INTO t99_audittrail VALUES("954","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","7","","Jumlah Bunga");
INSERT INTO t99_audittrail VALUES("955","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","7","","7");
INSERT INTO t99_audittrail VALUES("956","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","7","","Y");
INSERT INTO t99_audittrail VALUES("957","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","7","","right");
INSERT INTO t99_audittrail VALUES("958","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","7","","numerik");
INSERT INTO t99_audittrail VALUES("959","2019-07-31 16:26:52","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","7","","7");
INSERT INTO t99_audittrail VALUES("960","2019-07-31 16:26:53","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("961","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("962","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","8","","No_Ref");
INSERT INTO t99_audittrail VALUES("963","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","8","","No. Ref.");
INSERT INTO t99_audittrail VALUES("964","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","8","","8");
INSERT INTO t99_audittrail VALUES("965","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","8","","N");
INSERT INTO t99_audittrail VALUES("966","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","8","","left");
INSERT INTO t99_audittrail VALUES("967","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","8","","none");
INSERT INTO t99_audittrail VALUES("968","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","8","","8");
INSERT INTO t99_audittrail VALUES("969","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","9","","Biaya_Administrasi");
INSERT INTO t99_audittrail VALUES("970","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","9","","Bi. Adm.");
INSERT INTO t99_audittrail VALUES("971","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","9","","9");
INSERT INTO t99_audittrail VALUES("972","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","9","","N");
INSERT INTO t99_audittrail VALUES("973","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","9","","right");
INSERT INTO t99_audittrail VALUES("974","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","9","","numerik");
INSERT INTO t99_audittrail VALUES("975","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","9","","9");
INSERT INTO t99_audittrail VALUES("976","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","10","","Biaya_Materai");
INSERT INTO t99_audittrail VALUES("977","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","10","","Bi. Mat.");
INSERT INTO t99_audittrail VALUES("978","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","10","","10");
INSERT INTO t99_audittrail VALUES("979","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","10","","N");
INSERT INTO t99_audittrail VALUES("980","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","10","","right");
INSERT INTO t99_audittrail VALUES("981","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","10","","numerik");
INSERT INTO t99_audittrail VALUES("982","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","10","","10");
INSERT INTO t99_audittrail VALUES("983","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","11","","Periode");
INSERT INTO t99_audittrail VALUES("984","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","11","","Periode");
INSERT INTO t99_audittrail VALUES("985","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","11","","11");
INSERT INTO t99_audittrail VALUES("986","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","11","","N");
INSERT INTO t99_audittrail VALUES("987","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","11","","left");
INSERT INTO t99_audittrail VALUES("988","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","11","","none");
INSERT INTO t99_audittrail VALUES("989","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","11","","11");
INSERT INTO t99_audittrail VALUES("990","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","12","","Kontrak_Status");
INSERT INTO t99_audittrail VALUES("991","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","12","","Status Kontrak");
INSERT INTO t99_audittrail VALUES("992","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","12","","12");
INSERT INTO t99_audittrail VALUES("993","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","12","","Y");
INSERT INTO t99_audittrail VALUES("994","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","12","","left");
INSERT INTO t99_audittrail VALUES("995","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","12","","none");
INSERT INTO t99_audittrail VALUES("996","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","12","","12");
INSERT INTO t99_audittrail VALUES("997","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","13","","Jatuh_Tempo_Status");
INSERT INTO t99_audittrail VALUES("998","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","13","","Status Jatuh Tempo");
INSERT INTO t99_audittrail VALUES("999","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","13","","13");
INSERT INTO t99_audittrail VALUES("1000","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","13","","Y");
INSERT INTO t99_audittrail VALUES("1001","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","13","","left");
INSERT INTO t99_audittrail VALUES("1002","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","13","","none");
INSERT INTO t99_audittrail VALUES("1003","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","13","","13");
INSERT INTO t99_audittrail VALUES("1004","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","14","","Bunga_Status");
INSERT INTO t99_audittrail VALUES("1005","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","14","","Status Bunga");
INSERT INTO t99_audittrail VALUES("1006","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","14","","14");
INSERT INTO t99_audittrail VALUES("1007","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","14","","Y");
INSERT INTO t99_audittrail VALUES("1008","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","14","","left");
INSERT INTO t99_audittrail VALUES("1009","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","14","","none");
INSERT INTO t99_audittrail VALUES("1010","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","14","","14");
INSERT INTO t99_audittrail VALUES("1011","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","15","","nama");
INSERT INTO t99_audittrail VALUES("1012","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","15","","Nasabah");
INSERT INTO t99_audittrail VALUES("1013","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","15","","15");
INSERT INTO t99_audittrail VALUES("1014","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","15","","Y");
INSERT INTO t99_audittrail VALUES("1015","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","15","","left");
INSERT INTO t99_audittrail VALUES("1016","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","15","","none");
INSERT INTO t99_audittrail VALUES("1017","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","15","","15");
INSERT INTO t99_audittrail VALUES("1018","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","16","","alamat");
INSERT INTO t99_audittrail VALUES("1019","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","16","","Alamat");
INSERT INTO t99_audittrail VALUES("1020","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","16","","16");
INSERT INTO t99_audittrail VALUES("1021","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","16","","Y");
INSERT INTO t99_audittrail VALUES("1022","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","16","","left");
INSERT INTO t99_audittrail VALUES("1023","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","16","","none");
INSERT INTO t99_audittrail VALUES("1024","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","16","","16");
INSERT INTO t99_audittrail VALUES("1025","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","17","","no_telp_hp");
INSERT INTO t99_audittrail VALUES("1026","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","17","","No. Telp./HP");
INSERT INTO t99_audittrail VALUES("1027","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","17","","17");
INSERT INTO t99_audittrail VALUES("1028","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","17","","Y");
INSERT INTO t99_audittrail VALUES("1029","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","17","","left");
INSERT INTO t99_audittrail VALUES("1030","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","17","","none");
INSERT INTO t99_audittrail VALUES("1031","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","17","","17");
INSERT INTO t99_audittrail VALUES("1032","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","18","","pekerjaan");
INSERT INTO t99_audittrail VALUES("1033","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","18","","Pekerjaan");
INSERT INTO t99_audittrail VALUES("1034","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","18","","18");
INSERT INTO t99_audittrail VALUES("1035","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","18","","Y");
INSERT INTO t99_audittrail VALUES("1036","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","18","","left");
INSERT INTO t99_audittrail VALUES("1037","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","18","","none");
INSERT INTO t99_audittrail VALUES("1038","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","18","","18");
INSERT INTO t99_audittrail VALUES("1039","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","19","","keterangan");
INSERT INTO t99_audittrail VALUES("1040","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","19","","Keterangan");
INSERT INTO t99_audittrail VALUES("1041","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","19","","19");
INSERT INTO t99_audittrail VALUES("1042","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","19","","Y");
INSERT INTO t99_audittrail VALUES("1043","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","19","","left");
INSERT INTO t99_audittrail VALUES("1044","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","19","","none");
INSERT INTO t99_audittrail VALUES("1045","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","19","","19");
INSERT INTO t99_audittrail VALUES("1046","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","20","","nomor");
INSERT INTO t99_audittrail VALUES("1047","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","20","","No. Rek.");
INSERT INTO t99_audittrail VALUES("1048","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","20","","20");
INSERT INTO t99_audittrail VALUES("1049","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","20","","Y");
INSERT INTO t99_audittrail VALUES("1050","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","20","","left");
INSERT INTO t99_audittrail VALUES("1051","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","20","","none");
INSERT INTO t99_audittrail VALUES("1052","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","20","","20");
INSERT INTO t99_audittrail VALUES("1053","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","21","","pemilik");
INSERT INTO t99_audittrail VALUES("1054","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","21","","Pemilik Rekening");
INSERT INTO t99_audittrail VALUES("1055","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","21","","21");
INSERT INTO t99_audittrail VALUES("1056","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","21","","Y");
INSERT INTO t99_audittrail VALUES("1057","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","21","","left");
INSERT INTO t99_audittrail VALUES("1058","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","21","","none");
INSERT INTO t99_audittrail VALUES("1059","2019-07-31 16:43:27","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","21","","21");
INSERT INTO t99_audittrail VALUES("1060","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","22","","bank");
INSERT INTO t99_audittrail VALUES("1061","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","22","","Bank");
INSERT INTO t99_audittrail VALUES("1062","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","22","","22");
INSERT INTO t99_audittrail VALUES("1063","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","22","","Y");
INSERT INTO t99_audittrail VALUES("1064","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","22","","left");
INSERT INTO t99_audittrail VALUES("1065","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","22","","none");
INSERT INTO t99_audittrail VALUES("1066","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","22","","22");
INSERT INTO t99_audittrail VALUES("1067","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","23","","kota");
INSERT INTO t99_audittrail VALUES("1068","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","23","","Kota");
INSERT INTO t99_audittrail VALUES("1069","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","23","","23");
INSERT INTO t99_audittrail VALUES("1070","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","23","","Y");
INSERT INTO t99_audittrail VALUES("1071","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","23","","left");
INSERT INTO t99_audittrail VALUES("1072","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","23","","none");
INSERT INTO t99_audittrail VALUES("1073","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","23","","23");
INSERT INTO t99_audittrail VALUES("1074","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_name","24","","cabang");
INSERT INTO t99_audittrail VALUES("1075","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_caption","24","","Cabang");
INSERT INTO t99_audittrail VALUES("1076","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_index","24","","24");
INSERT INTO t99_audittrail VALUES("1077","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_status","24","","Y");
INSERT INTO t99_audittrail VALUES("1078","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_align","24","","left");
INSERT INTO t99_audittrail VALUES("1079","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","field_format","24","","none");
INSERT INTO t99_audittrail VALUES("1080","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","A","t71_depositolap","id","24","","24");
INSERT INTO t99_audittrail VALUES("1081","2019-07-31 16:43:28","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1082","2019-07-31 16:45:40","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1083","2019-07-31 16:45:40","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","16","Y","N");
INSERT INTO t99_audittrail VALUES("1084","2019-07-31 16:45:40","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","17","Y","N");
INSERT INTO t99_audittrail VALUES("1085","2019-07-31 16:45:40","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","18","Y","N");
INSERT INTO t99_audittrail VALUES("1086","2019-07-31 16:45:40","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","19","Y","N");
INSERT INTO t99_audittrail VALUES("1087","2019-07-31 16:45:41","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1088","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1089","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","21","Y","N");
INSERT INTO t99_audittrail VALUES("1090","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","22","Y","N");
INSERT INTO t99_audittrail VALUES("1091","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","23","Y","N");
INSERT INTO t99_audittrail VALUES("1092","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","24","Y","N");
INSERT INTO t99_audittrail VALUES("1093","2019-07-31 16:46:03","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1094","2019-07-31 16:47:37","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1095","2019-07-31 16:47:38","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","2","2","99");
INSERT INTO t99_audittrail VALUES("1096","2019-07-31 16:47:38","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","15","15","2");
INSERT INTO t99_audittrail VALUES("1097","2019-07-31 16:47:38","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1098","2019-07-31 16:48:27","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1099","2019-07-31 16:48:27","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","3","3","99");
INSERT INTO t99_audittrail VALUES("1100","2019-07-31 16:48:27","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","16","16","3");
INSERT INTO t99_audittrail VALUES("1101","2019-07-31 16:48:27","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","16","N","Y");
INSERT INTO t99_audittrail VALUES("1102","2019-07-31 16:48:27","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1103","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1104","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","4","4","6");
INSERT INTO t99_audittrail VALUES("1105","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","5","5","4");
INSERT INTO t99_audittrail VALUES("1106","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","6","6","5");
INSERT INTO t99_audittrail VALUES("1107","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","12","Y","N");
INSERT INTO t99_audittrail VALUES("1108","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","13","Y","N");
INSERT INTO t99_audittrail VALUES("1109","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","14","Y","N");
INSERT INTO t99_audittrail VALUES("1110","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","20","Y","N");
INSERT INTO t99_audittrail VALUES("1111","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_status","3","Y","N");
INSERT INTO t99_audittrail VALUES("1112","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","2","99","5");
INSERT INTO t99_audittrail VALUES("1113","2019-07-31 16:49:57","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1114","2019-07-31 16:50:57","/simkop5/t71_depositolaplist.php","1","*** Batch update begin ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1115","2019-07-31 16:50:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","2","5","6");
INSERT INTO t99_audittrail VALUES("1116","2019-07-31 16:50:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","4","6","7");
INSERT INTO t99_audittrail VALUES("1117","2019-07-31 16:50:57","/simkop5/t71_depositolaplist.php","1","U","t71_depositolap","field_index","7","7","8");
INSERT INTO t99_audittrail VALUES("1118","2019-07-31 16:50:57","/simkop5/t71_depositolaplist.php","1","*** Batch update successful ***","t71_depositolap","","","","");
INSERT INTO t99_audittrail VALUES("1119","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","group","5.5000","","4");
INSERT INTO t99_audittrail VALUES("1120","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","parent","5.5000","","4");
INSERT INTO t99_audittrail VALUES("1121","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","id3","5.5000","","5.5000");
INSERT INTO t99_audittrail VALUES("1122","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","rekening","5.5000","","BIAYA ADMINISTRASI DEPOSITO");
INSERT INTO t99_audittrail VALUES("1123","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","keterangan","5.5000","","");
INSERT INTO t99_audittrail VALUES("1124","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","tipe","5.5000","","DETAIL");
INSERT INTO t99_audittrail VALUES("1125","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","status","5.5000","","");
INSERT INTO t99_audittrail VALUES("1126","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","Saldo","5.5000","","0");
INSERT INTO t99_audittrail VALUES("1127","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","Periode","5.5000","","201904");
INSERT INTO t99_audittrail VALUES("1128","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","id","5.5000","","5.5000");
INSERT INTO t99_audittrail VALUES("1129","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","posisi","5.5000","","DEBET");
INSERT INTO t99_audittrail VALUES("1130","2019-07-31 17:07:13","/simkop5/t91_rekeningadd.php","1","A","t91_rekening","laporan","5.5000","","RUGI LABA");
INSERT INTO t99_audittrail VALUES("1131","2019-07-31 17:07:33","/simkop5/t91_rekeningedit.php","1","U","t91_rekening","rekening","5.5000","BIAYA ADMINISTRASI DEPOSITO","PENDAPATAN ADMINISTRASI DEPOSITO");
INSERT INTO t99_audittrail VALUES("1132","2019-07-31 17:08:05","/simkop5/t89_rektranlist.php","1","U","t89_rektran","JenisTransaksi","14","Deposito Masuk","Deposito Masuk, Jumlah Deposito");
INSERT INTO t99_audittrail VALUES("1133","2019-07-31 17:08:21","/simkop5/t89_rektranedit.php","1","U","t89_rektran","DebetRekening","14","1.1000","1.1003");
INSERT INTO t99_audittrail VALUES("1134","2019-07-31 17:10:13","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KodeTransaksi","15","","15");
INSERT INTO t99_audittrail VALUES("1135","2019-07-31 17:10:13","/simkop5/t89_rektranlist.php","1","A","t89_rektran","JenisTransaksi","15","","Deposito Masuk, Administrasi");
INSERT INTO t99_audittrail VALUES("1136","2019-07-31 17:10:13","/simkop5/t89_rektranlist.php","1","A","t89_rektran","DebetRekening","15","","1.1003");
INSERT INTO t99_audittrail VALUES("1137","2019-07-31 17:10:13","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KreditRekening","15","","5.5000");
INSERT INTO t99_audittrail VALUES("1138","2019-07-31 17:10:13","/simkop5/t89_rektranlist.php","1","A","t89_rektran","id","15","","15");
INSERT INTO t99_audittrail VALUES("1139","2019-07-31 17:10:27","/simkop5/t89_rektranlist.php","1","U","t89_rektran","JenisTransaksi","14","Deposito Masuk, Jumlah Deposito","Deposito Masuk, Deposito");
INSERT INTO t99_audittrail VALUES("1140","2019-07-31 17:11:20","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KodeTransaksi","16","","16");
INSERT INTO t99_audittrail VALUES("1141","2019-07-31 17:11:20","/simkop5/t89_rektranlist.php","1","A","t89_rektran","JenisTransaksi","16","","Deposito Masuk, Materai");
INSERT INTO t99_audittrail VALUES("1142","2019-07-31 17:11:20","/simkop5/t89_rektranlist.php","1","A","t89_rektran","DebetRekening","16","","1.1003");
INSERT INTO t99_audittrail VALUES("1143","2019-07-31 17:11:20","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KreditRekening","16","","5.4000");
INSERT INTO t99_audittrail VALUES("1144","2019-07-31 17:11:20","/simkop5/t89_rektranlist.php","1","A","t89_rektran","id","16","","16");
INSERT INTO t99_audittrail VALUES("1145","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_No","2","","00002");
INSERT INTO t99_audittrail VALUES("1146","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Tgl","2","","2019-04-30");
INSERT INTO t99_audittrail VALUES("1147","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Lama","2","","3");
INSERT INTO t99_audittrail VALUES("1148","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Tgl","2","","2019-07-30");
INSERT INTO t99_audittrail VALUES("1149","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Deposito","2","","20000000");
INSERT INTO t99_audittrail VALUES("1150","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Suku","2","","12");
INSERT INTO t99_audittrail VALUES("1151","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga","2","","200000");
INSERT INTO t99_audittrail VALUES("1152","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","nasabah_id","2","","1");
INSERT INTO t99_audittrail VALUES("1153","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","bank_id","2","","1");
INSERT INTO t99_audittrail VALUES("1154","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","No_Ref","2","","");
INSERT INTO t99_audittrail VALUES("1155","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Administrasi","2","","10000");
INSERT INTO t99_audittrail VALUES("1156","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Materai","2","","6000");
INSERT INTO t99_audittrail VALUES("1157","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Status","2","","Ya");
INSERT INTO t99_audittrail VALUES("1158","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Status","2","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("1159","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Status","2","","Transfer");
INSERT INTO t99_audittrail VALUES("1160","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Periode","2","","201904");
INSERT INTO t99_audittrail VALUES("1161","2019-07-31 18:41:55","/simkop5/t23_depositoadd.php","1","A","t23_deposito","id","2","","2");
INSERT INTO t99_audittrail VALUES("1162","2019-07-31 19:39:55","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","4","0.00","200000.00");
INSERT INTO t99_audittrail VALUES("1163","2019-07-31 19:49:00","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","4","","201904");
INSERT INTO t99_audittrail VALUES("1164","2019-07-31 20:27:49","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1165","2019-07-31 20:51:32","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","5","0.00","200000.00");
INSERT INTO t99_audittrail VALUES("1166","2019-07-31 20:51:32","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","5","","201904");
INSERT INTO t99_audittrail VALUES("1167","2019-07-31 20:53:33","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Tgl","6","2019-07-30","2019-06-29");
INSERT INTO t99_audittrail VALUES("1168","2019-07-31 20:53:33","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","6","0.00","200000.00");
INSERT INTO t99_audittrail VALUES("1169","2019-07-31 20:53:33","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","6","","201904");
INSERT INTO t99_audittrail VALUES("1170","2019-07-31 20:58:28","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","6","0.00","200000.00");
INSERT INTO t99_audittrail VALUES("1171","2019-07-31 20:58:28","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","6","","201904");
INSERT INTO t99_audittrail VALUES("1172","2019-07-31 21:19:34","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Tgl","6","2019-06-29","2019-06-30");
INSERT INTO t99_audittrail VALUES("1173","2019-07-31 21:19:34","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","6","0.00","200000.00");
INSERT INTO t99_audittrail VALUES("1174","2019-07-31 21:19:34","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","6","","201904");
INSERT INTO t99_audittrail VALUES("1175","2019-07-31 21:29:02","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KodeTransaksi","17","","17");
INSERT INTO t99_audittrail VALUES("1176","2019-07-31 21:29:02","/simkop5/t89_rektranlist.php","1","A","t89_rektran","JenisTransaksi","17","","Bayar Bunga Deposito");
INSERT INTO t99_audittrail VALUES("1177","2019-07-31 21:29:02","/simkop5/t89_rektranlist.php","1","A","t89_rektran","DebetRekening","17","","4.8000");
INSERT INTO t99_audittrail VALUES("1178","2019-07-31 21:29:02","/simkop5/t89_rektranlist.php","1","A","t89_rektran","KreditRekening","17","","1.1003");
INSERT INTO t99_audittrail VALUES("1179","2019-07-31 21:29:02","/simkop5/t89_rektranlist.php","1","A","t89_rektran","id","17","","17");
INSERT INTO t99_audittrail VALUES("1180","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_No","3","","00003");
INSERT INTO t99_audittrail VALUES("1181","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Tgl","3","","2019-04-30");
INSERT INTO t99_audittrail VALUES("1182","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Lama","3","","5");
INSERT INTO t99_audittrail VALUES("1183","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Tgl","3","","2019-09-30");
INSERT INTO t99_audittrail VALUES("1184","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Deposito","3","","30000000");
INSERT INTO t99_audittrail VALUES("1185","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Suku","3","","12");
INSERT INTO t99_audittrail VALUES("1186","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga","3","","300000");
INSERT INTO t99_audittrail VALUES("1187","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","nasabah_id","3","","1");
INSERT INTO t99_audittrail VALUES("1188","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","bank_id","3","","1");
INSERT INTO t99_audittrail VALUES("1189","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","No_Ref","3","","");
INSERT INTO t99_audittrail VALUES("1190","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Administrasi","3","","10000");
INSERT INTO t99_audittrail VALUES("1191","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Biaya_Materai","3","","6000");
INSERT INTO t99_audittrail VALUES("1192","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Kontrak_Status","3","","Ya");
INSERT INTO t99_audittrail VALUES("1193","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Jatuh_Tempo_Status","3","","Diperpanjang");
INSERT INTO t99_audittrail VALUES("1194","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Bunga_Status","3","","Transfer");
INSERT INTO t99_audittrail VALUES("1195","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","Periode","3","","201904");
INSERT INTO t99_audittrail VALUES("1196","2019-07-31 21:36:43","/simkop5/t23_depositoadd.php","1","A","t23_deposito","id","3","","3");
INSERT INTO t99_audittrail VALUES("1197","2019-07-31 21:38:05","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Tgl","7","2019-05-30","2019-04-30");
INSERT INTO t99_audittrail VALUES("1198","2019-07-31 21:38:05","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Bayar_Jumlah","7","0.00","300000.00");
INSERT INTO t99_audittrail VALUES("1199","2019-07-31 21:38:05","/simkop5/t24_deposito_detailedit.php","1","U","t24_deposito_detail","Periode","7","","201904");
INSERT INTO t99_audittrail VALUES("1200","2019-08-01 14:22:16","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1201","2019-08-05 09:50:56","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1202","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","6","","60005");
INSERT INTO t99_audittrail VALUES("1203","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","6","","2019-04-05");
INSERT INTO t99_audittrail VALUES("1204","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","6","","4");
INSERT INTO t99_audittrail VALUES("1205","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","6","","15,16,17,18,19");
INSERT INTO t99_audittrail VALUES("1206","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","6","","10000000");
INSERT INTO t99_audittrail VALUES("1207","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","6","","3");
INSERT INTO t99_audittrail VALUES("1208","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","6","","2");
INSERT INTO t99_audittrail VALUES("1209","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","6","","0.4");
INSERT INTO t99_audittrail VALUES("1210","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","6","","3");
INSERT INTO t99_audittrail VALUES("1211","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","6","","10000000");
INSERT INTO t99_audittrail VALUES("1212","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","6","","200000");
INSERT INTO t99_audittrail VALUES("1213","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","6","","10600000");
INSERT INTO t99_audittrail VALUES("1214","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","6","","");
INSERT INTO t99_audittrail VALUES("1215","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","6","","0");
INSERT INTO t99_audittrail VALUES("1216","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","6","","0");
INSERT INTO t99_audittrail VALUES("1217","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","6","","1");
INSERT INTO t99_audittrail VALUES("1218","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","6","","201904");
INSERT INTO t99_audittrail VALUES("1219","2019-08-05 17:03:12","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","6","","6");
INSERT INTO t99_audittrail VALUES("1220","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","44","","2019-04-06");
INSERT INTO t99_audittrail VALUES("1221","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","44","","-29");
INSERT INTO t99_audittrail VALUES("1222","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","44","","0");
INSERT INTO t99_audittrail VALUES("1223","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","44","","0");
INSERT INTO t99_audittrail VALUES("1224","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","44","","200000");
INSERT INTO t99_audittrail VALUES("1225","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","44","","200000");
INSERT INTO t99_audittrail VALUES("1226","2019-08-05 17:45:24","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","44","","201904");
INSERT INTO t99_audittrail VALUES("1227","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","45","","2019-04-06");
INSERT INTO t99_audittrail VALUES("1228","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","45","","-60");
INSERT INTO t99_audittrail VALUES("1229","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","45","","0");
INSERT INTO t99_audittrail VALUES("1230","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","45","","0");
INSERT INTO t99_audittrail VALUES("1231","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","45","","200000");
INSERT INTO t99_audittrail VALUES("1232","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","45","","200000");
INSERT INTO t99_audittrail VALUES("1233","2019-08-05 17:45:54","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","45","","201904");
INSERT INTO t99_audittrail VALUES("1234","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","46","","2019-04-06");
INSERT INTO t99_audittrail VALUES("1235","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","46","","-90");
INSERT INTO t99_audittrail VALUES("1236","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","46","","0");
INSERT INTO t99_audittrail VALUES("1237","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","46","","0");
INSERT INTO t99_audittrail VALUES("1238","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","46","","10200000");
INSERT INTO t99_audittrail VALUES("1239","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","46","","10200000");
INSERT INTO t99_audittrail VALUES("1240","2019-08-05 17:46:19","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","46","","201904");
INSERT INTO t99_audittrail VALUES("1241","2019-08-09 18:48:35","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1242","2019-08-09 19:00:04","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("1243","2019-08-24 17:27:23","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1244","2019-08-26 10:12:10","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1245","2019-08-30 15:06:38","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("1246","2020-04-03 13:31:15","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("1247","2020-04-03 13:31:23","/simkop5/login.php","admin","login","::1","","","","");



