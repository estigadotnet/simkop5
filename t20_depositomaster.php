<?php

// No_Urut
// Tanggal_Valuta
// Tanggal_Jatuh_Tempo
// nasabah_id
// Jumlah_Deposito
// Suku_Bunga
// Jumlah_Bunga

?>
<?php if ($t20_deposito->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t20_deposito->TableCaption() ?></h4> -->
<table id="tbl_t20_depositomaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t20_deposito->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
		<tr id="r_No_Urut">
			<td><?php echo $t20_deposito->No_Urut->FldCaption() ?></td>
			<td<?php echo $t20_deposito->No_Urut->CellAttributes() ?>>
<span id="el_t20_deposito_No_Urut">
<span<?php echo $t20_deposito->No_Urut->ViewAttributes() ?>>
<?php echo $t20_deposito->No_Urut->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
		<tr id="r_Tanggal_Valuta">
			<td><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?></td>
			<td<?php echo $t20_deposito->Tanggal_Valuta->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Valuta">
<span<?php echo $t20_deposito->Tanggal_Valuta->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Valuta->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
		<tr id="r_Tanggal_Jatuh_Tempo">
			<td><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?></td>
			<td<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Jatuh_Tempo">
<span<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<tr id="r_nasabah_id">
			<td><?php echo $t20_deposito->nasabah_id->FldCaption() ?></td>
			<td<?php echo $t20_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t20_deposito_nasabah_id">
<span<?php echo $t20_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t20_deposito->nasabah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
		<tr id="r_Jumlah_Deposito">
			<td><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?></td>
			<td<?php echo $t20_deposito->Jumlah_Deposito->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Deposito">
<span<?php echo $t20_deposito->Jumlah_Deposito->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Deposito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
		<tr id="r_Suku_Bunga">
			<td><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?></td>
			<td<?php echo $t20_deposito->Suku_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Suku_Bunga">
<span<?php echo $t20_deposito->Suku_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Suku_Bunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
		<tr id="r_Jumlah_Bunga">
			<td><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?></td>
			<td<?php echo $t20_deposito->Jumlah_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Bunga">
<span<?php echo $t20_deposito->Jumlah_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Bunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
