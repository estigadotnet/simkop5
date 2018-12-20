<?php
$db =& DbHelper(); 
?>

<style>
.panel-heading a{
  display:block;
}

.panel-heading a.collapsed {
  background: url(http://upload.wikimedia.org/wikipedia/commons/3/36/Vector_skin_right_arrow.png) center right no-repeat;
}

.panel-heading a {
  background: url(http://www.useragentman.com/blog/wp-content/themes/useragentman/images/widgets/downArrow.png) center right no-repeat;
}
</style>

<?php
	$db =& DbHelper(); // Create instance of the database helper class by DbHelper() (for main database) or DbHelper("<dbname>") (for linked databases) where <dbname> is database variable name
?>


<!-- periode -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#periode">Periode</a></strong></div>
	<div id="periode" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<tr>
						<td><?php echo "Periode: ".ew_ExecuteScalar("select Bulan from t93_periode")." - ".ew_ExecuteScalar("select Tahun from t93_periode"); ?></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- jatuh tempo -->
<?php
$q = "
	select
		*
	from
		t04_pinjamanangsurantemp
	where 
		concat(year(Angsuran_Tanggal), right(concat('00',month(Angsuran_Tanggal)),2)) = '".$GLOBALS["Periode"]."' 
		and Tanggal_Bayar is null";
$q = "
	select
		a.*,
		b.Kontrak_No,
		c.Nama
	from
		t04_pinjamanangsurantemp a
		join t03_pinjaman b on a.pinjaman_id = b.id
		join t01_nasabah c on b.nasabah_id = c.id
	where 
		concat(year(Angsuran_Tanggal), right(concat('00',month(Angsuran_Tanggal)),2)) = '".$GLOBALS["Periode"]."' 
		and Tanggal_Bayar is null
";
$r = Conn()->Execute($q);
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#jatuh_tempo">Jatuh Tempo</a></strong></div>
	<div id="jatuh_tempo" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<tr>
						<th>No. Kontrak</th>
						<th>Nasabah</th>
						<th>Tgl. Jatuh Tempo</th>
						<th>Angsuran</th>
					</tr>
					<?php
					while (!$r->EOF) {
					?>
					<tr>
						<td><?php echo $r->fields["Kontrak_No"]; ?></td>
						<td><?php echo $r->fields["Nama"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($r->fields["Angsuran_Tanggal"])); ?></td>
						<td><?php echo number_format($r->fields["Angsuran_Total"], 2, ".", ","); ?></td>
					</tr>
					<?php
						$r->MoveNext();
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- log -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Progress Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div>
<pre><?php $lines=file('log.txt');foreach ($lines as $line_num => $line){echo $line;}?></pre>
			</div>
		</div>
	</div>
</div>


<!-- log -->
<!--<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Progress Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div>
				<p>&nbsp;</p>-->
				<!-- to do -->
				<!--<p><strong>to do</strong></p>
				<?php
				$q = "
					select
						a.index_,
						a.subj_,
						b.date_issued,
						b.desc_,
						b.date_solved
					from
						t94_log a
						left join t95_logdesc b on a.id = b.log_id
					where
						b.date_solved is null
					order by
						a.index_,
						b.date_issued
					";
				//echo $db->ExecuteHtml($q, array("fieldcaption" => TRUE, "tablename" => array("t94_log", "t95_logdesc")));
				$r = Conn()->Execute($q);
				?>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<?php
					while (!$r->EOF) {
						if ($r->fields["date_issued"] == null) {
							$r->MoveNext();
							continue;
							//break;
						}
						$index_ = $r->fields["index_"];
						?>
						<tr>
							<td colspan="4">[<?php echo $r->fields["subj_"]; ?>]</td>
						</tr>
						<?php
						while ($index_ == $r->fields["index_"]) {
							?>
							<tr>
								<td width="20">-</td>
								<td><?php echo $r->fields["desc_"];?></td>
								<td width="100"><?php echo $r->fields["date_issued"];?></td>
								<td width="100">&nbsp;</td>
							</tr>
							<?php
							$r->MoveNext();
						}
						if (!$r->EOF) {
							?>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<?php
						}
					}
					?>
					</tbody>
				</table>

				<p>&nbsp;</p>-->
				<!-- done -->
				<!--<p><strong>done</strong></p>
				<?php
				$q = "
					select
						a.index_,
						a.subj_,
						b.date_issued,
						b.desc_,
						b.date_solved
					from
						t94_log a
						left join t95_logdesc b on a.id = b.log_id
					where
						b.date_solved is not null
					order by
						a.index_,
						b.date_issued,
						b.date_solved
					";
				//echo $db->ExecuteHtml($q, array("fieldcaption" => TRUE, "tablename" => array("t94_log", "t95_logdesc")));
				$r = Conn()->Execute($q);
				?>
				<table class='table table-striped table-hover table-condensed'>
					<?php
					while (!$r->EOF) {
						$index_ = $r->fields["index_"];
						?>
						<tr>
							<td colspan="4">[<?php echo $r->fields["subj_"]; ?>]</td>
						</tr>
						<?php
						while ($index_ == $r->fields["index_"]) {
							?>
							<tr>
								<td width="20">-</td>
								<td><?php echo $r->fields["desc_"];?></td>
								<td width="100"><?php echo $r->fields["date_issued"];?></td>
								<td width="100"><?php echo $r->fields["date_solved"];?></td>
							</tr>
							<?php
							$r->MoveNext();
						}
						if (!$r->EOF) {
							?>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<?php
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>-->

<!-- log -->
<!-- <div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div> -->
<!-- <strong>to do:</strong><br/> -->
<!-- [pinjaman - angsuran]:<br/> -->
<!-- - ada tambahan kolom POTONGAN, mengurangi SISA HUTANG;<br/> -->
<!-- - setiap ada pembayaran menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;<br/> -->
<!-- - check jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN;<br/>&nbsp;<br/> -->

<!-- [aplikasi]:<br/>&nbsp;<br/> -->

<!-- <strong>done:</strong><br/> -->
<!-- [pinjaman]:<br/> -->
<!-- - tipe data nomor referensi diubah dari integer menjadi varchar;<br/>&nbsp;<br/> -->

<!-- [pinjaman - angsuran]:<br/> -->
<!-- - rumus [jumlah angsuran];<br/> -->
<!-- - button refresh detail angsuran;<br/> -->
<!-- - tambah field untuk transaksi pembayaran;<br/> -->
<!-- - perbesar kolom tanggal bayar;<br/>&nbsp;<br/> -->

<!-- [pinjaman - nasabah]:<br/> -->
<!-- - alamat nasabah harus diisi;<br/> -->
<!-- - melengkapi tampilan add nasabah di menu pinjaman;<br/>&nbsp;<br/> -->

<!-- [pinjaman - titipan]:<br/> -->
<!-- - menghilangkan nasabah_id di add jaminan pada proses input pinjaman;<br/> -->
<!-- - setelah input setoran titipan :: harus save dulu agar nilai saldo terupdate;<br/>&nbsp;<br/> -->

<!-- [aplikasi]:<br/> -->
<!-- - menghilangkan menu setup nasabah;<br/> -->
<!-- - buat CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm;<br/> -->
<!-- - log at home, List - User Log;<br/>&nbsp;<br/> -->
<!--			</div>
		</div>
	</div>
</div> -->

<!--
<div>
&copy;2018 Selaras Solusindo. All rights reserved.
</div>
-->