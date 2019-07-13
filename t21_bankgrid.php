<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t21_bank_grid)) $t21_bank_grid = new ct21_bank_grid();

// Page init
$t21_bank_grid->Page_Init();

// Page main
$t21_bank_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t21_bank_grid->Page_Render();
?>
<?php if ($t21_bank->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft21_bankgrid = new ew_Form("ft21_bankgrid", "grid");
ft21_bankgrid.FormKeyCountName = '<?php echo $t21_bank_grid->FormKeyCountName ?>';

// Validate form
ft21_bankgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->nasabah_id->FldCaption(), $t21_bank->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nomor");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->Nomor->FldCaption(), $t21_bank->Nomor->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pemilik");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->Pemilik->FldCaption(), $t21_bank->Pemilik->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bank");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->Bank->FldCaption(), $t21_bank->Bank->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kota");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->Kota->FldCaption(), $t21_bank->Kota->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Cabang");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t21_bank->Cabang->FldCaption(), $t21_bank->Cabang->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft21_bankgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "nasabah_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nomor", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Pemilik", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bank", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Kota", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Cabang", false)) return false;
	return true;
}

// Form_CustomValidate event
ft21_bankgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft21_bankgrid.ValidateRequired = true;
<?php } else { ?>
ft21_bankgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft21_bankgrid.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_nasabah"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t21_bank->CurrentAction == "gridadd") {
	if ($t21_bank->CurrentMode == "copy") {
		$bSelectLimit = $t21_bank_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t21_bank_grid->TotalRecs = $t21_bank->SelectRecordCount();
			$t21_bank_grid->Recordset = $t21_bank_grid->LoadRecordset($t21_bank_grid->StartRec-1, $t21_bank_grid->DisplayRecs);
		} else {
			if ($t21_bank_grid->Recordset = $t21_bank_grid->LoadRecordset())
				$t21_bank_grid->TotalRecs = $t21_bank_grid->Recordset->RecordCount();
		}
		$t21_bank_grid->StartRec = 1;
		$t21_bank_grid->DisplayRecs = $t21_bank_grid->TotalRecs;
	} else {
		$t21_bank->CurrentFilter = "0=1";
		$t21_bank_grid->StartRec = 1;
		$t21_bank_grid->DisplayRecs = $t21_bank->GridAddRowCount;
	}
	$t21_bank_grid->TotalRecs = $t21_bank_grid->DisplayRecs;
	$t21_bank_grid->StopRec = $t21_bank_grid->DisplayRecs;
} else {
	$bSelectLimit = $t21_bank_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t21_bank_grid->TotalRecs <= 0)
			$t21_bank_grid->TotalRecs = $t21_bank->SelectRecordCount();
	} else {
		if (!$t21_bank_grid->Recordset && ($t21_bank_grid->Recordset = $t21_bank_grid->LoadRecordset()))
			$t21_bank_grid->TotalRecs = $t21_bank_grid->Recordset->RecordCount();
	}
	$t21_bank_grid->StartRec = 1;
	$t21_bank_grid->DisplayRecs = $t21_bank_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t21_bank_grid->Recordset = $t21_bank_grid->LoadRecordset($t21_bank_grid->StartRec-1, $t21_bank_grid->DisplayRecs);

	// Set no record found message
	if ($t21_bank->CurrentAction == "" && $t21_bank_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t21_bank_grid->setWarningMessage(ew_DeniedMsg());
		if ($t21_bank_grid->SearchWhere == "0=101")
			$t21_bank_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t21_bank_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t21_bank_grid->RenderOtherOptions();
?>
<?php $t21_bank_grid->ShowPageHeader(); ?>
<?php
$t21_bank_grid->ShowMessage();
?>
<?php if ($t21_bank_grid->TotalRecs > 0 || $t21_bank->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t21_bank">
<div id="ft21_bankgrid" class="ewForm form-inline">
<div id="gmp_t21_bank" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t21_bankgrid" class="table ewTable">
<?php echo $t21_bank->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t21_bank_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t21_bank_grid->RenderListOptions();

// Render list options (header, left)
$t21_bank_grid->ListOptions->Render("header", "left");
?>
<?php if ($t21_bank->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t21_bank->SortUrl($t21_bank->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t21_bank_nasabah_id" class="t21_bank_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t21_bank->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div><div id="elh_t21_bank_nasabah_id" class="t21_bank_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t21_bank->Nomor->Visible) { // Nomor ?>
	<?php if ($t21_bank->SortUrl($t21_bank->Nomor) == "") { ?>
		<th data-name="Nomor"><div id="elh_t21_bank_Nomor" class="t21_bank_Nomor"><div class="ewTableHeaderCaption"><?php echo $t21_bank->Nomor->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nomor"><div><div id="elh_t21_bank_Nomor" class="t21_bank_Nomor">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->Nomor->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->Nomor->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->Nomor->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t21_bank->Pemilik->Visible) { // Pemilik ?>
	<?php if ($t21_bank->SortUrl($t21_bank->Pemilik) == "") { ?>
		<th data-name="Pemilik"><div id="elh_t21_bank_Pemilik" class="t21_bank_Pemilik"><div class="ewTableHeaderCaption"><?php echo $t21_bank->Pemilik->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pemilik"><div><div id="elh_t21_bank_Pemilik" class="t21_bank_Pemilik">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->Pemilik->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->Pemilik->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->Pemilik->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t21_bank->Bank->Visible) { // Bank ?>
	<?php if ($t21_bank->SortUrl($t21_bank->Bank) == "") { ?>
		<th data-name="Bank"><div id="elh_t21_bank_Bank" class="t21_bank_Bank"><div class="ewTableHeaderCaption"><?php echo $t21_bank->Bank->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bank"><div><div id="elh_t21_bank_Bank" class="t21_bank_Bank">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->Bank->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->Bank->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->Bank->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t21_bank->Kota->Visible) { // Kota ?>
	<?php if ($t21_bank->SortUrl($t21_bank->Kota) == "") { ?>
		<th data-name="Kota"><div id="elh_t21_bank_Kota" class="t21_bank_Kota"><div class="ewTableHeaderCaption"><?php echo $t21_bank->Kota->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kota"><div><div id="elh_t21_bank_Kota" class="t21_bank_Kota">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->Kota->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->Kota->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->Kota->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t21_bank->Cabang->Visible) { // Cabang ?>
	<?php if ($t21_bank->SortUrl($t21_bank->Cabang) == "") { ?>
		<th data-name="Cabang"><div id="elh_t21_bank_Cabang" class="t21_bank_Cabang"><div class="ewTableHeaderCaption"><?php echo $t21_bank->Cabang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cabang"><div><div id="elh_t21_bank_Cabang" class="t21_bank_Cabang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t21_bank->Cabang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t21_bank->Cabang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t21_bank->Cabang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t21_bank_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t21_bank_grid->StartRec = 1;
$t21_bank_grid->StopRec = $t21_bank_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t21_bank_grid->FormKeyCountName) && ($t21_bank->CurrentAction == "gridadd" || $t21_bank->CurrentAction == "gridedit" || $t21_bank->CurrentAction == "F")) {
		$t21_bank_grid->KeyCount = $objForm->GetValue($t21_bank_grid->FormKeyCountName);
		$t21_bank_grid->StopRec = $t21_bank_grid->StartRec + $t21_bank_grid->KeyCount - 1;
	}
}
$t21_bank_grid->RecCnt = $t21_bank_grid->StartRec - 1;
if ($t21_bank_grid->Recordset && !$t21_bank_grid->Recordset->EOF) {
	$t21_bank_grid->Recordset->MoveFirst();
	$bSelectLimit = $t21_bank_grid->UseSelectLimit;
	if (!$bSelectLimit && $t21_bank_grid->StartRec > 1)
		$t21_bank_grid->Recordset->Move($t21_bank_grid->StartRec - 1);
} elseif (!$t21_bank->AllowAddDeleteRow && $t21_bank_grid->StopRec == 0) {
	$t21_bank_grid->StopRec = $t21_bank->GridAddRowCount;
}

// Initialize aggregate
$t21_bank->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t21_bank->ResetAttrs();
$t21_bank_grid->RenderRow();
if ($t21_bank->CurrentAction == "gridadd")
	$t21_bank_grid->RowIndex = 0;
if ($t21_bank->CurrentAction == "gridedit")
	$t21_bank_grid->RowIndex = 0;
while ($t21_bank_grid->RecCnt < $t21_bank_grid->StopRec) {
	$t21_bank_grid->RecCnt++;
	if (intval($t21_bank_grid->RecCnt) >= intval($t21_bank_grid->StartRec)) {
		$t21_bank_grid->RowCnt++;
		if ($t21_bank->CurrentAction == "gridadd" || $t21_bank->CurrentAction == "gridedit" || $t21_bank->CurrentAction == "F") {
			$t21_bank_grid->RowIndex++;
			$objForm->Index = $t21_bank_grid->RowIndex;
			if ($objForm->HasValue($t21_bank_grid->FormActionName))
				$t21_bank_grid->RowAction = strval($objForm->GetValue($t21_bank_grid->FormActionName));
			elseif ($t21_bank->CurrentAction == "gridadd")
				$t21_bank_grid->RowAction = "insert";
			else
				$t21_bank_grid->RowAction = "";
		}

		// Set up key count
		$t21_bank_grid->KeyCount = $t21_bank_grid->RowIndex;

		// Init row class and style
		$t21_bank->ResetAttrs();
		$t21_bank->CssClass = "";
		if ($t21_bank->CurrentAction == "gridadd") {
			if ($t21_bank->CurrentMode == "copy") {
				$t21_bank_grid->LoadRowValues($t21_bank_grid->Recordset); // Load row values
				$t21_bank_grid->SetRecordKey($t21_bank_grid->RowOldKey, $t21_bank_grid->Recordset); // Set old record key
			} else {
				$t21_bank_grid->LoadDefaultValues(); // Load default values
				$t21_bank_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t21_bank_grid->LoadRowValues($t21_bank_grid->Recordset); // Load row values
		}
		$t21_bank->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t21_bank->CurrentAction == "gridadd") // Grid add
			$t21_bank->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t21_bank->CurrentAction == "gridadd" && $t21_bank->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t21_bank_grid->RestoreCurrentRowFormValues($t21_bank_grid->RowIndex); // Restore form values
		if ($t21_bank->CurrentAction == "gridedit") { // Grid edit
			if ($t21_bank->EventCancelled) {
				$t21_bank_grid->RestoreCurrentRowFormValues($t21_bank_grid->RowIndex); // Restore form values
			}
			if ($t21_bank_grid->RowAction == "insert")
				$t21_bank->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t21_bank->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t21_bank->CurrentAction == "gridedit" && ($t21_bank->RowType == EW_ROWTYPE_EDIT || $t21_bank->RowType == EW_ROWTYPE_ADD) && $t21_bank->EventCancelled) // Update failed
			$t21_bank_grid->RestoreCurrentRowFormValues($t21_bank_grid->RowIndex); // Restore form values
		if ($t21_bank->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t21_bank_grid->EditRowCnt++;
		if ($t21_bank->CurrentAction == "F") // Confirm row
			$t21_bank_grid->RestoreCurrentRowFormValues($t21_bank_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t21_bank->RowAttrs = array_merge($t21_bank->RowAttrs, array('data-rowindex'=>$t21_bank_grid->RowCnt, 'id'=>'r' . $t21_bank_grid->RowCnt . '_t21_bank', 'data-rowtype'=>$t21_bank->RowType));

		// Render row
		$t21_bank_grid->RenderRow();

		// Render list options
		$t21_bank_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t21_bank_grid->RowAction <> "delete" && $t21_bank_grid->RowAction <> "insertdelete" && !($t21_bank_grid->RowAction == "insert" && $t21_bank->CurrentAction == "F" && $t21_bank_grid->EmptyRow())) {
?>
	<tr<?php echo $t21_bank->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t21_bank_grid->ListOptions->Render("body", "left", $t21_bank_grid->RowCnt);
?>
	<?php if ($t21_bank->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t21_bank->nasabah_id->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t21_bank->nasabah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<span<?php echo $t21_bank->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<select data-table="t21_bank" data-field="x_nasabah_id" data-value-separator="<?php echo $t21_bank->nasabah_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id"<?php echo $t21_bank->nasabah_id->EditAttributes() ?>>
<?php echo $t21_bank->nasabah_id->SelectOptionListHtml("x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo $t21_bank->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t21_bank->nasabah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<span<?php echo $t21_bank->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<select data-table="t21_bank" data-field="x_nasabah_id" data-value-separator="<?php echo $t21_bank->nasabah_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id"<?php echo $t21_bank->nasabah_id->EditAttributes() ?>>
<?php echo $t21_bank->nasabah_id->SelectOptionListHtml("x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo $t21_bank->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_nasabah_id" class="t21_bank_nasabah_id">
<span<?php echo $t21_bank->nasabah_id->ViewAttributes() ?>>
<?php echo $t21_bank->nasabah_id->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t21_bank_grid->PageObjName . "_row_" . $t21_bank_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t21_bank" data-field="x_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_id" id="x<?php echo $t21_bank_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t21_bank->id->CurrentValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_id" name="o<?php echo $t21_bank_grid->RowIndex ?>_id" id="o<?php echo $t21_bank_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t21_bank->id->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT || $t21_bank->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_id" id="x<?php echo $t21_bank_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t21_bank->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t21_bank->Nomor->Visible) { // Nomor ?>
		<td data-name="Nomor"<?php echo $t21_bank->Nomor->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Nomor" class="form-group t21_bank_Nomor">
<input type="text" data-table="t21_bank" data-field="x_Nomor" name="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Nomor->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Nomor->EditValue ?>"<?php echo $t21_bank->Nomor->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Nomor" class="form-group t21_bank_Nomor">
<input type="text" data-table="t21_bank" data-field="x_Nomor" name="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Nomor->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Nomor->EditValue ?>"<?php echo $t21_bank->Nomor->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Nomor" class="t21_bank_Nomor">
<span<?php echo $t21_bank->Nomor->ViewAttributes() ?>>
<?php echo $t21_bank->Nomor->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t21_bank->Pemilik->Visible) { // Pemilik ?>
		<td data-name="Pemilik"<?php echo $t21_bank->Pemilik->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Pemilik" class="form-group t21_bank_Pemilik">
<input type="text" data-table="t21_bank" data-field="x_Pemilik" name="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Pemilik->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Pemilik->EditValue ?>"<?php echo $t21_bank->Pemilik->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Pemilik" class="form-group t21_bank_Pemilik">
<input type="text" data-table="t21_bank" data-field="x_Pemilik" name="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Pemilik->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Pemilik->EditValue ?>"<?php echo $t21_bank->Pemilik->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Pemilik" class="t21_bank_Pemilik">
<span<?php echo $t21_bank->Pemilik->ViewAttributes() ?>>
<?php echo $t21_bank->Pemilik->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t21_bank->Bank->Visible) { // Bank ?>
		<td data-name="Bank"<?php echo $t21_bank->Bank->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Bank" class="form-group t21_bank_Bank">
<input type="text" data-table="t21_bank" data-field="x_Bank" name="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Bank->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Bank->EditValue ?>"<?php echo $t21_bank->Bank->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Bank" class="form-group t21_bank_Bank">
<input type="text" data-table="t21_bank" data-field="x_Bank" name="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Bank->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Bank->EditValue ?>"<?php echo $t21_bank->Bank->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Bank" class="t21_bank_Bank">
<span<?php echo $t21_bank->Bank->ViewAttributes() ?>>
<?php echo $t21_bank->Bank->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t21_bank->Kota->Visible) { // Kota ?>
		<td data-name="Kota"<?php echo $t21_bank->Kota->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Kota" class="form-group t21_bank_Kota">
<input type="text" data-table="t21_bank" data-field="x_Kota" name="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Kota->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Kota->EditValue ?>"<?php echo $t21_bank->Kota->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Kota" class="form-group t21_bank_Kota">
<input type="text" data-table="t21_bank" data-field="x_Kota" name="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Kota->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Kota->EditValue ?>"<?php echo $t21_bank->Kota->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Kota" class="t21_bank_Kota">
<span<?php echo $t21_bank->Kota->ViewAttributes() ?>>
<?php echo $t21_bank->Kota->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t21_bank->Cabang->Visible) { // Cabang ?>
		<td data-name="Cabang"<?php echo $t21_bank->Cabang->CellAttributes() ?>>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Cabang" class="form-group t21_bank_Cabang">
<input type="text" data-table="t21_bank" data-field="x_Cabang" name="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Cabang->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Cabang->EditValue ?>"<?php echo $t21_bank->Cabang->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->OldValue) ?>">
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Cabang" class="form-group t21_bank_Cabang">
<input type="text" data-table="t21_bank" data-field="x_Cabang" name="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Cabang->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Cabang->EditValue ?>"<?php echo $t21_bank->Cabang->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t21_bank->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t21_bank_grid->RowCnt ?>_t21_bank_Cabang" class="t21_bank_Cabang">
<span<?php echo $t21_bank->Cabang->ViewAttributes() ?>>
<?php echo $t21_bank->Cabang->ListViewValue() ?></span>
</span>
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="ft21_bankgrid$x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->FormValue) ?>">
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="ft21_bankgrid$o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t21_bank_grid->ListOptions->Render("body", "right", $t21_bank_grid->RowCnt);
?>
	</tr>
<?php if ($t21_bank->RowType == EW_ROWTYPE_ADD || $t21_bank->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft21_bankgrid.UpdateOpts(<?php echo $t21_bank_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t21_bank->CurrentAction <> "gridadd" || $t21_bank->CurrentMode == "copy")
		if (!$t21_bank_grid->Recordset->EOF) $t21_bank_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t21_bank->CurrentMode == "add" || $t21_bank->CurrentMode == "copy" || $t21_bank->CurrentMode == "edit") {
		$t21_bank_grid->RowIndex = '$rowindex$';
		$t21_bank_grid->LoadDefaultValues();

		// Set row properties
		$t21_bank->ResetAttrs();
		$t21_bank->RowAttrs = array_merge($t21_bank->RowAttrs, array('data-rowindex'=>$t21_bank_grid->RowIndex, 'id'=>'r0_t21_bank', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t21_bank->RowAttrs["class"], "ewTemplate");
		$t21_bank->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t21_bank_grid->RenderRow();

		// Render list options
		$t21_bank_grid->RenderListOptions();
		$t21_bank_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t21_bank->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t21_bank_grid->ListOptions->Render("body", "left", $t21_bank_grid->RowIndex);
?>
	<?php if ($t21_bank->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<?php if ($t21_bank->nasabah_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<span<?php echo $t21_bank->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<select data-table="t21_bank" data-field="x_nasabah_id" data-value-separator="<?php echo $t21_bank->nasabah_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id"<?php echo $t21_bank->nasabah_id->EditAttributes() ?>>
<?php echo $t21_bank->nasabah_id->SelectOptionListHtml("x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="s_x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo $t21_bank->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_nasabah_id" class="form-group t21_bank_nasabah_id">
<span<?php echo $t21_bank->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="x<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_nasabah_id" name="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" id="o<?php echo $t21_bank_grid->RowIndex ?>_nasabah_id" value="<?php echo ew_HtmlEncode($t21_bank->nasabah_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t21_bank->Nomor->Visible) { // Nomor ?>
		<td data-name="Nomor">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t21_bank_Nomor" class="form-group t21_bank_Nomor">
<input type="text" data-table="t21_bank" data-field="x_Nomor" name="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Nomor->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Nomor->EditValue ?>"<?php echo $t21_bank->Nomor->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_Nomor" class="form-group t21_bank_Nomor">
<span<?php echo $t21_bank->Nomor->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->Nomor->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="x<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_Nomor" name="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" id="o<?php echo $t21_bank_grid->RowIndex ?>_Nomor" value="<?php echo ew_HtmlEncode($t21_bank->Nomor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t21_bank->Pemilik->Visible) { // Pemilik ?>
		<td data-name="Pemilik">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t21_bank_Pemilik" class="form-group t21_bank_Pemilik">
<input type="text" data-table="t21_bank" data-field="x_Pemilik" name="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Pemilik->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Pemilik->EditValue ?>"<?php echo $t21_bank->Pemilik->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_Pemilik" class="form-group t21_bank_Pemilik">
<span<?php echo $t21_bank->Pemilik->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->Pemilik->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="x<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_Pemilik" name="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" id="o<?php echo $t21_bank_grid->RowIndex ?>_Pemilik" value="<?php echo ew_HtmlEncode($t21_bank->Pemilik->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t21_bank->Bank->Visible) { // Bank ?>
		<td data-name="Bank">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t21_bank_Bank" class="form-group t21_bank_Bank">
<input type="text" data-table="t21_bank" data-field="x_Bank" name="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Bank->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Bank->EditValue ?>"<?php echo $t21_bank->Bank->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_Bank" class="form-group t21_bank_Bank">
<span<?php echo $t21_bank->Bank->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->Bank->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="x<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_Bank" name="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" id="o<?php echo $t21_bank_grid->RowIndex ?>_Bank" value="<?php echo ew_HtmlEncode($t21_bank->Bank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t21_bank->Kota->Visible) { // Kota ?>
		<td data-name="Kota">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t21_bank_Kota" class="form-group t21_bank_Kota">
<input type="text" data-table="t21_bank" data-field="x_Kota" name="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Kota->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Kota->EditValue ?>"<?php echo $t21_bank->Kota->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_Kota" class="form-group t21_bank_Kota">
<span<?php echo $t21_bank->Kota->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->Kota->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="x<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_Kota" name="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" id="o<?php echo $t21_bank_grid->RowIndex ?>_Kota" value="<?php echo ew_HtmlEncode($t21_bank->Kota->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t21_bank->Cabang->Visible) { // Cabang ?>
		<td data-name="Cabang">
<?php if ($t21_bank->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t21_bank_Cabang" class="form-group t21_bank_Cabang">
<input type="text" data-table="t21_bank" data-field="x_Cabang" name="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" size="15" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t21_bank->Cabang->getPlaceHolder()) ?>" value="<?php echo $t21_bank->Cabang->EditValue ?>"<?php echo $t21_bank->Cabang->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t21_bank_Cabang" class="form-group t21_bank_Cabang">
<span<?php echo $t21_bank->Cabang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t21_bank->Cabang->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="x<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t21_bank" data-field="x_Cabang" name="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" id="o<?php echo $t21_bank_grid->RowIndex ?>_Cabang" value="<?php echo ew_HtmlEncode($t21_bank->Cabang->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t21_bank_grid->ListOptions->Render("body", "right", $t21_bank_grid->RowCnt);
?>
<script type="text/javascript">
ft21_bankgrid.UpdateOpts(<?php echo $t21_bank_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t21_bank->CurrentMode == "add" || $t21_bank->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t21_bank_grid->FormKeyCountName ?>" id="<?php echo $t21_bank_grid->FormKeyCountName ?>" value="<?php echo $t21_bank_grid->KeyCount ?>">
<?php echo $t21_bank_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t21_bank->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t21_bank_grid->FormKeyCountName ?>" id="<?php echo $t21_bank_grid->FormKeyCountName ?>" value="<?php echo $t21_bank_grid->KeyCount ?>">
<?php echo $t21_bank_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t21_bank->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft21_bankgrid">
</div>
<?php

// Close recordset
if ($t21_bank_grid->Recordset)
	$t21_bank_grid->Recordset->Close();
?>
<?php if ($t21_bank_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t21_bank_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t21_bank_grid->TotalRecs == 0 && $t21_bank->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t21_bank_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t21_bank->Export == "") { ?>
<script type="text/javascript">
ft21_bankgrid.Init();
</script>
<?php } ?>
<?php
$t21_bank_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t21_bank_grid->Page_Terminate();
?>
