<?php
	include_once('../../inc/inc.koneksi.php');
	$kode1	= $_GET['kode1'];
	$kode2	= $_GET['kode2'];
	if (empty($kode1) && empty($kode2)){
	$q = "SELECT * FROM barang
		ORDER BY kode_barang";
	}else{
	$q = "SELECT * FROM barang
		WHERE kode_barang BETWEEN '$kode1' AND '$kode2'
		ORDER BY kode_barang";		
	}
		
	$r = mysql_query($q);
	$tgl = date('d M Y');
	$content = "<h3>LAPORAN DATA BARANG</h3><br/>
	PERTANGGAL  : $tgl
	<table width='390' border='1' style='border-collapse:collapse'>
		<tr>
			<th>No</th>
			<th>KODE BARANG</th>
			<th>NAMA BARANG</th>
			<th>SATUAN</th>
			<th>HARGA BELI</th>
			<th>HARGA JUAL</th>
			<th>STOK AWAL</th>
		</tr>";
	$no = 1;
	while ($d = mysql_fetch_array ($r)) {
		$content .= "
		<tr>
			<td align='center'>".$no."</td>
			<td align='center'>".$d['kode_barang']."</td>
			<td>".$d['nama_barang']."</td>
			<td>".$d['satuan']."</td>
			<td align='right'>".$d['harga_beli']."</td>
			<td align='right'>".$d['harga_jual']."</td>
			<td align='center'>".$d['stok_awal']."</td>
		</tr>";
		$no++;
		$t_beli = $t_beli+$d['harga_beli'];
		$t_jual = $t_jual+$d['harga_jual'];
	}
	$content .= "<tr>
					<td colspan='4' align='right'>Jumlah</td>
					<td align='right'>".$t_beli."</td>
					<td align='right'>".$t_jual."</td>
				</tr>
		</table>";
		
		//laporan ke excel
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_barang.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
		/*
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_barang.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;	
		*/
?>
