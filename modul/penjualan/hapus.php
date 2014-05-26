<?php
include "../../inc/inc.koneksi.php";

$kode	= $_POST['kode'];
$exp	= explode("-",$kode);
$kode_jual	= $exp[0];
$kode_brg	= $exp[1];

$sql = mysql_query("SELECT * FROM penjualan 
				   WHERE kode_jual= '$kode_jual' AND kode_barang='$kode_brg'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input = "DELETE FROM penjualan
			WHERE kode_jual= '$kode_jual' AND kode_barang='$kode_brg'";
	mysql_query($input);
	echo "Data Kode Jual : $kode_jual dan Kode Barang : $kode_brg sukses dihapus";
}else{
	echo "Maaf, tidak ada";
}
?>