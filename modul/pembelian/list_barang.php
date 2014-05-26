<?php
include "../../inc/inc.koneksi.php";

$q	= $_GET["q"];
if (!$q) return;

$sql	= mysql_query("SELECT * FROM barang WHERE kode_barang like '%$q%' OR nama_barang like '%$q%' ");
while($r=mysql_fetch_array($sql)){
	$kode = $r['kode_barang'];
	//$nama = $r['nama_barang'];
	echo "$kode\n";
	//echo $kode;
}
?>