<?php
include "../../inc/inc.koneksi.php";
$kode	= $_POST['kode'];
$text	= "SELECT *
			FROM barang WHERE kode_barang= '$kode'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	
	$data['kode_barang']	= $r['kode_barang'];
	$data['nama_barang']	= $r['nama_barang'];
	$data['satuan']			= $r['satuan'];
	$data['harga_beli']		= $r['harga_beli'];
	$data['harga_jual']		= $r['harga_jual'];
	$data['stok_awal']		= $r['stok_awal'];
	
	echo json_encode($data);
}
}else{
	$data['kode_barang']	= '';
	$data['nama_barang']	= '';
	$data['satuan']			= '';
	$data['harga_beli']		= '';
	$data['harga_jual']		= '';
	$data['stok_awal']		= '';

	echo json_encode($data);
	
}

?>