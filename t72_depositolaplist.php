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

$t72_depositolap_list = NULL; // Initialize page object first

class ct72_depositolap_list extends ct72_depositolap {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't72_depositolap';

	// Page object name
	var $PageObjName = 't72_depositolap_list';

	// Grid form hidden field names
	var $FormName = 'ft72_depositolaplist';
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

		// Table object (t72_depositolap)
		if (!isset($GLOBALS["t72_depositolap"]) || get_class($GLOBALS["t72_depositolap"]) == "ct72_depositolap") {
			$GLOBALS["t72_depositolap"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t72_depositolap"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t72_depositolapadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t72_depositolapdelete.php";
		$this->MultiUpdateUrl = "t72_depositolapupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft72_depositolaplistsrch";

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

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
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

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$bGridInsert = $this->GridInsert();
						} else {
							$bGridInsert = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridInsert) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
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
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
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

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError;
		$this->LoadOldRecord(); // Load old recordset
		$objForm->Index = 0;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
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

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertBegin")); // Batch insert begin
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertSuccess")); // Batch insert success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_field_name") && $objForm->HasValue("o_field_name") && $this->field_name->CurrentValue <> $this->field_name->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_field_caption") && $objForm->HasValue("o_field_caption") && $this->field_caption->CurrentValue <> $this->field_caption->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_field_index") && $objForm->HasValue("o_field_index") && $this->field_index->CurrentValue <> $this->field_index->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_field_status") && $objForm->HasValue("o_field_status") && ew_ConvertToBool($this->field_status->CurrentValue) <> ew_ConvertToBool($this->field_status->OldValue))
			return FALSE;
		if ($objForm->HasValue("x_field_align") && $objForm->HasValue("o_field_align") && $this->field_align->CurrentValue <> $this->field_align->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_field_format") && $objForm->HasValue("o_field_format") && $this->field_format->CurrentValue <> $this->field_format->OldValue)
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
			$this->UpdateSort($this->field_name, $bCtrl); // field_name
			$this->UpdateSort($this->field_caption, $bCtrl); // field_caption
			$this->UpdateSort($this->field_index, $bCtrl); // field_index
			$this->UpdateSort($this->field_status, $bCtrl); // field_status
			$this->UpdateSort($this->field_align, $bCtrl); // field_align
			$this->UpdateSort($this->field_format, $bCtrl); // field_format
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
				$this->field_index->setSort("ASC");
				$this->field_status->setSort("ASC");
				$this->field_name->setSort("ASC");
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
				$this->field_name->setSort("");
				$this->field_caption->setSort("");
				$this->field_index->setSort("");
				$this->field_status->setSort("");
				$this->field_align->setSort("");
				$this->field_format->setSort("");
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

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
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

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if (($this->CurrentAction == "add" || $this->CurrentAction == "copy") && $this->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink ewInlineInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
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
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineCopy\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->Phrase("InlineCopyLink") . "</a>";
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
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());

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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft72_depositolaplistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft72_depositolaplistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft72_depositolaplist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
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
		$this->field_name->CurrentValue = NULL;
		$this->field_name->OldValue = $this->field_name->CurrentValue;
		$this->field_caption->CurrentValue = "Judul Kolom";
		$this->field_caption->OldValue = $this->field_caption->CurrentValue;
		$this->field_index->CurrentValue = 0;
		$this->field_index->OldValue = $this->field_index->CurrentValue;
		$this->field_status->CurrentValue = "Y";
		$this->field_status->OldValue = $this->field_status->CurrentValue;
		$this->field_align->CurrentValue = "left";
		$this->field_align->OldValue = $this->field_align->CurrentValue;
		$this->field_format->CurrentValue = "none";
		$this->field_format->OldValue = $this->field_format->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->field_name->FldIsDetailKey) {
			$this->field_name->setFormValue($objForm->GetValue("x_field_name"));
		}
		$this->field_name->setOldValue($objForm->GetValue("o_field_name"));
		if (!$this->field_caption->FldIsDetailKey) {
			$this->field_caption->setFormValue($objForm->GetValue("x_field_caption"));
		}
		$this->field_caption->setOldValue($objForm->GetValue("o_field_caption"));
		if (!$this->field_index->FldIsDetailKey) {
			$this->field_index->setFormValue($objForm->GetValue("x_field_index"));
		}
		$this->field_index->setOldValue($objForm->GetValue("o_field_index"));
		if (!$this->field_status->FldIsDetailKey) {
			$this->field_status->setFormValue($objForm->GetValue("x_field_status"));
		}
		$this->field_status->setOldValue($objForm->GetValue("o_field_status"));
		if (!$this->field_align->FldIsDetailKey) {
			$this->field_align->setFormValue($objForm->GetValue("x_field_align"));
		}
		$this->field_align->setOldValue($objForm->GetValue("o_field_align"));
		if (!$this->field_format->FldIsDetailKey) {
			$this->field_format->setFormValue($objForm->GetValue("x_field_format"));
		}
		$this->field_format->setOldValue($objForm->GetValue("o_field_format"));
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->field_name->CurrentValue = $this->field_name->FormValue;
		$this->field_caption->CurrentValue = $this->field_caption->FormValue;
		$this->field_index->CurrentValue = $this->field_index->FormValue;
		$this->field_status->CurrentValue = $this->field_status->FormValue;
		$this->field_align->CurrentValue = $this->field_align->FormValue;
		$this->field_format->CurrentValue = $this->field_format->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// field_name
			$this->field_name->EditAttrs["class"] = "form-control";
			$this->field_name->EditCustomAttributes = "";
			$this->field_name->EditValue = ew_HtmlEncode($this->field_name->CurrentValue);
			$this->field_name->PlaceHolder = ew_RemoveHtml($this->field_name->FldCaption());

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

			// Add refer script
			// field_name

			$this->field_name->LinkCustomAttributes = "";
			$this->field_name->HrefValue = "";

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
		if (!$this->field_name->FldIsDetailKey && !is_null($this->field_name->FormValue) && $this->field_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->field_name->FldCaption(), $this->field_name->ReqErrMsg));
		}
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// field_name
		$this->field_name->SetDbValueDef($rsnew, $this->field_name->CurrentValue, "", FALSE);

		// field_caption
		$this->field_caption->SetDbValueDef($rsnew, $this->field_caption->CurrentValue, "", strval($this->field_caption->CurrentValue) == "");

		// field_index
		$this->field_index->SetDbValueDef($rsnew, $this->field_index->CurrentValue, 0, strval($this->field_index->CurrentValue) == "");

		// field_status
		$this->field_status->SetDbValueDef($rsnew, ((strval($this->field_status->CurrentValue) == "Y") ? "Y" : "N"), "N", strval($this->field_status->CurrentValue) == "");

		// field_align
		$this->field_align->SetDbValueDef($rsnew, $this->field_align->CurrentValue, "", strval($this->field_align->CurrentValue) == "");

		// field_format
		$this->field_format->SetDbValueDef($rsnew, $this->field_format->CurrentValue, "", strval($this->field_format->CurrentValue) == "");

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
		$item->Body = "<button id=\"emf_t72_depositolap\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t72_depositolap',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft72_depositolaplist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if (isset($_GET["a"]) and $_GET["a"] == "cancel") {

			//echo "<script>alert('cancel this page');</script>";
			header("location: cf43_deposito.php");
		}
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
if (!isset($t72_depositolap_list)) $t72_depositolap_list = new ct72_depositolap_list();

// Page init
$t72_depositolap_list->Page_Init();

// Page main
$t72_depositolap_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t72_depositolap_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t72_depositolap->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft72_depositolaplist = new ew_Form("ft72_depositolaplist", "list");
ft72_depositolaplist.FormKeyCountName = '<?php echo $t72_depositolap_list->FormKeyCountName ?>';

// Validate form
ft72_depositolaplist.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_field_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t72_depositolap->field_name->FldCaption(), $t72_depositolap->field_name->ReqErrMsg)) ?>");
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
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew_Alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
ft72_depositolaplist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "field_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "field_caption", false)) return false;
	if (ew_ValueChanged(fobj, infix, "field_index", false)) return false;
	if (ew_ValueChanged(fobj, infix, "field_status", true)) return false;
	if (ew_ValueChanged(fobj, infix, "field_align", false)) return false;
	if (ew_ValueChanged(fobj, infix, "field_format", false)) return false;
	return true;
}

// Form_CustomValidate event
ft72_depositolaplist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft72_depositolaplist.ValidateRequired = true;
<?php } else { ?>
ft72_depositolaplist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft72_depositolaplist.Lists["x_field_status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolaplist.Lists["x_field_status"].Options = <?php echo json_encode($t72_depositolap->field_status->Options()) ?>;
ft72_depositolaplist.Lists["x_field_align"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolaplist.Lists["x_field_align"].Options = <?php echo json_encode($t72_depositolap->field_align->Options()) ?>;
ft72_depositolaplist.Lists["x_field_format"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft72_depositolaplist.Lists["x_field_format"].Options = <?php echo json_encode($t72_depositolap->field_format->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t72_depositolap->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t72_depositolap->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($t72_depositolap_list->TotalRecs > 0 && $t72_depositolap_list->ExportOptions->Visible()) { ?>
<?php $t72_depositolap_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t72_depositolap->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
if ($t72_depositolap->CurrentAction == "gridadd") {
	$t72_depositolap->CurrentFilter = "0=1";
	$t72_depositolap_list->StartRec = 1;
	$t72_depositolap_list->DisplayRecs = $t72_depositolap->GridAddRowCount;
	$t72_depositolap_list->TotalRecs = $t72_depositolap_list->DisplayRecs;
	$t72_depositolap_list->StopRec = $t72_depositolap_list->DisplayRecs;
} else {
	$bSelectLimit = $t72_depositolap_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t72_depositolap_list->TotalRecs <= 0)
			$t72_depositolap_list->TotalRecs = $t72_depositolap->SelectRecordCount();
	} else {
		if (!$t72_depositolap_list->Recordset && ($t72_depositolap_list->Recordset = $t72_depositolap_list->LoadRecordset()))
			$t72_depositolap_list->TotalRecs = $t72_depositolap_list->Recordset->RecordCount();
	}
	$t72_depositolap_list->StartRec = 1;
	if ($t72_depositolap_list->DisplayRecs <= 0 || ($t72_depositolap->Export <> "" && $t72_depositolap->ExportAll)) // Display all records
		$t72_depositolap_list->DisplayRecs = $t72_depositolap_list->TotalRecs;
	if (!($t72_depositolap->Export <> "" && $t72_depositolap->ExportAll))
		$t72_depositolap_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t72_depositolap_list->Recordset = $t72_depositolap_list->LoadRecordset($t72_depositolap_list->StartRec-1, $t72_depositolap_list->DisplayRecs);

	// Set no record found message
	if ($t72_depositolap->CurrentAction == "" && $t72_depositolap_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t72_depositolap_list->setWarningMessage(ew_DeniedMsg());
		if ($t72_depositolap_list->SearchWhere == "0=101")
			$t72_depositolap_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t72_depositolap_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t72_depositolap_list->RenderOtherOptions();
?>
<?php $t72_depositolap_list->ShowPageHeader(); ?>
<?php
$t72_depositolap_list->ShowMessage();
?>
<?php if ($t72_depositolap_list->TotalRecs > 0 || $t72_depositolap->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t72_depositolap">
<form name="ft72_depositolaplist" id="ft72_depositolaplist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t72_depositolap_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t72_depositolap_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t72_depositolap">
<div id="gmp_t72_depositolap" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t72_depositolap_list->TotalRecs > 0 || $t72_depositolap->CurrentAction == "add" || $t72_depositolap->CurrentAction == "copy" || $t72_depositolap->CurrentAction == "gridedit") { ?>
<table id="tbl_t72_depositolaplist" class="table ewTable">
<?php echo $t72_depositolap->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t72_depositolap_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t72_depositolap_list->RenderListOptions();

// Render list options (header, left)
$t72_depositolap_list->ListOptions->Render("header", "left");
?>
<?php if ($t72_depositolap->field_name->Visible) { // field_name ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_name) == "") { ?>
		<th data-name="field_name"><div id="elh_t72_depositolap_field_name" class="t72_depositolap_field_name"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_name"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_name) ?>',2);"><div id="elh_t72_depositolap_field_name" class="t72_depositolap_field_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t72_depositolap->field_caption->Visible) { // field_caption ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_caption) == "") { ?>
		<th data-name="field_caption"><div id="elh_t72_depositolap_field_caption" class="t72_depositolap_field_caption"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_caption->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_caption"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_caption) ?>',2);"><div id="elh_t72_depositolap_field_caption" class="t72_depositolap_field_caption">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_caption->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_caption->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_caption->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t72_depositolap->field_index->Visible) { // field_index ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_index) == "") { ?>
		<th data-name="field_index"><div id="elh_t72_depositolap_field_index" class="t72_depositolap_field_index"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_index->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_index"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_index) ?>',2);"><div id="elh_t72_depositolap_field_index" class="t72_depositolap_field_index">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_index->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_index->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_index->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t72_depositolap->field_status->Visible) { // field_status ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_status) == "") { ?>
		<th data-name="field_status"><div id="elh_t72_depositolap_field_status" class="t72_depositolap_field_status"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_status->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_status"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_status) ?>',2);"><div id="elh_t72_depositolap_field_status" class="t72_depositolap_field_status">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_status->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t72_depositolap->field_align->Visible) { // field_align ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_align) == "") { ?>
		<th data-name="field_align"><div id="elh_t72_depositolap_field_align" class="t72_depositolap_field_align"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_align->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_align"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_align) ?>',2);"><div id="elh_t72_depositolap_field_align" class="t72_depositolap_field_align">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_align->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_align->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_align->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t72_depositolap->field_format->Visible) { // field_format ?>
	<?php if ($t72_depositolap->SortUrl($t72_depositolap->field_format) == "") { ?>
		<th data-name="field_format"><div id="elh_t72_depositolap_field_format" class="t72_depositolap_field_format"><div class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_format->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field_format"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t72_depositolap->SortUrl($t72_depositolap->field_format) ?>',2);"><div id="elh_t72_depositolap_field_format" class="t72_depositolap_field_format">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t72_depositolap->field_format->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t72_depositolap->field_format->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t72_depositolap->field_format->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t72_depositolap_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t72_depositolap->CurrentAction == "add" || $t72_depositolap->CurrentAction == "copy") {
		$t72_depositolap_list->RowIndex = 0;
		$t72_depositolap_list->KeyCount = $t72_depositolap_list->RowIndex;
		if ($t72_depositolap->CurrentAction == "copy" && !$t72_depositolap_list->LoadRow())
				$t72_depositolap->CurrentAction = "add";
		if ($t72_depositolap->CurrentAction == "add")
			$t72_depositolap_list->LoadDefaultValues();
		if ($t72_depositolap->EventCancelled) // Insert failed
			$t72_depositolap_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$t72_depositolap->ResetAttrs();
		$t72_depositolap->RowAttrs = array_merge($t72_depositolap->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_t72_depositolap', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$t72_depositolap->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t72_depositolap_list->RenderRow();

		// Render list options
		$t72_depositolap_list->RenderListOptions();
		$t72_depositolap_list->StartRowCnt = 0;
?>
	<tr<?php echo $t72_depositolap->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t72_depositolap_list->ListOptions->Render("body", "left", $t72_depositolap_list->RowCnt);
?>
	<?php if ($t72_depositolap->field_name->Visible) { // field_name ?>
		<td data-name="field_name">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_name" class="form-group t72_depositolap_field_name">
<input type="text" data-table="t72_depositolap" data-field="x_field_name" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_name->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_name->EditValue ?>"<?php echo $t72_depositolap->field_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_name" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" value="<?php echo ew_HtmlEncode($t72_depositolap->field_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_caption->Visible) { // field_caption ?>
		<td data-name="field_caption">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_caption" class="form-group t72_depositolap_field_caption">
<input type="text" data-table="t72_depositolap" data-field="x_field_caption" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_caption->EditValue ?>"<?php echo $t72_depositolap->field_caption->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_caption" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" value="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_index->Visible) { // field_index ?>
		<td data-name="field_index">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_index" class="form-group t72_depositolap_field_index">
<input type="text" data-table="t72_depositolap" data-field="x_field_index" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" size="5" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_index->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_index->EditValue ?>"<?php echo $t72_depositolap->field_index->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_index" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" value="<?php echo ew_HtmlEncode($t72_depositolap->field_index->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_status->Visible) { // field_status ?>
		<td data-name="field_status">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_status" class="form-group t72_depositolap_field_status">
<div id="tp_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" class="ewTemplate"><input type="radio" data-table="t72_depositolap" data-field="x_field_status" data-value-separator="<?php echo $t72_depositolap->field_status->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="{value}"<?php echo $t72_depositolap->field_status->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t72_depositolap->field_status->RadioButtonListHtml(FALSE, "x{$t72_depositolap_list->RowIndex}_field_status") ?>
</div></div>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_status" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="<?php echo ew_HtmlEncode($t72_depositolap->field_status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_align->Visible) { // field_align ?>
		<td data-name="field_align">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_align" class="form-group t72_depositolap_field_align">
<select data-table="t72_depositolap" data-field="x_field_align" data-value-separator="<?php echo $t72_depositolap->field_align->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align"<?php echo $t72_depositolap->field_align->EditAttributes() ?>>
<?php echo $t72_depositolap->field_align->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_align") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_align" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" value="<?php echo ew_HtmlEncode($t72_depositolap->field_align->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_format->Visible) { // field_format ?>
		<td data-name="field_format">
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_format" class="form-group t72_depositolap_field_format">
<select data-table="t72_depositolap" data-field="x_field_format" data-value-separator="<?php echo $t72_depositolap->field_format->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format"<?php echo $t72_depositolap->field_format->EditAttributes() ?>>
<?php echo $t72_depositolap->field_format->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_format") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_format" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" value="<?php echo ew_HtmlEncode($t72_depositolap->field_format->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t72_depositolap_list->ListOptions->Render("body", "right", $t72_depositolap_list->RowCnt);
?>
<script type="text/javascript">
ft72_depositolaplist.UpdateOpts(<?php echo $t72_depositolap_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($t72_depositolap->ExportAll && $t72_depositolap->Export <> "") {
	$t72_depositolap_list->StopRec = $t72_depositolap_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t72_depositolap_list->TotalRecs > $t72_depositolap_list->StartRec + $t72_depositolap_list->DisplayRecs - 1)
		$t72_depositolap_list->StopRec = $t72_depositolap_list->StartRec + $t72_depositolap_list->DisplayRecs - 1;
	else
		$t72_depositolap_list->StopRec = $t72_depositolap_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t72_depositolap_list->FormKeyCountName) && ($t72_depositolap->CurrentAction == "gridadd" || $t72_depositolap->CurrentAction == "gridedit" || $t72_depositolap->CurrentAction == "F")) {
		$t72_depositolap_list->KeyCount = $objForm->GetValue($t72_depositolap_list->FormKeyCountName);
		$t72_depositolap_list->StopRec = $t72_depositolap_list->StartRec + $t72_depositolap_list->KeyCount - 1;
	}
}
$t72_depositolap_list->RecCnt = $t72_depositolap_list->StartRec - 1;
if ($t72_depositolap_list->Recordset && !$t72_depositolap_list->Recordset->EOF) {
	$t72_depositolap_list->Recordset->MoveFirst();
	$bSelectLimit = $t72_depositolap_list->UseSelectLimit;
	if (!$bSelectLimit && $t72_depositolap_list->StartRec > 1)
		$t72_depositolap_list->Recordset->Move($t72_depositolap_list->StartRec - 1);
} elseif (!$t72_depositolap->AllowAddDeleteRow && $t72_depositolap_list->StopRec == 0) {
	$t72_depositolap_list->StopRec = $t72_depositolap->GridAddRowCount;
}

// Initialize aggregate
$t72_depositolap->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t72_depositolap->ResetAttrs();
$t72_depositolap_list->RenderRow();
$t72_depositolap_list->EditRowCnt = 0;
if ($t72_depositolap->CurrentAction == "edit")
	$t72_depositolap_list->RowIndex = 1;
if ($t72_depositolap->CurrentAction == "gridadd")
	$t72_depositolap_list->RowIndex = 0;
if ($t72_depositolap->CurrentAction == "gridedit")
	$t72_depositolap_list->RowIndex = 0;
while ($t72_depositolap_list->RecCnt < $t72_depositolap_list->StopRec) {
	$t72_depositolap_list->RecCnt++;
	if (intval($t72_depositolap_list->RecCnt) >= intval($t72_depositolap_list->StartRec)) {
		$t72_depositolap_list->RowCnt++;
		if ($t72_depositolap->CurrentAction == "gridadd" || $t72_depositolap->CurrentAction == "gridedit" || $t72_depositolap->CurrentAction == "F") {
			$t72_depositolap_list->RowIndex++;
			$objForm->Index = $t72_depositolap_list->RowIndex;
			if ($objForm->HasValue($t72_depositolap_list->FormActionName))
				$t72_depositolap_list->RowAction = strval($objForm->GetValue($t72_depositolap_list->FormActionName));
			elseif ($t72_depositolap->CurrentAction == "gridadd")
				$t72_depositolap_list->RowAction = "insert";
			else
				$t72_depositolap_list->RowAction = "";
		}

		// Set up key count
		$t72_depositolap_list->KeyCount = $t72_depositolap_list->RowIndex;

		// Init row class and style
		$t72_depositolap->ResetAttrs();
		$t72_depositolap->CssClass = "";
		if ($t72_depositolap->CurrentAction == "gridadd") {
			$t72_depositolap_list->LoadDefaultValues(); // Load default values
		} else {
			$t72_depositolap_list->LoadRowValues($t72_depositolap_list->Recordset); // Load row values
		}
		$t72_depositolap->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t72_depositolap->CurrentAction == "gridadd") // Grid add
			$t72_depositolap->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t72_depositolap->CurrentAction == "gridadd" && $t72_depositolap->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t72_depositolap_list->RestoreCurrentRowFormValues($t72_depositolap_list->RowIndex); // Restore form values
		if ($t72_depositolap->CurrentAction == "edit") {
			if ($t72_depositolap_list->CheckInlineEditKey() && $t72_depositolap_list->EditRowCnt == 0) { // Inline edit
				$t72_depositolap->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t72_depositolap->CurrentAction == "gridedit") { // Grid edit
			if ($t72_depositolap->EventCancelled) {
				$t72_depositolap_list->RestoreCurrentRowFormValues($t72_depositolap_list->RowIndex); // Restore form values
			}
			if ($t72_depositolap_list->RowAction == "insert")
				$t72_depositolap->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t72_depositolap->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t72_depositolap->CurrentAction == "edit" && $t72_depositolap->RowType == EW_ROWTYPE_EDIT && $t72_depositolap->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t72_depositolap_list->RestoreFormValues(); // Restore form values
		}
		if ($t72_depositolap->CurrentAction == "gridedit" && ($t72_depositolap->RowType == EW_ROWTYPE_EDIT || $t72_depositolap->RowType == EW_ROWTYPE_ADD) && $t72_depositolap->EventCancelled) // Update failed
			$t72_depositolap_list->RestoreCurrentRowFormValues($t72_depositolap_list->RowIndex); // Restore form values
		if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t72_depositolap_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t72_depositolap->RowAttrs = array_merge($t72_depositolap->RowAttrs, array('data-rowindex'=>$t72_depositolap_list->RowCnt, 'id'=>'r' . $t72_depositolap_list->RowCnt . '_t72_depositolap', 'data-rowtype'=>$t72_depositolap->RowType));

		// Render row
		$t72_depositolap_list->RenderRow();

		// Render list options
		$t72_depositolap_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t72_depositolap_list->RowAction <> "delete" && $t72_depositolap_list->RowAction <> "insertdelete" && !($t72_depositolap_list->RowAction == "insert" && $t72_depositolap->CurrentAction == "F" && $t72_depositolap_list->EmptyRow())) {
?>
	<tr<?php echo $t72_depositolap->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t72_depositolap_list->ListOptions->Render("body", "left", $t72_depositolap_list->RowCnt);
?>
	<?php if ($t72_depositolap->field_name->Visible) { // field_name ?>
		<td data-name="field_name"<?php echo $t72_depositolap->field_name->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_name" class="form-group t72_depositolap_field_name">
<input type="text" data-table="t72_depositolap" data-field="x_field_name" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_name->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_name->EditValue ?>"<?php echo $t72_depositolap->field_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_name" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" value="<?php echo ew_HtmlEncode($t72_depositolap->field_name->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_name" class="form-group t72_depositolap_field_name">
<span<?php echo $t72_depositolap->field_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t72_depositolap->field_name->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_name" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" value="<?php echo ew_HtmlEncode($t72_depositolap->field_name->CurrentValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_name" class="t72_depositolap_field_name">
<span<?php echo $t72_depositolap->field_name->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_name->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t72_depositolap_list->PageObjName . "_row_" . $t72_depositolap_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t72_depositolap" data-field="x_id" name="x<?php echo $t72_depositolap_list->RowIndex ?>_id" id="x<?php echo $t72_depositolap_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t72_depositolap->id->CurrentValue) ?>">
<input type="hidden" data-table="t72_depositolap" data-field="x_id" name="o<?php echo $t72_depositolap_list->RowIndex ?>_id" id="o<?php echo $t72_depositolap_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t72_depositolap->id->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT || $t72_depositolap->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t72_depositolap" data-field="x_id" name="x<?php echo $t72_depositolap_list->RowIndex ?>_id" id="x<?php echo $t72_depositolap_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t72_depositolap->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t72_depositolap->field_caption->Visible) { // field_caption ?>
		<td data-name="field_caption"<?php echo $t72_depositolap->field_caption->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_caption" class="form-group t72_depositolap_field_caption">
<input type="text" data-table="t72_depositolap" data-field="x_field_caption" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_caption->EditValue ?>"<?php echo $t72_depositolap->field_caption->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_caption" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" value="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_caption" class="form-group t72_depositolap_field_caption">
<input type="text" data-table="t72_depositolap" data-field="x_field_caption" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_caption->EditValue ?>"<?php echo $t72_depositolap->field_caption->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_caption" class="t72_depositolap_field_caption">
<span<?php echo $t72_depositolap->field_caption->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_caption->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_index->Visible) { // field_index ?>
		<td data-name="field_index"<?php echo $t72_depositolap->field_index->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_index" class="form-group t72_depositolap_field_index">
<input type="text" data-table="t72_depositolap" data-field="x_field_index" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" size="5" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_index->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_index->EditValue ?>"<?php echo $t72_depositolap->field_index->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_index" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" value="<?php echo ew_HtmlEncode($t72_depositolap->field_index->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_index" class="form-group t72_depositolap_field_index">
<input type="text" data-table="t72_depositolap" data-field="x_field_index" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" size="5" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_index->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_index->EditValue ?>"<?php echo $t72_depositolap->field_index->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_index" class="t72_depositolap_field_index">
<span<?php echo $t72_depositolap->field_index->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_index->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_status->Visible) { // field_status ?>
		<td data-name="field_status"<?php echo $t72_depositolap->field_status->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_status" class="form-group t72_depositolap_field_status">
<div id="tp_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" class="ewTemplate"><input type="radio" data-table="t72_depositolap" data-field="x_field_status" data-value-separator="<?php echo $t72_depositolap->field_status->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="{value}"<?php echo $t72_depositolap->field_status->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t72_depositolap->field_status->RadioButtonListHtml(FALSE, "x{$t72_depositolap_list->RowIndex}_field_status") ?>
</div></div>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_status" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="<?php echo ew_HtmlEncode($t72_depositolap->field_status->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_status" class="form-group t72_depositolap_field_status">
<div id="tp_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" class="ewTemplate"><input type="radio" data-table="t72_depositolap" data-field="x_field_status" data-value-separator="<?php echo $t72_depositolap->field_status->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="{value}"<?php echo $t72_depositolap->field_status->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t72_depositolap->field_status->RadioButtonListHtml(FALSE, "x{$t72_depositolap_list->RowIndex}_field_status") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_status" class="t72_depositolap_field_status">
<span<?php echo $t72_depositolap->field_status->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_status->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_align->Visible) { // field_align ?>
		<td data-name="field_align"<?php echo $t72_depositolap->field_align->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_align" class="form-group t72_depositolap_field_align">
<select data-table="t72_depositolap" data-field="x_field_align" data-value-separator="<?php echo $t72_depositolap->field_align->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align"<?php echo $t72_depositolap->field_align->EditAttributes() ?>>
<?php echo $t72_depositolap->field_align->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_align") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_align" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" value="<?php echo ew_HtmlEncode($t72_depositolap->field_align->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_align" class="form-group t72_depositolap_field_align">
<select data-table="t72_depositolap" data-field="x_field_align" data-value-separator="<?php echo $t72_depositolap->field_align->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align"<?php echo $t72_depositolap->field_align->EditAttributes() ?>>
<?php echo $t72_depositolap->field_align->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_align") ?>
</select>
</span>
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_align" class="t72_depositolap_field_align">
<span<?php echo $t72_depositolap->field_align->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_align->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_format->Visible) { // field_format ?>
		<td data-name="field_format"<?php echo $t72_depositolap->field_format->CellAttributes() ?>>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_format" class="form-group t72_depositolap_field_format">
<select data-table="t72_depositolap" data-field="x_field_format" data-value-separator="<?php echo $t72_depositolap->field_format->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format"<?php echo $t72_depositolap->field_format->EditAttributes() ?>>
<?php echo $t72_depositolap->field_format->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_format") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_format" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" value="<?php echo ew_HtmlEncode($t72_depositolap->field_format->OldValue) ?>">
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_format" class="form-group t72_depositolap_field_format">
<select data-table="t72_depositolap" data-field="x_field_format" data-value-separator="<?php echo $t72_depositolap->field_format->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format"<?php echo $t72_depositolap->field_format->EditAttributes() ?>>
<?php echo $t72_depositolap->field_format->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_format") ?>
</select>
</span>
<?php } ?>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t72_depositolap_list->RowCnt ?>_t72_depositolap_field_format" class="t72_depositolap_field_format">
<span<?php echo $t72_depositolap->field_format->ViewAttributes() ?>>
<?php echo $t72_depositolap->field_format->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t72_depositolap_list->ListOptions->Render("body", "right", $t72_depositolap_list->RowCnt);
?>
	</tr>
<?php if ($t72_depositolap->RowType == EW_ROWTYPE_ADD || $t72_depositolap->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft72_depositolaplist.UpdateOpts(<?php echo $t72_depositolap_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t72_depositolap->CurrentAction <> "gridadd")
		if (!$t72_depositolap_list->Recordset->EOF) $t72_depositolap_list->Recordset->MoveNext();
}
?>
<?php
	if ($t72_depositolap->CurrentAction == "gridadd" || $t72_depositolap->CurrentAction == "gridedit") {
		$t72_depositolap_list->RowIndex = '$rowindex$';
		$t72_depositolap_list->LoadDefaultValues();

		// Set row properties
		$t72_depositolap->ResetAttrs();
		$t72_depositolap->RowAttrs = array_merge($t72_depositolap->RowAttrs, array('data-rowindex'=>$t72_depositolap_list->RowIndex, 'id'=>'r0_t72_depositolap', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t72_depositolap->RowAttrs["class"], "ewTemplate");
		$t72_depositolap->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t72_depositolap_list->RenderRow();

		// Render list options
		$t72_depositolap_list->RenderListOptions();
		$t72_depositolap_list->StartRowCnt = 0;
?>
	<tr<?php echo $t72_depositolap->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t72_depositolap_list->ListOptions->Render("body", "left", $t72_depositolap_list->RowIndex);
?>
	<?php if ($t72_depositolap->field_name->Visible) { // field_name ?>
		<td data-name="field_name">
<span id="el$rowindex$_t72_depositolap_field_name" class="form-group t72_depositolap_field_name">
<input type="text" data-table="t72_depositolap" data-field="x_field_name" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_name" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_name->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_name->EditValue ?>"<?php echo $t72_depositolap->field_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_name" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_name" value="<?php echo ew_HtmlEncode($t72_depositolap->field_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_caption->Visible) { // field_caption ?>
		<td data-name="field_caption">
<span id="el$rowindex$_t72_depositolap_field_caption" class="form-group t72_depositolap_field_caption">
<input type="text" data-table="t72_depositolap" data-field="x_field_caption" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" size="30" maxlength="32" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_caption->EditValue ?>"<?php echo $t72_depositolap->field_caption->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_caption" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_caption" value="<?php echo ew_HtmlEncode($t72_depositolap->field_caption->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_index->Visible) { // field_index ?>
		<td data-name="field_index">
<span id="el$rowindex$_t72_depositolap_field_index" class="form-group t72_depositolap_field_index">
<input type="text" data-table="t72_depositolap" data-field="x_field_index" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_index" size="5" placeholder="<?php echo ew_HtmlEncode($t72_depositolap->field_index->getPlaceHolder()) ?>" value="<?php echo $t72_depositolap->field_index->EditValue ?>"<?php echo $t72_depositolap->field_index->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_index" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_index" value="<?php echo ew_HtmlEncode($t72_depositolap->field_index->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_status->Visible) { // field_status ?>
		<td data-name="field_status">
<span id="el$rowindex$_t72_depositolap_field_status" class="form-group t72_depositolap_field_status">
<div id="tp_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" class="ewTemplate"><input type="radio" data-table="t72_depositolap" data-field="x_field_status" data-value-separator="<?php echo $t72_depositolap->field_status->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="{value}"<?php echo $t72_depositolap->field_status->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t72_depositolap_list->RowIndex ?>_field_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t72_depositolap->field_status->RadioButtonListHtml(FALSE, "x{$t72_depositolap_list->RowIndex}_field_status") ?>
</div></div>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_status" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_status" value="<?php echo ew_HtmlEncode($t72_depositolap->field_status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_align->Visible) { // field_align ?>
		<td data-name="field_align">
<span id="el$rowindex$_t72_depositolap_field_align" class="form-group t72_depositolap_field_align">
<select data-table="t72_depositolap" data-field="x_field_align" data-value-separator="<?php echo $t72_depositolap->field_align->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_align"<?php echo $t72_depositolap->field_align->EditAttributes() ?>>
<?php echo $t72_depositolap->field_align->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_align") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_align" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_align" value="<?php echo ew_HtmlEncode($t72_depositolap->field_align->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t72_depositolap->field_format->Visible) { // field_format ?>
		<td data-name="field_format">
<span id="el$rowindex$_t72_depositolap_field_format" class="form-group t72_depositolap_field_format">
<select data-table="t72_depositolap" data-field="x_field_format" data-value-separator="<?php echo $t72_depositolap->field_format->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format" name="x<?php echo $t72_depositolap_list->RowIndex ?>_field_format"<?php echo $t72_depositolap->field_format->EditAttributes() ?>>
<?php echo $t72_depositolap->field_format->SelectOptionListHtml("x<?php echo $t72_depositolap_list->RowIndex ?>_field_format") ?>
</select>
</span>
<input type="hidden" data-table="t72_depositolap" data-field="x_field_format" name="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" id="o<?php echo $t72_depositolap_list->RowIndex ?>_field_format" value="<?php echo ew_HtmlEncode($t72_depositolap->field_format->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t72_depositolap_list->ListOptions->Render("body", "right", $t72_depositolap_list->RowCnt);
?>
<script type="text/javascript">
ft72_depositolaplist.UpdateOpts(<?php echo $t72_depositolap_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t72_depositolap->CurrentAction == "add" || $t72_depositolap->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $t72_depositolap_list->FormKeyCountName ?>" id="<?php echo $t72_depositolap_list->FormKeyCountName ?>" value="<?php echo $t72_depositolap_list->KeyCount ?>">
<?php } ?>
<?php if ($t72_depositolap->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t72_depositolap_list->FormKeyCountName ?>" id="<?php echo $t72_depositolap_list->FormKeyCountName ?>" value="<?php echo $t72_depositolap_list->KeyCount ?>">
<?php echo $t72_depositolap_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t72_depositolap->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t72_depositolap_list->FormKeyCountName ?>" id="<?php echo $t72_depositolap_list->FormKeyCountName ?>" value="<?php echo $t72_depositolap_list->KeyCount ?>">
<?php } ?>
<?php if ($t72_depositolap->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t72_depositolap_list->FormKeyCountName ?>" id="<?php echo $t72_depositolap_list->FormKeyCountName ?>" value="<?php echo $t72_depositolap_list->KeyCount ?>">
<?php echo $t72_depositolap_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t72_depositolap->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t72_depositolap_list->Recordset)
	$t72_depositolap_list->Recordset->Close();
?>
<?php if ($t72_depositolap->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t72_depositolap->CurrentAction <> "gridadd" && $t72_depositolap->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t72_depositolap_list->Pager)) $t72_depositolap_list->Pager = new cPrevNextPager($t72_depositolap_list->StartRec, $t72_depositolap_list->DisplayRecs, $t72_depositolap_list->TotalRecs) ?>
<?php if ($t72_depositolap_list->Pager->RecordCount > 0 && $t72_depositolap_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t72_depositolap_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t72_depositolap_list->PageUrl() ?>start=<?php echo $t72_depositolap_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t72_depositolap_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t72_depositolap_list->PageUrl() ?>start=<?php echo $t72_depositolap_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t72_depositolap_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t72_depositolap_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t72_depositolap_list->PageUrl() ?>start=<?php echo $t72_depositolap_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t72_depositolap_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t72_depositolap_list->PageUrl() ?>start=<?php echo $t72_depositolap_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t72_depositolap_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t72_depositolap_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t72_depositolap_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t72_depositolap_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t72_depositolap_list->TotalRecs > 0 && (!EW_AUTO_HIDE_PAGE_SIZE_SELECTOR || $t72_depositolap_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t72_depositolap">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($t72_depositolap_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t72_depositolap_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($t72_depositolap->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t72_depositolap_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t72_depositolap_list->TotalRecs == 0 && $t72_depositolap->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t72_depositolap_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t72_depositolap->Export == "") { ?>
<script type="text/javascript">
ft72_depositolaplist.Init();
</script>
<?php } ?>
<?php
$t72_depositolap_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t72_depositolap->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t72_depositolap_list->Page_Terminate();
?>
