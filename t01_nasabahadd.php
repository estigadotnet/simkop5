<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t01_nasabahinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t02_jaminangridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t01_nasabah_add = NULL; // Initialize page object first

class ct01_nasabah_add extends ct01_nasabah {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't01_nasabah';

	// Page object name
	var $PageObjName = 't01_nasabah_add';

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

		// Table object (t01_nasabah)
		if (!isset($GLOBALS["t01_nasabah"]) || get_class($GLOBALS["t01_nasabah"]) == "ct01_nasabah") {
			$GLOBALS["t01_nasabah"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t01_nasabah"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't01_nasabah', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t01_nasabahlist.php"));
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
		$this->Nama->SetVisibility();
		$this->Alamat->SetVisibility();
		$this->No_Telp_Hp->SetVisibility();
		$this->Pekerjaan->SetVisibility();
		$this->Pekerjaan_Alamat->SetVisibility();
		$this->Pekerjaan_No_Telp_Hp->SetVisibility();
		$this->Status->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->marketing_id->SetVisibility();

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

			// Process auto fill for detail table 't02_jaminan'
			if (@$_POST["grid"] == "ft02_jaminangrid") {
				if (!isset($GLOBALS["t02_jaminan_grid"])) $GLOBALS["t02_jaminan_grid"] = new ct02_jaminan_grid;
				$GLOBALS["t02_jaminan_grid"]->Page_Init();
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
		global $EW_EXPORT, $t01_nasabah;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t01_nasabah);
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
					$this->Page_Terminate("t01_nasabahlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t01_nasabahlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t01_nasabahview.php")
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
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Alamat->CurrentValue = NULL;
		$this->Alamat->OldValue = $this->Alamat->CurrentValue;
		$this->No_Telp_Hp->CurrentValue = NULL;
		$this->No_Telp_Hp->OldValue = $this->No_Telp_Hp->CurrentValue;
		$this->Pekerjaan->CurrentValue = NULL;
		$this->Pekerjaan->OldValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan_Alamat->CurrentValue = NULL;
		$this->Pekerjaan_Alamat->OldValue = $this->Pekerjaan_Alamat->CurrentValue;
		$this->Pekerjaan_No_Telp_Hp->CurrentValue = NULL;
		$this->Pekerjaan_No_Telp_Hp->OldValue = $this->Pekerjaan_No_Telp_Hp->CurrentValue;
		$this->Status->CurrentValue = 0;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->marketing_id->CurrentValue = NULL;
		$this->marketing_id->OldValue = $this->marketing_id->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Nama->FldIsDetailKey) {
			$this->Nama->setFormValue($objForm->GetValue("x_Nama"));
		}
		if (!$this->Alamat->FldIsDetailKey) {
			$this->Alamat->setFormValue($objForm->GetValue("x_Alamat"));
		}
		if (!$this->No_Telp_Hp->FldIsDetailKey) {
			$this->No_Telp_Hp->setFormValue($objForm->GetValue("x_No_Telp_Hp"));
		}
		if (!$this->Pekerjaan->FldIsDetailKey) {
			$this->Pekerjaan->setFormValue($objForm->GetValue("x_Pekerjaan"));
		}
		if (!$this->Pekerjaan_Alamat->FldIsDetailKey) {
			$this->Pekerjaan_Alamat->setFormValue($objForm->GetValue("x_Pekerjaan_Alamat"));
		}
		if (!$this->Pekerjaan_No_Telp_Hp->FldIsDetailKey) {
			$this->Pekerjaan_No_Telp_Hp->setFormValue($objForm->GetValue("x_Pekerjaan_No_Telp_Hp"));
		}
		if (!$this->Status->FldIsDetailKey) {
			$this->Status->setFormValue($objForm->GetValue("x_Status"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->marketing_id->FldIsDetailKey) {
			$this->marketing_id->setFormValue($objForm->GetValue("x_marketing_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Alamat->CurrentValue = $this->Alamat->FormValue;
		$this->No_Telp_Hp->CurrentValue = $this->No_Telp_Hp->FormValue;
		$this->Pekerjaan->CurrentValue = $this->Pekerjaan->FormValue;
		$this->Pekerjaan_Alamat->CurrentValue = $this->Pekerjaan_Alamat->FormValue;
		$this->Pekerjaan_No_Telp_Hp->CurrentValue = $this->Pekerjaan_No_Telp_Hp->FormValue;
		$this->Status->CurrentValue = $this->Status->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->marketing_id->CurrentValue = $this->marketing_id->FormValue;
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
		$this->Nama->setDbValue($rs->fields('Nama'));
		$this->Alamat->setDbValue($rs->fields('Alamat'));
		$this->No_Telp_Hp->setDbValue($rs->fields('No_Telp_Hp'));
		$this->Pekerjaan->setDbValue($rs->fields('Pekerjaan'));
		$this->Pekerjaan_Alamat->setDbValue($rs->fields('Pekerjaan_Alamat'));
		$this->Pekerjaan_No_Telp_Hp->setDbValue($rs->fields('Pekerjaan_No_Telp_Hp'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->marketing_id->setDbValue($rs->fields('marketing_id'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Nama->DbValue = $row['Nama'];
		$this->Alamat->DbValue = $row['Alamat'];
		$this->No_Telp_Hp->DbValue = $row['No_Telp_Hp'];
		$this->Pekerjaan->DbValue = $row['Pekerjaan'];
		$this->Pekerjaan_Alamat->DbValue = $row['Pekerjaan_Alamat'];
		$this->Pekerjaan_No_Telp_Hp->DbValue = $row['Pekerjaan_No_Telp_Hp'];
		$this->Status->DbValue = $row['Status'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->marketing_id->DbValue = $row['marketing_id'];
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Nama
		// Alamat
		// No_Telp_Hp
		// Pekerjaan
		// Pekerjaan_Alamat
		// Pekerjaan_No_Telp_Hp
		// Status
		// Keterangan
		// marketing_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

		// Alamat
		$this->Alamat->ViewValue = $this->Alamat->CurrentValue;
		$this->Alamat->ViewCustomAttributes = "";

		// No_Telp_Hp
		$this->No_Telp_Hp->ViewValue = $this->No_Telp_Hp->CurrentValue;
		$this->No_Telp_Hp->ViewCustomAttributes = "";

		// Pekerjaan
		$this->Pekerjaan->ViewValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->ViewCustomAttributes = "";

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->ViewValue = $this->Pekerjaan_Alamat->CurrentValue;
		$this->Pekerjaan_Alamat->ViewCustomAttributes = "";

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->ViewValue = $this->Pekerjaan_No_Telp_Hp->CurrentValue;
		$this->Pekerjaan_No_Telp_Hp->ViewCustomAttributes = "";

		// Status
		if (strval($this->Status->CurrentValue) <> "") {
			$this->Status->ViewValue = $this->Status->OptionCaption($this->Status->CurrentValue);
		} else {
			$this->Status->ViewValue = NULL;
		}
		$this->Status->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// marketing_id
		if (strval($this->marketing_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->marketing_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, `NoHP` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_marketing`";
		$sWhereWrk = "";
		$this->marketing_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->marketing_id->ViewValue = $this->marketing_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->marketing_id->ViewValue = $this->marketing_id->CurrentValue;
			}
		} else {
			$this->marketing_id->ViewValue = NULL;
		}
		$this->marketing_id->ViewCustomAttributes = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";
			$this->Alamat->TooltipValue = "";

			// No_Telp_Hp
			$this->No_Telp_Hp->LinkCustomAttributes = "";
			$this->No_Telp_Hp->HrefValue = "";
			$this->No_Telp_Hp->TooltipValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";
			$this->Pekerjaan->TooltipValue = "";

			// Pekerjaan_Alamat
			$this->Pekerjaan_Alamat->LinkCustomAttributes = "";
			$this->Pekerjaan_Alamat->HrefValue = "";
			$this->Pekerjaan_Alamat->TooltipValue = "";

			// Pekerjaan_No_Telp_Hp
			$this->Pekerjaan_No_Telp_Hp->LinkCustomAttributes = "";
			$this->Pekerjaan_No_Telp_Hp->HrefValue = "";
			$this->Pekerjaan_No_Telp_Hp->TooltipValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
			$this->Status->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// marketing_id
			$this->marketing_id->LinkCustomAttributes = "";
			$this->marketing_id->HrefValue = "";
			$this->marketing_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			$this->Nama->EditValue = ew_HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

			// Alamat
			$this->Alamat->EditAttrs["class"] = "form-control";
			$this->Alamat->EditCustomAttributes = "";
			$this->Alamat->EditValue = ew_HtmlEncode($this->Alamat->CurrentValue);
			$this->Alamat->PlaceHolder = ew_RemoveHtml($this->Alamat->FldCaption());

			// No_Telp_Hp
			$this->No_Telp_Hp->EditAttrs["class"] = "form-control";
			$this->No_Telp_Hp->EditCustomAttributes = "";
			$this->No_Telp_Hp->EditValue = ew_HtmlEncode($this->No_Telp_Hp->CurrentValue);
			$this->No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->No_Telp_Hp->FldCaption());

			// Pekerjaan
			$this->Pekerjaan->EditAttrs["class"] = "form-control";
			$this->Pekerjaan->EditCustomAttributes = "";
			$this->Pekerjaan->EditValue = ew_HtmlEncode($this->Pekerjaan->CurrentValue);
			$this->Pekerjaan->PlaceHolder = ew_RemoveHtml($this->Pekerjaan->FldCaption());

			// Pekerjaan_Alamat
			$this->Pekerjaan_Alamat->EditAttrs["class"] = "form-control";
			$this->Pekerjaan_Alamat->EditCustomAttributes = "";
			$this->Pekerjaan_Alamat->EditValue = ew_HtmlEncode($this->Pekerjaan_Alamat->CurrentValue);
			$this->Pekerjaan_Alamat->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_Alamat->FldCaption());

			// Pekerjaan_No_Telp_Hp
			$this->Pekerjaan_No_Telp_Hp->EditAttrs["class"] = "form-control";
			$this->Pekerjaan_No_Telp_Hp->EditCustomAttributes = "";
			$this->Pekerjaan_No_Telp_Hp->EditValue = ew_HtmlEncode($this->Pekerjaan_No_Telp_Hp->CurrentValue);
			$this->Pekerjaan_No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_No_Telp_Hp->FldCaption());

			// Status
			$this->Status->EditAttrs["class"] = "form-control";
			$this->Status->EditCustomAttributes = "";
			$this->Status->EditValue = $this->Status->Options(TRUE);

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// marketing_id
			$this->marketing_id->EditAttrs["class"] = "form-control";
			$this->marketing_id->EditCustomAttributes = "";
			if (trim(strval($this->marketing_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->marketing_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, `NoHP` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t07_marketing`";
			$sWhereWrk = "";
			$this->marketing_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->marketing_id->EditValue = $arwrk;

			// Add refer script
			// Nama

			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";

			// No_Telp_Hp
			$this->No_Telp_Hp->LinkCustomAttributes = "";
			$this->No_Telp_Hp->HrefValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";

			// Pekerjaan_Alamat
			$this->Pekerjaan_Alamat->LinkCustomAttributes = "";
			$this->Pekerjaan_Alamat->HrefValue = "";

			// Pekerjaan_No_Telp_Hp
			$this->Pekerjaan_No_Telp_Hp->LinkCustomAttributes = "";
			$this->Pekerjaan_No_Telp_Hp->HrefValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// marketing_id
			$this->marketing_id->LinkCustomAttributes = "";
			$this->marketing_id->HrefValue = "";
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
		if (!$this->Nama->FldIsDetailKey && !is_null($this->Nama->FormValue) && $this->Nama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nama->FldCaption(), $this->Nama->ReqErrMsg));
		}
		if (!$this->Alamat->FldIsDetailKey && !is_null($this->Alamat->FormValue) && $this->Alamat->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Alamat->FldCaption(), $this->Alamat->ReqErrMsg));
		}
		if (!$this->No_Telp_Hp->FldIsDetailKey && !is_null($this->No_Telp_Hp->FormValue) && $this->No_Telp_Hp->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->No_Telp_Hp->FldCaption(), $this->No_Telp_Hp->ReqErrMsg));
		}
		if (!$this->Pekerjaan->FldIsDetailKey && !is_null($this->Pekerjaan->FormValue) && $this->Pekerjaan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pekerjaan->FldCaption(), $this->Pekerjaan->ReqErrMsg));
		}
		if (!$this->Pekerjaan_Alamat->FldIsDetailKey && !is_null($this->Pekerjaan_Alamat->FormValue) && $this->Pekerjaan_Alamat->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pekerjaan_Alamat->FldCaption(), $this->Pekerjaan_Alamat->ReqErrMsg));
		}
		if (!$this->Pekerjaan_No_Telp_Hp->FldIsDetailKey && !is_null($this->Pekerjaan_No_Telp_Hp->FormValue) && $this->Pekerjaan_No_Telp_Hp->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pekerjaan_No_Telp_Hp->FldCaption(), $this->Pekerjaan_No_Telp_Hp->ReqErrMsg));
		}
		if (!$this->Status->FldIsDetailKey && !is_null($this->Status->FormValue) && $this->Status->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Status->FldCaption(), $this->Status->ReqErrMsg));
		}
		if (!$this->marketing_id->FldIsDetailKey && !is_null($this->marketing_id->FormValue) && $this->marketing_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->marketing_id->FldCaption(), $this->marketing_id->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t02_jaminan", $DetailTblVar) && $GLOBALS["t02_jaminan"]->DetailAdd) {
			if (!isset($GLOBALS["t02_jaminan_grid"])) $GLOBALS["t02_jaminan_grid"] = new ct02_jaminan_grid(); // get detail page object
			$GLOBALS["t02_jaminan_grid"]->ValidateGridForm();
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

		// Nama
		$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", FALSE);

		// Alamat
		$this->Alamat->SetDbValueDef($rsnew, $this->Alamat->CurrentValue, "", FALSE);

		// No_Telp_Hp
		$this->No_Telp_Hp->SetDbValueDef($rsnew, $this->No_Telp_Hp->CurrentValue, "", FALSE);

		// Pekerjaan
		$this->Pekerjaan->SetDbValueDef($rsnew, $this->Pekerjaan->CurrentValue, "", FALSE);

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->SetDbValueDef($rsnew, $this->Pekerjaan_Alamat->CurrentValue, "", FALSE);

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->SetDbValueDef($rsnew, $this->Pekerjaan_No_Telp_Hp->CurrentValue, "", FALSE);

		// Status
		$this->Status->SetDbValueDef($rsnew, $this->Status->CurrentValue, 0, strval($this->Status->CurrentValue) == "");

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, FALSE);

		// marketing_id
		$this->marketing_id->SetDbValueDef($rsnew, $this->marketing_id->CurrentValue, 0, FALSE);

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
			if (in_array("t02_jaminan", $DetailTblVar) && $GLOBALS["t02_jaminan"]->DetailAdd) {
				$GLOBALS["t02_jaminan"]->nasabah_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t02_jaminan_grid"])) $GLOBALS["t02_jaminan_grid"] = new ct02_jaminan_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "t02_jaminan"); // Load user level of detail table
				$AddRow = $GLOBALS["t02_jaminan_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["t02_jaminan"]->nasabah_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("t02_jaminan", $DetailTblVar)) {
				if (!isset($GLOBALS["t02_jaminan_grid"]))
					$GLOBALS["t02_jaminan_grid"] = new ct02_jaminan_grid;
				if ($GLOBALS["t02_jaminan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t02_jaminan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t02_jaminan_grid"]->CurrentMode = "add";
					$GLOBALS["t02_jaminan_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t02_jaminan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t02_jaminan_grid"]->setStartRecordNumber(1);
					$GLOBALS["t02_jaminan_grid"]->nasabah_id->FldIsDetailKey = TRUE;
					$GLOBALS["t02_jaminan_grid"]->nasabah_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t02_jaminan_grid"]->nasabah_id->setSessionValue($GLOBALS["t02_jaminan_grid"]->nasabah_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t01_nasabahlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_marketing_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, `NoHP` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_marketing`";
			$sWhereWrk = "";
			$this->marketing_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
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
if (!isset($t01_nasabah_add)) $t01_nasabah_add = new ct01_nasabah_add();

// Page init
$t01_nasabah_add->Page_Init();

// Page main
$t01_nasabah_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t01_nasabah_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft01_nasabahadd = new ew_Form("ft01_nasabahadd", "add");

// Validate form
ft01_nasabahadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Nama->FldCaption(), $t01_nasabah->Nama->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Alamat");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Alamat->FldCaption(), $t01_nasabah->Alamat->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_No_Telp_Hp");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->No_Telp_Hp->FldCaption(), $t01_nasabah->No_Telp_Hp->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pekerjaan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Pekerjaan->FldCaption(), $t01_nasabah->Pekerjaan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pekerjaan_Alamat");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Pekerjaan_Alamat->FldCaption(), $t01_nasabah->Pekerjaan_Alamat->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pekerjaan_No_Telp_Hp");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Pekerjaan_No_Telp_Hp->FldCaption(), $t01_nasabah->Pekerjaan_No_Telp_Hp->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Status");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->Status->FldCaption(), $t01_nasabah->Status->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_marketing_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_nasabah->marketing_id->FldCaption(), $t01_nasabah->marketing_id->ReqErrMsg)) ?>");

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
ft01_nasabahadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft01_nasabahadd.ValidateRequired = true;
<?php } else { ?>
ft01_nasabahadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft01_nasabahadd.Lists["x_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft01_nasabahadd.Lists["x_Status"].Options = <?php echo json_encode($t01_nasabah->Status->Options()) ?>;
ft01_nasabahadd.Lists["x_marketing_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","x_NoHP","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_marketing"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t01_nasabah_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t01_nasabah_add->ShowPageHeader(); ?>
<?php
$t01_nasabah_add->ShowMessage();
?>
<form name="ft01_nasabahadd" id="ft01_nasabahadd" class="<?php echo $t01_nasabah_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t01_nasabah_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t01_nasabah_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t01_nasabah">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t01_nasabah_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t01_nasabah->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group">
		<label id="elh_t01_nasabah_Nama" for="x_Nama" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Nama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Nama->CellAttributes() ?>>
<span id="el_t01_nasabah_Nama">
<input type="text" data-table="t01_nasabah" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Nama->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Nama->EditValue ?>"<?php echo $t01_nasabah->Nama->EditAttributes() ?>>
</span>
<?php echo $t01_nasabah->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Alamat->Visible) { // Alamat ?>
	<div id="r_Alamat" class="form-group">
		<label id="elh_t01_nasabah_Alamat" for="x_Alamat" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Alamat->CellAttributes() ?>>
<span id="el_t01_nasabah_Alamat">
<textarea data-table="t01_nasabah" data-field="x_Alamat" name="x_Alamat" id="x_Alamat" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Alamat->getPlaceHolder()) ?>"<?php echo $t01_nasabah->Alamat->EditAttributes() ?>><?php echo $t01_nasabah->Alamat->EditValue ?></textarea>
</span>
<?php echo $t01_nasabah->Alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
	<div id="r_No_Telp_Hp" class="form-group">
		<label id="elh_t01_nasabah_No_Telp_Hp" for="x_No_Telp_Hp" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->No_Telp_Hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->No_Telp_Hp->CellAttributes() ?>>
<span id="el_t01_nasabah_No_Telp_Hp">
<input type="text" data-table="t01_nasabah" data-field="x_No_Telp_Hp" name="x_No_Telp_Hp" id="x_No_Telp_Hp" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->No_Telp_Hp->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->No_Telp_Hp->EditValue ?>"<?php echo $t01_nasabah->No_Telp_Hp->EditAttributes() ?>>
</span>
<?php echo $t01_nasabah->No_Telp_Hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Pekerjaan->Visible) { // Pekerjaan ?>
	<div id="r_Pekerjaan" class="form-group">
		<label id="elh_t01_nasabah_Pekerjaan" for="x_Pekerjaan" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Pekerjaan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Pekerjaan->CellAttributes() ?>>
<span id="el_t01_nasabah_Pekerjaan">
<input type="text" data-table="t01_nasabah" data-field="x_Pekerjaan" name="x_Pekerjaan" id="x_Pekerjaan" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Pekerjaan->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Pekerjaan->EditValue ?>"<?php echo $t01_nasabah->Pekerjaan->EditAttributes() ?>>
</span>
<?php echo $t01_nasabah->Pekerjaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Pekerjaan_Alamat->Visible) { // Pekerjaan_Alamat ?>
	<div id="r_Pekerjaan_Alamat" class="form-group">
		<label id="elh_t01_nasabah_Pekerjaan_Alamat" for="x_Pekerjaan_Alamat" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Pekerjaan_Alamat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Pekerjaan_Alamat->CellAttributes() ?>>
<span id="el_t01_nasabah_Pekerjaan_Alamat">
<textarea data-table="t01_nasabah" data-field="x_Pekerjaan_Alamat" name="x_Pekerjaan_Alamat" id="x_Pekerjaan_Alamat" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Pekerjaan_Alamat->getPlaceHolder()) ?>"<?php echo $t01_nasabah->Pekerjaan_Alamat->EditAttributes() ?>><?php echo $t01_nasabah->Pekerjaan_Alamat->EditValue ?></textarea>
</span>
<?php echo $t01_nasabah->Pekerjaan_Alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Pekerjaan_No_Telp_Hp->Visible) { // Pekerjaan_No_Telp_Hp ?>
	<div id="r_Pekerjaan_No_Telp_Hp" class="form-group">
		<label id="elh_t01_nasabah_Pekerjaan_No_Telp_Hp" for="x_Pekerjaan_No_Telp_Hp" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->CellAttributes() ?>>
<span id="el_t01_nasabah_Pekerjaan_No_Telp_Hp">
<input type="text" data-table="t01_nasabah" data-field="x_Pekerjaan_No_Telp_Hp" name="x_Pekerjaan_No_Telp_Hp" id="x_Pekerjaan_No_Telp_Hp" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Pekerjaan_No_Telp_Hp->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->EditValue ?>"<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->EditAttributes() ?>>
</span>
<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group">
		<label id="elh_t01_nasabah_Status" for="x_Status" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Status->CellAttributes() ?>>
<span id="el_t01_nasabah_Status">
<select data-table="t01_nasabah" data-field="x_Status" data-value-separator="<?php echo $t01_nasabah->Status->DisplayValueSeparatorAttribute() ?>" id="x_Status" name="x_Status"<?php echo $t01_nasabah->Status->EditAttributes() ?>>
<?php echo $t01_nasabah->Status->SelectOptionListHtml("x_Status") ?>
</select>
</span>
<?php echo $t01_nasabah->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t01_nasabah_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->Keterangan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->Keterangan->CellAttributes() ?>>
<span id="el_t01_nasabah_Keterangan">
<input type="text" data-table="t01_nasabah" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t01_nasabah->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t01_nasabah->Keterangan->EditValue ?>"<?php echo $t01_nasabah->Keterangan->EditAttributes() ?>>
</span>
<?php echo $t01_nasabah->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_nasabah->marketing_id->Visible) { // marketing_id ?>
	<div id="r_marketing_id" class="form-group">
		<label id="elh_t01_nasabah_marketing_id" for="x_marketing_id" class="col-sm-2 control-label ewLabel"><?php echo $t01_nasabah->marketing_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_nasabah->marketing_id->CellAttributes() ?>>
<span id="el_t01_nasabah_marketing_id">
<select data-table="t01_nasabah" data-field="x_marketing_id" data-value-separator="<?php echo $t01_nasabah->marketing_id->DisplayValueSeparatorAttribute() ?>" id="x_marketing_id" name="x_marketing_id"<?php echo $t01_nasabah->marketing_id->EditAttributes() ?>>
<?php echo $t01_nasabah->marketing_id->SelectOptionListHtml("x_marketing_id") ?>
</select>
<input type="hidden" name="s_x_marketing_id" id="s_x_marketing_id" value="<?php echo $t01_nasabah->marketing_id->LookupFilterQuery() ?>">
</span>
<?php echo $t01_nasabah->marketing_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php
	if (in_array("t02_jaminan", explode(",", $t01_nasabah->getCurrentDetailTable())) && $t02_jaminan->DetailAdd) {
?>
<?php if ($t01_nasabah->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t02_jaminan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t02_jaminangrid.php" ?>
<?php } ?>
<?php if (!$t01_nasabah_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t01_nasabah_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft01_nasabahadd.Init();
</script>
<?php
$t01_nasabah_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t01_nasabah_add->Page_Terminate();
?>
