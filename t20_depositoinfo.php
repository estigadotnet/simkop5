<?php

// Global variable for table object
$t20_deposito = NULL;

//
// Table class for t20_deposito
//
class ct20_deposito extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $id;
	var $No_Urut;
	var $Tanggal_Valuta;
	var $Tanggal_Jatuh_Tempo;
	var $nasabah_id;
	var $Jumlah_Deposito;
	var $Jumlah_Terbilang;
	var $Suku_Bunga;
	var $Jumlah_Bunga;
	var $Dikredit_Diperpanjang;
	var $Tunai_Transfer;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't20_deposito';
		$this->TableName = 't20_deposito';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t20_deposito`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 2;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('t20_deposito', 't20_deposito', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// No_Urut
		$this->No_Urut = new cField('t20_deposito', 't20_deposito', 'x_No_Urut', 'No_Urut', '`No_Urut`', '`No_Urut`', 200, -1, FALSE, '`No_Urut`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->No_Urut->Sortable = TRUE; // Allow sort
		$this->fields['No_Urut'] = &$this->No_Urut;

		// Tanggal_Valuta
		$this->Tanggal_Valuta = new cField('t20_deposito', 't20_deposito', 'x_Tanggal_Valuta', 'Tanggal_Valuta', '`Tanggal_Valuta`', ew_CastDateFieldForLike('`Tanggal_Valuta`', 7, "DB"), 133, 7, FALSE, '`Tanggal_Valuta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tanggal_Valuta->Sortable = TRUE; // Allow sort
		$this->Tanggal_Valuta->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['Tanggal_Valuta'] = &$this->Tanggal_Valuta;

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo = new cField('t20_deposito', 't20_deposito', 'x_Tanggal_Jatuh_Tempo', 'Tanggal_Jatuh_Tempo', '`Tanggal_Jatuh_Tempo`', ew_CastDateFieldForLike('`Tanggal_Jatuh_Tempo`', 7, "DB"), 133, 7, FALSE, '`Tanggal_Jatuh_Tempo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tanggal_Jatuh_Tempo->Sortable = TRUE; // Allow sort
		$this->Tanggal_Jatuh_Tempo->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['Tanggal_Jatuh_Tempo'] = &$this->Tanggal_Jatuh_Tempo;

		// nasabah_id
		$this->nasabah_id = new cField('t20_deposito', 't20_deposito', 'x_nasabah_id', 'nasabah_id', '`nasabah_id`', '`nasabah_id`', 3, -1, FALSE, '`EV__nasabah_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->nasabah_id->Sortable = TRUE; // Allow sort
		$this->nasabah_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nasabah_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->nasabah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['nasabah_id'] = &$this->nasabah_id;

		// Jumlah_Deposito
		$this->Jumlah_Deposito = new cField('t20_deposito', 't20_deposito', 'x_Jumlah_Deposito', 'Jumlah_Deposito', '`Jumlah_Deposito`', '`Jumlah_Deposito`', 4, -1, FALSE, '`Jumlah_Deposito`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Jumlah_Deposito->Sortable = TRUE; // Allow sort
		$this->Jumlah_Deposito->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Jumlah_Deposito'] = &$this->Jumlah_Deposito;

		// Jumlah_Terbilang
		$this->Jumlah_Terbilang = new cField('t20_deposito', 't20_deposito', 'x_Jumlah_Terbilang', 'Jumlah_Terbilang', '`Jumlah_Terbilang`', '`Jumlah_Terbilang`', 201, -1, FALSE, '`Jumlah_Terbilang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Jumlah_Terbilang->Sortable = TRUE; // Allow sort
		$this->fields['Jumlah_Terbilang'] = &$this->Jumlah_Terbilang;

		// Suku_Bunga
		$this->Suku_Bunga = new cField('t20_deposito', 't20_deposito', 'x_Suku_Bunga', 'Suku_Bunga', '`Suku_Bunga`', '`Suku_Bunga`', 131, -1, FALSE, '`Suku_Bunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Suku_Bunga->Sortable = TRUE; // Allow sort
		$this->Suku_Bunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Suku_Bunga'] = &$this->Suku_Bunga;

		// Jumlah_Bunga
		$this->Jumlah_Bunga = new cField('t20_deposito', 't20_deposito', 'x_Jumlah_Bunga', 'Jumlah_Bunga', '`Jumlah_Bunga`', '`Jumlah_Bunga`', 4, -1, FALSE, '`Jumlah_Bunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Jumlah_Bunga->Sortable = TRUE; // Allow sort
		$this->Jumlah_Bunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Jumlah_Bunga'] = &$this->Jumlah_Bunga;

		// Dikredit_Diperpanjang
		$this->Dikredit_Diperpanjang = new cField('t20_deposito', 't20_deposito', 'x_Dikredit_Diperpanjang', 'Dikredit_Diperpanjang', '`Dikredit_Diperpanjang`', '`Dikredit_Diperpanjang`', 202, -1, FALSE, '`Dikredit_Diperpanjang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Dikredit_Diperpanjang->Sortable = TRUE; // Allow sort
		$this->Dikredit_Diperpanjang->OptionCount = 2;
		$this->fields['Dikredit_Diperpanjang'] = &$this->Dikredit_Diperpanjang;

		// Tunai_Transfer
		$this->Tunai_Transfer = new cField('t20_deposito', 't20_deposito', 'x_Tunai_Transfer', 'Tunai_Transfer', '`Tunai_Transfer`', '`Tunai_Transfer`', 202, -1, FALSE, '`Tunai_Transfer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Tunai_Transfer->Sortable = TRUE; // Allow sort
		$this->Tunai_Transfer->OptionCount = 2;
		$this->fields['Tunai_Transfer'] = &$this->Tunai_Transfer;
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
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			if ($ctrl) {
				$sOrderByList = $this->getSessionOrderByList();
				if (strpos($sOrderByList, $sSortFieldList . " " . $sLastSort) !== FALSE) {
					$sOrderByList = str_replace($sSortFieldList . " " . $sLastSort, $sSortFieldList . " " . $sThisSort, $sOrderByList);
				} else {
					if ($sOrderByList <> "") $sOrderByList .= ", ";
					$sOrderByList .= $sSortFieldList . " " . $sThisSort;
				}
				$this->setSessionOrderByList($sOrderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t20_deposito`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `Nama` FROM `v02_nasabahjaminan` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`id` = `t20_deposito`.`nasabah_id` LIMIT 1) AS `EV__nasabah_id` FROM `t20_deposito`" .
			") `EW_TMP_TABLE`";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
		return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
		$this->_SqlSelectList = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->nasabah_id->AdvancedSearch->SearchValue <> "" ||
			$this->nasabah_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->nasabah_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->nasabah_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "t20_depositolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t20_depositolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t20_depositoview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t20_depositoview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t20_depositoadd.php?" . $this->UrlParm($parm);
		else
			$url = "t20_depositoadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("t20_depositoedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("t20_depositoadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t20_depositodelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = ew_StripSlashes($_POST["id"]);
			elseif (isset($_GET["id"]))
				$arKeys[] = ew_StripSlashes($_GET["id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->No_Urut->setDbValue($rs->fields('No_Urut'));
		$this->Tanggal_Valuta->setDbValue($rs->fields('Tanggal_Valuta'));
		$this->Tanggal_Jatuh_Tempo->setDbValue($rs->fields('Tanggal_Jatuh_Tempo'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->Jumlah_Deposito->setDbValue($rs->fields('Jumlah_Deposito'));
		$this->Jumlah_Terbilang->setDbValue($rs->fields('Jumlah_Terbilang'));
		$this->Suku_Bunga->setDbValue($rs->fields('Suku_Bunga'));
		$this->Jumlah_Bunga->setDbValue($rs->fields('Jumlah_Bunga'));
		$this->Dikredit_Diperpanjang->setDbValue($rs->fields('Dikredit_Diperpanjang'));
		$this->Tunai_Transfer->setDbValue($rs->fields('Tunai_Transfer'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id
		// No_Urut
		// Tanggal_Valuta
		// Tanggal_Jatuh_Tempo
		// nasabah_id
		// Jumlah_Deposito
		// Jumlah_Terbilang
		// Suku_Bunga
		// Jumlah_Bunga
		// Dikredit_Diperpanjang
		// Tunai_Transfer
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// No_Urut
		$this->No_Urut->ViewValue = $this->No_Urut->CurrentValue;
		$this->No_Urut->ViewCustomAttributes = "";

		// Tanggal_Valuta
		$this->Tanggal_Valuta->ViewValue = $this->Tanggal_Valuta->CurrentValue;
		$this->Tanggal_Valuta->ViewValue = ew_FormatDateTime($this->Tanggal_Valuta->ViewValue, 7);
		$this->Tanggal_Valuta->ViewCustomAttributes = "";

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->ViewValue = $this->Tanggal_Jatuh_Tempo->CurrentValue;
		$this->Tanggal_Jatuh_Tempo->ViewValue = ew_FormatDateTime($this->Tanggal_Jatuh_Tempo->ViewValue, 7);
		$this->Tanggal_Jatuh_Tempo->ViewCustomAttributes = "";

		// nasabah_id
		if ($this->nasabah_id->VirtualValue <> "") {
			$this->nasabah_id->ViewValue = $this->nasabah_id->VirtualValue;
		} else {
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v02_nasabahjaminan`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nasabah_id->ViewValue = $this->nasabah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
			}
		} else {
			$this->nasabah_id->ViewValue = NULL;
		}
		}
		$this->nasabah_id->ViewCustomAttributes = "";

		// Jumlah_Deposito
		$this->Jumlah_Deposito->ViewValue = $this->Jumlah_Deposito->CurrentValue;
		$this->Jumlah_Deposito->ViewValue = ew_FormatNumber($this->Jumlah_Deposito->ViewValue, 0, -2, -2, -2);
		$this->Jumlah_Deposito->CellCssStyle .= "text-align: right;";
		$this->Jumlah_Deposito->ViewCustomAttributes = "";

		// Jumlah_Terbilang
		$this->Jumlah_Terbilang->ViewValue = $this->Jumlah_Terbilang->CurrentValue;
		$this->Jumlah_Terbilang->ViewCustomAttributes = "";

		// Suku_Bunga
		$this->Suku_Bunga->ViewValue = $this->Suku_Bunga->CurrentValue;
		$this->Suku_Bunga->ViewValue = ew_FormatNumber($this->Suku_Bunga->ViewValue, 0, -2, -2, -2);
		$this->Suku_Bunga->CellCssStyle .= "text-align: right;";
		$this->Suku_Bunga->ViewCustomAttributes = "";

		// Jumlah_Bunga
		$this->Jumlah_Bunga->ViewValue = $this->Jumlah_Bunga->CurrentValue;
		$this->Jumlah_Bunga->ViewValue = ew_FormatNumber($this->Jumlah_Bunga->ViewValue, 0, -2, -2, -2);
		$this->Jumlah_Bunga->CellCssStyle .= "text-align: right;";
		$this->Jumlah_Bunga->ViewCustomAttributes = "";

		// Dikredit_Diperpanjang
		if (strval($this->Dikredit_Diperpanjang->CurrentValue) <> "") {
			$this->Dikredit_Diperpanjang->ViewValue = $this->Dikredit_Diperpanjang->OptionCaption($this->Dikredit_Diperpanjang->CurrentValue);
		} else {
			$this->Dikredit_Diperpanjang->ViewValue = NULL;
		}
		$this->Dikredit_Diperpanjang->ViewCustomAttributes = "";

		// Tunai_Transfer
		if (strval($this->Tunai_Transfer->CurrentValue) <> "") {
			$this->Tunai_Transfer->ViewValue = $this->Tunai_Transfer->OptionCaption($this->Tunai_Transfer->CurrentValue);
		} else {
			$this->Tunai_Transfer->ViewValue = NULL;
		}
		$this->Tunai_Transfer->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// No_Urut
		$this->No_Urut->LinkCustomAttributes = "";
		$this->No_Urut->HrefValue = "";
		$this->No_Urut->TooltipValue = "";

		// Tanggal_Valuta
		$this->Tanggal_Valuta->LinkCustomAttributes = "";
		$this->Tanggal_Valuta->HrefValue = "";
		$this->Tanggal_Valuta->TooltipValue = "";

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->LinkCustomAttributes = "";
		$this->Tanggal_Jatuh_Tempo->HrefValue = "";
		$this->Tanggal_Jatuh_Tempo->TooltipValue = "";

		// nasabah_id
		$this->nasabah_id->LinkCustomAttributes = "";
		$this->nasabah_id->HrefValue = "";
		$this->nasabah_id->TooltipValue = "";

		// Jumlah_Deposito
		$this->Jumlah_Deposito->LinkCustomAttributes = "";
		$this->Jumlah_Deposito->HrefValue = "";
		$this->Jumlah_Deposito->TooltipValue = "";

		// Jumlah_Terbilang
		$this->Jumlah_Terbilang->LinkCustomAttributes = "";
		$this->Jumlah_Terbilang->HrefValue = "";
		$this->Jumlah_Terbilang->TooltipValue = "";

		// Suku_Bunga
		$this->Suku_Bunga->LinkCustomAttributes = "";
		$this->Suku_Bunga->HrefValue = "";
		$this->Suku_Bunga->TooltipValue = "";

		// Jumlah_Bunga
		$this->Jumlah_Bunga->LinkCustomAttributes = "";
		$this->Jumlah_Bunga->HrefValue = "";
		$this->Jumlah_Bunga->TooltipValue = "";

		// Dikredit_Diperpanjang
		$this->Dikredit_Diperpanjang->LinkCustomAttributes = "";
		$this->Dikredit_Diperpanjang->HrefValue = "";
		$this->Dikredit_Diperpanjang->TooltipValue = "";

		// Tunai_Transfer
		$this->Tunai_Transfer->LinkCustomAttributes = "";
		$this->Tunai_Transfer->HrefValue = "";
		$this->Tunai_Transfer->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// No_Urut
		$this->No_Urut->EditAttrs["class"] = "form-control";
		$this->No_Urut->EditCustomAttributes = "";
		$this->No_Urut->EditValue = $this->No_Urut->CurrentValue;
		$this->No_Urut->PlaceHolder = ew_RemoveHtml($this->No_Urut->FldCaption());

		// Tanggal_Valuta
		$this->Tanggal_Valuta->EditAttrs["class"] = "form-control";
		$this->Tanggal_Valuta->EditCustomAttributes = "style='width: 112px;''";
		$this->Tanggal_Valuta->EditValue = ew_FormatDateTime($this->Tanggal_Valuta->CurrentValue, 7);
		$this->Tanggal_Valuta->PlaceHolder = ew_RemoveHtml($this->Tanggal_Valuta->FldCaption());

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->EditAttrs["class"] = "form-control";
		$this->Tanggal_Jatuh_Tempo->EditCustomAttributes = "style='width: 112px;''";
		$this->Tanggal_Jatuh_Tempo->EditValue = ew_FormatDateTime($this->Tanggal_Jatuh_Tempo->CurrentValue, 7);
		$this->Tanggal_Jatuh_Tempo->PlaceHolder = ew_RemoveHtml($this->Tanggal_Jatuh_Tempo->FldCaption());

		// nasabah_id
		$this->nasabah_id->EditAttrs["class"] = "form-control";
		$this->nasabah_id->EditCustomAttributes = "";

		// Jumlah_Deposito
		$this->Jumlah_Deposito->EditAttrs["class"] = "form-control";
		$this->Jumlah_Deposito->EditCustomAttributes = "";
		$this->Jumlah_Deposito->EditValue = $this->Jumlah_Deposito->CurrentValue;
		$this->Jumlah_Deposito->PlaceHolder = ew_RemoveHtml($this->Jumlah_Deposito->FldCaption());
		if (strval($this->Jumlah_Deposito->EditValue) <> "" && is_numeric($this->Jumlah_Deposito->EditValue)) $this->Jumlah_Deposito->EditValue = ew_FormatNumber($this->Jumlah_Deposito->EditValue, -2, -2, -2, -2);

		// Jumlah_Terbilang
		$this->Jumlah_Terbilang->EditAttrs["class"] = "form-control";
		$this->Jumlah_Terbilang->EditCustomAttributes = "";
		$this->Jumlah_Terbilang->EditValue = $this->Jumlah_Terbilang->CurrentValue;
		$this->Jumlah_Terbilang->ViewCustomAttributes = "";

		// Suku_Bunga
		$this->Suku_Bunga->EditAttrs["class"] = "form-control";
		$this->Suku_Bunga->EditCustomAttributes = "";
		$this->Suku_Bunga->EditValue = $this->Suku_Bunga->CurrentValue;
		$this->Suku_Bunga->PlaceHolder = ew_RemoveHtml($this->Suku_Bunga->FldCaption());
		if (strval($this->Suku_Bunga->EditValue) <> "" && is_numeric($this->Suku_Bunga->EditValue)) $this->Suku_Bunga->EditValue = ew_FormatNumber($this->Suku_Bunga->EditValue, -2, -2, -2, -2);

		// Jumlah_Bunga
		$this->Jumlah_Bunga->EditAttrs["class"] = "form-control";
		$this->Jumlah_Bunga->EditCustomAttributes = "";
		$this->Jumlah_Bunga->EditValue = $this->Jumlah_Bunga->CurrentValue;
		$this->Jumlah_Bunga->PlaceHolder = ew_RemoveHtml($this->Jumlah_Bunga->FldCaption());
		if (strval($this->Jumlah_Bunga->EditValue) <> "" && is_numeric($this->Jumlah_Bunga->EditValue)) $this->Jumlah_Bunga->EditValue = ew_FormatNumber($this->Jumlah_Bunga->EditValue, -2, -2, -2, -2);

		// Dikredit_Diperpanjang
		$this->Dikredit_Diperpanjang->EditCustomAttributes = "";
		$this->Dikredit_Diperpanjang->EditValue = $this->Dikredit_Diperpanjang->Options(FALSE);

		// Tunai_Transfer
		$this->Tunai_Transfer->EditCustomAttributes = "";
		$this->Tunai_Transfer->EditValue = $this->Tunai_Transfer->Options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->No_Urut->Exportable) $Doc->ExportCaption($this->No_Urut);
					if ($this->Tanggal_Valuta->Exportable) $Doc->ExportCaption($this->Tanggal_Valuta);
					if ($this->Tanggal_Jatuh_Tempo->Exportable) $Doc->ExportCaption($this->Tanggal_Jatuh_Tempo);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->Jumlah_Deposito->Exportable) $Doc->ExportCaption($this->Jumlah_Deposito);
					if ($this->Jumlah_Terbilang->Exportable) $Doc->ExportCaption($this->Jumlah_Terbilang);
					if ($this->Suku_Bunga->Exportable) $Doc->ExportCaption($this->Suku_Bunga);
					if ($this->Jumlah_Bunga->Exportable) $Doc->ExportCaption($this->Jumlah_Bunga);
					if ($this->Dikredit_Diperpanjang->Exportable) $Doc->ExportCaption($this->Dikredit_Diperpanjang);
					if ($this->Tunai_Transfer->Exportable) $Doc->ExportCaption($this->Tunai_Transfer);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->No_Urut->Exportable) $Doc->ExportCaption($this->No_Urut);
					if ($this->Tanggal_Valuta->Exportable) $Doc->ExportCaption($this->Tanggal_Valuta);
					if ($this->Tanggal_Jatuh_Tempo->Exportable) $Doc->ExportCaption($this->Tanggal_Jatuh_Tempo);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->Jumlah_Deposito->Exportable) $Doc->ExportCaption($this->Jumlah_Deposito);
					if ($this->Jumlah_Terbilang->Exportable) $Doc->ExportCaption($this->Jumlah_Terbilang);
					if ($this->Suku_Bunga->Exportable) $Doc->ExportCaption($this->Suku_Bunga);
					if ($this->Jumlah_Bunga->Exportable) $Doc->ExportCaption($this->Jumlah_Bunga);
					if ($this->Dikredit_Diperpanjang->Exportable) $Doc->ExportCaption($this->Dikredit_Diperpanjang);
					if ($this->Tunai_Transfer->Exportable) $Doc->ExportCaption($this->Tunai_Transfer);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->No_Urut->Exportable) $Doc->ExportField($this->No_Urut);
						if ($this->Tanggal_Valuta->Exportable) $Doc->ExportField($this->Tanggal_Valuta);
						if ($this->Tanggal_Jatuh_Tempo->Exportable) $Doc->ExportField($this->Tanggal_Jatuh_Tempo);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->Jumlah_Deposito->Exportable) $Doc->ExportField($this->Jumlah_Deposito);
						if ($this->Jumlah_Terbilang->Exportable) $Doc->ExportField($this->Jumlah_Terbilang);
						if ($this->Suku_Bunga->Exportable) $Doc->ExportField($this->Suku_Bunga);
						if ($this->Jumlah_Bunga->Exportable) $Doc->ExportField($this->Jumlah_Bunga);
						if ($this->Dikredit_Diperpanjang->Exportable) $Doc->ExportField($this->Dikredit_Diperpanjang);
						if ($this->Tunai_Transfer->Exportable) $Doc->ExportField($this->Tunai_Transfer);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->No_Urut->Exportable) $Doc->ExportField($this->No_Urut);
						if ($this->Tanggal_Valuta->Exportable) $Doc->ExportField($this->Tanggal_Valuta);
						if ($this->Tanggal_Jatuh_Tempo->Exportable) $Doc->ExportField($this->Tanggal_Jatuh_Tempo);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->Jumlah_Deposito->Exportable) $Doc->ExportField($this->Jumlah_Deposito);
						if ($this->Jumlah_Terbilang->Exportable) $Doc->ExportField($this->Jumlah_Terbilang);
						if ($this->Suku_Bunga->Exportable) $Doc->ExportField($this->Suku_Bunga);
						if ($this->Jumlah_Bunga->Exportable) $Doc->ExportField($this->Jumlah_Bunga);
						if ($this->Dikredit_Diperpanjang->Exportable) $Doc->ExportField($this->Dikredit_Diperpanjang);
						if ($this->Tunai_Transfer->Exportable) $Doc->ExportField($this->Tunai_Transfer);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 't20_deposito';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't20_deposito';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 't20_deposito';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 't20_deposito';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);
		//if ($this->PageID == "list") {

		if (CurrentPageID() == "list") {
			$q = "select * from t20_deposito order by No_Urut desc";
			$r = Conn()->Execute($q);
			$this->No_Urut->EditValue = $r->fields["No_Urut"];
			if (isset($_GET["x_No_Urut"])) {
				$this->No_Urut->EditValue = $_GET["x_No_Urut"];
			}
		}

		// Kondisi saat form Tambah sedang terbuka (tidak dalam mode konfirmasi)
		if (CurrentPageID() == "add" && $this->CurrentAction != "F") {

			// users meng-klik icon COPY
			if (isset($_GET["id"])) {

				//echo "id ".$_GET["id"];
				// proses copy

				$this->No_Urut->CurrentValue = GetNextNoUrut2($_GET["id"]); // trik
			}
			else {
				$this->No_Urut->CurrentValue = GetNextNoUrut(); // trik
			}
			$this->No_Urut->EditValue = $this->No_Urut->CurrentValue; // tampilkan

			//$this->Kode->ReadOnly = TRUE; // supaya tidak bisa diubah
			if (isset($_GET["id"])) {

				//echo "id ".$_GET["id"];
				// proses copy

			}
		}

		// Kondisi saat form Tambah sedang dalam mode konfirmasi
		if ($this->CurrentAction == "add" && $this->CurrentAction=="F") {
			$this->No_Urut->ViewValue = $this->No_Urut->CurrentValue; // ambil dari mode sebelumnya
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
