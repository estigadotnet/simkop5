<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t02_jaminaninfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t02_jaminan_add = NULL; // Initialize page object first

class ct02_jaminan_add extends ct02_jaminan {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't02_jaminan';

	// Page object name
	var $PageObjName = 't02_jaminan_add';

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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't02_jaminan', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

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
					$this->Page_Terminate("t02_jaminanlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t02_jaminanlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t02_jaminanview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
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
		$this->nasabah_id->CurrentValue = NULL;
		$this->nasabah_id->OldValue = $this->nasabah_id->CurrentValue;
		$this->Merk_Type->CurrentValue = NULL;
		$this->Merk_Type->OldValue = $this->Merk_Type->CurrentValue;
		$this->No_Rangka->CurrentValue = NULL;
		$this->No_Rangka->OldValue = $this->No_Rangka->CurrentValue;
		$this->No_Mesin->CurrentValue = NULL;
		$this->No_Mesin->OldValue = $this->No_Mesin->CurrentValue;
		$this->Warna->CurrentValue = NULL;
		$this->Warna->OldValue = $this->Warna->CurrentValue;
		$this->No_Pol->CurrentValue = NULL;
		$this->No_Pol->OldValue = $this->No_Pol->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->Atas_Nama->CurrentValue = NULL;
		$this->Atas_Nama->OldValue = $this->Atas_Nama->CurrentValue;
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
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->CurrentValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());

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

			// Add refer script
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// nasabah_id
		$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, FALSE);

		// Merk_Type
		$this->Merk_Type->SetDbValueDef($rsnew, $this->Merk_Type->CurrentValue, "", FALSE);

		// No_Rangka
		$this->No_Rangka->SetDbValueDef($rsnew, $this->No_Rangka->CurrentValue, NULL, FALSE);

		// No_Mesin
		$this->No_Mesin->SetDbValueDef($rsnew, $this->No_Mesin->CurrentValue, NULL, FALSE);

		// Warna
		$this->Warna->SetDbValueDef($rsnew, $this->Warna->CurrentValue, NULL, FALSE);

		// No_Pol
		$this->No_Pol->SetDbValueDef($rsnew, $this->No_Pol->CurrentValue, NULL, FALSE);

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, FALSE);

		// Atas_Nama
		$this->Atas_Nama->SetDbValueDef($rsnew, $this->Atas_Nama->CurrentValue, NULL, FALSE);

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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t02_jaminanlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t02_jaminan_add)) $t02_jaminan_add = new ct02_jaminan_add();

// Page init
$t02_jaminan_add->Page_Init();

// Page main
$t02_jaminan_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t02_jaminan_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft02_jaminanadd = new ew_Form("ft02_jaminanadd", "add");

// Validate form
ft02_jaminanadd.Validate = function() {
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
ft02_jaminanadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft02_jaminanadd.ValidateRequired = true;
<?php } else { ?>
ft02_jaminanadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t02_jaminan_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t02_jaminan_add->ShowPageHeader(); ?>
<?php
$t02_jaminan_add->ShowMessage();
?>
<form name="ft02_jaminanadd" id="ft02_jaminanadd" class="<?php echo $t02_jaminan_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t02_jaminan_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t02_jaminan_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t02_jaminan">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t02_jaminan_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t02_jaminan->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t02_jaminan_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t02_jaminan->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t02_jaminan->nasabah_id->CellAttributes() ?>>
<span id="el_t02_jaminan_nasabah_id">
<input type="text" data-table="t02_jaminan" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t02_jaminan->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t02_jaminan->nasabah_id->EditValue ?>"<?php echo $t02_jaminan->nasabah_id->EditAttributes() ?>>
</span>
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
<?php if (!$t02_jaminan_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t02_jaminan_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft02_jaminanadd.Init();
</script>
<?php
$t02_jaminan_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t02_jaminan_add->Page_Terminate();
?>
