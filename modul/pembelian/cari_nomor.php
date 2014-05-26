<?php
include "../../inc/inc.koneksi.php";
$kode	= $_POST['kode'];
$text	= "SELECT max(kode_beli) as no_akhir FROM pembelian";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
	$data=mysql_fetch_array($sql);	
		//format kode beli BL0001
		$no = $data['no_akhir'];
		$no_akhir = (int) substr($no, 3, 4);
		
		$no_akhir++;
		//membuat format kode beli
		$kode_beli = 'BL'. sprintf("%04s",$no_akhir);
		
		$data['nomor']	= $kode_beli;
		
		echo json_encode($data);
}else{
	$data['nomor']	= 'BL0001';

	echo json_encode($data);
	
}

?>