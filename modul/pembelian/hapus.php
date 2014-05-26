<?php
include "../../inc/inc.koneksi.php";

$kode	= $_POST['kode'];
$id		= $_POST['id'];

$query	= "SELECT CONCAT(kode_beli,kode_supplier,kode_barang) as kode 
					FROM pembelian 
					WHERE CONCAT(kode_beli,kode_supplier,kode_barang)= '$id'";
$sql 	= mysql_query($query);
$row	= mysql_num_rows($sql);
if ($row>0){
	$input = "DELETE FROM pembelian  WHERE CONCAT(kode_beli,kode_supplier,kode_barang)= '$id'";
	mysql_query($input);
	echo "<label id='info'>Data sukses dihapus</label>";
}else{
	echo "<label id='info'>Maaf, tidak ada</label>";
}
//echo $query."<br>".$input;
include "tampil_data.php";
?>