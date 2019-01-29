<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t11_jurnalmasterinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t12_jurnaldetailgridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t11_jurnalmaster_add = NULL; // Initialize page object first

class ct11_jurnalmaster_add extends ct11_jurnalmaster {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't11_jurnalmaster';

	// Page object name
	var $PageObjName = 't11_jurnalmaster_add';

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

		// Table object (t11_jurnalmaster)
		if (!isset($GLOBALS["t11_jurnalmaster"]) || get_class($GLOBALS["t11_jurnalmaster"]) == "ct11_jurnalmaster") {
			$GLOBALS["t11_jurnalmaster"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t11_jurnalmaster"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't11_jurnalmaster', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t11_jurnalmasterlist.php"));
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
		$this->Tanggal->SetVisibility();
		$this->NomorTransaksi->SetVisibility();
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

			// Process auto fill for detail table 't12_jurnaldetail'
			if (@$_POST["grid"] == "ft12_jurnaldetailgrid") {
				if (!isset($GLOBALS["t12_jurnaldetail_grid"])) $GLOBALS["t12_jurnaldetail_grid"] = new ct12_jurnaldetail_grid;
				$GLOBALS["t12_jurnaldetail_grid"]->Page_Init();
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
		global $EW_EXPORT, $t11_jurnalmaster;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t11_jurnalmaster);
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
					$this->Page_Terminate("t11_jurnalmasterlist.php"); // No matching record, return to list
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
					if (ew_GetPageName($sReturnUrl) == "t11_jurnalmasterlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t11_jurnalmasterview.php")
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
		$this->Tanggal->CurrentValue = NULL;
		$this->Tanggal->OldValue = $this->Tanggal->CurrentValue;
		$this->NomorTransaksi->CurrentValue = NULL;
		$this->NomorTransaksi->OldValue = $this->NomorTransaksi->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Tanggal->FldIsDetailKey) {
			$this->Tanggal->setFormValue($objForm->GetValue("x_Tanggal"));
			$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		}
		if (!$this->NomorTransaksi->FldIsDetailKey) {
			$this->NomorTransaksi->setFormValue($objForm->GetValue("x_NomorTransaksi"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->Tanggal->CurrentValue = $this->Tanggal->FormValue;
		$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		$this->NomorTransaksi->CurrentValue = $this->NomorTransaksi->FormValue;
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
		$this->Tanggal->setDbValue($rs->fields('Tanggal'));
		$this->NomorTransaksi->setDbValue($rs->fields('NomorTransaksi'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Periode->setDbValue($rs->fields('Periode'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Tanggal->DbValue = $row['Tanggal'];
		$this->NomorTransaksi->DbValue = $row['NomorTransaksi'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->Periode->DbValue = $row['Periode'];
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
		// Tanggal
		// NomorTransaksi
		// Keterangan
		// Periode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Tanggal
		$this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
		$this->Tanggal->ViewValue = ew_FormatDateTime($this->Tanggal->ViewValue, 7);
		$this->Tanggal->ViewCustomAttributes = "";

		// NomorTransaksi
		$this->NomorTransaksi->ViewValue = $this->NomorTransaksi->CurrentValue;
		$this->NomorTransaksi->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

			// Tanggal
			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";
			$this->Tanggal->TooltipValue = "";

			// NomorTransaksi
			$this->NomorTransaksi->LinkCustomAttributes = "";
			$this->NomorTransaksi->HrefValue = "";
			$this->NomorTransaksi->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Tanggal
			$this->Tanggal->EditAttrs["class"] = "form-control";
			$this->Tanggal->EditCustomAttributes = "style='width: 115px;'";
			$this->Tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal->CurrentValue, 7));
			$this->Tanggal->PlaceHolder = ew_RemoveHtml($this->Tanggal->FldCaption());

			// NomorTransaksi
			$this->NomorTransaksi->EditAttrs["class"] = "form-control";
			$this->NomorTransaksi->EditCustomAttributes = "";
			$this->NomorTransaksi->EditValue = ew_HtmlEncode($this->NomorTransaksi->CurrentValue);
			$this->NomorTransaksi->PlaceHolder = ew_RemoveHtml($this->NomorTransaksi->FldCaption());

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// Add refer script
			// Tanggal

			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";

			// NomorTransaksi
			$this->NomorTransaksi->LinkCustomAttributes = "";
			$this->NomorTransaksi->HrefValue = "";

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
		if (!$this->Tanggal->FldIsDetailKey && !is_null($this->Tanggal->FormValue) && $this->Tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tanggal->FldCaption(), $this->Tanggal->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal->FldErrMsg());
		}
		if (!$this->NomorTransaksi->FldIsDetailKey && !is_null($this->NomorTransaksi->FormValue) && $this->NomorTransaksi->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NomorTransaksi->FldCaption(), $this->NomorTransaksi->ReqErrMsg));
		}
		if (!$this->Keterangan->FldIsDetailKey && !is_null($this->Keterangan->FormValue) && $this->Keterangan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Keterangan->FldCaption(), $this->Keterangan->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t12_jurnaldetail", $DetailTblVar) && $GLOBALS["t12_jurnaldetail"]->DetailAdd) {
			if (!isset($GLOBALS["t12_jurnaldetail_grid"])) $GLOBALS["t12_jurnaldetail_grid"] = new ct12_jurnaldetail_grid(); // get detail page object
			$GLOBALS["t12_jurnaldetail_grid"]->ValidateGridForm();
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

		// Tanggal
		$this->Tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// NomorTransaksi
		$this->NomorTransaksi->SetDbValueDef($rsnew, $this->NomorTransaksi->CurrentValue, "", FALSE);

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, "", FALSE);

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
			if (in_array("t12_jurnaldetail", $DetailTblVar) && $GLOBALS["t12_jurnaldetail"]->DetailAdd) {
				$GLOBALS["t12_jurnaldetail"]->jurnalmaster_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t12_jurnaldetail_grid"])) $GLOBALS["t12_jurnaldetail_grid"] = new ct12_jurnaldetail_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "t12_jurnaldetail"); // Load user level of detail table
				$AddRow = $GLOBALS["t12_jurnaldetail_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["t12_jurnaldetail"]->jurnalmaster_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("t12_jurnaldetail", $DetailTblVar)) {
				if (!isset($GLOBALS["t12_jurnaldetail_grid"]))
					$GLOBALS["t12_jurnaldetail_grid"] = new ct12_jurnaldetail_grid;
				if ($GLOBALS["t12_jurnaldetail_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t12_jurnaldetail_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t12_jurnaldetail_grid"]->CurrentMode = "add";
					$GLOBALS["t12_jurnaldetail_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t12_jurnaldetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t12_jurnaldetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t12_jurnaldetail_grid"]->jurnalmaster_id->FldIsDetailKey = TRUE;
					$GLOBALS["t12_jurnaldetail_grid"]->jurnalmaster_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t12_jurnaldetail_grid"]->jurnalmaster_id->setSessionValue($GLOBALS["t12_jurnaldetail_grid"]->jurnalmaster_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t11_jurnalmasterlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($t11_jurnalmaster_add)) $t11_jurnalmaster_add = new ct11_jurnalmaster_add();

// Page init
$t11_jurnalmaster_add->Page_Init();

// Page main
$t11_jurnalmaster_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t11_jurnalmaster_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft11_jurnalmasteradd = new ew_Form("ft11_jurnalmasteradd", "add");

// Validate form
ft11_jurnalmasteradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jurnalmaster->Tanggal->FldCaption(), $t11_jurnalmaster->Tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t11_jurnalmaster->Tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_NomorTransaksi");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jurnalmaster->NomorTransaksi->FldCaption(), $t11_jurnalmaster->NomorTransaksi->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Keterangan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jurnalmaster->Keterangan->FldCaption(), $t11_jurnalmaster->Keterangan->ReqErrMsg)) ?>");

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
ft11_jurnalmasteradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft11_jurnalmasteradd.ValidateRequired = true;
<?php } else { ?>
ft11_jurnalmasteradd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t11_jurnalmaster_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t11_jurnalmaster_add->ShowPageHeader(); ?>
<?php
$t11_jurnalmaster_add->ShowMessage();
?>
<form name="ft11_jurnalmasteradd" id="ft11_jurnalmasteradd" class="<?php echo $t11_jurnalmaster_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t11_jurnalmaster_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t11_jurnalmaster_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t11_jurnalmaster">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t11_jurnalmaster_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t11_jurnalmaster->Tanggal->Visible) { // Tanggal ?>
	<div id="r_Tanggal" class="form-group">
		<label id="elh_t11_jurnalmaster_Tanggal" for="x_Tanggal" class="col-sm-2 control-label ewLabel"><?php echo $t11_jurnalmaster->Tanggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t11_jurnalmaster->Tanggal->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_Tanggal">
<input type="text" data-table="t11_jurnalmaster" data-field="x_Tanggal" data-format="7" name="x_Tanggal" id="x_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t11_jurnalmaster->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t11_jurnalmaster->Tanggal->EditValue ?>"<?php echo $t11_jurnalmaster->Tanggal->EditAttributes() ?>>
<?php if (!$t11_jurnalmaster->Tanggal->ReadOnly && !$t11_jurnalmaster->Tanggal->Disabled && !isset($t11_jurnalmaster->Tanggal->EditAttrs["readonly"]) && !isset($t11_jurnalmaster->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft11_jurnalmasteradd", "x_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php echo $t11_jurnalmaster->Tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jurnalmaster->NomorTransaksi->Visible) { // NomorTransaksi ?>
	<div id="r_NomorTransaksi" class="form-group">
		<label id="elh_t11_jurnalmaster_NomorTransaksi" for="x_NomorTransaksi" class="col-sm-2 control-label ewLabel"><?php echo $t11_jurnalmaster->NomorTransaksi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t11_jurnalmaster->NomorTransaksi->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_NomorTransaksi">
<input type="text" data-table="t11_jurnalmaster" data-field="x_NomorTransaksi" name="x_NomorTransaksi" id="x_NomorTransaksi" size="10" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t11_jurnalmaster->NomorTransaksi->getPlaceHolder()) ?>" value="<?php echo $t11_jurnalmaster->NomorTransaksi->EditValue ?>"<?php echo $t11_jurnalmaster->NomorTransaksi->EditAttributes() ?>>
</span>
<?php echo $t11_jurnalmaster->NomorTransaksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jurnalmaster->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t11_jurnalmaster_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t11_jurnalmaster->Keterangan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t11_jurnalmaster->Keterangan->CellAttributes() ?>>
<span id="el_t11_jurnalmaster_Keterangan">
<input type="text" data-table="t11_jurnalmaster" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="50" maxlength="255" placeholder="<?php echo ew_HtmlEncode($t11_jurnalmaster->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t11_jurnalmaster->Keterangan->EditValue ?>"<?php echo $t11_jurnalmaster->Keterangan->EditAttributes() ?>>
</span>
<?php echo $t11_jurnalmaster->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php
	if (in_array("t12_jurnaldetail", explode(",", $t11_jurnalmaster->getCurrentDetailTable())) && $t12_jurnaldetail->DetailAdd) {
?>
<?php if ($t11_jurnalmaster->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t12_jurnaldetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t12_jurnaldetailgrid.php" ?>
<?php } ?>
<?php if (!$t11_jurnalmaster_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t11_jurnalmaster_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft11_jurnalmasteradd.Init();
</script>
<?php
$t11_jurnalmaster_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");
	// tampilkan TANGGAL HARI INI di field KONTRAK_TGL

	$("#x_Tanggal").val("<?php echo date('d-m-Y');?>");
</script>
<?php include_once "footer.php" ?>
<?php
$t11_jurnalmaster_add->Page_Terminate();
?>
