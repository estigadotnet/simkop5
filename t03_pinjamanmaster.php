<?php

// Kontrak_No
// Kontrak_Tgl
// nasabah_id
// jaminan_id
// Pinjaman
// Angsuran_Lama
// Angsuran_Bunga_Prosen
// Angsuran_Denda
// Dispensasi_Denda
// Angsuran_Pokok
// Angsuran_Bunga
// Angsuran_Total
// No_Ref
// Biaya_Administrasi
// Biaya_Materai
// marketing_id

?>
<?php if ($t03_pinjaman->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t03_pinjaman->TableCaption() ?></h4> -->
<table id="tbl_t03_pinjamanmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t03_pinjaman->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
		<tr id="r_Kontrak_No">
			<td><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Kontrak_No->CellAttributes() ?>>
<span id="el_t03_pinjaman_Kontrak_No">
<span<?php echo $t03_pinjaman->Kontrak_No->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_No->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<tr id="r_Kontrak_Tgl">
			<td><?php echo $t03_pinjaman->Kontrak_Tgl->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Kontrak_Tgl->CellAttributes() ?>>
<span id="el_t03_pinjaman_Kontrak_Tgl">
<span<?php echo $t03_pinjaman->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
		<tr id="r_nasabah_id">
			<td><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_nasabah_id">
<span<?php echo $t03_pinjaman->nasabah_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->nasabah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->jaminan_id->Visible) { // jaminan_id ?>
		<tr id="r_jaminan_id">
			<td><?php echo $t03_pinjaman->jaminan_id->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->jaminan_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_jaminan_id">
<span<?php echo $t03_pinjaman->jaminan_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->jaminan_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
		<tr id="r_Pinjaman">
			<td><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el_t03_pinjaman_Pinjaman">
<span<?php echo $t03_pinjaman->Pinjaman->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Pinjaman->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
		<tr id="r_Angsuran_Lama">
			<td><?php echo $t03_pinjaman->Angsuran_Lama->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Lama->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Lama">
<span<?php echo $t03_pinjaman->Angsuran_Lama->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Lama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
		<tr id="r_Angsuran_Bunga_Prosen">
			<td><?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Bunga_Prosen">
<span<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
		<tr id="r_Angsuran_Denda">
			<td><?php echo $t03_pinjaman->Angsuran_Denda->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Denda">
<span<?php echo $t03_pinjaman->Angsuran_Denda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Denda->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
		<tr id="r_Dispensasi_Denda">
			<td><?php echo $t03_pinjaman->Dispensasi_Denda->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Dispensasi_Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Dispensasi_Denda">
<span<?php echo $t03_pinjaman->Dispensasi_Denda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Dispensasi_Denda->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<tr id="r_Angsuran_Pokok">
			<td><?php echo $t03_pinjaman->Angsuran_Pokok->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Pokok->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Pokok">
<span<?php echo $t03_pinjaman->Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Pokok->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<tr id="r_Angsuran_Bunga">
			<td><?php echo $t03_pinjaman->Angsuran_Bunga->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Bunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Bunga">
<span<?php echo $t03_pinjaman->Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Bunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<tr id="r_Angsuran_Total">
			<td><?php echo $t03_pinjaman->Angsuran_Total->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Angsuran_Total->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Total">
<span<?php echo $t03_pinjaman->Angsuran_Total->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Total->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->No_Ref->Visible) { // No_Ref ?>
		<tr id="r_No_Ref">
			<td><?php echo $t03_pinjaman->No_Ref->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->No_Ref->CellAttributes() ?>>
<span id="el_t03_pinjaman_No_Ref">
<span<?php echo $t03_pinjaman->No_Ref->ViewAttributes() ?>>
<?php echo $t03_pinjaman->No_Ref->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
		<tr id="r_Biaya_Administrasi">
			<td><?php echo $t03_pinjaman->Biaya_Administrasi->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Biaya_Administrasi->CellAttributes() ?>>
<span id="el_t03_pinjaman_Biaya_Administrasi">
<span<?php echo $t03_pinjaman->Biaya_Administrasi->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Biaya_Administrasi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Biaya_Materai->Visible) { // Biaya_Materai ?>
		<tr id="r_Biaya_Materai">
			<td><?php echo $t03_pinjaman->Biaya_Materai->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Biaya_Materai->CellAttributes() ?>>
<span id="el_t03_pinjaman_Biaya_Materai">
<span<?php echo $t03_pinjaman->Biaya_Materai->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Biaya_Materai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->marketing_id->Visible) { // marketing_id ?>
		<tr id="r_marketing_id">
			<td><?php echo $t03_pinjaman->marketing_id->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->marketing_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_marketing_id">
<span<?php echo $t03_pinjaman->marketing_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->marketing_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
