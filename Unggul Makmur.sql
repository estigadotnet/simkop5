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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t08_pinjamanpotongan;

CREATE TABLE `t08_pinjamanpotongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t09_jurnaltransaksi;

CREATE TABLE `t09_jurnaltransaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t22_peserta;

CREATE TABLE `t22_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text DEFAULT NULL,
  `No_Telp_Hp` varchar(100) DEFAULT NULL,
  `Pekerjaan` varchar(50) DEFAULT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE t24_deposito_detail;

CREATE TABLE `t24_deposito_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deposito_id` int(11) NOT NULL,
  `Pembayaran_Ke` tinyint(4) NOT NULL DEFAULT 0,
  `Bayar_Tgl` date NOT NULL,
  `Bayar_Jumlah` float(14,2) NOT NULL DEFAULT 0.00,
  `Periode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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

INSERT INTO t75_company VALUES("1","Unggul Makmur","Sidoarjo","-");



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

INSERT INTO t78_bukubesarlap VALUES("1","AKTIVA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1","AKTIVA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1000","KAS","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1000","KAS","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1001","KAS BANK - BCA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1001","KAS BANK - BCA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1002","KAS BANK - MANDIRI","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1002","KAS BANK - MANDIRI","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1003","KAS BANK - BCA SURABAYA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1004","KAS BESAR","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1004","KAS BESAR","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1005","KAS KECIL HARIAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.1005","KAS KECIL HARIAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2000","PIUTANG","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2000","PIUTANG","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2002","NASABAH MACET > 12 BULAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2002","NASABAH MACET > 12 BULAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2004","PIUTANG SIDOARJO","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2004","PIUTANG SIDOARJO","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2005","PIUTANG KPL 5","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2005","PIUTANG KPL 5","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2006","PIUTANG TROSOBO","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2006","PIUTANG TROSOBO","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2007","PIUTANG DANIEL","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2007","PIUTANG DANIEL","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2008","PIUTANG ANDIK","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.2008","PIUTANG ANDIK","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.3000","PERSEDIAAN KANTOR","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.3000","PERSEDIAAN KANTOR","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.4000","AKUMULASI PENYUSUTAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("1.4000","AKUMULASI PENYUSUTAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2","PASSIVA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2","PASSIVA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.1000","HUTANG PAJAJARAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.1000","HUTANG PAJAJARAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.2000","HUTANG DANIEL","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.2000","HUTANG DANIEL","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.3000","TITIPAN NASABAH","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.3000","TITIPAN NASABAH","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.4000","MODAL DISETOR","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.4000","MODAL DISETOR","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.5000","DEPOSITO","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.5000","DEPOSITO","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.6000","SHU TAHUN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.6000","SHU TAHUN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.7000","PEMBAGIAN SHU TAHUN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.7000","PEMBAGIAN SHU TAHUN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.8000","SHU TAHUN BERJALAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.8000","SHU TAHUN BERJALAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.9000","SHU BULAN BERJALAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("2.9000","SHU BULAN BERJALAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("3","PENDAPATAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("3","PENDAPATAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4","BIAYA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4","BIAYA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.1000","BIAYA KARYAWAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.1000","BIAYA KARYAWAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.2000","BIAYA PERKANTORAN & UMUM","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.2000","BIAYA PERKANTORAN & UMUM","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.4000","BIAYA ADMINISTRASI BANK","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.4000","BIAYA ADMINISTRASI BANK","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.5000","BIAYA PENYUSUTAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.5000","BIAYA PENYUSUTAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.6000","BIAYA IKLAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.6000","BIAYA IKLAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.7000","POTONGAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.7000","POTONGAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.8000","BIAYA BUNGA DEPOSITO","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("4.8000","BIAYA BUNGA DEPOSITO","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5","PENDAPATAN LAIN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5","PENDAPATAN LAIN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.2000","PENDAPATAN BUNGA BANK","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.2000","PENDAPATAN BUNGA BANK","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.3000","PENDAPATAN DENDA","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.3000","PENDAPATAN DENDA","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("6","BIAYA LAIN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("6","BIAYA LAIN","2020-04-01","","","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("6.1000","BIAYA LAIN-LAIN","2020-04-01","","Saldo Awal","0.00","0.00","0.00");
INSERT INTO t78_bukubesarlap VALUES("6.1000","BIAYA LAIN-LAIN","2020-04-01","","","0.00","0.00","0.00");



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

INSERT INTO t87_neraca VALUES("","","April 2020","","");
INSERT INTO t87_neraca VALUES("<strong>AKTIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("1.1001","KAS BANK - BCA","0.00","","");
INSERT INTO t87_neraca VALUES("1.1002","KAS BANK - MANDIRI","0.00","","");
INSERT INTO t87_neraca VALUES("1.1003","KAS BANK - BCA SURABAYA","0.00","","");
INSERT INTO t87_neraca VALUES("1.1004","KAS BESAR","0.00","","");
INSERT INTO t87_neraca VALUES("1.1005","KAS KECIL HARIAN","0.00","","");
INSERT INTO t87_neraca VALUES("1.2001","PIUTANG KURANG BAYAR NASABAH","0.00","","");
INSERT INTO t87_neraca VALUES("1.2002","NASABAH MACET > 12 BULAN","0.00","","");
INSERT INTO t87_neraca VALUES("1.2003","PINJAMAN BERJANGKA & ANGSURAN","0.00","","");
INSERT INTO t87_neraca VALUES("1.2004","PIUTANG SIDOARJO","0.00","","");
INSERT INTO t87_neraca VALUES("1.2005","PIUTANG KPL 5","0.00","","");
INSERT INTO t87_neraca VALUES("1.2006","PIUTANG TROSOBO","0.00","","");
INSERT INTO t87_neraca VALUES("1.2007","PIUTANG DANIEL","0.00","","");
INSERT INTO t87_neraca VALUES("1.2008","PIUTANG ANDIK","0.00","","");
INSERT INTO t87_neraca VALUES("1.3000","PERSEDIAAN KANTOR","0.00","","");
INSERT INTO t87_neraca VALUES("1.4000","AKUMULASI PENYUSUTAN","0.00","","");
INSERT INTO t87_neraca VALUES("","","<strong>0.00</strong>","","");
INSERT INTO t87_neraca VALUES("","","","","");
INSERT INTO t87_neraca VALUES("<strong>PASSIVA</strong>","","","","");
INSERT INTO t87_neraca VALUES("2.1000","HUTANG PAJAJARAN","0.00","","");
INSERT INTO t87_neraca VALUES("2.2000","HUTANG DANIEL","0.00","","");
INSERT INTO t87_neraca VALUES("2.3000","TITIPAN NASABAH","0.00","","");
INSERT INTO t87_neraca VALUES("2.4000","MODAL DISETOR","0.00","","");
INSERT INTO t87_neraca VALUES("2.5000","DEPOSITO","0.00","","");
INSERT INTO t87_neraca VALUES("2.6000","SHU TAHUN","0.00","","");
INSERT INTO t87_neraca VALUES("2.7000","PEMBAGIAN SHU TAHUN","0.00","","");
INSERT INTO t87_neraca VALUES("2.8000","SHU TAHUN BERJALAN","0.00","","");
INSERT INTO t87_neraca VALUES("2.9000","SHU BULAN BERJALAN","0.00","","");
INSERT INTO t87_neraca VALUES("","","<strong>0.00</strong>","","");
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

INSERT INTO t88_labarugi VALUES("","","April 2020","","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("3.1000","PENDAPATAN BUNGA PINJAMAN","0.00","","");
INSERT INTO t88_labarugi VALUES("<strong>PENDAPATAN LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","0.00","","");
INSERT INTO t88_labarugi VALUES("5.2000","PENDAPATAN BUNGA BANK","0.00","","");
INSERT INTO t88_labarugi VALUES("5.3000","PENDAPATAN DENDA","0.00","","");
INSERT INTO t88_labarugi VALUES("5.4000","PENDAPATAN LAIN-LAIN / MATERAI","0.00","","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>","","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA</strong>","","","","");
INSERT INTO t88_labarugi VALUES("4.1000","BIAYA KARYAWAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.2000","BIAYA PERKANTORAN & UMUM","0.00","","");
INSERT INTO t88_labarugi VALUES("4.3000","BIAYA KOMISI MAKELAR / FEE","0.00","","");
INSERT INTO t88_labarugi VALUES("4.4000","BIAYA ADMINISTRASI BANK","0.00","","");
INSERT INTO t88_labarugi VALUES("4.5000","BIAYA PENYUSUTAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.6000","BIAYA IKLAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.7000","POTONGAN","0.00","","");
INSERT INTO t88_labarugi VALUES("4.8000","BIAYA BUNGA DEPOSITO","0.00","","");
INSERT INTO t88_labarugi VALUES("5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","0.00","","");
INSERT INTO t88_labarugi VALUES("<strong>BIAYA LAIN</strong>","","","","");
INSERT INTO t88_labarugi VALUES("6.1000","BIAYA LAIN-LAIN","0.00","","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>","","");
INSERT INTO t88_labarugi VALUES("","","","","");
INSERT INTO t88_labarugi VALUES("","","<strong>0.00</strong>","","");



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

INSERT INTO t91_rekening VALUES("1","1","AKTIVA","GROUP","DEBET","NERACA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1000","KAS","HEADER","DEBET","NERACA","","1","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1001","KAS BANK - BCA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1002","KAS BANK - MANDIRI","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1003","KAS BANK - BCA SURABAYA","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1004","KAS BESAR","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.1005","KAS KECIL HARIAN","DETAIL","DEBET","NERACA","KAS/BANK","1.1000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2000","PIUTANG","HEADER","DEBET","NERACA","","1","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2001","PIUTANG KURANG BAYAR NASABAH","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2002","NASABAH MACET > 12 BULAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2003","PINJAMAN BERJANGKA & ANGSURAN","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2004","PIUTANG SIDOARJO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2005","PIUTANG KPL 5","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2006","PIUTANG TROSOBO","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2007","PIUTANG DANIEL","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.2008","PIUTANG ANDIK","DETAIL","DEBET","NERACA","","1.2000","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.3000","PERSEDIAAN KANTOR","DETAIL","DEBET","NERACA","","1","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("1","1.4000","AKUMULASI PENYUSUTAN","DETAIL","DEBET","NERACA","","1","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2","PASSIVA","GROUP","CREDIT","NERACA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.1000","HUTANG PAJAJARAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.2000","HUTANG DANIEL","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.3000","TITIPAN NASABAH","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.4000","MODAL DISETOR","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.5000","DEPOSITO","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.6000","SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.7000","PEMBAGIAN SHU TAHUN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.8000","SHU TAHUN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("2","2.9000","SHU BULAN BERJALAN","DETAIL","CREDIT","NERACA","","2","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("3","3","PENDAPATAN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("3","3.1000","PENDAPATAN BUNGA PINJAMAN","DETAIL","CREDIT","RUGI LABA","","3","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4","BIAYA","GROUP","DEBET","RUGI LABA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.1000","BIAYA KARYAWAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.2000","BIAYA PERKANTORAN & UMUM","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.3000","BIAYA KOMISI MAKELAR / FEE","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.4000","BIAYA ADMINISTRASI BANK","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.5000","BIAYA PENYUSUTAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.6000","BIAYA IKLAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.7000","POTONGAN","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","4.8000","BIAYA BUNGA DEPOSITO","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("5","5","PENDAPATAN LAIN","GROUP","CREDIT","RUGI LABA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("5","5.1000","PENDAPATAN ADMINISTRASI PINJAMAN","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("5","5.2000","PENDAPATAN BUNGA BANK","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("5","5.3000","PENDAPATAN DENDA","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("5","5.4000","PENDAPATAN LAIN-LAIN / MATERAI","DETAIL","CREDIT","RUGI LABA","","5","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("4","5.5000","PENDAPATAN ADMINISTRASI DEPOSITO","DETAIL","DEBET","RUGI LABA","","4","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("6","6","BIAYA LAIN","GROUP","DEBET","RUGI LABA","","","","yes","0.00","202004");
INSERT INTO t91_rekening VALUES("6","6.1000","BIAYA LAIN-LAIN","DETAIL","DEBET","RUGI LABA","","6","","yes","0.00","202004");



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

INSERT INTO t93_periode VALUES("1","4","2020","202004");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO t99_audittrail VALUES("1","2020-04-03 13:44:48","/simkop5/logout.php","admin","logout","::1","","","","");
INSERT INTO t99_audittrail VALUES("2","2020-04-03 13:44:52","/simkop5/login.php","admin","login","::1","","","","");
INSERT INTO t99_audittrail VALUES("3","2020-04-03 13:45:22","/simkop5/t75_companyedit.php","1","U","t75_company","Nama","1","Koperasi Bersama","Unggul Makmur");



