<script type="text/javascript" src="modul/retur_beli/ajax.js"></script>
<script language="javascript">	
	function editRow(ID){
	   var kode = ID; 
	   	$.ajax({
			type	: "POST",
			url		: "modul/retur_beli/cari.php",
			data	: "kode="+kode,
			dataType: "json",
			success	: function(data){
				$("#kode_barang").val(kode);
				$("#nama_barang").val(data.nama_barang);
				$("#satuan").val(data.satuan);
				$("#harga_beli").val(data.harga_beli);
				$("#harga_jual").val(data.harga_jual);
				$("#stok_awal").val(data.stok_awal);
			}
		});

	}
</script>
<?php
echo "<table id='theList' width='100%'>
	<tr>
		<td width='15%'>Kode Retur</td>
		<td width='2%'>:</td>
		<td><input type='text' name='txt_kode' id='txt_kode'  size='15'  readonly></td>
	</tr>
	<tr>
		<td width='15%'>Tanggal Pembelian</td>
		<td width='2%'>:</td>
		<td><input type='text' name='txt_tgl_beli' id='txt_tgl_beli'  size='10' lenght='10'></td>
	</tr>
	<tr>
		<td>Kode Pembelian</td>
		<td>:</td>
		<td><select name='cbo_kode' id='cbo_beli'>
		<option value=''>-Pilih Kode-</option>
		</select></td>
	</tr>
	<tr>
		<td colspan='3' align='center'>
		<button name='tambah' id='cari'>Cari</button>
		<button name='keluar' id='keluar'>Keluar</button>
		</td>
	</tr>
	</table>";
echo "<div id='ket' align='cener'></div>";	
echo "<div id='info' align='cener'></div>";
?>
