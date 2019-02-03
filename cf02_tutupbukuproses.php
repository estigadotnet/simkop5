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
// tabel periode --------------------------------------------------
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

// backup data laba rugi untuk periode sekarang
// dari tabel t88_labarugi ke tabel t86_labarugiold
$q = "SELECT * FROM `t88_labarugi` where field02 <> ''";
$r = Conn()->Execute($q);
$q = "insert into t86_labarugiold (Tahun_Bulan, Rekening, Jumlah)
	select '".$periode_skrg."', field01, field03
	from t88_labarugi where field02 <> ''";
Conn()->Execute($q); //echo $q; exit();

// kembali ke cf02_tutupbuku
header("location: cf02_tutupbuku.php?ok=1");
?>