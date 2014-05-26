<?php
include "../../inc/inc.koneksi.php";
$kode	= $_POST['kode'];
$text	= "SELECT *
			FROM supplier WHERE kode_supplier= '$kode'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	
	$data['nama']	= $r['nama_supplier'];
	$data['alamat']	= $r['alamat'];
	$data['akses']	= 1;
	echo json_encode($data);
}
}else{
	$data['nama']	= '';
	$data['alamat']	= '';
	$data['akses']	= '';
	
	echo json_encode($data);
	
}

?>