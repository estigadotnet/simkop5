<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t04_pinjamanangsurantempinfo.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t04_pinjamanangsurantemp_list = NULL; // Initialize page object first

class ct04_pinjamanangsurantemp_list extends ct04_pinjamanangsurantemp {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't04_pinjamanangsurantemp';

	// Page object name
	var $PageObjName = 't04_pinjamanangsurantemp_list';

	// Grid form hidden field names
	var $FormName = 'ft04_pinjamanangsurantemplist';
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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t04_pinjamanangsurantemp)
		if (!isset($GLOBALS["t04_pinjamanangsurantemp"]) || get_class($GLOBALS["t04_pinjamanangsurantemp"]) == "ct04_pinjamanangsurantemp") {
			$GLOBALS["t04_pinjamanangsurantemp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t04_pinjamanangsurantemp"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t04_pinjamanangsurantempadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t04_pinjamanangsurantempdelete.php";
		$this->MultiUpdateUrl = "t04_pinjamanangsurantempupdate.php";

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS['t03_pinjaman'])) $GLOBALS['t03_pinjaman'] = new ct03_pinjaman();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't04_pinjamanangsurantemp', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft04_pinjamanangsurantemplistsrch";

		// List actions
		$this->ListActions = new cListActions();
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->Angsuran_Ke->SetVisibility();
		$this->Angsuran_Tanggal->SetVisibility();
		$this->Angsuran_Pokok->SetVisibility();
		$this->Angsuran_Bunga->SetVisibility();
		$this->Angsuran_Total->SetVisibility();
		$this->Sisa_Hutang->SetVisibility();
		$this->Tanggal_Bayar->SetVisibility();
		$this->Terlambat->SetVisibility();
		$this->Total_Denda->SetVisibility();
		$this->Bayar_Titipan->SetVisibility();
		$this->Bayar_Non_Titipan->SetVisibility();
		$this->Bayar_Total->SetVisibility();
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

		// Set up master detail parameters
		$this->SetUpMasterParms();

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
		global $EW_EXPORT, $t04_pinjamanangsurantemp;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t04_pinjamanangsurantemp);
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
	var $DisplayRecs = 20;
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

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "t03_pinjaman") {
			global $t03_pinjaman;
			$rsmaster = $t03_pinjaman->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("t03_pinjamanlist.php"); // Return to master page
			} else {
				$t03_pinjaman->LoadListRowValues($rsmaster);
				$t03_pinjaman->RowType = EW_ROWTYPE_MASTER; // Master row
				$t03_pinjaman->RenderListRow();
				$rsmaster->Close();
			}
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

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->Angsuran_Ke); // Angsuran_Ke
			$this->UpdateSort($this->Angsuran_Tanggal); // Angsuran_Tanggal
			$this->UpdateSort($this->Angsuran_Pokok); // Angsuran_Pokok
			$this->UpdateSort($this->Angsuran_Bunga); // Angsuran_Bunga
			$this->UpdateSort($this->Angsuran_Total); // Angsuran_Total
			$this->UpdateSort($this->Sisa_Hutang); // Sisa_Hutang
			$this->UpdateSort($this->Tanggal_Bayar); // Tanggal_Bayar
			$this->UpdateSort($this->Terlambat); // Terlambat
			$this->UpdateSort($this->Total_Denda); // Total_Denda
			$this->UpdateSort($this->Bayar_Titipan); // Bayar_Titipan
			$this->UpdateSort($this->Bayar_Non_Titipan); // Bayar_Non_Titipan
			$this->UpdateSort($this->Bayar_Total); // Bayar_Total
			$this->UpdateSort($this->Keterangan); // Keterangan
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pinjaman_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->Angsuran_Ke->setSort("");
				$this->Angsuran_Tanggal->setSort("");
				$this->Angsuran_Pokok->setSort("");
				$this->Angsuran_Bunga->setSort("");
				$this->Angsuran_Total->setSort("");
				$this->Sisa_Hutang->setSort("");
				$this->Tanggal_Bayar->setSort("");
				$this->Terlambat->setSort("");
				$this->Total_Denda->setSort("");
				$this->Bayar_Titipan->setSort("");
				$this->Bayar_Non_Titipan->setSort("");
				$this->Bayar_Total->setSort("");
				$this->Keterangan->setSort("");
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
		$item->Visible = TRUE;
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

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
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
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft04_pinjamanangsurantemplistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft04_pinjamanangsurantemplistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft04_pinjamanangsurantemplist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->Angsuran_Ke->setDbValue($rs->fields('Angsuran_Ke'));
		$this->Angsuran_Tanggal->setDbValue($rs->fields('Angsuran_Tanggal'));
		$this->Angsuran_Pokok->setDbValue($rs->fields('Angsuran_Pokok'));
		$this->Angsuran_Bunga->setDbValue($rs->fields('Angsuran_Bunga'));
		$this->Angsuran_Total->setDbValue($rs->fields('Angsuran_Total'));
		$this->Sisa_Hutang->setDbValue($rs->fields('Sisa_Hutang'));
		$this->Tanggal_Bayar->setDbValue($rs->fields('Tanggal_Bayar'));
		$this->Terlambat->setDbValue($rs->fields('Terlambat'));
		$this->Total_Denda->setDbValue($rs->fields('Total_Denda'));
		$this->Bayar_Titipan->setDbValue($rs->fields('Bayar_Titipan'));
		$this->Bayar_Non_Titipan->setDbValue($rs->fields('Bayar_Non_Titipan'));
		$this->Bayar_Total->setDbValue($rs->fields('Bayar_Total'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Periode->setDbValue($rs->fields('Periode'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pinjaman_id->DbValue = $row['pinjaman_id'];
		$this->Angsuran_Ke->DbValue = $row['Angsuran_Ke'];
		$this->Angsuran_Tanggal->DbValue = $row['Angsuran_Tanggal'];
		$this->Angsuran_Pokok->DbValue = $row['Angsuran_Pokok'];
		$this->Angsuran_Bunga->DbValue = $row['Angsuran_Bunga'];
		$this->Angsuran_Total->DbValue = $row['Angsuran_Total'];
		$this->Sisa_Hutang->DbValue = $row['Sisa_Hutang'];
		$this->Tanggal_Bayar->DbValue = $row['Tanggal_Bayar'];
		$this->Terlambat->DbValue = $row['Terlambat'];
		$this->Total_Denda->DbValue = $row['Total_Denda'];
		$this->Bayar_Titipan->DbValue = $row['Bayar_Titipan'];
		$this->Bayar_Non_Titipan->DbValue = $row['Bayar_Non_Titipan'];
		$this->Bayar_Total->DbValue = $row['Bayar_Total'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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
		if ($this->Sisa_Hutang->FormValue == $this->Sisa_Hutang->CurrentValue && is_numeric(ew_StrToFloat($this->Sisa_Hutang->CurrentValue)))
			$this->Sisa_Hutang->CurrentValue = ew_StrToFloat($this->Sisa_Hutang->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Total_Denda->FormValue == $this->Total_Denda->CurrentValue && is_numeric(ew_StrToFloat($this->Total_Denda->CurrentValue)))
			$this->Total_Denda->CurrentValue = ew_StrToFloat($this->Total_Denda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Titipan->FormValue == $this->Bayar_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Titipan->CurrentValue)))
			$this->Bayar_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Non_Titipan->FormValue == $this->Bayar_Non_Titipan->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue)))
			$this->Bayar_Non_Titipan->CurrentValue = ew_StrToFloat($this->Bayar_Non_Titipan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bayar_Total->FormValue == $this->Bayar_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Total->CurrentValue)))
			$this->Bayar_Total->CurrentValue = ew_StrToFloat($this->Bayar_Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// pinjaman_id
		// Angsuran_Ke
		// Angsuran_Tanggal
		// Angsuran_Pokok
		// Angsuran_Bunga
		// Angsuran_Total
		// Sisa_Hutang
		// Tanggal_Bayar
		// Terlambat
		// Total_Denda
		// Bayar_Titipan
		// Bayar_Non_Titipan
		// Bayar_Total
		// Keterangan
		// Periode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Angsuran_Ke
		$this->Angsuran_Ke->ViewValue = $this->Angsuran_Ke->CurrentValue;
		$this->Angsuran_Ke->ViewCustomAttributes = "";

		// Angsuran_Tanggal
		$this->Angsuran_Tanggal->ViewValue = $this->Angsuran_Tanggal->CurrentValue;
		$this->Angsuran_Tanggal->ViewValue = ew_FormatDateTime($this->Angsuran_Tanggal->ViewValue, 7);
		$this->Angsuran_Tanggal->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewValue = ew_FormatNumber($this->Angsuran_Pokok->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Pokok->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewValue = ew_FormatNumber($this->Angsuran_Bunga->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Bunga->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewValue = ew_FormatNumber($this->Angsuran_Total->ViewValue, 2, -2, -2, -2);
		$this->Angsuran_Total->CellCssStyle .= "text-align: left;";
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// Sisa_Hutang
		$this->Sisa_Hutang->ViewValue = $this->Sisa_Hutang->CurrentValue;
		$this->Sisa_Hutang->ViewValue = ew_FormatNumber($this->Sisa_Hutang->ViewValue, 2, -2, -2, -2);
		$this->Sisa_Hutang->CellCssStyle .= "text-align: left;";
		$this->Sisa_Hutang->ViewCustomAttributes = "";

		// Tanggal_Bayar
		$this->Tanggal_Bayar->ViewValue = $this->Tanggal_Bayar->CurrentValue;
		$this->Tanggal_Bayar->ViewValue = ew_FormatDateTime($this->Tanggal_Bayar->ViewValue, 7);
		$this->Tanggal_Bayar->ViewCustomAttributes = "";

		// Terlambat
		$this->Terlambat->ViewValue = $this->Terlambat->CurrentValue;
		$this->Terlambat->ViewValue = ew_FormatNumber($this->Terlambat->ViewValue, 0, -2, -2, -2);
		$this->Terlambat->CellCssStyle .= "text-align: right;";
		$this->Terlambat->ViewCustomAttributes = "";

		// Total_Denda
		$this->Total_Denda->ViewValue = $this->Total_Denda->CurrentValue;
		$this->Total_Denda->ViewValue = ew_FormatNumber($this->Total_Denda->ViewValue, 2, -2, -2, -2);
		$this->Total_Denda->CellCssStyle .= "text-align: right;";
		$this->Total_Denda->ViewCustomAttributes = "";

		// Bayar_Titipan
		$this->Bayar_Titipan->ViewValue = $this->Bayar_Titipan->CurrentValue;
		$this->Bayar_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Titipan->ViewCustomAttributes = "";

		// Bayar_Non_Titipan
		$this->Bayar_Non_Titipan->ViewValue = $this->Bayar_Non_Titipan->CurrentValue;
		$this->Bayar_Non_Titipan->ViewValue = ew_FormatNumber($this->Bayar_Non_Titipan->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Non_Titipan->CellCssStyle .= "text-align: right;";
		$this->Bayar_Non_Titipan->ViewCustomAttributes = "";

		// Bayar_Total
		$this->Bayar_Total->ViewValue = $this->Bayar_Total->CurrentValue;
		$this->Bayar_Total->ViewValue = ew_FormatNumber($this->Bayar_Total->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Total->CellCssStyle .= "text-align: right;";
		$this->Bayar_Total->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

			// Angsuran_Ke
			$this->Angsuran_Ke->LinkCustomAttributes = "";
			$this->Angsuran_Ke->HrefValue = "";
			$this->Angsuran_Ke->TooltipValue = "";

			// Angsuran_Tanggal
			$this->Angsuran_Tanggal->LinkCustomAttributes = "";
			$this->Angsuran_Tanggal->HrefValue = "";
			$this->Angsuran_Tanggal->TooltipValue = "";

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

			// Sisa_Hutang
			$this->Sisa_Hutang->LinkCustomAttributes = "";
			$this->Sisa_Hutang->HrefValue = "";
			$this->Sisa_Hutang->TooltipValue = "";

			// Tanggal_Bayar
			$this->Tanggal_Bayar->LinkCustomAttributes = "";
			$this->Tanggal_Bayar->HrefValue = "";
			$this->Tanggal_Bayar->TooltipValue = "";

			// Terlambat
			$this->Terlambat->LinkCustomAttributes = "";
			$this->Terlambat->HrefValue = "";
			$this->Terlambat->TooltipValue = "";

			// Total_Denda
			$this->Total_Denda->LinkCustomAttributes = "";
			$this->Total_Denda->HrefValue = "";
			$this->Total_Denda->TooltipValue = "";

			// Bayar_Titipan
			$this->Bayar_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Titipan->HrefValue = "";
			$this->Bayar_Titipan->TooltipValue = "";

			// Bayar_Non_Titipan
			$this->Bayar_Non_Titipan->LinkCustomAttributes = "";
			$this->Bayar_Non_Titipan->HrefValue = "";
			$this->Bayar_Non_Titipan->TooltipValue = "";

			// Bayar_Total
			$this->Bayar_Total->LinkCustomAttributes = "";
			$this->Bayar_Total->HrefValue = "";
			$this->Bayar_Total->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->pinjaman_id->setQueryStringValue($GLOBALS["t03_pinjaman"]->id->QueryStringValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_pinjaman") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t03_pinjaman"]->id->setFormValue($_POST["fk_id"]);
					$this->pinjaman_id->setFormValue($GLOBALS["t03_pinjaman"]->id->FormValue);
					$this->pinjaman_id->setSessionValue($this->pinjaman_id->FormValue);
					if (!is_numeric($GLOBALS["t03_pinjaman"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t03_pinjaman") {
				if ($this->pinjaman_id->CurrentValue == "") $this->pinjaman_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
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

		$this->ListOptions->Items["edit"]->Body = "";
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
if (!isset($t04_pinjamanangsurantemp_list)) $t04_pinjamanangsurantemp_list = new ct04_pinjamanangsurantemp_list();

// Page init
$t04_pinjamanangsurantemp_list->Page_Init();

// Page main
$t04_pinjamanangsurantemp_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_pinjamanangsurantemp_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft04_pinjamanangsurantemplist = new ew_Form("ft04_pinjamanangsurantemplist", "list");
ft04_pinjamanangsurantemplist.FormKeyCountName = '<?php echo $t04_pinjamanangsurantemp_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft04_pinjamanangsurantemplist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_pinjamanangsurantemplist.ValidateRequired = true;
<?php } else { ?>
ft04_pinjamanangsurantemplist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($t04_pinjamanangsurantemp_list->TotalRecs > 0 && $t04_pinjamanangsurantemp_list->ExportOptions->Visible()) { ?>
<?php $t04_pinjamanangsurantemp_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php if (($t04_pinjamanangsurantemp->Export == "") || (EW_EXPORT_MASTER_RECORD && $t04_pinjamanangsurantemp->Export == "print")) { ?>
<?php
if ($t04_pinjamanangsurantemp_list->DbMasterFilter <> "" && $t04_pinjamanangsurantemp->getCurrentMasterTable() == "t03_pinjaman") {
	if ($t04_pinjamanangsurantemp_list->MasterRecordExists) {
?>
<?php include_once "t03_pinjamanmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $t04_pinjamanangsurantemp_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t04_pinjamanangsurantemp_list->TotalRecs <= 0)
			$t04_pinjamanangsurantemp_list->TotalRecs = $t04_pinjamanangsurantemp->SelectRecordCount();
	} else {
		if (!$t04_pinjamanangsurantemp_list->Recordset && ($t04_pinjamanangsurantemp_list->Recordset = $t04_pinjamanangsurantemp_list->LoadRecordset()))
			$t04_pinjamanangsurantemp_list->TotalRecs = $t04_pinjamanangsurantemp_list->Recordset->RecordCount();
	}
	$t04_pinjamanangsurantemp_list->StartRec = 1;
	if ($t04_pinjamanangsurantemp_list->DisplayRecs <= 0 || ($t04_pinjamanangsurantemp->Export <> "" && $t04_pinjamanangsurantemp->ExportAll)) // Display all records
		$t04_pinjamanangsurantemp_list->DisplayRecs = $t04_pinjamanangsurantemp_list->TotalRecs;
	if (!($t04_pinjamanangsurantemp->Export <> "" && $t04_pinjamanangsurantemp->ExportAll))
		$t04_pinjamanangsurantemp_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t04_pinjamanangsurantemp_list->Recordset = $t04_pinjamanangsurantemp_list->LoadRecordset($t04_pinjamanangsurantemp_list->StartRec-1, $t04_pinjamanangsurantemp_list->DisplayRecs);

	// Set no record found message
	if ($t04_pinjamanangsurantemp->CurrentAction == "" && $t04_pinjamanangsurantemp_list->TotalRecs == 0) {
		if ($t04_pinjamanangsurantemp_list->SearchWhere == "0=101")
			$t04_pinjamanangsurantemp_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t04_pinjamanangsurantemp_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t04_pinjamanangsurantemp_list->RenderOtherOptions();
?>
<?php $t04_pinjamanangsurantemp_list->ShowPageHeader(); ?>
<?php
$t04_pinjamanangsurantemp_list->ShowMessage();
?>
<?php if ($t04_pinjamanangsurantemp_list->TotalRecs > 0 || $t04_pinjamanangsurantemp->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t04_pinjamanangsurantemp">
<form name="ft04_pinjamanangsurantemplist" id="ft04_pinjamanangsurantemplist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t04_pinjamanangsurantemp_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t04_pinjamanangsurantemp_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t04_pinjamanangsurantemp">
<?php if ($t04_pinjamanangsurantemp->getCurrentMasterTable() == "t03_pinjaman" && $t04_pinjamanangsurantemp->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_pinjaman">
<input type="hidden" name="fk_id" value="<?php echo $t04_pinjamanangsurantemp->pinjaman_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_t04_pinjamanangsurantemp" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t04_pinjamanangsurantemp_list->TotalRecs > 0 || $t04_pinjamanangsurantemp->CurrentAction == "gridedit") { ?>
<table id="tbl_t04_pinjamanangsurantemplist" class="table ewTable">
<?php echo $t04_pinjamanangsurantemp->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t04_pinjamanangsurantemp_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t04_pinjamanangsurantemp_list->RenderListOptions();

// Render list options (header, left)
$t04_pinjamanangsurantemp_list->ListOptions->Render("header", "left");
?>
<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Ke) == "") { ?>
		<th data-name="Angsuran_Ke"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Ke"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Ke) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Ke->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Tanggal) == "") { ?>
		<th data-name="Angsuran_Tanggal"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Tanggal"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Tanggal) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Pokok) == "") { ?>
		<th data-name="Angsuran_Pokok"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Pokok"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Pokok) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Pokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Bunga) == "") { ?>
		<th data-name="Angsuran_Bunga"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Bunga"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Bunga) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Total) == "") { ?>
		<th data-name="Angsuran_Total"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Angsuran_Total"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Angsuran_Total) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Angsuran_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Angsuran_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Angsuran_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Sisa_Hutang) == "") { ?>
		<th data-name="Sisa_Hutang"><div id="elh_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sisa_Hutang"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Sisa_Hutang) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Sisa_Hutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Tanggal_Bayar) == "") { ?>
		<th data-name="Tanggal_Bayar"><div id="elh_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tanggal_Bayar"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Tanggal_Bayar) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Tanggal_Bayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Terlambat) == "") { ?>
		<th data-name="Terlambat"><div id="elh_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Terlambat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terlambat"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Terlambat) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Terlambat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Terlambat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Terlambat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Total_Denda) == "") { ?>
		<th data-name="Total_Denda"><div id="elh_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Total_Denda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Total_Denda"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Total_Denda) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Total_Denda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Total_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Total_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Titipan) == "") { ?>
		<th data-name="Bayar_Titipan"><div id="elh_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Titipan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Titipan) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Non_Titipan) == "") { ?>
		<th data-name="Bayar_Non_Titipan"><div id="elh_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Non_Titipan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Non_Titipan) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Total) == "") { ?>
		<th data-name="Bayar_Total"><div id="elh_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Total"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Bayar_Total) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Bayar_Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Bayar_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Bayar_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t04_pinjamanangsurantemp->SortUrl($t04_pinjamanangsurantemp->Keterangan) ?>',1);"><div id="elh_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t04_pinjamanangsurantemp->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t04_pinjamanangsurantemp->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t04_pinjamanangsurantemp->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t04_pinjamanangsurantemp_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t04_pinjamanangsurantemp->ExportAll && $t04_pinjamanangsurantemp->Export <> "") {
	$t04_pinjamanangsurantemp_list->StopRec = $t04_pinjamanangsurantemp_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t04_pinjamanangsurantemp_list->TotalRecs > $t04_pinjamanangsurantemp_list->StartRec + $t04_pinjamanangsurantemp_list->DisplayRecs - 1)
		$t04_pinjamanangsurantemp_list->StopRec = $t04_pinjamanangsurantemp_list->StartRec + $t04_pinjamanangsurantemp_list->DisplayRecs - 1;
	else
		$t04_pinjamanangsurantemp_list->StopRec = $t04_pinjamanangsurantemp_list->TotalRecs;
}
$t04_pinjamanangsurantemp_list->RecCnt = $t04_pinjamanangsurantemp_list->StartRec - 1;
if ($t04_pinjamanangsurantemp_list->Recordset && !$t04_pinjamanangsurantemp_list->Recordset->EOF) {
	$t04_pinjamanangsurantemp_list->Recordset->MoveFirst();
	$bSelectLimit = $t04_pinjamanangsurantemp_list->UseSelectLimit;
	if (!$bSelectLimit && $t04_pinjamanangsurantemp_list->StartRec > 1)
		$t04_pinjamanangsurantemp_list->Recordset->Move($t04_pinjamanangsurantemp_list->StartRec - 1);
} elseif (!$t04_pinjamanangsurantemp->AllowAddDeleteRow && $t04_pinjamanangsurantemp_list->StopRec == 0) {
	$t04_pinjamanangsurantemp_list->StopRec = $t04_pinjamanangsurantemp->GridAddRowCount;
}

// Initialize aggregate
$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t04_pinjamanangsurantemp->ResetAttrs();
$t04_pinjamanangsurantemp_list->RenderRow();
while ($t04_pinjamanangsurantemp_list->RecCnt < $t04_pinjamanangsurantemp_list->StopRec) {
	$t04_pinjamanangsurantemp_list->RecCnt++;
	if (intval($t04_pinjamanangsurantemp_list->RecCnt) >= intval($t04_pinjamanangsurantemp_list->StartRec)) {
		$t04_pinjamanangsurantemp_list->RowCnt++;

		// Set up key count
		$t04_pinjamanangsurantemp_list->KeyCount = $t04_pinjamanangsurantemp_list->RowIndex;

		// Init row class and style
		$t04_pinjamanangsurantemp->ResetAttrs();
		$t04_pinjamanangsurantemp->CssClass = "";
		if ($t04_pinjamanangsurantemp->CurrentAction == "gridadd") {
		} else {
			$t04_pinjamanangsurantemp_list->LoadRowValues($t04_pinjamanangsurantemp_list->Recordset); // Load row values
		}
		$t04_pinjamanangsurantemp->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t04_pinjamanangsurantemp->RowAttrs = array_merge($t04_pinjamanangsurantemp->RowAttrs, array('data-rowindex'=>$t04_pinjamanangsurantemp_list->RowCnt, 'id'=>'r' . $t04_pinjamanangsurantemp_list->RowCnt . '_t04_pinjamanangsurantemp', 'data-rowtype'=>$t04_pinjamanangsurantemp->RowType));

		// Render row
		$t04_pinjamanangsurantemp_list->RenderRow();

		// Render list options
		$t04_pinjamanangsurantemp_list->RenderListOptions();
?>
	<tr<?php echo $t04_pinjamanangsurantemp->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t04_pinjamanangsurantemp_list->ListOptions->Render("body", "left", $t04_pinjamanangsurantemp_list->RowCnt);
?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Ke->Visible) { // Angsuran_Ke ?>
		<td data-name="Angsuran_Ke"<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Ke" class="t04_pinjamanangsurantemp_Angsuran_Ke">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Ke->ListViewValue() ?></span>
</span>
<a id="<?php echo $t04_pinjamanangsurantemp_list->PageObjName . "_row_" . $t04_pinjamanangsurantemp_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Tanggal->Visible) { // Angsuran_Tanggal ?>
		<td data-name="Angsuran_Tanggal"<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Tanggal" class="t04_pinjamanangsurantemp_Angsuran_Tanggal">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Tanggal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<td data-name="Angsuran_Pokok"<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Pokok" class="t04_pinjamanangsurantemp_Angsuran_Pokok">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Pokok->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<td data-name="Angsuran_Bunga"<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Bunga" class="t04_pinjamanangsurantemp_Angsuran_Bunga">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Bunga->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<td data-name="Angsuran_Total"<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Angsuran_Total" class="t04_pinjamanangsurantemp_Angsuran_Total">
<span<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Angsuran_Total->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Sisa_Hutang->Visible) { // Sisa_Hutang ?>
		<td data-name="Sisa_Hutang"<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Sisa_Hutang" class="t04_pinjamanangsurantemp_Sisa_Hutang">
<span<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Sisa_Hutang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
		<td data-name="Tanggal_Bayar"<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Tanggal_Bayar" class="t04_pinjamanangsurantemp_Tanggal_Bayar">
<span<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Tanggal_Bayar->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Terlambat->Visible) { // Terlambat ?>
		<td data-name="Terlambat"<?php echo $t04_pinjamanangsurantemp->Terlambat->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Terlambat" class="t04_pinjamanangsurantemp_Terlambat">
<span<?php echo $t04_pinjamanangsurantemp->Terlambat->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Terlambat->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Total_Denda->Visible) { // Total_Denda ?>
		<td data-name="Total_Denda"<?php echo $t04_pinjamanangsurantemp->Total_Denda->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Total_Denda" class="t04_pinjamanangsurantemp_Total_Denda">
<span<?php echo $t04_pinjamanangsurantemp->Total_Denda->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Total_Denda->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Titipan->Visible) { // Bayar_Titipan ?>
		<td data-name="Bayar_Titipan"<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Titipan" class="t04_pinjamanangsurantemp_Bayar_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Titipan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Non_Titipan->Visible) { // Bayar_Non_Titipan ?>
		<td data-name="Bayar_Non_Titipan"<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Non_Titipan" class="t04_pinjamanangsurantemp_Bayar_Non_Titipan">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Non_Titipan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Bayar_Total->Visible) { // Bayar_Total ?>
		<td data-name="Bayar_Total"<?php echo $t04_pinjamanangsurantemp->Bayar_Total->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Bayar_Total" class="t04_pinjamanangsurantemp_Bayar_Total">
<span<?php echo $t04_pinjamanangsurantemp->Bayar_Total->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Bayar_Total->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t04_pinjamanangsurantemp->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t04_pinjamanangsurantemp->Keterangan->CellAttributes() ?>>
<span id="el<?php echo $t04_pinjamanangsurantemp_list->RowCnt ?>_t04_pinjamanangsurantemp_Keterangan" class="t04_pinjamanangsurantemp_Keterangan">
<span<?php echo $t04_pinjamanangsurantemp->Keterangan->ViewAttributes() ?>>
<?php echo $t04_pinjamanangsurantemp->Keterangan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t04_pinjamanangsurantemp_list->ListOptions->Render("body", "right", $t04_pinjamanangsurantemp_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($t04_pinjamanangsurantemp->CurrentAction <> "gridadd")
		$t04_pinjamanangsurantemp_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t04_pinjamanangsurantemp_list->Recordset)
	$t04_pinjamanangsurantemp_list->Recordset->Close();
?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($t04_pinjamanangsurantemp->CurrentAction <> "gridadd" && $t04_pinjamanangsurantemp->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t04_pinjamanangsurantemp_list->Pager)) $t04_pinjamanangsurantemp_list->Pager = new cPrevNextPager($t04_pinjamanangsurantemp_list->StartRec, $t04_pinjamanangsurantemp_list->DisplayRecs, $t04_pinjamanangsurantemp_list->TotalRecs) ?>
<?php if ($t04_pinjamanangsurantemp_list->Pager->RecordCount > 0 && $t04_pinjamanangsurantemp_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t04_pinjamanangsurantemp_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t04_pinjamanangsurantemp_list->PageUrl() ?>start=<?php echo $t04_pinjamanangsurantemp_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t04_pinjamanangsurantemp_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t04_pinjamanangsurantemp_list->PageUrl() ?>start=<?php echo $t04_pinjamanangsurantemp_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t04_pinjamanangsurantemp_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t04_pinjamanangsurantemp_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t04_pinjamanangsurantemp_list->PageUrl() ?>start=<?php echo $t04_pinjamanangsurantemp_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t04_pinjamanangsurantemp_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t04_pinjamanangsurantemp_list->PageUrl() ?>start=<?php echo $t04_pinjamanangsurantemp_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t04_pinjamanangsurantemp_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t04_pinjamanangsurantemp_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t04_pinjamanangsurantemp_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t04_pinjamanangsurantemp_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_pinjamanangsurantemp_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($t04_pinjamanangsurantemp_list->TotalRecs == 0 && $t04_pinjamanangsurantemp->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t04_pinjamanangsurantemp_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft04_pinjamanangsurantemplist.Init();
</script>
<?php
$t04_pinjamanangsurantemp_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t04_pinjamanangsurantemp_list->Page_Terminate();
?>
