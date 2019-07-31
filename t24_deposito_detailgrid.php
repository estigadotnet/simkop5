<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t24_deposito_detail_grid)) $t24_deposito_detail_grid = new ct24_deposito_detail_grid();

// Page init
$t24_deposito_detail_grid->Page_Init();

// Page main
$t24_deposito_detail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t24_deposito_detail_grid->Page_Render();
?>
<?php if ($t24_deposito_detail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft24_deposito_detailgrid = new ew_Form("ft24_deposito_detailgrid", "grid");
ft24_deposito_detailgrid.FormKeyCountName = '<?php echo $t24_deposito_detail_grid->FormKeyCountName ?>';

// Validate form
ft24_deposito_detailgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_Pembayaran_Ke");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t24_deposito_detail->Pembayaran_Ke->FldCaption(), $t24_deposito_detail->Pembayaran_Ke->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pembayaran_Ke");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t24_deposito_detail->Pembayaran_Ke->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t24_deposito_detail->Bayar_Tgl->FldCaption(), $t24_deposito_detail->Bayar_Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t24_deposito_detail->Bayar_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t24_deposito_detail->Bayar_Jumlah->FldCaption(), $t24_deposito_detail->Bayar_Jumlah->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t24_deposito_detail->Bayar_Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft24_deposito_detailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "Pembayaran_Ke", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft24_deposito_detailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft24_deposito_detailgrid.ValidateRequired = true;
<?php } else { ?>
ft24_deposito_detailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t24_deposito_detail->CurrentAction == "gridadd") {
	if ($t24_deposito_detail->CurrentMode == "copy") {
		$bSelectLimit = $t24_deposito_detail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t24_deposito_detail_grid->TotalRecs = $t24_deposito_detail->SelectRecordCount();
			$t24_deposito_detail_grid->Recordset = $t24_deposito_detail_grid->LoadRecordset($t24_deposito_detail_grid->StartRec-1, $t24_deposito_detail_grid->DisplayRecs);
		} else {
			if ($t24_deposito_detail_grid->Recordset = $t24_deposito_detail_grid->LoadRecordset())
				$t24_deposito_detail_grid->TotalRecs = $t24_deposito_detail_grid->Recordset->RecordCount();
		}
		$t24_deposito_detail_grid->StartRec = 1;
		$t24_deposito_detail_grid->DisplayRecs = $t24_deposito_detail_grid->TotalRecs;
	} else {
		$t24_deposito_detail->CurrentFilter = "0=1";
		$t24_deposito_detail_grid->StartRec = 1;
		$t24_deposito_detail_grid->DisplayRecs = $t24_deposito_detail->GridAddRowCount;
	}
	$t24_deposito_detail_grid->TotalRecs = $t24_deposito_detail_grid->DisplayRecs;
	$t24_deposito_detail_grid->StopRec = $t24_deposito_detail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t24_deposito_detail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t24_deposito_detail_grid->TotalRecs <= 0)
			$t24_deposito_detail_grid->TotalRecs = $t24_deposito_detail->SelectRecordCount();
	} else {
		if (!$t24_deposito_detail_grid->Recordset && ($t24_deposito_detail_grid->Recordset = $t24_deposito_detail_grid->LoadRecordset()))
			$t24_deposito_detail_grid->TotalRecs = $t24_deposito_detail_grid->Recordset->RecordCount();
	}
	$t24_deposito_detail_grid->StartRec = 1;
	$t24_deposito_detail_grid->DisplayRecs = $t24_deposito_detail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t24_deposito_detail_grid->Recordset = $t24_deposito_detail_grid->LoadRecordset($t24_deposito_detail_grid->StartRec-1, $t24_deposito_detail_grid->DisplayRecs);

	// Set no record found message
	if ($t24_deposito_detail->CurrentAction == "" && $t24_deposito_detail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t24_deposito_detail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t24_deposito_detail_grid->SearchWhere == "0=101")
			$t24_deposito_detail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t24_deposito_detail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t24_deposito_detail_grid->RenderOtherOptions();
?>
<?php $t24_deposito_detail_grid->ShowPageHeader(); ?>
<?php
$t24_deposito_detail_grid->ShowMessage();
?>
<?php if ($t24_deposito_detail_grid->TotalRecs > 0 || $t24_deposito_detail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t24_deposito_detail">
<div id="ft24_deposito_detailgrid" class="ewForm form-inline">
<div id="gmp_t24_deposito_detail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t24_deposito_detailgrid" class="table ewTable">
<?php echo $t24_deposito_detail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t24_deposito_detail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t24_deposito_detail_grid->RenderListOptions();

// Render list options (header, left)
$t24_deposito_detail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t24_deposito_detail->Pembayaran_Ke->Visible) { // Pembayaran_Ke ?>
	<?php if ($t24_deposito_detail->SortUrl($t24_deposito_detail->Pembayaran_Ke) == "") { ?>
		<th data-name="Pembayaran_Ke"><div id="elh_t24_deposito_detail_Pembayaran_Ke" class="t24_deposito_detail_Pembayaran_Ke"><div class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Pembayaran_Ke->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pembayaran_Ke"><div><div id="elh_t24_deposito_detail_Pembayaran_Ke" class="t24_deposito_detail_Pembayaran_Ke">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Pembayaran_Ke->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t24_deposito_detail->Pembayaran_Ke->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t24_deposito_detail->Pembayaran_Ke->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t24_deposito_detail->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<?php if ($t24_deposito_detail->SortUrl($t24_deposito_detail->Bayar_Tgl) == "") { ?>
		<th data-name="Bayar_Tgl"><div id="elh_t24_deposito_detail_Bayar_Tgl" class="t24_deposito_detail_Bayar_Tgl"><div class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Bayar_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Tgl"><div><div id="elh_t24_deposito_detail_Bayar_Tgl" class="t24_deposito_detail_Bayar_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Bayar_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t24_deposito_detail->Bayar_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t24_deposito_detail->Bayar_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t24_deposito_detail->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t24_deposito_detail->SortUrl($t24_deposito_detail->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t24_deposito_detail_Bayar_Jumlah" class="t24_deposito_detail_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div><div id="elh_t24_deposito_detail_Bayar_Jumlah" class="t24_deposito_detail_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t24_deposito_detail->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t24_deposito_detail->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t24_deposito_detail->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t24_deposito_detail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t24_deposito_detail_grid->StartRec = 1;
$t24_deposito_detail_grid->StopRec = $t24_deposito_detail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t24_deposito_detail_grid->FormKeyCountName) && ($t24_deposito_detail->CurrentAction == "gridadd" || $t24_deposito_detail->CurrentAction == "gridedit" || $t24_deposito_detail->CurrentAction == "F")) {
		$t24_deposito_detail_grid->KeyCount = $objForm->GetValue($t24_deposito_detail_grid->FormKeyCountName);
		$t24_deposito_detail_grid->StopRec = $t24_deposito_detail_grid->StartRec + $t24_deposito_detail_grid->KeyCount - 1;
	}
}
$t24_deposito_detail_grid->RecCnt = $t24_deposito_detail_grid->StartRec - 1;
if ($t24_deposito_detail_grid->Recordset && !$t24_deposito_detail_grid->Recordset->EOF) {
	$t24_deposito_detail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t24_deposito_detail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t24_deposito_detail_grid->StartRec > 1)
		$t24_deposito_detail_grid->Recordset->Move($t24_deposito_detail_grid->StartRec - 1);
} elseif (!$t24_deposito_detail->AllowAddDeleteRow && $t24_deposito_detail_grid->StopRec == 0) {
	$t24_deposito_detail_grid->StopRec = $t24_deposito_detail->GridAddRowCount;
}

// Initialize aggregate
$t24_deposito_detail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t24_deposito_detail->ResetAttrs();
$t24_deposito_detail_grid->RenderRow();
if ($t24_deposito_detail->CurrentAction == "gridadd")
	$t24_deposito_detail_grid->RowIndex = 0;
if ($t24_deposito_detail->CurrentAction == "gridedit")
	$t24_deposito_detail_grid->RowIndex = 0;
while ($t24_deposito_detail_grid->RecCnt < $t24_deposito_detail_grid->StopRec) {
	$t24_deposito_detail_grid->RecCnt++;
	if (intval($t24_deposito_detail_grid->RecCnt) >= intval($t24_deposito_detail_grid->StartRec)) {
		$t24_deposito_detail_grid->RowCnt++;
		if ($t24_deposito_detail->CurrentAction == "gridadd" || $t24_deposito_detail->CurrentAction == "gridedit" || $t24_deposito_detail->CurrentAction == "F") {
			$t24_deposito_detail_grid->RowIndex++;
			$objForm->Index = $t24_deposito_detail_grid->RowIndex;
			if ($objForm->HasValue($t24_deposito_detail_grid->FormActionName))
				$t24_deposito_detail_grid->RowAction = strval($objForm->GetValue($t24_deposito_detail_grid->FormActionName));
			elseif ($t24_deposito_detail->CurrentAction == "gridadd")
				$t24_deposito_detail_grid->RowAction = "insert";
			else
				$t24_deposito_detail_grid->RowAction = "";
		}

		// Set up key count
		$t24_deposito_detail_grid->KeyCount = $t24_deposito_detail_grid->RowIndex;

		// Init row class and style
		$t24_deposito_detail->ResetAttrs();
		$t24_deposito_detail->CssClass = "";
		if ($t24_deposito_detail->CurrentAction == "gridadd") {
			if ($t24_deposito_detail->CurrentMode == "copy") {
				$t24_deposito_detail_grid->LoadRowValues($t24_deposito_detail_grid->Recordset); // Load row values
				$t24_deposito_detail_grid->SetRecordKey($t24_deposito_detail_grid->RowOldKey, $t24_deposito_detail_grid->Recordset); // Set old record key
			} else {
				$t24_deposito_detail_grid->LoadDefaultValues(); // Load default values
				$t24_deposito_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t24_deposito_detail_grid->LoadRowValues($t24_deposito_detail_grid->Recordset); // Load row values
		}
		$t24_deposito_detail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t24_deposito_detail->CurrentAction == "gridadd") // Grid add
			$t24_deposito_detail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t24_deposito_detail->CurrentAction == "gridadd" && $t24_deposito_detail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t24_deposito_detail_grid->RestoreCurrentRowFormValues($t24_deposito_detail_grid->RowIndex); // Restore form values
		if ($t24_deposito_detail->CurrentAction == "gridedit") { // Grid edit
			if ($t24_deposito_detail->EventCancelled) {
				$t24_deposito_detail_grid->RestoreCurrentRowFormValues($t24_deposito_detail_grid->RowIndex); // Restore form values
			}
			if ($t24_deposito_detail_grid->RowAction == "insert")
				$t24_deposito_detail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t24_deposito_detail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t24_deposito_detail->CurrentAction == "gridedit" && ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT || $t24_deposito_detail->RowType == EW_ROWTYPE_ADD) && $t24_deposito_detail->EventCancelled) // Update failed
			$t24_deposito_detail_grid->RestoreCurrentRowFormValues($t24_deposito_detail_grid->RowIndex); // Restore form values
		if ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t24_deposito_detail_grid->EditRowCnt++;
		if ($t24_deposito_detail->CurrentAction == "F") // Confirm row
			$t24_deposito_detail_grid->RestoreCurrentRowFormValues($t24_deposito_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t24_deposito_detail->RowAttrs = array_merge($t24_deposito_detail->RowAttrs, array('data-rowindex'=>$t24_deposito_detail_grid->RowCnt, 'id'=>'r' . $t24_deposito_detail_grid->RowCnt . '_t24_deposito_detail', 'data-rowtype'=>$t24_deposito_detail->RowType));

		// Render row
		$t24_deposito_detail_grid->RenderRow();

		// Render list options
		$t24_deposito_detail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t24_deposito_detail_grid->RowAction <> "delete" && $t24_deposito_detail_grid->RowAction <> "insertdelete" && !($t24_deposito_detail_grid->RowAction == "insert" && $t24_deposito_detail->CurrentAction == "F" && $t24_deposito_detail_grid->EmptyRow())) {
?>
	<tr<?php echo $t24_deposito_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t24_deposito_detail_grid->ListOptions->Render("body", "left", $t24_deposito_detail_grid->RowCnt);
?>
	<?php if ($t24_deposito_detail->Pembayaran_Ke->Visible) { // Pembayaran_Ke ?>
		<td data-name="Pembayaran_Ke"<?php echo $t24_deposito_detail->Pembayaran_Ke->CellAttributes() ?>>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Pembayaran_Ke" class="form-group t24_deposito_detail_Pembayaran_Ke">
<input type="text" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Pembayaran_Ke->EditValue ?>"<?php echo $t24_deposito_detail->Pembayaran_Ke->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->OldValue) ?>">
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Pembayaran_Ke" class="form-group t24_deposito_detail_Pembayaran_Ke">
<input type="text" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Pembayaran_Ke->EditValue ?>"<?php echo $t24_deposito_detail->Pembayaran_Ke->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Pembayaran_Ke" class="t24_deposito_detail_Pembayaran_Ke">
<span<?php echo $t24_deposito_detail->Pembayaran_Ke->ViewAttributes() ?>>
<?php echo $t24_deposito_detail->Pembayaran_Ke->ListViewValue() ?></span>
</span>
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t24_deposito_detail_grid->PageObjName . "_row_" . $t24_deposito_detail_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_id" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t24_deposito_detail->id->CurrentValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_id" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t24_deposito_detail->id->OldValue) ?>">
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT || $t24_deposito_detail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_id" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t24_deposito_detail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t24_deposito_detail->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl"<?php echo $t24_deposito_detail->Bayar_Tgl->CellAttributes() ?>>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Tgl" class="form-group t24_deposito_detail_Bayar_Tgl">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Tgl->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Tgl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Tgl" class="form-group t24_deposito_detail_Bayar_Tgl">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Tgl->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Tgl->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Tgl" class="t24_deposito_detail_Bayar_Tgl">
<span<?php echo $t24_deposito_detail->Bayar_Tgl->ViewAttributes() ?>>
<?php echo $t24_deposito_detail->Bayar_Tgl->ListViewValue() ?></span>
</span>
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t24_deposito_detail->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t24_deposito_detail->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Jumlah" class="form-group t24_deposito_detail_Bayar_Jumlah">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Jumlah->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Jumlah" class="form-group t24_deposito_detail_Bayar_Jumlah">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Jumlah->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t24_deposito_detail_grid->RowCnt ?>_t24_deposito_detail_Bayar_Jumlah" class="t24_deposito_detail_Bayar_Jumlah">
<span<?php echo $t24_deposito_detail->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t24_deposito_detail->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="ft24_deposito_detailgrid$x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="ft24_deposito_detailgrid$o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t24_deposito_detail_grid->ListOptions->Render("body", "right", $t24_deposito_detail_grid->RowCnt);
?>
	</tr>
<?php if ($t24_deposito_detail->RowType == EW_ROWTYPE_ADD || $t24_deposito_detail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft24_deposito_detailgrid.UpdateOpts(<?php echo $t24_deposito_detail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t24_deposito_detail->CurrentAction <> "gridadd" || $t24_deposito_detail->CurrentMode == "copy")
		if (!$t24_deposito_detail_grid->Recordset->EOF) $t24_deposito_detail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t24_deposito_detail->CurrentMode == "add" || $t24_deposito_detail->CurrentMode == "copy" || $t24_deposito_detail->CurrentMode == "edit") {
		$t24_deposito_detail_grid->RowIndex = '$rowindex$';
		$t24_deposito_detail_grid->LoadDefaultValues();

		// Set row properties
		$t24_deposito_detail->ResetAttrs();
		$t24_deposito_detail->RowAttrs = array_merge($t24_deposito_detail->RowAttrs, array('data-rowindex'=>$t24_deposito_detail_grid->RowIndex, 'id'=>'r0_t24_deposito_detail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t24_deposito_detail->RowAttrs["class"], "ewTemplate");
		$t24_deposito_detail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t24_deposito_detail_grid->RenderRow();

		// Render list options
		$t24_deposito_detail_grid->RenderListOptions();
		$t24_deposito_detail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t24_deposito_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t24_deposito_detail_grid->ListOptions->Render("body", "left", $t24_deposito_detail_grid->RowIndex);
?>
	<?php if ($t24_deposito_detail->Pembayaran_Ke->Visible) { // Pembayaran_Ke ?>
		<td data-name="Pembayaran_Ke">
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t24_deposito_detail_Pembayaran_Ke" class="form-group t24_deposito_detail_Pembayaran_Ke">
<input type="text" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Pembayaran_Ke->EditValue ?>"<?php echo $t24_deposito_detail->Pembayaran_Ke->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t24_deposito_detail_Pembayaran_Ke" class="form-group t24_deposito_detail_Pembayaran_Ke">
<span<?php echo $t24_deposito_detail->Pembayaran_Ke->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t24_deposito_detail->Pembayaran_Ke->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Pembayaran_Ke" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Pembayaran_Ke" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Pembayaran_Ke->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t24_deposito_detail->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl">
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t24_deposito_detail_Bayar_Tgl" class="form-group t24_deposito_detail_Bayar_Tgl">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Tgl->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Tgl->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t24_deposito_detail_Bayar_Tgl" class="form-group t24_deposito_detail_Bayar_Tgl">
<span<?php echo $t24_deposito_detail->Bayar_Tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t24_deposito_detail->Bayar_Tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Tgl" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t24_deposito_detail->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<?php if ($t24_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t24_deposito_detail_Bayar_Jumlah" class="form-group t24_deposito_detail_Bayar_Jumlah">
<input type="text" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t24_deposito_detail->Bayar_Jumlah->EditValue ?>"<?php echo $t24_deposito_detail->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t24_deposito_detail_Bayar_Jumlah" class="form-group t24_deposito_detail_Bayar_Jumlah">
<span<?php echo $t24_deposito_detail->Bayar_Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t24_deposito_detail->Bayar_Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t24_deposito_detail" data-field="x_Bayar_Jumlah" name="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t24_deposito_detail_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t24_deposito_detail->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t24_deposito_detail_grid->ListOptions->Render("body", "right", $t24_deposito_detail_grid->RowCnt);
?>
<script type="text/javascript">
ft24_deposito_detailgrid.UpdateOpts(<?php echo $t24_deposito_detail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t24_deposito_detail->CurrentMode == "add" || $t24_deposito_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t24_deposito_detail_grid->FormKeyCountName ?>" id="<?php echo $t24_deposito_detail_grid->FormKeyCountName ?>" value="<?php echo $t24_deposito_detail_grid->KeyCount ?>">
<?php echo $t24_deposito_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t24_deposito_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t24_deposito_detail_grid->FormKeyCountName ?>" id="<?php echo $t24_deposito_detail_grid->FormKeyCountName ?>" value="<?php echo $t24_deposito_detail_grid->KeyCount ?>">
<?php echo $t24_deposito_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t24_deposito_detail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft24_deposito_detailgrid">
</div>
<?php

// Close recordset
if ($t24_deposito_detail_grid->Recordset)
	$t24_deposito_detail_grid->Recordset->Close();
?>
<?php if ($t24_deposito_detail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t24_deposito_detail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t24_deposito_detail_grid->TotalRecs == 0 && $t24_deposito_detail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t24_deposito_detail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t24_deposito_detail->Export == "") { ?>
<script type="text/javascript">
ft24_deposito_detailgrid.Init();
</script>
<?php } ?>
<?php
$t24_deposito_detail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t24_deposito_detail_grid->Page_Terminate();
?>
