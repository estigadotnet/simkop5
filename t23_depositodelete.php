<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t23_depositoinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t23_deposito_delete = NULL; // Initialize page object first

class ct23_deposito_delete extends ct23_deposito {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't23_deposito';

	// Page object name
	var $PageObjName = 't23_deposito_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t23_deposito)
		if (!isset($GLOBALS["t23_deposito"]) || get_class($GLOBALS["t23_deposito"]) == "ct23_deposito") {
			$GLOBALS["t23_deposito"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t23_deposito"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't23_deposito', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t23_depositolist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->Kontrak_Lama->SetVisibility();
		$this->Jatuh_Tempo_Tgl->SetVisibility();
		$this->Deposito->SetVisibility();
		$this->Bunga_Suku->SetVisibility();
		$this->Bunga->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->bank_id->SetVisibility();
		$this->No_Ref->SetVisibility();
		$this->Biaya_Administrasi->SetVisibility();
		$this->Biaya_Materai->SetVisibility();
		$this->Kontrak_Status->SetVisibility();
		$this->Jatuh_Tempo_Status->SetVisibility();
		$this->Bunga_Status->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t23_deposito;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t23_deposito);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t23_depositolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t23_deposito class, t23_depositoinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t23_depositolist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
		$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
		$this->Kontrak_Lama->setDbValue($rs->fields('Kontrak_Lama'));
		$this->Jatuh_Tempo_Tgl->setDbValue($rs->fields('Jatuh_Tempo_Tgl'));
		$this->Deposito->setDbValue($rs->fields('Deposito'));
		$this->Bunga_Suku->setDbValue($rs->fields('Bunga_Suku'));
		$this->Bunga->setDbValue($rs->fields('Bunga'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		if (array_key_exists('EV__nasabah_id', $rs->fields)) {
			$this->nasabah_id->VirtualValue = $rs->fields('EV__nasabah_id'); // Set up virtual field value
		} else {
			$this->nasabah_id->VirtualValue = ""; // Clear value
		}
		$this->bank_id->setDbValue($rs->fields('bank_id'));
		$this->No_Ref->setDbValue($rs->fields('No_Ref'));
		$this->Biaya_Administrasi->setDbValue($rs->fields('Biaya_Administrasi'));
		$this->Biaya_Materai->setDbValue($rs->fields('Biaya_Materai'));
		$this->Periode->setDbValue($rs->fields('Periode'));
		$this->Kontrak_Status->setDbValue($rs->fields('Kontrak_Status'));
		$this->Jatuh_Tempo_Status->setDbValue($rs->fields('Jatuh_Tempo_Status'));
		$this->Bunga_Status->setDbValue($rs->fields('Bunga_Status'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Kontrak_No->DbValue = $row['Kontrak_No'];
		$this->Kontrak_Tgl->DbValue = $row['Kontrak_Tgl'];
		$this->Kontrak_Lama->DbValue = $row['Kontrak_Lama'];
		$this->Jatuh_Tempo_Tgl->DbValue = $row['Jatuh_Tempo_Tgl'];
		$this->Deposito->DbValue = $row['Deposito'];
		$this->Bunga_Suku->DbValue = $row['Bunga_Suku'];
		$this->Bunga->DbValue = $row['Bunga'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->bank_id->DbValue = $row['bank_id'];
		$this->No_Ref->DbValue = $row['No_Ref'];
		$this->Biaya_Administrasi->DbValue = $row['Biaya_Administrasi'];
		$this->Biaya_Materai->DbValue = $row['Biaya_Materai'];
		$this->Periode->DbValue = $row['Periode'];
		$this->Kontrak_Status->DbValue = $row['Kontrak_Status'];
		$this->Jatuh_Tempo_Status->DbValue = $row['Jatuh_Tempo_Status'];
		$this->Bunga_Status->DbValue = $row['Bunga_Status'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Deposito->FormValue == $this->Deposito->CurrentValue && is_numeric(ew_StrToFloat($this->Deposito->CurrentValue)))
			$this->Deposito->CurrentValue = ew_StrToFloat($this->Deposito->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga_Suku->FormValue == $this->Bunga_Suku->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga_Suku->CurrentValue)))
			$this->Bunga_Suku->CurrentValue = ew_StrToFloat($this->Bunga_Suku->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga->FormValue == $this->Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga->CurrentValue)))
			$this->Bunga->CurrentValue = ew_StrToFloat($this->Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Administrasi->FormValue == $this->Biaya_Administrasi->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Administrasi->CurrentValue)))
			$this->Biaya_Administrasi->CurrentValue = ew_StrToFloat($this->Biaya_Administrasi->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Materai->FormValue == $this->Biaya_Materai->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Materai->CurrentValue)))
			$this->Biaya_Materai->CurrentValue = ew_StrToFloat($this->Biaya_Materai->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
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
		// Periode
		// Kontrak_Status
		// Jatuh_Tempo_Status
		// Bunga_Status

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Kontrak_No
		$this->Kontrak_No->ViewValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_No->ViewCustomAttributes = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl->ViewValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Tgl->ViewValue = ew_FormatDateTime($this->Kontrak_Tgl->ViewValue, 7);
		$this->Kontrak_Tgl->ViewCustomAttributes = "";

		// Kontrak_Lama
		$this->Kontrak_Lama->ViewValue = $this->Kontrak_Lama->CurrentValue;
		$this->Kontrak_Lama->ViewValue = ew_FormatNumber($this->Kontrak_Lama->ViewValue, 0, -2, -2, -2);
		$this->Kontrak_Lama->CellCssStyle .= "text-align: right;";
		$this->Kontrak_Lama->ViewCustomAttributes = "";

		// Jatuh_Tempo_Tgl
		$this->Jatuh_Tempo_Tgl->ViewValue = $this->Jatuh_Tempo_Tgl->CurrentValue;
		$this->Jatuh_Tempo_Tgl->ViewValue = ew_FormatDateTime($this->Jatuh_Tempo_Tgl->ViewValue, 7);
		$this->Jatuh_Tempo_Tgl->ViewCustomAttributes = "";

		// Deposito
		$this->Deposito->ViewValue = $this->Deposito->CurrentValue;
		$this->Deposito->ViewValue = ew_FormatNumber($this->Deposito->ViewValue, 2, -2, -2, -2);
		$this->Deposito->CellCssStyle .= "text-align: right;";
		$this->Deposito->ViewCustomAttributes = "";

		// Bunga_Suku
		$this->Bunga_Suku->ViewValue = $this->Bunga_Suku->CurrentValue;
		$this->Bunga_Suku->ViewValue = ew_FormatNumber($this->Bunga_Suku->ViewValue, 2, -2, -2, -2);
		$this->Bunga_Suku->CellCssStyle .= "text-align: right;";
		$this->Bunga_Suku->ViewCustomAttributes = "";

		// Bunga
		$this->Bunga->ViewValue = $this->Bunga->CurrentValue;
		$this->Bunga->ViewValue = ew_FormatNumber($this->Bunga->ViewValue, 2, -2, -2, -2);
		$this->Bunga->CellCssStyle .= "text-align: right;";
		$this->Bunga->ViewCustomAttributes = "";

		// nasabah_id
		if ($this->nasabah_id->VirtualValue <> "") {
			$this->nasabah_id->ViewValue = $this->nasabah_id->VirtualValue;
		} else {
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t22_peserta`";
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

		// bank_id
		if (strval($this->bank_id->CurrentValue) <> "") {
			$arwrk = explode(",", $this->bank_id->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `id`, `Nomor` AS `DispFld`, `Pemilik` AS `Disp2Fld`, `Bank` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t21_bank`";
		$sWhereWrk = "";
		$this->bank_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bank_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->bank_id->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$arwrk[3] = $rswrk->fields('Disp3Fld');
					$this->bank_id->ViewValue .= $this->bank_id->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->bank_id->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->bank_id->ViewValue = $this->bank_id->CurrentValue;
			}
		} else {
			$this->bank_id->ViewValue = NULL;
		}
		$this->bank_id->ViewCustomAttributes = "";

		// No_Ref
		$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->ViewCustomAttributes = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi->ViewValue = $this->Biaya_Administrasi->CurrentValue;
		$this->Biaya_Administrasi->ViewValue = ew_FormatNumber($this->Biaya_Administrasi->ViewValue, 2, -2, -2, -2);
		$this->Biaya_Administrasi->CellCssStyle .= "text-align: right;";
		$this->Biaya_Administrasi->ViewCustomAttributes = "";

		// Biaya_Materai
		$this->Biaya_Materai->ViewValue = $this->Biaya_Materai->CurrentValue;
		$this->Biaya_Materai->ViewValue = ew_FormatNumber($this->Biaya_Materai->ViewValue, 2, -2, -2, -2);
		$this->Biaya_Materai->CellCssStyle .= "text-align: right;";
		$this->Biaya_Materai->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// Kontrak_Status
		if (strval($this->Kontrak_Status->CurrentValue) <> "") {
			$this->Kontrak_Status->ViewValue = $this->Kontrak_Status->OptionCaption($this->Kontrak_Status->CurrentValue);
		} else {
			$this->Kontrak_Status->ViewValue = NULL;
		}
		$this->Kontrak_Status->ViewCustomAttributes = "";

		// Jatuh_Tempo_Status
		if (strval($this->Jatuh_Tempo_Status->CurrentValue) <> "") {
			$this->Jatuh_Tempo_Status->ViewValue = $this->Jatuh_Tempo_Status->OptionCaption($this->Jatuh_Tempo_Status->CurrentValue);
		} else {
			$this->Jatuh_Tempo_Status->ViewValue = NULL;
		}
		$this->Jatuh_Tempo_Status->ViewCustomAttributes = "";

		// Bunga_Status
		if (strval($this->Bunga_Status->CurrentValue) <> "") {
			$this->Bunga_Status->ViewValue = $this->Bunga_Status->OptionCaption($this->Bunga_Status->CurrentValue);
		} else {
			$this->Bunga_Status->ViewValue = NULL;
		}
		$this->Bunga_Status->ViewCustomAttributes = "";

			// Kontrak_No
			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";
			$this->Kontrak_No->TooltipValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";
			$this->Kontrak_Tgl->TooltipValue = "";

			// Kontrak_Lama
			$this->Kontrak_Lama->LinkCustomAttributes = "";
			$this->Kontrak_Lama->HrefValue = "";
			$this->Kontrak_Lama->TooltipValue = "";

			// Jatuh_Tempo_Tgl
			$this->Jatuh_Tempo_Tgl->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Tgl->HrefValue = "";
			$this->Jatuh_Tempo_Tgl->TooltipValue = "";

			// Deposito
			$this->Deposito->LinkCustomAttributes = "";
			$this->Deposito->HrefValue = "";
			$this->Deposito->TooltipValue = "";

			// Bunga_Suku
			$this->Bunga_Suku->LinkCustomAttributes = "";
			$this->Bunga_Suku->HrefValue = "";
			$this->Bunga_Suku->TooltipValue = "";

			// Bunga
			$this->Bunga->LinkCustomAttributes = "";
			$this->Bunga->HrefValue = "";
			$this->Bunga->TooltipValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";

			// bank_id
			$this->bank_id->LinkCustomAttributes = "";
			$this->bank_id->HrefValue = "";
			$this->bank_id->TooltipValue = "";

			// No_Ref
			$this->No_Ref->LinkCustomAttributes = "";
			$this->No_Ref->HrefValue = "";
			$this->No_Ref->TooltipValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->LinkCustomAttributes = "";
			$this->Biaya_Administrasi->HrefValue = "";
			$this->Biaya_Administrasi->TooltipValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->LinkCustomAttributes = "";
			$this->Biaya_Materai->HrefValue = "";
			$this->Biaya_Materai->TooltipValue = "";

			// Kontrak_Status
			$this->Kontrak_Status->LinkCustomAttributes = "";
			$this->Kontrak_Status->HrefValue = "";
			$this->Kontrak_Status->TooltipValue = "";

			// Jatuh_Tempo_Status
			$this->Jatuh_Tempo_Status->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Status->HrefValue = "";
			$this->Jatuh_Tempo_Status->TooltipValue = "";

			// Bunga_Status
			$this->Bunga_Status->LinkCustomAttributes = "";
			$this->Bunga_Status->HrefValue = "";
			$this->Bunga_Status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t23_depositolist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t23_deposito_delete)) $t23_deposito_delete = new ct23_deposito_delete();

// Page init
$t23_deposito_delete->Page_Init();

// Page main
$t23_deposito_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t23_deposito_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft23_depositodelete = new ew_Form("ft23_depositodelete", "delete");

// Form_CustomValidate event
ft23_depositodelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft23_depositodelete.ValidateRequired = true;
<?php } else { ?>
ft23_depositodelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft23_depositodelete.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t22_peserta"};
ft23_depositodelete.Lists["x_bank_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor","x_Pemilik","x_Bank",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t21_bank"};
ft23_depositodelete.Lists["x_Kontrak_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositodelete.Lists["x_Kontrak_Status"].Options = <?php echo json_encode($t23_deposito->Kontrak_Status->Options()) ?>;
ft23_depositodelete.Lists["x_Jatuh_Tempo_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositodelete.Lists["x_Jatuh_Tempo_Status"].Options = <?php echo json_encode($t23_deposito->Jatuh_Tempo_Status->Options()) ?>;
ft23_depositodelete.Lists["x_Bunga_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositodelete.Lists["x_Bunga_Status"].Options = <?php echo json_encode($t23_deposito->Bunga_Status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $t23_deposito_delete->ShowPageHeader(); ?>
<?php
$t23_deposito_delete->ShowMessage();
?>
<form name="ft23_depositodelete" id="ft23_depositodelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t23_deposito_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t23_deposito_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t23_deposito">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t23_deposito_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t23_deposito->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
		<th><span id="elh_t23_deposito_Kontrak_No" class="t23_deposito_Kontrak_No"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<th><span id="elh_t23_deposito_Kontrak_Tgl" class="t23_deposito_Kontrak_Tgl"><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
		<th><span id="elh_t23_deposito_Kontrak_Lama" class="t23_deposito_Kontrak_Lama"><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Tgl->Visible) { // Jatuh_Tempo_Tgl ?>
		<th><span id="elh_t23_deposito_Jatuh_Tempo_Tgl" class="t23_deposito_Jatuh_Tempo_Tgl"><?php echo $t23_deposito->Jatuh_Tempo_Tgl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
		<th><span id="elh_t23_deposito_Deposito" class="t23_deposito_Deposito"><?php echo $t23_deposito->Deposito->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
		<th><span id="elh_t23_deposito_Bunga_Suku" class="t23_deposito_Bunga_Suku"><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
		<th><span id="elh_t23_deposito_Bunga" class="t23_deposito_Bunga"><?php echo $t23_deposito->Bunga->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<th><span id="elh_t23_deposito_nasabah_id" class="t23_deposito_nasabah_id"><?php echo $t23_deposito->nasabah_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->bank_id->Visible) { // bank_id ?>
		<th><span id="elh_t23_deposito_bank_id" class="t23_deposito_bank_id"><?php echo $t23_deposito->bank_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->No_Ref->Visible) { // No_Ref ?>
		<th><span id="elh_t23_deposito_No_Ref" class="t23_deposito_No_Ref"><?php echo $t23_deposito->No_Ref->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
		<th><span id="elh_t23_deposito_Biaya_Administrasi" class="t23_deposito_Biaya_Administrasi"><?php echo $t23_deposito->Biaya_Administrasi->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Biaya_Materai->Visible) { // Biaya_Materai ?>
		<th><span id="elh_t23_deposito_Biaya_Materai" class="t23_deposito_Biaya_Materai"><?php echo $t23_deposito->Biaya_Materai->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Status->Visible) { // Kontrak_Status ?>
		<th><span id="elh_t23_deposito_Kontrak_Status" class="t23_deposito_Kontrak_Status"><?php echo $t23_deposito->Kontrak_Status->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Status->Visible) { // Jatuh_Tempo_Status ?>
		<th><span id="elh_t23_deposito_Jatuh_Tempo_Status" class="t23_deposito_Jatuh_Tempo_Status"><?php echo $t23_deposito->Jatuh_Tempo_Status->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t23_deposito->Bunga_Status->Visible) { // Bunga_Status ?>
		<th><span id="elh_t23_deposito_Bunga_Status" class="t23_deposito_Bunga_Status"><?php echo $t23_deposito->Bunga_Status->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t23_deposito_delete->RecCnt = 0;
$i = 0;
while (!$t23_deposito_delete->Recordset->EOF) {
	$t23_deposito_delete->RecCnt++;
	$t23_deposito_delete->RowCnt++;

	// Set row properties
	$t23_deposito->ResetAttrs();
	$t23_deposito->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t23_deposito_delete->LoadRowValues($t23_deposito_delete->Recordset);

	// Render row
	$t23_deposito_delete->RenderRow();
?>
	<tr<?php echo $t23_deposito->RowAttributes() ?>>
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
		<td<?php echo $t23_deposito->Kontrak_No->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Kontrak_No" class="t23_deposito_Kontrak_No">
<span<?php echo $t23_deposito->Kontrak_No->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_No->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<td<?php echo $t23_deposito->Kontrak_Tgl->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Kontrak_Tgl" class="t23_deposito_Kontrak_Tgl">
<span<?php echo $t23_deposito->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
		<td<?php echo $t23_deposito->Kontrak_Lama->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Kontrak_Lama" class="t23_deposito_Kontrak_Lama">
<span<?php echo $t23_deposito->Kontrak_Lama->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Lama->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Tgl->Visible) { // Jatuh_Tempo_Tgl ?>
		<td<?php echo $t23_deposito->Jatuh_Tempo_Tgl->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Jatuh_Tempo_Tgl" class="t23_deposito_Jatuh_Tempo_Tgl">
<span<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
		<td<?php echo $t23_deposito->Deposito->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Deposito" class="t23_deposito_Deposito">
<span<?php echo $t23_deposito->Deposito->ViewAttributes() ?>>
<?php echo $t23_deposito->Deposito->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
		<td<?php echo $t23_deposito->Bunga_Suku->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Bunga_Suku" class="t23_deposito_Bunga_Suku">
<span<?php echo $t23_deposito->Bunga_Suku->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Suku->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
		<td<?php echo $t23_deposito->Bunga->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Bunga" class="t23_deposito_Bunga">
<span<?php echo $t23_deposito->Bunga->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<td<?php echo $t23_deposito->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_nasabah_id" class="t23_deposito_nasabah_id">
<span<?php echo $t23_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t23_deposito->nasabah_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->bank_id->Visible) { // bank_id ?>
		<td<?php echo $t23_deposito->bank_id->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_bank_id" class="t23_deposito_bank_id">
<span<?php echo $t23_deposito->bank_id->ViewAttributes() ?>>
<?php echo $t23_deposito->bank_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->No_Ref->Visible) { // No_Ref ?>
		<td<?php echo $t23_deposito->No_Ref->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_No_Ref" class="t23_deposito_No_Ref">
<span<?php echo $t23_deposito->No_Ref->ViewAttributes() ?>>
<?php echo $t23_deposito->No_Ref->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
		<td<?php echo $t23_deposito->Biaya_Administrasi->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Biaya_Administrasi" class="t23_deposito_Biaya_Administrasi">
<span<?php echo $t23_deposito->Biaya_Administrasi->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Administrasi->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Biaya_Materai->Visible) { // Biaya_Materai ?>
		<td<?php echo $t23_deposito->Biaya_Materai->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Biaya_Materai" class="t23_deposito_Biaya_Materai">
<span<?php echo $t23_deposito->Biaya_Materai->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Materai->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Status->Visible) { // Kontrak_Status ?>
		<td<?php echo $t23_deposito->Kontrak_Status->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Kontrak_Status" class="t23_deposito_Kontrak_Status">
<span<?php echo $t23_deposito->Kontrak_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Status->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Status->Visible) { // Jatuh_Tempo_Status ?>
		<td<?php echo $t23_deposito->Jatuh_Tempo_Status->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Jatuh_Tempo_Status" class="t23_deposito_Jatuh_Tempo_Status">
<span<?php echo $t23_deposito->Jatuh_Tempo_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Status->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t23_deposito->Bunga_Status->Visible) { // Bunga_Status ?>
		<td<?php echo $t23_deposito->Bunga_Status->CellAttributes() ?>>
<span id="el<?php echo $t23_deposito_delete->RowCnt ?>_t23_deposito_Bunga_Status" class="t23_deposito_Bunga_Status">
<span<?php echo $t23_deposito->Bunga_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Status->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t23_deposito_delete->Recordset->MoveNext();
}
$t23_deposito_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t23_deposito_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft23_depositodelete.Init();
</script>
<?php
$t23_deposito_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t23_deposito_delete->Page_Terminate();
?>
