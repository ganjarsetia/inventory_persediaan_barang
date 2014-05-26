<?php
include 'inc/cek_session.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Persediaan Barang</title>
<link rel="stylesheet" href="css/icon.css" type="text/css" />
<link rel="stylesheet" href="css/superfish.css" type="text/css" />
<link rel="stylesheet" href="css/style_content.css" type="text/css" />
<link rel="stylesheet" href="css/style_tabel.css" type="text/css" />


<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script>
<!-- untuk menu superfish -->
<script type="text/javascript" src="js/superfish.js"></script>

<!-- untuk datepicker -->
<link type="text/css" href="css/ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/ui.datepicker-id.js"></script>

<!-- untuk autocomplite -->
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>

<!-- plugin untuk tab -->
<link type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	   $('ul.sf-menu').superfish();
  });
</script>
</head>

<body>

<div class="box">
<div class="border">
<div class="style">
	<div class="header">
    	<span class="title">
        	<div align="center">
        		<img src="images/header.jpg" width="840" height="120" />
            </div>
        </span>
    </div>
	<div class="menu">
   	 	<ul class="sf-menu">
			<li><a href="?module=home" class="icon home">Home HDT</a></li>	
			<li>
				<a href="#" class="icon master">Master</a>
				<ul>
					<li><a href="?module=pengguna" class="icon pengguna">Pengguna</a></li>
                    <li><a href="?module=barang" class="icon barang">Barang</a></li>
                    <li><a href="?module=supplier" class="icon supplier">Supplier</a></li>
				</ul>
			</li>
			<li><a href="#" class="icon transaksi">Transaksi</a>
				<ul>
					<li><a href="?module=pembelian" class="icon pembelian">Pembelian</a></li>
                    <li><a href="?module=penjualan" class="icon penjualan">Penjualan</a></li>
                    <li><a href="?module=retur_beli" class="icon returbeli">Retur Pembelian</a></li>
				</ul>            
            </li>
            
			<li>
				<a href="#" class="icon laporan">Laporan</a>
				<ul>
					<li><a href="?module=lap_barang" class="icon lapbarang">Barang</a></li>
					<li><a href="?module=lap_beli" class="icon lapbeli">Pembelian</a></li>
					<li><a href="?module=lap_jual" class="icon lapjual">Penjualan</a></li>
                    <li><a href="?module=lap_stok" class="icon lapstok">Stok Barang</a></li>
				</ul>
			</li>
            <li><a href="logout.php" class="icon keluar">Keluar</a></li>	
		</ul>
    </div>
	<!--awal content -->
    <div class="content">
    	<?php
			include 'content.php';
		?>
    </div>
    <!--akhir content -->
    <div class="footer" align="center">
    	<p>Copyright &copy; Help Desk Technology <span class="cls_hdt">HDT</span> 2012</p>
    </div>
</div>
</div>
</div>

</body>
</html>