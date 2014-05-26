<?php
include "../../inc/inc.koneksi.php";
$user	= $_POST['user'];
$text	= "SELECT *
			FROM admins WHERE username= '$user'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	
	$data['pwd1']	= $r['password'];
	$data['pwd2']	= $r['password'];
	$data['nama']	= $r['nama_lengkap'];
	$data['level']	= $r['level'];
	$data['blokir']	= $r['blokir'];
	$data['akses']	= 1;
	echo json_encode($data);
}
}else{
	$data['pwd1']	= '';
	$data['pwd2']	= '';
	$data['nama']	= '';
	$data['level']	= '';
	$data['blokir']	= '';
	$data['akses']	= '';
	
	echo json_encode($data);
	
}

?>