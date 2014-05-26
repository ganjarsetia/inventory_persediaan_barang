// JavaScript Document
$(document).ready(function() {

	function kosong(){
		$("#kode_barang").val('');
		$("#nama_barang").val('');
		$("#satuan").val('');
		$("#harga_beli").val('');		
		$("#harga_jual").val('');
		$("#stok_awal").val('');
	}
	
	var hal =0;
	$.ajax({
			type	: "GET",
			url		: "modul/barang/tampil_data.php",
			data	: "hal="+hal,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").html(data);
			}
	});	
	
	$("#tambah").click(function(){
		kosong();	
		kode_barang.focus();
	});


	$("#simpan").click(function(){
				
		var	kode_barang		= $("#kode_barang").val();
		var	nama_barang		= $("#nama_barang").val();
		var	satuan			= $("#satuan").val();
		var	harga_beli		= $("#harga_beli").val();		
		var	harga_jual		= $("#harga_jual").val();
		var stok_awal		= $("#stok_awal").val();
		
		var error = false;

		if(kode_barang.length == 0){
           var error = true;
           alert("Maaf, Kode barang tidak boleh kosong");
		   $("#kode_barang").focus();
		   return (false);
         }
		if(nama_barang.length == 0){
           var error = true;
           alert("Maaf, Nama Barang tidak boleh kosong");
		   $("#nama_barang").focus();
		   return (false);
         }

		 		 
		if(error == false){
		$.ajax({
			type	: "POST",
			url		: "modul/barang/simpan.php",
			data	: "kode_barang="+kode_barang+
					"&nama_barang="+nama_barang+
					"&satuan="+satuan+
					"&harga_beli="+harga_beli+
					"&harga_jual="+harga_jual+
					"&stok_awal="+stok_awal,
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

	$("#hapus").click(function(){
				
		var	kode_barang		= $("#kode_barang").val();
		var	nama_barang		= $("#nama_barang").val();
	
		var error = false;

		if(kode_barang.length == 0){
           var error = true;
           alert("Maaf, Kode barang tidak boleh kosong");
		   $("#kode_barang").focus();
		   return (false);
         }
		if(nama_barang.length == 0){
           var error = true;
           alert("Maaf, Nama Barang tidak boleh kosong");
		   $("#nama_barang").focus();
		   return (false);
         }

		 		 
		if(error == false){
		$.ajax({
			type	: "POST",
			url		: "modul/barang/hapus.php",
			data	: "kode_barang="+kode_barang,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").show();
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").show();
				$("#info").html(data);
				kosong();
			}
		});
		}
		return false; 
	});


	$("#keluar").click(function(){
		document.location='?module=home';
	});

});

