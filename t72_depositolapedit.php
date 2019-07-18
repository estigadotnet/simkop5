<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t72_depositolapinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t72_depositolap_edit = NULL; // Initialize page object first

class ct72_depositolap_edit extends ct72_depositolap {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't72_depositolap';

	// Page object name
	var $PageObjName = 't72_depositolap_edit';

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

		// Table object (t72_depositolap)
		if (!isset($GLOBALS["t72_depositolap"]) || get_class($GLOBALS["t72_depositolap"]) == "ct72_depositolap") {
			$GLOBALS["t72_depositolap"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t72_depositolap"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't72_depositolap', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t72_depositolaplist.php"));
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
		$this->field_name->SetVisibility();
		$this->field_caption->SetVisibility();
		$this->field_index->SetVisibility();
		$this->field_status->SetVisibility();
		$this->field_align->SetVisibility();
		$this->field_format->SetVisibility();

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
		global $EW_EXPORT, $t72_depositolap;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t72_depositolap);
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
			$this->Page_Terminate("t72_depositolaplist.php"); // Invalid key, return to list
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
					$this->Page_Terminate("t72_depositolaplist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t72_depositolaplist.php")
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
		if (!$this->field_name->FldIsDetailKey) {
			$this->field_name->setFormValue($objForm->GetValue("x_field_name"));
		}
		if (!$this->field_caption->FldIsDetailKey) {
			$this->field_caption->setFormValue($objForm->GetValue("x_field_caption"));
		}
		if (!$this->field_index->FldIsDetailKey) {
			$this->field_index->setFormValue($objForm->GetValue("x_field_index"));
		}
		if (!$this->field_status->FldIsDetailKey) {
			$this->field_status->setFormValue($objForm->GetValue("x_field_status"));
		}
		if (!$this->field_align->FldIsDetailKey) {
			$this->field_align->setFormValue($objForm->GetValue("x_field_align"));
		}
		if (!$this->field_format->FldIsDetailKey) {
			$this->field_format->setFormValue($objForm->GetValue("x_field_format"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->field_name->CurrentValue = $this->field_name->FormValue;
		$this->field_caption->CurrentValue = $this->field_caption->FormValue;
		$this->field_index->CurrentValue = $this->field_index->FormValue;
		$this->field_status->CurrentValue = $this->field_status->FormValue;
		$this->field_align->CurrentValue = $this->field_align->FormValue;
		$this->field_format->CurrentValue = $this->field_format->FormValue;
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
		$this->field_name->setDbValue($rs->fields('field_name'));
		$this->field_caption->setDbValue($rs->fields('field_caption'));
		$this->field_index->setDbValue($rs->fields('field_index'));
		$this->field_status->setDbValue($rs->fields('field_status'));
		$this->field_align->setDbValue($rs->fields('field_align'));
		$this->field_format->setDbValue($rs->fields('field_format'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->field_name->DbValue = $row['field_name'];
		$this->field_caption->DbValue = $row['field_caption'];
		$this->field_index->DbValue = $row['field_index'];
		$this->field_status->DbValue = $row['field_status'];
		$this->field_align->DbValue = $row['field_align'];
		$this->field_format->DbValue = $row['field_format'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// field_name
		// field_caption
		// field_index
		// field_status
		// field_align
		// field_format

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// field_name
		$this->field_name->ViewValue = $this->field_name->CurrentValue;
		$this->field_name->ViewCustomAttributes = "";

		// field_caption
		$this->field_caption->ViewValue = $this->field_caption->CurrentValue;
		$this->field_caption->ViewCustomAttributes = "";

		// field_index
		$this->field_index->ViewValue = $this->field_index->CurrentValue;
		$this->field_index->ViewCustomAttributes = "";

		// field_status
		if (ew_ConvertToBool($this->field_status->CurrentValue)) {
			$this->field_status->ViewValue = $this->field_status->FldTagCaption(1) <> "" ? $this->field_status->FldTagCaption(1) : "Y";
		} else {
			$this->field_status->ViewValue = $this->field_status->FldTagCaption(2) <> "" ? $this->field_status->FldTagCaption(2) : "N";
		}
		$this->field_status->ViewCustomAttributes = "";

		// field_align
		if (strval($this->field_align->CurrentValue) <> "") {
			$this->field_align->ViewValue = $this->field_align->OptionCaption($this->field_align->CurrentValue);
		} else {
			$this->field_align->ViewValue = NULL;
		}
		$this->field_align->ViewCustomAttributes = "";

		// field_format
		if (strval($this->field_format->CurrentValue) <> "") {
			$this->field_format->ViewValue = $this->field_format->OptionCaption($this->field_format->CurrentValue);
		} else {
			$this->field_format->ViewValue = NULL;
		}
		$this->field_format->ViewCustomAttributes = "";

			// field_name
			$this->field_name->LinkCustomAttributes = "";
			$this->field_name->HrefValue = "";
			$this->field_name->TooltipValue = "";

			// field_caption
			$this->field_caption->LinkCustomAttributes = "";
			$this->field_caption->HrefValue = "";
			$this->field_caption->TooltipValue = "";

			// field_index
			$this->field_index->LinkCustomAttributes = "";
			$this->field_index->HrefValue = "";
			$this->field_index->TooltipValue = "";

			// field_status
			$this->field_status->LinkCustomAttributes = "";
			$this->field_status->HrefValue = "";
			$this->field_status->TooltipValue = "";

			// field_align
			$this->field_align->LinkCustomAttributes = "";
			$this->field_align->HrefValue = "";
			$this->field_align->TooltipValue = "";

			// field_format
			$this->field_format->LinkCustomAttributes = "";
			$this->field_format->HrefValue = "";
			$this->field_format->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// field_name
			$this->field_name->EditAttrs["class"] = "form-control";
			$this->field_name->EditCustomAttributes = "";
			$this->field_name->EditValue = $this->field_name->CurrentValue;
			$this->field_name->ViewCustomAttributes = "";

			// field_caption
			$this->field_caption->EditAttrs["class"] = "form-control";
			$this->field_caption->EditCustomAttributes = "";
			$this->field_caption->EditValue = ew_HtmlEncode($this->field_caption->CurrentValue);
			$this->field_caption->PlaceHolder = ew_RemoveHtml($this->field_caption->FldCaption());

			// field_index
			$this->field_index->EditAttrs["class"] = "form-control";
			$this->field_index->EditCustomAttributes = "";
			$this->field_index->EditValue = ew_HtmlEncode($this->field_index->CurrentValue);
			$this->field_index->PlaceHolder = ew_RemoveHtml($this->field_index->FldCaption());

			// field_status
			$this->field_status->EditCustomAttributes = "";
			$this->field_status->EditValue = $this->field_status->Options(FALSE);

			// field_align
			$this->field_align->EditAttrs["class"] = "form-control";
			$this->field_align->EditCustomAttributes = "";
			$this->field_align->EditValue = $this->field_align->Options(TRUE);

			// field_format
			$this->field_format->EditAttrs["class"] = "form-control";
			$this->field_format->EditCustomAttributes = "";
			$this->field_format->EditValue = $this->field_format->Options(TRUE);

			// Edit refer script
			// field_name

			$this->field_name->LinkCustomAttributes = "";
			$this->field_name->HrefValue = "";
			$this->field_name->TooltipValue = "";

			// field_caption
			$this->field_caption->LinkCustomAttributes = "";
			$this->field_caption->HrefValue = "";

			// field_index
			$this->field_index->LinkCustomAttributes = "";
			$this->field_index->HrefValue = "";

			// field_status
			$this->field_status->LinkCustomAttributes = "";
			$this->field_status->HrefValue = "";

			// field_align
			$this->field_align->LinkCustomAttributes = "";
			$this->field_align->HrefValue = "";

			// field_format
			$this->field_format->LinkCustomAttributes = "";
			$this->field_format->HrefValue = "";
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
		if (!$this->field_caption->FldIsDetailKey && !is_null($this->field_caption->FormValue) && $this->field_caption->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_caption->FldCaption(), $this->field_caption->ReqErrMsg));
		}
		if (!$this->field_index->FldIsDetailKey && !is_null($this->field_index->FormValue) && $this->field_index->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_index->FldCaption(), $this->field_index->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->field_index->FormValue)) {
			ew_AddMessage($gsFormError, $this->field_index->FldErrMsg());
		}
		if ($this->field_status->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_status->FldCaption(), $this->field_status->ReqErrMsg));
		}
		if (!$this->field_align->FldIsDetailKey && !is_null($this->field_align->FormValue) && $this->field_align->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_align->FldCaption(), $this->field_align->ReqErrMsg));
		}
		if (!$this->field_format->FldIsDetailKey && !is_null($this->field_format->FormValue) && $this->field_format->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_format->FldCaption(), $this->field_format->ReqErrMsg));
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

			// field_caption
			$this->field_caption->SetDbValueDef($rsnew, $this->field_caption->CurrentValue, "", $this->field_caption->ReadOnly);

			// field_index
			$this->field_index->SetDbValueDef($rsnew, $this->field_index->CurrentValue, 0, $this->field_index->ReadOnly);

			// field_status
			$this->field_status->SetDbValueDef($rsnew, ((strval($this->field_status->CurrentValue) == "Y") ? "Y" : "N"), "N", $this->field_status->ReadOnly);

			// field_align
			$this->field_align->SetDbValueDef($rsnew, $this->field_align->CurrentValue, "", $this->field_align->ReadOnly);

			// field_format
			$this->field_format->SetDbValueDef($rsnew, $this->field_format->CurrentValue, "", $this->field_format->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t72_depositolaplist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t72_depositolap_edit)) $t72_depositolap_edit = new ct72_depositolap_edit();

// Page init
$t72_depositolap_edit->Page_Init();

// Page main
$t72_depositolap_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t72_depositolap_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft72_depositolapedit = new ew_Form("ft72_depositolapedit", "edit");

// Validate form
ft72_depositolapedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_field_caption");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_caption->FldCaption(), $t72_depositolap->field_caption->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_field_index");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_index->FldCaption(), $t72_depositolap->field_index->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_field_index");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t72_depositolap->field_index->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_field_status");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_status->FldCaption(), $t72_depositolap->field_status->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_field_align");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_align->FldCaption(), $t72_depositolap->field_align->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_field_format");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_format->FldCaption(), $t72_depositolap->field_format->ReqErrMsg)) ?>");

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
ft72_depositolapedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft72_depositolapedit.ValidateRequired = true;
<?php } else { ?>
ft72_depositolapedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft72_depositolapedit.Lists["x_field_status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolapedit.Lists["x_field_status"].Options = <?php echo json_encode($t72_depositolap->field_status->Options()) ?>;
ft72_depositolapedit.Lists["x_field_align"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolapedit.Lists["x_field_align"].Options = <?php echo json_encode($t72_depositolap->field_align->Options()) ?>;
ft72_depositolapedit.Lists["x_field_format"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolapedit.Lists["x_field_format"].Options = <?php echo json_encode($t72_depositolap->field_format->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t72_depositolap_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t72_depositolap_edit->ShowPageHeader(); ?>
<?php
$t72_depositolap_edit->ShowMessage();
?>
<form name="ft72_depositolapedit" id="ft72_depositolapedit" class="<?php echo $t72_depositolap_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t72_depositolap_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t72_depositolap_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t72_depositolap">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t72_depositolap_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t72_depositolap->field_name->Visible) { // field_name ?>
	<div id="r_field_name" class="form-group">
		<label id="elh_t72_depositolap_field_name" for="x_field_name" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_name->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_name->CellAttributes() ?>>
<span id="el_t72_depositolap_field_name">
<span<?php echo $t72_depositolap->field_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t72_depositolap->field_name->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_name" name="x_field_name" id="x_field_name" value="<?php echo ew_HtmlEncode($t72_depositolap->field_name->CurrentValue) ?>">
<?php echo $t72_depositolap->field_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t72_depositolap->field_caption->Visible) { // field_caption ?>
	<div id="r_field_caption" class="form-group">
		<label id="elh_t72_depositolap_field_caption" for="x_field_caption" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_caption->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_caption->CellAttributes() ?>>
<span id="el_t72_depositolap_field_caption">
<input type="text" data-table="t72_depositolap" data-field="x_field_caption" name="x_field_caption" id="x_field_caption" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_caption->EditValue ?>"<?php echo $t72_depositolap->field_caption->EditAttributes() ?>>
</span>
<?php echo $t72_depositolap->field_caption->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t72_depositolap->field_index->Visible) { // field_index ?>
	<div id="r_field_index" class="form-group">
		<label id="elh_t72_depositolap_field_index" for="x_field_index" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_index->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_index->CellAttributes() ?>>
<span id="el_t72_depositolap_field_index">
<input type="text" data-table="t72_depositolap" data-field="x_field_index" name="x_field_index" id="x_field_index" size="5" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_index->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_index->EditValue ?>"<?php echo $t72_depositolap->field_index->EditAttributes() ?>>
</span>
<?php echo $t72_depositolap->field_index->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t72_depositolap->field_status->Visible) { // field_status ?>
	<div id="r_field_status" class="form-group">
		<label id="elh_t72_depositolap_field_status" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_status->CellAttributes() ?>>
<span id="el_t72_depositolap_field_status">
<div id="tp_x_field_status" class="ewTemplate"><input type="radio" data-table="t72_depositolap" data-field="x_field_status" data-value-separator="<?php echo $t72_depositolap->field_status->DisplayValueSeparatorAttribute() ?>" name="x_field_status" id="x_field_status" value="{value}"<?php echo $t72_depositolap->field_status->EditAttributes() ?>></div>
<div id="dsl_x_field_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t72_depositolap->field_status->RadioButtonListHtml(FALSE, "x_field_status") ?>
</div></div>
</span>
<?php echo $t72_depositolap->field_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t72_depositolap->field_align->Visible) { // field_align ?>
	<div id="r_field_align" class="form-group">
		<label id="elh_t72_depositolap_field_align" for="x_field_align" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_align->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_align->CellAttributes() ?>>
<span id="el_t72_depositolap_field_align">
<select data-table="t72_depositolap" data-field="x_field_align" data-value-separator="<?php echo $t72_depositolap->field_align->DisplayValueSeparatorAttribute() ?>" id="x_field_align" name="x_field_align"<?php echo $t72_depositolap->field_align->EditAttributes() ?>>
<?php echo $t72_depositolap->field_align->SelectOptionListHtml("x_field_align") ?>
</select>
</span>
<?php echo $t72_depositolap->field_align->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t72_depositolap->field_format->Visible) { // field_format ?>
	<div id="r_field_format" class="form-group">
		<label id="elh_t72_depositolap_field_format" for="x_field_format" class="col-sm-2 control-label ewLabel"><?php echo $t72_depositolap->field_format->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t72_depositolap->field_format->CellAttributes() ?>>
<span id="el_t72_depositolap_field_format">
<select data-table="t72_depositolap" data-field="x_field_format" data-value-separator="<?php echo $t72_depositolap->field_format->DisplayValueSeparatorAttribute() ?>" id="x_field_format" name="x_field_format"<?php echo $t72_depositolap->field_format->EditAttributes() ?>>
<?php echo $t72_depositolap->field_format->SelectOptionListHtml("x_field_format") ?>
</select>
</span>
<?php echo $t72_depositolap->field_format->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t72_depositolap" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t72_depositolap->id->CurrentValue) ?>">
<?php if (!$t72_depositolap_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t72_depositolap_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft72_depositolapedit.Init();
</script>
<?php
$t72_depositolap_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t72_depositolap_edit->Page_Terminate();
?>
