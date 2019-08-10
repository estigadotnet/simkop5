<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "v0302_pinjamanlapinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$v0302_pinjamanlap_list = NULL; // Initialize page object first

class cv0302_pinjamanlap_list extends cv0302_pinjamanlap {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'v0302_pinjamanlap';

	// Page object name
	var $PageObjName = 'v0302_pinjamanlap_list';

	// Grid form hidden field names
	var $FormName = 'fv0302_pinjamanlaplist';
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

		// Table object (v0302_pinjamanlap)
		if (!isset($GLOBALS["v0302_pinjamanlap"]) || get_class($GLOBALS["v0302_pinjamanlap"]) == "cv0302_pinjamanlap") {
			$GLOBALS["v0302_pinjamanlap"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v0302_pinjamanlap"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "v0302_pinjamanlapadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "v0302_pinjamanlapdelete.php";
		$this->MultiUpdateUrl = "v0302_pinjamanlapupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'v0302_pinjamanlap', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fv0302_pinjamanlaplistsrch";

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
		$this->pinjaman_id->SetVisibility();
		$this->pinjaman_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->jaminan_id->SetVisibility();
		$this->Pinjaman->SetVisibility();
		$this->Angsuran_Lama->SetVisibility();
		$this->Angsuran_Bunga_Prosen->SetVisibility();
		$this->Angsuran_Denda->SetVisibility();
		$this->Dispensasi_Denda->SetVisibility();
		$this->Angsuran_Pokok->SetVisibility();
		$this->Angsuran_Bunga->SetVisibility();
		$this->Angsuran_Total->SetVisibility();
		$this->No_Ref->SetVisibility();
		$this->Biaya_Administrasi->SetVisibility();
		$this->Biaya_Materai->SetVisibility();
		$this->marketing_id->SetVisibility();
		$this->Periode->SetVisibility();
		$this->Macet->SetVisibility();
		$this->NasabahNama->SetVisibility();
		$this->No_Telp_Hp->SetVisibility();
		$this->Pekerjaan->SetVisibility();
		$this->Pekerjaan_No_Telp_Hp->SetVisibility();
		$this->Status->SetVisibility();
		$this->NasabahKeterangan->SetVisibility();
		$this->MarketingNama->SetVisibility();
		$this->MarketingAlamat->SetVisibility();
		$this->NoHP->SetVisibility();
		$this->AkhirKontrak->SetVisibility();
		$this->sudah_bayar->SetVisibility();
		$this->pd_Angsuran_Pokok->SetVisibility();
		$this->pd_Angsuran_Bunga->SetVisibility();
		$this->pd_Angsuran_Total->SetVisibility();
		$this->Tanggal_Bayar->SetVisibility();
		$this->umur_tunggakan->SetVisibility();

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
		global $EW_EXPORT, $v0302_pinjamanlap;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($v0302_pinjamanlap);
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
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

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

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

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

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();

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
			$this->pinjaman_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->pinjaman_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "fv0302_pinjamanlaplistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->pinjaman_id->AdvancedSearch->ToJSON(), ","); // Field pinjaman_id
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
		$sFilterList = ew_Concat($sFilterList, $this->Macet->AdvancedSearch->ToJSON(), ","); // Field Macet
		$sFilterList = ew_Concat($sFilterList, $this->NasabahNama->AdvancedSearch->ToJSON(), ","); // Field NasabahNama
		$sFilterList = ew_Concat($sFilterList, $this->NasabahAlamat->AdvancedSearch->ToJSON(), ","); // Field NasabahAlamat
		$sFilterList = ew_Concat($sFilterList, $this->No_Telp_Hp->AdvancedSearch->ToJSON(), ","); // Field No_Telp_Hp
		$sFilterList = ew_Concat($sFilterList, $this->Pekerjaan->AdvancedSearch->ToJSON(), ","); // Field Pekerjaan
		$sFilterList = ew_Concat($sFilterList, $this->Pekerjaan_Alamat->AdvancedSearch->ToJSON(), ","); // Field Pekerjaan_Alamat
		$sFilterList = ew_Concat($sFilterList, $this->Pekerjaan_No_Telp_Hp->AdvancedSearch->ToJSON(), ","); // Field Pekerjaan_No_Telp_Hp
		$sFilterList = ew_Concat($sFilterList, $this->Status->AdvancedSearch->ToJSON(), ","); // Field Status
		$sFilterList = ew_Concat($sFilterList, $this->NasabahKeterangan->AdvancedSearch->ToJSON(), ","); // Field NasabahKeterangan
		$sFilterList = ew_Concat($sFilterList, $this->MarketingNama->AdvancedSearch->ToJSON(), ","); // Field MarketingNama
		$sFilterList = ew_Concat($sFilterList, $this->MarketingAlamat->AdvancedSearch->ToJSON(), ","); // Field MarketingAlamat
		$sFilterList = ew_Concat($sFilterList, $this->NoHP->AdvancedSearch->ToJSON(), ","); // Field NoHP
		$sFilterList = ew_Concat($sFilterList, $this->AkhirKontrak->AdvancedSearch->ToJSON(), ","); // Field AkhirKontrak
		$sFilterList = ew_Concat($sFilterList, $this->sudah_bayar->AdvancedSearch->ToJSON(), ","); // Field sudah_bayar
		$sFilterList = ew_Concat($sFilterList, $this->pd_Angsuran_Pokok->AdvancedSearch->ToJSON(), ","); // Field pd_Angsuran_Pokok
		$sFilterList = ew_Concat($sFilterList, $this->pd_Angsuran_Bunga->AdvancedSearch->ToJSON(), ","); // Field pd_Angsuran_Bunga
		$sFilterList = ew_Concat($sFilterList, $this->pd_Angsuran_Total->AdvancedSearch->ToJSON(), ","); // Field pd_Angsuran_Total
		$sFilterList = ew_Concat($sFilterList, $this->Tanggal_Bayar->AdvancedSearch->ToJSON(), ","); // Field Tanggal_Bayar
		$sFilterList = ew_Concat($sFilterList, $this->umur_tunggakan->AdvancedSearch->ToJSON(), ","); // Field umur_tunggakan
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fv0302_pinjamanlaplistsrch", $filters);

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

		// Field pinjaman_id
		$this->pinjaman_id->AdvancedSearch->SearchValue = @$filter["x_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchOperator = @$filter["z_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchCondition = @$filter["v_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchValue2 = @$filter["y_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->SearchOperator2 = @$filter["w_pinjaman_id"];
		$this->pinjaman_id->AdvancedSearch->Save();

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

		// Field Macet
		$this->Macet->AdvancedSearch->SearchValue = @$filter["x_Macet"];
		$this->Macet->AdvancedSearch->SearchOperator = @$filter["z_Macet"];
		$this->Macet->AdvancedSearch->SearchCondition = @$filter["v_Macet"];
		$this->Macet->AdvancedSearch->SearchValue2 = @$filter["y_Macet"];
		$this->Macet->AdvancedSearch->SearchOperator2 = @$filter["w_Macet"];
		$this->Macet->AdvancedSearch->Save();

		// Field NasabahNama
		$this->NasabahNama->AdvancedSearch->SearchValue = @$filter["x_NasabahNama"];
		$this->NasabahNama->AdvancedSearch->SearchOperator = @$filter["z_NasabahNama"];
		$this->NasabahNama->AdvancedSearch->SearchCondition = @$filter["v_NasabahNama"];
		$this->NasabahNama->AdvancedSearch->SearchValue2 = @$filter["y_NasabahNama"];
		$this->NasabahNama->AdvancedSearch->SearchOperator2 = @$filter["w_NasabahNama"];
		$this->NasabahNama->AdvancedSearch->Save();

		// Field NasabahAlamat
		$this->NasabahAlamat->AdvancedSearch->SearchValue = @$filter["x_NasabahAlamat"];
		$this->NasabahAlamat->AdvancedSearch->SearchOperator = @$filter["z_NasabahAlamat"];
		$this->NasabahAlamat->AdvancedSearch->SearchCondition = @$filter["v_NasabahAlamat"];
		$this->NasabahAlamat->AdvancedSearch->SearchValue2 = @$filter["y_NasabahAlamat"];
		$this->NasabahAlamat->AdvancedSearch->SearchOperator2 = @$filter["w_NasabahAlamat"];
		$this->NasabahAlamat->AdvancedSearch->Save();

		// Field No_Telp_Hp
		$this->No_Telp_Hp->AdvancedSearch->SearchValue = @$filter["x_No_Telp_Hp"];
		$this->No_Telp_Hp->AdvancedSearch->SearchOperator = @$filter["z_No_Telp_Hp"];
		$this->No_Telp_Hp->AdvancedSearch->SearchCondition = @$filter["v_No_Telp_Hp"];
		$this->No_Telp_Hp->AdvancedSearch->SearchValue2 = @$filter["y_No_Telp_Hp"];
		$this->No_Telp_Hp->AdvancedSearch->SearchOperator2 = @$filter["w_No_Telp_Hp"];
		$this->No_Telp_Hp->AdvancedSearch->Save();

		// Field Pekerjaan
		$this->Pekerjaan->AdvancedSearch->SearchValue = @$filter["x_Pekerjaan"];
		$this->Pekerjaan->AdvancedSearch->SearchOperator = @$filter["z_Pekerjaan"];
		$this->Pekerjaan->AdvancedSearch->SearchCondition = @$filter["v_Pekerjaan"];
		$this->Pekerjaan->AdvancedSearch->SearchValue2 = @$filter["y_Pekerjaan"];
		$this->Pekerjaan->AdvancedSearch->SearchOperator2 = @$filter["w_Pekerjaan"];
		$this->Pekerjaan->AdvancedSearch->Save();

		// Field Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchValue = @$filter["x_Pekerjaan_Alamat"];
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchOperator = @$filter["z_Pekerjaan_Alamat"];
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchCondition = @$filter["v_Pekerjaan_Alamat"];
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchValue2 = @$filter["y_Pekerjaan_Alamat"];
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchOperator2 = @$filter["w_Pekerjaan_Alamat"];
		$this->Pekerjaan_Alamat->AdvancedSearch->Save();

		// Field Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue = @$filter["x_Pekerjaan_No_Telp_Hp"];
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchOperator = @$filter["z_Pekerjaan_No_Telp_Hp"];
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchCondition = @$filter["v_Pekerjaan_No_Telp_Hp"];
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue2 = @$filter["y_Pekerjaan_No_Telp_Hp"];
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchOperator2 = @$filter["w_Pekerjaan_No_Telp_Hp"];
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->Save();

		// Field Status
		$this->Status->AdvancedSearch->SearchValue = @$filter["x_Status"];
		$this->Status->AdvancedSearch->SearchOperator = @$filter["z_Status"];
		$this->Status->AdvancedSearch->SearchCondition = @$filter["v_Status"];
		$this->Status->AdvancedSearch->SearchValue2 = @$filter["y_Status"];
		$this->Status->AdvancedSearch->SearchOperator2 = @$filter["w_Status"];
		$this->Status->AdvancedSearch->Save();

		// Field NasabahKeterangan
		$this->NasabahKeterangan->AdvancedSearch->SearchValue = @$filter["x_NasabahKeterangan"];
		$this->NasabahKeterangan->AdvancedSearch->SearchOperator = @$filter["z_NasabahKeterangan"];
		$this->NasabahKeterangan->AdvancedSearch->SearchCondition = @$filter["v_NasabahKeterangan"];
		$this->NasabahKeterangan->AdvancedSearch->SearchValue2 = @$filter["y_NasabahKeterangan"];
		$this->NasabahKeterangan->AdvancedSearch->SearchOperator2 = @$filter["w_NasabahKeterangan"];
		$this->NasabahKeterangan->AdvancedSearch->Save();

		// Field MarketingNama
		$this->MarketingNama->AdvancedSearch->SearchValue = @$filter["x_MarketingNama"];
		$this->MarketingNama->AdvancedSearch->SearchOperator = @$filter["z_MarketingNama"];
		$this->MarketingNama->AdvancedSearch->SearchCondition = @$filter["v_MarketingNama"];
		$this->MarketingNama->AdvancedSearch->SearchValue2 = @$filter["y_MarketingNama"];
		$this->MarketingNama->AdvancedSearch->SearchOperator2 = @$filter["w_MarketingNama"];
		$this->MarketingNama->AdvancedSearch->Save();

		// Field MarketingAlamat
		$this->MarketingAlamat->AdvancedSearch->SearchValue = @$filter["x_MarketingAlamat"];
		$this->MarketingAlamat->AdvancedSearch->SearchOperator = @$filter["z_MarketingAlamat"];
		$this->MarketingAlamat->AdvancedSearch->SearchCondition = @$filter["v_MarketingAlamat"];
		$this->MarketingAlamat->AdvancedSearch->SearchValue2 = @$filter["y_MarketingAlamat"];
		$this->MarketingAlamat->AdvancedSearch->SearchOperator2 = @$filter["w_MarketingAlamat"];
		$this->MarketingAlamat->AdvancedSearch->Save();

		// Field NoHP
		$this->NoHP->AdvancedSearch->SearchValue = @$filter["x_NoHP"];
		$this->NoHP->AdvancedSearch->SearchOperator = @$filter["z_NoHP"];
		$this->NoHP->AdvancedSearch->SearchCondition = @$filter["v_NoHP"];
		$this->NoHP->AdvancedSearch->SearchValue2 = @$filter["y_NoHP"];
		$this->NoHP->AdvancedSearch->SearchOperator2 = @$filter["w_NoHP"];
		$this->NoHP->AdvancedSearch->Save();

		// Field AkhirKontrak
		$this->AkhirKontrak->AdvancedSearch->SearchValue = @$filter["x_AkhirKontrak"];
		$this->AkhirKontrak->AdvancedSearch->SearchOperator = @$filter["z_AkhirKontrak"];
		$this->AkhirKontrak->AdvancedSearch->SearchCondition = @$filter["v_AkhirKontrak"];
		$this->AkhirKontrak->AdvancedSearch->SearchValue2 = @$filter["y_AkhirKontrak"];
		$this->AkhirKontrak->AdvancedSearch->SearchOperator2 = @$filter["w_AkhirKontrak"];
		$this->AkhirKontrak->AdvancedSearch->Save();

		// Field sudah_bayar
		$this->sudah_bayar->AdvancedSearch->SearchValue = @$filter["x_sudah_bayar"];
		$this->sudah_bayar->AdvancedSearch->SearchOperator = @$filter["z_sudah_bayar"];
		$this->sudah_bayar->AdvancedSearch->SearchCondition = @$filter["v_sudah_bayar"];
		$this->sudah_bayar->AdvancedSearch->SearchValue2 = @$filter["y_sudah_bayar"];
		$this->sudah_bayar->AdvancedSearch->SearchOperator2 = @$filter["w_sudah_bayar"];
		$this->sudah_bayar->AdvancedSearch->Save();

		// Field pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue = @$filter["x_pd_Angsuran_Pokok"];
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchOperator = @$filter["z_pd_Angsuran_Pokok"];
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchCondition = @$filter["v_pd_Angsuran_Pokok"];
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue2 = @$filter["y_pd_Angsuran_Pokok"];
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchOperator2 = @$filter["w_pd_Angsuran_Pokok"];
		$this->pd_Angsuran_Pokok->AdvancedSearch->Save();

		// Field pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue = @$filter["x_pd_Angsuran_Bunga"];
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchOperator = @$filter["z_pd_Angsuran_Bunga"];
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchCondition = @$filter["v_pd_Angsuran_Bunga"];
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue2 = @$filter["y_pd_Angsuran_Bunga"];
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchOperator2 = @$filter["w_pd_Angsuran_Bunga"];
		$this->pd_Angsuran_Bunga->AdvancedSearch->Save();

		// Field pd_Angsuran_Total
		$this->pd_Angsuran_Total->AdvancedSearch->SearchValue = @$filter["x_pd_Angsuran_Total"];
		$this->pd_Angsuran_Total->AdvancedSearch->SearchOperator = @$filter["z_pd_Angsuran_Total"];
		$this->pd_Angsuran_Total->AdvancedSearch->SearchCondition = @$filter["v_pd_Angsuran_Total"];
		$this->pd_Angsuran_Total->AdvancedSearch->SearchValue2 = @$filter["y_pd_Angsuran_Total"];
		$this->pd_Angsuran_Total->AdvancedSearch->SearchOperator2 = @$filter["w_pd_Angsuran_Total"];
		$this->pd_Angsuran_Total->AdvancedSearch->Save();

		// Field Tanggal_Bayar
		$this->Tanggal_Bayar->AdvancedSearch->SearchValue = @$filter["x_Tanggal_Bayar"];
		$this->Tanggal_Bayar->AdvancedSearch->SearchOperator = @$filter["z_Tanggal_Bayar"];
		$this->Tanggal_Bayar->AdvancedSearch->SearchCondition = @$filter["v_Tanggal_Bayar"];
		$this->Tanggal_Bayar->AdvancedSearch->SearchValue2 = @$filter["y_Tanggal_Bayar"];
		$this->Tanggal_Bayar->AdvancedSearch->SearchOperator2 = @$filter["w_Tanggal_Bayar"];
		$this->Tanggal_Bayar->AdvancedSearch->Save();

		// Field umur_tunggakan
		$this->umur_tunggakan->AdvancedSearch->SearchValue = @$filter["x_umur_tunggakan"];
		$this->umur_tunggakan->AdvancedSearch->SearchOperator = @$filter["z_umur_tunggakan"];
		$this->umur_tunggakan->AdvancedSearch->SearchCondition = @$filter["v_umur_tunggakan"];
		$this->umur_tunggakan->AdvancedSearch->SearchValue2 = @$filter["y_umur_tunggakan"];
		$this->umur_tunggakan->AdvancedSearch->SearchOperator2 = @$filter["w_umur_tunggakan"];
		$this->umur_tunggakan->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->pinjaman_id, $Default, FALSE); // pinjaman_id
		$this->BuildSearchSql($sWhere, $this->Kontrak_No, $Default, FALSE); // Kontrak_No
		$this->BuildSearchSql($sWhere, $this->Kontrak_Tgl, $Default, FALSE); // Kontrak_Tgl
		$this->BuildSearchSql($sWhere, $this->nasabah_id, $Default, FALSE); // nasabah_id
		$this->BuildSearchSql($sWhere, $this->jaminan_id, $Default, FALSE); // jaminan_id
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
		$this->BuildSearchSql($sWhere, $this->Macet, $Default, FALSE); // Macet
		$this->BuildSearchSql($sWhere, $this->NasabahNama, $Default, FALSE); // NasabahNama
		$this->BuildSearchSql($sWhere, $this->NasabahAlamat, $Default, FALSE); // NasabahAlamat
		$this->BuildSearchSql($sWhere, $this->No_Telp_Hp, $Default, FALSE); // No_Telp_Hp
		$this->BuildSearchSql($sWhere, $this->Pekerjaan, $Default, FALSE); // Pekerjaan
		$this->BuildSearchSql($sWhere, $this->Pekerjaan_Alamat, $Default, FALSE); // Pekerjaan_Alamat
		$this->BuildSearchSql($sWhere, $this->Pekerjaan_No_Telp_Hp, $Default, FALSE); // Pekerjaan_No_Telp_Hp
		$this->BuildSearchSql($sWhere, $this->Status, $Default, FALSE); // Status
		$this->BuildSearchSql($sWhere, $this->NasabahKeterangan, $Default, FALSE); // NasabahKeterangan
		$this->BuildSearchSql($sWhere, $this->MarketingNama, $Default, FALSE); // MarketingNama
		$this->BuildSearchSql($sWhere, $this->MarketingAlamat, $Default, FALSE); // MarketingAlamat
		$this->BuildSearchSql($sWhere, $this->NoHP, $Default, FALSE); // NoHP
		$this->BuildSearchSql($sWhere, $this->AkhirKontrak, $Default, FALSE); // AkhirKontrak
		$this->BuildSearchSql($sWhere, $this->sudah_bayar, $Default, FALSE); // sudah_bayar
		$this->BuildSearchSql($sWhere, $this->pd_Angsuran_Pokok, $Default, FALSE); // pd_Angsuran_Pokok
		$this->BuildSearchSql($sWhere, $this->pd_Angsuran_Bunga, $Default, FALSE); // pd_Angsuran_Bunga
		$this->BuildSearchSql($sWhere, $this->pd_Angsuran_Total, $Default, FALSE); // pd_Angsuran_Total
		$this->BuildSearchSql($sWhere, $this->Tanggal_Bayar, $Default, FALSE); // Tanggal_Bayar
		$this->BuildSearchSql($sWhere, $this->umur_tunggakan, $Default, FALSE); // umur_tunggakan

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->pinjaman_id->AdvancedSearch->Save(); // pinjaman_id
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
			$this->Macet->AdvancedSearch->Save(); // Macet
			$this->NasabahNama->AdvancedSearch->Save(); // NasabahNama
			$this->NasabahAlamat->AdvancedSearch->Save(); // NasabahAlamat
			$this->No_Telp_Hp->AdvancedSearch->Save(); // No_Telp_Hp
			$this->Pekerjaan->AdvancedSearch->Save(); // Pekerjaan
			$this->Pekerjaan_Alamat->AdvancedSearch->Save(); // Pekerjaan_Alamat
			$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->Save(); // Pekerjaan_No_Telp_Hp
			$this->Status->AdvancedSearch->Save(); // Status
			$this->NasabahKeterangan->AdvancedSearch->Save(); // NasabahKeterangan
			$this->MarketingNama->AdvancedSearch->Save(); // MarketingNama
			$this->MarketingAlamat->AdvancedSearch->Save(); // MarketingAlamat
			$this->NoHP->AdvancedSearch->Save(); // NoHP
			$this->AkhirKontrak->AdvancedSearch->Save(); // AkhirKontrak
			$this->sudah_bayar->AdvancedSearch->Save(); // sudah_bayar
			$this->pd_Angsuran_Pokok->AdvancedSearch->Save(); // pd_Angsuran_Pokok
			$this->pd_Angsuran_Bunga->AdvancedSearch->Save(); // pd_Angsuran_Bunga
			$this->pd_Angsuran_Total->AdvancedSearch->Save(); // pd_Angsuran_Total
			$this->Tanggal_Bayar->AdvancedSearch->Save(); // Tanggal_Bayar
			$this->umur_tunggakan->AdvancedSearch->Save(); // umur_tunggakan
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

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->Kontrak_No, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->jaminan_id, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->No_Ref, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->Periode, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->NasabahNama, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->NasabahAlamat, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->No_Telp_Hp, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->Pekerjaan, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->Pekerjaan_Alamat, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->Pekerjaan_No_Telp_Hp, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->NasabahKeterangan, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->MarketingNama, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->MarketingAlamat, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->NoHP, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .=  "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "=") {
				$ar = array();

				// Match quoted keywords (i.e.: "...")
				if (preg_match_all('/"([^"]*)"/i', $sSearch, $matches, PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$p = strpos($sSearch, $match[0]);
						$str = substr($sSearch, 0, $p);
						$sSearch = substr($sSearch, $p + strlen($match[0]));
						if (strlen(trim($str)) > 0)
							$ar = array_merge($ar, explode(" ", trim($str)));
						$ar[] = $match[1]; // Save quoted keyword
					}
				}

				// Match individual keywords
				if (strlen(trim($sSearch)) > 0)
					$ar = array_merge($ar, explode(" ", trim($sSearch)));

				// Search keyword in any fields
				if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
					foreach ($ar as $sKeyword) {
						if ($sKeyword <> "") {
							if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
							$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
						}
					}
				} else {
					$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL(array($sSearch), $sSearchType);
			}
			if (!$Default) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		if ($this->pinjaman_id->AdvancedSearch->IssetSession())
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
		if ($this->Macet->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->NasabahNama->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->NasabahAlamat->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->No_Telp_Hp->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Pekerjaan->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Pekerjaan_Alamat->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Pekerjaan_No_Telp_Hp->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Status->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->NasabahKeterangan->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->MarketingNama->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->MarketingAlamat->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->NoHP->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->AkhirKontrak->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->sudah_bayar->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pd_Angsuran_Pokok->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pd_Angsuran_Bunga->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pd_Angsuran_Total->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Tanggal_Bayar->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->umur_tunggakan->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->pinjaman_id->AdvancedSearch->UnsetSession();
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
		$this->Macet->AdvancedSearch->UnsetSession();
		$this->NasabahNama->AdvancedSearch->UnsetSession();
		$this->NasabahAlamat->AdvancedSearch->UnsetSession();
		$this->No_Telp_Hp->AdvancedSearch->UnsetSession();
		$this->Pekerjaan->AdvancedSearch->UnsetSession();
		$this->Pekerjaan_Alamat->AdvancedSearch->UnsetSession();
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->UnsetSession();
		$this->Status->AdvancedSearch->UnsetSession();
		$this->NasabahKeterangan->AdvancedSearch->UnsetSession();
		$this->MarketingNama->AdvancedSearch->UnsetSession();
		$this->MarketingAlamat->AdvancedSearch->UnsetSession();
		$this->NoHP->AdvancedSearch->UnsetSession();
		$this->AkhirKontrak->AdvancedSearch->UnsetSession();
		$this->sudah_bayar->AdvancedSearch->UnsetSession();
		$this->pd_Angsuran_Pokok->AdvancedSearch->UnsetSession();
		$this->pd_Angsuran_Bunga->AdvancedSearch->UnsetSession();
		$this->pd_Angsuran_Total->AdvancedSearch->UnsetSession();
		$this->Tanggal_Bayar->AdvancedSearch->UnsetSession();
		$this->umur_tunggakan->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->pinjaman_id->AdvancedSearch->Load();
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
		$this->Macet->AdvancedSearch->Load();
		$this->NasabahNama->AdvancedSearch->Load();
		$this->NasabahAlamat->AdvancedSearch->Load();
		$this->No_Telp_Hp->AdvancedSearch->Load();
		$this->Pekerjaan->AdvancedSearch->Load();
		$this->Pekerjaan_Alamat->AdvancedSearch->Load();
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->Load();
		$this->Status->AdvancedSearch->Load();
		$this->NasabahKeterangan->AdvancedSearch->Load();
		$this->MarketingNama->AdvancedSearch->Load();
		$this->MarketingAlamat->AdvancedSearch->Load();
		$this->NoHP->AdvancedSearch->Load();
		$this->AkhirKontrak->AdvancedSearch->Load();
		$this->sudah_bayar->AdvancedSearch->Load();
		$this->pd_Angsuran_Pokok->AdvancedSearch->Load();
		$this->pd_Angsuran_Bunga->AdvancedSearch->Load();
		$this->pd_Angsuran_Total->AdvancedSearch->Load();
		$this->Tanggal_Bayar->AdvancedSearch->Load();
		$this->umur_tunggakan->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->pinjaman_id, $bCtrl); // pinjaman_id
			$this->UpdateSort($this->Kontrak_No, $bCtrl); // Kontrak_No
			$this->UpdateSort($this->Kontrak_Tgl, $bCtrl); // Kontrak_Tgl
			$this->UpdateSort($this->nasabah_id, $bCtrl); // nasabah_id
			$this->UpdateSort($this->jaminan_id, $bCtrl); // jaminan_id
			$this->UpdateSort($this->Pinjaman, $bCtrl); // Pinjaman
			$this->UpdateSort($this->Angsuran_Lama, $bCtrl); // Angsuran_Lama
			$this->UpdateSort($this->Angsuran_Bunga_Prosen, $bCtrl); // Angsuran_Bunga_Prosen
			$this->UpdateSort($this->Angsuran_Denda, $bCtrl); // Angsuran_Denda
			$this->UpdateSort($this->Dispensasi_Denda, $bCtrl); // Dispensasi_Denda
			$this->UpdateSort($this->Angsuran_Pokok, $bCtrl); // Angsuran_Pokok
			$this->UpdateSort($this->Angsuran_Bunga, $bCtrl); // Angsuran_Bunga
			$this->UpdateSort($this->Angsuran_Total, $bCtrl); // Angsuran_Total
			$this->UpdateSort($this->No_Ref, $bCtrl); // No_Ref
			$this->UpdateSort($this->Biaya_Administrasi, $bCtrl); // Biaya_Administrasi
			$this->UpdateSort($this->Biaya_Materai, $bCtrl); // Biaya_Materai
			$this->UpdateSort($this->marketing_id, $bCtrl); // marketing_id
			$this->UpdateSort($this->Periode, $bCtrl); // Periode
			$this->UpdateSort($this->Macet, $bCtrl); // Macet
			$this->UpdateSort($this->NasabahNama, $bCtrl); // NasabahNama
			$this->UpdateSort($this->No_Telp_Hp, $bCtrl); // No_Telp_Hp
			$this->UpdateSort($this->Pekerjaan, $bCtrl); // Pekerjaan
			$this->UpdateSort($this->Pekerjaan_No_Telp_Hp, $bCtrl); // Pekerjaan_No_Telp_Hp
			$this->UpdateSort($this->Status, $bCtrl); // Status
			$this->UpdateSort($this->NasabahKeterangan, $bCtrl); // NasabahKeterangan
			$this->UpdateSort($this->MarketingNama, $bCtrl); // MarketingNama
			$this->UpdateSort($this->MarketingAlamat, $bCtrl); // MarketingAlamat
			$this->UpdateSort($this->NoHP, $bCtrl); // NoHP
			$this->UpdateSort($this->AkhirKontrak, $bCtrl); // AkhirKontrak
			$this->UpdateSort($this->sudah_bayar, $bCtrl); // sudah_bayar
			$this->UpdateSort($this->pd_Angsuran_Pokok, $bCtrl); // pd_Angsuran_Pokok
			$this->UpdateSort($this->pd_Angsuran_Bunga, $bCtrl); // pd_Angsuran_Bunga
			$this->UpdateSort($this->pd_Angsuran_Total, $bCtrl); // pd_Angsuran_Total
			$this->UpdateSort($this->Tanggal_Bayar, $bCtrl); // Tanggal_Bayar
			$this->UpdateSort($this->umur_tunggakan, $bCtrl); // umur_tunggakan
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
				$this->pinjaman_id->setSort("");
				$this->Kontrak_No->setSort("");
				$this->Kontrak_Tgl->setSort("");
				$this->nasabah_id->setSort("");
				$this->jaminan_id->setSort("");
				$this->Pinjaman->setSort("");
				$this->Angsuran_Lama->setSort("");
				$this->Angsuran_Bunga_Prosen->setSort("");
				$this->Angsuran_Denda->setSort("");
				$this->Dispensasi_Denda->setSort("");
				$this->Angsuran_Pokok->setSort("");
				$this->Angsuran_Bunga->setSort("");
				$this->Angsuran_Total->setSort("");
				$this->No_Ref->setSort("");
				$this->Biaya_Administrasi->setSort("");
				$this->Biaya_Materai->setSort("");
				$this->marketing_id->setSort("");
				$this->Periode->setSort("");
				$this->Macet->setSort("");
				$this->NasabahNama->setSort("");
				$this->No_Telp_Hp->setSort("");
				$this->Pekerjaan->setSort("");
				$this->Pekerjaan_No_Telp_Hp->setSort("");
				$this->Status->setSort("");
				$this->NasabahKeterangan->setSort("");
				$this->MarketingNama->setSort("");
				$this->MarketingAlamat->setSort("");
				$this->NoHP->setSort("");
				$this->AkhirKontrak->setSort("");
				$this->sudah_bayar->setSort("");
				$this->pd_Angsuran_Pokok->setSort("");
				$this->pd_Angsuran_Bunga->setSort("");
				$this->pd_Angsuran_Total->setSort("");
				$this->Tanggal_Bayar->setSort("");
				$this->umur_tunggakan->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->pinjaman_id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fv0302_pinjamanlaplistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fv0302_pinjamanlaplistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fv0302_pinjamanlaplist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fv0302_pinjamanlaplistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		if (ew_IsMobile())
			$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"v0302_pinjamanlapsrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<button type=\"button\" class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-table=\"v0302_pinjamanlap\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" onclick=\"ew_ModalDialogShow({lnk:this,url:'v0302_pinjamanlapsrch.php',caption:'" . $Language->Phrase("Search") . "'});\">" . $Language->Phrase("AdvancedSearchBtn") . "</button>";
		$item->Visible = TRUE;

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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// pinjaman_id

		$this->pinjaman_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pinjaman_id"]);
		if ($this->pinjaman_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->pinjaman_id->AdvancedSearch->SearchOperator = @$_GET["z_pinjaman_id"];

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

		// jaminan_id
		$this->jaminan_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_jaminan_id"]);
		if ($this->jaminan_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->jaminan_id->AdvancedSearch->SearchOperator = @$_GET["z_jaminan_id"];

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

		// Macet
		$this->Macet->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Macet"]);
		if ($this->Macet->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Macet->AdvancedSearch->SearchOperator = @$_GET["z_Macet"];

		// NasabahNama
		$this->NasabahNama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_NasabahNama"]);
		if ($this->NasabahNama->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->NasabahNama->AdvancedSearch->SearchOperator = @$_GET["z_NasabahNama"];

		// NasabahAlamat
		$this->NasabahAlamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_NasabahAlamat"]);
		if ($this->NasabahAlamat->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->NasabahAlamat->AdvancedSearch->SearchOperator = @$_GET["z_NasabahAlamat"];

		// No_Telp_Hp
		$this->No_Telp_Hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_No_Telp_Hp"]);
		if ($this->No_Telp_Hp->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->No_Telp_Hp->AdvancedSearch->SearchOperator = @$_GET["z_No_Telp_Hp"];

		// Pekerjaan
		$this->Pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Pekerjaan"]);
		if ($this->Pekerjaan->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_Pekerjaan"];

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Pekerjaan_Alamat"]);
		if ($this->Pekerjaan_Alamat->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchOperator = @$_GET["z_Pekerjaan_Alamat"];

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Pekerjaan_No_Telp_Hp"]);
		if ($this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchOperator = @$_GET["z_Pekerjaan_No_Telp_Hp"];

		// Status
		$this->Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Status"]);
		if ($this->Status->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Status->AdvancedSearch->SearchOperator = @$_GET["z_Status"];

		// NasabahKeterangan
		$this->NasabahKeterangan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_NasabahKeterangan"]);
		if ($this->NasabahKeterangan->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->NasabahKeterangan->AdvancedSearch->SearchOperator = @$_GET["z_NasabahKeterangan"];

		// MarketingNama
		$this->MarketingNama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_MarketingNama"]);
		if ($this->MarketingNama->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->MarketingNama->AdvancedSearch->SearchOperator = @$_GET["z_MarketingNama"];

		// MarketingAlamat
		$this->MarketingAlamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_MarketingAlamat"]);
		if ($this->MarketingAlamat->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->MarketingAlamat->AdvancedSearch->SearchOperator = @$_GET["z_MarketingAlamat"];

		// NoHP
		$this->NoHP->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_NoHP"]);
		if ($this->NoHP->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->NoHP->AdvancedSearch->SearchOperator = @$_GET["z_NoHP"];

		// AkhirKontrak
		$this->AkhirKontrak->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_AkhirKontrak"]);
		if ($this->AkhirKontrak->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->AkhirKontrak->AdvancedSearch->SearchOperator = @$_GET["z_AkhirKontrak"];

		// sudah_bayar
		$this->sudah_bayar->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sudah_bayar"]);
		if ($this->sudah_bayar->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->sudah_bayar->AdvancedSearch->SearchOperator = @$_GET["z_sudah_bayar"];

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pd_Angsuran_Pokok"]);
		if ($this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchOperator = @$_GET["z_pd_Angsuran_Pokok"];

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pd_Angsuran_Bunga"]);
		if ($this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchOperator = @$_GET["z_pd_Angsuran_Bunga"];

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pd_Angsuran_Total"]);
		if ($this->pd_Angsuran_Total->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->pd_Angsuran_Total->AdvancedSearch->SearchOperator = @$_GET["z_pd_Angsuran_Total"];

		// Tanggal_Bayar
		$this->Tanggal_Bayar->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Tanggal_Bayar"]);
		if ($this->Tanggal_Bayar->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Tanggal_Bayar->AdvancedSearch->SearchOperator = @$_GET["z_Tanggal_Bayar"];

		// umur_tunggakan
		$this->umur_tunggakan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_umur_tunggakan"]);
		if ($this->umur_tunggakan->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->umur_tunggakan->AdvancedSearch->SearchOperator = @$_GET["z_umur_tunggakan"];
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
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
		$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
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
		$this->Macet->setDbValue($rs->fields('Macet'));
		$this->NasabahNama->setDbValue($rs->fields('NasabahNama'));
		$this->NasabahAlamat->setDbValue($rs->fields('NasabahAlamat'));
		$this->No_Telp_Hp->setDbValue($rs->fields('No_Telp_Hp'));
		$this->Pekerjaan->setDbValue($rs->fields('Pekerjaan'));
		$this->Pekerjaan_Alamat->setDbValue($rs->fields('Pekerjaan_Alamat'));
		$this->Pekerjaan_No_Telp_Hp->setDbValue($rs->fields('Pekerjaan_No_Telp_Hp'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->NasabahKeterangan->setDbValue($rs->fields('NasabahKeterangan'));
		$this->MarketingNama->setDbValue($rs->fields('MarketingNama'));
		$this->MarketingAlamat->setDbValue($rs->fields('MarketingAlamat'));
		$this->NoHP->setDbValue($rs->fields('NoHP'));
		$this->AkhirKontrak->setDbValue($rs->fields('AkhirKontrak'));
		$this->sudah_bayar->setDbValue($rs->fields('sudah_bayar'));
		$this->pd_Angsuran_Pokok->setDbValue($rs->fields('pd_Angsuran_Pokok'));
		$this->pd_Angsuran_Bunga->setDbValue($rs->fields('pd_Angsuran_Bunga'));
		$this->pd_Angsuran_Total->setDbValue($rs->fields('pd_Angsuran_Total'));
		$this->Tanggal_Bayar->setDbValue($rs->fields('Tanggal_Bayar'));
		$this->umur_tunggakan->setDbValue($rs->fields('umur_tunggakan'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pinjaman_id->DbValue = $row['pinjaman_id'];
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
		$this->Macet->DbValue = $row['Macet'];
		$this->NasabahNama->DbValue = $row['NasabahNama'];
		$this->NasabahAlamat->DbValue = $row['NasabahAlamat'];
		$this->No_Telp_Hp->DbValue = $row['No_Telp_Hp'];
		$this->Pekerjaan->DbValue = $row['Pekerjaan'];
		$this->Pekerjaan_Alamat->DbValue = $row['Pekerjaan_Alamat'];
		$this->Pekerjaan_No_Telp_Hp->DbValue = $row['Pekerjaan_No_Telp_Hp'];
		$this->Status->DbValue = $row['Status'];
		$this->NasabahKeterangan->DbValue = $row['NasabahKeterangan'];
		$this->MarketingNama->DbValue = $row['MarketingNama'];
		$this->MarketingAlamat->DbValue = $row['MarketingAlamat'];
		$this->NoHP->DbValue = $row['NoHP'];
		$this->AkhirKontrak->DbValue = $row['AkhirKontrak'];
		$this->sudah_bayar->DbValue = $row['sudah_bayar'];
		$this->pd_Angsuran_Pokok->DbValue = $row['pd_Angsuran_Pokok'];
		$this->pd_Angsuran_Bunga->DbValue = $row['pd_Angsuran_Bunga'];
		$this->pd_Angsuran_Total->DbValue = $row['pd_Angsuran_Total'];
		$this->Tanggal_Bayar->DbValue = $row['Tanggal_Bayar'];
		$this->umur_tunggakan->DbValue = $row['umur_tunggakan'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("pinjaman_id")) <> "")
			$this->pinjaman_id->CurrentValue = $this->getKey("pinjaman_id"); // pinjaman_id
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

		// Convert decimal values if posted back
		if ($this->Angsuran_Bunga_Prosen->FormValue == $this->Angsuran_Bunga_Prosen->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Bunga_Prosen->CurrentValue)))
			$this->Angsuran_Bunga_Prosen->CurrentValue = ew_StrToFloat($this->Angsuran_Bunga_Prosen->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Denda->FormValue == $this->Angsuran_Denda->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Denda->CurrentValue)))
			$this->Angsuran_Denda->CurrentValue = ew_StrToFloat($this->Angsuran_Denda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Pokok->FormValue == $this->Angsuran_Pokok->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Pokok->CurrentValue)))
			$this->Angsuran_Pokok->CurrentValue = ew_StrToFloat($this->Angsuran_Pokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Bunga->FormValue == $this->Angsuran_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Bunga->CurrentValue)))
			$this->Angsuran_Bunga->CurrentValue = ew_StrToFloat($this->Angsuran_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Total->FormValue == $this->Angsuran_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Total->CurrentValue)))
			$this->Angsuran_Total->CurrentValue = ew_StrToFloat($this->Angsuran_Total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Administrasi->FormValue == $this->Biaya_Administrasi->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Administrasi->CurrentValue)))
			$this->Biaya_Administrasi->CurrentValue = ew_StrToFloat($this->Biaya_Administrasi->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Materai->FormValue == $this->Biaya_Materai->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Materai->CurrentValue)))
			$this->Biaya_Materai->CurrentValue = ew_StrToFloat($this->Biaya_Materai->CurrentValue);

		// Convert decimal values if posted back
		if ($this->pd_Angsuran_Pokok->FormValue == $this->pd_Angsuran_Pokok->CurrentValue && is_numeric(ew_StrToFloat($this->pd_Angsuran_Pokok->CurrentValue)))
			$this->pd_Angsuran_Pokok->CurrentValue = ew_StrToFloat($this->pd_Angsuran_Pokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->pd_Angsuran_Bunga->FormValue == $this->pd_Angsuran_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->pd_Angsuran_Bunga->CurrentValue)))
			$this->pd_Angsuran_Bunga->CurrentValue = ew_StrToFloat($this->pd_Angsuran_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->pd_Angsuran_Total->FormValue == $this->pd_Angsuran_Total->CurrentValue && is_numeric(ew_StrToFloat($this->pd_Angsuran_Total->CurrentValue)))
			$this->pd_Angsuran_Total->CurrentValue = ew_StrToFloat($this->pd_Angsuran_Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// pinjaman_id
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
		// Macet
		// NasabahNama
		// NasabahAlamat
		// No_Telp_Hp
		// Pekerjaan
		// Pekerjaan_Alamat
		// Pekerjaan_No_Telp_Hp
		// Status
		// NasabahKeterangan
		// MarketingNama
		// MarketingAlamat
		// NoHP
		// AkhirKontrak
		// sudah_bayar
		// pd_Angsuran_Pokok
		// pd_Angsuran_Bunga
		// pd_Angsuran_Total
		// Tanggal_Bayar
		// umur_tunggakan

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pinjaman_id
		$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Kontrak_No
		$this->Kontrak_No->ViewValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_No->ViewCustomAttributes = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl->ViewValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Tgl->ViewValue = ew_FormatDateTime($this->Kontrak_Tgl->ViewValue, 0);
		$this->Kontrak_Tgl->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

		// jaminan_id
		$this->jaminan_id->ViewValue = $this->jaminan_id->CurrentValue;
		$this->jaminan_id->ViewCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->ViewCustomAttributes = "";

		// Angsuran_Lama
		$this->Angsuran_Lama->ViewValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Lama->ViewCustomAttributes = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->ViewValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
		$this->Angsuran_Bunga_Prosen->ViewCustomAttributes = "";

		// Angsuran_Denda
		$this->Angsuran_Denda->ViewValue = $this->Angsuran_Denda->CurrentValue;
		$this->Angsuran_Denda->ViewCustomAttributes = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda->ViewValue = $this->Dispensasi_Denda->CurrentValue;
		$this->Dispensasi_Denda->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// No_Ref
		$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->ViewCustomAttributes = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi->ViewValue = $this->Biaya_Administrasi->CurrentValue;
		$this->Biaya_Administrasi->ViewCustomAttributes = "";

		// Biaya_Materai
		$this->Biaya_Materai->ViewValue = $this->Biaya_Materai->CurrentValue;
		$this->Biaya_Materai->ViewCustomAttributes = "";

		// marketing_id
		$this->marketing_id->ViewValue = $this->marketing_id->CurrentValue;
		$this->marketing_id->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// Macet
		if (ew_ConvertToBool($this->Macet->CurrentValue)) {
			$this->Macet->ViewValue = $this->Macet->FldTagCaption(1) <> "" ? $this->Macet->FldTagCaption(1) : "Y";
		} else {
			$this->Macet->ViewValue = $this->Macet->FldTagCaption(2) <> "" ? $this->Macet->FldTagCaption(2) : "N";
		}
		$this->Macet->ViewCustomAttributes = "";

		// NasabahNama
		$this->NasabahNama->ViewValue = $this->NasabahNama->CurrentValue;
		$this->NasabahNama->ViewCustomAttributes = "";

		// No_Telp_Hp
		$this->No_Telp_Hp->ViewValue = $this->No_Telp_Hp->CurrentValue;
		$this->No_Telp_Hp->ViewCustomAttributes = "";

		// Pekerjaan
		$this->Pekerjaan->ViewValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->ViewCustomAttributes = "";

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->ViewValue = $this->Pekerjaan_No_Telp_Hp->CurrentValue;
		$this->Pekerjaan_No_Telp_Hp->ViewCustomAttributes = "";

		// Status
		$this->Status->ViewValue = $this->Status->CurrentValue;
		$this->Status->ViewCustomAttributes = "";

		// NasabahKeterangan
		$this->NasabahKeterangan->ViewValue = $this->NasabahKeterangan->CurrentValue;
		$this->NasabahKeterangan->ViewCustomAttributes = "";

		// MarketingNama
		$this->MarketingNama->ViewValue = $this->MarketingNama->CurrentValue;
		$this->MarketingNama->ViewCustomAttributes = "";

		// MarketingAlamat
		$this->MarketingAlamat->ViewValue = $this->MarketingAlamat->CurrentValue;
		$this->MarketingAlamat->ViewCustomAttributes = "";

		// NoHP
		$this->NoHP->ViewValue = $this->NoHP->CurrentValue;
		$this->NoHP->ViewCustomAttributes = "";

		// AkhirKontrak
		$this->AkhirKontrak->ViewValue = $this->AkhirKontrak->CurrentValue;
		$this->AkhirKontrak->ViewValue = ew_FormatDateTime($this->AkhirKontrak->ViewValue, 0);
		$this->AkhirKontrak->ViewCustomAttributes = "";

		// sudah_bayar
		$this->sudah_bayar->ViewValue = $this->sudah_bayar->CurrentValue;
		$this->sudah_bayar->ViewCustomAttributes = "";

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->ViewValue = $this->pd_Angsuran_Pokok->CurrentValue;
		$this->pd_Angsuran_Pokok->ViewCustomAttributes = "";

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->ViewValue = $this->pd_Angsuran_Bunga->CurrentValue;
		$this->pd_Angsuran_Bunga->ViewCustomAttributes = "";

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->ViewValue = $this->pd_Angsuran_Total->CurrentValue;
		$this->pd_Angsuran_Total->ViewCustomAttributes = "";

		// Tanggal_Bayar
		$this->Tanggal_Bayar->ViewValue = $this->Tanggal_Bayar->CurrentValue;
		$this->Tanggal_Bayar->ViewValue = ew_FormatDateTime($this->Tanggal_Bayar->ViewValue, 0);
		$this->Tanggal_Bayar->ViewCustomAttributes = "";

		// umur_tunggakan
		$this->umur_tunggakan->ViewValue = $this->umur_tunggakan->CurrentValue;
		$this->umur_tunggakan->ViewCustomAttributes = "";

			// pinjaman_id
			$this->pinjaman_id->LinkCustomAttributes = "";
			$this->pinjaman_id->HrefValue = "";
			$this->pinjaman_id->TooltipValue = "";

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

			// jaminan_id
			$this->jaminan_id->LinkCustomAttributes = "";
			$this->jaminan_id->HrefValue = "";
			$this->jaminan_id->TooltipValue = "";

			// Pinjaman
			$this->Pinjaman->LinkCustomAttributes = "";
			$this->Pinjaman->HrefValue = "";
			$this->Pinjaman->TooltipValue = "";

			// Angsuran_Lama
			$this->Angsuran_Lama->LinkCustomAttributes = "";
			$this->Angsuran_Lama->HrefValue = "";
			$this->Angsuran_Lama->TooltipValue = "";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->LinkCustomAttributes = "";
			$this->Angsuran_Bunga_Prosen->HrefValue = "";
			$this->Angsuran_Bunga_Prosen->TooltipValue = "";

			// Angsuran_Denda
			$this->Angsuran_Denda->LinkCustomAttributes = "";
			$this->Angsuran_Denda->HrefValue = "";
			$this->Angsuran_Denda->TooltipValue = "";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->LinkCustomAttributes = "";
			$this->Dispensasi_Denda->HrefValue = "";
			$this->Dispensasi_Denda->TooltipValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->LinkCustomAttributes = "";
			$this->Angsuran_Pokok->HrefValue = "";
			$this->Angsuran_Pokok->TooltipValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->LinkCustomAttributes = "";
			$this->Angsuran_Bunga->HrefValue = "";
			$this->Angsuran_Bunga->TooltipValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->LinkCustomAttributes = "";
			$this->Angsuran_Total->HrefValue = "";
			$this->Angsuran_Total->TooltipValue = "";

			// No_Ref
			$this->No_Ref->LinkCustomAttributes = "";
			$this->No_Ref->HrefValue = "";
			$this->No_Ref->TooltipValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->LinkCustomAttributes = "";
			$this->Biaya_Administrasi->HrefValue = "";
			$this->Biaya_Administrasi->TooltipValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->LinkCustomAttributes = "";
			$this->Biaya_Materai->HrefValue = "";
			$this->Biaya_Materai->TooltipValue = "";

			// marketing_id
			$this->marketing_id->LinkCustomAttributes = "";
			$this->marketing_id->HrefValue = "";
			$this->marketing_id->TooltipValue = "";

			// Periode
			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";
			$this->Periode->TooltipValue = "";

			// Macet
			$this->Macet->LinkCustomAttributes = "";
			$this->Macet->HrefValue = "";
			$this->Macet->TooltipValue = "";

			// NasabahNama
			$this->NasabahNama->LinkCustomAttributes = "";
			$this->NasabahNama->HrefValue = "";
			$this->NasabahNama->TooltipValue = "";

			// No_Telp_Hp
			$this->No_Telp_Hp->LinkCustomAttributes = "";
			$this->No_Telp_Hp->HrefValue = "";
			$this->No_Telp_Hp->TooltipValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";
			$this->Pekerjaan->TooltipValue = "";

			// Pekerjaan_No_Telp_Hp
			$this->Pekerjaan_No_Telp_Hp->LinkCustomAttributes = "";
			$this->Pekerjaan_No_Telp_Hp->HrefValue = "";
			$this->Pekerjaan_No_Telp_Hp->TooltipValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
			$this->Status->TooltipValue = "";

			// NasabahKeterangan
			$this->NasabahKeterangan->LinkCustomAttributes = "";
			$this->NasabahKeterangan->HrefValue = "";
			$this->NasabahKeterangan->TooltipValue = "";

			// MarketingNama
			$this->MarketingNama->LinkCustomAttributes = "";
			$this->MarketingNama->HrefValue = "";
			$this->MarketingNama->TooltipValue = "";

			// MarketingAlamat
			$this->MarketingAlamat->LinkCustomAttributes = "";
			$this->MarketingAlamat->HrefValue = "";
			$this->MarketingAlamat->TooltipValue = "";

			// NoHP
			$this->NoHP->LinkCustomAttributes = "";
			$this->NoHP->HrefValue = "";
			$this->NoHP->TooltipValue = "";

			// AkhirKontrak
			$this->AkhirKontrak->LinkCustomAttributes = "";
			$this->AkhirKontrak->HrefValue = "";
			$this->AkhirKontrak->TooltipValue = "";

			// sudah_bayar
			$this->sudah_bayar->LinkCustomAttributes = "";
			$this->sudah_bayar->HrefValue = "";
			$this->sudah_bayar->TooltipValue = "";

			// pd_Angsuran_Pokok
			$this->pd_Angsuran_Pokok->LinkCustomAttributes = "";
			$this->pd_Angsuran_Pokok->HrefValue = "";
			$this->pd_Angsuran_Pokok->TooltipValue = "";

			// pd_Angsuran_Bunga
			$this->pd_Angsuran_Bunga->LinkCustomAttributes = "";
			$this->pd_Angsuran_Bunga->HrefValue = "";
			$this->pd_Angsuran_Bunga->TooltipValue = "";

			// pd_Angsuran_Total
			$this->pd_Angsuran_Total->LinkCustomAttributes = "";
			$this->pd_Angsuran_Total->HrefValue = "";
			$this->pd_Angsuran_Total->TooltipValue = "";

			// Tanggal_Bayar
			$this->Tanggal_Bayar->LinkCustomAttributes = "";
			$this->Tanggal_Bayar->HrefValue = "";
			$this->Tanggal_Bayar->TooltipValue = "";

			// umur_tunggakan
			$this->umur_tunggakan->LinkCustomAttributes = "";
			$this->umur_tunggakan->HrefValue = "";
			$this->umur_tunggakan->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// pinjaman_id
			$this->pinjaman_id->EditAttrs["class"] = "form-control";
			$this->pinjaman_id->EditCustomAttributes = "";
			$this->pinjaman_id->EditValue = ew_HtmlEncode($this->pinjaman_id->AdvancedSearch->SearchValue);
			$this->pinjaman_id->PlaceHolder = ew_RemoveHtml($this->pinjaman_id->FldCaption());

			// Kontrak_No
			$this->Kontrak_No->EditAttrs["class"] = "form-control";
			$this->Kontrak_No->EditCustomAttributes = "";
			$this->Kontrak_No->EditValue = ew_HtmlEncode($this->Kontrak_No->AdvancedSearch->SearchValue);
			$this->Kontrak_No->PlaceHolder = ew_RemoveHtml($this->Kontrak_No->FldCaption());

			// Kontrak_Tgl
			$this->Kontrak_Tgl->EditAttrs["class"] = "form-control";
			$this->Kontrak_Tgl->EditCustomAttributes = "";
			$this->Kontrak_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Kontrak_Tgl->AdvancedSearch->SearchValue, 0), 8));
			$this->Kontrak_Tgl->PlaceHolder = ew_RemoveHtml($this->Kontrak_Tgl->FldCaption());

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			$this->nasabah_id->EditValue = ew_HtmlEncode($this->nasabah_id->AdvancedSearch->SearchValue);
			$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());

			// jaminan_id
			$this->jaminan_id->EditAttrs["class"] = "form-control";
			$this->jaminan_id->EditCustomAttributes = "";
			$this->jaminan_id->EditValue = ew_HtmlEncode($this->jaminan_id->AdvancedSearch->SearchValue);
			$this->jaminan_id->PlaceHolder = ew_RemoveHtml($this->jaminan_id->FldCaption());

			// Pinjaman
			$this->Pinjaman->EditAttrs["class"] = "form-control";
			$this->Pinjaman->EditCustomAttributes = "";
			$this->Pinjaman->EditValue = ew_HtmlEncode($this->Pinjaman->AdvancedSearch->SearchValue);
			$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());

			// Angsuran_Lama
			$this->Angsuran_Lama->EditAttrs["class"] = "form-control";
			$this->Angsuran_Lama->EditCustomAttributes = "";
			$this->Angsuran_Lama->EditValue = ew_HtmlEncode($this->Angsuran_Lama->AdvancedSearch->SearchValue);
			$this->Angsuran_Lama->PlaceHolder = ew_RemoveHtml($this->Angsuran_Lama->FldCaption());

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->EditAttrs["class"] = "form-control";
			$this->Angsuran_Bunga_Prosen->EditCustomAttributes = "";
			$this->Angsuran_Bunga_Prosen->EditValue = ew_HtmlEncode($this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue);
			$this->Angsuran_Bunga_Prosen->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga_Prosen->FldCaption());

			// Angsuran_Denda
			$this->Angsuran_Denda->EditAttrs["class"] = "form-control";
			$this->Angsuran_Denda->EditCustomAttributes = "";
			$this->Angsuran_Denda->EditValue = ew_HtmlEncode($this->Angsuran_Denda->AdvancedSearch->SearchValue);
			$this->Angsuran_Denda->PlaceHolder = ew_RemoveHtml($this->Angsuran_Denda->FldCaption());

			// Dispensasi_Denda
			$this->Dispensasi_Denda->EditAttrs["class"] = "form-control";
			$this->Dispensasi_Denda->EditCustomAttributes = "";
			$this->Dispensasi_Denda->EditValue = ew_HtmlEncode($this->Dispensasi_Denda->AdvancedSearch->SearchValue);
			$this->Dispensasi_Denda->PlaceHolder = ew_RemoveHtml($this->Dispensasi_Denda->FldCaption());

			// Angsuran_Pokok
			$this->Angsuran_Pokok->EditAttrs["class"] = "form-control";
			$this->Angsuran_Pokok->EditCustomAttributes = "";
			$this->Angsuran_Pokok->EditValue = ew_HtmlEncode($this->Angsuran_Pokok->AdvancedSearch->SearchValue);
			$this->Angsuran_Pokok->PlaceHolder = ew_RemoveHtml($this->Angsuran_Pokok->FldCaption());

			// Angsuran_Bunga
			$this->Angsuran_Bunga->EditAttrs["class"] = "form-control";
			$this->Angsuran_Bunga->EditCustomAttributes = "";
			$this->Angsuran_Bunga->EditValue = ew_HtmlEncode($this->Angsuran_Bunga->AdvancedSearch->SearchValue);
			$this->Angsuran_Bunga->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga->FldCaption());

			// Angsuran_Total
			$this->Angsuran_Total->EditAttrs["class"] = "form-control";
			$this->Angsuran_Total->EditCustomAttributes = "";
			$this->Angsuran_Total->EditValue = ew_HtmlEncode($this->Angsuran_Total->AdvancedSearch->SearchValue);
			$this->Angsuran_Total->PlaceHolder = ew_RemoveHtml($this->Angsuran_Total->FldCaption());

			// No_Ref
			$this->No_Ref->EditAttrs["class"] = "form-control";
			$this->No_Ref->EditCustomAttributes = "";
			$this->No_Ref->EditValue = ew_HtmlEncode($this->No_Ref->AdvancedSearch->SearchValue);
			$this->No_Ref->PlaceHolder = ew_RemoveHtml($this->No_Ref->FldCaption());

			// Biaya_Administrasi
			$this->Biaya_Administrasi->EditAttrs["class"] = "form-control";
			$this->Biaya_Administrasi->EditCustomAttributes = "";
			$this->Biaya_Administrasi->EditValue = ew_HtmlEncode($this->Biaya_Administrasi->AdvancedSearch->SearchValue);
			$this->Biaya_Administrasi->PlaceHolder = ew_RemoveHtml($this->Biaya_Administrasi->FldCaption());

			// Biaya_Materai
			$this->Biaya_Materai->EditAttrs["class"] = "form-control";
			$this->Biaya_Materai->EditCustomAttributes = "";
			$this->Biaya_Materai->EditValue = ew_HtmlEncode($this->Biaya_Materai->AdvancedSearch->SearchValue);
			$this->Biaya_Materai->PlaceHolder = ew_RemoveHtml($this->Biaya_Materai->FldCaption());

			// marketing_id
			$this->marketing_id->EditAttrs["class"] = "form-control";
			$this->marketing_id->EditCustomAttributes = "";
			$this->marketing_id->EditValue = ew_HtmlEncode($this->marketing_id->AdvancedSearch->SearchValue);
			$this->marketing_id->PlaceHolder = ew_RemoveHtml($this->marketing_id->FldCaption());

			// Periode
			$this->Periode->EditAttrs["class"] = "form-control";
			$this->Periode->EditCustomAttributes = "";
			$this->Periode->EditValue = ew_HtmlEncode($this->Periode->AdvancedSearch->SearchValue);
			$this->Periode->PlaceHolder = ew_RemoveHtml($this->Periode->FldCaption());

			// Macet
			$this->Macet->EditCustomAttributes = "";
			$this->Macet->EditValue = $this->Macet->Options(FALSE);

			// NasabahNama
			$this->NasabahNama->EditAttrs["class"] = "form-control";
			$this->NasabahNama->EditCustomAttributes = "";
			$this->NasabahNama->EditValue = ew_HtmlEncode($this->NasabahNama->AdvancedSearch->SearchValue);
			$this->NasabahNama->PlaceHolder = ew_RemoveHtml($this->NasabahNama->FldCaption());

			// No_Telp_Hp
			$this->No_Telp_Hp->EditAttrs["class"] = "form-control";
			$this->No_Telp_Hp->EditCustomAttributes = "";
			$this->No_Telp_Hp->EditValue = ew_HtmlEncode($this->No_Telp_Hp->AdvancedSearch->SearchValue);
			$this->No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->No_Telp_Hp->FldCaption());

			// Pekerjaan
			$this->Pekerjaan->EditAttrs["class"] = "form-control";
			$this->Pekerjaan->EditCustomAttributes = "";
			$this->Pekerjaan->EditValue = ew_HtmlEncode($this->Pekerjaan->AdvancedSearch->SearchValue);
			$this->Pekerjaan->PlaceHolder = ew_RemoveHtml($this->Pekerjaan->FldCaption());

			// Pekerjaan_No_Telp_Hp
			$this->Pekerjaan_No_Telp_Hp->EditAttrs["class"] = "form-control";
			$this->Pekerjaan_No_Telp_Hp->EditCustomAttributes = "";
			$this->Pekerjaan_No_Telp_Hp->EditValue = ew_HtmlEncode($this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue);
			$this->Pekerjaan_No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_No_Telp_Hp->FldCaption());

			// Status
			$this->Status->EditAttrs["class"] = "form-control";
			$this->Status->EditCustomAttributes = "";
			$this->Status->EditValue = ew_HtmlEncode($this->Status->AdvancedSearch->SearchValue);
			$this->Status->PlaceHolder = ew_RemoveHtml($this->Status->FldCaption());

			// NasabahKeterangan
			$this->NasabahKeterangan->EditAttrs["class"] = "form-control";
			$this->NasabahKeterangan->EditCustomAttributes = "";
			$this->NasabahKeterangan->EditValue = ew_HtmlEncode($this->NasabahKeterangan->AdvancedSearch->SearchValue);
			$this->NasabahKeterangan->PlaceHolder = ew_RemoveHtml($this->NasabahKeterangan->FldCaption());

			// MarketingNama
			$this->MarketingNama->EditAttrs["class"] = "form-control";
			$this->MarketingNama->EditCustomAttributes = "";
			$this->MarketingNama->EditValue = ew_HtmlEncode($this->MarketingNama->AdvancedSearch->SearchValue);
			$this->MarketingNama->PlaceHolder = ew_RemoveHtml($this->MarketingNama->FldCaption());

			// MarketingAlamat
			$this->MarketingAlamat->EditAttrs["class"] = "form-control";
			$this->MarketingAlamat->EditCustomAttributes = "";
			$this->MarketingAlamat->EditValue = ew_HtmlEncode($this->MarketingAlamat->AdvancedSearch->SearchValue);
			$this->MarketingAlamat->PlaceHolder = ew_RemoveHtml($this->MarketingAlamat->FldCaption());

			// NoHP
			$this->NoHP->EditAttrs["class"] = "form-control";
			$this->NoHP->EditCustomAttributes = "";
			$this->NoHP->EditValue = ew_HtmlEncode($this->NoHP->AdvancedSearch->SearchValue);
			$this->NoHP->PlaceHolder = ew_RemoveHtml($this->NoHP->FldCaption());

			// AkhirKontrak
			$this->AkhirKontrak->EditAttrs["class"] = "form-control";
			$this->AkhirKontrak->EditCustomAttributes = "";
			$this->AkhirKontrak->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->AkhirKontrak->AdvancedSearch->SearchValue, 0), 8));
			$this->AkhirKontrak->PlaceHolder = ew_RemoveHtml($this->AkhirKontrak->FldCaption());

			// sudah_bayar
			$this->sudah_bayar->EditAttrs["class"] = "form-control";
			$this->sudah_bayar->EditCustomAttributes = "";
			$this->sudah_bayar->EditValue = ew_HtmlEncode($this->sudah_bayar->AdvancedSearch->SearchValue);
			$this->sudah_bayar->PlaceHolder = ew_RemoveHtml($this->sudah_bayar->FldCaption());

			// pd_Angsuran_Pokok
			$this->pd_Angsuran_Pokok->EditAttrs["class"] = "form-control";
			$this->pd_Angsuran_Pokok->EditCustomAttributes = "";
			$this->pd_Angsuran_Pokok->EditValue = ew_HtmlEncode($this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue);
			$this->pd_Angsuran_Pokok->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Pokok->FldCaption());

			// pd_Angsuran_Bunga
			$this->pd_Angsuran_Bunga->EditAttrs["class"] = "form-control";
			$this->pd_Angsuran_Bunga->EditCustomAttributes = "";
			$this->pd_Angsuran_Bunga->EditValue = ew_HtmlEncode($this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue);
			$this->pd_Angsuran_Bunga->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Bunga->FldCaption());

			// pd_Angsuran_Total
			$this->pd_Angsuran_Total->EditAttrs["class"] = "form-control";
			$this->pd_Angsuran_Total->EditCustomAttributes = "";
			$this->pd_Angsuran_Total->EditValue = ew_HtmlEncode($this->pd_Angsuran_Total->AdvancedSearch->SearchValue);
			$this->pd_Angsuran_Total->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Total->FldCaption());

			// Tanggal_Bayar
			$this->Tanggal_Bayar->EditAttrs["class"] = "form-control";
			$this->Tanggal_Bayar->EditCustomAttributes = "";
			$this->Tanggal_Bayar->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Tanggal_Bayar->AdvancedSearch->SearchValue, 0), 8));
			$this->Tanggal_Bayar->PlaceHolder = ew_RemoveHtml($this->Tanggal_Bayar->FldCaption());

			// umur_tunggakan
			$this->umur_tunggakan->EditAttrs["class"] = "form-control";
			$this->umur_tunggakan->EditCustomAttributes = "";
			$this->umur_tunggakan->EditValue = ew_HtmlEncode($this->umur_tunggakan->AdvancedSearch->SearchValue);
			$this->umur_tunggakan->PlaceHolder = ew_RemoveHtml($this->umur_tunggakan->FldCaption());
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
		$this->pinjaman_id->AdvancedSearch->Load();
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
		$this->Macet->AdvancedSearch->Load();
		$this->NasabahNama->AdvancedSearch->Load();
		$this->NasabahAlamat->AdvancedSearch->Load();
		$this->No_Telp_Hp->AdvancedSearch->Load();
		$this->Pekerjaan->AdvancedSearch->Load();
		$this->Pekerjaan_Alamat->AdvancedSearch->Load();
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->Load();
		$this->Status->AdvancedSearch->Load();
		$this->NasabahKeterangan->AdvancedSearch->Load();
		$this->MarketingNama->AdvancedSearch->Load();
		$this->MarketingAlamat->AdvancedSearch->Load();
		$this->NoHP->AdvancedSearch->Load();
		$this->AkhirKontrak->AdvancedSearch->Load();
		$this->sudah_bayar->AdvancedSearch->Load();
		$this->pd_Angsuran_Pokok->AdvancedSearch->Load();
		$this->pd_Angsuran_Bunga->AdvancedSearch->Load();
		$this->pd_Angsuran_Total->AdvancedSearch->Load();
		$this->Tanggal_Bayar->AdvancedSearch->Load();
		$this->umur_tunggakan->AdvancedSearch->Load();
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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_v0302_pinjamanlap\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_v0302_pinjamanlap',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fv0302_pinjamanlaplist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($v0302_pinjamanlap_list)) $v0302_pinjamanlap_list = new cv0302_pinjamanlap_list();

// Page init
$v0302_pinjamanlap_list->Page_Init();

// Page main
$v0302_pinjamanlap_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v0302_pinjamanlap_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fv0302_pinjamanlaplist = new ew_Form("fv0302_pinjamanlaplist", "list");
fv0302_pinjamanlaplist.FormKeyCountName = '<?php echo $v0302_pinjamanlap_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv0302_pinjamanlaplist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv0302_pinjamanlaplist.ValidateRequired = true;
<?php } else { ?>
fv0302_pinjamanlaplist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fv0302_pinjamanlaplist.Lists["x_Macet"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fv0302_pinjamanlaplist.Lists["x_Macet"].Options = <?php echo json_encode($v0302_pinjamanlap->Macet->Options()) ?>;

// Form object for search
var CurrentSearchForm = fv0302_pinjamanlaplistsrch = new ew_Form("fv0302_pinjamanlaplistsrch");

// Validate function for search
fv0302_pinjamanlaplistsrch.Validate = function(fobj) {
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
fv0302_pinjamanlaplistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv0302_pinjamanlaplistsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fv0302_pinjamanlaplistsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
fv0302_pinjamanlaplistsrch.Lists["x_Macet"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fv0302_pinjamanlaplistsrch.Lists["x_Macet"].Options = <?php echo json_encode($v0302_pinjamanlap->Macet->Options()) ?>;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<div class="ewToolbar">
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($v0302_pinjamanlap_list->TotalRecs > 0 && $v0302_pinjamanlap_list->ExportOptions->Visible()) { ?>
<?php $v0302_pinjamanlap_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($v0302_pinjamanlap_list->SearchOptions->Visible()) { ?>
<?php $v0302_pinjamanlap_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($v0302_pinjamanlap_list->FilterOptions->Visible()) { ?>
<?php $v0302_pinjamanlap_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $v0302_pinjamanlap_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($v0302_pinjamanlap_list->TotalRecs <= 0)
			$v0302_pinjamanlap_list->TotalRecs = $v0302_pinjamanlap->SelectRecordCount();
	} else {
		if (!$v0302_pinjamanlap_list->Recordset && ($v0302_pinjamanlap_list->Recordset = $v0302_pinjamanlap_list->LoadRecordset()))
			$v0302_pinjamanlap_list->TotalRecs = $v0302_pinjamanlap_list->Recordset->RecordCount();
	}
	$v0302_pinjamanlap_list->StartRec = 1;
	if ($v0302_pinjamanlap_list->DisplayRecs <= 0 || ($v0302_pinjamanlap->Export <> "" && $v0302_pinjamanlap->ExportAll)) // Display all records
		$v0302_pinjamanlap_list->DisplayRecs = $v0302_pinjamanlap_list->TotalRecs;
	if (!($v0302_pinjamanlap->Export <> "" && $v0302_pinjamanlap->ExportAll))
		$v0302_pinjamanlap_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$v0302_pinjamanlap_list->Recordset = $v0302_pinjamanlap_list->LoadRecordset($v0302_pinjamanlap_list->StartRec-1, $v0302_pinjamanlap_list->DisplayRecs);

	// Set no record found message
	if ($v0302_pinjamanlap->CurrentAction == "" && $v0302_pinjamanlap_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$v0302_pinjamanlap_list->setWarningMessage(ew_DeniedMsg());
		if ($v0302_pinjamanlap_list->SearchWhere == "0=101")
			$v0302_pinjamanlap_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$v0302_pinjamanlap_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($v0302_pinjamanlap_list->AuditTrailOnSearch && $v0302_pinjamanlap_list->Command == "search" && !$v0302_pinjamanlap_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $v0302_pinjamanlap_list->getSessionWhere();
		$v0302_pinjamanlap_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$v0302_pinjamanlap_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($v0302_pinjamanlap->Export == "" && $v0302_pinjamanlap->CurrentAction == "") { ?>
<form name="fv0302_pinjamanlaplistsrch" id="fv0302_pinjamanlaplistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($v0302_pinjamanlap_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fv0302_pinjamanlaplistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v0302_pinjamanlap">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$v0302_pinjamanlap_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$v0302_pinjamanlap->RowType = EW_ROWTYPE_SEARCH;

// Render row
$v0302_pinjamanlap->ResetAttrs();
$v0302_pinjamanlap_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($v0302_pinjamanlap->Macet->Visible) { // Macet ?>
	<div id="xsc_Macet" class="ewCell form-group">
		<label class="ewSearchCaption ewLabel"><?php echo $v0302_pinjamanlap->Macet->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Macet" id="z_Macet" value="="></span>
		<span class="ewSearchField">
<div id="tp_x_Macet" class="ewTemplate"><input type="radio" data-table="v0302_pinjamanlap" data-field="x_Macet" data-value-separator="<?php echo $v0302_pinjamanlap->Macet->DisplayValueSeparatorAttribute() ?>" name="x_Macet" id="x_Macet" value="{value}"<?php echo $v0302_pinjamanlap->Macet->EditAttributes() ?>></div>
<div id="dsl_x_Macet" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $v0302_pinjamanlap->Macet->RadioButtonListHtml(FALSE, "x_Macet") ?>
</div></div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($v0302_pinjamanlap_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($v0302_pinjamanlap_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $v0302_pinjamanlap_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($v0302_pinjamanlap_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($v0302_pinjamanlap_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($v0302_pinjamanlap_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($v0302_pinjamanlap_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v0302_pinjamanlap_list->ShowPageHeader(); ?>
<?php
$v0302_pinjamanlap_list->ShowMessage();
?>
<?php if ($v0302_pinjamanlap_list->TotalRecs > 0 || $v0302_pinjamanlap->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid v0302_pinjamanlap">
<form name="fv0302_pinjamanlaplist" id="fv0302_pinjamanlaplist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($v0302_pinjamanlap_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $v0302_pinjamanlap_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v0302_pinjamanlap">
<div id="gmp_v0302_pinjamanlap" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($v0302_pinjamanlap_list->TotalRecs > 0 || $v0302_pinjamanlap->CurrentAction == "gridedit") { ?>
<table id="tbl_v0302_pinjamanlaplist" class="table ewTable">
<?php echo $v0302_pinjamanlap->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$v0302_pinjamanlap_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$v0302_pinjamanlap_list->RenderListOptions();

// Render list options (header, left)
$v0302_pinjamanlap_list->ListOptions->Render("header", "left");
?>
<?php if ($v0302_pinjamanlap->pinjaman_id->Visible) { // pinjaman_id ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pinjaman_id) == "") { ?>
		<th data-name="pinjaman_id"><div id="elh_v0302_pinjamanlap_pinjaman_id" class="v0302_pinjamanlap_pinjaman_id"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pinjaman_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pinjaman_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pinjaman_id) ?>',2);"><div id="elh_v0302_pinjamanlap_pinjaman_id" class="v0302_pinjamanlap_pinjaman_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pinjaman_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->pinjaman_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->pinjaman_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Kontrak_No->Visible) { // Kontrak_No ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Kontrak_No) == "") { ?>
		<th data-name="Kontrak_No"><div id="elh_v0302_pinjamanlap_Kontrak_No" class="v0302_pinjamanlap_Kontrak_No"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Kontrak_No->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_No"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Kontrak_No) ?>',2);"><div id="elh_v0302_pinjamanlap_Kontrak_No" class="v0302_pinjamanlap_Kontrak_No">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Kontrak_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Kontrak_No->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Kontrak_No->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Kontrak_Tgl) == "") { ?>
		<th data-name="Kontrak_Tgl"><div id="elh_v0302_pinjamanlap_Kontrak_Tgl" class="v0302_pinjamanlap_Kontrak_Tgl"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Kontrak_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kontrak_Tgl"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Kontrak_Tgl) ?>',2);"><div id="elh_v0302_pinjamanlap_Kontrak_Tgl" class="v0302_pinjamanlap_Kontrak_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Kontrak_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Kontrak_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Kontrak_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->nasabah_id->Visible) { // nasabah_id ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->nasabah_id) == "") { ?>
		<th data-name="nasabah_id"><div id="elh_v0302_pinjamanlap_nasabah_id" class="v0302_pinjamanlap_nasabah_id"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->nasabah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nasabah_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->nasabah_id) ?>',2);"><div id="elh_v0302_pinjamanlap_nasabah_id" class="v0302_pinjamanlap_nasabah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->nasabah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->nasabah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->nasabah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->jaminan_id->Visible) { // jaminan_id ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->jaminan_id) == "") { ?>
		<th data-name="jaminan_id"><div id="elh_v0302_pinjamanlap_jaminan_id" class="v0302_pinjamanlap_jaminan_id"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->jaminan_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jaminan_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->jaminan_id) ?>',2);"><div id="elh_v0302_pinjamanlap_jaminan_id" class="v0302_pinjamanlap_jaminan_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->jaminan_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->jaminan_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->jaminan_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Pinjaman->Visible) { // Pinjaman ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pinjaman) == "") { ?>
		<th data-name="Pinjaman"><div id="elh_v0302_pinjamanlap_Pinjaman" class="v0302_pinjamanlap_Pinjaman"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pinjaman->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pinjaman"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pinjaman) ?>',2);"><div id="elh_v0302_pinjamanlap_Pinjaman" class="v0302_pinjamanlap_Pinjaman">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pinjaman->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Pinjaman->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Pinjaman->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Lama) == "") { ?>
		<th data-name="Angsuran_Lama"><div id="elh_v0302_pinjamanlap_Angsuran_Lama" class="v0302_pinjamanlap_Angsuran_Lama"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Lama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Lama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Lama) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Lama" class="v0302_pinjamanlap_Angsuran_Lama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Lama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Lama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Lama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Bunga_Prosen) == "") { ?>
		<th data-name="Angsuran_Bunga_Prosen"><div id="elh_v0302_pinjamanlap_Angsuran_Bunga_Prosen" class="v0302_pinjamanlap_Angsuran_Bunga_Prosen"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Bunga_Prosen"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Bunga_Prosen) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Bunga_Prosen" class="v0302_pinjamanlap_Angsuran_Bunga_Prosen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Bunga_Prosen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Bunga_Prosen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Denda) == "") { ?>
		<th data-name="Angsuran_Denda"><div id="elh_v0302_pinjamanlap_Angsuran_Denda" class="v0302_pinjamanlap_Angsuran_Denda"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Denda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Denda"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Denda) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Denda" class="v0302_pinjamanlap_Angsuran_Denda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Denda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Dispensasi_Denda) == "") { ?>
		<th data-name="Dispensasi_Denda"><div id="elh_v0302_pinjamanlap_Dispensasi_Denda" class="v0302_pinjamanlap_Dispensasi_Denda"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Dispensasi_Denda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Dispensasi_Denda"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Dispensasi_Denda) ?>',2);"><div id="elh_v0302_pinjamanlap_Dispensasi_Denda" class="v0302_pinjamanlap_Dispensasi_Denda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Dispensasi_Denda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Dispensasi_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Dispensasi_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Pokok) == "") { ?>
		<th data-name="Angsuran_Pokok"><div id="elh_v0302_pinjamanlap_Angsuran_Pokok" class="v0302_pinjamanlap_Angsuran_Pokok"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Pokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Pokok"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Pokok) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Pokok" class="v0302_pinjamanlap_Angsuran_Pokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Pokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Pokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Pokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Bunga) == "") { ?>
		<th data-name="Angsuran_Bunga"><div id="elh_v0302_pinjamanlap_Angsuran_Bunga" class="v0302_pinjamanlap_Angsuran_Bunga"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Bunga) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Bunga" class="v0302_pinjamanlap_Angsuran_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Total) == "") { ?>
		<th data-name="Angsuran_Total"><div id="elh_v0302_pinjamanlap_Angsuran_Total" class="v0302_pinjamanlap_Angsuran_Total"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Total"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Angsuran_Total) ?>',2);"><div id="elh_v0302_pinjamanlap_Angsuran_Total" class="v0302_pinjamanlap_Angsuran_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Angsuran_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Angsuran_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Angsuran_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->No_Ref->Visible) { // No_Ref ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->No_Ref) == "") { ?>
		<th data-name="No_Ref"><div id="elh_v0302_pinjamanlap_No_Ref" class="v0302_pinjamanlap_No_Ref"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->No_Ref->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="No_Ref"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->No_Ref) ?>',2);"><div id="elh_v0302_pinjamanlap_No_Ref" class="v0302_pinjamanlap_No_Ref">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->No_Ref->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->No_Ref->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->No_Ref->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Biaya_Administrasi) == "") { ?>
		<th data-name="Biaya_Administrasi"><div id="elh_v0302_pinjamanlap_Biaya_Administrasi" class="v0302_pinjamanlap_Biaya_Administrasi"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Biaya_Administrasi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Biaya_Administrasi"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Biaya_Administrasi) ?>',2);"><div id="elh_v0302_pinjamanlap_Biaya_Administrasi" class="v0302_pinjamanlap_Biaya_Administrasi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Biaya_Administrasi->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Biaya_Administrasi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Biaya_Administrasi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Biaya_Materai->Visible) { // Biaya_Materai ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Biaya_Materai) == "") { ?>
		<th data-name="Biaya_Materai"><div id="elh_v0302_pinjamanlap_Biaya_Materai" class="v0302_pinjamanlap_Biaya_Materai"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Biaya_Materai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Biaya_Materai"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Biaya_Materai) ?>',2);"><div id="elh_v0302_pinjamanlap_Biaya_Materai" class="v0302_pinjamanlap_Biaya_Materai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Biaya_Materai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Biaya_Materai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Biaya_Materai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->marketing_id->Visible) { // marketing_id ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->marketing_id) == "") { ?>
		<th data-name="marketing_id"><div id="elh_v0302_pinjamanlap_marketing_id" class="v0302_pinjamanlap_marketing_id"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->marketing_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="marketing_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->marketing_id) ?>',2);"><div id="elh_v0302_pinjamanlap_marketing_id" class="v0302_pinjamanlap_marketing_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->marketing_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->marketing_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->marketing_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Periode->Visible) { // Periode ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Periode) == "") { ?>
		<th data-name="Periode"><div id="elh_v0302_pinjamanlap_Periode" class="v0302_pinjamanlap_Periode"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Periode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Periode"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Periode) ?>',2);"><div id="elh_v0302_pinjamanlap_Periode" class="v0302_pinjamanlap_Periode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Periode->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Macet->Visible) { // Macet ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Macet) == "") { ?>
		<th data-name="Macet"><div id="elh_v0302_pinjamanlap_Macet" class="v0302_pinjamanlap_Macet"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Macet->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Macet"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Macet) ?>',2);"><div id="elh_v0302_pinjamanlap_Macet" class="v0302_pinjamanlap_Macet">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Macet->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Macet->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Macet->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->NasabahNama->Visible) { // NasabahNama ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NasabahNama) == "") { ?>
		<th data-name="NasabahNama"><div id="elh_v0302_pinjamanlap_NasabahNama" class="v0302_pinjamanlap_NasabahNama"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NasabahNama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NasabahNama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NasabahNama) ?>',2);"><div id="elh_v0302_pinjamanlap_NasabahNama" class="v0302_pinjamanlap_NasabahNama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NasabahNama->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->NasabahNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->NasabahNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->No_Telp_Hp) == "") { ?>
		<th data-name="No_Telp_Hp"><div id="elh_v0302_pinjamanlap_No_Telp_Hp" class="v0302_pinjamanlap_No_Telp_Hp"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->No_Telp_Hp->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="No_Telp_Hp"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->No_Telp_Hp) ?>',2);"><div id="elh_v0302_pinjamanlap_No_Telp_Hp" class="v0302_pinjamanlap_No_Telp_Hp">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->No_Telp_Hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->No_Telp_Hp->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->No_Telp_Hp->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Pekerjaan->Visible) { // Pekerjaan ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pekerjaan) == "") { ?>
		<th data-name="Pekerjaan"><div id="elh_v0302_pinjamanlap_Pekerjaan" class="v0302_pinjamanlap_Pekerjaan"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pekerjaan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pekerjaan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pekerjaan) ?>',2);"><div id="elh_v0302_pinjamanlap_Pekerjaan" class="v0302_pinjamanlap_Pekerjaan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pekerjaan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Pekerjaan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Pekerjaan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->Visible) { // Pekerjaan_No_Telp_Hp ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp) == "") { ?>
		<th data-name="Pekerjaan_No_Telp_Hp"><div id="elh_v0302_pinjamanlap_Pekerjaan_No_Telp_Hp" class="v0302_pinjamanlap_Pekerjaan_No_Telp_Hp"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pekerjaan_No_Telp_Hp"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp) ?>',2);"><div id="elh_v0302_pinjamanlap_Pekerjaan_No_Telp_Hp" class="v0302_pinjamanlap_Pekerjaan_No_Telp_Hp">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Status->Visible) { // Status ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Status) == "") { ?>
		<th data-name="Status"><div id="elh_v0302_pinjamanlap_Status" class="v0302_pinjamanlap_Status"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Status->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Status) ?>',2);"><div id="elh_v0302_pinjamanlap_Status" class="v0302_pinjamanlap_Status">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Status->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->NasabahKeterangan->Visible) { // NasabahKeterangan ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NasabahKeterangan) == "") { ?>
		<th data-name="NasabahKeterangan"><div id="elh_v0302_pinjamanlap_NasabahKeterangan" class="v0302_pinjamanlap_NasabahKeterangan"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NasabahKeterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NasabahKeterangan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NasabahKeterangan) ?>',2);"><div id="elh_v0302_pinjamanlap_NasabahKeterangan" class="v0302_pinjamanlap_NasabahKeterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NasabahKeterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->NasabahKeterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->NasabahKeterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->MarketingNama->Visible) { // MarketingNama ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->MarketingNama) == "") { ?>
		<th data-name="MarketingNama"><div id="elh_v0302_pinjamanlap_MarketingNama" class="v0302_pinjamanlap_MarketingNama"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->MarketingNama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketingNama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->MarketingNama) ?>',2);"><div id="elh_v0302_pinjamanlap_MarketingNama" class="v0302_pinjamanlap_MarketingNama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->MarketingNama->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->MarketingNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->MarketingNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->MarketingAlamat->Visible) { // MarketingAlamat ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->MarketingAlamat) == "") { ?>
		<th data-name="MarketingAlamat"><div id="elh_v0302_pinjamanlap_MarketingAlamat" class="v0302_pinjamanlap_MarketingAlamat"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->MarketingAlamat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketingAlamat"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->MarketingAlamat) ?>',2);"><div id="elh_v0302_pinjamanlap_MarketingAlamat" class="v0302_pinjamanlap_MarketingAlamat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->MarketingAlamat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->MarketingAlamat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->MarketingAlamat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->NoHP->Visible) { // NoHP ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NoHP) == "") { ?>
		<th data-name="NoHP"><div id="elh_v0302_pinjamanlap_NoHP" class="v0302_pinjamanlap_NoHP"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NoHP->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoHP"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->NoHP) ?>',2);"><div id="elh_v0302_pinjamanlap_NoHP" class="v0302_pinjamanlap_NoHP">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->NoHP->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->NoHP->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->NoHP->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->AkhirKontrak->Visible) { // AkhirKontrak ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->AkhirKontrak) == "") { ?>
		<th data-name="AkhirKontrak"><div id="elh_v0302_pinjamanlap_AkhirKontrak" class="v0302_pinjamanlap_AkhirKontrak"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->AkhirKontrak->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AkhirKontrak"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->AkhirKontrak) ?>',2);"><div id="elh_v0302_pinjamanlap_AkhirKontrak" class="v0302_pinjamanlap_AkhirKontrak">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->AkhirKontrak->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->AkhirKontrak->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->AkhirKontrak->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->sudah_bayar->Visible) { // sudah_bayar ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->sudah_bayar) == "") { ?>
		<th data-name="sudah_bayar"><div id="elh_v0302_pinjamanlap_sudah_bayar" class="v0302_pinjamanlap_sudah_bayar"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->sudah_bayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sudah_bayar"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->sudah_bayar) ?>',2);"><div id="elh_v0302_pinjamanlap_sudah_bayar" class="v0302_pinjamanlap_sudah_bayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->sudah_bayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->sudah_bayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->sudah_bayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->pd_Angsuran_Pokok->Visible) { // pd_Angsuran_Pokok ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Pokok) == "") { ?>
		<th data-name="pd_Angsuran_Pokok"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Pokok" class="v0302_pinjamanlap_pd_Angsuran_Pokok"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pd_Angsuran_Pokok"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Pokok) ?>',2);"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Pokok" class="v0302_pinjamanlap_pd_Angsuran_Pokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->pd_Angsuran_Pokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->pd_Angsuran_Pokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->pd_Angsuran_Bunga->Visible) { // pd_Angsuran_Bunga ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Bunga) == "") { ?>
		<th data-name="pd_Angsuran_Bunga"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Bunga" class="v0302_pinjamanlap_pd_Angsuran_Bunga"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pd_Angsuran_Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Bunga) ?>',2);"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Bunga" class="v0302_pinjamanlap_pd_Angsuran_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->pd_Angsuran_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->pd_Angsuran_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->pd_Angsuran_Total->Visible) { // pd_Angsuran_Total ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Total) == "") { ?>
		<th data-name="pd_Angsuran_Total"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Total" class="v0302_pinjamanlap_pd_Angsuran_Total"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pd_Angsuran_Total"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->pd_Angsuran_Total) ?>',2);"><div id="elh_v0302_pinjamanlap_pd_Angsuran_Total" class="v0302_pinjamanlap_pd_Angsuran_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->pd_Angsuran_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->pd_Angsuran_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->pd_Angsuran_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Tanggal_Bayar) == "") { ?>
		<th data-name="Tanggal_Bayar"><div id="elh_v0302_pinjamanlap_Tanggal_Bayar" class="v0302_pinjamanlap_Tanggal_Bayar"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Tanggal_Bayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal_Bayar"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->Tanggal_Bayar) ?>',2);"><div id="elh_v0302_pinjamanlap_Tanggal_Bayar" class="v0302_pinjamanlap_Tanggal_Bayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->Tanggal_Bayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->Tanggal_Bayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->Tanggal_Bayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v0302_pinjamanlap->umur_tunggakan->Visible) { // umur_tunggakan ?>
	<?php if ($v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->umur_tunggakan) == "") { ?>
		<th data-name="umur_tunggakan"><div id="elh_v0302_pinjamanlap_umur_tunggakan" class="v0302_pinjamanlap_umur_tunggakan"><div class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->umur_tunggakan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="umur_tunggakan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v0302_pinjamanlap->SortUrl($v0302_pinjamanlap->umur_tunggakan) ?>',2);"><div id="elh_v0302_pinjamanlap_umur_tunggakan" class="v0302_pinjamanlap_umur_tunggakan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v0302_pinjamanlap->umur_tunggakan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v0302_pinjamanlap->umur_tunggakan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v0302_pinjamanlap->umur_tunggakan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$v0302_pinjamanlap_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v0302_pinjamanlap->ExportAll && $v0302_pinjamanlap->Export <> "") {
	$v0302_pinjamanlap_list->StopRec = $v0302_pinjamanlap_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v0302_pinjamanlap_list->TotalRecs > $v0302_pinjamanlap_list->StartRec + $v0302_pinjamanlap_list->DisplayRecs - 1)
		$v0302_pinjamanlap_list->StopRec = $v0302_pinjamanlap_list->StartRec + $v0302_pinjamanlap_list->DisplayRecs - 1;
	else
		$v0302_pinjamanlap_list->StopRec = $v0302_pinjamanlap_list->TotalRecs;
}
$v0302_pinjamanlap_list->RecCnt = $v0302_pinjamanlap_list->StartRec - 1;
if ($v0302_pinjamanlap_list->Recordset && !$v0302_pinjamanlap_list->Recordset->EOF) {
	$v0302_pinjamanlap_list->Recordset->MoveFirst();
	$bSelectLimit = $v0302_pinjamanlap_list->UseSelectLimit;
	if (!$bSelectLimit && $v0302_pinjamanlap_list->StartRec > 1)
		$v0302_pinjamanlap_list->Recordset->Move($v0302_pinjamanlap_list->StartRec - 1);
} elseif (!$v0302_pinjamanlap->AllowAddDeleteRow && $v0302_pinjamanlap_list->StopRec == 0) {
	$v0302_pinjamanlap_list->StopRec = $v0302_pinjamanlap->GridAddRowCount;
}

// Initialize aggregate
$v0302_pinjamanlap->RowType = EW_ROWTYPE_AGGREGATEINIT;
$v0302_pinjamanlap->ResetAttrs();
$v0302_pinjamanlap_list->RenderRow();
while ($v0302_pinjamanlap_list->RecCnt < $v0302_pinjamanlap_list->StopRec) {
	$v0302_pinjamanlap_list->RecCnt++;
	if (intval($v0302_pinjamanlap_list->RecCnt) >= intval($v0302_pinjamanlap_list->StartRec)) {
		$v0302_pinjamanlap_list->RowCnt++;

		// Set up key count
		$v0302_pinjamanlap_list->KeyCount = $v0302_pinjamanlap_list->RowIndex;

		// Init row class and style
		$v0302_pinjamanlap->ResetAttrs();
		$v0302_pinjamanlap->CssClass = "";
		if ($v0302_pinjamanlap->CurrentAction == "gridadd") {
		} else {
			$v0302_pinjamanlap_list->LoadRowValues($v0302_pinjamanlap_list->Recordset); // Load row values
		}
		$v0302_pinjamanlap->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v0302_pinjamanlap->RowAttrs = array_merge($v0302_pinjamanlap->RowAttrs, array('data-rowindex'=>$v0302_pinjamanlap_list->RowCnt, 'id'=>'r' . $v0302_pinjamanlap_list->RowCnt . '_v0302_pinjamanlap', 'data-rowtype'=>$v0302_pinjamanlap->RowType));

		// Render row
		$v0302_pinjamanlap_list->RenderRow();

		// Render list options
		$v0302_pinjamanlap_list->RenderListOptions();
?>
	<tr<?php echo $v0302_pinjamanlap->RowAttributes() ?>>
<?php

// Render list options (body, left)
$v0302_pinjamanlap_list->ListOptions->Render("body", "left", $v0302_pinjamanlap_list->RowCnt);
?>
	<?php if ($v0302_pinjamanlap->pinjaman_id->Visible) { // pinjaman_id ?>
		<td data-name="pinjaman_id"<?php echo $v0302_pinjamanlap->pinjaman_id->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_pinjaman_id" class="v0302_pinjamanlap_pinjaman_id">
<span<?php echo $v0302_pinjamanlap->pinjaman_id->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->pinjaman_id->ListViewValue() ?></span>
</span>
<a id="<?php echo $v0302_pinjamanlap_list->PageObjName . "_row_" . $v0302_pinjamanlap_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Kontrak_No->Visible) { // Kontrak_No ?>
		<td data-name="Kontrak_No"<?php echo $v0302_pinjamanlap->Kontrak_No->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Kontrak_No" class="v0302_pinjamanlap_Kontrak_No">
<span<?php echo $v0302_pinjamanlap->Kontrak_No->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Kontrak_No->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<td data-name="Kontrak_Tgl"<?php echo $v0302_pinjamanlap->Kontrak_Tgl->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Kontrak_Tgl" class="v0302_pinjamanlap_Kontrak_Tgl">
<span<?php echo $v0302_pinjamanlap->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->nasabah_id->Visible) { // nasabah_id ?>
		<td data-name="nasabah_id"<?php echo $v0302_pinjamanlap->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_nasabah_id" class="v0302_pinjamanlap_nasabah_id">
<span<?php echo $v0302_pinjamanlap->nasabah_id->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->nasabah_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->jaminan_id->Visible) { // jaminan_id ?>
		<td data-name="jaminan_id"<?php echo $v0302_pinjamanlap->jaminan_id->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_jaminan_id" class="v0302_pinjamanlap_jaminan_id">
<span<?php echo $v0302_pinjamanlap->jaminan_id->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->jaminan_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Pinjaman->Visible) { // Pinjaman ?>
		<td data-name="Pinjaman"<?php echo $v0302_pinjamanlap->Pinjaman->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Pinjaman" class="v0302_pinjamanlap_Pinjaman">
<span<?php echo $v0302_pinjamanlap->Pinjaman->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Pinjaman->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
		<td data-name="Angsuran_Lama"<?php echo $v0302_pinjamanlap->Angsuran_Lama->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Lama" class="v0302_pinjamanlap_Angsuran_Lama">
<span<?php echo $v0302_pinjamanlap->Angsuran_Lama->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Lama->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
		<td data-name="Angsuran_Bunga_Prosen"<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Bunga_Prosen" class="v0302_pinjamanlap_Angsuran_Bunga_Prosen">
<span<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
		<td data-name="Angsuran_Denda"<?php echo $v0302_pinjamanlap->Angsuran_Denda->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Denda" class="v0302_pinjamanlap_Angsuran_Denda">
<span<?php echo $v0302_pinjamanlap->Angsuran_Denda->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Denda->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
		<td data-name="Dispensasi_Denda"<?php echo $v0302_pinjamanlap->Dispensasi_Denda->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Dispensasi_Denda" class="v0302_pinjamanlap_Dispensasi_Denda">
<span<?php echo $v0302_pinjamanlap->Dispensasi_Denda->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Dispensasi_Denda->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<td data-name="Angsuran_Pokok"<?php echo $v0302_pinjamanlap->Angsuran_Pokok->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Pokok" class="v0302_pinjamanlap_Angsuran_Pokok">
<span<?php echo $v0302_pinjamanlap->Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Pokok->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<td data-name="Angsuran_Bunga"<?php echo $v0302_pinjamanlap->Angsuran_Bunga->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Bunga" class="v0302_pinjamanlap_Angsuran_Bunga">
<span<?php echo $v0302_pinjamanlap->Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Bunga->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<td data-name="Angsuran_Total"<?php echo $v0302_pinjamanlap->Angsuran_Total->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Angsuran_Total" class="v0302_pinjamanlap_Angsuran_Total">
<span<?php echo $v0302_pinjamanlap->Angsuran_Total->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Angsuran_Total->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->No_Ref->Visible) { // No_Ref ?>
		<td data-name="No_Ref"<?php echo $v0302_pinjamanlap->No_Ref->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_No_Ref" class="v0302_pinjamanlap_No_Ref">
<span<?php echo $v0302_pinjamanlap->No_Ref->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->No_Ref->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
		<td data-name="Biaya_Administrasi"<?php echo $v0302_pinjamanlap->Biaya_Administrasi->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Biaya_Administrasi" class="v0302_pinjamanlap_Biaya_Administrasi">
<span<?php echo $v0302_pinjamanlap->Biaya_Administrasi->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Biaya_Administrasi->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Biaya_Materai->Visible) { // Biaya_Materai ?>
		<td data-name="Biaya_Materai"<?php echo $v0302_pinjamanlap->Biaya_Materai->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Biaya_Materai" class="v0302_pinjamanlap_Biaya_Materai">
<span<?php echo $v0302_pinjamanlap->Biaya_Materai->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Biaya_Materai->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->marketing_id->Visible) { // marketing_id ?>
		<td data-name="marketing_id"<?php echo $v0302_pinjamanlap->marketing_id->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_marketing_id" class="v0302_pinjamanlap_marketing_id">
<span<?php echo $v0302_pinjamanlap->marketing_id->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->marketing_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Periode->Visible) { // Periode ?>
		<td data-name="Periode"<?php echo $v0302_pinjamanlap->Periode->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Periode" class="v0302_pinjamanlap_Periode">
<span<?php echo $v0302_pinjamanlap->Periode->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Periode->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Macet->Visible) { // Macet ?>
		<td data-name="Macet"<?php echo $v0302_pinjamanlap->Macet->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Macet" class="v0302_pinjamanlap_Macet">
<span<?php echo $v0302_pinjamanlap->Macet->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Macet->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->NasabahNama->Visible) { // NasabahNama ?>
		<td data-name="NasabahNama"<?php echo $v0302_pinjamanlap->NasabahNama->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_NasabahNama" class="v0302_pinjamanlap_NasabahNama">
<span<?php echo $v0302_pinjamanlap->NasabahNama->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->NasabahNama->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
		<td data-name="No_Telp_Hp"<?php echo $v0302_pinjamanlap->No_Telp_Hp->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_No_Telp_Hp" class="v0302_pinjamanlap_No_Telp_Hp">
<span<?php echo $v0302_pinjamanlap->No_Telp_Hp->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->No_Telp_Hp->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Pekerjaan->Visible) { // Pekerjaan ?>
		<td data-name="Pekerjaan"<?php echo $v0302_pinjamanlap->Pekerjaan->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Pekerjaan" class="v0302_pinjamanlap_Pekerjaan">
<span<?php echo $v0302_pinjamanlap->Pekerjaan->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Pekerjaan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->Visible) { // Pekerjaan_No_Telp_Hp ?>
		<td data-name="Pekerjaan_No_Telp_Hp"<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Pekerjaan_No_Telp_Hp" class="v0302_pinjamanlap_Pekerjaan_No_Telp_Hp">
<span<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Status->Visible) { // Status ?>
		<td data-name="Status"<?php echo $v0302_pinjamanlap->Status->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Status" class="v0302_pinjamanlap_Status">
<span<?php echo $v0302_pinjamanlap->Status->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Status->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->NasabahKeterangan->Visible) { // NasabahKeterangan ?>
		<td data-name="NasabahKeterangan"<?php echo $v0302_pinjamanlap->NasabahKeterangan->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_NasabahKeterangan" class="v0302_pinjamanlap_NasabahKeterangan">
<span<?php echo $v0302_pinjamanlap->NasabahKeterangan->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->NasabahKeterangan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->MarketingNama->Visible) { // MarketingNama ?>
		<td data-name="MarketingNama"<?php echo $v0302_pinjamanlap->MarketingNama->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_MarketingNama" class="v0302_pinjamanlap_MarketingNama">
<span<?php echo $v0302_pinjamanlap->MarketingNama->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->MarketingNama->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->MarketingAlamat->Visible) { // MarketingAlamat ?>
		<td data-name="MarketingAlamat"<?php echo $v0302_pinjamanlap->MarketingAlamat->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_MarketingAlamat" class="v0302_pinjamanlap_MarketingAlamat">
<span<?php echo $v0302_pinjamanlap->MarketingAlamat->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->MarketingAlamat->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->NoHP->Visible) { // NoHP ?>
		<td data-name="NoHP"<?php echo $v0302_pinjamanlap->NoHP->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_NoHP" class="v0302_pinjamanlap_NoHP">
<span<?php echo $v0302_pinjamanlap->NoHP->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->NoHP->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->AkhirKontrak->Visible) { // AkhirKontrak ?>
		<td data-name="AkhirKontrak"<?php echo $v0302_pinjamanlap->AkhirKontrak->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_AkhirKontrak" class="v0302_pinjamanlap_AkhirKontrak">
<span<?php echo $v0302_pinjamanlap->AkhirKontrak->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->AkhirKontrak->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->sudah_bayar->Visible) { // sudah_bayar ?>
		<td data-name="sudah_bayar"<?php echo $v0302_pinjamanlap->sudah_bayar->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_sudah_bayar" class="v0302_pinjamanlap_sudah_bayar">
<span<?php echo $v0302_pinjamanlap->sudah_bayar->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->sudah_bayar->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->pd_Angsuran_Pokok->Visible) { // pd_Angsuran_Pokok ?>
		<td data-name="pd_Angsuran_Pokok"<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_pd_Angsuran_Pokok" class="v0302_pinjamanlap_pd_Angsuran_Pokok">
<span<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->pd_Angsuran_Bunga->Visible) { // pd_Angsuran_Bunga ?>
		<td data-name="pd_Angsuran_Bunga"<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_pd_Angsuran_Bunga" class="v0302_pinjamanlap_pd_Angsuran_Bunga">
<span<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->pd_Angsuran_Total->Visible) { // pd_Angsuran_Total ?>
		<td data-name="pd_Angsuran_Total"<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_pd_Angsuran_Total" class="v0302_pinjamanlap_pd_Angsuran_Total">
<span<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
		<td data-name="Tanggal_Bayar"<?php echo $v0302_pinjamanlap->Tanggal_Bayar->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_Tanggal_Bayar" class="v0302_pinjamanlap_Tanggal_Bayar">
<span<?php echo $v0302_pinjamanlap->Tanggal_Bayar->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->Tanggal_Bayar->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v0302_pinjamanlap->umur_tunggakan->Visible) { // umur_tunggakan ?>
		<td data-name="umur_tunggakan"<?php echo $v0302_pinjamanlap->umur_tunggakan->CellAttributes() ?>>
<span id="el<?php echo $v0302_pinjamanlap_list->RowCnt ?>_v0302_pinjamanlap_umur_tunggakan" class="v0302_pinjamanlap_umur_tunggakan">
<span<?php echo $v0302_pinjamanlap->umur_tunggakan->ViewAttributes() ?>>
<?php echo $v0302_pinjamanlap->umur_tunggakan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v0302_pinjamanlap_list->ListOptions->Render("body", "right", $v0302_pinjamanlap_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($v0302_pinjamanlap->CurrentAction <> "gridadd")
		$v0302_pinjamanlap_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($v0302_pinjamanlap->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($v0302_pinjamanlap_list->Recordset)
	$v0302_pinjamanlap_list->Recordset->Close();
?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($v0302_pinjamanlap->CurrentAction <> "gridadd" && $v0302_pinjamanlap->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($v0302_pinjamanlap_list->Pager)) $v0302_pinjamanlap_list->Pager = new cPrevNextPager($v0302_pinjamanlap_list->StartRec, $v0302_pinjamanlap_list->DisplayRecs, $v0302_pinjamanlap_list->TotalRecs) ?>
<?php if ($v0302_pinjamanlap_list->Pager->RecordCount > 0 && $v0302_pinjamanlap_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($v0302_pinjamanlap_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $v0302_pinjamanlap_list->PageUrl() ?>start=<?php echo $v0302_pinjamanlap_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($v0302_pinjamanlap_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $v0302_pinjamanlap_list->PageUrl() ?>start=<?php echo $v0302_pinjamanlap_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $v0302_pinjamanlap_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($v0302_pinjamanlap_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $v0302_pinjamanlap_list->PageUrl() ?>start=<?php echo $v0302_pinjamanlap_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($v0302_pinjamanlap_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $v0302_pinjamanlap_list->PageUrl() ?>start=<?php echo $v0302_pinjamanlap_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v0302_pinjamanlap_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v0302_pinjamanlap_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v0302_pinjamanlap_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v0302_pinjamanlap_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($v0302_pinjamanlap_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $v0302_pinjamanlap_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="v0302_pinjamanlap">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($v0302_pinjamanlap_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($v0302_pinjamanlap_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($v0302_pinjamanlap->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v0302_pinjamanlap_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($v0302_pinjamanlap_list->TotalRecs == 0 && $v0302_pinjamanlap->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v0302_pinjamanlap_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<script type="text/javascript">
fv0302_pinjamanlaplistsrch.FilterList = <?php echo $v0302_pinjamanlap_list->GetFilterList() ?>;
fv0302_pinjamanlaplistsrch.Init();
fv0302_pinjamanlaplist.Init();
</script>
<?php } ?>
<?php
$v0302_pinjamanlap_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($v0302_pinjamanlap->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$v0302_pinjamanlap_list->Page_Terminate();
?>
