<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style type="text/css">
@media print, handheld {
	background:white;
	color : black;
}
@page figures {
	size:landscape;
}
body {
	font-size:14px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-transform:uppercase;
}
table {
  border-collapse : collapse; 
}
#kiri {
	float:left;
	width:35%;
	border:dashed 1px;
	padding: 6px 6px 6px 6px;
	margin-bottom:10px;
}
#kanan {
	float:right;
	width:35%;
	border:dashed 1px;
	margin-right:350px;
	padding: 6px 6px 6px 6px;	
	margin-bottom:10px;
}
#theList th,td {
	/* font-family: Verdana, Arial, Helvetica, sans-serif; */
	color: #000000;
	padding-left     : 8px;
	padding-right    : 8px;
	padding-top      : 3px;
	padding-bottom   : 3px;
	border           : 0.5px solid #000000;

}
#theList th {
	background-color:#D2E0E8;
	color:#003366
}
#isian td {
	border:none; 
	font-size:13px;
	font-family: "lucida grande", Tahoma, verdana, arial, sans-serif;
}

</style>

<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_tanggal.php";
?>

</head>
<body >

<?php
//onload="window.print()" onfocus="window.close()"

$ruang	= $_POST[ruang];
$palok	= $_POST[palok];
$jur	= $_POST[jurusan];
			
//$palok		= $_GET['panlok'];
//$jurusan	= $_GET['jur'];

$judul 	= 'Peserta PMB';
$mod	= 'pendaftar';
$table	= 'pmb';
?>
<!--
<div align="center">LAPORAN PENDAFTAR PER KELOMPOK</div>
<div align="center">UJIAN MASUK MANDIRI TAHUN 2011</div>
-->
<?php	
$sql ="SELECT * FROM pmb 
		WHERE ruangujian ='$ruang' AND lokasi = '$palok' AND kelompok = '$jur' 
		ORDER BY noujian
		LIMIT 20";

$data=mysql_query($sql);

$i = 1;
while($r = mysql_fetch_array($data)){

if ($i % 2== 1) {
	echo "<div id='kiri'>
		<table>
		<tr><td width='35%'>Nomor Peserta</td><td width='2%'>:</td><td>$r[noujian]</td></tr>
		<tr><td >Nama Peserta</td><td width='2%'>:</td><td>$r[nama]</td></tr>
		<tr><td >Kelompok</td><td width='2%'>:</td><td>$r[kelompok]</td></tr>
		<tr><td >Ruang</td><td width='2%'>:</td><td>$r[ruangujian]</td></tr>
		</table>";
		if ($r[foto]=='') {
			$foto = '../../../peserta/foto/no_pic.jpg';
		}else{
			$foto = '../../../peserta/foto/'.$r[foto];
		}
		echo "&nbsp;&nbsp;&nbsp;<img src=$foto width='120px' height='180px'>";
		echo "</div>";			
}else{
	echo "<div id='kanan'>
		<table>
		<tr><td width='35%'>Nomor Peserta</td><td width='2%'>:</td><td>$r[noujian]</td></tr>
		<tr><td >Nama Peserta</td><td width='2%'>:</td><td>$r[nama]</td></tr>
		<tr><td >Kelompok</td><td width='2%'>:</td><td>$r[kelompok]</td></tr>
		<tr><td >Ruang</td><td width='2%'>:</td><td>$r[ruangujian]</td></tr>
		</table>";
		if ($r[foto]=='') {
			$foto = '../../../peserta/foto/no_pic.jpg';
		}else{
			$foto = '../../../peserta/foto/'.$r[foto];
		}
		echo "&nbsp;&nbsp;&nbsp;<img src=$foto width='120px' height='180px'>";
		echo"</div>";
}

//if ($i % 2== 1) {
//	echo "<tr><td width='10%'>Nama Peserta</td><td width='2%'>:</td><td>$r[nama]</td>";			
//}else{
//	echo "<td width='10%'>Nama Peserta</td><td width='2%'>:</td><td>$r[nama]</td></tr>";
//}
?>



<?php
$i++;
}
//echo $sql;
?>
</body>
</html>
<!--
<img src="../../../mahasiswa/foto_mhs/01411343.jpg">
-->
