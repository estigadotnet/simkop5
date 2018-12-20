<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg10.php" ?>
<?php $EWR_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "phprptinc/ewrfn10.php" ?>
<?php include_once "phprptinc/ewrusrfn10.php" ?>
<?php

//
// Page class
//

$cfr01_labarugi_php = NULL; // Initialize page object first

class crcfr01_labarugi_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{34C67914-04B8-4CBF-A6F8-355DA216289E}";

	// Page object name
	var $PageObjName = 'cfr01_labarugi_php';

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog ewDisplayTable\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}
	var $Token = "";
	var $CheckToken = EWR_CHECK_TOKEN;
	var $CheckTokenFn = "ewr_CheckToken";
	var $CreateTokenFn = "ewr_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ewr_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EWR_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EWR_TOKEN_NAME]);
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
		global $conn, $ReportLanguage;
		global $UserTable, $UserTableConn;

		// Language object
		$ReportLanguage = new crLanguage();

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'custom', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'cfr01_labarugi.php', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		if (!isset($conn)) $conn = ewr_Connect();

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new crt96_employees();
			$UserTableConn = ReportConn($UserTable->DBID);
		}
	}

	//
	// Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gsEmailContentType, $ReportLanguage, $Security;
		global $gsCustomExport;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . 'cfr01_labarugi.php');
		$Security->TablePermission_Loaded();
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($ReportLanguage->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("index.php"));
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$Security->SaveLastUrl();
			$this->setFailureMessage($ReportLanguage->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("login.php"));
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Check token
		if (!$this->ValidPost()) {
			echo $ReportLanguage->Phrase("InvalidPostRequest");
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
		global $ReportLanguage, $EWR_EXPORT, $gsExportFile;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		ewr_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
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
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = substr(ewr_CurrentUrl(), strrpos(ewr_CurrentUrl(), "/")+1);
		$ReportBreadcrumb->Add("custom", "cfr01_labarugi_php", $url, "", "cfr01_labarugi_php", TRUE);
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
}
?>
<?php ewr_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cfr01_labarugi_php)) $cfr01_labarugi_php = new crcfr01_labarugi_php();
if (isset($Page)) $OldPage = $Page;
$Page = &$cfr01_labarugi_php;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();
?>
<?php include_once "phprptinc/header.php" ?>
<div class="ewToolbar">
<?php if ($ReportBreadcrumb) $ReportBreadcrumb->Render(); ?>
<?php echo $ReportLanguage->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<div class="panel panel-default">
	 <div class="panel-heading">Latest news</div>
	 <div class="panel-body">
		 <p>PHP Report Maker 10.0 is released</p>
	 </div>
 </div>
<?php
$GLOBALS["Periode"] = ewr_ExecuteScalar("select Tahun_Bulan from t93_periode");
$q = "select * from t91_rekening where id = '3'";
$r = Conn()->Execute($q);
$q = "select * from t91_rekening where parent = '3' and tipe = 'DETAIL' order by id";
$rdet = Conn()->Execute($q);
$q = "select * from t91_rekening where id = '5'";
$r2 = Conn()->Execute($q);
$q = "select * from t91_rekening where parent = '5' and tipe = 'DETAIL' order by id";
$rdet2 = Conn()->Execute($q);
$q = "select * from t91_rekening where id = '4'";
$r3 = Conn()->Execute($q);
$q = "select * from t91_rekening where parent = '4' and tipe = 'DETAIL' order by id";
$rdet3 = Conn()->Execute($q);
$q = "select * from t91_rekening where id = '6'";
$r4 = Conn()->Execute($q);
$q = "select * from t91_rekening where parent = '6' and tipe = 'DETAIL' order by id";
$rdet4 = Conn()->Execute($q);
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#labarugi">Laba Rugi Periode <?php echo $GLOBALS["Periode"]; ?></a></strong></div>
	<div id="labarugi" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<!-- id 3 -->
					<?php while (!$r->EOF) { ?>
					<tr>
						<td><strong><?php echo $r->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $r->MoveNext(); ?>
					<?php } ?>
					<?php $mtotal = 0;?>
					<?php while (!$rdet->EOF) { ?>
					<?php
							$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
								Rekening = '".$rdet->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal += $nilai;
					?>
					<tr>
						<td><?php echo $rdet->fields["id"]; ?></td>
						<td><?php echo $rdet->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $rdet->MoveNext(); ?>
					<?php } ?>
					<!-- id 5 -->
					<?php while (!$r2->EOF) { ?>
					<tr>
						<td><strong><?php echo $r2->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $r2->MoveNext(); ?>
					<?php } ?>
					<?php while (!$rdet2->EOF) { ?>
					<?php
							$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
								Rekening = '".$rdet2->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal += $nilai;
					?>
					<tr>
						<td><?php echo $rdet2->fields["id"]; ?></td>
						<td><?php echo $rdet2->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $rdet2->MoveNext(); ?>
					<?php } ?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal, 2); ?></strong></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<!-- id 4 -->
					<?php while (!$r3->EOF) { ?>
					<tr>
						<td><strong><?php echo $r3->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $r3->MoveNext(); ?>
					<?php } ?>
					<?php $mtotal2 = 0;?>
					<?php while (!$rdet3->EOF) { ?>
					<?php
							$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
								Rekening = '".$rdet3->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal2 += $nilai;
					?>
					<tr>
						<td><?php echo $rdet3->fields["id"]; ?></td>
						<td><?php echo $rdet3->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $rdet3->MoveNext(); ?>
					<?php } ?>
					<!-- id 6 -->
					<?php while (!$r4->EOF) { ?>
					<tr>
						<td><strong><?php echo $r4->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $r4->MoveNext(); ?>
					<?php } ?>
					<?php while (!$rdet4->EOF) { ?>
					<?php
							$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
								Rekening = '".$rdet4->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal2 += $nilai;
					?>
					<tr>
						<td><?php echo $rdet4->fields["id"]; ?></td>
						<td><?php echo $rdet4->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $rdet4->MoveNext(); ?>
					<?php } ?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal2, 2); ?></strong></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal - $mtotal2, 2); ?></strong></td>
					</tr>
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
<?php if (EWR_DEBUG_ENABLED) echo ewr_DebugMsg(); ?>
<?php include_once "phprptinc/footer.php" ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
