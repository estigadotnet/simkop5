<?php

// Kontrak_No
// Kontrak_Tgl
// nasabah_id
// jaminan_id
// Pinjaman
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
