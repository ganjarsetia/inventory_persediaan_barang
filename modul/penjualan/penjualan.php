<script type="text/javascript">	
$(document).ready(function() {
	//$("#tabs").tabs();
	$("#tabs").tabs({selected:0});
	//$("#tabs").tabs({collapsible:true});
	$("#form").load('modul/penjualan/form.php');
	$("#tampil_data").load('modul/penjualan/tampil_data.php');
	$("#info_jual").hide();

	$("#cari_tgl").click(function() {
		var tgl_awal = $("#cari_tgl_awal").val();
		var tgl_akhir = $("#cari_tgl_akhir").val();
		
		if(tgl_awal.length==''){
			alert('Maaf, Variabel tanggal belum lengkap');
			$("#cari_tgl_awal").focus();
			return false;
		}
		if(tgl_akhir.length==''){
			alert('Maaf, Variabel tanggal belum lengkap');
			$("#cari_tgl_akhir").focus();
			return false;
		}
		$("#info_jual").hide();
		$("#pencarian").show();
		$("#tampil_data").load('modul/penjualan/tampil_data.php?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir);
	});
	
	$("#tutup_detail").click(function() {
		$("#pencarian").show();
		$("#info_jual").hide();
		$("#tampil_data").load('modul/penjualan/tampil_data.php?');
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
	       <li><a href='#form'>INPUT PENJUALAN</a></li>
	       <li><a href='#data'>DAFTAR PENJUALAN</a></li>
      </ul>";
	echo "<div id='form'>
	</div>";
	echo "<div id='data'>
			<div id='pencarian'>
			<table width='100%'>
				<tr>
					<td width='20%'>Filter Tanggal</td>
					<td width='2%'>:</td>
					<td>Dari &nbsp; <input type='text' name='cari_tgl_awal' id='cari_tgl_awal' size='12'> &nbsp; sampai &nbsp;
					<input type='text' name='cari_tgl_akhir' id='cari_tgl_akhir' size='12'> &nbsp; &nbsp;
					<button name='cari_tgl' id='cari_tgl'>CARI</button>
					</td>
				</tr>
			</table>
			</div>
			<div id='info_jual'>
			<table width='100%'>
				<tr>
					<td width='20%'>Kode Penjualan</td>
					<td width='2%'>:</td>
					<td><input type='text' name='lbl_kode_jual' id='lbl_kode_jual' size='20' readonly></td>
					<td width='20%'>Tanggal Penjualan</td>
					<td width='2%'>:</td>
					<td><input type='text' name='lbl_tgl_jual' id='lbl_tgl_jual' size='10' readonly></td>					
				<tr>
					<td colspan='6' align='center'>
					<button name='tutup_detail' id='tutup_detail'>TUTUP</button>
					</td>					
				</tr>
			</table>			
			</div>
			<div id='tampil_data' align='center'></div>
	</div>";
	echo "<div id='info' align='center'></div>";
echo "</div>";
?>
