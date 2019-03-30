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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t02_jaminan VALUES("1","1","ATM","","","","","","");



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

INSERT INTO t03_pinjaman VALUES("1","60001","2019-03-09","1","1","10400000.00","12","2.24","0.40","3","867000.00","233000.00","1100000.00","","0.00","0.00","1","201903","N");



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

INSERT INTO t04_pinjamanangsurantemp VALUES("1","1","1","2019-04-09","867000.00","233000.00","1100000.00","9533000.00","2019-04-09","0","0.00","0.00","1100000.00","1100000.00","","201904");
INSERT INTO t04_pinjamanangsurantemp VALUES("2","1","2","2019-05-09","867000.00","233000.00","1100000.00","8666000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("3","1","3","2019-06-09","867000.00","233000.00","1100000.00","7799000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("4","1","4","2019-07-09","867000.00","233000.00","1100000.00","6932000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("5","1","5","2019-08-09","867000.00","233000.00","1100000.00","6065000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("6","1","6","2019-09-09","867000.00","233000.00","1100000.00","5198000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("7","1","7","2019-10-09","867000.00","233000.00","1100000.00","4331000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("8","1","8","2019-11-09","867000.00","233000.00","1100000.00","3464000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("9","1","9","2019-12-09","867000.00","233000.00","1100000.00","2597000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("10","1","10","2020-01-09","867000.00","233000.00","1100000.00","1730000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("11","1","11","2020-02-09","867000.00","233000.00","1100000.00","863000.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");
INSERT INTO t04_pinjamanangsurantemp VALUES("12","1","12","2020-03-09","863000.00","237000.00","1100000.00","0.00","0000-00-00","0","0.00","0.00","0.00","0.00","","");



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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




DROP TABLE t75_company;

CREATE TABLE `t75_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `NoTelp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t75_company VALUES("1","Koperasi Sumber Makmur x","Sidoarjo","0318889999");



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

INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","0000-00-00","","Saldo Awal","0.00","0.00","-10400000.00");
INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","2019-04-09","1.ANG","Pembayaran Angsuran ke 1 No. Kontrak 60001","867000.00","0.00","-9533000.00");
INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","2019-04-09","1.BGA","Pendapatan Bunga ke 1 No. Kontrak 60001","233000.00","0.00","-9300000.00");
INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","2019-04-09","1.DND","Pendapatan Denda ke 1 No. Kontrak 60001","0.00","0.00","-9300000.00");



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
INSERT INTO t80_rekeningold VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201903");
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
INSERT INTO t80_rekeningold VALUES("1","1","AKTIVA","GROUP","DEBET","NERACA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1000","KAS","HEADER","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1001","KAS BANK - BCA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1002","KAS BANK - MANDIRI","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","-10400000.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","10400000.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2004","PIUTANG SIDOARJO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2005","PIUTANG KPL 5","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2006","PIUTANG TROSOBO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2007","PIUTANG DANIEL","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.2008","PIUTANG ANDIK","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.3000","PERSEDIAAN KANTOR","DETAIL","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("1","1.4000","AKUMULASI PENYUSUTAN","DETAIL","DEBET","NERACA","","1","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2","PASSIVA","GROUP","CREDIT","NERACA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.1000","HUTANG PAJAJARAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.2000","HUTANG DANIEL","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.3000","TITIPAN NASABAH","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.4000","MODAL DISETOR","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.5000","SHU TAHUN LALU","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.6000","SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.7000","PEMBAGIAN SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","233000.00","201904");
INSERT INTO t80_rekeningold VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201904");
INSERT INTO t80_rekeningold VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","201904");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO t82_jurnalold VALUES("1","2019-03-09","201903","1.PINJ","1.2003","10400000.00","0.00","Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("2","2019-03-09","201903","1.PINJ","1.1003","0.00","10400000.00","Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("3","2019-03-09","201903","1.ADM","1.1003","0.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("4","2019-03-09","201903","1.ADM","5.1000","0.00","0.00","Pendapatan Administrasi Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("5","2019-03-09","201903","1.MAT","1.1003","0.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("6","2019-03-09","201903","1.MAT","5.4000","0.00","0.00","Pendapatan Materai Pinjaman No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("8","2019-04-09","201904","1.ANG","1.1003","867000.00","0.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("9","2019-04-09","201904","1.ANG","1.2003","0.00","867000.00","Pembayaran Angsuran ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("10","2019-04-09","201904","1.BGA","1.1003","233000.00","0.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("11","2019-04-09","201904","1.BGA","3.1000","0.00","233000.00","Pendapatan Bunga ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("12","2019-04-09","201904","1.DND","1.1003","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");
INSERT INTO t82_jurnalold VALUES("13","2019-04-09","201904","1.DND","5.3000","0.00","0.00","Pendapatan Denda ke 1 No. Kontrak 60001");



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
  `field03` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t87_neraca VALUES("","","Mei 2019");
INSERT INTO t87_neraca VALUES("<strong>AKTIVA</strong>","","");
INSERT INTO t87_neraca VALUES("1.1001","KAS BANK - BCA","0.00");
INSERT INTO t87_neraca VALUES("1.1002","KAS BANK - MANDIRI","0.00");
INSERT INTO t87_neraca VALUES("1.1003","KAS BANK - BCA SURABAYA","-9,300,000.00");
INSERT INTO t87_neraca VALUES("1.1004","KAS BESAR","0.00");
INSERT INTO t87_neraca VALUES("1.1005","KAS KECIL HARIAN","0.00");
INSERT INTO t87_neraca VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","0.00");
INSERT INTO t87_neraca VALUES("1.2002","NASABAH MACET > 12 BULAN","0.00");
INSERT INTO t87_neraca VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","9,533,000.00");
INSERT INTO t87_neraca VALUES("1.2004","PIUTANG SIDOARJO","0.00");
INSERT INTO t87_neraca VALUES("1.2005","PIUTANG KPL 5","0.00");
INSERT INTO t87_neraca VALUES("1.2006","PIUTANG TROSOBO","0.00");
INSERT INTO t87_neraca VALUES("1.2007","PIUTANG DANIEL","0.00");
INSERT INTO t87_neraca VALUES("1.2008","PIUTANG ANDIK","0.00");
INSERT INTO t87_neraca VALUES("1.3000","PERSEDIAAN KANTOR","0.00");
INSERT INTO t87_neraca VALUES("1.4000","AKUMULASI PENYUSUTAN","0.00");
INSERT INTO t87_neraca VALUES("","","<strong>233,000.00</stro");
INSERT INTO t87_neraca VALUES("","","");
INSERT INTO t87_neraca VALUES("<strong>PASSIVA</strong>","","");
INSERT INTO t87_neraca VALUES("2.1000","HUTANG PAJAJARAN","0.00");
INSERT INTO t87_neraca VALUES("2.2000","HUTANG DANIEL","0.00");
INSERT INTO t87_neraca VALUES("2.3000","TITIPAN NASABAH","0.00");
INSERT INTO t87_neraca VALUES("2.4000","MODAL DISETOR","0.00");
INSERT INTO t87_neraca VALUES("2.5000","SHU TAHUN LALU","0.00");
INSERT INTO t87_neraca VALUES("2.6000","SHU TAHUN","0.00");
INSERT INTO t87_neraca VALUES("2.7000","PEMBAGIAN SHU TAHUN","0.00");
INSERT INTO t87_neraca VALUES("2.8000","SHU TAHUN BERJALAN","233,000.00");
INSERT INTO t87_neraca VALUES("2.9000","SHU BULAN BERJALAN","0.00");
INSERT INTO t87_neraca VALUES("","","<strong>233,000.00</stro");
INSERT INTO t87_neraca VALUES("","","");
INSERT INTO t87_neraca VALUES("","","<strong>0.00</strong>");



DROP TABLE t88_labarugi;

CREATE TABLE `t88_labarugi` (
  `field01` varchar(35) DEFAULT NULL,
  `field02` varchar(90) DEFAULT NULL,
  `field03` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t88_labarugi VALUES("","","Mei 2019");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN</strong>","","");
INSERT INTO t88_labarugi VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","0.00");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN LAIN</strong>","","");
INSERT INTO t88_labarugi VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00");
INSERT INTO t88_labarugi VALUES("5.2000","PENDAPATAN BUNGA BANK","0.00");
INSERT INTO t88_labarugi VALUES("5.3000","PENDAPATAN DENDA","0.00");
INSERT INTO t88_labarugi VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>");
INSERT INTO t88_labarugi VALUES("","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA</strong>","","");
INSERT INTO t88_labarugi VALUES("4.1000","BIAYA KARYAWAN","0.00");
INSERT INTO t88_labarugi VALUES("4.2000","BIAYA PERKANTORAN & UMUM","0.00");
INSERT INTO t88_labarugi VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","0.00");
INSERT INTO t88_labarugi VALUES("4.4000","BIAYA ADMINISTRASI BANK","0.00");
INSERT INTO t88_labarugi VALUES("4.5000","BIAYA PENYUSUTAN","0.00");
INSERT INTO t88_labarugi VALUES("4.6000","BIAYA IKLAN","0.00");
INSERT INTO t88_labarugi VALUES("4.7000","POTONGAN","0.00");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA LAIN</strong>","","");
INSERT INTO t88_labarugi VALUES("6.1000","BIAYA LAIN-LAIN","0.00");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>");
INSERT INTO t88_labarugi VALUES("","","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>");



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

INSERT INTO t91_rekening VALUES("1","1","AKTIVA","GROUP","DEBET","NERACA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1000","KAS","HEADER","DEBET","NERACA","","1","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1001","KAS BANK - BCA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1002","KAS BANK - MANDIRI","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","-9300000.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","9533000.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2004","PIUTANG SIDOARJO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2005","PIUTANG KPL 5","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2006","PIUTANG TROSOBO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2007","PIUTANG DANIEL","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.2008","PIUTANG ANDIK","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.3000","PERSEDIAAN KANTOR","DETAIL","DEBET","NERACA","","1","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("1","1.4000","AKUMULASI PENYUSUTAN","DETAIL","DEBET","NERACA","","1","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2","PASSIVA","GROUP","CREDIT","NERACA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.1000","HUTANG PAJAJARAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.2000","HUTANG DANIEL","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.3000","TITIPAN NASABAH","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.4000","MODAL DISETOR","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.5000","SHU TAHUN LALU","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.6000","SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.7000","PEMBAGIAN SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","233000.00","201905");
INSERT INTO t91_rekening VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","233000.00","201905");
INSERT INTO t91_rekening VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","201905");
INSERT INTO t91_rekening VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","201905");



DROP TABLE t92_periodeold;

CREATE TABLE `t92_periodeold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO t92_periodeold VALUES("1","3","2019","201903");
INSERT INTO t92_periodeold VALUES("2","4","2019","201904");



DROP TABLE t93_periode;

CREATE TABLE `t93_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Tahun_Bulan` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO t93_periode VALUES("1","5","2019","201905");



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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO t99_audittrail VALUES("1","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_No","1","","60001");
INSERT INTO t99_audittrail VALUES("2","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Kontrak_Tgl","1","","2019-03-09");
INSERT INTO t99_audittrail VALUES("3","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","nasabah_id","1","","1");
INSERT INTO t99_audittrail VALUES("4","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","jaminan_id","1","","1");
INSERT INTO t99_audittrail VALUES("5","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Pinjaman","1","","10400000");
INSERT INTO t99_audittrail VALUES("6","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Lama","1","","12");
INSERT INTO t99_audittrail VALUES("7","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga_Prosen","1","","2.24");
INSERT INTO t99_audittrail VALUES("8","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Denda","1","","0.4");
INSERT INTO t99_audittrail VALUES("9","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Dispensasi_Denda","1","","3");
INSERT INTO t99_audittrail VALUES("10","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Pokok","1","","867000");
INSERT INTO t99_audittrail VALUES("11","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Bunga","1","","233000");
INSERT INTO t99_audittrail VALUES("12","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Angsuran_Total","1","","1100000");
INSERT INTO t99_audittrail VALUES("13","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","No_Ref","1","","");
INSERT INTO t99_audittrail VALUES("14","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Administrasi","1","","0");
INSERT INTO t99_audittrail VALUES("15","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Biaya_Materai","1","","0");
INSERT INTO t99_audittrail VALUES("16","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","marketing_id","1","","1");
INSERT INTO t99_audittrail VALUES("17","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","Periode","1","","201903");
INSERT INTO t99_audittrail VALUES("18","2019-03-09 09:08:13","/simkop5/t03_pinjamanadd.php","1","A","t03_pinjaman","id","1","","1");
INSERT INTO t99_audittrail VALUES("19","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Tanggal_Bayar","1","","2019-04-09");
INSERT INTO t99_audittrail VALUES("20","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Terlambat","1","","0");
INSERT INTO t99_audittrail VALUES("21","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Total_Denda","1","","0");
INSERT INTO t99_audittrail VALUES("22","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Titipan","1","","0");
INSERT INTO t99_audittrail VALUES("23","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Non_Titipan","1","","1100000");
INSERT INTO t99_audittrail VALUES("24","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Bayar_Total","1","","1100000");
INSERT INTO t99_audittrail VALUES("25","2019-03-09 09:24:15","/simkop5/t04_pinjamanangsurantempedit.php","1","U","t04_pinjamanangsurantemp","Periode","1","","201904");
INSERT INTO t99_audittrail VALUES("26","2019-03-14 18:20:40","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("27","2019-03-19 09:35:27","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("28","2019-03-19 11:34:40","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("29","2019-03-21 10:28:54","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("30","2019-03-21 11:01:39","/simkop5/t75_companyadd.php","1","A","t75_company","Nama","1","","Koperasi Sumber Makmur");
INSERT INTO t99_audittrail VALUES("31","2019-03-21 11:01:39","/simkop5/t75_companyadd.php","1","A","t75_company","Alamat","1","","Sidoarjo");
INSERT INTO t99_audittrail VALUES("32","2019-03-21 11:01:39","/simkop5/t75_companyadd.php","1","A","t75_company","NoTelp","1","","0318889999");
INSERT INTO t99_audittrail VALUES("33","2019-03-21 11:01:39","/simkop5/t75_companyadd.php","1","A","t75_company","id","1","","1");
INSERT INTO t99_audittrail VALUES("34","2019-03-25 12:42:10","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("35","2019-03-25 20:35:04","/simkop5/t75_companyedit.php","1","U","t75_company","Nama","1","Koperasi Sumber Makmur","Koperasi Sumber Makmur x");
INSERT INTO t99_audittrail VALUES("36","2019-03-26 07:52:10","/simkop5/login.php","admin","login","::1","","","","");



