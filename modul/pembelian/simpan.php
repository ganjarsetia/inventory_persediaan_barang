<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$table		="pembelian";

$kode		=$_POST['kode'];
$tgl		=jin_date_sql($_POST['tgl']);
$supplier	=$_POST['supplier'];
$kode_barang=$_POST['kode_barang'];
$jumlah		=$_POST['jumlah'];
$harga		=$_POST['harga'];

$sql = mysql_query("SELECT kode_beli,tgl_beli,kode_supplier,kode_barang,jumlah_beli,harga_beli
				   FROM $table 
				   WHERE kode_beli= '$kode' AND kode_supplier='$supplier' AND kode_barang='$kode_barang'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET jumlah_beli	=$jumlah,
								harga_beli		=$harga,
								tgl_beli		='$tgl'
					WHERE kode_beli= '$kode' AND kode_supplier='$supplier' AND kode_barang='$kode_barang'";
	mysql_query($input);								
	echo "<label id='info'><b>Data Sukses diubah</b></label>";
}else{
	$input = "INSERT INTO $table (kode_beli,tgl_beli,kode_supplier,kode_barang,jumlah_beli,harga_beli)
				VALUES('$kode','$tgl','$supplier',
					   '$kode_barang','$jumlah','$harga')";
	mysql_query($input);
	echo "<label id='info'><b>Data sukses disimpan</b></label>";
}	
//echo $input."<br/>";
include "tampil_data.php";
?>