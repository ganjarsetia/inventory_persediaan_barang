// JavaScript Document
$(document).ready(function() {
						   
	$("#txt_tgl_beli").datepicker({
				dateFormat      : "dd-mm-yy",        
	  showOn          : "button",
	  buttonImage     : "images/calendar.gif",
	  buttonImageOnly : true				
	});

	tampil_data();
	
	function tampil_data(){
		$("#info").load("modul/retur_beli/tampil_data.php");
	}

	/*
	var hal =0;
	$.ajax({
			type	: "GET",
			url		: "modul/retur_beli/tampil_data.php",
			data	: "hal="+hal,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").html(data);
			}
	});	
	*/
	
	$("#txt_tgl_beli").change(function() {
		//alert('tes');
		var tgl	= $("#txt_tgl_beli").val();
		$.ajax({
			type	: "POST",
			url		: "modul/retur_beli/list_kode.php",
			data	: "tgl="+tgl,
			success	: function(data){
				$("#cbo_beli").html(data);
			}
		});

	});
	
	function buat_kode() {
		var	kode	= $("#cbo_beli").val();
		var tgl		= $("#txt_tgl_beli").val();
		$.ajax({
			type	: "POST",
			url		: "modul/retur_beli/buat_nomor.php",
			data	: "kode="+kode+"&tgl="+tgl,
			dataType: "json",
			success	: function(data){
				$("#txt_kode").val(data.kode_retur);
				//alert(data.kode_retur);
			}
		});		
	}
	
	$("#cari").click(function(){
		
		var	tgl		= $("#txt_tgl_beli").val();
		var	kode		= $("#cbo_beli").val();
	
		var error = false;

		if(tgl.length == 0){
           var error = true;
           alert("Maaf, Tanggal Pembelian tidak boleh kosong");
		   $("#txt_tgl_beli").focus();
		   return (false);
         }
		if(kode.length == 0){
           var error = true;
           alert("Maaf, Kode Pembelian tidak boleh kosong");
		   $("#cbo_beli").focus();
		   return (false);
         }		 
		if(error == false){
		$.ajax({
			type	: "POST",
			url		: "modul/retur_beli/tampil_data.php",
			data	: "kode="+kode,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").html("<img src='loading.gif' />");			
			},				  
			success	: function(data){
				$("#info").html(data);
				buat_kode();
			}
		});
		}
		return false; 
		
	});


	$("#keluar").click(function(){
		document.location='?module=home';
	});

});

