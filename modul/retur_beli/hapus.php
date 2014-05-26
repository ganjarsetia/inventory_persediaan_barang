<?php
include "../../inc/inc.koneksi.php";

$kode	= $_POST['kode_barang'];

$sql = mysql_query("SELECT * FROM barang WHERE kode_barang= '$kode'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input = "DELETE FROM barang WHERE kode_barang= '$kode'";
	mysql_query($input);
	echo "<label id='info'>Data sukses dihapus</label>";
}else{
	echo "<label id='info'>Maaf, tidak ada</label>";
}

include "tampil_data.php";
?>