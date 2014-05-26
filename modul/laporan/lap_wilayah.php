<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style type="text/css">
body {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
}
table {
  border-collapse : collapse; 
}
#theList th,td {
	/* font-family: Verdana, Arial, Helvetica, sans-serif; */
	font-family: "lucida grande", Tahoma, verdana, arial, sans-serif;
	font-size: 11px;
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

	
$prop	= $_GET['prop'];
$kota	= $_GET['kota'];

$judul 	= 'Peserta PMB';
$mod	= 'pendaftar';
$table	= 'pmb';

$sql_prop = mysql_fetch_array(mysql_query("SELECT * FROM propinsi WHERE propinsi_id='$prop'"));
$r_prop = $sql_prop['propinsi'];

$sql_kota = mysql_fetch_array(mysql_query("SELECT * FROM kota_kabupaten WHERE propinsi_id='$prop' AND kota_id='$kota'"));
$r_kota = $sql_kota['kota_kabupaten'];

?>
<div align="center">LAPORAN PENDAFTAR PER WILAYAH</div>
<div align="center">UJIAN MASUK MANDIRI TAHUN 2011</div><br />

<table id="isian" border="0">
	<tr>
    	<td width="30">Propinsi</td>
        <td width="2">:</td>
        <td><?php echo $r_prop; ?></td>
	</tr>
	<tr>
    	<td>Kota</td>
        <td>:</td>
        <td><?php echo $r_kota; ?></td>
	</tr>
</table>    
<table id="theList">
<tr>
    <th align=center>No</th>
    <th align=center>Nomor <br>Peserta</th>
    <th align=center>Ruang <br>Ujian</th>
    <th align=center>Nama Peserta</th>
    <th align=center>Tempat,Tgl Lahir</th>
    <th align=center>L/P</th>
    <th align=center>Prodi Pilihan I </th>
    <th align=center>Prodi Pilihan II </th>
</tr>
<?php	
$sql ="SELECT nodaftar,noujian,nama,tempatlhr,tgllhr,jk,provinsi,kota,thijazah,pilihjurusan1,pilihjurusan2,kelompok,ruangujian,lokasi
				  FROM pmb
				  WHERE provinsi='$prop' AND kota='$kota'
				  ORDER BY noujian";

$data=mysql_query($sql);
$i = $posisi+1;
while($r = mysql_fetch_array($data)){
$tgl	= jin_date_str($r['tgllhr']);

$cari_jur	= mysql_fetch_array(mysql_query("SELECT id_prodi,program_studi FROM kodeprodi WHERE id_prodi='".$r['pilihjurusan1']."'"));
$jur	= $cari_jur['program_studi'];

$cari_jur2	= mysql_fetch_array(mysql_query("SELECT id_prodi,program_studi FROM kodeprodi WHERE id_prodi='".$r['pilihjurusan2']."'"));
$jur2	= $cari_jur2['program_studi'];

?>
<tr>
    <td align=center><?php echo $i; ?></td>
    <td align=center><?php echo $r['noujian']; ?></td>
    <td align=center><?php echo $r['ruangujian']; ?></td>
    <td width="180" ><?php echo $r['nama']; ?></td>
    <td><?php echo $r['tempatlhr'].','.$tgl; ?></td>
    <td align=center><?php echo $r['jk']; ?></td>    
    <td ><?php echo $r['kelompok'].'-'. $jur; ?></td>
    <td ><?php echo $r['kelompok'].'-'. $jur2; ?></td>    
</tr>
<?php
$i++;
}
//echo $sql;
?>
</table>
</body>
</html>
<!--
<img src="../../../mahasiswa/foto_mhs/01411343.jpg">
-->