<?php

// id
// Tanggal
// NomorTransaksi
// Keterangan

?>
<?php if ($t11_jurnalmaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t11_jurnalmaster->TableCaption() ?></h4> -->
<table id="tbl_t11_jurnalmastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t11_jurnalmaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t11_jurnalmaster->id->Visible) { // id ?>
		<tr id="r_id">
			<td><?php echo $t11_jurnalmaster->id->FldCaption() ?></td>
			<td<?php echo $t11_jurnalmaster->id->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_id">
<span<?php echo $t11_jurnalmaster->id->ViewAttributes() ?>>
<?php echo $t11_jurnalmaster->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jurnalmaster->Tanggal->Visible) { // Tanggal ?>
		<tr id="r_Tanggal">
			<td><?php echo $t11_jurnalmaster->Tanggal->FldCaption() ?></td>
			<td<?php echo $t11_jurnalmaster->Tanggal->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_Tanggal">
<span<?php echo $t11_jurnalmaster->Tanggal->ViewAttributes() ?>>
<?php echo $t11_jurnalmaster->Tanggal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jurnalmaster->NomorTransaksi->Visible) { // NomorTransaksi ?>
		<tr id="r_NomorTransaksi">
			<td><?php echo $t11_jurnalmaster->NomorTransaksi->FldCaption() ?></td>
			<td<?php echo $t11_jurnalmaster->NomorTransaksi->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_NomorTransaksi">
<span<?php echo $t11_jurnalmaster->NomorTransaksi->ViewAttributes() ?>>
<?php echo $t11_jurnalmaster->NomorTransaksi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jurnalmaster->Keterangan->Visible) { // Keterangan ?>
		<tr id="r_Keterangan">
			<td><?php echo $t11_jurnalmaster->Keterangan->FldCaption() ?></td>
			<td<?php echo $t11_jurnalmaster->Keterangan->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_Keterangan">
<span<?php echo $t11_jurnalmaster->Keterangan->ViewAttributes() ?>>
<?php echo $t11_jurnalmaster->Keterangan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
