<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$table		="retur_pembelian";

$kode_retur	=$_POST['kode_retur'];
$kode		=$_POST['kode'];
$tgl		=jin_date_sql($_POST['tgl']);
$jml		=$_POST['jml'];
$kode_brg	=$_POST['kode_brg'];

$query ="SELECT kode_retur,tgl_retur,kode_beli,kode_barang,jumlah_retur
				   FROM $table 
				   WHERE kode_retur= '$kode_retur' AND kode_beli= '$kode' AND kode_barang= '$kode_brg'";
$sql = mysql_query($query);
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET jumlah_retur	='$jml'
					WHERE kode_retur= '$kode_retur' AND kode_bei= '$kode' AND tgl_retur= '$tgl'";
	mysql_query($input);								
	echo "<label id='info'><b>Data Sukses diubah</b></label>";
}else{
	$input = "INSERT INTO $table (kode_retur,tgl_retur,kode_beli,kode_barang,jumlah_retur)
				VALUES('$kode_retur','$tgl','$kode','$kode_brg','$jml')";
	mysql_query($input);
	echo "<label id='info'><b>Data sukses disimpan</b></label>";
}	
//echo $query."<br>".$input."<br/>";
//include "tampil_data.php";

?>