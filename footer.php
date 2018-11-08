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
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("MessageOK") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<script type="text/javascript">
jQuery.get("<?php echo $EW_RELATIVE_PATH ?>phpjs/userevt13.js");
</script>
<script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");
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
	}

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
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
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
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
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
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
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
	}
</script>
</body>
</html>
