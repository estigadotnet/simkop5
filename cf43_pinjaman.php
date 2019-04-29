<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LapPinjaman.xls");

echo $_POST["data"];
?>
