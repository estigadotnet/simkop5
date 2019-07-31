<?php

// Kontrak_No
// Kontrak_Tgl
// Kontrak_Lama
// Deposito
// Bunga_Suku
// Bunga
// nasabah_id

?>
<?php if ($t23_deposito->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t23_deposito->TableCaption() ?></h4> -->
<table id="tbl_t23_depositomaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t23_deposito->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
		<tr id="r_Kontrak_No">
			<td><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Kontrak_No->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_No">
<span<?php echo $t23_deposito->Kontrak_No->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_No->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<tr id="r_Kontrak_Tgl">
			<td><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Kontrak_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Tgl">
<span<?php echo $t23_deposito->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
		<tr id="r_Kontrak_Lama">
			<td><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Kontrak_Lama->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Lama">
<span<?php echo $t23_deposito->Kontrak_Lama->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Lama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
		<tr id="r_Deposito">
			<td><?php echo $t23_deposito->Deposito->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Deposito->CellAttributes() ?>>
<span id="el_t23_deposito_Deposito">
<span<?php echo $t23_deposito->Deposito->ViewAttributes() ?>>
<?php echo $t23_deposito->Deposito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
		<tr id="r_Bunga_Suku">
			<td><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Bunga_Suku->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Suku">
<span<?php echo $t23_deposito->Bunga_Suku->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Suku->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
		<tr id="r_Bunga">
			<td><?php echo $t23_deposito->Bunga->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Bunga->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga">
<span<?php echo $t23_deposito->Bunga->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<tr id="r_nasabah_id">
			<td><?php echo $t23_deposito->nasabah_id->FldCaption() ?></td>
			<td<?php echo $t23_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t23_deposito_nasabah_id">
<span<?php echo $t23_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t23_deposito->nasabah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
