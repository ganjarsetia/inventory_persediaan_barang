<script type="text/javascript" src="modul/barang/ajax.js"></script>
<script language="javascript">	
	function editRow(ID){
	   var kode = ID; 
	   	$.ajax({
			type	: "POST",
			url		: "modul/barang/cari.php",
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
		<td>Kode Barang</td>
		<td>:</td>
		<td><input type='text' name='kode_barang' id='kode_barang'  size='10' lenght='10'></td>
	</tr>
	<tr>
		<td>Nama Barang</td>
		<td>:</td>
		<td><input type='text' name='nama_barang' id='nama_barang'  size='50' lenght='50'></td>
	</tr>
	<tr>
		<td>Satuan</td>
		<td>:</td>
		<td><select name='satuan' id='satuan'>
		<option value='' selected>-Pilih-</option>
		<option value='PCS' >PCS</option>
		<option value='Galon' >Galon</option>
		<option value='Box' >Box</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Harga Beli</td>
		<td>:</td>
		<td><input type='text' name='harga_beli' id='harga_beli'  size='20' lenght='20'></td>
	</tr>
	<tr>
		<td>Harga Jual</td>
		<td>:</td>
		<td><input type='text' name='harga_jual' id='harga_jual'  size='20' lenght='20'></td>
	</tr>	
	<tr>
		<td>Stok Awal</td>
		<td>:</td>
		<td><input type='text' name='stok_awal' id='stok_awal'  size='5' lenght='5'></td>
	</tr>
	<tr>
		<td colspan='3' align='center'>
		<button name='tambah' id='tambah'>Tambah</button>
		<button name='simpan' id='simpan'>Simpan</button>
		<button name='hapus' id='hapus'>Hapus</button>
		<button name='keluar' id='keluar'>Keluar</button>
		</td>
	</tr>
	</table>";
echo "<div id='info' align='cener'></div>";
?>
