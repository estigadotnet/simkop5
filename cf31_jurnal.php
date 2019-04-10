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

$cf31_jurnal_php = NULL; // Initialize page object first

class ccf31_jurnal_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf31_jurnal.php';

	// Page object name
	var $PageObjName = 'cf31_jurnal_php';

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
			define("EW_TABLE_NAME", 'cf31_jurnal.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf31_jurnal_php", $url, "", "cf31_jurnal_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf31_jurnal_php)) $cf31_jurnal_php = new ccf31_jurnal_php();

// Page init
$cf31_jurnal_php->Page_Init();

// Page main
$cf31_jurnal_php->Page_Main();

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
<form name="frm_input_periode" class="form-inline ewForm ewExtFilterForm" method="post">
	<div id="r_1" class="ewRow">
		<label for="sv_Bulan" class="ewSearchCaption ewLabel">Bulan</label>
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
			elseif (date('m') == substr("00".$index,-2)) {
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
	</div>
	<div id="r_2" class="ewRow">
		<label for="sv_Tahun" class="ewSearchCaption ewLabel">Tahun</label>
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
	</div>
	<div id="xsr_2" class="ewRow">
		<button class="btn btn-primary ewButton" name="btnproses" id="btnsubmit" type="submit">Proses</button>
		<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick="window.location.href='.'">Selesai</button>
	</div>
</form>

<?php
if (isset($_POST["btnproses"])) {
	echo date('m').substr("00".$_POST['bulan'],-2);
	// echo "submitted";
	//echo $abulan[$_POST["bulan"]] . " " . $_POST["tahun"];

	$periode_aktif = ew_ExecuteScalar("select Tahun_Bulan from t93_periode");
	$periode_input = $_POST["tahun"].substr("00" . $_POST["bulan"], -2);
	//echo $periode_aktif . " - " . $periode_input;

	if ($periode_aktif == $periode_input) { ?>
<?php

// hapus t79_jurnallap
$q = "delete from t79_jurnallap";
Conn()->Execute($q);

$q = "
	SELECT
		j.Tanggal,
		j.NomorTransaksi,
		j.Keterangan,
		r.id,
		r.rekening,
		case when isnull(j.Debet) then 0 else j.Debet end as debet,
		case when isnull(j.Kredit) then 0 else j.Kredit end as kredit
	from
		t10_jurnal as j
		left join t91_rekening r on r.id = j.rekening
	ORDER BY
		j.Tanggal";
	//#where a.id=63

$rs = ew_Execute($q);
$a_Bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei",
		"Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	echo "
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Jurnal</label><br/>
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[ew_ExecuteScalar("select Bulan from t93_periode")] . " " . ew_ExecuteScalar("select Tahun from t93_periode") . "</label><br/>
		&nbsp;<br/>
		";
	echo "
		<div class='panel panel-default'>
		<div>
		<table class='table table-striped table-hover table-condensed'>
		<tbody>";

	/*echo "
		<tr>
			<th>Aktiva</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>";*/

	echo "
		<tr>
			<th>Tanggal</th>
			<th>No. Transaksi</th>
			<th>Keterangan</th>
			<th>Kode Akun</th>
			<th>Akun</th>
			<th align='right'>Debet</th>
			<th align='right'>Kredit</th>
		</tr>";
	while (!$rs->EOF) {
		echo "
		<tr>
			<td>" . date_format(date_create($rs->fields["Tanggal"]), "d-m-Y") . "</td>
			<td>" . $rs->fields["NomorTransaksi"] . "</td>
			<td>" . $rs->fields["Keterangan"] . "</td>
			<td>" . $rs->fields["id"] . "</td>
			<td>" . $rs->fields["rekening"] . "</td>
			<td align='right'>" . number_format($rs->fields["debet"]) . "</td>
			<td align='right'>" . number_format($rs->fields["kredit"]) . "</td>
		</tr>";
		// insert ke t79_jurnallap
		$q = "insert into t79_jurnallap (
			Tanggal,
			NomorTransaksi,
			Keterangan,
			AkunKode,
			AkunNama,
			Debet,
			Kredit
			) values (
			'".$rs->fields["Tanggal"]."',
			'".$rs->fields["NomorTransaksi"]."',
			'".$rs->fields["Keterangan"]."',
			'".$rs->fields["id"]."',
			'".$rs->fields["rekening"]."',
			".$rs->fields["debet"].",
			".$rs->fields["kredit"]."
			)";
		Conn()->Execute($q);
		$rs->MoveNext();
	}
	$rs->Close();
	echo "
		</tbody>
		</table>
		</div>
		</div>";
//header("Location: t79_jurnallaplist.php");
?>		
	<?php }
	else {
	?>
<?php

// hapus t74_jurnallapclsoed
$q = "delete from t74_jurnallapclosed";
Conn()->Execute($q);

$q = "
	SELECT
		j.Tanggal,
		j.NomorTransaksi,
		j.Keterangan,
		r.id,
		r.rekening,
		case when isnull(j.Debet) then 0 else j.Debet end as debet,
		case when isnull(j.Kredit) then 0 else j.Kredit end as kredit
	from
		t82_jurnalold as j
		left join t91_rekening r on r.id = j.rekening
	ORDER BY
		j.Tanggal";
	//#where a.id=63

$rs = ew_Execute($q);
$a_Bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei",
		"Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	echo "
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Jurnal</label><br/>
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$_POST["bulan"]] . " " . $_POST["tahun"] . "</label><br/>
		&nbsp;<br/>
		";
	echo "
		<div class='panel panel-default'>
		<div>
		<table class='table table-striped table-hover table-condensed'>
		<tbody>";

	/*echo "
		<tr>
			<th>Aktiva</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>";*/

	echo "
		<tr>
			<th>Tanggal</th>
			<th>No. Transaksi</th>
			<th>Keterangan</th>
			<th>Kode Akun</th>
			<th>Akun</th>
			<th align='right'>Debet</th>
			<th align='right'>Kredit</th>
		</tr>";
	while (!$rs->EOF) {
		echo "
		<tr>
			<td>" . date_format(date_create($rs->fields["Tanggal"]), "d-m-Y") . "</td>
			<td>" . $rs->fields["NomorTransaksi"] . "</td>
			<td>" . $rs->fields["Keterangan"] . "</td>
			<td>" . $rs->fields["id"] . "</td>
			<td>" . $rs->fields["rekening"] . "</td>
			<td align='right'>" . number_format($rs->fields["debet"]) . "</td>
			<td align='right'>" . number_format($rs->fields["kredit"]) . "</td>
		</tr>";
		// insert ke t74_jurnallapclosed
		$q = "insert into t74_jurnallapclosed (
			Tanggal,
			NomorTransaksi,
			Keterangan,
			AkunKode,
			AkunNama,
			Debet,
			Kredit
			) values (
			'".$rs->fields["Tanggal"]."',
			'".$rs->fields["NomorTransaksi"]."',
			'".$rs->fields["Keterangan"]."',
			'".$rs->fields["id"]."',
			'".$rs->fields["rekening"]."',
			".$rs->fields["debet"].",
			".$rs->fields["kredit"]."
			)";
		Conn()->Execute($q);
		$rs->MoveNext();
	}
	$rs->Close();
	echo "
		</tbody>
		</table>
		</div>
		</div>";
//header("Location: t74_jurnallapclosedlist.php");
?>
	<?php
	}
}
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf31_jurnal_php->Page_Terminate();
?>
