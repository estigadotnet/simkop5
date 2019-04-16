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

$cf35_neracasaldo_php = NULL; // Initialize page object first

class ccf35_neracasaldo_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf35_neracasaldo.php';

	// Page object name
	var $PageObjName = 'cf35_neracasaldo_php';

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
			define("EW_TABLE_NAME", 'cf35_neracasaldo.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf35_neracasaldo_php", $url, "", "cf35_neracasaldo_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf35_neracasaldo_php)) $cf35_neracasaldo_php = new ccf35_neracasaldo_php();

// Page init
$cf35_neracasaldo_php->Page_Init();

// Page main
$cf35_neracasaldo_php->Page_Main();

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
$abulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

<form name="frm_input_periode" class="form-horizontal ewForm ewExtFilterForm" method="post">
<div>
	<div id="r_1" class="form-group">
		<label class="col-sm-2 control-label ewLabel">Periode</label>
		<div class="col-sm-10">
			<div>
			<span>
			<select name="bulan" class="form-control">
			<?php
			foreach($abulan as $index => $bulan) {
			?>
			<option value="<?php echo $index;?>"
			<?php
			if (isset($_POST['bulan'])) {
				if ($index == $_POST['bulan']) {
					echo "selected";
				}
			}
			elseif ($index == ew_ExecuteScalar('select Bulan from t93_periode')) {
				echo "selected";
			}
			?>
			>
			<?php echo $bulan; ?>
			</option>
			<?php
			}
			?>
			</select>
			</span>
			</div>
		</div>
	</div>
	<div id="r_2" class="form-group">
		<label class="col-sm-2 control-label ewLabel">Tahun</label>
		<div class="col-sm-10">
			<div>
			<span>
			<select name="tahun" class="form-control">
			<?php
			$q = "select Tahun from t93_periode order by Tahun";
			$r = Conn()->Execute($q);
			while(!$r->EOF) {
			?>
			<option value="<?php echo $r->fields["Tahun"]?>"><?php echo $r->fields["Tahun"]; ?></option>
			<?php
			$r->MoveNext();
			}
			?>
			</select>
			</span>
			</div>
		</div>
	</div>
	<div id="r_1" class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button class="btn btn-primary ewButton" name="btnproses" id="btnsubmit" type="submit">Proses</button>
		<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick="window.location.href='.'">Selesai</button>
	</div>
	</div>
</div>
</form>

<?php
if (isset($_POST["btnproses"])) { // begin -proses-

	// kodetransaksi = 11
	$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '11'");
	$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '11'");

	$periode_aktif = ew_ExecuteScalar("select Tahun_Bulan from t93_periode");
	$periode_input = $_POST["tahun"].substr("00" . $_POST["bulan"], -2);

	$a_Bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	//<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$r->fields["Bulan"]] . " " . $r->fields["Tahun"] . "</label><br/>
	echo "
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Neraca Saldo</label><br/>
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$_POST["bulan"]] . " " . $_POST["tahun"] . "</label><br/>
	&nbsp;<br/>
	<div class='panel panel-default'>			
	<div>
	<table class='table table-striped table-hover table-condensed'>
	<tbody>
	<tr>
	<th>Kode</th>
	<th>Rekening</th>
	<th align='right'>Debet</th>
	<th align='right'>Kredit</th>
	</tr>";

	if ($periode_aktif == $periode_input) {
		$q = "select * from v31_mutasi order by id";
	}
	else {
		$q = "select * from v41_mutasiold where periode = '".$periode_input."' order by id";
	}
	//echo $q;
	$debet = 0;
	$kredit = 0;
	$r = Conn()->Execute($q);
	while (!$r->EOF) {
		//echo $r->fields["id"] . " - " . $r->fields["saldoakhir"] . "<br/>";
		echo "
		<tr>
		<td>" . $r->fields["id"] . "</td>
		<td>" . $r->fields["rekening"] . "</td>";
		if ($r->fields["group"] == "1" or $r->fields["group"] == "4" or $r->fields["group"] == "6") {
			echo "
			<td align='right'>" . number_format($r->fields["saldoakhir"], 2) . "</td>
			<td>&nbsp;</td>";
			$debet += $r->fields["saldoakhir"];
		}
		else {
			/*echo "
			<td>&nbsp;</td>
			<td>" . $r->fields["saldoakhir"] . "</td>
			";
			$kredit += $r->fields["saldoakhir"];*/
			echo "
			<td>&nbsp;</td>";
			if ($r->fields["id"] == $rekdebet) {
				if ($periode_aktif == $periode_input) {
					$kredit += f_hitunglabarugi2($GLOBALS["Periode"]);
					echo "<td align='right'>" . number_format(f_hitunglabarugi2($GLOBALS["Periode"]), 2) . "</td>";
				}
				else {
					$kredit += f_hitunglabarugiold2($periode_input);
					echo "<td align='right'>" . number_format(f_hitunglabarugiold2($periode_input), 2) . "</td>";
				}
			}
			else {
				$kredit += $r->fields["saldoakhir"];
				echo "<td align='right'>" . number_format($r->fields["saldoakhir"], 2) . "</td>";
			}
		}
		
		echo "
		</tr>";
		$r->MoveNext();
	}

	echo "
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align='right'><strong>".number_format($debet, 2)."</strong></td>
	<td align='right'><strong>".number_format($kredit, 2)."</strong></td>
	</tr>
	</tbody>
	</table>
	</div>
	</div>";

} // end -proses-
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf35_neracasaldo_php->Page_Terminate();
?>
