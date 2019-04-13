<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$default = NULL; // Initialize page object first

class cdefault {

	// Page ID
	var $PageID = 'default';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;

		// If session expired, show session expired message
		if (@$_GET["expired"] == "1")
			$this->setFailureMessage($Language->Phrase("SessionExpired"));
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // Load User Level
		if ($Security->AllowList(CurrentProjectID() . 'cf01_home.php'))
		$this->Page_Terminate("cf01_home.php"); // Exit and go to default page
		if ($Security->AllowList(CurrentProjectID() . 'cf02_tutupbuku.php'))
			$this->Page_Terminate("cf02_tutupbuku.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf04_neraca.php'))
			$this->Page_Terminate("cf04_neraca.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf09_nasabahmacet.php'))
			$this->Page_Terminate("cf09_nasabahmacet.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf10_bukubesar.php'))
			$this->Page_Terminate("cf10_bukubesar.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf10_bukubesarproses.php'))
			$this->Page_Terminate("cf10_bukubesarproses.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf11_jurnal.php'))
			$this->Page_Terminate("cf11_jurnal.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf12_labarugi.php'))
			$this->Page_Terminate("cf12_labarugi.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf13_neraca.php'))
			$this->Page_Terminate("cf13_neraca.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf14_backup.php'))
			$this->Page_Terminate("cf14_backup.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf15_restore.php'))
			$this->Page_Terminate("cf15_restore.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf21_jurnalclosed.php'))
			$this->Page_Terminate("cf21_jurnalclosed.php");
		if ($Security->AllowList(CurrentProjectID() . 't01_nasabah'))
			$this->Page_Terminate("t01_nasabahlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't02_jaminan'))
			$this->Page_Terminate("t02_jaminanlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't03_pinjaman'))
			$this->Page_Terminate("t03_pinjamanlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't04_pinjamanangsuran'))
			$this->Page_Terminate("t04_pinjamanangsuranlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't04_pinjamanangsurantemp'))
			$this->Page_Terminate("t04_pinjamanangsurantemplist.php");
		if ($Security->AllowList(CurrentProjectID() . 't05_pinjamanjaminan'))
			$this->Page_Terminate("t05_pinjamanjaminanlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't06_pinjamantitipan'))
			$this->Page_Terminate("t06_pinjamantitipanlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't07_marketing'))
			$this->Page_Terminate("t07_marketinglist.php");
		if ($Security->AllowList(CurrentProjectID() . 't08_pinjamanpotongan'))
			$this->Page_Terminate("t08_pinjamanpotonganlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't10_jurnal'))
			$this->Page_Terminate("t10_jurnallist.php");
		if ($Security->AllowList(CurrentProjectID() . 't11_jurnalmaster'))
			$this->Page_Terminate("t11_jurnalmasterlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't12_jurnaldetail'))
			$this->Page_Terminate("t12_jurnaldetaillist.php");
		if ($Security->AllowList(CurrentProjectID() . 't74_jurnallapclosed'))
			$this->Page_Terminate("t74_jurnallapclosedlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't75_company'))
			$this->Page_Terminate("t75_companylist.php");
		if ($Security->AllowList(CurrentProjectID() . 't78_bukubesarlap'))
			$this->Page_Terminate("t78_bukubesarlaplist.php");
		if ($Security->AllowList(CurrentProjectID() . 't79_jurnallap'))
			$this->Page_Terminate("t79_jurnallaplist.php");
		if ($Security->AllowList(CurrentProjectID() . 't85_neraca2'))
			$this->Page_Terminate("t85_neraca2list.php");
		if ($Security->AllowList(CurrentProjectID() . 't86_labarugi2'))
			$this->Page_Terminate("t86_labarugi2list.php");
		if ($Security->AllowList(CurrentProjectID() . 't87_neraca'))
			$this->Page_Terminate("t87_neracalist.php");
		if ($Security->AllowList(CurrentProjectID() . 't88_labarugi'))
			$this->Page_Terminate("t88_labarugilist.php");
		if ($Security->AllowList(CurrentProjectID() . 't89_rektran'))
			$this->Page_Terminate("t89_rektranlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't90_rektran'))
			$this->Page_Terminate("t90_rektranlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't91_rekening'))
			$this->Page_Terminate("t91_rekeninglist.php");
		if ($Security->AllowList(CurrentProjectID() . 't92_periodeold'))
			$this->Page_Terminate("t92_periodeoldlist.php");
		if ($Security->AllowList(CurrentProjectID() . 't93_periode'))
			$this->Page_Terminate("t93_periodelist.php");
		if ($Security->AllowList(CurrentProjectID() . 't94_log'))
			$this->Page_Terminate("t94_loglist.php");
		if ($Security->AllowList(CurrentProjectID() . 't95_logdesc'))
			$this->Page_Terminate("t95_logdesclist.php");
		if ($Security->AllowList(CurrentProjectID() . 't96_employees'))
			$this->Page_Terminate("t96_employeeslist.php");
		if ($Security->AllowList(CurrentProjectID() . 't97_userlevels'))
			$this->Page_Terminate("t97_userlevelslist.php");
		if ($Security->AllowList(CurrentProjectID() . 't98_userlevelpermissions'))
			$this->Page_Terminate("t98_userlevelpermissionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 't99_audittrail'))
			$this->Page_Terminate("t99_audittraillist.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf31_jurnal.php'))
			$this->Page_Terminate("cf31_jurnal.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf32_bukubesar.php'))
			$this->Page_Terminate("cf32_bukubesar.php");
		if ($Security->AllowList(CurrentProjectID() . 'cf33_labarugi.php'))
			$this->Page_Terminate("cf33_labarugi.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage(ew_DeniedMsg() . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($default)) $default = new cdefault();

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
