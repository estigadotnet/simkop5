<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t84_saldoawalinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t84_saldoawal_list = NULL; // Initialize page object first

class ct84_saldoawal_list extends ct84_saldoawal {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't84_saldoawal';

	// Page object name
	var $PageObjName = 't84_saldoawal_list';

	// Grid form hidden field names
	var $FormName = 'ft84_saldoawallist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Table object (t84_saldoawal)
		if (!isset($GLOBALS["t84_saldoawal"]) || get_class($GLOBALS["t84_saldoawal"]) == "ct84_saldoawal") {
			$GLOBALS["t84_saldoawal"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t84_saldoawal"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t84_saldoawaladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t84_saldoawaldelete.php";
		$this->MultiUpdateUrl = "t84_saldoawalupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't84_saldoawal', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ft84_saldoawallistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->Periode->SetVisibility();
		$this->Akun->SetVisibility();
		$this->Rekening->SetVisibility();
		$this->Debet->SetVisibility();
		$this->Kredit->SetVisibility();
		$this->Saldo->SetVisibility();

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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $t84_saldoawal;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t84_saldoawal);
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 100;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 100; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		$this->setKey("id", ""); // Clear inline edit key
		$this->Debet->FormValue = ""; // Clear form value
		$this->Kredit->FormValue = ""; // Clear form value
		$this->Saldo->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_Periode") && $objForm->HasValue("o_Periode") && $this->Periode->CurrentValue <> $this->Periode->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Akun") && $objForm->HasValue("o_Akun") && $this->Akun->CurrentValue <> $this->Akun->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Rekening") && $objForm->HasValue("o_Rekening") && $this->Rekening->CurrentValue <> $this->Rekening->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Debet") && $objForm->HasValue("o_Debet") && $this->Debet->CurrentValue <> $this->Debet->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Kredit") && $objForm->HasValue("o_Kredit") && $this->Kredit->CurrentValue <> $this->Kredit->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Saldo") && $objForm->HasValue("o_Saldo") && $this->Saldo->CurrentValue <> $this->Saldo->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->Periode, $bCtrl); // Periode
			$this->UpdateSort($this->Akun, $bCtrl); // Akun
			$this->UpdateSort($this->Rekening, $bCtrl); // Rekening
			$this->UpdateSort($this->Debet, $bCtrl); // Debet
			$this->UpdateSort($this->Kredit, $bCtrl); // Kredit
			$this->UpdateSort($this->Saldo, $bCtrl); // Saldo
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->Periode->setSort("");
				$this->Akun->setSort("");
				$this->Rekening->setSort("");
				$this->Debet->setSort("");
				$this->Kredit->setSort("");
				$this->Saldo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_GetHashUrl($this->PageName(), $this->PageObjName . "_row_" . $this->RowCnt) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_GetHashUrl($this->InlineEditUrl, $this->PageObjName . "_row_" . $this->RowCnt)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft84_saldoawallistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft84_saldoawallistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft84_saldoawallist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = FALSE;
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->Periode->CurrentValue = NULL;
		$this->Periode->OldValue = $this->Periode->CurrentValue;
		$this->Akun->CurrentValue = NULL;
		$this->Akun->OldValue = $this->Akun->CurrentValue;
		$this->Rekening->CurrentValue = NULL;
		$this->Rekening->OldValue = $this->Rekening->CurrentValue;
		$this->Debet->CurrentValue = 0.00;
		$this->Debet->OldValue = $this->Debet->CurrentValue;
		$this->Kredit->CurrentValue = 0.00;
		$this->Kredit->OldValue = $this->Kredit->CurrentValue;
		$this->Saldo->CurrentValue = 0.00;
		$this->Saldo->OldValue = $this->Saldo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Periode->FldIsDetailKey) {
			$this->Periode->setFormValue($objForm->GetValue("x_Periode"));
		}
		if (!$this->Akun->FldIsDetailKey) {
			$this->Akun->setFormValue($objForm->GetValue("x_Akun"));
		}
		if (!$this->Rekening->FldIsDetailKey) {
			$this->Rekening->setFormValue($objForm->GetValue("x_Rekening"));
		}
		if (!$this->Debet->FldIsDetailKey) {
			$this->Debet->setFormValue($objForm->GetValue("x_Debet"));
		}
		if (!$this->Kredit->FldIsDetailKey) {
			$this->Kredit->setFormValue($objForm->GetValue("x_Kredit"));
		}
		if (!$this->Saldo->FldIsDetailKey) {
			$this->Saldo->setFormValue($objForm->GetValue("x_Saldo"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->Periode->CurrentValue = $this->Periode->FormValue;
		$this->Akun->CurrentValue = $this->Akun->FormValue;
		$this->Rekening->CurrentValue = $this->Rekening->FormValue;
		$this->Debet->CurrentValue = $this->Debet->FormValue;
		$this->Kredit->CurrentValue = $this->Kredit->FormValue;
		$this->Saldo->CurrentValue = $this->Saldo->FormValue;
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
		$this->Periode->setDbValue($rs->fields('Periode'));
		$this->Akun->setDbValue($rs->fields('Akun'));
		$this->Rekening->setDbValue($rs->fields('Rekening'));
		$this->Debet->setDbValue($rs->fields('Debet'));
		$this->Kredit->setDbValue($rs->fields('Kredit'));
		$this->Saldo->setDbValue($rs->fields('Saldo'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Periode->DbValue = $row['Periode'];
		$this->Akun->DbValue = $row['Akun'];
		$this->Rekening->DbValue = $row['Rekening'];
		$this->Debet->DbValue = $row['Debet'];
		$this->Kredit->DbValue = $row['Kredit'];
		$this->Saldo->DbValue = $row['Saldo'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->Debet->FormValue == $this->Debet->CurrentValue && is_numeric(ew_StrToFloat($this->Debet->CurrentValue)))
			$this->Debet->CurrentValue = ew_StrToFloat($this->Debet->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Kredit->FormValue == $this->Kredit->CurrentValue && is_numeric(ew_StrToFloat($this->Kredit->CurrentValue)))
			$this->Kredit->CurrentValue = ew_StrToFloat($this->Kredit->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Saldo->FormValue == $this->Saldo->CurrentValue && is_numeric(ew_StrToFloat($this->Saldo->CurrentValue)))
			$this->Saldo->CurrentValue = ew_StrToFloat($this->Saldo->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Periode
		// Akun
		// Rekening
		// Debet
		// Kredit
		// Saldo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// Akun
		$this->Akun->ViewValue = $this->Akun->CurrentValue;
		$this->Akun->ViewCustomAttributes = "";

		// Rekening
		$this->Rekening->ViewValue = $this->Rekening->CurrentValue;
		$this->Rekening->ViewCustomAttributes = "";

		// Debet
		$this->Debet->ViewValue = $this->Debet->CurrentValue;
		$this->Debet->ViewValue = ew_FormatNumber($this->Debet->ViewValue, 2, -2, -2, -2);
		$this->Debet->CellCssStyle .= "text-align: right;";
		$this->Debet->ViewCustomAttributes = "";

		// Kredit
		$this->Kredit->ViewValue = $this->Kredit->CurrentValue;
		$this->Kredit->ViewValue = ew_FormatNumber($this->Kredit->ViewValue, 2, -2, -2, -2);
		$this->Kredit->CellCssStyle .= "text-align: right;";
		$this->Kredit->ViewCustomAttributes = "";

		// Saldo
		$this->Saldo->ViewValue = $this->Saldo->CurrentValue;
		$this->Saldo->ViewValue = ew_FormatNumber($this->Saldo->ViewValue, 2, -2, -2, -2);
		$this->Saldo->CellCssStyle .= "text-align: right;";
		$this->Saldo->ViewCustomAttributes = "";

			// Periode
			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";
			$this->Periode->TooltipValue = "";

			// Akun
			$this->Akun->LinkCustomAttributes = "";
			$this->Akun->HrefValue = "";
			$this->Akun->TooltipValue = "";

			// Rekening
			$this->Rekening->LinkCustomAttributes = "";
			$this->Rekening->HrefValue = "";
			$this->Rekening->TooltipValue = "";

			// Debet
			$this->Debet->LinkCustomAttributes = "";
			$this->Debet->HrefValue = "";
			$this->Debet->TooltipValue = "";

			// Kredit
			$this->Kredit->LinkCustomAttributes = "";
			$this->Kredit->HrefValue = "";
			$this->Kredit->TooltipValue = "";

			// Saldo
			$this->Saldo->LinkCustomAttributes = "";
			$this->Saldo->HrefValue = "";
			$this->Saldo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Periode
			$this->Periode->EditAttrs["class"] = "form-control";
			$this->Periode->EditCustomAttributes = "";
			$this->Periode->EditValue = ew_HtmlEncode($this->Periode->CurrentValue);
			$this->Periode->PlaceHolder = ew_RemoveHtml($this->Periode->FldCaption());

			// Akun
			$this->Akun->EditAttrs["class"] = "form-control";
			$this->Akun->EditCustomAttributes = "";
			$this->Akun->EditValue = ew_HtmlEncode($this->Akun->CurrentValue);
			$this->Akun->PlaceHolder = ew_RemoveHtml($this->Akun->FldCaption());

			// Rekening
			$this->Rekening->EditAttrs["class"] = "form-control";
			$this->Rekening->EditCustomAttributes = "";
			$this->Rekening->EditValue = ew_HtmlEncode($this->Rekening->CurrentValue);
			$this->Rekening->PlaceHolder = ew_RemoveHtml($this->Rekening->FldCaption());

			// Debet
			$this->Debet->EditAttrs["class"] = "form-control";
			$this->Debet->EditCustomAttributes = "";
			$this->Debet->EditValue = ew_HtmlEncode($this->Debet->CurrentValue);
			$this->Debet->PlaceHolder = ew_RemoveHtml($this->Debet->FldCaption());
			if (strval($this->Debet->EditValue) <> "" && is_numeric($this->Debet->EditValue)) $this->Debet->EditValue = ew_FormatNumber($this->Debet->EditValue, -2, -2, -2, -2);

			// Kredit
			$this->Kredit->EditAttrs["class"] = "form-control";
			$this->Kredit->EditCustomAttributes = "";
			$this->Kredit->EditValue = ew_HtmlEncode($this->Kredit->CurrentValue);
			$this->Kredit->PlaceHolder = ew_RemoveHtml($this->Kredit->FldCaption());
			if (strval($this->Kredit->EditValue) <> "" && is_numeric($this->Kredit->EditValue)) $this->Kredit->EditValue = ew_FormatNumber($this->Kredit->EditValue, -2, -2, -2, -2);

			// Saldo
			$this->Saldo->EditAttrs["class"] = "form-control";
			$this->Saldo->EditCustomAttributes = "";
			$this->Saldo->EditValue = ew_HtmlEncode($this->Saldo->CurrentValue);
			$this->Saldo->PlaceHolder = ew_RemoveHtml($this->Saldo->FldCaption());
			if (strval($this->Saldo->EditValue) <> "" && is_numeric($this->Saldo->EditValue)) $this->Saldo->EditValue = ew_FormatNumber($this->Saldo->EditValue, -2, -2, -2, -2);

			// Add refer script
			// Periode

			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";

			// Akun
			$this->Akun->LinkCustomAttributes = "";
			$this->Akun->HrefValue = "";

			// Rekening
			$this->Rekening->LinkCustomAttributes = "";
			$this->Rekening->HrefValue = "";

			// Debet
			$this->Debet->LinkCustomAttributes = "";
			$this->Debet->HrefValue = "";

			// Kredit
			$this->Kredit->LinkCustomAttributes = "";
			$this->Kredit->HrefValue = "";

			// Saldo
			$this->Saldo->LinkCustomAttributes = "";
			$this->Saldo->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Periode
			$this->Periode->EditAttrs["class"] = "form-control";
			$this->Periode->EditCustomAttributes = "";
			$this->Periode->EditValue = $this->Periode->CurrentValue;
			$this->Periode->ViewCustomAttributes = "";

			// Akun
			$this->Akun->EditAttrs["class"] = "form-control";
			$this->Akun->EditCustomAttributes = "";
			$this->Akun->EditValue = $this->Akun->CurrentValue;
			$this->Akun->ViewCustomAttributes = "";

			// Rekening
			$this->Rekening->EditAttrs["class"] = "form-control";
			$this->Rekening->EditCustomAttributes = "";
			$this->Rekening->EditValue = $this->Rekening->CurrentValue;
			$this->Rekening->ViewCustomAttributes = "";

			// Debet
			$this->Debet->EditAttrs["class"] = "form-control";
			$this->Debet->EditCustomAttributes = "";
			$this->Debet->EditValue = ew_HtmlEncode($this->Debet->CurrentValue);
			$this->Debet->PlaceHolder = ew_RemoveHtml($this->Debet->FldCaption());
			if (strval($this->Debet->EditValue) <> "" && is_numeric($this->Debet->EditValue)) $this->Debet->EditValue = ew_FormatNumber($this->Debet->EditValue, -2, -2, -2, -2);

			// Kredit
			$this->Kredit->EditAttrs["class"] = "form-control";
			$this->Kredit->EditCustomAttributes = "";
			$this->Kredit->EditValue = ew_HtmlEncode($this->Kredit->CurrentValue);
			$this->Kredit->PlaceHolder = ew_RemoveHtml($this->Kredit->FldCaption());
			if (strval($this->Kredit->EditValue) <> "" && is_numeric($this->Kredit->EditValue)) $this->Kredit->EditValue = ew_FormatNumber($this->Kredit->EditValue, -2, -2, -2, -2);

			// Saldo
			$this->Saldo->EditAttrs["class"] = "form-control";
			$this->Saldo->EditCustomAttributes = "";
			$this->Saldo->EditValue = ew_HtmlEncode($this->Saldo->CurrentValue);
			$this->Saldo->PlaceHolder = ew_RemoveHtml($this->Saldo->FldCaption());
			if (strval($this->Saldo->EditValue) <> "" && is_numeric($this->Saldo->EditValue)) $this->Saldo->EditValue = ew_FormatNumber($this->Saldo->EditValue, -2, -2, -2, -2);

			// Edit refer script
			// Periode

			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";
			$this->Periode->TooltipValue = "";

			// Akun
			$this->Akun->LinkCustomAttributes = "";
			$this->Akun->HrefValue = "";
			$this->Akun->TooltipValue = "";

			// Rekening
			$this->Rekening->LinkCustomAttributes = "";
			$this->Rekening->HrefValue = "";
			$this->Rekening->TooltipValue = "";

			// Debet
			$this->Debet->LinkCustomAttributes = "";
			$this->Debet->HrefValue = "";

			// Kredit
			$this->Kredit->LinkCustomAttributes = "";
			$this->Kredit->HrefValue = "";

			// Saldo
			$this->Saldo->LinkCustomAttributes = "";
			$this->Saldo->HrefValue = "";
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
		if (!$this->Periode->FldIsDetailKey && !is_null($this->Periode->FormValue) && $this->Periode->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Periode->FldCaption(), $this->Periode->ReqErrMsg));
		}
		if (!$this->Akun->FldIsDetailKey && !is_null($this->Akun->FormValue) && $this->Akun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Akun->FldCaption(), $this->Akun->ReqErrMsg));
		}
		if (!$this->Debet->FldIsDetailKey && !is_null($this->Debet->FormValue) && $this->Debet->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Debet->FldCaption(), $this->Debet->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Debet->FormValue)) {
			ew_AddMessage($gsFormError, $this->Debet->FldErrMsg());
		}
		if (!$this->Kredit->FldIsDetailKey && !is_null($this->Kredit->FormValue) && $this->Kredit->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kredit->FldCaption(), $this->Kredit->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Kredit->FormValue)) {
			ew_AddMessage($gsFormError, $this->Kredit->FldErrMsg());
		}
		if (!$this->Saldo->FldIsDetailKey && !is_null($this->Saldo->FormValue) && $this->Saldo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Saldo->FldCaption(), $this->Saldo->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Saldo->FormValue)) {
			ew_AddMessage($gsFormError, $this->Saldo->FldErrMsg());
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
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// Debet
			$this->Debet->SetDbValueDef($rsnew, $this->Debet->CurrentValue, 0, $this->Debet->ReadOnly);

			// Kredit
			$this->Kredit->SetDbValueDef($rsnew, $this->Kredit->CurrentValue, 0, $this->Kredit->ReadOnly);

			// Saldo
			$this->Saldo->SetDbValueDef($rsnew, $this->Saldo->CurrentValue, 0, $this->Saldo->ReadOnly);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// Periode
		$this->Periode->SetDbValueDef($rsnew, $this->Periode->CurrentValue, "", FALSE);

		// Akun
		$this->Akun->SetDbValueDef($rsnew, $this->Akun->CurrentValue, "", FALSE);

		// Rekening
		$this->Rekening->SetDbValueDef($rsnew, $this->Rekening->CurrentValue, NULL, FALSE);

		// Debet
		$this->Debet->SetDbValueDef($rsnew, $this->Debet->CurrentValue, 0, strval($this->Debet->CurrentValue) == "");

		// Kredit
		$this->Kredit->SetDbValueDef($rsnew, $this->Kredit->CurrentValue, 0, strval($this->Kredit->CurrentValue) == "");

		// Saldo
		$this->Saldo->SetDbValueDef($rsnew, $this->Saldo->CurrentValue, 0, strval($this->Saldo->CurrentValue) == "");

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

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_t84_saldoawal\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t84_saldoawal',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft84_saldoawallist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		$Doc->Export();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($t84_saldoawal_list)) $t84_saldoawal_list = new ct84_saldoawal_list();

// Page init
$t84_saldoawal_list->Page_Init();

// Page main
$t84_saldoawal_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t84_saldoawal_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t84_saldoawal->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft84_saldoawallist = new ew_Form("ft84_saldoawallist", "list");
ft84_saldoawallist.FormKeyCountName = '<?php echo $t84_saldoawal_list->FormKeyCountName ?>';

// Validate form
ft84_saldoawallist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Periode");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t84_saldoawal->Periode->FldCaption(), $t84_saldoawal->Periode->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Akun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t84_saldoawal->Akun->FldCaption(), $t84_saldoawal->Akun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Debet");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t84_saldoawal->Debet->FldCaption(), $t84_saldoawal->Debet->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Debet");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t84_saldoawal->Debet->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Kredit");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t84_saldoawal->Kredit->FldCaption(), $t84_saldoawal->Kredit->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kredit");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t84_saldoawal->Kredit->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Saldo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t84_saldoawal->Saldo->FldCaption(), $t84_saldoawal->Saldo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Saldo");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t84_saldoawal->Saldo->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft84_saldoawallist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft84_saldoawallist.ValidateRequired = true;
<?php } else { ?>
ft84_saldoawallist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t84_saldoawal->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t84_saldoawal->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($t84_saldoawal_list->TotalRecs > 0 && $t84_saldoawal_list->ExportOptions->Visible()) { ?>
<?php $t84_saldoawal_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t84_saldoawal->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $t84_saldoawal_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t84_saldoawal_list->TotalRecs <= 0)
			$t84_saldoawal_list->TotalRecs = $t84_saldoawal->SelectRecordCount();
	} else {
		if (!$t84_saldoawal_list->Recordset && ($t84_saldoawal_list->Recordset = $t84_saldoawal_list->LoadRecordset()))
			$t84_saldoawal_list->TotalRecs = $t84_saldoawal_list->Recordset->RecordCount();
	}
	$t84_saldoawal_list->StartRec = 1;
	if ($t84_saldoawal_list->DisplayRecs <= 0 || ($t84_saldoawal->Export <> "" && $t84_saldoawal->ExportAll)) // Display all records
		$t84_saldoawal_list->DisplayRecs = $t84_saldoawal_list->TotalRecs;
	if (!($t84_saldoawal->Export <> "" && $t84_saldoawal->ExportAll))
		$t84_saldoawal_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t84_saldoawal_list->Recordset = $t84_saldoawal_list->LoadRecordset($t84_saldoawal_list->StartRec-1, $t84_saldoawal_list->DisplayRecs);

	// Set no record found message
	if ($t84_saldoawal->CurrentAction == "" && $t84_saldoawal_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t84_saldoawal_list->setWarningMessage(ew_DeniedMsg());
		if ($t84_saldoawal_list->SearchWhere == "0=101")
			$t84_saldoawal_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t84_saldoawal_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t84_saldoawal_list->RenderOtherOptions();
?>
<?php $t84_saldoawal_list->ShowPageHeader(); ?>
<?php
$t84_saldoawal_list->ShowMessage();
?>
<?php if ($t84_saldoawal_list->TotalRecs > 0 || $t84_saldoawal->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t84_saldoawal">
<form name="ft84_saldoawallist" id="ft84_saldoawallist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t84_saldoawal_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t84_saldoawal_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t84_saldoawal">
<div id="gmp_t84_saldoawal" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t84_saldoawal_list->TotalRecs > 0 || $t84_saldoawal->CurrentAction == "gridedit") { ?>
<table id="tbl_t84_saldoawallist" class="table ewTable">
<?php echo $t84_saldoawal->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t84_saldoawal_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t84_saldoawal_list->RenderListOptions();

// Render list options (header, left)
$t84_saldoawal_list->ListOptions->Render("header", "left");
?>
<?php if ($t84_saldoawal->Periode->Visible) { // Periode ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Periode) == "") { ?>
		<th data-name="Periode"><div id="elh_t84_saldoawal_Periode" class="t84_saldoawal_Periode"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Periode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Periode"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Periode) ?>',2);"><div id="elh_t84_saldoawal_Periode" class="t84_saldoawal_Periode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Periode->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t84_saldoawal->Akun->Visible) { // Akun ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Akun) == "") { ?>
		<th data-name="Akun"><div id="elh_t84_saldoawal_Akun" class="t84_saldoawal_Akun"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Akun->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Akun"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Akun) ?>',2);"><div id="elh_t84_saldoawal_Akun" class="t84_saldoawal_Akun">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Akun->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Akun->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Akun->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t84_saldoawal->Rekening->Visible) { // Rekening ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Rekening) == "") { ?>
		<th data-name="Rekening"><div id="elh_t84_saldoawal_Rekening" class="t84_saldoawal_Rekening"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Rekening->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rekening"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Rekening) ?>',2);"><div id="elh_t84_saldoawal_Rekening" class="t84_saldoawal_Rekening">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Rekening->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Rekening->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Rekening->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t84_saldoawal->Debet->Visible) { // Debet ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Debet) == "") { ?>
		<th data-name="Debet"><div id="elh_t84_saldoawal_Debet" class="t84_saldoawal_Debet"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Debet->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Debet"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Debet) ?>',2);"><div id="elh_t84_saldoawal_Debet" class="t84_saldoawal_Debet">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Debet->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Debet->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Debet->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t84_saldoawal->Kredit->Visible) { // Kredit ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Kredit) == "") { ?>
		<th data-name="Kredit"><div id="elh_t84_saldoawal_Kredit" class="t84_saldoawal_Kredit"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Kredit->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kredit"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Kredit) ?>',2);"><div id="elh_t84_saldoawal_Kredit" class="t84_saldoawal_Kredit">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Kredit->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Kredit->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Kredit->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t84_saldoawal->Saldo->Visible) { // Saldo ?>
	<?php if ($t84_saldoawal->SortUrl($t84_saldoawal->Saldo) == "") { ?>
		<th data-name="Saldo"><div id="elh_t84_saldoawal_Saldo" class="t84_saldoawal_Saldo"><div class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Saldo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Saldo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t84_saldoawal->SortUrl($t84_saldoawal->Saldo) ?>',2);"><div id="elh_t84_saldoawal_Saldo" class="t84_saldoawal_Saldo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t84_saldoawal->Saldo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t84_saldoawal->Saldo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t84_saldoawal->Saldo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t84_saldoawal_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t84_saldoawal->ExportAll && $t84_saldoawal->Export <> "") {
	$t84_saldoawal_list->StopRec = $t84_saldoawal_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t84_saldoawal_list->TotalRecs > $t84_saldoawal_list->StartRec + $t84_saldoawal_list->DisplayRecs - 1)
		$t84_saldoawal_list->StopRec = $t84_saldoawal_list->StartRec + $t84_saldoawal_list->DisplayRecs - 1;
	else
		$t84_saldoawal_list->StopRec = $t84_saldoawal_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t84_saldoawal_list->FormKeyCountName) && ($t84_saldoawal->CurrentAction == "gridadd" || $t84_saldoawal->CurrentAction == "gridedit" || $t84_saldoawal->CurrentAction == "F")) {
		$t84_saldoawal_list->KeyCount = $objForm->GetValue($t84_saldoawal_list->FormKeyCountName);
		$t84_saldoawal_list->StopRec = $t84_saldoawal_list->StartRec + $t84_saldoawal_list->KeyCount - 1;
	}
}
$t84_saldoawal_list->RecCnt = $t84_saldoawal_list->StartRec - 1;
if ($t84_saldoawal_list->Recordset && !$t84_saldoawal_list->Recordset->EOF) {
	$t84_saldoawal_list->Recordset->MoveFirst();
	$bSelectLimit = $t84_saldoawal_list->UseSelectLimit;
	if (!$bSelectLimit && $t84_saldoawal_list->StartRec > 1)
		$t84_saldoawal_list->Recordset->Move($t84_saldoawal_list->StartRec - 1);
} elseif (!$t84_saldoawal->AllowAddDeleteRow && $t84_saldoawal_list->StopRec == 0) {
	$t84_saldoawal_list->StopRec = $t84_saldoawal->GridAddRowCount;
}

// Initialize aggregate
$t84_saldoawal->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t84_saldoawal->ResetAttrs();
$t84_saldoawal_list->RenderRow();
$t84_saldoawal_list->EditRowCnt = 0;
if ($t84_saldoawal->CurrentAction == "edit")
	$t84_saldoawal_list->RowIndex = 1;
if ($t84_saldoawal->CurrentAction == "gridedit")
	$t84_saldoawal_list->RowIndex = 0;
while ($t84_saldoawal_list->RecCnt < $t84_saldoawal_list->StopRec) {
	$t84_saldoawal_list->RecCnt++;
	if (intval($t84_saldoawal_list->RecCnt) >= intval($t84_saldoawal_list->StartRec)) {
		$t84_saldoawal_list->RowCnt++;
		if ($t84_saldoawal->CurrentAction == "gridadd" || $t84_saldoawal->CurrentAction == "gridedit" || $t84_saldoawal->CurrentAction == "F") {
			$t84_saldoawal_list->RowIndex++;
			$objForm->Index = $t84_saldoawal_list->RowIndex;
			if ($objForm->HasValue($t84_saldoawal_list->FormActionName))
				$t84_saldoawal_list->RowAction = strval($objForm->GetValue($t84_saldoawal_list->FormActionName));
			elseif ($t84_saldoawal->CurrentAction == "gridadd")
				$t84_saldoawal_list->RowAction = "insert";
			else
				$t84_saldoawal_list->RowAction = "";
		}

		// Set up key count
		$t84_saldoawal_list->KeyCount = $t84_saldoawal_list->RowIndex;

		// Init row class and style
		$t84_saldoawal->ResetAttrs();
		$t84_saldoawal->CssClass = "";
		if ($t84_saldoawal->CurrentAction == "gridadd") {
			$t84_saldoawal_list->LoadDefaultValues(); // Load default values
		} else {
			$t84_saldoawal_list->LoadRowValues($t84_saldoawal_list->Recordset); // Load row values
		}
		$t84_saldoawal->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t84_saldoawal->CurrentAction == "edit") {
			if ($t84_saldoawal_list->CheckInlineEditKey() && $t84_saldoawal_list->EditRowCnt == 0) { // Inline edit
				$t84_saldoawal->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t84_saldoawal->CurrentAction == "gridedit") { // Grid edit
			if ($t84_saldoawal->EventCancelled) {
				$t84_saldoawal_list->RestoreCurrentRowFormValues($t84_saldoawal_list->RowIndex); // Restore form values
			}
			if ($t84_saldoawal_list->RowAction == "insert")
				$t84_saldoawal->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t84_saldoawal->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t84_saldoawal->CurrentAction == "edit" && $t84_saldoawal->RowType == EW_ROWTYPE_EDIT && $t84_saldoawal->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t84_saldoawal_list->RestoreFormValues(); // Restore form values
		}
		if ($t84_saldoawal->CurrentAction == "gridedit" && ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT || $t84_saldoawal->RowType == EW_ROWTYPE_ADD) && $t84_saldoawal->EventCancelled) // Update failed
			$t84_saldoawal_list->RestoreCurrentRowFormValues($t84_saldoawal_list->RowIndex); // Restore form values
		if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t84_saldoawal_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t84_saldoawal->RowAttrs = array_merge($t84_saldoawal->RowAttrs, array('data-rowindex'=>$t84_saldoawal_list->RowCnt, 'id'=>'r' . $t84_saldoawal_list->RowCnt . '_t84_saldoawal', 'data-rowtype'=>$t84_saldoawal->RowType));

		// Render row
		$t84_saldoawal_list->RenderRow();

		// Render list options
		$t84_saldoawal_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t84_saldoawal_list->RowAction <> "delete" && $t84_saldoawal_list->RowAction <> "insertdelete" && !($t84_saldoawal_list->RowAction == "insert" && $t84_saldoawal->CurrentAction == "F" && $t84_saldoawal_list->EmptyRow())) {
?>
	<tr<?php echo $t84_saldoawal->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t84_saldoawal_list->ListOptions->Render("body", "left", $t84_saldoawal_list->RowCnt);
?>
	<?php if ($t84_saldoawal->Periode->Visible) { // Periode ?>
		<td data-name="Periode"<?php echo $t84_saldoawal->Periode->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Periode" class="form-group t84_saldoawal_Periode">
<input type="text" data-table="t84_saldoawal" data-field="x_Periode" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Periode->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Periode->EditValue ?>"<?php echo $t84_saldoawal->Periode->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Periode" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t84_saldoawal->Periode->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Periode" class="form-group t84_saldoawal_Periode">
<span<?php echo $t84_saldoawal->Periode->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t84_saldoawal->Periode->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Periode" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t84_saldoawal->Periode->CurrentValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Periode" class="t84_saldoawal_Periode">
<span<?php echo $t84_saldoawal->Periode->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Periode->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t84_saldoawal_list->PageObjName . "_row_" . $t84_saldoawal_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t84_saldoawal" data-field="x_id" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_id" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t84_saldoawal->id->CurrentValue) ?>">
<input type="hidden" data-table="t84_saldoawal" data-field="x_id" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_id" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t84_saldoawal->id->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT || $t84_saldoawal->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t84_saldoawal" data-field="x_id" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_id" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t84_saldoawal->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t84_saldoawal->Akun->Visible) { // Akun ?>
		<td data-name="Akun"<?php echo $t84_saldoawal->Akun->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Akun" class="form-group t84_saldoawal_Akun">
<input type="text" data-table="t84_saldoawal" data-field="x_Akun" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" size="30" maxlength="35" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Akun->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Akun->EditValue ?>"<?php echo $t84_saldoawal->Akun->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Akun" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" value="<?php echo ew_HtmlEncode($t84_saldoawal->Akun->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Akun" class="form-group t84_saldoawal_Akun">
<span<?php echo $t84_saldoawal->Akun->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t84_saldoawal->Akun->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Akun" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" value="<?php echo ew_HtmlEncode($t84_saldoawal->Akun->CurrentValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Akun" class="t84_saldoawal_Akun">
<span<?php echo $t84_saldoawal->Akun->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Akun->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Rekening->Visible) { // Rekening ?>
		<td data-name="Rekening"<?php echo $t84_saldoawal->Rekening->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Rekening" class="form-group t84_saldoawal_Rekening">
<input type="text" data-table="t84_saldoawal" data-field="x_Rekening" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" size="30" maxlength="90" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Rekening->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Rekening->EditValue ?>"<?php echo $t84_saldoawal->Rekening->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Rekening" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" value="<?php echo ew_HtmlEncode($t84_saldoawal->Rekening->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Rekening" class="form-group t84_saldoawal_Rekening">
<span<?php echo $t84_saldoawal->Rekening->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t84_saldoawal->Rekening->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Rekening" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" value="<?php echo ew_HtmlEncode($t84_saldoawal->Rekening->CurrentValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Rekening" class="t84_saldoawal_Rekening">
<span<?php echo $t84_saldoawal->Rekening->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Rekening->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Debet->Visible) { // Debet ?>
		<td data-name="Debet"<?php echo $t84_saldoawal->Debet->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Debet" class="form-group t84_saldoawal_Debet">
<input type="text" data-table="t84_saldoawal" data-field="x_Debet" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Debet->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Debet->EditValue ?>"<?php echo $t84_saldoawal->Debet->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Debet" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" value="<?php echo ew_HtmlEncode($t84_saldoawal->Debet->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Debet" class="form-group t84_saldoawal_Debet">
<input type="text" data-table="t84_saldoawal" data-field="x_Debet" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Debet->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Debet->EditValue ?>"<?php echo $t84_saldoawal->Debet->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Debet" class="t84_saldoawal_Debet">
<span<?php echo $t84_saldoawal->Debet->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Debet->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Kredit->Visible) { // Kredit ?>
		<td data-name="Kredit"<?php echo $t84_saldoawal->Kredit->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Kredit" class="form-group t84_saldoawal_Kredit">
<input type="text" data-table="t84_saldoawal" data-field="x_Kredit" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Kredit->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Kredit->EditValue ?>"<?php echo $t84_saldoawal->Kredit->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Kredit" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" value="<?php echo ew_HtmlEncode($t84_saldoawal->Kredit->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Kredit" class="form-group t84_saldoawal_Kredit">
<input type="text" data-table="t84_saldoawal" data-field="x_Kredit" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Kredit->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Kredit->EditValue ?>"<?php echo $t84_saldoawal->Kredit->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Kredit" class="t84_saldoawal_Kredit">
<span<?php echo $t84_saldoawal->Kredit->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Kredit->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Saldo->Visible) { // Saldo ?>
		<td data-name="Saldo"<?php echo $t84_saldoawal->Saldo->CellAttributes() ?>>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Saldo" class="form-group t84_saldoawal_Saldo">
<input type="text" data-table="t84_saldoawal" data-field="x_Saldo" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Saldo->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Saldo->EditValue ?>"<?php echo $t84_saldoawal->Saldo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Saldo" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" value="<?php echo ew_HtmlEncode($t84_saldoawal->Saldo->OldValue) ?>">
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Saldo" class="form-group t84_saldoawal_Saldo">
<input type="text" data-table="t84_saldoawal" data-field="x_Saldo" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Saldo->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Saldo->EditValue ?>"<?php echo $t84_saldoawal->Saldo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t84_saldoawal_list->RowCnt ?>_t84_saldoawal_Saldo" class="t84_saldoawal_Saldo">
<span<?php echo $t84_saldoawal->Saldo->ViewAttributes() ?>>
<?php echo $t84_saldoawal->Saldo->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t84_saldoawal_list->ListOptions->Render("body", "right", $t84_saldoawal_list->RowCnt);
?>
	</tr>
<?php if ($t84_saldoawal->RowType == EW_ROWTYPE_ADD || $t84_saldoawal->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft84_saldoawallist.UpdateOpts(<?php echo $t84_saldoawal_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t84_saldoawal->CurrentAction <> "gridadd")
		if (!$t84_saldoawal_list->Recordset->EOF) $t84_saldoawal_list->Recordset->MoveNext();
}
?>
<?php
	if ($t84_saldoawal->CurrentAction == "gridadd" || $t84_saldoawal->CurrentAction == "gridedit") {
		$t84_saldoawal_list->RowIndex = '$rowindex$';
		$t84_saldoawal_list->LoadDefaultValues();

		// Set row properties
		$t84_saldoawal->ResetAttrs();
		$t84_saldoawal->RowAttrs = array_merge($t84_saldoawal->RowAttrs, array('data-rowindex'=>$t84_saldoawal_list->RowIndex, 'id'=>'r0_t84_saldoawal', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t84_saldoawal->RowAttrs["class"], "ewTemplate");
		$t84_saldoawal->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t84_saldoawal_list->RenderRow();

		// Render list options
		$t84_saldoawal_list->RenderListOptions();
		$t84_saldoawal_list->StartRowCnt = 0;
?>
	<tr<?php echo $t84_saldoawal->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t84_saldoawal_list->ListOptions->Render("body", "left", $t84_saldoawal_list->RowIndex);
?>
	<?php if ($t84_saldoawal->Periode->Visible) { // Periode ?>
		<td data-name="Periode">
<span id="el$rowindex$_t84_saldoawal_Periode" class="form-group t84_saldoawal_Periode">
<input type="text" data-table="t84_saldoawal" data-field="x_Periode" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Periode->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Periode->EditValue ?>"<?php echo $t84_saldoawal->Periode->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Periode" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t84_saldoawal->Periode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Akun->Visible) { // Akun ?>
		<td data-name="Akun">
<span id="el$rowindex$_t84_saldoawal_Akun" class="form-group t84_saldoawal_Akun">
<input type="text" data-table="t84_saldoawal" data-field="x_Akun" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" size="30" maxlength="35" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Akun->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Akun->EditValue ?>"<?php echo $t84_saldoawal->Akun->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Akun" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Akun" value="<?php echo ew_HtmlEncode($t84_saldoawal->Akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Rekening->Visible) { // Rekening ?>
		<td data-name="Rekening">
<span id="el$rowindex$_t84_saldoawal_Rekening" class="form-group t84_saldoawal_Rekening">
<input type="text" data-table="t84_saldoawal" data-field="x_Rekening" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" size="30" maxlength="90" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Rekening->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Rekening->EditValue ?>"<?php echo $t84_saldoawal->Rekening->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Rekening" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Rekening" value="<?php echo ew_HtmlEncode($t84_saldoawal->Rekening->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Debet->Visible) { // Debet ?>
		<td data-name="Debet">
<span id="el$rowindex$_t84_saldoawal_Debet" class="form-group t84_saldoawal_Debet">
<input type="text" data-table="t84_saldoawal" data-field="x_Debet" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Debet->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Debet->EditValue ?>"<?php echo $t84_saldoawal->Debet->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Debet" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Debet" value="<?php echo ew_HtmlEncode($t84_saldoawal->Debet->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Kredit->Visible) { // Kredit ?>
		<td data-name="Kredit">
<span id="el$rowindex$_t84_saldoawal_Kredit" class="form-group t84_saldoawal_Kredit">
<input type="text" data-table="t84_saldoawal" data-field="x_Kredit" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Kredit->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Kredit->EditValue ?>"<?php echo $t84_saldoawal->Kredit->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Kredit" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Kredit" value="<?php echo ew_HtmlEncode($t84_saldoawal->Kredit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t84_saldoawal->Saldo->Visible) { // Saldo ?>
		<td data-name="Saldo">
<span id="el$rowindex$_t84_saldoawal_Saldo" class="form-group t84_saldoawal_Saldo">
<input type="text" data-table="t84_saldoawal" data-field="x_Saldo" name="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" id="x<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" size="15" placeholder="<?php echo ew_HtmlEncode($t84_saldoawal->Saldo->getPlaceHolder()) ?>" value="<?php echo $t84_saldoawal->Saldo->EditValue ?>"<?php echo $t84_saldoawal->Saldo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t84_saldoawal" data-field="x_Saldo" name="o<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" id="o<?php echo $t84_saldoawal_list->RowIndex ?>_Saldo" value="<?php echo ew_HtmlEncode($t84_saldoawal->Saldo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t84_saldoawal_list->ListOptions->Render("body", "right", $t84_saldoawal_list->RowCnt);
?>
<script type="text/javascript">
ft84_saldoawallist.UpdateOpts(<?php echo $t84_saldoawal_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t84_saldoawal->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t84_saldoawal_list->FormKeyCountName ?>" id="<?php echo $t84_saldoawal_list->FormKeyCountName ?>" value="<?php echo $t84_saldoawal_list->KeyCount ?>">
<?php } ?>
<?php if ($t84_saldoawal->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t84_saldoawal_list->FormKeyCountName ?>" id="<?php echo $t84_saldoawal_list->FormKeyCountName ?>" value="<?php echo $t84_saldoawal_list->KeyCount ?>">
<?php echo $t84_saldoawal_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t84_saldoawal->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t84_saldoawal_list->Recordset)
	$t84_saldoawal_list->Recordset->Close();
?>
<?php if ($t84_saldoawal->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t84_saldoawal->CurrentAction <> "gridadd" && $t84_saldoawal->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t84_saldoawal_list->Pager)) $t84_saldoawal_list->Pager = new cPrevNextPager($t84_saldoawal_list->StartRec, $t84_saldoawal_list->DisplayRecs, $t84_saldoawal_list->TotalRecs) ?>
<?php if ($t84_saldoawal_list->Pager->RecordCount > 0 && $t84_saldoawal_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t84_saldoawal_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t84_saldoawal_list->PageUrl() ?>start=<?php echo $t84_saldoawal_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t84_saldoawal_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t84_saldoawal_list->PageUrl() ?>start=<?php echo $t84_saldoawal_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t84_saldoawal_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t84_saldoawal_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t84_saldoawal_list->PageUrl() ?>start=<?php echo $t84_saldoawal_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t84_saldoawal_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t84_saldoawal_list->PageUrl() ?>start=<?php echo $t84_saldoawal_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t84_saldoawal_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t84_saldoawal_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t84_saldoawal_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t84_saldoawal_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t84_saldoawal_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $t84_saldoawal_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t84_saldoawal">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($t84_saldoawal_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t84_saldoawal_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($t84_saldoawal->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t84_saldoawal_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t84_saldoawal_list->TotalRecs == 0 && $t84_saldoawal->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t84_saldoawal_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t84_saldoawal->Export == "") { ?>
<script type="text/javascript">
ft84_saldoawallist.Init();
</script>
<?php } ?>
<?php
$t84_saldoawal_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t84_saldoawal->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t84_saldoawal_list->Page_Terminate();
?>
