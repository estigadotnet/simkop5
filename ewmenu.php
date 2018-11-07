<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, "mi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mi_t07_marketing", $Language->MenuPhrase("14", "MenuText"), "t07_marketinglist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mi_t93_periode", $Language->MenuPhrase("7", "MenuText"), "t93_periodelist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mi_t94_log", $Language->MenuPhrase("8", "MenuText"), "t94_loglist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(9, "mi_t95_logdesc", $Language->MenuPhrase("9", "MenuText"), "t95_logdesclist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mi_t96_employees", $Language->MenuPhrase("10", "MenuText"), "t96_employeeslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mi_t97_userlevels", $Language->MenuPhrase("11", "MenuText"), "t97_userlevelslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mi_t98_userlevelpermissions", $Language->MenuPhrase("12", "MenuText"), "t98_userlevelpermissionslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(13, "mi_t99_audittrail", $Language->MenuPhrase("13", "MenuText"), "t99_audittraillist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->Render();
?>
<!-- End Main Menu -->
