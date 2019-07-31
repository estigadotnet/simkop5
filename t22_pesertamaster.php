<?php

// Nama
// No_Telp_Hp
// Pekerjaan
// Keterangan

?>
<?php if ($t22_peserta->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t22_peserta->TableCaption() ?></h4> -->
<table id="tbl_t22_pesertamaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t22_peserta->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t22_peserta->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td><?php echo $t22_peserta->Nama->FldCaption() ?></td>
			<td<?php echo $t22_peserta->Nama->CellAttributes() ?>>
<span id="el_t22_peserta_Nama">
<span<?php echo $t22_peserta->Nama->ViewAttributes() ?>>
<?php echo $t22_peserta->Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t22_peserta->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
		<tr id="r_No_Telp_Hp">
			<td><?php echo $t22_peserta->No_Telp_Hp->FldCaption() ?></td>
			<td<?php echo $t22_peserta->No_Telp_Hp->CellAttributes() ?>>
<span id="el_t22_peserta_No_Telp_Hp">
<span<?php echo $t22_peserta->No_Telp_Hp->ViewAttributes() ?>>
<?php echo $t22_peserta->No_Telp_Hp->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t22_peserta->Pekerjaan->Visible) { // Pekerjaan ?>
		<tr id="r_Pekerjaan">
			<td><?php echo $t22_peserta->Pekerjaan->FldCaption() ?></td>
			<td<?php echo $t22_peserta->Pekerjaan->CellAttributes() ?>>
<span id="el_t22_peserta_Pekerjaan">
<span<?php echo $t22_peserta->Pekerjaan->ViewAttributes() ?>>
<?php echo $t22_peserta->Pekerjaan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t22_peserta->Keterangan->Visible) { // Keterangan ?>
		<tr id="r_Keterangan">
			<td><?php echo $t22_peserta->Keterangan->FldCaption() ?></td>
			<td<?php echo $t22_peserta->Keterangan->CellAttributes() ?>>
<span id="el_t22_peserta_Keterangan">
<span<?php echo $t22_peserta->Keterangan->ViewAttributes() ?>>
<?php echo $t22_peserta->Keterangan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
