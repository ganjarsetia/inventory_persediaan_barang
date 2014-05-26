<?php
  include_once('../../inc/inc.koneksi.php');
  include_once('../../inc/fungsi_hdt.php');
  
	$kode1	= $_GET['kode1'];
  	$kode2	= $_GET['kode2'];
  		if(empty($kode1) && empty($kode2)){
			$query = "SELECT * FROM barang";
		}else{
			$query = "SELECT * FROM barang
					WHERE kode_barang BETWEEN '$kode1' AND '$kode2'";
		}	
	//$query 	= "SELECT * FROM barang";
  	$sql 	= mysql_query($query);
	$row	= mysql_num_rows($sql);


   if ($row>0) {
	
	//Definisi
    define('FPDF_FONTPATH','../font/');
    require('fpdf.php');

    class PDF extends FPDF{
	   function FancyTable(){
		
		$kode1	= $_GET['kode1'];
  		$kode2	= $_GET['kode2'];
  		if(empty($kode1) && empty($kode2)){
			$query = "SELECT * FROM barang";
		}else{
			$query = "SELECT * FROM barang
					WHERE kode_barang BETWEEN '$kode1' AND '$kode2'";
		}
		$sql 	= mysql_query($query);
		$row	= mysql_num_rows($sql);

	    $w=array(10,22,60,20,20,20,20,20);

		$no=1;
        while($data=mysql_fetch_array($sql)){
			$kode		= $data['kode_barang'];
			$stok_awal 	= cari_stok_awal($kode);
			$jml_beli	= cari_jml_beli($kode);
			$jml_jual	= cari_jml_jual($kode);
			$stok_akhir	= cari_stok_akhir($kode);			
	      $this->Cell($w[0],6,$no,1,0,'C',$fill);
          $this->Cell($w[1],6,$data['kode_barang'],1,0,'C',$fill);
          $this->Cell($w[2],6,$data['nama_barang'],1,0,'L',$fill);
		  $this->Cell($w[3],6,$data['satuan'],1,0,'L',$fill);
          $this->Cell($w[4],6,$stok_awal,1,0,'C',$fill);
		  $this->Cell($w[5],6,$jml_beli,1,0,'C',$fill);
		  $this->Cell($w[6],6,$jml_jual,1,0,'C',$fill);
		  $this->Cell($w[7],6,$stok_akhir,1,0,'C',$fill);
          $this->Ln();  
		  $no++;
        }
        	$this->Cell(array_sum($w),0,'','T');
      }
	}
	
    //Instanciation of inherited class
	$A4[0]=210;
	$A4[1]=297;
	$Q[0]=216;
	$Q[1]=279;
    $pdf=new PDF('P','mm',$A4);
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('DAFTAR STOK BARANG');
    $pdf->SetAuthor('(c) HDT'.$y);
    $pdf->SetCreator('Deddy Rusdiansyah,S.Kom with fpdf');
    $pdf->SetFont('arial','B',12);
	$tgl = date('d M Y');
    $pdf->Cell(0,5,'DAFTAR PERSEDIAAN BARANG',0,1,'C');
	$pdf->Cell(0,5,'PERTANGGAL : '.$tgl,0,1,'C');
	$pdf->Ln(10);
	$pdf->SetFont('arial','B',9);
	$pdf->SetLineWidth(.1);
	$pdf->SetFillColor(229,229,229);
	$pdf->Cell(10,10,'No.',1,0,'C',true);
	$pdf->Cell(22,10,'Kode Barang',1,0,'C',true);
	$pdf->Cell(60,10,'Nama Barang',1,0,'C',true);
	$pdf->Cell(20,10,'Satuan',1,0,'C',true);
	$pdf->Cell(20,10,'Stok Awal',1,0,'C',true);
	$pdf->Cell(20,10,'JML Beli',1,0,'C',true);
	$pdf->Cell(20,10,'JML Jual',1,0,'C',true);
	$pdf->Cell(20,10,'Stok Akhir',1,1,'C',true);
	$pdf->SetFont('arial','',9);
	$pdf->SetLineWidth(.1);
	$pdf->FancyTable();	
	$pdf->Ln(10);
	$pdf->SetX(150);
	$pdf->Cell(30,5,'Serang, '.$tgl,0,1,'L',false);
	$pdf->SetX(150);
	$pdf->Cell(30,5,'Mengetahui, ',0,1,'L',false);
	$pdf->Ln(20);
	$pdf->SetX(150);
	$pdf->Cell(60,5,'Deddy Rusdiansyah,S.Kom',0,1,'L',false);
	$pdf->SetX(150);
	$pdf->Cell(60,5,'General Manager',0,1,'L',false);
	
	$pdf->Output('Laporan_StokBarang.pdf','I'); //D=Download, I= ,
  } else {
    echo "<h1>Maaf, data tidak ditemukan</h1><br>".$query;
  }
?>