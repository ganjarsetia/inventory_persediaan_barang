<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$tgl	= jin_date_sql($_POST["tgl"]);

$sql	= mysql_query("SELECT * FROM pembelian WHERE tgl_beli='$tgl' GROUP BY kode_beli");
while($r=mysql_fetch_array($sql)){
	$kode = $r['kode_beli'];
	echo "<option value='$kode'>$kode</option>";
}
?>