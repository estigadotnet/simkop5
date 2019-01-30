<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t04_pinjamanangsurantempgridcls.php" ?>
<?php include_once "t06_pinjamantitipangridcls.php" ?>
<?php include_once "t08_pinjamanpotongangridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_pinjaman_list = NULL; // Initialize page object first

class ct03_pinjaman_list extends ct03_pinjaman {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't03_pinjaman';

	// Page object name
	var $PageObjName = 't03_pinjaman_list';

	// Grid form hidden field names
	var $FormName = 'ft03_pinjamanlist';
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

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS["t03_pinjaman"]) || get_class($GLOBALS["t03_pinjaman"]) == "ct03_pinjaman") {
			$GLOBALS["t03_pinjaman"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t03_pinjaman"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t03_pinjamanadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t03_pinjamandelete.php";
		$this->MultiUpdateUrl = "t03_pinjamanupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_pinjaman', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft03_pinjamanlistsrch";

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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->Pinjaman->SetVisibility();
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

			// Process auto fill for detail table 't04_pinjamanangsurantemp'
			if (@$_POST["grid"] == "ft04_pinjamanangsurantempgrid") {
				if (!isset($GLOBALS["t04_pinjamanangsurantemp_grid"])) $GLOBALS["t04_pinjamanangsurantemp_grid"] = new ct04_pinjamanangsurantemp_grid;
				$GLOBALS["t04_pinjamanangsurantemp_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't06_pinjamantitipan'
			if (@$_POST["grid"] == "ft06_pinjamantitipangrid") {
				if (!isset($GLOBALS["t06_pinjamantitipan_grid"])) $GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid;
				$GLOBALS["t06_pinjamantitipan_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't08_pinjamanpotongan'
			if (@$_POST["grid"] == "ft08_pinjamanpotongangrid") {
				if (!isset($GLOBALS["t08_pinjamanpotongan_grid"])) $GLOBALS["t08_pinjamanpotongan_grid"] = new ct08_pinjamanpotongan_grid;
				$GLOBALS["t08_pinjamanpotongan_grid"]->Page_Init();
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
		global $EW_EXPORT, $t03_pinjaman;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t03_pinjaman);
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
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "ft03_pinjamanlistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_No->AdvancedSearch->ToJSON(), ","); // Field Kontrak_No
		$sFilterList = ew_Concat($sFilterList, $this->Kontrak_Tgl->AdvancedSearch->ToJSON(), ","); // Field Kontrak_Tgl
		$sFilterList = ew_Concat($sFilterList, $this->nasabah_id->AdvancedSearch->ToJSON(), ","); // Field nasabah_id
		$sFilterList = ew_Concat($sFilterList, $this->jaminan_id->AdvancedSearch->ToJSON(), ","); // Field jaminan_id
		$sFilterList = ew_Concat($sFilterList, $this->Pinjaman->AdvancedSearch->ToJSON(), ","); // Field Pinjaman
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Lama->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Lama
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Bunga_Prosen->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Bunga_Prosen
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Denda->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Denda
		$sFilterList = ew_Concat($sFilterList, $this->Dispensasi_Denda->AdvancedSearch->ToJSON(), ","); // Field Dispensasi_Denda
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Pokok->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Pokok
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Bunga->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Bunga
		$sFilterList = ew_Concat($sFilterList, $this->Angsuran_Total->AdvancedSearch->ToJSON(), ","); // Field Angsuran_Total
		$sFilterList = ew_Concat($sFilterList, $this->No_Ref->AdvancedSearch->ToJSON(), ","); // Field No_Ref
		$sFilterList = ew_Concat($sFilterList, $this->Biaya_Administrasi->AdvancedSearch->ToJSON(), ","); // Field Biaya_Administrasi
		$sFilterList = ew_Concat($sFilterList, $this->Biaya_Materai->AdvancedSearch->ToJSON(), ","); // Field Biaya_Materai
		$sFilterList = ew_Concat($sFilterList, $this->marketing_id->AdvancedSearch->ToJSON(), ","); // Field marketing_id
		$sFilterList = ew_Concat($sFilterList, $this->Periode->AdvancedSearch->ToJSON(), ","); // Field Periode
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "ft03_pinjamanlistsrch", $filters);

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

		// Field nasabah_id
		$this->nasabah_id->AdvancedSearch->SearchValue = @$filter["x_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchOperator = @$filter["z_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchCondition = @$filter["v_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchValue2 = @$filter["y_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchOperator2 = @$filter["w_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->Save();

		// Field jaminan_id
		$this->jaminan_id->AdvancedSearch->SearchValue = @$filter["x_jaminan_id"];
		$this->jaminan_id->AdvancedSearch->SearchOperator = @$filter["z_jaminan_id"];
		$this->jaminan_id->AdvancedSearch->SearchCondition = @$filter["v_jaminan_id"];
		$this->jaminan_id->AdvancedSearch->SearchValue2 = @$filter["y_jaminan_id"];
		$this->jaminan_id->AdvancedSearch->SearchOperator2 = @$filter["w_jaminan_id"];
		$this->jaminan_id->AdvancedSearch->Save();

		// Field Pinjaman
		$this->Pinjaman->AdvancedSearch->SearchValue = @$filter["x_Pinjaman"];
		$this->Pinjaman->AdvancedSearch->SearchOperator = @$filter["z_Pinjaman"];
		$this->Pinjaman->AdvancedSearch->SearchCondition = @$filter["v_Pinjaman"];
		$this->Pinjaman->AdvancedSearch->SearchValue2 = @$filter["y_Pinjaman"];
		$this->Pinjaman->AdvancedSearch->SearchOperator2 = @$filter["w_Pinjaman"];
		$this->Pinjaman->AdvancedSearch->Save();

		// Field Angsuran_Lama
		$this->Angsuran_Lama->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Lama"];
		$this->Angsuran_Lama->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Lama"];
		$this->Angsuran_Lama->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Lama"];
		$this->Angsuran_Lama->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Lama"];
		$this->Angsuran_Lama->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Lama"];
		$this->Angsuran_Lama->AdvancedSearch->Save();

		// Field Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Bunga_Prosen"];
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Bunga_Prosen"];
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Bunga_Prosen"];
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Bunga_Prosen"];
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Bunga_Prosen"];
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->Save();

		// Field Angsuran_Denda
		$this->Angsuran_Denda->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Denda"];
		$this->Angsuran_Denda->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Denda"];
		$this->Angsuran_Denda->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Denda"];
		$this->Angsuran_Denda->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Denda"];
		$this->Angsuran_Denda->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Denda"];
		$this->Angsuran_Denda->AdvancedSearch->Save();

		// Field Dispensasi_Denda
		$this->Dispensasi_Denda->AdvancedSearch->SearchValue = @$filter["x_Dispensasi_Denda"];
		$this->Dispensasi_Denda->AdvancedSearch->SearchOperator = @$filter["z_Dispensasi_Denda"];
		$this->Dispensasi_Denda->AdvancedSearch->SearchCondition = @$filter["v_Dispensasi_Denda"];
		$this->Dispensasi_Denda->AdvancedSearch->SearchValue2 = @$filter["y_Dispensasi_Denda"];
		$this->Dispensasi_Denda->AdvancedSearch->SearchOperator2 = @$filter["w_Dispensasi_Denda"];
		$this->Dispensasi_Denda->AdvancedSearch->Save();

		// Field Angsuran_Pokok
		$this->Angsuran_Pokok->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Pokok"];
		$this->Angsuran_Pokok->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Pokok"];
		$this->Angsuran_Pokok->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Pokok"];
		$this->Angsuran_Pokok->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Pokok"];
		$this->Angsuran_Pokok->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Pokok"];
		$this->Angsuran_Pokok->AdvancedSearch->Save();

		// Field Angsuran_Bunga
		$this->Angsuran_Bunga->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Bunga"];
		$this->Angsuran_Bunga->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Bunga"];
		$this->Angsuran_Bunga->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Bunga"];
		$this->Angsuran_Bunga->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Bunga"];
		$this->Angsuran_Bunga->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Bunga"];
		$this->Angsuran_Bunga->AdvancedSearch->Save();

		// Field Angsuran_Total
		$this->Angsuran_Total->AdvancedSearch->SearchValue = @$filter["x_Angsuran_Total"];
		$this->Angsuran_Total->AdvancedSearch->SearchOperator = @$filter["z_Angsuran_Total"];
		$this->Angsuran_Total->AdvancedSearch->SearchCondition = @$filter["v_Angsuran_Total"];
		$this->Angsuran_Total->AdvancedSearch->SearchValue2 = @$filter["y_Angsuran_Total"];
		$this->Angsuran_Total->AdvancedSearch->SearchOperator2 = @$filter["w_Angsuran_Total"];
		$this->Angsuran_Total->AdvancedSearch->Save();

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

		// Field marketing_id
		$this->marketing_id->AdvancedSearch->SearchValue = @$filter["x_marketing_id"];
		$this->marketing_id->AdvancedSearch->SearchOperator = @$filter["z_marketing_id"];
		$this->marketing_id->AdvancedSearch->SearchCondition = @$filter["v_marketing_id"];
		$this->marketing_id->AdvancedSearch->SearchValue2 = @$filter["y_marketing_id"];
		$this->marketing_id->AdvancedSearch->SearchOperator2 = @$filter["w_marketing_id"];
		$this->marketing_id->AdvancedSearch->Save();

		// Field Periode
		$this->Periode->AdvancedSearch->SearchValue = @$filter["x_Periode"];
		$this->Periode->AdvancedSearch->SearchOperator = @$filter["z_Periode"];
		$this->Periode->AdvancedSearch->SearchCondition = @$filter["v_Periode"];
		$this->Periode->AdvancedSearch->SearchValue2 = @$filter["y_Periode"];
		$this->Periode->AdvancedSearch->SearchOperator2 = @$filter["w_Periode"];
		$this->Periode->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->Kontrak_No, $Default, FALSE); // Kontrak_No
		$this->BuildSearchSql($sWhere, $this->Kontrak_Tgl, $Default, FALSE); // Kontrak_Tgl
		$this->BuildSearchSql($sWhere, $this->nasabah_id, $Default, FALSE); // nasabah_id
		$this->BuildSearchSql($sWhere, $this->jaminan_id, $Default, TRUE); // jaminan_id
		$this->BuildSearchSql($sWhere, $this->Pinjaman, $Default, FALSE); // Pinjaman
		$this->BuildSearchSql($sWhere, $this->Angsuran_Lama, $Default, FALSE); // Angsuran_Lama
		$this->BuildSearchSql($sWhere, $this->Angsuran_Bunga_Prosen, $Default, FALSE); // Angsuran_Bunga_Prosen
		$this->BuildSearchSql($sWhere, $this->Angsuran_Denda, $Default, FALSE); // Angsuran_Denda
		$this->BuildSearchSql($sWhere, $this->Dispensasi_Denda, $Default, FALSE); // Dispensasi_Denda
		$this->BuildSearchSql($sWhere, $this->Angsuran_Pokok, $Default, FALSE); // Angsuran_Pokok
		$this->BuildSearchSql($sWhere, $this->Angsuran_Bunga, $Default, FALSE); // Angsuran_Bunga
		$this->BuildSearchSql($sWhere, $this->Angsuran_Total, $Default, FALSE); // Angsuran_Total
		$this->BuildSearchSql($sWhere, $this->No_Ref, $Default, FALSE); // No_Ref
		$this->BuildSearchSql($sWhere, $this->Biaya_Administrasi, $Default, FALSE); // Biaya_Administrasi
		$this->BuildSearchSql($sWhere, $this->Biaya_Materai, $Default, FALSE); // Biaya_Materai
		$this->BuildSearchSql($sWhere, $this->marketing_id, $Default, FALSE); // marketing_id
		$this->BuildSearchSql($sWhere, $this->Periode, $Default, FALSE); // Periode

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->Kontrak_No->AdvancedSearch->Save(); // Kontrak_No
			$this->Kontrak_Tgl->AdvancedSearch->Save(); // Kontrak_Tgl
			$this->nasabah_id->AdvancedSearch->Save(); // nasabah_id
			$this->jaminan_id->AdvancedSearch->Save(); // jaminan_id
			$this->Pinjaman->AdvancedSearch->Save(); // Pinjaman
			$this->Angsuran_Lama->AdvancedSearch->Save(); // Angsuran_Lama
			$this->Angsuran_Bunga_Prosen->AdvancedSearch->Save(); // Angsuran_Bunga_Prosen
			$this->Angsuran_Denda->AdvancedSearch->Save(); // Angsuran_Denda
			$this->Dispensasi_Denda->AdvancedSearch->Save(); // Dispensasi_Denda
			$this->Angsuran_Pokok->AdvancedSearch->Save(); // Angsuran_Pokok
			$this->Angsuran_Bunga->AdvancedSearch->Save(); // Angsuran_Bunga
			$this->Angsuran_Total->AdvancedSearch->Save(); // Angsuran_Total
			$this->No_Ref->AdvancedSearch->Save(); // No_Ref
			$this->Biaya_Administrasi->AdvancedSearch->Save(); // Biaya_Administrasi
			$this->Biaya_Materai->AdvancedSearch->Save(); // Biaya_Materai
			$this->marketing_id->AdvancedSearch->Save(); // marketing_id
			$this->Periode->AdvancedSearch->Save(); // Periode
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
		if ($this->nasabah_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->jaminan_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Pinjaman->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Lama->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Bunga_Prosen->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Denda->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Dispensasi_Denda->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Pokok->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Bunga->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Angsuran_Total->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->No_Ref->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Biaya_Administrasi->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Biaya_Materai->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->marketing_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Periode->AdvancedSearch->IssetSession())
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
		$this->nasabah_id->AdvancedSearch->UnsetSession();
		$this->jaminan_id->AdvancedSearch->UnsetSession();
		$this->Pinjaman->AdvancedSearch->UnsetSession();
		$this->Angsuran_Lama->AdvancedSearch->UnsetSession();
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->UnsetSession();
		$this->Angsuran_Denda->AdvancedSearch->UnsetSession();
		$this->Dispensasi_Denda->AdvancedSearch->UnsetSession();
		$this->Angsuran_Pokok->AdvancedSearch->UnsetSession();
		$this->Angsuran_Bunga->AdvancedSearch->UnsetSession();
		$this->Angsuran_Total->AdvancedSearch->UnsetSession();
		$this->No_Ref->AdvancedSearch->UnsetSession();
		$this->Biaya_Administrasi->AdvancedSearch->UnsetSession();
		$this->Biaya_Materai->AdvancedSearch->UnsetSession();
		$this->marketing_id->AdvancedSearch->UnsetSession();
		$this->Periode->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->Kontrak_No->AdvancedSearch->Load();
		$this->Kontrak_Tgl->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->jaminan_id->AdvancedSearch->Load();
		$this->Pinjaman->AdvancedSearch->Load();
		$this->Angsuran_Lama->AdvancedSearch->Load();
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->Load();
		$this->Angsuran_Denda->AdvancedSearch->Load();
		$this->Dispensasi_Denda->AdvancedSearch->Load();
		$this->Angsuran_Pokok->AdvancedSearch->Load();
		$this->Angsuran_Bunga->AdvancedSearch->Load();
		$this->Angsuran_Total->AdvancedSearch->Load();
		$this->No_Ref->AdvancedSearch->Load();
		$this->Biaya_Administrasi->AdvancedSearch->Load();
		$this->Biaya_Materai->AdvancedSearch->Load();
		$this->marketing_id->AdvancedSearch->Load();
		$this->Periode->AdvancedSearch->Load();
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
			$this->UpdateSort($this->nasabah_id, $bCtrl); // nasabah_id
			$this->UpdateSort($this->Pinjaman, $bCtrl); // Pinjaman
			$this->UpdateSort($this->marketing_id, $bCtrl); // marketing_id
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
				$this->nasabah_id->setSort("");
				$this->Pinjaman->setSort("");
				$this->marketing_id->setSort("");
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

		// "detail_t04_pinjamanangsurantemp"
		$item = &$this->ListOptions->Add("detail_t04_pinjamanangsurantemp");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't04_pinjamanangsurantemp') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t04_pinjamanangsurantemp_grid"])) $GLOBALS["t04_pinjamanangsurantemp_grid"] = new ct04_pinjamanangsurantemp_grid;

		// "detail_t06_pinjamantitipan"
		$item = &$this->ListOptions->Add("detail_t06_pinjamantitipan");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't06_pinjamantitipan') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t06_pinjamantitipan_grid"])) $GLOBALS["t06_pinjamantitipan_grid"] = new ct06_pinjamantitipan_grid;

		// "detail_t08_pinjamanpotongan"
		$item = &$this->ListOptions->Add("detail_t08_pinjamanpotongan");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't08_pinjamanpotongan') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t08_pinjamanpotongan_grid"])) $GLOBALS["t08_pinjamanpotongan_grid"] = new ct08_pinjamanpotongan_grid;

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
		$pages->Add("t04_pinjamanangsurantemp");
		$pages->Add("t06_pinjamantitipan");
		$pages->Add("t08_pinjamanpotongan");
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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_t04_pinjamanangsurantemp"
		$oListOpt = &$this->ListOptions->Items["detail_t04_pinjamanangsurantemp"];
		if ($Security->AllowList(CurrentProjectID() . 't04_pinjamanangsurantemp')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t04_pinjamanangsurantemp", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t04_pinjamanangsurantemplist.php?" . EW_TABLE_SHOW_MASTER . "=t03_pinjaman&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t04_pinjamanangsurantemp_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't04_pinjamanangsurantemp')) {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t04_pinjamanangsurantemp")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "t04_pinjamanangsurantemp";
			}
			if ($GLOBALS["t04_pinjamanangsurantemp_grid"]->DetailAdd && $Security->CanAdd() && $Security->AllowAdd(CurrentProjectID() . 't04_pinjamanangsurantemp')) {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=t04_pinjamanangsurantemp")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
				if ($DetailCopyTblVar <> "") $DetailCopyTblVar .= ",";
				$DetailCopyTblVar .= "t04_pinjamanangsurantemp";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}

		// "detail_t06_pinjamantitipan"
		$oListOpt = &$this->ListOptions->Items["detail_t06_pinjamantitipan"];
		if ($Security->AllowList(CurrentProjectID() . 't06_pinjamantitipan')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t06_pinjamantitipan", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t06_pinjamantitipanlist.php?" . EW_TABLE_SHOW_MASTER . "=t03_pinjaman&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t06_pinjamantitipan_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't06_pinjamantitipan')) {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t06_pinjamantitipan")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "t06_pinjamantitipan";
			}
			if ($GLOBALS["t06_pinjamantitipan_grid"]->DetailAdd && $Security->CanAdd() && $Security->AllowAdd(CurrentProjectID() . 't06_pinjamantitipan')) {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=t06_pinjamantitipan")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
				if ($DetailCopyTblVar <> "") $DetailCopyTblVar .= ",";
				$DetailCopyTblVar .= "t06_pinjamantitipan";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}

		// "detail_t08_pinjamanpotongan"
		$oListOpt = &$this->ListOptions->Items["detail_t08_pinjamanpotongan"];
		if ($Security->AllowList(CurrentProjectID() . 't08_pinjamanpotongan')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t08_pinjamanpotongan", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t08_pinjamanpotonganlist.php?" . EW_TABLE_SHOW_MASTER . "=t03_pinjaman&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t08_pinjamanpotongan_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't08_pinjamanpotongan')) {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t08_pinjamanpotongan")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "t08_pinjamanpotongan";
			}
			if ($GLOBALS["t08_pinjamanpotongan_grid"]->DetailAdd && $Security->CanAdd() && $Security->AllowAdd(CurrentProjectID() . 't08_pinjamanpotongan')) {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=t08_pinjamanpotongan")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
				if ($DetailCopyTblVar <> "") $DetailCopyTblVar .= ",";
				$DetailCopyTblVar .= "t08_pinjamanpotongan";
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
		$item = &$option->Add("detailadd_t04_pinjamanangsurantemp");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=t04_pinjamanangsurantemp");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["t04_pinjamanangsurantemp"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t04_pinjamanangsurantemp"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 't04_pinjamanangsurantemp') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "t04_pinjamanangsurantemp";
		}
		$item = &$option->Add("detailadd_t06_pinjamantitipan");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=t06_pinjamantitipan");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["t06_pinjamantitipan"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t06_pinjamantitipan"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 't06_pinjamantitipan') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "t06_pinjamantitipan";
		}
		$item = &$option->Add("detailadd_t08_pinjamanpotongan");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=t08_pinjamanpotongan");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["t08_pinjamanpotongan"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["t08_pinjamanpotongan"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 't08_pinjamanpotongan') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "t08_pinjamanpotongan";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft03_pinjamanlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft03_pinjamanlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft03_pinjamanlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft03_pinjamanlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
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

		// Kontrak_No
		$this->Kontrak_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_No"]);
		if ($this->Kontrak_No->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_No->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_No"];

		// Kontrak_Tgl
		$this->Kontrak_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Kontrak_Tgl"]);
		if ($this->Kontrak_Tgl->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Kontrak_Tgl->AdvancedSearch->SearchOperator = @$_GET["z_Kontrak_Tgl"];

		// nasabah_id
		$this->nasabah_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nasabah_id"]);
		if ($this->nasabah_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->nasabah_id->AdvancedSearch->SearchOperator = @$_GET["z_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchCondition = @$_GET["v_nasabah_id"];
		$this->nasabah_id->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_nasabah_id"]);
		if ($this->nasabah_id->AdvancedSearch->SearchValue2 <> "") $this->Command = "search";
		$this->nasabah_id->AdvancedSearch->SearchOperator2 = @$_GET["w_nasabah_id"];

		// jaminan_id
		$this->jaminan_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_jaminan_id"]);
		if ($this->jaminan_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->jaminan_id->AdvancedSearch->SearchOperator = @$_GET["z_jaminan_id"];
		if (is_array($this->jaminan_id->AdvancedSearch->SearchValue)) $this->jaminan_id->AdvancedSearch->SearchValue = implode(",", $this->jaminan_id->AdvancedSearch->SearchValue);
		if (is_array($this->jaminan_id->AdvancedSearch->SearchValue2)) $this->jaminan_id->AdvancedSearch->SearchValue2 = implode(",", $this->jaminan_id->AdvancedSearch->SearchValue2);

		// Pinjaman
		$this->Pinjaman->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Pinjaman"]);
		if ($this->Pinjaman->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Pinjaman->AdvancedSearch->SearchOperator = @$_GET["z_Pinjaman"];

		// Angsuran_Lama
		$this->Angsuran_Lama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Lama"]);
		if ($this->Angsuran_Lama->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Lama->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Lama"];

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Bunga_Prosen"]);
		if ($this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Bunga_Prosen"];

		// Angsuran_Denda
		$this->Angsuran_Denda->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Denda"]);
		if ($this->Angsuran_Denda->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Denda->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Denda"];

		// Dispensasi_Denda
		$this->Dispensasi_Denda->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Dispensasi_Denda"]);
		if ($this->Dispensasi_Denda->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Dispensasi_Denda->AdvancedSearch->SearchOperator = @$_GET["z_Dispensasi_Denda"];

		// Angsuran_Pokok
		$this->Angsuran_Pokok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Pokok"]);
		if ($this->Angsuran_Pokok->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Pokok->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Pokok"];

		// Angsuran_Bunga
		$this->Angsuran_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Bunga"]);
		if ($this->Angsuran_Bunga->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Bunga->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Bunga"];

		// Angsuran_Total
		$this->Angsuran_Total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Angsuran_Total"]);
		if ($this->Angsuran_Total->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Angsuran_Total->AdvancedSearch->SearchOperator = @$_GET["z_Angsuran_Total"];

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

		// marketing_id
		$this->marketing_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_marketing_id"]);
		if ($this->marketing_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->marketing_id->AdvancedSearch->SearchOperator = @$_GET["z_marketing_id"];

		// Periode
		$this->Periode->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Periode"]);
		if ($this->Periode->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Periode->AdvancedSearch->SearchOperator = @$_GET["z_Periode"];
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
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		if (array_key_exists('EV__nasabah_id', $rs->fields)) {
			$this->nasabah_id->VirtualValue = $rs->fields('EV__nasabah_id'); // Set up virtual field value
		} else {
			$this->nasabah_id->VirtualValue = ""; // Clear value
		}
		$this->jaminan_id->setDbValue($rs->fields('jaminan_id'));
		$this->Pinjaman->setDbValue($rs->fields('Pinjaman'));
		$this->Angsuran_Lama->setDbValue($rs->fields('Angsuran_Lama'));
		$this->Angsuran_Bunga_Prosen->setDbValue($rs->fields('Angsuran_Bunga_Prosen'));
		$this->Angsuran_Denda->setDbValue($rs->fields('Angsuran_Denda'));
		$this->Dispensasi_Denda->setDbValue($rs->fields('Dispensasi_Denda'));
		$this->Angsuran_Pokok->setDbValue($rs->fields('Angsuran_Pokok'));
		$this->Angsuran_Bunga->setDbValue($rs->fields('Angsuran_Bunga'));
		$this->Angsuran_Total->setDbValue($rs->fields('Angsuran_Total'));
		$this->No_Ref->setDbValue($rs->fields('No_Ref'));
		$this->Biaya_Administrasi->setDbValue($rs->fields('Biaya_Administrasi'));
		$this->Biaya_Materai->setDbValue($rs->fields('Biaya_Materai'));
		$this->marketing_id->setDbValue($rs->fields('marketing_id'));
		$this->Periode->setDbValue($rs->fields('Periode'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Kontrak_No->DbValue = $row['Kontrak_No'];
		$this->Kontrak_Tgl->DbValue = $row['Kontrak_Tgl'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->jaminan_id->DbValue = $row['jaminan_id'];
		$this->Pinjaman->DbValue = $row['Pinjaman'];
		$this->Angsuran_Lama->DbValue = $row['Angsuran_Lama'];
		$this->Angsuran_Bunga_Prosen->DbValue = $row['Angsuran_Bunga_Prosen'];
		$this->Angsuran_Denda->DbValue = $row['Angsuran_Denda'];
		$this->Dispensasi_Denda->DbValue = $row['Dispensasi_Denda'];
		$this->Angsuran_Pokok->DbValue = $row['Angsuran_Pokok'];
		$this->Angsuran_Bunga->DbValue = $row['Angsuran_Bunga'];
		$this->Angsuran_Total->DbValue = $row['Angsuran_Total'];
		$this->No_Ref->DbValue = $row['No_Ref'];
		$this->Biaya_Administrasi->DbValue = $row['Biaya_Administrasi'];
		$this->Biaya_Materai->DbValue = $row['Biaya_Materai'];
		$this->marketing_id->DbValue = $row['marketing_id'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->Pinjaman->FormValue == $this->Pinjaman->CurrentValue && is_numeric(ew_StrToFloat($this->Pinjaman->CurrentValue)))
			$this->Pinjaman->CurrentValue = ew_StrToFloat($this->Pinjaman->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Kontrak_No
		// Kontrak_Tgl
		// nasabah_id
		// jaminan_id
		// Pinjaman
		// Angsuran_Lama
		// Angsuran_Bunga_Prosen
		// Angsuran_Denda
		// Dispensasi_Denda
		// Angsuran_Pokok
		// Angsuran_Bunga
		// Angsuran_Total
		// No_Ref
		// Biaya_Administrasi
		// Biaya_Materai
		// marketing_id
		// Periode

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

		// nasabah_id
		if ($this->nasabah_id->VirtualValue <> "") {
			$this->nasabah_id->ViewValue = $this->nasabah_id->VirtualValue;
		} else {
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v02_nasabahjaminan`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array("dx1" => '`Nama`');
		$lookuptblfilter = "`Status` <> 2";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
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

		// jaminan_id
		if (strval($this->jaminan_id->CurrentValue) <> "") {
			$arwrk = explode(",", $this->jaminan_id->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `id`, `Merk_Type` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_jaminan`";
		$sWhereWrk = "";
		$this->jaminan_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->jaminan_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->jaminan_id->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->jaminan_id->ViewValue .= $this->jaminan_id->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->jaminan_id->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->jaminan_id->ViewValue = $this->jaminan_id->CurrentValue;
			}
		} else {
			$this->jaminan_id->ViewValue = NULL;
		}
		$this->jaminan_id->ViewCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->ViewValue = ew_FormatNumber($this->Pinjaman->ViewValue, 2, -2, -2, -2);
		$this->Pinjaman->CellCssStyle .= "text-align: right;";
		$this->Pinjaman->ViewCustomAttributes = "";

		// Angsuran_Lama
		$this->Angsuran_Lama->ViewValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Lama->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Lama->ViewCustomAttributes = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->ViewValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
		$this->Angsuran_Bunga_Prosen->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Bunga_Prosen->ViewCustomAttributes = "";

		// Angsuran_Denda
		$this->Angsuran_Denda->ViewValue = $this->Angsuran_Denda->CurrentValue;
		$this->Angsuran_Denda->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Denda->ViewCustomAttributes = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda->ViewValue = $this->Dispensasi_Denda->CurrentValue;
		$this->Dispensasi_Denda->CellCssStyle .= "text-align: right;";
		$this->Dispensasi_Denda->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewValue = ew_FormatNumber($this->Angsuran_Pokok->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Pokok->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewValue = ew_FormatNumber($this->Angsuran_Bunga->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Bunga->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewValue = ew_FormatNumber($this->Angsuran_Total->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Total->CellCssStyle .= "text-align: right;";
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// No_Ref
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

		// marketing_id
		$this->marketing_id->ViewValue = $this->marketing_id->CurrentValue;
		if (strval($this->marketing_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->marketing_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_marketing`";
		$sWhereWrk = "";
		$this->marketing_id->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->marketing_id->ViewValue = $this->marketing_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->marketing_id->ViewValue = $this->marketing_id->CurrentValue;
			}
		} else {
			$this->marketing_id->ViewValue = NULL;
		}
		$this->marketing_id->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

			// Kontrak_No
			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";
			$this->Kontrak_No->TooltipValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";
			$this->Kontrak_Tgl->TooltipValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";

			// Pinjaman
			$this->Pinjaman->LinkCustomAttributes = "";
			$this->Pinjaman->HrefValue = "";
			$this->Pinjaman->TooltipValue = "";

			// marketing_id
			$this->marketing_id->LinkCustomAttributes = "";
			$this->marketing_id->HrefValue = "";
			$this->marketing_id->TooltipValue = "";
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

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue2 = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue2);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());

			// Pinjaman
			$this->Pinjaman->EditAttrs["class"] = "form-control";
			$this->Pinjaman->EditCustomAttributes = "";
			$this->Pinjaman->EditValue = ew_HtmlEncode($this->Pinjaman->AdvancedSearch->SearchValue);
			$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());

			// marketing_id
			$this->marketing_id->EditAttrs["class"] = "form-control";
			$this->marketing_id->EditCustomAttributes = "";
			$this->marketing_id->EditValue = ew_HtmlEncode($this->marketing_id->AdvancedSearch->SearchValue);
			$this->marketing_id->PlaceHolder = ew_RemoveHtml($this->marketing_id->FldCaption());
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
		$this->Kontrak_No->AdvancedSearch->Load();
		$this->Kontrak_Tgl->AdvancedSearch->Load();
		$this->nasabah_id->AdvancedSearch->Load();
		$this->jaminan_id->AdvancedSearch->Load();
		$this->Pinjaman->AdvancedSearch->Load();
		$this->Angsuran_Lama->AdvancedSearch->Load();
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->Load();
		$this->Angsuran_Denda->AdvancedSearch->Load();
		$this->Dispensasi_Denda->AdvancedSearch->Load();
		$this->Angsuran_Pokok->AdvancedSearch->Load();
		$this->Angsuran_Bunga->AdvancedSearch->Load();
		$this->Angsuran_Total->AdvancedSearch->Load();
		$this->No_Ref->AdvancedSearch->Load();
		$this->Biaya_Administrasi->AdvancedSearch->Load();
		$this->Biaya_Materai->AdvancedSearch->Load();
		$this->marketing_id->AdvancedSearch->Load();
		$this->Periode->AdvancedSearch->Load();
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
			$lookuptblfilter = "`Status` <> 2";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
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

		/*$this->ListOptions->Add("print_x"); // Replace abclink with your name of the link
		$this->ListOptions->Items["print_x"]->Header = "<b>Print X</b>";*/
		$opt = &$this->ListOptions->Add("rincian_angsuran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(0); // Move to first column
		$opt = &$this->ListOptions->Add("angsuran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(1); // Move to first column
		$opt = &$this->ListOptions->Add("edit_angsuran");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(2); // Move to first column
		$opt = &$this->ListOptions->Add("titipan");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(3); // Move to first column
		$opt = &$this->ListOptions->Add("potongan");
		$opt->Header = "";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(4); // Move to first column
	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

		$pinjaman_id = $this->id->CurrentValue; //echo $pinjaman_id;
		$_SESSION["pinjaman_id"] = $pinjaman_id; //echo $_SESSION["pinjaman_id"];

		//$this->ListOptions->Items["print_x"]->Body = "<a href='./_custom_/print_x.php?id=".CurrentTable()->id->CurrentValue."'>Print X</a>";
		// check perubahan data master pinjaman
		// jika ada perubahan pada data master tapi sudah ada data pembayaran
		// maka perubahan harus tidak diperbolehkan

		if ($pinjaman_id <> "") {
			$q = "select * from t04_pinjamanangsurantemp where
			pinjaman_id = ".$pinjaman_id." and Tanggal_Bayar is not null"; //echo $q; //exit;
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
		$t04_pinjamanangsurantemp_id = 0;
		if ($pinjaman_id <> "") {

			//echo "-".$pinjaman_id;
			$t04_pinjamanangsurantemp_id = f_cari_detail_angsuran($pinjaman_id);
		}

		// cari angsuran terbaru
		$t04_angsuranbaru = 0;
		if ($pinjaman_id <> "") {

			//echo "-".$pinjaman_id;
			$t04_angsuranbaru = f_cariangsuranbaru($pinjaman_id);
		}
		$this->ListOptions->Items["rincian_angsuran"]->Body = "<a class=\"ewAddEdit ewAdd\" title=\"Rincian Angsuran\" data-caption=\"Rincian Angsuran\" href=\"t04_pinjamanangsurantemplist.php?showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."\">Rincian Angsuran</a>"; // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["angsuran"]->Body         = "<a class=\"ewAddEdit ewAdd\" title=\"Bayar Angsuran\"   data-caption=\"Bayar Angsuran\"   href=\"t04_pinjamanangsurantempedit.php?id=".$t04_angsuranbaru."&showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."\">Bayar Angsuran</a>"; // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["edit_angsuran"]->Body    = "<a class=\"ewAddEdit ewAdd\" title=\"Rincian Angsuran\" data-caption=\"Rincian Angsuran\" href=\"t04_pinjamanangsurantemplist.php?showmaster=t03_pinjaman&fk_id=".$_SESSION["pinjaman_id"]."&edit=1\">Edit Angsuran</a>"; // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["titipan"]->Body = "<a class=\"ewAddEdit ewAdd\" title=\"Setor Titipan\" data-caption=\"Setor Titipan\" href=\"t06_pinjamantitipanlist.php?showmaster=t03_pinjaman&fk_id=".$pinjaman_id."\">Setor Titipan</a>"; // definisikan link, style, dan caption tombol //"xxx";
		$this->ListOptions->Items["potongan"]->Body = "<a class=\"ewAddEdit ewAdd\" title=\"Potongan\" data-caption=\"Potongan\" href=\"t08_pinjamanpotonganlist.php?showmaster=t03_pinjaman&fk_id=".$pinjaman_id."\">Potongan</a>"; // definisikan link, style, dan caption tombol //"xxx";
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
if (!isset($t03_pinjaman_list)) $t03_pinjaman_list = new ct03_pinjaman_list();

// Page init
$t03_pinjaman_list->Page_Init();

// Page main
$t03_pinjaman_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_pinjaman_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft03_pinjamanlist = new ew_Form("ft03_pinjamanlist", "list");
ft03_pinjamanlist.FormKeyCountName = '<?php echo $t03_pinjaman_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft03_pinjamanlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_pinjamanlist.ValidateRequired = true;
<?php } else { ?>
ft03_pinjamanlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_pinjamanlist.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_jaminan_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
ft03_pinjamanlist.Lists["x_marketing_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_marketing"};

// Form object for search
var CurrentSearchForm = ft03_pinjamanlistsrch = new ew_Form("ft03_pinjamanlistsrch");

// Validate function for search
ft03_pinjamanlistsrch.Validate = function(fobj) {
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
ft03_pinjamanlistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_pinjamanlistsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
ft03_pinjamanlistsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
ft03_pinjamanlistsrch.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_jaminan_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_nasabahjaminan"};
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($t03_pinjaman_list->TotalRecs > 0 && $t03_pinjaman_list->ExportOptions->Visible()) { ?>
<?php $t03_pinjaman_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t03_pinjaman_list->SearchOptions->Visible()) { ?>
<?php $t03_pinjaman_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($t03_pinjaman_list->FilterOptions->Visible()) { ?>
<?php $t03_pinjaman_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $t03_pinjaman_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t03_pinjaman_list->TotalRecs <= 0)
			$t03_pinjaman_list->TotalRecs = $t03_pinjaman->SelectRecordCount();
	} else {
		if (!$t03_pinjaman_list->Recordset && ($t03_pinjaman_list->Recordset = $t03_pinjaman_list->LoadRecordset()))
			$t03_pinjaman_list->TotalRecs = $t03_pinjaman_list->Recordset->RecordCount();
	}
	$t03_pinjaman_list->StartRec = 1;
	if ($t03_pinjaman_list->DisplayRecs <= 0 || ($t03_pinjaman->Export <> "" && $t03_pinjaman->ExportAll)) // Display all records
		$t03_pinjaman_list->DisplayRecs = $t03_pinjaman_list->TotalRecs;
	if (!($t03_pinjaman->Export <> "" && $t03_pinjaman->ExportAll))
		$t03_pinjaman_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t03_pinjaman_list->Recordset = $t03_pinjaman_list->LoadRecordset($t03_pinjaman_list->StartRec-1, $t03_pinjaman_list->DisplayRecs);

	// Set no record found message
	if ($t03_pinjaman->CurrentAction == "" && $t03_pinjaman_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t03_pinjaman_list->setWarningMessage(ew_DeniedMsg());
		if ($t03_pinjaman_list->SearchWhere == "0=101")
			$t03_pinjaman_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t03_pinjaman_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($t03_pinjaman_list->AuditTrailOnSearch && $t03_pinjaman_list->Command == "search" && !$t03_pinjaman_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $t03_pinjaman_list->getSessionWhere();
		$t03_pinjaman_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$t03_pinjaman_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($t03_pinjaman->Export == "" && $t03_pinjaman->CurrentAction == "") { ?>
<form name="ft03_pinjamanlistsrch" id="ft03_pinjamanlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($t03_pinjaman_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ft03_pinjamanlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t03_pinjaman">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$t03_pinjaman_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$t03_pinjaman->RowType = EW_ROWTYPE_SEARCH;

// Render row
$t03_pinjaman->ResetAttrs();
$t03_pinjaman_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
	<div id="xsc_Kontrak_No" class="ewCell form-group">
		<label for="x_Kontrak_No" class="ewSearchCaption ewLabel"><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Kontrak_No" id="z_Kontrak_No" value="="></span>
		<span class="ewSearchField">
<input type="text" data-table="t03_pinjaman" data-field="x_Kontrak_No" name="x_Kontrak_No" id="x_Kontrak_No" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Kontrak_No->EditValue ?>"<?php echo $t03_pinjaman->Kontrak_No->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
	<div id="xsc_nasabah_id" class="ewCell form-group">
		<label for="x_nasabah_id" class="ewSearchCaption ewLabel"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><select name="z_nasabah_id" id="z_nasabah_id" class="form-control" onchange="ewForms(this).SrchOprChanged(this);"><option value="="<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "=") ? " selected" : "" ?> ><?php echo $Language->Phrase("EQUAL") ?></option><option value="<>"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "<>") ? " selected" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "<") ? " selected" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "<=") ? " selected" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == ">") ? " selected" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == ">=") ? " selected" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "NOT LIKE") ? " selected" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "STARTS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="ENDS WITH"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "ENDS WITH") ? " selected" : "" ?> ><?php echo $Language->Phrase("ENDS WITH") ?></option><option value="BETWEEN"<?php echo ($t03_pinjaman->nasabah_id->AdvancedSearch->SearchOperator == "BETWEEN") ? " selected" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span>
		<span class="ewSearchField">
<input type="text" data-table="t03_pinjaman" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->nasabah_id->EditValue ?>"<?php echo $t03_pinjaman->nasabah_id->EditAttributes() ?>>
</span>
		<span class="ewSearchCond btw1_nasabah_id" style="display: none">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
		<span class="ewSearchField btw1_nasabah_id" style="display: none">
<input type="text" data-table="t03_pinjaman" data-field="x_nasabah_id" name="y_nasabah_id" id="y_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->nasabah_id->EditValue2 ?>"<?php echo $t03_pinjaman->nasabah_id->EditAttributes() ?>>
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
<?php $t03_pinjaman_list->ShowPageHeader(); ?>
<?php
$t03_pinjaman_list->ShowMessage();
?>
<?php if ($t03_pinjaman_list->TotalRecs > 0 || $t03_pinjaman->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t03_pinjaman">
<form name="ft03_pinjamanlist" id="ft03_pinjamanlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_pinjaman_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_pinjaman_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_pinjaman">
<div id="gmp_t03_pinjaman" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t03_pinjaman_list->TotalRecs > 0 || $t03_pinjaman->CurrentAction == "gridedit") { ?>
<table id="tbl_t03_pinjamanlist" class="table ewTable">
<?php echo $t03_pinjaman->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t03_pinjaman_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t03_pinjaman_list->RenderListOptions();

// Render list options (header, left)
$t03_pinjaman_list->ListOptions->Render("header", "left");
?>
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
	<?php if ($t03_pinjaman->SortUrl($t03_pinjaman->Kontrak_No) == "") { ?>
		<th data-name="Kontrak_No"><div id="elh_t03_pinjaman_Kontrak_No" class="t03_pinjaman_Kontrak_No"><div class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_No"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t03_pinjaman->SortUrl($t03_pinjaman->Kontrak_No) ?>',2);"><div id="elh_t03_pinjaman_Kontrak_No" class="t03_pinjaman_Kontrak_No">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_pinjaman->Kontrak_No->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_pinjaman->Kontrak_No->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<?php if ($t03_pinjaman->SortUrl($t03_pinjaman->Kontrak_Tgl) == "") { ?>
		<th data-name="Kontrak_Tgl"><div id="elh_t03_pinjaman_Kontrak_Tgl" class="t03_pinjaman_Kontrak_Tgl"><div class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Kontrak_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_Tgl"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t03_pinjaman->SortUrl($t03_pinjaman->Kontrak_Tgl) ?>',2);"><div id="elh_t03_pinjaman_Kontrak_Tgl" class="t03_pinjaman_Kontrak_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Kontrak_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_pinjaman->Kontrak_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_pinjaman->Kontrak_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($t03_pinjaman->SortUrl($t03_pinjaman->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_t03_pinjaman_nasabah_id" class="t03_pinjaman_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t03_pinjaman->SortUrl($t03_pinjaman->nasabah_id) ?>',2);"><div id="elh_t03_pinjaman_nasabah_id" class="t03_pinjaman_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_pinjaman->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_pinjaman->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
	<?php if ($t03_pinjaman->SortUrl($t03_pinjaman->Pinjaman) == "") { ?>
		<th data-name="Pinjaman"><div id="elh_t03_pinjaman_Pinjaman" class="t03_pinjaman_Pinjaman"><div class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pinjaman"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t03_pinjaman->SortUrl($t03_pinjaman->Pinjaman) ?>',2);"><div id="elh_t03_pinjaman_Pinjaman" class="t03_pinjaman_Pinjaman">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_pinjaman->Pinjaman->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_pinjaman->Pinjaman->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_pinjaman->marketing_id->Visible) { // marketing_id ?>
	<?php if ($t03_pinjaman->SortUrl($t03_pinjaman->marketing_id) == "") { ?>
		<th data-name="marketing_id"><div id="elh_t03_pinjaman_marketing_id" class="t03_pinjaman_marketing_id"><div class="ewTableHeaderCaption"><?php echo $t03_pinjaman->marketing_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="marketing_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t03_pinjaman->SortUrl($t03_pinjaman->marketing_id) ?>',2);"><div id="elh_t03_pinjaman_marketing_id" class="t03_pinjaman_marketing_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_pinjaman->marketing_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_pinjaman->marketing_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_pinjaman->marketing_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t03_pinjaman_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t03_pinjaman->ExportAll && $t03_pinjaman->Export <> "") {
	$t03_pinjaman_list->StopRec = $t03_pinjaman_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t03_pinjaman_list->TotalRecs > $t03_pinjaman_list->StartRec + $t03_pinjaman_list->DisplayRecs - 1)
		$t03_pinjaman_list->StopRec = $t03_pinjaman_list->StartRec + $t03_pinjaman_list->DisplayRecs - 1;
	else
		$t03_pinjaman_list->StopRec = $t03_pinjaman_list->TotalRecs;
}
$t03_pinjaman_list->RecCnt = $t03_pinjaman_list->StartRec - 1;
if ($t03_pinjaman_list->Recordset && !$t03_pinjaman_list->Recordset->EOF) {
	$t03_pinjaman_list->Recordset->MoveFirst();
	$bSelectLimit = $t03_pinjaman_list->UseSelectLimit;
	if (!$bSelectLimit && $t03_pinjaman_list->StartRec > 1)
		$t03_pinjaman_list->Recordset->Move($t03_pinjaman_list->StartRec - 1);
} elseif (!$t03_pinjaman->AllowAddDeleteRow && $t03_pinjaman_list->StopRec == 0) {
	$t03_pinjaman_list->StopRec = $t03_pinjaman->GridAddRowCount;
}

// Initialize aggregate
$t03_pinjaman->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t03_pinjaman->ResetAttrs();
$t03_pinjaman_list->RenderRow();
while ($t03_pinjaman_list->RecCnt < $t03_pinjaman_list->StopRec) {
	$t03_pinjaman_list->RecCnt++;
	if (intval($t03_pinjaman_list->RecCnt) >= intval($t03_pinjaman_list->StartRec)) {
		$t03_pinjaman_list->RowCnt++;

		// Set up key count
		$t03_pinjaman_list->KeyCount = $t03_pinjaman_list->RowIndex;

		// Init row class and style
		$t03_pinjaman->ResetAttrs();
		$t03_pinjaman->CssClass = "";
		if ($t03_pinjaman->CurrentAction == "gridadd") {
		} else {
			$t03_pinjaman_list->LoadRowValues($t03_pinjaman_list->Recordset); // Load row values
		}
		$t03_pinjaman->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t03_pinjaman->RowAttrs = array_merge($t03_pinjaman->RowAttrs, array('data-rowindex'=>$t03_pinjaman_list->RowCnt, 'id'=>'r' . $t03_pinjaman_list->RowCnt . '_t03_pinjaman', 'data-rowtype'=>$t03_pinjaman->RowType));

		// Render row
		$t03_pinjaman_list->RenderRow();

		// Render list options
		$t03_pinjaman_list->RenderListOptions();
?>
	<tr<?php echo $t03_pinjaman->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t03_pinjaman_list->ListOptions->Render("body", "left", $t03_pinjaman_list->RowCnt);
?>
	<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
		<td data-name="Kontrak_No"<?php echo $t03_pinjaman->Kontrak_No->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_list->RowCnt ?>_t03_pinjaman_Kontrak_No" class="t03_pinjaman_Kontrak_No">
<span<?php echo $t03_pinjaman->Kontrak_No->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_No->ListViewValue() ?></span>
</span>
<a id="<?php echo $t03_pinjaman_list->PageObjName . "_row_" . $t03_pinjaman_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<td data-name="Kontrak_Tgl"<?php echo $t03_pinjaman->Kontrak_Tgl->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_list->RowCnt ?>_t03_pinjaman_Kontrak_Tgl" class="t03_pinjaman_Kontrak_Tgl">
<span<?php echo $t03_pinjaman->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_list->RowCnt ?>_t03_pinjaman_nasabah_id" class="t03_pinjaman_nasabah_id">
<span<?php echo $t03_pinjaman->nasabah_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->nasabah_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
		<td data-name="Pinjaman"<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_list->RowCnt ?>_t03_pinjaman_Pinjaman" class="t03_pinjaman_Pinjaman">
<span<?php echo $t03_pinjaman->Pinjaman->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Pinjaman->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t03_pinjaman->marketing_id->Visible) { // marketing_id ?>
		<td data-name="marketing_id"<?php echo $t03_pinjaman->marketing_id->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_list->RowCnt ?>_t03_pinjaman_marketing_id" class="t03_pinjaman_marketing_id">
<span<?php echo $t03_pinjaman->marketing_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->marketing_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t03_pinjaman_list->ListOptions->Render("body", "right", $t03_pinjaman_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($t03_pinjaman->CurrentAction <> "gridadd")
		$t03_pinjaman_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t03_pinjaman->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t03_pinjaman_list->Recordset)
	$t03_pinjaman_list->Recordset->Close();
?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t03_pinjaman->CurrentAction <> "gridadd" && $t03_pinjaman->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t03_pinjaman_list->Pager)) $t03_pinjaman_list->Pager = new cPrevNextPager($t03_pinjaman_list->StartRec, $t03_pinjaman_list->DisplayRecs, $t03_pinjaman_list->TotalRecs) ?>
<?php if ($t03_pinjaman_list->Pager->RecordCount > 0 && $t03_pinjaman_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_pinjaman_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_pinjaman_list->PageUrl() ?>start=<?php echo $t03_pinjaman_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_pinjaman_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_pinjaman_list->PageUrl() ?>start=<?php echo $t03_pinjaman_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_pinjaman_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_pinjaman_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_pinjaman_list->PageUrl() ?>start=<?php echo $t03_pinjaman_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_pinjaman_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_pinjaman_list->PageUrl() ?>start=<?php echo $t03_pinjaman_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_pinjaman_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t03_pinjaman_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t03_pinjaman_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t03_pinjaman_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t03_pinjaman_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $t03_pinjaman_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t03_pinjaman">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($t03_pinjaman_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t03_pinjaman_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($t03_pinjaman->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t03_pinjaman_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($t03_pinjaman_list->TotalRecs == 0 && $t03_pinjaman->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t03_pinjaman_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft03_pinjamanlistsrch.FilterList = <?php echo $t03_pinjaman_list->GetFilterList() ?>;
ft03_pinjamanlistsrch.Init();
ft03_pinjamanlist.Init();
</script>
<?php
$t03_pinjaman_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

	$(document).ready(function() { 
		$("#z_nasabah_id option[value='LIKE']").attr('selected', 'selected'); 
	});
</script>
<?php include_once "footer.php" ?>
<?php
$t03_pinjaman_list->Page_Terminate();
?>
