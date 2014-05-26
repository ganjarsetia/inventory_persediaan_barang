<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $("#theList.barang tr:even").addClass("stripe1");
        $("#theList.barang tr:odd").addClass("stripe2");

        $("#theList.barang tr").hover(
            function() {
                $(this).toggleClass("highlight");
            },
            function() {
                $(this).toggleClass("highlight");
            }
        );
    });	
});
	function tambah_barang(ID){
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/penjualan/cari_barang.php",
			data	: "kode="+kode,
			dataType	: "json",
			success	: function(data){
				$("#txt_kode_barang").val(kode);
				$("#txt_nama_barang").val(data.nama_barang);
				$("#txt_satuan").val(data.satuan);
				$("#txt_harga").val(data.harga);
				$("#form_cari_barang").dialog('close');
				$("#txt_jumlah").val(0);
				$("#txt_jumlah").focus();
			}
		});
	}

</script>
<?php
include '../../inc/inc.koneksi.php';
$cari	= $_POST['cari'];
if (!empty($cari)){
echo "<table id='theList' class='barang' width='100%'>
		<tr>
			<th>No.</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Harga Jual</th>
			<th>Ambil</th>
		</tr>";
		$sql = "SELECT *
				FROM barang
				WHERE kode_barang LIKE '%$cari%' OR nama_barang LIKE '%$cari%'
				ORDER BY kode_barang";
				
		//echo $sql;
		$query = mysql_query($sql);
		$jml_data = mysql_num_rows($query);
		$no=1;
		while($r_data=mysql_fetch_array($query)){
			echo "<tr>
					<td align='center'>$no</td>
					<td>".$r_data['kode_barang']."</td>
					<td>".$r_data['nama_barang']."</td>
					<td>".$r_data['satuan']."</td>
					<td align='right'>Rp.".number_format($r_data['harga_jual'])."</td>
					<td align='center'>
					<a href='javascript:void(0)' onClick=\"tambah_barang('".$r_data['kode_barang']."')\">
					<img src='icon/download.gif' border='0' id='tambah_data' title='Tambah' width='12' height='12' >
					</a>					
					</td>
					</tr>";
			$no++;
			$jml_jual = $jml_jual+$total;
		}
		
	echo "</table>";
}else{
	echo "<b>Tidak ada data yang dicari</b>";
}
?>