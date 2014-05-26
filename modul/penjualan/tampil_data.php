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
	
	$("#cari_tgl_awal").datepicker({
		dateFormat      : "dd-mm-yy",        
	  	showOn          : "button",
	  	buttonImage     : "images/calendar.gif",
	  	buttonImageOnly : true				
	});
	$("#cari_tgl_akhir").datepicker({
		dateFormat      : "dd-mm-yy",        
	  	showOn          : "button",
	  	buttonImage     : "images/calendar.gif",
	  	buttonImageOnly : true				
	});
	

});
	function edit_data_jual(ID){
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/penjualan/cari_kode.php",
			data	: "kode="+kode,
			dataType: "json",
			success	: function(data){
				$("#lbl_kode_jual").val(kode);
				$("#lbl_tgl_jual").val(data.tgl);
				$("#info_jual").show();
				
				$("#tampil_data").load('modul/penjualan/tampil_data_detail.php?kode='+kode);
				$("#pencarian").hide();
								
			}
		});

	}
	
	function hapus_data_jual(ID){
		//location.window();
		//window.location.href='media.php?module=supplier';
		var pilih = confirm('Data yang akan dihapus kode = '+ID+ '?');
		if (pilih==true) {
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "modul/supplier/hapus.php",
			data	: "kode="+kode,
			success	: function(data){
				$("#info").html(data);
				$("#tampil_data").load('modul/supplier/tampil_data.php');
				$("#akses").val('');
			}
		});
		}
	}

</script>
<?php
include '../../inc/inc.koneksi.php';
include '../../inc/fungsi_tanggal.php';

$tgl_awal	= jin_date_sql($_GET['tgl_awal']);
$tgl_akhir	= jin_date_sql($_GET['tgl_akhir']);
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

	$query2	= "SELECT * 
			FROM penjualan
			WHERE tgl_jual BETWEEN '$tgl_awal' AND '$tgl_akhir' ";
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<table id='theList' width='100%'>
		<tr>
			<th>No.</th>
			<th>Kode Penjualan</th>
			<th>Tanggal</th>
			<th>Jumlah Barang</th>
			<th>Total Penjualan</th>
			<th>Aksi</th>
		</tr>";
		$sql = "SELECT kode_jual,tgl_jual,count(kode_barang) as kodebrg,sum(jumlah_jual*harga_jual) as total
				FROM penjualan
			WHERE tgl_jual BETWEEN '$tgl_awal' AND '$tgl_akhir'
				GROUP BY kode_jual
				LIMIT $hal,$lim";
				
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
			$total = $r_data['total'];
			echo "<tr>
					<td align='center'>$no</td>
					<td align='center'>".$r_data['kode_jual']."</td>
					<td align='center'>".jin_date_str($r_data['tgl_jual'])."</td>
					<td align='center'>".$r_data['kodebrg']."</td>
					<td align='right'>Rp.".number_format($r_data['total'])."</td>
					<td align='center'>
					<a href='javascript:void(0)' onClick=\"edit_data_jual('".$r_data['kode_jual']."')\">
					<img src='icon/thumb_up.png' border='0' id='edit' title='Edit' width='12' height='12' >
					</a>
					<a href='javascript:void(0)' onClick=\"hapus_data_jual('".$r_data['kode_jual']."')\">
					<img src='icon/thumb_down.png' border='0' id='hapus' title='Hapus' width='12' height='12' >
					</a>					
					</td>
					</tr>";
			$no++;
			$g_total=$g_total+$total;
		}
		
	echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td align='right'>Total Penjualan : Rp. ".number_format($g_total)."</td>
		</tr>
		</table>";	
	echo "<table width='100%'>
		<tr>
			<td>Jumlah Data : $jml</td>
			<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('modul/penjualan/tampil_data.php?tgl_awal=<?php echo $_GET['tgl_awal'];?>
                    &tgl_akhir=<?php echo $_GET['tgl_akhir'];?>
                    &hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#tampil_data').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>
		</tr>
		</table>";
?>