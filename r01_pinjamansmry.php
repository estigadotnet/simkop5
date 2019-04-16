<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg10.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "phprptinc/ewrfn10.php" ?>
<?php include_once "phprptinc/ewrusrfn10.php" ?>
<?php include_once "r01_pinjamansmryinfo.php" ?>
<?php

//
// Page class
//

$r01_pinjaman_summary = NULL; // Initialize page object first

class crr01_pinjaman_summary extends crr01_pinjaman {

	// Page ID
	var $PageID = 'summary';

	// Project ID
	var $ProjectID = "{34C67914-04B8-4CBF-A6F8-355DA216289E}";

	// Page object name
	var $PageObjName = 'r01_pinjaman_summary';

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportPdfUrl;
	var $ReportTableClass;
	var $ReportTableStyle = "";

	// Custom export
	var $ExportPrintCustom = FALSE;
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog ewDisplayTable\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") // Header exists, display
			echo $sHeader;
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") // Fotoer exists, display
			echo $sFooter;
	}

	// Validate page request
	function IsPageRequest() {
		if ($this->UseTokenInUrl) {
			if (ewr_IsHttpPost())
				return ($this->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EWR_CHECK_TOKEN;
	var $CheckTokenFn = "ewr_CheckToken";
	var $CreateTokenFn = "ewr_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ewr_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EWR_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EWR_TOKEN_NAME]);
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
		global $conn, $ReportLanguage;
		global $UserTable, $UserTableConn;

		// Language object
		$ReportLanguage = new crLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (r01_pinjaman)
		if (!isset($GLOBALS["r01_pinjaman"])) {
			$GLOBALS["r01_pinjaman"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["r01_pinjaman"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'r01_pinjaman', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		if (!isset($conn)) $conn = ewr_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new crt96_employees();
			$UserTableConn = ReportConn($UserTable->DBID);
		}

		// Export options
		$this->ExportOptions = new crListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Search options
		$this->SearchOptions = new crListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Filter options
		$this->FilterOptions = new crListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fr01_pinjamansummary";

		// Generate report options
		$this->GenerateOptions = new crListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ewGenerateOption";
	}

	//
	// Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gsEmailContentType, $ReportLanguage, $Security;
		global $gsCustomExport;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . 'r01_pinjaman');
		$Security->TablePermission_Loaded();
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($ReportLanguage->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("index.php"));
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$Security->SaveLastUrl();
			$this->setFailureMessage($ReportLanguage->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("login.php"));
		}

		// Get export parameters
		if (@$_GET["export"] <> "")
			$this->Export = strtolower($_GET["export"]);
		elseif (@$_POST["export"] <> "")
			$this->Export = strtolower($_POST["export"]);
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$gsEmailContentType = @$_POST["contenttype"]; // Get email content type

		// Setup placeholder
		$this->Kontrak_No->PlaceHolder = $this->Kontrak_No->FldCaption();
		$this->Kontrak_Tgl->PlaceHolder = $this->Kontrak_Tgl->FldCaption();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $ReportLanguage->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Security, $ReportLanguage, $ReportOptions;
		$exportid = session_id();
		$ReportTypes = array();

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["print"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["excel"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->Phrase("ExportToWord") . "</a>";

		//$item->Visible = TRUE;
		$item->Visible = TRUE;
		$ReportTypes["word"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Uncomment codes below to show export to Pdf link
//		$item->Visible = TRUE;

		$ReportTypes["pdf"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = $this->PageUrl() . "export=email";
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_r01_pinjaman\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_r01_pinjaman',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["email"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormEmail") : "";
		$ReportOptions["ReportTypes"] = $ReportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fr01_pinjamansummary\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fr01_pinjamansummary\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up options (extended)
		$this->SetupExportOptionsExt();

		// Hide options for export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}

		// Set up table class
		if ($this->Export == "word" || $this->Export == "excel" || $this->Export == "pdf")
			$this->ReportTableClass = "ewTable";
		else
			$this->ReportTableClass = "table ewTable";
	}

	// Set up search options
	function SetupSearchOptions() {
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fr01_pinjamansummary\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Reset filter
		$item = &$this->SearchOptions->Add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . ewr_CurrentPage() . "?cmd=reset'\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</button>";
		$item->Visible = TRUE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->SearchOptions->HideAllOptions();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $ReportLanguage, $EWR_EXPORT, $gsExportFile;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EWR_EXPORT)) {
			$sContent = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $sContent, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$sContent = str_replace($divmatch[0], '', $sContent);
				}
			}
			$fn = $EWR_EXPORT[$this->Export];
			if ($this->Export == "email") { // Email
				if (@$this->GenOptions["reporttype"] == "email") {
					$saveResponse = $this->$fn($sContent, $this->GenOptions);
					$this->WriteGenResponse($saveResponse);
				} else {
					echo $this->$fn($sContent, array());
				}
				$url = ""; // Avoid redirect
			} else {
				$saveToFile = $this->$fn($sContent, $this->GenOptions);
				if (@$this->GenOptions["reporttype"] <> "") {
					$saveUrl = ($saveToFile <> "") ? ewr_ConvertFullUrl($saveToFile) : $ReportLanguage->Phrase("GenerateSuccess");
					$this->WriteGenResponse($saveUrl);
					$url = ""; // Avoid redirect
				}
			}
		}

		 // Close connection
		ewr_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $FilterOptions; // Filter options

	// Paging variables
	var $RecIndex = 0; // Record index
	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $GrpCounter = array(); // Group counter
	var $DisplayGrps = 100; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $PageFirstGroupFilter = "";
	var $UserIDFilter = "";
	var $DrillDown = FALSE;
	var $DrillDownInPanel = FALSE;
	var $DrillDownList = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $PopupName = "";
	var $PopupValue = "";
	var $FilterApplied;
	var $SearchCommand = FALSE;
	var $ShowHeader;
	var $GrpColumnCount = 0;
	var $SubGrpColumnCount = 0;
	var $DtlColumnCount = 0;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandCnt, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;
	var $GrandSummarySetup = FALSE;
	var $GrpIdx;
	var $DetailRows = array();

	//
	// Page main
	//
	function Page_Main() {
		global $rs;
		global $rsgrp;
		global $Security;
		global $gsFormError;
		global $gbDrillDownInPanel;
		global $ReportBreadcrumb;
		global $ReportLanguage;

		// Set field visibility for detail fields
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->NamaNasabah->SetVisibility();
		$this->NamaJaminan->SetVisibility();
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
		$this->NamaMarketing->SetVisibility();
		$this->Periode->SetVisibility();
		$this->Macet->SetVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 19;
		$nGrps = 1;
		$this->Val = &ewr_InitArray($nDtls, 0);
		$this->Cnt = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandCnt = &ewr_InitArray($nDtls, 0);
		$this->GrandSmry = &ewr_InitArray($nDtls, 0);
		$this->GrandMn = &ewr_InitArray($nDtls, NULL);
		$this->GrandMx = &ewr_InitArray($nDtls, NULL);

		// Set up array if accumulation required: array(Accum, SkipNullOrZero)
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(TRUE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (@$_GET["cmd"] == "search");

		// Load default filter values
		$this->LoadDefaultFilters();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->SetupPopup();

		// Load group db values if necessary
		$this->LoadGroupDbValues();

		// Handle Ajax popup
		$this->ProcessAjaxPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Restore filter list
		$this->RestoreFilterList();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		ewr_AddFilter($this->Filter, $sExtendedFilter);

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->SetupSearchOptions();

		// Get sort
		$this->Sort = $this->GetSort($this->GenOptions);

		// Get total count
		$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0 || $this->DrillDown) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGrps > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->Export <> "")
			$this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup($this->GenOptions);

		// Set no record found message
		if ($this->TotalGrps == 0) {
			if ($Security->CanList()) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->Phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->Phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage($ReportLanguage->Phrase("NoPermission"));
			}
		}

		// Hide export options if export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();

		// Hide search/filter options if export/drilldown
		if ($this->Export <> "" || $this->DrillDown) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
			$this->GenerateOptions->HideAllOptions();
		}

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
		$this->SetupFieldCount();
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Col[$iy][0]) { // Accumulate required
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk)) {
						if (!$this->Col[$iy][1])
							$this->Cnt[$ix][$iy]++;
					} else {
						$accum = (!$this->Col[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Cnt[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Smry[$ix][$iy] += $valwrk;
								if (is_null($this->Mn[$ix][$iy])) {
									$this->Mn[$ix][$iy] = $valwrk;
									$this->Mx[$ix][$iy] = $valwrk;
								} else {
									if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
									if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy][0]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->TotCount++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy][0]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {
					if (!$this->Col[$iy][1])
						$this->GrandCnt[$iy]++;
				} else {
					if (!$this->Col[$iy][1] || $valwrk <> 0) {
						$this->GrandCnt[$iy]++;
						$this->GrandSmry[$iy] += $valwrk;
						if (is_null($this->GrandMn[$iy])) {
							$this->GrandMn[$iy] = $valwrk;
							$this->GrandMx[$iy] = $valwrk;
						} else {
							if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
							if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		$conn = &$this->Connection();
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get recordset
	function GetRs($wrksql, $start, $grps) {
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EWR_ERROR_FN"];
		$rswrk = $conn->SelectLimit($wrksql, $grps, $start - 1);
		$conn->raiseErrorFn = '';
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row
				$this->FirstRowData = array();
				$this->FirstRowData['id'] = ewr_Conv($rs->fields('id'), 3);
				$this->FirstRowData['Kontrak_No'] = ewr_Conv($rs->fields('Kontrak_No'), 200);
				$this->FirstRowData['Kontrak_Tgl'] = ewr_Conv($rs->fields('Kontrak_Tgl'), 133);
				$this->FirstRowData['nasabah_id'] = ewr_Conv($rs->fields('nasabah_id'), 3);
				$this->FirstRowData['NamaNasabah'] = ewr_Conv($rs->fields('NamaNasabah'), 200);
				$this->FirstRowData['jaminan_id'] = ewr_Conv($rs->fields('jaminan_id'), 200);
				$this->FirstRowData['Pinjaman'] = ewr_Conv($rs->fields('Pinjaman'), 4);
				$this->FirstRowData['Angsuran_Lama'] = ewr_Conv($rs->fields('Angsuran_Lama'), 16);
				$this->FirstRowData['Angsuran_Bunga_Prosen'] = ewr_Conv($rs->fields('Angsuran_Bunga_Prosen'), 131);
				$this->FirstRowData['Angsuran_Denda'] = ewr_Conv($rs->fields('Angsuran_Denda'), 131);
				$this->FirstRowData['Dispensasi_Denda'] = ewr_Conv($rs->fields('Dispensasi_Denda'), 16);
				$this->FirstRowData['Angsuran_Pokok'] = ewr_Conv($rs->fields('Angsuran_Pokok'), 4);
				$this->FirstRowData['Angsuran_Bunga'] = ewr_Conv($rs->fields('Angsuran_Bunga'), 4);
				$this->FirstRowData['Angsuran_Total'] = ewr_Conv($rs->fields('Angsuran_Total'), 4);
				$this->FirstRowData['No_Ref'] = ewr_Conv($rs->fields('No_Ref'), 200);
				$this->FirstRowData['Biaya_Administrasi'] = ewr_Conv($rs->fields('Biaya_Administrasi'), 4);
				$this->FirstRowData['Biaya_Materai'] = ewr_Conv($rs->fields('Biaya_Materai'), 4);
				$this->FirstRowData['marketing_id'] = ewr_Conv($rs->fields('marketing_id'), 3);
				$this->FirstRowData['NamaMarketing'] = ewr_Conv($rs->fields('NamaMarketing'), 200);
				$this->FirstRowData['Periode'] = ewr_Conv($rs->fields('Periode'), 200);
				$this->FirstRowData['Macet'] = ewr_Conv($rs->fields('Macet'), 202);
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$this->id->setDbValue($rs->fields('id'));
			$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
			$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
			$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
			$this->NamaNasabah->setDbValue($rs->fields('NamaNasabah'));
			$this->jaminan_id->setDbValue($rs->fields('jaminan_id'));
			$this->NamaJaminan->setDbValue($rs->fields('NamaJaminan'));
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
			$this->NamaMarketing->setDbValue($rs->fields('NamaMarketing'));
			$this->Periode->setDbValue($rs->fields('Periode'));
			$this->Macet->setDbValue($rs->fields('Macet'));
			$this->Val[1] = $this->Kontrak_No->CurrentValue;
			$this->Val[2] = $this->Kontrak_Tgl->CurrentValue;
			$this->Val[3] = $this->NamaNasabah->CurrentValue;
			$this->Val[4] = $this->NamaJaminan->CurrentValue;
			$this->Val[5] = $this->Pinjaman->CurrentValue;
			$this->Val[6] = $this->Angsuran_Lama->CurrentValue;
			$this->Val[7] = $this->Angsuran_Bunga_Prosen->CurrentValue;
			$this->Val[8] = $this->Angsuran_Denda->CurrentValue;
			$this->Val[9] = $this->Dispensasi_Denda->CurrentValue;
			$this->Val[10] = $this->Angsuran_Pokok->CurrentValue;
			$this->Val[11] = $this->Angsuran_Bunga->CurrentValue;
			$this->Val[12] = $this->Angsuran_Total->CurrentValue;
			$this->Val[13] = $this->No_Ref->CurrentValue;
			$this->Val[14] = $this->Biaya_Administrasi->CurrentValue;
			$this->Val[15] = $this->Biaya_Materai->CurrentValue;
			$this->Val[16] = $this->NamaMarketing->CurrentValue;
			$this->Val[17] = $this->Periode->CurrentValue;
			$this->Val[18] = $this->Macet->CurrentValue;
		} else {
			$this->id->setDbValue("");
			$this->Kontrak_No->setDbValue("");
			$this->Kontrak_Tgl->setDbValue("");
			$this->nasabah_id->setDbValue("");
			$this->NamaNasabah->setDbValue("");
			$this->jaminan_id->setDbValue("");
			$this->NamaJaminan->setDbValue("");
			$this->Pinjaman->setDbValue("");
			$this->Angsuran_Lama->setDbValue("");
			$this->Angsuran_Bunga_Prosen->setDbValue("");
			$this->Angsuran_Denda->setDbValue("");
			$this->Dispensasi_Denda->setDbValue("");
			$this->Angsuran_Pokok->setDbValue("");
			$this->Angsuran_Bunga->setDbValue("");
			$this->Angsuran_Total->setDbValue("");
			$this->No_Ref->setDbValue("");
			$this->Biaya_Administrasi->setDbValue("");
			$this->Biaya_Materai->setDbValue("");
			$this->marketing_id->setDbValue("");
			$this->NamaMarketing->setDbValue("");
			$this->Periode->setDbValue("");
			$this->Macet->setDbValue("");
		}
	}

	// Set up starting group
	function SetUpStartGroup($options = array()) {

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;
		$startGrp = (@$options["start"] <> "") ? $options["start"] : @$_GET[EWR_TABLE_START_GROUP];
		$pageNo = (@$options["pageno"] <> "") ? $options["pageno"] : @$_GET["pageno"];

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGrp = $startGrp;
			$this->setStartGroup($this->StartGrp);
		} elseif ($pageNo != "") {
			$nPageNo = $pageNo;
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$this->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $this->getStartGroup();
			}
		} else {
			$this->StartGrp = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$this->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$this->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$this->setStartGroup($this->StartGrp);
		}
	}

	// Load group db values if necessary
	function LoadGroupDbValues() {
		$conn = &$this->Connection();
	}

	// Process Ajax popup
	function ProcessAjaxPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		$fld = NULL;
		if (@$_GET["popup"] <> "") {
			$popupname = $_GET["popup"];

			// Check popup name
			// Output data as Json

			if (!is_null($fld)) {
				$jsdb = ewr_GetJsDb($fld, $fld->FldType);
				if (ob_get_length())
					ob_end_clean();
				echo $jsdb;
				exit();
			}
		}
	}

	// Set up popup
	function SetupPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (ewr_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewr_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWR_INIT_VALUE;
					$this->PopupName = $sName;
					if (ewr_IsAdvancedFilterValue($arValues) || $arValues == EWR_INIT_VALUE)
						$this->PopupValue = $arValues;
					if (!ewr_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewr_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewr_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$this->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		$sWrk = @$_GET[EWR_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // Display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 100; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$this->setStartGroup($this->StartGrp);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGrps = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 100; // Load default
			}
		}
	}

	// Render row
	function RenderRow() {
		global $rs, $Security, $ReportLanguage;
		$conn = &$this->Connection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$bGotCount = FALSE;
			$bGotSummary = FALSE;

			// Get total count from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
				$bGotCount = TRUE;
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectAgg(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$sSql = $this->getSqlAggPfx() . $sSql . $this->getSqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandCnt[1] = $this->TotCount;
				$this->GrandCnt[2] = $this->TotCount;
				$this->GrandCnt[3] = $this->TotCount;
				$this->GrandCnt[4] = $this->TotCount;
				$this->GrandCnt[5] = $this->TotCount;
				$this->GrandSmry[5] = $rsagg->fields("sum_pinjaman");
				$this->GrandCnt[6] = $this->TotCount;
				$this->GrandCnt[7] = $this->TotCount;
				$this->GrandCnt[8] = $this->TotCount;
				$this->GrandCnt[9] = $this->TotCount;
				$this->GrandCnt[10] = $this->TotCount;
				$this->GrandCnt[11] = $this->TotCount;
				$this->GrandCnt[12] = $this->TotCount;
				$this->GrandCnt[13] = $this->TotCount;
				$this->GrandCnt[14] = $this->TotCount;
				$this->GrandCnt[15] = $this->TotCount;
				$this->GrandCnt[16] = $this->TotCount;
				$this->GrandCnt[17] = $this->TotCount;
				$this->GrandCnt[18] = $this->TotCount;
				$rsagg->Close();
				$bGotSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$bGotCount || !$bGotSummary) {
				$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		//
		// Render view codes
		//

		if ($this->RowType == EWR_ROWTYPE_TOTAL && !($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER)) { // Summary row
			ewr_PrependClass($this->RowAttrs["class"], ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel); // Set up row class

			// Pinjaman
			$this->Pinjaman->SumViewValue = $this->Pinjaman->SumValue;
			$this->Pinjaman->SumViewValue = ewr_FormatNumber($this->Pinjaman->SumViewValue, 2, -2, -2, -2);
			$this->Pinjaman->CellAttrs["style"] = "text-align:right;";
			$this->Pinjaman->CellAttrs["class"] = ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel;

			// Kontrak_No
			$this->Kontrak_No->HrefValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->HrefValue = "";

			// NamaNasabah
			$this->NamaNasabah->HrefValue = "";

			// NamaJaminan
			$this->NamaJaminan->HrefValue = "";

			// Pinjaman
			$this->Pinjaman->HrefValue = "";

			// Angsuran_Lama
			$this->Angsuran_Lama->HrefValue = "";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->HrefValue = "";

			// Angsuran_Denda
			$this->Angsuran_Denda->HrefValue = "";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->HrefValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->HrefValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->HrefValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->HrefValue = "";

			// No_Ref
			$this->No_Ref->HrefValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->HrefValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->HrefValue = "";

			// NamaMarketing
			$this->NamaMarketing->HrefValue = "";

			// Periode
			$this->Periode->HrefValue = "";

			// Macet
			$this->Macet->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			} else {
			}

			// Kontrak_No
			$this->Kontrak_No->ViewValue = $this->Kontrak_No->CurrentValue;
			$this->Kontrak_No->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->ViewValue = $this->Kontrak_Tgl->CurrentValue;
			$this->Kontrak_Tgl->ViewValue = ewr_FormatDateTime($this->Kontrak_Tgl->ViewValue, 7);
			$this->Kontrak_Tgl->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NamaNasabah
			$this->NamaNasabah->ViewValue = $this->NamaNasabah->CurrentValue;
			$this->NamaNasabah->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NamaJaminan
			$this->NamaJaminan->ViewValue = $this->NamaJaminan->CurrentValue;
			$this->NamaJaminan->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Pinjaman
			$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
			$this->Pinjaman->ViewValue = ewr_FormatNumber($this->Pinjaman->ViewValue, 2, -2, -2, -2);
			$this->Pinjaman->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Pinjaman->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Lama
			$this->Angsuran_Lama->ViewValue = $this->Angsuran_Lama->CurrentValue;
			$this->Angsuran_Lama->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Lama->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->ViewValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
			$this->Angsuran_Bunga_Prosen->ViewValue = ewr_FormatNumber($this->Angsuran_Bunga_Prosen->ViewValue, 2, -2, -2, -2);
			$this->Angsuran_Bunga_Prosen->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Bunga_Prosen->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Denda
			$this->Angsuran_Denda->ViewValue = $this->Angsuran_Denda->CurrentValue;
			$this->Angsuran_Denda->ViewValue = ewr_FormatNumber($this->Angsuran_Denda->ViewValue, 2, -2, -2, -2);
			$this->Angsuran_Denda->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Denda->CellAttrs["style"] = "text-align:right;";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->ViewValue = $this->Dispensasi_Denda->CurrentValue;
			$this->Dispensasi_Denda->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Dispensasi_Denda->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
			$this->Angsuran_Pokok->ViewValue = ewr_FormatNumber($this->Angsuran_Pokok->ViewValue, 2, -2, -2, -2);
			$this->Angsuran_Pokok->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Pokok->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
			$this->Angsuran_Bunga->ViewValue = ewr_FormatNumber($this->Angsuran_Bunga->ViewValue, 2, -2, -2, -2);
			$this->Angsuran_Bunga->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Bunga->CellAttrs["style"] = "text-align:right;";

			// Angsuran_Total
			$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
			$this->Angsuran_Total->ViewValue = ewr_FormatNumber($this->Angsuran_Total->ViewValue, 2, -2, -2, -2);
			$this->Angsuran_Total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Angsuran_Total->CellAttrs["style"] = "text-align:right;";

			// No_Ref
			$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
			$this->No_Ref->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->ViewValue = $this->Biaya_Administrasi->CurrentValue;
			$this->Biaya_Administrasi->ViewValue = ewr_FormatNumber($this->Biaya_Administrasi->ViewValue, 2, -2, -2, -2);
			$this->Biaya_Administrasi->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Biaya_Administrasi->CellAttrs["style"] = "text-align:right;";

			// Biaya_Materai
			$this->Biaya_Materai->ViewValue = $this->Biaya_Materai->CurrentValue;
			$this->Biaya_Materai->ViewValue = ewr_FormatNumber($this->Biaya_Materai->ViewValue, 2, -2, -2, -2);
			$this->Biaya_Materai->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Biaya_Materai->CellAttrs["style"] = "text-align:right;";

			// NamaMarketing
			$this->NamaMarketing->ViewValue = $this->NamaMarketing->CurrentValue;
			$this->NamaMarketing->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Periode
			$this->Periode->ViewValue = $this->Periode->CurrentValue;
			$this->Periode->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Macet
			$this->Macet->ViewValue = ewr_BooleanName($this->Macet->CurrentValue);
			$this->Macet->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Kontrak_No
			$this->Kontrak_No->HrefValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->HrefValue = "";

			// NamaNasabah
			$this->NamaNasabah->HrefValue = "";

			// NamaJaminan
			$this->NamaJaminan->HrefValue = "";

			// Pinjaman
			$this->Pinjaman->HrefValue = "";

			// Angsuran_Lama
			$this->Angsuran_Lama->HrefValue = "";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->HrefValue = "";

			// Angsuran_Denda
			$this->Angsuran_Denda->HrefValue = "";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->HrefValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->HrefValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->HrefValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->HrefValue = "";

			// No_Ref
			$this->No_Ref->HrefValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->HrefValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->HrefValue = "";

			// NamaMarketing
			$this->NamaMarketing->HrefValue = "";

			// Periode
			$this->Periode->HrefValue = "";

			// Macet
			$this->Macet->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row

			// Pinjaman
			$CurrentValue = $this->Pinjaman->SumValue;
			$ViewValue = &$this->Pinjaman->SumViewValue;
			$ViewAttrs = &$this->Pinjaman->ViewAttrs;
			$CellAttrs = &$this->Pinjaman->CellAttrs;
			$HrefValue = &$this->Pinjaman->HrefValue;
			$LinkAttrs = &$this->Pinjaman->LinkAttrs;
			$this->Cell_Rendered($this->Pinjaman, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		} else {

			// Kontrak_No
			$CurrentValue = $this->Kontrak_No->CurrentValue;
			$ViewValue = &$this->Kontrak_No->ViewValue;
			$ViewAttrs = &$this->Kontrak_No->ViewAttrs;
			$CellAttrs = &$this->Kontrak_No->CellAttrs;
			$HrefValue = &$this->Kontrak_No->HrefValue;
			$LinkAttrs = &$this->Kontrak_No->LinkAttrs;
			$this->Cell_Rendered($this->Kontrak_No, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Kontrak_Tgl
			$CurrentValue = $this->Kontrak_Tgl->CurrentValue;
			$ViewValue = &$this->Kontrak_Tgl->ViewValue;
			$ViewAttrs = &$this->Kontrak_Tgl->ViewAttrs;
			$CellAttrs = &$this->Kontrak_Tgl->CellAttrs;
			$HrefValue = &$this->Kontrak_Tgl->HrefValue;
			$LinkAttrs = &$this->Kontrak_Tgl->LinkAttrs;
			$this->Cell_Rendered($this->Kontrak_Tgl, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// NamaNasabah
			$CurrentValue = $this->NamaNasabah->CurrentValue;
			$ViewValue = &$this->NamaNasabah->ViewValue;
			$ViewAttrs = &$this->NamaNasabah->ViewAttrs;
			$CellAttrs = &$this->NamaNasabah->CellAttrs;
			$HrefValue = &$this->NamaNasabah->HrefValue;
			$LinkAttrs = &$this->NamaNasabah->LinkAttrs;
			$this->Cell_Rendered($this->NamaNasabah, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// NamaJaminan
			$CurrentValue = $this->NamaJaminan->CurrentValue;
			$ViewValue = &$this->NamaJaminan->ViewValue;
			$ViewAttrs = &$this->NamaJaminan->ViewAttrs;
			$CellAttrs = &$this->NamaJaminan->CellAttrs;
			$HrefValue = &$this->NamaJaminan->HrefValue;
			$LinkAttrs = &$this->NamaJaminan->LinkAttrs;
			$this->Cell_Rendered($this->NamaJaminan, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Pinjaman
			$CurrentValue = $this->Pinjaman->CurrentValue;
			$ViewValue = &$this->Pinjaman->ViewValue;
			$ViewAttrs = &$this->Pinjaman->ViewAttrs;
			$CellAttrs = &$this->Pinjaman->CellAttrs;
			$HrefValue = &$this->Pinjaman->HrefValue;
			$LinkAttrs = &$this->Pinjaman->LinkAttrs;
			$this->Cell_Rendered($this->Pinjaman, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Lama
			$CurrentValue = $this->Angsuran_Lama->CurrentValue;
			$ViewValue = &$this->Angsuran_Lama->ViewValue;
			$ViewAttrs = &$this->Angsuran_Lama->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Lama->CellAttrs;
			$HrefValue = &$this->Angsuran_Lama->HrefValue;
			$LinkAttrs = &$this->Angsuran_Lama->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Lama, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Bunga_Prosen
			$CurrentValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
			$ViewValue = &$this->Angsuran_Bunga_Prosen->ViewValue;
			$ViewAttrs = &$this->Angsuran_Bunga_Prosen->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Bunga_Prosen->CellAttrs;
			$HrefValue = &$this->Angsuran_Bunga_Prosen->HrefValue;
			$LinkAttrs = &$this->Angsuran_Bunga_Prosen->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Bunga_Prosen, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Denda
			$CurrentValue = $this->Angsuran_Denda->CurrentValue;
			$ViewValue = &$this->Angsuran_Denda->ViewValue;
			$ViewAttrs = &$this->Angsuran_Denda->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Denda->CellAttrs;
			$HrefValue = &$this->Angsuran_Denda->HrefValue;
			$LinkAttrs = &$this->Angsuran_Denda->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Denda, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Dispensasi_Denda
			$CurrentValue = $this->Dispensasi_Denda->CurrentValue;
			$ViewValue = &$this->Dispensasi_Denda->ViewValue;
			$ViewAttrs = &$this->Dispensasi_Denda->ViewAttrs;
			$CellAttrs = &$this->Dispensasi_Denda->CellAttrs;
			$HrefValue = &$this->Dispensasi_Denda->HrefValue;
			$LinkAttrs = &$this->Dispensasi_Denda->LinkAttrs;
			$this->Cell_Rendered($this->Dispensasi_Denda, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Pokok
			$CurrentValue = $this->Angsuran_Pokok->CurrentValue;
			$ViewValue = &$this->Angsuran_Pokok->ViewValue;
			$ViewAttrs = &$this->Angsuran_Pokok->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Pokok->CellAttrs;
			$HrefValue = &$this->Angsuran_Pokok->HrefValue;
			$LinkAttrs = &$this->Angsuran_Pokok->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Pokok, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Bunga
			$CurrentValue = $this->Angsuran_Bunga->CurrentValue;
			$ViewValue = &$this->Angsuran_Bunga->ViewValue;
			$ViewAttrs = &$this->Angsuran_Bunga->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Bunga->CellAttrs;
			$HrefValue = &$this->Angsuran_Bunga->HrefValue;
			$LinkAttrs = &$this->Angsuran_Bunga->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Bunga, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Angsuran_Total
			$CurrentValue = $this->Angsuran_Total->CurrentValue;
			$ViewValue = &$this->Angsuran_Total->ViewValue;
			$ViewAttrs = &$this->Angsuran_Total->ViewAttrs;
			$CellAttrs = &$this->Angsuran_Total->CellAttrs;
			$HrefValue = &$this->Angsuran_Total->HrefValue;
			$LinkAttrs = &$this->Angsuran_Total->LinkAttrs;
			$this->Cell_Rendered($this->Angsuran_Total, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// No_Ref
			$CurrentValue = $this->No_Ref->CurrentValue;
			$ViewValue = &$this->No_Ref->ViewValue;
			$ViewAttrs = &$this->No_Ref->ViewAttrs;
			$CellAttrs = &$this->No_Ref->CellAttrs;
			$HrefValue = &$this->No_Ref->HrefValue;
			$LinkAttrs = &$this->No_Ref->LinkAttrs;
			$this->Cell_Rendered($this->No_Ref, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Biaya_Administrasi
			$CurrentValue = $this->Biaya_Administrasi->CurrentValue;
			$ViewValue = &$this->Biaya_Administrasi->ViewValue;
			$ViewAttrs = &$this->Biaya_Administrasi->ViewAttrs;
			$CellAttrs = &$this->Biaya_Administrasi->CellAttrs;
			$HrefValue = &$this->Biaya_Administrasi->HrefValue;
			$LinkAttrs = &$this->Biaya_Administrasi->LinkAttrs;
			$this->Cell_Rendered($this->Biaya_Administrasi, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Biaya_Materai
			$CurrentValue = $this->Biaya_Materai->CurrentValue;
			$ViewValue = &$this->Biaya_Materai->ViewValue;
			$ViewAttrs = &$this->Biaya_Materai->ViewAttrs;
			$CellAttrs = &$this->Biaya_Materai->CellAttrs;
			$HrefValue = &$this->Biaya_Materai->HrefValue;
			$LinkAttrs = &$this->Biaya_Materai->LinkAttrs;
			$this->Cell_Rendered($this->Biaya_Materai, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// NamaMarketing
			$CurrentValue = $this->NamaMarketing->CurrentValue;
			$ViewValue = &$this->NamaMarketing->ViewValue;
			$ViewAttrs = &$this->NamaMarketing->ViewAttrs;
			$CellAttrs = &$this->NamaMarketing->CellAttrs;
			$HrefValue = &$this->NamaMarketing->HrefValue;
			$LinkAttrs = &$this->NamaMarketing->LinkAttrs;
			$this->Cell_Rendered($this->NamaMarketing, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Periode
			$CurrentValue = $this->Periode->CurrentValue;
			$ViewValue = &$this->Periode->ViewValue;
			$ViewAttrs = &$this->Periode->ViewAttrs;
			$CellAttrs = &$this->Periode->CellAttrs;
			$HrefValue = &$this->Periode->HrefValue;
			$LinkAttrs = &$this->Periode->LinkAttrs;
			$this->Cell_Rendered($this->Periode, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Macet
			$CurrentValue = $this->Macet->CurrentValue;
			$ViewValue = &$this->Macet->ViewValue;
			$ViewAttrs = &$this->Macet->ViewAttrs;
			$CellAttrs = &$this->Macet->CellAttrs;
			$HrefValue = &$this->Macet->HrefValue;
			$LinkAttrs = &$this->Macet->LinkAttrs;
			$this->Cell_Rendered($this->Macet, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->SetupFieldCount();
	}

	// Setup field count
	function SetupFieldCount() {
		$this->GrpColumnCount = 0;
		$this->SubGrpColumnCount = 0;
		$this->DtlColumnCount = 0;
		if ($this->Kontrak_No->Visible) $this->DtlColumnCount += 1;
		if ($this->Kontrak_Tgl->Visible) $this->DtlColumnCount += 1;
		if ($this->NamaNasabah->Visible) $this->DtlColumnCount += 1;
		if ($this->NamaJaminan->Visible) $this->DtlColumnCount += 1;
		if ($this->Pinjaman->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Lama->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Bunga_Prosen->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Denda->Visible) $this->DtlColumnCount += 1;
		if ($this->Dispensasi_Denda->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Pokok->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Bunga->Visible) $this->DtlColumnCount += 1;
		if ($this->Angsuran_Total->Visible) $this->DtlColumnCount += 1;
		if ($this->No_Ref->Visible) $this->DtlColumnCount += 1;
		if ($this->Biaya_Administrasi->Visible) $this->DtlColumnCount += 1;
		if ($this->Biaya_Materai->Visible) $this->DtlColumnCount += 1;
		if ($this->NamaMarketing->Visible) $this->DtlColumnCount += 1;
		if ($this->Periode->Visible) $this->DtlColumnCount += 1;
		if ($this->Macet->Visible) $this->DtlColumnCount += 1;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = substr(ewr_CurrentUrl(), strrpos(ewr_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$ReportBreadcrumb->Add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	function SetupExportOptionsExt() {
		global $ReportLanguage, $ReportOptions;
		$ReportTypes = $ReportOptions["ReportTypes"];
		$item =& $this->ExportOptions->GetItem("pdf");
		$item->Visible = TRUE;
		if ($item->Visible)
			$ReportTypes["pdf"] = $ReportLanguage->Phrase("ReportFormPdf");
		$exportid = session_id();
		$url = $this->ExportPdfUrl;
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ewr_ExportCharts(this, '" . $url . "', '" . $exportid . "');\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$ReportOptions["ReportTypes"] = $ReportTypes;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $gsFormError;
		$sFilter = "";
		if ($this->DrillDown)
			return "";
		$bPostBack = ewr_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			$this->SetSessionFilterValues($this->Kontrak_No->SearchValue, $this->Kontrak_No->SearchOperator, $this->Kontrak_No->SearchCondition, $this->Kontrak_No->SearchValue2, $this->Kontrak_No->SearchOperator2, 'Kontrak_No'); // Field Kontrak_No
			$this->SetSessionFilterValues($this->Kontrak_Tgl->SearchValue, $this->Kontrak_Tgl->SearchOperator, $this->Kontrak_Tgl->SearchCondition, $this->Kontrak_Tgl->SearchValue2, $this->Kontrak_Tgl->SearchOperator2, 'Kontrak_Tgl'); // Field Kontrak_Tgl

			//$bSetupFilter = TRUE; // No need to set up, just use default
		} else {
			$bRestoreSession = !$this->SearchCommand;

			// Field Kontrak_No
			if ($this->GetFilterValues($this->Kontrak_No)) {
				$bSetupFilter = TRUE;
			}

			// Field Kontrak_Tgl
			if ($this->GetFilterValues($this->Kontrak_Tgl)) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setFailureMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {
			$this->GetSessionFilterValues($this->Kontrak_No); // Field Kontrak_No
			$this->GetSessionFilterValues($this->Kontrak_Tgl); // Field Kontrak_Tgl
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->BuildExtendedFilter($this->Kontrak_No, $sFilter, FALSE, TRUE); // Field Kontrak_No
		$this->BuildExtendedFilter($this->Kontrak_Tgl, $sFilter, FALSE, TRUE); // Field Kontrak_Tgl

		// Save parms to session
		$this->SetSessionFilterValues($this->Kontrak_No->SearchValue, $this->Kontrak_No->SearchOperator, $this->Kontrak_No->SearchCondition, $this->Kontrak_No->SearchValue2, $this->Kontrak_No->SearchOperator2, 'Kontrak_No'); // Field Kontrak_No
		$this->SetSessionFilterValues($this->Kontrak_Tgl->SearchValue, $this->Kontrak_Tgl->SearchOperator, $this->Kontrak_Tgl->SearchCondition, $this->Kontrak_Tgl->SearchValue2, $this->Kontrak_Tgl->SearchOperator2, 'Kontrak_Tgl'); // Field Kontrak_Tgl

		// Setup filter
		if ($bSetupFilter) {
		}
		return $sFilter;
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr, $Default = FALSE, $SaveFilter = FALSE) {
		$FldVal = ($Default) ? $fld->DefaultDropDownValue : $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownFilter($fld, $val, $FldOpr);

				// Call Page Filtering event
				if (substr($val, 0, 2) <> "@@") $this->Page_Filtering($fld, $sWrk, "dropdown", $FldOpr, $val);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownFilter($fld, $FldVal, $FldOpr);

			// Call Page Filtering event
			if (substr($FldVal, 0, 2) <> "@@") $this->Page_Filtering($fld, $sSql, "dropdown", $FldOpr, $FldVal);
		}
		if ($sSql <> "") {
			ewr_AddFilter($FilterClause, $sSql);
			if ($SaveFilter) $fld->CurrentFilter = $sSql;
		}
	}

	function GetDropDownFilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDelimiter = $fld->FldDelimiter;
		$FldVal = strval($FldVal);
		if ($FldOpr == "") $FldOpr = "=";
		$sWrk = "";
		if (ewr_SameStr($FldVal, EWR_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif (ewr_SameStr($FldVal, EWR_NOT_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NOT NULL";
		} elseif (ewr_SameStr($FldVal, EWR_EMPTY_VALUE)) {
			$sWrk = $FldExpression . " = ''";
		} elseif (ewr_SameStr($FldVal, EWR_ALL_VALUE)) {
			$sWrk = "1 = 1";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = $this->GetCustomFilter($fld, $FldVal, $this->DBID);
			} elseif ($FldDelimiter <> "" && trim($FldVal) <> "" && ($FldDataType == EWR_DATATYPE_STRING || $FldDataType == EWR_DATATYPE_MEMO)) {
				$sWrk = ewr_GetMultiSearchSql($FldExpression, trim($FldVal), $this->DBID);
			} else {
				if ($FldVal <> "" && $FldVal <> EWR_INIT_VALUE) {
					if ($FldDataType == EWR_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = ewr_DateFilterString($FldExpression, $FldOpr, $FldVal, $FldDataType, $this->DBID);
					} else {
						$sWrk = ewr_FilterString($FldOpr, $FldVal, $FldDataType, $this->DBID);
						if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
					}
				}
			}
		}
		return $sWrk;
	}

	// Get custom filter
	function GetCustomFilter(&$fld, $FldVal, $dbid = 0) {
		$sWrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $FldVal && $filter->Enabled) {
					$sFld = $fld->FldExpression;
					$sFn = $filter->FunctionName;
					$wrkid = (substr($filter->ID,0,2) == "@@") ? substr($filter->ID,2) : $filter->ID;
					if ($sFn <> "")
						$sWrk = $sFn($sFld, $dbid);
					else
						$sWrk = "";
					$this->Page_Filtering($fld, $sWrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $sWrk;
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause, $Default = FALSE, $SaveFilter = FALSE) {
		$sWrk = ewr_GetExtendedFilter($fld, $Default, $this->DBID);
		if (!$Default)
			$this->Page_Filtering($fld, $sWrk, "extended", $fld->SearchOperator, $fld->SearchValue, $fld->SearchCondition, $fld->SearchOperator2, $fld->SearchValue2);
		if ($sWrk <> "") {
			ewr_AddFilter($FilterClause, $sWrk);
			if ($SaveFilter) $fld->CurrentFilter = $sWrk;
		}
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["so_$parm"]))
			$fld->SearchOperator = ewr_StripSlashes(@$_GET["so_$parm"]);
		if (isset($_GET["sv_$parm"])) {
			$fld->DropDownValue = ewr_StripSlashes(@$_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv_$parm"])) {
			$fld->SearchValue = ewr_StripSlashes(@$_GET["sv_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so_$parm"])) {
			$fld->SearchOperator = ewr_StripSlashes(@$_GET["so_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewr_StripSlashes(@$_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewr_StripSlashes(@$_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewr_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DropDownValue)) {
			if (is_array($fld->DefaultDropDownValue)) {
				if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
					return TRUE;
				else
					return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
			} else {
				return TRUE;
			}
		} else {
			if (is_array($fld->DefaultDropDownValue))
				return TRUE;
			else
				$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWR_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWR_INIT_VALUE || $v2 == EWR_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_r01_pinjaman_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r01_pinjaman_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv_r01_pinjaman_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r01_pinjaman_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_r01_pinjaman_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_r01_pinjaman_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_r01_pinjaman_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $so, $parm) {
		$_SESSION['sv_r01_pinjaman_' . $parm] = $sv;
		$_SESSION['so_r01_pinjaman_' . $parm] = $so;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv_r01_pinjaman_' . $parm] = $sv1;
		$_SESSION['so_r01_pinjaman_' . $parm] = $so1;
		$_SESSION['sc_r01_pinjaman_' . $parm] = $sc;
		$_SESSION['sv2_r01_pinjaman_' . $parm] = $sv2;
		$_SESSION['so2_r01_pinjaman_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWR_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWR_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!EURODATE($this->Kontrak_Tgl->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $this->Kontrak_Tgl->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<p>&nbsp;</p>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_r01_pinjaman_$parm"] = "";
		$_SESSION["rf_r01_pinjaman_$parm"] = "";
		$_SESSION["rt_r01_pinjaman_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		$fld = &$this->FieldByParm($parm);
		$fld->SelectionList = @$_SESSION["sel_r01_pinjaman_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_r01_pinjaman_$parm"];
		$fld->RangeTo = @$_SESSION["rt_r01_pinjaman_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		/**
		* Set up default values for non Text filters
		*/
		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		// Field Kontrak_No
		$this->SetDefaultExtFilter($this->Kontrak_No, "LIKE", NULL, 'AND', "=", NULL);
		if (!$this->SearchCommand) $this->ApplyDefaultExtFilter($this->Kontrak_No);

		// Field Kontrak_Tgl
		$this->SetDefaultExtFilter($this->Kontrak_Tgl, "=", NULL, 'AND', "=", NULL);
		if (!$this->SearchCommand) $this->ApplyDefaultExtFilter($this->Kontrak_Tgl);
		/**
		* Set up default values for popup filters
		*/
	}

	// Check if filter applied
	function CheckFilter() {

		// Check Kontrak_No text filter
		if ($this->TextFilterApplied($this->Kontrak_No))
			return TRUE;

		// Check Kontrak_Tgl text filter
		if ($this->TextFilterApplied($this->Kontrak_Tgl))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList($showDate = FALSE) {
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field Kontrak_No
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($this->Kontrak_No, $sExtWrk);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->Kontrak_No->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field Kontrak_Tgl
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($this->Kontrak_Tgl, $sExtWrk);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->Kontrak_Tgl->FldCaption() . "</span>" . $sFilter . "</div>";
		$divstyle = "";
		$divdataclass = "";

		// Show Filters
		if ($sFilterList <> "" || $showDate) {
			$sMessage = "<div" . $divstyle . $divdataclass . "><div id=\"ewrFilterList\" class=\"alert alert-info ewDisplayTable\">";
			if ($showDate)
				$sMessage .= "<div id=\"ewrCurrentDate\">" . $ReportLanguage->Phrase("ReportGeneratedDate") . ewr_FormatDateTime(date("Y-m-d H:i:s"), 1) . "</div>";
			if ($sFilterList <> "")
				$sMessage .= "<div id=\"ewrCurrentFilters\">" . $ReportLanguage->Phrase("CurrentFilters") . "</div>" . $sFilterList;
			$sMessage .= "</div></div>";
			$this->Message_Showing($sMessage, "");
			echo $sMessage;
		}
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";

		// Field Kontrak_No
		$sWrk = "";
		if ($this->Kontrak_No->SearchValue <> "" || $this->Kontrak_No->SearchValue2 <> "") {
			$sWrk = "\"sv_Kontrak_No\":\"" . ewr_JsEncode2($this->Kontrak_No->SearchValue) . "\"," .
				"\"so_Kontrak_No\":\"" . ewr_JsEncode2($this->Kontrak_No->SearchOperator) . "\"," .
				"\"sc_Kontrak_No\":\"" . ewr_JsEncode2($this->Kontrak_No->SearchCondition) . "\"," .
				"\"sv2_Kontrak_No\":\"" . ewr_JsEncode2($this->Kontrak_No->SearchValue2) . "\"," .
				"\"so2_Kontrak_No\":\"" . ewr_JsEncode2($this->Kontrak_No->SearchOperator2) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field Kontrak_Tgl
		$sWrk = "";
		if ($this->Kontrak_Tgl->SearchValue <> "" || $this->Kontrak_Tgl->SearchValue2 <> "") {
			$sWrk = "\"sv_Kontrak_Tgl\":\"" . ewr_JsEncode2($this->Kontrak_Tgl->SearchValue) . "\"," .
				"\"so_Kontrak_Tgl\":\"" . ewr_JsEncode2($this->Kontrak_Tgl->SearchOperator) . "\"," .
				"\"sc_Kontrak_Tgl\":\"" . ewr_JsEncode2($this->Kontrak_Tgl->SearchCondition) . "\"," .
				"\"sv2_Kontrak_Tgl\":\"" . ewr_JsEncode2($this->Kontrak_Tgl->SearchValue2) . "\"," .
				"\"so2_Kontrak_Tgl\":\"" . ewr_JsEncode2($this->Kontrak_Tgl->SearchOperator2) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Return filter list in json
		if ($sFilterList <> "")
			return "{" . $sFilterList . "}";
		else
			return "null";
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ewr_StripSlashes(@$_POST["filter"]), TRUE);
		return $this->SetupFilterList($filter);
	}

	// Setup list of filters
	function SetupFilterList($filter) {
		if (!is_array($filter))
			return FALSE;

		// Field Kontrak_No
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_Kontrak_No", $filter) || array_key_exists("so_Kontrak_No", $filter) ||
			array_key_exists("sc_Kontrak_No", $filter) ||
			array_key_exists("sv2_Kontrak_No", $filter) || array_key_exists("so2_Kontrak_No", $filter)) {
			$this->SetSessionFilterValues(@$filter["sv_Kontrak_No"], @$filter["so_Kontrak_No"], @$filter["sc_Kontrak_No"], @$filter["sv2_Kontrak_No"], @$filter["so2_Kontrak_No"], "Kontrak_No");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionFilterValues("", "=", "AND", "", "=", "Kontrak_No");
		}

		// Field Kontrak_Tgl
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_Kontrak_Tgl", $filter) || array_key_exists("so_Kontrak_Tgl", $filter) ||
			array_key_exists("sc_Kontrak_Tgl", $filter) ||
			array_key_exists("sv2_Kontrak_Tgl", $filter) || array_key_exists("so2_Kontrak_Tgl", $filter)) {
			$this->SetSessionFilterValues(@$filter["sv_Kontrak_Tgl"], @$filter["so_Kontrak_Tgl"], @$filter["sc_Kontrak_Tgl"], @$filter["sv2_Kontrak_Tgl"], @$filter["so2_Kontrak_Tgl"], "Kontrak_Tgl");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionFilterValues("", "=", "AND", "", "=", "Kontrak_Tgl");
		}
		return TRUE;
	}

	// Return popup filter
	function GetPopupFilter() {
		$sWrk = "";
		if ($this->DrillDown)
			return "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWR_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort($options = array()) {
		if ($this->DrillDown)
			return "`Kontrak_No` ASC";
		$bResetSort = @$options["resetsort"] == "1" || @$_GET["cmd"] == "resetsort";
		$orderBy = (@$options["order"] <> "") ? @$options["order"] : ewr_StripSlashes(@$_GET["order"]);
		$orderType = (@$options["ordertype"] <> "") ? @$options["ordertype"] : ewr_StripSlashes(@$_GET["ordertype"]);

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for a resetsort command
		if ($bResetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->Kontrak_No->setSort("");
			$this->Kontrak_Tgl->setSort("");
			$this->NamaNasabah->setSort("");
			$this->NamaJaminan->setSort("");
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
			$this->NamaMarketing->setSort("");
			$this->Periode->setSort("");
			$this->Macet->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->UpdateSort($this->Kontrak_No, $bCtrl); // Kontrak_No
			$this->UpdateSort($this->Kontrak_Tgl, $bCtrl); // Kontrak_Tgl
			$this->UpdateSort($this->NamaNasabah, $bCtrl); // NamaNasabah
			$this->UpdateSort($this->NamaJaminan, $bCtrl); // NamaJaminan
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
			$this->UpdateSort($this->NamaMarketing, $bCtrl); // NamaMarketing
			$this->UpdateSort($this->Periode, $bCtrl); // Periode
			$this->UpdateSort($this->Macet, $bCtrl); // Macet
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
		}

		// Set up default sort
		if ($this->getOrderBy() == "") {
			$this->setOrderBy("`Kontrak_No` ASC");
			$this->Kontrak_No->setSort("ASC");
		}
		return $this->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent, $options = array()) {
		global $gTmpImages, $ReportLanguage;
		$bGenRequest = @$options["reporttype"] == "email";
		$sFailRespPfx = $bGenRequest ? "" : "<p class=\"text-error\">";
		$sSuccessRespPfx = $bGenRequest ? "" : "<p class=\"text-success\">";
		$sRespPfx = $bGenRequest ? "" : "</p>";
		$sContentType = (@$options["contenttype"] <> "") ? $options["contenttype"] : @$_POST["contenttype"];
		$sSender = (@$options["sender"] <> "") ? $options["sender"] : @$_POST["sender"];
		$sRecipient = (@$options["recipient"] <> "") ? $options["recipient"] : @$_POST["recipient"];
		$sCc = (@$options["cc"] <> "") ? $options["cc"] : @$_POST["cc"];
		$sBcc = (@$options["bcc"] <> "") ? $options["bcc"] : @$_POST["bcc"];

		// Subject
		$sEmailSubject = (@$options["subject"] <> "") ? $options["subject"] : ewr_StripSlashes(@$_POST["subject"]);

		// Message
		$sEmailMessage = (@$options["message"] <> "") ? $options["message"] : ewr_StripSlashes(@$_POST["message"]);

		// Check sender
		if ($sSender == "")
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterSenderEmail") . $sRespPfx;
		if (!ewr_CheckEmail($sSender))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperSenderEmail") . $sRespPfx;

		// Check recipient
		if (!ewr_CheckEmailList($sRecipient, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperRecipientEmail") . $sRespPfx;

		// Check cc
		if (!ewr_CheckEmailList($sCc, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperCcEmail") . $sRespPfx;

		// Check bcc
		if (!ewr_CheckEmailList($sBcc, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperBccEmail") . $sRespPfx;

		// Check email sent count
		$emailcount = $bGenRequest ? 0 : ewr_LoadEmailCount();
		if (intval($emailcount) >= EWR_MAX_EMAIL_SENT_COUNT)
			return $sFailRespPfx . $ReportLanguage->Phrase("ExceedMaxEmailExport") . $sRespPfx;
		if ($sEmailMessage <> "") {
			if (EWR_REMOVE_XSS) $sEmailMessage = ewr_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		$sAttachmentContent = ewr_AdjustEmailContent($EmailContent);
		$sAppPath = ewr_FullUrl();
		$sAppPath = substr($sAppPath, 0, strrpos($sAppPath, "/")+1);
		if (strpos($sAttachmentContent, "<head>") !== FALSE)
			$sAttachmentContent = str_replace("<head>", "<head><base href=\"" . $sAppPath . "\">", $sAttachmentContent); // Add <base href> statement inside the header
		else
			$sAttachmentContent = "<base href=\"" . $sAppPath . "\">" . $sAttachmentContent; // Add <base href> statement as the first statement

		//$sAttachmentFile = $this->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $this->TableVar . "_" . Date("YmdHis") . "_" . ewr_Random() . ".html";
		if ($sContentType == "url") {
			ewr_SaveFile(EWR_UPLOAD_DEST_PATH, $sAttachmentFile, $sAttachmentContent);
			$sAttachmentFile = EWR_UPLOAD_DEST_PATH . $sAttachmentFile;
			$sUrl = $sAppPath . $sAttachmentFile;
			$sEmailMessage .= $sUrl; // Send URL only
			$sAttachmentFile = "";
			$sAttachmentContent = "";
		} else {
			$sEmailMessage .= $sAttachmentContent;
			$sAttachmentFile = "";
			$sAttachmentContent = "";
		}

		// Send email
		$Email = new crEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		if ($sAttachmentFile <> "")
			$Email->AddAttachment($sAttachmentFile, $sAttachmentContent);
		if ($sContentType <> "url") {
			foreach ($gTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
		}
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EWR_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();
		ewr_DeleteTmpImages($EmailContent);

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count and write log
			ewr_AddEmailLog($sSender, $sRecipient, $sEmailSubject, $sEmailMessage);

			// Sent email success
			return $sSuccessRespPfx . $ReportLanguage->Phrase("SendEmailSuccess") . $sRespPfx; // Set up success message
		} else {

			// Sent email failure
			return $sFailRespPfx . $Email->SendErrDescription . $sRespPfx;
		}
	}

	// Export to HTML
	function ExportHtml($html, $options = array()) {

		//global $gsExportFile;
		//header('Content-Type: text/html' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
		//header('Content-Disposition: attachment; filename=' . $gsExportFile . '.html');

		$folder = @$this->GenOptions["folder"];
		$fileName = @$this->GenOptions["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";

		// Save generate file for print
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			$baseTag = "<base href=\"" . ewr_BaseUrl() . "\">";
			$html = preg_replace('/<head>/', '<head>' . $baseTag, $html);
			ewr_SaveFile($folder, $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file")
			echo $html;
		return $saveToFile;
	}

	// Export to WORD
	function ExportWord($html, $options = array()) {
		global $gsExportFile;
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Content-Type: application/vnd.ms-word' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
			header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
			echo $html;
		}
		return $saveToFile;
	}

	// Export to EXCEL
	function ExportExcel($html, $options = array()) {
		global $gsExportFile;
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Content-Type: application/vnd.ms-excel' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
			header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
			echo $html;
		}
		return $saveToFile;
	}

	// Export PDF
	function ExportPdf($html, $options = array()) {
		global $gsExportFile;
		@ini_set("memory_limit", EWR_PDF_MEMORY_LIMIT);
		set_time_limit(EWR_PDF_TIME_LIMIT);
		if (EWR_DEBUG_ENABLED) // Add debug message
			$html = str_replace("</body>", ewr_DebugMsg() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(array("pdf_backend" => "Cpdf"));
		$doc = new DOMDocument();
		@$doc->loadHTML('<?xml encoding="uft-8">' . ewr_ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			if ($span->getAttribute("class") == "ewFilterCaption")
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
		}
		$html = $doc->saveHTML();
		$html = ewr_ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $dompdf->output());
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			$sExportFile = strtolower(substr($gsExportFile, -4)) == ".pdf" ? $gsExportFile : $gsExportFile . ".pdf";
			$dompdf->stream($sExportFile, array("Attachment" => 1)); // 0 to open in browser, 1 to download
		}
		ewr_DeleteTmpImages($html);
		return $saveToFile;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
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
<?php ewr_Header(FALSE) ?>
<?php

// Create page object
if (!isset($r01_pinjaman_summary)) $r01_pinjaman_summary = new crr01_pinjaman_summary();
if (isset($Page)) $OldPage = $Page;
$Page = &$r01_pinjaman_summary;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php include_once "header.php" ?>
<?php include_once "phprptinc/header.php" ?>
<?php if ($Page->Export == "" || $Page->Export == "print" || $Page->Export == "email" && @$gsEmailContentType == "url") { ?>
<script type="text/javascript">

// Create page object
var r01_pinjaman_summary = new ewr_Page("r01_pinjaman_summary");

// Page properties
r01_pinjaman_summary.PageID = "summary"; // Page ID
var EWR_PAGE_ID = r01_pinjaman_summary.PageID;

// Extend page with Chart_Rendering function
r01_pinjaman_summary.Chart_Rendering = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }

// Extend page with Chart_Rendered function
r01_pinjaman_summary.Chart_Rendered = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Form object
var CurrentForm = fr01_pinjamansummary = new ewr_Form("fr01_pinjamansummary");

// Validate method
fr01_pinjamansummary.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	var elm = fobj.sv_Kontrak_Tgl;
	if (elm && typeof(EURODATE) == "function" && !EURODATE(elm.value)) {
		if (!this.OnError(elm, "<?php echo ewr_JsEncode2($Page->Kontrak_Tgl->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fr01_pinjamansummary.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }
<?php if (EWR_CLIENT_VALIDATE) { ?>
fr01_pinjamansummary.ValidateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fr01_pinjamansummary.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($Page->Export == "") { ?>
<!-- container (begin) -->
<div id="ewContainer" class="ewContainer">
<!-- top container (begin) -->
<div id="ewTop" class="ewTop">
<a id="top"></a>
<?php } ?>
<?php if (@$Page->GenOptions["showfilter"] == "1") { ?>
<?php $Page->ShowFilterList(TRUE) ?>
<?php } ?>
<!-- top slot -->
<div class="ewToolbar">
<?php if ($Page->Export == "" && (!$Page->DrillDown || !$Page->DrillDownInPanel)) { ?>
<?php if ($ReportBreadcrumb) $ReportBreadcrumb->Render(); ?>
<?php } ?>
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->Render("body");
	$Page->SearchOptions->Render("body");
	$Page->FilterOptions->Render("body");
	$Page->GenerateOptions->Render("body");
}
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<?php echo $ReportLanguage->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php $Page->ShowPageHeader(); ?>
<?php $Page->ShowMessage(); ?>
<?php if ($Page->Export == "") { ?>
</div>
<!-- top container (end) -->
	<!-- left container (begin) -->
	<div id="ewLeft" class="ewLeft">
<?php } ?>
	<!-- Left slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- left container (end) -->
	<!-- center container - report (begin) -->
	<div id="ewCenter" class="ewCenter">
<?php } ?>
	<!-- center slot -->
<!-- summary report starts -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<!-- Search form (begin) -->
<form name="fr01_pinjamansummary" id="fr01_pinjamansummary" class="form-inline ewForm ewExtFilterForm" action="<?php echo ewr_CurrentPage() ?>">
<?php $SearchPanelClass = ($Page->Filter <> "") ? " in" : " in"; ?>
<div id="fr01_pinjamansummary_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ewRow">
<div id="c_Kontrak_No" class="ewCell form-group">
	<label for="sv_Kontrak_No" class="ewSearchCaption ewLabel"><?php echo $Page->Kontrak_No->FldCaption() ?></label>
	<span class="ewSearchOperator"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so_Kontrak_No" id="so_Kontrak_No" value="LIKE"></span>
	<span class="control-group ewSearchField">
<?php ewr_PrependClass($Page->Kontrak_No->EditAttrs["class"], "form-control"); // PR8 ?>
<input type="text" data-table="r01_pinjaman" data-field="x_Kontrak_No" id="sv_Kontrak_No" name="sv_Kontrak_No" size="30" maxlength="25" placeholder="<?php echo $Page->Kontrak_No->PlaceHolder ?>" value="<?php echo ewr_HtmlEncode($Page->Kontrak_No->SearchValue) ?>"<?php echo $Page->Kontrak_No->EditAttributes() ?>>
</span>
</div>
</div>
<div id="r_2" class="ewRow">
<div id="c_Kontrak_Tgl" class="ewCell form-group">
	<label for="sv_Kontrak_Tgl" class="ewSearchCaption ewLabel"><?php echo $Page->Kontrak_Tgl->FldCaption() ?></label>
	<span class="ewSearchOperator"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so_Kontrak_Tgl" id="so_Kontrak_Tgl" value="="></span>
	<span class="control-group ewSearchField">
<?php ewr_PrependClass($Page->Kontrak_Tgl->EditAttrs["class"], "form-control"); // PR8 ?>
<input type="text" data-table="r01_pinjaman" data-field="x_Kontrak_Tgl" id="sv_Kontrak_Tgl" name="sv_Kontrak_Tgl" placeholder="<?php echo $Page->Kontrak_Tgl->PlaceHolder ?>" value="<?php echo ewr_HtmlEncode($Page->Kontrak_Tgl->SearchValue) ?>"<?php echo $Page->Kontrak_Tgl->EditAttributes() ?>>
</span>
</div>
</div>
<div class="ewRow"><input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" value="<?php echo $ReportLanguage->Phrase("Search") ?>">
<input type="reset" name="btnreset" id="btnreset" class="btn hide" value="<?php echo $ReportLanguage->Phrase("Reset") ?>"></div>
</div>
</form>
<script type="text/javascript">
fr01_pinjamansummary.Init();
fr01_pinjamansummary.FilterList = <?php echo $Page->GetFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->ShowFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGrp = $Page->TotalGrps;
} else {
	$Page->StopGrp = $Page->StartGrp + $Page->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGrp) > intval($Page->TotalGrps))
	$Page->StopGrp = $Page->TotalGrps;
$Page->RecCount = 0;
$Page->RecIndex = 0;

// Get first row
if ($Page->TotalGrps > 0) {
	$Page->GetRow(1);
	$Page->GrpCount = 1;
}
$Page->GrpIdx = ewr_InitArray(2, -1);
$Page->GrpIdx[0] = -1;
$Page->GrpIdx[1] = $Page->StopGrp - $Page->StartGrp + 1;
while ($rs && !$rs->EOF && $Page->GrpCount <= $Page->DisplayGrps || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->Kontrak_No->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Kontrak_No"><div class="r01_pinjaman_Kontrak_No"><span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_No->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Kontrak_No">
<?php if ($Page->SortUrl($Page->Kontrak_No) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Kontrak_No">
			<span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_No->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Kontrak_No" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Kontrak_No) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_No->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Kontrak_No->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Kontrak_No->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Kontrak_Tgl->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Kontrak_Tgl"><div class="r01_pinjaman_Kontrak_Tgl"><span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_Tgl->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Kontrak_Tgl">
<?php if ($Page->SortUrl($Page->Kontrak_Tgl) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Kontrak_Tgl">
			<span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_Tgl->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Kontrak_Tgl" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Kontrak_Tgl) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Kontrak_Tgl->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Kontrak_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Kontrak_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->NamaNasabah->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NamaNasabah"><div class="r01_pinjaman_NamaNasabah"><span class="ewTableHeaderCaption"><?php echo $Page->NamaNasabah->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NamaNasabah">
<?php if ($Page->SortUrl($Page->NamaNasabah) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_NamaNasabah">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaNasabah->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_NamaNasabah" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->NamaNasabah) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaNasabah->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->NamaNasabah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->NamaNasabah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->NamaJaminan->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NamaJaminan"><div class="r01_pinjaman_NamaJaminan"><span class="ewTableHeaderCaption"><?php echo $Page->NamaJaminan->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NamaJaminan">
<?php if ($Page->SortUrl($Page->NamaJaminan) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_NamaJaminan">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaJaminan->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_NamaJaminan" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->NamaJaminan) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaJaminan->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->NamaJaminan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->NamaJaminan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Pinjaman->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Pinjaman"><div class="r01_pinjaman_Pinjaman" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Pinjaman->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Pinjaman">
<?php if ($Page->SortUrl($Page->Pinjaman) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Pinjaman" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Pinjaman->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Pinjaman" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Pinjaman) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Pinjaman->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Pinjaman->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Pinjaman->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Lama->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Lama"><div class="r01_pinjaman_Angsuran_Lama" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Lama->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Lama">
<?php if ($Page->SortUrl($Page->Angsuran_Lama) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Lama" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Lama->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Lama" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Lama) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Lama->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Lama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Lama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Bunga_Prosen->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Bunga_Prosen"><div class="r01_pinjaman_Angsuran_Bunga_Prosen" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga_Prosen->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Bunga_Prosen">
<?php if ($Page->SortUrl($Page->Angsuran_Bunga_Prosen) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Bunga_Prosen" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga_Prosen->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Bunga_Prosen" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Bunga_Prosen) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga_Prosen->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Bunga_Prosen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Bunga_Prosen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Denda->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Denda"><div class="r01_pinjaman_Angsuran_Denda" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Denda->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Denda">
<?php if ($Page->SortUrl($Page->Angsuran_Denda) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Denda" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Denda->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Denda" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Denda) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Denda->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Dispensasi_Denda->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Dispensasi_Denda"><div class="r01_pinjaman_Dispensasi_Denda" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Dispensasi_Denda->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Dispensasi_Denda">
<?php if ($Page->SortUrl($Page->Dispensasi_Denda) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Dispensasi_Denda" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Dispensasi_Denda->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Dispensasi_Denda" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Dispensasi_Denda) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Dispensasi_Denda->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Dispensasi_Denda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Dispensasi_Denda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Pokok->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Pokok"><div class="r01_pinjaman_Angsuran_Pokok" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Pokok->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Pokok">
<?php if ($Page->SortUrl($Page->Angsuran_Pokok) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Pokok" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Pokok->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Pokok" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Pokok) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Pokok->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Pokok->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Pokok->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Bunga->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Bunga"><div class="r01_pinjaman_Angsuran_Bunga" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Bunga">
<?php if ($Page->SortUrl($Page->Angsuran_Bunga) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Bunga" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Bunga" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Bunga) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Bunga->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Bunga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Bunga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Angsuran_Total->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Angsuran_Total"><div class="r01_pinjaman_Angsuran_Total" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Total->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Angsuran_Total">
<?php if ($Page->SortUrl($Page->Angsuran_Total) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Angsuran_Total" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Total->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Angsuran_Total" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Angsuran_Total) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Angsuran_Total->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Angsuran_Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Angsuran_Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->No_Ref->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="No_Ref"><div class="r01_pinjaman_No_Ref"><span class="ewTableHeaderCaption"><?php echo $Page->No_Ref->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="No_Ref">
<?php if ($Page->SortUrl($Page->No_Ref) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_No_Ref">
			<span class="ewTableHeaderCaption"><?php echo $Page->No_Ref->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_No_Ref" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->No_Ref) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->No_Ref->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->No_Ref->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->No_Ref->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Biaya_Administrasi->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Biaya_Administrasi"><div class="r01_pinjaman_Biaya_Administrasi" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Administrasi->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Biaya_Administrasi">
<?php if ($Page->SortUrl($Page->Biaya_Administrasi) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Biaya_Administrasi" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Administrasi->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Biaya_Administrasi" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Biaya_Administrasi) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Administrasi->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Biaya_Administrasi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Biaya_Administrasi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Biaya_Materai->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Biaya_Materai"><div class="r01_pinjaman_Biaya_Materai" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Materai->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Biaya_Materai">
<?php if ($Page->SortUrl($Page->Biaya_Materai) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Biaya_Materai" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Materai->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Biaya_Materai" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Biaya_Materai) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Biaya_Materai->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Biaya_Materai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Biaya_Materai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->NamaMarketing->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NamaMarketing"><div class="r01_pinjaman_NamaMarketing"><span class="ewTableHeaderCaption"><?php echo $Page->NamaMarketing->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NamaMarketing">
<?php if ($Page->SortUrl($Page->NamaMarketing) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_NamaMarketing">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaMarketing->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_NamaMarketing" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->NamaMarketing) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->NamaMarketing->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->NamaMarketing->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->NamaMarketing->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Periode->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Periode"><div class="r01_pinjaman_Periode"><span class="ewTableHeaderCaption"><?php echo $Page->Periode->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Periode">
<?php if ($Page->SortUrl($Page->Periode) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Periode">
			<span class="ewTableHeaderCaption"><?php echo $Page->Periode->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Periode" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Periode) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Periode->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Macet->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Macet"><div class="r01_pinjaman_Macet"><span class="ewTableHeaderCaption"><?php echo $Page->Macet->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Macet">
<?php if ($Page->SortUrl($Page->Macet) == "") { ?>
		<div class="ewTableHeaderBtn r01_pinjaman_Macet">
			<span class="ewTableHeaderCaption"><?php echo $Page->Macet->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r01_pinjaman_Macet" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Macet) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Macet->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Macet->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Macet->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGrps == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecCount++;
	$Page->RecIndex++;
?>
<?php

		// Render detail row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_DETAIL;
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->Kontrak_No->Visible) { ?>
		<td data-field="Kontrak_No"<?php echo $Page->Kontrak_No->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Kontrak_No"<?php echo $Page->Kontrak_No->ViewAttributes() ?>><?php echo $Page->Kontrak_No->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Kontrak_Tgl->Visible) { ?>
		<td data-field="Kontrak_Tgl"<?php echo $Page->Kontrak_Tgl->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Kontrak_Tgl"<?php echo $Page->Kontrak_Tgl->ViewAttributes() ?>><?php echo $Page->Kontrak_Tgl->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->NamaNasabah->Visible) { ?>
		<td data-field="NamaNasabah"<?php echo $Page->NamaNasabah->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_NamaNasabah"<?php echo $Page->NamaNasabah->ViewAttributes() ?>><?php echo $Page->NamaNasabah->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->NamaJaminan->Visible) { ?>
		<td data-field="NamaJaminan"<?php echo $Page->NamaJaminan->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_NamaJaminan"<?php echo $Page->NamaJaminan->ViewAttributes() ?>><?php echo $Page->NamaJaminan->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Pinjaman->Visible) { ?>
		<td data-field="Pinjaman"<?php echo $Page->Pinjaman->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Pinjaman"<?php echo $Page->Pinjaman->ViewAttributes() ?>><?php echo $Page->Pinjaman->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Lama->Visible) { ?>
		<td data-field="Angsuran_Lama"<?php echo $Page->Angsuran_Lama->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Lama"<?php echo $Page->Angsuran_Lama->ViewAttributes() ?>><?php echo $Page->Angsuran_Lama->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Bunga_Prosen->Visible) { ?>
		<td data-field="Angsuran_Bunga_Prosen"<?php echo $Page->Angsuran_Bunga_Prosen->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Bunga_Prosen"<?php echo $Page->Angsuran_Bunga_Prosen->ViewAttributes() ?>><?php echo $Page->Angsuran_Bunga_Prosen->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Denda->Visible) { ?>
		<td data-field="Angsuran_Denda"<?php echo $Page->Angsuran_Denda->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Denda"<?php echo $Page->Angsuran_Denda->ViewAttributes() ?>><?php echo $Page->Angsuran_Denda->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Dispensasi_Denda->Visible) { ?>
		<td data-field="Dispensasi_Denda"<?php echo $Page->Dispensasi_Denda->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Dispensasi_Denda"<?php echo $Page->Dispensasi_Denda->ViewAttributes() ?>><?php echo $Page->Dispensasi_Denda->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Pokok->Visible) { ?>
		<td data-field="Angsuran_Pokok"<?php echo $Page->Angsuran_Pokok->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Pokok"<?php echo $Page->Angsuran_Pokok->ViewAttributes() ?>><?php echo $Page->Angsuran_Pokok->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Bunga->Visible) { ?>
		<td data-field="Angsuran_Bunga"<?php echo $Page->Angsuran_Bunga->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Bunga"<?php echo $Page->Angsuran_Bunga->ViewAttributes() ?>><?php echo $Page->Angsuran_Bunga->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Total->Visible) { ?>
		<td data-field="Angsuran_Total"<?php echo $Page->Angsuran_Total->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Angsuran_Total"<?php echo $Page->Angsuran_Total->ViewAttributes() ?>><?php echo $Page->Angsuran_Total->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->No_Ref->Visible) { ?>
		<td data-field="No_Ref"<?php echo $Page->No_Ref->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_No_Ref"<?php echo $Page->No_Ref->ViewAttributes() ?>><?php echo $Page->No_Ref->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Biaya_Administrasi->Visible) { ?>
		<td data-field="Biaya_Administrasi"<?php echo $Page->Biaya_Administrasi->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Biaya_Administrasi"<?php echo $Page->Biaya_Administrasi->ViewAttributes() ?>><?php echo $Page->Biaya_Administrasi->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Biaya_Materai->Visible) { ?>
		<td data-field="Biaya_Materai"<?php echo $Page->Biaya_Materai->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Biaya_Materai"<?php echo $Page->Biaya_Materai->ViewAttributes() ?>><?php echo $Page->Biaya_Materai->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->NamaMarketing->Visible) { ?>
		<td data-field="NamaMarketing"<?php echo $Page->NamaMarketing->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_NamaMarketing"<?php echo $Page->NamaMarketing->ViewAttributes() ?>><?php echo $Page->NamaMarketing->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Periode->Visible) { ?>
		<td data-field="Periode"<?php echo $Page->Periode->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Periode"<?php echo $Page->Periode->ViewAttributes() ?>><?php echo $Page->Periode->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Macet->Visible) { ?>
		<td data-field="Macet"<?php echo $Page->Macet->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r01_pinjaman_Macet"<?php echo $Page->Macet->ViewAttributes() ?>><?php echo $Page->Macet->ListViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->AccumulateSummary();

		// Get next record
		$Page->GetRow(2);
	$Page->GrpCount++;
} // End while
?>
<?php if ($Page->TotalGrps > 0) { ?>
</tbody>
<tfoot>
<?php
	$Page->Pinjaman->Count = $Page->GrandCnt[5];
	$Page->Pinjaman->SumValue = $Page->GrandSmry[5]; // Load SUM
	$Page->ResetAttrs();
	$Page->RowType = EWR_ROWTYPE_TOTAL;
	$Page->RowTotalType = EWR_ROWTOTAL_GRAND;
	$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ewRptGrandSummary";
	$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes() ?>><td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->TotCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Page->RowAttributes() ?>>
<?php if ($Page->Kontrak_No->Visible) { ?>
		<td data-field="Kontrak_No"<?php echo $Page->Kontrak_No->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Kontrak_Tgl->Visible) { ?>
		<td data-field="Kontrak_Tgl"<?php echo $Page->Kontrak_Tgl->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NamaNasabah->Visible) { ?>
		<td data-field="NamaNasabah"<?php echo $Page->NamaNasabah->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NamaJaminan->Visible) { ?>
		<td data-field="NamaJaminan"<?php echo $Page->NamaJaminan->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Pinjaman->Visible) { ?>
		<td data-field="Pinjaman"<?php echo $Page->Pinjaman->CellAttributes() ?>><span class="ewAggregate"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateColon") ?>
<span data-class="tpts_r01_pinjaman_Pinjaman"<?php echo $Page->Pinjaman->ViewAttributes() ?>><?php echo $Page->Pinjaman->SumViewValue ?></span></td>
<?php } ?>
<?php if ($Page->Angsuran_Lama->Visible) { ?>
		<td data-field="Angsuran_Lama"<?php echo $Page->Angsuran_Lama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Angsuran_Bunga_Prosen->Visible) { ?>
		<td data-field="Angsuran_Bunga_Prosen"<?php echo $Page->Angsuran_Bunga_Prosen->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Angsuran_Denda->Visible) { ?>
		<td data-field="Angsuran_Denda"<?php echo $Page->Angsuran_Denda->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Dispensasi_Denda->Visible) { ?>
		<td data-field="Dispensasi_Denda"<?php echo $Page->Dispensasi_Denda->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Angsuran_Pokok->Visible) { ?>
		<td data-field="Angsuran_Pokok"<?php echo $Page->Angsuran_Pokok->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Angsuran_Bunga->Visible) { ?>
		<td data-field="Angsuran_Bunga"<?php echo $Page->Angsuran_Bunga->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Angsuran_Total->Visible) { ?>
		<td data-field="Angsuran_Total"<?php echo $Page->Angsuran_Total->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->No_Ref->Visible) { ?>
		<td data-field="No_Ref"<?php echo $Page->No_Ref->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Biaya_Administrasi->Visible) { ?>
		<td data-field="Biaya_Administrasi"<?php echo $Page->Biaya_Administrasi->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Biaya_Materai->Visible) { ?>
		<td data-field="Biaya_Materai"<?php echo $Page->Biaya_Materai->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NamaMarketing->Visible) { ?>
		<td data-field="NamaMarketing"<?php echo $Page->NamaMarketing->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Periode->Visible) { ?>
		<td data-field="Periode"<?php echo $Page->Periode->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Macet->Visible) { ?>
		<td data-field="Macet"<?php echo $Page->Macet->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGrps > 0 || FALSE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php include "r01_pinjamansmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- center container - report (end) -->
	<!-- right container (begin) -->
	<div id="ewRight" class="ewRight">
<?php } ?>
	<!-- Right slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- right container (end) -->
<div class="clearfix"></div>
<!-- bottom container (begin) -->
<div id="ewBottom" class="ewBottom">
<?php } ?>
	<!-- Bottom slot -->
<?php if ($Page->Export == "") { ?>
	</div>
<!-- Bottom Container (End) -->
</div>
<!-- Table Container (End) -->
<?php } ?>
<?php $Page->ShowPageFooter(); ?>
<?php if (EWR_DEBUG_ENABLED) echo ewr_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "phprptinc/footer.php" ?>
<?php include_once "footer.php" ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
