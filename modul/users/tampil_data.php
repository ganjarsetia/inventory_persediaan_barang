<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $("#theList tr:even").addClass("stripe1");
        $("#theList tr:odd").addClass("stripe2");

        $("#theList tr").hover(
            function() {
                $(this).toggleClass("highlight");
            },
            function() {
                $(this).toggleClass("highlight");
            }
        );
    });	
});
	function edit_data(ID){
		//location.window();
		//window.location.href='media.php?module=supplier';
		var user = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/users/cari.php",
			data	: "user="+user,
			dataType	: "json",
			success	: function(data){
				$("#txt_user").val(user);
				$("#txt_pwd1").val(data.pwd1);
				$("#txt_pwd2").val(data.pwd2);
				$("#txt_nama").val(data.nama);
				//alert(data.level);
				if(data.level=='user') {
					$("#radio_user").attr("checked","checked");
				}else{
					$("#radio_admin").attr("checked","checked");
				}
				if(data.blokir=='Y') {
					$("#radio_y").attr("checked","checked");
				}else{
					$("#radio_n").attr("checked","checked");
				}
				$("#akses").val(data.akses);
				$("#info").html("Data sudah di tampung pada tab inputan, silahkan klik");
			}
		});
	}
	function hapus_data(ID){
		//location.window();
		//window.location.href='media.php?module=supplier';
		var pilih = confirm('Data yang akan dihapus kode = '+ID+ '?');
		if (pilih==true) {
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/users/hapus.php",
			data	: "kode="+kode,
			success	: function(data){
				$("#info").html(data);
				$("#tampil_data").load('modul/users/tampil_data.php');
				$("#akses").val('');
			}
		});
		}
	}

</script>
<?php
include '../../inc/inc.koneksi.php';
$blokir	= $_GET['blokir'];
$level	= $_GET['level'];
$cari	= $_GET['cari'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;
	if (!empty($blokir)){
		if($blokir=='all'){
			$query2	= "SELECT * FROM admins";
		}else{
			$query2	= "SELECT * FROM admins 
					WHERE blokir='$blokir'";
		}
	}else if(!empty($level)){
		if($level=='all'){
			$query2	= "SELECT * FROM admins";
		}else{
			$query2	= "SELECT * FROM admins 
					WHERE level='$level'";
		}		
	}else{
		$query2	= "SELECT * FROM admins 
				WHERE (username LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%')  ";	
	}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<table id='theList' width='100%'>
		<tr>
			<th width='2%'>No.</th>
			<th>User Name</th>
			<th>Nama Lengkap</th>
			<th>Level</th>
			<th>Blokir</th>
			<th>Login<br>Terakhir</th>
			<th>IP Address</th>
			<th>Aksi</th>
		</tr>";
	if (!empty($blokir)){
		if($blokir=='all'){
			$sql	= "SELECT * FROM admins ORDER BY username LIMIT $hal,$lim";
		}else{
			$sql	= "SELECT * FROM admins 
					WHERE blokir='$blokir'
					ORDER BY username
					LIMIT $hal,$lim";
		}
	}else if(!empty($level)){
		if($level=='all'){
			$sql	= "SELECT * FROM admins  ORDER BY username LIMIT $hal,$lim";
		}else{
			$sql	= "SELECT * FROM admins 
					WHERE level='$level'
					ORDER BY username
					LIMIT $hal,$lim";
		}		
	}else{
		$sql	= "SELECT * FROM admins 
				WHERE (username LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%')
				ORDER BY username
				LIMIT $hal,$lim";	
	}
						
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
			echo "<tr>
					<td align='center'>$no</td>
					<td>".$r_data['username']."</td>
					<td>".$r_data['nama_lengkap']."</td>
					<td>".$r_data['level']."</td>
					<td align='center' width='2%'>".$r_data['blokir']."</td>
					<td align='center'>".$r_data['lastlogin']."</td>
					<td align='center'>".$r_data['ipaddress']."</td>
					<td align='center'>
					<a href='javascript:void(0)' onClick=\"edit_data('".$r_data['username']."')\">
					<img src='icon/thumb_up.png' border='0' id='edit' title='Edit' width='12' height='12' >
					</a>
					<a href='javascript:void(0)' onClick=\"hapus_data('".$r_data['username']."')\">
					<img src='icon/thumb_down.png' border='0' id='hapus' title='Hapus' width='12' height='12' >
					</a>					
					</td>
					</tr>";
			$no++;
		}
		
	echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td>Jumlah Data : $jml</td>
			<td align='right'>Halaman :";
		if (!empty($blokir)){
			if($blokir=='all'){
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/users/tampil_data.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
			}else{
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/users/tampil_data.php?blokir=<?php echo $_GET['blokir'];?>&hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
			}
		}else if(!empty($level)){
			if($level=='all'){
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/users/tampil_data.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
			}else{
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/users/tampil_data.php?level=<?php echo $_GET['level'];?>&hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
			}		
		}else{
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/users/tampil_data.php?cari=<?php echo $_GET['cari'];?>&hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
		}

	echo "</td>
		</tr>
		</table>";
?>