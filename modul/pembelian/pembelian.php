<script type="text/javascript" src="modul/pembelian/ajax.js"></script>
<script type="text/javascript">	
	/*					  
	function kosong(){
		//$(".input").val('');
		$(".input_detail").val('');
		$(".detail_readonly").val('');
	}
	*/
	function hapus_data(ID) {
		var kode = $("#txt_kode_beli").val(); 
		var id	= ID;
	   var pilih = confirm('Data yang akan dihapus kode = '+id+ '?');
		if (pilih==true) {
			$.ajax({
				type	: "POST",
				url		: "modul/pembelian/hapus.php",
				data	: "kode="+kode+"&id="+id,
				success	: function(data){
					$("#info").html(data);
					kosong();
				}
			});
		}
	}
</script>
<style type="text/css">
.readonly{
	background-color:#999;
}
.detail_readonly{
	background-color:#999;
}
h3 {
	font-family:Verdana, Geneva, sans-serif;
	font-size:16px;
	text-align:center;
	color:#009;
}
.bg_input {
	background: url('images/bg_input.png') center bottom no-repeat;
}
</style>
<?php
include 'inc/inc.koneksi.php';
echo "<h3>TRANSAKSI PEMBELIAN BARANG</h3>";
echo "<table id='theList' width='100%'>
	<tr>
		<td>Kode Pembelian</td>
		<td>:</td>
		<td><input type='text' name='txt_kode_beli' id='txt_kode_beli'  size='10' lenght='10' class='readonly' readonly></td>
	</tr>
	<tr>
		<td>Tanggal Beli</td>
		<td>:</td>
		<td><input type='text' name='txt_tgl_beli' id='txt_tgl_beli'  size='12' lenght='12' class='input'></td>
	</tr>
	<tr>
		<td>Supplier</td>
		<td>:</td>
		<td><select name='cbo_supplie' id='cbo_supplier' class='input'>
		<option value='' selected>-Pilih-</option>";
		$sql	= "SELECT * FROM supplier ";
		$query	= mysql_query($sql);
		while($r=mysql_fetch_array($query)){
			echo "<option value='".$r['kode_supplier']."'>".$r['kode_supplier']." - ".$r['nama_supplier']."</option>";
		}
		echo "</select>
		</td>
	</tr>
	</table>
	<div class='bg_input'>
	<table width='100%'>
	<tr>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Harga</th>
		<th>Total</th>
	</tr>
	<tr>
		<td><input type='text' name='txt_kode_barang' id='txt_kode_barang'  size='10' lenght='10' class='input_detail'></td>
		<td><input type='text' name='txt_nama_barang' id='txt_nama_barang'  size='50'  class='detail_readonly' readonly></td>
		<td><input type='text' name='txt_satuan' id='txt_satuan'  size='7'  class='detail_readonly' readonly></td>
		<td><input type='text' name='txt_jumlah' id='txt_jumlah'  size='4'  class='input_detail'></td>
		<td><input type='text' name='txt_harga' id='txt_harga'  size='6'  class='detail_readonly' readonly></td>
		<td><input type='text' name='txt_total' id='txt_total'  size='12'  class='detail_readonly' readonly></td>
	</tr>	
	<tr>
		<td colspan='6' align='center'>
		<button name='tambah_detail' id='tambah_detail'>Tambah Barang</button>
		<button name='simpan' id='simpan'>Simpan Barang</button>
		</td>
	</tr>
	</table>
	</div>";
echo "<div id='info' align='center'></div>";
echo "<div id='tombol'>
	<table width='100%'>
	<tr>
		<td align='center'>
		<button name='tambah_beli' id='tambah_beli'>Tambah Pembelian</button>
		<button name='keluar' id='keluar'>Keluar</button>
		</td>
	</tr>
	</table></div>";

?>
