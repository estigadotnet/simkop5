<?php

// Create page object
if (!isset($t04_pinjamanangsurantemp_grid)) $t04_pinjamanangsurantemp_grid = new ct04_pinjamanangsurantemp_grid();

// Page init
$t04_pinjamanangsurantemp_grid->Page_Init();

// Page main
$t04_pinjamanangsurantemp_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_pinjamanangsurantemp_grid->Page_Render();
?>
<?php if ($t04_pinjamanangsurantemp->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft04_pinjamanangsurantempgrid = new ew_Form("ft04_pinjamanangsurantempgrid", "grid");
ft04_pinjamanangsurantempgrid.FormKeyCountName = '<?php echo $t04_pinjamanangsurantemp_grid->FormKeyCountName ?>';

// Validate form
ft04_pinjamanangsurantempgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Angsuran_Ke");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption(), $t04_pinjamanangsurantemp->Angsuran_Ke->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption(), $t04_pinjamanangsurantemp->Angsuran_Tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Pokok");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption(), $t04_pinjamanangsurantemp->Angsuran_Pokok->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption(), $t04_pinjamanangsurantemp->Angsuran_Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Total");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption(), $t04_pinjamanangsurantemp->Angsuran_Total->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Sisa_Hutang");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption(), $t04_pinjamanangsurantemp->Sisa_Hutang->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Bayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption(), $t04_pinjamanangsurantemp->Tanggal_Bayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Bayar");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Tanggal_Bayar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Terlambat");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Terlambat->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Total_Denda");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Total_Denda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Titipan");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Bayar_Titipan->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Non_Titipan");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t04_pinjamanangsurantemp->Bayar_Total->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft04_pinjamanangsurantempgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "Angsuran_Ke", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Angsuran_Tanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Angsuran_Pokok", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Angsuran_Bunga", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Angsuran_Total", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Sisa_Hutang", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tanggal_Bayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Terlambat", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Total_Denda", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Titipan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Non_Titipan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Total", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	return true;
}

// Form_CustomValidate event
ft04_pinjamanangsurantempgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_pinjamanangsurantempgrid.ValidateRequired = true;
<?php } else { ?>
ft04_pinjamanangsurantempgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd") {
	if ($t04_pinjamanangsurantemp->CurrentMode == "copy") {
		$bSelectLimit = $t04_pinjamanangsurantemp_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t04_pinjamanangsurantemp_grid->TotalRecs = $t04_pinjamanangsurantemp->SelectRecordCount();
			$t04_pinjamanangsurantemp_grid->Recordset = $t04_pinjamanangsurantemp_grid->LoadRecordset($t04_pinjamanangsurantemp_grid->StartRec-1, $t04_pinjamanangsurantemp_grid->DisplayRecs);
		} else {
			if ($t04_pinjamanangsurantemp_grid->Recordset = $t04_pinjamanangsurantemp_grid->LoadRecordset())
				$t04_pinjamanangsurantemp_grid->TotalRecs = $t04_pinjamanangsurantemp_grid->Recordset->RecordCount();
		}
		$t04_pinjamanangsurantemp_grid->StartRec = 1;
		$t04_pinjamanangsurantemp_grid->DisplayRecs = $t04_pinjamanangsurantemp_grid->TotalRecs;
	} else {
		$t04_pinjamanangsurantemp->CurrentFilter = "0=1";
		$t04_pinjamanangsurantemp_grid->StartRec = 1;
		$t04_pinjamanangsurantemp_grid->DisplayRecs = $t04_pinjamanangsurantemp->GridAddRowCount;
	}
	$t04_pinjamanangsurantemp_grid->TotalRecs = $t04_pinjamanangsurantemp_grid->DisplayRecs;
	$t04_pinjamanangsurantemp_grid->StopRec = $t04_pinjamanangsurantemp_grid->DisplayRecs;
} else {
	$bSelectLimit = $t04_pinjamanangsurantemp_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t04_pinjamanangsurantemp_grid->TotalRecs <= 0)
			$t04_pinjamanangsurantemp_grid->TotalRecs = $t04_pinjamanangsurantemp->SelectRecordCount();
	} else {
		if (!$t04_pinjamanangsurantemp_grid->Recordset && ($t04_pinjamanangsurantemp_grid->Recordset = $t04_pinjamanangsurantemp_grid->LoadRecordset()))
			$t04_pinjamanangsurantemp_grid->TotalRecs = $t04_pinjamanangsurantemp_grid->Recordset->RecordCount();
	}
	$t04_pinjamanangsurantemp_grid->StartRec = 1;
	$t04_pinjamanangsurantemp_grid->DisplayRecs = $t04_pinjamanangsurantemp_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t04_pinjamanangsurantemp_grid->Recordset = $t04_pinjamanangsurantemp_grid->LoadRecordset($t04_pinjamanangsurantemp_grid->StartRec-1, $t04_pinjamanangsurantemp_grid->DisplayRecs);

	// Set no record found message
	if ($t04_pinjamanangsurantemp->CurrentAction == "" && $t04_pinjamanangsurantemp_grid->TotalRecs == 0) {
		if ($t04_pinjamanangsurantemp_grid->SearchWhere == "0=101")
			$t04_pinjamanangsurantemp_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t04_pinjamanangsurantemp_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t04_pinjamanangsurantemp_grid->RenderOtherOptions();
?>
<?php $t04_pinjamanangsurantemp_grid->ShowPageHeader(); ?>
<?php
$t04_pinjamanangsurantemp_grid->ShowMessage();
?>
<?php if ($t04_pinjamanangsurantemp_grid->TotalRecs > 0 || $t04_pinjamanangsurantemp->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t04_pinjamanangsurantemp">
<div id="ft04_pinjamanangsurantempgrid" class="ewForm form-inline">
<div id="gmp_t04_pinjamanangsurantemp" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t04_pinjamanangsurantempgrid" class="table ewTable">
<?php echo $t04_pinjamanangsurantemp->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t04_pinjamanangsurantemp_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t04_pinjamanangsurantemp_grid->RenderListOptions();

// Render list options (header, left)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("header", "left");
?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Ke) == "") { ?>
		<th data-name="Angsuran_Ke"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Ke"><div><div id="elh_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Ke->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Tanggal) == "") { ?>
		<th data-name="Angsuran_Tanggal"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Tanggal"><div><div id="elh_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Pokok) == "") { ?>
		<th data-name="Angsuran_Pokok"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Pokok"><div><div id="elh_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Pokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Bunga) == "") { ?>
		<th data-name="Angsuran_Bunga"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Bunga"><div><div id="elh_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Total) == "") { ?>
		<th data-name="Angsuran_Total"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Total"><div><div id="elh_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Sisa_Hutang) == "") { ?>
		<th data-name="Sisa_Hutang"><div id="elh_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sisa_Hutang"><div><div id="elh_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Sisa_Hutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Tanggal_Bayar) == "") { ?>
		<th data-name="Tanggal_Bayar"><div id="elh_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal_Bayar"><div><div id="elh_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Tanggal_Bayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Terlambat) == "") { ?>
		<th data-name="Terlambat"><div id="elh_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Terlambat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terlambat"><div><div id="elh_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Terlambat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Terlambat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Terlambat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Total_Denda) == "") { ?>
		<th data-name="Total_Denda"><div id="elh_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Total_Denda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Total_Denda"><div><div id="elh_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Total_Denda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Total_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Total_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Titipan) == "") { ?>
		<th data-name="Bayar_Titipan"><div id="elh_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Titipan"><div><div id="elh_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Non_Titipan) == "") { ?>
		<th data-name="Bayar_Non_Titipan"><div id="elh_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Non_Titipan"><div><div id="elh_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Total) == "") { ?>
		<th data-name="Bayar_Total"><div id="elh_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Total"><div><div id="elh_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div><div id="elh_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t04_pinjamanangsurantemp_grid->StartRec = 1;
$t04_pinjamanangsurantemp_grid->StopRec = $t04_pinjamanangsurantemp_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t04_pinjamanangsurantemp_grid->FormKeyCountName) && ($t04_pinjamanangsurantemp->CurrentAction == "gridadd" || $t04_pinjamanangsurantemp->CurrentAction == "gridedit" || $t04_pinjamanangsurantemp->CurrentAction == "F")) {
		$t04_pinjamanangsurantemp_grid->KeyCount = $objForm->GetValue($t04_pinjamanangsurantemp_grid->FormKeyCountName);
		$t04_pinjamanangsurantemp_grid->StopRec = $t04_pinjamanangsurantemp_grid->StartRec + $t04_pinjamanangsurantemp_grid->KeyCount - 1;
	}
}
$t04_pinjamanangsurantemp_grid->RecCnt = $t04_pinjamanangsurantemp_grid->StartRec - 1;
if ($t04_pinjamanangsurantemp_grid->Recordset && !$t04_pinjamanangsurantemp_grid->Recordset->EOF) {
	$t04_pinjamanangsurantemp_grid->Recordset->MoveFirst();
	$bSelectLimit = $t04_pinjamanangsurantemp_grid->UseSelectLimit;
	if (!$bSelectLimit && $t04_pinjamanangsurantemp_grid->StartRec > 1)
		$t04_pinjamanangsurantemp_grid->Recordset->Move($t04_pinjamanangsurantemp_grid->StartRec - 1);
} elseif (!$t04_pinjamanangsurantemp->AllowAddDeleteRow && $t04_pinjamanangsurantemp_grid->StopRec == 0) {
	$t04_pinjamanangsurantemp_grid->StopRec = $t04_pinjamanangsurantemp->GridAddRowCount;
}

// Initialize aggregate
$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t04_pinjamanangsurantemp->ResetAttrs();
$t04_pinjamanangsurantemp_grid->RenderRow();
if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd")
	$t04_pinjamanangsurantemp_grid->RowIndex = 0;
if ($t04_pinjamanangsurantemp->CurrentAction == "gridedit")
	$t04_pinjamanangsurantemp_grid->RowIndex = 0;
while ($t04_pinjamanangsurantemp_grid->RecCnt < $t04_pinjamanangsurantemp_grid->StopRec) {
	$t04_pinjamanangsurantemp_grid->RecCnt++;
	if (intval($t04_pinjamanangsurantemp_grid->RecCnt) >= intval($t04_pinjamanangsurantemp_grid->StartRec)) {
		$t04_pinjamanangsurantemp_grid->RowCnt++;
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd" || $t04_pinjamanangsurantemp->CurrentAction == "gridedit" || $t04_pinjamanangsurantemp->CurrentAction == "F") {
			$t04_pinjamanangsurantemp_grid->RowIndex++;
			$objForm->Index = $t04_pinjamanangsurantemp_grid->RowIndex;
			if ($objForm->HasValue($t04_pinjamanangsurantemp_grid->FormActionName))
				$t04_pinjamanangsurantemp_grid->RowAction = strval($objForm->GetValue($t04_pinjamanangsurantemp_grid->FormActionName));
			elseif ($t04_pinjamanangsurantemp->CurrentAction == "gridadd")
				$t04_pinjamanangsurantemp_grid->RowAction = "insert";
			else
				$t04_pinjamanangsurantemp_grid->RowAction = "";
		}

		// Set up key count
		$t04_pinjamanangsurantemp_grid->KeyCount = $t04_pinjamanangsurantemp_grid->RowIndex;

		// Init row class and style
		$t04_pinjamanangsurantemp->ResetAttrs();
		$t04_pinjamanangsurantemp->CssClass = "";
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd") {
			if ($t04_pinjamanangsurantemp->CurrentMode == "copy") {
				$t04_pinjamanangsurantemp_grid->LoadRowValues($t04_pinjamanangsurantemp_grid->Recordset); // Load row values
				$t04_pinjamanangsurantemp_grid->SetRecordKey($t04_pinjamanangsurantemp_grid->RowOldKey, $t04_pinjamanangsurantemp_grid->Recordset); // Set old record key
			} else {
				$t04_pinjamanangsurantemp_grid->LoadDefaultValues(); // Load default values
				$t04_pinjamanangsurantemp_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t04_pinjamanangsurantemp_grid->LoadRowValues($t04_pinjamanangsurantemp_grid->Recordset); // Load row values
		}
		$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd") // Grid add
			$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd" && $t04_pinjamanangsurantemp->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t04_pinjamanangsurantemp_grid->RestoreCurrentRowFormValues($t04_pinjamanangsurantemp_grid->RowIndex); // Restore form values
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridedit") { // Grid edit
			if ($t04_pinjamanangsurantemp->EventCancelled) {
				$t04_pinjamanangsurantemp_grid->RestoreCurrentRowFormValues($t04_pinjamanangsurantemp_grid->RowIndex); // Restore form values
			}
			if ($t04_pinjamanangsurantemp_grid->RowAction == "insert")
				$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridedit" && ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT || $t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) && $t04_pinjamanangsurantemp->EventCancelled) // Update failed
			$t04_pinjamanangsurantemp_grid->RestoreCurrentRowFormValues($t04_pinjamanangsurantemp_grid->RowIndex); // Restore form values
		if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t04_pinjamanangsurantemp_grid->EditRowCnt++;
		if ($t04_pinjamanangsurantemp->CurrentAction == "F") // Confirm row
			$t04_pinjamanangsurantemp_grid->RestoreCurrentRowFormValues($t04_pinjamanangsurantemp_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t04_pinjamanangsurantemp->RowAttrs = array_merge($t04_pinjamanangsurantemp->RowAttrs, array('data-rowindex'=>$t04_pinjamanangsurantemp_grid->RowCnt, 'id'=>'r' . $t04_pinjamanangsurantemp_grid->RowCnt . '_t04_pinjamanangsurantemp', 'data-rowtype'=>$t04_pinjamanangsurantemp->RowType));

		// Render row
		$t04_pinjamanangsurantemp_grid->RenderRow();

		// Render list options
		$t04_pinjamanangsurantemp_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t04_pinjamanangsurantemp_grid->RowAction <> "delete" && $t04_pinjamanangsurantemp_grid->RowAction <> "insertdelete" && !($t04_pinjamanangsurantemp_grid->RowAction == "insert" && $t04_pinjamanangsurantemp->CurrentAction == "F" && $t04_pinjamanangsurantemp_grid->EmptyRow())) {
?>
	<tr<?php echo $t04_pinjamanangsurantemp->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("body", "left", $t04_pinjamanangsurantemp_grid->RowCnt);
?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
		<td data-name="Angsuran_Ke"<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Ke" class="form-group t04_pinjamanangsurantemp_Angsuran_Ke">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Ke" class="form-group t04_pinjamanangsurantemp_Angsuran_Ke">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t04_pinjamanangsurantemp_grid->PageObjName . "_row_" . $t04_pinjamanangsurantemp_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_id" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->id->CurrentValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_id" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->id->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT || $t04_pinjamanangsurantemp->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_id" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
		<td data-name="Angsuran_Tanggal"<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="form-group t04_pinjamanangsurantemp_Angsuran_Tanggal">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" data-format="7" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="form-group t04_pinjamanangsurantemp_Angsuran_Tanggal">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<td data-name="Angsuran_Pokok"<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Pokok" class="form-group t04_pinjamanangsurantemp_Angsuran_Pokok">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Pokok" class="form-group t04_pinjamanangsurantemp_Angsuran_Pokok">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<td data-name="Angsuran_Bunga"<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Bunga" class="form-group t04_pinjamanangsurantemp_Angsuran_Bunga">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Bunga" class="form-group t04_pinjamanangsurantemp_Angsuran_Bunga">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<td data-name="Angsuran_Total"<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Total" class="form-group t04_pinjamanangsurantemp_Angsuran_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Total" class="form-group t04_pinjamanangsurantemp_Angsuran_Total">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
		<td data-name="Sisa_Hutang"<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Sisa_Hutang" class="form-group t04_pinjamanangsurantemp_Sisa_Hutang">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Sisa_Hutang" class="form-group t04_pinjamanangsurantemp_Sisa_Hutang">
<span<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->CurrentValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang">
<span<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
		<td data-name="Tanggal_Bayar"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Tanggal_Bayar" class="form-group t04_pinjamanangsurantemp_Tanggal_Bayar">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" data-format="7" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttributes() ?>>
<?php if (!$t04_pinjamanangsurantemp->Tanggal_Bayar->ReadOnly && !$t04_pinjamanangsurantemp->Tanggal_Bayar->Disabled && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["readonly"]) && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_pinjamanangsurantempgrid", "x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Tanggal_Bayar" class="form-group t04_pinjamanangsurantemp_Tanggal_Bayar">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" data-format="7" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttributes() ?>>
<?php if (!$t04_pinjamanangsurantemp->Tanggal_Bayar->ReadOnly && !$t04_pinjamanangsurantemp->Tanggal_Bayar->Disabled && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["readonly"]) && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_pinjamanangsurantempgrid", "x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar">
<span<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat"<?php echo $t04_pinjamanangsurantemp->Terlambat->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Terlambat" class="form-group t04_pinjamanangsurantemp_Terlambat">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Terlambat->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Terlambat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Terlambat" class="form-group t04_pinjamanangsurantemp_Terlambat">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Terlambat->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Terlambat->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat">
<span<?php echo $t04_pinjamanangsurantemp->Terlambat->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Terlambat->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
		<td data-name="Total_Denda"<?php echo $t04_pinjamanangsurantemp->Total_Denda->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Total_Denda" class="form-group t04_pinjamanangsurantemp_Total_Denda">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Total_Denda" class="form-group t04_pinjamanangsurantemp_Total_Denda">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda">
<span<?php echo $t04_pinjamanangsurantemp->Total_Denda->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Total_Denda->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
		<td data-name="Bayar_Titipan"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
		<td data-name="Bayar_Non_Titipan"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
		<td data-name="Bayar_Total"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Total" class="form-group t04_pinjamanangsurantemp_Bayar_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Total" class="form-group t04_pinjamanangsurantemp_Bayar_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Total->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Total->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t04_pinjamanangsurantemp->Keterangan->CellAttributes() ?>>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Keterangan" class="form-group t04_pinjamanangsurantemp_Keterangan">
<textarea data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_pinjamanangsurantemp->Keterangan->EditAttributes() ?>><?php echo $t04_pinjamanangsurantemp->Keterangan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Keterangan" class="form-group t04_pinjamanangsurantemp_Keterangan">
<textarea data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_pinjamanangsurantemp->Keterangan->EditAttributes() ?>><?php echo $t04_pinjamanangsurantemp->Keterangan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t04_pinjamanangsurantemp_grid->RowCnt ?>_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan">
<span<?php echo $t04_pinjamanangsurantemp->Keterangan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Keterangan->ListViewValue() ?></span>
</span>
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="ft04_pinjamanangsurantempgrid$x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="ft04_pinjamanangsurantempgrid$o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("body", "right", $t04_pinjamanangsurantemp_grid->RowCnt);
?>
	</tr>
<?php if ($t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_ADD || $t04_pinjamanangsurantemp->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft04_pinjamanangsurantempgrid.UpdateOpts(<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t04_pinjamanangsurantemp->CurrentAction <> "gridadd" || $t04_pinjamanangsurantemp->CurrentMode == "copy")
		if (!$t04_pinjamanangsurantemp_grid->Recordset->EOF) $t04_pinjamanangsurantemp_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t04_pinjamanangsurantemp->CurrentMode == "add" || $t04_pinjamanangsurantemp->CurrentMode == "copy" || $t04_pinjamanangsurantemp->CurrentMode == "edit") {
		$t04_pinjamanangsurantemp_grid->RowIndex = '$rowindex$';
		$t04_pinjamanangsurantemp_grid->LoadDefaultValues();

		// Set row properties
		$t04_pinjamanangsurantemp->ResetAttrs();
		$t04_pinjamanangsurantemp->RowAttrs = array_merge($t04_pinjamanangsurantemp->RowAttrs, array('data-rowindex'=>$t04_pinjamanangsurantemp_grid->RowIndex, 'id'=>'r0_t04_pinjamanangsurantemp', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t04_pinjamanangsurantemp->RowAttrs["class"], "ewTemplate");
		$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t04_pinjamanangsurantemp_grid->RenderRow();

		// Render list options
		$t04_pinjamanangsurantemp_grid->RenderListOptions();
		$t04_pinjamanangsurantemp_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t04_pinjamanangsurantemp->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("body", "left", $t04_pinjamanangsurantemp_grid->RowIndex);
?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
		<td data-name="Angsuran_Ke">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Ke" class="form-group t04_pinjamanangsurantemp_Angsuran_Ke">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Ke" class="form-group t04_pinjamanangsurantemp_Angsuran_Ke">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
		<td data-name="Angsuran_Tanggal">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="form-group t04_pinjamanangsurantemp_Angsuran_Tanggal">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" data-format="7" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="form-group t04_pinjamanangsurantemp_Angsuran_Tanggal">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<td data-name="Angsuran_Pokok">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Pokok" class="form-group t04_pinjamanangsurantemp_Angsuran_Pokok">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Pokok" class="form-group t04_pinjamanangsurantemp_Angsuran_Pokok">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<td data-name="Angsuran_Bunga">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Bunga" class="form-group t04_pinjamanangsurantemp_Angsuran_Bunga">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Bunga" class="form-group t04_pinjamanangsurantemp_Angsuran_Bunga">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<td data-name="Angsuran_Total">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Total" class="form-group t04_pinjamanangsurantemp_Angsuran_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Angsuran_Total" class="form-group t04_pinjamanangsurantemp_Angsuran_Total">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
		<td data-name="Sisa_Hutang">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Sisa_Hutang" class="form-group t04_pinjamanangsurantemp_Sisa_Hutang">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Sisa_Hutang" class="form-group t04_pinjamanangsurantemp_Sisa_Hutang">
<span<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
		<td data-name="Tanggal_Bayar">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Tanggal_Bayar" class="form-group t04_pinjamanangsurantemp_Tanggal_Bayar">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" data-format="7" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttributes() ?>>
<?php if (!$t04_pinjamanangsurantemp->Tanggal_Bayar->ReadOnly && !$t04_pinjamanangsurantemp->Tanggal_Bayar->Disabled && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["readonly"]) && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_pinjamanangsurantempgrid", "x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar", 7);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Tanggal_Bayar" class="form-group t04_pinjamanangsurantemp_Tanggal_Bayar">
<span<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Tanggal_Bayar" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Terlambat" class="form-group t04_pinjamanangsurantemp_Terlambat">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Terlambat->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Terlambat->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Terlambat" class="form-group t04_pinjamanangsurantemp_Terlambat">
<span<?php echo $t04_pinjamanangsurantemp->Terlambat->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Terlambat->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Terlambat" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
		<td data-name="Total_Denda">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Total_Denda" class="form-group t04_pinjamanangsurantemp_Total_Denda">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Total_Denda" class="form-group t04_pinjamanangsurantemp_Total_Denda">
<span<?php echo $t04_pinjamanangsurantemp->Total_Denda->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Total_Denda->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Total_Denda" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
		<td data-name="Bayar_Titipan">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
		<td data-name="Bayar_Non_Titipan">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="form-group t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Non_Titipan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
		<td data-name="Bayar_Total">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Total" class="form-group t04_pinjamanangsurantemp_Bayar_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Bayar_Total" class="form-group t04_pinjamanangsurantemp_Bayar_Total">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Total->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Bayar_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Keterangan" class="form-group t04_pinjamanangsurantemp_Keterangan">
<textarea data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_pinjamanangsurantemp->Keterangan->EditAttributes() ?>><?php echo $t04_pinjamanangsurantemp->Keterangan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t04_pinjamanangsurantemp_Keterangan" class="form-group t04_pinjamanangsurantemp_Keterangan">
<span<?php echo $t04_pinjamanangsurantemp->Keterangan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Keterangan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_pinjamanangsurantemp_grid->ListOptions->Render("body", "right", $t04_pinjamanangsurantemp_grid->RowCnt);
?>
<script type="text/javascript">
ft04_pinjamanangsurantempgrid.UpdateOpts(<?php echo $t04_pinjamanangsurantemp_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t04_pinjamanangsurantemp->CurrentMode == "add" || $t04_pinjamanangsurantemp->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t04_pinjamanangsurantemp_grid->FormKeyCountName ?>" id="<?php echo $t04_pinjamanangsurantemp_grid->FormKeyCountName ?>" value="<?php echo $t04_pinjamanangsurantemp_grid->KeyCount ?>">
<?php echo $t04_pinjamanangsurantemp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t04_pinjamanangsurantemp_grid->FormKeyCountName ?>" id="<?php echo $t04_pinjamanangsurantemp_grid->FormKeyCountName ?>" value="<?php echo $t04_pinjamanangsurantemp_grid->KeyCount ?>">
<?php echo $t04_pinjamanangsurantemp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft04_pinjamanangsurantempgrid">
</div>
<?php

// Close recordset
if ($t04_pinjamanangsurantemp_grid->Recordset)
	$t04_pinjamanangsurantemp_grid->Recordset->Close();
?>
<?php if ($t04_pinjamanangsurantemp_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t04_pinjamanangsurantemp_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp_grid->TotalRecs == 0 && $t04_pinjamanangsurantemp->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_pinjamanangsurantemp_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Export == "") { ?>
<script type="text/javascript">
ft04_pinjamanangsurantempgrid.Init();
</script>
<?php } ?>
<?php
$t04_pinjamanangsurantemp_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t04_pinjamanangsurantemp_grid->Page_Terminate();
?>
