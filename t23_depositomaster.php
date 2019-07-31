<?php

// Kontrak_No
// Kontrak_Tgl
// Kontrak_Lama
// Jatuh_Tempo_Tgl
// Deposito
// Bunga_Suku
// Bunga
// nasabah_id
// bank_id
// No_Ref
// Biaya_Administrasi
// Biaya_Materai
// Kontrak_Status
// Jatuh_Tempo_Status
// Bunga_Status

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
<?php if ($t23_deposito->Jatuh_Tempo_Tgl->Visible) { // Jatuh_Tempo_Tgl ?>
		<tr id="r_Jatuh_Tempo_Tgl">
			<td><?php echo $t23_deposito->Jatuh_Tempo_Tgl->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Jatuh_Tempo_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Tgl">
<span<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ListViewValue() ?></span>
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
<?php if ($t23_deposito->bank_id->Visible) { // bank_id ?>
		<tr id="r_bank_id">
			<td><?php echo $t23_deposito->bank_id->FldCaption() ?></td>
			<td<?php echo $t23_deposito->bank_id->CellAttributes() ?>>
<span id="el_t23_deposito_bank_id">
<span<?php echo $t23_deposito->bank_id->ViewAttributes() ?>>
<?php echo $t23_deposito->bank_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->No_Ref->Visible) { // No_Ref ?>
		<tr id="r_No_Ref">
			<td><?php echo $t23_deposito->No_Ref->FldCaption() ?></td>
			<td<?php echo $t23_deposito->No_Ref->CellAttributes() ?>>
<span id="el_t23_deposito_No_Ref">
<span<?php echo $t23_deposito->No_Ref->ViewAttributes() ?>>
<?php echo $t23_deposito->No_Ref->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
		<tr id="r_Biaya_Administrasi">
			<td><?php echo $t23_deposito->Biaya_Administrasi->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Biaya_Administrasi->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Administrasi">
<span<?php echo $t23_deposito->Biaya_Administrasi->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Administrasi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Biaya_Materai->Visible) { // Biaya_Materai ?>
		<tr id="r_Biaya_Materai">
			<td><?php echo $t23_deposito->Biaya_Materai->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Biaya_Materai->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Materai">
<span<?php echo $t23_deposito->Biaya_Materai->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Materai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Status->Visible) { // Kontrak_Status ?>
		<tr id="r_Kontrak_Status">
			<td><?php echo $t23_deposito->Kontrak_Status->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Kontrak_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Status">
<span<?php echo $t23_deposito->Kontrak_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Status->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Status->Visible) { // Jatuh_Tempo_Status ?>
		<tr id="r_Jatuh_Tempo_Status">
			<td><?php echo $t23_deposito->Jatuh_Tempo_Status->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Jatuh_Tempo_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Status">
<span<?php echo $t23_deposito->Jatuh_Tempo_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Status->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga_Status->Visible) { // Bunga_Status ?>
		<tr id="r_Bunga_Status">
			<td><?php echo $t23_deposito->Bunga_Status->FldCaption() ?></td>
			<td<?php echo $t23_deposito->Bunga_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Status">
<span<?php echo $t23_deposito->Bunga_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Status->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
