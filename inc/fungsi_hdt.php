<?php
function sukses_masuk($username,$pass){
	// Apabila username dan password ditemukan
	$login=mysql_query("SELECT * FROM admins WHERE username='$username' AND password='$pass' AND blokir='N'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	if ($ketemu > 0){
	  session_start();
	  include "timeout.php";
	
		$_SESSION['namauser']     = $r['username'];
		$_SESSION['namalengkap']  = $r['nama_lengkap'];
		$_SESSION['passuser']     = $r['password'];
		$_SESSION['leveluser']    = $r['level'];
	
		// session timeout
		$_SESSION[login] = 1;
		timer();
		
		$ipaddress = empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP'];
	
		$sql	= "UPDATE admins SET lastlogin=now(),ipaddress='$ipaddress'  WHERE username='$username' AND password='$pass'";
		mysql_query($sql);
	
		header('location:media.php?module=home');
	}
	return false;
}

function msg(){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Username</b> dan <b>Password</b> Anda<br><br>Kesalahan ".$_SESSION[salah];
  echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
  return false;
}

function salah_blokir($username){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$username</b> telah <b>TERBLOKIR</b>, silahkan hubungi Administrator.";
  echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
  return false;
}
function salah_username($username){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$username</b> tidak dikenal.";
  echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";	
  return false;
}

function salah_password(){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Password</b> Anda<br><br>Kesalahan ".$_SESSION[salah];
  echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
   return false;
}

function blokir($username){
	$ipaddress = empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP'];
	$sql	= "UPDATE admins SET lastlogin=now(),ipaddress='$ipaddress',blokir='Y'  WHERE username='$username'";
	mysql_query($sql);		
	session_start();
	session_destroy();
	 return false;
}
function cari_stok_awal($kode) {
	$sql	= "SELECT kode_barang,stok_awal as jml FROM barang WHERE kode_barang='$kode'";
	$query	= mysql_query($sql);
	$row	= mysql_num_rows($query);
	if ($row>0){
		$data	= mysql_fetch_array($query);
		$hasil	= $data['jml'];
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function cari_jml_beli($kode){
	$sql	= "SELECT kode_barang,sum(jumlah_beli) as jml FROM pembelian WHERE kode_barang='$kode'";
	$query	= mysql_query($sql);
	$row	= mysql_num_rows($query);
	if ($row>0){
		$data	= mysql_fetch_array($query);
		$hasil	= $data['jml'];
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function cari_jml_jual($kode){
	$sql	= "SELECT kode_barang,sum(jumlah_jual) as jml FROM penjualan WHERE kode_barang='$kode'";
	$query	= mysql_query($sql);
	$row	= mysql_num_rows($query);
	if ($row>0){
		$data	= mysql_fetch_array($query);
		$hasil	= $data['jml'];
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function cari_stok_akhir($kode){
	$stok_awal	= cari_stok_awal($kode);
	$jml_beli = cari_jml_beli($kode);
	$jml_jual = cari_jml_jual($kode);
	
	$hasil	= ($stok_awal+$jml_beli)-$jml_jual;
	return $hasil;
}

?>