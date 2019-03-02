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

$cf10_bukubesarproses_php = NULL; // Initialize page object first

class ccf10_bukubesarproses_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf10_bukubesarproses.php';

	// Page object name
	var $PageObjName = 'cf10_bukubesarproses_php';

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
			define("EW_TABLE_NAME", 'cf10_bukubesarproses.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf10_bukubesarproses_php", $url, "", "cf10_bukubesarproses_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf10_bukubesarproses_php)) $cf10_bukubesarproses_php = new ccf10_bukubesarproses_php();

// Page init
$cf10_bukubesarproses_php->Page_Init();

// Page main
$cf10_bukubesarproses_php->Page_Main();

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

// hapus t78_bukubesarlap
$q = "delete from t78_bukubesarlap";
Conn()->Execute($q);

$r = ew_Execute("select Bulan, Tahun from t93_periode");

$q = "
	insert into t78_bukubesarlap (
		AkunKode,
		AkunNama,
		Tanggal,
		NomorTransaksi,
		Keterangan,
		Debet,
		Kredit,
		Saldo)
	select
		id,
		rekening,
		tanggal,
		no_tran,
		keterangan,
		debet,
		kredit,
		@st := @st + saldo
	from (
		select
			r.id
			, r.rekening
			, '0000-00-00 00:00:00' as tanggal
			, '' as no_tran
			, 'Saldo Awal' as keterangan
			, 0 as debet
			, 0 as kredit
			, saldo
		from
			t91_rekening r
	
		union

		select
			r.id
			, r.rekening
			, case when isnull(j.tanggal) then '0000-01-01 00:00:00' else j.tanggal end as tanggal
			, j.nomortransaksi as no_tran
			, j.keterangan as keterangan
			, case when isnull(j.debet) then 0 else j.debet end as debet
			, case when isnull(j.kredit) then 0 else j.kredit end as kredit
			, case when isnull(j.debet) then 0 else j.debet end - case when isnull(j.kredit) then 0 else j.kredit end as saldo
		from
			t91_rekening r
			left join t10_jurnal j on r.id = j.rekening
		) bb
		join (select @st := 0) stx
	where
		bb.id = '".$_POST["id"]."'
	order by
		bb.tanggal
	;";
Conn()->Execute($q);
$rs = ew_Execute("select * from t78_bukubesarlap");
$AkunKode = $rs->fields["AkunKode"];
$AkunNama = $rs->fields["AkunNama"];

$a_Bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei",
	"Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
echo "
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Buku Besar</label><br/>
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$r->fields["Bulan"]] . " " . $r->fields["Tahun"] . "</label><br/>
	&nbsp;<br/>
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Kode " . $rs->fields["AkunKode"] . "</label><br/>
	<label for='sv_Periode' class='ewSearchCaption ewLabel'>Rekening " . $rs->fields["AkunNama"] . "</label><br/>
	<div class='panel panel-default'>			
	<div>
	<table class='table table-striped table-hover table-condensed'>
	<tbody>";

echo "
	<tr>
		<th>Tanggal</th>
		<th>No. Transaksi</th>
		<th>Keterangan</th>
		<th align='right'>Debet</th>
		<th align='right'>Kredit</th>
		<th align='right'>Saldo</th>
	</tr>";

while (!$rs->EOF) {
	echo "
	<tr>
		<td>" . $rs->fields["tanggal"] . "</td>
		<td>" . $rs->fields["no_tran"] . "</td>
		<td>" . $rs->fields["keterangan"] . "</td>
		<td align='right'>" . number_format($rs->fields["debet"]) . "</td>
		<td align='right'>" . number_format($rs->fields["kredit"]) . "</td>
		<td align='right'>" . number_format($rs->fields["saldo2"]) . "</td>
	</tr>";
	$rs->MoveNext();
}
	
echo "
	</tbody>
	</table>
	</div>
	</div>
	<div id='xsr_2' class='ewRow'>
		<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick=\"window.location.href='cf10_bukubesar.php'\">Selesai</button>
	</div>";

header("Location: t78_bukubesarlaplist.php?akunkode=".$AkunKode."&akunnama=".$AkunNama."");
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf10_bukubesarproses_php->Page_Terminate();
?>
