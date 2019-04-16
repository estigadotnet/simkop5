<?php

// Global variable for table object
$r01_pinjaman = NULL;

//
// Table class for r01_pinjaman
//
class crr01_pinjaman extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $id;
	var $Kontrak_No;
	var $Kontrak_Tgl;
	var $nasabah_id;
	var $NamaNasabah;
	var $jaminan_id;
	var $NamaJaminan;
	var $Pinjaman;
	var $Angsuran_Lama;
	var $Angsuran_Bunga_Prosen;
	var $Angsuran_Denda;
	var $Dispensasi_Denda;
	var $Angsuran_Pokok;
	var $Angsuran_Bunga;
	var $Angsuran_Total;
	var $No_Ref;
	var $Biaya_Administrasi;
	var $Biaya_Materai;
	var $marketing_id;
	var $NamaMarketing;
	var $Periode;
	var $Macet;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'r01_pinjaman';
		$this->TableName = 'r01_pinjaman';
		$this->TableType = 'REPORT';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// id
		$this->id = new crField('r01_pinjaman', 'r01_pinjaman', 'x_id', 'id', '`id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;
		$this->id->DateFilter = "";
		$this->id->SqlSelect = "";
		$this->id->SqlOrderBy = "";

		// Kontrak_No
		$this->Kontrak_No = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Kontrak_No', 'Kontrak_No', '`Kontrak_No`', 200, EWR_DATATYPE_STRING, -1);
		$this->Kontrak_No->Sortable = TRUE; // Allow sort
		$this->fields['Kontrak_No'] = &$this->Kontrak_No;
		$this->Kontrak_No->DateFilter = "";
		$this->Kontrak_No->SqlSelect = "";
		$this->Kontrak_No->SqlOrderBy = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Kontrak_Tgl', 'Kontrak_Tgl', '`Kontrak_Tgl`', 133, EWR_DATATYPE_DATE, 7);
		$this->Kontrak_Tgl->Sortable = TRUE; // Allow sort
		$this->Kontrak_Tgl->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectField");
		$this->fields['Kontrak_Tgl'] = &$this->Kontrak_Tgl;
		$this->Kontrak_Tgl->DateFilter = "";
		$this->Kontrak_Tgl->SqlSelect = "";
		$this->Kontrak_Tgl->SqlOrderBy = "";

		// nasabah_id
		$this->nasabah_id = new crField('r01_pinjaman', 'r01_pinjaman', 'x_nasabah_id', 'nasabah_id', '`nasabah_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->nasabah_id->Sortable = TRUE; // Allow sort
		$this->nasabah_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['nasabah_id'] = &$this->nasabah_id;
		$this->nasabah_id->DateFilter = "";
		$this->nasabah_id->SqlSelect = "";
		$this->nasabah_id->SqlOrderBy = "";

		// NamaNasabah
		$this->NamaNasabah = new crField('r01_pinjaman', 'r01_pinjaman', 'x_NamaNasabah', 'NamaNasabah', '`NamaNasabah`', 200, EWR_DATATYPE_STRING, -1);
		$this->NamaNasabah->Sortable = TRUE; // Allow sort
		$this->fields['NamaNasabah'] = &$this->NamaNasabah;
		$this->NamaNasabah->DateFilter = "";
		$this->NamaNasabah->SqlSelect = "";
		$this->NamaNasabah->SqlOrderBy = "";

		// jaminan_id
		$this->jaminan_id = new crField('r01_pinjaman', 'r01_pinjaman', 'x_jaminan_id', 'jaminan_id', '`jaminan_id`', 200, EWR_DATATYPE_STRING, -1);
		$this->jaminan_id->Sortable = TRUE; // Allow sort
		$this->fields['jaminan_id'] = &$this->jaminan_id;
		$this->jaminan_id->DateFilter = "";
		$this->jaminan_id->SqlSelect = "";
		$this->jaminan_id->SqlOrderBy = "";

		// NamaJaminan
		$this->NamaJaminan = new crField('r01_pinjaman', 'r01_pinjaman', 'x_NamaJaminan', 'NamaJaminan', '`NamaJaminan`', 201, EWR_DATATYPE_MEMO, -1);
		$this->NamaJaminan->Sortable = TRUE; // Allow sort
		$this->fields['NamaJaminan'] = &$this->NamaJaminan;
		$this->NamaJaminan->DateFilter = "";
		$this->NamaJaminan->SqlSelect = "";
		$this->NamaJaminan->SqlOrderBy = "";

		// Pinjaman
		$this->Pinjaman = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Pinjaman', 'Pinjaman', '`Pinjaman`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Pinjaman->Sortable = TRUE; // Allow sort
		$this->Pinjaman->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Pinjaman'] = &$this->Pinjaman;
		$this->Pinjaman->DateFilter = "";
		$this->Pinjaman->SqlSelect = "";
		$this->Pinjaman->SqlOrderBy = "";

		// Angsuran_Lama
		$this->Angsuran_Lama = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Lama', 'Angsuran_Lama', '`Angsuran_Lama`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Lama->Sortable = TRUE; // Allow sort
		$this->Angsuran_Lama->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Angsuran_Lama'] = &$this->Angsuran_Lama;
		$this->Angsuran_Lama->DateFilter = "";
		$this->Angsuran_Lama->SqlSelect = "";
		$this->Angsuran_Lama->SqlOrderBy = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Bunga_Prosen', 'Angsuran_Bunga_Prosen', '`Angsuran_Bunga_Prosen`', 131, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Bunga_Prosen->Sortable = TRUE; // Allow sort
		$this->Angsuran_Bunga_Prosen->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Bunga_Prosen'] = &$this->Angsuran_Bunga_Prosen;
		$this->Angsuran_Bunga_Prosen->DateFilter = "";
		$this->Angsuran_Bunga_Prosen->SqlSelect = "";
		$this->Angsuran_Bunga_Prosen->SqlOrderBy = "";

		// Angsuran_Denda
		$this->Angsuran_Denda = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Denda', 'Angsuran_Denda', '`Angsuran_Denda`', 131, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Denda->Sortable = TRUE; // Allow sort
		$this->Angsuran_Denda->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Denda'] = &$this->Angsuran_Denda;
		$this->Angsuran_Denda->DateFilter = "";
		$this->Angsuran_Denda->SqlSelect = "";
		$this->Angsuran_Denda->SqlOrderBy = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Dispensasi_Denda', 'Dispensasi_Denda', '`Dispensasi_Denda`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->Dispensasi_Denda->Sortable = TRUE; // Allow sort
		$this->Dispensasi_Denda->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Dispensasi_Denda'] = &$this->Dispensasi_Denda;
		$this->Dispensasi_Denda->DateFilter = "";
		$this->Dispensasi_Denda->SqlSelect = "";
		$this->Dispensasi_Denda->SqlOrderBy = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Pokok', 'Angsuran_Pokok', '`Angsuran_Pokok`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Pokok->Sortable = TRUE; // Allow sort
		$this->Angsuran_Pokok->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Pokok'] = &$this->Angsuran_Pokok;
		$this->Angsuran_Pokok->DateFilter = "";
		$this->Angsuran_Pokok->SqlSelect = "";
		$this->Angsuran_Pokok->SqlOrderBy = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Bunga', 'Angsuran_Bunga', '`Angsuran_Bunga`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Bunga->Sortable = TRUE; // Allow sort
		$this->Angsuran_Bunga->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Bunga'] = &$this->Angsuran_Bunga;
		$this->Angsuran_Bunga->DateFilter = "";
		$this->Angsuran_Bunga->SqlSelect = "";
		$this->Angsuran_Bunga->SqlOrderBy = "";

		// Angsuran_Total
		$this->Angsuran_Total = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Angsuran_Total', 'Angsuran_Total', '`Angsuran_Total`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Angsuran_Total->Sortable = TRUE; // Allow sort
		$this->Angsuran_Total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Total'] = &$this->Angsuran_Total;
		$this->Angsuran_Total->DateFilter = "";
		$this->Angsuran_Total->SqlSelect = "";
		$this->Angsuran_Total->SqlOrderBy = "";

		// No_Ref
		$this->No_Ref = new crField('r01_pinjaman', 'r01_pinjaman', 'x_No_Ref', 'No_Ref', '`No_Ref`', 200, EWR_DATATYPE_STRING, -1);
		$this->No_Ref->Sortable = TRUE; // Allow sort
		$this->fields['No_Ref'] = &$this->No_Ref;
		$this->No_Ref->DateFilter = "";
		$this->No_Ref->SqlSelect = "";
		$this->No_Ref->SqlOrderBy = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Biaya_Administrasi', 'Biaya_Administrasi', '`Biaya_Administrasi`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Biaya_Administrasi->Sortable = TRUE; // Allow sort
		$this->Biaya_Administrasi->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Biaya_Administrasi'] = &$this->Biaya_Administrasi;
		$this->Biaya_Administrasi->DateFilter = "";
		$this->Biaya_Administrasi->SqlSelect = "";
		$this->Biaya_Administrasi->SqlOrderBy = "";

		// Biaya_Materai
		$this->Biaya_Materai = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Biaya_Materai', 'Biaya_Materai', '`Biaya_Materai`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Biaya_Materai->Sortable = TRUE; // Allow sort
		$this->Biaya_Materai->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Biaya_Materai'] = &$this->Biaya_Materai;
		$this->Biaya_Materai->DateFilter = "";
		$this->Biaya_Materai->SqlSelect = "";
		$this->Biaya_Materai->SqlOrderBy = "";

		// marketing_id
		$this->marketing_id = new crField('r01_pinjaman', 'r01_pinjaman', 'x_marketing_id', 'marketing_id', '`marketing_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->marketing_id->Sortable = TRUE; // Allow sort
		$this->marketing_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['marketing_id'] = &$this->marketing_id;
		$this->marketing_id->DateFilter = "";
		$this->marketing_id->SqlSelect = "";
		$this->marketing_id->SqlOrderBy = "";

		// NamaMarketing
		$this->NamaMarketing = new crField('r01_pinjaman', 'r01_pinjaman', 'x_NamaMarketing', 'NamaMarketing', '`NamaMarketing`', 200, EWR_DATATYPE_STRING, -1);
		$this->NamaMarketing->Sortable = TRUE; // Allow sort
		$this->fields['NamaMarketing'] = &$this->NamaMarketing;
		$this->NamaMarketing->DateFilter = "";
		$this->NamaMarketing->SqlSelect = "";
		$this->NamaMarketing->SqlOrderBy = "";

		// Periode
		$this->Periode = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Periode', 'Periode', '`Periode`', 200, EWR_DATATYPE_STRING, -1);
		$this->Periode->Sortable = TRUE; // Allow sort
		$this->fields['Periode'] = &$this->Periode;
		$this->Periode->DateFilter = "";
		$this->Periode->SqlSelect = "";
		$this->Periode->SqlOrderBy = "";

		// Macet
		$this->Macet = new crField('r01_pinjaman', 'r01_pinjaman', 'x_Macet', 'Macet', '`Macet`', 202, EWR_DATATYPE_STRING, -1);
		$this->Macet->Sortable = TRUE; // Allow sort
		$this->fields['Macet'] = &$this->Macet;
		$this->Macet->DateFilter = "";
		$this->Macet->SqlSelect = "";
		$this->Macet->SqlOrderBy = "";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t03_pinjaman`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, (select Nama from t01_nasabah where id = nasabah_id) AS `NamaNasabah`, (select Merk_Type from t02_jaminan where id = jaminan_id) AS `NamaJaminan`, (select Nama from t07_marketing where id = marketing_id) AS `NamaMarketing` FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Table Level Group SQL
	// First Group Field

	var $_SqlFirstGroupField = "";

	function getSqlFirstGroupField() {
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "";
	}

	function SqlFirstGroupField() { // For backward compatibility
		return $this->getSqlFirstGroupField();
	}

	function setSqlFirstGroupField($v) {
		$this->_SqlFirstGroupField = $v;
	}

	// Select Group
	var $_SqlSelectGroup = "";

	function getSqlSelectGroup() {
		return ($this->_SqlSelectGroup <> "") ? $this->_SqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}

	function SqlSelectGroup() { // For backward compatibility
		return $this->getSqlSelectGroup();
	}

	function setSqlSelectGroup($v) {
		$this->_SqlSelectGroup = $v;
	}

	// Order By Group
	var $_SqlOrderByGroup = "";

	function getSqlOrderByGroup() {
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "";
	}

	function SqlOrderByGroup() { // For backward compatibility
		return $this->getSqlOrderByGroup();
	}

	function setSqlOrderByGroup($v) {
		$this->_SqlOrderByGroup = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT SUM(`Pinjaman`) AS `sum_pinjaman` FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
