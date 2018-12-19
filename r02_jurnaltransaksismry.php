<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg10.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "phprptinc/ewrfn10.php" ?>
<?php include_once "phprptinc/ewrusrfn10.php" ?>
<?php include_once "r02_jurnaltransaksismryinfo.php" ?>
<?php

//
// Page class
//

$r02_jurnaltransaksi_summary = NULL; // Initialize page object first

class crr02_jurnaltransaksi_summary extends crr02_jurnaltransaksi {

	// Page ID
	var $PageID = 'summary';

	// Project ID
	var $ProjectID = "{34C67914-04B8-4CBF-A6F8-355DA216289E}";

	// Page object name
	var $PageObjName = 'r02_jurnaltransaksi_summary';

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

		// Table object (r02_jurnaltransaksi)
		if (!isset($GLOBALS["r02_jurnaltransaksi"])) {
			$GLOBALS["r02_jurnaltransaksi"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["r02_jurnaltransaksi"];
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
			define("EWR_TABLE_NAME", 'r02_jurnaltransaksi', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fr02_jurnaltransaksisummary";

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
		$Security->LoadCurrentUserLevel($this->ProjectID . 'r02_jurnaltransaksi');
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
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_r02_jurnaltransaksi\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_r02_jurnaltransaksi',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fr02_jurnaltransaksisummary\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fr02_jurnaltransaksisummary\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fr02_jurnaltransaksisummary\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
		$item->Visible = FALSE;

		// Reset filter
		$item = &$this->SearchOptions->Add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . ewr_CurrentPage() . "?cmd=reset'\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</button>";
		$item->Visible = FALSE && $this->FilterApplied;

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
	var $DisplayGrps = 10; // Groups per page
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
		$this->id->SetVisibility();
		$this->pinjaman_id->SetVisibility();
		$this->tanggal->SetVisibility();
		$this->periode->SetVisibility();
		$this->model->SetVisibility();
		$this->rekening->SetVisibility();
		$this->debet->SetVisibility();
		$this->credit->SetVisibility();
		$this->pembayaran_->SetVisibility();
		$this->bunga_->SetVisibility();
		$this->denda_->SetVisibility();
		$this->titipan_->SetVisibility();
		$this->administrasi_->SetVisibility();
		$this->modal_->SetVisibility();
		$this->pinjaman_->SetVisibility();
		$this->biaya_->SetVisibility();
		$this->keterangan->SetVisibility();
		$this->active->SetVisibility();

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
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

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

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// No filter
		$this->FilterApplied = FALSE;
		$this->FilterOptions->GetItem("savecurrentfilter")->Visible = FALSE;
		$this->FilterOptions->GetItem("deletefilter")->Visible = FALSE;

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
				$this->FirstRowData['pinjaman_id'] = ewr_Conv($rs->fields('pinjaman_id'), 3);
				$this->FirstRowData['tanggal'] = ewr_Conv($rs->fields('tanggal'), 135);
				$this->FirstRowData['periode'] = ewr_Conv($rs->fields('periode'), 200);
				$this->FirstRowData['model'] = ewr_Conv($rs->fields('model'), 200);
				$this->FirstRowData['rekening'] = ewr_Conv($rs->fields('rekening'), 200);
				$this->FirstRowData['debet'] = ewr_Conv($rs->fields('debet'), 5);
				$this->FirstRowData['credit'] = ewr_Conv($rs->fields('credit'), 5);
				$this->FirstRowData['pembayaran_'] = ewr_Conv($rs->fields('pembayaran_'), 5);
				$this->FirstRowData['bunga_'] = ewr_Conv($rs->fields('bunga_'), 5);
				$this->FirstRowData['denda_'] = ewr_Conv($rs->fields('denda_'), 5);
				$this->FirstRowData['titipan_'] = ewr_Conv($rs->fields('titipan_'), 5);
				$this->FirstRowData['administrasi_'] = ewr_Conv($rs->fields('administrasi_'), 5);
				$this->FirstRowData['modal_'] = ewr_Conv($rs->fields('modal_'), 5);
				$this->FirstRowData['pinjaman_'] = ewr_Conv($rs->fields('pinjaman_'), 5);
				$this->FirstRowData['biaya_'] = ewr_Conv($rs->fields('biaya_'), 5);
				$this->FirstRowData['keterangan'] = ewr_Conv($rs->fields('keterangan'), 200);
				$this->FirstRowData['active'] = ewr_Conv($rs->fields('active'), 202);
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$this->id->setDbValue($rs->fields('id'));
			$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
			$this->tanggal->setDbValue($rs->fields('tanggal'));
			$this->periode->setDbValue($rs->fields('periode'));
			$this->model->setDbValue($rs->fields('model'));
			$this->rekening->setDbValue($rs->fields('rekening'));
			$this->debet->setDbValue($rs->fields('debet'));
			$this->credit->setDbValue($rs->fields('credit'));
			$this->pembayaran_->setDbValue($rs->fields('pembayaran_'));
			$this->bunga_->setDbValue($rs->fields('bunga_'));
			$this->denda_->setDbValue($rs->fields('denda_'));
			$this->titipan_->setDbValue($rs->fields('titipan_'));
			$this->administrasi_->setDbValue($rs->fields('administrasi_'));
			$this->modal_->setDbValue($rs->fields('modal_'));
			$this->pinjaman_->setDbValue($rs->fields('pinjaman_'));
			$this->biaya_->setDbValue($rs->fields('biaya_'));
			$this->keterangan->setDbValue($rs->fields('keterangan'));
			$this->active->setDbValue($rs->fields('active'));
			$this->Val[1] = $this->id->CurrentValue;
			$this->Val[2] = $this->pinjaman_id->CurrentValue;
			$this->Val[3] = $this->tanggal->CurrentValue;
			$this->Val[4] = $this->periode->CurrentValue;
			$this->Val[5] = $this->model->CurrentValue;
			$this->Val[6] = $this->rekening->CurrentValue;
			$this->Val[7] = $this->debet->CurrentValue;
			$this->Val[8] = $this->credit->CurrentValue;
			$this->Val[9] = $this->pembayaran_->CurrentValue;
			$this->Val[10] = $this->bunga_->CurrentValue;
			$this->Val[11] = $this->denda_->CurrentValue;
			$this->Val[12] = $this->titipan_->CurrentValue;
			$this->Val[13] = $this->administrasi_->CurrentValue;
			$this->Val[14] = $this->modal_->CurrentValue;
			$this->Val[15] = $this->pinjaman_->CurrentValue;
			$this->Val[16] = $this->biaya_->CurrentValue;
			$this->Val[17] = $this->keterangan->CurrentValue;
			$this->Val[18] = $this->active->CurrentValue;
		} else {
			$this->id->setDbValue("");
			$this->pinjaman_id->setDbValue("");
			$this->tanggal->setDbValue("");
			$this->periode->setDbValue("");
			$this->model->setDbValue("");
			$this->rekening->setDbValue("");
			$this->debet->setDbValue("");
			$this->credit->setDbValue("");
			$this->pembayaran_->setDbValue("");
			$this->bunga_->setDbValue("");
			$this->denda_->setDbValue("");
			$this->titipan_->setDbValue("");
			$this->administrasi_->setDbValue("");
			$this->modal_->setDbValue("");
			$this->pinjaman_->setDbValue("");
			$this->biaya_->setDbValue("");
			$this->keterangan->setDbValue("");
			$this->active->setDbValue("");
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
					$this->DisplayGrps = 10; // Non-numeric, load default
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
				$this->DisplayGrps = 10; // Load default
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
		$bGotSummary = TRUE;

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

			// id
			$this->id->HrefValue = "";

			// pinjaman_id
			$this->pinjaman_id->HrefValue = "";

			// tanggal
			$this->tanggal->HrefValue = "";

			// periode
			$this->periode->HrefValue = "";

			// model
			$this->model->HrefValue = "";

			// rekening
			$this->rekening->HrefValue = "";

			// debet
			$this->debet->HrefValue = "";

			// credit
			$this->credit->HrefValue = "";

			// pembayaran_
			$this->pembayaran_->HrefValue = "";

			// bunga_
			$this->bunga_->HrefValue = "";

			// denda_
			$this->denda_->HrefValue = "";

			// titipan_
			$this->titipan_->HrefValue = "";

			// administrasi_
			$this->administrasi_->HrefValue = "";

			// modal_
			$this->modal_->HrefValue = "";

			// pinjaman_
			$this->pinjaman_->HrefValue = "";

			// biaya_
			$this->biaya_->HrefValue = "";

			// keterangan
			$this->keterangan->HrefValue = "";

			// active
			$this->active->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			} else {
			}

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pinjaman_id
			$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
			$this->pinjaman_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = ewr_FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// periode
			$this->periode->ViewValue = $this->periode->CurrentValue;
			$this->periode->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// model
			$this->model->ViewValue = $this->model->CurrentValue;
			$this->model->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// rekening
			$this->rekening->ViewValue = $this->rekening->CurrentValue;
			$this->rekening->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// debet
			$this->debet->ViewValue = $this->debet->CurrentValue;
			$this->debet->ViewValue = ewr_FormatNumber($this->debet->ViewValue, $this->debet->DefaultDecimalPrecision, -1, 0, 0);
			$this->debet->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// credit
			$this->credit->ViewValue = $this->credit->CurrentValue;
			$this->credit->ViewValue = ewr_FormatNumber($this->credit->ViewValue, $this->credit->DefaultDecimalPrecision, -1, 0, 0);
			$this->credit->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pembayaran_
			$this->pembayaran_->ViewValue = $this->pembayaran_->CurrentValue;
			$this->pembayaran_->ViewValue = ewr_FormatNumber($this->pembayaran_->ViewValue, $this->pembayaran_->DefaultDecimalPrecision, -1, 0, 0);
			$this->pembayaran_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bunga_
			$this->bunga_->ViewValue = $this->bunga_->CurrentValue;
			$this->bunga_->ViewValue = ewr_FormatNumber($this->bunga_->ViewValue, $this->bunga_->DefaultDecimalPrecision, -1, 0, 0);
			$this->bunga_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// denda_
			$this->denda_->ViewValue = $this->denda_->CurrentValue;
			$this->denda_->ViewValue = ewr_FormatNumber($this->denda_->ViewValue, $this->denda_->DefaultDecimalPrecision, -1, 0, 0);
			$this->denda_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// titipan_
			$this->titipan_->ViewValue = $this->titipan_->CurrentValue;
			$this->titipan_->ViewValue = ewr_FormatNumber($this->titipan_->ViewValue, $this->titipan_->DefaultDecimalPrecision, -1, 0, 0);
			$this->titipan_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// administrasi_
			$this->administrasi_->ViewValue = $this->administrasi_->CurrentValue;
			$this->administrasi_->ViewValue = ewr_FormatNumber($this->administrasi_->ViewValue, $this->administrasi_->DefaultDecimalPrecision, -1, 0, 0);
			$this->administrasi_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// modal_
			$this->modal_->ViewValue = $this->modal_->CurrentValue;
			$this->modal_->ViewValue = ewr_FormatNumber($this->modal_->ViewValue, $this->modal_->DefaultDecimalPrecision, -1, 0, 0);
			$this->modal_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pinjaman_
			$this->pinjaman_->ViewValue = $this->pinjaman_->CurrentValue;
			$this->pinjaman_->ViewValue = ewr_FormatNumber($this->pinjaman_->ViewValue, $this->pinjaman_->DefaultDecimalPrecision, -1, 0, 0);
			$this->pinjaman_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// biaya_
			$this->biaya_->ViewValue = $this->biaya_->CurrentValue;
			$this->biaya_->ViewValue = ewr_FormatNumber($this->biaya_->ViewValue, $this->biaya_->DefaultDecimalPrecision, -1, 0, 0);
			$this->biaya_->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// active
			$this->active->ViewValue = $this->active->CurrentValue;
			$this->active->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id
			$this->id->HrefValue = "";

			// pinjaman_id
			$this->pinjaman_id->HrefValue = "";

			// tanggal
			$this->tanggal->HrefValue = "";

			// periode
			$this->periode->HrefValue = "";

			// model
			$this->model->HrefValue = "";

			// rekening
			$this->rekening->HrefValue = "";

			// debet
			$this->debet->HrefValue = "";

			// credit
			$this->credit->HrefValue = "";

			// pembayaran_
			$this->pembayaran_->HrefValue = "";

			// bunga_
			$this->bunga_->HrefValue = "";

			// denda_
			$this->denda_->HrefValue = "";

			// titipan_
			$this->titipan_->HrefValue = "";

			// administrasi_
			$this->administrasi_->HrefValue = "";

			// modal_
			$this->modal_->HrefValue = "";

			// pinjaman_
			$this->pinjaman_->HrefValue = "";

			// biaya_
			$this->biaya_->HrefValue = "";

			// keterangan
			$this->keterangan->HrefValue = "";

			// active
			$this->active->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row
		} else {

			// id
			$CurrentValue = $this->id->CurrentValue;
			$ViewValue = &$this->id->ViewValue;
			$ViewAttrs = &$this->id->ViewAttrs;
			$CellAttrs = &$this->id->CellAttrs;
			$HrefValue = &$this->id->HrefValue;
			$LinkAttrs = &$this->id->LinkAttrs;
			$this->Cell_Rendered($this->id, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// pinjaman_id
			$CurrentValue = $this->pinjaman_id->CurrentValue;
			$ViewValue = &$this->pinjaman_id->ViewValue;
			$ViewAttrs = &$this->pinjaman_id->ViewAttrs;
			$CellAttrs = &$this->pinjaman_id->CellAttrs;
			$HrefValue = &$this->pinjaman_id->HrefValue;
			$LinkAttrs = &$this->pinjaman_id->LinkAttrs;
			$this->Cell_Rendered($this->pinjaman_id, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// tanggal
			$CurrentValue = $this->tanggal->CurrentValue;
			$ViewValue = &$this->tanggal->ViewValue;
			$ViewAttrs = &$this->tanggal->ViewAttrs;
			$CellAttrs = &$this->tanggal->CellAttrs;
			$HrefValue = &$this->tanggal->HrefValue;
			$LinkAttrs = &$this->tanggal->LinkAttrs;
			$this->Cell_Rendered($this->tanggal, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// periode
			$CurrentValue = $this->periode->CurrentValue;
			$ViewValue = &$this->periode->ViewValue;
			$ViewAttrs = &$this->periode->ViewAttrs;
			$CellAttrs = &$this->periode->CellAttrs;
			$HrefValue = &$this->periode->HrefValue;
			$LinkAttrs = &$this->periode->LinkAttrs;
			$this->Cell_Rendered($this->periode, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// model
			$CurrentValue = $this->model->CurrentValue;
			$ViewValue = &$this->model->ViewValue;
			$ViewAttrs = &$this->model->ViewAttrs;
			$CellAttrs = &$this->model->CellAttrs;
			$HrefValue = &$this->model->HrefValue;
			$LinkAttrs = &$this->model->LinkAttrs;
			$this->Cell_Rendered($this->model, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// rekening
			$CurrentValue = $this->rekening->CurrentValue;
			$ViewValue = &$this->rekening->ViewValue;
			$ViewAttrs = &$this->rekening->ViewAttrs;
			$CellAttrs = &$this->rekening->CellAttrs;
			$HrefValue = &$this->rekening->HrefValue;
			$LinkAttrs = &$this->rekening->LinkAttrs;
			$this->Cell_Rendered($this->rekening, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// debet
			$CurrentValue = $this->debet->CurrentValue;
			$ViewValue = &$this->debet->ViewValue;
			$ViewAttrs = &$this->debet->ViewAttrs;
			$CellAttrs = &$this->debet->CellAttrs;
			$HrefValue = &$this->debet->HrefValue;
			$LinkAttrs = &$this->debet->LinkAttrs;
			$this->Cell_Rendered($this->debet, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// credit
			$CurrentValue = $this->credit->CurrentValue;
			$ViewValue = &$this->credit->ViewValue;
			$ViewAttrs = &$this->credit->ViewAttrs;
			$CellAttrs = &$this->credit->CellAttrs;
			$HrefValue = &$this->credit->HrefValue;
			$LinkAttrs = &$this->credit->LinkAttrs;
			$this->Cell_Rendered($this->credit, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// pembayaran_
			$CurrentValue = $this->pembayaran_->CurrentValue;
			$ViewValue = &$this->pembayaran_->ViewValue;
			$ViewAttrs = &$this->pembayaran_->ViewAttrs;
			$CellAttrs = &$this->pembayaran_->CellAttrs;
			$HrefValue = &$this->pembayaran_->HrefValue;
			$LinkAttrs = &$this->pembayaran_->LinkAttrs;
			$this->Cell_Rendered($this->pembayaran_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// bunga_
			$CurrentValue = $this->bunga_->CurrentValue;
			$ViewValue = &$this->bunga_->ViewValue;
			$ViewAttrs = &$this->bunga_->ViewAttrs;
			$CellAttrs = &$this->bunga_->CellAttrs;
			$HrefValue = &$this->bunga_->HrefValue;
			$LinkAttrs = &$this->bunga_->LinkAttrs;
			$this->Cell_Rendered($this->bunga_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// denda_
			$CurrentValue = $this->denda_->CurrentValue;
			$ViewValue = &$this->denda_->ViewValue;
			$ViewAttrs = &$this->denda_->ViewAttrs;
			$CellAttrs = &$this->denda_->CellAttrs;
			$HrefValue = &$this->denda_->HrefValue;
			$LinkAttrs = &$this->denda_->LinkAttrs;
			$this->Cell_Rendered($this->denda_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// titipan_
			$CurrentValue = $this->titipan_->CurrentValue;
			$ViewValue = &$this->titipan_->ViewValue;
			$ViewAttrs = &$this->titipan_->ViewAttrs;
			$CellAttrs = &$this->titipan_->CellAttrs;
			$HrefValue = &$this->titipan_->HrefValue;
			$LinkAttrs = &$this->titipan_->LinkAttrs;
			$this->Cell_Rendered($this->titipan_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// administrasi_
			$CurrentValue = $this->administrasi_->CurrentValue;
			$ViewValue = &$this->administrasi_->ViewValue;
			$ViewAttrs = &$this->administrasi_->ViewAttrs;
			$CellAttrs = &$this->administrasi_->CellAttrs;
			$HrefValue = &$this->administrasi_->HrefValue;
			$LinkAttrs = &$this->administrasi_->LinkAttrs;
			$this->Cell_Rendered($this->administrasi_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// modal_
			$CurrentValue = $this->modal_->CurrentValue;
			$ViewValue = &$this->modal_->ViewValue;
			$ViewAttrs = &$this->modal_->ViewAttrs;
			$CellAttrs = &$this->modal_->CellAttrs;
			$HrefValue = &$this->modal_->HrefValue;
			$LinkAttrs = &$this->modal_->LinkAttrs;
			$this->Cell_Rendered($this->modal_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// pinjaman_
			$CurrentValue = $this->pinjaman_->CurrentValue;
			$ViewValue = &$this->pinjaman_->ViewValue;
			$ViewAttrs = &$this->pinjaman_->ViewAttrs;
			$CellAttrs = &$this->pinjaman_->CellAttrs;
			$HrefValue = &$this->pinjaman_->HrefValue;
			$LinkAttrs = &$this->pinjaman_->LinkAttrs;
			$this->Cell_Rendered($this->pinjaman_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// biaya_
			$CurrentValue = $this->biaya_->CurrentValue;
			$ViewValue = &$this->biaya_->ViewValue;
			$ViewAttrs = &$this->biaya_->ViewAttrs;
			$CellAttrs = &$this->biaya_->CellAttrs;
			$HrefValue = &$this->biaya_->HrefValue;
			$LinkAttrs = &$this->biaya_->LinkAttrs;
			$this->Cell_Rendered($this->biaya_, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// keterangan
			$CurrentValue = $this->keterangan->CurrentValue;
			$ViewValue = &$this->keterangan->ViewValue;
			$ViewAttrs = &$this->keterangan->ViewAttrs;
			$CellAttrs = &$this->keterangan->CellAttrs;
			$HrefValue = &$this->keterangan->HrefValue;
			$LinkAttrs = &$this->keterangan->LinkAttrs;
			$this->Cell_Rendered($this->keterangan, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// active
			$CurrentValue = $this->active->CurrentValue;
			$ViewValue = &$this->active->ViewValue;
			$ViewAttrs = &$this->active->ViewAttrs;
			$CellAttrs = &$this->active->CellAttrs;
			$HrefValue = &$this->active->HrefValue;
			$LinkAttrs = &$this->active->LinkAttrs;
			$this->Cell_Rendered($this->active, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
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
		if ($this->id->Visible) $this->DtlColumnCount += 1;
		if ($this->pinjaman_id->Visible) $this->DtlColumnCount += 1;
		if ($this->tanggal->Visible) $this->DtlColumnCount += 1;
		if ($this->periode->Visible) $this->DtlColumnCount += 1;
		if ($this->model->Visible) $this->DtlColumnCount += 1;
		if ($this->rekening->Visible) $this->DtlColumnCount += 1;
		if ($this->debet->Visible) $this->DtlColumnCount += 1;
		if ($this->credit->Visible) $this->DtlColumnCount += 1;
		if ($this->pembayaran_->Visible) $this->DtlColumnCount += 1;
		if ($this->bunga_->Visible) $this->DtlColumnCount += 1;
		if ($this->denda_->Visible) $this->DtlColumnCount += 1;
		if ($this->titipan_->Visible) $this->DtlColumnCount += 1;
		if ($this->administrasi_->Visible) $this->DtlColumnCount += 1;
		if ($this->modal_->Visible) $this->DtlColumnCount += 1;
		if ($this->pinjaman_->Visible) $this->DtlColumnCount += 1;
		if ($this->biaya_->Visible) $this->DtlColumnCount += 1;
		if ($this->keterangan->Visible) $this->DtlColumnCount += 1;
		if ($this->active->Visible) $this->DtlColumnCount += 1;
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
			return "";
		$bResetSort = @$options["resetsort"] == "1" || @$_GET["cmd"] == "resetsort";
		$orderBy = (@$options["order"] <> "") ? @$options["order"] : ewr_StripSlashes(@$_GET["order"]);
		$orderType = (@$options["ordertype"] <> "") ? @$options["ordertype"] : ewr_StripSlashes(@$_GET["ordertype"]);

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for a resetsort command
		if ($bResetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->id->setSort("");
			$this->pinjaman_id->setSort("");
			$this->tanggal->setSort("");
			$this->periode->setSort("");
			$this->model->setSort("");
			$this->rekening->setSort("");
			$this->debet->setSort("");
			$this->credit->setSort("");
			$this->pembayaran_->setSort("");
			$this->bunga_->setSort("");
			$this->denda_->setSort("");
			$this->titipan_->setSort("");
			$this->administrasi_->setSort("");
			$this->modal_->setSort("");
			$this->pinjaman_->setSort("");
			$this->biaya_->setSort("");
			$this->keterangan->setSort("");
			$this->active->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->UpdateSort($this->id, $bCtrl); // id
			$this->UpdateSort($this->pinjaman_id, $bCtrl); // pinjaman_id
			$this->UpdateSort($this->tanggal, $bCtrl); // tanggal
			$this->UpdateSort($this->periode, $bCtrl); // periode
			$this->UpdateSort($this->model, $bCtrl); // model
			$this->UpdateSort($this->rekening, $bCtrl); // rekening
			$this->UpdateSort($this->debet, $bCtrl); // debet
			$this->UpdateSort($this->credit, $bCtrl); // credit
			$this->UpdateSort($this->pembayaran_, $bCtrl); // pembayaran_
			$this->UpdateSort($this->bunga_, $bCtrl); // bunga_
			$this->UpdateSort($this->denda_, $bCtrl); // denda_
			$this->UpdateSort($this->titipan_, $bCtrl); // titipan_
			$this->UpdateSort($this->administrasi_, $bCtrl); // administrasi_
			$this->UpdateSort($this->modal_, $bCtrl); // modal_
			$this->UpdateSort($this->pinjaman_, $bCtrl); // pinjaman_
			$this->UpdateSort($this->biaya_, $bCtrl); // biaya_
			$this->UpdateSort($this->keterangan, $bCtrl); // keterangan
			$this->UpdateSort($this->active, $bCtrl); // active
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
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
if (!isset($r02_jurnaltransaksi_summary)) $r02_jurnaltransaksi_summary = new crr02_jurnaltransaksi_summary();
if (isset($Page)) $OldPage = $Page;
$Page = &$r02_jurnaltransaksi_summary;

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
var r02_jurnaltransaksi_summary = new ewr_Page("r02_jurnaltransaksi_summary");

// Page properties
r02_jurnaltransaksi_summary.PageID = "summary"; // Page ID
var EWR_PAGE_ID = r02_jurnaltransaksi_summary.PageID;

// Extend page with Chart_Rendering function
r02_jurnaltransaksi_summary.Chart_Rendering = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }

// Extend page with Chart_Rendered function
r02_jurnaltransaksi_summary.Chart_Rendered = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
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
<?php if ($Page->id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="id"><div class="r02_jurnaltransaksi_id"><span class="ewTableHeaderCaption"><?php echo $Page->id->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="id">
<?php if ($Page->SortUrl($Page->id) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_id">
			<span class="ewTableHeaderCaption"><?php echo $Page->id->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_id" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->id) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->id->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pinjaman_id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pinjaman_id"><div class="r02_jurnaltransaksi_pinjaman_id"><span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_id->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pinjaman_id">
<?php if ($Page->SortUrl($Page->pinjaman_id) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_pinjaman_id">
			<span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_id->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_pinjaman_id" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->pinjaman_id) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_id->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->pinjaman_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->pinjaman_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->tanggal->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="tanggal"><div class="r02_jurnaltransaksi_tanggal"><span class="ewTableHeaderCaption"><?php echo $Page->tanggal->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="tanggal">
<?php if ($Page->SortUrl($Page->tanggal) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_tanggal">
			<span class="ewTableHeaderCaption"><?php echo $Page->tanggal->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_tanggal" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->tanggal) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->tanggal->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->tanggal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->tanggal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->periode->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="periode"><div class="r02_jurnaltransaksi_periode"><span class="ewTableHeaderCaption"><?php echo $Page->periode->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="periode">
<?php if ($Page->SortUrl($Page->periode) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_periode">
			<span class="ewTableHeaderCaption"><?php echo $Page->periode->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_periode" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->periode) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->periode->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->model->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="model"><div class="r02_jurnaltransaksi_model"><span class="ewTableHeaderCaption"><?php echo $Page->model->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="model">
<?php if ($Page->SortUrl($Page->model) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_model">
			<span class="ewTableHeaderCaption"><?php echo $Page->model->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_model" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->model) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->model->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->model->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->model->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->rekening->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="rekening"><div class="r02_jurnaltransaksi_rekening"><span class="ewTableHeaderCaption"><?php echo $Page->rekening->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="rekening">
<?php if ($Page->SortUrl($Page->rekening) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_rekening">
			<span class="ewTableHeaderCaption"><?php echo $Page->rekening->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_rekening" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->rekening) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->rekening->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->rekening->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->rekening->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->debet->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="debet"><div class="r02_jurnaltransaksi_debet"><span class="ewTableHeaderCaption"><?php echo $Page->debet->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="debet">
<?php if ($Page->SortUrl($Page->debet) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_debet">
			<span class="ewTableHeaderCaption"><?php echo $Page->debet->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_debet" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->debet) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->debet->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->debet->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->debet->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->credit->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="credit"><div class="r02_jurnaltransaksi_credit"><span class="ewTableHeaderCaption"><?php echo $Page->credit->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="credit">
<?php if ($Page->SortUrl($Page->credit) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_credit">
			<span class="ewTableHeaderCaption"><?php echo $Page->credit->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_credit" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->credit) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->credit->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->credit->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->credit->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pembayaran_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pembayaran_"><div class="r02_jurnaltransaksi_pembayaran_"><span class="ewTableHeaderCaption"><?php echo $Page->pembayaran_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pembayaran_">
<?php if ($Page->SortUrl($Page->pembayaran_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_pembayaran_">
			<span class="ewTableHeaderCaption"><?php echo $Page->pembayaran_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_pembayaran_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->pembayaran_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->pembayaran_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->pembayaran_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->pembayaran_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->bunga_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="bunga_"><div class="r02_jurnaltransaksi_bunga_"><span class="ewTableHeaderCaption"><?php echo $Page->bunga_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="bunga_">
<?php if ($Page->SortUrl($Page->bunga_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_bunga_">
			<span class="ewTableHeaderCaption"><?php echo $Page->bunga_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_bunga_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->bunga_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->bunga_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->bunga_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->bunga_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->denda_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="denda_"><div class="r02_jurnaltransaksi_denda_"><span class="ewTableHeaderCaption"><?php echo $Page->denda_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="denda_">
<?php if ($Page->SortUrl($Page->denda_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_denda_">
			<span class="ewTableHeaderCaption"><?php echo $Page->denda_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_denda_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->denda_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->denda_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->denda_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->denda_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->titipan_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="titipan_"><div class="r02_jurnaltransaksi_titipan_"><span class="ewTableHeaderCaption"><?php echo $Page->titipan_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="titipan_">
<?php if ($Page->SortUrl($Page->titipan_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_titipan_">
			<span class="ewTableHeaderCaption"><?php echo $Page->titipan_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_titipan_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->titipan_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->titipan_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->titipan_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->titipan_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->administrasi_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="administrasi_"><div class="r02_jurnaltransaksi_administrasi_"><span class="ewTableHeaderCaption"><?php echo $Page->administrasi_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="administrasi_">
<?php if ($Page->SortUrl($Page->administrasi_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_administrasi_">
			<span class="ewTableHeaderCaption"><?php echo $Page->administrasi_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_administrasi_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->administrasi_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->administrasi_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->administrasi_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->administrasi_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->modal_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="modal_"><div class="r02_jurnaltransaksi_modal_"><span class="ewTableHeaderCaption"><?php echo $Page->modal_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="modal_">
<?php if ($Page->SortUrl($Page->modal_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_modal_">
			<span class="ewTableHeaderCaption"><?php echo $Page->modal_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_modal_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->modal_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->modal_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->modal_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->modal_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pinjaman_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pinjaman_"><div class="r02_jurnaltransaksi_pinjaman_"><span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pinjaman_">
<?php if ($Page->SortUrl($Page->pinjaman_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_pinjaman_">
			<span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_pinjaman_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->pinjaman_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->pinjaman_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->pinjaman_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->pinjaman_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->biaya_->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="biaya_"><div class="r02_jurnaltransaksi_biaya_"><span class="ewTableHeaderCaption"><?php echo $Page->biaya_->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="biaya_">
<?php if ($Page->SortUrl($Page->biaya_) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_biaya_">
			<span class="ewTableHeaderCaption"><?php echo $Page->biaya_->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_biaya_" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->biaya_) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->biaya_->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->biaya_->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->biaya_->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->keterangan->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="keterangan"><div class="r02_jurnaltransaksi_keterangan"><span class="ewTableHeaderCaption"><?php echo $Page->keterangan->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="keterangan">
<?php if ($Page->SortUrl($Page->keterangan) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_keterangan">
			<span class="ewTableHeaderCaption"><?php echo $Page->keterangan->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_keterangan" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->keterangan) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->keterangan->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->active->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="active"><div class="r02_jurnaltransaksi_active"><span class="ewTableHeaderCaption"><?php echo $Page->active->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="active">
<?php if ($Page->SortUrl($Page->active) == "") { ?>
		<div class="ewTableHeaderBtn r02_jurnaltransaksi_active">
			<span class="ewTableHeaderCaption"><?php echo $Page->active->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_jurnaltransaksi_active" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->active) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->active->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->active->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->active->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
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
<?php if ($Page->id->Visible) { ?>
		<td data-field="id"<?php echo $Page->id->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_id"<?php echo $Page->id->ViewAttributes() ?>><?php echo $Page->id->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pinjaman_id->Visible) { ?>
		<td data-field="pinjaman_id"<?php echo $Page->pinjaman_id->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_pinjaman_id"<?php echo $Page->pinjaman_id->ViewAttributes() ?>><?php echo $Page->pinjaman_id->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $Page->tanggal->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_tanggal"<?php echo $Page->tanggal->ViewAttributes() ?>><?php echo $Page->tanggal->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->periode->Visible) { ?>
		<td data-field="periode"<?php echo $Page->periode->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_periode"<?php echo $Page->periode->ViewAttributes() ?>><?php echo $Page->periode->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->model->Visible) { ?>
		<td data-field="model"<?php echo $Page->model->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_model"<?php echo $Page->model->ViewAttributes() ?>><?php echo $Page->model->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->rekening->Visible) { ?>
		<td data-field="rekening"<?php echo $Page->rekening->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_rekening"<?php echo $Page->rekening->ViewAttributes() ?>><?php echo $Page->rekening->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->debet->Visible) { ?>
		<td data-field="debet"<?php echo $Page->debet->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_debet"<?php echo $Page->debet->ViewAttributes() ?>><?php echo $Page->debet->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->credit->Visible) { ?>
		<td data-field="credit"<?php echo $Page->credit->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_credit"<?php echo $Page->credit->ViewAttributes() ?>><?php echo $Page->credit->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pembayaran_->Visible) { ?>
		<td data-field="pembayaran_"<?php echo $Page->pembayaran_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_pembayaran_"<?php echo $Page->pembayaran_->ViewAttributes() ?>><?php echo $Page->pembayaran_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->bunga_->Visible) { ?>
		<td data-field="bunga_"<?php echo $Page->bunga_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_bunga_"<?php echo $Page->bunga_->ViewAttributes() ?>><?php echo $Page->bunga_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->denda_->Visible) { ?>
		<td data-field="denda_"<?php echo $Page->denda_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_denda_"<?php echo $Page->denda_->ViewAttributes() ?>><?php echo $Page->denda_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->titipan_->Visible) { ?>
		<td data-field="titipan_"<?php echo $Page->titipan_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_titipan_"<?php echo $Page->titipan_->ViewAttributes() ?>><?php echo $Page->titipan_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->administrasi_->Visible) { ?>
		<td data-field="administrasi_"<?php echo $Page->administrasi_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_administrasi_"<?php echo $Page->administrasi_->ViewAttributes() ?>><?php echo $Page->administrasi_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->modal_->Visible) { ?>
		<td data-field="modal_"<?php echo $Page->modal_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_modal_"<?php echo $Page->modal_->ViewAttributes() ?>><?php echo $Page->modal_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pinjaman_->Visible) { ?>
		<td data-field="pinjaman_"<?php echo $Page->pinjaman_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_pinjaman_"<?php echo $Page->pinjaman_->ViewAttributes() ?>><?php echo $Page->pinjaman_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->biaya_->Visible) { ?>
		<td data-field="biaya_"<?php echo $Page->biaya_->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_biaya_"<?php echo $Page->biaya_->ViewAttributes() ?>><?php echo $Page->biaya_->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { ?>
		<td data-field="keterangan"<?php echo $Page->keterangan->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_keterangan"<?php echo $Page->keterangan->ViewAttributes() ?>><?php echo $Page->keterangan->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->active->Visible) { ?>
		<td data-field="active"<?php echo $Page->active->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->RecCount ?>_r02_jurnaltransaksi_active"<?php echo $Page->active->ViewAttributes() ?>><?php echo $Page->active->ListViewValue() ?></span></td>
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
	$Page->ResetAttrs();
	$Page->RowType = EWR_ROWTYPE_TOTAL;
	$Page->RowTotalType = EWR_ROWTOTAL_GRAND;
	$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ewRptGrandSummary";
	$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes() ?>><td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->TotCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td></tr>
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
<?php include "r02_jurnaltransaksismrypager.php" ?>
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
