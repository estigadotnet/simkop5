<?php if (@$gsExport == "") { ?>
<?php if (@!$gbSkipHeaderFooter) { ?>
				<!-- right column (end) -->
				<?php if (isset($gTimer)) $gTimer->Stop() ?>
			</div>
		</div>
	</div>
	<!-- content (end) -->
	<!-- footer (begin) --><!-- ** Note: Only licensed users are allowed to remove or change the following copyright statement. ** -->
	<div id="ewFooterRow" class="ewFooterRow">	
		<div class="ewFooterText"><?php echo $Language->ProjectPhrase("FooterText") ?></div>
		<!-- Place other links, for example, disclaimer, here -->		
	</div>
	<!-- footer (end) -->	
</div>
<?php } ?>
<!-- modal dialog -->
<div id="ewModalDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- modal lookup dialog -->
<div id="ewModalLookupDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("MessageOK") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
jQuery.get("<?php echo $EW_RELATIVE_PATH ?>phpjs/userevt13.js");
</script>
<script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");

	$('input[name=x_Kontrak_Tgl]').on(
		{'change': function(e)
			{
				f_hitung_jatuh_tempo();
			}
		}
	);
	$('input[name=x_Kontrak_Lama]').on(
		{'change': function(e)
			{
				f_hitung_jatuh_tempo();
			}
		}
	);

	function f_hitung_jatuh_tempo() {

		//var kontrak_tgl = $("x_Kontrak_Tgl").val();
		//var kontrak_lama = parseInt($("x_Kontrak_Lama").val());
		// var date = new Date($("#x_Kontrak_Tgl").val());

		var date = new Date(
			$("#x_Kontrak_Tgl").val().substring(6,10),
			$("#x_Kontrak_Tgl").val().substring(3,5) - 1,
			$("#x_Kontrak_Tgl").val().substring(0,2)
			);

		//alert(date);
		//alert(new Date(2019, 6, 30, 0, 0, 0, 0));

		var lastDay = new Date(date.getFullYear(), date.getMonth() + parseInt($("#x_Kontrak_Lama").val()), date.getDate());
		lastMonth = ( (lastDay.getMonth() + 1) < 10) ? '0' + (lastDay.getMonth() + 1) : (lastDay.getMonth() + 1);
		lastDate = ( lastDay.getDate() < 10 ) ? '0' + lastDay.getDate() : lastDay.getDate();

		//var newDate =  lastDay.getFullYear() + EW_DATE_SEPARATOR + lastMonth + EW_DATE_SEPARATOR + lastDate;
		var newDate =  lastDate + EW_DATE_SEPARATOR + lastMonth + EW_DATE_SEPARATOR + lastDay.getFullYear();
		if (isNaN(lastMonth) == false) $("#x_Jatuh_Tempo_Tgl").val(newDate);
	}

	// Table 't23_deposito' Field 'Deposito'
	$('[data-table=t23_deposito][data-field=x_Deposito]').on(
		{
			'change': function (e) {
				var $row = $(this).fields();

				// f_terbilang($row["Jumlah_Deposito"].val(), "x_Jumlah_Terbilang");
				f_hitung_bunga_2();
			}
		}
	);

	function f_hitung_bunga_2() {
		var jumlah_deposito = parseFloat($("#x_Deposito").val());
		var suku_bunga = parseFloat($("#x_Bunga_Suku").val());
		var jumlah_bunga = ((suku_bunga / 12) / 100) * jumlah_deposito;

		//eval('var '+$('#x_Jumlah_Bunga').autoNumeric('getString'));
		$("#x_Bunga").val(jumlah_bunga);

		//$("#x_Jumlah_Bunga").autoNumeric('update');
	}

	// Table 't23_deposito' Field 'Bunga_Suku'
	$('[data-table=t23_deposito][data-field=x_Bunga_Suku]').on(
		{
			'change': function (e) {
				var $row = $(this).fields();

				//f_terbilang($row["Jumlah_Deposito"].val(), "x_Jumlah_Terbilang");
				f_hitung_bunga_2();
			}
		}
	);

	function f_hitung_bunga() {
		var jumlah_deposito = parseFloat($("#x_Jumlah_Deposito").val());
		var suku_bunga = parseFloat($("#x_Suku_Bunga").val());
		var jumlah_bunga = ((suku_bunga / 12) / 100) * jumlah_deposito;

		//eval('var '+$('#x_Jumlah_Bunga').autoNumeric('getString'));
		$("#x_Jumlah_Bunga").val(jumlah_bunga);

		//$("#x_Jumlah_Bunga").autoNumeric('update');
	}

	// Table 't20_deposito' Field 'Jumlah Deposito'
	$('[data-table=t20_deposito][data-field=x_Jumlah_Deposito]').on(
		{
			'change': function (e) {
				var $row = $(this).fields();
				f_terbilang($row["Jumlah_Deposito"].val(), "x_Jumlah_Terbilang");
				f_hitung_bunga();
			}
		}
	);

	// Table 't20_deposito' Field 'Suku Bunga'
	$('[data-table=t20_deposito][data-field=x_Suku_Bunga]').on(
		{
			'change': function (e) {
				var $row = $(this).fields();

				//f_terbilang($row["Jumlah_Deposito"].val(), "x_Jumlah_Terbilang");
				f_hitung_bunga();
			}
		}
	);

	function f_terbilang(bilanganx, terbilangx){
	var bilangan=bilanganx; /* document.getElementById("nominal").value; */
	var kalimat="";
	var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
	var panjang_bilangan = bilangan.length;

	/* pengujian panjang bilangan */
	if(panjang_bilangan > 15){
		kalimat = "Diluar Batas";
	}else{

		/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
		for(i = 1; i <= panjang_bilangan; i++) {
			angka[i] = bilangan.substr(-(i),1);
		}
		var i = 1;
		var j = 0;

		/* mulai proses iterasi terhadap array angka */
		while(i <= panjang_bilangan){
			subkalimat = "";
			kata1 = "";
			kata2 = "";
			kata3 = "";

			/* untuk Ratusan */
			if(angka[i+2] != "0"){
				if(angka[i+2] == "1"){
					kata1 = "Seratus";
				}else{
					kata1 = kata[angka[i+2]] + " Ratus";
				}
			}

			/* untuk Puluhan atau Belasan */
			if(angka[i+1] != "0"){
				if(angka[i+1] == "1"){
					if(angka[i] == "0"){
						kata2 = "Sepuluh";
					}else if(angka[i] == "1"){
						kata2 = "Sebelas";
					}else{
						kata2 = kata[angka[i]] + " Belas";
					}
				}else{
					kata2 = kata[angka[i+1]] + " Puluh";
				}
			}

			/* untuk Satuan */
			if (angka[i] != "0"){
				if (angka[i+1] != "1"){
					kata3 = kata[angka[i]];
				}
			}

			/* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
			if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
				subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
			}

			/* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
			kalimat = subkalimat + kalimat;
			i = i + 3;
			j = j + 1;
		}

		/* mengganti Satu Ribu jadi Seribu jika diperlukan */
		if ((angka[5] == "0") && (angka[6] == "0")){
			kalimat = kalimat.replace("Satu Ribu","Seribu");
		}
	}
	kalimat = kalimat + " Rupiah";
	document.getElementById(terbilangx).innerHTML=kalimat;
	};

	function f_hitung(xparam) {
		eval('var '+$('#x_Total_Denda').autoNumeric('getString'));
		eval('var '+$('#x_Bayar_Titipan').autoNumeric('getString'));
		eval('var '+$('#x_Bayar_Non_Titipan').autoNumeric('getString'));
		eval('var '+$('#x_Angsuran_Total').autoNumeric('getString'));
		if (xparam == "Terlambat") {
			var int_terlambat = parseInt($('#x_Terlambat').val());
			var dispensasi_denda = parseInt('<?php echo ew_ExecuteScalar("select Dispensasi_Denda from t03_pinjaman where id = ".(is_null($_SESSION["pinjaman_id"]) ? 0 : $_SESSION["pinjaman_id"])."");?>');
			var angsuran_denda = parseFloat('<?php echo ew_ExecuteScalar("select Angsuran_Denda from t03_pinjaman where id = ".(is_null($_SESSION["pinjaman_id"]) ? 0 : $_SESSION["pinjaman_id"])."");?>');
			x_Total_Denda = 0;
			if (int_terlambat > dispensasi_denda) {
				x_Total_Denda =
					(angsuran_denda *
					x_Angsuran_Total *
					int_terlambat) / 100;
			}
			$("#x_Total_Denda").val(x_Total_Denda);
			$("#x_Total_Denda").autoNumeric('update');
		}
		else if (xparam == "Bayar_Titipan") {
			x_Bayar_Non_Titipan = x_Angsuran_Total - x_Bayar_Titipan
			$("#x_Bayar_Non_Titipan").val(x_Bayar_Non_Titipan);
			$("#x_Bayar_Non_Titipan").autoNumeric('update');
		}
		var bayar_total = x_Total_Denda + x_Bayar_Titipan + x_Bayar_Non_Titipan;
		$("#x_Bayar_Total").val(bayar_total);
		$("#x_Bayar_Total").autoNumeric('update');
	};

	// Table 't03_pinjaman' Field 'Pinjaman'
	$('[data-table=t03_pinjaman][data-field=x_Pinjaman]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["Angsuran_Lama"].val());
				var bunga = parseFloat($row["Angsuran_Bunga_Prosen"].val());
				var pinjaman_metode = '<?php echo $_SESSION["pinjaman_metode"] ?>';
				if (pinjaman_metode == "Bunga") {
					var angsuran_pokok = pinjaman;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = pinjaman + (lama_angsuran * angsuran_bunga);
				}
				else {
					var angsuran_pokok = pinjaman / lama_angsuran;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = angsuran_pokok + angsuran_bunga;
				}
				$row["Angsuran_Pokok"].val(angsuran_pokok);
				$row["Angsuran_Bunga"].val(angsuran_bunga);
				$row["Angsuran_Total"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'Angsuran_Lama'
	$('[data-table=t03_pinjaman][data-field=x_Angsuran_Lama]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["Angsuran_Lama"].val());
				var bunga = parseFloat($row["Angsuran_Bunga_Prosen"].val());
				var pinjaman_metode = '<?php echo $_SESSION["pinjaman_metode"] ?>';
				if (pinjaman_metode == "Bunga") {
					var angsuran_pokok = pinjaman;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = pinjaman + (lama_angsuran * angsuran_bunga);
				}
				else {
					var angsuran_pokok = pinjaman / lama_angsuran;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = angsuran_pokok + angsuran_bunga;
				}
				$row["Angsuran_Pokok"].val(angsuran_pokok);
				$row["Angsuran_Bunga"].val(angsuran_bunga);
				$row["Angsuran_Total"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'Angsuran_Bunga_Prosen'
	$('[data-table=t03_pinjaman][data-field=x_Angsuran_Bunga_Prosen]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["Angsuran_Lama"].val());
				var bunga = parseFloat($row["Angsuran_Bunga_Prosen"].val());
				var pinjaman_metode = '<?php echo $_SESSION["pinjaman_metode"] ?>';
				if (pinjaman_metode == "Bunga") {
					var angsuran_pokok = pinjaman;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = pinjaman + (lama_angsuran * angsuran_bunga);
				}
				else {
					var angsuran_pokok = pinjaman / lama_angsuran;
					var angsuran_bunga = pinjaman * (bunga / 100);
					var angsuran_total = angsuran_pokok + angsuran_bunga;
				}
				$row["Angsuran_Pokok"].val(angsuran_pokok);
				$row["Angsuran_Bunga"].val(angsuran_bunga);
				$row["Angsuran_Total"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'Angsuran_Pokok'
	$('[data-table=t03_pinjaman][data-field=x_Angsuran_Pokok]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var angsuran_pokok_asli = $row["Angsuran_Pokok"].val();
				var angsuran_pokok_clean = angsuran_pokok_asli.replace(/,/g, '');
				var angsuran_pokok = parseFloat(angsuran_pokok_clean);
				var angsuran_bunga_asli = $row["Angsuran_Bunga"].val();
				var angsuran_bunga_clean = angsuran_bunga_asli.replace(/,/g, '');
				var angsuran_bunga = parseFloat(angsuran_bunga_clean);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["Angsuran_Total"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'Angsuran_Bunga'
	$('[data-table=t03_pinjaman][data-field=x_Angsuran_Bunga]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var angsuran_pokok_asli = $row["Angsuran_Pokok"].val();
				var angsuran_pokok_clean = angsuran_pokok_asli.replace(/,/g, '');
				var angsuran_pokok = parseFloat(angsuran_pokok_clean);
				var angsuran_bunga_asli = $row["Angsuran_Bunga"].val();
				var angsuran_bunga_clean = angsuran_bunga_asli.replace(/,/g, '');
				var angsuran_bunga = parseFloat(angsuran_bunga_clean);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["Angsuran_Total"].val(angsuran_total);
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var bunga_asli = (angsuran_bunga / pinjaman) * 100;
				var bunga = bunga_asli.toFixed(2);
				$row["Angsuran_Bunga_Prosen"].val(bunga);
				var pinjaman_metode = '<?php echo $_SESSION["pinjaman_metode"] ?>';
				if (pinjaman_metode == "Bunga") {

					// var bunga = parseFloat($row["Angsuran_Bunga_Prosen"].val());
					var lama_angsuran = parseFloat($row["Angsuran_Lama"].val());

					// var angsuran_pokok = pinjaman;
					// var angsuran_bunga = pinjaman * (bunga / 100);

					var angsuran_total = pinjaman + (lama_angsuran * angsuran_bunga);
					$row["Angsuran_Total"].val(angsuran_total);
				}
			}
		}
	);

	// Table 't04_pinjamanangsurantemp' Field 'Tanggal_Bayar'
	$('[data-table=t04_pinjamanangsurantemp][data-field=x_Tanggal_Bayar]').on(
		{
			'change': function (e) {
				var $row = $(this).fields();
				if ( ($row["Angsuran_Tanggal"].val() != "") && ($row["Tanggal_Bayar"].val() != "") ) {
					var angsuran_tanggal = $row["Angsuran_Tanggal"].val();
					var angsuran_tanggal2 = angsuran_tanggal.split("-");
					var angsuran_tanggal3 = angsuran_tanggal2[1]+"/"+angsuran_tanggal2[2]+"/"+angsuran_tanggal2[0];
					var tanggal_bayar = $row["Tanggal_Bayar"].val();
					var tanggal_bayar2 = tanggal_bayar.split("-");
					var tanggal_bayar3 = tanggal_bayar2[1]+"/"+tanggal_bayar2[0]+"/"+tanggal_bayar2[2];
					var date_diff_indays = function(date1, date2) {
					dt1 = new Date(date1);
					dt2 = new Date(date2);
					return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
					}
					$row["Terlambat"].val(date_diff_indays(angsuran_tanggal3, tanggal_bayar3));
				}
				f_hitung("Terlambat");
			}
		}
	);

	// Table 't04_pinjamanangsurantemp' Field 'Terlambat'
	$('[data-table=t04_pinjamanangsurantemp][data-field=x_Terlambat]').on(
		{
			'change': function (e) {
				f_hitung("Terlambat");
			}
		}
	);

	// Table 't04_pinjamanangsurantemp' Field 'Total_Denda'
	$('[data-table=t04_pinjamanangsurantemp][data-field=x_Total_Denda], [data-table=t04_pinjamanangsurantemp][data-field=x_Bayar_Non_Titipan]').on(
		{
			'change': function (e) {
				f_hitung("x");
			}
		}
	);

	// Table 't04_pinjamanangsurantemp' Field 'Bayar_Titipan'
	$('[data-table=t04_pinjamanangsurantemp][data-field=x_Bayar_Titipan]').on(
		{
			'change': function (e) {
				f_hitung("Bayar_Titipan");
			}
		}
	);

	function format_koma(p_bilangan) {
	var bilangan = p_bilangan;
	var	reverse = bilangan.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join(',').split('').reverse().join('');

	// Cetak hasil	
	//document.write(ribuan); // Hasil: 23.456.789

	return ribuan;
	};
</script>
<?php } ?>
</body>
</html>
