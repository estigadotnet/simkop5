<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, "mmi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mmi_t07_marketing", $Language->MenuPhrase("14", "MenuText"), "t07_marketinglist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mmi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mmi_t93_periode", $Language->MenuPhrase("7", "MenuText"), "t93_periodelist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mmi_t94_log", $Language->MenuPhrase("8", "MenuText"), "t94_loglist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(9, "mmi_t95_logdesc", $Language->MenuPhrase("9", "MenuText"), "t95_logdesclist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mmi_t96_employees", $Language->MenuPhrase("10", "MenuText"), "t96_employeeslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mmi_t97_userlevels", $Language->MenuPhrase("11", "MenuText"), "t97_userlevelslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mmi_t98_userlevelpermissions", $Language->MenuPhrase("12", "MenuText"), "t98_userlevelpermissionslist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(13, "mmi_t99_audittrail", $Language->MenuPhrase("13", "MenuText"), "t99_audittraillist.php", -1, "", TRUE, FALSE, FALSE);
$RootMenu->Render();
?>
<!-- End Main Menu -->
