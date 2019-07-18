<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LapDeposito.xls");

echo $_POST["data"];
?>
