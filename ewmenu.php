<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(16, "mi_cf01_home_php", $Language->MenuPhrase("16", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(3, "mi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", -1, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t03_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(17, "mi_cf02_tutupbuku_php", $Language->MenuPhrase("17", "MenuText"), "cf02_tutupbuku.php", -1, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}cf02_tutupbuku.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10019, "mci_List", $Language->MenuPhrase("10019", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10018, "mri_r015fpinjaman", $Language->MenuPhrase("10018", "MenuText"), "r01_pinjamansmry.php", 10019, "{34C67914-04B8-4CBF-A6F8-355DA216289E}", AllowListMenu('{34C67914-04B8-4CBF-A6F8-355DA216289E}r01_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(10022, "mri_r025fjurnaltransaksi", $Language->MenuPhrase("10022", "MenuText"), "r02_jurnaltransaksismry.php", 10019, "{34C67914-04B8-4CBF-A6F8-355DA216289E}", AllowListMenu('{34C67914-04B8-4CBF-A6F8-355DA216289E}r02_jurnaltransaksi'), FALSE, FALSE);
$RootMenu->AddMenuItem(36, "mi_t99_audittrail", $Language->MenuPhrase("36", "MenuText"), "t99_audittraillist.php", 10019, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(35, "mci_Setup", $Language->MenuPhrase("35", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10052, "mi_t91_rekening", $Language->MenuPhrase("10052", "MenuText"), "t91_rekeninglist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t91_rekening'), FALSE, FALSE);
$RootMenu->AddMenuItem(10053, "mi_t90_rektran", $Language->MenuPhrase("10053", "MenuText"), "t90_rektranlist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t90_rektran'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t01_nasabah'), FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mi_t07_marketing", $Language->MenuPhrase("14", "MenuText"), "t07_marketinglist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t07_marketing'), FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mi_t93_periode", $Language->MenuPhrase("7", "MenuText"), "t93_periodelist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t93_periode'), FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mi_t96_employees", $Language->MenuPhrase("10", "MenuText"), "t96_employeeslist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mi_t97_userlevels", $Language->MenuPhrase("11", "MenuText"), "t97_userlevelslist.php", 35, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mi_t94_log", $Language->MenuPhrase("8", "MenuText"), "t94_loglist.php", 35, "", AllowListMenu('{C5FF1E3B-3DAB-4591-8A48-EB66171DE031}t94_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
