// JavaScript Document
$(document).ready(function() {
	//membuat text kode barang menjadi Kapital
	$("#kode_barang").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});

	// format datepicker untuk tanggal
	$("#txt_tgl_beli").datepicker({
				dateFormat      : "dd-mm-yy",        
	  showOn          : "button",
	  buttonImage     : "images/calendar.gif",
	  buttonImageOnly : true				
	});
	
	//hanya angka yang dapat dientry
	$("#txt_jumlah").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
		{
			return false;
		}
	});


	function kosong(){
		$(".detail_readonly").val('');
		$(".input_detail").val('');
	}
	
	function cari_nomor() {
		var no		=1;
		$.ajax({
			type	: "POST",
			url		: "modul/pembelian/cari_nomor.php",
			data	: "no="+no,
			dataType : "json",
			success	: function(data){
				$("#txt_kode_beli").val(data.nomor);
				tampil_data();
			}
		});		
	}

	function tampil_data() {
		var kode 	= $("#txt_kode_beli").val();;
		$.ajax({
				type	: "POST",
				url		: "modul/pembelian/tampil_data.php",
				data	: "kode="+kode,
				timeout	: 3000,
				beforeSend	: function(){		
					$("#info").html("<img src='loading.gif' />");			
				},				  
				success	: function(data){
					$("#info").html(data);
				}
		});			
	}

	
	cari_nomor();
	
	$("#txt_kode_barang").autocomplete("modul/pembelian/list_barang.php", {
				width:100,
				max: 10,
				scroll:false,
	});
	
	function cari_kode() {
		var kode	= $("#txt_kode_barang").val();
		$.ajax({
			type	: "POST",
			url		: "modul/pembelian/cari_barang.php",
			data	: "kode="+kode,
			dataType : "json",
			success	: function(data){
				$("#txt_nama_barang").val(data.nama_barang);
				$("#txt_satuan").val(data.satuan);
				$("#txt_harga").val(data.harga);
			}
		});		
	}
	
	$("#txt_kode_barang").keyup(function() {
		cari_kode();
	});
	$("#txt_kode_barang").focus(function() {
		cari_kode();
	});
	
	//mengalikan jumlah dengan harga
	$("#txt_jumlah").keyup(function(){
		var jml		= $("#txt_jumlah").val();
		var harga	= $("#txt_harga").val();
		if (jml.length!='') {
			var total	= parseInt(jml)*parseInt(harga);
			$("#txt_total").val(total);
		}else{
			$("#txt_total").val(0);
		}
	});


	$("#tambah_detail").click(function(){
		kosong();	
		$("#txt_kode_barang").focus();
	});

	
	$("#simpan").click(function(){
		var kode			= $("#txt_kode_beli").val();	
		var tgl				= $("#txt_tgl_beli").val();	
		var supplier		= $("#cbo_supplier").val();	
		var	kode_barang		= $("#txt_kode_barang").val();
		var	nama_barang		= $("#txt_nama_barang").val();
		var	satuan			= $("#txt_satuan").val();
		var	jumlah			= $("#txt_jumlah").val();
		var harga			= $("#txt_harga").val();	
		
		var error = false;
		if(kode.length == 0){
           var error = true;
           alert("Maaf, Kode Pembelan tidak boleh kosong");
		   $("#txt_kode_beli").focus();
		   return (false);
         }
		if(tgl.length == 0){
           var error = true;
           alert("Maaf, Tanggal Pembelian tidak boleh kosong");
		   $("#txt_tgl_beli").focus();
		   return (false);
         }
		if(supplier.length == 0){
           var error = true;
           alert("Maaf, Supplier tidak boleh kosong");
		   $("#cbo_supplier").focus();
		   return (false);
         }
		if(kode_barang.length == 0){
           var error = true;
           alert("Maaf, Kode barang tidak boleh kosong");
		   $("#txt_kode_barang").focus();
		   return (false);
         }
		if(nama_barang.length == 0){
           var error = true;
           alert("Maaf, Nama Barang tidak boleh kosong");
		   $("#txt_kode_barang").focus();
		   return (false);
         }
		if(jumlah.length == 0){
           var error = true;
           alert("Maaf, Jumlah Barang tidak boleh kosong");
		   $("#txt_jumlah").focus();
		   return (false);
         }

		 		 
		if(error == false){
		$.ajax({
			type	: "POST",
			url		: "modul/pembelian/simpan.php",
			data	: "kode="+kode+
						"&tgl="+tgl+
						"&supplier="+supplier+
						"&kode_barang="+kode_barang+
						"&jumlah="+jumlah+
						"&harga="+harga,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").show();
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").show();
				$("#info").html(data);
			}
		});
		}
		return false; 
	});

	$("#tambah_beli").click(function() {
		$(".input").val('');
		kosong();
		cari_nomor();
		$("#txt_tgl_beli").focus();
	});

	$("#keluar").click(function(){
		document.location='?module=home';
	});

});

