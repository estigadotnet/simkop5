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

$cf41_pinjaman_php = NULL; // Initialize page object first

class ccf41_pinjaman_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf41_pinjaman.php';

	// Page object name
	var $PageObjName = 'cf41_pinjaman_php';

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
			define("EW_TABLE_NAME", 'cf41_pinjaman.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf41_pinjaman_php", $url, "", "cf41_pinjaman_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf41_pinjaman_php)) $cf41_pinjaman_php = new ccf41_pinjaman_php();

// Page init
$cf41_pinjaman_php->Page_Init();

// Page main
$cf41_pinjaman_php->Page_Main();

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
$a_caption = array(
	"id" => "ID",
	"Kontrak_No" => "No. Kontrak",
	"Kontrak_Tgl" => "Tgl. Kontrak",
	"nasabah_id" => "Nasabah",
	"jaminan_id" => "Jaminan",
	"Pinjaman" => "Pinjaman",
	"Angsuran_Lama" => "Lama Angsuran",
	"Angsuran_Bunga_Prosen" => "Bunga (%)",
	"Angsuran_Denda" => "Denda (%)",
	"Dispensasi_Denda" => "Dispensasi",
	"Angsuran_Pokok" => "Pokok",
	"Angsuran_Bunga" => "Bunga",
	"Angsuran_Total" => "Total",
	"No_Ref" => "No. Ref.",
	"Biaya_Administrasi" => "Administrasi",
	"Biaya_Materai" => "Materai",
	"marketing_id" => "Marketing",
	"Periode" => "Periode",
	"Macet" => "Macet"
);

$a_caption2 = array(
	"id" => "ID",
	"Kontrak_No" => "No. Kontrak",
	"Kontrak_Tgl" => "Tgl. Kontrak",
	"nasabah_id" => "Nasabah",
	"jaminan_id" => "Jaminan",
	"Pinjaman" => "Pinjaman",
	"Angsuran_Lama" => "Lama Angsuran",
	"Angsuran_Bunga_Prosen" => "Bunga (%)",
	"Angsuran_Denda" => "Denda (%)",
	"Dispensasi_Denda" => "Dispensasi",
	"Angsuran_Pokok" => "Pokok",
	"Angsuran_Bunga" => "Bunga",
	"Angsuran_Total" => "Total",
	"No_Ref" => "No. Ref.",
	"Biaya_Administrasi" => "Administrasi",
	"Biaya_Materai" => "Materai",
	"marketing_id" => "Marketing",
	"Periode" => "Periode",
	"Macet" => "Macet"
);

$q = "
	SELECT
		COLUMN_NAME
	FROM
		INFORMATION_SCHEMA.COLUMNS
	WHERE
		TABLE_SCHEMA = 'db_simkop5'
		AND TABLE_NAME = 't03_pinjaman'
";
if (isset($_POST["btnproses"])) { // begin -proses-
	$a_nama_field = $_POST['nama_field'];
	//var_dump($a_nama_field);
	if(empty($a_nama_field)) {
		echo("You didn't select any field.");
	} 
	else {
		$N = count($a_nama_field);
		// echo("You selected $N field(s): ");
		$select = "";
		for($i=0; $i < $N; $i++) {
			//echo($a_nama_field[$i] . " ");
			$select .= $a_nama_field[$i] . ", "; //echo $select;
		}
		$select = substr($select, 0, strlen($select) - 2);
		$q = "select " . $select . " from t03_pinjaman "; //echo $q;
		$r = Conn()->Execute($q);
		echo "
		<label for='sv_Periode' class='ewSearchCaption ewLabel'>Laporan Data Pinjaman</label><br/>
		&nbsp;<br/>
		<div class='panel panel-default'>			
		<div>
		<table class='table table-striped table-hover table-condensed'>
		<tbody>";
		echo "
		<tr>";
		for($i=0; $i < $N; $i++) {
			echo "
			<th>" . $a_caption[$a_nama_field[$i]] . "</th>";
		}
		echo "
		</tr>";
		while (!$r->EOF) {
			echo "
			<tr>";
			for($i=0; $i < $N; $i++) {
				echo "
				<td>" . $r->fields[$a_nama_field[$i]] . "</td>";
			}
			echo "
			</tr>";
			$r->MoveNext();
		}
		echo "
		<tr>";
		for($i=0; $i < $N; $i++) {
			echo "
			<td>&nbsp;</td>";
		}
		echo "
		</tr>";
		echo "
		</tbody>
		</table>
		</div>
		</div>";
	}
	?>
	<div>
	<div id="r_1" class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button class='btn btn-primary ewButton' name='btnsubmit' id='btnsubmit' type='button' onclick="window.location.href='cf41_pinjaman.php'">Selesai</button>
	</div>
	</div>
	</div>
	<?php
}
else {
?>

<form name="frm_input_periode" class="form-horizontal ewForm ewExtFilterForm" method="post">
<div>
	<div id="r_1" class="form-group">
		<label class="col-sm-2 control-label ewLabel">Kolom</label>
		<div class="col-sm-10">
			<div>
			<span>
			<?php
			$r = Conn()->Execute($q);
			while (!$r->EOF) {
				?>
				<input type="checkbox" name="nama_field[]" value="<?php echo $r->fields["COLUMN_NAME"]?>" /><?php echo $r->fields["COLUMN_NAME"]?><br />
				<?php
				$r->MoveNext();
			}
			?>
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
}
?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf41_pinjaman_php->Page_Terminate();
?>
