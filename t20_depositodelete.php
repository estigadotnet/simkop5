<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t20_depositoinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t20_deposito_delete = NULL; // Initialize page object first

class ct20_deposito_delete extends ct20_deposito {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't20_deposito';

	// Page object name
	var $PageObjName = 't20_deposito_delete';

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

		// Table object (t20_deposito)
		if (!isset($GLOBALS["t20_deposito"]) || get_class($GLOBALS["t20_deposito"]) == "ct20_deposito") {
			$GLOBALS["t20_deposito"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t20_deposito"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't20_deposito', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t20_depositolist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->No_Urut->SetVisibility();
		$this->Tanggal_Valuta->SetVisibility();
		$this->Tanggal_Jatuh_Tempo->SetVisibility();
		$this->Suku_Bunga->SetVisibility();
		$this->Jumlah_Bunga->SetVisibility();
		$this->Dikredit_Diperpanjang->SetVisibility();
		$this->Tunai_Transfer->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->Jumlah_Deposito->SetVisibility();

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
		global $EW_EXPORT, $t20_deposito;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t20_deposito);
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
			$this->Page_Terminate("t20_depositolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t20_deposito class, t20_depositoinfo.php

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
				$this->Page_Terminate("t20_depositolist.php"); // Return to list
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
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
		$this->No_Urut->setDbValue($rs->fields('No_Urut'));
		$this->Tanggal_Valuta->setDbValue($rs->fields('Tanggal_Valuta'));
		$this->Tanggal_Jatuh_Tempo->setDbValue($rs->fields('Tanggal_Jatuh_Tempo'));
		$this->Suku_Bunga->setDbValue($rs->fields('Suku_Bunga'));
		$this->Jumlah_Bunga->setDbValue($rs->fields('Jumlah_Bunga'));
		$this->Dikredit_Diperpanjang->setDbValue($rs->fields('Dikredit_Diperpanjang'));
		$this->Tunai_Transfer->setDbValue($rs->fields('Tunai_Transfer'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->Jumlah_Deposito->setDbValue($rs->fields('Jumlah_Deposito'));
		$this->Jumlah_Terbilang->setDbValue($rs->fields('Jumlah_Terbilang'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->No_Urut->DbValue = $row['No_Urut'];
		$this->Tanggal_Valuta->DbValue = $row['Tanggal_Valuta'];
		$this->Tanggal_Jatuh_Tempo->DbValue = $row['Tanggal_Jatuh_Tempo'];
		$this->Suku_Bunga->DbValue = $row['Suku_Bunga'];
		$this->Jumlah_Bunga->DbValue = $row['Jumlah_Bunga'];
		$this->Dikredit_Diperpanjang->DbValue = $row['Dikredit_Diperpanjang'];
		$this->Tunai_Transfer->DbValue = $row['Tunai_Transfer'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->Jumlah_Deposito->DbValue = $row['Jumlah_Deposito'];
		$this->Jumlah_Terbilang->DbValue = $row['Jumlah_Terbilang'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Suku_Bunga->FormValue == $this->Suku_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Suku_Bunga->CurrentValue)))
			$this->Suku_Bunga->CurrentValue = ew_StrToFloat($this->Suku_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Jumlah_Bunga->FormValue == $this->Jumlah_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Jumlah_Bunga->CurrentValue)))
			$this->Jumlah_Bunga->CurrentValue = ew_StrToFloat($this->Jumlah_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Jumlah_Deposito->FormValue == $this->Jumlah_Deposito->CurrentValue && is_numeric(ew_StrToFloat($this->Jumlah_Deposito->CurrentValue)))
			$this->Jumlah_Deposito->CurrentValue = ew_StrToFloat($this->Jumlah_Deposito->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// No_Urut
		// Tanggal_Valuta
		// Tanggal_Jatuh_Tempo
		// Suku_Bunga
		// Jumlah_Bunga
		// Dikredit_Diperpanjang
		// Tunai_Transfer
		// nasabah_id
		// Jumlah_Deposito
		// Jumlah_Terbilang

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// No_Urut
		$this->No_Urut->ViewValue = $this->No_Urut->CurrentValue;
		$this->No_Urut->ViewCustomAttributes = "";

		// Tanggal_Valuta
		$this->Tanggal_Valuta->ViewValue = $this->Tanggal_Valuta->CurrentValue;
		$this->Tanggal_Valuta->ViewValue = ew_FormatDateTime($this->Tanggal_Valuta->ViewValue, 0);
		$this->Tanggal_Valuta->ViewCustomAttributes = "";

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->ViewValue = $this->Tanggal_Jatuh_Tempo->CurrentValue;
		$this->Tanggal_Jatuh_Tempo->ViewValue = ew_FormatDateTime($this->Tanggal_Jatuh_Tempo->ViewValue, 0);
		$this->Tanggal_Jatuh_Tempo->ViewCustomAttributes = "";

		// Suku_Bunga
		$this->Suku_Bunga->ViewValue = $this->Suku_Bunga->CurrentValue;
		$this->Suku_Bunga->ViewCustomAttributes = "";

		// Jumlah_Bunga
		$this->Jumlah_Bunga->ViewValue = $this->Jumlah_Bunga->CurrentValue;
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

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

		// Jumlah_Deposito
		$this->Jumlah_Deposito->ViewValue = $this->Jumlah_Deposito->CurrentValue;
		$this->Jumlah_Deposito->ViewCustomAttributes = "";

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

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";

			// Jumlah_Deposito
			$this->Jumlah_Deposito->LinkCustomAttributes = "";
			$this->Jumlah_Deposito->HrefValue = "";
			$this->Jumlah_Deposito->TooltipValue = "";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t20_depositolist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t20_deposito_delete)) $t20_deposito_delete = new ct20_deposito_delete();

// Page init
$t20_deposito_delete->Page_Init();

// Page main
$t20_deposito_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t20_deposito_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft20_depositodelete = new ew_Form("ft20_depositodelete", "delete");

// Form_CustomValidate event
ft20_depositodelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft20_depositodelete.ValidateRequired = true;
<?php } else { ?>
ft20_depositodelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft20_depositodelete.Lists["x_Dikredit_Diperpanjang"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositodelete.Lists["x_Dikredit_Diperpanjang"].Options = <?php echo json_encode($t20_deposito->Dikredit_Diperpanjang->Options()) ?>;
ft20_depositodelete.Lists["x_Tunai_Transfer"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositodelete.Lists["x_Tunai_Transfer"].Options = <?php echo json_encode($t20_deposito->Tunai_Transfer->Options()) ?>;

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
<?php $t20_deposito_delete->ShowPageHeader(); ?>
<?php
$t20_deposito_delete->ShowMessage();
?>
<form name="ft20_depositodelete" id="ft20_depositodelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t20_deposito_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t20_deposito_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t20_deposito">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t20_deposito_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t20_deposito->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t20_deposito->id->Visible) { // id ?>
		<th><span id="elh_t20_deposito_id" class="t20_deposito_id"><?php echo $t20_deposito->id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
		<th><span id="elh_t20_deposito_No_Urut" class="t20_deposito_No_Urut"><?php echo $t20_deposito->No_Urut->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
		<th><span id="elh_t20_deposito_Tanggal_Valuta" class="t20_deposito_Tanggal_Valuta"><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
		<th><span id="elh_t20_deposito_Tanggal_Jatuh_Tempo" class="t20_deposito_Tanggal_Jatuh_Tempo"><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
		<th><span id="elh_t20_deposito_Suku_Bunga" class="t20_deposito_Suku_Bunga"><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
		<th><span id="elh_t20_deposito_Jumlah_Bunga" class="t20_deposito_Jumlah_Bunga"><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
		<th><span id="elh_t20_deposito_Dikredit_Diperpanjang" class="t20_deposito_Dikredit_Diperpanjang"><?php echo $t20_deposito->Dikredit_Diperpanjang->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
		<th><span id="elh_t20_deposito_Tunai_Transfer" class="t20_deposito_Tunai_Transfer"><?php echo $t20_deposito->Tunai_Transfer->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<th><span id="elh_t20_deposito_nasabah_id" class="t20_deposito_nasabah_id"><?php echo $t20_deposito->nasabah_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
		<th><span id="elh_t20_deposito_Jumlah_Deposito" class="t20_deposito_Jumlah_Deposito"><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t20_deposito_delete->RecCnt = 0;
$i = 0;
while (!$t20_deposito_delete->Recordset->EOF) {
	$t20_deposito_delete->RecCnt++;
	$t20_deposito_delete->RowCnt++;

	// Set row properties
	$t20_deposito->ResetAttrs();
	$t20_deposito->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t20_deposito_delete->LoadRowValues($t20_deposito_delete->Recordset);

	// Render row
	$t20_deposito_delete->RenderRow();
?>
	<tr<?php echo $t20_deposito->RowAttributes() ?>>
<?php if ($t20_deposito->id->Visible) { // id ?>
		<td<?php echo $t20_deposito->id->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_id" class="t20_deposito_id">
<span<?php echo $t20_deposito->id->ViewAttributes() ?>>
<?php echo $t20_deposito->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
		<td<?php echo $t20_deposito->No_Urut->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_No_Urut" class="t20_deposito_No_Urut">
<span<?php echo $t20_deposito->No_Urut->ViewAttributes() ?>>
<?php echo $t20_deposito->No_Urut->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
		<td<?php echo $t20_deposito->Tanggal_Valuta->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Tanggal_Valuta" class="t20_deposito_Tanggal_Valuta">
<span<?php echo $t20_deposito->Tanggal_Valuta->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Valuta->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
		<td<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Tanggal_Jatuh_Tempo" class="t20_deposito_Tanggal_Jatuh_Tempo">
<span<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
		<td<?php echo $t20_deposito->Suku_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Suku_Bunga" class="t20_deposito_Suku_Bunga">
<span<?php echo $t20_deposito->Suku_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Suku_Bunga->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
		<td<?php echo $t20_deposito->Jumlah_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Jumlah_Bunga" class="t20_deposito_Jumlah_Bunga">
<span<?php echo $t20_deposito->Jumlah_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Bunga->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
		<td<?php echo $t20_deposito->Dikredit_Diperpanjang->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Dikredit_Diperpanjang" class="t20_deposito_Dikredit_Diperpanjang">
<span<?php echo $t20_deposito->Dikredit_Diperpanjang->ViewAttributes() ?>>
<?php echo $t20_deposito->Dikredit_Diperpanjang->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
		<td<?php echo $t20_deposito->Tunai_Transfer->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Tunai_Transfer" class="t20_deposito_Tunai_Transfer">
<span<?php echo $t20_deposito->Tunai_Transfer->ViewAttributes() ?>>
<?php echo $t20_deposito->Tunai_Transfer->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<td<?php echo $t20_deposito->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_nasabah_id" class="t20_deposito_nasabah_id">
<span<?php echo $t20_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t20_deposito->nasabah_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
		<td<?php echo $t20_deposito->Jumlah_Deposito->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_delete->RowCnt ?>_t20_deposito_Jumlah_Deposito" class="t20_deposito_Jumlah_Deposito">
<span<?php echo $t20_deposito->Jumlah_Deposito->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Deposito->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t20_deposito_delete->Recordset->MoveNext();
}
$t20_deposito_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t20_deposito_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft20_depositodelete.Init();
</script>
<?php
$t20_deposito_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t20_deposito_delete->Page_Terminate();
?>
