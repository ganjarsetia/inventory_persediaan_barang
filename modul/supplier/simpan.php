<?php
include "../../inc/inc.koneksi.php";

$table		="supplier";

$kode		=$_POST['kode'];
$nama		=str_replace("'","\'",$_POST['nama']);
$alamat		=$_POST['alamat'];

$sql = mysql_query("SELECT kode_supplier,nama_supplier,alamat
				   FROM $table 
				   WHERE kode_supplier= '$kode'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET nama_supplier	='$nama',
								alamat		='$alamat'
					WHERE kode_supplier= '$kode'";
	mysql_query($input);								
	echo "Data Sukses diubah";
}else{
	$input = "INSERT INTO $table (kode_supplier,nama_supplier,alamat)
				VALUES('$kode','$nama','$alamat')";
	mysql_query($input);
	echo "Data sukses disimpan";
}	
//echo "<br>".$input."<br/>";
?>