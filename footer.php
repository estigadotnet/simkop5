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
				if ( ($row["Angsuran_Tanggal"].val() != "") && ($row["Tanggal_Bayar"].val() != "")) {
					var angsuran_tanggal = $row["Angsuran_Tanggal"].val();
					var angsuran_tanggal2 = angsuran_tanggal.split("-");
					var angsuran_tanggal3 = angsuran_tanggal2[1]+"/"+angsuran_tanggal2[2]+"/"+angsuran_tanggal2[0];
					var tanggal_bayar = $row["Tanggal_Bayar"].val();
					var tanggal_bayar2 = tanggal_bayar.split("-");
					var tanggal_bayar3 = tanggal_bayar2[1]+"/"+tanggal_bayar2[0]+"/"+tanggal_bayar2[2];

					//alert(angsuran_tanggal3); alert(tanggal_bayar3);
					var date_diff_indays = function(date1, date2) {
					dt1 = new Date(date1);
					dt2 = new Date(date2);
					return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
					}
					$row["Terlambat"].val(date_diff_indays(angsuran_tanggal3, tanggal_bayar3));
					var int_terlambat = parseInt($row["Terlambat"].val());

					//alert("int_terlambat: "+int_terlambat);
					// var dispensasi_denda = parseInt("<?php echo $GLOBALS['t03_pinjaman']->Dispensasi_Denda->CurrentValue?>");

					var dispensasi_denda = parseInt('<?php echo ew_ExecuteScalar("select Dispensasi_Denda from t03_pinjaman where id = ".$_SESSION["pinjaman_id"]."");?>');

					//alert("dispensasi_denda: "+dispensasi_denda);
					//var angsuran_denda = parseFloat('<?php echo $GLOBALS["t03_pinjaman"]->Angsuran_Denda->CurrentValue?>');

					var angsuran_denda = parseFloat('<?php echo $angsuran_denda = ew_ExecuteScalar("select Angsuran_Denda from t03_pinjaman where id = ".$_SESSION["pinjaman_id"]."");?>');

					//alert("angsuran_denda: "+angsuran_denda);
					var angsuran_total = $row["Angsuran_Total"].val();
					var angsuran_total2 = angsuran_total.replace(/,/g, '');
					var angsuran_total3 = parseFloat(angsuran_total2);

					//alert("angsuran_total: "+angsuran_total3);
					var total_denda = 0;
					if (int_terlambat > dispensasi_denda) {
						total_denda =
							(angsuran_denda *
							angsuran_total3 *
							int_terlambat) / 100;
					}
					$row["Total_Denda"].val(total_denda);
					var bayar_titipan = parseFloat($row["Bayar_Titipan"].val());

					//$bayar_titipan = f_carisaldotitipan($this->pinjaman_id->CurrentValue);
					//$this->Bayar_Titipan->EditValue = (is_null($this->Bayar_Titipan->CurrentValue) ? $bayar_titipan : $this->Bayar_Titipan->CurrentValue);

					var bayar_non_titipan = parseFloat($row["Bayar_Non_Titipan"].val());

					//$bayar_non_titipan = $bayar_total - $bayar_titipan;
					//$this->Bayar_Non_Titipan->EditValue = (is_null($this->Bayar_Non_Titipan->CurrentValue) ? $bayar_non_titipan : $this->Bayar_Non_Titipan->CurrentValue);

					var bayar_total = total_denda + bayar_titipan + bayar_non_titipan;

					//$bayar_total = $this->Angsuran_Total->CurrentValue;
					//$bayar_total = $total_denda + $bayar_titipan + $bayar_non_titipan;
					//$this->Bayar_Total->EditValue = (is_null($this->Bayar_Total->CurrentValue) ? $bayar_total : $this->Bayar_Total->CurrentValue);

					$row["Bayar_Total"].val(bayar_total);
				}
			}
		}
	);
</script>
</body>
</html>
