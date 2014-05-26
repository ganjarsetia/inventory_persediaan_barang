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
</script>
<?php
include '../../inc/inc.koneksi.php';
$kode	= $_POST['kode'];

echo "<table id='theList' width='100%'>
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
		$sql = "SELECT a.kode_beli,a.tgl_beli,a.kode_barang,a.jumlah_beli,a.harga_beli,a.kode_supplier,
				b.nama_barang,b.satuan
				FROM pembelian as a
				JOIN barang as b
				ON (a.kode_barang=b.kode_barang)
				WHERE a.kode_beli='$kode'
				ORDER BY kode_beli, a.kode_barang";
				
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1;
		while($r_data=mysql_fetch_array($query)){
			$kode = $r_data['kode_beli'].$r_data['kode_supplier'].$r_data['kode_barang'];
			$total	= $r_data['jumlah_beli']*$r_data['harga_beli'];
			echo "<tr>
					<td align='center'>".$no."</td>
					<td>".$r_data['kode_barang']."</td>
					<td>".$r_data['nama_barang']."</td>
					<td align='center'>".$r_data['satuan']."</td>
					<td align='center'>".$r_data['jumlah_beli']."</td>
					<td align='right'>Rp. ".number_format($r_data['harga_beli'])."</td>
					<td align='right'>Rp. ".number_format($total)."</td>
					<td align='center'>
					<a href='javascript:void(0)' onClick=\"hapus_data('$kode')\">
					<img src='icon/thumb_down.png' border='0' id='hapus' title='Hapus' width='12' height='12' >
					</a>
					</td>
					</tr>";
			$no++;
			$g_total = $g_total+$total;
		}
	echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td align='right'><h4><b>Total Pembelian : Rp.".number_format($g_total);
	echo "</b></h4></td>
		</tr>
		</table>";
?>