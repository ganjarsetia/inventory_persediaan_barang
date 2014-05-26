<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $("#theList.detail tr:even").addClass("stripe1");
        $("#theList.detail tr:odd").addClass("stripe2");

        $("#theList.detail tr").hover(
            function() {
                $(this).toggleClass("highlight");
            },
            function() {
                $(this).toggleClass("highlight");
            }
        );
    });	
});
	function hapus_data(ID){
		var pilih = confirm('Data yang akan dihapus kode = '+ID+ '?');
		if (pilih==true) {
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/penjualan/hapus.php",
			data	: "kode="+kode,
			success	: function(data){
				$("#info").html(data);
				tampil_data_detail();
			}
		});
		}
	}
	function tampil_data_detail(kode){
		var kode = $("#txt_kode").val();
		$("#data_detail").load("modul/penjualan/tampil_data_detail.php?kode="+kode);
	}

</script>
<?php
include '../../inc/inc.koneksi.php';
$kode	= $_GET['kode'];
echo "<table id='theList' class='detail' width='100%'>
		<tr>
			<th>No.</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>";
		$sql = "SELECT a.kode_jual,a.kode_barang,b.nama_barang,b.satuan,a.jumlah_jual,a.harga_jual
				FROM penjualan as a
				JOIN barang as b
				ON a.kode_barang=b.kode_barang
				WHERE a.kode_jual='$kode'
				ORDER BY a.kode_barang";
				
		//echo $sql;
		$query = mysql_query($sql);
		$jml_data = mysql_num_rows($query);
		$no=1;
		while($r_data=mysql_fetch_array($query)){
			$kode 	= $r_data['kode_jual'].'-'.$r_data['kode_barang'];
			$total	= $r_data['jumlah_jual']*$r_data['harga_jual'];
			echo "<tr>
					<td align='center'>$no</td>
					<td>".$r_data['kode_barang']."</td>
					<td>".$r_data['nama_barang']."</td>
					<td>".$r_data['satuan']."</td>
					<td align='center'>".$r_data['jumlah_jual']."</td>
					<td align='right'>Rp.".number_format($r_data['harga_jual'])."</td>
					<td align='right'>Rp.".number_format($total)."</td>
					<td align='center'>
					<a href='javascript:void(0)' onClick=\"hapus_data('$kode')\">
					<img src='icon/thumb_down.png' border='0' id='hapus' title='Hapus' width='12' height='12' >
					</a>					
					</td>
					</tr>";
			$no++;
			$jml_jual = $jml_jual+$total;
		}
		
	echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td>Jumlah Data : $jml_data</td>
			<td align='right'>Jumlah Beli : Rp.".number_format($jml_jual)."</td>
		</tr>
		</table>";
?>