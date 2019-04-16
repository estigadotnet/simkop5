<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "userfn13.php" ?>

<?php
// --------------------------------------------------
// tabel periode
// tabel periodeold
// --------------------------------------------------
// proses pindah data dari tabel periode ke tabel periode_old
$q = "insert into t92_periodeold (Bulan, Tahun, Tahun_Bulan) select Bulan, Tahun, Tahun_Bulan from t93_periode";
Conn()->Execute($q);

// update data di tabel periode dengan data periode baru
$q = "select * from t93_periode";
$r = Conn()->Execute($q);
$periode_skrg = $r->fields["Tahun_Bulan"];
$periode_lalu_bulan = $r->fields["Bulan"];
$periode_lalu_tahun = $r->fields["Tahun"];
$periode_skrg_bulan = $periode_lalu_bulan + 1;
$periode_skrg_tahun = $periode_lalu_tahun;
if ($periode_skrg_bulan == 13) {
    $periode_skrg_bulan = 1;
    $periode_skrg_tahun = $periode_lalu_tahun + 1;
}
$periode_skrg_tahun_bulan = $periode_skrg_tahun . substr("00".$periode_skrg_bulan, -2);
$q = "truncate t93_periode";
Conn()->Execute($q);

$q = "insert into t93_periode values (null, ".$periode_skrg_bulan.", ".$periode_skrg_tahun.", ".$periode_skrg_tahun_bulan.")";
Conn()->Execute($q); //echo $q; exit();
// --------------------------------------------------


// ambil nilai akun SHU BULAN BERJALAN
// kodetransaksi = 11
$q = "select DebetRekening from t89_rektran where KodeTransaksi = '11'";
$r = Conn()->Execute($q); //echo $q."<br/>";
$rekdebet  = $r->fields["DebetRekening"]; //echo $rekdebet."<br/>";

// cari nilai laba rugi
$q = "select sum(kredit) - sum(debet) as LabaRugi from v32_labarugi where
	periode = '".$periode_skrg."' ";
$r = Conn()->Execute($q);
$LabaRugi = $r->fields["LabaRugi"];

// cari nilai laba rugi old
$q = "select sum(kredit) - sum(debet) as LabaRugi from v42_labarugiold";
$r = Conn()->Execute($q);
$LabaRugiOld = $r->fields["LabaRugi"];


// --------------------------------------------------
// tabel rekening
// tabel rekeningold
// --------------------------------------------------
// append data dari tabel t91_rekening ke t80_rekeningold
$q = "insert into t80_rekeningold select * from `t91_rekening`";
Conn()->Execute($q);

// update nilai akun SHU BULAN BERJALAN di tabel t80_rekeningold
$q = "update t80_rekeningold set saldo = ".$LabaRugi." where periode = '".$periode_skrg."'
	and id = '".$rekdebet."'"; //echo $q; //die();
Conn()->Execute($q);

// update nilai saldo di tabel t91_rekening, update dari v34_saldoakhir
$q = "update t91_rekening left join v34_saldoakhir on t91_rekening.id = v34_saldoakhir.id
	set t91_rekening.saldo = v34_saldoakhir.saldo";
Conn()->Execute($q);

// update data Periode di tabel t91_rekening dengan data periode baru
$q = "update t91_rekening set Periode = '".$periode_skrg_tahun_bulan."'";
Conn()->Execute($q);

// update SHU TAHUN BERJALAN
// ambil nilai akun SHU TAHUN BERJALAN
// kodetransaksi = 13
$q = "select DebetRekening from t89_rektran where KodeTransaksi = '13'";
$r = Conn()->Execute($q); //echo $q."<br/>";
$rekdebet  = $r->fields["DebetRekening"]; //echo $rekdebet."<br/>";

// update nilai akun SHU TAHUN BERJALAN di tabel t91_rekening
$LabaRugi = $LabaRugi + $LabaRugiOld;
$q = "update t91_rekening set saldo = ".$LabaRugi." where id = '".$rekdebet."'"; //echo $q; //die();
Conn()->Execute($q);
// --------------------------------------------------


// --------------------------------------------------
// tabel jurnal
// tabel jurnalold
// --------------------------------------------------
// append data dari tabel jurnal ke jurnalold
$q = "insert into t82_jurnalold (Tanggal, Periode, NomorTransaksi, Rekening, Debet, Kredit, Keterangan) 
	SELECT Tanggal, Periode, NomorTransaksi, Rekening, Debet, Kredit, Keterangan FROM `t10_jurnal`";
Conn()->Execute($q);

// truncate tabel jurnal
$q = "truncate t10_jurnal";
Conn()->Execute($q);
// --------------------------------------------------


// kembali ke cf02_tutupbuku
header("location: cf02_tutupbuku.php?ok=1");
?>