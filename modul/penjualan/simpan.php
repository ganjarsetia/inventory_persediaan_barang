<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_hdt.php";

$table		="penjualan";

$kode		=$_POST['kode'];
$tgl		=jin_date_sql($_POST['tgl']);
$kode_brg	=$_POST['kode_brg'];
$jumlah		=$_POST['jumlah'];
$harga		=$_POST['harga'];
$user		=$_SESSION['namauser'];

//Cari stok barang
$stok_barang	= cari_stok_akhir($kode_brg);
if ($stok_barang>=$jumlah){
$sql = mysql_query("SELECT kode_jual,tgl_jual,kode_barang,jumlah_jual,harga_jual,username
				   FROM $table 
				   WHERE kode_jual= '$kode' AND kode_barang='$kode_brg'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET jumlah_jual	='$jumlah',
								harga_jual		='$harga'
					WHERE kode_jual= '$kode' AND kode_barang='$kode_brg'";
	mysql_query($input);								
	echo "Data Sukses diubah";
}else{
	$input = "INSERT INTO $table (kode_jual,tgl_jual,kode_barang,jumlah_jual,harga_jual,username)
				VALUES('$kode','$tgl','$kode_brg','$jumlah','$harga','$user')";
	mysql_query($input);
	echo "Data sukses disimpan.<br> Stok Barang : ".$stok_barang.". Jumlah jual : ".$jumlah;
}	
}else{
	echo "Maaf, Sisa Stok :".$stok_barang.", Stok Barang tidak mencukupi";
}
//echo "<br>".$input."<br/>";
?>