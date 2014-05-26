<?php
include "../../inc/inc.koneksi.php";

$table		="admins";

$user		=str_replace("'","\'",$_POST['user']);
$pwd		=md5($_POST['pwd1']);
$nama		=str_replace("'","\'",$_POST['nama']);
$level		=$_POST['level'];
$blokir		=$_POST['blokir'];

$sql = mysql_query("SELECT username,password,nama_lengkap,level,blokir
				   FROM $table 
				   WHERE username= '$user'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET password		='$pwd',
								nama_lengkap	='$nama',
								level	='$level',
								blokir	='$blokir',
								lastupdate	= now()
					WHERE username= '$user'";
	mysql_query($input);								
	echo "Data Sukses diubah, begitu juga dengan Password Anda.";
}else{
	$input = "INSERT INTO $table (username,password,nama_lengkap,level,blokir,create)
				VALUES('$user','$pwd','$nama','$level','$blokir',now())";
	mysql_query($input);
	echo "Data sukses disimpan";
}	
//echo "<br>".$input."<br/>";
?>