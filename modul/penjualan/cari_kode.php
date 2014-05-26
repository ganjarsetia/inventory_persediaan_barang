<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$kode	= $_POST['kode'];
$text	= "SELECT *
			FROM penjualan WHERE kode_jual= '$kode' GROUP BY kode_jual";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	
	$data['tgl']	= jin_date_str($r['tgl_jual']);
	echo json_encode($data);
}
}else{
	$data['tgl']	= '';
	
	echo json_encode($data);
	
}

?>