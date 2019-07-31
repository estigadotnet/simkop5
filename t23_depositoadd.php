<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t23_depositoinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t24_deposito_detailgridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t23_deposito_add = NULL; // Initialize page object first

class ct23_deposito_add extends ct23_deposito {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't23_deposito';

	// Page object name
	var $PageObjName = 't23_deposito_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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

		// Create form object
		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Process auto fill for detail table 't24_deposito_detail'
			if (@$_POST["grid"] == "ft24_deposito_detailgrid") {
				if (!isset($GLOBALS["t24_deposito_detail_grid"])) $GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid;
				$GLOBALS["t24_deposito_detail_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

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

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t23_depositolist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "t24_deposito_detaillist.php?showmaster=t23_deposito&fk_id=".urlencode($this->id->CurrentValue);
					if (ew_GetPageName($sReturnUrl) == "t23_depositolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t23_depositoview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetUpDetailParms();
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->Kontrak_No->CurrentValue = NULL;
		$this->Kontrak_No->OldValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_Tgl->CurrentValue = NULL;
		$this->Kontrak_Tgl->OldValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Lama->CurrentValue = NULL;
		$this->Kontrak_Lama->OldValue = $this->Kontrak_Lama->CurrentValue;
		$this->Jatuh_Tempo_Tgl->CurrentValue = NULL;
		$this->Jatuh_Tempo_Tgl->OldValue = $this->Jatuh_Tempo_Tgl->CurrentValue;
		$this->Deposito->CurrentValue = NULL;
		$this->Deposito->OldValue = $this->Deposito->CurrentValue;
		$this->Bunga_Suku->CurrentValue = 12.00;
		$this->Bunga->CurrentValue = NULL;
		$this->Bunga->OldValue = $this->Bunga->CurrentValue;
		$this->nasabah_id->CurrentValue = NULL;
		$this->nasabah_id->OldValue = $this->nasabah_id->CurrentValue;
		$this->bank_id->CurrentValue = NULL;
		$this->bank_id->OldValue = $this->bank_id->CurrentValue;
		$this->No_Ref->CurrentValue = NULL;
		$this->No_Ref->OldValue = $this->No_Ref->CurrentValue;
		$this->Biaya_Administrasi->CurrentValue = 0.00;
		$this->Biaya_Materai->CurrentValue = 0.00;
		$this->Kontrak_Status->CurrentValue = "Ya";
		$this->Jatuh_Tempo_Status->CurrentValue = "Diperpanjang";
		$this->Bunga_Status->CurrentValue = "Transfer";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Kontrak_No->FldIsDetailKey) {
			$this->Kontrak_No->setFormValue($objForm->GetValue("x_Kontrak_No"));
		}
		if (!$this->Kontrak_Tgl->FldIsDetailKey) {
			$this->Kontrak_Tgl->setFormValue($objForm->GetValue("x_Kontrak_Tgl"));
			$this->Kontrak_Tgl->CurrentValue = ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7);
		}
		if (!$this->Kontrak_Lama->FldIsDetailKey) {
			$this->Kontrak_Lama->setFormValue($objForm->GetValue("x_Kontrak_Lama"));
		}
		if (!$this->Jatuh_Tempo_Tgl->FldIsDetailKey) {
			$this->Jatuh_Tempo_Tgl->setFormValue($objForm->GetValue("x_Jatuh_Tempo_Tgl"));
			$this->Jatuh_Tempo_Tgl->CurrentValue = ew_UnFormatDateTime($this->Jatuh_Tempo_Tgl->CurrentValue, 7);
		}
		if (!$this->Deposito->FldIsDetailKey) {
			$this->Deposito->setFormValue($objForm->GetValue("x_Deposito"));
		}
		if (!$this->Bunga_Suku->FldIsDetailKey) {
			$this->Bunga_Suku->setFormValue($objForm->GetValue("x_Bunga_Suku"));
		}
		if (!$this->Bunga->FldIsDetailKey) {
			$this->Bunga->setFormValue($objForm->GetValue("x_Bunga"));
		}
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->bank_id->FldIsDetailKey) {
			$this->bank_id->setFormValue($objForm->GetValue("x_bank_id"));
		}
		if (!$this->No_Ref->FldIsDetailKey) {
			$this->No_Ref->setFormValue($objForm->GetValue("x_No_Ref"));
		}
		if (!$this->Biaya_Administrasi->FldIsDetailKey) {
			$this->Biaya_Administrasi->setFormValue($objForm->GetValue("x_Biaya_Administrasi"));
		}
		if (!$this->Biaya_Materai->FldIsDetailKey) {
			$this->Biaya_Materai->setFormValue($objForm->GetValue("x_Biaya_Materai"));
		}
		if (!$this->Kontrak_Status->FldIsDetailKey) {
			$this->Kontrak_Status->setFormValue($objForm->GetValue("x_Kontrak_Status"));
		}
		if (!$this->Jatuh_Tempo_Status->FldIsDetailKey) {
			$this->Jatuh_Tempo_Status->setFormValue($objForm->GetValue("x_Jatuh_Tempo_Status"));
		}
		if (!$this->Bunga_Status->FldIsDetailKey) {
			$this->Bunga_Status->setFormValue($objForm->GetValue("x_Bunga_Status"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->Kontrak_No->CurrentValue = $this->Kontrak_No->FormValue;
		$this->Kontrak_Tgl->CurrentValue = $this->Kontrak_Tgl->FormValue;
		$this->Kontrak_Tgl->CurrentValue = ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7);
		$this->Kontrak_Lama->CurrentValue = $this->Kontrak_Lama->FormValue;
		$this->Jatuh_Tempo_Tgl->CurrentValue = $this->Jatuh_Tempo_Tgl->FormValue;
		$this->Jatuh_Tempo_Tgl->CurrentValue = ew_UnFormatDateTime($this->Jatuh_Tempo_Tgl->CurrentValue, 7);
		$this->Deposito->CurrentValue = $this->Deposito->FormValue;
		$this->Bunga_Suku->CurrentValue = $this->Bunga_Suku->FormValue;
		$this->Bunga->CurrentValue = $this->Bunga->FormValue;
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
		$this->bank_id->CurrentValue = $this->bank_id->FormValue;
		$this->No_Ref->CurrentValue = $this->No_Ref->FormValue;
		$this->Biaya_Administrasi->CurrentValue = $this->Biaya_Administrasi->FormValue;
		$this->Biaya_Materai->CurrentValue = $this->Biaya_Materai->FormValue;
		$this->Kontrak_Status->CurrentValue = $this->Kontrak_Status->FormValue;
		$this->Jatuh_Tempo_Status->CurrentValue = $this->Jatuh_Tempo_Status->FormValue;
		$this->Bunga_Status->CurrentValue = $this->Bunga_Status->FormValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Kontrak_No
			$this->Kontrak_No->EditAttrs["class"] = "form-control";
			$this->Kontrak_No->EditCustomAttributes = "";
			$this->Kontrak_No->EditValue = ew_HtmlEncode($this->Kontrak_No->CurrentValue);
			$this->Kontrak_No->PlaceHolder = ew_RemoveHtml($this->Kontrak_No->FldCaption());

			// Kontrak_Tgl
			$this->Kontrak_Tgl->EditAttrs["class"] = "form-control";
			$this->Kontrak_Tgl->EditCustomAttributes = "style='width: 115px;'";
			$this->Kontrak_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Kontrak_Tgl->CurrentValue, 7));
			$this->Kontrak_Tgl->PlaceHolder = ew_RemoveHtml($this->Kontrak_Tgl->FldCaption());

			// Kontrak_Lama
			$this->Kontrak_Lama->EditAttrs["class"] = "form-control";
			$this->Kontrak_Lama->EditCustomAttributes = "";
			$this->Kontrak_Lama->EditValue = ew_HtmlEncode($this->Kontrak_Lama->CurrentValue);
			$this->Kontrak_Lama->PlaceHolder = ew_RemoveHtml($this->Kontrak_Lama->FldCaption());

			// Jatuh_Tempo_Tgl
			$this->Jatuh_Tempo_Tgl->EditAttrs["class"] = "form-control";
			$this->Jatuh_Tempo_Tgl->EditCustomAttributes = "style='width: 115px;'";
			$this->Jatuh_Tempo_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Jatuh_Tempo_Tgl->CurrentValue, 7));
			$this->Jatuh_Tempo_Tgl->PlaceHolder = ew_RemoveHtml($this->Jatuh_Tempo_Tgl->FldCaption());

			// Deposito
			$this->Deposito->EditAttrs["class"] = "form-control";
			$this->Deposito->EditCustomAttributes = "";
			$this->Deposito->EditValue = ew_HtmlEncode($this->Deposito->CurrentValue);
			$this->Deposito->PlaceHolder = ew_RemoveHtml($this->Deposito->FldCaption());
			if (strval($this->Deposito->EditValue) <> "" && is_numeric($this->Deposito->EditValue)) $this->Deposito->EditValue = ew_FormatNumber($this->Deposito->EditValue, -2, -2, -2, -2);

			// Bunga_Suku
			$this->Bunga_Suku->EditAttrs["class"] = "form-control";
			$this->Bunga_Suku->EditCustomAttributes = "";
			$this->Bunga_Suku->EditValue = ew_HtmlEncode($this->Bunga_Suku->CurrentValue);
			$this->Bunga_Suku->PlaceHolder = ew_RemoveHtml($this->Bunga_Suku->FldCaption());
			if (strval($this->Bunga_Suku->EditValue) <> "" && is_numeric($this->Bunga_Suku->EditValue)) $this->Bunga_Suku->EditValue = ew_FormatNumber($this->Bunga_Suku->EditValue, -2, -2, -2, -2);

			// Bunga
			$this->Bunga->EditAttrs["class"] = "form-control";
			$this->Bunga->EditCustomAttributes = "";
			$this->Bunga->EditValue = ew_HtmlEncode($this->Bunga->CurrentValue);
			$this->Bunga->PlaceHolder = ew_RemoveHtml($this->Bunga->FldCaption());
			if (strval($this->Bunga->EditValue) <> "" && is_numeric($this->Bunga->EditValue)) $this->Bunga->EditValue = ew_FormatNumber($this->Bunga->EditValue, -2, -2, -2, -2);

			// nasabah_id
			$this->nasabah_id->EditCustomAttributes = "";
			if (trim(strval($this->nasabah_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t22_peserta`";
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

			// No_Ref
			$this->No_Ref->EditAttrs["class"] = "form-control";
			$this->No_Ref->EditCustomAttributes = "";
			$this->No_Ref->EditValue = ew_HtmlEncode($this->No_Ref->CurrentValue);
			$this->No_Ref->PlaceHolder = ew_RemoveHtml($this->No_Ref->FldCaption());

			// Biaya_Administrasi
			$this->Biaya_Administrasi->EditAttrs["class"] = "form-control";
			$this->Biaya_Administrasi->EditCustomAttributes = "";
			$this->Biaya_Administrasi->EditValue = ew_HtmlEncode($this->Biaya_Administrasi->CurrentValue);
			$this->Biaya_Administrasi->PlaceHolder = ew_RemoveHtml($this->Biaya_Administrasi->FldCaption());
			if (strval($this->Biaya_Administrasi->EditValue) <> "" && is_numeric($this->Biaya_Administrasi->EditValue)) $this->Biaya_Administrasi->EditValue = ew_FormatNumber($this->Biaya_Administrasi->EditValue, -2, -2, -2, -2);

			// Biaya_Materai
			$this->Biaya_Materai->EditAttrs["class"] = "form-control";
			$this->Biaya_Materai->EditCustomAttributes = "";
			$this->Biaya_Materai->EditValue = ew_HtmlEncode($this->Biaya_Materai->CurrentValue);
			$this->Biaya_Materai->PlaceHolder = ew_RemoveHtml($this->Biaya_Materai->FldCaption());
			if (strval($this->Biaya_Materai->EditValue) <> "" && is_numeric($this->Biaya_Materai->EditValue)) $this->Biaya_Materai->EditValue = ew_FormatNumber($this->Biaya_Materai->EditValue, -2, -2, -2, -2);

			// Kontrak_Status
			$this->Kontrak_Status->EditCustomAttributes = "";
			$this->Kontrak_Status->EditValue = $this->Kontrak_Status->Options(FALSE);

			// Jatuh_Tempo_Status
			$this->Jatuh_Tempo_Status->EditCustomAttributes = "";
			$this->Jatuh_Tempo_Status->EditValue = $this->Jatuh_Tempo_Status->Options(FALSE);

			// Bunga_Status
			$this->Bunga_Status->EditCustomAttributes = "";
			$this->Bunga_Status->EditValue = $this->Bunga_Status->Options(FALSE);

			// Add refer script
			// Kontrak_No

			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";

			// Kontrak_Lama
			$this->Kontrak_Lama->LinkCustomAttributes = "";
			$this->Kontrak_Lama->HrefValue = "";

			// Jatuh_Tempo_Tgl
			$this->Jatuh_Tempo_Tgl->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Tgl->HrefValue = "";

			// Deposito
			$this->Deposito->LinkCustomAttributes = "";
			$this->Deposito->HrefValue = "";

			// Bunga_Suku
			$this->Bunga_Suku->LinkCustomAttributes = "";
			$this->Bunga_Suku->HrefValue = "";

			// Bunga
			$this->Bunga->LinkCustomAttributes = "";
			$this->Bunga->HrefValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";

			// bank_id
			$this->bank_id->LinkCustomAttributes = "";
			$this->bank_id->HrefValue = "";

			// No_Ref
			$this->No_Ref->LinkCustomAttributes = "";
			$this->No_Ref->HrefValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->LinkCustomAttributes = "";
			$this->Biaya_Administrasi->HrefValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->LinkCustomAttributes = "";
			$this->Biaya_Materai->HrefValue = "";

			// Kontrak_Status
			$this->Kontrak_Status->LinkCustomAttributes = "";
			$this->Kontrak_Status->HrefValue = "";

			// Jatuh_Tempo_Status
			$this->Jatuh_Tempo_Status->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Status->HrefValue = "";

			// Bunga_Status
			$this->Bunga_Status->LinkCustomAttributes = "";
			$this->Bunga_Status->HrefValue = "";
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
		if (!$this->Kontrak_No->FldIsDetailKey && !is_null($this->Kontrak_No->FormValue) && $this->Kontrak_No->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_No->FldCaption(), $this->Kontrak_No->ReqErrMsg));
		}
		if (!$this->Kontrak_Tgl->FldIsDetailKey && !is_null($this->Kontrak_Tgl->FormValue) && $this->Kontrak_Tgl->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_Tgl->FldCaption(), $this->Kontrak_Tgl->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Kontrak_Tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->Kontrak_Tgl->FldErrMsg());
		}
		if (!$this->Kontrak_Lama->FldIsDetailKey && !is_null($this->Kontrak_Lama->FormValue) && $this->Kontrak_Lama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_Lama->FldCaption(), $this->Kontrak_Lama->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Kontrak_Lama->FormValue)) {
			ew_AddMessage($gsFormError, $this->Kontrak_Lama->FldErrMsg());
		}
		if (!$this->Jatuh_Tempo_Tgl->FldIsDetailKey && !is_null($this->Jatuh_Tempo_Tgl->FormValue) && $this->Jatuh_Tempo_Tgl->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Jatuh_Tempo_Tgl->FldCaption(), $this->Jatuh_Tempo_Tgl->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Jatuh_Tempo_Tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->Jatuh_Tempo_Tgl->FldErrMsg());
		}
		if (!$this->Deposito->FldIsDetailKey && !is_null($this->Deposito->FormValue) && $this->Deposito->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Deposito->FldCaption(), $this->Deposito->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Deposito->FormValue)) {
			ew_AddMessage($gsFormError, $this->Deposito->FldErrMsg());
		}
		if (!$this->Bunga_Suku->FldIsDetailKey && !is_null($this->Bunga_Suku->FormValue) && $this->Bunga_Suku->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bunga_Suku->FldCaption(), $this->Bunga_Suku->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Bunga_Suku->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bunga_Suku->FldErrMsg());
		}
		if (!$this->Bunga->FldIsDetailKey && !is_null($this->Bunga->FormValue) && $this->Bunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bunga->FldCaption(), $this->Bunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Bunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bunga->FldErrMsg());
		}
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if (!$this->Biaya_Administrasi->FldIsDetailKey && !is_null($this->Biaya_Administrasi->FormValue) && $this->Biaya_Administrasi->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Biaya_Administrasi->FldCaption(), $this->Biaya_Administrasi->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Biaya_Administrasi->FormValue)) {
			ew_AddMessage($gsFormError, $this->Biaya_Administrasi->FldErrMsg());
		}
		if (!$this->Biaya_Materai->FldIsDetailKey && !is_null($this->Biaya_Materai->FormValue) && $this->Biaya_Materai->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Biaya_Materai->FldCaption(), $this->Biaya_Materai->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Biaya_Materai->FormValue)) {
			ew_AddMessage($gsFormError, $this->Biaya_Materai->FldErrMsg());
		}
		if ($this->Kontrak_Status->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_Status->FldCaption(), $this->Kontrak_Status->ReqErrMsg));
		}
		if ($this->Jatuh_Tempo_Status->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Jatuh_Tempo_Status->FldCaption(), $this->Jatuh_Tempo_Status->ReqErrMsg));
		}
		if ($this->Bunga_Status->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bunga_Status->FldCaption(), $this->Bunga_Status->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t24_deposito_detail", $DetailTblVar) && $GLOBALS["t24_deposito_detail"]->DetailAdd) {
			if (!isset($GLOBALS["t24_deposito_detail_grid"])) $GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid(); // get detail page object
			$GLOBALS["t24_deposito_detail_grid"]->ValidateGridForm();
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// Kontrak_No
		$this->Kontrak_No->SetDbValueDef($rsnew, $this->Kontrak_No->CurrentValue, "", FALSE);

		// Kontrak_Tgl
		$this->Kontrak_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// Kontrak_Lama
		$this->Kontrak_Lama->SetDbValueDef($rsnew, $this->Kontrak_Lama->CurrentValue, 0, FALSE);

		// Jatuh_Tempo_Tgl
		$this->Jatuh_Tempo_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Jatuh_Tempo_Tgl->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// Deposito
		$this->Deposito->SetDbValueDef($rsnew, $this->Deposito->CurrentValue, 0, FALSE);

		// Bunga_Suku
		$this->Bunga_Suku->SetDbValueDef($rsnew, $this->Bunga_Suku->CurrentValue, 0, strval($this->Bunga_Suku->CurrentValue) == "");

		// Bunga
		$this->Bunga->SetDbValueDef($rsnew, $this->Bunga->CurrentValue, 0, FALSE);

		// nasabah_id
		$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, FALSE);

		// bank_id
		$this->bank_id->SetDbValueDef($rsnew, $this->bank_id->CurrentValue, NULL, FALSE);

		// No_Ref
		$this->No_Ref->SetDbValueDef($rsnew, $this->No_Ref->CurrentValue, NULL, FALSE);

		// Biaya_Administrasi
		$this->Biaya_Administrasi->SetDbValueDef($rsnew, $this->Biaya_Administrasi->CurrentValue, 0, strval($this->Biaya_Administrasi->CurrentValue) == "");

		// Biaya_Materai
		$this->Biaya_Materai->SetDbValueDef($rsnew, $this->Biaya_Materai->CurrentValue, 0, strval($this->Biaya_Materai->CurrentValue) == "");

		// Kontrak_Status
		$this->Kontrak_Status->SetDbValueDef($rsnew, $this->Kontrak_Status->CurrentValue, "", strval($this->Kontrak_Status->CurrentValue) == "");

		// Jatuh_Tempo_Status
		$this->Jatuh_Tempo_Status->SetDbValueDef($rsnew, $this->Jatuh_Tempo_Status->CurrentValue, "", strval($this->Jatuh_Tempo_Status->CurrentValue) == "");

		// Bunga_Status
		$this->Bunga_Status->SetDbValueDef($rsnew, $this->Bunga_Status->CurrentValue, "", strval($this->Bunga_Status->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("t24_deposito_detail", $DetailTblVar) && $GLOBALS["t24_deposito_detail"]->DetailAdd) {
				$GLOBALS["t24_deposito_detail"]->deposito_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t24_deposito_detail_grid"])) $GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "t24_deposito_detail"); // Load user level of detail table
				$AddRow = $GLOBALS["t24_deposito_detail_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["t24_deposito_detail"]->deposito_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t24_deposito_detail", $DetailTblVar)) {
				if (!isset($GLOBALS["t24_deposito_detail_grid"]))
					$GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid;
				if ($GLOBALS["t24_deposito_detail_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t24_deposito_detail_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t24_deposito_detail_grid"]->CurrentMode = "add";
					$GLOBALS["t24_deposito_detail_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t24_deposito_detail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t24_deposito_detail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->FldIsDetailKey = TRUE;
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->setSessionValue($GLOBALS["t24_deposito_detail_grid"]->deposito_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t23_depositolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t22_peserta`";
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
		$_SESSION["deposito_id"] = 0;
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
if (!isset($t23_deposito_add)) $t23_deposito_add = new ct23_deposito_add();

// Page init
$t23_deposito_add->Page_Init();

// Page main
$t23_deposito_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t23_deposito_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft23_depositoadd = new ew_Form("ft23_depositoadd", "add");

// Validate form
ft23_depositoadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Kontrak_No");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Kontrak_No->FldCaption(), $t23_deposito->Kontrak_No->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Kontrak_Tgl->FldCaption(), $t23_deposito->Kontrak_Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Kontrak_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Lama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Kontrak_Lama->FldCaption(), $t23_deposito->Kontrak_Lama->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Lama");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Kontrak_Lama->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Jatuh_Tempo_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Jatuh_Tempo_Tgl->FldCaption(), $t23_deposito->Jatuh_Tempo_Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jatuh_Tempo_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Jatuh_Tempo_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Deposito");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Deposito->FldCaption(), $t23_deposito->Deposito->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Deposito");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Deposito->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bunga_Suku");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Bunga_Suku->FldCaption(), $t23_deposito->Bunga_Suku->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bunga_Suku");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Bunga_Suku->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Bunga->FldCaption(), $t23_deposito->Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Bunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->nasabah_id->FldCaption(), $t23_deposito->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Administrasi");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Biaya_Administrasi->FldCaption(), $t23_deposito->Biaya_Administrasi->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Administrasi");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Biaya_Administrasi->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Materai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Biaya_Materai->FldCaption(), $t23_deposito->Biaya_Materai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Materai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t23_deposito->Biaya_Materai->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Status");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Kontrak_Status->FldCaption(), $t23_deposito->Kontrak_Status->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jatuh_Tempo_Status");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Jatuh_Tempo_Status->FldCaption(), $t23_deposito->Jatuh_Tempo_Status->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bunga_Status");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t23_deposito->Bunga_Status->FldCaption(), $t23_deposito->Bunga_Status->ReqErrMsg)) ?>");

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
ft23_depositoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft23_depositoadd.ValidateRequired = true;
<?php } else { ?>
ft23_depositoadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft23_depositoadd.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t22_peserta"};
ft23_depositoadd.Lists["x_bank_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor","x_Pemilik","x_Bank",""],"ParentFields":["x_nasabah_id"],"ChildFields":[],"FilterFields":["x_nasabah_id"],"Options":[],"Template":"","LinkTable":"t21_bank"};
ft23_depositoadd.Lists["x_Kontrak_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoadd.Lists["x_Kontrak_Status"].Options = <?php echo json_encode($t23_deposito->Kontrak_Status->Options()) ?>;
ft23_depositoadd.Lists["x_Jatuh_Tempo_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoadd.Lists["x_Jatuh_Tempo_Status"].Options = <?php echo json_encode($t23_deposito->Jatuh_Tempo_Status->Options()) ?>;
ft23_depositoadd.Lists["x_Bunga_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoadd.Lists["x_Bunga_Status"].Options = <?php echo json_encode($t23_deposito->Bunga_Status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t23_deposito_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t23_deposito_add->ShowPageHeader(); ?>
<?php
$t23_deposito_add->ShowMessage();
?>
<form name="ft23_depositoadd" id="ft23_depositoadd" class="<?php echo $t23_deposito_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t23_deposito_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t23_deposito_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t23_deposito">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t23_deposito_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
	<div id="r_Kontrak_No" class="form-group">
		<label id="elh_t23_deposito_Kontrak_No" for="x_Kontrak_No" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Kontrak_No->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_No">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_No" name="x_Kontrak_No" id="x_Kontrak_No" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_No->EditValue ?>"<?php echo $t23_deposito->Kontrak_No->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Kontrak_No->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<div id="r_Kontrak_Tgl" class="form-group">
		<label id="elh_t23_deposito_Kontrak_Tgl" for="x_Kontrak_Tgl" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Kontrak_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Tgl">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_Tgl" data-format="7" name="x_Kontrak_Tgl" id="x_Kontrak_Tgl" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_Tgl->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_Tgl->EditValue ?>"<?php echo $t23_deposito->Kontrak_Tgl->EditAttributes() ?>>
<?php if (!$t23_deposito->Kontrak_Tgl->ReadOnly && !$t23_deposito->Kontrak_Tgl->Disabled && !isset($t23_deposito->Kontrak_Tgl->EditAttrs["readonly"]) && !isset($t23_deposito->Kontrak_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft23_depositoadd", "x_Kontrak_Tgl", 7);
</script>
<?php } ?>
</span>
<?php echo $t23_deposito->Kontrak_Tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
	<div id="r_Kontrak_Lama" class="form-group">
		<label id="elh_t23_deposito_Kontrak_Lama" for="x_Kontrak_Lama" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Kontrak_Lama->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Lama">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_Lama" name="x_Kontrak_Lama" id="x_Kontrak_Lama" size="5" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_Lama->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_Lama->EditValue ?>"<?php echo $t23_deposito->Kontrak_Lama->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Kontrak_Lama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Tgl->Visible) { // Jatuh_Tempo_Tgl ?>
	<div id="r_Jatuh_Tempo_Tgl" class="form-group">
		<label id="elh_t23_deposito_Jatuh_Tempo_Tgl" for="x_Jatuh_Tempo_Tgl" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Jatuh_Tempo_Tgl->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Jatuh_Tempo_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Tgl">
<input type="text" data-table="t23_deposito" data-field="x_Jatuh_Tempo_Tgl" data-format="7" name="x_Jatuh_Tempo_Tgl" id="x_Jatuh_Tempo_Tgl" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Jatuh_Tempo_Tgl->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Jatuh_Tempo_Tgl->EditValue ?>"<?php echo $t23_deposito->Jatuh_Tempo_Tgl->EditAttributes() ?>>
<?php if (!$t23_deposito->Jatuh_Tempo_Tgl->ReadOnly && !$t23_deposito->Jatuh_Tempo_Tgl->Disabled && !isset($t23_deposito->Jatuh_Tempo_Tgl->EditAttrs["readonly"]) && !isset($t23_deposito->Jatuh_Tempo_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft23_depositoadd", "x_Jatuh_Tempo_Tgl", 7);
</script>
<?php } ?>
</span>
<?php echo $t23_deposito->Jatuh_Tempo_Tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
	<div id="r_Deposito" class="form-group">
		<label id="elh_t23_deposito_Deposito" for="x_Deposito" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Deposito->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Deposito->CellAttributes() ?>>
<span id="el_t23_deposito_Deposito">
<input type="text" data-table="t23_deposito" data-field="x_Deposito" name="x_Deposito" id="x_Deposito" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Deposito->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Deposito->EditValue ?>"<?php echo $t23_deposito->Deposito->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Deposito->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
	<div id="r_Bunga_Suku" class="form-group">
		<label id="elh_t23_deposito_Bunga_Suku" for="x_Bunga_Suku" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Bunga_Suku->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Suku">
<input type="text" data-table="t23_deposito" data-field="x_Bunga_Suku" name="x_Bunga_Suku" id="x_Bunga_Suku" size="5" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Bunga_Suku->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Bunga_Suku->EditValue ?>"<?php echo $t23_deposito->Bunga_Suku->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Bunga_Suku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
	<div id="r_Bunga" class="form-group">
		<label id="elh_t23_deposito_Bunga" for="x_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Bunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Bunga->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga">
<input type="text" data-table="t23_deposito" data-field="x_Bunga" name="x_Bunga" id="x_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Bunga->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Bunga->EditValue ?>"<?php echo $t23_deposito->Bunga->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t23_deposito_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t23_deposito_nasabah_id">
<?php $t23_deposito->nasabah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t23_deposito->nasabah_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_nasabah_id"><?php echo (strval($t23_deposito->nasabah_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t23_deposito->nasabah_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t23_deposito->nasabah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_nasabah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t23_deposito" data-field="x_nasabah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t23_deposito->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x_nasabah_id" id="x_nasabah_id" value="<?php echo $t23_deposito->nasabah_id->CurrentValue ?>"<?php echo $t23_deposito->nasabah_id->EditAttributes() ?>>
<input type="hidden" name="s_x_nasabah_id" id="s_x_nasabah_id" value="<?php echo $t23_deposito->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php echo $t23_deposito->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->bank_id->Visible) { // bank_id ?>
	<div id="r_bank_id" class="form-group">
		<label id="elh_t23_deposito_bank_id" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->bank_id->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->bank_id->CellAttributes() ?>>
<span id="el_t23_deposito_bank_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<?php echo $t23_deposito->bank_id->ViewValue ?>
	</span>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<div id="dsl_x_bank_id" data-repeatcolumn="5" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $t23_deposito->bank_id->CheckBoxListHtml(TRUE, "x_bank_id[]") ?>
		</div>
	</div>
	<div id="tp_x_bank_id" class="ewTemplate"><input type="checkbox" data-table="t23_deposito" data-field="x_bank_id" data-value-separator="<?php echo $t23_deposito->bank_id->DisplayValueSeparatorAttribute() ?>" name="x_bank_id[]" id="x_bank_id[]" value="{value}"<?php echo $t23_deposito->bank_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="s_x_bank_id" id="s_x_bank_id" value="<?php echo $t23_deposito->bank_id->LookupFilterQuery() ?>">
</span>
<?php echo $t23_deposito->bank_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->No_Ref->Visible) { // No_Ref ?>
	<div id="r_No_Ref" class="form-group">
		<label id="elh_t23_deposito_No_Ref" for="x_No_Ref" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->No_Ref->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->No_Ref->CellAttributes() ?>>
<span id="el_t23_deposito_No_Ref">
<input type="text" data-table="t23_deposito" data-field="x_No_Ref" name="x_No_Ref" id="x_No_Ref" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t23_deposito->No_Ref->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->No_Ref->EditValue ?>"<?php echo $t23_deposito->No_Ref->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->No_Ref->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
	<div id="r_Biaya_Administrasi" class="form-group">
		<label id="elh_t23_deposito_Biaya_Administrasi" for="x_Biaya_Administrasi" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Biaya_Administrasi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Biaya_Administrasi->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Administrasi">
<input type="text" data-table="t23_deposito" data-field="x_Biaya_Administrasi" name="x_Biaya_Administrasi" id="x_Biaya_Administrasi" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Biaya_Administrasi->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Biaya_Administrasi->EditValue ?>"<?php echo $t23_deposito->Biaya_Administrasi->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Biaya_Administrasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Biaya_Materai->Visible) { // Biaya_Materai ?>
	<div id="r_Biaya_Materai" class="form-group">
		<label id="elh_t23_deposito_Biaya_Materai" for="x_Biaya_Materai" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Biaya_Materai->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Biaya_Materai->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Materai">
<input type="text" data-table="t23_deposito" data-field="x_Biaya_Materai" name="x_Biaya_Materai" id="x_Biaya_Materai" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Biaya_Materai->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Biaya_Materai->EditValue ?>"<?php echo $t23_deposito->Biaya_Materai->EditAttributes() ?>>
</span>
<?php echo $t23_deposito->Biaya_Materai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Status->Visible) { // Kontrak_Status ?>
	<div id="r_Kontrak_Status" class="form-group">
		<label id="elh_t23_deposito_Kontrak_Status" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Kontrak_Status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Kontrak_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Status">
<div id="tp_x_Kontrak_Status" class="ewTemplate"><input type="radio" data-table="t23_deposito" data-field="x_Kontrak_Status" data-value-separator="<?php echo $t23_deposito->Kontrak_Status->DisplayValueSeparatorAttribute() ?>" name="x_Kontrak_Status" id="x_Kontrak_Status" value="{value}"<?php echo $t23_deposito->Kontrak_Status->EditAttributes() ?>></div>
<div id="dsl_x_Kontrak_Status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t23_deposito->Kontrak_Status->RadioButtonListHtml(FALSE, "x_Kontrak_Status") ?>
</div></div>
</span>
<?php echo $t23_deposito->Kontrak_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Status->Visible) { // Jatuh_Tempo_Status ?>
	<div id="r_Jatuh_Tempo_Status" class="form-group">
		<label id="elh_t23_deposito_Jatuh_Tempo_Status" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Jatuh_Tempo_Status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Jatuh_Tempo_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Status">
<div id="tp_x_Jatuh_Tempo_Status" class="ewTemplate"><input type="radio" data-table="t23_deposito" data-field="x_Jatuh_Tempo_Status" data-value-separator="<?php echo $t23_deposito->Jatuh_Tempo_Status->DisplayValueSeparatorAttribute() ?>" name="x_Jatuh_Tempo_Status" id="x_Jatuh_Tempo_Status" value="{value}"<?php echo $t23_deposito->Jatuh_Tempo_Status->EditAttributes() ?>></div>
<div id="dsl_x_Jatuh_Tempo_Status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t23_deposito->Jatuh_Tempo_Status->RadioButtonListHtml(FALSE, "x_Jatuh_Tempo_Status") ?>
</div></div>
</span>
<?php echo $t23_deposito->Jatuh_Tempo_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t23_deposito->Bunga_Status->Visible) { // Bunga_Status ?>
	<div id="r_Bunga_Status" class="form-group">
		<label id="elh_t23_deposito_Bunga_Status" class="col-sm-2 control-label ewLabel"><?php echo $t23_deposito->Bunga_Status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t23_deposito->Bunga_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Status">
<div id="tp_x_Bunga_Status" class="ewTemplate"><input type="radio" data-table="t23_deposito" data-field="x_Bunga_Status" data-value-separator="<?php echo $t23_deposito->Bunga_Status->DisplayValueSeparatorAttribute() ?>" name="x_Bunga_Status" id="x_Bunga_Status" value="{value}"<?php echo $t23_deposito->Bunga_Status->EditAttributes() ?>></div>
<div id="dsl_x_Bunga_Status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t23_deposito->Bunga_Status->RadioButtonListHtml(FALSE, "x_Bunga_Status") ?>
</div></div>
</span>
<?php echo $t23_deposito->Bunga_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php
	if (in_array("t24_deposito_detail", explode(",", $t23_deposito->getCurrentDetailTable())) && $t24_deposito_detail->DetailAdd) {
?>
<?php if ($t23_deposito->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t24_deposito_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t24_deposito_detailgrid.php" ?>
<?php } ?>
<?php if (!$t23_deposito_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t23_deposito_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft23_depositoadd.Init();
</script>
<?php
$t23_deposito_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");
	// tampilkan TANGGAL HARI INI di field KONTRAK_TGL

	$("#x_Kontrak_Tgl").val("<?php echo date('d-m-Y');?>");

	// tampilkan TANGGAL HARI INI di field Jatuh_Tempo_Tgl
	$("#x_Jatuh_Tempo_Tgl").val("<?php echo date('d-m-Y');?>");
</script>
<?php include_once "footer.php" ?>
<?php
$t23_deposito_add->Page_Terminate();
?>
