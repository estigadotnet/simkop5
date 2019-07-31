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

$t23_deposito_view = NULL; // Initialize page object first

class ct23_deposito_view extends ct23_deposito {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't23_deposito';

	// Page object name
	var $PageObjName = 't23_deposito_view';

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
				$this->Page_Terminate(ew_GetUrl("t23_depositolist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->Kontrak_Lama->SetVisibility();
		$this->Jatuh_Tempo_Tgl->SetVisibility();
		$this->Deposito->SetVisibility();
		$this->Bunga_Suku->SetVisibility();
		$this->Bunga->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->bank_id->SetVisibility();
		$this->No_Ref->SetVisibility();
		$this->Biaya_Administrasi->SetVisibility();
		$this->Biaya_Materai->SetVisibility();
		$this->Periode->SetVisibility();
		$this->Kontrak_Status->SetVisibility();
		$this->Jatuh_Tempo_Status->SetVisibility();
		$this->Bunga_Status->SetVisibility();

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
				$sReturnUrl = "t23_depositolist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "t23_depositolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "t23_depositolist.php"; // Not page request, return to list
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

		// Set up detail parameters
		$this->SetUpDetailParms();
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
		$option = &$options["detail"];
		$DetailTableLink = "";
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_t24_deposito_detail"
		$item = &$option->Add("detail_t24_deposito_detail");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("t24_deposito_detail", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t24_deposito_detaillist.php?" . EW_TABLE_SHOW_MASTER . "=t23_deposito&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["t24_deposito_detail_grid"] && $GLOBALS["t24_deposito_detail_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 't24_deposito_detail')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "t24_deposito_detail";
		}
		if ($GLOBALS["t24_deposito_detail_grid"] && $GLOBALS["t24_deposito_detail_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't24_deposito_detail')) {
			$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
			$DetailEditTblVar .= "t24_deposito_detail";
		}
		if ($GLOBALS["t24_deposito_detail_grid"] && $GLOBALS["t24_deposito_detail_grid"]->DetailAdd && $Security->CanAdd() && $Security->AllowAdd(CurrentProjectID() . 't24_deposito_detail')) {
			$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=t24_deposito_detail")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($DetailCopyTblVar <> "") $DetailCopyTblVar .= ",";
			$DetailCopyTblVar .= "t24_deposito_detail";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't24_deposito_detail');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "t24_deposito_detail";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// Multiple details
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
			$oListOpt = &$option->Add("details");
			$oListOpt->Body = $body;
		}

		// Set up detail default
		$option = &$options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$option->UseImageAndText = TRUE;
		$ar = explode(",", $DetailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

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
		$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
		$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
		$this->Kontrak_Lama->setDbValue($rs->fields('Kontrak_Lama'));
		$this->Jatuh_Tempo_Tgl->setDbValue($rs->fields('Jatuh_Tempo_Tgl'));
		$this->Deposito->setDbValue($rs->fields('Deposito'));
		$this->Bunga_Suku->setDbValue($rs->fields('Bunga_Suku'));
		$this->Bunga->setDbValue($rs->fields('Bunga'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
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
		if ($this->Deposito->FormValue == $this->Deposito->CurrentValue && is_numeric(ew_StrToFloat($this->Deposito->CurrentValue)))
			$this->Deposito->CurrentValue = ew_StrToFloat($this->Deposito->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga_Suku->FormValue == $this->Bunga_Suku->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga_Suku->CurrentValue)))
			$this->Bunga_Suku->CurrentValue = ew_StrToFloat($this->Bunga_Suku->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Bunga->FormValue == $this->Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Bunga->CurrentValue)))
			$this->Bunga->CurrentValue = ew_StrToFloat($this->Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Administrasi->FormValue == $this->Biaya_Administrasi->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Administrasi->CurrentValue)))
			$this->Biaya_Administrasi->CurrentValue = ew_StrToFloat($this->Biaya_Administrasi->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Biaya_Materai->FormValue == $this->Biaya_Materai->CurrentValue && is_numeric(ew_StrToFloat($this->Biaya_Materai->CurrentValue)))
			$this->Biaya_Materai->CurrentValue = ew_StrToFloat($this->Biaya_Materai->CurrentValue);

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
		$this->Kontrak_Tgl->ViewValue = ew_FormatDateTime($this->Kontrak_Tgl->ViewValue, 0);
		$this->Kontrak_Tgl->ViewCustomAttributes = "";

		// Kontrak_Lama
		$this->Kontrak_Lama->ViewValue = $this->Kontrak_Lama->CurrentValue;
		$this->Kontrak_Lama->ViewCustomAttributes = "";

		// Jatuh_Tempo_Tgl
		$this->Jatuh_Tempo_Tgl->ViewValue = $this->Jatuh_Tempo_Tgl->CurrentValue;
		$this->Jatuh_Tempo_Tgl->ViewValue = ew_FormatDateTime($this->Jatuh_Tempo_Tgl->ViewValue, 0);
		$this->Jatuh_Tempo_Tgl->ViewCustomAttributes = "";

		// Deposito
		$this->Deposito->ViewValue = $this->Deposito->CurrentValue;
		$this->Deposito->ViewCustomAttributes = "";

		// Bunga_Suku
		$this->Bunga_Suku->ViewValue = $this->Bunga_Suku->CurrentValue;
		$this->Bunga_Suku->ViewCustomAttributes = "";

		// Bunga
		$this->Bunga->ViewValue = $this->Bunga->CurrentValue;
		$this->Bunga->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

		// bank_id
		$this->bank_id->ViewValue = $this->bank_id->CurrentValue;
		$this->bank_id->ViewCustomAttributes = "";

		// No_Ref
		$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->ViewCustomAttributes = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi->ViewValue = $this->Biaya_Administrasi->CurrentValue;
		$this->Biaya_Administrasi->ViewCustomAttributes = "";

		// Biaya_Materai
		$this->Biaya_Materai->ViewValue = $this->Biaya_Materai->CurrentValue;
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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

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

			// Jatuh_Tempo_Tgl
			$this->Jatuh_Tempo_Tgl->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Tgl->HrefValue = "";
			$this->Jatuh_Tempo_Tgl->TooltipValue = "";

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

			// bank_id
			$this->bank_id->LinkCustomAttributes = "";
			$this->bank_id->HrefValue = "";
			$this->bank_id->TooltipValue = "";

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

			// Periode
			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";
			$this->Periode->TooltipValue = "";

			// Kontrak_Status
			$this->Kontrak_Status->LinkCustomAttributes = "";
			$this->Kontrak_Status->HrefValue = "";
			$this->Kontrak_Status->TooltipValue = "";

			// Jatuh_Tempo_Status
			$this->Jatuh_Tempo_Status->LinkCustomAttributes = "";
			$this->Jatuh_Tempo_Status->HrefValue = "";
			$this->Jatuh_Tempo_Status->TooltipValue = "";

			// Bunga_Status
			$this->Bunga_Status->LinkCustomAttributes = "";
			$this->Bunga_Status->HrefValue = "";
			$this->Bunga_Status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t24_deposito_detail", $DetailTblVar)) {
				if (!isset($GLOBALS["t24_deposito_detail_grid"]))
					$GLOBALS["t24_deposito_detail_grid"] = new ct24_deposito_detail_grid;
				if ($GLOBALS["t24_deposito_detail_grid"]->DetailView) {
					$GLOBALS["t24_deposito_detail_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["t24_deposito_detail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t24_deposito_detail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->FldIsDetailKey = TRUE;
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t24_deposito_detail_grid"]->deposito_id->setSessionValue($GLOBALS["t24_deposito_detail_grid"]->deposito_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t23_depositolist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t23_deposito_view)) $t23_deposito_view = new ct23_deposito_view();

// Page init
$t23_deposito_view->Page_Init();

// Page main
$t23_deposito_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t23_deposito_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = ft23_depositoview = new ew_Form("ft23_depositoview", "view");

// Form_CustomValidate event
ft23_depositoview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft23_depositoview.ValidateRequired = true;
<?php } else { ?>
ft23_depositoview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft23_depositoview.Lists["x_Kontrak_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoview.Lists["x_Kontrak_Status"].Options = <?php echo json_encode($t23_deposito->Kontrak_Status->Options()) ?>;
ft23_depositoview.Lists["x_Jatuh_Tempo_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoview.Lists["x_Jatuh_Tempo_Status"].Options = <?php echo json_encode($t23_deposito->Jatuh_Tempo_Status->Options()) ?>;
ft23_depositoview.Lists["x_Bunga_Status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft23_depositoview.Lists["x_Bunga_Status"].Options = <?php echo json_encode($t23_deposito->Bunga_Status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if (!$t23_deposito_view->IsModal) { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php $t23_deposito_view->ExportOptions->Render("body") ?>
<?php
	foreach ($t23_deposito_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php if (!$t23_deposito_view->IsModal) { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php $t23_deposito_view->ShowPageHeader(); ?>
<?php
$t23_deposito_view->ShowMessage();
?>
<form name="ft23_depositoview" id="ft23_depositoview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t23_deposito_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t23_deposito_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t23_deposito">
<?php if ($t23_deposito_view->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<table class="table table-bordered table-striped ewViewTable">
<?php if ($t23_deposito->id->Visible) { // id ?>
	<tr id="r_id">
		<td><span id="elh_t23_deposito_id"><?php echo $t23_deposito->id->FldCaption() ?></span></td>
		<td data-name="id"<?php echo $t23_deposito->id->CellAttributes() ?>>
<span id="el_t23_deposito_id">
<span<?php echo $t23_deposito->id->ViewAttributes() ?>>
<?php echo $t23_deposito->id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_No->Visible) { // Kontrak_No ?>
	<tr id="r_Kontrak_No">
		<td><span id="elh_t23_deposito_Kontrak_No"><?php echo $t23_deposito->Kontrak_No->FldCaption() ?></span></td>
		<td data-name="Kontrak_No"<?php echo $t23_deposito->Kontrak_No->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_No">
<span<?php echo $t23_deposito->Kontrak_No->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_No->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<tr id="r_Kontrak_Tgl">
		<td><span id="elh_t23_deposito_Kontrak_Tgl"><?php echo $t23_deposito->Kontrak_Tgl->FldCaption() ?></span></td>
		<td data-name="Kontrak_Tgl"<?php echo $t23_deposito->Kontrak_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Tgl">
<span<?php echo $t23_deposito->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Tgl->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Lama->Visible) { // Kontrak_Lama ?>
	<tr id="r_Kontrak_Lama">
		<td><span id="elh_t23_deposito_Kontrak_Lama"><?php echo $t23_deposito->Kontrak_Lama->FldCaption() ?></span></td>
		<td data-name="Kontrak_Lama"<?php echo $t23_deposito->Kontrak_Lama->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Lama">
<span<?php echo $t23_deposito->Kontrak_Lama->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Lama->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Tgl->Visible) { // Jatuh_Tempo_Tgl ?>
	<tr id="r_Jatuh_Tempo_Tgl">
		<td><span id="elh_t23_deposito_Jatuh_Tempo_Tgl"><?php echo $t23_deposito->Jatuh_Tempo_Tgl->FldCaption() ?></span></td>
		<td data-name="Jatuh_Tempo_Tgl"<?php echo $t23_deposito->Jatuh_Tempo_Tgl->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Tgl">
<span<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Tgl->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Deposito->Visible) { // Deposito ?>
	<tr id="r_Deposito">
		<td><span id="elh_t23_deposito_Deposito"><?php echo $t23_deposito->Deposito->FldCaption() ?></span></td>
		<td data-name="Deposito"<?php echo $t23_deposito->Deposito->CellAttributes() ?>>
<span id="el_t23_deposito_Deposito">
<span<?php echo $t23_deposito->Deposito->ViewAttributes() ?>>
<?php echo $t23_deposito->Deposito->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga_Suku->Visible) { // Bunga_Suku ?>
	<tr id="r_Bunga_Suku">
		<td><span id="elh_t23_deposito_Bunga_Suku"><?php echo $t23_deposito->Bunga_Suku->FldCaption() ?></span></td>
		<td data-name="Bunga_Suku"<?php echo $t23_deposito->Bunga_Suku->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Suku">
<span<?php echo $t23_deposito->Bunga_Suku->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Suku->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga->Visible) { // Bunga ?>
	<tr id="r_Bunga">
		<td><span id="elh_t23_deposito_Bunga"><?php echo $t23_deposito->Bunga->FldCaption() ?></span></td>
		<td data-name="Bunga"<?php echo $t23_deposito->Bunga->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga">
<span<?php echo $t23_deposito->Bunga->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->nasabah_id->Visible) { // nasabah_id ?>
	<tr id="r_nasabah_id">
		<td><span id="elh_t23_deposito_nasabah_id"><?php echo $t23_deposito->nasabah_id->FldCaption() ?></span></td>
		<td data-name="nasabah_id"<?php echo $t23_deposito->nasabah_id->CellAttributes() ?>>
<span id="el_t23_deposito_nasabah_id">
<span<?php echo $t23_deposito->nasabah_id->ViewAttributes() ?>>
<?php echo $t23_deposito->nasabah_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->bank_id->Visible) { // bank_id ?>
	<tr id="r_bank_id">
		<td><span id="elh_t23_deposito_bank_id"><?php echo $t23_deposito->bank_id->FldCaption() ?></span></td>
		<td data-name="bank_id"<?php echo $t23_deposito->bank_id->CellAttributes() ?>>
<span id="el_t23_deposito_bank_id">
<span<?php echo $t23_deposito->bank_id->ViewAttributes() ?>>
<?php echo $t23_deposito->bank_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->No_Ref->Visible) { // No_Ref ?>
	<tr id="r_No_Ref">
		<td><span id="elh_t23_deposito_No_Ref"><?php echo $t23_deposito->No_Ref->FldCaption() ?></span></td>
		<td data-name="No_Ref"<?php echo $t23_deposito->No_Ref->CellAttributes() ?>>
<span id="el_t23_deposito_No_Ref">
<span<?php echo $t23_deposito->No_Ref->ViewAttributes() ?>>
<?php echo $t23_deposito->No_Ref->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
	<tr id="r_Biaya_Administrasi">
		<td><span id="elh_t23_deposito_Biaya_Administrasi"><?php echo $t23_deposito->Biaya_Administrasi->FldCaption() ?></span></td>
		<td data-name="Biaya_Administrasi"<?php echo $t23_deposito->Biaya_Administrasi->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Administrasi">
<span<?php echo $t23_deposito->Biaya_Administrasi->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Administrasi->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Biaya_Materai->Visible) { // Biaya_Materai ?>
	<tr id="r_Biaya_Materai">
		<td><span id="elh_t23_deposito_Biaya_Materai"><?php echo $t23_deposito->Biaya_Materai->FldCaption() ?></span></td>
		<td data-name="Biaya_Materai"<?php echo $t23_deposito->Biaya_Materai->CellAttributes() ?>>
<span id="el_t23_deposito_Biaya_Materai">
<span<?php echo $t23_deposito->Biaya_Materai->ViewAttributes() ?>>
<?php echo $t23_deposito->Biaya_Materai->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Periode->Visible) { // Periode ?>
	<tr id="r_Periode">
		<td><span id="elh_t23_deposito_Periode"><?php echo $t23_deposito->Periode->FldCaption() ?></span></td>
		<td data-name="Periode"<?php echo $t23_deposito->Periode->CellAttributes() ?>>
<span id="el_t23_deposito_Periode">
<span<?php echo $t23_deposito->Periode->ViewAttributes() ?>>
<?php echo $t23_deposito->Periode->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Kontrak_Status->Visible) { // Kontrak_Status ?>
	<tr id="r_Kontrak_Status">
		<td><span id="elh_t23_deposito_Kontrak_Status"><?php echo $t23_deposito->Kontrak_Status->FldCaption() ?></span></td>
		<td data-name="Kontrak_Status"<?php echo $t23_deposito->Kontrak_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Kontrak_Status">
<span<?php echo $t23_deposito->Kontrak_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Kontrak_Status->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Jatuh_Tempo_Status->Visible) { // Jatuh_Tempo_Status ?>
	<tr id="r_Jatuh_Tempo_Status">
		<td><span id="elh_t23_deposito_Jatuh_Tempo_Status"><?php echo $t23_deposito->Jatuh_Tempo_Status->FldCaption() ?></span></td>
		<td data-name="Jatuh_Tempo_Status"<?php echo $t23_deposito->Jatuh_Tempo_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Jatuh_Tempo_Status">
<span<?php echo $t23_deposito->Jatuh_Tempo_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Jatuh_Tempo_Status->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t23_deposito->Bunga_Status->Visible) { // Bunga_Status ?>
	<tr id="r_Bunga_Status">
		<td><span id="elh_t23_deposito_Bunga_Status"><?php echo $t23_deposito->Bunga_Status->FldCaption() ?></span></td>
		<td data-name="Bunga_Status"<?php echo $t23_deposito->Bunga_Status->CellAttributes() ?>>
<span id="el_t23_deposito_Bunga_Status">
<span<?php echo $t23_deposito->Bunga_Status->ViewAttributes() ?>>
<?php echo $t23_deposito->Bunga_Status->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("t24_deposito_detail", explode(",", $t23_deposito->getCurrentDetailTable())) && $t24_deposito_detail->DetailView) {
?>
<?php if ($t23_deposito->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t24_deposito_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t24_deposito_detailgrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
ft23_depositoview.Init();
</script>
<?php
$t23_deposito_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t23_deposito_view->Page_Terminate();
?>
