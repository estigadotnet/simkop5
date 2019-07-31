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

	$_SESSION["pinjaman_id"] = 0;
	$_SESSION["deposito_id"] = 0;
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

function f_caripembayaranbaru($deposito_id) { // -----------------------------------------
	$q = "
		select
			*
		from
			t24_deposito_detail
		where
			deposito_id = ".$deposito_id."
			and Periode is null
		order by
			id
		";
	$r = Conn()->Execute($q); //echo $q;
	$Pembayaran_Ke = 0;
	if ($r->EOF) { // belum ada data ber-Periode

		//$Angsuran_Ke = 1;
		//echo "1";
		//return $Angsuran_Ke;

	}
	else {

		//echo "2";
		// sudah ada data ber-Periode
		//$Periode = $r->fields["Periode"];
		// bandingkan data Periode yang ada di database dengan data Periode berjalan
		//if ($r->fields["Periode"] == $GLOBALS["Periode"]) {
			// data Periode di database masih pada Periode berjalan

			$Pembayaran_Ke = $r->fields["Pembayaran_Ke"];

			//return $Angsuran_Ke; //$r->fields["Angsuran_Ke"];
		//}
		//else {
			// data Periode di database sudah tidak sama dengan Periode berjalan
			//$Angsuran_Ke = ++$r->fields["Angsuran_Ke"];
			//return $Angsuran_Ke;
		//}

	}
	$t24_deposito_detail_id = 0;
	$q = "select id from t24_deposito_detail where deposito_id = ".
		$deposito_id." and Pembayaran_Ke = ".$Pembayaran_Ke."";
	$t24_deposito_detail_id = ew_ExecuteScalar($q); //echo $Angsuran_Ke." - "; exit;
	return $t24_deposito_detail_id;
} // end of function f_cariangsuranbaru ----------------------------------------------------

function f_create_tanggal_pembayaran($sTanggal, $sTgl) { // ----------------------------------
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

function f_create_rincian_pembayaran($rsnew) { // --------------------------------------------

	// create data rincian pembayaran
	$deposito_id = $rsnew["id"];
	$Bayar_Tgl   = $rsnew["Kontrak_Tgl"];
	$Bayar_Tgl2  = substr($Bayar_Tgl, -2);

	//for ($i; $i <= 12; $i++) {
	for ($Pembayaran_Ke = 1; $Pembayaran_Ke <= $rsnew["Kontrak_Lama"]; $Pembayaran_Ke++) {
		$Bayar_Tgl = f_create_tanggal_pembayaran($Bayar_Tgl, $Bayar_Tgl2);
		$q = "insert into t24_deposito_detail (
			deposito_id,
			Pembayaran_Ke,
			Bayar_Tgl,
			Bayar_Jumlah
			) values (
			'".$deposito_id."',
			'".$Pembayaran_Ke."',
			'".$Bayar_Tgl."',
			0
			)";
		ew_Execute($q);
	}
} // end of function f_create_rincian_pembayaran -------------------------------------------

function f_cari_detail_pembayaran($deposito_id) { // -----------------------------------------
	$q = "
		select
			*
		from
			t24_deposito_detail
		where
			deposito_id = ".$deposito_id."
			and Periode is not null
		order by
			id desc
		";
	$r = Conn()->Execute($q);
	$Pembayaran_Ke = 0;
	if ($r->EOF) { // belum ada data ber-Periode
		$Pembayaran_Ke = 1;

		//return $Angsuran_Ke;
	}
	else {

		// sudah ada data ber-Periode
		$Periode = $r->fields["Periode"];

		// bandingkan data Periode yang ada di database dengan data Periode berjalan
		if ($r->fields["Periode"] == $GLOBALS["Periode"]) {

			// data Periode di database masih pada Periode berjalan
			$Pembayaran_Ke = $r->fields["Pembayaran_Ke"];

			//return $Angsuran_Ke; //$r->fields["Angsuran_Ke"];
		}
		else {

			// data Periode di database sudah tidak sama dengan Periode berjalan
			$Pembayaran_Ke = ++$r->fields["Pembayaran_Ke"];

			//return $Angsuran_Ke;
		}
	}
	$t24_deposito_detail_id = 0;
	$q = "select id from t24_deposito_detail where deposito_id = ".
		$deposito_id." and Pembayaran_Ke = ".$Pembayaran_Ke."";
	$t24_deposito_detail_id = ew_ExecuteScalar($q);
	return $t24_deposito_detail_id;
} // end of function f_cari_detail_pembayaran ----------------------------------------------

function GetNextNoKontrakDepCopy($id) {
	$sNextNoKontrak = "";
	$sLastNoKontrak = "";
	$value = ew_ExecuteScalar("SELECT Kontrak_No FROM t23_deposito where id = ".$id." ORDER BY Kontrak_No DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$kode_terakhir = substr(rtrim($value, " "), -1);
		$value2 = substr($value, 0, 5);
		if ($kode_terakhir >= '0' and $kode_terakhir <= '9') {

			// berarti kode terakhir nomor kontrak bukan huruf
			$kode_terakhir = "B";
			$sNextNoKontrak = $value2 . $kode_terakhir;
		}
		else {
			switch($kode_terakhir) {
				case "B":
					$kode_terakhir = "C";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "C":
					$kode_terakhir = "D";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "D":
					$kode_terakhir = "E";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "E":
					$sLastNoKontrak = intval($value); // ambil 4 digit terakhir
					$sLastNoKontrak = intval($sLastNoKontrak) + 1; // konversi ke integer, lalu tambahkan satu
					$sNextNoKontrak = sprintf('%05s', $sLastNoKontrak); // format hasilnya dan tambahkan prefix
					if (strlen($sNextNoKontrak) > 5) {
						$sNextNoKontrak = "9999";
					}
					break;
			}
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$sNextNoKontrak = "00001";
	}
	return $sNextNoKontrak;
}

function GetNextNoKontrakDep() {
	$sNextNoKontrak = "";
	$sLastNoKontrak = "";
	$value = ew_ExecuteScalar("SELECT Kontrak_No FROM t23_deposito ORDER BY Kontrak_No DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastNoKontrak = intval($value); //intval(substr($value, 1, 4)); // ambil 4 digit terakhir
		$sLastNoKontrak = intval($sLastNoKontrak) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextNoKontrak = sprintf('%05s', $sLastNoKontrak); // format hasilnya dan tambahkan prefix
		if (strlen($sNextNoKontrak) > 5) {
			$sNextNoKontrak = "99999";
		}
	} else { // jika belum ada, gunakan kode yang pertama
		$sNextNoKontrak = "00001";
	}
	return $sNextNoKontrak;
}

function GetNextNoUrut() {
	$sNextNoUrut = "";
	$sLastNoUrut = "";
	$value = ew_ExecuteScalar("SELECT No_Urut FROM t20_deposito ORDER BY No_Urut DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastNoUrut = intval($value); //intval(substr($value, 1, 4)); // ambil 4 digit terakhir
		$sLastNoUrut = intval($sLastNoUrut) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextNoUrut = sprintf('%05s', $sLastNoUrut); // format hasilnya dan tambahkan prefix
		if (strlen($sNextNoUrut) > 5) {
			$sNextNoUrut = "99999";
		}
	} else { // jika belum ada, gunakan kode yang pertama
		$sNextNoUrut = "00001";
	}
	return $sNextNoUrut;
}

function GetNextNoKontrakCopy($id) {
	$sNextNoKontrak = "";
	$sLastNoKontrak = "";
	$value = ew_ExecuteScalar("SELECT Kontrak_No FROM t03_pinjaman where id = ".$id." ORDER BY Kontrak_No DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$kode_terakhir = substr(rtrim($value, " "), -1);
		$value2 = substr($value, 0, 5);
		if ($kode_terakhir >= '0' and $kode_terakhir <= '9') {

			// berarti kode terakhir nomor kontrak bukan huruf
			$kode_terakhir = "B";
			$sNextNoKontrak = $value2 . $kode_terakhir;
		}
		else {
			switch($kode_terakhir) {
				case "B":
					$kode_terakhir = "C";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "C":
					$kode_terakhir = "D";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "D":
					$kode_terakhir = "E";
					$sNextNoKontrak = $value2 . $kode_terakhir;
					break;
				case "E":
					$sLastNoKontrak = intval(substr($value, 1, 4)); // ambil 4 digit terakhir
					$sLastNoKontrak = intval($sLastNoKontrak) + 1; // konversi ke integer, lalu tambahkan satu
					$sNextNoKontrak = "6" . sprintf('%04s', $sLastNoKontrak); // format hasilnya dan tambahkan prefix
					if (strlen($sNextNoKontrak) > 5) {
						$sNextNoKontrak = "69999";
					}
					break;
			}
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$sNextNoKontrak = "60001";
	}
	return $sNextNoKontrak;
}

function f_periode($tanggal) {
	$periode = substr($tanggal, 0, 4).substr($tanggal, 5, 2);
	return $periode;
}

function f_hitungdenda($hari_terlambat) {
	$total_denda =
		($_SESSION["Angsuran_Denda"] *
		$_SESSION["Angsuran_Total"] *
		$hari_terlambat) / 100;
	return $total_denda;
}

function f_hitunglabarugiold2($periode) {
	$q = "select sum(kredit) - sum(debet) as LabaRugi from v42_labarugiold where
		periode = '".$periode."' ";
	$r = Conn()->Execute($q);
	$LabaRugi = $r->fields["LabaRugi"];
	return $LabaRugi;
}

function f_hitunglabarugi2($periode) {
	$q = "select sum(kredit) - sum(debet) as LabaRugi from v32_labarugi where
		periode = '".$periode."' ";
	$r = Conn()->Execute($q);
	$LabaRugi = $r->fields["LabaRugi"];
	return $LabaRugi;
}

function f_hitunglabarugi() {
	$q = "select * from t91_rekening where id = '3'";
	$r = Conn()->Execute($q);
	$q = "select * from t91_rekening where parent = '3' and tipe = 'DETAIL' order by id";
	$rdet = Conn()->Execute($q);
	$q = "select * from t91_rekening where id = '5'";
	$r2 = Conn()->Execute($q);
	$q = "select * from t91_rekening where parent = '5' and tipe = 'DETAIL' order by id";
	$rdet2 = Conn()->Execute($q);
	$q = "select * from t91_rekening where id = '4'";
	$r3 = Conn()->Execute($q);
	$q = "select * from t91_rekening where parent = '4' and tipe = 'DETAIL' order by id";
	$rdet3 = Conn()->Execute($q);
	$q = "select * from t91_rekening where id = '6'";
	$r4 = Conn()->Execute($q);
	$q = "select * from t91_rekening where parent = '6' and tipe = 'DETAIL' order by id";
	$rdet4 = Conn()->Execute($q);

	// id 3
	$mtotal = 0;
	while (!$rdet->EOF) {
		$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
			Rekening = '".$rdet->fields["id"]."'
			and Periode = '".$GLOBALS["Periode"]."'";
		$rhasil = Conn()->Execute($q);
		$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
		$mtotal += $nilai;
		$rdet->MoveNext();
	}

	// id 5
	while (!$rdet2->EOF) {
		$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
			Rekening = '".$rdet2->fields["id"]."'
			and Periode = '".$GLOBALS["Periode"]."'";
		$rhasil = Conn()->Execute($q);
		$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
		$mtotal += $nilai;
		$rdet2->MoveNext();
	}

	// id = 4
	$mtotal2 = 0;
	while (!$rdet3->EOF) {
		$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
			Rekening = '".$rdet3->fields["id"]."'
			and Periode = '".$GLOBALS["Periode"]."'";
		$rhasil = Conn()->Execute($q);
		$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
		$mtotal2 += $nilai;
		$rdet3->MoveNext();
	}

	// id = 6
	while (!$rdet4->EOF) {
		$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
			Rekening = '".$rdet4->fields["id"]."'
			and Periode = '".$GLOBALS["Periode"]."'";
		$rhasil = Conn()->Execute($q);
		$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
		$mtotal2 += $nilai;
		$rdet4->MoveNext();
	}
	$mshu = $mtotal - $mtotal2;
	return $mshu;
}

function GetNextNoKontrak() {
	$sNextNoKontrak = "";
	$sLastNoKontrak = "";
	$value = ew_ExecuteScalar("SELECT Kontrak_No FROM t03_pinjaman ORDER BY Kontrak_No DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastNoKontrak = intval(substr($value, 1, 4)); // ambil 4 digit terakhir
		$sLastNoKontrak = intval($sLastNoKontrak) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextNoKontrak = "6" . sprintf('%04s', $sLastNoKontrak); // format hasilnya dan tambahkan prefix
		if (strlen($sNextNoKontrak) > 5) {
			$sNextNoKontrak = "69999";
		}
	} else { // jika belum ada, gunakan kode yang pertama
		$sNextNoKontrak = "60001";
	}
	return $sNextNoKontrak;
}

function GetNextNomorTransaksi() {
	$sNextNomorTransaksi = "";
	$sLastNomorTransaksi = "";
	$value = ew_ExecuteScalar("SELECT NomorTransaksi FROM t10_jurnal where left(NomorTransaksi, 2) = 'JM' ORDER BY NomorTransaksi DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastNomorTransaksi = intval(substr($value, 2, 3)); // ambil 3 digit terakhir
		$sLastNomorTransaksi = intval($sLastNomorTransaksi) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextNomorTransaksi = "JM" . sprintf('%03s', $sLastNomorTransaksi); // format hasilnya dan tambahkan prefix
		if (strlen($sNextNomorTransaksi) > 5) {
			$sNextNomorTransaksi = "JM999";
		}
	} else { // jika belum ada, gunakan kode yang pertama
		$sNextNomorTransaksi = "JM001";
	}
	return $sNextNomorTransaksi;
}

function f_savetojurnal($rsnew) {

	// pindah ke tabel t10_jurnal
	$q = "insert into t10_jurnal (
			Periode,
			Tanggal,
			NomorTransaksi,
			Keterangan,
			Rekening,
			Debet,
			Kredit)
		select
			Periode,
			Tanggal,
			NomorTransaksi,
			Keterangan,
			Rekening,
			Debet,
			Kredit
		from
			v03_jurnalmemorial
		";
	Conn()->Execute($q);

	// hapus data di temporary
	$q = "delete from t11_jurnalmaster";
	Conn()->Execute($q);
	$q = "delete from t12_jurnaldetail";
	Conn()->Execute($q);
}

function f_cariangsuranbaru($pinjaman_id) { // -----------------------------------------
	$q = "
		select
			*
		from
			t04_pinjamanangsurantemp
		where
			pinjaman_id = ".$pinjaman_id."
			and Periode is null
		order by
			id
		";
	$r = Conn()->Execute($q); //echo $q;
	$Angsuran_Ke = 0;
	if ($r->EOF) { // belum ada data ber-Periode

		//$Angsuran_Ke = 1;
		//echo "1";
		//return $Angsuran_Ke;

	}
	else {

		//echo "2";
		// sudah ada data ber-Periode
		//$Periode = $r->fields["Periode"];
		// bandingkan data Periode yang ada di database dengan data Periode berjalan
		//if ($r->fields["Periode"] == $GLOBALS["Periode"]) {
			// data Periode di database masih pada Periode berjalan

			$Angsuran_Ke = $r->fields["Angsuran_Ke"];

			//return $Angsuran_Ke; //$r->fields["Angsuran_Ke"];
		//}
		//else {
			// data Periode di database sudah tidak sama dengan Periode berjalan
			//$Angsuran_Ke = ++$r->fields["Angsuran_Ke"];
			//return $Angsuran_Ke;
		//}

	}
	$t04_pinjamanangsurantemp_id = 0;
	$q = "select id from t04_pinjamanangsurantemp where pinjaman_id = ".
		$pinjaman_id." and Angsuran_Ke = ".$Angsuran_Ke."";
	$t04_pinjamanangsurantemp_id = ew_ExecuteScalar($q); //echo $Angsuran_Ke." - "; exit;
	return $t04_pinjamanangsurantemp_id;
} // end of function f_cariangsuranbaru ----------------------------------------------------

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
function f_buatjurnal($Periode, $NomorTransaksi, $Rekening, $Debet, $Kredit, $Keterangan, $pTanggal = null) {
	if (is_null($pTanggal)) {
		$pTanggal = date("Y-m-d");
	}
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
			'".$pTanggal."',
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
			'".$rsnew["Kontrak_Tgl"]."',
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
			'".$rsnew["Kontrak_Tgl"]."',
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
