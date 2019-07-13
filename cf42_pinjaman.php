<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$cf42_pinjaman_php = NULL; // Initialize page object first

class ccf42_pinjaman_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf42_pinjaman.php';

	// Page object name
	var $PageObjName = 'cf42_pinjaman_php';

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
			define("EW_PAGE_ID", 'custom', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cf42_pinjaman.php', TRUE);

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
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanReport()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

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

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
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

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("custom", "cf42_pinjaman_php", $url, "", "cf42_pinjaman_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf42_pinjaman_php)) $cf42_pinjaman_php = new ccf42_pinjaman_php();

// Page init
$cf42_pinjaman_php->Page_Init();

// Page main
$cf42_pinjaman_php->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<?php if (!@$gbSkipHeaderFooter) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$aselect = array();

$q = "select * from t73_pinjamanlap where field_status = 'Y' and field_index <> 0 order by field_index";
//echo $q;
$r = Conn()->Execute($q);
while (!$r->EOF) {
	$aselect[] = array($r->fields["field_name"], $r->fields["field_caption"], $r->fields["field_align"], $r->fields["field_format"]);
	$r->MoveNext();
}

//var_dump($aselect);

echo "
<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Data Pinjaman</label><br/>
&nbsp;<br/>
<div class='panel panel-default'>			
<div>
<table class='table table-striped table-hover table-condensed'>
<tbody>";

$html = "
<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Data Pinjaman</label><br/>
<br/>
<div class='panel panel-default'>			
<div>
<table class='table table-striped table-hover table-condensed'>
<tbody>";

$lewat = 0;
$no = 0;

$q = "select ";
for ($i = 0; $i < count($aselect); $i++) {
	$q .= $aselect[$i][0] . ", ";
}
$q = substr($q, 0, strlen($q) - 2);
$q .= " from v0302_pinjamanlap"; //echo $q;
$r = Conn()->Execute($q);

while (!$r->EOF) {
	if ($lewat == 0) {
		$lewat = 1;
		echo "
		<tr>
		<td>&nbsp;</td>";
		$html .= "
		<tr>
		<td> </td>";
		for($i = 0; $i < count($aselect); $i++) {
			echo "
			<td align='".$aselect[$i][2]."'>" . $aselect[$i][1] . "</td>";
			$html .= "
			<td align='".$aselect[$i][2]."'>" . $aselect[$i][1] . "</td>";
		}
		echo "
		</tr>";
		$html .= "
		</tr>";
	}

	echo "
	<tr>
	<td>".++$no.".&nbsp;</td>";
	$html .= "
	<tr>
	<td>".$no.".</td>";
	for ($i = 0; $i < count($aselect); $i++) {
		//$q .= $aselect[$i] . ", ";
		//echo $r->fields[$aselect[$i]];
		if ($aselect[$i][3] == "none") {
			$data_tampil = $r->fields[$aselect[$i][0]];
		}
		elseif ($aselect[$i][3] == "tanggal") {
			if (is_null($r->fields[$aselect[$i][0]])) {
				$data_tampil = "";
			}
			else {
				$data_tampil = date_format(date_create($r->fields[$aselect[$i][0]]), "d-m-Y");
			}
		}
		elseif ($aselect[$i][3] == "numerik") {
			$data_tampil = number_format($r->fields[$aselect[$i][0]], 2);
		}
		//echo "
		//<td align='".$aselect[$i][2]."'>" . $r->fields[$aselect[$i][0]] . "</td>";
		echo "
		<td align='".$aselect[$i][2]."'>" . $data_tampil . "</td>";
		$html .= "
		<td align='".$aselect[$i][2]."'>" . $data_tampil . "</td>";
	}
	echo "
	</tr>";
	$html .= "
	</tr>";
	$r->MoveNext();
}

echo "
</tbody>
</table>
</div>
</div>";
$html .= "
</tbody>
</table>
</div>
</div>";
?>

<form name="frm_input_periode" class="form-horizontal ewForm ewExtFilterForm" method="post" action="cf43_pinjaman.php" target="_blank">
	<input type="hidden" name="data" value="<?php echo $html?>">
<div>
	<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick="window.location.href='t73_pinjamanlaplist.php?a=gridedit'">Config</button>
	<button class='btn btn-primary ewButton' name='btnexport' id='btnsubmit' type='submit'>to Excel</button>
	<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick="window.location.href='.'">Selesai</button>
</div>
</form>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf42_pinjaman_php->Page_Terminate();
?>
