<style>
.panel-heading a{
  display:block;
}

.panel-heading a.collapsed {
  background: url(http://upload.wikimedia.org/wikipedia/commons/3/36/Vector_skin_right_arrow.png) center right no-repeat;
}

.panel-heading a {
  background: url(http://www.useragentman.com/blog/wp-content/themes/useragentman/images/widgets/downArrow.png) center right no-repeat;
}
</style>

<?php
	$db =& DbHelper(); // Create instance of the database helper class by DbHelper() (for main database) or DbHelper("<dbname>") (for linked databases) where <dbname> is database variable name
?>

<?php
if (isset($_GET["ok"])) {
	if ($_GET["ok"] == 1) {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">Tutup Buku</div>
			<div class="panel-body">
				<p>Proses Tutup Buku selesai !</p>
				<p>&nbsp;</p>
				<p><a href='cf02_tutupbukuproses.php'><button>Proses</button></a></p>
				<!--<table class='table table-striped table-bordered table-hover table-condensed'>
					<tr>
						<td>Proses Tutup Buku selesai !</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><a href='.'><button>Selesai</button></a></td>
					</tr>
				</table>-->
			</div>
		</div>
		<?php
	}
}
else {
?>
<div class="panel panel-default">
	<div class="panel-heading">Tutup Buku</div>
	<div class="panel-body">
		<p>Mohon periksa kembali data-data Anda !</p>
		<p>&nbsp;</p>
		<p><a href='cf02_tutupbukuproses.php'><button>Proses</button></a></p>
		<!-- <table class='table table-striped table-bordered table-hover table-condensed'>
			<tr>
				<td>Mohon periksa kembali data-data Anda !</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><a href='cf02_tutupbukuproses.php'><button>Proses</button></a></td>
			</tr>
		</table> -->
	</div>
</div>
<?php
}
?>