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

$v0302_pinjamanlap_search = NULL; // Initialize page object first

class cv0302_pinjamanlap_search extends cv0302_pinjamanlap {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'v0302_pinjamanlap';

	// Page object name
	var $PageObjName = 'v0302_pinjamanlap_search';

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

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("v0302_pinjamanlaplist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
		$this->NasabahAlamat->SetVisibility();
		$this->No_Telp_Hp->SetVisibility();
		$this->Pekerjaan->SetVisibility();
		$this->Pekerjaan_Alamat->SetVisibility();
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
	var $FormClassName = "form-horizontal ewForm ewSearchForm";
	var $IsModal = FALSE;
	var $SearchLabelClass = "col-sm-3 control-label ewLabel";
	var $SearchRightColumnClass = "col-sm-9";

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError;
		global $gbSkipHeaderFooter;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = $objForm->GetValue("a_search");
			switch ($this->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $this->UrlParm($sSrchStr);
						$sSrchStr = "v0302_pinjamanlaplist.php" . "?" . $sSrchStr;
						$this->Page_Terminate($sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$this->RowType = EW_ROWTYPE_SEARCH;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Build advanced search
	function BuildAdvancedSearch() {
		$sSrchUrl = "";
		$this->BuildSearchUrl($sSrchUrl, $this->pinjaman_id); // pinjaman_id
		$this->BuildSearchUrl($sSrchUrl, $this->Kontrak_No); // Kontrak_No
		$this->BuildSearchUrl($sSrchUrl, $this->Kontrak_Tgl); // Kontrak_Tgl
		$this->BuildSearchUrl($sSrchUrl, $this->nasabah_id); // nasabah_id
		$this->BuildSearchUrl($sSrchUrl, $this->jaminan_id); // jaminan_id
		$this->BuildSearchUrl($sSrchUrl, $this->Pinjaman); // Pinjaman
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Lama); // Angsuran_Lama
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Bunga_Prosen); // Angsuran_Bunga_Prosen
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Denda); // Angsuran_Denda
		$this->BuildSearchUrl($sSrchUrl, $this->Dispensasi_Denda); // Dispensasi_Denda
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Pokok); // Angsuran_Pokok
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Bunga); // Angsuran_Bunga
		$this->BuildSearchUrl($sSrchUrl, $this->Angsuran_Total); // Angsuran_Total
		$this->BuildSearchUrl($sSrchUrl, $this->No_Ref); // No_Ref
		$this->BuildSearchUrl($sSrchUrl, $this->Biaya_Administrasi); // Biaya_Administrasi
		$this->BuildSearchUrl($sSrchUrl, $this->Biaya_Materai); // Biaya_Materai
		$this->BuildSearchUrl($sSrchUrl, $this->marketing_id); // marketing_id
		$this->BuildSearchUrl($sSrchUrl, $this->Periode); // Periode
		$this->BuildSearchUrl($sSrchUrl, $this->Macet); // Macet
		$this->BuildSearchUrl($sSrchUrl, $this->NasabahNama); // NasabahNama
		$this->BuildSearchUrl($sSrchUrl, $this->NasabahAlamat); // NasabahAlamat
		$this->BuildSearchUrl($sSrchUrl, $this->No_Telp_Hp); // No_Telp_Hp
		$this->BuildSearchUrl($sSrchUrl, $this->Pekerjaan); // Pekerjaan
		$this->BuildSearchUrl($sSrchUrl, $this->Pekerjaan_Alamat); // Pekerjaan_Alamat
		$this->BuildSearchUrl($sSrchUrl, $this->Pekerjaan_No_Telp_Hp); // Pekerjaan_No_Telp_Hp
		$this->BuildSearchUrl($sSrchUrl, $this->Status); // Status
		$this->BuildSearchUrl($sSrchUrl, $this->NasabahKeterangan); // NasabahKeterangan
		$this->BuildSearchUrl($sSrchUrl, $this->MarketingNama); // MarketingNama
		$this->BuildSearchUrl($sSrchUrl, $this->MarketingAlamat); // MarketingAlamat
		$this->BuildSearchUrl($sSrchUrl, $this->NoHP); // NoHP
		$this->BuildSearchUrl($sSrchUrl, $this->AkhirKontrak); // AkhirKontrak
		$this->BuildSearchUrl($sSrchUrl, $this->sudah_bayar); // sudah_bayar
		$this->BuildSearchUrl($sSrchUrl, $this->pd_Angsuran_Pokok); // pd_Angsuran_Pokok
		$this->BuildSearchUrl($sSrchUrl, $this->pd_Angsuran_Bunga); // pd_Angsuran_Bunga
		$this->BuildSearchUrl($sSrchUrl, $this->pd_Angsuran_Total); // pd_Angsuran_Total
		$this->BuildSearchUrl($sSrchUrl, $this->Tanggal_Bayar); // Tanggal_Bayar
		$this->BuildSearchUrl($sSrchUrl, $this->umur_tunggakan); // umur_tunggakan
		if ($sSrchUrl <> "") $sSrchUrl .= "&";
		$sSrchUrl .= "cmd=search";
		return $sSrchUrl;
	}

	// Build search URL
	function BuildSearchUrl(&$Url, &$Fld, $OprOnly=FALSE) {
		global $objForm;
		$sWrk = "";
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $objForm->GetValue("x_$FldParm");
		$FldOpr = $objForm->GetValue("z_$FldParm");
		$FldCond = $objForm->GetValue("v_$FldParm");
		$FldVal2 = $objForm->GetValue("y_$FldParm");
		$FldOpr2 = $objForm->GetValue("w_$FldParm");
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($FldOpr == "BETWEEN") {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal) && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			}
		} else {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal));
			if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL" || ($FldOpr <> "" && $OprOnly && ew_IsValidOpr($FldOpr, $lFldDataType))) {
				$sWrk = "z_" . $FldParm . "=" . urlencode($FldOpr);
			}
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&w_" . $FldParm . "=" . urlencode($FldOpr2);
			} elseif ($FldOpr2 == "IS NULL" || $FldOpr2 == "IS NOT NULL" || ($FldOpr2 <> "" && $OprOnly && ew_IsValidOpr($FldOpr2, $lFldDataType))) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "w_" . $FldParm . "=" . urlencode($FldOpr2);
			}
		}
		if ($sWrk <> "") {
			if ($Url <> "") $Url .= "&";
			$Url .= $sWrk;
		}
	}

	function SearchValueIsNumeric($Fld, $Value) {
		if (ew_IsFloatFormat($Fld->FldType)) $Value = ew_StrToFloat($Value);
		return is_numeric($Value);
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// pinjaman_id

		$this->pinjaman_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pinjaman_id"));
		$this->pinjaman_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pinjaman_id");

		// Kontrak_No
		$this->Kontrak_No->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Kontrak_No"));
		$this->Kontrak_No->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Kontrak_No");

		// Kontrak_Tgl
		$this->Kontrak_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Kontrak_Tgl"));
		$this->Kontrak_Tgl->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Kontrak_Tgl");

		// nasabah_id
		$this->nasabah_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nasabah_id"));
		$this->nasabah_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nasabah_id");

		// jaminan_id
		$this->jaminan_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_jaminan_id"));
		$this->jaminan_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_jaminan_id");

		// Pinjaman
		$this->Pinjaman->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Pinjaman"));
		$this->Pinjaman->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Pinjaman");

		// Angsuran_Lama
		$this->Angsuran_Lama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Lama"));
		$this->Angsuran_Lama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Lama");

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Bunga_Prosen"));
		$this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Bunga_Prosen");

		// Angsuran_Denda
		$this->Angsuran_Denda->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Denda"));
		$this->Angsuran_Denda->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Denda");

		// Dispensasi_Denda
		$this->Dispensasi_Denda->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Dispensasi_Denda"));
		$this->Dispensasi_Denda->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Dispensasi_Denda");

		// Angsuran_Pokok
		$this->Angsuran_Pokok->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Pokok"));
		$this->Angsuran_Pokok->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Pokok");

		// Angsuran_Bunga
		$this->Angsuran_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Bunga"));
		$this->Angsuran_Bunga->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Bunga");

		// Angsuran_Total
		$this->Angsuran_Total->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Angsuran_Total"));
		$this->Angsuran_Total->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Angsuran_Total");

		// No_Ref
		$this->No_Ref->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_No_Ref"));
		$this->No_Ref->AdvancedSearch->SearchOperator = $objForm->GetValue("z_No_Ref");

		// Biaya_Administrasi
		$this->Biaya_Administrasi->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Biaya_Administrasi"));
		$this->Biaya_Administrasi->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Biaya_Administrasi");

		// Biaya_Materai
		$this->Biaya_Materai->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Biaya_Materai"));
		$this->Biaya_Materai->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Biaya_Materai");

		// marketing_id
		$this->marketing_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_marketing_id"));
		$this->marketing_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_marketing_id");

		// Periode
		$this->Periode->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Periode"));
		$this->Periode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Periode");

		// Macet
		$this->Macet->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Macet"));
		$this->Macet->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Macet");

		// NasabahNama
		$this->NasabahNama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_NasabahNama"));
		$this->NasabahNama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_NasabahNama");

		// NasabahAlamat
		$this->NasabahAlamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_NasabahAlamat"));
		$this->NasabahAlamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_NasabahAlamat");

		// No_Telp_Hp
		$this->No_Telp_Hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_No_Telp_Hp"));
		$this->No_Telp_Hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_No_Telp_Hp");

		// Pekerjaan
		$this->Pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Pekerjaan"));
		$this->Pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Pekerjaan");

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Pekerjaan_Alamat"));
		$this->Pekerjaan_Alamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Pekerjaan_Alamat");

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Pekerjaan_No_Telp_Hp"));
		$this->Pekerjaan_No_Telp_Hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Pekerjaan_No_Telp_Hp");

		// Status
		$this->Status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Status"));
		$this->Status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Status");

		// NasabahKeterangan
		$this->NasabahKeterangan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_NasabahKeterangan"));
		$this->NasabahKeterangan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_NasabahKeterangan");

		// MarketingNama
		$this->MarketingNama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_MarketingNama"));
		$this->MarketingNama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_MarketingNama");

		// MarketingAlamat
		$this->MarketingAlamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_MarketingAlamat"));
		$this->MarketingAlamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_MarketingAlamat");

		// NoHP
		$this->NoHP->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_NoHP"));
		$this->NoHP->AdvancedSearch->SearchOperator = $objForm->GetValue("z_NoHP");

		// AkhirKontrak
		$this->AkhirKontrak->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_AkhirKontrak"));
		$this->AkhirKontrak->AdvancedSearch->SearchOperator = $objForm->GetValue("z_AkhirKontrak");

		// sudah_bayar
		$this->sudah_bayar->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sudah_bayar"));
		$this->sudah_bayar->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sudah_bayar");

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pd_Angsuran_Pokok"));
		$this->pd_Angsuran_Pokok->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pd_Angsuran_Pokok");

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pd_Angsuran_Bunga"));
		$this->pd_Angsuran_Bunga->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pd_Angsuran_Bunga");

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pd_Angsuran_Total"));
		$this->pd_Angsuran_Total->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pd_Angsuran_Total");

		// Tanggal_Bayar
		$this->Tanggal_Bayar->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Tanggal_Bayar"));
		$this->Tanggal_Bayar->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Tanggal_Bayar");

		// umur_tunggakan
		$this->umur_tunggakan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_umur_tunggakan"));
		$this->umur_tunggakan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_umur_tunggakan");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
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

		// NasabahAlamat
		$this->NasabahAlamat->ViewValue = $this->NasabahAlamat->CurrentValue;
		$this->NasabahAlamat->ViewCustomAttributes = "";

		// No_Telp_Hp
		$this->No_Telp_Hp->ViewValue = $this->No_Telp_Hp->CurrentValue;
		$this->No_Telp_Hp->ViewCustomAttributes = "";

		// Pekerjaan
		$this->Pekerjaan->ViewValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->ViewCustomAttributes = "";

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->ViewValue = $this->Pekerjaan_Alamat->CurrentValue;
		$this->Pekerjaan_Alamat->ViewCustomAttributes = "";

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

			// NasabahAlamat
			$this->NasabahAlamat->LinkCustomAttributes = "";
			$this->NasabahAlamat->HrefValue = "";
			$this->NasabahAlamat->TooltipValue = "";

			// No_Telp_Hp
			$this->No_Telp_Hp->LinkCustomAttributes = "";
			$this->No_Telp_Hp->HrefValue = "";
			$this->No_Telp_Hp->TooltipValue = "";

			// Pekerjaan
			$this->Pekerjaan->LinkCustomAttributes = "";
			$this->Pekerjaan->HrefValue = "";
			$this->Pekerjaan->TooltipValue = "";

			// Pekerjaan_Alamat
			$this->Pekerjaan_Alamat->LinkCustomAttributes = "";
			$this->Pekerjaan_Alamat->HrefValue = "";
			$this->Pekerjaan_Alamat->TooltipValue = "";

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

			// NasabahAlamat
			$this->NasabahAlamat->EditAttrs["class"] = "form-control";
			$this->NasabahAlamat->EditCustomAttributes = "";
			$this->NasabahAlamat->EditValue = ew_HtmlEncode($this->NasabahAlamat->AdvancedSearch->SearchValue);
			$this->NasabahAlamat->PlaceHolder = ew_RemoveHtml($this->NasabahAlamat->FldCaption());

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

			// Pekerjaan_Alamat
			$this->Pekerjaan_Alamat->EditAttrs["class"] = "form-control";
			$this->Pekerjaan_Alamat->EditCustomAttributes = "";
			$this->Pekerjaan_Alamat->EditValue = ew_HtmlEncode($this->Pekerjaan_Alamat->AdvancedSearch->SearchValue);
			$this->Pekerjaan_Alamat->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_Alamat->FldCaption());

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
		if (!ew_CheckInteger($this->pinjaman_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->pinjaman_id->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->Kontrak_Tgl->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Kontrak_Tgl->FldErrMsg());
		}
		if (!ew_CheckInteger($this->nasabah_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->nasabah_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Pinjaman->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Pinjaman->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Angsuran_Lama->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Lama->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Angsuran_Bunga_Prosen->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Bunga_Prosen->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Angsuran_Denda->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Denda->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Dispensasi_Denda->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Dispensasi_Denda->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Angsuran_Pokok->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Pokok->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Angsuran_Bunga->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Bunga->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Angsuran_Total->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Angsuran_Total->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Biaya_Administrasi->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Biaya_Administrasi->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Biaya_Materai->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Biaya_Materai->FldErrMsg());
		}
		if (!ew_CheckInteger($this->marketing_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->marketing_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Status->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Status->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->AkhirKontrak->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->AkhirKontrak->FldErrMsg());
		}
		if (!ew_CheckInteger($this->sudah_bayar->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->sudah_bayar->FldErrMsg());
		}
		if (!ew_CheckNumber($this->pd_Angsuran_Pokok->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->pd_Angsuran_Pokok->FldErrMsg());
		}
		if (!ew_CheckNumber($this->pd_Angsuran_Bunga->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->pd_Angsuran_Bunga->FldErrMsg());
		}
		if (!ew_CheckNumber($this->pd_Angsuran_Total->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->pd_Angsuran_Total->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->Tanggal_Bayar->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Tanggal_Bayar->FldErrMsg());
		}
		if (!ew_CheckInteger($this->umur_tunggakan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->umur_tunggakan->FldErrMsg());
		}

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("v0302_pinjamanlaplist.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($v0302_pinjamanlap_search)) $v0302_pinjamanlap_search = new cv0302_pinjamanlap_search();

// Page init
$v0302_pinjamanlap_search->Page_Init();

// Page main
$v0302_pinjamanlap_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v0302_pinjamanlap_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($v0302_pinjamanlap_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fv0302_pinjamanlapsearch = new ew_Form("fv0302_pinjamanlapsearch", "search");
<?php } else { ?>
var CurrentForm = fv0302_pinjamanlapsearch = new ew_Form("fv0302_pinjamanlapsearch", "search");
<?php } ?>

// Form_CustomValidate event
fv0302_pinjamanlapsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv0302_pinjamanlapsearch.ValidateRequired = true;
<?php } else { ?>
fv0302_pinjamanlapsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fv0302_pinjamanlapsearch.Lists["x_Macet"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fv0302_pinjamanlapsearch.Lists["x_Macet"].Options = <?php echo json_encode($v0302_pinjamanlap->Macet->Options()) ?>;

// Form object for search
// Validate function for search

fv0302_pinjamanlapsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_pinjaman_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->pinjaman_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Kontrak_Tgl");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Kontrak_Tgl->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_nasabah_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->nasabah_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Pinjaman");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Pinjaman->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Lama");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Lama->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Bunga_Prosen");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Bunga_Prosen->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Denda");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Denda->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Dispensasi_Denda");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Dispensasi_Denda->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Pokok");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Pokok->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Bunga");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Bunga->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Angsuran_Total");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Angsuran_Total->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Biaya_Administrasi");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Biaya_Administrasi->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Biaya_Materai");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Biaya_Materai->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_marketing_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->marketing_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Status");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Status->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_AkhirKontrak");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->AkhirKontrak->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_sudah_bayar");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->sudah_bayar->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_pd_Angsuran_Pokok");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->pd_Angsuran_Pokok->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_pd_Angsuran_Bunga");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->pd_Angsuran_Bunga->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_pd_Angsuran_Total");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->pd_Angsuran_Total->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Tanggal_Bayar");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->Tanggal_Bayar->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_umur_tunggakan");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v0302_pinjamanlap->umur_tunggakan->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$v0302_pinjamanlap_search->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $v0302_pinjamanlap_search->ShowPageHeader(); ?>
<?php
$v0302_pinjamanlap_search->ShowMessage();
?>
<form name="fv0302_pinjamanlapsearch" id="fv0302_pinjamanlapsearch" class="<?php echo $v0302_pinjamanlap_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($v0302_pinjamanlap_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $v0302_pinjamanlap_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v0302_pinjamanlap">
<input type="hidden" name="a_search" id="a_search" value="S">
<?php if ($v0302_pinjamanlap_search->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($v0302_pinjamanlap->pinjaman_id->Visible) { // pinjaman_id ?>
	<div id="r_pinjaman_id" class="form-group">
		<label for="x_pinjaman_id" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_pinjaman_id"><?php echo $v0302_pinjamanlap->pinjaman_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pinjaman_id" id="z_pinjaman_id" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->pinjaman_id->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_pinjaman_id">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_pinjaman_id" name="x_pinjaman_id" id="x_pinjaman_id" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->pinjaman_id->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->pinjaman_id->EditValue ?>"<?php echo $v0302_pinjamanlap->pinjaman_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Kontrak_No->Visible) { // Kontrak_No ?>
	<div id="r_Kontrak_No" class="form-group">
		<label for="x_Kontrak_No" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Kontrak_No"><?php echo $v0302_pinjamanlap->Kontrak_No->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Kontrak_No" id="z_Kontrak_No" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Kontrak_No->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Kontrak_No">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Kontrak_No" name="x_Kontrak_No" id="x_Kontrak_No" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Kontrak_No->EditValue ?>"<?php echo $v0302_pinjamanlap->Kontrak_No->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<div id="r_Kontrak_Tgl" class="form-group">
		<label for="x_Kontrak_Tgl" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Kontrak_Tgl"><?php echo $v0302_pinjamanlap->Kontrak_Tgl->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Kontrak_Tgl" id="z_Kontrak_Tgl" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Kontrak_Tgl->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Kontrak_Tgl">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Kontrak_Tgl" name="x_Kontrak_Tgl" id="x_Kontrak_Tgl" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Kontrak_Tgl->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Kontrak_Tgl->EditValue ?>"<?php echo $v0302_pinjamanlap->Kontrak_Tgl->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label for="x_nasabah_id" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_nasabah_id"><?php echo $v0302_pinjamanlap->nasabah_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_nasabah_id" id="z_nasabah_id" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->nasabah_id->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_nasabah_id">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_nasabah_id" name="x_nasabah_id" id="x_nasabah_id" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->nasabah_id->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->nasabah_id->EditValue ?>"<?php echo $v0302_pinjamanlap->nasabah_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->jaminan_id->Visible) { // jaminan_id ?>
	<div id="r_jaminan_id" class="form-group">
		<label for="x_jaminan_id" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_jaminan_id"><?php echo $v0302_pinjamanlap->jaminan_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_jaminan_id" id="z_jaminan_id" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->jaminan_id->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_jaminan_id">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_jaminan_id" name="x_jaminan_id" id="x_jaminan_id" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->jaminan_id->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->jaminan_id->EditValue ?>"<?php echo $v0302_pinjamanlap->jaminan_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Pinjaman->Visible) { // Pinjaman ?>
	<div id="r_Pinjaman" class="form-group">
		<label for="x_Pinjaman" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Pinjaman"><?php echo $v0302_pinjamanlap->Pinjaman->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Pinjaman" id="z_Pinjaman" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Pinjaman->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Pinjaman">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Pinjaman" name="x_Pinjaman" id="x_Pinjaman" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Pinjaman->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Pinjaman->EditValue ?>"<?php echo $v0302_pinjamanlap->Pinjaman->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
	<div id="r_Angsuran_Lama" class="form-group">
		<label for="x_Angsuran_Lama" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Lama"><?php echo $v0302_pinjamanlap->Angsuran_Lama->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Lama" id="z_Angsuran_Lama" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Lama->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Lama">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Lama" name="x_Angsuran_Lama" id="x_Angsuran_Lama" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Lama->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Lama->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Lama->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
	<div id="r_Angsuran_Bunga_Prosen" class="form-group">
		<label for="x_Angsuran_Bunga_Prosen" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Bunga_Prosen"><?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Bunga_Prosen" id="z_Angsuran_Bunga_Prosen" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Bunga_Prosen">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Bunga_Prosen" name="x_Angsuran_Bunga_Prosen" id="x_Angsuran_Bunga_Prosen" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Bunga_Prosen->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Bunga_Prosen->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
	<div id="r_Angsuran_Denda" class="form-group">
		<label for="x_Angsuran_Denda" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Denda"><?php echo $v0302_pinjamanlap->Angsuran_Denda->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Denda" id="z_Angsuran_Denda" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Denda->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Denda">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Denda" name="x_Angsuran_Denda" id="x_Angsuran_Denda" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Denda->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Denda->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Denda->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
	<div id="r_Dispensasi_Denda" class="form-group">
		<label for="x_Dispensasi_Denda" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Dispensasi_Denda"><?php echo $v0302_pinjamanlap->Dispensasi_Denda->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Dispensasi_Denda" id="z_Dispensasi_Denda" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Dispensasi_Denda->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Dispensasi_Denda">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Dispensasi_Denda" name="x_Dispensasi_Denda" id="x_Dispensasi_Denda" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Dispensasi_Denda->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Dispensasi_Denda->EditValue ?>"<?php echo $v0302_pinjamanlap->Dispensasi_Denda->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<div id="r_Angsuran_Pokok" class="form-group">
		<label for="x_Angsuran_Pokok" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Pokok"><?php echo $v0302_pinjamanlap->Angsuran_Pokok->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Pokok" id="z_Angsuran_Pokok" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Pokok->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Pokok">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Pokok" name="x_Angsuran_Pokok" id="x_Angsuran_Pokok" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Pokok->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Pokok->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Pokok->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<div id="r_Angsuran_Bunga" class="form-group">
		<label for="x_Angsuran_Bunga" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Bunga"><?php echo $v0302_pinjamanlap->Angsuran_Bunga->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Bunga" id="z_Angsuran_Bunga" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Bunga->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Bunga">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Bunga" name="x_Angsuran_Bunga" id="x_Angsuran_Bunga" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Bunga->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Bunga->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Bunga->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<div id="r_Angsuran_Total" class="form-group">
		<label for="x_Angsuran_Total" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Angsuran_Total"><?php echo $v0302_pinjamanlap->Angsuran_Total->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Angsuran_Total" id="z_Angsuran_Total" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Angsuran_Total->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Angsuran_Total">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Angsuran_Total" name="x_Angsuran_Total" id="x_Angsuran_Total" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Angsuran_Total->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Angsuran_Total->EditValue ?>"<?php echo $v0302_pinjamanlap->Angsuran_Total->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->No_Ref->Visible) { // No_Ref ?>
	<div id="r_No_Ref" class="form-group">
		<label for="x_No_Ref" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_No_Ref"><?php echo $v0302_pinjamanlap->No_Ref->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_No_Ref" id="z_No_Ref" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->No_Ref->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_No_Ref">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_No_Ref" name="x_No_Ref" id="x_No_Ref" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->No_Ref->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->No_Ref->EditValue ?>"<?php echo $v0302_pinjamanlap->No_Ref->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
	<div id="r_Biaya_Administrasi" class="form-group">
		<label for="x_Biaya_Administrasi" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Biaya_Administrasi"><?php echo $v0302_pinjamanlap->Biaya_Administrasi->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Biaya_Administrasi" id="z_Biaya_Administrasi" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Biaya_Administrasi->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Biaya_Administrasi">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Biaya_Administrasi" name="x_Biaya_Administrasi" id="x_Biaya_Administrasi" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Biaya_Administrasi->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Biaya_Administrasi->EditValue ?>"<?php echo $v0302_pinjamanlap->Biaya_Administrasi->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Biaya_Materai->Visible) { // Biaya_Materai ?>
	<div id="r_Biaya_Materai" class="form-group">
		<label for="x_Biaya_Materai" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Biaya_Materai"><?php echo $v0302_pinjamanlap->Biaya_Materai->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Biaya_Materai" id="z_Biaya_Materai" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Biaya_Materai->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Biaya_Materai">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Biaya_Materai" name="x_Biaya_Materai" id="x_Biaya_Materai" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Biaya_Materai->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Biaya_Materai->EditValue ?>"<?php echo $v0302_pinjamanlap->Biaya_Materai->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->marketing_id->Visible) { // marketing_id ?>
	<div id="r_marketing_id" class="form-group">
		<label for="x_marketing_id" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_marketing_id"><?php echo $v0302_pinjamanlap->marketing_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_marketing_id" id="z_marketing_id" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->marketing_id->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_marketing_id">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_marketing_id" name="x_marketing_id" id="x_marketing_id" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->marketing_id->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->marketing_id->EditValue ?>"<?php echo $v0302_pinjamanlap->marketing_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Periode->Visible) { // Periode ?>
	<div id="r_Periode" class="form-group">
		<label for="x_Periode" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Periode"><?php echo $v0302_pinjamanlap->Periode->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Periode" id="z_Periode" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Periode->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Periode">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Periode" name="x_Periode" id="x_Periode" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Periode->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Periode->EditValue ?>"<?php echo $v0302_pinjamanlap->Periode->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Macet->Visible) { // Macet ?>
	<div id="r_Macet" class="form-group">
		<label class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Macet"><?php echo $v0302_pinjamanlap->Macet->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Macet" id="z_Macet" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Macet->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Macet">
<div id="tp_x_Macet" class="ewTemplate"><input type="radio" data-table="v0302_pinjamanlap" data-field="x_Macet" data-value-separator="<?php echo $v0302_pinjamanlap->Macet->DisplayValueSeparatorAttribute() ?>" name="x_Macet" id="x_Macet" value="{value}"<?php echo $v0302_pinjamanlap->Macet->EditAttributes() ?>></div>
<div id="dsl_x_Macet" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $v0302_pinjamanlap->Macet->RadioButtonListHtml(FALSE, "x_Macet") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->NasabahNama->Visible) { // NasabahNama ?>
	<div id="r_NasabahNama" class="form-group">
		<label for="x_NasabahNama" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_NasabahNama"><?php echo $v0302_pinjamanlap->NasabahNama->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_NasabahNama" id="z_NasabahNama" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->NasabahNama->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_NasabahNama">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_NasabahNama" name="x_NasabahNama" id="x_NasabahNama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->NasabahNama->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->NasabahNama->EditValue ?>"<?php echo $v0302_pinjamanlap->NasabahNama->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->NasabahAlamat->Visible) { // NasabahAlamat ?>
	<div id="r_NasabahAlamat" class="form-group">
		<label for="x_NasabahAlamat" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_NasabahAlamat"><?php echo $v0302_pinjamanlap->NasabahAlamat->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_NasabahAlamat" id="z_NasabahAlamat" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->NasabahAlamat->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_NasabahAlamat">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_NasabahAlamat" name="x_NasabahAlamat" id="x_NasabahAlamat" size="35" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->NasabahAlamat->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->NasabahAlamat->EditValue ?>"<?php echo $v0302_pinjamanlap->NasabahAlamat->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
	<div id="r_No_Telp_Hp" class="form-group">
		<label for="x_No_Telp_Hp" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_No_Telp_Hp"><?php echo $v0302_pinjamanlap->No_Telp_Hp->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_No_Telp_Hp" id="z_No_Telp_Hp" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->No_Telp_Hp->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_No_Telp_Hp">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_No_Telp_Hp" name="x_No_Telp_Hp" id="x_No_Telp_Hp" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->No_Telp_Hp->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->No_Telp_Hp->EditValue ?>"<?php echo $v0302_pinjamanlap->No_Telp_Hp->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Pekerjaan->Visible) { // Pekerjaan ?>
	<div id="r_Pekerjaan" class="form-group">
		<label for="x_Pekerjaan" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Pekerjaan"><?php echo $v0302_pinjamanlap->Pekerjaan->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Pekerjaan" id="z_Pekerjaan" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Pekerjaan->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Pekerjaan">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Pekerjaan" name="x_Pekerjaan" id="x_Pekerjaan" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Pekerjaan->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Pekerjaan->EditValue ?>"<?php echo $v0302_pinjamanlap->Pekerjaan->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Pekerjaan_Alamat->Visible) { // Pekerjaan_Alamat ?>
	<div id="r_Pekerjaan_Alamat" class="form-group">
		<label for="x_Pekerjaan_Alamat" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Pekerjaan_Alamat"><?php echo $v0302_pinjamanlap->Pekerjaan_Alamat->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Pekerjaan_Alamat" id="z_Pekerjaan_Alamat" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Pekerjaan_Alamat->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Pekerjaan_Alamat">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Pekerjaan_Alamat" name="x_Pekerjaan_Alamat" id="x_Pekerjaan_Alamat" size="35" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Pekerjaan_Alamat->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Pekerjaan_Alamat->EditValue ?>"<?php echo $v0302_pinjamanlap->Pekerjaan_Alamat->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->Visible) { // Pekerjaan_No_Telp_Hp ?>
	<div id="r_Pekerjaan_No_Telp_Hp" class="form-group">
		<label for="x_Pekerjaan_No_Telp_Hp" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Pekerjaan_No_Telp_Hp"><?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Pekerjaan_No_Telp_Hp" id="z_Pekerjaan_No_Telp_Hp" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Pekerjaan_No_Telp_Hp">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Pekerjaan_No_Telp_Hp" name="x_Pekerjaan_No_Telp_Hp" id="x_Pekerjaan_No_Telp_Hp" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->EditValue ?>"<?php echo $v0302_pinjamanlap->Pekerjaan_No_Telp_Hp->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group">
		<label for="x_Status" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Status"><?php echo $v0302_pinjamanlap->Status->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status" id="z_Status" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Status->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Status">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Status" name="x_Status" id="x_Status" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Status->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Status->EditValue ?>"<?php echo $v0302_pinjamanlap->Status->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->NasabahKeterangan->Visible) { // NasabahKeterangan ?>
	<div id="r_NasabahKeterangan" class="form-group">
		<label for="x_NasabahKeterangan" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_NasabahKeterangan"><?php echo $v0302_pinjamanlap->NasabahKeterangan->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_NasabahKeterangan" id="z_NasabahKeterangan" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->NasabahKeterangan->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_NasabahKeterangan">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_NasabahKeterangan" name="x_NasabahKeterangan" id="x_NasabahKeterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->NasabahKeterangan->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->NasabahKeterangan->EditValue ?>"<?php echo $v0302_pinjamanlap->NasabahKeterangan->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->MarketingNama->Visible) { // MarketingNama ?>
	<div id="r_MarketingNama" class="form-group">
		<label for="x_MarketingNama" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_MarketingNama"><?php echo $v0302_pinjamanlap->MarketingNama->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_MarketingNama" id="z_MarketingNama" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->MarketingNama->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_MarketingNama">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_MarketingNama" name="x_MarketingNama" id="x_MarketingNama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->MarketingNama->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->MarketingNama->EditValue ?>"<?php echo $v0302_pinjamanlap->MarketingNama->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->MarketingAlamat->Visible) { // MarketingAlamat ?>
	<div id="r_MarketingAlamat" class="form-group">
		<label for="x_MarketingAlamat" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_MarketingAlamat"><?php echo $v0302_pinjamanlap->MarketingAlamat->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_MarketingAlamat" id="z_MarketingAlamat" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->MarketingAlamat->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_MarketingAlamat">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_MarketingAlamat" name="x_MarketingAlamat" id="x_MarketingAlamat" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->MarketingAlamat->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->MarketingAlamat->EditValue ?>"<?php echo $v0302_pinjamanlap->MarketingAlamat->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->NoHP->Visible) { // NoHP ?>
	<div id="r_NoHP" class="form-group">
		<label for="x_NoHP" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_NoHP"><?php echo $v0302_pinjamanlap->NoHP->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_NoHP" id="z_NoHP" value="LIKE"></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->NoHP->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_NoHP">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_NoHP" name="x_NoHP" id="x_NoHP" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->NoHP->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->NoHP->EditValue ?>"<?php echo $v0302_pinjamanlap->NoHP->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->AkhirKontrak->Visible) { // AkhirKontrak ?>
	<div id="r_AkhirKontrak" class="form-group">
		<label for="x_AkhirKontrak" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_AkhirKontrak"><?php echo $v0302_pinjamanlap->AkhirKontrak->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_AkhirKontrak" id="z_AkhirKontrak" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->AkhirKontrak->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_AkhirKontrak">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_AkhirKontrak" name="x_AkhirKontrak" id="x_AkhirKontrak" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->AkhirKontrak->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->AkhirKontrak->EditValue ?>"<?php echo $v0302_pinjamanlap->AkhirKontrak->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->sudah_bayar->Visible) { // sudah_bayar ?>
	<div id="r_sudah_bayar" class="form-group">
		<label for="x_sudah_bayar" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_sudah_bayar"><?php echo $v0302_pinjamanlap->sudah_bayar->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sudah_bayar" id="z_sudah_bayar" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->sudah_bayar->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_sudah_bayar">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_sudah_bayar" name="x_sudah_bayar" id="x_sudah_bayar" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->sudah_bayar->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->sudah_bayar->EditValue ?>"<?php echo $v0302_pinjamanlap->sudah_bayar->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->pd_Angsuran_Pokok->Visible) { // pd_Angsuran_Pokok ?>
	<div id="r_pd_Angsuran_Pokok" class="form-group">
		<label for="x_pd_Angsuran_Pokok" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_pd_Angsuran_Pokok"><?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pd_Angsuran_Pokok" id="z_pd_Angsuran_Pokok" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_pd_Angsuran_Pokok">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_pd_Angsuran_Pokok" name="x_pd_Angsuran_Pokok" id="x_pd_Angsuran_Pokok" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->pd_Angsuran_Pokok->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->EditValue ?>"<?php echo $v0302_pinjamanlap->pd_Angsuran_Pokok->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->pd_Angsuran_Bunga->Visible) { // pd_Angsuran_Bunga ?>
	<div id="r_pd_Angsuran_Bunga" class="form-group">
		<label for="x_pd_Angsuran_Bunga" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_pd_Angsuran_Bunga"><?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pd_Angsuran_Bunga" id="z_pd_Angsuran_Bunga" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_pd_Angsuran_Bunga">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_pd_Angsuran_Bunga" name="x_pd_Angsuran_Bunga" id="x_pd_Angsuran_Bunga" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->pd_Angsuran_Bunga->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->EditValue ?>"<?php echo $v0302_pinjamanlap->pd_Angsuran_Bunga->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->pd_Angsuran_Total->Visible) { // pd_Angsuran_Total ?>
	<div id="r_pd_Angsuran_Total" class="form-group">
		<label for="x_pd_Angsuran_Total" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_pd_Angsuran_Total"><?php echo $v0302_pinjamanlap->pd_Angsuran_Total->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pd_Angsuran_Total" id="z_pd_Angsuran_Total" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_pd_Angsuran_Total">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_pd_Angsuran_Total" name="x_pd_Angsuran_Total" id="x_pd_Angsuran_Total" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->pd_Angsuran_Total->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->EditValue ?>"<?php echo $v0302_pinjamanlap->pd_Angsuran_Total->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->Tanggal_Bayar->Visible) { // Tanggal_Bayar ?>
	<div id="r_Tanggal_Bayar" class="form-group">
		<label for="x_Tanggal_Bayar" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_Tanggal_Bayar"><?php echo $v0302_pinjamanlap->Tanggal_Bayar->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Tanggal_Bayar" id="z_Tanggal_Bayar" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->Tanggal_Bayar->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_Tanggal_Bayar">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_Tanggal_Bayar" name="x_Tanggal_Bayar" id="x_Tanggal_Bayar" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->Tanggal_Bayar->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->Tanggal_Bayar->EditValue ?>"<?php echo $v0302_pinjamanlap->Tanggal_Bayar->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v0302_pinjamanlap->umur_tunggakan->Visible) { // umur_tunggakan ?>
	<div id="r_umur_tunggakan" class="form-group">
		<label for="x_umur_tunggakan" class="<?php echo $v0302_pinjamanlap_search->SearchLabelClass ?>"><span id="elh_v0302_pinjamanlap_umur_tunggakan"><?php echo $v0302_pinjamanlap->umur_tunggakan->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_umur_tunggakan" id="z_umur_tunggakan" value="="></p>
		</label>
		<div class="<?php echo $v0302_pinjamanlap_search->SearchRightColumnClass ?>"><div<?php echo $v0302_pinjamanlap->umur_tunggakan->CellAttributes() ?>>
			<span id="el_v0302_pinjamanlap_umur_tunggakan">
<input type="text" data-table="v0302_pinjamanlap" data-field="x_umur_tunggakan" name="x_umur_tunggakan" id="x_umur_tunggakan" size="30" placeholder="<?php echo ew_HtmlEncode($v0302_pinjamanlap->umur_tunggakan->getPlaceHolder()) ?>" value="<?php echo $v0302_pinjamanlap->umur_tunggakan->EditValue ?>"<?php echo $v0302_pinjamanlap->umur_tunggakan->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div>
<?php if (!$v0302_pinjamanlap_search->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
fv0302_pinjamanlapsearch.Init();
</script>
<?php
$v0302_pinjamanlap_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$v0302_pinjamanlap_search->Page_Terminate();
?>
