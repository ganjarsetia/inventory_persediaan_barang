<?php
include "../../inc/inc.koneksi.php";
$text	= "SELECT max(kode_jual) as no_akhir FROM penjualan";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
	$data=mysql_fetch_array($sql);	
		$no = $data['no_akhir'];
		$no_akhir = (int) substr($no, 3, 4);
		$no_akhir++;
		$kode = 'JL'. sprintf("%04s",$no_akhir);
		$data['nomor']	= $kode;
		echo json_encode($data);
}else{
	$data['nomor']	= 'JL0001';
	echo json_encode($data);
}

?>