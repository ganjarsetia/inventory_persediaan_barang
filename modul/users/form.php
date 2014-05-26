<script type="text/javascript">
$(document).ready(function() {
							   
	$("#radio_admin").attr("checked","checked");
	$("#radio_n").attr("checked","checked");
	$("#txt_user").focus();
		
	$("#tambah").click(function(){
		/*				*/				
		$(".input").val('');
		$(".input").val('');
		$(".radio_level").attr("checked","");
		$(".radio_blokir").attr("checked","");
		$("#txt_user").focus();

		/*
		var blok = $(".radio_blokir:checked").val();
		alert(blok);
		*/
	});
	
	$("#txt_user").keyup(function() {
		var user 	= $("#txt_user").val()
		//var akses	= 1; //1 cari, 2 edit, 3 baru
		$.ajax({
			type	: "POST",
			url		: "modul/users/cari.php",
			data	: "user="+user,
			dataType	: "json",
			success	: function(data){
				$("#txt_pwd1").val(data.pwd1);
				$("#txt_pwd2").val(data.pwd2);
				$("#txt_nama").val(data.nama);
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
				//$("#data").load('modul/supplier/tampil_data.php');
			}
		});
	});
	
	$("#simpan").click(function(){
	var akses = $("#akses").val();								
	if (akses==1){
		var pilih = confirm("Data sudah ada, apakah Akan mengubahnya ?");
		if (pilih==true) {
			simpan_data();
			return false;
		}else{
			$("#info").html("Anda membatalkan proses simpan");
			return false;
		}
	}else{
		simpan_data();
		return false;
	}
	});

	function simpan_data(){
		var	user	= $("#txt_user").val();
		var	pwd1	= $("#txt_pwd1").val();
		var	pwd2	= $("#txt_pwd2").val();
		var	nama	= $("#txt_nama").val();
		var	level	= $(".radio_level:checked").val();
		var	blokir	= $(".radio_blokir:checked").val();
		var jml_level = $(".radio_level:checked");
		var jml_blokir = $(".radio_blokir:checked");
		
		
		var error = false;

		if(user.length == 0){
           var error = true;
           alert("Maaf, User Name tidak boleh kosong");
		   $("#txt_user").focus();
		   return (false);
         }
		if(pwd1.length == 0){
           var error = true;
           alert("Maaf, Password tidak boleh kosong");
		   $("#txt_pwd1").focus();
		   return (false);
         }	 
		if(pwd2.length == 0){
           var error = true;
           alert("Maaf, Ulangi Password tidak boleh kosong");
		   $("#txt_pwd2").focus();
		   return (false);
         }	 
		if(pwd1 != pwd2){
           var error = true;
           alert("Maaf, Ulangi Password tidak sama");
		   $("#txt_pwd2").focus();
		   return (false);
         }	 
		 
		if(nama.length == 0){
           var error = true;
           alert("Maaf, Nama Lengkap tidak boleh kosong");
		   $("#txt_nama").focus();
		   return (false);
         }	 
		 if(jml_level.length == 0){
           var error = true;
           alert("Maaf, Anda belum memilih Level");
		   //$("#txt_user").focus();
		   return (false);
         }
		if(jml_blokir.length == 0){
           var error = true;
           alert("Maaf, Anda belum memilih Blokir");
		   //$("#txt_user").focus();
		   return (false);
         }

		 
		if(error == false){
		$.ajax({
			type	: "POST",
			url		: "modul/users/simpan.php",
			data	: "user="+user+
					"&pwd1="+pwd1+
					"&nama="+nama+
					"&level="+level+
					"&blokir="+blokir,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").html(data);
				$("#tampil_data").load('modul/users/tampil_data.php');
				$("#akses").val(1);
			}
		});
		}
		return false; 		
		
	}
});
</script>
<?php
echo "<input type='hidden' id='akses'>";
echo "<table width='100%'>
	<tr>
		<td>User Name</td>
		<td>:</td>
		<td><input type='text' name='txt_user' id='txt_user'  size='40' lenght='50' class='input'></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type='password' name='txt_pwd1' id='txt_pwd1'  size='40' lenght='50' class='input'></td>
	</tr>
	<tr>
		<td>Ulangi Password</td>
		<td>:</td>
		<td><input type='password' name='txt_pwd2' id='txt_pwd2'  size='40' lenght='50' class='input'></td>
	</tr>	
	<tr>
		<td>Nama Lengkap</td>
		<td>:</td>
		<td><input type='text' name='txt_nama' id='txt_nama'  size='50' lenght='50' class='input'></td>
	</tr>
	<tr>
		<td>Level</td>
		<td>:</td>
		<td><input type='radio' name='txt_level' id='radio_admin' value='admin' class='radio_level'>Administrator
		<input type='radio' name='txt_level' id='radio_user' value='user' class='radio_level'>User
		</td>
	</tr>	
	<tr>
		<td>Blokir</td>
		<td>:</td>
		<td><input type='radio' name='txt_blokir' id='radio_n' value='N' class='radio_blokir'>No
		<input type='radio' name='txt_blokir' id='radio_y' value='Y' class='radio_blokir'>Yes
		</td>
	</tr>		
	<tr>
		<td colspan='3' align='center'>
		<button name='tambah' id='tambah'>Tambah</button>
		<button name='keluar' id='simpan'>Simpan</button>
		</td>
	</tr>
	</table>";
?>