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

$t20_deposito_view = NULL; // Initialize page object first

class ct20_deposito_view extends ct20_deposito {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't20_deposito';

	// Page object name
	var $PageObjName = 't20_deposito_view';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		$KeyUrl = "";
		if (@$_GET["id"] <> "") {
			$this->RecKey["id"] = $_GET["id"];
			$KeyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
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
		if (!$Security->CanView()) {
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (@$_POST["id"] <> "") {
				$this->id->setFormValue($_POST["id"]);
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$sReturnUrl = "t20_depositolist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "t20_depositolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "t20_depositolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "',caption:'" . $addcaption . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "',caption:'" . $editcaption . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->CanEdit());

		// Copy
		$item = &$option->Add("copy");
		$copycaption = ew_HtmlTitle($Language->Phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->CopyUrl) . "',caption:'" . $copycaption . "'});\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl <> "" && $Security->CanAdd());

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_AddQueryStringToUrl($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->CanDelete());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		if ($this->AuditTrailOnView) $this->WriteAuditTrailOnView($row);
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
		$this->Periode->setDbValue($rs->fields('Periode'));
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
		$this->Periode->DbValue = $row['Periode'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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
		// Periode

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

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t20_depositolist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t20_deposito_view)) $t20_deposito_view = new ct20_deposito_view();

// Page init
$t20_deposito_view->Page_Init();

// Page main
$t20_deposito_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t20_deposito_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = ft20_depositoview = new ew_Form("ft20_depositoview", "view");

// Form_CustomValidate event
ft20_depositoview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft20_depositoview.ValidateRequired = true;
<?php } else { ?>
ft20_depositoview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft20_depositoview.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
ft20_depositoview.Lists["x_bank_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor","x_Pemilik","x_Bank",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t21_bank"};
ft20_depositoview.Lists["x_Dikredit_Diperpanjang"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositoview.Lists["x_Dikredit_Diperpanjang"].Options = <?php echo json_encode($t20_deposito->Dikredit_Diperpanjang->Options()) ?>;
ft20_depositoview.Lists["x_Tunai_Transfer"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositoview.Lists["x_Tunai_Transfer"].Options = <?php echo json_encode($t20_deposito->Tunai_Transfer->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if (!$t20_deposito_view->IsModal) { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php $t20_deposito_view->ExportOptions->Render("body") ?>
<?php
	foreach ($t20_deposito_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php if (!$t20_deposito_view->IsModal) { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php $t20_deposito_view->ShowPageHeader(); ?>
<?php
$t20_deposito_view->ShowMessage();
?>
<form name="ft20_depositoview" id="ft20_depositoview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t20_deposito_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t20_deposito_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t20_deposito">
<?php if ($t20_deposito_view->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<table class="table table-bordered table-striped ewViewTable">
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
	<tr id="r_No_Urut">
		<td><span id="elh_t20_deposito_No_Urut"><?php echo $t20_deposito->No_Urut->FldCaption() ?></span></td>
		<td data-name="No_Urut"<?php echo $t20_deposito->No_Urut->CellAttributes() ?>>
<span id="el_t20_deposito_No_Urut">
<span<?php echo $t20_deposito->No_Urut->ViewAttributes() ?>>
<?php echo $t20_deposito->No_Urut->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
	<tr id="r_Tanggal_Valuta">
		<td><span id="elh_t20_deposito_Tanggal_Valuta"><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?></span></td>
		<td data-name="Tanggal_Valuta"<?php echo $t20_deposito->Tanggal_Valuta->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Valuta">
<span<?php echo $t20_deposito->Tanggal_Valuta->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Valuta->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
	<tr id="r_Tanggal_Jatuh_Tempo">
		<td><span id="elh_t20_deposito_Tanggal_Jatuh_Tempo"><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?></span></td>
		<td data-name="Tanggal_Jatuh_Tempo"<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CellAttributes() ?>>
<span id="el_t20_deposito_Tanggal_Jatuh_Tempo">
<span<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<tr id="r_nasabah_id">
		<td><span id="elh_t20_deposito_nasabah_id"><?php echo $t20_deposito->nasabah_id->FldCaption() ?></span></td>
		<td data-name="nasabah_id"<?php echo $t20_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t20_deposito_nasabah_id">
<span<?php echo $t20_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t20_deposito->nasabah_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->bank_id->Visible) { // bank_id ?>
	<tr id="r_bank_id">
		<td><span id="elh_t20_deposito_bank_id"><?php echo $t20_deposito->bank_id->FldCaption() ?></span></td>
		<td data-name="bank_id"<?php echo $t20_deposito->bank_id->CellAttributes() ?>>
<span id="el_t20_deposito_bank_id">
<span<?php echo $t20_deposito->bank_id->ViewAttributes() ?>>
<?php echo $t20_deposito->bank_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
	<tr id="r_Jumlah_Deposito">
		<td><span id="elh_t20_deposito_Jumlah_Deposito"><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?></span></td>
		<td data-name="Jumlah_Deposito"<?php echo $t20_deposito->Jumlah_Deposito->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Deposito">
<span<?php echo $t20_deposito->Jumlah_Deposito->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Deposito->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Terbilang->Visible) { // Jumlah_Terbilang ?>
	<tr id="r_Jumlah_Terbilang">
		<td><span id="elh_t20_deposito_Jumlah_Terbilang"><?php echo $t20_deposito->Jumlah_Terbilang->FldCaption() ?></span></td>
		<td data-name="Jumlah_Terbilang"<?php echo $t20_deposito->Jumlah_Terbilang->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Terbilang">
<span<?php echo $t20_deposito->Jumlah_Terbilang->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Terbilang->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
	<tr id="r_Suku_Bunga">
		<td><span id="elh_t20_deposito_Suku_Bunga"><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?></span></td>
		<td data-name="Suku_Bunga"<?php echo $t20_deposito->Suku_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Suku_Bunga">
<span<?php echo $t20_deposito->Suku_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Suku_Bunga->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
	<tr id="r_Jumlah_Bunga">
		<td><span id="elh_t20_deposito_Jumlah_Bunga"><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?></span></td>
		<td data-name="Jumlah_Bunga"<?php echo $t20_deposito->Jumlah_Bunga->CellAttributes() ?>>
<span id="el_t20_deposito_Jumlah_Bunga">
<span<?php echo $t20_deposito->Jumlah_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Bunga->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
	<tr id="r_Dikredit_Diperpanjang">
		<td><span id="elh_t20_deposito_Dikredit_Diperpanjang"><?php echo $t20_deposito->Dikredit_Diperpanjang->FldCaption() ?></span></td>
		<td data-name="Dikredit_Diperpanjang"<?php echo $t20_deposito->Dikredit_Diperpanjang->CellAttributes() ?>>
<span id="el_t20_deposito_Dikredit_Diperpanjang">
<span<?php echo $t20_deposito->Dikredit_Diperpanjang->ViewAttributes() ?>>
<?php echo $t20_deposito->Dikredit_Diperpanjang->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
	<tr id="r_Tunai_Transfer">
		<td><span id="elh_t20_deposito_Tunai_Transfer"><?php echo $t20_deposito->Tunai_Transfer->FldCaption() ?></span></td>
		<td data-name="Tunai_Transfer"<?php echo $t20_deposito->Tunai_Transfer->CellAttributes() ?>>
<span id="el_t20_deposito_Tunai_Transfer">
<span<?php echo $t20_deposito->Tunai_Transfer->ViewAttributes() ?>>
<?php echo $t20_deposito->Tunai_Transfer->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<script type="text/javascript">
ft20_depositoview.Init();
</script>
<?php
$t20_deposito_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t20_deposito_view->Page_Terminate();
?>
