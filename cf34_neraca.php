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

$cf34_neraca_php = NULL; // Initialize page object first

class ccf34_neraca_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf34_neraca.php';

	// Page object name
	var $PageObjName = 'cf34_neraca_php';

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
			define("EW_TABLE_NAME", 'cf34_neraca.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf34_neraca_php", $url, "", "cf34_neraca_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf34_neraca_php)) $cf34_neraca_php = new ccf34_neraca_php();

// Page init
$cf34_neraca_php->Page_Init();

// Page main
$cf34_neraca_php->Page_Main();

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

	// ambil [data bulan dan tahun] periode aktif
	$r = ew_ExecuteRow("select * from t93_periode");
	$bulan_periode_aktif = $r["Bulan"];
	$tahun_periode_aktif = $r["Tahun"];
	$tahunbulan_periode_aktif = $r["Tahun_Bulan"];

	// ambil data periode lama :: 2 periode sebelum periode aktif,
	// ambil datanya dari tabel t92_periodeold
	$a_periode_lalu = array();
	$q = "select Tahun_Bulan from t92_periodeold where Tahun = '".$r["Tahun"]."'
		order by Tahun_Bulan limit 2";
	$q = "select * from (SELECT * FROM `t92_periodeold` where Tahun = '".$r["Tahun"]."' order by tahun_bulan desc limit 2) rs2 order by tahun_bulan";
	$r = Conn()->Execute($q);
	while(!$r->EOF) {
		$a_periode_lalu[] = $r->fields["Tahun_Bulan"];
		$r->MoveNext();
	}

	//var_dump($a_periode_lalu);

	// begin of create table
	// tampilkan header laporan
	echo "
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Neraca</label><br/>
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Tahun " . $_POST["tahun"] . "</label><br/>
	&nbsp;<br/>
	<div class='panel panel-default'>			
	<div>
	<table class='table table-striped table-hover table-condensed'>
	<tbody>";

	// hapus t87_neraca
	$q = "delete from t87_neraca";
	Conn()->Execute($q);

	// tampilkan baris periode
	echo "
	<tr>
	<th>&nbsp;</th>
	<th>&nbsp;</th>";
	$a_bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	if (count($a_periode_lalu) == 0) {
		$periode = $a_bulan[intval(substr($GLOBALS["Periode"], -2))] . " " . substr($GLOBALS["Periode"], 0, 4);
		$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '".$periode."')"; Conn()->Execute($q);
		echo "<th>".$periode."</th>";
	}
	elseif (count($a_periode_lalu) == 1) {
		$periode = $a_bulan[intval(substr($GLOBALS["Periode"], -2))] . " " . substr($GLOBALS["Periode"], 0, 4);
		$periodeold[0] = $a_bulan[intval(substr($a_periode_lalu[0], -2))] . " " . substr($a_periode_lalu[0], 0, 4);
		$q = "insert into t87_neraca (field01, field02, field03, field04) values ('', '', '".$periodeold[0]."', '".$periode."')"; Conn()->Execute($q);
		echo "<th>".$periodeold[0]."</th><th>".$periode."</th>";
	}
	elseif (count($a_periode_lalu) == 2) {
		$periode = $a_bulan[intval(substr($GLOBALS["Periode"], -2))] . " " . substr($GLOBALS["Periode"], 0, 4);
		$periodeold[0] = $a_bulan[intval(substr($a_periode_lalu[0], -2))] . " " . substr($a_periode_lalu[0], 0, 4);
		$periodeold[1] = $a_bulan[intval(substr($a_periode_lalu[1], -2))] . " " . substr($a_periode_lalu[1], 0, 4);
		$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('', '', '".$periodeold[0]."', '".$periodeold[1]."', '".$periode."')"; Conn()->Execute($q);
		echo "<th>".$periodeold[0]."</th><th>".$periodeold[1]."</th><th>".$periode."</th>";
	}
	echo "
	</tr>";

	// kodetransaksi = 11
	$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '11'");
	$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '11'");

	// id 1
	$mtotal = 0;
	$mtotalold[0] = 0;
	$mtotalold[1] = 0;
	$q = "select * from v33_neraca where `group` = '1' order by id"; //echo $q;
	$r = Conn()->Execute($q);
	$q2 = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r->fields["group_rekening"]."</strong>', '', '')"; Conn()->Execute($q2);
	echo "
	<tr>
	<td><strong>".$r->fields["group_rekening"]."</strong></td>";
	if (count($a_periode_lalu) == 0) {
		echo "<td colspan='2'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 1) {
		echo "<td colspan='3'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 2) {
		echo "<td colspan='4'>&nbsp;</td>";
	}
	echo "
	</tr>
	";
	while (!$r->EOF) {
		$nilai = $r->fields["saldoakhir"];
		$mtotal += $nilai;
		if (count($a_periode_lalu) == 0) {
			$q = "insert into t87_neraca (field01, field02, field03) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}
		elseif (count($a_periode_lalu) == 1) {
			$q1 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[0]."'"; //echo $q1;
			$r1 = Conn()->Execute($q1);
			$nilaiold[0] = $r1->fields["saldoakhir"];
			$mtotalold[0] += $nilaiold[0];
			$q = "insert into t87_neraca (field01, field02, field03, field04) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilaiold[0], 2)."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilaiold[0], 2)."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}
		elseif (count($a_periode_lalu) == 2) {
			$q1 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[0]."'"; //echo $q1;
			$r1 = Conn()->Execute($q1);
			$nilaiold[0] = $r1->fields["saldoakhir"];
			$mtotalold[0] += $nilaiold[0];
			$q2 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[1]."'"; //echo $q1;
			$r2 = Conn()->Execute($q2);
			$nilaiold[1] = $r2->fields["saldoakhir"];
			$mtotalold[1] += $nilaiold[1];
			$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilaiold[0], 2)."', '".number_format($nilaiold[1], 2)."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilaiold[0], 2)."</td>
			<td align='right'>".number_format($nilaiold[1], 2)."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}
		$r->MoveNext();
	}

	// sub total
	if (count($a_periode_lalu) == 0) {
		$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);
	}
	elseif (count($a_periode_lalu) == 1) {
		$q = "insert into t87_neraca (field01, field02, field03, field04) values ('', '', '<strong>".number_format($mtotalold[0], 2)."</strong>', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);
	}
	elseif (count($a_periode_lalu) == 2) {
		$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotalold[0], 2)."</strong>', '<strong>".number_format($mtotalold[1], 2)."</strong>', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);
	}

	echo "
	<tr>
	<td colspan='2'>&nbsp;</td>";
	if (count($a_periode_lalu) == 0) {
		echo "<td align='right'><strong>".number_format($mtotal, 2)."</strong></td>";
		echo "</tr><tr><td colspan='3'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 1) {
		echo "<td align='right'><strong>".number_format($mtotalold[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotal, 2)."</strong></td>";
		echo "</tr><tr><td colspan='4'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 2) {
		echo "<td align='right'><strong>".number_format($mtotalold[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotalold[1], 2)."</strong></td><td align='right'><strong>".number_format($mtotal, 2)."</strong></td>";
		echo "</tr><tr><td colspan='5'>&nbsp;</td>";
	}
	echo "
	</tr>
	";
	$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);


	// id 2
	$mtotal2 = 0;
	$mtotal2old[0] = 0;
	$mtotal2old[1] = 0;
	$q = "select * from v33_neraca where `group` = '2' order by id"; //echo $q;
	$r = Conn()->Execute($q);
	$q2 = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r->fields["group_rekening"]."</strong>', '', '')"; Conn()->Execute($q2);
	echo "
	<tr>
	<td><strong>".$r->fields["group_rekening"]."</strong></td>";
	if (count($a_periode_lalu) == 0) {
		echo "<td colspan='2'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 1) {
		echo "<td colspan='3'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 2) {
		echo "<td colspan='4'>&nbsp;</td>";
	}
	echo "
	</tr>
	";
	while (!$r->EOF) {
		if ($r->fields["id"] == $rekdebet) {
			if (count($a_periode_lalu) == 0) {
				$nilai = f_hitunglabarugi2($GLOBALS["Periode"]);
			}
			elseif (count($a_periode_lalu) == 1) {
				$nilai = f_hitunglabarugi2($GLOBALS["Periode"]);
				$nilaiold[0] = f_hitunglabarugiold2($a_periode_lalu[0]);
			}
			elseif (count($a_periode_lalu) == 2) {
				$nilai = f_hitunglabarugi2($GLOBALS["Periode"]);
				$nilaiold[0] = f_hitunglabarugiold2($a_periode_lalu[0]);
				$nilaiold[1] = f_hitunglabarugiold2($a_periode_lalu[1]);
			}
		}
		else {
			if (count($a_periode_lalu) == 0) {
				$nilai = $r->fields["saldoakhir"];
			}
			elseif (count($a_periode_lalu) == 1) {
				$nilai = $r->fields["saldoakhir"];
				$q1 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[0]."'"; //echo $q1;
				$r1 = Conn()->Execute($q1);
				$nilaiold[0] = $r1->fields["saldoakhir"];
			}
			elseif (count($a_periode_lalu) == 2) {
				$nilai = $r->fields["saldoakhir"];
				$q1 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[0]."'"; //echo $q1;
				$r1 = Conn()->Execute($q1);
				$nilaiold[0] = $r1->fields["saldoakhir"];
				$q2 = "select * from v43_neracaold where id = '".$r->fields["id"]."' and periode = '".$a_periode_lalu[1]."'"; //echo $q1;
				$r2 = Conn()->Execute($q2);
				$nilaiold[1] = $r2->fields["saldoakhir"];
			}
		}
		//$nilai = $r->fields["jumlah"];
		if (count($a_periode_lalu) == 0) {
			$mtotal2 += $nilai;
			$q = "insert into t87_neraca (field01, field02, field03) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}
		elseif (count($a_periode_lalu) == 1) {
			$mtotal2 += $nilai;
			$mtotal2old[0] += $nilaiold[0];
			$q = "insert into t87_neraca (field01, field02, field03, field04) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilaiold[0], 2)."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilaiold[0], 2)."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}
		elseif (count($a_periode_lalu) == 2) {
			$mtotal2 += $nilai;
			$mtotal2old[0] += $nilaiold[0];
			$mtotal2old[1] += $nilaiold[1];
			$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('".$r->fields["id"]."', '".$r->fields["rekening"]."', '".number_format($nilaiold[0], 2)."', '".number_format($nilaiold[1], 2)."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);
			echo "
			<tr>
			<td>".$r->fields["id"]."</td>
			<td>".$r->fields["rekening"]."</td>
			<td align='right'>".number_format($nilaiold[0], 2)."</td>
			<td align='right'>".number_format($nilaiold[1], 2)."</td>
			<td align='right'>".number_format($nilai, 2)."</td>
			</tr>
			";
		}

		$r->MoveNext();
	}

	//$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);
	// sub total
	if (count($a_periode_lalu) == 0) {
		$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);
	}
	elseif (count($a_periode_lalu) == 1) {
		$q = "insert into t87_neraca (field01, field02, field03, field04) values ('', '', '<strong>".number_format($mtotal2old[0], 2)."</strong>', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);
	}
	elseif (count($a_periode_lalu) == 2) {
		$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotal2old[0], 2)."</strong>', '<strong>".number_format($mtotal2old[1], 2)."</strong>', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);
	}

	echo "
	<tr>
	<td colspan='2'>&nbsp;</td>";
	if (count($a_periode_lalu) == 0) {
		echo "<td align='right'><strong>".number_format($mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='3'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 1) {
		echo "<td align='right'><strong>".number_format($mtotal2old[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='4'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 2) {
		echo "<td align='right'><strong>".number_format($mtotal2old[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotal2old[1], 2)."</strong></td><td align='right'><strong>".number_format($mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='5'>&nbsp;</td>";
	}
	echo "
	</tr>
	";
	$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);

	echo "
	<tr>
	<td colspan='2'>&nbsp;</td>";
	if (count($a_periode_lalu) == 0) {
		$q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);
		echo "<td align='right'><strong>".number_format($mtotal - $mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='3'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 1) {
		$q = "insert into t87_neraca (field01, field02, field03, field04) values ('', '', '<strong>".number_format($mtotalold[0] - $mtotal2old[0], 2)."</strong>', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);
		echo "<td align='right'><strong>".number_format($mtotalold[0] - $mtotal2old[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotal - $mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='4'>&nbsp;</td>";
	}
	elseif (count($a_periode_lalu) == 2) {
		$q = "insert into t87_neraca (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotalold[0] - $mtotal2old[0], 2)."</strong>', '<strong>".number_format($mtotalold[1] - $mtotal2old[1], 2)."</strong>', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);
		echo "<td align='right'><strong>".number_format($mtotalold[0] - $mtotal2old[0], 2)."</strong></td><td align='right'><strong>".number_format($mtotalold[1] - $mtotal2old[1], 2)."</strong></td><td align='right'><strong>".number_format($mtotal - $mtotal2, 2)."</strong></td>";
		echo "</tr><tr><td colspan='5'>&nbsp;</td>";
	}
	echo "
	</tr>
	";

	// end of create table
	echo "
	</tbody>
	</table>
	</div>
	</div>";

	//header("Location: r05_labarugismry.php");
	//header("Location: t87_neracalist.php?periode=".$_POST["periode"]);

}
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf34_neraca_php->Page_Terminate();
?>
