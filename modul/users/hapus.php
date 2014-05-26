<?php
include "../../inc/inc.koneksi.php";

$kode	= $_POST['kode'];

$sql = mysql_query("SELECT * FROM supplier WHERE kode_supplier= '$kode'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input = "DELETE FROM supplier WHERE kode_supplier= '$kode'";
	mysql_query($input);
	echo "Data Kode Suppllier : $kode sukses dihapus";
}else{
	echo "Maaf, tidak ada";
}
?>