<script type="text/javascript">	
$(document).ready(function() {
	//$("#tabs").tabs();
	$("#tabs").tabs({selected:0});
	//$("#tabs").tabs({collapsible:true});
	$("#form").load('modul/users/form.php');
	$("#tampil_data").load('modul/users/tampil_data.php');
	
	$("#txt_cari").keyup(function() {
		var cari 	= $("#txt_cari").val()
		var akses	= 1; //1 cari, 2 edit, 3 baru
		$.ajax({
			type	: "GET",
			url		: "modul/users/tampil_data.php",
			data	: "cari="+cari,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#tampil_data").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#tampil_data").html(data);
				$("#cari_txt_all").attr("checked","checked");
				$("#cari_txt_a").attr("checked","checked");
				//$("#data").load('modul/supplier/tampil_data.php');
			}
		});
	});
	
	$(".cari_blokir").click(function() {
		var blokir = $(".cari_blokir:checked").val();
		//alert('Pilih '+blokir);
		$.ajax({
			type	: "GET",
			url		: "modul/users/tampil_data.php",
			data	: "blokir="+blokir,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#tampil_data").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#tampil_data").html(data);
				$("#txt_cari").val('');
				//$("#data").load('modul/supplier/tampil_data.php');
			}
		});
	});

	$(".cari_level").click(function() {
		var level = $(".cari_level:checked").val();
		//alert('Pilih '+blokir);
		$.ajax({
			type	: "GET",
			url		: "modul/users/tampil_data.php",
			data	: "level="+level,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#tampil_data").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#tampil_data").html(data);
				$("#txt_cari").val('');
				//$("#data").load('modul/supplier/tampil_data.php');
			}
		});

	});

	$("#btn").click(function() {
		//alert('tes');							 
		//$("#tabs").tabs('select':1);
		//return false;
	});
});
</script>


<style type="text/css">
#info {
	font-size:12px;
	font-weight:bold;
	color:#F00;
}
</style>
<?php
echo "<div id='tabs'>";
echo "<ul >
	       <li><a href='#form'>INPUT PENGGUNA</a></li>
	       <li><a href='#data'>DAFTAR PENGGUNA</a></li>
      </ul>";
	echo "<div id='form'>
	</div>";
	echo "<div id='data'>
			<div id='pencarian'>
			<fieldset>
			<legend>Filter Data</legend>
			<table width='100%'>
				<tr>
					<td width='10%'>Cari Kata</td>
					<td width='2%'>:</td>
					<td><input type='text' name='txt_cari' id='txt_cari' size='80'></td>
				</tr>
				<tr>
					<td>Level</td>
					<td>:</td>
					<td><input type='radio' name='cari_txt_level' id='cari_txt_all' value='all' class='cari_level' checked>All
					<input type='radio' name='cari_txt_level' id='cari_txt_admin' value='admin' class='cari_level' >Administrator
					<input type='radio' name='cari_txt_level' id='cari_txt_user' value='user' class='cari_level'>User
					</td>
				</tr>	
				<tr>
					<td>Blokir</td>
					<td>:</td>
					<td><input type='radio' name='cari_txt_blokir' id='cari_txt_a' value='all' class='cari_blokir' checked>All
					<input type='radio' name='cari_txt_blokir' id='cari_txt_n' value='N' class='cari_blokir' >No
					<input type='radio' name='cari_txt_blokir' id='cari_txt_y' value='Y' class='cari_blokir'>Yes
					</td>
				</tr>		
			</table>
			</fieldset>
			</div><br>
			<div id='tampil_data' align='center'></div>
	</div>";
	echo "<div id='info' align='center'></div>";
echo "</div>";
?>
