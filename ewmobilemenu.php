<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(16, "mmi_cf01_home_php", $Language->MenuPhrase("16", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10333, "mmci_Accounting", $Language->MenuPhrase("10333", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10335, "mmci_Setup", $Language->MenuPhrase("10335", "MenuText"), "", 10333, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(7, "mmi_t93_periode", $Language->MenuPhrase("7", "MenuText"), "t93_periodelist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode'), FALSE, FALSE);
$RootMenu->AddMenuItem(10052, "mmi_t91_rekening", $Language->MenuPhrase("10052", "MenuText"), "t91_rekeninglist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t91_rekening'), FALSE, FALSE);
$RootMenu->AddMenuItem(10056, "mmi_t89_rektran", $Language->MenuPhrase("10056", "MenuText"), "t89_rektranlist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t89_rektran'), FALSE, FALSE);
$RootMenu->AddMenuItem(10336, "mmci_Transaksi", $Language->MenuPhrase("10336", "MenuText"), "", 10333, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10058, "mmi_t10_jurnal", $Language->MenuPhrase("10058", "MenuText"), "t10_jurnallist.php", 10336, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t10_jurnal'), FALSE, FALSE);
$RootMenu->AddMenuItem(10164, "mmi_t11_jurnalmaster", $Language->MenuPhrase("10164", "MenuText"), "t11_jurnalmasterlist.php", 10336, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t11_jurnalmaster'), FALSE, FALSE);
$RootMenu->AddMenuItem(17, "mmi_cf02_tutupbuku_php", $Language->MenuPhrase("17", "MenuText"), "cf02_tutupbuku.php", 10336, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10337, "mmci_Laporan", $Language->MenuPhrase("10337", "MenuText"), "", 10333, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10187, "mmi_cf11_jurnal_php", $Language->MenuPhrase("10187", "MenuText"), "cf11_jurnal.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf11_jurnal.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10185, "mmi_cf10_bukubesar_php", $Language->MenuPhrase("10185", "MenuText"), "cf10_bukubesar.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf10_bukubesar.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10168, "mmi_cf05_labarugi_php", $Language->MenuPhrase("10168", "MenuText"), "cf05_labarugi.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf05_labarugi.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10342, "mmi_cf12_labarugi_php", $Language->MenuPhrase("10342", "MenuText"), "cf12_labarugi.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf12_labarugi.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10173, "mmi_cf07_neraca_php", $Language->MenuPhrase("10173", "MenuText"), "cf07_neraca.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf07_neraca.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10334, "mmci_Koperasi", $Language->MenuPhrase("10334", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(35, "mmci_Setup", $Language->MenuPhrase("35", "MenuText"), "", 10334, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mmi_t07_marketing", $Language->MenuPhrase("14", "MenuText"), "t07_marketinglist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mmi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah'), FALSE, FALSE);
$RootMenu->AddMenuItem(10265, "mmci_Transaksi", $Language->MenuPhrase("10265", "MenuText"), "", 10334, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(3, "mmi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", 10265, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(10113, "mmci_Laporan", $Language->MenuPhrase("10113", "MenuText"), "", 10334, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10018, "mmri_r015fpinjaman", $Language->MenuPhrase("10018", "MenuText"), "r01_pinjamansmry.php", 10113, "{34C67914-04B8-4CBF-A6F8-355DA216289E}", AllowListMenu('{34C67914-04B8-4CBF-A6F8-355DA216289E}r01_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(10338, "mmci_General", $Language->MenuPhrase("10338", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10, "mmi_t96_employees", $Language->MenuPhrase("10", "MenuText"), "t96_employeeslist.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mmi_t97_userlevels", $Language->MenuPhrase("11", "MenuText"), "t97_userlevelslist.php", 10338, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(36, "mmi_t99_audittrail", $Language->MenuPhrase("36", "MenuText"), "t99_audittraillist.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
