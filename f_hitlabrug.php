<?php

// hapus t88_labarugi
$q = "delete from t88_labarugi";
Conn()->Execute($q);

$q = "select * from t91_rekening where id = '3'";
$r = Conn()->Execute($q);

$q = "select * from t91_rekening where parent = '3' and tipe = 'DETAIL' order by id";
$rdet = Conn()->Execute($q);

$q = "select * from t91_rekening where id = '5'";
$r2 = Conn()->Execute($q);

$q = "select * from t91_rekening where parent = '5' and tipe = 'DETAIL' order by id";
$rdet2 = Conn()->Execute($q);

$q = "select * from t91_rekening where id = '4'";
$r3 = Conn()->Execute($q);

$q = "select * from t91_rekening where parent = '4' and tipe = 'DETAIL' order by id";
$rdet3 = Conn()->Execute($q);

$q = "select * from t91_rekening where id = '6'";
$r4 = Conn()->Execute($q);

$q = "select * from t91_rekening where parent = '6' and tipe = 'DETAIL' order by id";
$rdet4 = Conn()->Execute($q);
?>

<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#labarugi">Laba Rugi Periode <?php echo $GLOBALS["Periode"]; ?></a></strong></div>
	<div id="labarugi" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>

					<!-- id 3 -->
					<?php while (!$r->EOF) { ?>
					<tr>
						<td><strong><?php echo $r->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('<strong>".$r->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
					<?php   $r->MoveNext(); ?>
					<?php } ?>

					<?php $mtotal = 0;?>
					<?php while (!$rdet->EOF) { ?>
					<?php
							$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
								Rekening = '".$rdet->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal += $nilai;
					?>
					<tr>
						<td><?php echo $rdet->fields["id"]; ?></td>
						<td><?php echo $rdet->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('".$rdet->fields["id"]."', '".$rdet->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet->MoveNext(); ?>
					<?php } ?>


					<!-- id 5 -->
					<?php while (!$r2->EOF) { ?>
					<tr>
						<td><strong><?php echo $r2->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('<strong>".$r2->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
					<?php   $r2->MoveNext(); ?>
					<?php } ?>

					<?php while (!$rdet2->EOF) { ?>
					<?php
							$q = "select sum(Kredit) - sum(Debet) as Nilai from t10_jurnal where
								Rekening = '".$rdet2->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal += $nilai;
					?>
					<tr>
						<td><?php echo $rdet2->fields["id"]; ?></td>
						<td><?php echo $rdet2->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('".$rdet2->fields["id"]."', '".$rdet2->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet2->MoveNext(); ?>
					<?php } ?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>

					<!-- id 4 -->
					<?php while (!$r3->EOF) { ?>
					<tr>
						<td><strong><?php echo $r3->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('<strong>".$r3->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
					<?php   $r3->MoveNext(); ?>
					<?php } ?>

					<?php $mtotal2 = 0;?>
					<?php while (!$rdet3->EOF) { ?>
					<?php
							$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
								Rekening = '".$rdet3->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal2 += $nilai;
					?>
					<tr>
						<td><?php echo $rdet3->fields["id"]; ?></td>
						<td><?php echo $rdet3->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('".$rdet3->fields["id"]."', '".$rdet3->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet3->MoveNext(); ?>
					<?php } ?>


					<!-- id 6 -->
					<?php while (!$r4->EOF) { ?>
					<tr>
						<td><strong><?php echo $r4->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('<strong>".$r4->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
					<?php   $r4->MoveNext(); ?>
					<?php } ?>

					<?php while (!$rdet4->EOF) { ?>
					<?php
							$q = "select sum(Debet) - sum(Kredit) as Nilai from t10_jurnal where
								Rekening = '".$rdet4->fields["id"]."'
								and Periode = '".$GLOBALS["Periode"]."'";
							$rhasil = Conn()->Execute($q);
							$nilai = $rhasil->fields["Nilai"] == null ? 0 : $rhasil->fields["Nilai"];
							$mtotal2 += $nilai;
					?>
					<tr>
						<td><?php echo $rdet4->fields["id"]; ?></td>
						<td><?php echo $rdet4->fields["rekening"]; ?></td>
						<td align="right"><?php echo number_format($nilai, 2); ?></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('".$rdet4->fields["id"]."', '".$rdet4->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet4->MoveNext(); ?>
					<?php } ?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal2, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal - $mtotal2, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t88_labarugi (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php //header("Location: r05_labarugismry.php"); ?>
<?php header("Location: t88_labarugilist.php"); ?>