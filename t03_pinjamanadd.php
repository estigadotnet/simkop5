<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t04_pinjamanangsurantempgridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_pinjaman_add = NULL; // Initialize page object first

class ct03_pinjaman_add extends ct03_pinjaman {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 't03_pinjaman';

	// Page object name
	var $PageObjName = 't03_pinjaman_add';

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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_pinjaman', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t03_pinjamanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t03_pinjamanlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t03_pinjamanview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetUpDetailParms();
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->Kontrak_No->CurrentValue = NULL;
		$this->Kontrak_No->OldValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_Tgl->CurrentValue = NULL;
		$this->Kontrak_Tgl->OldValue = $this->Kontrak_Tgl->CurrentValue;
		$this->nasabah_id->CurrentValue = NULL;
		$this->nasabah_id->OldValue = $this->nasabah_id->CurrentValue;
		$this->jaminan_id->CurrentValue = NULL;
		$this->jaminan_id->OldValue = $this->jaminan_id->CurrentValue;
		$this->Pinjaman->CurrentValue = NULL;
		$this->Pinjaman->OldValue = $this->Pinjaman->CurrentValue;
		$this->Angsuran_Lama->CurrentValue = NULL;
		$this->Angsuran_Lama->OldValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Bunga_Prosen->CurrentValue = 2.25;
		$this->Angsuran_Denda->CurrentValue = 0.40;
		$this->Dispensasi_Denda->CurrentValue = 3;
		$this->Angsuran_Pokok->CurrentValue = NULL;
		$this->Angsuran_Pokok->OldValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Bunga->CurrentValue = NULL;
		$this->Angsuran_Bunga->OldValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Total->CurrentValue = NULL;
		$this->Angsuran_Total->OldValue = $this->Angsuran_Total->CurrentValue;
		$this->No_Ref->CurrentValue = NULL;
		$this->No_Ref->OldValue = $this->No_Ref->CurrentValue;
		$this->Biaya_Administrasi->CurrentValue = 0.00;
		$this->Biaya_Materai->CurrentValue = 0.00;
		$this->marketing_id->CurrentValue = NULL;
		$this->marketing_id->OldValue = $this->marketing_id->CurrentValue;
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
		if (!$this->nasabah_id->FldIsDetailKey) {
			$this->nasabah_id->setFormValue($objForm->GetValue("x_nasabah_id"));
		}
		if (!$this->jaminan_id->FldIsDetailKey) {
			$this->jaminan_id->setFormValue($objForm->GetValue("x_jaminan_id"));
		}
		if (!$this->Pinjaman->FldIsDetailKey) {
			$this->Pinjaman->setFormValue($objForm->GetValue("x_Pinjaman"));
		}
		if (!$this->Angsuran_Lama->FldIsDetailKey) {
			$this->Angsuran_Lama->setFormValue($objForm->GetValue("x_Angsuran_Lama"));
		}
		if (!$this->Angsuran_Bunga_Prosen->FldIsDetailKey) {
			$this->Angsuran_Bunga_Prosen->setFormValue($objForm->GetValue("x_Angsuran_Bunga_Prosen"));
		}
		if (!$this->Angsuran_Denda->FldIsDetailKey) {
			$this->Angsuran_Denda->setFormValue($objForm->GetValue("x_Angsuran_Denda"));
		}
		if (!$this->Dispensasi_Denda->FldIsDetailKey) {
			$this->Dispensasi_Denda->setFormValue($objForm->GetValue("x_Dispensasi_Denda"));
		}
		if (!$this->Angsuran_Pokok->FldIsDetailKey) {
			$this->Angsuran_Pokok->setFormValue($objForm->GetValue("x_Angsuran_Pokok"));
		}
		if (!$this->Angsuran_Bunga->FldIsDetailKey) {
			$this->Angsuran_Bunga->setFormValue($objForm->GetValue("x_Angsuran_Bunga"));
		}
		if (!$this->Angsuran_Total->FldIsDetailKey) {
			$this->Angsuran_Total->setFormValue($objForm->GetValue("x_Angsuran_Total"));
		}
		if (!$this->No_Ref->FldIsDetailKey) {
			$this->No_Ref->setFormValue($objForm->GetValue("x_No_Ref"));
		}
		if (!$this->Biaya_Administrasi->FldIsDetailKey) {
			$this->Biaya_Administrasi->setFormValue($objForm->GetValue("x_Biaya_Administrasi"));
		}
		if (!$this->Biaya_Materai->FldIsDetailKey) {
			$this->Biaya_Materai->setFormValue($objForm->GetValue("x_Biaya_Materai"));
		}
		if (!$this->marketing_id->FldIsDetailKey) {
			$this->marketing_id->setFormValue($objForm->GetValue("x_marketing_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->Kontrak_No->CurrentValue = $this->Kontrak_No->FormValue;
		$this->Kontrak_Tgl->CurrentValue = $this->Kontrak_Tgl->FormValue;
		$this->Kontrak_Tgl->CurrentValue = ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7);
		$this->nasabah_id->CurrentValue = $this->nasabah_id->FormValue;
		$this->jaminan_id->CurrentValue = $this->jaminan_id->FormValue;
		$this->Pinjaman->CurrentValue = $this->Pinjaman->FormValue;
		$this->Angsuran_Lama->CurrentValue = $this->Angsuran_Lama->FormValue;
		$this->Angsuran_Bunga_Prosen->CurrentValue = $this->Angsuran_Bunga_Prosen->FormValue;
		$this->Angsuran_Denda->CurrentValue = $this->Angsuran_Denda->FormValue;
		$this->Dispensasi_Denda->CurrentValue = $this->Dispensasi_Denda->FormValue;
		$this->Angsuran_Pokok->CurrentValue = $this->Angsuran_Pokok->FormValue;
		$this->Angsuran_Bunga->CurrentValue = $this->Angsuran_Bunga->FormValue;
		$this->Angsuran_Total->CurrentValue = $this->Angsuran_Total->FormValue;
		$this->No_Ref->CurrentValue = $this->No_Ref->FormValue;
		$this->Biaya_Administrasi->CurrentValue = $this->Biaya_Administrasi->FormValue;
		$this->Biaya_Materai->CurrentValue = $this->Biaya_Materai->FormValue;
		$this->marketing_id->CurrentValue = $this->marketing_id->FormValue;
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
		if (strval($this->nasabah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
		$sWhereWrk = "";
		$this->nasabah_id->LookupFilters = array();
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
		if (strval($this->marketing_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->marketing_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_marketing`";
		$sWhereWrk = "";
		$this->marketing_id->LookupFilters = array();
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

			// nasabah_id
			$this->nasabah_id->EditAttrs["class"] = "form-control";
			$this->nasabah_id->EditCustomAttributes = "";
			if (trim(strval($this->nasabah_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->nasabah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t01_nasabah`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->nasabah_id->EditValue = $arwrk;

			// jaminan_id
			$this->jaminan_id->EditCustomAttributes = "";
			if (trim(strval($this->jaminan_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->jaminan_id->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `id`, `Merk_Type` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `nasabah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t02_jaminan`";
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->jaminan_id->ViewValue .= $this->jaminan_id->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->jaminan_id->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->jaminan_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->jaminan_id->EditValue = $arwrk;

			// Pinjaman
			$this->Pinjaman->EditAttrs["class"] = "form-control";
			$this->Pinjaman->EditCustomAttributes = "";
			$this->Pinjaman->EditValue = ew_HtmlEncode($this->Pinjaman->CurrentValue);
			$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());
			if (strval($this->Pinjaman->EditValue) <> "" && is_numeric($this->Pinjaman->EditValue)) $this->Pinjaman->EditValue = ew_FormatNumber($this->Pinjaman->EditValue, -2, -2, -2, -2);

			// Angsuran_Lama
			$this->Angsuran_Lama->EditAttrs["class"] = "form-control";
			$this->Angsuran_Lama->EditCustomAttributes = "";
			$this->Angsuran_Lama->EditValue = ew_HtmlEncode($this->Angsuran_Lama->CurrentValue);
			$this->Angsuran_Lama->PlaceHolder = ew_RemoveHtml($this->Angsuran_Lama->FldCaption());

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->EditAttrs["class"] = "form-control";
			$this->Angsuran_Bunga_Prosen->EditCustomAttributes = "";
			$this->Angsuran_Bunga_Prosen->EditValue = ew_HtmlEncode($this->Angsuran_Bunga_Prosen->CurrentValue);
			$this->Angsuran_Bunga_Prosen->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga_Prosen->FldCaption());
			if (strval($this->Angsuran_Bunga_Prosen->EditValue) <> "" && is_numeric($this->Angsuran_Bunga_Prosen->EditValue)) $this->Angsuran_Bunga_Prosen->EditValue = ew_FormatNumber($this->Angsuran_Bunga_Prosen->EditValue, -2, -1, -2, 0);

			// Angsuran_Denda
			$this->Angsuran_Denda->EditAttrs["class"] = "form-control";
			$this->Angsuran_Denda->EditCustomAttributes = "";
			$this->Angsuran_Denda->EditValue = ew_HtmlEncode($this->Angsuran_Denda->CurrentValue);
			$this->Angsuran_Denda->PlaceHolder = ew_RemoveHtml($this->Angsuran_Denda->FldCaption());
			if (strval($this->Angsuran_Denda->EditValue) <> "" && is_numeric($this->Angsuran_Denda->EditValue)) $this->Angsuran_Denda->EditValue = ew_FormatNumber($this->Angsuran_Denda->EditValue, -2, -1, -2, 0);

			// Dispensasi_Denda
			$this->Dispensasi_Denda->EditAttrs["class"] = "form-control";
			$this->Dispensasi_Denda->EditCustomAttributes = "";
			$this->Dispensasi_Denda->EditValue = ew_HtmlEncode($this->Dispensasi_Denda->CurrentValue);
			$this->Dispensasi_Denda->PlaceHolder = ew_RemoveHtml($this->Dispensasi_Denda->FldCaption());

			// Angsuran_Pokok
			$this->Angsuran_Pokok->EditAttrs["class"] = "form-control";
			$this->Angsuran_Pokok->EditCustomAttributes = "";
			$this->Angsuran_Pokok->EditValue = ew_HtmlEncode($this->Angsuran_Pokok->CurrentValue);
			$this->Angsuran_Pokok->PlaceHolder = ew_RemoveHtml($this->Angsuran_Pokok->FldCaption());
			if (strval($this->Angsuran_Pokok->EditValue) <> "" && is_numeric($this->Angsuran_Pokok->EditValue)) $this->Angsuran_Pokok->EditValue = ew_FormatNumber($this->Angsuran_Pokok->EditValue, -2, -2, -2, -2);

			// Angsuran_Bunga
			$this->Angsuran_Bunga->EditAttrs["class"] = "form-control";
			$this->Angsuran_Bunga->EditCustomAttributes = "";
			$this->Angsuran_Bunga->EditValue = ew_HtmlEncode($this->Angsuran_Bunga->CurrentValue);
			$this->Angsuran_Bunga->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga->FldCaption());
			if (strval($this->Angsuran_Bunga->EditValue) <> "" && is_numeric($this->Angsuran_Bunga->EditValue)) $this->Angsuran_Bunga->EditValue = ew_FormatNumber($this->Angsuran_Bunga->EditValue, -2, -2, -2, -2);

			// Angsuran_Total
			$this->Angsuran_Total->EditAttrs["class"] = "form-control";
			$this->Angsuran_Total->EditCustomAttributes = "";
			$this->Angsuran_Total->EditValue = ew_HtmlEncode($this->Angsuran_Total->CurrentValue);
			$this->Angsuran_Total->PlaceHolder = ew_RemoveHtml($this->Angsuran_Total->FldCaption());
			if (strval($this->Angsuran_Total->EditValue) <> "" && is_numeric($this->Angsuran_Total->EditValue)) $this->Angsuran_Total->EditValue = ew_FormatNumber($this->Angsuran_Total->EditValue, -2, -2, -2, -2);

			// No_Ref
			$this->No_Ref->EditAttrs["class"] = "form-control";
			$this->No_Ref->EditCustomAttributes = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->EditAttrs["class"] = "form-control";
			$this->Biaya_Administrasi->EditCustomAttributes = "";
			$this->Biaya_Administrasi->EditValue = ew_HtmlEncode($this->Biaya_Administrasi->CurrentValue);
			$this->Biaya_Administrasi->PlaceHolder = ew_RemoveHtml($this->Biaya_Administrasi->FldCaption());
			if (strval($this->Biaya_Administrasi->EditValue) <> "" && is_numeric($this->Biaya_Administrasi->EditValue)) $this->Biaya_Administrasi->EditValue = ew_FormatNumber($this->Biaya_Administrasi->EditValue, -2, -2, -2, -2);

			// Biaya_Materai
			$this->Biaya_Materai->EditAttrs["class"] = "form-control";
			$this->Biaya_Materai->EditCustomAttributes = "";
			$this->Biaya_Materai->EditValue = ew_HtmlEncode($this->Biaya_Materai->CurrentValue);
			$this->Biaya_Materai->PlaceHolder = ew_RemoveHtml($this->Biaya_Materai->FldCaption());
			if (strval($this->Biaya_Materai->EditValue) <> "" && is_numeric($this->Biaya_Materai->EditValue)) $this->Biaya_Materai->EditValue = ew_FormatNumber($this->Biaya_Materai->EditValue, -2, -2, -2, -2);

			// marketing_id
			$this->marketing_id->EditAttrs["class"] = "form-control";
			$this->marketing_id->EditCustomAttributes = "";
			if (trim(strval($this->marketing_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->marketing_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t07_marketing`";
			$sWhereWrk = "";
			$this->marketing_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->marketing_id->EditValue = $arwrk;

			// Add refer script
			// Kontrak_No

			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";

			// jaminan_id
			$this->jaminan_id->LinkCustomAttributes = "";
			$this->jaminan_id->HrefValue = "";

			// Pinjaman
			$this->Pinjaman->LinkCustomAttributes = "";
			$this->Pinjaman->HrefValue = "";

			// Angsuran_Lama
			$this->Angsuran_Lama->LinkCustomAttributes = "";
			$this->Angsuran_Lama->HrefValue = "";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->LinkCustomAttributes = "";
			$this->Angsuran_Bunga_Prosen->HrefValue = "";

			// Angsuran_Denda
			$this->Angsuran_Denda->LinkCustomAttributes = "";
			$this->Angsuran_Denda->HrefValue = "";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->LinkCustomAttributes = "";
			$this->Dispensasi_Denda->HrefValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->LinkCustomAttributes = "";
			$this->Angsuran_Pokok->HrefValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->LinkCustomAttributes = "";
			$this->Angsuran_Bunga->HrefValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->LinkCustomAttributes = "";
			$this->Angsuran_Total->HrefValue = "";

			// No_Ref
			$this->No_Ref->LinkCustomAttributes = "";
			$this->No_Ref->HrefValue = "";

			// Biaya_Administrasi
			$this->Biaya_Administrasi->LinkCustomAttributes = "";
			$this->Biaya_Administrasi->HrefValue = "";

			// Biaya_Materai
			$this->Biaya_Materai->LinkCustomAttributes = "";
			$this->Biaya_Materai->HrefValue = "";

			// marketing_id
			$this->marketing_id->LinkCustomAttributes = "";
			$this->marketing_id->HrefValue = "";
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
		if (!$this->Kontrak_No->FldIsDetailKey && !is_null($this->Kontrak_No->FormValue) && $this->Kontrak_No->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_No->FldCaption(), $this->Kontrak_No->ReqErrMsg));
		}
		if (!$this->Kontrak_Tgl->FldIsDetailKey && !is_null($this->Kontrak_Tgl->FormValue) && $this->Kontrak_Tgl->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kontrak_Tgl->FldCaption(), $this->Kontrak_Tgl->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Kontrak_Tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->Kontrak_Tgl->FldErrMsg());
		}
		if (!$this->nasabah_id->FldIsDetailKey && !is_null($this->nasabah_id->FormValue) && $this->nasabah_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nasabah_id->FldCaption(), $this->nasabah_id->ReqErrMsg));
		}
		if ($this->jaminan_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->jaminan_id->FldCaption(), $this->jaminan_id->ReqErrMsg));
		}
		if (!$this->Pinjaman->FldIsDetailKey && !is_null($this->Pinjaman->FormValue) && $this->Pinjaman->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Pinjaman->FldCaption(), $this->Pinjaman->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Pinjaman->FormValue)) {
			ew_AddMessage($gsFormError, $this->Pinjaman->FldErrMsg());
		}
		if (!$this->Angsuran_Lama->FldIsDetailKey && !is_null($this->Angsuran_Lama->FormValue) && $this->Angsuran_Lama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Lama->FldCaption(), $this->Angsuran_Lama->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Angsuran_Lama->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Lama->FldErrMsg());
		}
		if (!$this->Angsuran_Bunga_Prosen->FldIsDetailKey && !is_null($this->Angsuran_Bunga_Prosen->FormValue) && $this->Angsuran_Bunga_Prosen->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Bunga_Prosen->FldCaption(), $this->Angsuran_Bunga_Prosen->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Angsuran_Bunga_Prosen->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Bunga_Prosen->FldErrMsg());
		}
		if (!$this->Angsuran_Denda->FldIsDetailKey && !is_null($this->Angsuran_Denda->FormValue) && $this->Angsuran_Denda->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Denda->FldCaption(), $this->Angsuran_Denda->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Angsuran_Denda->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Denda->FldErrMsg());
		}
		if (!$this->Dispensasi_Denda->FldIsDetailKey && !is_null($this->Dispensasi_Denda->FormValue) && $this->Dispensasi_Denda->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Dispensasi_Denda->FldCaption(), $this->Dispensasi_Denda->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Dispensasi_Denda->FormValue)) {
			ew_AddMessage($gsFormError, $this->Dispensasi_Denda->FldErrMsg());
		}
		if (!$this->Angsuran_Pokok->FldIsDetailKey && !is_null($this->Angsuran_Pokok->FormValue) && $this->Angsuran_Pokok->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Pokok->FldCaption(), $this->Angsuran_Pokok->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Angsuran_Pokok->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Pokok->FldErrMsg());
		}
		if (!$this->Angsuran_Bunga->FldIsDetailKey && !is_null($this->Angsuran_Bunga->FormValue) && $this->Angsuran_Bunga->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Bunga->FldCaption(), $this->Angsuran_Bunga->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Angsuran_Bunga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Bunga->FldErrMsg());
		}
		if (!$this->Angsuran_Total->FldIsDetailKey && !is_null($this->Angsuran_Total->FormValue) && $this->Angsuran_Total->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Angsuran_Total->FldCaption(), $this->Angsuran_Total->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Angsuran_Total->FormValue)) {
			ew_AddMessage($gsFormError, $this->Angsuran_Total->FldErrMsg());
		}
		if (!$this->Biaya_Administrasi->FldIsDetailKey && !is_null($this->Biaya_Administrasi->FormValue) && $this->Biaya_Administrasi->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Biaya_Administrasi->FldCaption(), $this->Biaya_Administrasi->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Biaya_Administrasi->FormValue)) {
			ew_AddMessage($gsFormError, $this->Biaya_Administrasi->FldErrMsg());
		}
		if (!$this->Biaya_Materai->FldIsDetailKey && !is_null($this->Biaya_Materai->FormValue) && $this->Biaya_Materai->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Biaya_Materai->FldCaption(), $this->Biaya_Materai->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Biaya_Materai->FormValue)) {
			ew_AddMessage($gsFormError, $this->Biaya_Materai->FldErrMsg());
		}
		if (!$this->marketing_id->FldIsDetailKey && !is_null($this->marketing_id->FormValue) && $this->marketing_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->marketing_id->FldCaption(), $this->marketing_id->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t04_pinjamanangsurantemp", $DetailTblVar) && $GLOBALS["t04_pinjamanangsurantemp"]->DetailAdd) {
			if (!isset($GLOBALS["t04_pinjamanangsurantemp_grid"])) $GLOBALS["t04_pinjamanangsurantemp_grid"] = new ct04_pinjamanangsurantemp_grid(); // get detail page object
			$GLOBALS["t04_pinjamanangsurantemp_grid"]->ValidateGridForm();
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		if ($this->Kontrak_No->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Kontrak_No = '" . ew_AdjustSql($this->Kontrak_No->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->Kontrak_No->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->Kontrak_No->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// Kontrak_No
		$this->Kontrak_No->SetDbValueDef($rsnew, $this->Kontrak_No->CurrentValue, "", FALSE);

		// Kontrak_Tgl
		$this->Kontrak_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Kontrak_Tgl->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// nasabah_id
		$this->nasabah_id->SetDbValueDef($rsnew, $this->nasabah_id->CurrentValue, 0, FALSE);

		// jaminan_id
		$this->jaminan_id->SetDbValueDef($rsnew, $this->jaminan_id->CurrentValue, "", FALSE);

		// Pinjaman
		$this->Pinjaman->SetDbValueDef($rsnew, $this->Pinjaman->CurrentValue, 0, FALSE);

		// Angsuran_Lama
		$this->Angsuran_Lama->SetDbValueDef($rsnew, $this->Angsuran_Lama->CurrentValue, 0, FALSE);

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->SetDbValueDef($rsnew, $this->Angsuran_Bunga_Prosen->CurrentValue, 0, strval($this->Angsuran_Bunga_Prosen->CurrentValue) == "");

		// Angsuran_Denda
		$this->Angsuran_Denda->SetDbValueDef($rsnew, $this->Angsuran_Denda->CurrentValue, 0, strval($this->Angsuran_Denda->CurrentValue) == "");

		// Dispensasi_Denda
		$this->Dispensasi_Denda->SetDbValueDef($rsnew, $this->Dispensasi_Denda->CurrentValue, 0, strval($this->Dispensasi_Denda->CurrentValue) == "");

		// Angsuran_Pokok
		$this->Angsuran_Pokok->SetDbValueDef($rsnew, $this->Angsuran_Pokok->CurrentValue, 0, FALSE);

		// Angsuran_Bunga
		$this->Angsuran_Bunga->SetDbValueDef($rsnew, $this->Angsuran_Bunga->CurrentValue, 0, FALSE);

		// Angsuran_Total
		$this->Angsuran_Total->SetDbValueDef($rsnew, $this->Angsuran_Total->CurrentValue, 0, FALSE);

		// No_Ref
		$this->No_Ref->SetDbValueDef($rsnew, $this->No_Ref->CurrentValue, NULL, FALSE);

		// Biaya_Administrasi
		$this->Biaya_Administrasi->SetDbValueDef($rsnew, $this->Biaya_Administrasi->CurrentValue, 0, strval($this->Biaya_Administrasi->CurrentValue) == "");

		// Biaya_Materai
		$this->Biaya_Materai->SetDbValueDef($rsnew, $this->Biaya_Materai->CurrentValue, 0, strval($this->Biaya_Materai->CurrentValue) == "");

		// marketing_id
		$this->marketing_id->SetDbValueDef($rsnew, $this->marketing_id->CurrentValue, 0, FALSE);

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

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("t04_pinjamanangsurantemp", $DetailTblVar) && $GLOBALS["t04_pinjamanangsurantemp"]->DetailAdd) {
				$GLOBALS["t04_pinjamanangsurantemp"]->pinjaman_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t04_pinjamanangsurantemp_grid"])) $GLOBALS["t04_pinjamanangsurantemp_grid"] = new ct04_pinjamanangsurantemp_grid(); // Get detail page object
				$AddRow = $GLOBALS["t04_pinjamanangsurantemp_grid"]->GridInsert();
				if (!$AddRow)
					$GLOBALS["t04_pinjamanangsurantemp"]->pinjaman_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
			if (in_array("t04_pinjamanangsurantemp", $DetailTblVar)) {
				if (!isset($GLOBALS["t04_pinjamanangsurantemp_grid"]))
					$GLOBALS["t04_pinjamanangsurantemp_grid"] = new ct04_pinjamanangsurantemp_grid;
				if ($GLOBALS["t04_pinjamanangsurantemp_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t04_pinjamanangsurantemp_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t04_pinjamanangsurantemp_grid"]->CurrentMode = "add";
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->setStartRecordNumber(1);
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->pinjaman_id->FldIsDetailKey = TRUE;
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->pinjaman_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t04_pinjamanangsurantemp_grid"]->pinjaman_id->setSessionValue($GLOBALS["t04_pinjamanangsurantemp_grid"]->pinjaman_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t03_pinjamanlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_nasabah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_nasabah`";
			$sWhereWrk = "";
			$this->nasabah_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nasabah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_jaminan_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Merk_Type` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_jaminan`";
			$sWhereWrk = "{filter}";
			$this->jaminan_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "", "f1" => '`nasabah_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->jaminan_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_marketing_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_marketing`";
			$sWhereWrk = "";
			$this->marketing_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->marketing_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t03_pinjaman_add)) $t03_pinjaman_add = new ct03_pinjaman_add();

// Page init
$t03_pinjaman_add->Page_Init();

// Page main
$t03_pinjaman_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_pinjaman_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft03_pinjamanadd = new ew_Form("ft03_pinjamanadd", "add");

// Validate form
ft03_pinjamanadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Kontrak_No->FldCaption(), $t03_pinjaman->Kontrak_No->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Kontrak_Tgl->FldCaption(), $t03_pinjaman->Kontrak_Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kontrak_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Kontrak_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_nasabah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->nasabah_id->FldCaption(), $t03_pinjaman->nasabah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jaminan_id[]");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->jaminan_id->FldCaption(), $t03_pinjaman->jaminan_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pinjaman");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Pinjaman->FldCaption(), $t03_pinjaman->Pinjaman->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Pinjaman");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Pinjaman->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Lama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Lama->FldCaption(), $t03_pinjaman->Angsuran_Lama->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Lama");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Lama->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Bunga_Prosen");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Bunga_Prosen->FldCaption(), $t03_pinjaman->Angsuran_Bunga_Prosen->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Bunga_Prosen");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Bunga_Prosen->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Denda");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Denda->FldCaption(), $t03_pinjaman->Angsuran_Denda->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Denda");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Denda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Dispensasi_Denda");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Dispensasi_Denda->FldCaption(), $t03_pinjaman->Dispensasi_Denda->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Dispensasi_Denda");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Dispensasi_Denda->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Pokok");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Pokok->FldCaption(), $t03_pinjaman->Angsuran_Pokok->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Pokok");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Pokok->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Bunga");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Bunga->FldCaption(), $t03_pinjaman->Angsuran_Bunga->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Bunga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Bunga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Total");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Angsuran_Total->FldCaption(), $t03_pinjaman->Angsuran_Total->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Angsuran_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Angsuran_Total->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Administrasi");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Biaya_Administrasi->FldCaption(), $t03_pinjaman->Biaya_Administrasi->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Administrasi");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Biaya_Administrasi->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Materai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->Biaya_Materai->FldCaption(), $t03_pinjaman->Biaya_Materai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Biaya_Materai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_pinjaman->Biaya_Materai->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_marketing_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_pinjaman->marketing_id->FldCaption(), $t03_pinjaman->marketing_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft03_pinjamanadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_pinjamanadd.ValidateRequired = true;
<?php } else { ?>
ft03_pinjamanadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_pinjamanadd.Lists["x_nasabah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_jaminan_id[]"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_nasabah"};
ft03_pinjamanadd.Lists["x_jaminan_id[]"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Merk_Type","","",""],"ParentFields":["x_nasabah_id"],"ChildFields":[],"FilterFields":["x_nasabah_id"],"Options":[],"Template":"","LinkTable":"t02_jaminan"};
ft03_pinjamanadd.Lists["x_marketing_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_marketing"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t03_pinjaman_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t03_pinjaman_add->ShowPageHeader(); ?>
<?php
$t03_pinjaman_add->ShowMessage();
?>
<form name="ft03_pinjamanadd" id="ft03_pinjamanadd" class="<?php echo $t03_pinjaman_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_pinjaman_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_pinjaman_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_pinjaman">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t03_pinjaman_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
	<div id="r_Kontrak_No" class="form-group">
		<label id="elh_t03_pinjaman_Kontrak_No" for="x_Kontrak_No" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Kontrak_No->CellAttributes() ?>>
<span id="el_t03_pinjaman_Kontrak_No">
<input type="text" data-table="t03_pinjaman" data-field="x_Kontrak_No" name="x_Kontrak_No" id="x_Kontrak_No" size="5" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Kontrak_No->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Kontrak_No->EditValue ?>"<?php echo $t03_pinjaman->Kontrak_No->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Kontrak_No->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
	<div id="r_Kontrak_Tgl" class="form-group">
		<label id="elh_t03_pinjaman_Kontrak_Tgl" for="x_Kontrak_Tgl" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Kontrak_Tgl->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Kontrak_Tgl->CellAttributes() ?>>
<span id="el_t03_pinjaman_Kontrak_Tgl">
<input type="text" data-table="t03_pinjaman" data-field="x_Kontrak_Tgl" data-format="7" name="x_Kontrak_Tgl" id="x_Kontrak_Tgl" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Kontrak_Tgl->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Kontrak_Tgl->EditValue ?>"<?php echo $t03_pinjaman->Kontrak_Tgl->EditAttributes() ?>>
<?php if (!$t03_pinjaman->Kontrak_Tgl->ReadOnly && !$t03_pinjaman->Kontrak_Tgl->Disabled && !isset($t03_pinjaman->Kontrak_Tgl->EditAttrs["readonly"]) && !isset($t03_pinjaman->Kontrak_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft03_pinjamanadd", "x_Kontrak_Tgl", 7);
</script>
<?php } ?>
</span>
<?php echo $t03_pinjaman->Kontrak_Tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
	<div id="r_nasabah_id" class="form-group">
		<label id="elh_t03_pinjaman_nasabah_id" for="x_nasabah_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_nasabah_id">
<?php $t03_pinjaman->nasabah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t03_pinjaman->nasabah_id->EditAttrs["onchange"]; ?>
<select data-table="t03_pinjaman" data-field="x_nasabah_id" data-value-separator="<?php echo $t03_pinjaman->nasabah_id->DisplayValueSeparatorAttribute() ?>" id="x_nasabah_id" name="x_nasabah_id"<?php echo $t03_pinjaman->nasabah_id->EditAttributes() ?>>
<?php echo $t03_pinjaman->nasabah_id->SelectOptionListHtml("x_nasabah_id") ?>
</select>
<input type="hidden" name="s_x_nasabah_id" id="s_x_nasabah_id" value="<?php echo $t03_pinjaman->nasabah_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_pinjaman->nasabah_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->jaminan_id->Visible) { // jaminan_id ?>
	<div id="r_jaminan_id" class="form-group">
		<label id="elh_t03_pinjaman_jaminan_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->jaminan_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->jaminan_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_jaminan_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<?php echo $t03_pinjaman->jaminan_id->ViewValue ?>
	</span>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<div id="dsl_x_jaminan_id" data-repeatcolumn="5" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $t03_pinjaman->jaminan_id->CheckBoxListHtml(TRUE, "x_jaminan_id[]") ?>
		</div>
	</div>
	<div id="tp_x_jaminan_id" class="ewTemplate"><input type="checkbox" data-table="t03_pinjaman" data-field="x_jaminan_id" data-value-separator="<?php echo $t03_pinjaman->jaminan_id->DisplayValueSeparatorAttribute() ?>" name="x_jaminan_id[]" id="x_jaminan_id[]" value="{value}"<?php echo $t03_pinjaman->jaminan_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="s_x_jaminan_id" id="s_x_jaminan_id" value="<?php echo $t03_pinjaman->jaminan_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_pinjaman->jaminan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
	<div id="r_Pinjaman" class="form-group">
		<label id="elh_t03_pinjaman_Pinjaman" for="x_Pinjaman" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el_t03_pinjaman_Pinjaman">
<input type="text" data-table="t03_pinjaman" data-field="x_Pinjaman" name="x_Pinjaman" id="x_Pinjaman" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Pinjaman->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Pinjaman->EditValue ?>"<?php echo $t03_pinjaman->Pinjaman->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Pinjaman->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
	<div id="r_Angsuran_Lama" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Lama" for="x_Angsuran_Lama" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Lama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Lama->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Lama">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Lama" name="x_Angsuran_Lama" id="x_Angsuran_Lama" size="5" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Lama->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Lama->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Lama->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Lama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
	<div id="r_Angsuran_Bunga_Prosen" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Bunga_Prosen" for="x_Angsuran_Bunga_Prosen" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Bunga_Prosen">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Bunga_Prosen" name="x_Angsuran_Bunga_Prosen" id="x_Angsuran_Bunga_Prosen" size="5" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Bunga_Prosen->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
	<div id="r_Angsuran_Denda" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Denda" for="x_Angsuran_Denda" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Denda->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Denda">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Denda" name="x_Angsuran_Denda" id="x_Angsuran_Denda" size="5" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Denda->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Denda->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Denda->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Denda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
	<div id="r_Dispensasi_Denda" class="form-group">
		<label id="elh_t03_pinjaman_Dispensasi_Denda" for="x_Dispensasi_Denda" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Dispensasi_Denda->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Dispensasi_Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Dispensasi_Denda">
<input type="text" data-table="t03_pinjaman" data-field="x_Dispensasi_Denda" name="x_Dispensasi_Denda" id="x_Dispensasi_Denda" size="5" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Dispensasi_Denda->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Dispensasi_Denda->EditValue ?>"<?php echo $t03_pinjaman->Dispensasi_Denda->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Dispensasi_Denda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
	<div id="r_Angsuran_Pokok" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Pokok" for="x_Angsuran_Pokok" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Pokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Pokok->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Pokok">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Pokok" name="x_Angsuran_Pokok" id="x_Angsuran_Pokok" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Pokok->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Pokok->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Pokok->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Pokok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
	<div id="r_Angsuran_Bunga" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Bunga" for="x_Angsuran_Bunga" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Bunga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Bunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Bunga">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Bunga" name="x_Angsuran_Bunga" id="x_Angsuran_Bunga" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Bunga->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Bunga->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Bunga->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Bunga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Total->Visible) { // Angsuran_Total ?>
	<div id="r_Angsuran_Total" class="form-group">
		<label id="elh_t03_pinjaman_Angsuran_Total" for="x_Angsuran_Total" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Angsuran_Total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Angsuran_Total->CellAttributes() ?>>
<span id="el_t03_pinjaman_Angsuran_Total">
<input type="text" data-table="t03_pinjaman" data-field="x_Angsuran_Total" name="x_Angsuran_Total" id="x_Angsuran_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Angsuran_Total->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Angsuran_Total->EditValue ?>"<?php echo $t03_pinjaman->Angsuran_Total->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Angsuran_Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->No_Ref->Visible) { // No_Ref ?>
	<div id="r_No_Ref" class="form-group">
		<label id="elh_t03_pinjaman_No_Ref" for="x_No_Ref" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->No_Ref->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->No_Ref->CellAttributes() ?>>
<span id="el_t03_pinjaman_No_Ref">
<select data-table="t03_pinjaman" data-field="x_No_Ref" data-value-separator="<?php echo $t03_pinjaman->No_Ref->DisplayValueSeparatorAttribute() ?>" id="x_No_Ref" name="x_No_Ref"<?php echo $t03_pinjaman->No_Ref->EditAttributes() ?>>
<?php echo $t03_pinjaman->No_Ref->SelectOptionListHtml("x_No_Ref") ?>
</select>
</span>
<?php echo $t03_pinjaman->No_Ref->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Biaya_Administrasi->Visible) { // Biaya_Administrasi ?>
	<div id="r_Biaya_Administrasi" class="form-group">
		<label id="elh_t03_pinjaman_Biaya_Administrasi" for="x_Biaya_Administrasi" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Biaya_Administrasi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Biaya_Administrasi->CellAttributes() ?>>
<span id="el_t03_pinjaman_Biaya_Administrasi">
<input type="text" data-table="t03_pinjaman" data-field="x_Biaya_Administrasi" name="x_Biaya_Administrasi" id="x_Biaya_Administrasi" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Biaya_Administrasi->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Biaya_Administrasi->EditValue ?>"<?php echo $t03_pinjaman->Biaya_Administrasi->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Biaya_Administrasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->Biaya_Materai->Visible) { // Biaya_Materai ?>
	<div id="r_Biaya_Materai" class="form-group">
		<label id="elh_t03_pinjaman_Biaya_Materai" for="x_Biaya_Materai" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->Biaya_Materai->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->Biaya_Materai->CellAttributes() ?>>
<span id="el_t03_pinjaman_Biaya_Materai">
<input type="text" data-table="t03_pinjaman" data-field="x_Biaya_Materai" name="x_Biaya_Materai" id="x_Biaya_Materai" size="10" placeholder="<?php echo ew_HtmlEncode($t03_pinjaman->Biaya_Materai->getPlaceHolder()) ?>" value="<?php echo $t03_pinjaman->Biaya_Materai->EditValue ?>"<?php echo $t03_pinjaman->Biaya_Materai->EditAttributes() ?>>
</span>
<?php echo $t03_pinjaman->Biaya_Materai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_pinjaman->marketing_id->Visible) { // marketing_id ?>
	<div id="r_marketing_id" class="form-group">
		<label id="elh_t03_pinjaman_marketing_id" for="x_marketing_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_pinjaman->marketing_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_pinjaman->marketing_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_marketing_id">
<select data-table="t03_pinjaman" data-field="x_marketing_id" data-value-separator="<?php echo $t03_pinjaman->marketing_id->DisplayValueSeparatorAttribute() ?>" id="x_marketing_id" name="x_marketing_id"<?php echo $t03_pinjaman->marketing_id->EditAttributes() ?>>
<?php echo $t03_pinjaman->marketing_id->SelectOptionListHtml("x_marketing_id") ?>
</select>
<input type="hidden" name="s_x_marketing_id" id="s_x_marketing_id" value="<?php echo $t03_pinjaman->marketing_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_pinjaman->marketing_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php
	if (in_array("t04_pinjamanangsurantemp", explode(",", $t03_pinjaman->getCurrentDetailTable())) && $t04_pinjamanangsurantemp->DetailAdd) {
?>
<?php if ($t03_pinjaman->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t04_pinjamanangsurantemp", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t04_pinjamanangsurantempgrid.php" ?>
<?php } ?>
<?php if (!$t03_pinjaman_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_pinjaman_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft03_pinjamanadd.Init();
</script>
<?php
$t03_pinjaman_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");
// tampilkan TANGGAL HARI INI di field KONTRAK_TGL

$("#x_Kontrak_Tgl").val("<?php echo date('d-m-Y');?>");
</script>
<?php include_once "footer.php" ?>
<?php
$t03_pinjaman_add->Page_Terminate();
?>
