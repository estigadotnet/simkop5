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

$t20_deposito_list = NULL; // Initialize page object first

class ct20_deposito_list extends ct20_deposito {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't20_deposito';

	// Page object name
	var $PageObjName = 't20_deposito_list';

	// Grid form hidden field names
	var $FormName = 'ft20_depositolist';
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

		// Table object (t20_deposito)
		if (!isset($GLOBALS["t20_deposito"]) || get_class($GLOBALS["t20_deposito"]) == "ct20_deposito") {
			$GLOBALS["t20_deposito"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t20_deposito"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t20_depositoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t20_depositodelete.php";
		$this->MultiUpdateUrl = "t20_depositoupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft20_depositolistsrch";

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
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "ft20_depositolistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->No_Urut->AdvancedSearch->ToJSON(), ","); // Field No_Urut
		$sFilterList = ew_Concat($sFilterList, $this->Tanggal_Valuta->AdvancedSearch->ToJSON(), ","); // Field Tanggal_Valuta
		$sFilterList = ew_Concat($sFilterList, $this->Tanggal_Jatuh_Tempo->AdvancedSearch->ToJSON(), ","); // Field Tanggal_Jatuh_Tempo
		$sFilterList = ew_Concat($sFilterList, $this->nasabah_id->AdvancedSearch->ToJSON(), ","); // Field nasabah_id
		$sFilterList = ew_Concat($sFilterList, $this->bank_id->AdvancedSearch->ToJSON(), ","); // Field bank_id
		$sFilterList = ew_Concat($sFilterList, $this->Jumlah_Deposito->AdvancedSearch->ToJSON(), ","); // Field Jumlah_Deposito
		$sFilterList = ew_Concat($sFilterList, $this->Jumlah_Terbilang->AdvancedSearch->ToJSON(), ","); // Field Jumlah_Terbilang
		$sFilterList = ew_Concat($sFilterList, $this->Suku_Bunga->AdvancedSearch->ToJSON(), ","); // Field Suku_Bunga
		$sFilterList = ew_Concat($sFilterList, $this->Jumlah_Bunga->AdvancedSearch->ToJSON(), ","); // Field Jumlah_Bunga
		$sFilterList = ew_Concat($sFilterList, $this->Dikredit_Diperpanjang->AdvancedSearch->ToJSON(), ","); // Field Dikredit_Diperpanjang
		$sFilterList = ew_Concat($sFilterList, $this->Tunai_Transfer->AdvancedSearch->ToJSON(), ","); // Field Tunai_Transfer
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "ft20_depositolistsrch", $filters);

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

		// Field No_Urut
		$this->No_Urut->AdvancedSearch->SearchValue = @$filter["x_No_Urut"];
		$this->No_Urut->AdvancedSearch->SearchOperator = @$filter["z_No_Urut"];
		$this->No_Urut->AdvancedSearch->SearchCondition = @$filter["v_No_Urut"];
		$this->No_Urut->AdvancedSearch->SearchValue2 = @$filter["y_No_Urut"];
		$this->No_Urut->AdvancedSearch->SearchOperator2 = @$filter["w_No_Urut"];
		$this->No_Urut->AdvancedSearch->Save();

		// Field Tanggal_Valuta
		$this->Tanggal_Valuta->AdvancedSearch->SearchValue = @$filter["x_Tanggal_Valuta"];
		$this->Tanggal_Valuta->AdvancedSearch->SearchOperator = @$filter["z_Tanggal_Valuta"];
		$this->Tanggal_Valuta->AdvancedSearch->SearchCondition = @$filter["v_Tanggal_Valuta"];
		$this->Tanggal_Valuta->AdvancedSearch->SearchValue2 = @$filter["y_Tanggal_Valuta"];
		$this->Tanggal_Valuta->AdvancedSearch->SearchOperator2 = @$filter["w_Tanggal_Valuta"];
		$this->Tanggal_Valuta->AdvancedSearch->Save();

		// Field Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchValue = @$filter["x_Tanggal_Jatuh_Tempo"];
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchOperator = @$filter["z_Tanggal_Jatuh_Tempo"];
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchCondition = @$filter["v_Tanggal_Jatuh_Tempo"];
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchValue2 = @$filter["y_Tanggal_Jatuh_Tempo"];
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchOperator2 = @$filter["w_Tanggal_Jatuh_Tempo"];
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->Save();

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

		// Field Jumlah_Deposito
		$this->Jumlah_Deposito->AdvancedSearch->SearchValue = @$filter["x_Jumlah_Deposito"];
		$this->Jumlah_Deposito->AdvancedSearch->SearchOperator = @$filter["z_Jumlah_Deposito"];
		$this->Jumlah_Deposito->AdvancedSearch->SearchCondition = @$filter["v_Jumlah_Deposito"];
		$this->Jumlah_Deposito->AdvancedSearch->SearchValue2 = @$filter["y_Jumlah_Deposito"];
		$this->Jumlah_Deposito->AdvancedSearch->SearchOperator2 = @$filter["w_Jumlah_Deposito"];
		$this->Jumlah_Deposito->AdvancedSearch->Save();

		// Field Jumlah_Terbilang
		$this->Jumlah_Terbilang->AdvancedSearch->SearchValue = @$filter["x_Jumlah_Terbilang"];
		$this->Jumlah_Terbilang->AdvancedSearch->SearchOperator = @$filter["z_Jumlah_Terbilang"];
		$this->Jumlah_Terbilang->AdvancedSearch->SearchCondition = @$filter["v_Jumlah_Terbilang"];
		$this->Jumlah_Terbilang->AdvancedSearch->SearchValue2 = @$filter["y_Jumlah_Terbilang"];
		$this->Jumlah_Terbilang->AdvancedSearch->SearchOperator2 = @$filter["w_Jumlah_Terbilang"];
		$this->Jumlah_Terbilang->AdvancedSearch->Save();

		// Field Suku_Bunga
		$this->Suku_Bunga->AdvancedSearch->SearchValue = @$filter["x_Suku_Bunga"];
		$this->Suku_Bunga->AdvancedSearch->SearchOperator = @$filter["z_Suku_Bunga"];
		$this->Suku_Bunga->AdvancedSearch->SearchCondition = @$filter["v_Suku_Bunga"];
		$this->Suku_Bunga->AdvancedSearch->SearchValue2 = @$filter["y_Suku_Bunga"];
		$this->Suku_Bunga->AdvancedSearch->SearchOperator2 = @$filter["w_Suku_Bunga"];
		$this->Suku_Bunga->AdvancedSearch->Save();

		// Field Jumlah_Bunga
		$this->Jumlah_Bunga->AdvancedSearch->SearchValue = @$filter["x_Jumlah_Bunga"];
		$this->Jumlah_Bunga->AdvancedSearch->SearchOperator = @$filter["z_Jumlah_Bunga"];
		$this->Jumlah_Bunga->AdvancedSearch->SearchCondition = @$filter["v_Jumlah_Bunga"];
		$this->Jumlah_Bunga->AdvancedSearch->SearchValue2 = @$filter["y_Jumlah_Bunga"];
		$this->Jumlah_Bunga->AdvancedSearch->SearchOperator2 = @$filter["w_Jumlah_Bunga"];
		$this->Jumlah_Bunga->AdvancedSearch->Save();

		// Field Dikredit_Diperpanjang
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchValue = @$filter["x_Dikredit_Diperpanjang"];
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchOperator = @$filter["z_Dikredit_Diperpanjang"];
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchCondition = @$filter["v_Dikredit_Diperpanjang"];
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchValue2 = @$filter["y_Dikredit_Diperpanjang"];
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchOperator2 = @$filter["w_Dikredit_Diperpanjang"];
		$this->Dikredit_Diperpanjang->AdvancedSearch->Save();

		// Field Tunai_Transfer
		$this->Tunai_Transfer->AdvancedSearch->SearchValue = @$filter["x_Tunai_Transfer"];
		$this->Tunai_Transfer->AdvancedSearch->SearchOperator = @$filter["z_Tunai_Transfer"];
		$this->Tunai_Transfer->AdvancedSearch->SearchCondition = @$filter["v_Tunai_Transfer"];
		$this->Tunai_Transfer->AdvancedSearch->SearchValue2 = @$filter["y_Tunai_Transfer"];
		$this->Tunai_Transfer->AdvancedSearch->SearchOperator2 = @$filter["w_Tunai_Transfer"];
		$this->Tunai_Transfer->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->No_Urut, $Default, FALSE); // No_Urut
		$this->BuildSearchSql($sWhere, $this->Tanggal_Valuta, $Default, FALSE); // Tanggal_Valuta
		$this->BuildSearchSql($sWhere, $this->Tanggal_Jatuh_Tempo, $Default, FALSE); // Tanggal_Jatuh_Tempo
		$this->BuildSearchSql($sWhere, $this->nasabah_id, $Default, FALSE); // nasabah_id
		$this->BuildSearchSql($sWhere, $this->bank_id, $Default, TRUE); // bank_id
		$this->BuildSearchSql($sWhere, $this->Jumlah_Deposito, $Default, FALSE); // Jumlah_Deposito
		$this->BuildSearchSql($sWhere, $this->Jumlah_Terbilang, $Default, FALSE); // Jumlah_Terbilang
		$this->BuildSearchSql($sWhere, $this->Suku_Bunga, $Default, FALSE); // Suku_Bunga
		$this->BuildSearchSql($sWhere, $this->Jumlah_Bunga, $Default, FALSE); // Jumlah_Bunga
		$this->BuildSearchSql($sWhere, $this->Dikredit_Diperpanjang, $Default, FALSE); // Dikredit_Diperpanjang
		$this->BuildSearchSql($sWhere, $this->Tunai_Transfer, $Default, FALSE); // Tunai_Transfer

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->No_Urut->AdvancedSearch->Save(); // No_Urut
			$this->Tanggal_Valuta->AdvancedSearch->Save(); // Tanggal_Valuta
			$this->Tanggal_Jatuh_Tempo->AdvancedSearch->Save(); // Tanggal_Jatuh_Tempo
			$this->nasabah_id->AdvancedSearch->Save(); // nasabah_id
			$this->bank_id->AdvancedSearch->Save(); // bank_id
			$this->Jumlah_Deposito->AdvancedSearch->Save(); // Jumlah_Deposito
			$this->Jumlah_Terbilang->AdvancedSearch->Save(); // Jumlah_Terbilang
			$this->Suku_Bunga->AdvancedSearch->Save(); // Suku_Bunga
			$this->Jumlah_Bunga->AdvancedSearch->Save(); // Jumlah_Bunga
			$this->Dikredit_Diperpanjang->AdvancedSearch->Save(); // Dikredit_Diperpanjang
			$this->Tunai_Transfer->AdvancedSearch->Save(); // Tunai_Transfer
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
		if ($this->No_Urut->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Tanggal_Valuta->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Tanggal_Jatuh_Tempo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->nasabah_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bank_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Jumlah_Deposito->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Jumlah_Terbilang->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Suku_Bunga->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Jumlah_Bunga->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Dikredit_Diperpanjang->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Tunai_Transfer->AdvancedSearch->IssetSession())
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
		$this->No_Urut->AdvancedSearch->UnsetSession();
		$this->Tanggal_Valuta->AdvancedSearch->UnsetSession();
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->UnsetSession();
		$this->nasabah_id->AdvancedSearch->UnsetSession();
		$this->bank_id->AdvancedSearch->UnsetSession();
		$this->Jumlah_Deposito->AdvancedSearch->UnsetSession();
		$this->Jumlah_Terbilang->AdvancedSearch->UnsetSession();
		$this->Suku_Bunga->AdvancedSearch->UnsetSession();
		$this->Jumlah_Bunga->AdvancedSearch->UnsetSession();
		$this->Dikredit_Diperpanjang->AdvancedSearch->UnsetSession();
		$this->Tunai_Transfer->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->No_Urut->AdvancedSearch->Load();
		$this->Tanggal_Valuta->AdvancedSearch->Load();
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->bank_id->AdvancedSearch->Load();
		$this->Jumlah_Deposito->AdvancedSearch->Load();
		$this->Jumlah_Terbilang->AdvancedSearch->Load();
		$this->Suku_Bunga->AdvancedSearch->Load();
		$this->Jumlah_Bunga->AdvancedSearch->Load();
		$this->Dikredit_Diperpanjang->AdvancedSearch->Load();
		$this->Tunai_Transfer->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->No_Urut, $bCtrl); // No_Urut
			$this->UpdateSort($this->Tanggal_Valuta, $bCtrl); // Tanggal_Valuta
			$this->UpdateSort($this->Tanggal_Jatuh_Tempo, $bCtrl); // Tanggal_Jatuh_Tempo
			$this->UpdateSort($this->nasabah_id, $bCtrl); // nasabah_id
			$this->UpdateSort($this->bank_id, $bCtrl); // bank_id
			$this->UpdateSort($this->Jumlah_Deposito, $bCtrl); // Jumlah_Deposito
			$this->UpdateSort($this->Jumlah_Terbilang, $bCtrl); // Jumlah_Terbilang
			$this->UpdateSort($this->Suku_Bunga, $bCtrl); // Suku_Bunga
			$this->UpdateSort($this->Jumlah_Bunga, $bCtrl); // Jumlah_Bunga
			$this->UpdateSort($this->Dikredit_Diperpanjang, $bCtrl); // Dikredit_Diperpanjang
			$this->UpdateSort($this->Tunai_Transfer, $bCtrl); // Tunai_Transfer
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
				$this->No_Urut->setSort("");
				$this->Tanggal_Valuta->setSort("");
				$this->Tanggal_Jatuh_Tempo->setSort("");
				$this->nasabah_id->setSort("");
				$this->bank_id->setSort("");
				$this->Jumlah_Deposito->setSort("");
				$this->Jumlah_Terbilang->setSort("");
				$this->Suku_Bunga->setSort("");
				$this->Jumlah_Bunga->setSort("");
				$this->Dikredit_Diperpanjang->setSort("");
				$this->Tunai_Transfer->setSort("");
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

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

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

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft20_depositolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft20_depositolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft20_depositolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft20_depositolistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		if ($this->id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// No_Urut
		$this->No_Urut->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_No_Urut"]);
		if ($this->No_Urut->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->No_Urut->AdvancedSearch->SearchOperator = @$_GET["z_No_Urut"];

		// Tanggal_Valuta
		$this->Tanggal_Valuta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Tanggal_Valuta"]);
		if ($this->Tanggal_Valuta->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Tanggal_Valuta->AdvancedSearch->SearchOperator = @$_GET["z_Tanggal_Valuta"];

		// Tanggal_Jatuh_Tempo
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Tanggal_Jatuh_Tempo"]);
		if ($this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchOperator = @$_GET["z_Tanggal_Jatuh_Tempo"];

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

		// Jumlah_Deposito
		$this->Jumlah_Deposito->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Jumlah_Deposito"]);
		if ($this->Jumlah_Deposito->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Jumlah_Deposito->AdvancedSearch->SearchOperator = @$_GET["z_Jumlah_Deposito"];

		// Jumlah_Terbilang
		$this->Jumlah_Terbilang->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Jumlah_Terbilang"]);
		if ($this->Jumlah_Terbilang->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Jumlah_Terbilang->AdvancedSearch->SearchOperator = @$_GET["z_Jumlah_Terbilang"];

		// Suku_Bunga
		$this->Suku_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Suku_Bunga"]);
		if ($this->Suku_Bunga->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Suku_Bunga->AdvancedSearch->SearchOperator = @$_GET["z_Suku_Bunga"];

		// Jumlah_Bunga
		$this->Jumlah_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Jumlah_Bunga"]);
		if ($this->Jumlah_Bunga->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Jumlah_Bunga->AdvancedSearch->SearchOperator = @$_GET["z_Jumlah_Bunga"];

		// Dikredit_Diperpanjang
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Dikredit_Diperpanjang"]);
		if ($this->Dikredit_Diperpanjang->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Dikredit_Diperpanjang->AdvancedSearch->SearchOperator = @$_GET["z_Dikredit_Diperpanjang"];

		// Tunai_Transfer
		$this->Tunai_Transfer->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Tunai_Transfer"]);
		if ($this->Tunai_Transfer->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Tunai_Transfer->AdvancedSearch->SearchOperator = @$_GET["z_Tunai_Transfer"];
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// No_Urut
			$this->No_Urut->EditAttrs["class"] = "form-control";
			$this->No_Urut->EditCustomAttributes = "";
			$this->No_Urut->EditValue = ew_HtmlEncode($this->No_Urut->AdvancedSearch->SearchValue);
			$this->No_Urut->PlaceHolder = ew_RemoveHtml($this->No_Urut->FldCaption());

			// Tanggal_Valuta
			$this->Tanggal_Valuta->EditAttrs["class"] = "form-control";
			$this->Tanggal_Valuta->EditCustomAttributes = "style='width: 112px;''";
			$this->Tanggal_Valuta->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Tanggal_Valuta->AdvancedSearch->SearchValue, 7), 7));
			$this->Tanggal_Valuta->PlaceHolder = ew_RemoveHtml($this->Tanggal_Valuta->FldCaption());

			// Tanggal_Jatuh_Tempo
			$this->Tanggal_Jatuh_Tempo->EditAttrs["class"] = "form-control";
			$this->Tanggal_Jatuh_Tempo->EditCustomAttributes = "style='width: 112px;''";
			$this->Tanggal_Jatuh_Tempo->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Tanggal_Jatuh_Tempo->AdvancedSearch->SearchValue, 7), 7));
			$this->Tanggal_Jatuh_Tempo->PlaceHolder = ew_RemoveHtml($this->Tanggal_Jatuh_Tempo->FldCaption());

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue2 = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue2);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());

			// bank_id
			$this->bank_id->EditCustomAttributes = "";

			// Jumlah_Deposito
			$this->Jumlah_Deposito->EditAttrs["class"] = "form-control";
			$this->Jumlah_Deposito->EditCustomAttributes = "";
			$this->Jumlah_Deposito->EditValue = ew_HtmlEncode($this->Jumlah_Deposito->AdvancedSearch->SearchValue);
			$this->Jumlah_Deposito->PlaceHolder = ew_RemoveHtml($this->Jumlah_Deposito->FldCaption());

			// Jumlah_Terbilang
			$this->Jumlah_Terbilang->EditAttrs["class"] = "form-control";
			$this->Jumlah_Terbilang->EditCustomAttributes = "";
			$this->Jumlah_Terbilang->EditValue = ew_HtmlEncode($this->Jumlah_Terbilang->AdvancedSearch->SearchValue);
			$this->Jumlah_Terbilang->PlaceHolder = ew_RemoveHtml($this->Jumlah_Terbilang->FldCaption());

			// Suku_Bunga
			$this->Suku_Bunga->EditAttrs["class"] = "form-control";
			$this->Suku_Bunga->EditCustomAttributes = "";
			$this->Suku_Bunga->EditValue = ew_HtmlEncode($this->Suku_Bunga->AdvancedSearch->SearchValue);
			$this->Suku_Bunga->PlaceHolder = ew_RemoveHtml($this->Suku_Bunga->FldCaption());

			// Jumlah_Bunga
			$this->Jumlah_Bunga->EditAttrs["class"] = "form-control";
			$this->Jumlah_Bunga->EditCustomAttributes = "";
			$this->Jumlah_Bunga->EditValue = ew_HtmlEncode($this->Jumlah_Bunga->AdvancedSearch->SearchValue);
			$this->Jumlah_Bunga->PlaceHolder = ew_RemoveHtml($this->Jumlah_Bunga->FldCaption());

			// Dikredit_Diperpanjang
			$this->Dikredit_Diperpanjang->EditCustomAttributes = "";
			$this->Dikredit_Diperpanjang->EditValue = $this->Dikredit_Diperpanjang->Options(FALSE);

			// Tunai_Transfer
			$this->Tunai_Transfer->EditCustomAttributes = "";
			$this->Tunai_Transfer->EditValue = $this->Tunai_Transfer->Options(FALSE);
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

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->id->AdvancedSearch->Load();
		$this->No_Urut->AdvancedSearch->Load();
		$this->Tanggal_Valuta->AdvancedSearch->Load();
		$this->Tanggal_Jatuh_Tempo->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->bank_id->AdvancedSearch->Load();
		$this->Jumlah_Deposito->AdvancedSearch->Load();
		$this->Jumlah_Terbilang->AdvancedSearch->Load();
		$this->Suku_Bunga->AdvancedSearch->Load();
		$this->Jumlah_Bunga->AdvancedSearch->Load();
		$this->Dikredit_Diperpanjang->AdvancedSearch->Load();
		$this->Tunai_Transfer->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_t20_deposito\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t20_deposito',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft20_depositolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v02_nasabahjaminan`";
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
if (!isset($t20_deposito_list)) $t20_deposito_list = new ct20_deposito_list();

// Page init
$t20_deposito_list->Page_Init();

// Page main
$t20_deposito_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t20_deposito_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t20_deposito->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft20_depositolist = new ew_Form("ft20_depositolist", "list");
ft20_depositolist.FormKeyCountName = '<?php echo $t20_deposito_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft20_depositolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft20_depositolist.ValidateRequired = true;
<?php } else { ?>
ft20_depositolist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft20_depositolist.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
ft20_depositolist.Lists["x_bank_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor","x_Pemilik","x_Bank",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t21_bank"};
ft20_depositolist.Lists["x_Dikredit_Diperpanjang"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositolist.Lists["x_Dikredit_Diperpanjang"].Options = <?php echo json_encode($t20_deposito->Dikredit_Diperpanjang->Options()) ?>;
ft20_depositolist.Lists["x_Tunai_Transfer"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft20_depositolist.Lists["x_Tunai_Transfer"].Options = <?php echo json_encode($t20_deposito->Tunai_Transfer->Options()) ?>;

// Form object for search
var CurrentSearchForm = ft20_depositolistsrch = new ew_Form("ft20_depositolistsrch");

// Validate function for search
ft20_depositolistsrch.Validate = function(fobj) {
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
ft20_depositolistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft20_depositolistsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
ft20_depositolistsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
ft20_depositolistsrch.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_bank_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t20_deposito->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t20_deposito->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($t20_deposito_list->TotalRecs > 0 && $t20_deposito_list->ExportOptions->Visible()) { ?>
<?php $t20_deposito_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t20_deposito_list->SearchOptions->Visible()) { ?>
<?php $t20_deposito_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($t20_deposito_list->FilterOptions->Visible()) { ?>
<?php $t20_deposito_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($t20_deposito->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $t20_deposito_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t20_deposito_list->TotalRecs <= 0)
			$t20_deposito_list->TotalRecs = $t20_deposito->SelectRecordCount();
	} else {
		if (!$t20_deposito_list->Recordset && ($t20_deposito_list->Recordset = $t20_deposito_list->LoadRecordset()))
			$t20_deposito_list->TotalRecs = $t20_deposito_list->Recordset->RecordCount();
	}
	$t20_deposito_list->StartRec = 1;
	if ($t20_deposito_list->DisplayRecs <= 0 || ($t20_deposito->Export <> "" && $t20_deposito->ExportAll)) // Display all records
		$t20_deposito_list->DisplayRecs = $t20_deposito_list->TotalRecs;
	if (!($t20_deposito->Export <> "" && $t20_deposito->ExportAll))
		$t20_deposito_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t20_deposito_list->Recordset = $t20_deposito_list->LoadRecordset($t20_deposito_list->StartRec-1, $t20_deposito_list->DisplayRecs);

	// Set no record found message
	if ($t20_deposito->CurrentAction == "" && $t20_deposito_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t20_deposito_list->setWarningMessage(ew_DeniedMsg());
		if ($t20_deposito_list->SearchWhere == "0=101")
			$t20_deposito_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t20_deposito_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($t20_deposito_list->AuditTrailOnSearch && $t20_deposito_list->Command == "search" && !$t20_deposito_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $t20_deposito_list->getSessionWhere();
		$t20_deposito_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$t20_deposito_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($t20_deposito->Export == "" && $t20_deposito->CurrentAction == "") { ?>
<form name="ft20_depositolistsrch" id="ft20_depositolistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($t20_deposito_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ft20_depositolistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t20_deposito">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$t20_deposito_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$t20_deposito->RowType = EW_ROWTYPE_SEARCH;

// Render row
$t20_deposito->ResetAttrs();
$t20_deposito_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
	<div id="xsc_No_Urut" class="ewCell form-group">
		<label for="x_No_Urut" class="ewSearchCaption ewLabel"><?php echo $t20_deposito->No_Urut->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_No_Urut" id="z_No_Urut" value="="></span>
		<span class="ewSearchField">
<input type="text" data-table="t20_deposito" data-field="x_No_Urut" name="x_No_Urut" id="x_No_Urut" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($t20_deposito->No_Urut->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->No_Urut->EditValue ?>"<?php echo $t20_deposito->No_Urut->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<div id="xsc_nasabah_id" class="ewCell form-group">
		<label for="x_nasabah_id" class="ewSearchCaption ewLabel"><?php echo $t20_deposito->nasabah_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><select name="z_nasabah_id" id="z_nasabah_id" class="form-control" onchange="ewForms(this).SrchOprChanged(this);"><option value="="<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "=") ? " selected" : "" ?> ><?php echo $Language->Phrase("EQUAL") ?></option><option value="<>"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<>") ? " selected" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<") ? " selected" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "<=") ? " selected" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == ">") ? " selected" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == ">=") ? " selected" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "NOT LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "STARTS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="ENDS WITH"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "ENDS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("ENDS WITH") ?></option><option value="BETWEEN"<?php echo ($t20_deposito->nasabah_id->AdvancedSearch->SearchOperator == "BETWEEN") ? " selected" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span>
		<span class="ewSearchField">
<input type="text" data-table="t20_deposito" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t20_deposito->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->nasabah_id->EditValue ?>"<?php echo $t20_deposito->nasabah_id->EditAttributes() ?>>
</span>
		<span class="ewSearchCond btw1_nasabah_id" style="display: none">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
		<span class="ewSearchField btw1_nasabah_id" style="display: none">
<input type="text" data-table="t20_deposito" data-field="x_nasabah_id" name="y_nasabah_id" id="y_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t20_deposito->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t20_deposito->nasabah_id->EditValue2 ?>"<?php echo $t20_deposito->nasabah_id->EditAttributes() ?>>
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
<?php $t20_deposito_list->ShowPageHeader(); ?>
<?php
$t20_deposito_list->ShowMessage();
?>
<?php if ($t20_deposito_list->TotalRecs > 0 || $t20_deposito->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t20_deposito">
<form name="ft20_depositolist" id="ft20_depositolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t20_deposito_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t20_deposito_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t20_deposito">
<div id="gmp_t20_deposito" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t20_deposito_list->TotalRecs > 0 || $t20_deposito->CurrentAction == "gridedit") { ?>
<table id="tbl_t20_depositolist" class="table ewTable">
<?php echo $t20_deposito->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t20_deposito_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t20_deposito_list->RenderListOptions();

// Render list options (header, left)
$t20_deposito_list->ListOptions->Render("header", "left");
?>
<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->No_Urut) == "") { ?>
		<th data-name="No_Urut"><div id="elh_t20_deposito_No_Urut" class="t20_deposito_No_Urut"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->No_Urut->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="No_Urut"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->No_Urut) ?>',2);"><div id="elh_t20_deposito_No_Urut" class="t20_deposito_No_Urut">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->No_Urut->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->No_Urut->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->No_Urut->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Tanggal_Valuta) == "") { ?>
		<th data-name="Tanggal_Valuta"><div id="elh_t20_deposito_Tanggal_Valuta" class="t20_deposito_Tanggal_Valuta"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal_Valuta"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Tanggal_Valuta) ?>',2);"><div id="elh_t20_deposito_Tanggal_Valuta" class="t20_deposito_Tanggal_Valuta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Tanggal_Valuta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Tanggal_Valuta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Tanggal_Valuta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Tanggal_Jatuh_Tempo) == "") { ?>
		<th data-name="Tanggal_Jatuh_Tempo"><div id="elh_t20_deposito_Tanggal_Jatuh_Tempo" class="t20_deposito_Tanggal_Jatuh_Tempo"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal_Jatuh_Tempo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Tanggal_Jatuh_Tempo) ?>',2);"><div id="elh_t20_deposito_Tanggal_Jatuh_Tempo" class="t20_deposito_Tanggal_Jatuh_Tempo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Tanggal_Jatuh_Tempo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Tanggal_Jatuh_Tempo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Tanggal_Jatuh_Tempo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t20_deposito_nasabah_id" class="t20_deposito_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->nasabah_id) ?>',2);"><div id="elh_t20_deposito_nasabah_id" class="t20_deposito_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->bank_id->Visible) { // bank_id ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->bank_id) == "") { ?>
		<th data-name="bank_id"><div id="elh_t20_deposito_bank_id" class="t20_deposito_bank_id"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->bank_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bank_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->bank_id) ?>',2);"><div id="elh_t20_deposito_bank_id" class="t20_deposito_bank_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->bank_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->bank_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->bank_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Jumlah_Deposito) == "") { ?>
		<th data-name="Jumlah_Deposito"><div id="elh_t20_deposito_Jumlah_Deposito" class="t20_deposito_Jumlah_Deposito"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah_Deposito"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Jumlah_Deposito) ?>',2);"><div id="elh_t20_deposito_Jumlah_Deposito" class="t20_deposito_Jumlah_Deposito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Deposito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Jumlah_Deposito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Jumlah_Deposito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Jumlah_Terbilang->Visible) { // Jumlah_Terbilang ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Jumlah_Terbilang) == "") { ?>
		<th data-name="Jumlah_Terbilang"><div id="elh_t20_deposito_Jumlah_Terbilang" class="t20_deposito_Jumlah_Terbilang"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Terbilang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah_Terbilang"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Jumlah_Terbilang) ?>',2);"><div id="elh_t20_deposito_Jumlah_Terbilang" class="t20_deposito_Jumlah_Terbilang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Terbilang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Jumlah_Terbilang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Jumlah_Terbilang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Suku_Bunga) == "") { ?>
		<th data-name="Suku_Bunga"><div id="elh_t20_deposito_Suku_Bunga" class="t20_deposito_Suku_Bunga"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Suku_Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Suku_Bunga) ?>',2);"><div id="elh_t20_deposito_Suku_Bunga" class="t20_deposito_Suku_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Suku_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Suku_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Suku_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Jumlah_Bunga) == "") { ?>
		<th data-name="Jumlah_Bunga"><div id="elh_t20_deposito_Jumlah_Bunga" class="t20_deposito_Jumlah_Bunga"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah_Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Jumlah_Bunga) ?>',2);"><div id="elh_t20_deposito_Jumlah_Bunga" class="t20_deposito_Jumlah_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Jumlah_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Jumlah_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Jumlah_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Dikredit_Diperpanjang) == "") { ?>
		<th data-name="Dikredit_Diperpanjang"><div id="elh_t20_deposito_Dikredit_Diperpanjang" class="t20_deposito_Dikredit_Diperpanjang"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Dikredit_Diperpanjang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Dikredit_Diperpanjang"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Dikredit_Diperpanjang) ?>',2);"><div id="elh_t20_deposito_Dikredit_Diperpanjang" class="t20_deposito_Dikredit_Diperpanjang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Dikredit_Diperpanjang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Dikredit_Diperpanjang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Dikredit_Diperpanjang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
	<?php if ($t20_deposito->SortUrl($t20_deposito->Tunai_Transfer) == "") { ?>
		<th data-name="Tunai_Transfer"><div id="elh_t20_deposito_Tunai_Transfer" class="t20_deposito_Tunai_Transfer"><div class="ewTableHeaderCaption"><?php echo $t20_deposito->Tunai_Transfer->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tunai_Transfer"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t20_deposito->SortUrl($t20_deposito->Tunai_Transfer) ?>',2);"><div id="elh_t20_deposito_Tunai_Transfer" class="t20_deposito_Tunai_Transfer">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t20_deposito->Tunai_Transfer->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t20_deposito->Tunai_Transfer->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t20_deposito->Tunai_Transfer->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t20_deposito_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t20_deposito->ExportAll && $t20_deposito->Export <> "") {
	$t20_deposito_list->StopRec = $t20_deposito_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t20_deposito_list->TotalRecs > $t20_deposito_list->StartRec + $t20_deposito_list->DisplayRecs - 1)
		$t20_deposito_list->StopRec = $t20_deposito_list->StartRec + $t20_deposito_list->DisplayRecs - 1;
	else
		$t20_deposito_list->StopRec = $t20_deposito_list->TotalRecs;
}
$t20_deposito_list->RecCnt = $t20_deposito_list->StartRec - 1;
if ($t20_deposito_list->Recordset && !$t20_deposito_list->Recordset->EOF) {
	$t20_deposito_list->Recordset->MoveFirst();
	$bSelectLimit = $t20_deposito_list->UseSelectLimit;
	if (!$bSelectLimit && $t20_deposito_list->StartRec > 1)
		$t20_deposito_list->Recordset->Move($t20_deposito_list->StartRec - 1);
} elseif (!$t20_deposito->AllowAddDeleteRow && $t20_deposito_list->StopRec == 0) {
	$t20_deposito_list->StopRec = $t20_deposito->GridAddRowCount;
}

// Initialize aggregate
$t20_deposito->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t20_deposito->ResetAttrs();
$t20_deposito_list->RenderRow();
while ($t20_deposito_list->RecCnt < $t20_deposito_list->StopRec) {
	$t20_deposito_list->RecCnt++;
	if (intval($t20_deposito_list->RecCnt) >= intval($t20_deposito_list->StartRec)) {
		$t20_deposito_list->RowCnt++;

		// Set up key count
		$t20_deposito_list->KeyCount = $t20_deposito_list->RowIndex;

		// Init row class and style
		$t20_deposito->ResetAttrs();
		$t20_deposito->CssClass = "";
		if ($t20_deposito->CurrentAction == "gridadd") {
		} else {
			$t20_deposito_list->LoadRowValues($t20_deposito_list->Recordset); // Load row values
		}
		$t20_deposito->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t20_deposito->RowAttrs = array_merge($t20_deposito->RowAttrs, array('data-rowindex'=>$t20_deposito_list->RowCnt, 'id'=>'r' . $t20_deposito_list->RowCnt . '_t20_deposito', 'data-rowtype'=>$t20_deposito->RowType));

		// Render row
		$t20_deposito_list->RenderRow();

		// Render list options
		$t20_deposito_list->RenderListOptions();
?>
	<tr<?php echo $t20_deposito->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t20_deposito_list->ListOptions->Render("body", "left", $t20_deposito_list->RowCnt);
?>
	<?php if ($t20_deposito->No_Urut->Visible) { // No_Urut ?>
		<td data-name="No_Urut"<?php echo $t20_deposito->No_Urut->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_No_Urut" class="t20_deposito_No_Urut">
<span<?php echo $t20_deposito->No_Urut->ViewAttributes() ?>>
<?php echo $t20_deposito->No_Urut->ListViewValue() ?></span>
</span>
<a id="<?php echo $t20_deposito_list->PageObjName . "_row_" . $t20_deposito_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t20_deposito->Tanggal_Valuta->Visible) { // Tanggal_Valuta ?>
		<td data-name="Tanggal_Valuta"<?php echo $t20_deposito->Tanggal_Valuta->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Tanggal_Valuta" class="t20_deposito_Tanggal_Valuta">
<span<?php echo $t20_deposito->Tanggal_Valuta->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Valuta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Tanggal_Jatuh_Tempo->Visible) { // Tanggal_Jatuh_Tempo ?>
		<td data-name="Tanggal_Jatuh_Tempo"<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Tanggal_Jatuh_Tempo" class="t20_deposito_Tanggal_Jatuh_Tempo">
<span<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ViewAttributes() ?>>
<?php echo $t20_deposito->Tanggal_Jatuh_Tempo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t20_deposito->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_nasabah_id" class="t20_deposito_nasabah_id">
<span<?php echo $t20_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t20_deposito->nasabah_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->bank_id->Visible) { // bank_id ?>
		<td data-name="bank_id"<?php echo $t20_deposito->bank_id->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_bank_id" class="t20_deposito_bank_id">
<span<?php echo $t20_deposito->bank_id->ViewAttributes() ?>>
<?php echo $t20_deposito->bank_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Jumlah_Deposito->Visible) { // Jumlah_Deposito ?>
		<td data-name="Jumlah_Deposito"<?php echo $t20_deposito->Jumlah_Deposito->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Jumlah_Deposito" class="t20_deposito_Jumlah_Deposito">
<span<?php echo $t20_deposito->Jumlah_Deposito->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Deposito->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Jumlah_Terbilang->Visible) { // Jumlah_Terbilang ?>
		<td data-name="Jumlah_Terbilang"<?php echo $t20_deposito->Jumlah_Terbilang->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Jumlah_Terbilang" class="t20_deposito_Jumlah_Terbilang">
<span<?php echo $t20_deposito->Jumlah_Terbilang->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Terbilang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Suku_Bunga->Visible) { // Suku_Bunga ?>
		<td data-name="Suku_Bunga"<?php echo $t20_deposito->Suku_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Suku_Bunga" class="t20_deposito_Suku_Bunga">
<span<?php echo $t20_deposito->Suku_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Suku_Bunga->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Jumlah_Bunga->Visible) { // Jumlah_Bunga ?>
		<td data-name="Jumlah_Bunga"<?php echo $t20_deposito->Jumlah_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Jumlah_Bunga" class="t20_deposito_Jumlah_Bunga">
<span<?php echo $t20_deposito->Jumlah_Bunga->ViewAttributes() ?>>
<?php echo $t20_deposito->Jumlah_Bunga->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Dikredit_Diperpanjang->Visible) { // Dikredit_Diperpanjang ?>
		<td data-name="Dikredit_Diperpanjang"<?php echo $t20_deposito->Dikredit_Diperpanjang->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Dikredit_Diperpanjang" class="t20_deposito_Dikredit_Diperpanjang">
<span<?php echo $t20_deposito->Dikredit_Diperpanjang->ViewAttributes() ?>>
<?php echo $t20_deposito->Dikredit_Diperpanjang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t20_deposito->Tunai_Transfer->Visible) { // Tunai_Transfer ?>
		<td data-name="Tunai_Transfer"<?php echo $t20_deposito->Tunai_Transfer->CellAttributes() ?>>
<span id="el<?php echo $t20_deposito_list->RowCnt ?>_t20_deposito_Tunai_Transfer" class="t20_deposito_Tunai_Transfer">
<span<?php echo $t20_deposito->Tunai_Transfer->ViewAttributes() ?>>
<?php echo $t20_deposito->Tunai_Transfer->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t20_deposito_list->ListOptions->Render("body", "right", $t20_deposito_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($t20_deposito->CurrentAction <> "gridadd")
		$t20_deposito_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t20_deposito->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t20_deposito_list->Recordset)
	$t20_deposito_list->Recordset->Close();
?>
<?php if ($t20_deposito->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t20_deposito->CurrentAction <> "gridadd" && $t20_deposito->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t20_deposito_list->Pager)) $t20_deposito_list->Pager = new cPrevNextPager($t20_deposito_list->StartRec, $t20_deposito_list->DisplayRecs, $t20_deposito_list->TotalRecs) ?>
<?php if ($t20_deposito_list->Pager->RecordCount > 0 && $t20_deposito_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t20_deposito_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t20_deposito_list->PageUrl() ?>start=<?php echo $t20_deposito_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t20_deposito_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t20_deposito_list->PageUrl() ?>start=<?php echo $t20_deposito_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t20_deposito_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t20_deposito_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t20_deposito_list->PageUrl() ?>start=<?php echo $t20_deposito_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t20_deposito_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t20_deposito_list->PageUrl() ?>start=<?php echo $t20_deposito_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t20_deposito_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t20_deposito_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t20_deposito_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t20_deposito_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t20_deposito_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $t20_deposito_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t20_deposito">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($t20_deposito_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t20_deposito_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($t20_deposito->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t20_deposito_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t20_deposito_list->TotalRecs == 0 && $t20_deposito->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t20_deposito_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t20_deposito->Export == "") { ?>
<script type="text/javascript">
ft20_depositolistsrch.FilterList = <?php echo $t20_deposito_list->GetFilterList() ?>;
ft20_depositolistsrch.Init();
ft20_depositolist.Init();
</script>
<?php } ?>
<?php
$t20_deposito_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t20_deposito->Export == "") { ?>
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
$t20_deposito_list->Page_Terminate();
?>
