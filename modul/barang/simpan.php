<?php
include "../../inc/inc.koneksi.php";
//include '../../inc/cek_session.php';

$table		="barang";

$kode_barang	=$_POST['kode_barang'];
$nama_barang	=str_replace("'","\'",$_POST['nama_barang']);
$satuan			=$_POST['satuan'];
$harga_beli		=$_POST['harga_beli'];
$harga_jual		=$_POST['harga_jual'];
$stok_awal		=$_POST['stok_awal'];


$sql = mysql_query("SELECT kode_barang,nama_barang,satuan,
				   harga_beli,harga_jual,stok_awal
				   FROM $table 
				   WHERE kode_barang= '$kode_barang'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET nama_barang	='$nama_barang',
								satuan		='$satuan',
								harga_beli	='$harga_beli',
								harga_jual	='$harga_jual',
								stok_awal	='$stok_awal'
					WHERE kode_barang= '$kode_barang'";
	mysql_query($input);								
	echo "<label id='info'><b>Data Sukses diubah</b></label>";
}else{
	$input = "INSERT INTO $table (kode_barang,nama_barang,satuan,
								  harga_beli,harga_jual,stok_awal)
				VALUES('$kode_barang','$nama_barang','$satuan',
					   '$harga_beli','$harga_jual','$stok_awal')";
	mysql_query($input);
	echo "<label id='info'><b>Data sukses disimpan</b></label>";
}	
//echo $input."<br/>";
include "tampil_data.php";

?>