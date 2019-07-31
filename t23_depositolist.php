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

$t23_deposito_list = NULL; // Initialize page object first

class ct23_deposito_list extends ct23_deposito {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't23_deposito';

	// Page object name
	var $PageObjName = 't23_deposito_list';

	// Grid form hidden field names
	var $FormName = 'ft23_depositolist';
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

		// Table object (t23_deposito)
		if (!isset($GLOBALS["t23_deposito"]) || get_class($GLOBALS["t23_deposito"]) == "ct23_deposito") {
			$GLOBALS["t23_deposito"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t23_deposito"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t23_depositoadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t23_depositodelete.php";
		$this->MultiUpdateUrl = "t23_depositoupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft23_depositolistsrch";

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
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->Kontrak_Lama->SetVisibility();
		$this->Deposito->SetVisibility();
		$this->Bunga_Suku->SetVisibility();
		$this->Bunga->SetVisibility();
		$this->nasabah_id->SetVisibility();

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

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

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

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->SearchWhere = $sFilter;
		}

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
		$this->Deposito->FormValue = ""; // Clear form value
		$this->Bunga_Suku->FormValue = ""; // Clear form value
		$this->Bunga->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
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

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "ft23_depositolistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_No->AdvancedSearch->ToJSON(), ","); // Field Kontrak_No
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_Tgl->AdvancedSearch->ToJSON(), ","); // Field Kontrak_Tgl
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_Lama->AdvancedSearch->ToJSON(), ","); // Field Kontrak_Lama
		$sFilterList = ew_Concat($sFilterList, $this->Jatuh_Tempo_Tgl->AdvancedSearch->ToJSON(), ","); // Field Jatuh_Tempo_Tgl
		$sFilterList = ew_Concat($sFilterList, $this->Deposito->AdvancedSearch->ToJSON(), ","); // Field Deposito
		$sFilterList = ew_Concat($sFilterList, $this->Bunga_Suku->AdvancedSearch->ToJSON(), ","); // Field Bunga_Suku
		$sFilterList = ew_Concat($sFilterList, $this->Bunga->AdvancedSearch->ToJSON(), ","); // Field Bunga
		$sFilterList = ew_Concat($sFilterList, $this->nasabah_id->AdvancedSearch->ToJSON(), ","); // Field nasabah_id
		$sFilterList = ew_Concat($sFilterList, $this->bank_id->AdvancedSearch->ToJSON(), ","); // Field bank_id
		$sFilterList = ew_Concat($sFilterList, $this->No_Ref->AdvancedSearch->ToJSON(), ","); // Field No_Ref
		$sFilterList = ew_Concat($sFilterList, $this->Biaya_Administrasi->AdvancedSearch->ToJSON(), ","); // Field Biaya_Administrasi
		$sFilterList = ew_Concat($sFilterList, $this->Biaya_Materai->AdvancedSearch->ToJSON(), ","); // Field Biaya_Materai
		$sFilterList = ew_Concat($sFilterList, $this->Periode->AdvancedSearch->ToJSON(), ","); // Field Periode
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_Status->AdvancedSearch->ToJSON(), ","); // Field Kontrak_Status
		$sFilterList = ew_Concat($sFilterList, $this->Jatuh_Tempo_Status->AdvancedSearch->ToJSON(), ","); // Field Jatuh_Tempo_Status
		$sFilterList = ew_Concat($sFilterList, $this->Bunga_Status->AdvancedSearch->ToJSON(), ","); // Field Bunga_Status
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = ew_StripSlashes(@$_POST["filters"]);
			$UserProfile->SetSearchFilters(CurrentUserName(), "ft23_depositolistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field Kontrak_No
		$this->Kontrak_No->AdvancedSearch->SearchValue = @$filter["x_Kontrak_No"];
		$this->Kontrak_No->AdvancedSearch->SearchOperator = @$filter["z_Kontrak_No"];
		$this->Kontrak_No->AdvancedSearch->SearchCondition = @$filter["v_Kontrak_No"];
		$this->Kontrak_No->AdvancedSearch->SearchValue2 = @$filter["y_Kontrak_No"];
		$this->Kontrak_No->AdvancedSearch->SearchOperator2 = @$filter["w_Kontrak_No"];
		$this->Kontrak_No->AdvancedSearch->Save();

		// Field Kontrak_Tgl
		$this->Kontrak_Tgl->AdvancedSearch->SearchValue = @$filter["x_Kontrak_Tgl"];
		$this->Kontrak_Tgl->AdvancedSearch->SearchOperator = @$filter["z_Kontrak_Tgl"];
		$this->Kontrak_Tgl->AdvancedSearch->SearchCondition = @$filter["v_Kontrak_Tgl"];
		$this->Kontrak_Tgl->AdvancedSearch->SearchValue2 = @$filter["y_Kontrak_Tgl"];
		$this->Kontrak_Tgl->AdvancedSearch->SearchOperator2 = @$filter["w_Kontrak_Tgl"];
		$this->Kontrak_Tgl->AdvancedSearch->Save();

		// Field Kontrak_Lama
		$this->Kontrak_Lama->AdvancedSearch->SearchValue = @$filter["x_Kontrak_Lama"];
		$this->Kontrak_Lama->AdvancedSearch->SearchOperator = @$filter["z_Kontrak_Lama"];
		$this->Kontrak_Lama->AdvancedSearch->SearchCondition = @$filter["v_Kontrak_Lama"];
		$this->Kontrak_Lama->AdvancedSearch->SearchValue2 = @$filter["y_Kontrak_Lama"];
		$this->Kontrak_Lama->AdvancedSearch->SearchOperator2 = @$filter["w_Kontrak_Lama"];
		$this->Kontrak_Lama->AdvancedSearch->Save();

		// Field Jatuh_Tempo_Tgl
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchValue = @$filter["x_Jatuh_Tempo_Tgl"];
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchOperator = @$filter["z_Jatuh_Tempo_Tgl"];
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchCondition = @$filter["v_Jatuh_Tempo_Tgl"];
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchValue2 = @$filter["y_Jatuh_Tempo_Tgl"];
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchOperator2 = @$filter["w_Jatuh_Tempo_Tgl"];
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->Save();

		// Field Deposito
		$this->Deposito->AdvancedSearch->SearchValue = @$filter["x_Deposito"];
		$this->Deposito->AdvancedSearch->SearchOperator = @$filter["z_Deposito"];
		$this->Deposito->AdvancedSearch->SearchCondition = @$filter["v_Deposito"];
		$this->Deposito->AdvancedSearch->SearchValue2 = @$filter["y_Deposito"];
		$this->Deposito->AdvancedSearch->SearchOperator2 = @$filter["w_Deposito"];
		$this->Deposito->AdvancedSearch->Save();

		// Field Bunga_Suku
		$this->Bunga_Suku->AdvancedSearch->SearchValue = @$filter["x_Bunga_Suku"];
		$this->Bunga_Suku->AdvancedSearch->SearchOperator = @$filter["z_Bunga_Suku"];
		$this->Bunga_Suku->AdvancedSearch->SearchCondition = @$filter["v_Bunga_Suku"];
		$this->Bunga_Suku->AdvancedSearch->SearchValue2 = @$filter["y_Bunga_Suku"];
		$this->Bunga_Suku->AdvancedSearch->SearchOperator2 = @$filter["w_Bunga_Suku"];
		$this->Bunga_Suku->AdvancedSearch->Save();

		// Field Bunga
		$this->Bunga->AdvancedSearch->SearchValue = @$filter["x_Bunga"];
		$this->Bunga->AdvancedSearch->SearchOperator = @$filter["z_Bunga"];
		$this->Bunga->AdvancedSearch->SearchCondition = @$filter["v_Bunga"];
		$this->Bunga->AdvancedSearch->SearchValue2 = @$filter["y_Bunga"];
		$this->Bunga->AdvancedSearch->SearchOperator2 = @$filter["w_Bunga"];
		$this->Bunga->AdvancedSearch->Save();

		// Field nasabah_id
		$this->nasabah_id->AdvancedSearch->SearchValue = @$filter["x_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchOperator = @$filter["z_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchCondition = @$filter["v_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchValue2 = @$filter["y_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchOperator2 = @$filter["w_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->Save();

		// Field bank_id
		$this->bank_id->AdvancedSearch->SearchValue = @$filter["x_bank_id"];
		$this->bank_id->AdvancedSearch->SearchOperator = @$filter["z_bank_id"];
		$this->bank_id->AdvancedSearch->SearchCondition = @$filter["v_bank_id"];
		$this->bank_id->AdvancedSearch->SearchValue2 = @$filter["y_bank_id"];
		$this->bank_id->AdvancedSearch->SearchOperator2 = @$filter["w_bank_id"];
		$this->bank_id->AdvancedSearch->Save();

		// Field No_Ref
		$this->No_Ref->AdvancedSearch->SearchValue = @$filter["x_No_Ref"];
		$this->No_Ref->AdvancedSearch->SearchOperator = @$filter["z_No_Ref"];
		$this->No_Ref->AdvancedSearch->SearchCondition = @$filter["v_No_Ref"];
		$this->No_Ref->AdvancedSearch->SearchValue2 = @$filter["y_No_Ref"];
		$this->No_Ref->AdvancedSearch->SearchOperator2 = @$filter["w_No_Ref"];
		$this->No_Ref->AdvancedSearch->Save();

		// Field Biaya_Administrasi
		$this->Biaya_Administrasi->AdvancedSearch->SearchValue = @$filter["x_Biaya_Administrasi"];
		$this->Biaya_Administrasi->AdvancedSearch->SearchOperator = @$filter["z_Biaya_Administrasi"];
		$this->Biaya_Administrasi->AdvancedSearch->SearchCondition = @$filter["v_Biaya_Administrasi"];
		$this->Biaya_Administrasi->AdvancedSearch->SearchValue2 = @$filter["y_Biaya_Administrasi"];
		$this->Biaya_Administrasi->AdvancedSearch->SearchOperator2 = @$filter["w_Biaya_Administrasi"];
		$this->Biaya_Administrasi->AdvancedSearch->Save();

		// Field Biaya_Materai
		$this->Biaya_Materai->AdvancedSearch->SearchValue = @$filter["x_Biaya_Materai"];
		$this->Biaya_Materai->AdvancedSearch->SearchOperator = @$filter["z_Biaya_Materai"];
		$this->Biaya_Materai->AdvancedSearch->SearchCondition = @$filter["v_Biaya_Materai"];
		$this->Biaya_Materai->AdvancedSearch->SearchValue2 = @$filter["y_Biaya_Materai"];
		$this->Biaya_Materai->AdvancedSearch->SearchOperator2 = @$filter["w_Biaya_Materai"];
		$this->Biaya_Materai->AdvancedSearch->Save();

		// Field Periode
		$this->Periode->AdvancedSearch->SearchValue = @$filter["x_Periode"];
		$this->Periode->AdvancedSearch->SearchOperator = @$filter["z_Periode"];
		$this->Periode->AdvancedSearch->SearchCondition = @$filter["v_Periode"];
		$this->Periode->AdvancedSearch->SearchValue2 = @$filter["y_Periode"];
		$this->Periode->AdvancedSearch->SearchOperator2 = @$filter["w_Periode"];
		$this->Periode->AdvancedSearch->Save();

		// Field Kontrak_Status
		$this->Kontrak_Status->AdvancedSearch->SearchValue = @$filter["x_Kontrak_Status"];
		$this->Kontrak_Status->AdvancedSearch->SearchOperator = @$filter["z_Kontrak_Status"];
		$this->Kontrak_Status->AdvancedSearch->SearchCondition = @$filter["v_Kontrak_Status"];
		$this->Kontrak_Status->AdvancedSearch->SearchValue2 = @$filter["y_Kontrak_Status"];
		$this->Kontrak_Status->AdvancedSearch->SearchOperator2 = @$filter["w_Kontrak_Status"];
		$this->Kontrak_Status->AdvancedSearch->Save();

		// Field Jatuh_Tempo_Status
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchValue = @$filter["x_Jatuh_Tempo_Status"];
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchOperator = @$filter["z_Jatuh_Tempo_Status"];
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchCondition = @$filter["v_Jatuh_Tempo_Status"];
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchValue2 = @$filter["y_Jatuh_Tempo_Status"];
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchOperator2 = @$filter["w_Jatuh_Tempo_Status"];
		$this->Jatuh_Tempo_Status->AdvancedSearch->Save();

		// Field Bunga_Status
		$this->Bunga_Status->AdvancedSearch->SearchValue = @$filter["x_Bunga_Status"];
		$this->Bunga_Status->AdvancedSearch->SearchOperator = @$filter["z_Bunga_Status"];
		$this->Bunga_Status->AdvancedSearch->SearchCondition = @$filter["v_Bunga_Status"];
		$this->Bunga_Status->AdvancedSearch->SearchValue2 = @$filter["y_Bunga_Status"];
		$this->Bunga_Status->AdvancedSearch->SearchOperator2 = @$filter["w_Bunga_Status"];
		$this->Bunga_Status->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->Kontrak_No, $Default, FALSE); // Kontrak_No
		$this->BuildSearchSql($sWhere, $this->Kontrak_Tgl, $Default, FALSE); // Kontrak_Tgl
		$this->BuildSearchSql($sWhere, $this->Kontrak_Lama, $Default, FALSE); // Kontrak_Lama
		$this->BuildSearchSql($sWhere, $this->Jatuh_Tempo_Tgl, $Default, FALSE); // Jatuh_Tempo_Tgl
		$this->BuildSearchSql($sWhere, $this->Deposito, $Default, FALSE); // Deposito
		$this->BuildSearchSql($sWhere, $this->Bunga_Suku, $Default, FALSE); // Bunga_Suku
		$this->BuildSearchSql($sWhere, $this->Bunga, $Default, FALSE); // Bunga
		$this->BuildSearchSql($sWhere, $this->nasabah_id, $Default, FALSE); // nasabah_id
		$this->BuildSearchSql($sWhere, $this->bank_id, $Default, FALSE); // bank_id
		$this->BuildSearchSql($sWhere, $this->No_Ref, $Default, FALSE); // No_Ref
		$this->BuildSearchSql($sWhere, $this->Biaya_Administrasi, $Default, FALSE); // Biaya_Administrasi
		$this->BuildSearchSql($sWhere, $this->Biaya_Materai, $Default, FALSE); // Biaya_Materai
		$this->BuildSearchSql($sWhere, $this->Periode, $Default, FALSE); // Periode
		$this->BuildSearchSql($sWhere, $this->Kontrak_Status, $Default, FALSE); // Kontrak_Status
		$this->BuildSearchSql($sWhere, $this->Jatuh_Tempo_Status, $Default, FALSE); // Jatuh_Tempo_Status
		$this->BuildSearchSql($sWhere, $this->Bunga_Status, $Default, FALSE); // Bunga_Status

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->Kontrak_No->AdvancedSearch->Save(); // Kontrak_No
			$this->Kontrak_Tgl->AdvancedSearch->Save(); // Kontrak_Tgl
			$this->Kontrak_Lama->AdvancedSearch->Save(); // Kontrak_Lama
			$this->Jatuh_Tempo_Tgl->AdvancedSearch->Save(); // Jatuh_Tempo_Tgl
			$this->Deposito->AdvancedSearch->Save(); // Deposito
			$this->Bunga_Suku->AdvancedSearch->Save(); // Bunga_Suku
			$this->Bunga->AdvancedSearch->Save(); // Bunga
			$this->nasabah_id->AdvancedSearch->Save(); // nasabah_id
			$this->bank_id->AdvancedSearch->Save(); // bank_id
			$this->No_Ref->AdvancedSearch->Save(); // No_Ref
			$this->Biaya_Administrasi->AdvancedSearch->Save(); // Biaya_Administrasi
			$this->Biaya_Materai->AdvancedSearch->Save(); // Biaya_Materai
			$this->Periode->AdvancedSearch->Save(); // Periode
			$this->Kontrak_Status->AdvancedSearch->Save(); // Kontrak_Status
			$this->Jatuh_Tempo_Status->AdvancedSearch->Save(); // Jatuh_Tempo_Status
			$this->Bunga_Status->AdvancedSearch->Save(); // Bunga_Status
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Kontrak_No->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Kontrak_Tgl->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Kontrak_Lama->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Jatuh_Tempo_Tgl->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Deposito->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bunga_Suku->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bunga->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->nasabah_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bank_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->No_Ref->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Biaya_Administrasi->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Biaya_Materai->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Periode->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Kontrak_Status->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Jatuh_Tempo_Status->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bunga_Status->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->id->AdvancedSearch->UnsetSession();
		$this->Kontrak_No->AdvancedSearch->UnsetSession();
		$this->Kontrak_Tgl->AdvancedSearch->UnsetSession();
		$this->Kontrak_Lama->AdvancedSearch->UnsetSession();
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->UnsetSession();
		$this->Deposito->AdvancedSearch->UnsetSession();
		$this->Bunga_Suku->AdvancedSearch->UnsetSession();
		$this->Bunga->AdvancedSearch->UnsetSession();
		$this->nasabah_id->AdvancedSearch->UnsetSession();
		$this->bank_id->AdvancedSearch->UnsetSession();
		$this->No_Ref->AdvancedSearch->UnsetSession();
		$this->Biaya_Administrasi->AdvancedSearch->UnsetSession();
		$this->Biaya_Materai->AdvancedSearch->UnsetSession();
		$this->Periode->AdvancedSearch->UnsetSession();
		$this->Kontrak_Status->AdvancedSearch->UnsetSession();
		$this->Jatuh_Tempo_Status->AdvancedSearch->UnsetSession();
		$this->Bunga_Status->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->Kontrak_No->AdvancedSearch->Load();
		$this->Kontrak_Tgl->AdvancedSearch->Load();
		$this->Kontrak_Lama->AdvancedSearch->Load();
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->Load();
		$this->Deposito->AdvancedSearch->Load();
		$this->Bunga_Suku->AdvancedSearch->Load();
		$this->Bunga->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->bank_id->AdvancedSearch->Load();
		$this->No_Ref->AdvancedSearch->Load();
		$this->Biaya_Administrasi->AdvancedSearch->Load();
		$this->Biaya_Materai->AdvancedSearch->Load();
		$this->Periode->AdvancedSearch->Load();
		$this->Kontrak_Status->AdvancedSearch->Load();
		$this->Jatuh_Tempo_Status->AdvancedSearch->Load();
		$this->Bunga_Status->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->Kontrak_No, $bCtrl); // Kontrak_No
			$this->UpdateSort($this->Kontrak_Tgl, $bCtrl); // Kontrak_Tgl
			$this->UpdateSort($this->Kontrak_Lama, $bCtrl); // Kontrak_Lama
			$this->UpdateSort($this->Deposito, $bCtrl); // Deposito
			$this->UpdateSort($this->Bunga_Suku, $bCtrl); // Bunga_Suku
			$this->UpdateSort($this->Bunga, $bCtrl); // Bunga
			$this->UpdateSort($this->nasabah_id, $bCtrl); // nasabah_id
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->Kontrak_No->setSort("");
				$this->Kontrak_Tgl->setSort("");
				$this->Kontrak_Lama->setSort("");
				$this->Deposito->setSort("");
				$this->Bunga_Suku->setSort("");
				$this->Bunga->setSort("");
				$this->nasabah_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

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

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;

		// "detail_t24_deposito_detail"
		$item = &$this->ListOptions->Add("detail_t24_deposito_detail");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't24_deposito_detail') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t24_deposito_detail_grid"])) $GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssStyle = "white-space: nowrap;";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("t24_deposito_detail");
		$this->DetailPages = $pages;

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

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->CanDelete())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_t24_deposito_detail"
		$oListOpt = &$this->ListOptions->Items["detail_t24_deposito_detail"];
		if ($Security->AllowList(CurrentProjectID() . 't24_deposito_detail')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t24_deposito_detail", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t24_deposito_detaillist.php?" . EW_TABLE_SHOW_MASTER . "=t23_deposito&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t24_deposito_detail_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't24_deposito_detail')) {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "t24_deposito_detail";
			}
			if ($GLOBALS["t24_deposito_detail_grid"]->DetailAdd && $Security->CanAdd() && $Security->AllowAdd(CurrentProjectID() . 't24_deposito_detail')) {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
				if ($DetailCopyTblVar <> "") $DetailCopyTblVar .= ",";
				$DetailCopyTblVar .= "t24_deposito_detail";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$option = $options["detail"];
		$DetailTableLink = "";
		$item = &$option->Add("detailadd_t24_deposito_detail");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["t24_deposito_detail"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t24_deposito_detail"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 't24_deposito_detail') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "t24_deposito_detail";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->Add("detailsadd");
			$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailTableLink);
			$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("AddMasterDetailLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddMasterDetailLink")) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $Language->Phrase("AddMasterDetailLink") . "</a>";
			$item->Visible = ($DetailTableLink <> "" && $Security->CanAdd());

			// Hide single master/detail items
			$ar = explode(",", $DetailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = &$option->GetItem("detailadd_" . $ar[$i]))
					$item->Visible = FALSE;
			}
		}
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft23_depositolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft23_depositolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft23_depositolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft23_depositolistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ResetSearch") . "\" data-caption=\"" . $Language->Phrase("ResetSearch") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ResetSearchBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

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
		$this->Kontrak_No->CurrentValue = NULL;
		$this->Kontrak_No->OldValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_Tgl->CurrentValue = NULL;
		$this->Kontrak_Tgl->OldValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Lama->CurrentValue = NULL;
		$this->Kontrak_Lama->OldValue = $this->Kontrak_Lama->CurrentValue;
		$this->Deposito->CurrentValue = NULL;
		$this->Deposito->OldValue = $this->Deposito->CurrentValue;
		$this->Bunga_Suku->CurrentValue = 12.00;
		$this->Bunga->CurrentValue = NULL;
		$this->Bunga->OldValue = $this->Bunga->CurrentValue;
		$this->nasabah_id->CurrentValue = NULL;
		$this->nasabah_id->OldValue = $this->nasabah_id->CurrentValue;
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		if ($this->id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Kontrak_No
		$this->Kontrak_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_No"]);
		if ($this->Kontrak_No->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_No->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_No"];

		// Kontrak_Tgl
		$this->Kontrak_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_Tgl"]);
		if ($this->Kontrak_Tgl->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_Tgl->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_Tgl"];

		// Kontrak_Lama
		$this->Kontrak_Lama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_Lama"]);
		if ($this->Kontrak_Lama->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_Lama->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_Lama"];

		// Jatuh_Tempo_Tgl
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Jatuh_Tempo_Tgl"]);
		if ($this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->SearchOperator = @$_GET["z_Jatuh_Tempo_Tgl"];

		// Deposito
		$this->Deposito->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Deposito"]);
		if ($this->Deposito->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Deposito->AdvancedSearch->SearchOperator = @$_GET["z_Deposito"];

		// Bunga_Suku
		$this->Bunga_Suku->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bunga_Suku"]);
		if ($this->Bunga_Suku->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bunga_Suku->AdvancedSearch->SearchOperator = @$_GET["z_Bunga_Suku"];

		// Bunga
		$this->Bunga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bunga"]);
		if ($this->Bunga->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bunga->AdvancedSearch->SearchOperator = @$_GET["z_Bunga"];

		// nasabah_id
		$this->nasabah_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nasabah_id"]);
		if ($this->nasabah_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->nasabah_id->AdvancedSearch->SearchOperator = @$_GET["z_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchCondition = @$_GET["v_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_nasabah_id"]);
		if ($this->nasabah_id->AdvancedSearch->SearchValue2 <> "") $this->Command = "search";
		$this->nasabah_id->AdvancedSearch->SearchOperator2 = @$_GET["w_nasabah_id"];

		// bank_id
		$this->bank_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bank_id"]);
		if ($this->bank_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->bank_id->AdvancedSearch->SearchOperator = @$_GET["z_bank_id"];
		if (is_array($this->bank_id->AdvancedSearch->SearchValue)) $this->bank_id->AdvancedSearch->SearchValue = implode(",", $this->bank_id->AdvancedSearch->SearchValue);
		if (is_array($this->bank_id->AdvancedSearch->SearchValue2)) $this->bank_id->AdvancedSearch->SearchValue2 = implode(",", $this->bank_id->AdvancedSearch->SearchValue2);

		// No_Ref
		$this->No_Ref->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_No_Ref"]);
		if ($this->No_Ref->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->No_Ref->AdvancedSearch->SearchOperator = @$_GET["z_No_Ref"];

		// Biaya_Administrasi
		$this->Biaya_Administrasi->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Biaya_Administrasi"]);
		if ($this->Biaya_Administrasi->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Biaya_Administrasi->AdvancedSearch->SearchOperator = @$_GET["z_Biaya_Administrasi"];

		// Biaya_Materai
		$this->Biaya_Materai->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Biaya_Materai"]);
		if ($this->Biaya_Materai->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Biaya_Materai->AdvancedSearch->SearchOperator = @$_GET["z_Biaya_Materai"];

		// Periode
		$this->Periode->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Periode"]);
		if ($this->Periode->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Periode->AdvancedSearch->SearchOperator = @$_GET["z_Periode"];

		// Kontrak_Status
		$this->Kontrak_Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_Status"]);
		if ($this->Kontrak_Status->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_Status->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_Status"];

		// Jatuh_Tempo_Status
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Jatuh_Tempo_Status"]);
		if ($this->Jatuh_Tempo_Status->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Jatuh_Tempo_Status->AdvancedSearch->SearchOperator = @$_GET["z_Jatuh_Tempo_Status"];

		// Bunga_Status
		$this->Bunga_Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bunga_Status"]);
		if ($this->Bunga_Status->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bunga_Status->AdvancedSearch->SearchOperator = @$_GET["z_Bunga_Status"];
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
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->Kontrak_No->CurrentValue = $this->Kontrak_No->FormValue;
		$this->Kontrak_Tgl->CurrentValue = $this->Kontrak_Tgl->FormValue;
		$this->Kontrak_Tgl->CurrentValue = ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7);
		$this->Kontrak_Lama->CurrentValue = $this->Kontrak_Lama->FormValue;
		$this->Deposito->CurrentValue = $this->Deposito->FormValue;
		$this->Bunga_Suku->CurrentValue = $this->Bunga_Suku->FormValue;
		$this->Bunga->CurrentValue = $this->Bunga->FormValue;
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->Deposito->FormValue == $this->Deposito->CurrentValue && is_numeric(ew_StrToFloat($this->Deposito->CurrentValue)))
			$this->Deposito->CurrentValue = ew_StrToFloat($this->Deposito->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga_Suku->FormValue == $this->Bunga_Suku->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga_Suku->CurrentValue)))
			$this->Bunga_Suku->CurrentValue = ew_StrToFloat($this->Bunga_Suku->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga->FormValue == $this->Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga->CurrentValue)))
			$this->Bunga->CurrentValue = ew_StrToFloat($this->Bunga->CurrentValue);

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
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// Edit refer script
			// Kontrak_No

			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";

			// Kontrak_Lama
			$this->Kontrak_Lama->LinkCustomAttributes = "";
			$this->Kontrak_Lama->HrefValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// Kontrak_No
			$this->Kontrak_No->EditAttrs["class"] = "form-control";
			$this->Kontrak_No->EditCustomAttributes = "";
			$this->Kontrak_No->EditValue = ew_HtmlEncode($this->Kontrak_No->AdvancedSearch->SearchValue);
			$this->Kontrak_No->PlaceHolder = ew_RemoveHtml($this->Kontrak_No->FldCaption());

			// Kontrak_Tgl
			$this->Kontrak_Tgl->EditAttrs["class"] = "form-control";
			$this->Kontrak_Tgl->EditCustomAttributes = "style='width: 115px;'";
			$this->Kontrak_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Kontrak_Tgl->AdvancedSearch->SearchValue, 7), 7));
			$this->Kontrak_Tgl->PlaceHolder = ew_RemoveHtml($this->Kontrak_Tgl->FldCaption());

			// Kontrak_Lama
			$this->Kontrak_Lama->EditAttrs["class"] = "form-control";
			$this->Kontrak_Lama->EditCustomAttributes = "";
			$this->Kontrak_Lama->EditValue = ew_HtmlEncode($this->Kontrak_Lama->AdvancedSearch->SearchValue);
			$this->Kontrak_Lama->PlaceHolder = ew_RemoveHtml($this->Kontrak_Lama->FldCaption());

			// Deposito
			$this->Deposito->EditAttrs["class"] = "form-control";
			$this->Deposito->EditCustomAttributes = "";
			$this->Deposito->EditValue = ew_HtmlEncode($this->Deposito->AdvancedSearch->SearchValue);
			$this->Deposito->PlaceHolder = ew_RemoveHtml($this->Deposito->FldCaption());

			// Bunga_Suku
			$this->Bunga_Suku->EditAttrs["class"] = "form-control";
			$this->Bunga_Suku->EditCustomAttributes = "";
			$this->Bunga_Suku->EditValue = ew_HtmlEncode($this->Bunga_Suku->AdvancedSearch->SearchValue);
			$this->Bunga_Suku->PlaceHolder = ew_RemoveHtml($this->Bunga_Suku->FldCaption());

			// Bunga
			$this->Bunga->EditAttrs["class"] = "form-control";
			$this->Bunga->EditCustomAttributes = "";
			$this->Bunga->EditValue = ew_HtmlEncode($this->Bunga->AdvancedSearch->SearchValue);
			$this->Bunga->PlaceHolder = ew_RemoveHtml($this->Bunga->FldCaption());

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue2 = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue2);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
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

			// Kontrak_No
			$this->Kontrak_No->SetDbValueDef($rsnew, $this->Kontrak_No->CurrentValue, "", $this->Kontrak_No->ReadOnly);

			// Kontrak_Tgl
			$this->Kontrak_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7), ew_CurrentDate(), $this->Kontrak_Tgl->ReadOnly);

			// Kontrak_Lama
			$this->Kontrak_Lama->SetDbValueDef($rsnew, $this->Kontrak_Lama->CurrentValue, 0, $this->Kontrak_Lama->ReadOnly);

			// Deposito
			$this->Deposito->SetDbValueDef($rsnew, $this->Deposito->CurrentValue, 0, $this->Deposito->ReadOnly);

			// Bunga_Suku
			$this->Bunga_Suku->SetDbValueDef($rsnew, $this->Bunga_Suku->CurrentValue, 0, $this->Bunga_Suku->ReadOnly);

			// Bunga
			$this->Bunga->SetDbValueDef($rsnew, $this->Bunga->CurrentValue, 0, $this->Bunga->ReadOnly);

			// nasabah_id
			$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, $this->nasabah_id->ReadOnly);

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

		// Kontrak_No
		$this->Kontrak_No->SetDbValueDef($rsnew, $this->Kontrak_No->CurrentValue, "", FALSE);

		// Kontrak_Tgl
		$this->Kontrak_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// Kontrak_Lama
		$this->Kontrak_Lama->SetDbValueDef($rsnew, $this->Kontrak_Lama->CurrentValue, 0, FALSE);

		// Deposito
		$this->Deposito->SetDbValueDef($rsnew, $this->Deposito->CurrentValue, 0, FALSE);

		// Bunga_Suku
		$this->Bunga_Suku->SetDbValueDef($rsnew, $this->Bunga_Suku->CurrentValue, 0, strval($this->Bunga_Suku->CurrentValue) == "");

		// Bunga
		$this->Bunga->SetDbValueDef($rsnew, $this->Bunga->CurrentValue, 0, FALSE);

		// nasabah_id
		$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, FALSE);

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

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->id->AdvancedSearch->Load();
		$this->Kontrak_No->AdvancedSearch->Load();
		$this->Kontrak_Tgl->AdvancedSearch->Load();
		$this->Kontrak_Lama->AdvancedSearch->Load();
		$this->Jatuh_Tempo_Tgl->AdvancedSearch->Load();
		$this->Deposito->AdvancedSearch->Load();
		$this->Bunga_Suku->AdvancedSearch->Load();
		$this->Bunga->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->bank_id->AdvancedSearch->Load();
		$this->No_Ref->AdvancedSearch->Load();
		$this->Biaya_Administrasi->AdvancedSearch->Load();
		$this->Biaya_Materai->AdvancedSearch->Load();
		$this->Periode->AdvancedSearch->Load();
		$this->Kontrak_Status->AdvancedSearch->Load();
		$this->Jatuh_Tempo_Status->AdvancedSearch->Load();
		$this->Bunga_Status->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_t23_deposito\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t23_deposito',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft23_depositolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if ($pageId == "list") {
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
			}
		} elseif ($pageId == "extbs") {
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
			}
		} 
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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

		$opt = &$this->ListOptions->Add("rincian_pembayaran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(0); // Move to first column
		$opt = &$this->ListOptions->Add("pembayaran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(1); // Move to first column
		$opt = &$this->ListOptions->Add("edit_pembayaran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(2); // Move to first column
		$this->ListOptions->Items["detail_t24_deposito_detail"]->Visible = false;
	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

		$deposito_id = $this->id->CurrentValue; //echo $deposito_id;
		$_SESSION["deposito_id"] = $deposito_id; //echo $_SESSION["deposito_id"];

		// $this->ListOptions->Items["print_x"]->Body = "<a href='./_custom_/print_x.php?id=".CurrentTable()->id->CurrentValue."'>Print X</a>";
		// check perubahan data master deposito
		// jika ada perubahan pada data master tapi sudah ada data pembayaran
		// maka perubahan harus tidak diperbolehkan

		if ($deposito_id <> "") {
			$q = "select * from t24_deposito_detail where
			deposito_id = ".$deposito_id." and Bayar_Jumlah <> 0"; //echo $q; //exit;
			$r = Conn()->Execute($q);
			if ($r->EOF) {
			}
			else {
				$this->ListOptions->Items["edit"]->Body = "";

				//$this->ListOptions->Items["delete"]->Body = "";
			}
			if ($this->Periode->CurrentValue <> $GLOBALS["Periode"]) {
				$this->ListOptions->Items["delete"]->Body = "";
			}
		}
		$t24_deposito_detail_id = 0;
		if ($deposito_id <> "") {

			//echo "-".$pinjaman_id;
			$t24_deposito_detail_id = f_cari_detail_pembayaran($deposito_id);
		}

		// cari pembayaran terbaru
		$t24_pembayaranbaru = 0;
		if ($deposito_id <> "") {

			//echo "-".$pinjaman_id;
			$t24_pembayaranbaru = f_caripembayaranbaru($deposito_id);
		}

		// $this->ListOptions->Items["rincian_angsuran"]->Body = "<a class=\"ewAddEdit ewAdd\" title=\"Rincian Angsuran\" data-caption=\"Rincian Angsuran\" href=\"t04_pinjamanangsurantemplist.php?showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."\"                          >Rincian Angsuran</a>"; // definisikan link, style, dan caption tombol //"xxx";
		// $this->ListOptions->Items["angsuran"]->Body         = "<a class=\"ewAddEdit ewAdd\" title=\"Bayar Angsuran\"   data-caption=\"Bayar Angsuran\"   href=\"t04_pinjamanangsurantempedit.php?id=".$t04_angsuranbaru."&showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."\" >Bayar Angsuran</a>";   // definisikan link, style, dan caption tombol //"xxx";
		//$this->ListOptions->Items["edit_angsuran"]->Body    = "<a class=\"ewAddEdit ewAdd\" title=\"Edit Angsuran\"    data-caption=\"Edit Angsuran\"    href=\"t04_pinjamanangsurantemplist.php?showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."&edit=1\"                   >Edit Angsuran</a>";    // definisikan link, style, dan caption tombol //"xxx";
		//$this->ListOptions->Items["titipan"]->Body          = "<a class=\"ewAddEdit ewAdd\" title=\"Setor Titipan\"    data-caption=\"Setor Titipan\"    href=\"t06_pinjamantitipanlist.php?showmaster=t03_pinjaman&fk_id=".$pinjaman_id."\"                                           >Setor Titipan</a>";    // definisikan link, style, dan caption tombol //"xxx";
		//$this->ListOptions->Items["potongan"]->Body         = "<a class=\"ewAddEdit ewAdd\" title=\"Potongan\"         data-caption=\"Potongan\"         href=\"t08_pinjamanpotonganlist.php?showmaster=t03_pinjaman&fk_id=".$pinjaman_id."\"                                          >Potongan</a>";         // definisikan link, style, dan caption tombol //"xxx";

		$this->ListOptions->Items["rincian_pembayaran"]->Body = "
			<a
				class=\"ewAddEdit ewAdd\"
				title=\"Rincian Pembayaran\"
				data-caption=\"Rincian Pembayaran\"
				href=\"t24_deposito_detaillist.php?showmaster=t23_deposito&fk_id=".$_SESSION["deposito_id"]."\"
				>
				Rincian Pembayaran
			</a>"; // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["pembayaran"]->Body = "
			<a
				class=\"ewAddEdit ewAdd\"
				title=\"Pembayaran\"
				data-caption=\"Pembayaran\"
				href=\"t24_deposito_detailedit.php?id=".$t24_pembayaranbaru."&showmaster=t23_deposito&fk_id=".$_SESSION["deposito_id"]."\"
				>
				Pembayaran
			</a>";   // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["edit_pembayaran"]->Body = "
			<a
				class=\"ewAddEdit ewAdd\"
				title=\"Edit Pembayaran\"
				data-caption=\"Edit Pembayaran\"
				href=\"t24_deposito_detaillist.php?showmaster=t23_deposito&fk_id=".$_SESSION["deposito_id"]."&edit=1\"
				>
				Edit Pembayaran
			</a>";    // definisikan link, style, dan caption tombol //"xxx";
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
if (!isset($t23_deposito_list)) $t23_deposito_list = new ct23_deposito_list();

// Page init
$t23_deposito_list->Page_Init();

// Page main
$t23_deposito_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t23_deposito_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t23_deposito->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft23_depositolist = new ew_Form("ft23_depositolist", "list");
ft23_depositolist.FormKeyCountName = '<?php echo $t23_deposito_list->FormKeyCountName ?>';

// Validate form
ft23_depositolist.Validate = function() {
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

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft23_depositolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft23_depositolist.ValidateRequired = true;
<?php } else { ?>
ft23_depositolist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft23_depositolist.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t22_peserta"};

// Form object for search
var CurrentSearchForm = ft23_depositolistsrch = new ew_Form("ft23_depositolistsrch");

// Validate function for search
ft23_depositolistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ft23_depositolistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft23_depositolistsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
ft23_depositolistsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
ft23_depositolistsrch.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t22_peserta"};
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t23_deposito->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t23_deposito->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($t23_deposito_list->TotalRecs > 0 && $t23_deposito_list->ExportOptions->Visible()) { ?>
<?php $t23_deposito_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t23_deposito_list->SearchOptions->Visible()) { ?>
<?php $t23_deposito_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($t23_deposito_list->FilterOptions->Visible()) { ?>
<?php $t23_deposito_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($t23_deposito->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $t23_deposito_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t23_deposito_list->TotalRecs <= 0)
			$t23_deposito_list->TotalRecs = $t23_deposito->SelectRecordCount();
	} else {
		if (!$t23_deposito_list->Recordset && ($t23_deposito_list->Recordset = $t23_deposito_list->LoadRecordset()))
			$t23_deposito_list->TotalRecs = $t23_deposito_list->Recordset->RecordCount();
	}
	$t23_deposito_list->StartRec = 1;
	if ($t23_deposito_list->DisplayRecs <= 0 || ($t23_deposito->Export <> "" && $t23_deposito->ExportAll)) // Display all records
		$t23_deposito_list->DisplayRecs = $t23_deposito_list->TotalRecs;
	if (!($t23_deposito->Export <> "" && $t23_deposito->ExportAll))
		$t23_deposito_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t23_deposito_list->Recordset = $t23_deposito_list->LoadRecordset($t23_deposito_list->StartRec-1, $t23_deposito_list->DisplayRecs);

	// Set no record found message
	if ($t23_deposito->CurrentAction == "" && $t23_deposito_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t23_deposito_list->setWarningMessage(ew_DeniedMsg());
		if ($t23_deposito_list->SearchWhere == "0=101")
			$t23_deposito_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t23_deposito_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($t23_deposito_list->AuditTrailOnSearch && $t23_deposito_list->Command == "search" && !$t23_deposito_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $t23_deposito_list->getSessionWhere();
		$t23_deposito_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$t23_deposito_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($t23_deposito->Export == "" && $t23_deposito->CurrentAction == "") { ?>
<form name="ft23_depositolistsrch" id="ft23_depositolistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($t23_deposito_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ft23_depositolistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t23_deposito">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$t23_deposito_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$t23_deposito->RowType = EW_ROWTYPE_SEARCH;

// Render row
$t23_deposito->ResetAttrs();
$t23_deposito_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
	<div id="xsc_Kontrak_No" class="ewCell form-group">
		<label for="x_Kontrak_No" class="ewSearchCaption ewLabel"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Kontrak_No" id="z_Kontrak_No" value="="></span>
		<span class="ewSearchField">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_No" name="x_Kontrak_No" id="x_Kontrak_No" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_No->EditValue ?>"<?php echo $t23_deposito->Kontrak_No->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<div id="xsc_nasabah_id" class="ewCell form-group">
		<label for="x_nasabah_id" class="ewSearchCaption ewLabel"><?php echo $t23_deposito->nasabah_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><select name="z_nasabah_id" id="z_nasabah_id" class="form-control" onchange="ewForms(this).SrchOprChanged(this);"><option value="="<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "=") ? " selected" : "" ?> ><?php echo $Language->Phrase("EQUAL") ?></option><option value="<>"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<>") ? " selected" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<") ? " selected" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<=") ? " selected" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == ">") ? " selected" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == ">=") ? " selected" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "NOT LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "STARTS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="ENDS WITH"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "ENDS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("ENDS WITH") ?></option><option value="BETWEEN"<?php echo ($t23_deposito->nasabah_id->AdvancedSearch->SearchOperator == "BETWEEN") ? " selected" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span>
		<span class="ewSearchField">
<input type="text" data-table="t23_deposito" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t23_deposito->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->nasabah_id->EditValue ?>"<?php echo $t23_deposito->nasabah_id->EditAttributes() ?>>
</span>
		<span class="ewSearchCond btw1_nasabah_id" style="display: none">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
		<span class="ewSearchField btw1_nasabah_id" style="display: none">
<input type="text" data-table="t23_deposito" data-field="x_nasabah_id" name="y_nasabah_id" id="y_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t23_deposito->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->nasabah_id->EditValue2 ?>"<?php echo $t23_deposito->nasabah_id->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t23_deposito_list->ShowPageHeader(); ?>
<?php
$t23_deposito_list->ShowMessage();
?>
<?php if ($t23_deposito_list->TotalRecs > 0 || $t23_deposito->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t23_deposito">
<form name="ft23_depositolist" id="ft23_depositolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t23_deposito_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t23_deposito_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t23_deposito">
<div id="gmp_t23_deposito" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t23_deposito_list->TotalRecs > 0 || $t23_deposito->CurrentAction == "gridedit") { ?>
<table id="tbl_t23_depositolist" class="table ewTable">
<?php echo $t23_deposito->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t23_deposito_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t23_deposito_list->RenderListOptions();

// Render list options (header, left)
$t23_deposito_list->ListOptions->Render("header", "left");
?>
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Kontrak_No) == "") { ?>
		<th data-name="Kontrak_No"><div id="elh_t23_deposito_Kontrak_No" class="t23_deposito_Kontrak_No"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_No"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Kontrak_No) ?>',2);"><div id="elh_t23_deposito_Kontrak_No" class="t23_deposito_Kontrak_No">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Kontrak_No->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Kontrak_No->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Kontrak_Tgl) == "") { ?>
		<th data-name="Kontrak_Tgl"><div id="elh_t23_deposito_Kontrak_Tgl" class="t23_deposito_Kontrak_Tgl"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_Tgl"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Kontrak_Tgl) ?>',2);"><div id="elh_t23_deposito_Kontrak_Tgl" class="t23_deposito_Kontrak_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Kontrak_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Kontrak_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Kontrak_Lama) == "") { ?>
		<th data-name="Kontrak_Lama"><div id="elh_t23_deposito_Kontrak_Lama" class="t23_deposito_Kontrak_Lama"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_Lama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Kontrak_Lama) ?>',2);"><div id="elh_t23_deposito_Kontrak_Lama" class="t23_deposito_Kontrak_Lama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Kontrak_Lama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Kontrak_Lama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Deposito) == "") { ?>
		<th data-name="Deposito"><div id="elh_t23_deposito_Deposito" class="t23_deposito_Deposito"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Deposito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Deposito"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Deposito) ?>',2);"><div id="elh_t23_deposito_Deposito" class="t23_deposito_Deposito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Deposito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Deposito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Deposito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Bunga_Suku) == "") { ?>
		<th data-name="Bunga_Suku"><div id="elh_t23_deposito_Bunga_Suku" class="t23_deposito_Bunga_Suku"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bunga_Suku"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Bunga_Suku) ?>',2);"><div id="elh_t23_deposito_Bunga_Suku" class="t23_deposito_Bunga_Suku">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Bunga_Suku->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Bunga_Suku->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->Bunga) == "") { ?>
		<th data-name="Bunga"><div id="elh_t23_deposito_Bunga" class="t23_deposito_Bunga"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->Bunga) ?>',2);"><div id="elh_t23_deposito_Bunga" class="t23_deposito_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t23_deposito->SortUrl($t23_deposito->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t23_deposito_nasabah_id" class="t23_deposito_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t23_deposito->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t23_deposito->SortUrl($t23_deposito->nasabah_id) ?>',2);"><div id="elh_t23_deposito_nasabah_id" class="t23_deposito_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t23_deposito->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t23_deposito->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t23_deposito->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t23_deposito_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t23_deposito->ExportAll && $t23_deposito->Export <> "") {
	$t23_deposito_list->StopRec = $t23_deposito_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t23_deposito_list->TotalRecs > $t23_deposito_list->StartRec + $t23_deposito_list->DisplayRecs - 1)
		$t23_deposito_list->StopRec = $t23_deposito_list->StartRec + $t23_deposito_list->DisplayRecs - 1;
	else
		$t23_deposito_list->StopRec = $t23_deposito_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t23_deposito_list->FormKeyCountName) && ($t23_deposito->CurrentAction == "gridadd" || $t23_deposito->CurrentAction == "gridedit" || $t23_deposito->CurrentAction == "F")) {
		$t23_deposito_list->KeyCount = $objForm->GetValue($t23_deposito_list->FormKeyCountName);
		$t23_deposito_list->StopRec = $t23_deposito_list->StartRec + $t23_deposito_list->KeyCount - 1;
	}
}
$t23_deposito_list->RecCnt = $t23_deposito_list->StartRec - 1;
if ($t23_deposito_list->Recordset && !$t23_deposito_list->Recordset->EOF) {
	$t23_deposito_list->Recordset->MoveFirst();
	$bSelectLimit = $t23_deposito_list->UseSelectLimit;
	if (!$bSelectLimit && $t23_deposito_list->StartRec > 1)
		$t23_deposito_list->Recordset->Move($t23_deposito_list->StartRec - 1);
} elseif (!$t23_deposito->AllowAddDeleteRow && $t23_deposito_list->StopRec == 0) {
	$t23_deposito_list->StopRec = $t23_deposito->GridAddRowCount;
}

// Initialize aggregate
$t23_deposito->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t23_deposito->ResetAttrs();
$t23_deposito_list->RenderRow();
$t23_deposito_list->EditRowCnt = 0;
if ($t23_deposito->CurrentAction == "edit")
	$t23_deposito_list->RowIndex = 1;
while ($t23_deposito_list->RecCnt < $t23_deposito_list->StopRec) {
	$t23_deposito_list->RecCnt++;
	if (intval($t23_deposito_list->RecCnt) >= intval($t23_deposito_list->StartRec)) {
		$t23_deposito_list->RowCnt++;

		// Set up key count
		$t23_deposito_list->KeyCount = $t23_deposito_list->RowIndex;

		// Init row class and style
		$t23_deposito->ResetAttrs();
		$t23_deposito->CssClass = "";
		if ($t23_deposito->CurrentAction == "gridadd") {
			$t23_deposito_list->LoadDefaultValues(); // Load default values
		} else {
			$t23_deposito_list->LoadRowValues($t23_deposito_list->Recordset); // Load row values
		}
		$t23_deposito->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t23_deposito->CurrentAction == "edit") {
			if ($t23_deposito_list->CheckInlineEditKey() && $t23_deposito_list->EditRowCnt == 0) { // Inline edit
				$t23_deposito->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t23_deposito->CurrentAction == "edit" && $t23_deposito->RowType == EW_ROWTYPE_EDIT && $t23_deposito->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t23_deposito_list->RestoreFormValues(); // Restore form values
		}
		if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t23_deposito_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t23_deposito->RowAttrs = array_merge($t23_deposito->RowAttrs, array('data-rowindex'=>$t23_deposito_list->RowCnt, 'id'=>'r' . $t23_deposito_list->RowCnt . '_t23_deposito', 'data-rowtype'=>$t23_deposito->RowType));

		// Render row
		$t23_deposito_list->RenderRow();

		// Render list options
		$t23_deposito_list->RenderListOptions();
?>
	<tr<?php echo $t23_deposito->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t23_deposito_list->ListOptions->Render("body", "left", $t23_deposito_list->RowCnt);
?>
	<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
		<td data-name="Kontrak_No"<?php echo $t23_deposito->Kontrak_No->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_No" class="form-group t23_deposito_Kontrak_No">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_No" name="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_No" id="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_No" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_No->EditValue ?>"<?php echo $t23_deposito->Kontrak_No->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_No" class="t23_deposito_Kontrak_No">
<span<?php echo $t23_deposito->Kontrak_No->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_No->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t23_deposito_list->PageObjName . "_row_" . $t23_deposito_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT || $t23_deposito->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t23_deposito" data-field="x_id" name="x<?php echo $t23_deposito_list->RowIndex ?>_id" id="x<?php echo $t23_deposito_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t23_deposito->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<td data-name="Kontrak_Tgl"<?php echo $t23_deposito->Kontrak_Tgl->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_Tgl" class="form-group t23_deposito_Kontrak_Tgl">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_Tgl" data-format="7" name="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_Tgl" id="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_Tgl" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_Tgl->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_Tgl->EditValue ?>"<?php echo $t23_deposito->Kontrak_Tgl->EditAttributes() ?>>
<?php if (!$t23_deposito->Kontrak_Tgl->ReadOnly && !$t23_deposito->Kontrak_Tgl->Disabled && !isset($t23_deposito->Kontrak_Tgl->EditAttrs["readonly"]) && !isset($t23_deposito->Kontrak_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft23_depositolist", "x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_Tgl", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_Tgl" class="t23_deposito_Kontrak_Tgl">
<span<?php echo $t23_deposito->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Tgl->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
		<td data-name="Kontrak_Lama"<?php echo $t23_deposito->Kontrak_Lama->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_Lama" class="form-group t23_deposito_Kontrak_Lama">
<input type="text" data-table="t23_deposito" data-field="x_Kontrak_Lama" name="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_Lama" id="x<?php echo $t23_deposito_list->RowIndex ?>_Kontrak_Lama" size="5" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Kontrak_Lama->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Kontrak_Lama->EditValue ?>"<?php echo $t23_deposito->Kontrak_Lama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Kontrak_Lama" class="t23_deposito_Kontrak_Lama">
<span<?php echo $t23_deposito->Kontrak_Lama->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Lama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
		<td data-name="Deposito"<?php echo $t23_deposito->Deposito->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Deposito" class="form-group t23_deposito_Deposito">
<input type="text" data-table="t23_deposito" data-field="x_Deposito" name="x<?php echo $t23_deposito_list->RowIndex ?>_Deposito" id="x<?php echo $t23_deposito_list->RowIndex ?>_Deposito" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Deposito->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Deposito->EditValue ?>"<?php echo $t23_deposito->Deposito->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Deposito" class="t23_deposito_Deposito">
<span<?php echo $t23_deposito->Deposito->ViewAttributes() ?>>
<?php echo $t23_deposito->Deposito->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
		<td data-name="Bunga_Suku"<?php echo $t23_deposito->Bunga_Suku->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Bunga_Suku" class="form-group t23_deposito_Bunga_Suku">
<input type="text" data-table="t23_deposito" data-field="x_Bunga_Suku" name="x<?php echo $t23_deposito_list->RowIndex ?>_Bunga_Suku" id="x<?php echo $t23_deposito_list->RowIndex ?>_Bunga_Suku" size="5" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Bunga_Suku->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Bunga_Suku->EditValue ?>"<?php echo $t23_deposito->Bunga_Suku->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Bunga_Suku" class="t23_deposito_Bunga_Suku">
<span<?php echo $t23_deposito->Bunga_Suku->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Suku->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
		<td data-name="Bunga"<?php echo $t23_deposito->Bunga->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Bunga" class="form-group t23_deposito_Bunga">
<input type="text" data-table="t23_deposito" data-field="x_Bunga" name="x<?php echo $t23_deposito_list->RowIndex ?>_Bunga" id="x<?php echo $t23_deposito_list->RowIndex ?>_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t23_deposito->Bunga->getPlaceHolder()) ?>" value="<?php echo $t23_deposito->Bunga->EditValue ?>"<?php echo $t23_deposito->Bunga->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_Bunga" class="t23_deposito_Bunga">
<span<?php echo $t23_deposito->Bunga->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t23_deposito->nasabah_id->CellAttributes() ?>>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_nasabah_id" class="form-group t23_deposito_nasabah_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id"><?php echo (strval($t23_deposito->nasabah_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t23_deposito->nasabah_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t23_deposito->nasabah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t23_deposito" data-field="x_nasabah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t23_deposito->nasabah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id" id="x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id" value="<?php echo $t23_deposito->nasabah_id->CurrentValue ?>"<?php echo $t23_deposito->nasabah_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id" id="s_x<?php echo $t23_deposito_list->RowIndex ?>_nasabah_id" value="<?php echo $t23_deposito->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t23_deposito_list->RowCnt ?>_t23_deposito_nasabah_id" class="t23_deposito_nasabah_id">
<span<?php echo $t23_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t23_deposito->nasabah_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t23_deposito_list->ListOptions->Render("body", "right", $t23_deposito_list->RowCnt);
?>
	</tr>
<?php if ($t23_deposito->RowType == EW_ROWTYPE_ADD || $t23_deposito->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft23_depositolist.UpdateOpts(<?php echo $t23_deposito_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($t23_deposito->CurrentAction <> "gridadd")
		$t23_deposito_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t23_deposito->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t23_deposito_list->FormKeyCountName ?>" id="<?php echo $t23_deposito_list->FormKeyCountName ?>" value="<?php echo $t23_deposito_list->KeyCount ?>">
<?php } ?>
<?php if ($t23_deposito->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t23_deposito_list->Recordset)
	$t23_deposito_list->Recordset->Close();
?>
<?php if ($t23_deposito->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t23_deposito->CurrentAction <> "gridadd" && $t23_deposito->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t23_deposito_list->Pager)) $t23_deposito_list->Pager = new cPrevNextPager($t23_deposito_list->StartRec, $t23_deposito_list->DisplayRecs, $t23_deposito_list->TotalRecs) ?>
<?php if ($t23_deposito_list->Pager->RecordCount > 0 && $t23_deposito_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t23_deposito_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t23_deposito_list->PageUrl() ?>start=<?php echo $t23_deposito_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t23_deposito_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t23_deposito_list->PageUrl() ?>start=<?php echo $t23_deposito_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t23_deposito_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t23_deposito_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t23_deposito_list->PageUrl() ?>start=<?php echo $t23_deposito_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t23_deposito_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t23_deposito_list->PageUrl() ?>start=<?php echo $t23_deposito_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t23_deposito_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t23_deposito_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t23_deposito_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t23_deposito_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t23_deposito_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $t23_deposito_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t23_deposito">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($t23_deposito_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t23_deposito_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($t23_deposito->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t23_deposito_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t23_deposito_list->TotalRecs == 0 && $t23_deposito->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t23_deposito_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t23_deposito->Export == "") { ?>
<script type="text/javascript">
ft23_depositolistsrch.FilterList = <?php echo $t23_deposito_list->GetFilterList() ?>;
ft23_depositolistsrch.Init();
ft23_depositolist.Init();
</script>
<?php } ?>
<?php
$t23_deposito_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t23_deposito->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

	$(document).ready(function() { 
		$("#z_nasabah_id option[value='LIKE']").attr('selected', 'selected'); 
	});
</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t23_deposito_list->Page_Terminate();
?>
