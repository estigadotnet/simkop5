<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t08_pinjamanpotongan_grid)) $t08_pinjamanpotongan_grid = new ct08_pinjamanpotongan_grid();

// Page init
$t08_pinjamanpotongan_grid->Page_Init();

// Page main
$t08_pinjamanpotongan_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_pinjamanpotongan_grid->Page_Render();
?>
<?php if ($t08_pinjamanpotongan->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft08_pinjamanpotongangrid = new ew_Form("ft08_pinjamanpotongangrid", "grid");
ft08_pinjamanpotongangrid.FormKeyCountName = '<?php echo $t08_pinjamanpotongan_grid->FormKeyCountName ?>';

// Validate form
ft08_pinjamanpotongangrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_pinjamanpotongan->Tanggal->FldCaption(), $t08_pinjamanpotongan->Tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_pinjamanpotongan->Tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_pinjamanpotongan->Jumlah->FldCaption(), $t08_pinjamanpotongan->Jumlah->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_pinjamanpotongan->Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft08_pinjamanpotongangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "Tanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft08_pinjamanpotongangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft08_pinjamanpotongangrid.ValidateRequired = true;
<?php } else { ?>
ft08_pinjamanpotongangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t08_pinjamanpotongan->CurrentAction == "gridadd") {
	if ($t08_pinjamanpotongan->CurrentMode == "copy") {
		$bSelectLimit = $t08_pinjamanpotongan_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t08_pinjamanpotongan_grid->TotalRecs = $t08_pinjamanpotongan->SelectRecordCount();
			$t08_pinjamanpotongan_grid->Recordset = $t08_pinjamanpotongan_grid->LoadRecordset($t08_pinjamanpotongan_grid->StartRec-1, $t08_pinjamanpotongan_grid->DisplayRecs);
		} else {
			if ($t08_pinjamanpotongan_grid->Recordset = $t08_pinjamanpotongan_grid->LoadRecordset())
				$t08_pinjamanpotongan_grid->TotalRecs = $t08_pinjamanpotongan_grid->Recordset->RecordCount();
		}
		$t08_pinjamanpotongan_grid->StartRec = 1;
		$t08_pinjamanpotongan_grid->DisplayRecs = $t08_pinjamanpotongan_grid->TotalRecs;
	} else {
		$t08_pinjamanpotongan->CurrentFilter = "0=1";
		$t08_pinjamanpotongan_grid->StartRec = 1;
		$t08_pinjamanpotongan_grid->DisplayRecs = $t08_pinjamanpotongan->GridAddRowCount;
	}
	$t08_pinjamanpotongan_grid->TotalRecs = $t08_pinjamanpotongan_grid->DisplayRecs;
	$t08_pinjamanpotongan_grid->StopRec = $t08_pinjamanpotongan_grid->DisplayRecs;
} else {
	$bSelectLimit = $t08_pinjamanpotongan_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t08_pinjamanpotongan_grid->TotalRecs <= 0)
			$t08_pinjamanpotongan_grid->TotalRecs = $t08_pinjamanpotongan->SelectRecordCount();
	} else {
		if (!$t08_pinjamanpotongan_grid->Recordset && ($t08_pinjamanpotongan_grid->Recordset = $t08_pinjamanpotongan_grid->LoadRecordset()))
			$t08_pinjamanpotongan_grid->TotalRecs = $t08_pinjamanpotongan_grid->Recordset->RecordCount();
	}
	$t08_pinjamanpotongan_grid->StartRec = 1;
	$t08_pinjamanpotongan_grid->DisplayRecs = $t08_pinjamanpotongan_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t08_pinjamanpotongan_grid->Recordset = $t08_pinjamanpotongan_grid->LoadRecordset($t08_pinjamanpotongan_grid->StartRec-1, $t08_pinjamanpotongan_grid->DisplayRecs);

	// Set no record found message
	if ($t08_pinjamanpotongan->CurrentAction == "" && $t08_pinjamanpotongan_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t08_pinjamanpotongan_grid->setWarningMessage(ew_DeniedMsg());
		if ($t08_pinjamanpotongan_grid->SearchWhere == "0=101")
			$t08_pinjamanpotongan_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t08_pinjamanpotongan_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t08_pinjamanpotongan_grid->RenderOtherOptions();
?>
<?php $t08_pinjamanpotongan_grid->ShowPageHeader(); ?>
<?php
$t08_pinjamanpotongan_grid->ShowMessage();
?>
<?php if ($t08_pinjamanpotongan_grid->TotalRecs > 0 || $t08_pinjamanpotongan->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t08_pinjamanpotongan">
<div id="ft08_pinjamanpotongangrid" class="ewForm form-inline">
<div id="gmp_t08_pinjamanpotongan" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t08_pinjamanpotongangrid" class="table ewTable">
<?php echo $t08_pinjamanpotongan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t08_pinjamanpotongan_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t08_pinjamanpotongan_grid->RenderListOptions();

// Render list options (header, left)
$t08_pinjamanpotongan_grid->ListOptions->Render("header", "left");
?>
<?php if ($t08_pinjamanpotongan->Tanggal->Visible) { // Tanggal ?>
	<?php if ($t08_pinjamanpotongan->SortUrl($t08_pinjamanpotongan->Tanggal) == "") { ?>
		<th data-name="Tanggal"><div id="elh_t08_pinjamanpotongan_Tanggal" class="t08_pinjamanpotongan_Tanggal"><div class="ewTableHeaderCaption"><?php echo $t08_pinjamanpotongan->Tanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal"><div><div id="elh_t08_pinjamanpotongan_Tanggal" class="t08_pinjamanpotongan_Tanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_pinjamanpotongan->Tanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_pinjamanpotongan->Tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_pinjamanpotongan->Tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_pinjamanpotongan->Jumlah->Visible) { // Jumlah ?>
	<?php if ($t08_pinjamanpotongan->SortUrl($t08_pinjamanpotongan->Jumlah) == "") { ?>
		<th data-name="Jumlah"><div id="elh_t08_pinjamanpotongan_Jumlah" class="t08_pinjamanpotongan_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t08_pinjamanpotongan->Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah"><div><div id="elh_t08_pinjamanpotongan_Jumlah" class="t08_pinjamanpotongan_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_pinjamanpotongan->Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_pinjamanpotongan->Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_pinjamanpotongan->Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t08_pinjamanpotongan_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t08_pinjamanpotongan_grid->StartRec = 1;
$t08_pinjamanpotongan_grid->StopRec = $t08_pinjamanpotongan_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t08_pinjamanpotongan_grid->FormKeyCountName) && ($t08_pinjamanpotongan->CurrentAction == "gridadd" || $t08_pinjamanpotongan->CurrentAction == "gridedit" || $t08_pinjamanpotongan->CurrentAction == "F")) {
		$t08_pinjamanpotongan_grid->KeyCount = $objForm->GetValue($t08_pinjamanpotongan_grid->FormKeyCountName);
		$t08_pinjamanpotongan_grid->StopRec = $t08_pinjamanpotongan_grid->StartRec + $t08_pinjamanpotongan_grid->KeyCount - 1;
	}
}
$t08_pinjamanpotongan_grid->RecCnt = $t08_pinjamanpotongan_grid->StartRec - 1;
if ($t08_pinjamanpotongan_grid->Recordset && !$t08_pinjamanpotongan_grid->Recordset->EOF) {
	$t08_pinjamanpotongan_grid->Recordset->MoveFirst();
	$bSelectLimit = $t08_pinjamanpotongan_grid->UseSelectLimit;
	if (!$bSelectLimit && $t08_pinjamanpotongan_grid->StartRec > 1)
		$t08_pinjamanpotongan_grid->Recordset->Move($t08_pinjamanpotongan_grid->StartRec - 1);
} elseif (!$t08_pinjamanpotongan->AllowAddDeleteRow && $t08_pinjamanpotongan_grid->StopRec == 0) {
	$t08_pinjamanpotongan_grid->StopRec = $t08_pinjamanpotongan->GridAddRowCount;
}

// Initialize aggregate
$t08_pinjamanpotongan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t08_pinjamanpotongan->ResetAttrs();
$t08_pinjamanpotongan_grid->RenderRow();
if ($t08_pinjamanpotongan->CurrentAction == "gridadd")
	$t08_pinjamanpotongan_grid->RowIndex = 0;
if ($t08_pinjamanpotongan->CurrentAction == "gridedit")
	$t08_pinjamanpotongan_grid->RowIndex = 0;
while ($t08_pinjamanpotongan_grid->RecCnt < $t08_pinjamanpotongan_grid->StopRec) {
	$t08_pinjamanpotongan_grid->RecCnt++;
	if (intval($t08_pinjamanpotongan_grid->RecCnt) >= intval($t08_pinjamanpotongan_grid->StartRec)) {
		$t08_pinjamanpotongan_grid->RowCnt++;
		if ($t08_pinjamanpotongan->CurrentAction == "gridadd" || $t08_pinjamanpotongan->CurrentAction == "gridedit" || $t08_pinjamanpotongan->CurrentAction == "F") {
			$t08_pinjamanpotongan_grid->RowIndex++;
			$objForm->Index = $t08_pinjamanpotongan_grid->RowIndex;
			if ($objForm->HasValue($t08_pinjamanpotongan_grid->FormActionName))
				$t08_pinjamanpotongan_grid->RowAction = strval($objForm->GetValue($t08_pinjamanpotongan_grid->FormActionName));
			elseif ($t08_pinjamanpotongan->CurrentAction == "gridadd")
				$t08_pinjamanpotongan_grid->RowAction = "insert";
			else
				$t08_pinjamanpotongan_grid->RowAction = "";
		}

		// Set up key count
		$t08_pinjamanpotongan_grid->KeyCount = $t08_pinjamanpotongan_grid->RowIndex;

		// Init row class and style
		$t08_pinjamanpotongan->ResetAttrs();
		$t08_pinjamanpotongan->CssClass = "";
		if ($t08_pinjamanpotongan->CurrentAction == "gridadd") {
			if ($t08_pinjamanpotongan->CurrentMode == "copy") {
				$t08_pinjamanpotongan_grid->LoadRowValues($t08_pinjamanpotongan_grid->Recordset); // Load row values
				$t08_pinjamanpotongan_grid->SetRecordKey($t08_pinjamanpotongan_grid->RowOldKey, $t08_pinjamanpotongan_grid->Recordset); // Set old record key
			} else {
				$t08_pinjamanpotongan_grid->LoadDefaultValues(); // Load default values
				$t08_pinjamanpotongan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t08_pinjamanpotongan_grid->LoadRowValues($t08_pinjamanpotongan_grid->Recordset); // Load row values
		}
		$t08_pinjamanpotongan->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t08_pinjamanpotongan->CurrentAction == "gridadd") // Grid add
			$t08_pinjamanpotongan->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t08_pinjamanpotongan->CurrentAction == "gridadd" && $t08_pinjamanpotongan->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t08_pinjamanpotongan_grid->RestoreCurrentRowFormValues($t08_pinjamanpotongan_grid->RowIndex); // Restore form values
		if ($t08_pinjamanpotongan->CurrentAction == "gridedit") { // Grid edit
			if ($t08_pinjamanpotongan->EventCancelled) {
				$t08_pinjamanpotongan_grid->RestoreCurrentRowFormValues($t08_pinjamanpotongan_grid->RowIndex); // Restore form values
			}
			if ($t08_pinjamanpotongan_grid->RowAction == "insert")
				$t08_pinjamanpotongan->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t08_pinjamanpotongan->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t08_pinjamanpotongan->CurrentAction == "gridedit" && ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT || $t08_pinjamanpotongan->RowType == EW_ROWTYPE_ADD) && $t08_pinjamanpotongan->EventCancelled) // Update failed
			$t08_pinjamanpotongan_grid->RestoreCurrentRowFormValues($t08_pinjamanpotongan_grid->RowIndex); // Restore form values
		if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t08_pinjamanpotongan_grid->EditRowCnt++;
		if ($t08_pinjamanpotongan->CurrentAction == "F") // Confirm row
			$t08_pinjamanpotongan_grid->RestoreCurrentRowFormValues($t08_pinjamanpotongan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t08_pinjamanpotongan->RowAttrs = array_merge($t08_pinjamanpotongan->RowAttrs, array('data-rowindex'=>$t08_pinjamanpotongan_grid->RowCnt, 'id'=>'r' . $t08_pinjamanpotongan_grid->RowCnt . '_t08_pinjamanpotongan', 'data-rowtype'=>$t08_pinjamanpotongan->RowType));

		// Render row
		$t08_pinjamanpotongan_grid->RenderRow();

		// Render list options
		$t08_pinjamanpotongan_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t08_pinjamanpotongan_grid->RowAction <> "delete" && $t08_pinjamanpotongan_grid->RowAction <> "insertdelete" && !($t08_pinjamanpotongan_grid->RowAction == "insert" && $t08_pinjamanpotongan->CurrentAction == "F" && $t08_pinjamanpotongan_grid->EmptyRow())) {
?>
	<tr<?php echo $t08_pinjamanpotongan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_pinjamanpotongan_grid->ListOptions->Render("body", "left", $t08_pinjamanpotongan_grid->RowCnt);
?>
	<?php if ($t08_pinjamanpotongan->Tanggal->Visible) { // Tanggal ?>
		<td data-name="Tanggal"<?php echo $t08_pinjamanpotongan->Tanggal->CellAttributes() ?>>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Tanggal" class="form-group t08_pinjamanpotongan_Tanggal">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Tanggal->EditValue ?>"<?php echo $t08_pinjamanpotongan->Tanggal->EditAttributes() ?>>
<?php if (!$t08_pinjamanpotongan->Tanggal->ReadOnly && !$t08_pinjamanpotongan->Tanggal->Disabled && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["readonly"]) && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft08_pinjamanpotongangrid", "x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->OldValue) ?>">
<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Tanggal" class="form-group t08_pinjamanpotongan_Tanggal">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Tanggal->EditValue ?>"<?php echo $t08_pinjamanpotongan->Tanggal->EditAttributes() ?>>
<?php if (!$t08_pinjamanpotongan->Tanggal->ReadOnly && !$t08_pinjamanpotongan->Tanggal->Disabled && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["readonly"]) && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft08_pinjamanpotongangrid", "x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Tanggal" class="t08_pinjamanpotongan_Tanggal">
<span<?php echo $t08_pinjamanpotongan->Tanggal->ViewAttributes() ?>>
<?php echo $t08_pinjamanpotongan->Tanggal->ListViewValue() ?></span>
</span>
<?php if ($t08_pinjamanpotongan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->FormValue) ?>">
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="ft08_pinjamanpotongangrid$x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="ft08_pinjamanpotongangrid$x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->FormValue) ?>">
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="ft08_pinjamanpotongangrid$o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="ft08_pinjamanpotongangrid$o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t08_pinjamanpotongan_grid->PageObjName . "_row_" . $t08_pinjamanpotongan_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_id" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->id->CurrentValue) ?>">
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_id" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->id->OldValue) ?>">
<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT || $t08_pinjamanpotongan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_id" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t08_pinjamanpotongan->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah"<?php echo $t08_pinjamanpotongan->Jumlah->CellAttributes() ?>>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Jumlah" class="form-group t08_pinjamanpotongan_Jumlah">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Jumlah->EditValue ?>"<?php echo $t08_pinjamanpotongan->Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Jumlah" class="form-group t08_pinjamanpotongan_Jumlah">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Jumlah->EditValue ?>"<?php echo $t08_pinjamanpotongan->Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_pinjamanpotongan_grid->RowCnt ?>_t08_pinjamanpotongan_Jumlah" class="t08_pinjamanpotongan_Jumlah">
<span<?php echo $t08_pinjamanpotongan->Jumlah->ViewAttributes() ?>>
<?php echo $t08_pinjamanpotongan->Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t08_pinjamanpotongan->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="ft08_pinjamanpotongangrid$x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="ft08_pinjamanpotongangrid$x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="ft08_pinjamanpotongangrid$o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="ft08_pinjamanpotongangrid$o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_pinjamanpotongan_grid->ListOptions->Render("body", "right", $t08_pinjamanpotongan_grid->RowCnt);
?>
	</tr>
<?php if ($t08_pinjamanpotongan->RowType == EW_ROWTYPE_ADD || $t08_pinjamanpotongan->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft08_pinjamanpotongangrid.UpdateOpts(<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t08_pinjamanpotongan->CurrentAction <> "gridadd" || $t08_pinjamanpotongan->CurrentMode == "copy")
		if (!$t08_pinjamanpotongan_grid->Recordset->EOF) $t08_pinjamanpotongan_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t08_pinjamanpotongan->CurrentMode == "add" || $t08_pinjamanpotongan->CurrentMode == "copy" || $t08_pinjamanpotongan->CurrentMode == "edit") {
		$t08_pinjamanpotongan_grid->RowIndex = '$rowindex$';
		$t08_pinjamanpotongan_grid->LoadDefaultValues();

		// Set row properties
		$t08_pinjamanpotongan->ResetAttrs();
		$t08_pinjamanpotongan->RowAttrs = array_merge($t08_pinjamanpotongan->RowAttrs, array('data-rowindex'=>$t08_pinjamanpotongan_grid->RowIndex, 'id'=>'r0_t08_pinjamanpotongan', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t08_pinjamanpotongan->RowAttrs["class"], "ewTemplate");
		$t08_pinjamanpotongan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t08_pinjamanpotongan_grid->RenderRow();

		// Render list options
		$t08_pinjamanpotongan_grid->RenderListOptions();
		$t08_pinjamanpotongan_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t08_pinjamanpotongan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_pinjamanpotongan_grid->ListOptions->Render("body", "left", $t08_pinjamanpotongan_grid->RowIndex);
?>
	<?php if ($t08_pinjamanpotongan->Tanggal->Visible) { // Tanggal ?>
		<td data-name="Tanggal">
<?php if ($t08_pinjamanpotongan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_pinjamanpotongan_Tanggal" class="form-group t08_pinjamanpotongan_Tanggal">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" data-format="7" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Tanggal->EditValue ?>"<?php echo $t08_pinjamanpotongan->Tanggal->EditAttributes() ?>>
<?php if (!$t08_pinjamanpotongan->Tanggal->ReadOnly && !$t08_pinjamanpotongan->Tanggal->Disabled && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["readonly"]) && !isset($t08_pinjamanpotongan->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft08_pinjamanpotongangrid", "x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_pinjamanpotongan_Tanggal" class="form-group t08_pinjamanpotongan_Tanggal">
<span<?php echo $t08_pinjamanpotongan->Tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_pinjamanpotongan->Tanggal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Tanggal" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Tanggal" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_pinjamanpotongan->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah">
<?php if ($t08_pinjamanpotongan->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_pinjamanpotongan_Jumlah" class="form-group t08_pinjamanpotongan_Jumlah">
<input type="text" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t08_pinjamanpotongan->Jumlah->EditValue ?>"<?php echo $t08_pinjamanpotongan->Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_pinjamanpotongan_Jumlah" class="form-group t08_pinjamanpotongan_Jumlah">
<span<?php echo $t08_pinjamanpotongan->Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_pinjamanpotongan->Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="x<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_pinjamanpotongan" data-field="x_Jumlah" name="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" id="o<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t08_pinjamanpotongan->Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_pinjamanpotongan_grid->ListOptions->Render("body", "right", $t08_pinjamanpotongan_grid->RowCnt);
?>
<script type="text/javascript">
ft08_pinjamanpotongangrid.UpdateOpts(<?php echo $t08_pinjamanpotongan_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t08_pinjamanpotongan->CurrentMode == "add" || $t08_pinjamanpotongan->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t08_pinjamanpotongan_grid->FormKeyCountName ?>" id="<?php echo $t08_pinjamanpotongan_grid->FormKeyCountName ?>" value="<?php echo $t08_pinjamanpotongan_grid->KeyCount ?>">
<?php echo $t08_pinjamanpotongan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_pinjamanpotongan->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t08_pinjamanpotongan_grid->FormKeyCountName ?>" id="<?php echo $t08_pinjamanpotongan_grid->FormKeyCountName ?>" value="<?php echo $t08_pinjamanpotongan_grid->KeyCount ?>">
<?php echo $t08_pinjamanpotongan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_pinjamanpotongan->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft08_pinjamanpotongangrid">
</div>
<?php

// Close recordset
if ($t08_pinjamanpotongan_grid->Recordset)
	$t08_pinjamanpotongan_grid->Recordset->Close();
?>
<?php if ($t08_pinjamanpotongan_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t08_pinjamanpotongan_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t08_pinjamanpotongan_grid->TotalRecs == 0 && $t08_pinjamanpotongan->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_pinjamanpotongan_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t08_pinjamanpotongan->Export == "") { ?>
<script type="text/javascript">
ft08_pinjamanpotongangrid.Init();
</script>
<?php } ?>
<?php
$t08_pinjamanpotongan_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t08_pinjamanpotongan_grid->Page_Terminate();
?>
