<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t04_pinjamanangsurantempinfo.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t04_pinjamanangsurantemp_edit = NULL; // Initialize page object first

class ct04_pinjamanangsurantemp_edit extends ct04_pinjamanangsurantemp {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't04_pinjamanangsurantemp';

	// Page object name
	var $PageObjName = 't04_pinjamanangsurantemp_edit';

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

		// Table object (t04_pinjamanangsurantemp)
		if (!isset($GLOBALS["t04_pinjamanangsurantemp"]) || get_class($GLOBALS["t04_pinjamanangsurantemp"]) == "ct04_pinjamanangsurantemp") {
			$GLOBALS["t04_pinjamanangsurantemp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t04_pinjamanangsurantemp"];
		}

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS['t03_pinjaman'])) $GLOBALS['t03_pinjaman'] = new ct03_pinjaman();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't04_pinjamanangsurantemp', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t04_pinjamanangsurantemplist.php"));
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
		$this->Angsuran_Ke->SetVisibility();
		$this->Angsuran_Tanggal->SetVisibility();
		$this->Angsuran_Pokok->SetVisibility();
		$this->Angsuran_Bunga->SetVisibility();
		$this->Angsuran_Total->SetVisibility();
		$this->Sisa_Hutang->SetVisibility();
		$this->Tanggal_Bayar->SetVisibility();
		$this->Terlambat->SetVisibility();
		$this->Total_Denda->SetVisibility();
		$this->Bayar_Titipan->SetVisibility();
		$this->Bayar_Non_Titipan->SetVisibility();
		$this->Bayar_Total->SetVisibility();
		$this->Keterangan->SetVisibility();

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
		global $EW_EXPORT, $t04_pinjamanangsurantemp;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t04_pinjamanangsurantemp);
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

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->id->CurrentValue == "") {
			$this->Page_Terminate("t04_pinjamanangsurantemplist.php"); // Invalid key, return to list
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
					$this->Page_Terminate("t04_pinjamanangsurantemplist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t04_pinjamanangsurantemplist.php")
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
		if (!$this->Angsuran_Ke->FldIsDetailKey) {
			$this->Angsuran_Ke->setFormValue($objForm->GetValue("x_Angsuran_Ke"));
		}
		if (!$this->Angsuran_Tanggal->FldIsDetailKey) {
			$this->Angsuran_Tanggal->setFormValue($objForm->GetValue("x_Angsuran_Tanggal"));
			$this->Angsuran_Tanggal->CurrentValue = ew_UnFormatDateTime($this->Angsuran_Tanggal->CurrentValue, 7);
		}
		if (!$this->Angsuran_Pokok->FldIsDetailKey) {
			$this->Angsuran_Pokok->setFormValue($objForm->GetValue("x_Angsuran_Pokok"));
		}
		if (!$this->Angsuran_Bunga->FldIsDetailKey) {
			$this->Angsuran_Bunga->setFormValue($objForm->GetValue("x_Angsuran_Bunga"));
		}
		if (!$this->Angsuran_Total->FldIsDetailKey) {
			$this->Angsuran_Total->setFormValue($objForm->GetValue("x_Angsuran_Total"));
		}
		if (!$this->Sisa_Hutang->FldIsDetailKey) {
			$this->Sisa_Hutang->setFormValue($objForm->GetValue("x_Sisa_Hutang"));
		}
		if (!$this->Tanggal_Bayar->FldIsDetailKey) {
			$this->Tanggal_Bayar->setFormValue($objForm->GetValue("x_Tanggal_Bayar"));
			$this->Tanggal_Bayar->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Bayar->CurrentValue, 7);
		}
		if (!$this->Terlambat->FldIsDetailKey) {
			$this->Terlambat->setFormValue($objForm->GetValue("x_Terlambat"));
		}
		if (!$this->Total_Denda->FldIsDetailKey) {
			$this->Total_Denda->setFormValue($objForm->GetValue("x_Total_Denda"));
		}
		if (!$this->Bayar_Titipan->FldIsDetailKey) {
			$this->Bayar_Titipan->setFormValue($objForm->GetValue("x_Bayar_Titipan"));
		}
		if (!$this->Bayar_Non_Titipan->FldIsDetailKey) {
			$this->Bayar_Non_Titipan->setFormValue($objForm->GetValue("x_Bayar_Non_Titipan"));
		}
		if (!$this->Bayar_Total->FldIsDetailKey) {
			$this->Bayar_Total->setFormValue($objForm->GetValue("x_Bayar_Total"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->Angsuran_Ke->CurrentValue = $this->Angsuran_Ke->FormValue;
		$this->Angsuran_Tanggal->CurrentValue = $this->Angsuran_Tanggal->FormValue;
		$this->Angsuran_Tanggal->CurrentValue = ew_UnFormatDateTime($this->Angsuran_Tanggal->CurrentValue, 7);
		$this->Angsuran_Pokok->CurrentValue = $this->Angsuran_Pokok->FormValue;
		$this->Angsuran_Bunga->CurrentValue = $this->Angsuran_Bunga->FormValue;
		$this->Angsuran_Total->CurrentValue = $this->Angsuran_Total->FormValue;
		$this->Sisa_Hutang->CurrentValue = $this->Sisa_Hutang->FormValue;
		$this->Tanggal_Bayar->CurrentValue = $this->Tanggal_Bayar->FormValue;
		$this->Tanggal_Bayar->CurrentValue = ew_UnFormatDateTime($this->Tanggal_Bayar->CurrentValue, 7);
		$this->Terlambat->CurrentValue = $this->Terlambat->FormValue;
		$this->Total_Denda->CurrentValue = $this->Total_Denda->FormValue;
		$this->Bayar_Titipan->CurrentValue = $this->Bayar_Titipan->FormValue;
		$this->Bayar_Non_Titipan->CurrentValue = $this->Bayar_Non_Titipan->FormValue;
		$this->Bayar_Total->CurrentValue = $this->Bayar_Total->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
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
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->Angsuran_Ke->setDbValue($rs->fields('Angsuran_Ke'));
		$this->Angsuran_Tanggal->setDbValue($rs->fields('Angsuran_Tanggal'));
		$this->Angsuran_Pokok->setDbValue($rs->fields('Angsuran_Pokok'));
		$this->Angsuran_Bunga->setDbValue($rs->fields('Angsuran_Bunga'));
		$this->Angsuran_Total->setDbValue($rs->fields('Angsuran_Total'));
		$this->Sisa_Hutang->setDbValue($rs->fields('Sisa_Hutang'));
		$this->Tanggal_Bayar->setDbValue($rs->fields('Tanggal_Bayar'));
		$this->Terlambat->setDbValue($rs->fields('Terlambat'));
		$this->Total_Denda->setDbValue($rs->fields('Total_Denda'));
		$this->Bayar_Titipan->setDbValue($rs->fields('Bayar_Titipan'));
		$this->Bayar_Non_Titipan->setDbValue($rs->fields('Bayar_Non_Titipan'));
		$this->Bayar_Total->setDbValue($rs->fields('Bayar_Total'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Periode->setDbValue($rs->fields('Periode'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pinjaman_id->DbValue = $row['pinjaman_id'];
		$this->Angsuran_Ke->DbValue = $row['Angsuran_Ke'];
		$this->Angsuran_Tanggal->DbValue = $row['Angsuran_Tanggal'];
		$this->Angsuran_Pokok->DbValue = $row['Angsuran_Pokok'];
		$this->Angsuran_Bunga->DbValue = $row['Angsuran_Bunga'];
		$this->Angsuran_Total->DbValue = $row['Angsuran_Total'];
		$this->Sisa_Hutang->DbValue = $row['Sisa_Hutang'];
		$this->Tanggal_Bayar->DbValue = $row['Tanggal_Bayar'];
		$this->Terlambat->DbValue = $row['Terlambat'];
		$this->Total_Denda->DbValue = $row['Total_Denda'];
		$this->Bayar_Titipan->DbValue = $row['Bayar_Titipan'];
		$this->Bayar_Non_Titipan->DbValue = $row['Bayar_Non_Titipan'];
		$this->Bayar_Total->DbValue = $row['Bayar_Total'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->Periode->DbValue = $row['Periode'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Angsuran_Pokok->FormValue == $this->Angsuran_Pokok->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Pokok->CurrentValue)))
			$this->Angsuran_Pokok->CurrentValue = ew_StrToFloat($this->Angsuran_Pokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Bunga->FormValue == $this->Angsuran_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Bunga->CurrentValue)))
			$this->Angsuran_Bunga->CurrentValue = ew_StrToFloat($this->Angsuran_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Total->FormValue == $this->Angsuran_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Total->CurrentValue)))
			$this->Angsuran_Total->CurrentValue = ew_StrToFloat($this->Angsuran_Total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Sisa_Hutang->FormValue == $this->Sisa_Hutang->CurrentValue && is_numeric(ew_StrToFloat($this->Sisa_Hutang->CurrentValue)))
			$this->Sisa_Hutang->CurrentValue = ew_StrToFloat($this->Sisa_Hutang->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Total_Denda->FormValue == $this->Total_Denda->CurrentValue && is_numeric(ew_StrToFloat($this->Total_Denda->CurrentValue)))
			$this->Total_Denda->CurrentValue = ew_StrToFloat($this->Total_Denda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Titipan->FormValue == $this->Bayar_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Titipan->CurrentValue)))
			$this->Bayar_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Non_Titipan->FormValue == $this->Bayar_Non_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue)))
			$this->Bayar_Non_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Total->FormValue == $this->Bayar_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Total->CurrentValue)))
			$this->Bayar_Total->CurrentValue = ew_StrToFloat($this->Bayar_Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// pinjaman_id
		// Angsuran_Ke
		// Angsuran_Tanggal
		// Angsuran_Pokok
		// Angsuran_Bunga
		// Angsuran_Total
		// Sisa_Hutang
		// Tanggal_Bayar
		// Terlambat
		// Total_Denda
		// Bayar_Titipan
		// Bayar_Non_Titipan
		// Bayar_Total
		// Keterangan
		// Periode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Angsuran_Ke
		$this->Angsuran_Ke->ViewValue = $this->Angsuran_Ke->CurrentValue;
		$this->Angsuran_Ke->ViewCustomAttributes = "";

		// Angsuran_Tanggal
		$this->Angsuran_Tanggal->ViewValue = $this->Angsuran_Tanggal->CurrentValue;
		$this->Angsuran_Tanggal->ViewValue = ew_FormatDateTime($this->Angsuran_Tanggal->ViewValue, 7);
		$this->Angsuran_Tanggal->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewValue = ew_FormatNumber($this->Angsuran_Pokok->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Pokok->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewValue = ew_FormatNumber($this->Angsuran_Bunga->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Bunga->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewValue = ew_FormatNumber($this->Angsuran_Total->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Total->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// Sisa_Hutang
		$this->Sisa_Hutang->ViewValue = $this->Sisa_Hutang->CurrentValue;
		$this->Sisa_Hutang->ViewValue = ew_FormatNumber($this->Sisa_Hutang->ViewValue, 2, -2, -2, -2);
		$this->Sisa_Hutang->CellCssStyle .= "text-align: left;";
		$this->Sisa_Hutang->ViewCustomAttributes = "";

		// Tanggal_Bayar
		$this->Tanggal_Bayar->ViewValue = $this->Tanggal_Bayar->CurrentValue;
		$this->Tanggal_Bayar->ViewValue = ew_FormatDateTime($this->Tanggal_Bayar->ViewValue, 7);
		$this->Tanggal_Bayar->ViewCustomAttributes = "";

		// Terlambat
		$this->Terlambat->ViewValue = $this->Terlambat->CurrentValue;
		$this->Terlambat->ViewValue = ew_FormatNumber($this->Terlambat->ViewValue, 0, -2, -2, -2);
		$this->Terlambat->CellCssStyle .= "text-align: right;";
		$this->Terlambat->ViewCustomAttributes = "";

		// Total_Denda
		$this->Total_Denda->ViewValue = $this->Total_Denda->CurrentValue;
		$this->Total_Denda->ViewValue = ew_FormatNumber($this->Total_Denda->ViewValue, 2, -2, -2, -2);
		$this->Total_Denda->CellCssStyle .= "text-align: right;";
		$this->Total_Denda->ViewCustomAttributes = "";

		// Bayar_Titipan
		$this->Bayar_Titipan->ViewValue = $this->Bayar_Titipan->CurrentValue;
		$this->Bayar_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Titipan->ViewCustomAttributes = "";

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->ViewValue = $this->Bayar_Non_Titipan->CurrentValue;
		$this->Bayar_Non_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Non_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Non_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Non_Titipan->ViewCustomAttributes = "";

		// Bayar_Total
		$this->Bayar_Total->ViewValue = $this->Bayar_Total->CurrentValue;
		$this->Bayar_Total->ViewValue = ew_FormatNumber($this->Bayar_Total->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Total->CellCssStyle .= "text-align: right;";
		$this->Bayar_Total->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

			// Angsuran_Ke
			$this->Angsuran_Ke->LinkCustomAttributes = "";
			$this->Angsuran_Ke->HrefValue = "";
			$this->Angsuran_Ke->TooltipValue = "";

			// Angsuran_Tanggal
			$this->Angsuran_Tanggal->LinkCustomAttributes = "";
			$this->Angsuran_Tanggal->HrefValue = "";
			$this->Angsuran_Tanggal->TooltipValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->LinkCustomAttributes = "";
			$this->Angsuran_Pokok->HrefValue = "";
			$this->Angsuran_Pokok->TooltipValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->LinkCustomAttributes = "";
			$this->Angsuran_Bunga->HrefValue = "";
			$this->Angsuran_Bunga->TooltipValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->LinkCustomAttributes = "";
			$this->Angsuran_Total->HrefValue = "";
			$this->Angsuran_Total->TooltipValue = "";

			// Sisa_Hutang
			$this->Sisa_Hutang->LinkCustomAttributes = "";
			$this->Sisa_Hutang->HrefValue = "";
			$this->Sisa_Hutang->TooltipValue = "";

			// Tanggal_Bayar
			$this->Tanggal_Bayar->LinkCustomAttributes = "";
			$this->Tanggal_Bayar->HrefValue = "";
			$this->Tanggal_Bayar->TooltipValue = "";

			// Terlambat
			$this->Terlambat->LinkCustomAttributes = "";
			$this->Terlambat->HrefValue = "";
			$this->Terlambat->TooltipValue = "";

			// Total_Denda
			$this->Total_Denda->LinkCustomAttributes = "";
			$this->Total_Denda->HrefValue = "";
			$this->Total_Denda->TooltipValue = "";

			// Bayar_Titipan
			$this->Bayar_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Titipan->HrefValue = "";
			$this->Bayar_Titipan->TooltipValue = "";

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Non_Titipan->HrefValue = "";
			$this->Bayar_Non_Titipan->TooltipValue = "";

			// Bayar_Total
			$this->Bayar_Total->LinkCustomAttributes = "";
			$this->Bayar_Total->HrefValue = "";
			$this->Bayar_Total->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Angsuran_Ke
			$this->Angsuran_Ke->EditAttrs["class"] = "form-control";
			$this->Angsuran_Ke->EditCustomAttributes = "";
			$this->Angsuran_Ke->EditValue = $this->Angsuran_Ke->CurrentValue;
			$this->Angsuran_Ke->ViewCustomAttributes = "";

			// Angsuran_Tanggal
			$this->Angsuran_Tanggal->EditAttrs["class"] = "form-control";
			$this->Angsuran_Tanggal->EditCustomAttributes = "style='width: 115px;'";
			$this->Angsuran_Tanggal->EditValue = $this->Angsuran_Tanggal->CurrentValue;
			$this->Angsuran_Tanggal->EditValue = ew_FormatDateTime($this->Angsuran_Tanggal->EditValue, 7);
			$this->Angsuran_Tanggal->ViewCustomAttributes = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->EditAttrs["class"] = "form-control";
			$this->Angsuran_Pokok->EditCustomAttributes = "";
			$this->Angsuran_Pokok->EditValue = $this->Angsuran_Pokok->CurrentValue;
			$this->Angsuran_Pokok->EditValue = ew_FormatNumber($this->Angsuran_Pokok->EditValue, 2, -2, -2, -2);
			$this->Angsuran_Pokok->CellCssStyle .= "text-align: left;";
			$this->Angsuran_Pokok->ViewCustomAttributes = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->EditAttrs["class"] = "form-control";
			$this->Angsuran_Bunga->EditCustomAttributes = "";
			$this->Angsuran_Bunga->EditValue = $this->Angsuran_Bunga->CurrentValue;
			$this->Angsuran_Bunga->EditValue = ew_FormatNumber($this->Angsuran_Bunga->EditValue, 2, -2, -2, -2);
			$this->Angsuran_Bunga->CellCssStyle .= "text-align: left;";
			$this->Angsuran_Bunga->ViewCustomAttributes = "";

			// Angsuran_Total
			$this->Angsuran_Total->EditAttrs["class"] = "form-control";
			$this->Angsuran_Total->EditCustomAttributes = "";
			$this->Angsuran_Total->EditValue = $this->Angsuran_Total->CurrentValue;
			$this->Angsuran_Total->EditValue = ew_FormatNumber($this->Angsuran_Total->EditValue, 2, -2, -2, -2);
			$this->Angsuran_Total->CellCssStyle .= "text-align: left;";
			$this->Angsuran_Total->ViewCustomAttributes = "";

			// Sisa_Hutang
			$this->Sisa_Hutang->EditAttrs["class"] = "form-control";
			$this->Sisa_Hutang->EditCustomAttributes = "";
			$this->Sisa_Hutang->EditValue = $this->Sisa_Hutang->CurrentValue;
			$this->Sisa_Hutang->EditValue = ew_FormatNumber($this->Sisa_Hutang->EditValue, 2, -2, -2, -2);
			$this->Sisa_Hutang->CellCssStyle .= "text-align: left;";
			$this->Sisa_Hutang->ViewCustomAttributes = "";

			// Tanggal_Bayar
			$this->Tanggal_Bayar->EditAttrs["class"] = "form-control";
			$this->Tanggal_Bayar->EditCustomAttributes = "style='width: 115px;'";
			$this->Tanggal_Bayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal_Bayar->CurrentValue, 7));
			$this->Tanggal_Bayar->PlaceHolder = ew_RemoveHtml($this->Tanggal_Bayar->FldCaption());

			// Terlambat
			$this->Terlambat->EditAttrs["class"] = "form-control";
			$this->Terlambat->EditCustomAttributes = "";
			$this->Terlambat->EditValue = ew_HtmlEncode($this->Terlambat->CurrentValue);
			$this->Terlambat->PlaceHolder = ew_RemoveHtml($this->Terlambat->FldCaption());

			// Total_Denda
			$this->Total_Denda->EditAttrs["class"] = "form-control";
			$this->Total_Denda->EditCustomAttributes = "";
			$this->Total_Denda->EditValue = ew_HtmlEncode($this->Total_Denda->CurrentValue);
			$this->Total_Denda->PlaceHolder = ew_RemoveHtml($this->Total_Denda->FldCaption());
			if (strval($this->Total_Denda->EditValue) <> "" && is_numeric($this->Total_Denda->EditValue)) $this->Total_Denda->EditValue = ew_FormatNumber($this->Total_Denda->EditValue, -2, -2, -2, -2);

			// Bayar_Titipan
			$this->Bayar_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Titipan->EditCustomAttributes = "";
			$this->Bayar_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Titipan->CurrentValue);
			$this->Bayar_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Titipan->FldCaption());
			if (strval($this->Bayar_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Titipan->EditValue)) $this->Bayar_Titipan->EditValue = ew_FormatNumber($this->Bayar_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->EditAttrs["class"] = "form-control";
			$this->Bayar_Non_Titipan->EditCustomAttributes = "";
			$this->Bayar_Non_Titipan->EditValue = ew_HtmlEncode($this->Bayar_Non_Titipan->CurrentValue);
			$this->Bayar_Non_Titipan->PlaceHolder = ew_RemoveHtml($this->Bayar_Non_Titipan->FldCaption());
			if (strval($this->Bayar_Non_Titipan->EditValue) <> "" && is_numeric($this->Bayar_Non_Titipan->EditValue)) $this->Bayar_Non_Titipan->EditValue = ew_FormatNumber($this->Bayar_Non_Titipan->EditValue, -2, -2, -2, -2);

			// Bayar_Total
			$this->Bayar_Total->EditAttrs["class"] = "form-control";
			$this->Bayar_Total->EditCustomAttributes = "";
			$this->Bayar_Total->EditValue = ew_HtmlEncode($this->Bayar_Total->CurrentValue);
			$this->Bayar_Total->PlaceHolder = ew_RemoveHtml($this->Bayar_Total->FldCaption());
			if (strval($this->Bayar_Total->EditValue) <> "" && is_numeric($this->Bayar_Total->EditValue)) $this->Bayar_Total->EditValue = ew_FormatNumber($this->Bayar_Total->EditValue, -2, -2, -2, -2);

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// Edit refer script
			// Angsuran_Ke

			$this->Angsuran_Ke->LinkCustomAttributes = "";
			$this->Angsuran_Ke->HrefValue = "";
			$this->Angsuran_Ke->TooltipValue = "";

			// Angsuran_Tanggal
			$this->Angsuran_Tanggal->LinkCustomAttributes = "";
			$this->Angsuran_Tanggal->HrefValue = "";
			$this->Angsuran_Tanggal->TooltipValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->LinkCustomAttributes = "";
			$this->Angsuran_Pokok->HrefValue = "";
			$this->Angsuran_Pokok->TooltipValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->LinkCustomAttributes = "";
			$this->Angsuran_Bunga->HrefValue = "";
			$this->Angsuran_Bunga->TooltipValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->LinkCustomAttributes = "";
			$this->Angsuran_Total->HrefValue = "";
			$this->Angsuran_Total->TooltipValue = "";

			// Sisa_Hutang
			$this->Sisa_Hutang->LinkCustomAttributes = "";
			$this->Sisa_Hutang->HrefValue = "";
			$this->Sisa_Hutang->TooltipValue = "";

			// Tanggal_Bayar
			$this->Tanggal_Bayar->LinkCustomAttributes = "";
			$this->Tanggal_Bayar->HrefValue = "";

			// Terlambat
			$this->Terlambat->LinkCustomAttributes = "";
			$this->Terlambat->HrefValue = "";

			// Total_Denda
			$this->Total_Denda->LinkCustomAttributes = "";
			$this->Total_Denda->HrefValue = "";

			// Bayar_Titipan
			$this->Bayar_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Titipan->HrefValue = "";

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Non_Titipan->HrefValue = "";

			// Bayar_Total
			$this->Bayar_Total->LinkCustomAttributes = "";
			$this->Bayar_Total->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
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
		if (!ew_CheckEuroDate($this->Tanggal_Bayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal_Bayar->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Terlambat->FormValue)) {
			ew_AddMessage($gsFormError, $this->Terlambat->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Total_Denda->FormValue)) {
			ew_AddMessage($gsFormError, $this->Total_Denda->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Titipan->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Titipan->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Non_Titipan->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Non_Titipan->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Total->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Total->FldErrMsg());
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

			// Tanggal_Bayar
			$this->Tanggal_Bayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal_Bayar->CurrentValue, 7), NULL, $this->Tanggal_Bayar->ReadOnly);

			// Terlambat
			$this->Terlambat->SetDbValueDef($rsnew, $this->Terlambat->CurrentValue, NULL, $this->Terlambat->ReadOnly);

			// Total_Denda
			$this->Total_Denda->SetDbValueDef($rsnew, $this->Total_Denda->CurrentValue, NULL, $this->Total_Denda->ReadOnly);

			// Bayar_Titipan
			$this->Bayar_Titipan->SetDbValueDef($rsnew, $this->Bayar_Titipan->CurrentValue, NULL, $this->Bayar_Titipan->ReadOnly);

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->SetDbValueDef($rsnew, $this->Bayar_Non_Titipan->CurrentValue, NULL, $this->Bayar_Non_Titipan->ReadOnly);

			// Bayar_Total
			$this->Bayar_Total->SetDbValueDef($rsnew, $this->Bayar_Total->CurrentValue, NULL, $this->Bayar_Total->ReadOnly);

			// Keterangan
			$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, $this->Keterangan->ReadOnly);

			// Check referential integrity for master table 't03_pinjaman'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_t03_pinjaman();
			$KeyValue = isset($rsnew['pinjaman_id']) ? $rsnew['pinjaman_id'] : $rsold['pinjaman_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["t03_pinjaman"])) $GLOBALS["t03_pinjaman"] = new ct03_pinjaman();
				$rsmaster = $GLOBALS["t03_pinjaman"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "t03_pinjaman", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

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

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->pinjaman_id->setQueryStringValue($GLOBALS["t03_pinjaman"]->id->QueryStringValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setFormValue($_POST["fk_id"]);
					$this->pinjaman_id->setFormValue($GLOBALS["t03_pinjaman"]->id->FormValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->FormValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t03_pinjaman") {
				if ($this->pinjaman_id->CurrentValue == "") $this->pinjaman_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t04_pinjamanangsurantemplist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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

		$q = "
			select
				a.*,
				b.Nama
			from
				t03_pinjaman a
				join t01_nasabah b on a.nasabah_id = b.id
			where
				a.id = ".$_SESSION["pinjaman_id"]."";
		$r = Conn()->Execute($q);

		// detail jaminan
		$ajaminans = explode(",", $r->fields["jaminan_id"]);
		$jaminan = "";
		foreach ($ajaminans as $ajaminan) {
			$jaminan .= ew_ExecuteScalar("select Merk_Type from t02_jaminan where id = ".$ajaminan."") . ", ";
		}
		$jaminan = substr($jaminan, 0, -2);
		echo "
			<table class=\"table table-bordered table-striped ewViewTable\">
				<tbody>
				<tr>
					<td>No. Kontrak</td><td>".$r->fields["Kontrak_No"]."</td>
				</tr>
				<tr>
					<td>Tgl. Kontrak</td><td>".date("d-m-Y", strtotime($r->fields["Kontrak_Tgl"]))."</td>
				</tr>
				<tr>
					<td>Nasabah</td><td>".$r->fields["Nama"]."</td>
				</tr>
				<tr>
					<td>Jaminan</td><td>".$jaminan."</td>
				</tr>
				<tr>
					<td>Pinjaman</td><td>".number_format($r->fields["Pinjaman"], 2, ".", ",")."</td>
				</tr>
				<tr>
					<td>Angsuran (Bln)</td><td>".$r->fields["Angsuran_Lama"]."</td>
				</tr>
				<tr>
					<td>Bunga (%)</td><td>".$r->fields["Angsuran_Bunga_Prosen"]."</td>
				</tr>
				<tr>
					<td>Denda (%)</td><td>".$r->fields["Angsuran_Denda"]."</td>
				</tr>
				<tr>
					<td>Dispensasi (Hari)</td><td>".$r->fields["Dispensasi_Denda"]."</td>
				</tr>
				<tr>
					<td>No. Ref.</td><td>".$r->fields["No_Ref"]."</td>
				</tr>
				<tr>
					<td>Biaya Administrasi</td><td>".number_format($r->fields["Biaya_Administrasi"], 2, ".", ",")."</td>
				</tr>
				<tr>
					<td>Biaya Materai</td><td>".number_format($r->fields["Biaya_Materai"], 2, ".", ",")."</td>
				</tr>
				<tr>
					<td>Marketing</td><td>".ew_ExecuteScalar("select Nama from t07_marketing where id = ".$r->fields["marketing_id"])."</td>
				</tr>
				</tbody>
			</table>
		";
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
if (!isset($t04_pinjamanangsurantemp_edit)) $t04_pinjamanangsurantemp_edit = new ct04_pinjamanangsurantemp_edit();

// Page init
$t04_pinjamanangsurantemp_edit->Page_Init();

// Page main
$t04_pinjamanangsurantemp_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_pinjamanangsurantemp_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft04_pinjamanangsurantempedit = new ew_Form("ft04_pinjamanangsurantempedit", "edit");

// Validate form
ft04_pinjamanangsurantempedit.Validate = function() {
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
ft04_pinjamanangsurantempedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	$('#x_Total_Denda').val($('#x_Total_Denda').autoNumeric('get'));
 	$('#x_Bayar_Titipan').val($('#x_Bayar_Titipan').autoNumeric('get'));
 	$('#x_Bayar_Non_Titipan').val($('#x_Bayar_Non_Titipan').autoNumeric('get'));
 	$('#x_Bayar_Total').val($('#x_Bayar_Total').autoNumeric('get'));
 	eval('var '+$('#x_Bayar_Total').autoNumeric('getString'));
 	eval('var '+$('#x_Angsuran_Total').autoNumeric('getString'));
 	if (x_Bayar_Total < x_Angsuran_Total) {
 		alert("Jumlah Pembayaran Total tidak boleh kurang dari Jumlah Angsuran");
 		$('#x_Total_Denda').val($('#x_Total_Denda').autoNumeric('get'));
 		$('#x_Bayar_Titipan').val($('#x_Bayar_Titipan').autoNumeric('get'));
 		$('#x_Bayar_Non_Titipan').val($('#x_Bayar_Non_Titipan').autoNumeric('get'));
 		$('#x_Bayar_Total').val($('#x_Bayar_Total').autoNumeric('get'));
 		return false;
 	}
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_pinjamanangsurantempedit.ValidateRequired = true;
<?php } else { ?>
ft04_pinjamanangsurantempedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t04_pinjamanangsurantemp_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t04_pinjamanangsurantemp_edit->ShowPageHeader(); ?>
<?php
$t04_pinjamanangsurantemp_edit->ShowMessage();
?>
<form name="ft04_pinjamanangsurantempedit" id="ft04_pinjamanangsurantempedit" class="<?php echo $t04_pinjamanangsurantemp_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t04_pinjamanangsurantemp_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t04_pinjamanangsurantemp_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t04_pinjamanangsurantemp">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t04_pinjamanangsurantemp_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->getCurrentMasterTable() == "t03_pinjaman") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_pinjaman">
<input type="hidden" name="fk_id" value="<?php echo $t04_pinjamanangsurantemp->pinjaman_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
	<div id="r_Angsuran_Ke" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Angsuran_Ke" for="x_Angsuran_Ke" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Angsuran_Ke">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Ke" name="x_Angsuran_Ke" id="x_Angsuran_Ke" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Ke->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
	<div id="r_Angsuran_Tanggal" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Angsuran_Tanggal" for="x_Angsuran_Tanggal" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Angsuran_Tanggal">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Tanggal" name="x_Angsuran_Tanggal" id="x_Angsuran_Tanggal" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Tanggal->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<div id="r_Angsuran_Pokok" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Angsuran_Pokok" for="x_Angsuran_Pokok" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Angsuran_Pokok">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Pokok" name="x_Angsuran_Pokok" id="x_Angsuran_Pokok" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Pokok->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<div id="r_Angsuran_Bunga" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Angsuran_Bunga" for="x_Angsuran_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Angsuran_Bunga">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Bunga" name="x_Angsuran_Bunga" id="x_Angsuran_Bunga" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Bunga->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<div id="r_Angsuran_Total" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Angsuran_Total" for="x_Angsuran_Total" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Angsuran_Total">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Angsuran_Total" name="x_Angsuran_Total" id="x_Angsuran_Total" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Angsuran_Total->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
	<div id="r_Sisa_Hutang" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Sisa_Hutang" for="x_Sisa_Hutang" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Sisa_Hutang">
<span<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_Sisa_Hutang" name="x_Sisa_Hutang" id="x_Sisa_Hutang" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Sisa_Hutang->CurrentValue) ?>">
<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
	<div id="r_Tanggal_Bayar" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Tanggal_Bayar" for="x_Tanggal_Bayar" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Tanggal_Bayar">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Tanggal_Bayar" data-format="7" name="x_Tanggal_Bayar" id="x_Tanggal_Bayar" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Tanggal_Bayar->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttributes() ?>>
<?php if (!$t04_pinjamanangsurantemp->Tanggal_Bayar->ReadOnly && !$t04_pinjamanangsurantemp->Tanggal_Bayar->Disabled && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["readonly"]) && !isset($t04_pinjamanangsurantemp->Tanggal_Bayar->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft04_pinjamanangsurantempedit", "x_Tanggal_Bayar", 7);
</script>
<?php } ?>
</span>
<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
	<div id="r_Terlambat" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Terlambat" for="x_Terlambat" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Terlambat->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Terlambat->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Terlambat">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Terlambat" name="x_Terlambat" id="x_Terlambat" size="5" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Terlambat->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Terlambat->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Terlambat->EditAttributes() ?>>
</span>
<?php echo $t04_pinjamanangsurantemp->Terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
	<div id="r_Total_Denda" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Total_Denda" for="x_Total_Denda" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Total_Denda->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Total_Denda->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Total_Denda">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Total_Denda" name="x_Total_Denda" id="x_Total_Denda" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Total_Denda->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Total_Denda->EditAttributes() ?>>
</span>
<?php echo $t04_pinjamanangsurantemp->Total_Denda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
	<div id="r_Bayar_Titipan" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Bayar_Titipan" for="x_Bayar_Titipan" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Bayar_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Titipan" name="x_Bayar_Titipan" id="x_Bayar_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->EditAttributes() ?>>
</span>
<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
	<div id="r_Bayar_Non_Titipan" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Bayar_Non_Titipan" for="x_Bayar_Non_Titipan" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Non_Titipan" name="x_Bayar_Non_Titipan" id="x_Bayar_Non_Titipan" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->EditAttributes() ?>>
</span>
<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
	<div id="r_Bayar_Total" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Bayar_Total" for="x_Bayar_Total" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Bayar_Total->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Bayar_Total">
<input type="text" data-table="t04_pinjamanangsurantemp" data-field="x_Bayar_Total" name="x_Bayar_Total" id="x_Bayar_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Bayar_Total->getPlaceHolder()) ?>" value="<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditValue ?>"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->EditAttributes() ?>>
</span>
<?php echo $t04_pinjamanangsurantemp->Bayar_Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t04_pinjamanangsurantemp_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t04_pinjamanangsurantemp->Keterangan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_pinjamanangsurantemp->Keterangan->CellAttributes() ?>>
<span id="el_t04_pinjamanangsurantemp_Keterangan">
<textarea data-table="t04_pinjamanangsurantemp" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="2" placeholder="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->Keterangan->getPlaceHolder()) ?>"<?php echo $t04_pinjamanangsurantemp->Keterangan->EditAttributes() ?>><?php echo $t04_pinjamanangsurantemp->Keterangan->EditValue ?></textarea>
</span>
<?php echo $t04_pinjamanangsurantemp->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t04_pinjamanangsurantemp" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t04_pinjamanangsurantemp->id->CurrentValue) ?>">
<?php if (!$t04_pinjamanangsurantemp_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t04_pinjamanangsurantemp_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft04_pinjamanangsurantempedit.Init();
</script>
<?php
$t04_pinjamanangsurantemp_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");
// tampilkan TANGGAL HARI INI di field TANGGAL BAYAR
//$("#x_Tanggal_Bayar").val("<?php echo date('d-m-Y');?>");

$(document).ready(function() {
	$('#x_Total_Denda').autoNumeric('init');
	$('#x_Bayar_Titipan').autoNumeric('init');
	$('#x_Bayar_Non_Titipan').autoNumeric('init');
	$('#x_Bayar_Total').autoNumeric('init');
});
</script>
<?php include_once "footer.php" ?>
<?php
$t04_pinjamanangsurantemp_edit->Page_Terminate();
?>
