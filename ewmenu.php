<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(16, "mi_cf01_home_php", $Language->MenuPhrase("16", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10451, "mci_Accounting", $Language->MenuPhrase("10451", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10335, "mci_Setup", $Language->MenuPhrase("10335", "MenuText"), "", 10451, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(7, "mi_t93_periode", $Language->MenuPhrase("7", "MenuText"), "t93_periodelist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode'), FALSE, FALSE);
$RootMenu->AddMenuItem(10052, "mi_t91_rekening", $Language->MenuPhrase("10052", "MenuText"), "t91_rekeninglist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t91_rekening'), FALSE, FALSE);
$RootMenu->AddMenuItem(10056, "mi_t89_rektran", $Language->MenuPhrase("10056", "MenuText"), "t89_rektranlist.php", 10335, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t89_rektran'), FALSE, FALSE);
$RootMenu->AddMenuItem(10336, "mci_Transaksi", $Language->MenuPhrase("10336", "MenuText"), "", 10451, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10164, "mi_t11_jurnalmaster", $Language->MenuPhrase("10164", "MenuText"), "t11_jurnalmasterlist.php", 10336, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t11_jurnalmaster'), FALSE, FALSE);
$RootMenu->AddMenuItem(17, "mi_cf02_tutupbuku_php", $Language->MenuPhrase("17", "MenuText"), "cf02_tutupbuku.php", 10336, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10337, "mci_Laporan", $Language->MenuPhrase("10337", "MenuText"), "", 10451, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10551, "mi_cf31_jurnal_php", $Language->MenuPhrase("10551", "MenuText"), "cf31_jurnal.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf31_jurnal.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10552, "mi_cf32_bukubesar_php", $Language->MenuPhrase("10552", "MenuText"), "cf32_bukubesar.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf32_bukubesar.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10555, "mi_cf35_neracasaldo_php", $Language->MenuPhrase("10555", "MenuText"), "cf35_neracasaldo.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf35_neracasaldo.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10553, "mi_cf33_labarugi_php", $Language->MenuPhrase("10553", "MenuText"), "cf33_labarugi.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf33_labarugi.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10554, "mi_cf34_neraca_php", $Language->MenuPhrase("10554", "MenuText"), "cf34_neraca.php", 10337, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf34_neraca.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10334, "mci_Koperasi", $Language->MenuPhrase("10334", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(35, "mci_Setup", $Language->MenuPhrase("35", "MenuText"), "", 10334, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mi_t07_marketing", $Language->MenuPhrase("14", "MenuText"), "t07_marketinglist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah'), FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", 10334, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(10772, "mi_cf42_pinjaman_php", $Language->MenuPhrase("10772", "MenuText"), "cf42_pinjaman.php", 10334, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf42_pinjaman.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10768, "mci_Deposito", $Language->MenuPhrase("10768", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10852, "mci_Nasabah", $Language->MenuPhrase("10852", "MenuText"), "t01_nasabahlist.php", 10768, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10655, "mi_t20_deposito", $Language->MenuPhrase("10655", "MenuText"), "t20_depositolist.php", 10768, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t20_deposito'), FALSE, FALSE);
$RootMenu->AddMenuItem(10853, "mi_cf43_deposito_php", $Language->MenuPhrase("10853", "MenuText"), "cf43_deposito.php", 10768, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf43_deposito.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10338, "mci_General", $Language->MenuPhrase("10338", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10358, "mi_t75_company", $Language->MenuPhrase("10358", "MenuText"), "t75_companylist.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t75_company'), FALSE, FALSE);
$RootMenu->AddMenuItem(10359, "mi_cf14_backup_php", $Language->MenuPhrase("10359", "MenuText"), "cf14_backup.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf14_backup.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10452, "mi_cf15_restore_php", $Language->MenuPhrase("10452", "MenuText"), "cf15_restore.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf15_restore.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10, "mi_t96_employees", $Language->MenuPhrase("10", "MenuText"), "t96_employeeslist.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mi_t97_userlevels", $Language->MenuPhrase("11", "MenuText"), "t97_userlevelslist.php", 10338, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(36, "mi_t99_audittrail", $Language->MenuPhrase("36", "MenuText"), "t99_audittraillist.php", 10338, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
