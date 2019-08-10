<?php

// Global variable for table object
$v0302_pinjamanlap = NULL;

//
// Table class for v0302_pinjamanlap
//
class cv0302_pinjamanlap extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $pinjaman_id;
	var $Kontrak_No;
	var $Kontrak_Tgl;
	var $nasabah_id;
	var $jaminan_id;
	var $Pinjaman;
	var $Angsuran_Lama;
	var $Angsuran_Bunga_Prosen;
	var $Angsuran_Denda;
	var $Dispensasi_Denda;
	var $Angsuran_Pokok;
	var $Angsuran_Bunga;
	var $Angsuran_Total;
	var $No_Ref;
	var $Biaya_Administrasi;
	var $Biaya_Materai;
	var $marketing_id;
	var $Periode;
	var $Macet;
	var $NasabahNama;
	var $NasabahAlamat;
	var $No_Telp_Hp;
	var $Pekerjaan;
	var $Pekerjaan_Alamat;
	var $Pekerjaan_No_Telp_Hp;
	var $Status;
	var $NasabahKeterangan;
	var $MarketingNama;
	var $MarketingAlamat;
	var $NoHP;
	var $AkhirKontrak;
	var $sudah_bayar;
	var $pd_Angsuran_Pokok;
	var $pd_Angsuran_Bunga;
	var $pd_Angsuran_Total;
	var $Tanggal_Bayar;
	var $umur_tunggakan;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'v0302_pinjamanlap';
		$this->TableName = 'v0302_pinjamanlap';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v0302_pinjamanlap`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 2;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// pinjaman_id
		$this->pinjaman_id = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_pinjaman_id', 'pinjaman_id', '`pinjaman_id`', '`pinjaman_id`', 3, -1, FALSE, '`pinjaman_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->pinjaman_id->Sortable = TRUE; // Allow sort
		$this->pinjaman_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pinjaman_id'] = &$this->pinjaman_id;

		// Kontrak_No
		$this->Kontrak_No = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Kontrak_No', 'Kontrak_No', '`Kontrak_No`', '`Kontrak_No`', 200, -1, FALSE, '`Kontrak_No`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Kontrak_No->Sortable = TRUE; // Allow sort
		$this->fields['Kontrak_No'] = &$this->Kontrak_No;

		// Kontrak_Tgl
		$this->Kontrak_Tgl = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Kontrak_Tgl', 'Kontrak_Tgl', '`Kontrak_Tgl`', ew_CastDateFieldForLike('`Kontrak_Tgl`', 0, "DB"), 133, 0, FALSE, '`Kontrak_Tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Kontrak_Tgl->Sortable = TRUE; // Allow sort
		$this->Kontrak_Tgl->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Kontrak_Tgl'] = &$this->Kontrak_Tgl;

		// nasabah_id
		$this->nasabah_id = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_nasabah_id', 'nasabah_id', '`nasabah_id`', '`nasabah_id`', 3, -1, FALSE, '`nasabah_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nasabah_id->Sortable = TRUE; // Allow sort
		$this->nasabah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['nasabah_id'] = &$this->nasabah_id;

		// jaminan_id
		$this->jaminan_id = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_jaminan_id', 'jaminan_id', '`jaminan_id`', '`jaminan_id`', 200, -1, FALSE, '`jaminan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jaminan_id->Sortable = TRUE; // Allow sort
		$this->fields['jaminan_id'] = &$this->jaminan_id;

		// Pinjaman
		$this->Pinjaman = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Pinjaman', 'Pinjaman', '`Pinjaman`', '`Pinjaman`', 4, -1, FALSE, '`Pinjaman`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Pinjaman->Sortable = TRUE; // Allow sort
		$this->Pinjaman->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Pinjaman'] = &$this->Pinjaman;

		// Angsuran_Lama
		$this->Angsuran_Lama = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Lama', 'Angsuran_Lama', '`Angsuran_Lama`', '`Angsuran_Lama`', 16, -1, FALSE, '`Angsuran_Lama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Lama->Sortable = TRUE; // Allow sort
		$this->Angsuran_Lama->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Angsuran_Lama'] = &$this->Angsuran_Lama;

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Bunga_Prosen', 'Angsuran_Bunga_Prosen', '`Angsuran_Bunga_Prosen`', '`Angsuran_Bunga_Prosen`', 131, -1, FALSE, '`Angsuran_Bunga_Prosen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Bunga_Prosen->Sortable = TRUE; // Allow sort
		$this->Angsuran_Bunga_Prosen->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Bunga_Prosen'] = &$this->Angsuran_Bunga_Prosen;

		// Angsuran_Denda
		$this->Angsuran_Denda = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Denda', 'Angsuran_Denda', '`Angsuran_Denda`', '`Angsuran_Denda`', 131, -1, FALSE, '`Angsuran_Denda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Denda->Sortable = TRUE; // Allow sort
		$this->Angsuran_Denda->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Denda'] = &$this->Angsuran_Denda;

		// Dispensasi_Denda
		$this->Dispensasi_Denda = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Dispensasi_Denda', 'Dispensasi_Denda', '`Dispensasi_Denda`', '`Dispensasi_Denda`', 16, -1, FALSE, '`Dispensasi_Denda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Dispensasi_Denda->Sortable = TRUE; // Allow sort
		$this->Dispensasi_Denda->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Dispensasi_Denda'] = &$this->Dispensasi_Denda;

		// Angsuran_Pokok
		$this->Angsuran_Pokok = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Pokok', 'Angsuran_Pokok', '`Angsuran_Pokok`', '`Angsuran_Pokok`', 4, -1, FALSE, '`Angsuran_Pokok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Pokok->Sortable = TRUE; // Allow sort
		$this->Angsuran_Pokok->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Pokok'] = &$this->Angsuran_Pokok;

		// Angsuran_Bunga
		$this->Angsuran_Bunga = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Bunga', 'Angsuran_Bunga', '`Angsuran_Bunga`', '`Angsuran_Bunga`', 4, -1, FALSE, '`Angsuran_Bunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Bunga->Sortable = TRUE; // Allow sort
		$this->Angsuran_Bunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Bunga'] = &$this->Angsuran_Bunga;

		// Angsuran_Total
		$this->Angsuran_Total = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Angsuran_Total', 'Angsuran_Total', '`Angsuran_Total`', '`Angsuran_Total`', 4, -1, FALSE, '`Angsuran_Total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Angsuran_Total->Sortable = TRUE; // Allow sort
		$this->Angsuran_Total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Angsuran_Total'] = &$this->Angsuran_Total;

		// No_Ref
		$this->No_Ref = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_No_Ref', 'No_Ref', '`No_Ref`', '`No_Ref`', 200, -1, FALSE, '`No_Ref`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->No_Ref->Sortable = TRUE; // Allow sort
		$this->fields['No_Ref'] = &$this->No_Ref;

		// Biaya_Administrasi
		$this->Biaya_Administrasi = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Biaya_Administrasi', 'Biaya_Administrasi', '`Biaya_Administrasi`', '`Biaya_Administrasi`', 4, -1, FALSE, '`Biaya_Administrasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Biaya_Administrasi->Sortable = TRUE; // Allow sort
		$this->Biaya_Administrasi->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Biaya_Administrasi'] = &$this->Biaya_Administrasi;

		// Biaya_Materai
		$this->Biaya_Materai = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Biaya_Materai', 'Biaya_Materai', '`Biaya_Materai`', '`Biaya_Materai`', 4, -1, FALSE, '`Biaya_Materai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Biaya_Materai->Sortable = TRUE; // Allow sort
		$this->Biaya_Materai->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Biaya_Materai'] = &$this->Biaya_Materai;

		// marketing_id
		$this->marketing_id = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_marketing_id', 'marketing_id', '`marketing_id`', '`marketing_id`', 3, -1, FALSE, '`marketing_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->marketing_id->Sortable = TRUE; // Allow sort
		$this->marketing_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['marketing_id'] = &$this->marketing_id;

		// Periode
		$this->Periode = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Periode', 'Periode', '`Periode`', '`Periode`', 200, -1, FALSE, '`Periode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Periode->Sortable = TRUE; // Allow sort
		$this->fields['Periode'] = &$this->Periode;

		// Macet
		$this->Macet = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Macet', 'Macet', '`Macet`', '`Macet`', 202, -1, FALSE, '`Macet`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Macet->Sortable = TRUE; // Allow sort
		$this->Macet->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->Macet->TrueValue = 'Y';
		$this->Macet->FalseValue = 'N';
		$this->Macet->OptionCount = 2;
		$this->fields['Macet'] = &$this->Macet;

		// NasabahNama
		$this->NasabahNama = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_NasabahNama', 'NasabahNama', '`NasabahNama`', '`NasabahNama`', 200, -1, FALSE, '`NasabahNama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NasabahNama->Sortable = TRUE; // Allow sort
		$this->fields['NasabahNama'] = &$this->NasabahNama;

		// NasabahAlamat
		$this->NasabahAlamat = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_NasabahAlamat', 'NasabahAlamat', '`NasabahAlamat`', '`NasabahAlamat`', 201, -1, FALSE, '`NasabahAlamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->NasabahAlamat->Sortable = TRUE; // Allow sort
		$this->fields['NasabahAlamat'] = &$this->NasabahAlamat;

		// No_Telp_Hp
		$this->No_Telp_Hp = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_No_Telp_Hp', 'No_Telp_Hp', '`No_Telp_Hp`', '`No_Telp_Hp`', 200, -1, FALSE, '`No_Telp_Hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->No_Telp_Hp->Sortable = TRUE; // Allow sort
		$this->fields['No_Telp_Hp'] = &$this->No_Telp_Hp;

		// Pekerjaan
		$this->Pekerjaan = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Pekerjaan', 'Pekerjaan', '`Pekerjaan`', '`Pekerjaan`', 200, -1, FALSE, '`Pekerjaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Pekerjaan->Sortable = TRUE; // Allow sort
		$this->fields['Pekerjaan'] = &$this->Pekerjaan;

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Pekerjaan_Alamat', 'Pekerjaan_Alamat', '`Pekerjaan_Alamat`', '`Pekerjaan_Alamat`', 201, -1, FALSE, '`Pekerjaan_Alamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Pekerjaan_Alamat->Sortable = TRUE; // Allow sort
		$this->fields['Pekerjaan_Alamat'] = &$this->Pekerjaan_Alamat;

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Pekerjaan_No_Telp_Hp', 'Pekerjaan_No_Telp_Hp', '`Pekerjaan_No_Telp_Hp`', '`Pekerjaan_No_Telp_Hp`', 200, -1, FALSE, '`Pekerjaan_No_Telp_Hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Pekerjaan_No_Telp_Hp->Sortable = TRUE; // Allow sort
		$this->fields['Pekerjaan_No_Telp_Hp'] = &$this->Pekerjaan_No_Telp_Hp;

		// Status
		$this->Status = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Status', 'Status', '`Status`', '`Status`', 16, -1, FALSE, '`Status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Status->Sortable = TRUE; // Allow sort
		$this->Status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status'] = &$this->Status;

		// NasabahKeterangan
		$this->NasabahKeterangan = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_NasabahKeterangan', 'NasabahKeterangan', '`NasabahKeterangan`', '`NasabahKeterangan`', 200, -1, FALSE, '`NasabahKeterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NasabahKeterangan->Sortable = TRUE; // Allow sort
		$this->fields['NasabahKeterangan'] = &$this->NasabahKeterangan;

		// MarketingNama
		$this->MarketingNama = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_MarketingNama', 'MarketingNama', '`MarketingNama`', '`MarketingNama`', 200, -1, FALSE, '`MarketingNama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MarketingNama->Sortable = TRUE; // Allow sort
		$this->fields['MarketingNama'] = &$this->MarketingNama;

		// MarketingAlamat
		$this->MarketingAlamat = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_MarketingAlamat', 'MarketingAlamat', '`MarketingAlamat`', '`MarketingAlamat`', 200, -1, FALSE, '`MarketingAlamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MarketingAlamat->Sortable = TRUE; // Allow sort
		$this->fields['MarketingAlamat'] = &$this->MarketingAlamat;

		// NoHP
		$this->NoHP = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_NoHP', 'NoHP', '`NoHP`', '`NoHP`', 200, -1, FALSE, '`NoHP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NoHP->Sortable = TRUE; // Allow sort
		$this->fields['NoHP'] = &$this->NoHP;

		// AkhirKontrak
		$this->AkhirKontrak = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_AkhirKontrak', 'AkhirKontrak', '`AkhirKontrak`', ew_CastDateFieldForLike('`AkhirKontrak`', 0, "DB"), 133, 0, FALSE, '`AkhirKontrak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AkhirKontrak->Sortable = TRUE; // Allow sort
		$this->AkhirKontrak->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['AkhirKontrak'] = &$this->AkhirKontrak;

		// sudah_bayar
		$this->sudah_bayar = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_sudah_bayar', 'sudah_bayar', '`sudah_bayar`', '`sudah_bayar`', 20, -1, FALSE, '`sudah_bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sudah_bayar->Sortable = TRUE; // Allow sort
		$this->sudah_bayar->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sudah_bayar'] = &$this->sudah_bayar;

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_pd_Angsuran_Pokok', 'pd_Angsuran_Pokok', '`pd_Angsuran_Pokok`', '`pd_Angsuran_Pokok`', 5, -1, FALSE, '`pd_Angsuran_Pokok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pd_Angsuran_Pokok->Sortable = TRUE; // Allow sort
		$this->pd_Angsuran_Pokok->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pd_Angsuran_Pokok'] = &$this->pd_Angsuran_Pokok;

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_pd_Angsuran_Bunga', 'pd_Angsuran_Bunga', '`pd_Angsuran_Bunga`', '`pd_Angsuran_Bunga`', 5, -1, FALSE, '`pd_Angsuran_Bunga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pd_Angsuran_Bunga->Sortable = TRUE; // Allow sort
		$this->pd_Angsuran_Bunga->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pd_Angsuran_Bunga'] = &$this->pd_Angsuran_Bunga;

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_pd_Angsuran_Total', 'pd_Angsuran_Total', '`pd_Angsuran_Total`', '`pd_Angsuran_Total`', 5, -1, FALSE, '`pd_Angsuran_Total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pd_Angsuran_Total->Sortable = TRUE; // Allow sort
		$this->pd_Angsuran_Total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pd_Angsuran_Total'] = &$this->pd_Angsuran_Total;

		// Tanggal_Bayar
		$this->Tanggal_Bayar = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_Tanggal_Bayar', 'Tanggal_Bayar', '`Tanggal_Bayar`', ew_CastDateFieldForLike('`Tanggal_Bayar`', 0, "DB"), 133, 0, FALSE, '`Tanggal_Bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tanggal_Bayar->Sortable = TRUE; // Allow sort
		$this->Tanggal_Bayar->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Tanggal_Bayar'] = &$this->Tanggal_Bayar;

		// umur_tunggakan
		$this->umur_tunggakan = new cField('v0302_pinjamanlap', 'v0302_pinjamanlap', 'x_umur_tunggakan', 'umur_tunggakan', '`umur_tunggakan`', '`umur_tunggakan`', 3, -1, FALSE, '`umur_tunggakan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->umur_tunggakan->Sortable = TRUE; // Allow sort
		$this->umur_tunggakan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['umur_tunggakan'] = &$this->umur_tunggakan;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v0302_pinjamanlap`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->pinjaman_id->setDbValue($conn->Insert_ID());
			$rs['pinjaman_id'] = $this->pinjaman_id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'pinjaman_id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('pinjaman_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pinjaman_id', $this->DBID) . '=' . ew_QuotedValue($rs['pinjaman_id'], $this->pinjaman_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`pinjaman_id` = @pinjaman_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pinjaman_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@pinjaman_id@", ew_AdjustSql($this->pinjaman_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "v0302_pinjamanlaplist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "v0302_pinjamanlaplist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("v0302_pinjamanlapview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("v0302_pinjamanlapview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "v0302_pinjamanlapadd.php?" . $this->UrlParm($parm);
		else
			$url = "v0302_pinjamanlapadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("v0302_pinjamanlapedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("v0302_pinjamanlapadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("v0302_pinjamanlapdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "pinjaman_id:" . ew_VarToJson($this->pinjaman_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pinjaman_id->CurrentValue)) {
			$sUrl .= "pinjaman_id=" . urlencode($this->pinjaman_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["pinjaman_id"]))
				$arKeys[] = ew_StripSlashes($_POST["pinjaman_id"]);
			elseif (isset($_GET["pinjaman_id"]))
				$arKeys[] = ew_StripSlashes($_GET["pinjaman_id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->pinjaman_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->pinjaman_id->setDbValue($rs->fields('pinjaman_id'));
		$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
		$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->jaminan_id->setDbValue($rs->fields('jaminan_id'));
		$this->Pinjaman->setDbValue($rs->fields('Pinjaman'));
		$this->Angsuran_Lama->setDbValue($rs->fields('Angsuran_Lama'));
		$this->Angsuran_Bunga_Prosen->setDbValue($rs->fields('Angsuran_Bunga_Prosen'));
		$this->Angsuran_Denda->setDbValue($rs->fields('Angsuran_Denda'));
		$this->Dispensasi_Denda->setDbValue($rs->fields('Dispensasi_Denda'));
		$this->Angsuran_Pokok->setDbValue($rs->fields('Angsuran_Pokok'));
		$this->Angsuran_Bunga->setDbValue($rs->fields('Angsuran_Bunga'));
		$this->Angsuran_Total->setDbValue($rs->fields('Angsuran_Total'));
		$this->No_Ref->setDbValue($rs->fields('No_Ref'));
		$this->Biaya_Administrasi->setDbValue($rs->fields('Biaya_Administrasi'));
		$this->Biaya_Materai->setDbValue($rs->fields('Biaya_Materai'));
		$this->marketing_id->setDbValue($rs->fields('marketing_id'));
		$this->Periode->setDbValue($rs->fields('Periode'));
		$this->Macet->setDbValue($rs->fields('Macet'));
		$this->NasabahNama->setDbValue($rs->fields('NasabahNama'));
		$this->NasabahAlamat->setDbValue($rs->fields('NasabahAlamat'));
		$this->No_Telp_Hp->setDbValue($rs->fields('No_Telp_Hp'));
		$this->Pekerjaan->setDbValue($rs->fields('Pekerjaan'));
		$this->Pekerjaan_Alamat->setDbValue($rs->fields('Pekerjaan_Alamat'));
		$this->Pekerjaan_No_Telp_Hp->setDbValue($rs->fields('Pekerjaan_No_Telp_Hp'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->NasabahKeterangan->setDbValue($rs->fields('NasabahKeterangan'));
		$this->MarketingNama->setDbValue($rs->fields('MarketingNama'));
		$this->MarketingAlamat->setDbValue($rs->fields('MarketingAlamat'));
		$this->NoHP->setDbValue($rs->fields('NoHP'));
		$this->AkhirKontrak->setDbValue($rs->fields('AkhirKontrak'));
		$this->sudah_bayar->setDbValue($rs->fields('sudah_bayar'));
		$this->pd_Angsuran_Pokok->setDbValue($rs->fields('pd_Angsuran_Pokok'));
		$this->pd_Angsuran_Bunga->setDbValue($rs->fields('pd_Angsuran_Bunga'));
		$this->pd_Angsuran_Total->setDbValue($rs->fields('pd_Angsuran_Total'));
		$this->Tanggal_Bayar->setDbValue($rs->fields('Tanggal_Bayar'));
		$this->umur_tunggakan->setDbValue($rs->fields('umur_tunggakan'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// pinjaman_id
		// Kontrak_No
		// Kontrak_Tgl
		// nasabah_id
		// jaminan_id
		// Pinjaman
		// Angsuran_Lama
		// Angsuran_Bunga_Prosen
		// Angsuran_Denda
		// Dispensasi_Denda
		// Angsuran_Pokok
		// Angsuran_Bunga
		// Angsuran_Total
		// No_Ref
		// Biaya_Administrasi
		// Biaya_Materai
		// marketing_id
		// Periode
		// Macet
		// NasabahNama
		// NasabahAlamat
		// No_Telp_Hp
		// Pekerjaan
		// Pekerjaan_Alamat
		// Pekerjaan_No_Telp_Hp
		// Status
		// NasabahKeterangan
		// MarketingNama
		// MarketingAlamat
		// NoHP
		// AkhirKontrak
		// sudah_bayar
		// pd_Angsuran_Pokok
		// pd_Angsuran_Bunga
		// pd_Angsuran_Total
		// Tanggal_Bayar
		// umur_tunggakan
		// pinjaman_id

		$this->pinjaman_id->ViewValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Kontrak_No
		$this->Kontrak_No->ViewValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_No->ViewCustomAttributes = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl->ViewValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Tgl->ViewValue = ew_FormatDateTime($this->Kontrak_Tgl->ViewValue, 0);
		$this->Kontrak_Tgl->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

		// jaminan_id
		$this->jaminan_id->ViewValue = $this->jaminan_id->CurrentValue;
		$this->jaminan_id->ViewCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->ViewCustomAttributes = "";

		// Angsuran_Lama
		$this->Angsuran_Lama->ViewValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Lama->ViewCustomAttributes = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->ViewValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
		$this->Angsuran_Bunga_Prosen->ViewCustomAttributes = "";

		// Angsuran_Denda
		$this->Angsuran_Denda->ViewValue = $this->Angsuran_Denda->CurrentValue;
		$this->Angsuran_Denda->ViewCustomAttributes = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda->ViewValue = $this->Dispensasi_Denda->CurrentValue;
		$this->Dispensasi_Denda->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// No_Ref
		$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->ViewCustomAttributes = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi->ViewValue = $this->Biaya_Administrasi->CurrentValue;
		$this->Biaya_Administrasi->ViewCustomAttributes = "";

		// Biaya_Materai
		$this->Biaya_Materai->ViewValue = $this->Biaya_Materai->CurrentValue;
		$this->Biaya_Materai->ViewCustomAttributes = "";

		// marketing_id
		$this->marketing_id->ViewValue = $this->marketing_id->CurrentValue;
		$this->marketing_id->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// Macet
		if (ew_ConvertToBool($this->Macet->CurrentValue)) {
			$this->Macet->ViewValue = $this->Macet->FldTagCaption(1) <> "" ? $this->Macet->FldTagCaption(1) : "Y";
		} else {
			$this->Macet->ViewValue = $this->Macet->FldTagCaption(2) <> "" ? $this->Macet->FldTagCaption(2) : "N";
		}
		$this->Macet->ViewCustomAttributes = "";

		// NasabahNama
		$this->NasabahNama->ViewValue = $this->NasabahNama->CurrentValue;
		$this->NasabahNama->ViewCustomAttributes = "";

		// NasabahAlamat
		$this->NasabahAlamat->ViewValue = $this->NasabahAlamat->CurrentValue;
		$this->NasabahAlamat->ViewCustomAttributes = "";

		// No_Telp_Hp
		$this->No_Telp_Hp->ViewValue = $this->No_Telp_Hp->CurrentValue;
		$this->No_Telp_Hp->ViewCustomAttributes = "";

		// Pekerjaan
		$this->Pekerjaan->ViewValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->ViewCustomAttributes = "";

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->ViewValue = $this->Pekerjaan_Alamat->CurrentValue;
		$this->Pekerjaan_Alamat->ViewCustomAttributes = "";

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->ViewValue = $this->Pekerjaan_No_Telp_Hp->CurrentValue;
		$this->Pekerjaan_No_Telp_Hp->ViewCustomAttributes = "";

		// Status
		$this->Status->ViewValue = $this->Status->CurrentValue;
		$this->Status->ViewCustomAttributes = "";

		// NasabahKeterangan
		$this->NasabahKeterangan->ViewValue = $this->NasabahKeterangan->CurrentValue;
		$this->NasabahKeterangan->ViewCustomAttributes = "";

		// MarketingNama
		$this->MarketingNama->ViewValue = $this->MarketingNama->CurrentValue;
		$this->MarketingNama->ViewCustomAttributes = "";

		// MarketingAlamat
		$this->MarketingAlamat->ViewValue = $this->MarketingAlamat->CurrentValue;
		$this->MarketingAlamat->ViewCustomAttributes = "";

		// NoHP
		$this->NoHP->ViewValue = $this->NoHP->CurrentValue;
		$this->NoHP->ViewCustomAttributes = "";

		// AkhirKontrak
		$this->AkhirKontrak->ViewValue = $this->AkhirKontrak->CurrentValue;
		$this->AkhirKontrak->ViewValue = ew_FormatDateTime($this->AkhirKontrak->ViewValue, 0);
		$this->AkhirKontrak->ViewCustomAttributes = "";

		// sudah_bayar
		$this->sudah_bayar->ViewValue = $this->sudah_bayar->CurrentValue;
		$this->sudah_bayar->ViewCustomAttributes = "";

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->ViewValue = $this->pd_Angsuran_Pokok->CurrentValue;
		$this->pd_Angsuran_Pokok->ViewCustomAttributes = "";

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->ViewValue = $this->pd_Angsuran_Bunga->CurrentValue;
		$this->pd_Angsuran_Bunga->ViewCustomAttributes = "";

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->ViewValue = $this->pd_Angsuran_Total->CurrentValue;
		$this->pd_Angsuran_Total->ViewCustomAttributes = "";

		// Tanggal_Bayar
		$this->Tanggal_Bayar->ViewValue = $this->Tanggal_Bayar->CurrentValue;
		$this->Tanggal_Bayar->ViewValue = ew_FormatDateTime($this->Tanggal_Bayar->ViewValue, 0);
		$this->Tanggal_Bayar->ViewCustomAttributes = "";

		// umur_tunggakan
		$this->umur_tunggakan->ViewValue = $this->umur_tunggakan->CurrentValue;
		$this->umur_tunggakan->ViewCustomAttributes = "";

		// pinjaman_id
		$this->pinjaman_id->LinkCustomAttributes = "";
		$this->pinjaman_id->HrefValue = "";
		$this->pinjaman_id->TooltipValue = "";

		// Kontrak_No
		$this->Kontrak_No->LinkCustomAttributes = "";
		$this->Kontrak_No->HrefValue = "";
		$this->Kontrak_No->TooltipValue = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl->LinkCustomAttributes = "";
		$this->Kontrak_Tgl->HrefValue = "";
		$this->Kontrak_Tgl->TooltipValue = "";

		// nasabah_id
		$this->nasabah_id->LinkCustomAttributes = "";
		$this->nasabah_id->HrefValue = "";
		$this->nasabah_id->TooltipValue = "";

		// jaminan_id
		$this->jaminan_id->LinkCustomAttributes = "";
		$this->jaminan_id->HrefValue = "";
		$this->jaminan_id->TooltipValue = "";

		// Pinjaman
		$this->Pinjaman->LinkCustomAttributes = "";
		$this->Pinjaman->HrefValue = "";
		$this->Pinjaman->TooltipValue = "";

		// Angsuran_Lama
		$this->Angsuran_Lama->LinkCustomAttributes = "";
		$this->Angsuran_Lama->HrefValue = "";
		$this->Angsuran_Lama->TooltipValue = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->LinkCustomAttributes = "";
		$this->Angsuran_Bunga_Prosen->HrefValue = "";
		$this->Angsuran_Bunga_Prosen->TooltipValue = "";

		// Angsuran_Denda
		$this->Angsuran_Denda->LinkCustomAttributes = "";
		$this->Angsuran_Denda->HrefValue = "";
		$this->Angsuran_Denda->TooltipValue = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda->LinkCustomAttributes = "";
		$this->Dispensasi_Denda->HrefValue = "";
		$this->Dispensasi_Denda->TooltipValue = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->LinkCustomAttributes = "";
		$this->Angsuran_Pokok->HrefValue = "";
		$this->Angsuran_Pokok->TooltipValue = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->LinkCustomAttributes = "";
		$this->Angsuran_Bunga->HrefValue = "";
		$this->Angsuran_Bunga->TooltipValue = "";

		// Angsuran_Total
		$this->Angsuran_Total->LinkCustomAttributes = "";
		$this->Angsuran_Total->HrefValue = "";
		$this->Angsuran_Total->TooltipValue = "";

		// No_Ref
		$this->No_Ref->LinkCustomAttributes = "";
		$this->No_Ref->HrefValue = "";
		$this->No_Ref->TooltipValue = "";

		// Biaya_Administrasi
		$this->Biaya_Administrasi->LinkCustomAttributes = "";
		$this->Biaya_Administrasi->HrefValue = "";
		$this->Biaya_Administrasi->TooltipValue = "";

		// Biaya_Materai
		$this->Biaya_Materai->LinkCustomAttributes = "";
		$this->Biaya_Materai->HrefValue = "";
		$this->Biaya_Materai->TooltipValue = "";

		// marketing_id
		$this->marketing_id->LinkCustomAttributes = "";
		$this->marketing_id->HrefValue = "";
		$this->marketing_id->TooltipValue = "";

		// Periode
		$this->Periode->LinkCustomAttributes = "";
		$this->Periode->HrefValue = "";
		$this->Periode->TooltipValue = "";

		// Macet
		$this->Macet->LinkCustomAttributes = "";
		$this->Macet->HrefValue = "";
		$this->Macet->TooltipValue = "";

		// NasabahNama
		$this->NasabahNama->LinkCustomAttributes = "";
		$this->NasabahNama->HrefValue = "";
		$this->NasabahNama->TooltipValue = "";

		// NasabahAlamat
		$this->NasabahAlamat->LinkCustomAttributes = "";
		$this->NasabahAlamat->HrefValue = "";
		$this->NasabahAlamat->TooltipValue = "";

		// No_Telp_Hp
		$this->No_Telp_Hp->LinkCustomAttributes = "";
		$this->No_Telp_Hp->HrefValue = "";
		$this->No_Telp_Hp->TooltipValue = "";

		// Pekerjaan
		$this->Pekerjaan->LinkCustomAttributes = "";
		$this->Pekerjaan->HrefValue = "";
		$this->Pekerjaan->TooltipValue = "";

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->LinkCustomAttributes = "";
		$this->Pekerjaan_Alamat->HrefValue = "";
		$this->Pekerjaan_Alamat->TooltipValue = "";

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->LinkCustomAttributes = "";
		$this->Pekerjaan_No_Telp_Hp->HrefValue = "";
		$this->Pekerjaan_No_Telp_Hp->TooltipValue = "";

		// Status
		$this->Status->LinkCustomAttributes = "";
		$this->Status->HrefValue = "";
		$this->Status->TooltipValue = "";

		// NasabahKeterangan
		$this->NasabahKeterangan->LinkCustomAttributes = "";
		$this->NasabahKeterangan->HrefValue = "";
		$this->NasabahKeterangan->TooltipValue = "";

		// MarketingNama
		$this->MarketingNama->LinkCustomAttributes = "";
		$this->MarketingNama->HrefValue = "";
		$this->MarketingNama->TooltipValue = "";

		// MarketingAlamat
		$this->MarketingAlamat->LinkCustomAttributes = "";
		$this->MarketingAlamat->HrefValue = "";
		$this->MarketingAlamat->TooltipValue = "";

		// NoHP
		$this->NoHP->LinkCustomAttributes = "";
		$this->NoHP->HrefValue = "";
		$this->NoHP->TooltipValue = "";

		// AkhirKontrak
		$this->AkhirKontrak->LinkCustomAttributes = "";
		$this->AkhirKontrak->HrefValue = "";
		$this->AkhirKontrak->TooltipValue = "";

		// sudah_bayar
		$this->sudah_bayar->LinkCustomAttributes = "";
		$this->sudah_bayar->HrefValue = "";
		$this->sudah_bayar->TooltipValue = "";

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->LinkCustomAttributes = "";
		$this->pd_Angsuran_Pokok->HrefValue = "";
		$this->pd_Angsuran_Pokok->TooltipValue = "";

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->LinkCustomAttributes = "";
		$this->pd_Angsuran_Bunga->HrefValue = "";
		$this->pd_Angsuran_Bunga->TooltipValue = "";

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->LinkCustomAttributes = "";
		$this->pd_Angsuran_Total->HrefValue = "";
		$this->pd_Angsuran_Total->TooltipValue = "";

		// Tanggal_Bayar
		$this->Tanggal_Bayar->LinkCustomAttributes = "";
		$this->Tanggal_Bayar->HrefValue = "";
		$this->Tanggal_Bayar->TooltipValue = "";

		// umur_tunggakan
		$this->umur_tunggakan->LinkCustomAttributes = "";
		$this->umur_tunggakan->HrefValue = "";
		$this->umur_tunggakan->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// pinjaman_id
		$this->pinjaman_id->EditAttrs["class"] = "form-control";
		$this->pinjaman_id->EditCustomAttributes = "";
		$this->pinjaman_id->EditValue = $this->pinjaman_id->CurrentValue;
		$this->pinjaman_id->ViewCustomAttributes = "";

		// Kontrak_No
		$this->Kontrak_No->EditAttrs["class"] = "form-control";
		$this->Kontrak_No->EditCustomAttributes = "";
		$this->Kontrak_No->EditValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_No->PlaceHolder = ew_RemoveHtml($this->Kontrak_No->FldCaption());

		// Kontrak_Tgl
		$this->Kontrak_Tgl->EditAttrs["class"] = "form-control";
		$this->Kontrak_Tgl->EditCustomAttributes = "";
		$this->Kontrak_Tgl->EditValue = ew_FormatDateTime($this->Kontrak_Tgl->CurrentValue, 8);
		$this->Kontrak_Tgl->PlaceHolder = ew_RemoveHtml($this->Kontrak_Tgl->FldCaption());

		// nasabah_id
		$this->nasabah_id->EditAttrs["class"] = "form-control";
		$this->nasabah_id->EditCustomAttributes = "";
		$this->nasabah_id->EditValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->PlaceHolder = ew_RemoveHtml($this->nasabah_id->FldCaption());

		// jaminan_id
		$this->jaminan_id->EditAttrs["class"] = "form-control";
		$this->jaminan_id->EditCustomAttributes = "";
		$this->jaminan_id->EditValue = $this->jaminan_id->CurrentValue;
		$this->jaminan_id->PlaceHolder = ew_RemoveHtml($this->jaminan_id->FldCaption());

		// Pinjaman
		$this->Pinjaman->EditAttrs["class"] = "form-control";
		$this->Pinjaman->EditCustomAttributes = "";
		$this->Pinjaman->EditValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->PlaceHolder = ew_RemoveHtml($this->Pinjaman->FldCaption());
		if (strval($this->Pinjaman->EditValue) <> "" && is_numeric($this->Pinjaman->EditValue)) $this->Pinjaman->EditValue = ew_FormatNumber($this->Pinjaman->EditValue, -2, -1, -2, 0);

		// Angsuran_Lama
		$this->Angsuran_Lama->EditAttrs["class"] = "form-control";
		$this->Angsuran_Lama->EditCustomAttributes = "";
		$this->Angsuran_Lama->EditValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Lama->PlaceHolder = ew_RemoveHtml($this->Angsuran_Lama->FldCaption());

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->EditAttrs["class"] = "form-control";
		$this->Angsuran_Bunga_Prosen->EditCustomAttributes = "";
		$this->Angsuran_Bunga_Prosen->EditValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
		$this->Angsuran_Bunga_Prosen->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga_Prosen->FldCaption());
		if (strval($this->Angsuran_Bunga_Prosen->EditValue) <> "" && is_numeric($this->Angsuran_Bunga_Prosen->EditValue)) $this->Angsuran_Bunga_Prosen->EditValue = ew_FormatNumber($this->Angsuran_Bunga_Prosen->EditValue, -2, -1, -2, 0);

		// Angsuran_Denda
		$this->Angsuran_Denda->EditAttrs["class"] = "form-control";
		$this->Angsuran_Denda->EditCustomAttributes = "";
		$this->Angsuran_Denda->EditValue = $this->Angsuran_Denda->CurrentValue;
		$this->Angsuran_Denda->PlaceHolder = ew_RemoveHtml($this->Angsuran_Denda->FldCaption());
		if (strval($this->Angsuran_Denda->EditValue) <> "" && is_numeric($this->Angsuran_Denda->EditValue)) $this->Angsuran_Denda->EditValue = ew_FormatNumber($this->Angsuran_Denda->EditValue, -2, -1, -2, 0);

		// Dispensasi_Denda
		$this->Dispensasi_Denda->EditAttrs["class"] = "form-control";
		$this->Dispensasi_Denda->EditCustomAttributes = "";
		$this->Dispensasi_Denda->EditValue = $this->Dispensasi_Denda->CurrentValue;
		$this->Dispensasi_Denda->PlaceHolder = ew_RemoveHtml($this->Dispensasi_Denda->FldCaption());

		// Angsuran_Pokok
		$this->Angsuran_Pokok->EditAttrs["class"] = "form-control";
		$this->Angsuran_Pokok->EditCustomAttributes = "";
		$this->Angsuran_Pokok->EditValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->PlaceHolder = ew_RemoveHtml($this->Angsuran_Pokok->FldCaption());
		if (strval($this->Angsuran_Pokok->EditValue) <> "" && is_numeric($this->Angsuran_Pokok->EditValue)) $this->Angsuran_Pokok->EditValue = ew_FormatNumber($this->Angsuran_Pokok->EditValue, -2, -1, -2, 0);

		// Angsuran_Bunga
		$this->Angsuran_Bunga->EditAttrs["class"] = "form-control";
		$this->Angsuran_Bunga->EditCustomAttributes = "";
		$this->Angsuran_Bunga->EditValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->PlaceHolder = ew_RemoveHtml($this->Angsuran_Bunga->FldCaption());
		if (strval($this->Angsuran_Bunga->EditValue) <> "" && is_numeric($this->Angsuran_Bunga->EditValue)) $this->Angsuran_Bunga->EditValue = ew_FormatNumber($this->Angsuran_Bunga->EditValue, -2, -1, -2, 0);

		// Angsuran_Total
		$this->Angsuran_Total->EditAttrs["class"] = "form-control";
		$this->Angsuran_Total->EditCustomAttributes = "";
		$this->Angsuran_Total->EditValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->PlaceHolder = ew_RemoveHtml($this->Angsuran_Total->FldCaption());
		if (strval($this->Angsuran_Total->EditValue) <> "" && is_numeric($this->Angsuran_Total->EditValue)) $this->Angsuran_Total->EditValue = ew_FormatNumber($this->Angsuran_Total->EditValue, -2, -1, -2, 0);

		// No_Ref
		$this->No_Ref->EditAttrs["class"] = "form-control";
		$this->No_Ref->EditCustomAttributes = "";
		$this->No_Ref->EditValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->PlaceHolder = ew_RemoveHtml($this->No_Ref->FldCaption());

		// Biaya_Administrasi
		$this->Biaya_Administrasi->EditAttrs["class"] = "form-control";
		$this->Biaya_Administrasi->EditCustomAttributes = "";
		$this->Biaya_Administrasi->EditValue = $this->Biaya_Administrasi->CurrentValue;
		$this->Biaya_Administrasi->PlaceHolder = ew_RemoveHtml($this->Biaya_Administrasi->FldCaption());
		if (strval($this->Biaya_Administrasi->EditValue) <> "" && is_numeric($this->Biaya_Administrasi->EditValue)) $this->Biaya_Administrasi->EditValue = ew_FormatNumber($this->Biaya_Administrasi->EditValue, -2, -1, -2, 0);

		// Biaya_Materai
		$this->Biaya_Materai->EditAttrs["class"] = "form-control";
		$this->Biaya_Materai->EditCustomAttributes = "";
		$this->Biaya_Materai->EditValue = $this->Biaya_Materai->CurrentValue;
		$this->Biaya_Materai->PlaceHolder = ew_RemoveHtml($this->Biaya_Materai->FldCaption());
		if (strval($this->Biaya_Materai->EditValue) <> "" && is_numeric($this->Biaya_Materai->EditValue)) $this->Biaya_Materai->EditValue = ew_FormatNumber($this->Biaya_Materai->EditValue, -2, -1, -2, 0);

		// marketing_id
		$this->marketing_id->EditAttrs["class"] = "form-control";
		$this->marketing_id->EditCustomAttributes = "";
		$this->marketing_id->EditValue = $this->marketing_id->CurrentValue;
		$this->marketing_id->PlaceHolder = ew_RemoveHtml($this->marketing_id->FldCaption());

		// Periode
		$this->Periode->EditAttrs["class"] = "form-control";
		$this->Periode->EditCustomAttributes = "";
		$this->Periode->EditValue = $this->Periode->CurrentValue;
		$this->Periode->PlaceHolder = ew_RemoveHtml($this->Periode->FldCaption());

		// Macet
		$this->Macet->EditCustomAttributes = "";
		$this->Macet->EditValue = $this->Macet->Options(FALSE);

		// NasabahNama
		$this->NasabahNama->EditAttrs["class"] = "form-control";
		$this->NasabahNama->EditCustomAttributes = "";
		$this->NasabahNama->EditValue = $this->NasabahNama->CurrentValue;
		$this->NasabahNama->PlaceHolder = ew_RemoveHtml($this->NasabahNama->FldCaption());

		// NasabahAlamat
		$this->NasabahAlamat->EditAttrs["class"] = "form-control";
		$this->NasabahAlamat->EditCustomAttributes = "";
		$this->NasabahAlamat->EditValue = $this->NasabahAlamat->CurrentValue;
		$this->NasabahAlamat->PlaceHolder = ew_RemoveHtml($this->NasabahAlamat->FldCaption());

		// No_Telp_Hp
		$this->No_Telp_Hp->EditAttrs["class"] = "form-control";
		$this->No_Telp_Hp->EditCustomAttributes = "";
		$this->No_Telp_Hp->EditValue = $this->No_Telp_Hp->CurrentValue;
		$this->No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->No_Telp_Hp->FldCaption());

		// Pekerjaan
		$this->Pekerjaan->EditAttrs["class"] = "form-control";
		$this->Pekerjaan->EditCustomAttributes = "";
		$this->Pekerjaan->EditValue = $this->Pekerjaan->CurrentValue;
		$this->Pekerjaan->PlaceHolder = ew_RemoveHtml($this->Pekerjaan->FldCaption());

		// Pekerjaan_Alamat
		$this->Pekerjaan_Alamat->EditAttrs["class"] = "form-control";
		$this->Pekerjaan_Alamat->EditCustomAttributes = "";
		$this->Pekerjaan_Alamat->EditValue = $this->Pekerjaan_Alamat->CurrentValue;
		$this->Pekerjaan_Alamat->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_Alamat->FldCaption());

		// Pekerjaan_No_Telp_Hp
		$this->Pekerjaan_No_Telp_Hp->EditAttrs["class"] = "form-control";
		$this->Pekerjaan_No_Telp_Hp->EditCustomAttributes = "";
		$this->Pekerjaan_No_Telp_Hp->EditValue = $this->Pekerjaan_No_Telp_Hp->CurrentValue;
		$this->Pekerjaan_No_Telp_Hp->PlaceHolder = ew_RemoveHtml($this->Pekerjaan_No_Telp_Hp->FldCaption());

		// Status
		$this->Status->EditAttrs["class"] = "form-control";
		$this->Status->EditCustomAttributes = "";
		$this->Status->EditValue = $this->Status->CurrentValue;
		$this->Status->PlaceHolder = ew_RemoveHtml($this->Status->FldCaption());

		// NasabahKeterangan
		$this->NasabahKeterangan->EditAttrs["class"] = "form-control";
		$this->NasabahKeterangan->EditCustomAttributes = "";
		$this->NasabahKeterangan->EditValue = $this->NasabahKeterangan->CurrentValue;
		$this->NasabahKeterangan->PlaceHolder = ew_RemoveHtml($this->NasabahKeterangan->FldCaption());

		// MarketingNama
		$this->MarketingNama->EditAttrs["class"] = "form-control";
		$this->MarketingNama->EditCustomAttributes = "";
		$this->MarketingNama->EditValue = $this->MarketingNama->CurrentValue;
		$this->MarketingNama->PlaceHolder = ew_RemoveHtml($this->MarketingNama->FldCaption());

		// MarketingAlamat
		$this->MarketingAlamat->EditAttrs["class"] = "form-control";
		$this->MarketingAlamat->EditCustomAttributes = "";
		$this->MarketingAlamat->EditValue = $this->MarketingAlamat->CurrentValue;
		$this->MarketingAlamat->PlaceHolder = ew_RemoveHtml($this->MarketingAlamat->FldCaption());

		// NoHP
		$this->NoHP->EditAttrs["class"] = "form-control";
		$this->NoHP->EditCustomAttributes = "";
		$this->NoHP->EditValue = $this->NoHP->CurrentValue;
		$this->NoHP->PlaceHolder = ew_RemoveHtml($this->NoHP->FldCaption());

		// AkhirKontrak
		$this->AkhirKontrak->EditAttrs["class"] = "form-control";
		$this->AkhirKontrak->EditCustomAttributes = "";
		$this->AkhirKontrak->EditValue = ew_FormatDateTime($this->AkhirKontrak->CurrentValue, 8);
		$this->AkhirKontrak->PlaceHolder = ew_RemoveHtml($this->AkhirKontrak->FldCaption());

		// sudah_bayar
		$this->sudah_bayar->EditAttrs["class"] = "form-control";
		$this->sudah_bayar->EditCustomAttributes = "";
		$this->sudah_bayar->EditValue = $this->sudah_bayar->CurrentValue;
		$this->sudah_bayar->PlaceHolder = ew_RemoveHtml($this->sudah_bayar->FldCaption());

		// pd_Angsuran_Pokok
		$this->pd_Angsuran_Pokok->EditAttrs["class"] = "form-control";
		$this->pd_Angsuran_Pokok->EditCustomAttributes = "";
		$this->pd_Angsuran_Pokok->EditValue = $this->pd_Angsuran_Pokok->CurrentValue;
		$this->pd_Angsuran_Pokok->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Pokok->FldCaption());
		if (strval($this->pd_Angsuran_Pokok->EditValue) <> "" && is_numeric($this->pd_Angsuran_Pokok->EditValue)) $this->pd_Angsuran_Pokok->EditValue = ew_FormatNumber($this->pd_Angsuran_Pokok->EditValue, -2, -1, -2, 0);

		// pd_Angsuran_Bunga
		$this->pd_Angsuran_Bunga->EditAttrs["class"] = "form-control";
		$this->pd_Angsuran_Bunga->EditCustomAttributes = "";
		$this->pd_Angsuran_Bunga->EditValue = $this->pd_Angsuran_Bunga->CurrentValue;
		$this->pd_Angsuran_Bunga->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Bunga->FldCaption());
		if (strval($this->pd_Angsuran_Bunga->EditValue) <> "" && is_numeric($this->pd_Angsuran_Bunga->EditValue)) $this->pd_Angsuran_Bunga->EditValue = ew_FormatNumber($this->pd_Angsuran_Bunga->EditValue, -2, -1, -2, 0);

		// pd_Angsuran_Total
		$this->pd_Angsuran_Total->EditAttrs["class"] = "form-control";
		$this->pd_Angsuran_Total->EditCustomAttributes = "";
		$this->pd_Angsuran_Total->EditValue = $this->pd_Angsuran_Total->CurrentValue;
		$this->pd_Angsuran_Total->PlaceHolder = ew_RemoveHtml($this->pd_Angsuran_Total->FldCaption());
		if (strval($this->pd_Angsuran_Total->EditValue) <> "" && is_numeric($this->pd_Angsuran_Total->EditValue)) $this->pd_Angsuran_Total->EditValue = ew_FormatNumber($this->pd_Angsuran_Total->EditValue, -2, -1, -2, 0);

		// Tanggal_Bayar
		$this->Tanggal_Bayar->EditAttrs["class"] = "form-control";
		$this->Tanggal_Bayar->EditCustomAttributes = "";
		$this->Tanggal_Bayar->EditValue = ew_FormatDateTime($this->Tanggal_Bayar->CurrentValue, 8);
		$this->Tanggal_Bayar->PlaceHolder = ew_RemoveHtml($this->Tanggal_Bayar->FldCaption());

		// umur_tunggakan
		$this->umur_tunggakan->EditAttrs["class"] = "form-control";
		$this->umur_tunggakan->EditCustomAttributes = "";
		$this->umur_tunggakan->EditValue = $this->umur_tunggakan->CurrentValue;
		$this->umur_tunggakan->PlaceHolder = ew_RemoveHtml($this->umur_tunggakan->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->pinjaman_id->Exportable) $Doc->ExportCaption($this->pinjaman_id);
					if ($this->Kontrak_No->Exportable) $Doc->ExportCaption($this->Kontrak_No);
					if ($this->Kontrak_Tgl->Exportable) $Doc->ExportCaption($this->Kontrak_Tgl);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->jaminan_id->Exportable) $Doc->ExportCaption($this->jaminan_id);
					if ($this->Pinjaman->Exportable) $Doc->ExportCaption($this->Pinjaman);
					if ($this->Angsuran_Lama->Exportable) $Doc->ExportCaption($this->Angsuran_Lama);
					if ($this->Angsuran_Bunga_Prosen->Exportable) $Doc->ExportCaption($this->Angsuran_Bunga_Prosen);
					if ($this->Angsuran_Denda->Exportable) $Doc->ExportCaption($this->Angsuran_Denda);
					if ($this->Dispensasi_Denda->Exportable) $Doc->ExportCaption($this->Dispensasi_Denda);
					if ($this->Angsuran_Pokok->Exportable) $Doc->ExportCaption($this->Angsuran_Pokok);
					if ($this->Angsuran_Bunga->Exportable) $Doc->ExportCaption($this->Angsuran_Bunga);
					if ($this->Angsuran_Total->Exportable) $Doc->ExportCaption($this->Angsuran_Total);
					if ($this->No_Ref->Exportable) $Doc->ExportCaption($this->No_Ref);
					if ($this->Biaya_Administrasi->Exportable) $Doc->ExportCaption($this->Biaya_Administrasi);
					if ($this->Biaya_Materai->Exportable) $Doc->ExportCaption($this->Biaya_Materai);
					if ($this->marketing_id->Exportable) $Doc->ExportCaption($this->marketing_id);
					if ($this->Periode->Exportable) $Doc->ExportCaption($this->Periode);
					if ($this->Macet->Exportable) $Doc->ExportCaption($this->Macet);
					if ($this->NasabahNama->Exportable) $Doc->ExportCaption($this->NasabahNama);
					if ($this->NasabahAlamat->Exportable) $Doc->ExportCaption($this->NasabahAlamat);
					if ($this->No_Telp_Hp->Exportable) $Doc->ExportCaption($this->No_Telp_Hp);
					if ($this->Pekerjaan->Exportable) $Doc->ExportCaption($this->Pekerjaan);
					if ($this->Pekerjaan_Alamat->Exportable) $Doc->ExportCaption($this->Pekerjaan_Alamat);
					if ($this->Pekerjaan_No_Telp_Hp->Exportable) $Doc->ExportCaption($this->Pekerjaan_No_Telp_Hp);
					if ($this->Status->Exportable) $Doc->ExportCaption($this->Status);
					if ($this->NasabahKeterangan->Exportable) $Doc->ExportCaption($this->NasabahKeterangan);
					if ($this->MarketingNama->Exportable) $Doc->ExportCaption($this->MarketingNama);
					if ($this->MarketingAlamat->Exportable) $Doc->ExportCaption($this->MarketingAlamat);
					if ($this->NoHP->Exportable) $Doc->ExportCaption($this->NoHP);
					if ($this->AkhirKontrak->Exportable) $Doc->ExportCaption($this->AkhirKontrak);
					if ($this->sudah_bayar->Exportable) $Doc->ExportCaption($this->sudah_bayar);
					if ($this->pd_Angsuran_Pokok->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Pokok);
					if ($this->pd_Angsuran_Bunga->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Bunga);
					if ($this->pd_Angsuran_Total->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Total);
					if ($this->Tanggal_Bayar->Exportable) $Doc->ExportCaption($this->Tanggal_Bayar);
					if ($this->umur_tunggakan->Exportable) $Doc->ExportCaption($this->umur_tunggakan);
				} else {
					if ($this->pinjaman_id->Exportable) $Doc->ExportCaption($this->pinjaman_id);
					if ($this->Kontrak_No->Exportable) $Doc->ExportCaption($this->Kontrak_No);
					if ($this->Kontrak_Tgl->Exportable) $Doc->ExportCaption($this->Kontrak_Tgl);
					if ($this->nasabah_id->Exportable) $Doc->ExportCaption($this->nasabah_id);
					if ($this->jaminan_id->Exportable) $Doc->ExportCaption($this->jaminan_id);
					if ($this->Pinjaman->Exportable) $Doc->ExportCaption($this->Pinjaman);
					if ($this->Angsuran_Lama->Exportable) $Doc->ExportCaption($this->Angsuran_Lama);
					if ($this->Angsuran_Bunga_Prosen->Exportable) $Doc->ExportCaption($this->Angsuran_Bunga_Prosen);
					if ($this->Angsuran_Denda->Exportable) $Doc->ExportCaption($this->Angsuran_Denda);
					if ($this->Dispensasi_Denda->Exportable) $Doc->ExportCaption($this->Dispensasi_Denda);
					if ($this->Angsuran_Pokok->Exportable) $Doc->ExportCaption($this->Angsuran_Pokok);
					if ($this->Angsuran_Bunga->Exportable) $Doc->ExportCaption($this->Angsuran_Bunga);
					if ($this->Angsuran_Total->Exportable) $Doc->ExportCaption($this->Angsuran_Total);
					if ($this->No_Ref->Exportable) $Doc->ExportCaption($this->No_Ref);
					if ($this->Biaya_Administrasi->Exportable) $Doc->ExportCaption($this->Biaya_Administrasi);
					if ($this->Biaya_Materai->Exportable) $Doc->ExportCaption($this->Biaya_Materai);
					if ($this->marketing_id->Exportable) $Doc->ExportCaption($this->marketing_id);
					if ($this->Periode->Exportable) $Doc->ExportCaption($this->Periode);
					if ($this->Macet->Exportable) $Doc->ExportCaption($this->Macet);
					if ($this->NasabahNama->Exportable) $Doc->ExportCaption($this->NasabahNama);
					if ($this->No_Telp_Hp->Exportable) $Doc->ExportCaption($this->No_Telp_Hp);
					if ($this->Pekerjaan->Exportable) $Doc->ExportCaption($this->Pekerjaan);
					if ($this->Pekerjaan_No_Telp_Hp->Exportable) $Doc->ExportCaption($this->Pekerjaan_No_Telp_Hp);
					if ($this->Status->Exportable) $Doc->ExportCaption($this->Status);
					if ($this->NasabahKeterangan->Exportable) $Doc->ExportCaption($this->NasabahKeterangan);
					if ($this->MarketingNama->Exportable) $Doc->ExportCaption($this->MarketingNama);
					if ($this->MarketingAlamat->Exportable) $Doc->ExportCaption($this->MarketingAlamat);
					if ($this->NoHP->Exportable) $Doc->ExportCaption($this->NoHP);
					if ($this->AkhirKontrak->Exportable) $Doc->ExportCaption($this->AkhirKontrak);
					if ($this->sudah_bayar->Exportable) $Doc->ExportCaption($this->sudah_bayar);
					if ($this->pd_Angsuran_Pokok->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Pokok);
					if ($this->pd_Angsuran_Bunga->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Bunga);
					if ($this->pd_Angsuran_Total->Exportable) $Doc->ExportCaption($this->pd_Angsuran_Total);
					if ($this->Tanggal_Bayar->Exportable) $Doc->ExportCaption($this->Tanggal_Bayar);
					if ($this->umur_tunggakan->Exportable) $Doc->ExportCaption($this->umur_tunggakan);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->pinjaman_id->Exportable) $Doc->ExportField($this->pinjaman_id);
						if ($this->Kontrak_No->Exportable) $Doc->ExportField($this->Kontrak_No);
						if ($this->Kontrak_Tgl->Exportable) $Doc->ExportField($this->Kontrak_Tgl);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->jaminan_id->Exportable) $Doc->ExportField($this->jaminan_id);
						if ($this->Pinjaman->Exportable) $Doc->ExportField($this->Pinjaman);
						if ($this->Angsuran_Lama->Exportable) $Doc->ExportField($this->Angsuran_Lama);
						if ($this->Angsuran_Bunga_Prosen->Exportable) $Doc->ExportField($this->Angsuran_Bunga_Prosen);
						if ($this->Angsuran_Denda->Exportable) $Doc->ExportField($this->Angsuran_Denda);
						if ($this->Dispensasi_Denda->Exportable) $Doc->ExportField($this->Dispensasi_Denda);
						if ($this->Angsuran_Pokok->Exportable) $Doc->ExportField($this->Angsuran_Pokok);
						if ($this->Angsuran_Bunga->Exportable) $Doc->ExportField($this->Angsuran_Bunga);
						if ($this->Angsuran_Total->Exportable) $Doc->ExportField($this->Angsuran_Total);
						if ($this->No_Ref->Exportable) $Doc->ExportField($this->No_Ref);
						if ($this->Biaya_Administrasi->Exportable) $Doc->ExportField($this->Biaya_Administrasi);
						if ($this->Biaya_Materai->Exportable) $Doc->ExportField($this->Biaya_Materai);
						if ($this->marketing_id->Exportable) $Doc->ExportField($this->marketing_id);
						if ($this->Periode->Exportable) $Doc->ExportField($this->Periode);
						if ($this->Macet->Exportable) $Doc->ExportField($this->Macet);
						if ($this->NasabahNama->Exportable) $Doc->ExportField($this->NasabahNama);
						if ($this->NasabahAlamat->Exportable) $Doc->ExportField($this->NasabahAlamat);
						if ($this->No_Telp_Hp->Exportable) $Doc->ExportField($this->No_Telp_Hp);
						if ($this->Pekerjaan->Exportable) $Doc->ExportField($this->Pekerjaan);
						if ($this->Pekerjaan_Alamat->Exportable) $Doc->ExportField($this->Pekerjaan_Alamat);
						if ($this->Pekerjaan_No_Telp_Hp->Exportable) $Doc->ExportField($this->Pekerjaan_No_Telp_Hp);
						if ($this->Status->Exportable) $Doc->ExportField($this->Status);
						if ($this->NasabahKeterangan->Exportable) $Doc->ExportField($this->NasabahKeterangan);
						if ($this->MarketingNama->Exportable) $Doc->ExportField($this->MarketingNama);
						if ($this->MarketingAlamat->Exportable) $Doc->ExportField($this->MarketingAlamat);
						if ($this->NoHP->Exportable) $Doc->ExportField($this->NoHP);
						if ($this->AkhirKontrak->Exportable) $Doc->ExportField($this->AkhirKontrak);
						if ($this->sudah_bayar->Exportable) $Doc->ExportField($this->sudah_bayar);
						if ($this->pd_Angsuran_Pokok->Exportable) $Doc->ExportField($this->pd_Angsuran_Pokok);
						if ($this->pd_Angsuran_Bunga->Exportable) $Doc->ExportField($this->pd_Angsuran_Bunga);
						if ($this->pd_Angsuran_Total->Exportable) $Doc->ExportField($this->pd_Angsuran_Total);
						if ($this->Tanggal_Bayar->Exportable) $Doc->ExportField($this->Tanggal_Bayar);
						if ($this->umur_tunggakan->Exportable) $Doc->ExportField($this->umur_tunggakan);
					} else {
						if ($this->pinjaman_id->Exportable) $Doc->ExportField($this->pinjaman_id);
						if ($this->Kontrak_No->Exportable) $Doc->ExportField($this->Kontrak_No);
						if ($this->Kontrak_Tgl->Exportable) $Doc->ExportField($this->Kontrak_Tgl);
						if ($this->nasabah_id->Exportable) $Doc->ExportField($this->nasabah_id);
						if ($this->jaminan_id->Exportable) $Doc->ExportField($this->jaminan_id);
						if ($this->Pinjaman->Exportable) $Doc->ExportField($this->Pinjaman);
						if ($this->Angsuran_Lama->Exportable) $Doc->ExportField($this->Angsuran_Lama);
						if ($this->Angsuran_Bunga_Prosen->Exportable) $Doc->ExportField($this->Angsuran_Bunga_Prosen);
						if ($this->Angsuran_Denda->Exportable) $Doc->ExportField($this->Angsuran_Denda);
						if ($this->Dispensasi_Denda->Exportable) $Doc->ExportField($this->Dispensasi_Denda);
						if ($this->Angsuran_Pokok->Exportable) $Doc->ExportField($this->Angsuran_Pokok);
						if ($this->Angsuran_Bunga->Exportable) $Doc->ExportField($this->Angsuran_Bunga);
						if ($this->Angsuran_Total->Exportable) $Doc->ExportField($this->Angsuran_Total);
						if ($this->No_Ref->Exportable) $Doc->ExportField($this->No_Ref);
						if ($this->Biaya_Administrasi->Exportable) $Doc->ExportField($this->Biaya_Administrasi);
						if ($this->Biaya_Materai->Exportable) $Doc->ExportField($this->Biaya_Materai);
						if ($this->marketing_id->Exportable) $Doc->ExportField($this->marketing_id);
						if ($this->Periode->Exportable) $Doc->ExportField($this->Periode);
						if ($this->Macet->Exportable) $Doc->ExportField($this->Macet);
						if ($this->NasabahNama->Exportable) $Doc->ExportField($this->NasabahNama);
						if ($this->No_Telp_Hp->Exportable) $Doc->ExportField($this->No_Telp_Hp);
						if ($this->Pekerjaan->Exportable) $Doc->ExportField($this->Pekerjaan);
						if ($this->Pekerjaan_No_Telp_Hp->Exportable) $Doc->ExportField($this->Pekerjaan_No_Telp_Hp);
						if ($this->Status->Exportable) $Doc->ExportField($this->Status);
						if ($this->NasabahKeterangan->Exportable) $Doc->ExportField($this->NasabahKeterangan);
						if ($this->MarketingNama->Exportable) $Doc->ExportField($this->MarketingNama);
						if ($this->MarketingAlamat->Exportable) $Doc->ExportField($this->MarketingAlamat);
						if ($this->NoHP->Exportable) $Doc->ExportField($this->NoHP);
						if ($this->AkhirKontrak->Exportable) $Doc->ExportField($this->AkhirKontrak);
						if ($this->sudah_bayar->Exportable) $Doc->ExportField($this->sudah_bayar);
						if ($this->pd_Angsuran_Pokok->Exportable) $Doc->ExportField($this->pd_Angsuran_Pokok);
						if ($this->pd_Angsuran_Bunga->Exportable) $Doc->ExportField($this->pd_Angsuran_Bunga);
						if ($this->pd_Angsuran_Total->Exportable) $Doc->ExportField($this->pd_Angsuran_Total);
						if ($this->Tanggal_Bayar->Exportable) $Doc->ExportField($this->Tanggal_Bayar);
						if ($this->umur_tunggakan->Exportable) $Doc->ExportField($this->umur_tunggakan);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'v0302_pinjamanlap';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 'v0302_pinjamanlap';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['pinjaman_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 'v0302_pinjamanlap';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['pinjaman_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 'v0302_pinjamanlap';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['pinjaman_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
