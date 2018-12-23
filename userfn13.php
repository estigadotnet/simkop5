<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
	// simpan data periode berjalan

	$GLOBALS["Periode"] = ew_ExecuteScalar("select Tahun_Bulan from t93_periode");

	//$_SESSION["pinjaman_id"] = 0;
	//echo "0".$GLOBALS["Periode"]; //exit;
	//$GLOBALS["t03_pinjaman"]->Angsuran_Denda->CurrentValue;

}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}
/*

function yang dibuat untuk memudahkan memproses data
*/

//-------------------------------------------------------------------------
function f_hapusjurnal($Periode, $NomorTransaksi, $Rekening, $Keterangan) {

//-------------------------------------------------------------------------
	$q = "
		delete from t10_jurnal where
			Periode = '".$Periode."' and
			NomorTransaksi = '".$NomorTransaksi."' and
			Rekening = '".$Rekening."' and
			Keterangan = '".$Keterangan."'
		"; //echo $q; //exit;
	Conn()->Execute($q); 
}

//-------------------------------------------------------------------------
function f_buatjurnal($Periode, $NomorTransaksi, $Rekening, $Debet, $Kredit, $Keterangan) {
	$q = "
		insert into t10_jurnal (
			Tanggal,
			Periode,
			NomorTransaksi,
			Rekening,
			Debet,
			Kredit,
			Keterangan
		) values (
			'".date("Y-m-d")."',
			'".$Periode."',
			'".$NomorTransaksi."',
			'".$Rekening."',
			".$Debet.",
			".$Kredit.",
			'".$Keterangan."'
		)
	"; //echo $q; exit;
	Conn()->Execute($q);
}

function f_buat_jurnal_manual($rsnew) {
	$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '01'");
	$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '01'");
	$q = "
		insert into t10_jurnal (
			Tanggal,
			Periode,
			NomorTransaksi,
			Rekening,
			Debet,
			Kredit,
			Keterangan
		) values (
			'".date("Y-m-d")."',
			'".$rsnew["Periode"]."',
			'".$rsnew["Kontrak_No"]."',
			'".$rekdebet."',
			".$rsnew["Pinjaman"].",
			0,
			'Pinjaman No. Kontrak ".$rsnew["Kontrak_No"]."'
		)
	";
	Conn()->Execute($q);
	$q = "
		insert into t10_jurnal (
			Tanggal,
			Periode,
			NomorTransaksi,
			Rekening,
			Debet,
			Kredit,
			Keterangan
		) values (
			'".date("Y-m-d")."',
			'".$rsnew["Periode"]."',
			'".$rsnew["Kontrak_No"]."',
			'".$rekkredit."',
			0,
			".$rsnew["Pinjaman"].",
			'Pinjaman No. Kontrak ".$rsnew["Kontrak_No"]."'
		)
	";
	Conn()->Execute($q);
}

function f_simpan_jurnal_transaksi($rsnew) {
	$rekdebet  = ew_ExecuteScalar("select KodeRekening from t90_rektran where KodeTransaksi = '00'");
	$rekkredit = ew_ExecuteScalar("select KodeRekening from t90_rektran where KodeTransaksi = '10'");
	$biaya = $rsnew["Biaya_Administrasi"] + $rsnew["Biaya_Materai"];
	$q = "
		insert into t09_jurnaltransaksi (
		pinjaman_id,
		tanggal,
		periode,
		model,
		rekening,
		credit,
		pinjaman_,
		biaya_,
		keterangan
		) values (
		".$rsnew["id"].",
		'".date("Y-m-d H:i:s")."',
		'".$rsnew["Periode"]."',
		'".$rekdebet."',
		'".$rekkredit."',
		".$rsnew["Pinjaman"].",
		".$rsnew["Pinjaman"].",
		".$biaya.",
		'Pinjaman Kontrak No. ".$rsnew["Kontrak_No"]."'
		)
	"; //echo $q; exit;
	Conn()->Execute($q);
}

function f_update_saldo_titipan($pinjaman_id) { // -----------------------------------------
	$q = "select * from t06_pinjamantitipan where pinjaman_id = ".$pinjaman_id."
		order by id";
	$r = Conn()->Execute($q);
	$saldo = 0;
	$Angsuran_Ke = 0;
	while (!$r->EOF) {
		$Angsuran_Ke = $r->fields["Angsuran_Ke"];
		$saldo = $saldo + $r->fields["Masuk"] - $r->fields["Keluar"];
		$q = "update t06_pinjamantitipan set Sisa = ".$saldo." where id = ".$r->fields["id"]."";
		Conn()->Execute($q);
		$r->MoveNext();
	}
	/*if ($saldo > 0) {

		// kodetransaksi = 07
		$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '07'");
		$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '07'");
		f_buatjurnal($GLOBALS["Periode"], $Kontrak_No.".TS", $rekdebet, $saldo, 0, "Titipan Sisa Angsuran ke ".$Angsuran_Ke." No. Kontrak ".$Kontrak_No);
		f_buatjurnal($GLOBALS["Periode"], $Kontrak_No.".TS", $rekkredit, 0, $saldo, "Titipan Sisa Angsuran ke ".$Angsuran_Ke." No. Kontrak ".$Kontrak_No);
	}*/
} // end of function f_update_saldo_titipan ------------------------------------------------

function f_cari_saldo_titipan($pinjaman_id) { // -------------------------------------------
	$saldo_titipan = 0;
	$q = "select Sisa from t06_pinjamantitipan where pinjaman_id = ".$pinjaman_id."
		order by id desc";
	$r = Conn()->Execute($q);
	if (!$r->EOF) {
		$saldo_titipan = $r->fields["Sisa"];
	}
	return $saldo_titipan;
} // end of function f_cari_saldo_titipan --------------------------------------------------

function f_cari_detail_angsuran($pinjaman_id) { // -----------------------------------------
	$q = "
		select
			*
		from
			t04_pinjamanangsurantemp
		where
			pinjaman_id = ".$pinjaman_id."
			and Periode is not null
		order by
			id desc
		";
	$r = Conn()->Execute($q);
	$Angsuran_Ke = 0;
	if ($r->EOF) { // belum ada data ber-Periode
		$Angsuran_Ke = 1;

		//return $Angsuran_Ke;
	}
	else {

		// sudah ada data ber-Periode
		$Periode = $r->fields["Periode"];

		// bandingkan data Periode yang ada di database dengan data Periode berjalan
		if ($r->fields["Periode"] == $GLOBALS["Periode"]) {

			// data Periode di database masih pada Periode berjalan
			$Angsuran_Ke = $r->fields["Angsuran_Ke"];

			//return $Angsuran_Ke; //$r->fields["Angsuran_Ke"];
		}
		else {

			// data Periode di database sudah tidak sama dengan Periode berjalan
			$Angsuran_Ke = ++$r->fields["Angsuran_Ke"];

			//return $Angsuran_Ke;
		}
	}
	$t04_pinjamanangsurantemp_id = 0;
	$q = "select id from t04_pinjamanangsurantemp where pinjaman_id = ".
		$pinjaman_id." and Angsuran_Ke = ".$Angsuran_Ke."";
	$t04_pinjamanangsurantemp_id = ew_ExecuteScalar($q);
	return $t04_pinjamanangsurantemp_id;
} // end of function f_cari_detail_angsuran ------------------------------------------------

function f_create_rincian_angsuran($rsnew) { // --------------------------------------------

	// create data rincian angsuran
	$pinjaman_id      = $rsnew["id"];
	$Angsuran_Tanggal = $rsnew["Kontrak_Tgl"];
	$Angsuran_Tgl     = substr($Angsuran_Tanggal, -2);
	$Angsuran_Pokok   = $rsnew["Angsuran_Pokok"];
	$Angsuran_Bunga   = $rsnew["Angsuran_Bunga"];
	$Angsuran_Total   = $Angsuran_Pokok + $Angsuran_Bunga;
	$Sisa_Hutang      = $rsnew["Pinjaman"];
	$Angsuran_Pokok_Total = 0;
	$Angsuran_Bunga_Total = 0;
	$Angsuran_Total_Grand = 0;

	//for ($i; $i <= 12; $i++) {
	for ($Angsuran_Ke = 1; $Angsuran_Ke <= $rsnew["Angsuran_Lama"]; $Angsuran_Ke++) {
		$Angsuran_Tanggal      = f_create_tanggal_angsuran($Angsuran_Tanggal, $Angsuran_Tgl);
		$Angsuran_Pokok_Total += $Angsuran_Pokok;
		if ($Angsuran_Pokok_Total >= $rsnew["Pinjaman"]) {
			$Angsuran_Pokok       = $Angsuran_Pokok - ($Angsuran_Pokok_Total - $rsnew["Pinjaman"]);
			$Angsuran_Pokok_Total = $Angsuran_Pokok_Total - ($Angsuran_Pokok_Total - $rsnew["Pinjaman"]);
		}
		$Sisa_Hutang          -= $Angsuran_Pokok;
		$Angsuran_Bunga        = $Angsuran_Total - $Angsuran_Pokok;
		$Angsuran_Bunga_Total += $Angsuran_Bunga;
		$Angsuran_Total_Grand += $Angsuran_Total;
		$q = "insert into t04_pinjamanangsurantemp (
			pinjaman_id,
			Angsuran_Ke,
			Angsuran_Tanggal,
			Angsuran_Pokok,
			Angsuran_Bunga,
			Angsuran_Total,
			Sisa_Hutang
			) values (
			'".$pinjaman_id."',
			'".$Angsuran_Ke."',
			'".$Angsuran_Tanggal."',
			".$Angsuran_Pokok.",
			".$Angsuran_Bunga.",
			".$Angsuran_Total.",
			".$Sisa_Hutang."
			)";
		ew_Execute($q);
	}
} // end of function f_create_rincian_angsuran ---------------------------------------------

function f_create_tanggal_angsuran($sTanggal, $sTgl) { // ----------------------------------
	$akhir_bulan = 0;
	$dBln2829 = array(2);
	$dBln30 = array(4, 6, 9, 11);
	$dBln31 = array(1, 3, 5, 7, 8, 10, 12);

	//$dTgl = date("j", strtotime($sTanggal));
	$dTgl = $sTgl; //date("j", strtotime($sTanggal));
	$dBln = date("n", strtotime($sTanggal));
	$dThn = date("Y", strtotime($sTanggal));

	// check apakah bulan kontrak adalah desember
	if  ($dBln == 12) {
		$dBln = "01";
		$dThn++;
	}
	else {
		$dBln++;
	}
	if ($dTgl >= 1 and $dTgl <= 27) {
	}
	else {
		if (($dTgl == 28 or $dTgl == 29) and in_array($dBln, $dBln2829)) {
			$akhir_bulan = 1;
		}
		elseif ($dTgl == 30 and in_array($dBln, $dBln30)) {
			$akhir_bulan = 1;
		}
		elseif ($dTgl == 31 and in_array($dBln, $dBln31)) {
			$akhir_bulan = 1;
		}
	}
	if ($akhir_bulan == 0) { //$akhir_bulan = 0 (bukan tanggal akhir bulan)
		do {
			$hasil_check = checkdate(
				substr("00".$dBln, -2),
				substr("00".$dTgl, -2),
				$dThn
				);
			$sTanggalAngsuran = $dThn . "-" . substr("00".$dBln, -2) . "-" . substr("00".$dTgl, -2);
			/*echo substr("00".$dBln, -2).substr("00".$dTgl, -2).$dThn;
			echo " - ";
			echo $hasil_check;
			echo "<br/>";*/
			$dTgl--;
		}
		while ($hasil_check == false);
	}
	else { //$akhir_bulan = 1;
		$sTanggalAngsuran = $dThn . "-" . substr("00".$dBln, -2) . "-" . date("t", mktime(0, 0, 0, $dBln, 1, $dThn));
	}

	//echo $akhir_bulan;
	return $sTanggalAngsuran;
} // end of function f_create_tanggal_angsuran ---------------------------------------------
?>
