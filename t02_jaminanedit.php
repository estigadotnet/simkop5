<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t02_jaminaninfo.php" ?>
<?php include_once "t01_nasabahinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t02_jaminan_edit = NULL; // Initialize page object first

class ct02_jaminan_edit extends ct02_jaminan {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't02_jaminan';

	// Page object name
	var $PageObjName = 't02_jaminan_edit';

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

		// Table object (t02_jaminan)
		if (!isset($GLOBALS["t02_jaminan"]) || get_class($GLOBALS["t02_jaminan"]) == "ct02_jaminan") {
			$GLOBALS["t02_jaminan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t02_jaminan"];
		}

		// Table object (t01_nasabah)
		if (!isset($GLOBALS['t01_nasabah'])) $GLOBALS['t01_nasabah'] = new ct01_nasabah();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't02_jaminan', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t02_jaminanlist.php"));
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
		$this->nasabah_id->SetVisibility();
		$this->Merk_Type->SetVisibility();
		$this->No_Rangka->SetVisibility();
		$this->No_Mesin->SetVisibility();
		$this->Warna->SetVisibility();
		$this->No_Pol->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->Atas_Nama->SetVisibility();

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
		global $EW_EXPORT, $t02_jaminan;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t02_jaminan);
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
			$this->Page_Terminate("t02_jaminanlist.php"); // Invalid key, return to list
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
					$this->Page_Terminate("t02_jaminanlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t02_jaminanlist.php")
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
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->Merk_Type->FldIsDetailKey) {
			$this->Merk_Type->setFormValue($objForm->GetValue("x_Merk_Type"));
		}
		if (!$this->No_Rangka->FldIsDetailKey) {
			$this->No_Rangka->setFormValue($objForm->GetValue("x_No_Rangka"));
		}
		if (!$this->No_Mesin->FldIsDetailKey) {
			$this->No_Mesin->setFormValue($objForm->GetValue("x_No_Mesin"));
		}
		if (!$this->Warna->FldIsDetailKey) {
			$this->Warna->setFormValue($objForm->GetValue("x_Warna"));
		}
		if (!$this->No_Pol->FldIsDetailKey) {
			$this->No_Pol->setFormValue($objForm->GetValue("x_No_Pol"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->Atas_Nama->FldIsDetailKey) {
			$this->Atas_Nama->setFormValue($objForm->GetValue("x_Atas_Nama"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
		$this->Merk_Type->CurrentValue = $this->Merk_Type->FormValue;
		$this->No_Rangka->CurrentValue = $this->No_Rangka->FormValue;
		$this->No_Mesin->CurrentValue = $this->No_Mesin->FormValue;
		$this->Warna->CurrentValue = $this->Warna->FormValue;
		$this->No_Pol->CurrentValue = $this->No_Pol->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->Atas_Nama->CurrentValue = $this->Atas_Nama->FormValue;
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
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->Merk_Type->setDbValue($rs->fields('Merk_Type'));
		$this->No_Rangka->setDbValue($rs->fields('No_Rangka'));
		$this->No_Mesin->setDbValue($rs->fields('No_Mesin'));
		$this->Warna->setDbValue($rs->fields('Warna'));
		$this->No_Pol->setDbValue($rs->fields('No_Pol'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Atas_Nama->setDbValue($rs->fields('Atas_Nama'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->Merk_Type->DbValue = $row['Merk_Type'];
		$this->No_Rangka->DbValue = $row['No_Rangka'];
		$this->No_Mesin->DbValue = $row['No_Mesin'];
		$this->Warna->DbValue = $row['Warna'];
		$this->No_Pol->DbValue = $row['No_Pol'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->Atas_Nama->DbValue = $row['Atas_Nama'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// nasabah_id
		// Merk_Type
		// No_Rangka
		// No_Mesin
		// Warna
		// No_Pol
		// Keterangan
		// Atas_Nama

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array();
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
		$this->nasabah_id->ViewCustomAttributes = "";

		// Merk_Type
		$this->Merk_Type->ViewValue = $this->Merk_Type->CurrentValue;
		$this->Merk_Type->ViewCustomAttributes = "";

		// No_Rangka
		$this->No_Rangka->ViewValue = $this->No_Rangka->CurrentValue;
		$this->No_Rangka->ViewCustomAttributes = "";

		// No_Mesin
		$this->No_Mesin->ViewValue = $this->No_Mesin->CurrentValue;
		$this->No_Mesin->ViewCustomAttributes = "";

		// Warna
		$this->Warna->ViewValue = $this->Warna->CurrentValue;
		$this->Warna->ViewCustomAttributes = "";

		// No_Pol
		$this->No_Pol->ViewValue = $this->No_Pol->CurrentValue;
		$this->No_Pol->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Atas_Nama
		$this->Atas_Nama->ViewValue = $this->Atas_Nama->CurrentValue;
		$this->Atas_Nama->ViewCustomAttributes = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";

			// Merk_Type
			$this->Merk_Type->LinkCustomAttributes = "";
			$this->Merk_Type->HrefValue = "";
			$this->Merk_Type->TooltipValue = "";

			// No_Rangka
			$this->No_Rangka->LinkCustomAttributes = "";
			$this->No_Rangka->HrefValue = "";
			$this->No_Rangka->TooltipValue = "";

			// No_Mesin
			$this->No_Mesin->LinkCustomAttributes = "";
			$this->No_Mesin->HrefValue = "";
			$this->No_Mesin->TooltipValue = "";

			// Warna
			$this->Warna->LinkCustomAttributes = "";
			$this->Warna->HrefValue = "";
			$this->Warna->TooltipValue = "";

			// No_Pol
			$this->No_Pol->LinkCustomAttributes = "";
			$this->No_Pol->HrefValue = "";
			$this->No_Pol->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// Atas_Nama
			$this->Atas_Nama->LinkCustomAttributes = "";
			$this->Atas_Nama->HrefValue = "";
			$this->Atas_Nama->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			if ($this->nasabah_id->getSessionValue() <> "") {
				$this->nasabah_id->CurrentValue = $this->nasabah_id->getSessionValue();
			$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
			if (strval($this->nasabah_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array();
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
			$this->nasabah_id->ViewCustomAttributes = "";
			} else {
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->CurrentValue);
			if (strval($this->nasabah_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->nasabah_id->EditValue = $this->nasabah_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->CurrentValue);
				}
			} else {
				$this->nasabah_id->EditValue = NULL;
			}
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
			}

			// Merk_Type
			$this->Merk_Type->EditAttrs["class"] = "form-control";
			$this->Merk_Type->EditCustomAttributes = "";
			$this->Merk_Type->EditValue = ew_HtmlEncode($this->Merk_Type->CurrentValue);
			$this->Merk_Type->PlaceHolder = ew_RemoveHtml($this->Merk_Type->FldCaption());

			// No_Rangka
			$this->No_Rangka->EditAttrs["class"] = "form-control";
			$this->No_Rangka->EditCustomAttributes = "";
			$this->No_Rangka->EditValue = ew_HtmlEncode($this->No_Rangka->CurrentValue);
			$this->No_Rangka->PlaceHolder = ew_RemoveHtml($this->No_Rangka->FldCaption());

			// No_Mesin
			$this->No_Mesin->EditAttrs["class"] = "form-control";
			$this->No_Mesin->EditCustomAttributes = "";
			$this->No_Mesin->EditValue = ew_HtmlEncode($this->No_Mesin->CurrentValue);
			$this->No_Mesin->PlaceHolder = ew_RemoveHtml($this->No_Mesin->FldCaption());

			// Warna
			$this->Warna->EditAttrs["class"] = "form-control";
			$this->Warna->EditCustomAttributes = "";
			$this->Warna->EditValue = ew_HtmlEncode($this->Warna->CurrentValue);
			$this->Warna->PlaceHolder = ew_RemoveHtml($this->Warna->FldCaption());

			// No_Pol
			$this->No_Pol->EditAttrs["class"] = "form-control";
			$this->No_Pol->EditCustomAttributes = "";
			$this->No_Pol->EditValue = ew_HtmlEncode($this->No_Pol->CurrentValue);
			$this->No_Pol->PlaceHolder = ew_RemoveHtml($this->No_Pol->FldCaption());

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// Atas_Nama
			$this->Atas_Nama->EditAttrs["class"] = "form-control";
			$this->Atas_Nama->EditCustomAttributes = "";
			$this->Atas_Nama->EditValue = ew_HtmlEncode($this->Atas_Nama->CurrentValue);
			$this->Atas_Nama->PlaceHolder = ew_RemoveHtml($this->Atas_Nama->FldCaption());

			// Edit refer script
			// nasabah_id

			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";

			// Merk_Type
			$this->Merk_Type->LinkCustomAttributes = "";
			$this->Merk_Type->HrefValue = "";

			// No_Rangka
			$this->No_Rangka->LinkCustomAttributes = "";
			$this->No_Rangka->HrefValue = "";

			// No_Mesin
			$this->No_Mesin->LinkCustomAttributes = "";
			$this->No_Mesin->HrefValue = "";

			// Warna
			$this->Warna->LinkCustomAttributes = "";
			$this->Warna->HrefValue = "";

			// No_Pol
			$this->No_Pol->LinkCustomAttributes = "";
			$this->No_Pol->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// Atas_Nama
			$this->Atas_Nama->LinkCustomAttributes = "";
			$this->Atas_Nama->HrefValue = "";
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
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->nasabah_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->nasabah_id->FldErrMsg());
		}
		if (!$this->Merk_Type->FldIsDetailKey && !is_null($this->Merk_Type->FormValue) && $this->Merk_Type->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Merk_Type->FldCaption(), $this->Merk_Type->ReqErrMsg));
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

			// nasabah_id
			$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, $this->nasabah_id->ReadOnly);

			// Merk_Type
			$this->Merk_Type->SetDbValueDef($rsnew, $this->Merk_Type->CurrentValue, "", $this->Merk_Type->ReadOnly);

			// No_Rangka
			$this->No_Rangka->SetDbValueDef($rsnew, $this->No_Rangka->CurrentValue, NULL, $this->No_Rangka->ReadOnly);

			// No_Mesin
			$this->No_Mesin->SetDbValueDef($rsnew, $this->No_Mesin->CurrentValue, NULL, $this->No_Mesin->ReadOnly);

			// Warna
			$this->Warna->SetDbValueDef($rsnew, $this->Warna->CurrentValue, NULL, $this->Warna->ReadOnly);

			// No_Pol
			$this->No_Pol->SetDbValueDef($rsnew, $this->No_Pol->CurrentValue, NULL, $this->No_Pol->ReadOnly);

			// Keterangan
			$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, $this->Keterangan->ReadOnly);

			// Atas_Nama
			$this->Atas_Nama->SetDbValueDef($rsnew, $this->Atas_Nama->CurrentValue, NULL, $this->Atas_Nama->ReadOnly);

			// Check referential integrity for master table 't01_nasabah'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_t01_nasabah();
			$KeyValue = isset($rsnew['nasabah_id']) ? $rsnew['nasabah_id'] : $rsold['nasabah_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["t01_nasabah"])) $GLOBALS["t01_nasabah"] = new ct01_nasabah();
				$rsmaster = $GLOBALS["t01_nasabah"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "t01_nasabah", $Language->Phrase("RelatedRecordRequired"));
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
			if ($sMasterTblVar == "t01_nasabah") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t01_nasabah"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->nasabah_id->setQueryStringValue($GLOBALS["t01_nasabah"]->id->QueryStringValue);
					$this->nasabah_id->setSessionValue($this->nasabah_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t01_nasabah"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "t01_nasabah") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t01_nasabah"]->id->setFormValue($_POST["fk_id"]);
					$this->nasabah_id->setFormValue($GLOBALS["t01_nasabah"]->id->FormValue);
					$this->nasabah_id->setSessionValue($this->nasabah_id->FormValue);
					if (!is_numeric($GLOBALS["t01_nasabah"]->id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "t01_nasabah") {
				if ($this->nasabah_id->CurrentValue == "") $this->nasabah_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t02_jaminanlist.php"), "", $this->TableVar, TRUE);
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
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
			$sWhereWrk = "{filter}";
			$this->nasabah_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
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
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld` FROM `t01_nasabah`";
			$sWhereWrk = "`Nama` LIKE '{query_value}%'";
			$this->nasabah_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t02_jaminan_edit)) $t02_jaminan_edit = new ct02_jaminan_edit();

// Page init
$t02_jaminan_edit->Page_Init();

// Page main
$t02_jaminan_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t02_jaminan_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft02_jaminanedit = new ew_Form("ft02_jaminanedit", "edit");

// Validate form
ft02_jaminanedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_jaminan->nasabah_id->FldCaption(), $t02_jaminan->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t02_jaminan->nasabah_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Merk_Type");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_jaminan->Merk_Type->FldCaption(), $t02_jaminan->Merk_Type->ReqErrMsg)) ?>");

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
ft02_jaminanedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft02_jaminanedit.ValidateRequired = true;
<?php } else { ?>
ft02_jaminanedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft02_jaminanedit.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_nasabah"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t02_jaminan_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t02_jaminan_edit->ShowPageHeader(); ?>
<?php
$t02_jaminan_edit->ShowMessage();
?>
<form name="ft02_jaminanedit" id="ft02_jaminanedit" class="<?php echo $t02_jaminan_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t02_jaminan_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t02_jaminan_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t02_jaminan">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t02_jaminan_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t02_jaminan->getCurrentMasterTable() == "t01_nasabah") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t01_nasabah">
<input type="hidden" name="fk_id" value="<?php echo $t02_jaminan->nasabah_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t02_jaminan->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t02_jaminan_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->nasabah_id->CellAttributes() ?>>
<?php if ($t02_jaminan->nasabah_id->getSessionValue() <> "") { ?>
<span id="el_t02_jaminan_nasabah_id">
<span<?php echo $t02_jaminan->nasabah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_jaminan->nasabah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_nasabah_id" name="x_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t02_jaminan_nasabah_id">
<?php
$wrkonchange = trim(" " . @$t02_jaminan->nasabah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_jaminan->nasabah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_nasabah_id" style="white-space: nowrap; z-index: 8980">
	<input type="text" name="sv_x_nasabah_id" id="sv_x_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>"<?php echo $t02_jaminan->nasabah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_jaminan" data-field="x_nasabah_id" data-value-separator="<?php echo $t02_jaminan->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x_nasabah_id" id="x_nasabah_id" value="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_nasabah_id" id="q_x_nasabah_id" value="<?php echo $t02_jaminan->nasabah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_jaminanedit.CreateAutoSuggest({"id":"x_nasabah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $t02_jaminan->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->Merk_Type->Visible) { // Merk_Type ?>
	<div id="r_Merk_Type" class="form-group">
		<label id="elh_t02_jaminan_Merk_Type" for="x_Merk_Type" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->Merk_Type->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->Merk_Type->CellAttributes() ?>>
<span id="el_t02_jaminan_Merk_Type">
<input type="text" data-table="t02_jaminan" data-field="x_Merk_Type" name="x_Merk_Type" id="x_Merk_Type" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Merk_Type->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Merk_Type->EditValue ?>"<?php echo $t02_jaminan->Merk_Type->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->Merk_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->No_Rangka->Visible) { // No_Rangka ?>
	<div id="r_No_Rangka" class="form-group">
		<label id="elh_t02_jaminan_No_Rangka" for="x_No_Rangka" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->No_Rangka->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->No_Rangka->CellAttributes() ?>>
<span id="el_t02_jaminan_No_Rangka">
<input type="text" data-table="t02_jaminan" data-field="x_No_Rangka" name="x_No_Rangka" id="x_No_Rangka" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->No_Rangka->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->No_Rangka->EditValue ?>"<?php echo $t02_jaminan->No_Rangka->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->No_Rangka->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->No_Mesin->Visible) { // No_Mesin ?>
	<div id="r_No_Mesin" class="form-group">
		<label id="elh_t02_jaminan_No_Mesin" for="x_No_Mesin" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->No_Mesin->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->No_Mesin->CellAttributes() ?>>
<span id="el_t02_jaminan_No_Mesin">
<input type="text" data-table="t02_jaminan" data-field="x_No_Mesin" name="x_No_Mesin" id="x_No_Mesin" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->No_Mesin->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->No_Mesin->EditValue ?>"<?php echo $t02_jaminan->No_Mesin->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->No_Mesin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->Warna->Visible) { // Warna ?>
	<div id="r_Warna" class="form-group">
		<label id="elh_t02_jaminan_Warna" for="x_Warna" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->Warna->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->Warna->CellAttributes() ?>>
<span id="el_t02_jaminan_Warna">
<input type="text" data-table="t02_jaminan" data-field="x_Warna" name="x_Warna" id="x_Warna" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Warna->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Warna->EditValue ?>"<?php echo $t02_jaminan->Warna->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->Warna->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->No_Pol->Visible) { // No_Pol ?>
	<div id="r_No_Pol" class="form-group">
		<label id="elh_t02_jaminan_No_Pol" for="x_No_Pol" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->No_Pol->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->No_Pol->CellAttributes() ?>>
<span id="el_t02_jaminan_No_Pol">
<input type="text" data-table="t02_jaminan" data-field="x_No_Pol" name="x_No_Pol" id="x_No_Pol" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->No_Pol->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->No_Pol->EditValue ?>"<?php echo $t02_jaminan->No_Pol->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->No_Pol->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t02_jaminan_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->Keterangan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->Keterangan->CellAttributes() ?>>
<span id="el_t02_jaminan_Keterangan">
<textarea data-table="t02_jaminan" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Keterangan->getPlaceHolder()) ?>"<?php echo $t02_jaminan->Keterangan->EditAttributes() ?>><?php echo $t02_jaminan->Keterangan->EditValue ?></textarea>
</span>
<?php echo $t02_jaminan->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t02_jaminan->Atas_Nama->Visible) { // Atas_Nama ?>
	<div id="r_Atas_Nama" class="form-group">
		<label id="elh_t02_jaminan_Atas_Nama" for="x_Atas_Nama" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->Atas_Nama->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->Atas_Nama->CellAttributes() ?>>
<span id="el_t02_jaminan_Atas_Nama">
<input type="text" data-table="t02_jaminan" data-field="x_Atas_Nama" name="x_Atas_Nama" id="x_Atas_Nama" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->Atas_Nama->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->Atas_Nama->EditValue ?>"<?php echo $t02_jaminan->Atas_Nama->EditAttributes() ?>>
</span>
<?php echo $t02_jaminan->Atas_Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t02_jaminan" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t02_jaminan->id->CurrentValue) ?>">
<?php if (!$t02_jaminan_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t02_jaminan_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft02_jaminanedit.Init();
</script>
<?php
$t02_jaminan_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t02_jaminan_edit->Page_Terminate();
?>
