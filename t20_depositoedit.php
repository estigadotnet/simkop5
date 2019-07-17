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

$t20_deposito_edit = NULL; // Initialize page object first

class ct20_deposito_edit extends ct20_deposito {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't20_deposito';

	// Page object name
	var $PageObjName = 't20_deposito_edit';

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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->No_Urut->SetVisibility();
		$this->Tanggal_Valuta->SetVisibility();
		$this->Tanggal_Jatuh_Tempo->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->bank_id->SetVisibility();
		$this->Jumlah_Deposito->SetVisibility();
		$this->Jumlah_Terbilang->SetVisibility();
		$this->Suku_Bunga->SetVisibility();
		$this->Jumlah_Bunga->SetVisibility();
		$this->Dikredit_Diperpanjang->SetVisibility();
		$this->Tunai_Transfer->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->id->CurrentValue == "") {
			$this->Page_Terminate("t20_depositolist.php"); // Invalid key, return to list
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t20_depositolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t20_depositolist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->No_Urut->FldIsDetailKey) {
			$this->No_Urut->setFormValue($objForm->GetValue("x_No_Urut"));
		}
		if (!$this->Tanggal_Valuta->FldIsDetailKey) {
			$this->Tanggal_Valuta->setFormValue($objForm->GetValue("x_Tanggal_Valuta"));
			$this->Tanggal_Valuta->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Valuta->CurrentValue, 7);
		}
		if (!$this->Tanggal_Jatuh_Tempo->FldIsDetailKey) {
			$this->Tanggal_Jatuh_Tempo->setFormValue($objForm->GetValue("x_Tanggal_Jatuh_Tempo"));
			$this->Tanggal_Jatuh_Tempo->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Jatuh_Tempo->CurrentValue, 7);
		}
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->bank_id->FldIsDetailKey) {
			$this->bank_id->setFormValue($objForm->GetValue("x_bank_id"));
		}
		if (!$this->Jumlah_Deposito->FldIsDetailKey) {
			$this->Jumlah_Deposito->setFormValue($objForm->GetValue("x_Jumlah_Deposito"));
		}
		if (!$this->Jumlah_Terbilang->FldIsDetailKey) {
			$this->Jumlah_Terbilang->setFormValue($objForm->GetValue("x_Jumlah_Terbilang"));
		}
		if (!$this->Suku_Bunga->FldIsDetailKey) {
			$this->Suku_Bunga->setFormValue($objForm->GetValue("x_Suku_Bunga"));
		}
		if (!$this->Jumlah_Bunga->FldIsDetailKey) {
			$this->Jumlah_Bunga->setFormValue($objForm->GetValue("x_Jumlah_Bunga"));
		}
		if (!$this->Dikredit_Diperpanjang->FldIsDetailKey) {
			$this->Dikredit_Diperpanjang->setFormValue($objForm->GetValue("x_Dikredit_Diperpanjang"));
		}
		if (!$this->Tunai_Transfer->FldIsDetailKey) {
			$this->Tunai_Transfer->setFormValue($objForm->GetValue("x_Tunai_Transfer"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->No_Urut->CurrentValue = $this->No_Urut->FormValue;
		$this->Tanggal_Valuta->CurrentValue = $this->Tanggal_Valuta->FormValue;
		$this->Tanggal_Valuta->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Valuta->CurrentValue, 7);
		$this->Tanggal_Jatuh_Tempo->CurrentValue = $this->Tanggal_Jatuh_Tempo->FormValue;
		$this->Tanggal_Jatuh_Tempo->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Jatuh_Tempo->CurrentValue, 7);
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
		$this->bank_id->CurrentValue = $this->bank_id->FormValue;
		$this->Jumlah_Deposito->CurrentValue = $this->Jumlah_Deposito->FormValue;
		$this->Jumlah_Terbilang->CurrentValue = $this->Jumlah_Terbilang->FormValue;
		$this->Suku_Bunga->CurrentValue = $this->Suku_Bunga->FormValue;
		$this->Jumlah_Bunga->CurrentValue = $this->Jumlah_Bunga->FormValue;
		$this->Dikredit_Diperpanjang->CurrentValue = $this->Dikredit_Diperpanjang->FormValue;
		$this->Tunai_Transfer->CurrentValue = $this->Tunai_Transfer->FormValue;
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
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		if (array_key_exists('EV__nasabah_id', $rs->fields)) {
			$this->nasabah_id->VirtualValue = $rs->fields('EV__nasabah_id'); // Set up virtual field value
		} else {
			$this->nasabah_id->VirtualValue = ""; // Clear value
		}
		$this->bank_id->setDbValue($rs->fields('bank_id'));
		$this->Jumlah_Deposito->setDbValue($rs->fields('Jumlah_Deposito'));
		$this->Jumlah_Terbilang->setDbValue($rs->fields('Jumlah_Terbilang'));
		$this->Suku_Bunga->setDbValue($rs->fields('Suku_Bunga'));
		$this->Jumlah_Bunga->setDbValue($rs->fields('Jumlah_Bunga'));
		$this->Dikredit_Diperpanjang->setDbValue($rs->fields('Dikredit_Diperpanjang'));
		$this->Tunai_Transfer->setDbValue($rs->fields('Tunai_Transfer'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->No_Urut->DbValue = $row['No_Urut'];
		$this->Tanggal_Valuta->DbValue = $row['Tanggal_Valuta'];
		$this->Tanggal_Jatuh_Tempo->DbValue = $row['Tanggal_Jatuh_Tempo'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->bank_id->DbValue = $row['bank_id'];
		$this->Jumlah_Deposito->DbValue = $row['Jumlah_Deposito'];
		$this->Jumlah_Terbilang->DbValue = $row['Jumlah_Terbilang'];
		$this->Suku_Bunga->DbValue = $row['Suku_Bunga'];
		$this->Jumlah_Bunga->DbValue = $row['Jumlah_Bunga'];
		$this->Dikredit_Diperpanjang->DbValue = $row['Dikredit_Diperpanjang'];
		$this->Tunai_Transfer->DbValue = $row['Tunai_Transfer'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Jumlah_Deposito->FormValue == $this->Jumlah_Deposito->CurrentValue && is_numeric(ew_StrToFloat($this->Jumlah_Deposito->CurrentValue)))
			$this->Jumlah_Deposito->CurrentValue = ew_StrToFloat($this->Jumlah_Deposito->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Suku_Bunga->FormValue == $this->Suku_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Suku_Bunga->CurrentValue)))
			$this->Suku_Bunga->CurrentValue = ew_StrToFloat($this->Suku_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Jumlah_Bunga->FormValue == $this->Jumlah_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Jumlah_Bunga->CurrentValue)))
			$this->Jumlah_Bunga->CurrentValue = ew_StrToFloat($this->Jumlah_Bunga->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// No_Urut
		// Tanggal_Valuta
		// Tanggal_Jatuh_Tempo
		// nasabah_id
		// bank_id
		// Jumlah_Deposito
		// Jumlah_Terbilang
		// Suku_Bunga
		// Jumlah_Bunga
		// Dikredit_Diperpanjang
		// Tunai_Transfer

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// bank_id
			$this->bank_id->LinkCustomAttributes = "";
			$this->bank_id->HrefValue = "";
			$this->bank_id->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// No_Urut
			$this->No_Urut->EditAttrs["class"] = "form-control";
			$this->No_Urut->EditCustomAttributes = "";
			$this->No_Urut->EditValue = ew_HtmlEncode($this->No_Urut->CurrentValue);
			$this->No_Urut->PlaceHolder = ew_RemoveHtml($this->No_Urut->FldCaption());

			// Tanggal_Valuta
			$this->Tanggal_Valuta->EditAttrs["class"] = "form-control";
			$this->Tanggal_Valuta->EditCustomAttributes = "style='width: 112px;''";
			$this->Tanggal_Valuta->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal_Valuta->CurrentValue, 7));
			$this->Tanggal_Valuta->PlaceHolder = ew_RemoveHtml($this->Tanggal_Valuta->FldCaption());

			// Tanggal_Jatuh_Tempo
			$this->Tanggal_Jatuh_Tempo->EditAttrs["class"] = "form-control";
			$this->Tanggal_Jatuh_Tempo->EditCustomAttributes = "style='width: 112px;''";
			$this->Tanggal_Jatuh_Tempo->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal_Jatuh_Tempo->CurrentValue, 7));
			$this->Tanggal_Jatuh_Tempo->PlaceHolder = ew_RemoveHtml($this->Tanggal_Jatuh_Tempo->FldCaption());

			// nasabah_id
			$this->nasabah_id->EditCustomAttributes = "";
			if (trim(strval($this->nasabah_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `v02_nasabahjaminan`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->nasabah_id->ViewValue = $this->nasabah_id->DisplayValue($arwrk);
			} else {
				$this->nasabah_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->nasabah_id->EditValue = $arwrk;

			// bank_id
			$this->bank_id->EditCustomAttributes = "";
			if (trim(strval($this->bank_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->bank_id->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `id`, `Nomor` AS `DispFld`, `Pemilik` AS `Disp2Fld`, `Bank` AS `Disp3Fld`, '' AS `Disp4Fld`, `nasabah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t21_bank`";
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
					$arwrk[3] = ew_HtmlEncode($rswrk->fields('Disp3Fld'));
					$this->bank_id->ViewValue .= $this->bank_id->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->bank_id->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->bank_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->bank_id->EditValue = $arwrk;

			// Jumlah_Deposito
			$this->Jumlah_Deposito->EditAttrs["class"] = "form-control";
			$this->Jumlah_Deposito->EditCustomAttributes = "";
			$this->Jumlah_Deposito->EditValue = ew_HtmlEncode($this->Jumlah_Deposito->CurrentValue);
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
			$this->Suku_Bunga->EditValue = ew_HtmlEncode($this->Suku_Bunga->CurrentValue);
			$this->Suku_Bunga->PlaceHolder = ew_RemoveHtml($this->Suku_Bunga->FldCaption());
			if (strval($this->Suku_Bunga->EditValue) <> "" && is_numeric($this->Suku_Bunga->EditValue)) $this->Suku_Bunga->EditValue = ew_FormatNumber($this->Suku_Bunga->EditValue, -2, -2, -2, -2);

			// Jumlah_Bunga
			$this->Jumlah_Bunga->EditAttrs["class"] = "form-control";
			$this->Jumlah_Bunga->EditCustomAttributes = "";
			$this->Jumlah_Bunga->EditValue = ew_HtmlEncode($this->Jumlah_Bunga->CurrentValue);
			$this->Jumlah_Bunga->PlaceHolder = ew_RemoveHtml($this->Jumlah_Bunga->FldCaption());
			if (strval($this->Jumlah_Bunga->EditValue) <> "" && is_numeric($this->Jumlah_Bunga->EditValue)) $this->Jumlah_Bunga->EditValue = ew_FormatNumber($this->Jumlah_Bunga->EditValue, -2, -2, -2, -2);

			// Dikredit_Diperpanjang
			$this->Dikredit_Diperpanjang->EditCustomAttributes = "";
			$this->Dikredit_Diperpanjang->EditValue = $this->Dikredit_Diperpanjang->Options(FALSE);

			// Tunai_Transfer
			$this->Tunai_Transfer->EditCustomAttributes = "";
			$this->Tunai_Transfer->EditValue = $this->Tunai_Transfer->Options(FALSE);

			// Edit refer script
			// No_Urut

			$this->No_Urut->LinkCustomAttributes = "";
			$this->No_Urut->HrefValue = "";

			// Tanggal_Valuta
			$this->Tanggal_Valuta->LinkCustomAttributes = "";
			$this->Tanggal_Valuta->HrefValue = "";

			// Tanggal_Jatuh_Tempo
			$this->Tanggal_Jatuh_Tempo->LinkCustomAttributes = "";
			$this->Tanggal_Jatuh_Tempo->HrefValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";

			// bank_id
			$this->bank_id->LinkCustomAttributes = "";
			$this->bank_id->HrefValue = "";

			// Jumlah_Deposito
			$this->Jumlah_Deposito->LinkCustomAttributes = "";
			$this->Jumlah_Deposito->HrefValue = "";

			// Jumlah_Terbilang
			$this->Jumlah_Terbilang->LinkCustomAttributes = "";
			$this->Jumlah_Terbilang->HrefValue = "";
			$this->Jumlah_Terbilang->TooltipValue = "";

			// Suku_Bunga
			$this->Suku_Bunga->LinkCustomAttributes = "";
			$this->Suku_Bunga->HrefValue = "";

			// Jumlah_Bunga
			$this->Jumlah_Bunga->LinkCustomAttributes = "";
			$this->Jumlah_Bunga->HrefValue = "";

			// Dikredit_Diperpanjang
			$this->Dikredit_Diperpanjang->LinkCustomAttributes = "";
			$this->Dikredit_Diperpanjang->HrefValue = "";

			// Tunai_Transfer
			$this->Tunai_Transfer->LinkCustomAttributes = "";
			$this->Tunai_Transfer->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->No_Urut->FldIsDetailKey && !is_null($this->No_Urut->FormValue) && $this->No_Urut->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->No_Urut->FldCaption(), $this->No_Urut->ReqErrMsg));
		}
		if (!$this->Tanggal_Valuta->FldIsDetailKey && !is_null($this->Tanggal_Valuta->FormValue) && $this->Tanggal_Valuta->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tanggal_Valuta->FldCaption(), $this->Tanggal_Valuta->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Tanggal_Valuta->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal_Valuta->FldErrMsg());
		}
		if (!$this->Tanggal_Jatuh_Tempo->FldIsDetailKey && !is_null($this->Tanggal_Jatuh_Tempo->FormValue) && $this->Tanggal_Jatuh_Tempo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tanggal_Jatuh_Tempo->FldCaption(), $this->Tanggal_Jatuh_Tempo->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Tanggal_Jatuh_Tempo->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal_Jatuh_Tempo->FldErrMsg());
		}
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if (!$this->Jumlah_Deposito->FldIsDetailKey && !is_null($this->Jumlah_Deposito->FormValue) && $this->Jumlah_Deposito->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Jumlah_Deposito->FldCaption(), $this->Jumlah_Deposito->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Jumlah_Deposito->FormValue)) {
			ew_AddMessage($gsFormError, $this->Jumlah_Deposito->FldErrMsg());
		}
		if (!$this->Suku_Bunga->FldIsDetailKey && !is_null($this->Suku_Bunga->FormValue) && $this->Suku_Bunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Suku_Bunga->FldCaption(), $this->Suku_Bunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Suku_Bunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Suku_Bunga->FldErrMsg());
		}
		if (!$this->Jumlah_Bunga->FldIsDetailKey && !is_null($this->Jumlah_Bunga->FormValue) && $this->Jumlah_Bunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Jumlah_Bunga->FldCaption(), $this->Jumlah_Bunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Jumlah_Bunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Jumlah_Bunga->FldErrMsg());
		}
		if ($this->Dikredit_Diperpanjang->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Dikredit_Diperpanjang->FldCaption(), $this->Dikredit_Diperpanjang->ReqErrMsg));
		}
		if ($this->Tunai_Transfer->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tunai_Transfer->FldCaption(), $this->Tunai_Transfer->ReqErrMsg));
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// No_Urut
			$this->No_Urut->SetDbValueDef($rsnew, $this->No_Urut->CurrentValue, "", $this->No_Urut->ReadOnly);

			// Tanggal_Valuta
			$this->Tanggal_Valuta->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal_Valuta->CurrentValue, 7), ew_CurrentDate(), $this->Tanggal_Valuta->ReadOnly);

			// Tanggal_Jatuh_Tempo
			$this->Tanggal_Jatuh_Tempo->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal_Jatuh_Tempo->CurrentValue, 7), ew_CurrentDate(), $this->Tanggal_Jatuh_Tempo->ReadOnly);

			// nasabah_id
			$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, $this->nasabah_id->ReadOnly);

			// bank_id
			$this->bank_id->SetDbValueDef($rsnew, $this->bank_id->CurrentValue, NULL, $this->bank_id->ReadOnly);

			// Jumlah_Deposito
			$this->Jumlah_Deposito->SetDbValueDef($rsnew, $this->Jumlah_Deposito->CurrentValue, 0, $this->Jumlah_Deposito->ReadOnly);

			// Suku_Bunga
			$this->Suku_Bunga->SetDbValueDef($rsnew, $this->Suku_Bunga->CurrentValue, 0, $this->Suku_Bunga->ReadOnly);

			// Jumlah_Bunga
			$this->Jumlah_Bunga->SetDbValueDef($rsnew, $this->Jumlah_Bunga->CurrentValue, 0, $this->Jumlah_Bunga->ReadOnly);

			// Dikredit_Diperpanjang
			$this->Dikredit_Diperpanjang->SetDbValueDef($rsnew, $this->Dikredit_Diperpanjang->CurrentValue, "", $this->Dikredit_Diperpanjang->ReadOnly);

			// Tunai_Transfer
			$this->Tunai_Transfer->SetDbValueDef($rsnew, $this->Tunai_Transfer->CurrentValue, "", $this->Tunai_Transfer->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t20_depositolist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v02_nasabahjaminan`";
			$sWhereWrk = "{filter}";
			$this->nasabah_id->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_bank_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nomor` AS `DispFld`, `Pemilik` AS `Disp2Fld`, `Bank` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t21_bank`";
			$sWhereWrk = "{filter}";
			$this->bank_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "", "f1" => '`nasabah_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->bank_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t20_deposito_edit)) $t20_deposito_edit = new ct20_deposito_edit();

// Page init
$t20_deposito_edit->Page_Init();

// Page main
$t20_deposito_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t20_deposito_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft20_depositoedit = new ew_Form("ft20_depositoedit", "edit");

// Validate form
ft20_depositoedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_No_Urut");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->No_Urut->FldCaption(), $t20_deposito->No_Urut->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Valuta");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Tanggal_Valuta->FldCaption(), $t20_deposito->Tanggal_Valuta->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Valuta");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t20_deposito->Tanggal_Valuta->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Jatuh_Tempo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption(), $t20_deposito->Tanggal_Jatuh_Tempo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal_Jatuh_Tempo");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t20_deposito->Tanggal_Jatuh_Tempo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->nasabah_id->FldCaption(), $t20_deposito->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah_Deposito");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Jumlah_Deposito->FldCaption(), $t20_deposito->Jumlah_Deposito->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah_Deposito");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t20_deposito->Jumlah_Deposito->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Suku_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Suku_Bunga->FldCaption(), $t20_deposito->Suku_Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Suku_Bunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t20_deposito->Suku_Bunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Jumlah_Bunga->FldCaption(), $t20_deposito->Jumlah_Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah_Bunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t20_deposito->Jumlah_Bunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Dikredit_Diperpanjang");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Dikredit_Diperpanjang->FldCaption(), $t20_deposito->Dikredit_Diperpanjang->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tunai_Transfer");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t20_deposito->Tunai_Transfer->FldCaption(), $t20_deposito->Tunai_Transfer->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft20_depositoedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft20_depositoedit.ValidateRequired = true;
<?php } else { ?>
ft20_depositoedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft20_depositoedit.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
ft20_depositoedit.Lists["x_bank_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor","x_Pemilik","x_Bank",""],"ParentFields":["x_nasabah_id"],"ChildFields":[],"FilterFields":["x_nasabah_id"],"Options":[],"Template":"","LinkTable":"t21_bank"};
ft20_depositoedit.Lists["x_Dikredit_Diperpanjang"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositoedit.Lists["x_Dikredit_Diperpanjang"].Options = <?php echo json_encode($t20_deposito->Dikredit_Diperpanjang->Options()) ?>;
ft20_depositoedit.Lists["x_Tunai_Transfer"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositoedit.Lists["x_Tunai_Transfer"].Options = <?php echo json_encode($t20_deposito->Tunai_Transfer->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t20_deposito_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t20_deposito_edit->ShowPageHeader(); ?>
<?php
$t20_deposito_edit->ShowMessage();
?>
<form name="ft20_depositoedit" id="ft20_depositoedit" class="<?php echo $t20_deposito_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t20_deposito_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t20_deposito_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t20_deposito">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t20_deposito_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
	<div id="r_No_Urut" class="form-group">
		<label id="elh_t20_deposito_No_Urut" for="x_No_Urut" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->No_Urut->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->No_Urut->CellAttributes() ?>>
<span id="el_t20_deposito_No_Urut">
<input type="text" data-table="t20_deposito" data-field="x_No_Urut" name="x_No_Urut" id="x_No_Urut" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->No_Urut->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->No_Urut->EditValue ?>"<?php echo $t20_deposito->No_Urut->EditAttributes() ?>>
</span>
<?php echo $t20_deposito->No_Urut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
	<div id="r_Tanggal_Valuta" class="form-group">
		<label id="elh_t20_deposito_Tanggal_Valuta" for="x_Tanggal_Valuta" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Tanggal_Valuta->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Valuta">
<input type="text" data-table="t20_deposito" data-field="x_Tanggal_Valuta" data-format="7" name="x_Tanggal_Valuta" id="x_Tanggal_Valuta" size="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->Tanggal_Valuta->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->Tanggal_Valuta->EditValue ?>"<?php echo $t20_deposito->Tanggal_Valuta->EditAttributes() ?>>
<?php if (!$t20_deposito->Tanggal_Valuta->ReadOnly && !$t20_deposito->Tanggal_Valuta->Disabled && !isset($t20_deposito->Tanggal_Valuta->EditAttrs["readonly"]) && !isset($t20_deposito->Tanggal_Valuta->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft20_depositoedit", "x_Tanggal_Valuta", 7);
</script>
<?php } ?>
</span>
<?php echo $t20_deposito->Tanggal_Valuta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
	<div id="r_Tanggal_Jatuh_Tempo" class="form-group">
		<label id="elh_t20_deposito_Tanggal_Jatuh_Tempo" for="x_Tanggal_Jatuh_Tempo" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Jatuh_Tempo">
<input type="text" data-table="t20_deposito" data-field="x_Tanggal_Jatuh_Tempo" data-format="7" name="x_Tanggal_Jatuh_Tempo" id="x_Tanggal_Jatuh_Tempo" size="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->Tanggal_Jatuh_Tempo->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->EditValue ?>"<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->EditAttributes() ?>>
<?php if (!$t20_deposito->Tanggal_Jatuh_Tempo->ReadOnly && !$t20_deposito->Tanggal_Jatuh_Tempo->Disabled && !isset($t20_deposito->Tanggal_Jatuh_Tempo->EditAttrs["readonly"]) && !isset($t20_deposito->Tanggal_Jatuh_Tempo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft20_depositoedit", "x_Tanggal_Jatuh_Tempo", 7);
</script>
<?php } ?>
</span>
<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t20_deposito_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t20_deposito_nasabah_id">
<?php $t20_deposito->nasabah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t20_deposito->nasabah_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_nasabah_id"><?php echo (strval($t20_deposito->nasabah_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t20_deposito->nasabah_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t20_deposito->nasabah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_nasabah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t20_deposito" data-field="x_nasabah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t20_deposito->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x_nasabah_id" id="x_nasabah_id" value="<?php echo $t20_deposito->nasabah_id->CurrentValue ?>"<?php echo $t20_deposito->nasabah_id->EditAttributes() ?>>
<input type="hidden" name="s_x_nasabah_id" id="s_x_nasabah_id" value="<?php echo $t20_deposito->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php echo $t20_deposito->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->bank_id->Visible) { // bank_id ?>
	<div id="r_bank_id" class="form-group">
		<label id="elh_t20_deposito_bank_id" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->bank_id->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->bank_id->CellAttributes() ?>>
<span id="el_t20_deposito_bank_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<?php echo $t20_deposito->bank_id->ViewValue ?>
	</span>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<div id="dsl_x_bank_id" data-repeatcolumn="5" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $t20_deposito->bank_id->CheckBoxListHtml(TRUE, "x_bank_id[]") ?>
		</div>
	</div>
	<div id="tp_x_bank_id" class="ewTemplate"><input type="checkbox" data-table="t20_deposito" data-field="x_bank_id" data-value-separator="<?php echo $t20_deposito->bank_id->DisplayValueSeparatorAttribute() ?>" name="x_bank_id[]" id="x_bank_id[]" value="{value}"<?php echo $t20_deposito->bank_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="s_x_bank_id" id="s_x_bank_id" value="<?php echo $t20_deposito->bank_id->LookupFilterQuery() ?>">
</span>
<?php echo $t20_deposito->bank_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
	<div id="r_Jumlah_Deposito" class="form-group">
		<label id="elh_t20_deposito_Jumlah_Deposito" for="x_Jumlah_Deposito" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Jumlah_Deposito->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Deposito">
<input type="text" data-table="t20_deposito" data-field="x_Jumlah_Deposito" name="x_Jumlah_Deposito" id="x_Jumlah_Deposito" size="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->Jumlah_Deposito->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->Jumlah_Deposito->EditValue ?>"<?php echo $t20_deposito->Jumlah_Deposito->EditAttributes() ?>>
</span>
<?php echo $t20_deposito->Jumlah_Deposito->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Terbilang->Visible) { // Jumlah_Terbilang ?>
	<div id="r_Jumlah_Terbilang" class="form-group">
		<label id="elh_t20_deposito_Jumlah_Terbilang" for="x_Jumlah_Terbilang" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Jumlah_Terbilang->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Jumlah_Terbilang->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Terbilang">
<span<?php echo $t20_deposito->Jumlah_Terbilang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t20_deposito->Jumlah_Terbilang->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t20_deposito" data-field="x_Jumlah_Terbilang" name="x_Jumlah_Terbilang" id="x_Jumlah_Terbilang" value="<?php echo ew_HtmlEncode($t20_deposito->Jumlah_Terbilang->CurrentValue) ?>">
<?php echo $t20_deposito->Jumlah_Terbilang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
	<div id="r_Suku_Bunga" class="form-group">
		<label id="elh_t20_deposito_Suku_Bunga" for="x_Suku_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Suku_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Suku_Bunga">
<input type="text" data-table="t20_deposito" data-field="x_Suku_Bunga" name="x_Suku_Bunga" id="x_Suku_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->Suku_Bunga->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->Suku_Bunga->EditValue ?>"<?php echo $t20_deposito->Suku_Bunga->EditAttributes() ?>>
</span>
<?php echo $t20_deposito->Suku_Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
	<div id="r_Jumlah_Bunga" class="form-group">
		<label id="elh_t20_deposito_Jumlah_Bunga" for="x_Jumlah_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Jumlah_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Bunga">
<input type="text" data-table="t20_deposito" data-field="x_Jumlah_Bunga" name="x_Jumlah_Bunga" id="x_Jumlah_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->Jumlah_Bunga->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->Jumlah_Bunga->EditValue ?>"<?php echo $t20_deposito->Jumlah_Bunga->EditAttributes() ?>>
</span>
<?php echo $t20_deposito->Jumlah_Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
	<div id="r_Dikredit_Diperpanjang" class="form-group">
		<label id="elh_t20_deposito_Dikredit_Diperpanjang" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Dikredit_Diperpanjang->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Dikredit_Diperpanjang->CellAttributes() ?>>
<span id="el_t20_deposito_Dikredit_Diperpanjang">
<div id="tp_x_Dikredit_Diperpanjang" class="ewTemplate"><input type="radio" data-table="t20_deposito" data-field="x_Dikredit_Diperpanjang" data-value-separator="<?php echo $t20_deposito->Dikredit_Diperpanjang->DisplayValueSeparatorAttribute() ?>" name="x_Dikredit_Diperpanjang" id="x_Dikredit_Diperpanjang" value="{value}"<?php echo $t20_deposito->Dikredit_Diperpanjang->EditAttributes() ?>></div>
<div id="dsl_x_Dikredit_Diperpanjang" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t20_deposito->Dikredit_Diperpanjang->RadioButtonListHtml(FALSE, "x_Dikredit_Diperpanjang") ?>
</div></div>
</span>
<?php echo $t20_deposito->Dikredit_Diperpanjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
	<div id="r_Tunai_Transfer" class="form-group">
		<label id="elh_t20_deposito_Tunai_Transfer" class="col-sm-2 control-label ewLabel"><?php echo $t20_deposito->Tunai_Transfer->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t20_deposito->Tunai_Transfer->CellAttributes() ?>>
<span id="el_t20_deposito_Tunai_Transfer">
<div id="tp_x_Tunai_Transfer" class="ewTemplate"><input type="radio" data-table="t20_deposito" data-field="x_Tunai_Transfer" data-value-separator="<?php echo $t20_deposito->Tunai_Transfer->DisplayValueSeparatorAttribute() ?>" name="x_Tunai_Transfer" id="x_Tunai_Transfer" value="{value}"<?php echo $t20_deposito->Tunai_Transfer->EditAttributes() ?>></div>
<div id="dsl_x_Tunai_Transfer" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t20_deposito->Tunai_Transfer->RadioButtonListHtml(FALSE, "x_Tunai_Transfer") ?>
</div></div>
</span>
<?php echo $t20_deposito->Tunai_Transfer->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t20_deposito" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t20_deposito->id->CurrentValue) ?>">
<?php if (!$t20_deposito_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t20_deposito_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft20_depositoedit.Init();
</script>
<?php
$t20_deposito_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t20_deposito_edit->Page_Terminate();
?>
