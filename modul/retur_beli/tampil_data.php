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
	
	$(".jml_retur").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
		{
			return false;
		}
	});
		
	function h_cek(){
		var cek 	= $(".cek:checked").length;
		$("#tot_cek").html('Jumlah Ceklist : '+cek);
	}

  $("#theList.retur tr")
  	.filter(":has(:checkbox:checked)")
	.addClass("klik")
	.end()
	.click(function(event) {		
		$(this).toggleClass("klik");
		if(event.target.type !== "checkbox") {
			$(":checkbox",this).attr("checked",function(){															
				return !this.checked;
			});
			h_cek();
		}
		
	});

	$("#simpan_retur").click(function(){	
		var cek 		= $(".cek:checked").length;
		var	tgl			= $("#txt_tgl_beli").val();
		var	kode		= $("#cbo_beli").val();
		var kode_retur 	= $("#txt_kode").val();

		if(kode_retur.length == 0){
           alert("Maaf, Kode Retur tidak boleh kosong");
		   $("#txt_tgl_beli").focus();
		   return false;
         }
		 
		if(tgl.length == 0){
           alert("Maaf, Tanggal Pembelian tidak boleh kosong");
		   $("#txt_tgl_beli").focus();
		   return false;
         }
		if(kode.length == 0){
           alert("Maaf, Kode Pembelian tidak boleh kosong");
		   $("#cbo_beli").focus();
		   return false;
         }	
		
		if (cek ==0){
			alert('Maaf, Anda belum memilik/cek data');
			return false;
		}
		
		for (var i = 1; i <= cek ; ++i) {
			//var id = $("#cek"+i).val();
			var jml = $("#jml_retur"+i).val();
			var kode_brg = $("#kode_brg"+i).val();
			$.ajax({
			type	: "POST",
			url		: "modul/retur_beli/simpan.php",
			data	: "kode_retur="+kode_retur+"&kode="+kode+"&tgl="+tgl+"&jml="+jml+"&kode_brg="+kode_brg,
			success	: function(data){
				$("#ket").html(data);
				//alert('OK');
			}
			});
		}
		
	});

});
</script>
<style type="text/css">
.klik {  
     background:#090; 
}     
</style>

<?php
include '../../inc/inc.koneksi.php';
$kode	= $_POST['kode'];

echo "<table id='theList' class='retur' width='100%'>
		<tr>
			<th width='2%'>No.</th>
			<th width='2%'>Cek</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Jumlah Beli</th>
			<th>Jumlah Retur</th>
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
			$total	= $r_data['jumlah_beli']*$r_data['harga_beli'];
			echo "<tr>
					<td align='center'>$no</td>
					<td align='center'><input type='checkbox' value='".$r_data['kode_barang']."' class='cek' id='cek$no'>
					<input type='hidden' name='kode_brg$no'  id='kode_brg$no' value='".$r_data['kode_barang']."' >
					</td>
					<td>".$r_data['kode_barang']."</td>
					<td>".$r_data['nama_barang']."</td>
					<td align='center'>".$r_data['satuan']."</td>
					<td align='center'>".$r_data['jumlah_beli']."</td>
					<td align='center'><input type='text' class='jml_retur' id='jml_retur".$no."' size='3' ></td>
					</tr>";
			$no++;
			$g_total = $g_total+$total;
		}
	echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td><div id='tot_cek'></div></td>
		</tr>
		</table>";
	
	echo "<table width='100%'>
		<tr>
			<td align='center'><button name='simpan_retur' id='simpan_retur'>SIMPAN RETUR</button></td>
		</tr>
		</table>";
?>