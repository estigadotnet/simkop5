<?php
// hapus t87_neraca
$q = "delete from t87_neraca";
Conn()->Execute($q);

$q = "select * from t91_rekening where id = '1'";
$r = Conn()->Execute($q);

$q = "select * from t91_rekening where left(parent, 1) = '1' and tipe = 'DETAIL' order by id";
$rdet = Conn()->Execute($q);

$q = "select * from t91_rekening where id = '2'";
$r3 = Conn()->Execute($q);

$q = "select * from t91_rekening where left(parent, 1) = '2' and tipe = 'DETAIL' order by id";
$rdet3 = Conn()->Execute($q);
?>

<div class="panel panel-default">
	<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#neraca">Neraca Periode <?php echo $GLOBALS["Periode"]; ?></a></strong></div>
	<div id="neraca" class="panel-collapse collapse in">
		<div class="panel-body">
			<div>
				<table class='table table-striped table-hover table-condensed'>
					<tbody>

					<!-- id 1 -->
					<?php while (!$r->EOF) { ?>
					<tr>
						<td><strong><?php echo $r->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
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
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('".$rdet->fields["id"]."', '".$rdet->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet->MoveNext(); ?>
					<?php } ?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal, 2)."</strong>')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>

					<!-- id 2 -->
					<?php while (!$r3->EOF) { ?>
					<tr>
						<td><strong><?php echo $r3->fields["rekening"]; ?></strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('<strong>".$r3->fields["rekening"]."</strong>', '', '')"; Conn()->Execute($q);?>
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
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('".$rdet3->fields["id"]."', '".$rdet3->fields["rekening"]."', '".number_format($nilai, 2)."')"; Conn()->Execute($q);?>
					<?php   $rdet3->MoveNext(); ?>
					<?php } ?>


					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal2, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '')"; Conn()->Execute($q);?>

					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right"><strong><?php echo number_format($mtotal - $mtotal2, 2); ?></strong></td>
					</tr>
					<?php   $q = "insert into t87_neraca (field01, field02, field03) values ('', '', '<strong>".number_format($mtotal - $mtotal2, 2)."</strong>')"; Conn()->Execute($q);?>

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
<?php header("Location: t87_neracalist.php"); ?>