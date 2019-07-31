<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($v0402_deposito_detail_grid)) $v0402_deposito_detail_grid = new cv0402_deposito_detail_grid();

// Page init
$v0402_deposito_detail_grid->Page_Init();

// Page main
$v0402_deposito_detail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v0402_deposito_detail_grid->Page_Render();
?>
<?php if ($v0402_deposito_detail->Export == "") { ?>
<script type="text/javascript">

// Form object
var fv0402_deposito_detailgrid = new ew_Form("fv0402_deposito_detailgrid", "grid");
fv0402_deposito_detailgrid.FormKeyCountName = '<?php echo $v0402_deposito_detail_grid->FormKeyCountName ?>';

// Validate form
fv0402_deposito_detailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_dephead_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $v0402_deposito_detail->dephead_id->FldCaption(), $v0402_deposito_detail->dephead_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $v0402_deposito_detail->tanggal->FldCaption(), $v0402_deposito_detail->tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tanggal");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($v0402_deposito_detail->tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_periode");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $v0402_deposito_detail->periode->FldCaption(), $v0402_deposito_detail->periode->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jumlah_bayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $v0402_deposito_detail->jumlah_bayar->FldCaption(), $v0402_deposito_detail->jumlah_bayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jumlah_bayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($v0402_deposito_detail->jumlah_bayar->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fv0402_deposito_detailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "dephead_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "periode", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jumlah_bayar", false)) return false;
	return true;
}

// Form_CustomValidate event
fv0402_deposito_detailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv0402_deposito_detailgrid.ValidateRequired = true;
<?php } else { ?>
fv0402_deposito_detailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($v0402_deposito_detail->CurrentAction == "gridadd") {
	if ($v0402_deposito_detail->CurrentMode == "copy") {
		$bSelectLimit = $v0402_deposito_detail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$v0402_deposito_detail_grid->TotalRecs = $v0402_deposito_detail->SelectRecordCount();
			$v0402_deposito_detail_grid->Recordset = $v0402_deposito_detail_grid->LoadRecordset($v0402_deposito_detail_grid->StartRec-1, $v0402_deposito_detail_grid->DisplayRecs);
		} else {
			if ($v0402_deposito_detail_grid->Recordset = $v0402_deposito_detail_grid->LoadRecordset())
				$v0402_deposito_detail_grid->TotalRecs = $v0402_deposito_detail_grid->Recordset->RecordCount();
		}
		$v0402_deposito_detail_grid->StartRec = 1;
		$v0402_deposito_detail_grid->DisplayRecs = $v0402_deposito_detail_grid->TotalRecs;
	} else {
		$v0402_deposito_detail->CurrentFilter = "0=1";
		$v0402_deposito_detail_grid->StartRec = 1;
		$v0402_deposito_detail_grid->DisplayRecs = $v0402_deposito_detail->GridAddRowCount;
	}
	$v0402_deposito_detail_grid->TotalRecs = $v0402_deposito_detail_grid->DisplayRecs;
	$v0402_deposito_detail_grid->StopRec = $v0402_deposito_detail_grid->DisplayRecs;
} else {
	$bSelectLimit = $v0402_deposito_detail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($v0402_deposito_detail_grid->TotalRecs <= 0)
			$v0402_deposito_detail_grid->TotalRecs = $v0402_deposito_detail->SelectRecordCount();
	} else {
		if (!$v0402_deposito_detail_grid->Recordset && ($v0402_deposito_detail_grid->Recordset = $v0402_deposito_detail_grid->LoadRecordset()))
			$v0402_deposito_detail_grid->TotalRecs = $v0402_deposito_detail_grid->Recordset->RecordCount();
	}
	$v0402_deposito_detail_grid->StartRec = 1;
	$v0402_deposito_detail_grid->DisplayRecs = $v0402_deposito_detail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$v0402_deposito_detail_grid->Recordset = $v0402_deposito_detail_grid->LoadRecordset($v0402_deposito_detail_grid->StartRec-1, $v0402_deposito_detail_grid->DisplayRecs);

	// Set no record found message
	if ($v0402_deposito_detail->CurrentAction == "" && $v0402_deposito_detail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$v0402_deposito_detail_grid->setWarningMessage(ew_DeniedMsg());
		if ($v0402_deposito_detail_grid->SearchWhere == "0=101")
			$v0402_deposito_detail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$v0402_deposito_detail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$v0402_deposito_detail_grid->RenderOtherOptions();
?>
<?php $v0402_deposito_detail_grid->ShowPageHeader(); ?>
<?php
$v0402_deposito_detail_grid->ShowMessage();
?>
<?php if ($v0402_deposito_detail_grid->TotalRecs > 0 || $v0402_deposito_detail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid v0402_deposito_detail">
<div id="fv0402_deposito_detailgrid" class="ewForm form-inline">
<div id="gmp_v0402_deposito_detail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_v0402_deposito_detailgrid" class="table ewTable">
<?php echo $v0402_deposito_detail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$v0402_deposito_detail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$v0402_deposito_detail_grid->RenderListOptions();

// Render list options (header, left)
$v0402_deposito_detail_grid->ListOptions->Render("header", "left");
?>
<?php if ($v0402_deposito_detail->dephead_id->Visible) { // dephead_id ?>
	<?php if ($v0402_deposito_detail->SortUrl($v0402_deposito_detail->dephead_id) == "") { ?>
		<th data-name="dephead_id"><div id="elh_v0402_deposito_detail_dephead_id" class="v0402_deposito_detail_dephead_id"><div class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->dephead_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dephead_id"><div><div id="elh_v0402_deposito_detail_dephead_id" class="v0402_deposito_detail_dephead_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->dephead_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0402_deposito_detail->dephead_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0402_deposito_detail->dephead_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0402_deposito_detail->jurnal_id->Visible) { // jurnal_id ?>
	<?php if ($v0402_deposito_detail->SortUrl($v0402_deposito_detail->jurnal_id) == "") { ?>
		<th data-name="jurnal_id"><div id="elh_v0402_deposito_detail_jurnal_id" class="v0402_deposito_detail_jurnal_id"><div class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->jurnal_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jurnal_id"><div><div id="elh_v0402_deposito_detail_jurnal_id" class="v0402_deposito_detail_jurnal_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->jurnal_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0402_deposito_detail->jurnal_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0402_deposito_detail->jurnal_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0402_deposito_detail->tanggal->Visible) { // tanggal ?>
	<?php if ($v0402_deposito_detail->SortUrl($v0402_deposito_detail->tanggal) == "") { ?>
		<th data-name="tanggal"><div id="elh_v0402_deposito_detail_tanggal" class="v0402_deposito_detail_tanggal"><div class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->tanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal"><div><div id="elh_v0402_deposito_detail_tanggal" class="v0402_deposito_detail_tanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->tanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0402_deposito_detail->tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0402_deposito_detail->tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0402_deposito_detail->periode->Visible) { // periode ?>
	<?php if ($v0402_deposito_detail->SortUrl($v0402_deposito_detail->periode) == "") { ?>
		<th data-name="periode"><div id="elh_v0402_deposito_detail_periode" class="v0402_deposito_detail_periode"><div class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->periode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode"><div><div id="elh_v0402_deposito_detail_periode" class="v0402_deposito_detail_periode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->periode->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0402_deposito_detail->periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0402_deposito_detail->periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0402_deposito_detail->jumlah_bayar->Visible) { // jumlah_bayar ?>
	<?php if ($v0402_deposito_detail->SortUrl($v0402_deposito_detail->jumlah_bayar) == "") { ?>
		<th data-name="jumlah_bayar"><div id="elh_v0402_deposito_detail_jumlah_bayar" class="v0402_deposito_detail_jumlah_bayar"><div class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->jumlah_bayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_bayar"><div><div id="elh_v0402_deposito_detail_jumlah_bayar" class="v0402_deposito_detail_jumlah_bayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0402_deposito_detail->jumlah_bayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0402_deposito_detail->jumlah_bayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0402_deposito_detail->jumlah_bayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$v0402_deposito_detail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$v0402_deposito_detail_grid->StartRec = 1;
$v0402_deposito_detail_grid->StopRec = $v0402_deposito_detail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($v0402_deposito_detail_grid->FormKeyCountName) && ($v0402_deposito_detail->CurrentAction == "gridadd" || $v0402_deposito_detail->CurrentAction == "gridedit" || $v0402_deposito_detail->CurrentAction == "F")) {
		$v0402_deposito_detail_grid->KeyCount = $objForm->GetValue($v0402_deposito_detail_grid->FormKeyCountName);
		$v0402_deposito_detail_grid->StopRec = $v0402_deposito_detail_grid->StartRec + $v0402_deposito_detail_grid->KeyCount - 1;
	}
}
$v0402_deposito_detail_grid->RecCnt = $v0402_deposito_detail_grid->StartRec - 1;
if ($v0402_deposito_detail_grid->Recordset && !$v0402_deposito_detail_grid->Recordset->EOF) {
	$v0402_deposito_detail_grid->Recordset->MoveFirst();
	$bSelectLimit = $v0402_deposito_detail_grid->UseSelectLimit;
	if (!$bSelectLimit && $v0402_deposito_detail_grid->StartRec > 1)
		$v0402_deposito_detail_grid->Recordset->Move($v0402_deposito_detail_grid->StartRec - 1);
} elseif (!$v0402_deposito_detail->AllowAddDeleteRow && $v0402_deposito_detail_grid->StopRec == 0) {
	$v0402_deposito_detail_grid->StopRec = $v0402_deposito_detail->GridAddRowCount;
}

// Initialize aggregate
$v0402_deposito_detail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$v0402_deposito_detail->ResetAttrs();
$v0402_deposito_detail_grid->RenderRow();
if ($v0402_deposito_detail->CurrentAction == "gridadd")
	$v0402_deposito_detail_grid->RowIndex = 0;
if ($v0402_deposito_detail->CurrentAction == "gridedit")
	$v0402_deposito_detail_grid->RowIndex = 0;
while ($v0402_deposito_detail_grid->RecCnt < $v0402_deposito_detail_grid->StopRec) {
	$v0402_deposito_detail_grid->RecCnt++;
	if (intval($v0402_deposito_detail_grid->RecCnt) >= intval($v0402_deposito_detail_grid->StartRec)) {
		$v0402_deposito_detail_grid->RowCnt++;
		if ($v0402_deposito_detail->CurrentAction == "gridadd" || $v0402_deposito_detail->CurrentAction == "gridedit" || $v0402_deposito_detail->CurrentAction == "F") {
			$v0402_deposito_detail_grid->RowIndex++;
			$objForm->Index = $v0402_deposito_detail_grid->RowIndex;
			if ($objForm->HasValue($v0402_deposito_detail_grid->FormActionName))
				$v0402_deposito_detail_grid->RowAction = strval($objForm->GetValue($v0402_deposito_detail_grid->FormActionName));
			elseif ($v0402_deposito_detail->CurrentAction == "gridadd")
				$v0402_deposito_detail_grid->RowAction = "insert";
			else
				$v0402_deposito_detail_grid->RowAction = "";
		}

		// Set up key count
		$v0402_deposito_detail_grid->KeyCount = $v0402_deposito_detail_grid->RowIndex;

		// Init row class and style
		$v0402_deposito_detail->ResetAttrs();
		$v0402_deposito_detail->CssClass = "";
		if ($v0402_deposito_detail->CurrentAction == "gridadd") {
			if ($v0402_deposito_detail->CurrentMode == "copy") {
				$v0402_deposito_detail_grid->LoadRowValues($v0402_deposito_detail_grid->Recordset); // Load row values
				$v0402_deposito_detail_grid->SetRecordKey($v0402_deposito_detail_grid->RowOldKey, $v0402_deposito_detail_grid->Recordset); // Set old record key
			} else {
				$v0402_deposito_detail_grid->LoadDefaultValues(); // Load default values
				$v0402_deposito_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$v0402_deposito_detail_grid->LoadRowValues($v0402_deposito_detail_grid->Recordset); // Load row values
		}
		$v0402_deposito_detail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($v0402_deposito_detail->CurrentAction == "gridadd") // Grid add
			$v0402_deposito_detail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($v0402_deposito_detail->CurrentAction == "gridadd" && $v0402_deposito_detail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$v0402_deposito_detail_grid->RestoreCurrentRowFormValues($v0402_deposito_detail_grid->RowIndex); // Restore form values
		if ($v0402_deposito_detail->CurrentAction == "gridedit") { // Grid edit
			if ($v0402_deposito_detail->EventCancelled) {
				$v0402_deposito_detail_grid->RestoreCurrentRowFormValues($v0402_deposito_detail_grid->RowIndex); // Restore form values
			}
			if ($v0402_deposito_detail_grid->RowAction == "insert")
				$v0402_deposito_detail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$v0402_deposito_detail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($v0402_deposito_detail->CurrentAction == "gridedit" && ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT || $v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) && $v0402_deposito_detail->EventCancelled) // Update failed
			$v0402_deposito_detail_grid->RestoreCurrentRowFormValues($v0402_deposito_detail_grid->RowIndex); // Restore form values
		if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$v0402_deposito_detail_grid->EditRowCnt++;
		if ($v0402_deposito_detail->CurrentAction == "F") // Confirm row
			$v0402_deposito_detail_grid->RestoreCurrentRowFormValues($v0402_deposito_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$v0402_deposito_detail->RowAttrs = array_merge($v0402_deposito_detail->RowAttrs, array('data-rowindex'=>$v0402_deposito_detail_grid->RowCnt, 'id'=>'r' . $v0402_deposito_detail_grid->RowCnt . '_v0402_deposito_detail', 'data-rowtype'=>$v0402_deposito_detail->RowType));

		// Render row
		$v0402_deposito_detail_grid->RenderRow();

		// Render list options
		$v0402_deposito_detail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($v0402_deposito_detail_grid->RowAction <> "delete" && $v0402_deposito_detail_grid->RowAction <> "insertdelete" && !($v0402_deposito_detail_grid->RowAction == "insert" && $v0402_deposito_detail->CurrentAction == "F" && $v0402_deposito_detail_grid->EmptyRow())) {
?>
	<tr<?php echo $v0402_deposito_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$v0402_deposito_detail_grid->ListOptions->Render("body", "left", $v0402_deposito_detail_grid->RowCnt);
?>
	<?php if ($v0402_deposito_detail->dephead_id->Visible) { // dephead_id ?>
		<td data-name="dephead_id"<?php echo $v0402_deposito_detail->dephead_id->CellAttributes() ?>>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($v0402_deposito_detail->dephead_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<span<?php echo $v0402_deposito_detail->dephead_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->dephead_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<input type="text" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->dephead_id->EditValue ?>"<?php echo $v0402_deposito_detail->dephead_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->OldValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($v0402_deposito_detail->dephead_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<span<?php echo $v0402_deposito_detail->dephead_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->dephead_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<input type="text" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->dephead_id->EditValue ?>"<?php echo $v0402_deposito_detail->dephead_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_dephead_id" class="v0402_deposito_detail_dephead_id">
<span<?php echo $v0402_deposito_detail->dephead_id->ViewAttributes() ?>>
<?php echo $v0402_deposito_detail->dephead_id->ListViewValue() ?></span>
</span>
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $v0402_deposito_detail_grid->PageObjName . "_row_" . $v0402_deposito_detail_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->jurnal_id->Visible) { // jurnal_id ?>
		<td data-name="jurnal_id"<?php echo $v0402_deposito_detail->jurnal_id->CellAttributes() ?>>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->OldValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_jurnal_id" class="form-group v0402_deposito_detail_jurnal_id">
<span<?php echo $v0402_deposito_detail->jurnal_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->jurnal_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->CurrentValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_jurnal_id" class="v0402_deposito_detail_jurnal_id">
<span<?php echo $v0402_deposito_detail->jurnal_id->ViewAttributes() ?>>
<?php echo $v0402_deposito_detail->jurnal_id->ListViewValue() ?></span>
</span>
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal"<?php echo $v0402_deposito_detail->tanggal->CellAttributes() ?>>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_tanggal" class="form-group v0402_deposito_detail_tanggal">
<input type="text" data-table="v0402_deposito_detail" data-field="x_tanggal" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->tanggal->EditValue ?>"<?php echo $v0402_deposito_detail->tanggal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_tanggal" class="form-group v0402_deposito_detail_tanggal">
<input type="text" data-table="v0402_deposito_detail" data-field="x_tanggal" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->tanggal->EditValue ?>"<?php echo $v0402_deposito_detail->tanggal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_tanggal" class="v0402_deposito_detail_tanggal">
<span<?php echo $v0402_deposito_detail->tanggal->ViewAttributes() ?>>
<?php echo $v0402_deposito_detail->tanggal->ListViewValue() ?></span>
</span>
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->periode->Visible) { // periode ?>
		<td data-name="periode"<?php echo $v0402_deposito_detail->periode->CellAttributes() ?>>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_periode" class="form-group v0402_deposito_detail_periode">
<input type="text" data-table="v0402_deposito_detail" data-field="x_periode" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->periode->EditValue ?>"<?php echo $v0402_deposito_detail->periode->EditAttributes() ?>>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->OldValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_periode" class="form-group v0402_deposito_detail_periode">
<input type="text" data-table="v0402_deposito_detail" data-field="x_periode" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->periode->EditValue ?>"<?php echo $v0402_deposito_detail->periode->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_periode" class="v0402_deposito_detail_periode">
<span<?php echo $v0402_deposito_detail->periode->ViewAttributes() ?>>
<?php echo $v0402_deposito_detail->periode->ListViewValue() ?></span>
</span>
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->jumlah_bayar->Visible) { // jumlah_bayar ?>
		<td data-name="jumlah_bayar"<?php echo $v0402_deposito_detail->jumlah_bayar->CellAttributes() ?>>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_jumlah_bayar" class="form-group v0402_deposito_detail_jumlah_bayar">
<input type="text" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" size="30" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->jumlah_bayar->EditValue ?>"<?php echo $v0402_deposito_detail->jumlah_bayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->OldValue) ?>">
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_jumlah_bayar" class="form-group v0402_deposito_detail_jumlah_bayar">
<input type="text" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" size="30" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->jumlah_bayar->EditValue ?>"<?php echo $v0402_deposito_detail->jumlah_bayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $v0402_deposito_detail_grid->RowCnt ?>_v0402_deposito_detail_jumlah_bayar" class="v0402_deposito_detail_jumlah_bayar">
<span<?php echo $v0402_deposito_detail->jumlah_bayar->ViewAttributes() ?>>
<?php echo $v0402_deposito_detail->jumlah_bayar->ListViewValue() ?></span>
</span>
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="fv0402_deposito_detailgrid$x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->FormValue) ?>">
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="fv0402_deposito_detailgrid$o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v0402_deposito_detail_grid->ListOptions->Render("body", "right", $v0402_deposito_detail_grid->RowCnt);
?>
	</tr>
<?php if ($v0402_deposito_detail->RowType == EW_ROWTYPE_ADD || $v0402_deposito_detail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fv0402_deposito_detailgrid.UpdateOpts(<?php echo $v0402_deposito_detail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($v0402_deposito_detail->CurrentAction <> "gridadd" || $v0402_deposito_detail->CurrentMode == "copy")
		if (!$v0402_deposito_detail_grid->Recordset->EOF) $v0402_deposito_detail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($v0402_deposito_detail->CurrentMode == "add" || $v0402_deposito_detail->CurrentMode == "copy" || $v0402_deposito_detail->CurrentMode == "edit") {
		$v0402_deposito_detail_grid->RowIndex = '$rowindex$';
		$v0402_deposito_detail_grid->LoadDefaultValues();

		// Set row properties
		$v0402_deposito_detail->ResetAttrs();
		$v0402_deposito_detail->RowAttrs = array_merge($v0402_deposito_detail->RowAttrs, array('data-rowindex'=>$v0402_deposito_detail_grid->RowIndex, 'id'=>'r0_v0402_deposito_detail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($v0402_deposito_detail->RowAttrs["class"], "ewTemplate");
		$v0402_deposito_detail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$v0402_deposito_detail_grid->RenderRow();

		// Render list options
		$v0402_deposito_detail_grid->RenderListOptions();
		$v0402_deposito_detail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $v0402_deposito_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$v0402_deposito_detail_grid->ListOptions->Render("body", "left", $v0402_deposito_detail_grid->RowIndex);
?>
	<?php if ($v0402_deposito_detail->dephead_id->Visible) { // dephead_id ?>
		<td data-name="dephead_id">
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<?php if ($v0402_deposito_detail->dephead_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<span<?php echo $v0402_deposito_detail->dephead_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->dephead_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<input type="text" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->dephead_id->EditValue ?>"<?php echo $v0402_deposito_detail->dephead_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_dephead_id" class="form-group v0402_deposito_detail_dephead_id">
<span<?php echo $v0402_deposito_detail->dephead_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->dephead_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_dephead_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_dephead_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->dephead_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->jurnal_id->Visible) { // jurnal_id ?>
		<td data-name="jurnal_id">
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_jurnal_id" class="form-group v0402_deposito_detail_jurnal_id">
<span<?php echo $v0402_deposito_detail->jurnal_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->jurnal_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jurnal_id" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jurnal_id" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jurnal_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal">
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_v0402_deposito_detail_tanggal" class="form-group v0402_deposito_detail_tanggal">
<input type="text" data-table="v0402_deposito_detail" data-field="x_tanggal" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->tanggal->EditValue ?>"<?php echo $v0402_deposito_detail->tanggal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_tanggal" class="form-group v0402_deposito_detail_tanggal">
<span<?php echo $v0402_deposito_detail->tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->tanggal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_tanggal" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->periode->Visible) { // periode ?>
		<td data-name="periode">
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_v0402_deposito_detail_periode" class="form-group v0402_deposito_detail_periode">
<input type="text" data-table="v0402_deposito_detail" data-field="x_periode" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->periode->EditValue ?>"<?php echo $v0402_deposito_detail->periode->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_periode" class="form-group v0402_deposito_detail_periode">
<span<?php echo $v0402_deposito_detail->periode->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->periode->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_periode" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_periode" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->periode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($v0402_deposito_detail->jumlah_bayar->Visible) { // jumlah_bayar ?>
		<td data-name="jumlah_bayar">
<?php if ($v0402_deposito_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_v0402_deposito_detail_jumlah_bayar" class="form-group v0402_deposito_detail_jumlah_bayar">
<input type="text" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" size="30" placeholder="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->getPlaceHolder()) ?>" value="<?php echo $v0402_deposito_detail->jumlah_bayar->EditValue ?>"<?php echo $v0402_deposito_detail->jumlah_bayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_v0402_deposito_detail_jumlah_bayar" class="form-group v0402_deposito_detail_jumlah_bayar">
<span<?php echo $v0402_deposito_detail->jumlah_bayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $v0402_deposito_detail->jumlah_bayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="x<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="v0402_deposito_detail" data-field="x_jumlah_bayar" name="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" id="o<?php echo $v0402_deposito_detail_grid->RowIndex ?>_jumlah_bayar" value="<?php echo ew_HtmlEncode($v0402_deposito_detail->jumlah_bayar->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v0402_deposito_detail_grid->ListOptions->Render("body", "right", $v0402_deposito_detail_grid->RowCnt);
?>
<script type="text/javascript">
fv0402_deposito_detailgrid.UpdateOpts(<?php echo $v0402_deposito_detail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($v0402_deposito_detail->CurrentMode == "add" || $v0402_deposito_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $v0402_deposito_detail_grid->FormKeyCountName ?>" id="<?php echo $v0402_deposito_detail_grid->FormKeyCountName ?>" value="<?php echo $v0402_deposito_detail_grid->KeyCount ?>">
<?php echo $v0402_deposito_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($v0402_deposito_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $v0402_deposito_detail_grid->FormKeyCountName ?>" id="<?php echo $v0402_deposito_detail_grid->FormKeyCountName ?>" value="<?php echo $v0402_deposito_detail_grid->KeyCount ?>">
<?php echo $v0402_deposito_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($v0402_deposito_detail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fv0402_deposito_detailgrid">
</div>
<?php

// Close recordset
if ($v0402_deposito_detail_grid->Recordset)
	$v0402_deposito_detail_grid->Recordset->Close();
?>
<?php if ($v0402_deposito_detail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($v0402_deposito_detail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($v0402_deposito_detail_grid->TotalRecs == 0 && $v0402_deposito_detail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v0402_deposito_detail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($v0402_deposito_detail->Export == "") { ?>
<script type="text/javascript">
fv0402_deposito_detailgrid.Init();
</script>
<?php } ?>
<?php
$v0402_deposito_detail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$v0402_deposito_detail_grid->Page_Terminate();
?>
