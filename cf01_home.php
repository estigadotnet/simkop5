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

$cf01_home_php = NULL; // Initialize page object first

class ccf01_home_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = "{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}";

	// Table name
	var $TableName = 'cf01_home.php';

	// Page object name
	var $PageObjName = 'cf01_home_php';

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
			define("EW_TABLE_NAME", 'cf01_home.php', TRUE);

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
		$Breadcrumb->Add("custom", "cf01_home_php", $url, "", "cf01_home_php", TRUE);
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf01_home_php)) $cf01_home_php = new ccf01_home_php();

// Page init
$cf01_home_php->Page_Init();

// Page main
$cf01_home_php->Page_Main();

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
$GLOBALS["Periode"] = ew_ExecuteScalar("select Tahun_Bulan from t93_periode");
$db =& DbHelper(); 
?>

<style>
.panel-heading a{
  display:block;
}

.panel-heading a.collapsed {
  background: url(http://upload.wikimedia.org/wikipedia/commons/3/36/Vector_skin_right_arrow.png) center right no-repeat;
}

.panel-heading a {
  background: url(http://www.useragentman.com/blog/wp-content/themes/useragentman/images/widgets/downArrow.png) center right no-repeat;
}
</style>

<?php
	$db =& DbHelper(); // Create instance of the database helper class by DbHelper() (for main database) or DbHelper("<dbname>") (for linked databases) where <dbname> is database variable name
?>


<!-- daily info -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#dailyinfo">Daily Info</a></strong></div>
	<div id="dailyinfo" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table  ><!-- class='table table-striped table-hover table-condensed' -->
					<tbody>
					<tr>
						<td><ul><li>Periode, <?php echo ew_ExecuteScalar("select Bulan from t93_periode")." - ".ew_ExecuteScalar("select Tahun from t93_periode"); ?></li></ul></td>
					</tr>
					<tr>
						<td><ul><li>Company, <?php echo ew_ExecuteScalar("select Nama from t75_company"); ?>, <?php echo ew_ExecuteScalar("select Alamat from t75_company"); ?></li></ul></td>
					</tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<!-- koperasi -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#koperasi">Koperasi</a></strong></div>
	<div id="koperasi" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table  ><!-- class='table table-striped table-hover table-condensed' -->
					<tbody>
					<tr>
						<td><ul><li><div id="type"></div></li></ul></td>
					</tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<!-- deposito -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#deposito">Deposito</a></strong></div>
	<div id="deposito" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table  ><!-- class='table table-striped table-hover table-condensed' -->
					<tbody>
					<tr>
						<td><ul><li><div id="type2"></div></li></ul></td>
					</tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<!-- <style>
#type {
	margin-bottom: 15px;
	font-size: 18px;
	font-weight: 200;
}
@media screen and (min-width: 768px) {
	#type {
		font-size: 23px;
	}
}
</style> -->

<script>
$.fn.typer = function(text, options){
	options = $.extend({}, {
		char: ' ',
		delay: 1000,
		duration: 600,
		endless: true
	}, options || text);

	text = $.isPlainObject(text) ? options.text : text;

	var elem = $(this),
		isTag = false,
		c = 0;
	
	(function typetext(i) {
		var e = ({string:1, number:1}[typeof text] ? text : text[i]) + options.char,
			char = e.substr(c++, 1);

		if( char === '<' ){ isTag = true; }
		if( char === '>' ){ isTag = false; }
		elem.html(e.substr(0, c));
		if(c <= e.length){
			if( isTag ){
				typetext(i);
			} else {
				setTimeout(typetext, options.duration/10, i);
			}
		} else {
			c = 0;
			i++;
			
			if (i === text.length && !options.endless) {
				return;
			} else if (i === text.length) {
				i = 0;
			}
			setTimeout(typetext, options.delay, i);
		}
	})(0);
};

$('#type').typer(['a <b>cool</b> affect', 'made with <b>js<b>', 'format your <i>text</i> here', 'im watching <b>you</b>' ]);
$('#type2').typer(['a <b>cool2</b> affect', 'made with <b>js<b>', 'format your <i>text</i> here', 'im watching <b>you</b>' ]);



</script>




<!-- periode -->
<!--
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#periode">Periode</a></strong></div>
	<div id="periode" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<tr>
						<td><?php echo "Periode: ".ew_ExecuteScalar("select Bulan from t93_periode")." - ".ew_ExecuteScalar("select Tahun from t93_periode"); ?></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
-->


<!-- jatuh tempo -->
<?php
$q = "
	select
		*
	from
		t04_pinjamanangsurantemp
	where 
		concat(year(Angsuran_Tanggal), right(concat('00',month(Angsuran_Tanggal)),2)) = '".$GLOBALS["Periode"]."' 
		and Tanggal_Bayar is null";
$q = "
	select
		a.*,
		b.Kontrak_No,
		c.Nama
	from
		t04_pinjamanangsurantemp a
		join t03_pinjaman b on a.pinjaman_id = b.id
		join t01_nasabah c on b.nasabah_id = c.id
	where 
		concat(year(Angsuran_Tanggal), right(concat('00',month(Angsuran_Tanggal)),2)) = '".$GLOBALS["Periode"]."' 
		and Tanggal_Bayar is null
";
$r = Conn()->Execute($q);
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#jatuh_tempo">Jatuh Tempo</a></strong></div>
	<div id="jatuh_tempo" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<tr>
						<th>No. Kontrak</th>
						<th>Nasabah</th>
						<th>Tgl. Jatuh Tempo</th>
						<th>Angsuran</th>
					</tr>
					<?php
					while (!$r->EOF) {
					?>
					<tr>
						<td><?php echo $r->fields["Kontrak_No"]; ?></td>
						<td><?php echo $r->fields["Nama"]; ?></td>
						<td><?php echo date("d-m-Y", strtotime($r->fields["Angsuran_Tanggal"])); ?></td>
						<td><?php echo number_format($r->fields["Angsuran_Total"], 2, ".", ","); ?></td>
					</tr>
					<?php
						$r->MoveNext();
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- log -->
<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Progress Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div>
<pre><?php $lines=file('01_log.txt');foreach ($lines as $line_num => $line){echo $line;}?></pre>
			</div>
		</div>
	</div>
</div>


<!-- log -->
<!--<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Progress Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div>
				<p>&nbsp;</p>-->
				<!-- to do -->
				<!--<p><strong>to do</strong></p>
				<?php
				$q = "
					select
						a.index_,
						a.subj_,
						b.date_issued,
						b.desc_,
						b.date_solved
					from
						t94_log a
						left join t95_logdesc b on a.id = b.log_id
					where
						b.date_solved is null
					order by
						a.index_,
						b.date_issued
					";
				//echo $db->ExecuteHtml($q, array("fieldcaption" => TRUE, "tablename" => array("t94_log", "t95_logdesc")));
				$r = Conn()->Execute($q);
				?>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>
					<?php
					while (!$r->EOF) {
						if ($r->fields["date_issued"] == null) {
							$r->MoveNext();
							continue;
							//break;
						}
						$index_ = $r->fields["index_"];
						?>
						<tr>
							<td colspan="4">[<?php echo $r->fields["subj_"]; ?>]</td>
						</tr>
						<?php
						while ($index_ == $r->fields["index_"]) {
							?>
							<tr>
								<td width="20">-</td>
								<td><?php echo $r->fields["desc_"];?></td>
								<td width="100"><?php echo $r->fields["date_issued"];?></td>
								<td width="100">&nbsp;</td>
							</tr>
							<?php
							$r->MoveNext();
						}
						if (!$r->EOF) {
							?>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<?php
						}
					}
					?>
					</tbody>
				</table>

				<p>&nbsp;</p>-->
				<!-- done -->
				<!--<p><strong>done</strong></p>
				<?php
				$q = "
					select
						a.index_,
						a.subj_,
						b.date_issued,
						b.desc_,
						b.date_solved
					from
						t94_log a
						left join t95_logdesc b on a.id = b.log_id
					where
						b.date_solved is not null
					order by
						a.index_,
						b.date_issued,
						b.date_solved
					";
				//echo $db->ExecuteHtml($q, array("fieldcaption" => TRUE, "tablename" => array("t94_log", "t95_logdesc")));
				$r = Conn()->Execute($q);
				?>
				<table class='table table-striped table-hover table-condensed'>
					<?php
					while (!$r->EOF) {
						$index_ = $r->fields["index_"];
						?>
						<tr>
							<td colspan="4">[<?php echo $r->fields["subj_"]; ?>]</td>
						</tr>
						<?php
						while ($index_ == $r->fields["index_"]) {
							?>
							<tr>
								<td width="20">-</td>
								<td><?php echo $r->fields["desc_"];?></td>
								<td width="100"><?php echo $r->fields["date_issued"];?></td>
								<td width="100"><?php echo $r->fields["date_solved"];?></td>
							</tr>
							<?php
							$r->MoveNext();
						}
						if (!$r->EOF) {
							?>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<?php
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>-->

<!-- log -->
<!-- <div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Log</a></strong></div>
	<div id="log" class="panel-collapse collapse out">
		<div class="panel-body">
			<div> -->
<!-- <strong>to do:</strong><br/> -->
<!-- [pinjaman - angsuran]:<br/> -->
<!-- - ada tambahan kolom POTONGAN, mengurangi SISA HUTANG;<br/> -->
<!-- - setiap ada pembayaran menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;<br/> -->
<!-- - check jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN;<br/>&nbsp;<br/> -->

<!-- [aplikasi]:<br/>&nbsp;<br/> -->

<!-- <strong>done:</strong><br/> -->
<!-- [pinjaman]:<br/> -->
<!-- - tipe data nomor referensi diubah dari integer menjadi varchar;<br/>&nbsp;<br/> -->

<!-- [pinjaman - angsuran]:<br/> -->
<!-- - rumus [jumlah angsuran];<br/> -->
<!-- - button refresh detail angsuran;<br/> -->
<!-- - tambah field untuk transaksi pembayaran;<br/> -->
<!-- - perbesar kolom tanggal bayar;<br/>&nbsp;<br/> -->

<!-- [pinjaman - nasabah]:<br/> -->
<!-- - alamat nasabah harus diisi;<br/> -->
<!-- - melengkapi tampilan add nasabah di menu pinjaman;<br/>&nbsp;<br/> -->

<!-- [pinjaman - titipan]:<br/> -->
<!-- - menghilangkan nasabah_id di add jaminan pada proses input pinjaman;<br/> -->
<!-- - setelah input setoran titipan :: harus save dulu agar nilai saldo terupdate;<br/>&nbsp;<br/> -->

<!-- [aplikasi]:<br/> -->
<!-- - menghilangkan menu setup nasabah;<br/> -->
<!-- - buat CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm;<br/> -->
<!-- - log at home, List - User Log;<br/>&nbsp;<br/> -->
<!--			</div>
		</div>
	</div>
</div> -->

<!--
<div>
&copy;2018 Selaras Solusindo. All rights reserved.
</div>
-->
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf01_home_php->Page_Terminate();
?>
