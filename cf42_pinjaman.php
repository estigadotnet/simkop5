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
		<label class="col-sm-2 control-label ewLabel">Akun</label>
		<div class="col-sm-10">
			<div>
			<span>
			<select name="id" class="form-control">
			<option value="0">Semua Akun</option>
			<!-- <option value="">Please select</option>
			<option value="201812">201812</option>
			<option value="201901">201901</option>
			<option value="201902">201902</option> -->
			<?php
			$q = "select id, rekening from t91_rekening where length(id) > 1 order by id";
			$r = Conn()->Execute($q);
			while(!$r->EOF) {
			?>
			<option value="<?php echo $r->fields["id"]?>"
				<?php if (isset($_POST["id"])) {?>
				<?php echo ($r->fields['id'] == $_POST['id'] ? 'selected' : ''); ?>
				<?php }?>
			><?php echo $r->fields["id"].' - '.$r->fields["rekening"]?></option>
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
	//echo date('m').substr("00".$_POST['bulan'],-2);
	// echo "submitted";
	//echo $abulan[$_POST["bulan"]] . " " . $_POST["tahun"];

	$periode_aktif = ew_ExecuteScalar("select Tahun_Bulan from t93_periode");
	$periode_input = $_POST["tahun"].substr("00" . $_POST["bulan"], -2);
	//echo $periode_aktif . " - " . $periode_input;

	//if ($periode_aktif == $periode_input) { // begin tabel periode sekarang

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
			, '".$_POST["tahun"]."-".substr("00".$_POST["bulan"],-2)."-01' as tanggal
			, '' as no_tran
			, 'Saldo Awal' as keterangan
			, 0 as debet
			, 0 as kredit
			, saldo
		from ";
		if ($periode_aktif == $periode_input) { // begin tabel periode sekarang
			$q .= "
			t91_rekening r
			";
		}
		else {
			$q .= "
			t80_rekeningold r where r.Periode = '".$periode_input."'
			";
		}
			//t91_rekening r
		$q .="
		union

		select
			r.id
			, r.rekening
			, case when isnull(j.tanggal) then '".$_POST["tahun"]."-".substr("00".$_POST["bulan"],-2)."-01' else j.tanggal end as tanggal
			, j.nomortransaksi as no_tran
			, j.keterangan as keterangan
			, case when isnull(j.debet) then 0 else j.debet end as debet
			, case when isnull(j.kredit) then 0 else j.kredit end as kredit
			, case when (left(r.id,1) = '2' or left(r.id,1) = '3' or left(r.id,1) = '5') then
			(case when isnull(j.kredit) then 0 else j.kredit end
			-
			case when isnull(j.debet) then 0 else j.debet end)
			else
			(case when isnull(j.debet) then 0 else j.debet end
			-
			case when isnull(j.kredit) then 0 else j.kredit end)
			end
			as saldo
		from";

		if ($periode_aktif == $periode_input) { // begin tabel periode sekarang
			$q .= "
			t91_rekening r
			left join t10_jurnal j on r.id = j.rekening
			";
		}
		else {
			$q .= "
			t80_rekeningold r
			left join t82_jurnalold j on r.id = j.rekening
			where r.Periode = '".$periode_input."' and j.Periode = '".$periode_input."'
			";
		}

		/*$q .= "
			t91_rekening r
			left join t10_jurnal j on r.id = j.rekening
			";*/

		$q .= "
		) bb
		join (select @st := 0) stx
		where
		bb.id = '".$_POST["id"]."'";
		if ($periode_aktif == $periode_input) { // begin tabel periode sekarang
		}
		else {
			//$q .= " and ";
		}
		$q .= "
		order by
		bb.tanggal
		;";
		//echo $q;
		Conn()->Execute($q);
		$rs = ew_Execute("select * from t78_bukubesarlap");
		$AkunKode = $rs->fields["AkunKode"];
		$AkunNama = $rs->fields["AkunNama"];

		$a_Bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei",
		"Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		//<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$r->fields["Bulan"]] . " " . $r->fields["Tahun"] . "</label><br/>
		echo "
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Buku Besar</label><br/>
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Periode " . $a_Bulan[$_POST["bulan"]] . " " . $_POST["tahun"] . "</label><br/>
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
			<td>" . date_format(date_create($rs->fields["Tanggal"]), "d-m-Y") . "</td>
			<td>" . $rs->fields["NomorTransaksi"] . "</td>
			<td>" . $rs->fields["Keterangan"] . "</td>
			<td align='right'>" . number_format($rs->fields["Debet"]) . "</td>
			<td align='right'>" . number_format($rs->fields["Kredit"]) . "</td>
			<td align='right'>" . number_format($rs->fields["Saldo"]) . "</td>
			</tr>";
			$rs->MoveNext();
		}
	
		echo "
		</tbody>
		</table>
		</div>
		</div>";
		/*<div id='xsr_2' class='ewRow'>
		<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick=\"window.location.href='cf10_bukubesar.php'\">Selesai</button>
		</div>*/

		//header("Location: t78_bukubesarlaplist.php?akunkode=".$AkunKode."&akunnama=".$AkunNama."");

	//} // end tabel periode sekarang

} // end proses
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf42_pinjaman_php->Page_Terminate();
?>
