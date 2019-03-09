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

$cf08_neracaproses_php = NULL; // Initialize page object first

class ccf08_neracaproses_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf08_neracaproses.php';

	// Page object name
	var $PageObjName = 'cf08_neracaproses_php';

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
			define("EW_TABLE_NAME", 'cf08_neracaproses.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf08_neracaproses_php", $url, "", "cf08_neracaproses_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf08_neracaproses_php)) $cf08_neracaproses_php = new ccf08_neracaproses_php();

// Page init
$cf08_neracaproses_php->Page_Init();

// Page main
$cf08_neracaproses_php->Page_Main();

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
// echo $_POST["periode"];

// mencari data periode sebelum periode terpilih
$q = "select *
	from v07_neraca
	where Tahun_Bulan < '".$_POST["periode"]."'
	group by Tahun_Bulan
	order by Tahun_Bulan desc
	limit 1";
$r = Conn()->Execute($q);

// check apakah ada data sebelumnya
if ($r->EOF) {
	// jika tidak ada data

	// tampilkan baris periode
	$a_bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$periode = $a_bulan[intval(substr($_POST["periode"], -2))] . " " . substr($_POST["periode"], 0, 4);
	//$header = "Periode ".$a_bulan[ew_ExecuteScalar("select Bulan from t93_periode")]." ".ew_ExecuteScalar("select Tahun from t93_periode");
	//$header = "Periode ".$_GET["periode"];

	// hapus t87_neraca
	$q = "delete from t87_neraca";
	Conn()->Execute($q);

	$q = "select * from t91_rekening where id = '1'";
	$r = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '1' and Tahun_Bulan = '".$_POST["periode"]."' order by id";
	$rdet = Conn()->Execute($q);

	$q = "select * from t91_rekening where id = '2'";
	$r2 = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '2' and Tahun_Bulan = '".$_POST["periode"]."' order by id";
	$rdet2 = Conn()->Execute($q);

	// kodetransaksi = 11
	$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '11'");
	$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '11'");
	?>

	<div class="panel panel-default">
		<!-- <div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#labarugi">Laba Rugi Periode <?php echo $GLOBALS["Periode"]; ?></a></strong></div> -->
		<div id="neraca" class="panel-collapse collapse in">
			<div class="panel-body">
				<div>
					<table class='table table-striped table-hover table-condensed'>
						<tbody>

							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><?php echo $periode; ?></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '".$periode."')"; Conn()->Execute($q);?>

							<!-- id 1 -->
							<?php while (!$r->EOF) { ?>
							<tr>
								<td><strong><?php echo $r->fields["rekening"]; ?></strong></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
							<?php   $r->MoveNext(); ?>
							<?php } ?>

							<?php $mtotal = 0;?>
							<?php while (!$rdet->EOF) { ?>
							<?php   $nilai = $rdet->fields["Debet"] - $rdet->fields["Kredit"]; ?>
							<?php   $mtotal += $nilai; ?>
							<tr>
								<td><?php echo $rdet->fields["id"]; ?></td>
								<td><?php echo $rdet->fields["Rekening"]; ?></td>
								<td align="right"><?php echo number_format($nilai, 2); ?></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('".$rdet->fields["id"]."', '".$rdet->fields["Rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
							<?php   $rdet->MoveNext(); ?>
							<?php } ?>


							<!-- sub total id 1 -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotal, 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>


							<!-- id 2 -->
							<?php while (!$r2->EOF) { ?>
							<tr>
								<td><strong><?php echo $r2->fields["rekening"]; ?></strong></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r2->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
							<?php   $r2->MoveNext(); ?>
							<?php } ?>

							<?php $mtotal2 = 0;?>
							<?php while (!$rdet2->EOF) { ?>
							<?php
							        if ($rdet2->fields["id"] == $rekdebet) { 
							          $nilai = f_hitunglabarugi2($_POST["periode"]); 
							        } 
							        else { 
							          $nilai = $rdet2->fields["Kredit"] - $rdet2->fields["Debet"]; 
							        }
							?>
							<?php   $mtotal2 += $nilai; ?>
							<tr>
								<td><?php echo $rdet2->fields["id"]; ?></td>
								<td><?php echo $rdet2->fields["Rekening"]; ?></td>
								<td align="right"><?php echo number_format($nilai, 2); ?></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('".$rdet2->fields["id"]."', '".$rdet2->fields["Rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
							<?php   $rdet2->MoveNext(); ?>
							<?php } ?>

							<!-- sub total id 2 -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotal2, 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>

							<!-- nilai neraca -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotal - $mtotal2, 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
					
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
	//header("Location: r05_labarugismry.php");
	header("Location: t87_neracalist.php?periode=".$_POST["periode"]);
	?>
	<?php
}
else {
	// jika ada data
	$Tahun_Bulanx = $r->fields["Tahun_Bulan"];

	// tampilkan baris periode
	$a_bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$periode1 = $a_bulan[intval(substr($Tahun_Bulanx, -2))] . " " . substr($Tahun_Bulanx, 0, 4);
	$periode2 = $a_bulan[intval(substr($_POST["periode"], -2))] . " " . substr($_POST["periode"], 0, 4);
	//$header = "Periode ".$a_bulan[ew_ExecuteScalar("select Bulan from t93_periode")]." ".ew_ExecuteScalar("select Tahun from t93_periode");
	//$header = "Periode ".$_GET["periode"];

	// hapus t85_neraca2
	$q = "delete from t85_neraca2";
	Conn()->Execute($q);

	$q = "select * from t91_rekening where id = '1'";
	$r = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '1' and Tahun_Bulan = '".$Tahun_Bulanx."' order by id";
	$rdetx = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '1' and Tahun_Bulan = '".$_POST["periode"]."' order by id";
	$rdet = Conn()->Execute($q);

	$q = "select * from t91_rekening where id = '2'";
	$r2 = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '2' and Tahun_Bulan = '".$Tahun_Bulanx."' order by id";
	$rdetx2 = Conn()->Execute($q);
	$q = "select * from v07_neraca where left(id, 1) = '2' and Tahun_Bulan = '".$_POST["periode"]."' order by id";
	$rdet2 = Conn()->Execute($q);

	// kodetransaksi = 11
	$rekdebet  = ew_ExecuteScalar("select DebetRekening from t89_rektran where KodeTransaksi = '11'");
	$rekkredit = ew_ExecuteScalar("select KreditRekening from t89_rektran where KodeTransaksi = '11'");
	?>

	<div class="panel panel-default">
		<!-- <div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#labarugi">Laba Rugi Periode <?php echo $GLOBALS["Periode"]; ?></a></strong></div> -->
		<div id="neraca" class="panel-collapse collapse in">
			<div class="panel-body">
				<div>
					<table class='table table-striped table-hover table-condensed'>
						<tbody>

							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align='right'><?php echo $periode1; ?></td>
								<td align='right'><?php echo $periode2; ?></td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '".$periode1."', '".$periode2."', '')"; Conn()->Execute($q);?>

							<!-- id 1 -->
							<?php while (!$r->EOF) { ?>
							<tr>
								<td><strong><?php echo $r->fields["rekening"]; ?></strong></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('<strong>".$r->fields["rekening"]."</strong>', '', '', '', '')"; Conn()->Execute($q);?>
							<?php   $r->MoveNext(); ?>
							<?php } ?>

							<?php $mtotal = 0;?>
							<?php $mtotalx = 0;?>
							<?php while (!$rdet->EOF) { ?>
							<?php   $nilai = $rdet->fields["Debet"] - $rdet->fields["Kredit"]; ?>
							<?php   $mtotal += $nilai; ?>
							<?php   $nilaix = $rdetx->fields["Debet"] - $rdetx->fields["Kredit"]; ?>
							<?php   $mtotalx += $nilaix; ?>
							<tr>
								<td><?php echo $rdet->fields["id"]; ?></td>
								<td><?php echo $rdet->fields["Rekening"]; ?></td>
								<td align="right"><?php echo number_format($nilaix, 2); ?></td>
								<td align="right"><?php echo number_format($nilai, 2); ?></td>
								<td align="right"><?php echo number_format($nilai + $nilaix, 2); ?></td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('".$rdet->fields["id"]."', '".$rdet->fields["Rekening"]."', '".number_format($nilaix, 2)."', '".number_format($nilai, 2)."', '".number_format($nilai + $nilaix, 2)."')"; Conn()->Execute($q);?>
							<?php   $rdet->MoveNext(); ?>
							<?php   $rdetx->MoveNext(); ?>
							<?php } ?>

							<!-- sub total id 1 -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotalx, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format($mtotal, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format($mtotal + $mtotalx, 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotalx, 2)."</strong>', '<strong>".number_format($mtotal, 2)."</strong>', '<strong>".number_format($mtotal + $mtotalx, 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '', '', '')"; Conn()->Execute($q);?>


							<!-- id 2 -->
							<?php while (!$r2->EOF) { ?>
							<tr>
								<td><strong><?php echo $r2->fields["rekening"]; ?></strong></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('<strong>".$r2->fields["rekening"]."</strong>', '', '', '', '')"; Conn()->Execute($q);?>
							<?php   $r2->MoveNext(); ?>
							<?php } ?>

							<?php $mtotal2 = 0;?>
							<?php $mtotalx2 = 0;?>
							<?php while (!$rdet2->EOF) { ?>
							<?php
							        if ($rdet2->fields["id"] == $rekdebet) { 
							          $nilai = f_hitunglabarugi2($_POST["periode"]); 
							        } 
							        else { 
							          $nilai = $rdet2->fields["Kredit"] - $rdet2->fields["Debet"]; 
							        }
							?>
							<?php   $mtotal2 += $nilai; ?>

							<?php
							        if ($rdetx2->fields["id"] == $rekdebet) { 
							          $nilaix = f_hitunglabarugi2($Tahun_Bulanx); 
							        } 
							        else { 
							          $nilaix = $rdetx2->fields["Kredit"] - $rdetx2->fields["Debet"]; 
							        }
							?>
							<?php   $mtotalx2 += $nilaix; ?>
							<tr>
								<td><?php echo $rdet2->fields["id"]; ?></td>
								<td><?php echo $rdet2->fields["Rekening"]; ?></td>
								<td align="right"><?php echo number_format($nilaix, 2); ?></td>
								<td align="right"><?php echo number_format($nilai, 2); ?></td>
								<td align="right"><?php echo number_format($nilai + $nilaix, 2); ?></td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('".$rdet2->fields["id"]."', '".$rdet2->fields["Rekening"]."', '".number_format($nilaix, 2)."', '".number_format($nilai, 2)."', '".number_format($nilai + $nilaix, 2)."')"; Conn()->Execute($q);?>
							<?php   $rdet2->MoveNext(); ?>
							<?php   $rdetx2->MoveNext(); ?>
							<?php } ?>

							<!-- sub total id 2 -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotalx2, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format($mtotal2, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format($mtotal2 + $mtotalx2, 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotalx2, 2)."</strong>', '<strong>".number_format($mtotal2, 2)."</strong>', '<strong>".number_format($mtotal2 + $mtotalx2, 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '', '', '')"; Conn()->Execute($q);?>

							<!-- nilai neraca -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="right"><strong><?php echo number_format($mtotalx - $mtotalx2, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format($mtotal - $mtotal2, 2); ?></strong></td>
								<td align="right"><strong><?php echo number_format(($mtotalx - $mtotalx2) + ($mtotal - $mtotal2), 2); ?></strong></td>
							</tr>
							<?php   $q = "insert into t85_neraca2 (field01, field02, field03, field04, field05) values ('', '', '<strong>".number_format($mtotalx - $mtotalx2, 2)."</strong>', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>', '<strong>".number_format(($mtotal - $mtotal2) + ($mtotalx - $mtotalx2), 2)."</strong>')"; Conn()->Execute($q);?>

							<!-- baris kosong -->
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
					
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
	//header("Location: r05_labarugismry.php");
	header("Location: t85_neraca2list.php");
	?>
	<?php
}

?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf08_neracaproses_php->Page_Terminate();
?>
