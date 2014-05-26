<?php
$tanggal	= $_POST['tgl'];
$exp 		= explode('-',$tanggal);
$tgl		= $exp[0].$exp[1].$exp[2];

$kode		= $_POST['kode'];
if (!empty($kode)){
	$data['kode_retur']	= $tgl.$kode;
	echo json_encode($data);
}else{
	$data['kode_retur']	= 'Kosong';
	echo json_encode($data);
}
?>